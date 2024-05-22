<?php
session_start();

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

// Fetch appointments from the database
$sql = "SELECT id, start_date, end_date, start_time, end_time, institute, blood_type FROM donation_appointments ORDER BY start_date, start_time";
$result = $conn->query($sql);

// Fetch the status of the Blood Pressure service
$BloodDonationEnable = false;
$serviceResult = $conn->query("SELECT is_active FROM services WHERE service_name = 'Blood Donation'");
if ($serviceResult && $row = $serviceResult->fetch_assoc()) {
    $BloodDonationEnable = $row['is_active'];
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> blood donation </title>
    <script src="donationp.js"></script>
    </head>
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

#greeting {
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


  .card {
    background-color: #fff;
    border-radius: 20px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    width: 170px;
    padding: 20px;
    min-height: 400px;
    top: 3%;
    justify-content: center; /* Centers content horizontally in the container */
    align-items: center;  
    position: absolute;
  
  }
  
  .blooddrop svg {
    
    fill: #ca4848d3; /* Change the color of the icon */
    transition: transform 0.3s ease, fill 0.3s ease; /* Smooth transition for hover effects */
}
  .appointment-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    padding: 20px;
    width: 350px;
    margin-right: auto;
    height: 50%;
    min-height: 400px;
    top: 3%;
    overflow-y: auto; /* Enables vertical scrolling */
    position: absolute;
    left:25%
  }
 

  body {
    background-color: white;
  }
  .appointment-container {
    background: #fff;
    padding: 20px;
    border-radius: 20px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    width: 270px;
    min-height: 400px; 
    position: absolute;
    left: 66%;
    top: 3%;
 }
  
table {
    width: 100%;
    border-collapse: collapse;
    font-size:11px;
  }

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}
.dropdown {
            display: inline-block;
            width: 100%;position: relative;
        }

        .dropdown button {
            width: 100%;
            padding: 10px 20px;
            text-align: left;
            background-color: #f2f2f2;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            font-size: 16px;
        }

        .dropdown button:hover {
            background-color: #e2e2e2;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #ffffff;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            width: 100%;
            border-radius: 5px;
            padding: 5px;
            top: 100%;
        }

        .dropdown-content div {
            padding: 10px;
            text-decoration: none;
            display: block;
            border-bottom: 1px solid #f2f2f2;
            color: black;
        }

        .dropdown-content div:last-child {
            border-bottom: none;
        }

        .dropdown-content div:hover {
            background-color: #ddd;
        }
    </style>
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
                    <li><button onclick="login.html" id="logoutButton" type="button" class="logout">Log Out</button></li>
              </ul>
              </header>
      
              <!-- Main content -->
                 <main class="container">
                 <?php if ($BloodDonationEnable): ?>
        <div class="appointment-container">
          <div class="dropdown">
            <button onclick="toggleDropdown('upcomingDropdown')">Upcoming Appointments</button>
            <div id="upcomingDropdown" class="dropdown-content" style="display: none;"></div>
         </div>

        <div class="dropdown">
            <button onclick="toggleDropdown('previousDropdown')">Previous Appointments</button>
            <div id="previousDropdown" class="dropdown-content" style="display: none;"></div>
        </div>
        </div>

                 <div class="card">
                  <h2 class="title" id="bloodTypeDisplay">Your blood type is: <?php echo htmlspecialchars($_SESSION['Blood_Type'] ?? 'Not provided'); ?></h2>
                  <a class="blooddrop">
        <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16a6 6 0 0 0 6-6c0-1.655-1.122-2.904-2.432-4.362C10.254 4.176 8.75 2.503 8 0c0 0-6 5.686-6 10a6 6 0 0 0 6 6M6.646 4.646l.708.708c-.29.29-1.128 1.311-1.907 2.87l-.894-.448c.82-1.641 1.717-2.753 2.093-3.13"/>
        </svg>
    </a>
</div>

                      <div class="appointment-card">
                        <p>Available Donation Appointments</p>
    <table>
        <thead>
            <tr>
                <th>Institute</th>
                <th>Date</th>
                <th>Time</th>
                <th>Blood Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['institute']); ?></td>
                        <td><?php echo htmlspecialchars($row['start_date']); ?> to <?php echo htmlspecialchars($row['end_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['start_time']); ?> - <?php echo htmlspecialchars($row['end_time']); ?></td>
                        <td><?php echo htmlspecialchars($row['blood_type']); ?></td>
                        <td><button onclick="bookAppointment(<?php echo $row['id']; ?>)">Book</button></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No available appointments</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    </div>
    <?php else: ?>
        <p>Blood Donation service is currently disabled. Please contact the admin for more information.</p>
        <?php endif; ?>
            </main>
                </body>
                <script>
document.addEventListener("DOMContentLoaded", function() {
    const defaultGreeting = "Blood Donation Section";
    const greetingElement = document.getElementById("greeting");
    greetingElement.textContent = defaultGreeting;

    const logoutButton = document.getElementById("logoutButton");
    logoutButton.addEventListener("click", function() {
        if (confirm("Are you sure you want to log out?")) {
            window.location.href = "login1.php";
        }
    });

    // Load initial appointments
    loadAppointments();
});



function bookAppointment(appointmentId) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "book_appointment.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        if (xhr.status === 200) {
            alert(xhr.responseText);
            if (xhr.responseText.includes("successfully")) {
                updateAppointmentsLocally(appointmentId);
            }
        } else {
            console.error('Failed to book appointment:', xhr.status, xhr.statusText);
        }
    };
    xhr.send(`appointmentId=${appointmentId}`);
}
function loadAppointments() {
    fetch('load_appointments.php')
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            console.error('Error:', data.error);
            return;
        }
        displayAppointments(data.upcoming, 'upcomingDropdown');
        displayAppointments(data.previous, 'previousDropdown');
    });
}

function displayAppointments(appointments, elementId) {
    const container = document.getElementById(elementId);
    container.innerHTML = ''; // Clear previous entries
    appointments.forEach(appointment => {
        const row = document.createElement('div');
        row.innerHTML = `
            <p>${appointment.institute} - ${appointment.start_date} to ${appointment.end_date} - ${appointment.start_time} to ${appointment.end_time} - ${appointment.blood_type}</p>
            ${appointment.status === 'upcoming' ? '<button onclick="completeAppointment(' + appointment.appointment_id + ')">Completed</button>' : ''}
        `;
        container.appendChild(row);
    });
}
function completeAppointment(appointmentId) {
    fetch('complete_appointment.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `appointmentId=${appointmentId}`
    })
    .then(response => response.text())
    .then(result => {
        alert(result);
        loadAppointments(); // Reload appointments to update the lists
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while completing the appointment.');
    });
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


                </html>
