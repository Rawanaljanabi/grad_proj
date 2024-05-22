<?php
header('Content-Type: application/json');
include 'db1.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT hospital_id AS id, hospital_name AS name FROM hospitals");

$hospitals = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $hospitals[] = $row;
    }
    echo json_encode($hospitals);
} else {
    echo json_encode(["error" => "No data found."]);
}
$conn->close();
?>
