document.addEventListener("DOMContentLoaded", function() {
    // Toggle the display of the appointment form
    document.getElementById('appointments').addEventListener('click', function() {
        var formDisplay = document.getElementById('appointments-form').style.display;
        document.getElementById('appointments-form').style.display = formDisplay === 'none' ? 'block' : 'none';
    });

    // Fetch hospitals to populate the dropdown
    fetchData('getHospitals.php', 'hospital-select');
    document.getElementById('hospital-select').addEventListener('change', function() {
        fetchData(getClinics.php?hospital_id=${this.value}, 'clinic-select');
    });

    // Fetch clinics based on selected hospital to populate the dropdown
    document.getElementById('clinic-select').addEventListener('change', function() {
        fetchData(getDoctors.php?clinic_id=${this.value}, 'doctor-select');
    });

    // Submit appointment form
    document.getElementById('appointments-form').addEventListener('submit', function(event) {
        event.preventDefault();  // Prevent the default form submission
        const formData = new FormData(this);

        fetch('saveAppointment.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Success:', data);
            if (data.success) {
                alert("Appointment saved successfully!");
                document.getElementById('result').textContent = 'Appointment booked successfully!';
            } else {
                throw new Error(data.error || 'Failed to save appointment');
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            alert("Error saving appointment! This date and time is already booked. Please select another time or date.");
            document.getElementById('result').textContent = 'Error saving appointment. Please try again.';
        });
    });

    var defaultGreeting = "Appointments";
    var greetingElement = document.getElementById("greeting");
    greetingElement.textContent = defaultGreeting;
});

// Function to fetch data and populate dropdowns
function fetchData(url, elementId) {
    fetch(url)
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        const select = document.getElementById(elementId);
        select.innerHTML = <option value="">Select ${elementId.replace('-select', '')}</option>;
        data.forEach(item => {
            select.innerHTML += <option value="${item.id}">${item.name}</option>;
        });
    })
    .catch(error => {
        console.error('There has been a problem with your fetch operation:', error);
        document.getElementById(elementId).innerHTML = <option value="">Error loading data</option>;
    });
}

document.getElementById('logoutButton').addEventListener('click', function() {
    var confirmation = confirm("Are you sure you want to log out?");
    if (confirmation) {
        window.location.href = "login.html";
    }
});