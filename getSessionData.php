<?php
session_start();
header('Content-Type: application/json');

$response = [];

// Check if the email is set in the session
if (isset($_SESSION['email'])) {
    $response['email'] = $_SESSION['email'];  // Fetch the email
} else {
    $response['error_email'] = 'Email not found in session';
}

// Also check for the patients file in the same response
if (isset($_SESSION['patients_file'])) {
    $response['patients_file'] = $_SESSION['patients_file'];
} else {
    $response['error_patients_file'] = 'Patients file not found in session';
}

// Debugging: Log session data (optional)
error_log("Session Data: " . print_r($_SESSION, true));

echo json_encode($response);
?>
