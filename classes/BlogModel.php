<?php
/**
 * Blog Model Class Page 
 * last_update: 2019-09-13
 * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
 */

namespace App;

class BlogModel extends Model
{

	/**
	 * Model table
	 * @var string
	 */
	protected $table = 'blogs';

	/**
	 * Model key
	 * @var string
	 */
	protected $key = 'blog_id';

	/**
	 * Return all tours from tours table by needed parameters
	 * @param String $order_by column field to order tours
	 * @param String $for 'backend' 0r 'frontend' to create specific query
	 * @return Mixed array
	 */
	public function all($order_by, $for)
	{
		$condition = " WHERE blogs.is_deleted = false
						AND users.is_deleted = false ";
		$order = 'ASC';

		if($for == 'frontend'){
			$condition .= " AND is_published = true ";
			$order = 'DESC';
		}

		$query = "SELECT
					blogs.*,
					users.first_name,
					users.last_name
					FROM
					{$this->table}
					JOIN
					users USING(user_id)
					$condition
					ORDER BY
					$order_by
					$order";

		$stmt = static::$dbh->prepare($query);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	/**
	 * Return one result from blog table
	 * @param  INT $id blog_id
	 * @return Array of blog data
	 */
	public function one($id)
	{
		$condition = " WHERE blogs.is_deleted = false
						AND users.is_deleted = false 
						AND {$this->key} = :id";

		$query = "SELECT
					blogs.*,
					users.first_name,
					users.last_name
					FROM
					{$this->table}
					JOIN
					users USING(user_id)
					$condition";

		$params = array(':id' => $id);

		$stmt = static::$dbh->prepare($query);

		$stmt->execute($params);

		return $stmt->fetch(\PDO::FETCH_ASSOC);	
	}

	/**
	 * Returns all searched blogs
	 * @param String $order_by column field to order tours
	 * @param String $for 'backend' or 'frontend' to create specific query
	 * @param  String $keywords search keyword
	 * @return Array           blogs
	 */
	public function search($order_by, $for, $keywords)
	{
		$keywords = "%$keywords%";
		$condition = " WHERE blogs.is_deleted = false
						AND users.is_deleted = false
						AND title LIKE :title ";
		$order = 'DESC';

		if($for == 'frontend'){
			$condition = " AND is_published = true  ";
		}

		$query = "SELECT
					blogs.*,
					users.first_name,
					users.last_name
					FROM
					{$this->table}
					JOIN
					users USING(user_id)
					$condition
					ORDER BY
					$order_by
					$order";

		$stmt = static::$dbh->prepare($query);

		$params = array(
			':title' => $keywords
		);

		$stmt->execute($params);

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	/**
	 * Save a blog in database table and returns inserted id
	 * @param  Array $array_blog form fields
	 * @param  String $featured_image image path
	 * @param  String $thumbnail_image image path
	 * @return Integer             inserted id
	 */
	public function save($array_blog, $featured_image, $thumbnail_image)
	{
		$dbh = static::$dbh;
		$is_published = 0; // boolean false for tinyint datatype
		if(!empty($array_blog['is_published'])) {
			$is_published = 1; // boolean true for tinyint datatype
		}

		$allow_comments = 0;
		if(!empty($array_blog['allow_comments'])) {
			$allow_comments = 1;
		}

		$query = 'INSERT INTO blogs (title, user_id, featured_image,
					thumbnail_image, description, published_at, 
					is_published, allow_comments)
					VALUES 
					(:title, :user_id, :featured_image, :thumbnail_image, 
					:description, :published_at, :is_published, 
					:allow_comments)';

		$params = array(
						':title' => $array_blog['title'],
						':user_id' => $array_blog['author'],
						':featured_image' => $featured_image,
						':thumbnail_image' => $thumbnail_image,
						':description' => $array_blog['description'],
						':published_at' => $array_blog['published_at'],
						':is_published' => $is_published,
						':allow_comments' => $allow_comments
					);

		$stmt = $dbh->prepare($query);

		$stmt->execute($params);

		return $dbh->lastInsertId();
	}

	/**
	 * Update data of a blog and returns affected rows
	 * @param  Array $array_blog form fields
	 * @param  String $featured_image image path
	 * @param  String $thumbnail_image image path
	 * @return Integer             affected rows
	 */
	public function update($array_blog, $featured_image, $thumbnail_image)
	{
		$dbh = static::$dbh;
		$is_published = 0; // boolean false for tinyint datatype
		if(!empty($array_blog['is_published'])) {
			$is_published = 1; // boolean true for tinyint datatype
		}

		$allow_comments = 0;
		if(!empty($array_blog['allow_comments'])) {
			$allow_comments = 1;
		}

		$updated_at = date('Y-m-d H:i:s');

		$query = 'UPDATE
					blogs
					SET
					title = :title,
					user_id = :user_id,
					featured_image = :featured_image,
					thumbnail_image = :thumbnail_image,
					description = :description,
					published_at = :published_at,
					is_published = :is_published,
					allow_comments = :allow_comments,
					updated_at = :updated_at
					WHERE
					blog_id = :blog_id';

		$stmt = $dbh->prepare($query);

		$params = array(
			':title' => $array_blog['title'],
			':user_id' => $array_blog['author'],
			':featured_image' => $featured_image,
			':thumbnail_image' => $thumbnail_image,
			':description' => $array_blog['description'],
			':published_at' => $array_blog['published_at'],
			':is_published' => $is_published,
			':allow_comments' => $allow_comments,
			':updated_at' => $updated_at,
			':blog_id' => $array_blog['blog_id']
		);

		$stmt->execute($params);

		return $stmt->rowCount();
	}

}