<?php
	require 'mysqli_connection_oop.php';
	$orderid = $_GET['orderid'];
	$table = $_GET['table'];
	$query = "UPDATE `order` SET status = 'clear' WHERE id = $orderid";
	$result = $conn->query($query);
	$query = "UPDATE `table` SET orderid = null WHERE id = $table";
	$result = $conn->query($query);
	$query = "UPDATE `table` SET number_of_guest = null WHERE id = $table";
	$result = $conn->query($query);
?>
<script type="text/javascript">
	window.location.href = 'bill.php?order_id=<?php echo $orderid;?>&tablenum=<?php echo $table;?>';
</script>