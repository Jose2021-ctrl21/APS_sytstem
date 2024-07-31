-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 17, 2023 at 08:59 AM
-- Server version: 5.7.36
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(15) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `birthdate` varchar(255) NOT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `gender` varchar(15) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `schedule` varchar(255) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL,
  `user_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `employee_id`, `username`, `password`, `firstname`, `lastname`, `address`, `birthdate`, `contact`, `gender`, `position`, `schedule`, `photo`, `created_on`, `user_type`) VALUES
(1, '435454', 'admin', '0192023a7bbd73250516f069df18b500', 'John Doe', 'Siervo', '', '', '', '', '', '', 'facebook-profile-image.jpeg', '2018-04-30', 'admin'),
(2, '4534534', 'staff', 'de9bf5643eabf80f4a56fda3bbb84483', 'Jose Manuel', 'Siervo', '', '', '', '', '', '', '', '2023-04-26', 'staff'),
(11, 'NTM964125380', 'angel', '3a5f7ae81ffd6c84e5c68dd774419d73', 'Angel', 'Tolentino', 'sample', '2023-04-19', '09092735719', 'Female', NULL, '09:00:0018:00:00', '', '2023-04-30', 'admin'),
(12, 'XTG968125307', 'iris', '3890a5f1350fe34122537be393a5faab', 'Iris', 'Cagbabanua', 'sample', '2023-04-13', '09092735719', 'Female', NULL, '10:00:0019:00:00', '', '2023-04-30', 'staff'),
(13, 'TEJ385426971', 'sample', '5e8ff9bf55ba3508199d22e984129be6', 'sample', 'sample', 'sample', '2023-05-01', 'sample', 'Male', NULL, '10:00:0019:00:00', '', '2023-05-01', 'admin'),
(14, 'BMY479321086', 'test', '098f6bcd4621d373cade4e832627b4f6', 'test', 'test', 'test', '2023-05-31', '5345', 'Male', NULL, '10:00:0019:00:00', '', '2023-05-01', 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `time_in` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `time_out` varchar(255) DEFAULT NULL,
  `num_hr` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=307 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cashadvance`
--

DROP TABLE IF EXISTS `cashadvance`;
CREATE TABLE IF NOT EXISTS `cashadvance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_advance` date NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `amount` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cashadvance`
--

INSERT INTO `cashadvance` (`id`, `date_advance`, `employee_id`, `amount`) VALUES
(2, '2018-05-02', '1', 1000),
(3, '2018-05-02', '1', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

DROP TABLE IF EXISTS `deductions`;
CREATE TABLE IF NOT EXISTS `deductions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  `amount` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deductions`
--

INSERT INTO `deductions` (`id`, `description`, `amount`) VALUES
(1, 'SSS', 100),
(2, 'Pagibig', 150),
(3, 'PhilHealth', 150);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `files` longtext NOT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `file_name`, `files`, `file_type`, `date`) VALUES
(23, 'test1', 'abs (2).png', 'png', '2023-06-13');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(15) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `address` text,
  `birthdate` date DEFAULT NULL,
  `contact_info` varchar(100) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `firstname`, `lastname`, `address`, `birthdate`, `contact_info`, `gender`, `position_id`, `schedule_id`, `photo`, `created_on`) VALUES
(1, 'ABC123456789', 'Neovic', 'Devierte', 'Brgy. Mambulac, Silay City', '2018-04-02', '09092735719', 'Female', 2, 2, 'desktop.jpg', '2018-04-28'),
(3, 'DYE473869250', 'Julyn', 'Divinagracia', 'E.B. Magalona', '1992-05-02', '09123456789', 'Female', 1, 2, '', '2018-04-30'),
(8, 'YPH679853241', 'Iris', 'Cagbabanua', 'PASIG', '2023-04-25', 'sd', 'Female', 1, 1, '', '2023-04-28');

-- --------------------------------------------------------

--
-- Table structure for table `overtime`
--

DROP TABLE IF EXISTS `overtime`;
CREATE TABLE IF NOT EXISTS `overtime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(15) NOT NULL,
  `hours` double NOT NULL,
  `rate` double NOT NULL,
  `date_overtime` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

DROP TABLE IF EXISTS `position`;
CREATE TABLE IF NOT EXISTS `position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(150) NOT NULL,
  `rate` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `description`, `rate`) VALUES
(1, 'Programmer', 100),
(2, 'Writer', 50);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
CREATE TABLE IF NOT EXISTS `schedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `time_in`, `time_out`) VALUES
(1, '07:00:00', '16:00:00'),
(2, '08:00:00', '17:00:00'),
(3, '09:00:00', '18:00:00'),
(4, '10:00:00', '19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(15) DEFAULT NULL,
  `username` int(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `birthdate` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `gender` varchar(15) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `schedule` varchar(255) DEFAULT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL,
  `user_type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
