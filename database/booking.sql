-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2019 at 04:28 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reset_student`
--

CREATE TABLE `reset_student` (
  `id` int(11) NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `facility_id` int(11) NOT NULL,
  `previous_hall` varchar(30) NOT NULL,
  `room_number` int(11) NOT NULL,
  `disability` enum('yes','no') NOT NULL,
  `disability_specification` text,
  `approval` enum('yes','no','pending','reset') NOT NULL,
  `status` enum('confirm','reject','pending','') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reset_student`
--

INSERT INTO `reset_student` (`id`, `users_id`, `facility_id`, `previous_hall`, `room_number`, `disability`, `disability_specification`, `approval`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'None', 9, 'no', NULL, 'yes', 'pending', '2019-11-19 11:29:41', '2019-11-24 14:30:20'),
(2, 10, 1, 'Hall 1', 2, 'yes', NULL, 'yes', 'pending', '2019-10-15 11:30:16', '2019-11-26 18:24:57'),
(3, 4, 1, 'Hall 2', 3, 'yes', NULL, 'yes', 'pending', '2019-11-19 11:40:03', '2019-11-20 06:36:30'),
(4, 11, 1, 'Hall 2', 2, 'no', NULL, 'no', 'pending', '2019-11-20 13:00:16', '2019-11-24 12:05:11'),
(6, 8, 1, 'Hall 3', 2, 'no', NULL, 'yes', 'pending', '2019-11-13 13:17:06', '2019-11-26 18:28:17'),
(7, 1, 1, 'Hall 1', 2, 'no', NULL, 'yes', 'pending', '2019-10-08 13:46:08', '2019-11-26 18:25:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bed_space`
--

CREATE TABLE `tbl_bed_space` (
  `id` int(11) NOT NULL,
  `hall_name` varchar(255) NOT NULL,
  `space` int(11) NOT NULL,
  `gender_for` enum('male','female','','') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bed_space`
--

INSERT INTO `tbl_bed_space` (`id`, `hall_name`, `space`, `gender_for`, `created_at`, `updated_at`) VALUES
(3, 'hall5', 110, 'female', '2019-11-30 09:52:57', '2019-11-30 09:52:57'),
(4, 'hall1', 123, 'male', '2019-11-30 13:09:28', '2019-11-30 13:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `id` int(11) NOT NULL,
  `schools_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`id`, `schools_id`, `department_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'CSIT', '2019-11-17 19:31:56', '2019-11-17 19:31:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_facility`
--

CREATE TABLE `tbl_facility` (
  `id` int(11) NOT NULL,
  `facility_name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `capacity` int(11) NOT NULL,
  `amount` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_facility`
--

INSERT INTO `tbl_facility` (`id`, `facility_name`, `description`, `capacity`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'hostels', 'rooms for students', 2000, 40000, '2019-11-14 19:17:40', '2019-11-18 06:24:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_facility_booking_public`
--

CREATE TABLE `tbl_facility_booking_public` (
  `id` int(11) NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `facility_id` int(11) NOT NULL,
  `starting_date` date NOT NULL,
  `end_date` date NOT NULL,
  `starting_time` time NOT NULL,
  `end_time` time NOT NULL,
  `participants` int(11) NOT NULL,
  `booking_purpose` text NOT NULL,
  `approval` enum('yes','no','pending','') NOT NULL,
  `status` enum('confirm','reject','pending','') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_facility_booking_student`
--

CREATE TABLE `tbl_facility_booking_student` (
  `id` int(11) NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `facility_id` int(11) NOT NULL,
  `previous_hall` varchar(30) NOT NULL,
  `room_number` int(11) NOT NULL,
  `disability` enum('yes','no') NOT NULL,
  `disability_specification` text,
  `approval` enum('yes','no','pending','reset') NOT NULL,
  `status` enum('confirm','reject','pending','') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_facility_booking_student`
--

INSERT INTO `tbl_facility_booking_student` (`id`, `users_id`, `facility_id`, `previous_hall`, `room_number`, `disability`, `disability_specification`, `approval`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'None', 9, 'no', NULL, 'yes', 'pending', '2019-11-19 11:29:41', '2019-11-24 14:30:20'),
(2, 10, 1, 'Hall 1', 2, 'yes', NULL, 'yes', 'pending', '2019-10-15 11:30:16', '2019-11-26 18:24:57'),
(3, 4, 1, 'Hall 2', 3, 'yes', NULL, 'yes', 'pending', '2019-11-19 11:40:03', '2019-11-20 06:36:30'),
(4, 11, 1, 'Hall 2', 2, 'no', NULL, 'no', 'pending', '2019-11-20 13:00:16', '2019-11-24 12:05:11'),
(6, 8, 1, 'Hall 3', 2, 'no', NULL, 'yes', 'pending', '2019-11-13 13:17:06', '2019-11-26 18:28:17'),
(7, 1, 1, 'Hall 1', 2, 'no', NULL, 'yes', 'pending', '2019-10-08 13:46:08', '2019-11-26 18:25:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permission`
--

CREATE TABLE `tbl_permission` (
  `id` int(11) NOT NULL,
  `permission_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_programmes`
--

CREATE TABLE `tbl_programmes` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `programme_code` varchar(30) NOT NULL,
  `programme_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_programmes`
--

INSERT INTO `tbl_programmes` (`id`, `department_id`, `programme_code`, `programme_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'BBIT', 'Business Information Technology', '2019-11-17 19:32:36', '2019-11-17 19:32:36'),
(2, 1, 'CIS', 'Computer System and Security', '2019-11-20 09:23:21', '2019-11-20 09:23:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'System_administrator', '2019-10-13 11:48:45', '2019-10-13 11:50:23'),
(2, 'Student', '2019-10-13 11:48:45', '2019-10-13 11:48:45'),
(3, 'General_public', '2019-10-13 11:48:45', '2019-10-13 11:48:45'),
(4, 'Estates', '2019-10-13 11:48:45', '2019-10-13 11:48:45'),
(5, 'Transport', '2019-10-13 11:48:45', '2019-10-13 11:48:45'),
(6, 'General_staff', '2019-10-13 11:48:45', '2019-10-13 11:48:45'),
(7, 'System_administrator', '2019-10-13 09:48:45', '2019-10-13 09:50:23'),
(8, 'Student', '2019-10-13 09:48:45', '2019-10-13 09:48:45'),
(9, 'General_public', '2019-10-13 09:48:45', '2019-10-13 09:48:45'),
(10, 'Estates', '2019-10-13 09:48:45', '2019-10-13 09:48:45'),
(11, 'Transport', '2019-10-13 09:48:45', '2019-10-13 09:48:45'),
(12, 'General_staff', '2019-10-13 09:48:45', '2019-10-13 09:48:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role_has_permission`
--

CREATE TABLE `tbl_role_has_permission` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schools`
--

CREATE TABLE `tbl_schools` (
  `id` int(11) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_schools`
--

INSERT INTO `tbl_schools` (`id`, `school_name`, `created_at`, `updated_at`) VALUES
(1, 'MIT', '2019-11-17 19:31:41', '2019-11-17 19:31:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transport_booking`
--

CREATE TABLE `tbl_transport_booking` (
  `id` int(11) NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `vehicles_id` int(11) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `date_required` date NOT NULL,
  `date_expected` date NOT NULL,
  `time_required` time NOT NULL,
  `time_expected_back` time NOT NULL,
  `passengers` int(11) NOT NULL,
  `reason` text NOT NULL,
  `approval` enum('yes','no') NOT NULL,
  `endorsed` enum('yes','no') NOT NULL,
  `status` enum('success','failure','pending','') NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicles`
--

CREATE TABLE `tbl_vehicles` (
  `id` int(11) NOT NULL,
  `vehicle_name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `capacity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `programmes_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `programmes_id`, `first_name`, `middlename`, `last_name`, `gender`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Dennis', NULL, 'Makwakwa', 'male', 'bit-050-16@must.ac.mw', NULL, '$2y$10$cNdho3b4t1Py3FjbqVe53ujh6qlP1S0wlMZxl4je5yXc6PaNPcQLW', NULL, '2019-09-25 08:10:30', '2019-11-20 13:24:33'),
(2, 4, 0, 'Charles', NULL, 'Makamo', 'male', 'cmakamo@must.ac.mw', NULL, '$2y$10$c3dTObY5FOZk5CRAk23ge.R9/YKTttYQdLXhwpSP1p1lgaooGPBjO', NULL, '2019-09-25 09:28:49', '2019-11-20 08:23:58'),
(3, 2, 1, 'Julius', NULL, 'Malema', 'male', 'ju@gmail.com', NULL, '$2y$10$af.SjReNDzGep2BeGcb8Du4NtI8lG28c3vc3bgKEdBKUZgz2ccII6', NULL, '2019-09-30 05:30:09', '2019-11-20 08:23:58'),
(4, 2, 1, 'Loyce ', NULL, 'Nkundula', 'female', 'lnkundula@gmail.com', NULL, '$2y$10$c3dTObY5FOZk5CRAk23ge.R9/YKTttYQdLXhwpSP1p1lgaooGPBjO', NULL, '2019-10-04 11:47:31', '2019-11-20 08:23:58'),
(5, 2, 1, 'Joyful', 'Lameck', 'Semu', 'female', 'bit-050-16@must.ac.mw', NULL, '$2y$10$c3dTObY5FOZk5CRAk23ge.R9/YKTttYQdLXhwpSP1p1lgaooGPBjO', NULL, '2019-10-14 05:29:41', '2019-11-20 13:24:04'),
(6, 2, 1, 'Madalitso', NULL, 'Nyemba', 'male', 'mnyemba@must', NULL, '$2y$10$c3dTObY5FOZk5CRAk23ge.R9/YKTttYQdLXhwpSP1p1lgaooGPBjO', NULL, '2019-10-14 05:44:06', '2019-11-20 08:23:58'),
(8, 2, 1, 'Arthur', NULL, 'Mwang\'onda', 'male', 'bit-054-16@must.ac.mw', NULL, '$2y$10$c3dTObY5FOZk5CRAk23ge.R9/YKTttYQdLXhwpSP1p1lgaooGPBjO', NULL, '2019-10-14 05:44:06', '2019-11-20 13:15:58'),
(10, 2, 2, 'Memory ', NULL, 'Salt', 'female', 'memo@salt', NULL, '$2y$10$c3dTObY5FOZk5CRAk23ge.R9/YKTttYQdLXhwpSP1p1lgaooGPBjO', NULL, '2019-11-14 05:44:06', '2019-11-20 11:20:56'),
(11, 2, 1, 'Emmanuel', NULL, 'Phiri', 'male', 'ephiri@must.ac.mw', NULL, '$2y$10$c3dTObY5FOZk5CRAk23ge.R9/YKTttYQdLXhwpSP1p1lgaooGPBjO', NULL, '2019-11-14 05:44:06', '2019-11-20 11:21:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reset_student`
--
ALTER TABLE `reset_student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_id` (`users_id`),
  ADD KEY `fk_tbl_facility_booking_student_tbl_facility1_idx` (`facility_id`),
  ADD KEY `fk_tbl_facility_booking_student_users1_idx` (`users_id`);

--
-- Indexes for table `tbl_bed_space`
--
ALTER TABLE `tbl_bed_space`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_department_tbl_schools1_idx` (`schools_id`);

--
-- Indexes for table `tbl_facility`
--
ALTER TABLE `tbl_facility`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_facility_booking_public`
--
ALTER TABLE `tbl_facility_booking_public`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_facility_booking_public_tbl_facility1_idx` (`facility_id`),
  ADD KEY `fk_tbl_facility_booking_public_users1_idx` (`users_id`);

--
-- Indexes for table `tbl_facility_booking_student`
--
ALTER TABLE `tbl_facility_booking_student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_id` (`users_id`),
  ADD KEY `fk_tbl_facility_booking_student_tbl_facility1_idx` (`facility_id`),
  ADD KEY `fk_tbl_facility_booking_student_users1_idx` (`users_id`);

--
-- Indexes for table `tbl_permission`
--
ALTER TABLE `tbl_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_programmes`
--
ALTER TABLE `tbl_programmes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_programmes_tbl_department1_idx` (`department_id`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_role_has_permission`
--
ALTER TABLE `tbl_role_has_permission`
  ADD KEY `fk_tbl_role_has_tbl_permission_tbl_permission1_idx` (`permission_id`),
  ADD KEY `fk_tbl_role_has_tbl_permission_tbl_role_idx` (`role_id`);

--
-- Indexes for table `tbl_schools`
--
ALTER TABLE `tbl_schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transport_booking`
--
ALTER TABLE `tbl_transport_booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_transport_booking_tbl_vehicles1_idx` (`vehicles_id`),
  ADD KEY `fk_tbl_transport_booking_users1_idx` (`users_id`);

--
-- Indexes for table `tbl_vehicles`
--
ALTER TABLE `tbl_vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_tbl_role1_idx` (`role_id`),
  ADD KEY `fk_users_tbl_programmes1_idx` (`programmes_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reset_student`
--
ALTER TABLE `reset_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_bed_space`
--
ALTER TABLE `tbl_bed_space`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_facility`
--
ALTER TABLE `tbl_facility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_facility_booking_public`
--
ALTER TABLE `tbl_facility_booking_public`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_facility_booking_student`
--
ALTER TABLE `tbl_facility_booking_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_permission`
--
ALTER TABLE `tbl_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_programmes`
--
ALTER TABLE `tbl_programmes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_schools`
--
ALTER TABLE `tbl_schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_transport_booking`
--
ALTER TABLE `tbl_transport_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_vehicles`
--
ALTER TABLE `tbl_vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD CONSTRAINT `fk_tbl_department_tbl_schools1` FOREIGN KEY (`schools_id`) REFERENCES `tbl_schools` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_facility_booking_public`
--
ALTER TABLE `tbl_facility_booking_public`
  ADD CONSTRAINT `fk_tbl_facility_booking_public_tbl_facility1` FOREIGN KEY (`facility_id`) REFERENCES `tbl_facility` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_facility_booking_public_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_facility_booking_student`
--
ALTER TABLE `tbl_facility_booking_student`
  ADD CONSTRAINT `fk_tbl_facility_booking_student_tbl_facility1` FOREIGN KEY (`facility_id`) REFERENCES `tbl_facility` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_facility_booking_student_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_programmes`
--
ALTER TABLE `tbl_programmes`
  ADD CONSTRAINT `fk_tbl_programmes_tbl_department1` FOREIGN KEY (`department_id`) REFERENCES `tbl_department` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_role_has_permission`
--
ALTER TABLE `tbl_role_has_permission`
  ADD CONSTRAINT `fk_tbl_role_has_tbl_permission_tbl_permission1` FOREIGN KEY (`permission_id`) REFERENCES `tbl_permission` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_role_has_tbl_permission_tbl_role` FOREIGN KEY (`role_id`) REFERENCES `tbl_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_transport_booking`
--
ALTER TABLE `tbl_transport_booking`
  ADD CONSTRAINT `fk_tbl_transport_booking_tbl_vehicles1` FOREIGN KEY (`vehicles_id`) REFERENCES `tbl_vehicles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_transport_booking_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_tbl_programmes1` FOREIGN KEY (`programmes_id`) REFERENCES `tbl_programmes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_tbl_role1` FOREIGN KEY (`role_id`) REFERENCES `tbl_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
