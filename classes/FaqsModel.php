<?php
/**
 * Blog Model Class Page 
 * last_update: 2019-09-08
 * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
 */

namespace App;

class FaqsModel extends Model
{

	/**
	 * Model table
	 * @var string
	 */
	protected $table = 'faqs';

	/**
	 * Model key
	 * @var string
	 */
	protected $key = 'faq_id';

	/**
	 * Return all faqs from faqs table by needed parameters
	 * @param String $order_by column field to order tours
	 * @param String $for 'backend' 0r 'frontend' to create specific query
	 * @return Mixed array
	 */
	public function all($order_by, $for)
	{
		$condition = '';
		$order = 'ASC';

		if($for == 'frontend'){
			$condition = " WHERE is_published = true ";
			$order = 'DESC';
		}

		$query = "SELECT
					faqs.*
					FROM
					{$this->table}
					$condition
					ORDER BY
					$order_by
					$order";

		$stmt = static::$dbh->prepare($query);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

}