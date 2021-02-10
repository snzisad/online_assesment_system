-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 24, 2020 at 05:37 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nrb`
--

-- --------------------------------------------------------

--
-- Table structure for table `easy_merchants`
--

DROP TABLE IF EXISTS `easy_merchants`;
CREATE TABLE IF NOT EXISTS `easy_merchants` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `bank_customer_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_customer_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_number_masked` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_number_enc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commission_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transaction_profile_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 for Inactive, 1 for Active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `easy_merchants_mobile_number_unique` (`mobile_number`),
  UNIQUE KEY `easy_merchants_account_number_unique` (`account_number`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `easy_merchants`
--

INSERT INTO `easy_merchants` (`id`, `merchant_id`, `name`, `mobile_number`, `account_number`, `dob`, `bank_customer_id`, `card_customer_id`, `card_number_masked`, `card_number_enc`, `commission_id`, `transaction_profile_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'MALAI JOTI ADHIKARY', '01717219723', '1011110105099', '1990-04-29', '0091453', NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-12-20 12:17:30', '2020-12-20 12:17:30');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
