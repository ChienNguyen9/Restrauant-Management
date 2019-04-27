<?php
	if(empty($_SESSION)) // if the session not yet started 
        session_start();
    $user = $_SESSION['username'];
?>

<link rel="stylesheet" type="text/css" href="style.css">
<nav class="navbar">
    <ul>
      <?php
      	echo "<li><a>Hi, $user!</a></li>";
      ?>
      <!-- <li><a href="/admin.php">Control Panel</a></li> -->
      <li><a href="/tables.php">Tables</a></li>
      <!-- <li><a href="/#">Orders</a></li>
      <li><a href="/#">Bills</a></li>
      <li><a href="/#">Report</a></li>
      <li><a href="/settings.php">Settings</a></li> -->
      <li class="navlogouticon"><a href="logout.php">Log out</a></li>
    </ul>
</nav>