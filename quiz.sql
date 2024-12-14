-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2024 at 06:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `q_id` int(11) NOT NULL,
  `questions` varchar(500) DEFAULT NULL,
  `options` varchar(200) DEFAULT NULL,
  `answer` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`q_id`, `questions`, `options`, `answer`) VALUES
(1, 'All variables in PHP start with which symbol?', '$,),!', '$'),
(2, 'What is the correct way to end a PHP statement?', '.,%,;', ';'),
(3, 'When using the POST method, variables are displayed in the URL:\n', 'False,True', 'False'),
(4, 'How do you create a cookie in PHP?', 'makecookie,setcookie,createcookie', 'setcookie'),
(5, 'The if statement is used to execute some code only if a specified condition is true', 'False,True', 'True');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_answers`
--

CREATE TABLE `quiz_answers` (
  `id` int(11) NOT NULL,
  `user` varchar(100) DEFAULT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `question` int(2) DEFAULT NULL,
  `answer` varchar(100) DEFAULT NULL,
  `done_on` datetime DEFAULT NULL,
  `is_correct` enum('yes','no') DEFAULT NULL,
  `is_edit` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_answers`
--

INSERT INTO `quiz_answers` (`id`, `user`, `user_id`, `question`, `answer`, `done_on`, `is_correct`, `is_edit`) VALUES
(1, 'remya', 'da034d2ba6f19257', 1, '$', '2024-12-14 21:15:16', 'yes', 0),
(2, 'remya', 'da034d2ba6f19257', 2, '$', '2024-12-14 21:15:16', 'no', 0),
(3, 'remya', 'da034d2ba6f19257', 3, 'True', '2024-12-14 21:15:27', 'no', 0),
(4, 'remya', 'da034d2ba6f19257', 4, ' setcookie()', '2024-12-14 21:15:35', 'no', 0),
(5, 'remya', 'da034d2ba6f19257', 5, 'True', '2024-12-14 21:15:41', 'yes', 0),
(6, 'test', '848b853c7f7072a4', 1, '$', '2024-12-14 21:25:36', 'yes', 0),
(7, 'test', '848b853c7f7072a4', 2, ';', '2024-12-14 21:25:38', 'yes', 0),
(8, 'test', '848b853c7f7072a4', 3, 'False', '2024-12-14 21:25:44', 'yes', 0),
(9, 'test', '848b853c7f7072a4', 4, 'createcookie', '2024-12-14 21:25:47', 'no', 0),
(10, 'test', '848b853c7f7072a4', 5, 'True', '2024-12-14 21:25:51', 'yes', 0),
(11, 'sreenu', 'df7062b74cb21203', 1, '$', '2024-12-14 22:57:24', 'yes', 1),
(12, 'sreenu', 'df7062b74cb21203', 2, ';', '2024-12-14 22:57:27', 'yes', 1),
(13, 'sreenu', 'df7062b74cb21203', 3, 'False', '2024-12-14 22:57:31', 'yes', 1),
(14, 'sreenu', 'df7062b74cb21203', 4, 'createcookie', '2024-12-14 22:57:34', 'no', 1),
(15, 'sreenu', 'df7062b74cb21203', 5, 'True', '2024-12-14 22:57:37', 'yes', 1),
(16, 'ert', '854eab7c801a1cf8', 1, '$', '2024-12-14 22:59:38', 'yes', 0),
(17, 'ert', '854eab7c801a1cf8', 2, ';', '2024-12-14 22:59:41', 'yes', 0),
(18, 'ert', '854eab7c801a1cf8', 3, 'False', '2024-12-14 22:59:44', 'yes', 0),
(19, 'ert', '854eab7c801a1cf8', 4, ' setcookie()', '2024-12-14 22:59:47', 'no', 0),
(20, 'ert', '854eab7c801a1cf8', 5, 'True', '2024-12-14 22:59:51', 'yes', 0),
(21, 'nidhi', '19604a8756b01523', 1, '$', '2024-12-14 23:01:39', 'yes', 0),
(22, 'nidhi', '19604a8756b01523', 2, ';', '2024-12-14 23:01:42', 'yes', 0),
(23, 'nidhi', '19604a8756b01523', 3, 'False', '2024-12-14 23:01:46', 'yes', 0),
(24, 'nidhi', '19604a8756b01523', 4, ' setcookie', '2024-12-14 23:01:49', 'no', 0),
(25, 'nidhi', '19604a8756b01523', 5, 'True', '2024-12-14 23:01:54', 'yes', 0),
(26, 'sree', '36eec794cf157929', 1, '$', '2024-12-14 23:09:32', 'yes', 0),
(27, 'sree', '36eec794cf157929', 2, ';', '2024-12-14 23:09:38', 'yes', 0),
(28, 'sree', '36eec794cf157929', 3, 'False', '2024-12-14 23:09:41', 'yes', 0),
(29, 'sree', '36eec794cf157929', 4, 'setcookie', '2024-12-14 23:09:45', 'yes', 0),
(30, 'sree', '36eec794cf157929', 5, 'True', '2024-12-14 23:09:48', 'yes', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`q_id`);

--
-- Indexes for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `q_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
