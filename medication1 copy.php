<?php
session_start();
include 'db.php'; // Include your database connection file

// Debug function to print session data
function debugSession() {
    echo "<pre>Session Data:\n";
    print_r($_SESSION);
    echo "</pre>";
}

// Check if email exists in session
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Debugging: Print session email
    echo "Session email: $email <br>";

    // Fetch patients_file from users table
    $query_file = "SELECT patients_file FROM users WHERE email = '$email'";
    $result_file = mysqli_query($conn, $query_file);

    if ($result_file) {
        $row_file = mysqli_fetch_assoc($result_file);
        $patients_file = $row_file['patients_file'];

        // Debugging: Print patients_file
        echo "Patients File: $patients_file <br>";

        // Fetch prescriptions using patients_file
        $query_prescriptions = "SELECT medicine_name, dose, medicine_description FROM prescriptions WHERE patients_file = '$patients_file'";
        $result_prescriptions = mysqli_query($conn, $query_prescriptions);

        $prescriptions = [];
        if ($result_prescriptions) {
            while ($row_prescription = mysqli_fetch_assoc($result_prescriptions)) {
                $prescriptions[] = $row_prescription;
            }
        } else {
            echo "Error fetching prescriptions: " . mysqli_error($conn);
        }
    } else {
        echo "Error fetching patients file: " . mysqli_error($conn);
    }
} else {
    echo "User email not set in session.<br>";
    debugSession(); // Debugging: Print session data
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="medications.css">
    <title>Medications</title>
</head>
<body>
    <img class="vectors" src="blu vec.png">
    <img class="vectors2" src="pink vec.png">

    <aside class="sidebar">
        <h1>Care</h1>
        <ul>
            <li><button onclick="location.href='bloodPressure.html'" class="buttons">Blood Pressure</button></li>
            <li><button onclick="location.href='calories.html'" class="buttons">Calories & Steps</button></li>
            <li><button onclick="location.href='sleep.html'" class="buttons">Sleep Tracking</button></li>
            <li><button onclick="location.href='medication1.php'" class="buttons">Medications</button></li>
            <li><button onclick="location.href='heartRate.html'" class="buttons">Heart Rate</button></li>
            <li><button onclick="location.href='appointmentsp.php'" class="buttons">Appointments</button></li>
            <li><button onclick="location.href='donationp.html'" class="buttons">Blood Donation</button></li>
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
            <li><button type="button" class="info-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                </svg></button></li>
            <li><a href="complaints.html" class="info-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                </svg>
            </a></li>
            <li><button onclick="location.href='login1.php'" id="logoutButton" class="logout">Log Out</button></li>
        </ul>
    </header>

    <div class="container">
        <div class="UpcomingMedications-container">
            <h2>Medications History</h2>
            <table id="medicationsTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Dose</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($prescriptions)): ?>
                        <?php foreach ($prescriptions as $prescription): ?>
                            <tr>
                                <td><?php echo $prescription['medicine_name']; ?></td>
                                <td><?php echo $prescription['dose']; ?></td>
                                <td><button>Remove</button></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">No prescriptions found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="AddNewMedication-container">
            <h2>Add New Medication</h2>
            <button id="addMedicationButton">+ Add New Medication</button>
            <div id="medicationForm">
                <form>
                    <input type="text" id="medicationName" name="name" placeholder="Enter name" required>
                    <input type="text" id="medicationDose" name="dose" placeholder="Enter dose" required>
                    <input type="time" id="medicationTime" name="medicationTime">
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
    </div>

    <script>        saveMedicationButton.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent any form submission
        const formData = new FormData(medicationForm.querySelector('form'));

        if (!formData.get('name') || !formData.get('dose')) {
            alert('Please fill in all fields.');
            return;
        }

        // Convert FormData to URLSearchParams if your server expects URL encoded form data
        const urlEncodedData = new URLSearchParams();
        formData.forEach((value, key) => urlEncodedData.append(key, value));

        fetch('Medications.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: urlEncodedData
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not OK');
            return response.json();
        })
        .then(data => {
            if (data.error) {
                alert('Failed to save medication: ' + data.error);
            } else {
                alert('Medication saved successfully!');
                // Properly prepare the object for local storage
                const newMedication = {
                    name: formData.get('name'),
                    dose: formData.get('dose'),
                    time: formData.get('medicationDate'), // Assuming there's a time field
                    completed: false // Set medication as not completed initially
                };
                updateLocalStorageWithMedication(newMedication); // Update local storage
                displayMedications(); // Refresh display
                medicationForm.querySelector('form').reset(); // Reset the form after successful data submission
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to save medication. Please try again.');
        });
    });
        displayMedications(); // Initial display of medications

function updateLocalStorageWithMedication(newMedication) {
    let medications = JSON.parse(localStorage.getItem('medications')) || [];
    medications.push(newMedication);
    localStorage.setItem('medications', JSON.stringify(medications));
}
        function displayMedications() {
    const medications = JSON.parse(localStorage.getItem('medications')) || [];
    const tableBody = document.querySelector('#medicationsTable tbody');
    tableBody.innerHTML = ''; // Clear previous entries

    medications.forEach((med, index) => {
        let row = tableBody.insertRow();
        row.insertCell(0).textContent = med.name;
        row.insertCell(1).textContent = med.dose;
        row.insertCell(2).textContent = med.date;

        let statusCell = row.insertCell(2);
       
        
    });
}
        document.addEventListener("DOMContentLoaded", function() {
            var logoutButton = document.getElementById("logoutButton");
            logoutButton.addEventListener("click", function() {
                var confirmation = confirm("Are you sure you want to log out?");
                if (confirmation) {
                    window.location.href = "login1.php";
                }
            });

            var defaultGreeting = "Prescription";
            var greetingElement = document.getElementById("greeting");
            greetingElement.textContent = defaultGreeting;
        });

        // JavaScript function to display prescription details
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
                <p><strong>descrption:</strong> ${selectedPrescription.medicine_description}</p>
            `;
        }
    </script>
</body>
</html>
