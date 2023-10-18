-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2023 at 02:41 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mentest`
--

-- --------------------------------------------------------

--
-- Table structure for table `pregunta`
--

CREATE TABLE `pregunta` (
  `id` int(60) NOT NULL,
  `descripcion` varchar(70) NOT NULL,
  `1` varchar(30) NOT NULL,
  `2` varchar(30) NOT NULL,
  `resp_correcta` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pregunta`
--

INSERT INTO `pregunta` (`id`, `descripcion`, `1`, `2`, `resp_correcta`) VALUES
(1, '¿Cuál es el océano más grande del mundo?', 'Océano Pacífico', 'Océano Atlántico', 1),
(2, '¿Quién escribió \"Don Quijote de la Mancha\"?', 'García Márquez', 'Miguel de Cervantes', 2),
(3, '¿Cuál es el símbolo químico del oro?', 'Au', 'Ag', 1),
(4, '¿En qué país se encuentra la Torre Eiffel?', 'Italia', 'Francia', 2),
(5, '¿Cuál es el planeta más cercano al Sol?', 'Mercurio', 'Venus', 1),
(6, '¿En qué año se fundó la Organización de las Naciones Unidas (ONU)?', '1955', '1945', 2),
(7, '¿Cuál es la capital de Australia?', 'Canberra', 'Sidney', 1),
(8, '¿Cuál es la capital de Japón?', 'Pekín', 'Tokio', 2),
(9, '¿Cuál es el símbolo químico del oxígeno?', 'O', 'Ox', 1),
(10, '¿Quién pintó la Mona Lisa?', 'Vincent van Gogh', 'Leonardo da Vinci', 2);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `Id` int(11) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `contrasenia` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`Id`, `nombre_usuario`, `contrasenia`) VALUES
(1, 'Emma', '456789');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
