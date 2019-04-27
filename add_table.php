<?php include 'nav.php'; ?>
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

    $id = "SELECT FLOOR(10000000000 + RAND() * 89999999999) AS random_number
    FROM `table`
    WHERE random_number NOT IN (SELECT id FROM `table`)
    LIMIT 1"; // Only works if there is an existing data (at least one)

    $q = "INSERT INTO `table` (id, orderid, number_of_guest) VALUES ('$id', NULL, NULL)";
    $r = @mysqli_query($dbc, $q);

    if ($r) { // If it ran OK.
      echo '<p>Table successfully registered.</p><br />';
      echo '<p><div><a href="tables.php">Back to List of Table</a></div> </p><br />';
    } else { // If it did not run OK.
      // Public message:
      echo '<h1>System Error</h1>
      <p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';

      // Debugging message:
      echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';

    } // End of if ($r) IF.
    mysqli_close($dbc); // Close the database connection.
    exit();

  }
?>

<form action="add_table.php" method="post">
  <div class="container">
    <h1>Add Table</h1>
  </div>
  <div><input type="submit" name="submit" value="Add Table"></div>
  <a href="tables.php" class="nav-a">Back to List of Item</a>
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
