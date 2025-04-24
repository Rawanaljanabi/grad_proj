Medical Records Management System

This is my graduation project – a web-based medical records management system. It helps clinics manage patient data, appointments, diagnoses, and reports efficiently.

Features
	•	User login system for doctors and admins
	•	Add, edit, and delete patient records
	•	Appointment management
	•	Diagnostic and medical history tracking

Technologies Used
	•	PHP (Backend)
	•	MySQL (Database)
	•	HTML/CSS/JavaScript (Frontend)

How to Run the Project
	1.	Download & Setup
	•	Download XAMPP and install it.
	•	Clone or download this repository.
	•	Copy the project folder into htdocs (inside your XAMPP directory).
	2.	Database Setup
	•	Open phpMyAdmin from the XAMPP dashboard.
	•	Create a new database named healthcare.
	•	Import the healthcare.sql file included in this repository.
 
	3.	Edit DB Config
	•	In db.php or config.php, ensure the database settings match your local setup:
        $conn = mysqli_connect('localhost', 'root', '', 'healthcare');
Run the App
	•	Start Apache and MySQL from XAMPP.
	•	Open a browser and go to: http://localhost/login1.php

 Test Credentials
 as a staff:
	•	Username: zahrayousef@hotmail.com
	•	Password: Zahra99-
 
as an admin:
 •	Username: hadeelaymanf@hotmail.com
 •	Password: Hadeel99-

 as a patient:
 •	Username: rawan22hassan@gmail.com
 •	Password: Rawan99-

License

This project is for educational purposes.
