<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <style>
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
            padding: 10px 35px;
            border-radius: 15px;
        }

        .sidebar ul li a:hover {
            background-color: #ccc;
            width: 180px;
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

        .home-icon {
            padding: 5px;
            border: none;
            border-radius: 30px;
            background-color: #fa9e9e00;
            color: #000000;
            font-size: 16px;
            cursor: pointer;
        }

        .content {
            margin-left: 220px;
            padding: 20px;
            margin-top: 60px;
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

        #inboxContainer, #complaintDetailContainer {
            padding: 20px;
        }

        #complaintList div {
            background-color: #f0f0f0;
            margin: 10px 0;
            padding: 10px;
            cursor: pointer;
        }

        #complaintText {
            background-color: #ffffff;
            border: 1px solid #dddddd;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            white-space: pre-wrap;
        }

        textarea#replyTextarea {
            width: 100%;
            height: 120px;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
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
            <li><button onclick="login.html" id="logoutButton" type="button" class="logout">Log Out</button></li>
        </ul>
    </header>

    <div class="container">
        <div id="inboxContainer">
            <h2>Complaint Inbox</h2>
            <div id="complaintList"></div>
        </div>

        <div id="complaintDetailContainer" style="display: none;">
            <h2>Complaint Details</h2>
            <div id="complaintDetail">
                <p id="complaintText"></p>
                <textarea id="replyTextarea" placeholder="Write your reply here..."></textarea>
                <div id="errorMessage" class="error-message" style="display: none;">Please fill in the reply field before submitting.</div>
                <button onclick="submitReply()">Submit Reply</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var defaultGreeting = "Complaints";
            var greetingElement = document.getElementById("greeting");
            greetingElement.textContent = defaultGreeting;

            loadInbox();
        });

        function loadInbox() {
            const complaintListElement = document.getElementById('complaintList');
            console.log("Clearing complaint list");
            complaintListElement.innerHTML = ''; // Clear current list

            fetch('fetch_complaintsa.php')
                .then(response => response.json())
                .then(complaints => {
                    console.log("Fetched complaints:", complaints); // Log the fetched complaints
                    if (complaints.length === 0) {
                        console.log("No complaints found.");
                    }
                    let complaintSet = new Set(); // Create a Set to track unique complaints
                    complaints.forEach(complaint => {
                        if (complaint.response_status !== 'replied' && !complaintSet.has(complaint.id)) {
                            complaintSet.add(complaint.id); // Add the complaint ID to the Set
                            const complaintDiv = document.createElement('div');
                            complaintDiv.textContent = complaint.subject || 'No Subject';
                            if (complaint.response_status === 'new') {
                                const indicator = document.createElement('span');
                                indicator.className = 'new-complaint-indicator';
                                complaintDiv.appendChild(indicator);
                            }
                            complaintDiv.onclick = () => showComplaintDetail(complaint.id, complaint.subject, complaint.complaint_text);
                            complaintListElement.appendChild(complaintDiv);
                        }
                    });
                })
                .catch(error => {
                    console.error('Error fetching complaints:', error);
                });
        }

        function showComplaintDetail(id, subject, text) {
            document.getElementById('complaintText').textContent = text;
            document.getElementById('replyTextarea').setAttribute('data-complaint-id', id);

            document.getElementById('inboxContainer').style.display = 'none';
            document.getElementById('complaintDetailContainer').style.display = 'block';

            history.pushState({ complaintId: id }, '', '#complaint-' + id);
        }

        function submitReply() {
            const complaintId = document.getElementById('replyTextarea').getAttribute('data-complaint-id');
            const reply = document.getElementById('replyTextarea').value;

            console.log("Submitting reply for complaint ID:", complaintId);
            console.log("Reply content:", reply);

            fetch('submit_reply.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `id=${complaintId}&reply=${reply}`
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                alert(data);
                loadInbox();
                document.getElementById('inboxContainer').style.display = 'block';
                document.getElementById('complaintDetailContainer').style.display = 'none';
            })
            .catch(error => {
                console.error('Error submitting reply:', error);
            });
        }

        window.onpopstate = function(event) {
            if (event.state && event.state.complaintId) {
                showComplaintDetail(event.state.complaintId);
            } else {
                document.getElementById('inboxContainer').style.display = 'block';
                document.getElementById('complaintDetailContainer').style.display = 'none';
            }
        };

        

        document.addEventListener("DOMContentLoaded", function() {
            var logoutButton = document.getElementById("logoutButton");
            logoutButton.addEventListener("click", function() {
                var confirmation = confirm("Are you sure you want to log out?");
                if (confirmation) {
                    window.location.href = "login1.php";
                }
            });
        });
        window.submitReply = function() {
                var replyContent = replyTextarea.value.trim();
                if (replyContent === "") {
                    errorMessage.style.display = "block"; // Show error message
                    return;
                }
                errorMessage.style.display = "none"; // Hide error message if not empty
                // Handle the reply submission (e.g., send to server, update UI)
                alert("Reply submitted: " + replyContent);
                // Clear the textarea after submission
                replyTextarea.value = "";
            };
    
    </script>
</body>
</html>
