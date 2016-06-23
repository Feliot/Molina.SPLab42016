-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-06-2016 a las 23:38:29
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `segundoparcial2016`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `misproductos`
--

CREATE TABLE IF NOT EXISTS `misproductos` (
`id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `porcentaje` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `misproductos`
--

INSERT INTO `misproductos` (`id`, `nombre`, `porcentaje`) VALUES
(1, 'Android', '90'),
(2, 'Ubuntu', '60'),
(3, 'Windows', '25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `misusuarios`
--

CREATE TABLE IF NOT EXISTS `misusuarios` (
`id` int(11) NOT NULL,
  `correo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `foto` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `misusuarios`
--

INSERT INTO `misusuarios` (`id`, `correo`, `nombre`, `clave`, `tipo`, `foto`) VALUES
(1, 'comp@comp.com', 'comprador', '123', 'comprador', 'sin foto'),
(2, 'admin@admin.com', 'admin', '321', 'administrador', 'sin foto'),
(3, 'vend@vend.com', 'vend', '321', 'vendedor', 'sin foto');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `misproductos`
--
ALTER TABLE `misproductos`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `misusuarios`
--
ALTER TABLE `misusuarios`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `misproductos`
--
ALTER TABLE `misproductos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `misusuarios`
--
ALTER TABLE `misusuarios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
