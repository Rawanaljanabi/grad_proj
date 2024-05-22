<?php
$servername = "localhost";
$username = "root";
$password = ""; // Add your MySQL password here
$dbname = "healthcare"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get patient's email from POST request
$email = $_POST['email'];

// Fetch patient's file number using email
$sql = "SELECT patients_file FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $patients_file = $row['patients_file'];

    // Fetch new prescriptions based on patients_file
    $sql = "SELECT * FROM prescriptions WHERE patients_file = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $patients_file);
    $stmt->execute();
    $result = $stmt->get_result();

    $newPrescriptions = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $newPrescriptions[] = $row;
        }
    }



    // Close statement
    $stmt->close();
} else {
    $newPrescriptions = [];
    $previousPrescriptions = [];
}

$conn->close();

?>
