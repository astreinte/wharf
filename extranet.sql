-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 10 Octobre 2013 à 13:53
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `extranet`
--
CREATE DATABASE IF NOT EXISTS `extranet` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `extranet`;

-- --------------------------------------------------------

--
-- Structure de la table `actions`
--

CREATE TABLE IF NOT EXISTS `actions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `recipient_id` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'info',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Contenu de la table `actions`
--

INSERT INTO `actions` (`id`, `content`, `created_at`, `updated_at`, `deleted_at`, `recipient_id`, `type`, `class`) VALUES
(1, '', '2013-09-13 12:54:35', '2013-09-13 12:54:35', NULL, 17, 'add_group', 'info'),
(3, '', '2013-09-13 13:06:41', '2013-09-13 13:06:41', NULL, 13, 'add_division', 'info'),
(4, '', '2013-09-13 13:20:04', '2013-09-13 13:20:04', NULL, 6, 'add_folder', 'info'),
(5, '', '2013-10-04 08:50:11', '2013-10-04 08:50:11', NULL, 15, 'edit_group', 'info'),
(6, '', '2013-10-07 07:52:38', '2013-10-07 07:52:38', NULL, 25, 'add_user', 'info'),
(7, '', '2013-10-07 07:54:39', '2013-10-07 07:54:39', NULL, 26, 'add_user', 'info'),
(8, '', '2013-10-07 08:24:48', '2013-10-07 08:24:48', NULL, 16, 'add_project', 'info');

-- --------------------------------------------------------

--
-- Structure de la table `action_user`
--

CREATE TABLE IF NOT EXISTS `action_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `action_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Contenu de la table `action_user`
--

INSERT INTO `action_user` (`id`, `action_id`, `user_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `discussion_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id`, `message`, `user_id`, `discussion_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, 'szszszsz', 1, 15, '2013-09-05 14:46:54', '2013-09-05 14:46:54', NULL),
(10, 'ok pour moi', 1, 17, '2013-09-06 08:08:26', '2013-09-06 08:08:26', NULL),
(11, 'fdfdfdfd', 1, 17, '2013-09-06 08:09:53', '2013-09-06 08:09:53', NULL),
(12, 'fddfdfd', 1, 18, '2013-09-06 08:28:01', '2013-09-06 08:28:01', NULL),
(13, 'rererer', 1, 18, '2013-09-06 08:29:53', '2013-09-06 08:29:53', NULL),
(14, 'zezezezezez', 1, 18, '2013-09-06 08:31:45', '2013-09-06 08:31:45', NULL),
(15, 'ezezez', 1, 18, '2013-09-06 08:32:18', '2013-09-06 08:32:18', NULL),
(16, 'rrerere', 1, 18, '2013-09-06 08:39:38', '2013-09-06 08:39:38', NULL),
(17, 'fddfdfd', 1, 18, '2013-09-06 08:40:11', '2013-09-06 08:40:11', NULL),
(18, 'fdfdfdfd', 22, 18, '2013-09-06 08:40:55', '2013-09-06 08:40:55', NULL),
(19, 'drereere', 1, 18, '2013-09-06 08:41:18', '2013-09-06 08:41:18', NULL),
(20, 'trtrtr', 1, 19, '2013-09-06 08:42:37', '2013-09-06 08:42:37', NULL),
(21, 'sqsqsq', 1, 20, '2013-09-06 08:49:15', '2013-09-06 08:49:15', NULL),
(22, 'dssdsd', 1, 20, '2013-09-06 08:49:18', '2013-09-06 08:49:18', NULL),
(23, 'dssdsddsds', 1, 20, '2013-09-06 08:49:24', '2013-09-06 08:49:24', NULL),
(24, 'rtrtr', 1, 20, '2013-09-06 08:50:38', '2013-09-06 08:50:38', NULL),
(25, 'ioioioioi', 1, 21, '2013-09-06 08:57:17', '2013-09-06 08:57:17', NULL),
(26, 'ghghghg', 22, 21, '2013-09-06 09:07:39', '2013-09-06 09:07:39', NULL),
(27, 'Are you using a package that overrides the Blade directives?\r\n\r\nBy default {{ }} does not escape its data, while {{{ }}} does (so it should work, hence my question)', 1, 22, '2013-09-06 12:57:29', '2013-09-06 12:57:29', NULL),
(28, 'No, I''m not using any package, default Laravel', 1, 22, '2013-09-06 12:57:45', '2013-09-06 12:57:45', NULL),
(29, '{{ }} Does not, but many HTML functions does escape their content, listing is one of them and there is no option to turn this off.\r\n\r\nYou could wrap it in HTML::decode().\r\n\r\n{{ HTML::decode(HTML::ul(array(\r\n  link_to(''users'', ''Users''),\r\n  link_to(''sports'', ''Sports''),\r\n), array(''class'' => ''left''))) }}\r\nOfcourse this will mean nothing will be escaped inside.', 1, 22, '2013-09-06 12:58:13', '2013-09-06 12:58:13', NULL),
(30, 'fgfgfggf', 22, 24, '2013-09-12 09:07:53', '2013-09-12 09:07:53', NULL),
(31, 'ok c''est bon', 1, 25, '2013-09-12 13:59:43', '2013-09-12 13:59:43', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `discussions`
--

CREATE TABLE IF NOT EXISTS `discussions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  `closer_id` int(11) DEFAULT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Contenu de la table `discussions`
--

INSERT INTO `discussions` (`id`, `closed`, `closer_id`, `title`, `content`, `user_id`, `document_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'ffdfdf', 'dfdfdffdfdfd', 1, 1, '2013-09-04 12:51:13', '2013-09-06 07:48:44', NULL),
(2, 1, 1, 'ytytytytyt', 'ytytytyty', 1, 1, '2013-09-04 13:10:03', '2013-09-06 07:45:16', NULL),
(3, 1, 1, 'Voici le titre de la discuss...', 'Comment used the word "for" where the word "before" was meant', 1, 1, '2013-09-04 13:57:41', '2013-09-05 08:09:39', NULL),
(4, 1, 1, 'Hello world', 'Comment used the word "for" where the word "before" was meant', 1, 1, '2013-09-04 13:59:03', '2013-09-04 13:59:03', NULL),
(5, 1, 1, 'Voici le titre', 'Hello world', 1, 1, '2013-09-04 15:28:06', '2013-09-05 08:08:39', NULL),
(6, 0, NULL, 'test de discussion', 'hello world', 1, 10, '2013-09-05 07:49:29', '2013-09-05 07:49:29', NULL),
(7, 1, 1, 'ezjeziezh', 'zuzehuzezuheuz\r\nez\r\nzez\r\nz\r\ne', 1, 11, '2013-09-05 08:10:12', '2013-09-05 08:10:20', NULL),
(8, 0, NULL, 'hello ', 'jejejee', 1, 12, '2013-09-05 08:12:23', '2013-09-05 08:12:23', NULL),
(9, 0, NULL, 'hello world', 'jjezerez', 22, 11, '2013-09-05 08:13:37', '2013-09-05 08:13:37', NULL),
(10, 0, NULL, 'hello', 'sjsjsjss', 1, 11, '2013-09-05 08:19:52', '2013-09-05 08:19:52', NULL),
(11, 1, 1, 'dsddsds', 'dsdsdssd', 1, 11, '2013-09-05 08:21:39', '2013-09-05 10:01:12', NULL),
(12, 1, 1, 'heloddd', 'odoodd', 22, 11, '2013-09-05 10:02:07', '2013-09-05 10:09:02', NULL),
(13, 1, 1, 'sqsqsq', 'sqsqsq', 22, 1, '2013-09-05 10:11:23', '2013-09-05 10:11:38', NULL),
(14, 1, 1, 'Woww!!!', 'Pas mal la version', 22, 16, '2013-09-05 10:32:00', '2013-09-05 10:32:19', NULL),
(15, 0, NULL, 'hello world', 'voici la discussion', 1, 16, '2013-09-05 14:32:20', '2013-09-05 14:32:20', NULL),
(16, 1, 1, 'a propos du rendu', 'Ca me convient', 1, 1, '2013-09-05 15:17:28', '2013-09-05 15:17:41', NULL),
(17, 1, 1, 'testttt', 'testtttt', 1, 1, '2013-09-06 08:07:59', '2013-09-06 08:16:32', NULL),
(18, 1, 1, 'whahedsds', 'dssdsdsds', 1, 1, '2013-09-06 08:16:57', '2013-09-06 08:41:21', NULL),
(19, 1, 1, 'hello world', 'dsdsds', 22, 1, '2013-09-06 08:40:46', '2013-09-06 08:42:39', NULL),
(20, 1, 1, 'hello', 'cococ', 1, 1, '2013-09-06 08:43:52', '2013-09-10 13:50:46', NULL),
(21, 1, 1, 'trrrtrtr', 'rtrtrtrtr', 1, 1, '2013-09-06 08:57:13', '2013-09-06 13:43:59', NULL),
(22, 1, 1, 'HTML::ul() html escaping problem', '{{ HTML::ul(array(\r\nlink_to(''users'', ''Users''),\r\nlink_to(''sports'', ''Sports''),\r\n), array(''class'' => ''left'')) }}\r\n\r\nShould generate this:\r\n\r\nUsers\r\nSports\r\nInstead generates this:\r\n\r\n<a href="users">Users</a>\r\n<a href="sports">Sports</a>\r\nThe browser shows a list with literals: Users\r\n\r\nSince in the API I don''t see a "don''t escape html" option, I assumed this is an issue.', 1, 1, '2013-09-06 12:57:02', '2013-09-06 12:59:18', NULL),
(23, 0, NULL, 'trtrtrtr', 'trtrt', 1, 2, '2013-09-06 13:45:23', '2013-09-06 13:45:23', NULL),
(24, 1, 1, 'dffdfdfd', 'fdfdfdfdfd', 1, 1, '2013-09-12 08:56:50', '2013-09-12 09:10:17', NULL),
(25, 1, 1, 'Hello world', 'un test', 1, 1, '2013-09-12 13:06:17', '2013-09-12 14:00:17', NULL),
(26, 1, 1, 'hello world lol', 'dhsdsdsddsds', 1, 1, '2013-10-03 12:35:53', '2013-10-03 12:36:01', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `divisioninfos`
--

CREATE TABLE IF NOT EXISTS `divisioninfos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `divisioninfos`
--

INSERT INTO `divisioninfos` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ressources humaines', '2013-08-26 12:56:34', '2013-08-26 12:56:34', NULL),
(2, 'Communication', '2013-08-26 12:56:46', '2013-08-26 12:56:46', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `divisions`
--

CREATE TABLE IF NOT EXISTS `divisions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `group_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ressouces humaines', 13, '2013-09-02 15:04:40', '2013-09-02 15:04:47', NULL),
(2, 'Hello world', 15, '2013-09-05 10:21:17', '2013-09-05 10:21:17', NULL),
(3, 'Ressources humaines', 17, '2013-09-13 12:54:35', '2013-09-13 12:54:35', NULL),
(4, 'Fgggf', 13, '2013-09-13 13:06:41', '2013-09-13 13:06:41', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `division_location`
--

CREATE TABLE IF NOT EXISTS `division_location` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `division_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `division_location`
--

INSERT INTO `division_location` (`id`, `division_id`, `location_id`, `created_at`, `updated_at`) VALUES
(1, 1, 35, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL,
  `folder_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `documents`
--

INSERT INTO `documents` (`id`, `name`, `type`, `created_at`, `updated_at`, `deleted_at`, `path`, `size`, `project_id`, `folder_id`) VALUES
(1, 'thumb-1.jpg', 'image', '2013-09-05 15:13:54', '2013-09-05 15:13:54', NULL, 'http://localhost/extranet/public/uploads/documents/52289fb2177c8.jpg', '14.56', 6, 0),
(2, 'image-6.jpg', 'image', '2013-09-05 15:16:24', '2013-09-05 15:16:24', NULL, 'http://localhost/extranet/public/uploads/documents/5228a04816ff8.jpg', '72.05', 6, 1),
(3, 'image-4.jpg', 'image', '2013-09-11 15:52:00', '2013-09-11 15:52:00', NULL, 'http://localhost/extranet/public/uploads/documents/523091a00aca8.jpg', '116.71', 6, 3);

-- --------------------------------------------------------

--
-- Structure de la table `document_user`
--

CREATE TABLE IF NOT EXISTS `document_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `document_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `document_user`
--

INSERT INTO `document_user` (`id`, `document_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 1, 22, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `folders`
--

CREATE TABLE IF NOT EXISTS `folders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `folder_id` int(11) NOT NULL DEFAULT '0',
  `project_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `folders`
--

INSERT INTO `folders` (`id`, `name`, `folder_id`, `project_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'rendus', 0, 6, '2013-09-05 15:16:13', '2013-09-05 15:16:13', NULL),
(2, 'ezez', 1, 6, '2013-09-11 09:05:02', '2013-09-11 09:05:02', NULL),
(3, 'bggyy', 0, 6, '2013-09-11 15:51:50', '2013-09-11 15:51:50', NULL),
(4, 'yytytt', 0, 6, '2013-09-13 13:20:04', '2013-09-13 13:20:04', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(320) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Contenu de la table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `logo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(13, 'Wharf', 'La communication e-corporate par la médiation.', 'http://localhost/extranet/public/uploads/logos/Wharf-521c5e2c77948.png', '2013-08-07 12:48:06', '2013-08-27 08:07:08', NULL),
(14, 'Segula Technologies', 'Seul ingénieriste en France à posséder ses propres capacités de production, SEGULA Technologies choisit de les rassembler au sein de SIMRA, société qui regroupe désormais l''ensemble des activités et moyens de production du groupe, fortement localisés et développés en France.', 'http://localhost/extranet/public/uploads/logos/Segula Technologies-521c64f8a5f78.jpg', '2013-08-07 12:49:27', '2013-08-27 08:37:30', NULL),
(15, 'CargoHub', 'Solutions innovantes pour la logistique.', 'http://localhost/extranet/public/uploads/logos/CargoHub-524e81432fe68.png', '2013-08-07 13:20:46', '2013-10-04 08:50:11', NULL),
(16, 'Fdfdfdfd', 'dffffddfdfdf', NULL, '2013-09-13 12:53:55', '2013-09-13 12:53:55', NULL),
(17, 'Fdfdfdfd', 'dffffddfdfdf', NULL, '2013-09-13 12:54:35', '2013-09-13 12:54:35', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `group_location`
--

CREATE TABLE IF NOT EXISTS `group_location` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Contenu de la table `group_location`
--

INSERT INTO `group_location` (`id`, `group_id`, `location_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 4, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 5, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 6, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 7, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 8, 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 9, 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 10, 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 11, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 12, 18, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 13, 19, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 14, 20, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 15, 21, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 16, 22, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 17, 23, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 18, 24, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 19, 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 21, 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 22, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 17, 36, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `group_sector`
--

CREATE TABLE IF NOT EXISTS `group_sector` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `sector_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Contenu de la table `group_sector`
--

INSERT INTO `group_sector` (`id`, `group_id`, `sector_id`) VALUES
(8, 16, 1),
(9, 16, 3),
(10, 17, 2),
(11, 17, 3),
(16, 18, 1),
(17, 18, 2),
(18, 18, 3),
(24, 22, 1),
(25, 22, 3),
(31, 14, 2),
(32, 13, 2),
(33, 17, 1);

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `jobs`
--

INSERT INTO `jobs` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Fff', '2013-08-12 08:23:17', '2013-08-12 06:23:17', '2013-08-12 06:23:17'),
(2, 'Développeur', '2013-08-08 07:49:22', '2013-08-08 07:49:22', NULL),
(3, 'Ezeezz', '2013-08-19 15:46:29', '2013-08-19 15:46:29', '2013-08-19 15:46:29'),
(4, 'Ooop', '2013-08-19 15:46:25', '2013-08-19 15:46:25', '2013-08-19 15:46:25'),
(5, 'Eee', '2013-08-19 15:46:22', '2013-08-19 15:46:22', '2013-08-19 15:46:22'),
(6, 'Gfgfgfgf', '2013-09-11 08:04:56', '2013-09-11 08:04:56', NULL),
(7, 'Tyytytyt', '2013-09-11 08:05:24', '2013-09-11 08:05:24', NULL),
(8, 'Tytytttttt', '2013-09-11 08:09:33', '2013-09-11 08:09:33', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `job_user`
--

CREATE TABLE IF NOT EXISTS `job_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Contenu de la table `job_user`
--

INSERT INTO `job_user` (`id`, `job_id`, `user_id`) VALUES
(6, 2, 22),
(8, 2, 23),
(10, 2, 25),
(11, 1, 24),
(12, 2, 21),
(13, 2, 27),
(14, 2, 25),
(15, 2, 26),
(20, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `primary` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Contenu de la table `locations`
--

INSERT INTO `locations` (`id`, `street`, `city`, `zip`, `country`, `created_at`, `updated_at`, `deleted_at`, `primary`) VALUES
(1, '(--((-(-', '-((--(-', '-(-((-', '(-(', '2013-08-05 08:28:22', '2013-08-05 08:28:22', NULL, 1),
(2, 'sfsfs', 'Fsffss', 'sfsfsfssf', 'Ffsfsfsfs', '2013-08-05 08:28:41', '2013-08-05 08:30:45', '2013-08-05 08:30:45', 0),
(3, 'fsfsf', 'Fsffss', 'fsfsfs', 'Fsfsfs', '2013-08-05 08:28:47', '2013-08-05 08:31:54', '2013-08-05 08:31:54', 1),
(4, 'ytytty', 'Ytty', 'tyyt', 'Tyyty', '2013-08-05 08:32:10', '2013-08-05 08:32:13', '2013-08-05 08:32:13', 1),
(5, 'rtrttr', 'Trttr', 'trtr', 'Trtrtrtr', '2013-08-05 08:32:36', '2013-08-05 08:32:39', '2013-08-05 08:32:39', 1),
(6, 'trtrtr', 'Trtrtrtrtr', 'trtrtr', 'Trtrtrtrtr', '2013-08-05 08:32:47', '2013-08-05 08:33:24', '2013-08-05 08:33:24', 1),
(7, 'ttrtrtr', 'Trtrtrtr', 'trtrtrtr', 'Trtrtrtrtr', '2013-08-05 08:32:54', '2013-08-05 08:33:02', '2013-08-05 08:33:02', 1),
(8, 'yyyyyt', 'Yyy', 'yyyyyy', 'Yyyyyy', '2013-08-05 08:34:19', '2013-08-05 08:34:19', NULL, 1),
(9, 'tytyty', 'Tytyty', 'tyytty', 'Tytyty', '2013-08-05 08:38:14', '2013-08-05 08:38:14', NULL, 1),
(10, 'tyty', 'Tytyyt', 'tyty', 'Tytyyty', '2013-08-05 08:38:57', '2013-08-05 08:38:57', NULL, 1),
(11, 'trtrtr', 'Trtrtrtrtr', 'trtrtr', 'Trtrtrtrtr', '2013-08-05 08:39:27', '2013-08-05 08:39:27', NULL, 1),
(12, 'tyyt', 'Tyty', 'tytyty', 'Tyytty', '2013-08-05 08:40:00', '2013-08-05 08:40:05', '2013-08-05 08:40:05', 1),
(13, 'erre', 'Rrrr', 'eee', 'Eeee', '2013-08-05 08:40:37', '2013-08-05 08:41:18', '2013-08-05 08:41:18', 1),
(14, 'ytytty', 'Yttyyt', 'ytyttyty', 'Tyyttyty', '2013-08-07 10:31:32', '2013-08-07 12:10:09', '2013-08-07 12:10:09', 1),
(15, 'tttt', 'Ttt', 'ttt', 'Tttt', '2013-08-07 12:10:26', '2013-08-07 12:49:05', '2013-08-07 12:49:05', 1),
(16, 'trtrtr', 'Trtrtrtr', 'trtrtrtr', 'Trtrtrtr', '2013-08-07 12:12:16', '2013-08-07 12:12:41', '2013-08-07 12:12:41', 1),
(17, 'fff', 'Fff', 'fff', 'Fff', '2013-08-07 12:14:16', '2013-08-07 12:15:44', '2013-08-07 12:15:44', 1),
(18, 'dfdfdf', 'Fddfdf', 'dfdfdf', 'Dfdfdf', '2013-08-07 12:32:13', '2013-08-07 12:49:08', '2013-08-07 12:49:08', 1),
(19, '54 rue des trois frères', 'Paris', '75018', 'France', '2013-08-07 12:48:06', '2013-08-07 12:48:06', NULL, 1),
(20, '17-23 rue d''Arras', 'Nanterre', '92000', 'France', '2013-08-07 12:49:27', '2013-08-07 12:49:27', NULL, 1),
(21, '370 Route de Longwy', 'Luxembourg', 'l-1940', 'Luxembourg', '2013-08-07 13:20:46', '2013-08-07 13:20:46', NULL, 1),
(22, 'ererer', 'Erreer', 'erreer', 'Erererre', '2013-08-07 13:31:25', '2013-08-09 08:38:05', '2013-08-09 08:38:05', 1),
(23, 'errer', 'Ererre', 'ererer', 'Ererer', '2013-08-07 13:31:42', '2013-08-09 08:38:09', '2013-08-09 08:38:09', 1),
(24, '05 rue des tests', '5855', '93600', 'Sssj', '2013-08-08 12:06:53', '2013-08-19 15:04:39', '2013-08-19 15:04:39', 1),
(25, 'oooo', 'Oooo', 'oooo', 'Oooo', '2013-08-09 10:46:00', '2013-08-09 10:46:10', '2013-08-09 10:46:10', 1),
(26, 'mmm', 'Mmm', 'mmm', 'Mmmm', '2013-08-09 11:34:55', '2013-08-09 13:04:49', '2013-08-09 13:04:49', 0),
(27, '05 rue du ruisseau', 'Paris', '75018', 'France', '2013-08-09 12:10:54', '2013-08-09 12:20:16', '2013-08-09 12:20:16', 1),
(28, 'uhughugh', 'Ssssss', 'gygyg', 'Gygygyg', '2013-08-09 12:20:55', '2013-08-09 12:21:30', '2013-08-09 12:21:30', 1),
(29, 'ytytytyt', 'Yttytyt', 'yttytyty', 'Yttytytty', '2013-08-19 13:08:24', '2013-08-19 14:41:28', '2013-08-19 14:41:28', 1),
(30, 'trttrtrtr', 'Trttrtr', 'trtrtrrttr', 'Trtrtrtrtr', '2013-08-19 15:07:49', '2013-08-19 15:07:49', NULL, 1),
(31, 'rtrtrt', 'Trtrtr', 'rtrtrtr', 'Trtrtt', '2013-08-21 15:02:50', '2013-08-22 14:17:19', NULL, 1),
(32, '05 ruedddd', 'Paris', '730544', 'France', '2013-08-22 08:56:35', '2013-08-22 14:17:19', NULL, 0),
(33, '05 rue du ruisseau', 'Paris', '75018', 'France', '2013-08-26 12:58:22', '2013-08-26 13:12:05', NULL, 1),
(34, '07 rue de Courcelle', 'Paris', '75017', 'France', '2013-08-26 12:59:04', '2013-08-26 13:12:05', NULL, 0),
(35, 'yuyuyuy', 'Uyuyuy', 'uyuyuy', 'Uyuyuy', '2013-09-09 07:59:26', '2013-09-09 07:59:26', NULL, 1),
(36, 'ddfdfdfdfd', 'Dfdfdfdfdf', 'dfdfdfdf', 'Dfdfdfdfdf', '2013-09-13 12:54:35', '2013-09-13 12:54:35', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2013_07_22_134127_create_users_table', 1),
('2013_07_23_120457_create_roles-table', 2),
('2013_07_23_120949_create_roles_table', 3),
('2013_07_23_133524_create_users_table', 4),
('2013_07_23_140415_create_profiles_table', 5),
('2013_07_24_100819_create_password_reminders_table', 6),
('2013_07_24_132113_create_groups_table', 7),
('2013_07_24_142918_create_divisions_table', 8),
('2013_07_24_152726_create_division_group_table', 9),
('2013_07_25_125157_create_functions_table', 10),
('2013_07_25_125729_create_jobs_table', 11),
('2013_07_25_130324_create_job_user_table', 12),
('2013_07_25_140754_create_adresses_table', 13),
('2013_07_25_142311_create_locations_table', 14),
('2013_07_25_143545_create_group_location_table', 15),
('2013_07_25_150542_create_subgroups_table', 16),
('2013_07_26_085923_create_divisions_table', 17),
('2013_07_26_090138_create_divisioninfos_table', 17),
('2013_07_26_091333_create_groups_table', 18),
('2013_07_29_092913_create_division_location_table', 19),
('2013_07_29_102831_create_sectors_table', 20),
('2013_07_29_144450_create_group_sector_table', 21),
('2013_07_31_093625_create_users_table', 22),
('2013_07_31_094034_create_divisioninfos_table', 22),
('2013_07_31_094226_create_divisions_table', 22),
('2013_07_31_094325_create_groups_table', 22),
('2013_07_31_094631_create_locations_table', 22),
('2013_07_31_094526_create_sectors_table', 23),
('2013_08_05_131902_create_projects_table', 24),
('2013_08_07_133814_create_project_user_table', 25),
('2013_08_12_092051_create_medias_table', 26),
('2013_08_12_092845_create_documents_table', 27),
('2013_08_12_094559_create_versions_table', 28),
('2013_08_13_131749_create_document_project_table', 29),
('2013_08_14_095226_create_folders_table', 30),
('2013_08_19_093345_create_actions_table', 31),
('2013_08_19_095254_create_action_user_table', 32),
('2013_08_20_115908_create_pages_table', 33),
('2013_08_22_154640_create_document_user_table', 34),
('2013_08_30_103132_create_comments_table', 35),
('2013_08_30_154643_create_notifications_table', 36),
('2013_08_30_155928_create_notification_user_table', 36),
('2013_09_04_094737_create_options_table', 37),
('2013_09_04_105802_create_discussions_table', 38);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trigger_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `notifications`
--

INSERT INTO `notifications` (`id`, `trigger_id`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 24, 'discussion', '2013-09-12 08:56:50', '2013-09-12 08:56:50', NULL),
(2, 24, 'comment_admin', '2013-09-12 09:07:54', '2013-09-12 09:07:54', NULL),
(3, 25, 'discussion', '2013-09-12 13:06:17', '2013-09-12 13:06:17', NULL),
(4, 25, 'comment_admin', '2013-09-12 13:59:43', '2013-09-12 13:59:43', NULL),
(5, 26, 'discussion', '2013-10-03 12:35:53', '2013-10-03 12:35:53', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `notification_user`
--

CREATE TABLE IF NOT EXISTS `notification_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `checked` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Contenu de la table `notification_user`
--

INSERT INTO `notification_user` (`id`, `notification_id`, `user_id`, `checked`, `created_at`, `updated_at`) VALUES
(1, 1, 22, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 23, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 2, 23, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 3, 22, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 3, 23, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 4, 23, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 5, 22, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 5, 23, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Extranet Wharf',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `options`
--

INSERT INTO `options` (`id`, `site_title`, `created_at`, `updated_at`) VALUES
(1, 'Extranet Wharf', '0000-00-00 00:00:00', '2013-09-04 10:42:44');

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Contenu de la table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hello world', 'hello-world', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac scelerisque dui. Ut mattis lacus vitae rhoncus fermentum. Vivamus nunc velit, tincidunt quis nulla ornare, lacinia gravida neque. Mauris semper eros ac libero cursus, et rutrum diam ornare. Quisque ac lacus lacinia, consectetur ipsum sed, aliquam dui. Cras scelerisque interdum mauris commodo aliquet. Cras eros mi, aliquam nec sem a, viverra porttitor arcu.<div><br><div><img src="http://www.sci-sebastien.com/location-canet-plage/images/Canet-plage.jpg" style="width: 579.8037735849057px; height: 264px;"><br></div></div>', '2013-08-20 12:20:36', '2013-08-21 13:48:41', '2013-08-21 13:48:41'),
(2, 'Informations complémentaires', 'informations-complementaires', '<p>Voici le contenu</p>', '2013-08-20 13:06:03', '2013-08-21 13:25:18', '2013-08-21 13:25:18'),
(13, 'Informations', 'informations', '<p>Voici la page infos</p>', '2013-09-05 12:28:54', '2013-09-05 12:28:54', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `password_reminders`
--

CREATE TABLE IF NOT EXISTS `password_reminders` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Contenu de la table `profiles`
--

INSERT INTO `profiles` (`id`, `firstname`, `lastname`, `website`, `description`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Rémi', 'Rollet', '', '', 1, '0000-00-00 00:00:00', '2013-09-11 14:23:30'),
(2, 'Ffd', 'Ffdfd', '', '', 8, '2013-07-30 13:35:39', '2013-07-30 13:35:39'),
(3, 'Sdsd', 'Sdsds', '', '', 9, '2013-07-31 06:53:30', '2013-07-31 06:53:30'),
(4, 'Rémi', 'Rollet', '', '', 10, '2013-07-31 07:27:12', '2013-07-31 07:27:12'),
(6, 'Dfdfd', 'Fdfdfd', '', '', 2, '2013-07-31 08:27:04', '2013-07-31 08:27:04'),
(7, 'Tyt', 'Ytytyt', '', '', 3, '2013-07-31 08:30:41', '2013-07-31 08:30:41'),
(8, 'Tttt', 'Trttt', '', '', 4, '2013-07-31 09:16:59', '2013-07-31 09:16:59'),
(9, 'Ytyt', 'Ytyty', '', '', 5, '2013-07-31 09:31:28', '2013-07-31 09:31:28'),
(10, 'Test', 'Dfdf', '', '', 6, '2013-07-31 10:49:04', '2013-07-31 10:49:04'),
(11, 'yyyyff', 'Ioioi', '', '', 7, '2013-07-31 11:54:12', '2013-07-31 11:57:20'),
(12, 'Gfgf', 'Gfgfg', '', '', 8, '2013-07-31 12:08:32', '2013-07-31 12:08:32'),
(13, 'Fggfg', 'Fgfgf', '', '', 9, '2013-07-31 12:10:14', '2013-07-31 12:10:14'),
(14, 'Ddddd', 'Ddddd', '', '', 12, '2013-08-01 06:11:42', '2013-08-01 06:11:42'),
(15, 'Rrrr', 'Rrrrr', '', '', 14, '2013-08-01 06:17:48', '2013-08-01 06:17:48'),
(16, 'Ytytyt', 'Tyytyt', '', '', 15, '2013-08-01 07:34:12', '2013-08-01 07:34:12'),
(17, 'Erer', 'Erre', '', '', 16, '2013-08-01 08:05:13', '2013-08-01 08:05:13'),
(18, 'Florence', 'Claret', '', '', 17, '2013-08-02 12:04:54', '2013-08-02 12:04:54'),
(19, 'Eree', 'Ere', '', '', 18, '2013-08-05 08:41:01', '2013-08-05 08:41:01'),
(20, 'Ttt', 'Ttttt', '', '', 19, '2013-08-07 12:12:30', '2013-08-07 12:12:30'),
(21, 'Marc', 'Test', '', '', 20, '2013-08-07 12:15:21', '2013-08-07 12:15:21'),
(22, 'Antone', 'Svels', '', '', 21, '2013-08-08 07:09:18', '2013-08-19 14:56:36'),
(23, 'Marc', 'Test', '', '', 22, '2013-08-08 07:57:15', '2013-08-08 07:57:15'),
(24, 'Wharf', 'Sss', '', '', 23, '2013-08-09 07:18:18', '2013-08-09 07:18:18'),
(25, 'Rrr', 'Rrr', '', '', 24, '2013-08-09 12:34:54', '2013-08-09 12:34:54'),
(26, 'Fdfdfd', 'Fdfdf', '', '', 25, '2013-08-09 12:35:23', '2013-08-09 12:35:23'),
(27, 'Marc', 'Ddddd', '', '', 26, '2013-08-20 09:44:17', '2013-08-20 09:44:17'),
(28, 'Redd', 'Dedee', '', '', 27, '2013-08-21 15:45:34', '2013-08-21 15:45:34'),
(29, 'Aaa', 'Aaaa', '', '', 23, '2013-08-28 09:38:10', '2013-08-28 09:38:10'),
(30, 'Ahek', 'Heheh', '', '', 24, '2013-08-28 09:52:50', '2013-08-28 09:52:50'),
(31, 'Rrererer', 'Ererreerrrer', '', '', 25, '2013-10-07 07:52:39', '2013-10-07 07:52:39'),
(32, 'Fdfdfdf', 'Dfdfdfdf', '', '', 26, '2013-10-07 07:54:39', '2013-10-07 07:54:39');

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mission` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Contenu de la table `projects`
--

INSERT INTO `projects` (`id`, `mission`, `user_id`, `group_id`, `division_id`, `created_at`, `updated_at`, `deleted_at`, `name`, `accepted`) VALUES
(6, 'Réalisation d''un extranet client pour Wharf', 1, 13, 0, '2013-08-09 06:29:58', '2013-08-27 08:56:51', NULL, 'Extranet client', 1),
(9, 'gfgfg', 0, 13, 0, '2013-08-12 07:00:34', '2013-08-12 07:05:12', '2013-08-12 07:05:12', 'Gfgfgfg', 0),
(10, 'Voici la mission', 24, 15, 0, '2013-08-13 06:25:30', '2013-08-13 07:32:56', '2013-08-13 07:32:56', 'Test de projet', 1),
(11, 'uyuyu', 0, 14, 0, '2013-08-27 14:46:21', '2013-08-27 14:46:21', NULL, 'Yuyuy', 1),
(12, '', 0, 14, 0, '2013-08-27 14:46:29', '2013-08-27 14:46:29', NULL, 'Adad', 1),
(13, 'dsdsdss', 0, 13, 0, '2013-08-28 09:15:27', '2013-08-28 09:15:27', NULL, 'Test', 1),
(14, 'tets de ùmission', 0, 15, 0, '2013-08-28 09:52:23', '2013-09-06 10:15:23', '2013-09-06 10:15:23', 'Hello world', 1),
(15, '', 1, 14, 0, '2013-08-29 14:11:27', '2013-08-29 14:11:27', NULL, 'Eeee', 1),
(16, 'sqsqsqsqsqs', 0, 15, 0, '2013-10-07 08:24:48', '2013-10-07 08:24:48', NULL, 'Qsqsqssqq', 1);

-- --------------------------------------------------------

--
-- Structure de la table `project_user`
--

CREATE TABLE IF NOT EXISTS `project_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Contenu de la table `project_user`
--

INSERT INTO `project_user` (`id`, `project_id`, `user_id`) VALUES
(1, 6, 1),
(2, 6, 22),
(3, 13, 1),
(4, 14, 1),
(5, 11, 1),
(6, 11, 23),
(7, 13, 22),
(8, 6, 23),
(9, 12, 1),
(10, 12, 23),
(11, 15, 23),
(12, 15, 1),
(13, 15, 26),
(14, 16, 23),
(15, 16, 1),
(16, 16, 24);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'client', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `sectors`
--

CREATE TABLE IF NOT EXISTS `sectors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `sectors`
--

INSERT INTO `sectors` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Transports', '2013-08-26 12:57:01', '2013-08-26 12:57:01', NULL),
(2, 'Médias', '2013-08-26 12:57:09', '2013-08-26 12:57:09', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(320) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role_id`, `group_id`, `division_id`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'wharfremi@gmail.com', '$2y$08$hdrs5V1Kh2T9UmleOqP8DelwIjem.tsoGLtOpVs5VgFclTmoT1N1a', 2, 13, 0, 1, '2013-07-31 08:05:23', '2013-09-11 14:23:30', NULL),
(22, 'client', 'marc@marc.fr', '$2y$08$2joWq.JNmK4Ws73MCPa7Zet1cA3oQ521dAukK81UjBNxNhGFkFBia', 1, 13, 8, 1, '2013-08-08 07:57:15', '2013-08-22 10:00:48', NULL),
(23, 'bbdccb', 'aaaa@aaa.fr', '$2y$08$0JCWzItInXQseYvXs80FcuOCkGtp.AmhjZm9O15pDSCSmVcU0kbY2', 2, 15, 0, 1, '2013-08-28 09:38:09', '2013-08-28 09:38:09', NULL),
(24, '58e17f', 'zhhz@fdjd.fr', '$2y$08$RdeMi7kWebVmNHwZ2NyGW.d1w/arfJuzygLGKHK9dM1n.j7vEW9A.', 1, 15, 0, 1, '2013-08-28 09:52:50', '2013-08-28 09:52:50', NULL),
(25, '5e5eee', 'reererer@ffdfd.fr', '$2y$08$Gg5ThLvvu5xxb6TRc9BzPuK.psXQcV18R2SY5vS9UX5OBE6OpEY3O', 1, 13, 1, 1, '2013-10-07 07:52:38', '2013-10-07 07:52:38', NULL),
(26, '1d8ad5', 'dfdfdf@fhfh.fr', '$2y$08$SYow/uJTLpmwHeHgTMNOb.thxvluhpocLvIxxVhyIEnTcZddFoorG', 1, 14, 0, 1, '2013-10-07 07:54:39', '2013-10-07 07:54:39', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `versions`
--

CREATE TABLE IF NOT EXISTS `versions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `versions`
--

INSERT INTO `versions` (`id`, `name`, `path`, `size`, `document_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '8fc82a', 'http://localhost/extranet/public/uploads/documents/versions/522edee63d798.jpg', 87, 1, '2013-09-10 08:57:10', '2013-09-10 08:57:10', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
