<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="complaints.css">
    <title> Complaints </title>
    <style>
        h1 {
            text-align: center;
            color: #333;
        }
        .complaint-list {
            max-width: 300px;
            margin: 20px 0;
            padding: 0;
            list-style-type: none;
        }
        .complaint-list li {
            background: #fff;
            border: 1px solid #ccc;
            margin: 5px 0;
            padding: 10px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .complaint-list li:hover {
            background: #f0f0f0;
        }
        .complaint-list li.new {
            font-weight: bold;
        }
        .complaint-details {
            margin-top: 20px;
            padding: 20px;
            background: #fff;
            border: 1px solid #ccc;
            display: none;
        }
        .complaint-details h2 {
            margin-top: 0;
            color: #333;
        }
        .complaint-details p {
            margin: 10px 0;
            color: #555;
        }
        .complaint-details p span {
            color: #000;
        }
    </style>
</head>
<body>
    <img class="vectors" src="blu vec.png">
    <img class="vectors2" src="pink vec.png">
    <aside class="sidebar">
        <h1>Care</h1>
        <ul>
            <li><button onclick="location.href='complaints_historya.php'" id="history" type="button" class="buttons">Complaints History</button></li>
        </ul>
    </aside>
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
            <li>
                <button onclick="location.href='login1.php'" id="logoutButton" type="button" class="logout">Log Out</button>
            </li>
        </ul>
    </header>

    <div class="container">
    <ul class="complaint-list" id="complaintList"></ul>

<div class="complaint-details" id="complaintDetails">
    <h2>Complaint Details</h2>
    <p><strong>Complaint:</strong> <span id="complaintText"></span></p>
    <p><strong>Admin Response:</strong> <span id="adminResponse"></span></p>
    <p><strong>Status:</strong> <span id="responseStatus"></span></p>
    <p><strong>Date:</strong> <span id="complaintDate"></span></p>
</div>
</div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var defaultGreeting = "Complaints History";
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
            fetch('fetch_replied_complaints.php')
            .then(response => response.json())
            .then(data => {
                const complaintList = document.getElementById('complaintList');
                data.forEach(complaint => {
                    let listItem = document.createElement('li');
                    listItem.textContent = complaint.subject;
                    listItem.dataset.id = complaint.id;
                    listItem.dataset.subject = complaint.subject;
                    listItem.dataset.text = complaint.complaint_text;
                    listItem.dataset.response = complaint.admin_response;
                    listItem.dataset.status = complaint.response_status;
                    listItem.dataset.date = complaint.created_at;
                    listItem.className = complaint.response_status === 'new' ? 'new' : '';
                    listItem.onclick = function() {
                        document.getElementById('complaintText').textContent = this.dataset.text;
                        document.getElementById('adminResponse').textContent = this.dataset.response || 'No response yet';
                        document.getElementById('responseStatus').textContent = this.dataset.status === 'new' ? 'New' : 'Read';
                        document.getElementById('complaintDate').textContent = this.dataset.date;
                        document.getElementById('complaintDetails').style.display = 'block';
                    };
                    complaintList.appendChild(listItem);
                });
            })
            .catch(error => console.error('Error fetching complaints:', error));
    </script>
               

      
    </script>
</body>
</html>
