-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-12-2018 a las 19:25:24
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `todolist`
--

DROP SCHEMA IF EXISTS `todolist` ;

-- -----------------------------------------------------
-- Schema todolist
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `todolist` DEFAULT CHARACTER SET utf8 ;
USE `todolist` ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id_ARCHIVOS` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `url` varchar(255) NOT NULL,
  `FASES_id_FASES` int(11) NOT NULL,
  `FASES_TAREAS_id_TAREAS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `archivos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_CATEGORIAS` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_CATEGORIAS`, `nombre`) VALUES
(1, 'Casa'),
(4, 'Clases'),
(5, 'Nueva');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `email` varchar(60) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `telefono` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`email`, `nombre`, `descripcion`, `telefono`) VALUES
('afmontero@esei.uvigo.es', 'Alex', 'El guapo', '664758920'),
('manolo@gmail.com', 'Manolo', 'Encargado de material', '669874123'),
('olista94@gmail.com', 'Oscar', 'Subnormal', '669842512'),
('ypgarcia@esei.uvigo.es', 'Iago', 'El puto amo', '667512489');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fases`
--

CREATE TABLE `fases` (
  `id_FASES` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `completada` tinyint(4) NOT NULL DEFAULT '0',
  `TAREAS_id_TAREAS` int(11) NOT NULL,
  `CONTACTOS_email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `fases`
--

INSERT INTO `fases` (`id_FASES`, `descripcion`, `fecha_inicio`, `fecha_fin`, `completada`, `TAREAS_id_TAREAS`, `CONTACTOS_email`) VALUES
(12, 'Comprar la comida', '2018-12-27', '2018-12-31', 1, 16, 'afmontero@esei.uvigo.es'),
(13, 'Poner la mesa', '2018-12-27', '2018-12-31', 1, 16, 'olista94@gmail.com'),
(14, 'Cocinar', '2018-12-27', '2018-12-31', 1, 16, 'ypgarcia@esei.uvigo.es'),
(15, 'Fase uno', '2018-12-29', '0000-00-00', 0, 17, 'ypgarcia@esei.uvigo.es'),
(16, 'Fase dos', '2018-12-29', '0000-00-00', 0, 17, 'ypgarcia@esei.uvigo.es'),
(17, 'Fase tres', '2018-12-31', '2018-12-31', 1, 17, 'olista94@gmail.com'),
(18, 'Oscar', '2018-12-30', '2018-12-31', 1, 18, 'manolo@gmail.com'),
(19, 'Lista', '2018-12-31', '2018-12-31', 1, 18, 'olista94@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prioridades`
--

CREATE TABLE `prioridades` (
  `nivel` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `color` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `prioridades`
--

INSERT INTO `prioridades` (`nivel`, `descripcion`, `color`) VALUES
(1, 'No urgente', '#008000'),
(2, 'Poco importante', '#00FFFF'),
(3, 'Importante', '#FFFF00'),
(4, 'Muy importante', '#FFA500'),
(5, 'Urgente', '#FF0000'),
(6, 'Super', '#FF00FF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id_tarea` int(11) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `Fecha_Ini` date NOT NULL,
  `Fecha_Fin` date NOT NULL,
  `completada` tinyint(4) NOT NULL DEFAULT '0',
  `USUARIOS_login` varchar(15) NOT NULL,
  `CATEGORIAS_id_CATEGORIAS` int(11) NOT NULL,
  `PRIORIDADES_nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id_tarea`, `descripcion`, `Fecha_Ini`, `Fecha_Fin`, `completada`, `USUARIOS_login`, `CATEGORIAS_id_CATEGORIAS`, `PRIORIDADES_nivel`) VALUES
(16, 'Hacer la comida', '2018-12-31', '0000-00-00', 1, 'root', 1, 1),
(17, 'Tarea uno', '2018-12-28', '0000-00-00', 0, 'root', 5, 6),
(18, 'Oscar Lista', '2018-12-29', '0000-00-00', 1, 'Olista', 4, 3),
(20, 'Primera', '2018-12-01', '0000-00-00', 0, 'Olista', 5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `login` varchar(15) NOT NULL,
  `password` varchar(128) NOT NULL,
  `dni` varchar(9) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `fecha` date NOT NULL,
  `tipo` enum('ADMIN','NORMAL') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`login`, `password`, `dni`, `nombre`, `apellidos`, `telefono`, `email`, `fecha`, `tipo`) VALUES
('n', 'n', '11223344B', 'Nueva', 'Lista Rivera', '663214789', 'h@jgr.con', '2018-12-13', 'NORMAL'),
('Olista', 'Olista', '22222222J', 'Oscar', 'Lista Rivera', '669842512', 'olista94@gmail.com', '2018-12-26', 'NORMAL'),
('root', 'root', '11111111B', 'root', 'root', '663512498', 'root@root.root', '1992-02-21', 'ADMIN'),
('ypgarcia', 'asdf', '44657078w', 'Iago', 'Perez Garcia', '667510587', 'ypgarcia@esei.uvigo.es', '1996-04-21', 'NORMAL');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id_ARCHIVOS`,`FASES_id_FASES`,`FASES_TAREAS_id_TAREAS`),
  ADD UNIQUE KEY `id_ARCHIVOS_UNIQUE` (`id_ARCHIVOS`),
  ADD KEY `fk_ARCHIVOS_FASES1_idx` (`FASES_id_FASES`),
  ADD KEY `fk_ARCHIVOS_TAREAS1_idx` (`FASES_TAREAS_id_TAREAS`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_CATEGORIAS`),
  ADD UNIQUE KEY `id_CATEGORIAS_UNIQUE` (`id_CATEGORIAS`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indices de la tabla `fases`
--
ALTER TABLE `fases`
  ADD PRIMARY KEY (`id_FASES`,`TAREAS_id_TAREAS`,`CONTACTOS_email`),
  ADD UNIQUE KEY `id_FASES_UNIQUE` (`id_FASES`),
  ADD KEY `fk_FASES_TAREAS1_idx` (`TAREAS_id_TAREAS`),
  ADD KEY `fk_FASES_CONTACTOS1_idx` (`CONTACTOS_email`);

--
-- Indices de la tabla `prioridades`
--
ALTER TABLE `prioridades`
  ADD PRIMARY KEY (`nivel`),
  ADD UNIQUE KEY `nivel_UNIQUE` (`nivel`),
  ADD UNIQUE KEY `descripcion_UNIQUE` (`descripcion`),
  ADD UNIQUE KEY `color_UNIQUE` (`color`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id_tarea`,`USUARIOS_login`,`CATEGORIAS_id_CATEGORIAS`,`PRIORIDADES_nivel`),
  ADD UNIQUE KEY `id_TAREAS_UNIQUE` (`id_tarea`),
  ADD KEY `fk_TAREAS_USUARIOS_idx` (`USUARIOS_login`),
  ADD KEY `fk_TAREAS_CATEGORIAS1_idx` (`CATEGORIAS_id_CATEGORIAS`),
  ADD KEY `fk_TAREAS_PRIORIDADES1_idx` (`PRIORIDADES_nivel`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`login`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`),
  ADD UNIQUE KEY `dni_UNIQUE` (`dni`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id_ARCHIVOS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_CATEGORIAS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `fases`
--
ALTER TABLE `fases`
  MODIFY `id_FASES` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id_tarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD CONSTRAINT `fk_ARCHIVOS_FASES1` FOREIGN KEY (`FASES_id_FASES`) REFERENCES `fases` (`id_FASES`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ARCHIVOS_TAREAS1` FOREIGN KEY (`FASES_TAREAS_id_TAREAS`) REFERENCES `fases` (`TAREAS_id_TAREAS`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `fases`
--
ALTER TABLE `fases`
  ADD CONSTRAINT `fk_FASES_CONTACTOS1` FOREIGN KEY (`CONTACTOS_email`) REFERENCES `contactos` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_FASES_TAREAS1` FOREIGN KEY (`TAREAS_id_TAREAS`) REFERENCES `tareas` (`id_tarea`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `fk_TAREAS_CATEGORIAS1` FOREIGN KEY (`CATEGORIAS_id_CATEGORIAS`) REFERENCES `categorias` (`id_CATEGORIAS`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TAREAS_PRIORIDADES1` FOREIGN KEY (`PRIORIDADES_nivel`) REFERENCES `prioridades` (`nivel`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TAREAS_USUARIOS` FOREIGN KEY (`USUARIOS_login`) REFERENCES `usuarios` (`login`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
