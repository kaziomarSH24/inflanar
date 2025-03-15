-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2025 at 02:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inflanar`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `about_image` varchar(255) DEFAULT NULL,
  `ceo_avatar` varchar(255) DEFAULT NULL,
  `ceo_signeture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `about_image`, `ceo_avatar`, `ceo_signeture`, `created_at`, `updated_at`) VALUES
(1, 'uploads/website-images/about-us-2023-08-24-07-03-53-5496.webp', 'uploads/website-images/ceo-avatar-2023-08-24-07-04-59-5415.webp', 'uploads/website-images/ceo-signature-2023-08-24-07-05-34-7018.webp', NULL, '2023-08-24 01:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `about_us_translations`
--

CREATE TABLE `about_us_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(10) NOT NULL,
  `about_us_id` int(11) NOT NULL,
  `header` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `description` longtext NOT NULL,
  `ceo_name` varchar(255) NOT NULL,
  `ceo_designation` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us_translations`
--

INSERT INTO `about_us_translations` (`id`, `lang_code`, `about_us_id`, `header`, `title`, `description`, `ceo_name`, `ceo_designation`, `created_at`, `updated_at`) VALUES
(1, 'en', 1, 'About Inflanar', 'Creative and First Problems Solving', '<p>Quisque tristique, ipsum dignissim dapibus elementum, nisi urna convallis est, ut lacinia elit orci vel felis. Suspendisse accumsan metus quis nibh sagittis as suscipit. Sed sit amet condimentum nulla. Quisque sed tincidunt ante.</p>\r\n<p>Suspendisse accumsan metus quis nibh sagittis as suscipit. Sed sit amet condimentum nulla. Quisque sed tincidunt ante.</p>', 'Sufankho Jhon', 'CEO of Inflanar', NULL, '2023-09-12 22:29:05'),
(28, 'ar', 1, 'حول إنفلانار', 'حل المشكلات الإبداعية والأولى', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"ltr\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">Quisque Tristique، ipsum dignissim dapibus elementum، nisi urna convallis est، ut lacinia elit orci vel felis. Suspendisse accumsan metus quis nibh sagittis as suscipit. سيد الجلوس أميت بهار نولا. Quisque sed tincidunt ante.\r\n</span></pre>', 'سوفانخو جون', 'الرئيس التنفيذي لشركة Inflanar', '2023-10-17 23:04:37', '2023-10-18 14:50:11');

-- --------------------------------------------------------

--
-- Table structure for table `additional_services`
--

CREATE TABLE `additional_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `additional_services`
--

INSERT INTO `additional_services` (`id`, `service_id`, `price`, `image`, `created_at`, `updated_at`) VALUES
(1, 11, 10.00, 'uploads/custom-images/add-service-2023-10-18-01-55-22-5142.jpg', '2023-10-17 19:55:22', '2023-10-17 19:55:22'),
(2, 11, 15.00, 'uploads/custom-images/add-service-2023-10-18-01-56-36-7524.jpg', '2023-10-17 19:56:36', '2023-10-17 19:56:36'),
(3, 11, 20.00, 'uploads/custom-images/add-service-2023-10-18-01-57-37-4747.jpg', '2023-10-17 19:57:37', '2023-10-17 19:57:37'),
(4, 10, 10.00, 'uploads/custom-images/add-service-2023-10-18-02-05-28-9608.jpg', '2023-10-17 20:02:31', '2023-10-17 20:05:28'),
(5, 10, 12.00, 'uploads/custom-images/add-service-2023-10-18-02-03-17-4767.jpg', '2023-10-17 20:03:17', '2023-10-17 20:03:17'),
(6, 10, 15.00, 'uploads/custom-images/add-service-2023-10-18-02-04-41-2394.jpg', '2023-10-17 20:04:41', '2023-10-17 20:04:41');

-- --------------------------------------------------------

--
-- Table structure for table `additional_service_translations`
--

CREATE TABLE `additional_service_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `additional_service_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `features` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `additional_service_translations`
--

INSERT INTO `additional_service_translations` (`id`, `lang_code`, `additional_service_id`, `title`, `features`, `created_at`, `updated_at`) VALUES
(1, 'en', 1, 'Glamour Transformation', '[\"10 Social Media Post\",\"Post Views 10K+\",\"Duration 3-4 Days\",\"Digital Marketing\",\"\"]', '2023-10-17 19:55:22', '2023-10-17 19:59:12'),
(2, 'en', 2, 'Personalized Workouts', '[\"10 Social Media Post\",\"Post Views 10K+\",\"Duration 3-4 Days\",\"Digital Marketing\",\"\"]', '2023-10-17 19:56:36', '2023-10-17 19:59:31'),
(3, 'en', 3, 'Stylish Workwear Picks', '[\"10 Social Media Post\",\"Post Views 10K+\",\"Duration 3-4 Days\",\"Digital Marketing\",\"\"]', '2023-10-17 19:57:37', '2023-10-17 19:59:48'),
(4, 'en', 4, 'Expert Makeup Artists', '[\"Digital Marketing\",\"Post Views 10K+\",\"10 Social Media Post\",\"Duration 3-4 Days\",\"\"]', '2023-10-17 20:02:31', '2023-10-17 20:05:28'),
(5, 'en', 5, 'Customized Training', '[\"Duration 3-4 Days\",\"10 Social Media Post\",\"Post Views 10K+\",\"Digital Marketing\"]', '2023-10-17 20:03:17', '2023-10-17 20:03:17'),
(6, 'en', 6, 'Electrical Expertise', '[\"Digital Marketing\",\"Duration 3-4 Days\",\"10 Social Media Post\",\"Post Views 10K+\"]', '2023-10-17 20:04:41', '2023-10-17 20:04:41'),
(7, 'ar', 1, 'Glamour Transformation', '[\"10 Social Media Post\",\"Post Views 10K+\",\"Duration 3-4 Days\",\"Digital Marketing\",\"\"]', '2023-10-17 23:04:38', '2023-10-17 23:04:38'),
(8, 'ar', 2, 'Personalized Workouts', '[\"10 Social Media Post\",\"Post Views 10K+\",\"Duration 3-4 Days\",\"Digital Marketing\",\"\"]', '2023-10-17 23:04:38', '2023-10-17 23:04:38'),
(9, 'ar', 3, 'Stylish Workwear Picks', '[\"10 Social Media Post\",\"Post Views 10K+\",\"Duration 3-4 Days\",\"Digital Marketing\",\"\"]', '2023-10-17 23:04:38', '2023-10-17 23:04:38'),
(10, 'ar', 4, 'Expert Makeup Artists', '[\"Digital Marketing\",\"Post Views 10K+\",\"10 Social Media Post\",\"Duration 3-4 Days\",\"\"]', '2023-10-17 23:04:38', '2023-10-17 23:04:38'),
(11, 'ar', 5, 'Customized Training', '[\"Duration 3-4 Days\",\"10 Social Media Post\",\"Post Views 10K+\",\"Digital Marketing\"]', '2023-10-17 23:04:38', '2023-10-17 23:04:38'),
(12, 'ar', 6, 'Electrical Expertise', '[\"Digital Marketing\",\"Duration 3-4 Days\",\"10 Social Media Post\",\"Post Views 10K+\"]', '2023-10-17 23:04:38', '2023-10-17 23:04:38');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin_type` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `about_me` text DEFAULT NULL,
  `facebook` text DEFAULT NULL,
  `twitter` text DEFAULT NULL,
  `linkedin` text DEFAULT NULL,
  `instagram` text DEFAULT NULL,
  `forget_password_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `image`, `email_verified_at`, `password`, `created_at`, `updated_at`, `admin_type`, `status`, `about_me`, `facebook`, `twitter`, `linkedin`, `instagram`, `forget_password_token`) VALUES
(1, 'John Doe', 'admin@gmail.com', 'uploads/website-images/john-doe-2024-02-07-08-39-17-1122.png', NULL, '$2y$10$gwCPsOqZ3afWZWLpUXMbs.umV/cA.ouwuJYy8FQ8ny/ueruTdaO.G', NULL, '2024-02-07 14:39:17', 1, 'active', 'Sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem our as repeat predefined chunks as the as necessliary, making this the first as true generator a 200 our asliatin words, combined with a handful of model sentence structures', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.linkedin.com', 'https://www.instagram.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `appointment_schedules`
--

CREATE TABLE `appointment_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `day` varchar(255) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price` decimal(8,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointment_schedules`
--

INSERT INTO `appointment_schedules` (`id`, `user_id`, `day`, `start_time`, `end_time`, `status`, `created_at`, `updated_at`, `price`) VALUES
(1, 2, 'Sunday', '09:00', '10:00', 1, '2023-10-17 18:03:16', '2023-10-17 18:03:16', 0.00),
(2, 2, 'Monday', '09:00', '10:00', 1, '2023-10-17 18:03:16', '2023-10-17 18:03:16', 0.00),
(3, 2, 'Tuesday', '09:00', '10:00', 1, '2023-10-17 18:03:16', '2023-10-17 18:03:16', 0.00),
(4, 2, 'Wednesday', '09:00', '10:00', 1, '2023-10-17 18:03:16', '2023-10-17 18:03:16', 0.00),
(5, 2, 'Thursday', '09:00', '10:00', 1, '2023-10-17 18:03:16', '2023-10-17 18:03:16', 0.00),
(6, 2, 'Friday', '09:00', '10:00', 1, '2023-10-17 18:03:17', '2023-10-17 18:03:17', 0.00),
(7, 2, 'Saturday', '09:00', '10:00', 1, '2023-10-17 18:03:17', '2023-10-17 18:03:17', 0.00),
(8, 2, 'Sunday', '10:00', '11:00', 1, '2023-10-17 18:03:29', '2023-10-17 18:03:29', 0.00),
(9, 2, 'Monday', '10:00', '11:00', 1, '2023-10-17 18:03:29', '2023-10-17 18:03:29', 0.00),
(10, 2, 'Tuesday', '10:00', '11:00', 1, '2023-10-17 18:03:29', '2023-10-17 18:03:29', 0.00),
(11, 2, 'Wednesday', '10:00', '11:00', 1, '2023-10-17 18:03:29', '2023-10-17 18:03:29', 0.00),
(12, 2, 'Thursday', '10:00', '11:00', 1, '2023-10-17 18:03:29', '2023-10-17 18:03:29', 0.00),
(13, 2, 'Friday', '10:00', '11:00', 1, '2023-10-17 18:03:29', '2023-10-17 18:03:29', 0.00),
(14, 2, 'Saturday', '10:00', '11:00', 1, '2023-10-17 18:03:29', '2023-10-17 18:03:29', 0.00),
(15, 2, 'Sunday', '11:00', '12:00', 1, '2023-10-17 18:03:53', '2023-10-17 18:03:53', 0.00),
(16, 2, 'Monday', '11:00', '12:00', 1, '2023-10-17 18:03:53', '2023-10-17 18:03:53', 0.00),
(17, 2, 'Tuesday', '11:00', '12:00', 1, '2023-10-17 18:03:53', '2023-10-17 18:03:53', 0.00),
(18, 2, 'Wednesday', '11:00', '12:00', 1, '2023-10-17 18:03:53', '2023-10-17 18:03:53', 0.00),
(19, 2, 'Thursday', '11:00', '12:00', 1, '2023-10-17 18:03:53', '2023-10-17 18:03:53', 0.00),
(20, 2, 'Friday', '11:00', '12:00', 1, '2023-10-17 18:03:54', '2023-10-17 18:03:54', 0.00),
(21, 2, 'Saturday', '11:00', '12:00', 1, '2023-10-17 18:03:54', '2023-10-17 18:03:54', 0.00),
(22, 2, 'Sunday', '12:00', '13:00', 1, '2023-10-17 18:04:11', '2023-10-17 18:04:11', 0.00),
(23, 2, 'Monday', '12:00', '13:00', 1, '2023-10-17 18:04:11', '2023-10-17 18:04:11', 0.00),
(24, 2, 'Tuesday', '12:00', '13:00', 1, '2023-10-17 18:04:11', '2023-10-17 18:04:11', 0.00),
(25, 2, 'Wednesday', '12:00', '13:00', 1, '2023-10-17 18:04:11', '2023-10-17 18:04:11', 0.00),
(26, 2, 'Thursday', '12:00', '13:00', 1, '2023-10-17 18:04:11', '2023-10-17 18:04:11', 0.00),
(27, 2, 'Friday', '12:00', '13:00', 1, '2023-10-17 18:04:11', '2023-10-17 18:04:11', 0.00),
(28, 2, 'Saturday', '12:00', '13:00', 1, '2023-10-17 18:04:11', '2023-10-17 18:04:11', 0.00),
(29, 3, 'Sunday', '09:00', '10:00', 1, '2023-10-17 18:18:24', '2023-10-17 18:18:24', 0.00),
(30, 3, 'Monday', '09:00', '10:00', 1, '2023-10-17 18:18:24', '2023-10-17 18:18:24', 0.00),
(31, 3, 'Tuesday', '09:00', '10:00', 1, '2023-10-17 18:18:24', '2023-10-17 18:18:24', 0.00),
(32, 3, 'Wednesday', '09:00', '10:00', 1, '2023-10-17 18:18:24', '2023-10-17 18:18:24', 0.00),
(33, 3, 'Thursday', '09:00', '10:00', 1, '2023-10-17 18:18:24', '2023-10-17 18:18:24', 0.00),
(34, 3, 'Friday', '09:00', '10:00', 1, '2023-10-17 18:18:24', '2023-10-17 18:18:24', 0.00),
(35, 3, 'Saturday', '09:00', '10:00', 1, '2023-10-17 18:18:24', '2023-10-17 18:18:24', 0.00),
(36, 3, 'Sunday', '10:00', '11:00', 1, '2023-10-17 18:18:35', '2023-10-17 18:18:35', 0.00),
(37, 3, 'Monday', '10:00', '11:00', 1, '2023-10-17 18:18:35', '2023-10-17 18:18:35', 0.00),
(38, 3, 'Tuesday', '10:00', '11:00', 1, '2023-10-17 18:18:35', '2023-10-17 18:18:35', 0.00),
(39, 3, 'Wednesday', '10:00', '11:00', 1, '2023-10-17 18:18:35', '2023-10-17 18:18:35', 0.00),
(40, 3, 'Thursday', '10:00', '11:00', 1, '2023-10-17 18:18:35', '2023-10-17 18:18:35', 0.00),
(41, 3, 'Friday', '10:00', '11:00', 1, '2023-10-17 18:18:35', '2023-10-17 18:18:35', 0.00),
(42, 3, 'Saturday', '10:00', '11:00', 1, '2023-10-17 18:18:35', '2023-10-17 18:18:35', 0.00),
(43, 3, 'Sunday', '11:00', '12:00', 1, '2023-10-17 18:18:45', '2023-10-17 18:18:45', 0.00),
(44, 3, 'Monday', '11:00', '12:00', 1, '2023-10-17 18:18:45', '2023-10-17 18:18:45', 0.00),
(45, 3, 'Tuesday', '11:00', '12:00', 1, '2023-10-17 18:18:45', '2023-10-17 18:18:45', 0.00),
(46, 3, 'Wednesday', '11:00', '12:00', 1, '2023-10-17 18:18:45', '2023-10-17 18:18:45', 0.00),
(47, 3, 'Thursday', '11:00', '12:00', 1, '2023-10-17 18:18:45', '2023-10-17 18:18:45', 0.00),
(48, 3, 'Friday', '11:00', '12:00', 1, '2023-10-17 18:18:45', '2023-10-17 18:18:45', 0.00),
(49, 3, 'Saturday', '11:00', '12:00', 1, '2023-10-17 18:18:45', '2023-10-17 18:18:45', 0.00),
(50, 3, 'Sunday', '12:00', '13:00', 1, '2023-10-17 18:18:55', '2023-10-17 18:18:55', 0.00),
(51, 3, 'Monday', '12:00', '13:00', 1, '2023-10-17 18:18:55', '2023-10-17 18:18:55', 0.00),
(52, 3, 'Tuesday', '12:00', '13:00', 1, '2023-10-17 18:18:55', '2023-10-17 18:18:55', 0.00),
(53, 3, 'Wednesday', '12:00', '13:00', 1, '2023-10-17 18:18:55', '2023-10-17 18:18:55', 0.00),
(54, 3, 'Thursday', '12:00', '13:00', 1, '2023-10-17 18:18:55', '2023-10-17 18:18:55', 0.00),
(55, 3, 'Friday', '12:00', '13:00', 1, '2023-10-17 18:18:55', '2023-10-17 18:18:55', 0.00),
(56, 3, 'Saturday', '12:00', '13:00', 1, '2023-10-17 18:18:55', '2023-10-17 18:18:55', 0.00),
(57, 4, 'Sunday', '09:00', '10:01', 1, '2023-10-17 19:36:48', '2023-10-17 19:36:48', 0.00),
(58, 4, 'Monday', '09:00', '10:01', 1, '2023-10-17 19:36:48', '2023-10-17 19:36:48', 0.00),
(59, 4, 'Tuesday', '09:00', '10:01', 1, '2023-10-17 19:36:48', '2023-10-17 19:36:48', 0.00),
(60, 4, 'Wednesday', '09:00', '10:01', 1, '2023-10-17 19:36:48', '2023-10-17 19:36:48', 0.00),
(61, 4, 'Thursday', '09:00', '10:01', 1, '2023-10-17 19:36:48', '2023-10-17 19:36:48', 0.00),
(62, 4, 'Friday', '09:00', '10:01', 1, '2023-10-17 19:36:48', '2023-10-17 19:36:48', 0.00),
(63, 4, 'Saturday', '09:00', '10:01', 1, '2023-10-17 19:36:48', '2023-10-17 19:36:48', 0.00),
(64, 4, 'Sunday', '10:00', '11:00', 1, '2023-10-17 19:36:58', '2023-10-17 19:36:58', 0.00),
(65, 4, 'Monday', '10:00', '11:00', 1, '2023-10-17 19:36:58', '2023-10-17 19:36:58', 0.00),
(66, 4, 'Tuesday', '10:00', '11:00', 1, '2023-10-17 19:36:58', '2023-10-17 19:36:58', 0.00),
(67, 4, 'Wednesday', '10:00', '11:00', 1, '2023-10-17 19:36:58', '2023-10-17 19:36:58', 0.00),
(68, 4, 'Thursday', '10:00', '11:00', 1, '2023-10-17 19:36:58', '2023-10-17 19:36:58', 0.00),
(69, 4, 'Friday', '10:00', '11:00', 1, '2023-10-17 19:36:58', '2023-10-17 19:36:58', 0.00),
(70, 4, 'Saturday', '10:00', '11:00', 1, '2023-10-17 19:36:58', '2023-10-17 19:36:58', 0.00),
(71, 4, 'Sunday', '11:00', '12:00', 1, '2023-10-17 19:37:09', '2023-10-17 19:37:09', 0.00),
(72, 4, 'Monday', '11:00', '12:00', 1, '2023-10-17 19:37:09', '2023-10-17 19:37:09', 0.00),
(73, 4, 'Tuesday', '11:00', '12:00', 1, '2023-10-17 19:37:09', '2023-10-17 19:37:09', 0.00),
(74, 4, 'Wednesday', '11:00', '12:00', 1, '2023-10-17 19:37:09', '2023-10-17 19:37:09', 0.00),
(75, 4, 'Thursday', '11:00', '12:00', 1, '2023-10-17 19:37:09', '2023-10-17 19:37:09', 0.00),
(76, 4, 'Friday', '11:00', '12:00', 1, '2023-10-17 19:37:09', '2023-10-17 19:37:09', 0.00),
(77, 4, 'Saturday', '11:00', '12:00', 1, '2023-10-17 19:37:09', '2023-10-17 19:37:09', 0.00),
(78, 4, 'Sunday', '12:00', '13:00', 1, '2023-10-17 19:37:20', '2023-10-17 19:37:20', 0.00),
(79, 4, 'Monday', '12:00', '13:00', 1, '2023-10-17 19:37:20', '2023-10-17 19:37:20', 0.00),
(80, 4, 'Tuesday', '12:00', '13:00', 1, '2023-10-17 19:37:20', '2023-10-17 19:37:20', 0.00),
(81, 4, 'Wednesday', '12:00', '13:00', 1, '2023-10-17 19:37:20', '2023-10-17 19:37:20', 0.00),
(82, 4, 'Thursday', '12:00', '13:00', 1, '2023-10-17 19:37:20', '2023-10-17 19:37:20', 0.00),
(83, 4, 'Friday', '12:00', '13:00', 1, '2023-10-17 19:37:20', '2023-10-17 19:37:20', 0.00),
(84, 4, 'Saturday', '12:00', '13:00', 1, '2023-10-17 19:37:20', '2023-10-17 19:37:20', 0.00),
(85, 1, 'Sunday', '09:00', '10:00', 1, '2023-10-17 19:39:08', '2023-10-17 19:39:08', 0.00),
(86, 1, 'Monday', '09:00', '10:00', 1, '2023-10-17 19:39:08', '2023-10-17 19:39:08', 0.00),
(87, 1, 'Tuesday', '09:00', '10:00', 1, '2023-10-17 19:39:08', '2023-10-17 19:39:08', 0.00),
(88, 1, 'Wednesday', '09:00', '10:00', 1, '2023-10-17 19:39:08', '2023-10-17 19:39:08', 0.00),
(89, 1, 'Thursday', '09:00', '10:00', 1, '2023-10-17 19:39:08', '2023-10-17 19:39:08', 0.00),
(90, 1, 'Friday', '09:00', '10:00', 1, '2023-10-17 19:39:08', '2023-10-17 19:39:08', 0.00),
(91, 1, 'Saturday', '09:00', '10:00', 1, '2023-10-17 19:39:08', '2023-10-17 19:39:08', 0.00),
(92, 1, 'Sunday', '10:00', '11:00', 1, '2023-10-17 19:39:19', '2023-10-17 19:39:19', 0.00),
(93, 1, 'Monday', '10:00', '11:00', 1, '2023-10-17 19:39:19', '2023-10-17 19:39:19', 0.00),
(94, 1, 'Tuesday', '10:00', '11:00', 1, '2023-10-17 19:39:19', '2023-10-17 19:39:19', 0.00),
(95, 1, 'Wednesday', '10:00', '11:00', 1, '2023-10-17 19:39:19', '2023-10-17 19:39:19', 0.00),
(96, 1, 'Thursday', '10:00', '11:00', 1, '2023-10-17 19:39:19', '2023-10-17 19:39:19', 0.00),
(97, 1, 'Friday', '10:00', '11:00', 1, '2023-10-17 19:39:19', '2023-10-17 19:39:19', 0.00),
(98, 1, 'Saturday', '10:00', '11:00', 1, '2023-10-17 19:39:19', '2023-10-17 19:39:19', 0.00),
(99, 1, 'Sunday', '11:00', '12:00', 1, '2023-10-17 19:39:29', '2023-10-17 19:39:29', 0.00),
(100, 1, 'Monday', '11:00', '12:00', 1, '2023-10-17 19:39:29', '2023-10-17 19:39:29', 0.00),
(101, 1, 'Tuesday', '11:00', '12:00', 1, '2023-10-17 19:39:29', '2023-10-17 19:39:29', 0.00),
(102, 1, 'Wednesday', '11:00', '12:00', 1, '2023-10-17 19:39:29', '2023-10-17 19:39:29', 0.00),
(103, 1, 'Thursday', '11:00', '12:00', 1, '2023-10-17 19:39:29', '2023-10-17 19:39:29', 0.00),
(104, 1, 'Friday', '11:00', '12:00', 1, '2023-10-17 19:39:30', '2023-10-17 19:39:30', 0.00),
(105, 1, 'Saturday', '11:00', '12:00', 1, '2023-10-17 19:39:30', '2023-10-17 19:39:30', 0.00),
(106, 1, 'Sunday', '12:00', '13:00', 1, '2023-10-17 19:39:43', '2023-10-17 19:39:43', 0.00),
(107, 1, 'Monday', '12:00', '13:00', 1, '2023-10-17 19:39:43', '2023-10-17 19:39:43', 0.00),
(108, 1, 'Tuesday', '12:00', '13:00', 1, '2023-10-17 19:39:43', '2023-10-17 19:39:43', 0.00),
(109, 1, 'Wednesday', '12:00', '13:00', 1, '2023-10-17 19:39:43', '2023-10-17 19:39:43', 0.00),
(110, 1, 'Thursday', '12:00', '13:00', 1, '2023-10-17 19:39:43', '2023-10-17 19:39:43', 0.00),
(111, 1, 'Friday', '12:00', '13:00', 1, '2023-10-17 19:39:43', '2023-10-17 19:39:43', 0.00),
(112, 1, 'Saturday', '12:00', '13:00', 1, '2023-10-17 19:39:43', '2023-10-17 19:39:43', 0.00),
(113, 1, 'Sunday', '13:00', '14:01', 1, '2023-10-17 19:39:53', '2023-10-17 19:39:53', 0.00),
(114, 1, 'Sunday', '14:00', '15:00', 1, '2023-10-17 19:40:17', '2023-10-17 19:40:17', 0.00),
(115, 1, 'Monday', '14:00', '15:00', 1, '2023-10-17 19:40:17', '2023-10-17 19:40:17', 0.00),
(116, 1, 'Tuesday', '14:00', '15:00', 1, '2023-10-17 19:40:17', '2023-10-17 19:40:17', 0.00),
(117, 1, 'Wednesday', '14:00', '15:00', 1, '2023-10-17 19:40:17', '2023-10-17 19:40:17', 0.00),
(118, 1, 'Thursday', '14:00', '15:00', 1, '2023-10-17 19:40:17', '2023-10-17 19:40:17', 0.00),
(119, 1, 'Friday', '14:00', '15:00', 1, '2023-10-17 19:40:17', '2023-10-17 19:40:17', 0.00),
(120, 1, 'Saturday', '14:00', '15:00', 1, '2023-10-17 19:40:17', '2023-10-17 19:40:17', 0.00),
(121, 1, 'Sunday', '15:00', '16:00', 1, '2023-10-17 19:40:39', '2023-10-17 19:40:39', 0.00),
(122, 1, 'Monday', '15:00', '16:00', 1, '2023-10-17 19:40:39', '2023-10-17 19:40:39', 0.00),
(123, 1, 'Tuesday', '15:00', '16:00', 1, '2023-10-17 19:40:39', '2023-10-17 19:40:39', 0.00),
(124, 1, 'Wednesday', '15:00', '16:00', 1, '2023-10-17 19:40:39', '2023-10-17 19:40:39', 0.00),
(125, 1, 'Thursday', '15:00', '16:00', 1, '2023-10-17 19:40:39', '2023-10-17 19:40:39', 0.00),
(126, 1, 'Friday', '15:00', '16:00', 1, '2023-10-17 19:40:39', '2023-10-17 19:40:39', 0.00),
(127, 1, 'Saturday', '15:00', '16:00', 1, '2023-10-17 19:40:40', '2024-06-01 18:16:59', 10.00),
(128, 1, 'Sunday', '10:00', '11:00', 1, '2024-06-01 18:14:54', '2024-06-01 18:14:54', 50.00),
(129, 21, 'Sunday', '10:30', '12:30', 1, '2025-02-04 13:18:59', '2025-02-04 13:18:59', 0.00),
(130, 21, 'Monday', '10:30', '12:30', 1, '2025-02-04 13:18:59', '2025-02-04 13:18:59', 0.00),
(131, 21, 'Tuesday', '10:30', '12:30', 1, '2025-02-04 13:18:59', '2025-02-04 13:18:59', 0.00),
(132, 21, 'Wednesday', '10:30', '12:30', 1, '2025-02-04 13:18:59', '2025-02-04 13:18:59', 0.00),
(133, 21, 'Thursday', '10:30', '12:30', 1, '2025-02-04 13:18:59', '2025-02-04 13:18:59', 0.00),
(134, 21, 'Friday', '10:30', '12:30', 1, '2025-02-04 13:18:59', '2025-02-04 13:18:59', 0.00),
(135, 21, 'Saturday', '10:30', '12:30', 1, '2025-02-04 13:18:59', '2025-02-04 13:18:59', 0.00),
(136, 26, 'Sunday', '10:30', '12:30', 1, '2025-02-10 03:34:10', '2025-02-10 03:34:10', 0.00),
(137, 26, 'Monday', '10:30', '12:30', 1, '2025-02-10 03:34:10', '2025-02-10 03:34:10', 0.00),
(138, 26, 'Tuesday', '10:30', '12:30', 1, '2025-02-10 03:34:10', '2025-02-10 03:34:10', 0.00),
(139, 26, 'Wednesday', '10:30', '12:30', 1, '2025-02-10 03:34:10', '2025-02-10 03:34:10', 0.00),
(140, 26, 'Thursday', '10:30', '12:30', 1, '2025-02-10 03:34:10', '2025-02-10 03:34:10', 0.00),
(141, 26, 'Friday', '10:30', '12:30', 1, '2025-02-10 03:34:10', '2025-02-10 03:34:10', 0.00),
(142, 26, 'Saturday', '10:30', '12:30', 1, '2025-02-10 03:34:10', '2025-02-10 03:34:10', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `bank_payments`
--

CREATE TABLE `bank_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `account_info` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_payments`
--

INSERT INTO `bank_payments` (`id`, `status`, `account_info`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bank Name: Your bank name\r\nAccount Number:  Your bank account number\r\nRouting Number: Your bank routing number\r\nBranch: Your bank branch name', 'uploads/website-images/bank-2023-09-28-08-44-07-4272.jpg', NULL, '2023-09-28 02:44:07');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` int(11) NOT NULL DEFAULT 0,
  `slug` text NOT NULL,
  `blog_category_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `show_homepage` varchar(255) NOT NULL DEFAULT 'no',
  `is_popular` varchar(255) NOT NULL DEFAULT 'no',
  `tags` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `admin_id`, `slug`, `blog_category_id`, `image`, `views`, `status`, `show_homepage`, `is_popular`, `tags`, `created_at`, `updated_at`) VALUES
(1, 1, 'hire-top-influencers-for-maximum-impact', 1, 'uploads/custom-images/blog--2023-10-15-11-42-42-4785.webp', 0, 1, 'yes', 'yes', '[{\"value\":\"Campaign\"},{\"value\":\"inlfuencer\"},{\"value\":\"marketing\"}]', '2023-10-15 17:42:43', '2023-10-15 17:42:43'),
(2, 1, 'how-brands-can-break-barriers-empo', 2, 'uploads/custom-images/blog--2023-10-15-11-48-20-1406.webp', 0, 1, 'yes', 'yes', '[{\"value\":\"social media\"},{\"value\":\"twitter\"},{\"value\":\"facebook\"},{\"value\":\"linkedion\"}]', '2023-10-15 17:48:20', '2023-10-15 17:48:20'),
(3, 1, 'influencer-is-a-real-the-job-its-time-to-act', 1, 'uploads/custom-images/blog--2023-10-15-11-50-31-4002.webp', 0, 1, 'yes', 'yes', '[{\"value\":\"influencer\"},{\"value\":\"marketing\"},{\"value\":\"hiring influencer\"}]', '2023-10-15 17:50:31', '2023-10-15 17:50:31'),
(4, 1, '90-social-as-media-influencers', 3, 'uploads/custom-images/blog--2023-10-15-11-52-16-1318.webp', 0, 1, 'yes', 'yes', '[{\"value\":\"social media\"},{\"value\":\"tiktok\"},{\"value\":\"trending topic\"},{\"value\":\"hiring\"}]', '2023-10-15 17:52:16', '2023-10-15 17:52:16'),
(5, 1, 'influencer-engagement-everything-you', 4, 'uploads/custom-images/blog--2023-10-15-11-56-31-4150.webp', 0, 1, 'no', 'no', '[{\"value\":\"facebook\"},{\"value\":\"twitter\"},{\"value\":\"influencer\"},{\"value\":\"trending topic\"}]', '2023-10-15 17:56:31', '2023-10-15 17:56:31'),
(6, 1, '7-types-of-influencer-marketing-campaigns', 6, 'uploads/custom-images/blog--2023-10-16-12-05-04-2181.webp', 0, 1, 'no', 'no', '[{\"value\":\"facebook\"},{\"value\":\"influencer\"},{\"value\":\"marketing\"},{\"value\":\"hiring\"}]', '2023-10-15 18:05:04', '2023-10-15 18:05:04'),
(7, 1, 'establishing-a-content-marketing-strategy', 8, 'uploads/custom-images/blog--2023-10-16-12-22-18-9276.webp', 0, 1, 'no', 'no', '[{\"value\":\"marketing\"},{\"value\":\"influencer\"},{\"value\":\"hirging\"}]', '2023-10-15 18:22:18', '2023-10-15 18:22:18'),
(8, 1, 'excited-and-audience-watching-confetti', 8, 'uploads/custom-images/blog--2023-10-16-12-24-39-7203.webp', 0, 1, 'no', 'no', '[{\"value\":\"hiring influencer\"},{\"value\":\"social meida\"},{\"value\":\"facebook\"},{\"value\":\"twitter\"}]', '2023-10-15 18:24:39', '2023-10-15 18:24:39'),
(9, 1, 'discover-influencer-marketing-success', 2, 'uploads/custom-images/blog--2023-10-16-12-25-53-4981.webp', 0, 1, 'no', 'no', '[{\"value\":\"tiktok\"},{\"value\":\"social meida\"},{\"value\":\"trending video\"}]', '2023-10-15 18:25:53', '2023-10-15 18:25:53'),
(10, 1, 'influencer-marketing-made-simple', 2, 'uploads/custom-images/blog--2023-10-16-12-27-37-2496.webp', 0, 1, 'no', 'no', '[{\"value\":\"social meida\"},{\"value\":\"facebook\"},{\"value\":\"influencer\"},{\"value\":\"treding video\"}]', '2023-10-15 18:27:37', '2023-10-15 18:27:37');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'fashion', 1, '2023-10-15 17:36:58', '2023-10-15 17:36:58'),
(2, 'sport-fitness', 1, '2023-10-15 17:37:14', '2023-10-15 17:37:14'),
(3, 'parenting', 1, '2023-10-15 17:37:24', '2023-10-15 17:37:24'),
(4, 'life-style', 1, '2023-10-15 17:37:34', '2023-10-15 17:37:34'),
(5, 'beauty', 1, '2023-10-15 17:37:42', '2023-10-15 17:37:42'),
(6, 'vloggers', 1, '2023-10-15 17:37:52', '2023-10-15 17:37:52'),
(7, 'photography', 1, '2023-10-15 17:38:03', '2023-10-15 17:38:03'),
(8, 'travel', 1, '2023-10-15 17:38:12', '2023-10-15 17:38:12');

-- --------------------------------------------------------

--
-- Table structure for table `blog_category_translations`
--

CREATE TABLE `blog_category_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `blog_category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_category_translations`
--

INSERT INTO `blog_category_translations` (`id`, `lang_code`, `blog_category_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'en', 1, 'Fashion', '2023-10-15 17:36:59', '2023-10-15 17:36:59'),
(2, 'en', 2, 'Sport & Fitness', '2023-10-15 17:37:14', '2023-10-15 17:37:14'),
(3, 'en', 3, 'Parenting', '2023-10-15 17:37:24', '2023-10-15 17:37:24'),
(4, 'en', 4, 'Life Style', '2023-10-15 17:37:34', '2023-10-15 17:37:34'),
(5, 'en', 5, 'Beauty', '2023-10-15 17:37:42', '2023-10-15 17:37:42'),
(6, 'en', 6, 'Vloggers', '2023-10-15 17:37:52', '2023-10-15 17:37:52'),
(7, 'en', 7, 'Photography', '2023-10-15 17:38:03', '2023-10-15 17:38:03'),
(8, 'en', 8, 'Travel', '2023-10-15 17:38:12', '2023-10-15 17:38:12'),
(9, 'ar', 1, 'موضة', '2023-10-17 23:04:37', '2023-10-18 15:34:13'),
(10, 'ar', 2, 'الرياضة واللياقة البدنية', '2023-10-17 23:04:37', '2023-10-18 15:34:24'),
(11, 'ar', 3, 'الأبوة والأمومة', '2023-10-17 23:04:37', '2023-10-18 15:34:35'),
(12, 'ar', 4, 'نمط الحياة', '2023-10-17 23:04:37', '2023-10-18 15:34:48'),
(13, 'ar', 5, 'جمال', '2023-10-17 23:04:37', '2023-10-18 15:34:59'),
(14, 'ar', 6, 'مدونو الفيديو', '2023-10-17 23:04:37', '2023-10-18 15:35:12'),
(15, 'ar', 7, 'التصوير', '2023-10-17 23:04:37', '2023-10-18 15:35:23'),
(16, 'ar', 8, 'يسافر', '2023-10-17 23:04:37', '2023-10-18 15:35:37');

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `comment` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_comments`
--

INSERT INTO `blog_comments` (`id`, `blog_id`, `name`, `email`, `phone`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'John Doe', 'user@gmail.com', NULL, 'Suspendisse a ornare lacus, id ultricies sapien. Morbi ac consequat orci, vitae imperdiet mi. Curabitur dapibus erat orci, sit amet maximus nulla consequat non.', 1, '2023-10-15 20:02:20', '2023-10-15 20:02:44'),
(2, 4, 'David Richard', 'user@gmail.com', NULL, 'Ipsum volumus pertinax mea ut, eu erat tacimates nam. Tibique copiosae verterem mea no, eam ex melius option, soluta timeam et his. Sit simul gubergren reformidans id, amet minimum nominavi eos ea. Et augue dicta vix. Mea ne utamur referrentur.', 1, '2023-10-15 20:02:56', '2023-10-15 20:03:03'),
(3, 10, 'John Doe', 'user@gmail.com', NULL, 'Ipsum volumus pertinax mea ut, eu erat tacimates nam. Tibique copiosae verterem mea no, eam ex melius option, soluta timeam et his. Sit simul gubergren reformidans id, amet minimum nominavi eos ea. Et augue dicta vix. Mea ne utamur referrentur.', 1, '2023-10-15 20:03:54', '2023-10-15 20:04:14'),
(4, 10, 'Robert James', 'rabbit@gmail.com', NULL, 'Ipsum volumus pertinax mea ut, eu erat tacimates nam. Tibique copiosae verterem mea no, eam ex melius option, soluta timeam et his. Sit simul gubergren reformidans id, amet minimum nominavi eos ea. Et augue dicta vix. Mea ne utamur referrentur.', 1, '2023-10-15 20:04:06', '2023-10-15 20:04:13'),
(5, 9, 'David Miller', 'david@gmail.com', NULL, 'Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.', 1, '2023-10-15 20:05:49', '2023-10-15 20:06:18'),
(6, 9, 'David Simmons', 'david100@gmail.com', NULL, 'Ad duis fugit dictas mea, et cum stet oratio cetero. Ne pri omittam fastidii. No per harum dicant neglegentur, sea ei esse volumus adolescens. Nulla argumentum at pri, vel apeirian principes in. An dicam dicant consul mea, ne per option appetere argumentum, vim legere senserit et.', 1, '2023-10-15 20:06:12', '2023-10-15 20:06:17');

-- --------------------------------------------------------

--
-- Table structure for table `blog_translations`
--

CREATE TABLE `blog_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` int(11) NOT NULL DEFAULT 0,
  `lang_code` varchar(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `seo_title` text NOT NULL,
  `seo_description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_translations`
--

INSERT INTO `blog_translations` (`id`, `blog_id`, `lang_code`, `title`, `description`, `seo_title`, `seo_description`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Hire Top Influencers for Maximum Impact', '<p>Pri tempor appareat no, eruditi repudiandae vix at. Eos at brute omnesque voluptaria, facer putent intellegam eu pri. Mei debitis ullamcorper eu, at quo idque mundi. Vis in suas porro consequat, nec ad dolor adversarium, ut praesent cotidieque sit. Veniam civibus omittantur duo ut, te his alterum complectitur. Mea omnis oratio impedit ne.</p>\r\n<p>Ut qui eligendi urbanitas. Assum periculis te mel, libris quidam te sit. Qui nisl nemore eleifend id, in illud ullum sea. Ut nusquam sapientem comprehensam ius. His molestie complectitur ex.</p>\r\n<p>Ei usu malis aeque efficiantur. Mazim dolor denique duo ad, augue ornatus sententiae vel at, duo id sumo vulputate. His legimus assueverit ut, commune maluisset deterruisset id mel. Oblique volumus eos ut, quo autem posidonium definitiones cu. Cu usu lorem consul concludaturque, pro ea fuisset consectetuer. Ex aeterno forensibus has, dicta propriae est ei, ex alterum apeirian quo.</p>\r\n<p>Meliore inimicus duo ut, tation veritus elaboraret eam cu. Cum in alii agam aliquip, aperiam salutandi et per. Ex vis summo probatus ocurreret, ex assum sententiae pri, blandit sensibus moderatius ei eos. Vix nobis phaedrum neglegentur et.</p>\r\n<p>Sit vivendum eleifend adipiscing ea. Modus legere suscipiantur an vel, melius patrioque est cu, eum at audire probatus repudiandae. Ei tempor definitiones eam, sea dico omnium ne. Eam ad ubique tincidunt elaboraret, malis aperiri sit et. Ut quo vero inimicus. Sed at munere fuisset noluisse, eleifend senserit an vix.</p>\r\n<p>Sint dignissim consectetuer nec et, per ad probatus referrentur, vel cu consequat sententiae. Ad duis fugit dictas mea, et cum stet oratio cetero. Ne pri omittam fastidii. No per harum dicant neglegentur, sea ei esse volumus adolescens. Nulla argumentum at pri, vel apeirian principes in. An dicam dicant consul mea, ne per option appetere argumentum, vim legere senserit et.</p>', 'Hire Top Influencers for Maximum Impact', 'Hire Top Influencers for Maximum Impact', '2023-10-15 17:42:43', '2023-10-15 17:42:43'),
(2, 2, 'en', 'How Brands Can Break Barriers Empo', '<p>Doming aliquid te pro. Mei et quodsi ornatus praesent, summo debet vis eu, dolor soleat nostrud sea eu. Cu altera possim sanctus est. Ea iriure repudiandae per, no eam legendos consectetuer. Mel at justo doming voluptatum. Mel mentitum fabellas deserunt no, et duo amet unum appetere.</p>\r\n<p>Nec in rebum primis causae. Affert iisque ex pri, vis utinam vivendo definitionem ad, nostrum omnesque per et. Omnium antiopam cotidieque cu sit. Id pri placerat voluptatum, vero dicunt dissentiunt eum et, adhuc iisque vis no. Eu suavitate contentiones definitionem mel, ex vide insolens ocurreret eam. Et dico blandit mea. Sea tollit vidisse mandamus te, qui movet efficiendi ex.</p>\r\n<p>Ut qui eligendi urbanitas. Assum periculis te mel, libris quidam te sit. Qui nisl nemore eleifend id, in illud ullum sea. Ut nusquam sapientem comprehensam ius. His molestie complectitur ex.</p>\r\n<p>In vim natum soleat nostro, pri in eloquentiam contentiones. Eu sit sapientem reprehendunt, omnis aliquid eu eos. No quot illum veniam est, ne pro iudico saperet mnesarchum. Ea pri nostro disputando contentiones, eu nec menandri qualisque, vis ex equidem invidunt. Et accusam detracto splendide per, congue meliore id sea. Has eu aeterno patrioque expetendis, mel ei dissentiet reformidans.</p>\r\n<p>Meliore inimicus duo ut, tation veritus elaboraret eam cu. Cum in alii agam aliquip, aperiam salutandi et per. Ex vis summo probatus ocurreret, ex assum sententiae pri, blandit sensibus moderatius ei eos. Vix nobis phaedrum neglegentur et.</p>', 'How Brands Can Break Barriers Empo', 'How Brands Can Break Barriers Empo', '2023-10-15 17:48:20', '2023-10-15 17:48:20'),
(3, 3, 'en', 'Influencer Is a Real the Job It\'s Time to Act', '<p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p>\r\n<p>Sint dignissim consectetuer nec et, per ad probatus referrentur, vel cu consequat sententiae. Ad duis fugit dictas mea, et cum stet oratio cetero. Ne pri omittam fastidii. No per harum dicant neglegentur, sea ei esse volumus adolescens. Nulla argumentum at pri, vel apeirian principes in. An dicam dicant consul mea, ne per option appetere argumentum, vim legere senserit et.</p>\r\n<p>Usu ad solet diceret, usu at appetere percipit appellantur, te est primis audire gloriatur. Scripta noluisse no mel, vis ne decore ridens labitur. Stet erant saepe eu mea. An mel dolore salutandi abhorreant. An quo aliquip maluisset, mea quaeque indoctum in, pro augue veritus praesent te.</p>\r\n<p>Vim et alterum ornatus vivendum, ut mea solum repudiare. His etiam delenit tibique no, ad harum omnes scribentur qui, ne wisi detracto his. Ei movet accusam pri. Ex vel diam quas urbanitas, ne has velit affert habemus. At quis nonumy disputando nec, falli scaevola vel ea. Omittantur concludaturque nam eu, ex est vocent virtute.</p>\r\n<p>Sit vivendum eleifend adipiscing ea. Modus legere suscipiantur an vel, melius patrioque est cu, eum at audire probatus repudiandae. Ei tempor definitiones eam, sea dico omnium ne. Eam ad ubique tincidunt elaboraret, malis aperiri sit et. Ut quo vero inimicus. Sed at munere fuisset noluisse, eleifend senserit an vix.</p>\r\n<p>Ipsum volumus pertinax mea ut, eu erat tacimates nam. Tibique copiosae verterem mea no, eam ex melius option, soluta timeam et his. Sit simul gubergren reformidans id, amet minimum nominavi eos ea. Et augue dicta vix. Mea ne utamur referrentur.</p>\r\n<p>Id est maiorum volutpat, ad nominavi suscipit suscipiantur vix. Ut ius veri aperiam reprehendunt. Ut per unum sapientem consequuntur, usu ut quot scripta. Sea te nisl expetenda, ad quo congue argumentum, sit quis simul accusam cu. Usu ei perfecto repudiare tincidunt, ut quas malis erant vim. An mel vidit iudicabit.</p>', 'Influencer Is a Real the Job It\'s Time to Act', 'Influencer Is a Real the Job It\'s Time to Act', '2023-10-15 17:50:31', '2023-10-15 17:50:31'),
(4, 4, 'en', '90% Social as Media Influencers', '<p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p>\r\n<p>Sint dignissim consectetuer nec et, per ad probatus referrentur, vel cu consequat sententiae. Ad duis fugit dictas mea, et cum stet oratio cetero. Ne pri omittam fastidii. No per harum dicant neglegentur, sea ei esse volumus adolescens. Nulla argumentum at pri, vel apeirian principes in. An dicam dicant consul mea, ne per option appetere argumentum, vim legere senserit et.</p>\r\n<p>Usu ad solet diceret, usu at appetere percipit appellantur, te est primis audire gloriatur. Scripta noluisse no mel, vis ne decore ridens labitur. Stet erant saepe eu mea. An mel dolore salutandi abhorreant. An quo aliquip maluisset, mea quaeque indoctum in, pro augue veritus praesent te.</p>\r\n<p>Vim et alterum ornatus vivendum, ut mea solum repudiare. His etiam delenit tibique no, ad harum omnes scribentur qui, ne wisi detracto his. Ei movet accusam pri. Ex vel diam quas urbanitas, ne has velit affert habemus. At quis nonumy disputando nec, falli scaevola vel ea. Omittantur concludaturque nam eu, ex est vocent virtute.</p>\r\n<p>Sit vivendum eleifend adipiscing ea. Modus legere suscipiantur an vel, melius patrioque est cu, eum at audire probatus repudiandae. Ei tempor definitiones eam, sea dico omnium ne. Eam ad ubique tincidunt elaboraret, malis aperiri sit et. Ut quo vero inimicus. Sed at munere fuisset noluisse, eleifend senserit an vix.</p>\r\n<p>Ipsum volumus pertinax mea ut, eu erat tacimates nam. Tibique copiosae verterem mea no, eam ex melius option, soluta timeam et his. Sit simul gubergren reformidans id, amet minimum nominavi eos ea. Et augue dicta vix. Mea ne utamur referrentur.</p>\r\n<p>Id est maiorum volutpat, ad nominavi suscipit suscipiantur vix. Ut ius veri aperiam reprehendunt. Ut per unum sapientem consequuntur, usu ut quot scripta. Sea te nisl expetenda, ad quo congue argumentum, sit quis simul accusam cu. Usu ei perfecto repudiare tincidunt, ut quas malis erant vim. An mel vidit iudicabit.</p>', '90% Social as Media Influencers', '90% Social as Media Influencers', '2023-10-15 17:52:16', '2023-10-15 17:52:16'),
(5, 5, 'en', 'Influencer engagement everything you', '<p>Sint dignissim consectetuer nec et, per ad probatus referrentur, vel cu consequat sententiae. Ad duis fugit dictas mea, et cum stet oratio cetero. Ne pri omittam fastidii. No per harum dicant neglegentur, sea ei esse volumus adolescens. Nulla argumentum at pri, vel apeirian principes in. An dicam dicant consul mea, ne per option appetere argumentum, vim legere senserit et.</p>\r\n<p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p>\r\n<p>Id est maiorum volutpat, ad nominavi suscipit suscipiantur vix. Ut ius veri aperiam reprehendunt. Ut per unum sapientem consequuntur, usu ut quot scripta. Sea te nisl expetenda, ad quo congue argumentum, sit quis simul accusam cu. Usu ei perfecto repudiare tincidunt, ut quas malis erant vim. An mel vidit iudicabit.</p>\r\n<p>In vim natum soleat nostro, pri in eloquentiam contentiones. Eu sit sapientem reprehendunt, omnis aliquid eu eos. No quot illum veniam est, ne pro iudico saperet mnesarchum. Ea pri nostro disputando contentiones, eu nec menandri qualisque, vis ex equidem invidunt. Et accusam detracto splendide per, congue meliore id sea. Has eu aeterno patrioque expetendis, mel ei dissentiet reformidans.</p>\r\n<p>Pri tempor appareat no, eruditi repudiandae vix at. Eos at brute omnesque voluptaria, facer putent intellegam eu pri. Mei debitis ullamcorper eu, at quo idque mundi. Vis in suas porro consequat, nec ad dolor adversarium, ut praesent cotidieque sit. Veniam civibus omittantur duo ut, te his alterum complectitur. Mea omnis oratio impedit ne.</p>\r\n<p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p>', 'Influencer engagement everything you', 'Influencer engagement everything you', '2023-10-15 17:56:31', '2023-10-15 17:56:31'),
(6, 6, 'en', '7 types of influencer marketing campaigns', '<p>Sint dignissim consectetuer nec et, per ad probatus referrentur, vel cu consequat sententiae. Ad duis fugit dictas mea, et cum stet oratio cetero. Ne pri omittam fastidii. No per harum dicant neglegentur, sea ei esse volumus adolescens. Nulla argumentum at pri, vel apeirian principes in. An dicam dicant consul mea, ne per option appetere argumentum, vim legere senserit et.</p>\r\n<p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p>\r\n<p>Id est maiorum volutpat, ad nominavi suscipit suscipiantur vix. Ut ius veri aperiam reprehendunt. Ut per unum sapientem consequuntur, usu ut quot scripta. Sea te nisl expetenda, ad quo congue argumentum, sit quis simul accusam cu. Usu ei perfecto repudiare tincidunt, ut quas malis erant vim. An mel vidit iudicabit.</p>\r\n<p>In vim natum soleat nostro, pri in eloquentiam contentiones. Eu sit sapientem reprehendunt, omnis aliquid eu eos. No quot illum veniam est, ne pro iudico saperet mnesarchum. Ea pri nostro disputando contentiones, eu nec menandri qualisque, vis ex equidem invidunt. Et accusam detracto splendide per, congue meliore id sea. Has eu aeterno patrioque expetendis, mel ei dissentiet reformidans.</p>\r\n<p>Pri tempor appareat no, eruditi repudiandae vix at. Eos at brute omnesque voluptaria, facer putent intellegam eu pri. Mei debitis ullamcorper eu, at quo idque mundi. Vis in suas porro consequat, nec ad dolor adversarium, ut praesent cotidieque sit. Veniam civibus omittantur duo ut, te his alterum complectitur. Mea omnis oratio impedit ne.</p>\r\n<p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p>', '7 types of influencer marketing campaigns', '7 types of influencer marketing campaigns', '2023-10-15 18:05:04', '2023-10-15 18:05:04'),
(7, 7, 'en', 'Establishing a content marketing strategy', '<p>Sint dignissim consectetuer nec et, per ad probatus referrentur, vel cu consequat sententiae. Ad duis fugit dictas mea, et cum stet oratio cetero. Ne pri omittam fastidii. No per harum dicant neglegentur, sea ei esse volumus adolescens. Nulla argumentum at pri, vel apeirian principes in. An dicam dicant consul mea, ne per option appetere argumentum, vim legere senserit et.</p>\r\n<p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p>\r\n<p>Id est maiorum volutpat, ad nominavi suscipit suscipiantur vix. Ut ius veri aperiam reprehendunt. Ut per unum sapientem consequuntur, usu ut quot scripta. Sea te nisl expetenda, ad quo congue argumentum, sit quis simul accusam cu. Usu ei perfecto repudiare tincidunt, ut quas malis erant vim. An mel vidit iudicabit.</p>\r\n<p>In vim natum soleat nostro, pri in eloquentiam contentiones. Eu sit sapientem reprehendunt, omnis aliquid eu eos. No quot illum veniam est, ne pro iudico saperet mnesarchum. Ea pri nostro disputando contentiones, eu nec menandri qualisque, vis ex equidem invidunt. Et accusam detracto splendide per, congue meliore id sea. Has eu aeterno patrioque expetendis, mel ei dissentiet reformidans.</p>\r\n<p>Pri tempor appareat no, eruditi repudiandae vix at. Eos at brute omnesque voluptaria, facer putent intellegam eu pri. Mei debitis ullamcorper eu, at quo idque mundi. Vis in suas porro consequat, nec ad dolor adversarium, ut praesent cotidieque sit. Veniam civibus omittantur duo ut, te his alterum complectitur. Mea omnis oratio impedit ne.</p>\r\n<p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p>', 'Establishing a content marketing strategy', 'Establishing a content marketing strategy', '2023-10-15 18:22:18', '2023-10-15 18:22:18'),
(8, 8, 'en', 'Excited and audience watching confetti', '<p>Sint dignissim consectetuer nec et, per ad probatus referrentur, vel cu consequat sententiae. Ad duis fugit dictas mea, et cum stet oratio cetero. Ne pri omittam fastidii. No per harum dicant neglegentur, sea ei esse volumus adolescens. Nulla argumentum at pri, vel apeirian principes in. An dicam dicant consul mea, ne per option appetere argumentum, vim legere senserit et.</p>\r\n<p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p>\r\n<p>Id est maiorum volutpat, ad nominavi suscipit suscipiantur vix. Ut ius veri aperiam reprehendunt. Ut per unum sapientem consequuntur, usu ut quot scripta. Sea te nisl expetenda, ad quo congue argumentum, sit quis simul accusam cu. Usu ei perfecto repudiare tincidunt, ut quas malis erant vim. An mel vidit iudicabit.</p>\r\n<p>In vim natum soleat nostro, pri in eloquentiam contentiones. Eu sit sapientem reprehendunt, omnis aliquid eu eos. No quot illum veniam est, ne pro iudico saperet mnesarchum. Ea pri nostro disputando contentiones, eu nec menandri qualisque, vis ex equidem invidunt. Et accusam detracto splendide per, congue meliore id sea. Has eu aeterno patrioque expetendis, mel ei dissentiet reformidans.</p>\r\n<p>Pri tempor appareat no, eruditi repudiandae vix at. Eos at brute omnesque voluptaria, facer putent intellegam eu pri. Mei debitis ullamcorper eu, at quo idque mundi. Vis in suas porro consequat, nec ad dolor adversarium, ut praesent cotidieque sit. Veniam civibus omittantur duo ut, te his alterum complectitur. Mea omnis oratio impedit ne.</p>\r\n<p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p>', 'Excited and audience watching confetti', 'Excited and audience watching confetti', '2023-10-15 18:24:39', '2023-10-15 18:24:39'),
(9, 9, 'en', 'Discover Influencer Marketing Success', '<p>Sint dignissim consectetuer nec et, per ad probatus referrentur, vel cu consequat sententiae. Ad duis fugit dictas mea, et cum stet oratio cetero. Ne pri omittam fastidii. No per harum dicant neglegentur, sea ei esse volumus adolescens. Nulla argumentum at pri, vel apeirian principes in. An dicam dicant consul mea, ne per option appetere argumentum, vim legere senserit et.</p>\r\n<p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p>\r\n<p>Id est maiorum volutpat, ad nominavi suscipit suscipiantur vix. Ut ius veri aperiam reprehendunt. Ut per unum sapientem consequuntur, usu ut quot scripta. Sea te nisl expetenda, ad quo congue argumentum, sit quis simul accusam cu. Usu ei perfecto repudiare tincidunt, ut quas malis erant vim. An mel vidit iudicabit.</p>\r\n<p>In vim natum soleat nostro, pri in eloquentiam contentiones. Eu sit sapientem reprehendunt, omnis aliquid eu eos. No quot illum veniam est, ne pro iudico saperet mnesarchum. Ea pri nostro disputando contentiones, eu nec menandri qualisque, vis ex equidem invidunt. Et accusam detracto splendide per, congue meliore id sea. Has eu aeterno patrioque expetendis, mel ei dissentiet reformidans.</p>\r\n<p>Pri tempor appareat no, eruditi repudiandae vix at. Eos at brute omnesque voluptaria, facer putent intellegam eu pri. Mei debitis ullamcorper eu, at quo idque mundi. Vis in suas porro consequat, nec ad dolor adversarium, ut praesent cotidieque sit. Veniam civibus omittantur duo ut, te his alterum complectitur. Mea omnis oratio impedit ne.</p>\r\n<p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p>', 'Discover Influencer Marketing Success', 'Discover Influencer Marketing Success', '2023-10-15 18:25:54', '2023-10-15 18:25:54');
INSERT INTO `blog_translations` (`id`, `blog_id`, `lang_code`, `title`, `description`, `seo_title`, `seo_description`, `created_at`, `updated_at`) VALUES
(10, 10, 'en', 'Influencer Marketing Made Simple', '<p>Pri tempor appareat no, eruditi repudiandae vix at. Eos at brute omnesque voluptaria, facer putent intellegam eu pri. Mei debitis ullamcorper eu, at quo idque mundi. Vis in suas porro consequat, nec ad dolor adversarium, ut praesent cotidieque sit. Veniam civibus omittantur duo ut, te his alterum complectitur. Mea omnis oratio impedit ne.</p>\r\n<p>Ut qui eligendi urbanitas. Assum periculis te mel, libris quidam te sit. Qui nisl nemore eleifend id, in illud ullum sea. Ut nusquam sapientem comprehensam ius. His molestie complectitur ex.</p>\r\n<p>Ei usu malis aeque efficiantur. Mazim dolor denique duo ad, augue ornatus sententiae vel at, duo id sumo vulputate. His legimus assueverit ut, commune maluisset deterruisset id mel. Oblique volumus eos ut, quo autem posidonium definitiones cu. Cu usu lorem consul concludaturque, pro ea fuisset consectetuer. Ex aeterno forensibus has, dicta propriae est ei, ex alterum apeirian quo.</p>\r\n<p>Meliore inimicus duo ut, tation veritus elaboraret eam cu. Cum in alii agam aliquip, aperiam salutandi et per. Ex vis summo probatus ocurreret, ex assum sententiae pri, blandit sensibus moderatius ei eos. Vix nobis phaedrum neglegentur et.</p>\r\n<p>Sit vivendum eleifend adipiscing ea. Modus legere suscipiantur an vel, melius patrioque est cu, eum at audire probatus repudiandae. Ei tempor definitiones eam, sea dico omnium ne. Eam ad ubique tincidunt elaboraret, malis aperiri sit et. Ut quo vero inimicus. Sed at munere fuisset noluisse, eleifend senserit an vix.</p>\r\n<p>Sint dignissim consectetuer nec et, per ad probatus referrentur, vel cu consequat sententiae. Ad duis fugit dictas mea, et cum stet oratio cetero. Ne pri omittam fastidii. No per harum dicant neglegentur, sea ei esse volumus adolescens. Nulla argumentum at pri, vel apeirian principes in. An dicam dicant consul mea, ne per option appetere argumentum, vim legere senserit et.</p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"data:image/png;base64,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\" width=\"639\" height=\"472\"></p>', 'Influencer Marketing Made Simple', 'Influencer Marketing Made Simple', '2023-10-15 18:27:37', '2024-05-01 19:49:59');
INSERT INTO `blog_translations` (`id`, `blog_id`, `lang_code`, `title`, `description`, `seo_title`, `seo_description`, `created_at`, `updated_at`) VALUES
(11, 1, 'ar', 'استعِن بأبرز المؤثرين لتحقيق أقصى قدر من التأثير', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"ltr\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">لا تظهر مؤقتًا, المعرفة المتكررة فيكس. Eos في voluptaria غاشمة، تواجه ذكاءً قويًا في الاتحاد الأوروبي. Mei debitis ullamcorper eu, at quo idque mundi. Vis in suas porro consequat, nec ad dolor adversarium, ut praesent cotidieque sit. Veniam civibus omitantur duo ut، te his alterum complectitur. Mea omnis oratio يعيق ne.</span></pre>\r\n<p>Ut qui eligendi urbanitas. Assum periculis te mel, libris quidam te sit. Qui nisl nemore eleifend id, in illud ullum sea. Ut nusquam sapientem comprehensam ius. His molestie complectitur ex.</p>\r\n<p>Ei usu malis aeque efficiantur. Mazim dolor denique duo ad, augue ornatus sententiae vel at, duo id sumo vulputate. His legimus assueverit ut, commune maluisset deterruisset id mel. Oblique volumus eos ut, quo autem posidonium definitiones cu. Cu usu lorem consul concludaturque, pro ea fuisset consectetuer. Ex aeterno forensibus has, dicta propriae est ei, ex alterum apeirian quo.</p>\r\n<p>Meliore inimicus duo ut, tation veritus elaboraret eam cu. Cum in alii agam aliquip, aperiam salutandi et per. Ex vis summo probatus ocurreret, ex assum sententiae pri, blandit sensibus moderatius ei eos. Vix nobis phaedrum neglegentur et.</p>\r\n<p>Sit vivendum eleifend adipiscing ea. Modus legere suscipiantur an vel, melius patrioque est cu, eum at audire probatus repudiandae. Ei tempor definitiones eam, sea dico omnium ne. Eam ad ubique tincidunt elaboraret, malis aperiri sit et. Ut quo vero inimicus. Sed at munere fuisset noluisse, eleifend senserit an vix.</p>\r\n<p>Sint dignissim consectetuer nec et, per ad probatus referrentur, vel cu consequat sententiae. Ad duis fugit dictas mea, et cum stet oratio cetero. Ne pri omittam fastidii. No per harum dicant neglegentur, sea ei esse volumus adolescens. Nulla argumentum at pri, vel apeirian principes in. An dicam dicant consul mea, ne per option appetere argumentum, vim legere senserit et.</p>', 'استعِن بأبرز المؤثرين لتحقيق أقصى قدر من التأثير', 'استعِن بأبرز المؤثرين لتحقيق أقصى قدر من التأثير', '2023-10-17 23:04:37', '2023-10-18 15:39:39'),
(12, 2, 'ar', 'كيف يمكن للعلامات التجارية كسر الحواجز؟', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"rtl\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">دومينغ السائل تي برو. Mei et quodsi ornatus praesent، مجموع الديون تجاه الاتحاد الأوروبي، دولور سوليت نسترود البحر الاتحاد الأوروبي. قد يكون هناك تغيير في القدس، كل ما تريده هو أن لا يتم إنشاء أساطيرك. ميل في justo doming voluptatum. لا تريد تلك الخيالات الخيالية، والثنائي يتمتعان بشهية واحدة.</span></pre>\r\n<p>Nec in rebum primis causae. Affert iisque ex pri, vis utinam vivendo definitionem ad, nostrum omnesque per et. Omnium antiopam cotidieque cu sit. Id pri placerat voluptatum, vero dicunt dissentiunt eum et, adhuc iisque vis no. Eu suavitate contentiones definitionem mel, ex vide insolens ocurreret eam. Et dico blandit mea. Sea tollit vidisse mandamus te, qui movet efficiendi ex.</p>\r\n<p>Ut qui eligendi urbanitas. Assum periculis te mel, libris quidam te sit. Qui nisl nemore eleifend id, in illud ullum sea. Ut nusquam sapientem comprehensam ius. His molestie complectitur ex.</p>\r\n<p>In vim natum soleat nostro, pri in eloquentiam contentiones. Eu sit sapientem reprehendunt, omnis aliquid eu eos. No quot illum veniam est, ne pro iudico saperet mnesarchum. Ea pri nostro disputando contentiones, eu nec menandri qualisque, vis ex equidem invidunt. Et accusam detracto splendide per, congue meliore id sea. Has eu aeterno patrioque expetendis, mel ei dissentiet reformidans.</p>\r\n<p>Meliore inimicus duo ut, tation veritus elaboraret eam cu. Cum in alii agam aliquip, aperiam salutandi et per. Ex vis summo probatus ocurreret, ex assum sententiae pri, blandit sensibus moderatius ei eos. Vix nobis phaedrum neglegentur et.</p>', 'كيف يمكن للعلامات التجارية كسر الحواجز؟', 'كيف يمكن للعلامات التجارية كسر الحواجز؟', '2023-10-17 23:04:37', '2023-10-18 15:40:18'),
(13, 3, 'ar', 'المؤثر هو الوظيفة الحقيقية وحان وقت العمل', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"rtl\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">لكل ex vero Nonumy. أنا في الاتحاد الأوروبي أسمى اسمًا متوسطًا، بعض الكفاءة في الحياة، مقدسة بشكل معتدل من المحترفين. لا يوجد بحر invidunt Partiendo. لا يوجد أي رقم يحدث في الثنائي، واحد بغيض مع اسمك، معرف سريع الهارب.</span></pre>\r\n<p>Sint dignissim consectetuer nec et, per ad probatus referrentur, vel cu consequat sententiae. Ad duis fugit dictas mea, et cum stet oratio cetero. Ne pri omittam fastidii. No per harum dicant neglegentur, sea ei esse volumus adolescens. Nulla argumentum at pri, vel apeirian principes in. An dicam dicant consul mea, ne per option appetere argumentum, vim legere senserit et.</p>\r\n<p>Usu ad solet diceret, usu at appetere percipit appellantur, te est primis audire gloriatur. Scripta noluisse no mel, vis ne decore ridens labitur. Stet erant saepe eu mea. An mel dolore salutandi abhorreant. An quo aliquip maluisset, mea quaeque indoctum in, pro augue veritus praesent te.</p>\r\n<p>Vim et alterum ornatus vivendum, ut mea solum repudiare. His etiam delenit tibique no, ad harum omnes scribentur qui, ne wisi detracto his. Ei movet accusam pri. Ex vel diam quas urbanitas, ne has velit affert habemus. At quis nonumy disputando nec, falli scaevola vel ea. Omittantur concludaturque nam eu, ex est vocent virtute.</p>\r\n<p>Sit vivendum eleifend adipiscing ea. Modus legere suscipiantur an vel, melius patrioque est cu, eum at audire probatus repudiandae. Ei tempor definitiones eam, sea dico omnium ne. Eam ad ubique tincidunt elaboraret, malis aperiri sit et. Ut quo vero inimicus. Sed at munere fuisset noluisse, eleifend senserit an vix.</p>\r\n<p>Ipsum volumus pertinax mea ut, eu erat tacimates nam. Tibique copiosae verterem mea no, eam ex melius option, soluta timeam et his. Sit simul gubergren reformidans id, amet minimum nominavi eos ea. Et augue dicta vix. Mea ne utamur referrentur.</p>\r\n<p>Id est maiorum volutpat, ad nominavi suscipit suscipiantur vix. Ut ius veri aperiam reprehendunt. Ut per unum sapientem consequuntur, usu ut quot scripta. Sea te nisl expetenda, ad quo congue argumentum, sit quis simul accusam cu. Usu ei perfecto repudiare tincidunt, ut quas malis erant vim. An mel vidit iudicabit.</p>', 'المؤثر هو الوظيفة الحقيقية وحان وقت العمل', 'المؤثر هو الوظيفة الحقيقية وحان وقت العمل', '2023-10-17 23:04:37', '2023-10-18 15:40:55'),
(14, 4, 'ar', '90٪ اجتماعيون كمؤثرين في وسائل الإعلام', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"rtl\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">لكل ex vero Nonumy. أنا في الاتحاد الأوروبي أسمى متوسطًا، بعض الكفاءة في الحياة، مقدسة بشكل معتدل من المحترفين. لا يوجد بارتيندو invidunt. لا يوجد أي رقم يحدث في الثنائي، واحد بغيض مع اسمك، معرف سريع الهارب.</span></pre>\r\n<p>Sint dignissim consectetuer nec et, per ad probatus referrentur, vel cu consequat sententiae. Ad duis fugit dictas mea, et cum stet oratio cetero. Ne pri omittam fastidii. No per harum dicant neglegentur, sea ei esse volumus adolescens. Nulla argumentum at pri, vel apeirian principes in. An dicam dicant consul mea, ne per option appetere argumentum, vim legere senserit et.</p>\r\n<p>Usu ad solet diceret, usu at appetere percipit appellantur, te est primis audire gloriatur. Scripta noluisse no mel, vis ne decore ridens labitur. Stet erant saepe eu mea. An mel dolore salutandi abhorreant. An quo aliquip maluisset, mea quaeque indoctum in, pro augue veritus praesent te.</p>\r\n<p>Vim et alterum ornatus vivendum, ut mea solum repudiare. His etiam delenit tibique no, ad harum omnes scribentur qui, ne wisi detracto his. Ei movet accusam pri. Ex vel diam quas urbanitas, ne has velit affert habemus. At quis nonumy disputando nec, falli scaevola vel ea. Omittantur concludaturque nam eu, ex est vocent virtute.</p>\r\n<p>Sit vivendum eleifend adipiscing ea. Modus legere suscipiantur an vel, melius patrioque est cu, eum at audire probatus repudiandae. Ei tempor definitiones eam, sea dico omnium ne. Eam ad ubique tincidunt elaboraret, malis aperiri sit et. Ut quo vero inimicus. Sed at munere fuisset noluisse, eleifend senserit an vix.</p>\r\n<p>Ipsum volumus pertinax mea ut, eu erat tacimates nam. Tibique copiosae verterem mea no, eam ex melius option, soluta timeam et his. Sit simul gubergren reformidans id, amet minimum nominavi eos ea. Et augue dicta vix. Mea ne utamur referrentur.</p>\r\n<p>Id est maiorum volutpat, ad nominavi suscipit suscipiantur vix. Ut ius veri aperiam reprehendunt. Ut per unum sapientem consequuntur, usu ut quot scripta. Sea te nisl expetenda, ad quo congue argumentum, sit quis simul accusam cu. Usu ei perfecto repudiare tincidunt, ut quas malis erant vim. An mel vidit iudicabit.</p>', '90٪ اجتماعيون كمؤثرين في وسائل الإعلام', '90٪ اجتماعيون كمؤثرين في وسائل الإعلام', '2023-10-17 23:04:37', '2023-10-18 15:41:40'),
(15, 5, 'ar', 'مشاركة المؤثر كل شيء لك', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"rtl\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">لقد تم إنشاء كرامة غير محددة وغير ذلك، وفقًا للإحالة المرجعية، أو ما يترتب على ذلك من عبارات. بعد أن ألقيت أقوالي الهاربة، ومع خطابي إلى آخره. لا داعي للقلق. لا داعي للإهمال، بل هو حجم كبير من المراهقين. لا توجد حجة في pri، أو مبادئ apeirian in. An dicam dicant consul mea، ne per option appetere وسيطة، vim legere Senrit et.</span></pre>\r\n<p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p>\r\n<p>Id est maiorum volutpat, ad nominavi suscipit suscipiantur vix. Ut ius veri aperiam reprehendunt. Ut per unum sapientem consequuntur, usu ut quot scripta. Sea te nisl expetenda, ad quo congue argumentum, sit quis simul accusam cu. Usu ei perfecto repudiare tincidunt, ut quas malis erant vim. An mel vidit iudicabit.</p>\r\n<p>In vim natum soleat nostro, pri in eloquentiam contentiones. Eu sit sapientem reprehendunt, omnis aliquid eu eos. No quot illum veniam est, ne pro iudico saperet mnesarchum. Ea pri nostro disputando contentiones, eu nec menandri qualisque, vis ex equidem invidunt. Et accusam detracto splendide per, congue meliore id sea. Has eu aeterno patrioque expetendis, mel ei dissentiet reformidans.</p>\r\n<p>Pri tempor appareat no, eruditi repudiandae vix at. Eos at brute omnesque voluptaria, facer putent intellegam eu pri. Mei debitis ullamcorper eu, at quo idque mundi. Vis in suas porro consequat, nec ad dolor adversarium, ut praesent cotidieque sit. Veniam civibus omittantur duo ut, te his alterum complectitur. Mea omnis oratio impedit ne.</p>\r\n<p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p>', 'مشاركة المؤثر كل شيء لك', 'مشاركة المؤثر كل شيء لك', '2023-10-17 23:04:37', '2023-10-18 15:42:14'),
(16, 6, 'ar', '7 أنواع من الحملات التسويقية المؤثرة', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"rtl\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">لقد تم إنشاء كرامة غير محددة وغير ذلك، وفقًا للإحالة المرجعية، أو ما يترتب على ذلك من عبارات. بعد أن ألقيت أقوالي الهاربة، ومع خطابي إلى آخره. لا داعي للقلق. لا داعي للإهمال، بل هو حجم كبير من المراهقين. لا توجد حجة في pri، أو مبادئ apeirian in. An dicam dicant consul mea، ne per option appetere وسيطة، vim legere Senrit et.</span></pre>\r\n<p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p>\r\n<p>Id est maiorum volutpat, ad nominavi suscipit suscipiantur vix. Ut ius veri aperiam reprehendunt. Ut per unum sapientem consequuntur, usu ut quot scripta. Sea te nisl expetenda, ad quo congue argumentum, sit quis simul accusam cu. Usu ei perfecto repudiare tincidunt, ut quas malis erant vim. An mel vidit iudicabit.</p>\r\n<p>In vim natum soleat nostro, pri in eloquentiam contentiones. Eu sit sapientem reprehendunt, omnis aliquid eu eos. No quot illum veniam est, ne pro iudico saperet mnesarchum. Ea pri nostro disputando contentiones, eu nec menandri qualisque, vis ex equidem invidunt. Et accusam detracto splendide per, congue meliore id sea. Has eu aeterno patrioque expetendis, mel ei dissentiet reformidans.</p>\r\n<p>Pri tempor appareat no, eruditi repudiandae vix at. Eos at brute omnesque voluptaria, facer putent intellegam eu pri. Mei debitis ullamcorper eu, at quo idque mundi. Vis in suas porro consequat, nec ad dolor adversarium, ut praesent cotidieque sit. Veniam civibus omittantur duo ut, te his alterum complectitur. Mea omnis oratio impedit ne.</p>\r\n<p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p>', '7 أنواع من الحملات التسويقية المؤثرة', '7 أنواع من الحملات التسويقية المؤثرة', '2023-10-17 23:04:37', '2023-10-18 15:42:47'),
(17, 7, 'ar', 'وضع استراتيجية تسويق المحتوى', '\r\n<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"rtl\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">لقد تم إنشاء كرامة غير محددة وغير ذلك، وفقًا للإحالة المرجعية، أو ما يترتب على ذلك من عبارات. بعد أن ألقيت أقوالي الهاربة، ومع خطابي إلى آخره. لا داعي للقلق. لا داعي للإهمال، بل هو حجم كبير من المراهقين. لا توجد حجة في pri، أو مبادئ apeirian in. An dicam dicant consul mea، ne per option appetere وسيطة، vim legere Senrit et.</span></pre>\r\n\r\n\r\n<p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p>\r\n<p>Id est maiorum volutpat, ad nominavi suscipit suscipiantur vix. Ut ius veri aperiam reprehendunt. Ut per unum sapientem consequuntur, usu ut quot scripta. Sea te nisl expetenda, ad quo congue argumentum, sit quis simul accusam cu. Usu ei perfecto repudiare tincidunt, ut quas malis erant vim. An mel vidit iudicabit.</p>\r\n<p>In vim natum soleat nostro, pri in eloquentiam contentiones. Eu sit sapientem reprehendunt, omnis aliquid eu eos. No quot illum veniam est, ne pro iudico saperet mnesarchum. Ea pri nostro disputando contentiones, eu nec menandri qualisque, vis ex equidem invidunt. Et accusam detracto splendide per, congue meliore id sea. Has eu aeterno patrioque expetendis, mel ei dissentiet reformidans.</p>\r\n<p>Pri tempor appareat no, eruditi repudiandae vix at. Eos at brute omnesque voluptaria, facer putent intellegam eu pri. Mei debitis ullamcorper eu, at quo idque mundi. Vis in suas porro consequat, nec ad dolor adversarium, ut praesent cotidieque sit. Veniam civibus omittantur duo ut, te his alterum complectitur. Mea omnis oratio impedit ne.</p>\r\n<p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p>', 'وضع استراتيجية تسويق المحتوى', 'وضع استراتيجية تسويق المحتوى', '2023-10-17 23:04:37', '2023-10-18 15:43:38'),
(18, 8, 'ar', 'متحمس والجمهور يشاهد النثار', '<p>لقد تم إنشاء كرامة غير محددة وغير ذلك، وفقًا للإحالة المرجعية، أو ما يترتب على ذلك من عبارات. بعد أن ألقيت أقوالي الهاربة، ومع خطابي إلى آخره. لا داعي للقلق. لا داعي للإهمال، بل هو حجم كبير من المراهقين. لا توجد حجة في pri، أو مبادئ apeirian in. An dicam dicant consul mea، ne per option appetere وسيطة، vim legere Senrit et.</p>\r\n<p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p>\r\n<p>Id est maiorum volutpat, ad nominavi suscipit suscipiantur vix. Ut ius veri aperiam reprehendunt. Ut per unum sapientem consequuntur, usu ut quot scripta. Sea te nisl expetenda, ad quo congue argumentum, sit quis simul accusam cu. Usu ei perfecto repudiare tincidunt, ut quas malis erant vim. An mel vidit iudicabit.</p>\r\n<p>In vim natum soleat nostro, pri in eloquentiam contentiones. Eu sit sapientem reprehendunt, omnis aliquid eu eos. No quot illum veniam est, ne pro iudico saperet mnesarchum. Ea pri nostro disputando contentiones, eu nec menandri qualisque, vis ex equidem invidunt. Et accusam detracto splendide per, congue meliore id sea. Has eu aeterno patrioque expetendis, mel ei dissentiet reformidans.</p>\r\n<p>Pri tempor appareat no, eruditi repudiandae vix at. Eos at brute omnesque voluptaria, facer putent intellegam eu pri. Mei debitis ullamcorper eu, at quo idque mundi. Vis in suas porro consequat, nec ad dolor adversarium, ut praesent cotidieque sit. Veniam civibus omittantur duo ut, te his alterum complectitur. Mea omnis oratio impedit ne.</p>\r\n<p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p>', 'متحمس والجمهور يشاهد النثار', 'متحمس والجمهور يشاهد النثار', '2023-10-17 23:04:37', '2023-10-18 15:52:19'),
(19, 9, 'ar', 'اكتشف نجاح التسويق المؤثر', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"rtl\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">لقد تم إنشاء كرامة غير محددة وغير ذلك، وفقًا للإحالة المرجعية، أو ما يترتب على ذلك من عبارات. بعد أن ألقيت أقوالي الهاربة، ومع خطابي إلى آخره. لا داعي للقلق. لا داعي للإهمال، بل هو حجم كبير من المراهقين. لا توجد حجة في pri، أو مبادئ apeirian in. An dicam dicant consul mea، ne per option appetere وسيطة، vim legere Senrit et.</span></pre>\r\n<p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p>\r\n<p>Id est maiorum volutpat, ad nominavi suscipit suscipiantur vix. Ut ius veri aperiam reprehendunt. Ut per unum sapientem consequuntur, usu ut quot scripta. Sea te nisl expetenda, ad quo congue argumentum, sit quis simul accusam cu. Usu ei perfecto repudiare tincidunt, ut quas malis erant vim. An mel vidit iudicabit.</p>\r\n<p>In vim natum soleat nostro, pri in eloquentiam contentiones. Eu sit sapientem reprehendunt, omnis aliquid eu eos. No quot illum veniam est, ne pro iudico saperet mnesarchum. Ea pri nostro disputando contentiones, eu nec menandri qualisque, vis ex equidem invidunt. Et accusam detracto splendide per, congue meliore id sea. Has eu aeterno patrioque expetendis, mel ei dissentiet reformidans.</p>\r\n<p>Pri tempor appareat no, eruditi repudiandae vix at. Eos at brute omnesque voluptaria, facer putent intellegam eu pri. Mei debitis ullamcorper eu, at quo idque mundi. Vis in suas porro consequat, nec ad dolor adversarium, ut praesent cotidieque sit. Veniam civibus omittantur duo ut, te his alterum complectitur. Mea omnis oratio impedit ne.</p>\r\n<p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p>', 'اكتشف نجاح التسويق المؤثر', 'اكتشف نجاح التسويق المؤثر', '2023-10-17 23:04:37', '2023-10-18 15:53:04'),
(20, 10, 'ar', 'أصبح التسويق المؤثر أمرًا بسيطًا', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"ltr\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">لا تظهر مؤقتًا, المعرفة المتكررة فيكس. Eos في voluptaria غاشمة، تواجه ذكاءً قويًا في الاتحاد الأوروبي. Mei debitis ullamcorper eu, at quo idque mundi. Vis in suas porro consequat, nec ad dolor adversarium, ut praesent cotidieque sit. Veniam civibus omitantur duo ut، te his alterum complectitur. Mea omnis oratio يعيق ne.</span></pre>\r\n<p>Ut qui eligendi urbanitas. Assum periculis te mel, libris quidam te sit. Qui nisl nemore eleifend id, in illud ullum sea. Ut nusquam sapientem comprehensam ius. His molestie complectitur ex.</p>\r\n<p>Ei usu malis aeque efficiantur. Mazim dolor denique duo ad, augue ornatus sententiae vel at, duo id sumo vulputate. His legimus assueverit ut, commune maluisset deterruisset id mel. Oblique volumus eos ut, quo autem posidonium definitiones cu. Cu usu lorem consul concludaturque, pro ea fuisset consectetuer. Ex aeterno forensibus has, dicta propriae est ei, ex alterum apeirian quo.</p>\r\n<p>Meliore inimicus duo ut, tation veritus elaboraret eam cu. Cum in alii agam aliquip, aperiam salutandi et per. Ex vis summo probatus ocurreret, ex assum sententiae pri, blandit sensibus moderatius ei eos. Vix nobis phaedrum neglegentur et.</p>\r\n<p>Sit vivendum eleifend adipiscing ea. Modus legere suscipiantur an vel, melius patrioque est cu, eum at audire probatus repudiandae. Ei tempor definitiones eam, sea dico omnium ne. Eam ad ubique tincidunt elaboraret, malis aperiri sit et. Ut quo vero inimicus. Sed at munere fuisset noluisse, eleifend senserit an vix.</p>\r\n<p>Sint dignissim consectetuer nec et, per ad probatus referrentur, vel cu consequat sententiae. Ad duis fugit dictas mea, et cum stet oratio cetero. Ne pri omittam fastidii. No per harum dicant neglegentur, sea ei esse volumus adolescens. Nulla argumentum at pri, vel apeirian principes in. An dicam dicant consul mea, ne per option appetere argumentum, vim legere senserit et.</p>', 'أصبح التسويق المؤثر أمرًا بسيطًا', 'أصبح التسويق المؤثر أمرًا بسيطًا', '2023-10-17 23:04:37', '2023-10-18 15:53:36');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `status`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'fashion', 'active', 'uploads/custom-images/service-cat-2023-10-16-05-01-35-4202.svg', '2023-10-15 23:01:35', '2023-10-15 23:01:35'),
(2, 'sport-fitness', 'active', 'uploads/custom-images/service-cat-2023-10-16-05-02-09-6852.svg', '2023-10-15 23:02:09', '2023-10-15 23:02:09'),
(3, 'parenting', 'active', 'uploads/custom-images/service-cat-2023-10-16-05-02-34-4510.svg', '2023-10-15 23:02:34', '2023-10-15 23:02:34'),
(4, 'life-style', 'active', 'uploads/custom-images/service-cat-2023-10-16-05-03-05-2874.svg', '2023-10-15 23:03:05', '2023-10-15 23:03:05'),
(5, 'beauty', 'active', 'uploads/custom-images/service-cat-2023-10-16-05-03-29-7763.svg', '2023-10-15 23:03:29', '2023-10-15 23:03:29'),
(6, 'vloggers', 'active', 'uploads/custom-images/service-cat-2023-10-16-05-04-00-1669.svg', '2023-10-15 23:04:00', '2023-10-15 23:04:00'),
(7, 'pet-care', 'active', 'uploads/custom-images/service-cat-2023-10-16-05-04-25-3188.svg', '2023-10-15 23:04:25', '2023-10-15 23:04:25'),
(8, 'photography', 'active', 'uploads/custom-images/service-cat-2023-10-16-05-05-03-3537.svg', '2023-10-15 23:05:03', '2023-10-15 23:05:03'),
(9, 'games', 'active', 'uploads/custom-images/service-cat-2023-10-16-05-05-43-4065.svg', '2023-10-15 23:05:43', '2023-10-15 23:05:43'),
(10, 'travel', 'active', 'uploads/custom-images/service-cat-2023-10-16-05-06-11-9931.svg', '2023-10-15 23:06:11', '2023-10-15 23:06:11');

-- --------------------------------------------------------

--
-- Table structure for table `category_translations`
--

CREATE TABLE `category_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_translations`
--

INSERT INTO `category_translations` (`id`, `category_id`, `lang_code`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Fashion', '2023-10-15 23:01:35', '2023-10-15 23:01:35'),
(2, 2, 'en', 'Sport & Fitness', '2023-10-15 23:02:09', '2023-10-15 23:02:09'),
(3, 3, 'en', 'Parenting', '2023-10-15 23:02:34', '2023-10-15 23:02:34'),
(4, 4, 'en', 'Life Style', '2023-10-15 23:03:05', '2023-10-15 23:03:05'),
(5, 5, 'en', 'Beauty', '2023-10-15 23:03:29', '2023-10-15 23:03:29'),
(6, 6, 'en', 'Vloggers', '2023-10-15 23:04:00', '2023-10-15 23:04:00'),
(7, 7, 'en', 'Pet Care', '2023-10-15 23:04:25', '2023-10-15 23:04:25'),
(8, 8, 'en', 'Photography', '2023-10-15 23:05:03', '2023-10-15 23:05:03'),
(9, 9, 'en', 'Games', '2023-10-15 23:05:43', '2023-10-15 23:05:43'),
(10, 10, 'en', 'Travel', '2023-10-15 23:06:11', '2023-10-15 23:06:11'),
(11, 1, 'ar', 'موضة', '2023-10-17 23:04:37', '2023-10-18 17:22:00'),
(12, 2, 'ar', 'الرياضة واللياقة البدنية', '2023-10-17 23:04:37', '2023-10-18 17:22:52'),
(13, 3, 'ar', 'الأبوة والأمومة', '2023-10-17 23:04:37', '2023-10-18 17:23:04'),
(14, 4, 'ar', 'نمط الحياة', '2023-10-17 23:04:37', '2023-10-18 17:23:17'),
(15, 5, 'ar', 'جمال', '2023-10-17 23:04:37', '2023-10-18 17:23:29'),
(16, 6, 'ar', 'مدونو الفيديو', '2023-10-17 23:04:37', '2023-10-18 17:23:43'),
(17, 7, 'ar', 'رعاية الحيوانات الاليفة', '2023-10-17 23:04:37', '2023-10-18 17:23:58'),
(18, 8, 'ar', 'التصوير', '2023-10-17 23:04:37', '2023-10-18 17:25:03'),
(19, 9, 'ar', 'ألعاب', '2023-10-17 23:04:37', '2023-10-18 17:26:46'),
(20, 10, 'ar', 'يسافر', '2023-10-17 23:04:37', '2023-10-18 17:26:58');

-- --------------------------------------------------------

--
-- Table structure for table `complete_requests`
--

CREATE TABLE `complete_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `influencer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `reasone` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `complete_requests`
--

INSERT INTO `complete_requests` (`id`, `influencer_id`, `order_id`, `reasone`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'I have done my task. but can\'t want to approved the order. please help', '2023-10-17 20:28:25', '2023-10-17 20:28:25');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'user@gmail.com', '123-343-4444', 'Subscribe Verification', 'Feel Free to Get in Touch', '2023-11-28 00:48:28', '2023-11-28 00:48:28'),
(2, 'John Doe', 'user@gmail.com', '123-343-4444', 'Subscribe Verification', 'Feel Free to Get in Touch', '2023-11-28 00:49:43', '2023-11-28 00:49:43');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `map_code` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `phone`, `email`, `address`, `map_code`, `created_at`, `updated_at`) VALUES
(1, '+88 234 567 8991\r\n+88 562 987 3214', 'nazakahar@gmail.com\r\ninfoyour@gmail.com', '27 NW New Vexmont, 3 No Tejturi Bazar West, Panthapath North, Dhaka 1215', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.681138843672!2d-73.89482218459395!3d40.747041279328165!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25f01328248b3%3A0x62300784dd275f96!2s7232%20Broadway%20%23%20308%2C%20Flushing%2C%20NY%2011372%2C%20USA!5e0!3m2!1sen!2sbd!4v1652467683397!5m2!1sen!2sbd\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', NULL, '2023-09-13 00:02:05');

-- --------------------------------------------------------

--
-- Table structure for table `cookie_consents`
--

CREATE TABLE `cookie_consents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `border` varchar(255) DEFAULT NULL,
  `corners` varchar(255) DEFAULT NULL,
  `background_color` varchar(255) DEFAULT NULL,
  `text_color` varchar(255) DEFAULT NULL,
  `border_color` varchar(255) DEFAULT NULL,
  `btn_bg_color` varchar(255) DEFAULT NULL,
  `btn_text_color` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `link_text` varchar(255) DEFAULT NULL,
  `btn_text` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cookie_consents`
--

INSERT INTO `cookie_consents` (`id`, `status`, `border`, `corners`, `background_color`, `text_color`, `border_color`, `btn_bg_color`, `btn_text_color`, `message`, `link_text`, `btn_text`, `link`, `created_at`, `updated_at`) VALUES
(1, 0, 'thin', 'normal', '#184dec', '#fafafa', '#0a58d6', '#fffceb', '#222758', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the when an unknown printer took.', 'More Info', 'Yes', NULL, NULL, '2023-08-22 03:28:14');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `influencer_id` int(11) NOT NULL DEFAULT 0,
  `coupon_code` varchar(255) NOT NULL,
  `offer_percentage` varchar(255) NOT NULL,
  `expired_date` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `influencer_id`, `coupon_code`, `offer_percentage`, `expired_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'newyear', '10', '2023-12-30', 1, '2023-10-17 20:36:01', '2023-10-17 20:36:01'),
(2, 0, 'blackfriday', '5', '2024-07-27', 1, '2023-10-18 14:43:51', '2024-06-01 19:45:56'),
(3, 0, 'Test', '5', '2025-02-10', 1, '2025-02-04 08:33:29', '2025-02-04 08:40:14');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_histories`
--

CREATE TABLE `coupon_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `influencer_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `coupon_code` varchar(255) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `discount_amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupon_histories`
--

INSERT INTO `coupon_histories` (`id`, `influencer_id`, `user_id`, `coupon_code`, `coupon_id`, `discount_amount`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 'newyear', 1, 0.00, '2023-10-17 20:37:10', '2023-10-17 20:37:10'),
(2, 0, 5, 'blackfriday', 2, 3.75, '2024-06-01 19:48:20', '2024-06-01 19:48:20'),
(3, 0, 1, 'Test', 3, 1.45, '2025-02-04 09:01:41', '2025-02-04 09:01:41'),
(4, 0, 5, 'Test', 3, 0.90, '2025-02-04 12:15:22', '2025-02-04 12:15:22'),
(5, 0, 24, 'Test', 3, 12.38, '2025-02-06 09:02:16', '2025-02-06 09:02:16'),
(6, 0, 24, 'Test', 3, 12.38, '2025-02-06 09:07:36', '2025-02-06 09:07:36');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `code` varchar(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, 'AFA', 'Afghan Afghani', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'ALL', 'Albanian Lek', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'DZD', 'Algerian Dinar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'AOA', 'Angolan Kwanza', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'ARS', 'Argentine Peso', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'AMD', 'Armenian Dram', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'AWG', 'Aruban Florin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'AUD', 'Australian Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'AZN', 'Azerbaijani Manat', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'BSD', 'Bahamian Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'BHD', 'Bahraini Dinar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'BDT', 'Bangladeshi Taka', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'BBD', 'Barbadian Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'BYR', 'Belarusian Ruble', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'BEF', 'Belgian Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'BZD', 'Belize Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'BMD', 'Bermudan Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'BTN', 'Bhutanese Ngultrum', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'BTC', 'Bitcoin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'BOB', 'Bolivian Boliviano', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'BAM', 'Bosnia-Herzegovina Convertible Mark', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'BWP', 'Botswanan Pula', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'BRL', 'Brazilian Real', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'GBP', 'British Pound Sterling', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'BND', 'Brunei Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'BGN', 'Bulgarian Lev', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'BIF', 'Burundian Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'KHR', 'Cambodian Riel', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'CAD', 'Canadian Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'CVE', 'Cape Verdean Escudo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'KYD', 'Cayman Islands Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'XOF', 'CFA Franc BCEAO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'XAF', 'CFA Franc BEAC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'XPF', 'CFP Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'CLP', 'Chilean Peso', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'CNY', 'Chinese Yuan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'COP', 'Colombian Peso', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'KMF', 'Comorian Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'CDF', 'Congolese Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'CRC', 'Costa Rican ColÃ³n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'HRK', 'Croatian Kuna', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'CUC', 'Cuban Convertible Peso', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'CZK', 'Czech Republic Koruna', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'DKK', 'Danish Krone', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'DJF', 'Djiboutian Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'DOP', 'Dominican Peso', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'XCD', 'East Caribbean Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'EGP', 'Egyptian Pound', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'ERN', 'Eritrean Nakfa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'EEK', 'Estonian Kroon', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'ETB', 'Ethiopian Birr', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'EUR', 'Euro', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'FKP', 'Falkland Islands Pound', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'FJD', 'Fijian Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'GMD', 'Gambian Dalasi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'GEL', 'Georgian Lari', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'DEM', 'German Mark', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'GHS', 'Ghanaian Cedi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'GIP', 'Gibraltar Pound', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'GRD', 'Greek Drachma', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'GTQ', 'Guatemalan Quetzal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'GNF', 'Guinean Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'GYD', 'Guyanaese Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'HTG', 'Haitian Gourde', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'HNL', 'Honduran Lempira', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'HKD', 'Hong Kong Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'HUF', 'Hungarian Forint', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'ISK', 'Icelandic KrÃ³na', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'INR', 'Indian Rupee', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'IDR', 'Indonesian Rupiah', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'IRR', 'Iranian Rial', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'IQD', 'Iraqi Dinar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'ILS', 'Israeli New Sheqel', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'ITL', 'Italian Lira', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'JMD', 'Jamaican Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'JPY', 'Japanese Yen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'JOD', 'Jordanian Dinar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'KZT', 'Kazakhstani Tenge', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'KES', 'Kenyan Shilling', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'KWD', 'Kuwaiti Dinar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'KGS', 'Kyrgystani Som', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'LAK', 'Laotian Kip', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'LVL', 'Latvian Lats', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'LBP', 'Lebanese Pound', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 'LSL', 'Lesotho Loti', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 'LRD', 'Liberian Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 'LYD', 'Libyan Dinar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 'LTL', 'Lithuanian Litas', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 'MOP', 'Macanese Pataca', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 'MKD', 'Macedonian Denar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 'MGA', 'Malagasy Ariary', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 'MWK', 'Malawian Kwacha', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 'MYR', 'Malaysian Ringgit', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 'MVR', 'Maldivian Rufiyaa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 'MRO', 'Mauritanian Ouguiya', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 'MUR', 'Mauritian Rupee', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'MXN', 'Mexican Peso', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'MDL', 'Moldovan Leu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 'MNT', 'Mongolian Tugrik', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 'MAD', 'Moroccan Dirham', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 'MZM', 'Mozambican Metical', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 'MMK', 'Myanmar Kyat', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 'NAD', 'Namibian Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 'NPR', 'Nepalese Rupee', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 'ANG', 'Netherlands Antillean Guilder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 'TWD', 'New Taiwan Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 'NZD', 'New Zealand Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 'NIO', 'Nicaraguan CÃ³rdoba', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 'NGN', 'Nigerian Naira', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 'KPW', 'North Korean Won', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 'NOK', 'Norwegian Krone', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 'OMR', 'Omani Rial', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, 'PKR', 'Pakistani Rupee', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, 'PAB', 'Panamanian Balboa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, 'PGK', 'Papua New Guinean Kina', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, 'PYG', 'Paraguayan Guarani', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, 'PEN', 'Peruvian Nuevo Sol', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 'PHP', 'Philippine Peso', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, 'PLN', 'Polish Zloty', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 'QAR', 'Qatari Rial', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 'RON', 'Romanian Leu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 'RUB', 'Russian Ruble', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 'RWF', 'Rwandan Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 'SVC', 'Salvadoran ColÃ³n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, 'WST', 'Samoan Tala', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, 'SAR', 'Saudi Riyal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, 'RSD', 'Serbian Dinar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, 'SCR', 'Seychellois Rupee', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, 'SLL', 'Sierra Leonean Leone', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(130, 'SGD', 'Singapore Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(131, 'SKK', 'Slovak Koruna', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, 'SBD', 'Solomon Islands Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(133, 'SOS', 'Somali Shilling', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(134, 'ZAR', 'South African Rand', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(135, 'KRW', 'South Korean Won', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(136, 'XDR', 'Special Drawing Rights', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(137, 'LKR', 'Sri Lankan Rupee', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(138, 'SHP', 'St. Helena Pound', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(139, 'SDG', 'Sudanese Pound', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(140, 'SRD', 'Surinamese Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(141, 'SZL', 'Swazi Lilangeni', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(142, 'SEK', 'Swedish Krona', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(143, 'CHF', 'Swiss Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(144, 'SYP', 'Syrian Pound', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(145, 'STD', 'São Tomé and Príncipe Dobra', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(146, 'TJS', 'Tajikistani Somoni', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(147, 'TZS', 'Tanzanian Shilling', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(148, 'THB', 'Thai Baht', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(149, 'TOP', 'Tongan pa\'anga', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(150, 'TTD', 'Trinidad & Tobago Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(151, 'TND', 'Tunisian Dinar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(152, 'TRY', 'Turkish Lira', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(153, 'TMT', 'Turkmenistani Manat', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(154, 'UGX', 'Ugandan Shilling', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(155, 'UAH', 'Ukrainian Hryvnia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(156, 'AED', 'United Arab Emirates Dirham', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(157, 'UYU', 'Uruguayan Peso', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(158, 'USD', 'US Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(159, 'UZS', 'Uzbekistan Som', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(160, 'VUV', 'Vanuatu Vatu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(161, 'VEF', 'Venezuelan BolÃ­var', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(162, 'VND', 'Vietnamese Dong', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(163, 'YER', 'Yemeni Rial', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(164, 'ZMK', 'Zambian Kwacha', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `currency_countries`
--

CREATE TABLE `currency_countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `currency_countries`
--

INSERT INTO `currency_countries` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Andorra', 'AD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Afghanistan', 'AF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Åland Islands', 'AX', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Albania', 'AL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Algeria', 'DZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'American Samoa', 'AS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Angola', 'AO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Anguilla', 'AI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Antarctica', 'AQ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Antigua and Barbuda', 'AG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Argentina', 'AR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Armenia', 'AM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Aruba', 'AW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Australia', 'AU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Austria', 'AT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'Azerbaijan', 'AZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'Bahamas', 'BS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'Bahrain', 'BH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'Bangladesh', 'BD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'Barbados', 'BB', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'Belarus', 'BY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'Belgium', 'BE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'Belize', 'BZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'Benin', 'BJ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'Bermuda', 'BM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'Bhutan', 'BT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'Bolivia (Plurinational State of)', 'BO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'Bonaire, Sint Eustatius and Saba', 'BQ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'Bosnia and Herzegovina', 'BA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'Botswana', 'BW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'Bouvet Island', 'BV', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'Brazil', 'BR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'British Indian Ocean Territory', 'IO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'Brunei Darussalam', 'BN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'Bulgaria', 'BG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'Burkina Faso', 'BF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'Burundi', 'BI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'Cabo Verde', 'CV', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'Cambodia', 'KH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'Cameroon', 'CM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'Canada', 'CA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'Cayman Islands', 'KY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'Central African Republic', 'CF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'Chad', 'TD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'Chile', 'CL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'China', 'CN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'Christmas Island', 'CX', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'Cocos (Keeling) Islands', 'CC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'Colombia', 'CO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'Comoros', 'KM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'Congo', 'CG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'Congo (Democratic Republic of the)', 'CD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'Cook Islands', 'CK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'Costa Rica', 'CR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'Côte d\'Ivoire', 'CI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'Croatia', 'HR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'Cuba', 'CU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'Curaçao', 'CW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'Cyprus', 'CY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'Czech Republic', 'CZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'Denmark', 'DK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'Djibouti', 'DJ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'Dominica', 'DM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'Dominican Republic', 'DO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'Ecuador', 'EC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'Egypt', 'EG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'El Salvador', 'SV', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'Equatorial Guinea', 'GQ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'Eritrea', 'ER', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'Estonia', 'EE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'Ethiopia', 'ET', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'Falkland Islands (Malvinas)', 'FK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'Faroe Islands', 'FO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'Fiji', 'FJ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'Finland', 'FI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'France', 'FR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'French Guiana', 'GF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'French Polynesia', 'PF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'French Southern Territories', 'TF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'Gabon', 'GA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'Gambia', 'GM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'Georgia', 'GE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'Germany', 'DE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'Ghana', 'GH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 'Gibraltar', 'GI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 'Greece', 'GR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 'Greenland', 'GL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 'Grenada', 'GD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 'Guadeloupe', 'GP', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 'Guam', 'GU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 'Guatemala', 'GT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 'Guernsey', 'GG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 'Guinea', 'GN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 'Guinea-Bissau', 'GW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 'Guyana', 'GY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 'Haiti', 'HT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'Heard Island and McDonald Islands', 'HM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'Holy See', 'VA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 'Honduras', 'HN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 'Hong Kong', 'HK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 'Hungary', 'HU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 'Iceland', 'IS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 'India', 'IN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 'Indonesia', 'ID', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 'Iran (Islamic Republic of)', 'IR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 'Iraq', 'IQ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 'Ireland', 'IE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 'Isle of Man', 'IM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 'Israel', 'IL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 'Italy', 'IT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 'Jamaica', 'JM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 'Japan', 'JP', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, 'Jersey', 'JE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, 'Jordan', 'JO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, 'Kazakhstan', 'KZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, 'Kenya', 'KE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, 'Kiribati', 'KI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 'Korea (Democratic People\'s Republic of)', 'KP', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, 'Korea (Republic of)', 'KR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 'Kuwait', 'KW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 'Kyrgyzstan', 'KG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 'Lao People\'s Democratic Republic', 'LA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 'Latvia', 'LV', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 'Lebanon', 'LB', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, 'Lesotho', 'LS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, 'Liberia', 'LR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, 'Libya', 'LY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, 'Liechtenstein', 'LI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, 'Lithuania', 'LT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(130, 'Luxembourg', 'LU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(131, 'Macao', 'MO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, 'Macedonia (the former Yugoslav Republic of)', 'MK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(133, 'Madagascar', 'MG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(134, 'Malawi', 'MW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(135, 'Malaysia', 'MY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(136, 'Maldives', 'MV', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(137, 'Mali', 'ML', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(138, 'Malta', 'MT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(139, 'Marshall Islands', 'MH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(140, 'Martinique', 'MQ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(141, 'Mauritania', 'MR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(142, 'Mauritius', 'MU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(143, 'Mayotte', 'YT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(144, 'Mexico', 'MX', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(145, 'Micronesia (Federated States of)', 'FM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(146, 'Moldova (Republic of)', 'MD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(147, 'Monaco', 'MC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(148, 'Mongolia', 'MN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(149, 'Montenegro', 'ME', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(150, 'Montserrat', 'MS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(151, 'Morocco', 'MA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(152, 'Mozambique', 'MZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(153, 'Myanmar', 'MM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(154, 'Namibia', 'NA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(155, 'Nauru', 'NR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(156, 'Nepal', 'NP', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(157, 'Netherlands', 'NL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(158, 'New Caledonia', 'NC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(159, 'New Zealand', 'NZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(160, 'Nicaragua', 'NI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(161, 'Niger', 'NE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(162, 'Nigeria', 'NG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(163, 'Niue', 'NU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(164, 'Norfolk Island', 'NF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(165, 'Northern Mariana Islands', 'MP', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(166, 'Norway', 'NO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(167, 'Oman', 'OM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(168, 'Pakistan', 'PK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(169, 'Palau', 'PW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(170, 'Palestine, State of', 'PS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(171, 'Panama', 'PA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(172, 'Papua New Guinea', 'PG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(173, 'Paraguay', 'PY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(174, 'Peru', 'PE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(175, 'Philippines', 'PH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(176, 'Pitcairn', 'PN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(177, 'Poland', 'PL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(178, 'Portugal', 'PT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(179, 'Puerto Rico', 'PR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(180, 'Qatar', 'QA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(181, 'Réunion', 'RE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(182, 'Romania', 'RO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(183, 'Russian Federation', 'RU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(184, 'Rwanda', 'RW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(185, 'Saint Barthélemy', 'BL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(186, 'Saint Helena, Ascension and Tristan da Cunha', 'SH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(187, 'Saint Kitts and Nevis', 'KN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(188, 'Saint Lucia', 'LC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(189, 'Saint Martin (French part)', 'MF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(190, 'Saint Pierre and Miquelon', 'PM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(191, 'Saint Vincent and the Grenadines', 'VC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(192, 'Samoa', 'WS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(193, 'San Marino', 'SM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(194, 'Sao Tome and Principe', 'ST', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(195, 'Saudi Arabia', 'SA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(196, 'Senegal', 'SN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(197, 'Serbia', 'RS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(198, 'Seychelles', 'SC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(199, 'Sierra Leone', 'SL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(200, 'Singapore', 'SG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(201, 'Sint Maarten (Dutch part)', 'SX', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202, 'Slovakia', 'SK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(203, 'Slovenia', 'SI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(204, 'Solomon Islands', 'SB', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(205, 'Somalia', 'SO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(206, 'South Africa', 'ZA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(207, 'South Georgia and the South Sandwich Islands', 'GS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(208, 'South Sudan', 'SS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(209, 'Spain', 'ES', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(210, 'Sri Lanka', 'LK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(211, 'Sudan', 'SD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(212, 'Suriname', 'SR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(213, 'Svalbard and Jan Mayen', 'SJ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(214, 'Swaziland', 'SZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(215, 'Sweden', 'SE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(216, 'Switzerland', 'CH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(217, 'Syrian Arab Republic', 'SY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(218, 'Taiwan, Province of China', 'TW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(219, 'Tajikistan', 'TJ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(220, 'Tanzania, United Republic of', 'TZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(221, 'Thailand', 'TH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(222, 'Timor-Leste', 'TL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(223, 'Togo', 'TG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(224, 'Tokelau', 'TK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(225, 'Tonga', 'TO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(226, 'Trinidad and Tobago', 'TT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(227, 'Tunisia', 'TN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(228, 'Turkey', 'TR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(229, 'Turkmenistan', 'TM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(230, 'Turks and Caicos Islands', 'TC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(231, 'Tuvalu', 'TV', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(232, 'Uganda', 'UG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(233, 'Ukraine', 'UA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(234, 'United Arab Emirates', 'AE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(235, 'United Kingdom of Great Britain and Northern Ireland', 'GB', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(236, 'United States Minor Outlying Islands', 'UM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(237, 'United States of America', 'US', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(238, 'Uruguay', 'UY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(239, 'Uzbekistan', 'UZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(240, 'Vanuatu', 'VU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(241, 'Venezuela (Bolivarian Republic of)', 'VE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(242, 'Viet Nam', 'VN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(243, 'Virgin Islands (British)', 'VG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(244, 'Virgin Islands (U.S.)', 'VI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(245, 'Wallis and Futuna', 'WF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(246, 'Western Sahara', 'EH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(247, 'Yemen', 'YE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(248, 'Zambia', 'ZM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(249, 'Zimbabwe', 'ZW', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `custom_pages`
--

CREATE TABLE `custom_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `custom_pages`
--

INSERT INTO `custom_pages` (`id`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'custom-page-one', 1, '2023-10-15 20:46:10', '2023-10-15 20:46:10'),
(2, 'custom-page-two', 1, '2023-10-15 20:46:45', '2023-10-15 20:46:45');

-- --------------------------------------------------------

--
-- Table structure for table `custom_page_translations`
--

CREATE TABLE `custom_page_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `custom_page_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `custom_page_translations`
--

INSERT INTO `custom_page_translations` (`id`, `custom_page_id`, `lang_code`, `page_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Custom Page One', '<p><strong>1. What is custom page?</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriefss asbut also the on leap into a electironc typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andeiss more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>2. How does work custom page</strong></p>\r\n<p>While it&rsquo;s not legally required for ecommerce websites to have a terms and conditions agreement, adding one will help protect your as sonline business.As terms and conditions are legally enforceable rules, they allow you to set standards for how users interact with your site. Here are some of the major abenefits of including terms and conditions on your ecommerce site:</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the obb1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop.</p>\r\n<p><strong>Features :</strong></p>\r\n<ul>\r\n<li>Slim body with metal cover</li>\r\n<li>Latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</li>\r\n<li>8GB DDR4 RAM and fast 512GB PCIe SSD</li>\r\n<li>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture support</li>\r\n</ul>\r\n<p><strong>3. Protect Your Property</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>4. What to Include in Terms and Conditions for Online Stores</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas&nbsp; Ipsum to make a type specimen book.</p>\r\n<p><strong>05.Pricing and Payment Terms</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', '2023-10-15 20:46:10', '2023-10-15 20:46:10'),
(2, 2, 'en', 'Custom Page Two', '<p><strong>1. What is custom page?</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriefss asbut also the on leap into a electironc typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andeiss more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>2. How does work custom page</strong></p>\r\n<p>While it&rsquo;s not legally required for ecommerce websites to have a terms and conditions agreement, adding one will help protect your as sonline business.As terms and conditions are legally enforceable rules, they allow you to set standards for how users interact with your site. Here are some of the major abenefits of including terms and conditions on your ecommerce site:</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the obb1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop.</p>\r\n<p><strong>Features :</strong></p>\r\n<ul>\r\n<li>Slim body with metal cover</li>\r\n<li>Latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</li>\r\n<li>8GB DDR4 RAM and fast 512GB PCIe SSD</li>\r\n<li>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture support</li>\r\n</ul>\r\n<p><strong>3. Protect Your Property</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>4. What to Include in Terms and Conditions for Online Stores</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas&nbsp; Ipsum to make a type specimen book.</p>\r\n<p><strong>05.Pricing and Payment Terms</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', '2023-10-15 20:46:45', '2023-10-15 20:46:45'),
(3, 1, 'ar', 'صفحة مخصصة واحدة', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"rtl\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">لوريم إيبسوم هو ببساطة نص وهمي من صناعة الطباعة والتنضيد. لقد كان لوريم إيبسوم هو النص الوهمي القياسي في الصناعة منذ القرن السادس عشر، عندما أخذت طابعة غير معروفة لوح الكتابة وخلطته لصنع نموذج كتاب. لقد عاش ليس فقط خمسة قرون، بل قفز أيضًا إلى التنضيد الإلكتروني، وظل دون تغيير جوهريًا. لم يكن شائعاً في ستينيات القرن الماضي مع إصدار أوراق Letraset التي تحتوي على مقاطع لوريم إيبسوم، ومؤخراً مع ظهور برامج النشر المكتبي مثل Aldus PageMaker والتي تضمنت نسخاً من نص لوريم إيبسوم لإنشاء نماذج من الكتب.</span></pre>\r\n<p><strong>2. How does work custom page</strong></p>\r\n<p>While it&rsquo;s not legally required for ecommerce websites to have a terms and conditions agreement, adding one will help protect your as sonline business.As terms and conditions are legally enforceable rules, they allow you to set standards for how users interact with your site. Here are some of the major abenefits of including terms and conditions on your ecommerce site:</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the obb1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop.</p>\r\n<p><strong>Features :</strong></p>\r\n<ul>\r\n<li>Slim body with metal cover</li>\r\n<li>Latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</li>\r\n<li>8GB DDR4 RAM and fast 512GB PCIe SSD</li>\r\n<li>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture support</li>\r\n</ul>\r\n<p><strong>3. Protect Your Property</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>4. What to Include in Terms and Conditions for Online Stores</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas&nbsp; Ipsum to make a type specimen book.</p>\r\n<p><strong>05.Pricing and Payment Terms</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', '2023-10-17 23:04:37', '2023-10-18 14:51:37'),
(4, 2, 'ar', 'الصفحة المخصصة الثانية', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"rtl\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">لوريم إيبسوم هو ببساطة نص وهمي من صناعة الطباعة والتنضيد. لقد كان لوريم إيبسوم هو النص الوهمي القياسي في الصناعة منذ القرن السادس عشر، عندما أخذت طابعة غير معروفة لوح الكتابة وخلطته لصنع نموذج كتاب. لقد عاش ليس فقط خمسة قرون، بل قفز أيضًا إلى التنضيد الإلكتروني، وظل دون تغيير جوهريًا. لم يكن شائعاً في ستينيات القرن الماضي مع إصدار أوراق Letraset التي تحتوي على مقاطع لوريم إيبسوم، ومؤخراً مع ظهور برامج النشر المكتبي مثل Aldus PageMaker والتي تضمنت نسخاً من نص لوريم إيبسوم لإنشاء نماذج من الكتب.</span></pre>\r\n<p><strong>2. How does work custom page</strong></p>\r\n<p>While it&rsquo;s not legally required for ecommerce websites to have a terms and conditions agreement, adding one will help protect your as sonline business.As terms and conditions are legally enforceable rules, they allow you to set standards for how users interact with your site. Here are some of the major abenefits of including terms and conditions on your ecommerce site:</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the obb1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop.</p>\r\n<p><strong>Features :</strong></p>\r\n<ul>\r\n<li>Slim body with metal cover</li>\r\n<li>Latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</li>\r\n<li>8GB DDR4 RAM and fast 512GB PCIe SSD</li>\r\n<li>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture support</li>\r\n</ul>\r\n<p><strong>3. Protect Your Property</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>4. What to Include in Terms and Conditions for Online Stores</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas&nbsp; Ipsum to make a type specimen book.</p>\r\n<p><strong>05.Pricing and Payment Terms</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', '2023-10-17 23:04:37', '2023-10-18 14:52:39');

-- --------------------------------------------------------

--
-- Table structure for table `custom_paginations`
--

CREATE TABLE `custom_paginations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `custom_paginations`
--

INSERT INTO `custom_paginations` (`id`, `page_name`, `qty`, `created_at`, `updated_at`) VALUES
(1, 'Blog Page', 9, NULL, '2023-10-15 18:26:15'),
(2, 'Service Page', 9, NULL, '2022-10-03 10:18:39'),
(3, 'Influencer', 8, NULL, '2022-02-07 02:14:01'),
(4, 'Blog Comment', 4, NULL, '2022-09-15 03:06:58');

-- --------------------------------------------------------

--
-- Table structure for table `email_configurations`
--

CREATE TABLE `email_configurations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mail_type` tinyint(4) DEFAULT NULL,
  `mail_host` varchar(255) DEFAULT NULL,
  `mail_port` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `smtp_username` varchar(255) DEFAULT NULL,
  `smtp_password` varchar(255) DEFAULT NULL,
  `mail_encryption` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_configurations`
--

INSERT INTO `email_configurations` (`id`, `mail_type`, `mail_host`, `mail_port`, `email`, `smtp_username`, `smtp_password`, `mail_encryption`, `created_at`, `updated_at`) VALUES
(1, 2, 'sandbox.smtp.mailtrap.io', '2525', 'phpmiler144@gmail.com', 'a2ee0ec806389b', '9dd1c178bb682d', 'tls', NULL, '2025-02-02 05:21:48');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `name`, `subject`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Password Reset', 'Password Reset', '<h4>Dear <strong>{{name}}</strong>,</h4>\r\n<p>Do you want to reset your password? Please Click the following link and Reset Your Password.</p>', NULL, '2023-08-22 21:44:41'),
(2, 'Contact Email', 'Contact Email', '<p>Name: <strong>{{name}}</strong></p>\r\n<p>Email: <strong>{{email}}</strong></p>\r\n<p>Phone: <strong>{{phone}}</strong></p>\r\n<p><span style=\"background-color: transparent;\">Subject: <strong>{{subject}}</strong></span></p>\r\n<p>Message: <strong>{{message}}</strong></p>', NULL, '2023-08-22 21:46:04'),
(3, 'Subscribe Notification', 'Subscribe Notification', '<h2><b>Hi there</b>,</h2><p>\r\nCongratulations! Your Subscription has been created successfully. Please Click the following link and Verified Your Subscription. If you won\'t approve this link, after 24hourse your subscription will be denay</p>', NULL, '2021-12-10 23:44:53'),
(4, 'User Verification', 'User Verification', '<p>Dear <b>{{user_name}}</b>,\r\n</p><p>Congratulations! Your Account has been created successfully. Please Click the following link and Active your Account.</p>', NULL, '2021-12-10 23:45:25'),
(5, 'Influencer Withdraw', 'Influencer Withdraw Approval', '<p>Hi <strong>{{influencer_name}}</strong>,</p>\r\n<p>Your withdraw Request Approval successfully. Please check your account.</p>\r\n<p>Withdraw Details:</p>\r\n<p>Withdraw method : <strong>{{withdraw_method}}</strong>,</p>\r\n<p>Total Amount :<strong> {{total_amount}}</strong>,</p>\r\n<p>Withdraw charge : <strong>{{withdraw_charge}}</strong>,</p>\r\n<p>Withdraw&nbsp; Amount : <strong>{{withdraw_amount}}</strong>,</p>\r\n<p>Approval Date :<strong> {{approval_date}}</strong></p>', NULL, '2023-10-07 00:03:07'),
(6, 'Order Successfully', 'Order Successfully', '<p>Hi {{user_name}},</p><p> \r\nThanks for your new order. Your order id has been submited .</p><p>Total Amount : {{total_amount}},</p><p>Payment Method : {{payment_method}},</p><p>Payment Status : {{payment_status}},</p><p>Order Status : {{order_status}},</p><p>Order Date: {{order_date}},</p><p>Order Detail: {{order_detail}}</p>', NULL, '2022-01-10 21:37:03'),
(8, 'New Order Mail to Client', 'New Order Mail to Client', '<p>Hi&nbsp;{{name}}, Thanks for your new order. Your order has been placed.</p><p>Order Id : {{order_id}}</p><p>Amount : {{amount}}</p><p>Schedule Date : {{schedule_date}}</p>', NULL, '2022-09-24 10:15:23'),
(9, 'New Order Mail to Provider', 'New Order Mail to Provider', '<p>Hi&nbsp;{{name}}, A new order has been placed to you .</p><p>Order Id : {{order_id}}</p><p>Amount : {{amount}}</p><p>Schedule Date : {{schedule_date}}</p>', NULL, '2022-09-24 10:16:22'),
(10, 'User Verification For OTP', 'User Verification', '<p>Dear <b>{{user_name}}</b>,\r\n</p><p>Congratulations! Your Account has been created successfully. Please Copy the code and verify your account</p>', NULL, '2021-12-10 23:45:25'),
(11, 'Password Reset For OTP', 'Password Reset', '<h4>Dear <b>{{name}}</b>,</h4>\r\n    <p>Do you want to reset your password? Please copy and past the code</p>', NULL, '2021-12-09 10:06:57');

-- --------------------------------------------------------

--
-- Table structure for table `facebook_pixels`
--

CREATE TABLE `facebook_pixels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `app_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facebook_pixels`
--

INSERT INTO `facebook_pixels` (`id`, `status`, `app_id`, `created_at`, `updated_at`) VALUES
(1, 1, '972911606915059', NULL, '2024-01-17 16:26:01');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `created_at`, `updated_at`) VALUES
(1, '2023-10-15 20:21:32', '2023-10-15 20:21:32'),
(2, '2023-10-15 20:22:12', '2023-10-15 20:22:12'),
(3, '2023-10-15 20:23:33', '2023-10-15 20:23:33'),
(4, '2023-10-15 20:24:02', '2023-10-15 20:24:02'),
(5, '2023-10-15 20:24:47', '2023-10-15 20:24:47');

-- --------------------------------------------------------

--
-- Table structure for table `faq_translates`
--

CREATE TABLE `faq_translates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `faq_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_translates`
--

INSERT INTO `faq_translates` (`id`, `lang_code`, `faq_id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 'en', 1, 'Can you rovide documentation to implement?', '<p>Vestibulum quis neque nunc. Maecenas pharetra libero id efficitur gravida. Aenean risus enim, coin quam in, consequat nec lacus. Aenean faucibus venenatis aliquet. Sed nulla quam, vehicula ut libe tpat quam. Phasellus semper vitae tellus sit amet scelerisque</p>', '2023-10-15 20:21:33', '2023-10-15 20:21:33'),
(2, 'en', 2, 'What is an influencer marketing tool?', '<p>Vestibulum quis neque nunc. Maecenas pharetra libero id efficitur gravida. Aenean risus enim, coin quam in, consequat nec lacus. Aenean faucibus venenatis aliquet. Sed nulla quam, vehicula ut libe tpat quam. Phasellus semper vitae tellus sit amet scelerisque</p>', '2023-10-15 20:22:12', '2023-10-15 20:22:12'),
(3, 'en', 3, 'What is an influencer marketing software?', '<p>Vestibulum quis neque nunc. Maecenas pharetra libero id efficitur gravida. Aenean risus enim, coin quam in, consequat nec lacus. Aenean faucibus venenatis aliquet. Sed nulla quam, vehicula ut libe tpat quam. Phasellus semper vitae tellus sit amet scelerisque</p>', '2023-10-15 20:23:33', '2023-10-15 20:23:33'),
(4, 'en', 4, 'Why is influencer marketing critical for social commerce?', '<p>Vestibulum quis neque nunc. Maecenas pharetra libero id efficitur gravida. Aenean risus enim, coin quam in, consequat nec lacus. Aenean faucibus venenatis aliquet. Sed nulla quam, vehicula ut libe tpat quam. Phasellus semper vitae tellus sit amet scelerisque</p>', '2023-10-15 20:24:02', '2023-10-15 20:24:02'),
(5, 'en', 5, 'What is the average number of influencers for the campaign?', '<p>Vestibulum quis neque nunc. Maecenas pharetra libero id efficitur gravida. Aenean risus enim, coin quam in, consequat nec lacus. Aenean faucibus venenatis aliquet. Sed nulla quam, vehicula ut libe tpat quam. Phasellus semper vitae tellus sit amet scelerisque</p>', '2023-10-15 20:24:47', '2023-10-15 20:24:47'),
(6, 'ar', 1, 'هل يمكنك توفير الوثائق اللازمة للتنفيذ؟', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"ltr\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">الدهليز quis neque nunc. Maecenas pharetra libero id efficitur gravida. Aenean risus enim، عملة quam in، consequat nec lacus. Aenean faucibus venenatis aliquet. Sed nulla quam, vehicula ut libe tpat quam. phasellus semper vitae Tellus sit amet scelerisque</span></pre>', '2023-10-17 23:04:37', '2023-10-18 14:59:24'),
(7, 'ar', 2, 'ما هي أداة التسويق المؤثر؟', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"ltr\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">الدهليز quis neque nunc. Maecenas pharetra libero id efficitur gravida. Aenean risus enim، عملة quam in، consequat nec lacus. Aenean faucibus venenatis aliquet. Sed nulla quam, vehicula ut libe tpat quam. phasellus semper vitae Tellus sit amet scelerisque</span></pre>', '2023-10-17 23:04:37', '2023-10-18 14:59:53'),
(8, 'ar', 3, 'ما هو برنامج التسويق المؤثر؟', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"ltr\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">الدهليز quis neque nunc. Maecenas pharetra libero id efficitur gravida. Aenean risus enim، عملة quam in، consequat nec lacus. Aenean faucibus venenatis aliquet. Sed nulla quam, vehicula ut libe tpat quam. phasellus semper vitae Tellus sit amet scelerisque</span></pre>', '2023-10-17 23:04:37', '2023-10-18 15:00:29'),
(9, 'ar', 4, 'لماذا يعد التسويق المؤثر أمرًا بالغ الأهمية للتجارة الاجتماعية؟', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"ltr\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">الدهليز quis neque nunc. Maecenas pharetra libero id efficitur gravida. Aenean risus enim، عملة quam in، consequat nec lacus. Aenean faucibus venenatis aliquet. Sed nulla quam, vehicula ut libe tpat quam. phasellus semper vitae Tellus sit amet scelerisque</span></pre>', '2023-10-17 23:04:37', '2023-10-18 15:01:03'),
(10, 'ar', 5, 'ما هو متوسط ​​عدد المؤثرين في الحملة؟', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"ltr\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">الدهليز quis neque nunc. Maecenas pharetra libero id efficitur gravida. Aenean risus enim، عملة quam in، consequat nec lacus. Aenean faucibus venenatis aliquet. Sed nulla quam, vehicula ut libe tpat quam. phasellus semper vitae Tellus sit amet scelerisque</span></pre>', '2023-10-17 23:04:37', '2023-10-18 15:01:38');

-- --------------------------------------------------------

--
-- Table structure for table `flutterwaves`
--

CREATE TABLE `flutterwaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `public_key` text NOT NULL,
  `secret_key` text NOT NULL,
  `currency_rate` double NOT NULL DEFAULT 1,
  `country_code` varchar(191) NOT NULL,
  `currency_code` varchar(191) NOT NULL,
  `title` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flutterwaves`
--

INSERT INTO `flutterwaves` (`id`, `public_key`, `secret_key`, `currency_rate`, `country_code`, `currency_code`, `title`, `logo`, `status`, `created_at`, `updated_at`, `currency_id`) VALUES
(1, 'FLWPUBK_TEST-5760e3ff9888aa1ab5e5cd1ec3f99cb1-X', 'FLWSECK_TEST-81cb5da016d0a51f7329d4a8057e766d-X', 460.49, 'NG', 'NGN', 'Ecommerce', 'uploads/website-images/flutterwave-2023-09-28-08-46-27-7555.jpg', 0, NULL, '2025-02-18 09:10:52', 2);

-- --------------------------------------------------------

--
-- Table structure for table `google_analytics`
--

CREATE TABLE `google_analytics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `analytic_id` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `google_analytics`
--

INSERT INTO `google_analytics` (`id`, `analytic_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'UA-84213520-6', 1, NULL, '2024-01-17 16:21:30');

-- --------------------------------------------------------

--
-- Table structure for table `google_recaptchas`
--

CREATE TABLE `google_recaptchas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_key` varchar(255) DEFAULT NULL,
  `secret_key` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `google_recaptchas`
--

INSERT INTO `google_recaptchas` (`id`, `site_key`, `secret_key`, `status`, `created_at`, `updated_at`) VALUES
(1, '6LcuqBwoAAAAAGKXaZ6GI82dbi_kUAHIvpQmqR1X', '6LcuqBwoAAAAAE3owg-FhBYN6UeHNMQ1HUIyCHYA', 0, NULL, '2024-06-01 17:51:12');

-- --------------------------------------------------------

--
-- Table structure for table `home_pages`
--

CREATE TABLE `home_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `video_image` varchar(255) DEFAULT NULL,
  `video_id` varchar(255) DEFAULT NULL,
  `facebook_image` varchar(255) DEFAULT NULL,
  `facebook_follower` varchar(255) DEFAULT NULL,
  `twitter_image` varchar(255) DEFAULT NULL,
  `twitter_follower` varchar(255) DEFAULT NULL,
  `tiktok_image` varchar(255) DEFAULT NULL,
  `tiktok_follower` varchar(255) DEFAULT NULL,
  `instagram_image` varchar(255) DEFAULT NULL,
  `instagram_follower` varchar(255) DEFAULT NULL,
  `faq_image` varchar(255) DEFAULT NULL,
  `provider_joining_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_pages`
--

INSERT INTO `home_pages` (`id`, `video_image`, `video_id`, `facebook_image`, `facebook_follower`, `twitter_image`, `twitter_follower`, `tiktok_image`, `tiktok_follower`, `instagram_image`, `instagram_follower`, `faq_image`, `provider_joining_image`, `created_at`, `updated_at`) VALUES
(1, 'uploads/website-images/video-image-2023-09-06-06-30-36-3964.webp', 'oRhtJTFB5gQ', 'uploads/website-images/facebook-icon-2023-10-16-03-05-09-5457.png', '6M+', 'uploads/website-images/twitter-icon-2023-09-06-07-06-56-7024.svg', '3M+', 'uploads/website-images/twitter-icon-2023-09-06-07-08-23-2473.svg', '2K+', 'uploads/website-images/twitter-icon-2023-09-06-07-09-35-8675.svg', '10M+', 'uploads/website-images/faq-image-2023-09-06-06-47-15-3121.webp', 'uploads/website-images/provider-joining-image-2023-09-06-06-56-12-3623.webp', NULL, '2023-10-15 21:05:09');

-- --------------------------------------------------------

--
-- Table structure for table `home_page_translations`
--

CREATE TABLE `home_page_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `home_page_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `category_title` varchar(255) DEFAULT NULL,
  `category_header` varchar(255) DEFAULT NULL,
  `feature_title` varchar(255) DEFAULT NULL,
  `feature_header` varchar(255) DEFAULT NULL,
  `influencer_title` varchar(255) DEFAULT NULL,
  `influencer_header` varchar(255) DEFAULT NULL,
  `service_title` varchar(255) DEFAULT NULL,
  `service_header` varchar(255) DEFAULT NULL,
  `working_title` varchar(255) DEFAULT NULL,
  `working_header` varchar(255) DEFAULT NULL,
  `video_title` varchar(255) DEFAULT NULL,
  `video_description` text DEFAULT NULL,
  `partner_title` varchar(255) DEFAULT NULL,
  `partner_description` text DEFAULT NULL,
  `testimonial_title` varchar(255) DEFAULT NULL,
  `testimonial_header` varchar(255) DEFAULT NULL,
  `faq_title` varchar(255) DEFAULT NULL,
  `faq_header` varchar(255) DEFAULT NULL,
  `faq_description` text DEFAULT NULL,
  `blog_title` varchar(255) DEFAULT NULL,
  `blog_header` varchar(255) DEFAULT NULL,
  `provider_joining_title` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_page_translations`
--

INSERT INTO `home_page_translations` (`id`, `home_page_id`, `lang_code`, `category_title`, `category_header`, `feature_title`, `feature_header`, `influencer_title`, `influencer_header`, `service_title`, `service_header`, `working_title`, `working_header`, `video_title`, `video_description`, `partner_title`, `partner_description`, `testimonial_title`, `testimonial_header`, `faq_title`, `faq_header`, `faq_description`, `blog_title`, `blog_header`, `provider_joining_title`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Categories', 'Influencer in Different Categories', 'Best Feature', 'Our Latest Features', 'Top Business', 'Talented Business Member', 'Our Services', 'Influencer Latest Services', 'Working Process', 'How Dose It Work?', 'Manage all your creator relation ships in one place.', 'Suspendisse non leo lobortis, fermentum magna vitae, viverra nisi. Quisque tristique preti odio eget ullamcorper. Sed quis mi pulvinar Integer vitae lorem tortor. Integer tempus as nulla massa, eu blandit risus euismod non. Aenean vitae nunc ets orci suscipit hendrerit. Aenean et facilisis dolor. Aliquam vulputate facilisis neque.', 'We Work with Brands that Influence <span> 1000+ Clients </span>', 'It is a long established fact that a reader will be distracted by the content of a page when looking at its layout. It is a long establish that a reader will be distracted.', 'Testimonial', 'What Our Customers Say?', 'Our Faq’s', 'Frequently Faq’s', 'Curabitur a pretium orci, a venenatis diam phasell mi velit. Vestibulum et tincidunt.', 'Latest News', 'Latest Blog & Articles', 'Let influencers do the heavy lifting for your marketing campaign', NULL, '2025-01-30 11:42:21'),
(13, 1, 'ar', 'فئات', 'المؤثر في فئات مختلفة', 'أفضل ميزة', 'أحدث الميزات لدينا', 'المؤثر الأعلى', 'عضو مؤثر موهوب', 'خدماتنا', 'أحدث الخدمات المؤثرة', 'عملية العمل', 'كيف تعمل الجرعة؟', 'إدارة جميع علاقات المبدعين الخاصة بك في مكان واحد.', 'Suspendisse not leobortis، تخمير السيرة الذاتية، viverra nisi. هناك طريقة رائعة لجذب الانتباه. Sed quis mi pulvinar Integer vitae lorem tortor. عدد صحيح من الوقت كما لا يوجد كتلة، الاتحاد الأوروبي blandit risus euismod غير. Aenean vitae nunc ets orci suscipit hendrerit. Aenean et facilisis dolor. Aliquam vulputate facilisis neque.', 'نحن نعمل مع العلامات التجارية التي تؤثر على <span> أكثر من 1000 عميل </span>', 'إنها حقيقة مثبتة منذ زمن طويل أن محتوى الصفحة سيلهي القارئ عند النظر إلى تصميمها. لقد ثبت منذ زمن طويل أن القارئ سوف يصرف انتباهه.', 'شهادة', 'ماذا يقول عملاؤنا؟', 'الأسئلة الشائعة لدينا', 'الأسئلة الشائعة بشكل متكرر', 'Curabitur a pretium orci، a venenatis diamphasell mi velit. الدهليز و tincidunt.', 'أحدث الأخبار', 'أحدث المدونات والمقالات', 'اسمح للمؤثرين بالقيام بالمهمة الثقيلة لحملتك التسويقية', '2023-10-17 23:04:37', '2023-10-18 14:48:20');

-- --------------------------------------------------------

--
-- Table structure for table `influencer_withdraws`
--

CREATE TABLE `influencer_withdraws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `influencer_id` int(11) NOT NULL,
  `method` varchar(255) NOT NULL,
  `total_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `withdraw_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `withdraw_charge` decimal(8,2) NOT NULL DEFAULT 0.00,
  `account_info` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `approved_date` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `influencer_withdraws`
--

INSERT INTO `influencer_withdraws` (`id`, `influencer_id`, `method`, `total_amount`, `withdraw_amount`, `withdraw_charge`, `account_info`, `status`, `approved_date`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bank Payment', 50.00, 45.00, 10.00, 'Bank Name: IBBL\r\nAccount Number:  43434*******656554\r\nRouting Number: 545*********54\r\nBranch: Dhaka, Bangladesh', 1, '2023-10-18', '2023-10-17 22:35:25', '2023-10-17 22:39:59'),
(2, 21, 'Bank Payment', 100.00, 90.00, 10.00, 'Bank Name: Your bank name\r\nAccount Number:  4242424242424242\r\nRouting Number: 4564564664\r\nBranch: ABCD', 1, '2025-02-05', '2025-02-04 13:34:46', '2025-02-05 05:00:10');

-- --------------------------------------------------------

--
-- Table structure for table `instamojo_payments`
--

CREATE TABLE `instamojo_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `api_key` text NOT NULL,
  `auth_token` text NOT NULL,
  `currency_rate` varchar(255) NOT NULL DEFAULT '1',
  `account_mode` varchar(255) NOT NULL DEFAULT 'Sandbox',
  `status` int(11) NOT NULL DEFAULT 1,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instamojo_payments`
--

INSERT INTO `instamojo_payments` (`id`, `api_key`, `auth_token`, `currency_rate`, `account_mode`, `status`, `image`, `created_at`, `updated_at`, `currency_id`) VALUES
(1, 'test_5f4a2c9a58ef216f8a1a688910f', 'test_994252ada69ce7b3d282b9941c2', '81.98', 'Sandbox', 0, 'uploads/website-images/instamojo-2023-09-28-08-47-23-4613.png', NULL, '2025-02-18 09:11:09', 3);

-- --------------------------------------------------------

--
-- Table structure for table `iyzico_payments`
--

CREATE TABLE `iyzico_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency_id` int(11) NOT NULL DEFAULT 0,
  `api_key` text NOT NULL,
  `secret_key` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `iyzico_image` varchar(255) DEFAULT NULL,
  `account_mode` varchar(255) NOT NULL DEFAULT 'Sandbox',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `iyzico_payments`
--

INSERT INTO `iyzico_payments` (`id`, `currency_id`, `api_key`, `secret_key`, `status`, `iyzico_image`, `account_mode`, `created_at`, `updated_at`) VALUES
(1, 6, 'sandbox-Zb7faTl5W0BW49QNGPSVWoaKXpbELbTe', 'sandbox-K9g0fyf0OhsLtLd7rYDVdflRYTGSWBSf', 1, 'uploads/website-images/iyzico-2024-02-07-08-51-49-1631.png', 'Sandbox', '2023-11-20 01:54:56', '2024-02-07 14:51:49');

-- --------------------------------------------------------

--
-- Table structure for table `kyc_information`
--

CREATE TABLE `kyc_information` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kyc_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kyc_information`
--

INSERT INTO `kyc_information` (`id`, `kyc_id`, `user_id`, `file`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'uploads/custom-images/document-2024-05-03-10-06-12-2457.jpg', 'Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content.', 1, '2024-05-03 16:06:12', '2024-05-03 16:06:31');

-- --------------------------------------------------------

--
-- Table structure for table `kyc_types`
--

CREATE TABLE `kyc_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kyc_types`
--

INSERT INTO `kyc_types` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'NID', 1, '2024-05-03 16:04:19', '2024-05-03 16:04:19'),
(2, 'Passport', 1, '2024-05-03 16:04:35', '2024-05-03 16:04:35'),
(3, 'Driving Licence', 1, '2024-05-03 16:05:12', '2024-05-03 16:05:20');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang_name` varchar(255) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `is_default` varchar(255) NOT NULL DEFAULT 'no',
  `status` int(11) NOT NULL DEFAULT 0,
  `lang_direction` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `lang_name`, `lang_code`, `is_default`, `status`, `lang_direction`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 'yes', 1, 'left_to_right', '2023-08-23 00:21:38', '2023-10-15 15:48:23'),
(33, 'Arabic', 'ar', 'no', 1, 'right_to_left', '2023-10-17 23:04:37', '2023-10-17 23:04:37');

-- --------------------------------------------------------

--
-- Table structure for table `mercado_pago_payments`
--

CREATE TABLE `mercado_pago_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency_id` int(11) NOT NULL DEFAULT 0,
  `public_key` text NOT NULL,
  `access_token` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `mercado_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mercado_pago_payments`
--

INSERT INTO `mercado_pago_payments` (`id`, `currency_id`, `public_key`, `access_token`, `status`, `mercado_image`, `created_at`, `updated_at`) VALUES
(1, 7, 'TEST-6f72a502-51c8-4e9a-8ca3-cb7fa0addad8', 'TEST-6068652511264159-022306-e78da379f3963916b1c7130ff2906826-529753482', 1, 'uploads/website-images/iyzico-2024-02-07-08-52-26-3411.png', '2023-11-20 01:54:56', '2024-02-07 14:52:26');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `buyer_id` int(11) NOT NULL DEFAULT 1,
  `provider_id` int(11) NOT NULL DEFAULT 1,
  `message` text DEFAULT NULL,
  `buyer_read_msg` int(11) NOT NULL DEFAULT 0,
  `provider_read_msg` int(11) NOT NULL DEFAULT 0,
  `send_by` varchar(255) DEFAULT NULL,
  `service_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `buyer_id`, `provider_id`, `message`, `buyer_read_msg`, `provider_read_msg`, `send_by`, `service_id`, `created_at`, `updated_at`) VALUES
(1, 5, 1, NULL, 1, 1, 'buyer', 11, '2024-08-06 21:03:42', '2025-02-05 03:28:21'),
(2, 5, 1, 'hello ki obostha', 1, 1, 'buyer', 0, '2024-08-06 21:03:52', '2025-02-05 03:28:21'),
(3, 5, 1, 'kemon acho ?', 1, 1, 'buyer', 0, '2024-08-06 21:03:57', '2025-02-05 03:28:21'),
(4, 5, 1, 'kothay acho ?', 1, 1, 'buyer', 0, '2024-08-06 21:13:26', '2025-02-05 03:28:21'),
(5, 5, 2, 'ki obostha dada', 1, 0, 'buyer', 0, '2024-08-06 21:13:41', '2025-02-02 08:50:31'),
(6, 5, 2, 'valo acho tumi ?', 1, 0, 'buyer', 0, '2024-08-06 21:13:47', '2025-02-02 08:50:31'),
(7, 5, 1, 'ami valo acho', 1, 1, 'provider', 0, '2024-08-06 21:15:06', '2025-02-05 03:28:21'),
(8, 5, 1, 'tumi kemon acho ?', 1, 1, 'provider', 0, '2024-08-06 21:15:10', '2025-02-05 03:28:21'),
(9, 5, 1, 'andolone naki tumo jaw nai ?', 1, 1, 'provider', 0, '2024-08-06 21:15:23', '2025-02-05 03:28:21'),
(10, 5, 1, 'polapain to pathai dicche', 1, 1, 'provider', 0, '2024-08-06 21:18:02', '2025-02-05 03:28:21'),
(11, 5, 1, 'kothaw kow na kn', 1, 1, 'provider', 0, '2024-08-06 21:22:38', '2025-02-05 03:28:21'),
(12, 5, 1, 'r bolio na, rastay gele voy kore', 1, 1, 'buyer', 0, '2024-08-06 21:22:52', '2025-02-05 03:28:21'),
(13, 5, 1, 'kokhon ghuli kore dey', 1, 1, 'buyer', 0, '2024-08-06 21:22:58', '2025-02-05 03:28:21'),
(14, 5, 1, 'thik nai', 1, 1, 'buyer', 0, '2024-08-06 21:23:01', '2025-02-05 03:28:21'),
(15, 5, 1, 'voy er kichu nai', 1, 1, 'provider', 0, '2024-08-06 21:23:39', '2025-02-05 03:28:21'),
(16, 5, 1, 'desh to sadhin', 1, 1, 'provider', 0, '2024-08-06 21:23:46', '2025-02-05 03:28:21'),
(17, 5, 4, 'hey', 1, 0, 'buyer', 0, '2025-02-01 08:49:43', '2025-02-01 08:49:43'),
(18, 5, 21, 'hi', 1, 0, 'buyer', 0, '2025-02-02 06:23:29', '2025-02-02 06:32:05'),
(19, 5, 21, 'hi', 1, 0, 'buyer', 0, '2025-02-02 06:23:32', '2025-02-02 06:32:05'),
(20, 5, 21, 'hi', 1, 0, 'buyer', 0, '2025-02-02 06:23:34', '2025-02-02 06:32:05'),
(21, 5, 1, 'hi', 0, 1, 'provider', 0, '2025-02-05 03:28:30', '2025-02-05 03:28:30'),
(22, 5, 1, 'hi', 0, 1, 'provider', 0, '2025-02-05 03:28:33', '2025-02-05 03:28:33'),
(23, 5, 1, 'hi', 0, 1, 'provider', 0, '2025-02-05 03:28:34', '2025-02-05 03:28:34'),
(24, 5, 1, 'hi', 0, 1, 'provider', 0, '2025-02-05 03:28:40', '2025-02-05 03:28:40'),
(25, 24, 26, 'hi', 1, 1, 'buyer', 0, '2025-02-13 09:55:38', '2025-02-18 12:47:43'),
(26, 24, 26, 'hi', 1, 1, 'buyer', 0, '2025-02-13 09:55:41', '2025-02-18 12:47:43'),
(27, 24, 26, 'hi', 1, 1, 'buyer', 0, '2025-02-13 09:58:14', '2025-02-18 12:47:43'),
(28, 24, 26, 'hi', 1, 1, 'buyer', 0, '2025-02-13 09:58:19', '2025-02-18 12:47:43'),
(29, 24, 26, 'hello', 1, 1, 'provider', 0, '2025-02-13 09:58:48', '2025-02-18 12:47:43'),
(30, 24, 26, 'hi', 1, 1, 'buyer', 0, '2025-02-13 10:37:48', '2025-02-18 12:47:43'),
(31, 24, 26, 'sdfdsf', 1, 1, 'buyer', 0, '2025-02-13 10:41:56', '2025-02-18 12:47:43'),
(32, 24, 26, 'kjhk', 1, 1, 'buyer', 0, '2025-02-13 10:43:43', '2025-02-18 12:47:43'),
(33, 24, 26, 'saffs', 1, 1, 'buyer', 0, '2025-02-13 10:45:22', '2025-02-18 12:47:43'),
(34, 24, 26, 'fsfds', 1, 1, 'buyer', 0, '2025-02-13 10:49:46', '2025-02-18 12:47:43'),
(35, 24, 26, 'sfdsf', 1, 1, 'buyer', 0, '2025-02-13 10:50:33', '2025-02-18 12:47:43'),
(36, 24, 26, 'sdadsa', 1, 1, 'buyer', 0, '2025-02-13 10:51:07', '2025-02-18 12:47:43'),
(37, 24, 26, 'adsad', 1, 1, 'buyer', 0, '2025-02-13 10:51:27', '2025-02-18 12:47:43'),
(38, 24, 26, 'fsdfdf', 1, 1, 'buyer', 0, '2025-02-13 10:51:51', '2025-02-18 12:47:43'),
(39, 24, 26, 'klkl', 1, 1, 'buyer', 0, '2025-02-13 10:52:52', '2025-02-18 12:47:43'),
(40, 24, 26, 'fsdfs', 1, 1, 'buyer', 0, '2025-02-15 04:03:18', '2025-02-18 12:47:43'),
(41, 24, 26, 'sfsf', 1, 1, 'buyer', 0, '2025-02-15 04:14:24', '2025-02-18 12:47:43'),
(42, 24, 26, 'sdfsdfsdf', 1, 1, 'buyer', 0, '2025-02-15 12:46:48', '2025-02-18 12:47:43'),
(43, 24, 26, 'dsgfsd', 1, 1, 'buyer', 0, '2025-02-15 12:49:19', '2025-02-18 12:47:43'),
(44, 24, 26, 'dsgfsdfsdf', 1, 1, 'buyer', 0, '2025-02-15 12:50:12', '2025-02-18 12:47:43'),
(45, 24, 26, 'sfsdf', 1, 1, 'buyer', 0, '2025-02-15 12:59:47', '2025-02-18 12:47:43'),
(46, 24, 26, 'hello', 1, 1, 'buyer', 0, '2025-02-15 13:01:06', '2025-02-18 12:47:43'),
(47, 24, 26, 'dsfs', 1, 1, 'provider', 0, '2025-02-15 13:01:20', '2025-02-18 12:47:43'),
(48, 24, 26, 'sfsdf', 1, 1, 'provider', 0, '2025-02-15 13:01:43', '2025-02-18 12:47:43'),
(49, 24, 26, 'dfgbdbg', 1, 1, 'buyer', 0, '2025-02-15 13:01:58', '2025-02-18 12:47:43'),
(50, 24, 26, 'amar shonar ban', 1, 1, 'buyer', 0, '2025-02-15 13:05:16', '2025-02-18 12:47:43'),
(51, 24, 26, 'sfsf', 1, 1, 'provider', 0, '2025-02-15 13:05:31', '2025-02-18 12:47:43'),
(52, 24, 26, 'df', 1, 1, 'buyer', 0, '2025-02-15 13:06:07', '2025-02-18 12:47:43'),
(53, 24, 26, 'hi', 1, 1, 'buyer', 0, '2025-02-18 05:44:46', '2025-02-18 12:47:43'),
(54, 24, 26, 'hi', 1, 1, 'buyer', 0, '2025-02-18 05:44:49', '2025-02-18 12:47:43'),
(55, 24, 26, 'hi', 1, 1, 'provider', 0, '2025-02-18 05:44:58', '2025-02-18 12:47:43');

-- --------------------------------------------------------

--
-- Table structure for table `message_documents`
--

CREATE TABLE `message_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_message_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `message_documents`
--

INSERT INTO `message_documents` (`id`, `ticket_message_id`, `file_name`, `created_at`, `updated_at`) VALUES
(1, 3, 'support-file-16976204060.jpg', '2023-10-17 20:13:26', '2023-10-17 20:13:26'),
(2, 3, 'support-file-16976204061.jpg', '2023-10-17 20:13:26', '2023-10-17 20:13:26'),
(3, 3, 'support-file-16976204062.jpg', '2023-10-17 20:13:26', '2023-10-17 20:13:26');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_08_21_121608_create_admins_table', 2),
(6, '2023_08_22_052128_add_admin_info_to_admins', 3),
(7, '2023_08_22_060633_create_settings_table', 4),
(8, '2023_08_22_091046_add_footer_logo_to_settings', 5),
(9, '2023_08_22_092103_create_cookie_consents_table', 6),
(10, '2023_08_23_041831_add_contact_info_to_settings', 7),
(11, '2023_08_23_061207_create_languages_table', 8),
(12, '2023_08_23_065713_create_blogs_table', 9),
(13, '2023_08_23_070243_create_blog_translations_table', 9),
(16, '2023_08_23_070627_create_blog_categories_table', 10),
(17, '2023_08_23_070722_create_blog_category_translations_table', 10),
(18, '2023_08_24_041827_create_blog_comments_table', 11),
(19, '2023_08_24_062632_create_about_us_table', 12),
(20, '2023_08_24_063507_create_about_us_translations_table', 12),
(21, '2023_08_24_091604_create_contact_us_table', 13),
(24, '2023_08_24_093106_create_custom_pages_table', 14),
(25, '2023_08_24_093124_create_custom_page_translations_table', 14),
(26, '2023_08_28_041811_create_term_and_conditions_table', 15),
(27, '2023_08_28_045030_create_privacy_policies_table', 16),
(28, '2023_08_28_051357_create_faq_translates_table', 17),
(29, '2023_08_28_051729_create_faqs_table', 17),
(30, '2023_08_28_060623_add_error_page_to_settings', 18),
(33, '2023_08_30_072900_create_our_features_table', 19),
(34, '2023_08_30_073257_create_our_feature_translations_table', 19),
(35, '2023_08_30_110058_create_testimonials_table', 20),
(36, '2023_08_30_110431_create_testimonial_translations_table', 20),
(37, '2023_08_31_095519_create_partners_table', 21),
(38, '2023_08_31_103514_create_slider_ones_table', 22),
(39, '2023_08_31_110151_create_slider_one_translations_table', 22),
(40, '2023_09_05_051200_create_why_choos_us_table', 23),
(41, '2023_09_05_051855_create_why_choos_us_translations_table', 23),
(42, '2023_09_05_091143_create_why_choose_us_table', 24),
(43, '2023_09_05_092553_create_why_choose_us_translations_table', 24),
(44, '2023_09_06_052748_create_home_pages_table', 25),
(45, '2023_09_06_055050_create_home_page_translations_table', 25),
(46, '2023_09_07_060742_create_categories_table', 26),
(47, '2023_09_07_060821_create_category_translations_table', 26),
(48, '2023_09_07_071459_create_services_table', 27),
(49, '2023_09_07_100352_create_service_translations_table', 27),
(50, '2023_09_09_112422_create_additional_services_table', 28),
(51, '2023_09_09_112819_create_additional_service_translations_table', 28),
(52, '2023_09_12_054101_create_seo_settings_table', 29),
(53, '2023_09_18_110420_create_wishlists_table', 30),
(54, '2023_09_19_061215_create_tickets_table', 31),
(55, '2023_09_19_061507_create_ticket_messages_table', 31),
(56, '2023_09_19_061834_create_message_documents_table', 31),
(57, '2023_09_20_051435_create_appointment_schedules_table', 32),
(60, '2023_09_20_053359_create_coupons_table', 33),
(61, '2023_09_20_053412_create_coupon_histories_table', 33),
(62, '2023_09_27_082327_create_orders_table', 34),
(63, '2023_10_04_102616_create_refund_requests_table', 35),
(64, '2023_10_04_103800_add_admin_approved_to_orders', 36),
(65, '2023_10_04_111838_create_complete_requests_table', 36),
(66, '2023_10_07_042421_create_withdraw_methods_table', 37),
(67, '2023_10_07_042757_create_influencer_withdraws_table', 38),
(69, '2023_10_09_060728_create_reviews_table', 39),
(70, '2023_10_10_065008_add_login_page_bg_to_settings', 40),
(71, '2023_10_10_110758_create_social_login_infos_table', 41),
(72, '2023_10_10_120814_add_social_info_to_users', 42),
(73, '2023_10_11_085004_add_footer_info_to_settings', 43),
(75, '2023_10_11_093736_add_copyright_to_settings', 44),
(76, '2023_11_05_154747_create_paymongo_payments_table', 45),
(77, '2023_11_09_154516_create_iyzico_payments_table', 45),
(78, '2023_11_11_085653_create_mercado_pago_payments_table', 45),
(79, '2023_11_07_051924_create_multi_currencies_table', 46),
(80, '2023_11_20_164611_add_currency_id_to_paypal_payments', 47),
(81, '2023_11_20_170037_add_to_currency_id_stripe_payments', 48),
(82, '2023_11_20_170738_add_currency_id_to_razorpay_payments', 49),
(83, '2023_11_20_171803_add_currency_id_to_flutterwave_payments', 50),
(84, '2023_11_23_152129_add_currency_id_to_paystack_and_mollies', 51),
(85, '2023_11_23_154330_add_currency_id_to_instamojo_payments', 52),
(86, '2024_05_01_050338_create_kyc_types_table', 53),
(87, '2024_05_01_082702_create_kyc_information_table', 53),
(88, '2024_04_23_081908_add_forget_password_otp_to_users_table', 54),
(89, '2024_04_23_094228_add_email_verifide_to_users_table', 54),
(90, '2024_06_02_065415_add_schedule_wise_price_to_appointment_schedules', 55),
(91, '2024_02_20_083058_create_subscription_plans_table', 56),
(92, '2024_02_20_083331_create_purchase_histories_table', 56),
(93, '2024_02_20_084219_create_provider_bank_handcashes_table', 56),
(94, '2024_02_20_084241_create_provider_flutterwaves_table', 56),
(95, '2024_02_20_084310_create_provider_instamojos_table', 56),
(96, '2024_02_20_084340_create_provider_mollies_table', 56),
(97, '2024_02_20_084359_create_provider_paypals_table', 56),
(98, '2024_02_20_084423_create_provider_paystacks_table', 56),
(99, '2024_02_20_084459_create_provider_razorpays_table', 56),
(100, '2024_02_20_084630_create_provider_stripes_table', 56),
(101, '2024_02_24_065805_add_fields_to_subscription_plans_table', 56),
(102, '2024_04_06_091701_create_portfolios_table', 56),
(103, '2024_08_04_045746_create_messages_table', 57),
(107, '2025_02_02_064911_create_subscription_fees_table', 58),
(108, '2025_02_06_094709_add_fees_and_fees_amount_to_orders_table', 59);

-- --------------------------------------------------------

--
-- Table structure for table `multi_currencies`
--

CREATE TABLE `multi_currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency_name` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `currency_code` varchar(255) NOT NULL,
  `currency_icon` varchar(255) NOT NULL,
  `is_default` varchar(255) NOT NULL,
  `currency_rate` decimal(8,2) NOT NULL,
  `currency_position` varchar(255) NOT NULL DEFAULT 'before_price',
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `multi_currencies`
--

INSERT INTO `multi_currencies` (`id`, `currency_name`, `country_code`, `currency_code`, `currency_icon`, `is_default`, `currency_rate`, `currency_position`, `status`, `created_at`, `updated_at`) VALUES
(1, '$-USD', 'USD', 'USD', '$', 'yes', 1.00, 'before_price', 'active', '2023-11-20 02:04:45', '2024-05-01 19:24:59'),
(2, '₦-NGN', 'NG', 'NGN', '₦', 'no', 3.00, 'before_price', 'active', '2023-11-20 02:07:35', '2024-02-07 16:41:12'),
(3, '₹-INR', 'IN', 'INR', '₹', 'no', 2.00, 'before_price', 'active', '2023-11-20 03:06:44', '2023-11-20 03:06:44'),
(4, '$-CAD', 'CAD', 'CAD', 'C$', 'no', 1.00, 'before_price', 'active', '2023-11-23 01:35:23', '2023-11-23 01:35:23'),
(5, '₱ - PHP', 'PHP', 'PHP', '₱', 'no', 10.00, 'before_price', 'active', '2023-11-23 01:59:31', '2023-11-23 02:51:32'),
(6, '₺-Turkish lira', 'TL', 'TRY', '₺', 'no', 0.04, 'before_price', 'active', '2023-11-23 02:08:32', '2023-11-23 02:08:32'),
(7, '$-ARS', 'ARS', 'ARS', '$', 'no', 2.00, 'before_price', 'active', '2023-11-23 02:10:11', '2023-11-23 02:10:11');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `booking_date` varchar(255) NOT NULL,
  `appointment_schedule_id` int(11) NOT NULL,
  `schedule_time_slot` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL,
  `influencer_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `package_amount` decimal(8,2) NOT NULL,
  `additional_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `fees_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `fees` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`fees`)),
  `coupon_discount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(8,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `transection_id` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL DEFAULT 'awaiting_for_influencer_approval',
  `package_features` text DEFAULT NULL,
  `additional_services` text DEFAULT NULL,
  `order_note` text DEFAULT NULL,
  `client_address` text NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_email` varchar(255) DEFAULT NULL,
  `client_phone` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `complete_by_admin` varchar(255) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `booking_date`, `appointment_schedule_id`, `schedule_time_slot`, `client_id`, `influencer_id`, `service_id`, `package_amount`, `additional_amount`, `fees_amount`, `fees`, `coupon_discount`, `total_amount`, `payment_method`, `transection_id`, `payment_status`, `order_status`, `package_features`, `additional_services`, `order_note`, `client_address`, `client_name`, `client_email`, `client_phone`, `created_at`, `updated_at`, `complete_by_admin`) VALUES
(1, '908871305', '18-10-2023', 88, '09:00 AM - 10:00 AM', 5, 1, 11, 18.00, 45.00, 0.00, NULL, 0.00, 63.00, 'Stripe', 'txn_3O2Vt4F56Pb8BOOX0MV9UOeQ', 'success', 'complete', '[\"6 Video Post My Profile\",\"Business Growing\",\"Company Profile Build\",\"Digital Marketing\",\"Duration 5-6Months\",\"30 Social Media Post\",\"\"]', '[{\"id\":1,\"title\":\"Glamour Transformation\",\"price\":\"10.00\",\"features\":[\"10 Social Media Post\",\"Post Views 10K+\",\"Duration 3-4 Days\",\"Digital Marketing\",\"\"]},{\"id\":2,\"title\":\"Personalized Workouts\",\"price\":\"15.00\",\"features\":[\"10 Social Media Post\",\"Post Views 10K+\",\"Duration 3-4 Days\",\"Digital Marketing\",\"\"]},{\"id\":3,\"title\":\"Stylish Workwear Picks\",\"price\":\"20.00\",\"features\":[\"10 Social Media Post\",\"Post Views 10K+\",\"Duration 3-4 Days\",\"Digital Marketing\",\"\"]}]', 'Please hurry up. It&#039;s urgent.', 'Los Angeles, CA, USA', 'John Doe', 'user@gmail.com', '123-343-4444', '2023-10-17 20:18:02', '2023-10-17 20:18:47', 'no'),
(2, '1663486836', '22-10-2023', 85, '09:00 AM - 10:00 AM', 5, 1, 10, 55.00, 22.00, 0.00, NULL, 0.00, 77.00, 'Paypal', 'ZUJKUEUDELUGE', 'success', 'complete', '[\"30 Social Media Post\",\"Duration 5-6Months\",\"Digital Marketing\",\"Company Profile Build\",\"Business Growing\",\"6 Video Post My Profile\",\"\"]', '[{\"id\":4,\"title\":\"Expert Makeup Artists\",\"price\":\"10.00\",\"features\":[\"Digital Marketing\",\"Post Views 10K+\",\"10 Social Media Post\",\"Duration 3-4 Days\",\"\"]},{\"id\":5,\"title\":\"Customized Training\",\"price\":\"12.00\",\"features\":[\"Duration 3-4 Days\",\"10 Social Media Post\",\"Post Views 10K+\",\"Digital Marketing\"]}]', NULL, 'Los Angeles, CA, USA', 'David Richard', 'david@gmail.com', '123-343-4444', '2023-10-17 20:22:16', '2025-01-29 20:23:11', 'Yes'),
(3, '136836286', '10-11-2023', 90, '09:00 AM - 10:00 AM', 5, 1, 10, 55.00, 37.00, 0.00, NULL, 0.00, 92.00, 'Stripe', 'txn_3O2W5OF56Pb8BOOX0j1J0npo', 'success', 'order_decliened_by_influencer', '[\"30 Social Media Post\",\"Duration 5-6Months\",\"Digital Marketing\",\"Company Profile Build\",\"Business Growing\",\"6 Video Post My Profile\",\"\"]', '[{\"id\":4,\"title\":\"Expert Makeup Artists\",\"price\":\"10.00\",\"features\":[\"Digital Marketing\",\"Post Views 10K+\",\"10 Social Media Post\",\"Duration 3-4 Days\",\"\"]},{\"id\":5,\"title\":\"Customized Training\",\"price\":\"12.00\",\"features\":[\"Duration 3-4 Days\",\"10 Social Media Post\",\"Post Views 10K+\",\"Digital Marketing\"]},{\"id\":6,\"title\":\"Electrical Expertise\",\"price\":\"15.00\",\"features\":[\"Digital Marketing\",\"Duration 3-4 Days\",\"10 Social Media Post\",\"Post Views 10K+\"]}]', NULL, 'Los Angeles, CA, USA', 'David Richard', 'user@gmail.com', '123-343-4444', '2023-10-17 20:30:41', '2023-10-17 20:31:08', 'no'),
(4, '1390915649', '30-10-2023', 107, '12:00 PM - 01:00 PM', 5, 1, 9, 25.00, 0.00, 0.00, NULL, 0.00, 25.00, 'Mollie', 'tr_RuWU7jo48W', 'success', 'awaiting_for_influencer_approval', '[\"6 Video Post My Profile\",\"Business Growing\",\"Company Profile Build\",\"Digital Marketing\",\"Duration 5-6Months\",\"30 Social Media Post\",\"\"]', '[]', NULL, 'Los Angeles, CA, USA', 'David Richard', 'david@gmail.com', '123-343-4444', '2023-10-17 20:33:36', '2023-10-17 20:33:36', 'no'),
(5, '180488572', '04-11-2023', 112, '12:00 PM - 01:00 PM', 5, 1, 11, 18.00, 0.00, 0.00, NULL, 0.00, 18.00, 'Razorpay', 'pay_MpcdJA1ZWK8fOd', 'success', 'approved_by_influencer', '[\"6 Video Post My Profile\",\"Business Growing\",\"Company Profile Build\",\"Digital Marketing\",\"Duration 5-6Months\",\"30 Social Media Post\",\"\"]', '[]', NULL, 'Los Angeles, CA, USA', 'John Doe', 'user@gmail.com', '123-343-4444', '2023-10-17 20:35:14', '2023-10-17 20:35:34', 'no'),
(6, '1126303098', '10-11-2023', 97, '10:00 AM - 11:00 AM', 5, 1, 10, 55.00, 25.00, 0.00, NULL, 8.00, 80.00, 'Stripe', 'txn_3O2WBfF56Pb8BOOX186nPkWG', 'success', 'complete', '[\"30 Social Media Post\",\"Duration 5-6Months\",\"Digital Marketing\",\"Company Profile Build\",\"Business Growing\",\"6 Video Post My Profile\",\"\"]', '[{\"id\":4,\"title\":\"Expert Makeup Artists\",\"price\":\"10.00\",\"features\":[\"Digital Marketing\",\"Post Views 10K+\",\"10 Social Media Post\",\"Duration 3-4 Days\",\"\"]},{\"id\":6,\"title\":\"Electrical Expertise\",\"price\":\"15.00\",\"features\":[\"Digital Marketing\",\"Duration 3-4 Days\",\"10 Social Media Post\",\"Post Views 10K+\"]}]', NULL, 'Los Angeles, CA, USA', 'David Richard', 'user@gmail.com', '123-343-4444', '2023-10-17 20:37:10', '2023-11-01 00:05:30', 'no'),
(7, '1001711247', '21-10-2023', 91, '09:00 AM - 10:00 AM', 5, 1, 9, 25.00, 0.00, 0.00, NULL, 0.00, 25.00, 'Stripe', 'txn_3O2WE9F56Pb8BOOX1aMJ5Qv6', 'success', 'awaiting_for_influencer_approval', '[\"6 Video Post My Profile\",\"Business Growing\",\"Company Profile Build\",\"Digital Marketing\",\"Duration 5-6Months\",\"30 Social Media Post\",\"\"]', '[]', NULL, 'Los Angeles, CA, USA', 'David Richard', 'dacian@florindedu.ro', '123-343-4444', '2023-10-17 20:39:44', '2023-10-17 20:39:44', 'no'),
(8, '1408078198', '15-11-2023', 18, '11:00 AM - 12:00 PM', 5, 2, 4, 9.99, 0.00, 0.00, NULL, 0.00, 9.99, 'Stripe', 'txn_3O7dstF56Pb8BOOX1TDimulA', 'success', 'awaiting_for_influencer_approval', '[\"30 Social Media Post\",\"Duration 5-6Months\",\"Digital Marketing\",\"Company Profile Build\",\"Business Growing\",\"6 Video Post My Profile\",\"\"]', '[]', NULL, 'dfgdfg', 'dsfsdf', 'sdfs@gmail.com', '345345345', '2023-10-31 23:50:59', '2023-10-31 23:50:59', 'no'),
(9, '1028032641', '22-11-2023', 117, '02:00 PM - 03:00 PM', 5, 1, 10, 55.00, 37.00, 0.00, NULL, 0.00, 92.00, 'Bank Payment', 'sadasdasdasdas', 'pending', 'awaiting_for_influencer_approval', '[\"30 Social Media Post\",\"Duration 5-6Months\",\"Digital Marketing\",\"Company Profile Build\",\"Business Growing\",\"6 Video Post My Profile\",\"\"]', '[{\"id\":4,\"title\":\"Expert Makeup Artists\",\"price\":\"10.00\",\"features\":[\"Digital Marketing\",\"Post Views 10K+\",\"10 Social Media Post\",\"Duration 3-4 Days\",\"\"]},{\"id\":5,\"title\":\"Customized Training\",\"price\":\"12.00\",\"features\":[\"Duration 3-4 Days\",\"10 Social Media Post\",\"Post Views 10K+\",\"Digital Marketing\"]},{\"id\":6,\"title\":\"Electrical Expertise\",\"price\":\"15.00\",\"features\":[\"Digital Marketing\",\"Duration 3-4 Days\",\"10 Social Media Post\",\"Post Views 10K+\"]}]', 'dasda dasdasdasdsdd dasdasdasdsdas', 'sdadsads asdsadsda sadadadasdas', 'sadasdad', 'asdasda@sadasdasd.com', '234543232', '2023-11-01 00:14:12', '2023-11-01 00:14:12', 'no'),
(10, '244370761', '09-12-2023', 7, '09:00 AM - 10:00 AM', 5, 2, 5, 14.99, 0.00, 0.00, NULL, 0.00, 14.99, 'Stripe', 'txn_3O7glFF56Pb8BOOX0HIWjGus', 'success', 'awaiting_for_influencer_approval', '[\"Strong man the training black man\",\"Business Growing\",\"Company Profile Build\",\"Digital Marketing\",\"Duration 5-6Months\",\"30 Social Media Post\",\"\"]', '[]', 'client@gmail.com', 'client@gmail.com', 'client@gmail.com', 'client@gmail.com', '98765 43211', '2023-11-01 02:55:17', '2023-11-01 02:55:17', 'no'),
(11, '513142827', '09-12-2023', 7, '09:00 AM - 10:00 AM', 5, 2, 5, 14.99, 0.00, 0.00, NULL, 0.00, 14.99, 'Stripe', 'txn_3O7glGF56Pb8BOOX0DRaDc3d', 'success', 'awaiting_for_influencer_approval', '[\"Strong man the training black man\",\"Business Growing\",\"Company Profile Build\",\"Digital Marketing\",\"Duration 5-6Months\",\"30 Social Media Post\",\"\"]', '[]', 'client@gmail.com', 'client@gmail.com', 'client@gmail.com', 'client@gmail.com', '98765 43211', '2023-11-01 02:55:18', '2023-11-01 02:55:18', 'no'),
(12, '1001475219', '29-01-2024', 2, '09:00 AM - 10:00 AM', 5, 2, 5, 14.99, 0.00, 0.00, NULL, 0.00, 14.99, 'Bank Payment', 'Bank Name: Your bank name\r\nAccount Number: Your bank account number\r\nRouting Number: Your bank routing number\r\nBranch: Your bank branch name', 'pending', 'awaiting_for_influencer_approval', '[\"Strong man the training black man\",\"Business Growing\",\"Company Profile Build\",\"Digital Marketing\",\"Duration 5-6Months\",\"30 Social Media Post\",\"\"]', '[]', 'adadwdWrite NoteWrite NoteWrite NoteWrite NoteWrite NoteWrite NoteWrite Note', 'xdasd', 'dwww', 'ww@ddd.a', '123131313', '2023-11-01 05:40:39', '2023-11-01 05:40:39', 'no'),
(13, '60797713', '29-01-2024', 2, '09:00 AM - 10:00 AM', 5, 2, 5, 14.99, 0.00, 0.00, NULL, 0.00, 14.99, 'Bank Payment', 'eee', 'pending', 'awaiting_for_influencer_approval', '[\"Strong man the training black man\",\"Business Growing\",\"Company Profile Build\",\"Digital Marketing\",\"Duration 5-6Months\",\"30 Social Media Post\",\"\"]', '[]', 'adadwdWrite NoteWrite NoteWrite NoteWrite NoteWrite NoteWrite NoteWrite Note', 'xdasd', 'dwww', 'ww@ddd.a', '123131313', '2023-11-01 05:42:38', '2023-11-01 05:42:38', 'no'),
(14, '1594599589', '29-01-2024', 2, '09:00 AM - 10:00 AM', 5, 2, 5, 14.99, 0.00, 0.00, NULL, 0.00, 14.99, 'Stripe', 'txn_3O7jOoF56Pb8BOOX0AJT5ssG', 'success', 'awaiting_for_influencer_approval', '[\"Strong man the training black man\",\"Business Growing\",\"Company Profile Build\",\"Digital Marketing\",\"Duration 5-6Months\",\"30 Social Media Post\",\"\"]', '[]', 'adadwdWrite NoteWrite NoteWrite NoteWrite NoteWrite NoteWrite NoteWrite Note', 'xdasd', 'dwww', 'ww@ddd.a', '123131313', '2023-11-01 05:44:19', '2023-11-01 05:44:19', 'no'),
(15, '983876444', '21-11-2023', 94, '10:00 AM - 11:00 AM', 5, 1, 11, 18.00, 0.00, 0.00, NULL, 0.00, 18.00, 'Paypal', 'ZUJKUEUDELUGE', 'success', 'awaiting_for_influencer_approval', '[\"6 Video Post My Profile\",\"Business Growing\",\"Company Profile Build\",\"Digital Marketing\",\"Duration 5-6Months\",\"30 Social Media Post\",\"\"]', '[]', NULL, 'Los Angeles, CA, USA', 'John Doe', 'user@gmail.com', '123-874-6548', '2023-11-20 02:58:24', '2023-11-20 02:58:24', 'no'),
(16, '1636444433', '21-11-2023', 94, '10:00 AM - 11:00 AM', 5, 1, 11, 18.00, 0.00, 0.00, NULL, 0.00, 18.00, 'Stripe', 'txn_3OEaugF56Pb8BOOX1qzGrJmY', 'success', 'awaiting_for_influencer_approval', '[\"6 Video Post My Profile\",\"Business Growing\",\"Company Profile Build\",\"Digital Marketing\",\"Duration 5-6Months\",\"30 Social Media Post\",\"\"]', '[]', NULL, 'Los Angeles, CA, USA', 'John Doe', 'user@gmail.com', '123-874-6548', '2023-11-20 03:05:38', '2023-11-20 03:05:38', 'no'),
(17, '836249035', '21-11-2023', 94, '10:00 AM - 11:00 AM', 5, 1, 11, 18.00, 0.00, 0.00, NULL, 0.00, 18.00, 'Razorpay', 'pay_N2o4JPh6vukX52', 'success', 'awaiting_for_influencer_approval', '[\"6 Video Post My Profile\",\"Business Growing\",\"Company Profile Build\",\"Digital Marketing\",\"Duration 5-6Months\",\"30 Social Media Post\",\"\"]', '[]', NULL, 'Los Angeles, CA, USA', 'John Doe', 'user@gmail.com', '123-874-6548', '2023-11-20 03:13:28', '2023-11-20 03:13:28', 'no'),
(18, '1137686003', '21-11-2023', 94, '10:00 AM - 11:00 AM', 5, 1, 11, 18.00, 0.00, 0.00, NULL, 0.00, 18.00, 'Razorpay', 'pay_N2o5vfWmHpyI5A', 'success', 'awaiting_for_influencer_approval', '[\"6 Video Post My Profile\",\"Business Growing\",\"Company Profile Build\",\"Digital Marketing\",\"Duration 5-6Months\",\"30 Social Media Post\",\"\"]', '[]', NULL, 'Los Angeles, CA, USA', 'John Doe', 'user@gmail.com', '123-874-6548', '2023-11-20 03:15:00', '2023-11-20 03:15:00', 'no'),
(19, '952201510', '05-12-2023', 108, '12:00 PM - 01:00 PM', 5, 1, 10, 55.00, 0.00, 0.00, NULL, 0.00, 55.00, 'Razorpay', 'pay_N2o7tiP37OWDd9', 'success', 'awaiting_for_influencer_approval', '[\"30 Social Media Post\",\"Duration 5-6Months\",\"Digital Marketing\",\"Company Profile Build\",\"Business Growing\",\"6 Video Post My Profile\",\"\"]', '[]', NULL, 'Barguna', 'John Doe', 'user@gmail.com', '123-343-4444', '2023-11-20 03:16:50', '2023-11-20 03:16:50', 'no'),
(20, '1497227294', '05-12-2023', 108, '12:00 PM - 01:00 PM', 5, 1, 10, 55.00, 0.00, 0.00, NULL, 0.00, 55.00, 'Flutterwave', '4735485', 'success', 'awaiting_for_influencer_approval', '[\"30 Social Media Post\",\"Duration 5-6Months\",\"Digital Marketing\",\"Company Profile Build\",\"Business Growing\",\"6 Video Post My Profile\",\"\"]', '[]', NULL, 'Barguna', 'John Doe', 'user@gmail.com', '123-343-4444', '2023-11-20 03:26:43', '2023-11-20 03:26:43', 'no'),
(21, '712390469', '04-12-2023', 100, '11:00 AM - 12:00 PM', 5, 1, 11, 18.00, 0.00, 0.00, NULL, 0.00, 18.00, 'Mollie', 'tr_XDjvtTa3ZP', 'success', 'awaiting_for_influencer_approval', '[\"6 Video Post My Profile\",\"Business Growing\",\"Company Profile Build\",\"Digital Marketing\",\"Duration 5-6Months\",\"30 Social Media Post\",\"\"]', '[]', NULL, 'Los Angeles, CA, USA', 'David Richard', 'user@gmail.com', '123-343-4444', '2023-11-23 01:39:42', '2023-11-23 01:39:42', 'no'),
(22, '1098875036', '04-12-2023', 100, '11:00 AM - 12:00 PM', 5, 1, 11, 18.00, 0.00, 0.00, NULL, 0.00, 18.00, 'Instamojo', 'MOJO3b23P05A74649398', 'success', 'awaiting_for_influencer_approval', '[\"6 Video Post My Profile\",\"Business Growing\",\"Company Profile Build\",\"Digital Marketing\",\"Duration 5-6Months\",\"30 Social Media Post\",\"\"]', '[]', NULL, 'Los Angeles, CA, USA', 'David Richard', 'user@gmail.com', '123-343-4444', '2023-11-23 01:51:50', '2023-11-23 01:51:50', 'no'),
(23, '1259681182', '05-12-2023', 101, '11:00 AM - 12:00 PM', 5, 1, 11, 18.00, 0.00, 0.00, NULL, 0.00, 18.00, 'Grab Pay', 'pay_HnQ6L4DnYPPs4uyCGeaxfoz3', 'success', 'awaiting_for_influencer_approval', '[\"6 Video Post My Profile\",\"Business Growing\",\"Company Profile Build\",\"Digital Marketing\",\"Duration 5-6Months\",\"30 Social Media Post\",\"\"]', '[]', NULL, 'Los Angeles, CA, USA', 'John Doe', 'user@gmail.com', '123-343-4444', '2023-11-28 01:01:02', '2023-11-28 01:01:02', 'no'),
(24, '13775715', '07-12-2023', 103, '11:00 AM - 12:00 PM', 5, 1, 11, 18.00, 0.00, 0.00, NULL, 0.00, 18.00, 'GCash', 'pay_Qf7EbuPQyBLysEmddmjgFTLu', 'success', 'awaiting_for_influencer_approval', '[\"6 Video Post My Profile\",\"Business Growing\",\"Company Profile Build\",\"Digital Marketing\",\"Duration 5-6Months\",\"30 Social Media Post\",\"\"]', '[]', NULL, 'Los Angeles, CA, USA', 'David Richard', 'agent@gmail.com', '123-343-4444', '2023-11-28 01:03:30', '2023-11-28 01:03:30', 'no'),
(25, '270387355', '06-12-2023', 117, '02:00 PM - 03:00 PM', 5, 1, 9, 25.00, 0.00, 0.00, NULL, 0.00, 25.00, 'Paymongo', 'pi_FuiJPTrCsmT5ceqwVAhyc4SD', 'success', 'awaiting_for_influencer_approval', '[\"6 Video Post My Profile\",\"Business Growing\",\"Company Profile Build\",\"Digital Marketing\",\"Duration 5-6Months\",\"30 Social Media Post\",\"\"]', '[]', NULL, 'California, USA', 'David Richard', 'admin@gmail.com', '123-874-6548', '2023-11-28 01:07:03', '2023-11-28 01:07:03', 'no'),
(26, '342361794', '06-12-2023', 46, '11:00 AM - 12:00 PM', 5, 3, 7, 18.00, 0.00, 0.00, NULL, 0.00, 18.00, 'Iyzico', '21274846', 'success', 'awaiting_for_influencer_approval', '[\"6 Video Post My Profile\",\"Business Growing\",\"Company Profile Build\",\"Business Growing\",\"Company Profile Build\",\"6 Video Post My Profile\",\"\"]', '[]', NULL, 'Los Angeles, CA, USA', 'John Doe', 'user@gmail.com', '123-343-4444', '2023-11-28 01:10:03', '2023-11-28 01:10:03', 'no'),
(27, '1494729169', '02-06-2024', 128, '10:00 AM - 11:00 AM', 5, 1, 11, 50.00, 25.00, 0.00, NULL, 3.75, 75.00, 'Stripe', 'txn_3PNA5MF56Pb8BOOX06YRMTFM', 'success', 'awaiting_for_influencer_approval', '[\"6 Video Post My Profile\",\"Business Growing\",\"Company Profile Build\",\"Digital Marketing\",\"Duration 5-6Months\",\"30 Social Media Post\",\"\"]', '[{\"id\":1,\"title\":\"Glamour Transformation\",\"price\":\"10.00\",\"features\":[\"10 Social Media Post\",\"Post Views 10K+\",\"Duration 3-4 Days\",\"Digital Marketing\",\"\"]},{\"id\":2,\"title\":\"Personalized Workouts\",\"price\":\"15.00\",\"features\":[\"10 Social Media Post\",\"Post Views 10K+\",\"Duration 3-4 Days\",\"Digital Marketing\",\"\"]}]', NULL, 'Jackson Heights, 11372, NY, United States', 'Ibrahim Khalil', 'aboutkhalil.83@gmail.com', '125-985-4587', '2024-06-01 19:48:20', '2024-06-01 19:48:20', 'no'),
(28, '1108290548', '05-02-2025', 102, '11:00 AM - 12:00 PM', 1, 1, 13, 29.00, 0.00, 0.00, NULL, 1.45, 29.00, 'Stripe', 'txn_3Qoi0qE3HCOEW1L00RN9Zkj1', 'success', 'order_decliened_by_influencer', '[\"xcbxcbxcbxc\",\"xcvbxcbxcbxcb\",\"xbcxbcxbxcbx\",\"xcxbxcbxcb\",\"\"]', '[]', 'vxzcvxxc', 'Banassare', 'Kazi Omar Faruk', 'kaziomar.bdcalling@gmail.com', '01701029783', '2025-02-04 09:01:41', '2025-02-04 09:05:05', 'no'),
(29, '920309008', '05-02-2025', 109, '12:00 PM - 01:00 PM', 5, 1, 13, 29.00, 0.00, 0.00, NULL, 0.00, 29.00, 'Stripe', 'txn_3Qoi2UE3HCOEW1L00zQimUeW', 'success', 'approved_by_influencer', '[\"xcbxcbxcbxc\",\"xcvbxcbxcbxcb\",\"xbcxbcxbxcbx\",\"xcxbxcbxcb\",\"\"]', '[]', 'fgdfsgdsfg', 'Banassare', 'Kazi Omar Faruk', 'kaziomar.bdcalling@gmail.com', '01701029783', '2025-02-04 09:03:24', '2025-02-04 09:05:22', 'no'),
(30, '1318284079', '05-02-2025', 117, '02:00 PM - 03:00 PM', 5, 1, 11, 18.00, 0.00, 0.00, NULL, 0.90, 18.00, 'Stripe', 'txn_3Qol2HCe4QqAuKX409ZJMzRH', 'success', 'awaiting_for_influencer_approval', '[\"6 Video Post My Profile\",\"Business Growing\",\"Company Profile Build\",\"Digital Marketing\",\"Duration 5-6Months\",\"30 Social Media Post\",\"\"]', '[]', 'sfsfasf', 'Banassare', 'Kazi Omar Faruk', 'kaziomar.bdcalling@gmail.com', '01701029783', '2025-02-04 12:15:22', '2025-02-04 12:15:22', 'no'),
(31, '754199550', '05-02-2025', 95, '10:00 AM - 11:00 AM', 5, 1, 13, 29.00, 0.00, 0.00, NULL, 0.00, 29.00, 'Stripe', 'txn_3QolNOE3HCOEW1L00lXw9mJk', 'success', 'complete', '[\"xcbxcbxcbxc\",\"xcvbxcbxcbxcb\",\"xbcxbcxbxcbx\",\"xcxbxcbxcb\",\"\"]', '[]', 'gdsfgdsfg', 'Banassare', 'Kazi Omar Faruk', 'kaziomar.bdcalling@gmail.com', '01701029783', '2025-02-04 12:37:11', '2025-02-04 13:01:50', 'Yes'),
(32, '1318497400', '05-02-2025', 124, '03:00 PM - 04:00 PM', 5, 1, 10, 55.00, 0.00, 0.00, NULL, 0.00, 55.00, 'Stripe', 'txn_3QolUoE3HCOEW1L00fuevH9k', 'success', 'complete', '[\"30 Social Media Post\",\"Duration 5-6Months\",\"Digital Marketing\",\"Company Profile Build\",\"Business Growing\",\"6 Video Post My Profile\",\"\"]', '[]', 'sdfsdgsadgsag', 'Banassare', 'asfsafsadf', 'kaziomar.bdcalling22@gmail.com', '01701029783', '2025-02-04 12:44:52', '2025-02-04 12:54:58', 'no'),
(33, '1540871414', '07-02-2025', 134, '10:30 AM - 12:30 PM', 5, 21, 12, 225.00, 0.00, 0.00, NULL, 0.00, 225.00, 'Stripe', 'txn_3Qom3PBR2bUrg2dg1qrjT7Wi', 'success', 'complete', '[\"fsdfdsf\",\"sfsdfdsf\",\"\"]', '[]', 'asdasd', 'Banassare', 'Kazi Omar Farukfdds', 'kaziomar.bdcalling@gmail.com', '01701029783', '2025-02-04 13:20:36', '2025-02-04 13:23:06', 'no'),
(34, '1365327802', '06-02-2025', 133, '10:30 AM - 12:30 PM', 5, 21, 12, 225.00, 0.00, 0.00, NULL, 0.00, 225.00, 'Stripe', 'txn_3QozNYBR2bUrg2dg0Vcgo9Z6', 'success', 'order_decliened_by_client', '[\"fsdfdsf\",\"sfsdfdsf\",\"\"]', '[]', 'sdfsdfsdfsdfsdfsdfsdf', 'Banassare', 'sfsdfsdfsdfsdf', 'kaziomar.bdcalling@gmail.com', '01701029783', '2025-02-05 03:34:16', '2025-02-05 03:38:19', 'no'),
(35, '133033348', '11-02-2025', 131, '10:30 AM - 12:30 PM', 5, 21, 12, 225.00, 0.00, 0.00, NULL, 0.00, 225.00, 'Stripe', 'txn_3QozxwBR2bUrg2dg0fk2Xw0T', 'success', 'complete', '[\"fsdfdsf\",\"sfsdfdsf\",\"\"]', '[]', 'sfsfsf', 'Banassare', 'sfsdfsdf', 'kaziomar.bdcalling@gmail.com', '01701029783', '2025-02-05 04:11:51', '2025-02-05 04:12:59', 'no'),
(36, '4223202', '09-02-2025', 129, '10:30 AM - 12:30 PM', 24, 21, 12, 225.00, 0.00, 0.00, NULL, 0.00, 225.00, 'Stripe', 'txn_3Qp0buBR2bUrg2dg1UbSuv4w', 'success', 'complete', '[\"fsdfdsf\",\"sfsdfdsf\",\"\"]', '[]', 'asfsadf', 'Banassare', 'User', 'asdfgsafsaf', '01701029783', '2025-02-05 04:53:10', '2025-02-05 04:57:07', 'Yes'),
(37, '287912177', '12-02-2025', 132, '10:30 AM - 12:30 PM', 24, 21, 12, 225.00, 0.00, 0.00, NULL, 0.00, 225.00, 'Stripe', 'txn_3Qp1WUBR2bUrg2dg15t7kXRL', 'success', 'awaiting_for_influencer_approval', '[\"fsdfdsf\",\"sfsdfdsf\",\"\"]', '[]', 'sdfsfdsfs', 'fsdfsdf', 'sdfsdf', 'fsfsf', '345435', '2025-02-05 05:51:38', '2025-02-05 05:51:38', 'no'),
(38, '683561447', '10-02-2025', 130, '10:30 AM - 12:30 PM', 24, 21, 12, 225.00, 0.00, 0.00, NULL, 12.38, 247.50, 'Stripe', 'txn_3QpR3jBR2bUrg2dg1tx6d6ko', 'success', 'awaiting_for_influencer_approval', '[\"fsdfdsf\",\"sfsdfdsf\",\"\"]', '[]', NULL, 'Banassare', 'User', 'user@gmail.com', '01701029783', '2025-02-06 09:07:36', '2025-02-06 09:07:36', 'no'),
(39, '1459080363', '10-02-2025', 86, '09:00 AM - 10:00 AM', 24, 1, 10, 55.00, 37.00, 0.00, NULL, 0.00, 101.20, 'Stripe', 'txn_3QpR8IBR2bUrg2dg1JJ3rNJ7', 'success', 'awaiting_for_influencer_approval', '[\"30 Social Media Post\",\"Duration 5-6Months\",\"Digital Marketing\",\"Company Profile Build\",\"Business Growing\",\"6 Video Post My Profile\",\"\"]', '[{\"id\":4,\"title\":\"Expert Makeup Artists\",\"price\":\"10.00\",\"features\":[\"Digital Marketing\",\"Post Views 10K+\",\"10 Social Media Post\",\"Duration 3-4 Days\",\"\"]},{\"id\":5,\"title\":\"Customized Training\",\"price\":\"12.00\",\"features\":[\"Duration 3-4 Days\",\"10 Social Media Post\",\"Post Views 10K+\",\"Digital Marketing\"]},{\"id\":6,\"title\":\"Electrical Expertise\",\"price\":\"15.00\",\"features\":[\"Digital Marketing\",\"Duration 3-4 Days\",\"10 Social Media Post\",\"Post Views 10K+\"]}]', NULL, 'Banassare', 'User', 'user@gmail.com', '01701029783', '2025-02-06 09:12:19', '2025-02-06 09:12:19', 'no'),
(40, '251224872', '25-02-2025', 131, '10:30 AM - 12:30 PM', 24, 21, 12, 225.00, 0.00, 22.50, '{\"fees_type\":\"percentage\",\"fees\":\"10\"}', 0.00, 247.50, 'Stripe', 'txn_3QpRz0BR2bUrg2dg0vM17Xda', 'success', 'awaiting_for_influencer_approval', '[\"fsdfdsf\",\"sfsdfdsf\",\"\"]', '[]', NULL, 'Banassare', 'User', 'user@gmail.com', '01701029783', '2025-02-06 10:06:47', '2025-02-06 10:06:47', 'no'),
(41, '354235290', '14-02-2025', 134, '10:30 AM - 12:30 PM', 24, 21, 12, 225.00, 0.00, 22.50, '{\"fees_type\":\"percentage\",\"fees\":\"10\"}', 0.00, 247.50, 'Stripe', 'txn_3QrvLlBR2bUrg2dg2kGSzqfR', 'success', 'awaiting_for_influencer_approval', '[\"fsdfdsf\",\"sfsdfdsf\",\"\"]', '[]', NULL, 'Banassare', 'User', 'user@gmail.com', '01701029783', '2025-02-13 05:52:37', '2025-02-13 05:52:37', 'no'),
(42, '857161996', '17-02-2025', 130, '10:30 AM - 12:30 PM', 24, 21, 12, 225.00, 0.00, 22.50, '{\"fees_type\":\"percentage\",\"fees\":\"10\"}', 0.00, 247.50, 'Stripe', 'txn_3QrvNHBR2bUrg2dg09lRu2cB', 'success', 'awaiting_for_influencer_approval', '[\"fsdfdsf\",\"sfsdfdsf\",\"\"]', '[]', NULL, 'Banassare', 'User', 'user@gmail.com', '01701029783', '2025-02-13 05:54:11', '2025-02-13 05:54:11', 'no'),
(43, '514191476', '18-02-2025', 131, '10:30 AM - 12:30 PM', 24, 21, 12, 225.00, 0.00, 22.50, '{\"fees_type\":\"percentage\",\"fees\":\"10\"}', 0.00, 247.50, 'Stripe', 'txn_3Qrz1jBR2bUrg2dg2wBFMsvd', 'success', 'awaiting_for_influencer_approval', '[\"fsdfdsf\",\"sfsdfdsf\",\"\"]', '[]', NULL, 'Banassare', 'User', 'user@gmail.com', '01701029783', '2025-02-13 09:48:10', '2025-02-13 09:48:10', 'no'),
(44, '936341586', '19-02-2025', 132, '10:30 AM - 12:30 PM', 24, 21, 12, 225.00, 0.00, 22.50, '{\"fees_type\":\"percentage\",\"fees\":\"10\"}', 0.00, 247.50, 'Stripe', 'txn_3Qrz3IBR2bUrg2dg1p5hKqtc', 'success', 'awaiting_for_influencer_approval', '[\"fsdfdsf\",\"sfsdfdsf\",\"\"]', '[]', NULL, 'Banassare', 'User', 'user@gmail.com', '01701029783', '2025-02-13 09:49:47', '2025-02-13 09:49:47', 'no'),
(45, '1012563099', '27-02-2025', 133, '10:30 AM - 12:30 PM', 24, 21, 12, 225.00, 0.00, 22.50, '{\"fees_type\":\"percentage\",\"fees\":\"10\"}', 0.00, 247.50, 'Stripe', 'txn_3Qrz5YBR2bUrg2dg1NGGlJH8', 'success', 'awaiting_for_influencer_approval', '[\"fsdfdsf\",\"sfsdfdsf\",\"\"]', '[]', NULL, 'Banassare', 'User', 'user@gmail.com', '01701029783', '2025-02-13 09:52:08', '2025-02-13 09:52:08', 'no'),
(46, '667922151', '19-02-2025', 139, '10:30 AM - 12:30 PM', 24, 26, 22, 29.00, 0.00, 2.90, '{\"fees_type\":\"percentage\",\"fees\":\"10\"}', 0.00, 31.90, 'Stripe', 'txn_3QtmHTBR2bUrg2dg1Poe4Yp6', 'success', 'awaiting_for_influencer_approval', '[\"\"]', '[]', NULL, 'Banassare', 'User', 'user@gmail.com', '01701029783', '2025-02-18 08:35:54', '2025-02-18 08:35:54', 'no'),
(47, '1097058492', '19-02-2025', 95, '10:00 AM - 11:00 AM', 24, 1, 10, 55.00, 27.00, 8.20, '{\"fees_type\":\"percentage\",\"fees\":\"10\"}', 0.00, 90.20, 'Stripe', 'txn_3Qtq7aBR2bUrg2dg13tONKSr', 'success', 'awaiting_for_influencer_approval', '[\"30 Social Media Post\",\"Duration 5-6Months\",\"Digital Marketing\",\"Company Profile Build\",\"Business Growing\",\"6 Video Post My Profile\",\"\"]', '[{\"id\":5,\"title\":\"Customized Training\",\"price\":\"12.00\",\"features\":[\"Duration 3-4 Days\",\"10 Social Media Post\",\"Post Views 10K+\",\"Digital Marketing\"]},{\"id\":6,\"title\":\"Electrical Expertise\",\"price\":\"15.00\",\"features\":[\"Digital Marketing\",\"Duration 3-4 Days\",\"10 Social Media Post\",\"Post Views 10K+\"]}]', NULL, 'Banassare', 'User', 'user@gmail.com', '01701029783', '2025-02-18 12:41:54', '2025-02-18 12:41:54', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `our_features`
--

CREATE TABLE `our_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon1` varchar(255) NOT NULL,
  `icon2` varchar(255) NOT NULL,
  `icon3` varchar(255) NOT NULL,
  `icon4` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `our_features`
--

INSERT INTO `our_features` (`id`, `icon1`, `icon2`, `icon3`, `icon4`, `created_at`, `updated_at`) VALUES
(1, 'uploads/website-images/our-feature1-2023-10-16-02-13-11-6279.svg', 'uploads/website-images/our-feature2-2023-10-16-02-13-35-2109.svg', 'uploads/website-images/our-feature3-2023-10-16-02-14-45-9471.svg', 'uploads/website-images/our-feature3-2023-10-16-02-14-59-7866.svg', NULL, '2023-10-15 20:14:59');

-- --------------------------------------------------------

--
-- Table structure for table `our_feature_translations`
--

CREATE TABLE `our_feature_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `our_feature_id` int(11) NOT NULL,
  `title1` varchar(255) NOT NULL,
  `title2` varchar(255) NOT NULL,
  `title3` varchar(255) NOT NULL,
  `title4` varchar(255) NOT NULL,
  `description1` text NOT NULL,
  `description2` text NOT NULL,
  `description3` text NOT NULL,
  `description4` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `our_feature_translations`
--

INSERT INTO `our_feature_translations` (`id`, `lang_code`, `our_feature_id`, `title1`, `title2`, `title3`, `title4`, `description1`, `description2`, `description3`, `description4`, `created_at`, `updated_at`) VALUES
(1, 'en', 1, 'No upfront Cost', 'Verified Creators', 'Live Chat', 'Safe Camping', 'Nulla eget metus mauris. Sed in ips um mollis, sagittis ligula.', 'Nulla eget metus mauris. Sed in ips um mollis, sagittis ligula.', 'Nulla eget metus mauris. Sed in ips um mollis, sagittis ligula.', 'Nulla eget metus mauris. Sed in ips um mollis, sagittis ligula.', NULL, '2023-08-30 02:23:46'),
(18, 'ar', 1, 'لا توجد تكلفة مقدمة', 'منشئو المحتوى الذين تم التحقق منهم', 'دردشة مباشرة', 'التخييم الآمن', 'Nulla eget metus mauris. Sed in ips um mollis, sagittis ligula.', 'Nulla eget metus mauris. Sed in ips um mollis, sagittis ligula.', 'Nulla eget metus mauris. Sed in ips um mollis, sagittis ligula.', 'Nulla eget metus mauris. Sed in ips um mollis, sagittis ligula.', '2023-10-17 23:04:37', '2023-10-18 15:08:22');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) NOT NULL,
  `link` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `logo`, `link`, `created_at`, `updated_at`) VALUES
(1, 'uploads/custom-images/our-partner-2023-10-16-02-58-50-2560.svg', NULL, '2023-10-15 20:58:50', '2023-10-15 20:58:50'),
(2, 'uploads/custom-images/our-partner-2023-10-16-02-59-11-3955.svg', NULL, '2023-10-15 20:59:11', '2023-10-15 20:59:11'),
(3, 'uploads/custom-images/our-partner-2023-10-16-02-59-57-3155.svg', NULL, '2023-10-15 20:59:57', '2023-10-15 20:59:57'),
(4, 'uploads/custom-images/our-partner-2023-10-16-03-00-18-7987.svg', NULL, '2023-10-15 21:00:18', '2023-10-15 21:00:18'),
(5, 'uploads/custom-images/our-partner-2023-10-16-03-00-49-2205.svg', NULL, '2023-10-15 21:00:49', '2023-10-15 21:00:49'),
(6, 'uploads/custom-images/our-partner-2023-10-16-03-01-09-9809.svg', NULL, '2023-10-15 21:01:09', '2023-10-15 21:01:09'),
(7, 'uploads/custom-images/our-partner-2023-10-16-03-01-37-4721.svg', NULL, '2023-10-15 21:01:37', '2023-10-15 21:01:37'),
(8, 'uploads/custom-images/our-partner-2023-10-16-03-01-52-9598.svg', NULL, '2023-10-15 21:01:52', '2023-10-15 21:01:52'),
(9, 'uploads/custom-images/our-partner-2023-10-16-03-02-07-4470.svg', NULL, '2023-10-15 21:02:07', '2023-10-15 21:02:07');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('client@gmail.com', '$2y$10$2CsKFrogomPge4bSgdC53em5VTOUY8LqtE0JMPZLCNOIhaEsFzwBu', '2023-09-16 04:51:57');

-- --------------------------------------------------------

--
-- Table structure for table `paymongo_payments`
--

CREATE TABLE `paymongo_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency_id` int(11) NOT NULL DEFAULT 0,
  `secret_key` text NOT NULL,
  `public_key` text NOT NULL,
  `webhook_sig` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `paymongo_image` varchar(255) DEFAULT NULL,
  `grabpay_image` varchar(255) DEFAULT NULL,
  `gcash_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paymongo_payments`
--

INSERT INTO `paymongo_payments` (`id`, `currency_id`, `secret_key`, `public_key`, `webhook_sig`, `status`, `paymongo_image`, `grabpay_image`, `gcash_image`, `created_at`, `updated_at`) VALUES
(1, 5, 'sk_test_jDBKcdignnLfJHFAoiKCjr7w', 'pk_test_rnFk6YzY3rzHtsVUh2GHXznv', 'hook_RtrC6XKHLJMzQjNVemY9vTk3', 1, 'uploads/website-images/paymongo-2024-02-07-08-46-57-7039.jpg', 'uploads/website-images/paymongo-2024-02-07-08-49-05-5373.png', 'uploads/website-images/paymongo-2024-02-07-08-49-57-5848.png', '2023-11-20 01:54:56', '2024-02-07 14:49:57');

-- --------------------------------------------------------

--
-- Table structure for table `paypal_payments`
--

CREATE TABLE `paypal_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `account_mode` varchar(255) DEFAULT NULL,
  `client_id` text DEFAULT NULL,
  `secret_id` text DEFAULT NULL,
  `country_code` varchar(191) NOT NULL,
  `currency_code` varchar(191) NOT NULL,
  `currency_rate` double NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paypal_payments`
--

INSERT INTO `paypal_payments` (`id`, `status`, `account_mode`, `client_id`, `secret_id`, `country_code`, `currency_code`, `currency_rate`, `image`, `created_at`, `updated_at`, `currency_id`) VALUES
(1, 0, 'sandbox', 'AWlV5x8Lhj9BRF8-TnawXtbNs-zt69mMVXME1BGJUIoDdrAYz8QIeeTBQp0sc2nIL9E529KJZys32Ipy', 'EEvn1J_oIC6alxb-FoF4t8buKwy4uEWHJ4_Jd_wolaSPRMzFHe6GrMrliZAtawDDuE-WKkCKpWGiz0Yn', 'US', 'USD', 1, 'uploads/website-images/paypal-2023-09-28-08-40-29-2874.png', NULL, '2025-02-18 09:10:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `paystack_and_mollies`
--

CREATE TABLE `paystack_and_mollies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mollie_key` varchar(255) DEFAULT NULL,
  `mollie_status` int(11) NOT NULL DEFAULT 0,
  `mollie_currency_rate` double NOT NULL DEFAULT 1,
  `paystack_public_key` varchar(255) DEFAULT NULL,
  `paystack_secret_key` varchar(255) DEFAULT NULL,
  `paystack_currency_rate` double NOT NULL DEFAULT 1,
  `paystack_status` int(11) NOT NULL DEFAULT 0,
  `mollie_country_code` varchar(191) NOT NULL,
  `mollie_currency_code` varchar(191) NOT NULL,
  `paystack_country_code` varchar(191) NOT NULL,
  `paystack_currency_code` varchar(191) NOT NULL,
  `mollie_image` varchar(255) DEFAULT NULL,
  `paystack_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `paystack_currency_id` int(11) NOT NULL DEFAULT 0,
  `mollie_currency_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paystack_and_mollies`
--

INSERT INTO `paystack_and_mollies` (`id`, `mollie_key`, `mollie_status`, `mollie_currency_rate`, `paystack_public_key`, `paystack_secret_key`, `paystack_currency_rate`, `paystack_status`, `mollie_country_code`, `mollie_currency_code`, `paystack_country_code`, `paystack_currency_code`, `mollie_image`, `paystack_image`, `created_at`, `updated_at`, `paystack_currency_id`, `mollie_currency_id`) VALUES
(1, 'test_HFc5UhscNSGD5jujawhtNFs3wM3B4n', 0, 1.38, 'pk_test_057dfe5dee14eaf9c3b4573df1e3760c02c06e38', 'pk_test_0d2cc354374e8327f7f8a9941d861a600413a7f9', 460.49, 0, 'CA', 'CAD', 'US', 'USD', 'uploads/website-images/mollie-2023-09-28-08-44-56-1748.png', 'uploads/website-images/paystact-2023-09-28-08-45-36-9912.png', NULL, '2025-02-18 09:11:04', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `influencer_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id`, `influencer_id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kazi Omar Faruk', 'uploads/custom-images/service-thumb-2025-02-01-02-35-14-6694.png', 1, '2025-02-01 08:35:14', '2025-02-01 08:35:14');

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policies`
--

CREATE TABLE `privacy_policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `privacy_policies`
--

INSERT INTO `privacy_policies` (`id`, `lang_code`, `description`, `created_at`, `updated_at`) VALUES
(1, 'en', '\r\n<h4>1. What Are Privacy Policy?</h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown our printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriefss asbut also the on leap into a electironc typesetting, remaining as essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andeiss more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n\r\n\r\n<h4>2. Influencer Terms and Conditions Examples</h4>\r\n<p>While it&rsquo;s not legally required for ecommerce websites to have a terms and conditions agreement, adding one will help protect your as sonline business.As terms and conditions are legally enforceable rules, they allow you to set standards for how users interact with your site. Here are some of the major abenefits of including terms and conditions on your ecommerce site:</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the obb1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop.</p>\r\n\r\n\r\n<h4>Features :</h4>\r\n<ul>\r\n<li>slim body with metal cover</li>\r\n<li>latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</li>\r\n<li>8GB DDR4 RAM and fast 512GB PCIe SSD</li>\r\n<li>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture support</li>\r\n</ul>\r\n\r\n\r\n<h4>3. Protect Your Property</h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown as printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining as essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n\r\n\r\n<h4>4. What to Include in Terms and Conditions for Online Stores</h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the as1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic ki typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset as sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type our as specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas Ipsum to make a type specimen book.</p>\r\n\r\n\r\n<h4>05.Pricing and Payment Terms</h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the as 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic as typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen our as book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n', NULL, '2023-10-14 22:29:32'),
(22, 'ar', '<h4 id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"rtl\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><strong><span class=\"Y2IQFc\" lang=\"ar\">1. ما هي سياسة الخصوصية؟ </span></strong></h4>\r\n<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"rtl\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">لوريم إيبسوم هو ببساطة نص وهمي من صناعة الطباعة والتنضيد. لقد كان لوريم إيبسوم هو النص الوهمي القياسي في هذه الصناعة منذ القرن السادس عشر، عندما أخذ شخص غير معروف من مطبعتنا لوح الكتابة وخلطه ليصنع كتابًا نموذجيًا. لقد عاش ليس فقط خمسة قرون، بل قفز أيضًا إلى التنضيد الإلكتروني، وظل كما هو دون تغيير. لم يكن منتشراً في ستينيات القرن الماضي مع إصدار أوراق Letraset التي تحتوي على مقاطع لوريم إيبسوم، ومؤخراً مع ظهور برامج النشر المكتبي مثل Aldus PageMaker والتي تضمنت نسخاً من نص لوريم إيبسوم لإنشاء نماذج من الكتب.</span></pre>\r\n<h4>2. Influencer Terms and Conditions Examples</h4>\r\n<p>While it&rsquo;s not legally required for ecommerce websites to have a terms and conditions agreement, adding one will help protect your as sonline business.As terms and conditions are legally enforceable rules, they allow you to set standards for how users interact with your site. Here are some of the major abenefits of including terms and conditions on your ecommerce site:</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the obb1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop.</p>\r\n<h4>Features :</h4>\r\n<ul>\r\n<li>slim body with metal cover</li>\r\n<li>latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</li>\r\n<li>8GB DDR4 RAM and fast 512GB PCIe SSD</li>\r\n<li>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture support</li>\r\n</ul>\r\n<h4>3. Protect Your Property</h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown as printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining as essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<h4>4. What to Include in Terms and Conditions for Online Stores</h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the as1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic ki typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset as sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type our as specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas Ipsum to make a type specimen book.</p>\r\n<h4>05.Pricing and Payment Terms</h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the as 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic as typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen our as book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', '2023-10-17 23:04:37', '2023-10-18 14:56:01');

-- --------------------------------------------------------

--
-- Table structure for table `provider_bank_handcashes`
--

CREATE TABLE `provider_bank_handcashes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL DEFAULT 0,
  `bank_status` int(11) NOT NULL DEFAULT 0,
  `bank_instruction` text DEFAULT NULL,
  `handcash_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provider_bank_handcashes`
--

INSERT INTO `provider_bank_handcashes` (`id`, `provider_id`, `bank_status`, `bank_instruction`, `handcash_status`, `created_at`, `updated_at`) VALUES
(1, 21, 0, 'dasdasdas', 1, '2025-02-04 13:33:19', '2025-02-04 13:33:19');

-- --------------------------------------------------------

--
-- Table structure for table `provider_flutterwaves`
--

CREATE TABLE `provider_flutterwaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL DEFAULT 0,
  `public_key` text NOT NULL,
  `secret_key` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provider_instamojos`
--

CREATE TABLE `provider_instamojos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL DEFAULT 0,
  `api_key` text NOT NULL,
  `auth_token` text NOT NULL,
  `account_mode` varchar(255) NOT NULL DEFAULT 'Sandbox',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provider_mollies`
--

CREATE TABLE `provider_mollies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL DEFAULT 0,
  `mollie_key` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provider_paypals`
--

CREATE TABLE `provider_paypals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `account_mode` varchar(255) NOT NULL DEFAULT 'sandbox',
  `client_id` text DEFAULT NULL,
  `secret_id` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provider_paystacks`
--

CREATE TABLE `provider_paystacks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL DEFAULT 0,
  `public_key` varchar(255) NOT NULL,
  `secret_key` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provider_paystacks`
--

INSERT INTO `provider_paystacks` (`id`, `provider_id`, `public_key`, `secret_key`, `status`, `created_at`, `updated_at`) VALUES
(1, 21, 'pk_test_1db6699e758e07701baede2f787f148db748badc', 'sk_test_1595d78a9189ea591a5e9f64542db9eac011245c', 1, '2025-02-05 05:31:10', '2025-02-05 05:31:10');

-- --------------------------------------------------------

--
-- Table structure for table `provider_razorpays`
--

CREATE TABLE `provider_razorpays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `key` text DEFAULT NULL,
  `secret_key` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provider_stripes`
--

CREATE TABLE `provider_stripes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `stripe_key` text DEFAULT NULL,
  `stripe_secret` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provider_stripes`
--

INSERT INTO `provider_stripes` (`id`, `provider_id`, `status`, `stripe_key`, `stripe_secret`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'pk_test_51QokzfBR2bUrg2dgr5z02nK7uLOaC3BnfYVM8VZ74FEDirzsgxfuwf1fYLSGWVap4HfNxxsSXbpfVehlyZG9BuDU00dWn5nZMy', 'sk_test_51QokzfBR2bUrg2dge0hGdV57vPBUkR1NPy13TVWWROCs9H1H9ecT4Kwqie2Tl6Q6ykly3I26qU5lFAj1wK1PRRAH00zGbqtDds', '2025-02-04 09:00:30', '2025-02-04 12:30:35'),
(2, 21, 1, 'pk_test_51QKIOHE3HCOEW1L0h8Bh6ZDC5b0lDD886WQq3FZO82hnybhNWqzHhj3gDeEDcAocAywZf3A9Xh1FmDp6Kpipf1EI00GZOW8k0H', 'sk_test_51QKIOHE3HCOEW1L0whB1iOmxU43slTQAtrdmVAJPJSmKVJqv5GSXsaolSTStzngMl5pB4Pt0uT7yQjr9M55fzRWx00OBL94MSh', '2025-02-04 13:16:52', '2025-02-04 13:16:52'),
(3, 26, 1, 'gdfsgsdfgsdfgsd', 'sdgdsgsdgsdgsdgsd', '2025-02-18 08:34:51', '2025-02-18 08:34:51');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_histories`
--

CREATE TABLE `purchase_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `plan_price` varchar(255) NOT NULL,
  `expiration_date` varchar(255) NOT NULL,
  `expiration` varchar(255) NOT NULL,
  `maximum_service` varchar(255) NOT NULL COMMENT 'if type influencer then max_applies',
  `status` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `transaction` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_histories`
--

INSERT INTO `purchase_histories` (`id`, `provider_id`, `plan_id`, `plan_name`, `plan_price`, `expiration_date`, `expiration`, `maximum_service`, `status`, `payment_method`, `payment_status`, `transaction`, `created_at`, `updated_at`, `type`) VALUES
(1, 1, 1, 'Basic', '0', '2024-08-02', 'monthly', '3', 'expired', 'Free', 'success', 'free_enroll', '2024-07-03 16:18:02', '2025-02-01 10:35:22', NULL),
(2, 1, 4, 'Gold', '49', 'lifetime', 'lifetime', '50', 'expired', 'Stripe', 'success', 'txn_3PYi3pF56Pb8BOOX1g0SdbAt', '2024-07-03 16:18:30', '2025-02-01 10:35:22', NULL),
(3, 1, 3, 'Premium', '29', '2025-07-03', 'yearly', '10', 'expired', 'Stripe', 'success', 'txn_3PYi6cF56Pb8BOOX1qdSy9xa', '2024-07-03 16:21:21', '2025-02-01 10:35:22', NULL),
(4, 5, 2, 'Silver', '19', '2026-02-01', 'yearly', '5', 'expired', 'Stripe', 'success', 'txn_3QnZJ9F56Pb8BOOX0FuZx1wW', '2025-02-01 05:31:55', '2025-02-03 08:24:36', NULL),
(5, 1, 2, 'Silver', '19', '2026-02-01', 'yearly', '5', 'expired', 'Stripe', 'success', 'txn_3QnaV2F56Pb8BOOX0br0s4Dp', '2025-02-01 06:48:16', '2025-02-01 10:35:22', NULL),
(6, 1, 3, 'Premium', '29', '2026-02-01', 'yearly', '10', 'expired', 'Stripe', 'success', 'txn_3Qnaf5E3HCOEW1L00xBhPjfN', '2025-02-01 06:58:38', '2025-02-01 10:35:22', NULL),
(7, 1, 2, 'Silver', '19', '2026-02-01', 'yearly', '5', 'expired', 'Stripe', 'success', 'txn_3QnahPE3HCOEW1L00i8hRUFo', '2025-02-01 07:01:03', '2025-02-01 10:35:22', NULL),
(8, 1, 4, 'Gold', '49', 'lifetime', 'lifetime', '50', 'expired', 'Stripe', 'success', 'txn_3QnaiAE3HCOEW1L01t9A7xWR', '2025-02-01 07:01:50', '2025-02-01 10:35:22', NULL),
(10, 1, 6, 'fswfsdf', '34', 'lifetime', 'lifetime', '23', 'active', 'handcash', 'success', 'hand_cash', '2025-02-01 10:35:22', '2025-02-01 10:35:22', NULL),
(14, 21, 1, 'Basic', '0', '2025-02-03', 'monthly', '-1', 'expired', 'handcash', 'success', 'hand_cash', '2025-02-02 06:19:27', '2025-02-04 13:30:41', 'business'),
(15, 5, 6, 'fswfsdf', '34', 'lifetime', 'lifetime', '23', 'expired', 'Stripe', 'success', 'txn_3QnxKlE3HCOEW1L01NClE66I', '2025-02-02 07:11:11', '2025-02-03 08:24:36', NULL),
(16, 23, 6, 'fswfsdf', '34', '2025-03-05', 'lifetime', '10', 'expired', 'handcash', 'success', 'hand_cash', '2025-02-03 06:12:02', '2025-02-03 06:16:30', 'influencer'),
(17, 23, 6, 'fswfsdf', '34', '2025-03-05', 'lifetime', '4', 'expired', 'handcash', 'success', 'hand_cash', '2025-02-03 06:14:13', '2025-02-03 06:16:30', 'influencer'),
(18, 23, 6, 'fswfsdf', '34', '2025-02-04', 'lifetime', '2', 'active', 'handcash', 'success', 'hand_cash', '2025-02-03 06:16:30', '2025-02-03 06:16:30', 'influencer'),
(19, 5, 7, 'Free', '0', '2025-02-04', 'daily', '11', 'active', 'handcash', 'success', 'hand_cash', '2025-02-03 08:24:36', '2025-02-03 08:24:36', 'influencer'),
(20, 21, 3, 'Premium', '29', '2026-02-04', 'yearly', '10', 'active', 'Stripe', 'success', 'txn_3QomDABR2bUrg2dg0EHIfEdi', '2025-02-04 13:30:41', '2025-02-04 13:30:41', NULL),
(22, 26, 5, 'dfdf', '34', '2025-03-11', 'monthly', '5', 'expired', 'Stripe', 'success', 'txn_3QqTZBBR2bUrg2dg2CUUrzom', '2025-02-09 06:00:15', '2025-02-12 10:47:48', NULL),
(23, 26, 3, 'Premium', '29', '2026-02-09', 'yearly', '10', 'expired', 'Stripe', 'success', 'txn_3QqTcOBR2bUrg2dg0SdzVsz2', '2025-02-09 06:03:34', '2025-02-12 10:47:48', NULL),
(25, 26, 4, 'Gold', '49', '2025-02-08', 'lifetime', '-1', 'expired', 'Stripe', 'success', 'txn_3QqTrABR2bUrg2dg1I9FsSqY', '2025-02-09 06:18:51', '2025-02-12 10:47:48', NULL),
(26, 26, 3, 'Premium', '29', '2026-02-09', 'yearly', '10', 'expired', 'Stripe', 'success', 'txn_3QqWaoBR2bUrg2dg01pGLxj3', '2025-02-09 09:14:08', '2025-02-12 10:47:48', NULL),
(27, 26, 2, 'Silver', '19', '2025-03-12', 'yearly', '-1', 'expired', 'handcash', 'success', 'hand_cash', '2025-02-10 04:23:41', '2025-02-12 10:47:48', 'business'),
(28, 24, 6, 'Silver', '34', 'lifetime', 'lifetime', '23', 'expired', 'Stripe', 'success', 'txn_3QqpPjBR2bUrg2dg0JaktQZF', '2025-02-10 05:19:55', '2025-02-13 06:02:04', NULL),
(29, 24, 6, 'Silver', '34', 'lifetime', 'lifetime', '23', 'expired', 'Stripe', 'success', 'txn_3QqpRIBR2bUrg2dg2eqB806u', '2025-02-10 05:21:32', '2025-02-13 06:02:04', NULL),
(30, 24, 6, 'Silver', '34', 'lifetime', 'lifetime', '23', 'expired', 'Stripe', 'success', 'txn_3QqpmuBR2bUrg2dg0WFcNXxA', '2025-02-10 05:43:52', '2025-02-13 06:02:04', NULL),
(31, 24, 6, 'Silver', '34', '2025-03-12', 'monthly', '23', 'expired', 'Stripe', 'success', 'txn_3QqqLWBR2bUrg2dg21aRiZ8R', '2025-02-10 06:19:38', '2025-02-13 06:02:04', 'influencer'),
(32, 26, 2, 'Silver', '19', '2025-02-11', 'yearly', '10', 'expired', 'handcash', 'success', 'hand_cash', '2025-02-10 06:41:51', '2025-02-12 10:47:48', 'business'),
(33, 26, 4, 'Gold', '49', '2025-03-12', 'lifetime', '59', 'expired', 'handcash', 'success', 'hand_cash', '2025-02-10 06:42:19', '2025-02-12 10:47:48', 'business'),
(34, 24, 7, 'Free', '0', '2025-02-11', 'daily', '5', 'expired', 'Free', 'success', 'free_enroll', '2025-02-10 08:04:06', '2025-02-13 06:02:04', NULL),
(35, 26, 2, 'Silver', '19', '2025-02-11', 'yearly', '-1', 'expired', 'handcash', 'success', 'hand_cash', '2025-02-10 11:18:56', '2025-02-12 10:47:48', 'business'),
(36, 24, 6, 'Silver', '34', '2025-03-13', 'monthly', '23', 'expired', 'Stripe', 'success', 'txn_3QrBBbBR2bUrg2dg2rdcaz3o', '2025-02-11 04:34:45', '2025-02-13 06:02:04', 'influencer'),
(37, 24, 6, 'Silver', '34', '2025-03-13', 'monthly', '23', 'expired', 'Stripe', 'success', 'txn_3QrBTnBR2bUrg2dg25xyoTL0', '2025-02-11 04:53:33', '2025-02-13 06:02:04', 'influencer'),
(38, 24, 6, 'Silver', '34', '2025-03-14', 'monthly', '23', 'expired', 'Stripe', 'success', 'txn_3QrbbrBR2bUrg2dg2gBWkDxO', '2025-02-12 08:47:57', '2025-02-13 06:02:04', 'influencer'),
(39, 24, 6, 'Silver', '34', '2025-03-14', 'monthly', '23', 'expired', 'Stripe', 'success', 'txn_3QrbdDBR2bUrg2dg1fWrOHyt', '2025-02-12 08:49:18', '2025-02-13 06:02:04', 'influencer'),
(40, 24, 6, 'Silver', '34', '2025-03-14', 'monthly', '23', 'expired', 'Stripe', 'success', 'txn_3Qrbp3BR2bUrg2dg0rnxxntQ', '2025-02-12 09:01:32', '2025-02-13 06:02:04', 'influencer'),
(41, 26, 5, 'dfdf', '34', '2025-03-14', 'monthly', '5', 'expired', 'Stripe', 'success', 'txn_3QrdJdBR2bUrg2dg0YmLlieg', '2025-02-12 10:37:12', '2025-02-12 10:47:48', 'business'),
(42, 24, 6, 'Silver', '34', '2025-03-14', 'monthly', '23', 'expired', 'Stripe', 'success', 'txn_3QrdQlBR2bUrg2dg1xvgQ0Ow', '2025-02-12 10:44:34', '2025-02-13 06:02:04', 'influencer'),
(43, 24, 6, 'Silver', '34', '2025-03-14', 'monthly', '23', 'expired', 'Stripe', 'success', 'txn_3QrdRMBR2bUrg2dg05XyKrAb', '2025-02-12 10:45:11', '2025-02-13 06:02:04', 'influencer'),
(44, 24, 6, 'Silver', '34', '2025-03-14', 'monthly', '23', 'expired', 'Stripe', 'success', 'txn_3QrdRtBR2bUrg2dg21O8v90q', '2025-02-12 10:45:44', '2025-02-13 06:02:04', 'influencer'),
(45, 24, 6, 'Silver', '34', '2025-03-14', 'monthly', '23', 'expired', 'Stripe', 'success', 'txn_3QrdSZBR2bUrg2dg0gPLTafY', '2025-02-12 10:46:26', '2025-02-13 06:02:04', 'influencer'),
(46, 24, 6, 'Silver', '34', '2025-03-14', 'monthly', '23', 'expired', 'Stripe', 'success', 'txn_3QrdSsBR2bUrg2dg10Obl4Pg', '2025-02-12 10:46:45', '2025-02-13 06:02:04', 'influencer'),
(47, 26, 5, 'dfdf', '34', '2025-03-14', 'monthly', '5', 'expired', 'Stripe', 'success', 'txn_3QrdTJBR2bUrg2dg1wBrc2gr', '2025-02-12 10:47:12', '2025-02-12 10:47:48', 'business'),
(48, 26, 4, 'Gold', '49', 'lifetime', 'lifetime', '50', 'active', 'Stripe', 'success', 'txn_3QrdTtBR2bUrg2dg2qF3Xn4U', '2025-02-12 10:47:48', '2025-02-12 10:47:48', 'business'),
(49, 24, 6, 'Silver', '34', '2025-03-15', 'monthly', '23', 'expired', 'Stripe', 'success', 'txn_3QrvPaBR2bUrg2dg1SPyEVb8', '2025-02-13 05:56:34', '2025-02-13 06:02:04', 'influencer'),
(50, 24, 6, 'Silver', '34', '2025-03-15', 'monthly', '23', 'expired', 'Stripe', 'success', 'txn_3QrvQyBR2bUrg2dg2ijqyOum', '2025-02-13 05:58:00', '2025-02-13 06:02:04', 'influencer'),
(51, 24, 6, 'Silver', '34', '2025-03-15', 'monthly', '23', 'expired', 'Stripe', 'success', 'txn_3QrvUuBR2bUrg2dg0hpEsC14', '2025-02-13 06:02:04', '2025-02-13 06:02:04', 'influencer');

-- --------------------------------------------------------

--
-- Table structure for table `razorpay_payments`
--

CREATE TABLE `razorpay_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) DEFAULT NULL,
  `currency_rate` double NOT NULL DEFAULT 1,
  `country_code` varchar(191) NOT NULL,
  `currency_code` varchar(191) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `key` text DEFAULT NULL,
  `secret_key` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `razorpay_payments`
--

INSERT INTO `razorpay_payments` (`id`, `status`, `name`, `currency_rate`, `country_code`, `currency_code`, `description`, `image`, `color`, `key`, `secret_key`, `created_at`, `updated_at`, `currency_id`) VALUES
(1, 1, 'Ecommerce', 74.66, 'IN', 'INR', 'This is description', 'uploads/website-images/razorpay-2023-09-28-08-42-13-1486.png', '#2d15e5', 'rzp_test_K7CipNQYyyMPiS', 'zSBmNMorJrirOrnDrbOd1ALO', NULL, '2025-02-18 09:11:23', 3);

-- --------------------------------------------------------

--
-- Table structure for table `refund_requests`
--

CREATE TABLE `refund_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `reasone` text NOT NULL,
  `account_information` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'awaiting_for_admin_approval',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `refund_requests`
--

INSERT INTO `refund_requests` (`id`, `client_id`, `order_id`, `reasone`, `account_information`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 2, 'This provider cheated with me.', 'This provider cheated with me. he didn&#039;t complete his task. I need refund', 'complete', '2023-10-17 20:27:26', '2023-10-17 20:28:49'),
(2, 5, 3, 'I wan to refund my payment', 'The influencer rejected my booking. So I need refund.', 'complete', '2023-10-23 16:02:19', '2025-02-04 13:29:31'),
(3, 5, 34, 'This is fake service', 'abc bank\r\n12312455235235235\r\nsdfjlsfsfjsf\r\nsjdflsf', 'complete', '2025-02-05 03:39:39', '2025-02-05 03:41:15');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `influencer_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `rating` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `influencer_id`, `service_id`, `comment`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 11, 'Suspendisse a ornare lacus, id ultricies sapien. Morbi ac consequat orci, vitae imperdiet mi. Curabitur dapibus erat orci, sit amet maximus nulla consequat non.', 5, 1, '2023-10-17 20:19:40', '2023-10-17 20:19:59'),
(2, 5, 1, 11, 'This WordPress theme is perfect for any ki Custom Slider holo the powerfu jemon temon as website.This WordPress Theme has the powerful theme control panel', 5, 1, '2023-10-17 20:20:43', '2023-10-17 20:20:51'),
(3, 5, 1, 10, 'Elementor Page Builder, Custom ki Slider, our Custom Icon Font,etc. With as variation and demos I am sure you gonna love it and use it for your next Project.', 4, 1, '2023-10-17 20:29:20', '2023-10-17 20:29:32'),
(4, 5, 1, 13, 'niceeeeeeee', 5, 0, '2025-02-04 13:05:52', '2025-02-04 13:05:52');

-- --------------------------------------------------------

--
-- Table structure for table `seo_settings`
--

CREATE TABLE `seo_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `seo_keyword` text DEFAULT NULL,
  `seo_title` text DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seo_settings`
--

INSERT INTO `seo_settings` (`id`, `page_name`, `seo_keyword`, `seo_title`, `seo_description`, `created_at`, `updated_at`) VALUES
(1, 'Home', 'inflaner', 'Inflanar || Influencer Marketing Service Selling Marketplace Laravel Script', 'Inflanar || Influencer Marketing Service Selling Marketplace Laravel Script', '2023-09-12 05:43:51', '2023-10-23 17:18:18'),
(2, 'Blogs', 'inflaner', 'Our Blog || Influencer Marketing Service Selling Marketplace Laravel Script', 'Inflanar || Influencer Marketing Service Selling Marketplace Laravel Script', '2023-09-12 05:43:51', '2023-10-23 17:18:47'),
(3, 'About Us', 'inflaner', 'About Us || Influencer Marketing Service Selling Marketplace Laravel Script', 'Inflanar || Influencer Marketing Service Selling Marketplace Laravel Script', '2023-09-12 05:43:51', '2023-10-23 17:18:58'),
(4, 'Contact Us', 'inflaner', 'Contact Us || Influencer Marketing Service Selling Marketplace Laravel Script', 'Inflanar || Influencer Marketing Service Selling Marketplace Laravel Script', '2023-09-12 05:43:51', '2023-10-23 17:19:08'),
(5, 'FAQ', 'inflaner', 'FAQ || Influencer Marketing Service Selling Marketplace Laravel Script', 'Inflanar || Influencer Marketing Service Selling Marketplace Laravel Script', '2023-09-12 05:43:51', '2023-10-23 17:19:17'),
(6, 'Terms & Conditions', 'inflaner', 'Inflanar || Influencer Marketing Service Selling Marketplace Laravel Script', 'Inflanar || Influencer Marketing Service Selling Marketplace Laravel Script', '2023-09-12 05:43:51', '2023-10-23 17:19:23'),
(7, 'Privacy Policy', 'inflaner', 'Inflanar || Influencer Marketing Service Selling Marketplace Laravel Script', 'Inflanar || Influencer Marketing Service Selling Marketplace Laravel Script', '2023-09-12 05:43:51', '2023-10-23 17:19:31'),
(8, 'Service', 'inflaner', 'Our Service || Influencer Marketing Service Selling Marketplace Laravel Script', 'Inflanar || Influencer Marketing Service Selling Marketplace Laravel Script', '2023-09-12 05:43:51', '2023-10-23 17:19:42'),
(9, 'Business', 'Influencers', 'Our Influencers || Influencer Marketing Service Selling Marketplace Laravel Script', 'Inflanar || Influencer Marketing Service Selling Marketplace Laravel Script', '2023-09-12 05:43:51', '2023-10-23 17:19:56');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `influencer_id` int(11) NOT NULL,
  `thumbnail_image` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `is_banned` varchar(255) NOT NULL DEFAULT 'disable',
  `approve_by_admin` varchar(10) NOT NULL DEFAULT 'disable',
  `is_featured` varchar(255) NOT NULL DEFAULT 'disable',
  `tags` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `slug`, `category_id`, `influencer_id`, `thumbnail_image`, `price`, `status`, `is_banned`, `approve_by_admin`, `is_featured`, `tags`, `created_at`, `updated_at`) VALUES
(1, 'electricia-in-workwear-open-conditioner', 1, 1, 'uploads/custom-images/service-thumb-2023-10-29-01-08-01-5430.png', 10.00, 'active', 'disable', 'enable', 'disable', '[{\"value\":\"influencer\"},{\"value\":\"hirging\"},{\"value\":\"facebook\"},{\"value\":\"twitter\"}]', '2023-10-16 21:58:38', '2023-10-28 19:08:01'),
(2, 'happy-lady-in-as-sltylish-skirt-boater', 1, 1, 'uploads/custom-images/service-thumb-2023-10-29-01-07-08-4893.png', 11.00, 'active', 'disable', 'enable', 'disable', '[{\"value\":\"service\"},{\"value\":\"html\"},{\"value\":\"php\"},{\"value\":\"laravel\"}]', '2023-10-16 22:01:16', '2023-10-28 19:07:08'),
(3, 'standing-in-at-astemple-gates-at-lem', 2, 1, 'uploads/custom-images/service-thumb-2023-10-29-01-07-34-1575.png', 15.99, 'active', 'disable', 'enable', 'disable', NULL, '2023-10-16 22:05:09', '2023-10-28 19:07:34'),
(4, 'two-girls-are-our-doing-makeup-in', 2, 2, 'uploads/custom-images/service-thumb-2023-10-29-01-06-35-6630.png', 9.99, 'active', 'disable', 'enable', 'disable', '[{\"value\":\"influencer\"},{\"value\":\"hirining\"},{\"value\":\"larave\"},{\"value\":\"developer\"}]', '2023-10-17 17:57:35', '2023-10-28 19:06:35'),
(5, 'strong-man-the-training-black-man', 5, 2, 'uploads/custom-images/service-thumb-2023-10-29-01-05-52-9725.png', 14.99, 'active', 'disable', 'enable', 'disable', NULL, '2023-10-17 18:00:22', '2023-10-28 19:05:52'),
(6, 'style-meets-influence-wardrobe-services', 2, 3, 'uploads/custom-images/service-thumb-2023-10-29-12-58-38-7684.png', 20.00, 'active', 'disable', 'enable', 'disable', NULL, '2023-10-17 18:14:03', '2023-10-28 18:58:38'),
(7, 'energizing-electrical-influencers', 4, 3, 'uploads/custom-images/service-thumb-2023-10-29-01-05-28-3609.png', 18.00, 'active', 'disable', 'enable', 'disable', NULL, '2023-10-17 18:16:43', '2023-10-28 19:05:28'),
(8, 'influencers-unleashed-training-programs', 2, 4, 'uploads/custom-images/service-thumb-2023-10-29-01-04-52-8881.png', 25.00, 'active', 'disable', 'enable', 'disable', NULL, '2023-10-17 19:36:10', '2025-02-04 13:14:08'),
(9, 'influencer-beauty-makeovers', 8, 1, 'uploads/custom-images/service-thumb-2023-10-29-01-04-00-5932.png', 25.00, 'active', 'disable', 'enable', 'disable', '[{\"value\":\"php\"},{\"value\":\"larave\"},{\"value\":\"web development\"},{\"value\":\"design\"}]', '2023-10-17 19:44:14', '2023-10-28 19:04:00'),
(10, 'strength-training-with-influencers', 3, 1, 'uploads/custom-images/service-thumb-2023-10-29-01-02-06-2769.png', 55.00, 'active', 'disable', 'enable', 'disable', '[{\"value\":\"larave\"},{\"value\":\"html\"},{\"value\":\"css\"},{\"value\":\"developer\"}]', '2023-10-17 19:49:04', '2023-10-28 19:02:06'),
(11, 'makeup-magic-with-two-influencers', 1, 1, 'uploads/custom-images/service-thumb-2023-10-29-01-01-02-1982.png', 18.00, 'active', 'disable', 'enable', 'disable', '[{\"value\":\"makeup\"},{\"value\":\"influencer\"},{\"value\":\"beauty\"},{\"value\":\"lovely\"}]', '2023-10-17 19:51:05', '2023-10-28 19:01:02'),
(12, 'abc', 1, 21, 'uploads/custom-images/service-thumb-2025-02-02-12-34-39-8699.png', 225.00, 'active', 'disable', 'enable', 'disable', NULL, '2025-02-02 06:34:39', '2025-02-04 13:13:35'),
(13, 'test-service-for-testing', 1, 1, 'uploads/custom-images/service-thumb-2025-02-04-11-47-46-4306.png', 29.00, 'active', 'disable', 'enable', 'disable', NULL, '2025-02-04 05:47:46', '2025-02-04 05:53:40'),
(20, 'gdsgsdg', 3, 26, 'uploads/custom-images/service-thumb-2025-02-08-12-23-53-7572.png', 29.00, 'active', 'disable', 'enable', 'disable', NULL, '2025-02-08 06:23:53', '2025-02-08 06:38:14'),
(21, 'john-doesf', 2, 26, 'uploads/custom-images/service-thumb-2025-02-08-12-34-26-8767.png', 29.00, 'active', 'disable', 'enable', 'disable', NULL, '2025-02-08 06:34:26', '2025-02-08 06:40:50'),
(22, 'asfsaf', 3, 26, 'uploads/custom-images/service-thumb-2025-02-08-12-35-08-8043.png', 29.00, 'active', 'disable', 'enable', 'disable', NULL, '2025-02-08 06:35:08', '2025-02-08 06:40:26'),
(23, 'rhgdfgdsfg', 3, 26, 'uploads/custom-images/service-thumb-2025-02-08-12-35-51-9652.png', 29.00, 'active', 'disable', 'enable', 'disable', NULL, '2025-02-08 06:35:51', '2025-02-08 06:40:00'),
(24, 'Enim aut ex dolorem', 3, 26, 'uploads/custom-images/service-thumb-2025-02-08-12-36-22-7731.png', 29.00, 'active', 'disable', 'enable', 'disable', NULL, '2025-02-08 06:36:22', '2025-02-08 06:39:32'),
(25, 'Et minus explicabo', 9, 26, 'uploads/custom-images/service-thumb-2025-02-08-12-37-14-4460.png', 226.00, 'active', 'disable', 'enable', 'disable', NULL, '2025-02-08 06:37:14', '2025-02-08 06:39:06'),
(26, 'fdsfsggsd', 1, 26, 'uploads/custom-images/service-thumb-2025-02-09-10-54-07-8336.png', 13.00, 'active', 'disable', 'disable', 'disable', NULL, '2025-02-09 04:54:07', '2025-02-09 04:54:07'),
(27, 'Atque aut corporis d', 9, 26, 'uploads/custom-images/service-thumb-2025-02-09-11-31-49-8281.png', 751.00, 'active', 'disable', 'disable', 'disable', NULL, '2025-02-09 05:31:49', '2025-02-09 05:31:49'),
(28, 'sdfsafsf', 3, 26, 'uploads/custom-images/service-thumb-2025-02-09-11-35-21-4817.png', 29.00, 'active', 'disable', 'disable', 'disable', NULL, '2025-02-09 05:35:21', '2025-02-09 05:35:21'),
(29, 'Mollit qui ex esse', 3, 26, 'uploads/custom-images/service-thumb-2025-02-09-12-32-23-9590.png', 223.00, 'active', 'disable', 'disable', 'disable', NULL, '2025-02-09 06:32:23', '2025-02-09 06:32:23'),
(30, 'Nulla provident adi', 5, 26, 'uploads/custom-images/service-thumb-2025-02-09-04-15-11-2828.png', 777.00, 'active', 'disable', 'disable', 'disable', NULL, '2025-02-09 10:15:11', '2025-02-09 10:15:11'),
(31, 'Sed aliqua Vel nihi', 7, 26, 'uploads/custom-images/service-thumb-2025-02-09-04-19-47-9564.png', 635.00, 'active', 'disable', 'disable', 'disable', NULL, '2025-02-09 10:19:47', '2025-02-09 10:19:47'),
(32, 'Harum fugiat aliqui', 10, 26, 'uploads/custom-images/service-thumb-2025-02-09-04-20-12-7122.png', 520.00, 'active', 'disable', 'disable', 'disable', NULL, '2025-02-09 10:20:12', '2025-02-09 10:20:12'),
(33, 'Quia id qui quis et', 2, 26, 'uploads/custom-images/service-thumb-2025-02-09-04-58-59-4445.png', 395.00, 'active', 'disable', 'disable', 'disable', NULL, '2025-02-09 10:58:59', '2025-02-09 10:58:59'),
(34, 'Dolor eu quidem faci', 6, 26, 'uploads/custom-images/service-thumb-2025-02-09-05-27-18-1007.png', 818.00, 'active', 'disable', 'disable', 'disable', NULL, '2025-02-09 11:27:18', '2025-02-09 11:27:18'),
(35, 'Eveniet quo modi po', 4, 26, 'uploads/custom-images/service-thumb-2025-02-10-09-35-11-3712.png', 176.00, 'active', 'disable', 'disable', 'disable', NULL, '2025-02-10 03:35:11', '2025-02-10 03:35:11'),
(36, 'Voluptate qui deseru', 1, 26, 'uploads/custom-images/service-thumb-2025-02-10-09-35-39-2736.png', 602.00, 'active', 'disable', 'disable', 'disable', NULL, '2025-02-10 03:35:39', '2025-02-10 03:35:39'),
(37, 'Dolorem vel possimus', 8, 26, 'uploads/custom-images/service-thumb-2025-02-10-09-36-10-3355.png', 33.00, 'active', 'disable', 'disable', 'disable', NULL, '2025-02-10 03:36:10', '2025-02-10 03:36:10'),
(38, 'Maxime modi voluptas', 8, 26, 'uploads/custom-images/service-thumb-2025-02-10-09-38-11-6142.png', 251.00, 'active', 'disable', 'disable', 'disable', NULL, '2025-02-10 03:38:11', '2025-02-10 03:38:11'),
(39, 'Deserunt itaque nobi', 10, 26, 'uploads/custom-images/service-thumb-2025-02-10-09-52-19-4257.png', 833.00, 'active', 'disable', 'disable', 'disable', NULL, '2025-02-10 03:52:19', '2025-02-10 03:52:19'),
(40, 'Numquam praesentium', 3, 26, 'uploads/custom-images/service-thumb-2025-02-10-10-24-50-3658.png', 349.00, 'active', 'disable', 'disable', 'disable', NULL, '2025-02-10 04:24:50', '2025-02-10 04:24:50'),
(41, 'Laborum In dolor ni', 2, 26, 'uploads/custom-images/service-thumb-2025-02-10-10-25-25-1007.png', 838.00, 'active', 'disable', 'disable', 'disable', NULL, '2025-02-10 04:25:25', '2025-02-10 04:25:25'),
(42, 'amos-rowe', 1, 24, 'uploads/custom-images/service-thumb-2025-02-10-12-15-55-5321.png', 34.00, 'active', 'disable', 'disable', 'disable', NULL, '2025-02-10 06:15:55', '2025-02-10 06:15:55'),
(43, 'vera-ortiz', 1, 26, 'uploads/custom-images/service-thumb-2025-02-18-06-37-54-6036.jpg', 838.00, 'active', 'disable', 'disable', 'disable', '[{\"value\":\"sdfds\"}]', '2025-02-18 12:37:54', '2025-02-18 12:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `service_translations`
--

CREATE TABLE `service_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `features` longtext DEFAULT NULL,
  `seo_title` text DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_translations`
--

INSERT INTO `service_translations` (`id`, `service_id`, `lang_code`, `title`, `description`, `features`, `seo_title`, `seo_description`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Electricia in workwear open conditioner', '<p>This is one of the best WordPress Theme. It is clean, user friendly, fully responsivle, pixel perfect, our modern as design with latest WordPress Technologies. This WordPress theme is perfect for any ki Custom Slider holo the powerfu jemon temon as website.This WordPress Theme has the powerful theme control panel ki holo as with lots It is cleans, user of useful Addons tools to manage the site: Elementor Page Builder, Custom ki Slider, our Custom Icon Font,etc. With as variation and demos I am sure you gonna love it and use it for your next Project.</p>', '[\"30 Social Media Post\",\"Duration 5-6Months\",\"Digital Marketing\",\"Company Profile Build\",\"Business Growing\",\"6 Video Post My Profile\",\"\"]', 'Electricia in workwear open conditioner', 'Electricia in workwear open conditioner', '2023-10-16 21:58:38', '2023-10-28 19:08:01'),
(2, 2, 'en', 'Happy lady in as sltylish skirt boater', '<p>This is one of the best WordPress Theme. It is clean, user friendly, fully responsivle, pixel perfect, our modern as design with latest WordPress Technologies. This WordPress theme is perfect for any ki Custom Slider holo the powerfu jemon temon as website.This WordPress Theme has the powerful theme control panel ki holo as with lots It is cleans, user of useful Addons tools to manage the site: Elementor Page Builder, Custom ki Slider, our Custom Icon Font,etc. With as variation and demos I am sure you gonna love it and use it for your next Project.</p>', '[\"6 Video Post My Profile\",\"Business Growing\",\"Company Profile Build\",\"Digital Marketing\",\"Duration 5-6Months\",\"30 Social Media Post\",\"\"]', 'Happy lady in as sltylish skirt boater', 'Happy lady in as sltylish skirt boater', '2023-10-16 22:01:16', '2023-10-28 19:07:08'),
(3, 3, 'en', 'Standing in at astemple gates at lem', '<p>This is one of the best WordPress Theme. It is clean, user friendly, fully responsivle, pixel perfect, our modern as design with latest WordPress Technologies. This WordPress theme is perfect for any ki Custom Slider holo the powerfu jemon temon as website.This WordPress Theme has the powerful theme control panel ki holo as with lots It is cleans, user of useful Addons tools to manage the site: Elementor Page Builder, Custom ki Slider, our Custom Icon Font,etc. With as variation and demos I am sure you gonna love it and use it for your next Project.</p>', '[\"30 Social Media Post\",\"Duration 5-6Months\",\"Digital Marketing\",\"Company Profile Build\",\"Business Growing\",\"6 Video Post My Profile\",\"\"]', 'Standing in at astemple gates at lem', 'Standing in at astemple gates at lem', '2023-10-16 22:05:09', '2023-10-28 19:07:24'),
(4, 4, 'en', 'Two girls are our doing make-up in', '<p>This is one of the best WordPress Theme. It is clean, user friendly, fully responsivle, pixel perfect, our modern as design with latest WordPress Technologies. This WordPress theme is perfect for any ki Custom Slider holo the powerfu jemon temon as website.This WordPress Theme has the powerful theme control panel ki holo as with lots It is cleans, user of useful Addons tools to manage the site: Elementor Page Builder, Custom ki Slider, our Custom Icon Font,etc. With as variation and demos I am sure you gonna love it and use it for your next Project.</p>', '[\"30 Social Media Post\",\"Duration 5-6Months\",\"Digital Marketing\",\"Company Profile Build\",\"Business Growing\",\"6 Video Post My Profile\",\"\"]', 'Two girls are our doing make-up in', 'Two girls are our doing make-up in', '2023-10-17 17:57:35', '2023-10-17 17:58:02'),
(5, 5, 'en', 'Strong man the training black man', '<p>This is one of the best WordPress Theme. It is clean, user friendly, fully responsivle, pixel perfect, our modern as design with latest WordPress Technologies. This WordPress theme is perfect for any ki Custom Slider holo the powerfu jemon temon as website.This WordPress Theme has the powerful theme control panel ki holo as with lots It is cleans, user of useful Addons tools to manage the site: Elementor Page Builder, Custom ki Slider, our Custom Icon Font,etc. With as variation and demos I am sure you gonna love it and use it for your next Project.</p>', '[\"Strong man the training black man\",\"Business Growing\",\"Company Profile Build\",\"Digital Marketing\",\"Duration 5-6Months\",\"30 Social Media Post\",\"\"]', 'Strong man the training black man', 'Strong man the training black man', '2023-10-17 18:00:22', '2023-10-17 18:00:43'),
(6, 6, 'en', 'Style Meets Influence: Wardrobe Services', '<p>This is one of the best WordPress Theme. It is clean, user friendly, fully responsivle, pixel perfect, our modern as design with latest WordPress Technologies. This WordPress theme is perfect for any ki Custom Slider holo the powerfu jemon temon as website.This WordPress Theme has the powerful theme control panel ki holo as with lots It is cleans, user of useful Addons tools to manage the site: Elementor Page Builder, Custom ki Slider, our Custom Icon Font,etc. With as variation and demos I am sure you gonna love it and use it for your next Project.</p>', '[\"30 Social Media Post\",\"Duration 5-6Months\",\"Digital Marketing\",\"Company Profile Build\",\"Business Growing\",\"6 Video Post My Profile\",\"\"]', 'Style Meets Influence: Wardrobe Services', 'Style Meets Influence: Wardrobe Services', '2023-10-17 18:14:03', '2023-10-17 18:17:13'),
(7, 7, 'en', 'Energizing Electrical Influencers', '<p>This is one of the best WordPress Theme. It is clean, user friendly, fully responsivle, pixel perfect, our modern as design with latest WordPress Technologies. This WordPress theme is perfect for any ki Custom Slider holo the powerfu jemon temon as website.This WordPress Theme has the powerful theme control panel ki holo as with lots It is cleans, user of useful Addons tools to manage the site: Elementor Page Builder, Custom ki Slider, our Custom Icon Font,etc. With as variation and demos I am sure you gonna love it and use it for your next Project.</p>', '[\"6 Video Post My Profile\",\"Business Growing\",\"Company Profile Build\",\"Business Growing\",\"Company Profile Build\",\"6 Video Post My Profile\",\"\"]', 'Energizing Electrical Influencers', 'Energizing Electrical Influencers', '2023-10-17 18:16:43', '2023-10-17 18:17:43'),
(8, 8, 'en', 'Influencers Unleashed: Training Programs', '<p>This is one of the best WordPress Theme. It is clean, user friendly, fully responsivle, pixel perfect, our modern as design with latest WordPress Technologies. This WordPress theme is perfect for any ki Custom Slider holo the powerfu jemon temon as website.This WordPress Theme has the powerful theme control panel ki holo as with lots It is cleans, user of useful Addons tools to manage the site: Elementor Page Builder, Custom ki Slider, our Custom Icon Font,etc. With as variation and demos I am sure you gonna love it and use it for your next Project.</p>', '[\"30 Social Media Post\",\"Duration 5-6Months\",\"Digital Marketing\",\"Company Profile Build\",\"Business Growing\",\"6 Video Post My Profile\",\"\"]', 'Influencers Unleashed: Training Programs', 'Influencers Unleashed: Training Programs', '2023-10-17 19:36:10', '2023-10-17 19:37:45'),
(9, 9, 'en', 'Influencer Beauty Makeovers', '<p>This is one of the best WordPress Theme. It is clean, user friendly, fully responsivle, pixel perfect, our modern as design with latest WordPress Technologies. This WordPress theme is perfect for any ki Custom Slider holo the powerfu jemon temon as website.This WordPress Theme has the powerful theme control panel ki holo as with lots It is cleans, user of useful Addons tools to manage the site: Elementor Page Builder, Custom ki Slider, our Custom Icon Font,etc. With as variation and demos I am sure you gonna love it and use it for your next Project.</p>', '[\"6 Video Post My Profile\",\"Business Growing\",\"Company Profile Build\",\"Digital Marketing\",\"Duration 5-6Months\",\"30 Social Media Post\",\"\"]', 'Influencer Beauty Makeovers', 'Influencer Beauty Makeovers', '2023-10-17 19:44:14', '2023-10-17 19:44:47'),
(10, 10, 'en', 'Strength Training with Influencers', '<p>This is one of the best WordPress Theme. It is clean, user friendly, fully responsivle, pixel perfect, our modern as design with latest WordPress Technologies. This WordPress theme is perfect for any ki Custom Slider holo the powerfu jemon temon as website.This WordPress Theme has the powerful theme control panel ki holo as with lots It is cleans, user of useful Addons tools to manage the site: Elementor Page Builder, Custom ki Slider, our Custom Icon Font,etc. With as variation and demos I am sure you gonna love it and use it for your next Project.</p>', '[\"30 Social Media Post\",\"Duration 5-6Months\",\"Digital Marketing\",\"Company Profile Build\",\"Business Growing\",\"6 Video Post My Profile\",\"\"]', 'Strength Training with Influencers', 'Strength Training with Influencers', '2023-10-17 19:49:04', '2023-10-17 19:51:43'),
(11, 11, 'en', 'Makeup Magic with Two Influencers', '<p>This is one of the best WordPress Theme. It is clean, user friendly, fully responsivle, pixel perfect, our modern as design with latest WordPress Technologies. This WordPress theme is perfect for any ki Custom Slider holo the powerfu jemon temon as website.This WordPress Theme has the powerful theme control panel ki holo as with lots It is cleans, user of useful Addons tools to manage the site: Elementor Page Builder, Custom ki Slider, our Custom Icon Font,etc. With as variation and demos I am sure you gonna love it and use it for your next Project.</p>', '[\"6 Video Post My Profile\",\"Business Growing\",\"Company Profile Build\",\"Digital Marketing\",\"Duration 5-6Months\",\"30 Social Media Post\",\"\"]', 'Makeup Magic with Two Influencers', 'Makeup Magic with Two Influencers', '2023-10-17 19:51:05', '2023-10-17 19:52:35'),
(12, 1, 'ar', 'كهرباء في ملابس العمل مكيف مفتوح', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"rtl\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">هذه واحدة من أفضل سمات WordPress. إنه نظيف، وسهل الاستخدام، ومسؤول بالكامل، ومثالي للبيكسل، وتصميمنا حديث مع أحدث تقنيات WordPress. يعد موضوع WordPress هذا مثاليًا لأي ki Custom Slider holo the powerfu jemon temon كموقع ويب. يحتوي موضوع WordPress هذا على لوحة تحكم قوية للموضوع ki holo كما هو الحال مع الكثير، فهو ينظف ويستخدم أدوات إضافية مفيدة لإدارة الموقع: Elementor Page Builder، شريط تمرير ki المخصص وخط الأيقونة المخصص لدينا وما إلى ذلك. مع التنوع والعروض التوضيحية، أنا متأكد من أنك ستحبه وستستخدمه في مشروعك القادم.</span></pre>', '[\"30 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629 \\u0639\\u0644\\u0649 \\u0648\\u0633\\u0627\\u0626\\u0644 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a\",\"\\u0627\\u0644\\u0645\\u062f\\u0629 5-6 \\u0623\\u0634\\u0647\\u0631\",\"\\u0627\\u0644\\u062a\\u0633\\u0648\\u064a\\u0642 \\u0627\\u0644\\u0631\\u0642\\u0645\\u064a\",\"\\u0628\\u0646\\u0627\\u0621 \\u0645\\u0644\\u0641 \\u062a\\u0639\\u0631\\u064a\\u0641 \\u0627\\u0644\\u0634\\u0631\\u0643\\u0629\",\"\\u0646\\u0645\\u0648 \\u0627\\u0644\\u0623\\u0639\\u0645\\u0627\\u0644\",\"6 \\u0641\\u064a\\u062f\\u064a\\u0648 \\u0646\\u0634\\u0631 \\u0645\\u0644\\u0641\\u064a \\u0627\\u0644\\u0634\\u062e\\u0635\\u064a\",\"\"]', 'كهرباء في ملابس العمل مكيف مفتوح', 'كهرباء في ملابس العمل مكيف مفتوح', '2023-10-17 23:04:37', '2023-10-18 17:30:16'),
(13, 2, 'ar', 'سيدة سعيدة في تنورة أنيقة القارب', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"rtl\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">هذه واحدة من أفضل سمات WordPress. إنه نظيف، وسهل الاستخدام، ومسؤول بالكامل، ومثالي للبيكسل، وتصميمنا حديث مع أحدث تقنيات WordPress. يعد موضوع WordPress هذا مثاليًا لأي ki Custom Slider holo the powerfu jemon temon كموقع ويب. يحتوي موضوع WordPress هذا على لوحة تحكم قوية للموضوع ki holo كما هو الحال مع الكثير، فهو ينظف ويستخدم أدوات إضافية مفيدة لإدارة الموقع: Elementor Page Builder، شريط تمرير ki المخصص وخط الأيقونة المخصص لدينا وما إلى ذلك. مع التنوع والعروض التوضيحية، أنا متأكد من أنك ستحبه وستستخدمه في مشروعك القادم.</span></pre>', '[\"30 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629 \\u0639\\u0644\\u0649 \\u0648\\u0633\\u0627\\u0626\\u0644 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a\",\"\\u0627\\u0644\\u0645\\u062f\\u0629 5-6 \\u0623\\u0634\\u0647\\u0631\",\"\\u0627\\u0644\\u062a\\u0633\\u0648\\u064a\\u0642 \\u0627\\u0644\\u0631\\u0642\\u0645\\u064a\",\"\\u0628\\u0646\\u0627\\u0621 \\u0645\\u0644\\u0641 \\u062a\\u0639\\u0631\\u064a\\u0641 \\u0627\\u0644\\u0634\\u0631\\u0643\\u0629\",\"\\u0646\\u0645\\u0648 \\u0627\\u0644\\u0623\\u0639\\u0645\\u0627\\u0644\",\"6 \\u0641\\u064a\\u062f\\u064a\\u0648 \\u0646\\u0634\\u0631 \\u0645\\u0644\\u0641\\u064a \\u0627\\u0644\\u0634\\u062e\\u0635\\u064a\",\"\"]', 'سيدة سعيدة في تنورة أنيقة القارب', 'سيدة سعيدة في تنورة أنيقة القارب', '2023-10-17 23:04:37', '2023-10-18 17:36:46'),
(14, 3, 'ar', 'الوقوف عند بوابات المعبد في ليم', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"rtl\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">هذه واحدة من أفضل سمات WordPress. إنه نظيف، وسهل الاستخدام، ومسؤول بالكامل، ومثالي للبيكسل، وتصميمنا حديث مع أحدث تقنيات WordPress. يعد موضوع WordPress هذا مثاليًا لأي ki Custom Slider holo the powerfu jemon temon كموقع ويب. يحتوي موضوع WordPress هذا على لوحة تحكم قوية للموضوع ki holo كما هو الحال مع الكثير، فهو ينظف ويستخدم أدوات إضافية مفيدة لإدارة الموقع: Elementor Page Builder، شريط تمرير ki المخصص وخط الأيقونة المخصص لدينا وما إلى ذلك. مع التنوع والعروض التوضيحية، أنا متأكد من أنك ستحبه وستستخدمه في مشروعك القادم.</span></pre>', '[\"30 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629 \\u0639\\u0644\\u0649 \\u0648\\u0633\\u0627\\u0626\\u0644 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a\",\"\\u0627\\u0644\\u0645\\u062f\\u0629 5-6 \\u0623\\u0634\\u0647\\u0631\",\"\\u0627\\u0644\\u062a\\u0633\\u0648\\u064a\\u0642 \\u0627\\u0644\\u0631\\u0642\\u0645\\u064a\",\"\\u0628\\u0646\\u0627\\u0621 \\u0645\\u0644\\u0641 \\u062a\\u0639\\u0631\\u064a\\u0641 \\u0627\\u0644\\u0634\\u0631\\u0643\\u0629\",\"\\u0646\\u0645\\u0648 \\u0627\\u0644\\u0623\\u0639\\u0645\\u0627\\u0644\",\"6 \\u0641\\u064a\\u062f\\u064a\\u0648 \\u0646\\u0634\\u0631 \\u0645\\u0644\\u0641\\u064a \\u0627\\u0644\\u0634\\u062e\\u0635\\u064a\",\"\"]', 'الوقوف عند بوابات المعبد في ليم', 'الوقوف عند بوابات المعبد في ليم', '2023-10-17 23:04:37', '2023-10-18 17:37:45'),
(15, 4, 'ar', 'فتاتان تقومان بوضع المكياج', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"rtl\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">هذه واحدة من أفضل سمات WordPress. إنه نظيف، وسهل الاستخدام، ومسؤول بالكامل، ومثالي للبيكسل، وتصميمنا حديث مع أحدث تقنيات WordPress. يعد موضوع WordPress هذا مثاليًا لأي ki Custom Slider holo the powerfu jemon temon كموقع ويب. يحتوي موضوع WordPress هذا على لوحة تحكم قوية للموضوع ki holo كما هو الحال مع الكثير، فهو ينظف ويستخدم أدوات إضافية مفيدة لإدارة الموقع: Elementor Page Builder، شريط تمرير ki المخصص وخط الأيقونة المخصص لدينا وما إلى ذلك. مع التنوع والعروض التوضيحية، أنا متأكد من أنك ستحبه وستستخدمه في مشروعك القادم.</span></pre>', '[\"30 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629 \\u0639\\u0644\\u0649 \\u0648\\u0633\\u0627\\u0626\\u0644 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a\",\"\\u0627\\u0644\\u0645\\u062f\\u0629 5-6 \\u0623\\u0634\\u0647\\u0631\",\"\\u0627\\u0644\\u062a\\u0633\\u0648\\u064a\\u0642 \\u0627\\u0644\\u0631\\u0642\\u0645\\u064a\",\"\\u0628\\u0646\\u0627\\u0621 \\u0645\\u0644\\u0641 \\u062a\\u0639\\u0631\\u064a\\u0641 \\u0627\\u0644\\u0634\\u0631\\u0643\\u0629\",\"\\u0646\\u0645\\u0648 \\u0627\\u0644\\u0623\\u0639\\u0645\\u0627\\u0644\",\"6 \\u0641\\u064a\\u062f\\u064a\\u0648 \\u0646\\u0634\\u0631 \\u0645\\u0644\\u0641\\u064a \\u0627\\u0644\\u0634\\u062e\\u0635\\u064a\",\"\"]', 'فتاتان تقومان بوضع المكياج', 'فتاتان تقومان بوضع المكياج', '2023-10-17 23:04:37', '2023-10-18 17:39:30'),
(16, 5, 'ar', 'الرجل القوي تدريب الرجل الأسود', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"rtl\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">هذه واحدة من أفضل سمات WordPress. إنه نظيف، وسهل الاستخدام، ومسؤول بالكامل، ومثالي للبيكسل، وتصميمنا حديث مع أحدث تقنيات WordPress. يعد موضوع WordPress هذا مثاليًا لأي ki Custom Slider holo the powerfu jemon temon كموقع ويب. يحتوي موضوع WordPress هذا على لوحة تحكم قوية للموضوع ki holo كما هو الحال مع الكثير، فهو ينظف ويستخدم أدوات إضافية مفيدة لإدارة الموقع: Elementor Page Builder، شريط تمرير ki المخصص وخط الأيقونة المخصص لدينا وما إلى ذلك. مع التنوع والعروض التوضيحية، أنا متأكد من أنك ستحبه وستستخدمه في مشروعك القادم.</span></pre>', '[\"30 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629 \\u0639\\u0644\\u0649 \\u0648\\u0633\\u0627\\u0626\\u0644 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a\",\"\\u0627\\u0644\\u0645\\u062f\\u0629 5-6 \\u0623\\u0634\\u0647\\u0631\",\"\\u0627\\u0644\\u062a\\u0633\\u0648\\u064a\\u0642 \\u0627\\u0644\\u0631\\u0642\\u0645\\u064a\",\"\\u0628\\u0646\\u0627\\u0621 \\u0645\\u0644\\u0641 \\u062a\\u0639\\u0631\\u064a\\u0641 \\u0627\\u0644\\u0634\\u0631\\u0643\\u0629\",\"\\u0646\\u0645\\u0648 \\u0627\\u0644\\u0623\\u0639\\u0645\\u0627\\u0644\",\"6 \\u0641\\u064a\\u062f\\u064a\\u0648 \\u0646\\u0634\\u0631 \\u0645\\u0644\\u0641\\u064a \\u0627\\u0644\\u0634\\u062e\\u0635\\u064a\",\"\"]', 'الرجل القوي تدريب الرجل الأسود', 'الرجل القوي تدريب الرجل الأسود', '2023-10-17 23:04:37', '2023-10-18 17:39:59'),
(17, 6, 'ar', 'الأسلوب يلتقي بالتأثير: خدمات خزانة الملابس', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"rtl\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">هذه واحدة من أفضل سمات WordPress. إنه نظيف، وسهل الاستخدام، ومسؤول بالكامل، ومثالي للبيكسل، وتصميمنا حديث مع أحدث تقنيات WordPress. يعد موضوع WordPress هذا مثاليًا لأي ki Custom Slider holo the powerfu jemon temon كموقع ويب. يحتوي موضوع WordPress هذا على لوحة تحكم قوية للموضوع ki holo كما هو الحال مع الكثير، فهو ينظف ويستخدم أدوات إضافية مفيدة لإدارة الموقع: Elementor Page Builder، شريط تمرير ki المخصص وخط الأيقونة المخصص لدينا وما إلى ذلك. مع التنوع والعروض التوضيحية، أنا متأكد من أنك ستحبه وستستخدمه في مشروعك القادم.</span></pre>', '[\"30 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629 \\u0639\\u0644\\u0649 \\u0648\\u0633\\u0627\\u0626\\u0644 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a\",\"\\u0627\\u0644\\u0645\\u062f\\u0629 5-6 \\u0623\\u0634\\u0647\\u0631\",\"\\u0627\\u0644\\u062a\\u0633\\u0648\\u064a\\u0642 \\u0627\\u0644\\u0631\\u0642\\u0645\\u064a\",\"\\u0628\\u0646\\u0627\\u0621 \\u0645\\u0644\\u0641 \\u062a\\u0639\\u0631\\u064a\\u0641 \\u0627\\u0644\\u0634\\u0631\\u0643\\u0629\",\"\\u0646\\u0645\\u0648 \\u0627\\u0644\\u0623\\u0639\\u0645\\u0627\\u0644\",\"6 \\u0641\\u064a\\u062f\\u064a\\u0648 \\u0646\\u0634\\u0631 \\u0645\\u0644\\u0641\\u064a \\u0627\\u0644\\u0634\\u062e\\u0635\\u064a\",\"\"]', 'الأسلوب يلتقي بالتأثير: خدمات خزانة الملابس', 'الأسلوب يلتقي بالتأثير: خدمات خزانة الملابس', '2023-10-17 23:04:37', '2023-10-18 17:40:35'),
(18, 7, 'ar', 'تنشيط المؤثرات الكهربائية', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"rtl\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">هذه واحدة من أفضل سمات WordPress. إنه نظيف، وسهل الاستخدام، ومسؤول بالكامل، ومثالي للبيكسل، وتصميمنا حديث مع أحدث تقنيات WordPress. يعد موضوع WordPress هذا مثاليًا لأي ki Custom Slider holo the powerfu jemon temon كموقع ويب. يحتوي موضوع WordPress هذا على لوحة تحكم قوية للموضوع ki holo كما هو الحال مع الكثير، فهو ينظف ويستخدم أدوات إضافية مفيدة لإدارة الموقع: Elementor Page Builder، شريط تمرير ki المخصص وخط الأيقونة المخصص لدينا وما إلى ذلك. مع التنوع والعروض التوضيحية، أنا متأكد من أنك ستحبه وستستخدمه في مشروعك القادم.</span></pre>', '[\"30 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629 \\u0639\\u0644\\u0649 \\u0648\\u0633\\u0627\\u0626\\u0644 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a\",\"\\u0627\\u0644\\u0645\\u062f\\u0629 5-6 \\u0623\\u0634\\u0647\\u0631\",\"\\u0627\\u0644\\u062a\\u0633\\u0648\\u064a\\u0642 \\u0627\\u0644\\u0631\\u0642\\u0645\\u064a\",\"\\u0628\\u0646\\u0627\\u0621 \\u0645\\u0644\\u0641 \\u062a\\u0639\\u0631\\u064a\\u0641 \\u0627\\u0644\\u0634\\u0631\\u0643\\u0629\",\"\\u0646\\u0645\\u0648 \\u0627\\u0644\\u0623\\u0639\\u0645\\u0627\\u0644\",\"6 \\u0641\\u064a\\u062f\\u064a\\u0648 \\u0646\\u0634\\u0631 \\u0645\\u0644\\u0641\\u064a \\u0627\\u0644\\u0634\\u062e\\u0635\\u064a\",\"\"]', 'تنشيط المؤثرات الكهربائية', 'تنشيط المؤثرات الكهربائية', '2023-10-17 23:04:38', '2023-10-18 17:41:05'),
(19, 8, 'ar', 'إطلاق العنان للمؤثرين: برامج التدريب', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"rtl\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">هذه واحدة من أفضل سمات WordPress. إنه نظيف، وسهل الاستخدام، ومسؤول بالكامل، ومثالي للبيكسل، وتصميمنا حديث مع أحدث تقنيات WordPress. يعد موضوع WordPress هذا مثاليًا لأي ki Custom Slider holo the powerfu jemon temon كموقع ويب. يحتوي موضوع WordPress هذا على لوحة تحكم قوية للموضوع ki holo كما هو الحال مع الكثير، فهو ينظف ويستخدم أدوات إضافية مفيدة لإدارة الموقع: Elementor Page Builder، شريط تمرير ki المخصص وخط الأيقونة المخصص لدينا وما إلى ذلك. مع التنوع والعروض التوضيحية، أنا متأكد من أنك ستحبه وستستخدمه في مشروعك القادم.</span></pre>', '[\"30 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629 \\u0639\\u0644\\u0649 \\u0648\\u0633\\u0627\\u0626\\u0644 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a\",\"\\u0627\\u0644\\u0645\\u062f\\u0629 5-6 \\u0623\\u0634\\u0647\\u0631\",\"\\u0627\\u0644\\u062a\\u0633\\u0648\\u064a\\u0642 \\u0627\\u0644\\u0631\\u0642\\u0645\\u064a\",\"\\u0628\\u0646\\u0627\\u0621 \\u0645\\u0644\\u0641 \\u062a\\u0639\\u0631\\u064a\\u0641 \\u0627\\u0644\\u0634\\u0631\\u0643\\u0629\",\"\\u0646\\u0645\\u0648 \\u0627\\u0644\\u0623\\u0639\\u0645\\u0627\\u0644\",\"6 \\u0641\\u064a\\u062f\\u064a\\u0648 \\u0646\\u0634\\u0631 \\u0645\\u0644\\u0641\\u064a \\u0627\\u0644\\u0634\\u062e\\u0635\\u064a\",\"\"]', 'إطلاق العنان للمؤثرين: برامج التدريب', 'إطلاق العنان للمؤثرين: برامج التدريب', '2023-10-17 23:04:38', '2023-10-18 17:47:59'),
(20, 9, 'ar', 'صانعي الجمال المؤثرين', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"rtl\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">هذه واحدة من أفضل سمات WordPress. إنه نظيف، وسهل الاستخدام، ومسؤول بالكامل، ومثالي للبيكسل، وتصميمنا حديث مع أحدث تقنيات WordPress. يعد موضوع WordPress هذا مثاليًا لأي ki Custom Slider holo the powerfu jemon temon كموقع ويب. يحتوي موضوع WordPress هذا على لوحة تحكم قوية للموضوع ki holo كما هو الحال مع الكثير، فهو ينظف ويستخدم أدوات إضافية مفيدة لإدارة الموقع: Elementor Page Builder، شريط تمرير ki المخصص وخط الأيقونة المخصص لدينا وما إلى ذلك. مع التنوع والعروض التوضيحية، أنا متأكد من أنك ستحبه وستستخدمه في مشروعك القادم.</span></pre>', '[\"30 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629 \\u0639\\u0644\\u0649 \\u0648\\u0633\\u0627\\u0626\\u0644 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a\",\"\\u0627\\u0644\\u0645\\u062f\\u0629 5-6 \\u0623\\u0634\\u0647\\u0631\",\"\\u0627\\u0644\\u062a\\u0633\\u0648\\u064a\\u0642 \\u0627\\u0644\\u0631\\u0642\\u0645\\u064a\",\"\\u0628\\u0646\\u0627\\u0621 \\u0645\\u0644\\u0641 \\u062a\\u0639\\u0631\\u064a\\u0641 \\u0627\\u0644\\u0634\\u0631\\u0643\\u0629\",\"\\u0646\\u0645\\u0648 \\u0627\\u0644\\u0623\\u0639\\u0645\\u0627\\u0644\",\"6 \\u0641\\u064a\\u062f\\u064a\\u0648 \\u0646\\u0634\\u0631 \\u0645\\u0644\\u0641\\u064a \\u0627\\u0644\\u0634\\u062e\\u0635\\u064a\",\"\"]', 'صانعي الجمال المؤثرين', 'صانعي الجمال المؤثرين', '2023-10-17 23:04:38', '2023-10-18 17:50:34'),
(21, 10, 'ar', 'تدريب القوة مع المؤثرين', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"rtl\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">هذه واحدة من أفضل سمات WordPress. إنه نظيف، وسهل الاستخدام، ومسؤول بالكامل، ومثالي للبيكسل، وتصميمنا حديث مع أحدث تقنيات WordPress. يعد موضوع WordPress هذا مثاليًا لأي ki Custom Slider holo the powerfu jemon temon كموقع ويب. يحتوي موضوع WordPress هذا على لوحة تحكم قوية للموضوع ki holo كما هو الحال مع الكثير، فهو ينظف ويستخدم أدوات إضافية مفيدة لإدارة الموقع: Elementor Page Builder، شريط تمرير ki المخصص وخط الأيقونة المخصص لدينا وما إلى ذلك. مع التنوع والعروض التوضيحية، أنا متأكد من أنك ستحبه وستستخدمه في مشروعك القادم.</span></pre>', '[\"30 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629 \\u0639\\u0644\\u0649 \\u0648\\u0633\\u0627\\u0626\\u0644 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a\",\"\\u0627\\u0644\\u0645\\u062f\\u0629 5-6 \\u0623\\u0634\\u0647\\u0631\",\"\\u0627\\u0644\\u062a\\u0633\\u0648\\u064a\\u0642 \\u0627\\u0644\\u0631\\u0642\\u0645\\u064a\",\"\\u0628\\u0646\\u0627\\u0621 \\u0645\\u0644\\u0641 \\u062a\\u0639\\u0631\\u064a\\u0641 \\u0627\\u0644\\u0634\\u0631\\u0643\\u0629\",\"\\u0646\\u0645\\u0648 \\u0627\\u0644\\u0623\\u0639\\u0645\\u0627\\u0644\",\"6 \\u0641\\u064a\\u062f\\u064a\\u0648 \\u0646\\u0634\\u0631 \\u0645\\u0644\\u0641\\u064a \\u0627\\u0644\\u0634\\u062e\\u0635\\u064a\",\"\"]', 'تدريب القوة مع المؤثرين', 'تدريب القوة مع المؤثرين', '2023-10-17 23:04:38', '2023-10-18 17:51:02'),
(22, 11, 'ar', 'سحر الماكياج مع اثنين من المؤثرين', '<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"rtl\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">هذه واحدة من أفضل سمات WordPress. إنه نظيف، وسهل الاستخدام، ومسؤول بالكامل، ومثالي للبيكسل، وتصميمنا حديث مع أحدث تقنيات WordPress. يعد موضوع WordPress هذا مثاليًا لأي ki Custom Slider holo the powerfu jemon temon كموقع ويب. يحتوي موضوع WordPress هذا على لوحة تحكم قوية للموضوع ki holo كما هو الحال مع الكثير، فهو ينظف ويستخدم أدوات إضافية مفيدة لإدارة الموقع: Elementor Page Builder، شريط تمرير ki المخصص وخط الأيقونة المخصص لدينا وما إلى ذلك. مع التنوع والعروض التوضيحية، أنا متأكد من أنك ستحبه وستستخدمه في مشروعك القادم.</span></pre>', '[\"30 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629 \\u0639\\u0644\\u0649 \\u0648\\u0633\\u0627\\u0626\\u0644 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a\",\"\\u0627\\u0644\\u0645\\u062f\\u0629 5-6 \\u0623\\u0634\\u0647\\u0631\",\"\\u0627\\u0644\\u062a\\u0633\\u0648\\u064a\\u0642 \\u0627\\u0644\\u0631\\u0642\\u0645\\u064a\",\"\\u0628\\u0646\\u0627\\u0621 \\u0645\\u0644\\u0641 \\u062a\\u0639\\u0631\\u064a\\u0641 \\u0627\\u0644\\u0634\\u0631\\u0643\\u0629\",\"\\u0646\\u0645\\u0648 \\u0627\\u0644\\u0623\\u0639\\u0645\\u0627\\u0644\",\"6 \\u0641\\u064a\\u062f\\u064a\\u0648 \\u0646\\u0634\\u0631 \\u0645\\u0644\\u0641\\u064a \\u0627\\u0644\\u0634\\u062e\\u0635\\u064a\",\"\"]', 'سحر الماكياج مع اثنين من المؤثرين', 'سحر الماكياج مع اثنين من المؤثرين', '2023-10-17 23:04:38', '2023-10-18 17:51:30'),
(23, 12, 'en', 'ABC', '<p>sfsfsdf</p>', '[\"fsdfdsf\",\"sfsdfdsf\",\"\"]', 'ABC', 'ABC', '2025-02-02 06:34:39', '2025-02-02 06:34:39'),
(24, 12, 'ar', 'ABC', '<p>sfsfsdf</p>', '[\"fsdfdsf\",\"sfsdfdsf\",\"\"]', 'ABC', 'ABC', '2025-02-02 06:34:39', '2025-02-02 06:34:39'),
(25, 13, 'en', 'Test Service For Testing', '<p><strong>safsdfswgswfgsagsag</strong></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', '[\"xcbxcbxcbxc\",\"xcvbxcbxcbxcb\",\"xbcxbcxbxcbx\",\"xcxbxcbxcb\",\"\"]', 'Test Service For Testing', 'Test Service For Testing', '2025-02-04 05:47:46', '2025-02-04 05:53:40'),
(26, 13, 'ar', 'Test Service For Testing', '<p><strong>safsdfswgswfgsagsag</strong></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', '[\"xcbxcbxcbxc\",\"xcvbxcbxcbxcb\",\"xbcxbcxbxcbx\",\"xcxbxcbxcb\"]', 'Test Service For Testing', 'Test Service For Testing', '2025-02-04 05:47:46', '2025-02-04 05:47:46'),
(39, 20, 'en', 'gdsgsdg', '<p>sfswafd</p>', '[\"sfsfds\",\"\"]', 'gdsgsdg', 'gdsgsdg', '2025-02-08 06:23:53', '2025-02-08 06:38:14'),
(40, 20, 'ar', 'gdsgsdg', '<p>sfswafd</p>', '[\"sfsfds\"]', 'gdsgsdg', 'gdsgsdg', '2025-02-08 06:23:53', '2025-02-08 06:23:53'),
(41, 21, 'en', 'John Doe', '<p>adasdasd</p>', '[\"\"]', 'John Doe', 'John Doe', '2025-02-08 06:34:26', '2025-02-08 06:34:26'),
(42, 21, 'ar', 'John Doe', '<p>adasdasd</p>', '[\"\"]', 'John Doe', 'John Doe', '2025-02-08 06:34:26', '2025-02-08 06:34:26'),
(43, 22, 'en', 'asfsaf', '<p>sdfsafsdafs</p>', '[\"\"]', 'asfsaf', 'asfsaf', '2025-02-08 06:35:08', '2025-02-08 06:35:08'),
(44, 22, 'ar', 'asfsaf', '<p>sdfsafsdafs</p>', '[\"\"]', 'asfsaf', 'asfsaf', '2025-02-08 06:35:08', '2025-02-08 06:35:08'),
(45, 23, 'en', 'rhgdfgdsfg', '<p>dsgsdgsdg</p>', '[\"\"]', 'rhgdfgdsfg', 'rhgdfgdsfg', '2025-02-08 06:35:51', '2025-02-08 06:35:51'),
(46, 23, 'ar', 'rhgdfgdsfg', '<p>dsgsdgsdg</p>', '[\"\"]', 'rhgdfgdsfg', 'rhgdfgdsfg', '2025-02-08 06:35:51', '2025-02-08 06:35:51'),
(47, 24, 'en', 'Alden Ellison', '<p>dfgdfgfdg</p>', '[\"Omnis architecto mol\",\"\"]', 'Quaerat vero quidem', 'Voluptate mollit dis', '2025-02-08 06:36:22', '2025-02-08 06:39:32'),
(48, 24, 'ar', 'Alden Ellison', '<p>dfgdfgfdg</p>', '[\"Omnis architecto mol\"]', 'Quaerat vero quidem', 'Voluptate mollit dis', '2025-02-08 06:36:22', '2025-02-08 06:36:22'),
(49, 25, 'en', 'May Robertson', '<p>dffd</p>', '[\"Quis dolores volupta\",\"\"]', 'Occaecat dolore exce', 'Et qui nulla facilis', '2025-02-08 06:37:14', '2025-02-08 06:39:06'),
(50, 25, 'ar', 'May Robertson', '<p>dffd</p>', '[\"Quis dolores volupta\"]', 'Occaecat dolore exce', 'Et qui nulla facilis', '2025-02-08 06:37:14', '2025-02-08 06:37:14'),
(51, 26, 'en', 'fdsfsggsd', '<p>dsgvccxvgsfgsd</p>', '[\"sdfdsf\"]', 'fdsfsggsd', 'fdsfsggsd', '2025-02-09 04:54:07', '2025-02-09 04:54:07'),
(52, 26, 'ar', 'fdsfsggsd', '<p>dsgvccxvgsfgsd</p>', '[\"sdfdsf\"]', 'fdsfsggsd', 'fdsfsggsd', '2025-02-09 04:54:07', '2025-02-09 04:54:07'),
(53, 27, 'en', 'Kenneth Garner', '<p>fcbnbn</p>', '[\"Non quam tenetur vit\"]', 'Eum recusandae Volu', 'Dolorem temporibus c', '2025-02-09 05:31:49', '2025-02-09 05:31:49'),
(54, 27, 'ar', 'Kenneth Garner', '<p>fcbnbn</p>', '[\"Non quam tenetur vit\"]', 'Eum recusandae Volu', 'Dolorem temporibus c', '2025-02-09 05:31:49', '2025-02-09 05:31:49'),
(55, 28, 'en', 'sdfsafsf', '<p>sfdsfdsfdsxcvswdf</p>', '[\"sdfdsfdsf\"]', 'sdfsafsf', 'sdfsafsf', '2025-02-09 05:35:21', '2025-02-09 05:35:21'),
(56, 28, 'ar', 'sdfsafsf', '<p>sfdsfdsfdsxcvswdf</p>', '[\"sdfdsfdsf\"]', 'sdfsafsf', 'sdfsafsf', '2025-02-09 05:35:21', '2025-02-09 05:35:21'),
(57, 29, 'en', 'Shea Velazquez', '<p>dsfdsfsd</p>', '[\"Quo aliqua Quasi la\"]', 'Reprehenderit asperi', 'Iste aut dolore quis', '2025-02-09 06:32:23', '2025-02-09 06:32:23'),
(58, 29, 'ar', 'Shea Velazquez', '<p>dsfdsfsd</p>', '[\"Quo aliqua Quasi la\"]', 'Reprehenderit asperi', 'Iste aut dolore quis', '2025-02-09 06:32:23', '2025-02-09 06:32:23'),
(59, 30, 'en', 'Kelsie Morin', '<p>fsdfdsf</p>', '[\"Natus ex unde eos qu\"]', 'Enim ad voluptas ten', 'Blanditiis tempora p', '2025-02-09 10:15:11', '2025-02-09 10:15:11'),
(60, 30, 'ar', 'Kelsie Morin', '<p>fsdfdsf</p>', '[\"Natus ex unde eos qu\"]', 'Enim ad voluptas ten', 'Blanditiis tempora p', '2025-02-09 10:15:11', '2025-02-09 10:15:11'),
(61, 31, 'en', 'Moses Mcfadden', '<p>dsfsfdsfds</p>', '[\"Similique aut cum ut\"]', 'Neque mollitia volup', 'Et et eius duis mole', '2025-02-09 10:19:47', '2025-02-09 10:19:47'),
(62, 31, 'ar', 'Moses Mcfadden', '<p>dsfsfdsfds</p>', '[\"Similique aut cum ut\"]', 'Neque mollitia volup', 'Et et eius duis mole', '2025-02-09 10:19:47', '2025-02-09 10:19:47'),
(63, 32, 'en', 'Fleur Rosales', '<p>dsfsfsfdsfs</p>', '[\"Ullam optio culpa\"]', 'Sit et molestiae sun', 'Voluptatem Non minu', '2025-02-09 10:20:12', '2025-02-09 10:20:12'),
(64, 32, 'ar', 'Fleur Rosales', '<p>dsfsfsfdsfs</p>', '[\"Ullam optio culpa\"]', 'Sit et molestiae sun', 'Voluptatem Non minu', '2025-02-09 10:20:12', '2025-02-09 10:20:12'),
(65, 33, 'en', 'Destiny Hooper', '<p>rfdsfsdfds</p>', '[\"Voluptatem nisi lab\"]', 'Commodo ut elit ali', 'Molestiae id delectu', '2025-02-09 10:58:59', '2025-02-09 10:58:59'),
(66, 33, 'ar', 'Destiny Hooper', '<p>rfdsfsdfds</p>', '[\"Voluptatem nisi lab\"]', 'Commodo ut elit ali', 'Molestiae id delectu', '2025-02-09 10:58:59', '2025-02-09 10:58:59'),
(67, 34, 'en', 'Stephen Oneill', '<p>cZcdzcxasd</p>', '[\"Perspiciatis nisi s\",\"\"]', 'Ex libero sint comm', 'Quia repellendus Co', '2025-02-09 11:27:18', '2025-02-09 11:27:43'),
(68, 34, 'ar', 'Stephen Oneill', '<p>cZcdzcxasd</p>', '[\"Perspiciatis nisi s\"]', 'Ex libero sint comm', 'Quia repellendus Co', '2025-02-09 11:27:18', '2025-02-09 11:27:18'),
(69, 35, 'en', 'Ursula Hartman', '<p>sdfsdfsdf</p>', '[\"Exercitationem venia\"]', 'Consequatur Enim do', 'Eveniet et unde ut', '2025-02-10 03:35:11', '2025-02-10 03:35:11'),
(70, 35, 'ar', 'Ursula Hartman', '<p>sdfsdfsdf</p>', '[\"Exercitationem venia\"]', 'Consequatur Enim do', 'Eveniet et unde ut', '2025-02-10 03:35:11', '2025-02-10 03:35:11'),
(71, 36, 'en', 'Zia Ramirez', '<p>dfgdgd</p>', '[\"Anim rerum aspernatu\"]', 'Eu quia nesciunt ve', 'Ipsum ut obcaecati f', '2025-02-10 03:35:39', '2025-02-10 03:35:39'),
(72, 36, 'ar', 'Zia Ramirez', '<p>dfgdgd</p>', '[\"Anim rerum aspernatu\"]', 'Eu quia nesciunt ve', 'Ipsum ut obcaecati f', '2025-02-10 03:35:39', '2025-02-10 03:35:39'),
(73, 37, 'en', 'Lavinia Cote', '<p>dfgdgd</p>', '[\"Praesentium aperiam\"]', 'Nemo est qui volupt', 'Qui error quis vel m', '2025-02-10 03:36:10', '2025-02-10 03:36:10'),
(74, 37, 'ar', 'Lavinia Cote', '<p>dfgdgd</p>', '[\"Praesentium aperiam\"]', 'Nemo est qui volupt', 'Qui error quis vel m', '2025-02-10 03:36:10', '2025-02-10 03:36:10'),
(75, 38, 'en', 'Garth Alexander', '<p>gfhbdfgd</p>', '[\"Nostrum qui aut expl\",\"\"]', 'Molestiae sint et e', 'Eligendi ullamco iru', '2025-02-10 03:38:11', '2025-02-10 03:50:19'),
(76, 38, 'ar', 'Garth Alexander', '<p>gfhbdfgd</p>', '[\"Nostrum qui aut expl\"]', 'Molestiae sint et e', 'Eligendi ullamco iru', '2025-02-10 03:38:11', '2025-02-10 03:38:11'),
(77, 39, 'en', 'Dennis Pickett', '<p>sdfdsfs</p>', '[\"Minus cillum harum d\"]', 'Debitis pariatur En', 'Dolore in non sed ut', '2025-02-10 03:52:19', '2025-02-10 03:52:19'),
(78, 39, 'ar', 'Dennis Pickett', '<p>sdfdsfs</p>', '[\"Minus cillum harum d\"]', 'Debitis pariatur En', 'Dolore in non sed ut', '2025-02-10 03:52:19', '2025-02-10 03:52:19'),
(79, 40, 'en', 'Indigo Lawson', '<p>fsdfds</p>', '[\"Fugiat officia ut m\"]', 'Odit ducimus velit', 'Quam lorem quo conse', '2025-02-10 04:24:50', '2025-02-10 04:24:50'),
(80, 40, 'ar', 'Indigo Lawson', '<p>fsdfds</p>', '[\"Fugiat officia ut m\"]', 'Odit ducimus velit', 'Quam lorem quo conse', '2025-02-10 04:24:50', '2025-02-10 04:24:50'),
(81, 41, 'en', 'Vera Ortiz', '<p>dsfsdfdsf</p>', '[\"Exercitationem do re\",\"\"]', 'Quaerat reprehenderi', 'Reprehenderit repel', '2025-02-10 04:25:25', '2025-02-16 05:44:49'),
(82, 41, 'ar', 'Vera Ortiz', '<p>dsfsdfdsf</p>', '[\"Exercitationem do re\"]', 'Quaerat reprehenderi', 'Reprehenderit repel', '2025-02-10 04:25:25', '2025-02-10 04:25:25'),
(83, 42, 'en', 'Amos Rowe', '<p>werfsfds</p>', '[\"Quo excepteur quis p\"]', 'Porro ipsa sit cup', 'Dolore maxime quisqu', '2025-02-10 06:15:55', '2025-02-10 06:15:55'),
(84, 42, 'ar', 'Amos Rowe', '<p>werfsfds</p>', '[\"Quo excepteur quis p\"]', 'Porro ipsa sit cup', 'Dolore maxime quisqu', '2025-02-10 06:15:55', '2025-02-10 06:15:55'),
(85, 43, 'en', 'Vera Ortiz', '<p>sfsdfdhfh</p>', '[\"sdfsdf\",\"\"]', 'sdfds', 'sdfsdf', '2025-02-18 12:37:54', '2025-02-18 12:38:14'),
(86, 43, 'ar', 'Vera Ortiz', '<p>sdfsdf</p>', '[\"sdfsdf\",\"\"]', 'sdfds', 'sdfsdf', '2025-02-18 12:37:54', '2025-02-18 12:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_name` varchar(255) DEFAULT NULL,
  `logo` varchar(255) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `text_direction` varchar(255) NOT NULL DEFAULT 'LTR',
  `timezone` varchar(255) DEFAULT NULL,
  `currency_name` varchar(255) DEFAULT NULL,
  `currency_icon` varchar(255) DEFAULT NULL,
  `currency_rate` varchar(255) DEFAULT NULL,
  `default_avatar` varchar(255) DEFAULT NULL,
  `selected_theme` varchar(255) NOT NULL DEFAULT 'theme_one',
  `currency_position` varchar(255) NOT NULL DEFAULT 'before_price',
  `commission_type` varchar(255) NOT NULL DEFAULT 'commission',
  `live_chat` varchar(255) NOT NULL DEFAULT 'disable',
  `app_version` varchar(255) NOT NULL DEFAULT 'Version - 1.1',
  `show_provider_contact_info` varchar(255) NOT NULL DEFAULT 'enable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `footer_logo` varchar(255) NOT NULL,
  `contact_message_mail` varchar(255) DEFAULT NULL,
  `send_contact_message` varchar(255) NOT NULL DEFAULT 'enable',
  `save_contact_message` varchar(255) NOT NULL DEFAULT 'enable',
  `error_image` varchar(255) DEFAULT NULL,
  `breadcrumb_image` varchar(255) DEFAULT NULL,
  `preloader_status` varchar(10) NOT NULL DEFAULT 'disable',
  `login_page_bg` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `about_us` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `open_day` varchar(255) DEFAULT NULL,
  `closed_day` varchar(255) DEFAULT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `behance` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `app_name`, `logo`, `favicon`, `text_direction`, `timezone`, `currency_name`, `currency_icon`, `currency_rate`, `default_avatar`, `selected_theme`, `currency_position`, `commission_type`, `live_chat`, `app_version`, `show_provider_contact_info`, `created_at`, `updated_at`, `footer_logo`, `contact_message_mail`, `send_contact_message`, `save_contact_message`, `error_image`, `breadcrumb_image`, `preloader_status`, `login_page_bg`, `email`, `phone`, `about_us`, `address`, `open_day`, `closed_day`, `copyright`, `twitter`, `behance`, `instagram`, `linkedin`, `facebook`) VALUES
(1, 'Inflanar', 'uploads/website-images/logo-2024-02-07-08-40-06-4525.png', 'uploads/website-images/favicon-2024-02-07-08-40-31-1444.png', '', 'Asia/Dhaka', 'USD', '$', NULL, 'uploads/website-images/default-avatar-2023-10-14-10-09-11-1760.jpg', 'theme_one', 'before_price', 'subscription', '', '3.0.0', '', NULL, '2025-02-18 08:40:17', 'uploads/website-images/logo-2023-08-22-09-14-55-4248.png', 'demo@gmail.com', 'enable', 'enable', 'uploads/website-images/error-image-2023-08-28-06-15-35-6002.png', 'uploads/website-images/breadcrumb-image-2023-10-16-04-11-05-8079.png', 'disable', 'uploads/website-images/login-image-2023-10-10-06-58-22-7400.png', 'user@gmail.com', '123-343-4444', 'Want to Create Something Great Together?', '27 NW New Vexmont, 3 No Tejturi Bazar West, Panthapath North, Dhaka 1215', 'Mon - Fri: 7.00am - 6.00pm', 'Sat: 7.00am - 6.00pm', 'Copyright 2023, QuomodoSoft. All Rights Reserved.', 'https://www.twitter.com', 'https://www.behance.com', 'https://www.instagram.com', 'https://www.linkedin.com', 'https://www.facebook.com');

-- --------------------------------------------------------

--
-- Table structure for table `slider_ones`
--

CREATE TABLE `slider_ones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tags` text DEFAULT NULL,
  `client_qty` varchar(255) DEFAULT NULL,
  `client_image` varchar(255) DEFAULT NULL,
  `home1_feature_image` varchar(255) DEFAULT NULL,
  `home2_feature_image` varchar(255) DEFAULT NULL,
  `home3_feature_image` varchar(255) DEFAULT NULL,
  `home2_bg` varchar(255) DEFAULT NULL,
  `social1` varchar(255) DEFAULT NULL,
  `social2` varchar(255) DEFAULT NULL,
  `social3` varchar(255) DEFAULT NULL,
  `social4` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slider_ones`
--

INSERT INTO `slider_ones` (`id`, `tags`, `client_qty`, `client_image`, `home1_feature_image`, `home2_feature_image`, `home3_feature_image`, `home2_bg`, `social1`, `social2`, `social3`, `social4`, `created_at`, `updated_at`) VALUES
(1, '[{\"value\":\"TikTok\"},{\"value\":\"Facebook\"},{\"value\":\"Instagram\"},{\"value\":\"Linkedin\"},{\"value\":\"Influencer\"}]', '2465', 'uploads/website-images/slider-client-20230904102359.png', 'uploads/website-images/slider-one-feature-20230904102503.png', 'uploads/website-images/slider2-feature-20230904111624.png', 'uploads/website-images/slider3-feature-20230918084831.png', 'uploads/website-images/slider-two-bg-20230904112024.jpg', NULL, NULL, NULL, NULL, NULL, '2023-10-15 20:09:00');

-- --------------------------------------------------------

--
-- Table structure for table `slider_one_translations`
--

CREATE TABLE `slider_one_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slider_one_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `home1_title` text DEFAULT NULL,
  `home1_header` text DEFAULT NULL,
  `home2_title` text DEFAULT NULL,
  `home2_header` text DEFAULT NULL,
  `home3_title` text DEFAULT NULL,
  `home3_header` text DEFAULT NULL,
  `home3_item1` text DEFAULT NULL,
  `home3_item2` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slider_one_translations`
--

INSERT INTO `slider_one_translations` (`id`, `slider_one_id`, `lang_code`, `home1_title`, `home1_header`, `home2_title`, `home2_header`, `home3_title`, `home3_header`, `home3_item1`, `home3_item2`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'GO TO YOUR INFLUENCER PLATFROM', 'The Right <span>Influencer </span> For Your Business', 'GO TO YOUR INFLUENCER PLATFROM', 'Get the Best <span>Influencer </span> Media Marketing', 'GO TO YOUR INFLUENCER PLATFROM', 'Meet the Influencer Who\'s Taking the World by Storm', 'Connect with Brands', 'Trusted by Over 25,000 Creators', NULL, '2023-09-04 05:45:17'),
(15, 1, 'ar', 'انتقل إلى منصة المؤثرين الخاصة بك', '<span>المؤثر</span> المناسب لشركتك', 'انتقل إلى منصة المؤثرين الخاصة بك', 'احصل على أفضل <span>مؤثر</span> في التسويق عبر وسائل الإعلام', 'انتقل إلى منصة المؤثرين الخاصة بك', 'تعرف على المؤثر الذي اجتاح العالم', 'تواصل مع العلامات التجارية', 'موثوق به من قبل أكثر من 25000 منشئ المحتوى', '2023-10-17 23:04:37', '2023-10-18 15:05:03');

-- --------------------------------------------------------

--
-- Table structure for table `social_login_infos`
--

CREATE TABLE `social_login_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_facebook` int(11) NOT NULL DEFAULT 0,
  `facebook_client_id` text DEFAULT NULL,
  `facebook_secret_id` text DEFAULT NULL,
  `facebook_ca` text DEFAULT NULL,
  `is_gmail` int(11) NOT NULL DEFAULT 0,
  `gmail_client_id` text DEFAULT NULL,
  `gmail_secret_id` text DEFAULT NULL,
  `facebook_redirect_url` text DEFAULT NULL,
  `gmail_redirect_url` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_login_infos`
--

INSERT INTO `social_login_infos` (`id`, `is_facebook`, `facebook_client_id`, `facebook_secret_id`, `facebook_ca`, `is_gmail`, `gmail_client_id`, `gmail_secret_id`, `facebook_redirect_url`, `gmail_redirect_url`, `created_at`, `updated_at`) VALUES
(1, 1, '1844188565781706', 'f32f45abcf57a4dc23ac6f2b2e8e2241', NULL, 1, '673210704627-g002lb3mstedn57b4geupsfhakcqo316.apps.googleusercontent.com', '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', 'http://localhost/web-solution-us/open-ai/callback/google', 'http://127.0.0.1:8000/callback/google', NULL, '2023-10-10 06:20:55');

-- --------------------------------------------------------

--
-- Table structure for table `stripe_payments`
--

CREATE TABLE `stripe_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `stripe_key` text DEFAULT NULL,
  `stripe_secret` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `country_code` varchar(10) NOT NULL,
  `currency_code` varchar(10) NOT NULL,
  `currency_rate` double NOT NULL,
  `image` text DEFAULT NULL,
  `currency_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stripe_payments`
--

INSERT INTO `stripe_payments` (`id`, `status`, `stripe_key`, `stripe_secret`, `created_at`, `updated_at`, `country_code`, `currency_code`, `currency_rate`, `image`, `currency_id`) VALUES
(1, 1, 'pk_test_51QokzfBR2bUrg2dgr5z02nK7uLOaC3BnfYVM8VZ74FEDirzsgxfuwf1fYLSGWVap4HfNxxsSXbpfVehlyZG9BuDU00dWn5nZMy', 'sk_test_51QokzfBR2bUrg2dge0hGdV57vPBUkR1NPy13TVWWROCs9H1H9ecT4Kwqie2Tl6Q6ykly3I26qU5lFAj1wK1PRRAH00zGbqtDds', NULL, '2025-02-04 13:17:43', 'US', 'USD', 1, 'uploads/website-images/stripe-2023-09-28-08-41-34-6745.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `verified_token` text DEFAULT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_fees`
--

CREATE TABLE `subscription_fees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fees_type` enum('fixed','percentage') NOT NULL,
  `fees` varchar(255) NOT NULL,
  `user_type` enum('business','influencer') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_fees`
--

INSERT INTO `subscription_fees` (`id`, `fees_type`, `fees`, `user_type`, `created_at`, `updated_at`) VALUES
(1, 'percentage', '5', 'business', '2025-02-04 05:06:52', '2025-02-04 05:07:44'),
(2, 'percentage', '10', 'influencer', '2025-02-04 05:07:10', '2025-02-18 12:37:20');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plans`
--

CREATE TABLE `subscription_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `plan_price` varchar(255) NOT NULL,
  `expiration_date` varchar(255) NOT NULL,
  `maximum_service` varchar(255) NOT NULL COMMENT 'max_applies for influencer',
  `status` varchar(255) NOT NULL,
  `serial` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_plans`
--

INSERT INTO `subscription_plans` (`id`, `plan_name`, `plan_price`, `expiration_date`, `maximum_service`, `status`, `serial`, `created_at`, `updated_at`, `type`) VALUES
(1, 'Basic', '0', 'monthly', '3', '1', '1', '2024-07-03 16:15:49', '2024-07-03 16:15:49', 'business'),
(2, 'Silver', '19', 'yearly', '5', '1', '2', '2024-07-03 16:16:09', '2024-07-03 16:17:03', 'business'),
(3, 'Premium', '29', 'yearly', '10', '1', '3', '2024-07-03 16:16:21', '2024-07-03 16:20:54', 'business'),
(4, 'Gold', '49', 'lifetime', '50', '1', '4', '2024-07-03 16:17:28', '2024-07-03 16:17:28', 'business'),
(5, 'dfdf', '34', 'monthly', '5', '0', '2', '2025-02-01 09:10:06', '2025-02-15 03:31:16', 'business'),
(6, 'Silver', '34', 'monthly', '23', '1', '2', '2025-02-01 09:47:10', '2025-02-10 05:52:03', 'influencer'),
(7, 'Free', '0', 'daily', '5', '1', '1', '2025-02-03 07:12:05', '2025-02-03 07:12:05', 'influencer'),
(8, 'Unlimited', '49', 'monthly', '-1', '1', '3', '2025-02-15 03:31:06', '2025-02-15 03:31:06', 'influencer'),
(9, 'xyz', '25', 'monthly', '10', '1', '4', '2025-02-18 12:31:51', '2025-02-18 12:43:03', 'influencer');

-- --------------------------------------------------------

--
-- Table structure for table `tawk_chats`
--

CREATE TABLE `tawk_chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chat_link` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tawk_chats`
--

INSERT INTO `tawk_chats` (`id`, `chat_link`, `status`, `created_at`, `updated_at`) VALUES
(1, 'https://tawk.to/chat/67adc36f3a842732607e3a72/1ijvc6rhh', 1, NULL, '2025-02-15 04:02:33');

-- --------------------------------------------------------

--
-- Table structure for table `term_and_conditions`
--

CREATE TABLE `term_and_conditions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `term_and_conditions`
--

INSERT INTO `term_and_conditions` (`id`, `lang_code`, `description`, `created_at`, `updated_at`) VALUES
(1, 'en', '\r\n<h4>1. What Are Privacy Policy?</h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown our printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriefss asbut also the on leap into a electironc typesetting, remaining as essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andeiss more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n\r\n\r\n<h4>2. Influencer Terms and Conditions Examples</h4>\r\n<p>While it&rsquo;s not legally required for ecommerce websites to have a terms and conditions agreement, adding one will help protect your as sonline business.As terms and conditions are legally enforceable rules, they allow you to set standards for how users interact with your site. Here are some of the major abenefits of including terms and conditions on your ecommerce site:</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the obb1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop.</p>\r\n\r\n\r\n<h4>Features :</h4>\r\n<ul>\r\n<li>slim body with metal cover</li>\r\n<li>latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</li>\r\n<li>8GB DDR4 RAM and fast 512GB PCIe SSD</li>\r\n<li>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture support</li>\r\n</ul>\r\n\r\n\r\n<h4>3. Protect Your Property</h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown as printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining as essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n\r\n\r\n<h4>4. What to Include in Terms and Conditions for Online Stores</h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the as1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic ki typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset as sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type our as specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas Ipsum to make a type specimen book.</p>\r\n\r\n\r\n<h4>05.Pricing and Payment Terms</h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the as 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic as typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen our as book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n', NULL, '2023-10-14 22:28:40'),
(23, 'ar', '<h4 id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"rtl\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\"><strong>1. ما هي سياسة الخصوصية؟ </strong></span></h4>\r\n<pre id=\"tw-target-text\" class=\"tw-data-text tw-text-large tw-ta\" dir=\"rtl\" data-placeholder=\"Translation\" data-ved=\"2ahUKEwiniYyamYGCAxUCxjgGHTdQD9IQ3ewLegQICBAQ\"><span class=\"Y2IQFc\" lang=\"ar\">لوريم إيبسوم هو ببساطة نص وهمي من صناعة الطباعة والتنضيد. لقد كان لوريم إيبسوم هو النص الوهمي القياسي في هذه الصناعة منذ القرن السادس عشر، عندما أخذ شخص غير معروف من مطبعتنا لوح الكتابة وخلطه ليصنع كتابًا نموذجيًا. لقد عاش ليس فقط خمسة قرون، بل قفز أيضًا إلى التنضيد الإلكتروني، وظل كما هو دون تغيير. لم يكن منتشراً في ستينيات القرن الماضي مع إصدار أوراق Letraset التي تحتوي على مقاطع لوريم إيبسوم، ومؤخراً مع ظهور برامج النشر المكتبي مثل Aldus PageMaker والتي تضمنت نسخاً من نص لوريم إيبسوم لإنشاء نماذج من الكتب.</span></pre>\r\n<h4>2. Influencer Terms and Conditions Examples</h4>\r\n<p>While it&rsquo;s not legally required for ecommerce websites to have a terms and conditions agreement, adding one will help protect your as sonline business.As terms and conditions are legally enforceable rules, they allow you to set standards for how users interact with your site. Here are some of the major abenefits of including terms and conditions on your ecommerce site:</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the obb1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop.</p>\r\n<h4>Features :</h4>\r\n<ul>\r\n<li>slim body with metal cover</li>\r\n<li>latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</li>\r\n<li>8GB DDR4 RAM and fast 512GB PCIe SSD</li>\r\n<li>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture support</li>\r\n</ul>\r\n<h4>3. Protect Your Property</h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown as printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining as essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<h4>4. What to Include in Terms and Conditions for Online Stores</h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the as1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic ki typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset as sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type our as specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas Ipsum to make a type specimen book.</p>\r\n<h4>05.Pricing and Payment Terms</h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the as 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic as typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen our as book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', '2023-10-17 23:04:37', '2023-10-18 14:54:30');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `logo`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'uploads/custom-images/john-doe-logo-20231016034733.png', 'uploads/custom-images/john-doe-20231016034733.jpg', 'enable', '2023-10-15 21:47:33', '2023-10-15 21:47:33'),
(2, 'uploads/custom-images/rashaini-chan-logo-20231016041437.png', 'uploads/custom-images/rashaini-chan-20231016041437.jpg', 'enable', '2023-10-15 22:14:37', '2023-10-15 22:14:37'),
(3, 'uploads/custom-images/john-doe-logo-20231016043514.png', 'uploads/custom-images/john-doe-20231016043514.png', 'enable', '2023-10-15 22:35:14', '2023-10-15 22:35:14'),
(4, 'uploads/custom-images/david-richard-logo-20231016043644.png', 'uploads/custom-images/david-richard-20231016043644.png', 'enable', '2023-10-15 22:36:44', '2023-10-15 22:36:44'),
(5, 'uploads/custom-images/daniel-paul-logo-20231016043710.png', 'uploads/custom-images/daniel-paul-20231016043710.png', 'enable', '2023-10-15 22:37:10', '2023-10-15 22:37:10');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial_translations`
--

CREATE TABLE `testimonial_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `testimonial_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonial_translations`
--

INSERT INTO `testimonial_translations` (`id`, `lang_code`, `testimonial_id`, `name`, `designation`, `comment`, `created_at`, `updated_at`) VALUES
(1, 'en', 1, 'John Doe', 'Web Developer', 'Phasellus dapibus erat in lorem malesuada, a cosin Sed molestie nibh vitae pharetra egestas. Vivamusi cibus, egeit commodo odsio vulputate. Praesent as rdum, elit ligula sagittis lacus mauris.', '2023-10-15 21:47:33', '2023-10-15 21:47:33'),
(2, 'en', 2, 'Rashaini Chan', 'Graphic Designer', 'Phasellus dapibus erat in lorem malesuada, a cosin Sed molestie nibh vitae pharetra egestas. Vivamusi cibus, egeit commodo odsio vulputate. Praesent as rdum, elit ligula sagittis lacus mauris.', '2023-10-15 22:14:37', '2023-10-15 22:14:37'),
(3, 'en', 3, 'John Doe', 'MBBS, FCPS, FRCS', 'Phasellus dapibus erat in lorem malesuada, a cosin Sed molestie nibh vitae pharetra egestas. Vivamusi cibus, egeit commodo odsio vulputate. Praesent as rdum, elit ligula sagittis lacus mauris.', '2023-10-15 22:35:14', '2023-10-15 22:35:14'),
(4, 'en', 4, 'David Richard', 'Web Designer', 'Phasellus dapibus erat in lorem malesuada, a cosin Sed molestie nibh vitae pharetra egestas. Vivamusi cibus, egeit commodo odsio vulputate. Praesent as rdum, elit ligula sagittis lacus mauris.', '2023-10-15 22:36:44', '2023-10-15 22:36:44'),
(5, 'en', 5, 'Daniel Paul', 'Graphic Designer', 'Phasellus dapibus erat in lorem malesuada, a cosin Sed molestie nibh vitae pharetra egestas. Vivamusi cibus, egeit commodo odsio vulputate. Praesent as rdum, elit ligula sagittis lacus mauris.', '2023-10-15 22:37:10', '2023-10-15 22:37:10'),
(6, 'ar', 1, 'فلان الفلاني', 'مطور ويب', 'نشأ فاسيلوس دابيبوس في لوريم ماليسودا، وهو ابن عم Sed molestie nibh vitae pharetra egestas. Vivamusi cibus، egeit commodo odsio vulputate. Praesent as rdum، elit ligula sagittis lacus mauris.', '2023-10-17 23:04:37', '2023-10-18 15:11:28'),
(7, 'ar', 2, 'راشيني تشان', 'مصمم جرافيك', 'نشأ فاسيلوس دابيبوس في لوريم ماليسودا، وهو ابن عم Sed molestie nibh vitae pharetra egestas. Vivamusi cibus، egeit commodo odsio vulputate. Praesent as rdum، elit ligula sagittis lacus mauris.', '2023-10-17 23:04:37', '2023-10-18 15:10:56'),
(8, 'ar', 3, 'فلان الفلاني', 'بكالوريوس الطب والجراحة، FCPS، FRCS', 'نشأ فاسيلوس دابيبوس في لوريم ماليسودا، وهو ابن عم Sed molestie nibh vitae pharetra egestas. Vivamusi cibus، egeit commodo odsio vulputate. Praesent as rdum، elit ligula sagittis lacus mauris.', '2023-10-17 23:04:37', '2023-10-18 15:10:32'),
(9, 'ar', 4, 'ديفيد ريتشارد', 'مصمم الويب', 'نشأ فاسيلوس دابيبوس في لوريم ماليسودا، وهو ابن عم Sed molestie nibh vitae pharetra egestas. Vivamusi cibus، egeit commodo odsio vulputate. Praesent as rdum، elit ligula sagittis lacus mauris.', '2023-10-17 23:04:37', '2023-10-18 15:10:07'),
(10, 'ar', 5, 'دانيال بول', 'مصمم جرافيك', 'نشأ فاسيلوس دابيبوس في لوريم ماليسودا، وهو ابن عم Sed molestie nibh vitae pharetra egestas. Vivamusi cibus، egeit commodo odsio vulputate. Praesent as rdum، elit ligula sagittis lacus mauris.', '2023-10-17 23:04:37', '2023-10-18 15:09:30');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` text NOT NULL,
  `ticket_id` varchar(255) NOT NULL,
  `ticket_from` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `subject`, `ticket_id`, `ticket_from`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 'Can&#039;t able to make booking', '1575722976', 'Client', 'in_progress', '2023-10-17 20:11:38', '2023-10-17 20:12:36'),
(2, 5, 'Need help about existing order.', '170215868', 'Client', 'in_progress', '2023-10-17 20:14:56', '2023-10-17 20:15:19'),
(3, 1, 'Service complete request', '1123657647', 'provider', 'in_progress', '2023-10-17 20:25:17', '2023-10-17 20:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_messages`
--

CREATE TABLE `ticket_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `message_from` varchar(255) NOT NULL,
  `unseen_admin` int(11) NOT NULL DEFAULT 0,
  `unseen_user` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_messages`
--

INSERT INTO `ticket_messages` (`id`, `ticket_id`, `user_id`, `admin_id`, `message`, `message_from`, `unseen_admin`, `unseen_user`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 0, 'I&#039;m trying to book the service. but I can&#039;t do it. please help.', 'client', 1, 1, '2023-10-17 20:11:38', '2023-10-17 20:13:48'),
(2, 1, 5, 1, 'Thanks for your contact. you cheated with more client. that\'s why we blocked to you.', 'admin', 1, 1, '2023-10-17 20:12:36', '2023-10-17 20:13:48'),
(3, 1, 5, 0, 'This my fault. I&#039;m sorry, I need same service. please help.', 'client', 1, 1, '2023-10-17 20:13:26', '2023-10-17 20:13:48'),
(4, 1, 5, 0, 'please see my attached documents. I think it will be clear.', 'client', 1, 1, '2023-10-17 20:13:45', '2023-10-17 20:13:48'),
(5, 2, 5, 0, 'The influencer is cheated with me. he is layer. I didn&#039;t complete my job. I want to refund my payment.', 'client', 1, 1, '2023-10-17 20:14:56', '2023-11-01 05:37:35'),
(6, 2, 5, 1, 'Let me check your previous history. please stay with  us.\r\n\r\nThanks', 'admin', 1, 1, '2023-10-17 20:15:19', '2023-11-01 05:37:35'),
(7, 3, 1, 0, 'I have done my task. but the client forcing extra task. but I can do it. please help', 'provider', 1, 1, '2023-10-17 20:25:17', '2025-02-04 13:07:46'),
(8, 3, 1, 1, 'Ok let discuss with client. please stay with us.', 'admin', 1, 1, '2023-10-17 20:26:02', '2025-02-04 13:07:46'),
(9, 3, 1, 1, 'cvcvcv', 'admin', 1, 1, '2023-10-28 19:26:11', '2025-02-04 13:07:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `about_me` text DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `school_name` varchar(255) DEFAULT NULL,
  `school_year` varchar(255) DEFAULT NULL,
  `varsity_name` varchar(255) DEFAULT NULL,
  `varsity_year` varchar(255) DEFAULT NULL,
  `total_follower` varchar(255) DEFAULT NULL,
  `total_following` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `forget_password_token` varchar(255) DEFAULT NULL,
  `is_influencer` varchar(10) NOT NULL DEFAULT 'no' COMMENT 'here influencer means business',
  `status` varchar(10) NOT NULL DEFAULT 'disable',
  `is_banned` varchar(10) NOT NULL DEFAULT 'no',
  `image` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `tiktok` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `provider_id` varchar(255) DEFAULT NULL,
  `forget_password_otp` varchar(255) DEFAULT NULL,
  `email_verified` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `username`, `address`, `country`, `designation`, `about_me`, `tags`, `school_name`, `school_year`, `varsity_name`, `varsity_year`, `total_follower`, `total_following`, `email`, `email_verified_at`, `verification_token`, `password`, `remember_token`, `forget_password_token`, `is_influencer`, `status`, `is_banned`, `image`, `facebook`, `twitter`, `instagram`, `tiktok`, `created_at`, `updated_at`, `provider`, `provider_id`, `forget_password_otp`, `email_verified`) VALUES
(1, 'David Richard', '123-343-4444', 'david-richard-20231016032602', 'Los Angeles, CA, USA', 'United States', 'Digital Marketer', 'Integer fermentum luctus urna non tincidunt risus laoreet in.Vivamus eu dolor lorem.Aenean efficitur urn at est lobortis efficitur.Vestibulum tellus nunc, maximus eget eleifend a, mollis ac turpis. Integer eget our dictum est. Fusce eget pulvinar tor tor. Quisque suscipit ante ac nisi a rutrumnec mollis nulla.', '[{\"value\":\"php\"},{\"value\":\"larave\"},{\"value\":\"html\"},{\"value\":\"csss\"},{\"value\":\"javascript\"}]', 'North South University', 'Aperiam deserunt dol, Burundi 2015 - 2020', 'Independent University BD', 'Aperiam deserunt dol, Burundi 2015 - 2020', '1250K', '12K', 'influencer@gmail.com', '2023-10-15 21:27:31', NULL, '$2y$10$ES/PTk3zo4QPSrupFxUueehhMl3QwoBrpd2yzoQne2acOvZqhMbIK', NULL, NULL, 'yes', 'enable', 'no', 'uploads/custom-images/david-richard-2023-10-16-03-32-15-6862.png', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.instagram.com', 'https://www.tiktok.com', '2023-10-15 21:26:02', '2023-10-15 21:32:16', NULL, NULL, NULL, '0'),
(2, 'Nawyantong', '123-343-4444', 'nawyantong-20231017040916', 'Los Angeles, CA, USA', 'United States', 'Graphic Designer', 'Integer fermentum luctus urna non tincidunt risus laoreet in.Vivamus eu dolor lorem.Aenean efficitur urn at est lobortis efficitur.Vestibulum tellus nunc, maximus eget eleifend a, mollis ac turpis. Integer eget our dictum est. Fusce eget pulvinar tor tor. Quisque suscipit ante ac nisi a rutrumnec mollis nulla.', '[{\"value\":\"larave\"},{\"value\":\"php\"},{\"value\":\"javascript\"},{\"value\":\"jquery\"},{\"value\":\"html\"},{\"value\":\"css\"}]', 'North South University', 'Aperiam deserunt dol, Burundi 2015 - 2020', 'Independent University BD', 'Aperiam deserunt dol, Burundi 2015 - 2020', '2550K', '84K', 'influencer2@gmail.com', '2023-10-16 22:33:41', NULL, '$2y$10$U7mzULEZxov.NnbdF0j5u.v0E9ezdocMwhgxDLe9QPCS5MVj7n5mm', NULL, NULL, 'yes', 'enable', 'no', 'uploads/custom-images/nawyantong-2023-10-17-11-54-32-5597.png', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.instagram.com', 'https://www.tiktok.com', '2023-10-16 22:09:16', '2023-10-17 18:04:27', NULL, NULL, NULL, '0'),
(3, 'Nasrun Nessa', '123-343-4444', 'alvantan-khan-20231018120534', 'Los Angeles, CA, USA', 'United States', 'Sport &amp; Fitness', 'Integer fermentum luctus urna non tincidunt risus laoreet in.Vivamus eu dolor lorem.Aenean efficitur urn at est lobortis efficitur.Vestibulum tellus nunc, maximus eget eleifend a, mollis ac turpis. Integer eget our dictum est. Fusce eget pulvinar tor tor. Quisque suscipit ante ac nisi a rutrumnec mollis nulla.', '[{\"value\":\"laravel\"},{\"value\":\"php\"},{\"value\":\"photography\"},{\"value\":\"gym\"},{\"value\":\"boxing\"}]', 'North South University', 'Aperiam deserunt dol, Burundi 2015 - 2020', 'Independent University BD', 'Aperiam deserunt dol, Burundi 2015 - 2020', '8450K', '75K', 'influencer3@gmail.com', '2023-10-17 18:06:06', NULL, '$2y$10$WfqYmc/VMFxHgM2kIZQO/.Az7VzvucBg7bU.HOxfTAFid9nR/ltxW', NULL, NULL, 'yes', 'enable', 'no', 'uploads/custom-images/alvantan-khan-2023-10-18-12-07-55-8858.png', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.instagram.com', 'https://www.tiktok.com', '2023-10-17 18:05:34', '2023-10-28 19:09:33', NULL, NULL, NULL, '0'),
(4, 'Alvantan Khan', '123-343-4444', 'alvantan-khan-20231018013139', 'Los Angeles, CA, USA', 'United States', 'Sport &amp; Fitness', 'Integer fermentum luctus urna non tincidunt risus laoreet in.Vivamus eu dolor lorem.Aenean efficitur urn at est lobortis efficitur.Vestibulum tellus nunc, maximus eget eleifend a, mollis ac turpis. Integer eget our dictum est. Fusce eget pulvinar tor tor. Quisque suscipit ante ac nisi a rutrumnec mollis nulla.', '[{\"value\":\"larave\"},{\"value\":\"python\"},{\"value\":\"node\"},{\"value\":\"react\"},{\"value\":\"php\"}]', 'North South University', 'Aperiam deserunt dol, Burundi 2015 - 2020', 'Independent University BD', 'Aperiam deserunt dol, Burundi 2015 - 2020', '1250K', '12K', 'influencer4@gmail.com', '2023-10-17 19:32:07', NULL, '$2y$10$fVMS7/7I4T7nhIopf.ze/ur4Fg1cnXFyw91OBRGX8n45rCBCgGFoS', NULL, NULL, 'yes', 'enable', 'no', 'uploads/custom-images/alvantan-khan-2023-10-29-01-46-37-2249.png', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.instagram.com', 'https://www.tiktok.com', '2023-10-17 19:31:39', '2023-10-28 19:46:37', NULL, NULL, NULL, '0'),
(5, 'John Doe', '123-343-4444', NULL, 'Los Angeles, CA, USA', NULL, 'Graphic Designer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'client@gmail.com', '2023-10-17 20:09:06', NULL, '$2y$10$kQyqREJYD2DuzkflWevfzuu6bIuWSoxtEDQb3hLzpbdXvi09eObdS', 'PVkXiyGZeZ7rVBwOaX99usXJ1w6prdSCf0BbPRPTSk2rnmwragN1kW6UXprP', NULL, 'no', 'enable', 'no', 'uploads/custom-images/john-doe-2023-10-18-02-10-17-5915.jpg', NULL, NULL, NULL, NULL, '2023-10-17 20:08:40', '2023-10-17 20:10:18', NULL, NULL, NULL, '0'),
(21, 'Kazi Omar Faruk', '01701029783', 'kazi-omar-faruk-20250202112239', 'Banassare', 'Bangladesh', 'Graphic Designer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kaziomar.bdcalling@gmail.com', '2025-02-02 05:22:57', NULL, '$2y$10$ujvxyuD0uROTULkyPL/6huE9shBO3gthwjoYb5EHoz1D7OWmFTMKa', NULL, NULL, 'yes', 'enable', 'no', NULL, NULL, NULL, NULL, NULL, '2025-02-02 05:22:40', '2025-02-02 05:22:57', NULL, NULL, NULL, '0'),
(22, 'CodeMaster', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kaziomar003@yopmail.com', NULL, 'aokppVPAMR6igCkM9uHd94tEIbgRkYmIh4dM6zoz4vWdKcAvHikN0Zj4CK2yL1vYcPSHfn3FJxCbABiJBjZgpt3co8dP69cGC9fL', '$2y$10$/qpHkddbAnQjwPtrIVkn8erl0x1yVep/59kSHqOitNtZyyw22E/lq', NULL, NULL, 'no', 'enable', 'no', NULL, NULL, NULL, NULL, NULL, '2025-02-03 05:51:36', '2025-02-03 05:51:36', NULL, NULL, NULL, '0'),
(23, 'newApi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kaziomar002@yopmail.com', '2025-02-03 05:56:07', NULL, '$2y$10$I6Jm8PUeEPiczjZBFaUcC.lv5.72nChGw/6HavsNsPg4J8xETMMcG', NULL, NULL, 'no', 'enable', 'no', NULL, NULL, NULL, NULL, NULL, '2025-02-03 05:55:12', '2025-02-03 05:56:07', NULL, NULL, NULL, '0'),
(24, 'User', '01701029783', NULL, 'Banassare', NULL, 'aaa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user@gmail.com', '2025-02-05 04:49:15', NULL, '$2y$10$U786y.T6JuRNwVK8RIAOgetvHcge6UCGDRGI00SkDYhG42UB8zAIG', NULL, NULL, 'no', 'enable', 'no', NULL, NULL, NULL, NULL, NULL, '2025-02-05 04:48:55', '2025-02-10 04:32:56', NULL, NULL, NULL, '0'),
(26, 'Tahsan', '01701029783', 'tahsan-20250208122252', 'Banassare', 'Bangladesh', 'Graphic Designer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tanjim@gmail.com', '2025-02-08 06:23:09', NULL, '$2y$10$qLBVPhDh1.38vNIVjj6ry.VdI7xtxzOuBCKMsSrTJAxA0GT0qW0mm', NULL, NULL, 'yes', 'enable', 'no', NULL, NULL, NULL, NULL, NULL, '2025-02-08 06:22:52', '2025-02-08 06:23:09', NULL, NULL, NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `why_choose_us`
--

CREATE TABLE `why_choose_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `home2_image` varchar(255) DEFAULT NULL,
  `home2_foreground1` varchar(255) DEFAULT NULL,
  `home2_foreground2` varchar(255) DEFAULT NULL,
  `home3_image` varchar(255) DEFAULT NULL,
  `home2_icon1` varchar(255) DEFAULT NULL,
  `home2_icon2` varchar(255) DEFAULT NULL,
  `home2_icon3` varchar(255) DEFAULT NULL,
  `home3_icon1` varchar(255) DEFAULT NULL,
  `home3_icon2` varchar(255) DEFAULT NULL,
  `home3_icon3` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `why_choose_us`
--

INSERT INTO `why_choose_us` (`id`, `home2_image`, `home2_foreground1`, `home2_foreground2`, `home3_image`, `home2_icon1`, `home2_icon2`, `home2_icon3`, `home3_icon1`, `home3_icon2`, `home3_icon3`, `created_at`, `updated_at`) VALUES
(1, 'uploads/website-images/why_choose_us2-2023-09-05-10-11-01-6766.jpg', 'uploads/website-images/why_choose_us_forg-2023-09-05-10-14-07-1994.png', 'uploads/website-images/why_choose_us_forg-2023-09-05-10-16-08-7499.png', 'uploads/website-images/why_choose_us2-2023-09-05-10-51-04-6086.png', 'uploads/website-images/why_choose_us-item-2023-09-18-06-39-06-1025.svg', 'uploads/website-images/why_choose_us-item-2023-09-18-06-39-06-2883.svg', 'uploads/website-images/why_choose_us-item-2023-09-18-06-39-06-4501.svg', 'uploads/website-images/why_choose_us-item-2023-09-05-10-51-40-7856.svg', 'uploads/website-images/why_choose_us-item-2023-09-05-10-52-15-8753.svg', 'uploads/website-images/why_choose_us-item-2023-09-05-10-52-34-5768.svg', NULL, '2023-09-18 00:39:06');

-- --------------------------------------------------------

--
-- Table structure for table `why_choose_us_translations`
--

CREATE TABLE `why_choose_us_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `why_choose_us_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `home2_title` varchar(255) DEFAULT NULL,
  `home2_header` varchar(255) DEFAULT NULL,
  `home2_description` text DEFAULT NULL,
  `home2_item1` text DEFAULT NULL,
  `home2_item2` text DEFAULT NULL,
  `home2_item3` text DEFAULT NULL,
  `home2_des1` text DEFAULT NULL,
  `home2_des2` text DEFAULT NULL,
  `home2_des3` text DEFAULT NULL,
  `home3_title` varchar(255) DEFAULT NULL,
  `home3_header` varchar(255) DEFAULT NULL,
  `home3_description` text DEFAULT NULL,
  `home3_item1` text DEFAULT NULL,
  `home3_item2` text DEFAULT NULL,
  `home3_item3` text DEFAULT NULL,
  `home3_des1` text DEFAULT NULL,
  `home3_des2` text DEFAULT NULL,
  `home3_des3` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `why_choose_us_translations`
--

INSERT INTO `why_choose_us_translations` (`id`, `why_choose_us_id`, `lang_code`, `home2_title`, `home2_header`, `home2_description`, `home2_item1`, `home2_item2`, `home2_item3`, `home2_des1`, `home2_des2`, `home2_des3`, `home3_title`, `home3_header`, `home3_description`, `home3_item1`, `home3_item2`, `home3_item3`, `home3_des1`, `home3_des2`, `home3_des3`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Why Choose Us', 'Optimize your social efforts for greater impact', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'Promote Your Product & Brand', 'Growing & Scale Up Businesses', 'Success Campaign on Social', 'Curabitur a pretium orci, a venenatis diam phasellus id mi velit. Vestibulum et tincid unt sem, id sagittis nibh.', 'Curabitur a pretium orci, a venenatis diam phasellus id mi velit. Vestibulum et tincid unt sem, id sagittis nibh.', 'Curabitur a pretium orci, a venenatis diam phasellus id mi velit. Vestibulum et tincid unt sem, id sagittis nibh.', 'Influencer Affiliate Payments', 'Pay influencers, Send creators free products', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'Promote Your Product & Brand', 'Growing & Scale Up Businesses', 'Success Campaign on Social', 'Curabitur a pretium orci, a venenatis diam phasellus id mi velit. Vestibulum et tincid unt sem, id sagittis nibh.', 'Curabitur a pretium orci, a venenatis diam phasellus id mi velit. Vestibulum et tincid unt sem, id sagittis nibh.', 'Curabitur a pretium orci, a venenatis diam phasellus id mi velit. Vestibulum et tincid unt sem, id sagittis nibh.', NULL, '2023-09-05 04:51:04'),
(13, 1, 'ar', 'لماذا أخترتنا', 'تحسين جهودك الاجتماعية لتحقيق تأثير أكبر', 'لوريم إيبسوم دولور سيت أميت، consectetur adipiscing إيليت. Ut elit Tellus، luctus nec ullamcorper mattis، pulvinar dapibus leo.', 'الترويج لمنتجك وعلامتك التجارية', 'نمو وتوسيع نطاق الأعمال التجارية', 'حملة النجاح على مواقع التواصل الاجتماعي', 'Curabitur a pretium orci، a venenatis diamphasellus id mi velit. الدهليز و tincid unt sem، id sagittis nibh.', 'Curabitur a pretium orci، a venenatis diamphasellus id mi velit. الدهليز و tincid unt sem، id sagittis nibh.', 'Curabitur a pretium orci، a venenatis diamphasellus id mi velit. الدهليز و tincid unt sem، id sagittis nibh.', 'مدفوعات المؤثرين', 'ادفع للمؤثرين، وأرسل منتجات مجانية للمبدعين', 'لوريم إيبسوم دولور سيت أميت، consectetur adipiscing إيليت. Ut elit Tellus، luctus nec ullamcorper mattis، pulvinar dapibus leo.', 'الترويج لمنتجك وعلامتك التجارية', 'نمو وتوسيع نطاق الأعمال التجارية', 'حملة النجاح على مواقع التواصل الاجتماعي', 'Curabitur a pretium orci، a venenatis diamphasellus id mi velit. الدهليز و tincid unt sem، id sagittis nibh.', 'Curabitur a pretium orci، a venenatis diamphasellus id mi velit. الدهليز و tincid unt sem، id sagittis nibh.', 'Curabitur a pretium orci، a venenatis diamphasellus id mi velit. الدهليز و tincid unt sem، id sagittis nibh.', '2023-10-17 23:04:37', '2023-10-18 15:25:55');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `service_id`, `created_at`, `updated_at`) VALUES
(1, 5, 11, '2023-10-17 20:15:44', '2023-10-17 20:15:44'),
(2, 5, 10, '2023-10-17 20:15:46', '2023-10-17 20:15:46');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_methods`
--

CREATE TABLE `withdraw_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `min_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `max_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `withdraw_charge` decimal(8,2) NOT NULL DEFAULT 0.00,
  `description` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdraw_methods`
--

INSERT INTO `withdraw_methods` (`id`, `name`, `min_amount`, `max_amount`, `withdraw_charge`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bank Payment', 10.00, 100.00, 10.00, '<p>Bank Name: Your bank name<br>Account Number: &nbsp;Your bank account number<br>Routing Number: Your bank routing number<br>Branch: Your bank branch name</p>', 1, '2023-10-17 22:34:17', '2025-02-18 08:39:56');

-- --------------------------------------------------------

--
-- Table structure for table `working_proccesses`
--

CREATE TABLE `working_proccesses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `home1_image1` varchar(255) DEFAULT NULL,
  `home1_image2` varchar(255) DEFAULT NULL,
  `home1_image3` varchar(255) DEFAULT NULL,
  `home1_image4` varchar(255) DEFAULT NULL,
  `home3_image1` varchar(255) DEFAULT NULL,
  `home3_image2` varchar(255) DEFAULT NULL,
  `home3_image3` varchar(255) DEFAULT NULL,
  `home3_image4` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `working_proccesses`
--

INSERT INTO `working_proccesses` (`id`, `home1_image1`, `home1_image2`, `home1_image3`, `home1_image4`, `home3_image1`, `home3_image2`, `home3_image3`, `home3_image4`, `created_at`, `updated_at`) VALUES
(1, 'uploads/website-images/why_choose_us1-2023-09-05-06-14-59-3945.jpg', 'uploads/website-images/why_choose_us2-2023-09-05-06-15-48-2251.jpg', 'uploads/website-images/why_choose_us3-2023-09-05-06-16-49-3923.jpg', 'uploads/website-images/why_choose_us3-2023-09-05-06-17-45-6525.jpg', 'uploads/website-images/why_choose_us5-2023-09-05-06-42-08-2568.png', 'uploads/website-images/why_choose_us6-2023-09-05-06-44-17-3733.png', 'uploads/website-images/why_choose_us7-2023-09-05-09-00-23-3410.png', 'uploads/website-images/why_choose_us8-2023-09-05-06-44-40-7736.png', NULL, '2023-09-05 03:00:23');

-- --------------------------------------------------------

--
-- Table structure for table `working_proccess_translations`
--

CREATE TABLE `working_proccess_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `working_proccess_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `home1_title1` varchar(255) DEFAULT NULL,
  `home1_title2` varchar(255) DEFAULT NULL,
  `home1_title3` varchar(255) DEFAULT NULL,
  `home1_title4` varchar(255) DEFAULT NULL,
  `home1_description1` text DEFAULT NULL,
  `home1_description2` text DEFAULT NULL,
  `home1_description3` text DEFAULT NULL,
  `home1_description4` text DEFAULT NULL,
  `home3_title1` varchar(255) DEFAULT NULL,
  `home3_title2` varchar(255) DEFAULT NULL,
  `home3_title3` varchar(255) DEFAULT NULL,
  `home3_title4` varchar(255) DEFAULT NULL,
  `home3_description1` text DEFAULT NULL,
  `home3_description2` text DEFAULT NULL,
  `home3_description3` text DEFAULT NULL,
  `home3_description4` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `working_proccess_translations`
--

INSERT INTO `working_proccess_translations` (`id`, `working_proccess_id`, `lang_code`, `home1_title1`, `home1_title2`, `home1_title3`, `home1_title4`, `home1_description1`, `home1_description2`, `home1_description3`, `home1_description4`, `home3_title1`, `home3_title2`, `home3_title3`, `home3_title4`, `home3_description1`, `home3_description2`, `home3_description3`, `home3_description4`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Create Account', 'Choose Influencer', 'Monitor Your Campaign', 'Check Your Report', 'Curabitur a pretium orci, a venenatis diam phasellus id mi velit. Vestibulum et tincid unt sem, id sagittis nibh.', 'Curabitur a pretium orci, a venenatis diam phasellus id mi velit. Vestibulum et tincid unt sem, id sagittis nibh.', 'Curabitur a pretium orci, a venenatis diam phasellus id mi velit. Vestibulum et tincid unt sem, id sagittis nibh.', 'Curabitur a pretium orci, a venenatis diam phasellus id mi velit. Vestibulum et tincid unt sem, id sagittis nibh.', 'The Analyze Perfect Fit', 'The Analyze Perfect Fit 2', 'The Analyze Perfect Fit 3', 'The Analyze Perfect Fit 4', 'There are many variations of passages of Lorem Ipsum availa majority have suffered alteration in some form, by injected as randomised words which don\'t look even a slightly believable. going to use a passage 1', 'There are many variations of passages of Lorem Ipsum availa majority have suffered alteration in some form, by injected as randomised words which don\'t look even a slightly believable. going to use a passage 2', 'There are many variations of passages of Lorem Ipsum availa majority have suffered alteration in some form, by injected as randomised words which don\'t look even a slightly believable. going to use a passage 3', 'There are many variations of passages of Lorem Ipsum availa majority have suffered alteration in some form, by injected as randomised words which don\'t look even a slightly believable. going to use a passage 4', NULL, '2023-09-05 00:39:38'),
(14, 1, 'ar', 'إنشاء حساب', 'اختر المؤثر', 'مراقبة حملتك', 'تحقق من تقريرك', 'Curabitur a pretium orci، a venenatis diamphasellus id mi velit. الدهليز و tincid unt sem، id sagittis nibh.', 'Curabitur a pretium orci، a venenatis diamphasellus id mi velit. الدهليز و tincid unt sem، id sagittis nibh.', 'Curabitur a pretium orci، a venenatis diamphasellus id mi velit. الدهليز و tincid unt sem، id sagittis nibh.', 'Curabitur a pretium orci، a venenatis diamphasellus id mi velit. الدهليز و tincid unt sem، id sagittis nibh.', 'التحليل المثالي', 'التحليل المثالي المناسب', 'التحليل المثالي', 'التحليل المثالي', 'هناك العديد من الأشكال المختلفة لنصوص لوريم إيبسوم المتاحة والتي تعرضت للتغيير بشكل ما، وذلك عن طريق إدخالها ككلمات عشوائية لا تبدو قابلة للتصديق ولو قليلاً. الذهاب إلى استخدام مر', 'هناك العديد من الأشكال المختلفة لنصوص لوريم إيبسوم المتاحة والتي تعرضت للتغيير بشكل ما، وذلك عن طريق إدخالها ككلمات عشوائية لا تبدو قابلة للتصديق ولو قليلاً. الذهاب إلى استخدام مرور', 'هناك العديد من الأشكال المختلفة لنصوص لوريم إيبسوم المتاحة والتي تعرضت للتغيير بشكل ما، وذلك عن طريق إدخالها ككلمات عشوائية لا تبدو قابلة للتصديق ولو قليلاً. الذهاب إلى استخدام مرور', 'هناك العديد من الأشكال المختلفة لنصوص لوريم إيبسوم المتاحة والتي تعرضت للتغيير بشكل ما، وذلك عن طريق إدخالها ككلمات عشوائية لا تبدو قابلة للتصديق ولو قليلاً. الذهاب إلى استخدام مرور', '2023-10-17 23:04:37', '2023-10-18 15:23:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `about_us_translations`
--
ALTER TABLE `about_us_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `additional_services`
--
ALTER TABLE `additional_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `additional_service_translations`
--
ALTER TABLE `additional_service_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `appointment_schedules`
--
ALTER TABLE `appointment_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_payments`
--
ALTER TABLE `bank_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_category_translations`
--
ALTER TABLE `blog_category_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_translations`
--
ALTER TABLE `blog_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_translations`
--
ALTER TABLE `category_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complete_requests`
--
ALTER TABLE `complete_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cookie_consents`
--
ALTER TABLE `cookie_consents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_histories`
--
ALTER TABLE `coupon_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency_countries`
--
ALTER TABLE `currency_countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `custom_pages`
--
ALTER TABLE `custom_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_page_translations`
--
ALTER TABLE `custom_page_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_paginations`
--
ALTER TABLE `custom_paginations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_configurations`
--
ALTER TABLE `email_configurations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facebook_pixels`
--
ALTER TABLE `facebook_pixels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_translates`
--
ALTER TABLE `faq_translates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flutterwaves`
--
ALTER TABLE `flutterwaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `google_analytics`
--
ALTER TABLE `google_analytics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `google_recaptchas`
--
ALTER TABLE `google_recaptchas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_pages`
--
ALTER TABLE `home_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_page_translations`
--
ALTER TABLE `home_page_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `influencer_withdraws`
--
ALTER TABLE `influencer_withdraws`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instamojo_payments`
--
ALTER TABLE `instamojo_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iyzico_payments`
--
ALTER TABLE `iyzico_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kyc_information`
--
ALTER TABLE `kyc_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kyc_types`
--
ALTER TABLE `kyc_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mercado_pago_payments`
--
ALTER TABLE `mercado_pago_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_documents`
--
ALTER TABLE `message_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multi_currencies`
--
ALTER TABLE `multi_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `our_features`
--
ALTER TABLE `our_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `our_feature_translations`
--
ALTER TABLE `our_feature_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `paymongo_payments`
--
ALTER TABLE `paymongo_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paypal_payments`
--
ALTER TABLE `paypal_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paystack_and_mollies`
--
ALTER TABLE `paystack_and_mollies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privacy_policies`
--
ALTER TABLE `privacy_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_bank_handcashes`
--
ALTER TABLE `provider_bank_handcashes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_flutterwaves`
--
ALTER TABLE `provider_flutterwaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_instamojos`
--
ALTER TABLE `provider_instamojos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_mollies`
--
ALTER TABLE `provider_mollies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_paypals`
--
ALTER TABLE `provider_paypals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_paystacks`
--
ALTER TABLE `provider_paystacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_razorpays`
--
ALTER TABLE `provider_razorpays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_stripes`
--
ALTER TABLE `provider_stripes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_histories`
--
ALTER TABLE `purchase_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `razorpay_payments`
--
ALTER TABLE `razorpay_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refund_requests`
--
ALTER TABLE `refund_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_settings`
--
ALTER TABLE `seo_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_translations`
--
ALTER TABLE `service_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider_ones`
--
ALTER TABLE `slider_ones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider_one_translations`
--
ALTER TABLE `slider_one_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_login_infos`
--
ALTER TABLE `social_login_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stripe_payments`
--
ALTER TABLE `stripe_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_fees`
--
ALTER TABLE `subscription_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tawk_chats`
--
ALTER TABLE `tawk_chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `term_and_conditions`
--
ALTER TABLE `term_and_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonial_translations`
--
ALTER TABLE `testimonial_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_messages`
--
ALTER TABLE `ticket_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `why_choose_us`
--
ALTER TABLE `why_choose_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `why_choose_us_translations`
--
ALTER TABLE `why_choose_us_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `working_proccesses`
--
ALTER TABLE `working_proccesses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `working_proccess_translations`
--
ALTER TABLE `working_proccess_translations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `about_us_translations`
--
ALTER TABLE `about_us_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `additional_services`
--
ALTER TABLE `additional_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `additional_service_translations`
--
ALTER TABLE `additional_service_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `appointment_schedules`
--
ALTER TABLE `appointment_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `bank_payments`
--
ALTER TABLE `bank_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `blog_category_translations`
--
ALTER TABLE `blog_category_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blog_translations`
--
ALTER TABLE `blog_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `category_translations`
--
ALTER TABLE `category_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `complete_requests`
--
ALTER TABLE `complete_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cookie_consents`
--
ALTER TABLE `cookie_consents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coupon_histories`
--
ALTER TABLE `coupon_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `currency_countries`
--
ALTER TABLE `currency_countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `custom_pages`
--
ALTER TABLE `custom_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `custom_page_translations`
--
ALTER TABLE `custom_page_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `custom_paginations`
--
ALTER TABLE `custom_paginations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `email_configurations`
--
ALTER TABLE `email_configurations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `facebook_pixels`
--
ALTER TABLE `facebook_pixels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faq_translates`
--
ALTER TABLE `faq_translates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `flutterwaves`
--
ALTER TABLE `flutterwaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `google_analytics`
--
ALTER TABLE `google_analytics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `google_recaptchas`
--
ALTER TABLE `google_recaptchas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `home_pages`
--
ALTER TABLE `home_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `home_page_translations`
--
ALTER TABLE `home_page_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `influencer_withdraws`
--
ALTER TABLE `influencer_withdraws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `instamojo_payments`
--
ALTER TABLE `instamojo_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `iyzico_payments`
--
ALTER TABLE `iyzico_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kyc_information`
--
ALTER TABLE `kyc_information`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kyc_types`
--
ALTER TABLE `kyc_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `mercado_pago_payments`
--
ALTER TABLE `mercado_pago_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `message_documents`
--
ALTER TABLE `message_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `multi_currencies`
--
ALTER TABLE `multi_currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `our_features`
--
ALTER TABLE `our_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `our_feature_translations`
--
ALTER TABLE `our_feature_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `paymongo_payments`
--
ALTER TABLE `paymongo_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `paypal_payments`
--
ALTER TABLE `paypal_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `paystack_and_mollies`
--
ALTER TABLE `paystack_and_mollies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `privacy_policies`
--
ALTER TABLE `privacy_policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `provider_bank_handcashes`
--
ALTER TABLE `provider_bank_handcashes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `provider_flutterwaves`
--
ALTER TABLE `provider_flutterwaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provider_instamojos`
--
ALTER TABLE `provider_instamojos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provider_mollies`
--
ALTER TABLE `provider_mollies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provider_paypals`
--
ALTER TABLE `provider_paypals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provider_paystacks`
--
ALTER TABLE `provider_paystacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `provider_razorpays`
--
ALTER TABLE `provider_razorpays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provider_stripes`
--
ALTER TABLE `provider_stripes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_histories`
--
ALTER TABLE `purchase_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `razorpay_payments`
--
ALTER TABLE `razorpay_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `refund_requests`
--
ALTER TABLE `refund_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seo_settings`
--
ALTER TABLE `seo_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `service_translations`
--
ALTER TABLE `service_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slider_ones`
--
ALTER TABLE `slider_ones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slider_one_translations`
--
ALTER TABLE `slider_one_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `social_login_infos`
--
ALTER TABLE `social_login_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stripe_payments`
--
ALTER TABLE `stripe_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_fees`
--
ALTER TABLE `subscription_fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tawk_chats`
--
ALTER TABLE `tawk_chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `term_and_conditions`
--
ALTER TABLE `term_and_conditions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `testimonial_translations`
--
ALTER TABLE `testimonial_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ticket_messages`
--
ALTER TABLE `ticket_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `why_choose_us`
--
ALTER TABLE `why_choose_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `why_choose_us_translations`
--
ALTER TABLE `why_choose_us_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `working_proccesses`
--
ALTER TABLE `working_proccesses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `working_proccess_translations`
--
ALTER TABLE `working_proccess_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
