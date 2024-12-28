-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2024 at 01:12 AM
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
-- Database: `accounts`
--

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

CREATE TABLE `credentials` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `bday` datetime NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`id`, `name`, `email`, `bday`, `password`, `admin`) VALUES
(1, 'marcus', 'marcus@gmail.com', '2024-12-03 00:00:00', '$2y$10$Y4tecuonH9iCnZ5b/4o50.CIDKVLWrR52hiQB5eP6LDFZcyv1OA16', 1),
(12, 'Amir', 'amir@gmail.com', '2024-12-17 00:00:00', '$2y$10$j5y9a/fjvplFbJccAbnpMe0HwNFU8685RygdgiZT2BApHyjtRn8nO', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `service` varchar(50) NOT NULL,
  `price` int(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `contact_num` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mode` varchar(10) NOT NULL,
  `acq_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `name`, `service`, `price`, `address`, `contact_num`, `email`, `mode`, `acq_date`) VALUES
(14, 'marcus', 'Cleaning', 500, 'Empire Heights, Eckington Lane, The Cotton Yard, New Cross Gate, London Borough of Lewisham, London, Greater London, England, SE14 5FP, United Kingdom', '639669051263', 'maczaa@gmail.com', 'Credit', '2024-12-19'),
(15, 'marcus', 'Plumbing', 1000, 'Lyly House, Burge Street, Bermondsey Village, Walworth, London Borough of Southwark, London, Greater London, England, SE1 4EW, United Kingdom', '639669051263', 'marcus@gmail.com', 'Credit', '2024-12-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `credentials`
--
ALTER TABLE `credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
