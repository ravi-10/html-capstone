<?php
	/**
     * Functions File 
     * last_update: 2019-08-08
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
        $_SESSION['flash'] = 'You have been successfully logged out.';
        header('Location: login.php');
        die;
	}