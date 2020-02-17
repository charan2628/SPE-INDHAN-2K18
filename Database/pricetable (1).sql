-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2018 at 05:00 PM
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
-- Table structure for table `pricetable`
--

CREATE TABLE `pricetable` (
  `ID` int(10) NOT NULL,
  `productName` text NOT NULL,
  `price` varchar(20) NOT NULL,
  `paymentLink` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pricetable`
--

INSERT INTO `pricetable` (`ID`, `productName`, `price`, `paymentLink`) VALUES
(1, 'WERKSTATT', '300', 'sanboxpayment.html'),
(2, 'EXPOSITION', '200', 'sanboxpayment.html'),
(3, 'PLAKAT', '200', ''),
(4, 'NAMUNA', '400', ''),
(5, 'BRAINIAC', '300', ''),
(6, 'MUDMASH', '100', ''),
(7, 'CHEMILEON', '200', ''),
(8, ' EXEGESIS', '150', ''),
(9, 'REGISTRATION', '300', 'sanboxpayment.html'),
(10, 'ACCOMMODATION', '200', ''),
(11, 'AROMATISK', '100', ''),
(12, 'FIELD DEVELOPMENT', '200', ''),
(13, 'GAMEOFROCKS', '200', ''),
(14, 'TOOLPUZZLE', '200', ''),
(15, 'EXAMEN', '200', ''),
(16, 'FOOD', '300', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pricetable`
--
ALTER TABLE `pricetable`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pricetable`
--
ALTER TABLE `pricetable`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
