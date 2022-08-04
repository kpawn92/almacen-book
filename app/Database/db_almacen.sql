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

 Date: 04/08/2022 15:00:20
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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of op_books_disponibles
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 108 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of op_historial_libroestudiante
-- ----------------------------
INSERT INTO `op_historial_libroestudiante` VALUES (105, 86, 29, 1656046800, NULL, 1);
INSERT INTO `op_historial_libroestudiante` VALUES (106, 88, 29, 1656046800, NULL, 1);
INSERT INTO `op_historial_libroestudiante` VALUES (107, 88, 31, 1656046800, NULL, 1);

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
INSERT INTO `tb_brigada` VALUES (1, 'primera');
INSERT INTO `tb_brigada` VALUES (2, 'segunda');
INSERT INTO `tb_brigada` VALUES (3, 'tercera');

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
INSERT INTO `tb_carrera` VALUES (1, 'Medicina');
INSERT INTO `tb_carrera` VALUES (2, 'Enfermeria');
INSERT INTO `tb_carrera` VALUES (3, 'Tecnología');

-- ----------------------------
-- Table structure for tb_estudiante
-- ----------------------------
DROP TABLE IF EXISTS `tb_estudiante`;
CREATE TABLE `tb_estudiante`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ci` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `lastname` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fk_municipio` int(11) NOT NULL,
  `fk_carrera` int(11) NOT NULL,
  `fk_year_academico` int(11) NOT NULL,
  `fk_brigada` int(11) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_tb_estudiante_tb_carrera_1`(`fk_carrera`) USING BTREE,
  INDEX `fk_tb_estudiante_tb_municipio_1`(`fk_municipio`) USING BTREE,
  INDEX `fk_tb_estudiante_tb_brigada_1`(`fk_brigada`) USING BTREE,
  INDEX `fk_tb_estudiante_tb_year_academico_1`(`fk_year_academico`) USING BTREE,
  CONSTRAINT `fk_tb_estudiante_tb_brigada_1` FOREIGN KEY (`fk_brigada`) REFERENCES `tb_brigada` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_tb_estudiante_tb_carrera_1` FOREIGN KEY (`fk_carrera`) REFERENCES `tb_carrera` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_tb_estudiante_tb_municipio_1` FOREIGN KEY (`fk_municipio`) REFERENCES `tb_municipio` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_tb_estudiante_tb_year_academico_1` FOREIGN KEY (`fk_year_academico`) REFERENCES `tb_year_academico` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 89 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_estudiante
-- ----------------------------
INSERT INTO `tb_estudiante` VALUES (83, '34234234234', 'dasdad', 'asdasda', 'sdasdasdas', 1, 1, 1, 1, 0);
INSERT INTO `tb_estudiante` VALUES (84, '44234234222', 'Juan Carlos', 'asdasda', 'sdasdasdas', 3, 2, 1, 1, 0);
INSERT INTO `tb_estudiante` VALUES (85, '92102047481', 'Heriberto ', 'Pozo', 'DSDSDASADSAS', 1, 2, 1, 1, 0);
INSERT INTO `tb_estudiante` VALUES (86, '54545454545', 'Juan', 'Wide', 'fsdsdsdaSASASASASA', 1, 1, 1, 1, 0);
INSERT INTO `tb_estudiante` VALUES (87, '12312131231', 'dsassds', 'sadasdada', 'asdasd', 1, 1, 1, 1, 0);
INSERT INTO `tb_estudiante` VALUES (88, '33333333333', 'otro', 'asas', 'asas', 1, 1, 1, 1, 0);

-- ----------------------------
-- Table structure for tb_libro
-- ----------------------------
DROP TABLE IF EXISTS `tb_libro`;
CREATE TABLE `tb_libro`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(11) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `titulo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `precio` varchar(11) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `autor` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `isbn` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_libro
-- ----------------------------
INSERT INTO `tb_libro` VALUES (9, 'AS1221A', 'PYTON', 'asdasd', 'asda', 'sdasd', 13);
INSERT INTO `tb_libro` VALUES (11, '2QSA2', 'PHP', '12.3', 'sada', '121', 12);
INSERT INTO `tb_libro` VALUES (28, 'ASW12', 'ANGULAR', '150.69', 'JUAN', '12145ASQA', 10);
INSERT INTO `tb_libro` VALUES (29, 'ASAW122', 'SQL', '54.58', 'CARLOS', '45A45S4A5A-SAS2A', 7);
INSERT INTO `tb_libro` VALUES (30, '63-ASW', 'JS', '45.85', 'Swthers', '4558-555-557', 0);
INSERT INTO `tb_libro` VALUES (31, 'SD-ASA', 'NODE ', '154.59', 'CARLOS SOSA', '45845-4545458-45', 14);

-- ----------------------------
-- Table structure for tb_municipio
-- ----------------------------
DROP TABLE IF EXISTS `tb_municipio`;
CREATE TABLE `tb_municipio`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `municipio` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_municipio
-- ----------------------------
INSERT INTO `tb_municipio` VALUES (1, 'Manzanillo');
INSERT INTO `tb_municipio` VALUES (2, 'Niquero');
INSERT INTO `tb_municipio` VALUES (3, 'Pilon');
INSERT INTO `tb_municipio` VALUES (4, 'Campechuela');

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
INSERT INTO `tb_year_academico` VALUES (1, '1ro');
INSERT INTO `tb_year_academico` VALUES (2, '2do');
INSERT INTO `tb_year_academico` VALUES (3, '3ro');
INSERT INTO `tb_year_academico` VALUES (4, '4to');

SET FOREIGN_KEY_CHECKS = 1;
