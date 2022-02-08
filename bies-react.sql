-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-02-2022 a las 22:50:34
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.5

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

CREATE TABLE `estacionamiento` (
  `idEstacionamiento` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idPlayaDeEstacionamiento` int(11) NOT NULL,
  `idPlayaDeEstacionamientoHorario` int(11) NOT NULL,
  `fechaEstacionamiento` date NOT NULL,
  `horaInicioEstacionamiento` time NOT NULL,
  `horaFinEstacionamiento` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estacionamiento`
--

INSERT INTO `estacionamiento` (`idEstacionamiento`, `idUsuario`, `idPlayaDeEstacionamiento`, `idPlayaDeEstacionamientoHorario`, `fechaEstacionamiento`, `horaInicioEstacionamiento`, `horaFinEstacionamiento`) VALUES
(53, 34, 1, 24, '2022-02-08', '14:57:34', '14:57:46'),
(54, 34, 1, 24, '2022-02-08', '17:13:34', '17:13:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `playadeestacionamiento`
--

CREATE TABLE `playadeestacionamiento` (
  `idPlayaDeEstacionamiento` int(11) NOT NULL,
  `nombrePlayaDeEstacionamiento` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ubicacion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `capacidad` int(11) NOT NULL,
  `observaciones` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mapa` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `playadeestacionamiento`
--

INSERT INTO `playadeestacionamiento` (`idPlayaDeEstacionamiento`, `nombrePlayaDeEstacionamiento`, `ubicacion`, `capacidad`, `observaciones`, `mapa`) VALUES
(1, 'Supermercado Dar', 'San Jeronimo y Tucuman', 10, 'Techado', 'https://goo.gl/maps/RENstzUGoocLY8rL8'),
(2, 'Tucuman', 'Tucuman y San Martin', 100, 'Varios pisos', 'https://goo.gl/maps/3hkdT6aXGuq79NJi7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `playadeestacionamientohorario`
--

CREATE TABLE `playadeestacionamientohorario` (
  `idHorario` int(11) NOT NULL,
  `idPlayaDeEstacionamiento` int(11) NOT NULL,
  `diaSemana` int(11) NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(11, 2, 3, '16:00:00', '23:00:00'),
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
(22, 1, 0, '12:00:00', '21:00:00'),
(23, 1, 1, '12:00:00', '21:00:00'),
(24, 1, 2, '12:00:00', '21:00:00'),
(25, 1, 3, '16:00:00', '23:07:48'),
(26, 1, 4, '16:00:00', '21:00:00'),
(27, 1, 5, '16:00:00', '21:00:00'),
(30, 1, 6, '16:00:00', '21:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRol` int(11) NOT NULL,
  `nombreRol` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dni` int(11) NOT NULL,
  `clave` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `idRol` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombre`, `dni`, `clave`, `email`, `idRol`) VALUES
(33, 'Guido M', 123, '$2y$10$oDXzSE7gDeg5c2/dGNJMkeb.W5tm6CSA1fT62yX9zzeNKBLF6IBI.', 'prueba', 1),
(34, 'guido', 1234, '$2y$10$N0wv7a.5zkzos0L5jxZ0W.XguKsP9nnRTcd11FitENhSDDqUpZSuG', 'prueba', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estacionamiento`
--
ALTER TABLE `estacionamiento`
  ADD PRIMARY KEY (`idEstacionamiento`),
  ADD KEY `fk_idPlayaDeEstacionamiento` (`idPlayaDeEstacionamiento`),
  ADD KEY `fk_idPlayaDeEstacionamientoHorario` (`idPlayaDeEstacionamientoHorario`),
  ADD KEY `fk_idUsuario` (`idUsuario`);

--
-- Indices de la tabla `playadeestacionamiento`
--
ALTER TABLE `playadeestacionamiento`
  ADD PRIMARY KEY (`idPlayaDeEstacionamiento`);

--
-- Indices de la tabla `playadeestacionamientohorario`
--
ALTER TABLE `playadeestacionamientohorario`
  ADD PRIMARY KEY (`idHorario`),
  ADD KEY `fk_idPlayaDeEstacionamiento2` (`idPlayaDeEstacionamiento`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `fk_idRol` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estacionamiento`
--
ALTER TABLE `estacionamiento`
  MODIFY `idEstacionamiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `playadeestacionamiento`
--
ALTER TABLE `playadeestacionamiento`
  MODIFY `idPlayaDeEstacionamiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `playadeestacionamientohorario`
--
ALTER TABLE `playadeestacionamientohorario`
  MODIFY `idHorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
