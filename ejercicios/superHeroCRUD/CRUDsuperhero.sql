-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 06, 2023 at 11:45 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CRUDsuperhero`
--

-- --------------------------------------------------------

--
-- Table structure for table `ciudadanos`
--

CREATE TABLE `ciudadanos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `ciudadanos`
--

INSERT INTO `ciudadanos` (`id`, `nombre`, `email`, `idUsuario`, `created_at`, `updated_at`) VALUES
(1, 'Ciudadano1', 'ciudadano@gmail.com', 2, '2023-02-06 22:43:30', '2023-02-06 22:43:30'),
(2, 'Ciudadano2', 'ciudadano2@gmail.com', 3, '2023-02-06 22:43:41', '2023-02-06 22:43:41');

-- --------------------------------------------------------

--
-- Table structure for table `evolucion`
--

CREATE TABLE `evolucion` (
  `evolucion` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `habilidades`
--

CREATE TABLE `habilidades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `habilidades`
--

INSERT INTO `habilidades` (`id`, `nombre`, `created_at`, `update_at`) VALUES
(4, 'Volar', '2023-02-06 22:35:37', '2023-02-06 22:35:37'),
(5, 'SuperFuerza', '2023-02-06 22:35:49', '2023-02-06 22:35:49'),
(6, 'Mjölnir', '2023-02-06 22:36:19', '2023-02-06 22:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `peticiones`
--

CREATE TABLE `peticiones` (
  `id` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `realizada` enum('0','1') NOT NULL,
  `idSuperHeroe` int(11) NOT NULL,
  `idCiudadano` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `peticiones`
--

INSERT INTO `peticiones` (`id`, `titulo`, `descripcion`, `realizada`, `idSuperHeroe`, `idCiudadano`, `created_at`, `updated_at`) VALUES
(2, 'Peti1', 'Peta1', '0', 1, 2, '2023-02-06 22:41:30', '2023-02-06 22:41:30'),
(3, 'Peti2', 'Peta2', '1', 3, 3, '2023-02-06 22:41:54', '2023-02-06 22:41:54');

-- --------------------------------------------------------

--
-- Table structure for table `superheroes`
--

CREATE TABLE `superheroes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `psw` varchar(50) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `evolución` int(1) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `superheroes`
--

INSERT INTO `superheroes` (`id`, `nombre`, `psw`, `imagen`, `evolución`, `idUsuario`, `created_at`, `updated_at`) VALUES
(1, 'IronMan', 'ironpass', 'imgIronman', 0, 2, '2023-02-06 21:33:47', '2023-02-06 21:33:47'),
(2, 'SpiderMan]', 'spider pass', 'imgSpiderMan', 0, 3, '2023-02-06 21:33:54', '2023-02-06 21:33:54'),
(3, 'Hulk', 'hulkpass', 'imgHulk', 0, 4, '2023-02-06 21:33:33', '2023-02-06 21:33:33');

-- --------------------------------------------------------

--
-- Table structure for table `superheroes_habilidades`
--

CREATE TABLE `superheroes_habilidades` (
  `id` int(11) NOT NULL,
  `idSuperHeroe` int(11) NOT NULL,
  `idHabilidad` int(11) NOT NULL,
  `valor` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `superheroes_habilidades`
--

INSERT INTO `superheroes_habilidades` (`id`, `idSuperHeroe`, `idHabilidad`, `valor`) VALUES
(2, 1, 1, 35),
(3, 3, 2, 50);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `psw` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `usuario`, `psw`, `created_at`, `updated_at`) VALUES
(1, 'user1', 'pass1', '2023-02-06 00:10:31', '2023-02-06 00:10:31'),
(2, 'user2', 'c1572d05424d0ecb2a65ec6a82aeacbf', '2023-02-06 00:14:21', '2023-02-06 00:14:21'),
(3, 'user3', '3afc79b597f88a72528e864cf81856d2', '2023-02-06 00:15:14', '2023-02-06 00:15:14'),
(4, 'user4', 'fc2921d9057ac44e549efaf0048b2512', '2023-02-06 00:21:37', '2023-02-06 00:21:37'),
(5, 'user5', 'd35f6fa9a79434bcd17f8049714ebfcb', '2023-02-06 00:21:43', '2023-02-06 00:21:43'),
(6, 'user5', 'd35f6fa9a79434bcd17f8049714ebfcb', '2023-02-06 00:21:49', '2023-02-06 00:21:49'),
(8, 'user2', 'c1572d05424d0ecb2a65ec6a82aeacbf', '2023-02-06 00:39:29', '2023-02-06 00:39:29'),
(9, 'userX', 'd13ce3810d82c576a5935a3a1d750cd2', '2023-02-06 00:43:09', '2023-02-06 00:43:09'),
(10, 'userX', 'd13ce3810d82c576a5935a3a1d750cd2', '2023-02-06 00:43:23', '2023-02-06 00:43:23'),
(11, 'userX', 'd13ce3810d82c576a5935a3a1d750cd2', '2023-02-06 00:43:34', '2023-02-06 00:43:34'),
(12, 'user2', 'c1572d05424d0ecb2a65ec6a82aeacbf', '2023-02-06 09:45:32', '2023-02-06 09:45:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ciudadanos`
--
ALTER TABLE `ciudadanos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evolucion`
--
ALTER TABLE `evolucion`
  ADD PRIMARY KEY (`evolucion`);

--
-- Indexes for table `habilidades`
--
ALTER TABLE `habilidades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peticiones`
--
ALTER TABLE `peticiones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idSH` (`idSuperHeroe`),
  ADD KEY `idCi` (`idCiudadano`);

--
-- Indexes for table `superheroes`
--
ALTER TABLE `superheroes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indexes for table `superheroes_habilidades`
--
ALTER TABLE `superheroes_habilidades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idHab` (`idHabilidad`),
  ADD KEY `idHabSH` (`idSuperHeroe`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ciudadanos`
--
ALTER TABLE `ciudadanos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `habilidades`
--
ALTER TABLE `habilidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `peticiones`
--
ALTER TABLE `peticiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `superheroes`
--
ALTER TABLE `superheroes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `superheroes_habilidades`
--
ALTER TABLE `superheroes_habilidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `evolucion`
--
ALTER TABLE `evolucion`
  ADD CONSTRAINT `idEvo` FOREIGN KEY (`evolucion`) REFERENCES `superheroes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `superheroes`
--
ALTER TABLE `superheroes`
  ADD CONSTRAINT `idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
