-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 05, 2012 at 04:59 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sxccms`
--

-- --------------------------------------------------------

--
-- Table structure for table `blocksetsinfo`
--

CREATE TABLE IF NOT EXISTS `blocksetsinfo` (
  `BlockSetID` bigint(20) unsigned NOT NULL,
  `BlockID` bigint(20) unsigned NOT NULL,
  `CRID` bigint(20) unsigned NOT NULL,
  `Status` tinyint(1) DEFAULT '1',
  `Net` int(11) NOT NULL,
  PRIMARY KEY (`BlockSetID`),
  KEY `BlockID` (`BlockID`),
  KEY `BlockID_2` (`BlockID`),
  KEY `CRID` (`CRID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blocksetsinfo`
--


-- --------------------------------------------------------

--
-- Table structure for table `blocksinfo`
--

CREATE TABLE IF NOT EXISTS `blocksinfo` (
  `BlockID` bigint(20) unsigned NOT NULL,
  `Department` varchar(8) NOT NULL,
  `Year` tinyint(1) NOT NULL,
  `Room` int(11) NOT NULL,
  PRIMARY KEY (`BlockID`),
  KEY `Department` (`Department`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blocksinfo`
--


-- --------------------------------------------------------

--
-- Table structure for table `codesetsinfo`
--

CREATE TABLE IF NOT EXISTS `codesetsinfo` (
  `BlockSetID` bigint(20) unsigned NOT NULL,
  `Code` bigint(20) unsigned NOT NULL,
  `Valid` tinyint(1) DEFAULT '1',
  `UserID` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`BlockSetID`,`Code`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `codesetsinfo`
--


-- --------------------------------------------------------

--
-- Table structure for table `credits`
--

CREATE TABLE IF NOT EXISTS `credits` (
  `UserID` bigint(20) unsigned NOT NULL,
  `EventID` bigint(20) unsigned NOT NULL,
  `Unit` enum('hours','atomic') NOT NULL,
  `Amount` int(11) NOT NULL,
  PRIMARY KEY (`UserID`,`EventID`),
  KEY `EventID` (`EventID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credits`
--


-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `Code` varchar(8) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Type` enum('academic','nonacademic') NOT NULL,
  PRIMARY KEY (`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`Code`, `Name`, `Type`) VALUES
('ADMIN', 'Administration', 'nonacademic'),
('CMSA', 'Computer Science', 'academic'),
('MTMA', 'Mathematics', 'academic'),
('NSS', 'National Service Scheme', 'nonacademic');

-- --------------------------------------------------------

--
-- Table structure for table `eventassociationsinfo`
--

CREATE TABLE IF NOT EXISTS `eventassociationsinfo` (
  `EventID` bigint(20) unsigned NOT NULL,
  `UserID` bigint(20) unsigned NOT NULL,
  `Role` varchar(50) NOT NULL,
  `States` enum('submitted','accepted','rejected') DEFAULT 'submitted',
  PRIMARY KEY (`EventID`,`UserID`),
  KEY `UserID` (`UserID`),
  KEY `Role` (`Role`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventassociationsinfo`
--


-- --------------------------------------------------------

--
-- Table structure for table `eventrolesinfo`
--

CREATE TABLE IF NOT EXISTS `eventrolesinfo` (
  `EventID` bigint(20) unsigned NOT NULL,
  `Role` varchar(50) NOT NULL,
  `Credit` int(11) DEFAULT NULL,
  PRIMARY KEY (`EventID`,`Role`),
  KEY `Role` (`Role`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventrolesinfo`
--


-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `EventID` bigint(20) unsigned NOT NULL,
  `Department` varchar(8) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `EventName` varchar(100) NOT NULL,
  `Details` text NOT NULL,
  `SocialCredit` tinyint(1) NOT NULL,
  PRIMARY KEY (`EventID`),
  KEY `Department` (`Department`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--


-- --------------------------------------------------------

--
-- Table structure for table `registryinfo`
--

CREATE TABLE IF NOT EXISTS `registryinfo` (
  `Key` varchar(100) NOT NULL,
  `Value` varchar(100) NOT NULL,
  PRIMARY KEY (`Key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registryinfo`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserID` bigint(20) unsigned NOT NULL,
  `UserType` enum('student','cr','dept','system') NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Department` varchar(8) NOT NULL,
  `Roll` int(11) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Email` (`Email`),
  KEY `Department` (`Department`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserType`, `FirstName`, `LastName`, `Department`, `Roll`, `Email`, `Password`, `Status`) VALUES
(1, 'student', 'Mourjo', 'Sen', 'CMSA', 561, 'sen.mourjo@gmail.com', 'mourjo', 1),
(2, 'system', 'Anuvabh', 'Dutt', 'ADMIN', 0, 'anuvabhdutt@gmail.com', 'anuvabh', 1),
(3, 'dept', 'Anirban', 'Mukh', 'CMSA', 551, 'anirbanda@gmail.com', 'anirban', 1),
(4, 'cr', 'Sahon', 'Bhattacharyya', 'CMSA', 501, 'sahon.drgo@acm.org', 'sahon', 1),
(5, 'student', 'Michael', 'Jackson', 'CMSA', 777, 'michael@gmail.com', 'michael', 0),
(1333630215, 'student', 'Nelson', 'Chacko', 'MTMA', 530, 'nelson@gmail.com', 'nelson', 1),
(1333631217, 'student', 'Peter', 'Jackson', 'MTMA', 333, 'pete@pete.com', 'peter', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blocksetsinfo`
--
ALTER TABLE `blocksetsinfo`
  ADD CONSTRAINT `blocksetsinfo_ibfk_2` FOREIGN KEY (`CRID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blocksetsinfo_ibfk_1` FOREIGN KEY (`BlockID`) REFERENCES `blocksinfo` (`BlockID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blocksinfo`
--
ALTER TABLE `blocksinfo`
  ADD CONSTRAINT `blocksinfo_ibfk_1` FOREIGN KEY (`Department`) REFERENCES `departments` (`Code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `codesetsinfo`
--
ALTER TABLE `codesetsinfo`
  ADD CONSTRAINT `codesetsinfo_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `codesetsinfo_ibfk_1` FOREIGN KEY (`BlockSetID`) REFERENCES `blocksetsinfo` (`BlockSetID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `credits`
--
ALTER TABLE `credits`
  ADD CONSTRAINT `credits_ibfk_2` FOREIGN KEY (`EventID`) REFERENCES `events` (`EventID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credits_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eventassociationsinfo`
--
ALTER TABLE `eventassociationsinfo`
  ADD CONSTRAINT `eventassociationsinfo_ibfk_3` FOREIGN KEY (`Role`) REFERENCES `eventrolesinfo` (`Role`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eventassociationsinfo_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `events` (`EventID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eventassociationsinfo_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eventrolesinfo`
--
ALTER TABLE `eventrolesinfo`
  ADD CONSTRAINT `eventrolesinfo_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `events` (`EventID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`Department`) REFERENCES `departments` (`Code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`Department`) REFERENCES `departments` (`Code`) ON DELETE CASCADE ON UPDATE CASCADE;
