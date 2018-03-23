/*
 Navicat Premium Data Transfer

 Source Server         : 致优特
 Source Server Type    : MySQL
 Source Server Version : 50635
 Source Host           : 39.108.226.59:3306
 Source Schema         : small

 Target Server Type    : MySQL
 Target Server Version : 50635
 File Encoding         : 65001

 Date: 23/03/2018 10:01:06
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for t_admin_user
-- ----------------------------
DROP TABLE IF EXISTS `t_admin_user`;
CREATE TABLE `t_admin_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '登录名',
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '密码',
  `avatar` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '头像',
  `status` tinyint(1) NULL DEFAULT 1 COMMENT '状态 1正常 2禁用',
  `is_del` tinyint(1) NULL DEFAULT 1 COMMENT '是否删除',
  `real_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '真实姓名',
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '手机号',
  `email` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '邮箱地址',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '后台管理员' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_admin_user
-- ----------------------------
INSERT INTO `t_admin_user` VALUES (1, 'admin', '$2y$10$3m2AdkLabn6p0hY6zqkrHeKmfhUaIbh5gPO5g457S4cLmRo4C7tqW', '', 1, 1, '超级管理员', '13632948547', '740087240@qq.com');
INSERT INTO `t_admin_user` VALUES (5, 'punkvv', '$2y$10$r5j7klW3dXgYN5FsgqaaLOc6BBHRy7FX8.fmiOAI48X1XowBkNJ5O', '//api.zhiyoute.com/upload/image/20180201/f4413386447cb5b905eea1400b8d1b2d.png', 1, 1, 'PunkVv', '13557157866', '740087240@qq.com');
INSERT INTO `t_admin_user` VALUES (6, 'test1', '$2y$10$gSTFvpICR6sMX8jCL.tYBelwE6D1EGpV.ytzzy7ArqIsDhsIUSJQG', '', 1, 1, '', '', '');
INSERT INTO `t_admin_user` VALUES (7, 'test2', '$2y$10$GgGyRplJVrtXeMtakiI7ueHiZnI8KUt7iGVWW4IvzBYAJFsZoezFu', '', 1, 1, '测试', '', '');
INSERT INTO `t_admin_user` VALUES (8, '123', '$2y$10$lwp/TGaLr8ZZgdASaXJhpOxkFjb54ECC6HddtKSIpT.LRAy4sihea', '', 1, 1, '222', '22', '22');

-- ----------------------------
-- Table structure for t_admin_user_role
-- ----------------------------
DROP TABLE IF EXISTS `t_admin_user_role`;
CREATE TABLE `t_admin_user_role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NULL DEFAULT NULL,
  `admin_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_admin_user_role
-- ----------------------------
INSERT INTO `t_admin_user_role` VALUES (8, 6, 6);
INSERT INTO `t_admin_user_role` VALUES (10, 1, 5);
INSERT INTO `t_admin_user_role` VALUES (11, 6, 5);

-- ----------------------------
-- Table structure for t_api_log
-- ----------------------------
DROP TABLE IF EXISTS `t_api_log`;
CREATE TABLE `t_api_log`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NULL DEFAULT NULL,
  `create_time` bigint(20) NULL DEFAULT NULL,
  `router` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '路由',
  `router_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '路由名称',
  `params` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '参数',
  `is_del` tinyint(1) NULL DEFAULT 1,
  `method` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '请求类型',
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 336 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_api_log
-- ----------------------------
INSERT INTO `t_api_log` VALUES (332, 1, 1521713931, 'admin/users/:id', '更新个人信息', '{\"id\":\"1\",\"username\":\"admin\",\"avatar\":\"\",\"real_name\":\"超级管理员\",\"phone\":\"13632948547\",\"email\":\"740087240@qq.com\"}', 1, 'PUT', '119.97.241.162');
INSERT INTO `t_api_log` VALUES (333, 1, 1521713932, 'admin/users/:id', '更新个人信息', '{\"id\":\"1\",\"username\":\"admin\",\"avatar\":\"\",\"real_name\":\"超级管理员\",\"phone\":\"13632948547\",\"email\":\"740087240@qq.com\"}', 1, 'PUT', '119.97.241.162');
INSERT INTO `t_api_log` VALUES (334, 1, 1521713932, 'admin/users/:id', '更新个人信息', '{\"id\":\"1\",\"username\":\"admin\",\"avatar\":\"\",\"real_name\":\"超级管理员\",\"phone\":\"13632948547\",\"email\":\"740087240@qq.com\"}', 1, 'PUT', '119.97.241.162');
INSERT INTO `t_api_log` VALUES (335, 1, 1521713932, 'admin/users/:id', '更新个人信息', '{\"id\":\"1\",\"username\":\"admin\",\"avatar\":\"\",\"real_name\":\"超级管理员\",\"phone\":\"13632948547\",\"email\":\"740087240@qq.com\"}', 1, 'PUT', '119.97.241.162');

-- ----------------------------
-- Table structure for t_error_log
-- ----------------------------
DROP TABLE IF EXISTS `t_error_log`;
CREATE TABLE `t_error_log`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_time` bigint(20) NULL DEFAULT NULL,
  `router` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '调用接口',
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '错误描述',
  `type` tinyint(1) NULL DEFAULT 1 COMMENT '类型 1服务端 2前端',
  `status` tinyint(1) NULL DEFAULT 2 COMMENT '状态 是否处理',
  `is_del` tinyint(1) NULL DEFAULT 1 COMMENT '是否删除',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for t_menu
-- ----------------------------
DROP TABLE IF EXISTS `t_menu`;
CREATE TABLE `t_menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '页面路由标识',
  `menu_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '菜单名称',
  `parent_id` int(11) NULL DEFAULT NULL COMMENT '父级id',
  `parent_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  `router` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '包含的路由',
  `sort` tinyint(4) NULL DEFAULT 0 COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 48 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '后台菜单' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_menu
-- ----------------------------
INSERT INTO `t_menu` VALUES (1, 'system', '系统', NULL, '', '', 0);
INSERT INTO `t_menu` VALUES (2, 'menu', '菜单', 1, 'system', '', 0);
INSERT INTO `t_menu` VALUES (3, 'role', '角色', 1, 'system', '', 1);
INSERT INTO `t_menu` VALUES (4, 'user', '用户', 1, 'system', '', 2);
INSERT INTO `t_menu` VALUES (39, 'errorLog', '错误日志', 1, 'system', '', 0);
INSERT INTO `t_menu` VALUES (40, 'apiLog', 'API日志', 1, 'system', '', 0);

-- ----------------------------
-- Table structure for t_role
-- ----------------------------
DROP TABLE IF EXISTS `t_role`;
CREATE TABLE `t_role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '角色名称',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '角色' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_role
-- ----------------------------
INSERT INTO `t_role` VALUES (1, '超级管理员', '这是一个超级管理员');
INSERT INTO `t_role` VALUES (6, '测试1', '');
INSERT INTO `t_role` VALUES (7, '测试2', '');
INSERT INTO `t_role` VALUES (8, '测试3', '');

-- ----------------------------
-- Table structure for t_role_menu
-- ----------------------------
DROP TABLE IF EXISTS `t_role_menu`;
CREATE TABLE `t_role_menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NULL DEFAULT NULL,
  `menu_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_role_menu
-- ----------------------------
INSERT INTO `t_role_menu` VALUES (18, 1, 39);
INSERT INTO `t_role_menu` VALUES (19, 1, 40);
INSERT INTO `t_role_menu` VALUES (20, 6, 2);

SET FOREIGN_KEY_CHECKS = 1;
