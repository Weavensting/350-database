-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 09, 2018 at 07:57 PM
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
-- Table structure for table `Alarms`
--

CREATE TABLE `Alarms` (
  `customerId` int(5) NOT NULL,
  `ownerContacted` tinyint(1) NOT NULL,
  `servicesContacted` tinyint(1) NOT NULL,
  `employeeId` int(5) NOT NULL,
  `dateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `report` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Alarms`
--

INSERT INTO `Alarms` (`customerId`, `ownerContacted`, `servicesContacted`, `employeeId`, `dateTime`, `report`) VALUES
(1, 1, 0, 1, '2018-03-09 13:51:58', 'Motion detector activated by the cat'),
(2, 1, 1, 2, '2018-03-09 13:51:58', 'Fire Alarm triggered customers were notified and fire department was dispatched to the scene. ');

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
  `personId` int(10) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`customerId`, `fname`, `lname`, `address`, `accessId`, `EserviceId`, `personId`, `phone`, `email`) VALUES
(1, 'Cosmo', 'Cougar', '900 N. 900 E. Provo, Utah 84606', 4, 1, 6, '8581201220', 'something@gmail.com'),
(2, 'Dim', 'Jumper', '001 2200 San Diego, California 0003', 4, 2, 7, '8581201220', 'something@gmail.com'),
(3, 'Swift', 'Grandma', '300 3030 Colorado', 4, 3, 8, '8581201220', 'something@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `EmergencyServices`
--

CREATE TABLE `EmergencyServices` (
  `type` varchar(10) NOT NULL,
  `area` int(5) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `EmergencyServices`
--

INSERT INTO `EmergencyServices` (`type`, `area`, `phone`) VALUES
('Fire', 1, '1234567891'),
('Fire', 2, '1234567891'),
('Ambulance', 1, '1234567891'),
('Police', 2, '1234567891'),
('Police', 3, '1234567891');

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
(1, 'Stephen', 'Wing', 1, 'fdsafdsaf', 1),
(2, 'Teacher', 'T.A.', 1, 'BYU Provo, Utah', 2),
(3, 'swing', 'jkfldsf', 2, 'Whos counting', 3),
(4, 'Nunya', 'Bizness', 3, 'I\'m a Manager Rhode Island', 4),
(5, 'Harry', 'Potter', 3, 'You\'re a wizard Harry Lane, London England', 5);

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
(1, 'C.E.O', 300000, 1),
(2, 'Manager', 70000, 2),
(3, 'Sales', 50000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE `Products` (
  `productId` int(3) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Price` int(6) NOT NULL,
  `Quantity` int(15) NOT NULL,
  `forSale` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`productId`, `Name`, `Description`, `Price`, `Quantity`, `forSale`) VALUES
(1, 'PANEL', 'A fdspanel lets you control the alarm, as well as any other smart device in your home. ', 1000, 10000, 2),
(2, 'Motion Dectors', 'When you are away from your home, you should be aware of everything that moves in your home. ', 75, 12000, 1),
(3, 'Camera', 'JFKDSF', 1, 11, 2),
(4, 'Camera', 'JFKDSF', 1, 11, 2),
(5, 'something', 'something', 3, 1, 2),
(6, 'fd', 'd', 1, 1, 2),
(7, 'This is it', 'fds', 5, 5, 2),
(8, 'this is another', 'fjkdf', 3, 3, 2),
(9, 'fd', 'fdsa', 2, 2, 2),
(10, 'fdsf', 'yes', 12, 12, 1),
(11, 'another', 'another one', 2, 3, 1),
(12, 'fds', 'fsdf', 12, 121, 1);

-- --------------------------------------------------------

--
-- Table structure for table `UserNames`
--

CREATE TABLE `UserNames` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `personId` int(6) NOT NULL,
  `employee` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UserNames`
--

INSERT INTO `UserNames` (`username`, `password`, `personId`, `employee`) VALUES
('john', 'i\'mjohnandiknownothing', 10, 0),
('swing', 'rainyHorseFireHouseBond007', 1, 1),
('teacher', 'ImaTeacher4everIloveMyStudents', 2, 1);

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
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`productId`),
  ADD UNIQUE KEY `productId` (`productId`);

--
-- Indexes for table `UserNames`
--
ALTER TABLE `UserNames`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `personId` (`personId`);

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
  MODIFY `positionId` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `productId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `UserNames`
--
ALTER TABLE `UserNames`
  MODIFY `personId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
