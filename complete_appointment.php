<?php
session_start();
include 'db1.php'; // Ensure you have a file to connect to the database

$patient_file = $_SESSION['patients_file'] ?? null;

if (!$patient_file) {
    echo 'No patient file found in session.';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo 'Invalid request.';
    exit;
}

$appointmentId = $_POST['appointmentId'] ?? null;
if (!$appointmentId) {
    echo 'No appointment ID provided.';
    exit;
}

$sql = "UPDATE booked_appointments SET status = 'completed' WHERE appointment_id = ? AND patients_file = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $appointmentId, $patient_file);

if ($stmt->execute()) {
    echo 'Appointment completed successfully.';
} else {
    echo 'Error completing appointment: ' . $conn->error;
}

$stmt->close();
$conn->close();
?>
