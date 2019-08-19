<?php

// sql_autoload_register(function($class){
// code to locate and require the class file
// });

// \App\Validator
// __DIR__ . '/ravi/' . $class . '.php'

/**
 * Accept class name, convert to file path, require file
 * @param  String
 */
$autoload = function ($class){
	// Project base namespace
	$prefix = "App\\";

	// Base directory where my classes reside
	$base_dir = __DIR__ . '/classes/';

	// get the length of the prefix
	$len = strlen($prefix);

	// Test that class name passed in is using the prefix
	if(strncmp($prefix, $class, $len) !== 0) {
		return;
	}

	// Get the class minus the
	$sub_class = substr($class, $len);
	
	$file = $base_dir . str_replace('\\', '/', $sub_class) . '.php';
	//$file = $base_dir . $sub_class . '.php';

	if(file_exists($file)) {
		require $file;
	}

	//echo $file;
	//echo '<br />Done';

};

spl_autoload_register($autoload);

// test function
/*autoload1('App\\Validator');

$v = new App\Validator();

var_dump($v);*/