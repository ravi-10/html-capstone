<?php
/**
 * Tour Model Class Page 
 * last_update: 2019-09-04
 * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
 */

namespace App;

class HomeModel extends Model
{

	/**
	 * Return limited upcoming tours from tours table
	 * @return Mixed array
	 */
	public function upcomingTours()
	{
		$query = "SELECT
					tours.*,
					categories.name as category
					FROM
					tours
					JOIN
					categories USING(category_id)
					ORDER BY
					from_date
					LIMIT 3";

		$stmt = static::$dbh->prepare($query);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

}