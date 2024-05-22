<?php
session_start();
header('Content-Type: application/json');
include 'db.php'; // Include your database connection file

function fetchAppointments($conn, $patients_file) {
    $query_appointments = "SELECT appointment_date, appointment_time, hospital, clinic, doctor FROM appointments WHERE patients_file = ? AND status = 'upcoming'";
    $stmt_appointments = $conn->prepare($query_appointments);
    if (!$stmt_appointments) {
        error_log("Error preparing SQL: " . $conn->error);
        return [];
    }
    $stmt_appointments->bind_param("s", $patients_file);
    $stmt_appointments->execute();
    $result_appointments = $stmt_appointments->get_result();

    $appointments = [];
    while ($row_appointment = $result_appointments->fetch_assoc()) {
        $appointments[] = $row_appointment;
    }
    $stmt_appointments->close();
    return $appointments;
}

function appointmentExists($conn, $patients_file, $date, $time) {
    $query_check = "SELECT * FROM appointments WHERE patients_file = ? AND appointment_date = ? AND appointment_time = ?";
    $stmt_check = $conn->prepare($query_check);
    if (!$stmt_check) {
        error_log("Error preparing SQL: " . $conn->error);
        return false;
    }
    $stmt_check->bind_param("sss", $patients_file, $date, $time);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $exists = $result_check->num_rows > 0;
    $stmt_check->close();
    
    // Logging for debugging
    error_log("Checking appointment: patients_file=$patients_file, date=$date, time=$time, exists=$exists");

    return $exists;
}

function saveAppointment($conn, $patients_file, $hospital_id, $clinic_id, $doctor_id, $date, $time) {
    if (appointmentExists($conn, $patients_file, $date, $time)) {
        return ['success' => false, 'error' => 'This date and time is already booked. Please select another time or date.'];
    }

    $query_save = "INSERT INTO appointments (patients_file, hospital, clinic, doctor, appointment_date, appointment_time, status) VALUES (?, ?, ?, ?, ?, ?, 'upcoming')";
    $stmt_save = $conn->prepare($query_save);
    
    if (!$stmt_save) {
        error_log("Error preparing SQL: " . $conn->error);
        return ['success' => false, 'error' => 'Error preparing the appointment save statement.'];
    }

    $stmt_save->bind_param("ssssss", $patients_file, $hospital_id, $clinic_id, $doctor_id, $date, $time);

    if (!$stmt_save->execute()) {
        error_log("Error executing SQL: " . $stmt_save->error);
        return ['success' => false, 'error' => 'Error executing the appointment save statement.'];
    }

    if ($stmt_save->affected_rows > 0) {
        error_log("Appointment saved: patients_file=$patients_file, hospital_id=$hospital_id, clinic_id=$clinic_id, doctor_id=$doctor_id, date=$date, time=$time");
        $stmt_save->close();
        return ['success' => true, 'message' => 'Appointment saved successfully.'];
    } else {
        error_log("Error saving appointment: " . $stmt_save->error);
        $stmt_save->close();
        return ['success' => false, 'error' => $stmt_save->error];
    }
}

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $query_file = "SELECT patients_file FROM users WHERE email = ?";
    $stmt_file = $conn->prepare($query_file);
    if (!$stmt_file) {
        error_log("Error preparing SQL: " . $conn->error);
        echo json_encode(['error' => 'Error preparing the patients file statement.']);
        exit;
    }
    $stmt_file->bind_param("s", $email);
    $stmt_file->execute();
    $result_file = $stmt_file->get_result();

    if ($result_file && $result_file->num_rows > 0) {
        $row_file = $result_file->fetch_assoc();
        $patients_file = $row_file['patients_file'];

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $appointments = fetchAppointments($conn, $patients_file);
            echo json_encode($appointments);

        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hospital_id = $_POST['hospital_id'];
            $clinic_id = $_POST['clinic_id'];
            $doctor_id = $_POST['doctor_id'];
            $date = $_POST['appointment_date'];
            $time = $_POST['appointment_time'];

            // Logging for debugging
            error_log("Received data: hospital_id=$hospital_id, clinic_id=$clinic_id, doctor_id=$doctor_id, date=$date, time=$time");

            $response = saveAppointment($conn, $patients_file, $hospital_id, $clinic_id, $doctor_id, $date, $time);
            echo json_encode($response);
        }
    } else {
        error_log("Error fetching patients file: " . $conn->error);
        echo json_encode(['error' => 'Error fetching patients file: ' . $conn->error]);
    }

    $stmt_file->close();
} else {
    echo json_encode(['error' => 'User email not set in session.']);
}

$conn->close();
?>
