<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "healthcare";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch announcements
$sql = "SELECT id, date, time, subject, text FROM announcement ORDER BY date DESC, time DESC";
$result = $conn->query($sql);

$announcements = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $announcements[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($announcements);

$conn->close();
?>
