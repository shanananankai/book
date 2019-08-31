/*
 Navicat Premium Data Transfer

 Source Server         : root
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : book

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 31/08/2019 12:03:00
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for pre_admin
-- ----------------------------
DROP TABLE IF EXISTS `pre_admin`;
CREATE TABLE `pre_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(200) DEFAULT NULL COMMENT '用户名',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `salt` varchar(150) DEFAULT NULL COMMENT '密码盐',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像',
  `email` varchar(150) DEFAULT NULL COMMENT '邮箱',
  `register_time` int(11) DEFAULT NULL COMMENT '时间戳',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of pre_admin
-- ----------------------------
BEGIN;
INSERT INTO `pre_admin` VALUES (1, 'root', 'f832918dd25e01413628929055dc2b55', 'z7;wbc5sv61t', '', '1197889075@qq.com', 1566541510, 0);
INSERT INTO `pre_admin` VALUES (70, 'admin2', 'eb31c3843f935e2026f46c6140d354cb', '.w/jz;1nkl2,', '', '1197889075@qq.com', 1566558273, 0);
INSERT INTO `pre_admin` VALUES (73, 'root12', '9a404d489ae262520038857340a3ec79', 'qr0zl6k1w5h7', '', '1197889075@qq.com', 1566558296, 0);
INSERT INTO `pre_admin` VALUES (83, '123', 'e9d1d82ce6170e2ef2e0435d656ea8bb', 'j58ne[r619hs', NULL, '11278427@qq.com', 1566557810, 0);
INSERT INTO `pre_admin` VALUES (84, '123', '1d2dc31557547abc59603d4ceb153374', 'hemyc[u]1089', NULL, '11278427@qq.com', 1566557888, 0);
INSERT INTO `pre_admin` VALUES (87, '123', '1d2dc31557547abc59603d4ceb153374', 'hemyc[u]1089', NULL, '11278427@qq.com', 1566557888, 0);
COMMIT;

-- ----------------------------
-- Table structure for pre_book
-- ----------------------------
DROP TABLE IF EXISTS `pre_book`;
CREATE TABLE `pre_book` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(255) DEFAULT NULL COMMENT '小说标题',
  `author` varchar(255) DEFAULT NULL COMMENT '作者',
  `register_time` int(11) DEFAULT NULL COMMENT '时间',
  `content` text COMMENT '描述内容',
  `thumb` varchar(255) DEFAULT NULL COMMENT '图片封面',
  `cateid` int(1) unsigned DEFAULT NULL COMMENT '分类外键',
  `flag` enum('top','new','hot') NOT NULL DEFAULT 'new' COMMENT '书籍标签',
  `url` varchar(255) DEFAULT NULL COMMENT '采集详细地址',
  PRIMARY KEY (`id`),
  KEY `key_book_cateid` (`cateid`) USING BTREE,
  CONSTRAINT `foreign_book_cateid` FOREIGN KEY (`cateid`) REFERENCES `pre_cate` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COMMENT='书籍表';

-- ----------------------------
-- Records of pre_book
-- ----------------------------
BEGIN;
INSERT INTO `pre_book` VALUES (31, '斗罗大陆2绝世唐门', '唐家三少', 1566744300, NULL, '/uploads/201908241739262qkde.png', 2, 'new', 'https://mhpic.isamanhua.com/comic/J/%E7%BB%9D%E4%B8%96%E5%94%90%E9%97%A8/%E7%AC%AC491%E8%AF%9DF/1.jpg-mht.low.webp');
INSERT INTO `pre_book` VALUES (32, '斗破苍穹', '天蚕土豆', 1566744300, '', '/uploads/20190825224500v1zgu.png', 2, 'hot', 'https://mhpic.manhualang.com/comic/D/%E6%96%97%E7%A0%B4%E8%8B%8D%E7%A9%B9%E6%8B%86%E5%88%86%E7%89%88/792%E8%AF%9DGQ/1.jpg-mht.low.webp');
INSERT INTO `pre_book` VALUES (33, '斗罗大陆', '唐家三少', 1566746644, '', '/uploads/20190825232404g1j5h.png', 2, 'new', 'https://mhpic.isamanhua.com/comic/D/%E6%96%97%E7%BD%97%E5%A4%A7%E9%99%86/%E7%AC%AC653%E8%AF%9DF/1.jpg-mht.low.webp');
INSERT INTO `pre_book` VALUES (34, '斗罗大陆3龙王传说', '唐家三少', 1566747051, '', '/uploads/20190825233051wv3cj.png', 2, 'new', 'https://mhpic.isamanhua.com/comic/D/%E6%96%97%E7%BD%97%E5%A4%A7%E9%99%863%E9%BE%99%E7%8E%8B%E4%BC%A0%E8%AF%B4/%E7%AC%AC207%E8%AF%9DF/1.jpg-mht.low.webp');
INSERT INTO `pre_book` VALUES (39, '武动乾坤', '天蚕土豆', 1567223832, '', '/uploads/20190831115712rmzqh.png', 2, 'hot', 'https://mhpic.isamanhua.com/comic/W/%E6%AD%A6%E5%8A%A8%E4%B9%BE%E5%9D%A4/%E7%AC%AC249%E8%AF%9DF/1.jpg-mht.low.webp');
INSERT INTO `pre_book` VALUES (40, '完美世界', '辰东', 1567223949, '', '/uploads/20190831115909hrx5i.png', 2, 'top', 'https://mhpic.isamanhua.com/comic/W/%E5%AE%8C%E7%BE%8E%E4%B8%96%E7%95%8C/%E7%AC%AC268%E8%AF%9DF/1.jpg-mht.low.webp');
COMMIT;

-- ----------------------------
-- Table structure for pre_cate
-- ----------------------------
DROP TABLE IF EXISTS `pre_cate`;
CREATE TABLE `pre_cate` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(255) DEFAULT NULL COMMENT '分类名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='分类表';

-- ----------------------------
-- Records of pre_cate
-- ----------------------------
BEGIN;
INSERT INTO `pre_cate` VALUES (1, '小说');
INSERT INTO `pre_cate` VALUES (2, '漫画');
COMMIT;

-- ----------------------------
-- Table structure for pre_chapter
-- ----------------------------
DROP TABLE IF EXISTS `pre_chapter`;
CREATE TABLE `pre_chapter` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `register_time` int(11) DEFAULT NULL COMMENT '章节更新时间',
  `title` varchar(255) DEFAULT NULL COMMENT '章节标题',
  `content` varchar(255) DEFAULT NULL COMMENT '章节的内容是一个路径',
  `bookid` int(10) unsigned DEFAULT NULL COMMENT '书籍外键',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除',
  PRIMARY KEY (`id`),
  KEY `key_chapter_bookid` (`bookid`) USING BTREE,
  CONSTRAINT `foreign_chapter_bookid` FOREIGN KEY (`bookid`) REFERENCES `pre_book` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `pre_chapter_ibfk_1` FOREIGN KEY (`bookid`) REFERENCES `pre_book` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8 COMMENT='章节表';

-- ----------------------------
-- Records of pre_chapter
-- ----------------------------
BEGIN;
INSERT INTO `pre_chapter` VALUES (171, 1567223352, '斗罗大陆2绝世唐门493话', './img_load.php?book_id=31&collect=493话', 31, 0);
COMMIT;

-- ----------------------------
-- Table structure for pre_config
-- ----------------------------
DROP TABLE IF EXISTS `pre_config`;
CREATE TABLE `pre_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) DEFAULT NULL COMMENT '名称',
  `content` varchar(255) DEFAULT NULL COMMENT '内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=144 DEFAULT CHARSET=utf8 COMMENT='网站设置表';

-- ----------------------------
-- Records of pre_config
-- ----------------------------
BEGIN;
INSERT INTO `pre_config` VALUES (135, 'logo', '/uploads/20190827190527z9jwc.png');
INSERT INTO `pre_config` VALUES (134, 'author', 'https://shankai.top');
INSERT INTO `pre_config` VALUES (132, 'description', '666');
INSERT INTO `pre_config` VALUES (133, 'title', '免费看小说');
INSERT INTO `pre_config` VALUES (131, 'keywords', '111');
INSERT INTO `pre_config` VALUES (130, 'phone', '16721421412');
INSERT INTO `pre_config` VALUES (129, 'email', '123@qq.com');
INSERT INTO `pre_config` VALUES (128, 'address', '广州');
INSERT INTO `pre_config` VALUES (127, 'company', 'shankai');
INSERT INTO `pre_config` VALUES (143, 'author', 'https://shankai.top');
INSERT INTO `pre_config` VALUES (142, 'title', '免费看小说22');
INSERT INTO `pre_config` VALUES (141, 'description', '666');
INSERT INTO `pre_config` VALUES (140, 'keywords', '111');
INSERT INTO `pre_config` VALUES (139, 'phone', '16721421412');
INSERT INTO `pre_config` VALUES (138, 'email', '123@qq.com');
INSERT INTO `pre_config` VALUES (137, 'address', '广州');
INSERT INTO `pre_config` VALUES (136, 'company', 'shankai');
COMMIT;

-- ----------------------------
-- Table structure for pre_website
-- ----------------------------
DROP TABLE IF EXISTS `pre_website`;
CREATE TABLE `pre_website` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(255) DEFAULT NULL COMMENT '节点标题',
  `code` varchar(255) DEFAULT NULL COMMENT '节点的程序文件路径',
  `register_time` int(11) DEFAULT NULL COMMENT '执行时间点',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='采集网站的节点表';

-- ----------------------------
-- Records of pre_website
-- ----------------------------
BEGIN;
INSERT INTO `pre_website` VALUES (1, '纵横中文网', 'site1', 1566552179);
INSERT INTO `pre_website` VALUES (2, '漫画台漫画', 'site2', 1566552179);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
