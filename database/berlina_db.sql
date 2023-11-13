-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2023 a las 23:56:36
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `berlina_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cervezas`
--

CREATE TABLE `cervezas` (
  `id_cerveza` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `IBU` float NOT NULL,
  `ALC` float NOT NULL,
  `id_estilo` int(11) NOT NULL,
  `stock` int(100) NOT NULL,
  `descripcion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cervezas`
--

INSERT INTO `cervezas` (`id_cerveza`, `nombre`, `IBU`, `ALC`, `id_estilo`, `stock`, `descripcion`) VALUES
(1, 'Old Ale', 19, 7.5, 5, 50, 'De color granate, gran cuerpo y espiritu apartado por un blend de 6 maltas caramelizadas. Su perfil maltoso, alicorado y dulzon, con notas de vainilla y un reposo de madurador de 60 dias , hacen de esta una cerveza de gran cuerpo'),
(4, 'Raices', 32, 4, 1, 50, 'Una pale ale de estilo americano con un 100% de lupulo Victoria cosechado en El bolson que le aporta notas a Maracuya y Mandarina y con adicion de ralladura de raiz de Jengibre en el whirlpool, es por eso que decimos que es un GINGER PALE ALE'),
(5, 'Colonia Suiza', 21, 7, 3, 20, 'Cerveza rubia de gran cuerpo y complejidad en boca enriquecida, gracias al caracter especiado y el perfil espirituoso de las bayas de enebro silvestres'),
(6, 'IPA', 56, 5, 2, 60, 'Predominio de maltas caramelizadas. Caracter intenso debido a la cantidad de lúpulo que la compone. De amargor bien marcado'),
(16, 'Sunshine', 52, 43, 1, 7, 'Probando metodo POST'),
(19, 'Lorenzo´s', 8, 1, 2, 22, 'goat'),
(23, 'Nina´s', 22, 33, 3, 45, 'relleno3'),
(24, 'OktoberFest', 22, 33, 3, 45, 'relleno4'),
(25, 'paginando5', 22, 33, 3, 45, 'relleno5'),
(26, 'paginando6', 22, 33, 3, 45, 'relleno6'),
(27, 'paginando7', 22, 33, 3, 45, 'relleno7'),
(28, 'paginando8', 22, 33, 3, 45, 'relleno8'),
(29, 'paginando9', 22, 33, 3, 45, 'relleno9'),
(30, 'paginando10', 22, 33, 3, 45, 'relleno10'),
(31, 'paginando11', 22, 33, 3, 45, 'relleno11'),
(32, 'Red IPA', 12, 15, 2, 33, 'prueba'),
(33, 'Black IPA', 12, 15, 2, 33, 'prueba'),
(34, 'Golden IPA', 12, 15, 2, 33, 'prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `detalle` varchar(255) NOT NULL,
  `id_cerveza` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estilos`
--

CREATE TABLE `estilos` (
  `id_estilo` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estilos`
--

INSERT INTO `estilos` (`id_estilo`, `nombre`) VALUES
(1, 'Ginger pale ale'),
(2, 'IPA (india pale ale)'),
(3, 'Golden Ale'),
(4, 'Stout'),
(5, 'Blend'),
(11, 'editado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `rol` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `contraseña`, `rol`) VALUES
(10, 'admin', 'admin@gmail.com', '$2y$10$x4oOMRTpOlKWFauBFOZ62uNixivfwQLgA4kY1q6eSLELuzGqlfg12', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cervezas`
--
ALTER TABLE `cervezas`
  ADD PRIMARY KEY (`id_cerveza`),
  ADD KEY `estilo_id` (`id_estilo`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_cerveza` (`id_cerveza`) USING BTREE;

--
-- Indices de la tabla `estilos`
--
ALTER TABLE `estilos`
  ADD PRIMARY KEY (`id_estilo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cervezas`
--
ALTER TABLE `cervezas`
  MODIFY `id_cerveza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `estilos`
--
ALTER TABLE `estilos`
  MODIFY `id_estilo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cervezas`
--
ALTER TABLE `cervezas`
  ADD CONSTRAINT `estilo_id` FOREIGN KEY (`id_estilo`) REFERENCES `estilos` (`id_estilo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `id_cerveza` FOREIGN KEY (`id_cerveza`) REFERENCES `cervezas` (`id_cerveza`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

