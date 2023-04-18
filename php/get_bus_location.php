<?php
// Get bus ID from query parameter
$busId = isset($_GET['id']) ? $_GET['id'] : '';

// Check if bus ID is provided
if (!empty($busId)) {
  // Connect to MySQL database
  $mysqli = new mysqli('localhost', 'root', '', 'acebusDB');
  
  // Check database connection
  if ($mysqli->connect_error) {
    die('Error connecting to the database: ' . $mysqli->connect_error);
  }

  // Prepare SQL query to fetch bus location based on bus ID
  $stmt = $mysqli->prepare('SELECT latitude, longitude FROM bus_locations WHERE bus_id = ?');
  $stmt->bind_param('s', $busId);
  $stmt->execute();
  $stmt->bind_result($latitude, $longitude);
  $stmt->fetch();
  $stmt->close();
  
  // Close database connection
  $mysqli->close();
  
  // Check if bus location is found
  if (!empty($latitude) && !empty($longitude)) {
    // Prepare response as JSON
    $response = array(
      'latitude' => $latitude,
      'longitude' => $longitude
    );
    echo json_encode($response);
  } else {
    // Bus not found
    echo json_encode(array('error' => 'Bus not found for the given ID'));
  }
} else {
  // Bus ID not provided
  echo json_encode(array('error' => 'Bus ID not provided'));
}
?>
