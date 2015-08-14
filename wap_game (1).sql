-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2015 at 04:21 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wap_game`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
`id_album` int(11) NOT NULL,
  `id_cate` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `banner` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cate`
--

CREATE TABLE IF NOT EXISTS `cate` (
`id_cate` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `alias` varchar(200) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_time` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cate`
--

INSERT INTO `cate` (`id_cate`, `title`, `alias`, `type`, `order`, `update_time`, `create_time`) VALUES
(1, 'Game Hành Động', 'game-hanh-dong', 'game', 100, '2015-07-14 16:23:30', NULL),
(2, 'Game Bắn Súng', 'game-hanh-dongs', 'Game mới', 0, '2015-07-29 12:17:17', '2015-07-15 22:31:46'),
(3, 'Game Viet', NULL, 'Game Hot', NULL, '2015-07-15 15:42:14', '2015-07-15 22:40:35'),
(4, 'Hình Nền Mùa Xuân', 'hinh-nen-mua-xuan', 'Nạp nhiều', NULL, '2015-07-15 16:01:55', '2015-07-15 23:01:55');

-- --------------------------------------------------------

--
-- Table structure for table `comment_app`
--

CREATE TABLE IF NOT EXISTS `comment_app` (
`id_commet` int(11) NOT NULL,
  `id_cate` int(11) DEFAULT NULL,
  `id_title` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `function`
--

CREATE TABLE IF NOT EXISTS `function` (
`id_function` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `name_display` varchar(200) DEFAULT NULL,
  `alias` varchar(45) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `url` text,
  `order` int(11) DEFAULT NULL,
  `is_leaf` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `function`
--

INSERT INTO `function` (`id_function`, `name`, `name_display`, `alias`, `parent_id`, `url`, `order`, `is_leaf`, `create_time`, `update_time`) VALUES
(1, 'add', 'Thêm Menu', 'backend-menu-add', 3, '/backend/menu/add', 1, 1, '2014-08-29 10:10:00', '2014-08-29 10:10:00'),
(2, 'index', 'Danh sách menu', 'backend-menu-index', 3, '/backend/menu/index', 1, 1, '2014-08-29 10:10:00', '2014-08-29 10:10:00'),
(3, 'group', 'Nhóm menu', 'backend-menu-group', 3, '/backend/menu/group', NULL, 1, NULL, NULL),
(4, 'addgroup', 'Thêm nhóm menu', 'backend-menu-addgroup', 3, '/backend/menu/addgroup', NULL, 1, NULL, NULL),
(5, 'index', 'Danh sách User', 'backend-account-index', 2, '/backend/account/index', NULL, 1, NULL, NULL),
(6, 'add', 'Thêm User', 'backend-account-add', 2, '/backend/account/add', NULL, 1, NULL, NULL),
(7, 'index', 'Danh sách bài viết', 'backend-newsevent-index', 4, '/backend/newsevent/index', NULL, 1, NULL, NULL),
(8, 'add', 'Thêm bài viết', 'backend-newsevent-add', 4, '/backend/newsevent/add', NULL, 1, NULL, NULL),
(11, 'index', 'Danh sách game', 'backend-game-index', 1, '/backend/game/index', NULL, 1, NULL, NULL),
(12, 'add', 'Thêm game', 'backend-game-add', 1, '/backend/game/add', NULL, 1, NULL, NULL),
(22, 'platform', 'Platform', 'backend-game-platform', 1, '/backend/game/platform', NULL, 1, '2014-09-23 09:20:29', NULL),
(23, 'add_platform', 'Thêm platform', 'backend-game-add_platform', 1, '/backend/game/add_platform', NULL, 1, '2014-09-23 09:21:18', NULL),
(24, 'index', 'Bài viết', 'backend-article-index', 6, '/backend/article/index', NULL, 1, '2014-09-24 12:11:01', '2014-09-24 13:35:43'),
(25, 'add', 'Thêm bài viết', 'backend-article-add', 6, '/backend/article/add', NULL, 1, '2014-09-24 13:37:30', NULL),
(26, 'groupuser', 'Nhóm user', 'backend-account-groupuser', 2, '/backend/account/groupuser', NULL, 1, '2014-11-07 09:30:47', '2014-11-07 09:33:25'),
(27, 'addgroupuser', 'Thêm nhóm', 'backend-account-addgroupuser', 2, '/backend/account/addgroupuser', NULL, 1, '2014-11-07 09:32:46', NULL),
(38, 'index', 'List Category ', 'backend-category-list_category', 12, '/backend/category/list_category', NULL, 1, '2015-07-13 20:48:39', '2015-07-14 22:58:03'),
(39, 'add', 'ADD Category', 'backend-category-add_list_category', 12, '/backend/category/add_list_category', NULL, 1, '2015-07-13 20:50:03', '2015-07-14 22:45:28'),
(40, 'index', 'List Album', 'backend-picture-list_album', 11, '/backend/picture/list_album', NULL, 1, '2015-07-13 21:01:24', '2015-07-15 23:10:16'),
(41, 'add', 'ADD ALBUM', 'backend-picture-add_album', 11, '/backend/picture/add_album', NULL, 1, '2015-07-13 21:02:15', '2015-07-15 23:10:23');

-- --------------------------------------------------------

--
-- Table structure for table `function_group`
--

CREATE TABLE IF NOT EXISTS `function_group` (
`id` int(11) NOT NULL,
  `display_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) DEFAULT '1',
  `class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_display` int(2) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `function_group`
--

INSERT INTO `function_group` (`id`, `display_name`, `order`, `class`, `alias`, `is_display`) VALUES
(1, 'Game App', 0, '', 'game', 1),
(2, 'Quản lý Tài khoản', 6, NULL, 'account', 1),
(3, 'Quản lý Menu', 7, NULL, 'menu', 1),
(11, 'PICTURE, MUSIC', 2, '', 'picture', 1),
(12, 'Category', 0, '', 'category', 1);

-- --------------------------------------------------------

--
-- Table structure for table `game_app`
--

CREATE TABLE IF NOT EXISTS `game_app` (
`id_game_app` int(11) NOT NULL,
  `name` text,
  `code_game` varchar(20) NOT NULL,
  `icon` text,
  `banner` text,
  `description` text,
  `content` text,
  `type` enum('game','app') DEFAULT 'game',
  `count_download` varchar(45) DEFAULT NULL,
  `count_install` varchar(45) DEFAULT NULL,
  `platform` varchar(45) DEFAULT NULL,
  `package_name` text,
  `download_url` text,
  `create_user` varchar(45) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `status` enum('active','block') DEFAULT 'block',
  `order` int(11) DEFAULT NULL,
  `set_new` enum('active','block') DEFAULT 'block',
  `favorite` enum('active','block') DEFAULT 'block',
  `size` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `game_app`
--

INSERT INTO `game_app` (`id_game_app`, `name`, `code_game`, `icon`, `banner`, `description`, `content`, `type`, `count_download`, `count_install`, `platform`, `package_name`, `download_url`, `create_user`, `create_time`, `update_time`, `status`, `order`, `set_new`, `favorite`, `size`) VALUES
(1, 'Iwin', 'iwin', 'assets/images/Icon_iWin.png', NULL, 'Thông ti  game hot nhất thị trường', '<p>Get ready to soil your plants as a mob of fun-loving zombies is about to invade your home. Use your arsenal of 49 zombie-zapping plants &mdash; peashooters, wall-nuts, cherry bombs and more &mdash; to mulchify 26 types of zombies before they break down your door. This app offers in-app purchases. You may disable in-app purchasing using your device settings</p>\r\n\r\n                                <p>WINNER OF OVER 30 GAME OF THE YEAR AWARDS* 50 FUN-DEAD LEVELS</p>\r\n\r\n                                <p>Conquer all 50 levels of Adventure mode &mdash; through day, night, fog, in a swimming pool, on the rooftop and more. Plus fend off a continual wave of zombies as long as you can with Survival mode! NOT GARDEN-VARIETY GHOULS Battle zombie pole-vaulters, snorkelers, bucketheads and 26 more fun-dead zombies. Each has its own special skills, so you&#39;ll need to think fast and plant faster to combat them all. SMARTER THAN YOUR AVERAGE ZOMBIE Be careful how you use your limited supply of greens and seeds. Zombies love brains so much they&#39;ll jump, run, dance, swim and even eat plants to get into your house. Open the Almanac to learn more about all the zombies and plants to help plan your strategy. FIGHT LONGER, GET STRONGER Earn 49 powerful perennials as you progress and collect coins to buy a pet snail, power-ups and more. GROW WITH YOUR GAME Show off your zombie-zapping prowess by earning 46 awesome achievements and show off your zombie-zapping prowess. COIN PACKS Need coins for great new stuff? Buy up to 600,000 coins right from the Main Menu. *Original Mac/PC downloadable game. Be the first to know! Get inside EA info on great deals, plus the latest game updates, tips &amp; more&hellip;</p>\r\n\r\n                                <p>VISIT US: eamobile.com FOLLOW US: twitter.com/eamobile</p>\r\n\r\n                                <p>LIKE US: facebook.com/eamobile</p>\r\n\r\n                                <p>WATCH US: youtube.com/eamobilegames</p>\r\n\r\n                                <p>Terms of Service : http://www.ea.com/terms-of-service</p>\r\n\r\n                                <p>Privacy and Cookie Policy: http://www.ea.com/privacy-policy</p>\r\n\r\n                                <p>Game EULA: http://tos.ea.com/legalapp/mobileeula/US/en/GM/</p>\r\n\r\n                                <p>Visit https://help.ea.com/ for assistance or inquiries.</p>\r\n\r\n                                <p>EA may retire online features and services after 30 days&rsquo; notice posted on www.ea.com/1/service-updates. Important Consumer Information. This app contains direct links to the Internet</p>\r\n                                <p>&nbsp;</p>\r\n\r\n                                <p>TH&Ocirc;NG TIN</p>\r\n                                <hr />\r\n                                <br/>\r\n                                <p>Updated &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;2015-07-16 09:31:41</p>\r\n\r\n                                <p>Version &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 2.1</p>\r\n\r\n                                <p>Developer &nbsp; &nbsp; &nbsp;Snail Games USA</p>\r\n\r\n                                <p>Compatbility &nbsp;Android 2.3+</p>\r\n\r\n                                <p>Category &nbsp; &nbsp; &nbsp; &nbsp;Role Playing</p>\r\n\r\n                                <p>Source &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Google Play</p>', 'game', '3', '5', '["android","ios","wp"]', '{"android":"vn.iwin.all","ios":"vn.mecorp.iwin","wp":"abc"}', '{"android":"https:\\/\\/play.google.com\\/store\\/apps\\/details?id=iwin.vn.full","ios":"https:\\/\\/itunes.apple.com\\/vn\\/app\\/iwinonline\\/id625304386?mt=8","wp":"https:\\/\\/www.windowsphone.com\\/vi-vn\\/store\\/app\\/iwin-vn\\/4f8f3322-5df1-4de2-97a4-1dfd0cdd8c8f"}', 'duocnt', '2015-05-25 11:03:24', '2015-06-19 16:46:07', 'active', NULL, 'active', 'active', 154),
(2, 'Thiên Thần Truyện', '3t', 'assets/images/Icon_3T.png', NULL, 'Thông ti  game hot nhất thị trường', '<p>Get ready to soil your plants as a mob of fun-loving zombies is about to invade your home. Use your arsenal of 49 zombie-zapping plants &mdash; peashooters, wall-nuts, cherry bombs and more &mdash; to mulchify 26 types of zombies before they break down your door. This app offers in-app purchases. You may disable in-app purchasing using your device settings</p>\r\n\r\n                                <p>WINNER OF OVER 30 GAME OF THE YEAR AWARDS* 50 FUN-DEAD LEVELS</p>\r\n\r\n                                <p>Conquer all 50 levels of Adventure mode &mdash; through day, night, fog, in a swimming pool, on the rooftop and more. Plus fend off a continual wave of zombies as long as you can with Survival mode! NOT GARDEN-VARIETY GHOULS Battle zombie pole-vaulters, snorkelers, bucketheads and 26 more fun-dead zombies. Each has its own special skills, so you&#39;ll need to think fast and plant faster to combat them all. SMARTER THAN YOUR AVERAGE ZOMBIE Be careful how you use your limited supply of greens and seeds. Zombies love brains so much they&#39;ll jump, run, dance, swim and even eat plants to get into your house. Open the Almanac to learn more about all the zombies and plants to help plan your strategy. FIGHT LONGER, GET STRONGER Earn 49 powerful perennials as you progress and collect coins to buy a pet snail, power-ups and more. GROW WITH YOUR GAME Show off your zombie-zapping prowess by earning 46 awesome achievements and show off your zombie-zapping prowess. COIN PACKS Need coins for great new stuff? Buy up to 600,000 coins right from the Main Menu. *Original Mac/PC downloadable game. Be the first to know! Get inside EA info on great deals, plus the latest game updates, tips &amp; more&hellip;</p>\r\n\r\n                                <p>VISIT US: eamobile.com FOLLOW US: twitter.com/eamobile</p>\r\n\r\n                                <p>LIKE US: facebook.com/eamobile</p>\r\n\r\n                                <p>WATCH US: youtube.com/eamobilegames</p>\r\n\r\n                                <p>Terms of Service : http://www.ea.com/terms-of-service</p>\r\n\r\n                                <p>Privacy and Cookie Policy: http://www.ea.com/privacy-policy</p>\r\n\r\n                                <p>Game EULA: http://tos.ea.com/legalapp/mobileeula/US/en/GM/</p>\r\n\r\n                                <p>Visit https://help.ea.com/ for assistance or inquiries.</p>\r\n\r\n                                <p>EA may retire online features and services after 30 days&rsquo; notice posted on www.ea.com/1/service-updates. Important Consumer Information. This app contains direct links to the Internet</p>\r\n                                <p>&nbsp;</p>\r\n\r\n                                <p>TH&Ocirc;NG TIN</p>\r\n                                <hr />\r\n                                <br/>\r\n                                <p>Updated &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;2015-07-16 09:31:41</p>\r\n\r\n                                <p>Version &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 2.1</p>\r\n\r\n                                <p>Developer &nbsp; &nbsp; &nbsp;Snail Games USA</p>\r\n\r\n                                <p>Compatbility &nbsp;Android 2.3+</p>\r\n\r\n                                <p>Category &nbsp; &nbsp; &nbsp; &nbsp;Role Playing</p>\r\n\r\n                                <p>Source &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Google Play</p>', 'game', '5', '10', '["android","ios"]', '{"android":"vn.thienthan.thor","ios":"vn.thienthan.thor"}', '{"android":"https:\\/\\/play.google.com\\/store\\/apps\\/details?id=vn.thienthan.thor","ios":"https:\\/\\/itunes.apple.com\\/us\\/app\\/thien-than-truyen\\/id730234659?mt=8"}', 'duocnt', '2015-05-25 11:07:24', '2015-06-19 16:46:05', 'active', NULL, 'active', 'active', 787),
(3, 'Mộng Giang Hồ', 'mgh', 'assets/images/Icon_MGH_3%20copy.PNG', NULL, 'Thông ti  game hot nhất thị trường', '<p>Get ready to soil your plants as a mob of fun-loving zombies is about to invade your home. Use your arsenal of 49 zombie-zapping plants &mdash; peashooters, wall-nuts, cherry bombs and more &mdash; to mulchify 26 types of zombies before they break down your door. This app offers in-app purchases. You may disable in-app purchasing using your device settings</p>\r\n\r\n                                <p>WINNER OF OVER 30 GAME OF THE YEAR AWARDS* 50 FUN-DEAD LEVELS</p>\r\n\r\n                                <p>Conquer all 50 levels of Adventure mode &mdash; through day, night, fog, in a swimming pool, on the rooftop and more. Plus fend off a continual wave of zombies as long as you can with Survival mode! NOT GARDEN-VARIETY GHOULS Battle zombie pole-vaulters, snorkelers, bucketheads and 26 more fun-dead zombies. Each has its own special skills, so you&#39;ll need to think fast and plant faster to combat them all. SMARTER THAN YOUR AVERAGE ZOMBIE Be careful how you use your limited supply of greens and seeds. Zombies love brains so much they&#39;ll jump, run, dance, swim and even eat plants to get into your house. Open the Almanac to learn more about all the zombies and plants to help plan your strategy. FIGHT LONGER, GET STRONGER Earn 49 powerful perennials as you progress and collect coins to buy a pet snail, power-ups and more. GROW WITH YOUR GAME Show off your zombie-zapping prowess by earning 46 awesome achievements and show off your zombie-zapping prowess. COIN PACKS Need coins for great new stuff? Buy up to 600,000 coins right from the Main Menu. *Original Mac/PC downloadable game. Be the first to know! Get inside EA info on great deals, plus the latest game updates, tips &amp; more&hellip;</p>\r\n\r\n                                <p>VISIT US: eamobile.com FOLLOW US: twitter.com/eamobile</p>\r\n\r\n                                <p>LIKE US: facebook.com/eamobile</p>\r\n\r\n                                <p>WATCH US: youtube.com/eamobilegames</p>\r\n\r\n                                <p>Terms of Service : http://www.ea.com/terms-of-service</p>\r\n\r\n                                <p>Privacy and Cookie Policy: http://www.ea.com/privacy-policy</p>\r\n\r\n                                <p>Game EULA: http://tos.ea.com/legalapp/mobileeula/US/en/GM/</p>\r\n\r\n                                <p>Visit https://help.ea.com/ for assistance or inquiries.</p>\r\n\r\n                                <p>EA may retire online features and services after 30 days&rsquo; notice posted on www.ea.com/1/service-updates. Important Consumer Information. This app contains direct links to the Internet</p>\r\n                                <p>&nbsp;</p>\r\n\r\n                                <p>TH&Ocirc;NG TIN</p>\r\n                                <hr />\r\n                                <br/>\r\n                                <p>Updated &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;2015-07-16 09:31:41</p>\r\n\r\n                                <p>Version &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 2.1</p>\r\n\r\n                                <p>Developer &nbsp; &nbsp; &nbsp;Snail Games USA</p>\r\n\r\n                                <p>Compatbility &nbsp;Android 2.3+</p>\r\n\r\n                                <p>Category &nbsp; &nbsp; &nbsp; &nbsp;Role Playing</p>\r\n\r\n                                <p>Source &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Google Play</p>', 'game', '7', '14', '["android","ios","wp"]', '{"android":"vn.thienthan.thor","ios":"vn.thienthan.thor"}', '{"android":"https:\\/\\/play.google.com\\/store\\/apps\\/details?id=monggiangho.vn.game.mobo","ios":"https:\\/\\/itunes.apple.com\\/US\\/app\\/id964783889?mt=8","wp":"https:\\/\\/www.windowsphone.com\\/en-us\\/store\\/app\\/m%E1%BB%99ng-giang-h%E1%BB%93\\/09e284c7-8324-4617-976e-1e9176958013"}', 'duocnt', '2015-05-25 11:18:20', '2015-06-19 16:46:04', 'active', NULL, 'active', 'active', 140),
(4, 'Mộng Giang Hồ', 'mgh4', 'assets/images/Icon_MGH_3%20copy.PNG', NULL, 'Thông ti  game hot nhất thị trường', '<p>Get ready to soil your plants as a mob of fun-loving zombies is about to invade your home. Use your arsenal of 49 zombie-zapping plants &mdash; peashooters, wall-nuts, cherry bombs and more &mdash; to mulchify 26 types of zombies before they break down your door. This app offers in-app purchases. You may disable in-app purchasing using your device settings</p>\r\n\r\n                                <p>WINNER OF OVER 30 GAME OF THE YEAR AWARDS* 50 FUN-DEAD LEVELS</p>\r\n\r\n                                <p>Conquer all 50 levels of Adventure mode &mdash; through day, night, fog, in a swimming pool, on the rooftop and more. Plus fend off a continual wave of zombies as long as you can with Survival mode! NOT GARDEN-VARIETY GHOULS Battle zombie pole-vaulters, snorkelers, bucketheads and 26 more fun-dead zombies. Each has its own special skills, so you&#39;ll need to think fast and plant faster to combat them all. SMARTER THAN YOUR AVERAGE ZOMBIE Be careful how you use your limited supply of greens and seeds. Zombies love brains so much they&#39;ll jump, run, dance, swim and even eat plants to get into your house. Open the Almanac to learn more about all the zombies and plants to help plan your strategy. FIGHT LONGER, GET STRONGER Earn 49 powerful perennials as you progress and collect coins to buy a pet snail, power-ups and more. GROW WITH YOUR GAME Show off your zombie-zapping prowess by earning 46 awesome achievements and show off your zombie-zapping prowess. COIN PACKS Need coins for great new stuff? Buy up to 600,000 coins right from the Main Menu. *Original Mac/PC downloadable game. Be the first to know! Get inside EA info on great deals, plus the latest game updates, tips &amp; more&hellip;</p>\r\n\r\n                                <p>VISIT US: eamobile.com FOLLOW US: twitter.com/eamobile</p>\r\n\r\n                                <p>LIKE US: facebook.com/eamobile</p>\r\n\r\n                                <p>WATCH US: youtube.com/eamobilegames</p>\r\n\r\n                                <p>Terms of Service : http://www.ea.com/terms-of-service</p>\r\n\r\n                                <p>Privacy and Cookie Policy: http://www.ea.com/privacy-policy</p>\r\n\r\n                                <p>Game EULA: http://tos.ea.com/legalapp/mobileeula/US/en/GM/</p>\r\n\r\n                                <p>Visit https://help.ea.com/ for assistance or inquiries.</p>\r\n\r\n                                <p>EA may retire online features and services after 30 days&rsquo; notice posted on www.ea.com/1/service-updates. Important Consumer Information. This app contains direct links to the Internet</p>\r\n                                <p>&nbsp;</p>\r\n\r\n                                <p>TH&Ocirc;NG TIN</p>\r\n                                <hr />\r\n                                <br/>\r\n                                <p>Updated &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;2015-07-16 09:31:41</p>\r\n\r\n                                <p>Version &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 2.1</p>\r\n\r\n                                <p>Developer &nbsp; &nbsp; &nbsp;Snail Games USA</p>\r\n\r\n                                <p>Compatbility &nbsp;Android 2.3+</p>\r\n\r\n                                <p>Category &nbsp; &nbsp; &nbsp; &nbsp;Role Playing</p>\r\n\r\n                                <p>Source &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Google Play</p>', 'game', '7', '14', '["android","ios","wp"]', '{"android":"vn.thienthan.thor","ios":"vn.thienthan.thor"}', '{"android":"https:\\/\\/play.google.com\\/store\\/apps\\/details?id=monggiangho.vn.game.mobo","ios":"https:\\/\\/itunes.apple.com\\/US\\/app\\/id964783889?mt=8","wp":"https:\\/\\/www.windowsphone.com\\/en-us\\/store\\/app\\/m%E1%BB%99ng-giang-h%E1%BB%93\\/09e284c7-8324-4617-976e-1e9176958013"}', 'duocnt', '2015-05-25 11:18:20', '2015-06-19 16:46:04', 'active', NULL, 'active', 'active', 49),
(5, 'Iwin', 'iwin5', 'assets/images/Icon_iWin.png', NULL, 'Thông ti  game hot nhất thị trường', '<p>Get ready to soil your plants as a mob of fun-loving zombies is about to invade your home. Use your arsenal of 49 zombie-zapping plants &mdash; peashooters, wall-nuts, cherry bombs and more &mdash; to mulchify 26 types of zombies before they break down your door. This app offers in-app purchases. You may disable in-app purchasing using your device settings</p>\r\n\r\n                                <p>WINNER OF OVER 30 GAME OF THE YEAR AWARDS* 50 FUN-DEAD LEVELS</p>\r\n\r\n                                <p>Conquer all 50 levels of Adventure mode &mdash; through day, night, fog, in a swimming pool, on the rooftop and more. Plus fend off a continual wave of zombies as long as you can with Survival mode! NOT GARDEN-VARIETY GHOULS Battle zombie pole-vaulters, snorkelers, bucketheads and 26 more fun-dead zombies. Each has its own special skills, so you&#39;ll need to think fast and plant faster to combat them all. SMARTER THAN YOUR AVERAGE ZOMBIE Be careful how you use your limited supply of greens and seeds. Zombies love brains so much they&#39;ll jump, run, dance, swim and even eat plants to get into your house. Open the Almanac to learn more about all the zombies and plants to help plan your strategy. FIGHT LONGER, GET STRONGER Earn 49 powerful perennials as you progress and collect coins to buy a pet snail, power-ups and more. GROW WITH YOUR GAME Show off your zombie-zapping prowess by earning 46 awesome achievements and show off your zombie-zapping prowess. COIN PACKS Need coins for great new stuff? Buy up to 600,000 coins right from the Main Menu. *Original Mac/PC downloadable game. Be the first to know! Get inside EA info on great deals, plus the latest game updates, tips &amp; more&hellip;</p>\r\n\r\n                                <p>VISIT US: eamobile.com FOLLOW US: twitter.com/eamobile</p>\r\n\r\n                                <p>LIKE US: facebook.com/eamobile</p>\r\n\r\n                                <p>WATCH US: youtube.com/eamobilegames</p>\r\n\r\n                                <p>Terms of Service : http://www.ea.com/terms-of-service</p>\r\n\r\n                                <p>Privacy and Cookie Policy: http://www.ea.com/privacy-policy</p>\r\n\r\n                                <p>Game EULA: http://tos.ea.com/legalapp/mobileeula/US/en/GM/</p>\r\n\r\n                                <p>Visit https://help.ea.com/ for assistance or inquiries.</p>\r\n\r\n                                <p>EA may retire online features and services after 30 days&rsquo; notice posted on www.ea.com/1/service-updates. Important Consumer Information. This app contains direct links to the Internet</p>\r\n                                <p>&nbsp;</p>\r\n\r\n                                <p>TH&Ocirc;NG TIN</p>\r\n                                <hr />\r\n                                <br/>\r\n                                <p>Updated &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;2015-07-16 09:31:41</p>\r\n\r\n                                <p>Version &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 2.1</p>\r\n\r\n                                <p>Developer &nbsp; &nbsp; &nbsp;Snail Games USA</p>\r\n\r\n                                <p>Compatbility &nbsp;Android 2.3+</p>\r\n\r\n                                <p>Category &nbsp; &nbsp; &nbsp; &nbsp;Role Playing</p>\r\n\r\n                                <p>Source &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Google Play</p>', 'game', '3', '5', '["android","ios","wp"]', '{"android":"vn.iwin.all","ios":"vn.mecorp.iwin","wp":"abc"}', '{"android":"https:\\/\\/play.google.com\\/store\\/apps\\/details?id=iwin.vn.full","ios":"https:\\/\\/itunes.apple.com\\/vn\\/app\\/iwinonline\\/id625304386?mt=8","wp":"https:\\/\\/www.windowsphone.com\\/vi-vn\\/store\\/app\\/iwin-vn\\/4f8f3322-5df1-4de2-97a4-1dfd0cdd8c8f"}', 'duocnt', '2015-05-25 11:03:24', '2015-06-19 16:46:03', 'active', NULL, 'active', 'active', 163),
(6, 'Thiên Thần Truyện', '3t6', 'assets/images/Icon_3T.png', NULL, 'Thông ti  game hot nhất thị trường', '<p>Get ready to soil your plants as a mob of fun-loving zombies is about to invade your home. Use your arsenal of 49 zombie-zapping plants &mdash; peashooters, wall-nuts, cherry bombs and more &mdash; to mulchify 26 types of zombies before they break down your door. This app offers in-app purchases. You may disable in-app purchasing using your device settings</p>\r\n\r\n                                <p>WINNER OF OVER 30 GAME OF THE YEAR AWARDS* 50 FUN-DEAD LEVELS</p>\r\n\r\n                                <p>Conquer all 50 levels of Adventure mode &mdash; through day, night, fog, in a swimming pool, on the rooftop and more. Plus fend off a continual wave of zombies as long as you can with Survival mode! NOT GARDEN-VARIETY GHOULS Battle zombie pole-vaulters, snorkelers, bucketheads and 26 more fun-dead zombies. Each has its own special skills, so you&#39;ll need to think fast and plant faster to combat them all. SMARTER THAN YOUR AVERAGE ZOMBIE Be careful how you use your limited supply of greens and seeds. Zombies love brains so much they&#39;ll jump, run, dance, swim and even eat plants to get into your house. Open the Almanac to learn more about all the zombies and plants to help plan your strategy. FIGHT LONGER, GET STRONGER Earn 49 powerful perennials as you progress and collect coins to buy a pet snail, power-ups and more. GROW WITH YOUR GAME Show off your zombie-zapping prowess by earning 46 awesome achievements and show off your zombie-zapping prowess. COIN PACKS Need coins for great new stuff? Buy up to 600,000 coins right from the Main Menu. *Original Mac/PC downloadable game. Be the first to know! Get inside EA info on great deals, plus the latest game updates, tips &amp; more&hellip;</p>\r\n\r\n                                <p>VISIT US: eamobile.com FOLLOW US: twitter.com/eamobile</p>\r\n\r\n                                <p>LIKE US: facebook.com/eamobile</p>\r\n\r\n                                <p>WATCH US: youtube.com/eamobilegames</p>\r\n\r\n                                <p>Terms of Service : http://www.ea.com/terms-of-service</p>\r\n\r\n                                <p>Privacy and Cookie Policy: http://www.ea.com/privacy-policy</p>\r\n\r\n                                <p>Game EULA: http://tos.ea.com/legalapp/mobileeula/US/en/GM/</p>\r\n\r\n                                <p>Visit https://help.ea.com/ for assistance or inquiries.</p>\r\n\r\n                                <p>EA may retire online features and services after 30 days&rsquo; notice posted on www.ea.com/1/service-updates. Important Consumer Information. This app contains direct links to the Internet</p>\r\n                                <p>&nbsp;</p>\r\n\r\n                                <p>TH&Ocirc;NG TIN</p>\r\n                                <hr />\r\n                                <br/>\r\n                                <p>Updated &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;2015-07-16 09:31:41</p>\r\n\r\n                                <p>Version &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 2.1</p>\r\n\r\n                                <p>Developer &nbsp; &nbsp; &nbsp;Snail Games USA</p>\r\n\r\n                                <p>Compatbility &nbsp;Android 2.3+</p>\r\n\r\n                                <p>Category &nbsp; &nbsp; &nbsp; &nbsp;Role Playing</p>\r\n\r\n                                <p>Source &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Google Play</p>', 'game', '5', '10', '["android","ios"]', '{"android":"vn.thienthan.thor","ios":"vn.thienthan.thor"}', '{"android":"https:\\/\\/play.google.com\\/store\\/apps\\/details?id=vn.thienthan.thor","ios":"https:\\/\\/itunes.apple.com\\/us\\/app\\/thien-than-truyen\\/id730234659?mt=8"}', 'duocnt', '2015-05-25 11:07:24', '2015-06-19 16:46:01', 'active', NULL, 'active', 'active', 646),
(7, 'Mộng Giang Hồ', 'mgh7', 'assets/images/Icon_MGH_3%20copy.PNG', NULL, 'Thông ti  game hot nhất thị trường', '<p>Get ready to soil your plants as a mob of fun-loving zombies is about to invade your home. Use your arsenal of 49 zombie-zapping plants &mdash; peashooters, wall-nuts, cherry bombs and more &mdash; to mulchify 26 types of zombies before they break down your door. This app offers in-app purchases. You may disable in-app purchasing using your device settings</p>\r\n\r\n                                <p>WINNER OF OVER 30 GAME OF THE YEAR AWARDS* 50 FUN-DEAD LEVELS</p>\r\n\r\n                                <p>Conquer all 50 levels of Adventure mode &mdash; through day, night, fog, in a swimming pool, on the rooftop and more. Plus fend off a continual wave of zombies as long as you can with Survival mode! NOT GARDEN-VARIETY GHOULS Battle zombie pole-vaulters, snorkelers, bucketheads and 26 more fun-dead zombies. Each has its own special skills, so you&#39;ll need to think fast and plant faster to combat them all. SMARTER THAN YOUR AVERAGE ZOMBIE Be careful how you use your limited supply of greens and seeds. Zombies love brains so much they&#39;ll jump, run, dance, swim and even eat plants to get into your house. Open the Almanac to learn more about all the zombies and plants to help plan your strategy. FIGHT LONGER, GET STRONGER Earn 49 powerful perennials as you progress and collect coins to buy a pet snail, power-ups and more. GROW WITH YOUR GAME Show off your zombie-zapping prowess by earning 46 awesome achievements and show off your zombie-zapping prowess. COIN PACKS Need coins for great new stuff? Buy up to 600,000 coins right from the Main Menu. *Original Mac/PC downloadable game. Be the first to know! Get inside EA info on great deals, plus the latest game updates, tips &amp; more&hellip;</p>\r\n\r\n                                <p>VISIT US: eamobile.com FOLLOW US: twitter.com/eamobile</p>\r\n\r\n                                <p>LIKE US: facebook.com/eamobile</p>\r\n\r\n                                <p>WATCH US: youtube.com/eamobilegames</p>\r\n\r\n                                <p>Terms of Service : http://www.ea.com/terms-of-service</p>\r\n\r\n                                <p>Privacy and Cookie Policy: http://www.ea.com/privacy-policy</p>\r\n\r\n                                <p>Game EULA: http://tos.ea.com/legalapp/mobileeula/US/en/GM/</p>\r\n\r\n                                <p>Visit https://help.ea.com/ for assistance or inquiries.</p>\r\n\r\n                                <p>EA may retire online features and services after 30 days&rsquo; notice posted on www.ea.com/1/service-updates. Important Consumer Information. This app contains direct links to the Internet</p>\r\n                                <p>&nbsp;</p>\r\n\r\n                                <p>TH&Ocirc;NG TIN</p>\r\n                                <hr />\r\n                                <br/>\r\n                                <p>Updated &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;2015-07-16 09:31:41</p>\r\n\r\n                                <p>Version &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 2.1</p>\r\n\r\n                                <p>Developer &nbsp; &nbsp; &nbsp;Snail Games USA</p>\r\n\r\n                                <p>Compatbility &nbsp;Android 2.3+</p>\r\n\r\n                                <p>Category &nbsp; &nbsp; &nbsp; &nbsp;Role Playing</p>\r\n\r\n                                <p>Source &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Google Play</p>', 'game', '7', '14', '["android","ios","wp"]', '{"android":"vn.thienthan.thor","ios":"vn.thienthan.thor"}', '{"android":"https:\\/\\/play.google.com\\/store\\/apps\\/details?id=monggiangho.vn.game.mobo","ios":"https:\\/\\/itunes.apple.com\\/US\\/app\\/id964783889?mt=8","wp":"https:\\/\\/www.windowsphone.com\\/en-us\\/store\\/app\\/m%E1%BB%99ng-giang-h%E1%BB%93\\/09e284c7-8324-4617-976e-1e9176958013"}', 'duocnt', '2015-05-25 11:18:20', '2015-06-19 16:45:59', 'active', NULL, 'active', 'active', 216),
(8, 'Thiên Thần Truyện', '3t8', 'assets/images/Icon_3T.png', NULL, 'Thông ti  game hot nhất thị trường', '<p>Get ready to soil your plants as a mob of fun-loving zombies is about to invade your home. Use your arsenal of 49 zombie-zapping plants &mdash; peashooters, wall-nuts, cherry bombs and more &mdash; to mulchify 26 types of zombies before they break down your door. This app offers in-app purchases. You may disable in-app purchasing using your device settings</p>\r\n\r\n                                <p>WINNER OF OVER 30 GAME OF THE YEAR AWARDS* 50 FUN-DEAD LEVELS</p>\r\n\r\n                                <p>Conquer all 50 levels of Adventure mode &mdash; through day, night, fog, in a swimming pool, on the rooftop and more. Plus fend off a continual wave of zombies as long as you can with Survival mode! NOT GARDEN-VARIETY GHOULS Battle zombie pole-vaulters, snorkelers, bucketheads and 26 more fun-dead zombies. Each has its own special skills, so you&#39;ll need to think fast and plant faster to combat them all. SMARTER THAN YOUR AVERAGE ZOMBIE Be careful how you use your limited supply of greens and seeds. Zombies love brains so much they&#39;ll jump, run, dance, swim and even eat plants to get into your house. Open the Almanac to learn more about all the zombies and plants to help plan your strategy. FIGHT LONGER, GET STRONGER Earn 49 powerful perennials as you progress and collect coins to buy a pet snail, power-ups and more. GROW WITH YOUR GAME Show off your zombie-zapping prowess by earning 46 awesome achievements and show off your zombie-zapping prowess. COIN PACKS Need coins for great new stuff? Buy up to 600,000 coins right from the Main Menu. *Original Mac/PC downloadable game. Be the first to know! Get inside EA info on great deals, plus the latest game updates, tips &amp; more&hellip;</p>\r\n\r\n                                <p>VISIT US: eamobile.com FOLLOW US: twitter.com/eamobile</p>\r\n\r\n                                <p>LIKE US: facebook.com/eamobile</p>\r\n\r\n                                <p>WATCH US: youtube.com/eamobilegames</p>\r\n\r\n                                <p>Terms of Service : http://www.ea.com/terms-of-service</p>\r\n\r\n                                <p>Privacy and Cookie Policy: http://www.ea.com/privacy-policy</p>\r\n\r\n                                <p>Game EULA: http://tos.ea.com/legalapp/mobileeula/US/en/GM/</p>\r\n\r\n                                <p>Visit https://help.ea.com/ for assistance or inquiries.</p>\r\n\r\n                                <p>EA may retire online features and services after 30 days&rsquo; notice posted on www.ea.com/1/service-updates. Important Consumer Information. This app contains direct links to the Internet</p>\r\n                                <p>&nbsp;</p>\r\n\r\n                                <p>TH&Ocirc;NG TIN</p>\r\n                                <hr />\r\n                                <br/>\r\n                                <p>Updated &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;2015-07-16 09:31:41</p>\r\n\r\n                                <p>Version &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 2.1</p>\r\n\r\n                                <p>Developer &nbsp; &nbsp; &nbsp;Snail Games USA</p>\r\n\r\n                                <p>Compatbility &nbsp;Android 2.3+</p>\r\n\r\n                                <p>Category &nbsp; &nbsp; &nbsp; &nbsp;Role Playing</p>\r\n\r\n                                <p>Source &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Google Play</p>', 'game', '5', '10', '["android","ios"]', '{"android":"vn.thienthan.thor","ios":"vn.thienthan.thor"}', '{"android":"https:\\/\\/play.google.com\\/store\\/apps\\/details?id=vn.thienthan.thor","ios":"https:\\/\\/itunes.apple.com\\/us\\/app\\/thien-than-truyen\\/id730234659?mt=8"}', 'duocnt', '2015-05-25 11:07:24', '2015-06-19 16:45:57', 'active', NULL, 'block', 'block', 246),
(9, 'Iwin', 'iwin9', 'assets/images/Icon_iWin.png', 'http://game.mobo.vn/assets/images/games/game47/images/iWin/Screenshot.jpg', 'Thông ti  game hot nhất thị trường', '<p>Get ready to soil your plants as a mob of fun-loving zombies is about to invade your home. Use your arsenal of 49 zombie-zapping plants &mdash; peashooters, wall-nuts, cherry bombs and more &mdash; to mulchify 26 types of zombies before they break down your door. This app offers in-app purchases. You may disable in-app purchasing using your device settings</p>\r\n\r\n                                <p>WINNER OF OVER 30 GAME OF THE YEAR AWARDS* 50 FUN-DEAD LEVELS</p>\r\n\r\n                                <p>Conquer all 50 levels of Adventure mode &mdash; through day, night, fog, in a swimming pool, on the rooftop and more. Plus fend off a continual wave of zombies as long as you can with Survival mode! NOT GARDEN-VARIETY GHOULS Battle zombie pole-vaulters, snorkelers, bucketheads and 26 more fun-dead zombies. Each has its own special skills, so you&#39;ll need to think fast and plant faster to combat them all. SMARTER THAN YOUR AVERAGE ZOMBIE Be careful how you use your limited supply of greens and seeds. Zombies love brains so much they&#39;ll jump, run, dance, swim and even eat plants to get into your house. Open the Almanac to learn more about all the zombies and plants to help plan your strategy. FIGHT LONGER, GET STRONGER Earn 49 powerful perennials as you progress and collect coins to buy a pet snail, power-ups and more. GROW WITH YOUR GAME Show off your zombie-zapping prowess by earning 46 awesome achievements and show off your zombie-zapping prowess. COIN PACKS Need coins for great new stuff? Buy up to 600,000 coins right from the Main Menu. *Original Mac/PC downloadable game. Be the first to know! Get inside EA info on great deals, plus the latest game updates, tips &amp; more&hellip;</p>\r\n\r\n                                <p>VISIT US: eamobile.com FOLLOW US: twitter.com/eamobile</p>\r\n\r\n                                <p>LIKE US: facebook.com/eamobile</p>\r\n\r\n                                <p>WATCH US: youtube.com/eamobilegames</p>\r\n\r\n                                <p>Terms of Service : http://www.ea.com/terms-of-service</p>\r\n\r\n                                <p>Privacy and Cookie Policy: http://www.ea.com/privacy-policy</p>\r\n\r\n                                <p>Game EULA: http://tos.ea.com/legalapp/mobileeula/US/en/GM/</p>\r\n\r\n                                <p>Visit https://help.ea.com/ for assistance or inquiries.</p>\r\n\r\n                                <p>EA may retire online features and services after 30 days&rsquo; notice posted on www.ea.com/1/service-updates. Important Consumer Information. This app contains direct links to the Internet</p>\r\n                                <p>&nbsp;</p>\r\n\r\n                                <p>TH&Ocirc;NG TIN</p>\r\n                                <hr />\r\n                                <br/>\r\n                                <p>Updated &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;2015-07-16 09:31:41</p>\r\n\r\n                                <p>Version &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 2.1</p>\r\n\r\n                                <p>Developer &nbsp; &nbsp; &nbsp;Snail Games USA</p>\r\n\r\n                                <p>Compatbility &nbsp;Android 2.3+</p>\r\n\r\n                                <p>Category &nbsp; &nbsp; &nbsp; &nbsp;Role Playing</p>\r\n\r\n                                <p>Source &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Google Play</p>', 'game', '3', '5', '["android","ios","wp"]', '{"android":"vn.iwin.all","ios":"vn.mecorp.iwin","wp":"abc"}', '{"android":"https:\\/\\/play.google.com\\/store\\/apps\\/details?id=iwin.vn.full","ios":"https:\\/\\/itunes.apple.com\\/vn\\/app\\/iwinonline\\/id625304386?mt=8","wp":"https:\\/\\/www.windowsphone.com\\/vi-vn\\/store\\/app\\/iwin-vn\\/4f8f3322-5df1-4de2-97a4-1dfd0cdd8c8f"}', 'duocnt', '2015-05-25 11:03:24', '2015-06-19 16:45:55', 'active', NULL, 'active', 'block', 34),
(10, 'Mộng Giang Hồ', 'mgh10', 'assets/images/Icon_MGH_3%20copy.PNG', 'http://mong.mobo.vn/data/banner/519x258.jpg', 'Thông ti  game hot nhất thị trường', '<p>Get ready to soil your plants as a mob of fun-loving zombies is about to invade your home. Use your arsenal of 49 zombie-zapping plants &mdash; peashooters, wall-nuts, cherry bombs and more &mdash; to mulchify 26 types of zombies before they break down your door. This app offers in-app purchases. You may disable in-app purchasing using your device settings</p>\r\n\r\n                                <p>WINNER OF OVER 30 GAME OF THE YEAR AWARDS* 50 FUN-DEAD LEVELS</p>\r\n\r\n                                <p>Conquer all 50 levels of Adventure mode &mdash; through day, night, fog, in a swimming pool, on the rooftop and more. Plus fend off a continual wave of zombies as long as you can with Survival mode! NOT GARDEN-VARIETY GHOULS Battle zombie pole-vaulters, snorkelers, bucketheads and 26 more fun-dead zombies. Each has its own special skills, so you&#39;ll need to think fast and plant faster to combat them all. SMARTER THAN YOUR AVERAGE ZOMBIE Be careful how you use your limited supply of greens and seeds. Zombies love brains so much they&#39;ll jump, run, dance, swim and even eat plants to get into your house. Open the Almanac to learn more about all the zombies and plants to help plan your strategy. FIGHT LONGER, GET STRONGER Earn 49 powerful perennials as you progress and collect coins to buy a pet snail, power-ups and more. GROW WITH YOUR GAME Show off your zombie-zapping prowess by earning 46 awesome achievements and show off your zombie-zapping prowess. COIN PACKS Need coins for great new stuff? Buy up to 600,000 coins right from the Main Menu. *Original Mac/PC downloadable game. Be the first to know! Get inside EA info on great deals, plus the latest game updates, tips &amp; more&hellip;</p>\r\n\r\n                                <p>VISIT US: eamobile.com FOLLOW US: twitter.com/eamobile</p>\r\n\r\n                                <p>LIKE US: facebook.com/eamobile</p>\r\n\r\n                                <p>WATCH US: youtube.com/eamobilegames</p>\r\n\r\n                                <p>Terms of Service : http://www.ea.com/terms-of-service</p>\r\n\r\n                                <p>Privacy and Cookie Policy: http://www.ea.com/privacy-policy</p>\r\n\r\n                                <p>Game EULA: http://tos.ea.com/legalapp/mobileeula/US/en/GM/</p>\r\n\r\n                                <p>Visit https://help.ea.com/ for assistance or inquiries.</p>\r\n\r\n                                <p>EA may retire online features and services after 30 days&rsquo; notice posted on www.ea.com/1/service-updates. Important Consumer Information. This app contains direct links to the Internet</p>\r\n                                <p>&nbsp;</p>\r\n\r\n                                <p>TH&Ocirc;NG TIN</p>\r\n                                <hr />\r\n                                <br/>\r\n                                <p>Updated &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;2015-07-16 09:31:41</p>\r\n\r\n                                <p>Version &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 2.1</p>\r\n\r\n                                <p>Developer &nbsp; &nbsp; &nbsp;Snail Games USA</p>\r\n\r\n                                <p>Compatbility &nbsp;Android 2.3+</p>\r\n\r\n                                <p>Category &nbsp; &nbsp; &nbsp; &nbsp;Role Playing</p>\r\n\r\n                                <p>Source &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Google Play</p>', 'game', '7', '14', '["android","ios","wp"]', '{"android":"vn.thienthan.thor","ios":"vn.thienthan.thor"}', '{"android":"https:\\/\\/play.google.com\\/store\\/apps\\/details?id=monggiangho.vn.game.mobo","ios":"https:\\/\\/itunes.apple.com\\/US\\/app\\/id964783889?mt=8","wp":"https:\\/\\/www.windowsphone.com\\/en-us\\/store\\/app\\/m%E1%BB%99ng-giang-h%E1%BB%93\\/09e284c7-8324-4617-976e-1e9176958013"}', 'duocnt', '2015-05-25 11:18:20', '2015-06-19 16:45:54', 'active', NULL, 'active', 'block', 32),
(11, 'EDEN 3D', 'eden', '/assets/images/902d7e52de52c13f4830f202bb63795e/images/icon_eden_256.png', '', 'Eden 3D – Siêu phẩm game 3D nhập vai hành động siêu thực trên smartphone.', '<p style="text-align:justify">Eden 3D &ndash; Si&ecirc;u phẩm game ARPG 3D si&ecirc;u thực tr&ecirc;n smartphone, thuộc thể loại game nhập vai chiến đấu h&agrave;nh động sử dụng c&ocirc;ng nghệ Unity 3D đa nền tảng với lối chơi tương t&aacute;c độc đ&aacute;o, chạm m&agrave;n h&igrave;nh ra skill, vuốt m&agrave;n h&igrave;nh n&eacute; skill ngay tr&ecirc;n mobile.</p>\r\n\r\n<p style="text-align:center"><img alt="" src="http://mgate.vn/uploads/image/1%285%29.jpg" style="border:none; height:621px; margin:0px; max-width:100%; padding:0px; width:462px" /></p>\r\n\r\n<p style="text-align:justify"><span style="color:rgb(20, 24, 35); font-family:arial; font-size:14px">Một khi bước v&agrave;o lục địa thần thoại Eden, người chơi sẽ được h&oacute;a th&acirc;n th&agrave;nh những Chiến Thần c&oacute; nhiệm vụ bảo vệ th&aacute;nh địa n&agrave;y khỏi thế &Aacute;c Ma đang x&acirc;m nhập. Eden 3D t&aacute;i hiện quang cảnh tuyệt đẹp, tinh xảo v&agrave; đậm chất thần thoại ch&acirc;u &acirc;u. Trải nghiệm đầy đủ c&aacute;c t&iacute;nh năng của game nhập vai &ndash; chiến đấu &ndash; h&agrave;nh động như: Vượt ải, khi&ecirc;u chiến Boss, qu&acirc;n đo&agrave;n, n&acirc;ng cấp trang bị, thể hiện phong c&aacute;ch thời trang từ trang phục tới trang bị c&aacute;nh, song h&agrave;nh c&ugrave;ng th&uacute; nu&ocirc;i chiến đấu, PVP v&agrave; PVE tổ đội đầy k&iacute;ch th&iacute;ch&hellip;v&hellip;v&hellip;</span></p>\r\n\r\n<p style="text-align:center"><span style="color:rgb(20, 24, 35); font-family:arial; font-size:14px"><img alt="" src="http://mgate.vn/uploads/image/4%283%29.jpg" style="border:none; height:360px; margin:0px; max-width:100%; padding:0px; width:640px" /></span></p>\r\n\r\n<p style="text-align:justify"><span style="color:rgb(20, 24, 35); font-family:arial; font-size:14px">Với nền tảng đồ hoạ th&ocirc;ng minh đa nền, Eden 3D mang đến trải nghiệm cực ho&agrave;nh tr&aacute;ng khi điều khiển nh&acirc;n vật thi triển kỹ năng chiến đấu. Cảm gi&aacute;c chạm &amp; vuốt chiến đấu tuyệt vời tr&ecirc;n đầu ng&oacute;n tay, n&acirc;ng tầm trải nghiệm của người chơi trở n&ecirc;n si&ecirc;u thực hơn bao giờ hết.</span></p>\r\n\r\n<p style="text-align:center"><span style="color:rgb(20, 24, 35); font-family:arial; font-size:14px"><img alt="" src="http://mgate.vn/uploads/image/2%284%29.jpg" style="border:none; height:360px; margin:0px; max-width:100%; padding:0px; width:640px" /></span></p>\r\n\r\n<p style="text-align:justify"><span style="color:rgb(20, 24, 35); font-family:arial; font-size:14px">Eden 3D đặc biệt được y&ecirc;u th&iacute;ch tại thị trường H&agrave;n Quốc, tựa game n&agrave;y đ&atilde; nhanh ch&oacute;ng thu h&uacute;t h&agrave;ng triệu người chơi y&ecirc;u th&iacute;ch thể loại game chiến đấu si&ecirc;u thực c&ugrave;ng đồ hoạ lung linh. Tại xử sở kim chi hiện nay, người chơi mỗi ng&agrave;y một gia tang v&agrave; bị chinh phục bởi Eden 3D.</span></p>\r\n\r\n<p style="text-align:center"><span style="color:rgb(20, 24, 35); font-family:arial; font-size:14px"><img alt="" src="http://mgate.vn/uploads/image/3%284%29.jpg" style="border:none; height:360px; margin:0px; max-width:100%; padding:0px; width:640px" /></span></p>\r\n\r\n<p style="text-align:center"><span style="color:rgb(20, 24, 35); font-family:arial; font-size:14px"><img alt="" src="http://mgate.vn/uploads/image/5%283%29.jpg" style="border:none; height:360px; margin:0px; max-width:100%; padding:0px; width:640px" /></span></p>\r\n\r\n<p style="text-align:center"><span style="color:rgb(20, 24, 35); font-family:arial; font-size:14px"><img alt="" src="http://mgate.vn/uploads/image/6%282%29.jpg" style="border:none; height:360px; margin:0px; max-width:100%; padding:0px; width:640px" /></span></p>\r\n\r\n<p style="text-align:justify"><span style="color:rgb(20, 24, 35); font-family:arial; font-size:14px">TRẢI NGHIỆM SI&Ecirc;U THỰC TR&Ecirc;N ĐẦU NG&Oacute;N TAY</span></p>\r\n\r\n<p style="text-align:justify"><span style="color:rgb(20, 24, 35); font-family:arial; font-size:14px">Eden 3D vượt trội so với c&aacute;c game tr&ecirc;n thị trường bởi đồ họa. Kết hợp với c&ocirc;ng nghệ đồ hoạ Unity 3D th&ocirc;ng minh đa nền tảng, Eden 3D kh&ocirc;ng thua k&eacute;m bất kỳ game tr&ecirc;n PC n&agrave;o từ hiệu ứng kỹ năng, độ b&oacute;ng mượt, &aacute;nh s&aacute;ng huyền ảo v&agrave; lung linh đậm chất thần thoại.</span></p>\r\n\r\n<p style="text-align:justify"><span style="color:rgb(20, 24, 35); font-family:arial; font-size:14px">*** Đồ hoạ ấn tượng, tương t&aacute;c si&ecirc;u mượt</span></p>\r\n\r\n<p style="text-align:justify"><span style="color:rgb(20, 24, 35); font-family:arial; font-size:14px">*** Chạm &amp; Vuốt chiến đấu si&ecirc;u độc đ&aacute;o, cảm nhận kỹ năng nh&acirc;n vật ngay tr&ecirc;n đầu ng&oacute;n tay.</span></p>\r\n\r\n<p style="text-align:justify"><span style="color:rgb(20, 24, 35); font-family:arial; font-size:14px">*** Boss si&ecirc;u khủng, chặt ch&eacute;m si&ecirc;u sướng. Kh&ocirc;ng chỉ Boss loại thường, m&agrave; c&ograve;n Boss kh&ocirc;ng thể tưởng.</span></p>\r\n\r\n<p style="text-align:justify"><span style="color:rgb(20, 24, 35); font-family:arial; font-size:14px">*** Th&aacute;nh Gi&aacute;p Saga thay đổi suy nghĩ về thời trang chỉ để l&agrave;m đẹp. Thể hiện phong c&aacute;ch ri&ecirc;ng, chỉ số th&aacute;ch thức ri&ecirc;ng cho nh&acirc;n vật.</span></p>\r\n\r\n<p style="text-align:justify"><span style="color:rgb(20, 24, 35); font-family:arial; font-size:14px">*** Hệ thống C&aacute;nh huyền ảo lung linh, quy tụ c&aacute;c loại c&aacute;nh đẹp nhất trong thần thoại Ch&acirc;u &Acirc;u cổ xưa.</span></p>\r\n\r\n<p style="text-align:justify"><span style="color:rgb(20, 24, 35); font-family:arial; font-size:14px">*** Bộ sưu tập PET đa dạng &ndash; đa chủng loại, cực &ldquo;cool&rdquo; v&agrave; lạ mắt, bạn đồng h&agrave;nh kh&ocirc;ng thể thiếu.</span></p>\r\n\r\n<p style="text-align:justify"><span style="color:rgb(20, 24, 35); font-family:arial; font-size:14px">*** Đấu trường PVP tranh đua nghẹt thở, cấp bậc v&agrave; huy hiệu thủ lĩnh thể hiện sức mạnh chiến đấu của người chơi.</span></p>\r\n\r\n<p style="text-align:justify"><span style="color:rgb(20, 24, 35); font-family:arial; font-size:14px">*** Qu&acirc;n đo&agrave;n chiến: Th&aacute;ch thức những Chiến Thần mạnh nhất của c&aacute;c Qu&acirc;n đo&agrave;n, cọ s&aacute;t với người chơi c&ugrave;ng m&aacute;y chủ.</span></p>\r\n\r\n<p style="text-align:justify"><span style="color:rgb(20, 24, 35); font-family:arial; font-size:14px">*** Trải nghiệm thực tiễn thế n&agrave;o l&agrave; chạm &amp; vuốt trong chiến đấu, tương t&aacute;c si&ecirc;u độc đ&aacute;o.</span></p>\r\n\r\n<p style="text-align:justify"><span style="color:rgb(20, 24, 35); font-family:arial; font-size:14px">C&ugrave;ng c&aacute;c t&iacute;nh năng rất hấp dẫn đang chờ bạn tại lục địa huyền thoại Eden 3D.</span></p>\r\n\r\n<p style="text-align:justify"><span style="font-family:arial,helvetica,sans-serif; font-size:14px">N&agrave;o...H&atilde;y c&ugrave;ng kinh doanh game&nbsp;<strong>EDEN 3D</strong></span><span style="font-family:arial,helvetica,sans-serif; font-size:14px">&nbsp;để mang đến những trải nghiệm mới v&agrave; nguồn doanh thu cao cho c&aacute;c bạn nh&eacute; :)</span></p>\r\n', 'game', '12', '12', '["android","ios"]', '{"android":"eden.vn.game.mobo","ios":"vn.mecorp.eden"}', '{"android":"http:\\/\\/dl.mobo.vn\\/eden\\/?c=Y2hhbm5lbD0yfHJlZjJ8dHJhY2tpbmdfYmIyNjUxZDgmc3RvcmU9MQ==","ios":"http:\\/\\/dl.mobo.vn\\/eden\\/?c=Y2hhbm5lbD0yfHJlZjJ8dHJhY2tpbmdfYmIyNjUxZDgmc3RvcmU9MQ=="}', 'duocnt', '2015-07-09 10:26:07', '2015-07-13 20:39:12', 'active', 12, 'block', 'block', 6);
INSERT INTO `game_app` (`id_game_app`, `name`, `code_game`, `icon`, `banner`, `description`, `content`, `type`, `count_download`, `count_install`, `platform`, `package_name`, `download_url`, `create_user`, `create_time`, `update_time`, `status`, `order`, `set_new`, `favorite`, `size`) VALUES
(12, 'Iwin', 'iwin12', 'assets/images/Icon_iWin.png', NULL, 'Thông ti  game hot nhất thị trường', '<p>Get ready to soil your plants as a mob of fun-loving zombies is about to invade your home. Use your arsenal of 49 zombie-zapping plants &mdash; peashooters, wall-nuts, cherry bombs and more &mdash; to mulchify 26 types of zombies before they break down your door. This app offers in-app purchases. You may disable in-app purchasing using your device settings</p>\r\n\r\n                                <p>WINNER OF OVER 30 GAME OF THE YEAR AWARDS* 50 FUN-DEAD LEVELS</p>\r\n\r\n                                <p>Conquer all 50 levels of Adventure mode &mdash; through day, night, fog, in a swimming pool, on the rooftop and more. Plus fend off a continual wave of zombies as long as you can with Survival mode! NOT GARDEN-VARIETY GHOULS Battle zombie pole-vaulters, snorkelers, bucketheads and 26 more fun-dead zombies. Each has its own special skills, so you&#39;ll need to think fast and plant faster to combat them all. SMARTER THAN YOUR AVERAGE ZOMBIE Be careful how you use your limited supply of greens and seeds. Zombies love brains so much they&#39;ll jump, run, dance, swim and even eat plants to get into your house. Open the Almanac to learn more about all the zombies and plants to help plan your strategy. FIGHT LONGER, GET STRONGER Earn 49 powerful perennials as you progress and collect coins to buy a pet snail, power-ups and more. GROW WITH YOUR GAME Show off your zombie-zapping prowess by earning 46 awesome achievements and show off your zombie-zapping prowess. COIN PACKS Need coins for great new stuff? Buy up to 600,000 coins right from the Main Menu. *Original Mac/PC downloadable game. Be the first to know! Get inside EA info on great deals, plus the latest game updates, tips &amp; more&hellip;</p>\r\n\r\n                                <p>VISIT US: eamobile.com FOLLOW US: twitter.com/eamobile</p>\r\n\r\n                                <p>LIKE US: facebook.com/eamobile</p>\r\n\r\n                                <p>WATCH US: youtube.com/eamobilegames</p>\r\n\r\n                                <p>Terms of Service : http://www.ea.com/terms-of-service</p>\r\n\r\n                                <p>Privacy and Cookie Policy: http://www.ea.com/privacy-policy</p>\r\n\r\n                                <p>Game EULA: http://tos.ea.com/legalapp/mobileeula/US/en/GM/</p>\r\n\r\n                                <p>Visit https://help.ea.com/ for assistance or inquiries.</p>\r\n\r\n                                <p>EA may retire online features and services after 30 days&rsquo; notice posted on www.ea.com/1/service-updates. Important Consumer Information. This app contains direct links to the Internet</p>\r\n                                <p>&nbsp;</p>\r\n\r\n                                <p>TH&Ocirc;NG TIN</p>\r\n                                <hr />\r\n                                <br/>\r\n                                <p>Updated &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;2015-07-16 09:31:41</p>\r\n\r\n                                <p>Version &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 2.1</p>\r\n\r\n                                <p>Developer &nbsp; &nbsp; &nbsp;Snail Games USA</p>\r\n\r\n                                <p>Compatbility &nbsp;Android 2.3+</p>\r\n\r\n                                <p>Category &nbsp; &nbsp; &nbsp; &nbsp;Role Playing</p>\r\n\r\n                                <p>Source &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Google Play</p>', 'app', '3', '5', '["android","ios","wp"]', '{"android":"vn.iwin.all","ios":"vn.mecorp.iwin","wp":"abc"}', '{"android":"https:\\/\\/play.google.com\\/store\\/apps\\/details?id=iwin.vn.full","ios":"https:\\/\\/itunes.apple.com\\/vn\\/app\\/iwinonline\\/id625304386?mt=8","wp":"https:\\/\\/www.windowsphone.com\\/vi-vn\\/store\\/app\\/iwin-vn\\/4f8f3322-5df1-4de2-97a4-1dfd0cdd8c8f"}', 'duocnt', '2015-05-25 11:03:24', '2015-06-19 16:46:07', 'active', NULL, 'active', 'active', 154),
(13, 'App Thiên Thần Truyện', '3t12', 'assets/images/Icon_3T.png', NULL, 'Thông ti  game hot nhất thị trường', '<p>Get ready to soil your plants as a mob of fun-loving zombies is about to invade your home. Use your arsenal of 49 zombie-zapping plants &mdash; peashooters, wall-nuts, cherry bombs and more &mdash; to mulchify 26 types of zombies before they break down your door. This app offers in-app purchases. You may disable in-app purchasing using your device settings</p>\r\n\r\n                                <p>WINNER OF OVER 30 GAME OF THE YEAR AWARDS* 50 FUN-DEAD LEVELS</p>\r\n\r\n                                <p>Conquer all 50 levels of Adventure mode &mdash; through day, night, fog, in a swimming pool, on the rooftop and more. Plus fend off a continual wave of zombies as long as you can with Survival mode! NOT GARDEN-VARIETY GHOULS Battle zombie pole-vaulters, snorkelers, bucketheads and 26 more fun-dead zombies. Each has its own special skills, so you&#39;ll need to think fast and plant faster to combat them all. SMARTER THAN YOUR AVERAGE ZOMBIE Be careful how you use your limited supply of greens and seeds. Zombies love brains so much they&#39;ll jump, run, dance, swim and even eat plants to get into your house. Open the Almanac to learn more about all the zombies and plants to help plan your strategy. FIGHT LONGER, GET STRONGER Earn 49 powerful perennials as you progress and collect coins to buy a pet snail, power-ups and more. GROW WITH YOUR GAME Show off your zombie-zapping prowess by earning 46 awesome achievements and show off your zombie-zapping prowess. COIN PACKS Need coins for great new stuff? Buy up to 600,000 coins right from the Main Menu. *Original Mac/PC downloadable game. Be the first to know! Get inside EA info on great deals, plus the latest game updates, tips &amp; more&hellip;</p>\r\n\r\n                                <p>VISIT US: eamobile.com FOLLOW US: twitter.com/eamobile</p>\r\n\r\n                                <p>LIKE US: facebook.com/eamobile</p>\r\n\r\n                                <p>WATCH US: youtube.com/eamobilegames</p>\r\n\r\n                                <p>Terms of Service : http://www.ea.com/terms-of-service</p>\r\n\r\n                                <p>Privacy and Cookie Policy: http://www.ea.com/privacy-policy</p>\r\n\r\n                                <p>Game EULA: http://tos.ea.com/legalapp/mobileeula/US/en/GM/</p>\r\n\r\n                                <p>Visit https://help.ea.com/ for assistance or inquiries.</p>\r\n\r\n                                <p>EA may retire online features and services after 30 days&rsquo; notice posted on www.ea.com/1/service-updates. Important Consumer Information. This app contains direct links to the Internet</p>\r\n                                <p>&nbsp;</p>\r\n\r\n                                <p>TH&Ocirc;NG TIN</p>\r\n                                <hr />\r\n                                <br/>\r\n                                <p>Updated &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;2015-07-16 09:31:41</p>\r\n\r\n                                <p>Version &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 2.1</p>\r\n\r\n                                <p>Developer &nbsp; &nbsp; &nbsp;Snail Games USA</p>\r\n\r\n                                <p>Compatbility &nbsp;Android 2.3+</p>\r\n\r\n                                <p>Category &nbsp; &nbsp; &nbsp; &nbsp;Role Playing</p>\r\n\r\n                                <p>Source &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Google Play</p>', 'app', '5', '10', '["android","ios"]', '{"android":"vn.thienthan.thor","ios":"vn.thienthan.thor"}', '{"android":"https:\\/\\/play.google.com\\/store\\/apps\\/details?id=vn.thienthan.thor","ios":"https:\\/\\/itunes.apple.com\\/us\\/app\\/thien-than-truyen\\/id730234659?mt=8"}', 'duocnt', '2015-05-25 11:07:24', '2015-06-19 16:46:05', 'active', NULL, 'active', 'active', 787),
(14, 'App Mộng Giang Hồ', 'mgh12', 'assets/images/Icon_MGH_3%20copy.PNG', NULL, 'Thông ti  game hot nhất thị trường', '<p>Get ready to soil your plants as a mob of fun-loving zombies is about to invade your home. Use your arsenal of 49 zombie-zapping plants &mdash; peashooters, wall-nuts, cherry bombs and more &mdash; to mulchify 26 types of zombies before they break down your door. This app offers in-app purchases. You may disable in-app purchasing using your device settings</p>\r\n\r\n                                <p>WINNER OF OVER 30 GAME OF THE YEAR AWARDS* 50 FUN-DEAD LEVELS</p>\r\n\r\n                                <p>Conquer all 50 levels of Adventure mode &mdash; through day, night, fog, in a swimming pool, on the rooftop and more. Plus fend off a continual wave of zombies as long as you can with Survival mode! NOT GARDEN-VARIETY GHOULS Battle zombie pole-vaulters, snorkelers, bucketheads and 26 more fun-dead zombies. Each has its own special skills, so you&#39;ll need to think fast and plant faster to combat them all. SMARTER THAN YOUR AVERAGE ZOMBIE Be careful how you use your limited supply of greens and seeds. Zombies love brains so much they&#39;ll jump, run, dance, swim and even eat plants to get into your house. Open the Almanac to learn more about all the zombies and plants to help plan your strategy. FIGHT LONGER, GET STRONGER Earn 49 powerful perennials as you progress and collect coins to buy a pet snail, power-ups and more. GROW WITH YOUR GAME Show off your zombie-zapping prowess by earning 46 awesome achievements and show off your zombie-zapping prowess. COIN PACKS Need coins for great new stuff? Buy up to 600,000 coins right from the Main Menu. *Original Mac/PC downloadable game. Be the first to know! Get inside EA info on great deals, plus the latest game updates, tips &amp; more&hellip;</p>\r\n\r\n                                <p>VISIT US: eamobile.com FOLLOW US: twitter.com/eamobile</p>\r\n\r\n                                <p>LIKE US: facebook.com/eamobile</p>\r\n\r\n                                <p>WATCH US: youtube.com/eamobilegames</p>\r\n\r\n                                <p>Terms of Service : http://www.ea.com/terms-of-service</p>\r\n\r\n                                <p>Privacy and Cookie Policy: http://www.ea.com/privacy-policy</p>\r\n\r\n                                <p>Game EULA: http://tos.ea.com/legalapp/mobileeula/US/en/GM/</p>\r\n\r\n                                <p>Visit https://help.ea.com/ for assistance or inquiries.</p>\r\n\r\n                                <p>EA may retire online features and services after 30 days&rsquo; notice posted on www.ea.com/1/service-updates. Important Consumer Information. This app contains direct links to the Internet</p>\r\n                                <p>&nbsp;</p>\r\n\r\n                                <p>TH&Ocirc;NG TIN</p>\r\n                                <hr />\r\n                                <br/>\r\n                                <p>Updated &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;2015-07-16 09:31:41</p>\r\n\r\n                                <p>Version &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 2.1</p>\r\n\r\n                                <p>Developer &nbsp; &nbsp; &nbsp;Snail Games USA</p>\r\n\r\n                                <p>Compatbility &nbsp;Android 2.3+</p>\r\n\r\n                                <p>Category &nbsp; &nbsp; &nbsp; &nbsp;Role Playing</p>\r\n\r\n                                <p>Source &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Google Play</p>', 'app', '7', '14', '["android","ios","wp"]', '{"android":"vn.thienthan.thor","ios":"vn.thienthan.thor"}', '{"android":"https:\\/\\/play.google.com\\/store\\/apps\\/details?id=monggiangho.vn.game.mobo","ios":"https:\\/\\/itunes.apple.com\\/US\\/app\\/id964783889?mt=8","wp":"https:\\/\\/www.windowsphone.com\\/en-us\\/store\\/app\\/m%E1%BB%99ng-giang-h%E1%BB%93\\/09e284c7-8324-4617-976e-1e9176958013"}', 'duocnt', '2015-05-25 11:18:20', '2015-06-19 16:46:04', 'active', NULL, 'active', 'active', 140),
(15, 'App Thiên Thần Truyện', '3t612', 'assets/images/Icon_3T.png', NULL, 'Thông ti  game hot nhất thị trường', '<p>Get ready to soil your plants as a mob of fun-loving zombies is about to invade your home. Use your arsenal of 49 zombie-zapping plants &mdash; peashooters, wall-nuts, cherry bombs and more &mdash; to mulchify 26 types of zombies before they break down your door. This app offers in-app purchases. You may disable in-app purchasing using your device settings</p>\r\n\r\n                                <p>WINNER OF OVER 30 GAME OF THE YEAR AWARDS* 50 FUN-DEAD LEVELS</p>\r\n\r\n                                <p>Conquer all 50 levels of Adventure mode &mdash; through day, night, fog, in a swimming pool, on the rooftop and more. Plus fend off a continual wave of zombies as long as you can with Survival mode! NOT GARDEN-VARIETY GHOULS Battle zombie pole-vaulters, snorkelers, bucketheads and 26 more fun-dead zombies. Each has its own special skills, so you&#39;ll need to think fast and plant faster to combat them all. SMARTER THAN YOUR AVERAGE ZOMBIE Be careful how you use your limited supply of greens and seeds. Zombies love brains so much they&#39;ll jump, run, dance, swim and even eat plants to get into your house. Open the Almanac to learn more about all the zombies and plants to help plan your strategy. FIGHT LONGER, GET STRONGER Earn 49 powerful perennials as you progress and collect coins to buy a pet snail, power-ups and more. GROW WITH YOUR GAME Show off your zombie-zapping prowess by earning 46 awesome achievements and show off your zombie-zapping prowess. COIN PACKS Need coins for great new stuff? Buy up to 600,000 coins right from the Main Menu. *Original Mac/PC downloadable game. Be the first to know! Get inside EA info on great deals, plus the latest game updates, tips &amp; more&hellip;</p>\r\n\r\n                                <p>VISIT US: eamobile.com FOLLOW US: twitter.com/eamobile</p>\r\n\r\n                                <p>LIKE US: facebook.com/eamobile</p>\r\n\r\n                                <p>WATCH US: youtube.com/eamobilegames</p>\r\n\r\n                                <p>Terms of Service : http://www.ea.com/terms-of-service</p>\r\n\r\n                                <p>Privacy and Cookie Policy: http://www.ea.com/privacy-policy</p>\r\n\r\n                                <p>Game EULA: http://tos.ea.com/legalapp/mobileeula/US/en/GM/</p>\r\n\r\n                                <p>Visit https://help.ea.com/ for assistance or inquiries.</p>\r\n\r\n                                <p>EA may retire online features and services after 30 days&rsquo; notice posted on www.ea.com/1/service-updates. Important Consumer Information. This app contains direct links to the Internet</p>\r\n                                <p>&nbsp;</p>\r\n\r\n                                <p>TH&Ocirc;NG TIN</p>\r\n                                <hr />\r\n                                <br/>\r\n                                <p>Updated &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;2015-07-16 09:31:41</p>\r\n\r\n                                <p>Version &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 2.1</p>\r\n\r\n                                <p>Developer &nbsp; &nbsp; &nbsp;Snail Games USA</p>\r\n\r\n                                <p>Compatbility &nbsp;Android 2.3+</p>\r\n\r\n                                <p>Category &nbsp; &nbsp; &nbsp; &nbsp;Role Playing</p>\r\n\r\n                                <p>Source &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Google Play</p>', 'app', '5', '10', '["android","ios"]', '{"android":"vn.thienthan.thor","ios":"vn.thienthan.thor"}', '{"android":"https:\\/\\/play.google.com\\/store\\/apps\\/details?id=vn.thienthan.thor","ios":"https:\\/\\/itunes.apple.com\\/us\\/app\\/thien-than-truyen\\/id730234659?mt=8"}', 'duocnt', '2015-05-25 11:07:24', '2015-06-19 16:46:01', 'active', NULL, 'active', 'active', 646);

-- --------------------------------------------------------

--
-- Table structure for table `images_music`
--

CREATE TABLE IF NOT EXISTS `images_music` (
`id_image` int(11) NOT NULL,
  `id_album` int(11) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type` enum('music','image') DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `news_video`
--

CREATE TABLE IF NOT EXISTS `news_video` (
`id_news_video` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `content` text,
  `type` enum('video','news') DEFAULT 'news',
  `youtube_id` varchar(255) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('active','block') DEFAULT 'active',
  `order` int(11) DEFAULT NULL,
  `set_home` enum('active','block') DEFAULT 'block',
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `news_video`
--

INSERT INTO `news_video` (`id_news_video`, `name`, `description`, `content`, `type`, `youtube_id`, `create_time`, `status`, `order`, `set_home`, `image`) VALUES
(1, 'ChinaJoy 2015 - Cận cảnh Võ Lâm Truyền Kỳ Mobile cực đẹp', 'Không phụ lòng mong đợi của game thủ, Võ Lâm Truyền Kỳ thể hiện một bộ mặt vô cùng đáng giá với chất lượng đồ họa đỉnh cao.', '<p>Sáng nay 30/07, sự kiện <a href="https://omga.vn/chinajoy-2015.html" title="Chinajoy 2015"><strong>Chinajoy 2015</strong></a>, hội chợ game hàng đầu của Trung Quốc đã chính thức khai mạc. Sự kiện này sẽ diễn ra trong 4 ngày, từ hôm nay đến hết Chủ nhật 02/08. Trong thời gian đó, tất cả các doanh nghiệp kinh doanh game của Trung Quốc và nước ngoài bao gồm Châu Âu, Bắc Mỹ, Đông Á và cả Việt Nam sẽ tham gia hội chợ để trưng bày các sản phẩm của mình cho khách tham quan cũng như tìm kiếm đối tác vận hành sản phẩm.</p><p>Một trong những tựa game di động được mong chờ nhất tại Chinajoy năm nay là <strong>Võ Lâm Truyền Kỳ Mobile</strong> của nhà phát hành Kingsoft. Một game thủ may mắn đã được thử nghiệm tựa game này và chúng ta có thể thấy được những thước phim về phiên bản di động của dòng game kiếm hiệp tên tuổi này.</p>', 'news', NULL, '2015-07-30 17:33:17', 'active', NULL, 'active', 'assets/images/showgirl-gif-web.jpg'),
(2, 'Mộng Kiếm 3D chi tiết đến từng khung hình', 'NPH SGame hé lộ thêm về đồ họa 3D trong game mobile Mộng Kiếm với nhận định “Mộng Kiếm 3D chi tiết đến từng khung hình”.', '<p style="text-align:justify">Một trong những điểm nổi bật của <a href="https://omga.vn/mong-kiem-3d.html" title="Mộng Kiếm 3D"><strong>Mộng Kiếm 3D</strong></a> là đồ họa được xây dựng trên nền tảng Unity 3D nên chất lượng hình ảnh của game cao nhưng vẫn giữ được độ nhẹ của bộ cài cũng như hiệu năng của pin. Phong cách Q – Style (hoạt hình hóa nhân vật) được CMGE đầu tư kỹ lưỡng nên hơn 400 nhân vật trong <strong>Tiên Kiếm Kỳ Hiệp</strong> được khắc họa chi tiết trong Mộng Kiếm 3D, những Lý Tiêu Dao, Triệu Linh Nhi, Lâm Nguyệt Như … được thiết kế tỷ mỷ đến từng biểu cảm, giọng nói, động tác, chiêu thức.</p>', 'news', NULL, '2015-07-30 17:33:20', 'active', NULL, 'active', 'assets/images/banner(2).jpg'),
(3, 'ChinaJoy 2015 - Cận cảnh Võ Lâm Truyền Kỳ Mobile cực đẹp', 'Không phụ lòng mong đợi của game thủ, Võ Lâm Truyền Kỳ thể hiện một bộ mặt vô cùng đáng giá với chất lượng đồ họa đỉnh cao.', '<p>Sáng nay 30/07, sự kiện <a href="https://omga.vn/chinajoy-2015.html" title="Chinajoy 2015"><strong>Chinajoy 2015</strong></a>, hội chợ game hàng đầu của Trung Quốc đã chính thức khai mạc. Sự kiện này sẽ diễn ra trong 4 ngày, từ hôm nay đến hết Chủ nhật 02/08. Trong thời gian đó, tất cả các doanh nghiệp kinh doanh game của Trung Quốc và nước ngoài bao gồm Châu Âu, Bắc Mỹ, Đông Á và cả Việt Nam sẽ tham gia hội chợ để trưng bày các sản phẩm của mình cho khách tham quan cũng như tìm kiếm đối tác vận hành sản phẩm.</p><p>Một trong những tựa game di động được mong chờ nhất tại Chinajoy năm nay là <strong>Võ Lâm Truyền Kỳ Mobile</strong> của nhà phát hành Kingsoft. Một game thủ may mắn đã được thử nghiệm tựa game này và chúng ta có thể thấy được những thước phim về phiên bản di động của dòng game kiếm hiệp tên tuổi này.</p>', 'news', NULL, '2015-07-30 17:33:17', 'active', NULL, 'active', 'assets/images/showgirl-gif-web.jpg'),
(4, 'Mộng Kiếm 3D chi tiết đến từng khung hình', 'NPH SGame hé lộ thêm về đồ họa 3D trong game mobile Mộng Kiếm với nhận định “Mộng Kiếm 3D chi tiết đến từng khung hình”.', '<p style="text-align:justify">Một trong những điểm nổi bật của <a href="https://omga.vn/mong-kiem-3d.html" title="Mộng Kiếm 3D"><strong>Mộng Kiếm 3D</strong></a> là đồ họa được xây dựng trên nền tảng Unity 3D nên chất lượng hình ảnh của game cao nhưng vẫn giữ được độ nhẹ của bộ cài cũng như hiệu năng của pin. Phong cách Q – Style (hoạt hình hóa nhân vật) được CMGE đầu tư kỹ lưỡng nên hơn 400 nhân vật trong <strong>Tiên Kiếm Kỳ Hiệp</strong> được khắc họa chi tiết trong Mộng Kiếm 3D, những Lý Tiêu Dao, Triệu Linh Nhi, Lâm Nguyệt Như … được thiết kế tỷ mỷ đến từng biểu cảm, giọng nói, động tác, chiêu thức.</p>', 'news', NULL, '2015-07-30 17:33:20', 'active', NULL, 'active', 'assets/images/banner(2).jpg'),
(5, 'Mộng Kiếm 3D chi tiết đến từng khung hình', 'NPH SGame hé lộ thêm về đồ họa 3D trong game mobile Mộng Kiếm với nhận định “Mộng Kiếm 3D chi tiết đến từng khung hình”.', '<p style="text-align:justify">Một trong những điểm nổi bật của <a href="https://omga.vn/mong-kiem-3d.html" title="Mộng Kiếm 3D"><strong>Mộng Kiếm 3D</strong></a> là đồ họa được xây dựng trên nền tảng Unity 3D nên chất lượng hình ảnh của game cao nhưng vẫn giữ được độ nhẹ của bộ cài cũng như hiệu năng của pin. Phong cách Q – Style (hoạt hình hóa nhân vật) được CMGE đầu tư kỹ lưỡng nên hơn 400 nhân vật trong <strong>Tiên Kiếm Kỳ Hiệp</strong> được khắc họa chi tiết trong Mộng Kiếm 3D, những Lý Tiêu Dao, Triệu Linh Nhi, Lâm Nguyệt Như … được thiết kế tỷ mỷ đến từng biểu cảm, giọng nói, động tác, chiêu thức.</p>', 'video', NULL, '2015-07-30 17:42:05', 'active', NULL, 'active', 'assets/images/banner(2).jpg'),
(6, 'Mộng Kiếm 3D chi tiết đến từng khung hình', 'NPH SGame hé lộ thêm về đồ họa 3D trong game mobile Mộng Kiếm với nhận định “Mộng Kiếm 3D chi tiết đến từng khung hình”.', '<p style="text-align:justify">Một trong những điểm nổi bật của <a href="https://omga.vn/mong-kiem-3d.html" title="Mộng Kiếm 3D"><strong>Mộng Kiếm 3D</strong></a> là đồ họa được xây dựng trên nền tảng Unity 3D nên chất lượng hình ảnh của game cao nhưng vẫn giữ được độ nhẹ của bộ cài cũng như hiệu năng của pin. Phong cách Q – Style (hoạt hình hóa nhân vật) được CMGE đầu tư kỹ lưỡng nên hơn 400 nhân vật trong <strong>Tiên Kiếm Kỳ Hiệp</strong> được khắc họa chi tiết trong Mộng Kiếm 3D, những Lý Tiêu Dao, Triệu Linh Nhi, Lâm Nguyệt Như … được thiết kế tỷ mỷ đến từng biểu cảm, giọng nói, động tác, chiêu thức.</p>', 'video', NULL, '2015-07-30 17:42:09', 'active', NULL, 'active', 'assets/images/banner(2).jpg'),
(7, 'Mộng Kiếm 3D chi tiết đến từng khung hình', 'NPH SGame hé lộ thêm về đồ họa 3D trong game mobile Mộng Kiếm với nhận định “Mộng Kiếm 3D chi tiết đến từng khung hình”.', '<p style="text-align:justify">Một trong những điểm nổi bật của <a href="https://omga.vn/mong-kiem-3d.html" title="Mộng Kiếm 3D"><strong>Mộng Kiếm 3D</strong></a> là đồ họa được xây dựng trên nền tảng Unity 3D nên chất lượng hình ảnh của game cao nhưng vẫn giữ được độ nhẹ của bộ cài cũng như hiệu năng của pin. Phong cách Q – Style (hoạt hình hóa nhân vật) được CMGE đầu tư kỹ lưỡng nên hơn 400 nhân vật trong <strong>Tiên Kiếm Kỳ Hiệp</strong> được khắc họa chi tiết trong Mộng Kiếm 3D, những Lý Tiêu Dao, Triệu Linh Nhi, Lâm Nguyệt Như … được thiết kế tỷ mỷ đến từng biểu cảm, giọng nói, động tác, chiêu thức.</p>', 'video', NULL, '2015-07-30 17:42:12', 'active', NULL, 'active', 'assets/images/banner(2).jpg'),
(8, 'Mộng Kiếm 3D chi tiết đến từng khung hình', 'NPH SGame hé lộ thêm về đồ họa 3D trong game mobile Mộng Kiếm với nhận định “Mộng Kiếm 3D chi tiết đến từng khung hình”.', '<p style="text-align:justify">Một trong những điểm nổi bật của <a href="https://omga.vn/mong-kiem-3d.html" title="Mộng Kiếm 3D"><strong>Mộng Kiếm 3D</strong></a> là đồ họa được xây dựng trên nền tảng Unity 3D nên chất lượng hình ảnh của game cao nhưng vẫn giữ được độ nhẹ của bộ cài cũng như hiệu năng của pin. Phong cách Q – Style (hoạt hình hóa nhân vật) được CMGE đầu tư kỹ lưỡng nên hơn 400 nhân vật trong <strong>Tiên Kiếm Kỳ Hiệp</strong> được khắc họa chi tiết trong Mộng Kiếm 3D, những Lý Tiêu Dao, Triệu Linh Nhi, Lâm Nguyệt Như … được thiết kế tỷ mỷ đến từng biểu cảm, giọng nói, động tác, chiêu thức.</p>', 'video', NULL, '2015-07-30 17:42:15', 'active', NULL, 'active', 'assets/images/banner(2).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `platform`
--

CREATE TABLE IF NOT EXISTS `platform` (
`id_platform` int(11) NOT NULL,
  `full_name` varchar(45) DEFAULT NULL,
  `alias` varchar(45) DEFAULT NULL,
  `creat_time` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `platform`
--

INSERT INTO `platform` (`id_platform`, `full_name`, `alias`, `creat_time`) VALUES
(1, 'Android', 'android', '2014-09-09 17:11:23'),
(2, 'iOS', 'ios', '2014-09-09 17:11:31'),
(6, 'Windows Phone', 'wp', '2014-11-17 16:07:32');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id_admin` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `full_name` varchar(45) DEFAULT NULL,
  `description` text,
  `status` varchar(45) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `id_group` int(11) NOT NULL DEFAULT '0',
  `avatar` varchar(255) DEFAULT NULL,
  `penname` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_admin`, `username`, `password`, `full_name`, `description`, `status`, `create_time`, `update_time`, `id_group`, `avatar`, `penname`) VALUES
(1, 'tailm', 'e10adc3949ba59abbe56e057f20f883e', 'Le Minh Tai', '', '1', '2014-11-07 00:00:00', '2015-06-08 13:34:48', 2, 'danh-gia-bien-than-di-chua-cong01.jpg', 'leminhtai'),
(3, 'duocnt', 'e10adc3949ba59abbe56e057f20f883e', 'Ngo Thanh Duoc', NULL, '1', '2014-11-07 15:21:05', '2015-01-13 11:52:41', 2, NULL, NULL),
(4, 'thyta', '6a4f42487edae3e2a2b0cd574dfa3a08', 'Trần Anh Thy', '', '1', '2015-06-22 17:26:24', NULL, 2, NULL, 'Trần Anh Thy');

-- --------------------------------------------------------

--
-- Table structure for table `user_app`
--

CREATE TABLE IF NOT EXISTS `user_app` (
`id_user_app` int(11) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `birth_day` varchar(20) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `icoin` int(11) DEFAULT NULL,
  `platform` varchar(15) NOT NULL,
  `device_id` varchar(100) DEFAULT NULL,
  `device_token` varchar(100) DEFAULT NULL,
  `channel` varchar(30) NOT NULL,
  `user_agent` text,
  `ip` varchar(45) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `login_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active_code` varchar(45) DEFAULT NULL,
  `type` enum('phone','facebook') NOT NULL DEFAULT 'phone',
  `access_token` varchar(200) NOT NULL,
  `gift_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user_app`
--

INSERT INTO `user_app` (`id_user_app`, `user_name`, `password`, `full_name`, `birth_day`, `gender`, `avatar`, `icoin`, `platform`, `device_id`, `device_token`, `channel`, `user_agent`, `ip`, `create_time`, `login_time`, `active_code`, `type`, `access_token`, `gift_code`) VALUES
(1, '837726312942542', '627c7af58933fd1973548b332103eba1', 'Được Được', '09/07/2015', 'Nam', 'assets/uploads/627c7af58933fd1973548b332103eba1/90b3848d78cff0c87ac7de1a5a3c9b5a.jpg', 38, 'android', '9d5329100f391482a8b1f3e3a21e473e8fdff466-d3418b2b-b3ca-458d-ad84-734d30c931f6', 'APA91bG2C3zbF-nqS4HIcl1WH7Wvy_bgwws-KvDYZXS2IQTmfetbq4z_AdQNxyBgUfUCQXkFnhrnaMuV8Vy-GPIouWCUtTjoZjpv', '1|me|1.0', 'Dalvik/2.1.0 (Linux; U; Android 5.1.1; Nexus 5 Build/LMY48B)', '10.7.3.11', '2015-07-09 09:25:46', '2015-07-10 07:45:14', NULL, 'facebook', 'CAAaETREJsdUBAN1seVFeJkjqZB9ReTbL9Q5hg413hphF0wEfAn6SQd7B1YFsxOqZBQmSWkFfDVHHeWbG33LmgQGwaKtbD3f8q5EFZBZB0LkRCc5bUZBkBax6GVX4jaOWeQycZAc1seyPbkOZATfbybZCukRBLbf6M4ZBmgsBtk2lc2lif7ZAqHPTTFMxiWeujnDIGQE', '4BE4'),
(2, '794512747253986', '037e94c32c6088313db4ed980c5b17df', 'sdfsdfd', '09-07-2015', 'Nam', 'assets/uploads/037e94c32c6088313db4ed980c5b17df/de2a9e2e0aab468f6892a5ba979a26fc.jpg', 130, 'ios', '37d38d55dbec4ce97c9675374b6c6981c8517e59', '<null>', '1|me|1.0.0', 'iPhone Simulator', '10.8.15.115', '2015-07-09 09:27:47', '2015-07-13 06:58:28', NULL, 'facebook', 'CAATZBXTra52QBAIm6hNwVKD5dWSxMKnslrAfK03rCDcCcjFGOeZBCR1GVKkhB2akotZCETqTyd2l3kbi0ZB3ZCw61VLg1d7Qk8xOY54ZAi5hZAwHPPF7cdWZAZCehZAz5IYJyO9rcdp1mvtY910lPprWjdpjzdzKDsycpEpzK79BZCAkWNXyQvoB9bpJ2PzPMddluGT', '3391'),
(3, '84903001460', '5adec0de722439b87b0671af74b8e9d2', 'đđđ', '09/07/2015', 'Nữ', 'assets/uploads/6b629f356e0956345abef56970dc810f/c1304c7b22e402476ce952f4e84a7d70.jpg', 0, 'wp', 'YS9Fa/AZYSd9Nf8hQwCkHoUkmt0=', 'http://db3.notify.live.net/throttledthirdparty/01.00/AQE_275lvniRSLXfEY4VoscWAgAAAAADAQAAAAQUZm52OkJ', '1', 'mobo', '123', '2015-07-09 09:39:06', '2015-07-09 08:10:29', '755037', 'phone', '', '9421'),
(4, '1483092781953769', 'e93d46f701dc0dc9c7b8e091db9c553e', 'Bùi Minh Đức', '05/12/1991', 'Nam', 'assets/uploads/e93d46f701dc0dc9c7b8e091db9c553e/c69a914b281f10c43c48519bd07529c2.jpg', 43, 'wp', 'YS9Fa/AZYSd9Nf8hQwCkHoUkmt0=', 'http://db3.notify.live.net/throttledthirdparty/01.00/AQE_275lvniRSLXfEY4VoscWAgAAAAADAwAAAAQUZm52OkJ', '1', 'mobo', '123', '2015-07-09 10:26:34', '2015-07-10 02:27:02', NULL, 'facebook', 'CAAaETREJsdUBACcTG0ou4DXp9VOXhwqXX9num6LBOiHDojgSc9bueKPzEir4h31Frdw1VpabKDU0afFJZAnvscGm6OrSzybL5EM16BdoUI6x0yfkOKLTZCINFT3klDJfGLJkVkqoKvV0MYgXsR3owPrrZBsH2mnvaqnRnKhZAurqS3PgYn0XGkeN257lZA3AG5VETaZ', 'B28C'),
(5, '841663423183', '224cf2b695a5e8ecaecfb9015161fa4b', 'Đức Cong''', '05/12/1991', 'Nam', NULL, 10, 'wp', 'PxFhjVDdYrWHi0tJHvP4E5fuYKg=', 'http://s.notify.live.net/u/1/hk2/H2QAAABzVNZkSxVs75jIS1MTS-Ce3uK_0-vtBuAAI25x8IxUccRG3LIeaqsFMYgrHYp', '1', 'mobo', '123', '2015-07-09 10:55:42', '2015-07-09 08:35:32', '540737', 'phone', '', '3B48'),
(6, '104252393247119', 'a463c9333faa19e51030b84afd042af3', 'Khoa Lê', '11/01/1991', 'Nam', 'assets/uploads/a463c9333faa19e51030b84afd042af3/e4a0081a2e3a9c01e2cf7693a9861c76.jpg', 15, 'android', '11ccc209f7180ad7f78d7a95b1539e55b344da74-220f0003-4ceb-4acb-a390-d84c25135def', 'APA91bEvoi7ZB5JfIYe2DuVaQPZeYM_8B74UuA-aOdOijtiIU_aDXiGo3aepmFCXEGbP2dfKP8BSzhyIse3fXVz4C0sC3Ka8O1n8', '1|me|1.0', 'Dalvik/1.6.0 (Linux; U; Android 4.1.2; LT26ii Build/6.2.B.1.96)', '10.7.0.42', '2015-07-10 14:53:15', '2015-07-11 13:06:43', NULL, 'facebook', 'CAAaETREJsdUBALpxucxodbTzS0x0OnDuDaM9sYuu8wLZASm4zIgZCm3p8cbiUpw0SCHhAWZCGLG5TfVnBRWaJzG9WeNV5Y5kpunVtTmjyV8hjawvnGn2ENLtZAZBwTQ37G6ITYznQUZC8HebZBBtdbS6HZBzSKeQYKNGJpiZB3dq21ZBZAEEjxySxF9aZBcvt8SkYvv', '09F2'),
(7, '841208558995', '14e1b600b1fd579f47433b88e8d85291', NULL, NULL, NULL, NULL, 3, 'ios', '5d5a4780d757190df7e0db3bb6c1f535a3063513', '<null>', '1|me|1.0.0', 'iPhone', '10.7.1.43', '2015-07-13 16:43:49', '2015-07-13 09:46:17', '776319', 'phone', '', '15D2'),
(8, '84938846510', 'ed55b4b841a38e80363b1b6c4b366606', NULL, NULL, NULL, NULL, 20, 'ios', '68aa16412674682549ef7308c0f6da677e5e9ea4', '<null>', '1|me|1.0.0', 'iPhone', '10.7.3.29', '2015-07-13 16:58:04', '2015-07-13 09:59:55', '415324', 'phone', '', '4BA8');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
`id_group` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `full_name` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `permission` text,
  `is_admin` int(2) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id_group`, `name`, `full_name`, `status`, `create_time`, `update_time`, `permission`, `is_admin`) VALUES
(2, 'admin', 'Admin', '1', '2014-11-07 00:00:00', '2015-07-13 21:02:28', '["11","12","22","23","5","6","26","27","1","2","3","4","38","39","40","41"]', 1),
(3, 'writer', 'Writer', '1', '2014-11-07 13:53:06', '2015-01-07 15:07:09', '["11","12","14","15","16","17","22","23","7","8","9","10","24","25","28","29","30"]', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_has_function`
--

CREATE TABLE IF NOT EXISTS `user_has_function` (
  `id_admin` int(11) NOT NULL,
  `id_function` int(11) NOT NULL,
  `allow` text,
  `create_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_has_function`
--

INSERT INTO `user_has_function` (`id_admin`, `id_function`, `allow`, `create_date`) VALUES
(2, 1, NULL, NULL),
(2, 2, NULL, NULL),
(2, 3, NULL, NULL),
(2, 4, NULL, NULL),
(2, 5, NULL, NULL),
(2, 6, NULL, NULL),
(2, 11, NULL, NULL),
(2, 12, NULL, NULL),
(2, 26, NULL, NULL),
(2, 27, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
 ADD PRIMARY KEY (`id_album`);

--
-- Indexes for table `cate`
--
ALTER TABLE `cate`
 ADD PRIMARY KEY (`id_cate`);

--
-- Indexes for table `comment_app`
--
ALTER TABLE `comment_app`
 ADD PRIMARY KEY (`id_commet`);

--
-- Indexes for table `function`
--
ALTER TABLE `function`
 ADD PRIMARY KEY (`id_function`), ADD UNIQUE KEY `alias_UNIQUE` (`alias`), ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `function_group`
--
ALTER TABLE `function_group`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game_app`
--
ALTER TABLE `game_app`
 ADD PRIMARY KEY (`id_game_app`);

--
-- Indexes for table `images_music`
--
ALTER TABLE `images_music`
 ADD PRIMARY KEY (`id_image`);

--
-- Indexes for table `news_video`
--
ALTER TABLE `news_video`
 ADD PRIMARY KEY (`id_news_video`);

--
-- Indexes for table `platform`
--
ALTER TABLE `platform`
 ADD PRIMARY KEY (`id_platform`), ADD UNIQUE KEY `alias_UNIQUE` (`alias`), ADD KEY `full_alias` (`alias`,`full_name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id_admin`,`id_group`), ADD UNIQUE KEY `username_UNIQUE` (`username`), ADD KEY `id_group` (`id_group`);

--
-- Indexes for table `user_app`
--
ALTER TABLE `user_app`
 ADD PRIMARY KEY (`id_user_app`), ADD UNIQUE KEY `user_name_UNIQUE` (`user_name`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
 ADD PRIMARY KEY (`id_group`), ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indexes for table `user_has_function`
--
ALTER TABLE `user_has_function`
 ADD PRIMARY KEY (`id_admin`,`id_function`), ADD KEY `fk_user_has_function_function1_idx` (`id_function`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
MODIFY `id_album` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cate`
--
ALTER TABLE `cate`
MODIFY `id_cate` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `comment_app`
--
ALTER TABLE `comment_app`
MODIFY `id_commet` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `function`
--
ALTER TABLE `function`
MODIFY `id_function` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `function_group`
--
ALTER TABLE `function_group`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `game_app`
--
ALTER TABLE `game_app`
MODIFY `id_game_app` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `images_music`
--
ALTER TABLE `images_music`
MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `news_video`
--
ALTER TABLE `news_video`
MODIFY `id_news_video` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `platform`
--
ALTER TABLE `platform`
MODIFY `id_platform` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_app`
--
ALTER TABLE `user_app`
MODIFY `id_user_app` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
MODIFY `id_group` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
