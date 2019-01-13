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

INSERT INTO `categorias` (`id_CATEGORIAS`, `nombre`) VALUES
(1, 'Clases'),
(2, 'Familia'),
(3, 'Casa'),
(4, 'Ocio'),
(5, 'Amigos'),
(6, 'Trabajo');

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
('crcalvo@gmail.com', 'Carlota Romero', 'Monitora Fitness', '634589674'),
('daguilar@gmail.com', 'Daniel Aguilar', 'Responsable', '632978541'),
('improfe@gmail.com', 'Isa Montero', 'Profesora InglÃ©s', '674259312'),
('javirc@gmail.com', 'Javi Roca', 'Jefe Proyecto', '683257496'),
('ldcrespo@gmail.com', 'Lidia Crespo', 'CompaÃ±ero clase', '699875231');

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

INSERT INTO `fases` (`id_FASES`, `descripcion`, `fecha_inicio`, `fecha_fin`, `completada`, `TAREAS_id_TAREAS`) VALUES
(1, 'AnÃ¡lisis', '2019-01-13', '0000-00-00', 0, 1),
(2, 'Implementacion 1', '2019-01-13', '0000-00-00', 0, 1),
(3, 'Implementacion 2', '2019-01-13', '0000-00-00', 0, 1),
(4, 'Reunion de Seguimiento', '2019-01-13', '0000-00-00', 0, 1);

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
-- Volcado de datos para la tabla `fases_has_contactos`
--

INSERT INTO `fases_has_contactos` (`FASES_id_FASES`, `FASES_TAREAS_id_TAREAS`, `CONTACTOS_email`) VALUES
(1, 1, 'javirc@gmail.com'),
(2, 1, 'javirc@gmail.com'),
(3, 1, 'crcalvo@gmail.com'),
(4, 1, 'crcalvo@gmail.com'),
(4, 1, 'daguilar@gmail.com'),
(4, 1, 'javirc@gmail.com');

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
(10, 'Muy baja', '#12a8e0'),
(20, 'Baja', '#29c018'),
(30, 'Normal', '#deda27'),
(40, 'Importante', '#e9961b'),
(50, 'Muy importante', '#dc3434'),
(60, 'Urgente', '#a02394');

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
(1, 'Proyecto Empresa', '2019-01-13', '0000-00-00', 0, 'admin', 1, 10);

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
('admin', 'admin', '11111111H', 'Admin', 'Adminez Adminez', '666666666', 'admin@admin.com', '1991-06-04', 'ADMIN'),
('ascarrasco', 'ascarrasco', '17714948A', 'Alberto', 'Santos Carrasco', '652314789', 'ascarrasco@gmail.com', '1995-01-18', 'NORMAL'),
('brsaez', 'brsaez', '94813697S', 'Blanca', 'Roca Saez', '654823657', 'brsaez@gmail.com', '1987-06-25', 'NORMAL'),
('milopez', 'milopez', '55691509E', 'Marc', 'IbÃ¡Ã±ez LÃ³pez', '632145696', 'milopez@gmail.com', '1989-09-28', 'NORMAL'),
('sscarmona', 'sscarmona', '72479940V', 'Silvia', 'Soler Carmona', '699547832', 'sscarmona@gmail.com', '1998-06-03', 'NORMAL');

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
