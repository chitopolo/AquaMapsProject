-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 31-01-2013 a las 03:55:43
-- Versión del servidor: 5.5.20
-- Versión de PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cityheroes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crumbs`
--

CREATE TABLE IF NOT EXISTS `crumbs` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL,
  `time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `life_tags`
--

CREATE TABLE IF NOT EXISTS `life_tags` (
  `id` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(7) unsigned DEFAULT NULL,
  `type` tinyint(2) unsigned DEFAULT NULL,
  `order` tinyint(2) unsigned DEFAULT NULL,
  `number` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `number` (`number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(7) unsigned NOT NULL,
  `level` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `name` varchar(50) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tribes`
--

CREATE TABLE IF NOT EXISTS `tribes` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `user_id` int(7) unsigned DEFAULT NULL,
  `type` tinyint(2) unsigned DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tribes_users`
--

CREATE TABLE IF NOT EXISTS `tribes_users` (
  `tribe_id` int(7) unsigned NOT NULL,
  `user_id` int(7) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `life_tag_count` tinyint(2) unsigned DEFAULT NULL,
  `verification_code` char(16) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
