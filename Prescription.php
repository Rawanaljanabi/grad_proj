<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription</title>
    <link rel="stylesheet" href="prescription.css">
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
            <li>
                <button onclick="location.href='login1.php'" id="logoutButton" type="button" class="logout">Log Out</button>
            </li>
        </ul>
    </header>

    <main class="container">
        <form id="prescriptionForm">
            <div class="search-container">
                <label for="fileNumberInput">Enter Patient File Number:</label>
                <input type="text" id="fileNumberInput" name="fileNumberInput" class="search-input" placeholder="Patient File Number">
            </div>

            <div class="content">
                <div class="textbox-group2">
                    <div class="input-field">
                        <input type="text" id="name" name="name" placeholder="Full Name">
                    </div>
                    <div class="input-field">
                        <input type="text" id="age" name="age" placeholder="Age">
                    </div>
                    <div class="input-field">
                        <input type="text" id="condition" name="condition" placeholder="Condition">
                    </div>
                </div>
                <div class="textbox-group1">
                    <div class="input-field">
                        <input type="text" id="medicineName" name="medicineName" placeholder="Medicine Name">
                    </div>
                    <div class="input-field">
                        <input type="text" id="medicineDescription" name="medicineDescription" placeholder="Medicine Description">
                    </div>
                    <div class="input-field">
                        <input type="text" id="dose" name="dose" placeholder="Dose">
                    </div>
                </div>
                <div class="textbox-single">
                    <div class="input-field">
                        <input type="text" id="notes" name="notes" placeholder="Notes">
                    </div>
                </div>
            </div>
            <button type="submit" class="submit">Submit</button>
        </form>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#greeting').text("Prescription");

            $('#logoutButton').click(function() {
                if (confirm("Are you sure you want to log out?")) {
                    window.location.href = "login1.php";
                }
            });

            $('#prescriptionForm').on('submit', function(e) {
                e.preventDefault();

                var formData = {
                    fileNumberInput: $('#fileNumberInput').val(),
                    name: $('#name').val(),
                    age: $('#age').val(),
                    condition: $('#condition').val(),
                    medicineName: $('#medicineName').val(),
                    medicineDescription: $('#medicineDescription').val(),
                    dose: $('#dose').val(),
                    notes: $('#notes').val()
                };

                console.log("Submitting prescription: ", formData);

                $.ajax({
                    url: 'submit_prescription.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        console.log("Submit response: ", response);
                        if (response.success) {
                            alert('Prescription Saved Successfully!');
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error details: ", xhr.responseText);
                        alert('Error saving prescription: ' + error);
                    }
                });
            });
        });
        function validateForm() {
            const inputs = document.querySelectorAll('#prescriptionForm input[type="text"]');
            for (const input of inputs) {
                if (input.value.trim() === "") {
                    alert('All fields must be filled out');
                    return false;
                }
            }
            return true;
        }
    </script>
</body>
</html>
