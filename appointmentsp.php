<?php
require 'db_connection.php'; // Include your database connection file

// Fetch the status of the Blood Pressure service
$AppointmentsEnabled = false;
$result = $conn->query("SELECT is_active FROM services WHERE service_name = 'appointments'");
if ($result && $row = $result->fetch_assoc()) {
    $AppointmentsEnabled = $row['is_active'];
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="appointmentsp.css">
    <title>Appointments</title>
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
            <p id="greeting" style="white-space: nowrap;">Appointments</p>
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
    <?php if ($AppointmentsEnabled): ?>
        <div class="UpcomingAppointments-container">
            <h2 class="appointment-title">Upcoming Appointments</h2>
            <div class="appointments-scroll">
                <table id="upcomingAppointmentsList">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Hospital</th>
                            <th>Clinic</th>
                            <th>Doctor</th>
                            <th>Action</th> <!-- Added Action header -->
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Appointments will be dynamically added here -->
                    </tbody>
                </table>
            </div>
        </div>

        <div class="PreviousAppointments-container">
            <h2 class="previous-appointments-title">Previous Appointments</h2>
            <div class="appointments-scroll">
                <table id="previousAppointmentsList">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Hospital</th>
                            <th>Clinic</th>
                            <th>Doctor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Appointments will be dynamically added here -->
                    </tbody>
                </table>
            </div>
        </div>

        <div class="BookAnAppintment-container">
            <div class="dropdown-container">
                <button class="dropdown-button" id="bookAppointment">Book an Appointment</button>
                <form id="appointmentForm" class="dropdown-content" style="display: none;">
                    <select id="hospitalDropdown" name="hospital_id" required>
                        <option value="">Choose Hospital</option>
                    </select>
                    <select id="clinicDropdown" name="clinic_id" required>
                        <option value="">Choose Clinic</option>
                    </select>
                    <select id="doctorDropdown" name="doctor_id" required>
                        <option value="">Choose Doctor</option>
                    </select>
                    <input type="date" name="appointment_date" required>
                    <input type="time" name="appointment_time" required>
                    <button type="button" id="saveButton">Save</button>
                    <button type="reset" id="resetButton">Reset</button>
                </form>
            </div>
        </div>
        <?php else: ?>
        <p>Appointments service is currently disabled. Please contact the admin for more information.</p>
        <?php endif; ?>
    </div>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    let patientsFile;

    // Fetch session data to get patients_file
    fetch('getSessionData.php')
        .then(response => response.json())
        .then(data => {
            if (data.patients_file) {
                patientsFile = data.patients_file;
                fetchAppointments();
            } else {
                console.error('Patients file not found in session');
            }
        })
        .catch(error => console.error('Failed to fetch session data:', error));

    // Fetch hospitals data and populate dropdown
    fetchData('getHospitals.php', 'hospitalDropdown');

    // Event listener for hospital dropdown change
    document.getElementById('hospitalDropdown').addEventListener('change', function() {
        fetchData(`getClinics.php?hospital_id=${this.value}`, 'clinicDropdown');
    });

    // Event listener for clinic dropdown change
    document.getElementById('clinicDropdown').addEventListener('change', function() {
        fetchData(`getDoctors.php?clinic_id=${this.value}`, 'doctorDropdown');
    });

    // Event listener for book appointment button
    document.getElementById('bookAppointment').addEventListener('click', function() {
        const formDisplay = document.getElementById('appointmentForm').style.display;
        document.getElementById('appointmentForm').style.display = formDisplay === 'none' ? 'block' : 'none';
    });

    // Event listener for save appointment button
    document.getElementById('saveButton').addEventListener('click', function(event) {
        event.preventDefault();
        const form = document.getElementById('appointmentForm');
        const formData = new FormData(form);
        formData.append('patients_file', patientsFile); // Include patients_file in the form data

        fetch('saveAppointment.php', {
            method: 'POST',
            body: formData
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    const appointment = {
                        appointment_date: formData.get('appointment_date'),
                        appointment_time: formData.get('appointment_time'),
                        hospital_name: document.querySelector('#hospitalDropdown option:checked').textContent,
                        clinic_name: document.querySelector('#clinicDropdown option:checked').textContent,
                        doctor_name: document.querySelector('#doctorDropdown option:checked').textContent,
                        status: 'upcoming', // Set the status for the new appointment
                        appointment_id: data.appointment_id // Ensure appointment_id is included
                    };
                    addAppointmentToTable(appointment, 'upcomingAppointmentsList');
                    alert("Appointment saved successfully!");
                } else {
                    alert(data.error || 'Failed to save appointment');
                }
            })
            .catch((error) => {
                console.error('Error:', error);
                alert("Failed to save appointment. Please try again.");
            });
    });

    // Function to fetch data from server and populate dropdown
    function fetchData(url, elementId, nameKey = 'name') {
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const select = document.getElementById(elementId);
                select.innerHTML = `<option value="">Choose ${elementId.replace('Dropdown', '')}</option>`;
                data.forEach(item => {
                    select.innerHTML += `<option value="${item.id}">${item[nameKey]}</option>`;
                });
            })
            .catch(error => {
                console.error('There has been a problem with your fetch operation:', error);
                document.getElementById(elementId).innerHTML = `<option value="">Error loading data</option>`;
            });
    }

    // Function to add appointment to table
    function addAppointmentToTable(appointment, tableId) {
    const table = document.getElementById(tableId).getElementsByTagName('tbody')[0];

    // Check if the appointment is already in the table
    const existingRow = Array.from(table.rows).find(row => row.cells[0].textContent === appointment.appointment_date &&
        row.cells[1].textContent === appointment.appointment_time &&
        row.cells[2].textContent === appointment.hospital_name &&
        row.cells[3].textContent === appointment.clinic_name &&
        row.cells[4].textContent === appointment.doctor_name);

    // If the appointment is not in the table, add it
    if (!existingRow) {
        const row = table.insertRow();
        const cellDate = row.insertCell(0);
        const cellTime = row.insertCell(1);
        const cellHospital = row.insertCell(2);
        const cellClinic = row.insertCell(3);
        const cellDoctor = row.insertCell(4);
        const cellAction = row.insertCell(5); // Add a cell for the action button

        cellDate.textContent = appointment.appointment_date;
        cellTime.textContent = appointment.appointment_time;
        cellHospital.textContent = appointment.hospital_name;
        cellClinic.textContent = appointment.clinic_name;
        cellDoctor.textContent = appointment.doctor_name;

        if (appointment.status === 'upcoming' || appointment.status === 'scheduled') {
            const completeButton = document.createElement('button');
            completeButton.textContent = 'Completed';
            completeButton.onclick = function() {
                completeAppointment(appointment.appointment_id);
                row.remove();
            };
            cellAction.appendChild(completeButton);
        }
    }
}

function fetchAppointments() {
    fetch('fetchAppointments.php')
        .then(response => response.json())
        .then(data => {
            const upcomingList = document.getElementById('upcomingAppointmentsList').getElementsByTagName('tbody')[0];
            upcomingList.innerHTML = ''; // Clear existing entries
            const previousList = document.getElementById('previousAppointmentsList').getElementsByTagName('tbody')[0];
            previousList.innerHTML = ''; // Clear existing entries

            data.forEach(appointment => {
                console.log("Fetched appointment:", appointment); // Log each appointment fetched
                if (appointment.status === 'completed') {
                    addAppointmentToTable(appointment, 'previousAppointmentsList');
                } else {
                    addAppointmentToTable(appointment, 'upcomingAppointmentsList');
                }
            });
        })
        .catch(error => console.error('Failed to fetch appointments:', error));
}


    // Logout button functionality
    document.getElementById("logoutButton").addEventListener("click", function() {
        var confirmation = confirm("Are you sure you want to log out?");
        if (confirmation) {
            window.location.href = "login1.php";
        }
    });

});
function completeAppointment(appointmentId) {
    fetch('completeAppointment.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: appointmentId })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                fetchAppointments(); // Refresh the list of appointments
            } else {
                console.error('Failed to complete appointment:', data.error);
            }
        })
        .catch(error => console.error('Error completing appointment:', error));
}


</script>
</body>
</html>
