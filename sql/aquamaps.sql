-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-05-2013 a las 03:35:34
-- Versión del servidor: 5.5.20
-- Versión de PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `aquamaps`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `points`
--

CREATE TABLE IF NOT EXISTS `points` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(7) unsigned DEFAULT NULL,
  `point_type_id` tinyint(2) unsigned DEFAULT NULL,
  `photo` tinyint(1) unsigned DEFAULT NULL,
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL,
  `price` float(7,2) unsigned DEFAULT NULL COMMENT 'represents the amount of USD per metric cube of water',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `point_types`
--

CREATE TABLE IF NOT EXISTS `point_types` (
  `id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` tinyint(2) unsigned DEFAULT NULL,
  `lft` tinyint(2) unsigned DEFAULT NULL,
  `rght` tinyint(2) unsigned DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `point_types`
--

INSERT INTO `point_types` (`id`, `parent_id`, `lft`, `rght`, `name`, `description`) VALUES
(1, NULL, 1, 26, 'Punto de agua', NULL),
(2, NULL, 27, 34, 'Baño', NULL),
(3, 1, 2, 15, 'Fuente de agua mejorada', NULL),
(4, 3, 3, 4, 'Red de agua potable - domiciliario', NULL),
(5, 3, 5, 6, 'Red de agua potable - comercial', 'bla bla bla'),
(6, 3, 7, 8, 'Red de agua potable - industrial', 'bla bla bla'),
(7, 3, 9, 10, 'Fuente pública', 'bla bla bla'),
(8, 3, 11, 12, 'Pozo protegido', ''),
(9, 3, 13, 14, 'Recolección de lluvia', ''),
(10, 1, 16, 25, 'Fuente de agua NO mejorada', ''),
(11, 10, 17, 18, 'Pozos', ''),
(12, 10, 19, 20, 'Turril o barril', ''),
(13, 10, 21, 22, 'Camión cisterna', ''),
(14, 10, 23, 24, 'Manantiales no protegidos', ''),
(15, 2, 28, 29, 'Baño ecológico seco', ''),
(16, 2, 30, 31, 'Baño con arrastre de agua', 'El baño cuenta con un mecanismo para que el agua se encargue de los desechos?'),
(17, 2, 32, 33, 'Letrina con pozo séptico', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `facebook_oauth_uid` varchar(64) DEFAULT NULL,
  `google_oauth_uid` varchar(64) DEFAULT NULL,
  `password_temp` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `created`, `modified`, `facebook_oauth_uid`, `google_oauth_uid`, `password_temp`) VALUES
(1, 'mauro.trigo@gmail.com', '1c0f67c1e504716c4ac91379c3cebe9330116669', 'Mauro', 'Trigo', '2013-04-28 23:47:31', '2013-05-02 20:06:40', NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
