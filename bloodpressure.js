document.addEventListener("DOMContentLoaded", function() {

    var saveButton = document.getElementById("saveButton");
    var logoutButton = document.getElementById("logoutButton");

    const userEmail = "<?php echo $_SESSION['email']; ?>"; // Fetch the user's email from the session

    setupEventListeners();
    setupLogoutButton();
    loadBpReadings(); // Load readings from local storage

    function setupEventListeners() {
        saveButton.addEventListener("click", function() {
            var bpValue = document.getElementById("bloodPressure").value;
            handleBloodPressureSave(bpValue);
        });
    }

    function setupLogoutButton() {
        logoutButton.addEventListener("click", function() {
            var confirmation = confirm("Are you sure you want to log out?");
            if (confirmation) {
                window.location.href = "login1.php";
            }
        });
    }

    function handleBloodPressureSave(bpValue) {
        if (checkBloodPressure(bpValue)) { // Added function to check BP and alert if necessary
            moveArrow(bpValue);
            addBpReading(bpValue);
            alert("Blood pressure saved: " + bpValue);
        }
    }

    function moveArrow(bpValue) {
        var values = bpValue.split('/');
        var systolic = parseInt(values[0]);
        var diastolic = parseInt(values[1]);
        var arrow = document.getElementById('bpmArrow');
        var indicators = document.querySelectorAll('.status-indicator');
        indicators.forEach(indicator => {
            indicator.classList.remove('active');
        });

        if (systolic < 90 || diastolic < 60) {
            arrow.style.top = document.getElementById('low').offsetTop + 'px';
            document.getElementById('low').classList.add('active');
        } else if (systolic > 140 || diastolic > 90) {
            arrow.style.top = document.getElementById('high').offsetTop + 'px';
            document.getElementById('high').classList.add('active');
        } else {
            arrow.style.top = document.getElementById('norm').offsetTop + 'px';
            document.getElementById('norm').classList.add('active');
        }
    }

    function checkBloodPressure(bpValue) {
        var parts = bpValue.split('/');
        if (parts.length !== 2) {
            alert("Please enter the blood pressure in the format SYS/DIA.");
            return false;
        }

        var systolic = parseInt(parts[0]);
        var diastolic = parseInt(parts[1]);

        if (isNaN(systolic) || isNaN(diastolic)) {
            alert("Please make sure both systolic and diastolic values are numbers.");
            return false;
        }

        if (systolic < 90 || diastolic < 60) {
            alert("Warning: Blood Pressure is too low!");
        } else if (systolic > 140 || diastolic > 90) {
            alert("Warning: Blood Pressure is too high!");
        } else {
            alert("Blood Pressure is normal.");
        }

        return true;
    }

    function addBpReading(bpValue, shouldSave = true) {
        if (shouldSave) {
            saveBpReadings(bpValue);
        }
        var trendEntries = document.getElementById('trendEntries');
        var entryDiv = document.createElement('div');
        entryDiv.classList.add('trend-row');
        entryDiv.innerHTML = `
            <span>${new Date().toLocaleDateString()}</span>
            <span>${new Date().toLocaleTimeString()}</span>
            <span>${bpValue.split('/')[0]}</span>
            <span>${bpValue.split('/')[1]}</span>
        `;
        trendEntries.appendChild(entryDiv);
        trendEntries.scrollTop = trendEntries.scrollHeight; // Scroll to the latest entry
    }

    function loadBpReadings() {
        const readings = JSON.parse(localStorage.getItem(userEmail + '_bpReadings')) || [];
        readings.forEach(reading => addBpReading(reading.value, false));
    }

    function saveBpReadings(bpValue) {
        const readings = JSON.parse(localStorage.getItem(userEmail + '_bpReadings')) || [];
        readings.push({ date: new Date().toLocaleDateString(), time: new Date().toLocaleTimeString(), value: bpValue });
        localStorage.setItem(userEmail + '_bpReadings', JSON.stringify(readings));
    }

    var greetingElement = document.getElementById("greeting");
    greetingElement.textContent = "Blood Pressure"; // Set default greeting
});

// Service toggling functionality
document.querySelectorAll('.service-toggle').forEach(button => {
    button.addEventListener('click', function() {
        const service_name = this.dataset.serviceName;
        const status = this.checked ? 1 : 0;

        fetch('update_service_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `service_name=${encodeURIComponent(service_name)}&status=${status}`
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the service status.');
        });
    });
});
