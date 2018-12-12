/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50721
Source Host           : localhost:3306
Source Database       : chat_room

Target Server Type    : MYSQL
Target Server Version : 50721
File Encoding         : 65001

Date: 2018-12-12 16:29:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for messages
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) DEFAULT NULL COMMENT '聊天内容',
  `chat_type` enum('all','room','one') DEFAULT NULL COMMENT '聊天方式，all-大厅群聊，room-房间聊，one-私聊',
  `room_id` int(11) DEFAULT NULL COMMENT '接收信息的房间ID',
  `room_name` varchar(255) DEFAULT NULL COMMENT '接收信息的房间名称',
  `one_id` int(11) DEFAULT NULL COMMENT '接收信息的用户ID',
  `one_name` varchar(255) DEFAULT NULL COMMENT '接收信息的用户名称',
  `user_id` int(11) DEFAULT NULL COMMENT '发送信息的用户信息',
  `user_name` varchar(255) DEFAULT NULL COMMENT '发送信息的用户名称',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '信息发送时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of messages
-- ----------------------------
INSERT INTO `messages` VALUES ('1', '你好', 'room', '1', '一组牛逼', null, null, '7', 'sxw', '2018-11-16 21:44:00');
INSERT INTO `messages` VALUES ('2', '啊', 'room', '1', '一组牛逼', null, null, '7', 'sxw', '2018-11-16 21:59:50');
INSERT INTO `messages` VALUES ('3', '你也好', 'room', '1', '一组牛逼', null, null, '3', 'zyz', '2018-11-16 22:01:34');
INSERT INTO `messages` VALUES ('4', '哈喽', 'room', '2', '全栈一班二组', null, null, '7', 'sxw', '2018-11-16 22:02:06');
INSERT INTO `messages` VALUES ('5', 'dsaf ', 'room', '2', '全栈一班二组', null, null, '7', 'sxw', '2018-11-16 23:54:17');
INSERT INTO `messages` VALUES ('6', 'asdfa\nasdf', 'room', '2', '全栈一班二组', null, null, '7', 'sxw', '2018-11-16 23:54:26');
INSERT INTO `messages` VALUES ('7', 'dsfa\r\nasdf', 'room', '2', '全栈一班二组', null, null, '7', 'sxw', '2018-11-16 23:54:53');
INSERT INTO `messages` VALUES ('8', '你好', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 00:30:19');
INSERT INTO `messages` VALUES ('9', '你也好', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 00:31:53');
INSERT INTO `messages` VALUES ('10', '你好吗', 'one', null, null, '7', 'sxw', '3', 'zyz', '2018-11-17 00:35:32');
INSERT INTO `messages` VALUES ('11', '怎么了', 'one', null, null, '7', 'sxw', '3', 'zyz', '2018-11-17 00:36:15');
INSERT INTO `messages` VALUES ('12', '怎么了', 'one', null, null, '7', 'sxw', '3', 'zyz', '2018-11-17 00:38:08');
INSERT INTO `messages` VALUES ('13', '没什么', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 00:38:16');
INSERT INTO `messages` VALUES ('14', '睡觉吧', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 00:38:31');
INSERT INTO `messages` VALUES ('15', '好的', 'one', null, null, '7', 'sxw', '3', 'zyz', '2018-11-17 00:38:43');
INSERT INTO `messages` VALUES ('16', '哈哈', 'one', null, null, '7', 'sxw', '3', 'zyz', '2018-11-17 00:42:16');
INSERT INTO `messages` VALUES ('17', '哈哈哈', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 00:43:29');
INSERT INTO `messages` VALUES ('18', '大师傅', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 00:53:02');
INSERT INTO `messages` VALUES ('19', '阿斯顿发送到', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 00:53:32');
INSERT INTO `messages` VALUES ('20', '大师傅的说法手动阀', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 00:54:20');
INSERT INTO `messages` VALUES ('21', '大发送到发送到发送到发送到发送到发斯蒂芬斯蒂芬', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 01:00:35');
INSERT INTO `messages` VALUES ('22', '爱迪生发大水发生犯法的方式发顺丰', 'one', null, null, '7', 'sxw', '3', 'zyz', '2018-11-17 01:00:54');
INSERT INTO `messages` VALUES ('23', '艾弗森的发放的三大艾弗森的发放的三大艾弗森的发放的三大艾弗森的发放的三大艾弗森的发放的三大艾弗森的发放的三大艾弗森的发放的三大艾弗森的发放的三大艾弗森的发放的三大艾弗森的发放的三大', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 01:03:40');
INSERT INTO `messages` VALUES ('24', '阿斯蒂芬', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 09:32:56');
INSERT INTO `messages` VALUES ('25', '啊', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 09:55:57');
INSERT INTO `messages` VALUES ('26', '吧', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 09:56:17');
INSERT INTO `messages` VALUES ('27', '吧', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 09:56:40');
INSERT INTO `messages` VALUES ('28', '啊', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 09:56:42');
INSERT INTO `messages` VALUES ('29', '阿发达', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 10:01:58');
INSERT INTO `messages` VALUES ('30', '啊啊啊', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 10:02:45');
INSERT INTO `messages` VALUES ('31', '不不不', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 10:03:55');
INSERT INTO `messages` VALUES ('32', '啊啊啊', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 10:04:04');
INSERT INTO `messages` VALUES ('33', '擦擦擦', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 10:08:04');
INSERT INTO `messages` VALUES ('34', '哈哈哈', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 10:08:21');
INSERT INTO `messages` VALUES ('35', '暗暗', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 10:08:35');
INSERT INTO `messages` VALUES ('36', '士大夫', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 10:12:43');
INSERT INTO `messages` VALUES ('37', '方法', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 10:15:03');
INSERT INTO `messages` VALUES ('38', '不不不', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 10:15:33');
INSERT INTO `messages` VALUES ('39', '呃呃呃', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 10:16:11');
INSERT INTO `messages` VALUES ('40', '啊', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 10:16:33');
INSERT INTO `messages` VALUES ('41', '的方法', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 10:38:18');
INSERT INTO `messages` VALUES ('42', '哈哈哈，成功啦', 'one', null, null, '7', 'sxw', '3', 'zyz', '2018-11-17 10:41:35');
INSERT INTO `messages` VALUES ('43', '发多少', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 10:43:53');
INSERT INTO `messages` VALUES ('44', '哈哈', 'one', null, null, '3', 'zyz', '7', 'sxw', '2018-11-17 10:54:54');
INSERT INTO `messages` VALUES ('45', 'a', 'all', null, null, null, null, '7', 'sxw', '2018-11-17 11:11:11');
INSERT INTO `messages` VALUES ('46', 'b', 'all', null, null, null, null, '3', 'zyz', '2018-11-17 11:11:31');
INSERT INTO `messages` VALUES ('47', '爱的方式的', 'all', null, null, null, null, '9', '石学文', '2018-11-17 11:24:51');
INSERT INTO `messages` VALUES ('48', 'adsfs ', 'all', null, null, null, null, '7', 'sxw', '2018-11-17 16:18:24');
INSERT INTO `messages` VALUES ('49', 'adsf \nafds', 'all', null, null, null, null, '7', 'sxw', '2018-11-17 16:18:29');
INSERT INTO `messages` VALUES ('50', 'asddf\nadsf', 'all', null, null, null, null, '7', 'sxw', '2018-11-17 16:18:42');
INSERT INTO `messages` VALUES ('51', 'adsfadsdfdsfdfa', 'all', null, null, null, null, '7', 'sxw', '2018-11-17 16:18:57');
INSERT INTO `messages` VALUES ('52', '<script>alert(\'a\')</script>', 'all', null, null, null, null, '7', 'sxw', '2018-11-17 16:20:45');
INSERT INTO `messages` VALUES ('53', 'dfz ', 'all', null, null, null, null, '10', 'sxw1', '2018-11-17 16:39:45');
INSERT INTO `messages` VALUES ('54', '<script>alert(\'aa\')</script>', 'all', null, null, null, null, '7', 'sxw', '2018-11-18 16:54:12');
INSERT INTO `messages` VALUES ('55', 'asdfdsafsfsdfsadfasdfasdfasdfsdfsdfaf', 'all', null, null, null, null, '7', 'sxw', '2018-11-18 16:54:19');
INSERT INTO `messages` VALUES ('56', '阿范德萨发发士大夫撒发顺丰撒地方撒打发斯蒂芬算法', 'all', null, null, null, null, '7', 'sxw', '2018-11-18 16:57:50');
INSERT INTO `messages` VALUES ('57', '阿水电费大师傅三大发送到发送到发\n爱的方式萨达的沙发发斯蒂芬\nad所发生的发说法士大夫', 'all', null, null, null, null, '7', 'sxw', '2018-11-18 16:58:13');
INSERT INTO `messages` VALUES ('58', '手动阀发生大发发发送到ad所发生的发顺丰的撒发生地方阿斯顿发的说法是打发斯蒂芬', 'all', null, null, null, null, '7', 'sxw', '2018-11-18 17:01:20');
INSERT INTO `messages` VALUES ('59', 'asdfdfsdafasfsdfsf', 'room', '1', '一组牛逼', null, null, '3', 'zyz', '2018-11-18 17:31:47');
INSERT INTO `messages` VALUES ('60', 'asdfasdfasdf', 'room', '1', '一组牛逼', null, null, '3', 'zyz', '2018-11-18 17:31:49');
INSERT INTO `messages` VALUES ('61', 'afdsaf', 'room', '1', '一组牛逼', null, null, '3', 'zyz', '2018-11-18 17:31:51');
INSERT INTO `messages` VALUES ('62', 'asfdasf', 'room', '1', '一组牛逼', null, null, '3', 'zyz', '2018-11-18 17:31:52');
INSERT INTO `messages` VALUES ('63', 'safdsadf', 'room', '1', '一组牛逼', null, null, '3', 'zyz', '2018-11-18 17:31:54');
INSERT INTO `messages` VALUES ('64', 'asfd', 'room', '1', '一组牛逼', null, null, '3', 'zyz', '2018-11-18 17:31:55');
INSERT INTO `messages` VALUES ('65', 'sdf', 'room', '1', '一组牛逼', null, null, '3', 'zyz', '2018-11-18 17:31:57');
INSERT INTO `messages` VALUES ('66', 'asdf', 'all', null, null, null, null, '7', 'sxw', '2018-11-18 17:35:07');
INSERT INTO `messages` VALUES ('67', '阿道夫撒', 'all', null, null, null, null, '3', 'zyz', '2018-11-18 18:32:36');
INSERT INTO `messages` VALUES ('68', '阿斯蒂芬', 'all', null, null, null, null, '3', 'zyz', '2018-11-18 18:32:57');
INSERT INTO `messages` VALUES ('69', 'dsdf', 'all', null, null, null, null, '7', 'sxw', '2018-11-18 18:33:57');
INSERT INTO `messages` VALUES ('70', 'asdfsd', 'room', '1', '一组牛逼', null, null, '7', 'sxw', '2018-11-18 22:59:18');
INSERT INTO `messages` VALUES ('71', '阿第三方三房三分\n阿斯顿发顺丰', 'room', '1', '一组牛逼', null, null, '7', 'sxw', '2018-11-18 22:59:28');
INSERT INTO `messages` VALUES ('72', 'adsfsd ', 'room', '1', '一组牛逼', null, null, '7', 'sxw', '2018-11-18 22:59:32');
INSERT INTO `messages` VALUES ('73', '撒旦法', 'room', '1', '一组牛逼', null, null, '7', 'sxw', '2018-11-18 22:59:52');
INSERT INTO `messages` VALUES ('74', 'asdf', 'all', null, null, null, null, '7', 'sxw', '2018-11-18 23:06:40');
INSERT INTO `messages` VALUES ('75', '\n\n\n\n\n\n\n\n\n\n\n\n\n', 'all', null, null, null, null, '7', 'sxw', '2018-11-18 23:07:11');
INSERT INTO `messages` VALUES ('76', '\n\n\n\n撒', 'all', null, null, null, null, '7', 'sxw', '2018-11-18 23:10:47');
INSERT INTO `messages` VALUES ('77', '阿的说法三', 'all', null, null, null, null, '7', 'sxw', '2018-11-18 23:13:27');
INSERT INTO `messages` VALUES ('78', '阿斯蒂芬', 'all', null, null, null, null, '7', 'sxw', '2018-11-18 23:13:42');
INSERT INTO `messages` VALUES ('79', '大', 'all', null, null, null, null, '7', 'sxw', '2018-11-18 23:19:25');
INSERT INTO `messages` VALUES ('80', '阿飞', 'all', null, null, null, null, '7', 'sxw', '2018-11-18 23:25:22');
INSERT INTO `messages` VALUES ('81', '大师傅', 'all', null, null, null, null, '7', 'sxw', '2018-11-18 23:25:33');

-- ----------------------------
-- Table structure for rooms
-- ----------------------------
DROP TABLE IF EXISTS `rooms`;
CREATE TABLE `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_name` varchar(255) DEFAULT NULL COMMENT '房间名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of rooms
-- ----------------------------
INSERT INTO `rooms` VALUES ('1', '一组牛逼');
INSERT INTO `rooms` VALUES ('2', '全栈一班二组');
INSERT INTO `rooms` VALUES ('3', '全栈一班三组');
INSERT INTO `rooms` VALUES ('4', '全栈一班四组');
INSERT INTO `rooms` VALUES ('5', '全栈一班五组');
INSERT INTO `rooms` VALUES ('6', '全栈一班六组');
INSERT INTO `rooms` VALUES ('7', '全栈一班七组');
INSERT INTO `rooms` VALUES ('8', '全栈一班八组');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'root', 'sxw15938234804', '13522632414');
INSERT INTO `user` VALUES ('3', 'zyz', '123', '11111111111');
INSERT INTO `user` VALUES ('4', 'rjh', '123', '133344443333');
INSERT INTO `user` VALUES ('7', 'sxw', '123', '123');
INSERT INTO `user` VALUES ('8', 'pws', '123123', '18675540424');
INSERT INTO `user` VALUES ('9', '石学文', '123', '13522632414');
INSERT INTO `user` VALUES ('10', 'sxw1', '123', ' ');
