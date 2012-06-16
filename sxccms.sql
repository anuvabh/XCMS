-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 08, 2012 at 08:11 AM
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

DROP TABLE IF EXISTS `blocksetsinfo`;
CREATE TABLE IF NOT EXISTS `blocksetsinfo` (
  `BlockSetID` bigint(20) unsigned NOT NULL,
  `BlockID` bigint(20) unsigned NOT NULL,
  `Status` tinyint(1) DEFAULT '1',
  `Net` int(11) NOT NULL,
  PRIMARY KEY (`BlockSetID`,`BlockID`),
  KEY `BlockID` (`BlockID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blocksetsinfo`
--

INSERT INTO `blocksetsinfo` (`BlockSetID`, `BlockID`, `Status`, `Net`) VALUES
(1333983742, 1333983325, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `blocksinfo`
--

DROP TABLE IF EXISTS `blocksinfo`;
CREATE TABLE IF NOT EXISTS `blocksinfo` (
  `BlockID` bigint(20) unsigned NOT NULL,
  `Department` varchar(8) NOT NULL,
  `Year` tinyint(1) NOT NULL,
  `Room` int(11) NOT NULL,
  `CRID` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`BlockID`),
  KEY `Department` (`Department`),
  KEY `CRID` (`CRID`),
  KEY `blocksinfo_ibfk_2` (`CRID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blocksinfo`
--

INSERT INTO `blocksinfo` (`BlockID`, `Department`, `Year`, `Room`, `CRID`) VALUES
(1333983325, 'CMSA', 2, 32, 1333983674),
(1333983344, 'ENGA', 1, 10, NULL),
(1334313774, 'STSA', 2, 42, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `codesetsinfo`
--

DROP TABLE IF EXISTS `codesetsinfo`;
CREATE TABLE IF NOT EXISTS `codesetsinfo` (
  `BlockSetID` bigint(20) unsigned NOT NULL,
  `Code` bigint(20) unsigned NOT NULL,
  `Valid` tinyint(1) DEFAULT '1',
  `UserID` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`BlockSetID`,`Code`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `codesetsinfo`
--

INSERT INTO `codesetsinfo` (`BlockSetID`, `Code`, `Valid`, `UserID`) VALUES
(1333983742, 1516164644, 1, 1334313221),
(1333983742, 3729332032, 1, NULL),
(1333983742, 5535086120, 1, 1333983784),
(1333983742, 8686422077, 1, 1334313569),
(1333983742, 8875565137, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `credits`
--

DROP TABLE IF EXISTS `credits`;
CREATE TABLE IF NOT EXISTS `credits` (
  `UserID` bigint(20) unsigned NOT NULL,
  `EventID` bigint(20) unsigned NOT NULL,
  `Unit` enum('hours','atomic') NOT NULL,
  `Amount` int(11) NOT NULL,
  PRIMARY KEY (`UserID`,`EventID`),
  KEY `EventID` (`EventID`),
  KEY `Unit` (`Unit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credits`
--


-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
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
('BMBT', 'Biotechnology', 'academic'),
('CMSA', 'Computer Science', 'academic'),
('ENGA', 'English', 'academic'),
('MCBA', 'Micro Biology', 'academic'),
('MTMA', 'Mathematics', 'academic'),
('NSS', 'National Service Scheme', 'nonacademic'),
('PHSA', 'Physics', 'academic'),
('sports', 'Sporrts', 'nonacademic'),
('STSA', 'Statistics', 'academic');

-- --------------------------------------------------------

--
-- Table structure for table `eventassociationsinfo`
--

DROP TABLE IF EXISTS `eventassociationsinfo`;
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

DROP TABLE IF EXISTS `eventrolesinfo`;
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

INSERT INTO `eventrolesinfo` (`EventID`, `Role`, `Credit`) VALUES
(1338981199, 'abc', 12),
(1338981199, 'def', 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `EventID` bigint(20) unsigned NOT NULL,
  `Department` varchar(8) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `EventName` varchar(100) NOT NULL,
  `Details` text NOT NULL,
  `SocialCredit` tinyint(1) NOT NULL,
  `Unit` enum('hours','atomic') NOT NULL,
  PRIMARY KEY (`EventID`),
  KEY `Department` (`Department`),
  KEY `Unit` (`Unit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`EventID`, `Department`, `StartDate`, `EndDate`, `EventName`, `Details`, `SocialCredit`, `Unit`) VALUES
(1338981199, 'ADMIN', '2017-06-29', '2027-11-05', 'op', '12', 1, 'hours'),
(1338981428, 'ADMIN', '2018-03-02', '2019-12-07', 'sd', 'sssssss', 0, 'hours'),
(1338983336, 'ADMIN', '2013-01-17', '2013-01-20', 'xavotsav', 'lol', 0, 'hours'),
(1338983369, 'ADMIN', '2013-01-06', '2013-03-08', 'sports', '', 0, 'hours'),
(1338983530, 'sports', '2012-12-01', '2012-12-04', 'annual sports', '', 0, 'hours');

-- --------------------------------------------------------

--
-- Table structure for table `registryinfo`
--

DROP TABLE IF EXISTS `registryinfo`;
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

DROP TABLE IF EXISTS `users`;
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
(1, 'system', 'Anuvabh', 'Dutt', 'ADMIN', 0, 'anuvabhdutt@gmail.com', 'anuvabh', 1),
(1333983674, 'cr', 'Gaurav', 'Bhadra', 'CMSA', 516, 'gaurav@gmail.com', 'gaurav', 1),
(1333983784, 'student', 'Mourjo', 'Sen', 'CMSA', 561, 'sen.mourjo@gmail.com', 'mourjo', 1),
(1334313221, 'student', 'Anirban', 'Mukh', 'CMSA', 552, 'anirban@gmail.com', 'anirban', 1),
(1334313569, 'student', 'Adil', 'Alam', 'CMSA', 567, 'adil@gmail.com', 'adil', 1),
(1338983470, 'dept', 'Sporrts', 'Department', 'sports', 0, 'sports', 'sports', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blocksetsinfo`
--
ALTER TABLE `blocksetsinfo`
  ADD CONSTRAINT `blocksetsinfo_ibfk_1` FOREIGN KEY (`BlockID`) REFERENCES `blocksinfo` (`BlockID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blocksinfo`
--
ALTER TABLE `blocksinfo`
  ADD CONSTRAINT `blocksinfo_ibfk_1` FOREIGN KEY (`Department`) REFERENCES `departments` (`Code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blocksinfo_ibfk_2` FOREIGN KEY (`CRID`) REFERENCES `users` (`UserID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `codesetsinfo`
--
ALTER TABLE `codesetsinfo`
  ADD CONSTRAINT `codesetsinfo_ibfk_1` FOREIGN KEY (`BlockSetID`) REFERENCES `blocksetsinfo` (`BlockSetID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `codesetsinfo_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `credits`
--
ALTER TABLE `credits`
  ADD CONSTRAINT `credits_ibfk_3` FOREIGN KEY (`Unit`) REFERENCES `events` (`Unit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credits_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `credits_ibfk_2` FOREIGN KEY (`EventID`) REFERENCES `events` (`EventID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eventassociationsinfo`
--
ALTER TABLE `eventassociationsinfo`
  ADD CONSTRAINT `eventassociationsinfo_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `events` (`EventID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eventassociationsinfo_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eventassociationsinfo_ibfk_3` FOREIGN KEY (`Role`) REFERENCES `eventrolesinfo` (`Role`) ON DELETE CASCADE ON UPDATE CASCADE;

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
