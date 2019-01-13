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

-- -----------------------------------------------------
-- User todolist
-- -----------------------------------------------------

GRANT ALL PRIVILEGES ON todolist.* TO todolist@localhost IDENTIFIED BY "todolist";

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
  `TAREAS_id_TAREAS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `fases`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fases_has_contactos`
--

CREATE TABLE `fases_has_contactos` (
  `FASES_id_FASES` int(11) NOT NULL,
  `FASES_TAREAS_id_TAREAS` int(11) NOT NULL,
  `CONTACTOS_email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  ADD PRIMARY KEY (`id_FASES`,`TAREAS_id_TAREAS`),
  ADD UNIQUE KEY `id_FASES_UNIQUE` (`id_FASES`),
  ADD KEY `fk_FASES_TAREAS1_idx` (`TAREAS_id_TAREAS`);

--
-- Indices de la tabla `fases_has_contactos`
--
ALTER TABLE `fases_has_contactos`
  ADD PRIMARY KEY (`FASES_id_FASES`,`FASES_TAREAS_id_TAREAS`,`CONTACTOS_email`),
  ADD KEY `fk_FASES_has_CONTACTOS_CONTACTOS1_idx` (`CONTACTOS_email`),
  ADD KEY `fk_FASES_has_CONTACTOS_FASES1_idx` (`FASES_id_FASES`,`FASES_TAREAS_id_TAREAS`);

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
  MODIFY `id_ARCHIVOS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_CATEGORIAS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `fases`
--
ALTER TABLE `fases`
  MODIFY `id_FASES` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id_tarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD CONSTRAINT `fk_ARCHIVOS_FASES1` FOREIGN KEY (`FASES_id_FASES`) REFERENCES `fases` (`id_FASES`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ARCHIVOS_TAREAS1` FOREIGN KEY (`FASES_TAREAS_id_TAREAS`) REFERENCES `fases` (`TAREAS_id_TAREAS`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `fases`
--
ALTER TABLE `fases`
  ADD CONSTRAINT `fk_FASES_TAREAS1` FOREIGN KEY (`TAREAS_id_TAREAS`) REFERENCES `tareas` (`id_tarea`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `fases_has_contactos`
--
ALTER TABLE `fases_has_contactos`
  ADD CONSTRAINT `fk_FASES_has_CONTACTOS_CONTACTOS1` FOREIGN KEY (`CONTACTOS_email`) REFERENCES `contactos` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_FASES_has_CONTACTOS_FASES1` FOREIGN KEY (`FASES_id_FASES`,`FASES_TAREAS_id_TAREAS`) REFERENCES `fases` (`id_FASES`, `TAREAS_id_TAREAS`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `fk_TAREAS_CATEGORIAS1` FOREIGN KEY (`CATEGORIAS_id_CATEGORIAS`) REFERENCES `categorias` (`id_CATEGORIAS`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TAREAS_PRIORIDADES1` FOREIGN KEY (`PRIORIDADES_nivel`) REFERENCES `prioridades` (`nivel`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TAREAS_USUARIOS` FOREIGN KEY (`USUARIOS_login`) REFERENCES `usuarios` (`login`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
