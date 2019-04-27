<?php  
      session_start();
      if ($_SESSION['username'] == 'admin'){
        include 'adminnav.php';
      }
      else{
        include 'nav.php'; 
      }
      require 'mysqli_connection_oop.php';
?>
<!DOCTYPE html>
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
  <a href="tables.php" class="nav-a">Back to Tables</a>
	<?php
		  $tablenumber =  $_POST['tablenumber'];
  		$orderid =  $_POST['orderid'];
      if ($tablenumber && $orderid){
        $_SESSION['tablenumber'] = $tablenumber;
        $_SESSION['orderid'] = $orderid;
      }
      if (!$tablenumber && !$orderid){
        $tablenumber = $_SESSION['returntablenumber'];
        $orderid = $_SESSION['returnorderid'];
        unset($_SESSION['returntablenumber']);
        unset($_SESSION['returnorderid']);
      }   

		  echo "<div class='container'>
            <h3>Order# $orderid</h3>
            <h3>Table# $tablenumber</h3>
          </div>";
    ?>  
    <form action="" method="post">
      <a href="bill.php?id=<?php echo $orderid;?>&table=<?php echo $tablenumber; ?>" class="nav-a">Check out</a>
    </form>
  	<div class="tablebody">
  		<table class="table_order_table">
  			<thead>
  				<th>Item Name</th>
  				<th>Item Quantity</th>
          <th>Delete</th>
  			</thead>
  			<tbody>
  				<?php
  					$query = "SELECT * FROM `order_contains_item` WHERE orderid = $orderid";
  					$result = $conn->query($query);
  					while ($row = mysqli_fetch_assoc($result)) {
  						echo "<tr>";
  						echo "<td>{$row['itemname']}</td>";
  						echo "<td>{$row['quantity']}</td>";
              $itemid=$row['itemid'];
              echo "<td><a href='delete_order_item.php?id=$itemid&order=$orderid' onclick=\"return confirm('are you sure you want to delete??');\">Delete from this order</a></td>";
  						echo "</tr>\n";
  					}
  				?> 
  			</tbody>      
  		</table>
  	</div>
    <div class="table_order">
      <a class="nav-a" id="show_panel_btn" onclick="toggleshow()">Show Search Panel</a>
    </div>
    <div class="container" id="add_order_item_container">
      <a>Search Item by </a>
      <form method="post" action="" name="edit_order_form">
      <select name="searchtype" style="width: 10%;height: 5%">
        <option value="default">Select...</option>
        <option value="type">Type</option>
        <option value="name">Name</option>
        <option value="price">Price</option>  
      </select>
      <input type="text" placeholder="Enter keyword or leave it blank to return all the results..." name="keyword" style="width:55%">
      <input name="submit" type="submit" style="width: 30%">
      </form>
      <table>
        <thead>
          <th>Item Name</th>
          <th>Price</th>
          <th>Description</th>
          <th>Type</th>
          <th>Add</th>
        </thead>
        <tbody>
          <?php   
              if ($_POST['searchtype'] == 'default' || $_POST['searchtype'] == null){
                  $query = "SELECT * FROM `item` ORDER BY type";
                  echo "Returning all the items in the database. Please select a category to search by.";
              }
              else {
                  if ($_POST['searchtype'] != 'default' && $_POST['keyword'] != ""){
                      $searchtype = $_POST['searchtype'];
                      $keyword = $_POST['keyword'];
                      $query = "SELECT * FROM `item` WHERE ".$searchtype." = '".$keyword."'";
                  }
                  else if ($_POST['searchtype'] != 'default' && $_POST['keyword'] == ""){
                      $searchtype = $_POST['searchtype'];
                      $query = "SELECT * FROM `item` ORDER BY $searchtype";
                  }
              }
              $result = $conn->query($query);
              if ($result->num_rows == 0)
                echo "No result returned.";
              while ($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['price']}</td>";
                echo "<td>{$row['description']}</td>";
                echo "<td>{$row['type']}</td>";
                $itemid = $row['id'];
                echo "<td><a href='add_order_item.php?id=$itemid&order=$orderid'>Add</a></td>";
                echo "</tr>\n";
              }
              $_SESSION['returntablenumber'] = $_SESSION['tablenumber'];
              $_SESSION['returnorderid'] = $_SESSION['orderid'];
          ?>
        </tbody>
      </table>
    </div>
    
    <footer>
      Group 14 Design, Copyright &copy; 2017
    </footer>
</body>
</html>