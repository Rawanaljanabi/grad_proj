<?php
session_start(); // This must be at the top, before checking session variables

include 'db1.php'; 
$email = $_GET['email'];

$stmt = $pdo->prepare("SELECT blood_type FROM users WHERE email = ?");
$stmt->execute([$email]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    echo json_encode(['success' => true, 'bloodType' => $result['blood_type']]);
} else {
    echo json_encode(['success' => false, 'message' => 'No user found']);
}
?>
