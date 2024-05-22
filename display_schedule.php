<?php
$servername = "localhost"; // Change this to your servername
$username = "root"; // Change this to your username
$password = ""; // Change this to your password
$dbname = "healthcare"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from your_table_name
$query = "SELECT * FROM shift_schedule";
$result = $conn->query($query);

// Start table
echo "<table border='1'>";
echo "<tr><th>Department</th><th>Employee Name</th><th>Employee Email</th><th>Shift Date</th><th>Shift Start Time</th><th>Shift End Time</th></tr>";

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["department"] . "</td>";
        echo "<td>" . $row["employee_name"] . "</td>";
        echo "<td>" . $row["employee_email"] . "</td>";
        echo "<td>" . $row["shift_date"] . "</td>";
        echo "<td>" . $row["shift_start_time"] . "</td>";
        echo "<td>" . $row["shift_end_time"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>0 results</td></tr>";
}

// End table
echo "</table>";

// Close the connection
$conn->close();
?>
