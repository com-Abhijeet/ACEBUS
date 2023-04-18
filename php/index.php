<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>IndexPage</title>
    <link rel="stylesheet" href="/ACEBUS/styles.css">
    <link rel="stylesheet" href="index.css">
	<script src="/ACEBUS/script.js" defer></script>
    <!-- Add any CSS or JS libraries needed for Google Map integration -->
</head>
<body>
<nav class="navbar">
    <div class="brand-title">AceBUS</div>
        <a href="#" class="toggle-button">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </a>
        <div class="navbar-links">
            <ul>
            <?php if(isset($_SESSION["username"])) { ?>
              <li><a href="#">Welcome <?php echo $_SESSION["username"]; ?></a></li>
              <li><a href="#">Home</a></li>
              <li><a href="/ACEBUS/php/book_pass.php">Book a pass</a></li>
              
              <li><a href="logout.php">Logout</a></li>
              <?php } else { ?>
              <li><a href="login.php">login</a></li>
              <?php } ?>
            </ul>
    </div>
</nav>
<h1><a href="account.php"> Welcome,<?php echo $_SESSION["username"]; ?></a></h1>
<img src="/ACEBUS/images/indexbg.jpg" alt="" style="width:100%; height:max-content">
<div class="container">
  <div class="box"><a href="fetch_buses.php" > Search <br> Bus</a></div>
  <div class="box"><a href="book_pass.php"> Book <br> Pass</a></div>
  <div class="box"><a href="/php/index.php"> Book <br> Ticket</a> </div>
  <div class="box"><a href="account.php"> MY <br> Account</a></div>
</div>


</body>
</html>
