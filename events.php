<?php
session_start();  // Start the session at the beginning of the script

require_once 'db.php';  // Assuming this file contains the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record System</title>
    <link rel="stylesheet" href="events.css">
    <style>
        #title {
            margin-right: 56%;
            color: #333;
            font-size: 25px;
        }
        .eventHistory-content {
width: 60%;
max-width: 90%;
min-width: 70%;
padding: 20px;
position: absolute;
top: 10px;
right: 140px;
height: 300px; /* Fixed height */
overflow-y: auto; /* Enables vertical scrolling when content overflows */
}
    </style>
</head>
<body>
    <img class="vectors" src="blu vec.png">
    <img class="vectors2" src="pink vec.png">

    <aside class="sidebar">
        <h1>Care</h1>
        <ul>
            <li><button id="NewEvent" type="button" class="buttons">Create New Event</button></li>
            <li><button id="eventHistory" type="button" class="buttons">Events History</button></li>
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
        <div class="NewEvent-content" style="display: none;">
            <p>Write a new event announcement</p>
            <textarea id="myTextAreas" placeholder="Subject"></textarea>
            <textarea id="myTextArea" placeholder="Type here..."></textarea>
            <div class="button-container" style="margin-top: 50px; text-align: right;">
                <button id="submitButton" class="submitButton">Send</button>
            </div>
        </div>

        <div class="eventHistory-content" style="display: none;">
            <div class="eventHistory-header">MY EVENTS</div>
            <div class="eventHistory-entries" id="eventHistoryEntries">
                <!-- Report entries will be added here by JavaScript -->
            </div>
        </div>
        <!-- Modal for displaying announcement text -->
        <div id="announcementModal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p id="modalText"></p>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var defaultTitle = "Events";
            var titleElement = document.getElementById("title");
            var NewEventContent = document.querySelector(".NewEvent-content");
            var NewEventButton = document.getElementById("NewEvent");
            var eventHistoryContent = document.querySelector(".eventHistory-content");
            var eventHistoryButton = document.getElementById("eventHistory");
            var eventHistoryEntries = document.getElementById("eventHistoryEntries");
            var submitButton = document.getElementById("submitButton");

            // Modal elements
            var modal = document.getElementById("announcementModal");
            var closeModal = modal.querySelector(".close");
            var modalText = document.getElementById("modalText");

            // Setting initial title
            titleElement.textContent = defaultTitle;

            // Function to hide all content sections
            function hideAllContentSections() {
                NewEventContent.style.display = "none";
                eventHistoryContent.style.display = "none";
            }

            // Event listeners for navigation buttons
            NewEventButton.addEventListener("click", function() {
                hideAllContentSections();
                NewEventContent.style.display = "block";
                titleElement.textContent = "Create New Event";
            });

            eventHistoryButton.addEventListener("click", function() {
                hideAllContentSections();
                eventHistoryContent.style.display = "block";
                titleElement.textContent = "Events History";
            });

            // Logout functionality
            var logoutButton = document.getElementById("logoutButton");
            logoutButton.addEventListener("click", function() {
                var confirmation = confirm("Are you sure you want to log out?");
                if (confirmation) {
                    window.location.href = "login1.php";
                }
            });

            // Modal close functionality
            closeModal.onclick = function() {
                modal.style.display = "none";
            };

            // Function to load existing announcements from localStorage
            function loadAnnouncements() {
                var savedAnnouncements = JSON.parse(localStorage.getItem('announcements')) || [];
                savedAnnouncements.forEach(function(announcement) {
                    addAnnouncementToDOM(announcement.date, announcement.time, announcement.subject, announcement.text);
                });
            }

            // Function to add announcement to DOM
            function addAnnouncementToDOM(date, time, subject, text) {
                var announcementCount = eventHistoryEntries.children.length + 1;
                var newAnnouncement = document.createElement("div");
                newAnnouncement.className = "eventHistory-entry";
                newAnnouncement.innerHTML = `
                    <span class="announcement-title">Announcement ${announcementCount}</span>
                    <span>${date} ${time}</span>
                    <span>${subject}</span>
                    <button class="delete-button">Delete</button>`;
                eventHistoryEntries.appendChild(newAnnouncement);

                // Attach event listeners to new announcement for delete and view functionality
                newAnnouncement.querySelector(".delete-button").addEventListener("click", function() {
                    eventHistoryEntries.removeChild(newAnnouncement);
                    removeAnnouncementFromStorage(date, time, subject);
                    updateAnnouncementNumbers();
                });
                newAnnouncement.querySelector(".announcement-title").addEventListener("click", function() {
                    modalText.textContent = `${subject}: ${text}`;
                    modal.style.display = "block";
                });
            }

            // Function to remove announcement from localStorage
            function removeAnnouncementFromStorage(date, time, subject) {
                var announcements = JSON.parse(localStorage.getItem('announcements')) || [];
                announcements = announcements.filter(function(announcement) {
                    return !(announcement.date === date && announcement.time === time && announcement.subject === subject);
                });
                localStorage.setItem('announcements', JSON.stringify(announcements));
            }

            // Function to update announcement numbers after deletion
            function updateAnnouncementNumbers() {
                Array.from(eventHistoryEntries.children).forEach((entry, index) => {
                    entry.querySelector('.announcement-title').textContent = `Announcement ${index + 1}`;
                });
            }

            // Event listener for submitting new announcements
            submitButton.addEventListener("click", function() {
                var announcementSubject = document.getElementById("myTextAreas").value.trim();
                var announcementText = document.getElementById("myTextArea").value.trim();
                if (announcementText && announcementSubject) {
                    var currentDateTime = new Date();
                    var formattedDate = currentDateTime.toISOString().split('T')[0]; // YYYY-MM-DD format
                    var formattedTime = currentDateTime.toTimeString().split(' ')[0]; // HH:MM:SS format
                    addAnnouncementToDOM(formattedDate, formattedTime, announcementSubject, announcementText);
                    saveAnnouncement(formattedDate, formattedTime, announcementSubject, announcementText);
                    document.getElementById("myTextAreas").value = "";
                    document.getElementById("myTextArea").value = "";
                    alert("Announcement has been sent.");
                } else {
                    alert("Please enter a subject and text for the announcement.");
                }
            });

            // Load announcements when the page loads
            loadAnnouncements();
            
            // Example AJAX setup for sending data
            function saveAnnouncement(date, time, subject, text) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "saveAnnouncement.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        console.log("Response:", xhr.responseText); // Debug response
                        alert("Announcement saved successfully");
                    } else {
                        console.error("Error saving announcement:", xhr.status); // Debug error
                        alert("Error saving announcement");
                    }
                };
                xhr.send("date=" + encodeURIComponent(date) + "&time=" + encodeURIComponent(time) + "&subject=" + encodeURIComponent(subject) + "&text=" + encodeURIComponent(text));
            }

        });
    </script>

</body>
</html>
