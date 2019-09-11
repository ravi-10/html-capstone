<?php
/**
 * User Model Class Page 
 * last_update: 2019-09-10
 * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
 */

namespace App;

class UserModel extends Model
{

	/**
	 * Model table
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * Model key
	 * @var string
	 */
	protected $key = 'user_id';

}