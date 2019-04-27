<?php
session_start();
if ($_SESSION['username'] == 'admin'){
        include 'adminnav.php';
      }
      else{
        include 'nav.php'; 
      };

	  if ((isset($_GET['id'])) && (is_numeric($_GET['id'])) && isset($_GET['order']) && is_numeric($_GET['order'])) {
	    $id = $_GET['id'];
	    $order = $_GET['order'];
	  }
	  require ('mysqli_connection_oop.php');
	  $query = "SELECT * FROM `order_contains_item` WHERE orderid = '$order' AND itemid = '$id'";
	  $result = $conn->query($query);
	  if ($result->num_rows == 0){
	  	$query = "INSERT INTO `order_contains_item` (orderid, itemid, quantity) VALUES ('$order', '$id', 1);";
	  	$query .= "UPDATE `order_contains_item` SET itemname = (SELECT name FROM `item` WHERE `item`.id = '$id') WHERE orderid = '$order' AND itemid = '$id'";
	  	$result = $conn->multi_query($query);
	  }
	  else {
	  	$query = "UPDATE `order_contains_item` SET quantity = quantity + 1 WHERE orderid = '$order' AND itemid = '$id'";
	  	$result = $conn->query($query);
	  }
	  
	  $_SESSION['returntablenumber'] =  $_SESSION['tablenumber'];
	  $_SESSION['returnorderid'] = $_SESSION['orderid'];
	  
?>
<script type="text/javascript">
	window.location.href = 'table_ordered_item_detail.php';
</script>