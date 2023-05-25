-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2022 at 08:22 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finaltermproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Name` varchar(100) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `BloodGroup` varchar(100) NOT NULL,
  `Role` varchar(100) NOT NULL,
  `PicturePath` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Name`, `Username`, `Email`, `Password`, `DateOfBirth`, `Gender`, `BloodGroup`, `Role`, `PicturePath`) VALUES
('Abdullah All Rawaha Anik', 'Dufaux', 'rawaha.anik.1@gmail.com', 'anik0909', '1999-09-15', 'Male', 'AB+', 'Admin', '');

-- --------------------------------------------------------

--
-- Table structure for table `productinfo`
--

CREATE TABLE `productinfo` (
  `ProductName` varchar(200) NOT NULL,
  `ProductId` varchar(200) NOT NULL,
  `ProductDate` date NOT NULL,
  `ProductBuyingPrice` varchar(100) NOT NULL,
  `ProductSellingPrice` varchar(100) NOT NULL,
  `ProductType` varchar(200) NOT NULL,
  `ProductQuantity` varchar(100) NOT NULL,
  `ProductAvailability` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productinfo`
--

INSERT INTO `productinfo` (`ProductName`, `ProductId`, `ProductDate`, `ProductBuyingPrice`, `ProductSellingPrice`, `ProductType`, `ProductQuantity`, `ProductAvailability`) VALUES
('Asus', '1', '2000-01-01', '1500', '2345', 'Electronics', '123', '1'),
('Laptop', '1', '2000-01-01', '1234124', '12124124', 'Electronics', '123', '1'),
('Redmi Note 10', '2', '2000-01-01', '12000', '14500', 'Electronics', '12', '1');

-- --------------------------------------------------------

--
-- Table structure for table `userapproval`
--

CREATE TABLE `userapproval` (
  `Name` varchar(100) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `BloodGroup` varchar(100) NOT NULL,
  `Role` varchar(100) NOT NULL,
  `PicturePath` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `Name` varchar(100) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `BloodGroup` varchar(100) NOT NULL,
  `Role` varchar(100) NOT NULL,
  `PicturePath` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`Name`, `Username`, `Email`, `Password`, `DateOfBirth`, `Gender`, `BloodGroup`, `Role`, `PicturePath`) VALUES
('Mahmuda Monalisa', 'monalisa', 'monalisa.ayat887@gmail.com', 'monalisa0909@', '1999-12-19', 'Male', 'A+', 'Buying Agent', ''),
('Rifah Tasnim', 'rifah', 'tasnimrifah@gmail.com', 'rifah0909@', '1999-12-19', 'Female', 'AB-', 'Customer', ''),
('SSS SSS', 'sss', 'sss@gmail.com', 'ssssss0909@', '2000-01-01', 'Male', 'B+', 'Customer', ''),
('Sabbir Rahman', 'sabbir', 'sabbir@gmail.com', 'sabbir0909@', '2000-01-01', 'Male', 'B+', 'Customer', ''),
('Zarif Was', 'jarif123', 'jarifkhan7@gmail.com', 'asdfghjkl@', '2003-12-04', 'Male', 'A+', 'Sales Manager', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
