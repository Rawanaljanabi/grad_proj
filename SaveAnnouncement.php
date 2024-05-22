<?php
header('Content-Type: application/json');

include 'db1.php';
// After including db.php
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $subject = $_POST['subject'];
    $text = $_POST['text'];

    // Prepare and execute the insert statement
    $stmt = $conn->prepare("INSERT INTO announcement (date, time, subject, text) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $date, $time, $subject, $text);
    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
