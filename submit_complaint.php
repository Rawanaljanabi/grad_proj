<?php
session_start();
header('Content-Type: application/json');

// Configure error reporting
error_reporting(E_ALL);
ini_set('display_errors', 0); // Turn off error display, use 1 in development
ini_set('log_errors', 1); // Ensure errors are logged

require_once 'db.php'; // Ensure the database connection is made

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

if (empty($_SESSION['email']) || !filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid or missing email in session. Please log in.']);
    exit;
}

$email = $_SESSION['email'];
$complaint = $_POST['complaint'] ?? '';
$subject = $_POST['subject'] ?? '';

if (empty($complaint)) {
    echo json_encode(['success' => false, 'message' => 'Complaint text cannot be empty.']);
    exit;
}

if (empty($subject)) {
    echo json_encode(['success' => false, 'message' => 'Subject cannot be empty.']);
    exit;
}

if (!$mysqli) {
    echo json_encode(['success' => false, 'message' => 'Database connection not established.']);
    exit;
}

$stmt = $mysqli->prepare("INSERT INTO complaints (complaint_text, email, subject) VALUES (?, ?, ?)");
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Failed to prepare the statement: ' . $mysqli->error]);
    exit;
}

$stmt->bind_param("sss", $complaint, $email, $subject);
if (!$stmt->execute()) {
    echo json_encode(['success' => false, 'message' => 'Failed to save the complaint: ' . $stmt->error]);
    $stmt->close();
    exit;
}

$stmt->close();
echo json_encode(['success' => true]);
?>
