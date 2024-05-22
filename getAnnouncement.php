<?php
header('Content-Type: application/json');

include 'db.php';
// After including db.php
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT id, date, time, text FROM announcement ORDER BY id DESC");

$announcements = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $announcements[] = $row;
    }
    echo json_encode($announcements);
} else {
    echo "No announcements found";
}

$conn->close();
?>