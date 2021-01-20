/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : mvc

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2021-01-20 16:49:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `elements_menu`
-- ----------------------------
DROP TABLE IF EXISTS `elements_menu`;
CREATE TABLE `elements_menu` (
  `id_element` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `nom_element` int(11) NOT NULL,
  `lien_element` int(11) NOT NULL,
  `permission` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_element`),
  KEY `id_menufk` (`id_menu`),
  CONSTRAINT `elements_menu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of elements_menu
-- ----------------------------

-- ----------------------------
-- Table structure for `menus`
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `nb_elements` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menus
-- ----------------------------

-- ----------------------------
-- Table structure for `news`
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `contenu` longtext NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=127 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('115', 'xcbvdfg', 'dsfgsegfdesgedsg', '18/01/2021');
INSERT INTO `news` VALUES ('116', 'setgg', '       gdgef                             dsvds                        grdggrd                                                            ', '20/01/2021');
INSERT INTO `news` VALUES ('118', 'dgerg', 'tge', '20/01/2021');
INSERT INTO `news` VALUES ('119', 'gergre', '            egfsgsegdsgsdg esfesf esf ef efqz qz fesf fesf esf esse fsefÂ rdgdrgrdg            ', '20/01/2021');
INSERT INTO `news` VALUES ('121', 'rdhdfdfg', '<p>dgdfg</p>', '20/01/2021');
INSERT INTO `news` VALUES ('122', 'dgesgsgsgr', '<p>vdss</p><p>dsfdsg</p><p>sgsfs</p><p>svessd</p><h2 style=\"text-align: center; \"><font color=\"#ff0000\" style=\"background-color: rgb(0, 255, 255);\"><u>Coucou</u></font></h2><p style=\"text-align: right;\"></p>', '20/01/2021');
INSERT INTO `news` VALUES ('123', 'dsggdgdrg', '<h1><font color=\"#ffff00\"><span style=\"font-family: Impact;\">drhdhtjfhft</span></font></h1>', '20/01/2021');

-- ----------------------------
-- Table structure for `pages`
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `contenu` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `admin` int(11) NOT NULL,
  `connected` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pages
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifiant` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `sexe` varchar(255) NOT NULL,
  `admin` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `naissance` date NOT NULL DEFAULT '0000-00-00',
  `date_inscription` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `connected` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('72', 'admin', '$2y$10$hpqW.kejgehLDFoBZb9hneD5eUrJ.UW9Yq0i/FMvjsPOy8HfM3EaG', 'admin@topheberge.fr', 'Darkmoi147', 'Homme', '1', 'anonyme', 'Anonymesc', '1995-08-31', '16 Nov 2020 16:43:34', '/uploads/avatars/BV2BOK2CS6GLRHM5BUZSD7FF5Q.jpg', '1');

-- ----------------------------
-- Table structure for `web_config`
-- ----------------------------
DROP TABLE IF EXISTS `web_config`;
CREATE TABLE `web_config` (
  `titre` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `couleur_text` varchar(255) NOT NULL,
  `couleur_lien` varchar(255) NOT NULL,
  `couleur_h1` varchar(255) NOT NULL,
  `couleur_h2` varchar(255) NOT NULL,
  `couleur_h3` varchar(255) NOT NULL,
  `couleur_h4` varchar(255) NOT NULL,
  `couleur_input` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_config
-- ----------------------------
