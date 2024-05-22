<?php
session_start();

// Ensure the session has necessary data
if (!isset($_SESSION['patients_file'])) {
    echo "Session is missing required information.";
    exit;
}

include 'db1.php'; // Ensure this file sets up the $conn variable correctly with the database connection

function bookAppointment($appointmentId, $conn) {
    // Validate the appointment ID
    if (!is_numeric($appointmentId)) {
        echo "Invalid appointment ID.";
        return;
    }

    $patients_file = $_SESSION['patients_file'];

    // Check if the appointment is already booked to prevent duplicates
    $checkStmt = $conn->prepare("SELECT 1 FROM booked_appointments WHERE appointment_id = ?");
    if (!$checkStmt) {
        echo "Prepare failed: " . $conn->error;
        return;
    }
    $checkStmt->bind_param("i", $appointmentId);
    $checkStmt->execute();
    if ($checkStmt->get_result()->num_rows > 0) {
        echo "This appointment has already been booked.";
        $checkStmt->close();
        return;
    }
    $checkStmt->close();

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM donation_appointments WHERE id = ?");
    if (!$stmt) {
        echo "Prepare failed: " . $conn->error;
        return;
    }

    $stmt->bind_param("i", $appointmentId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "No appointment found with the specified ID.";
        $stmt->close();
        return;
    }

    $row = $result->fetch_assoc();
    $insertSql = "INSERT INTO booked_appointments (appointment_id, patients_file, institute, start_date, end_date, start_time, end_time, blood_type, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'upcoming')";
    $insertStmt = $conn->prepare($insertSql);

    if (!$insertStmt) {
        echo "Prepare failed: " . $conn->error;
        return;
    }

    $insertStmt->bind_param("isssssss", $appointmentId, $patients_file, $row['institute'], $row['start_date'], $row['end_date'], $row['start_time'], $row['end_time'], $row['blood_type']);

    if (!$insertStmt->execute()) {
        echo "Error booking appointment: " . $insertStmt->error;
    } else {
        echo "Appointment booked successfully.";
    }

    $insertStmt->close();
    $stmt->close();
}

// Check if the appointment ID is posted and call the booking function
if (isset($_POST['appointmentId'])) {
    bookAppointment($_POST['appointmentId'], $conn);
} else {
    echo "No appointment ID provided.";
}

$conn->close();
?>
