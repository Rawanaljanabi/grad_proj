<?php
session_start();



// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "healthcare";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form Data Validation
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$institute = $_POST['institute'];
$blood_type = $_POST['blood_type'];

if (empty($start_date) || empty($end_date) || empty($start_time) || empty($end_time) || empty($institute) || empty($blood_type)) {
    echo "All fields are required.";
} else if (new DateTime($start_date) > new DateTime($end_date)) {
    echo "The end date must be after the start date.";
} else if ($start_time >= $end_time) {
    echo "The end time must be after the start time.";
} else {
    // Inserting data into the database
    $sql = "INSERT INTO donation_appointments (start_date, end_date, start_time, end_time, institute, blood_type)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $start_date, $end_date, $start_time, $end_time, $institute, $blood_type);

    if ($stmt->execute()) {
        echo "Appointment slot successfully assigned!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
