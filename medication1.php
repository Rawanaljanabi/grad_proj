<?php
session_start();
include 'db.php'; // Include your database connection file

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $query_file = "SELECT patients_file FROM users WHERE email = ?";
    if ($stmt = $mysqli->prepare($query_file)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result_file = $stmt->get_result();

        if ($result_file && $row_file = $result_file->fetch_assoc()) {
            $patients_file = $row_file['patients_file'];

            $query_prescriptions = "SELECT medicine_name, dose, medicine_description FROM prescriptions WHERE patients_file = ?";
            if ($stmt_prescriptions = $mysqli->prepare($query_prescriptions)) {
                $stmt_prescriptions->bind_param("s", $patients_file);
                $stmt_prescriptions->execute();
                $result_prescriptions = $stmt_prescriptions->get_result();

                $prescriptions = [];
                while ($row_prescription = $result_prescriptions->fetch_assoc()) {
                    $prescriptions[] = $row_prescription;
                }
            } else {
                echo "Error preparing prescriptions query: " . $mysqli->error;
            }
        } else {
            echo "Error fetching patients file: " . $mysqli->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing file query: " . $mysqli->error;
    }
} else {
    echo "User email not set in session.<br>";
}
// Fetch the status of the Blood Pressure service
$MedicationTrackEnable = false;
$result = $mysqli->query("SELECT is_active FROM services WHERE service_name = 'Medication Track'");
if ($result && $row = $result->fetch_assoc()) {
    $MedicationTrackEnable = $row['is_active'];
}
mysqli_close($mysqli);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="medications.css">
    <title>Medications</title>
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
/* General Styles for Tables */
table#medicationsTable {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

table#medicationsTable th, 
table#medicationsTable td {
  border: 1px solid #ccc;
  padding: 8px;
  text-align: left;
}

table#medicationsTable th {
  background-color: #f9f9f9;
}

table#medicationsTable tbody tr:hover {
  background-color: #f1f1f1;
}

tbody tr:hover {
background-color: #f1f1f1; /* Light grey background on row hover for interactivity */
}

/* Styling for Action Buttons in Table Cells */
table button {
background-color: #CCE4F4; /* A fresh green color for action buttons */
color: white; /* White text for high contrast */
padding: 6px 12px;
border: none;
border-radius: 4px; /* Rounded corners for the buttons */
cursor: pointer; /* Pointer cursor on hover */
transition: background-color 0.3s; /* Smooth transition for hover effect */
}

table button:hover {
background-color: #CCE4F7; /* Darker shade of green on hover */
}

/* Responsive Table Adjustments */
@media screen and (max-width: 768px) {
table, thead, tbody, th, td, tr {
    display: block;
}

thead tr {
    position: absolute;
    top: -9999px;
    left: -9999px;
}

tr { border: 1px solid #ccc; }

td {
    /* Behave like a "row" */
    border: none;
    position: relative;
    padding-left: 50%; /* Make space for content to be more readable */
    text-align: right;
}

td:before {
    /* Now like a table header */
    position: absolute;
    top: 6px;
    left: 6px;
    width: 45%; /* Allocate width for header labels */
    padding-right: 10px; /* Right padding for spacing */
    white-space: nowrap; /* Ensure the header text does not wrap */
    text-align: left;
    font-weight: bold;
}

/* Label the data */
td:nth-of-type(1):before { content: "Name"; }
td:nth-of-type(2):before { content: "Dose"; }
td:nth-of-type(3):before { content: "Action"; }
}

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
 
.container {
  background: white;
   padding: 60px;
   border-radius: 20px;
   box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

.container {
  display: flex; /* Use flexbox to layout children */
  justify-content: center; /* Center children horizontally */
  align-items: center; /* Align children vertically */
  flex-wrap: wrap; /* Allow items to wrap as needed */
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

@media (max-width: 768px) {
  .container {
      flex-direction: column; /* Stack children vertically on small screens */
  }
}
.UpcomingMedications-container{
  background: #ddd;
  padding: 15px;
  border-radius: 10px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  width: 300px; /* Fixed width */
  min-height: 400px;
  margin: 20px; /* Spacing between containers */
  position: relative;
  flex: 0 0 auto; /* Do not grow, do not shrink, and do not change the basis */
}

/* Specific Container Styles */
 .AddNewMedication-container, .Prescriptions-container {
  background: #ddd;
  padding: 15px;
  border-radius: 10px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  width: px; /* Fixed width */
  min-height: 400px;
  margin: 20px; /* Spacing between containers */
  position: relative;
  flex: 0 0 auto; /* Do not grow, do not shrink, and do not change the basis */
}
.new-medication-dot {
  height: 10px;
  width: 10px;
  background-color: red;
  border-radius: 50%;
  display: inline-block;
  margin-left: 10px;
}

/* Form Styles */
#medicationForm input[type="text"],
#medicationForm input[type="time"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
  margin-bottom: 10px;
}

#medicationForm button {
  padding: 10px 20px;
  background-color: #FA9E9E;
  color: black;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  width: calc(50% - 5px);
  margin-right: 5px;
}

#medicationForm button:hover {
  background-color: #CCE4F4;
}

/* Dropdown Styles */
.dropdown select {
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
  background-color: #fff;
  box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
  outline: none;
  -moz-appearance: none;
  -webkit-appearance: none;
  appearance: none;
}

.dropdown select:hover {
  border-color: #999;
}

.dropdown select:focus {
  border-color: #ddd;
  box-shadow: 0 0 3px #ddd;
}

#addMedicationButton {
  font-size: 13px;
  transition: background-color 0.3s ease;
  outline: none; /* Remove the outline */
  margin-top: 2px; /* Additional space above the button */
  margin-bottom: 10px;
  display: inline-block; /* Allows setting margin and other spacing properties */
  text-align: center;
  min-width: 150px; /* Minimum width */
  padding: 15px;
  border: none;
  border-radius: 4px;
  background-color: #FA9E9E;
  color: rgb(0, 0, 0);
  cursor: pointer;
  width: 95%;
  height: 15%;
  border-radius: 15px;
  margin-left: 2%;

}

#addMedicationButton:hover {
  background-color: #CCE4F4; /* Darker shade of button color for hover state */
}
/* Additional styles for form elements */
#medicationForm input[type=text],
#medicationForm input[type=time] {
display: block;
margin-bottom: 10px;
padding: 10px;
border: 1px solid #ddd; /* Light gray border */
border-radius: 5px;
width: 90%; 
}

#medicationForm button {
padding: 5px ;
width: 30%;
border: none;
border-radius: 5px;
cursor: pointer;
font-size: 16px;
margin-left: 25px;
margin-right: 5px;
transition: background-color 0.3s ease;
}
.scrollable-table {
  max-height: 330px; /* Adjust the height as needed */
  overflow-y: auto;
  margin-top: 20px;
  border: 1px solid #ddd; /* Optional: add border for better visual */
}

.scrollable-table table {
  width: 100%;
  border-collapse: collapse;
}

.scrollable-table th, .scrollable-table td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

.scrollable-table th {
  background-color: #f2f2f2;
}



</style>
<body>
    <img class="vectors" src="blu vec.png">
    <img class="vectors2" src="pink vec.png">

    <aside class="sidebar">
        <h1>Care</h1>
        <ul>
            <li><button onclick="location.href='bloodPressure.PHP'" class="buttons">Blood Pressure</button></li>
            <li><button onclick="location.href='calories.PHP'" class="buttons">Calories & Steps</button></li>
            <li><button onclick="location.href='sleep.PHP'" class="buttons">Sleep Tracking</button></li>
            <li><button onclick="location.href='medication1.php'" class="buttons">Medications</button></li>
            <li><button onclick="location.href='heartRate.PHP'" class="buttons">Heart Rate</button></li>
            <li><button onclick="location.href='appointmentsp.php'" class="buttons">Appointments</button></li>
            <li><button onclick="location.href='donationp.php'" class="buttons">Blood Donation</button></li>
        </ul>
    </aside>

    <header class="topbar">
        <div>
            <p id="greeting" style="white-space: nowrap;"></p>
        </div>
        <ul>
            <li><a href="homepagep.php" class="home-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                </svg></a>
            </li>
            
            <li><a href="complaintsp.php" class="info-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                </svg>
            </a></li>
            <li> 
                <a href="notificationsp.php" class="info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6"/>
                    </svg>
                </a>
            </li>
            <li><button onclick="location.href='login1.php'" id="logoutButton" class="logout">Log Out</button></li>
        </ul>
    </header>

    <div class="container">
    <?php if ($MedicationTrackEnable): ?>

        <div class="UpcomingMedications-container">
            <h2>Medications History</h2>
            <div class="scrollable-table">
                <table id="medicationsTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Dose</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Medications will be displayed here -->
                    </tbody>
                </table>
            </div>
        </div>

        <div class="AddNewMedication-container">
            <h2>Add New Medication</h2>
            <div id="medicationForm">
                <form>
                    <input type="text" id="medicationName" name="name" placeholder="Enter name" required>
                    <input type="text" id="medicationDose" name="dose" placeholder="Enter dose" required>
                    <input type="date" id="medicationDate" name="date" required>
                    <button type="button" id="saveMedicationButton">Save</button>
                </form>
            </div>
        </div>

        <div class="Prescriptions-container">
            <div class="dropdown">
                <h2>Prescriptions</h2>
                <select id="newPrescriptions" onchange="showPrescriptionDetails()">
                    <option value="">Select...</option>
                    <?php foreach ($prescriptions as $index => $prescription): ?>
                        <option value="<?php echo $index; ?>"><?php echo $prescription['medicine_name']; ?> - <?php echo $prescription['dose']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div id="prescriptionDetails" style="margin-top: 20px; border: 1px solid #ccc; padding: 10px;">
                <!-- Prescription details will appear here -->
            </div>
        </div>
        <?php else: ?>
        <p>Medication Track service is currently disabled. Please contact the admin for more information.</p>
        <?php endif; ?>
    </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
    var logoutButton = document.getElementById("logoutButton");
    logoutButton.addEventListener("click", function() {
        var confirmation = confirm("Are you sure you want to log out?");
        if (confirmation) {
            localStorage.removeItem(userEmail + '_medications'); // Clear user-specific localStorage on logout
            window.location.href = "login1.php";
        }
    });

    var defaultGreeting = "Medications";
    var greetingElement = document.getElementById("greeting");
    greetingElement.textContent = defaultGreeting;

    const userEmail = "<?php echo $_SESSION['email']; ?>"; // Fetch the user's email from the session

    // Initial display of medications
    displayMedications();

    document.getElementById('saveMedicationButton').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent any form submission

        const name = document.getElementById('medicationName').value;
        const dose = document.getElementById('medicationDose').value;
        const date = document.getElementById('medicationDate').value;

        if (!name || !dose || !date) {
            alert('Please fill in all fields.');
            return;
        }

        const newMedication = {
            name: name,
            dose: dose,
            date: date
        };

        updateLocalStorageWithMedication(newMedication);
        displayMedications();

        document.querySelector('#medicationForm form').reset(); // Reset the form
        alert('Medication saved successfully!');
    });

    function updateLocalStorageWithMedication(newMedication) {
        let medications = JSON.parse(localStorage.getItem(userEmail + '_medications')) || [];
        medications.push(newMedication);
        localStorage.setItem(userEmail + '_medications', JSON.stringify(medications));
    }

    function displayMedications() {
        const medications = JSON.parse(localStorage.getItem(userEmail + '_medications')) || [];
        const tableBody = document.querySelector('#medicationsTable tbody');
        tableBody.innerHTML = ''; // Clear previous entries

        medications.forEach((med) => {
            let row = tableBody.insertRow();
            row.insertCell(0).textContent = med.name;
            row.insertCell(1).textContent = med.dose;
            row.insertCell(2).textContent = med.date;
        });
    }

    function showPrescriptionDetails() {
        var prescriptions = <?php echo json_encode($prescriptions); ?>;
        var selectedIndex = document.getElementById('newPrescriptions').value;
        var detailsContainer = document.getElementById('prescriptionDetails');

        if (selectedIndex === "") {
            detailsContainer.innerHTML = "Select a prescription to view details.";
            return;
        }

        var selectedPrescription = prescriptions[selectedIndex];
        detailsContainer.innerHTML = `
            <p><strong>Name:</strong> ${selectedPrescription.medicine_name}</p>
            <p><strong>Dose:</strong> ${selectedPrescription.dose}</p>
            <p><strong>Description:</strong> ${selectedPrescription.medicine_description}</p>
        `;
    }

    document.getElementById('newPrescriptions').addEventListener('change', showPrescriptionDetails);

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
});

  </script>
</body>
</html>
