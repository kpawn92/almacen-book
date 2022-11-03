-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 03-11-2022 a las 02:07:38
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

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

--
-- Volcado de datos para la tabla `op_books_disponibles`
--

INSERT INTO `op_books_disponibles` (`id`, `fk_libro`, `c_disponibles`) VALUES
(29, 52, 140),
(30, 51, 139),
(31, 53, 150),
(32, 56, 56),
(33, 55, 15),
(34, 54, 15);

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

--
-- Volcado de datos para la tabla `op_historial_libroestudiante`
--

INSERT INTO `op_historial_libroestudiante` (`id`, `fk_estudiante`, `fk_libro`, `date_entrega`, `date_devol`, `status`) VALUES
(197, 102, 52, 1662354000, NULL, 1),
(198, 106, 52, 1662008400, NULL, 1),
(199, 107, 52, 1662354000, 1665896400, 2),
(200, 107, 51, 1662354000, 1665896400, 3),
(201, 107, 56, 1664773200, 1667106000, 3),
(202, 102, 56, 1642053600, NULL, 1),
(203, 102, 55, 1642744800, NULL, 1),
(204, 102, 54, 1665464400, NULL, 1),
(205, 109, 56, 1662008400, 1667106000, 3);

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
  `ci` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `lastname` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `nation` tinyint(1) DEFAULT 0,
  `direccion` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `fk_carrera` int(11) NOT NULL,
  `fk_year_academico` int(11) NOT NULL,
  `fk_brigada` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tb_estudiante`
--

INSERT INTO `tb_estudiante` (`id`, `ci`, `nombre`, `lastname`, `nation`, `direccion`, `fk_carrera`, `fk_year_academico`, `fk_brigada`, `status`) VALUES
(102, '92102047481', 'ALEJANDRO', 'SOSA GOMEZ', 0, 'Cuba-cu-Manzanillo Reparto Cespedez #6', 1, 2, 1, 0),
(106, '45481215785', 'LEANDRO', 'POZO CASTRO', 0, 'Cuba-cu-Niquero Reparto Vazquez', 3, 1, 1, 0),
(107, '23234234232', 'JUAN', 'SUAREZ CESPEDEZ', 1, 'Guinea Ecuatorial-gq-Estus', 1, 1, 1, 0),
(108, '22222222222', 'JUANA', 'CASTRO LASTRE', 0, 'Cuba-cu-34 Malecon', 1, 1, 1, 0),
(109, '77777777777', 'FIDEL', 'AS ASDTEF', 1, 'Afganistán-af-Estus', 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_libro`
--

CREATE TABLE `tb_libro` (
  `id` int(11) NOT NULL,
  `codigo` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `titulo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `portada` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `precio` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `autor` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `isbn` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tb_libro`
--

INSERT INTO `tb_libro` (`id`, `codigo`, `titulo`, `portada`, `precio`, `autor`, `isbn`, `cantidad`) VALUES
(51, 'RES-458', 'PHP', '1663818188_3c794c598375d9db95d5.jpeg', '126.35', 'ARTUH GONSAS', '458-ASA458-48', 89),
(52, 'RES-459', 'JS', '1663818265_d6c55dffcad27908ebdc.jpeg', '14.56', 'JUAN SOSA AGUILERA', '458-ASA458-48', 195),
(53, 'RES-462', 'SQL', '1664663405_e13f7534b5e0fa0e607b.jpg', '136.84', 'ARTUH ERTHREES', '458-ASA458-48', 170),
(54, 'RES-460', 'ANGULAR', '1665783046_4bb4e0e1c3521e456e89.jpg', '14.56', 'ARTUH GONSAS', '45484-454', 434),
(55, 'RES-461', 'REACT', '1665783084_24a2174b40a68717d44b.jpg', '126.35', 'ARTUH GONSAS', '458-ASA458-48', 47),
(56, 'RES-463', 'VUE', '1665783110_705ab79688e1dbe074cd.jpg', '126.35', 'ARTUH GONSAS', '45484-454', 64);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_order`
--

CREATE TABLE `tb_order` (
  `id` int(11) NOT NULL,
  `fk_estudiante` int(11) NOT NULL,
  `libros_id` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `pay` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `date_order` int(11) NOT NULL,
  `date_okay` int(11) DEFAULT NULL,
  `condition` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tb_order`
--

INSERT INTO `tb_order` (`id`, `fk_estudiante`, `libros_id`, `pay`, `date_order`, `date_okay`, `condition`) VALUES
(54, 102, '30,29', '140.91', 1665158160, NULL, 0),
(55, 102, '30,29,31', '277.75', 1665159292, NULL, 1),
(56, 108, '30,29', '140.91', 1665358403, NULL, 0),
(57, 108, '31', '136.84', 1665358408, NULL, 1),
(58, 109, '30,29', '140.91', 1665521828, NULL, 0),
(59, 109, '30,29,31', '277.75', 1665521832, NULL, 1);

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
(13, 'usuario', '92102047481', 3, 0),
(17, 'usuario', '45481215785', 3, 0),
(18, 'usuario', '23234234232', 3, 0),
(19, 'usuario', '22222222222', 3, 0),
(20, 'usuario', '77777777777', 3, 0);

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
  ADD KEY `fk_tb_estudiante_tb_brigada_1` (`fk_brigada`) USING BTREE,
  ADD KEY `fk_tb_estudiante_tb_year_academico_1` (`fk_year_academico`) USING BTREE;

--
-- Indices de la tabla `tb_libro`
--
ALTER TABLE `tb_libro`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `fk_estudiante` (`fk_estudiante`) USING BTREE;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `op_historial_libroestudiante`
--
ALTER TABLE `op_historial_libroestudiante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT de la tabla `tb_libro`
--
ALTER TABLE `tb_libro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  ADD CONSTRAINT `fk_tb_estudiante_tb_year_academico_1` FOREIGN KEY (`fk_year_academico`) REFERENCES `tb_year_academico` (`id`);

--
-- Filtros para la tabla `tb_order`
--
ALTER TABLE `tb_order`
  ADD CONSTRAINT `tb_order_ibfk_1` FOREIGN KEY (`fk_estudiante`) REFERENCES `tb_estudiante` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
