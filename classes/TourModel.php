<?php
/**
 * Tour Model Class Page 
 * last_update: 2019-09-04
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
	 * Return all tours from tours table
	 * @return Mixed array
	 */
	public function all()
	{
		$query = "SELECT
					tours.*,
					categories.name as category
					FROM
					{$this->table}
					JOIN
					categories USING(category_id)
					ORDER BY
					title";

		$stmt = static::$dbh->prepare($query);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	/**
	 * Save a tour in database table and returns inserted id
	 * @param  Array $tour_array form fields
	 * @return Integer             inserted id
	 */
	public function saveTour($tour_array)
	{
		$dbh = static::$dbh;

		$query = 'INSERT INTO tours (title, category_id, featured_image,
					thumbnail_image, description, country, from_date, to_date,
					price, booking_ends, max_allowed_bookings) VALUES (:title,
					:category_id, :featured_image, :thumbnail_image,
					:description, :country, :from_date, :to_date, :price,
					:booking_ends, :max_allowed_bookings)';

		$params = array(
						':title' => $tour_array['title'],
						':category_id' => $tour_array['category_id'],
						':featured_image' => $tour_array['featured_image'],
						':thumbnail_image' => $tour_array['thumbnail_image'],
						':description' => $tour_array['description'],
						':country' => $tour_array['country'],
						':from_date' => $tour_array['from_date'],
						':to_date' => $tour_array['to_date'],
						':price' => $tour_array['price'],
						':booking_ends' => $tour_array['booking_ends'],
						':max_allowed_bookings' => $tour_array['max_allowed_bookings']
					);

		$stmt = $dbh->prepare($query);

		$stmt->execute($params);

		return $dbh->lastInsertId();
	}

}