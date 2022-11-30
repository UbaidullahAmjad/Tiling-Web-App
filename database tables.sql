-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 27, 2022 at 12:46 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `german_tiles`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `phone`, `photo`, `role_id`, `password`, `email_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '01629552892', '1631023655pexels-moose-photos-1036627.jpg', 0, '$2a$12$nKdv.0E4uEbH93pp1tQQHOvoQNfUzLINScyAmLH0Tau2RLDJX3g62', NULL, '2018-02-28 23:27:08', '2021-12-04 05:04:55'),
(2, 'test', 'test@gmail.com', '09000000', 'BhTv1584160189Brooklyn99-310x310.jpg', 1, '$2y$10$cl6qNdVuAhzJyaaLACVxGOQhlYf7n/UgLrwW0vx9QDGlZyKGM97mm', NULL, '2021-12-05 10:24:50', '2021-12-05 10:24:50');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

DROP TABLE IF EXISTS `attributes`;
CREATE TABLE IF NOT EXISTS `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abbrivation` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `abbrivation`, `created_at`, `updated_at`) VALUES
(117, 'square meter', 'm²', NULL, NULL),
(118, 'Liter', 'liter', NULL, NULL),
(119, 'Piece', 'piece', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attribute_options`
--

DROP TABLE IF EXISTS `attribute_options`;
CREATE TABLE IF NOT EXISTS `attribute_options` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `attribute_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stock` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'unlimited',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `length` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `broad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` bigint(20) DEFAULT NULL,
  `item_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `material` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `used` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `format` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surface` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight_per_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `box_contains` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frost_resistance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `synonyms` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `variable_quantity` float DEFAULT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute_options_item_id_foreign` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1296 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_options`
--

INSERT INTO `attribute_options` (`id`, `attribute_id`, `name`, `price`, `created_at`, `updated_at`, `stock`, `image`, `description`, `length`, `height`, `broad`, `quantity`, `item_number`, `material`, `used`, `format`, `surface`, `edge`, `weight_per_unit`, `box_contains`, `frost_resistance`, `synonyms`, `variable_quantity`, `item_id`) VALUES
(1286, 117, NULL, 80, NULL, NULL, 'unlimited', '16506243252.jpg', '<p>sdsdggsdgdgd</p>', '4', '7', '9', NULL, '888', NULL, 'trt', 'rrt', 'dfdf', 'dfds', '67', 'dfd', 'fsdfdf', 'dsfsfsdf', 3, 615),
(1287, 117, NULL, 39, NULL, NULL, 'unlimited', '16506400482.jpg', 'ertryrytwtwetwrter', '2', '5', '9', NULL, '666', NULL, 'trt', 'sdf', 'dfdf', 'dfds', '67', 'dfd', 'fsdfdf', 'dsfsfsdf', 3, 615),
(1290, 117, NULL, 45, NULL, NULL, 'unlimited', '16506426093.jpg', '<p>rwetretreyerytry</p>', '3', '5', '7', NULL, '777', NULL, '56', 'regre', 'ery', 'ety', '45', 'tyty', 'tyt', 'tyty', 3, 614),
(1291, 117, NULL, 450, NULL, NULL, 'unlimited', '165092406840,6x61,0x3,0m².png.png', '<p>teest</p>', '30', '60', '2', 14, '0456', NULL, 'insideee', '30x60x2', 'plain', 'rounded', '10', '10', 'none', 'none', 1.5, 691),
(1293, 117, '60x60x1', 10, '2022-04-15 06:28:18', '2022-04-22 06:28:18', '50', NULL, 'test', '60', '60', '1', 50, '015601', 'green', 'outsideee', '60x60x1', 'irregular', 'rounded', '5', '10', 'no', 'no', 2.5, 691);

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `subtitle`, `url`, `image`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Shein Womens Clothing 2021 Summer Fashion Design Clothing Manufacturer Lantern Long Sleeve', '45% OFF', '#', '163172091306.jpg', ' Banner 1', 1, NULL, NULL),
(2, 'Casual Minimalist Tie Waist women clothing Denim Halter Midi Pencil Sling Dresses', '70% OFF', '#', '163172090805.jpg', 'Banner 2', 1, NULL, NULL),
(3, 'Top Sale High Quality Newest Designs Custom Women Clothing Wholesale from China Dresses', '60% OFF', '#', '163172090304.jpg', 'Banner 3', 1, NULL, NULL),
(5, '2021 Summer Women Clothing Ropa Sexy Lady Cut Out Halter Mini Dresses', '50% OFF', '#', '163172089704.jpg', 'Banner 4', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bcategories`
--

DROP TABLE IF EXISTS `bcategories`;
CREATE TABLE IF NOT EXISTS `bcategories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bcategories`
--

INSERT INTO `bcategories` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Beauty', 'Beauty', 1, NULL, NULL),
(2, 'Fashion', 'fashion', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `is_popular` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `campaign_items`
--

DROP TABLE IF EXISTS `campaign_items`;
CREATE TABLE IF NOT EXISTS `campaign_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT '1',
  `is_feature` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_descriptions` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) DEFAULT '1',
  `is_feature` tinyint(4) DEFAULT '1',
  `serial` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `second_description` text COLLATE utf8mb4_unicode_ci,
  `second_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `second_short_description` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `photo`, `meta_keywords`, `meta_descriptions`, `status`, `is_feature`, `serial`, `created_at`, `updated_at`, `description`, `title`, `sub_title`, `short_description`, `second_description`, `second_title`, `second_short_description`) VALUES
(28, 'Tiles', 'Tiles', 'pV47tiles.jpg', NULL, 'Sed eu corporis expl', 1, 1, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'Floor Tiles', 'floor-tiles', '1651062513Moderne-Natursteinfliesen-Travertin.jpg', NULL, NULL, 1, 1, 10, NULL, NULL, NULL, 'Floor Tiles', NULL, NULL, NULL, NULL, NULL),
(40, 'Wall Tiles', 'wall-tiles', '1651062546unAxYrpb.jpg', NULL, NULL, 1, 1, 10, NULL, NULL, NULL, 'Wall Tiles', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_images`
--

DROP TABLE IF EXISTS `category_images`;
CREATE TABLE IF NOT EXISTS `category_images` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_images_category_id_foreign` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chield_categories`
--

DROP TABLE IF EXISTS `chield_categories`;
CREATE TABLE IF NOT EXISTS `chield_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', NULL, NULL),
(2, 'Albania', NULL, NULL),
(3, 'Algeria', NULL, NULL),
(4, 'American Samoa', NULL, NULL),
(5, 'Andorra', NULL, NULL),
(6, 'Angola', NULL, NULL),
(7, 'Anguilla', NULL, NULL),
(8, 'Antarctica', NULL, NULL),
(9, 'Antigua and Barbuda', NULL, NULL),
(10, 'Argentina', NULL, NULL),
(11, 'Armenia', NULL, NULL),
(12, 'Aruba', NULL, NULL),
(13, 'Australia', NULL, NULL),
(14, 'Austria', NULL, NULL),
(15, 'Azerbaijan', NULL, NULL),
(16, 'Bahamas', NULL, NULL),
(17, 'Bahrain', NULL, NULL),
(18, 'Bangladesh', NULL, NULL),
(19, 'Barbados', NULL, NULL),
(20, 'Belarus', NULL, NULL),
(21, 'Belgium', NULL, NULL),
(22, 'Belize', NULL, NULL),
(23, 'Benin', NULL, NULL),
(24, 'Bermuda', NULL, NULL),
(25, 'Bhutan', NULL, NULL),
(26, 'Bolivia', NULL, NULL),
(27, 'Bosnia and Herzegovina', NULL, NULL),
(28, 'Botswana', NULL, NULL),
(29, 'Bouvet Island', NULL, NULL),
(30, 'Brazil', NULL, NULL),
(31, 'British Indian Ocean Territory', NULL, NULL),
(32, 'Brunei Darussalam', NULL, NULL),
(33, 'Bulgaria', NULL, NULL),
(34, 'Burkina Faso', NULL, NULL),
(35, 'Burundi', NULL, NULL),
(36, 'Cambodia', NULL, NULL),
(37, 'Cameroon', NULL, NULL),
(38, 'Canada', NULL, NULL),
(39, 'Cape Verde', NULL, NULL),
(40, 'Cayman Islands', NULL, NULL),
(41, 'Central African Republic', NULL, NULL),
(42, 'Chad', NULL, NULL),
(43, 'Chile', NULL, NULL),
(44, 'China', NULL, NULL),
(45, 'Christmas Island', NULL, NULL),
(46, 'Cocos (Keeling) Islands', NULL, NULL),
(47, 'Colombia', NULL, NULL),
(48, 'Comoros', NULL, NULL),
(49, 'Democratic Republic of the Congo', NULL, NULL),
(50, 'Republic of Congo', NULL, NULL),
(51, 'Cook Islands', NULL, NULL),
(52, 'Costa Rica', NULL, NULL),
(53, 'Croatia (Hrvatska)', NULL, NULL),
(54, 'Cuba', NULL, NULL),
(55, 'Cyprus', NULL, NULL),
(56, 'Czech Republic', NULL, NULL),
(57, 'Denmark', NULL, NULL),
(58, 'Djibouti', NULL, NULL),
(59, 'Dominica', NULL, NULL),
(60, 'Dominican Republic', NULL, NULL),
(61, 'East Timor', NULL, NULL),
(62, 'Ecuador', NULL, NULL),
(63, 'Egypt', NULL, NULL),
(64, 'El Salvador', NULL, NULL),
(65, 'Equatorial Guinea', NULL, NULL),
(66, 'Eritrea', NULL, NULL),
(67, 'Estonia', NULL, NULL),
(68, 'Ethiopia', NULL, NULL),
(69, 'Falkland Islands (Malvinas)', NULL, NULL),
(70, 'Faroe Islands', NULL, NULL),
(71, 'Fiji', NULL, NULL),
(72, 'Finland', NULL, NULL),
(73, 'France', NULL, NULL),
(74, 'France, Metropolitan', NULL, NULL),
(75, 'French Guiana', NULL, NULL),
(76, 'French Polynesia', NULL, NULL),
(77, 'French Southern Territories', NULL, NULL),
(78, 'Gabon', NULL, NULL),
(79, 'Gambia', NULL, NULL),
(80, 'Georgia', NULL, NULL),
(81, 'Germany', NULL, NULL),
(82, 'Ghana', NULL, NULL),
(83, 'Gibraltar', NULL, NULL),
(84, 'Guernsey', NULL, NULL),
(85, 'Greece', NULL, NULL),
(86, 'Greenland', NULL, NULL),
(87, 'Grenada', NULL, NULL),
(88, 'Guadeloupe', NULL, NULL),
(89, 'Guam', NULL, NULL),
(90, 'Guatemala', NULL, NULL),
(91, 'Guinea', NULL, NULL),
(92, 'Guinea-Bissau', NULL, NULL),
(93, 'Guyana', NULL, NULL),
(94, 'Haiti', NULL, NULL),
(95, 'Heard and Mc Donald Islands', NULL, NULL),
(96, 'Honduras', NULL, NULL),
(97, 'Hong Kong', NULL, NULL),
(98, 'Hungary', NULL, NULL),
(99, 'Iceland', NULL, NULL),
(100, 'India', NULL, NULL),
(101, 'Isle of Man', NULL, NULL),
(102, 'Indonesia', NULL, NULL),
(103, 'Iran (Islamic Republic of)', NULL, NULL),
(104, 'Iraq', NULL, NULL),
(105, 'Ireland', NULL, NULL),
(106, 'Israel', NULL, NULL),
(107, 'Italy', NULL, NULL),
(108, 'Ivory Coast', NULL, NULL),
(109, 'Jersey', NULL, NULL),
(110, 'Jamaica', NULL, NULL),
(111, 'Japan', NULL, NULL),
(112, 'Jordan', NULL, NULL),
(113, 'Kazakhstan', NULL, NULL),
(114, 'Kenya', NULL, NULL),
(115, 'Kiribati', NULL, NULL),
(116, 'Korea, Democratic People\'s Republic of', NULL, NULL),
(118, 'Kosovo', NULL, NULL),
(119, 'Kuwait', NULL, NULL),
(120, 'Kyrgyzstan', NULL, NULL),
(121, 'Lao People\'s Democratic Republic', NULL, NULL),
(122, 'Latvia', NULL, NULL),
(123, 'Lebanon', NULL, NULL),
(124, 'Lesotho', NULL, NULL),
(125, 'Liberia', NULL, NULL),
(126, 'Libyan Arab Jamahiriya', NULL, NULL),
(127, 'Liechtenstein', NULL, NULL),
(128, 'Lithuania', NULL, NULL),
(129, 'Luxembourg', NULL, NULL),
(130, 'Macau', NULL, NULL),
(131, 'North Macedonia', NULL, NULL),
(132, 'Madagascar', NULL, NULL),
(133, 'Malawi', NULL, NULL),
(134, 'Malaysia', NULL, NULL),
(135, 'Maldives', NULL, NULL),
(136, 'Mali', NULL, NULL),
(137, 'Malta', NULL, NULL),
(138, 'Marshall Islands', NULL, NULL),
(139, 'Martinique', NULL, NULL),
(140, 'Mauritania', NULL, NULL),
(141, 'Mauritius', NULL, NULL),
(142, 'Mayotte', NULL, NULL),
(143, 'Mexico', NULL, NULL),
(144, 'Micronesia, Federated States of', NULL, NULL),
(145, 'Moldova, Republic of', NULL, NULL),
(146, 'Monaco', NULL, NULL),
(147, 'Mongolia', NULL, NULL),
(148, 'Montenegro', NULL, NULL),
(149, 'Montserrat', NULL, NULL),
(150, 'Morocco', NULL, NULL),
(151, 'Mozambique', NULL, NULL),
(152, 'Myanmar', NULL, NULL),
(153, 'Namibia', NULL, NULL),
(154, 'Nauru', NULL, NULL),
(155, 'Nepal', NULL, NULL),
(156, 'Netherlands', NULL, NULL),
(157, 'Netherlands Antilles', NULL, NULL),
(158, 'New Caledonia', NULL, NULL),
(159, 'New Zealand', NULL, NULL),
(160, 'Nicaragua', NULL, NULL),
(161, 'Niger', NULL, NULL),
(162, 'Nigeria', NULL, NULL),
(163, 'Niue', NULL, NULL),
(164, 'Norfolk Island', NULL, NULL),
(165, 'Northern Mariana Islands', NULL, NULL),
(166, 'Norway', NULL, NULL),
(167, 'Oman', NULL, NULL),
(168, 'Pakistan', NULL, NULL),
(169, 'Palau', NULL, NULL),
(170, 'Palestine', NULL, NULL),
(171, 'Panama', NULL, NULL),
(172, 'Papua New Guinea', NULL, NULL),
(173, 'Paraguay', NULL, NULL),
(174, 'Peru', NULL, NULL),
(175, 'Philippines', NULL, NULL),
(176, 'Pitcairn', NULL, NULL),
(177, 'Poland', NULL, NULL),
(178, 'Portugal', NULL, NULL),
(179, 'Puerto Rico', NULL, NULL),
(180, 'Qatar', NULL, NULL),
(181, 'Reunion', NULL, NULL),
(182, 'Romania', NULL, NULL),
(183, 'Russian Federation', NULL, NULL),
(184, 'Rwanda', NULL, NULL),
(185, 'Saint Kitts and Nevis', NULL, NULL),
(186, 'Saint Lucia', NULL, NULL),
(187, 'Saint Vincent and the Grenadines', NULL, NULL),
(188, 'Samoa', NULL, NULL),
(189, 'San Marino', NULL, NULL),
(190, 'Sao Tome and Principe', NULL, NULL),
(191, 'Saudi Arabia', NULL, NULL),
(192, 'Senegal', NULL, NULL),
(193, 'Serbia', NULL, NULL),
(194, 'Seychelles', NULL, NULL),
(195, 'Sierra Leone', NULL, NULL),
(196, 'Singapore', NULL, NULL),
(197, 'Slovakia', NULL, NULL),
(198, 'Slovenia', NULL, NULL),
(199, 'Solomon Islands', NULL, NULL),
(200, 'Somalia', NULL, NULL),
(201, 'South Africa', NULL, NULL),
(202, 'South Georgia South Sandwich Islands', NULL, NULL),
(203, 'South Sudan', NULL, NULL),
(204, 'Spain', NULL, NULL),
(205, 'Sri Lanka', NULL, NULL),
(206, 'St. Helena', NULL, NULL),
(207, 'St. Pierre and Miquelon', NULL, NULL),
(208, 'Sudan', NULL, NULL),
(209, 'Suriname', NULL, NULL),
(210, 'Svalbard and Jan Mayen Islands', NULL, NULL),
(211, 'Swaziland', NULL, NULL),
(212, 'Sweden', NULL, NULL),
(213, 'Switzerland', NULL, NULL),
(214, 'Syrian Arab Republic', NULL, NULL),
(215, 'Taiwan', NULL, NULL),
(216, 'Tajikistan', NULL, NULL),
(217, 'Tanzania, United Republic of', NULL, NULL),
(218, 'Thailand', NULL, NULL),
(219, 'Togo', NULL, NULL),
(220, 'Tokelau', NULL, NULL),
(221, 'Tonga', NULL, NULL),
(222, 'Trinidad and Tobago', NULL, NULL),
(223, 'Tunisia', NULL, NULL),
(224, 'Turkey', NULL, NULL),
(225, 'Turkmenistan', NULL, NULL),
(226, 'Turks and Caicos Islands', NULL, NULL),
(227, 'Tuvalu', NULL, NULL),
(228, 'Uganda', NULL, NULL),
(229, 'Ukraine', NULL, NULL),
(230, 'United Arab Emirates', NULL, NULL),
(231, 'United Kingdom', NULL, NULL),
(232, 'United States', NULL, NULL),
(233, 'United States minor outlying islands', NULL, NULL),
(234, 'Uruguay', NULL, NULL),
(235, 'Uzbekistan', NULL, NULL),
(236, 'Vanuatu', NULL, NULL),
(237, 'Vatican City State', NULL, NULL),
(238, 'Venezuela', NULL, NULL),
(239, 'Vietnam', NULL, NULL),
(240, 'Virgin Islands (British)', NULL, NULL),
(241, 'Virgin Islands (U.S.)', NULL, NULL),
(242, 'Wallis and Futuna Islands', NULL, NULL),
(243, 'Western Sahara', NULL, NULL),
(244, 'Yemen', NULL, NULL),
(245, 'Zambia', NULL, NULL),
(246, 'Zimbabwe', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
CREATE TABLE IF NOT EXISTS `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` double DEFAULT NULL,
  `is_default` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `sign`, `value`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'USD', '$', 1, 1, NULL, NULL),
(6, 'EUR', '€', 0.89, 0, NULL, NULL),
(7, 'INR', '₹', 74, 0, NULL, NULL),
(8, 'BDT', '৳', 84, 0, NULL, NULL),
(9, 'NGN', '₦', 411, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci,
  `body` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `type`, `subject`, `body`, `created_at`, `updated_at`) VALUES
(1, 'Order', 'Your Have Successfully Placed The Order', '<p>Hello {user_name},</p><p>Your Order Has Been Placed Successfilly.<br>Your Order Number is {transaction_number}.<br></p>', NULL, NULL),
(2, 'Registration', 'Welcome To Magicshop', '<p>Hello&nbsp; {user_name},</p><p>You have successfully registered to {website_title}, We wish you will have a wonderful experience using our service.</p><p>Thank You.<br></p>', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `extra_settings`
--

DROP TABLE IF EXISTS `extra_settings`;
CREATE TABLE IF NOT EXISTS `extra_settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `is_t4_slider` tinyint(4) DEFAULT '1',
  `is_t4_featured_banner` tinyint(4) DEFAULT '1',
  `is_t4_specialpick` tinyint(4) DEFAULT '1',
  `is_t4_3_column_banner_first` tinyint(4) DEFAULT '1',
  `is_t4_flashdeal` tinyint(4) DEFAULT '1',
  `is_t4_3_column_banner_second` tinyint(4) DEFAULT '1',
  `is_t4_popular_category` tinyint(4) DEFAULT '1',
  `is_t4_2_column_banner` tinyint(4) DEFAULT '1',
  `is_t4_blog_section` tinyint(4) DEFAULT '1',
  `is_t4_brand_section` tinyint(4) DEFAULT '1',
  `is_t4_service_section` tinyint(4) DEFAULT '1',
  `is_t3_slider` tinyint(4) DEFAULT '1',
  `is_t3_service_section` tinyint(4) DEFAULT '1',
  `is_t3_3_column_banner_first` tinyint(4) DEFAULT '1',
  `is_t3_popular_category` tinyint(4) DEFAULT '1',
  `is_t3_flashdeal` tinyint(4) DEFAULT '1',
  `is_t3_3_column_banner_second` tinyint(4) DEFAULT '1',
  `is_t3_pecialpick` tinyint(4) DEFAULT '1',
  `is_t3_brand_section` tinyint(4) DEFAULT '1',
  `is_t3_2_column_banner` tinyint(4) DEFAULT '1',
  `is_t3_blog_section` tinyint(4) DEFAULT '1',
  `is_t2_slider` tinyint(4) DEFAULT '1',
  `is_t2_service_section` tinyint(4) DEFAULT '1',
  `is_t2_3_column_banner_first` tinyint(4) DEFAULT '1',
  `is_t2_flashdeal` tinyint(4) DEFAULT '1',
  `is_t2_new_product` tinyint(4) DEFAULT '1',
  `is_t2_3_column_banner_second` tinyint(4) DEFAULT '1',
  `is_t2_featured_product` tinyint(4) DEFAULT '1',
  `is_t2_bestseller_product` tinyint(4) DEFAULT '1',
  `is_t2_toprated_product` tinyint(4) DEFAULT '1',
  `is_t2_2_column_banner` tinyint(4) DEFAULT '1',
  `is_t2_blog_section` tinyint(4) DEFAULT '1',
  `is_t2_brand_section` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_t1_falsh` tinyint(4) DEFAULT '1',
  `is_t2_falsh` tinyint(4) DEFAULT '1',
  `is_t3_falsh` tinyint(4) DEFAULT '1',
  `is_t4_falsh` tinyint(4) DEFAULT '1',
  `is_t2_three_column_category` tinyint(4) DEFAULT '1',
  `is_t3_three_column_category` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extra_settings`
--

INSERT INTO `extra_settings` (`id`, `is_t4_slider`, `is_t4_featured_banner`, `is_t4_specialpick`, `is_t4_3_column_banner_first`, `is_t4_flashdeal`, `is_t4_3_column_banner_second`, `is_t4_popular_category`, `is_t4_2_column_banner`, `is_t4_blog_section`, `is_t4_brand_section`, `is_t4_service_section`, `is_t3_slider`, `is_t3_service_section`, `is_t3_3_column_banner_first`, `is_t3_popular_category`, `is_t3_flashdeal`, `is_t3_3_column_banner_second`, `is_t3_pecialpick`, `is_t3_brand_section`, `is_t3_2_column_banner`, `is_t3_blog_section`, `is_t2_slider`, `is_t2_service_section`, `is_t2_3_column_banner_first`, `is_t2_flashdeal`, `is_t2_new_product`, `is_t2_3_column_banner_second`, `is_t2_featured_product`, `is_t2_bestseller_product`, `is_t2_toprated_product`, `is_t2_2_column_banner`, `is_t2_blog_section`, `is_t2_brand_section`, `created_at`, `updated_at`, `is_t1_falsh`, `is_t2_falsh`, `is_t3_falsh`, `is_t4_falsh`, `is_t2_three_column_category`, `is_t3_three_column_category`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
CREATE TABLE IF NOT EXISTS `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_descriptions` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `category_id`, `title`, `details`, `meta_keywords`, `meta_descriptions`, `created_at`, `updated_at`) VALUES
(15, 1, 'How can I purchase it ?', 'Voluptatibus enim, aut natus sint porro veniam atque obcaecati ullam, consequatur laboriosam laborum corrupti autem fugit', NULL, NULL, NULL, NULL),
(25, 1, 'Anim pariatur cliche reprehenderit ?', 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\'t heard of them accusamus.', NULL, NULL, NULL, NULL),
(27, 1, 'Smartphones in Every Day Life ?', 'afdads', '[{\"value\":\"ad\"},{\"value\":\"fd\"}]', 'dfa', NULL, NULL),
(28, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing  ?', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, NULL, NULL, NULL),
(29, 3, 'But I must explain to you how all this mistaken idea ?', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, cons', NULL, NULL, NULL, NULL),
(30, 3, 'Where does it come from ?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.', NULL, NULL, NULL, NULL),
(31, 4, 'Where can I get some ?', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.', NULL, NULL, NULL, NULL),
(32, 4, 'Why do we use it?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', NULL, NULL, NULL, NULL),
(33, 4, 'Where can I get some?', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', NULL, NULL, NULL, NULL),
(34, 4, 'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', NULL, NULL, NULL, NULL),
(35, 5, 'Where can I get some?', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', NULL, NULL, NULL, NULL),
(36, 5, 'Why do we use it?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', NULL, NULL, NULL, NULL),
(37, 5, 'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', NULL, NULL, NULL, NULL),
(38, 6, 'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', NULL, NULL, NULL, NULL),
(39, 6, 'Why do we use it?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', NULL, NULL, NULL, NULL),
(40, 6, 'Where can I get some?', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', NULL, NULL, NULL, NULL),
(41, 7, 'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', NULL, NULL, NULL, NULL),
(42, 7, 'Why do we use it?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', NULL, NULL, NULL, NULL),
(43, 7, 'Where can I get some?', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fcategories`
--

DROP TABLE IF EXISTS `fcategories`;
CREATE TABLE IF NOT EXISTS `fcategories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_descriptions` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fcategories`
--

INSERT INTO `fcategories` (`id`, `name`, `text`, `slug`, `meta_keywords`, `meta_descriptions`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Electronics !', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born', 'Electronics-', NULL, NULL, 1, NULL, NULL),
(3, 'Poroduct Delevery !', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born', 'Poroduct-Delevery-', '[{\"value\":\"a\"},{\"value\":\"b\"},{\"value\":\"c\"}]', 'It is a long established fact that a r', 1, NULL, NULL),
(4, 'Discount Policy !', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born', 'Discount-Policy-', NULL, NULL, 1, NULL, NULL),
(5, 'Vat Information !', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born', 'Vat-Information-', NULL, NULL, 1, NULL, NULL),
(6, 'Coupon  Information !', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born', 'Coupon--Information-', NULL, NULL, 1, NULL, NULL),
(7, 'Offer Information !', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born', 'Offer-Information-', NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
CREATE TABLE IF NOT EXISTS `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=391 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `item_id`, `photo`, `created_at`, `updated_at`) VALUES
(1, 587, '1634490507Hcc2445bfd070462089ea573816837100j.jpg', NULL, NULL),
(2, 587, '1634490507Hd47c5c350c3f44839b7573930fe5ab4dX.jpg', NULL, NULL),
(3, 587, '1634490507Hf086ae681630461684ced251f8fb5206P.jpg', NULL, NULL),
(4, 525, '1634490530Hcc2445bfd070462089ea573816837100j.jpg', NULL, NULL),
(5, 525, '1634490530Hd47c5c350c3f44839b7573930fe5ab4dX.jpg', NULL, NULL),
(6, 525, '1634490530Hf086ae681630461684ced251f8fb5206P.jpg', NULL, NULL),
(7, 535, '1634490542Hcc2445bfd070462089ea573816837100j.jpg', NULL, NULL),
(8, 535, '1634490542Hd47c5c350c3f44839b7573930fe5ab4dX.jpg', NULL, NULL),
(9, 535, '1634490542Hf086ae681630461684ced251f8fb5206P.jpg', NULL, NULL),
(10, 534, '1634490554Hcc2445bfd070462089ea573816837100j.jpg', NULL, NULL),
(11, 534, '1634490554Hd47c5c350c3f44839b7573930fe5ab4dX.jpg', NULL, NULL),
(12, 534, '1634490554Hf086ae681630461684ced251f8fb5206P.jpg', NULL, NULL),
(13, 532, '1634490565Hcc2445bfd070462089ea573816837100j.jpg', NULL, NULL),
(14, 532, '1634490565Hd47c5c350c3f44839b7573930fe5ab4dX.jpg', NULL, NULL),
(15, 532, '1634490565Hf086ae681630461684ced251f8fb5206P.jpg', NULL, NULL),
(16, 529, '1634490585Hcc2445bfd070462089ea573816837100j.jpg', NULL, NULL),
(17, 529, '1634490585Hd47c5c350c3f44839b7573930fe5ab4dX.jpg', NULL, NULL),
(18, 529, '1634490585Hf086ae681630461684ced251f8fb5206P.jpg', NULL, NULL),
(19, 586, '1634490597Hcc2445bfd070462089ea573816837100j.jpg', NULL, NULL),
(20, 586, '1634490597Hd47c5c350c3f44839b7573930fe5ab4dX.jpg', NULL, NULL),
(21, 586, '1634490597Hf086ae681630461684ced251f8fb5206P.jpg', NULL, NULL),
(22, 563, '1634490619Haeebad0b0907432897c3ee27adc13ef48.jpg', NULL, NULL),
(23, 563, '1634490619Hdb695965a744470b958f17251d4d277ew.jpg', NULL, NULL),
(24, 563, '1634490619Hedf90cf6656546e7a8548d4980edc5bda.jpg', NULL, NULL),
(25, 562, '1634490633Haeebad0b0907432897c3ee27adc13ef48.jpg', NULL, NULL),
(26, 562, '1634490633Hdb695965a744470b958f17251d4d277ew.jpg', NULL, NULL),
(27, 562, '1634490633Hedf90cf6656546e7a8548d4980edc5bda.jpg', NULL, NULL),
(28, 545, '1634490675H349db6b6a70c4604b507c446a7b06ae5k.jpg', NULL, NULL),
(29, 545, '1634490675HTB1BqH4aIfrK1RkSmLyq6xGApXaJ.jpg', NULL, NULL),
(30, 545, '1634490675U02280db692c8449a91b8886b5a9f043fI.jpg', NULL, NULL),
(31, 543, '1634490719H220c85b541d145789e167a4b23787dd5h.jpg', NULL, NULL),
(32, 543, '1634490719Ha04a8a2d450544c9a80996bcdd70c543b.jpg', NULL, NULL),
(33, 543, '1634490719Hcb62dec2d6a241fc90ce2bb04059684em.jpg', NULL, NULL),
(34, 540, '1634490735H220c85b541d145789e167a4b23787dd5h.jpg', NULL, NULL),
(35, 540, '1634490735H624bc94495584b2384c07e2db9f2bdfcd.jpg', NULL, NULL),
(36, 540, '1634490735Ha04a8a2d450544c9a80996bcdd70c543b.jpg', NULL, NULL),
(37, 541, '1634490748H220c85b541d145789e167a4b23787dd5h.jpg', NULL, NULL),
(38, 541, '1634490748H624bc94495584b2384c07e2db9f2bdfcd.jpg', NULL, NULL),
(39, 541, '1634490748Hcb62dec2d6a241fc90ce2bb04059684em.jpg', NULL, NULL),
(40, 561, '1634490779H8fb00d2318bd48048dcd8bf2546f3f52h.jpg', NULL, NULL),
(41, 561, '1634490779H206d1d68ce2440ada7b7bc6dfb6354a8p.jpg', NULL, NULL),
(42, 561, '1634490779Hedf90cf6656546e7a8548d4980edc5bda.jpg', NULL, NULL),
(43, 524, '1634490804Hcc2445bfd070462089ea573816837100j.jpg', NULL, NULL),
(44, 524, '1634490804Hd47c5c350c3f44839b7573930fe5ab4dX.jpg', NULL, NULL),
(45, 524, '1634490804Hf086ae681630461684ced251f8fb5206P.jpg', NULL, NULL),
(46, 542, '1634490838H624bc94495584b2384c07e2db9f2bdfcd.jpg', NULL, NULL),
(47, 542, '1634490838Ha04a8a2d450544c9a80996bcdd70c543b.jpg', NULL, NULL),
(48, 542, '1634490838Hcb62dec2d6a241fc90ce2bb04059684em.jpg', NULL, NULL),
(55, 575, '1634491031Uc343eca8de2c490eab3930b8f60827379.png', NULL, NULL),
(56, 575, '1634491031Ucc4d26e9889041dc899c3522859ed3f88.jpg', NULL, NULL),
(57, 575, '1634491031Ucdd42554b97a4e159ea958eeb2d4363f8.jpg', NULL, NULL),
(58, 577, '1634491052Hf435248807dd438aaf4d8a53e6f7eaedP.jpg', NULL, NULL),
(59, 577, '1634491052U32feef72859d4a018dc33710b3647992j.jpg', NULL, NULL),
(60, 577, '1634491052U4431f054a85341a5a36101d8df36f90a7.jpg', NULL, NULL),
(61, 582, '1634491069HTB1HSCEe25G3KVjSZPxq6zI3XXao.jpg', NULL, NULL),
(62, 582, '1634491069HTB1K4CyX6DuK1Rjy1zjq6zraFXaj.jpg', NULL, NULL),
(63, 582, '1634491069HTB1ymRhXfjsK1Rjy1Xaq6zispXad.jpg', NULL, NULL),
(64, 585, '1634491082H6e71ffd70a134245aaab2261bf685508j.jpg', NULL, NULL),
(65, 585, '1634491082H1575ae72d5e144cfbf237196d6ea139bj.jpg', NULL, NULL),
(66, 585, '1634491082H8064fa369ca644958a52846035a40641p.jpg', NULL, NULL),
(67, 581, '1634491092HTB1HSCEe25G3KVjSZPxq6zI3XXao.jpg', NULL, NULL),
(68, 581, '1634491092HTB1K4CyX6DuK1Rjy1zjq6zraFXaj.jpg', NULL, NULL),
(69, 581, '1634491092HTB1ymRhXfjsK1Rjy1Xaq6zispXad.jpg', NULL, NULL),
(79, 523, 'bZ7iScreenshot 2021-11-23 at 10.31.36 PM.png', NULL, NULL),
(81, 598, 'n3Lw39.jpg', NULL, NULL),
(269, 667, 'photo-1575255597430-eba71bc85bc9.avif', NULL, NULL),
(270, 667, 'photo-1580398562556-d33329a0f29b.avif', NULL, NULL),
(271, 667, 'photo-1613096061311-9a839e855a3f.avif', NULL, NULL),
(272, 668, 'photo-1559644705-15d30e582900.avif', NULL, NULL),
(273, 668, 'photo-1559644705-9d56b56e1380.avif', NULL, NULL),
(274, 668, 'photo-1573504816327-07f3bf7accac.avif', NULL, NULL),
(275, 669, 'photo-1548967199-79324abbe7dc.avif', NULL, NULL),
(276, 669, 'photo-1550820946-1c6f7b8e2030.avif', NULL, NULL),
(277, 669, 'photo-1622363405079-da46534ce5ec.avif', NULL, NULL),
(337, 690, 'photo-1575255597430-eba71bc85bc9.avif', NULL, NULL),
(338, 690, 'photo-1580398562556-d33329a0f29b.avif', NULL, NULL),
(339, 690, 'photo-1613096061311-9a839e855a3f.avif', NULL, NULL),
(340, 691, 'photo-1559644705-15d30e582900.avif', NULL, NULL),
(341, 691, 'photo-1559644705-9d56b56e1380.avif', NULL, NULL),
(342, 691, 'photo-1573504816327-07f3bf7accac.avif', NULL, NULL),
(343, 692, 'photo-1548967199-79324abbe7dc.avif', NULL, NULL),
(344, 692, 'photo-1550820946-1c6f7b8e2030.avif', NULL, NULL),
(345, 692, 'photo-1622363405079-da46534ce5ec.avif', NULL, NULL),
(346, 694, 'photo-1575255597430-eba71bc85bc9.avif', NULL, NULL),
(347, 694, 'photo-1580398562556-d33329a0f29b.avif', NULL, NULL),
(348, 694, 'photo-1613096061311-9a839e855a3f.avif', NULL, NULL),
(349, 695, 'photo-1559644705-15d30e582900.avif', NULL, NULL),
(350, 695, 'photo-1559644705-9d56b56e1380.avif', NULL, NULL),
(351, 695, 'photo-1573504816327-07f3bf7accac.avif', NULL, NULL),
(352, 696, 'photo-1548967199-79324abbe7dc.avif', NULL, NULL),
(353, 696, 'photo-1550820946-1c6f7b8e2030.avif', NULL, NULL),
(354, 696, 'photo-1622363405079-da46534ce5ec.avif', NULL, NULL),
(355, 697, 'photo-1575255597430-eba71bc85bc9.avif', NULL, NULL),
(356, 697, 'photo-1580398562556-d33329a0f29b.avif', NULL, NULL),
(357, 697, 'photo-1613096061311-9a839e855a3f.avif', NULL, NULL),
(358, 698, 'photo-1559644705-15d30e582900.avif', NULL, NULL),
(359, 698, 'photo-1559644705-9d56b56e1380.avif', NULL, NULL),
(360, 698, 'photo-1573504816327-07f3bf7accac.avif', NULL, NULL),
(361, 699, 'photo-1548967199-79324abbe7dc.avif', NULL, NULL),
(362, 699, 'photo-1550820946-1c6f7b8e2030.avif', NULL, NULL),
(363, 699, 'photo-1622363405079-da46534ce5ec.avif', NULL, NULL),
(373, 703, 'photo-1575255597430-eba71bc85bc9.avif', NULL, NULL),
(374, 703, 'photo-1580398562556-d33329a0f29b.avif', NULL, NULL),
(375, 703, 'photo-1613096061311-9a839e855a3f.avif', NULL, NULL),
(376, 704, 'photo-1559644705-15d30e582900.avif', NULL, NULL),
(377, 704, 'photo-1559644705-9d56b56e1380.avif', NULL, NULL),
(378, 704, 'photo-1573504816327-07f3bf7accac.avif', NULL, NULL),
(379, 705, 'photo-1548967199-79324abbe7dc.avif', NULL, NULL),
(380, 705, 'photo-1550820946-1c6f7b8e2030.avif', NULL, NULL),
(381, 705, 'photo-1622363405079-da46534ce5ec.avif', NULL, NULL),
(382, 706, 'photo-1548967199-79324abbe7dc.avif', NULL, NULL),
(383, 706, 'photo-1550820946-1c6f7b8e2030.avif', NULL, NULL),
(384, 706, 'photo-1622363405079-da46534ce5ec.avif', NULL, NULL),
(385, 707, 'photo-1548967199-79324abbe7dc.avif', NULL, NULL),
(386, 707, 'photo-1550820946-1c6f7b8e2030.avif', NULL, NULL),
(387, 707, 'photo-1622363405079-da46534ce5ec.avif', NULL, NULL),
(388, 708, 'photo-1548967199-79324abbe7dc.avif', NULL, NULL),
(389, 708, 'photo-1550820946-1c6f7b8e2030.avif', NULL, NULL),
(390, 708, 'photo-1622363405079-da46534ce5ec.avif', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `home_cutomizes`
--

DROP TABLE IF EXISTS `home_cutomizes`;
CREATE TABLE IF NOT EXISTS `home_cutomizes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `banner_first` text COLLATE utf8mb4_unicode_ci,
  `banner_secend` text COLLATE utf8mb4_unicode_ci,
  `banner_third` text COLLATE utf8mb4_unicode_ci,
  `popular_category` text COLLATE utf8mb4_unicode_ci,
  `two_column_category` text COLLATE utf8mb4_unicode_ci,
  `feature_category` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `home_page4` text COLLATE utf8mb4_unicode_ci,
  `home_4_popular_category` text COLLATE utf8mb4_unicode_ci,
  `hero_banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '''[]''',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_cutomizes`
--

INSERT INTO `home_cutomizes` (`id`, `banner_first`, `banner_secend`, `banner_third`, `popular_category`, `two_column_category`, `feature_category`, `created_at`, `updated_at`, `home_page4`, `home_4_popular_category`, `hero_banner`) VALUES
(1, '{\"title1\":\"Watch\",\"subtitle1\":\"50% OFF\",\"firsturl1\":\"#\",\"title2\":\"Drone\",\"subtitle2\":\"40% OFF\",\"firsturl2\":\"#\",\"title3\":\"Phone\",\"subtitle3\":\"30% OFF\",\"firsturl3\":\"#\",\"img1\":\"16365336391.jpg\",\"img2\":\"16365336392.jpg\",\"img3\":\"16365336393.jpg\"}', '{\"title1\":\"Watch\",\"subtitle1\":\"50% OFF\",\"url1\":\"#\",\"title2\":\"Man\",\"subtitle2\":\"40% OFF\",\"url2\":\"#\",\"title3\":\"Headphone\",\"subtitle3\":\"60% OFF\",\"url3\":\"#\",\"img1\":\"16365342794.jpg\",\"img2\":\"16365342795.jpg\",\"img3\":\"16365342796.jpg\"}', '{\"title1\":\"Watch\",\"subtitle1\":\"50% OFF\",\"url1\":\"#\",\"title2\":\"Headphones\",\"subtitle2\":\"40% OFF\",\"url2\":\"#\",\"img1\":\"1636534291b22.jpg\",\"img2\":\"1636534291b11.jpg\"}', '{\"popular_title\":\"Popular Categories\",\"category_id1\":\"18\",\"subcategory_id1\":\"6\",\"childcategory_id1\":null,\"category_id2\":\"19\",\"subcategory_id2\":null,\"childcategory_id2\":null,\"category_id3\":\"21\",\"subcategory_id3\":null,\"childcategory_id3\":null,\"category_id4\":\"22\",\"subcategory_id4\":null,\"childcategory_id4\":null}', '{\"category_id1\":\"27\",\"subcategory_id1\":null,\"childcategory_id1\":null,\"category_id2\":\"22\",\"subcategory_id2\":null,\"childcategory_id2\":null,\"category_id3\":\"21\",\"subcategory_id3\":null,\"childcategory_id3\":null}', '{\"feature_title\":\"Featured Categories\",\"category_id1\":\"18\",\"subcategory_id1\":null,\"childcategory_id1\":null,\"category_id2\":\"27\",\"subcategory_id2\":null,\"childcategory_id2\":null,\"category_id3\":\"21\",\"subcategory_id3\":null,\"childcategory_id3\":null,\"category_id4\":\"22\",\"subcategory_id4\":null,\"childcategory_id4\":null}', NULL, NULL, '{\"label1\":\"FORMAL\",\"url1\":\"#\",\"label2\":\"LIMITEN EDITION\",\"url2\":\"#\",\"label3\":\"WOMEN\'S COLLECTION\",\"url3\":\"#\",\"label4\":\"SMART CASUALS\",\"url4\":\"#\",\"label5\":\"POLO\",\"url5\":\"#\",\"img1\":\"16368975771.jpg\",\"img2\":\"16368975772.jpg\",\"img3\":\"16368975773.jpg\",\"img4\":\"16368975774.jpg\",\"img5\":\"16368975775.jpg\"}', '[\"18\",\"19\",\"21\",\"27\"]', '{\"title1\":\"Watch\",\"subtitle1\":\"50% OFF\",\"url1\":\"#\",\"title2\":\"Man\",\"subtitle2\":\"40% OFF\",\"url2\":\"#\",\"img1\":\"ONMF222.jpg\",\"img2\":\"24gX1111.jpg\"}');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT '0',
  `subcategory_id` int(11) DEFAULT '0',
  `warehouse_id` int(11) DEFAULT '0',
  `name` text COLLATE utf8mb4_unicode_ci,
  `min_quantity` float DEFAULT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci,
  `product_features` text COLLATE utf8mb4_unicode_ci,
  `product_description` text COLLATE utf8mb4_unicode_ci,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) DEFAULT '1',
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=709 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `category_id`, `subcategory_id`, `warehouse_id`, `name`, `min_quantity`, `slug`, `sku`, `tags`, `product_features`, `product_description`, `photo`, `meta_keywords`, `meta_description`, `status`, `thumbnail`, `item_type`, `created_at`, `updated_at`) VALUES
(598, 28, NULL, 2, 'Tumbled Beige', 9.36, 'Tumbled-Beige', 'mKMrYQ9KYu', 'Tiles', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', '<p><strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</span><br></p>', '1650439735train-4703167_960_720.jpg', '', NULL, 1, 'tDYOglSi.jpg', 'normal', '2022-04-13 17:26:28', '2022-04-20 02:28:56'),
(599, 28, 33, 0, 'Stone Wall Texture', NULL, 'Stone-Wall-Texture', 'hHmn4fvvbs', '', 'Stone-Wall-Texture Travertine Tiles', '<p>Stone-Wall-Texture Travertine Tiles<br></p>', '1649871058istockphoto-881376458-612x612.jpg', '', NULL, 1, 'jmUQvSoL.jpg', 'normal', '2022-04-13 17:30:58', '2022-04-13 17:30:58'),
(600, 28, NULL, 0, 'China Beige', 9.5, 'China-Beige', 'o202KqT36G', '', 'China-Beige Travertine Tiles', '<p>China-Beige Travertine Tiles<br></p>', '1650440407lore-schodts-hqRZbRbmmGU-unsplash.jpg', '', NULL, 1, 'AXkZWOuN.jpg', 'normal', '2022-04-13 17:37:57', '2022-04-20 02:40:08'),
(601, 28, NULL, 0, 'Sandalwood', NULL, 'Sandalwood', 'NGtdPpqc1V', '', 'Sandalwood Travertine Tiles', '<p>Sandalwood Travertine Tiles<br></p>', '1649871862images1.jpg', '', NULL, 1, 'yWzMnX7R.jpg', 'normal', '2022-04-13 17:44:22', '2022-04-13 18:05:23'),
(602, 28, NULL, 0, 'Classic Mocha', NULL, 'Classic-Mocha', 'ty6faUhCtT', '', 'Classic-Mocha Travertine Tiles', '<p>Classic-Mocha Travertine Tiles<br></p>', '1649872057images1.jpg', '', NULL, 1, 'r2BYHpcb.jpg', 'normal', '2022-04-13 17:47:37', '2022-04-13 18:05:39'),
(603, 28, NULL, 2, 'new product', 9.6, 'new-product', 'GkxWSofuaq', 'tag', 'test', '<p>test</p>', '1650255758kimi-raikkonen-space-28-4KHuge.com.jpg', '', NULL, 1, 'NeP0NJXC.jpg', 'normal', '2022-04-17 23:22:39', '2022-04-20 00:41:45'),
(604, 28, NULL, 2, 'Maggy Perry', 8.7, '98', 'Ett', '', 'Recusandae Qui impe', '<p>sdgfhfhdhfdhdfhh</p>', '16505318833.jpg', '', 'Qui iusto consectetu', 1, 'Yaz4PTnU.jpg', 'normal', '2022-04-21 04:04:43', '2022-04-21 04:04:43'),
(614, 28, NULL, 2, 'Wyatt Barrett', 9.7, '679', 'Aut omnis enim id co', NULL, 'Et ea vel pariatur', '<p>safsfsgrer</p>', '16506135142.jpg', '', 'Aut est eiusmod fugi', 1, NULL, 'normal', '2022-04-22 02:45:14', '2022-04-22 04:47:24'),
(615, 28, NULL, 2, 'Flavia Taylor', 8.7, '993', 'Omnis', NULL, 'Hic repellendus Occ', '<p>fettreyqweatgsaffdsfsdgfhddgs</p>', '16506243252.jpg', '', 'Ex aut aliquid ipsum', 1, NULL, 'normal', '2022-04-22 05:45:25', '2022-04-22 05:47:24'),
(703, 0, 0, 2, 'CSV Product - A', 500, 'csv-product-a', 'J5JGUfYU4i', 'tag,tagb', 'stackable', 'product description', 'featured_image.avif', 'KEYWORD', 'DESC', 1, 'thumbnail.jpg', 'normal', '2022-04-27 07:21:07', '2022-04-27 07:21:07'),
(704, 0, 0, 2, 'CSV Product - B', 100, 'csv-product-b', '2se2467MBp', 'tag,tagc', 'shiny', 'product description', 'featured_image.avif', 'KEYWORD', 'DESC', 1, 'thumbnail.jpg', 'normal', '2022-04-27 07:21:07', '2022-04-27 07:21:07'),
(705, 0, 0, 2, 'CSV Product - C', 20, 'csv-product-c', 'cEH82h1k5j', 'tag,tagd', 'strongest tile', 'product description', 'featured_image.avif', 'KEYWORD', 'DESC', 1, 'thumbnail.jpg', 'normal', '2022-04-27 07:21:07', '2022-04-27 07:21:07'),
(706, 0, 0, 2, 'CSV Product - D', 100, 'csv-product-d', '6HoY7lrwNa', 'marble', 'new', 'product description', 'featured_image.jpg', 'KEYWORD', 'DESC', 1, 'thumbnail.jpg', 'normal', '2022-04-27 07:25:34', '2022-04-27 07:25:34'),
(707, 0, 0, 2, 'CSV Product - E', 60, 'csv-product-e', 'XjhfU1snEi', 'concrete, solid', 'brand new', 'product description', 'featured_image.jpg', 'KEYWORD', 'DESC', 1, 'thumbnail.jpg', 'normal', '2022-04-27 07:25:34', '2022-04-27 07:25:34'),
(708, 28, NULL, 2, 'CSV Product - F', 800, 'csv-product-f', '2Eob9R5j8V', '[{\"value\":\"shiny\"}]', 'white and shiny', 'product description', 'featured_image.jpg', 'KEYWORD', 'DESC', 1, 'thumbnail.jpg', 'normal', '2022-04-27 07:25:34', '2022-04-27 07:30:59');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT '0',
  `rtl` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language`, `file`, `name`, `is_default`, `rtl`, `created_at`, `updated_at`, `type`) VALUES
(1, 'English', '1632074091n5DwjCPM.json', '1632074091n5DwjCPM', 1, 0, NULL, NULL, 'Website'),
(2, 'Arabic', '1638871615OqIUSiox.json', '1638871615OqIUSiox', 0, 1, NULL, NULL, 'Website'),
(3, 'English', '1638870883BOqAaAaB.json', '1638870883BOqAaAaB', 1, 0, NULL, NULL, 'Dashboard'),
(4, 'Arabic', '1638870927JMqjbCXv.json', '1638870927JMqjbCXv', 0, 1, NULL, NULL, 'Dashboard');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `ticket_id`, `user_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'test', '2021-12-03 06:33:29', '2021-12-03 06:33:29');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_08_21_073142_create_admins_table', 1),
(2, '2021_08_21_073507_create_users_table', 1),
(3, '2021_09_20_144419_create_items_table', 1),
(4, '2021_09_20_151605_create_settings_table', 1),
(5, '2021_09_21_073848_create_attributes_table', 1),
(6, '2021_09_21_073951_create_attribute_options_table', 1),
(7, '2021_09_21_074028_create_banners_table', 1),
(8, '2021_09_21_074231_create_bcategories_table', 1),
(9, '2021_09_21_074309_create_brands_table', 1),
(10, '2021_09_21_074412_create_campaign_items_table', 1),
(11, '2021_09_21_074536_create_categories_table', 1),
(12, '2021_09_21_074744_create_chield_categories_table', 1),
(13, '2021_09_21_074952_create_countries_table', 1),
(14, '2021_09_21_075024_create_currencies_table', 1),
(15, '2021_09_21_075231_create_email_templates_table', 1),
(16, '2021_09_21_075346_create_faqs_table', 1),
(17, '2021_09_21_075642_create_fcategories_table', 1),
(18, '2021_09_21_080223_create_galleries_table', 1),
(19, '2021_09_21_080320_create_home_cutomizes_table', 1),
(20, '2021_09_21_080454_create_languages_table', 1),
(21, '2021_09_21_080652_create_messages_table', 1),
(22, '2021_09_21_080805_create_notifications_table', 1),
(23, '2021_09_21_090957_create_orders_table', 1),
(25, '2021_09_21_092255_create_payment_settings_table', 1),
(26, '2021_09_21_092722_create_posts_table', 1),
(27, '2021_09_21_092801_create_promo_codes_table', 1),
(28, '2021_09_21_093709_create_reviews_table', 1),
(29, '2021_09_21_093833_create_roles_table', 1),
(30, '2021_09_21_094020_create_services_table', 1),
(31, '2021_09_21_094413_create_shipping_services_table', 1),
(32, '2021_09_21_094517_create_sliders_table', 1),
(33, '2021_09_21_094630_create_socials_table', 1),
(34, '2021_09_21_094739_create_subcategories_table', 1),
(35, '2021_09_21_094831_create_subscribers_table', 1),
(36, '2021_09_21_094903_create_taxes_table', 1),
(37, '2021_09_21_095021_create_tickets_table', 1),
(38, '2021_09_21_095605_create_track_orders_table', 1),
(39, '2021_09_21_095650_create_transactions_table', 1),
(40, '2021_09_21_095836_create_wishlists_table', 1),
(41, '2021_09_21_091316_create_pages_table', 2),
(42, '2021_09_22_095954_add_extra_visibility_to_settings_table', 3),
(43, '2021_09_29_075836_add_theme_to_settings_table', 4),
(44, '2021_09_30_103035_google_chapcha_to_settings__table', 5),
(45, '2021_10_04_141643_add_currency_deraction_to_settings_table', 6),
(46, '2021_10_08_135417_add_theme_field_to_sliders_table', 7),
(51, '2021_10_09_153059_license_to_items_table', 8),
(56, '2021_10_09_173004_remove_item_type_to_items_table', 9),
(57, '2021_10_09_173038_set_item_type_to_items_table', 9),
(58, '2021_10_10_051502_add_scrript_to_settings_table', 10),
(59, '2021_10_10_142339_thumbnail_to_items_table', 11),
(61, '2021_10_10_163455_home_page4_to_home_cutomizes_table', 12),
(62, '2021_10_11_090243_create_extra_settings_table', 13),
(63, '2021_10_12_145150_add_home4populer_category_to_home_cutomizes_table', 14),
(64, '2021_10_13_100048_create_sitemaps_table', 15),
(65, '2021_10_15_140708_add_type_to_promo_codes_table', 16),
(66, '2021_10_15_163958_add_announcement_link_to_settings_table', 17),
(68, '2021_11_21_143624_add_shop_extra_field_to_settings_table', 19),
(69, '2021_11_20_105052_add_stock_to_attribute_options_table', 20),
(71, '2021_11_21_151422_add_home_page_title_to_settings_table', 21),
(72, '2021_11_23_141528_add_type_to_languages_table', 22),
(73, '2021_11_23_144810_add_privacy_terms_to_settings_table', 23),
(74, '2021_11_23_182026_add_guest_checkout_to_settings_table', 24),
(76, '2021_11_24_144859_add_guest_hero_banner_to_home_cutomizes_table', 25),
(77, '2021_11_26_163222_add_affiliate_link_to_items_table', 26),
(78, '2021_11_27_113624_add_css_field_to_settings_table', 27),
(79, '2021_12_05_161222_add_flash_section_to_extra_settings_table', 28),
(82, '2021_12_05_165840_add_popup_field_to_settings_table', 29),
(83, '2021_12_06_141255_add_3column_section_to_extra_settings_table', 30),
(84, '2022_01_03_141239_add_currency_seperator_to_settings_table', 31),
(85, '2022_01_04_142738_create_states_table', 32),
(86, '2022_01_04_145532_add_state_id_to_users_table', 33),
(88, '2022_01_04_161647_add_state_id_to_orders_table', 34),
(89, '2022_01_06_155345_add_disqus_to_settings_table', 35),
(90, '2022_01_16_143429_add_type_to_states_table', 36),
(91, '2022_01_16_153254_add_state_to_orders_table', 37),
(92, '2014_10_12_100000_create_password_resets_table', 38),
(93, '2019_08_19_000000_create_failed_jobs_table', 38),
(94, '2019_12_14_000001_create_personal_access_tokens_table', 38),
(95, '2022_04_14_053120_add_image_description_to_attribute_options_table', 38),
(96, '2022_04_14_053535_add_length_height_to_attribute_options_table', 39),
(97, '2022_04_14_110010_add_quantity_to_attribute_options_table', 40),
(98, '2022_04_14_110127_add_abbrivation_to_attributes_table', 41),
(99, '2022_04_15_042236_update_categories_table', 41),
(100, '2022_04_15_043925_create_category_images_table', 42),
(101, '2022_04_14_075813_create_warehouses_table', 43),
(102, '2022_04_14_112951_add_warehouse_id_to_items_table', 43),
(103, '2022_04_15_051110_create_subcategory_galleries_table', 43),
(104, '2022_04_15_051654_alter_table_subcategories', 43),
(105, '2022_04_16_093408_remove_available_quantity_from_warehouses', 44),
(106, '2022_04_14_112713_add_more_options_columns_to_attribute_options_table', 45),
(107, '2022_04_18_080709_create_user_order_informations_table', 46),
(108, '2022_04_22_050610_add_item_id_to_attribute_options_table', 47),
(109, '2022_04_22_220450_create_admins_table', 0),
(110, '2022_04_22_220450_create_attribute_options_table', 0),
(111, '2022_04_22_220450_create_attributes_table', 0),
(112, '2022_04_22_220450_create_banners_table', 0),
(113, '2022_04_22_220450_create_bcategories_table', 0),
(114, '2022_04_22_220450_create_brands_table', 0),
(115, '2022_04_22_220450_create_campaign_items_table', 0),
(116, '2022_04_22_220450_create_categories_table', 0),
(117, '2022_04_22_220450_create_category_images_table', 0),
(118, '2022_04_22_220450_create_chield_categories_table', 0),
(119, '2022_04_22_220450_create_countries_table', 0),
(120, '2022_04_22_220450_create_currencies_table', 0),
(121, '2022_04_22_220450_create_email_templates_table', 0),
(122, '2022_04_22_220450_create_extra_settings_table', 0),
(123, '2022_04_22_220450_create_failed_jobs_table', 0),
(124, '2022_04_22_220450_create_faqs_table', 0),
(125, '2022_04_22_220450_create_fcategories_table', 0),
(126, '2022_04_22_220450_create_galleries_table', 0),
(127, '2022_04_22_220450_create_home_cutomizes_table', 0),
(128, '2022_04_22_220450_create_items_table', 0),
(129, '2022_04_22_220450_create_languages_table', 0),
(130, '2022_04_22_220450_create_messages_table', 0),
(131, '2022_04_22_220450_create_notifications_table', 0),
(132, '2022_04_22_220450_create_orders_table', 0),
(133, '2022_04_22_220450_create_pages_table', 0),
(134, '2022_04_22_220450_create_password_resets_table', 0),
(135, '2022_04_22_220450_create_payment_settings_table', 0),
(136, '2022_04_22_220450_create_personal_access_tokens_table', 0),
(137, '2022_04_22_220450_create_posts_table', 0),
(138, '2022_04_22_220450_create_promo_codes_table', 0),
(139, '2022_04_22_220450_create_reviews_table', 0),
(140, '2022_04_22_220450_create_roles_table', 0),
(141, '2022_04_22_220450_create_services_table', 0),
(142, '2022_04_22_220450_create_settings_table', 0),
(143, '2022_04_22_220450_create_shipping_services_table', 0),
(144, '2022_04_22_220450_create_sitemaps_table', 0),
(145, '2022_04_22_220450_create_sliders_table', 0),
(146, '2022_04_22_220450_create_socials_table', 0),
(147, '2022_04_22_220450_create_states_table', 0),
(148, '2022_04_22_220450_create_subcategories_table', 0),
(149, '2022_04_22_220450_create_subcategory_galleries_table', 0),
(150, '2022_04_22_220450_create_subscribers_table', 0),
(151, '2022_04_22_220450_create_taxes_table', 0),
(152, '2022_04_22_220450_create_tickets_table', 0),
(153, '2022_04_22_220450_create_track_orders_table', 0),
(154, '2022_04_22_220450_create_transactions_table', 0),
(155, '2022_04_22_220450_create_user_order_informations_table', 0),
(156, '2022_04_22_220450_create_users_table', 0),
(157, '2022_04_22_220450_create_warehouse_availabilities_table', 0),
(158, '2022_04_22_220450_create_warehouses_table', 0),
(159, '2022_04_22_220450_create_wishlists_table', 0),
(160, '2022_04_22_220451_add_foreign_keys_to_attribute_options_table', 0),
(161, '2022_04_22_220451_add_foreign_keys_to_category_images_table', 0),
(162, '2022_04_22_220531_create_admins_table', 0),
(163, '2022_04_22_220531_create_attribute_options_table', 0),
(164, '2022_04_22_220531_create_attributes_table', 0),
(165, '2022_04_22_220531_create_banners_table', 0),
(166, '2022_04_22_220531_create_bcategories_table', 0),
(167, '2022_04_22_220531_create_brands_table', 0),
(168, '2022_04_22_220531_create_campaign_items_table', 0),
(169, '2022_04_22_220531_create_categories_table', 0),
(170, '2022_04_22_220531_create_category_images_table', 0),
(171, '2022_04_22_220531_create_chield_categories_table', 0),
(172, '2022_04_22_220531_create_countries_table', 0),
(173, '2022_04_22_220531_create_currencies_table', 0),
(174, '2022_04_22_220531_create_email_templates_table', 0),
(175, '2022_04_22_220531_create_extra_settings_table', 0),
(176, '2022_04_22_220531_create_failed_jobs_table', 0),
(177, '2022_04_22_220531_create_faqs_table', 0),
(178, '2022_04_22_220531_create_fcategories_table', 0),
(179, '2022_04_22_220531_create_galleries_table', 0),
(180, '2022_04_22_220531_create_home_cutomizes_table', 0),
(181, '2022_04_22_220531_create_items_table', 0),
(182, '2022_04_22_220531_create_languages_table', 0),
(183, '2022_04_22_220531_create_messages_table', 0),
(184, '2022_04_22_220531_create_notifications_table', 0),
(185, '2022_04_22_220531_create_orders_table', 0),
(186, '2022_04_22_220531_create_pages_table', 0),
(187, '2022_04_22_220531_create_password_resets_table', 0),
(188, '2022_04_22_220531_create_payment_settings_table', 0),
(189, '2022_04_22_220531_create_personal_access_tokens_table', 0),
(190, '2022_04_22_220531_create_posts_table', 0),
(191, '2022_04_22_220531_create_promo_codes_table', 0),
(192, '2022_04_22_220531_create_reviews_table', 0),
(193, '2022_04_22_220531_create_roles_table', 0),
(194, '2022_04_22_220531_create_services_table', 0),
(195, '2022_04_22_220531_create_settings_table', 0),
(196, '2022_04_22_220531_create_shipping_services_table', 0),
(197, '2022_04_22_220531_create_sitemaps_table', 0),
(198, '2022_04_22_220531_create_sliders_table', 0),
(199, '2022_04_22_220531_create_socials_table', 0),
(200, '2022_04_22_220531_create_states_table', 0),
(201, '2022_04_22_220531_create_subcategories_table', 0),
(202, '2022_04_22_220531_create_subcategory_galleries_table', 0),
(203, '2022_04_22_220531_create_subscribers_table', 0),
(204, '2022_04_22_220531_create_taxes_table', 0),
(205, '2022_04_22_220531_create_tickets_table', 0),
(206, '2022_04_22_220531_create_track_orders_table', 0),
(207, '2022_04_22_220531_create_transactions_table', 0),
(208, '2022_04_22_220531_create_user_order_informations_table', 0),
(209, '2022_04_22_220531_create_users_table', 0),
(210, '2022_04_22_220531_create_warehouse_availabilities_table', 0),
(211, '2022_04_22_220531_create_warehouses_table', 0),
(212, '2022_04_22_220531_create_wishlists_table', 0),
(213, '2022_04_22_220532_add_foreign_keys_to_attribute_options_table', 0),
(214, '2022_04_22_220532_add_foreign_keys_to_category_images_table', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `is_read` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `cart` text COLLATE utf8mb4_unicode_ci,
  `currency_sign` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` text COLLATE utf8mb4_unicode_ci,
  `shipping` text COLLATE utf8mb4_unicode_ci,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `txnid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax` double NOT NULL DEFAULT '0',
  `charge_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_info` text COLLATE utf8mb4_unicode_ci,
  `billing_info` text COLLATE utf8mb4_unicode_ci,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `state_price` double DEFAULT '0',
  `state` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `cart`, `currency_sign`, `currency_value`, `discount`, `shipping`, `payment_method`, `txnid`, `tax`, `charge_id`, `transaction_number`, `order_status`, `shipping_info`, `billing_info`, `payment_status`, `created_at`, `updated_at`, `state_price`, `state`) VALUES
(120, 0, '{\"538-Red,M\":{\"options_id\":[281,1097],\"attribute\":{\"names\":[\"Color\",\"Size\"],\"option_name\":[\"Red\",\"M\"],\"option_price\":[5,5]},\"attribute_price\":10,\"name\":\"New Arrive Spring Fall Women Clothing Plus Size Dresses Floral Layered Ruffle Off Shoulder Dress\",\"slug\":\"New-Arrive-Spring-Fall-Women-Clothing-Plus-Size-Dresses-Floral-Layered-Ruffle-Off-Shoulder-Dress\",\"qty\":\"1\",\"price\":144.830000000000012505552149377763271331787109375,\"main_price\":134.830000000000012505552149377763271331787109375,\"photo\":\"1634135061Hd8364db18d9942a38e89779ca3b4fa7an.jpg\",\"item_type\":\"normal\",\"item_l_n\":null,\"item_l_k\":null}}', '$', '1', '[]', '{\"id\":1,\"title\":\"Free Delevery\",\"price\":0,\"minimum_price\":1000,\"is_condition\":1,\"status\":1,\"created_at\":null,\"updated_at\":null}', 'Cash On Delivery', NULL, 1.3483, NULL, 'e5KeMUdd4R', 'Pending', '{\"ship_first_name\":\"showrav\",\"ship_last_name\":\"Hasan\",\"ship_email\":\"teacher@gmail.com\",\"ship_phone\":\"01728332009\",\"ship_company\":null,\"ship_address1\":\"Munshinogor,Delduar,Tangail,Dhaka,Bangladesh\",\"ship_address2\":null,\"ship_zip\":\"1234\",\"ship_city\":\"Tangail...\",\"ship_country\":\"Bangladesh\"}', '{\"_token\":\"QOD5MKmJWvK28KB8O9k913pbovZvrzIHs89Ac2KK\",\"bill_first_name\":\"showrav\",\"bill_last_name\":\"Hasan\",\"bill_email\":\"teacher@gmail.com\",\"bill_phone\":\"01728332009\",\"bill_company\":null,\"bill_address1\":\"Munshinogor,Delduar,Tangail,Dhaka,Bangladesh\",\"bill_address2\":null,\"bill_zip\":\"1234\",\"bill_city\":\"Tangail...\",\"bill_country\":\"Bangladesh\",\"same_ship_address\":\"on\"}', 'Unpaid', '2022-01-16 09:13:39', '2022-01-16 09:13:39', 14.483, NULL),
(121, 0, '{\"538-Red,M\":{\"options_id\":[281,1097],\"attribute\":{\"names\":[\"Color\",\"Size\"],\"option_name\":[\"Red\",\"M\"],\"option_price\":[5,5]},\"attribute_price\":10,\"name\":\"New Arrive Spring Fall Women Clothing Plus Size Dresses Floral Layered Ruffle Off Shoulder Dress\",\"slug\":\"New-Arrive-Spring-Fall-Women-Clothing-Plus-Size-Dresses-Floral-Layered-Ruffle-Off-Shoulder-Dress\",\"qty\":\"1\",\"price\":144.830000000000012505552149377763271331787109375,\"main_price\":134.830000000000012505552149377763271331787109375,\"photo\":\"1634135061Hd8364db18d9942a38e89779ca3b4fa7an.jpg\",\"item_type\":\"normal\",\"item_l_n\":null,\"item_l_k\":null}}', '$', '1', '[]', '{\"id\":1,\"title\":\"Free Delevery\",\"price\":0,\"minimum_price\":1000,\"is_condition\":1,\"status\":1,\"created_at\":null,\"updated_at\":null}', 'Cash On Delivery', NULL, 1.3483, NULL, 'iqLoR9H2rH', 'Pending', '{\"ship_first_name\":\"showrav\",\"ship_last_name\":\"Hasan\",\"ship_email\":\"teacher@gmail.com\",\"ship_phone\":\"01728332009\",\"ship_company\":null,\"ship_address1\":\"Munshinogor,Delduar,Tangail,Dhaka,Bangladesh\",\"ship_address2\":null,\"ship_zip\":\"1234\",\"ship_city\":\"Tangail...\",\"ship_country\":\"Bangladesh\"}', '{\"_token\":\"QOD5MKmJWvK28KB8O9k913pbovZvrzIHs89Ac2KK\",\"bill_first_name\":\"showrav\",\"bill_last_name\":\"Hasan\",\"bill_email\":\"teacher@gmail.com\",\"bill_phone\":\"01728332009\",\"bill_company\":null,\"bill_address1\":\"Munshinogor,Delduar,Tangail,Dhaka,Bangladesh\",\"bill_address2\":null,\"bill_zip\":\"1234\",\"bill_city\":\"Tangail...\",\"bill_country\":\"Bangladesh\",\"same_ship_address\":\"on\"}', 'Unpaid', '2022-01-16 09:36:54', '2022-01-16 09:36:54', 0, NULL),
(122, 0, '{\"535-Red,M\":{\"options_id\":[269,1094],\"attribute\":{\"names\":[\"Color\",\"Size\"],\"option_name\":[\"Red\",\"M\"],\"option_price\":[5,5]},\"attribute_price\":10,\"name\":\"2021 Summer Women Clothing Ropa Sexy Lady Cut Out Halter Mini Dresses\",\"slug\":\"-----Summer-Women-Clothing-Ropa-Sexy-Lady-Cut-Out-Halter-Mini-Dresses\",\"qty\":\"1\",\"price\":144.830000000000012505552149377763271331787109375,\"main_price\":134.830000000000012505552149377763271331787109375,\"photo\":\"1634135320H408d7d7e37b4437297de600584c1af1fL.jpg\",\"item_type\":\"normal\",\"item_l_n\":null,\"item_l_k\":null}}', '$', '1', '[]', '{\"id\":1,\"title\":\"Free Delevery\",\"price\":0,\"minimum_price\":1000,\"is_condition\":1,\"status\":1,\"created_at\":null,\"updated_at\":null}', 'Cash On Delivery', NULL, 1.3483, NULL, 'zNF5gDbPnM', 'Pending', '{\"ship_first_name\":\"showrav\",\"ship_last_name\":\"Hasan\",\"ship_email\":\"teacher@gmail.com\",\"ship_phone\":\"01728332009\",\"ship_company\":null,\"ship_address1\":\"Munshinogor,Delduar,Tangail,Dhaka,Bangladesh\",\"ship_address2\":null,\"ship_zip\":\"1234\",\"ship_city\":\"Tangail...\",\"ship_country\":\"Bangladesh\"}', '{\"_token\":\"QOD5MKmJWvK28KB8O9k913pbovZvrzIHs89Ac2KK\",\"bill_first_name\":\"showrav\",\"bill_last_name\":\"Hasan\",\"bill_email\":\"teacher@gmail.com\",\"bill_phone\":\"01728332009\",\"bill_company\":null,\"bill_address1\":\"Munshinogor,Delduar,Tangail,Dhaka,Bangladesh\",\"bill_address2\":null,\"bill_zip\":\"1234\",\"bill_city\":\"Tangail...\",\"bill_country\":\"Bangladesh\",\"same_ship_address\":\"on\"}', 'Unpaid', '2022-01-16 09:37:45', '2022-01-16 09:37:45', 14.483, '{\"id\":6,\"name\":\"India\",\"price\":10,\"status\":1,\"type\":\"fixed\"}'),
(123, 1, '{\"587-Red,M\":{\"options_id\":[429,1126],\"attribute\":{\"names\":[\"Color\",\"Size\"],\"option_name\":[\"Red\",\"M\"],\"option_price\":[5,5]},\"attribute_price\":10,\"name\":\"New French Elegant White Bubble Sleeve Party Dress Casual A-Line Dresses, Long Sleeve Dresses\",\"slug\":\"0AENew-French-Elegant-White-Bubble-Sleeve-Party-Dress-Casual-ALine-Dresses-Long-Sleeve-DressesnC\",\"qty\":\"1\",\"price\":344.82999999999998408384271897375583648681640625,\"main_price\":334.82999999999998408384271897375583648681640625,\"photo\":\"1634134144H03667d1e3ae44be08f32b72d840db095J.jpg\",\"item_type\":\"normal\",\"item_l_n\":null,\"item_l_k\":null}}', '$', '1', '[]', '{\"id\":1,\"title\":\"Free Delevery\",\"price\":0,\"minimum_price\":1000,\"is_condition\":1,\"status\":1,\"created_at\":null,\"updated_at\":null}', 'Stripe', 'txn_3KIb9QH3jdWvr8gE1Ph1bOxa', 3.3483, 'ch_3KIb9QH3jdWvr8gE1d2Ivr4f', 'ZN6ve2FsBf', 'Pending', '{\"ship_first_name\":\"Alex\",\"ship_last_name\":\"Smith\",\"ship_email\":\"user@gmail.com\",\"ship_phone\":\"01728332009\",\"ship_company\":null,\"ship_address1\":\"472 Clark Street,  Bay Shore, New York\",\"ship_address2\":null,\"ship_zip\":\"3444\",\"ship_city\":\"New York\",\"ship_country\":\"United States\"}', '{\"_token\":\"QOD5MKmJWvK28KB8O9k913pbovZvrzIHs89Ac2KK\",\"bill_first_name\":\"Alex\",\"bill_last_name\":\"Smith\",\"bill_email\":\"user@gmail.com\",\"bill_phone\":\"01728332009\",\"bill_company\":null,\"bill_address1\":\"472 Clark Street,  Bay Shore, New York\",\"bill_address2\":null,\"bill_zip\":\"3444\",\"bill_city\":\"New York\",\"bill_country\":\"United States\",\"same_ship_address\":\"on\"}', 'Paid', '2022-01-16 10:00:15', '2022-01-16 10:00:15', 34.483, '{\"id\":6,\"name\":\"India\",\"price\":10,\"status\":1,\"type\":\"percentage\"}'),
(124, 1, '{\"534-Red,M\":{\"options_id\":[265,1093],\"attribute\":{\"names\":[\"Color\",\"Size\"],\"option_name\":[\"Red\",\"M\"],\"option_price\":[5,5]},\"attribute_price\":10,\"name\":\"Top Sale High Quality Newest Designs Custom Women Clothing Wholesale from China Dresses\",\"slug\":\"Top-Sale-High-Quality-Newest-Designs-Custom-Women-Clothing-Wholesale-from-China-Dresses\",\"qty\":\"1\",\"price\":69.5499999999999971578290569595992565155029296875,\"main_price\":59.5499999999999971578290569595992565155029296875,\"photo\":\"1634135337H948b3bef197c492d999473dffa5303f9P.jpg\",\"item_type\":\"normal\",\"item_l_n\":null,\"item_l_k\":null}}', '$', '1', '[]', '{\"id\":1,\"title\":\"Free Delevery\",\"price\":0,\"minimum_price\":1000,\"is_condition\":1,\"status\":1,\"created_at\":null,\"updated_at\":null}', 'Cash On Delivery', NULL, 0.5955, NULL, 'GPt4RZ0RCq', 'Pending', '{\"ship_first_name\":\"Alex\",\"ship_last_name\":\"Smith\",\"ship_email\":\"user@gmail.com\",\"ship_phone\":\"01728332009\",\"ship_company\":null,\"ship_address1\":\"472 Clark Street,  Bay Shore, New York\",\"ship_address2\":null,\"ship_zip\":\"3444\",\"ship_city\":\"New York\",\"ship_country\":\"United States\"}', '{\"_token\":\"QOD5MKmJWvK28KB8O9k913pbovZvrzIHs89Ac2KK\",\"bill_first_name\":\"Alex\",\"bill_last_name\":\"Smith\",\"bill_email\":\"user@gmail.com\",\"bill_phone\":\"01728332009\",\"bill_company\":null,\"bill_address1\":\"472 Clark Street,  Bay Shore, New York\",\"bill_address2\":null,\"bill_zip\":\"3444\",\"bill_city\":\"New York\",\"bill_country\":\"United States\",\"same_ship_address\":\"on\"}', 'Unpaid', '2022-01-16 10:03:35', '2022-01-16 10:03:35', 6.955, '{\"id\":6,\"name\":\"India\",\"price\":10,\"status\":1,\"type\":\"percentage\"}'),
(125, 1, '{\"534-Red,M\":{\"options_id\":[265,1093],\"attribute\":{\"names\":[\"Color\",\"Size\"],\"option_name\":[\"Red\",\"M\"],\"option_price\":[5,5]},\"attribute_price\":10,\"name\":\"Top Sale High Quality Newest Designs Custom Women Clothing Wholesale from China Dresses\",\"slug\":\"Top-Sale-High-Quality-Newest-Designs-Custom-Women-Clothing-Wholesale-from-China-Dresses\",\"qty\":\"1\",\"price\":69.5499999999999971578290569595992565155029296875,\"main_price\":59.5499999999999971578290569595992565155029296875,\"photo\":\"1634135337H948b3bef197c492d999473dffa5303f9P.jpg\",\"item_type\":\"normal\",\"item_l_n\":null,\"item_l_k\":null}}', '$', '1', '[]', '{\"id\":2,\"title\":\"Delivery\",\"price\":20,\"minimum_price\":0,\"is_condition\":0,\"status\":1,\"created_at\":null,\"updated_at\":null}', 'Cash On Delivery', NULL, 0.5955, NULL, '0HGakDhxlW', 'Pending', '{\"ship_first_name\":\"Alex\",\"ship_last_name\":\"Smith\",\"ship_email\":\"user@gmail.com\",\"ship_phone\":\"01728332009\",\"ship_company\":null,\"ship_address1\":\"472 Clark Street,  Bay Shore, New York\",\"ship_address2\":null,\"ship_zip\":\"3444\",\"ship_city\":\"New York\",\"ship_country\":\"United States\"}', '{\"_token\":\"QOD5MKmJWvK28KB8O9k913pbovZvrzIHs89Ac2KK\",\"bill_first_name\":\"Alex\",\"bill_last_name\":\"Smith\",\"bill_email\":\"user@gmail.com\",\"bill_phone\":\"01728332009\",\"bill_company\":null,\"bill_address1\":\"472 Clark Street,  Bay Shore, New York\",\"bill_address2\":null,\"bill_zip\":\"3444\",\"bill_city\":\"New York\",\"bill_country\":\"United States\",\"same_ship_address\":\"on\"}', 'Unpaid', '2022-01-16 10:08:36', '2022-01-16 10:08:36', 6.955, '{\"id\":6,\"name\":\"India\",\"price\":10,\"status\":1,\"type\":\"percentage\"}'),
(126, 1, '{\"587-Pink,XXL\":{\"options_id\":[432,1264],\"attribute\":{\"names\":[\"Color\",\"Size\"],\"option_name\":[\"Pink\",\"XXL\"],\"option_price\":[8,7]},\"attribute_price\":15,\"name\":\"New French Elegant White Bubble Sleeve Party Dress Casual A-Line Dresses, Long Sleeve Dresses\",\"slug\":\"0AENew-French-Elegant-White-Bubble-Sleeve-Party-Dress-Casual-ALine-Dresses-Long-Sleeve-DressesnC\",\"qty\":\"2\",\"price\":344.82999999999998408384271897375583648681640625,\"main_price\":334.82999999999998408384271897375583648681640625,\"photo\":\"1634134144H03667d1e3ae44be08f32b72d840db095J.jpg\",\"item_type\":\"normal\",\"item_l_n\":null,\"item_l_k\":null}}', '$', '1', '[]', '{\"id\":2,\"title\":\"Delivery\",\"price\":20,\"minimum_price\":0,\"is_condition\":0,\"status\":1,\"created_at\":null,\"updated_at\":null}', 'Stripe', 'txn_3KIcZsH3jdWvr8gE1xCmNaNe', 3.3483, 'ch_3KIcZsH3jdWvr8gE1g4sD0jO', 'Ffr4zOVXnf', 'Delivered', '{\"ship_first_name\":\"Alex\",\"ship_last_name\":\"Smith\",\"ship_email\":\"user@gmail.com\",\"ship_phone\":\"01728332009\",\"ship_company\":null,\"ship_address1\":\"472 Clark Street,  Bay Shore, New York\",\"ship_address2\":null,\"ship_zip\":\"3444\",\"ship_city\":\"New York\",\"ship_country\":\"United States\"}', '{\"_token\":\"72BuSB7wcI55oScnzMJaMuCK0ZBFOdNoLGTqPuI0\",\"bill_first_name\":\"Alex\",\"bill_last_name\":\"Smith\",\"bill_email\":\"user@gmail.com\",\"bill_phone\":\"01728332009\",\"bill_company\":null,\"bill_address1\":\"472 Clark Street,  Bay Shore, New York\",\"bill_address2\":null,\"bill_zip\":\"3444\",\"bill_city\":\"New York\",\"bill_country\":\"United States\",\"same_ship_address\":\"on\"}', 'Paid', '2022-01-16 11:31:41', '2022-01-17 03:59:27', 68.466, '{\"id\":6,\"name\":\"India\",\"price\":10,\"status\":1,\"type\":\"percentage\"}'),
(127, 1, '{\"587-Pink,XXL\":{\"options_id\":[432,1264],\"attribute\":{\"names\":[\"Color\",\"Size\"],\"option_name\":[\"Pink\",\"XXL\"],\"option_price\":[8,7]},\"attribute_price\":15,\"name\":\"New French Elegant White Bubble Sleeve Party Dress Casual A-Line Dresses, Long Sleeve Dresses\",\"slug\":\"0AENew-French-Elegant-White-Bubble-Sleeve-Party-Dress-Casual-ALine-Dresses-Long-Sleeve-DressesnC\",\"qty\":\"1\",\"price\":344.82999999999998408384271897375583648681640625,\"main_price\":334.82999999999998408384271897375583648681640625,\"photo\":\"1634134144H03667d1e3ae44be08f32b72d840db095J.jpg\",\"item_type\":\"normal\",\"item_l_n\":null,\"item_l_k\":null}}', '$', '1', '[]', '{\"id\":2,\"title\":\"Delivery\",\"price\":20,\"minimum_price\":0,\"is_condition\":0,\"status\":1,\"created_at\":null,\"updated_at\":null}', 'Paypal', '0JS90047YT3185603', 1, NULL, 'rTgJph3cv8', 'Delivered', '{\"ship_first_name\":\"Alex\",\"ship_last_name\":\"Smith\",\"ship_email\":\"user@gmail.com\",\"ship_phone\":\"01728332009\",\"ship_company\":null,\"ship_address1\":\"472 Clark Street,  Bay Shore, New York\",\"ship_address2\":null,\"ship_zip\":\"3444\",\"ship_city\":\"New York\",\"ship_country\":\"United States\"}', '{\"_token\":\"72BuSB7wcI55oScnzMJaMuCK0ZBFOdNoLGTqPuI0\",\"bill_first_name\":\"Alex\",\"bill_last_name\":\"Smith\",\"bill_email\":\"user@gmail.com\",\"bill_phone\":\"01728332009\",\"bill_company\":null,\"bill_address1\":\"472 Clark Street,  Bay Shore, New York\",\"bill_address2\":null,\"bill_zip\":\"3444\",\"bill_city\":\"New York\",\"bill_country\":\"United States\",\"same_ship_address\":\"on\"}', 'Paid', '2022-01-16 11:33:57', '2022-01-17 03:59:21', 34.983, '{\"id\":6,\"name\":\"India\",\"price\":10,\"status\":1,\"type\":\"percentage\"}'),
(128, 1, '{\"539-Pink,XXL\":{\"options_id\":[288,1236],\"attribute\":{\"names\":[\"Color\",\"Size\"],\"option_name\":[\"Pink\",\"XXL\"],\"option_price\":[8,7]},\"attribute_price\":15,\"name\":\"Clothing Women 2021 New Fashion Printed Knitwear Round Neck Casual Couple Clothing Christmas\",\"slug\":\"Clothing-Women------New-Fashion-Printed-Knitwear-Round-Neck-Casual-Couple-Clothing-Christmas\",\"qty\":\"2\",\"price\":66.18000000000000682121026329696178436279296875,\"main_price\":56.17999999999999971578290569595992565155029296875,\"photo\":\"1634134958H8b2502797ffe4c93984c99bdd5061ab3W.jpg\",\"item_type\":\"normal\",\"item_l_n\":null,\"item_l_k\":null}}', '$', '1', '[]', '{\"id\":2,\"title\":\"Delivery\",\"price\":20,\"minimum_price\":0,\"is_condition\":0,\"status\":1,\"created_at\":null,\"updated_at\":null}', 'Stripe', 'txn_3KIcesH3jdWvr8gE17fmrDps', 0.5618, 'ch_3KIcesH3jdWvr8gE1bWbzyns', 'JrV7oupswB', 'Delivered', '{\"ship_first_name\":\"Alex\",\"ship_last_name\":\"Smith\",\"ship_email\":\"user@gmail.com\",\"ship_phone\":\"01728332009\",\"ship_company\":null,\"ship_address1\":\"472 Clark Street,  Bay Shore, New York\",\"ship_address2\":null,\"ship_zip\":\"3444\",\"ship_city\":\"New York\",\"ship_country\":\"United States\"}', '{\"_token\":\"72BuSB7wcI55oScnzMJaMuCK0ZBFOdNoLGTqPuI0\",\"bill_first_name\":\"Alex\",\"bill_last_name\":\"Smith\",\"bill_email\":\"user@gmail.com\",\"bill_phone\":\"01728332009\",\"bill_company\":null,\"bill_address1\":\"472 Clark Street,  Bay Shore, New York\",\"bill_address2\":null,\"bill_zip\":\"3444\",\"bill_city\":\"New York\",\"bill_country\":\"United States\",\"same_ship_address\":\"on\"}', 'Paid', '2022-01-16 11:36:51', '2022-01-17 03:59:15', 12.736, '{\"id\":6,\"name\":\"India\",\"price\":10,\"status\":1,\"type\":\"percentage\"}'),
(129, 1, '{\"586-Red,M\":{\"options_id\":[425,1125],\"attribute\":{\"names\":[\"Color\",\"Size\"],\"option_name\":[\"Red\",\"M\"],\"option_price\":[5,5]},\"attribute_price\":10,\"name\":\"BREYLEE facial mask hyaluronic acid facial firming mask beauty\",\"slug\":\"Td5BREYLEE-facial-mask-hyaluronic-acid-facial-firming-mask-beautyca\",\"qty\":\"1\",\"price\":1362.80999999999994543031789362430572509765625,\"main_price\":1352.80999999999994543031789362430572509765625,\"photo\":\"1634134188HTB1ymRhXfjsK1Rjy1Xaq6zispXad.jpg\",\"item_type\":\"normal\",\"item_l_n\":null,\"item_l_k\":null}}', '$', '1', '[]', '{\"id\":1,\"title\":\"Free Delevery\",\"price\":0,\"minimum_price\":1000,\"is_condition\":1,\"status\":1,\"created_at\":null,\"updated_at\":null}', 'Stripe', 'txn_3KIcihH3jdWvr8gE1jYOlJfQ', 13.5281, 'ch_3KIcihH3jdWvr8gE164YxcvT', 'HhgjzEg09z', 'Delivered', '{\"ship_first_name\":\"Alex\",\"ship_last_name\":\"Smith\",\"ship_email\":\"user@gmail.com\",\"ship_phone\":\"01728332009\",\"ship_company\":null,\"ship_address1\":\"472 Clark Street,  Bay Shore, New York\",\"ship_address2\":null,\"ship_zip\":\"3444\",\"ship_city\":\"New York\",\"ship_country\":\"United States\"}', '{\"_token\":\"72BuSB7wcI55oScnzMJaMuCK0ZBFOdNoLGTqPuI0\",\"bill_first_name\":\"Alex\",\"bill_last_name\":\"Smith\",\"bill_email\":\"user@gmail.com\",\"bill_phone\":\"01728332009\",\"bill_company\":null,\"bill_address1\":\"472 Clark Street,  Bay Shore, New York\",\"bill_address2\":null,\"bill_zip\":\"3444\",\"bill_city\":\"New York\",\"bill_country\":\"United States\",\"same_ship_address\":\"on\"}', 'Paid', '2022-01-16 11:40:48', '2022-01-17 03:59:09', 136.281, '{\"id\":6,\"name\":\"India\",\"price\":10,\"status\":1,\"type\":\"percentage\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_descriptions` text COLLATE utf8mb4_unicode_ci,
  `pos` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `details`, `meta_keywords`, `meta_descriptions`, `pos`, `created_at`, `updated_at`) VALUES
(7, 'About Us', 'about-us', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate quae illo soluta sapiente minus voluptatibus molestias voluptates maiores repudiandae, velit quaerat error! Dolor alias voluptates rerum vitae illum officiis laboriosam, eos fugiat necessitatibus iste quasi vero porro at asperiores atque numquam adipisci esse perferendis hic dolore dolores facere quidem? Voluptatum, nemo voluptates. Qui, animi odit voluptatem velit nostrum rem maiores. Qui esse magnam enim natus numquam ab adipisci nihil mollitia odio ducimus architecto unde harum saepe illum, ipsa hic dicta alias cumque et minus veritatis assumenda a quo. Possimus, vitae est! Fuga quidem minima sunt modi. Officia natus quaerat nobis ut ab nulla. Tempora, corrupti? Animi excepturi voluptatem quod consectetur culpa autem aliquid? Inventore adipisci officia error dolore provident omnis sint perferendis, consequuntur, sapiente magni sequi quo quis nesciunt molestiae vero iure cum laboriosam fugit. Numquam sed expedita alias non? Sequi, harum cupiditate! Quasi non laboriosam optio ex fugit delectus minus incidunt excepturi! Nisi iure ex, nulla perspiciatis similique est, libero sapiente hic error amet, quisquam vel obcaecati fugit. Maxime cupiditate voluptatibus, nisi ullam error voluptas culpa at animi sequi eius suscipit ad ipsum qui illum provident dolores facere necessitatibus commodi vel in, laborum quidem aliquam ipsa quibusdam? Eius, alias voluptatem, laboriosam perferendis itaque, sapiente nisi beatae necessitatibus reprehenderit nam corrupti magnam qui omnis eveniet! Optio at expedita temporibus fugiat debitis eum? Dolore excepturi quod doloribus quam rem placeat at odit dicta amet expedita illo laboriosam minus ut minima, tenetur suscipit soluta assumenda. Nisi laboriosam adipisci animi consequuntur, ad illum repellat consequatur odit, laudantium velit non nobis labore illo omnis quod suscipit voluptates quaerat consectetur temporibus et, laborum quam ducimus earum! Repellat, fugit? Repudiandae repellendus maiores doloribus deleniti asperiores distinctio suscipit fugiat omnis culpa itaque? Harum et, velit ratione corrupti error asperiores optio, recusandae mollitia necessitatibus cumque vero voluptatem ullam porro aut eum earum! Consectetur voluptatum ratione dolor in earum molestiae ipsam quisquam, eum vitae suscipit voluptates recusandae. Cum eaque officiis ea et atque eveniet similique sequi illo!', NULL, NULL, 2, NULL, NULL),
(10, 'Privacy Policy', 'privacy-policy', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate quae illo soluta sapiente minus voluptatibus molestias voluptates maiores repudiandae, velit quaerat error! Dolor alias voluptates rerum vitae illum officiis laboriosam, eos fugiat necessitatibus iste quasi vero porro at asperiores atque numquam adipisci esse perferendis hic dolore dolores facere quidem? Voluptatum, nemo voluptates. Qui, animi odit voluptatem velit nostrum rem maiores. Qui esse magnam enim natus numquam ab adipisci nihil mollitia odio ducimus architecto unde harum saepe illum, ipsa hic dicta alias cumque et minus veritatis assumenda a quo. Possimus, vitae est! Fuga quidem minima sunt modi. Officia natus quaerat nobis ut ab nulla. Tempora, corrupti? Animi excepturi voluptatem quod consectetur culpa autem aliquid? Inventore adipisci officia error dolore provident omnis sint perferendis, consequuntur, sapiente magni sequi quo quis nesciunt molestiae vero iure cum laboriosam fugit. Numquam sed expedita alias non? Sequi, harum cupiditate! Quasi non laboriosam optio ex fugit delectus minus incidunt excepturi! Nisi iure ex, nulla perspiciatis similique est, libero sapiente hic error amet, quisquam vel obcaecati fugit. Maxime cupiditate voluptatibus, nisi ullam error voluptas culpa at animi sequi eius suscipit ad ipsum qui illum provident dolores facere necessitatibus commodi vel in, laborum quidem aliquam ipsa quibusdam? Eius, alias voluptatem, laboriosam perferendis itaque, sapiente nisi beatae necessitatibus reprehenderit nam corrupti magnam qui omnis eveniet! Optio at expedita temporibus fugiat debitis eum? Dolore excepturi quod doloribus quam rem placeat at odit dicta amet expedita illo laboriosam minus ut minima, tenetur suscipit soluta assumenda. Nisi laboriosam adipisci animi consequuntur, ad illum repellat consequatur odit, laudantium velit non nobis labore illo omnis quod suscipit voluptates quaerat consectetur temporibus et, laborum quam ducimus earum! Repellat, fugit? Repudiandae repellendus maiores doloribus deleniti asperiores distinctio suscipit fugiat omnis culpa itaque? Harum et, velit ratione corrupti error asperiores optio, recusandae mollitia necessitatibus cumque vero voluptatem ullam porro aut eum earum! Consectetur voluptatum ratione dolor in earum molestiae ipsam quisquam, eum vitae suscipit voluptates recusandae. Cum eaque officiis ea et atque eveniet similique sequi illo!', NULL, NULL, 2, NULL, NULL),
(11, 'Terms & Service', 'terms-and-service', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate quae illo soluta sapiente minus voluptatibus molestias voluptates maiores repudiandae, velit quaerat error! Dolor alias voluptates rerum vitae illum officiis laboriosam, eos fugiat necessitatibus iste quasi vero porro at asperiores atque numquam adipisci esse perferendis hic dolore dolores facere quidem? Voluptatum, nemo voluptates. Qui, animi odit voluptatem velit nostrum rem maiores. Qui esse magnam enim natus numquam ab adipisci nihil mollitia odio ducimus architecto unde harum saepe illum, ipsa hic dicta alias cumque et minus veritatis assumenda a quo. Possimus, vitae est! Fuga quidem minima sunt modi. Officia natus quaerat nobis ut ab nulla. Tempora, corrupti? Animi excepturi voluptatem quod consectetur culpa autem aliquid? Inventore adipisci officia error dolore provident omnis sint perferendis, consequuntur, sapiente magni sequi quo quis nesciunt molestiae vero iure cum laboriosam fugit. Numquam sed expedita alias non? Sequi, harum cupiditate! Quasi non laboriosam optio ex fugit delectus minus incidunt excepturi! Nisi iure ex, nulla perspiciatis similique est, libero sapiente hic error amet, quisquam vel obcaecati fugit. Maxime cupiditate voluptatibus, nisi ullam error voluptas culpa at animi sequi eius suscipit ad ipsum qui illum provident dolores facere necessitatibus commodi vel in, laborum quidem aliquam ipsa quibusdam? Eius, alias voluptatem, laboriosam perferendis itaque, sapiente nisi beatae necessitatibus reprehenderit nam corrupti magnam qui omnis eveniet! Optio at expedita temporibus fugiat debitis eum? Dolore excepturi quod doloribus quam rem placeat at odit dicta amet expedita illo laboriosam minus ut minima, tenetur suscipit soluta assumenda. Nisi laboriosam adipisci animi consequuntur, ad illum repellat consequatur odit, laudantium velit non nobis labore illo omnis quod suscipit voluptates quaerat consectetur temporibus et, laborum quam ducimus earum! Repellat, fugit? Repudiandae repellendus maiores doloribus deleniti asperiores distinctio suscipit fugiat omnis culpa itaque? Harum et, velit ratione corrupti error asperiores optio, recusandae mollitia necessitatibus cumque vero voluptatem ullam porro aut eum earum! Consectetur voluptatum ratione dolor in earum molestiae ipsam quisquam, eum vitae suscipit voluptates recusandae. Cum eaque officiis ea et atque eveniet similique sequi illo!', NULL, NULL, 2, NULL, NULL),
(12, 'Return Policy', 'return-policy', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate quae illo soluta sapiente minus voluptatibus molestias voluptates maiores repudiandae, velit quaerat error! Dolor alias voluptates rerum vitae illum officiis laboriosam, eos fugiat necessitatibus iste quasi vero porro at asperiores atque numquam adipisci esse perferendis hic dolore dolores facere quidem? Voluptatum, nemo voluptates. Qui, animi odit voluptatem velit nostrum rem maiores. Qui esse magnam enim natus numquam ab adipisci nihil mollitia odio ducimus architecto unde harum saepe illum, ipsa hic dicta alias cumque et minus veritatis assumenda a quo. Possimus, vitae est! Fuga quidem minima sunt modi. Officia natus quaerat nobis ut ab nulla. Tempora, corrupti? Animi excepturi voluptatem quod consectetur culpa autem aliquid? Inventore adipisci officia error dolore provident omnis sint perferendis, consequuntur, sapiente magni sequi quo quis nesciunt molestiae vero iure cum laboriosam fugit. Numquam sed expedita alias non? Sequi, harum cupiditate! Quasi non laboriosam optio ex fugit delectus minus incidunt excepturi! Nisi iure ex, nulla perspiciatis similique est, libero sapiente hic error amet, quisquam vel obcaecati fugit. Maxime cupiditate voluptatibus, nisi ullam error voluptas culpa at animi sequi eius suscipit ad ipsum qui illum provident dolores facere necessitatibus commodi vel in, laborum quidem aliquam ipsa quibusdam? Eius, alias voluptatem, laboriosam perferendis itaque, sapiente nisi beatae necessitatibus reprehenderit nam corrupti magnam qui omnis eveniet! Optio at expedita temporibus fugiat debitis eum? Dolore excepturi quod doloribus quam rem placeat at odit dicta amet expedita illo laboriosam minus ut minima, tenetur suscipit soluta assumenda. Nisi laboriosam adipisci animi consequuntur, ad illum repellat consequatur odit, laudantium velit non nobis labore illo omnis quod suscipit voluptates quaerat consectetur temporibus et, laborum quam ducimus earum! Repellat, fugit? Repudiandae repellendus maiores doloribus deleniti asperiores distinctio suscipit fugiat omnis culpa itaque? Harum et, velit ratione corrupti error asperiores optio, recusandae mollitia necessitatibus cumque vero voluptatem ullam porro aut eum earum! Consectetur voluptatum ratione dolor in earum molestiae ipsam quisquam, eum vitae suscipit voluptates recusandae. Cum eaque officiis ea et atque eveniet similique sequi illo!', NULL, NULL, 2, NULL, NULL),
(14, 'How It Works', 'How-It-Works', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate quae illo soluta sapiente minus voluptatibus molestias voluptates maiores repudiandae, velit quaerat error! Dolor alias voluptates rerum vitae illum officiis laboriosam, eos fugiat necessitatibus iste quasi vero porro at asperiores atque numquam adipisci esse perferendis hic dolore dolores facere quidem? Voluptatum, nemo voluptates. Qui, animi odit voluptatem velit nostrum rem maiores. Qui esse magnam enim natus numquam ab adipisci nihil mollitia odio ducimus architecto unde harum saepe illum, ipsa hic dicta alias cumque et minus veritatis assumenda a quo. Possimus, vitae est! Fuga quidem minima sunt modi. Officia natus quaerat nobis ut ab nulla. Tempora, corrupti? Animi excepturi voluptatem quod consectetur culpa autem aliquid? Inventore adipisci officia error dolore provident omnis sint perferendis, consequuntur, sapiente magni sequi quo quis nesciunt molestiae vero iure cum laboriosam fugit. Numquam sed expedita alias non? Sequi, harum cupiditate! Quasi non laboriosam optio ex fugit delectus minus incidunt excepturi! Nisi iure ex, nulla perspiciatis similique est, libero sapiente hic error amet, quisquam vel obcaecati fugit. Maxime cupiditate voluptatibus, nisi ullam error voluptas culpa at animi sequi eius suscipit ad ipsum qui illum provident dolores facere necessitatibus commodi vel in, laborum quidem aliquam ipsa quibusdam? Eius, alias voluptatem, laboriosam perferendis itaque, sapiente nisi beatae necessitatibus reprehenderit nam corrupti magnam qui omnis eveniet! Optio at expedita temporibus fugiat debitis eum? Dolore excepturi quod doloribus quam rem placeat at odit dicta amet expedita illo laboriosam minus ut minima, tenetur suscipit soluta assumenda. Nisi laboriosam adipisci animi consequuntur, ad illum repellat consequatur odit, laudantium velit non nobis labore illo omnis quod suscipit voluptates quaerat consectetur temporibus et, laborum quam ducimus earum! Repellat, fugit? Repudiandae repellendus maiores doloribus deleniti asperiores distinctio suscipit fugiat omnis culpa itaque? Harum et, velit ratione corrupti error asperiores optio, recusandae mollitia necessitatibus cumque vero voluptatem ullam porro aut eum earum! Consectetur voluptatum ratione dolor in earum molestiae ipsam quisquam, eum vitae suscipit voluptates recusandae. Cum eaque officiis ea et atque eveniet similique sequi illo!', '[{\"value\":\"a\"},{\"value\":\"b\"},{\"value\":\"c\"}]', NULL, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_settings`
--

DROP TABLE IF EXISTS `payment_settings`;
CREATE TABLE IF NOT EXISTS `payment_settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `information` text COLLATE utf8mb4_unicode_ci,
  `unique_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_settings`
--

INSERT INTO `payment_settings` (`id`, `name`, `information`, `unique_keyword`, `photo`, `text`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Cash On Delivery', NULL, 'cod', '1631032407index.png', 'Cash on Delivery basically means you will pay the amount of product while you get the item delivered to you.', 0, NULL, NULL),
(14, 'Stripe', '{\"key\":\"pk_test_51HZI80H3jdWvr8gEn3oRtFlnJTqRpecXGQueOyngEArTyF6gjjfOVqbFeFMpAMRoQmKwPPrh81OiWzhDlqtS5nGs00gKycg4Oa\",\"secret\":\"sk_test_51HZI80H3jdWvr8gErqdNWpqUkAgHMQdw7uug1mfUY38vIUfodsAWj4hoBK43rBvHebYETVX4ZCne03o3Ifco1qkR00dhrdpPsh\"}', 'stripe', '1601930611stripe-logo-blue.png', 'Stripe is the faster & safer way to send money. Make an online payment via Stripe.', 1, NULL, NULL),
(15, 'Paypal', '{\"client_id\":\"AUtv8KISHG9l9rmlXB0cSLjt6A91IsGfPACeRreuRpEV3GR-ZRnxIxXnUVKNYIfqVXrxs2uPlGDot0Cc\",\"client_secret\":\"EEdtOBI_NjI2bJzLSIzumsN_xSI7htn8qyAcRz0mvO8Emv-7CdfQeqxNZlDhiDAd0ZhV49e4sOhjtwho\",\"check_sandbox\":1}', 'paypal', '16218678201601930675paypal-784404_960_720.png', 'PayPal is the faster & safer way to send money. Make an online payment via PayPal.', 1, NULL, NULL),
(17, 'Mollie', '{\"key\":\"test_5HcWVs9qc5pzy36H9Tu9mwAyats33J\"}', 'mollie', '1621785282Mollie.jpeg', 'Mollie is a Payment Provider for Belgium and the Netherlands, offering payment methods such as credit card, iDEAL, Bancontact/Mister cash, PayPal, SCT, SDD and others.', 0, NULL, NULL),
(18, 'Paytm', '{\"mercent\":\"test_5HcWVs9qc5pzy36H9Tu9mwAyats33J\",\"client_secret\":\"test_5HcWVs9qc5pzy36H9Tu9mwAyats33J\",\"website\":\"test_5HcWVs9qc5pzy36H9Tu9mwAyats33J\",\"industry\":\"test_5HcWVs9qc5pzy36H9Tu9mwAyats33J\",\"is_paytm\":\"test_5HcWVs9qc5pzy36H9Tu9mwAyats33J\"}', 'paytm', '1631978815images.png', 'Paytm is the faster & safer way to send money. Make an online payment via Paytm.', 0, NULL, NULL),
(19, 'SSLCommerz', '{\"store_id\":\"geniu5e1b00621f81e\",\"store_password\":\"geniu5e1b00621f81e@ssl\",\"check_sandbox\":1}', 'sslcommerz', '1631978716ssl-thumb.jpeg', 'SSL commerz is the faster & safer way to send money. Make an online payment via SSL commerz.', 0, NULL, NULL),
(24, 'Mercadopago', '{\"public_key\":\"TEST-6f72a502-51c8-4e9a-8ca3-cb7fa0addad8\",\"token\":\"TEST-6068652511264159-022306-e78da379f3963916b1c7130ff2906826-529753482\",\"check_sandbox\":1}', 'mercadopago', '1633085560unnamed.jpeg', 'Mercadopago is the faster & safer way to send money. Make an online payment via Mercadopago.', 0, NULL, NULL),
(25, 'Authorize.Net', '{\"login_id\":\"76zu9VgUSxrJ\",\"txn_key\":\"2Vj62a6skSrP5U3X\",\"check_sandbox\":1}', 'authorize', '1633100640seal2.png', 'Authorize.Net is the faster & safer way to send money. Make an online payment via Authorize.Net', 0, NULL, NULL),
(26, 'Paystack', '{\"key\":\"pk_test_162a56d42131cbb01932ed0d2c48f9cb99d8e8e2\",\"email\":\"geniusdevs@gmail.com\"}', 'paystack', '1634237632paystack-opengraph.png', 'Paystack is the faster & safer way to send money. Make an online payment via Paystack.', 0, NULL, NULL),
(27, 'Bank Transfer', NULL, 'bank', '1638530860pngwing.com (1).png', '<p>Account Number : 434 3434 3334</p><p>Pay With Bank Transfer.</p><p>Account Name : Jhon Due</p><p>Account Email : demo@gmail.com</p>', 1, NULL, NULL),
(28, 'Razorpay', '{\"key\":\"rzp_test_xDH74d48cwl8DF\",\"secret\":\"cr0H1BiQ20hVzhpHfHuNbGri\"}', 'razorpay', '1637992878download.jpeg', 'Rezorpay is the faster & safer way to send money. Make an online payment via Rezorpay.', 0, NULL, NULL),
(29, 'Flutter Wave', '{\"public_key\":\"FLWPUBK_TEST-d54c4c69ef195e721af2139e7dfe1a23-X\",\"secret_key\":\"FLWSECK_TEST-86c6484143e62c4c9bc2e8aa08a07c92-X\",\"text\":\"Pay via your Flutter Wave account.\"}', 'flutterwave', '1637998096download.png', 'Flutterwave is the faster & safer way to send money. Make an online payment via Flutterwave.', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_descriptions` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promo_codes`
--

DROP TABLE IF EXISTS `promo_codes`;
CREATE TABLE IF NOT EXISTS `promo_codes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_of_times` int(11) NOT NULL DEFAULT '0',
  `discount` double NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promo_codes`
--

INSERT INTO `promo_codes` (`id`, `title`, `code_name`, `no_of_times`, `discount`, `status`, `created_at`, `updated_at`, `type`) VALUES
(1, 'Flash Discount', 'ironman', 95, 2, 1, NULL, NULL, NULL),
(2, 'Halloween Carnival', 'superman', 96, 5, 1, NULL, NULL, NULL),
(3, 'Fest Carnival', 'loki', 94, 10, 1, NULL, NULL, 'amount');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `review` text COLLATE utf8mb4_unicode_ci,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` double NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `section`, `created_at`, `updated_at`) VALUES
(1, 'test', '[\"Manage Categories\",\"Manage Products\",\"Manage Orders\",\"Transactions\",\"Ecommerce\",\"Customer List\",\"Manages Tickets\",\"Manage Site\",\"Manage Faqs Contents\",\"Manage Blogs\",\"Manages Pages\",\"Subscribers List\",\"Manage System User\"]', '2021-12-05 10:24:27', '2021-12-05 10:24:27');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `details`, `photo`, `created_at`, `updated_at`) VALUES
(31, 'Secure Online Payment', 'We posess SSL / Secure Certificate', '162196474904.png', NULL, NULL),
(32, '24/7 Customer Support', 'Friendly 24/7 customer support', '162196471103.png', NULL, NULL),
(33, 'Money Back Guarantee', 'We return money within 30 days', '162196467602.png', NULL, NULL),
(34, 'Free Worldwide Shipping', 'Free shipping for all orders over $100 Contrary to popular belie', '162196463701.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loader` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_loader` tinyint(4) DEFAULT '1',
  `feature_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_check` tinyint(4) DEFAULT '0',
  `email_host` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_port` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_encryption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_pass` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_from_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overlay` text COLLATE utf8mb4_unicode_ci,
  `google_analytics_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `is_shop` tinyint(4) DEFAULT '1',
  `is_blog` tinyint(4) DEFAULT '1',
  `is_faq` tinyint(4) DEFAULT '1',
  `is_contact` tinyint(4) DEFAULT '1',
  `facebook_check` tinyint(4) DEFAULT '1',
  `facebook_client_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_client_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_redirect` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_check` tinyint(4) DEFAULT '1',
  `google_client_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_client_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_redirect` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_price` double DEFAULT '0',
  `max_price` double DEFAULT '100000',
  `footer_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_address` text COLLATE utf8mb4_unicode_ci,
  `footer_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_gateway_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_link` text COLLATE utf8mb4_unicode_ci,
  `friday_start` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `friday_end` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satureday_start` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satureday_end` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy_right` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_slider` tinyint(4) DEFAULT '1',
  `is_category` tinyint(4) DEFAULT '1',
  `is_product` tinyint(4) DEFAULT '1',
  `is_top_banner` tinyint(4) DEFAULT '1',
  `is_recent` tinyint(4) DEFAULT '1',
  `is_top` tinyint(4) DEFAULT '1',
  `is_best` tinyint(4) DEFAULT '1',
  `is_flash` tinyint(4) DEFAULT '1',
  `is_brand` tinyint(4) DEFAULT '1',
  `is_blogs` tinyint(4) DEFAULT '1',
  `is_campaign` tinyint(4) DEFAULT '1',
  `is_brands` tinyint(4) DEFAULT '1',
  `is_bottom_banner` tinyint(4) DEFAULT '1',
  `is_service` tinyint(4) DEFAULT '1',
  `campaign_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `campaign_end_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `campaign_status` tinyint(4) DEFAULT '1',
  `twilio_sid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twilio_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twilio_form_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twilio_country_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_announcement` tinyint(4) DEFAULT '1',
  `announcement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `announcement_delay` decimal(11,2) NOT NULL DEFAULT '0.00',
  `is_maintainance` tinyint(4) DEFAULT '1',
  `maintainance_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maintainance_text` text COLLATE utf8mb4_unicode_ci,
  `is_twilio` tinyint(4) DEFAULT '0',
  `twilio_section` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_three_c_b_first` tinyint(4) NOT NULL DEFAULT '1',
  `is_popular_category` tinyint(4) NOT NULL DEFAULT '1',
  `is_three_c_b_second` tinyint(4) NOT NULL DEFAULT '1',
  `is_highlighted` tinyint(4) NOT NULL DEFAULT '1',
  `is_two_column_category` tinyint(4) NOT NULL DEFAULT '1',
  `is_popular_brand` tinyint(4) NOT NULL DEFAULT '1',
  `is_featured_category` tinyint(4) NOT NULL DEFAULT '1',
  `is_two_c_b` tinyint(4) NOT NULL DEFAULT '1',
  `theme` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_recaptcha_site_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_recaptcha_secret_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recaptcha` tinyint(4) DEFAULT '0',
  `currency_direction` tinyint(4) DEFAULT '1',
  `google_analytics` text COLLATE utf8mb4_unicode_ci,
  `google_adsense` text COLLATE utf8mb4_unicode_ci,
  `facebook_pixel` text COLLATE utf8mb4_unicode_ci,
  `facebook_messenger` text COLLATE utf8mb4_unicode_ci,
  `is_google_analytics` tinyint(4) DEFAULT '0',
  `is_google_adsense` tinyint(4) DEFAULT '0',
  `is_facebook_pixel` tinyint(4) DEFAULT '0',
  `is_facebook_messenger` tinyint(4) DEFAULT '0',
  `announcement_link` text COLLATE utf8mb4_unicode_ci,
  `is_attribute_search` tinyint(4) DEFAULT '1',
  `is_range_search` tinyint(4) DEFAULT '1',
  `view_product` int(11) DEFAULT '12',
  `home_page_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Home',
  `is_privacy_trams` tinyint(4) DEFAULT '1',
  `policy_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '''#''',
  `terms_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '''#''',
  `is_guest_checkout` tinyint(4) DEFAULT '1',
  `custom_css` text COLLATE utf8mb4_unicode_ci,
  `announcement_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `announcement_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'banner',
  `is_cookie` tinyint(4) DEFAULT '1',
  `cookie_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `announcement_details` text COLLATE utf8mb4_unicode_ci,
  `decimal_separator` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '.',
  `thousand_separator` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT ',',
  `disqus` text COLLATE utf8mb4_unicode_ci,
  `is_disqus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `logo`, `favicon`, `loader`, `is_loader`, `feature_image`, `primary_color`, `smtp_check`, `email_host`, `email_port`, `email_encryption`, `email_user`, `email_pass`, `email_from`, `email_from_name`, `contact_email`, `version`, `overlay`, `google_analytics_id`, `meta_keywords`, `meta_description`, `is_shop`, `is_blog`, `is_faq`, `is_contact`, `facebook_check`, `facebook_client_id`, `facebook_client_secret`, `facebook_redirect`, `google_check`, `google_client_id`, `google_client_secret`, `google_redirect`, `min_price`, `max_price`, `footer_phone`, `footer_address`, `footer_email`, `footer_gateway_img`, `social_link`, `friday_start`, `friday_end`, `satureday_start`, `satureday_end`, `copy_right`, `is_slider`, `is_category`, `is_product`, `is_top_banner`, `is_recent`, `is_top`, `is_best`, `is_flash`, `is_brand`, `is_blogs`, `is_campaign`, `is_brands`, `is_bottom_banner`, `is_service`, `campaign_title`, `campaign_end_date`, `campaign_status`, `twilio_sid`, `twilio_token`, `twilio_form_number`, `twilio_country_code`, `is_announcement`, `announcement`, `announcement_delay`, `is_maintainance`, `maintainance_image`, `maintainance_text`, `is_twilio`, `twilio_section`, `created_at`, `updated_at`, `is_three_c_b_first`, `is_popular_category`, `is_three_c_b_second`, `is_highlighted`, `is_two_column_category`, `is_popular_brand`, `is_featured_category`, `is_two_c_b`, `theme`, `google_recaptcha_site_key`, `google_recaptcha_secret_key`, `recaptcha`, `currency_direction`, `google_analytics`, `google_adsense`, `facebook_pixel`, `facebook_messenger`, `is_google_analytics`, `is_google_adsense`, `is_facebook_pixel`, `is_facebook_messenger`, `announcement_link`, `is_attribute_search`, `is_range_search`, `view_product`, `home_page_title`, `is_privacy_trams`, `policy_link`, `terms_link`, `is_guest_checkout`, `custom_css`, `announcement_title`, `announcement_type`, `is_cookie`, `cookie_text`, `announcement_details`, `decimal_separator`, `thousand_separator`, `disqus`, `is_disqus`) VALUES
(1, 'OmniMart', '1651058065sample_logo.png', '1629651232pre.png', '16388581681_D-ZiKd0B00tdifaB2X3tKQ.gif', 0, '1600622296topic.jpg', '#FF6A00', 1, 'smtp.mailtrap.io', '465', 'tls', '634f5d29d8b783', 'd95e268fc665c7', 'omnimartshop@email.com', 'Magicshop', 'contact@email.com', '4.0', NULL, 'UA-106757798-1', 'Lorem,ipsum,dolor,amet', 'Omnimart - Multipurpose eCommerce  Shopping Platform Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over .', 1, 1, 0, 0, 1, '643929170080071', '038b2100dff9a2a684c85959c0accf66', 'https://localhost/my/omnimart/auth/facebook/callback', 1, '915191002660-6hjno4cgnbcm5p1kb3t692trh7pc6ngh.apps.googleusercontent.com', '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', 'http://localhost/my/omnimart/auth/google/callback', 0, 10000, '453876234', 'Demo Address', 'demoemail123@gmail.com', '16305963101621960148credit-cards-footer.png', '{\"icons\":[\"fab fa-facebook-f\",\"fab fa-twitter\",\"fab fa-youtube\",\"fab fa-linkedin-in\"],\"links\":[\"https:\\/\\/www.facebook.com\",\"https:\\/\\/www.twitter.com\",\"https:\\/\\/www.youtube.com\",\"https:\\/\\/www.linkedin.com\"]}', '9:27 PM', '9:27 PM', '9:27 PM', '9:27 PM', '© All rights reserved.', 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 'Deals Of The Week', '10/10/2022', 1, 'AC73e54518487ad4e26da8b465a7614f1f0', '300d787df0c398ae46b84b74ea86f59c', '+15612793758', '+880', 1, '1638791990Untitled-1.jpg', '1.00', 0, '16323327831619241714761747856.jpg', 'We are upgrading our site.  We will come back soon.  \r\nPlease stay with us. \r\nThank you.', 1, '{\"\'purchase\'\":\"Your Order Purchase Successfully....\",\"\'order_status\'\":\"Your Order status update....\"}', NULL, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 'theme1', '6LcnPoEaAAAAAF6QhKPZ8V4744yiEnr41li3SYDn', '6LcnPoEaAAAAACV_xC4jdPqumaYKBnxz9Sj6y0zk', 1, 1, NULL, NULL, NULL, '<!-- Messenger Chat Plugin Code -->\r\n    <div id=\"fb-root\"></div>\r\n\r\n    <!-- Your Chat Plugin code -->\r\n    <div id=\"fb-customer-chat\" class=\"fb-customerchat\">\r\n    </div>\r\n\r\n    <script>\r\n      var chatbox = document.getElementById(\'fb-customer-chat\');\r\n      chatbox.setAttribute(\"page_id\", \"858401617860382\");\r\n      chatbox.setAttribute(\"attribution\", \"biz_inbox\");\r\n      window.fbAsyncInit = function() {\r\n        FB.init({\r\n          xfbml            : true,\r\n          version          : \'v11.0\'\r\n        });\r\n      };\r\n\r\n      (function(d, s, id) {\r\n        var js, fjs = d.getElementsByTagName(s)[0];\r\n        if (d.getElementById(id)) return;\r\n        js = d.createElement(s); js.id = id;\r\n        js.src = \'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js\';\r\n        fjs.parentNode.insertBefore(js, fjs);\r\n      }(document, \'script\', \'facebook-jssdk\'));\r\n    </script>', 0, 0, 0, 0, '#', 1, 1, 16, 'Ecommerce Shopping Platform', 1, 'http://localhost/my/omnimart3/privacy-policy', 'http://localhost/my/omnimart3/terms-and-service', 1, NULL, 'Get 50% Discount.', 'newletter', 1, 'Your experience on this site will be improved by allowing cookies.', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, facere nesciunt doloremque nobis debitis sint?', '.', ',', '<div id=\"disqus_thread\"></div>\r\n<script>\r\n    /**\r\n    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.\r\n    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */\r\n    /*\r\n    var disqus_config = function () {\r\n    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page\'s canonical URL variable\r\n    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page\'s unique identifier variable\r\n    };\r\n    */\r\n    (function() { // DON\'T EDIT BELOW THIS LINE\r\n    var d = document, s = d.createElement(\'script\');\r\n    s.src = \'https://omnimart.disqus.com/embed.js\';\r\n    s.setAttribute(\'data-timestamp\', +new Date());\r\n    (d.head || d.body).appendChild(s);\r\n    })();\r\n</script>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_services`
--

DROP TABLE IF EXISTS `shipping_services`;
CREATE TABLE IF NOT EXISTS `shipping_services` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double NOT NULL DEFAULT '0',
  `minimum_price` double NOT NULL DEFAULT '0',
  `is_condition` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_services`
--

INSERT INTO `shipping_services` (`id`, `title`, `price`, `minimum_price`, `is_condition`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Free Delevery', 0, 1000, 1, 1, NULL, NULL),
(2, 'Delivery', 20, 0, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sitemaps`
--

DROP TABLE IF EXISTS `sitemaps`;
CREATE TABLE IF NOT EXISTS `sitemaps` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sitemap_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sitemaps`
--

INSERT INTO `sitemaps` (`id`, `sitemap_url`, `filename`, `created_at`, `updated_at`) VALUES
(1, 'http://localhost/omnimart30/', 'sitemap6166b213a58e4.xml', NULL, NULL),
(4, 'http://localhost/omnimart30/catalog', 'sitemap6166b378db752.xml', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `home_page` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'theme1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `photo`, `title`, `link`, `logo`, `details`, `created_at`, `updated_at`, `home_page`) VALUES
(7, '1634222159h3s.jpg', '40% OFF', '#', '1634222445Untitled-2.png', 'SANROCK U52 Drone with 1080P HD Camera', NULL, NULL, 'theme3'),
(8, '1634222112h3s.jpg', '40% OFF', '#', '1634222436Untitled-1.png', 'Smart Watch New healthy life sleep heart  monitor', NULL, NULL, 'theme3'),
(10, '1636898335s1.jpg', '65% OFF', '#', NULL, 'It is a long established fact that a reader will be distracted by the readable content', NULL, NULL, 'theme2'),
(11, '1636897593s2.jpg', 'theme 4', '#', NULL, 'theme4', NULL, NULL, 'theme4'),
(13, '1636897586s1.jpg', 'theme 4', '#', '16342200802.jpg', 'theme4', NULL, NULL, 'theme4'),
(16, '16343905891630493728s2.jpg', '50% OFF', '#', NULL, 'Sleeve Party Dress', NULL, NULL, 'theme1'),
(17, '16343906281630493865s3.jpg', '70% OFF', '#', NULL, 'Women Clothing', NULL, NULL, 'theme1'),
(18, '1636898373s2.jpg', '40% OFF', '#', NULL, 'It is a long established fact that a reader will be distracted by the readable content', NULL, NULL, 'theme2');

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

DROP TABLE IF EXISTS `socials`;
CREATE TABLE IF NOT EXISTS `socials` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `link` text COLLATE utf8mb4_unicode_ci,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `socials`
--

INSERT INTO `socials` (`id`, `link`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'https://www.facebook.com/', 'fab fa-facebook-square', NULL, NULL),
(2, 'https://twitter.com/', 'fab fa-twitter-square', NULL, NULL),
(3, 'https://www.instagram.com/', 'fab fa-instagram', NULL, NULL),
(10, 'https://www.pinterest.com/', 'fab fa-pinterest-square', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE IF NOT EXISTS `states` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `price`, `status`, `type`) VALUES
(8, 'Switzerland', 5, 1, 'percentage'),
(9, 'Germany', 6, 1, 'percentage'),
(10, 'Austria', 6, 1, 'percentage');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

DROP TABLE IF EXISTS `subcategories`;
CREATE TABLE IF NOT EXISTS `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `navigation_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `special_desc` text COLLATE utf8mb4_unicode_ci,
  `category_id` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `slug`, `navigation_img`, `header_img`, `description`, `special_desc`, `category_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Stone Tiles', 'Stone-Tiles', NULL, NULL, '<p><span style=\"color: rgb(0, 0, 0);\">Stone Tile Description</span><br></p>', '<p><span style=\"color: rgb(0, 0, 0);\">Stone Tile Short Description</span><br></p>', 28, 1, NULL, NULL),
(30, 'Grenite', 'grenite', NULL, NULL, NULL, NULL, 32, 1, NULL, NULL),
(31, 'Concrete Tiles', 'concrete-tiles', NULL, NULL, NULL, NULL, 28, 1, NULL, NULL),
(46, 'Marble Tiles', 'marble-tiles', NULL, NULL, NULL, NULL, 32, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory_galleries`
--

DROP TABLE IF EXISTS `subcategory_galleries`;
CREATE TABLE IF NOT EXISTS `subcategory_galleries` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `subcategory_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'user@gmail.com', NULL, NULL),
(2, 'irfan.elahi187@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

DROP TABLE IF EXISTS `taxes`;
CREATE TABLE IF NOT EXISTS `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` double DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `name`, `value`, `status`, `created_at`, `updated_at`) VALUES
(1, 'High Tax', 4, 1, NULL, NULL),
(2, 'Low Tax', 1, 1, NULL, NULL),
(3, 'No Tax', 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `subject`, `message`, `file`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'I need help', 'I need help', NULL, 1, NULL, '2021-12-03 06:32:39', '2021-12-03 06:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `track_orders`
--

DROP TABLE IF EXISTS `track_orders`;
CREATE TABLE IF NOT EXISTS `track_orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=316 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `track_orders`
--

INSERT INTO `track_orders` (`id`, `order_id`, `title`, `created_at`, `updated_at`) VALUES
(176, 318, 'Pending', '2021-09-12 06:07:09', '2021-09-12 06:07:09'),
(177, 1, 'Pending', '2021-09-13 07:11:25', '2021-09-13 07:11:25'),
(178, 22, 'Pending', '2021-09-13 09:13:48', '2021-09-13 09:13:48'),
(179, 22, 'Pending', '2021-09-13 09:14:34', '2021-09-13 09:14:34'),
(180, 23, 'Pending', '2021-09-13 09:15:09', '2021-09-13 09:15:09'),
(182, 25, 'Pending', '2021-09-13 09:22:56', '2021-09-13 09:22:56'),
(187, 30, 'Pending', '2021-09-18 08:44:06', '2021-09-18 08:44:06'),
(298, 120, 'Pending', '2022-01-16 09:13:39', '2022-01-16 09:13:39'),
(299, 121, 'Pending', '2022-01-16 09:36:54', '2022-01-16 09:36:54'),
(300, 122, 'Pending', '2022-01-16 09:37:45', '2022-01-16 09:37:45'),
(301, 123, 'Pending', '2022-01-16 10:00:15', '2022-01-16 10:00:15'),
(302, 124, 'Pending', '2022-01-16 10:03:35', '2022-01-16 10:03:35'),
(303, 125, 'Pending', '2022-01-16 10:08:36', '2022-01-16 10:08:36'),
(304, 126, 'Pending', '2022-01-16 11:31:41', '2022-01-16 11:31:41'),
(305, 127, 'Pending', '2022-01-16 11:33:57', '2022-01-16 11:33:57'),
(306, 128, 'Pending', '2022-01-16 11:36:51', '2022-01-16 11:36:51'),
(307, 129, 'Pending', '2022-01-16 11:40:48', '2022-01-16 11:40:48'),
(308, 129, 'In Progress', '2022-01-17 03:59:09', '2022-01-17 03:59:09'),
(309, 129, 'Delivered', '2022-01-17 03:59:09', '2022-01-17 03:59:09'),
(310, 128, 'In Progress', '2022-01-17 03:59:15', '2022-01-17 03:59:15'),
(311, 128, 'Delivered', '2022-01-17 03:59:15', '2022-01-17 03:59:15'),
(312, 127, 'In Progress', '2022-01-17 03:59:21', '2022-01-17 03:59:21'),
(313, 127, 'Delivered', '2022-01-17 03:59:21', '2022-01-17 03:59:21'),
(314, 126, 'In Progress', '2022-01-17 03:59:27', '2022-01-17 03:59:27'),
(315, 126, 'Delivered', '2022-01-17 03:59:27', '2022-01-17 03:59:27');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `txn_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_sign` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_value` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_address1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_address1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `phone`, `email`, `photo`, `email_token`, `password`, `ship_address1`, `ship_address2`, `ship_zip`, `ship_city`, `ship_country`, `ship_company`, `bill_address1`, `bill_address2`, `bill_zip`, `bill_city`, `bill_country`, `bill_company`, `created_at`, `updated_at`, `state_id`) VALUES
(1, 'Alex', 'Smith', '01728332009', 'user@gmail.com', '16385217454444.jpg', 'JMpl3Y', '$2y$10$Ba2ME37LN5v38f58fIpYDOda9rdyTfl4LKA.Iyfp.ii.vrVe8saXG', '472 Clark Street,  Bay Shore, New York', NULL, '3444', 'New York', 'United States', NULL, '472 Clark Street,  Bay Shore, New York', NULL, '3444', 'New York', 'United States', NULL, '2021-09-13 07:08:04', '2022-01-04 09:42:42', NULL),
(4, 'Showrav', 'Hasan', NULL, 'showrabhasan715@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-04 10:53:23', '2022-01-04 10:53:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_order_informations`
--

DROP TABLE IF EXISTS `user_order_informations`;
CREATE TABLE IF NOT EXISTS `user_order_informations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `custome_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

DROP TABLE IF EXISTS `warehouses`;
CREATE TABLE IF NOT EXISTS `warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `delivery_time`, `created_at`, `updated_at`) VALUES
(2, 'New Warehouse', '16:30:00', '2022-04-18 23:33:25', '2022-04-20 03:31:52');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_availabilities`
--

DROP TABLE IF EXISTS `warehouse_availabilities`;
CREATE TABLE IF NOT EXISTS `warehouse_availabilities` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `attribute_options_id` bigint(20) DEFAULT NULL,
  `availability` int(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `warehouse_availabilities`
--

INSERT INTO `warehouse_availabilities` (`id`, `attribute_options_id`, `availability`, `created_at`, `updated_at`) VALUES
(1, 1278, 50, '2022-04-18 16:01:09', '2022-04-18 16:01:09'),
(2, 1279, 22, '2022-04-18 16:02:47', '2022-04-18 16:02:47'),
(3, 1280, 32, '2022-04-18 16:48:13', '2022-04-18 16:48:13'),
(4, 1281, 70, '2022-04-18 16:48:39', '2022-04-18 16:48:39'),
(5, 1282, NULL, '2022-04-18 17:44:49', '2022-04-18 17:44:49'),
(6, 1283, 50, '2022-04-18 17:46:27', '2022-04-18 17:46:27'),
(7, 1285, 90, '2022-04-18 17:52:57', '2022-04-18 17:52:57'),
(8, 1280, 2, '2022-04-21 04:04:43', '2022-04-21 04:04:43'),
(9, 1286, 50, '2022-04-22 05:45:26', '2022-04-22 09:52:13'),
(10, 1287, 34, '2022-04-22 10:07:28', '2022-04-22 10:07:28'),
(11, 1290, 34, '2022-04-22 10:50:09', '2022-04-22 10:50:09'),
(12, 1291, NULL, '2022-04-24 22:41:56', '2022-04-24 22:41:56'),
(13, 1291, 100, '2022-04-25 17:01:08', '2022-04-25 17:01:08'),
(14, 1294, 150, '2022-04-27 05:48:56', '2022-04-27 05:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
CREATE TABLE IF NOT EXISTS `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_options`
--
ALTER TABLE `attribute_options`
  ADD CONSTRAINT `attribute_options_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);

--
-- Constraints for table `category_images`
--
ALTER TABLE `category_images`
  ADD CONSTRAINT `category_images_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
