<?php
/**
 * Model Class Page 
 * last_update: 2019-09-13
 * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
 */

namespace App;

class Model
{
	/**
	 * property to store database handler
	 * @var static String variable
	 */
	protected static $dbh;

	/**
	 * Initialize database handle for all models
	 */
	public static function init($dbh)
	{
		static::$dbh = $dbh;
	}

	/**
	 * Return all tours from tours table by needed parameters
	 * @param String $order_by column field to order tours
	 * @param String $for 'backend' 0r 'frontend' to create specific query
	 * @return Mixed array
	 */
	public function all($order_by, $for)
	{
		$query = "SELECT * FROM {$this->table}
					WHERE is_deleted = false ORDER BY $order_by";

		$stmt = static::$dbh->prepare($query);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	/**
	 * Return one result from Model table
	 * @param  INT $id id
	 * @return Array of data
	 */
	public function one($id)
	{
		$query = "SELECT * from {$this->table}
					WHERE is_deleted = false AND {$this->key} = :id";

		$params = array(':id' => $id);

		$stmt = static::$dbh->prepare($query);

		$stmt->execute($params);

		return $stmt->fetch(\PDO::FETCH_ASSOC);	
	}

	/**
	 * Update is_deleted column to do soft delete
	 * @param  Integer $id id
	 * @return Integer             affected rows
	 */
	public function delete($id)
	{
		$updated_at = date('Y-m-d H:i:s');

		$query = "UPDATE
					{$this->table}
					SET
					is_deleted = :is_deleted,
					updated_at = :updated_at
					WHERE
					{$this->key} = :id";

		$stmt = static::$dbh->prepare($query);

		$params = array(
			':is_deleted' => true,
			':updated_at' => $updated_at,
			':id' => $id
		);

		$stmt->execute($params);

		return $stmt->rowCount();
	}

}