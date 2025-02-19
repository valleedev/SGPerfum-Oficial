-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 19-02-2025 a las 04:37:52
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sgperfumdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id_detalle` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_perfume` int(11) NOT NULL,
  `id_envase` int(11) NOT NULL,
  `gramos_en_venta` decimal(10,2) NOT NULL,
  `gramos_adicionales` decimal(10,2) NOT NULL,
  `valor_venta` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id_detalle`, `id_venta`, `id_perfume`, `id_envase`, `gramos_en_venta`, `gramos_adicionales`, `valor_venta`) VALUES
(5, 6, 2, 2, 0.00, 0.00, 0.00),
(6, 6, 3, 1, 0.00, 0.00, 0.00),
(7, 7, 2, 1, 0.00, 0.00, 0.00),
(8, 7, 3, 1, 0.00, 0.00, 0.00),
(9, 8, 2, 3, 0.00, 0.00, 0.00),
(10, 8, 3, 1, 0.00, 0.00, 0.00),
(11, 12, 3, 1, 13.00, 1.00, 0.00),
(12, 14, 3, 1, 13.00, 1.00, 20001.00),
(13, 15, 3, 2, 24.00, 1.00, 31500.00),
(14, 16, 3, 1, 12.00, 0.00, 20000.00),
(15, 17, 3, 1, 12.00, 0.00, 20000.00),
(17, 19, 3, 2, 23.00, 0.00, 30000.00),
(18, 20, 3, 1, 12.00, 0.00, 20000.00),
(19, 22, 2, 1, 12.00, 0.00, 20000.00),
(20, 23, 8, 1, 12.00, 0.00, 100000.00),
(21, 23, 3, 2, 23.00, 0.00, 100000.00),
(22, 23, 7, 2, 23.00, 0.00, 100000.00),
(23, 23, 6, 1, 12.00, 0.00, 100000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envases`
--

CREATE TABLE `envases` (
  `id_envase` int(11) NOT NULL,
  `capacidad_mls` decimal(10,2) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `envases`
--

INSERT INTO `envases` (`id_envase`, `capacidad_mls`, `precio`, `stock`) VALUES
(1, 30.00, 20000.00, 100),
(2, 50.00, 30000.00, 100),
(3, 38.00, 50000.00, 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gramos_adicionales`
--

CREATE TABLE `gramos_adicionales` (
  `id_gramo` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfumes`
--

CREATE TABLE `perfumes` (
  `id_perfume` int(11) NOT NULL,
  `clave_bouquet` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `casa` varchar(100) NOT NULL,
  `familia_olfativa` varchar(50) NOT NULL,
  `genero` enum('Masculino','Femenino','Unisex') NOT NULL,
  `cantidad` int(11) NOT NULL CHECK (`cantidad` >= 0),
  `imagen` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfumes`
--

INSERT INTO `perfumes` (`id_perfume`, `clave_bouquet`, `nombre`, `casa`, `familia_olfativa`, `genero`, `cantidad`, `imagen`) VALUES
(2, 354, 'One Million Prive', 'Paco Ravanne', 'Oriental Floral', 'Masculino', 200, '2.jpeg'),
(3, 283, 'Tender Romance', 'Ralph Lauren', 'Oriental Floral', 'Femenino', 200, '3.jpg'),
(4, 355, 'Good Girl', 'Carolina Herrera', 'Oriental Floral', 'Femenino', 200, '4.jpg'),
(5, 356, 'Bad', 'Diesel', 'Maderosa Aromática', 'Masculino', 500, '5.jpg'),
(6, 486, 'Viva la Juicy', 'Juicy Couture', 'Floral Frutal', 'Femenino', 500, '6.jpg'),
(7, 484, 'Fantasy in Bloom', 'Britney Spears', 'Floral Frutal', 'Femenino', 700, '7.jpg'),
(8, 1125, 'lacoste red', 'lacoste', 'Aromática Fouguere', 'Masculino', 100, '8.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `contrasena` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `contrasena`) VALUES
(1, 'Sebastian Valle', 'vallebarbaranj@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_usuario`, `fecha_hora`) VALUES
(6, 1, '2025-02-18 20:58:34'),
(7, 1, '2025-02-18 21:07:35'),
(8, 1, '2025-02-18 21:07:59'),
(9, 1, '2025-02-18 21:11:58'),
(10, 1, '2025-02-18 21:15:02'),
(11, 1, '2025-02-18 21:16:34'),
(12, 1, '2025-02-18 21:17:48'),
(13, 1, '2025-02-18 21:22:03'),
(14, 1, '2025-02-18 21:22:25'),
(15, 1, '2025-02-18 21:22:58'),
(16, 1, '2025-02-18 21:27:08'),
(17, 1, '2025-02-18 21:27:25'),
(18, 1, '2025-02-18 21:34:04'),
(19, 1, '2025-02-18 21:35:52'),
(20, 1, '2025-02-18 21:37:34'),
(21, 1, '2025-02-18 21:41:05'),
(22, 1, '2025-02-18 21:58:43'),
(23, 1, '2025-02-18 22:34:06');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_perfume` (`id_perfume`),
  ADD KEY `id_envase` (`id_envase`);

--
-- Indices de la tabla `envases`
--
ALTER TABLE `envases`
  ADD PRIMARY KEY (`id_envase`);

--
-- Indices de la tabla `gramos_adicionales`
--
ALTER TABLE `gramos_adicionales`
  ADD PRIMARY KEY (`id_gramo`);

--
-- Indices de la tabla `perfumes`
--
ALTER TABLE `perfumes`
  ADD PRIMARY KEY (`id_perfume`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `envases`
--
ALTER TABLE `envases`
  MODIFY `id_envase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `gramos_adicionales`
--
ALTER TABLE `gramos_adicionales`
  MODIFY `id_gramo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `perfumes`
--
ALTER TABLE `perfumes`
  MODIFY `id_perfume` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD CONSTRAINT `detalle_ventas_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`),
  ADD CONSTRAINT `detalle_ventas_ibfk_2` FOREIGN KEY (`id_perfume`) REFERENCES `perfumes` (`id_perfume`),
  ADD CONSTRAINT `detalle_ventas_ibfk_3` FOREIGN KEY (`id_envase`) REFERENCES `envases` (`id_envase`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
