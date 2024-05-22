<?php
session_start();
include 'database_connection.php';

$patients_file = $_SESSION['patients_file'];

$sql = "SELECT * FROM appointments WHERE patients_file = ? AND status = 'scheduled'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $patients_file);
$stmt->execute();
$result = $stmt->get_result();

$appointments = [];
while ($row = $result->fetch_assoc()) {
    $appointments[] = $row;
}

echo json_encode($appointments);
?>
