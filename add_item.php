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
        <?php

  // Check for form submission:
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('mysqli_connection.php');

    $errors = array(); // Initialize an error array.

    // Check for dish name
    if (!isset($_POST['name'])) {
      $errors[] = 'You forgot to enter the dish name.';
    } else {
      $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
    }

    // Check for the price
    if (!isset($_POST['price'])) {
      $errors[] = 'You forgot to enter the price.';
    } else {
      $price = mysqli_real_escape_string($dbc, trim($_POST['price']));
    }

    // Check for the description
    if (!isset($_POST['description'])) {
      $errors[] = 'You forgot to enter their description.';
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
      $id = "SELECT FLOOR(10000 + RAND() * 89999) AS random_number
      FROM item
      WHERE random_number NOT IN (SELECT id FROM item)
      LIMIT 1"; // Only works if there is an existing data (at least one)

      $q = "INSERT INTO item (name, price, description, type, id) VALUES ('$name', '$price', '$description', '$type', '$id')";
      $r = @mysqli_query($dbc, $q);

      if (!$r)
      {
        echo '<p>Something went wrong and cannot be inserted.</p>';
        echo '<p>1. Check if there is an existing dish name.</p>';
        mysqli_free_result ($r);
        mysqli_close($dbc); // Close the database connection.
        exit();  // Close the program
      }

      if ($r) { // If it ran OK.
        echo '<p>Dish item successfully registered.</p><br />';
        echo '<p><div><a href="item.php" class="nav-a">Back to List of Item</a></div> </p><br />';
      } else { // If it did not run OK.
        // Public message:
        echo '<h1>System Error</h1>
        <p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';

        // Debugging message:
        echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';

      } // End of if ($r) IF.

      mysqli_close($dbc); // Close the database connection.
      exit();

    } else { // Report the errors.

      echo '<h1>Error!</h1>
      <p class="error">The following error(s) occurred:<br />';
      foreach ($errors as $msg) { // Print each error.
        echo " - $msg<br />\n";
      }
      echo '</p><p>Please try again.</p><br />';

    }

    mysqli_close($dbc); // Close the database connection.
  }

?>

<form action="add_item.php" method="post" id="add_item_form">
  <div class="container">
    <h1>Add Item</h1>
  </div>
  <div class="container">
    
  </div>
  <div>
    <label for="name">Food Name</label>
  </div>
  <div>
    <input type="text" name="name" size="15" maxlength="20" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>" required>
  </div>

  <div>
    <label for="price">Price</label>
  </div>
  <div>
    <input type="number" step="0.01" name="price" size="15" maxlength="40" value="<?php if (isset($_POST['price'])) echo $_POST['price']; ?>" required>
  </div>

  <div>
    <label for="description">Description</label>
  </div>
  <div>
    <input type="text" name="description" size="20" maxlength="60" value="<?php if (isset($_POST['description'])) echo $_POST['description']; ?>" required>
  </div>

  <div>
    <label for="type">Type</label>
  </div>
  <div>
    <input type="text" name="type" size="15" maxlength="20" value="<?php 
    if (isset($_POST['type'])) {
      echo $_POST['type']; 
    }
    ?>" required>
  </div>

  <div><input type="submit" name="submit" value="Add"></div>
  <a href="item.php" class="nav-a">Back to List of Item</a>
</form>

        <!-- <div>
        <input type = "text" name="text" class="search" placeholder ="Search item by name...">
        <input type ="submit" name ="submit" class="submit" value="Search">
        </div> -->
    <footer>
      Group 14 Design, Copyright &copy; 2017
    </footer>
</body>
</center>
</html>

