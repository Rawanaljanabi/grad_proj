<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "healthcare";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$department = $_POST['department'];
$employee_name = $_POST['employee_name'];
$employee_email = $_POST['employee_email'];
$shift_date = $_POST['shift_date'];
$shift_start_time = $_POST['shift_start_time'];
$shift_end_time = $_POST['shift_end_time'];

$query = "INSERT INTO your_table_name (department, employee_name, employee_email, shift_date, shift_start_time, shift_end_time) 
          VALUES ('$department', '$employee_name', '$employee_email', '$shift_date', '$shift_start_time', '$shift_end_time')";

if ($conn->query($query) === TRUE) {
    header("Location: shift.php?status=success");
} else {
    header("Location: shift.php?status=error");
}

$conn->close();
exit;
?>
