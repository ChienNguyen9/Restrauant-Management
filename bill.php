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
    require('mysqli_connection_oop.php');

    if(isset($_GET['id']))
    {
    	$order_id = $_GET['id'];
      $table = $_GET['table'];
    }
      if (!$table && !$order_id){
        $table = $_GET['tablenum'];
        $order_id = $_GET['order_id'];
      }  
      $query = "UPDATE `bill` SET total = (SELECT sum(quantity * price) AS subtotal FROM (SELECT oci.orderid, oci.itemid, oci.itemname, oci.quantity, it.price FROM `order_contains_item` oci LEFT JOIN `item` it ON oci.itemid = it.id WHERE oci.orderid = $order_id) as newtable) WHERE orderid = $order_id";
      $result = $conn->query($query);
      $query = "UPDATE `bill` SET quantity = (SELECT sum(quantity) FROM `order_contains_item` WHERE orderid = $order_id) WHERE orderid = $order_id";
      $result = $conn->query($query);
      $query = "UPDATE `order` SET total = (SELECT total FROM `bill` WHERE orderid = $order_id) WHERE id = $order_id";
      $result = $conn->query($query);
      $query = "UPDATE `order` SET quantity = (SELECT quantity FROM `bill` WHERE orderid = $order_id) WHERE id = $order_id";
      $result = $conn->query($query);
      $query = "SELECT bill.id, bill.orderid, bill.quantity, bill.total, bill.customerid, `order`.status FROM bill LEFT JOIN `order` ON bill.orderid = `order`.id WHERE bill.orderid = $order_id";
      $result = $conn->query($query);
    
  ?>  
  <div class="container">
    <h3>Bill for Order # <?php echo $order_id;?></h3>
    <h3>Table #<?php echo $table;?></h3>
  </div>
      <table>
        <thead>
          <th>Bill Id</th>
          <th>Order Id</th>
          <th>Number of Items</th>
          <th>Total</th>
          <th>Customer Id</th>
          <th>Status</th>
        </thead>
        <tbody>
      <?php
      while ($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['orderid']}</td>";
        echo "<td>{$row['quantity']}</td>";
        echo "<td>{$row['total']}</td>";
        echo "<td>{$row['customerid']}</td>";
        echo "<td>{$row['status']}</td>";
        echo "</tr>";
      }
      ?>
        </tbody>
      </table>
      <div class="container">
        <a href='pay.php?orderid=<?php echo $order_id;?>&table=<?php echo $table;?>' class="nav-a">Pay</a>
        <a href='clearorder.php?orderid=<?php echo $order_id;?>&table=<?php echo $table;?>' class="nav-a">Clear Order</a>
      </div>
      <?php
        mysqli_close($conn);
      ?>

    <footer>
      Group 14 Design, Copyright &copy; 2017
    </footer>
</body>
</center>
</html>