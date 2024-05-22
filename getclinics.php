<?php
header('Content-Type: application/json');
include 'db1.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$hospital_id = $_GET['hospital_id'] ?? '';

if ($hospital_id) {
    $stmt = $conn->prepare("SELECT clinic_id AS id, clinic_name AS name FROM clinics WHERE hospital_id = ?");
    $stmt->bind_param("i", $hospital_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $clinics = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $clinics[] = $row;
        }
        echo json_encode($clinics);
    } else {
        echo json_encode(["error" => "No data found."]);
    }
    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid hospital ID."]);
}
$conn->close();
?>
