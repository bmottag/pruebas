-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2017 a las 00:33:49
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
-- Estructura de tabla para la tabla `alertas`
--

CREATE TABLE `alertas` (
  `id_alerta` int(10) NOT NULL,
  `descripcion_alerta` text NOT NULL,
  `fk_id_tipo_alerta` int(1) NOT NULL,
  `mensaje_alerta` text NOT NULL,
  `fecha_alerta` date DEFAULT NULL,
  `hora_alerta` varchar(10) NOT NULL,
  `fk_id_rol` int(1) NOT NULL,
  `tiempo_duracion_alerta` varchar(10) NOT NULL,
  `fk_id_sesion` int(10) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `estado_alerta` int(1) NOT NULL COMMENT '1: Activa; 2: Inactiva',
  `tipo_mensaje` int(1) NOT NULL COMMENT '1: Notificacion por APP; 2: email y app; 3: solo email'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anulaciones`
--

CREATE TABLE `anulaciones` (
  `id_anulacion` int(10) NOT NULL,
  `fk_id_sitio` int(10) NOT NULL,
  `fk_id_sesion` int(10) NOT NULL,
  `fk_id_examinando` int(10) NOT NULL,
  `fk_id_motivo` int(1) NOT NULL,
  `observacion` text NOT NULL,
  `fecha_anulacion` datetime NOT NULL,
  `fk_id_user_dele` int(10) NOT NULL,
  `aprobada` int(1) NOT NULL COMMENT '1:Si; 2:No',
  `fk_id_user_coor` int(10) DEFAULT NULL,
  `fecha_aprobacion` datetime DEFAULT NULL,
  `observacion_aprobacion` text,
  `evidencia` varchar(250) DEFAULT NULL,
  `acta` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examinandos`
--

CREATE TABLE `examinandos` (
  `id_examinando` int(10) NOT NULL,
  `fk_mpio_divipola` int(3) NOT NULL,
  `fk_codigo_dane` varchar(30) NOT NULL,
  `snp` varchar(15) NOT NULL,
  `consecutivo` int(10) NOT NULL,
  `grupo_instrumentos` varchar(5) NOT NULL,
  `busqueda_1` int(3) NOT NULL,
  `busqueda_2` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedades_cambio_cuadernillo`
--

CREATE TABLE `novedades_cambio_cuadernillo` (
  `id_cambio_cuadernillo` int(10) NOT NULL,
  `fk_id_sitio` int(10) NOT NULL,
  `fk_id_sesion` int(10) NOT NULL,
  `fk_id_examinando` int(10) NOT NULL,
  `fk_id_cuadernillo` int(10) NOT NULL,
  `fk_id_motivo_novedad` int(1) NOT NULL,
  `observacion` text NOT NULL,
  `fecha_cambio` datetime NOT NULL,
  `fk_id_user_dele` int(10) NOT NULL,
  `aprobada` int(1) NOT NULL COMMENT '1:Si; 2:No',
  `fk_id_user_coor` int(10) DEFAULT NULL,
  `fecha_aprobacion` datetime DEFAULT NULL,
  `observacion_aprobacion` text,
  `busqueda` int(11) NOT NULL COMMENT '1: busqueda 1; 2: busqueda 2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedades_holgura`
--

CREATE TABLE `novedades_holgura` (
  `id_holgura` int(10) NOT NULL,
  `fk_id_sitio` int(10) NOT NULL,
  `fk_id_sesion` int(10) NOT NULL,
  `fk_id_examinando` int(10) NOT NULL,
  `fk_id_snp_holgura` int(10) NOT NULL,
  `observacion` text NOT NULL,
  `fecha_holgura` datetime NOT NULL,
  `fk_id_user_dele` int(10) NOT NULL,
  `aprobada` int(1) NOT NULL COMMENT '1:Si; 2:No; 0: Sin respuesta',
  `fk_id_user_coor` int(10) DEFAULT NULL,
  `fecha_aprobacion` datetime DEFAULT NULL,
  `observacion_aprobacion` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_divipola`
--

CREATE TABLE `param_divipola` (
  `dpto_divipola` int(1) NOT NULL,
  `mpio_divipola` int(3) NOT NULL,
  `dpto_divipola_nombre` varchar(100) NOT NULL,
  `mpio_divipola_nombre` varchar(100) NOT NULL,
  `fk_id_coordinador_mcpio` int(10) DEFAULT NULL,
  `fk_id_operador_mcpio` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_grupo_instrumentos`
--

CREATE TABLE `param_grupo_instrumentos` (
  `id_grupo_instrumentos` int(10) NOT NULL,
  `fk_id_prueba` int(10) NOT NULL,
  `nombre_grupo_instrumentos` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_motivo_anulacion`
--

CREATE TABLE `param_motivo_anulacion` (
  `id_motivo_anulacion` int(1) NOT NULL,
  `nombre_motivo_anulacion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_motivo_novedad`
--

CREATE TABLE `param_motivo_novedad` (
  `id_motivo_novedad` int(1) NOT NULL,
  `nombre_motivo_novedad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_organizaciones`
--

CREATE TABLE `param_organizaciones` (
  `id_organizacion` int(1) NOT NULL,
  `nombre_organizacion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_regiones`
--

CREATE TABLE `param_regiones` (
  `id_region` int(1) NOT NULL,
  `nombre_region` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_roles`
--

CREATE TABLE `param_roles` (
  `id_rol` int(1) NOT NULL,
  `nombre_rol` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `mostrar_lista` int(1) NOT NULL COMMENT '1: Mostrar en alerta; 2: NO mostrar'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_tipo_alerta`
--

CREATE TABLE `param_tipo_alerta` (
  `id_tipo_alerta` int(1) NOT NULL,
  `nombre_tipo_alerta` varchar(50) NOT NULL,
  `descripcion_tipo_alerta` text NOT NULL,
  `observacion_alerta` text NOT NULL,
  `fecha_creacion` date NOT NULL,
  `clase` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_zonas`
--

CREATE TABLE `param_zonas` (
  `id_zona` int(1) NOT NULL,
  `nombre_zona` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pruebas`
--

CREATE TABLE `pruebas` (
  `id_prueba` int(10) NOT NULL,
  `nombre_prueba` varchar(100) NOT NULL,
  `descripcion_prueba` text NOT NULL,
  `anio_prueba` int(1) NOT NULL,
  `semestre_prueba` int(1) NOT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `id_registro` int(10) NOT NULL,
  `fk_id_alerta` int(10) NOT NULL,
  `fk_id_usuario` int(10) NOT NULL,
  `fk_id_sitio_sesion` int(10) NOT NULL,
  `acepta` int(1) NOT NULL COMMENT '1: Acepta; 2: NO acepta',
  `ausentes` int(10) DEFAULT NULL,
  `observacion` text,
  `fecha_registro` datetime NOT NULL,
  `fk_id_user_coordinador` int(10) DEFAULT NULL,
  `nota` varchar(250) DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `fk_id_user_actualiza` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones`
--

CREATE TABLE `sesiones` (
  `id_sesion` int(10) NOT NULL,
  `fk_id_grupo_instrumentos` int(10) NOT NULL,
  `sesion_prueba` varchar(50) NOT NULL,
  `hora_inicio_prueba` varchar(10) DEFAULT NULL,
  `hora_fin_prueba` varchar(10) DEFAULT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sitios`
--

CREATE TABLE `sitios` (
  `id_sitio` int(10) NOT NULL,
  `nombre_sitio` varchar(150) NOT NULL,
  `direccion_sitio` varchar(100) NOT NULL,
  `barrio_sitio` varchar(100) DEFAULT NULL,
  `telefono_sitio` varchar(20) NOT NULL,
  `fax_sitio` varchar(10) DEFAULT NULL,
  `celular_sitio` varchar(10) NOT NULL,
  `email_sitio` varchar(50) DEFAULT NULL,
  `codigo_postal_sitio` varchar(10) DEFAULT NULL,
  `fk_id_organizacion` int(1) DEFAULT NULL,
  `fk_id_region` int(1) DEFAULT NULL,
  `fk_dpto_divipola` int(1) NOT NULL,
  `fk_mpio_divipola` int(3) NOT NULL,
  `fk_id_zona` int(1) DEFAULT NULL,
  `contacto_nombres` varchar(100) DEFAULT NULL,
  `contacto_apellidos` varchar(100) DEFAULT NULL,
  `contacto_cargo` varchar(100) DEFAULT NULL,
  `contacto_telefono` varchar(15) DEFAULT NULL,
  `contacto_celular` varchar(15) DEFAULT NULL,
  `contacto_email` varchar(50) DEFAULT NULL,
  `estado_sitio` int(1) NOT NULL DEFAULT '1' COMMENT '1:activo; 2:inactivo',
  `fecha_creacion` date NOT NULL,
  `fk_id_user_delegado` int(10) DEFAULT NULL,
  `fk_id_user_operador` int(10) DEFAULT NULL,
  `fk_id_user_coordinador` int(10) DEFAULT NULL,
  `codigo_dane` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sitio_sesion`
--

CREATE TABLE `sitio_sesion` (
  `id_sitio_sesion` int(10) NOT NULL,
  `fk_id_sitio` int(10) NOT NULL,
  `fk_id_sesion` int(10) NOT NULL,
  `numero_citados` int(10) NOT NULL,
  `numero_presentes_nuevos` int(10) DEFAULT NULL,
  `numero_ausentes` int(10) DEFAULT NULL,
  `numero_presentes_efectivos` int(10) DEFAULT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `snp_holguras`
--

CREATE TABLE `snp_holguras` (
  `id_snp_holgura` int(10) NOT NULL,
  `snp_holgura` varchar(15) NOT NULL,
  `consecutivo_holgura` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(10) NOT NULL,
  `numero_documento` int(10) NOT NULL,
  `tipo_documento` varchar(150) NOT NULL,
  `nombres_usuario` varchar(50) NOT NULL,
  `apellidos_usuario` varchar(50) NOT NULL,
  `direccion_usuario` varchar(250) NOT NULL,
  `telefono_fijo` varchar(12) DEFAULT NULL,
  `celular` varchar(12) NOT NULL,
  `email` varchar(70) DEFAULT NULL,
  `log_user` int(10) NOT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `fk_id_rol` int(1) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1' COMMENT '1:active; 2:inactive'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alertas`
--
ALTER TABLE `alertas`
  ADD PRIMARY KEY (`id_alerta`),
  ADD KEY `fk_id_tipo_alerta` (`fk_id_tipo_alerta`),
  ADD KEY `fk_id_rol` (`fk_id_rol`),
  ADD KEY `fk_id_prueba` (`fk_id_sesion`),
  ADD KEY `tipo_mensaje` (`tipo_mensaje`);

--
-- Indices de la tabla `anulaciones`
--
ALTER TABLE `anulaciones`
  ADD PRIMARY KEY (`id_anulacion`),
  ADD KEY `fk_id_sitio` (`fk_id_sitio`),
  ADD KEY `fk_id_sesion` (`fk_id_sesion`),
  ADD KEY `fk_id_examinando` (`fk_id_examinando`),
  ADD KEY `fk_id_motivo` (`fk_id_motivo`),
  ADD KEY `fk_id_user_dele` (`fk_id_user_dele`),
  ADD KEY `fk_id_user_coor` (`fk_id_user_coor`);

--
-- Indices de la tabla `examinandos`
--
ALTER TABLE `examinandos`
  ADD PRIMARY KEY (`id_examinando`),
  ADD UNIQUE KEY `snp` (`snp`),
  ADD KEY `fk_mpio_divipola` (`fk_mpio_divipola`),
  ADD KEY `fk_codigo_dane` (`fk_codigo_dane`),
  ADD KEY `busqueda_1` (`busqueda_1`),
  ADD KEY `busqueda_2` (`busqueda_2`),
  ADD KEY `consecutivo` (`consecutivo`);

--
-- Indices de la tabla `novedades_cambio_cuadernillo`
--
ALTER TABLE `novedades_cambio_cuadernillo`
  ADD PRIMARY KEY (`id_cambio_cuadernillo`),
  ADD KEY `fk_id_sitio` (`fk_id_sitio`),
  ADD KEY `fk_id_sesion` (`fk_id_sesion`),
  ADD KEY `fk_id_examinando` (`fk_id_examinando`),
  ADD KEY `fk_id_cuadernillo` (`fk_id_cuadernillo`),
  ADD KEY `fk_id_motivo_cambio` (`fk_id_motivo_novedad`),
  ADD KEY `fk_id_user_cambio` (`fk_id_user_dele`),
  ADD KEY `fk_id_user_coor` (`fk_id_user_coor`);

--
-- Indices de la tabla `novedades_holgura`
--
ALTER TABLE `novedades_holgura`
  ADD PRIMARY KEY (`id_holgura`),
  ADD KEY `fk_id_sitio` (`fk_id_sitio`),
  ADD KEY `fk_id_sesion` (`fk_id_sesion`),
  ADD KEY `fk_id_examinando` (`fk_id_examinando`),
  ADD KEY `fk_id_snp_holgura` (`fk_id_snp_holgura`),
  ADD KEY `fk_id_user_dele` (`fk_id_user_dele`),
  ADD KEY `fk_id_user_coor` (`fk_id_user_coor`);

--
-- Indices de la tabla `param_divipola`
--
ALTER TABLE `param_divipola`
  ADD PRIMARY KEY (`mpio_divipola`),
  ADD KEY `dpto_divipola` (`dpto_divipola`),
  ADD KEY `fk_id_coordinador_mcpio` (`fk_id_coordinador_mcpio`),
  ADD KEY `fk_id_operador_mcpio` (`fk_id_operador_mcpio`);

--
-- Indices de la tabla `param_grupo_instrumentos`
--
ALTER TABLE `param_grupo_instrumentos`
  ADD PRIMARY KEY (`id_grupo_instrumentos`),
  ADD KEY `fk_id_prueba` (`fk_id_prueba`);

--
-- Indices de la tabla `param_motivo_anulacion`
--
ALTER TABLE `param_motivo_anulacion`
  ADD PRIMARY KEY (`id_motivo_anulacion`);

--
-- Indices de la tabla `param_motivo_novedad`
--
ALTER TABLE `param_motivo_novedad`
  ADD PRIMARY KEY (`id_motivo_novedad`);

--
-- Indices de la tabla `param_organizaciones`
--
ALTER TABLE `param_organizaciones`
  ADD PRIMARY KEY (`id_organizacion`);

--
-- Indices de la tabla `param_regiones`
--
ALTER TABLE `param_regiones`
  ADD PRIMARY KEY (`id_region`);

--
-- Indices de la tabla `param_roles`
--
ALTER TABLE `param_roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `param_tipo_alerta`
--
ALTER TABLE `param_tipo_alerta`
  ADD PRIMARY KEY (`id_tipo_alerta`);

--
-- Indices de la tabla `param_zonas`
--
ALTER TABLE `param_zonas`
  ADD PRIMARY KEY (`id_zona`);

--
-- Indices de la tabla `pruebas`
--
ALTER TABLE `pruebas`
  ADD PRIMARY KEY (`id_prueba`),
  ADD KEY `anio_prueba` (`anio_prueba`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `fk_id_alerta` (`fk_id_alerta`),
  ADD KEY `fk_id_usuario` (`fk_id_usuario`),
  ADD KEY `fk_id_sitio_sesion` (`fk_id_sitio_sesion`),
  ADD KEY `fk_id_user_coordinador` (`fk_id_user_coordinador`),
  ADD KEY `acepta` (`acepta`),
  ADD KEY `fk_id_user_actualiza` (`fk_id_user_actualiza`);

--
-- Indices de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD PRIMARY KEY (`id_sesion`),
  ADD KEY `fk_id_grupo_instrumentos` (`fk_id_grupo_instrumentos`);

--
-- Indices de la tabla `sitios`
--
ALTER TABLE `sitios`
  ADD PRIMARY KEY (`id_sitio`),
  ADD UNIQUE KEY `codigo_dane` (`codigo_dane`),
  ADD KEY `fk_id_organizacion` (`fk_id_organizacion`),
  ADD KEY `fk_id_region` (`fk_id_region`),
  ADD KEY `fk_id_zona` (`fk_id_zona`),
  ADD KEY `fk_dpto_divipola` (`fk_dpto_divipola`),
  ADD KEY `fk_mpio_divipola` (`fk_mpio_divipola`),
  ADD KEY `fk_id_user_delegado` (`fk_id_user_delegado`),
  ADD KEY `fk_id_user_coordinador` (`fk_id_user_coordinador`),
  ADD KEY `fk_id_user_operador` (`fk_id_user_operador`);

--
-- Indices de la tabla `sitio_sesion`
--
ALTER TABLE `sitio_sesion`
  ADD PRIMARY KEY (`id_sitio_sesion`),
  ADD KEY `fk_id_sitio` (`fk_id_sitio`),
  ADD KEY `fk_id_sesion` (`fk_id_sesion`);

--
-- Indices de la tabla `snp_holguras`
--
ALTER TABLE `snp_holguras`
  ADD PRIMARY KEY (`id_snp_holgura`),
  ADD UNIQUE KEY `snp_holgura` (`snp_holgura`),
  ADD KEY `consecutivo_holgura` (`consecutivo_holgura`);

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
-- AUTO_INCREMENT de la tabla `alertas`
--
ALTER TABLE `alertas`
  MODIFY `id_alerta` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `anulaciones`
--
ALTER TABLE `anulaciones`
  MODIFY `id_anulacion` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `examinandos`
--
ALTER TABLE `examinandos`
  MODIFY `id_examinando` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `novedades_cambio_cuadernillo`
--
ALTER TABLE `novedades_cambio_cuadernillo`
  MODIFY `id_cambio_cuadernillo` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `novedades_holgura`
--
ALTER TABLE `novedades_holgura`
  MODIFY `id_holgura` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `param_grupo_instrumentos`
--
ALTER TABLE `param_grupo_instrumentos`
  MODIFY `id_grupo_instrumentos` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `param_motivo_anulacion`
--
ALTER TABLE `param_motivo_anulacion`
  MODIFY `id_motivo_anulacion` int(1) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `param_motivo_novedad`
--
ALTER TABLE `param_motivo_novedad`
  MODIFY `id_motivo_novedad` int(1) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `param_organizaciones`
--
ALTER TABLE `param_organizaciones`
  MODIFY `id_organizacion` int(1) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `param_regiones`
--
ALTER TABLE `param_regiones`
  MODIFY `id_region` int(1) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `param_roles`
--
ALTER TABLE `param_roles`
  MODIFY `id_rol` int(1) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `param_tipo_alerta`
--
ALTER TABLE `param_tipo_alerta`
  MODIFY `id_tipo_alerta` int(1) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `param_zonas`
--
ALTER TABLE `param_zonas`
  MODIFY `id_zona` int(1) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pruebas`
--
ALTER TABLE `pruebas`
  MODIFY `id_prueba` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `id_registro` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  MODIFY `id_sesion` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sitios`
--
ALTER TABLE `sitios`
  MODIFY `id_sitio` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sitio_sesion`
--
ALTER TABLE `sitio_sesion`
  MODIFY `id_sitio_sesion` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `snp_holguras`
--
ALTER TABLE `snp_holguras`
  MODIFY `id_snp_holgura` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anulaciones`
--
ALTER TABLE `anulaciones`
  ADD CONSTRAINT `anulaciones_ibfk_1` FOREIGN KEY (`fk_id_motivo`) REFERENCES `param_motivo_anulacion` (`id_motivo_anulacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `anulaciones_ibfk_2` FOREIGN KEY (`fk_id_sitio`) REFERENCES `sitios` (`id_sitio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `anulaciones_ibfk_3` FOREIGN KEY (`fk_id_examinando`) REFERENCES `examinandos` (`id_examinando`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `anulaciones_ibfk_4` FOREIGN KEY (`fk_id_sesion`) REFERENCES `sesiones` (`id_sesion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `examinandos`
--
ALTER TABLE `examinandos`
  ADD CONSTRAINT `examinandos_ibfk_1` FOREIGN KEY (`fk_mpio_divipola`) REFERENCES `param_divipola` (`mpio_divipola`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `examinandos_ibfk_2` FOREIGN KEY (`fk_codigo_dane`) REFERENCES `sitios` (`codigo_dane`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `novedades_cambio_cuadernillo`
--
ALTER TABLE `novedades_cambio_cuadernillo`
  ADD CONSTRAINT `novedades_cambio_cuadernillo_ibfk_1` FOREIGN KEY (`fk_id_sitio`) REFERENCES `sitios` (`id_sitio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `novedades_cambio_cuadernillo_ibfk_2` FOREIGN KEY (`fk_id_sesion`) REFERENCES `sesiones` (`id_sesion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `novedades_cambio_cuadernillo_ibfk_3` FOREIGN KEY (`fk_id_examinando`) REFERENCES `examinandos` (`id_examinando`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `novedades_cambio_cuadernillo_ibfk_4` FOREIGN KEY (`fk_id_motivo_novedad`) REFERENCES `param_motivo_novedad` (`id_motivo_novedad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `novedades_holgura`
--
ALTER TABLE `novedades_holgura`
  ADD CONSTRAINT `novedades_holgura_ibfk_1` FOREIGN KEY (`fk_id_sitio`) REFERENCES `sitios` (`id_sitio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `novedades_holgura_ibfk_2` FOREIGN KEY (`fk_id_sesion`) REFERENCES `sesiones` (`id_sesion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `novedades_holgura_ibfk_4` FOREIGN KEY (`fk_id_snp_holgura`) REFERENCES `snp_holguras` (`id_snp_holgura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `param_grupo_instrumentos`
--
ALTER TABLE `param_grupo_instrumentos`
  ADD CONSTRAINT `param_grupo_instrumentos_ibfk_1` FOREIGN KEY (`fk_id_prueba`) REFERENCES `pruebas` (`id_prueba`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `registro_ibfk_1` FOREIGN KEY (`fk_id_sitio_sesion`) REFERENCES `sitio_sesion` (`id_sitio_sesion`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD CONSTRAINT `sesiones_ibfk_2` FOREIGN KEY (`fk_id_grupo_instrumentos`) REFERENCES `param_grupo_instrumentos` (`id_grupo_instrumentos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sitios`
--
ALTER TABLE `sitios`
  ADD CONSTRAINT `sitios_ibfk_2` FOREIGN KEY (`fk_id_region`) REFERENCES `param_regiones` (`id_region`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sitios_ibfk_3` FOREIGN KEY (`fk_id_organizacion`) REFERENCES `param_organizaciones` (`id_organizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sitios_ibfk_4` FOREIGN KEY (`fk_mpio_divipola`) REFERENCES `param_divipola` (`mpio_divipola`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sitios_ibfk_5` FOREIGN KEY (`fk_id_zona`) REFERENCES `param_zonas` (`id_zona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sitio_sesion`
--
ALTER TABLE `sitio_sesion`
  ADD CONSTRAINT `sitio_sesion_ibfk_1` FOREIGN KEY (`fk_id_sitio`) REFERENCES `sitios` (`id_sitio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sitio_sesion_ibfk_2` FOREIGN KEY (`fk_id_sesion`) REFERENCES `sesiones` (`id_sesion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
