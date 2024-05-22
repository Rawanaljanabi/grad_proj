<?php
require 'db_connection.php'; // Include your database connection file

$user_id = $_SESSION['email'] ?? '';

// Fetch the status of the Blood Pressure service
$StepsCdaloriesEnable = false;
$result = $conn->query("SELECT is_active FROM services WHERE service_name = 'Steps & Calories'");
if ($result && $row = $result->fetch_assoc()) {
    $StepsCdaloriesEnable = $row['is_active'];
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="calories.css">
    <title> calories & Steps </title>
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
                <p id="greeting" style="white-space: nowrap;"> Calories & Steps</p>
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
                  <li>
                      <button type="button" id="logoutButton" class="logout">Log Out</button>
                  </li>
              </ul>
              </header>
                 <div class="container">
                 <?php if ($StepsCdaloriesEnable): ?>
                  <div id="calories-&-steps-content" >
                    <div class="left-content">
                                <form id="calorieForm">
                                    <input placeholder="Enter daily calories goal" type="number" id="caloriesInput" required>
                                    <input placeholder="Enter your weight (kg)" type="number" id="weightInput" required>
                                    <button class="button" type="submit">Calculate Steps and Time</button>
                                </form>
                                <div id="result">
                                    <p id="stepsNeeded">Steps needed: --</p>
                                    <p id="timeRequired">Time required: --</p>
                                </div>
                            </div>
    
                            <div class="cal-card">
                                <button type="button" id="updateButton" class="updateButton">Update</button>
                              
                                    <h2>% of Daily Steps Goal</h2>
                                    <div class="progress-circle" data-percentage="75">
                                        <span class="progress-value">0%</span>
                                    </div>
                                    <div class="steps-info">
                                      <div class="steps-current">
                                          <span class="steps-title">Steps Taken</span>
                                          <input class="steps-number" id="stepsInput" onchange="updateProgressBar()"> <!-- Added onchange event -->
                                      </div>
                                      <div class="steps-goal">
                                          <span class="steps-title">Daily Goal</span>
                                          <input class="steps-number" id="stepsGoal" readonly> <!-- This field is now read-only and shows the goal -->
                                      </div>
                                  </div>
                                </div>
                              </div>
                              <?php else: ?>
        <p>calories and steps service is currently disabled. Please contact the admin for more information.</p>
        <?php endif; ?>
                            </div>
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    var defaultGreeting = "Calories & Steps";
                                    var greetingElement = document.getElementById("greeting");
                                    var logoutButton = document.getElementById("logoutButton");
                                    var updateButton = document.getElementById("updateButton");
                                
                                    greetingElement.textContent = defaultGreeting;
                                

                                    
                                    logoutButton.addEventListener("click", function() {
                                        var confirmation = confirm("Are you sure you want to log out?");
                                        if (confirmation) {
                                            localStorage.clear(); // Clear localStorage on logout
                                            window.location.href = "login1.php";
                                        }
                                    });
                                
                                    document.getElementById('calorieForm').addEventListener('submit', calculateSteps);
                                    updateButton.addEventListener('click', updateProgressBar);
                                
                                    loadSavedData(); // Load saved data from localStorage
                                });
                                
                                function calculateSteps(event) {
                                    event.preventDefault();
                                    const caloriesGoal = parseFloat(document.getElementById('caloriesInput').value);
                                    const weight = parseFloat(document.getElementById('weightInput').value);
                                
                                    // Adjusting calories per step based on the user's weight and metabolic rate
                                    const caloriesPerStep = 0.05 * weight; // Adjusted based on user's weight and metabolic rate
                                    const stepsPerCalorie = 1 / caloriesPerStep; // Steps per calorie
                                
                                    // Assuming an average of 100 steps per minute (a brisk walking pace)
                                    const stepsPerMinute = 100;
                                
                                    const stepsNeeded = Math.round(caloriesGoal * stepsPerCalorie);
                                    const minutesRequired = Math.round(stepsNeeded / stepsPerMinute);
                                
                                    document.getElementById('stepsNeeded').textContent = `Steps needed: ${stepsNeeded}`;
                                    document.getElementById('timeRequired').textContent = `Time required: ${minutesRequired} minutes`;
                                    document.getElementById('stepsGoal').value = stepsNeeded;
                                
                                    // Saving data to localStorage
                                    localStorage.setItem('caloriesGoal', caloriesGoal);
                                    localStorage.setItem('weight', weight);
                                    localStorage.setItem('stepsNeeded', stepsNeeded);
                                    localStorage.setItem('timeRequired', minutesRequired);
                                
                                    updateProgressBar();
                                }
                                
                                function updateProgressBar() {
                                    const stepsGoal = parseFloat(document.getElementById('stepsGoal').value || 0);
                                    const stepsTaken = parseFloat(document.getElementById('stepsInput').value || 0);
                                    const percentage = stepsTaken / stepsGoal * 100;
                                
                                    const progressCircle = document.querySelector('.progress-circle');
                                    progressCircle.style.setProperty('--percentage', `${Math.round(percentage)}%`);
                                    document.querySelector('.progress-value').textContent = `${Math.round(percentage)}%`;
                                
                                    localStorage.setItem('stepsTaken', stepsTaken);
                                }
                                
                                function loadSavedData() {
                                    if(localStorage.getItem('caloriesGoal')) {
                                        document.getElementById('caloriesInput').value = localStorage.getItem('caloriesGoal');
                                        document.getElementById('weightInput').value = localStorage.getItem('weight');
                                        document.getElementById('stepsGoal').value = localStorage.getItem('stepsNeeded');
                                        document.getElementById('stepsInput').value = localStorage.getItem('stepsTaken');
                                        document.getElementById('stepsNeeded').textContent = `Steps needed: ${localStorage.getItem('stepsNeeded')}`;
                                        document.getElementById('timeRequired').textContent = `Time required: ${localStorage.getItem('timeRequired')} minutes`;
                                        updateProgressBar();
                                    }
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
