-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-09-2025 a las 18:32:28
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `zoologico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE `secciones` (
  `id_seccion` int(11) NOT NULL,
  `nomb_seccion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`id_seccion`, `nomb_seccion`) VALUES
(1, 'Mamiferos'),
(2, 'Reptiles'),
(3, 'Aves'),
(4, 'Anfibios'),
(5, 'Peces y Acuaticos'),
(6, 'Insectos y Artropodos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_visitante`
--

CREATE TABLE `tipo_visitante` (
  `id_tipo_visitante` int(11) NOT NULL,
  `nomb_tipo_visitante` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_visitante`
--

INSERT INTO `tipo_visitante` (`id_tipo_visitante`, `nomb_tipo_visitante`) VALUES
(1, 'Publico general'),
(2, 'Estudiante'),
(3, 'Profesor'),
(4, 'Extranjero'),
(5, 'Grupo escolar '),
(6, 'Grupo empresario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `documento` varchar(20) NOT NULL,
  `nomb_usu` varchar(100) NOT NULL,
  `apell_usu` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `celular` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`documento`, `nomb_usu`, `apell_usu`, `correo`, `celular`) VALUES
('1005', 'Kevin Daniel', 'Perez', 'kevindany2209@gmail.com', '3152782654'),
('1006', 'Adriana Paola', 'Perez Duarte', 'adriana071@gmail.com', '31598067'),
('1007', 'Humberto', 'Villafrade', 'humberto2345@gmail.com', '35067878'),
('1008', 'Daniel', 'Zuluaga', 'daniel12123@gmail.com', '5656'),
('1009', 'Nicolas', 'Gomez', 'nicolas0394@gmail.com', '96876'),
('1010', 'Lucas Arvijo', 'Rojo', 'lucasrojo@gmail.com', '54545768'),
('1011', 'Marta', 'Perez', 'marta45@gmail.com', '29856'),
('1012', 'Ana Maria', 'Castillo', 'anam343@gmail.com', '985895'),
('1020', 'kevin', 'ksajdsa', 'kejdks@gmail.com', '231213'),
('1022', 'Luciano', 'Montero', 'luci984@gmail.com', '123123'),
('1023', 'Leonel', 'Garcia', 'leong12@gmail.com', '454433'),
('1030', 'Camilo', 'Fernandez', 'camilo565@gmail.com', '3166767'),
('1199', 'Carlos', 'Duarte', 'carl565@gmail.com', '3166767'),
('1200', 'Max', 'Finch', 'max23@gmail.com', '234232');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE `visitas` (
  `id_visita` int(11) NOT NULL,
  `documento_usu` varchar(20) NOT NULL,
  `id_tipo_visitante` int(11) NOT NULL,
  `fecha_visita` date NOT NULL,
  `hora_entrada` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `visitas`
--

INSERT INTO `visitas` (`id_visita`, `documento_usu`, `id_tipo_visitante`, `fecha_visita`, `hora_entrada`) VALUES
(15, '1007', 1, '2025-09-11', '12:00:00'),
(16, '1005', 2, '2025-09-10', '11:55:00'),
(17, '1011', 5, '2025-09-01', '11:56:00'),
(18, '1006', 5, '2025-08-01', '12:58:00'),
(19, '1006', 4, '2025-09-17', '15:00:00'),
(20, '1005', 5, '2025-09-20', '12:00:00'),
(21, '1006', 1, '2025-09-20', '14:20:00'),
(22, '1007', 2, '2025-09-21', '15:10:00'),
(23, '1008', 3, '2025-09-15', '09:30:00'),
(24, '1012', 1, '2025-08-20', '14:45:00'),
(25, '1009', 2, '2025-09-18', '16:20:00'),
(26, '1010', 5, '2025-09-14', '11:05:00'),
(27, '1005', 3, '2025-09-30', '08:30:00'),
(28, '1005', 1, '2025-10-01', '12:26:00'),
(29, '1199', 4, '2025-09-15', '12:36:00'),
(30, '1023', 2, '2025-10-02', '08:30:00'),
(31, '1200', 1, '2025-10-02', '08:30:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD PRIMARY KEY (`id_seccion`);

--
-- Indices de la tabla `tipo_visitante`
--
ALTER TABLE `tipo_visitante`
  ADD PRIMARY KEY (`id_tipo_visitante`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`documento`);

--
-- Indices de la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`id_visita`),
  ADD KEY `documento_usuario` (`documento_usu`),
  ADD KEY `id_tipo_visitante` (`id_tipo_visitante`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `id_seccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipo_visitante`
--
ALTER TABLE `tipo_visitante`
  MODIFY `id_tipo_visitante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `id_visita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD CONSTRAINT `fk_visitas_usuario` FOREIGN KEY (`documento_usu`) REFERENCES `usuario` (`documento`),
  ADD CONSTRAINT `visitas_ibfk_1` FOREIGN KEY (`documento_usu`) REFERENCES `usuario` (`documento`),
  ADD CONSTRAINT `visitas_ibfk_2` FOREIGN KEY (`id_tipo_visitante`) REFERENCES `tipo_visitante` (`id_tipo_visitante`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
