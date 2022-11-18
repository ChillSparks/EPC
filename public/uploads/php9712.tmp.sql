-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2019 at 06:53 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lararole_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkeds`
--

CREATE TABLE `checkeds` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `des` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `name`, `des`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, '$', 'US Dollar', 'JohnSmith', 'JohnSmith', '2019-09-23 02:22:20', '2019-09-23 02:59:48'),
(3, '&euro;', 'Euro', 'JohnSmith', 'JohnSmith', '2019-09-23 02:22:47', '2019-09-23 03:11:17');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `des` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `des`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Thaninthayi', 'Region', 'JohnSmith', 'JohnSmith', '2019-08-21 23:58:31', '2019-08-21 23:58:31'),
(2, 'MoN', 'State', 'JohnSmith', 'JohnSmith', '2019-08-21 23:58:40', '2019-09-16 00:46:55'),
(3, 'Yangon', 'Region', 'JohnSmith', 'JohnSmith', '2019-08-21 23:58:50', '2019-08-21 23:58:50'),
(4, 'Ayeyarwaddy', 'divison', 'JohnSmith', 'JohnSmith', '2019-08-21 23:59:02', '2019-08-21 23:59:02'),
(11, 'Shan', 'State', 'JohnSmith', 'JohnSmith', '2019-08-22 00:00:11', '2019-08-22 00:00:11'),
(12, 'Sagaing', 'State', 'JohnSmith', 'JohnSmith', '2019-08-22 00:00:22', '2019-08-22 00:00:22'),
(13, 'Chin', 'State', 'JohnSmith', 'JohnSmith', '2019-08-22 00:00:31', '2019-08-22 00:00:31'),
(14, 'Kachin', 'State', 'JohnSmith', 'JohnSmith', '2019-08-22 00:00:40', '2019-08-22 00:00:40'),
(22, '4567890-', 'Zxcvhjk', 'JohnSmith', 'JohnSmith', '2019-09-22 21:54:50', '2019-09-22 21:54:50');

-- --------------------------------------------------------

--
-- Table structure for table `do_items`
--

CREATE TABLE `do_items` (
  `id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `received_flag` tinyint(1) NOT NULL DEFAULT 0,
  `item_name` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `qty` decimal(8,3) NOT NULL,
  `price` decimal(10,3) NOT NULL,
  `amt` decimal(12,3) NOT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `mfg_country` varchar(255) DEFAULT NULL,
  `mfg_company` varchar(255) DEFAULT NULL,
  `mfg_date` date DEFAULT NULL,
  `manual_orignal_filename` varchar(255) DEFAULT NULL,
  `manual_filename` varchar(255) DEFAULT NULL,
  `item_remark` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_07_12_145959_create_permission_tables', 1),
(4, '2019_08_15_054050_create_p_o_contracts_table', 1),
(5, '2019_08_15_055520_create_d_o_items_table', 1),
(6, '2019_08_19_103201_create_suppliers_table', 1),
(7, '2019_08_20_070931_create_units_table', 1),
(8, '2019_08_20_073630_create_divisions_table', 1),
(9, '2019_08_20_073821_create_townships_table', 1),
(10, '2019_08_26_052806_create_checkeds_table', 2),
(11, '2019_08_28_034748_create_p_o_received_detailails_table', 2),
(12, '2019_09_05_110703_create_stores_table', 3),
(13, '2019_09_23_070837_create_currency_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_id`, `model_type`) VALUES
(1, 1, 'App\\User'),
(2, 2, 'App\\User'),
(3, 5, 'App\\User');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `des` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `des`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'users_manage', 'Create User / Edit User / Delete User', 'web', '2019-08-21 01:38:43', '2019-09-04 20:51:53'),
(2, 'pocontract_manage', 'Create PO Contract/ Edit   PO Contract/ Delete PO Contract', 'web', '2019-08-21 01:38:43', '2019-09-04 20:52:21'),
(3, 'setting_manage', 'Create, Edit and Delete of  Suppliers, Units and regions', 'web', '2019-08-21 01:38:43', '2019-09-04 20:53:51'),
(5, 'checking_manage', 'Create, Edit and Delete Checking Form', 'web', '2019-08-25 23:10:21', '2019-09-04 20:56:08'),
(6, 'checker', 'check the quality of items', 'web', '2019-08-29 23:10:50', '2019-09-04 20:56:57'),
(7, 'approved_level_1', 'Approve  Checking Form/ Issue Form  Upper Level', 'web', '2019-08-29 23:11:03', '2019-09-04 20:58:16'),
(8, 'approved_level_2', 'Approved Checking Form/ Issue Form  Mid Level', 'web', '2019-08-29 23:11:13', '2019-09-04 20:58:34'),
(9, 'create_checking_form', 'Under the Checking Management', 'web', '2019-08-29 23:25:27', '2019-09-04 20:59:16'),
(10, 'to_check', 'Under the Checking Management ( for Checker)', 'web', '2019-08-29 23:26:02', '2019-09-04 20:59:41'),
(13, 'check_completed', 'Check and approve Completed!', 'web', '2019-09-04 21:01:13', '2019-09-04 21:01:13'),
(14, 'store_manage', 'search item in store', 'web', '2019-09-06 08:27:14', '2019-09-06 08:27:14');

-- --------------------------------------------------------

--
-- Table structure for table `po_contracts`
--

CREATE TABLE `po_contracts` (
  `id` int(11) NOT NULL,
  `po_no` varchar(255) NOT NULL,
  `po_date` date NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `do_no` varchar(255) NOT NULL,
  `do_date` date NOT NULL,
  `remark` text DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `po_received`
--

CREATE TABLE `po_received` (
  `id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `chk_place` varchar(255) NOT NULL,
  `chk_date` date NOT NULL,
  `vehicle_name` varchar(255) DEFAULT NULL,
  `chk_remark` text DEFAULT NULL,
  `net_amt` decimal(12,3) DEFAULT NULL,
  `rev_amt` decimal(12,3) DEFAULT NULL,
  `red_amt` decimal(12,3) DEFAULT NULL,
  `excess_amt` decimal(12,3) DEFAULT NULL,
  `damage_amt` decimal(12,3) DEFAULT NULL,
  `chk_box_no` decimal(12,3) DEFAULT NULL,
  `checker` tinyint(1) DEFAULT 0,
  `approved_level_1` tinyint(1) DEFAULT 0,
  `approved_level_2` tinyint(1) DEFAULT 0,
  `done` tinyint(1) DEFAULT 0,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `po_received_details`
--

CREATE TABLE `po_received_details` (
  `id` int(11) NOT NULL,
  `do_id` int(11) NOT NULL,
  `po_received_id` int(11) NOT NULL,
  `po_received_po_id` int(11) NOT NULL,
  `store_flag` tinyint(4) NOT NULL DEFAULT 0,
  `item_name` varchar(255) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `qty` decimal(8,3) NOT NULL,
  `r_qty` decimal(8,3) DEFAULT NULL,
  `price` decimal(10,3) NOT NULL,
  `amt` decimal(12,3) NOT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `mfg_country` varchar(255) DEFAULT NULL,
  `mfg_company` varchar(255) DEFAULT NULL,
  `mfg_date` date DEFAULT NULL,
  `manual_orignal_filename` varchar(255) DEFAULT NULL,
  `manual_filename` varchar(255) DEFAULT NULL,
  `item_remark` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'web', '2019-08-21 01:38:43', '2019-08-21 01:38:43'),
(2, 'user', 'web', '2019-08-21 01:38:43', '2019-08-21 01:38:43'),
(3, 'Items Checker', 'web', '2019-08-30 22:54:28', '2019-08-30 23:04:58');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(2, 2),
(3, 1),
(5, 1),
(5, 3),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(13, 1),
(14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock_issue`
--

CREATE TABLE `stock_issue` (
  `id` int(11) NOT NULL,
  `req_voucher_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `req_date` date NOT NULL,
  `issue_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issue_date` date NOT NULL,
  `to_dept` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `township` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issue_flag` tinyint(4) NOT NULL DEFAULT 0,
  `approved_level_2` tinyint(4) NOT NULL DEFAULT 0,
  `approved_level_1` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_issue_details`
--

CREATE TABLE `stock_issue_details` (
  `id` int(11) NOT NULL,
  `stock_issue_id` int(11) NOT NULL,
  `stock_code` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `qty` decimal(8,3) NOT NULL,
  `price` decimal(10,3) NOT NULL,
  `amt` decimal(12,3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock_request`
--

CREATE TABLE `stock_request` (
  `id` int(11) NOT NULL,
  `voucher_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `l_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `confirm_date` date NOT NULL,
  `dept_biz_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `township` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_level_2` tinyint(4) NOT NULL DEFAULT 0,
  `approved_level_1` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_request_details`
--

CREATE TABLE `stock_request_details` (
  `id` int(11) NOT NULL,
  `stock_request_id` int(11) NOT NULL,
  `stock_code` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `qty` decimal(8,3) NOT NULL,
  `price` decimal(10,3) NOT NULL,
  `amt` decimal(12,3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id` int(11) NOT NULL,
  `po_received_id` int(11) NOT NULL,
  `po_received_po_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `store_code` varchar(255) NOT NULL,
  `warehouse` varchar(255) NOT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `qty` decimal(8,3) DEFAULT NULL,
  `r_qty` decimal(8,3) DEFAULT NULL,
  `price` decimal(10,3) DEFAULT NULL,
  `amt` decimal(12,3) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `mfg_country` varchar(255) DEFAULT NULL,
  `mfg_company` varchar(255) DEFAULT NULL,
  `mfg_date` date DEFAULT NULL,
  `manual_original_filename` varchar(255) DEFAULT NULL,
  `manual_filename` varchar(255) DEFAULT NULL,
  `item_remark` text DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `des` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `des`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Hubly Electricity Supply Company', 'india', 'JohnSmith', 'JohnSmith', '2019-08-21 23:33:18', '2019-09-16 00:46:15'),
(2, 'Kerala State Electricity Board', 'India', 'JohnSmith', 'JohnSmith', '2019-08-21 23:33:32', '2019-08-21 23:33:32'),
(3, 'Madhya Pradesh Power Generation Company Limited', 'india', 'JohnSmith', 'JohnSmith', '2019-08-21 23:33:43', '2019-08-21 23:33:43');

-- --------------------------------------------------------

--
-- Table structure for table `townships`
--

CREATE TABLE `townships` (
  `id` int(10) UNSIGNED NOT NULL,
  `division_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `des` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `townships`
--

INSERT INTO `townships` (`id`, `division_id`, `name`, `des`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, 1, 'Kawa', 'TownshiP', 'JohnSmith', 'JohnSmith', '2019-08-22 00:17:03', '2019-09-16 00:47:16');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `des` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `des`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'nos', 'nos', 'JohnSmith', 'JohnSmith', '2019-08-24 01:26:49', '2019-08-24 01:26:49'),
(2, 'book', 'book', 'JohnSmith', 'JohnSmith', '2019-08-24 01:26:54', '2019-08-24 01:26:54'),
(3, 'meter', 'meter', 'JohnSmith', 'JohnSmith', '2019-08-24 01:27:00', '2019-08-24 01:27:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'JohnSmith', 'admin@admin.com', '$2y$10$7X/ofla5b8gkQUWOsvgQ7eJOFYcN6elaZNF524qjsPCGVlOTXeVum', 'LZOdtSKmoMatuXs5bNWdzBx6dk612cRE9pUidBSVAbGe1oEFan8KRVdLkTD3', '2019-08-21 01:38:43', '2019-08-21 01:38:43'),
(2, 'Marry Jone', 'user@user.com', '$2y$10$..2xglL/oC7cEGWecLxtZu9yDhLH4Ntu/qPBR/C4ZuNn2zGffcHe2', NULL, '2019-08-21 01:38:43', '2019-08-21 01:38:43'),
(5, 'U aung soe moe', 'aungsoemoe@gmail.com', '$2y$10$JG22VopieDyk/kgLsOw1Ve5CzpPkh6O84CWXMO/aHuIhhYS687Z5u', NULL, '2019-08-30 22:57:58', '2019-08-30 22:57:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkeds`
--
ALTER TABLE `checkeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `do_items`
--
ALTER TABLE `do_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po_contracts`
--
ALTER TABLE `po_contracts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po_received`
--
ALTER TABLE `po_received`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po_received_details`
--
ALTER TABLE `po_received_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `stock_issue`
--
ALTER TABLE `stock_issue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_issue_details`
--
ALTER TABLE `stock_issue_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_request`
--
ALTER TABLE `stock_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_request_details`
--
ALTER TABLE `stock_request_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `townships`
--
ALTER TABLE `townships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `townships_division_id_foreign` (`division_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkeds`
--
ALTER TABLE `checkeds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `do_items`
--
ALTER TABLE `do_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `po_contracts`
--
ALTER TABLE `po_contracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `po_received`
--
ALTER TABLE `po_received`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `po_received_details`
--
ALTER TABLE `po_received_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stock_issue`
--
ALTER TABLE `stock_issue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_issue_details`
--
ALTER TABLE `stock_issue_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_request`
--
ALTER TABLE `stock_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_request_details`
--
ALTER TABLE `stock_request_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `townships`
--
ALTER TABLE `townships`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `townships`
--
ALTER TABLE `townships`
  ADD CONSTRAINT `townships_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
