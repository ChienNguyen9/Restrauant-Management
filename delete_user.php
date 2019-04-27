<?php session_start();
if ($_SESSION['username'] == 'admin'){
        include 'adminnav.php';
      }
      else{
        include 'nav.php';
      }; ?>
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
        <div class="container">
          <h3>Delete User</h3>
        </div>


<?php

  // Check for a valid user ID, through GET or POST:
  if ( (isset($_GET['username'])) && (($_GET['username'])) ) {
    $username = $_GET['username'];
  } elseif ( (isset($_POST['username'])) && (($_POST['username'])) ) {
    $username = $_POST['username'];
  } else { // No valid ID, kill the script.
    echo '<p class="error">This page has been accessed in error adf.</p>';
    exit();
  }
  require ('mysqli_connection.php');

  // Check if the form has been submitted:
  if ($_SERVER['REQUEST_METHOD'] == 'POST') { // TODO: Add the AND STATEMENT for manager
    if ($_POST['sure'] == 'Yes') { // Delete the record.
      // Make the query:
      $q = "DELETE FROM user WHERE username='$username'";
      $r = @mysqli_query ($dbc, $q);
      if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
          // Print a message:
          echo '<p>The user has been deleted.</p>';
          echo '<a href="admin.php" class="nav-a">Back to Control Panel</a>';
      } else { // If the query did not run OK.
          echo '<p class="error">The user could not be deleted due to a system error.</p>'; // Public message.
      }
    } else { // No confirmation of deletion.
    echo '<p>The user has NOT been deleted.</p>';
    echo '<a href="admin.php" class="nav-a">Back to Control Panel</a>';
    }
  } else if(true) { // TODO: Add is it the manager
    // Retrieve the user's information:
    $query = "SELECT username FROM user WHERE username='$username'";
    $r = @mysqli_query ($dbc, $query);
    // echo $r;
    if (mysqli_num_rows($r) == 1) { // Valid user's ID, show the form.
      // Display the record being deleted:
      echo "Are you sure you want to delete this user?";
      // Create the form:
      echo '<form action="delete_user.php" method="post" id="delete_user_form">
          <input type="radio" name="sure" value="Yes" /> Yes
          <input type="radio" name="sure" value="No" checked="checked" /> No
          <input type="submit" name="submit" value="Submit" />
          <input type="hidden" name="username" value="' . $username . '" />
          </form>';
    } else { // Not a valid user ID.
      echo '<p class="error">This page has been accessed in error. Or you are not an Manager</p>';
    }
  } // End of the main submission conditional.
  mysqli_close($dbc);
?>

</center>
</html>
