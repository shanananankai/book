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

 Date: 26/08/2019 18:40:14
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
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of pre_admin
-- ----------------------------
BEGIN;
INSERT INTO `pre_admin` VALUES (1, 'root', 'f832918dd25e01413628929055dc2b55', 'z7;wbc5sv61t', '', '1197889075@qq.com', 1566541510, 0);
INSERT INTO `pre_admin` VALUES (70, 'admin2', 'eb31c3843f935e2026f46c6140d354cb', '.w/jz;1nkl2,', '', '1197889075@qq.com', 1566558273, 0);
INSERT INTO `pre_admin` VALUES (72, 'root', 'becc4a3c67fa500d85e92bba8cb18957', ';yhqpbjn2a96', NULL, '1197889075@qq.com', 1566538708, 1);
INSERT INTO `pre_admin` VALUES (73, 'root12', '9a404d489ae262520038857340a3ec79', 'qr0zl6k1w5h7', '', '1197889075@qq.com', 1566558296, 0);
INSERT INTO `pre_admin` VALUES (74, 'root', 'becc4a3c67fa500d85e92bba8cb18957', ';yhqpbjn2a96', NULL, '1197889075@qq.com', 1566538708, 0);
INSERT INTO `pre_admin` VALUES (75, 'root', 'becc4a3c67fa500d85e92bba8cb18957', ';yhqpbjn2a96', NULL, '1197889075@qq.com', 1566538708, 0);
INSERT INTO `pre_admin` VALUES (77, 'root', 'becc4a3c67fa500d85e92bba8cb18957', ';yhqpbjn2a96', NULL, '1197889075@qq.com', 1566538708, 0);
INSERT INTO `pre_admin` VALUES (78, 'root', 'becc4a3c67fa500d85e92bba8cb18957', ';yhqpbjn2a96', NULL, '1197889075@qq.com', 1566538708, 0);
INSERT INTO `pre_admin` VALUES (80, 'root', 'becc4a3c67fa500d85e92bba8cb18957', ';yhqpbjn2a96', NULL, '1197889075@qq.com', 1566538708, 1);
INSERT INTO `pre_admin` VALUES (82, 'admin', 'e6a63ffcf246dbab3855b20e246b1eed', 'f]xvcmju9;02', NULL, '1197889075@qq.com', 1566542074, 0);
INSERT INTO `pre_admin` VALUES (83, '123', 'e9d1d82ce6170e2ef2e0435d656ea8bb', 'j58ne[r619hs', NULL, '11278427@qq.com', 1566557810, 0);
INSERT INTO `pre_admin` VALUES (84, '123', '1d2dc31557547abc59603d4ceb153374', 'hemyc[u]1089', NULL, '11278427@qq.com', 1566557888, 0);
INSERT INTO `pre_admin` VALUES (85, '123', 'ba7f330b69c6eb94223b0cf12dab846d', 'zqnxyr,amb4l', NULL, '11278427@qq.com', 1566557904, 0);
INSERT INTO `pre_admin` VALUES (86, '123', '3a328ea76de45d6b1bbe90f41e90c2ae', 'dv;5u]c2fynq', NULL, '11278427@qq.com', 1566558252, 0);
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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COMMENT='书籍表';

-- ----------------------------
-- Records of pre_book
-- ----------------------------
BEGIN;
INSERT INTO `pre_book` VALUES (29, '小本生意', '寒鸿', 1566636403, '', '/uploads/201908241646430ruw3.png', 1, 'top', 'http://book.zongheng.com/showchapter/872038.html');
INSERT INTO `pre_book` VALUES (30, '都市古仙医', '超爽黑啤', 1566636622, '', '/uploads/20190824165022q0b8u.png', 1, 'top', 'http://book.zongheng.com/showchapter/867252.html');
INSERT INTO `pre_book` VALUES (31, '绝世唐门', '唐家三少', 1566639566, '', '/uploads/201908241739262qkde.png', 2, 'new', 'mhpic.isamanhua.com/comic/J/绝世唐门/第490话F/1.jpg-mht.low.webp');
INSERT INTO `pre_book` VALUES (32, '斗破苍穹', '天蚕土豆', 1566744300, '', '/uploads/20190825224500v1zgu.png', 2, 'hot', 'https://mhpic.manhualang.com/comic/D/%E6%96%97%E7%A0%B4%E8%8B%8D%E7%A9%B9%E6%8B%86%E5%88%86%E7%89%88/792%E8%AF%9DGQ/1.jpg-mht.low.webp');
INSERT INTO `pre_book` VALUES (33, '斗罗大陆', '三', 1566746644, '', '/uploads/20190825232404g1j5h.png', 2, 'new', 'https://mhpic.isamanhua.com/comic/D/%E6%96%97%E7%BD%97%E5%A4%A7%E9%99%86/%E7%AC%AC653%E8%AF%9DF/1.jpg-mht.low.webp');
INSERT INTO `pre_book` VALUES (34, '斗罗大陆3龙王传说', '三', 1566747051, '', '/uploads/20190825233051wv3cj.png', 2, 'new', 'https://mhpic.isamanhua.com/comic/D/%E6%96%97%E7%BD%97%E5%A4%A7%E9%99%863%E9%BE%99%E7%8E%8B%E4%BC%A0%E8%AF%B4/%E7%AC%AC207%E8%AF%9DF/1.jpg-mht.low.webp');
INSERT INTO `pre_book` VALUES (35, '斗破苍穹之药老传奇', '三', 1566747456, '', '/uploads/20190825233736tyzs2.png', 2, 'hot', 'https://mhpic.manhualang.com/comic/D/%E6%96%97%E7%A0%B4%E8%8B%8D%E7%A9%B9%E4%B9%8B%E8%8D%AF%E8%80%81%E4%BC%A0%E5%A5%87/%E7%AC%AC1%E8%AF%9D%20%E4%BA%BA%E7%A9%B7%E5%91%BD%E8%B4%B1GQ/1.jpg-mht.low.webp');
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
INSERT INTO `pre_cate` VALUES (3, '听书');
INSERT INTO `pre_cate` VALUES (4, '视频');
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
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8 COMMENT='章节表';

-- ----------------------------
-- Records of pre_chapter
-- ----------------------------
BEGIN;
INSERT INTO `pre_chapter` VALUES (93, 1566636463, '第一章  三味书屋', '../assets/site1/小本生意_0824/第一章  三味书屋.json', 29, 0);
INSERT INTO `pre_chapter` VALUES (94, 1566636463, '第二章  祸从天降', '../assets/site1/小本生意_0824/第二章  祸从天降.json', 29, 0);
INSERT INTO `pre_chapter` VALUES (95, 1566636463, '第三章  自由诚可贵', '../assets/site1/小本生意_0824/第三章  自由诚可贵.json', 29, 0);
INSERT INTO `pre_chapter` VALUES (96, 1566636463, '第四章  花钱买平安', '../assets/site1/小本生意_0824/第四章  花钱买平安.json', 29, 0);
INSERT INTO `pre_chapter` VALUES (97, 1566636464, '第五章  起早贪黑，辛苦经营', '../assets/site1/小本生意_0824/第五章  起早贪黑，辛苦经营.json', 29, 0);
INSERT INTO `pre_chapter` VALUES (98, 1566636464, '第六章  苛捐杂税', '../assets/site1/小本生意_0824/第六章  苛捐杂税.json', 29, 0);
INSERT INTO `pre_chapter` VALUES (99, 1566636464, '第七章  侥幸逃过一劫', '../assets/site1/小本生意_0824/第七章  侥幸逃过一劫.json', 29, 0);
INSERT INTO `pre_chapter` VALUES (100, 1566636464, '第八章  关门大吉', '../assets/site1/小本生意_0824/第八章  关门大吉.json', 29, 0);
INSERT INTO `pre_chapter` VALUES (101, 1566637259, '第一章 碰瓷遇上女司机', '../assets/site1/都市古仙医_0824/第一章 碰瓷遇上女司机.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (102, 1566637259, '第二章 天价药费', '../assets/site1/都市古仙医_0824/第二章 天价药费.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (103, 1566637259, '第三章 你不配做医生', '../assets/site1/都市古仙医_0824/第三章 你不配做医生.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (104, 1566637259, '第四章 冒名顶替', '../assets/site1/都市古仙医_0824/第四章 冒名顶替.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (105, 1566637260, '第五章 真相大白', '../assets/site1/都市古仙医_0824/第五章 真相大白.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (106, 1566637260, '第六章 凭什么可怜你？', '../assets/site1/都市古仙医_0824/第六章 凭什么可怜你？.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (107, 1566637260, '第七章 假扮男友', '../assets/site1/都市古仙医_0824/第七章 假扮男友.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (108, 1566637261, '第八章 百草堂', '../assets/site1/都市古仙医_0824/第八章 百草堂.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (109, 1566637261, '第九章 百万悬赏', '../assets/site1/都市古仙医_0824/第九章 百万悬赏.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (110, 1566637261, '第十章 华佗金方', '../assets/site1/都市古仙医_0824/第十章 华佗金方.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (111, 1566637261, '第十一章 回魂九针', '../assets/site1/都市古仙医_0824/第十一章 回魂九针.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (112, 1566637261, '第十二章 准备后事吧', '../assets/site1/都市古仙医_0824/第十二章 准备后事吧.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (113, 1566637262, '第十三章 一眼看破', '../assets/site1/都市古仙医_0824/第十三章 一眼看破.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (114, 1566637262, '第十四章 代师收徒', '../assets/site1/都市古仙医_0824/第十四章 代师收徒.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (115, 1566637262, '第十五章 叔爷', '../assets/site1/都市古仙医_0824/第十五章 叔爷.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (116, 1566637262, '第十六章 铁头功', '../assets/site1/都市古仙医_0824/第十六章 铁头功.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (117, 1566637263, '第十七章 打成释迦摩尼', '../assets/site1/都市古仙医_0824/第十七章 打成释迦摩尼.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (118, 1566637263, '第十八章 贺家的诊金', '../assets/site1/都市古仙医_0824/第十八章 贺家的诊金.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (119, 1566637263, '第十九章 拜金前女友', '../assets/site1/都市古仙医_0824/第十九章 拜金前女友.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (120, 1566637263, '第二十章 我看谁敢动', '../assets/site1/都市古仙医_0824/第二十章 我看谁敢动.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (121, 1566637264, '第二十一章 他是你的老板', '../assets/site1/都市古仙医_0824/第二十一章 他是你的老板.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (122, 1566637264, '第二十二章 证明给你看', '../assets/site1/都市古仙医_0824/第二十二章 证明给你看.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (123, 1566637264, '第二十三章 麻烦上门', '../assets/site1/都市古仙医_0824/第二十三章 麻烦上门.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (124, 1566637264, '第二十四章 忍你很久了', '../assets/site1/都市古仙医_0824/第二十四章 忍你很久了.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (125, 1566637265, '第二十五章 爱造假的马大少', '../assets/site1/都市古仙医_0824/第二十五章 爱造假的马大少.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (126, 1566637265, '第二十六章 收保护费', '../assets/site1/都市古仙医_0824/第二十六章 收保护费.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (127, 1566637265, '第二十七章 吃包子', '../assets/site1/都市古仙医_0824/第二十七章 吃包子.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (128, 1566637266, '第二十八章 兴师问罪', '../assets/site1/都市古仙医_0824/第二十八章 兴师问罪.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (129, 1566637266, '第二十九章 我让你没脑子', '../assets/site1/都市古仙医_0824/第二十九章 我让你没脑子.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (130, 1566637267, '第三十章 女暴龙', '../assets/site1/都市古仙医_0824/第三十章 女暴龙.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (131, 1566637267, '第三十一章 师兄驾到', '../assets/site1/都市古仙医_0824/第三十一章 师兄驾到.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (132, 1566637267, '第三十二章 名誉院长', '../assets/site1/都市古仙医_0824/第三十二章 名誉院长.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (133, 1566637267, '第三十三章 考察组组长', '../assets/site1/都市古仙医_0824/第三十三章 考察组组长.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (134, 1566637267, '第三十四章 一问三不知', '../assets/site1/都市古仙医_0824/第三十四章 一问三不知.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (135, 1566637268, '第三十五章 世外桃源', '../assets/site1/都市古仙医_0824/第三十五章 世外桃源.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (136, 1566637268, '第三十六章 开天眼', '../assets/site1/都市古仙医_0824/第三十六章 开天眼.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (137, 1566637268, '第三十七章 血色骷髅', '../assets/site1/都市古仙医_0824/第三十七章 血色骷髅.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (138, 1566637269, '第三十八章 恩将仇报', '../assets/site1/都市古仙医_0824/第三十八章 恩将仇报.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (139, 1566637269, '第三十九章 偷梁换柱的店老板', '../assets/site1/都市古仙医_0824/第三十九章 偷梁换柱的店老板.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (140, 1566637269, '第四十章 内有乾坤', '../assets/site1/都市古仙医_0824/第四十章 内有乾坤.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (141, 1566637269, '第四十一章 颜真卿的真迹', '../assets/site1/都市古仙医_0824/第四十一章 颜真卿的真迹.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (142, 1566637270, '第四十二章 汉代陶俑', '../assets/site1/都市古仙医_0824/第四十二章 汉代陶俑.json', 30, 0);
INSERT INTO `pre_chapter` VALUES (149, 1566662824, '绝世唐门489话', './img_load.php?book_id=31&collect=489话', 31, 0);
INSERT INTO `pre_chapter` VALUES (150, 1566662844, '绝世唐门490话', './img_load.php?book_id=31&collect=490话', 31, 0);
INSERT INTO `pre_chapter` VALUES (153, 1566665267, '绝世唐门491话', './img_load.php?book_id=31&collect=491话', 31, 0);
INSERT INTO `pre_chapter` VALUES (154, 1566665413, '绝世唐门487话', './img_load.php?book_id=31&collect=487话', 31, 0);
INSERT INTO `pre_chapter` VALUES (155, 1566744343, '斗破苍穹791话', './img_load.php?book_id=32&collect=791话', 32, 0);
INSERT INTO `pre_chapter` VALUES (156, 1566746557, '斗破苍穹792话', './img_load.php?book_id=32&collect=792话', 32, 0);
INSERT INTO `pre_chapter` VALUES (160, 1566747206, '斗罗大陆653话', './img_load.php?book_id=33&collect=653话', 33, 0);
INSERT INTO `pre_chapter` VALUES (161, 1566747271, '斗罗大陆3龙王传说207话', './img_load.php?book_id=34&collect=207话', 34, 0);
INSERT INTO `pre_chapter` VALUES (162, 1566747538, '斗罗大陆3龙王传说208话', './img_load.php?book_id=34&collect=208话', 34, 0);
INSERT INTO `pre_chapter` VALUES (163, 1566747583, '斗破苍穹之药老传奇161话', './img_load.php?book_id=35&collect=161话', 35, 0);
INSERT INTO `pre_chapter` VALUES (164, 1566747603, '斗破苍穹之药老传奇162话', './img_load.php?book_id=35&collect=162话', 35, 0);
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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='网站设置表';

-- ----------------------------
-- Records of pre_config
-- ----------------------------
BEGIN;
INSERT INTO `pre_config` VALUES (1, 'company', '广州金鸿基体育发展有限公司1');
INSERT INTO `pre_config` VALUES (2, 'address', '中国地区XX分区5A写字楼8-88室2');
INSERT INTO `pre_config` VALUES (3, 'email', 'website@qq.com3');
INSERT INTO `pre_config` VALUES (4, 'phone', '188-666-51884');
INSERT INTO `pre_config` VALUES (5, 'fax', '333335');
INSERT INTO `pre_config` VALUES (6, 'keywords', 'ddd6');
INSERT INTO `pre_config` VALUES (7, 'description', '333337');
INSERT INTO `pre_config` VALUES (8, 'logo', 'uploads/config/20181015010918003636.png');
INSERT INTO `pre_config` VALUES (9, 'qrcode', 'uploads/config/20181015010918006088.jpg');
INSERT INTO `pre_config` VALUES (10, 'qq', '7777777');
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
