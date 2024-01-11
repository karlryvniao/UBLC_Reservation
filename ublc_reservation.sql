-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 11, 2024 at 01:40 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ublc_reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `department` varchar(225) NOT NULL,
  `pass_name` varchar(225) NOT NULL,
  `location` varchar(225) NOT NULL,
  `bus` varchar(225) NOT NULL,
  `date_departure` date NOT NULL,
  `time_departure` varchar(225) NOT NULL,
  `exp_arrival` date NOT NULL,
  `time_arrival` varchar(225) NOT NULL,
  `passengers` varchar(225) NOT NULL,
  `purpose` varchar(225) NOT NULL,
  `file_name` int(11) NOT NULL,
  `destination_name` varchar(225) NOT NULL,
  `availability` tinyint(1) DEFAULT 1,
  `status` int(255) NOT NULL,
  `userID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`id`, `name`, `department`, `pass_name`, `location`, `bus`, `date_departure`, `time_departure`, `exp_arrival`, `time_arrival`, `passengers`, `purpose`, `file_name`, `destination_name`, `availability`, `status`, `userID`) VALUES
(1, 'Marco', 'Citec', 'Zaldy', 'Within Batangas City', 'bus 2', '2023-11-25', '2:00pm', '2023-11-26', '2:00pm', '2', 'none', 0, 'sm', 1, 2, ''),
(3, 'sda', 'Test1', '', 'Outside Lipa City', 'bus_3', '2023-11-03', '19:57', '2023-12-02', '19:57', '2', 'Test', 0, 'asas', 1, 2, ''),
(39, 'asda', 'Choose...', '', 'Outside Batangas City', 'bus_3', '2023-12-06', '16:51', '2023-12-15', '16:51', '4', 'Test', 0, 'asda', 1, 0, ''),
(40, 'da', 'Choose...', '', 'Outside Batangas City', 'bus_3', '2023-11-04', '16:53', '2023-11-17', '15:42', '23', 'Test', 0, 'sadas', 1, 0, ''),
(41, 'dsa', 'Test', '', 'Outside Lipa City', 'bus_1', '2023-11-28', '17:11', '2023-11-29', '17:11', '2', 'Test', 0, 'sa', 1, 0, ''),
(42, 'SDA', 'Test', '', 'Choose...', 'bus_1', '2023-11-28', '17:12', '2023-11-29', '17:12', '3', 'Choose...', 0, 'sda', 1, 0, ''),
(43, 'dsa', 'Choose...', '', 'Choose...', '', '2023-11-28', '17:11', '2023-11-29', '17:11', '24', 'Test', 0, 'das', 1, 0, ''),
(44, 'as', 'Test', '', 'Choose...', 'bus_1', '2023-12-19', '11:36', '2023-12-19', '11:36', '2', 'Test1', 0, 'asda', 1, 0, ''),
(45, 'test21', 'Test', '', 'Within Batangas City', 'bus_3, bus_4', '2023-12-30', '12:18', '2023-12-30', '12:18', '4', 'Test', 0, 'sda', 1, 0, ''),
(46, 'dsa', 'Test1', '', 'Outside Batangas City', 'bus_2, bus_3', '2023-12-19', '12:40', '2023-12-14', '12:41', '2', 'Test1', 0, 'sda', 1, 0, ''),
(47, 'asd', 'Test', '', 'Within Batangas City', 'bus_2, bus_4', '2023-12-20', '09:37', '2023-12-21', '09:37', '2', 'Test', 0, 'dsada', 1, 2, ''),
(48, 'sa', 'Test', '', 'Outside Batangas City', 'bus_2', '2023-12-22', '22:18', '2023-12-23', '10:18', '2', 'Test', 0, 'asd', 1, 2, ''),
(49, 'sd', 'Test', '', 'Within Batangas City', '', '2023-12-22', '12:26', '2023-12-23', '12:26', '2', 'Test', 0, 'sd', 1, 0, ''),
(50, 'dsa', 'Choose...', '', 'Within Batangas City', '', '2023-12-22', '12:03', '2023-12-23', '12:04', '2', 'Test', 0, 'sda', 1, 0, ''),
(51, 'asda', 'Test', '', 'Within Batangas City', '', '2023-12-22', '12:30', '2023-12-23', '12:30', '2', 'Choose...', 0, 's', 1, 1, ''),
(52, 'sda', 'Test1', '', 'Within Batangas City', 'bus_1', '2023-12-27', '21:18', '2023-12-28', '21:18', '3', 'Test', 0, 'sda', 1, 0, ''),
(53, 'sda', 'Test', '', 'Within Batangas City', 'bus_1, bus_2', '2023-12-27', '21:38', '2023-12-28', '21:38', '2', 'Choose...', 0, 'asd', 1, 0, ''),
(54, 'dsa', 'Test', '', 'Outside Batangas City', 'bus_1, bus_2', '2023-12-27', '21:40', '2023-12-28', '21:40', '23', 'Test', 0, 'dsa', 1, 2, ''),
(55, 'sd', 'Test', '', 'Choose...', 'bus_1', '2023-12-29', '09:38', '2023-12-30', '09:38', '2', 'Test', 0, 'sda', 1, 1, ''),
(56, 'marco', 'Test', '', 'Outside Batangas City', 'bus_1, bus_2', '2023-12-29', '09:58', '2023-12-31', '09:58', '2', 'Test', 0, 'test', 1, 2, ''),
(100, 'Jhonas', 'CITEC', 'JHONAS', 'Example Location', 'BUS222', '2024-01-09', '2:00pmsadsaddsda', '2024-01-23', 'eqweqweqweqw', 'eqweqweq', 'eqweqweqweqw', 12312, 'eqweqwewqeqwe', 1, 123123, 'qweqw'),
(1020, 'Jhonas', 'CITEC', 'JHONAS', 'Example Location', 'BUS222', '2024-01-09', '2:00pmsadsaddsda', '2024-01-23', 'eqweqweqweqw', 'eqweqweq', 'eqweqweqweqw', 12312, 'eqweqwewqeqwe', 1, 123123, 'qweqw');

-- --------------------------------------------------------

--
-- Table structure for table `location_area_types`
--

CREATE TABLE `location_area_types` (
  `id` int(11) NOT NULL,
  `label` varchar(100) DEFAULT NULL,
  `description` text DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location_area_types`
--

INSERT INTO `location_area_types` (`id`, `label`, `description`) VALUES
(1, 'Within Batangas City', ''),
(2, 'Outside Batangas City', ''),
(3, 'Inter Campus', '');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_status`
--

CREATE TABLE `reservation_status` (
  `status_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reserved_vehicles`
--

CREATE TABLE `reserved_vehicles` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reserved_vehicles`
--

INSERT INTO `reserved_vehicles` (`id`, `reservation_id`, `vehicle_id`) VALUES
(11, 8, 2),
(12, 8, 3),
(13, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `pass_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `date_departure` date NOT NULL,
  `time_departure` varchar(255) NOT NULL,
  `exp_arrival` date NOT NULL,
  `time_arrival` varchar(255) NOT NULL,
  `passengers` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `file_name` int(11) NOT NULL,
  `destination_name` varchar(255) NOT NULL,
  `availability` tinyint(4) DEFAULT 1,
  `status` int(11) NOT NULL,
  `userId` varchar(255) NOT NULL,
  `ticket` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service2`
--

CREATE TABLE `service2` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `department` varchar(225) NOT NULL,
  `pass_name` varchar(225) NOT NULL,
  `location` varchar(225) NOT NULL,
  `service` varchar(225) NOT NULL,
  `date_departure` date NOT NULL,
  `time_departure` varchar(225) NOT NULL,
  `exp_arrival` date NOT NULL,
  `time_arrival` varchar(225) NOT NULL,
  `passengers` varchar(225) NOT NULL,
  `purpose` varchar(225) NOT NULL,
  `file_name` int(11) NOT NULL,
  `destination_name` varchar(225) NOT NULL,
  `availability` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service2`
--

INSERT INTO `service2` (`id`, `name`, `department`, `pass_name`, `location`, `service`, `date_departure`, `time_departure`, `exp_arrival`, `time_arrival`, `passengers`, `purpose`, `file_name`, `destination_name`, `availability`) VALUES
(1, 'karl', 'Test', '', 'Within Batangas City', 'service_2, service_5', '2023-12-18', '17:34', '2023-12-19', '17:34', '2', 'Test', 0, 'asda', 1),
(2, 'sda', 'Test', '', 'Within Batangas City', 'service_1, service_2', '2023-12-27', '12:40', '2023-12-28', '12:40', '2', 'Test', 0, 'sda', 1),
(4, 'sda', 'Test1', '', 'Within Batangas City', 'service_1, service_2', '2023-12-28', '21:09', '2023-12-29', '21:09', '3', 'Test1', 0, 'sda', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ublc_department`
--

CREATE TABLE `ublc_department` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ublc_department`
--

INSERT INTO `ublc_department` (`id`, `name`, `description`) VALUES
(1, 'CITEC', ''),
(2, 'CENAR', ''),
(3, 'CEAS', ''),
(4, 'CEAS', ''),
(5, 'CBI', ''),
(6, 'CMT', ''),
(7, 'Others', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `name`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'admin', 'admin'),
(7, 'admin', 'qwerty123', 'admin', ''),
(11, 'user', 'user123', 'user', 'Test user'),
(13, 'test', 'sdadas', 'user', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `user_reservation_vehicle`
--

CREATE TABLE `user_reservation_vehicle` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `reservation_date` datetime NOT NULL DEFAULT current_timestamp(),
  `arrival` datetime NOT NULL,
  `departure` datetime NOT NULL,
  `status` enum('pending','rejected','approved','cancelled') DEFAULT 'pending',
  `department_id` int(11) NOT NULL,
  `other_department` varchar(255) DEFAULT NULL,
  `no_passengers` int(11) DEFAULT 0,
  `purpose_description` text DEFAULT '',
  `location` varchar(512) DEFAULT NULL,
  `location_area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_reservation_vehicle`
--

INSERT INTO `user_reservation_vehicle` (`id`, `user_id`, `title`, `reservation_date`, `arrival`, `departure`, `status`, `department_id`, `other_department`, `no_passengers`, `purpose_description`, `location`, `location_area`) VALUES
(8, 11, 'Hiking', '2024-01-10 13:46:26', '2024-01-11 15:00:00', '2024-01-10 07:00:00', 'pending', 1, NULL, 12, 'We are going to hike!', NULL, 1),
(9, 11, 'Google Devfest ', '2024-01-10 14:11:33', '2024-01-22 19:00:00', '2024-01-22 10:00:00', 'pending', 7, NULL, 18, 'Attend Google Devfest', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_reservation_vehicle_passenger`
--

CREATE TABLE `user_reservation_vehicle_passenger` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `reservation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `max_capacity` int(11) DEFAULT 0,
  `img` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`id`, `name`, `max_capacity`, `img`) VALUES
(1, 'Vehicle 1', 25, ''),
(2, 'Vehicle 2', 10, ''),
(3, 'Vehicle 3', 30, ''),
(4, 'Vehicle 4', 15, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location_area_types`
--
ALTER TABLE `location_area_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation_status`
--
ALTER TABLE `reservation_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `reserved_vehicles`
--
ALTER TABLE `reserved_vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reserved_vehicles_reservation_id` (`reservation_id`),
  ADD KEY `fk_reserved_vehicles_vehicle_id` (`vehicle_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `service2`
--
ALTER TABLE `service2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ublc_department`
--
ALTER TABLE `ublc_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_reservation_vehicle`
--
ALTER TABLE `user_reservation_vehicle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_reservation_vehicle_user_id` (`user_id`),
  ADD KEY `fk_user_reservation_vehicle_department_id` (`department_id`),
  ADD KEY `fk_user_reservation_location_area_type_id` (`location_area`);

--
-- Indexes for table `user_reservation_vehicle_passenger`
--
ALTER TABLE `user_reservation_vehicle_passenger`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_reservation_vehicle_passenger_reservation_id` (`reservation_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1021;

--
-- AUTO_INCREMENT for table `location_area_types`
--
ALTER TABLE `location_area_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reservation_status`
--
ALTER TABLE `reservation_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reserved_vehicles`
--
ALTER TABLE `reserved_vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service2`
--
ALTER TABLE `service2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ublc_department`
--
ALTER TABLE `ublc_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_reservation_vehicle`
--
ALTER TABLE `user_reservation_vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_reservation_vehicle_passenger`
--
ALTER TABLE `user_reservation_vehicle_passenger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reserved_vehicles`
--
ALTER TABLE `reserved_vehicles`
  ADD CONSTRAINT `fk_reserved_vehicles_reservation_id` FOREIGN KEY (`reservation_id`) REFERENCES `user_reservation_vehicle` (`id`),
  ADD CONSTRAINT `fk_reserved_vehicles_vehicle_id` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`id`);

--
-- Constraints for table `user_reservation_vehicle`
--
ALTER TABLE `user_reservation_vehicle`
  ADD CONSTRAINT `fk_user_reservation_location_area_type_id` FOREIGN KEY (`location_area`) REFERENCES `location_area_types` (`id`),
  ADD CONSTRAINT `fk_user_reservation_vehicle_department_id` FOREIGN KEY (`department_id`) REFERENCES `ublc_department` (`id`),
  ADD CONSTRAINT `fk_user_reservation_vehicle_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_reservation_vehicle_passenger`
--
ALTER TABLE `user_reservation_vehicle_passenger`
  ADD CONSTRAINT `fk_user_reservation_vehicle_passenger_reservation_id` FOREIGN KEY (`reservation_id`) REFERENCES `user_reservation_vehicle_passenger` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
