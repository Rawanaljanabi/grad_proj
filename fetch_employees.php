<?php
// Include the database connection file
include_once 'db_connection.php';

// Check if the department is set and not empty
if(isset($_POST['department']) && !empty($_POST['department'])){
    // Sanitize the input
    $department = mysqli_real_escape_string($conn, $_POST['department']);

    // Prepare the SQL query to fetch employees based on department
    $sql = "SELECT employee_name FROM employees WHERE department = '$department'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if query was successful
    if($result){
        // Array to hold employee names
        $employees = array();

        // Fetch employee names and add to array
        while($row = mysqli_fetch_assoc($result)){
            $employees[] = $row['employee_name'];
        }

        // Return the employee names as JSON
        echo json_encode($employees);
    } else {
        // Query failed
        echo "Error fetching employees: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
