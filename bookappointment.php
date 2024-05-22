<?php
session_start(); // Start session at the top to ensure it's available
header('Content-Type: application/json'); // Set header for JSON response

require_once 'db.php'; // Adjust the path as necessary

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $hospital_id = $_POST['hospital_id'];
    $doctor_id = $_POST['doctor_id'];
    $clinic_id = $_POST['clinic_id'] ?? null; // Assuming clinic_id might not be mandatory
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO appointments (user_id, hospital_id, doctor_id, clinic_id, appointment_date, appointment_time) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        echo json_encode(['error' => 'Prepare failed: ' . $conn->error]);
        exit;
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("iiisss", $user_id, $hospital_id, $doctor_id, $clinic_id, $appointment_date, $appointment_time);
    $executeResult = $stmt->execute();
    if (!$executeResult) {
        echo json_encode(['error' => 'Execute failed: ' . $stmt->error]);
        exit;
    } else {
        echo json_encode(['success' => true]);
    }

    // Close the statement
    $stmt->close();
}
?>
