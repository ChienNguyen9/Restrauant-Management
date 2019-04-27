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
  	$id = $_GET['id'];
  } else if ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
  	$id = $_POST['id'];
  } else { // No valid ID, kill the script.
  	echo '<p class="error">This page has been accessed in errors.</p>';
  	exit();
  }

  // Check if the form has been submitted:
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  	$errors = array();

  	if (!isset($_POST['name'])) {
  		$errors[] = 'You forgot to enter the name.';
  	} else {
  		$name = mysqli_real_escape_string($dbc, trim($_POST['name']));
  	}

  	if (empty($errors)) { // If everything's OK.
  		$q = "SELECT name
  			FROM customer";
  		$r = @mysqli_query($dbc, $q);
  		if (mysqli_num_rows($r) == 0) {
  			$row = mysqli_fetch_array($r, MYSQLI_ASSOC);
  			$id = $row['id'];
  			mysqli_free_result ($r);
  			// Make the query:

  			// update customer
  			$q = "UPDATE customer
  				SET name='$name'
  				WHERE customer.id=$id
  				LIMIT 1";
  			$r = @mysqli_query ($dbc, $q);
  			if (mysql_affected_rows($dbc) == 0 || mysqli_affected_rows($dbc) == 1) { // if no row updated, or only 1 row
  				// Print a message:
  				echo '<p>The customer has been edited.</p>';
  			} else { // If it did not run OK.
  				echo '<p class="error">The customer could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
  			}
  			mysqli_free_result ($r);
  		} else { // Already registered.
  			echo '<p class="error">The name has already been registered.</p>';
  		}
  	} else { // Report the errors.
  		echo '<p class="error">The following error(s) occurred:<br />';
  		foreach ($errors as $msg) { // Print each error.
  			echo " - $msg<br />\n";
  		}
  		echo '</p><p>Please try again.</p>';
  	} // End of if (empty($errors)) IF.
  } // End of submit conditional.
  // Always show the form...
  // Retrieve the customer's information:
  $q = "SELECT name, id
  	FROM customer
  	WHERE customer.id=$id";
  $r = @mysqli_query ($dbc, $q);
  if (mysqli_num_rows($r) == 1) { // Valid customer ID, show the form.
  	// Get the customer's information:
  	$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
  	// Create the form:
  	echo '<div>Editing ' . $row['name'] . '</div>';
  	echo '<form action="customer_edit.php?id=' . $id .'" method="post">
  	<div>
  		<label for="Name">Name</label>
  	</div>
  	<div>
  		<input type="text" name="Name" size="20" maxlength="60" value="' . $row['name'] . '" required>
  	</div>
  	<div><input type="submit" name="submit" value="Update"></div>
  </form>';
  } else { // Not a valid customer ID.
  	echo '<p class="error">This page has been accessed in error.</p>';
  }
  mysqli_close($dbc);
?>
