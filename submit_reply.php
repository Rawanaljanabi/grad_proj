<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "healthcare";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$complaint_id = $_POST['id'];
$admin_response = $_POST['reply'];

// Debugging statements
error_log("Received complaint ID: " . $complaint_id);
error_log("Received reply: " . $admin_response);

$sql = "UPDATE complaints SET admin_response=?, response_status='replied' WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $admin_response, $complaint_id);

if ($stmt->execute()) {
    echo "Reply submitted successfully.";
    error_log("Reply submitted successfully for complaint ID: " . $complaint_id);
} else {
    echo "Error: " . $stmt->error;
    error_log("Error submitting reply for complaint ID: " . $complaint_id . " - " . $stmt->error);
}

$stmt->close();
$conn->close();
?>
