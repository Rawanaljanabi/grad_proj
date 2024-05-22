<?php
// Assuming you have already established a database connection
// Replace 'your_host', 'your_username', 'your_password', and 'your_database' with your actual database credentials
$conn = new mysqli('localhost', 'root', '', 'healthcare');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user input from the form
$username = $_POST['username'];
$password = $_POST['password'];

// SQL query to insert user data into the database
$sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
