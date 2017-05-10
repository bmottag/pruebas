-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-05-2017 a las 16:49:10
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pruebas_icfes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_roles`
--

CREATE TABLE `param_roles` (
  `id_rol` int(1) NOT NULL,
  `nombre_rol` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_roles`
--

INSERT INTO `param_roles` (`id_rol`, `nombre_rol`, `descripcion`) VALUES
(1, 'Administrador', 'Acceso a todas las funcionalidades del sistema'),
(2, 'Directivo ICFES', 'Acceso a las funcionalidades objeto del negocio a nivel nacional'),
(3, 'Coordinador regional', 'Acceso a las funcionalidades objeto del negocio a nivel regional'),
(4, 'Delegado', 'Acceso a las funcionalidades objeto del negocio a nivel de sitio de aplicación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prueba`
--

CREATE TABLE `prueba` (
  `id_prueba` int(11) NOT NULL,
  `nombre_prueba` varchar(100) NOT NULL,
  `descripcion_prueba` text NOT NULL,
  `anio_prueba` varchar(4) NOT NULL,
  `semestre_prueba` varchar(10) NOT NULL,
  `sesion_prueba` varchar(10) NOT NULL,
  `hora_inicio_prueba` varchar(10) NOT NULL,
  `hora_fin_prueba` varchar(10) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_actualizacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(10) NOT NULL,
  `numero_documento` int(10) NOT NULL,
  `nombres_usuario` varchar(50) NOT NULL,
  `apellidos_usuario` varchar(50) NOT NULL,
  `direccion_usuario` varchar(250) NOT NULL,
  `telefono_fijo` varchar(12) NOT NULL,
  `celular` varchar(12) NOT NULL,
  `email` varchar(70) DEFAULT NULL,
  `log_user` int(10) NOT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `fk_id_rol` int(1) NOT NULL,
  `state` int(1) NOT NULL DEFAULT '0' COMMENT '1:active; 2:inactive'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `param_roles`
--
ALTER TABLE `param_roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `prueba`
--
ALTER TABLE `prueba`
  ADD PRIMARY KEY (`id_prueba`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `numero_documento` (`numero_documento`),
  ADD UNIQUE KEY `log_user` (`log_user`),
  ADD KEY `fk_id_rol` (`fk_id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `param_roles`
--
ALTER TABLE `param_roles`
  MODIFY `id_rol` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `prueba`
--
ALTER TABLE `prueba`
  MODIFY `id_prueba` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
