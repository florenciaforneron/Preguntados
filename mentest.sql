-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-11-2023 a las 10:38:19
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
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `id_color` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`, `id_color`) VALUES
(1, 'Conocimiento general', 1),
(2, 'Programacion PHP', 2),
(3, 'Base de datos', 3),
(4, 'Programación Orientada a Objetos', 4),
(5, 'Estilos en CSS', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `color`
--

CREATE TABLE `color` (
  `id_color` int(11) NOT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `color`
--

INSERT INTO `color` (`id_color`, `color`) VALUES
(1, '#E0707'),
(2, '#0F9668'),
(3, '#DFAE15'),
(4, '#3410F1'),
(5, '#D43CA0');

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
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `nombre`) VALUES
(1, 'Argentina'),
(2, 'Bolivia'),
(3, 'Brasil'),
(4, 'Colombia'),
(5, 'Mexico'),
(6, 'Paraguay'),
(7, 'Peru'),
(8, 'Uruguay'),
(9, 'Venezuela');

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
(36, 1, 5, '2023-10-31 00:22:13'),
(37, 1, 3, '2023-10-31 00:43:14'),
(38, 1, 3, '2023-10-31 00:43:24'),
(39, 1, 3, '2023-10-31 00:44:38'),
(40, 1, 3, '2023-10-31 00:56:18'),
(41, 1, 15, '2023-10-31 01:04:24'),
(42, 1, 2, '2023-11-01 00:56:47'),
(43, 1, 2, '2023-11-07 22:00:32'),
(44, 1, 0, '2023-11-07 22:00:35'),
(45, 1, 6, '2023-11-07 23:18:14'),
(46, 1, 0, '2023-11-07 23:18:34'),
(47, 1, 1, '2023-11-07 23:19:01'),
(48, 1, 1, '2023-11-07 23:23:31'),
(49, 1, 1, '2023-11-07 23:23:40'),
(50, 1, 1, '2023-11-07 23:23:45'),
(51, 1, 1, '2023-11-07 23:26:59'),
(52, 1, 0, '2023-11-07 23:27:21'),
(53, 1, 0, '2023-11-07 23:27:24'),
(54, 1, 1, '2023-11-07 23:27:29'),
(55, 1, 1, '2023-11-07 23:27:47'),
(56, 1, 1, '2023-11-07 23:27:55'),
(57, 1, 6, '2023-11-07 23:31:49'),
(58, 1, 1, '2023-11-07 23:32:10'),
(59, 1, 0, '2023-11-07 23:32:22'),
(60, 1, 8, '2023-11-07 23:32:52'),
(721, 1, 0, '2023-11-27 09:22:01'),
(722, 1, 3, '2023-11-27 09:22:39'),
(723, 1, 0, '2023-11-27 09:29:53'),
(724, 1, 1, '2023-11-27 09:30:03'),
(725, 1, 0, '2023-11-27 09:30:11'),
(726, 1, 1, '2023-11-27 09:30:20'),
(727, 1, 6, '2023-11-27 09:30:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id` int(60) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `enviada` int(1) NOT NULL DEFAULT 0,
  `id_estado` int(11) NOT NULL,
  `id_categoria_fk` int(11) NOT NULL,
  `veces_bien` int(11) NOT NULL,
  `veces_mal` int(11) NOT NULL,
  `es_facil` tinyint(1) NOT NULL DEFAULT 1,
  `fecha_creacion` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id`, `descripcion`, `enviada`, `id_estado`, `id_categoria_fk`, `veces_bien`, `veces_mal`, `es_facil`, `fecha_creacion`) VALUES
(1, '¿Cuál es el océano más grande del mundo?', 0, 2, 1, 44, 8, 1, '2023-11-26'),
(2, '¿Quién escribió \"Don Quijote de la Mancha\"?', 0, 3, 1, 45, 8, 1, '2023-11-26'),
(3, '¿Cuál es el símbolo químico del oro?', 0, 3, 1, 4, 10, 0, '2023-11-26'),
(4, '¿En qué país se encuentra la Torre Eiffel?', 0, 3, 1, 35, 8, 1, '2023-11-26'),
(5, '¿Cuál es el planeta más cercano al Sol?', 0, 3, 1, 44, 5, 1, '2023-11-26'),
(6, '¿En qué año se fundó la Organización de las Naciones Unidas (ONU)?', 0, 2, 1, 45, 6, 1, '2023-11-26'),
(7, '¿Cuál es la capital de Australia?', 0, 2, 1, 36, 10, 1, '2023-11-26'),
(8, '¿Cuál es la capital de Japón?', 0, 2, 1, 37, 5, 1, '2023-11-26'),
(9, '¿Cuál es el símbolo químico del oxígeno?', 0, 3, 1, 54, 6, 1, '2023-11-26'),
(10, '¿Quién pintó la Mona Lisa?', 0, 2, 1, 41, 6, 1, '2023-11-26'),
(44, '¿Qué significa PHP?', 0, 2, 2, 2, 0, 1, '2023-11-26'),
(45, '¿Cuál es el operador utilizado para concatenar cadenas en PHP?', 0, 2, 2, 0, 0, 1, '2023-11-26'),
(46, '¿Cuál es la forma correcta de comentar una línea en PHP?', 0, 2, 2, 0, 0, 1, '2023-11-26'),
(47, '¿Cuál es el resultado de la expresión \"3\" + 2 en PHP?', 0, 2, 2, 0, 1, 1, '2023-11-26'),
(48, '¿Cuál es la función utilizada para obtener la longitud de una cadena en PHP?', 0, 2, 2, 0, 0, 1, '2023-11-26'),
(49, '¿Cuál es el símbolo utilizado para acceder a propiedades de un objeto en PHP?', 0, 2, 2, 0, 0, 1, '2023-11-26'),
(51, '¿Cuál es la función utilizada para obtener la fecha y hora actual en PHP?', 0, 3, 2, 0, 1, 0, '2023-11-26'),
(52, '¿Cuál es la forma correcta de declarar una variable en PHP?', 0, 3, 2, 0, 0, 0, '2023-11-26'),
(53, '¿Cuál es la función utilizada para redirigir a otra página en PHP?', 0, 2, 2, 1, 0, 1, '2023-11-26'),
(54, '¿Qué significa SQL?', 0, 3, 3, 3, 5, 0, '2023-11-26'),
(55, '¿Cuál es el comando utilizado para crear una nueva tabla en MySQL?', 0, 3, 3, 2, 0, 1, '2023-11-26'),
(56, '¿Cuál es el comando utilizado para insertar datos en una tabla en MySQL?', 0, 3, 3, 1, 0, 0, '2023-11-26'),
(57, '¿Cuál es el operador utilizado para combinar múltiples condiciones en una consulta WHERE en MySQL?', 0, 2, 3, 1, 0, 1, '2023-11-26'),
(58, '¿Cuál es la función utilizada para obtener el número de registros en una tabla en MySQL?', 0, 2, 3, 0, 0, 1, '2023-11-26'),
(59, '¿Cuál es el comando utilizado para eliminar una tabla en MySQL?', 0, 3, 3, 1, 1, 0, '2023-11-26'),
(60, '¿Cuál es el comando utilizado para actualizar datos en una tabla en MySQL?', 0, 3, 3, 1, 0, 0, '2023-11-26'),
(61, '¿Cuál es el tipo de dato utilizado para almacenar valores monetarios en MySQL?', 0, 3, 3, 0, 1, 0, '2023-11-26'),
(62, '¿Cuál es el comando utilizado para seleccionar datos de una tabla en MySQL?', 0, 2, 3, 2, 0, 1, '2023-11-26'),
(63, '¿Cuál es la cláusula utilizada para filtrar registros en una consulta SELECT en MySQL?', 0, 2, 3, 1, 0, 1, '2023-11-26'),
(64, '¿Qué es la herencia en POO?', 0, 2, 4, 0, 0, 1, '2023-11-26'),
(65, '¿Cuál palabra clave se utiliza para crear una instancia de una clase en Java?', 0, 2, 4, 0, 0, 1, '2023-11-26'),
(66, '¿Cuál conceptos está asociado con la encapsulación en POO?', 0, 2, 4, 0, 1, 1, '2023-11-26'),
(67, '¿Qué es el polimorfismo en POO?', 0, 2, 4, 0, 0, 1, '2023-11-26'),
(68, '¿Cuál de los siguientes conceptos está asociado con la abstracción en POO?', 0, 2, 4, 0, 1, 1, '2023-11-26'),
(69, '¿Cuál de las siguientes afirmaciones sobre las interfaces en programación orientada a objetos es correcta?', 0, 2, 4, 0, 0, 1, '2023-11-26'),
(70, '¿Qué es la sobrecarga de métodos en una clase de POO?', 0, 2, 4, 0, 0, 1, '2023-11-26'),
(72, '¿Cuál afirmación sobre las clases abstractas en POO es correcta?', 0, 2, 4, 0, 1, 0, '2023-11-26'),
(74, '¿Qué significa CSS?', 0, 2, 5, 0, 0, 1, '2023-11-26'),
(75, '¿Cuál es la forma de aplicar estilos CSS?', 0, 2, 5, 0, 1, 1, '2023-11-26'),
(76, '¿Cuál de los siguientes selectores CSS selecciona un elemento con el id \"myElement\"?', 0, 2, 5, 0, 0, 1, '2023-11-26'),
(77, '¿Cuál de los siguientes selectores CSS selecciona todos los elementos <p> dentro de un <div>?', 0, 2, 5, 2, 0, 1, '2023-11-26'),
(78, '¿Cuál de los siguientes valores representa el color blanco en RGB?', 0, 2, 5, 0, 0, 1, '2023-11-26'),
(79, '¿Cuál propiedad CSS se utiliza para definir el tamaño de fuente?', 0, 2, 5, 0, 0, 1, '2023-11-26'),
(80, '¿Cuál propiedad CSS se utiliza para aplicar un color de fondo a un elemento?', 0, 2, 5, 1, 1, 1, '2023-11-26'),
(81, '¿Cuál propiedad CSS se utiliza para establecer el margen derecho de un elemento?', 0, 2, 5, 0, 0, 1, '2023-11-26'),
(82, '¿Cuál propiedad CSS se utiliza para alinear un elemento al centro horizontalmente?', 0, 2, 5, 0, 0, 1, '2023-11-26'),
(83, '¿Cuál propiedad CSS se utiliza para crear una sombra alrededor de un elemento?', 0, 2, 5, 0, 0, 1, '2023-11-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `id` int(255) NOT NULL,
  `id_pregunta` int(255) NOT NULL,
  `A` varchar(255) NOT NULL,
  `B` varchar(255) NOT NULL,
  `C` varchar(255) NOT NULL,
  `D` varchar(255) NOT NULL,
  `opcionCorrecta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`id`, `id_pregunta`, `A`, `B`, `C`, `D`, `opcionCorrecta`) VALUES
(1, 1, 'Océano Pacífico', 'Océano Atlántico', 'Océano Índico', 'Océano Ártico', 'A'),
(2, 2, 'García Marquez', 'Miguel de Cervantes', 'William Shakespeare', 'Stephen King', 'B'),
(3, 3, 'Au', 'Ag', 'Al', 'Ar', 'A'),
(4, 4, 'Italia', 'Francia', 'Alemania', 'Irak', 'B'),
(5, 5, 'Mercurio', 'Venus', 'Urano', 'Plutón', 'A'),
(6, 6, '1955', '1945', '1953', '1948', 'B'),
(7, 7, 'Canberra', 'Sidney', 'Estambul', 'Milan', 'A'),
(8, 8, 'Pekin', 'Tokio', 'Kioto', 'Osaka', 'B'),
(9, 9, 'O', 'Ox', 'Os', 'Og', 'A'),
(10, 10, 'Rafael Sanzio', 'Leonardo Da Vinci', 'Donato di Niccolò di Betto Bardi (Donatello)', 'Miguel Ángel', 'B'),
(12, 44, 'Hypertext Preprocessor', 'Personal Home Page', 'Pretext Hypertext Processor', 'Hypertext Processor', 'A'),
(13, 45, '+', '&&', '.', ',', 'C'),
(14, 46, '/* This is a comment */', '# This is a comment', '// This is a comment', '-- This is a comment', 'C'),
(15, 47, '5', '32', 'Error', 'NaN', 'A'),
(16, 48, 'length()', 'size()', 'strlen()', 'count()', 'C'),
(17, 49, '.', '->', '::', '/', 'B'),
(18, 51, 'now()', 'currentDateTime()', 'getDate()', 'date()', 'D'),
(19, 52, '$var = 5;', 'var = 5;', 'variable = 5;', '5 = $var;', 'A'),
(20, 53, 'navigateTo()', 'header()', 'redirect()', 'goTo()', 'B'),
(21, 54, 'Structured Query Language', 'Simple Query Language', 'Sequential Query Language', 'Structured Question Language', 'A'),
(22, 55, 'CREATE TABLE', 'ADD TABLE', 'NEW TABLE', 'INSERT TABLE', 'A'),
(23, 56, 'ADD', 'INSERT', 'CREATE', 'UPDATE', 'B'),
(24, 57, 'AND', 'OR', 'NOT', 'XOR', 'A'),
(25, 58, 'COUNT()', 'SUM()', 'MAX()', 'MIN()', 'A'),
(26, 59, 'DROP TABLE', 'DELETE TABLE', 'REMOVE TABLE', 'ERASE TABLE', 'A'),
(27, 60, 'UPDATE', 'ALTER', 'MODIFY', 'CHANGE', 'A'),
(28, 61, 'INT', 'FLOAT', 'CHAR', 'DECIMAL', 'D'),
(29, 62, 'SELECT', 'FETCH', 'GET', 'RETRIEVE', 'A'),
(30, 63, 'WHERE', 'FROM', 'JOIN', 'GROUP BY', 'A'),
(31, 64, 'Crear una nueva clase a partir de una clase existente.', 'Eliminar una clase.', 'Cambiar el nombre de una clase.', 'Dividir una clase en múltiples subclases.', 'A'),
(32, 65, 'new', 'instance', 'create', 'instantiate', 'A'),
(33, 66, 'Limitar el acceso de las variables y acceder mediante métodos.', 'Crear múltiples instancias de una clase.', 'Modificar una clase durante la ejecución.', 'Establecer una relación de parentesco entre clases.', 'A'),
(34, 67, 'Que una clase herede comportamientos de otra.', 'Que una clase tenga múltiples métodos con el mismo nombre pero con diferentes implementaciones.', 'Que una clase herede una interfaz e implemente sus métodos.', 'Todas las anteriores son correctas.', 'B'),
(35, 68, 'Representar una idea o concepto mediante una clase.', 'Crear múltiples instancias de una clase.', 'Modificar el comportamiento de una clase en tiempo de ejecución.', 'Establecer una relación de parentesco entre clases.', 'A'),
(36, 69, 'Una interfaz define un contrato que una clase puede implementar.', 'Una interfaz es una clase abstracta.', 'Una interfaz solo puede contener métodos abstractos.', 'Una clase puede implementar múltiples interfaces.', 'D'),
(37, 70, 'Heredar propiedades y comportamientos de una clase padre.', 'Múltiples métodos con el mismo nombre pero con diferentes parámetros.', 'Ocultar las variables y proporcionar una interfaz para acceder a ellos.', 'Crear múltiples instancias de sí misma.', 'B'),
(38, 72, 'Puede tener métodos abstractos y métodos con implementación.', 'No puede tener constructores.', 'No puede ser heredada.', 'Solo puede tener métodos abstractos.', 'A'),
(39, 74, 'Cascading Style Sheets', 'Creative Style Solutions', 'Code Styling Syntax', 'Coded Style System', 'A'),
(40, 75, 'Utilizando el atributo \"style\" en la etiqueta HTML.', 'Creando una etiqueta <style> en el documento HTML.', 'Enlazando un archivo externo CSS.', 'Todas las anteriores.', 'D'),
(41, 76, '#myElement', '.myElement', 'myElement', '*myElement', 'A'),
(42, 77, 'div p', 'p div', '.p div', '#div p', 'A'),
(43, 78, '#ffffff', '#000000', '#ff0000', '#00ff00', 'A'),
(44, 79, 'font-size', 'font-family', 'font-weight', 'font-color', 'A'),
(45, 80, 'background-color', 'color', 'border-color', 'text-color', 'A'),
(46, 81, 'margin-right', 'margin-left', 'margin-top', 'margin-bottom', 'A'),
(47, 82, 'text-align: center', 'text-align: left', 'text-align: right', 'text-align: justify', 'A'),
(48, 83, 'box-shadow', 'text-shadow', 'border-shadow', 'element-shadow', 'A');

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
  `mail` varchar(255) NOT NULL,
  `contrasenia` varchar(100) NOT NULL,
  `puntaje_max` int(255) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `novato` tinyint(1) NOT NULL DEFAULT 1,
  `nombreCompleto` varchar(200) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `sexo` varchar(200) NOT NULL,
  `id_pais` int(30) NOT NULL,
  `veces_bien` int(11) NOT NULL DEFAULT 0,
  `veces_mal` int(11) DEFAULT 0,
  `fecha_registro` date NOT NULL DEFAULT current_timestamp(),
  `foto_perfil` varchar(255) DEFAULT 'perfil_default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id`, `nombre_usuario`, `mail`, `contrasenia`, `puntaje_max`, `id_rol`, `novato`, `nombreCompleto`, `fecha_nacimiento`, `sexo`, `id_pais`, `veces_bien`, `veces_mal`, `fecha_registro`, `foto_perfil`) VALUES
(1, 'Emma', '', '202cb962ac59075b964b07152d234b70', 0, 3, 0, '', '2023-11-26', '', 1, 20, 14, '2023-11-26', 'perfil_default.jpg'),
(2, 'Lucas', '', '202cb962ac59075b964b07152d234b70', 0, 2, 0, '', '2023-11-26', '', 4, 22, 6, '2023-11-26', ''),
(3, 'Manu', '', '202cb962ac59075b964b07152d234b70', 0, 3, 0, '', '2023-11-26', '', 8, 6, 3, '2023-11-26', 'perfil_default.jpg'),
(4, 'Ivan', '', '202cb962ac59075b964b07152d234b70', 0, 1, 1, '', '2023-11-26', '', 3, 0, 0, '2023-11-26', ''),
(6, 'admin', 'admin@admin.com', '202cb962ac59075b964b07152d234b70', 0, 1, 1, 'Admin Perfil', '2000-11-18', 'Masculino', 1, 0, 0, '2023-11-26', ''),
(7, 'editor', 'editor@editor.com', '202cb962ac59075b964b07152d234b70', 0, 2, 1, 'Editor Perfil', '2000-11-18', 'Masculino', 1, 0, 0, '2023-11-26', ''),
(14, 'aivan', 'ivancarr03@gmail.com', '202cb962ac59075b964b07152d234b70', 50, 3, 1, 'Ivan Carreño', '2000-11-18', 'Masculino', 1, 0, 0, '2023-11-27', 'prueba.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `fk_categoria_color` (`id_color`);

--
-- Indices de la tabla `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id_color`);

--
-- Indices de la tabla `estado_pregunta`
--
ALTER TABLE `estado_pregunta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
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
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `fk_pregunta_categoria` (`id_categoria_fk`);

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
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_pais` (`id_pais`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=728;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_categoria_color` FOREIGN KEY (`id_color`) REFERENCES `color` (`id_color`);

--
-- Filtros para la tabla `partida`
--
ALTER TABLE `partida`
  ADD CONSTRAINT `fk_usuario_partida` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`Id`);

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `fk_pregunta_categoria` FOREIGN KEY (`id_categoria_fk`) REFERENCES `categoria` (`id_categoria`);

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `fk_respuesta_pregunta` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
