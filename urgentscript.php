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

// Assuming this block is within your PHP script where the form data is processed
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['donation_details'])) {
    $donation_details = $_POST['donation_details'];

    // Assuming $conn is your database connection
    $sql = "INSERT INTO urgent_donation (donation_details) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $donation_details);
    if ($stmt->execute()) {
        echo "Urgent donation posted successfully.";
    } else {
        echo "Error posting urgent donation: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    exit(); // Stop the script after sending the response
}
?>
