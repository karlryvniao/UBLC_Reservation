-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2023 at 05:20 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

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
  `availability` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`id`, `name`, `department`, `pass_name`, `location`, `bus`, `date_departure`, `time_departure`, `exp_arrival`, `time_arrival`, `passengers`, `purpose`, `file_name`, `destination_name`, `availability`) VALUES
(1, 'Marco', 'Citec', 'Zaldy', 'Within Batangas City', 'bus 2', '2023-11-25', '2:00pm', '2023-11-26', '2:00pm', '2', 'none', 0, 'sm', 1),
(3, 'sda', 'Test1', '', 'Outside Lipa City', 'bus_3', '2023-11-03', '19:57', '2023-12-02', '19:57', '2', 'Test', 0, 'asas', 1),
(39, 'asda', 'Choose...', '', 'Outside Batangas City', 'bus_3', '2023-12-06', '16:51', '2023-12-15', '16:51', '4', 'Test', 0, 'asda', 1),
(40, 'da', 'Choose...', '', 'Outside Batangas City', 'bus_3', '2023-11-04', '16:53', '2023-11-17', '15:42', '23', 'Test', 0, 'sadas', 1),
(41, 'dsa', 'Test', '', 'Outside Lipa City', 'bus_1', '2023-11-28', '17:11', '2023-11-29', '17:11', '2', 'Test', 0, 'sa', 1),
(42, 'SDA', 'Test', '', 'Choose...', 'bus_1', '2023-11-28', '17:12', '2023-11-29', '17:12', '3', 'Choose...', 0, 'sda', 1),
(43, 'dsa', 'Choose...', '', 'Choose...', '', '2023-11-28', '17:11', '2023-11-29', '17:11', '24', 'Test', 0, 'das', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reservation_status`
--

CREATE TABLE `reservation_status` (
  `status_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation_status`
--
ALTER TABLE `reservation_status`
  ADD PRIMARY KEY (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `reservation_status`
--
ALTER TABLE `reservation_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
