<?php
session_start();
date_default_timezone_set('Africa/Lagos');
// Define database
define('dbhost', 'localhost');
define('dbuser', 'root');
define('dbpass', '');
define('dbname', 'tms');

// Connecting database
try {
	$connect = new PDO("mysql:host=" . dbhost . "; dbname=" . dbname, dbuser, dbpass);
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo $e->getMessage();
}
