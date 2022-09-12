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

 Date: 12/09/2022 01:23:05
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
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB AUTO_INCREMENT = 193 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of op_historial_libroestudiante
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 92 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_estudiante
-- ----------------------------
INSERT INTO `tb_estudiante` VALUES (91, '23423234553', 'ALEJANDRO', 'SOSA GOMEZ', 'aaa', 1, 1, 1, 1, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_libro
-- ----------------------------
INSERT INTO `tb_libro` VALUES (32, 'AB-5', 'JS', '12.36', 'JUAN', '45484-454', 125);
INSERT INTO `tb_libro` VALUES (33, 'AB-6', 'PHP', '14.56', 'JUAN', '45484-454', 116);

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
INSERT INTO `tb_municipio` VALUES (1, 'MANZANILLO');
INSERT INTO `tb_municipio` VALUES (2, 'NIQUERO');
INSERT INTO `tb_municipio` VALUES (3, 'PILON');
INSERT INTO `tb_municipio` VALUES (4, 'CAMPECHUELA');

-- ----------------------------
-- Table structure for tb_users
-- ----------------------------
DROP TABLE IF EXISTS `tb_users`;
CREATE TABLE `tb_users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `rol` int(2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_users
-- ----------------------------
INSERT INTO `tb_users` VALUES (1, 'root', '$2y$10$KgiTC9dwQEL3ZFkO8crXzOL/h1Xr6eCRSrecx6exVWixeXo0nw7Oe', 1);
INSERT INTO `tb_users` VALUES (2, 'colab', '$2y$10$KgiTC9dwQEL3ZFkO8crXzOL/h1Xr6eCRSrecx6exVWixeXo0nw7Oe', 2);

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
