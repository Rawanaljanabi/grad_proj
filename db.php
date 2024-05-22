<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'healthcare';

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    error_log('Database connection failed: ' . $mysqli->connect_error);
    // For development only, you might enable the next line to see the error directly
    // echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit; // Exit to avoid executing further code
}
?>
