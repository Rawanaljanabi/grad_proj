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
            window.location.href = "page1.html";
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
            addAnnouncementToDOM(announcement.date, announcement.time, announcement.text);
        });
    }

    // Function to add announcement to DOM
    function addAnnouncementToDOM(date, time, text) {
        var announcementCount = eventHistoryEntries.children.length + 1;
        var newAnnouncement = document.createElement("div");
        newAnnouncement.className = "eventHistory-entry";
        newAnnouncement.innerHTML = `
            <span class="announcement-title">Announcement ${announcementCount}</span>
            <span>${date} ${time}</span>
            <button class="delete-button">Delete</button>`;
        eventHistoryEntries.appendChild(newAnnouncement);

        // Attach event listeners to new announcement for delete and view functionality
        newAnnouncement.querySelector(".delete-button").addEventListener("click", function() {
            eventHistoryEntries.removeChild(newAnnouncement);
            removeAnnouncementFromStorage(date, time);
            updateAnnouncementNumbers();
        });
        newAnnouncement.querySelector(".announcement-title").addEventListener("click", function() {
            modalText.textContent = text;
            modal.style.display = "block";
        });
    }

    // Function to remove announcement from localStorage
    function removeAnnouncementFromStorage(date, time) {
        var announcements = JSON.parse(localStorage.getItem('announcements')) || [];
        announcements = announcements.filter(function(announcement) {
            return !(announcement.date === date && announcement.time === time);
        });
        localStorage.setItem('announcements', JSON.stringify(announcements));
    }

    // Function to update announcement numbers after deletion
    function updateAnnouncementNumbers() {
        Array.from(eventHistoryEntries.children).forEach((entry, index) => {
            entry.querySelector('.announcement-title').textContent = Announcement ${index + 1};
        });
    }

    // Event listener for submitting new announcements
    submitButton.addEventListener("click", function() {
        var announcementText = document.getElementById("myTextArea").value.trim();
        if (announcementText) {
            var currentDateTime = new Date();
            var formattedDate = currentDateTime.toLocaleDateString();
            var formattedTime = currentDateTime.toLocaleTimeString();
            addAnnouncementToDOM(formattedDate, formattedTime, announcementText);
            saveAnnouncement(formattedDate, formattedTime, announcementText);
            document.getElementById("myTextArea").value = "";
            alert("Announcement has been sent.");
        } else {
            alert("Please enter some text for the announcement.");
        }
    });

    // Load announcements when the page loads
    loadAnnouncements();
    // Example AJAX setup for sending data
function saveAnnouncement(date, time, text) {
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
    xhr.send("date=" + encodeURIComponent(date) + "&time=" + encodeURIComponent(time) + "&text=" + encodeURIComponent(text));
}

});