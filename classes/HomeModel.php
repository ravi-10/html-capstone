<?php
/**
 * Tour Model Class Page 
 * last_update: 2019-09-11
 * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
 */

namespace App;

class HomeModel extends Model
{
	/**
	 * Return featured tour from tours table
	 * @return Mixed array
	 */
	public function featuredTour()
	{
		$condition = " WHERE tours.is_deleted = false
						AND categories.is_deleted = false
						AND is_featured = true ";
		
		$query = "SELECT
					tours.*,
					categories.name as category
					FROM
					tours
					JOIN
					categories USING(category_id)
					$condition
					ORDER BY
					from_date
					LIMIT 1";

		$stmt = static::$dbh->prepare($query);

		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	/**
	 * Return limited upcoming tours from tours table
	 * @return Mixed array
	 */
	public function upcomingTours()
	{
		$current_date = date('Y-m-d');

		$condition = " WHERE tours.is_deleted = false
						AND categories.is_deleted = false
						AND is_published = true 
						AND booking_ends >= '$current_date' ";

		$query = "SELECT
					tours.*,
					categories.name as category
					FROM
					tours
					JOIN
					categories USING(category_id)
					$condition
					ORDER BY
					from_date
					LIMIT 3";

		$stmt = static::$dbh->prepare($query);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	/**
	 * Return limited recent blogs from blog table
	 * @return Mixed array
	 */
	public function recentBlogs()
	{
		$condition = " WHERE blogs.is_deleted = false
						AND is_published = true";

		$query = "SELECT
					*
					FROM
					blogs
					$condition
					ORDER BY
					published_at
					DESC
					LIMIT 2";

		$stmt = static::$dbh->prepare($query);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

}