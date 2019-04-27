<?php 
      session_start();
if ($_SESSION['username'] == 'admin'){
        include 'adminnav.php';
      }
      else{
        include 'nav.php'; 
      }; 

      require 'mysqli_connection_oop.php';
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
        <div id="newOrderModal">
            <span class="close">&times;</span>
            <form action="updateorder.php" method="POST" id="tableform">
              <input type="hidden" id="hiddenf" name="hiddenf" value="">
              Table Number: <input type="number" name="tablenumber" min="1" max="11" required>
              Number of Guest: <input type="number" name="numberofguest" min="1" required>
              Ordered Items:
              <select size=10 name="ordereditems" id="ordereditemsinput" multiple>
              <?php
                  $sql="SELECT * FROM `item` ORDER BY `type`";
                  $result = $conn->query($sql);
                  $prevtype = '';
                  $currtype = '';
                    while ($row = mysqli_fetch_array($result)){
                      $currtype = $row['type'];
                      if ($currtype != $prevtype){
                        echo '<optgroup label="'.$currtype.'"></optgroup>';
                      }
                      echo '<option onclick="newElement()">'.$row['name'].': '.$row['price'].'(id = '.$row['id'].')'.'</option>';
                      $prevtype = $row['type'];
                    }  
              ?>         
              </select>       
              <ul id="items">

              </ul>
              <input type="submit" name="add" id="submitNewOrder">

            </form>
        </div>
       
        <div class="container">
          <h3>Tables</h3>
        </div>
        
        <button id="newOrderBtn">add new order</button>

       <div class="tablebody">
        <table>
          <thead>
            <tr>
              <th>Table Number</th>
              <th>Order Number</th>
              <th>Number of Guest</th>
              <th>Details</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $counter = 0;
              $result = $conn->query("SELECT * FROM `table`");
              while ($row = mysqli_fetch_assoc($result)) {
              	$orderid = $row['id'];
              	$counter++;
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                if ($row['orderid']){
                    echo "<td>{$row['orderid']}</td>";
                    echo "<td>{$row['number_of_guest']}</td>";
                    echo "<td><form id='itemDetailForm' method='POST' action='table_ordered_item_detail.php'>
                    <input type='submit' id='tableOrderDetailBtn' value='details'>
                    <input type='hidden' name='tablenumber' value='$counter'>
                    <input type='hidden' name='orderid' value='{$row['orderid']}'>
                    </form></td>";
                }
                else {
                    echo "<td>-</td>";
                    echo "<td>-</td>";
                    echo "<td>-</td>";
                }   
                echo "</tr>\n";
              }
            ?>
          </tbody>
        </table>
        <?php $conn->close(); ?>
      </div>

    <footer>
      Group 14 Design, Copyright &copy; 2017
    </footer>

</body>
</center>

<html>
