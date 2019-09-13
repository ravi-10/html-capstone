<?php
/**
 * FAQ Model Class Page 
 * last_update: 2019-09-13
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
		$condition = ' WHERE is_deleted = false ';
		$order = 'ASC';

		if($for == 'frontend'){
			$condition .= " AND is_published = true ";
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

	/**
	 * Returns all searched faqs
	 * @param  String $keywords search keyword
	 * @return Array           faqs
	 */
	public function search($keywords)
	{
		$keywords = "%$keywords%";
		$condition = " WHERE is_deleted = false 
						AND question LIKE :keywords ";
		
		$query = "SELECT
					*
					FROM
					{$this->table}
					$condition
					ORDER BY
					question";

		$stmt = static::$dbh->prepare($query);

		$params = array(
			':keywords' => $keywords
		);

		$stmt->execute($params);

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

}