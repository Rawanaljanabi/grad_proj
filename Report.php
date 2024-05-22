<?php
session_start();

// Define the path to the upload directory
$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Check if the file has been uploaded through the form
if (isset($_FILES['fileInput']) && $_FILES['fileInput']['error'] == 0) {
    $fileTmpPath = $_FILES['fileInput']['tmp_name'];
    $fileName = $_FILES['fileInput']['name'];
    $filePath = $uploadDir . $fileName;

    // Move the uploaded file to the upload directory
    if (move_uploaded_file($fileTmpPath, $filePath)) {
        // Save the file path to the session or a file
        $_SESSION['reports'][] = [
            'date' => date('Y-m-d'),
            'time' => date('H:i:s'),
            'path' => $filePath
        ];
        echo "File uploaded successfully.";
    } else {
        echo "There was an error uploading the file.";
    }
} 
?>
<?php


// Check if there's any report data in the session
if (isset($_SESSION['reports'])) {
    // Send the reports history as JSON
    header('Content-Type: application/json');
    echo json_encode($_SESSION['reports']);
} else {
    echo json_encode([]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
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
        }
        .vectors2 {
            position: fixed;
            bottom: 0;
            right: 0;
            width: 100%;
        }
        .container {
            background: white;
            padding: 60px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        .logout {
            margin-left: auto;
        }
        #title {
            margin-right: 56%;
            color: #333;
            font-size: 25px;
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
        #filePath {
            width: calc(100% - 100px);
            padding: 8px;
            border: 1px solid #f5f5f5;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        button {
            padding: 10px 15px;
            background-color: #ddd;
            color: rgb(0, 0, 0);
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }
        button:hover {
            background-color: #CCE4F4;
        }
        #fileName {
            margin-top: 10px;
            font-size: 16px;
        }
        .ReportsHistory {
            min-width: 70%; /* Minimum width to ensure content is legible */
            padding: 20px;
            position: absolute; /* Position absolutely within the relative parent */
            top: 20px; /* Align to the top of the parent */
            right: 140px; /* Align to the right of the parent */
            height: 300px; /* Default, it adapts to the content */
            overflow-y: auto; /* Enables vertical scrolling when content overflows */
        }
        .ReportsHistory-header {
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
            padding-bottom: 10px;
            border-bottom: 1px solid #ccc
        }
        .ReportsHistory-row {
            background: #cac9c9b4;
            border-radius: 10px;
            margin-bottom: 10px;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .ReportsHistory-row span {
            flex: 1;
            text-align: center;
            margin: 0 5px;
        }
        .ReportsHistory-entries {
            margin: 0;
            padding: 0;
        }
        .ReportsHistory-row span:first-child {
            text-align: left;
        }
        .delete-button {
            background-color: #FA9E9E;
            border: none;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .delete-button:hover {
            background-color: #FF6B6B;
        }
        @media (max-width: 768px) {
            .ReportsHistory-row span {
                flex-basis: 25%;
            }
        }
    </style>
</head>
<body>
    <img class="vectors" src="blu vec.png">
    <img class="vectors2" src="pink vec.png">
    <aside class="sidebar">
        <h1>Care</h1>
        <ul>
            <li><button id="Add" type="button" class="buttons">Add</button></li>
            <li><button id="History" type="button" class="buttons">History</button></li>
        </ul>
    </aside>
    <header class="topbar">
        <div>
            <p id="title" style="white-space: nowrap;"></p>
        </div>
        <ul>
            <li>
                <a href="HPAdmin.php" class="home-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                    </svg>
                </a>
            </li>
            <li><button id="logoutButton" type="button" class="logout">Log Out</button></li>
        </ul>
    </header>
    <main class="container">
      
        <div class="AddButton-content">
            <input type="text" id="filePath" placeholder="Enter file path" />
            <button onclick="simulateClick()">Browse</button>
            <input type="file" id="fileInput" style="display: none;" onchange="fileSelected()" />
            <div id="fileName"></div>
            <button onclick="submitFile()">Submit</button>
        </div>
        <div class="ReportsHistory" style="display: none;">
            <div class="ReportsHistory-header">
                MY REPORTS
            </div>
            <div class="ReportsHistory-entries" id="ReportsHistoryEntries">
                <!-- Report entries will be added here by JavaScript -->
            </div>
        </div>
    </main>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var defaultTitle = "Reports";
            var titleElement = document.getElementById("title");
            var AddButtoncontent = document.querySelector(".AddButton-content");
            var AddButton = document.getElementById("Add");
            var HistoryContent = document.querySelector(".ReportsHistory");
            var HistoryButton = document.getElementById("History");

            titleElement.textContent = defaultTitle;

            function hideAllContentSections() {
                AddButtoncontent.style.display = "none";
                HistoryContent.style.display = "none";
            }

            function showAddButtonContent() {
                hideAllContentSections();
                AddButtoncontent.style.display = "block";
                titleElement.textContent = "Create New report";
            }

            function showHistorySection() {
                hideAllContentSections();
                HistoryContent.style.display = "block";
                titleElement.textContent = "Reports History";
                loadReportsHistory();
            }

            hideAllContentSections();

            AddButton.addEventListener("click", function() {
                showAddButtonContent();
            });

            HistoryButton.addEventListener("click", function() {
                showHistorySection();
            });

            var logoutButton = document.getElementById("logoutButton");
            logoutButton.addEventListener("click", function() {
                var confirmation = confirm("Are you sure you want to log out?");
                if (confirmation) {
                    window.location.href = "login1.php";
                }
            });

            function simulateClick() {
                document.getElementById('fileInput').click();
            }

            function fileSelected() {
                var fileInput = document.getElementById('fileInput');
                var filePathElement = document.getElementById('filePath');
                if (fileInput.files.length > 0) {
                    var fileName = fileInput.files[0].name;
                    filePathElement.value = fileName;
                }
            }

            function submitFile() {
                var fileInput = document.getElementById('fileInput');
                var filePathElement = document.getElementById('filePath');

                if (fileInput.files.length > 0) {
                    var file = fileInput.files[0];
                    var fileName = file.name;
                    filePathElement.value = fileName;

                    var filePath = "uploads/" + fileName;
                    addReportToHistory(filePath);
                    displayReportEntry({
                        date: new Date().toLocaleDateString(),
                        time: new Date().toLocaleTimeString(),
                        path: filePath
                    });
                    alert("File submitted: " + filePath);

                    hideAllContentSections();
                    document.querySelector('.ReportsHistory').style.display = 'block';
                    document.getElementById("title").textContent = "Reports History";
                } else {
                    alert("No file selected.");
                }
            }

            function addReportToHistory(filePath) {
                var reports = JSON.parse(localStorage.getItem('reports')) || [];
                var reportEntry = {
                    date: new Date().toLocaleDateString(),
                    time: new Date().toLocaleTimeString(),
                    path: filePath
                };
                reports.push(reportEntry);
                localStorage.setItem('reports', JSON.stringify(reports));
            }

            function displayReportEntry(report) {
                var ReportsHistoryEntries = document.getElementById('ReportsHistoryEntries');
                var entryDiv = document.createElement('div');
                entryDiv.classList.add('ReportsHistory-row');
                entryDiv.innerHTML = `
                    <span>${report.date}</span>
                    <span>${report.time}</span>
                    <span><a href="${report.path}" target="_blank">${report.path}</a></span>
                    <button class="delete-button" onclick="deleteReport('${report.path}')">Delete</button>
                `;
                ReportsHistoryEntries.appendChild(entryDiv);
            }

            function loadReportsHistory() {
                var reports = JSON.parse(localStorage.getItem('reports')) || [];
                var ReportsHistoryEntries = document.getElementById('ReportsHistoryEntries');
                ReportsHistoryEntries.innerHTML = '';
                reports.forEach(function(report) {
                    displayReportEntry(report);
                });
            }

            function deleteReport(filePath) {
                var reports = JSON.parse(localStorage.getItem('reports')) || [];
                var updatedReports = reports.filter(report => report.path !== filePath);
                localStorage.setItem('reports', JSON.stringify(updatedReports));
                loadReportsHistory();
                alert("File deleted: " + filePath);
            }

            window.simulateClick = simulateClick;
            window.fileSelected = fileSelected;
            window.submitFile = submitFile;
            window.deleteReport = deleteReport;
        });
    </script>
</body>
</html>