/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : server

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2014-01-14 21:52:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for device
-- ----------------------------
DROP TABLE IF EXISTS `device`;
CREATE TABLE `device` (
  `devid` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `link` varchar(50) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`devid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of device
-- ----------------------------
INSERT INTO `device` VALUES ('1233', 'login_begin', null, '2014-01-14 15:18:07');
INSERT INTO `device` VALUES ('22', '222', '33333', '2014-01-14 15:07:02');

-- ----------------------------
-- Table structure for space
-- ----------------------------
DROP TABLE IF EXISTS `space`;
CREATE TABLE `space` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `devid_1` varchar(100) DEFAULT NULL,
  `devid_2` varchar(100) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'wait',
  `status_1` varchar(20) DEFAULT '0',
  `status_2` varchar(20) DEFAULT '0',
  `subject_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of space
-- ----------------------------
INSERT INTO `space` VALUES ('15', null, '0000', '1111', 'wait', 'ready', 'ready', '0');

-- ----------------------------
-- Event structure for autoDelete
-- ----------------------------
DROP EVENT IF EXISTS `autoDelete`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` EVENT `autoDelete` ON SCHEDULE EVERY 5 SECOND STARTS '2014-01-14 15:29:47' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
	DELETE FROM device WHERE device.time < NOW();
END
;;
DELIMITER ;
