<?php
session_start();
require 'database_connection.php'; // Make sure this path is correct

$patients_file = $_SESSION['patients_file'];

$sql = "SELECT * FROM appointments WHERE patients_file = ? AND status = 'completed'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $patients_file);
$stmt->execute();
$result = $stmt->get_result();

$appointments = array();
while ($row = $result->fetch_assoc()) {
    $appointments[] = $row;
}

echo json_encode($appointments);
?>
