<?php
session_start();
    if ($_SESSION['username'] == 'admin'){
        include 'adminnav.php';
      }
      else{
        include 'nav.php'; 
      }
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
    <div id="container">
        <div id="column-left">
            <a href="item.php" class="nav-a">Menu settings</a>
        </div>
        <div id="column-center">
            <a href="/#" class="nav-a">User settings</a>
        </div>
        <div id="column-right">
            <a href="/#" class="nav-a">User settings</a>
        </div>

    </div>

    <footer>
      Group 14 Design, Copyright &copy; 2017
    </footer>
</body>
</html>