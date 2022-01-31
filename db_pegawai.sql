/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100421
 Source Host           : localhost:3306
 Source Schema         : db_pegawai

 Target Server Type    : MySQL
 Target Server Version : 100421
 File Encoding         : 65001

 Date: 31/01/2022 14:56:05
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_golongan
-- ----------------------------
DROP TABLE IF EXISTS `tb_golongan`;
CREATE TABLE `tb_golongan`  (
  `id_golongan` int NOT NULL AUTO_INCREMENT,
  `pangkat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `romawi` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `ruang` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_golongan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_golongan
-- ----------------------------
INSERT INTO `tb_golongan` VALUES (1, 'Juru Muda', 'I', 'A');
INSERT INTO `tb_golongan` VALUES (2, 'Juru Muda Tingkat I', 'I', 'B');

-- ----------------------------
-- Table structure for tb_jabatan
-- ----------------------------
DROP TABLE IF EXISTS `tb_jabatan`;
CREATE TABLE `tb_jabatan`  (
  `id_jabatan` int NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_jabatan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_jabatan
-- ----------------------------
INSERT INTO `tb_jabatan` VALUES (1, 'Kepala');
INSERT INTO `tb_jabatan` VALUES (2, 'Wakil Kepala');

-- ----------------------------
-- Table structure for tb_pegawai
-- ----------------------------
DROP TABLE IF EXISTS `tb_pegawai`;
CREATE TABLE `tb_pegawai`  (
  `id_pegawai` int NOT NULL AUTO_INCREMENT,
  `nip_pegawai` int NOT NULL,
  `nama_pegawai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_jabatan` int NULL DEFAULT NULL,
  `id_golongan` int NULL DEFAULT NULL,
  `id_unit` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_pegawai`) USING BTREE,
  INDEX `id_jabatan`(`id_jabatan` ASC) USING BTREE,
  INDEX `id_golongan`(`id_golongan` ASC) USING BTREE,
  INDEX `id_unit`(`id_unit` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_pegawai
-- ----------------------------
INSERT INTO `tb_pegawai` VALUES (1, 123456789, 'Refki Santriono', 2, 2, 2);
INSERT INTO `tb_pegawai` VALUES (2, 987654321, 'Anu Wijaya', 1, 2, 1);
INSERT INTO `tb_pegawai` VALUES (3, 15050104, 'Santriono', 1, 1, 2);
INSERT INTO `tb_pegawai` VALUES (4, 456123789, 'Samuel Rizal', 2, 1, 2);

-- ----------------------------
-- Table structure for tb_unit
-- ----------------------------
DROP TABLE IF EXISTS `tb_unit`;
CREATE TABLE `tb_unit`  (
  `id_unit` int NOT NULL AUTO_INCREMENT,
  `nama_unit` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_unit`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_unit
-- ----------------------------
INSERT INTO `tb_unit` VALUES (1, 'Bagian Umum');
INSERT INTO `tb_unit` VALUES (2, 'Bagian Pengadaan');

-- ----------------------------
-- Table structure for tb_user
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_user
-- ----------------------------
INSERT INTO `tb_user` VALUES (1, 'administrator', 'admin', 'admin@test.com', '$2y$10$QOMh4PPAbVStpaHfHd4V9.neIIH2189UIW0PFGhgucmYwmyz6D8Ou', '2021-11-14 10:26:31', '2022-01-29 09:09:14', 'FlkKxR76BsUdYk62G0gytXELsoFGdqVLG4tKBqdrDBo4IL8PWhkmvzUbye2a');
INSERT INTO `tb_user` VALUES (2, 'pegawai', 'pegawai', 'pegawai@test.com', '$2y$10$QOMh4PPAbVStpaHfHd4V9.neIIH2189UIW0PFGhgucmYwmyz6D8Ou', '2021-11-15 14:57:29', '2021-11-15 14:57:29', 'rXHsKzrA5t0PQqw6GZEknBqs0bBwDMFBJ4ESLMrVeT72K85jSgo46y09q1AV');

SET FOREIGN_KEY_CHECKS = 1;
