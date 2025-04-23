-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2025 at 01:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `text` text DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `date`, `time`, `text`, `subject`) VALUES
(10, '2024-05-21', '00:42:47', 'there will be a celebration on Thursday at 8:00pm', 'nurses day'),
(11, '2024-05-22', '04:40:21', 'there will be a celebration for nurses day on Thursday at 8:00 pm', 'nurses day'),
(12, '2024-05-27', '09:24:42', 'hurses day we be celebrated on thursday at 8 pm', 'nures day'),
(13, '2024-06-04', '17:02:41', 'there will be a celebration for doctors day on Thursday at 8 pm', 'doctors day');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `announcement_text` text NOT NULL,
  `posted_on` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `user_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `status` enum('scheduled','cancelled','completed') NOT NULL DEFAULT 'scheduled',
  `patients_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `user_id`, `hospital_id`, `clinic_id`, `doctor_id`, `appointment_date`, `appointment_time`, `status`, `patients_file`) VALUES
(155, 000046, 4, 9, 8, '2024-05-06', '01:29:00', 'scheduled', '2201002026'),
(156, 000045, 4, 9, 8, '2024-05-28', '09:39:00', 'completed', '1113705774'),
(157, 000045, 4, 6, 12, '2024-06-13', '16:58:00', 'completed', '1113705774'),
(158, 000046, 4, 6, 12, '2024-06-25', '16:01:00', 'scheduled', '2201002026');

-- --------------------------------------------------------

--
-- Table structure for table `booked_appointments`
--

CREATE TABLE `booked_appointments` (
  `appointment_id` int(11) NOT NULL,
  `patients_file` varchar(255) DEFAULT NULL,
  `institute` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `blood_type` varchar(50) DEFAULT NULL,
  `status` enum('upcoming','completed') DEFAULT 'upcoming'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booked_appointments`
--

INSERT INTO `booked_appointments` (`appointment_id`, `patients_file`, `institute`, `start_date`, `end_date`, `start_time`, `end_time`, `blood_type`, `status`) VALUES
(6, '1113705774', 'hospital', '2024-05-22', '2024-05-23', '11:50:00', '15:51:00', 'all types ', 'completed'),
(7, '1113705774', 'hospital', '2024-05-08', '2024-06-05', '09:35:00', '09:36:00', 'AB+', 'completed'),
(8, '1113705774', 'hospital', '2024-06-12', '2024-06-20', '16:02:00', '22:58:00', 'A+', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `clinics`
--

CREATE TABLE `clinics` (
  `clinic_id` int(11) NOT NULL,
  `clinic_name` varchar(255) NOT NULL,
  `hospital_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clinics`
--

INSERT INTO `clinics` (`clinic_id`, `clinic_name`, `hospital_id`) VALUES
(1, 'dental clinic', 1),
(6, 'Dermatology', 4),
(7, 'Women\'s Wellness Gynecology Clinic', 4),
(9, 'Pediatric Partners Pediatric Clinic\r\n', 4),
(10, 'physiotherapy clinic', 4),
(12, 'Dental Clinic', 4);

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `complaint_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) NOT NULL,
  `admin_response` text DEFAULT NULL,
  `response_status` enum('new','replied') DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `subject`, `complaint_text`, `created_at`, `email`, `admin_response`, `response_status`) VALUES
(25, 'hello', 'hi', '2024-05-21 19:43:42', 'rawan22hassan@gmail.com', 'hello', 'replied'),
(26, 'staff complaint', 'blood donation is not working', '2024-05-21 20:46:34', 'zahrayousef@hotmail.com', 'we will work on it ', 'replied'),
(27, 'blood pressure', 'the blood pressure service doesn\'t work proprly', '2024-05-22 01:41:38', 'rawan22hassan@gmail.com', '', 'replied'),
(28, 'helloo', 'hiii', '2024-05-22 01:54:41', 'rawan22hassan@gmail.com', NULL, 'new'),
(29, 'shift schedule', 'my shift schedule doesn\'t appear!\r\nanwar aljanabi', '2024-05-27 05:55:26', 'zahrayousef@hotmail.com', NULL, 'new'),
(30, 'blood pressure', 'the blood pressure service doesn\'t work properly ', '2024-05-27 05:56:12', 'zahrayousef@hotmail.com', NULL, 'new'),
(31, 'staff complaint ', 'my shift is not appearing ', '2024-06-04 13:59:31', 'zahrayousef@hotmail.com', NULL, 'new'),
(32, 'blood donation service ', 'blood donation service is not working properly ', '2024-06-04 14:00:54', 'rawan22hassan@gmail.com', NULL, 'new');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int(11) NOT NULL,
  `doctor_name` varchar(255) NOT NULL,
  `specialty` varchar(255) DEFAULT NULL,
  `clinic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `doctor_name`, `specialty`, `clinic_id`) VALUES
(2, 'dt.ahmed', 'dentist', 1),
(8, 'Dr. Alya aljanabi', 'pediatrician', 9),
(10, 'Dr. Mortada Aljanabi', 'physiotherapist', 10),
(12, 'Dr. Anwar Aljanabi', 'Pharmacist', 6),
(13, 'Dr. Suzan ', NULL, 7),
(16, 'Dr. Saif', NULL, 12);

-- --------------------------------------------------------

--
-- Table structure for table `donation_appointments`
--

CREATE TABLE `donation_appointments` (
  `id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `institute` varchar(255) NOT NULL,
  `blood_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donation_appointments`
--

INSERT INTO `donation_appointments` (`id`, `start_date`, `end_date`, `start_time`, `end_time`, `institute`, `blood_type`) VALUES
(6, '2024-05-22', '2024-05-23', '11:50:00', '15:51:00', 'hospital', 'all types '),
(7, '2024-05-08', '2024-06-05', '09:35:00', '09:36:00', 'hospital', 'AB+'),
(8, '2024-06-12', '2024-06-20', '16:02:00', '22:58:00', 'hospital', 'A+');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_name`, `department`) VALUES
(1, 'zahra alyousef ', 'emergency'),
(2, 'zahra alyousef ', 'emergency');

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `hospital_id` int(11) NOT NULL,
  `hospital_name` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`hospital_id`, `hospital_name`, `location`) VALUES
(1, 'king fahad hospital', 'riydh'),
(4, 'qatif central hospital', 'qatif'),
(5, 'general hospital', 'hafr albatin'),
(6, 'general hospital', 'hafr albatin');

-- --------------------------------------------------------

--
-- Table structure for table `medications`
--

CREATE TABLE `medications` (
  `id` int(11) NOT NULL,
  `user_id` int(6) UNSIGNED ZEROFILL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `dose` varchar(100) NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_records`
--

CREATE TABLE `patient_records` (
  `id` int(11) NOT NULL,
  `patient_file_number` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `condition` text DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `height` decimal(5,2) DEFAULT NULL,
  `blood_type` varchar(5) DEFAULT NULL,
  `health_status` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_records`
--

INSERT INTO `patient_records` (`id`, `patient_file_number`, `name`, `age`, `condition`, `weight`, `height`, `blood_type`, `health_status`) VALUES
(11, '1113705774', 'RAWAN HASSAN ALJANABI', 23, 'headache', 60.00, 158.00, 'B+', 'need more water '),
(12, '', '', 0, '', 0.00, 0.00, '', ''),
(13, '', '', 0, '', 0.00, 0.00, '', ''),
(14, '', '', 0, '', 0.00, 0.00, '', ''),
(15, '', '', 0, '', 0.00, 0.00, '', ''),
(16, '2201002026', 'RAWAN HASSAN ALJANABI', 25, 'headache', 0.00, 166.00, 'b', 'normal'),
(17, '220100202', 'RAWAN HASSAN ALJANABI', 25, 'headache', 0.00, 166.00, 'b', 'normal'),
(18, '220100202', 'RAWAN HASSAN ALJANABI', 25, 'headache', 0.00, 166.00, 'b', 'normal'),
(19, '2201002026', 'RAWAN HASSAN ALJANABI', 25, 'headache', 144.00, 155.00, 'b', 'normal'),
(20, '2201002026', 'RAWAN HASSAN ALJANABI', 25, 'headache', 144.00, 155.00, 'b', 'normal'),
(21, '220100202', 'RAWAN HASSAN ALJANABI', 25, 'headache', 144.00, 155.00, 'b', 'normal'),
(22, '2201002026', 'RAWAN HASSAN ALJANABI', 25, 'headache', 55.00, 155.00, 'b', 'normal'),
(23, '2201002026', 'RAWAN HASSAN ALJANABI', 25, 'headache', 55.00, 166.00, 'b', 'normal'),
(24, '2201002026', 'RAWAN HASSAN ALJANABI', 25, 'headache', 55.00, 160.00, 'b', 'normal');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `prescription_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `condition_text` text NOT NULL,
  `medicine_name` text NOT NULL,
  `medicine_description` text NOT NULL,
  `dose` text NOT NULL,
  `notes` text DEFAULT NULL,
  `patients_file` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`prescription_id`, `name`, `age`, `condition_text`, `medicine_name`, `medicine_description`, `dose`, `notes`, `patients_file`) VALUES
(16, 'RAWAN HASSAN ALJANABI', '23', 'headache', 'panadol', 'pain killer', 'when needed', '8 hours between tables ', '1113705774'),
(17, '', '', '', '', '', '', '', ''),
(18, '', '', '', '', '', '', '', ''),
(19, 'RAWAN HASSAN ALJANABI', '25', 'headache', 'panadol', 'painkiller', 'twice a day', '', '220100202'),
(20, 'RAWAN HASSAN ALJANABI', '25', 'headache', 'panadol', 'painkiller', 'twice a day', '', '111370577'),
(21, 'RAWAN HASSAN ALJANABI', '25', 'headache', 'panadol', 'painkiller', 'twice a day', 'take when needed ', '2201002026'),
(22, 'RAWAN HASSAN ALJANABI', '25', 'headache', 'panadol', 'painkiller', 'twice a day', 'take when needed', '2201002026'),
(23, 'RAWAN HASSAN ALJANABI', '25', 'headache', 'panadol', 'painkiller', 'twice a day', 'take when needed', '2201002026'),
(24, 'RAWAN HASSAN ALJANABI', '25', 'headache', 'panadol', 'painkiller', 'twice a day', 'take when needed', '2201002026');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_name`, `is_active`) VALUES
('Appointments', 0),
('Blood Donation', 0),
('Blood Pressure', 1),
('Heart Rate', 1),
('Medication Track', 1),
('Sleep Tracking', 1),
('Steps & Calories', 1);

-- --------------------------------------------------------

--
-- Table structure for table `services_status`
--

CREATE TABLE `services_status` (
  `service_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services_status`
--

INSERT INTO `services_status` (`service_name`, `is_active`) VALUES
('appointments', 1),
('Blood Donation', 1),
('Blood Pressure', 1),
('Heart Rate', 1),
('Medication Track', 1),
('Sleep Tracking', 1),
('Steps & Calories', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shift_schedule`
--

CREATE TABLE `shift_schedule` (
  `id` int(11) NOT NULL,
  `department` varchar(255) DEFAULT NULL,
  `employee_name` varchar(255) DEFAULT NULL,
  `employee_email` varchar(255) DEFAULT NULL,
  `shift_date` date DEFAULT NULL,
  `shift_start_time` time DEFAULT NULL,
  `shift_end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shift_schedule`
--

INSERT INTO `shift_schedule` (`id`, `department`, `employee_name`, `employee_email`, `shift_date`, `shift_start_time`, `shift_end_time`) VALUES
(2, 'Emergency', 'zahra', 'zahrayousef@hotmail.com', '2024-05-21', '03:36:00', '03:36:00'),
(3, 'Cardiology', 'ali', 'ali1223@hotmail.com', '2024-05-28', '10:46:00', '02:46:00'),
(4, 'Cardiology', 'hadeel', 'hadeelayman@hotmail.com', '2024-05-01', '10:47:00', '02:47:00'),
(5, 'Cardiology', 'hadeel', 'hadeelayman@hotmail.com', '2024-05-13', '11:20:00', '02:20:00'),
(6, 'Cardiology', 'hadeel', 'hadeelayman@hotmail.com', '2024-06-12', '17:05:00', '22:01:00');

-- --------------------------------------------------------

--
-- Table structure for table `urgent_donation`
--

CREATE TABLE `urgent_donation` (
  `id` int(11) NOT NULL,
  `donation_details` text NOT NULL,
  `posted_on` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `urgent_donation`
--

INSERT INTO `urgent_donation` (`id`, `donation_details`, `posted_on`) VALUES
(3, '#2201002024\npaitent is in urgent need for blood donation with blood Type A+\nqatif central hospital', '2024-05-21 23:52:45'),
(4, 'AB blood type is needed urgently', '2024-05-27 09:32:42'),
(5, 'AB blood type is needed urgently', '2024-05-27 09:32:56'),
(6, 'urgent blood donation is needed', '2024-06-04 16:58:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('patient','staff','admin') NOT NULL,
  `DOB` date DEFAULT NULL,
  `Gender` enum('Female','Male') DEFAULT NULL,
  `Blood_Type` varchar(3) DEFAULT NULL,
  `patients_file` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`, `user_type`, `DOB`, `Gender`, `Blood_Type`, `patients_file`) VALUES
(000004, 'zahra', 'zahra@hotmail.com', '$2y$10$GDYxG1/QhvI2K597aJ/9zejHL10Qyc1bM60m9s2GlGwJmUmAfkfDy', 'patient', NULL, NULL, NULL, NULL),
(000005, 'hadeel ayman', 'hadeel@hotmail.com', '$2y$10$rkJBl4AMJriccury5Yspd.SfHpuKMqlS.YgXEX9SXUDjL5rGK6K.q', 'admin', NULL, NULL, NULL, NULL),
(000006, 'Jrawan hassan', 'rawan@gmail.com', '$2y$10$8LHNBTWgx1aSP75lk06C9eweSs7mCnodX4SXxAH6UNH9t54gMAweO', 'staff', NULL, NULL, NULL, NULL),
(000010, 'batool hussain', 'batool@hotmail.com', '$2y$10$ppkK5b7lWmjYUq.MrSseI.iuGyNNNcvOAJ9.GJaTjkLBiAbjYljPS', 'patient', NULL, NULL, NULL, NULL),
(000015, 'batool hussain', 'batool1@hotmail.com', '$2y$10$L0K7tVRy581A8URUwxWW/.Wljub1zr5b/dXN9gYyxHZvu/FhUrQhW', 'patient', '2024-04-28', 'Female', 'B+', NULL),
(000019, 'RAWAN HASSAN ALJANABI', 'rawan22hassan@hotmail.com', '$2y$10$YgOXJqazZeS.NR1Kf7TbxugL6YhQEFn6hTdgwx.38g76iXgMoAMEi', 'patient', '2024-05-07', 'Female', 'B+', '2201002026'),
(000020, 'rawan staff', 'rawan22@hotmail.com', 'Rawan99-', 'staff', NULL, NULL, NULL, NULL),
(000022, 'rawan staff', 'rawanj@hotmail.com', 'Rawan99-', 'staff', NULL, NULL, NULL, NULL),
(000023, 'batool hussain', 'batool12@hotmail.com', '$2y$10$2gGFBZam2jakbM7fDdqD5unxMT4kyt/kvnt2jLxl9XPv0WO2SGWoa', 'patient', '2024-05-09', 'Female', 'B-', '1234567890'),
(000024, 'fatima aziz', 'fatima@hotmail.com', 'Fatima99-', 'staff', NULL, NULL, NULL, NULL),
(000026, 'hadeel ayman', 'hadeeel@hotmail.com', '$2y$10$tMTQHJu4qThVXdPUE2KY6O0OwtYRtHBKlcJmD23RCzF6YAKGOcK.i', 'staff', NULL, NULL, NULL, NULL),
(000033, 'ayman', 'ayman@hotmail.com', '$2y$10$XbTC.TM5Mpa1P5Nd4jnqWeO1aJgx2mbLublglnlfVa2V0hv9Z0G92', 'staff', NULL, NULL, NULL, NULL),
(000035, 'rawan', 'rawannn@hotmail.com', '$2y$10$kkv3iZevNJo9cvvBexdIr.ZVHK3D9LldbhpDx8yGzYTEIpXsBUgHO', 'staff', NULL, NULL, NULL, NULL),
(000038, 'RAWAN HASSAN ALJANABI', 'rawan222hassan@hotmail.com', '$2y$10$1386voIXpR4Ept3JTvAKxuUIML2vtW13OudJq4TcMn6jlIhkePAcW', 'patient', '2024-05-08', 'Female', 'B+', '2201002027'),
(000039, 'RAWAN ALJANABI', 'rawan2hassan@hotmail.com', '$2y$10$9nNAPiKVwVeH9994jigvHu0dlxESH8YiWsOEd/cs2CtiBv20CP05.', 'patient', '2024-05-31', 'Female', 'B+', '2201002028'),
(000040, 'hadeel ayman', 'hadeel.19@hotmail.com', '$2y$10$NysFl2Ir.QC4Z.YK.JLZ7.oQc8ncVlLdMeanyVda6uHlqm4jJWbAm', 'patient', '2024-05-07', 'Female', 'AB+', '1223334444'),
(000041, 'zahra yousef', 'zayo@hotmail.com', '$2y$10$Pn/YcpD8jbyJ19t3Mmc5eOqmjnCFuYEVwNLs/oiu8mDFzFZ6Etkja', 'staff', NULL, NULL, NULL, NULL),
(000042, 'rawan hassan', 'rawjan@hotmail.com', '$2y$10$mxTOi03TxqlqBB7t9M.Zkeb1Se04xWYSvXcoqV5ynOcpLOo7OMxg6', 'admin', NULL, NULL, NULL, NULL),
(000045, 'RAWAN HASSAN ALJANABI', 'rawan22hassan@gmail.com', '$2y$10$a.mOl1xDh1n8ZOxShvD9TOQjBu5EhQGOUJiU0viAkX10lya4k1r4q', 'patient', '2001-10-09', 'Female', 'B+', '1113705774'),
(000046, 'zahra yousef alyousef', 'zahrayousef@hotmail.com', '$2y$10$V14EjP8g3oJD0G0qOI44UePUwAD3qRw4aRMde6wqvB2TYyPrYjK9.', 'staff', NULL, NULL, NULL, NULL),
(000047, 'hadeel ayman mughayis', 'hadeelayman@hotmail.com', '$2y$10$q0Dzg6KGoVS.UEk/NT/Tauopk3hKaIpMo6KEPA7gLWS6JuJcdAW1u', 'admin', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD UNIQUE KEY `uc_appointment` (`appointment_date`,`appointment_time`,`doctor_id`,`clinic_id`),
  ADD KEY `fk_appointments_clinic_id` (`clinic_id`),
  ADD KEY `fk_appointments_doctor_id` (`doctor_id`),
  ADD KEY `fk_appointments_hospital_id` (`hospital_id`);

--
-- Indexes for table `booked_appointments`
--
ALTER TABLE `booked_appointments`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `clinics`
--
ALTER TABLE `clinics`
  ADD PRIMARY KEY (`clinic_id`),
  ADD KEY `hospital_id` (`hospital_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`),
  ADD KEY `clinic_id` (`clinic_id`);

--
-- Indexes for table `donation_appointments`
--
ALTER TABLE `donation_appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`hospital_id`);

--
-- Indexes for table `medications`
--
ALTER TABLE `medications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `patient_records`
--
ALTER TABLE `patient_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`prescription_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_name`);

--
-- Indexes for table `services_status`
--
ALTER TABLE `services_status`
  ADD PRIMARY KEY (`service_name`);

--
-- Indexes for table `shift_schedule`
--
ALTER TABLE `shift_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urgent_donation`
--
ALTER TABLE `urgent_donation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `patients_file` (`patients_file`),
  ADD KEY `idx_users_email` (`email`),
  ADD KEY `patients_file_2` (`patients_file`),
  ADD KEY `patients_file_3` (`patients_file`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `clinics`
--
ALTER TABLE `clinics`
  MODIFY `clinic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `donation_appointments`
--
ALTER TABLE `donation_appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `hospital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `medications`
--
ALTER TABLE `medications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `patient_records`
--
ALTER TABLE `patient_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `prescription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `shift_schedule`
--
ALTER TABLE `shift_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `urgent_donation`
--
ALTER TABLE `urgent_donation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `fk_appointments_clinic_id` FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`clinic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_appointments_doctor_id` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_appointments_hospital_id` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_appointments_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clinics`
--
ALTER TABLE `clinics`
  ADD CONSTRAINT `clinics_ibfk_1` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`);

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`clinic_id`);

--
-- Constraints for table `medications`
--
ALTER TABLE `medications`
  ADD CONSTRAINT `medications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
