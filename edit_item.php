<?php session_start();
if ($_SESSION['username'] == 'admin'){
        include 'adminnav.php';
      }
      else{
        include 'nav.php';
      } ?>
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
          <h3>Edit Item</h3>
        </div>
        <?php
  require('mysqli_connection.php');

  // Check for a valid menu's id, through GET or POST:
  if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) {
    $id = $_GET['id'];
  } elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
    $id = $_POST['id'];
  } else { // No valid id, kill the script.
    echo '<p class="error">This page has been accessed in error.</p>';
    exit();
  }

  // Check if the form has been submitted:
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = array();

    // Check for a dish name:
    if (!isset($_POST['name'])) {
      $errors[] = 'You forgot to enter your dish name.';
    } else {
      $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
    }

    // Check for a price:
    if (!isset($_POST['price'])) {
      $errors[] = 'You forgot to enter your price.';
    } else {
      $price = mysqli_real_escape_string($dbc, trim($_POST['price']));
    }

    // Check for an description:
    if (!isset($_POST['description'])) {
      $errors[] = 'You forgot to enter your description.';
    } else {
      $description = mysqli_real_escape_string($dbc, trim($_POST['description']));
    }

    // Check for type:
    if (!isset($_POST['type'])) {
      $errors[] = 'You forgot to enter your type.';
    } else {
      $type = mysqli_real_escape_string($dbc, trim($_POST['type']));
    }

    if (empty($errors)) { // If everything's OK.

      //  Test for unique name/ id:
      $q = "SELECT id FROM item WHERE name='$name' AND id != $id";
      $r = @mysqli_query($dbc, $q);
      if (mysqli_num_rows($r) == 0) {
        // Make the query:
        $q = "UPDATE item SET name='$name', price='$price', description='$description', type='$type' WHERE id=$id LIMIT 1";
        $r = @mysqli_query ($dbc, $q);
        if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
          // Print a message:
          echo '<p>The item has been edited.</p>';
        } else { // If it did not run OK.
          echo '<p class="error">The item could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
          echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
        }
      } else { // Already registered.
        echo '<p class="error">The item has already been registered.</p>';
      }

    } else { // Report the errors.

      echo '<p class="error">The following error(s) occurred:<br />';
      foreach ($errors as $msg) { // Print each error.
        echo " - $msg<br />\n";
      }
      echo '</p><p>Please try again.</p>';

    } // End of if (empty($errors)) IF.
  } // End of submit conditional.

  // Retrieve the item's information:
  $q = "SELECT name, price, description, type FROM item WHERE id=$id";
  $r = @mysqli_query ($dbc, $q);
  if (mysqli_num_rows($r) == 1) { // Valid item ID, show the form.
    // Get the item's information:
    $row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
    // Create the form:
    echo '<form action="edit_item.php" method="post" id="edit_item_form">
        <div><label>Food Name:</label></div>
        <input type="text" name="name" size="15" maxlength="15" value="' . $row['name'] . '" />
        <div><label>Price:</label></div>
        <input type="number" step="0.01" name="price" size="15" maxlength="30" value="' . $row['price'] . '" />
        <div><label>Description:</label></div>
        <input type="text" name="description" size="50" maxlength="40" value="' . $row['description'] . '"  />
        <div><label>type:</label></div>
        <input type="text" name="type" size="20" maxlength="40" value="' . $row['type'] . '"  />
        <input type="submit" name="submit" value="update" />
        <input type="hidden" name="submitted" value="TRUE" />
        <input type="hidden" name="id" value="' . $id . '" />
        <a href="item.php" class="nav-a">Back to List of Item</a>
        </form>';
    } else { // Not a valid item ID.
    echo '<p class="error">This page has been accessed in error.</p>';
  }
  mysqli_close($dbc);
?>



        <footer>
          Group 14 Design, Copyright &copy; 2017
        </footer>
</body>
</center>
</html>
