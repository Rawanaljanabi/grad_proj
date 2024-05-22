<?php
session_start();
header('Content-Type: application/json');
include 'db.php'; // Include your database connection file

// Function to debug session data
function debugSession() {
    echo "<pre>Session Data:\n";
    print_r($_SESSION);
    echo "</pre>";
}

// Check if email exists in session
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Debugging: Print session email
    echo "Session email: $email <br>";

    // Fetch patients_file from users table
    $query_file = "SELECT patients_file FROM users WHERE email = ?";
    $stmt_file = $conn->prepare($query_file);
    $stmt_file->bind_param("s", $email);
    $stmt_file->execute();
    $result_file = $stmt_file->get_result();

    if ($result_file && $result_file->num_rows > 0) {
        $row_file = $result_file->fetch_assoc();
        $patients_file = $row_file['patients_file'];

        // Debugging: Print patients_file
        echo "Patients File: $patients_file <br>";

        // Fetch upcoming appointments using patients_file
        $query_appointments = "SELECT date, time, hospital, clinic, doctor FROM appointments WHERE patients_file = ? AND status = 'upcoming'";
        $stmt_appointments = $conn->prepare($query_appointments);
        $stmt_appointments->bind_param("s", $patients_file);
        $stmt_appointments->execute();
        $result_appointments = $stmt_appointments->get_result();

        if ($result_appointments && $result_appointments->num_rows > 0) {
            $appointments = [];
            while ($row_appointment = $result_appointments->fetch_assoc()) {
                $appointments[] = $row_appointment;
            }
            echo json_encode($appointments);
        } else {
            echo json_encode(['error' => 'No upcoming appointments found for the user.']);
        }
        
        $stmt_appointments->close();
    } else {
        echo json_encode(['error' => 'Error fetching patients file from users table.']);
    }

    $stmt_file->close();
} else {
    echo json_encode(['error' => 'User email not set in session.']);
    debugSession(); // Debugging: Print session data
}

$conn->close();
?>
