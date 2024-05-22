<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "healthcare";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patients_file = $_POST['fileNumberInput'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $condition = $_POST['condition'];
    $medicineName = $_POST['medicineName'];
    $medicineDescription = $_POST['medicineDescription'];
    $dose = $_POST['dose'];
    $notes = $_POST['notes'];

    $sql = "INSERT INTO prescriptions (patients_file, name, age, condition_text, medicine_name, medicine_description, dose, notes)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die(json_encode(['success' => false, 'message' => 'SQL error: ' . $conn->error]));
    }

    $stmt->bind_param("ssssssss", $patients_file, $name, $age, $condition, $medicineName, $medicineDescription, $dose, $notes);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Insert error: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

$conn->close();
?>
