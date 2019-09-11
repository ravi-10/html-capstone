<?php
/**
 * Tour Model Class Page 
 * last_update: 2019-09-11
 * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
 */

namespace App;

class BookingModel extends Model
{

	/**
	 * Model table
	 * @var string
	 */
	protected $table = 'bookings';

	/**
	 * Model key
	 * @var string
	 */
	protected $key = 'booking_id';

	/**
	 * Save a tour in database table and returns inserted id
	 * @param  Array $tour_array form fields
	 * @return Integer             inserted id
	 */
	public function saveBooking($payment_details)
	{
		$dbh = static::$dbh;
		$status = "paid";
		$customer_address = "";

		$query_address = 'SELECT street, city, postal_code, province, country
							FROM users WHERE user_id = :user_id';

		$stmt_address = $dbh->prepare($query_address);

		$params_address = array(
						':user_id' => $_SESSION['user_id']
					);

		$stmt_address->execute($params_address);

		$result_address = $stmt_address->fetch(\PDO::FETCH_ASSOC);
		$customer_address = $result_address['street'] . ', ' . 
							$result_address['city'] . ', ' . 
							$result_address['postal_code'] . ', ' . 
							$result_address['province'] . ', ' . 
							$result_address['country'];

		$query = "INSERT INTO {$this->table} (user_id, customer_address,
					 sub_total, gst, pst, total, status) VALUES (:user_id,
					:customer_address, :sub_total, :gst,
					:pst, :total, :status)";

		$params = array(
						':user_id' => $_SESSION['user_id'],
						':customer_address' => $customer_address,
						':sub_total' => $payment_details['sub_total'],
						':gst' => $payment_details['gst'],
						':pst' => $payment_details['pst'],
						':total' => $payment_details['total'],
						':status' => $status
					);

		$stmt = $dbh->prepare($query);

		$stmt->execute($params);

		return $dbh->lastInsertId();
	}

	public function saveBookingLineItems($booking_id)
	{
		$dbh = static::$dbh;

		$inserted_rows = 0;

		foreach ($_SESSION['cart'] as $cart){

			$query = "INSERT INTO booking_line_items(booking_id, tour_id, 
					unit_price, quantity) VALUES (:booking_id,
					:tour_id, :unit_price, :quantity)";

			$params = array(
							':booking_id' => $booking_id,
							':tour_id' => $cart['tour_id'],
							':unit_price' => $cart['price'],
							':quantity' => $cart['quantity']
						);

			$stmt = $dbh->prepare($query);

			$stmt->execute($params);

			$inserted_id = $dbh->lastInsertId();

			if($inserted_id > 0){
				$inserted_rows++;
			}
			unset($_SESSION['cart'][$cart['tour_id']]);
		}
		return $inserted_rows;
	}

	/**
	 * Return booking line items
	 * @param  INT $id booking_id
	 * @return Array of booking line items data
	 */
	public function getLineItems($id)
	{
		$query = "SELECT 
					booking_line_items.*,
					tours.title
					FROM
					booking_line_items
					JOIN tours USING(tour_id)
					WHERE booking_id = :booking_id";

		$params = array(':booking_id' => $id);

		$stmt = static::$dbh->prepare($query);

		$stmt->execute($params);

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);	
	}

}