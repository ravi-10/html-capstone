<?php
/**
 * Model Class Page 
 * last_update: 2019-08-26
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
	 * Return all results from Model table
	 * @return Mixed array or bool
	 */
	public function all($order_by, $for)
	{
		$query = "SELECT * FROM {$this->table} ORDER BY $order_by";

		$stmt = static::$dbh->prepare($query);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	/**
	 * Return one result from Model table
	 * @param  INT $id tour_id
	 * @return Array of tour data
	 */
	public function one($id)
	{
		$query = "SELECT * from {$this->table}
					WHERE {$this->key} = :id";

		$params = array(':id' => $id);

		$stmt = static::$dbh->prepare($query);

		$stmt->execute($params);

		return $stmt->fetch(\PDO::FETCH_ASSOC);	
	}

}