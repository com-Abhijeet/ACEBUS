<?php
  // Retrieve username from session
  session_start();
  $username = $_SESSION['username'];
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

  // Retrieve form inputs
  $bus_id = $_POST['bus_id'];
  $bus_price = $_POST['bus_price'];
  $points_to_use = $_POST['points_to_use'];

  // Calculate remaining points after booking
  $remaining_points = getPoints($username) - $points_to_use;

  // Check if user has enough points for booking
  if ($remaining_points < 0) {
    echo 'Not enough points for booking.';
    exit;
  }

  // Update points in user_points table
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

  // Prepare and execute the SQL query to update user points
  $stmt = $conn->prepare("UPDATE users_account SET points = ? WHERE username = ?");
  $stmt->bind_param("is", $remaining_points, $username);
  $stmt->execute();

  // Insert booking details into ticket table
  // Replace with your own database connection and query logic
  $stmt = $conn->prepare("INSERT INTO tickets (username, bus_id, bus_price) VALUES (?, ?, ?)");
  $stmt->bind_param("sii", $username, $bus_id, $bus_price);
  $stmt->execute();

  // Close database connection
  $conn->close();

  // Update points in session
  $_SESSION['points'] = $remaining_points;

  // Redirect to success page
  header("Location: success.php?bus_id=" . $bus_id);
  exit;
?>

