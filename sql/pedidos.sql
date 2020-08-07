-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-12-2019 a las 16:33:17
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pedidos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `CodCat` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`CodCat`, `Nombre`, `Descripcion`) VALUES
(1, 'Comida', 'Platos e ingredientes'),
(2, 'Bedidas sin', 'Bebidas sin alcohol'),
(3, 'Bebidas con', 'Bebidas con alcohol');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `CodPed` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Enviado` int(11) NOT NULL,
  `Restaurante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`CodPed`, `Fecha`, `Enviado`, `Restaurante`) VALUES
(79, '2018-12-20 15:50:33', 0, 1),
(80, '2018-12-20 15:51:41', 0, 1),
(81, '2018-12-20 16:41:13', 0, 1),
(82, '2018-12-20 17:29:39', 0, 1),
(83, '2018-12-20 23:13:23', 0, 1),
(84, '2018-12-20 23:14:07', 0, 1),
(85, '2018-12-20 23:15:02', 0, 1),
(86, '2018-12-24 10:56:29', 0, 1),
(87, '2019-12-10 11:27:40', 0, 3),
(88, '2019-12-10 11:37:45', 0, 3),
(89, '2019-12-10 13:24:00', 0, 3),
(90, '2019-12-10 13:29:03', 0, 3),
(91, '2019-12-10 13:30:41', 0, 3),
(92, '2019-12-10 13:31:46', 0, 3),
(93, '2019-12-10 13:33:30', 0, 3),
(94, '2019-12-10 13:37:29', 0, 3),
(95, '2019-12-10 13:37:40', 0, 3),
(96, '2019-12-10 13:39:10', 0, 3),
(97, '2019-12-10 13:47:19', 0, 3),
(98, '2019-12-10 13:53:38', 0, 3),
(99, '2019-12-10 13:54:07', 0, 3),
(100, '2019-12-10 14:14:02', 0, 3),
(101, '2019-12-10 14:14:16', 0, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidosproductos`
--

CREATE TABLE `pedidosproductos` (
  `CodPedProd` int(11) NOT NULL,
  `Pedido` int(11) NOT NULL,
  `Producto` int(11) NOT NULL,
  `Unidades` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidosproductos`
--

INSERT INTO `pedidosproductos` (`CodPedProd`, `Pedido`, `Producto`, `Unidades`) VALUES
(65, 79, 5, 1),
(66, 79, 2, 4),
(67, 80, 5, 1),
(68, 81, 3, 1),
(69, 81, 4, 1),
(70, 82, 6, 1),
(71, 82, 3, 1),
(72, 83, 5, 1),
(73, 84, 5, 1),
(74, 85, 3, 1),
(75, 86, 6, 1),
(76, 87, 1, 3),
(77, 87, 2, 1),
(78, 88, 6, 1),
(79, 89, 6, 1),
(80, 89, 5, 1),
(81, 89, 1, 1),
(82, 90, 5, 2),
(83, 90, 6, 3),
(84, 90, 3, 3),
(85, 90, 4, 2),
(86, 91, 5, 1),
(87, 91, 6, 1),
(88, 92, 5, 1),
(89, 92, 6, 1),
(90, 93, 5, 1),
(91, 93, 6, 1),
(92, 94, 5, 1),
(93, 95, 5, 1),
(94, 96, 5, 1),
(95, 97, 5, 1),
(96, 98, 5, 1),
(97, 99, 5, 1),
(98, 100, 5, 1),
(99, 101, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `CodProd` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Descripcion` varchar(90) NOT NULL,
  `Peso` float NOT NULL,
  `Stock` int(11) NOT NULL,
  `Categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`CodProd`, `Nombre`, `Descripcion`, `Peso`, `Stock`, `Categoria`) VALUES
(1, 'Harina', '8 paquetes de 1kg de harina cada uno', 8, 94, 1),
(2, 'Sal', '20 paquetes de 1kg cada uno', 20, 3, 1),
(3, 'Agua 0.5', '100 botellas de 0.5 litros cada una', 51, 85, 2),
(4, 'Agua 1.5', '20 botellas de 1.5 litros cada una', 31, 45, 2),
(5, 'Cerveza Alhambra tercio', '24 botellas de 33cl', 10, 12, 3),
(6, 'Vino tinto Rioja 0.75', '6 botellas de 0.75 ', 5.5, 7, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurantes`
--

CREATE TABLE `restaurantes` (
  `CodRes` int(11) NOT NULL,
  `Correo` varchar(90) NOT NULL,
  `Clave` varchar(45) NOT NULL,
  `Pais` varchar(45) NOT NULL,
  `CP` int(5) DEFAULT NULL,
  `Ciudad` varchar(45) NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `Rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `restaurantes`
--

INSERT INTO `restaurantes` (`CodRes`, `Correo`, `Clave`, `Pais`, `CP`, `Ciudad`, `Direccion`, `Rol`) VALUES
(1, 'madrid1@empresa.com', '1234', 'España', 28002, 'Madrid', 'C/ Padre  Claret, 8', 1),
(2, 'cadiz1@empresa.com', '1234', 'España', 11001, 'Cádiz', 'C/ Portales, 2 ', 0),
(3, 'nailik.j.93@gmail.com', '1234', 'España', 11001, 'Cádiz', 'C/ El cielo infinito, 2 ', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`CodCat`),
  ADD UNIQUE KEY `UN_NOM_CAT` (`Nombre`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`CodPed`),
  ADD KEY `Restaurante` (`Restaurante`);

--
-- Indices de la tabla `pedidosproductos`
--
ALTER TABLE `pedidosproductos`
  ADD PRIMARY KEY (`CodPedProd`),
  ADD KEY `CodPed` (`Pedido`),
  ADD KEY `CodProd` (`Producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`CodProd`),
  ADD KEY `Categoria` (`Categoria`);

--
-- Indices de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD PRIMARY KEY (`CodRes`),
  ADD UNIQUE KEY `UN_RES_COR` (`Correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `CodCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `CodPed` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT de la tabla `pedidosproductos`
--
ALTER TABLE `pedidosproductos`
  MODIFY `CodPedProd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `CodProd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  MODIFY `CodRes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`Restaurante`) REFERENCES `restaurantes` (`CodRes`);

--
-- Filtros para la tabla `pedidosproductos`
--
ALTER TABLE `pedidosproductos`
  ADD CONSTRAINT `pedidosproductos_ibfk_1` FOREIGN KEY (`Pedido`) REFERENCES `pedidos` (`CodPed`),
  ADD CONSTRAINT `pedidosproductos_ibfk_2` FOREIGN KEY (`Producto`) REFERENCES `productos` (`CodProd`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`Categoria`) REFERENCES `categorias` (`CodCat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
