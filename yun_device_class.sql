/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : yun

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2014-07-16 23:12:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `yun_device_class`
-- ----------------------------
DROP TABLE IF EXISTS `yun_device_class`;
CREATE TABLE `yun_device_class` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `model` varchar(32) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `show_time` int(11) DEFAULT NULL COMMENT '上市时间',
  `info` text,
  `class_user` char(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yun_device_class
-- ----------------------------
INSERT INTO `yun_device_class` VALUES ('1', 'sky001', 'skylink 空气净化器', '1405518596', '能联网的空气净化器', null);
INSERT INTO `yun_device_class` VALUES ('2', 'sky002', 'skylink 净水器', '1405518596', 'this is a intro for it', null);
