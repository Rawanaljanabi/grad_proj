<?php
header('Content-Type: application/json');
include 'db_connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
$patients_file = $_SESSION['patients_file'];

$sql = "
    SELECT 
        a.appointment_id,
        a.appointment_date,
        a.appointment_time,
        h.hospital_name AS hospital_name,
        c.clinic_name AS clinic_name,
        d.doctor_name AS doctor_name,
        a.status
    FROM 
        appointments a
    JOIN 
        hospitals h ON a.hospital_id = h.hospital_id
    JOIN 
        clinics c ON a.clinic_id = c.clinic_id
    JOIN 
        doctors d ON a.doctor_id = d.doctor_id
    WHERE 
        a.patients_file = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $patients_file);
$stmt->execute();
$result = $stmt->get_result();

$appointments = [];
while ($row = $result->fetch_assoc()) {
    $appointments[] = $row;
}

echo json_encode($appointments);

$stmt->close();
$conn->close();
?>
