-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 07-02-2025 a las 16:10:49
-- Versión del servidor: 9.1.0
-- Versión de PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_bluevideo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuarios` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `apellidos` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contrasena` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rol` int DEFAULT NULL,
  `estado` enum('registrado','validado') COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_usuarios`),
  KEY `rol_fk` (`rol`) INVISIBLE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuarios`, `nombre`, `apellidos`, `email`, `contrasena`, `rol`, `estado`) VALUES
(1, 'PolMarc', 'Montero Roca', 'polmarc@bluevideo.com', '$2y$10$63MsECtlpPcIdD2aUMg.le7zgnAsqDUSGY2MLL1b91U179gCXzUee', 1, 'registrado'),
(7, 'Marcos', 'Navajas', 'marcos@bluevideo.com', '$2y$10$aOEt1VN8ZtNvAJSHdWeew.xIPjEhXNIG5Qq/rTyOseQ/GmT.QBP2y', 1, 'validado'),
(8, 'Alex', 'Ventura', 'alex@bluevideo.com', '$2y$10$giY7gGJGuzBAlpF/QLU58.IfikB37csosYYqjbMOCtXtzuuY5MQWK', 1, 'registrado'),
(18, 'JuanCarlos', 'DelPrado', 'juanca.joan23@fje.edu', 'asdASD123', 1, 'registrado');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `rol_fk` FOREIGN KEY (`rol`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
