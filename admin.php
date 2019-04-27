<?php 
    session_start();
if ($_SESSION['username'] == 'admin'){
        include 'adminnav.php';
      }
      else{
        include 'nav.php'; 
      };
?>
<html>
<link rel="stylesheet" href="style.css">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Group 14 Design | Welcome</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="javascript.js"></script>  
</head>
<body>
	<div class="container">
        <h3>Table settings</h3>
        <a href='' class="nav-a">Add table</a>
        <a href='' class="nav-a">Delete table</a>   
    </div>
    <div class="container">
        <h3>Menu settings</h3>
        <a href='item.php' class="nav-a">Edit/Delete menu item</a>
        <a href='add_item.php' class="nav-a">Add menu item</a>   
    </div>
    <div class="container" style="margin-bottom: 100px;">
        <h3>User settings</h3>
        <a href='user.php' class="nav-a">Edit/Delete users</a>
        <a href='add_user.php' class="nav-a">Create user</a>
    </div>
	<footer>
      Group 14 Design, Copyright &copy; 2017
    </footer>
</body>
</html>