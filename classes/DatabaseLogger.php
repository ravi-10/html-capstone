<?php
/**
 * Database Logger Class Page 
 * last_update: 2019-09-13
 * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
 */

namespace App;

class DatabaseLogger extends Model
{

	/**
	 * Model table
	 * @var string
	 */
	protected $table = 'db_log';

	/**
	 * Model key
	 * @var string
	 */
	protected $key = 'db_log_id';

	/**
	 * Save a log event in database table
	 * @param  Array $tour_array form fields
	 * @return void
	 */
	public function save($event)
	{
		$dbh = static::$dbh;

		$query = "INSERT INTO {$this->table} (event) 
					VALUES 
					(:event)";

		$params = array(
						':event' => $event
					);

		$stmt = $dbh->prepare($query);

		$stmt->execute($params);
	}

	/**
	 * Return recent 15 db logs
	 * @return Mixed array
	 */
	public function recentLogs()
	{
		$query = "SELECT * FROM {$this->table}
					ORDER BY {$this->key}
					DESC
					LIMIT 15";

		$stmt = static::$dbh->prepare($query);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

}