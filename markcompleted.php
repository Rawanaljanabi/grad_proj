<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

include 'db.php';
$appointment_id = $_POST['appointment_id'];

$sql = "UPDATE appointments SET status = 'completed' WHERE appointment_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $appointment_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Appointment marked as completed";
} else {
    echo "Error updating appointment";
}
$stmt->close();
$conn->close();
?>
