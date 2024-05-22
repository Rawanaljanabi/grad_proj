<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>HomePage</title>
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
/* Styling for the history section container */
.history-section {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background: #f9f9f9;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow-y: auto;

}

/* General styling for select and input fields */
.history-section select,
.history-section input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box; /* Includes padding and border in element's width */
}

/* Styling for the button */
.history-section button {
    width: 100%;
    padding: 12px;
    margin-top: 15px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.history-section button:hover {
    background-color: #0056b3;
}

/* Styling for the results div */
#result {
    margin-top: 20px;
    padding: 15px;
    background-color: #fff;
    border: 1px solid #eee;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    min-height: 50px;
    overflow-y: auto;
}

/* Table styling within the results div */
#result table {
    width: 100%;
    border-collapse: collapse;
    overflow-y: auto;

}

#result table, #result th, #result td {
    border: 1px solid #ddd;
}

#result th, #result td {
    text-align: left;
    padding: 8px;
}

#result th {
    background-color: #f2f2f2;
}


</style>
<body>
    <img class="vectors" src="blu vec.png">
    <img class="vectors2" src="pink vec.png">
  
    <!-- Sidebar -->
    <aside class="sidebar">
        <h1>Care</h1>
        <ul>
          <li><button onclick="location.href='prescription.php'" id="prescription" type="button" class="buttons">Prescription</button></li>
          <li><button onclick="location.href='monitor.php'" id="monitor" type="button" class="buttons">Monitor</button></li>
          <li><button onclick="location.href='appointments.php'" id="appointments" type="button" class="buttons">Appointments</button></li>
          <li><button onclick="location.href='history.php'" id="historyButton" class="buttons">History</button></li> 
        </ul>
    </aside>
  
    <!-- Top bar -->
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
                <button type="button" id="logoutButton" class="logout">Log Out</button>
            </li>
        </ul>
    </header>

    <!-- Main content -->
    <div class="container">
        <!-- Add this inside your <div class="container"> -->
<div class="history-section">
    <select id="selectionType">
        <option value="prescriptions">Prescriptions </option>
        <option value="monitor"> Monitor</option>
        <option value="appointments">Appointments</option>
    </select>
    <input type="text" id="patientFile" placeholder="Enter Patient File Number">
    <button onclick="fetchData()">Submit</button>
    <div id="result"></div>
</div>

    </div>
<script>
     
     document.addEventListener("DOMContentLoaded", function() {
        var defaultGreeting = "History";
        var greetingElement = document.getElementById("greeting");

        greetingElement.textContent = defaultGreeting;
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


    function fetchData() {
    const selectionType = document.getElementById('selectionType').value;
    const patientFile = document.getElementById('patientFile').value;

    if (patientFile.trim() === "") {
        alert("Please enter a patient file number.");
        return;
    }

    const url = `/fetchData.php?type=${encodeURIComponent(selectionType)}&fileNumber=${encodeURIComponent(patientFile)}`;

    fetch(url)
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();  // First get the text
    })
    .then(text => {
        console.log(text);  // Log the text for debugging
        try {
            const data = JSON.parse(text);  // Then parse it as JSON
            if (data.error) {
                throw new Error(data.error);  // Throw if the PHP script sends back an error
            }
            document.getElementById('result').innerHTML = data.html;
        } catch (e) {
            throw new Error('Failed to parse JSON: ' + e.message);
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
        alert("Failed to fetch data. Error: " + error.message);
    });
}


</script>

</body>
</html>