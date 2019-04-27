<?php
	$username = "user";
    $password = "password";
    $host = "23.229.213.133";
    $db = "restaurantmodel";

    $conn = new mysqli($host, $username, $password, $db);

    if (mysqli_connect_error()){
        die("Connect failed: ". mysqli_connect_error());
        exit();
    }
?>