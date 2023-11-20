-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2023 at 04:08 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wandercrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_commentmeta`
--

CREATE TABLE `wp_commentmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_comments`
--

CREATE TABLE `wp_comments` (
  `comment_ID` bigint(20) UNSIGNED NOT NULL,
  `comment_post_ID` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT 0,
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT 'comment',
  `comment_parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_comments`
--

INSERT INTO `wp_comments` (`comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`) VALUES
(1, 1, 'A WordPress Commenter', 'wapuu@wordpress.example', 'https://wordpress.org/', '', '2023-05-24 05:39:49', '2023-05-24 05:39:49', 'Hi, this is a comment.\nTo get started with moderating, editing, and deleting comments, please visit the Comments screen in the dashboard.\nCommenter avatars come from <a href=\"https://en.gravatar.com/\">Gravatar</a>.', 0, '1', '', 'comment', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_invoice`
--

CREATE TABLE `wp_invoice` (
  `ID` bigint(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `receipt_no` varchar(12) NOT NULL,
  `invoice_no` varchar(12) NOT NULL,
  `client_name` varchar(80) NOT NULL,
  `client_address` text NOT NULL,
  `client_phone` int(10) NOT NULL,
  `client_mail` varchar(45) NOT NULL,
  `client_pan` varchar(25) NOT NULL,
  `client_gst` varchar(25) NOT NULL,
  `invoice_type` varchar(25) NOT NULL,
  `invoice_fin_yr` date NOT NULL,
  `invoice_tax` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wp_invoice`
--

INSERT INTO `wp_invoice` (`ID`, `user_id`, `receipt_no`, `invoice_no`, `client_name`, `client_address`, `client_phone`, `client_mail`, `client_pan`, `client_gst`, `invoice_type`, `invoice_fin_yr`, `invoice_tax`) VALUES
(149, 2, '', '1000', 'Maurice D. Slattery', '3260 Henry Ford Avenue, Manhattan, NY 10016', 2147483647, 'MauriceDSlattery@jourrapide.com', 'DGSD4562', '76352DSGSD', 'Individual', '2023-06-21', 'a:2:{i:0;s:4:\"CGST\";i:1;s:4:\"SGST\";}'),
(150, 2, '', '1001', 'Regina Maness', '2675 Carriage Court, Calexico, CA 92231', 58798758, 'xxRosaRPhillips@rhyta.com', 'DGSD4562', '76352DSGSD', 'Individual', '2023-06-23', 'a:3:{i:0;s:4:\"SGST\";i:1;s:4:\"IGST\";i:2;s:3:\"TCS\";}'),
(151, 2, '', '1002', 'Jeanne K. Paris', '4264 Camden Street, Reno, NV 89501', 58798758, 'JeanneKParis@armyspy.com', 'DGSH67562', '76352DSGSD', 'Individual', '2023-06-23', 'a:3:{i:0;s:4:\"CGST\";i:1;s:4:\"IGST\";i:2;s:3:\"TCS\";}'),
(152, 2, '', '1003', 'Bell Corkery', '14 Causeway Dr Ocean Isle Beach, Nebraska, United States', 2147483647, 'BellCorkery@gmail.com', 'GSGSA456234', '879KLJUKLJL987', 'company', '0000-00-00', 'a:3:{i:0;s:4:\"CGST\";i:1;s:4:\"SGST\";i:2;s:3:\"TCS\";}');

-- --------------------------------------------------------

--
-- Table structure for table `wp_invoice_items`
--

CREATE TABLE `wp_invoice_items` (
  `ID` int(11) NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `item_description` varchar(200) NOT NULL,
  `item_quantity` varchar(20) NOT NULL,
  `item_rate` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wp_invoice_items`
--

INSERT INTO `wp_invoice_items` (`ID`, `invoice_id`, `item_description`, `item_quantity`, `item_rate`) VALUES
(1, 106, ' Ipsum has been the industry\\\'s standard dummy text ever since the 1500s, when an u', '12', '56'),
(2, 106, 'ining essentially unchanged. It w', '34', '345'),
(3, 106, 'literature from 45 BC, making it ove', '45', '324'),
(4, 106, ' going through the c', '77', '876'),
(5, 107, ' it to make a type s', '8', '45'),
(6, 107, 'ining essentially unchanged. It w', '7', '234'),
(7, 107, 'lt model text, and a search ', '6', '56'),
(8, 107, 'it has a more-or-less ', '7', '25'),
(18, 117, ' Ipsum has been the industry\\\'s standard dummy text ever since the 1500s, when an u', '12', '45'),
(19, 120, ' Ipsum has been the industry\\\'s standard dummy text ever since the 1500s, when an u', '12', '56'),
(20, 121, ' it to make a type s', '3', '68'),
(21, 122, 'hjgjhgjhgb kj', '23', '67'),
(22, 122, 'ining essentially unchanged. It w', '12', '78'),
(23, 123, ' Ipsum has been the industry\\\'s standard dummy text ever since the 1500s, when an u', '8', '45'),
(24, 124, 'ublishing packages', '8', '20'),
(25, 124, 'There are many variations of passages of Lorem Ipsum available,', '3', '10'),
(26, 124, 'randomised words which don\\\'t look even slightly believable.', '4', '15'),
(27, 131, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has', '2', '12'),
(28, 131, 'There are many variations of passages of Lorem Ipsum available,', '3', '23'),
(29, 131, 'lt model text, and a search ', '4', '34'),
(30, 132, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has', '2', '12'),
(31, 133, ' Ipsum has been the industry\\\'s standard dummy text ever since the 1500s, when an u', '2', '23'),
(32, 133, 'There are many variations of passages of Lorem Ipsum available,', '3', '12'),
(33, 133, 'but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets', '5', '56'),
(34, 134, 'Ining essentially unchanged. It w', '10', '200'),
(35, 134, 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour,', '20', '300'),
(36, 135, 'Tontrary to popular belief, Lorem Ipsum is not simply random text', '20', '15'),
(37, 135, 'Chere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour,', '30', '25'),
(38, 135, 'She standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.', '10', '60'),
(39, 136, ' Updated Ipsum has been the industry\\\\\\\'s standard dummy text ever since the 1500s, when an u', '3', '56'),
(40, 136, 'There are many variations of passages of Lorem Ipsum available,', '6', '78'),
(41, 136, 'randomised words which don\\\'t look even slightly believable.', '9', '12'),
(42, 137, ' Updated Ipsum has been the industry\\\\\\\'s standard dummy text ever since the 1500s, when an u', '8', '12'),
(43, 137, 'There are many variations of passages of Lorem Ipsum available,', '5', '234'),
(44, 137, 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.', '7', '768'),
(45, 138, 'updated The purpose of lorem ipsum is to create a natural looking block of text', '2', '321'),
(46, 138, 'scrambled parts of Cicero\\\'s De Finibus Bonorum et Malorum for use in a type specimen book. It usually begins', '3', '780'),
(47, 138, 'updated Today it\\\\\\\'s seen all around the web; on templates', '6', '781'),
(48, 138, 'updated From its medieval origins to the digital era, learn everything there is to know about the ubiquitous lorem ipsum passage', '8', '280'),
(49, 139, '', '', ''),
(50, 140, 'Lpsum has been the industry\\\\\\\\\\\\\\\'s standard dummy text ever since the 1500s, when an u', '2', '50'),
(51, 140, 'Various versions have evolved over the years, sometimes by accident, ', '3', '50'),
(52, 140, 'But also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets', '5', '60'),
(53, 140, 'From its medieval origins to the digital era, learn everything there is to know about the ubiquitous lorem ipsum passage', '8', '40'),
(54, 141, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has', '2', '1100'),
(56, 141, 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.', '5', '600'),
(57, 142, 'Lpsum has been the industry\\\\\\\\\\\\\\\'s standard dummy text ever since the 1500s, when an u', '34', '124'),
(58, 142, 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour,', '51', '127'),
(59, 142, 'lt model text, and a search ', '30', '237'),
(60, 142, ' going through the card', '20', '589'),
(61, 143, ' Updated Ipsum has been the industry\\\\\\\'s standard dummy text ever since the 1500s', '11', '20'),
(62, 143, 'Various versions have evolved over the years, sometimes by accident, ', '15', '30'),
(63, 144, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has', '12', '80'),
(64, 144, 'ining essentially unchanged', '13', '65'),
(65, 145, ' it to make a type sdfa', '18', '234'),
(66, 145, 'Various versions have evolved over the years, sometimes by accident, ', '12', '170'),
(67, 145, 'literature from 45 BC, making it ove', '14', '127'),
(68, 146, ' it to make a type s', '38', '200'),
(69, 146, 'Xyz ining essentially unchanged. It w', '21', '150'),
(70, 147, 'Lpsum has been the industry\'s standard dummy text ever since the 1500s, when an u', '6', '20'),
(71, 147, 'There are many variations of passages\'s of Lorem Ipsum available,', '3', '56'),
(72, 148, 'Lpsum has been the industry\\\\\\\\\\\\\\\'s standard dummy text ever since the 1500s, when an u', '45', '124'),
(80, 148, 'Xyz ining essentially unchanged. It w', '2', '45'),
(84, 149, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has', '8', '67'),
(85, 149, 'There are many variations of passages of Lorem Ipsum available,', '45', '45'),
(86, 150, ' Ipsum has been the industry\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\'s standard dummy text ever since the 1500s, when an u', '90', '134'),
(87, 150, 'ining essentially unchanged. It w', '55', '5555'),
(88, 150, 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.', '70', '235'),
(89, 150, 'Going through the cinema', '20', '567'),
(90, 151, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has', '30', '555'),
(93, 151, 'Various versions have evolved over the years, sometimes by accident, ', '40', '777'),
(94, 152, 'Options to be passed to json_encode(). Default 0.', '12', '230'),
(95, 152, 'Variable (usually an array or object) to encode as JSON, then print and die.', '30', '120');

-- --------------------------------------------------------

--
-- Table structure for table `wp_links`
--

CREATE TABLE `wp_links` (
  `link_id` bigint(20) UNSIGNED NOT NULL,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_image` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(25) NOT NULL DEFAULT '',
  `link_description` varchar(255) NOT NULL DEFAULT '',
  `link_visible` varchar(20) NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `link_rating` int(11) NOT NULL DEFAULT 0,
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL DEFAULT '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_options`
--

CREATE TABLE `wp_options` (
  `option_id` bigint(20) UNSIGNED NOT NULL,
  `option_name` varchar(191) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_options`
--

INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'siteurl', 'http://localhost/wandercrm', 'yes'),
(2, 'home', 'http://localhost/wandercrm', 'yes'),
(3, 'blogname', 'wandercrm', 'yes'),
(4, 'blogdescription', '', 'yes'),
(5, 'users_can_register', '0', 'yes'),
(6, 'admin_email', 'debtapas14@gmail.com', 'yes'),
(7, 'start_of_week', '1', 'yes'),
(8, 'use_balanceTags', '0', 'yes'),
(9, 'use_smilies', '1', 'yes'),
(10, 'require_name_email', '1', 'yes'),
(11, 'comments_notify', '1', 'yes'),
(12, 'posts_per_rss', '10', 'yes'),
(13, 'rss_use_excerpt', '0', 'yes'),
(14, 'mailserver_url', 'mail.example.com', 'yes'),
(15, 'mailserver_login', 'login@example.com', 'yes'),
(16, 'mailserver_pass', 'password', 'yes'),
(17, 'mailserver_port', '110', 'yes'),
(18, 'default_category', '1', 'yes'),
(19, 'default_comment_status', 'open', 'yes'),
(20, 'default_ping_status', 'open', 'yes'),
(21, 'default_pingback_flag', '1', 'yes'),
(22, 'posts_per_page', '10', 'yes'),
(23, 'date_format', 'F j, Y', 'yes'),
(24, 'time_format', 'g:i a', 'yes'),
(25, 'links_updated_date_format', 'F j, Y g:i a', 'yes'),
(26, 'comment_moderation', '0', 'yes'),
(27, 'moderation_notify', '1', 'yes'),
(28, 'permalink_structure', '/%postname%/', 'yes'),
(29, 'rewrite_rules', 'a:92:{s:11:\"^wp-json/?$\";s:22:\"index.php?rest_route=/\";s:14:\"^wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:21:\"^index.php/wp-json/?$\";s:22:\"index.php?rest_route=/\";s:24:\"^index.php/wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:17:\"^wp-sitemap\\.xml$\";s:23:\"index.php?sitemap=index\";s:17:\"^wp-sitemap\\.xsl$\";s:36:\"index.php?sitemap-stylesheet=sitemap\";s:23:\"^wp-sitemap-index\\.xsl$\";s:34:\"index.php?sitemap-stylesheet=index\";s:48:\"^wp-sitemap-([a-z]+?)-([a-z\\d_-]+?)-(\\d+?)\\.xml$\";s:75:\"index.php?sitemap=$matches[1]&sitemap-subtype=$matches[2]&paged=$matches[3]\";s:34:\"^wp-sitemap-([a-z]+?)-(\\d+?)\\.xml$\";s:47:\"index.php?sitemap=$matches[1]&paged=$matches[2]\";s:47:\"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:42:\"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:23:\"category/(.+?)/embed/?$\";s:46:\"index.php?category_name=$matches[1]&embed=true\";s:35:\"category/(.+?)/page/?([0-9]{1,})/?$\";s:53:\"index.php?category_name=$matches[1]&paged=$matches[2]\";s:17:\"category/(.+?)/?$\";s:35:\"index.php?category_name=$matches[1]\";s:44:\"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:39:\"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:20:\"tag/([^/]+)/embed/?$\";s:36:\"index.php?tag=$matches[1]&embed=true\";s:32:\"tag/([^/]+)/page/?([0-9]{1,})/?$\";s:43:\"index.php?tag=$matches[1]&paged=$matches[2]\";s:14:\"tag/([^/]+)/?$\";s:25:\"index.php?tag=$matches[1]\";s:45:\"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:40:\"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:21:\"type/([^/]+)/embed/?$\";s:44:\"index.php?post_format=$matches[1]&embed=true\";s:33:\"type/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?post_format=$matches[1]&paged=$matches[2]\";s:15:\"type/([^/]+)/?$\";s:33:\"index.php?post_format=$matches[1]\";s:48:\".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$\";s:18:\"index.php?feed=old\";s:20:\".*wp-app\\.php(/.*)?$\";s:19:\"index.php?error=403\";s:18:\".*wp-register.php$\";s:23:\"index.php?register=true\";s:32:\"feed/(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:27:\"(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:8:\"embed/?$\";s:21:\"index.php?&embed=true\";s:20:\"page/?([0-9]{1,})/?$\";s:28:\"index.php?&paged=$matches[1]\";s:27:\"comment-page-([0-9]{1,})/?$\";s:39:\"index.php?&page_id=10&cpage=$matches[1]\";s:41:\"comments/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:36:\"comments/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:17:\"comments/embed/?$\";s:21:\"index.php?&embed=true\";s:44:\"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:39:\"search/(.+)/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:20:\"search/(.+)/embed/?$\";s:34:\"index.php?s=$matches[1]&embed=true\";s:32:\"search/(.+)/page/?([0-9]{1,})/?$\";s:41:\"index.php?s=$matches[1]&paged=$matches[2]\";s:14:\"search/(.+)/?$\";s:23:\"index.php?s=$matches[1]\";s:47:\"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:42:\"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:23:\"author/([^/]+)/embed/?$\";s:44:\"index.php?author_name=$matches[1]&embed=true\";s:35:\"author/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?author_name=$matches[1]&paged=$matches[2]\";s:17:\"author/([^/]+)/?$\";s:33:\"index.php?author_name=$matches[1]\";s:69:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:64:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:45:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$\";s:74:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true\";s:57:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]\";s:39:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$\";s:63:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]\";s:56:\"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:51:\"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:32:\"([0-9]{4})/([0-9]{1,2})/embed/?$\";s:58:\"index.php?year=$matches[1]&monthnum=$matches[2]&embed=true\";s:44:\"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]\";s:26:\"([0-9]{4})/([0-9]{1,2})/?$\";s:47:\"index.php?year=$matches[1]&monthnum=$matches[2]\";s:43:\"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:38:\"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:19:\"([0-9]{4})/embed/?$\";s:37:\"index.php?year=$matches[1]&embed=true\";s:31:\"([0-9]{4})/page/?([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&paged=$matches[2]\";s:13:\"([0-9]{4})/?$\";s:26:\"index.php?year=$matches[1]\";s:27:\".?.+?/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\".?.+?/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\".?.+?/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"(.?.+?)/embed/?$\";s:41:\"index.php?pagename=$matches[1]&embed=true\";s:20:\"(.?.+?)/trackback/?$\";s:35:\"index.php?pagename=$matches[1]&tb=1\";s:40:\"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:35:\"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:28:\"(.?.+?)/page/?([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&paged=$matches[2]\";s:35:\"(.?.+?)/comment-page-([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&cpage=$matches[2]\";s:24:\"(.?.+?)(?:/([0-9]+))?/?$\";s:47:\"index.php?pagename=$matches[1]&page=$matches[2]\";s:27:\"[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\"[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\"[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\"[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"([^/]+)/embed/?$\";s:37:\"index.php?name=$matches[1]&embed=true\";s:20:\"([^/]+)/trackback/?$\";s:31:\"index.php?name=$matches[1]&tb=1\";s:40:\"([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?name=$matches[1]&feed=$matches[2]\";s:35:\"([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?name=$matches[1]&feed=$matches[2]\";s:28:\"([^/]+)/page/?([0-9]{1,})/?$\";s:44:\"index.php?name=$matches[1]&paged=$matches[2]\";s:35:\"([^/]+)/comment-page-([0-9]{1,})/?$\";s:44:\"index.php?name=$matches[1]&cpage=$matches[2]\";s:24:\"([^/]+)(?:/([0-9]+))?/?$\";s:43:\"index.php?name=$matches[1]&page=$matches[2]\";s:16:\"[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:26:\"[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:46:\"[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:41:\"[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:41:\"[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:22:\"[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";}', 'yes'),
(30, 'hack_file', '0', 'yes'),
(31, 'blog_charset', 'UTF-8', 'yes'),
(32, 'moderation_keys', '', 'no'),
(33, 'active_plugins', 'a:3:{i:0;s:91:\"all-in-one-wp-migration-unlimited-extension/all-in-one-wp-migration-unlimited-extension.php\";i:1;s:51:\"all-in-one-wp-migration/all-in-one-wp-migration.php\";i:2;s:33:\"classic-editor/classic-editor.php\";}', 'yes'),
(34, 'category_base', '', 'yes'),
(35, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(36, 'comment_max_links', '2', 'yes'),
(37, 'gmt_offset', '0', 'yes'),
(38, 'default_email_category', '1', 'yes'),
(39, 'recently_edited', '', 'no'),
(40, 'template', 'wandercrm', 'yes'),
(41, 'stylesheet', 'wandercrm', 'yes'),
(42, 'comment_registration', '0', 'yes'),
(43, 'html_type', 'text/html', 'yes'),
(44, 'use_trackback', '0', 'yes'),
(45, 'default_role', 'subscriber', 'yes'),
(46, 'db_version', '53496', 'yes'),
(47, 'uploads_use_yearmonth_folders', '1', 'yes'),
(48, 'upload_path', '', 'yes'),
(49, 'blog_public', '1', 'yes'),
(50, 'default_link_category', '2', 'yes'),
(51, 'show_on_front', 'page', 'yes'),
(52, 'tag_base', '', 'yes'),
(53, 'show_avatars', '1', 'yes'),
(54, 'avatar_rating', 'G', 'yes'),
(55, 'upload_url_path', '', 'yes'),
(56, 'thumbnail_size_w', '150', 'yes'),
(57, 'thumbnail_size_h', '150', 'yes'),
(58, 'thumbnail_crop', '1', 'yes'),
(59, 'medium_size_w', '300', 'yes'),
(60, 'medium_size_h', '300', 'yes'),
(61, 'avatar_default', 'mystery', 'yes'),
(62, 'large_size_w', '1024', 'yes'),
(63, 'large_size_h', '1024', 'yes'),
(64, 'image_default_link_type', 'none', 'yes'),
(65, 'image_default_size', '', 'yes'),
(66, 'image_default_align', '', 'yes'),
(67, 'close_comments_for_old_posts', '0', 'yes'),
(68, 'close_comments_days_old', '14', 'yes'),
(69, 'thread_comments', '1', 'yes'),
(70, 'thread_comments_depth', '5', 'yes'),
(71, 'page_comments', '0', 'yes'),
(72, 'comments_per_page', '50', 'yes'),
(73, 'default_comments_page', 'newest', 'yes'),
(74, 'comment_order', 'asc', 'yes'),
(75, 'sticky_posts', 'a:0:{}', 'yes'),
(76, 'widget_categories', 'a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}', 'yes'),
(77, 'widget_text', 'a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}', 'yes'),
(78, 'widget_rss', 'a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}', 'yes'),
(79, 'uninstall_plugins', 'a:0:{}', 'no'),
(80, 'timezone_string', '', 'yes'),
(81, 'page_for_posts', '0', 'yes'),
(82, 'page_on_front', '10', 'yes'),
(83, 'default_post_format', '0', 'yes'),
(84, 'link_manager_enabled', '0', 'yes'),
(85, 'finished_splitting_shared_terms', '1', 'yes'),
(86, 'site_icon', '0', 'yes'),
(87, 'medium_large_size_w', '768', 'yes'),
(88, 'medium_large_size_h', '0', 'yes'),
(89, 'wp_page_for_privacy_policy', '3', 'yes'),
(90, 'show_comments_cookies_opt_in', '1', 'yes'),
(91, 'admin_email_lifespan', '1700458789', 'yes'),
(92, 'disallowed_keys', '', 'no'),
(93, 'comment_previously_approved', '1', 'yes'),
(94, 'auto_plugin_theme_update_emails', 'a:0:{}', 'no'),
(95, 'auto_update_core_dev', 'enabled', 'yes'),
(96, 'auto_update_core_minor', 'enabled', 'yes'),
(97, 'auto_update_core_major', 'enabled', 'yes'),
(98, 'wp_force_deactivated_plugins', 'a:0:{}', 'yes'),
(99, 'initial_db_version', '53496', 'yes'),
(100, 'wp_user_roles', 'a:5:{s:13:\"administrator\";a:2:{s:4:\"name\";s:13:\"Administrator\";s:12:\"capabilities\";a:61:{s:13:\"switch_themes\";b:1;s:11:\"edit_themes\";b:1;s:16:\"activate_plugins\";b:1;s:12:\"edit_plugins\";b:1;s:10:\"edit_users\";b:1;s:10:\"edit_files\";b:1;s:14:\"manage_options\";b:1;s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:6:\"import\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:8:\"level_10\";b:1;s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:12:\"delete_users\";b:1;s:12:\"create_users\";b:1;s:17:\"unfiltered_upload\";b:1;s:14:\"edit_dashboard\";b:1;s:14:\"update_plugins\";b:1;s:14:\"delete_plugins\";b:1;s:15:\"install_plugins\";b:1;s:13:\"update_themes\";b:1;s:14:\"install_themes\";b:1;s:11:\"update_core\";b:1;s:10:\"list_users\";b:1;s:12:\"remove_users\";b:1;s:13:\"promote_users\";b:1;s:18:\"edit_theme_options\";b:1;s:13:\"delete_themes\";b:1;s:6:\"export\";b:1;}}s:6:\"editor\";a:2:{s:4:\"name\";s:6:\"Editor\";s:12:\"capabilities\";a:34:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;}}s:6:\"author\";a:2:{s:4:\"name\";s:6:\"Author\";s:12:\"capabilities\";a:10:{s:12:\"upload_files\";b:1;s:10:\"edit_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;s:22:\"delete_published_posts\";b:1;}}s:11:\"contributor\";a:2:{s:4:\"name\";s:11:\"Contributor\";s:12:\"capabilities\";a:5:{s:10:\"edit_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;}}s:10:\"subscriber\";a:2:{s:4:\"name\";s:10:\"Subscriber\";s:12:\"capabilities\";a:2:{s:4:\"read\";b:1;s:7:\"level_0\";b:1;}}}', 'yes'),
(101, 'fresh_site', '0', 'yes'),
(102, 'user_count', '2', 'no'),
(103, 'widget_block', 'a:6:{i:2;a:1:{s:7:\"content\";s:19:\"<!-- wp:search /-->\";}i:3;a:1:{s:7:\"content\";s:154:\"<!-- wp:group --><div class=\"wp-block-group\"><!-- wp:heading --><h2>Recent Posts</h2><!-- /wp:heading --><!-- wp:latest-posts /--></div><!-- /wp:group -->\";}i:4;a:1:{s:7:\"content\";s:227:\"<!-- wp:group --><div class=\"wp-block-group\"><!-- wp:heading --><h2>Recent Comments</h2><!-- /wp:heading --><!-- wp:latest-comments {\"displayAvatar\":false,\"displayDate\":false,\"displayExcerpt\":false} /--></div><!-- /wp:group -->\";}i:5;a:1:{s:7:\"content\";s:146:\"<!-- wp:group --><div class=\"wp-block-group\"><!-- wp:heading --><h2>Archives</h2><!-- /wp:heading --><!-- wp:archives /--></div><!-- /wp:group -->\";}i:6;a:1:{s:7:\"content\";s:150:\"<!-- wp:group --><div class=\"wp-block-group\"><!-- wp:heading --><h2>Categories</h2><!-- /wp:heading --><!-- wp:categories /--></div><!-- /wp:group -->\";}s:12:\"_multiwidget\";i:1;}', 'yes'),
(104, 'sidebars_widgets', 'a:3:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:5:{i:0;s:7:\"block-2\";i:1;s:7:\"block-3\";i:2;s:7:\"block-4\";i:3;s:7:\"block-5\";i:4;s:7:\"block-6\";}s:13:\"array_version\";i:3;}', 'yes'),
(105, 'cron', 'a:9:{i:1688733590;a:1:{s:34:\"wp_privacy_delete_old_export_files\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"hourly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:3600;}}}i:1688751590;a:4:{s:18:\"wp_https_detection\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:16:\"wp_version_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:17:\"wp_update_plugins\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:16:\"wp_update_themes\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1688751606;a:1:{s:21:\"wp_update_user_counts\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1688794790;a:1:{s:32:\"recovery_mode_clean_expired_keys\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1688794806;a:2:{s:19:\"wp_scheduled_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:25:\"delete_expired_transients\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1688794809;a:1:{s:30:\"wp_scheduled_auto_draft_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1688801482;a:1:{s:21:\"ai1wm_storage_cleanup\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1689226790;a:1:{s:30:\"wp_site_health_scheduled_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"weekly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:604800;}}}s:7:\"version\";i:2;}', 'yes'),
(106, 'widget_pages', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(107, 'widget_calendar', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(108, 'widget_archives', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(109, 'widget_media_audio', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(110, 'widget_media_image', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(111, 'widget_media_gallery', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(112, 'widget_media_video', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(113, 'widget_meta', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(114, 'widget_search', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(115, 'widget_recent-posts', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(116, 'widget_recent-comments', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(117, 'widget_tag_cloud', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(118, 'widget_nav_menu', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(119, 'widget_custom_html', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(121, 'recovery_keys', 'a:0:{}', 'yes'),
(124, 'theme_mods_twentytwentythree', 'a:2:{s:18:\"custom_css_post_id\";i:-1;s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1684907061;s:4:\"data\";a:3:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:3:{i:0;s:7:\"block-2\";i:1;s:7:\"block-3\";i:2;s:7:\"block-4\";}s:9:\"sidebar-2\";a:2:{i:0;s:7:\"block-5\";i:1;s:7:\"block-6\";}}}}', 'yes'),
(127, 'https_detection_errors', 'a:1:{s:23:\"ssl_verification_failed\";a:1:{i:0;s:24:\"SSL verification failed.\";}}', 'yes'),
(141, '_site_transient_update_core', 'O:8:\"stdClass\":4:{s:7:\"updates\";a:1:{i:0;O:8:\"stdClass\":10:{s:8:\"response\";s:6:\"latest\";s:8:\"download\";s:59:\"https://downloads.wordpress.org/release/wordpress-6.2.2.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:59:\"https://downloads.wordpress.org/release/wordpress-6.2.2.zip\";s:10:\"no_content\";s:70:\"https://downloads.wordpress.org/release/wordpress-6.2.2-no-content.zip\";s:11:\"new_bundled\";s:71:\"https://downloads.wordpress.org/release/wordpress-6.2.2-new-bundled.zip\";s:7:\"partial\";s:0:\"\";s:8:\"rollback\";s:0:\"\";}s:7:\"current\";s:5:\"6.2.2\";s:7:\"version\";s:5:\"6.2.2\";s:11:\"php_version\";s:6:\"5.6.20\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"6.1\";s:15:\"partial_version\";s:0:\"\";}}s:12:\"last_checked\";i:1688716602;s:15:\"version_checked\";s:5:\"6.2.2\";s:12:\"translations\";a:0:{}}', 'no'),
(144, 'auto_core_update_notified', 'a:4:{s:4:\"type\";s:7:\"success\";s:5:\"email\";s:20:\"debtapas14@gmail.com\";s:7:\"version\";s:5:\"6.2.2\";s:9:\"timestamp\";i:1684906817;}', 'no'),
(156, 'can_compress_scripts', '1', 'no'),
(163, 'finished_updating_comment_type', '1', 'yes'),
(164, 'current_theme', 'wandercrm', 'yes'),
(165, 'theme_mods_wandercrm', 'a:3:{i:0;b:0;s:18:\"nav_menu_locations\";a:0:{}s:18:\"custom_css_post_id\";i:-1;}', 'yes'),
(166, 'theme_switched', '', 'yes'),
(175, 'recently_activated', 'a:0:{}', 'yes'),
(178, 'category_children', 'a:0:{}', 'yes'),
(193, '_transient_health-check-site-status-result', '{\"good\":15,\"recommended\":4,\"critical\":2}', 'yes'),
(694, 'ai1wm_secret_key', 'X5ZNQkpn11hZ', 'yes'),
(695, 'ai1wmue_plugin_key', '16f1ae1e-5db0-4a5b-9dea-f77c49609379', 'yes'),
(696, 'ai1wm_status', 'a:2:{s:4:\"type\";s:8:\"download\";s:7:\"message\";s:311:\"<a href=\"http://localhost/wandercrm/wp-content/ai1wm-backups/localhost-wandercrm-20230626-072346-obu36x.wpress\" class=\"ai1wm-button-green ai1wm-emphasize ai1wm-button-download\" title=\"localhost\" download=\"localhost-wandercrm-20230626-072346-obu36x.wpress\"><span>Download localhost</span><em>Size: 20 MB</em></a>\";}', 'yes'),
(703, '_site_transient_ai1wm_last_check_for_updates', '1688707785', 'no'),
(704, 'ai1wm_updater', 'a:1:{s:43:\"all-in-one-wp-migration-unlimited-extension\";a:13:{s:4:\"name\";s:19:\"Unlimited Extension\";s:4:\"slug\";s:19:\"unlimited-extension\";s:8:\"homepage\";s:51:\"https://servmask.com/extensions/unlimited-extension\";s:13:\"download_link\";s:29:\"https://servmask.com/purchase\";s:7:\"version\";s:4:\"2.52\";s:6:\"author\";s:8:\"ServMask\";s:15:\"author_homepage\";s:20:\"https://servmask.com\";s:8:\"sections\";a:1:{s:11:\"description\";s:259:\"<ul class=\"description\"><li>Remove the import limit of 512MB</li><li>Lifetime license with lifetime updates</li><li>Use on any number of websites that you own</li><li>Unlimited Extension included</li><li>WP CLI commands</li><li>Premium support</li></ul><br />\";}s:7:\"banners\";a:2:{s:3:\"low\";s:65:\"https://servmask.com/img/products/unlimited-extension-772x250.png\";s:4:\"high\";s:66:\"https://servmask.com/img/products/unlimited-extension-1544x500.png\";}s:5:\"icons\";a:3:{s:2:\"1x\";s:65:\"https://servmask.com/img/products/unlimited-extension-128x128.png\";s:2:\"2x\";s:65:\"https://servmask.com/img/products/unlimited-extension-256x256.png\";s:7:\"default\";s:65:\"https://servmask.com/img/products/unlimited-extension-256x256.png\";}s:6:\"rating\";i:99;s:11:\"num_ratings\";i:309;s:10:\"downloaded\";i:40189;}}', 'yes'),
(825, '_site_transient_timeout_theme_roots', '1688718403', 'no'),
(826, '_site_transient_theme_roots', 'a:4:{s:15:\"twentytwentyone\";s:7:\"/themes\";s:17:\"twentytwentythree\";s:7:\"/themes\";s:15:\"twentytwentytwo\";s:7:\"/themes\";s:9:\"wandercrm\";s:7:\"/themes\";}', 'no'),
(827, '_site_transient_update_themes', 'O:8:\"stdClass\":5:{s:12:\"last_checked\";i:1688716605;s:7:\"checked\";a:4:{s:15:\"twentytwentyone\";s:3:\"1.7\";s:17:\"twentytwentythree\";s:3:\"1.0\";s:15:\"twentytwentytwo\";s:3:\"1.3\";s:9:\"wandercrm\";s:5:\"1.0.0\";}s:8:\"response\";a:3:{s:15:\"twentytwentyone\";a:6:{s:5:\"theme\";s:15:\"twentytwentyone\";s:11:\"new_version\";s:3:\"1.8\";s:3:\"url\";s:45:\"https://wordpress.org/themes/twentytwentyone/\";s:7:\"package\";s:61:\"https://downloads.wordpress.org/theme/twentytwentyone.1.8.zip\";s:8:\"requires\";s:3:\"5.3\";s:12:\"requires_php\";s:3:\"5.6\";}s:17:\"twentytwentythree\";a:6:{s:5:\"theme\";s:17:\"twentytwentythree\";s:11:\"new_version\";s:3:\"1.1\";s:3:\"url\";s:47:\"https://wordpress.org/themes/twentytwentythree/\";s:7:\"package\";s:63:\"https://downloads.wordpress.org/theme/twentytwentythree.1.1.zip\";s:8:\"requires\";s:3:\"6.1\";s:12:\"requires_php\";s:3:\"5.6\";}s:15:\"twentytwentytwo\";a:6:{s:5:\"theme\";s:15:\"twentytwentytwo\";s:11:\"new_version\";s:3:\"1.4\";s:3:\"url\";s:45:\"https://wordpress.org/themes/twentytwentytwo/\";s:7:\"package\";s:61:\"https://downloads.wordpress.org/theme/twentytwentytwo.1.4.zip\";s:8:\"requires\";s:3:\"5.9\";s:12:\"requires_php\";s:3:\"5.6\";}}s:9:\"no_update\";a:0:{}s:12:\"translations\";a:0:{}}', 'no'),
(828, '_site_transient_update_plugins', 'O:8:\"stdClass\":5:{s:12:\"last_checked\";i:1688716607;s:8:\"response\";a:2:{s:19:\"akismet/akismet.php\";O:8:\"stdClass\":12:{s:2:\"id\";s:21:\"w.org/plugins/akismet\";s:4:\"slug\";s:7:\"akismet\";s:6:\"plugin\";s:19:\"akismet/akismet.php\";s:11:\"new_version\";s:3:\"5.2\";s:3:\"url\";s:38:\"https://wordpress.org/plugins/akismet/\";s:7:\"package\";s:54:\"https://downloads.wordpress.org/plugin/akismet.5.2.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:60:\"https://ps.w.org/akismet/assets/icon-256x256.png?rev=2818463\";s:2:\"1x\";s:60:\"https://ps.w.org/akismet/assets/icon-128x128.png?rev=2818463\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:63:\"https://ps.w.org/akismet/assets/banner-1544x500.png?rev=2900731\";s:2:\"1x\";s:62:\"https://ps.w.org/akismet/assets/banner-772x250.png?rev=2900731\";}s:11:\"banners_rtl\";a:0:{}s:8:\"requires\";s:3:\"5.8\";s:6:\"tested\";s:5:\"6.2.2\";s:12:\"requires_php\";s:6:\"5.6.20\";}s:51:\"all-in-one-wp-migration/all-in-one-wp-migration.php\";O:8:\"stdClass\":12:{s:2:\"id\";s:37:\"w.org/plugins/all-in-one-wp-migration\";s:4:\"slug\";s:23:\"all-in-one-wp-migration\";s:6:\"plugin\";s:51:\"all-in-one-wp-migration/all-in-one-wp-migration.php\";s:11:\"new_version\";s:4:\"7.76\";s:3:\"url\";s:54:\"https://wordpress.org/plugins/all-in-one-wp-migration/\";s:7:\"package\";s:71:\"https://downloads.wordpress.org/plugin/all-in-one-wp-migration.7.76.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:76:\"https://ps.w.org/all-in-one-wp-migration/assets/icon-256x256.png?rev=2458334\";s:2:\"1x\";s:76:\"https://ps.w.org/all-in-one-wp-migration/assets/icon-128x128.png?rev=2458334\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:79:\"https://ps.w.org/all-in-one-wp-migration/assets/banner-1544x500.png?rev=2902233\";s:2:\"1x\";s:78:\"https://ps.w.org/all-in-one-wp-migration/assets/banner-772x250.png?rev=2902233\";}s:11:\"banners_rtl\";a:0:{}s:8:\"requires\";s:3:\"3.3\";s:6:\"tested\";s:5:\"6.2.2\";s:12:\"requires_php\";s:3:\"5.3\";}}s:12:\"translations\";a:0:{}s:9:\"no_update\";a:2:{s:33:\"classic-editor/classic-editor.php\";O:8:\"stdClass\":10:{s:2:\"id\";s:28:\"w.org/plugins/classic-editor\";s:4:\"slug\";s:14:\"classic-editor\";s:6:\"plugin\";s:33:\"classic-editor/classic-editor.php\";s:11:\"new_version\";s:5:\"1.6.3\";s:3:\"url\";s:45:\"https://wordpress.org/plugins/classic-editor/\";s:7:\"package\";s:63:\"https://downloads.wordpress.org/plugin/classic-editor.1.6.3.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:67:\"https://ps.w.org/classic-editor/assets/icon-256x256.png?rev=1998671\";s:2:\"1x\";s:67:\"https://ps.w.org/classic-editor/assets/icon-128x128.png?rev=1998671\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:70:\"https://ps.w.org/classic-editor/assets/banner-1544x500.png?rev=1998671\";s:2:\"1x\";s:69:\"https://ps.w.org/classic-editor/assets/banner-772x250.png?rev=1998676\";}s:11:\"banners_rtl\";a:0:{}s:8:\"requires\";s:3:\"4.9\";}s:9:\"hello.php\";O:8:\"stdClass\":10:{s:2:\"id\";s:25:\"w.org/plugins/hello-dolly\";s:4:\"slug\";s:11:\"hello-dolly\";s:6:\"plugin\";s:9:\"hello.php\";s:11:\"new_version\";s:5:\"1.7.2\";s:3:\"url\";s:42:\"https://wordpress.org/plugins/hello-dolly/\";s:7:\"package\";s:60:\"https://downloads.wordpress.org/plugin/hello-dolly.1.7.2.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:64:\"https://ps.w.org/hello-dolly/assets/icon-256x256.jpg?rev=2052855\";s:2:\"1x\";s:64:\"https://ps.w.org/hello-dolly/assets/icon-128x128.jpg?rev=2052855\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:67:\"https://ps.w.org/hello-dolly/assets/banner-1544x500.jpg?rev=2645582\";s:2:\"1x\";s:66:\"https://ps.w.org/hello-dolly/assets/banner-772x250.jpg?rev=2052855\";}s:11:\"banners_rtl\";a:0:{}s:8:\"requires\";s:3:\"4.6\";}}s:7:\"checked\";a:5:{s:19:\"akismet/akismet.php\";s:5:\"5.0.1\";s:51:\"all-in-one-wp-migration/all-in-one-wp-migration.php\";s:4:\"7.75\";s:91:\"all-in-one-wp-migration-unlimited-extension/all-in-one-wp-migration-unlimited-extension.php\";s:4:\"2.51\";s:33:\"classic-editor/classic-editor.php\";s:5:\"1.6.3\";s:9:\"hello.php\";s:5:\"1.7.2\";}}', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `wp_postmeta`
--

CREATE TABLE `wp_postmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_postmeta`
--

INSERT INTO `wp_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1, 2, '_wp_page_template', 'default'),
(2, 3, '_wp_page_template', 'default'),
(3, 5, '_edit_lock', '1684915002:1'),
(4, 5, '_edit_last', '1'),
(5, 5, '_wp_page_template', 'template-parts/login.php'),
(7, 10, '_edit_last', '1'),
(8, 10, '_wp_page_template', 'default'),
(9, 10, '_edit_lock', '1684920284:1'),
(14, 13, '_edit_last', '1'),
(15, 13, '_wp_page_template', 'template-parts/dashboard.php'),
(16, 13, '_edit_lock', '1685009636:1'),
(17, 15, '_edit_last', '1'),
(18, 15, '_wp_page_template', 'template-parts/create-invoice.php'),
(19, 15, '_edit_lock', '1685009530:1'),
(20, 17, '_edit_last', '1'),
(21, 17, '_edit_lock', '1685009844:1'),
(22, 17, '_wp_page_template', 'default'),
(23, 19, '_edit_last', '1'),
(24, 19, '_edit_lock', '1685010950:1'),
(25, 19, '_wp_page_template', 'template-parts/invoice-list.php'),
(26, 22, '_edit_lock', '1686051852:1'),
(27, 22, '_edit_last', '1'),
(28, 22, '_wp_page_template', 'template-parts/pdf-invoice.php'),
(29, 17, '_wp_trash_meta_status', 'publish'),
(30, 17, '_wp_trash_meta_time', '1687251902'),
(31, 17, '_wp_desired_post_slug', 'edit-invoice'),
(32, 27, '_edit_last', '1'),
(33, 27, '_wp_page_template', 'template-parts/create-receipt.php'),
(34, 27, '_edit_lock', '1687257013:1'),
(35, 29, '_edit_lock', '1687262193:1'),
(36, 29, '_edit_last', '1'),
(37, 29, '_wp_page_template', 'template-parts/receipt-list.php');

-- --------------------------------------------------------

--
-- Table structure for table `wp_posts`
--

CREATE TABLE `wp_posts` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `post_author` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(255) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext NOT NULL,
  `post_parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT 0,
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_posts`
--

INSERT INTO `wp_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(1, 1, '2023-05-24 05:39:49', '2023-05-24 05:39:49', '<!-- wp:paragraph -->\n<p>Welcome to WordPress. This is your first post. Edit or delete it, then start writing!</p>\n<!-- /wp:paragraph -->', 'Hello world!', '', 'publish', 'open', 'open', '', 'hello-world', '', '', '2023-05-24 05:39:49', '2023-05-24 05:39:49', '', 0, 'http://localhost/wandercrm/?p=1', 0, 'post', '', 1),
(2, 1, '2023-05-24 05:39:49', '2023-05-24 05:39:49', '<!-- wp:paragraph -->\n<p>This is an example page. It\'s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\"><p>Hi there! I\'m a bike messenger by day, aspiring actor by night, and this is my website. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin\' caught in the rain.)</p></blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>...or something like this:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\"><p>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</p></blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>As a new WordPress user, you should go to <a href=\"http://localhost/wandercrm/wp-admin/\">your dashboard</a> to delete this page and create new pages for your content. Have fun!</p>\n<!-- /wp:paragraph -->', 'Sample Page', '', 'publish', 'closed', 'open', '', 'sample-page', '', '', '2023-05-24 05:39:49', '2023-05-24 05:39:49', '', 0, 'http://localhost/wandercrm/?page_id=2', 0, 'page', '', 0),
(3, 1, '2023-05-24 05:39:49', '2023-05-24 05:39:49', '<!-- wp:heading --><h2>Who we are</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>Our website address is: http://localhost/wandercrm.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Comments</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>When visitors leave comments on the site we collect the data shown in the comments form, and also the visitor&#8217;s IP address and browser user agent string to help spam detection.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>An anonymized string created from your email address (also called a hash) may be provided to the Gravatar service to see if you are using it. The Gravatar service privacy policy is available here: https://automattic.com/privacy/. After approval of your comment, your profile picture is visible to the public in the context of your comment.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Media</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>If you upload images to the website, you should avoid uploading images with embedded location data (EXIF GPS) included. Visitors to the website can download and extract any location data from images on the website.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Cookies</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>If you leave a comment on our site you may opt-in to saving your name, email address and website in cookies. These are for your convenience so that you do not have to fill in your details again when you leave another comment. These cookies will last for one year.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>If you visit our login page, we will set a temporary cookie to determine if your browser accepts cookies. This cookie contains no personal data and is discarded when you close your browser.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>When you log in, we will also set up several cookies to save your login information and your screen display choices. Login cookies last for two days, and screen options cookies last for a year. If you select &quot;Remember Me&quot;, your login will persist for two weeks. If you log out of your account, the login cookies will be removed.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>If you edit or publish an article, an additional cookie will be saved in your browser. This cookie includes no personal data and simply indicates the post ID of the article you just edited. It expires after 1 day.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Embedded content from other websites</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>Articles on this site may include embedded content (e.g. videos, images, articles, etc.). Embedded content from other websites behaves in the exact same way as if the visitor has visited the other website.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>These websites may collect data about you, use cookies, embed additional third-party tracking, and monitor your interaction with that embedded content, including tracking your interaction with the embedded content if you have an account and are logged in to that website.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Who we share your data with</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>If you request a password reset, your IP address will be included in the reset email.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>How long we retain your data</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>If you leave a comment, the comment and its metadata are retained indefinitely. This is so we can recognize and approve any follow-up comments automatically instead of holding them in a moderation queue.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>For users that register on our website (if any), we also store the personal information they provide in their user profile. All users can see, edit, or delete their personal information at any time (except they cannot change their username). Website administrators can also see and edit that information.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>What rights you have over your data</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>If you have an account on this site, or have left comments, you can request to receive an exported file of the personal data we hold about you, including any data you have provided to us. You can also request that we erase any personal data we hold about you. This does not include any data we are obliged to keep for administrative, legal, or security purposes.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Where your data is sent</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>Visitor comments may be checked through an automated spam detection service.</p><!-- /wp:paragraph -->', 'Privacy Policy', '', 'draft', 'closed', 'open', '', 'privacy-policy', '', '', '2023-05-24 05:39:49', '2023-05-24 05:39:49', '', 0, 'http://localhost/wandercrm/?page_id=3', 0, 'page', '', 0),
(5, 1, '2023-05-24 05:41:04', '2023-05-24 05:41:04', '', 'Login', '', 'publish', 'closed', 'closed', '', 'login', '', '', '2023-05-24 06:21:55', '2023-05-24 06:21:55', '', 0, 'http://localhost/wandercrm/?page_id=5', 0, 'page', '', 0),
(6, 1, '2023-05-24 05:40:57', '2023-05-24 05:40:57', '{\"version\": 2, \"isGlobalStylesUserThemeJSON\": true }', 'Custom Styles', '', 'publish', 'closed', 'closed', '', 'wp-global-styles-twentytwentythree', '', '', '2023-05-24 05:40:57', '2023-05-24 05:40:57', '', 0, 'http://localhost/wandercrm/2023/05/24/wp-global-styles-twentytwentythree/', 0, 'wp_global_styles', '', 0),
(7, 1, '2023-05-24 05:41:04', '2023-05-24 05:41:04', '', 'Login', '', 'inherit', 'closed', 'closed', '', '5-revision-v1', '', '', '2023-05-24 05:41:04', '2023-05-24 05:41:04', '', 5, 'http://localhost/wandercrm/?p=7', 0, 'revision', '', 0),
(10, 1, '2023-05-24 09:10:48', '2023-05-24 09:10:48', '', 'Home', '', 'publish', 'closed', 'closed', '', 'home', '', '', '2023-05-24 09:10:48', '2023-05-24 09:10:48', '', 0, 'http://localhost/wandercrm/?page_id=10', 0, 'page', '', 0),
(11, 1, '2023-05-24 09:10:48', '2023-05-24 09:10:48', '', 'Home', '', 'inherit', 'closed', 'closed', '', '10-revision-v1', '', '', '2023-05-24 09:10:48', '2023-05-24 09:10:48', '', 10, 'http://localhost/wandercrm/?p=11', 0, 'revision', '', 0),
(13, 1, '2023-05-24 09:29:45', '2023-05-24 09:29:45', '', 'Dashboard', '', 'publish', 'closed', 'closed', '', 'dashboard', '', '', '2023-05-24 09:31:48', '2023-05-24 09:31:48', '', 0, 'http://localhost/wandercrm/?page_id=13', 0, 'page', '', 0),
(14, 1, '2023-05-24 09:29:45', '2023-05-24 09:29:45', '', 'Dashboard', '', 'inherit', 'closed', 'closed', '', '13-revision-v1', '', '', '2023-05-24 09:29:45', '2023-05-24 09:29:45', '', 13, 'http://localhost/wandercrm/?p=14', 0, 'revision', '', 0),
(15, 1, '2023-05-25 07:02:12', '2023-05-25 07:02:12', '', 'Create Invoice', '', 'publish', 'closed', 'closed', '', 'create-invoice', '', '', '2023-05-25 07:02:12', '2023-05-25 07:02:12', '', 0, 'http://localhost/wandercrm/?page_id=15', 0, 'page', '', 0),
(16, 1, '2023-05-25 07:02:12', '2023-05-25 07:02:12', '', 'Create Invoice', '', 'inherit', 'closed', 'closed', '', '15-revision-v1', '', '', '2023-05-25 07:02:12', '2023-05-25 07:02:12', '', 15, 'http://localhost/wandercrm/?p=16', 0, 'revision', '', 0),
(17, 1, '2023-05-25 08:20:28', '2023-05-25 08:20:28', '', 'Edit Invoice', '', 'trash', 'closed', 'closed', '', 'edit-invoice__trashed', '', '', '2023-06-20 09:05:02', '2023-06-20 09:05:02', '', 0, 'http://localhost/wandercrm/?page_id=17', 0, 'page', '', 0),
(18, 1, '2023-05-25 08:20:28', '2023-05-25 08:20:28', '', 'Edit Invoice', '', 'inherit', 'closed', 'closed', '', '17-revision-v1', '', '', '2023-05-25 08:20:28', '2023-05-25 08:20:28', '', 17, 'http://localhost/wandercrm/?p=18', 0, 'revision', '', 0),
(19, 1, '2023-05-25 10:20:18', '2023-05-25 10:20:18', '', 'Invoice List', '', 'publish', 'closed', 'closed', '', 'invoice-list', '', '', '2023-05-25 10:21:24', '2023-05-25 10:21:24', '', 0, 'http://localhost/wandercrm/?page_id=19', 0, 'page', '', 0),
(20, 1, '2023-05-25 10:20:18', '2023-05-25 10:20:18', '', 'Invoice List', '', 'inherit', 'closed', 'closed', '', '19-revision-v1', '', '', '2023-05-25 10:20:18', '2023-05-25 10:20:18', '', 19, 'http://localhost/wandercrm/?p=20', 0, 'revision', '', 0),
(22, 1, '2023-06-06 06:49:13', '2023-06-06 06:49:13', '', 'PDF Invoice', '', 'publish', 'closed', 'closed', '', 'pdf-invoice', '', '', '2023-06-06 06:50:18', '2023-06-06 06:50:18', '', 0, 'http://localhost/wandercrm/?page_id=22', 0, 'page', '', 0),
(23, 1, '2023-06-06 06:49:13', '2023-06-06 06:49:13', '', 'PDF Invoice', '', 'inherit', 'closed', 'closed', '', '22-revision-v1', '', '', '2023-06-06 06:49:13', '2023-06-06 06:49:13', '', 22, 'http://localhost/wandercrm/?p=23', 0, 'revision', '', 0),
(27, 1, '2023-06-20 09:05:23', '2023-06-20 09:05:23', '', 'Create Receipt', '', 'publish', 'closed', 'closed', '', 'create-receipt', '', '', '2023-06-20 09:33:13', '2023-06-20 09:33:13', '', 0, 'http://localhost/wandercrm/?page_id=27', 0, 'page', '', 0),
(28, 1, '2023-06-20 09:05:23', '2023-06-20 09:05:23', '', 'Create Receipt', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2023-06-20 09:05:23', '2023-06-20 09:05:23', '', 27, 'http://localhost/wandercrm/?p=28', 0, 'revision', '', 0),
(29, 1, '2023-06-20 10:32:47', '2023-06-20 10:32:47', '', 'Receipt List', '', 'publish', 'closed', 'closed', '', 'receipt-list', '', '', '2023-06-20 10:32:53', '2023-06-20 10:32:53', '', 0, 'http://localhost/wandercrm/?page_id=29', 0, 'page', '', 0),
(30, 1, '2023-06-20 10:32:47', '2023-06-20 10:32:47', '', 'Receipt List', '', 'inherit', 'closed', 'closed', '', '29-revision-v1', '', '', '2023-06-20 10:32:47', '2023-06-20 10:32:47', '', 29, 'http://localhost/wandercrm/?p=30', 0, 'revision', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_receipt`
--

CREATE TABLE `wp_receipt` (
  `ID` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `receipt_no` bigint(20) NOT NULL,
  `client_name` varchar(200) NOT NULL,
  `amount` int(20) NOT NULL,
  `reference` varchar(200) NOT NULL,
  `receipt_date` varchar(20) NOT NULL,
  `transaction_date` varchar(20) NOT NULL,
  `packages` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wp_receipt`
--

INSERT INTO `wp_receipt` (`ID`, `user_id`, `receipt_no`, `client_name`, `amount`, `reference`, `receipt_date`, `transaction_date`, `packages`) VALUES
(2, 2, 450, 'Maurice D. Slattery', 12564, 'Kotak Bank', '2023-06-25', '2023-06-24', 'Purulia tour'),
(3, 2, 1001, 'Maurice D. Slattery', 246574, 'Andhra Bank', '2023-06-22', '2023-06-23', 'North East Tour'),
(4, 2, 1002, 'Rosa R. Phillips', 75456, 'Andhra Bank', '2023-06-27', '2023-06-22', 'Nepal Tour and exploration');

-- --------------------------------------------------------

--
-- Table structure for table `wp_termmeta`
--

CREATE TABLE `wp_termmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_terms`
--

CREATE TABLE `wp_terms` (
  `term_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_terms`
--

INSERT INTO `wp_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'Uncategorized', 'uncategorized', 0),
(2, 'twentytwentythree', 'twentytwentythree', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_relationships`
--

CREATE TABLE `wp_term_relationships` (
  `object_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `term_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_term_relationships`
--

INSERT INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 1, 0),
(6, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_taxonomy`
--

CREATE TABLE `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `count` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_term_taxonomy`
--

INSERT INTO `wp_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 1),
(2, 2, 'wp_theme', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wp_usermeta`
--

CREATE TABLE `wp_usermeta` (
  `umeta_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_usermeta`
--

INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'nickname', 'wandercrm'),
(2, 1, 'first_name', ''),
(3, 1, 'last_name', ''),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'syntax_highlighting', 'true'),
(7, 1, 'comment_shortcuts', 'false'),
(8, 1, 'admin_color', 'fresh'),
(9, 1, 'use_ssl', '0'),
(10, 1, 'show_admin_bar_front', 'true'),
(11, 1, 'locale', ''),
(12, 1, 'wp_capabilities', 'a:1:{s:13:\"administrator\";b:1;}'),
(13, 1, 'wp_user_level', '10'),
(14, 1, 'dismissed_wp_pointers', ''),
(15, 1, 'show_welcome_panel', '1'),
(17, 1, 'wp_dashboard_quick_press_last_post_id', '31'),
(18, 1, 'community-events-location', 'a:1:{s:2:\"ip\";s:9:\"127.0.0.0\";}'),
(19, 1, 'wp_persisted_preferences', 'a:2:{s:14:\"core/edit-post\";a:3:{s:26:\"isComplementaryAreaVisible\";b:1;s:12:\"welcomeGuide\";b:0;s:10:\"openPanels\";a:3:{i:0;s:11:\"post-status\";i:1;s:16:\"discussion-panel\";i:2;s:15:\"page-attributes\";}}s:9:\"_modified\";s:24:\"2023-05-24T06:20:29.268Z\";}'),
(20, 2, 'nickname', 'adventure'),
(21, 2, 'first_name', 'Wander'),
(22, 2, 'last_name', 'Adventure'),
(23, 2, 'description', ''),
(24, 2, 'rich_editing', 'true'),
(25, 2, 'syntax_highlighting', 'true'),
(26, 2, 'comment_shortcuts', 'false'),
(27, 2, 'admin_color', 'fresh'),
(28, 2, 'use_ssl', '0'),
(29, 2, 'show_admin_bar_front', 'false'),
(30, 2, 'locale', ''),
(31, 2, 'wp_capabilities', 'a:1:{s:6:\"author\";b:1;}'),
(32, 2, 'wp_user_level', '2'),
(33, 2, 'dismissed_wp_pointers', ''),
(35, 2, 'wp_dashboard_quick_press_last_post_id', '25'),
(36, 1, 'session_tokens', 'a:1:{s:64:\"dfdb2ea993b6456f0e9fb7f0a7731b930b0b175234fc98973c25eaecf24b84fa\";a:4:{s:10:\"expiration\";i:1688279022;s:2:\"ip\";s:9:\"127.0.0.1\";s:2:\"ua\";s:80:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/114.0\";s:5:\"login\";i:1688106222;}}'),
(39, 2, 'session_tokens', 'a:1:{s:64:\"5ecef99484a8cba4bb053eea92340d80c4b14b83f572b5581c1b893dba691d07\";a:4:{s:10:\"expiration\";i:1689917397;s:2:\"ip\";s:9:\"127.0.0.1\";s:2:\"ua\";s:80:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/114.0\";s:5:\"login\";i:1688707797;}}');

-- --------------------------------------------------------

--
-- Table structure for table `wp_users`
--

CREATE TABLE `wp_users` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(255) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT 0,
  `display_name` varchar(250) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_users`
--

INSERT INTO `wp_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'wandercrm', '$P$BLkCCPIj5pK3CDaPJhkaBHSGmYjH9p.', 'wandercrm', 'debtapas14@gmail.com', 'http://localhost/wandercrm', '2023-05-24 05:39:49', '', 0, 'wandercrm'),
(2, 'adventure', '$P$BEIwJiOdh/uptNMmGegWQnHiwqeDrz.', 'adventure', 'adventure@gmail.com', '', '2023-05-27 06:28:40', '1685168921:$P$BSgNhBmdyUmpwOuSMeYWLG3k1aUiGM1', 0, 'Wander Adventure');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wp_commentmeta`
--
ALTER TABLE `wp_commentmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_comments`
--
ALTER TABLE `wp_comments`
  ADD PRIMARY KEY (`comment_ID`),
  ADD KEY `comment_post_ID` (`comment_post_ID`),
  ADD KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  ADD KEY `comment_date_gmt` (`comment_date_gmt`),
  ADD KEY `comment_parent` (`comment_parent`),
  ADD KEY `comment_author_email` (`comment_author_email`(10));

--
-- Indexes for table `wp_invoice`
--
ALTER TABLE `wp_invoice`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `wp_invoice_items`
--
ALTER TABLE `wp_invoice_items`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `wp_links`
--
ALTER TABLE `wp_links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `link_visible` (`link_visible`);

--
-- Indexes for table `wp_options`
--
ALTER TABLE `wp_options`
  ADD PRIMARY KEY (`option_id`),
  ADD UNIQUE KEY `option_name` (`option_name`),
  ADD KEY `autoload` (`autoload`);

--
-- Indexes for table `wp_postmeta`
--
ALTER TABLE `wp_postmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_posts`
--
ALTER TABLE `wp_posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `post_name` (`post_name`(191)),
  ADD KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  ADD KEY `post_parent` (`post_parent`),
  ADD KEY `post_author` (`post_author`);

--
-- Indexes for table `wp_receipt`
--
ALTER TABLE `wp_receipt`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `wp_termmeta`
--
ALTER TABLE `wp_termmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `term_id` (`term_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_terms`
--
ALTER TABLE `wp_terms`
  ADD PRIMARY KEY (`term_id`),
  ADD KEY `slug` (`slug`(191)),
  ADD KEY `name` (`name`(191));

--
-- Indexes for table `wp_term_relationships`
--
ALTER TABLE `wp_term_relationships`
  ADD PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  ADD KEY `term_taxonomy_id` (`term_taxonomy_id`);

--
-- Indexes for table `wp_term_taxonomy`
--
ALTER TABLE `wp_term_taxonomy`
  ADD PRIMARY KEY (`term_taxonomy_id`),
  ADD UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  ADD KEY `taxonomy` (`taxonomy`);

--
-- Indexes for table `wp_usermeta`
--
ALTER TABLE `wp_usermeta`
  ADD PRIMARY KEY (`umeta_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_users`
--
ALTER TABLE `wp_users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_login_key` (`user_login`),
  ADD KEY `user_nicename` (`user_nicename`),
  ADD KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wp_commentmeta`
--
ALTER TABLE `wp_commentmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_comments`
--
ALTER TABLE `wp_comments`
  MODIFY `comment_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wp_invoice`
--
ALTER TABLE `wp_invoice`
  MODIFY `ID` bigint(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `wp_invoice_items`
--
ALTER TABLE `wp_invoice_items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `wp_links`
--
ALTER TABLE `wp_links`
  MODIFY `link_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_options`
--
ALTER TABLE `wp_options`
  MODIFY `option_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=833;

--
-- AUTO_INCREMENT for table `wp_postmeta`
--
ALTER TABLE `wp_postmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `wp_posts`
--
ALTER TABLE `wp_posts`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `wp_receipt`
--
ALTER TABLE `wp_receipt`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wp_termmeta`
--
ALTER TABLE `wp_termmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_terms`
--
ALTER TABLE `wp_terms`
  MODIFY `term_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wp_term_taxonomy`
--
ALTER TABLE `wp_term_taxonomy`
  MODIFY `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wp_usermeta`
--
ALTER TABLE `wp_usermeta`
  MODIFY `umeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `wp_users`
--
ALTER TABLE `wp_users`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
