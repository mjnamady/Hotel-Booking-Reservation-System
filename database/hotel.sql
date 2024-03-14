-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2024 at 10:39 PM
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
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE IF NOT EXISTS `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  `category_slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE IF NOT EXISTS `blog_posts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `blogcat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_slug` varchar(255) NOT NULL,
  `post_image` varchar(255) NOT NULL,
  `short_desc` text NOT NULL,
  `long_desc` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookareas`
--

CREATE TABLE IF NOT EXISTS `bookareas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `short_title` varchar(255) DEFAULT NULL,
  `main_title` varchar(255) DEFAULT NULL,
  `short_desc` text DEFAULT NULL,
  `book_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookareas`
--

INSERT INTO `bookareas` (`id`, `image`, `short_title`, `main_title`, `short_desc`, `book_url`, `created_at`, `updated_at`) VALUES
(1, 'upload/bookarea/1786837126752682.jpg', 'MAKE A QUICK BOOKING11', 'We Are the Best in All-time & So Please Get a Quick Booking11', '11 Atoli is one of the best resorts in the global market and that\'s why you will get a luxury life period on the global market. We always provide you a special support for all of our guests and that\'s will be the main reason to be the most popular.', 'book_url', NULL, '2023-12-31 21:11:15');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rooms_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `check_in` varchar(255) DEFAULT NULL,
  `check_out` varchar(255) DEFAULT NULL,
  `persion` varchar(255) DEFAULT NULL,
  `number_of_rooms` varchar(255) DEFAULT NULL,
  `total_night` double(8,2) NOT NULL DEFAULT 0.00,
  `actual_price` double(8,2) NOT NULL DEFAULT 0.00,
  `subtotal` double(8,2) NOT NULL DEFAULT 0.00,
  `discount` int(11) NOT NULL DEFAULT 0,
  `total_price` double(8,2) NOT NULL DEFAULT 0.00,
  `payment_method` varchar(255) DEFAULT NULL,
  `transation_id` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `rooms_id`, `user_id`, `check_in`, `check_out`, `persion`, `number_of_rooms`, `total_night`, `actual_price`, `subtotal`, `discount`, `total_price`, `payment_method`, `transation_id`, `payment_status`, `name`, `email`, `phone`, `country`, `state`, `zip_code`, `address`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 2, '2024-02-04', '2024-02-10', '02', '03', 6.00, 150.00, 2700.00, 270, 2430.00, 'COD', '', '1', 'User', 'user@gmail.com', '08036906317', 'Nigeria', 'Kaduna', '12121', 'Cross River', '881390611', 1, '2024-02-04 04:31:35', '2024-02-12 20:32:38'),
(2, 5, 2, '2024-02-05', '2024-02-09', '03', '02', 5.00, 150.00, 1500.00, 150, 1350.00, 'Stripe', NULL, '1', 'User', 'user@gmail.com', '08036906317', 'Nigeria', 'Cross River', '90088', 'Cross River', '560822810', 1, '2024-02-05 12:38:48', '2024-02-09 14:29:59'),
(3, 4, 1, '2024-02-11', '2024-02-16', '2', '1', 5.00, 100.00, 500.00, 50, 450.00, 'COD', NULL, '1', 'Mustapha', 'mustaphajnamadi@gmail.com', '09140699104', 'Nigeria', 'Dhaka', '98789', 'Kaduna', '411558064', 1, '2024-02-11 21:30:38', '2024-02-13 11:13:45');

-- --------------------------------------------------------

--
-- Table structure for table `booking_room_lists`
--

CREATE TABLE IF NOT EXISTS `booking_room_lists` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `room_number_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_room_lists`
--

INSERT INTO `booking_room_lists` (`id`, `booking_id`, `room_id`, `room_number_id`, `created_at`, `updated_at`) VALUES
(3, 2, 5, 18, '2024-02-09 09:13:24', '2024-02-09 09:13:24'),
(4, 2, 5, 19, '2024-02-09 09:13:34', '2024-02-09 09:13:34'),
(5, 3, 4, 21, '2024-02-11 21:34:57', '2024-02-11 21:34:57'),
(6, 1, 5, 20, '2024-02-12 19:46:03', '2024-02-12 19:46:03');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE IF NOT EXISTS `facilities` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rooms_id` int(11) NOT NULL,
  `facility_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `rooms_id`, `facility_name`, `created_at`, `updated_at`) VALUES
(115, 7, '32/42 inch LED TV', '2024-02-11 05:49:30', '2024-02-11 05:49:30'),
(116, 7, 'Free Wi-Fi', '2024-02-11 05:49:30', '2024-02-11 05:49:30'),
(117, 7, 'Hair dryer', '2024-02-11 05:49:30', '2024-02-11 05:49:30'),
(118, 7, 'Electronic door lock', '2024-02-11 05:49:30', '2024-02-11 05:49:30'),
(119, 6, 'Electronic door lock', '2024-02-11 05:51:00', '2024-02-11 05:51:00'),
(120, 6, 'Safety box', '2024-02-11 05:51:00', '2024-02-11 05:51:00'),
(121, 6, 'Hair dryer', '2024-02-11 05:51:00', '2024-02-11 05:51:00'),
(122, 6, 'Wake-up service', '2024-02-11 05:51:00', '2024-02-11 05:51:00'),
(123, 6, 'Smoke alarms', '2024-02-11 05:51:00', '2024-02-11 05:51:00'),
(124, 5, 'Laundry & Dry Cleaning', '2024-02-11 05:51:57', '2024-02-11 05:51:57'),
(125, 5, 'Slippers', '2024-02-11 05:51:58', '2024-02-11 05:51:58'),
(126, 5, 'Minibar', '2024-02-11 05:51:58', '2024-02-11 05:51:58'),
(127, 4, 'Laundry & Dry Cleaning', '2024-02-11 05:53:39', '2024-02-11 05:53:39'),
(128, 4, 'Work Desk', '2024-02-11 05:53:40', '2024-02-11 05:53:40'),
(129, 4, 'Electronic door lock', '2024-02-11 05:53:40', '2024-02-11 05:53:40'),
(130, 4, 'Smoke alarms', '2024-02-11 05:53:40', '2024-02-11 05:53:40');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(21, '2014_10_12_000000_create_users_table', 1),
(22, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(23, '2019_08_19_000000_create_failed_jobs_table', 1),
(24, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(25, '2023_12_26_180828_create_teams_table', 1),
(26, '2023_12_27_194341_create_bookareas_table', 1),
(27, '2023_12_28_071341_create_room_types_table', 1),
(28, '2023_12_28_104448_create_rooms_table', 1),
(29, '2023_12_28_104503_create_facilities_table', 1),
(30, '2023_12_28_104525_create_multi_images_table', 1),
(31, '2023_12_30_142120_create_room_numbers_table', 1),
(32, '2024_01_28_104926_create_bookings_table', 1),
(33, '2024_01_28_140126_create_room_booked_dates_table', 1),
(34, '2024_01_28_140524_create_booking_room_lists_table', 1),
(35, '2024_02_29_160504_create_smtp_settings_table', 1),
(36, '2024_03_02_130619_create_testimonials_table', 1),
(37, '2024_03_03_065119_create_blog_categories_table', 1),
(38, '2024_03_05_104351_create_blog_posts_table', 1),
(39, '2024_03_07_130226_create_comments_table', 1),
(40, '2024_03_11_134433_create_site_settings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `multi_images`
--

CREATE TABLE IF NOT EXISTS `multi_images` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rooms_id` int(11) NOT NULL,
  `multi_img` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `multi_images`
--

INSERT INTO `multi_images` (`id`, `rooms_id`, `multi_img`, `created_at`, `updated_at`) VALUES
(19, 7, '1786835289999288.Executive-Suite-Photo1.jpg', '2023-12-31 19:42:04', '2023-12-31 19:42:04'),
(20, 7, '1786835290401636.Executive-Suite-Photo2.jpg', '2023-12-31 19:42:04', '2023-12-31 19:42:04'),
(21, 7, '1786835290726371.Executive-Suite-Photo3.jpg', '2023-12-31 19:42:04', '2023-12-31 19:42:04'),
(22, 6, '1786835527643181.Premier-Deluxe-Twin-main-Photo1.jpg', '2023-12-31 19:45:50', '2023-12-31 19:45:50'),
(23, 6, '1786835528242219.Premier-Deluxe-Twin-main-Photo2.jpg', '2023-12-31 19:45:51', '2023-12-31 19:45:51'),
(24, 6, '1786835528811672.Premier-Deluxe-Twin-main-Photo3.jpg', '2023-12-31 19:45:51', '2023-12-31 19:45:51'),
(25, 5, '1786835728981556.double-main-1.jpg', '2023-12-31 19:49:02', '2023-12-31 19:49:02'),
(26, 5, '1786835729303967.super-premier-deluxe-main-Photo1.jpg', '2023-12-31 19:49:02', '2023-12-31 19:49:02'),
(27, 5, '1786835729704940.super-premier-deluxe-main-Photo3.jpg', '2023-12-31 19:49:03', '2023-12-31 19:49:03'),
(28, 4, '1786835894942509.PREMIER-SINGLE-Room-Photo-Singel.jpg', '2023-12-31 19:51:40', '2023-12-31 19:51:40'),
(29, 4, '1786835895337300.PREMIER-SINGLE-Room-Photo-Singel2.jpg', '2023-12-31 19:51:41', '2023-12-31 19:51:41'),
(30, 4, '1786835896057085.single-main-1.jpg', '2023-12-31 19:51:41', '2023-12-31 19:51:41');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `roomtype_id` int(11) NOT NULL,
  `total_adult` varchar(255) DEFAULT NULL,
  `total_child` varchar(255) DEFAULT NULL,
  `room_capacity` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `view` varchar(255) DEFAULT NULL,
  `bed_style` varchar(255) DEFAULT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `short_desc` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `roomtype_id`, `total_adult`, `total_child`, `room_capacity`, `image`, `price`, `size`, `view`, `bed_style`, `discount`, `short_desc`, `description`, `status`, `created_at`, `updated_at`) VALUES
(4, 8, '1', '2', '3', '1786835894035533.jpg', '100', '14', 'Sea View', 'King Bed', 10, 'Lorem ipsum dolor sit amet, adipiscing elit. Suspendisse et faucibus felis, sed pulvinar purus.', '<p><strong>Lorem </strong>ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>\r\n<p>Ecespiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quci velit modi tempora incidunt ut labore et dolore magnam aliquam quaerat .</p>', 1, NULL, '2024-02-11 04:53:39'),
(5, 9, '3', '1', '3', '1786835728286715.jpg', '150', '42', 'Sea View', 'King Bed', 10, 'Lorem ipsum dolor sit amet, adipiscing elit. Suspendisse et faucibus felis, sed pulvinar purus.', '<p><strong>Lorem ipsum dolor sit amet, consectetur adipisicin</strong>g elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>\r\n<p>Ecespiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quci velit modi tempora incidunt ut labore et dolore magnam aliquam quaerat .</p>', 1, NULL, '2024-02-11 04:51:57'),
(6, 10, '3', '1', '4', '1786835527068178.jpg', '170', '23', 'Hill View', 'Twin Bed', 10, 'Lorem ipsum dolor sit amet, adipiscing elit. Suspendisse et faucibus felis, sed pulvinar purus.', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>\r\n<p>Ecespiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quci velit modi tempora incidunt ut labore et dolore magnam aliquam quaerat .</p>', 1, NULL, '2024-02-11 04:51:00'),
(7, 11, '3', '2', '4', '1786835289471238.jpg', '200', '23', 'Sea View', 'Queen Bed', 5, 'Lorem ipsum dolor sit amet, adipiscing elit. Suspendisse et faucibus felis, sed pulvinar purus.', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>\r\n<p>Ecespiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quci velit modi tempora incidunt ut labore et dolore magnam aliquam quaerat .</p>\r\n<table style=\"border-collapse: collapse; width: 100%;\" border=\"1\"><colgroup><col style=\"width: 50.056%;\"><col style=\"width: 50.056%;\"></colgroup>\r\n<tbody>\r\n<tr>\r\n<td>\r\n<ul>\r\n<li>Complementary Breakfast</li>\r\n<li>32/42 inch LED TV</li>\r\n<li>Smoke Alerm</li>\r\n<li>Minibar</li>\r\n<li>Work Desk</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n</td>\r\n<td>\r\n<ul>\r\n<li>Complementary Breakfast</li>\r\n<li>32/42 inch LED TV</li>\r\n<li>Smoke Alerm</li>\r\n<li>Minibar</li>\r\n<li>Work Desk</li>\r\n</ul>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', 1, NULL, '2024-02-11 04:49:29');

-- --------------------------------------------------------

--
-- Table structure for table `room_booked_dates`
--

CREATE TABLE IF NOT EXISTS `room_booked_dates` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `book_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_booked_dates`
--

INSERT INTO `room_booked_dates` (`id`, `booking_id`, `room_id`, `book_date`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '2024-02-04', '2024-02-04 03:31:35', '2024-02-04 03:31:35'),
(2, 1, 5, '2024-02-05', '2024-02-04 03:31:35', '2024-02-04 03:31:35'),
(3, 1, 5, '2024-02-06', '2024-02-04 03:31:35', '2024-02-04 03:31:35'),
(4, 1, 5, '2024-02-07', '2024-02-04 03:31:35', '2024-02-04 03:31:35'),
(5, 1, 5, '2024-02-08', '2024-02-04 03:31:35', '2024-02-04 03:31:35'),
(6, 1, 5, '2024-02-09', '2024-02-04 03:31:35', '2024-02-04 03:31:35'),
(12, 2, 5, '2024-02-05', '2024-02-08 12:07:27', '2024-02-08 12:07:27'),
(13, 2, 5, '2024-02-06', '2024-02-08 12:07:28', '2024-02-08 12:07:28'),
(14, 2, 5, '2024-02-07', '2024-02-08 12:07:28', '2024-02-08 12:07:28'),
(15, 2, 5, '2024-02-08', '2024-02-08 12:07:28', '2024-02-08 12:07:28'),
(16, 3, 4, '2024-02-11', '2024-02-11 20:30:39', '2024-02-11 20:30:39'),
(17, 3, 4, '2024-02-12', '2024-02-11 20:30:39', '2024-02-11 20:30:39'),
(18, 3, 4, '2024-02-13', '2024-02-11 20:30:39', '2024-02-11 20:30:39'),
(19, 3, 4, '2024-02-14', '2024-02-11 20:30:39', '2024-02-11 20:30:39'),
(20, 3, 4, '2024-02-15', '2024-02-11 20:30:39', '2024-02-11 20:30:39');

-- --------------------------------------------------------

--
-- Table structure for table `room_numbers`
--

CREATE TABLE IF NOT EXISTS `room_numbers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rooms_id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `room_no` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_numbers`
--

INSERT INTO `room_numbers` (`id`, `rooms_id`, `room_type_id`, `room_no`, `status`, `created_at`, `updated_at`) VALUES
(10, 7, 11, '201', 'Active', '2023-12-31 19:42:17', '2023-12-31 19:42:17'),
(11, 7, 11, '202', 'Active', '2023-12-31 19:42:36', '2023-12-31 19:42:36'),
(12, 7, 11, '203', 'Active', '2023-12-31 19:43:12', '2023-12-31 19:43:12'),
(13, 7, 11, '204', 'Active', '2023-12-31 19:43:32', '2023-12-31 19:43:32'),
(14, 6, 10, '301', 'Active', '2023-12-31 19:46:04', '2023-12-31 19:46:04'),
(15, 6, 10, '302', 'Active', '2023-12-31 19:46:22', '2023-12-31 19:46:22'),
(16, 6, 10, '303', 'Active', '2023-12-31 19:46:47', '2023-12-31 19:46:47'),
(17, 6, 10, '304', 'Active', '2023-12-31 19:47:27', '2023-12-31 19:47:27'),
(18, 5, 9, '401', 'Active', '2023-12-31 19:49:19', '2023-12-31 19:49:19'),
(19, 5, 9, '402', 'Active', '2023-12-31 19:49:35', '2023-12-31 19:49:35'),
(20, 5, 9, '403', 'Active', '2023-12-31 19:50:02', '2023-12-31 19:50:02'),
(21, 4, 8, '501', 'Active', '2023-12-31 19:51:54', '2023-12-31 19:51:54'),
(22, 4, 8, '502', 'Active', '2023-12-31 19:52:20', '2023-12-31 19:52:20'),
(23, 4, 8, '503', 'Active', '2024-02-11 20:27:54', '2024-02-11 20:27:54');

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE IF NOT EXISTS `room_types` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(8, 'PREMIER SINGLE', NULL, NULL),
(9, 'SUPER PREMIER DELUXE', NULL, NULL),
(10, 'PREMIER DELUXE TWIN', NULL, NULL),
(11, 'EXECUTIVE SUITE', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `logo`, `phone`, `address`, `email`, `facebook`, `twitter`, `copyright`, `created_at`, `updated_at`) VALUES
(1, 'upload/site/1793537981640922.jpg', '+2348140699104', 'No 6 Asmau makarfi street kaduna.', 'mustaphajnamadi@gmail.com', 'https://www.facebook.com/mjnamadi', NULL, 'Copyright @2024 Hotel-MJ. All Rights Reserved.', NULL, '2024-03-14 20:18:39');

-- --------------------------------------------------------

--
-- Table structure for table `smtp_settings`
--

CREATE TABLE IF NOT EXISTS `smtp_settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mailer` varchar(255) DEFAULT NULL,
  `host` varchar(255) DEFAULT NULL,
  `port` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `encription` varchar(255) DEFAULT NULL,
  `from` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `smtp_settings`
--

INSERT INTO `smtp_settings` (`id`, `mailer`, `host`, `port`, `username`, `password`, `encription`, `from`, `created_at`, `updated_at`) VALUES
(1, 'smtp', 'sandbox.smtp.mailtrap.io', '2525', '6fd128f87163fe', '27789052d04e8d', 'tls', 'support@mjhotel.com', NULL, '2024-03-14 12:15:42');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `position`, `image`, `facebook`, `created_at`, `updated_at`) VALUES
(7, 'Mustapha Jibrin', 'CEO', 'upload/team/1786829169415301.jpg', 'https://www.facebook.com/mjnamadi', '2023-12-31 18:04:49', NULL),
(8, 'Farouq Lawal', 'Cashier', 'upload/team/1786834471964490.jpg', 'https://www.facebook.com/farouq', '2023-12-31 19:29:03', NULL),
(9, 'Aisha Mustapha', 'Director', 'upload/team/1786834501228261.jpg', 'https://www.facebook.com/aisha', '2023-12-31 19:29:31', '2023-12-31 20:05:06'),
(10, 'Namadi', 'Manager', 'upload/team/1786834558128010.jpg', 'https://www.facebook.com/namadi', '2023-12-31 19:30:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `image`, `city`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Aisha Mustapha', 'upload/testimonial/1793411506330956.jpg', 'Kaduna', 'We are the agency who always gives you a priority on the free of question and you can easily make a question on the bunch.', '2024-03-13 10:48:14', NULL),
(2, 'Mustapha Jibril Muhammad', 'upload/testimonial/1793411634800013.jpg', 'Kano', 'We are the agency who always gives you a priority on the free of question and you can easily make a question on the bunch. We are the agency who always gives you a priority on the free of question and you can easily make a question on the bunch.', '2024-03-13 10:50:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `phone`, `address`, `photo`, `role`, `status`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '08140699104', 'No 6 Asmau makarfi street kaduna, kaduna', '202312191954avatar-1.png', 'admin', 'active', '$2y$12$2.IHKYs6TR4IT1O2hYbX..B61Huc9bIVwKfjXwNxC9D8hEe52Ugjy', NULL, NULL, '2023-12-19 19:41:15'),
(2, 'User', 'user@gmail.com', NULL, '08036906317', 'Cross River', '202402040522202012031949Ambrose-Chui-Cropped-200x200.jpg', 'user', 'active', '$2y$12$KmbGm3rX7Yt6EVnYn9MZg.Ua.Y3LFePZwZMccjPEB2kRT1RTCD/jy', 'Sc69JTu9ghtOSWPOoieTGNGEgpRxR6yK28f39jFp8qKSLvqUIci7qldykKxt', NULL, '2024-02-04 03:22:00'),
(3, 'Test', 'test@test.com', NULL, NULL, NULL, NULL, 'user', 'active', '$2y$12$YtHxebeiTRAf7eoL/CYfF.0hG5KYj/EzwRaTYTyueoB9s5Ers6C4u', NULL, '2023-12-17 10:13:33', '2023-12-17 10:13:33'),
(4, 'Namadi', 'namadi@gmail.com', NULL, NULL, NULL, NULL, 'user', 'active', '$2y$12$8EZrOojQY4cCNjQxcL3zqu.FpgpFBOBBRRdiWEwQzGC6X8A/N3a.2', NULL, '2023-12-25 09:08:51', '2023-12-25 09:08:51');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
