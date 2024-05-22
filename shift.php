<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="shift.css">
    <script src="shift.js"></script>
<style>
  /* Reset default margin and padding */
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

.content {
  margin-top: 60px; /* Adjust according to the height of the topbar */
  padding: 20px;
}

/* Shift form styles */
form {
  margin-bottom: 20px;
}

label {
  font-weight: bold;
}

input[type="text"],
input[type="date"],
input[type="time"],
select {
  width: 35%;
  padding: 4px;
  margin-bottom: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

input[type="submit"] {
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #0056b3;
}

/* Table styles */
#schedule-table {
  margin-top: 20px;
  border-collapse: collapse;
  width: 100%;
}

#schedule-table th,
#schedule-table td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: center;
}

#schedule-table th {
  background-color: #f2f2f2;
}

#schedule-table tr:nth-child(even) {
  background-color: #f2f2f2;
}

#schedule-table {
    margin-top: 20px;
    border-collapse: collapse;
    width: 100%;
    overflow-y: auto; 
    max-height: 400px; 
}
</style>
    <title>Shift Schedual </title>
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
        <p id="greeting" style="white-space: nowrap;"></p>
      </div>
      <ul>
        <li>
          <a href="HPAdmin.php" class="home-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
            </svg>
        </a>
    </li>
    <li><button onclick="login.html" id="logoutButton" type="button" class="logout">Log Out</button>
    </li>
    </ul>
    </header>
    
    <!-- Main content -->
    <div class="container">
    <form action="process.php" method="post">
        <label for="department">Select Department:</label>
        <select id="department" name="department" required>
                    <option value="Cardiology">Cardiology</option>
                    <option value="Neurology">Neurology</option>
                    <option value="Orthopedics">Orthopedics</option>
                    <option value="Pediatrics">Pediatrics</option>
                </select>
        <br><br>
        <input type="text" id="employee_name" name="employee_name" placeholder="Employee Name" required>
        <input type="text" id="employee_email" name="employee_email" placeholder="Employee email" required>

        <br><br>
        <label for="shift_date">Shift Date:</label>
        <input type="date" id="shift_date" name="shift_date" required>
        <br><br>
        <label for="shift_start_time">Shift Start Time:</label>
        <input type="time" id="shift_start_time" name="shift_start_time" required>
        <br><br>
        <label for="shift_end_time">Shift End Time:</label>
        <input type="time" id="shift_end_time" name="shift_end_time" required>
        <br><br>
        <input type="submit" value="Submit">
    </form>

    <div id="schedule-table">
        <!-- Table will be loaded here -->
    </div>
    </div>
    <script>
        // Using AJAX to load the table
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("schedule-table").innerHTML = this.responseText;
            }
        };
        xhr.open("GET", "display_schedule.php", true);
        xhr.send();

        function showAlert(message, type) {
            const alertContainer = document.createElement('div');
            alertContainer.className = `alert ${type}`;
            alertContainer.innerText = message;

            document.body.insertBefore(alertContainer, document.body.firstChild);

            setTimeout(() => {
                alertContainer.remove();
            }, 3000); // Remove the alert after 3 seconds
        }

        // Check URL parameters for status messages
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');

        if (status === 'success') {
            showAlert('Shift schedule saved successfully!', 'success');
        } else if (status === 'error') {
            showAlert('An error occurred. Please try again.', 'error');
        }
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