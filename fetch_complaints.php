<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "healthcare";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get email from session
$email = $_SESSION['email'];

if (!$email) {
    die("Email not found in session");
}

$sql = "SELECT id, subject, complaint_text, created_at, admin_response, response_status FROM complaints WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

$complaints = array();
while($row = $result->fetch_assoc()) {
    $complaints[] = $row;
}

$stmt->close();
$conn->close();

echo json_encode($complaints);
?>
