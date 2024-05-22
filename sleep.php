<?php
require 'db_connection.php'; // Include your database connection file

// Fetch the status of the Blood Pressure service
$SleepTrackingEnable = false;
$result = $conn->query("SELECT is_active FROM services WHERE service_name = 'Sleep Tracking'");
if ($result && $row = $result->fetch_assoc()) {
    $SleepTrackingEnable = $row['is_active'];
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
         
body{
    margin: 0;
    padding: 0;
    font-family: 'inria', serif, ;
}

/* Rest of your CSS styles */
/* ... */
    .vectors {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%; /* Adjust the width as needed */
}

.vectors2 {
    position: fixed;
    bottom: 0;
    right: 0;
    width: 100%; /* Adjust the width as needed */
}

.container {
    background: white;
     padding: 60px;
     border-radius: 20px;
     box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

/* Sidebar styles */
.sidebar {
  background-color: #e4e4e47b; /* Sidebar background color */
  color: rgb(0, 0, 0);
  padding: 20px;
  width: 183px; /* Adjust the width as needed */
  position: fixed;
  top: 0;
  right: 20px;
  height: 91%;
  overflow: auto;
  /* Sidebar button styles */
border-radius: 20px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.sidebar h1 {
  margin-top: 0;
}

.sidebar ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.sidebar ul li {
  padding: 10px;
  width: 180px;
  border-radius: 15px;
}

.sidebar ul li a {
  color: black;
  text-decoration: none;
  transition: all 0.3s ease; /* Add transition for smooth effect */
  padding: 0px;
  padding: 10px;
  padding-left: 35px;
  padding-right: 35px;
  border-radius: 15px;
}

/* Change link color on hover */
.sidebar ul li a:hover {
  background-color: #ccc;
  width: 180px; /* Adjust the width on hover */
  border-radius: 15px;
}
.topbar {
    background: #e4e4e47b;
    color: #000000;
    padding: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: fixed;
    top: 0;
    left: 17px;
    right: 0;
    width: 76%;
    height: 50px;
    border-radius: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    z-index: 999;
}

.topbar ul {
    list-style-type: none;
    display: flex;
    align-items: center;
    margin: 0;
}

.topbar ul li {
    margin-right: 10px;
}

.logout {
    padding: 10px;
    border: none;
    border-radius: 15px;
    background-color: #FA9E9E;
    color: black;
    cursor: pointer;
}

.home-icon,
.info-icon {
    padding: 5px;
    border: none;
    border-radius: 30px;
    background-color: #fa9e9e00;
    color: #000000;
    font-size: 16px;
    cursor: pointer;
}

.logout {
    margin-left: auto; /* Push the logout button to the right */
}

#title{
  margin-right: 56%;
    color: #333;
    font-size: 25px;
}
/* Content area */
.content {
  margin-left: 220px; /* Adjust according to the width of the sidebar */
  padding: 20px;
  margin-top: 60px; /* Adjust according to the height of the topbar */
}
.container {
  margin-top: 78px; /* Adjust according to the height of the topbar */
  margin-left: 0px; /* Adjust according to the width of the sidebar */
  margin-right: 20px; /* Adjust according to the width of the topbar */
  padding: 20px;
  background-color: #e4e4e47b; /* Example background color */
  position: absolute;
  top: 6px; /* Adjust according to the height of the topbar */
  bottom: 0;
  right: 0;
  left: 20px; /* Adjust according to the width of the sidebar */
  width: calc(90% - 200px); /* Adjust the width */
  height: calc(90% - 80px); /* Adjust the height */
  align-content: center;
}
/* Style for the greeting */
#greeting {
  margin-right: 56%;
    color: #333;
    font-size: 25px;
}

.buttons{
  padding: 15px;
    border: none;
    border-radius: 4px;
    background-color: #ddd;
    color: rgb(0, 0, 0);
    cursor: pointer;
    width: 95%;
    height: 20%;
    border-radius: 15px;
}

.buttons:hover {
    background-color: #CCE4F4; /* Change the color on hover */
    transition: 1.0s;
}
.dashboard {
    display: flex;
    align-items: flex-start; /* Align the top edges of the containers */
    gap: 20px; /* Spacing between containers */
    align-items: stretch;
    height: 80%;
}

.card {
    border: 1px solid #ced4da; /* Light grey border */
    border-radius: 8px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    background: #ffffff;
}
.heart-rate {
    /* Adjust width and height as necessary */
    width: 100px;
    min-height: 200px; /* This should make the container visibly longer */
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.moon-icon {
    width: 80px;
    height: 80px;
    margin-bottom: 10px;
    color: #86779e;
}
.input {
    font-size: 13px;
    text-align: center;
    color: #6c757d; /* Dark grey color */
    border: 1px solid #ced4da; /* Example border, adjust as needed */
    border-radius: 5px; /* Rounded corners */
    padding: 5px 10px; /* Padding inside the input box */
    width: 100px; /* Set a fixed width, or adjust as needed */
}
.color-indicator div {
    width: 40px;
    height: 70px;  
    border-radius: 5px;
    margin-bottom: 5px;
}

.indicator {
    width: 40px;
    height: 114px;
    border-radius: 5px;
}

.readings {
    /* Adjust as needed */
    width: 700px;
    overflow-y: auto; /* Enable vertical scrolling */

}

.reading {
    text-align: center;
    /* Other styles as needed */
}

#saveButton {
    display: block;
    margin-top: 10px;
    padding: 5px 20px;
    font-size: 16px;
    cursor: pointer;
  }
  
  #historyList {
    list-style-type: none;
    margin: 0;
    padding: 0;
  }
  
  table {
  width: 100%; /* Set the width of the table to fill the container */
  border-collapse: collapse; /* Collapse borders between cells */
  overflow-y: auto;
}

th, td {
  text-align: left; /* Align text to the left */
  padding: 8px; /* Add padding inside table cells */
  border-bottom: 1px solid #ddd; /* Add a light border between rows */
}

th {
  background-color: #f2f2f2; /* Light grey background for headers */
}
.text{
  font-size: 14px;
  text-align: center;
}
.trend-entries {
  margin: 0;
  padding: 0;
}
    </style>
    <title>Sleep Tracking </title>
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
              <a href="HomePagep.php" class="home-icon">
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
  
          <!-- Main content -->
             <div class="container">
             <?php if ($SleepTrackingEnable): ?>

              <div class="dashboard">
                <div class="card heart-rate">
                  <svg class="moon-icon" xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-moon-fill" viewBox="0 0 16 16">
                    <path d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278"/>
                  </svg>
                  <p class="text">Enter Sleep Goal (hrs)</p>
                  <input type="text" id="sleepGoalInput" class="input" placeholder="Enter Sleep Goal">
                  <button id="saveGoalButton" type="button">Save Goal</button>
              
                  <p class="text">Enter Hours Slept (hrs)</p>
                  <input type="text" id="hoursSleptInput" class="input" placeholder="Enter Hours Slept">
                  <button id="saveSleepButton" type="button">Save Sleep</button>
                </div>
              
                <div class="card readings">
                  <div class="trends-entries"></div>
                  <table id="historyTable">
                    <thead>
                      <tr>
                        <th>Sleep Goal</th>
                        <th>Hours Slept</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody id="historyList">
                      <!-- Entries will be added here -->
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <?php else: ?>
        <p>Sleep Tracking service is currently disabled. Please contact the admin for more information.</p>
        <?php endif; ?>
             </div>
             
             <script>
              document.addEventListener("DOMContentLoaded", function() {
    var defaultGreeting = "Sleep Tracking";
    var greetingElement = document.getElementById("greeting");
    var logoutButton = document.getElementById("logoutButton");

    greetingElement.textContent = defaultGreeting;

    logoutButton.addEventListener("click", function() {
        if (confirm("Are you sure you want to log out?")) {
            localStorage.clear(); // Optionally clear localStorage on logout
            window.location.href = "login1.php";
        }
    });

    //loadSleepData(); // Load and display the sleep data from localStorage
});

// Function to handle saving the sleep goal
document.getElementById('saveGoalButton').addEventListener('click', function() {
    const sleepGoal = document.getElementById('sleepGoalInput').value;
    localStorage.setItem('sleepGoal', sleepGoal); // Save sleep goal locally
});

// Function to handle saving sleep data and updating the table
// Function to handle saving sleep data and updating the table
document.getElementById('saveSleepButton').addEventListener('click', function() {
    console.log('Save sleep button clicked'); // Check if this logs in the browser console when clicked
    
    const sleepGoal = parseFloat(localStorage.getItem('sleepGoal')) || 0; // Retrieve the saved sleep goal or default to 0
    console.log('Sleep goal:', sleepGoal); // Check if the sleep goal is correctly retrieved
    
    const hoursSlept = parseFloat(document.getElementById('hoursSleptInput').value);
    console.log('Hours slept:', hoursSlept); // Check if the hours slept are correctly retrieved
    
    const currentDate = new Date().toISOString().slice(0, 10); // Get current date in YYYY-MM-DD format
    console.log('Current date:', currentDate); // Check if the current date is correctly retrieved
    
    const newEntry = { sleepGoal, hoursSlept, date: currentDate };
    console.log('New entry:', newEntry); // Check if the new entry object is created correctly
    
    saveSleepEntry(newEntry);
    addEntryToTable(newEntry);

    // Check if the conditions for alert messages are met
    if (hoursSlept == sleepGoal) {
        alert("Great! You have reached your sleeping goal.");
    } else if (hoursSlept < sleepGoal) {
        alert("Your sleeping hours for today have not reached your current goal. This may affect your calories burning rate.");
    } else if (hoursSlept > sleepGoal) {
        alert("Your sleeping hours for today have exceeded your current goal. This may affect your calories burning rate.");
    }
});


// Function to save an entry to localStorage
function saveSleepEntry(entry) {
    const entries = JSON.parse(localStorage.getItem('sleepEntries')) || [];
    entries.push(entry);
    localStorage.setItem('sleepEntries', JSON.stringify(entries));
}


// Function to load and display entries from localStorage
function loadSleepData() {
    const entries = JSON.parse(localStorage.getItem('sleepEntries')) || [];
    entries.forEach(entry => addEntryToTable(entry));

    const savedGoal = localStorage.getItem('sleepGoal');
    if (savedGoal) {
        document.getElementById('sleepGoalInput').value = savedGoal;
    }
}

// Function to add an entry to the table
function addEntryToTable(entry) {
    const table = document.getElementById('historyList');
    const row = table.insertRow();
    row.insertCell(0).textContent = entry.sleepGoal;
    row.insertCell(1).textContent = entry.hoursSlept;
    row.insertCell(2).textContent = entry.date;
}
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
