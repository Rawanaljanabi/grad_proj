<?php
require 'db_connection.php'; // Include your database connection file

// Fetch the status of the Blood Pressure service
$HeartRateEnable = false;
$result = $conn->query("SELECT is_active FROM services WHERE service_name = 'Heart Rate'");
if ($result && $row = $result->fetch_assoc()) {
    $HeartRateEnable = $row['is_active'];
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="heartrate.css">
    <title>Heart Rate </title>
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


        <div class="container">
        <?php if ($HeartRateEnable): ?>

          <div class="dashboard">
              <div class="card heart-rate">
                <svg xmlns="http://www.w3.org/2000/svg" class="heart-icon" fill="currentColor" viewBox="0 0 16 16">
                  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053.918 3.995.78 5.323 1.508 7H.43c-2.128-5.697 4.165-8.83 7.394-5.857q.09.083.176.171a3 3 0 0 1 .176-.17c3.23-2.974 9.522.159 7.394 5.856h-1.078c.728-1.677.59-3.005.108-3.947C13.486.878 10.4.28 8.717 2.01zM2.212 10h1.315C4.593 11.183 6.05 12.458 8 13.795c1.949-1.337 3.407-2.612 4.473-3.795h1.315c-1.265 1.566-3.14 3.25-5.788 5-2.648-1.75-4.523-3.434-5.788-5"/>
                  <path d="M10.464 3.314a.5.5 0 0 0-.945.049L7.921 8.956 6.464 5.314a.5.5 0 0 0-.88-.091L3.732 8H.5a.5.5 0 0 0 0 1H4a.5.5 0 0 0 .416-.223l1.473-2.209 1.647 4.118a.5.5 0 0 0 .945-.049l1.598-5.593 1.457 3.642A.5.5 0 0 0 12 9h3.5a.5.5 0 0 0 0-1h-3.162z"/>
                </svg>
                  <input type="text" id="heartRateInput" class="bpm-input" placeholder="Enter BPM">
                  <button id="saveButton" type="button">Save</button> 
              </div>
              <div class="card color-indicator">
                <div class="maximum"><span class="tooltip">Maximum</span></div>
                <div class="hard"><span class="tooltip">Hard</span></div>
                <div class="moderate"><span class="tooltip">Moderate</span></div>
                <div class="light"><span class="tooltip">Light</span></div>
                <div class="verylight"><span class="tooltip">Very Light</span></div>
              </div>
              <div class="card readings">
                <div class="table-container">
                  <table id="historyTable">
                      <thead>
                          <tr>
                              <th>Reading (BPM)</th>
                              <th>Range</th>
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
        <p>Heart Rate service is currently disabled. Please contact the admin for more information.</p>
        <?php endif; ?>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var defaultGreeting = "Heart Rate";
                var greetingElement = document.getElementById("greeting");
                greetingElement.textContent = defaultGreeting;
    
                var logoutButton = document.getElementById("logoutButton");
                logoutButton.addEventListener("click", function() {
                    var confirmation = confirm("Are you sure you want to log out?");
                    if (confirmation) {
                        window.location.href = "login1.php";
                    }
                });
    
                // Load entries from local storage on page load
                //loadEntries();
    
                // Add event listener for the save button
                document.getElementById('saveButton').addEventListener('click', function() {
                    var heartRate = document.getElementById('heartRateInput').value;
                    var date = new Date().toLocaleDateString("en-US");
                    var range = getRange(heartRate);
    
                    // Update the color indicator based on the BPM
                    updateColorIndicator(parseInt(heartRate, 10));
    
                    // Add entry to history table
                    addEntryToHistory(heartRate, range, date);
    
                    // Clear input
                    document.getElementById('heartRateInput').value = '';
    
                    // Check for maximum and minimum heart rates
                    if (range === 'Maximum') {
                        alert('Your heart rate has reached the maximum level!');
                    } else if (range === 'Very Light') {
                        alert('Your heart rate has reached the lowest level!');
                    }
    
                    // Save entries to local storage
                    saveEntries();
                });
            });
    
            // Function to load entries from local storage
            function loadEntries() {
                var entries = localStorage.getItem('heartRateEntries');
                if (entries) {
                    var historyList = document.getElementById('historyList');
                    historyList.innerHTML = entries;
                }
            }
    
            // Function to add entry to history table
            function addEntryToHistory(heartRate, range, date) {
                var historyList = document.getElementById('historyList');
                var row = historyList.insertRow(); // Insert a new row at the end of the table
                var cell1 = row.insertCell(0); // Create a cell for the reading
                var cell2 = row.insertCell(1); // Create a cell for the range
                var cell3 = row.insertCell(2); // Create a cell for the date
    
                cell1.textContent = heartRate;
                cell2.textContent = range;
                cell3.textContent = date;
            }
    
            // Function to save entries to local storage
            function saveEntries() {
                var historyList = document.getElementById('historyList').innerHTML;
                localStorage.setItem('heartRateEntries', historyList);
            }
    
            // Function to update color indicator based on BPM
            function updateColorIndicator(bpm) {
                var element = document.querySelector(".color-indicator");
                element.children[0].className = "";
                element.children[1].className = "";
                element.children[2].className = "";
                element.children[3].className = "";
                element.children[4].className = "";
    
                if (bpm < 60) element.children[4].className = "verylight";
                else if (bpm >= 60 && bpm < 70) element.children[3].className = "light";
                else if (bpm >= 70 && bpm < 85) element.children[2].className = "moderate";
                else if (bpm >= 85 && bpm < 100) element.children[1].className = "hard";
                else element.children[0].className = "maximum";
            }
    
            // Function to get heart rate range
            function getRange(bpm) {
                bpm = parseInt(bpm, 10);
                if (bpm < 60) return 'Very Light';
                else if (bpm >= 60 && bpm < 70) return 'Light';
                else if (bpm >= 70 && bpm < 85) return 'Moderate';
                else if (bpm >= 85 && bpm < 100) return 'Hard';
                else return 'Maximum';
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
