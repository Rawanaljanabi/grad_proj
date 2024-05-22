<?php
header('Content-Type: application/json');
$servername = "localhost";
$username = "root";  // Typically avoid root in production
$password = "";      // Use secure passwords in production
$dbname = "healthcare";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $dose = filter_input(INPUT_POST, 'dose', FILTER_SANITIZE_STRING);
    $time = filter_input(INPUT_POST, 'medicationTime', FILTER_SANITIZE_STRING);

    if (empty($name) || empty($dose)) {
        echo json_encode(['error' => 'Name and dose are required.']);
        exit;
    }

    $query = "INSERT INTO medications (name, dose, time) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        echo json_encode(['error' => 'Failed to prepare statement: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param("sss", $name, $dose, $time);

    if ($stmt->execute()) {
        echo json_encode(['success' => 'Medication added successfully']);
    } else {
        echo json_encode(['error' => 'Failed to save medication: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['error' => 'Invalid request method']);
}

$conn->close();
?>
