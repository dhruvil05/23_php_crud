<?php

// Database configuration
$host = 'localhost';
$db_name = '23_php_crud';
$username = 'root';
$password = '';

// Create a MySQLi connection
$mysqli = new mysqli($host, $username, $password, $db_name);

// Check the connection
if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}

// Set character set to utf8 (optional, depending on your application needs)
$mysqli->set_charset("utf8");
