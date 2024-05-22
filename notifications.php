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
        .topbar {
            width: 98%;
            background: #e4e4e47b;
            color: #000000;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            top: 0;
            right: 0;
            left: 20px;
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
            height: calc(90% - 80px);
            align-content: center;
            overflow-y: auto;

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
        .announcement {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            background-color: #f9f9f9;
            border-radius: 10px;
            margin-bottom: 10px;
            overflow-y: auto;
        }
        .announcement h3 {
            margin: 0 0 10px;
        }
        .announcement p {
            margin: 0;
        }
    </style>
</head>
<body>
    <img class="vectors" src="blu vec.png">
    <img class="vectors2" src="pink vec.png">

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
    
    </main>

    <script>
   document.addEventListener("DOMContentLoaded", function() {
    var defaultGreeting = "notifications center";
    var greetingElement = document.getElementById("greeting");
    greetingElement.textContent = defaultGreeting;
    
    var logoutButton = document.getElementById("logoutButton");
    logoutButton.addEventListener("click", function() {
        var confirmation = confirm("Are you sure you want to log out?");
        if (confirmation) {
            window.location.href = "login1.php";
        }
    });

    fetchAnnouncements();
});

function fetchAnnouncements() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "fetch_announcements.php", true);
    xhr.onload = function() {
        if (xhr.status == 200) {
            console.log(xhr.responseText); // Debug: log the response text
            var announcements = JSON.parse(xhr.responseText);
            console.log(announcements); // Debug: log the parsed JSON
            displayAnnouncements(announcements);
        } else {
            console.error("Failed to fetch announcements. Status:", xhr.status); // Debug: log error status
        }
    };
    xhr.onerror = function() {
        console.error("Request failed."); // Debug: log request failure
    };
    xhr.send();
}

function displayAnnouncements(announcements) {
    var container = document.querySelector(".container");
    container.innerHTML = ""; // Clear any existing content

    if (announcements.length === 0) {
        container.innerHTML = "<p>No announcements found.</p>"; // Debug: handle empty results
        return;
    }

    announcements.forEach(function(announcement) {
        var announcementDiv = document.createElement("div");
        announcementDiv.className = "announcement";
        announcementDiv.style.padding = "10px";
        announcementDiv.style.borderBottom = "1px solid #ddd";

        var title = document.createElement("h3");
        title.textContent = announcement.subject;
        title.style.margin = "0 0 10px";
        title.style.cursor = "pointer";

        var date = document.createElement("p");
        date.textContent = "Date: " + announcement.date + " Time: " + announcement.time;
        date.style.margin = "0 0 5px";

        var text = document.createElement("p");
        text.textContent = announcement.text;
        text.style.margin = "0 0 5px";
        text.style.display = "none"; // Initially hidden

        title.addEventListener("click", function() {
            if (text.style.display === "none") {
                text.style.display = "block";
            } else {
                text.style.display = "none";
            }
        });

        announcementDiv.appendChild(title);
        announcementDiv.appendChild(date);
        announcementDiv.appendChild(text);
        container.appendChild(announcementDiv);
    });
}

    </script>
</body>
</html>
