-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2019 at 08:11 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bangladesh_betar_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `acc_chart_of_accounts`
--

CREATE TABLE `acc_chart_of_accounts` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `parent_id` int(11) UNSIGNED DEFAULT NULL,
  `details` varchar(100) NOT NULL DEFAULT '',
  `code` int(11) UNSIGNED NOT NULL,
  `type_id` int(11) UNSIGNED DEFAULT NULL COMMENT 'meaning type of chart ids, Like income, expense, asset , liabilities &amp; equity 1 = asset, 3 = income, 4 = Expense',
  `head_type` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '0 = Main, 1 = User Generated, 2 = System Generated',
  `opt_type` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Operation Type. 1 = Credit, 2 = Debit',
  `vat_type` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0 = No Vat, 1 = Vat Exclude, 2 = Vat Include',
  `adjustment_group` tinyint(1) UNSIGNED DEFAULT '0' COMMENT 'To handle show hide from adjustment entry panel. 0 = False, 1 = True',
  `branch_id` smallint(6) UNSIGNED DEFAULT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '0 = delete, 1 = active, 3 = inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acc_chart_of_accounts`
--

INSERT INTO `acc_chart_of_accounts` (`id`, `name`, `parent_id`, `details`, `code`, `type_id`, `head_type`, `opt_type`, `vat_type`, `adjustment_group`, `branch_id`, `created_time`, `updated_at`, `created_at`, `is_active`) VALUES
(1, 'Asset', NULL, '', 10000000, 1, 0, 1, 0, 0, NULL, '2018-11-01 15:27:05', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, 'Current Asset', 1, '', 10100000, 1, 1, 1, 0, 0, NULL, '2018-11-01 15:28:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(3, 'Fixed Asset', 1, '', 10200000, 1, 1, 1, 0, 0, NULL, '2018-11-01 15:28:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(4, 'Bank Group', 2, '', 10101000, 1, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(5, 'Cash & cash Equivalent', 2, '', 10102000, 1, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(6, 'Main Cash', 5, '', 10102001, 1, 2, 1, 0, 0, NULL, '2018-11-01 15:34:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(7, 'IFIC BANK', 4, '', 10101001, 1, 2, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(8, 'Income', NULL, '', 30000000, 3, 0, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(9, 'Direct Income', 8, '', 30100000, 3, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(10, 'Indirect Income', 8, '', 30200000, 3, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(20, 'Expense', NULL, '', 40000000, 3, 0, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(26, 'অন্যান্য ব্যয়', 20, '', 40106000, 4, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(102, 'Ashim Gharami', 4, 'Customer Group', 10101051, 1, 1, 1, 0, 0, NULL, '2019-01-08 14:54:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(114, 'Account Receiveable', 2, '', 10103000, 1, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(127, NULL, 114, 'Employee Group', 10103013, 1, 2, 1, 0, 0, NULL, '2019-02-19 11:36:31', '2019-02-19 11:36:31', '2019-02-19 11:36:31', 1),
(128, NULL, 114, 'Employee Group', 10103002, 1, 2, 1, 0, 0, NULL, '2019-02-19 11:38:01', '2019-02-19 11:38:01', '2019-02-19 11:38:01', 1),
(129, NULL, 114, 'Employee Group', 10103003, 1, 2, 1, 0, 0, NULL, '2019-02-19 12:39:40', '2019-02-19 12:39:40', '2019-02-19 12:39:40', 1),
(130, NULL, 114, 'Employee Group', 10103004, 1, 2, 1, 0, 0, NULL, '2019-02-19 12:39:47', '2019-02-19 12:39:47', '2019-02-19 12:39:47', 1),
(131, NULL, 114, 'Employee Group', 10103005, 1, 2, 1, 0, 0, NULL, '2019-02-19 12:40:21', '2019-02-19 12:40:21', '2019-02-19 12:40:21', 1),
(132, NULL, 114, 'Employee Group', 10103006, 1, 2, 1, 0, 0, NULL, '2019-02-19 12:40:28', '2019-02-19 12:40:28', '2019-02-19 12:40:28', 1),
(133, NULL, 114, 'Employee Group', 10103007, 1, 2, 1, 0, 0, NULL, '2019-02-19 12:40:39', '2019-02-19 12:40:39', '2019-02-19 12:40:39', 1),
(134, NULL, 114, 'Employee Group', 10103008, 1, 2, 1, 0, 0, NULL, '2019-02-19 12:44:05', '2019-02-19 12:44:05', '2019-02-19 12:44:05', 1),
(135, NULL, 114, 'Employee Group', 10103009, 1, 2, 1, 0, 0, NULL, '2019-02-19 13:03:05', '2019-02-19 13:03:05', '2019-02-19 13:03:05', 1),
(136, NULL, 114, 'Employee Group', 10103010, 1, 2, 1, 0, 0, NULL, '2019-02-19 13:04:10', '2019-02-19 13:04:10', '2019-02-19 13:04:10', 1),
(137, NULL, 114, 'Employee Group', 10103011, 1, 2, 1, 0, 0, NULL, '2019-02-19 13:05:07', '2019-02-19 13:05:07', '2019-02-19 13:05:07', 1),
(138, NULL, 114, 'Employee Group', 10103012, 1, 2, 1, 0, 0, NULL, '2019-02-19 13:05:25', '2019-02-19 13:05:25', '2019-02-19 13:05:25', 1),
(139, NULL, 114, 'Employee Group', 10103013, 1, 2, 1, 0, 0, NULL, '2019-02-19 13:06:15', '2019-02-19 13:06:15', '2019-02-19 13:06:15', 1),
(140, NULL, 114, 'Employee Group', 10103014, 1, 2, 1, 0, 0, NULL, '2019-02-19 13:07:36', '2019-02-19 13:07:36', '2019-02-19 13:07:36', 1),
(141, NULL, 114, 'Employee Group', 10103015, 1, 2, 1, 0, 0, NULL, '2019-02-19 13:08:10', '2019-02-19 13:08:10', '2019-02-19 13:08:10', 1),
(142, NULL, 114, 'Employee Group', 10103016, 1, 2, 1, 0, 0, NULL, '2019-02-19 13:50:48', '2019-02-19 13:50:48', '2019-02-19 13:50:48', 1),
(144, NULL, 114, 'Employee Group', 10103017, 1, 2, 1, 0, 0, NULL, '2019-03-01 04:16:17', '2019-03-01 04:16:17', '2019-03-01 04:16:17', 1),
(168, NULL, 114, 'Employee Group', 10103018, 1, 2, 1, 0, 0, NULL, '2019-03-01 04:30:15', '2019-03-01 04:30:15', '2019-03-01 04:30:15', 1),
(169, NULL, 114, 'Employee Group', 10103019, 1, 2, 1, 0, 0, NULL, '2019-03-01 04:32:10', '2019-03-01 04:32:10', '2019-03-01 04:32:10', 1),
(171, NULL, 114, 'Employee Group', 10103020, 1, 2, 1, 0, 0, NULL, '2019-03-29 04:36:22', '2019-03-29 04:36:22', '2019-03-29 04:36:22', 1),
(172, NULL, 114, 'Employee Group', 10103021, 1, 2, 1, 0, 0, NULL, '2019-04-06 22:57:50', '2019-04-06 22:57:50', '2019-04-06 22:57:50', 1),
(173, NULL, 114, 'Employee Group', 10103022, 1, 2, 1, 0, 0, NULL, '2019-06-23 20:51:42', '2019-06-23 20:51:42', '2019-06-23 20:51:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `all_sttings`
--

CREATE TABLE `all_sttings` (
  `id` int(11) UNSIGNED NOT NULL,
  `type` tinyint(4) UNSIGNED DEFAULT NULL COMMENT '1= Department, 2= Designation, 3 = Degree, 4 = Nationality , 5 = leave category, 6 = Program Ctg, 7 = Deduction Ctg, 8 = Earning Ctg, 9 = Bank Information, 10 = Product Unit, 11 = Product Ctg, 12 = Product Sub Ctg,13 = cadre ctg',
  `is_default` tinyint(1) UNSIGNED DEFAULT NULL,
  `title` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbreviation` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) UNSIGNED DEFAULT NULL,
  `leave_balance` tinyint(3) UNSIGNED DEFAULT NULL,
  `has_leave_limit` tinyint(4) DEFAULT NULL COMMENT '1 = yes, other wise no limit',
  `is_active` tinyint(4) UNSIGNED NOT NULL DEFAULT '1' COMMENT ' 0= delete, 1= active,  2= inactive',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `all_sttings`
--

INSERT INTO `all_sttings` (`id`, `type`, `is_default`, `title`, `abbreviation`, `parent_id`, `leave_balance`, `has_leave_limit`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, 'S.S.C', NULL, NULL, NULL, NULL, 1, NULL, '2019-02-14 07:32:33', NULL),
(2, 3, NULL, 'H.S.C', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2019-02-28 13:37:11'),
(3, 5, 1, 'Sick Leave', NULL, NULL, 10, 1, 1, NULL, NULL, NULL),
(4, 5, 1, 'Casual Leave', NULL, NULL, 5, 1, 1, NULL, NULL, NULL),
(5, 5, NULL, 'Hello', NULL, NULL, NULL, NULL, 0, NULL, '2019-02-28 11:25:58', '2019-02-28 12:00:02'),
(6, 5, NULL, 'asdf', NULL, NULL, NULL, NULL, 0, NULL, '2019-02-28 12:23:26', '2019-02-28 12:32:28'),
(7, 5, NULL, 'Marternity Leave', NULL, NULL, 0, NULL, 1, NULL, '2019-02-28 12:37:27', '2019-03-02 05:19:59'),
(8, 5, NULL, 'Leave Without Pay', NULL, NULL, NULL, NULL, 1, NULL, '2019-02-28 12:52:17', '2019-03-02 05:20:13'),
(9, 1, NULL, 'IT DEPT', NULL, NULL, NULL, NULL, 1, NULL, '2019-02-28 12:59:31', '2019-05-14 07:26:23'),
(10, 1, NULL, 'HR DEPT', NULL, NULL, NULL, NULL, 1, NULL, '2019-02-28 12:59:58', '2019-05-14 07:26:35'),
(11, 1, NULL, 'Management', NULL, NULL, NULL, NULL, 1, NULL, '2019-02-28 13:04:00', '2019-03-01 00:58:54'),
(12, 2, NULL, 'General Manager 3', NULL, NULL, NULL, NULL, 1, NULL, '2019-02-28 13:04:37', '2019-02-28 13:08:25'),
(13, 4, NULL, 'Bangladeshi', NULL, NULL, NULL, NULL, 1, NULL, '2019-02-28 13:15:49', '2019-02-28 13:15:49'),
(14, 6, NULL, 'রবীন্দ্র সংগীত', NULL, NULL, NULL, NULL, 1, NULL, '2019-02-28 13:40:59', '2019-03-02 12:31:31'),
(15, 7, 1, 'PF', NULL, NULL, NULL, NULL, 1, NULL, '2019-02-28 13:49:54', '2019-04-01 03:21:10'),
(16, 8, 1, 'Basic Salary', NULL, 1, NULL, NULL, 1, NULL, '2019-02-28 13:52:20', '2019-04-01 03:19:32'),
(17, 9, NULL, 'Sonali Bank', NULL, NULL, NULL, NULL, 1, NULL, '2019-03-01 00:57:03', '2019-03-01 03:45:00'),
(18, 5, NULL, 'Leave With Pay', NULL, NULL, NULL, NULL, 1, NULL, '2019-03-02 05:20:23', '2019-03-02 05:20:23'),
(19, 5, NULL, 'Special Leave', NULL, NULL, NULL, NULL, 1, NULL, '2019-03-02 05:20:35', '2019-03-02 05:20:35'),
(20, 6, NULL, 'পল্লীগীতি', NULL, NULL, NULL, NULL, 1, NULL, '2019-03-02 12:31:58', '2019-03-02 12:31:58'),
(21, 10, NULL, 'PIece', NULL, NULL, NULL, NULL, 1, NULL, '2019-03-23 08:08:50', '2019-03-23 08:09:05'),
(22, 10, NULL, 'KG', NULL, NULL, NULL, NULL, 1, NULL, '2019-03-23 08:09:21', '2019-03-23 08:09:21'),
(23, 11, NULL, 'Machineries', NULL, NULL, NULL, NULL, 1, NULL, '2019-03-23 10:18:49', '2019-04-13 22:01:18'),
(24, 12, NULL, 'Scaner', NULL, 54, NULL, NULL, 1, NULL, '2019-03-23 10:56:52', '2019-04-13 22:04:41'),
(25, 12, NULL, 'Printer', NULL, 54, NULL, NULL, 1, NULL, '2019-03-23 10:57:31', '2019-04-13 22:04:06'),
(26, 12, NULL, 'Fax', NULL, 54, NULL, NULL, 1, NULL, '2019-03-23 10:58:43', '2019-04-13 22:03:49'),
(27, 12, NULL, 'Computer', NULL, 54, NULL, NULL, 1, NULL, '2019-03-23 11:03:55', '2019-04-13 22:03:32'),
(28, 13, NULL, 'BCS (Administration)', NULL, NULL, NULL, NULL, 1, NULL, '2019-03-23 11:03:55', '2019-03-23 11:03:55'),
(29, 13, NULL, 'BCS (Foreign Affairs)', NULL, NULL, NULL, NULL, 1, NULL, '2019-03-23 11:03:55', '2019-03-23 11:03:55'),
(30, 13, NULL, 'BCS (Taxation)', NULL, NULL, NULL, NULL, 1, NULL, '2019-03-23 11:03:55', '2019-03-23 11:03:55'),
(31, 13, NULL, 'BCS (Police)', NULL, NULL, NULL, NULL, 1, NULL, '2019-03-23 11:03:55', '2019-03-23 11:03:55'),
(32, 13, NULL, 'BCS (Audit & Accounts)', NULL, NULL, NULL, NULL, 1, NULL, '2019-03-23 11:03:55', '2019-03-23 11:03:55'),
(33, 13, NULL, 'BCS (Customs & Excise)', NULL, NULL, NULL, NULL, 1, NULL, '2019-03-23 11:03:55', '2019-03-23 11:03:55'),
(34, 13, NULL, 'BCS (Cooperatives)', NULL, NULL, NULL, NULL, 1, NULL, '2019-03-23 11:03:55', '2019-03-23 11:03:55'),
(35, 13, NULL, 'BCS (Economic)', NULL, NULL, NULL, NULL, 1, NULL, '2019-03-23 11:03:55', '2019-03-23 11:03:55'),
(36, 13, NULL, ' BCS (Food)', NULL, NULL, NULL, NULL, 1, NULL, '2019-03-23 11:03:55', '2019-03-23 11:03:55'),
(37, 13, NULL, 'BCS (Information)', NULL, NULL, NULL, NULL, 1, NULL, '2019-03-23 11:03:55', '2019-03-23 11:03:55'),
(38, 13, NULL, 'BCS (Family Planning)', NULL, NULL, NULL, NULL, 1, NULL, '2019-03-23 11:03:55', '2019-03-23 11:03:55'),
(39, 13, NULL, 'BCS (Postal)', NULL, NULL, NULL, NULL, 1, NULL, '2019-03-23 11:03:55', '2019-03-23 11:03:55'),
(40, 13, NULL, 'BCS (Railway Transportation & Commercial)', NULL, NULL, NULL, NULL, 1, NULL, '2019-03-23 11:03:55', '2019-03-23 11:03:55'),
(41, 13, NULL, 'BCS (Ansar)', NULL, NULL, NULL, NULL, 1, NULL, '2019-03-23 11:03:55', '2019-03-23 11:03:55'),
(42, 13, NULL, 'BCS (Trade)', NULL, NULL, NULL, NULL, 1, NULL, '2019-03-23 11:03:55', '2019-03-23 11:03:55'),
(43, 8, 1, 'House Rent', NULL, 1, NULL, NULL, 1, NULL, '2019-04-01 03:19:44', '2019-04-01 03:19:44'),
(44, 8, 1, 'Medical', NULL, 1, NULL, NULL, 1, NULL, '2019-04-01 03:19:55', '2019-04-01 03:19:55'),
(45, 8, 1, 'Allowance', NULL, 1, NULL, NULL, 1, NULL, '2019-04-01 03:20:21', '2019-04-01 03:20:21'),
(46, 8, NULL, 'TA', NULL, 1, NULL, NULL, 1, NULL, '2019-04-01 03:20:32', '2019-04-01 03:20:32'),
(47, 8, NULL, 'DA', NULL, NULL, NULL, NULL, 1, NULL, '2019-04-01 03:20:38', '2019-04-06 02:47:30'),
(48, 7, NULL, 'Loan', NULL, 1, NULL, NULL, 1, NULL, '2019-04-01 03:21:21', '2019-04-01 03:21:21'),
(49, 7, 1, 'Advance Income Tax deduction', NULL, 1, NULL, NULL, 1, NULL, '2019-04-01 03:24:44', '2019-04-01 03:24:44'),
(50, 7, 1, 'Health Insurance Premium', NULL, 1, NULL, NULL, 1, NULL, '2019-04-01 03:30:09', '2019-04-01 03:30:09'),
(51, 11, NULL, 'Equipment', NULL, NULL, NULL, NULL, 1, NULL, '2019-04-13 22:01:39', '2019-04-13 22:01:39'),
(52, 11, NULL, 'Accessories', NULL, NULL, NULL, NULL, 1, NULL, '2019-04-13 22:02:10', '2019-04-13 22:02:10'),
(53, 11, NULL, 'Furniture', NULL, NULL, NULL, NULL, 1, NULL, '2019-04-13 22:02:50', '2019-04-13 22:02:50'),
(54, 11, NULL, 'Office Equipment', NULL, NULL, NULL, NULL, 1, NULL, '2019-04-13 22:03:07', '2019-04-13 22:03:07'),
(55, 12, NULL, 'Photocopier', NULL, 54, NULL, NULL, 1, NULL, '2019-04-13 22:05:02', '2019-04-13 22:05:02'),
(56, 10, NULL, 'Dozen', NULL, NULL, NULL, NULL, 1, NULL, '2019-04-13 22:05:57', '2019-04-13 22:10:03'),
(57, 12, NULL, 'Chair', NULL, 53, NULL, NULL, 1, NULL, '2019-04-24 05:20:27', '2019-04-24 05:20:27'),
(58, 12, NULL, 'Table', NULL, 53, NULL, NULL, 1, NULL, '2019-04-24 05:20:38', '2019-04-24 05:20:38'),
(59, 2, NULL, 'Officer', NULL, NULL, NULL, NULL, 1, NULL, '2019-04-25 03:40:18', '2019-04-25 03:40:18');

-- --------------------------------------------------------

--
-- Table structure for table `branch_infos`
--

CREATE TABLE `branch_infos` (
  `id` mediumint(6) UNSIGNED NOT NULL,
  `name` varchar(70) NOT NULL,
  `abbreviation` varchar(30) DEFAULT NULL,
  `mobile` varchar(30) NOT NULL,
  `email` varchar(80) NOT NULL,
  `address` varchar(150) NOT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '0 = delete, 1 = active, 2 = inactive ',
  `sorting` mediumint(6) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `branch_infos`
--

INSERT INTO `branch_infos` (`id`, `name`, `abbreviation`, `mobile`, `email`, `address`, `is_active`, `sorting`, `created_at`, `created_by`, `created_ip`, `updated_at`, `updated_by`, `updated_ip`) VALUES
(1, 'Head Office', NULL, '01839706458', 'main.branch@gmail.com', 'Dhaka', 1, 1, '2019-04-29 05:48:31', 1, '::1', '2019-04-29 05:48:31', NULL, NULL),
(2, 'ঢাকা-ক', NULL, '0183', 'dhakaa@gmail.com', 'Dhaka', 1, 2, '2019-06-28 21:50:55', 1, '::1', '2019-06-28 21:50:55', NULL, NULL),
(3, 'ঢাকা-খ', NULL, '019', 'dhaka-kho@gmail.com', 'dhaka', 1, 3, '2019-06-28 21:51:47', 1, '::1', '2019-06-28 21:51:47', NULL, NULL),
(4, 'ঢাকা-গ', NULL, '019', 'dhaka-kho@gmail.com', 'dhaka', 1, 3, '2019-06-28 21:52:05', 1, '::1', '2019-06-28 21:52:05', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_infos`
--

CREATE TABLE `company_infos` (
  `id` int(11) NOT NULL,
  `com_name` varchar(99) CHARACTER SET utf8 DEFAULT NULL,
  `apps_name` varchar(60) DEFAULT NULL,
  `address` text CHARACTER SET utf8,
  `email` varchar(80) DEFAULT NULL,
  `mobile` varchar(30) DEFAULT NULL,
  `helpline` varchar(20) DEFAULT NULL,
  `apps_link` varchar(300) DEFAULT NULL,
  `web_address` varchar(80) DEFAULT NULL,
  `reg_no` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `trade_licence` varchar(50) CHARACTER SET utf8 COLLATE utf8_estonian_ci DEFAULT NULL,
  `vat_reg_no` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tax_reg_no` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `company_logo` text CHARACTER SET utf8,
  `default_email_send` varchar(300) DEFAULT NULL,
  `company_sologan` text CHARACTER SET utf8,
  `ins_date` date DEFAULT NULL,
  `com_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_infos`
--

INSERT INTO `company_infos` (`id`, `com_name`, `apps_name`, `address`, `email`, `mobile`, `helpline`, `apps_link`, `web_address`, `reg_no`, `trade_licence`, `vat_reg_no`, `tax_reg_no`, `company_logo`, `default_email_send`, `company_sologan`, `ins_date`, `com_date`, `updated_at`, `status`) VALUES
(6, 'Bangladesh Betar', 'Hr Process of Bangladesh Betar', 'Bangladesh Betar\r\n31 Syed Mahbub Morshed Sarani,\r\nSher-E-Bangla Nagar, Dhaka-1207', 'info@betar.gov.bd', '01836', '3', 'https://www.facebook.com/bd-betar', 'betar.gov.bd', '123', '1234', '452', '454', 'logo.jpg', 'info@betar.gov.bd', 'Sefty First our main sign', '2018-09-20', '2019-04-26 06:20:19', '2019-04-26 12:20:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(2) UNSIGNED NOT NULL,
  `division_id` int(2) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `bn_name` varchar(50) NOT NULL,
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  `website` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `division_id`, `name`, `bn_name`, `lat`, `lon`, `website`) VALUES
(1, 3, 'Dhaka', 'ঢাকা', 23.7115253, 90.4111451, 'www.dhaka.gov.bd'),
(2, 3, 'Faridpur', 'ফরিদপুর', 23.6070822, 89.8429406, 'www.faridpur.gov.bd'),
(3, 3, 'Gazipur', 'গাজীপুর', 24.0022858, 90.4264283, 'www.gazipur.gov.bd'),
(4, 3, 'Gopalganj', 'গোপালগঞ্জ', 23.0050857, 89.8266059, 'www.gopalganj.gov.bd'),
(5, 8, 'Jamalpur', 'জামালপুর', 24.937533, 89.937775, 'www.jamalpur.gov.bd'),
(6, 3, 'Kishoreganj', 'কিশোরগঞ্জ', 24.444937, 90.776575, 'www.kishoreganj.gov.bd'),
(7, 3, 'Madaripur', 'মাদারীপুর', 23.164102, 90.1896805, 'www.madaripur.gov.bd'),
(8, 3, 'Manikganj', 'মানিকগঞ্জ', 0, 0, 'www.manikganj.gov.bd'),
(9, 3, 'Munshiganj', 'মুন্সিগঞ্জ', 0, 0, 'www.munshiganj.gov.bd'),
(10, 8, 'Mymensingh', 'ময়মনসিংহ', 0, 0, 'www.mymensingh.gov.bd'),
(11, 3, 'Narayanganj', 'নারায়াণগঞ্জ', 23.63366, 90.496482, 'www.narayanganj.gov.bd'),
(12, 3, 'Narsingdi', 'নরসিংদী', 23.932233, 90.71541, 'www.narsingdi.gov.bd'),
(13, 8, 'Netrokona', 'নেত্রকোণা', 24.870955, 90.727887, 'www.netrokona.gov.bd'),
(14, 3, 'Rajbari', 'রাজবাড়ি', 23.7574305, 89.6444665, 'www.rajbari.gov.bd'),
(15, 3, 'Shariatpur', 'শরীয়তপুর', 0, 0, 'www.shariatpur.gov.bd'),
(16, 8, 'Sherpur', 'শেরপুর', 25.0204933, 90.0152966, 'www.sherpur.gov.bd'),
(17, 3, 'Tangail', 'টাঙ্গাইল', 0, 0, 'www.tangail.gov.bd'),
(18, 5, 'Bogura', 'বগুড়া', 24.8465228, 89.377755, 'www.bogra.gov.bd'),
(19, 5, 'Joypurhat', 'জয়পুরহাট', 0, 0, 'www.joypurhat.gov.bd'),
(20, 5, 'Naogaon', 'নওগাঁ', 0, 0, 'www.naogaon.gov.bd'),
(21, 5, 'Natore', 'নাটোর', 24.420556, 89.000282, 'www.natore.gov.bd'),
(22, 5, 'Chapainawabganj', 'চাঁপাইনবাবগঞ্জ', 24.5965034, 88.2775122, 'www.chapainawabganj.gov.bd'),
(23, 5, 'Pabna', 'পাবনা', 23.998524, 89.233645, 'www.pabna.gov.bd'),
(24, 5, 'Rajshahi', 'রাজশাহী', 0, 0, 'www.rajshahi.gov.bd'),
(25, 5, 'Sirajgonj', 'সিরাজগঞ্জ', 24.4533978, 89.7006815, 'www.sirajganj.gov.bd'),
(26, 6, 'Dinajpur', 'দিনাজপুর', 25.6217061, 88.6354504, 'www.dinajpur.gov.bd'),
(27, 6, 'Gaibandha', 'গাইবান্ধা', 25.328751, 89.528088, 'www.gaibandha.gov.bd'),
(28, 6, 'Kurigram', 'কুড়িগ্রাম', 25.805445, 89.636174, 'www.kurigram.gov.bd'),
(29, 6, 'Lalmonirhat', 'লালমনিরহাট', 0, 0, 'www.lalmonirhat.gov.bd'),
(30, 6, 'Nilphamari', 'নীলফামারী', 25.931794, 88.856006, 'www.nilphamari.gov.bd'),
(31, 6, 'Panchagarh', 'পঞ্চগড়', 26.3411, 88.5541606, 'www.panchagarh.gov.bd'),
(32, 6, 'Rangpur', 'রংপুর', 25.7558096, 89.244462, 'www.rangpur.gov.bd'),
(33, 6, 'Thakurgaon', 'ঠাকুরগাঁও', 26.0336945, 88.4616834, 'www.thakurgaon.gov.bd'),
(34, 1, 'Barguna', 'বরগুনা', 0, 0, 'www.barguna.gov.bd'),
(35, 1, 'Barishal', 'বরিশাল', 0, 0, 'www.barisal.gov.bd'),
(36, 1, 'Bhola', 'ভোলা', 22.685923, 90.648179, 'www.bhola.gov.bd'),
(37, 1, 'Jhalokati', 'ঝালকাঠি', 0, 0, 'www.jhalakathi.gov.bd'),
(38, 1, 'Patuakhali', 'পটুয়াখালী', 22.3596316, 90.3298712, 'www.patuakhali.gov.bd'),
(39, 1, 'Pirojpur', 'পিরোজপুর', 0, 0, 'www.pirojpur.gov.bd'),
(40, 2, 'Bandarban', 'বান্দরবান', 22.1953275, 92.2183773, 'www.bandarban.gov.bd'),
(41, 2, 'Brahmanbaria', 'ব্রাহ্মণবাড়িয়া', 23.9570904, 91.1119286, 'www.brahmanbaria.gov.bd'),
(42, 2, 'Chandpur', 'চাঁদপুর', 23.2332585, 90.6712912, 'www.chandpur.gov.bd'),
(43, 2, 'Chattogram', 'চট্টগ্রাম', 22.335109, 91.834073, 'www.chittagong.gov.bd'),
(44, 2, 'Cumilla', 'কুমিল্লা', 23.4682747, 91.1788135, 'www.comilla.gov.bd'),
(45, 2, 'Cox\'s Bazar', 'কক্স বাজার', 0, 0, 'www.coxsbazar.gov.bd'),
(46, 2, 'Feni', 'ফেনী', 23.023231, 91.3840844, 'www.feni.gov.bd'),
(47, 2, 'Khagrachhari', 'খাগড়াছড়ি', 23.119285, 91.984663, 'www.khagrachhari.gov.bd'),
(48, 2, 'Lakshmipur', 'লক্ষ্মীপুর', 22.942477, 90.841184, 'www.lakshmipur.gov.bd'),
(49, 2, 'Noakhali', 'নোয়াখালী', 22.869563, 91.099398, 'www.noakhali.gov.bd'),
(50, 2, 'Rangamati', 'রাঙ্গামাটি', 0, 0, 'www.rangamati.gov.bd'),
(51, 7, 'Habiganj', 'হবিগঞ্জ', 24.374945, 91.41553, 'www.habiganj.gov.bd'),
(52, 7, 'Moulvibazar', 'মৌলভীবাজার', 24.482934, 91.777417, 'www.moulvibazar.gov.bd'),
(53, 7, 'Sunamganj', 'সুনামগঞ্জ', 25.0658042, 91.3950115, 'www.sunamganj.gov.bd'),
(54, 7, 'Sylhet', 'সিলেট', 24.8897956, 91.8697894, 'www.sylhet.gov.bd'),
(55, 4, 'Bagerhat', 'বাগেরহাট', 22.651568, 89.785938, 'www.bagerhat.gov.bd'),
(56, 4, 'Chuadanga', 'চুয়াডাঙ্গা', 23.6401961, 88.841841, 'www.chuadanga.gov.bd'),
(57, 4, 'Jashore', 'যশোর', 23.16643, 89.2081126, 'www.jessore.gov.bd'),
(58, 4, 'Jhenaidah', 'ঝিনাইদহ', 23.5448176, 89.1539213, 'www.jhenaidah.gov.bd'),
(59, 4, 'Khulna', 'খুলনা', 22.815774, 89.568679, 'www.khulna.gov.bd'),
(60, 4, 'Kushtia', 'কুষ্টিয়া', 23.901258, 89.120482, 'www.kushtia.gov.bd'),
(61, 4, 'Magura', 'মাগুরা', 23.487337, 89.419956, 'www.magura.gov.bd'),
(62, 4, 'Meherpur', 'মেহেরপুর', 23.762213, 88.631821, 'www.meherpur.gov.bd'),
(63, 4, 'Narail', 'নড়াইল', 23.172534, 89.512672, 'www.narail.gov.bd'),
(64, 4, 'Satkhira', 'সাতক্ষীরা', 0, 0, 'www.satkhira.gov.bd');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int(2) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `bn_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `bn_name`) VALUES
(1, 'Barishal', 'বরিশাল'),
(2, 'Chattogram', 'চট্টগ্রাম'),
(3, 'Dhaka', 'ঢাকা'),
(4, 'Khulna', 'খুলনা'),
(5, 'Rajshahi', 'রাজশাহী'),
(6, 'Rangpur', 'রংপুর'),
(7, 'Sylhet', 'সিলেট'),
(8, 'Mymensingh', 'ময়মনসিংহ');

-- --------------------------------------------------------

--
-- Table structure for table `emplooyee_overwrite_off_on_days`
--

CREATE TABLE `emplooyee_overwrite_off_on_days` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(300) DEFAULT NULL,
  `station_id` mediumint(6) UNSIGNED DEFAULT NULL,
  `from_date` date NOT NULL,
  `to_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `employee_id` varchar(300) DEFAULT NULL,
  `department_id` varchar(300) DEFAULT NULL,
  `overwrite_type` tinyint(1) UNSIGNED NOT NULL COMMENT '1 = Off day/Holiday, 2 = Onday  ',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emplooyee_overwrite_off_on_days`
--

INSERT INTO `emplooyee_overwrite_off_on_days` (`id`, `title`, `station_id`, `from_date`, `to_date`, `start_time`, `end_time`, `employee_id`, `department_id`, `overwrite_type`, `created_at`, `created_by`, `created_ip`, `updated_at`, `updated_by`, `updated_ip`) VALUES
(1, 'International Labour Day', 1, '2019-05-01', '2019-05-01', '00:00:00', '17:00:00', NULL, '[\"10\",\"11\"]', 2, '0000-00-00 00:00:00', 2019, '::1', '2019-04-28 00:25:23', 1, '::1'),
(2, 'Budhha Purnima', 1, '2019-05-19', '2019-05-19', '09:00:00', '17:00:00', NULL, '[\"9\",\"10\",\"11\"]', 1, '2019-04-27 22:14:58', 1, '::1', '2019-04-28 00:24:47', 1, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) UNSIGNED NOT NULL,
  `chart_of_acc_no` int(11) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `station_id` mediumint(6) UNSIGNED DEFAULT NULL,
  `emp_name` varchar(120) NOT NULL,
  `emp_short_name` varchar(30) DEFAULT NULL,
  `father_name` varchar(120) NOT NULL,
  `mother_name` varchar(120) DEFAULT NULL,
  `is_bcs_cadre` tinyint(1) UNSIGNED DEFAULT NULL COMMENT '1 = yes',
  `govt_id` varchar(30) DEFAULT NULL,
  `cadre_ctg` int(11) UNSIGNED DEFAULT NULL,
  `cadre_batch` varchar(10) DEFAULT NULL,
  `cadre_date` date DEFAULT NULL,
  `cadre_go_date` date DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `gender` tinyint(3) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `religion` tinyint(3) UNSIGNED DEFAULT NULL,
  `marital_status` tinyint(3) UNSIGNED DEFAULT NULL,
  `blood_group` tinyint(3) UNSIGNED DEFAULT NULL,
  `physical_disability` tinyint(2) UNSIGNED DEFAULT NULL,
  `disability_details` varchar(150) DEFAULT NULL,
  `nationality` tinyint(3) UNSIGNED DEFAULT NULL,
  `national_id` varchar(21) DEFAULT NULL,
  `birth_certificate_no` varchar(20) DEFAULT NULL,
  `driving_license_no` varchar(30) DEFAULT NULL,
  `passport_no` varchar(20) DEFAULT NULL,
  `department_id` mediumint(6) DEFAULT NULL,
  `designation_id` mediumint(6) DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `prl_date` date DEFAULT NULL,
  `lpr_date` date DEFAULT NULL,
  `reporting_person` bigint(20) UNSIGNED DEFAULT NULL,
  `is_roster_duty` tinyint(1) UNSIGNED DEFAULT NULL COMMENT '1 = Yes',
  `time_table` text COMMENT '{{''checked'':0,''day'':''Sat'',''start_time'':''9:00'',''end_time'':''5:00''},{''checked'':1,''day'':''Sun'',''start_time'':''9:00'',''end_time'':''5:00''}}',
  `leave_balance` text COMMENT '{{''pascal_year'':20,''is_active'':1, ''is_current'':1, ''sorting'':1, ''balance_info'':{{''checked'':0,''leave_type'':1,''balance'':10},{''checked'':0,''leave_type'':2,''balance'':20}}},{''pascal_year'':20,''is_active'':1, ''is_current'':0, ''sorting'':1, ''balance_info'':{{''checked'':0,''leave_type'':1,''balance'':10},{''checked'':0,''leave_type'':2,''balance'':20}}}}',
  `is_same_present_parmaent_add` tinyint(1) UNSIGNED DEFAULT NULL COMMENT '1 = Yes ',
  `present_address` varchar(500) DEFAULT NULL COMMENT '{''district'':1,''upazila'':50,''post_office'':''dhk'',''vill_road'':''109/6,Dhanmond,Dhaka''}',
  `parmanent_address` varchar(500) DEFAULT NULL COMMENT '{''district'':1,''upazila'':50,''post_office'':''dhk'',''vill_road'':''109/6,Dhanmond,Dhaka''}',
  `office_mobile` varchar(30) DEFAULT NULL,
  `office_email` varchar(50) DEFAULT NULL,
  `office_extention` varchar(15) DEFAULT NULL,
  `image` varchar(80) DEFAULT NULL,
  `signature` varchar(80) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 = delete, 1 = active, 2 = inactive, 3 = terminate, 4 = OSD   ',
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `chart_of_acc_no`, `employee_id`, `station_id`, `emp_name`, `emp_short_name`, `father_name`, `mother_name`, `is_bcs_cadre`, `govt_id`, `cadre_ctg`, `cadre_batch`, `cadre_date`, `cadre_go_date`, `mobile`, `email`, `gender`, `birth_date`, `religion`, `marital_status`, `blood_group`, `physical_disability`, `disability_details`, `nationality`, `national_id`, `birth_certificate_no`, `driving_license_no`, `passport_no`, `department_id`, `designation_id`, `join_date`, `prl_date`, `lpr_date`, `reporting_person`, `is_roster_duty`, `time_table`, `leave_balance`, `is_same_present_parmaent_add`, `present_address`, `parmanent_address`, `office_mobile`, `office_email`, `office_extention`, `image`, `signature`, `is_active`, `created_by`, `created_at`, `created_ip`, `updated_by`, `updated_at`, `updated_ip`) VALUES
(10, 142, 201903010001, 1, 'Md omar Faruk', 'MOF', 'omar shohag', 'mother', NULL, NULL, NULL, NULL, NULL, NULL, '018397645', 'omarlemua@gmail.com', 1, '1999-04-08', 1, 1, 1, 1, NULL, 13, '12', '1', '22', '21', 10, 12, '2019-04-10', '2019-04-18', '2019-04-02', 201903010001, NULL, '[{\"checked\":\"\",\"day\":\"Sat\",\"start_time\":\"10:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":1,\"day\":\"Sun\",\"start_time\":\"09:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":1,\"day\":\"Mon\",\"start_time\":\"09:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":1,\"day\":\"Tue\",\"start_time\":\"09:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":1,\"day\":\"Wed\",\"start_time\":\"09:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":1,\"day\":\"Thu\",\"start_time\":\"09:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":1,\"day\":\"Fri\",\"start_time\":\"09:00:00\",\"end_time\":\"17:00:00\"}]', '[{\"checked\":null,\"leave_type\":\"1\",\"leave_balance\":\"0\"},{\"checked\":null,\"leave_type\":\"2\",\"leave_balance\":\"0\"},{\"checked\":null,\"leave_type\":\"3\",\"leave_balance\":\"0\"},{\"checked\":null,\"leave_type\":\"4\",\"leave_balance\":\"0\"}]', 1, '{\"district\":\"1\",\"upazila\":\"145\",\"post_office\":\"11\",\"vill_road\":\"11\"}', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2019-04-11 22:42:43', '::1', NULL, '2019-04-11 22:42:43', NULL),
(11, 144, 201903010002, 1, 'Mehedi  Hassan', 'MH', 'Karim Uddin', 'Hosrana Begum', NULL, NULL, NULL, NULL, NULL, NULL, '01836976455', 'info@gmail.com', 2, '2019-03-13', 2, 2, 2, 1, NULL, 13, '444', '55', '544', '55', 10, 12, '2019-04-10', '1970-01-01', '2019-04-17', NULL, NULL, '[{\"checked\":\"\",\"day\":\"Sat\",\"start_time\":\"09:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":1,\"day\":\"Sun\",\"start_time\":\"09:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":1,\"day\":\"Mon\",\"start_time\":\"09:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":1,\"day\":\"Tue\",\"start_time\":\"09:30:00\",\"end_time\":\"17:30:00\"},{\"checked\":\"\",\"day\":\"Wed\",\"start_time\":\"09:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":\"\",\"day\":\"Thu\",\"start_time\":\"09:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":\"\",\"day\":\"Fri\",\"start_time\":\"09:00:00\",\"end_time\":\"17:00:00\"}]', '[{\"checked\":null,\"leave_type\":\"1\",\"leave_balance\":\"0\"},{\"checked\":null,\"leave_type\":\"2\",\"leave_balance\":\"0\"},{\"checked\":null,\"leave_type\":\"3\",\"leave_balance\":\"0\"},{\"checked\":null,\"leave_type\":\"4\",\"leave_balance\":\"0\"}]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2019-03-01 04:16:17', '::1', NULL, '2019-03-01 04:16:17', NULL),
(12, 171, 201903010003, 1, 'Md Shoriful Islam', 'MSI', 'Father', 'Mother', 1, '12', 28, '2', '2019-03-30', '2019-03-29', '0183967076455', 'shorif@gmail.com', 1, '2019-03-20', 2, 2, 3, 2, 'ss', 13, '12', '56', '34', '78', 10, 12, '2019-03-06', '2019-03-08', '2019-03-07', 201903010002, 1, '[{\"checked\":1,\"day\":\"Sat\",\"start_time\":\"09:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":\"\",\"day\":\"Sun\",\"start_time\":\"09:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":\"\",\"day\":\"Mon\",\"start_time\":\"09:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":\"\",\"day\":\"Tue\",\"start_time\":\"09:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":\"\",\"day\":\"Wed\",\"start_time\":\"09:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":\"\",\"day\":\"Thu\",\"start_time\":\"09:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":\"\",\"day\":\"Fri\",\"start_time\":\"09:00:00\",\"end_time\":\"17:00:00\"}]', '[{\"checked\":\"\",\"type_id\":\"3\",\"limit\":\"10\",\"consume\":\"0\",\"remaining\":\"0\"},{\"checked\":1,\"type_id\":\"4\",\"limit\":\"6\",\"consume\":\"0\",\"remaining\":\"0\"},{\"checked\":\"\",\"type_id\":\"7\",\"limit\":\"No Limit\",\"consume\":\"0\",\"remaining\":\"0\"},{\"checked\":\"\",\"type_id\":\"8\",\"limit\":\"No Limit\",\"consume\":\"0\",\"remaining\":\"0\"},{\"checked\":\"\",\"type_id\":\"18\",\"limit\":\"No Limit\",\"consume\":\"0\",\"remaining\":\"0\"},{\"checked\":\"\",\"type_id\":\"19\",\"limit\":\"No Limit\",\"consume\":\"0\",\"remaining\":\"0\"}]', NULL, '{\"district\":\"1\",\"upazila\":\"146\",\"post_office\":\"ss\",\"vill_road\":\"22qq\"}', '{\"district\":\"2\",\"upazila\":\"152\",\"post_office\":\"33\",\"vill_road\":\"33\"}', '01839707645', 'shohag@bater.gov.bd', '127', NULL, NULL, 1, 1, '2019-03-31 22:28:54', '::1', NULL, '2019-03-31 22:28:54', NULL),
(13, 172, 201904010004, 1, 'Md Kamal Uddin', 'mku', 'Father', 'Mother', NULL, NULL, NULL, NULL, NULL, NULL, '01839707645', 'kamal@gmail.com', 1, '2019-04-07', 1, 1, 1, 2, '22', NULL, '22', '22', '22', '22', 9, 59, '2019-04-07', '2019-04-07', '2019-04-09', 201904010004, NULL, '[{\"checked\":1,\"day\":\"Sat\",\"start_time\":\"17:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":1,\"day\":\"Sun\",\"start_time\":\"17:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":1,\"day\":\"Mon\",\"start_time\":\"17:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":\"\",\"day\":\"Tue\",\"start_time\":\"17:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":1,\"day\":\"Wed\",\"start_time\":\"17:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":1,\"day\":\"Thu\",\"start_time\":\"17:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":\"\",\"day\":\"Fri\",\"start_time\":\"17:00:00\",\"end_time\":\"17:00:00\"}]', '[{\"checked\":1,\"type_id\":\"3\",\"limit\":\"10\",\"consume\":\"5\",\"remaining\":\"0\"},{\"checked\":1,\"type_id\":\"4\",\"limit\":\"5\",\"consume\":\"5\",\"remaining\":\"0\"},{\"checked\":1,\"type_id\":\"7\",\"limit\":\"No Limit\",\"consume\":\"5\",\"remaining\":\"0\"},{\"checked\":\"\",\"type_id\":\"8\",\"limit\":\"No Limit\",\"consume\":\"5\",\"remaining\":\"0\"},{\"checked\":\"\",\"type_id\":\"18\",\"limit\":\"No Limit\",\"consume\":\"5\",\"remaining\":\"0\"},{\"checked\":\"\",\"type_id\":\"19\",\"limit\":\"No Limit\",\"consume\":\"5\",\"remaining\":\"0\"}]', 1, '{\"district\":\"5\",\"upazila\":\"172\",\"post_office\":\"22\",\"vill_road\":\"22\"}', NULL, '018300', 'w', 'ww', 'image_201904010004.png', 'signature_201904010004.png', 1, 1, '2019-04-06 22:57:50', '::1', NULL, '2019-04-06 22:57:50', NULL),
(14, 173, 201906010005, 1, 'Arif Rupom', 'AR', 'FAther', 'Mother', NULL, NULL, NULL, NULL, NULL, NULL, '01839707645', 'rupomsoft@gmail.com', 1, '1990-06-14', 1, 1, 1, 1, NULL, 13, NULL, NULL, NULL, NULL, 9, 12, '2019-06-20', '2028-06-08', '2019-06-24', 201903010003, NULL, '[{\"checked\":1,\"day\":\"Sat\",\"start_time\":\"09:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":1,\"day\":\"Sun\",\"start_time\":\"09:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":1,\"day\":\"Mon\",\"start_time\":\"09:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":1,\"day\":\"Tue\",\"start_time\":\"09:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":1,\"day\":\"Wed\",\"start_time\":\"09:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":1,\"day\":\"Thu\",\"start_time\":\"09:00:00\",\"end_time\":\"17:00:00\"},{\"checked\":\"\",\"day\":\"Fri\",\"start_time\":\"09:00:00\",\"end_time\":\"17:00:00\"}]', '[{\"checked\":\"\",\"type_id\":\"3\",\"limit\":\"10\",\"consume\":\"0\",\"remaining\":\"0\"},{\"checked\":\"\",\"type_id\":\"4\",\"limit\":\"5\",\"consume\":\"0\",\"remaining\":\"0\"},{\"checked\":\"\",\"type_id\":\"7\",\"limit\":\"No Limit\",\"consume\":\"0\",\"remaining\":\"0\"},{\"checked\":\"\",\"type_id\":\"8\",\"limit\":\"No Limit\",\"consume\":\"0\",\"remaining\":\"0\"},{\"checked\":\"\",\"type_id\":\"18\",\"limit\":\"No Limit\",\"consume\":\"0\",\"remaining\":\"0\"},{\"checked\":\"\",\"type_id\":\"19\",\"limit\":\"No Limit\",\"consume\":\"0\",\"remaining\":\"0\"}]', NULL, '{\"district\":\"1\",\"upazila\":\"145\",\"post_office\":null,\"vill_road\":null}', '{\"district\":\"1\",\"upazila\":\"147\",\"post_office\":null,\"vill_road\":null}', NULL, NULL, NULL, NULL, NULL, 1, 1, '2019-06-23 20:51:42', '::1', NULL, '2019-06-23 20:51:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_attendance_application`
--

CREATE TABLE `employee_attendance_application` (
  `id` int(11) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `application_date` date DEFAULT NULL,
  `in_time` time DEFAULT NULL,
  `out_time` time DEFAULT NULL,
  `type` tinyint(3) UNSIGNED ZEROFILL DEFAULT NULL COMMENT '1 = Manual App. 2 = Late Arrival App, 3 = Early Departure App',
  `reason` varchar(300) DEFAULT NULL,
  `comments` text,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '0 = delete, 1 = pending, 2 = approved, 3 = denied, 4 = Cancelled, 5 = Recommended,  ',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_attendance_info`
--

CREATE TABLE `employee_attendance_info` (
  `id` int(11) UNSIGNED NOT NULL,
  `employee_id` bigint(20) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `is_late` tinyint(1) UNSIGNED DEFAULT NULL COMMENT '0 = No Late, 1 = Late ',
  `is_late_approved` tinyint(1) UNSIGNED DEFAULT NULL COMMENT '0 = No approve, 1 = Approved',
  `is_early_departure` int(11) DEFAULT NULL COMMENT '0 = No Early Departure, 1 = Early Departure',
  `is_early_departure_approved` int(11) DEFAULT NULL COMMENT '0 = No approve, 1 = Approved',
  `record_type` tinyint(1) UNSIGNED DEFAULT '1' COMMENT '1 = System , 2 = Manual ',
  `is_active` tinyint(4) DEFAULT '1' COMMENT '0 = delete, 1 = active, 2 =  delete  ',
  `determine_schedule` varchar(100) DEFAULT NULL COMMENT '{''intime: ''09:00:00'', ''end_time'': ''17:00:00''}',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_attendance_info`
--

INSERT INTO `employee_attendance_info` (`id`, `employee_id`, `attendance_date`, `start_time`, `end_time`, `is_late`, `is_late_approved`, `is_early_departure`, `is_early_departure_approved`, `record_type`, `is_active`, `determine_schedule`, `created_at`, `created_by`, `created_ip`, `updated_at`, `updated_by`, `updated_ip`) VALUES
(7, 201903010003, '2019-04-28', '02:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-04-28 11:49:18', 1, '::1', '2019-04-28 14:11:26', 1, '::1'),
(8, 201903010002, '2019-04-28', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 2, NULL, '2019-04-28 11:49:18', 1, '::1', NULL, NULL, NULL),
(10, 201903010001, '2019-04-28', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-04-28 11:49:18', 1, '::1', '2019-04-28 14:11:26', 1, '::1'),
(12, 201903010003, '2019-04-29', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-04-28 11:26:45', 1, '::1', NULL, NULL, NULL),
(13, 201903010002, '2019-04-29', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-04-28 11:26:45', 1, '::1', NULL, NULL, NULL),
(14, 201903010001, '2019-04-29', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-04-28 11:26:45', 1, '::1', NULL, NULL, NULL),
(15, 201904010004, '2019-04-28', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-04-28 11:47:44', 1, '::1', NULL, NULL, NULL),
(16, 201903010003, '2019-04-09', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-04-28 11:48:24', 1, '::1', NULL, NULL, NULL),
(17, 201903010002, '2019-04-09', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-04-28 11:48:24', 1, '::1', NULL, NULL, NULL),
(18, 201903010001, '2019-04-09', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-04-28 11:48:24', 1, '::1', NULL, NULL, NULL),
(19, 201903010003, '2019-04-30', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-04-28 12:36:47', 1, '::1', '2019-04-29 00:14:12', 1, '::1'),
(20, 201903010002, '2019-04-30', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 2, NULL, '2019-04-28 12:36:47', 1, '::1', '2019-04-29 00:14:12', 1, '::1'),
(21, 201903010001, '2019-04-30', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-04-28 12:36:48', 1, '::1', '2019-04-29 00:14:12', 1, '::1'),
(22, 201903010003, '2019-05-01', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-04-28 12:37:30', 1, '::1', NULL, NULL, NULL),
(23, 201903010002, '2019-05-01', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-04-28 12:37:30', 1, '::1', NULL, NULL, NULL),
(24, 201903010001, '2019-05-01', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-04-28 12:37:30', 1, '::1', NULL, NULL, NULL),
(25, 201903010001, '2019-05-03', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-04-28 12:47:50', 1, '::1', NULL, NULL, NULL),
(26, 201903010003, '2019-05-03', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-04-28 12:48:16', 1, '::1', NULL, NULL, NULL),
(27, 201903010001, '2019-05-03', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-04-28 12:48:16', 1, '::1', NULL, NULL, NULL),
(28, 201903010001, '2019-05-03', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-04-28 12:48:16', 1, '::1', NULL, NULL, NULL),
(29, 201903010002, '2019-05-04', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-04-28 13:23:02', 1, '::1', NULL, NULL, NULL),
(31, 201903010001, '2019-05-04', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-04-28 13:23:12', 1, '::1', NULL, NULL, NULL),
(32, 201903010003, '2019-05-04', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-04-28 13:23:12', 1, '::1', NULL, NULL, NULL),
(33, 201903010002, '2019-05-05', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 2, NULL, '2019-04-28 13:23:36', 1, '::1', NULL, NULL, NULL),
(34, 201903010003, '2019-05-05', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-04-28 13:44:16', 1, '::1', '2019-04-28 21:47:38', 1, '::1'),
(35, 201903010002, '2019-05-05', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 2, NULL, '2019-04-28 13:31:52', 1, '::1', '2019-04-28 13:53:57', 1, '::1'),
(36, 201903010001, '2019-05-05', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-04-28 13:44:17', 1, '::1', '2019-04-28 21:47:38', 1, '::1'),
(37, 201903010002, '2019-05-05', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 2, NULL, '2019-04-28 13:57:21', 1, '::1', '2019-04-28 21:47:38', 1, '::1'),
(38, 201903010003, '2019-05-14', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-05-14 12:36:48', 1, '::1', NULL, NULL, NULL),
(39, 201903010002, '2019-05-14', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-05-14 12:36:48', 1, '::1', NULL, NULL, NULL),
(40, 201903010001, '2019-05-14', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-05-14 12:36:48', 1, '::1', NULL, NULL, NULL),
(41, 201903010003, '2019-06-18', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-06-18 07:30:13', 1, '::1', NULL, NULL, NULL),
(42, 201903010002, '2019-06-18', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-06-18 07:30:13', 1, '::1', NULL, NULL, NULL),
(43, 201903010001, '2019-06-18', '09:00:00', '05:00:00', 0, 0, 0, 0, 1, 1, NULL, '2019-06-18 07:30:13', 1, '::1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_attendance_row_data`
--

CREATE TABLE `employee_attendance_row_data` (
  `id` int(11) UNSIGNED NOT NULL,
  `employee_id` bigint(20) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL,
  `attendance_type` tinyint(1) UNSIGNED NOT NULL COMMENT '1 = IN, 2 = OUT',
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT '1' COMMENT '0 = delete, 1 = active, 2 = inactive  ',
  `is_process` tinyint(3) UNSIGNED DEFAULT '1' COMMENT '1 =process pending, 2 = process complete',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_leave_infos`
--

CREATE TABLE `employee_leave_infos` (
  `id` int(11) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `leave_type_id` int(11) UNSIGNED NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `leave_reason` varchar(500) DEFAULT NULL,
  `is_leave_share` tinyint(4) DEFAULT NULL COMMENT '0 = no, 1 = yes',
  `leave_share_info` text,
  `comments` text,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 = delete, 1 = pending,2 = recommanded, 3 = denied, 4 = Cancelled, 5 =  Completed',
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_leave_infos`
--

INSERT INTO `employee_leave_infos` (`id`, `employee_id`, `leave_type_id`, `from_date`, `to_date`, `leave_reason`, `is_leave_share`, `leave_share_info`, `comments`, `status`, `created_by`, `created_at`, `created_ip`, `updated_by`, `updated_at`, `updated_ip`) VALUES
(1, 201903010002, 3, '2019-03-07', '2019-03-14', 'I am sick', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_payrole_leave_assign`
--

CREATE TABLE `employee_payrole_leave_assign` (
  `id` int(11) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fiscal_year` mediumint(6) UNSIGNED DEFAULT NULL,
  `leave_info` text COMMENT '{{''type_id'':1,''limit'':20,''consume'':5,''remaining'':15},{''type_id'':2,''limit'':10,''consume'':5,''remaining'':10}}',
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_payrole_leave_assign`
--

INSERT INTO `employee_payrole_leave_assign` (`id`, `employee_id`, `fiscal_year`, `leave_info`, `created_by`, `created_at`, `created_ip`, `updated_by`, `updated_at`, `updated_ip`) VALUES
(1, 201904010004, 1, '[{\"checked\":1,\"type_id\":\"3\",\"limit\":\"10\",\"consume\":\"5\",\"remaining\":\"0\"},{\"checked\":1,\"type_id\":\"4\",\"limit\":\"5\",\"consume\":\"5\",\"remaining\":\"0\"},{\"checked\":1,\"type_id\":\"7\",\"limit\":\"No Limit\",\"consume\":\"5\",\"remaining\":\"0\"},{\"checked\":\"\",\"type_id\":\"8\",\"limit\":\"No Limit\",\"consume\":\"5\",\"remaining\":\"0\"},{\"checked\":\"\",\"type_id\":\"18\",\"limit\":\"No Limit\",\"consume\":\"5\",\"remaining\":\"0\"},{\"checked\":\"\",\"type_id\":\"19\",\"limit\":\"No Limit\",\"consume\":\"5\",\"remaining\":\"0\"}]', 1, '2019-04-10 11:34:10', '::1', 1, '2019-05-13 23:12:45', '::1'),
(2, 201903010003, 1, '[{\"checked\":\"\",\"type_id\":\"3\",\"limit\":\"10\",\"consume\":\"0\",\"remaining\":\"0\"},{\"checked\":1,\"type_id\":\"4\",\"limit\":\"6\",\"consume\":\"0\",\"remaining\":\"0\"},{\"checked\":\"\",\"type_id\":\"7\",\"limit\":\"No Limit\",\"consume\":\"0\",\"remaining\":\"0\"},{\"checked\":\"\",\"type_id\":\"8\",\"limit\":\"No Limit\",\"consume\":\"0\",\"remaining\":\"0\"},{\"checked\":\"\",\"type_id\":\"18\",\"limit\":\"No Limit\",\"consume\":\"0\",\"remaining\":\"0\"},{\"checked\":\"\",\"type_id\":\"19\",\"limit\":\"No Limit\",\"consume\":\"0\",\"remaining\":\"0\"}]', 1, '2019-04-10 14:42:00', '::1', 1, '2019-04-10 14:43:27', '::1'),
(3, 201906010005, 1, '[{\"checked\":\"\",\"type_id\":\"3\",\"limit\":\"10\",\"consume\":\"0\",\"remaining\":\"0\"},{\"checked\":\"\",\"type_id\":\"4\",\"limit\":\"5\",\"consume\":\"0\",\"remaining\":\"0\"},{\"checked\":\"\",\"type_id\":\"7\",\"limit\":\"No Limit\",\"consume\":\"0\",\"remaining\":\"0\"},{\"checked\":\"\",\"type_id\":\"8\",\"limit\":\"No Limit\",\"consume\":\"0\",\"remaining\":\"0\"},{\"checked\":\"\",\"type_id\":\"18\",\"limit\":\"No Limit\",\"consume\":\"0\",\"remaining\":\"0\"},{\"checked\":\"\",\"type_id\":\"19\",\"limit\":\"No Limit\",\"consume\":\"0\",\"remaining\":\"0\"}]', 1, '2019-06-24 00:10:59', '::1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_payslip_infos`
--

CREATE TABLE `employee_payslip_infos` (
  `id` int(11) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `payrole_setup_month` mediumint(6) UNSIGNED NOT NULL,
  `generated_date` date DEFAULT NULL,
  `earning_info` text COMMENT '{''ctg_info'':{{''ctg_id'':1,''details'':''ctg wise details'',''amount'':''150''},{''ctg_id'':1,''details'':''ctg wise details'',''amount'':''150''}},''allowance_info'':''''}',
  `deduction_info` text,
  `is_modify` tinyint(1) DEFAULT NULL COMMENT '1 = modified',
  `is_active` tinyint(1) DEFAULT '1' COMMENT '0 = delete, 1 = active, 2 = inactive ',
  `is_maill_send` tinyint(1) DEFAULT NULL COMMENT '1 = send complete,',
  `is_pdf_bind` tinyint(1) DEFAULT NULL COMMENT '1 = pdf bind complete',
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL,
  `generated_method` tinyint(1) DEFAULT '1' COMMENT '1 = manual , 2 = cron job'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_payslip_infos`
--

INSERT INTO `employee_payslip_infos` (`id`, `employee_id`, `payrole_setup_month`, `generated_date`, `earning_info`, `deduction_info`, `is_modify`, `is_active`, `is_maill_send`, `is_pdf_bind`, `created_by`, `created_at`, `created_ip`, `updated_by`, `updated_at`, `updated_ip`, `generated_method`) VALUES
(5, 201904010004, 1, '2019-04-07', '[{\"earning_ctg\":\"16\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"60000.00\"},{\"earning_ctg\":\"43\",\"earning_ctg_per\":\"10\",\"earning_ctg_amount\":\"6000.00\"},{\"earning_ctg\":\"44\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"0.00\"},{\"earning_ctg\":\"45\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"5000.00\"}]', '[{\"deduction_ctg\":\"15\",\"deduction_ctg_per\":\"5\",\"deduction_ctg_amount\":\"3000.00\"},{\"deduction_ctg\":\"49\",\"deduction_ctg_per\":\"0\",\"deduction_ctg_amount\":\"4000.00\"},{\"deduction_ctg\":\"50\",\"deduction_ctg_per\":\"0\",\"deduction_ctg_amount\":\"500.00\"}]', NULL, 1, NULL, NULL, 1, '2019-04-07 08:02:46', '::1', NULL, NULL, NULL, 1),
(6, 201903010002, 1, '2019-04-07', '[{\"earning_ctg\":\"16\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"30.00\"},{\"earning_ctg\":\"43\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"500.00\"},{\"earning_ctg\":\"44\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"200.00\"},{\"earning_ctg\":\"45\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"0.00\"}]', '[{\"deduction_ctg\":\"15\",\"deduction_ctg_per\":\"0\",\"deduction_ctg_amount\":\"0.00\"},{\"deduction_ctg\":\"49\",\"deduction_ctg_per\":\"15\",\"deduction_ctg_amount\":\"4.50\"},{\"deduction_ctg\":\"50\",\"deduction_ctg_per\":\"5\",\"deduction_ctg_amount\":\"1.50\"}]', NULL, 1, NULL, NULL, 1, '2019-04-07 08:02:46', '::1', NULL, NULL, NULL, 1),
(10, 201903010003, 1, '2019-04-07', '[{\"earning_ctg\":\"16\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"30.00\"},{\"earning_ctg\":\"43\",\"earning_ctg_per\":\"6\",\"earning_ctg_amount\":\"50.00\"},{\"earning_ctg\":\"44\",\"earning_ctg_per\":\"6\",\"earning_ctg_amount\":\"12.00\"},{\"earning_ctg\":\"45\",\"earning_ctg_per\":\"6.9\",\"earning_ctg_amount\":\"100.00\"}]', '[{\"deduction_ctg\":\"15\",\"deduction_ctg_per\":\"0\",\"deduction_ctg_amount\":\"100.00\"},{\"deduction_ctg\":\"49\",\"deduction_ctg_per\":\"1\",\"deduction_ctg_amount\":\"0.30\"},{\"deduction_ctg\":\"50\",\"deduction_ctg_per\":\"6\",\"deduction_ctg_amount\":\"1.80\"}]', NULL, 1, NULL, NULL, 1, '2019-04-07 09:06:24', '::1', NULL, NULL, NULL, 1),
(11, 201904010004, 2, '2019-04-12', '[{\"earning_ctg\":\"16\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"60000.00\"},{\"earning_ctg\":\"43\",\"earning_ctg_per\":\"10\",\"earning_ctg_amount\":\"6000.00\"},{\"earning_ctg\":\"44\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"0.00\"},{\"earning_ctg\":\"45\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"5000.00\"}]', '[{\"deduction_ctg\":\"15\",\"deduction_ctg_per\":\"5\",\"deduction_ctg_amount\":\"3000.00\"},{\"deduction_ctg\":\"49\",\"deduction_ctg_per\":\"0\",\"deduction_ctg_amount\":\"4000.00\"},{\"deduction_ctg\":\"50\",\"deduction_ctg_per\":\"0\",\"deduction_ctg_amount\":\"500.00\"}]', NULL, 1, NULL, NULL, 1, '2019-04-12 06:16:38', '::1', NULL, NULL, NULL, 1),
(12, 201903010003, 2, '2019-04-29', '[{\"earning_ctg\":\"16\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"30000.00\"},{\"earning_ctg\":\"43\",\"earning_ctg_per\":\"6\",\"earning_ctg_amount\":\"50.00\"},{\"earning_ctg\":\"44\",\"earning_ctg_per\":\"6\",\"earning_ctg_amount\":\"12.00\"},{\"earning_ctg\":\"45\",\"earning_ctg_per\":\"6.9\",\"earning_ctg_amount\":\"100.00\"}]', '[{\"deduction_ctg\":\"15\",\"deduction_ctg_per\":\"0\",\"deduction_ctg_amount\":\"1000.00\"},{\"deduction_ctg\":\"49\",\"deduction_ctg_per\":\"1\",\"deduction_ctg_amount\":\"1888.00\"},{\"deduction_ctg\":\"50\",\"deduction_ctg_per\":\"6\",\"deduction_ctg_amount\":\"2000.00\"}]', NULL, 1, NULL, NULL, 1, '2019-04-29 00:47:23', '::1', NULL, NULL, NULL, 1),
(13, 201904010004, 1, '2019-05-14', NULL, NULL, NULL, 1, NULL, NULL, 1, '2019-05-14 07:36:57', '::1', NULL, NULL, NULL, 1),
(14, 201903010003, 1, '2019-05-14', NULL, NULL, NULL, 1, NULL, NULL, 1, '2019-05-14 07:36:57', '::1', NULL, NULL, NULL, 1),
(15, 201903010002, 1, '2019-05-14', NULL, NULL, NULL, 1, NULL, NULL, 1, '2019-05-14 07:36:57', '::1', NULL, NULL, NULL, 1),
(16, 201903010002, 2, '2019-05-14', '[{\"earning_ctg\":\"16\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"30.00\"},{\"earning_ctg\":\"43\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"500.00\"},{\"earning_ctg\":\"44\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"200.00\"},{\"earning_ctg\":\"45\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"0.00\"}]', '[{\"deduction_ctg\":\"15\",\"deduction_ctg_per\":\"0\",\"deduction_ctg_amount\":\"0.00\"},{\"deduction_ctg\":\"49\",\"deduction_ctg_per\":\"15\",\"deduction_ctg_amount\":\"4.50\"},{\"deduction_ctg\":\"50\",\"deduction_ctg_per\":\"5\",\"deduction_ctg_amount\":\"1.50\"}]', NULL, 1, NULL, NULL, 1, '2019-05-14 07:37:53', '::1', NULL, NULL, NULL, 1),
(17, 201903010001, 2, '2019-05-15', '[{\"earning_ctg\":\"16\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"30.00\"},{\"earning_ctg\":\"43\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"0.00\"},{\"earning_ctg\":\"44\",\"earning_ctg_per\":\"3\",\"earning_ctg_amount\":\"20.00\"},{\"earning_ctg\":\"45\",\"earning_ctg_per\":\"3\",\"earning_ctg_amount\":\"600.00\"},{\"earning_ctg\":\"47\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"10.00\"}]', '[{\"deduction_ctg\":\"15\",\"deduction_ctg_per\":\"0\",\"deduction_ctg_amount\":\"0.00\"},{\"deduction_ctg\":\"49\",\"deduction_ctg_per\":\"0\",\"deduction_ctg_amount\":\"0.00\"},{\"deduction_ctg\":\"50\",\"deduction_ctg_per\":\"0\",\"deduction_ctg_amount\":\"0.00\"},{\"deduction_ctg\":\"48\",\"deduction_ctg_per\":\"12\",\"deduction_ctg_amount\":\"3.60\"}]', NULL, 1, NULL, NULL, 1, '2019-05-14 23:39:44', '::1', NULL, NULL, NULL, 1),
(18, 201904010004, 3, '2019-05-15', '[{\"earning_ctg\":\"16\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"60000.00\"},{\"earning_ctg\":\"43\",\"earning_ctg_per\":\"10\",\"earning_ctg_amount\":\"6000.00\"},{\"earning_ctg\":\"44\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"0.00\"},{\"earning_ctg\":\"45\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"5000.00\"}]', '[{\"deduction_ctg\":\"15\",\"deduction_ctg_per\":\"5\",\"deduction_ctg_amount\":\"3000.00\"},{\"deduction_ctg\":\"49\",\"deduction_ctg_per\":\"0\",\"deduction_ctg_amount\":\"4000.00\"},{\"deduction_ctg\":\"50\",\"deduction_ctg_per\":\"0\",\"deduction_ctg_amount\":\"500.00\"}]', NULL, 1, NULL, NULL, 1, '2019-05-14 23:40:50', '::1', NULL, NULL, NULL, 1),
(19, 201903010003, 3, '2019-06-18', '[{\"earning_ctg\":\"16\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"30000.00\"},{\"earning_ctg\":\"43\",\"earning_ctg_per\":\"6\",\"earning_ctg_amount\":\"50.00\"},{\"earning_ctg\":\"44\",\"earning_ctg_per\":\"6\",\"earning_ctg_amount\":\"12.00\"},{\"earning_ctg\":\"45\",\"earning_ctg_per\":\"6.9\",\"earning_ctg_amount\":\"100.00\"}]', '[{\"deduction_ctg\":\"15\",\"deduction_ctg_per\":\"0\",\"deduction_ctg_amount\":\"1000.00\"},{\"deduction_ctg\":\"49\",\"deduction_ctg_per\":\"1\",\"deduction_ctg_amount\":\"1888.00\"},{\"deduction_ctg\":\"50\",\"deduction_ctg_per\":\"6\",\"deduction_ctg_amount\":\"2000.00\"}]', NULL, 1, NULL, NULL, 1, '2019-06-18 07:28:19', '::1', NULL, NULL, NULL, 1),
(20, 201904010004, 1, '2019-06-19', NULL, NULL, NULL, 1, NULL, NULL, 1, '2019-06-18 21:25:15', '::1', NULL, NULL, NULL, 1),
(21, 201904010004, 1, '2019-06-19', NULL, NULL, NULL, 1, NULL, NULL, 1, '2019-06-18 21:25:15', '::1', NULL, NULL, NULL, 1),
(22, 201903010003, 1, '2019-06-19', NULL, NULL, NULL, 1, NULL, NULL, 1, '2019-06-18 21:25:15', '::1', NULL, NULL, NULL, 1),
(23, 201903010003, 1, '2019-06-19', NULL, NULL, NULL, 1, NULL, NULL, 1, '2019-06-18 21:25:15', '::1', NULL, NULL, NULL, 1),
(24, 201903010002, 1, '2019-06-19', NULL, NULL, NULL, 1, NULL, NULL, 1, '2019-06-18 21:25:15', '::1', NULL, NULL, NULL, 1),
(25, 201903010002, 1, '2019-06-19', NULL, NULL, NULL, 1, NULL, NULL, 1, '2019-06-18 21:25:15', '::1', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_salary_infos`
--

CREATE TABLE `employee_salary_infos` (
  `id` int(11) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `basic_salary` decimal(10,2) DEFAULT NULL,
  `pay_scal` varchar(20) DEFAULT NULL,
  `bank_Id` int(11) UNSIGNED DEFAULT NULL,
  `account_no` varchar(30) DEFAULT NULL,
  `payrole_earning_info` text,
  `payrole_deduction_info` text,
  `pf_inital_balance` decimal(10,2) DEFAULT NULL,
  `pf_deduction_per` decimal(3,2) DEFAULT NULL,
  `is_salary_assign` tinyint(4) DEFAULT NULL COMMENT '1 = assign complete ',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 = delete, 1 = active, 2 = inactive',
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `update_by` bigint(20) UNSIGNED DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `update_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_salary_infos`
--

INSERT INTO `employee_salary_infos` (`id`, `employee_id`, `basic_salary`, `pay_scal`, `bank_Id`, `account_no`, `payrole_earning_info`, `payrole_deduction_info`, `pf_inital_balance`, `pf_deduction_per`, `is_salary_assign`, `is_active`, `created_by`, `created_at`, `created_ip`, `update_by`, `update_at`, `update_ip`) VALUES
(1, 201903010003, '30000.00', '2015', 17, '33', '[{\"earning_ctg\":\"16\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"30000.00\"},{\"earning_ctg\":\"43\",\"earning_ctg_per\":\"6\",\"earning_ctg_amount\":\"50.00\"},{\"earning_ctg\":\"44\",\"earning_ctg_per\":\"6\",\"earning_ctg_amount\":\"12.00\"},{\"earning_ctg\":\"45\",\"earning_ctg_per\":\"6.9\",\"earning_ctg_amount\":\"100.00\"}]', '[{\"deduction_ctg\":\"15\",\"deduction_ctg_per\":\"0\",\"deduction_ctg_amount\":\"1000.00\"},{\"deduction_ctg\":\"49\",\"deduction_ctg_per\":\"1\",\"deduction_ctg_amount\":\"1888.00\"},{\"deduction_ctg\":\"50\",\"deduction_ctg_per\":\"6\",\"deduction_ctg_amount\":\"2000.00\"}]', '3.00', '3.00', 1, 1, NULL, NULL, NULL, 1, '2019-04-28 23:53:18', '::1'),
(2, 201903010002, '30.00', '3', 17, '33', '[{\"earning_ctg\":\"16\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"30.00\"},{\"earning_ctg\":\"43\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"500.00\"},{\"earning_ctg\":\"44\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"200.00\"},{\"earning_ctg\":\"45\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"0.00\"}]', '[{\"deduction_ctg\":\"15\",\"deduction_ctg_per\":\"0\",\"deduction_ctg_amount\":\"0.00\"},{\"deduction_ctg\":\"49\",\"deduction_ctg_per\":\"15\",\"deduction_ctg_amount\":\"4.50\"},{\"deduction_ctg\":\"50\",\"deduction_ctg_per\":\"5\",\"deduction_ctg_amount\":\"1.50\"}]', '3.00', '3.00', 1, 1, NULL, NULL, NULL, 1, '2019-04-05 08:09:56', '::1'),
(3, 201903010001, '30.00', '3', 17, '33', '[{\"earning_ctg\":\"16\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"30.00\"},{\"earning_ctg\":\"43\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"0.00\"},{\"earning_ctg\":\"44\",\"earning_ctg_per\":\"3\",\"earning_ctg_amount\":\"20.00\"},{\"earning_ctg\":\"45\",\"earning_ctg_per\":\"3\",\"earning_ctg_amount\":\"600.00\"},{\"earning_ctg\":\"47\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"10.00\"}]', '[{\"deduction_ctg\":\"15\",\"deduction_ctg_per\":\"0\",\"deduction_ctg_amount\":\"0.00\"},{\"deduction_ctg\":\"49\",\"deduction_ctg_per\":\"0\",\"deduction_ctg_amount\":\"0.00\"},{\"deduction_ctg\":\"50\",\"deduction_ctg_per\":\"0\",\"deduction_ctg_amount\":\"0.00\"},{\"deduction_ctg\":\"48\",\"deduction_ctg_per\":\"12\",\"deduction_ctg_amount\":\"3.60\"}]', '3.00', '3.00', 1, 1, NULL, NULL, NULL, 1, '2019-04-06 02:37:51', '::1'),
(4, 201904010004, '60000.00', '2015', 17, '018300', '[{\"earning_ctg\":\"16\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"60000.00\"},{\"earning_ctg\":\"43\",\"earning_ctg_per\":\"10\",\"earning_ctg_amount\":\"6000.00\"},{\"earning_ctg\":\"44\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"0.00\"},{\"earning_ctg\":\"45\",\"earning_ctg_per\":\"0\",\"earning_ctg_amount\":\"5000.00\"}]', '[{\"deduction_ctg\":\"15\",\"deduction_ctg_per\":\"5\",\"deduction_ctg_amount\":\"3000.00\"},{\"deduction_ctg\":\"49\",\"deduction_ctg_per\":\"0\",\"deduction_ctg_amount\":\"4000.00\"},{\"deduction_ctg\":\"50\",\"deduction_ctg_per\":\"0\",\"deduction_ctg_amount\":\"500.00\"}]', '50000.00', '5.00', 1, 1, NULL, NULL, NULL, 1, '2019-04-06 23:04:41', '::1'),
(5, 201906010005, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employess_general_infos`
--

CREATE TABLE `employess_general_infos` (
  `id` int(11) NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `education_info` text,
  `training_info` text,
  `spouse_info` text,
  `children_info` text,
  `promotion_info` text,
  `job_history` text,
  `emergency_contact` text,
  `exit_feedback` text,
  `disciplinary_action` text,
  `is_active` tinyint(1) UNSIGNED DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(20) UNSIGNED DEFAULT NULL,
  `created_ip` varchar(15) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employess_general_infos`
--

INSERT INTO `employess_general_infos` (`id`, `employee_id`, `education_info`, `training_info`, `spouse_info`, `children_info`, `promotion_info`, `job_history`, `emergency_contact`, `exit_feedback`, `disciplinary_action`, `is_active`, `created_at`, `created_by`, `created_ip`, `updated_at`, `updated_by`, `updated_ip`) VALUES
(1, 201903010003, '[{\"degree_name\":\"1\",\"major_subject\":\"2\",\"institution\":\"Comilla Board\",\"passing_year\":\"2010\",\"result\":\"1st Class\",\"cgpa\":null,\"sorting\":1,\"created_by\":1,\"created_time\":\"2019-03-31 17:42:38\"},{\"degree_name\":\"2\",\"major_subject\":\"15\",\"institution\":\"Feni Computer Institute\",\"passing_year\":\"2014\",\"result\":null,\"cgpa\":\"3.40\",\"sorting\":2,\"created_by\":1,\"created_time\":\"2019-03-31 17:42:38\"}]', '[{\"training_type\":\"1\",\"training_title\":\"IDB\",\"institute_name\":\"BD News\",\"from_date\":\"30-03-2019\",\"to_date\":\"30-03-2019\",\"sorting\":1,\"created_by\":1,\"created_time\":\"2019-03-30 07:54:38\"},{\"training_type\":\"2\",\"training_title\":\"Hello BD\",\"institute_name\":\"BDD\",\"from_date\":\"21-03-2019\",\"to_date\":\"21-03-2019\",\"sorting\":2,\"created_by\":1,\"created_time\":\"2019-03-30 07:54:38\"}]', '{\"spouse_name\":\"ss\",\"spouse_occupation\":\"2\",\"spouse_mobile\":\"22\",\"spouse_designation\":\"2\",\"spouse_home_district\":\"1\",\"spouse_organization\":\"2\",\"spouse_address\":\"2\"}', '[{\"childName\":\"22\",\"childSex\":\"2\",\"child_birth_date\":\"13-03-2019\",\"sorting\":1,\"created_by\":1,\"created_time\":\"2019-03-30 10:39:12\"}]', '[{\"promotion_designation\":\"12\",\"increment_date\":\"30-03-2019\",\"go_date\":\"30-03-2019\",\"nature_increment\":\"33\",\"pay_scale\":\"33\",\"sorting\":1,\"created_by\":null,\"created_time\":\"2019-03-30 19:27:52\"},{\"promotion_designation\":\"12\",\"increment_date\":\"30-03-2019\",\"go_date\":\"30-03-2019\",\"nature_increment\":\"33\",\"pay_scale\":\"333\",\"sorting\":2,\"created_by\":null,\"created_time\":\"2019-03-30 19:27:52\"}]', '[{\"organigation\":\"w\",\"post\":\"s\",\"office_address\":\"d\",\"department\":\"d\",\"job_from_date\":\"14-03-2019\",\"job_to_date\":\"12-03-2019\",\"job_payscale\":null,\"sorting\":1,\"created_by\":1,\"created_time\":\"2019-03-30 19:29:24\"},{\"organigation\":\"s\",\"post\":\"sw\",\"office_address\":\"sw\",\"department\":\"sw\",\"job_from_date\":\"12-03-2019\",\"job_to_date\":\"25-03-2019\",\"job_payscale\":\"s\",\"sorting\":2,\"created_by\":1,\"created_time\":\"2019-03-30 19:29:24\"},{\"organigation\":\"sw\",\"post\":\"s\",\"office_address\":\"s\",\"department\":\"s\",\"job_from_date\":\"20-03-2019\",\"job_to_date\":\"12-03-2019\",\"job_payscale\":\"ss\",\"sorting\":3,\"created_by\":1,\"created_time\":\"2019-03-30 19:29:24\"}]', '{\"emergencey_contact_person\":\"d3\",\"relation_contact_person\":\"x333\",\"emergency_contact_mobile\":\"333\",\"emergency_contact_email\":\"x3\",\"emergency_contact_address\":\"xx3\"}', '{\"reason_of_resignation\":\"22\",\"resignation_date\":\"06-03-2019\",\"new_work_place\":\"dd\",\"new_work_place_address\":\"d\",\"comments_employee\":\"d\",\"comments_authority\":\"d\"}', '{\"employee_action\":\"1\",\"punishment_date\":\"30-03-2019\",\"punishment\":\"d dd dd\",\"remarks\":\"d\"}', 1, '2019-03-31 11:42:38', 1, '', NULL, NULL, NULL),
(2, 201904010004, '[{\"degree_name\":\"1\",\"major_subject\":\"Science\",\"institution\":\"Dhaka\",\"passing_year\":\"2015\",\"result\":null,\"cgpa\":\"5.00\",\"sorting\":1,\"created_by\":1,\"created_time\":\"2019-04-29 05:46:30\"},{\"degree_name\":\"2\",\"major_subject\":\"Science\",\"institution\":\"Dhaka\",\"passing_year\":\"2015\",\"result\":null,\"cgpa\":\"3.59\",\"sorting\":2,\"created_by\":1,\"created_time\":\"2019-04-29 05:46:30\"}]', '[{\"training_type\":\"1\",\"training_title\":\"IDB\",\"institute_name\":\"IDB\",\"from_date\":\"01-04-2019\",\"to_date\":\"30-05-2019\",\"sorting\":1,\"created_by\":1,\"created_time\":\"2019-04-29 05:42:02\"}]', '{\"spouse_name\":\"Laila\",\"spouse_occupation\":\"House Wife\",\"spouse_mobile\":\"0183777777\",\"spouse_designation\":null,\"spouse_home_district\":\"1\",\"spouse_organization\":null,\"spouse_address\":\"Dhaka\"}', '[{\"childName\":\"Salma Akther\",\"childSex\":\"2\",\"child_birth_date\":\"01-04-2019\",\"sorting\":1,\"created_by\":1,\"created_time\":\"2019-04-29 05:42:51\"}]', '[{\"promotion_designation\":\"12\",\"increment_date\":\"01-04-2019\",\"go_date\":\"30-04-2019\",\"nature_increment\":null,\"pay_scale\":\"2015\",\"sorting\":1,\"created_by\":1,\"created_time\":\"2019-04-29 05:43:16\"}]', '[{\"organigation\":\"Dhaka University\",\"post\":\"Manager\",\"office_address\":\"Dhaka\",\"department\":\"CSE\",\"job_from_date\":\"08-04-2019\",\"job_to_date\":\"30-04-2019\",\"job_payscale\":\"2015\",\"sorting\":1,\"created_by\":1,\"created_time\":\"2019-04-29 05:44:02\"}]', '{\"emergencey_contact_person\":\"Md. Omar Faruk\",\"relation_contact_person\":\"Brother\",\"emergency_contact_mobile\":\"01839707645\",\"emergency_contact_email\":\"shohag@gmail.com\",\"emergency_contact_address\":\"Dhaka\"}', NULL, NULL, 1, '2019-04-28 23:46:30', 1, '', NULL, NULL, NULL),
(3, 201903010001, '[{\"degree_name\":\"1\",\"major_subject\":\"2\",\"institution\":\"Comilla Board\",\"passing_year\":\"2010\",\"result\":\"1st Class\",\"cgpa\":null,\"sorting\":1,\"created_by\":1,\"created_time\":\"2019-03-31 17:42:38\"},{\"degree_name\":\"2\",\"major_subject\":\"15\",\"institution\":\"Feni Computer Institute\",\"passing_year\":\"2014\",\"result\":null,\"cgpa\":\"3.40\",\"sorting\":2,\"created_by\":1,\"created_time\":\"2019-03-31 17:42:38\"}]', '[{\"training_type\":\"1\",\"training_title\":\"IDB\",\"institute_name\":\"BD News\",\"from_date\":\"30-03-2019\",\"to_date\":\"30-03-2019\",\"sorting\":1,\"created_by\":1,\"created_time\":\"2019-03-30 07:54:38\"},{\"training_type\":\"2\",\"training_title\":\"Hello BD\",\"institute_name\":\"BDD\",\"from_date\":\"21-03-2019\",\"to_date\":\"21-03-2019\",\"sorting\":2,\"created_by\":1,\"created_time\":\"2019-03-30 07:54:38\"}]', '{\"spouse_name\":\"ss\",\"spouse_occupation\":\"2\",\"spouse_mobile\":\"22\",\"spouse_designation\":\"2\",\"spouse_home_district\":\"1\",\"spouse_organization\":\"2\",\"spouse_address\":\"2\"}', '[{\"childName\":\"22\",\"childSex\":\"2\",\"child_birth_date\":\"13-03-2019\",\"sorting\":1,\"created_by\":1,\"created_time\":\"2019-03-30 10:39:12\"}]', '[{\"promotion_designation\":\"12\",\"increment_date\":\"30-03-2019\",\"go_date\":\"30-03-2019\",\"nature_increment\":\"33\",\"pay_scale\":\"33\",\"sorting\":1,\"created_by\":null,\"created_time\":\"2019-03-30 19:27:52\"},{\"promotion_designation\":\"12\",\"increment_date\":\"30-03-2019\",\"go_date\":\"30-03-2019\",\"nature_increment\":\"33\",\"pay_scale\":\"333\",\"sorting\":2,\"created_by\":null,\"created_time\":\"2019-03-30 19:27:52\"}]', '[{\"organigation\":\"w\",\"post\":\"s\",\"office_address\":\"d\",\"department\":\"d\",\"job_from_date\":\"14-03-2019\",\"job_to_date\":\"12-03-2019\",\"job_payscale\":null,\"sorting\":1,\"created_by\":1,\"created_time\":\"2019-03-30 19:29:24\"},{\"organigation\":\"s\",\"post\":\"sw\",\"office_address\":\"sw\",\"department\":\"sw\",\"job_from_date\":\"12-03-2019\",\"job_to_date\":\"25-03-2019\",\"job_payscale\":\"s\",\"sorting\":2,\"created_by\":1,\"created_time\":\"2019-03-30 19:29:24\"},{\"organigation\":\"sw\",\"post\":\"s\",\"office_address\":\"s\",\"department\":\"s\",\"job_from_date\":\"20-03-2019\",\"job_to_date\":\"12-03-2019\",\"job_payscale\":\"ss\",\"sorting\":3,\"created_by\":1,\"created_time\":\"2019-03-30 19:29:24\"}]', '{\"emergencey_contact_person\":\"d3\",\"relation_contact_person\":\"x333\",\"emergency_contact_mobile\":\"333\",\"emergency_contact_email\":\"x3\",\"emergency_contact_address\":\"xx3\"}', '{\"reason_of_resignation\":\"22\",\"resignation_date\":\"06-03-2019\",\"new_work_place\":\"dd\",\"new_work_place_address\":\"d\",\"comments_employee\":\"d\",\"comments_authority\":\"d\"}', '{\"employee_action\":\"1\",\"punishment_date\":\"30-03-2019\",\"punishment\":\"d dd dd\",\"remarks\":\"d\"}', 1, '2019-03-31 11:42:38', 1, '', NULL, NULL, NULL),
(4, 201903010002, '[{\"degree_name\":\"1\",\"major_subject\":\"2\",\"institution\":\"Comilla Board\",\"passing_year\":\"2010\",\"result\":\"1st Class\",\"cgpa\":null,\"sorting\":1,\"created_by\":1,\"created_time\":\"2019-03-31 17:42:38\"},{\"degree_name\":\"2\",\"major_subject\":\"15\",\"institution\":\"Feni Computer Institute\",\"passing_year\":\"2014\",\"result\":null,\"cgpa\":\"3.40\",\"sorting\":2,\"created_by\":1,\"created_time\":\"2019-03-31 17:42:38\"}]', '[{\"training_type\":\"1\",\"training_title\":\"IDB\",\"institute_name\":\"BD News\",\"from_date\":\"30-03-2019\",\"to_date\":\"30-03-2019\",\"sorting\":1,\"created_by\":1,\"created_time\":\"2019-03-30 07:54:38\"},{\"training_type\":\"2\",\"training_title\":\"Hello BD\",\"institute_name\":\"BDD\",\"from_date\":\"21-03-2019\",\"to_date\":\"21-03-2019\",\"sorting\":2,\"created_by\":1,\"created_time\":\"2019-03-30 07:54:38\"}]', '{\"spouse_name\":\"ss\",\"spouse_occupation\":\"2\",\"spouse_mobile\":\"22\",\"spouse_designation\":\"2\",\"spouse_home_district\":\"1\",\"spouse_organization\":\"2\",\"spouse_address\":\"2\"}', '[{\"childName\":\"22\",\"childSex\":\"2\",\"child_birth_date\":\"13-03-2019\",\"sorting\":1,\"created_by\":1,\"created_time\":\"2019-03-30 10:39:12\"}]', '[{\"promotion_designation\":\"12\",\"increment_date\":\"30-03-2019\",\"go_date\":\"30-03-2019\",\"nature_increment\":\"33\",\"pay_scale\":\"33\",\"sorting\":1,\"created_by\":null,\"created_time\":\"2019-03-30 19:27:52\"},{\"promotion_designation\":\"12\",\"increment_date\":\"30-03-2019\",\"go_date\":\"30-03-2019\",\"nature_increment\":\"33\",\"pay_scale\":\"333\",\"sorting\":2,\"created_by\":null,\"created_time\":\"2019-03-30 19:27:52\"}]', '[{\"organigation\":\"w\",\"post\":\"s\",\"office_address\":\"d\",\"department\":\"d\",\"job_from_date\":\"14-03-2019\",\"job_to_date\":\"12-03-2019\",\"job_payscale\":null,\"sorting\":1,\"created_by\":1,\"created_time\":\"2019-03-30 19:29:24\"},{\"organigation\":\"s\",\"post\":\"sw\",\"office_address\":\"sw\",\"department\":\"sw\",\"job_from_date\":\"12-03-2019\",\"job_to_date\":\"25-03-2019\",\"job_payscale\":\"s\",\"sorting\":2,\"created_by\":1,\"created_time\":\"2019-03-30 19:29:24\"},{\"organigation\":\"sw\",\"post\":\"s\",\"office_address\":\"s\",\"department\":\"s\",\"job_from_date\":\"20-03-2019\",\"job_to_date\":\"12-03-2019\",\"job_payscale\":\"ss\",\"sorting\":3,\"created_by\":1,\"created_time\":\"2019-03-30 19:29:24\"}]', '{\"emergencey_contact_person\":\"d3\",\"relation_contact_person\":\"x333\",\"emergency_contact_mobile\":\"333\",\"emergency_contact_email\":\"x3\",\"emergency_contact_address\":\"xx3\"}', '{\"reason_of_resignation\":\"22\",\"resignation_date\":\"06-03-2019\",\"new_work_place\":\"dd\",\"new_work_place_address\":\"d\",\"comments_employee\":\"d\",\"comments_authority\":\"d\"}', '{\"employee_action\":\"1\",\"punishment_date\":\"30-03-2019\",\"punishment\":\"d dd dd\",\"remarks\":\"d\"}', 1, '2019-03-31 11:42:38', 1, '', NULL, NULL, NULL),
(5, 201906010005, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fiscal_year`
--

CREATE TABLE `fiscal_year` (
  `id` mediumint(6) UNSIGNED NOT NULL,
  `title` varchar(40) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL COMMENT '0 = delete,  1 = active, previous, 3 = next, ',
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fiscal_year`
--

INSERT INTO `fiscal_year` (`id`, `title`, `start_date`, `end_date`, `is_active`, `created_by`, `created_at`, `created_ip`, `updated_by`, `updated_at`, `updated_ip`) VALUES
(1, '2019', '2019-01-01', '2019-12-31', 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `land_infos`
--

CREATE TABLE `land_infos` (
  `id` int(11) UNSIGNED NOT NULL,
  `land_no` varchar(20) NOT NULL,
  `station_id` mediumint(6) UNSIGNED DEFAULT NULL,
  `location` varchar(50) NOT NULL,
  `details` varchar(500) NOT NULL,
  `khotian_no` varchar(50) DEFAULT NULL,
  `dag_no` varchar(50) NOT NULL,
  `mouza_no` varchar(50) DEFAULT NULL,
  `zer_no` varchar(50) DEFAULT NULL,
  `last_date_tax` date DEFAULT NULL,
  `land_quantity` decimal(10,2) NOT NULL,
  `is_found_case` tinyint(1) DEFAULT NULL COMMENT '1 = No, 2 = Yes ',
  `case_details` varchar(500) DEFAULT NULL,
  `case_last_update` varchar(500) DEFAULT NULL,
  `case_status` tinyint(4) DEFAULT NULL COMMENT '1 = pending, 2 = running, 3 = complete',
  `is_active` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '0 = delete, 1 = active, 2 = inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `land_infos`
--

INSERT INTO `land_infos` (`id`, `land_no`, `station_id`, `location`, `details`, `khotian_no`, `dag_no`, `mouza_no`, `zer_no`, `last_date_tax`, `land_quantity`, `is_found_case`, `case_details`, `case_last_update`, `case_status`, `is_active`, `created_at`, `created_by`, `created_ip`, `updated_at`, `updated_by`, `updated_ip`) VALUES
(1, '0001002', 1, 'Dhaka', 'Dhaka 300 feet', '01010', '2001', 'dhaka', '2333', '2019-04-12', '22.00', 2, 'Case Details informatin', 'On going project', 1, 1, '2019-04-28 23:16:44', 1, '::1', '2019-04-28 23:16:44', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_11_28_155128_create_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_openings`
--

CREATE TABLE `monthly_openings` (
  `id` int(11) NOT NULL,
  `fiscal_year_id` mediumint(6) UNSIGNED DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `modify_last_date` date DEFAULT NULL,
  `sorting` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '3' COMMENT '0 = delete, 1 = running, 2 = previous, 3 = next  ',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_ip` varchar(15) NOT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `monthly_openings`
--

INSERT INTO `monthly_openings` (`id`, `fiscal_year_id`, `title`, `start_date`, `end_date`, `modify_last_date`, `sorting`, `status`, `created_by`, `created_at`, `created_ip`, `updated_by`, `updated_at`, `updated_ip`) VALUES
(1, 1, 'January - 2019', '2019-01-01', '2019-01-31', '2019-02-10', 1, 2, 1, '2019-04-12 06:16:26', '::1', NULL, '2019-04-12 06:16:26', NULL),
(2, 1, 'Febuary - 2019', '2019-02-01', '2019-02-28', '2019-03-10', 2, 2, 1, '2019-05-14 23:40:38', '::1', NULL, '2019-05-14 23:40:38', NULL),
(3, 1, 'March- 2019', '2019-03-01', '2019-03-31', '2019-04-10', 3, 1, 1, '2019-05-14 23:40:30', '::1', NULL, '2019-05-14 23:40:30', NULL),
(6, 1, 'April-2019', '2019-04-01', '2019-04-30', '2019-05-10', 4, 3, 1, '2019-04-07 05:25:03', '::1', NULL, '2018-11-12 04:38:37', NULL),
(7, 1, 'May-2019', '2019-05-01', '2019-05-31', '2019-06-10', 5, 3, 1, '2019-04-07 05:25:10', '::1', NULL, '2019-02-28 09:31:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_infos`
--

CREATE TABLE `product_infos` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `ctg_id` mediumint(6) UNSIGNED DEFAULT NULL,
  `sub_ctg_id` mediumint(6) UNSIGNED DEFAULT NULL,
  `unit_id` int(11) UNSIGNED DEFAULT NULL,
  `product_code` varchar(20) DEFAULT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '0 = delete, 1 = active, 2 = inactive',
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_infos`
--

INSERT INTO `product_infos` (`id`, `name`, `ctg_id`, `sub_ctg_id`, `unit_id`, `product_code`, `is_active`, `created_by`, `created_at`, `created_ip`, `updated_by`, `updated_at`, `updated_ip`) VALUES
(1, 'Computer-cpu', 54, 55, 21, '190266', 1, 1, '2019-04-14 02:11:16', '::1', 1, '2019-04-14 02:16:31', '::1'),
(2, 'Desk Table', 53, 58, 21, '197137', 1, 1, '2019-04-24 05:21:41', '::1', 1, '2019-04-24 05:21:55', '::1'),
(3, 'Computer Chair', 53, 57, 21, '834901', 1, 1, '2019-04-24 05:22:19', '::1', NULL, '2019-04-24 05:22:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_stock_infos`
--

CREATE TABLE `product_stock_infos` (
  `id` int(11) UNSIGNED NOT NULL,
  `station_id` mediumint(6) UNSIGNED DEFAULT NULL,
  `product_id` int(11) UNSIGNED DEFAULT NULL,
  `stock_code` varchar(150) DEFAULT NULL,
  `department` int(11) UNSIGNED DEFAULT NULL,
  `product_reference` varchar(120) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `warranty_count` varchar(5) DEFAULT NULL,
  `warranty_Info` varchar(10) DEFAULT NULL,
  `lifetime_count` varchar(5) DEFAULT NULL,
  `product_life_time_info` varchar(10) DEFAULT NULL,
  `room_no` varchar(50) DEFAULT NULL,
  `is_maintance` tinyint(4) DEFAULT NULL COMMENT '1 =No, 2 = Yes',
  `maintance_details` varchar(200) DEFAULT NULL,
  `product_user_info` varchar(80) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 = stock_out, 1 = active, 2 = inactive',
  `stock_out_date` date DEFAULT NULL,
  `stock_out_reason` varchar(200) DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_stock_infos`
--

INSERT INTO `product_stock_infos` (`id`, `station_id`, `product_id`, `stock_code`, `department`, `product_reference`, `purchase_date`, `warranty_count`, `warranty_Info`, `lifetime_count`, `product_life_time_info`, `room_no`, `is_maintance`, `maintance_details`, `product_user_info`, `is_active`, `stock_out_date`, `stock_out_reason`, `created_by`, `created_at`, `created_ip`, `updated_by`, `updated_at`, `updated_ip`) VALUES
(2, 1, 1, '190100001', NULL, 's', '2019-04-16', '2', 'Months', NULL, 'N/A', NULL, 1, NULL, NULL, 1, NULL, NULL, 1, '2019-04-16 06:15:11', '::1', 1, '2019-04-17 01:37:32', '::1'),
(3, 1, 1, '190100002', NULL, '1', '2019-04-16', '1', 'Years', '6', 'Months', NULL, 2, 'shohag yes', '22', 1, NULL, NULL, 1, '2019-04-16 15:32:42', '::1', 1, '2019-04-24 03:32:09', '::1'),
(4, 1, 1, '190100003', NULL, '1', '2019-04-16', NULL, 'N/A', '5', 'Months', 'd', 2, 'ff', '22', 1, NULL, NULL, 1, '2019-04-16 15:32:54', '::1', 1, '2019-04-24 03:32:01', '::1'),
(5, 1, 2, '190100004', NULL, '2', '2019-04-17', '2', 'Years', '2', 'Months', NULL, 2, 'sss', NULL, 1, NULL, NULL, 1, '2019-04-17 01:38:02', '::1', 1, '2019-04-24 05:22:50', '::1'),
(6, 1, 1, '190100005', NULL, '3', '2019-04-17', '2', 'Months', '1', 'Days', '2', 2, 'sdfdsf', '2', 0, NULL, 'ss', 1, '2019-04-17 01:39:01', '::1', 1, '2019-04-17 03:52:13', '::1'),
(7, 1, 3, '190100005', NULL, '3', '2019-04-20', '3', 'Days', '3', 'Days', '33', 1, NULL, '33', 1, NULL, NULL, 1, '2019-04-20 05:57:12', '::1', 1, '2019-04-24 05:22:38', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `program_artist_info`
--

CREATE TABLE `program_artist_info` (
  `id` int(11) UNSIGNED NOT NULL,
  `station_id` mediumint(6) UNSIGNED DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `father_name` varchar(150) DEFAULT NULL,
  `mother_name` varchar(150) DEFAULT NULL,
  `is_husband_wife` tinyint(1) UNSIGNED DEFAULT NULL COMMENT '1=husband, 2= wife',
  `husband_wife_name` varchar(120) DEFAULT NULL,
  `nationality` mediumint(6) UNSIGNED DEFAULT NULL,
  `gender` tinyint(1) UNSIGNED DEFAULT NULL COMMENT '1=male, 2=female,3=others',
  `marital_status` tinyint(1) UNSIGNED DEFAULT NULL COMMENT '1=married, 2=unmarried',
  `address` varchar(500) DEFAULT NULL,
  `artist_type` tinyint(4) UNSIGNED DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `national_id` varchar(25) DEFAULT NULL,
  `song_ctg` int(11) UNSIGNED DEFAULT NULL,
  `artist_grade` tinyint(1) UNSIGNED DEFAULT NULL COMMENT '1=ক, 2= খ, 3=গ',
  `enlisted_date` text,
  `enlisted_last_date` date DEFAULT NULL,
  `educational_info` varchar(500) NOT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '0 = delete, 1 = active, 2 = inactive ',
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `program_artist_info`
--

INSERT INTO `program_artist_info` (`id`, `station_id`, `entry_date`, `name`, `father_name`, `mother_name`, `is_husband_wife`, `husband_wife_name`, `nationality`, `gender`, `marital_status`, `address`, `artist_type`, `mobile`, `email`, `national_id`, `song_ctg`, `artist_grade`, `enlisted_date`, `enlisted_last_date`, `educational_info`, `is_active`, `created_by`, `created_time`, `created_ip`) VALUES
(1, 1, '2019-06-19', 'Kamal Udin', 'Abdur Rahaman', 'Kakina Begum', 1, '2', NULL, 1, 1, NULL, 2, '01839707645', '2', '2', 14, 2, '2019-06-19', '2019-06-29', '222', 1, 1, '2019-06-18 23:02:37', '::1'),
(2, 1, '2019-06-19', 'Jamal Uddin', 'Kamal Uddin', 'Rahima Begum', 1, '2', NULL, 1, 1, NULL, 2, '01839707646', '2', '2', 14, 2, '2019-06-19', '2019-06-29', '222', 1, 1, '2019-06-18 23:02:42', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `program_schedule_infos`
--

CREATE TABLE `program_schedule_infos` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(300) NOT NULL,
  `program_ctg` varchar(80) NOT NULL,
  `internal_artist` varchar(80) DEFAULT NULL,
  `external_artist` varchar(80) DEFAULT NULL,
  `schedule_date_time` datetime DEFAULT NULL,
  `remarks` varchar(300) DEFAULT NULL,
  `record_file` varchar(150) DEFAULT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '0 = delete, 1 = schedule, 2 = record, 3 = play, 4 = archieve',
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `program_schedule_infos`
--

INSERT INTO `program_schedule_infos` (`id`, `title`, `program_ctg`, `internal_artist`, `external_artist`, `schedule_date_time`, `remarks`, `record_file`, `status`, `created_by`, `created_at`, `created_ip`, `updated_by`, `updated_at`, `updated_ip`) VALUES
(1, 'রবীন্দ্র সংগীত', '', NULL, NULL, '2019-03-20 12:38:30', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schedule_information`
--

CREATE TABLE `schedule_information` (
  `id` int(11) NOT NULL,
  `type` tinyint(1) UNSIGNED DEFAULT NULL COMMENT '1 = program, 2 = news',
  `date` date DEFAULT NULL,
  `station_id` mediumint(6) UNSIGNED DEFAULT NULL,
  `day_id` tinyint(1) UNSIGNED DEFAULT NULL,
  `time_id` tinyint(1) UNSIGNED DEFAULT NULL,
  `is_recorded` tinyint(1) UNSIGNED DEFAULT NULL COMMENT '1 = recorded_item',
  `is_overwrited` tinyint(1) UNSIGNED DEFAULT NULL,
  `overwrited_details` varchar(500) DEFAULT NULL,
  `is_active` tinyint(1) UNSIGNED DEFAULT NULL COMMENT '0 =delete, 1 = active, 2 = inactive',
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `setup_artist_grade`
--

CREATE TABLE `setup_artist_grade` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `title_en` varchar(30) NOT NULL,
  `postition` tinyint(3) UNSIGNED DEFAULT NULL,
  `type` tinyint(1) UNSIGNED DEFAULT NULL COMMENT '1 = Program, 2 = News '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setup_artist_grade`
--

INSERT INTO `setup_artist_grade` (`id`, `title`, `title_en`, `postition`, `type`) VALUES
(1, 'বিশেষ', 'Special', 1, 1),
(2, 'ক', 'A', 2, 1),
(3, 'খ', 'B', 3, 1),
(4, 'গ', 'C', 4, 1),
(5, 'ক', 'A', 1, 2),
(6, 'খ', 'B', 2, 2),
(7, 'গ', 'C', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `setup_artist_rate_chart`
--

CREATE TABLE `setup_artist_rate_chart` (
  `id` int(11) UNSIGNED NOT NULL,
  `station_id` mediumint(6) DEFAULT NULL,
  `ctg_id` int(11) UNSIGNED DEFAULT NULL,
  `grade_id` tinyint(3) UNSIGNED DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `is_active` tinyint(1) UNSIGNED DEFAULT '1' COMMENT '0 = delete, 1 = active, 2= inactive',
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setup_artist_rate_chart`
--

INSERT INTO `setup_artist_rate_chart` (`id`, `station_id`, `ctg_id`, `grade_id`, `description`, `amount`, `is_active`, `created_by`, `created_time`, `created_ip`, `updated_by`, `updated_time`, `updated_ip`) VALUES
(1, NULL, 14, 2, NULL, '22.00', 1, 1, '2019-06-29 17:55:23', '::1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setup_days`
--

CREATE TABLE `setup_days` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `title_en` varchar(20) DEFAULT NULL,
  `title_bn` varchar(20) DEFAULT NULL,
  `position` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setup_days`
--

INSERT INTO `setup_days` (`id`, `title_en`, `title_bn`, `position`) VALUES
(1, 'Saturday', 'শনিবার ', 1),
(2, 'Sunday', 'রবিবার ', 2),
(3, 'Monday', 'সোমবার', 3),
(4, 'Tuesday', 'মঙ্গলবার ', 4),
(5, 'Wednesday', 'বুধবার ', 5),
(6, 'Thursday', 'বৃহস্পতিবার ', 6),
(7, 'Friday', 'শুক্রবার', 7);

-- --------------------------------------------------------

--
-- Table structure for table `setup_fixed_time_point`
--

CREATE TABLE `setup_fixed_time_point` (
  `id` int(11) UNSIGNED NOT NULL,
  `day_id` tinyint(3) UNSIGNED DEFAULT NULL,
  `odivision_id` tinyint(3) UNSIGNED DEFAULT NULL,
  `station_id` mediumint(6) UNSIGNED DEFAULT NULL,
  `fixed_time` time DEFAULT NULL,
  `program_title` varchar(200) DEFAULT NULL,
  `is_recorded` tinyint(1) UNSIGNED DEFAULT NULL COMMENT '1 = recorded, 2 = live',
  `type` tinyint(1) UNSIGNED DEFAULT NULL COMMENT '1 = program , 2 = news ',
  `display_position` int(11) UNSIGNED DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `setup_odivision`
--

CREATE TABLE `setup_odivision` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `schedule_time` varchar(60) DEFAULT NULL,
  `position` tinyint(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setup_odivision`
--

INSERT INTO `setup_odivision` (`id`, `title`, `schedule_time`, `position`) VALUES
(1, '১ম পালা', 'ভোর ৬.০০- দুপুর ১২.০০', 1),
(2, '২য় পালা', 'দুপুর ১২.০০- সন্ধ্যা ৬.০০', 2),
(3, '৩য় পালা', 'সন্ধ্যা  ৬.০০- রাত ১২.০০', 3),
(4, '৪র্থ পালা', 'রাত ১২.০০- ভোর ৬.০০', 4);

-- --------------------------------------------------------

--
-- Table structure for table `sms_history`
--

CREATE TABLE `sms_history` (
  `id` int(11) UNSIGNED NOT NULL,
  `customer_id` int(11) UNSIGNED DEFAULT NULL,
  `mobile_number` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `msg` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `send_status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1=pending, 2=send comple, 3 = Invalid Number',
  `success_status` tinyint(1) UNSIGNED DEFAULT NULL COMMENT '1=success, 2=fail, 3 = Invalid Number, NULL= Not Send',
  `ins_date` datetime NOT NULL,
  `ins_by` int(11) UNSIGNED DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sms_history`
--

INSERT INTO `sms_history` (`id`, `customer_id`, `mobile_number`, `msg`, `send_status`, `success_status`, `ins_date`, `ins_by`, `update_at`) VALUES
(1, 52, '01711170762', 'Your verification code is: 005687 Verification code validate 2019-01-25 17:58:03Thanks to Fab technology.', 1, NULL, '2019-01-25 12:58:03', NULL, NULL),
(2, 52, '01711170762', 'Your verification code is: 688542 Verification code validate 2019-01-25 17:59:08Thanks to Fab technology.', 1, NULL, '2019-01-25 12:59:08', NULL, NULL),
(3, 52, '01711170762', 'Your verification code is: 816109 Verification code validate 2019-01-25 18:04:26Thanks to Fab technology.', 1, NULL, '2019-01-25 13:04:26', NULL, NULL),
(4, 52, '01711170762', 'Your verification code is: 817355 Verification code validate 2019-01-25 19:34:46Thanks to Fab technology.', 1, NULL, '2019-01-25 14:34:46', NULL, NULL),
(5, 52, '01711170762', 'Your verification code is: 520109 Verification code validate 2019-01-25 19:37:10Thanks to Fab technology.', 1, NULL, '2019-01-25 14:37:10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `upazilas`
--

CREATE TABLE `upazilas` (
  `id` int(2) UNSIGNED NOT NULL,
  `district_id` int(2) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `bn_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `upazilas`
--

INSERT INTO `upazilas` (`id`, `district_id`, `name`, `bn_name`) VALUES
(1, 34, 'Amtali Upazila', 'আমতলী'),
(2, 34, 'Bamna Upazila', 'বামনা'),
(3, 34, 'Barguna Sadar Upazila', 'বরগুনা সদর'),
(4, 34, 'Betagi Upazila', 'বেতাগি'),
(5, 34, 'Patharghata Upazila', 'পাথরঘাটা'),
(6, 34, 'Taltali Upazila', 'তালতলী'),
(7, 35, 'Muladi Upazila', 'মুলাদি'),
(8, 35, 'Babuganj Upazila', 'বাবুগঞ্জ'),
(9, 35, 'Agailjhara Upazila', 'আগাইলঝরা'),
(10, 35, 'Barisal Sadar Upazila', 'বরিশাল সদর'),
(11, 35, 'Bakerganj Upazila', 'বাকেরগঞ্জ'),
(12, 35, 'Banaripara Upazila', 'বানাড়িপারা'),
(13, 35, 'Gaurnadi Upazila', 'গৌরনদী'),
(14, 35, 'Hizla Upazila', 'হিজলা'),
(15, 35, 'Mehendiganj Upazila', 'মেহেদিগঞ্জ '),
(16, 35, 'Wazirpur Upazila', 'ওয়াজিরপুর'),
(17, 36, 'Bhola Sadar Upazila', 'ভোলা সদর'),
(18, 36, 'Burhanuddin Upazila', 'বুরহানউদ্দিন'),
(19, 36, 'Char Fasson Upazila', 'চর ফ্যাশন'),
(20, 36, 'Daulatkhan Upazila', 'দৌলতখান'),
(21, 36, 'Lalmohan Upazila', 'লালমোহন'),
(22, 36, 'Manpura Upazila', 'মনপুরা'),
(23, 36, 'Tazumuddin Upazila', 'তাজুমুদ্দিন'),
(24, 37, 'Jhalokati Sadar Upazila', 'ঝালকাঠি সদর'),
(25, 37, 'Kathalia Upazila', 'কাঁঠালিয়া'),
(26, 37, 'Nalchity Upazila', 'নালচিতি'),
(27, 37, 'Rajapur Upazila', 'রাজাপুর'),
(28, 38, 'Bauphal Upazila', 'বাউফল'),
(29, 38, 'Dashmina Upazila', 'দশমিনা'),
(30, 38, 'Galachipa Upazila', 'গলাচিপা'),
(31, 38, 'Kalapara Upazila', 'কালাপারা'),
(32, 38, 'Mirzaganj Upazila', 'মির্জাগঞ্জ '),
(33, 38, 'Patuakhali Sadar Upazila', 'পটুয়াখালী সদর'),
(34, 38, 'Dumki Upazila', 'ডুমকি'),
(35, 38, 'Rangabali Upazila', 'রাঙ্গাবালি'),
(36, 39, 'Bhandaria', 'ভ্যান্ডারিয়া'),
(37, 39, 'Kaukhali', 'কাউখালি'),
(38, 39, 'Mathbaria', 'মাঠবাড়িয়া'),
(39, 39, 'Nazirpur', 'নাজিরপুর'),
(40, 39, 'Nesarabad', 'নেসারাবাদ'),
(41, 39, 'Pirojpur Sadar', 'পিরোজপুর সদর'),
(42, 39, 'Zianagar', 'জিয়ানগর'),
(43, 40, 'Bandarban Sadar', 'বান্দরবন সদর'),
(44, 40, 'Thanchi', 'থানচি'),
(45, 40, 'Lama', 'লামা'),
(46, 40, 'Naikhongchhari', 'নাইখংছড়ি '),
(47, 40, 'Ali kadam', 'আলী কদম'),
(48, 40, 'Rowangchhari', 'রউয়াংছড়ি '),
(49, 40, 'Ruma', 'রুমা'),
(50, 41, 'Brahmanbaria Sadar Upazila', 'ব্রাহ্মণবাড়িয়া সদর'),
(51, 41, 'Ashuganj Upazila', 'আশুগঞ্জ'),
(52, 41, 'Nasirnagar Upazila', 'নাসির নগর'),
(53, 41, 'Nabinagar Upazila', 'নবীনগর'),
(54, 41, 'Sarail Upazila', 'সরাইল'),
(55, 41, 'Shahbazpur Town', 'শাহবাজপুর টাউন'),
(56, 41, 'Kasba Upazila', 'কসবা'),
(57, 41, 'Akhaura Upazila', 'আখাউরা'),
(58, 41, 'Bancharampur Upazila', 'বাঞ্ছারামপুর'),
(59, 41, 'Bijoynagar Upazila', 'বিজয় নগর'),
(60, 42, 'Chandpur Sadar', 'চাঁদপুর সদর'),
(61, 42, 'Faridganj', 'ফরিদগঞ্জ'),
(62, 42, 'Haimchar', 'হাইমচর'),
(63, 42, 'Haziganj', 'হাজীগঞ্জ'),
(64, 42, 'Kachua', 'কচুয়া'),
(65, 42, 'Matlab Uttar', 'মতলব উত্তর'),
(66, 42, 'Matlab Dakkhin', 'মতলব দক্ষিণ'),
(67, 42, 'Shahrasti', 'শাহরাস্তি'),
(68, 43, 'Anwara Upazila', 'আনোয়ারা'),
(69, 43, 'Banshkhali Upazila', 'বাশখালি'),
(70, 43, 'Boalkhali Upazila', 'বোয়ালখালি'),
(71, 43, 'Chandanaish Upazila', 'চন্দনাইশ'),
(72, 43, 'Fatikchhari Upazila', 'ফটিকছড়ি'),
(73, 43, 'Hathazari Upazila', 'হাঠহাজারী'),
(74, 43, 'Lohagara Upazila', 'লোহাগারা'),
(75, 43, 'Mirsharai Upazila', 'মিরসরাই'),
(76, 43, 'Patiya Upazila', 'পটিয়া'),
(77, 43, 'Rangunia Upazila', 'রাঙ্গুনিয়া'),
(78, 43, 'Raozan Upazila', 'রাউজান'),
(79, 43, 'Sandwip Upazila', 'সন্দ্বীপ'),
(80, 43, 'Satkania Upazila', 'সাতকানিয়া'),
(81, 43, 'Sitakunda Upazila', 'সীতাকুণ্ড'),
(82, 44, 'Barura Upazila', 'বড়ুরা'),
(83, 44, 'Brahmanpara Upazila', 'ব্রাহ্মণপাড়া'),
(84, 44, 'Burichong Upazila', 'বুড়িচং'),
(85, 44, 'Chandina Upazila', 'চান্দিনা'),
(86, 44, 'Chauddagram Upazila', 'চৌদ্দগ্রাম'),
(87, 44, 'Daudkandi Upazila', 'দাউদকান্দি'),
(88, 44, 'Debidwar Upazila', 'দেবীদ্বার'),
(89, 44, 'Homna Upazila', 'হোমনা'),
(90, 44, 'Comilla Sadar Upazila', 'কুমিল্লা সদর'),
(91, 44, 'Laksam Upazila', 'লাকসাম'),
(92, 44, 'Monohorgonj Upazila', 'মনোহরগঞ্জ'),
(93, 44, 'Meghna Upazila', 'মেঘনা'),
(94, 44, 'Muradnagar Upazila', 'মুরাদনগর'),
(95, 44, 'Nangalkot Upazila', 'নাঙ্গালকোট'),
(96, 44, 'Comilla Sadar South Upazila', 'কুমিল্লা সদর দক্ষিণ'),
(97, 44, 'Titas Upazila', 'তিতাস'),
(98, 45, 'Chakaria Upazila', 'চকরিয়া'),
(100, 45, 'Cox\'s Bazar Sadar Upazila', 'কক্স বাজার সদর'),
(101, 45, 'Kutubdia Upazila', 'কুতুবদিয়া'),
(102, 45, 'Maheshkhali Upazila', 'মহেশখালী'),
(103, 45, 'Ramu Upazila', 'রামু'),
(104, 45, 'Teknaf Upazila', 'টেকনাফ'),
(105, 45, 'Ukhia Upazila', 'উখিয়া'),
(106, 45, 'Pekua Upazila', 'পেকুয়া'),
(107, 46, 'Feni Sadar', 'ফেনী সদর'),
(108, 46, 'Chagalnaiya', 'ছাগল নাইয়া'),
(109, 46, 'Daganbhyan', 'দাগানভিয়া'),
(110, 46, 'Parshuram', 'পরশুরাম'),
(111, 46, 'Fhulgazi', 'ফুলগাজি'),
(112, 46, 'Sonagazi', 'সোনাগাজি'),
(113, 47, 'Dighinala Upazila', 'দিঘিনালা '),
(114, 47, 'Khagrachhari Upazila', 'খাগড়াছড়ি'),
(115, 47, 'Lakshmichhari Upazila', 'লক্ষ্মীছড়ি'),
(116, 47, 'Mahalchhari Upazila', 'মহলছড়ি'),
(117, 47, 'Manikchhari Upazila', 'মানিকছড়ি'),
(118, 47, 'Matiranga Upazila', 'মাটিরাঙ্গা'),
(119, 47, 'Panchhari Upazila', 'পানছড়ি'),
(120, 47, 'Ramgarh Upazila', 'রামগড়'),
(121, 48, 'Lakshmipur Sadar Upazila', 'লক্ষ্মীপুর সদর'),
(122, 48, 'Raipur Upazila', 'রায়পুর'),
(123, 48, 'Ramganj Upazila', 'রামগঞ্জ'),
(124, 48, 'Ramgati Upazila', 'রামগতি'),
(125, 48, 'Komol Nagar Upazila', 'কমল নগর'),
(126, 49, 'Noakhali Sadar Upazila', 'নোয়াখালী সদর'),
(127, 49, 'Begumganj Upazila', 'বেগমগঞ্জ'),
(128, 49, 'Chatkhil Upazila', 'চাটখিল'),
(129, 49, 'Companyganj Upazila', 'কোম্পানীগঞ্জ'),
(130, 49, 'Shenbag Upazila', 'শেনবাগ'),
(131, 49, 'Hatia Upazila', 'হাতিয়া'),
(132, 49, 'Kobirhat Upazila', 'কবিরহাট '),
(133, 49, 'Sonaimuri Upazila', 'সোনাইমুরি'),
(134, 49, 'Suborno Char Upazila', 'সুবর্ণ চর '),
(135, 50, 'Rangamati Sadar Upazila', 'রাঙ্গামাটি সদর'),
(136, 50, 'Belaichhari Upazila', 'বেলাইছড়ি'),
(137, 50, 'Bagaichhari Upazila', 'বাঘাইছড়ি'),
(138, 50, 'Barkal Upazila', 'বরকল'),
(139, 50, 'Juraichhari Upazila', 'জুরাইছড়ি'),
(140, 50, 'Rajasthali Upazila', 'রাজাস্থলি'),
(141, 50, 'Kaptai Upazila', 'কাপ্তাই'),
(142, 50, 'Langadu Upazila', 'লাঙ্গাডু'),
(143, 50, 'Nannerchar Upazila', 'নান্নেরচর '),
(144, 50, 'Kaukhali Upazila', 'কাউখালি'),
(145, 1, 'Dhamrai Upazila', 'ধামরাই'),
(146, 1, 'Dohar Upazila', 'দোহার'),
(147, 1, 'Keraniganj Upazila', 'কেরানীগঞ্জ'),
(148, 1, 'Nawabganj Upazila', 'নবাবগঞ্জ'),
(149, 1, 'Savar Upazila', 'সাভার'),
(150, 2, 'Faridpur Sadar Upazila', 'ফরিদপুর সদর'),
(151, 2, 'Boalmari Upazila', 'বোয়ালমারী'),
(152, 2, 'Alfadanga Upazila', 'আলফাডাঙ্গা'),
(153, 2, 'Madhukhali Upazila', 'মধুখালি'),
(154, 2, 'Bhanga Upazila', 'ভাঙ্গা'),
(155, 2, 'Nagarkanda Upazila', 'নগরকান্ড'),
(156, 2, 'Charbhadrasan Upazila', 'চরভদ্রাসন '),
(157, 2, 'Sadarpur Upazila', 'সদরপুর'),
(158, 2, 'Shaltha Upazila', 'শালথা'),
(159, 3, 'Gazipur Sadar-Joydebpur', 'গাজীপুর সদর'),
(160, 3, 'Kaliakior', 'কালিয়াকৈর'),
(161, 3, 'Kapasia', 'কাপাসিয়া'),
(162, 3, 'Sripur', 'শ্রীপুর'),
(163, 3, 'Kaliganj', 'কালীগঞ্জ'),
(164, 3, 'Tongi', 'টঙ্গি'),
(165, 4, 'Gopalganj Sadar Upazila', 'গোপালগঞ্জ সদর'),
(166, 4, 'Kashiani Upazila', 'কাশিয়ানি'),
(167, 4, 'Kotalipara Upazila', 'কোটালিপাড়া'),
(168, 4, 'Muksudpur Upazila', 'মুকসুদপুর'),
(169, 4, 'Tungipara Upazila', 'টুঙ্গিপাড়া'),
(170, 5, 'Dewanganj Upazila', 'দেওয়ানগঞ্জ'),
(171, 5, 'Baksiganj Upazila', 'বকসিগঞ্জ'),
(172, 5, 'Islampur Upazila', 'ইসলামপুর'),
(173, 5, 'Jamalpur Sadar Upazila', 'জামালপুর সদর'),
(174, 5, 'Madarganj Upazila', 'মাদারগঞ্জ'),
(175, 5, 'Melandaha Upazila', 'মেলানদাহা'),
(176, 5, 'Sarishabari Upazila', 'সরিষাবাড়ি '),
(177, 5, 'Narundi Police I.C', 'নারুন্দি'),
(178, 6, 'Astagram Upazila', 'অষ্টগ্রাম'),
(179, 6, 'Bajitpur Upazila', 'বাজিতপুর'),
(180, 6, 'Bhairab Upazila', 'ভৈরব'),
(181, 6, 'Hossainpur Upazila', 'হোসেনপুর '),
(182, 6, 'Itna Upazila', 'ইটনা'),
(183, 6, 'Karimganj Upazila', 'করিমগঞ্জ'),
(184, 6, 'Katiadi Upazila', 'কতিয়াদি'),
(185, 6, 'Kishoreganj Sadar Upazila', 'কিশোরগঞ্জ সদর'),
(186, 6, 'Kuliarchar Upazila', 'কুলিয়ারচর'),
(187, 6, 'Mithamain Upazila', 'মিঠামাইন'),
(188, 6, 'Nikli Upazila', 'নিকলি'),
(189, 6, 'Pakundia Upazila', 'পাকুন্ডা'),
(190, 6, 'Tarail Upazila', 'তাড়াইল'),
(191, 7, 'Madaripur Sadar', 'মাদারীপুর সদর'),
(192, 7, 'Kalkini', 'কালকিনি'),
(193, 7, 'Rajoir', 'রাজইর'),
(194, 7, 'Shibchar', 'শিবচর'),
(195, 8, 'Manikganj Sadar Upazila', 'মানিকগঞ্জ সদর'),
(196, 8, 'Singair Upazila', 'সিঙ্গাইর'),
(197, 8, 'Shibalaya Upazila', 'শিবালয়'),
(198, 8, 'Saturia Upazila', 'সাঠুরিয়া'),
(199, 8, 'Harirampur Upazila', 'হরিরামপুর'),
(200, 8, 'Ghior Upazila', 'ঘিওর'),
(201, 8, 'Daulatpur Upazila', 'দৌলতপুর'),
(202, 9, 'Lohajang Upazila', 'লোহাজং'),
(203, 9, 'Sreenagar Upazila', 'শ্রীনগর'),
(204, 9, 'Munshiganj Sadar Upazila', 'মুন্সিগঞ্জ সদর'),
(205, 9, 'Sirajdikhan Upazila', 'সিরাজদিখান'),
(206, 9, 'Tongibari Upazila', 'টঙ্গিবাড়ি'),
(207, 9, 'Gazaria Upazila', 'গজারিয়া'),
(208, 10, 'Bhaluka', 'ভালুকা'),
(209, 10, 'Trishal', 'ত্রিশাল'),
(210, 10, 'Haluaghat', 'হালুয়াঘাট'),
(211, 10, 'Muktagachha', 'মুক্তাগাছা'),
(212, 10, 'Dhobaura', 'ধবারুয়া'),
(213, 10, 'Fulbaria', 'ফুলবাড়িয়া'),
(214, 10, 'Gaffargaon', 'গফরগাঁও'),
(215, 10, 'Gauripur', 'গৌরিপুর'),
(216, 10, 'Ishwarganj', 'ঈশ্বরগঞ্জ'),
(217, 10, 'Mymensingh Sadar', 'ময়মনসিং সদর'),
(218, 10, 'Nandail', 'নন্দাইল'),
(219, 10, 'Phulpur', 'ফুলপুর'),
(220, 11, 'Araihazar Upazila', 'আড়াইহাজার'),
(221, 11, 'Sonargaon Upazila', 'সোনারগাঁও'),
(222, 11, 'Bandar', 'বান্দার'),
(223, 11, 'Naryanganj Sadar Upazila', 'নারায়ানগঞ্জ সদর'),
(224, 11, 'Rupganj Upazila', 'রূপগঞ্জ'),
(225, 11, 'Siddirgonj Upazila', 'সিদ্ধিরগঞ্জ'),
(226, 12, 'Belabo Upazila', 'বেলাবো'),
(227, 12, 'Monohardi Upazila', 'মনোহরদি'),
(228, 12, 'Narsingdi Sadar Upazila', 'নরসিংদী সদর'),
(229, 12, 'Palash Upazila', 'পলাশ'),
(230, 12, 'Raipura Upazila, Narsingdi', 'রায়পুর'),
(231, 12, 'Shibpur Upazila', 'শিবপুর'),
(232, 13, 'Kendua Upazilla', 'কেন্দুয়া'),
(233, 13, 'Atpara Upazilla', 'আটপাড়া'),
(234, 13, 'Barhatta Upazilla', 'বরহাট্টা'),
(235, 13, 'Durgapur Upazilla', 'দুর্গাপুর'),
(236, 13, 'Kalmakanda Upazilla', 'কলমাকান্দা'),
(237, 13, 'Madan Upazilla', 'মদন'),
(238, 13, 'Mohanganj Upazilla', 'মোহনগঞ্জ'),
(239, 13, 'Netrakona-S Upazilla', 'নেত্রকোনা সদর'),
(240, 13, 'Purbadhala Upazilla', 'পূর্বধলা'),
(241, 13, 'Khaliajuri Upazilla', 'খালিয়াজুরি'),
(242, 14, 'Baliakandi Upazila', 'বালিয়াকান্দি'),
(243, 14, 'Goalandaghat Upazila', 'গোয়ালন্দ ঘাট'),
(244, 14, 'Pangsha Upazila', 'পাংশা'),
(245, 14, 'Kalukhali Upazila', 'কালুখালি'),
(246, 14, 'Rajbari Sadar Upazila', 'রাজবাড়ি সদর'),
(247, 15, 'Shariatpur Sadar -Palong', 'শরীয়তপুর সদর '),
(248, 15, 'Damudya Upazila', 'দামুদিয়া'),
(249, 15, 'Naria Upazila', 'নড়িয়া'),
(250, 15, 'Jajira Upazila', 'জাজিরা'),
(251, 15, 'Bhedarganj Upazila', 'ভেদারগঞ্জ'),
(252, 15, 'Gosairhat Upazila', 'গোসাইর হাট '),
(253, 16, 'Jhenaigati Upazila', 'ঝিনাইগাতি'),
(254, 16, 'Nakla Upazila', 'নাকলা'),
(255, 16, 'Nalitabari Upazila', 'নালিতাবাড়ি'),
(256, 16, 'Sherpur Sadar Upazila', 'শেরপুর সদর'),
(257, 16, 'Sreebardi Upazila', 'শ্রীবরদি'),
(258, 17, 'Tangail Sadar Upazila', 'টাঙ্গাইল সদর'),
(259, 17, 'Sakhipur Upazila', 'সখিপুর'),
(260, 17, 'Basail Upazila', 'বসাইল'),
(261, 17, 'Madhupur Upazila', 'মধুপুর'),
(262, 17, 'Ghatail Upazila', 'ঘাটাইল'),
(263, 17, 'Kalihati Upazila', 'কালিহাতি'),
(264, 17, 'Nagarpur Upazila', 'নগরপুর'),
(265, 17, 'Mirzapur Upazila', 'মির্জাপুর'),
(266, 17, 'Gopalpur Upazila', 'গোপালপুর'),
(267, 17, 'Delduar Upazila', 'দেলদুয়ার'),
(268, 17, 'Bhuapur Upazila', 'ভুয়াপুর'),
(269, 17, 'Dhanbari Upazila', 'ধানবাড়ি'),
(270, 55, 'Bagerhat Sadar Upazila', 'বাগেরহাট সদর'),
(271, 55, 'Chitalmari Upazila', 'চিতলমাড়ি'),
(272, 55, 'Fakirhat Upazila', 'ফকিরহাট'),
(273, 55, 'Kachua Upazila', 'কচুয়া'),
(274, 55, 'Mollahat Upazila', 'মোল্লাহাট '),
(275, 55, 'Mongla Upazila', 'মংলা'),
(276, 55, 'Morrelganj Upazila', 'মরেলগঞ্জ'),
(277, 55, 'Rampal Upazila', 'রামপাল'),
(278, 55, 'Sarankhola Upazila', 'স্মরণখোলা'),
(279, 56, 'Damurhuda Upazila', 'দামুরহুদা'),
(280, 56, 'Chuadanga-S Upazila', 'চুয়াডাঙ্গা সদর'),
(281, 56, 'Jibannagar Upazila', 'জীবন নগর '),
(282, 56, 'Alamdanga Upazila', 'আলমডাঙ্গা'),
(283, 57, 'Abhaynagar Upazila', 'অভয়নগর'),
(284, 57, 'Keshabpur Upazila', 'কেশবপুর'),
(285, 57, 'Bagherpara Upazila', 'বাঘের পাড়া '),
(286, 57, 'Jessore Sadar Upazila', 'যশোর সদর'),
(287, 57, 'Chaugachha Upazila', 'চৌগাছা'),
(288, 57, 'Manirampur Upazila', 'মনিরামপুর '),
(289, 57, 'Jhikargachha Upazila', 'ঝিকরগাছা'),
(290, 57, 'Sharsha Upazila', 'সারশা'),
(291, 58, 'Jhenaidah Sadar Upazila', 'ঝিনাইদহ সদর'),
(292, 58, 'Maheshpur Upazila', 'মহেশপুর'),
(293, 58, 'Kaliganj Upazila', 'কালীগঞ্জ'),
(294, 58, 'Kotchandpur Upazila', 'কোট চাঁদপুর '),
(295, 58, 'Shailkupa Upazila', 'শৈলকুপা'),
(296, 58, 'Harinakunda Upazila', 'হাড়িনাকুন্দা'),
(297, 59, 'Terokhada Upazila', 'তেরোখাদা'),
(298, 59, 'Batiaghata Upazila', 'বাটিয়াঘাটা '),
(299, 59, 'Dacope Upazila', 'ডাকপে'),
(300, 59, 'Dumuria Upazila', 'ডুমুরিয়া'),
(301, 59, 'Dighalia Upazila', 'দিঘলিয়া'),
(302, 59, 'Koyra Upazila', 'কয়ড়া'),
(303, 59, 'Paikgachha Upazila', 'পাইকগাছা'),
(304, 59, 'Phultala Upazila', 'ফুলতলা'),
(305, 59, 'Rupsa Upazila', 'রূপসা'),
(306, 60, 'Kushtia Sadar', 'কুষ্টিয়া সদর'),
(307, 60, 'Kumarkhali', 'কুমারখালি'),
(308, 60, 'Daulatpur', 'দৌলতপুর'),
(309, 60, 'Mirpur', 'মিরপুর'),
(310, 60, 'Bheramara', 'ভেরামারা'),
(311, 60, 'Khoksa', 'খোকসা'),
(312, 61, 'Magura Sadar Upazila', 'মাগুরা সদর'),
(313, 61, 'Mohammadpur Upazila', 'মোহাম্মাদপুর'),
(314, 61, 'Shalikha Upazila', 'শালিখা'),
(315, 61, 'Sreepur Upazila', 'শ্রীপুর'),
(316, 62, 'angni Upazila', 'আংনি'),
(317, 62, 'Mujib Nagar Upazila', 'মুজিব নগর'),
(318, 62, 'Meherpur-S Upazila', 'মেহেরপুর সদর'),
(319, 63, 'Narail-S Upazilla', 'নড়াইল সদর'),
(320, 63, 'Lohagara Upazilla', 'লোহাগাড়া'),
(321, 63, 'Kalia Upazilla', 'কালিয়া'),
(322, 64, 'Satkhira Sadar Upazila', 'সাতক্ষীরা সদর'),
(323, 64, 'Assasuni Upazila', 'আসসাশুনি '),
(324, 64, 'Debhata Upazila', 'দেভাটা'),
(325, 64, 'Tala Upazila', 'তালা'),
(326, 64, 'Kalaroa Upazila', 'কলরোয়া'),
(327, 64, 'Kaliganj Upazila', 'কালীগঞ্জ'),
(328, 64, 'Shyamnagar Upazila', 'শ্যামনগর'),
(329, 18, 'Adamdighi', 'আদমদিঘী'),
(330, 18, 'Bogra Sadar', 'বগুড়া সদর'),
(331, 18, 'Sherpur', 'শেরপুর'),
(332, 18, 'Dhunat', 'ধুনট'),
(333, 18, 'Dhupchanchia', 'দুপচাচিয়া'),
(334, 18, 'Gabtali', 'গাবতলি'),
(335, 18, 'Kahaloo', 'কাহালু'),
(336, 18, 'Nandigram', 'নন্দিগ্রাম'),
(337, 18, 'Sahajanpur', 'শাহজাহানপুর'),
(338, 18, 'Sariakandi', 'সারিয়াকান্দি'),
(339, 18, 'Shibganj', 'শিবগঞ্জ'),
(340, 18, 'Sonatala', 'সোনাতলা'),
(341, 19, 'Joypurhat S', 'জয়পুরহাট সদর'),
(342, 19, 'Akkelpur', 'আক্কেলপুর'),
(343, 19, 'Kalai', 'কালাই'),
(344, 19, 'Khetlal', 'খেতলাল'),
(345, 19, 'Panchbibi', 'পাঁচবিবি'),
(346, 20, 'Naogaon Sadar Upazila', 'নওগাঁ সদর'),
(347, 20, 'Mohadevpur Upazila', 'মহাদেবপুর'),
(348, 20, 'Manda Upazila', 'মান্দা'),
(349, 20, 'Niamatpur Upazila', 'নিয়ামতপুর'),
(350, 20, 'Atrai Upazila', 'আত্রাই'),
(351, 20, 'Raninagar Upazila', 'রাণীনগর'),
(352, 20, 'Patnitala Upazila', 'পত্নীতলা'),
(353, 20, 'Dhamoirhat Upazila', 'ধামইরহাট '),
(354, 20, 'Sapahar Upazila', 'সাপাহার'),
(355, 20, 'Porsha Upazila', 'পোরশা'),
(356, 20, 'Badalgachhi Upazila', 'বদলগাছি'),
(357, 21, 'Natore Sadar Upazila', 'নাটোর সদর'),
(358, 21, 'Baraigram Upazila', 'বড়াইগ্রাম'),
(359, 21, 'Bagatipara Upazila', 'বাগাতিপাড়া'),
(360, 21, 'Lalpur Upazila', 'লালপুর'),
(361, 21, 'Natore Sadar Upazila', 'নাটোর সদর'),
(362, 21, 'Baraigram Upazila', 'বড়াই গ্রাম'),
(363, 22, 'Bholahat Upazila', 'ভোলাহাট'),
(364, 22, 'Gomastapur Upazila', 'গোমস্তাপুর'),
(365, 22, 'Nachole Upazila', 'নাচোল'),
(366, 22, 'Nawabganj Sadar Upazila', 'নবাবগঞ্জ সদর'),
(367, 22, 'Shibganj Upazila', 'শিবগঞ্জ'),
(368, 23, 'Atgharia Upazila', 'আটঘরিয়া'),
(369, 23, 'Bera Upazila', 'বেড়া'),
(370, 23, 'Bhangura Upazila', 'ভাঙ্গুরা'),
(371, 23, 'Chatmohar Upazila', 'চাটমোহর'),
(372, 23, 'Faridpur Upazila', 'ফরিদপুর'),
(373, 23, 'Ishwardi Upazila', 'ঈশ্বরদী'),
(374, 23, 'Pabna Sadar Upazila', 'পাবনা সদর'),
(375, 23, 'Santhia Upazila', 'সাথিয়া'),
(376, 23, 'Sujanagar Upazila', 'সুজানগর'),
(377, 24, 'Bagha', 'বাঘা'),
(378, 24, 'Bagmara', 'বাগমারা'),
(379, 24, 'Charghat', 'চারঘাট'),
(380, 24, 'Durgapur', 'দুর্গাপুর'),
(381, 24, 'Godagari', 'গোদাগারি'),
(382, 24, 'Mohanpur', 'মোহনপুর'),
(383, 24, 'Paba', 'পবা'),
(384, 24, 'Puthia', 'পুঠিয়া'),
(385, 24, 'Tanore', 'তানোর'),
(386, 25, 'Sirajganj Sadar Upazila', 'সিরাজগঞ্জ সদর'),
(387, 25, 'Belkuchi Upazila', 'বেলকুচি'),
(388, 25, 'Chauhali Upazila', 'চৌহালি'),
(389, 25, 'Kamarkhanda Upazila', 'কামারখান্দা'),
(390, 25, 'Kazipur Upazila', 'কাজীপুর'),
(391, 25, 'Raiganj Upazila', 'রায়গঞ্জ'),
(392, 25, 'Shahjadpur Upazila', 'শাহজাদপুর'),
(393, 25, 'Tarash Upazila', 'তারাশ'),
(394, 25, 'Ullahpara Upazila', 'উল্লাপাড়া'),
(395, 26, 'Birampur Upazila', 'বিরামপুর'),
(396, 26, 'Birganj', 'বীরগঞ্জ'),
(397, 26, 'Biral Upazila', 'বিড়াল'),
(398, 26, 'Bochaganj Upazila', 'বোচাগঞ্জ'),
(399, 26, 'Chirirbandar Upazila', 'চিরিরবন্দর'),
(400, 26, 'Phulbari Upazila', 'ফুলবাড়ি'),
(401, 26, 'Ghoraghat Upazila', 'ঘোড়াঘাট'),
(402, 26, 'Hakimpur Upazila', 'হাকিমপুর'),
(403, 26, 'Kaharole Upazila', 'কাহারোল'),
(404, 26, 'Khansama Upazila', 'খানসামা'),
(405, 26, 'Dinajpur Sadar Upazila', 'দিনাজপুর সদর'),
(406, 26, 'Nawabganj', 'নবাবগঞ্জ'),
(407, 26, 'Parbatipur Upazila', 'পার্বতীপুর'),
(408, 27, 'Fulchhari', 'ফুলছড়ি'),
(409, 27, 'Gaibandha sadar', 'গাইবান্ধা সদর'),
(410, 27, 'Gobindaganj', 'গোবিন্দগঞ্জ'),
(411, 27, 'Palashbari', 'পলাশবাড়ী'),
(412, 27, 'Sadullapur', 'সাদুল্যাপুর'),
(413, 27, 'Saghata', 'সাঘাটা'),
(414, 27, 'Sundarganj', 'সুন্দরগঞ্জ'),
(415, 28, 'Kurigram Sadar', 'কুড়িগ্রাম সদর'),
(416, 28, 'Nageshwari', 'নাগেশ্বরী'),
(417, 28, 'Bhurungamari', 'ভুরুঙ্গামারি'),
(418, 28, 'Phulbari', 'ফুলবাড়ি'),
(419, 28, 'Rajarhat', 'রাজারহাট'),
(420, 28, 'Ulipur', 'উলিপুর'),
(421, 28, 'Chilmari', 'চিলমারি'),
(422, 28, 'Rowmari', 'রউমারি'),
(423, 28, 'Char Rajibpur', 'চর রাজিবপুর'),
(424, 29, 'Lalmanirhat Sadar', 'লালমনিরহাট সদর'),
(425, 29, 'Aditmari', 'আদিতমারি'),
(426, 29, 'Kaliganj', 'কালীগঞ্জ'),
(427, 29, 'Hatibandha', 'হাতিবান্ধা'),
(428, 29, 'Patgram', 'পাটগ্রাম'),
(429, 30, 'Nilphamari Sadar', 'নীলফামারী সদর'),
(430, 30, 'Saidpur', 'সৈয়দপুর'),
(431, 30, 'Jaldhaka', 'জলঢাকা'),
(432, 30, 'Kishoreganj', 'কিশোরগঞ্জ'),
(433, 30, 'Domar', 'ডোমার'),
(434, 30, 'Dimla', 'ডিমলা'),
(435, 31, 'Panchagarh Sadar', 'পঞ্চগড় সদর'),
(436, 31, 'Debiganj', 'দেবীগঞ্জ'),
(437, 31, 'Boda', 'বোদা'),
(438, 31, 'Atwari', 'আটোয়ারি'),
(439, 31, 'Tetulia', 'তেতুলিয়া'),
(440, 32, 'Badarganj', 'বদরগঞ্জ'),
(441, 32, 'Mithapukur', 'মিঠাপুকুর'),
(442, 32, 'Gangachara', 'গঙ্গাচরা'),
(443, 32, 'Kaunia', 'কাউনিয়া'),
(444, 32, 'Rangpur Sadar', 'রংপুর সদর'),
(445, 32, 'Pirgachha', 'পীরগাছা'),
(446, 32, 'Pirganj', 'পীরগঞ্জ'),
(447, 32, 'Taraganj', 'তারাগঞ্জ'),
(448, 33, 'Thakurgaon Sadar Upazila', 'ঠাকুরগাঁও সদর'),
(449, 33, 'Pirganj Upazila', 'পীরগঞ্জ'),
(450, 33, 'Baliadangi Upazila', 'বালিয়াডাঙ্গি'),
(451, 33, 'Haripur Upazila', 'হরিপুর'),
(452, 33, 'Ranisankail Upazila', 'রাণীসংকইল'),
(453, 51, 'Ajmiriganj', 'আজমিরিগঞ্জ'),
(454, 51, 'Baniachang', 'বানিয়াচং'),
(455, 51, 'Bahubal', 'বাহুবল'),
(456, 51, 'Chunarughat', 'চুনারুঘাট'),
(457, 51, 'Habiganj Sadar', 'হবিগঞ্জ সদর'),
(458, 51, 'Lakhai', 'লাক্ষাই'),
(459, 51, 'Madhabpur', 'মাধবপুর'),
(460, 51, 'Nabiganj', 'নবীগঞ্জ'),
(461, 51, 'Shaistagonj Upazila', 'শায়েস্তাগঞ্জ'),
(462, 52, 'Moulvibazar Sadar', 'মৌলভীবাজার'),
(463, 52, 'Barlekha', 'বড়লেখা'),
(464, 52, 'Juri', 'জুড়ি'),
(465, 52, 'Kamalganj', 'কামালগঞ্জ'),
(466, 52, 'Kulaura', 'কুলাউরা'),
(467, 52, 'Rajnagar', 'রাজনগর'),
(468, 52, 'Sreemangal', 'শ্রীমঙ্গল'),
(469, 53, 'Bishwamvarpur', 'বিসশম্ভারপুর'),
(470, 53, 'Chhatak', 'ছাতক'),
(471, 53, 'Derai', 'দেড়াই'),
(472, 53, 'Dharampasha', 'ধরমপাশা'),
(473, 53, 'Dowarabazar', 'দোয়ারাবাজার'),
(474, 53, 'Jagannathpur', 'জগন্নাথপুর'),
(475, 53, 'Jamalganj', 'জামালগঞ্জ'),
(476, 53, 'Sulla', 'সুল্লা'),
(477, 53, 'Sunamganj Sadar', 'সুনামগঞ্জ সদর'),
(478, 53, 'Shanthiganj', 'শান্তিগঞ্জ'),
(479, 53, 'Tahirpur', 'তাহিরপুর'),
(480, 54, 'Sylhet Sadar', 'সিলেট সদর'),
(481, 54, 'Beanibazar', 'বেয়ানিবাজার'),
(482, 54, 'Bishwanath', 'বিশ্বনাথ'),
(483, 54, 'Dakshin Surma Upazila', 'দক্ষিণ সুরমা'),
(484, 54, 'Balaganj', 'বালাগঞ্জ'),
(485, 54, 'Companiganj', 'কোম্পানিগঞ্জ'),
(486, 54, 'Fenchuganj', 'ফেঞ্চুগঞ্জ'),
(487, 54, 'Golapganj', 'গোলাপগঞ্জ'),
(488, 54, 'Gowainghat', 'গোয়াইনঘাট'),
(489, 54, 'Jaintiapur', 'জয়ন্তপুর'),
(490, 54, 'Kanaighat', 'কানাইঘাট'),
(491, 54, 'Zakiganj', 'জাকিগঞ্জ'),
(492, 54, 'Nobigonj', 'নবীগঞ্জ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` text COLLATE utf8mb4_unicode_ci,
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1 = admin/system user, 2 = customer',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 = delete, 1 = active, 2 = inactive  ',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `verification_code` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validity_verification_code` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` tinyint(3) DEFAULT '-1',
  `updated_by` mediumint(8) UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `email`, `password`, `remember_token`, `type`, `is_active`, `status`, `verification_code`, `validity_verification_code`, `created_at`, `created_by`, `updated_by`, `updated_at`) VALUES
(1, '201904010004', NULL, '$2y$10$LP43.conVmfL5GTZ/3lMBuPp68znJmzWK86RM3DXbtwAAC/5/7wGW', 'vjhO2UO81FJ6jwYsCWMObLAVzNrKdHs89Zh3w6SzwZi27fjUepgpfjcmmvYz', 1, 1, 0, NULL, NULL, '2018-11-29 05:45:29', -1, 1, '2019-05-08 04:32:02'),
(2, '201904010005', NULL, '$2y$10$LP43.conVmfL5GTZ/3lMBuPp68znJmzWK86RM3DXbtwAAC/5/7wGW', 'i4NZJnVeUnHxfLRwXKp4wfPOv64WTXOwlSWl2175TMuTegLuQ6uGzSfoQfeY', 1, 1, 0, NULL, NULL, '2018-11-29 05:45:29', -1, 1, '2019-05-08 04:32:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc_chart_of_accounts`
--
ALTER TABLE `acc_chart_of_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `all_sttings`
--
ALTER TABLE `all_sttings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch_infos`
--
ALTER TABLE `branch_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_infos`
--
ALTER TABLE `company_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `division_id` (`division_id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emplooyee_overwrite_off_on_days`
--
ALTER TABLE `emplooyee_overwrite_off_on_days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_attendance_application`
--
ALTER TABLE `employee_attendance_application`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_attendance_info`
--
ALTER TABLE `employee_attendance_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_attendance_row_data`
--
ALTER TABLE `employee_attendance_row_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_leave_infos`
--
ALTER TABLE `employee_leave_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_payrole_leave_assign`
--
ALTER TABLE `employee_payrole_leave_assign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_payslip_infos`
--
ALTER TABLE `employee_payslip_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_salary_infos`
--
ALTER TABLE `employee_salary_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employess_general_infos`
--
ALTER TABLE `employess_general_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fiscal_year`
--
ALTER TABLE `fiscal_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `land_infos`
--
ALTER TABLE `land_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly_openings`
--
ALTER TABLE `monthly_openings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_infos`
--
ALTER TABLE `product_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_stock_infos`
--
ALTER TABLE `product_stock_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_artist_info`
--
ALTER TABLE `program_artist_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_schedule_infos`
--
ALTER TABLE `program_schedule_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_information`
--
ALTER TABLE `schedule_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setup_artist_grade`
--
ALTER TABLE `setup_artist_grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setup_artist_rate_chart`
--
ALTER TABLE `setup_artist_rate_chart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setup_days`
--
ALTER TABLE `setup_days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setup_fixed_time_point`
--
ALTER TABLE `setup_fixed_time_point`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setup_odivision`
--
ALTER TABLE `setup_odivision`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_history`
--
ALTER TABLE `sms_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upazilas`
--
ALTER TABLE `upazilas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `district_id` (`district_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acc_chart_of_accounts`
--
ALTER TABLE `acc_chart_of_accounts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `all_sttings`
--
ALTER TABLE `all_sttings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `branch_infos`
--
ALTER TABLE `branch_infos`
  MODIFY `id` mediumint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `company_infos`
--
ALTER TABLE `company_infos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `emplooyee_overwrite_off_on_days`
--
ALTER TABLE `emplooyee_overwrite_off_on_days`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `employee_attendance_application`
--
ALTER TABLE `employee_attendance_application`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_attendance_info`
--
ALTER TABLE `employee_attendance_info`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `employee_attendance_row_data`
--
ALTER TABLE `employee_attendance_row_data`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_leave_infos`
--
ALTER TABLE `employee_leave_infos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee_payrole_leave_assign`
--
ALTER TABLE `employee_payrole_leave_assign`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee_payslip_infos`
--
ALTER TABLE `employee_payslip_infos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `employee_salary_infos`
--
ALTER TABLE `employee_salary_infos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employess_general_infos`
--
ALTER TABLE `employess_general_infos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fiscal_year`
--
ALTER TABLE `fiscal_year`
  MODIFY `id` mediumint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `land_infos`
--
ALTER TABLE `land_infos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `monthly_openings`
--
ALTER TABLE `monthly_openings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_infos`
--
ALTER TABLE `product_infos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_stock_infos`
--
ALTER TABLE `product_stock_infos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `program_artist_info`
--
ALTER TABLE `program_artist_info`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `program_schedule_infos`
--
ALTER TABLE `program_schedule_infos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schedule_information`
--
ALTER TABLE `schedule_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setup_artist_grade`
--
ALTER TABLE `setup_artist_grade`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `setup_artist_rate_chart`
--
ALTER TABLE `setup_artist_rate_chart`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setup_days`
--
ALTER TABLE `setup_days`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `setup_fixed_time_point`
--
ALTER TABLE `setup_fixed_time_point`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setup_odivision`
--
ALTER TABLE `setup_odivision`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sms_history`
--
ALTER TABLE `sms_history`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `upazilas`
--
ALTER TABLE `upazilas`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=493;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_ibfk_1` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `upazilas`
--
ALTER TABLE `upazilas`
  ADD CONSTRAINT `upazilas_ibfk_1` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
