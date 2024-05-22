<?php
session_start();  // Start the session at the beginning of the script

// Generate CSRF token if not already set
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Process the form if it's submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // CSRF token check
    if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('CSRF token validation failed.');
    }

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
    $blood_type = $_POST['blood-type'];

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
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="organize.css">
    <title>HomePage</title>
</head>
<body>
    <img class="vectors" src="blu vec.png">
    <img class="vectors2" src="pink vec.png">
  
    <!-- Sidebar -->
    <aside class="sidebar">
        <h1>Care</h1>
        <ul>
           <li><button onclick="location.href='organize.html'" id="Organize" class="buttons">Organize Appointments</button></li> 
           <li><button onclick="location.href='urgent.html'" id="Urgent" class="buttons">Urgent Donations</button></li> 
        </ul>
    </aside>
  
    <!-- Top bar -->
    <header class="topbar">
        <div>
            <p id="greeting" style="white-space: nowrap;"></p>
        </div>
        <ul>
            <li><a href="HomePage.html" class="home-icon">Home Icon Here</a></li>
            <li><a href="complaints.php" class="info-icon">Info Icon Here</a></li>
            <li><button onclick="location.href='login.html'" id="logoutButton" type="button" class="logout">Log Out</button></li>
        </ul>
    </header>

    <!-- Main content -->
    <div class="container">
        <div class="organize-appointments-content">
            <form method="POST" action="" id="appointmentForm">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                
                <div class="form-group">
                    <label for="start_date">Start Date:</label>
                    <input type="date" id="start_date" name="start_date" required>
                </div>
                <div class="form-group">
                    <label for="end_date">End Date:</label>
                    <input type="date" id="end_date" name="end_date" required>
                </div>
                <div class="form-group">
                    <label for="start_time">Start Time:</label>
                    <input type="time" id="start_time" name="start_time" required>
                </div>
                <div class="form-group">
                    <label for="end_time">End Time:</label>
                    <input type="time" id="end_time" name="end_time" required>
                </div>
                <div class="form-group">
                    <label for="institute">Institute:</label>
                    <input type="text" id="institute" name="institute" required>
                </div>
                <div class="form-group">
                    <label for="blood-type">Blood Type:</label>
                    <select id="blood-type" name="blood-type">
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="all types Accepted">All Types Accepted</option>
                    </select>
                </div>
                <button type="submit" id="submitBtn">Assign Period</button>
            </form>
        </div>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var defaultGreeting = "Organize Blood Donation Appointments";
            document.getElementById("greeting").textContent = defaultGreeting;

            document.getElementById("logoutButton").addEventListener("click", function() {
                if (confirm("Are you sure you want to log out?")) {
                    window.location.href = "login.html";
                }
            });

            var form = document.getElementById('appointmentForm');
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                var startDate = document.getElementById('start_date').value;
                var endDate = document.getElementById('end_date').value;
                var startTime = document.getElementById('start_time').value;
                var endTime = document.getElementById('end_time').value;
                var institute = document.getElementById('institute').value;
                var bloodType = document.getElementById('blood-type').value;

                // Validate inputs
                if (!startDate || !endDate || !startTime || !endTime || !institute) {
                    alert('Please fill all required fields.');
                    return false;
                }
                if (new Date(startDate) > new Date(endDate)) {
                    alert('End date must be after start date.');
                    return false;
                }
                if (startTime >= endTime) {
                    alert('End time must be after start time.');
                    return false;
                }

                form.submit(); // Manually submit the form if all checks pass
            });
        });
    </script>
</body>
</html>
