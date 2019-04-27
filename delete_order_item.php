<?php
	session_start();
if ($_SESSION['username'] == 'admin'){
        include 'adminnav.php';
      }
      else{
        include 'nav.php'; 
      };

	  if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) && isset($_GET['order']) && is_numeric($_GET['order'])) {
	    $id = $_GET['id'];
	    $order = $_GET['order'];
	  }
	  require ('mysqli_connection_oop.php');
	  $query = "DELETE FROM `order_contains_item` WHERE orderid = $order AND itemid = $id";
	  $result = $conn->query($query);
	  $_SESSION['returntablenumber'] =  $_SESSION['tablenumber'];
	  $_SESSION['returnorderid'] = $_SESSION['orderid'];
?>
<script type="text/javascript">
	window.location.href = 'table_ordered_item_detail.php';
</script>