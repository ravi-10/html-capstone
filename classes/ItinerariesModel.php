<?php
/**
 * Itineraries Model Class Page 
 * last_update: 2019-09-08
 * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
 */

namespace App;

class ItinerariesModel extends Model
{
	/**
	 * Model table
	 * @var string
	 */
	protected $table = 'itineraries';

	/**
	 * Model key
	 * @var string
	 */
	protected $key = 'itinerary_id';

	/**
	 * Return itineraries assigned to tour
	 * @return Mixed array
	 */
	public function tourItineraries($tour_id)
	{
		$query = "SELECT
					itineraries.*
					FROM
					itineraries
					JOIN
					itineraries_tours USING(itinerary_id)
					WHERE
					itineraries_tours.tour_id = :tour_id
					ORDER BY
					itineraries.name";

		$stmt = static::$dbh->prepare($query);

		$params = array(':tour_id' => $tour_id);

		$stmt->execute($params);

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

}