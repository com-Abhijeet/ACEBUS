<?php
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
    $conn->close();
  }
  
?>