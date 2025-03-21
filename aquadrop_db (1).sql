-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2025 at 02:00 PM
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
-- Database: `aquadrop_db`
--
CREATE DATABASE IF NOT EXISTS `aquadrop_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `aquadrop_db`;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `expense_id` int(11) NOT NULL AUTO_INCREMENT,
  `expenses_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `purpose` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`expense_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expense_id`, `expenses_id`, `date`, `purpose`, `amount`) VALUES
(1, 1, '2025-03-20 09:57:02', 'sdaegdasfwaf', 201.00),
(2, 2, '2026-03-20 09:57:08', 'Flat Tire', 1000.00),
(3, 3, '2025-03-20 09:57:11', 'Change Filter', 30000.00),
(4, 1, '2025-03-20 09:57:14', 'salary', 1000.00),
(5, 2, '2025-03-20 09:57:17', 'salary', 1000.00),
(6, 3, '2025-03-20 09:57:21', 'meryenda', 200.00),
(7, 1, '2025-03-20 09:57:23', 'sadwrffwa', 200.00),
(8, 2, '2025-03-20 09:57:26', 'adsadnnananw1212', 300.00),
(9, 1, '2025-03-20 10:00:55', 'safsdf', 300.00);

-- --------------------------------------------------------

--
-- Table structure for table `expense_type`
--

CREATE TABLE IF NOT EXISTS `expense_type` (
  `expenses_id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_name` varchar(255) NOT NULL,
  PRIMARY KEY (`expenses_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense_type`
--

INSERT INTO `expense_type` (`expenses_id`, `expense_name`) VALUES
(1, 'Salary'),
(2, 'Pump Filter'),
(3, 'Adding of Gallons');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `quantity` int(11) NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  `type_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `rider` varchar(255) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `name`, `contact_number`, `address`, `date`, `quantity`, `payment`, `type_id`, `status_id`, `rider`) VALUES
(1, 'Jonathan Garinga', '09327572991', 'awdawfdaw', '2025-03-20 13:54:27', 5, 420.69, 2, 4, 'Klent Sylwen Pobadora'),
(2, 'jonathan 2', '09123568974', 'qwadafgefa', '2025-03-20 10:31:29', 2, 0.00, 1, 4, 'Zachary Co Sam');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'rider');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `sales_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `quantity` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  PRIMARY KEY (`sales_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `name`, `date`, `quantity`, `type_id`, `payment`) VALUES
(1, 'exequiel fernando', '2025-03-19 08:45:47', 5, 1, 200.00),
(2, 'Jang Man Wol', '2025-03-18 13:15:26', 50, 2, 12300.00),
(3, 'dadasdwa', '2025-03-18 14:29:58', 20, 2, 13000.00),
(4, 'dasfdafrawf', '2025-03-19 14:30:13', 5, 2, 12345.00);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(255) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`) VALUES
(1, 'Pending'),
(2, 'Accepted'),
(3, 'Delivering'),
(4, 'Completed'),
(5, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `type_name`, `price`) VALUES
(1, 'Jug with Faucet 20 liters ₱ 25.00', 25.00),
(2, 'Round Gallon 20 liters ₱ 25.00', 25.00);

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE IF NOT EXISTS `userdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`id`, `userid`, `role_id`, `email`, `firstname`, `lastname`, `address`) VALUES
(2, 3, 1, 'athan@gmail.com', 'asd', 'asd', 'asd'),
(3, 1, 1, 'boompanes', 'boom', 'panes', 'boompanes'),
(6, 9, 2, 'mak.g@gmail.com', 'mak', 'g', 'IBABA st.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$7OtTiIZEX5hu8ADgAPxvIenTz3jztkFoWfUhXkMO35/lUfXigH8UW', '2025-03-12 14:55:41'),
(3, 'asd', '$2y$10$N1Id4yrcBBpDVtU6JjnnUuhpHsMHmknEeDTAEPGzgsKDTb/uBbPg2', '2025-03-12 15:56:57'),
(9, 'mak', '$2y$10$SEIux0RFfBeaLsTvWG8aUufo9fKq.SGhiGkKKF6van29s3hHEglFC', '2025-03-21 11:35:59');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
