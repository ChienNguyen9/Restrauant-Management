<?php 
    if(empty($_SESSION))
        session_start();
    // if this login is the ever first login, unset any error message from previous sessions
    if(isset($_SESSION['errors']) && !isset($_SESSION['loginagain'])) {
        unset($_SESSION['errors']);
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
<body>
    <img src="images/showcase.jpg" style="width:100%;height:100%">
    <div class="centered">
    <!-- Login Form -->
    <form method="POST" action="login.php">
        <div class="container">
            <label>Username</label>
            <input type="text" placeholder="username = admin" name="username" required>
            <label>Password</label>
            <input type="password" placeholder="password = 123" name="password" required>   
            <?php
                if (isset($_SESSION['errors'])){
                    echo $_SESSION['errors'];
                    unset($_SESSION['loginagain']);
                }
            ?> 
            <button type="submit" name="submit" class="loginbtn">Login</button>
        </div>
    </form>
</div>

    <footer>
      Group 14 Design, Copyright &copy; 2017
    </footer>
</body>
</html>