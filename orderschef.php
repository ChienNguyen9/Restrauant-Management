<?php
      include 'nav.html';

        $username = "user";
        $password = "password";
        $host = "23.229.213.133";
        $db = "restaurantmodel";

        $conn = new mysqli($host, $username, $password, $db);

        if (mysqli_connect_error()){
            die("Connect failed: ". mysqli_connect_error());
            exit();
        }
?>

<html>
    <link rel="stylesheet" href="style.css">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Group 14 Design | Welcome</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="javascript.js"></script>
</head>
<center>
<body>
<?php
      include(mysqli_connection.php);

      $sqlget = "SELECT * FROM restaurantmodel.order_contains_item";
      $sqldata = mysqli_query($dbcon, $sqlget) or die('error getting data');

      echo "<table>";
      echo "<tr><th>ORDER ID</th><th>ITEM ID</th><th>QUANTITY</th><th>ITEM NAME</th><th>STATUS OF ORDER</th>";

      $status = "SELECT status FROM restaurantmodel.order_contains_item";

      while(($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) && $status == 'new'){
            echo "<tr><td>";
            echo $row['orderid'];
            echo "</td><td>";
            echo $row['itemid'];
            echo "</td><td>";
            echo $row['quantity'];
            echo "</td><td>";
            echo $row['itemname'];
            echo "</td><td>";
            echo $row['status'];
            echo "</td><td>";
            echo "<td><form id='itemREADYForm' method='POST' action='order_ready.php'>
            <input type='submit' id='tableOrderReadyBtn' value='READY!'>
            </form></td>";
          }

      echo "</table>";

?>
       <footer>
         Group 14 Design, Copyright &copy; 2017
       </footer>

   </body>
   </center>

   <html>
