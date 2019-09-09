<?php
/**
 * Category Model Class Page 
 * last_update: 2019-09-09
 * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
 */

namespace App;

class CategoryModel extends Model
{

	/**
	 * Model table
	 * @var string
	 */
	protected $table = 'categories';

	/**
	 * Model key
	 * @var string
	 */
	protected $key = 'category_id';

}