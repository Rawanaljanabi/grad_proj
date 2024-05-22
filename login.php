<?php
session_start();
ob_start(); // Start output buffering

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

// Debug function to print session data
function debugSession() {
    echo "<pre>Session Data:\n";
    print_r($_SESSION);
    echo "</pre>";
}

// Function to add user
function addUser($name, $email, $password, $user_type, $mysqli) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $mysqli->prepare("INSERT INTO users (full_name, email, password, user_type) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        echo "Error preparing statement: " . $mysqli->error;
        return;
    }
    $stmt->bind_param("ssss", $name, $email, $hashed_password, $user_type);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        echo "User added successfully.<br>";
    } else {
        echo "Error adding user: " . $stmt->error . "<br>";
    }
    $stmt->close();
}

// Uncomment to add user
 //addUser('zahra yousef alyousef', 'zahrayousef@hotmail.com', 'Zahra99-', 'staff', $conn);
 //addUser('hadeel ayman mughayis', 'hadeelayman@hotmail.com', 'Hadeel99-', 'admin', $conn);


// Handling user login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; // Consider sanitizing

    $stmt = $conn->prepare("SELECT user_id, full_name, password, user_type, patients_file, email,dob,gender,blood_type FROM users WHERE email = ?");
    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        return;
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['user_type'] = $user['user_type'];
            $_SESSION['patients_file'] = $user['patients_file'];
            $_SESSION['DOB'] = $user['dob'];
            $_SESSION['Gender'] = $user['gender'];
            $_SESSION['Blood_Type'] = $user['blood_type'];
            $_SESSION['email'] = $user['email']; // Ensure email is correctly assigned

            session_regenerate_id(); // Security measure against session fixation

            // Debug session data before redirection
            echo "Before Redirection: ";
            debugSession();

            // Redirect based on user type
            if (!empty($_SESSION['email'])) {
                switch ($user['user_type']) {
                    case 'admin':
                        header("Location: HPAdmin.php");
                        break;
                    case 'staff':
                        header("Location: homepage.php");
                        break;
                    default:
                        header("Location: homepagep.php");
                        break;
                }
                exit();
            } else {
                echo "Session email not set. Debugging session data:";
                debugSession();
            }
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password.";
    }
    $stmt->close();
} else {
    echo "No POST request detected.";
}

// Final debug to confirm session state
echo "Final Session Data: ";
debugSession();

$conn->close();
ob_end_flush(); // Send output buffer and turn off output buffering
?>
