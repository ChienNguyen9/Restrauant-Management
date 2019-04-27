<?php

DEFINE ('DB_USER', 'user');
DEFINE ('DB_PASSWORD', 'password');
DEFINE ('DB_HOST', '23.229.213.133');
DEFINE ('DB_NAME', 'restaurantmodel');
// Make the connection:
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
// Set the encoding...
mysqli_set_charset($dbc, 'utf8');
?>
