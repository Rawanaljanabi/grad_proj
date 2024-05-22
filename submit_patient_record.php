<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "healthcare";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit();
}

$patient_file_number = $_POST['patient_file_number'];
$name = $_POST['name'];
$age = $_POST['age'];
$condition = $_POST['condition'];
$weight = $_POST['weight'];
$height = $_POST['height'];
$blood_type = $_POST['blood_type'];
$health_status = $_POST['health_status'];

$sql = "INSERT INTO patient_records (patient_file_number, name, age, `condition`, weight, height, blood_type, health_status)
VALUES ('$patient_file_number', '$name', '$age', '$condition', '$weight', '$height', '$blood_type', '$health_status')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $sql . '<br>' . $conn->error]);
}

$conn->close();
?>
