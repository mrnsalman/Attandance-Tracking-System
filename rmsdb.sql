-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2020 at 11:47 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `39day`
--

CREATE TABLE `39day` (
  `studentname` varchar(50) NOT NULL,
  `studentid` varchar(50) NOT NULL,
  `class_conducted` int(11) NOT NULL DEFAULT '0',
  `class_attended` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `39day`
--

INSERT INTO `39day` (`studentname`, `studentid`, `class_conducted`, `class_attended`) VALUES
('Mehnaz Alam', '201421039001', 0, 0),
('Shakil Ahmed Rahul', '201421039003', 0, 0),
('Salman Hossain', '201421039012', 0, 0),
('Towhidul Islam', '201421039046', 0, 0),
('Walid', '201421039047', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `batchname` varchar(50) NOT NULL,
  `totalstudent` int(20) NOT NULL,
  `id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`batchname`, `totalstudent`, `id`) VALUES
('39 Day', 14, '39D');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `coursename` varchar(50) NOT NULL,
  `coursecode` varchar(50) NOT NULL,
  `credit` int(10) NOT NULL,
  `labtheory` varchar(50) NOT NULL,
  `id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`coursename`, `coursecode`, `credit`, `labtheory`, `id`) VALUES
('Computer Fundamental', '', 1, 'Lab', 1),
('Database', '', 1, 'Lab', 2),
('English1', 'CSE104', 3, 'Theory', 5),
('Math1', '', 3, 'Theory', 6),
('Java Programming', '', 3, 'Theory', 7),
('C Programming', '', 3, 'Theory', 8),
('math2', 'CSE110', 3, 'Theory', 9),
('Math2', '', 3, 'Theory', 10);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `email`, `department`, `designation`) VALUES
(3, 'Riaz Uddin', 'riaz@gmail.com', 'CSE', 'Lecturer');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `department` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `pic` varchar(350) NOT NULL,
  `db` varchar(50) NOT NULL,
  `passreset` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `firstname`, `lastname`, `password`, `id`, `email`, `designation`, `department`, `phone`, `pic`, `db`, `passreset`) VALUES
('mbappe', 'MD', 'Bappy', '455ad4beb47b2970cd7ae57468d3e03e', 2, 'info@bgmleads.com', 'assistent professor', 'CSE', '01970851823', '', '', 0),
('mrkbd', 'Rokeya', 'Khatun', 'dd4864891b86d585c91a10153520484d', 13, 'mrkbd@gmail.com', 'Asst. Professor', 'CSE', '01674896020', 'pictures/Vintage Label-01.png', 'mrkbdDB', 0),
('salma', 'Umme', 'Salma', '827ccb0eea8a706c4c34a16891f84e7b', 16, 'ummesalma@gmail.com', 'Lecturer', 'CSE', '123456789', 'pictures/download.png', 'salmadb', 0),
('mrk', 'Rokeya', 'Khatun', '202cb962ac59075b964b07152d234b70', 22, 'abc@gmail.com', 'Lecturer', 'CSE', '123', 'pictures/download.png', 'mrkdb', 0),
('mrnsalman', 'Salman', 'Miran', 'e10adc3949ba59abbe56e057f20f883e', 23, 'salmanhossain.shm@gmail.com', 'Professor', 'CSE', '01670851823', 'pictures/miran.jpg', 'mrnsalmandb', 482727),
('shmiran', 'Salman', 'Hossain', 'e10adc3949ba59abbe56e057f20f883e', 24, 'salmanhossain80@yahoo.com', 'Professor', 'CSE', '01670851823', 'pictures/miran.jpg', 'shmirandb', 88649),
('admin', 'Salman', 'Miran', 'e10adc3949ba59abbe56e057f20f883e', 25, 'admin@gmail.com', 'Professor', 'CSE', '01670851823', 'pictures/05.jpg', 'admindb', 0),
('admin2', 'Salman', 'Miran', 'e10adc3949ba59abbe56e057f20f883e', 26, 'admin2@gmail.com', 'Professor', 'CSE', '01670851823', 'pictures/M9 copy (1).png', 'admin2db', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `39day`
--
ALTER TABLE `39day`
  ADD PRIMARY KEY (`studentid`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
