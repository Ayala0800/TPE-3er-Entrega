-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2023 a las 02:04:38
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
(2, 'Sureña', 28, 5, 6, 30, 'A base de maltas caramelizadas que le otrogan un profundo , pero cristalino tono ambár con reflejos rojiizos. Cristalina y profunda como los lagos del sur argentino  '),
(3, 'Nitro Stout', 38, 6.5, 4, 50, 'Cerveza robusta, con mucho cuerpo y mayor densidad. Color petroleo, otrogado por la utilizacion de maltas tostadas en su elaboracion. Cerveza torrada, con sabores a cafe y madera'),
(4, 'Raices', 32, 4, 1, 50, 'Una pale ale de estilo americano con un 100% de lupulo Victoria cosechado en El bolson que le aporta notas a Maracuya y Mandarina y con adicion de ralladura de raiz de Jengibre en el whirlpool, es por eso que decimos que es un GINGER PALE ALE'),
(5, 'Colonia Suiza', 21, 7, 3, 20, 'Cerveza rubia de gran cuerpo y complejidad en boca enriquecida, gracias al caracter especiado y el perfil espirituoso de las bayas de enebro silvestres'),
(6, 'IPA', 56, 5, 2, 60, 'Predominio de maltas caramelizadas. Caracter intenso debido a la cantidad de lúpulo que la compone. De amargor bien marcado'),
(7, 'Old Ale', 38, 7, 5, 8, 'De color granate, gran cuerpo y espiritu aportado por un blend de 6 maltas caramelizadas.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(45) NOT NULL,
  `descripcion` varchar(400) NOT NULL,
  `id_cerveza` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `descripcion`, `id_cerveza`, `fecha_hora`) VALUES
(1, 'Muy rica!', 4, '0000-00-00 00:00:00');

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
(3, 'Golden Ale'),
(4, 'Stout'),
(6, 'Amber Ale'),
(7, 'Blond Ale');

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
  ADD PRIMARY KEY (`id_cerveza`) USING BTREE,
  ADD KEY `id_estilo` (`id_estilo`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_cerveza` (`id_cerveza`);

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
  MODIFY `id_cerveza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estilos`
--
ALTER TABLE `estilos`
  MODIFY `id_estilo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
