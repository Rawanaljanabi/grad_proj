<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "healthcare";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, donation_details, posted_on FROM urgent_donation ORDER BY posted_on DESC";
$result = $conn->query($sql);

$urgent_donations = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $urgent_donations[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($urgent_donations);
?>
