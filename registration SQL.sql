-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 11, 2020 at 08:34 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `event_id` int(255) NOT NULL,
  `comment_id` int(255) NOT NULL,
  `comment` text NOT NULL,
  `rating` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`event_id`, `comment_id`, `comment`, `rating`) VALUES
(15, 1, 'Yeet', 4),
(18, 3, 'Yeet', 0),
(18, 4, 'Duma', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--
-- Error reading structure for table registration.comments: #1932 - Table 'registration.comments' doesn't exist in engine
-- Error reading data for table registration.comments: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `registration`.`comments`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(100) NOT NULL,
  `username` varchar(200) NOT NULL,
  `event_name` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `username`, `event_name`, `date`, `time`, `location`, `description`) VALUES
(15, 'deenie', 'Birthday', '2020-10-28', '14:27', 'Brisbane', 'My birthday'),
(16, 'deenie', 'Meeting', '2020-10-23', '19:27', 'West end', 'meeting'),
(17, 'jeff', 'Birthday', '2020-10-28', '14:33', 'West end', 'meeting tings'),
(18, 'naraen', 'Meeting', '2020-10-22', '16:51', 'Brisbane', 'meeting tings\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(8, 'deenie', '1234@gmail.com', '$2y$10$Xh5JMTmiV.jcFFO21RmMgutFuVJAOVCcf6GZ6ifa2n6xfuE6Fywfe'),
(9, 'jeff', 'jeff@gmail.com', '$2y$10$iJXZ6MR8UmfwHprlfJGw3evO9b2X4JeQ4DUjEPfitE1GLhf935MZy'),
(10, 'naraen', 'n@gmail.com', '$2y$10$SoD8jfI2qfrDx4.i/A6NyerRnB9MGLrgIVwlSALctJkL507z78qFm');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `username` varchar(200) NOT NULL,
  `f_name` varchar(100) NOT NULL,
  `l_name` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `city` varchar(200) NOT NULL,
  `sq1` varchar(200) NOT NULL,
  `sq2` varchar(200) NOT NULL,
  `ans1` varchar(200) NOT NULL,
  `ans2` int(100) NOT NULL,
  `prof_pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`username`, `f_name`, `l_name`, `gender`, `city`, `sq1`, `sq2`, `ans1`, `ans2`, `prof_pic`) VALUES
('deenie', 'Fardeen', 'Ras', 'Male', 'brisbane', '', '', '', 0, ''),
('naraen', 'Naraen', 'S', ' ', 'Brisbane', ' ', ' ', 'cat', 1, '.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comment_event_fk` (`event_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD UNIQUE KEY `event_id` (`event_id`),
  ADD KEY `usernameevent_fk` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_event_fk` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `usernameevent_fk` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `username__detail_fk` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
