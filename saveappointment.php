<?php
session_start();  // Start the session at the beginning of the script

require_once 'db1.php';  // Assuming this file contains the database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $hospital_id = $_POST['hospital_id'] ?? null;
    $doctor_id = $_POST['doctor_id'] ?? null;
    $clinic_id = $_POST['clinic_id'] ?? null;
    $appointment_date = $_POST['appointment_date'] ?? null;
    $appointment_time = $_POST['appointment_time'] ?? null;
    $patients_file = $_POST['patients_file'] ?? null;

    // Debugging: Log input data
    error_log("Data received - user_id: $user_id, hospital_id: $hospital_id, doctor_id: $doctor_id, clinic_id: $clinic_id, appointment_date: $appointment_date, appointment_time: $appointment_time, patients_file: $patients_file");

    // Check for missing data
    if (empty($patients_file)) {
        echo json_encode(['error' => 'patients_file is missing']);
        exit;
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO appointments (user_id, patients_file, hospital_id, doctor_id, clinic_id, appointment_date, appointment_time, status) VALUES (?, ?, ?, ?, ?, ?, ?, 'scheduled')");
    if (!$stmt) {
        echo json_encode(['error' => 'Prepare failed: ' . $conn->error]);
        exit;
    }

    // Bind parameters and execute the statement
    // Using 'i' for integers and 's' for strings
    if (is_null($clinic_id)) {
        $stmt->bind_param("isiiiss", $user_id, $patients_file, $hospital_id, $doctor_id, $clinic_id, $appointment_date, $appointment_time);
    } else {
        $stmt->bind_param("isiiiss", $user_id, $patients_file, $hospital_id, $doctor_id, $clinic_id, $appointment_date, $appointment_time);
    }

    if (!$stmt->execute()) {
        error_log('Execute failed: ' . $stmt->error);
        echo json_encode(['error' => 'Execute failed: ' . $stmt->error]);
    } else {
        echo json_encode(['success' => true]);
    }

    // Close the statement
    $stmt->close();
}
?>
