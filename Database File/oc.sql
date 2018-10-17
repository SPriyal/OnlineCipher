-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 17, 2018 at 05:36 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oc`
--

-- --------------------------------------------------------

--
-- Table structure for table `userhistory`
--

CREATE TABLE `userhistory` (
  `id` bigint(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `cipher` varchar(20) NOT NULL,
  `userstring` varchar(500) NOT NULL,
  `datetime` datetime NOT NULL,
  `cipherkey` varchar(300) NOT NULL,
  `encryptedtext` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(11) NOT NULL,
  `datecreated` datetime NOT NULL,
  `profilepic` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`id`, `name`, `email`, `password`, `datecreated`, `profilepic`) VALUES
(24, 'Priyal', 'shah.priyal@ymail.com', 'Priyal123', '2018-09-27 12:33:24', NULL),
(25, 'Priyalllll', 'a@a.com', 'Priyal123', '2018-09-27 12:39:26', NULL),
(26, 'Test', 'test@test.com', 'test123', '2018-10-16 11:10:36', NULL),
(27, 'Test1', 'test1@test.com', 'Test1123', '2018-10-16 11:12:41', NULL),
(28, 'Test3', 'test3@test.com', 'test3123', '2018-10-16 11:14:26', NULL),
(29, 'anu', 'aa@gmail.com', 'asdfghjk', '2018-10-16 13:15:18', NULL),
(31, 'Akhila', 'saikahila9@gmail.com', 'ganapathi9', '2018-10-16 14:00:04', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `userhistory`
--
ALTER TABLE `userhistory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `userhistory`
--
ALTER TABLE `userhistory`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
