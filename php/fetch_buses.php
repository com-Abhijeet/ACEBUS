<html>
<head>
  <title>Bus Booking</title>
  <!-- Include CSS file -->
  <link rel="stylesheet" href="fetch_buses.css">
  <link rel="stylesheet" href="styles.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;1,700&display=swap" rel="stylesheet">
  <script src="script.js" defer></script>

  
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
  <h1>Book Your Bus</h1><hr>
  <div class="busavatar"><img src="/images/fbimig.avif" class="busavatar" alt=""></div>
  
  <div class="container">
    <br><hr>
    
    <div class="header-text">where to today?</div><hr>
    <form method="post" action="showbus.php">
      <label for="from">From:</label><br>
      <input type="text" id="from" name="from" placeholder="Enter source location"><br>
      <label for="where">Where:</label><br>
      <input type="text" id="where" name="where" placeholder="Enter destination location"><br>
      <button type="submit">Search Buses</button>
    </form>
  </div>

      <span class="lholder">
        <img class="lholder" src="/images/location.png" alt="">
      </span>
                <br>
      <span class="dholder">
        <img class="lholder" src="/images/destination.png" alt="">
      </span>

      
  <div id="busResults" class="container">
    <!-- <?php
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

            <h2>' . $row['bus_name'] . '</h2>
            <h2>' . $row['Bus_id'] . '</h2>
            <p>Bus Number: ' . $row['bus_no'] . '</p>
            <p>Type: ' . $row['bus_type'] . '</p>
            <p>Price: RS ' . $row['price'] . '</p>
            <p>route type: ' . $row['route_type'] . '</p>
            <a href="/ACEBUS/php/pay.php?bus_id=' . $row['Bus_id'] . '">Book ticket </a>
        </div>
        ';
    }
  // Close database connection
  $conn->close();
?> -->

</div>
</body>
</html>