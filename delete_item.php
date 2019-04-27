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
          <h3>Delete Item</h3>
        </div>

        <?php

  // Check for a valid item ID, through GET or POST:
  if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) {
    $id = $_GET['id'];
  } elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) {
    $id = $_POST['id'];
  } else { // No valid ID, kill the script.
    echo '<p class="error">This page has been accessed in error.</p>';
    exit();
  }
  require ('mysqli_connection.php');
  // Check if the form has been submitted:
  if ($_SERVER['REQUEST_METHOD'] == 'POST') { // TODO: Add the AND STATEMENT for manager
    if ($_POST['sure'] == 'Yes') { // Delete the record.
        // Make the query:
        $q = "DELETE FROM item WHERE id=$id";
        $r = @mysqli_query ($dbc, $q);
        if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
            // Print a message:
            echo '<p>The item has been deleted.</p>';
            echo '<a href="item.php" class="nav-a">Back to List of Item</a>';
        } else { // If the query did not run OK.
            echo '<p class="error">The item could not be deleted due to a system error.</p>'; // Public message.
        }
    } else { // No confirmation of deletion.
        echo '<p>The item has NOT been deleted.</p>';
        echo '<a href="item.php" class="nav-a">Back to List of Item</a>';
    }
  } else if(true) { // TODO: Add is it the manager
    // Retrieve the item's information:
    $q = "SELECT name FROM item WHERE id=$id";
    $r = @mysqli_query ($dbc, $q);
    if (mysqli_num_rows($r) == 1) { // Valid item's ID, show the form.
        // Get the user's information:
        $row = mysqli_fetch_array ($r, MYSQLI_NUM);
        // Display the record being deleted:
        echo "Are you sure you want to delete this Food?";
        // Create the form:
        echo '<form action="delete_item.php" method="post" id="delete_item_form">
            <input type="radio" name="sure" value="Yes" /> Yes
            <input type="radio" name="sure" value="No" checked="checked" /> No
            <input type="submit" name="submit" value="Submit" />
            <input type="hidden" name="id" value="' . $id . '" />
            </form>';
    } else { // Not a valid user ID.
        echo '<p class="error">This page has been accessed in error. Or you are not an Manager</p>';
    }
  } // End of the main submission conditional.
  mysqli_close($dbc);
?>

</center>
</html>

