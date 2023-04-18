<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ACEBUS/css/showbus.css">
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script>
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
              <li><a href="book_pass.php">Book a pass</a></li>
              
              <li><a href="logout.php">Logout</a></li>
              <?php } else { ?>
              <li><a href="login.php">login</a></li>
              <?php } ?>
            </ul>
          </div>
        </nav>
    <h1>Available Buses</h1>
    
</body>
</html>
<?php
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
      // Retrieve "from" and "where" inputs from form submission
      $from = $_POST['from'];
      $where = $_POST['where'];}

      // Query the database to search for buses based on "from" and "where" inputs
      // Replace with your own database connection and query logic
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "acebusDB";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Prepare and execute the SQL query
      $stmt = $conn->prepare("SELECT * FROM bus_schedule WHERE end_point = ?");
      $stmt->bind_param("s", $where);
      $stmt->execute();
      $result = $stmt->get_result();

      // Display bus cards for each bus in the results
      while ($row = $result->fetch_assoc()) {
        echo '
          <div class="busCard">
        
            <h2>' . $row['bus_name'] . '  &nbsp' . $row['bus_no'] . ' </h2>
            <p>from: &nbsp<b>' . $row['start_point'].'</b> </p>
            <p> To: &nbsp<b>' . $row['end_point']. '</b></p>
            <p>Type: &nbsp<b>' . $row['bus_type'] . '</b></p>
            <p>Price: &nbspRS<b> ' . $row['price'] . '</b></p>
            <p>route type: &nbsp<b>' . $row['route_type'] . '</b></p>
            <a href="bus_location.php?bus_id=' . $row['Bus_id'] . '" class="button">Show Location </a>
            <a href="pay.php?bus_id=' . $row['Bus_id'] . '" class="button">Book ticket </a>
            
        </div>
        ';
    }
  // Close database connection
  $conn->close();
?>