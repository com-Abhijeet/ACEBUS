<?php
$username = '';
require_once('/xampp/htdocs/ACEBUS/php/functions.php');
// Function to get user details from XAMPP MySQL database
function getDetails() {
    session_start();
$username = $_SESSION['username'];
  // Create a MySQL connection
  $conn = new mysqli("localhost", "root", "", "acebusDB"); // Replace your_database_name with your actual database name

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }


  // Prepare and execute a SQL query to fetch user details
  $stmt = $conn->prepare("SELECT name, username, email FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  // Fetch user details from the query result
  $userDetails = $result->fetch_assoc();

  // Close the database connection
  $conn->close();

  return $userDetails;
}

$userDetails = getDetails($username);

// Display user details on the screen
// if (!empty($userDetails)) {
//   echo "Name: " . $userDetails['name'] . "<br>";
//   echo "Username: " . $userDetails['username'] . "<br>";
//   echo "Email: " . $userDetails['email'] . "<br>";
// } else {
//   echo "User not found.";
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ACEBUS/css/account.css">
    <link rel="stylesheet" href="/ACEBUS/styles.css">
    <script src="/ACEBUS/script.js" defer></script>
    <title>Document</title>
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
<h1>Account-Details</h1>
    <div>
    <img class="avatar" src="https://cdn-icons-png.flaticon.com/512/147/147144.png" alt="">
    <p class="fld">Username:<span class="ufld"><?php echo $userDetails['username'];  ?></span></p>
    <p class="fld">Name:<span class="ufld"><?php echo $userDetails['name'];  ?></span></p>
    <p class="fld">Email:<span class="ufld"><?php echo $userDetails['email'];  ?></span></p>
    <p class="fld">Points:<span class="ufld"><?php echo getPoints($userDetails['username']);  ?></span></p>
    
    </div>
<button class="button">
    <a href=" ">Add points</a>
</button>
    
</body>
</html>
