-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 19-01-2022 a las 16:32:55
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estacionamiento`
--

INSERT INTO `estacionamiento` (`idEstacionamiento`, `idUsuario`, `idPlayaDeEstacionamiento`, `idPlayaDeEstacionamientoHorario`, `fechaEstacionamiento`, `horaInicioEstacionamiento`, `horaFinEstacionamiento`) VALUES
(8, 1, 1, 16, '2021-09-21', '11:30:00', NULL),
(10, 2, 2, 1, '2021-09-20', '11:00:00', NULL);

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
  PRIMARY KEY (`idPlayaDeEstacionamiento`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `playadeestacionamiento`
--

INSERT INTO `playadeestacionamiento` (`idPlayaDeEstacionamiento`, `nombrePlayaDeEstacionamiento`, `ubicacion`, `capacidad`, `observaciones`, `mapa`) VALUES
(1, 'Supermercado Dar', 'San Jeronimo y Tucuman', 10, 'holis', NULL),
(2, 'Estacionamiento Tucuman', 'Estacionamiento Tucuman y San Martin', 100, NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `playadeestacionamientohorario`
--

INSERT INTO `playadeestacionamientohorario` (`idHorario`, `idPlayaDeEstacionamiento`, `diaSemana`, `horaInicio`, `horaFin`) VALUES
(1, 2, 0, '08:00:00', '13:00:00'),
(2, 2, 1, '08:00:00', '13:00:00'),
(3, 2, 2, '08:00:00', '13:00:00'),
(4, 2, 3, '08:00:00', '13:00:00'),
(5, 2, 4, '08:00:00', '13:00:00'),
(6, 2, 5, '08:00:00', '13:00:00'),
(7, 2, 6, '08:00:00', '13:00:00'),
(8, 2, 0, '16:00:00', '20:00:00'),
(9, 2, 1, '16:00:00', '20:00:00'),
(10, 2, 2, '16:00:00', '20:00:00'),
(11, 2, 3, '16:00:00', '20:00:00'),
(12, 2, 4, '16:00:00', '20:00:00'),
(13, 2, 5, '16:00:00', '20:00:00'),
(14, 2, 6, '16:00:00', '20:00:00'),
(15, 1, 0, '08:00:00', '12:00:00'),
(16, 1, 1, '08:00:00', '12:00:00'),
(17, 1, 2, '08:00:00', '12:00:00'),
(18, 1, 3, '08:00:00', '12:00:00'),
(19, 1, 4, '08:00:00', '12:00:00'),
(20, 1, 5, '08:00:00', '12:00:00'),
(21, 1, 6, '08:00:00', '12:00:00'),
(22, 1, 0, '16:00:00', '21:00:00'),
(23, 1, 1, '16:00:00', '21:00:00'),
(24, 1, 2, '16:00:00', '21:00:00'),
(25, 1, 3, '16:00:00', '21:00:00'),
(26, 1, 4, '16:00:00', '21:00:00'),
(27, 1, 5, '16:00:00', '21:00:00'),
(28, 1, 6, '16:00:00', '21:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombre`, `dni`, `clave`, `email`, `idRol`) VALUES
(1, 'Guido ', 37774564, 'guido', 'guido_magi@hotmail.com', 1),
(2, 'juani', 1, '2', 'email@email.com', 2),
(3, 'Prueba 2', 10, '$2y$10$nWfFc/qpnmaPuv0xqN8m9.GEsGGPCIMdrlrmXWdC/pUd1VaHI3R2C', 'probando', 2),
(4, 'Juani Prueba', 22, 'prueba', 'prueba@probando.com', 2),
(27, 'Guido', 123, '$2y$10$NEFK1QpZcR4GYDbu5TWz5ebdGn9tpfreqtfywe6AIck7Refphzmi6', 'probando', 2);

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
  ADD CONSTRAINT `fk_idPlayaDeEstacionamiento2` FOREIGN KEY (`idPlayaDeEstacionamiento`) REFERENCES `playadeestacionamiento` (`idPlayaDeEstacionamiento`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_idRol` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
