<?php
	require 'mysqli_connection_oop.php';
	session_start();
  	if ($_SESSION['username'] == 'admin'){
        include 'adminnav.php';
      }
      else{
        include 'nav.php'; 
      };
    
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title>Group 14 Design | Welcome</title>
</head>
<body>
	<div class="container">
		<a href='admin.php' class="nav-a">Back to Control Panel</a>
	</div>
	<div class="container">
		<h3>Create user</h3>
	</div>
	<form method='post' action='add_user.php' style="text-align: center;">
		<div>create a username:</div>
		<input type="text" placeholder="username" style="width: 70%" required>
		<div>create a password:</div>
		<input type="text" placeholder="password" style="width: 70%" required>
		<div>select a user type: </div>
		<select name="usertype" style="display:block;width: 50%;margin:auto;margin-top: 10px;">
			<option value="admin">admin</option>
			<option value="user">user</option>
		</select>
		<input type="submit" name="adduser">
	</form>
	<!-- <?php
		if (isset($_POST['adduser'])){
			$type = $_POST['usertype'];
			
		}
	?> -->
		
	


</body>
</html>