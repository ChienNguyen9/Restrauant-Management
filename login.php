<?php 
    require('mysqli_connection_oop.php');
	if(empty($_SESSION)) // if the session not yet started 
        session_start();

    $user = $_POST['username'];
    $passwd = $_POST['password'];
    // retreive records from db with input username and password
    $query = "SELECT * FROM `user` WHERE username = '$user' AND password = '$passwd'";
    $result = $conn->query($query);
    // if retreiving fails then login is invalid, set $_SESSION error message and return to home page
    if (!$result || $result->num_rows == 0) {
        $_SESSION['errors'] = "Wrong username or password.";
        $_SESSION['loginagain'] = 1;
        header("Location: home.php");
    }
    // if login is valid, redirect to admin home page/user home page
    else {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $user;
        if ($row['type'] == 'admin') {
        	header("Location: admin.php");
        }
        else {
        	header("Location: tables.php");
        }
    }
?>