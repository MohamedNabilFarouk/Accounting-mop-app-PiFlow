-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 09, 2023 at 03:36 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_mobapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Bank statements', '2023-09-25 12:43:08', '2023-09-25 12:43:08'),
(2, 'Sales', '2023-09-25 12:45:02', '2023-09-25 12:45:02'),
(3, 'Expenses', '2023-09-25 12:45:02', '2023-09-25 12:45:02'),
(4, 'Salaries', '2023-09-25 12:45:02', '2023-09-25 12:45:02'),
(5, 'Justification', '2023-09-25 12:45:02', '2023-09-25 12:45:02'),
(6, 'Petty cash', '2023-09-25 12:45:02', '2023-09-25 12:45:02');

-- --------------------------------------------------------

--
-- Table structure for table `client_emp`
--

CREATE TABLE `client_emp` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `fcm_token` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_emp`
--

INSERT INTO `client_emp` (`id`, `name`, `email`, `password`, `user_id`, `fcm_token`, `created_at`, `updated_at`) VALUES
(1, 'emp1', 'emp1@gmail.com', '$2y$10$2Q4s7nwUQsCpYnwsTHCHW.3zNOaIM/UHsq0S7zVl6fdr5LZEnPpne', 9, NULL, '2023-11-02 01:05:18', '2023-11-02 01:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tax_register` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `com_register` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `package_id` int DEFAULT NULL,
  `subscription_to` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0-> non active \r\n1-> active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `image`, `tax_register`, `com_register`, `package_id`, `subscription_to`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Company 1', 'aWytnpVPPg6tIi0Yv5bNW15yWHmO4bZPomQCZ0CH.jpg', '1232548211233', '98765421512', 2, '2023-11-29 22:00:00', '2023-11-20 21:06:59', '2023-11-26 20:22:42', 1),
(2, 'Company 2', NULL, '12313213132', '56456', 1, '2023-11-25 22:00:00', '2023-11-20 21:07:22', '2023-11-27 21:10:58', 0),
(3, 'Company 33', NULL, NULL, NULL, 2, '2023-11-25 22:00:00', '2023-11-20 21:07:22', '2023-11-27 19:40:37', 1),
(4, 'comp 4', NULL, NULL, NULL, 1, '2023-12-22 01:25:26', '2023-11-22 00:50:14', '2023-11-22 01:25:26', 1),
(5, 'comp test test', NULL, '123456456', '64555556', 4, '2024-02-23 22:00:00', '2023-11-26 20:03:21', '2023-11-26 20:19:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint NOT NULL,
  `file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `file_name` text COLLATE utf8mb4_general_ci,
  `pos_id` int DEFAULT NULL,
  `justification_id` int DEFAULT NULL COMMENT 'use with category 5',
  `category_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `company_id` int DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `file`, `file_name`, `pos_id`, `justification_id`, `category_id`, `user_id`, `company_id`, `date`, `created_at`, `updated_at`) VALUES
(22, '[\"aeGRhKfPbOQ5vONgpGvXs5iDe3UykWDrqn7QkCPd.png\",\"LUuthPAhMhvj2GSV4hFRzTYeZyh81mncfTuQTOIY.png\"]', '[\"Screenshot 2023-04-26 at 17-27-37 Sandbox - Modern & Multipurpose Bootstrap 5 Template.png\",\"Screenshot 2023-04-26 at 17-26-23 SMET.png\"]', NULL, NULL, 3, 1, 1, '2023-09-27 19:29:07', '2023-09-27 16:29:07', '2023-11-24 04:07:09'),
(23, '[\"wPSpytVpPD4mzAuPJL0k5ekRQYj2dGCRCSXAbiU8.png\",\"XrMbbfGade1WTwlh4nPo35koiheoigz52bDxFaxD.png\"]', '[\"Screenshot 2023-04-26 at 17-27-37 Sandbox - Modern & Multipurpose Bootstrap 5 Template.png\",\"Screenshot 2023-04-26 at 17-26-23 SMET.png\"]', NULL, NULL, 3, 1, 1, '2023-09-27 19:29:40', '2023-08-27 16:29:40', '2023-09-27 16:29:40'),
(25, '[\"DQaGP2X6j7Xw4DkDxh070QdMm9Cd1QDKtAYC0k9m.png\",\"rHQzVij45hxu730Io7lNBj0K19WWwvEflQ2Jd6kO.png\"]', '[\"Screenshot 2023-04-26 at 17-27-37 Sandbox - Modern & Multipurpose Bootstrap 5 Template.png\",\"Screenshot 2023-04-26 at 17-26-23 SMET.png\"]', NULL, NULL, 6, 9, 2, '2023-10-03 20:47:08', '2023-10-03 17:47:08', '2023-10-03 17:47:08'),
(30, '[\"aeGRhKfPbOQ5vONgpGvXs5iDe3UykWDrqn7QkCPd.png\",\"LUuthPAhMhvj2GSV4hFRzTYeZyh81mncfTuQTOIY.png\"]', '[\"Screenshot 2023-04-26 at 17-27-37 Sandbox - Modern & Multipurpose Bootstrap 5 Template.png\",\"Screenshot 2023-04-26 at 17-26-23 SMET.png\"]', NULL, NULL, 1, 5, 1, '2023-10-06 01:54:14', '2023-10-05 22:54:14', '2023-10-05 22:54:14'),
(31, '[\"zKu1Fqy55D6AqzFPvAhEJAubvUuuWRYrGWiW6YZc.png\",\"IPrZ2b3QqzLaZeKGaSyGDuJvkPZCtKjPsqiRb5UG.png\"]', '[\"Screenshot 2023-04-26 at 17-27-37 Sandbox - Modern & Multipurpose Bootstrap 5 Template.png\",\"Screenshot 2023-04-26 at 17-26-23 SMET.png\"]', NULL, NULL, 1, 5, 1, '2023-10-06 02:07:45', '2023-10-05 23:07:45', '2023-10-05 23:07:45'),
(32, '[\"mYXkvbpBQHTYziJeubZGHdXAO8KnXnwu9hhOVea6.png\",\"rKmzxxL6WuSINsGJPPJv6t2nHsGy3GLQOy4EkII5.png\"]', '[\"Screenshot 2023-04-26 at 17-27-37 Sandbox - Modern & Multipurpose Bootstrap 5 Template.png\",\"Screenshot 2023-04-26 at 17-26-23 SMET.png\"]', NULL, NULL, 1, 5, 1, '2023-08-01 00:00:00', '2023-10-05 23:17:19', '2023-10-05 23:17:19'),
(34, '[\"graTT36xBmESl4HB0NpxDBpwydVeuabIC0wTX8vU.png\",\"Xx1fpTGjFijYfSUb114s7grTL7D2LOSbp7PP5S6s.png\"]', '[\"Screenshot 2023-04-26 at 17-27-37 Sandbox - Modern & Multipurpose Bootstrap 5 Template.png\",\"Screenshot 2023-04-26 at 17-26-23 SMET.png\"]', 1, NULL, 2, 9, 2, '2023-09-01 00:00:00', '2023-10-06 11:12:42', '2023-10-06 11:12:42'),
(35, '[\"ISChksviJh8oCc4Rg4DZrk7AVhZXYufPWNr73I3G.png\",\"MX5tsPzW5F6PyqLKXLcC53II54DVLiOcFhKnKfJ4.png\"]', '[\"Screenshot 2023-04-26 at 17-27-37 Sandbox - Modern & Multipurpose Bootstrap 5 Template.png\",\"Screenshot 2023-04-26 at 17-26-23 SMET.png\"]', 1, NULL, 2, 9, 2, '2023-10-01 00:00:00', '2023-10-06 13:39:40', '2023-10-06 13:39:40'),
(37, '[\"dDOBk06KErYAhkxf8s5gf0D3fB0BCAaXmMO99gpf.png\",\"N1EVMoKjdc95IcuNNRb6hnsX8hFNgtTmc8yOc7Oe.png\"]', '[\"Screenshot 2023-04-26 at 17-27-37 Sandbox - Modern & Multipurpose Bootstrap 5 Template.png\",\"Screenshot 2023-04-26 at 17-26-23 SMET.png\"]', NULL, 1, 5, 9, 2, '2023-10-01 00:00:00', '2023-10-06 16:36:22', '2023-10-06 16:36:22'),
(38, '[\"sZkINlOEOdXqcmXrMNDJGwBjn6s4BtsgjIYgmytz.png\",\"ZDwt1joijSRVKmSqsaDKZkgRA4Q0PuK1qLw1AApU.png\"]', '[\"Screenshot 2023-04-26 at 17-27-37 Sandbox - Modern & Multipurpose Bootstrap 5 Template.png\",\"Screenshot 2023-04-26 at 17-26-23 SMET.png\"]', NULL, 1, 5, 9, 2, '2023-10-01 00:00:00', '2023-10-06 16:39:35', '2023-10-06 16:39:35'),
(41, '[\"uQQGGTwDFgjuJ247rXiALhMgxgDAz4LcS6CYafan.png\"]', '[\"1200x600wa.png\"]', NULL, NULL, 6, 9, 2, '2023-10-01 00:00:00', '2023-10-11 16:23:47', '2023-10-11 16:23:47'),
(46, NULL, NULL, NULL, NULL, 3, 9, 2, '2023-10-01 00:00:00', '2023-11-24 14:15:11', '2023-11-24 14:15:11'),
(47, NULL, NULL, NULL, NULL, 3, 9, 2, '2023-10-01 00:00:00', '2023-11-24 15:23:52', '2023-11-24 15:23:52'),
(48, NULL, NULL, NULL, NULL, 6, 9, 2, '2023-10-01 00:00:00', '2023-11-24 17:28:02', '2023-11-24 17:28:02'),
(49, NULL, NULL, NULL, NULL, 6, 9, 2, '2023-10-01 00:00:00', '2023-11-24 18:11:02', '2023-11-24 18:11:02'),
(50, NULL, NULL, 1, NULL, 2, 9, 2, '2023-10-01 00:00:00', '2023-11-24 18:17:18', '2023-11-24 18:17:18'),
(51, NULL, NULL, 1, NULL, 2, 9, 2, '2023-11-01 00:00:00', '2023-11-24 21:08:05', '2023-11-24 21:08:05'),
(53, NULL, NULL, NULL, 1, 5, 9, 2, '2023-11-01 00:00:00', '2023-11-25 11:29:32', '2023-11-25 11:29:32'),
(54, NULL, NULL, NULL, 1, 5, 9, 2, '2023-11-01 00:00:00', '2023-11-25 11:37:08', '2023-11-25 11:37:08'),
(55, NULL, NULL, NULL, 3, 5, 9, 2, '2023-11-01 00:00:00', '2023-11-25 11:43:53', '2023-11-25 11:43:53'),
(56, NULL, NULL, NULL, NULL, 6, 9, 2, '2023-11-01 00:00:00', '2023-11-25 11:48:51', '2023-11-25 11:48:51'),
(58, NULL, NULL, NULL, NULL, 6, 9, 2, '2023-12-01 00:00:00', '2023-11-27 00:01:45', '2023-11-27 00:01:45'),
(59, NULL, NULL, NULL, 1, 5, 9, 2, '2023-12-01 00:00:00', '2023-11-27 00:19:44', '2023-11-27 00:19:44');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `balance` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `company_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `position`, `balance`, `company_id`, `created_at`, `updated_at`) VALUES
(1, 'mohamed nabil', 'developer', '0', 2, '2023-10-03 17:20:28', '2023-10-03 17:20:28'),
(2, 'omar', 'developer 2', '0', 2, '2023-10-03 17:20:28', '2023-10-03 17:20:28');

-- --------------------------------------------------------

--
-- Table structure for table `employee_info`
--

CREATE TABLE `employee_info` (
  `id` int NOT NULL,
  `document_id` int DEFAULT NULL,
  `des` text COLLATE utf8mb4_general_ci,
  `amount` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `employee_id` int DEFAULT NULL,
  `trans_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_info`
--

INSERT INTO `employee_info` (`id`, `document_id`, `des`, `amount`, `employee_id`, `trans_date`, `created_at`, `updated_at`) VALUES
(1, 25, 'des of test petty cahse category', '100', 1, NULL, '2023-10-03 17:47:08', '2023-10-03 17:47:08'),
(4, 41, 'des of test petty cahse category test', '100', 1, NULL, '2023-10-11 16:23:47', '2023-10-11 16:23:47'),
(5, 48, 'des of test petty cahse category test new files 1', '100', 8, 'Jan 2023', '2023-11-24 17:28:03', '2023-11-24 17:28:03'),
(6, 49, 'des of test petty cahse category test new files 2', '100', 8, 'Jan 2023', '2023-11-24 18:11:03', '2023-11-24 18:11:03'),
(7, 56, 'des of test petty cahse category test new files nov  test update', '3000', 2, 'nov2023', '2023-11-25 11:48:51', '2023-11-26 23:55:41'),
(9, 58, 'des of test petty cahse category test new files nov  test update 2', '3000', 2, 'DEC 2023', '2023-11-27 00:01:45', '2023-11-27 00:07:08');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `document_id` bigint DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `file_name`, `document_id`, `file`, `created_at`, `updated_at`) VALUES
(16, 'logo_blue.png', 46, 'KCw4bH5S2nQ09v2lWYRr6iasiDSpjsMP9nS1n74c.png', '2023-11-24 14:15:11', '2023-11-24 14:15:11'),
(18, 'logo_blue.png', 47, 'DLSwh8DHfbQv2aqpows3HsoZ1wdzqNJqxYpT3Ut2.png', '2023-11-24 15:23:52', '2023-11-24 15:23:52'),
(19, '3BcVO8ntFxuYVXjQdqqBntqi2veH5EAl6dkTR8iY.png', 48, '9eSUoHRC3a3T66oIERHRtRElj62bGPv3nKCPuu2s.png', '2023-11-24 17:28:03', '2023-11-24 17:28:03'),
(20, '3wwhgbAoGsYv8DUpQYmlfc65L7IJ8oKGs1G3kr2g.png', 48, 'hmqvwQQk2VmEmxAKsdZbvyE3nnsglUW8ZX5IQk0X.png', '2023-11-24 17:28:03', '2023-11-24 17:28:03'),
(21, '3BcVO8ntFxuYVXjQdqqBntqi2veH5EAl6dkTR8iY.png', 49, 'ziL34CLmsMOtw0d2sD8yAPCiEoYtLoIccrpZYEhf.png', '2023-11-24 18:11:03', '2023-11-24 18:11:03'),
(22, '3wwhgbAoGsYv8DUpQYmlfc65L7IJ8oKGs1G3kr2g.png', 49, 'uRcE1nXz8opilRsKXYhAHx8XvimkoCngLq9mOWeb.png', '2023-11-24 18:11:03', '2023-11-24 18:11:03'),
(23, '3BcVO8ntFxuYVXjQdqqBntqi2veH5EAl6dkTR8iY.png', 50, '6EGZzHGPh1kB1uSi7uFEeCUQv1pjx7jCql2HP0Da.png', '2023-11-24 18:17:18', '2023-11-24 18:17:18'),
(25, '3BcVO8ntFxuYVXjQdqqBntqi2veH5EAl6dkTR8iY.png', 51, 'nvZMzbJHELU1maRUtD4rlMiZXlXdQRWXcjG6YAPk.png', '2023-11-24 21:08:05', '2023-11-24 21:08:05'),
(26, '3wwhgbAoGsYv8DUpQYmlfc65L7IJ8oKGs1G3kr2g.png', 51, 'zADSqR4seUE257PwcDHUjTNIFT8iwOYjzuKvKiAJ.png', '2023-11-24 21:08:05', '2023-11-24 21:08:05'),
(28, 'yAJpn1liS49e5FuAL0ngVghOcE5CiLlzuG8aRcDY.png', 53, 'HvHFRKX4Mv2KDy93L0Xfd1mXcQNPxYGzdsLtQSFM.png', '2023-11-25 11:29:32', '2023-11-25 11:29:32'),
(29, 'yAJpn1liS49e5FuAL0ngVghOcE5CiLlzuG8aRcDY.png', 54, 'xTVawE8VYY2Vj0tAEJ7DXpoUQOWjgpoI6BM5OSMG.png', '2023-11-25 11:37:08', '2023-11-25 11:37:08'),
(30, 'yAJpn1liS49e5FuAL0ngVghOcE5CiLlzuG8aRcDY.png', 55, 'OMY9WpGBqXst8zyXYL9ZCa0bSlZPNKpTF8NSTTOG.png', '2023-11-25 11:43:53', '2023-11-25 11:43:53'),
(33, 'yAJpn1liS49e5FuAL0ngVghOcE5CiLlzuG8aRcDY.png', 56, 'OMY9WpGBqXst8zyXYL9ZCa0bSlZPNKpTF8NSTTOG.png', '2023-11-25 11:43:53', '2023-11-25 11:43:53'),
(37, '7bQvRCUovfdqGFTqWAMZs6g3wIs8gdiw6CGKfcJq.png', 56, 'YvUZZVxnNYw4usSTfamwKrCSzjtFyq9z0NXlwXXR.png', '2023-11-26 23:52:27', '2023-11-26 23:52:27'),
(38, '7bQvRCUovfdqGFTqWAMZs6g3wIs8gdiw6CGKfcJq.png', 56, 'DMLbv8SwtMwIz5hhZ6yN7d1jbW2bwAaWvu0XsLX8.png', '2023-11-26 23:55:41', '2023-11-26 23:55:41'),
(39, '7bQvRCUovfdqGFTqWAMZs6g3wIs8gdiw6CGKfcJq.png', 58, 'vSv34Z0tZLhDX363RKtJZngDX74cRYzxl5Lzo7c9.png', '2023-11-27 00:01:45', '2023-11-27 00:01:45'),
(40, '7bQvRCUovfdqGFTqWAMZs6g3wIs8gdiw6CGKfcJq.png', 58, 'tJhaaPVlKeRI3EugUGeZJ5UZZOeXzcbfsLsdd2kD.png', '2023-11-27 00:07:08', '2023-11-27 00:07:08'),
(41, '7bQvRCUovfdqGFTqWAMZs6g3wIs8gdiw6CGKfcJq.png', 59, 'DuEV7yPhvJujmL46UiA5ii2Zosv2iX7QOZHyRN2F.png', '2023-11-27 00:19:44', '2023-11-27 00:19:44'),
(43, '7bQvRCUovfdqGFTqWAMZs6g3wIs8gdiw6CGKfcJq.png', 60, '1oZBBwgMj5hF4wfwNpVUkmxXhF5Xq8ettDTg9916.png', '2023-11-27 00:22:53', '2023-11-27 00:22:53');

-- --------------------------------------------------------

--
-- Table structure for table `justifications`
--

CREATE TABLE `justifications` (
  `id` int NOT NULL,
  `company_id` int DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bank_number` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `piflow_comment` text COLLATE utf8mb4_general_ci,
  `client_comment` text COLLATE utf8mb4_general_ci,
  `des` text COLLATE utf8mb4_general_ci,
  `trans_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `justifications`
--

INSERT INTO `justifications` (`id`, `company_id`, `bank_name`, `bank_number`, `piflow_comment`, `client_comment`, `des`, `trans_date`, `icon`, `created_at`, `updated_at`) VALUES
(1, 2, 'cib', '12344896', 'piflow comment test new file nov 2', 'client comment test', 'test justification new files nov', 'DEC 2023', NULL, '2023-10-06 11:12:42', '2023-11-27 00:19:44'),
(2, 9, 'alahly', '1236556', NULL, NULL, NULL, 'Aug 2023', NULL, '2023-10-06 16:54:12', '2023-10-06 16:54:12'),
(3, 2, 'misr', '1236556', 'piflow comment test new file nov 3', 'client comment test', 'test justification new files nov 3', 'nov2023', NULL, '2023-11-25 11:42:04', '2023-11-25 11:43:53'),
(4, 1, 'sss', 'asads', NULL, 'شسيتشسمتيسشامنيت شمسنينشست نيشستني شستنم يشت نمشست يمنسش تيشسمن يش ش مشنسيت شسمنيشمنسي سشمشم ش شس يتسشنم يتشسم يتشسمن يتشسمن يتشسنم يتشمسن يش تشمسن تيمنشت يمنشساب شاب هعص ب صا بمش ابثا ث م مش بشمن شسمن يتشسمن يشسي شسكني شسني تشس', 'SSSSS', '2023-12-03', NULL, '2023-12-01 21:07:20', '2023-12-02 17:35:42');

-- --------------------------------------------------------

--
-- Table structure for table `metrics`
--

CREATE TABLE `metrics` (
  `id` int NOT NULL,
  `company_id` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `total_sales` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_purchases` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gross_margin` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `net_profit` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file` longtext COLLATE utf8mb4_general_ci,
  `file_name` longtext COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `metrics`
--

INSERT INTO `metrics` (`id`, `company_id`, `date`, `total_sales`, `total_purchases`, `gross_margin`, `net_profit`, `file`, `file_name`, `created_at`, `updated_at`) VALUES
(3, 1, '2023-09-01', '10000', '200', '400', '6009', NULL, NULL, '2023-10-02 20:47:15', '2023-10-02 21:02:10'),
(4, 1, '2023-08-01', '100', '200', '300', '400', '[]', '[]', '2023-10-02 21:08:41', '2023-11-27 02:02:31'),
(5, 2, '2023-10-01', '100', '21200', '5412', '50', '[\"sD3vjTjvj9gT1YJCT286IWAvQlTnNrtQtge4wzyV.jpg\",\"5K3PgMIHnQFuJasDhhXQ8htQ2jieL8MQynJdg0TI.jpg\",\"NwS4JpQhncPey1HLIvSCDqTymfwAdQRurRoSdYUI.jpg\"]', '[\"about9.jpg\",\"a1.jpg\",\"about4.jpg\"]', '2023-10-23 20:08:00', '2023-10-28 23:25:46');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_12_03_091809_create_permission_tables', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(4, 'App\\Models\\User', 29),
(4, 'App\\Models\\User', 30),
(1, 'App\\Models\\User', 32),
(4, 'App\\Models\\User', 34),
(4, 'App\\Models\\User', 35),
(4, 'App\\Models\\User', 36),
(4, 'App\\Models\\User', 37),
(4, 'App\\Models\\User', 38),
(4, 'App\\Models\\User', 39);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('7a5a0d3f-36ad-425c-8b88-a947821a4344', 'App\\Notifications\\notifications', 'App\\Models\\User', 12, '{\"details\":{\"_token\":\"TcZ7lNAoqcshdvbKZvsJLbYh812J1jmJoKSUdfvk\",\"title\":\"test 2\",\"body\":\"test 2 des\",\"type\":\"Report Availability\",\"users\":[\"5\",\"10\",\"12\"],\"add\":\"Add\",\"user\":{\"id\":7,\"name\":\"PiFlow Admin\",\"email\":\"admin@admin.com\",\"email_verified_at\":null,\"fcm_token\":null,\"created_at\":null,\"updated_at\":\"2023-10-14T20:55:34.000000Z\",\"status\":{\"text\":\"Active\",\"color\":\"success\"},\"role\":1}}}', NULL, '2023-10-17 14:29:56', '2023-10-17 14:29:56'),
('c9696127-fb7f-4ea9-baad-3f894de4e5c1', 'App\\Notifications\\notifications', 'App\\Models\\User', 9, '{\"details\":{\"_token\":\"TcZ7lNAoqcshdvbKZvsJLbYh812J1jmJoKSUdfvk\",\"title\":\"asdads\",\"body\":\"asdasd\",\"type\":\"Upload Reminder\",\"users\":[\"9\"],\"add\":\"Add\",\"user\":{\"id\":7,\"name\":\"PiFlow Admin\",\"email\":\"admin@admin.com\",\"email_verified_at\":null,\"fcm_token\":null,\"created_at\":null,\"updated_at\":\"2023-10-14T20:55:34.000000Z\",\"status\":{\"text\":\"Active\",\"color\":\"success\"},\"role\":1}}}', NULL, '2023-10-17 14:22:11', '2023-10-17 14:22:11'),
('efb494f1-5784-47a3-8d41-9ad688bbe824', 'App\\Notifications\\notifications', 'App\\Models\\User', 9, '{\"details\":{\"_token\":\"TcZ7lNAoqcshdvbKZvsJLbYh812J1jmJoKSUdfvk\",\"title\":\"test 2\",\"body\":\"test 2 des\",\"type\":\"Report Availability\",\"users\":[\"5\",\"10\",\"12\"],\"add\":\"Add\",\"user\":{\"id\":7,\"name\":\"PiFlow Admin\",\"email\":\"admin@admin.com\",\"email_verified_at\":null,\"fcm_token\":null,\"created_at\":null,\"updated_at\":\"2023-10-14T20:55:34.000000Z\",\"status\":{\"text\":\"Active\",\"color\":\"success\"},\"role\":1}}}', NULL, '2023-10-17 14:29:56', '2023-10-17 14:29:56'),
('f194479a-03de-4c00-a935-bf5f371e3b1e', 'App\\Notifications\\notifications', 'App\\Models\\User', 5, '{\"details\":{\"_token\":\"TcZ7lNAoqcshdvbKZvsJLbYh812J1jmJoKSUdfvk\",\"title\":\"test 2\",\"body\":\"test 2 des\",\"type\":\"Report Availability\",\"users\":[\"5\",\"10\",\"12\"],\"add\":\"Add\",\"user\":{\"id\":7,\"name\":\"PiFlow Admin\",\"email\":\"admin@admin.com\",\"email_verified_at\":null,\"fcm_token\":null,\"created_at\":null,\"updated_at\":\"2023-10-14T20:55:34.000000Z\",\"status\":{\"text\":\"Active\",\"color\":\"success\"},\"role\":1}}}', NULL, '2023-10-17 14:29:55', '2023-10-17 14:29:55');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `title`, `price`, `duration`, `created_at`, `updated_at`) VALUES
(1, 'Basic', '50', '30', '2023-10-26 17:47:11', '2023-10-26 17:47:11'),
(2, 'Addition', '200', '30', '2023-10-26 17:47:11', '2023-10-26 17:47:11'),
(3, 'Special', '200', '30', '2023-10-26 17:47:11', '2023-10-26 17:47:11'),
(4, 'Tax', '2400', '90', '2023-10-26 17:47:11', '2023-10-26 17:47:11'),
(5, 'Freelance', '600', '30', '2023-10-26 17:47:11', '2023-10-26 17:47:11');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('mohamednabilfarouk@gmail.com', '$2y$10$ijAkgqOki1zn5lchYNBwh.88dPEwveuPNq4NBrtk758BMFUw9I/QC', '2023-10-19 22:01:26');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pos`
--

CREATE TABLE `pos` (
  `id` int NOT NULL,
  `company_id` int DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `des` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pos`
--

INSERT INTO `pos` (`id`, `company_id`, `title`, `des`, `created_at`, `updated_at`) VALUES
(1, 2, 'pos no 1', 'des of pos 1', '2023-10-06 08:50:27', '2023-10-06 08:50:27');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Piflow Admin', 'web', NULL, NULL),
(2, 'Company Admin', 'web', NULL, NULL),
(3, 'Piflow Accountant', 'web', NULL, NULL),
(4, 'Company Employee', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hot_line` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `favicon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'favicon.png',
  `longitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `welcome_phrase_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `welcome_phrase_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `phone`, `hot_line`, `logo`, `favicon`, `longitude`, `latitude`, `title_en`, `title_ar`, `welcome_phrase_en`, `welcome_phrase_ar`, `address_en`, `address_ar`, `city_en`, `city_ar`, `country_en`, `country_ar`, `meta_title_en`, `meta_title_ar`, `meta_description_en`, `meta_description_ar`, `meta_keyword_en`, `meta_keyword_ar`, `created_at`, `updated_at`) VALUES
(1, '01XXXXXXXXX', '01099339393', 'logo.png', 'https://sevenfoods.app/images/site/https://sevenfoods.app/images/site/https://sevenfoods.app/images/site/https://sevenfoods.app/images/site/favicon.png', NULL, NULL, 'test', 'test_ar', 'test', 'test_ar', 'test', 'test_ar', 'test', 'test_ar', 'test', 'test_ar', 'test', 'test_ar', 'test', 'test_ar', 'test', 'test_ar', '2021-07-14 08:07:54', '2021-09-05 17:08:01');

-- --------------------------------------------------------

--
-- Table structure for table `social_settings`
--

CREATE TABLE `social_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_settings`
--

INSERT INTO `social_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'facebook', NULL, '2021-07-14 08:07:54', '2021-07-14 08:07:54'),
(2, 'twitter', NULL, '2021-07-14 08:07:55', '2021-07-14 08:07:55'),
(3, 'whatsApp', NULL, '2021-07-14 08:07:55', '2021-07-14 08:07:55'),
(4, 'linkedIn', NULL, '2021-07-14 08:07:55', '2021-07-14 08:07:55'),
(5, 'pinterest', NULL, '2021-07-14 08:07:55', '2021-07-14 08:07:55'),
(6, 'instagram', NULL, '2021-07-14 08:07:55', '2021-07-14 08:07:55'),
(7, 'youtube', NULL, '2021-07-14 08:07:55', '2021-07-14 08:07:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` int DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm_token` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `package_id` int DEFAULT NULL,
  `subscription_to` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT 'o non-active\r\n1 active\r\n',
  `role` int DEFAULT '2' COMMENT 'role 1 admin\r\nrole 2 customer "company super admin"\r\nrole 4  piflow accountant\r\n\r\nrole 3 employee',
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `company_id`, `email`, `image`, `email_verified_at`, `password`, `remember_token`, `fcm_token`, `created_at`, `updated_at`, `package_id`, `subscription_to`, `status`, `role`, `position`, `reset_code`, `reset_date`) VALUES
(1, 'Mohamed Nabil', 1, 'mohamednabilfarouk@gmail.com', NULL, NULL, '$2y$10$2Q4s7nwUQsCpYnwsTHCHW.3zNOaIM/UHsq0S7zVl6fdr5LZEnPpne', NULL, '##^&^*^*&^(&*(HJNJKasfadaadasdsad14455', '2023-09-19 20:27:37', '2023-11-27 00:52:58', NULL, NULL, 1, 2, NULL, '3082', '2023-11-02 01:33:06'),
(5, 'ahmed', 1, 'ahmed@gmail.com', NULL, NULL, '$2y$10$OJAlOqWLfLPtkY/RKnSoNOUv53gS6kE39AZUPFWbe0DDVvRF2LOq2', NULL, NULL, '2023-09-23 11:36:43', '2023-10-14 17:56:33', NULL, NULL, 1, 2, NULL, NULL, NULL),
(6, 'ahmed', 2, 'ahmed2@gmail.com', NULL, NULL, '$2y$10$m7qIDiOW58YyQepfaeMkxehX0CTBwAW.0deJhwzEBPdwDbWtCC/Ne', NULL, NULL, '2023-09-23 11:37:29', '2023-10-14 17:56:25', NULL, NULL, 1, 2, NULL, NULL, NULL),
(7, 'PiFlow Admin', NULL, 'admin@admin.com', NULL, NULL, '$2y$10$OJAlOqWLfLPtkY/RKnSoNOUv53gS6kE39AZUPFWbe0DDVvRF2LOq2', NULL, NULL, NULL, '2023-10-14 17:55:34', NULL, NULL, 1, 1, NULL, NULL, NULL),
(9, 'Mohamed Nabil', 2, 'mohamednabilfarouk3@gmail.com', 'AixNLq3sUl6yHBvKG62FPtjC2TFgvp0HOfnc6deX.png', NULL, '$2y$10$219GfVsCdXGfP6dfsuzYzupG//9tnuTKmRmdba4YKMKWUCLTyD.EO', NULL, '##^&^*^*&^(&*(HJNJKasfadaadasdsad14455', '2023-10-01 18:25:34', '2023-11-27 21:07:08', NULL, NULL, 1, 2, 'hr', NULL, NULL),
(10, 'User App', 3, 'user@app.com', NULL, NULL, '$2y$10$vujKDqwOJseQ/KHkueTp9u.Pz3g2npttQ.4ySxVA.4hr4/LJvG3om', NULL, NULL, '2023-10-06 15:27:59', '2023-10-14 17:50:40', NULL, NULL, 1, 2, NULL, NULL, NULL),
(11, 'test', 1, 'test@test.com', NULL, NULL, '$2y$10$7cyDrZIME3jgxnDEDYdGCe3ZMNco.0.B.qgW5aX2AsK08GRObEj/G', NULL, NULL, '2023-10-09 14:51:20', '2023-10-21 14:50:24', NULL, NULL, 1, 2, NULL, NULL, NULL),
(12, 'test11', 1, 'test1@test.com', NULL, NULL, '$2y$10$h3hadonJ4B9fV2sjexQAi.xEbixre4tWXU/3BiuVkvQghtaPwIudu', NULL, NULL, '2023-10-09 14:55:24', '2023-10-16 17:59:59', NULL, NULL, 1, 2, NULL, NULL, NULL),
(14, 'asdasdasd', 2, 'asdasd@asdasd.com', NULL, NULL, '$2y$10$5P0XEv2QkfWOg7ynP1duLu/A5nEutkWkDh.qpuI0ZMeLwal2Kp4kG', NULL, NULL, '2023-10-22 17:50:54', '2023-10-26 19:25:07', NULL, '2023-10-29 22:00:00', 0, 2, NULL, NULL, NULL),
(15, 'Nikolas Brooten', 3, 'aaaass@ssas.com', NULL, NULL, '$2y$10$x7pfI0tYIsXumMu5MMDSDenZlRArClRhqYIpmAVvaIBxQVpv4/Mqq', NULL, NULL, '2023-10-26 19:36:40', '2023-10-26 19:50:12', 1, '2023-11-25 20:50:12', 0, 2, NULL, NULL, NULL),
(16, 'asssssssssssss', NULL, 'ddddddd@sadasd.com', NULL, NULL, '$2y$10$pQqxh4TAhObyDVa188sEy.lCJjOesPnRXV4sizuAM0xNqcyfoQMlW', NULL, NULL, '2023-10-26 19:42:06', '2023-10-26 19:42:06', NULL, NULL, 0, 1, NULL, NULL, NULL),
(20, 'emp 1', 1, 'emp1@app.com', NULL, NULL, '$2y$10$qAhidSW.epEut9uzUIsoZ./gAnBvK.ImHxUoef4UIqZ7rGI7il47y', NULL, '!@###@$#@#@ASdasda', '2023-11-20 22:19:46', '2023-11-24 03:01:46', NULL, NULL, 1, 3, NULL, NULL, NULL),
(21, 'test comp4 admin', 4, 'comp4@app.com', NULL, NULL, '$2y$10$.A0IBij99.9RWbXgeHLvK.6hTw8KbU1sQnFu9/SAdVJ1so/akeIgG', NULL, NULL, '2023-11-22 00:50:14', '2023-11-26 18:42:11', NULL, NULL, 1, 2, NULL, NULL, NULL),
(22, 'ahmed com test 2', 5, 'companytest@app.com', NULL, NULL, '$2y$10$u0NTp.cUArhL5kI5tI0KgulTtmk2U5efhLkLstEwxo/8ujDl3c5lW', NULL, NULL, '2023-11-26 20:03:21', '2023-11-26 20:56:57', NULL, NULL, 1, 2, NULL, NULL, NULL),
(23, 'emp 2', 2, 'emp2@app.com', NULL, NULL, '$2y$10$D0y11w6/P6lwaoBpvKv/s.Q/y0saPHAVmVn4LFN6H4nb.z2qtvi/O', NULL, '!@###@$#@#@ASdasda', '2023-11-27 02:09:46', '2023-11-27 02:09:47', NULL, NULL, 0, 3, 'financial', NULL, NULL),
(24, 'accountant 1', NULL, 'accountant@piflow.com', NULL, NULL, '$2y$10$8xJ/CVC4CPYLyh2LTrrCbunUEv4CQKR/lXVccMuCn1Y19UNvJP2Da', NULL, NULL, '2023-12-02 13:16:09', '2023-12-02 13:33:41', NULL, NULL, 1, 4, NULL, NULL, NULL),
(29, 'emp 3', 2, 'emp3@app.com', NULL, NULL, '$2y$10$ATY.CkuFzuoCnLUs09oi5e5qWQXy7cYHryMcEDXdqc7v2v9Rn7Id6', NULL, '!@###@$#@#@ASdasda', '2023-12-03 19:10:04', '2023-12-03 19:10:04', NULL, NULL, 0, 3, 'financial', NULL, NULL),
(30, 'emp 4', 2, 'emp4@app.com', NULL, NULL, '$2y$10$tHTDy8kSLPT2dW5/er0OG.1QHQPBK8PY0e5uAEB.xXpYdvT.7oQC.', NULL, '!@###@$#@#@ASdasda', '2023-12-03 19:18:35', '2023-12-03 19:18:35', NULL, NULL, 0, 3, 'financial', NULL, NULL),
(32, 'test', NULL, 'tsestadmin@piflow.com', NULL, NULL, '$2y$10$ogYrZ1g/ubtMF34V4M6cdONHlFKLNR3zgHMy15jUpLuHr/dPt4v6C', NULL, NULL, '2023-12-03 19:48:42', '2023-12-03 19:49:00', NULL, NULL, 0, 1, NULL, NULL, NULL),
(39, 'emp 5', 2, 'emp5@app.com', NULL, NULL, '$2y$10$WyGxa3YfOY4iQ9eGNYde1.ohmL3NVg7iaiLIzEyV.X0.GtoYAo9xO', NULL, '!@###@$#@#@ASdasda', '2023-12-03 21:03:08', '2023-12-03 21:03:08', NULL, NULL, 0, 3, 'financial', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_emp`
--
ALTER TABLE `client_emp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_info`
--
ALTER TABLE `employee_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `justifications`
--
ALTER TABLE `justifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metrics`
--
ALTER TABLE `metrics`
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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pos`
--
ALTER TABLE `pos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_settings`
--
ALTER TABLE `social_settings`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `client_emp`
--
ALTER TABLE `client_emp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee_info`
--
ALTER TABLE `employee_info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `justifications`
--
ALTER TABLE `justifications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `metrics`
--
ALTER TABLE `metrics`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos`
--
ALTER TABLE `pos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_settings`
--
ALTER TABLE `social_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
