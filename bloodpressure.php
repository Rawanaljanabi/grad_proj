<?php
require 'db_connection.php'; // Include your database connection file


session_start();
$user_id = $_SESSION['email'] ?? '';
// Fetch the status of the Blood Pressure service
$bloodPressureEnabled = false;
$result = $conn->query("SELECT is_active FROM services WHERE service_name = 'Blood Pressure'");
if ($result && $row = $result->fetch_assoc()) {
    $bloodPressureEnabled = $row['is_active'];
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Pressure Card</title>
    <link rel="stylesheet" href="bloodpressure.css">
    <style>
        .trend-container {
    background: #dddddda2;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 60%; /* Width relative to its positioned containing block */
    max-width: 430px; /* Maximum width */
    min-width: 300px; /* Minimum width to ensure content is legible */
    padding: 20px;
    position: absolute; /* Position absolutely within the relative parent */
    top: 200px; /* Align to the top of the parent */
    right: 30px; /* Align to the right of the parent */
    height: 270px; /* Default, it adapts to the content */
    position: absolute;
    top: 80px;
    overflow-y: auto; /* Enables vertical scrolling when content overflows */

    
    
}
    </style>
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
            <li><button onclick="location.href='login1.php'" id="logoutButton" type="button" class="logout">Log Out</button></li>
        </ul>
    </header>

    <div class="container">
        <?php if ($bloodPressureEnabled): ?>
        <!-- Blood Pressure Section -->
        <div class="bp-container">
            <div class="bp-card">
                <h2>Blood Pressure</h2>
                <div class="divider"></div>
                <!-- Replace the h1 tag with an input field for editing the blood pressure value -->
                <input type="text" id="bloodPressure" name="bloodPressure" value="120/80" />
                <button id="saveButton" type="button">Save</button>
                <div class="divider"></div>
                <h2>SYS/DIA</h2>
            </div>
            <!-- Blood Pressure status -->
            <div class="status-container">
                <div class="status-indicator low" id="low">LOW</div>
                <div class="status-indicator norm" id="norm">NORM</div>
                <div class="status-indicator high" id="high">HIGH</div>
                <div class="arrow" id="bpmArrow"></div>
            </div>
        </div>
        <div class="trend-container">
        <div class="trend-header">MY TRENDS</div>
        <div class="trend-entries" id="trendEntries">
            <!-- Blood pressure entries will be added here by JavaScript -->
        </div>
    </div>
        <?php else: ?>
        <p>Blood Pressure service is currently disabled. Please contact the admin for more information.</p>
        <?php endif; ?>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {

var saveButton = document.getElementById("saveButton");
var logoutButton = document.getElementById("logoutButton");

const userEmail = "<?php echo $_SESSION['email']; ?>"; // Fetch the user's email from the session

setupEventListeners();
setupLogoutButton();
loadBpReadings(); // Load readings from local storage

function setupEventListeners() {
    saveButton.addEventListener("click", function() {
        var bpValue = document.getElementById("bloodPressure").value;
        handleBloodPressureSave(bpValue);
    });
}

function setupLogoutButton() {
    logoutButton.addEventListener("click", function() {
        var confirmation = confirm("Are you sure you want to log out?");
        if (confirmation) {
            window.location.href = "login1.php";
        }
    });
}

function handleBloodPressureSave(bpValue) {
    if (checkBloodPressure(bpValue)) { // Added function to check BP and alert if necessary
        moveArrow(bpValue);
        addBpReading(bpValue);
        alert("Blood pressure saved: " + bpValue);
    }
}

function moveArrow(bpValue) {
    var values = bpValue.split('/');
    var systolic = parseInt(values[0]);
    var diastolic = parseInt(values[1]);
    var arrow = document.getElementById('bpmArrow');
    var indicators = document.querySelectorAll('.status-indicator');
    indicators.forEach(indicator => {
        indicator.classList.remove('active');
    });

    if (systolic < 90 || diastolic < 60) {
        arrow.style.top = document.getElementById('low').offsetTop + 'px';
        document.getElementById('low').classList.add('active');
    } else if (systolic > 140 || diastolic > 90) {
        arrow.style.top = document.getElementById('high').offsetTop + 'px';
        document.getElementById('high').classList.add('active');
    } else {
        arrow.style.top = document.getElementById('norm').offsetTop + 'px';
        document.getElementById('norm').classList.add('active');
    }
}

function checkBloodPressure(bpValue) {
    var parts = bpValue.split('/');
    if (parts.length !== 2) {
        alert("Please enter the blood pressure in the format SYS/DIA.");
        return false;
    }

    var systolic = parseInt(parts[0]);
    var diastolic = parseInt(parts[1]);

    if (isNaN(systolic) || isNaN(diastolic)) {
        alert("Please make sure both systolic and diastolic values are numbers.");
        return false;
    }

    if (systolic < 90 || diastolic < 60) {
        alert("Warning: Blood Pressure is too low!");
    } else if (systolic > 140 || diastolic > 90) {
        alert("Warning: Blood Pressure is too high!");
    } else {
        alert("Blood Pressure is normal.");
    }

    return true;
}

function addBpReading(bpValue, shouldSave = true) {
    if (shouldSave) {
        saveBpReadings(bpValue);
    }
    var trendEntries = document.getElementById('trendEntries');
    var entryDiv = document.createElement('div');
    entryDiv.classList.add('trend-row');
    entryDiv.innerHTML = `
        <span>${new Date().toLocaleDateString()}</span>
        <span>${new Date().toLocaleTimeString()}</span>
        <span>${bpValue.split('/')[0]}</span>
        <span>${bpValue.split('/')[1]}</span>
    `;
    trendEntries.appendChild(entryDiv);
    trendEntries.scrollTop = trendEntries.scrollHeight; // Scroll to the latest entry
}

function loadBpReadings() {
    const readings = JSON.parse(localStorage.getItem(userEmail + '_bpReadings')) || [];
    readings.forEach(reading => addBpReading(reading.value, false));
}

function saveBpReadings(bpValue) {
    const readings = JSON.parse(localStorage.getItem(userEmail + '_bpReadings')) || [];
    readings.push({ date: new Date().toLocaleDateString(), time: new Date().toLocaleTimeString(), value: bpValue });
    localStorage.setItem(userEmail + '_bpReadings', JSON.stringify(readings));
}

var greetingElement = document.getElementById("greeting");
greetingElement.textContent = "Blood Pressure"; // Set default greeting
});

// Service toggling functionality
document.querySelectorAll('.service-toggle').forEach(button => {
button.addEventListener('click', function() {
    const service_name = this.dataset.serviceName;
    const status = this.checked ? 1 : 0;

    fetch('update_service_status.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `service_name=${encodeURIComponent(service_name)}&status=${status}`
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating the service status.');
    });
});
});

    </script>
</body>
</html>
