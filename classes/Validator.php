<?php
/**
 * Validator Class Page 
 * last_update: 2019-09-04
 * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
 */

// Base namespace
namespace App;

class Validator
{
	/**
	 * Array for tracking validation errors
	 * @var array
	 */
	protected $errors = [];

	/**
	 * Array for storing dat from POST request
	 * @var array
	 */
	protected $post = [];

	/**
	 * Constructor method to trim and store data from POST request
	 */
	public function __construct()
	{
		foreach ($_POST as $key => $value) {
			$this->post[$key] = trim($value);
		}
	}

	/**
	 * Function to validate reuired fields
	 * @param  String $field A form field
	 * @return void
	 */
	public function required($field)
	{
		if(empty($this->post[$field])) {
			$this->setError($field, "{$this->label($field)} is required");
		}
	}

	/**
	 * Function to validate general legal characters
	 * @param  String $field   A form field
	 * @return void
	 */
	public function generalStringValidator($field)
	{
		$pattern = '/^([a-zA-Z\s\'])+$/';

		if(preg_match($pattern, $this->post[$field]) !== 1) {
			$this->setError($field, "Only alphabets, apostrophe and 
							space allowed for {$this->label($field)}");
		}
	}

	/**
	 * Function to validate general length
	 * @param  String $field A form field
	 * @return void
	 */
	public function generalLengthValidator($field)
	{
		if(strlen($this->post[$field]) < 2 || strlen($this->post[$field]) > 50) {
			$this->setError($field, "{$this->label($field)} must be of 
							minimum 2 characters or maximum of 50 characters");
		}
	}

	/**
	 * Function to validate street
	 * @param  String $field A form field
	 * @return void
	 */
	public function street($field)
	{
		$pattern = '/^([a-zA-Z0-9\s\'\-\_\&\\\(\)])+$/';

		if(strlen($this->post[$field]) < 2 || strlen($this->post[$field]) > 100) {
			$this->setError($field, "{$this->label($field)} must be of 
							minimum 2 characters or maximum of 100 characters");
		} elseif(preg_match($pattern, $this->post[$field]) !== 1) {
			$this->setError($field, "Only alphabets, digits, apostrophe, space, 
							and character like (-_&\) are allowed 
							for {$this->label($field)}");
		}
	}

	/**
	 * Function to validate postal code
	 * @param  String $field A form field
	 * @return void
	 */
	public function postalCode($field)
	{
		$pattern = '/^[A-Z]\d[A-Z]\s?\d[A-Z]\d$/i';

		if(preg_match($pattern, $this->post[$field]) !== 1) {
			$this->setError($field, "Please enter valid {$this->label($field)}
									 eg:E8K2H7");
		}
	}

	/**
	 * Function to validate phone
	 * @param  String $field A form field
	 * @return void
	 */
	public function phone($field)
	{
		$pattern = '/^([0-9]{3})-?([0-9]{3})-?([0-9]{4})$/';

		if(preg_match($pattern, $this->post[$field]) !== 1) {
			$this->setError($field, 'Please enter a valid phone number');
		}
	}

	/**
	 * Function to validate email
	 * @param  String $field A form field
	 * @return void
	 */
	public function email($field)
	{
		if(strlen($this->post[$field]) > 100) {
			$this->setError($field, "{$this->label($field)} must be of 
										maximum 100 characters");
		} elseif(!filter_var($this->post[$field], FILTER_VALIDATE_EMAIL)) {
			$this->setError($field, 'Please provide a valid email address');
		}
	}

	/**
	 * Function to validate email for being unique
	 * @param  String  $field A form field
	 * @return void
	 */
	public function isEmailUnique($field)
	{
		// checking for unique email for registration
		// using global keyword to access db handle inside a function
		global $dbh;

		$query = 'SELECT email FROM users WHERE email = :email';

		$stmt = $dbh->prepare($query);

		$params = array(
			':email' => $this->post[$field]
		);

		$stmt->execute($params);

		$resultCount = $stmt->rowCount();

		if($resultCount > 0) {
			// Email already exists in database
			$this->setError($field, 'Email already exists. 
										Please try different email.');
		}
	}

	/**
	 * Function to validate password
	 * @param  String $field A form field
	 * @return void
	 */
	public function passwordValidator($field1, $field2)
	{
		$pattern = '/(?=.*[A-Z]+)(?=.*[a-z]+)(?=.*[0-9]+)(?=.*[\!\@\#\$\%\^\&\*\(\)]+).{6,}/';
		
		if(strlen($this->post[$field1]) < 6 || strlen($this->post[$field1]) > 20) {
			$this->setError($field1, "{$this->label($field1)} must be of minimum 
									6 characters or maximum of 20 characters");
		} elseif(preg_match($pattern, $this->post[$field1]) !== 1){
			$this->setError($field1, "Please enter valid {$this->label($field1)}. 
										It must consist of an uppercase letter, 
										a lower case letter, a digit, a special 
										character, and must be atleast 6 
										characters long.");
		} elseif($this->post[$field1] != $this->post[$field2]){
			$this->setError($field2, "{$this->label($field1)} and 
										{$this->label($field2)} does not match");
		}

	}

	/**
	 * Function to valid date format
	 * @param  String $field date
	 * @return void
	 */
	public function dateFormat($field)
	{
		// checks for YYYY-mm-dd format
		// first capture group: ([12]\d{3})
		// 		checks if year start with 1 or 2 and check for 3 more digits 
		// 		after to make a 4 digit year
		// second capture group: (0[1-9]|1[0-2])
		// 		checks if month start with 0 or 1 and allows values between 
		// 		01 to 12
		// third capture group: (0[1-9]|[12]\d|3[01])
		// 		checks if date starts with 0,1,2 or 3 and allows values between 
		// 		01 to 31
		$pattern = '/^(([12]\d{3})-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/';

		if(preg_match($pattern, $this->post[$field]) !== 1) {
			$this->setError($field, 'Please enter a valid date in following 
				structure eg: 2019-09-04');
		}
	}

	/**
	 * Function to validate that date is not from past
	 * @param  String $field date
	 * @return void
	 */
	public function dateNotFromPast($field)
	{
		// strtotime() converts date into the number of seconds 
		// since January 1 1970
		// time() returns the current time in the number of seconds 
		// since January 1 1970
		$entered_date = strtotime($this->post[$field]);
		$current_date = time();
		if ($entered_date < $current_date) {
		    $this->setError($field, 'Date should not be from past');
		}
	}

	/**
	 * Function to validate that to date is not less than from date
	 * @param  String $from from date
	 * @param  String $to   to date
	 * @return void
	 */
	public function toDateNotLessThanFromDate($from, $to)
	{
		$from_date = strtotime($this->post[$from]);
		$to_date = strtotime($this->post[$to]);
		if ($to_date < $from_date) {
		    $this->setError($to, 'To date should not be less than from date');
		}
	}

	/**
	 * Function to validate tour price
	 * @param  String $field price field
	 * @return void
	 */
	public function price($field)
	{
		$pattern = '/^((\d{1,3})(\.\d{1,2})?)$/';

		if(preg_match($pattern, $this->post[$field]) !== 1) {
			$this->setError($field, 'Price should be in following format 
							eg: 149 or 149.99 and not more than 
							total of 5 digits');
		}
	}

	/**
	 * Function to validate country length
	 * @param  String $field A form field
	 * @return void
	 */
	public function countryLength($field)
	{
		if(strlen($this->post[$field]) < 2 || strlen($this->post[$field]) > 20) {
			$this->setError($field, "{$this->label($field)} must be of minimum 
									2 characters or maximum of 20 characters");
		}
	}

	/**
	 * Function to validate fields which has varchar 255
	 * @param  String $field A form field
	 * @return void
	 */
	public function lengthForFullVarchar($field)
	{
		if(strlen($this->post[$field]) < 2 || strlen($this->post[$field]) > 255) {
			$this->setError($field, "{$this->label($field)} must be of minimum 2
									 characters or maximum of 255 characters");
		}
	}

	/**
	 * Function to validate for numbers only
	 * @param  Number $field A form field
	 * @return void
	 */
	public function numbersOnly($field)
	{
		$pattern = '/^[\d]+$/';

		if(preg_match($pattern, $this->post[$field]) !== 1) {
			$this->setError($field, "{$this->label($field)} must be only 
									numbers");
		}
	}

	/**
	 * Get validation errors
	 * @return Array
	 */
	public function getErrors()
	{
		return $this->errors;
	}

	/**
	 * Set validation errors
	 * @param String $field   A form field
	 * @param String $message An error message
	 */
	protected function setError($field, $message)
	{
		if(empty($this->errors[$field])) {
			$this->errors[$field] = $message;
		}
	}

	/**
	 * Converting name attribute value to more representable
	 * @param  String $string field name
	 * @return String         Formatted field name
	 */
	public function label($string) 
	{
		return ucwords(str_replace('_', ' ', $string));
	}

}