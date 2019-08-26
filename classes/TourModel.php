<?php

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