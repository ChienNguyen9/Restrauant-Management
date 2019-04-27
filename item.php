<?php 
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
<center>
<body>
    <?php
        require('mysqli_connection.php');

    // Define the query:
    $q = "SELECT name, price, description, id, type FROM item ORDER BY type";
    $r = @mysqli_query ($dbc, $q); // Run the query.
    ?>
    <div class="container">
      <a href='admin.php' class="nav-a">Back to Control Panel</a>
    </div>
    <div class="container">
          <h3>List of Item</h3>
    </div>
    <a href="add_item.php" class="nav-a">Add Dish</a>
<?php
    // Table header:
    echo '<table>
    <thead>';
      echo '
      <th>Name</th>
      <th>Price</th>
      <th>Description</th>
      <th>Type</th>';
      // TODO: Add if statement for manager
      echo '<th>Edit</th>
      <th>Delete</th>';
      echo '</thead>';

    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
      echo '<tr>';
        echo '
        <td>' . $row['name'] . '</td>
        <td>' . $row['price'] . '</td>
        <td>' . $row['description'] . '</td>
        <td>' . $row['type'] . '</td>';
      // TODO: Add if statement for manager
        echo '
      <td><a href="edit_item.php?id=' . $row['id'] . '" class="nav-a-intable">Edit</a></td>
      <td><a href="delete_item.php?id=' . $row['id'] . '" class="nav-a-intable">Delete</a></td>';
      echo '
      </tr>';
    }

    echo '</table>';
    mysqli_free_result ($r);
    mysqli_close($dbc);

?>

<footer>
      Group 14 Design, Copyright &copy; 2017
    </footer>
        <!-- <form>
          <input type = "text" name="text" class="search" placeholder ="Search item by name...">
          <input type ="submit" name ="submit" class="submit" value="Search">
        </form> -->
</body>
</center>
</html>


