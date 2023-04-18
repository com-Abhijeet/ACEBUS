<!DOCTYPE html>
<html>
<head>
  <title>Bus Booking - Success</title>
  <!-- Include CSS file -->
  <link rel="stylesheet" href="/ACEBUS/css/styles.css">
  <script src="/ACEBUS/script/script.js" defer ></script>
  <link rel="stylesheet" href="/ACEBUS/css/success.css">
  <script src="/ACEBUS/scripts/confetti.js" defer></script>
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
  <h1>Bus Booking - Success</h1>
  <div class="container">
    <h2>Booking Details</h2>
    <?php
      require_once('/xampp/htdocs/ACEBUS/php/functions.php');
      session_start();
      $username = $_SESSION['username'];
      // Retrieve bus_id from URL parameter
      $bus_id = $_GET['bus_id'];

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
          <div class="busCard" id="html-content-holder">
          <p><strong>Bus Name:</strong> ' . $row['bus_name'] . '</p>
          <p><strong>Bus Number:</strong> ' . $row['bus_no'] . '</p>
          <p><strong>Location:</strong> ' . $row['start_point'] . '</p>
          <p><strong>Destination:</strong> ' . $row['end_point'] . '</p>
          <p><strong>Date Booked:</strong> ' . date("d-m-y") . '</p>
          </div>
        ';
      }

      // Close database connection
      $conn->close();
    ?>
    
    <p class="message">Your ticket has been booked successfully!</p>
    <p class="accmsg">your current account balance is :<?php echo getPoints($username) ?> Points</p>
    <button><a href="index.php">Done</a></button>
  </div>

  <script>
    function download(){
    $(document).ready(function(){

	
var element = $("#html-content-holder"); // global variable
var getCanvas; // global variable
$("#btn-Preview-Image").on('click', function () {
         html2canvas(element, {
         onrendered: function (canvas) {
                $("#previewImage").append(canvas);
                getCanvas = canvas;
             }
         });
    });


	$("#btn-Convert-Html2Image").on('click', function () {
    var imgageData = getCanvas.toDataURL("image/jpeg");
    // Now browser starts downloading it instead of just showing it
    var newData = imgageData.replace(/^data:image\/jpeg/, "data:application/octet-stream");
    $("#btn-Convert-Html2Image").attr("download", "your_pic_name.png").attr("href", newData);
	});

});
    }
  </script>
</body>
</html>
