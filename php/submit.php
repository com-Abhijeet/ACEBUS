<?php
// Database configuration
require_once('connect.php');
// Prepare SQL statement to insert data into table
$stmt = $conn->prepare("INSERT INTO subscriptions (location, destination, duration, max_rides, amount) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssiid", $location, $destination, $duration, $max_rides, $amount);

// Get form data and sanitize input
$location = mysqli_real_escape_string($conn, $_POST['location']);
$destination = mysqli_real_escape_string($conn, $_POST['destination']);
$duration = intval($_POST['duration']);
$max_rides = intval($_POST['max_rides']);

// Get current ticket price from bus_schedules table
$price_query = "SELECT price FROM bus_schedule WHERE start_point'$location' AND end_point='$destination'";
$price_result = $conn->query($price_query);

if ($price_result->num_rows > 0) {
    $price_row = $price_result->fetch_assoc();
    $price = $price_row['price'];
} else {
    echo "Error: Could not retrieve price from database";
    exit();
}

// Calculate amount based on duration and max rides per day
$amount = $price * $duration;
if ($max_rides == 2) {
    $amount *= 1.5;
}

// Execute SQL statement and check for errors
if (!$stmt->execute()) {
    echo "Error: " . $stmt->error;
}

// Close statement and database connection
$stmt->close();
$conn->close();

// Redirect to subscription page with amount parameter
header("Location: subscription.php?amount=$amount&price=$price");
exit();
?>
