-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 12-03-2022 a las 00:16:07
-- Versión del servidor: 8.0.21
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bies-react`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estacionamiento`
--

DROP TABLE IF EXISTS `estacionamiento`;
CREATE TABLE IF NOT EXISTS `estacionamiento` (
  `idEstacionamiento` int NOT NULL AUTO_INCREMENT,
  `idUsuario` int NOT NULL,
  `idPlayaDeEstacionamiento` int NOT NULL,
  `idPlayaDeEstacionamientoHorario` int NOT NULL,
  `fechaEstacionamiento` date NOT NULL,
  `horaInicioEstacionamiento` time NOT NULL,
  `horaFinEstacionamiento` time DEFAULT NULL,
  PRIMARY KEY (`idEstacionamiento`),
  KEY `fk_idPlayaDeEstacionamiento` (`idPlayaDeEstacionamiento`),
  KEY `fk_idPlayaDeEstacionamientoHorario` (`idPlayaDeEstacionamientoHorario`),
  KEY `fk_idUsuario` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estacionamiento`
--

INSERT INTO `estacionamiento` (`idEstacionamiento`, `idUsuario`, `idPlayaDeEstacionamiento`, `idPlayaDeEstacionamientoHorario`, `fechaEstacionamiento`, `horaInicioEstacionamiento`, `horaFinEstacionamiento`) VALUES
(53, 34, 1, 24, '2022-02-08', '14:57:34', '14:57:46'),
(54, 34, 1, 24, '2022-02-08', '17:13:34', '17:13:38'),
(60, 34, 1, 27, '2022-03-11', '20:02:00', '20:40:53'),
(61, 34, 1, 27, '2022-03-11', '20:41:36', '20:43:07'),
(63, 34, 1, 27, '2022-03-11', '20:46:19', '20:48:41'),
(64, 34, 1, 27, '2022-03-11', '20:48:45', '20:53:07'),
(65, 34, 1, 27, '2022-03-11', '20:54:05', '20:54:09'),
(66, 34, 1, 27, '2022-03-11', '20:54:44', '21:12:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `playadeestacionamiento`
--

DROP TABLE IF EXISTS `playadeestacionamiento`;
CREATE TABLE IF NOT EXISTS `playadeestacionamiento` (
  `idPlayaDeEstacionamiento` int NOT NULL AUTO_INCREMENT,
  `nombrePlayaDeEstacionamiento` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ubicacion` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `capacidad` int NOT NULL,
  `observaciones` varchar(2000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mapa` varchar(10000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `lugaresLibres` int NOT NULL,
  PRIMARY KEY (`idPlayaDeEstacionamiento`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `playadeestacionamiento`
--

INSERT INTO `playadeestacionamiento` (`idPlayaDeEstacionamiento`, `nombrePlayaDeEstacionamiento`, `ubicacion`, `capacidad`, `observaciones`, `mapa`, `lugaresLibres`) VALUES
(1, 'Supermercado Dar', 'San Jeronimo y Tucuman', 20, 'Techado', 'https://goo.gl/maps/RENstzUGoocLY8rL8', 20),
(2, 'Tucuman', 'Tucuman y San Martin', 100, 'Varios pisos', 'https://goo.gl/maps/3hkdT6aXGuq79NJi7', 99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `playadeestacionamientohorario`
--

DROP TABLE IF EXISTS `playadeestacionamientohorario`;
CREATE TABLE IF NOT EXISTS `playadeestacionamientohorario` (
  `idHorario` int NOT NULL AUTO_INCREMENT,
  `idPlayaDeEstacionamiento` int NOT NULL,
  `diaSemana` int NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL,
  PRIMARY KEY (`idHorario`),
  KEY `fk_idPlayaDeEstacionamiento2` (`idPlayaDeEstacionamiento`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `playadeestacionamientohorario`
--

INSERT INTO `playadeestacionamientohorario` (`idHorario`, `idPlayaDeEstacionamiento`, `diaSemana`, `horaInicio`, `horaFin`) VALUES
(1, 2, 0, '00:00:00', '15:59:59'),
(2, 2, 1, '00:00:00', '15:59:59'),
(3, 2, 2, '00:00:00', '15:59:59'),
(4, 2, 3, '00:00:00', '15:59:59'),
(5, 2, 4, '00:00:00', '15:59:59'),
(6, 2, 5, '00:00:00', '15:59:59'),
(7, 2, 6, '00:00:00', '15:59:59'),
(8, 2, 0, '16:00:00', '23:59:59'),
(9, 2, 1, '16:00:00', '23:59:59'),
(10, 2, 2, '16:00:00', '23:59:59'),
(11, 2, 3, '16:00:00', '23:59:59'),
(12, 2, 4, '16:00:00', '23:59:59'),
(13, 2, 5, '16:00:00', '23:59:59'),
(14, 2, 6, '16:00:00', '23:59:59'),
(15, 1, 0, '00:00:00', '12:00:00'),
(16, 1, 1, '00:00:00', '12:00:00'),
(17, 1, 2, '00:00:00', '12:00:00'),
(18, 1, 3, '00:00:00', '12:00:00'),
(19, 1, 4, '00:00:00', '12:00:00'),
(20, 1, 5, '00:00:00', '12:00:00'),
(21, 1, 6, '00:00:00', '12:00:00'),
(22, 1, 0, '12:00:01', '23:59:59'),
(23, 1, 1, '12:00:01', '23:59:59'),
(24, 1, 2, '12:00:01', '23:59:59'),
(25, 1, 3, '12:00:01', '23:59:59'),
(26, 1, 4, '12:00:01', '23:59:59'),
(27, 1, 5, '12:00:01', '23:59:59'),
(30, 1, 6, '12:00:01', '23:59:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `idRol` int NOT NULL AUTO_INCREMENT,
  `nombreRol` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRol`, `nombreRol`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dni` int NOT NULL,
  `clave` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `idRol` int NOT NULL DEFAULT '2',
  PRIMARY KEY (`idUsuario`),
  KEY `fk_idRol` (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombre`, `dni`, `clave`, `email`, `idRol`) VALUES
(33, 'Guido M', 123, '$2y$10$oDXzSE7gDeg5c2/dGNJMkeb.W5tm6CSA1fT62yX9zzeNKBLF6IBI.', 'prueba', 1),
(34, 'guido', 1234, '$2y$10$N0wv7a.5zkzos0L5jxZ0W.XguKsP9nnRTcd11FitENhSDDqUpZSuG', 'prueba', 2);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `estacionamiento`
--
ALTER TABLE `estacionamiento`
  ADD CONSTRAINT `fk_idPlayaDeEstacionamiento` FOREIGN KEY (`idPlayaDeEstacionamiento`) REFERENCES `playadeestacionamiento` (`idPlayaDeEstacionamiento`),
  ADD CONSTRAINT `fk_idPlayaDeEstacionamientoHorario` FOREIGN KEY (`idPlayaDeEstacionamientoHorario`) REFERENCES `playadeestacionamientohorario` (`idHorario`),
  ADD CONSTRAINT `fk_idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `playadeestacionamientohorario`
--
ALTER TABLE `playadeestacionamientohorario`
  ADD CONSTRAINT `fk_idPlayaDeEstacionamiento2` FOREIGN KEY (`idPlayaDeEstacionamiento`) REFERENCES `playadeestacionamiento` (`idPlayaDeEstacionamiento`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_idRol` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
