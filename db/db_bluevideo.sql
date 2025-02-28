-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 07-02-2025 a las 16:15:28
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
CREATE DATABASE IF NOT EXISTS `db_bluevideo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_bluevideo`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actores`
--

DROP TABLE IF EXISTS `actores`;
CREATE TABLE IF NOT EXISTS `actores` (
  `id_actor` int NOT NULL AUTO_INCREMENT,
  `nombre_actor` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_actor`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actores`
--

INSERT INTO `actores` (`id_actor`, `nombre_actor`) VALUES
(1, 'Tim Robbins'),
(2, 'Morgan Freeman'),
(3, 'Marlon Brando'),
(4, 'Al Pacino'),
(5, 'John Travolta'),
(6, 'Leonardo DiCaprio'),
(7, 'Keanu Reeves'),
(8, 'Liam Neeson'),
(9, 'Jodie Foster'),
(10, 'Tom Hanks'),
(11, 'Brad Pitt'),
(12, 'Edward Norton'),
(13, 'Christoph Waltz'),
(14, 'Matthew McConaughey'),
(15, 'Ryan Gosling'),
(16, 'Matt Damon'),
(17, 'Robert De Niro'),
(18, 'Emma Stone'),
(19, 'Ryan Reynolds'),
(20, 'Natalie Portman');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actor_pelicula`
--

DROP TABLE IF EXISTS `actor_pelicula`;
CREATE TABLE IF NOT EXISTS `actor_pelicula` (
  `id_actor_pelicula` int NOT NULL AUTO_INCREMENT,
  `id_actor` int NOT NULL,
  `id_pelicula` int NOT NULL,
  PRIMARY KEY (`id_actor_pelicula`),
  KEY `id_actor_fk` (`id_actor`),
  KEY `id_pelicula_fk_2` (`id_pelicula`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actor_pelicula`
--

INSERT INTO `actor_pelicula` (`id_actor_pelicula`, `id_actor`, `id_pelicula`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 16, 1),
(4, 3, 2),
(5, 4, 2),
(6, 17, 2),
(7, 5, 3),
(8, 6, 3),
(9, 18, 3),
(10, 7, 4),
(11, 8, 4),
(12, 19, 4),
(13, 9, 5),
(14, 10, 5),
(15, 20, 5),
(16, 11, 6),
(17, 12, 6),
(18, 1, 6),
(19, 13, 7),
(20, 14, 7),
(21, 2, 7),
(22, 15, 8),
(23, 1, 8),
(24, 3, 8),
(25, 2, 9),
(26, 9, 9),
(27, 4, 9),
(28, 3, 10),
(29, 8, 10),
(30, 5, 10),
(31, 4, 11),
(32, 10, 11),
(33, 6, 11),
(34, 5, 12),
(35, 12, 12),
(36, 7, 12),
(37, 6, 13),
(38, 3, 13),
(39, 8, 13),
(40, 7, 14),
(41, 11, 14),
(42, 9, 14),
(43, 8, 15),
(44, 15, 15),
(45, 10, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directores`
--

DROP TABLE IF EXISTS `directores`;
CREATE TABLE IF NOT EXISTS `directores` (
  `id_director` int NOT NULL AUTO_INCREMENT,
  `nombre_director` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_director`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `directores`
--

INSERT INTO `directores` (`id_director`, `nombre_director`) VALUES
(1, 'Frank Darabont'),
(2, 'Francis Ford Coppola'),
(3, 'Quentin Tarantino'),
(4, 'Christopher Nolan'),
(5, 'Robert Zemeckis'),
(6, 'Lana Wachowski'),
(7, 'Steven Spielberg'),
(8, 'James Cameron'),
(9, 'Jonathan Demme'),
(10, 'Peter Jackson'),
(11, 'David Fincher'),
(12, 'Quentin Tarantino'),
(13, 'Christopher Nolan'),
(14, 'Damien Chazelle'),
(15, 'Martin Scorsese');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `director_pelicula`
--

DROP TABLE IF EXISTS `director_pelicula`;
CREATE TABLE IF NOT EXISTS `director_pelicula` (
  `id_director_pelicula` int NOT NULL AUTO_INCREMENT,
  `id_director` int NOT NULL,
  `id_pelicula` int NOT NULL,
  PRIMARY KEY (`id_director_pelicula`),
  KEY `id_director_fk` (`id_director`),
  KEY `id_pelicula_fk_3` (`id_pelicula`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `director_pelicula`
--

INSERT INTO `director_pelicula` (`id_director_pelicula`, `id_director`, `id_pelicula`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 4, 6),
(7, 6, 7),
(8, 8, 8),
(9, 9, 9),
(10, 10, 10),
(11, 11, 11),
(12, 12, 12),
(13, 3, 13),
(14, 4, 14),
(15, 14, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

DROP TABLE IF EXISTS `genero`;
CREATE TABLE IF NOT EXISTS `genero` (
  `id_genero` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_genero`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id_genero`, `nombre`) VALUES
(1, 'Drama'),
(2, 'Comedia'),
(3, 'Acción'),
(4, 'Ciencia Ficción'),
(5, 'Romance'),
(6, 'Thriller'),
(7, 'Animación'),
(8, 'Aventura'),
(9, 'Fantasía'),
(10, 'Misterio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id_likes` int NOT NULL AUTO_INCREMENT,
  `usuario` int DEFAULT NULL,
  `like/dislike` decimal(1,0) DEFAULT NULL,
  `id_pelicula` int DEFAULT NULL,
  PRIMARY KEY (`id_likes`),
  KEY `id_pelicula_fk` (`id_pelicula`),
  KEY `usuario_fk` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`id_likes`, `usuario`, `like/dislike`, `id_pelicula`) VALUES
(1, 8, 1, 2),
(2, 8, 1, 1),
(5, 8, 0, 1),
(6, 8, 1, 1),
(7, 8, 1, 2),
(8, 8, 1, 2),
(9, 8, 1, 1),
(10, 8, 1, 1),
(11, 8, 1, 2),
(12, 1, 1, 3),
(13, 1, 1, 3),
(14, 1, 1, 3),
(15, 7, 1, 4),
(16, 7, 1, 4),
(18, 8, 1, 6),
(19, 8, 1, 2),
(20, 8, 1, 1),
(21, 1, 1, 6),
(22, 1, 0, 7),
(23, 1, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

DROP TABLE IF EXISTS `peliculas`;
CREATE TABLE IF NOT EXISTS `peliculas` (
  `id_pelicula` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descripcion` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ano` decimal(4,0) DEFAULT NULL,
  `genero` int DEFAULT NULL,
  `edad` decimal(2,0) DEFAULT NULL,
  `portada` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `trailer` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pelicula` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `logo` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_pelicula`),
  KEY `genero_fk` (`genero`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id_pelicula`, `nombre`, `descripcion`, `ano`, `genero`, `edad`, `portada`, `trailer`, `pelicula`, `logo`) VALUES
(1, 'Sueños de fuga', 'Dos hombres encarcelados entablan una amistad a lo largo de los años, encontrando consuelo y redención eventual a través de actos de decencia común.', 1994, 1, 17, 'sueno_de_fuga.jpg', 'sueños de fuga trailer.mp4', 'pelicula_sueno_de_fuga.mp4', 'logo_sueno_de_fuga.jpg'),
(2, 'El Padrino', 'El patriarca envejecido de una dinastía del crimen organizado transfiere el control de su imperio clandestino a su hijo reacio.', 1972, 1, 18, 'el_padrino.jpg', 'trailer_el_padrino.mp4', 'pelicula_el_padrino.mp4', 'logo_el_padrino.jpg'),
(3, 'Tiempos violentos', 'Las vidas de dos sicarios, un boxeador, un gángster y su esposa, y una pareja de bandidos de un restaurante se entrelazan en cuatro historias de violencia y redención.', 1994, 6, 17, 'tiempos_violentos.jpg', 'trailer_tiempos_violentos.mp4', 'pelicula_tiempos_violentos.mp4', 'logo_tiempos_violentos.jpg'),
(4, 'El Caballero de la Noche', 'Cuando la amenaza conocida como El Joker emerge de su pasado misterioso, siembra el caos y la destrucción en la gente de Gotham.', 2008, 3, 15, 'el_caballero_de_la_noche.jpg', 'trailer_el_caballero_de_la_noche.mp4', 'pelicula_el_caballero_de_la_noche.mp4', 'logo_el_caballero_de_la_noche.jpg'),
(5, 'Forrest Gump', 'Las presidencias de Kennedy y Johnson, la Guerra de Vietnam, el escándalo de Watergate y otros eventos históricos se desarrollan desde la perspectiva de un hombre de Alabama con un coeficiente intelectual de 75.', 1994, 2, 13, 'forrest_gump.jpg', 'trailer_forrest_gump.mp4', 'pelicula_forrest_gump.mp4', 'logo_forrest_gump.jpg'),
(6, 'Origen', 'Un ladrón que roba secretos corporativos mediante el uso de la tecnología de intercambio de sueños recibe la tarea inversa de plantar una idea en la mente de un CEO.', 2010, 3, 15, 'origen.jpg', 'trailer_origen.mp4', 'pelicula_origen.mp4', 'logo_origen.jpg'),
(7, 'Matrix', 'Un hacker de computadoras aprende de rebeldes misteriosos sobre la verdadera naturaleza de su realidad y su papel en la guerra contra sus controladores.', 1999, 3, 15, 'matrix.jpg', 'trailer_matrix.mp4', 'pelicula_matrix.mp4', 'logo_matrix.jpg'),
(8, 'La Lista de Schindler', 'En la Polonia ocupada por los alemanes durante la Segunda Guerra Mundial, el industrial Oskar Schindler se preocupa gradualmente por su fuerza laboral judía después de presenciar su persecución por los nazis.', 1993, 1, 17, 'la_lista_de_schindler.jpg', 'trailer_la_lista_de_schindler.mp4', 'pelicula_la_lista_de_schindler.mp4', 'logo_la_lista_de_schindler.jpg'),
(9, 'Titanic', 'Un aristócrata de diecisiete años se enamora de un artista amable pero pobre a bordo del lujoso y condenado R.M.S. Titanic.', 1997, 5, 13, 'titanic.jpg', 'trailer_titanic.mp4', 'pelicula_titanic.mp4', 'logo_titanic.jpg'),
(10, 'El Silencio de los Corderos', 'Una joven cadete del F.B.I. debe recibir la ayuda de un asesino caníbal encarcelado y manipulador para ayudar a atrapar a otro asesino en serie, un maníaco que pela a sus víctimas.', 1991, 6, 18, 'el_silencio_de_los_corderos.jpg', 'trailer_el_silencio_de_los_corderos.mp4', 'pelicula_el_silencio_de_los_corderos.mp4', 'logo_el_silencio_de_los_corderos.jpg'),
(11, 'El Señor de los Anillos: El Retorno del Rey', 'Gandalf y Aragorn lideran al Mundo de los Hombres contra el ejército de Sauron para desviar la mirada de Frodo y Sam mientras se acercan al Monte del Destino con el Anillo Único.', 2003, 8, 15, 'el_retorno_del_rey.jpg', 'trailer_el_retorno_del_rey.mp4', 'pelicula_el_retorno_del_rey.mp4', 'logo_el_retorno_del_rey.jpg'),
(12, 'El Club de la Pelea', 'Un trabajador de oficina insomne y un fabricante de jabón despreocupado forman un club de lucha clandestino que evoluciona hacia algo mucho, mucho más.', 1999, 6, 18, 'el_club_de_la_pelea.jpg', 'trailer_el_club_de_la_pelea.mp4', 'pelicula_el_club_de_la_pelea.mp4', 'logo_el_club_de_la_pelea.jpg'),
(13, 'Bastardos sin Gloria', 'En la Francia ocupada por los nazis durante la Segunda Guerra Mundial, un plan para asesinar a líderes nazis por un grupo de soldados judíos estadounidenses coincide con los planes vengativos de un propietario de un teatro.', 2009, 1, 18, 'bastardos_sin_gloria.jpg', 'trailer_bastardos_sin_gloria.mp4', 'pelicula_bastardos_sin_gloria.mp4', 'logo_bastardos_sin_gloria.jpg'),
(14, 'Interestelar', 'Un grupo de exploradores espaciales se embarca en un viaje interestelar para encontrar un nuevo hogar para la humanidad.', 2014, 3, 13, 'interestelar.jpg', 'trailer_interestelar.mp4', 'pelicula_interestelar.mp4', 'logo_interestelar.jpg'),
(15, 'La La Land', 'En Los Ángeles, un pianista de jazz se enamora de una aspirante a actriz mientras ambos buscan alcanzar sus sueños en una ciudad conocida por destruir esperanzas y romances.', 2016, 5, 13, 'la_la_land.jpg', 'trailer_la_la_land.mp4', 'pelicula_la_la_land.mp4', 'logo_la_la_land.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id_rol` int NOT NULL AUTO_INCREMENT,
  `rol` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(1, 'Cliente'),
(2, 'Administrador');

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
-- Filtros para la tabla `actor_pelicula`
--
ALTER TABLE `actor_pelicula`
  ADD CONSTRAINT `id_actor_fk` FOREIGN KEY (`id_actor`) REFERENCES `actores` (`id_actor`),
  ADD CONSTRAINT `id_pelicula_fk_2` FOREIGN KEY (`id_pelicula`) REFERENCES `peliculas` (`id_pelicula`);

--
-- Filtros para la tabla `director_pelicula`
--
ALTER TABLE `director_pelicula`
  ADD CONSTRAINT `id_director_fk` FOREIGN KEY (`id_director`) REFERENCES `directores` (`id_director`),
  ADD CONSTRAINT `id_pelicula_fk_3` FOREIGN KEY (`id_pelicula`) REFERENCES `peliculas` (`id_pelicula`);

--
-- Filtros para la tabla `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `id_pelicula_fk` FOREIGN KEY (`id_pelicula`) REFERENCES `peliculas` (`id_pelicula`),
  ADD CONSTRAINT `usuario_fk` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id_usuarios`);

--
-- Filtros para la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD CONSTRAINT `genero_fk` FOREIGN KEY (`genero`) REFERENCES `genero` (`id_genero`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `rol_fk` FOREIGN KEY (`rol`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 07-02-2025 a las 16:15:28
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
CREATE DATABASE IF NOT EXISTS `db_bluevideo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_bluevideo`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actores`
--

DROP TABLE IF EXISTS `actores`;
CREATE TABLE IF NOT EXISTS `actores` (
  `id_actor` int NOT NULL AUTO_INCREMENT,
  `nombre_actor` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_actor`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actores`
--

INSERT INTO `actores` (`id_actor`, `nombre_actor`) VALUES
(1, 'Tim Robbins'),
(2, 'Morgan Freeman'),
(3, 'Marlon Brando'),
(4, 'Al Pacino'),
(5, 'John Travolta'),
(6, 'Leonardo DiCaprio'),
(7, 'Keanu Reeves'),
(8, 'Liam Neeson'),
(9, 'Jodie Foster'),
(10, 'Tom Hanks'),
(11, 'Brad Pitt'),
(12, 'Edward Norton'),
(13, 'Christoph Waltz'),
(14, 'Matthew McConaughey'),
(15, 'Ryan Gosling'),
(16, 'Matt Damon'),
(17, 'Robert De Niro'),
(18, 'Emma Stone'),
(19, 'Ryan Reynolds'),
(20, 'Natalie Portman');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actor_pelicula`
--

DROP TABLE IF EXISTS `actor_pelicula`;
CREATE TABLE IF NOT EXISTS `actor_pelicula` (
  `id_actor_pelicula` int NOT NULL AUTO_INCREMENT,
  `id_actor` int NOT NULL,
  `id_pelicula` int NOT NULL,
  PRIMARY KEY (`id_actor_pelicula`),
  KEY `id_actor_fk` (`id_actor`),
  KEY `id_pelicula_fk_2` (`id_pelicula`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actor_pelicula`
--

INSERT INTO `actor_pelicula` (`id_actor_pelicula`, `id_actor`, `id_pelicula`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 16, 1),
(4, 3, 2),
(5, 4, 2),
(6, 17, 2),
(7, 5, 3),
(8, 6, 3),
(9, 18, 3),
(10, 7, 4),
(11, 8, 4),
(12, 19, 4),
(13, 9, 5),
(14, 10, 5),
(15, 20, 5),
(16, 11, 6),
(17, 12, 6),
(18, 1, 6),
(19, 13, 7),
(20, 14, 7),
(21, 2, 7),
(22, 15, 8),
(23, 1, 8),
(24, 3, 8),
(25, 2, 9),
(26, 9, 9),
(27, 4, 9),
(28, 3, 10),
(29, 8, 10),
(30, 5, 10),
(31, 4, 11),
(32, 10, 11),
(33, 6, 11),
(34, 5, 12),
(35, 12, 12),
(36, 7, 12),
(37, 6, 13),
(38, 3, 13),
(39, 8, 13),
(40, 7, 14),
(41, 11, 14),
(42, 9, 14),
(43, 8, 15),
(44, 15, 15),
(45, 10, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directores`
--

DROP TABLE IF EXISTS `directores`;
CREATE TABLE IF NOT EXISTS `directores` (
  `id_director` int NOT NULL AUTO_INCREMENT,
  `nombre_director` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_director`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `directores`
--

INSERT INTO `directores` (`id_director`, `nombre_director`) VALUES
(1, 'Frank Darabont'),
(2, 'Francis Ford Coppola'),
(3, 'Quentin Tarantino'),
(4, 'Christopher Nolan'),
(5, 'Robert Zemeckis'),
(6, 'Lana Wachowski'),
(7, 'Steven Spielberg'),
(8, 'James Cameron'),
(9, 'Jonathan Demme'),
(10, 'Peter Jackson'),
(11, 'David Fincher'),
(12, 'Quentin Tarantino'),
(13, 'Christopher Nolan'),
(14, 'Damien Chazelle'),
(15, 'Martin Scorsese');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `director_pelicula`
--

DROP TABLE IF EXISTS `director_pelicula`;
CREATE TABLE IF NOT EXISTS `director_pelicula` (
  `id_director_pelicula` int NOT NULL AUTO_INCREMENT,
  `id_director` int NOT NULL,
  `id_pelicula` int NOT NULL,
  PRIMARY KEY (`id_director_pelicula`),
  KEY `id_director_fk` (`id_director`),
  KEY `id_pelicula_fk_3` (`id_pelicula`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `director_pelicula`
--

INSERT INTO `director_pelicula` (`id_director_pelicula`, `id_director`, `id_pelicula`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 4, 6),
(7, 6, 7),
(8, 8, 8),
(9, 9, 9),
(10, 10, 10),
(11, 11, 11),
(12, 12, 12),
(13, 3, 13),
(14, 4, 14),
(15, 14, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

DROP TABLE IF EXISTS `genero`;
CREATE TABLE IF NOT EXISTS `genero` (
  `id_genero` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_genero`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id_genero`, `nombre`) VALUES
(1, 'Drama'),
(2, 'Comedia'),
(3, 'Acción'),
(4, 'Ciencia Ficción'),
(5, 'Romance'),
(6, 'Thriller'),
(7, 'Animación'),
(8, 'Aventura'),
(9, 'Fantasía'),
(10, 'Misterio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id_likes` int NOT NULL AUTO_INCREMENT,
  `usuario` int DEFAULT NULL,
  `like/dislike` decimal(1,0) DEFAULT NULL,
  `id_pelicula` int DEFAULT NULL,
  PRIMARY KEY (`id_likes`),
  KEY `id_pelicula_fk` (`id_pelicula`),
  KEY `usuario_fk` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`id_likes`, `usuario`, `like/dislike`, `id_pelicula`) VALUES
(1, 8, 1, 2),
(2, 8, 1, 1),
(5, 8, 0, 1),
(6, 8, 1, 1),
(7, 8, 1, 2),
(8, 8, 1, 2),
(9, 8, 1, 1),
(10, 8, 1, 1),
(11, 8, 1, 2),
(12, 1, 1, 3),
(13, 1, 1, 3),
(14, 1, 1, 3),
(15, 7, 1, 4),
(16, 7, 1, 4),
(18, 8, 1, 6),
(19, 8, 1, 2),
(20, 8, 1, 1),
(21, 1, 1, 6),
(22, 1, 0, 7),
(23, 1, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

DROP TABLE IF EXISTS `peliculas`;
CREATE TABLE IF NOT EXISTS `peliculas` (
  `id_pelicula` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descripcion` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ano` decimal(4,0) DEFAULT NULL,
  `genero` int DEFAULT NULL,
  `edad` decimal(2,0) DEFAULT NULL,
  `portada` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `trailer` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pelicula` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `logo` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_pelicula`),
  KEY `genero_fk` (`genero`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id_pelicula`, `nombre`, `descripcion`, `ano`, `genero`, `edad`, `portada`, `trailer`, `pelicula`, `logo`) VALUES
(1, 'Sueños de fuga', 'Dos hombres encarcelados entablan una amistad a lo largo de los años, encontrando consuelo y redención eventual a través de actos de decencia común.', 1994, 1, 17, 'sueno_de_fuga.jpg', 'sueños de fuga trailer.mp4', 'pelicula_sueno_de_fuga.mp4', 'logo_sueno_de_fuga.jpg'),
(2, 'El Padrino', 'El patriarca envejecido de una dinastía del crimen organizado transfiere el control de su imperio clandestino a su hijo reacio.', 1972, 1, 18, 'el_padrino.jpg', 'trailer_el_padrino.mp4', 'pelicula_el_padrino.mp4', 'logo_el_padrino.jpg'),
(3, 'Tiempos violentos', 'Las vidas de dos sicarios, un boxeador, un gángster y su esposa, y una pareja de bandidos de un restaurante se entrelazan en cuatro historias de violencia y redención.', 1994, 6, 17, 'tiempos_violentos.jpg', 'trailer_tiempos_violentos.mp4', 'pelicula_tiempos_violentos.mp4', 'logo_tiempos_violentos.jpg'),
(4, 'El Caballero de la Noche', 'Cuando la amenaza conocida como El Joker emerge de su pasado misterioso, siembra el caos y la destrucción en la gente de Gotham.', 2008, 3, 15, 'el_caballero_de_la_noche.jpg', 'trailer_el_caballero_de_la_noche.mp4', 'pelicula_el_caballero_de_la_noche.mp4', 'logo_el_caballero_de_la_noche.jpg'),
(5, 'Forrest Gump', 'Las presidencias de Kennedy y Johnson, la Guerra de Vietnam, el escándalo de Watergate y otros eventos históricos se desarrollan desde la perspectiva de un hombre de Alabama con un coeficiente intelectual de 75.', 1994, 2, 13, 'forrest_gump.jpg', 'trailer_forrest_gump.mp4', 'pelicula_forrest_gump.mp4', 'logo_forrest_gump.jpg'),
(6, 'Origen', 'Un ladrón que roba secretos corporativos mediante el uso de la tecnología de intercambio de sueños recibe la tarea inversa de plantar una idea en la mente de un CEO.', 2010, 3, 15, 'origen.jpg', 'trailer_origen.mp4', 'pelicula_origen.mp4', 'logo_origen.jpg'),
(7, 'Matrix', 'Un hacker de computadoras aprende de rebeldes misteriosos sobre la verdadera naturaleza de su realidad y su papel en la guerra contra sus controladores.', 1999, 3, 15, 'matrix.jpg', 'trailer_matrix.mp4', 'pelicula_matrix.mp4', 'logo_matrix.jpg'),
(8, 'La Lista de Schindler', 'En la Polonia ocupada por los alemanes durante la Segunda Guerra Mundial, el industrial Oskar Schindler se preocupa gradualmente por su fuerza laboral judía después de presenciar su persecución por los nazis.', 1993, 1, 17, 'la_lista_de_schindler.jpg', 'trailer_la_lista_de_schindler.mp4', 'pelicula_la_lista_de_schindler.mp4', 'logo_la_lista_de_schindler.jpg'),
(9, 'Titanic', 'Un aristócrata de diecisiete años se enamora de un artista amable pero pobre a bordo del lujoso y condenado R.M.S. Titanic.', 1997, 5, 13, 'titanic.jpg', 'trailer_titanic.mp4', 'pelicula_titanic.mp4', 'logo_titanic.jpg'),
(10, 'El Silencio de los Corderos', 'Una joven cadete del F.B.I. debe recibir la ayuda de un asesino caníbal encarcelado y manipulador para ayudar a atrapar a otro asesino en serie, un maníaco que pela a sus víctimas.', 1991, 6, 18, 'el_silencio_de_los_corderos.jpg', 'trailer_el_silencio_de_los_corderos.mp4', 'pelicula_el_silencio_de_los_corderos.mp4', 'logo_el_silencio_de_los_corderos.jpg'),
(11, 'El Señor de los Anillos: El Retorno del Rey', 'Gandalf y Aragorn lideran al Mundo de los Hombres contra el ejército de Sauron para desviar la mirada de Frodo y Sam mientras se acercan al Monte del Destino con el Anillo Único.', 2003, 8, 15, 'el_retorno_del_rey.jpg', 'trailer_el_retorno_del_rey.mp4', 'pelicula_el_retorno_del_rey.mp4', 'logo_el_retorno_del_rey.jpg'),
(12, 'El Club de la Pelea', 'Un trabajador de oficina insomne y un fabricante de jabón despreocupado forman un club de lucha clandestino que evoluciona hacia algo mucho, mucho más.', 1999, 6, 18, 'el_club_de_la_pelea.jpg', 'trailer_el_club_de_la_pelea.mp4', 'pelicula_el_club_de_la_pelea.mp4', 'logo_el_club_de_la_pelea.jpg'),
(13, 'Bastardos sin Gloria', 'En la Francia ocupada por los nazis durante la Segunda Guerra Mundial, un plan para asesinar a líderes nazis por un grupo de soldados judíos estadounidenses coincide con los planes vengativos de un propietario de un teatro.', 2009, 1, 18, 'bastardos_sin_gloria.jpg', 'trailer_bastardos_sin_gloria.mp4', 'pelicula_bastardos_sin_gloria.mp4', 'logo_bastardos_sin_gloria.jpg'),
(14, 'Interestelar', 'Un grupo de exploradores espaciales se embarca en un viaje interestelar para encontrar un nuevo hogar para la humanidad.', 2014, 3, 13, 'interestelar.jpg', 'trailer_interestelar.mp4', 'pelicula_interestelar.mp4', 'logo_interestelar.jpg'),
(15, 'La La Land', 'En Los Ángeles, un pianista de jazz se enamora de una aspirante a actriz mientras ambos buscan alcanzar sus sueños en una ciudad conocida por destruir esperanzas y romances.', 2016, 5, 13, 'la_la_land.jpg', 'trailer_la_la_land.mp4', 'pelicula_la_la_land.mp4', 'logo_la_la_land.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id_rol` int NOT NULL AUTO_INCREMENT,
  `rol` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(1, 'Cliente'),
(2, 'Administrador');

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
-- Filtros para la tabla `actor_pelicula`
--
ALTER TABLE `actor_pelicula`
  ADD CONSTRAINT `id_actor_fk` FOREIGN KEY (`id_actor`) REFERENCES `actores` (`id_actor`),
  ADD CONSTRAINT `id_pelicula_fk_2` FOREIGN KEY (`id_pelicula`) REFERENCES `peliculas` (`id_pelicula`);

--
-- Filtros para la tabla `director_pelicula`
--
ALTER TABLE `director_pelicula`
  ADD CONSTRAINT `id_director_fk` FOREIGN KEY (`id_director`) REFERENCES `directores` (`id_director`),
  ADD CONSTRAINT `id_pelicula_fk_3` FOREIGN KEY (`id_pelicula`) REFERENCES `peliculas` (`id_pelicula`);

--
-- Filtros para la tabla `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `id_pelicula_fk` FOREIGN KEY (`id_pelicula`) REFERENCES `peliculas` (`id_pelicula`),
  ADD CONSTRAINT `usuario_fk` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id_usuarios`);

--
-- Filtros para la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD CONSTRAINT `genero_fk` FOREIGN KEY (`genero`) REFERENCES `genero` (`id_genero`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `rol_fk` FOREIGN KEY (`rol`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
