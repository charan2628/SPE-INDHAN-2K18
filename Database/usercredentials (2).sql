-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2018 at 05:19 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `usercredentials`
--

CREATE TABLE `usercredentials` (
  `ID` int(10) NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `gender` text NOT NULL,
  `college` text NOT NULL,
  `PAID` varchar(2) NOT NULL,
  `RegID` varchar(20) NOT NULL,
  `branch` text NOT NULL,
  `degree` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `lastLogin` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usercredentials`
--

INSERT INTO `usercredentials` (`ID`, `firstName`, `lastName`, `email`, `phone`, `gender`, `college`, `PAID`, `RegID`, `branch`, `degree`, `year`, `lastLogin`) VALUES
(1, 'Sai charan Raj', 'Gudala', 's.charancherry22@gmail.com', '7032335628', 'M', 'JNTUK', '1', 'Indhan2k18-61090', 'Petroleum Engineering', 'BTECH', '1st', '13/01/2018'),
(2, 'Sai charan Raj', 'Gudala', 's.charancherry@gmail.com', '7032335628', 'M', 'JNTUK', '0', 'Indhan2k18-92375', 'Petroleum Engineering', 'BTECH', '1st', '13/01/2018');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usercredentials`
--
ALTER TABLE `usercredentials`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usercredentials`
--
ALTER TABLE `usercredentials`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
