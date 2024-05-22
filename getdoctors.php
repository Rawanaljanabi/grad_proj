<?php
header('Content-Type: application/json');
include 'db1.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$clinic_id = $_GET['clinic_id'] ?? '';

if ($clinic_id) {
    $stmt = $conn->prepare("SELECT doctor_id AS id, doctor_name AS name FROM doctors WHERE clinic_id = ?");
    $stmt->bind_param("i", $clinic_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $doctors = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $doctors[] = $row;
        }
        echo json_encode($doctors);
    } else {
        echo json_encode(["error" => "No data found."]);
    }
    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid clinic ID."]);
}
$conn->close();
?>
