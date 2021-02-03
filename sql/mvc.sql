/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100413
 Source Host           : localhost:3306
 Source Schema         : mvc

 Target Server Type    : MySQL
 Target Server Version : 100413
 File Encoding         : 65001

 Date: 03/02/2021 09:15:17
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for elements_menu
-- ----------------------------
DROP TABLE IF EXISTS `elements_menu`;
CREATE TABLE `elements_menu`  (
  `id_element` int(11) NOT NULL AUTO_INCREMENT,
  `nom_element` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lien_element` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `permission` int(11) NULL DEFAULT NULL,
  `ordre` int(1) NOT NULL,
  PRIMARY KEY (`id_element`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of elements_menu
-- ----------------------------
INSERT INTO `elements_menu` VALUES (1, '<i class=\"fas fa-home li_menu\"></i><span class=\"menu_e\">Accueil</span>', '/news', -1, 1);
INSERT INTO `elements_menu` VALUES (2, '<i class=\"fas fa-user-plus li_menu\"></i><span class=\"menu_e\">Inscription</span>', '/utilisateur/register', 0, 2);
INSERT INTO `elements_menu` VALUES (3, '<i class=\"fas fa-user li_menu\"></i><span class=\"menu_e\">Mon Compte</span>', '/utilisateur/compte', 1, 2);
INSERT INTO `elements_menu` VALUES (4, 'Admin', '/admin', 2, 5);
INSERT INTO `elements_menu` VALUES (5, '<i class=\"fas fa-sign-out-alt li_menu\"></i><span class=\"menu_e\">D&eacute;connexion</span>', '/utilisateur/logout', 1, 5);
INSERT INTO `elements_menu` VALUES (6, '<i class=\"fas fa-sign-in-alt li_menu\"></i><span class=\"menu_e\">Connexion</span>', '/utilisateur/login', 0, 5);
INSERT INTO `elements_menu` VALUES (8, '<i class=\"fas fa-hand-holding-usd li_menu\"></i><span class=\"menu_e\">Crediter Compte</span>', '/utilisateur/credit_point', 1, 4);

-- ----------------------------
-- Table structure for forum_categorie
-- ----------------------------
DROP TABLE IF EXISTS `forum_categorie`;
CREATE TABLE `forum_categorie`  (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_nom` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `cat_ordre` int(11) NOT NULL,
  PRIMARY KEY (`cat_id`) USING BTREE,
  UNIQUE INDEX `cat_ordre`(`cat_ordre`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf32 COLLATE = utf32_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for forum_forum
-- ----------------------------
DROP TABLE IF EXISTS `forum_forum`;
CREATE TABLE `forum_forum`  (
  `forum_id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_cat_id` mediumint(8) NOT NULL,
  `forum_name` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `forum_desc` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `forum_ordre` mediumint(8) NOT NULL,
  `forum_last_post_id` int(11) NOT NULL,
  `forum_topic` mediumint(8) NOT NULL,
  `forum_post` mediumint(8) NOT NULL,
  `auth_view` tinyint(4) NOT NULL,
  `auth_post` tinyint(4) NOT NULL,
  `auth_topic` tinyint(4) NOT NULL,
  `auth_annonce` tinyint(4) NOT NULL,
  `auth_modo` tinyint(4) NOT NULL,
  PRIMARY KEY (`forum_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf32 COLLATE = utf32_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for forum_membres
-- ----------------------------
DROP TABLE IF EXISTS `forum_membres`;
CREATE TABLE `forum_membres`  (
  `membre_id` int(11) NOT NULL AUTO_INCREMENT,
  `membre_pseudo` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `membre_mdp` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `membre_email` varchar(250) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `membre_msn` varchar(250) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `membre_siteweb` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `membre_avatar` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `membre_signature` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `membre_localisation` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `membre_inscrit` int(11) NOT NULL,
  `membre_derniere_visite` int(11) NOT NULL,
  `membre_rang` tinyint(4) NULL DEFAULT 2,
  `membre_post` int(11) NOT NULL,
  PRIMARY KEY (`membre_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf32 COLLATE = utf32_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for forum_post
-- ----------------------------
DROP TABLE IF EXISTS `forum_post`;
CREATE TABLE `forum_post`  (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_createur` int(11) NOT NULL,
  `post_texte` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `post_time` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `post_forum_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf32 COLLATE = utf32_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for forum_topic
-- ----------------------------
DROP TABLE IF EXISTS `forum_topic`;
CREATE TABLE `forum_topic`  (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_id` int(11) NOT NULL,
  `topic_titre` char(60) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `topic_createur` int(11) NOT NULL,
  `topic_vu` mediumint(8) NOT NULL,
  `topic_time` int(11) NOT NULL,
  `topic_genre` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `topic_last_post` int(11) NOT NULL,
  `topic_first_post` int(11) NOT NULL,
  `topic_post` mediumint(8) NOT NULL,
  PRIMARY KEY (`topic_id`) USING BTREE,
  UNIQUE INDEX `topic_last_post`(`topic_last_post`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf32 COLLATE = utf32_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for item_boutique
-- ----------------------------
DROP TABLE IF EXISTS `item_boutique`;
CREATE TABLE `item_boutique`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(255) NULL DEFAULT NULL,
  `nom` varchar(255) CHARACTER SET utf32 COLLATE utf32_general_ci NULL DEFAULT NULL,
  `prix` decimal(20, 1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf32 COLLATE = utf32_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of item_boutique
-- ----------------------------
INSERT INTO `item_boutique` VALUES (1, 2554, 'Test Item', 10.5);
INSERT INTO `item_boutique` VALUES (2, 2458, 'Test Item 2', 0.5);

-- ----------------------------
-- Table structure for mails_template
-- ----------------------------
DROP TABLE IF EXISTS `mails_template`;
CREATE TABLE `mails_template`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fonction` varchar(255) CHARACTER SET utf32 COLLATE utf32_general_ci NULL DEFAULT NULL,
  `Sujet` varchar(255) CHARACTER SET utf32 COLLATE utf32_general_ci NULL DEFAULT NULL,
  `Contenu` varchar(255) CHARACTER SET utf32 COLLATE utf32_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mails_template
-- ----------------------------
INSERT INTO `mails_template` VALUES (2, 'register', 'Test', 'nom de compte : &ugrave;&ugrave;&ugrave;<br> En vous remerciant.');

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message`  (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `autheur` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `message` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_message`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 208 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of message
-- ----------------------------
INSERT INTO `message` VALUES (207, 'Test User', 'bonjour', '2/02/21 15:53:45');
INSERT INTO `message` VALUES (205, 'Test User', '<script>alert(\"Test\")</script>', '1/02/21 15:28:23');
INSERT INTO `message` VALUES (206, 'Test User', '<br><font color=\"green\">test</font>', '1/02/21 15:28:57');
INSERT INTO `message` VALUES (203, 'xrtrdgrdr', 'test', '1/02/21 11:22:20');

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contenu` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 152 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES (149, '[REMOVED]alert(\'test\')[/REMOVED]', '[REMOVED]alert(\'test\')[/REMOVED]', '01/02/2021');
INSERT INTO `news` VALUES (150, 'test', '<p>test</p><p align=\"center\">TEST</p><p align=\"right\">Test<br></p>', '01/02/2021');
INSERT INTO `news` VALUES (151, '[Removed]alert(\'test\')[/Removed]', '&lt;p&gt;&amp;lt;script&amp;gt;alert(\'test\')&amp;lt;/script&amp;gt;&lt;br&gt;&lt;/p&gt;', '02/02/2021');

-- ----------------------------
-- Table structure for pages
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contenu` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `admin` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `connected` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pages
-- ----------------------------
INSERT INTO `pages` VALUES (11, '[REMOVED]alert(\'test\')[/REMOVED]', '[REMOVED]alert(\'test\')[/REMOVED]', '[REMOVED]alert(\'test\')[/REMOVED]', '0', '0');

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings`  (
  `titre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `couleur_text` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `couleur_lien` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `couleur_h1` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `couleur_h2` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `couleur_h3` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `couleur_h4` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `couleur_input` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nbNews` int(1) NULL DEFAULT 2,
  `couleur_label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `header_color` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nb_point` decimal(65, 1) NOT NULL,
  `footer_color` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES ('', '', '#0496e3', '#0eb433', '#c0c0c0', '#949494', '#87e495', '#818181', '', 1, '#17268c', '#343a40', 1.5, '#343a40');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifiant` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `mdp` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pseudo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sexe` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `admin` int(11) NOT NULL DEFAULT 0,
  `nom` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `naissance` date NOT NULL DEFAULT '0000-00-00',
  `date_inscription` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `connected` int(11) NOT NULL DEFAULT 0,
  `last_ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `solde` decimal(65, 1) NOT NULL DEFAULT 0,
  `membre_signature` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `membre_localisation` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `membre_derniere_visite` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `membre_post` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 114 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (72, 'admin', '$2y$10$hpqW.kejgehLDFoBZb9hneD5eUrJ.UW9Yq0i/FMvjsPOy8HfM3EaG', 'admin@topheberge.fr', 'xrtrdgrdrsgsezg', 'Homme', 1, 'anonymeser', 'Anonymescezg', '1995-08-31', '16 Nov 2020 16:43:34', '/uploads/avatars/eso1644bsmall__w770.jpg', 1, '', 37.5, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (88, 'test', '$2y$10$dI11c9t00YBhPQVfaZnYnu/1YY9pfKvWXOEtZVvf4IrjPw853KFPG', 'qdqd@dqzszsq.fr', 'Test User', 'Homme', 0, 'dsf', 'dqd', '2001-01-01', '21 Jan 2021 08:31:02', '/uploads/avatars/88_31-01-2021_23-01-27_147175-4844-gif-anime.gif', 1, '', 63.0, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (113, 'ef', '$2y$10$tRyQ/5lwxN9B7ZOkCjXWqOg0x3qCsczC36pDprWUVqMoKAV3d8NkC', 'emerald-dream@live.fr', 'sfsf', 'Femme', 0, 'dfgdf', 'sfsf', '2000-01-01', '02 Feb 2021 14:07:35', '/uploads/avatars/unnamed.jpg', 0, '127.0.0.1', 0.0, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for users_pending
-- ----------------------------
DROP TABLE IF EXISTS `users_pending`;
CREATE TABLE `users_pending`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifiant` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `mdp` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pseudo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sexe` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `admin` int(11) NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `naissance` date NOT NULL DEFAULT '0000-00-00',
  `date_inscription` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `last_ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 117 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users_pending
-- ----------------------------
INSERT INTO `users_pending` VALUES (113, 'ef', '$2y$10$tRyQ/5lwxN9B7ZOkCjXWqOg0x3qCsczC36pDprWUVqMoKAV3d8NkC', 'emerald-dream@live.fr', 'sfsf', 'Femme', 0, 'dfgdf', 'sfsf', '2000-01-01', '02 Feb 2021 14:07:35', '1166EAE6EEFF482BAC15E00A622AB14E', '127.0.0.1');

SET FOREIGN_KEY_CHECKS = 1;
