-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 06, 2025 at 06:31 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping_application`
--

-- --------------------------------------------------------

--
-- Table structure for table `addtocart`
--

DROP TABLE IF EXISTS `addtocart`;
CREATE TABLE IF NOT EXISTS `addtocart` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `quantity` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `addtocart_user_id_foreign` (`user_id`),
  KEY `addtocart_product_id_foreign` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=484 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addtocart`
--

INSERT INTO `addtocart` (`id`, `user_id`, `product_id`, `quantity`, `deleted_at`, `created_at`, `updated_at`, `message`) VALUES
(69, 13, 16, 1, '2025-11-04 01:04:26', '2025-10-06 00:07:54', '2025-11-04 01:04:26', ''),
(70, 13, 32, 1, '2025-11-04 01:04:26', '2025-10-06 00:07:59', '2025-11-04 01:04:26', ''),
(71, 13, 6, 1, '2025-11-04 01:04:26', '2025-10-06 00:08:08', '2025-11-04 01:04:26', ''),
(72, 14, 5, 1, NULL, '2025-10-06 00:11:59', '2025-10-06 00:11:59', ''),
(73, 14, 23, 1, NULL, '2025-10-06 00:12:04', '2025-10-06 00:12:04', ''),
(74, 14, 20, 1, NULL, '2025-10-06 00:12:13', '2025-10-06 00:12:13', ''),
(483, 11, 15, 1, NULL, '2025-11-05 05:04:18', '2025-11-05 05:04:18', ''),
(482, 4, 2, 1, NULL, '2025-11-04 22:49:05', '2025-11-04 22:49:05', ''),
(481, 4, 1, 1, NULL, '2025-11-04 22:47:09', '2025-11-05 04:40:08', ''),
(480, 3, 9, 1, '2025-11-04 01:26:29', '2025-11-04 01:26:26', '2025-11-04 01:26:29', ''),
(479, 4, 24, 1, NULL, '2025-11-04 01:25:50', '2025-11-04 01:25:50', ''),
(478, 13, 20, 1, '2025-11-04 01:25:30', '2025-11-04 01:25:24', '2025-11-04 01:25:30', ''),
(477, 13, 6, 1, '2025-11-04 01:25:30', '2025-11-04 01:25:19', '2025-11-04 01:25:30', ''),
(476, 13, 5, 1, '2025-11-04 01:25:30', '2025-11-04 01:25:14', '2025-11-04 01:25:30', ''),
(475, 4, 6, 1, '2025-11-04 00:19:33', '2025-11-04 00:19:30', '2025-11-04 00:19:33', ''),
(474, 4, 15, 1, '2025-11-04 00:18:15', '2025-11-04 00:18:12', '2025-11-04 00:18:15', ''),
(473, 3, 13, 1, '2025-11-04 00:17:23', '2025-11-04 00:17:18', '2025-11-04 00:17:23', ''),
(472, 3, 13, 1, '2025-11-04 00:16:26', '2025-11-04 00:16:23', '2025-11-04 00:16:26', ''),
(464, 4, 1, 1, '2025-11-03 22:38:34', '2025-11-03 06:58:11', '2025-11-03 22:38:34', 'allow'),
(471, 4, 1, 1, '2025-11-04 01:25:54', '2025-11-03 23:13:41', '2025-11-04 01:25:54', 'allow'),
(470, 4, 1, 1, '2025-11-03 22:39:55', '2025-11-03 22:39:43', '2025-11-03 22:39:55', ''),
(469, 3, 1, 1, '2025-11-04 01:26:22', '2025-11-03 07:21:48', '2025-11-04 01:26:22', 'allow'),
(468, 3, 1, 1, '2025-11-03 07:21:39', '2025-11-03 07:14:12', '2025-11-03 07:21:39', 'allow');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin123@gmail.com', 'Admin123@', NULL, '2025-10-07 03:39:36'),
(2, 'Admin02', 'admin02@gmail.com', 'Admin02@', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupen`
--

DROP TABLE IF EXISTS `coupen`;
CREATE TABLE IF NOT EXISTS `coupen` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupen`
--

INSERT INTO `coupen` (`id`, `name`, `code`, `value`, `created_at`, `updated_at`) VALUES
(1, 'HDFC', '123hdfc', '4000', NULL, NULL),
(2, 'SBI', '123sbi', '2000', NULL, NULL),
(3, 'AXIS', '123axis', '3000', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customerandshopkeeper`
--

DROP TABLE IF EXISTS `customerandshopkeeper`;
CREATE TABLE IF NOT EXISTS `customerandshopkeeper` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pincode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rols` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `countrycode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customerandshopkeeper`
--

INSERT INTO `customerandshopkeeper` (`id`, `name`, `address`, `city`, `state`, `country`, `pincode`, `gender`, `phone`, `email`, `password`, `rols`, `created_at`, `updated_at`, `deleted_at`, `countrycode`) VALUES
(1, 'shopkeeper01', 'Bhambhan Road seri no. 2', '150551', '5083', '250', '382350', 'male', '9898989800', 'shopkeeper01@gmail.com', 'eyJpdiI6IkJXajkrRVNrUGxZajhjTXdReFNtbFE9PSIsInZhbHVlIjoiOGkyenFnYytydW5jTDN6VkVyUkhaUT09IiwibWFjIjoiMWFkZGY2N2FjNGQ1NjYyM2NjZDRkM2QyYjQ5MDg2NzBmZTM3Y2UxMjYxZWNhYmRiZDZhOGI2MjVlN2ZhZTQzYSIsInRhZyI6IiJ9', 'Shopkeeper', '2025-09-18 03:17:20', '2025-10-28 05:23:36', NULL, 'IN'),
(2, 'shopkeeper02', 'keyur park 52', '45544', '1649', '102', '909890', 'female', '789898980', 'shopkeeper02@gmail.com', 'eyJpdiI6ImNUYVhlSU9YMFJpbURtM0JRaEhIMVE9PSIsInZhbHVlIjoiMTUxOXc2amQxMVN3M25hcG8zdjJSZz09IiwibWFjIjoiYjkyMThiMWI5ZTgwM2M5MjYwYWVmMmU0YWI2ZGMwYmQwMjFlNTFkZWQ5MTAyZmQ1Mzk1ZTRkZjMzNzU2YjMxNSIsInRhZyI6IiJ9', 'Shopkeeper', '2025-09-18 03:20:16', '2025-10-29 00:04:45', NULL, 'AF'),
(3, 'Customer01', 'gitanagar', '150546', '5082', '250', '382350', 'female', '9898989803', 'customer01@gmail.com', 'eyJpdiI6ImFZdm9mczl5WkVsQWlUdXE2U2h2TFE9PSIsInZhbHVlIjoiZnRXRWVEemd3Y01YaWFTYWlxdWxlZz09IiwibWFjIjoiNjllN2E3MTY3NjU2ZmY4M2ZiNzdkNzNiODBkMTlkMjE2YTdiOTViMGYxNGYwMWY2ZTYyODMxMzA3YTc1ZGI5ZiIsInRhZyI6IiJ9', 'Customer', '2025-09-18 03:21:39', '2025-10-17 00:54:19', NULL, 'IN'),
(4, 'Customer02', 'keyur park 52', '45621', '1650', '102', '382352', 'male', '9898989804', 'customer02@gmail.com', 'eyJpdiI6IlVJZ2RZbm5ESjRsMWF0aE5ya0pUOXc9PSIsInZhbHVlIjoicGZKaDlUMGF2TXk0ZHBVYU5XNUhUQT09IiwibWFjIjoiOGVhM2NjOWQ0ZDM2NWY3NWRmYmUzNzQzNjQ3NjdkYWE4ZDJjOTg5YTQyNWQ2OGYzZjJiZThkNTFhNjJmYzM4MSIsInRhZyI6IiJ9', 'Customer', '2025-09-18 03:22:46', '2025-10-29 00:02:25', NULL, 'IN'),
(13, 'Customer07', 'gitanagar', '101229', '3422', '182', '364710', 'male', '9898989101', 'customer07@gmail.com', 'eyJpdiI6Ii9EYnpwSmZkY2Y0T0dpRHhzSm5ibmc9PSIsInZhbHVlIjoiVm9jTlpkMkt5VDFsZU1HTWY4cWpuUT09IiwibWFjIjoiM2E1MGZiNGY2MWQ0MDYyNzM3YmExNGY3NTdiMDBkZTM1ZDgyNzY3MjU1Njg0MjEwNWJmNTY3MDdkOGNmYTIyZCIsInRhZyI6IiJ9', 'Customer', '2025-10-06 00:01:42', '2025-10-06 00:01:42', NULL, 'IN'),
(5, 'shopkeeper03', 'botad', '45584', '1650', '102', '382353', 'female', '0398989898', 'shopkeeper03@gmail.com', 'eyJpdiI6IjA2Yk5ocVY2MWJMZFNFc2hxK3ZZSEE9PSIsInZhbHVlIjoiV0wwR1RkMndIMmdsTWZpZGpaTW9Ldz09IiwibWFjIjoiOTg0NDMwYTlhYzIyMjFlNTlmZTk2Y2Y3ODI1Y2Y5M2EwYzI1M2Y3ZjUzNjFjYjUxYjU1ZWI5ZmFjMWI4MTVmZCIsInRhZyI6IiJ9', 'Shopkeeper', '2025-09-30 05:22:48', '2025-09-30 05:22:48', NULL, 'IN'),
(6, 'shopkeeper04', 'gitanagar', '240', '84', '4', '382353', 'female', '0498989898', 'shopkeeper04@gmail.com', 'eyJpdiI6ImRMcml6YnMvL1owckhzQjdiYitrM3c9PSIsInZhbHVlIjoiZzN4L0xDQkM4aGFTM2hPUys1cXFUQT09IiwibWFjIjoiMjhiNGJiOThjZjEyMjA4M2QyMmJkZTczMDFkMDViNjhmOGQ3N2M4NWRmMTZiYzM0ZjUzNmI1ZDZlMTBhZTlhYiIsInRhZyI6IiJ9', 'Shopkeeper', '2025-09-30 05:23:34', '2025-09-30 05:23:34', NULL, 'IN'),
(7, 'shopkeeper05', 'keyur park', '8571', '302', '17', '382350', 'male', '0598989898', 'shopkeeper05@gmail.com', 'eyJpdiI6ImVaWVpzOXJCcGE4YTNSdjBVOTBNMkE9PSIsInZhbHVlIjoiamhZYWRFam13cnJUaC95dzVqTkZuQT09IiwibWFjIjoiYzE3MDFiY2MxZjk1OGE3Y2IzNzMzMWE5ZDdkZjM0NDRjZjA1NTdmYzAxYWIwMTU5M2NhYjdkYmYxMDU1YTg5ZiIsInRhZyI6IiJ9', 'Shopkeeper', '2025-09-30 05:27:09', '2025-09-30 05:27:09', NULL, 'IN'),
(8, 'shopkeeper06', 'Bhambhan Road seri no. 2', '15871', '513', '33', '364710', 'male', '0698989898', 'shopkeeper06@gmail.com', 'eyJpdiI6Ik02cVZEVEdyNEowZi9UNWo1aFdVTkE9PSIsInZhbHVlIjoiMnBFVko0L2FFUFJsTmdGKzQrK0xBQT09IiwibWFjIjoiMjcwMzE0MWExZmQ1MDU0NzU4NjYzOWZiYTQ0ZDkwMmNjZWMzYTVmMzdiYmVmZTFkZmQ0MTcyNzEyZjFjZjdjNSIsInRhZyI6IiJ9', 'Shopkeeper', '2025-09-30 05:28:20', '2025-09-30 05:28:20', NULL, 'IN'),
(9, 'Customer03', 'bhambhan road', '45621', '1650', '102', '382350', 'male', '9898989892', 'customer03@gmail.com', 'eyJpdiI6IlVPbE9PRGphL0YzcnNkTlE4SFJXU3c9PSIsInZhbHVlIjoiZVFKdjFDeExuUTNkV25qYVZVWU92dz09IiwibWFjIjoiN2IwZmExYTM5MjM1YjUyMzc1NGJjZDMwNTgxNTJiYmY5ZmI2NzlkMGE4MTUyMzIyZDMwYzFhNDM3NzhjNTc3OSIsInRhZyI6IiJ9', 'Customer', '2025-09-30 05:29:59', '2025-10-03 00:24:11', NULL, 'IN'),
(10, 'Customer04', 'keyur park', '6993', '217', '15', '364710', 'male', '9898989894', 'customer04@gmail.com', 'eyJpdiI6IitCUnJFcmlEUThIUEFITThHbW54T0E9PSIsInZhbHVlIjoiR0JlclRvWDV0MHVmOUVUZDFZbk9xdz09IiwibWFjIjoiMjNlMjQwZTAxMjZjOWM4MDgzY2JkNzRhZGZlY2M0ZWMyMTdlYzlkYTQ3ZDY5YzUyMjlhMGFiOTFiZDE4OGEwNiIsInRhZyI6IiJ9', 'Customer', '2025-09-30 05:30:45', '2025-09-30 05:30:45', NULL, 'IN'),
(11, 'Customer05', 'Bhambhan Road seri no. 2', '96', '35', '3', '382353', 'female', '9898989895', 'customer05@gmail.com', 'eyJpdiI6ImVDSFkzM09rSlFFOUZMbVJIWEdjWWc9PSIsInZhbHVlIjoieVBGY0FKbzIvTXBIaVk5Y21QN3JBdz09IiwibWFjIjoiYTAzMjhiZTJlYjk5NzYzNjBhYzRhMTFjZWE5MGFhZDA4NjJiMTgyNTk2MjIyMzllYjc5YjM1MGQ3YjM1MGU0YSIsInRhZyI6IiJ9', 'Customer', '2025-09-30 05:31:28', '2025-09-30 05:31:28', NULL, 'IN'),
(12, 'Customer06', 'gitanagar', '45584', '1650', '102', '364710', 'male', '9898989896', 'customer06@gmail.com', 'eyJpdiI6IkVldkxXOUxHa3k2cmFaZmxSeDJzRlE9PSIsInZhbHVlIjoiUW5rQzk4ZDVzdFBMaXBmdno3Ly9kdz09IiwibWFjIjoiMmNjNGRiMGQ2NzZkZWU1Y2Q1YjdjYzYxZGU1ZThmNzA5NTM2NjMzYjkzNmZhZTZlZTUxOGVhMDhlODQwMmUzMSIsInRhZyI6IiJ9', 'Customer', '2025-09-30 05:32:50', '2025-09-30 05:32:50', NULL, 'IN'),
(14, 'Customer08', 'keyur park 52', '234', '83', '4', '382350', 'female', '9898989102', 'customer08@gmail.com', 'eyJpdiI6ImtEYi9admNzWjdTREJtdEhUOHdEa2c9PSIsInZhbHVlIjoiZVFQWnRidEJmZFhpc2trblhONGU2dz09IiwibWFjIjoiZWRiNjkwMmY2ZTYwZjRiZWYyOGRhYjEyMzBhZmQyMjJhYzc0MDQ1MTI0ZTY2Yzc3ZDI2N2QxNWE3YmFlOGJhNCIsInRhZyI6IiJ9', 'Customer', '2025-10-06 00:03:50', '2025-10-06 00:03:50', NULL, 'IN'),
(15, 'shopkeeper07', 'bhambhan road', '650', '173', '11', '364710', 'male', '9898786768', 'shopkeeper07@gmail.com', 'eyJpdiI6IkVtSlo0ZjZkcXpyRTZ3MUhacGFyQmc9PSIsInZhbHVlIjoiYmpUOGNGVEExZ3VFdEdWLzlpOXhKUT09IiwibWFjIjoiOThhOGUwYTE1OThkOGRmODY2NWNiOWZjODdjOTcyMTgwNzk4NTA5ZTMyMGJlOWM2YTllNjQzNDFmNzA0YjYzNCIsInRhZyI6IiJ9', 'Shopkeeper', '2025-10-06 00:05:18', '2025-10-06 00:05:18', NULL, 'IN'),
(16, 'shopkeeper08', 'Bhambhan Road seri no. 2', '45212', '1643', '102', '382350', 'male', '9898989820', 'shopkeeper08@gmail.com', 'eyJpdiI6IkNhVGVUMXp5aXlYUDM0N2pVbzZlSlE9PSIsInZhbHVlIjoiWTluaDY3a0JWbjFLcVpVVFRXZWNSZz09IiwibWFjIjoiMGU5NDQ3NzJiMDlmMjQ2ZjE0MDRhN2MxZjViZjk5ZTM3YzBmMzFlZTE1Mjg1YjFkMzFiYzk3ODEyMDgzMjdiNiIsInRhZyI6IiJ9', 'Shopkeeper', '2025-10-06 00:06:12', '2025-10-07 03:02:35', NULL, 'IN'),
(17, 'Customer09', 'gitanagar', '234', '83', '4', '909890', 'female', '9898989901', 'customer09@gmail.com', 'eyJpdiI6ImtWOGVhVTQ5TFlaZnp6azVYWW1UTnc9PSIsInZhbHVlIjoiN3N5ZWFaNnhwSnNzMGozVDBvc1k2Zz09IiwibWFjIjoiYzg4ZWY4YTI0NDg4NjQ1NTk3ZjVjYTVmMjgzNTdhYWUwOTk2NWY1NjFlMWE3MWYyYWQzODc0NDcxM2YxMjNjZiIsInRhZyI6IiJ9', 'Customer', '2025-10-07 03:58:32', '2025-10-07 04:00:08', NULL, 'IN'),
(18, 'shopkeeper09', 'gitanagar', '45016', '1641', '102', '364710', 'male', '9898989902', 'shopkeeper09@gmail.com', 'eyJpdiI6IlAvQ1VVME1XajNvZjhxeDV5blBqMmc9PSIsInZhbHVlIjoic0JrV2QwbEt4K0hlbVhBQmMvYjZKUT09IiwibWFjIjoiOTMxMTlkNTBlYmE4ZDlhNTUyMGJkZTAxZjk5OTM0MWQxN2UwOTc3MzAyNTY5NzZhZDU1NTI5MDQzMTQ1YjJkYSIsInRhZyI6IiJ9', 'Shopkeeper', '2025-10-07 03:59:34', '2025-10-07 04:00:34', NULL, 'IN'),
(19, 'abc', 'keyur park 52', '45584', '1650', '102', '382352', 'male', '9234123412', 'abc02@gmail.com', 'eyJpdiI6ImJSK1pnWGhucmRhTWFyb2V3MkZZZ0E9PSIsInZhbHVlIjoiZERVcE1qN01ib3hMQjdMM1BMWFZJUT09IiwibWFjIjoiYTFhMDg0NDMzZWUyMTgxMDNmYTg2OGMxNjZkMmFmOTM3YWRhYmZkNDE4MGRkMTllNDBiMThiODVkMWQ0YmJmMiIsInRhZyI6IiJ9', 'Customer', '2025-10-27 23:35:39', '2025-10-28 05:39:12', NULL, 'IN'),
(20, 'sdafdfas', 'sdfasd', '228', '82', '4', '909890', 'female', '9898989830', 'bkr12345@gmail.com', 'eyJpdiI6Ik0rNDg0Z0hBTU1aQzRkbXZQRU40Q0E9PSIsInZhbHVlIjoibHh4Skg0M2NiWktoNnQyUTlxSDQ3Zz09IiwibWFjIjoiZmQzMmY3YzBlMWE5OTY1ZmI3ZjM5MTVjNGU5N2MwZTBhYTk0ZjIzYjczNWQzZTcwYWJiMmYxYWI5MzczYWI2OSIsInRhZyI6IiJ9', 'Customer', '2025-10-28 03:54:07', '2025-10-28 03:54:07', NULL, 'IN'),
(21, 'sdafdfas', 'sdfasd', '225', '81', '4', '909890', 'male', '9898989899', 'bkr54321@gmail.com', 'eyJpdiI6IlcvWkwzcmpPV2lwNHlSSlZqR0NsQlE9PSIsInZhbHVlIjoidkVlTzNPeUVlOTIyenRQdVFHdWFjQT09IiwibWFjIjoiNzdkMDZhNDBmNGY4ZTY0MzQ5ODE3ODgxNGE1MjRhMTczYzMzYWNhNTU4MzNkMzQ0ODRkYmRiMGRiNjEyMGI2NiIsInRhZyI6IiJ9', 'Customer', '2025-10-28 23:24:26', '2025-10-28 23:24:26', NULL, 'IN');

-- --------------------------------------------------------

--
-- Table structure for table `customerorder`
--

DROP TABLE IF EXISTS `customerorder`;
CREATE TABLE IF NOT EXISTS `customerorder` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pincode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` date DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `customer_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate_id` bigint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customerorder_customer_id_foreign` (`customer_id`),
  KEY `customerorder_product_id_foreign` (`product_id`),
  KEY `customerorder_rate_id_foreign` (`rate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=169 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customerorder`
--

INSERT INTO `customerorder` (`id`, `name`, `email`, `phone`, `country`, `state`, `city`, `pincode`, `address`, `quantity`, `order_date`, `delivery_date`, `deleted_at`, `customer_id`, `product_id`, `created_at`, `updated_at`, `status`, `rate_id`) VALUES
(129, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-10-30', '2025-11-06', '2025-11-02 23:33:56', 4, 25, '2025-10-30 03:16:30', '2025-11-02 23:33:56', 'Pending', 41),
(128, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-10-30', '2025-11-06', '2025-10-30 03:15:53', 4, 7, '2025-10-30 03:15:50', '2025-10-30 03:15:53', 'Pending', 0),
(127, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-10-30', '2025-11-06', '2025-10-30 02:12:56', 4, 26, '2025-10-30 02:12:26', '2025-10-30 02:12:56', 'Pending', 0),
(126, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-10-30', '2025-11-06', '2025-10-30 01:55:23', 4, 37, '2025-10-30 01:55:17', '2025-10-30 01:55:23', 'Pending', 40),
(125, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-10-30', '2025-11-06', '2025-10-30 01:55:24', 4, 2, '2025-10-30 01:54:08', '2025-10-30 01:55:24', 'Pending', 39),
(124, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-10-30', '2025-11-06', '2025-10-30 01:53:54', 4, 8, '2025-10-30 01:53:50', '2025-10-30 01:53:54', 'Pending', 0),
(123, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-10-30', '2025-11-06', '2025-10-30 01:53:56', 4, 24, '2025-10-30 01:53:50', '2025-10-30 01:53:56', 'Pending', 0),
(122, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-10-30', '2025-11-06', '2025-10-30 01:53:58', 4, 24, '2025-10-30 01:37:59', '2025-10-30 01:53:58', 'Pending', 38),
(121, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-10-30', '2025-11-06', '2025-10-30 01:53:59', 4, 41, '2025-10-30 01:29:06', '2025-10-30 01:53:59', 'Pending', 37),
(120, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-10-30', '2025-11-06', '2025-10-30 01:28:41', 4, 37, '2025-10-29 23:07:52', '2025-10-30 01:28:41', 'Pending', 32),
(119, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-10-29', '2025-11-05', '2025-10-29 06:21:43', 4, 42, '2025-10-29 06:21:30', '2025-10-29 06:21:43', 'Pending', 31),
(118, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1649', '45544', '382352', 'keyur park 52', '1', '2025-10-29', '2025-11-05', '2025-10-30 01:28:43', 4, 13, '2025-10-29 00:16:16', '2025-10-30 01:28:43', 'Pending', 33),
(117, 'abc', 'customer02@gmail.com', '9898989899', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-28', '2025-11-04', '2025-10-30 01:28:45', 4, 58, '2025-10-27 23:17:08', '2025-10-30 01:28:45', 'Pending', 30),
(116, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-27', '2025-11-03', '2025-10-26 22:52:07', 4, 1, '2025-10-26 22:49:07', '2025-10-26 22:52:07', 'Pending', 29),
(115, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-17', '2025-10-24', '2025-10-17 01:52:37', 4, 24, '2025-10-17 01:52:31', '2025-10-17 01:52:37', 'Pending', 28),
(114, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-17', '2025-10-24', '2025-10-17 00:43:56', 4, 5, '2025-10-17 00:43:16', '2025-10-17 00:43:56', 'Pending', 0),
(113, 'Customer01', 'customer01@gmail.com', '9898989803', '14', '207', '1971', '382350', 'gitanagar', '1', '2025-10-17', '2025-10-24', '2025-10-26 23:48:56', 3, 5, '2025-10-16 23:45:08', '2025-10-26 23:48:56', 'Delivered', 0),
(112, 'Customer01', 'customer01@gmail.com', '9898989803', '14', '207', '1971', '382350', 'gitanagar', '1', '2025-10-17', '2025-10-24', '2025-10-16 22:57:56', 3, 4, '2025-10-16 22:57:42', '2025-10-16 22:57:56', 'Pending', 0),
(111, 'Customer01', 'customer01@gmail.com', '9898989803', '14', '207', '1971', '382350', 'gitanagar', '1', '2025-10-17', '2025-10-24', '2025-10-26 23:50:48', 3, 19, '2025-10-16 22:55:39', '2025-10-26 23:50:48', 'Delivered', 27),
(110, 'Customer01', 'customer01@gmail.com', '9898989803', '14', '207', '1971', '382350', 'gitanagar', '1', '2025-10-17', '2025-10-24', '2025-10-16 22:49:11', 3, 19, '2025-10-16 22:49:02', '2025-10-16 22:49:11', 'Pending', 0),
(109, 'Customer01', 'customer01@gmail.com', '9898989803', '14', '207', '1971', '382350', 'gitanagar', '1', '2025-10-17', '2025-10-24', '2025-10-16 22:49:12', 3, 2, '2025-10-16 22:49:02', '2025-10-16 22:49:12', 'Pending', 0),
(108, 'Customer01', 'customer01@gmail.com', '9898989803', '14', '207', '1971', '382350', 'gitanagar', '1', '2025-10-17', '2025-10-24', '2025-10-16 22:48:26', 3, 19, '2025-10-16 22:48:21', '2025-10-16 22:48:26', 'Pending', 0),
(107, 'Customer01', 'customer01@gmail.com', '9898989803', '14', '207', '1971', '382350', 'gitanagar', '1', '2025-10-16', '2025-10-23', '2025-10-16 06:27:30', 3, 1, '2025-10-16 06:27:24', '2025-10-16 06:27:30', 'Pending', 0),
(106, 'Customer01', 'customer01@gmail.com', '9898989803', '14', '207', '1971', '382350', 'gitanagar', '1', '2025-10-16', '2025-10-23', '2025-10-16 06:25:59', 3, 1, '2025-10-16 06:25:23', '2025-10-16 06:25:59', 'Pending', 26),
(105, 'Customer01', 'customer01@gmail.com', '9898989803', '14', '207', '1971', '382350', 'gitanagar', '1', '2025-10-16', '2025-10-23', '2025-10-16 05:37:43', 3, 1, '2025-10-16 05:37:38', '2025-10-16 05:37:43', 'Pending', 0),
(104, 'Customer01', 'customer01@gmail.com', '9898989803', '14', '207', '1971', '382350', 'gitanagar', '1', '2025-10-16', '2025-10-23', '2025-10-16 05:37:44', 3, 1, '2025-10-16 05:33:01', '2025-10-16 05:37:44', 'Pending', 25),
(103, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-16', '2025-10-23', '2025-10-30 01:28:37', 4, 15, '2025-10-16 04:37:00', '2025-10-30 01:28:37', 'Delivered', 24),
(102, 'mr.kuldeep', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-16', '2025-10-23', '2025-10-16 03:52:56', 4, 2, '2025-10-16 03:51:28', '2025-10-16 03:52:56', 'Pending', 23),
(101, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-16', '2025-10-23', '2025-10-16 03:18:07', 4, 15, '2025-10-16 03:17:47', '2025-10-16 03:18:07', 'Pending', 0),
(100, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-16', '2025-10-23', '2025-10-16 03:08:46', 4, 37, '2025-10-16 03:07:55', '2025-10-16 03:08:46', 'Pending', 22),
(99, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-16', '2025-10-23', '2025-10-16 02:18:33', 4, 1, '2025-10-16 02:18:26', '2025-10-16 02:18:33', 'Pending', 21),
(98, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-16', '2025-10-23', '2025-10-16 02:18:43', 4, 32, '2025-10-16 02:11:01', '2025-10-16 02:18:43', 'Pending', 19),
(97, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-16', '2025-10-23', '2025-10-16 02:18:45', 4, 10, '2025-10-16 01:56:28', '2025-10-16 02:18:45', 'Pending', 18),
(96, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-16', '2025-10-23', '2025-10-16 02:18:50', 4, 16, '2025-10-16 01:55:48', '2025-10-16 02:18:50', 'Pending', 17),
(95, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-16', '2025-10-23', '2025-10-16 02:18:47', 4, 13, '2025-10-16 01:51:13', '2025-10-16 02:18:47', 'Pending', 20),
(94, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-16', '2025-10-23', '2025-10-16 02:18:52', 4, 78, '2025-10-16 01:24:15', '2025-10-16 02:18:52', 'Pending', 16),
(93, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-16', '2025-10-23', '2025-10-16 01:56:32', 4, 10, '2025-10-16 01:24:04', '2025-10-16 01:56:32', 'Pending', 0),
(92, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-16', '2025-10-23', '2025-10-16 01:23:27', 4, 40, '2025-10-16 01:23:21', '2025-10-16 01:23:27', 'Pending', 15),
(91, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-16', '2025-10-23', '2025-10-16 01:23:02', 4, 39, '2025-10-16 01:22:56', '2025-10-16 01:23:02', 'Pending', 14),
(90, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-16', '2025-10-23', '2025-10-16 01:19:24', 4, 1, '2025-10-16 01:17:20', '2025-10-16 01:19:24', 'Pending', 13),
(89, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-16', '2025-10-23', '2025-10-16 00:46:32', 4, 10, '2025-10-16 00:45:10', '2025-10-16 00:46:32', 'Pending', 12),
(88, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-16', '2025-10-23', '2025-10-16 00:46:30', 4, 37, '2025-10-16 00:44:42', '2025-10-16 00:46:30', 'Pending', 11),
(87, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-16', '2025-10-23', '2025-10-16 00:44:54', 4, 13, '2025-10-16 00:26:46', '2025-10-16 00:44:54', 'Pending', 10),
(86, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-16', '2025-10-23', '2025-10-16 00:26:26', 4, 13, '2025-10-16 00:26:18', '2025-10-16 00:26:26', 'Pending', 0),
(85, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-16', '2025-10-23', '2025-10-16 00:44:22', 4, 26, '2025-10-16 00:26:10', '2025-10-16 00:44:22', 'Pending', 9),
(84, 'Customer06', 'customer06@gmail.com', '9898989896', '102', '1650', '45584', '364710', 'gitanagar', '1', '2025-10-16', '2025-10-23', '2025-10-16 00:20:37', 12, 1, '2025-10-16 00:19:41', '2025-10-16 00:20:37', 'Pending', 7),
(83, 'Customer06', 'customer06@gmail.com', '9898989896', '102', '1650', '45584', '364710', 'gitanagar', '1', '2025-10-16', '2025-10-23', NULL, 12, 41, '2025-10-16 00:00:42', '2025-10-16 00:00:53', 'Pending', 6),
(82, 'Customer05', 'customer05@gmail.com', '9898989895', '3', '35', '96', '382353', 'Bhambhan Road seri no. 2', '1', '2025-10-16', '2025-10-23', NULL, 11, 41, '2025-10-15 23:59:47', '2025-10-15 23:59:49', 'Pending', 5),
(81, 'Customer04', 'customer04@gmail.com', '9898989894', '15', '217', '6993', '364710', 'keyur park', '1', '2025-10-16', '2025-10-23', NULL, 10, 41, '2025-10-15 23:59:02', '2025-10-15 23:59:05', 'Pending', 4),
(80, 'Customer03', 'customer03@gmail.com', '9898989892', '102', '1650', '45621', '382350', 'bhambhan road', '1', '2025-10-16', '2025-10-23', '2025-11-03 01:10:50', 9, 41, '2025-10-15 23:49:50', '2025-11-03 01:10:50', 'Pending', 3),
(79, 'Customer03', 'customer03@gmail.com', '9898989892', '102', '1650', '45621', '382350', 'bhambhan road', '1', '2025-10-16', '2025-10-23', '2025-11-03 01:10:55', 9, 1, '2025-10-15 23:49:50', '2025-11-03 01:10:55', 'Pending', 0),
(78, 'Customer01', 'customer01@gmail.com', '9898989803', '14', '207', '1971', '382350', 'gitanagar', '1', '2025-10-16', '2025-10-23', '2025-10-16 05:37:47', 3, 41, '2025-10-15 23:48:50', '2025-10-16 05:37:47', 'Pending', 2),
(77, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-15', '2025-10-22', '2025-10-16 00:25:41', 4, 41, '2025-10-15 06:57:58', '2025-10-16 00:25:41', 'Pending', 1),
(76, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-15', '2025-10-22', '2025-10-16 00:25:45', 4, 32, '2025-10-15 06:55:08', '2025-10-16 00:25:45', 'Pending', 9),
(74, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-15', '2025-10-22', '2025-10-15 06:50:31', 4, 16, '2025-10-15 06:38:06', '2025-10-15 06:50:31', 'Pending', 0),
(72, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-15', '2025-10-22', '2025-10-15 06:50:34', 4, 19, '2025-10-15 05:23:53', '2025-10-15 06:50:34', 'Pending', 7),
(75, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-15', '2025-10-22', '2025-10-15 06:50:36', 4, 46, '2025-10-15 06:48:19', '2025-10-15 06:50:36', 'Pending', 0),
(73, 'Customer02', 'customer02@gmail.com', '9898989804', '182', '3424', '101409', '382352', 'keyur park 52', '1', '2025-10-15', '2025-10-22', '2025-10-16 00:25:58', 4, 77, '2025-10-15 05:35:27', '2025-10-16 00:25:58', 'Delivered', 8),
(130, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-10-30', '2025-11-06', '2025-11-02 23:33:58', 4, 6, '2025-10-30 03:16:30', '2025-11-02 23:33:58', 'Pending', 42),
(131, 'Customer01', 'customer01@gmail.com', '9898989803', '250', '5082', '150546', '382350', 'gitanagar', '1', '2025-10-30', '2025-11-06', '2025-10-30 03:25:33', 3, 32, '2025-10-30 03:24:54', '2025-10-30 03:25:33', 'Pending', 0),
(132, 'Customer01', 'customer01@gmail.com', '9898989803', '250', '5082', '150546', '382350', 'gitanagar', '1', '2025-10-30', '2025-11-06', '2025-10-30 03:25:31', 3, 32, '2025-10-30 03:25:28', '2025-10-30 03:25:31', 'Pending', 0),
(133, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-11-03', '2025-11-10', '2025-11-02 23:34:00', 4, 37, '2025-11-02 23:33:28', '2025-11-02 23:34:00', 'Pending', 0),
(134, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-11-03', '2025-11-10', '2025-11-02 23:34:02', 4, 13, '2025-11-02 23:33:28', '2025-11-02 23:34:02', 'Pending', 0),
(135, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-11-03', '2025-11-10', '2025-11-02 23:34:03', 4, 41, '2025-11-02 23:33:28', '2025-11-02 23:34:03', 'Pending', 0),
(136, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-11-03', '2025-11-10', '2025-11-02 23:34:31', 4, 5, '2025-11-02 23:34:22', '2025-11-02 23:34:31', 'Pending', 0),
(137, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-11-03', '2025-11-10', '2025-11-02 23:34:29', 4, 6, '2025-11-02 23:34:22', '2025-11-02 23:34:29', 'Pending', 0),
(138, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-11-03', '2025-11-10', '2025-11-02 23:34:54', 4, 5, '2025-11-02 23:34:48', '2025-11-02 23:34:54', 'Pending', 0),
(139, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-11-03', '2025-11-10', '2025-11-02 23:34:52', 4, 37, '2025-11-02 23:34:48', '2025-11-02 23:34:52', 'Pending', 0),
(140, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-11-03', '2025-11-10', '2025-11-02 23:37:31', 4, 5, '2025-11-02 23:36:29', '2025-11-02 23:37:31', 'Pending', 0),
(141, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-11-03', '2025-11-10', '2025-11-02 23:37:33', 4, 6, '2025-11-02 23:36:29', '2025-11-02 23:37:33', 'Pending', 0),
(142, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-11-03', '2025-11-10', '2025-11-02 23:48:02', 4, 1, '2025-11-02 23:47:54', '2025-11-02 23:48:02', 'Pending', 0),
(143, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-11-03', '2025-11-10', '2025-11-02 23:48:03', 4, 7, '2025-11-02 23:47:54', '2025-11-02 23:48:03', 'Pending', 0),
(144, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-11-03', '2025-11-10', '2025-11-02 23:48:05', 4, 37, '2025-11-02 23:47:54', '2025-11-02 23:48:05', 'Pending', 0),
(145, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-11-03', '2025-11-10', '2025-11-02 23:56:33', 4, 37, '2025-11-02 23:55:39', '2025-11-02 23:56:33', 'Pending', 0),
(146, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-11-03', '2025-11-10', '2025-11-02 23:56:34', 4, 1, '2025-11-02 23:56:20', '2025-11-02 23:56:34', 'Pending', 0),
(147, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-11-03', '2025-11-10', '2025-11-02 23:56:56', 4, 37, '2025-11-02 23:56:50', '2025-11-02 23:56:56', 'Pending', 0),
(148, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-11-03', '2025-11-10', '2025-11-02 23:56:54', 4, 2, '2025-11-02 23:56:50', '2025-11-02 23:56:54', 'Pending', 0),
(149, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-11-03', '2025-11-10', '2025-11-03 01:12:07', 4, 1, '2025-11-03 01:10:19', '2025-11-03 01:12:07', 'Pending', 0),
(150, 'Customer03', 'customer03@gmail.com', '9898989892', '102', '1650', '45621', '382350', 'bhambhan road', '1', '2025-11-03', '2025-11-10', NULL, 9, 1, '2025-11-03 01:10:46', '2025-11-03 01:10:46', 'Pending', 0),
(151, 'Customer01', 'customer01@gmail.com', '9898989803', '250', '5082', '150546', '382350', 'gitanagar', '1', '2025-11-03', '2025-11-10', '2025-11-03 01:11:39', 3, 1, '2025-11-03 01:11:33', '2025-11-03 01:11:39', 'Pending', 0),
(152, 'Customer01', 'customer01@gmail.com', '9898989803', '250', '5082', '150546', '382350', 'gitanagar', '1', '2025-11-03', '2025-11-10', '2025-11-03 07:09:39', 3, 1, '2025-11-03 07:05:31', '2025-11-03 07:09:39', 'Pending', 0),
(153, 'Customer01', 'customer01@gmail.com', '9898989803', '250', '5082', '150546', '382350', 'gitanagar', '1', '2025-11-03', '2025-11-10', '2025-11-03 07:11:26', 3, 1, '2025-11-03 07:09:59', '2025-11-03 07:11:26', 'Pending', 0),
(154, 'Customer01', 'customer01@gmail.com', '9898989803', '250', '5082', '150546', '382350', 'gitanagar', '1', '2025-11-03', '2025-11-10', '2025-11-03 07:11:27', 3, 1, '2025-11-03 07:10:53', '2025-11-03 07:11:27', 'Pending', 0),
(155, 'Customer01', 'customer01@gmail.com', '9898989803', '250', '5082', '150546', '382350', 'gitanagar', '1', '2025-11-03', '2025-11-10', '2025-11-03 07:11:29', 3, 1, '2025-11-03 07:11:20', '2025-11-03 07:11:29', 'Pending', 0),
(156, 'Customer01', 'customer01@gmail.com', '9898989803', '250', '5082', '150546', '382350', 'gitanagar', '1', '2025-11-03', '2025-11-10', '2025-11-03 07:13:55', 3, 1, '2025-11-03 07:12:35', '2025-11-03 07:13:55', 'Pending', 0),
(157, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-11-04', '2025-11-11', '2025-11-03 22:39:27', 4, 1, '2025-11-03 22:38:34', '2025-11-03 22:39:27', 'Delivered', 0),
(158, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-11-04', '2025-11-11', '2025-11-03 22:45:51', 4, 1, '2025-11-03 22:39:55', '2025-11-03 22:45:51', 'Shipping', 0),
(159, 'Customer01', 'customer01@gmail.com', '9898989803', '250', '5082', '150546', '382350', 'gitanagar', '1', '2025-11-04', '2025-11-11', NULL, 3, 13, '2025-11-04 00:17:23', '2025-11-04 00:17:23', 'Pending', 0),
(160, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-11-04', '2025-11-11', NULL, 4, 15, '2025-11-04 00:18:15', '2025-11-05 04:21:59', 'Pending', 51),
(161, 'Customer02', 'customer02@gmail.com', '9898989804', '102', '1650', '45621', '382352', 'keyur park 52', '1', '2025-11-04', '2025-11-11', NULL, 4, 6, '2025-11-04 00:19:33', '2025-11-04 00:19:33', 'Pending', 0),
(162, 'Customer07', 'customer07@gmail.com', '9898989101', '182', '3422', '101229', '364710', 'gitanagar', '1', '2025-11-04', '2025-11-11', '2025-11-04 01:04:50', 13, 16, '2025-11-04 01:04:26', '2025-11-04 01:04:50', 'Pending', 0),
(163, 'Customer07', 'customer07@gmail.com', '9898989101', '182', '3422', '101229', '364710', 'gitanagar', '1', '2025-11-04', '2025-11-11', '2025-11-04 01:04:52', 13, 32, '2025-11-04 01:04:26', '2025-11-04 01:04:52', 'Pending', 0),
(164, 'Customer07', 'customer07@gmail.com', '9898989101', '182', '3422', '101229', '364710', 'gitanagar', '1', '2025-11-04', '2025-11-11', '2025-11-04 01:04:48', 13, 6, '2025-11-04 01:04:26', '2025-11-04 01:04:48', 'Pending', 0),
(165, 'Customer07', 'customer07@gmail.com', '9898989101', '182', '3422', '101229', '364710', 'gitanagar', '1', '2025-11-04', '2025-11-11', NULL, 13, 20, '2025-11-04 01:25:30', '2025-11-04 01:25:30', 'Pending', 0),
(166, 'Customer07', 'customer07@gmail.com', '9898989101', '182', '3422', '101229', '364710', 'gitanagar', '1', '2025-11-04', '2025-11-11', NULL, 13, 6, '2025-11-04 01:25:30', '2025-11-04 01:25:30', 'Pending', 0),
(167, 'Customer07', 'customer07@gmail.com', '9898989101', '182', '3422', '101229', '364710', 'gitanagar', '1', '2025-11-04', '2025-11-11', NULL, 13, 5, '2025-11-04 01:25:30', '2025-11-04 01:25:30', 'Pending', 0),
(168, 'Customer01', 'customer01@gmail.com', '9898989803', '250', '5082', '150546', '382350', 'gitanagar', '1', '2025-11-04', '2025-11-11', NULL, 3, 9, '2025-11-04 01:26:29', '2025-11-04 01:26:29', 'Pending', 0);

-- --------------------------------------------------------

--
-- Table structure for table `favourite_product`
--

DROP TABLE IF EXISTS `favourite_product`;
CREATE TABLE IF NOT EXISTS `favourite_product` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `favourite_product_product_id_foreign` (`product_id`),
  KEY `favourite_product_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favourite_product`
--

INSERT INTO `favourite_product` (`id`, `product_id`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '2025-10-30 23:55:22', '2025-10-30 07:25:32', '2025-10-30 23:55:22'),
(2, 1, 4, '2025-10-31 00:08:02', '2025-10-30 23:55:23', '2025-10-31 00:08:02'),
(3, 1, 4, '2025-11-04 04:27:59', '2025-10-31 00:08:04', '2025-11-04 04:27:59'),
(4, 7, 4, '2025-11-02 23:04:31', '2025-11-02 23:04:17', '2025-11-02 23:04:31'),
(5, 8, 4, NULL, '2025-11-02 23:04:31', '2025-11-02 23:04:31'),
(6, 1, 4, '2025-11-04 04:28:00', '2025-11-04 04:28:00', '2025-11-04 04:28:00'),
(7, 1, 4, '2025-11-04 04:28:38', '2025-11-04 04:28:38', '2025-11-04 04:28:38'),
(8, 1, 4, '2025-11-04 04:28:45', '2025-11-04 04:28:44', '2025-11-04 04:28:45'),
(9, 1, 4, '2025-11-04 04:32:48', '2025-11-04 04:32:47', '2025-11-04 04:32:48'),
(10, 1, 4, '2025-11-04 05:03:37', '2025-11-04 05:00:59', '2025-11-04 05:03:37'),
(11, 1, 4, '2025-11-04 05:04:08', '2025-11-04 05:03:38', '2025-11-04 05:04:08'),
(12, 1, 4, '2025-11-04 05:04:12', '2025-11-04 05:04:09', '2025-11-04 05:04:12'),
(13, 1, 4, '2025-11-04 05:08:00', '2025-11-04 05:04:13', '2025-11-04 05:08:00'),
(14, 1, 4, '2025-11-04 06:37:49', '2025-11-04 05:08:01', '2025-11-04 06:37:49'),
(15, 105, 4, '2025-11-04 06:36:18', '2025-11-04 06:36:17', '2025-11-04 06:36:18'),
(16, 105, 4, '2025-11-04 06:36:41', '2025-11-04 06:36:19', '2025-11-04 06:36:41'),
(17, 105, 4, '2025-11-04 06:37:28', '2025-11-04 06:37:26', '2025-11-04 06:37:28'),
(18, 1, 4, '2025-11-04 06:37:54', '2025-11-04 06:37:50', '2025-11-04 06:37:54'),
(19, 1, 4, '2025-11-04 06:38:00', '2025-11-04 06:37:54', '2025-11-04 06:38:00'),
(20, 1, 4, '2025-11-04 07:03:25', '2025-11-04 06:38:01', '2025-11-04 07:03:25'),
(21, 1, 4, '2025-11-04 07:08:09', '2025-11-04 07:05:41', '2025-11-04 07:08:09'),
(22, 1, 4, '2025-11-04 07:08:24', '2025-11-04 07:08:10', '2025-11-04 07:08:24'),
(23, 1, 4, '2025-11-04 07:10:23', '2025-11-04 07:10:22', '2025-11-04 07:10:23'),
(24, 1, 4, '2025-11-04 07:11:46', '2025-11-04 07:11:19', '2025-11-04 07:11:46'),
(25, 1, 4, '2025-11-04 07:13:09', '2025-11-04 07:13:08', '2025-11-04 07:13:09'),
(26, 39, 4, '2025-11-04 07:15:00', '2025-11-04 07:13:14', '2025-11-04 07:15:00'),
(27, 1, 4, '2025-11-04 07:13:24', '2025-11-04 07:13:23', '2025-11-04 07:13:24'),
(28, 3, 4, NULL, '2025-11-04 07:13:48', '2025-11-04 07:13:48'),
(29, 1, 4, '2025-11-04 07:14:52', '2025-11-04 07:13:54', '2025-11-04 07:14:52'),
(30, 1, 4, '2025-11-04 07:16:01', '2025-11-04 07:14:53', '2025-11-04 07:16:01'),
(31, 39, 4, '2025-11-04 07:31:29', '2025-11-04 07:15:00', '2025-11-04 07:31:29'),
(32, 1, 4, '2025-11-04 07:18:53', '2025-11-04 07:16:02', '2025-11-04 07:18:53'),
(33, 1, 4, '2025-11-04 07:18:55', '2025-11-04 07:18:54', '2025-11-04 07:18:55'),
(34, 1, 4, '2025-11-04 07:21:57', '2025-11-04 07:18:56', '2025-11-04 07:21:57'),
(35, 1, 4, '2025-11-04 07:22:00', '2025-11-04 07:21:58', '2025-11-04 07:22:00'),
(36, 1, 4, '2025-11-04 07:30:35', '2025-11-04 07:30:22', '2025-11-04 07:30:35'),
(37, 1, 4, '2025-11-04 07:30:44', '2025-11-04 07:30:35', '2025-11-04 07:30:44'),
(38, 1, 4, '2025-11-04 07:31:57', '2025-11-04 07:30:48', '2025-11-04 07:31:57'),
(39, 1, 4, '2025-11-04 07:32:12', '2025-11-04 07:31:59', '2025-11-04 07:32:12'),
(40, 1, 4, NULL, '2025-11-04 22:44:31', '2025-11-04 22:44:31'),
(41, 2, 4, '2025-11-05 03:32:42', '2025-11-05 03:32:41', '2025-11-05 03:32:42'),
(42, 2, 4, '2025-11-05 03:33:23', '2025-11-05 03:32:59', '2025-11-05 03:33:23'),
(43, 2, 4, '2025-11-05 03:35:12', '2025-11-05 03:35:09', '2025-11-05 03:35:12'),
(44, 2, 4, '2025-11-05 04:00:51', '2025-11-05 04:00:50', '2025-11-05 04:00:51'),
(45, 2, 4, '2025-11-05 04:39:37', '2025-11-05 04:39:35', '2025-11-05 04:39:37'),
(46, 2, 4, '2025-11-05 04:39:46', '2025-11-05 04:39:45', '2025-11-05 04:39:46');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `image_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `images_product_id_foreign` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=294 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image_name`, `product_id`, `created_at`, `updated_at`) VALUES
(108, 'logo.png', 36, '2025-10-04 04:19:45', '2025-10-04 04:19:45'),
(106, 'phone4.png', 35, '2025-10-04 00:57:10', '2025-10-04 00:57:10'),
(4, 'p001.png', 2, '2025-09-18 04:26:10', '2025-09-18 04:26:10'),
(5, 'p002.png', 2, '2025-09-18 04:26:10', '2025-09-18 04:26:10'),
(6, 'p003.png', 2, '2025-09-18 04:26:10', '2025-09-18 04:26:10'),
(7, 'p401.png', 3, '2025-09-18 04:37:11', '2025-09-18 04:37:11'),
(8, 'p402.png', 3, '2025-09-18 04:37:11', '2025-09-18 04:37:11'),
(9, 'p403.png', 3, '2025-09-18 04:37:11', '2025-09-18 04:37:11'),
(10, 'p301.png', 4, '2025-09-18 04:39:22', '2025-09-18 04:39:22'),
(11, 'p302.png', 4, '2025-09-18 04:39:22', '2025-09-18 04:39:22'),
(12, 'p303.png', 4, '2025-09-18 04:39:22', '2025-09-18 04:39:22'),
(13, 'p501.png', 5, '2025-09-18 04:49:44', '2025-09-18 04:49:44'),
(14, 'p502.png', 5, '2025-09-18 04:49:44', '2025-09-18 04:49:44'),
(15, 'p503.png', 5, '2025-09-18 04:49:44', '2025-09-18 04:49:44'),
(16, 'p601.png', 6, '2025-09-18 04:56:37', '2025-09-18 04:56:37'),
(17, 'p602.png', 6, '2025-09-18 04:56:37', '2025-09-18 04:56:37'),
(18, 'p603.png', 6, '2025-09-18 04:56:37', '2025-09-18 04:56:37'),
(19, 'p701.png', 7, '2025-09-18 05:09:46', '2025-09-18 05:09:46'),
(20, 'p702.png', 7, '2025-09-18 05:09:46', '2025-09-18 05:09:46'),
(102, 'phone6.png', 31, '2025-10-03 05:31:05', '2025-10-03 05:31:05'),
(22, 'p801.png', 8, '2025-09-18 05:10:58', '2025-09-18 05:10:58'),
(23, 'p802.png', 8, '2025-09-18 05:10:58', '2025-09-18 05:10:58'),
(24, 'p803.png', 8, '2025-09-18 05:10:58', '2025-09-18 05:10:58'),
(25, 'p1001.png', 9, '2025-09-18 22:55:54', '2025-09-18 22:55:54'),
(26, 'p1002.png', 9, '2025-09-18 22:55:54', '2025-09-18 22:55:54'),
(27, 'p901.png', 10, '2025-09-18 22:58:12', '2025-09-18 22:58:12'),
(28, 'p902.png', 10, '2025-09-18 22:58:12', '2025-09-18 22:58:12'),
(29, 'p903.png', 10, '2025-09-18 22:58:12', '2025-09-18 22:58:12'),
(30, 'p1101.png', 11, '2025-09-18 23:02:45', '2025-09-18 23:02:45'),
(31, 'p1102.png', 11, '2025-09-18 23:02:45', '2025-09-18 23:02:45'),
(32, 'p1201.png', 12, '2025-09-18 23:04:53', '2025-09-18 23:04:53'),
(33, 'p1202.png', 12, '2025-09-18 23:04:53', '2025-09-18 23:04:53'),
(34, 'dj2.jpg', 13, '2025-09-19 01:13:22', '2025-09-19 01:13:22'),
(83, 'dj1.jpg', 13, '2025-10-01 04:07:33', '2025-10-01 04:07:33'),
(36, 'pic6.jpg', 14, '2025-09-19 01:16:12', '2025-09-19 01:16:12'),
(37, 'l_leptop2.png', 15, '2025-09-19 01:23:35', '2025-09-19 01:23:35'),
(38, 'p_leptop1.png', 15, '2025-09-19 01:23:35', '2025-09-19 01:23:35'),
(39, 'p_leptop3.png', 15, '2025-09-19 01:23:35', '2025-09-19 01:23:35'),
(40, 'computer1.png', 16, '2025-09-19 01:29:14', '2025-09-19 01:29:14'),
(41, 'computer2.png', 16, '2025-09-19 01:29:14', '2025-09-19 01:29:14'),
(42, 'freg1.png', 17, '2025-09-19 01:33:33', '2025-09-19 01:33:33'),
(43, 'freg2.png', 17, '2025-09-19 01:33:33', '2025-09-19 01:33:33'),
(44, 'freg3.png', 17, '2025-09-19 01:33:33', '2025-09-19 01:33:33'),
(45, 'washingmachine1.png', 18, '2025-09-19 01:36:44', '2025-09-19 01:36:44'),
(46, 'washingmachine2.png', 18, '2025-09-19 01:36:44', '2025-09-19 01:36:44'),
(47, 'kitchen1.png', 19, '2025-09-19 01:41:56', '2025-09-19 01:41:56'),
(48, 'kitchen2.png', 19, '2025-09-19 01:41:56', '2025-09-19 01:41:56'),
(49, 'kitchen3.png', 19, '2025-09-19 01:41:56', '2025-09-19 01:41:56'),
(50, 'jeans11.png', 20, '2025-09-19 01:49:49', '2025-09-19 01:49:49'),
(51, 'jeans12.png', 20, '2025-09-19 01:49:49', '2025-09-19 01:49:49'),
(52, 'jeans13.png', 20, '2025-09-19 01:49:49', '2025-09-19 01:49:49'),
(53, 'jeans01.png', 21, '2025-09-19 01:50:59', '2025-09-19 01:50:59'),
(54, 'jeans02.png', 21, '2025-09-19 01:50:59', '2025-09-19 01:50:59'),
(55, 'jeans03.png', 21, '2025-09-19 01:50:59', '2025-09-19 01:50:59'),
(56, 'shirt01.png', 22, '2025-09-19 01:57:02', '2025-09-19 01:57:02'),
(57, 'shirt02.png', 22, '2025-09-19 01:57:02', '2025-09-19 01:57:02'),
(58, 'shirt03.png', 22, '2025-09-19 01:57:02', '2025-09-19 01:57:02'),
(59, 'shirt11.png', 23, '2025-09-19 01:58:06', '2025-09-19 01:58:06'),
(60, 'shirt12.png', 23, '2025-09-19 01:58:06', '2025-09-19 01:58:06'),
(61, 'shows01.png', 24, '2025-09-19 02:05:28', '2025-09-19 02:05:28'),
(62, 'shows02.png', 24, '2025-09-19 02:05:28', '2025-09-19 02:05:28'),
(63, 'shows03.png', 24, '2025-09-19 02:05:28', '2025-09-19 02:05:28'),
(64, 'watch01.png', 25, '2025-09-19 02:06:22', '2025-09-19 02:06:22'),
(65, 'watch02.png', 25, '2025-09-19 02:06:22', '2025-09-19 02:06:22'),
(66, 'watch03.png', 25, '2025-09-19 02:06:22', '2025-09-19 02:06:22'),
(271, 'running.png', 4, '2025-10-27 07:04:46', '2025-10-27 07:04:46'),
(68, 'p002.png', 26, '2025-09-22 06:39:32', '2025-09-22 06:39:32'),
(69, 'p003.png', 26, '2025-09-22 06:39:32', '2025-09-22 06:39:32'),
(267, 'fasion.png', 4, '2025-10-27 06:45:09', '2025-10-27 06:45:09'),
(264, 'phoneicon.png', 4, '2025-10-27 06:14:52', '2025-10-27 06:14:52'),
(269, 'phones.png', 4, '2025-10-27 06:45:09', '2025-10-27 06:45:09'),
(270, 'tvandappliances.png', 4, '2025-10-27 06:45:09', '2025-10-27 06:45:09'),
(76, 'p803.png', 27, '2025-09-25 01:15:11', '2025-09-25 01:15:11'),
(77, 'computer1.png', 28, '2025-09-29 03:39:02', '2025-09-29 03:39:02'),
(78, 'l_leptop2.png', 28, '2025-09-29 03:39:02', '2025-09-29 03:39:02'),
(79, 'p_leptop3.png', 28, '2025-09-29 03:39:02', '2025-09-29 03:39:02'),
(80, 'l_leptop2.png', 29, '2025-09-30 04:09:26', '2025-09-30 04:09:26'),
(81, 'p_leptop1.png', 29, '2025-09-30 04:09:26', '2025-09-30 04:09:26'),
(82, 'p_leptop3.png', 29, '2025-09-30 04:09:26', '2025-09-30 04:09:26'),
(84, 'computer1.png', 14, '2025-10-01 04:07:54', '2025-10-01 04:07:54'),
(85, 'computer2.png', 14, '2025-10-01 04:07:54', '2025-10-01 04:07:54'),
(86, 'dj1.jpg', 14, '2025-10-01 04:07:54', '2025-10-01 04:07:54'),
(87, 'dj2.jpg', 14, '2025-10-01 04:07:54', '2025-10-01 04:07:54'),
(94, 'p_leptop1.png', 30, '2025-10-03 01:43:43', '2025-10-03 01:43:43'),
(99, 'p_leptop3.png', 30, '2025-10-03 04:20:37', '2025-10-03 04:20:37'),
(103, 'phone6.png', 32, '2025-10-03 06:50:09', '2025-10-03 06:50:09'),
(104, 'logo.png', 33, '2025-10-03 23:38:18', '2025-10-03 23:38:18'),
(105, 'missingcart.png', 34, '2025-10-03 23:45:37', '2025-10-03 23:45:37'),
(109, 'pic6.jpg', 36, '2025-10-04 04:19:51', '2025-10-04 04:19:51'),
(110, 'phone4.png', 36, '2025-10-04 04:20:20', '2025-10-04 04:20:20'),
(176, 'realme14proplue3.png', 37, '2025-10-06 00:24:45', '2025-10-06 00:24:45'),
(175, 'realme14proplue2.png', 37, '2025-10-06 00:24:45', '2025-10-06 00:24:45'),
(174, 'realme14proplue1.png', 37, '2025-10-06 00:24:45', '2025-10-06 00:24:45'),
(253, 'p101.png', 1, '2025-10-10 00:11:20', '2025-10-10 00:11:20'),
(177, 'newpro1.png', 38, '2025-10-06 07:27:53', '2025-10-06 07:27:53'),
(178, 'newpro3.png', 39, '2025-10-06 07:29:13', '2025-10-06 07:29:13'),
(179, 'newpro2.png', 40, '2025-10-06 07:31:02', '2025-10-06 07:31:02'),
(180, 'newpro4.png', 41, '2025-10-06 07:32:29', '2025-10-06 07:32:29'),
(181, 'newpro5.png', 42, '2025-10-06 23:43:00', '2025-10-06 23:43:00'),
(183, 'btwgdz6zhraqvnhw0w0t.png', 44, '2025-10-07 00:34:05', '2025-10-07 00:34:05'),
(184, 'fbi1xox3mvnpcoo6w5yg.png', 45, '2025-10-07 00:35:33', '2025-10-07 00:35:33'),
(185, 'g4i8rpxsqmfdhodabsfq.png', 46, '2025-10-07 00:38:24', '2025-10-07 00:38:24'),
(188, 'sywwpixmnssapzrad65l.png', 47, '2025-10-07 00:39:54', '2025-10-07 00:39:54'),
(189, 'hydnqcv6e96ledygtfxq.png', 48, '2025-10-07 00:41:48', '2025-10-07 00:41:48'),
(190, 'ixkbyluxfoxytiejjc8e.png', 49, '2025-10-07 00:42:58', '2025-10-07 00:42:58'),
(191, 'lcv6jblrdksf9i7gfqwe.png', 50, '2025-10-07 00:44:07', '2025-10-07 00:44:07'),
(192, 'nxrahxlaibkqo7l4er4x.png', 51, '2025-10-07 00:45:11', '2025-10-07 00:45:11'),
(193, 'pqu4hrzrl5yejqcb3uns.png', 52, '2025-10-07 00:46:33', '2025-10-07 00:46:33'),
(194, 'vxbbj7qliglbw26fekum.png', 53, '2025-10-07 00:48:08', '2025-10-07 00:48:08'),
(195, 'p302.png', 54, '2025-10-07 00:49:21', '2025-10-07 00:49:21'),
(196, 'b1kutptcfbmghhwekagz.png', 55, '2025-10-07 00:54:43', '2025-10-07 00:54:43'),
(197, 'f1nerhs6pkefkdz0mosn.png', 56, '2025-10-07 00:55:51', '2025-10-07 00:55:51'),
(198, 'sn2jyje2xdkb8tr35e2c.png', 57, '2025-10-07 00:56:36', '2025-10-07 00:56:36'),
(199, 'xi7ublmt1bdl9drkkilb.png', 58, '2025-10-07 00:57:21', '2025-10-07 00:57:21'),
(200, 'bxalrg6aba5wthonzkmc.png', 59, '2025-10-07 01:03:43', '2025-10-07 01:03:43'),
(201, 'hv4t3jl8bidltovccx2i.png', 60, '2025-10-07 01:04:35', '2025-10-07 01:04:35'),
(202, 'x53rz0rnxxjuefymlhdb.png', 61, '2025-10-07 01:05:22', '2025-10-07 01:05:22'),
(203, 'vj4gpa18tnjljenwygjp.png', 62, '2025-10-07 01:06:03', '2025-10-07 01:06:03'),
(204, 'awmx1c8jx1gfrwtiedyc.png', 63, '2025-10-07 01:06:59', '2025-10-07 01:06:59'),
(205, 'p602.png', 64, '2025-10-07 01:07:43', '2025-10-07 01:07:43'),
(206, 'free-new-swiroski-diamond-also-hotfix-work-also-good-made-of-original-imah7ze8q5a2v3az.png', 65, '2025-10-07 01:15:39', '2025-10-07 01:15:39'),
(207, '3-rlo2244-3-0-red-tape-cream-original-imahf638xbdzfuyy.png', 66, '2025-10-07 01:17:32', '2025-10-07 01:17:32'),
(208, '3-sl-194-3-sparx-black-original-imahe3daz9nwf29v.png', 67, '2025-10-07 01:18:26', '2025-10-07 01:18:26'),
(209, '4-pipine-4-borrer-g0ld-original-imahc7kqcbbxfny7.png', 68, '2025-10-07 01:21:01', '2025-10-07 01:21:01'),
(210, '8-finger-8-bauchhaar-blue-original-imahefy2hwtpx2kg.png', 69, '2025-10-07 01:21:55', '2025-10-07 01:21:55'),
(211, '-original-imahesxunzu4yfvn.png', 70, '2025-10-07 01:22:41', '2025-10-07 01:22:41'),
(212, '-original-imahfhpu2zwr8gpx.png', 71, '2025-10-07 01:23:41', '2025-10-07 01:23:41'),
(213, '-original-imahfhpue7bfw4xf.png', 72, '2025-10-07 01:24:44', '2025-10-07 01:24:44'),
(214, '-original-imahfhputefajhyt.png', 73, '2025-10-07 01:25:54', '2025-10-07 01:25:54'),
(215, '-original-imahftqs3eyzvqyg.png', 74, '2025-10-07 01:26:45', '2025-10-07 01:26:45'),
(216, '-original-imahg242vdv2dn9a.png', 75, '2025-10-07 01:27:33', '2025-10-07 01:27:33'),
(217, '-original-imahgybxsskvnwhz.png', 76, '2025-10-07 01:28:17', '2025-10-07 01:28:17'),
(218, 'panel-garden-dr-brown-214-door-hs2pc000992dr-eyelet-home-sizzler-original-imag3n7yayhahavq.png', 77, '2025-10-07 01:34:19', '2025-10-07 01:34:19'),
(219, '-original-imahfjhpdk6npbms.png', 78, '2025-10-07 01:35:15', '2025-10-07 01:35:15'),
(220, '-original-imahept5pvq6x2gg.png', 79, '2025-10-07 01:38:54', '2025-10-07 01:38:54'),
(221, 'new-cpcc-010-so1-f-flipkart-smartbuy-original-imag3fz8qnzkuyxj.png', 80, '2025-10-07 01:39:46', '2025-10-07 01:39:46'),
(222, 'leaf-print-1-fsdbs002350-flat-fashion-string-original-imagu9wdvq2dx6xh.png', 81, '2025-10-07 01:41:05', '2025-10-07 01:41:05'),
(223, 'double-3-pk1001-rekha-boutique-original-imah9c39gmzmzmtu.png', 82, '2025-10-07 01:42:44', '2025-10-07 01:42:44'),
(224, 'c122-kartikae-original-imagyc4dfyqfe78c.png', 83, '2025-10-07 01:43:36', '2025-10-07 01:43:36'),
(225, 'butterfly-fitted-bedsheet-1-butterfly-fitted-bedsheet-fitted-original-imahdtggjsbmujzf.png', 84, '2025-10-07 01:44:26', '2025-10-07 01:44:26'),
(226, '300-tc-heavy-cotton-king-size-flat-bedsheet-set-1-premium-5-original-imah96t958sj4rfe.png', 85, '2025-10-07 01:45:30', '2025-10-07 01:45:30'),
(227, '300-tc-heavy-cotton-king-size-flat-bedsheet-set-1-premium-5-original-imah96t3wpffghan.png', 86, '2025-10-07 01:46:17', '2025-10-07 01:46:17'),
(228, '300tc-100-cotton-jaipuri-printed-super-queen-size-double-bed-original-imahddy6hy93y4va.png', 87, '2025-10-07 01:47:18', '2025-10-07 01:47:18'),
(229, '1-double-bedsheet-and-2-pillow-covers-1-49-flat-war-trade-original-imaheu7xeyr8jymj.png', 88, '2025-10-07 01:48:28', '2025-10-07 01:48:28'),
(230, '1-double-bedsheet-and-2-pillow-covers-1-28-flat-war-trade-original-imaheu7xhf3zkrhc.png', 89, '2025-10-07 01:49:38', '2025-10-07 01:49:38'),
(231, '1-bedsheet-2-pillow-cover-1-1-bedsheet-2-pillow-cover-fitted-original-imah4qqvh6q8kdgh.png', 90, '2025-10-07 01:50:45', '2025-10-07 01:50:45'),
(232, 'tundra-laptop-stand-with-cooler-kreo-original-imah7vthyrhzmtyf.png', 91, '2025-10-07 01:59:11', '2025-10-07 01:59:11'),
(233, 'fksbcpk17-flipkart-smartbuy-original-imagu3urygn4bz7k.png', 92, '2025-10-07 02:00:19', '2025-10-07 02:00:19'),
(234, 'airflow-x20-6-fans-rgb-lights-6-speed-level-metal-body-spinbot-original-imahf9gqbhghsf8u.png', 93, '2025-10-07 02:01:30', '2025-10-07 02:01:30'),
(235, '-original-imah933ezfggagpx.png', 94, '2025-10-07 02:03:14', '2025-10-07 02:03:14'),
(236, '125-t-20-synthetic-cricket-ball-wind-ball-for-cricket-tournament-original-imahfcczgeyh9csj.png', 95, '2025-10-07 02:04:51', '2025-10-07 02:04:51'),
(237, '750-800-34-inch-premium-lightweight-hard-plastic-tennis-cricket-original-imahefykzf2d7hdd.png', 96, '2025-10-07 02:06:57', '2025-10-07 02:06:57'),
(238, '750-900-slogger-suitable-only-for-tennis-ball-size-4-4-st-4039-original-imah2fdktkjmsygk.png', 97, '2025-10-07 02:08:13', '2025-10-07 02:08:13'),
(239, '800-34-inch-plastic-bat-plastic-bat-for-tennis-ball-cricket-original-imagrf8pmfj5p9ya.png', 98, '2025-10-07 02:09:46', '2025-10-07 02:09:46'),
(240, '800-850-hitman-hard-plastic-fiber-tennis-ball-cricket-bat-for-original-imah4d6dzzafcsjx.png', 99, '2025-10-07 02:11:18', '2025-10-07 02:11:18'),
(241, '800-850-hitman-hard-plastic-fiber-tennis-ball-cricket-bat-for-original-imah32z8fnx4zjhu.png', 100, '2025-10-07 02:12:18', '2025-10-07 02:12:18'),
(242, '800-scream-plastic-bat-full-size-cricket-tennis-bat-for-all-age-original-imahyfqwukhc65h4.png', 101, '2025-10-07 02:13:24', '2025-10-07 02:13:24'),
(243, '850-900-rebel-size-sh-full-size-34-x-4-5-inch-for-all-age-groups-original-imah563yu8z6r3hh.png', 102, '2025-10-07 02:14:50', '2025-10-07 02:14:50'),
(244, 'heavy-duty-plastic-cricket-bat-kit-combo-full-size-34-x-4-5-original-imagr7x4brdfh2hv.png', 103, '2025-10-07 02:15:58', '2025-10-07 02:15:58'),
(245, 'grand-edition-vk-18-limited-edition-564675467-30-hf-65-original-imah97vjns7kmrxu.png', 104, '2025-10-07 02:17:10', '2025-10-07 02:17:10'),
(247, 'newpro6.png', 43, '2025-10-07 04:18:23', '2025-10-07 04:18:23'),
(248, 'not_found_result_image.webp', 3, '2025-10-09 02:10:41', '2025-10-09 02:10:41'),
(254, 'p102.png', 1, '2025-10-10 00:11:20', '2025-10-10 00:11:20'),
(255, 'p103.png', 1, '2025-10-10 00:11:20', '2025-10-10 00:11:20'),
(268, 'homeandfurniture.png', 4, '2025-10-27 06:45:09', '2025-10-27 06:45:09'),
(266, 'electronics.png', 4, '2025-10-27 06:45:09', '2025-10-27 06:45:09'),
(272, 'man.png', 4, '2025-10-27 07:22:24', '2025-10-27 07:22:24'),
(273, 'women.png', 4, '2025-10-27 07:22:24', '2025-10-27 07:22:24'),
(274, 'logo1.png', 4, '2025-10-29 02:04:46', '2025-10-29 02:04:46'),
(275, 'back-cover-for-iphone-16-blue.png', 105, '2025-10-29 06:57:29', '2025-10-29 06:57:29'),
(276, 'back-cover-for-iphone-16-blue12.png', 105, '2025-10-29 06:57:29', '2025-10-29 06:57:29'),
(277, 'iphone-12-transperent.png', 106, '2025-10-29 06:58:45', '2025-10-29 06:58:45'),
(278, 'iphone-12-transperent12.png', 106, '2025-10-29 06:58:45', '2025-10-29 06:58:45'),
(279, 'whatch1.png', 107, '2025-10-29 07:06:59', '2025-10-29 07:06:59'),
(280, 'whatch2.png', 107, '2025-10-29 07:06:59', '2025-10-29 07:06:59'),
(281, 'whatch3.png', 107, '2025-10-29 07:06:59', '2025-10-29 07:06:59'),
(282, 'whatch12.png', 108, '2025-10-29 07:09:07', '2025-10-29 07:09:07'),
(283, 'whatch22.png', 108, '2025-10-29 07:09:07', '2025-10-29 07:09:07'),
(284, 'whatch32.png', 108, '2025-10-29 07:09:07', '2025-10-29 07:09:07'),
(285, 'samsung01.png', 109, '2025-10-29 07:26:26', '2025-10-29 07:26:26'),
(286, 'ipad01.png', 110, '2025-10-29 07:27:57', '2025-10-29 07:27:57'),
(287, 'power-off.png', 4, '2025-10-30 06:19:12', '2025-10-30 06:19:12'),
(288, 'user.png', 4, '2025-10-30 06:19:12', '2025-10-30 06:19:12'),
(289, 'changepassword-icon.png', 4, '2025-10-30 06:19:33', '2025-10-30 06:19:33'),
(290, 'heart.png', 4, '2025-10-30 06:19:34', '2025-10-30 06:19:34'),
(291, 'logistics.png', 4, '2025-10-30 06:19:34', '2025-10-30 06:19:34'),
(292, 'lessthen-categories.png', 4, '2025-10-30 23:08:20', '2025-10-30 23:08:20'),
(293, 'fasion.png', 4, '2025-11-05 00:59:03', '2025-11-05 00:59:03');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2025_08_20_044606_create_customer_table', 1),
(3, '2025_08_21_092239_create_admin_table', 1),
(4, '2025_08_25_072645_create_softdelete_table', 1),
(5, '2025_09_02_074158_create_productcategory_table', 1),
(6, '2025_09_02_075004_create_products_table', 1),
(7, '2025_09_03_054432_create_sub_catagory_table', 1),
(8, '2025_09_03_100505_add_subcategory_catagorytable', 1),
(9, '2025_09_05_044521_add_softdelete_sub_catagory_table', 1),
(10, '2025_09_05_065951_add_softdelete_catagory_table', 1),
(11, '2025_09_05_115404_add_admin_change_product_table', 1),
(12, '2025_09_08_042118_create_images_table', 1),
(13, '2025_09_11_100116_create_addtocart_table', 1),
(14, '2025_09_17_124323_create__order_table', 1),
(16, '2025_09_22_050339_create_favourite_product_table', 2),
(17, '2025_09_23_095230_product_add_dicount', 3),
(18, '2025_09_23_120912_create_coupen_table', 4),
(19, '2025_09_24_054358_create_user_coupun_data_table', 5),
(20, '2025_09_24_121031_add_customerorder_status', 6),
(24, '2025_10_15_083452_create_ratings_table', 7),
(25, '2025_10_15_102502_rate_add_order_table', 8),
(26, '2025_10_28_091159_add_countrycode_customerandshopkeeper', 9),
(27, '2025_10_31_083310_add_brand_name', 10),
(29, '2025_11_03_095842_add_addtocart_in_product', 11),
(30, '2025_11_03_105522_add_addtocart_in_addtocart', 12);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productcategory`
--

DROP TABLE IF EXISTS `productcategory`;
CREATE TABLE IF NOT EXISTS `productcategory` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productcategory`
--

INSERT INTO `productcategory` (`id`, `category_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Electronics', NULL, NULL, NULL),
(2, 'TVs & Appliances', NULL, NULL, NULL),
(3, 'Men', NULL, NULL, NULL),
(4, 'Women', NULL, NULL, NULL),
(5, 'Baby & Kids', NULL, '2025-10-03 00:42:51', '2025-10-03 00:42:51'),
(6, 'Home & Furniture', NULL, NULL, NULL),
(7, 'Sports, Books & More', NULL, '2025-10-01 00:37:26', NULL),
(22, 'wewe10', '2025-11-04 01:19:18', '2025-11-04 01:19:33', '2025-11-04 01:19:33'),
(21, 'demo123', '2025-10-03 22:31:24', '2025-10-03 22:31:32', '2025-10-03 22:31:32');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `stock` int NOT NULL,
  `category_id` bigint NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sub_category_id` bigint NOT NULL,
  `admin_id` bigint NOT NULL,
  `discount` int NOT NULL,
  `brand` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_stock` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_user_id_foreign` (`user_id`),
  KEY `products_sub_category_id_foreign` (`sub_category_id`),
  KEY `products_admin_id_foreign` (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `category_id`, `image`, `status`, `user_id`, `deleted_at`, `created_at`, `updated_at`, `sub_category_id`, `admin_id`, `discount`, `brand`, `main_stock`) VALUES
(1, 'iPhone 16 Pro Max  (8 ram, 256 storage)', 'Brand Apple \r\n-Operating System iOS 17 \r\n-RAM Memory Installed Size 256 GB Memory \r\n-Storage Capacity 256 GB \r\n-Screen Size 6.9 Inches', 133902, 1, 1, 'p101.png', 'in stock', 2, NULL, '2025-09-18 04:23:22', '2025-11-05 04:40:08', 1, 1, 11, 'Apple', 2),
(2, 'Realme 15  plus 5G', '8 GB RAM | 128 GB ROM -17.27 cm (6.8 inch) Display -50MP + 8MP | 50MP Front Camera -7000 mAh Battery -Mediatek Dimensity 7300+ 5G Processor', 25999, 0, 1, 'p001.png', 'in stock', 2, NULL, '2025-09-18 04:26:10', '2025-11-04 22:49:05', 1, 0, 17, 'Realme', 0),
(3, 'AC Blue Star 2025 Model 1 Ton', '1 Ton -5 Star BEE Rating 2025 : For energy savings upto 25% (compared to Non-Inverter 1 Star) -Auto Restart: No need to manually reset the settings post power-cut -Copper : Energy efficient, best in class cooling with easy maintenance. -Sleep Mode: Auto-adjusts the temperature to ensure comfort during your sleep', 37690, 8, 2, 'p401.png', 'in stock', 2, NULL, '2025-09-18 04:37:11', '2025-10-31 05:11:24', 11, 1, 6, 'Garnier', 0),
(14, 'Canon R100 Mirrorless Camera', 'DIGIC 8 Image Processor, 4K 24p Video with Crop, Full HD 60p, Dual Pixel CMOS AF with 143 AF Zones, 6.5 fps Electronic Shutter, 2.36m-Dot OLED EVF, 3\" 1.04m-Dot LCD Screen, Creative Assist Mode, Silent Mode for Quiet Operation, Bluetooth with SD Card Slot\r\n-Effective Pixels: 24.1 MP\r\n-Sensor Type: CMOS\r\n-WiFi Available\r\n-4K', 46990, 0, 1, 'pic6.jpg', 'out of stock', 2, NULL, '2025-09-19 01:16:12', '2025-10-31 03:15:02', 8, 0, 7, 'Canon', 0),
(4, 'Samsung Crystal 4K Infinitys', 'Supported Apps: Netflix, JioHotstar, Prime Video, YouTube, Zee5, Apple TV+, Sony LIV -Operating System: Tizen Resolution: Ultra HD (4K) 3840 x 2160 Pixels -Sound Output: 20 W -Refresh Rate: 50 Hz', 68990, 2, 2, 'p301.png', 'in stock', 2, NULL, '2025-09-18 04:39:22', '2025-11-05 00:59:01', 9, 1, 13, 'Samsung', 0),
(5, 'BRUTON  740 EVA Men s Sport Shoes', 'Men\'s Sport Shoes Running Shoes', 433, 1, 3, 'p501.png', 'in stock', 2, NULL, '2025-09-18 04:49:44', '2025-11-04 01:25:30', 14, 0, 5, 'BRUTON', -1),
(6, 'Cellecor HYPE 1.50 HD IPS Display Smartwatch', 'With Call Function Touchscreen Fitness & Outdoor -Battery Runtime: Upto 7 days', 899, 7, 3, 'p601.png', 'in stock', 2, NULL, '2025-09-18 04:56:37', '2025-11-04 01:25:30', 18, 0, 6, 'Cellecor', -2),
(7, 'Women Heels Sandal  (White , 7)', 'Women Heels Sandal  (White , 7)', 749, 3, 4, 'p701.png', 'in stock', 2, NULL, '2025-09-18 05:09:46', '2025-11-02 23:48:03', 21, 0, 8, 'Bambam', 0),
(8, 'Mandarin Collar Casual Shirt', 'Size:XL -Fits:Regular', 350, 8, 4, 'p801.png', 'in stock', 2, NULL, '2025-09-18 05:10:58', '2025-10-31 06:59:33', 19, 0, 4, 'TokyoTalkies', 0),
(9, 'DPA Collection Round Pack of 4 Table Placemat', 'Shape: Round -Color: Gold-Material: PVC -Pattern: Floral', 288, 14, 6, 'p1001.png', 'in stock', 2, NULL, '2025-09-18 22:55:53', '2025-11-04 01:26:29', 25, 0, 3, 'DPA', -1),
(10, 'Leo Creation Cotton Double Flat', 'Flat (L x W): 230 cm x 210 cm -Material: Cotton -Includes: Number of Bedsheets: 1 -Thread Count: 144 -Color: Yellow, Pale, Pink, Light Pink, Green, Light Green, Grey, Light Grey', 358, 23, 6, 'p901.png', 'in stock', 2, NULL, '2025-09-18 22:58:12', '2025-10-31 06:02:57', 25, 0, 4, 'Leo', 0),
(11, 'SONY PlayStation5 Console', 'PS5 -Games Included:No -Lightning Speed -Harness the power of a custom CPU, GPU, and SSD with Integrated I/O that rewrite the rules of what a PlayStation console can do. -Stunning Games - Marvel at incredible graphics and experience new PS5 features. Play a back catalog of supported PS4 games. -Breathtaking Immersion -Discover a deeper gaming experience with support for haptic feedback, adaptive triggers, and 3D Audio2 technology. -Haptic Feedback -Experience haptic feedback via the DualSense wireless controller in select PS5 titles and feel the effects and impact of your in-game actions through dynamic sensory feedback. - Adaptive Triggers - Immerse yourself in soundscapes where it feels as if the sound comes from every direction. Your surroundings truly come alive with Tempest 3D AudioTech2 in supported games.', 54990, 6, 7, 'p1101.png', 'in stock', 2, NULL, '2025-09-18 23:02:45', '2025-10-31 06:07:14', 31, 0, 10, 'SONY', 0),
(12, 'Roller Ball Pen With Parker Keychain', 'Body Color: Black, White -Made of Plastic -Solid Body Type -Pack of 1', 424, 16, 7, 'p1201.png', 'in stock', 2, NULL, '2025-09-18 23:04:53', '2025-10-31 06:07:39', 26, 0, 13, 'Keychain', 0),
(13, 'JBL Partybox 310 Bluetooth Speaker', 'Power Output(RMS): 240 W\r\n-Power Source: AC Adapter\r\n-Battery life: 18 hrs | Charging time: 3.5 hrs\r\n-Bluetooth Version: 5.1\r\n-Wireless range: 10 m\r\n-Wireless music streaming via Bluetooth', 34999, 1, 1, 'dj2.jpg', 'in stock', 2, NULL, '2025-09-19 01:13:22', '2025-11-04 00:17:23', 7, 0, 10, 'JBL', -1),
(15, 'Lenovo LOQ Intel Core i7 13th Gen 13650HX', '15.6 inch Full HD IPS 300nits Anti-glare, 100% sRGB, 144Hz, G-SYNC\r\n-Light Laptop without Optical Disk Drive\r\n-Preloaded with MS Office', 108190, 0, 1, 'l_leptop2.png', 'out of stock', 2, NULL, '2025-09-19 01:23:35', '2025-11-05 05:04:18', 4, 0, 15, 'Lenovo', -1),
(16, 'ENTWINO Intel Core i5 Assembled Desktop Computer', '22 Inches Monitor\r\n-16 GB RAM\r\n-128 GB SSD\r\n-500 GB HDD', 14499, 8, 1, 'computer1.png', 'in stock', 2, NULL, '2025-09-19 01:29:14', '2025-11-04 01:04:50', 5, 0, 5, 'ENTWINO', 0),
(17, 'Whirlpool 184 L Direct Cool Single Door 2 Star Refrigerator', '184 L : Good for couples and small families\r\n-Reciprocating Compressor\r\n-2 Star : For Energy savings up to 20%\r\n-Direct Cool : Economical, consumes less electricity, requires manual defrosting', 12790, 5, 2, 'freg1.png', 'in stock', 2, NULL, '2025-09-19 01:33:33', '2025-10-31 05:11:51', 12, 0, 10, 'Whirlpool', 0),
(18, 'Fully Automatic Front Load Washing Machine', 'Fully Automatic Front Load Washing Machines -have Great Wash Quality with very less running cost\r\n-1200 rpm : Higher the spin speed, lower the drying time\r\n-5 Star Rating\r\n-7 kg', 26990, 2, 2, 'washingmachine1.png', 'in stock', 2, NULL, '2025-09-19 01:36:44', '2025-10-31 05:14:43', 10, 0, 9, 'LG', 0),
(19, 'RK EMPIRE Plastic Grocery Container', 'Type: Grocery Container\r\n-Material: Plastic\r\n-Airtight\r\n-Safety Features: BPA Free, Dishwasher Safe,\r\n-Freezer Safe\r\n-Pack of 24', 459, 8, 2, 'kitchen1.png', 'in stock', 2, NULL, '2025-09-19 01:41:56', '2025-10-31 05:15:01', 13, 0, 2, 'RKEMPIRE', 0),
(20, 'Men Regular Mid Rise Black Jeans', 'Men Regular Mid Rise Black Jeans', 277, 14, 3, 'jeans11.png', 'in stock', 2, NULL, '2025-09-19 01:49:49', '2025-11-04 01:25:30', 17, 0, 2, 'KILLER', -1),
(21, 'Men Loose Fit Mid Rise White Jeans', 'Men Loose Fit Mid Rise White Jeans', 426, 21, 3, 'jeans01.png', 'in stock', 2, NULL, '2025-09-19 01:50:59', '2025-10-31 05:20:10', 17, 0, 3, 'POLO', 0),
(22, 'Casual Shirt', 'Men Regular Fit Solid Spread Collar Casual Shirt', 313, 23, 3, 'shirt01.png', 'in stock', 2, NULL, '2025-09-19 01:57:02', '2025-10-31 05:20:46', 16, 0, 4, 'Raymond', 0),
(23, 'Solid Shirt', 'Men Regular Fit Solid Spread Collar Casual Shirt', 391, 2, 3, 'shirt11.png', 'in stock', 2, NULL, '2025-09-19 01:58:06', '2025-10-31 05:21:26', 16, 0, 11, 'LOUISPHILIPPE', 0),
(24, 'Sneakers For Women', 'Casual Sneakers White Shoes For Girls And Sneakers For Women', 442, 5, 4, 'shows01.png', 'in stock', 2, NULL, '2025-09-19 02:05:28', '2025-11-04 01:25:50', 21, 0, 6, 'Sneakers', 0),
(25, 'Watch Women', 'Gorgeous Analog Watch - For Women Diamond Studded Series', 226, 5, 4, 'watch01.png', 'in stock', 2, NULL, '2025-09-19 02:06:22', '2025-11-02 23:33:56', 20, 0, 6, 'Titen', 0),
(26, 'demo', 'demo', 123123, 2, 1, 'p002.png', 'in stock', 2, '2025-10-31 03:16:12', '2025-09-22 06:39:31', '2025-10-31 03:16:12', 1, 0, 12, '', 0),
(37, 'Realme 14 pro plue', '12 GB RAM | 512 GB ROM\r\n-17.35 cm (6.83 inch) Display\r\n-50MP + 50MP + 8MP | 32MP Front Camera\r\n-6000 mAh Battery\r\n-7s Gen 3 Mobile Platform Processor', 34999, 1, 1, 'realme14proplue1.png', 'in stock', 15, NULL, '2025-10-06 00:18:24', '2025-11-02 23:56:56', 1, 0, 9, 'Realme', 0),
(28, 'Best Cumputer', 'Best Customer', 133900, 6, 1, 'computer1.png', 'in stock', 1, NULL, '2025-09-29 03:39:01', '2025-10-16 00:00:21', 5, 0, 9, '', 0),
(27, 'Casual Bell Sleeves Printed Women Maroon Top', 'Casual Bell Sleeves Printed Women Maroon Top', 970, 25, 4, 'p803.png', 'in stock', 2, NULL, '2025-09-25 01:15:10', '2025-10-31 05:37:12', 19, 1, 13, 'Casual', 0),
(29, 'DELL Intel Core i3 13th Gen 1305U', 'Stylish & Portable Thin and Light Laptop\r\n-15.6 Inch Full HD, WVA AG, 120Hz, 250 nits, Narrow Border\r\n-Light Laptop without Optical Disk Drive', 38000, 4, 1, 'l_leptop2.png', 'in stock', 2, NULL, '2025-09-30 04:09:26', '2025-11-02 23:16:29', 4, 0, 15, 'DELL', 0),
(31, 'gsdfgs', 'sdfgsd', 6767, 4, 2, 'phone6.png', 'in stock', 2, '2025-10-03 06:48:31', '2025-10-03 05:31:05', '2025-10-03 06:48:31', 13, 0, 0, '', 0),
(30, 'DELL 15 Intel Core i5 13th Gen', 'Preloaded with MS Office\r\n-Light Laptop without Optical Disk Drive\r\n-15.6 inch Full HD, WVA AG, 120Hz, 250 nits, Narrow Border', 56899, 3, 1, 'p_leptop1.png', 'in stock', 2, NULL, '2025-10-03 01:43:43', '2025-10-31 04:03:31', 4, 1, 12, 'DELL', 0),
(32, 'Realme 15 Pro 5G', '8 GB RAM | 256 GB ROM\r\n-17.27 cm (6.8 inch) Display\r\n-50MP + 50MP | 50MP Front Camera\r\n-7000 mAh Battery\r\n-Snapdragon 7 Gen 4 Processor', 34000, 3, 1, 'phone6.png', 'in stock', 2, NULL, '2025-10-03 06:50:09', '2025-11-04 01:04:52', 1, 0, 0, 'Realme', 0),
(35, '1234', '1234', 12000, 0, 1, 'phone4.png', 'out of stock', 2, '2025-10-06 07:19:38', '2025-10-04 00:57:10', '2025-10-06 07:19:38', 8, 0, 0, '', 0),
(33, 'ghgg', 'fgfgf', 67, 7, 4, 'logo.png', 'in stock', 2, '2025-10-03 23:39:07', '2025-10-03 23:38:17', '2025-10-03 23:39:07', 19, 0, 0, '', 0),
(34, 'wwww', 'wwww', 23, 23, 4, 'missingcart.png', 'in stock', 2, '2025-10-03 23:45:47', '2025-10-03 23:45:37', '2025-10-03 23:45:47', 21, 0, 45, '', 0),
(36, 'eeeee ytyty 90', 'dfgsdfgsd', 5454, 5, 1, 'phone3.png', 'in stock', 2, '2025-10-06 07:19:43', '2025-10-04 04:19:09', '2025-10-06 07:19:43', 8, 0, 0, '', 0),
(38, 'MOTOROLA Edge 60 Pro', '8 GB RAM | 256 GB ROM\r\n-17.02 cm (6.7 inch) Display\r\n-50MP + 50MP + 10MP | 50MP Front Camera\r\n-6000 mAh Battery\r\n-Dimensity 8350 Processor', 26999, 3, 1, 'newpro1.png', 'in stock', 2, NULL, '2025-10-06 07:27:52', '2025-10-31 07:14:50', 1, 0, 17, 'Motorola', 0),
(39, 'iPhone 17', '256 GB ROM\r\n-16.0 cm (6.3 inch) Super Retina XDR Display\r\n-48MP + 48MP | 18MP Front Camera\r\n-A19 Chip, 6 Core Processor Processor', 82900, 5, 1, 'newpro3.png', 'in stock', 2, NULL, '2025-10-06 07:29:13', '2025-10-31 03:53:16', 1, 0, 6, 'Apple', 0),
(40, 'Google Pixel 10', '12 GB RAM | 256 GB ROM\r\n-16.0 cm (6.3 inch) Quad HD+ Display\r\n-48MP + 13MP + 10.8MP | 10.5MP Front Camera\r\n-4970 mAh Battery\r\n-Tensor G5 Processor', 79999, 4, 1, 'newpro2.png', 'in stock', 2, NULL, '2025-10-06 07:31:02', '2025-10-31 03:30:58', 1, 0, 5, 'Google', 0),
(41, 'vivo V60 5G', '8 GB RAM | 256 GB ROM\r\n-17.2 cm (6.77 inch) Display\r\n-50MP + 8MP + 50MP | 50MP Front Camera\r\n-6500 mAh Battery\r\n-7 Gen 4 Processor', 38999, 19, 1, 'newpro4.png', 'in stock', 2, NULL, '2025-10-06 07:32:29', '2025-11-03 01:10:50', 1, 0, 21, 'Vivo', 0),
(42, 'Nothing Phone', '8 GB RAM | 128 GB ROM\r\n-43.66 cm (17.19 cm) Full HD+ Display\r\n-50MP (Main) + 50MP (2X Tele Photo) + 8MP (Ultra-Wide) | 32MP Front Camera\r\n-5000 mAh Battery\r\n-7s Gen3 Processor', 23999, 3, 1, 'newpro5.png', 'in stock', 2, NULL, '2025-10-06 23:42:59', '2025-10-31 03:31:18', 1, 0, 6, 'Nothing', 0),
(43, 'vivo T4 5G', '8 GB RAM | 128 GB ROM\r\n-17.2 cm (6.77 inch) Display\r\n-50MP (OIS) + 2MP | 32MP Front Camera\r\n-7300 mAh Battery\r\n-Snapdragon 7s Gen 3 5G Processor', 25999, 100, 1, 'newpro6.png', 'in stock', 2, NULL, '2025-10-06 23:54:14', '2025-10-31 03:31:32', 1, 0, 19, 'Vivo', 0),
(44, 'SONY BRAVIA 2 138 cm', 'Supported Apps: Apple TV+, Netflix, YouTube, JioHotstar, Prime Video, Sony LIV\r\n-Operating System: Google TV\r\n-Resolution: Ultra HD (4K) 3840 x 2160 Pixels\r\n-Sound Output: 20 W\r\n-Refresh Rate: 60 Hz', 55999, 4, 2, 'btwgdz6zhraqvnhw0w0t.png', 'in stock', 2, NULL, '2025-10-07 00:34:05', '2025-11-02 23:59:22', 9, 0, 4, 'SONY', 0),
(45, 'XiaomiBRAVIA 3 189', 'Supported Apps: Netflix, JioHotstar, Prime Video, YouTube\r\n-Operating System: Google TV\r\n-Resolution: Ultra HD (4K) 3840 x 2160 Pixels\r\n-Sound Output: 20 W\r\n-Refresh Rate: 60 Hz', 135990, 4, 2, 'fbi1xox3mvnpcoo6w5yg.png', 'in stock', 2, NULL, '2025-10-07 00:35:33', '2025-10-31 05:15:45', 9, 0, 2, 'Xiaomi', 0),
(46, 'SONY BRAVIA 2 125 cm', 'Supported Apps: Apple TV+, Netflix, YouTube, JioHotstar, Prime Video, Sony LIV\r\n-Operating System: Google TV\r\n-Resolution: Ultra HD (4K) 3840 x 2160 Pixels\r\n-Sound Output: 20 W\r\n-Refresh Rate: 60 Hz', 51990, 3, 2, 'g4i8rpxsqmfdhodabsfq.png', 'in stock', 2, NULL, '2025-10-07 00:38:24', '2025-10-31 05:15:53', 9, 0, 2, 'SONY', 0),
(47, 'SONY BRAVIA 2 125 cm', 'Supported Apps: Apple TV+, Netflix, YouTube, JioHotstar, Prime Video, Sony LIV\r\n-Operating System: Google TV\r\n-Resolution: Ultra HD (4K) 3840 x 2160 Pixels\r\n-Sound Output: 20 W\r\n-Refresh Rate: 60 Hz', 51990, 3, 2, 'sywwpixmnssapzrad65l.png', 'in stock', 2, NULL, '2025-10-07 00:39:22', '2025-10-31 05:16:01', 9, 0, 2, 'SONY', 0),
(48, 'XIAOMI by Mi 125 cm', 'Supported Apps: Netflix, JioHotstar, Prime Video, YouTube\r\n-Operating System: Google TV\r\n-Resolution: Ultra HD (4K) 3840 x 2160 Pixels\r\n-Sound Output: 30 W\r\n-Refresh Rate: 120 Hz', 29499, 5, 2, 'hydnqcv6e96ledygtfxq.png', 'in stock', 2, NULL, '2025-10-07 00:41:48', '2025-10-31 05:16:19', 9, 0, 3, 'XIAOMI', 0),
(49, 'XIAOMI by Mi X Pro CineMagiQLED 108 cm', 'Supported Apps: Netflix, JioHotstar, Prime Video, YouTube\r\n-Operating System: Google TV\r\n-Resolution: Ultra HD (4K) 3840 x 2160 Pixels\r\n-Sound Output: 30 W\r\n-Refresh Rate: 60 Hz', 27999, 5, 2, 'ixkbyluxfoxytiejjc8e.png', 'in stock', 2, NULL, '2025-10-07 00:42:58', '2025-10-31 05:16:25', 9, 0, 5, 'XIAOMI', 0),
(50, 'PIXEL ENTERPRISE COFFEE GRINDERS Personal Coffee Make', 'Type: Super Automatic Coffee Machine\r\n-Capacity: 1 Cup', 402, 8, 2, 'lcv6jblrdksf9i7gfqwe.png', 'in stock', 2, NULL, '2025-10-07 00:44:07', '2025-10-31 05:16:40', 13, 0, 3, 'PIXEL', 0),
(51, 'Haier W400UG 109 cm', 'Supported Apps: Prime Video, Netflix, YouTube, JioHotstar\r\n-Operating System: Google TV\r\n-Resolution: Ultra HD (4K) 3840 x 2160 Pixels\r\n-Sound Output: 16 W\r\n-Refresh Rate: 60 Hz', 22890, 4, 2, 'nxrahxlaibkqo7l4er4x.png', 'in stock', 2, NULL, '2025-10-07 00:45:11', '2025-10-31 05:16:51', 9, 0, 1, 'Haier', 0),
(52, 'Morphy Richards Impresso Espresso 20 Cups Coffee Maker', 'Type: Espresso Machine\r\n-Capacity: 20 Cups\r\n-Power Consumption: 1100 W', 8818, 6, 2, 'pqu4hrzrl5yejqcb3uns.png', 'in stock', 2, NULL, '2025-10-07 00:46:33', '2025-10-31 05:16:58', 13, 0, 2, 'Morphy', 0),
(53, 'Costar Espresso Master 7s 10 Cups Coffee Maker', 'Type: Espresso Machine\r\n-Capacity: 10 Cups\r\n-Water Level Indicator', 26779, 4, 2, 'vxbbj7qliglbw26fekum.png', 'in stock', 2, NULL, '2025-10-07 00:48:08', '2025-10-31 05:17:11', 13, 0, 2, 'Costar', 0),
(54, 'Thomson TV 108 cm', 'Supported Apps: Netflix, JioHotstar, Prime Video, YouTube\r\n-Operating System: JioTele OS\r\n-Resolution: Ultra HD (4K) 3840 x 2160 Pixels\r\n-Sound Output: 40 W\r\n-Refresh Rate: 60 Hz', 17499, 5, 2, 'p302.png', 'in stock', 2, NULL, '2025-10-07 00:49:21', '2025-10-31 05:17:40', 9, 0, 4, 'SAMSUNG', 0),
(55, 'Velox Chunky Sneakers Shoes', 'Velox-740 Chunky Sneakers Shoes', 395, 7, 3, 'b1kutptcfbmghhwekagz.png', 'in stock', 2, NULL, '2025-10-07 00:54:43', '2025-10-31 07:09:03', 14, 0, 2, 'Velox', 0),
(56, 'Pack of 2 Men Self Design Polo Neck Polyester Black', 'Pack of 2 Men Self Design Polo Neck Polyester Black', 478, 5, 3, 'f1nerhs6pkefkdz0mosn.png', 'in stock', 2, NULL, '2025-10-07 00:55:51', '2025-10-31 05:27:09', 16, 0, 3, 'POLO', 0),
(57, 'Khalifa Lifestyle Casual Shoes for Men', 'Khalifa Lifestyle Casual Shoes for Men', 330, 7, 3, 'sn2jyje2xdkb8tr35e2c.png', 'in stock', 2, NULL, '2025-10-07 00:56:36', '2025-10-31 05:28:47', 14, 0, 3, 'PUMA', 0),
(58, 'Men Printed Polo Neck Polycotton Black', 'Men Printed Polo Neck Polycotton Black', 270, 6, 3, 'xi7ublmt1bdl9drkkilb.png', 'in stock', 2, NULL, '2025-10-07 00:57:21', '2025-10-31 05:29:00', 16, 0, 2, 'POLO', 0),
(59, 'Men Solid Polo', 'Men Solid Polo Neck Polycotton Black T-Shirt', 284, 5, 3, 'bxalrg6aba5wthonzkmc.png', 'in stock', 2, NULL, '2025-10-07 01:03:43', '2025-10-31 05:29:24', 16, 0, 3, 'POLO', 0),
(60, 'Men Printed Polo', 'Men Printed Polo Neck Polycotton Brown T-Shirt', 270, 4, 3, 'hv4t3jl8bidltovccx2i.png', 'in stock', 2, NULL, '2025-10-07 01:04:35', '2025-10-31 05:29:34', 16, 0, 1, 'POLO', 0),
(61, 'Men Striped Zip', 'Men Striped Zip Neck Polyester Brown T-Shirt', 240, 6, 3, 'x53rz0rnxxjuefymlhdb.png', 'in stock', 2, NULL, '2025-10-07 01:05:22', '2025-10-31 05:29:42', 16, 0, 2, 'POLO', 0),
(62, 'Men Self Design Zip', 'Men Self Design Zip Neck Cotton Blend White, Black T-Shirt', 319, 5, 3, 'vj4gpa18tnjljenwygjp.png', 'in stock', 2, NULL, '2025-10-07 01:06:03', '2025-10-31 05:29:51', 16, 0, 2, 'POLO', 0),
(63, 'Black T shirt', 'Men Self Design Zip Neck Cotton Blend White, Black T-Shirt', 999, 5, 3, 'awmx1c8jx1gfrwtiedyc.png', 'in stock', 2, NULL, '2025-10-07 01:06:59', '2025-10-31 05:30:00', 16, 0, 30, 'POLO', 0),
(64, 'Fire Boltt Rise Bluetooth Calling Watch', 'Premium Metal Body-Designed for those who appreciate style and durability, Fire-Boltt Rise features a sleek and sturdy metal frame that exudes sophistication while ensuring long-lasting strength.\r\n-Effortless Rotating Crown Control-Say goodbye to clunky navigation The smooth rotating crown lets you scroll through menus, switch watch faces, and access features with just a simple twist, making interactions faster and more intuitive.\r\n-Futuristic Neon UI-Immerse yourself in a cutting-edge display with a bold and dynamic Neon UI. The vibrant colors, smooth transitions, and sharp visuals create an eye-catching interface that enhances readability and aesthetics.\r\n-Seamless Single BT Connection-No more juggling multiple Bluetooth connections Fire-Boltt Rise ensures a hassle-free experience with a single Bluetooth pairing,\r\n-With Call Function\r\n-Touchscreen\r\n-Fitness & Outdoor, Health & Medical\r\n-Battery Runtime: Upto 7 days', 11999, 5, 3, 'p602.png', 'in stock', 2, NULL, '2025-10-07 01:07:43', '2025-10-31 07:19:42', 18, 0, 91, 'FireBoltt', 0),
(65, 'Jacquard Saree', 'Embellished, Self Design, Solid/Plain Bollywood Georgette, Jacquard Saree', 428, 5, 4, 'free-new-swiroski-diamond-also-hotfix-work-also-good-made-of-original-imah7ze8q5a2v3az.png', 'in stock', 2, NULL, '2025-10-07 01:15:39', '2025-10-31 05:37:59', 19, 0, 0, 'Jacquard', 0),
(66, 'Women Athleisure Sports Shoes', 'Women\'s Athleisure Sports Shoes for Active Everyday Style Walking Shoes For Women  (Beige , 6)', 962, 4, 4, '3-rlo2244-3-0-red-tape-cream-original-imahf638xbdzfuyy.png', 'in stock', 2, NULL, '2025-10-07 01:17:32', '2025-10-31 05:38:35', 21, 0, 2, 'Sneakers', 0),
(67, 'Running Shoes For Women', 'SL 194 Running Shoes For Women  (Black, Pink , 5)', 659, 6, 4, '3-sl-194-3-sparx-black-original-imahe3daz9nwf29v.png', 'in stock', 2, NULL, '2025-10-07 01:18:26', '2025-10-31 05:38:41', 21, 0, 3, 'Sneakers', 0),
(68, 'Running Shoes For Women', 'Running Shoes For Women  (White , 4)', 408, 6, 4, '4-pipine-4-borrer-g0ld-original-imahc7kqcbbxfny7.png', 'in stock', 2, NULL, '2025-10-07 01:21:01', '2025-10-31 05:38:46', 21, 0, 2, 'Sneakers', 0),
(69, 'Shoes For Women', 'Running Shoes For Women  (Blue, White , 8)', 334, 7, 4, '8-finger-8-bauchhaar-blue-original-imahefy2hwtpx2kg.png', 'in stock', 2, NULL, '2025-10-07 01:21:55', '2025-10-31 05:38:52', 21, 0, 2, 'Sneakers', 0),
(70, 'Stylish Casual Sports Shoe', 'Stylish Casual Sports Shoe Running Shoes For Women  (White , 4)', 385, 4, 4, '-original-imahesxunzu4yfvn.png', 'in stock', 2, NULL, '2025-10-07 01:22:41', '2025-10-31 05:38:59', 21, 0, 2, 'Sneakers', 0),
(71, 'SUMA Shoes', 'SUMA Running Shoes For Women  (Blue , 7)', 807, 8, 4, '-original-imahfhpu2zwr8gpx.png', 'in stock', 2, NULL, '2025-10-07 01:23:41', '2025-10-31 05:39:04', 21, 0, 5, 'Sneakers', 0),
(72, 'KAYA Shoes', 'KAYA Running Shoes For Women  (Off White , 6)', 784, 4, 4, '-original-imahfhpue7bfw4xf.png', 'in stock', 2, NULL, '2025-10-07 01:24:44', '2025-10-31 05:39:13', 21, 0, 2, 'KAYA', 0),
(73, 'KAYA Shoes', 'KAYA Running Shoes For Women  (Off White , 7)', 784, 6, 4, '-original-imahfhputefajhyt.png', 'in stock', 2, NULL, '2025-10-07 01:25:54', '2025-10-31 05:39:20', 21, 0, 4, 'KAYA', 0),
(74, 'Fabbmate shoes', 'Fabbmate Casual Sports shoes White Sneakers for Women Girls White Shoes Sneakers For Women  (White, Brown , 8)', 377, 3, 4, '-original-imahftqs3eyzvqyg.png', 'in stock', 2, NULL, '2025-10-07 01:26:45', '2025-10-31 05:39:30', 21, 0, 3, 'Fabbmate', 0),
(75, 'Fabbmate Sports Shoes', 'Fabbmate Trendy Sports Shoes for Women\'s Running,Walking with Memory Foam Running Shoes For Women  (Purple , 8)', 268, 10, 4, '-original-imahg242vdv2dn9a.png', 'in stock', 2, NULL, '2025-10-07 01:27:33', '2025-10-31 05:39:38', 21, 0, 0, 'Fabbmate', 0),
(76, 'Fabbmate Sneakers', 'Fabbmate Casual Sports Sneakers For Women  (White , 8)', 355, 5, 4, '-original-imahgybxsskvnwhz.png', 'in stock', 2, NULL, '2025-10-07 01:28:17', '2025-10-31 05:39:49', 21, 0, 0, 'Fabbmate', 0),
(77, 'Home Sizzler 153 cm', 'Window (115 cm x 153 cm)\r\n-Material: Polyester\r\n-Pack of: 2\r\n-Transparency: Semi Transparent\r\n-Closure Type: Eyelet', 291, 5, 6, 'panel-garden-dr-brown-214-door-hs2pc000992dr-eyelet-home-sizzler-original-imag3n7yayhahavq.png', 'in stock', 2, NULL, '2025-10-07 01:34:19', '2025-10-31 06:04:20', 25, 0, 3, 'HOMEMONDE', 0),
(78, 'Homerica Solid Double Comforter for AC Room', 'Type: Comforter\r\n-Size: 213.36 cm x 228.6 cm\r\n-Ideal Usage: AC Room\r\n-Pack of: 1', 516, 6, 6, '-original-imahfjhpdk6npbms.png', 'in stock', 2, NULL, '2025-10-07 01:35:15', '2025-10-31 06:04:48', 24, 0, 2, 'Homerica', 0),
(79, 'Rekha boutique Cotton Double Bed Cover  Green 1 bedcover 2 Pillow Cover', 'Type: Bed Cover\r\n-Size: Double\r\n-Pattern: Printed\r\n-Pack of 3', 255, 5, 6, '-original-imahept5pvq6x2gg.png', 'in stock', 2, NULL, '2025-10-07 01:38:54', '2025-10-31 06:04:54', 24, 0, 2, 'Homerica', 0),
(80, 'Flipkart SmartBuy Polyester 1 Seater Chair Floral Cover  Pack of 1 Multicolor', '40 cm\r\n-Suitable For: Chair\r\n-Material: Polyester\r\n-Pack of: 1\r\n-Pattern: Floral\r\n-Seating Capacity: 1 Seater', 166, 3, 6, 'new-cpcc-010-so1-f-flipkart-smartbuy-original-imag3fz8qnzkuyxj.png', 'in stock', 2, NULL, '2025-10-07 01:39:46', '2025-10-31 06:05:26', 24, 0, 9, 'Homerica', 0),
(81, 'Fashion String Microfiber Double Flat 144 TC Printed Bedsheet', 'Flat (L x W): 220 cm x 230 cm\r\n-Material: Microfiber\r\n-Includes: Number of Bedsheets: 1\r\n-Thread Count: 144\r\n-Color: Black and White', 211, 6, 6, 'leaf-print-1-fsdbs002350-flat-fashion-string-original-imagu9wdvq2dx6xh.png', 'in stock', 2, NULL, '2025-10-07 01:41:05', '2025-10-31 06:05:32', 24, 0, 0, 'Homerica', 0),
(82, 'Rekha boutique Cotton Double Bed Cover', 'Type: Bed Cover\r\n-Size: Double\r\n-Pattern: Printed\r\n-Pack of 3', 255, 5, 6, 'double-3-pk1001-rekha-boutique-original-imah9c39gmzmzmtu.png', 'in stock', 2, NULL, '2025-10-07 01:42:44', '2025-10-31 06:05:37', 24, 0, 3, 'Homerica', 0),
(83, 'THE FRESH LIVERY Dark Blue Cotton Carpet', 'Material: Cotton\r\n-Type: Carpet\r\n-Size: 6 ft x 4 ft\r\n-Shape: Rectangle', 271, 5, 6, 'c122-kartikae-original-imagyc4dfyqfe78c.png', 'in stock', 2, NULL, '2025-10-07 01:43:36', '2025-10-31 06:05:42', 24, 0, 2, 'Homerica', 0),
(84, 'Moonroof Cotton Double Fitted', '16 cm\r\n-Material: Cotton\r\n-Includes: Number of Bedsheets: 1\r\n-Thread Count: 244\r\n-Color: Butterfy', 267, 4, 6, 'butterfly-fitted-bedsheet-1-butterfly-fitted-bedsheet-fitted-original-imahdtggjsbmujzf.png', 'in stock', 2, NULL, '2025-10-07 01:44:26', '2025-10-31 06:05:47', 24, 0, 0, 'Homerica', 0),
(85, 'CLOVIS KRAFTS Cotton King Flat 300 TC Printed Bedsheet', 'Flat (L x W): 254 cm x 230 cm\r\n-Material: Cotton\r\n-Includes: Number of Bedsheets: 1\r\n-Thread Count: 300\r\n-Color: CREAM FEATHER', 443, 4, 6, '300-tc-heavy-cotton-king-size-flat-bedsheet-set-1-premium-5-original-imah96t958sj4rfe.png', 'in stock', 2, NULL, '2025-10-07 01:45:30', '2025-10-31 06:05:51', 24, 0, 0, 'Homerica', 0),
(86, 'CLOVIS KRAFTS Cotton King Flat 300 TC Printed Bedsheet', 'Flat (L x W): 254 cm x 230 cm\r\n-Material: Cotton\r\n-Includes: Number of Bedsheets: 1\r\n-Thread Count: 300\r\n-Color: Pink', 443, 7, 6, '300-tc-heavy-cotton-king-size-flat-bedsheet-set-1-premium-5-original-imah96t3wpffghan.png', 'in stock', 2, NULL, '2025-10-07 01:46:17', '2025-10-31 06:05:57', 24, 0, 3, 'Homerica', 0),
(87, 'Rekha boutique Cotton Double Bed Cover', 'Type: Bed Cover\r\n-Size: Double\r\n-Pattern: Printed\r\n-Pack of 3', 249, 3, 6, '300tc-100-cotton-jaipuri-printed-super-queen-size-double-bed-original-imahddy6hy93y4va.png', 'in stock', 2, NULL, '2025-10-07 01:47:18', '2025-10-31 06:06:03', 24, 0, 0, 'Homerica', 0),
(88, 'Leo Creation Cotton Double Flat 144 TC Jaipuri Prints Bedsheet', 'Flat (L x W): 230 cm x 210 cm\r\n-Material: Cotton\r\n-Includes: Number of Bedsheets: 1\r\n-Thread Count: 144\r\n-Color: Kerosene, Blue, Black', 316, 6, 6, '1-double-bedsheet-and-2-pillow-covers-1-49-flat-war-trade-original-imaheu7xeyr8jymj.png', 'in stock', 2, NULL, '2025-10-07 01:48:28', '2025-10-31 06:06:11', 25, 0, 2, 'Homerica', 0),
(89, 'Leo Creation Cotton Double Flat 144 TC Jaipuri Prints Bedsheet', 'Flat (L x W): 230 cm x 210 cm\r\n-Material: Cotton\r\n-Includes: Number of Bedsheets: 1\r\n-Thread Count: 144\r\n-Color: Blue, Green, Orange, Dark Blue, Black, Brown', 311, 7, 6, '1-double-bedsheet-and-2-pillow-covers-1-28-flat-war-trade-original-imaheu7xhf3zkrhc.png', 'in stock', 2, NULL, '2025-10-07 01:49:38', '2025-10-31 06:06:16', 24, 0, 1, 'Homerica', 0),
(90, 'EXFAB Cotton King Fitted', 'Fitted (L x W x D):198 cm x 183 cm x 25 cm\r\n-Material: Cotton\r\n-Includes: Number of Bedsheets: 1\r\n-Thread Count: 244\r\n-Color: Beige', 265, 5, 6, '1-bedsheet-2-pillow-cover-1-1-bedsheet-2-pillow-cover-fitted-original-imah4qqvh6q8kdgh.png', 'in stock', 2, NULL, '2025-10-07 01:50:45', '2025-10-31 06:06:23', 25, 0, 2, 'Homerica', 0),
(91, 'Kreo Tundra laptop stand with cooler 5 Fan Ergonomic Cooling Pad with Adjustable Height', 'Adjustable Height\r\n-Size 17 inch\r\n-Ergonomic\r\n-Speakers: No\r\n-Number of Fans: 5', 1699, 5, 7, 'tundra-laptop-stand-with-cooler-kreo-original-imah7vthyrhzmtyf.png', 'in stock', 2, NULL, '2025-10-07 01:59:11', '2025-10-31 06:08:55', 31, 0, 2, 'ZEBRONICS', 0),
(92, 'Flipkart SmartBuy FKSBCPK17 2 Fan Ergonomic Cooling Pad with Adjustable Heigh', 'Adjustable Height\r\n-Size 15 inch\r\n-Ergonomic\r\n-Speakers: No\r\n-Number of Fans: 2', 599, 5, 7, 'fksbcpk17-flipkart-smartbuy-original-imagu3urygn4bz7k.png', 'in stock', 2, NULL, '2025-10-07 02:00:19', '2025-10-31 06:09:01', 31, 0, 3, 'ZEBRONICS', 0),
(93, 'SpinBot AirFlow X20', 'Adjustable Height\r\n-Size 17 inch\r\n-Ergonomic\r\n-Speakers: No\r\n-Number of Fans: 6', 1673, 2, 7, 'airflow-x20-6-fans-rgb-lights-6-speed-level-metal-body-spinbot-original-imahf9gqbhghsf8u.png', 'in stock', 2, NULL, '2025-10-07 02:01:30', '2025-10-31 06:09:05', 31, 0, 5, 'ZEBRONICS', 0),
(94, 'dowinx Multi Functional Ergonomic Gaming and Computer Chair', 'Massage Cushion\r\n-Footrest\r\n-Neck Pillow\r\n-PU Leather', 9999, 3, 7, '-original-imah933ezfggagpx.png', 'in stock', 2, NULL, '2025-10-07 02:03:14', '2025-10-31 06:09:36', 31, 0, 0, 'dowinx', 0),
(95, 'VICTORY T20 Synthetic Cricket Ball', 'Cricket Synthetic Ball\r\n-Weight: 125 g', 191, 10, 7, '125-t-20-synthetic-cricket-ball-wind-ball-for-cricket-tournament-original-imahfcczgeyh9csj.png', 'in stock', 2, NULL, '2025-10-07 02:04:51', '2025-10-31 06:09:47', 31, 0, 10, 'VICTORY', 0),
(96, 'PLEXX Plastic Bat full size', 'Age Group 15+ Yrs\r\n-Blade Made of PVC/Plastic\r\n-Beginner, Advanced, Intermediate, Recreational, Training Playing Level\r\n-Bat Grade: Grade 1\r\n-Sport Type: Cricket\r\n-Weight Range 850-900 g', 2000, 4, 7, '750-800-34-inch-premium-lightweight-hard-plastic-tennis-cricket-original-imahefykzf2d7hdd.png', 'in stock', 2, NULL, '2025-10-07 02:06:56', '2025-10-31 06:09:54', 26, 0, 3, 'PLEXX', 0),
(97, 'Strauss Slogge', 'Age Group 15+ Yrs\r\n-Blade Made of Kashmir Willow\r\n-Beginner, Intermediate, Training Playing Level\r\n-Bat Grade: Grade 1\r\n-Sport Type: Cricket\r\n-With Cover\r\n-Weight Range 1050-1200 g', 1399, 3, 7, '750-900-slogger-suitable-only-for-tennis-ball-size-4-4-st-4039-original-imah2fdktkjmsygk.png', 'in stock', 2, NULL, '2025-10-07 02:08:13', '2025-10-31 06:10:34', 26, 0, 3, 'Strauss', 0),
(98, 'KNK Hard 3 Piece Of Tennis Ball Cricket Kit', 'Age Group 15+ Yrs\r\n-Blade Made of PVC/Plastic\r\n-Advanced, Beginner, Intermediate, Recreational, Training Playing Level\r\n-Bat Grade: Grade 1+\r\n-Sport Type: Cricket\r\n-Weight Range 800-900 g g', 370, 4, 7, '800-34-inch-plastic-bat-plastic-bat-for-tennis-ball-cricket-original-imagrf8pmfj5p9ya.png', 'in stock', 2, NULL, '2025-10-07 02:09:46', '2025-10-07 02:09:46', 26, 0, 10, '', 0),
(99, 'HRSGS Hitman Hard Plastic Fiber Tennis Ball Cricket Ba', 'Age Group 15+ Yrs\r\n-Blade Made of PVC/Plastic\r\n-Intermediate Playing Level\r\n-Bat Grade: Grade 1\r\n-Sport Type: Cricket\r\n-Weight Range 800-850 kg', 500, 2, 7, '800-850-hitman-hard-plastic-fiber-tennis-ball-cricket-bat-for-original-imah4d6dzzafcsjx.png', 'in stock', 2, NULL, '2025-10-07 02:11:18', '2025-10-31 06:11:14', 26, 0, 21, 'MRF', 0),
(100, 'HRSGS Hitman Hard Plastic and Fiber Tennis Ball Cricket Bat', 'Age Group 15+ Yrs\r\n-Blade Made of PVC/Plastic\r\n-Intermediate Playing Level\r\n-Bat Grade: Grade 1\r\n-Sport Type: Cricket\r\n-Weight Range 800-850 g', 188, 4, 7, '800-850-hitman-hard-plastic-fiber-tennis-ball-cricket-bat-for-original-imah32z8fnx4zjhu.png', 'in stock', 2, NULL, '2025-10-07 02:12:18', '2025-10-31 06:11:22', 26, 0, 0, 'CEAT', 0),
(101, 'VICTORY SCREAM Plastic Bat Full Size Cricket Tennis Bat', 'Age Group 15+ Yrs\r\n-Blade Made of PVC/Plastic\r\n-Beginner Playing Level\r\n-Bat Grade: Grade 1+\r\n-Sport Type: Cricket\r\n-Weight Range 800 g', 236, 3, 7, '800-scream-plastic-bat-full-size-cricket-tennis-bat-for-all-age-original-imahyfqwukhc65h4.png', 'in stock', 2, NULL, '2025-10-07 02:13:24', '2025-10-31 06:11:34', 26, 0, 2, 'VICTORY', 0),
(102, 'Strauss Rebel Size SH Full Size', 'Age Group 15+ Yrs\r\n-Blade Made of PVC/Plastic\r\n-Beginner, Intermediate, Training Playing Level\r\n-Bat Grade: Grade 1\r\n-Sport Type: Cricket\r\n-Weight Range 850-900 g', 275, 5, 7, '850-900-rebel-size-sh-full-size-34-x-4-5-inch-for-all-age-groups-original-imah563yu8z6r3hh.png', 'in stock', 2, NULL, '2025-10-07 02:14:50', '2025-10-31 06:11:45', 26, 0, 9, 'Strauss', 0),
(103, 'KNK Heavy Duty Plastic Cricket Bat Kit Combo', 'Sport Type: Cricket\r\n-Ideal For: Boys, Girls, Men, Senior, Women\r\n-Color: Orange\r\n-Width: 12 cm, Height: 60 cm, Depth: 2 cm', 378, 4, 7, 'heavy-duty-plastic-cricket-bat-kit-combo-full-size-34-x-4-5-original-imagr7x4brdfh2hv.png', 'in stock', 2, NULL, '2025-10-07 02:15:58', '2025-10-31 06:11:54', 26, 0, 2, 'KNK', 0),
(104, 'HF Grand Edition VK 18 Limited Edition Cricket Kit', 'Sport Type: Cricket\r\n-Ideal For: Junior\r\n-Color: White, Red, Black\r\n-Width: 30 cm, Height: 65 cm, Depth: 10 cm', 2664, 4, 7, 'grand-edition-vk-18-limited-edition-564675467-30-hf-65-original-imah97vjns7kmrxu.png', 'in stock', 2, '2025-10-07 03:07:35', '2025-10-07 02:17:10', '2025-10-07 03:07:35', 26, 0, 6, '', 0),
(105, 'Celvas Back Cover for iPhone 16  (Blue, Flexible, Silicon, Pack of 1)', 'Suitable For: Mobile\r\n-Material: Silicon\r\n-Theme: Solid\r\n-Type: Back Cover', 1499, 10, 1, 'back-cover-for-iphone-16-blue.png', 'in stock', 2, NULL, '2025-10-29 06:57:29', '2025-10-31 03:31:54', 2, 0, 80, 'Celvas', 0),
(106, 'Casenew Back Cover for Iphone 11  (Transparent, Magsafe, Pack of 1)', 'Suitable For: Mobile\r\n-Material: Thermoplastic Polyurethane\r\n-Theme: No Theme\r\n-Type: Back Cover', 999, 15, 1, 'iphone-12-transperent.png', 'in stock', 2, NULL, '2025-10-29 06:58:45', '2025-10-31 03:32:05', 2, 0, 82, 'Casenew', 0),
(107, 'Fire Boltt Ninja Calling Pro Plus 46.5mm (1.83) Display Bluetooth, AI Voice Smartwatch  (Cinnamon Slate Strap, Free Size)', 'Bluetooth Calling Smartwatch - Make & Receive calls on the go through the watch\r\n-1.83 inch HD Display with 2.5D Curved Glass | 240*286 Pixel High Resolution\r\n-120 Sports Modes to Track with IP67 Water Resistant | Customised Wallpaper -Option | Match Your Daily Outfit with 100+ Cloud Faces\r\n-Smart Health Monitoring - Track SpO2, Heart Rate while your workout\r\n-Social App Notifications & Reminders - Never miss important calls and -updates,Remote control Camera & Player click numerous pictures on the go\r\n-With Call Function\r\n-Touchscreen\r\n-Health & Medical, Fitness & Outdoor\r\n-Battery Runtime: Upto 5 days', 9999, 9, 1, 'whatch1.png', 'in stock', 2, NULL, '2025-10-29 07:06:59', '2025-10-31 06:50:47', 3, 0, 90, 'FireBoltt', 0),
(108, 'GameSir Silver T800 Ultra Smartwatch Stainless Steel, BT Calling, Fitness  Music Smartwatch  (Silver Metal Strap, Free Size)', 'With Call Function\r\n-Touchscreen\r\n-Health & Medical, Fitness & Outdoor, Notifier, Watchphone, Safety & Security\r\n-Battery Runtime: Upto 5 days', 3999, 8, 1, 'whatch12.png', 'in stock', 2, NULL, '2025-10-29 07:09:07', '2025-10-31 03:32:48', 3, 0, 80, 'GameSir', 0),
(109, 'Samsung Galaxy Tab S9 FE 8 GB RAM 128 GB ROM 12.4 Inch with Wi Fi Only Tablet (Lavender)', '8 GB RAM | 128 GB ROM\r\n-31.5 cm (12.4 Inch) WQXGA Display\r\n-8.0 MP Primary Camera | 12 MP Front\r\n-Android 12 | Battery: 10090 mAH Lithium Ion\r\n-Ideal Usage: Entertainment, Gaming, Reading and Browsing, For Kids, Business\r\n-Processor: Exynos 1380', 59999, 6, 1, 'samsung01.png', 'in stock', 2, NULL, '2025-10-29 07:26:26', '2025-10-31 03:32:58', 6, 0, 47, 'Samsung', 0),
(110, 'REDMI Pad SE 8 GB RAM 128 GB ROM 11.0 inch with Wi Fi Only Tablet (Graphite Gray)', '8 GB RAM | 128 GB ROM | Expandable Upto 1 TB\r\n-27.94 cm (11.0 inch) Full HD Display\r\n-8.0 MP Primary Camera | 5 MP Front\r\n-Android 13 | Battery: 8000 mAh Lithium Ion\r\n-Ideal Usage: Entertainment\r\n-Processor: Snapdragon 680', 19999, 9, 1, 'ipad01.png', 'in stock', 2, NULL, '2025-10-29 07:27:57', '2025-10-31 03:33:39', 6, 0, 40, 'Redmi', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rating_product`
--

DROP TABLE IF EXISTS `rating_product`;
CREATE TABLE IF NOT EXISTS `rating_product` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `rate` int NOT NULL,
  `user_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rating_product_user_id_foreign` (`user_id`),
  KEY `rating_product_product_id_foreign` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rating_product`
--

INSERT INTO `rating_product` (`id`, `rate`, `user_id`, `product_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(38, 2, 4, 24, NULL, '2025-10-30 01:39:39', '2025-10-30 01:40:02'),
(2, 5, 3, 41, NULL, '2025-10-15 23:48:53', '2025-10-30 03:33:58'),
(3, 5, 9, 41, NULL, '2025-10-15 23:49:55', '2025-10-15 23:50:20'),
(4, 5, 10, 41, NULL, '2025-10-15 23:59:05', '2025-10-15 23:59:05'),
(5, 2, 11, 41, NULL, '2025-10-15 23:59:49', '2025-10-15 23:59:49'),
(6, 5, 12, 41, NULL, '2025-10-16 00:00:53', '2025-10-16 00:00:53'),
(7, 5, 12, 1, NULL, '2025-10-16 00:19:43', '2025-10-16 00:19:43'),
(8, 3, 4, 77, NULL, '2025-10-16 00:24:10', '2025-10-30 00:54:48'),
(9, 3, 4, 26, NULL, '2025-10-16 00:33:19', '2025-10-16 00:33:19'),
(10, 1, 4, 13, NULL, '2025-10-16 00:34:55', '2025-11-03 01:06:50'),
(37, 4, 4, 41, NULL, '2025-10-30 01:29:12', '2025-10-30 01:29:12'),
(18, 2, 4, 10, NULL, '2025-10-16 02:01:54', '2025-10-16 02:15:33'),
(13, 5, 4, 1, NULL, '2025-10-16 01:17:23', '2025-11-03 01:54:05'),
(14, 4, 4, 39, NULL, '2025-10-16 01:22:58', '2025-10-16 01:22:58'),
(36, 5, 4, 41, NULL, '2025-10-30 00:11:03', '2025-10-30 00:33:13'),
(16, 2, 4, 78, NULL, '2025-10-16 01:24:20', '2025-10-16 01:46:52'),
(33, 5, 4, 13, NULL, '2025-10-29 23:53:35', '2025-10-29 23:53:35'),
(19, 3, 4, 32, NULL, '2025-10-16 02:16:01', '2025-10-30 00:34:07'),
(20, 4, 4, 13, NULL, '2025-10-16 02:16:35', '2025-10-16 02:16:35'),
(21, 4, 4, 1, NULL, '2025-10-16 02:18:30', '2025-10-16 02:18:30'),
(22, 1, 4, 37, NULL, '2025-10-16 03:08:04', '2025-11-05 04:21:26'),
(23, 4, 4, 2, NULL, '2025-10-16 03:52:00', '2025-10-16 03:52:00'),
(41, 3, 4, 25, NULL, '2025-10-30 03:16:49', '2025-10-30 03:17:09'),
(25, 4, 3, 1, NULL, '2025-10-16 05:35:03', '2025-10-16 05:35:03'),
(26, 4, 3, 1, NULL, '2025-10-16 06:25:28', '2025-10-16 06:25:28'),
(27, 4, 3, 19, NULL, '2025-10-16 22:56:59', '2025-10-16 22:56:59'),
(40, 5, 4, 37, NULL, '2025-10-30 01:55:20', '2025-10-30 01:55:20'),
(29, 4, 4, 1, NULL, '2025-10-26 22:50:12', '2025-10-26 22:50:12'),
(30, 4, 4, 58, NULL, '2025-10-27 23:17:27', '2025-10-30 00:54:20'),
(39, 4, 4, 2, NULL, '2025-10-30 01:54:12', '2025-10-30 01:54:12'),
(42, 3, 4, 6, NULL, '2025-10-30 03:17:17', '2025-10-30 03:17:40'),
(43, 4, 4, 44, NULL, '2025-11-02 23:58:24', '2025-11-02 23:58:24'),
(44, 3, 4, 14, NULL, '2025-11-03 00:58:58', '2025-11-03 00:59:06'),
(45, 1, 4, 16, NULL, '2025-11-03 00:59:16', '2025-11-03 00:59:16'),
(46, 2, 4, 17, NULL, '2025-11-03 01:00:50', '2025-11-03 01:00:53'),
(47, 2, 4, 15, NULL, '2025-11-03 01:02:37', '2025-11-03 01:02:37'),
(48, 2, 4, 5, NULL, '2025-11-03 01:03:18', '2025-11-03 01:03:45'),
(49, 1, 4, 20, NULL, '2025-11-03 01:04:16', '2025-11-03 01:04:16'),
(50, 2, 4, 21, NULL, '2025-11-03 01:06:27', '2025-11-03 01:06:27'),
(51, 4, 4, 15, NULL, '2025-11-05 04:21:59', '2025-11-05 04:21:59');

-- --------------------------------------------------------

--
-- Table structure for table `subcatagory`
--

DROP TABLE IF EXISTS `subcatagory`;
CREATE TABLE IF NOT EXISTS `subcatagory` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catagroy_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subcatagory_catagroy_id_foreign` (`catagroy_id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcatagory`
--

INSERT INTO `subcatagory` (`id`, `name`, `catagroy_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mobile', 1, '2025-09-18 03:50:47', '2025-09-18 03:50:47', NULL),
(2, 'Mobile Accessories', 1, '2025-09-18 03:51:46', '2025-09-18 03:51:46', NULL),
(3, 'Smart Wearable', 1, '2025-09-18 03:52:48', '2025-09-18 03:52:48', NULL),
(4, 'Laptop', 1, '2025-09-18 03:53:06', '2025-09-18 03:53:06', NULL),
(5, 'Destop', 1, '2025-09-18 03:53:35', '2025-09-18 03:53:35', NULL),
(6, 'Tablet', 1, '2025-09-18 03:53:59', '2025-09-18 03:53:59', NULL),
(7, 'Speaker', 1, '2025-09-18 03:54:32', '2025-09-18 03:54:32', NULL),
(8, 'Camera', 1, '2025-09-18 03:54:40', '2025-09-18 03:54:40', NULL),
(9, 'Smart Ultra & HD', 2, '2025-09-18 03:56:00', '2025-09-18 03:56:00', NULL),
(10, 'Washing Machine', 2, '2025-09-18 03:57:27', '2025-09-18 03:57:27', NULL),
(11, 'Air Conditioners', 2, '2025-09-18 03:57:42', '2025-09-18 03:57:42', NULL),
(12, 'Refrigerators', 2, '2025-09-18 03:58:09', '2025-09-18 03:58:09', NULL),
(13, 'Kitchen Appliances', 2, '2025-09-18 03:58:32', '2025-09-18 03:58:32', NULL),
(14, 'Footwear', 3, '2025-09-18 03:59:30', '2025-09-18 03:59:30', NULL),
(16, 'Top wear', 3, '2025-09-18 04:00:13', '2025-09-18 04:00:13', NULL),
(17, 'Bottom wear', 3, '2025-09-18 04:00:27', '2025-09-18 04:00:27', NULL),
(18, 'Watche', 3, '2025-09-18 04:01:15', '2025-09-18 04:01:15', NULL),
(19, 'Women Western', 4, '2025-09-18 04:03:43', '2025-09-18 04:03:43', NULL),
(20, 'Watch', 4, '2025-09-18 04:04:03', '2025-09-18 04:04:03', NULL),
(21, 'Shoes', 4, '2025-09-18 04:04:13', '2025-09-18 04:04:13', NULL),
(22, 'Kitchen, Cookeware & Serveware', 6, '2025-09-18 04:06:18', '2025-09-18 04:06:18', NULL),
(23, 'Kitchen Storage', 6, '2025-09-18 04:06:51', '2025-09-18 04:06:51', NULL),
(24, 'Living Room Furniture', 6, '2025-09-18 04:07:09', '2025-09-18 04:07:09', NULL),
(25, 'Furnishing', 6, '2025-09-18 04:07:33', '2025-09-18 04:07:33', NULL),
(26, 'Sports', 7, '2025-09-18 04:08:17', '2025-09-18 04:08:17', NULL),
(27, 'Books', 7, '2025-09-18 04:08:31', '2025-09-18 04:08:31', NULL),
(28, 'Food Essentials', 7, '2025-09-18 04:09:40', '2025-09-18 04:09:40', NULL),
(29, 'Medical Supplies', 7, '2025-09-18 04:10:28', '2025-09-18 04:10:28', NULL),
(30, 'Music', 7, '2025-09-18 04:10:41', '2025-09-18 04:10:41', NULL),
(31, 'Gaming', 7, '2025-09-18 04:10:49', '2025-09-18 04:10:49', NULL),
(42, 'Customer02', 22, '2025-11-04 01:19:18', '2025-11-04 01:19:18', NULL),
(43, 'kuldeep', 22, '2025-11-04 01:19:28', '2025-11-04 01:19:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_coupun_data`
--

DROP TABLE IF EXISTS `user_coupun_data`;
CREATE TABLE IF NOT EXISTS `user_coupun_data` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `coupon_id` bigint NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_coupun_data_user_id_foreign` (`user_id`),
  KEY `user_coupun_data_product_id_foreign` (`product_id`),
  KEY `user_coupun_data_coupon_id_foreign` (`coupon_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_coupun_data`
--

INSERT INTO `user_coupun_data` (`id`, `user_id`, `product_id`, `coupon_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 4, 14, 2, '2025-09-24 00:59:51', '2025-09-24 00:34:23', '2025-09-24 00:59:51'),
(2, 4, 13, 1, '2025-09-24 00:59:38', '2025-09-24 00:35:46', '2025-09-24 00:59:38'),
(3, 4, 14, 1, '2025-09-24 01:00:05', '2025-09-24 00:59:59', '2025-09-24 01:00:05'),
(4, 4, 14, 1, '2025-09-24 01:24:57', '2025-09-24 01:00:32', '2025-09-24 01:24:57'),
(5, 4, 1, 1, '2025-09-24 01:25:28', '2025-09-24 01:25:18', '2025-09-24 01:25:28'),
(6, 4, 1, 1, '2025-09-24 01:26:56', '2025-09-24 01:25:30', '2025-09-24 01:26:56'),
(7, 4, 1, 2, '2025-09-24 01:27:02', '2025-09-24 01:26:59', '2025-09-24 01:27:02'),
(8, 4, 1, 1, '2025-09-24 03:17:14', '2025-09-24 01:27:04', '2025-09-24 03:17:14'),
(9, 4, 1, 1, '2025-09-24 03:17:14', '2025-09-24 03:10:28', '2025-09-24 03:17:14'),
(10, 4, 1, 1, '2025-09-24 03:17:14', '2025-09-24 03:10:35', '2025-09-24 03:17:14'),
(11, 4, 1, 2, '2025-09-24 03:17:14', '2025-09-24 03:11:08', '2025-09-24 03:17:14'),
(12, 4, 1, 1, '2025-09-24 03:17:14', '2025-09-24 03:12:32', '2025-09-24 03:17:14'),
(13, 4, 14, 1, '2025-09-24 04:07:45', '2025-09-24 03:17:28', '2025-09-24 04:07:45'),
(14, 4, 1, 1, '2025-09-24 04:16:57', '2025-09-24 03:18:34', '2025-09-24 04:16:57'),
(15, 4, 1, 1, '2025-09-24 05:03:34', '2025-09-24 04:25:18', '2025-09-24 05:03:34'),
(16, 4, 14, 3, '2025-09-24 06:16:52', '2025-09-24 04:27:26', '2025-09-24 06:16:52'),
(17, 4, 2, 3, '2025-09-29 01:56:22', '2025-09-24 05:01:05', '2025-09-29 01:56:22'),
(18, 4, 1, 1, '2025-09-24 05:13:10', '2025-09-24 05:04:32', '2025-09-24 05:13:10'),
(19, 4, 1, 1, '2025-09-24 06:43:11', '2025-09-24 05:33:31', '2025-09-24 06:43:11'),
(20, 4, 27, 1, '2025-09-25 01:29:47', '2025-09-25 01:19:16', '2025-09-25 01:29:47'),
(21, 4, 15, 1, '2025-10-16 03:17:55', '2025-10-16 03:17:19', '2025-10-16 03:17:55'),
(22, 4, 1, 1, NULL, '2025-11-05 04:19:30', '2025-11-05 04:19:30');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
