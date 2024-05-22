<?php
include 'db_connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
$patients_file = $_SESSION['patients_file'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hospital_id = $_POST['hospital_id'];
    $clinic_id = $_POST['clinic_id'];
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    $sql = "INSERT INTO appointments (patients_file, hospital_id, clinic_id, doctor_id, appointment_date, appointment_time, status) VALUES (?, ?, ?, ?, ?, ?, 'scheduled')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('siiiss', $patients_file, $hospital_id, $clinic_id, $doctor_id, $appointment_date, $appointment_time);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'appointment_id' => $stmt->insert_id]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
}

$conn->close();
?>
