<?php
	require 'mysqli_connection_oop.php';
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
	<body>
		<div class="container">
			<a href='admin.php' class="nav-a">Back to Control Panel</a>
		</div>
		<div class="container">
			<h3>List of Users</h3>
		</div>
		<table>
			<thead>
				<th>Username</th>
				<th>User Type</th>
				<th>Edit</th>
				<th>Delete</th>
			</thead>
			<tbody>
			<?php
				$query = "SELECT * FROM `user`";
    			$result = $conn->query($query);
			    while ($row = mysqli_fetch_assoc($result)) {
			    	echo "<tr>";
			    	echo "<td>{$row['username']}</td>";
			    	echo "<td>{$row['type']}</td>";
						echo '<td><a href="edit_user.php?username=' . $row['username'] . '" class="nav-a-intable">Edit</a></td>';
			      echo '<td><a href="delete_user.php?username=' . $row['username'] . '" class="nav-a-intable">Delete</a></td>';
			    	echo "</tr>";
			    }
			?>
			</tbody>
		</table>



</body>
	</html>
