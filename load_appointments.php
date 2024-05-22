<?php
session_start();
include 'db1.php'; // Ensure you have a file to connect to the database

$patient_file = $_SESSION['patients_file'] ?? null;

if (!$patient_file) {
    echo json_encode(['error' => 'No patient file found in session.']);
    exit;
}

// Function to get appointments
function getAppointments($status) {
    global $conn, $patient_file;
    $sql = "SELECT * FROM booked_appointments WHERE patients_file = ? AND status = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo json_encode(['error' => 'Prepare failed: ' . $conn->error]);
        exit;
    }
    $stmt->bind_param("ss", $patient_file, $status);
    if (!$stmt->execute()) {
        echo json_encode(['error' => 'Execute failed: ' . $stmt->error]);
        exit;
    }
    $result = $stmt->get_result();
    $appointments = [];
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
    return $appointments;
}

// Fetch and encode appointments
$upcomingAppointments = getAppointments('upcoming');
$previousAppointments = getAppointments('completed');

echo json_encode([
    'upcoming' => $upcomingAppointments,
    'previous' => $previousAppointments
]);

?>