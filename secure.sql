-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 08, 2018 at 07:38 PM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.25-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `secure`
--

-- --------------------------------------------------------

--
-- Table structure for table `Access`
--

CREATE TABLE `Access` (
  `accessId` int(3) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Access`
--

INSERT INTO `Access` (`accessId`, `name`) VALUES
(1, 'Admin'),
(2, 'Sales'),
(3, 'Sales Man'),
(4, 'Customer'),
(5, 'Factory'),
(6, 'Fac Man');

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `customerId` int(7) NOT NULL,
  `fname` varchar(12) NOT NULL,
  `lname` varchar(12) NOT NULL,
  `address` varchar(50) NOT NULL,
  `accessId` int(3) NOT NULL,
  `EserviceId` int(5) NOT NULL,
  `personId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`customerId`, `fname`, `lname`, `address`, `accessId`, `EserviceId`, `personId`) VALUES
(1, 'Cosmo', 'Cougar', '900 N. 900 E. Provo, Utah 84606', 4, 1, 6),
(2, 'Dim', 'Jumper', '001 2200 San Diego, California 0003', 4, 2, 7),
(3, 'Swift', 'Grandma', '300 3030 Colorado', 4, 3, 8);

-- --------------------------------------------------------

--
-- Table structure for table `Employee`
--

CREATE TABLE `Employee` (
  `employeeId` int(4) NOT NULL,
  `fname` varchar(12) NOT NULL,
  `lname` varchar(12) NOT NULL,
  `positionId` int(4) NOT NULL,
  `address` varchar(60) NOT NULL,
  `personId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Employee`
--

INSERT INTO `Employee` (`employeeId`, `fname`, `lname`, `positionId`, `address`, `personId`) VALUES
(1, 'Stephen', 'Wing', 1, 'Nunya Buisness, BeesWax Utah 84601', 1),
(2, 'Teacher', 'T.A.', 1, 'BYU Provo, Utah', 2),
(3, 'Bob', 'John', 2, 'Salesman Lane', 3),
(4, 'Nunya', 'Bizness', 3, 'I\'m a Manager Rhode Island', 4),
(5, 'Harry', 'Potter', 4, 'You\'re a wizard Harry Lane, London England', 5);

-- --------------------------------------------------------

--
-- Table structure for table `Position`
--

CREATE TABLE `Position` (
  `positionId` int(4) NOT NULL,
  `name` varchar(10) NOT NULL,
  `wage` int(9) NOT NULL,
  `accessId` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Position`
--

INSERT INTO `Position` (`positionId`, `name`, `wage`, `accessId`) VALUES
(1, 'C.E.O', 300000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `UserNames`
--

CREATE TABLE `UserNames` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `personId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UserNames`
--

INSERT INTO `UserNames` (`username`, `password`, `personId`) VALUES
('swing', 'rainyHorseFireHouseBond007', 1),
('teacher', 'ImaTeacher4everIloveMyStudents', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Access`
--
ALTER TABLE `Access`
  ADD PRIMARY KEY (`accessId`);

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`customerId`);

--
-- Indexes for table `Employee`
--
ALTER TABLE `Employee`
  ADD PRIMARY KEY (`employeeId`),
  ADD UNIQUE KEY `employeeId` (`employeeId`);

--
-- Indexes for table `Position`
--
ALTER TABLE `Position`
  ADD PRIMARY KEY (`positionId`);

--
-- Indexes for table `UserNames`
--
ALTER TABLE `UserNames`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Access`
--
ALTER TABLE `Access`
  MODIFY `accessId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `Customer`
--
ALTER TABLE `Customer`
  MODIFY `customerId` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Employee`
--
ALTER TABLE `Employee`
  MODIFY `employeeId` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `Position`
--
ALTER TABLE `Position`
  MODIFY `positionId` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
