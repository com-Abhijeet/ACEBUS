<?php
      // Retrieve username from session
      session_start();
      $username = $_SESSION['username'];
      
      // Retrieve bus_id from URL parameter
        $bus_id = $_GET['bus_id'];

      function getPoints($username) {
    // Replace with your own database connection and query logic
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $dbname = "acebusDB";

    // Create connection
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query to get points
    $stmt = $conn->prepare("SELECT points FROM users_account  WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch points from result
    if ($row = $result->fetch_assoc()) {
      return $row['points'];
    } else {
      return 0;
    }

    // Close database connection
    $conn->close();
  }
  ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Bus Booking - Payment</title>
  <!-- Include CSS file -->
  <link rel="stylesheet" href="/ACEBUS/styles.css">

  <link rel="stylesheet" href="/css/pay.css">
  <script src="/ACEBUS/script.js" defer></script>

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

  <h1>Bus Booking - Payment</h1>
  <div class="container">
    <h2>Payment Details</h2>
    <?php
      
      // Query the database to get bus details based on bus_id
      // Replace with your own database connection and query logic
      $servername = "localhost";
      $username_db = "root";
      $password_db = "";
      $dbname = "acebusDB";

      // Create connection
      $conn = new mysqli($servername, $username_db, $password_db, $dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Prepare and execute the SQL query to get bus details
      $stmt = $conn->prepare("SELECT * FROM bus_schedule WHERE bus_id = ?");
      $stmt->bind_param("i", $bus_id);
      $stmt->execute();
      $result = $stmt->get_result();

      // Display bus details
      if ($row = $result->fetch_assoc()) {
        echo '
          <div class="busCard">
          <p><strong>Bus Name:</strong> ' . $row['bus_name'] . '</p>
          <p><strong>Bus Number:</strong> ' . $row['bus_no'] . '</p>
          <p><strong>Time:</strong> ' . $row['departure_time'] . '</p>
          <p><strong>Price:</strong> $' . $row['price'] . '</p>
          <p><strong>time:</strong> ' . date("h:i:sa") . '</p>
          </div>
        ';
        $bus_price = $row['price'];
      }

      // Close database connection
      $conn->close();
    ?>

      <div class="t-feilds">
    <form method="post" action="confirm.php?bus_id=' . $row['Bus_id'] .?bus_price= $row['price'] .'">
      <input type="hidden" id="bus_id" name="bus_id" value="<?php echo $bus_id; ?>">
      <input type="hidden" id="bus_price" name="bus_price" value="<?php echo $bus_price; ?>">
      <div class="feilds"><strong>Points available:</strong> <?php echo getPoints($username); ?></div>
      <div class="feilds"><strong>Points Required:</strong> <input type="number" name="points_to_use" min="0"value="<?php echo $row['price'] ?>" max="<?php echo getPoints($username); ?>"></div>
      <button type="submit">Confirm Booking</button>
    </form>
    </div>

</div>

<span class="pts1">
<img class="pts1" src="/ACEBUS/images/pointsimg.avif" alt="">
</span>

<span class="pts2">
<img class="pts2" src="/ACEBUS/images/pointsimg.avif" alt="">
</span>



</body>
</html>
