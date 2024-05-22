<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record System</title>
    <style>
        /* Your CSS styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'inria', serif;
        }
        .vectors {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: -2;
        }
        .vectors2 {
            position: fixed;
            bottom: 0;
            right: 0;
            width: 100%;
            z-index: -2;
        }
        .container {
            background: white;
            padding: 60px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: -1;
        }
        .sidebar {
            background-color: #e4e4e47b;
            color: rgb(0, 0, 0);
            padding: 20px;
            width: 183px;
            position: fixed;
            top: 0;
            right: 20px;
            height: 91%;
            overflow: auto;
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
            transition: all 0.3s ease;
            padding: 10px;
            border-radius: 15px;
        }
        .sidebar ul li a:hover {
            background-color: #ccc;
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
            margin-left: auto;
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
        .container {
            margin-top: 78px;
            margin-left: 0px;
            margin-right: 20px;
            padding: 20px;
            background-color: #e4e4e47b;
            position: absolute;
            top: 6px;
            bottom: 0;
            right: 0;
            left: 20px;
            width: calc(90% - 200px);
            height: calc(90% - 80px);
            align-content: center;
        }
        #greeting {
            margin-right: 56%;
            color: #333;
            font-size: 25px;
        }
        .buttons {
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
            background-color: #CCE4F4;
            transition: 1.0s;
        }
        .appointments-Content {
            padding: 10px;
            background-color: #ffffffb0;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 70%;
            position: fixed;
            top: 56%;
            left: 40%;
            transform: translate(-50%, -50%);
            height: calc(70%);
        }

.search-container {
    background-color: #f0f0f0;
    padding: 5px;
    border-radius: 8px;
    margin-bottom: 30px;
    top: 2%;
    position: absolute;
    width: 97%;
}

#appointments-form {
    display: block; /* Ensures the form itself is not hidden */
    padding: 20px;
    margin-top: 5px;
    height: 50%;
}


input[type="date"], input[type="time"] {
    display: block;   /* Ensures the element is displayed */
    width: 97%;      /* Full-width for visibility */
    padding: 10px;    /* Adds some padding for better visibility */
    border: 1px solid #ccc; /* Adds a border to visually confirm the element is there */
}

#appointments-form button[type="submit"] {
            background-color: #ccc;
            color: #fff;
            width: 30%;
            margin-bottom: 40% !important;
            margin-left: 35%;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            color: #555;
            appearance: none;
        }

        select:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        select:hover {
            background-color: #f0f0f0;
        }
        select option {
            background-color: #fff;
            color: #555;
        }
        select option:hover {
            background-color: #007bff;
            color: #fff;
        }
       
    </style>
</head>
<body>
    <img class="vectors" src="blu vec.png">
    <img class="vectors2" src="pink vec.png">

    <aside class="sidebar">
        <h1>Care</h1>
        <ul>
            <li><button onclick="location.href='prescription.php'" id="prescription" type="button" class="buttons">Prescription</button></li>
            <li><button onclick="location.href='monitor.php'" id="monitor" type="button" class="buttons">Monitor</button></li>
            <li><button onclick="location.href='appointments.php'" id="appointments" type="button" class="buttons">Appointments</button></li>
            <li><button onclick="location.href='history.php'" id="history" type="button" class="buttons">History</button></li>

        </ul>
    </aside>

    <header class="topbar">
        <div>
            <p id="greeting" style="white-space: nowrap;"></p>
        </div>
        <ul>
            <li>
                <a href="HomePage.php" class="home-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                    </svg>
                </a>
            </li>
            <li>
                <a href="complaints.php" class="info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                    </svg>
                </a>
            </li>
            <li> 
                <a href="notifications.php" class="info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6"/>
                    </svg>
                </a>
            </li>
            <li><button onclick="location.href='login1.php'" id="logoutButton" type="button" class="logout">Log Out</button></li>
        </ul>
    </header>

    <main class="container">
        <div class="appointments-Content">
        <div class="search-container">
    <label for="patients-file">Enter Patient File Number:</label>
    <input type="text" id="patients_file" name="patients_file" class="search-input" placeholder="Patient File Number" required>
</div>

            <form id="appointments-form">
                <input type="date" id="date-input" name="appointment_date" required><br><br>
                <input type="time" id="time-input" name="appointment_time" required><br><br>
                <select id="hospital-select" name="hospital_id" required>
                    <option value="">Select Hospital</option>
                    <!-- Options for hospitals will be added dynamically -->
                </select><br><br>
                <select id="clinic-select" name="clinic_id">
                    <option value="">Select Clinic</option>
                    <!-- Options for clinics will be added dynamically -->
                </select><br><br>
                <select id="doctor-select" name="doctor_id" required>
                    <option value="">Select Doctor</option>
                    <!-- Options for doctors will be added dynamically -->
                </select><br><br>
                <button type="submit">Submit</button>
            </form>
            <div id="result"></div>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Fetch and populate the hospital dropdown
            fetch('getHospitals.php')
                .then(response => response.json())
                .then(data => {
                    const hospitalSelect = document.getElementById('hospital-select');
                    data.forEach(hospital => {
                        const option = document.createElement('option');
                        option.value = hospital.id;
                        option.textContent = hospital.name;
                        hospitalSelect.appendChild(option);
                    });
                });

            // Event listener for hospital dropdown change
            document.getElementById('hospital-select').addEventListener('change', function() {
                const hospitalId = this.value;
                if (hospitalId) {
                    fetch(`getClinics.php?hospital_id=${hospitalId}`)
                        .then(response => response.json())
                        .then(data => {
                            const clinicSelect = document.getElementById('clinic-select');
                            clinicSelect.innerHTML = '<option value="">Select Clinic</option>'; // Clear previous options
                            data.forEach(clinic => {
                                const option = document.createElement('option');
                                option.value = clinic.id;
                                option.textContent = clinic.name;
                                clinicSelect.appendChild(option);
                            });
                        });
                } else {
                    document.getElementById('clinic-select').innerHTML = '<option value="">Select Clinic</option>';
                    document.getElementById('doctor-select').innerHTML = '<option value="">Select Doctor</option>';
                }
            });

            // Event listener for clinic dropdown change
            document.getElementById('clinic-select').addEventListener('change', function() {
                const clinicId = this.value;
                if (clinicId) {
                    fetch(`getDoctors.php?clinic_id=${clinicId}`)
                        .then(response => response.json())
                        .then(data => {
                            const doctorSelect = document.getElementById('doctor-select');
                            doctorSelect.innerHTML = '<option value="">Select Doctor</option>'; // Clear previous options
                            data.forEach(doctor => {
                                const option = document.createElement('option');
                                option.value = doctor.id;
                                option.textContent = doctor.name;
                                doctorSelect.appendChild(option);
                            });
                        });
                } else {
                    document.getElementById('doctor-select').innerHTML = '<option value="">Select Doctor</option>';
                }
            });

            // Submit form data
             document.getElementById('appointments-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        const form = event.target;
        const formData = new FormData(form);

        // Ensure patients_file is included
        const patientsFileInput = document.getElementById('patients_file');
        if (patientsFileInput) {
            formData.append('patients_file', patientsFileInput.value);
        }

        // Logging form data for debugging
        for (const pair of formData.entries()) {
            console.log(`${pair[0]}: ${pair[1]}`);
        }

        fetch('saveAppointment.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())  // Read as text to catch HTML errors
        .then(text => {
            try {
                const data = JSON.parse(text);  // Try to parse JSON
                if (data.success) {
                    alert('Appointment saved successfully!');
                    form.reset();
                } else {
                    document.getElementById('result').textContent = 'Failed to save appointment: ' + (data.error || 'Unknown error');
                }
            } catch (error) {
                document.getElementById('result').textContent = 'Error parsing response: ' + text;
            }
        })
        .catch(error => {
            console.error('Error saving appointment:', error);
            document.getElementById('result').textContent = 'Error saving appointment: ' + error.message;
        });
    });

            document.getElementById('logoutButton').addEventListener('click', function() {
                var confirmation = confirm("Are you sure you want to log out?");
                if (confirmation) {
                    window.location.href = "login1.php";
                }
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
var defaultGreeting = "Appointments";
var greetingElement = document.getElementById("greeting");

greetingElement.textContent = defaultGreeting;
});
    </script>
</body>
</html>
