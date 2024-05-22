document.addEventListener("DOMContentLoaded", function() {
    let patientsFile;

    function getSessionData() {
        fetch('getSessionData.php')
        .then(response => response.json())
        .then(data => {
            if (data.patients_file) {
                patientsFile = data.patients_file;
                fetchAppointments();
            } else {
                console.error('Patients file not found in session');
            }
        })
        .catch(error => console.error('Failed to fetch session data:', error));
    }

    function fetchData(url, elementId, nameKey = 'name') {
        fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const select = document.getElementById(elementId);
            select.innerHTML = `<option value="">Choose ${elementId.replace('Dropdown', '')}</option>`;
            data.forEach(item => {
                select.innerHTML += `<option value="${item.id}">${item[nameKey]}</option>`;
            });
        })
        .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
            document.getElementById(elementId).innerHTML = `<option value="">Error loading data</option>`;
        });
    }

    document.getElementById('bookAppointment').addEventListener('click', function() {
        const formDisplay = document.getElementById('appointmentForm').style.display;
        document.getElementById('appointmentForm').style.display = formDisplay === 'none' ? 'block' : 'none';
    });

    fetchData('getHospitals.php', 'hospitalDropdown');
    document.getElementById('hospitalDropdown').addEventListener('change', function() {
        fetchData(`getClinics.php?hospital_id=${this.value}`, 'clinicDropdown');
    });

    document.getElementById('clinicDropdown').addEventListener('change', function() {
        fetchData(`getDoctors.php?clinic_id=${this.value}`, 'doctorDropdown');
    });

    document.getElementById('saveButton').addEventListener('click', function(event) {
        event.preventDefault();
        const form = document.getElementById('appointmentForm');
        const formData = new FormData(form);
        formData.append('patients_file', patientsFile); // Include patients_file in the form data

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
                const appointment = {
                    appointment_date: formData.get('appointment_date'),
                    appointment_time: formData.get('appointment_time'),
                    hospital_id: document.querySelector('#hospitalDropdown option:checked').textContent,
                    clinic_id: document.querySelector('#clinicDropdown option:checked').textContent,
                    doctor_id: document.querySelector('#doctorDropdown option:checked').textContent
                };
                addAppointmentToUpcoming(appointment);
                alert("Appointment saved successfully!");
                storeAppointment('upcomingAppointments', appointment);
            } else {
                alert(data.error || 'Failed to save appointment');
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            alert("Error saving appointment! This date and time is already booked. Please select another time or date.");
        });
    });

    function addAppointmentToUpcoming(appointment) {
        const upcomingList = document.getElementById('upcomingAppointmentsList').getElementsByTagName('tbody')[0];
        const row = upcomingList.insertRow();
        const cellDate = row.insertCell(0);
        const cellTime = row.insertCell(1);
        const cellHospital = row.insertCell(2);
        const cellClinic = row.insertCell(3);
        const cellDoctor = row.insertCell(4);

        cellDate.textContent = appointment.appointment_date;
        cellTime.textContent = appointment.appointment_time;
        cellHospital.textContent = appointment.hospital_id;
        cellClinic.textContent = appointment.clinic_id;
        cellDoctor.textContent = appointment.doctor_id;

        const completeButton = document.createElement('button');
        completeButton.textContent = 'Completed';
        completeButton.onclick = function() {
            moveAppointmentToPrevious(appointment);
            row.remove();
            removeAppointment('upcomingAppointments', appointment);
        };
        cellDoctor.appendChild(completeButton);
    }

    function moveAppointmentToPrevious(appointment) {
        const previousList = document.getElementById('previousAppointmentsList').getElementsByTagName('tbody')[0];
        const row = previousList.insertRow();
        const cellDate = row.insertCell(0);
        const cellTime = row.insertCell(1);
        const cellHospital = row.insertCell(2);
        const cellClinic = row.insertCell(3);
        const cellDoctor = row.insertCell(4);

        cellDate.textContent = appointment.appointment_date;
        cellTime.textContent = appointment.appointment_time;
        cellHospital.textContent = appointment.hospital_id;
        cellClinic.textContent = appointment.clinic_id;
        cellDoctor.textContent = appointment.doctor_id;

        storeAppointment('previousAppointments', appointment);
    }

    function storeAppointment(type, appointment) {
        let appointments = JSON.parse(localStorage.getItem(type)) || [];
        appointments.push(appointment);
        localStorage.setItem(type, JSON.stringify(appointments));
    }

    function removeAppointment(type, appointment) {
        let appointments = JSON.parse(localStorage.getItem(type)) || [];
        appointments = appointments.filter(a => 
            a.appointment_date !== appointment.appointment_date || 
            a.appointment_time !== appointment.appointment_time || 
            a.hospital_id !== appointment.hospital_id || 
            a.clinic_id !== appointment.clinic_id || 
            a.doctor_id !== appointment.doctor_id
        );
        localStorage.setItem(type, JSON.stringify(appointments));
    }

    function loadAppointments() {
        const upcomingAppointments = JSON.parse(localStorage.getItem('upcomingAppointments')) || [];
        upcomingAppointments.forEach(addAppointmentToUpcoming);

        const previousAppointments = JSON.parse(localStorage.getItem('previousAppointments')) || [];
        const previousList = document.getElementById('previousAppointmentsList').getElementsByTagName('tbody')[0];
        previousAppointments.forEach(appointment => {
            const row = previousList.insertRow();
            const cellDate = row.insertCell(0);
            const cellTime = row.insertCell(1);
            const cellHospital = row.insertCell(2);
            const cellClinic = row.insertCell(3);
            const cellDoctor = row.insertCell(4);

            cellDate.textContent = appointment.appointment_date;
            cellTime.textContent = appointment.appointment_time;
            cellHospital.textContent = appointment.hospital_id;
            cellClinic.textContent = appointment.clinic_id;
            cellDoctor.textContent = appointment.doctor_id;
        });
    }

    loadAppointments();
    getSessionData(); // Fetch patients_file from session

    function fetchAppointments() {
        fetch(`fetchAppointments.php`)
        .then(response => response.json())
        .then(data => {
            const upcomingList = document.getElementById('upcomingAppointmentsList').getElementsByTagName('tbody')[0];
            upcomingList.innerHTML = ''; // Clear existing entries
            data.forEach(appointment => {
                addAppointmentToUpcoming(appointment);
            });
        })
        .catch(error => console.error('Failed to fetch appointments:', error));
    }
});

document.addEventListen              r("DOMContentLoaded", function() {
    var defaultGreeting = "Appointments";
    var greetingElement = document.getElementById("greeting");
a
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
