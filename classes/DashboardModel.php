<?php
/**
 * Dashboard Model Class Page 
 * last_update: 2019-09-13
 * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
 */

namespace App;

class DashboardModel extends Model
{
	/**
	 * get total from table
	 * @return Array
	 */
	public function getTotal($table){
		$condition = "";
		if($table != 'bookings'){
			$condition = " WHERE is_deleted = false ";
		}

		$query = "SELECT
					count(*) as 'total'
					FROM
					$table
					$condition";

		$stmt = static::$dbh->prepare($query);

		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	/**
	 * get aggregates from tour
	 * @return Array
	 */
	public function getTourAggregates(){
		
		$query = "SELECT
					max(price) as 'max_price',
					min(price) as 'min_price',
					avg(price) as 'avg_price'
					FROM
					tours
					WHERE
					is_deleted = false";

		$stmt = static::$dbh->prepare($query);

		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	/**
	 * get aggregates from booking
	 * @return Array
	 */
	public function getBookingAggregates(){
		
		$query = "SELECT
					max(total) as 'max_total',
					min(total) as 'min_total',
					avg(total) as 'avg_total'
					FROM
					bookings";

		$stmt = static::$dbh->prepare($query);

		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	/**
	 * get total type of users
	 * @return Array
	 */
	public function getTotalTypeOfUser($role){
		$query = "SELECT
					count(*) as 'total'
					FROM
					users
					WHERE
					role = :role";

		$stmt = static::$dbh->prepare($query);

		$params = array(':role'=>$role);

		$stmt->execute($params);

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

}