<?php
include 'db1.php';  // Include the database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $patients_file = $conn->real_escape_string($_POST['patients_file']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $DOB = $conn->real_escape_string($_POST['dob']);  // Ensure 'DOB' is passed from the form
    $gender = $conn->real_escape_string($_POST['gender']);
    $blood_type = $conn->real_escape_string($_POST['blood_type']);


    // Password hashing for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the database
    $sql = "INSERT INTO users (full_name, email, password, DOB, gender, blood_type, patients_file) VALUES ('$full_name', '$email', '$hashed_password', '$DOB', '$gender', '$blood_type','$patients_file')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

?>
