<?php
        // Database configuration
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

        // Prepare SQL statement to retrieve bus names from database
        $sql = "SELECT DISTINCT bus_name FROM bus_schedule";
        $result = $conn->query($sql);

        

        // Close database connection
        $conn->close();
        ?>

<!DOCTYPE html>
<html>
<head>
	<title>Bus Subscription Booking Form</title>
    <link rel="stylesheet" href="/ACEBUS/styles.css">
    <script src="/ACEBUS/script.js" defer></script>
	<link rel="stylesheet" href="/ACEBUS/css/book_pass.css">
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
            <li><a href="/ACEBUS//php/index.php">Home</a></li>
            <li><a href="#">support</a></li>
            <li><a href="/ACEBUS/login.php">login</a></li>
          </ul>
        </div>
      </nav>
	<h1>Bus Pass Subscription</h1>
	<form action="/ACEBUS/php/Payment_page.php" method="post">
		<label for="location">Location:</label>
		<input type="text" id="location" name="location" required>

		<label for="destination">Destination:</label>
		<input type="text" id="destination" name="destination" required>

		<label for="duration">Duration:</label>
		<select id="duration" name="duration" required>
			<option value="">Choose duration</option>
			<option value="1">1 month</option>
			<option value="2">2 months</option>
			<option value="3">3 months</option>
		</select>

		<label for="max_rides">Max Rides per day:</label>
		<select id="max_rides" name="max_rides" required>
			<option value="">Choose max rides per day</option>
			<option value="1">1 ride</option>
			<option value="2">2 rides</option>
		</select>
        <label for="max_rides">Amount:</label>
        <input type="text" id="price" name="price" value="" disabled>

		<input type="submit" value="PAY">
	
</body>
</html>
