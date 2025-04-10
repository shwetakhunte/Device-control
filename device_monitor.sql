-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2025 at 03:24 PM
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
-- Database: `device_monitor`
--

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `hostname` varchar(255) DEFAULT NULL,
  `serial` varchar(255) DEFAULT NULL,
  `ping_status` tinyint(1) DEFAULT NULL,
  `ping_output` text DEFAULT NULL,
  `dc_network` varchar(255) DEFAULT NULL,
  `asn_network` varchar(255) DEFAULT NULL,
  `asn_asn_route` varchar(255) DEFAULT NULL,
  `location_latitude` varchar(255) DEFAULT NULL,
  `location_longitude` varchar(255) DEFAULT NULL,
  `rir` varchar(20) DEFAULT NULL,
  `company_network` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`id`, `ip_address`, `hostname`, `serial`, `ping_status`, `ping_output`, `dc_network`, `asn_network`, `asn_asn_route`, `location_latitude`, `location_longitude`, `rir`, `company_network`) VALUES
(1, '192.168.0.101', 'server-01.local', 'SN-001', 1, '4 packets transmitted, 4 received, 0% packet loss', 'DC1-NET', 'AS12345', 'AS12345 192.168.0.0/24', '28.6448', '77.2167', NULL, NULL),
(2, '192.168.0.102', 'server-02.local', 'SN-002', 0, 'Request timeout for icmp_seq 1\nRequest timeout for icmp_seq 2\n', 'DC1-NET', 'AS12345', 'AS12345 192.168.0.0/24', '19.0760', '72.8777', NULL, NULL),
(3, '10.0.0.55', 'edge-router-1', 'SN-003', 1, '4 packets transmitted, 4 received, 0% packet loss', 'DC2-NET', 'AS45678', 'AS45678 10.0.0.0/24', '12.9716', '77.5946', NULL, NULL),
(5, '3.5.140.2', NULL, NULL, NULL, NULL, '3.5.140.0/22', '16509', '3.5.140.0/24', '37.566', '126.9784', NULL, NULL),
(6, '107.174.138.172', NULL, NULL, NULL, NULL, '107.174.138.0/24', '36352', '107.174.138.0/24', '42.88645', '-78.87837', 'ARIN', '107.172.0.0 - 107.175.255.255'),
(7, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '8.8.8.8', NULL, NULL, NULL, NULL, '8.8.8.0 - 8.8.8.255', '15169', '8.8.8.0/24', '37.36883', '-122.03635', NULL, NULL),
(11, '1.1.1.1', NULL, NULL, NULL, NULL, NULL, '13335', '1.1.1.0/24', '-27.46794', '153.02809', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1744265398),
('m250410_060820_create_device_table', 1744265423),
('m250410_083636_add_device_api_fields', 1744274958);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ip_address` (`ip_address`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `device`
--
ALTER TABLE `device`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
