-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-09-2022 a las 08:57:55
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_almacen`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `op_books_disponibles`
--

CREATE TABLE `op_books_disponibles` (
  `id` int(11) NOT NULL,
  `fk_libro` int(11) NOT NULL,
  `c_disponibles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `op_historial_libroestudiante`
--

CREATE TABLE `op_historial_libroestudiante` (
  `id` int(11) NOT NULL,
  `fk_estudiante` int(11) NOT NULL,
  `fk_libro` int(11) NOT NULL,
  `date_entrega` int(11) NOT NULL,
  `date_devol` int(11) DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_brigada`
--

CREATE TABLE `tb_brigada` (
  `id` int(11) NOT NULL,
  `brigada` varchar(11) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tb_brigada`
--

INSERT INTO `tb_brigada` (`id`, `brigada`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_carrera`
--

CREATE TABLE `tb_carrera` (
  `id` int(11) NOT NULL,
  `carrera` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tb_carrera`
--

INSERT INTO `tb_carrera` (`id`, `carrera`) VALUES
(1, 'MEDICINA'),
(2, 'ENFERMERIA'),
(3, 'TECNOLOGIAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_estudiante`
--

CREATE TABLE `tb_estudiante` (
  `id` int(11) NOT NULL,
  `ci` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `lastname` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fk_municipio` int(11) NOT NULL,
  `fk_carrera` int(11) NOT NULL,
  `fk_year_academico` int(11) NOT NULL,
  `fk_brigada` int(11) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_libro`
--

CREATE TABLE `tb_libro` (
  `id` int(11) NOT NULL,
  `codigo` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `titulo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `precio` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `autor` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `isbn` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tb_libro`
--

INSERT INTO `tb_libro` (`id`, `codigo`, `titulo`, `precio`, `autor`, `isbn`, `cantidad`) VALUES
(32, 'AB-5', 'JS', '12.36', 'JUAN', '45484-454', 125),
(33, 'AB-6', 'PHP', '14.56', 'JUAN', '45484-454', 116);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_municipio`
--

CREATE TABLE `tb_municipio` (
  `id` int(11) NOT NULL,
  `municipio` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tb_municipio`
--

INSERT INTO `tb_municipio` (`id`, `municipio`) VALUES
(1, 'MANZANILLO'),
(2, 'NIQUERO'),
(3, 'PILON'),
(4, 'CAMPECHUELA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `usuario` varchar(25) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'usuario',
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `rol` int(2) NOT NULL DEFAULT 3,
  `logged` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tb_users`
--

INSERT INTO `tb_users` (`id`, `usuario`, `password`, `rol`, `logged`) VALUES
(1, 'root', '1234', 1, 0),
(2, 'colab', '1234', 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_year_academico`
--

CREATE TABLE `tb_year_academico` (
  `id` int(11) NOT NULL,
  `anno_academico` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tb_year_academico`
--

INSERT INTO `tb_year_academico` (`id`, `anno_academico`) VALUES
(1, '2018/2019'),
(2, '2019/2020'),
(3, '2020/2021'),
(4, '2021/2022');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `op_books_disponibles`
--
ALTER TABLE `op_books_disponibles`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `fk_op_books_disponibles_tb_libro_1` (`fk_libro`) USING BTREE;

--
-- Indices de la tabla `op_historial_libroestudiante`
--
ALTER TABLE `op_historial_libroestudiante`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `fk_op_historial_libroestudiante_tb_estudiante_1` (`fk_estudiante`) USING BTREE,
  ADD KEY `fk_op_historial_libroestudiante_tb_libro_1` (`fk_libro`) USING BTREE;

--
-- Indices de la tabla `tb_brigada`
--
ALTER TABLE `tb_brigada`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `tb_carrera`
--
ALTER TABLE `tb_carrera`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `tb_estudiante`
--
ALTER TABLE `tb_estudiante`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `fk_tb_estudiante_tb_carrera_1` (`fk_carrera`) USING BTREE,
  ADD KEY `fk_tb_estudiante_tb_municipio_1` (`fk_municipio`) USING BTREE,
  ADD KEY `fk_tb_estudiante_tb_brigada_1` (`fk_brigada`) USING BTREE,
  ADD KEY `fk_tb_estudiante_tb_year_academico_1` (`fk_year_academico`) USING BTREE;

--
-- Indices de la tabla `tb_libro`
--
ALTER TABLE `tb_libro`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `tb_municipio`
--
ALTER TABLE `tb_municipio`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `tb_year_academico`
--
ALTER TABLE `tb_year_academico`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `op_books_disponibles`
--
ALTER TABLE `op_books_disponibles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `op_historial_libroestudiante`
--
ALTER TABLE `op_historial_libroestudiante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT de la tabla `tb_brigada`
--
ALTER TABLE `tb_brigada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tb_carrera`
--
ALTER TABLE `tb_carrera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tb_estudiante`
--
ALTER TABLE `tb_estudiante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `tb_libro`
--
ALTER TABLE `tb_libro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `tb_municipio`
--
ALTER TABLE `tb_municipio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tb_year_academico`
--
ALTER TABLE `tb_year_academico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `op_books_disponibles`
--
ALTER TABLE `op_books_disponibles`
  ADD CONSTRAINT `fk_op_books_disponibles_tb_libro_1` FOREIGN KEY (`fk_libro`) REFERENCES `tb_libro` (`id`);

--
-- Filtros para la tabla `op_historial_libroestudiante`
--
ALTER TABLE `op_historial_libroestudiante`
  ADD CONSTRAINT `fk_op_historial_libroestudiante_tb_estudiante_1` FOREIGN KEY (`fk_estudiante`) REFERENCES `tb_estudiante` (`id`),
  ADD CONSTRAINT `fk_op_historial_libroestudiante_tb_libro_1` FOREIGN KEY (`fk_libro`) REFERENCES `tb_libro` (`id`);

--
-- Filtros para la tabla `tb_estudiante`
--
ALTER TABLE `tb_estudiante`
  ADD CONSTRAINT `fk_tb_estudiante_tb_brigada_1` FOREIGN KEY (`fk_brigada`) REFERENCES `tb_brigada` (`id`),
  ADD CONSTRAINT `fk_tb_estudiante_tb_carrera_1` FOREIGN KEY (`fk_carrera`) REFERENCES `tb_carrera` (`id`),
  ADD CONSTRAINT `fk_tb_estudiante_tb_municipio_1` FOREIGN KEY (`fk_municipio`) REFERENCES `tb_municipio` (`id`),
  ADD CONSTRAINT `fk_tb_estudiante_tb_year_academico_1` FOREIGN KEY (`fk_year_academico`) REFERENCES `tb_year_academico` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
