<?php
	/**
     * Functions File 
     * last_update: 2019-09-11
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */

	/**
	 * Escape string for output to HTML entity
	 * @param  string $string original value
	 * @return string         escaped value
	 */
	function esc($string)
	{
		return htmlentities($string, null, "UTF-8");
	}

	/**
	 * Escape string for output to HTML attribute
	 * @param  string $string original value
	 * @return string         escaped value
	 */
	function esc_attr($string)
	{
		return htmlentities($string, ENT_QUOTES, "UTF-8");
	}

	/**
	 * Dump variable using var_dump
	 * @param  Mixed $var
	 * @return void
	 */
	function dd($var)
	{
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}

	/**
	 * Return sanitied POST values
	 * @param  String $field $_POST field name
	 * @return String the sanitized value
	 */
	function clean($field)
	{
		if(!empty($_POST[$field])) {
			return esc_attr($_POST[$field]);
		} else {
			return '';
		}
	}

	/**
	 * Function to perform logout
	 * @return void
	 */
	function logout()
	{
		session_regenerate_id();
        unset($_SESSION['logged_in']);
        unset($_SESSION['role']);
        $_SESSION['flash'] = 'You have been successfully logged out.';
        $_SESSION['flash_class'] = 'flash-success';
        header('Location: login.php');
        die;
	}

	/**
	 * Constant for GST
	 */
	define("GST", 0.08);

	/**
	 * Constant for PST
	 */
	define("PST", 0.05);

	/**
	 * Function to calculate line total
	 * @param  Float $price    price
	 * @param  Integer $quantity quantity
	 * @return Float           line total
	 */
	function getLineTotal($price, $quantity)
	{
		return $price * $quantity;
	}

	/**
	 * Function to calculate GST
	 * @param  Float $price price
	 * @return Float        GST
	 */
	function getGST($price)
	{
		return $price * GST;
	}

	/**
	 * Function to calculate PST
	 * @param  Float $price price
	 * @return Float        PST
	 */
	function getPST($price)
	{
		return $price * PST;
	}

	/**
	 * Function to calculate Total
	 * @param  Float $price price
	 * @return Float        Total
	 */
	function getTotal($price)
	{
		return $price + getGST($price) + getPST($price);
	}