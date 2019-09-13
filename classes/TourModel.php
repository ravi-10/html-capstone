<?php
/**
 * Tour Model Class Page 
 * last_update: 2019-09-13
 * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
 */

namespace App;

class TourModel extends Model
{

	/**
	 * Model table
	 * @var string
	 */
	protected $table = 'tours';

	/**
	 * Model key
	 * @var string
	 */
	protected $key = 'tour_id';

	/**
	 * Return all tours from tours table by needed parameters
	 * @param String $order_by column field to order tours
	 * @param String $for 'backend' 0r 'frontend' to create specific query
	 * @return Mixed array
	 */
	public function all($order_by, $for)
	{
		$condition = " WHERE tours.is_deleted = false
						AND categories.is_deleted = false ";

		if($for == 'frontend'){
			$current_date = date('Y-m-d');
			$condition .= " AND is_published = true AND 
							booking_ends >= '$current_date' ";
		}

		$query = "SELECT
					tours.*,
					categories.name as category
					FROM
					{$this->table}
					JOIN
					categories USING(category_id)
					$condition
					ORDER BY
					$order_by";

		$stmt = static::$dbh->prepare($query);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	/**
	 * Return one result from tour table
	 * @param  INT $id tour_id
	 * @return Array of tour data
	 */
	public function one($id)
	{
		$condition = " WHERE tours.is_deleted = false
						AND categories.is_deleted = false 
						AND {$this->key} = :id";

		$query = "SELECT
					tours.*,
					categories.name as category
					FROM
					{$this->table}
					JOIN
					categories USING(category_id)
					$condition";

		$params = array(':id' => $id);

		$stmt = static::$dbh->prepare($query);

		$stmt->execute($params);

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	/**
	 * Return all tours from tours table by needed parameters
	 * @param String $order_by column field to order tours
	 * @param String $for 'backend' or 'frontend' to create specific query
	 * @param Integer $category_id category_id
	 * @return Mixed array
	 */
	public function allByCategory($order_by, $for, $category_id)
	{
		$condition = " WHERE tours.is_deleted = false
						AND categories.is_deleted = false ";

		if($for == 'frontend'){
			$current_date = date('Y-m-d');
			$condition .= " AND is_published = true AND 
							booking_ends >= '$current_date'
							AND category_id = :category_id ";
		}

		$query = "SELECT
					tours.*,
					categories.name as category
					FROM
					{$this->table}
					JOIN
					categories USING(category_id)
					$condition
					ORDER BY
					$order_by";

		$stmt = static::$dbh->prepare($query);

		$params = array(':category_id' => $category_id);

		$stmt->execute($params);

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	/**
	 * Save a tour in database table and returns inserted id
	 * @param  Array $tour_array form fields
	 * @param  String $featured_image image path
	 * @param  String $thumbnail_image image path
	 * @return Integer             inserted id
	 */
	public function save($array_tour, $featured_image, $thumbnail_image)
	{
		$dbh = static::$dbh;
		$is_published = 0; // boolean false for tinyint datatype
		if(!empty($array_tour['is_published'])) {
			$is_published = 1; // boolean true for tinyint datatype
		}

		$query = 'INSERT INTO tours (title, category_id, featured_image,
					thumbnail_image, description, country, from_date, to_date,
					price, booking_ends, bookings_available, max_allowed_bookings,
					is_published) 
					VALUES 
					(:title, :category_id, :featured_image, :thumbnail_image, 
					:description, :country, :from_date, :to_date, :price, 
					:booking_ends, :bookings_available, :max_allowed_bookings, 
					:is_published)';

		$params = array(
						':title' => $array_tour['title'],
						':category_id' => $array_tour['category'],
						':featured_image' => $featured_image,
						':thumbnail_image' => $thumbnail_image,
						':description' => $array_tour['description'],
						':country' => $array_tour['country'],
						':from_date' => $array_tour['from_date'],
						':to_date' => $array_tour['to_date'],
						':price' => $array_tour['price'],
						':booking_ends' => $array_tour['booking_ends'],
						':bookings_available' => $array_tour['bookings_available'],
						':max_allowed_bookings' => $array_tour['max_allowed_bookings'],
						':is_published' => $is_published
					);

		$stmt = $dbh->prepare($query);

		$stmt->execute($params);

		return $dbh->lastInsertId();
	}

	/**
	 * Update data of a tour and returns affected rows
	 * @param  Array $array_tour form fields
	 * @param  String $featured_image image path
	 * @param  String $thumbnail_image image path
	 * @return Integer             affected rows
	 */
	public function update($array_tour, $featured_image, $thumbnail_image)
	{
		$dbh = static::$dbh;
		$is_published = 0; // boolean false for tinyint datatype
		if(!empty($array_tour['is_published'])) {
			$is_published = 1; // boolean true for tinyint datatype
		}
		$updated_at = date('Y-m-d H:i:s');

		$query = 'UPDATE
					tours
					SET
					title = :title,
					category_id = :category_id,
					featured_image = :featured_image,
					thumbnail_image = :thumbnail_image,
					description = :description,
					country = :country,
					from_date = :from_date,
					to_date = :to_date,
					price = :price,
					booking_ends = :booking_ends,
					bookings_available = :bookings_available,
					max_allowed_bookings = :max_allowed_bookings,
					is_published = :is_published,
					updated_at = :updated_at
					WHERE
					tour_id = :tour_id';

		$stmt = $dbh->prepare($query);

		$params = array(
			':title' => $array_tour['title'],
			':category_id' => $array_tour['category'],
			':featured_image' => $featured_image,
			':thumbnail_image' => $thumbnail_image,
			':description' => $array_tour['description'],
			':country' => $array_tour['country'],
			':from_date' => $array_tour['from_date'],
			':to_date' => $array_tour['to_date'],
			':price' => $array_tour['price'],
			':booking_ends' => $array_tour['booking_ends'],
			':bookings_available' => $array_tour['bookings_available'],
			':max_allowed_bookings' => $array_tour['max_allowed_bookings'],
			':is_published' => $is_published,
			':updated_at' => $updated_at,
			':tour_id' => $array_tour['tour_id']
		);

		$stmt->execute($params);

		return $stmt->rowCount();
	}

	/**
	 * Returns all searched tours
	 * @param String $order_by column field to order tours
	 * @param String $for 'backend' or 'frontend' to create specific query
	 * @param  String $keywords search keyword
	 * @return Array           tours
	 */
	public function search($order_by, $for, $keywords)
	{
		$keywords = "%$keywords%";
		$condition = " WHERE tours.is_deleted = false
						AND categories.is_deleted = false
						AND (title LIKE :keywords OR country LIKE :keywords) ";
		$order = 'DESC';

		if($for == 'frontend'){
			$current_date = date('Y-m-d');
			$condition .= " AND is_published = true AND 
							booking_ends >= '$current_date' ";
		}
		
		$query = "SELECT
					tours.*,
					categories.name as category
					FROM
					{$this->table}
					JOIN
					categories USING(category_id)
					$condition
					ORDER BY
					$order_by
					$order";

		$stmt = static::$dbh->prepare($query);

		$params = array(
			':keywords' => $keywords
		);

		$stmt->execute($params);

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	/**
	 * Return all archived tours from tours table by needed parameters
	 * @return Mixed array
	 */
	public function allArchived()
	{
		$condition = " WHERE tours.is_deleted = true
						OR categories.is_deleted = true ";

		$query = "SELECT
					tours.*,
					categories.name as category
					FROM
					{$this->table}
					JOIN
					categories USING(category_id)
					$condition
					ORDER BY
					title";

		$stmt = static::$dbh->prepare($query);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

}