<?php
session_start(); // Start or resume a session

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="homepagep.css">
    <title> User Profile </title>
</head>
<body>
    <img class="vectors" src="blu vec.png">
    <img class="vectors2" src="pink vec.png">

    <aside class="sidebar">
        <h1>Care</h1>
        <ul> 
            <li><button onclick="location.href='bloodPressure.php'" id="pressure" type="button" class="buttons">Blood Pressure</button></li>
            <li><button onclick="location.href='calories.php'" id="calories" type="button" class="buttons">Calories & Steps</button></li>
            <li><button onclick="location.href='sleep.php'" id="sleep" type="button" class="buttons">Sleep Tracking</button></li>
            <li><button onclick="location.href='medication1.php'" id="medications" type="button" class="buttons">Medications</button></li>
            <li><button onclick="location.href='heartRate.php'" id="rate" type="button" class="buttons">Heart Rate</button></li>
            <li><button onclick="location.href='appointmentsp.php'" id="appointments" type="button" class="buttons">Appointments</button></li>
            <li><button onclick="location.href='donationp.php'" id="donation" type="button" class="buttons">Blood Donation</button></li>
        </ul>
    </aside>
    
    <header class="topbar">
    <div>
            <p id="greeting" style="white-space: nowrap;"></p>
        </div>
      <ul>
        <li>
          <a href="homepagep.php" class="home-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
            </svg>
        </a>
    </li>
    <li>
        <a href="complaintsp.php" class="info-icon">
         <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
           <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
           <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
         </svg>
       </a>
       </li>
       <li> 
                <a href="notificationsp.php" class="info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6"/>
                    </svg>
                </a>
            </li>
        <li><button onclick="login1.php" id="logoutButton" type="button" class="logout">Log Out</button></li>
      </ul>
    </header>

                  <!-- Main content -->
                  <div class="container">
                    <div class="profile-content">
                      
                            <a class="user-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H4zm4-6a3 3 0 1 0-0-6 3 3 0 0 0 0 6z"/>
                                </svg>
                            </a>
                            <div class="detail-container">
    <p>Name: <strong><?php echo htmlspecialchars($_SESSION['full_name'] ?? 'Unknown'); ?></strong></p>
</div>
<div class="detail-container">
    <p>patients file: <strong><?php echo htmlspecialchars($_SESSION['patients_file'] ?? 'Not provided'); ?></strong></p>
</div>
<div class="detail-container">
    <p>Dob: <strong><?php echo htmlspecialchars($_SESSION['DOB'] ?? 'Not provided'); ?></strong></p>
</div>
<div class="detail-container">
    <p>Gender: <strong><?php echo htmlspecialchars($_SESSION['Gender'] ?? 'Not provided'); ?></strong></p>
</div>
<div class="detail-container">
    <p>Blood Type: <strong><?php echo htmlspecialchars($_SESSION['Blood_Type'] ?? 'Not provided'); ?></strong></p>
</div>

                        </div>
                    </div>
                </div>
    
    <script>
document.addEventListener("DOMContentLoaded", function() {
    var defaultGreeting = "Homepage";
    var greetingElement = document.getElementById("greeting");

    greetingElement.textContent = defaultGreeting;
});

document.addEventListener("DOMContentLoaded", function() {
    var logoutButton = document.getElementById("logoutButton");
    logoutButton.addEventListener("click", function() {
        var confirmation = confirm("Are you sure you want to log out?");
        if (confirmation) {
            window.location.href = "login1.php";
        }
    });
})
    </script>
    
</body>
</html>