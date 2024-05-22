<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="shift.css">
    <title>Shift Schedule</title>
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

.content {
margin-top: 60px; /* Adjust according to the height of the topbar */
padding: 20px;
}


.shiftschedualcontent {
margin-top: 20px; /* Space above the shift schedule content */
padding: 20px;

}

#departmentDropdown {
width: 100%; /* Make the dropdown full-width of its container */
  padding: 8px 12px; /* Add some padding inside the dropdown */
  margin-top: 20px; /* Add some margin at the top */
  border-radius: 5px; /* Rounded corners */
  border: 1px solid #ccc; /* Light grey border */
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
  background-color: #ddd ; /* White background color */
  font-size: 16px; /* Increase font size for better readability */
  cursor: pointer; /* Change cursor to pointer to indicate it's clickable */
}
/* Hover effect for dropdown */
#departmentDropdown select:hover {
  border-color: #888; /* Darken the border color on hover */
}
/* Focus effect for dropdown */
#departmentDropdown  select:focus {
  outline: none; /* Remove default focus outline */
  border-color: #555; /* Darken the border color on focus */
  box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25); /* Add a blue glow effect */
}
/* Style for the dropdown options */
#departmentDropdown  option {
  padding: 8px; /* Add padding to options for better spacing */
  font-size: 16px; /* Uniform font size with the select */
}



#scheduleTable {
width: 100%; /* Use the full width of the container */
margin-top: 30px;
border-collapse: collapse; /* Collapse borders for a clean look */
table-layout: fixed; /* Fixed table layout for uniform column sizes */
display: none; /* Hide the table initially */
}
#scheduleTable th,
#scheduleTable td {
border: 1px solid #ddd; /* Light grey border for each cell */
text-align: center; /* Center-align text */
padding: 10px; /* Padding inside cells for space */
white-space: nowrap; /* Prevent text wrapping in cells */
min-width: 100px; 
}
#scheduleTable th:first-child,
#scheduleTable td:first-child {
width: 20%; /* Wider column for employee names */
}

#scheduleTable th:not(:first-child),
#scheduleTable td:not(:first-child) {
width: calc(80% / 6); /* Distribute the remaining width among the day columns */
}
#scheduleTable thead th {
background-color: #F3F3F3; /* Light gray background for headers */
color: #4A4A4A; /* Dark text for contrast */
font-weight: bold; /* Bold font for headers */
padding: 10px; /* Spacing within header cells */
text-align: left; /* Align text to the left */
}

#scheduleTable tbody td {
text-align: center; /* Centered text for body cells */
padding: 10px; /* Spacing within cells */
border-bottom: 1px solid #ddd; /* Border for each cell */
vertical-align: middle; /* Align content in the middle vertically */
}

#scheduleTable th {
background-color: #f9f9f9; /* Light grey background for header cells */
}

#scheduleTable2 {
width: 100%; /* Use the full width of the container */
margin-top: 30px;
border-collapse: collapse; /* Collapse borders for a clean look */
table-layout: fixed; /* Fixed table layout for uniform column sizes */
}
#scheduleTable2 th,
#scheduleTable2 td {
border: 1px solid #ddd; /* Light grey border for each cell */
text-align: center; /* Center-align text */
padding: 10px; /* Padding inside cells for space */
white-space: nowrap; /* Prevent text wrapping in cells */
min-width: 110px; 
}
#scheduleTable2 th:first-child,
#scheduleTable2 td:first-child {
width: 20%; /* Wider column for employee names */
}

#scheduleTable2 th:not(:first-child),
#scheduleTable2 td:not(:first-child) {
width: calc(80% / 6); /* Distribute the remaining width among the day columns */
}
#scheduleTable2 thead th {
background-color: #F3F3F3; /* Light gray background for headers */
color: #4A4A4A; /* Dark text for contrast */
font-weight: bold; /* Bold font for headers */
padding: 10px; /* Spacing within header cells */
text-align: left; /* Align text to the left */
}

#scheduleTable2 tbody td {
text-align: center; /* Centered text for body cells */
padding: 10px; /* Spacing within cells */
border-bottom: 1px solid #ddd; /* Border for each cell */
vertical-align: middle; /* Align content in the middle vertically */
}

#scheduleTable2 th {
background-color: #f9f9f9; /* Light grey background for header cells */
}





/* Style for individual cell status. Add additional classes as necessary. */
.workDay {
background-color: #b2caa9; /* Light green background */
}

.halfDay {
background-color: #feffba; /* Light yellow background */
}

.dayOff {
background-color: #ffb8b0; /* Light red background */
}

.sickDay {
background-color: #e1c8fd; /* Light purple background */
}

#scheduleTable tr:nth-child(even) {
background-color: #f2f2f2; /* Zebra striping for rows */
}

#scheduleTable tr:hover {
background-color: #eaeaea; /* Hover effect for table rows */
}

.color-indicators {
  display: flex;
  justify-content: space-around; /* Adjust as necessary */
  margin-bottom: 20px; /* Space below the indicators */
  margin-top: 80px;
margin-bottom: 20px;
}

.indicator {
  display: flex;
  align-items: center;
}

.color-box {
  width: 20px; /* Width of the color box */
  height: 20px; /* Height of the color box */
  display: inline-block;
  margin-right: 5px; /* Space between the box and the text */
}

.work-day { background-color: #b2caa9; } /* Color for work */
.half-day { background-color: #feffba; } /* Color for half day */
.day-off { background-color: #ffb8b0; } /* Color for day off */
.sick-day { background-color: #e1c8fd; } /* Color for sick day */


.submitButton {
padding: 10px 20px;
margin: 0 10px;
border: none;
border-radius: 5px;
background-color: #80baf8;
color: white;
cursor: pointer;
}

.submitButton:hover {
background-color: #2d93ff;
}
.submitButton2 {
padding: 10px 20px;
margin: 0 10px;
border: none;
border-radius: 5px;
background-color: #80baf8;
color: white;
cursor: pointer;
}

.submitButton2:hover {
background-color: #2d93ff;
}

.saveButton {
padding: 10px 20px;
margin: 0 10px;
border: none;
border-radius: 5px;
background-color: #80baf8;
color: white;
cursor: pointer;
}

.saveButton:hover {
background-color: #2d93ff;
}
.saveButton2 {
padding: 10px 20px;
margin: 0 10px;
border: none;
border-radius: 5px;
background-color: #80baf8;
color: white;
cursor: pointer;
}

.saveButton2:hover {
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
            <li><button onclick="location.href='report.html'" id="report" type="button" class="buttons">Reports</button></li>
            <li><button onclick="location.href='services.php'" id="services" type="button" class="buttons">Services</button></li>
            <li><button onclick="location.href='events.php'" id="events" type="button" class="buttons">Events</button></li>
            <li><button onclick="location.href='adcomplaint.html'" id="complaint" type="button" class="buttons">Complaints</button></li>
        </ul>
    </aside>

    <!-- Top bar -->
    <header class="topbar">
        <div>
            <p id="greeting" style="white-space: nowrap;"></p>
        </div>
        <ul>
            <li>
                <a href="HPAdmin.html" class="home-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                    </svg>
                </a>
            </li>
            <li><button onclick="window.location.href='login.html'" id="logoutButton" type="button" class="logout">Log Out</button></li>
        </ul>
    </header>

    <!-- Main content -->
    <div class="container">
        <div class="shiftschedualcontent">
            <form action="process_shift_schedule.php" method="post">
                <select name="departments" id="departmentDropdown">
                    <option value="" selected disabled>Departments</option>
                    <option value="Emergency">Emergency</option>
                    <option value="Pediatrics">Pediatrics</option>
                </select>
                <div id="scheduleContent" style="display: none;">
                    <div class="color-indicators">
                        <div class="indicator">
                            <span class="color-box work-day"></span> Work Day
                        </div>
                        <div class="indicator">
                            <span class="color-box half-day"></span> Half Day
                        </div>
                        <div class="indicator">
                            <span class="color-box day-off"></span> Day Off
                        </div>
                        <div class="indicator">
                            <span class="color-box sick-day"></span> Sick Day
                        </div>
                    </div>
                    <table id="scheduleTable" border="1">
                        <thead>
                            <tr>
                                <th>Employee Name</th>
                                <th>2/Wed</th>
                                <th>3/Thu</th>
                                <th>4/Fri</th>
                                <th>5/Sat</th>
                                <th>6/Sun</th>
                                <th>7/Mon</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="employeeName"><input type="text" name="employeeName[]"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                            </tr>
                            <tr>
                                <td class="employeeName"><input type="text" name="employeeName[]"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                            </tr>
                            <tr>
                                <td class="employeeName"><input type="text" name="employeeName[]"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="button-container" style="margin-top: 20px; text-align: center;">
                        <button id="submitButton" class="submitButton">Send</button>
                        <button id="saveButton" class="saveButton">Save</button>
                    </div>
                </div>

                <div id="scheduleContent2" style="display: none;">
                    <div class="color-indicators">
                        <div class="indicator">
                            <span class="color-box work"></span> Work Day
                        </div>
                        <div class="indicator">
                            <span class="color-box half-day"></span> Half Day
                        </div>
                        <div class="indicator">
                            <span class="color-box day-off"></span> Day Off
                        </div>
                        <div class="indicator">
                            <span class="color-box sick-day"></span> Sick Day
                        </div>
                    </div>
                    <table id="scheduleTable2" border="1">
                        <thead>
                            <tr>
                                <th>Employee Name</th>
                                <th>2/Wed</th>
                                <th>3/Thu</th>
                                <th>4/Fri</th>
                                <th>5/Sat</th>
                                <th>6/Sun</th>
                                <th>7/Mon</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="employeeName"><input type="text" name="employeeName[]"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                            </tr>
                            <tr>
                                <td class="employeeName"><input type="text" name="employeeName[]"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                            </tr>
                            <tr>
                                <td class="employeeName"><input type="text" name="employeeName[]"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="button-container2" style="margin-top: 20px; text-align: center;">
                        <button id="submitButton2" class="submitButton2">Send</button>
                        <button id="saveButton2" class="saveButton2">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var greetingElement = document.getElementById("greeting");
            var defaultGreeting = "Shift schedule";
            var departmentDropdown = document.getElementById('departmentDropdown');
            var scheduleContentEmergency = document.getElementById('scheduleContent');
            var scheduleTableEmergency = document.getElementById('scheduleTable');
            var scheduleContentPediatrics = document.getElementById('scheduleContent2');
            var scheduleTablePediatrics = document.getElementById('scheduleTable2');

            greetingElement.textContent = defaultGreeting;

            function hideAllContentSections() {
                scheduleContentEmergency.style.display = 'none';
                scheduleTableEmergency.style.display = 'none';
                scheduleContentPediatrics.style.display = 'none';
                scheduleTablePediatrics.style.display = 'none';
            }

            function handleDepartmentChange() {
                hideAllContentSections();
                if (departmentDropdown.value === 'Emergency') {
                    scheduleContentEmergency.style.display = 'block';
                    scheduleTableEmergency.style.display = 'block';
                } else if (departmentDropdown.value === 'Pediatrics') {
                    scheduleContentPediatrics.style.display = 'block';
                    scheduleTablePediatrics.style.display = 'block';
                }
            }

            departmentDropdown.addEventListener('change', handleDepartmentChange);

            document.getElementById("logoutButton").addEventListener("click", function() {
                if (confirm("Are you sure you want to log out?")) {
                    window.location.href = "page1.html";
                }
            });

            function areAllCellsFilled(table) {
                var allFilled = true;
                var cells = table.querySelectorAll('td[contenteditable="true"]');
                cells.forEach(function(cell) {
                    if (cell.innerText.trim() === "") {
                        allFilled = false;
                    }
                });
                return allFilled;
            }

            function loadSavedData() {
                var savedData1 = localStorage.getItem("shiftSchedule");
                var savedData2 = localStorage.getItem("shiftSchedule2");
                if (savedData1) {
                    scheduleTableEmergency.innerHTML = savedData1;
                }
                if (savedData2) {
                    scheduleTablePediatrics.innerHTML = savedData2;
                }
            }

            loadSavedData();

            document.getElementById("saveButton").addEventListener("click", function() {
                if (areAllCellsFilled(scheduleTableEmergency)) {
                    localStorage.setItem("shiftSchedule", scheduleTableEmergency.innerHTML);
                    alert("Shift schedule has been saved.");
                } else {
                    alert("Please fill all the cells.");
                }
            });

            document.getElementById("saveButton2").addEventListener("click", function() {
                if (areAllCellsFilled(scheduleTablePediatrics)) {
                    localStorage.setItem("shiftSchedule2", scheduleTablePediatrics.innerHTML);
                    alert("Shift schedule has been saved.");
                } else {
                    alert("Please fill all the cells.");
                }
            });

            document.getElementById("submitButton").addEventListener("click", function() {
                if (areAllCellsFilled(scheduleTableEmergency)) {
                    alert("Shift schedule has been sent.");
                } else {
                    alert("Please fill all the cells.");
                }
            });

            document.getElementById("submitButton2").addEventListener("click", function() {
                if (areAllCellsFilled(scheduleTablePediatrics)) {
                    alert("Shift schedule has been sent.");
                } else {
                    alert("Please fill all the cells.");
                }
            });
        });
    </script>
</body>
</html>