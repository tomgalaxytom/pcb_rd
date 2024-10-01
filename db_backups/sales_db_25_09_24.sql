-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2024 at 09:41 AM
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

  `id` int(11) NOT NULL,
  `parameter_type` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stp_parameters`
--

INSERT INTO `stp_parameters` (`id`, `parameter_type`, `date`, `value`) VALUES
(1, 'PH', '2024-05-01', '30'),
(1, 'PH', '2024-05-02', '48'),
(1, 'PH', '2024-05-03', '35'),
(1, 'PH', '2024-05-04', '50'),

(1, 'BOD', '2024-05-01', '50'),
(1, 'BOD', '2024-05-02', '55'),
(1, 'BOD', '2024-05-03', '60'),
(1, 'BOD', '2024-05-04', '65'),

(1, 'COD', '2024-05-01', '30'),
(1, 'COD', '2024-05-02', '35'),
(1, 'COD', '2024-05-03', '40'),
(1, 'COD', '2024-05-04', '45'),

(1, 'TSS', '2024-05-01', '30'),
(1, 'TSS', '2024-05-02', '35'),
(1, 'TSS', '2024-05-03', '40'),
(1, 'TSS', '2024-05-04', '45'),

(2, 'PH', '2024-05-01', '30'),
(2, 'PH', '2024-05-02', '35'),
(2, 'PH', '2024-05-03', '40'),
(2, 'PH', '2024-05-04', '45'),

(2, 'BOD', '2024-05-01', '50'),
(2, 'BOD', '2024-05-02', '55'),
(2, 'BOD', '2024-05-03', '60'),
(2, 'BOD', '2024-05-04', '65'),

(2, 'COD', '2024-05-01', '30'),
(2, 'COD', '2024-05-02', '35'),
(2, 'COD', '2024-05-03', '40'),
(2, 'COD', '2024-05-04', '45'),

(2, 'TSS', '2024-05-01', '30'),
(2, 'TSS', '2024-05-02', '35'),
(2, 'TSS', '2024-05-03', '40'),
(2, 'TSS', '2024-05-04', '45'),

(3, 'PH', '2024-05-01', '30'),
(3, 'PH', '2024-05-02', '35'),
(3, 'PH', '2024-05-03', '40'),
(3, 'PH', '2024-05-04', '45'),

(3, 'BOD', '2024-05-01', '50'),
(3, 'BOD', '2024-05-02', '55'),
(3, 'BOD', '2024-05-03', '60'),
(3, 'BOD', '2024-05-04', '65'),

(3, 'COD', '2024-05-01', '30'),
(3, 'COD', '2024-05-02', '35'),
(3, 'COD', '2024-05-03', '40'),
(3, 'COD', '2024-05-04', '45'),

(3, 'TSS', '2024-05-01', '30'),
(3, 'TSS', '2024-05-02', '35'),
(3, 'TSS', '2024-05-03', '40'),
(3, 'TSS', '2024-05-04', '45'),

(4, 'PH', '2024-05-01', '30'),
(4, 'PH', '2024-05-02', '35'),
(4, 'PH', '2024-05-03', '40'),
(4, 'PH', '2024-05-04', '45'),

(4, 'BOD', '2024-05-01', '50'),
(4, 'BOD', '2024-05-02', '55'),
(4, 'BOD', '2024-05-03', '60'),
(4, 'BOD', '2024-05-04', '65'),

(4, 'COD', '2024-05-01', '30'),
(4, 'COD', '2024-05-02', '35'),
(4, 'COD', '2024-05-03', '40'),
(4, 'COD', '2024-05-04', '45'),

(4, 'TSS', '2024-05-01', '30'),
(4, 'TSS', '2024-05-02', '35'),
(4, 'TSS', '2024-05-03', '40'),
(4, 'TSS', '2024-05-04', '45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stp_data`
--
ALTER TABLE `stp_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stp_data`
--
ALTER TABLE `stp_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
