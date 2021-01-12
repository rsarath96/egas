-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 02, 2021 at 10:25 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbgasagency`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

CREATE TABLE IF NOT EXISTS `tblbooking` (
  `bookingid` int(11) NOT NULL AUTO_INCREMENT,
  `cContact` varchar(50) NOT NULL,
  `bdate` datetime NOT NULL,
  `nocyl` int(11) NOT NULL,
  `ptype` varchar(50) NOT NULL,
  `otp` int(11) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`bookingid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`bookingid`, `cContact`, `bdate`, `nocyl`, `ptype`, `otp`, `status`) VALUES
(1, '9746254509', '2020-12-07 16:19:44', 1, 'Cash on delivery', 7336, 'delivered'),
(2, '9746254509', '2020-12-08 09:44:08', 1, 'Online payment', 9541, 'approved'),
(3, '7896541230', '2021-01-01 16:18:24', 1, 'Cash on delivery', 6015, 'payment completed'),
(4, '7485961230', '2021-01-02 15:52:22', 1, 'Online payment', 3741, 'payment completed');

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomer`
--

CREATE TABLE IF NOT EXISTS `tblcustomer` (
  `cName` varchar(50) NOT NULL,
  `cAddress` varchar(100) NOT NULL,
  `cContact` varchar(50) NOT NULL,
  `cEmail` varchar(50) NOT NULL,
  `cAadhar` varchar(50) NOT NULL,
  `cRation` varchar(50) NOT NULL,
  `cType` varchar(50) NOT NULL,
  `consumerno` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cContact`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcustomer`
--

INSERT INTO `tblcustomer` (`cName`, `cAddress`, `cContact`, `cEmail`, `cAadhar`, `cRation`, `cType`, `consumerno`) VALUES
('Gritta', 'jhnbhj', '7356777874', 'gritta@gmail.com', '6985471203691', 'kjn3654', 'Domestic', NULL),
('Mejo', 'hnafsdhv', '7356777877', 'mejo@gmail.com', '784569102369', 'bh7485', 'Domestic', NULL),
('David', 'khnh', '7356777878', 'david@gmail.com', '854796123025', 'jhbj454', 'Domestic', NULL),
('Isa', 'jhbjh', '7485961230', 'isa@gmail.com', '784596231023', 'kl78', 'Domestic', '10001'),
('Ken', 'fff', '7896541230', 'ken@gmail.com', '487596231023', '4579', 'Domestic', NULL),
('Melina', 'jhbafj', '9746254509', 'melina@gmail.com', '869547102365', 'j54154', 'Domestic', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblfeedback`
--

CREATE TABLE IF NOT EXISTS `tblfeedback` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `cContact` varchar(50) NOT NULL,
  `fdate` datetime NOT NULL,
  `feedback` varchar(100) NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tblfeedback`
--

INSERT INTO `tblfeedback` (`fid`, `cContact`, `fdate`, `feedback`) VALUES
(1, '9746254509', '2020-12-07 16:46:33', 'kjdfbvjh'),
(2, '7896541230', '2021-01-01 16:20:20', 'Good');

-- --------------------------------------------------------

--
-- Table structure for table `tbllogin`
--

CREATE TABLE IF NOT EXISTS `tbllogin` (
  `uname` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `utype` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbllogin`
--

INSERT INTO `tbllogin` (`uname`, `pwd`, `utype`, `status`) VALUES
('admin@gmail.com', 'admin', 'admin', '1'),
('7356777877', 'mejo', 'customer', '0'),
('7356777878', 'david', 'customer', '1'),
('9746254509', 'melina', 'customer', '1'),
('7356777874', 'gritta', 'customer', '0'),
('7896541230', 'ken', 'customer', '1'),
('7485961230', 'isa', 'customer', '1');
