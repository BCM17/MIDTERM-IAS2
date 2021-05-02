-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2021 at 04:34 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `authentication`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(255) NOT NULL,
  `account_user` varchar(255) NOT NULL,
  `account_pass` varchar(255) NOT NULL,
  `account_email` varchar(100) NOT NULL,
  `account_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `account_user`, `account_pass`, `account_email`, `account_created`) VALUES
(29, 'ADMIN', '$2y$10$87yaUEpYjxEhOVJS0z37ceer9Ezo2L3z9ZBptAR6XxWsjJW7VkZXC', 'bryanclydemalvar3@gmail.com', '2021-04-29 11:05:51'),
(30, 'Bobby', '$2y$10$HRvCe9U1oy9c1CYsinM/c.gX3SE2EI9oA6jSlEjKeadGRkjRfY12e', 'bobbymalvar@yahoo.com', '2021-04-29 11:06:30'),
(31, 'Maricel', '$2y$10$MfFUjp9sKB/BBOpSIkHgsOYDQ2tBLzM50LctZWUHiDhGuQboiJPrO', 'maricel@yahoo.com', '2021-04-29 11:16:41');

-- --------------------------------------------------------

--
-- Table structure for table `code`
--

CREATE TABLE `code` (
  `code_id` int(255) NOT NULL,
  `account_user` varchar(255) NOT NULL,
  `code_num` int(255) NOT NULL,
  `code_time_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `code_expiration` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `code`
--

INSERT INTO `code` (`code_id`, `account_user`, `code_num`, `code_time_created`, `code_expiration`) VALUES
(4, 'ADMIN', 868305, '2021-04-29 11:06:58', '2021-04-29 19:11:58'),
(5, 'ADMIN', 410358, '2021-04-29 11:13:32', '2021-04-29 19:18:32'),
(6, 'Bobby', 82113, '2021-04-29 11:15:01', '2021-04-29 19:20:01'),
(7, 'Bobby', 161432, '2021-04-29 11:15:08', '2021-04-29 19:20:08'),
(8, 'Bobby', 834171, '2021-04-29 11:15:23', '2021-04-29 19:20:23'),
(9, 'ADMIN', 882174, '2021-04-29 11:24:42', '2021-04-29 19:29:42'),
(10, 'ADMIN', 818362, '2021-04-29 12:08:26', '2021-04-29 20:13:26'),
(11, 'ADMIN', 198443, '2021-04-29 12:14:43', '2021-04-29 20:19:43'),
(12, 'ADMIN', 729180, '2021-04-29 12:15:48', '2021-04-29 20:20:48'),
(13, 'ADMIN', 857858, '2021-04-29 12:24:49', '2021-04-29 20:29:49'),
(14, 'Bobby', 563780, '2021-04-29 12:26:01', '2021-04-29 20:31:01'),
(15, 'ADMIN', 20275, '2021-04-29 12:29:05', '2021-04-29 20:34:05');

-- --------------------------------------------------------

--
-- Table structure for table `event_log`
--

CREATE TABLE `event_log` (
  `event_id` int(255) NOT NULL,
  `account_user` varchar(255) NOT NULL,
  `event_action` varchar(255) NOT NULL,
  `event_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_log`
--

INSERT INTO `event_log` (`event_id`, `account_user`, `event_action`, `event_time`) VALUES
(2, 'ADMIN', 'Log-in', '2021-04-29 11:06:58'),
(3, 'ADMIN', 'Logged-in', '2021-04-29 11:07:12'),
(4, 'ADMIN', 'Password Changed', '2021-04-29 11:07:58'),
(5, 'ADMIN', 'Log-out', '2021-04-29 11:08:15'),
(6, 'ADMIN', 'Forgot Password', '2021-04-29 11:08:22'),
(7, 'ADMIN', 'Password Changed', '2021-04-29 11:08:31'),
(8, 'ADMIN', 'Forgot Password', '2021-04-29 11:12:32'),
(9, 'ADMIN', 'Password Changed', '2021-04-29 11:12:46'),
(10, 'ADMIN', 'Log-in', '2021-04-29 11:13:32'),
(11, 'ADMIN', 'Logged-in', '2021-04-29 11:14:04'),
(12, 'ADMIN', 'Log-out', '2021-04-29 11:14:50'),
(13, 'Bobby', 'Log-in', '2021-04-29 11:15:01'),
(14, 'Bobby', 'Resend Code', '2021-04-29 11:15:08'),
(15, 'Bobby', 'Resend Code', '2021-04-29 11:15:23'),
(16, 'Bobby', 'Logged-in', '2021-04-29 11:15:38'),
(17, 'Bobby', 'Log-out', '2021-04-29 11:16:18'),
(18, 'ADMIN', 'Log-in', '2021-04-29 11:24:42'),
(19, 'ADMIN', 'Logged-in', '2021-04-29 11:24:48'),
(20, 'ADMIN', 'Log-out', '2021-04-29 11:25:34'),
(21, 'ADMIN', 'Log-in', '2021-04-29 12:08:26'),
(22, 'ADMIN', 'Forgot Password', '2021-04-29 12:11:17'),
(23, 'ADMIN', 'Password Changed', '2021-04-29 12:12:14'),
(24, 'ADMIN', 'Log-in', '2021-04-29 12:14:44'),
(25, 'ADMIN', 'Resend Code', '2021-04-29 12:15:48'),
(26, 'ADMIN', 'Logged-in', '2021-04-29 12:16:57'),
(27, 'ADMIN', 'Password Changed', '2021-04-29 12:20:28'),
(28, 'ADMIN', 'Log-out', '2021-04-29 12:24:03'),
(29, 'ADMIN', 'Log-in', '2021-04-29 12:24:49'),
(30, 'ADMIN', 'Logged-in', '2021-04-29 12:24:55'),
(31, 'ADMIN', 'Log-out', '2021-04-29 12:25:49'),
(32, 'Bobby', 'Log-in', '2021-04-29 12:26:01'),
(33, 'Bobby', 'Logged-in', '2021-04-29 12:26:16'),
(34, 'Bobby', 'Log-out', '2021-04-29 12:28:07'),
(35, 'ADMIN', 'Log-in', '2021-04-29 12:29:05'),
(36, 'ADMIN', 'Logged-in', '2021-04-29 12:29:09'),
(37, 'ADMIN', 'Log-out', '2021-04-29 12:29:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `code`
--
ALTER TABLE `code`
  ADD PRIMARY KEY (`code_id`);

--
-- Indexes for table `event_log`
--
ALTER TABLE `event_log`
  ADD PRIMARY KEY (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `code`
--
ALTER TABLE `code`
  MODIFY `code_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `event_log`
--
ALTER TABLE `event_log`
  MODIFY `event_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
