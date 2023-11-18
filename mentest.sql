-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2023 a las 19:02:30
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mentest`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_pregunta`
--

CREATE TABLE `estado_pregunta` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_pregunta`
--

INSERT INTO `estado_pregunta` (`id`, `descripcion`) VALUES
(1, 'SUGERIDA'),
(2, 'APROBADA'),
(3, 'REPORTADA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE `partida` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `puntaje` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`id`, `id_usuario`, `puntaje`, `fecha`) VALUES
(32, 2, 0, '2023-10-30 22:53:37'),
(33, 2, 1, '2023-10-30 22:53:46'),
(34, 2, 0, '2023-10-30 22:53:49'),
(35, 2, 1, '2023-10-30 22:53:53'),
(36, 2, 0, '2023-10-30 22:53:56'),
(37, 2, 2, '2023-10-30 22:54:03'),
(38, 2, 8, '2023-10-30 22:54:22'),
(39, 2, 3, '2023-10-31 00:08:20'),
(40, 2, 1, '2023-10-31 00:08:29'),
(41, 2, 0, '2023-10-31 00:08:33'),
(42, 2, 3, '2023-10-31 00:08:40'),
(43, 2, 4, '2023-10-31 00:10:00'),
(44, 2, 3, '2023-10-31 00:14:59'),
(45, 2, 1, '2023-10-31 00:22:14'),
(46, 2, 3, '2023-10-31 00:40:58'),
(47, 2, 0, '2023-10-31 00:45:29'),
(48, 2, 3, '2023-10-31 00:45:36'),
(49, 2, 15, '2023-10-31 01:02:34'),
(50, 2, 1, '2023-11-01 01:18:24'),
(51, 2, 4, '2023-11-01 01:32:42'),
(52, 2, 3, '2023-11-01 01:35:15'),
(53, 1, 0, '2023-11-04 11:04:30'),
(54, 1, 2, '2023-11-04 11:04:37'),
(55, 2, 4, '2023-11-04 11:16:58'),
(56, 2, 3, '2023-11-04 11:17:09'),
(57, 2, 4, '2023-11-04 11:17:18'),
(58, 2, 4, '2023-11-04 11:17:25'),
(59, 2, 9, '2023-11-04 11:17:38'),
(60, 2, 5, '2023-11-05 11:44:43'),
(61, 2, 15, '2023-11-05 11:45:11'),
(62, 2, 5, '2023-11-06 22:22:27'),
(63, 2, 0, '2023-11-06 22:23:15'),
(64, 2, 0, '2023-11-06 22:23:19'),
(65, 2, 0, '2023-11-06 22:23:22'),
(66, 2, 0, '2023-11-06 22:23:25'),
(67, 2, 0, '2023-11-06 22:23:28'),
(68, 2, 0, '2023-11-06 22:24:36'),
(69, 2, 0, '2023-11-06 22:24:39'),
(70, 2, 0, '2023-11-06 22:24:42'),
(71, 2, 7, '2023-11-06 22:25:05'),
(72, 2, 2, '2023-11-11 21:37:00'),
(73, 2, 0, '2023-11-14 20:40:26'),
(74, 2, 4, '2023-11-14 20:48:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id` int(60) NOT NULL,
  `descripcion` varchar(70) NOT NULL,
  `enviada` int(1) NOT NULL DEFAULT 0,
  `id_estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id`, `descripcion`, `enviada`, `id_estado`) VALUES
(1, '¿Cuál es el océano más grande del mundo?', 0, 2),
(2, '¿Quién escribió \"Don Quijote de la Mancha\"?', 0, 2),
(3, '¿Cuál es el símbolo químico del oro?', 0, 2),
(4, '¿En qué país se encuentra la Torre Eiffel?', 0, 2),
(5, '¿Cuál es el planeta más cercano al Sol?', 0, 2),
(6, '¿En qué año se fundó la Organización de las Naciones Unidas (ONU)?', 0, 2),
(7, '¿Cuál es la capital de Australia?', 0, 2),
(8, '¿Cuál es la capital de Japón?', 0, 2),
(9, '¿Cuál es el símbolo químico del oxígeno?', 0, 2),
(10, '¿Quién pintó la Mona Lisa?', 0, 2),
(22, '¿Cuál es la montaña más alta del mundo?', 0, 2),
(23, '¿Cuál es el país más poblado del mundo?', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `id` int(255) NOT NULL,
  `id_pregunta` int(255) NOT NULL,
  `A` varchar(255) NOT NULL,
  `B` varchar(255) NOT NULL,
  `opcionCorrecta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`id`, `id_pregunta`, `A`, `B`, `opcionCorrecta`) VALUES
(1, 1, 'Océano Pacífico', 'Océano Atlántico', 'A'),
(2, 2, 'García Marquez', 'Miguel de Cervantes', 'B'),
(3, 3, 'Au', 'Ag', 'A'),
(4, 4, 'Italia', 'Francia', 'B'),
(5, 5, 'Mercurio', 'Venus', 'A'),
(6, 6, '1955', '1945', 'B'),
(7, 7, 'Canberra', 'Sidney', 'A'),
(8, 8, 'Pekin', 'Tokio', 'B'),
(9, 9, 'O', 'Ox', 'A'),
(10, 10, 'Vincent Van Gogh', 'Leonardo Da Vinci', 'B'),
(22, 22, 'Everest', 'Kilimanjaro', 'A'),
(23, 23, 'Estados Unidos', 'China', 'B');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `descripcion`) VALUES
(0, 'No_validado'),
(1, 'Administrador'),
(2, 'Editor'),
(3, 'Jugador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Id` int(11) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `contrasenia` varchar(100) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `puntaje_max` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id`, `nombre_usuario`, `contrasenia`, `id_rol`, `puntaje_max`) VALUES
(1, 'Emma', '123', 3, 2),
(2, 'Lucas', '123', 2, 15);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estado_pregunta`
--
ALTER TABLE `estado_pregunta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `partida`
--
ALTER TABLE `partida`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_respuesta_pregunta` (`id_pregunta`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `partida`
--
ALTER TABLE `partida`
  ADD CONSTRAINT `fk_usuario_partida` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`Id`);

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `fk_respuesta_pregunta` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
