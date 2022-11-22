/*
 Navicat Premium Data Transfer

 Source Server         : FarmaRAM
 Source Server Type    : MySQL
 Source Server Version : 100419
 Source Host           : localhost:3306
 Source Schema         : db_almacen

 Target Server Type    : MySQL
 Target Server Version : 100419
 File Encoding         : 65001

 Date: 22/11/2022 12:56:56
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for op_books_disponibles
-- ----------------------------
DROP TABLE IF EXISTS `op_books_disponibles`;
CREATE TABLE `op_books_disponibles`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_libro` int(11) NOT NULL,
  `c_disponibles` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_op_books_disponibles_tb_libro_1`(`fk_libro`) USING BTREE,
  CONSTRAINT `fk_op_books_disponibles_tb_libro_1` FOREIGN KEY (`fk_libro`) REFERENCES `tb_libro` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of op_books_disponibles
-- ----------------------------
INSERT INTO `op_books_disponibles` VALUES (29, 52, 127);
INSERT INTO `op_books_disponibles` VALUES (30, 51, 127);
INSERT INTO `op_books_disponibles` VALUES (31, 53, 139);
INSERT INTO `op_books_disponibles` VALUES (32, 56, 50);
INSERT INTO `op_books_disponibles` VALUES (33, 55, 8);
INSERT INTO `op_books_disponibles` VALUES (34, 54, 8);

-- ----------------------------
-- Table structure for op_historial_libroestudiante
-- ----------------------------
DROP TABLE IF EXISTS `op_historial_libroestudiante`;
CREATE TABLE `op_historial_libroestudiante`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_estudiante` int(11) NOT NULL,
  `fk_libro` int(11) NOT NULL,
  `date_entrega` int(11) NOT NULL,
  `date_devol` int(11) NULL DEFAULT NULL,
  `status` int(2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_op_historial_libroestudiante_tb_estudiante_1`(`fk_estudiante`) USING BTREE,
  INDEX `fk_op_historial_libroestudiante_tb_libro_1`(`fk_libro`) USING BTREE,
  CONSTRAINT `fk_op_historial_libroestudiante_tb_estudiante_1` FOREIGN KEY (`fk_estudiante`) REFERENCES `tb_estudiante` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_op_historial_libroestudiante_tb_libro_1` FOREIGN KEY (`fk_libro`) REFERENCES `tb_libro` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 208 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of op_historial_libroestudiante
-- ----------------------------
INSERT INTO `op_historial_libroestudiante` VALUES (197, 102, 52, 1662354000, NULL, 1);
INSERT INTO `op_historial_libroestudiante` VALUES (198, 106, 52, 1662008400, NULL, 1);
INSERT INTO `op_historial_libroestudiante` VALUES (199, 107, 52, 1662354000, 1665896400, 2);
INSERT INTO `op_historial_libroestudiante` VALUES (200, 107, 51, 1662354000, 1665896400, 3);
INSERT INTO `op_historial_libroestudiante` VALUES (202, 102, 56, 1642053600, NULL, 1);
INSERT INTO `op_historial_libroestudiante` VALUES (203, 102, 55, 1642744800, NULL, 1);
INSERT INTO `op_historial_libroestudiante` VALUES (204, 102, 54, 1665464400, NULL, 1);
INSERT INTO `op_historial_libroestudiante` VALUES (205, 109, 56, 1662008400, 1667106000, 3);
INSERT INTO `op_historial_libroestudiante` VALUES (206, 109, 56, 1669183200, 1669788000, 3);
INSERT INTO `op_historial_libroestudiante` VALUES (207, 109, 56, 1668751200, NULL, 1);

-- ----------------------------
-- Table structure for tb_brigada
-- ----------------------------
DROP TABLE IF EXISTS `tb_brigada`;
CREATE TABLE `tb_brigada`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brigada` varchar(11) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_brigada
-- ----------------------------
INSERT INTO `tb_brigada` VALUES (1, 'A');
INSERT INTO `tb_brigada` VALUES (2, 'B');
INSERT INTO `tb_brigada` VALUES (3, 'C');

-- ----------------------------
-- Table structure for tb_carrera
-- ----------------------------
DROP TABLE IF EXISTS `tb_carrera`;
CREATE TABLE `tb_carrera`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carrera` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_carrera
-- ----------------------------
INSERT INTO `tb_carrera` VALUES (1, 'MEDICINA');
INSERT INTO `tb_carrera` VALUES (2, 'ENFERMERIA');
INSERT INTO `tb_carrera` VALUES (3, 'TECNOLOGIAS');

-- ----------------------------
-- Table structure for tb_comment
-- ----------------------------
DROP TABLE IF EXISTS `tb_comment`;
CREATE TABLE `tb_comment`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_estudiante` int(11) NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `comment` varchar(350) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_estudiante`(`fk_estudiante`) USING BTREE,
  CONSTRAINT `tb_comment_ibfk_1` FOREIGN KEY (`fk_estudiante`) REFERENCES `tb_estudiante` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_comment
-- ----------------------------
INSERT INTO `tb_comment` VALUES (8, 102, 'assadsadsd', 'sasdasdsa');
INSERT INTO `tb_comment` VALUES (9, 102, 'assadsadsd', 'sasdasdsa');
INSERT INTO `tb_comment` VALUES (10, 102, 'sasdasdassdas', 'dasdasdasdasdasdasd');
INSERT INTO `tb_comment` VALUES (11, 102, 'asdasdasdasdaasd', 'sdasdasadasdas');
INSERT INTO `tb_comment` VALUES (12, 102, 'asdasdasdasdaasd', 'sdasdasadasdas');
INSERT INTO `tb_comment` VALUES (13, 109, 'Libros de programacion', 'Necesidad de obtener libros para programar ');

-- ----------------------------
-- Table structure for tb_estudiante
-- ----------------------------
DROP TABLE IF EXISTS `tb_estudiante`;
CREATE TABLE `tb_estudiante`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ci` varchar(12) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `lastname` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nation` tinyint(1) NULL DEFAULT 0,
  `direccion` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fk_carrera` int(11) NOT NULL,
  `fk_year_academico` int(11) NOT NULL,
  `fk_brigada` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_tb_estudiante_tb_carrera_1`(`fk_carrera`) USING BTREE,
  INDEX `fk_tb_estudiante_tb_brigada_1`(`fk_brigada`) USING BTREE,
  INDEX `fk_tb_estudiante_tb_year_academico_1`(`fk_year_academico`) USING BTREE,
  CONSTRAINT `fk_tb_estudiante_tb_brigada_1` FOREIGN KEY (`fk_brigada`) REFERENCES `tb_brigada` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_tb_estudiante_tb_carrera_1` FOREIGN KEY (`fk_carrera`) REFERENCES `tb_carrera` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_tb_estudiante_tb_year_academico_1` FOREIGN KEY (`fk_year_academico`) REFERENCES `tb_year_academico` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 110 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_estudiante
-- ----------------------------
INSERT INTO `tb_estudiante` VALUES (102, '92102047481', 'ALEJANDRO', 'SOSA GOMEZ', 0, 'Cuba-cu-Manzanillo Reparto Cespedez #6', 1, 2, 1, 0);
INSERT INTO `tb_estudiante` VALUES (106, '45481215785', 'LEANDRO', 'POZO CASTRO', 0, 'Cuba-cu-Niquero Reparto Vazquez', 3, 1, 1, 0);
INSERT INTO `tb_estudiante` VALUES (107, '23234234232', 'JUAN', 'SUAREZ CESPEDEZ', 1, 'Guinea Ecuatorial-gq-Estus', 1, 1, 1, 0);
INSERT INTO `tb_estudiante` VALUES (108, '22222222222', 'JUANA', 'CASTRO LASTRE', 0, 'Cuba-cu-34 Malecon', 1, 1, 1, 0);
INSERT INTO `tb_estudiante` VALUES (109, '77777777777', 'FIDEL', 'AS ASDTEF', 1, 'Afganistán-af-Estus', 1, 1, 1, 0);

-- ----------------------------
-- Table structure for tb_libro
-- ----------------------------
DROP TABLE IF EXISTS `tb_libro`;
CREATE TABLE `tb_libro`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(11) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `titulo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `portada` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `precio` varchar(11) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `autor` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `isbn` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 57 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_libro
-- ----------------------------
INSERT INTO `tb_libro` VALUES (51, 'RES-458', 'PHP', '1663818188_3c794c598375d9db95d5.jpeg', '126.35', 'ARTUH GONSAS', '458-ASA458-48', 89);
INSERT INTO `tb_libro` VALUES (52, 'RES-459', 'JS', '1663818265_d6c55dffcad27908ebdc.jpeg', '14.56', 'JUAN SOSA AGUILERA', '458-ASA458-48', 195);
INSERT INTO `tb_libro` VALUES (53, 'RES-462', 'SQL', '1664663405_e13f7534b5e0fa0e607b.jpg', '136.84', 'ARTUH ERTHREES', '458-ASA458-48', 170);
INSERT INTO `tb_libro` VALUES (54, 'RES-460', 'ANGULAR', '1665783046_4bb4e0e1c3521e456e89.jpg', '14.56', 'ARTUH GONSAS', '45484-454', 434);
INSERT INTO `tb_libro` VALUES (55, 'RES-461', 'REACT', '1665783084_24a2174b40a68717d44b.jpg', '126.35', 'ARTUH GONSAS', '458-ASA458-48', 47);
INSERT INTO `tb_libro` VALUES (56, 'RES-463', 'VUE', '1665783110_705ab79688e1dbe074cd.jpg', '126.35', 'ARTUH GONSAS', '45484-454', 62);

-- ----------------------------
-- Table structure for tb_order
-- ----------------------------
DROP TABLE IF EXISTS `tb_order`;
CREATE TABLE `tb_order`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_estudiante` int(11) NOT NULL,
  `libros_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `pay` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `date_order` int(11) NOT NULL,
  `date_okay` int(11) NULL DEFAULT NULL,
  `condition` int(1) NULL DEFAULT 0 COMMENT '0 = esperando respuesta, 1=pagado, 2=cancelado, 3=aprobado',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_estudiante`(`fk_estudiante`) USING BTREE,
  CONSTRAINT `tb_order_ibfk_1` FOREIGN KEY (`fk_estudiante`) REFERENCES `tb_estudiante` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 80 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_order
-- ----------------------------
INSERT INTO `tb_order` VALUES (73, 102, '30,29', '140.91', 1668199399, 1668232800, 1);
INSERT INTO `tb_order` VALUES (74, 102, '31,34,33', '277.75', 1668199496, 1668232800, 1);
INSERT INTO `tb_order` VALUES (75, 109, '34,33,32', '267.26', 1668199529, 1668232800, 1);
INSERT INTO `tb_order` VALUES (76, 109, '29,31,34,33', '292.31', 1668199545, 1668232800, 1);
INSERT INTO `tb_order` VALUES (77, 109, '30,29,31,34,33,32', '545.01', 1668219780, 1668664800, 3);
INSERT INTO `tb_order` VALUES (78, 102, '30,29', '140.91', 1668356490, NULL, 0);
INSERT INTO `tb_order` VALUES (79, 102, '31,34,33,32', '404.10', 1668356642, NULL, 2);

-- ----------------------------
-- Table structure for tb_users
-- ----------------------------
DROP TABLE IF EXISTS `tb_users`;
CREATE TABLE `tb_users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'usuario',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `rol` int(2) NOT NULL DEFAULT 3,
  `logged` int(1) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_users
-- ----------------------------
INSERT INTO `tb_users` VALUES (1, 'root', '1234', 1, 0);
INSERT INTO `tb_users` VALUES (13, 'usuario', '92102047481', 3, 0);
INSERT INTO `tb_users` VALUES (17, 'usuario', '45481215785', 3, 0);
INSERT INTO `tb_users` VALUES (18, 'usuario', '23234234232', 3, 0);
INSERT INTO `tb_users` VALUES (19, 'usuario', '22222222222', 3, 0);
INSERT INTO `tb_users` VALUES (20, 'usuario', '77777777777', 3, 1);

-- ----------------------------
-- Table structure for tb_year_academico
-- ----------------------------
DROP TABLE IF EXISTS `tb_year_academico`;
CREATE TABLE `tb_year_academico`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `anno_academico` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_year_academico
-- ----------------------------
INSERT INTO `tb_year_academico` VALUES (1, '2018/2019');
INSERT INTO `tb_year_academico` VALUES (2, '2019/2020');
INSERT INTO `tb_year_academico` VALUES (3, '2020/2021');
INSERT INTO `tb_year_academico` VALUES (4, '2021/2022');

SET FOREIGN_KEY_CHECKS = 1;
