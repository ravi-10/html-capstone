<?php
/**
 * Validator Class Page 
 * last_update: 2019-08-19
 * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
 */

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
			$this->setError($field, "Only alphabets, apostrophe and space allowed for {$this->label($field)}");
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
			$this->setError($field, "{$this->label($field)} must be of minimum 2 characters or maximum of 50 characters");
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