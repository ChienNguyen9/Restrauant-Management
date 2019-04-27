<?php
  include 'nav.html';
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Group 14 Design | Welcome</title>

</head>
<center>
<body>
	<img src="images/Home3.jpg" style="width:100%;height:60%;object-fit:cover">
        &nbsp; <br>
        &nbsp; <br>
        <div class="container">
          <h3>* Restaurant's Customers</h3>
        </div>
        &nbsp; <br>
        &nbsp; <br>
        <div>
        <input type = "text" name="text" class="search" placeholder ="Search customer by Date...">
        <input type ="submit" name ="submit" class="submit" value="Search">
        </div>
         &nbsp; <br>
        &nbsp; <br>
</body>
</center>
</html>

<?php

  require('mysql_connection.php');

  // Check for a valid customer ID, through GET or POST:
  if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) {
  	$competitor_id = $_GET['id'];
  } elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
  	$competitor_id = $_POST['id'];
  } else { // No valid ID, kill the script.
  	echo '<p class="error">There was an issue reading the ID = '. $competitor_id.'</p>';
  	include ('includes/footer.html');
  	exit();
  }


?>
