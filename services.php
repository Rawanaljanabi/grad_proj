<?php
session_start();
require 'db_connection.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    $stmt = $conn->prepare("UPDATE services SET is_active = ? WHERE service_name = ?");
    foreach ($data as $service) {
        $isActive = filter_var($service['isActive'], FILTER_VALIDATE_BOOLEAN);
        $stmt->bind_param('is', $isActive, $service['serviceName']);
        $stmt->execute();
    }
    $stmt->close();

    echo "Service status updated successfully.";
    exit; // Ensure no extra output is sent
}

// Fetch current service states
$services = [];
$result = $conn->query("SELECT service_name, is_active FROM services");
while ($row = $result->fetch_assoc()) {
    $services[$row['service_name']] = $row['is_active'];
}
$conn->close();
?>





<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services </title>
   

    
  <style>
  body{
    margin: 0;
    padding: 0;
    font-family: 'inria', serif, ;
}

/* ... */
    .vectors {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%; /* Adjust the width as needed */
    z-index: -2;
}
.vectors2 {
    position: fixed;
    bottom: 0;
    right: 0;
    width: 100%; /* Adjust the width as needed */
    z-index: -2;
}

.container {
    background: white;
     padding: 60px;
     border-radius: 20px;
     box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
     z-index: -1;
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

/* Top bar styles */
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
.logout {
    margin-left: auto; /* Push the logout button to the right */
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
  padding: 20px ;
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

.services-content {
    padding: 20px;
    margin-top: 20px; /* Adjust as needed */
  }
  
  
  /* General Style for Service Item */
  .service-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #d3cfcf; /* Light grey background */
    padding: 10px 20px;
    margin: 8px 0;
    border-radius: 15px;
    box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.05); /* subtle inset shadow */
    font-size: 16px; /* Adjust size as needed */
  }
  
  /* Styling for the toggle switch */
.switch {
  position: relative;
  display: inline-block;
  width: 50px; /* Reduced width */
  height: 24px; /* Reduced height */
}

/* Hide default HTML checkbox */
.switch .toggle-input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #afadad;
  transition: .4s;
  border-radius: 24px; /* Half of the reduced height to make it round */
}

.slider:before {
  position: absolute;
  content: "";
  height: 20px; /* Reduced size for the circle */
  width: 20px;  /* Reduced size for the circle */
  left: 2px;
  bottom: 2px; /* Adjust bottom position to center the circle */
  background-color: white;
  transition: .4s;
  border-radius: 50%;
}

/* Color of the slider when the toggle is checked */
.toggle-input:checked + .slider {
  background-color: #2196F3;
}

/* Position of the slider circle when checked */
.toggle-input:checked + .slider:before {
  transform: translateX(26px); /* Adjust the X-axis translation to fit the new width */
}

/* Focus styles for the slider */
.toggle-input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

.save-button {
  padding: 10px 20px;
  margin: 0 10px;
  border: none;
  border-radius: 5px;
  background-color: #80baf8;
  color: white;
  cursor: pointer;
  margin-top: 5px;
}

.save-button:hover {
  background-color: #2d93ff;
}
  </style>
</head>

<body>

 <img class="vectors" src="blu vec.png">
    <img class="vectors2" src="pink vec.png">
<!-- Sidebar -->
 <aside class="sidebar">
  <h1>Care</h1>
  <ul> 
    <li><button onclick="location.href='Shift.php'" id="shift" type="button" class="buttons">Shift Schedule</button></li>
    <li><button onclick="location.href='report.php'" id="report" type="button" class="buttons">Reports</button></li>
    <li><button onclick="location.href='services.php'" id="services" type="button" class="buttons">Services</button></li>
    <li><button onclick="location.href='events.php'" id="events" type="button" class="buttons">Events</button></li>
    <li><button onclick="location.href='admincomplaints.php'" id="complaint" type="button" class="buttons">Complaints</button></li>
  </ul>
  </aside>

   <!-- Top bar -->
    <header class="topbar">
  <div>
        <p id="greeting" style="white-space: nowrap;">Services</p>
  </div>
   <ul>
    <li>
      <a href="HPAdmin.php" class="home-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
        </svg>
    </a>
</li>
<li><button onclick="hreflogin.html" id="logoutButton" type="button" class="logout">Log Out</button>
    </ul>
</header>

<!-- Services content area -->
 <div class="container">
        <div class="services-content">
            <?php foreach ($services as $service => $isActive): ?>
                <div class="service-item">
                    <span class="service-name"><?= htmlspecialchars($service) ?></span>
                    <label class="switch">
                        <input type="checkbox" class="toggle-input" <?= $isActive ? 'checked' : '' ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            <?php endforeach; ?>
            <div class="save-button-container" style="text-align: right;">
                <button id="saveButton" class="save-button">Save</button>
            </div>
        </div>
    </div>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    const serviceItems = document.querySelectorAll('.service-item .toggle-input');
    const saveButton = document.getElementById('saveButton');

    saveButton.addEventListener('click', function() {
        const updates = [];

        serviceItems.forEach(item => {
            const serviceName = item.closest('.service-item').querySelector('.service-name').textContent.trim();
            const isActive = item.checked;

            updates.push({ serviceName, isActive });
        });

        // Send all updates in one fetch request
        fetch('services.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(updates)
        }).then(response => response.text())
        .then(data => alert(data))
        .catch(error => console.error('Error:', error));
    });
});
document.addEventListener("DOMContentLoaded", function() {
        var logoutButton = document.getElementById("logoutButton");
        logoutButton.addEventListener("click", function() {
            var confirmation = confirm("Are you sure you want to log out?");
            if (confirmation) {
                window.location.href = "login1.php";
            }
        });
    });
</script>

</body>
</html>