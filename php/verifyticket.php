
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/ACEBUS/css/verifyticket.css">
    <title>Verify Bus Tickets</title>
</head>
<body>
<nav>
        AceBus
    </nav>
    <h1>Verify Bus Tickets</h1>
    
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="bus_id">Bus ID:</label>
        <input type="number" id="bus_id" name="bus_id" required><br><br>
        <input type="submit" class="button" value="Verify Ticket">
    </form>
    <?php
// Create a MySQL connection
$conn = new mysqli("localhost", "root", "", "acebusDB"); // Replace your_database_name with your actual database name

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input from form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $busId = $_POST['bus_id'];

    // Prepare and execute a SQL query to fetch tickets from the database based on username and bus ID
    $stmt = $conn->prepare("SELECT * FROM tickets WHERE username = ? AND bus_id = ?");
    $stmt->bind_param("si", $username, $busId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if ticket exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    
        // Display ticket details
        // echo "Ticket ID: " . $row['ticket_id'] . "<br>";
        echo "<div class='message'>STATUS: BOOKED</div>";
        echo "<div class='message'>Bus ID: " . $row['bus_id'] . "<br></div>";
        echo "<div class='message'>Username: " . $row['username'] . "<br></div>";
        // echo "Ticket Status: " . $row['status'] . "<br>";
        // echo "Departure: " . $row['departure'] . "<br>";
        // echo "Arrival: " . $row['arrival'] . "<br>";
    } else {
        // Display error message if ticket does not exist
        echo "Ticket not found.";
    }
}
?>

<button class="button" id="bt"><a href="/ACEBUS/php/busstaff.php">Back</a>
</button>

</body>
</html>
