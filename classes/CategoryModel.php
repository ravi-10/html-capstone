<?php
/**
 * Category Model Class Page 
 * last_update: 2019-09-13
 * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
 */

namespace App;

class CategoryModel extends Model
{

	/**
	 * Model table
	 * @var string
	 */
	protected $table = 'categories';

	/**
	 * Model key
	 * @var string
	 */
	protected $key = 'category_id';

	/**
	 * Save a category in database table and returns inserted id
	 * @param  Array $tour_array form fields
	 * @return Integer             inserted id
	 */
	public function save($array_tour)
	{
		$dbh = static::$dbh;

		$query = 'INSERT INTO categories (name, description) 
					VALUES 
					(:name, :description)';

		$params = array(
						':name' => $array_tour['name'],
						':description' => $array_tour['description']
					);

		$stmt = $dbh->prepare($query);

		$stmt->execute($params);

		return $dbh->lastInsertId();
	}

	/**
	 * Update data of a category and returns affected rows
	 * @param  Array $array_tour form fields
	 * @return Integer             affected rows
	 */
	public function update($array_tour)
	{
		$dbh = static::$dbh;
		
		$updated_at = date('Y-m-d H:i:s');

		$query = 'UPDATE
					categories
					SET
					name = :name,
					description = :description,
					updated_at = :updated_at
					WHERE
					category_id = :category_id';

		$stmt = $dbh->prepare($query);

		$params = array(
			':name' => $array_tour['name'],
			':description' => $array_tour['description'],
			':updated_at' => $updated_at,
			':category_id' => $array_tour['category_id']
		);

		$stmt->execute($params);

		return $stmt->rowCount();
	}

	/**
	 * Return count if category name exists while adding new one
	 * @param  String $name category name
	 * @return Int count
	 */
	public function checkCategoryNameForAdding($name)
	{
		$query = "SELECT * from {$this->table}
					WHERE is_deleted = false AND name = :name";

		$params = array(':name' => $name);

		$stmt = static::$dbh->prepare($query);

		$stmt->execute($params);

		return $stmt->rowCount();
	}

	/**
	 * Return count if category name exists while updating existing
	 * @param  String $name category name
	 * @param  Int $id category id
	 * @return Int count
	 */
	public function checkCategoryNameForUpdating($name, $id)
	{
		$query = "SELECT * from {$this->table}
					WHERE is_deleted = false AND name = :name
					AND category_id != :category_id";

		$params = array(':name' => $name, ':category_id' => $id);

		$stmt = static::$dbh->prepare($query);

		$stmt->execute($params);

		return $stmt->rowCount();
	}

	/**
	 * Returns all searched categories
	 * @param  String $keywords search keyword
	 * @return Array           categories
	 */
	public function search($keywords)
	{
		$keywords = "%$keywords%";
		$condition = " WHERE is_deleted = false 
						AND name LIKE :keywords";
		
		$query = "SELECT
					*
					FROM
					{$this->table}
					$condition
					ORDER BY
					name";

		$stmt = static::$dbh->prepare($query);

		$params = array(
			':keywords' => $keywords
		);

		$stmt->execute($params);

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

}