-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2024 at 10:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sales_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `stp_data`
--

CREATE TABLE `stp_data` (
  `id` int(11) NOT NULL,
  `unitname` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stp_data`
--

INSERT INTO `stp_data` (`id`, `unitname`, `category`, `city`) VALUES
(1, 'Chennai STP', '50KLD', 'Chennai South'),
(2, 'Madurai NTP', '40KLD', 'Madurai North'),
(4, 'Trichy STP', '80KLD', 'Trichy South'),
(5, 'Salem NTP', '60KLD', 'Salem North'),
(6, 'Coimbatore NTP', '80KLD', 'Coimbatore North'),
(7, 'Tanjavur STP', '30KLD', 'Thanjavur South'),
(8, 'Chennai NTP', '55MLD', 'Chennai North');

-- --------------------------------------------------------

--
-- Table structure for table `stp_parameters`
--

CREATE TABLE `stp_parameters` (
  `param_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `parameter_type` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stp_parameters`
--

INSERT INTO `stp_parameters` (`param_id`, `id`, `parameter_type`, `date`, `value`) VALUES
(1, 1, 'PH', '2024-05-01', '30'),
(2, 1, 'PH', '2024-05-02', '48'),
(3, 1, 'PH', '2024-05-03', '35'),
(4, 1, 'PH', '2024-05-04', '50'),
(5, 1, 'BOD', '2024-05-01', '20'),
(6, 1, 'BOD', '2024-05-02', '80'),
(7, 1, 'BOD', '2024-05-03', '36'),
(8, 1, 'BOD', '2024-05-04', '75'),
(9, 1, 'COD', '2024-05-01', '30'),
(10, 1, 'COD', '2024-05-02', '35'),
(11, 1, 'COD', '2024-05-03', '40'),
(12, 1, 'COD', '2024-05-04', '45'),
(13, 1, 'TSS', '2024-05-01', '30'),
(14, 1, 'TSS', '2024-05-02', '35'),
(15, 1, 'TSS', '2024-05-03', '40'),
(16, 1, 'TSS', '2024-05-04', '45'),
(17, 2, 'PH', '2024-05-01', '30'),
(18, 2, 'PH', '2024-05-02', '35'),
(19, 2, 'PH', '2024-05-03', '40'),
(20, 2, 'PH', '2024-05-04', '45'),
(21, 2, 'BOD', '2024-05-01', '50'),
(22, 2, 'BOD', '2024-05-02', '55'),
(23, 2, 'BOD', '2024-05-03', '60'),
(24, 2, 'BOD', '2024-05-04', '65'),
(25, 2, 'COD', '2024-05-01', '30'),
(26, 2, 'COD', '2024-05-02', '35'),
(27, 2, 'COD', '2024-05-03', '40'),
(28, 2, 'COD', '2024-05-04', '45'),
(29, 2, 'TSS', '2024-05-01', '30'),
(30, 2, 'TSS', '2024-05-02', '35'),
(31, 2, 'TSS', '2024-05-03', '40'),
(32, 2, 'TSS', '2024-05-04', '45'),
(33, 3, 'PH', '2024-05-01', '30'),
(34, 3, 'PH', '2024-05-02', '35'),
(35, 3, 'PH', '2024-05-03', '40'),
(36, 3, 'PH', '2024-05-04', '45'),
(37, 3, 'BOD', '2024-05-01', '50'),
(38, 3, 'BOD', '2024-05-02', '55'),
(39, 3, 'BOD', '2024-05-03', '60'),
(40, 3, 'BOD', '2024-05-04', '65'),
(41, 3, 'COD', '2024-05-01', '30'),
(42, 3, 'COD', '2024-05-02', '35'),
(43, 3, 'COD', '2024-05-03', '40'),
(44, 3, 'COD', '2024-05-04', '45'),
(45, 3, 'TSS', '2024-05-01', '30'),
(46, 3, 'TSS', '2024-05-02', '35'),
(47, 3, 'TSS', '2024-05-03', '40'),
(48, 3, 'TSS', '2024-05-04', '45'),
(49, 4, 'PH', '2024-05-01', '30'),
(50, 4, 'PH', '2024-05-02', '35'),
(51, 4, 'PH', '2024-05-03', '40'),
(52, 4, 'PH', '2024-05-04', '45'),
(53, 4, 'BOD', '2024-05-01', '50'),
(54, 4, 'BOD', '2024-05-02', '55'),
(55, 4, 'BOD', '2024-05-03', '60'),
(56, 4, 'BOD', '2024-05-04', '65'),
(57, 4, 'COD', '2024-05-01', '30'),
(58, 4, 'COD', '2024-05-02', '35'),
(59, 4, 'COD', '2024-05-03', '40'),
(60, 4, 'COD', '2024-05-04', '45'),
(61, 4, 'TSS', '2024-05-01', '30'),
(62, 4, 'TSS', '2024-05-02', '35'),
(63, 4, 'TSS', '2024-05-03', '40'),
(64, 4, 'TSS', '2024-05-04', '45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stp_data`
--
ALTER TABLE `stp_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stp_parameters`
--
ALTER TABLE `stp_parameters`
  ADD PRIMARY KEY (`param_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stp_data`
--
ALTER TABLE `stp_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stp_parameters`
--
ALTER TABLE `stp_parameters`
  MODIFY `param_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
