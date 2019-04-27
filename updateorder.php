<?php 
    require 'mysqli_connection_oop.php';
	if (isset($_POST['add'])){	
        $tablenumber =$_POST['tablenumber'];
        $numberofguest = $_POST['numberofguest'];

        $query = "INSERT INTO `order` (number_of_guest, table_number, status) VALUES 
        	('$numberofguest', '$tablenumber', 'ongoing')";

        $result = $conn->query($query);
        $neworderid = $conn->insert_id;
        $query = "UPDATE `table` SET orderid = '$neworderid', number_of_guest = '$numberofguest' WHERE id = '$tablenumber'";
        $result = $conn->query($query);
        $data = json_decode($_POST['hiddenf']);
        foreach($data as $itemname => $quantity){
            $query = "SELECT id FROM `item` WHERE name = '$itemname'";
            $result = mysqli_fetch_assoc($conn->query($query));
            $itemid = $result['id'];
            $query = "INSERT INTO `order_contains_item` (orderid, itemid, itemname, quantity) VALUES ('$neworderid', '$itemid', '$itemname', '$quantity')";
            $result = $conn->query($query);
        }
        $query = "INSERT INTO `customer` (name) VALUES ('')";
        $result = $conn->query($query);
        $customerid = $conn->insert_id;
        $query = "UPDATE `order` SET customerid = $customerid WHERE id = $neworderid";
        $result = $conn->query($query); 
        $query = "INSERT INTO `bill` (orderid) VALUES ($neworderid)";
        $result = $conn->query($query);     
        $query = "UPDATE `bill` SET customerid = $customerid WHERE orderid = $neworderid";
        $result = $conn->query($query);
    }
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
?>