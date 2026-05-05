-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2026 at 09:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `opentrip`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `booking_code` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `participant` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `meeting_point_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `booking_code`, `user_id`, `schedule_id`, `participant`, `total_price`, `status`, `created_at`, `meeting_point_id`, `updated_at`, `document`) VALUES
(2, 'TRIP-20260310123630859', 2, 9, 1, 130000.00, 'confirmed', '2026-03-10 05:36:30', NULL, '2026-03-10 05:39:14', NULL),
(3, 'TRIP-20260310123959515', 1, 9, 1, 130000.00, 'confirmed', '2026-03-10 05:39:59', NULL, '2026-03-10 05:43:03', NULL),
(5, 'TRIP-20260310125824887', 1, 9, 1, 130000.00, 'confirmed', '2026-03-10 05:58:24', NULL, '2026-03-10 06:01:24', NULL),
(30, 'TRIP-20260325-1FC58', 1, 9, 1, 130000.00, 'confirmed', '2026-03-25 07:43:37', NULL, '2026-03-25 07:43:48', NULL),
(43, 'TRIP-20260328-4DFFD', 1, 9, 1, 130000.00, 'confirmed', '2026-03-28 04:42:18', NULL, '2026-03-28 04:42:32', NULL),
(44, 'TRIP-20260328-15BD6', 1, 9, 1, 130000.00, 'confirmed', '2026-03-28 04:45:36', NULL, '2026-03-28 04:45:51', NULL),
(46, 'TRIP-20260328-FDFF2', 1, 9, 1, 130000.00, 'confirmed', '2026-03-28 04:55:42', NULL, '2026-03-28 04:55:59', NULL),
(47, 'TRIP-20260328-40014', 1, 9, 1, 130000.00, 'confirmed', '2026-03-28 04:57:35', NULL, '2026-03-28 04:57:50', NULL),
(48, 'TRIP-20260328-62BA2', 1, 9, 1, 130000.00, 'confirmed', '2026-03-28 05:01:43', NULL, '2026-03-28 05:01:58', NULL),
(49, 'TRIP-20260328-19295', 1, 12, 1, 850000.00, 'confirmed', '2026-03-28 05:04:42', NULL, '2026-03-28 05:04:57', NULL),
(50, 'TRIP-20260328-E464C', 1, 12, 1, 850000.00, 'confirmed', '2026-03-28 09:51:45', 13, '2026-03-28 09:52:04', NULL),
(51, 'TRIP-20260330-0349C', 1, 12, 1, 850000.00, 'confirmed', '2026-03-30 03:09:18', 13, '2026-03-30 03:09:34', NULL),
(52, 'TRIP-20260402-FEA6C', 1, 9, 1, 130000.00, 'cancelled', '2026-04-02 05:01:19', 14, '2026-04-02 05:15:08', NULL),
(53, 'TRIP-20260406-958FF', 1, 9, 1, 130000.00, 'confirmed', '2026-04-06 08:08:30', 14, '2026-04-06 08:13:45', NULL),
(54, 'TRIP-20260407-11175', 1, 12, 2, 1700000.00, 'confirmed', '2026-04-07 10:10:36', 13, '2026-04-08 06:54:10', NULL),
(55, 'TRIP-20260408-EC6FD', 6, 9, 1, 130000.00, 'cancelled', '2026-04-08 07:58:33', 14, '2026-04-08 08:18:28', NULL),
(56, 'TRIP-20260408-A61EB', 1, 9, 1, 130000.00, 'confirmed', '2026-04-08 08:17:59', 14, '2026-04-08 08:18:31', NULL),
(57, 'TRIP-20260411-D05EA', 1, 9, 1, 130000.00, 'pending', '2026-04-11 00:20:54', 15, '2026-04-11 00:20:54', NULL),
(58, 'TRIP-20260416-D2779', 1, 14, 2, 2400000.00, 'confirmed', '2026-04-16 05:58:57', 18, '2026-04-16 05:59:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `trip_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `trip_id`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(8, 1, 14, 'Pengalaman yang sangat seru dengan teman trip dari berbagai daerah hahahaha', 'approved', '2026-03-30 03:11:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `document_id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `ktp` varchar(255) DEFAULT NULL,
  `health` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`document_id`, `booking_id`, `type`, `file`, `status`, `updated_at`, `name`, `email`, `birthdate`, `gender`, `ktp`, `health`) VALUES
(1, 2, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 30, NULL, NULL, NULL, NULL, 'Asep Suparman', 'sahargntg@gmail.com', '2004-03-10', 'Laki-laki', '1774424617_7446ee4858548f51b6ad.png', '1774424617_9ff381ebd8996964cced.png'),
(48, 43, NULL, NULL, 'pending', NULL, 'Sahar', 'sahargntg@gmail.com', '2004-03-10', 'Laki-laki', '1774672938_e8a4f79bff3ecd1ea932.png', '1774672938_c31151099ba7dac83841.png'),
(49, 44, NULL, NULL, 'pending', NULL, 'Kipli', 'sahargntg@gmail.com', '2002-02-10', 'Laki-laki', '1774673136_f97025338233e5cb0536.jpeg', '1774673136_2060a07e6a96b5c32a9f.png'),
(51, 46, NULL, NULL, 'pending', NULL, 'Sahar', 'sahargntg@gmail.com', '2001-02-10', 'Laki-laki', '1774673742_b59eef56e98b5bb98449.png', '1774673742_73699408088970d42bbc.png'),
(52, 47, NULL, NULL, 'pending', NULL, 'Susan', 'sahargntg@gmail.com', '2001-02-10', 'Perempuan', '1774673855_80b97fd93f93c02bd9a6.png', '1774673855_9fc42f7a974174c48629.png'),
(53, 48, NULL, NULL, 'pending', NULL, 'Sahar', 'sahargntg@gmail.com', '2005-03-10', 'Laki-laki', '1774674103_5f2c18e3b73e941a701a.jpeg', '1774674103_eccff450e4dca8cd160a.jpeg'),
(54, 49, NULL, NULL, 'pending', NULL, 'Sahar', 'sahargntg@gmail.com', '2002-03-10', 'Laki-laki', '1774674282_9e9b802201a863ac5ed2.png', '1774674282_b9d7f4317647c4f6bea9.png'),
(55, 50, NULL, NULL, 'pending', NULL, 'Sahar', 'sahargntg@gmail.com', '2005-03-10', 'Laki-laki', '1774691505_60a2703617f400244471.jpeg', '1774691505_49b864dce911357d1cdc.jpeg'),
(56, 51, NULL, NULL, 'pending', NULL, 'Sahar', 'sahargntg@gmail.com', '2003-03-10', 'Laki-laki', '1774840158_e1c7e5d2f233014ae094.jpeg', '1774840158_5c3f5297c2487c34b369.jpeg'),
(57, 52, NULL, NULL, 'pending', NULL, 'Sahar', 'sahargntg@gmail.com', '2003-03-10', 'Laki-laki', '1775106079_c2b6ebc8d3e1dc0c7e9a.png', '1775106079_f9fb3794e631cee9c437.png'),
(58, 53, NULL, NULL, 'pending', NULL, 'Sahar', 'sahargntg@gmail.com', '2002-03-10', 'Laki-laki', '1775462910_378fa8f8f610ea05408b.png', '1775462910_5ce3ebf0d3210d65850e.png'),
(59, 54, NULL, NULL, 'pending', NULL, 'Ronaldo', 'sahargntg@gmail.com', '2001-02-10', 'Laki-laki', '1775556637_5a876f815cfcef050b7f.png', '1775556637_275bb4c07a77abad2436.png'),
(60, 54, NULL, NULL, 'pending', NULL, 'Messi', 'sahargntg@gmail.com', '2002-03-10', 'Laki-laki', '1775556637_212ba128c5143ad511ee.png', '1775556637_b957e8f2a9bfd02823a5.png'),
(61, 55, NULL, NULL, 'pending', NULL, 'Sahar', 'sahargntg@gmail.com', '2026-04-08', 'Laki-laki', '1775635113_d78c71c713f7a276ca62.png', '1775635113_07ccd970f18d2c904f95.png'),
(62, 56, NULL, NULL, 'pending', NULL, 'Asep Suparman', 'sahargntg@gmail.com', '2021-11-11', 'Laki-laki', '1775636279_c43cd4be94d4a99d3e79.png', '1775636279_aca31ad4e21f6ff7e7ea.png'),
(63, 57, NULL, NULL, 'pending', NULL, 'Sahar', 'sahargntg@gmail.com', '2002-01-10', 'Laki-laki', '1775866854_9deb5b7a7a7a8027ff71.png', '1775866854_1f4665ee56ede4982aa2.png'),
(64, 58, NULL, NULL, 'pending', NULL, 'Messi', 'sahargntg@gmail.com', '2001-12-11', 'Laki-laki', '1776319137_1c15d225cd52b5ff6fdb.png', '1776319137_c88bb5a4d72a3994916b.png'),
(65, 58, NULL, NULL, 'pending', NULL, 'Ronaldo', 'sahargntg@gmail.com', '1998-07-10', 'Laki-laki', '1776319137_e0e8ea8fae94e301fcdd.png', '1776319137_71906ec1013b12e542de.png');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `gallery_id` int(11) NOT NULL,
  `trip_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `album` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`gallery_id`, `trip_id`, `title`, `album`, `image`, `created_at`, `updated_at`) VALUES
(4, NULL, 'www', 'www', '1774765244_1b4693cf8adbf7fd03e6.jpg', '2026-03-29 13:20:44', '0000-00-00 00:00:00'),
(7, NULL, 'urgyyryr', 'santos', '1775110855_92b177eb545136d51748.jpeg', '2026-04-02 13:20:55', '0000-00-00 00:00:00'),
(8, NULL, 'sayang', 'www', '1775111099_53ac022722a59313e799.jpeg', '2026-04-02 13:24:59', '0000-00-00 00:00:00'),
(9, NULL, 'yetey', 'sisp', '1775111148_59e91a8e00982bb7b97e.jpg', '2026-04-02 13:25:48', '0000-00-00 00:00:00'),
(18, NULL, 'Gunung Rinjani', 'Gunung Rinjani', '1774840066_69c9e902798bd.jpg', '2026-03-30 03:07:46', NULL),
(21, NULL, 'Gunung Merbabu', 'Gunung Merbabu', '1775956469_69daf1f5195e4.jpg', '2026-04-12 01:14:29', NULL),
(22, NULL, 'Gunung Merbabu', 'Gunung Merbabu', '1775956488_69daf2087611b.jpg', '2026-04-12 01:14:48', NULL),
(24, NULL, 'Gunung Rinjani', 'Gunung Rinjani', '1776055661_69dc756d1271d.jpg', '2026-04-13 04:47:41', NULL),
(25, NULL, 'Gunung Merbabu', 'Gunung Merbabu', '1776055683_69dc75832c848.jpg', '2026-04-13 04:48:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoice_id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `invoice_number` varchar(50) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meeting_points`
--

CREATE TABLE `meeting_points` (
  `meeting_point_id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meeting_points`
--

INSERT INTO `meeting_points` (`meeting_point_id`, `trip_id`, `name`, `address`, `created_at`, `updated_at`) VALUES
(12, 14, 'Alun-Alun Subang', '', '2026-03-28 05:32:29', NULL),
(13, 13, 'Alun-Alun Subang', '', '2026-03-28 05:33:16', NULL),
(14, 10, 'Alun-Alun Subang', '', '2026-03-28 05:34:50', NULL),
(15, 10, 'Alun-Alun Jalancagak', '', '2026-03-28 05:34:50', NULL),
(18, 15, 'Alun-Alun Subang', '', '2026-04-13 04:44:04', NULL),
(19, 15, 'Alun-alun Bandung', '', '2026-04-13 04:44:04', NULL),
(21, 25, 'Cibaduyut', '', '2026-04-10 22:49:54', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `method` varchar(50) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `proof` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `booking_id`, `method`, `amount`, `proof`, `status`, `paid_at`, `updated_at`) VALUES
(1, 2, 'Transfer Bank', 130000.00, NULL, 'waiting', '2026-03-10 12:36:30', NULL),
(2, 3, 'Transfer Bank', 130000.00, '1773121199_ee27d2cef683abe36a6c.png', 'waiting', '2026-03-10 12:39:59', NULL),
(4, 5, 'Transfer Bank', 130000.00, '1773122304_2bc64cbe8009e9bef1bc.png', 'waiting', '2026-03-10 12:58:24', NULL),
(29, 30, 'Transfer Bank', NULL, '1774424617_5221fe0b3eb51d6e8423.png', 'verified', '2026-03-25 14:43:37', '2026-03-25 07:43:48'),
(38, 43, 'E-Wallet', 130000.00, '1774672938_60c26e10299b9e997cd7.png', 'verified', '2026-03-28 11:42:32', '2026-03-28 04:42:32'),
(39, 44, 'E-Wallet', 130000.00, '1774673136_b48b5ba18e1ca979f701.jpeg', 'verified', '2026-03-28 11:45:51', '2026-03-28 04:45:51'),
(41, 46, 'E-Wallet', 130000.00, '1774673742_e8fe1e471ef74ed96d5d.png', 'verified', '2026-03-28 11:55:59', '2026-03-28 04:55:59'),
(42, 47, 'Transfer Bank', 130000.00, '1774673855_583cf8e43db7f8741e10.jpg', 'verified', '2026-03-28 11:57:50', '2026-03-28 04:57:50'),
(43, 48, 'Transfer Bank', 130000.00, '1774674103_cd3f25b215970e965b8c.jpeg', 'verified', '2026-03-28 12:01:58', '2026-03-28 05:01:58'),
(44, 49, 'Transfer Bank', 850000.00, '1774674282_821caab96a42724b6cc4.png', 'verified', '2026-03-28 12:04:57', '2026-03-28 05:04:57'),
(45, 50, 'Transfer Bank', 850000.00, '1774691505_5bfe4a0c9d3f09db3d88.jpeg', 'verified', '2026-03-28 16:52:04', '2026-03-28 09:52:04'),
(46, 51, 'E-Wallet', 850000.00, '1774840158_7c613d75b30bba36c1d0.jpeg', 'verified', '2026-03-30 10:09:34', '2026-03-30 03:09:34'),
(47, 52, 'Transfer Bank', 130000.00, '1775106079_4ceca0b354531b8b3105.png', 'rejected', NULL, '2026-04-02 05:15:08'),
(48, 53, 'Transfer Bank', 130000.00, '1775462910_f89fcedcd22f8e7eb3d4.png', 'verified', '2026-04-06 15:13:45', '2026-04-06 08:13:45'),
(49, 54, 'Transfer Bank', 1700000.00, '1775556637_3594effad452381c2abe.png', 'verified', '2026-04-08 13:54:10', '2026-04-08 06:54:10'),
(50, 55, 'Transfer Bank', 130000.00, '1775635113_fc6ebfab4dc040257377.png', 'rejected', NULL, '2026-04-08 08:18:28'),
(51, 56, 'Transfer Bank', 130000.00, '1775636279_fea70ba2558938c895bf.png', 'verified', '2026-04-08 15:18:31', '2026-04-08 08:18:31'),
(52, 57, 'Transfer Bank', 130000.00, '1775866854_b7a685cdc52593828f1d.png', 'pending', NULL, '2026-04-11 00:20:54'),
(53, 58, 'E-Wallet', 2400000.00, '1776319137_50a37dbd121464575d65.png', 'verified', '2026-04-16 12:59:16', '2026-04-16 05:59:16');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `schedule_id` int(11) NOT NULL,
  `trip_id` int(11) DEFAULT NULL,
  `departure_date` date DEFAULT NULL,
  `quota` int(11) DEFAULT NULL,
  `available` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`schedule_id`, `trip_id`, `departure_date`, `quota`, `available`, `updated_at`) VALUES
(9, 10, '2026-03-12', 15, 8, NULL),
(12, 13, '2026-03-13', 20, 12, NULL),
(13, 14, '2026-04-01', 15, 15, NULL),
(14, 15, '2026-05-13', 10, 8, NULL),
(24, 25, '2026-04-10', 10, 4, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `trip_id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','full','cancelled') DEFAULT 'active',
  `type` enum('one_day_trip','open_trip','private_trip') DEFAULT 'open_trip',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `quota` int(11) DEFAULT 0,
  `updated_at` timestamp NULL DEFAULT NULL,
  `whatsapp_group` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`trip_id`, `title`, `location`, `description`, `price`, `image`, `status`, `type`, `created_at`, `quota`, `updated_at`, `whatsapp_group`) VALUES
(10, 'Gunung Bongkok', 'Purwakarta', 'SAsaS', 130000.00, '1774676090_16f349c57f89b27bf464.png', 'active', 'one_day_trip', '2026-03-10 04:42:43', 15, NULL, 'https://chat.whatsapp.com/EeQereyvtuw355XX77vq7w'),
(13, 'Gunung Merbabu', 'Magelang', 'BShawdbh', 850000.00, '1774674231_eb22ea8f1220f7f5846e.jpg', 'active', 'open_trip', '2026-03-28 05:03:51', 20, NULL, 'https://chat.whatsapp.com/EeQereyvtuw355XX77vq7w'),
(14, 'Gunung Rinjani', 'Subang', 'Gunung Rinjani mantap', 1200000.00, '1774675949_81d2efe1cbe87c90bfb5.jpg', 'active', 'open_trip', '2026-03-28 05:32:29', 15, NULL, 'https://chat.whatsapp.com/EeQereyvtuw355XX77vq7w'),
(15, 'Gunung Semeru', 'Jepang', 'afef', 1200000.00, '1776055444_d2ec60db6c5db638cff6.jpg', 'active', 'open_trip', '2026-04-13 03:24:14', 10, NULL, 'https://chat.whatsapp.com/EeQereyvtuw355XX77vq7w'),
(25, 'Gunung Capstone', 'unsub', 'Gunung yang diamana mempertemukan kita berdua', 2000000.00, '1775836194_5e780db63b33c0110be3.png', 'active', 'open_trip', '0000-00-00 00:00:00', 10, '0000-00-00 00:00:00', 'https://chat.whatsapp.com/IG3FSr9gHCl2jSueqFqvzt?mode=gi_t');

-- --------------------------------------------------------

--
-- Table structure for table `trip_includes`
--

CREATE TABLE `trip_includes` (
  `include_id` int(11) NOT NULL,
  `trip_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trip_includes`
--

INSERT INTO `trip_includes` (`include_id`, `trip_id`, `title`, `updated_at`) VALUES
(5, 13, 'Makan Siang, Malam', NULL),
(12, 25, 'Transport PP', '0000-00-00 00:00:00'),
(13, 25, 'Transport PP', '0000-00-00 00:00:00'),
(14, 25, 'Transport PP', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `trip_itinerary`
--

CREATE TABLE `trip_itinerary` (
  `itinerary_id` int(11) NOT NULL,
  `trip_id` int(11) DEFAULT NULL,
  `time` varchar(20) DEFAULT NULL,
  `activity` varchar(255) DEFAULT NULL,
  `day` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trip_itinerary`
--

INSERT INTO `trip_itinerary` (`itinerary_id`, `trip_id`, `time`, `activity`, `day`, `sort_order`, `updated_at`) VALUES
(5, 13, '08:00', 'Kumpul di Alun-alun Subang', NULL, NULL, NULL),
(11, 25, '05:00', 'Persiapan di Basecamp', NULL, 0, '0000-00-00 00:00:00'),
(12, 25, '05:01', 'gak jadi males pengen beli truk', NULL, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `reset_token` varchar(100) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `role` enum('admin','customer') DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `points` int(11) DEFAULT 0,
  `avatar` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `phone`, `password`, `reset_token`, `reset_expires`, `role`, `created_at`, `points`, `avatar`, `updated_at`) VALUES
(1, 'Sahar Dwi Anugrah', 'sahargntg@gmail.com', '081324768193', '$2y$10$mIRfKOGaXdHQqbGzCvQXju9YhLfXK/R3SSaXqsY5KnuNk72wPHsBe', NULL, NULL, 'customer', '2026-03-03 06:23:19', 240, NULL, '2026-04-17 08:18:58'),
(2, 'Administrator BLNTRK', 'admin@gmail.com', NULL, '$2y$10$ZaK9qBFKUygwOZyGJ2MZselNu1BX9BE0jy0xEznPHI36oZI30mVYK', NULL, NULL, 'admin', '2026-03-03 07:09:27', 0, NULL, NULL),
(4, 'admin', 'admin123@gmail.com', NULL, 'admin123', NULL, NULL, 'admin', '2026-03-03 07:10:51', 0, NULL, NULL),
(6, 'SaharAdmin', 'admin1234@gmail.com', NULL, '$2y$10$MbXtpHWm7AfJcdAQn6rY2Og7vB6aFycXbH2nUmJlGr6FHOdX.Zml.', NULL, NULL, 'admin', '2026-03-12 02:39:49', 20, NULL, '2026-03-28 04:53:32'),
(7, 'Asep', 'Asep@gmail.com', NULL, '$2y$10$TVP69bfaQ3LNk7ELLa5nxeHSaeU/LHWBNYnNE9foGacJtBeUueI9S', NULL, NULL, 'customer', '2026-03-16 14:45:17', 0, NULL, '2026-03-16 14:45:17'),
(8, 'Tatang', 'tatangabdullah96@gmail.com', NULL, '$2y$10$aZbAvWKcUQFL/Biy25W48eIoUcNFw5QGKw01i8oieap5KYMU2ps5.', NULL, NULL, 'customer', '2026-03-26 12:35:19', 0, NULL, '2026-04-06 08:22:52'),
(9, 'Kipli', 'Kiplitampan@gmail.com', NULL, '$2y$10$OgdjytGCUlqwp9hrVTKjJ./NZkt5n7pKFlLZQewpjCvCKmbBHBD96', NULL, NULL, 'customer', '2026-04-06 08:21:34', 0, NULL, '2026-04-06 08:21:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `fk_booking_user` (`user_id`),
  ADD KEY `fk_booking_schedule` (`schedule_id`),
  ADD KEY `fk_booking_meetingpoint` (`meeting_point_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `comments_ibfk_2` (`trip_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `fk_documents_booking` (`booking_id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`gallery_id`),
  ADD KEY `fk_gallery_trip` (`trip_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `fk_invoices_booking` (`booking_id`);

--
-- Indexes for table `meeting_points`
--
ALTER TABLE `meeting_points`
  ADD PRIMARY KEY (`meeting_point_id`),
  ADD KEY `fk_meetingpoint_trip` (`trip_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `fk_payments_booking` (`booking_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `schedules_ibfk_1` (`trip_id`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`trip_id`);

--
-- Indexes for table `trip_includes`
--
ALTER TABLE `trip_includes`
  ADD PRIMARY KEY (`include_id`),
  ADD KEY `trip_id` (`trip_id`);

--
-- Indexes for table `trip_itinerary`
--
ALTER TABLE `trip_itinerary`
  ADD PRIMARY KEY (`itinerary_id`),
  ADD KEY `trip_id` (`trip_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meeting_points`
--
ALTER TABLE `meeting_points`
  MODIFY `meeting_point_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `trip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `trip_includes`
--
ALTER TABLE `trip_includes`
  MODIFY `include_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `trip_itinerary`
--
ALTER TABLE `trip_itinerary`
  MODIFY `itinerary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_booking_meetingpoint` FOREIGN KEY (`meeting_point_id`) REFERENCES `meeting_points` (`meeting_point_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_booking_schedule` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`schedule_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_booking_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`trip_id`) ON DELETE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `fk_documents_booking` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `fk_gallery_trip` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`trip_id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `fk_invoices_booking` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meeting_points`
--
ALTER TABLE `meeting_points`
  ADD CONSTRAINT `fk_meetingpoint_trip` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`trip_id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payments_booking` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`trip_id`) ON DELETE CASCADE;

--
-- Constraints for table `trip_includes`
--
ALTER TABLE `trip_includes`
  ADD CONSTRAINT `trip_includes_ibfk_1` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`trip_id`) ON DELETE CASCADE;

--
-- Constraints for table `trip_itinerary`
--
ALTER TABLE `trip_itinerary`
  ADD CONSTRAINT `trip_itinerary_ibfk_1` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`trip_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
