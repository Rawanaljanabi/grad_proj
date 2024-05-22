<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "healthcare";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, subject, complaint_text, admin_response, response_status, created_at FROM complaints WHERE response_status='replied'";
$result = $conn->query($sql);

$complaints = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $complaints[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($complaints);

$conn->close();
?>
