document.addEventListener("DOMContentLoaded", function() {
    const saveMedicationButton = document.getElementById('saveMedicationButton');
    const medicationForm = document.getElementById('medicationForm');
    const logoutButton = document.getElementById("logoutButton");

    saveMedicationButton.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent any form submission
        const formData = new FormData(medicationForm.querySelector('form'));

        if (!formData.get('name') || !formData.get('dose')) {
            alert('Please fill in all fields.');
            return;
        }

        // Convert FormData to URLSearchParams if your server expects URL encoded form data
        const urlEncodedData = new URLSearchParams();
        formData.forEach((value, key) => urlEncodedData.append(key, value));

        fetch('Medications.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: urlEncodedData
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not OK');
            return response.json();
        })
        .then(data => {
            if (data.error) {
                alert('Failed to save medication: ' + data.error);
            } else {
                alert('Medication saved successfully!');
                // Properly prepare the object for local storage
                const newMedication = {
                    name: formData.get('name'),
                    dose: formData.get('dose'),
                    time: formData.get('medicationTime'), // Assuming there's a time field
                    completed: false // Set medication as not completed initially
                };
                updateLocalStorageWithMedication(newMedication); // Update local storage
                displayMedications(); // Refresh display
                medicationForm.querySelector('form').reset(); // Reset the form after successful data submission
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to save medication. Please try again.');
        });
    });

    displayMedications(); // Initial display of medications

    logoutButton.addEventListener("click", function() {
        var confirmation = confirm("Are you sure you want to log out?");
        if (confirmation) {
            window.location.href = "login1.php";
        }
    });
});

function updateLocalStorageWithMedication(newMedication) {
    let medications = JSON.parse(localStorage.getItem('medications')) || [];
    medications.push(newMedication);
    localStorage.setItem('medications', JSON.stringify(medications));
}

function displayMedications() {
    const medications = JSON.parse(localStorage.getItem('medications')) || [];
    const tableBody = document.querySelector('#medicationsTable tbody');
    tableBody.innerHTML = ''; // Clear previous entries

    medications.forEach((med, index) => {
        let row = tableBody.insertRow();
        row.insertCell(0).textContent = med.name;
        row.insertCell(1).textContent = med.dose;
        let statusCell = row.insertCell(2);
        let completeButton = document.createElement('button');
        completeButton.textContent = 'Complete';
        completeButton.addEventListener('click', () => markAsCompleted(index));
        statusCell.appendChild(completeButton);
    });
}

function markAsCompleted(index) {
    let medications = JSON.parse(localStorage.getItem('medications')) || [];
    medications[index].completed = true;
    localStorage.setItem('medications', JSON.stringify(medications));
    displayMedications();
}
