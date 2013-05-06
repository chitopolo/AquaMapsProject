-- phpMyAdmin SQL Dump
-- version 3.5.0
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2013 at 08:46 PM
-- Server version: 5.5.18
-- PHP Version: 5.3.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aquamaps`
--

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

CREATE TABLE IF NOT EXISTS `zones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `zones`
--

INSERT INTO `zones` (`id`, `name`) VALUES
(1, 'Asia '),
(2, 'Europe '),
(3, 'Africa '),
(4, 'Oceania '),
(5, 'Central America and the Caribbean '),
(6, 'Antarctic Region '),
(7, 'South America '),
(8, 'Commonwealth of Independent States '),
(9, 'Southeast Asia '),
(10, 'Middle East '),
(11, 'North America '),
(12, 'Bosnia and Herzegovina, Europe '),
(13, 'World '),
(15, 'South America, Central America and the Caribbean '),
(16, 'Arctic Region '),
(17, 'World, Time Zones ');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
