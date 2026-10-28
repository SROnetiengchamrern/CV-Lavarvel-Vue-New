-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2026 at 02:45 AM
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
-- Database: `chamrern_cv`
--

-- --------------------------------------------------------

--
-- Table structure for table `aws_courses`
--

CREATE TABLE `aws_courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `title_km` varchar(255) DEFAULT NULL,
  `course_code` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'Student',
  `role_km` varchar(255) DEFAULT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT 1,
  `badge_color` varchar(20) NOT NULL DEFAULT '#0ea5e9',
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aws_courses`
--

INSERT INTO `aws_courses` (`id`, `title`, `title_km`, `course_code`, `role`, `role_km`, `is_completed`, `badge_color`, `sort_order`, `created_at`, `updated_at`) VALUES
(15, 'AWS Academy Cloud Architecting', 'វគ្គ AWS Academy Cloud Architecting', NULL, 'Student', 'សិស្ស', 1, '#ec4899', 0, '2026-10-22 13:55:03', '2026-10-22 14:35:40'),
(17, 'AWS Academy Cloud Foundations', 'វគ្គ AWS Academy Cloud Foundations', NULL, 'Student', 'សិស្ស', 1, '#0d9488', 2, '2026-10-22 13:55:03', '2026-10-22 14:35:50'),
(18, 'AWS Academy Cloud Operations', 'វគ្គ AWS Academy Cloud Operations', NULL, 'Student', 'សិស្ស', 1, '#166534', 3, '2026-10-22 13:55:03', '2026-10-22 14:35:55'),
(19, 'AWS Academy Cloud Security Foundations', 'វគ្គ AWS Academy Cloud Security Foundations', NULL, 'Student', 'សិស្ស', 1, '#15803d', 4, '2026-10-22 13:55:03', '2026-10-22 14:35:59'),
(20, 'AWS Academy Data Engineering', 'វគ្គ AWS Academy Data Engineering', NULL, 'Student', 'សិស្ស', 1, '#db2777', 5, '2026-10-22 13:55:03', '2026-10-22 14:36:05'),
(21, 'AWS Academy Machine Learning Foundations', 'វគ្គ AWS Academy Machine Learning Foundations', NULL, 'Student', 'សិស្ស', 1, '#2563eb', 6, '2026-10-22 13:55:03', '2026-10-22 14:36:09');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_certificates`
--

CREATE TABLE `course_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `aws_course_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `original_name` varchar(255) DEFAULT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `file_size` bigint(20) UNSIGNED DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_certificates`
--

INSERT INTO `course_certificates` (`id`, `aws_course_id`, `title`, `file_path`, `original_name`, `mime_type`, `file_size`, `sort_order`, `created_at`, `updated_at`) VALUES
(2, 21, 'AWS Academy Graduate AWS Academy Cloud Foundations', 'certificates/aws/pLUEjSsXIpxVbQJii2Z1LTNXamf5i5K8cAcRQkWD.png', 'AWS Academy Graduate AWS Academy Cloud Foundations.png', 'image/png', 205855, 1, '2026-10-22 15:21:34', '2026-10-22 15:21:34'),
(3, 17, 'AWS Academy Graduate AWS Academy Cloud Foundations', 'certificates/aws/1L7eYiFFU5wJ3RY9ARJkPHoVPQ49UsjifjlZuitV.png', 'AWS Academy Graduate AWS Academy Cloud Foundations.png', 'image/png', 205855, 1, '2026-10-22 15:22:37', '2026-10-22 15:22:37'),
(4, 15, 'AWS_Academy_Graduate_AWS_Academy_Cloud_Architecting_Badge20250425', 'certificates/aws/XykQZaRj3WbIVkjkwvpV2Mna9NrOmy9q6UNc8GqC.pdf', 'AWS_Academy_Graduate_AWS_Academy_Cloud_Architecting_Badge20250425.pdf', 'application/pdf', 228458, 1, '2026-10-22 15:22:59', '2026-10-22 15:22:59'),
(5, 19, 'AWS_Academy_Graduate_AWS_Academy_Cloud_Security_Foundations_Badge20250609', 'certificates/aws/aU3nRDDOxu7ycHbsjI2evKzHadiTxHqplERE9iM8.pdf', 'AWS_Academy_Graduate_AWS_Academy_Cloud_Security_Foundations_Badge20250609.pdf', 'application/pdf', 990249, 1, '2026-10-22 15:29:16', '2026-10-22 15:29:16'),
(6, 18, 'AWS_Academy_Graduate_AWS_Academy_Cloud_Operations_Badge20250609', 'certificates/aws/CO8gbg7dJQGPqh3dKNw7cmkwODwYWNQqrDTRKDoL.pdf', 'AWS_Academy_Graduate_AWS_Academy_Cloud_Operations_Badge20250609.pdf', 'application/pdf', 990102, 1, '2026-10-22 15:29:45', '2026-10-22 15:29:45');

-- --------------------------------------------------------

--
-- Table structure for table `cv_files`
--

CREATE TABLE `cv_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT 'CV',
  `title_km` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `original_name` varchar(255) DEFAULT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `file_size` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cv_files`
--

INSERT INTO `cv_files` (`id`, `title`, `title_km`, `file_path`, `original_name`, `mime_type`, `file_size`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'CV', NULL, 'cv-files/Vc1YTaophIKWbLZKAWLmzOasQYKRB8LxyMU2Tw9Y.pdf', 'Tieng-Chamrern.pdf', 'application/pdf', 19870709, 1, '2026-10-23 23:50:53', '2026-10-23 23:50:53');

-- --------------------------------------------------------

--
-- Table structure for table `cv_references`
--

CREATE TABLE `cv_references` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_km` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `title_km` varchar(255) DEFAULT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `organization_km` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cv_references`
--

INSERT INTO `cv_references` (`id`, `name`, `name_km`, `title`, `title_km`, `organization`, `organization_km`, `phone`, `sort_order`, `created_at`, `updated_at`) VALUES
(9, 'Mr. Hor Sothy', 'លោក ហោ សុធី', 'Engineering', 'វិស្វកម្ម', 'National Technical Training Institute (NTTI)', 'វិទ្យាស្ថានបណ្តុះបណ្តាលបច្ចេកទេសជាតិ (NTTI)', '093 947 311', 0, '2026-10-22 13:55:03', '2026-10-22 15:33:02'),
(10, 'Mr. Kim Vanna', 'លោក គឹម វណ្ណា', 'Management Information System', 'ប្រព័ន្ធព័ត៌មានគ្រប់គ្រង', 'SETEC INSTITUTE', 'វិទ្យាស្ថាន SETEC', '010 591 330', 1, '2026-10-22 13:55:03', '2026-10-22 15:33:13');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `years` varchar(255) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `institution_km` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `description_km` varchar(255) DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `years`, `institution`, `institution_km`, `description`, `description_km`, `sort_order`, `created_at`, `updated_at`) VALUES
(21, '2023 - Present', 'SETEC INSTITUTE', 'វិទ្យាស្ថានស៊ីតិក', 'Master\'s Degree of Management Information System (MIS)', 'បរិញ្ញាបត្រជាន់ខ្ពស់ផ្នែកប្រព័ន្ធព័ត៌មានគ្រប់គ្រង (MIS)', 0, '2026-10-22 13:55:03', '2026-10-22 14:12:37'),
(22, '2019 - 2023', 'SETEC INSTITUTE', 'វិទ្យាស្ថានស៊ីតិក', 'Bachelor\'s Degree of Management Information System (MIS)', 'បរិញ្ញាបត្រផ្នែកប្រព័ន្ធព័ត៌មានគ្រប់គ្រង (MIS)', 1, '2026-10-22 13:55:03', '2026-10-22 14:12:45'),
(23, '2016 - 2019', 'Studied at Batheay High School At Batheay Village, Batheay Commune, Batheay District, Kompong Cham Province, in Cambodia.', 'បានសិក្សានៅវិទ្យាល័យបាធាយ ភូមិបាធាយ ឃុំបាធាយ ស្រុកបាធាយ ខេត្តកំពង់ចាម', 'High School', 'មធ្យមសិក្សាទុតិយភូមិ', 2, '2026-10-22 13:55:03', '2026-10-22 14:14:43'),
(24, '2010 - 2016', 'Studied at Mepring Secondary School At Mepring Village, Mepring Commune, Batheay District,  Kompong Cham Province, in Cambodia.', 'បានសិក្សានៅអនុវិទ្យាល័យមេព្រីង ភូមិមេព្រីង ឃុំមេព្រី ស្រុកបាធាយ ខេត្តកំពង់ចាម', 'Secondary School', 'មធ្យមសិក្សាបឋមភូមិ', 3, '2026-10-22 13:55:03', '2026-10-22 14:16:40'),
(25, '2006 - 2010', 'Studied at Taing Srey Primary School At Taing Srey Village, Mepring Commune, Batheay District, Kompong Cham Province, in Cambodia.', 'បានសិក្សានៅបឋមសិក្សាតាំងស្រី ភូមិតាំងស្រី ឃុំមេព្រីង ស្រុកបាធាយ ខេត្តកំពង់ចាម', 'Primary School', 'បឋមសិក្សា', 4, '2026-10-22 13:55:03', '2026-10-22 14:17:49');

-- --------------------------------------------------------

--
-- Table structure for table `education_documents`
--

CREATE TABLE `education_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `education_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `original_name` varchar(255) DEFAULT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `file_size` bigint(20) UNSIGNED DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `education_documents`
--

INSERT INTO `education_documents` (`id`, `education_id`, `title`, `file_path`, `original_name`, `mime_type`, `file_size`, `sort_order`, `created_at`, `updated_at`) VALUES
(6, 22, 'CamScanner 10-19-2024 13.36', 'certificates/degrees/8e5iKT7KW2VYMyc7b4AcOVYo4LtferTu5JC7unpz.jpg', 'CamScanner 10-19-2024 13.36.jpg', 'image/jpeg', 457587, 1, '2026-10-22 15:08:28', '2026-10-22 15:08:28'),
(7, 22, '20240316_143435', 'certificates/degrees/L0vOoHMcqRK0yJd8hhTlwBQkoG25ld9uYhDjgpGh.jpg', '20240316_143435.jpg', 'image/jpeg', 1396489, 2, '2026-10-22 15:08:44', '2026-10-22 15:08:44'),
(8, 23, 'IMG_20221021_213801_498', 'certificates/degrees/BDP4rHx1F2WpEOSf5q6VXDfaXbSpk1x6A42TNpbI.jpg', 'IMG_20221021_213801_498.jpg', 'image/jpeg', 88808, 2, '2026-10-22 15:09:07', '2026-10-22 15:09:07');

-- --------------------------------------------------------

--
-- Table structure for table `experiences`
--

CREATE TABLE `experiences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `years` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `company_km` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `role_km` varchar(255) DEFAULT NULL,
  `highlights` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`highlights`)),
  `highlights_km` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`highlights_km`)),
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experiences`
--

INSERT INTO `experiences` (`id`, `years`, `company`, `company_km`, `role`, `role_km`, `highlights`, `highlights_km`, `sort_order`, `created_at`, `updated_at`) VALUES
(21, '2023 - Present', 'Khmer Gaming Software Solution Co., Ltd.', 'ក្រុមហ៊ុន Khmer Gaming Software Solution', 'Software Developer', 'អ្នកអភិវឌ្ឍន៍សូហ្វវែរ', '[\"Game Development (Mobile, Web, Desktop)\",\"Platform Integration (API \\/ Third-party)\",\"UI\\/UX Design\"]', '[\"\\u1780\\u17b6\\u179a\\u17a2\\u1797\\u17b7\\u179c\\u178c\\u17d2\\u178d\\u1793\\u17cd\\u17a0\\u17d2\\u1782\\u17c1\\u1798 (Mobile, Web, Desktop)\",\"\\u1780\\u17b6\\u179a\\u1797\\u17d2\\u1787\\u17b6\\u1794\\u17cb\\u1794\\u17d2\\u179a\\u1796\\u17d0\\u1793\\u17d2\\u1792 (API \\/ Third-party)\",\"\\u1780\\u17b6\\u179a\\u179a\\u1785\\u1793\\u17b6 UI\\/UX\"]', 0, '2026-10-22 13:55:03', '2026-10-22 13:55:03'),
(22, '2019 - 2023', 'SETEC INSTITUTE', 'វិទ្យាស្ថានស៊ីតិក', 'Management Information System (MIS)', 'ប្រព័ន្ធគ្រប់គ្រងព័ត៍មានវិទ្យា (MIS)', '[\"Studied information systems, software development, and business technology.\",\"Developed systems and websites through practical projects.\",\"Applied programming and database skills to web application development.\"]', '[\"\\u1794\\u17b6\\u1793\\u179f\\u17b7\\u1780\\u17d2\\u179f\\u17b6\\u17a2\\u17c6\\u1796\\u17b8\\u1794\\u17d2\\u179a\\u1796\\u17d0\\u1793\\u17d2\\u1792\\u1796\\u17d0\\u178f\\u17cc\\u1798\\u17b6\\u1793\\u179c\\u17b7\\u1791\\u17d2\\u1799\\u17b6 \\u1780\\u17b6\\u179a\\u17a2\\u1797\\u17b7\\u179c\\u178c\\u17d2\\u178d\\u1780\\u1798\\u17d2\\u1798\\u179c\\u17b7\\u1792\\u17b8 \\u1793\\u17b7\\u1784\\u1794\\u1785\\u17d2\\u1785\\u17c1\\u1780\\u179c\\u17b7\\u1791\\u17d2\\u1799\\u17b6\\u179f\\u1798\\u17d2\\u179a\\u17b6\\u1794\\u17cb\\u17a2\\u17b6\\u1787\\u17b8\\u179c\\u1780\\u1798\\u17d2\\u1798\\u17d4\",\"\\u1794\\u17b6\\u1793\\u17a2\\u1797\\u17b7\\u179c\\u178c\\u17d2\\u178d\\u1794\\u17d2\\u179a\\u1796\\u17d0\\u1793\\u17d2\\u1792 \\u1793\\u17b7\\u1784\\u1782\\u17c1\\u17a0\\u1791\\u17c6\\u1796\\u17d0\\u179a \\u178f\\u17b6\\u1798\\u179a\\u1799\\u17c8\\u1782\\u1798\\u17d2\\u179a\\u17c4\\u1784\\u17a2\\u1793\\u17bb\\u179c\\u178f\\u17d2\\u178f\\u1787\\u17b6\\u1780\\u17cb\\u179f\\u17d2\\u178f\\u17c2\\u1784\\u17d4\",\"\\u1794\\u17b6\\u1793\\u17a2\\u1793\\u17bb\\u179c\\u178f\\u17d2\\u178f\\u1787\\u17c6\\u1793\\u17b6\\u1789\\u179f\\u179a\\u179f\\u17c1\\u179a\\u1780\\u17bc\\u178a \\u1793\\u17b7\\u1784\\u1782\\u17d2\\u179a\\u1794\\u17cb\\u1782\\u17d2\\u179a\\u1784\\u1798\\u17bc\\u179b\\u178a\\u17d2\\u178b\\u17b6\\u1793\\u1791\\u17b7\\u1793\\u17d2\\u1793\\u1793\\u17d0\\u1799 \\u1780\\u17d2\\u1793\\u17bb\\u1784\\u1780\\u17b6\\u179a\\u17a2\\u1797\\u17b7\\u179c\\u178c\\u17d2\\u178d\\u1780\\u1798\\u17d2\\u1798\\u179c\\u17b7\\u1792\\u17b8\\u1782\\u17c1\\u17a0\\u1791\\u17c6\\u1796\\u17d0\\u179a\\u17d4\"]', 1, '2026-10-22 13:55:03', '2026-10-22 14:31:48'),
(23, '2022 - 2023', 'Katappraisal CO., LTD.', 'ក្រុមហ៊ុន Katappraisal', 'Manager', 'អ្នកគ្រប់គ្រង', '[\"Real Estate Management System\"]', '[\"\\u1794\\u17d2\\u179a\\u1796\\u17d0\\u1793\\u17d2\\u1792\\u1782\\u17d2\\u179a\\u1794\\u17cb\\u1782\\u17d2\\u179a\\u1784\\u17a2\\u1785\\u179b\\u1793\\u1791\\u17d2\\u179a\\u1796\\u17d2\\u1799\"]', 2, '2026-10-22 13:55:03', '2026-10-22 13:55:03'),
(24, '2021 - 2022', 'Anakut Digital', 'អនាគត ឌីជីថល', 'Internship', 'សិក្សាការងារ', '[\"POS, Accounting, HR, School, Money Exchange systems\"]', '[\"\\u1794\\u17d2\\u179a\\u1796\\u17d0\\u1793\\u17d2\\u1792 POS \\u1782\\u178e\\u1793\\u17c1\\u1799\\u17d2\\u1799 HR \\u179f\\u17b6\\u179b\\u17b6 \\u1793\\u17b7\\u1784\\u1794\\u17d2\\u178f\\u17bc\\u179a\\u1794\\u17d2\\u179a\\u17b6\\u1780\\u17cb\"]', 3, '2026-10-22 13:55:03', '2026-10-22 13:55:03'),
(25, '2020 - 2021', 'CAD-CAM LABORATORY', 'មន្ទីរពិសោធន៍ CAD-CAM', 'Dental Design', 'ការរចនាធ្មេញ', '[\"Dental Design\",\"Cut Teeth\",\"Cut Abutment\",\"Use Dental Technology\"]', '[\"\\u1780\\u17b6\\u179a\\u179a\\u1785\\u1793\\u17b6\\u1792\\u17d2\\u1798\\u17c1\\u1789\",\"\\u1780\\u17b6\\u179a\\u1780\\u17b6\\u178f\\u17cb \\u1793\\u17b7\\u1784\\u179a\\u17c0\\u1794\\u1785\\u17c6\\u1792\\u17d2\\u1798\\u17c1\\u1789\",\"\\u1780\\u17b6\\u179a\\u1780\\u17b6\\u178f\\u17cb \\u1793\\u17b7\\u1784\\u179a\\u17c0\\u1794\\u1785\\u17c6\\u17a2\\u17b6\\u1794\\u17ca\\u17bb\\u178f\\u1798\\u17c1\\u1793 (Abutment) \\u178a\\u17c2\\u179b\\u1787\\u17b6\\u1795\\u17d2\\u1793\\u17c2\\u1780\\u178f\\u1797\\u17d2\\u1787\\u17b6\\u1794\\u17cb\\u179a\\u179c\\u17b6\\u1784\\u1792\\u17d2\\u1798\\u17c1\\u1789\\u179f\\u17b7\\u1794\\u17d2\\u1794\\u1793\\u17b7\\u1798\\u17d2\\u1798\\u17b7\\u178f \\u1793\\u17b7\\u1784\\u178a\\u17bb\\u17c6\\u1795\\u17d2\\u179f\\u17b6\\u17c6\\u1792\\u17d2\\u1798\\u17c1\\u1789\",\"\\u1780\\u17b6\\u179a\\u1794\\u17d2\\u179a\\u17be\\u1794\\u17d2\\u179a\\u17b6\\u179f\\u17cb\\u1794\\u1785\\u17d2\\u1785\\u17c1\\u1780\\u179c\\u17b7\\u1791\\u17d2\\u1799\\u17b6\\u1791\\u1793\\u17d2\\u178f\\u179f\\u17b6\\u179f\\u17d2\\u178f\\u17d2\\u179a\"]', 4, '2026-10-22 13:55:03', '2026-10-22 14:34:21');

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
-- Table structure for table `interests`
--

CREATE TABLE `interests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `description_km` text DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interests`
--

INSERT INTO `interests` (`id`, `description`, `description_km`, `sort_order`, `created_at`, `updated_at`) VALUES
(13, 'Playing football, boxing, and volleyball', 'លេងបាល់ទាត់ ប្រដាល់ និងបាល់ទះ', 0, '2026-10-22 13:55:03', '2026-10-22 13:55:03'),
(14, 'Reading books and listening to music', 'អានសៀវភៅ និងស្តាប់តន្ត្រី', 1, '2026-10-22 13:55:03', '2026-10-22 13:55:03'),
(15, 'Sharing knowledge with others', 'ចែករំលែកចំណេះដឹងជាមួយអ្នកដទៃ', 2, '2026-10-22 13:55:03', '2026-10-22 13:55:03');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_km` varchar(255) DEFAULT NULL,
  `level` tinyint(3) UNSIGNED NOT NULL DEFAULT 5,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `name_km`, `level`, `sort_order`, `created_at`, `updated_at`) VALUES
(9, 'Khmer', 'ខ្មែរ', 10, 0, '2026-10-22 13:55:03', '2026-10-22 13:55:03'),
(10, 'English', 'អង់គ្លេស', 5, 1, '2026-10-22 13:55:03', '2026-10-23 13:54:09');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_10_22_060145_create_education_table', 1),
(5, '2026_10_22_060145_create_languages_table', 1),
(6, '2026_10_22_060145_create_profiles_table', 1),
(7, '2026_10_22_060145_create_skills_table', 1),
(8, '2026_10_22_060146_create_cv_references_table', 1),
(9, '2026_10_22_060146_create_experiences_table', 1),
(10, '2026_10_22_060146_create_interests_table', 1),
(11, '2026_10_22_060146_create_trainings_table', 1),
(12, '2026_10_22_063837_create_skill_categories_table', 2),
(13, '2026_10_22_064714_add_layout_to_profiles_table', 3),
(14, '2026_10_22_070322_create_aws_courses_table', 4),
(15, '2026_10_22_070322_create_course_certificates_table', 4),
(16, '2026_10_22_071011_create_education_documents_table', 5),
(17, '2026_10_23_033714_add_cover_letter_to_profiles_table', 6),
(18, '2026_10_23_040000_add_khmer_fields_to_cv_tables', 7),
(19, '2026_10_23_050000_create_cv_files_table', 8),
(20, '2026_10_23_060000_add_social_links_to_profiles_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `full_name_km` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `title_km` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_primary` varchar(255) DEFAULT NULL,
  `phone_secondary` varchar(255) DEFAULT NULL,
  `telegram` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address_km` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `gender_km` varchar(255) DEFAULT NULL,
  `date_of_birth` varchar(255) DEFAULT NULL,
  `marital_status` varchar(255) DEFAULT NULL,
  `marital_status_km` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `nationality_km` varchar(255) DEFAULT NULL,
  `place_of_birth` varchar(255) DEFAULT NULL,
  `place_of_birth_km` varchar(255) DEFAULT NULL,
  `layout` varchar(50) NOT NULL DEFAULT 'classic',
  `cover_letter_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `cover_letter_salutation` varchar(255) DEFAULT NULL,
  `cover_letter_salutation_km` varchar(255) DEFAULT NULL,
  `cover_letter_body` longtext DEFAULT NULL,
  `cover_letter_body_km` longtext DEFAULT NULL,
  `cover_letter_closing` text DEFAULT NULL,
  `cover_letter_closing_km` text DEFAULT NULL,
  `cover_letter_signature` varchar(255) DEFAULT NULL,
  `cover_letter_signature_km` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `full_name`, `full_name_km`, `title`, `title_km`, `photo`, `email`, `phone_primary`, `phone_secondary`, `telegram`, `facebook`, `address`, `address_km`, `gender`, `gender_km`, `date_of_birth`, `marital_status`, `marital_status_km`, `nationality`, `nationality_km`, `place_of_birth`, `place_of_birth_km`, `layout`, `cover_letter_enabled`, `cover_letter_salutation`, `cover_letter_salutation_km`, `cover_letter_body`, `cover_letter_body_km`, `cover_letter_closing`, `cover_letter_closing_km`, `cover_letter_signature`, `cover_letter_signature_km`, `created_at`, `updated_at`) VALUES
(5, 'Tieng Chamrern', 'ទៀង​ ចំរើន', 'Full Stack Developer', 'Full Stack Developer', 'profiles/P97wGZC2sviXTL0UAIceDqU3ZsSIod7Qwwi9iWLe.jpg', 'tiengchamrern2@gmail.com', '096 779 7762/078 783 645', NULL, 'https://t.me/TienG_ChamrerN_BTC', 'https://www.facebook.com/tieng.chamrern.2025/', 'Phum Sepese, Sangkat Teuk Thla, Khan Sansokh, Phnom Penh, Cambodia', 'ភូមិសេប៉េសេ សង្កាត់ទឹកថ្លា ខណ្ឌសែនសុខ រាជធានីភ្នំពេញ កម្ពុជា', 'Male', 'ប្រុស', '10-November-2003', 'Single', 'នៅលីវ', 'Khmer', 'ខ្មែរ', 'Taing Srey Village, Mepring Commune, Batheay District, Kompong Cham Province.', 'ភូមិតាំងស្រី ឃុំមេព្រីង ស្រុកបាធាយ ខេត្តកំពង់ចាម', 'emerald', 1, 'Dear Sir / Madam,', 'សូមគោរព ឯកឧត្តម / លោក / លោកស្រី,', 'I am writing to express my strong interest in the Web Developer position. I hold a Bachelor\'s Degree in Management Information Systems and have more than three years of practical experience building web applications.\r\n\r\nAt Khmer Gaming Software Solution Co., Ltd., I have worked on front-end and back-end development using HTML, CSS, JavaScript, PHP, Node.js, React.js, Laravel, and Vue.js, including UI/UX design and platform integration.\r\n\r\nI also have experience with technical troubleshooting, hardware and software repair for laptops and desktops, smartphones, and basic office network setup.', 'ខ្ញុំសូមសរសេរមកដើម្បីបង្ហាញពីចំណាប់អារម្មណ៍ខ្លាំងរបស់ខ្ញុំចំពោះតួនាទីអ្នកអភិវឌ្ឍន៍គេហទំព័រ។ ខ្ញុំមានសញ្ញាបត្របរិញ្ញាបត្រផ្នែកប្រព័ន្ធព័ត៌មានគ្រប់គ្រង (MIS) និងមានបទពិសោធន៍ជាង ៣ ឆ្នាំក្នុងការបង្កើតកម្មវិធីគេហទំព័រ។\r\n\r\nនៅក្រុមហ៊ុន Khmer Gaming Software Solution Co., Ltd. ខ្ញុំបានធ្វើការអភិវឌ្ឍន៍ front-end និង back-end ដោយប្រើ HTML, CSS, JavaScript, PHP, Node.js, React.js, Laravel និង Vue.js រួមទាំងការរចនា UI/UX និងការភ្ជាប់ប្រព័ន្ធ។\r\n\r\nខ្ញុំក៏មានបទពិសោធន៍ក្នុងការដោះស្រាយបញ្ហាបច្ចេកទេស ការជួសជុលហាត់វែរ និងសូហ្វវែរសម្រាប់កុំព្យូទ័រ ស្មាតហ្វូន និងការដំឡើងបណ្តាញការិយាល័យមូលដ្ឋាន។', 'I would welcome the opportunity to discuss how I can contribute to your team. Please feel free to contact me by phone or email.\r\n\r\nThank you for your time and consideration.', 'ខ្ញុំសូមស្វាគមន៍ឱកាសពិភាក្សាអំពីរបៀបដែលខ្ញុំអាចចូលរួមចំណែកក្នុងក្រុមរបស់លោក/លោកស្រី។ សូមទំនាក់ទំនងមកខ្ញុំតាមទូរស័ព្ទ ឬអ៊ីមែល។\r\n\r\nសូមអរគុណចំពោះពេលវេលា និងការពិចារណារបស់លោក/លោកស្រី។', 'Tieng Chamrern', 'ទៀង ចំរើន', '2026-10-22 13:55:03', '2026-10-22 18:07:53');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('7rpyWNmStU7Qkw4fGxK6J44pTbJpGOrPzzVjVD8K', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiZmtYR3c4VGltWG9aYUc0cDNGWkFkNnMxekhOM3Bpd3FTQ1dNRGhZUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9tZWRpYS9wcm9maWxlcy9QOTd3R1pDMnN2aVhUTDBVQUljZURxVTNac1NJb2Q3UXd3aTlpV0xlLmpwZyI7czo1OiJyb3V0ZSI7czoxMDoibWVkaWEuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjY0OiI1ODhmZTk0ZDI5MWRkZDhiYzg1YWEzOWFjMDhjMTFlYjVkYjA1MzlmNGRhYmE5ZDUwMGVjYjFhYzI5NTc2YmRmIjtzOjY6ImxvY2FsZSI7czoyOiJlbiI7fQ==', 1792824657),
('GvgzUChcMHTzWEeqJxjdujCTq9skWQGmcdBZzwPi', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiV0NrbXdKV0tpV1RKT1NWOVl2bjBmOGVEVGhHOEk4NjU5WWpwSlk1ZiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czoyOiJjdiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjY0OiI1ODhmZTk0ZDI5MWRkZDhiYzg1YWEzOWFjMDhjMTFlYjVkYjA1MzlmNGRhYmE5ZDUwMGVjYjFhYzI5NTc2YmRmIjt9', 1792743614),
('qCKUhmfRqBR533MKdPoKlEhaNubNzERHblAUieOs', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoialV2Wm5IeE9scUZmZXl4aVRVc0RjM2RLSkY0NjBCeExCV1pSbkUxTiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAiO3M6NToicm91dGUiO3M6MjoiY3YiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjY0OiI1ODhmZTk0ZDI5MWRkZDhiYzg1YWEzOWFjMDhjMTFlYjVkYjA1MzlmNGRhYmE5ZDUwMGVjYjFhYzI5NTc2YmRmIjtzOjY6ImxvY2FsZSI7czoyOiJlbiI7fQ==', 1792745381);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_km` varchar(255) DEFAULT NULL,
  `level` tinyint(3) UNSIGNED NOT NULL DEFAULT 80,
  `category` varchar(255) NOT NULL DEFAULT 'personal',
  `show_bar` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`, `name_km`, `level`, `category`, `show_bar`, `sort_order`, `created_at`, `updated_at`) VALUES
(153, 'CSS', NULL, 90, 'personal', 1, 0, '2026-10-22 13:55:03', '2026-10-22 13:55:03'),
(154, 'HTML', NULL, 92, 'personal', 1, 1, '2026-10-22 13:55:03', '2026-10-22 13:55:03'),
(155, 'PHP', NULL, 80, 'personal', 1, 2, '2026-10-22 13:55:03', '2026-10-22 18:33:57'),
(156, 'Laravel', NULL, 70, 'personal', 1, 3, '2026-10-22 13:55:03', '2026-10-22 18:37:37'),
(157, 'Database', NULL, 70, 'personal', 1, 4, '2026-10-22 13:55:03', '2026-10-22 18:38:17'),
(158, 'Javascript', NULL, 88, 'personal', 1, 5, '2026-10-22 13:55:03', '2026-10-22 13:55:03'),
(159, 'WordPress', NULL, 80, 'personal', 0, 6, '2026-10-22 13:55:03', '2026-10-22 18:34:37'),
(160, 'Joomla', NULL, 75, 'personal', 0, 7, '2026-10-22 13:55:03', '2026-10-22 18:35:20'),
(161, 'Bootstrap', NULL, 90, 'personal', 1, 8, '2026-10-22 13:55:03', '2026-10-22 13:55:03'),
(162, 'Vue JS', NULL, 65, 'personal', 1, 9, '2026-10-22 13:55:03', '2026-10-22 18:38:32'),
(163, 'React JS', NULL, 68, 'personal', 1, 10, '2026-10-22 13:55:03', '2026-10-22 18:38:46'),
(164, 'Jquery', NULL, 73, 'personal', 1, 11, '2026-10-22 13:55:03', '2026-10-22 18:39:11'),
(165, 'HTML', NULL, 85, 'setec-institute-bachelor-degree', 0, 0, '2026-10-22 13:55:03', '2026-10-22 18:09:53'),
(166, 'CSS', NULL, 85, 'setec-institute-bachelor-degree', 0, 1, '2026-10-22 13:55:03', '2026-10-22 18:09:53'),
(167, 'PHP', NULL, 85, 'setec-institute-bachelor-degree', 0, 2, '2026-10-22 13:55:03', '2026-10-22 18:09:53'),
(168, 'JavaScript', NULL, 85, 'setec-institute-bachelor-degree', 0, 3, '2026-10-22 13:55:03', '2026-10-22 18:09:53'),
(169, 'WordPress', NULL, 85, 'setec-institute-bachelor-degree', 0, 4, '2026-10-22 13:55:03', '2026-10-22 18:09:53'),
(170, 'Joomla', NULL, 80, 'setec-institute-bachelor-degree', 0, 0, '2026-10-22 13:55:03', '2026-10-22 18:11:21'),
(171, 'Laravel', NULL, 80, 'setec-institute-bachelor-degree', 0, 1, '2026-10-22 13:55:03', '2026-10-22 18:11:26'),
(172, 'Database', NULL, 80, 'setec-institute-bachelor-degree', 0, 2, '2026-10-22 13:55:03', '2026-10-22 18:11:35'),
(173, 'Flutter', NULL, 80, 'setec-institute-bachelor-degree', 0, 3, '2026-10-22 13:55:03', '2026-10-22 18:11:40'),
(174, 'ASP.NET', NULL, 80, 'setec-institute-bachelor-degree', 0, 4, '2026-10-22 13:55:03', '2026-10-22 18:11:45'),
(175, 'Django', NULL, 80, 'setec-institute-bachelor-degree', 0, 5, '2026-10-22 13:55:03', '2026-10-22 18:11:51'),
(176, 'Spring Tool', NULL, 80, 'setec-institute-bachelor-degree', 0, 6, '2026-10-22 13:55:03', '2026-10-22 18:12:01'),
(177, 'Java', NULL, 80, 'setec-institute-bachelor-degree', 0, 7, '2026-10-22 13:55:03', '2026-10-22 18:12:23'),
(178, 'C#', NULL, 80, 'setec-institute-bachelor-degree', 0, 8, '2026-10-22 13:55:03', '2026-10-22 18:12:28'),
(179, 'Linux', NULL, 80, 'setec-institute-bachelor-degree', 0, 9, '2026-10-22 13:55:03', '2026-10-22 18:12:32'),
(180, 'C++', NULL, 80, 'setec-institute-bachelor-degree', 0, 10, '2026-10-22 13:55:03', '2026-10-22 18:11:56'),
(181, 'MYSQL', NULL, 80, 'setec-institute-bachelor-degree', 0, 11, '2026-10-22 13:55:03', '2026-10-22 18:12:14'),
(182, 'SQL Server', NULL, 80, 'setec-institute-bachelor-degree', 0, 12, '2026-10-22 13:55:03', '2026-10-22 18:12:18'),
(183, 'Navicat', NULL, 80, 'setec-institute-bachelor-degree', 0, 13, '2026-10-22 13:55:03', '2026-10-22 18:12:37'),
(184, 'GitHub', NULL, 80, 'setec-institute-bachelor-degree', 0, 14, '2026-10-22 13:55:03', '2026-10-22 18:12:10'),
(185, 'GitLab', NULL, 80, 'setec-institute-bachelor-degree', 0, 15, '2026-10-22 13:55:03', '2026-10-22 18:12:05'),
(186, 'Vue JS', NULL, 85, 'master-it-school-course', 0, 0, '2026-10-22 13:55:03', '2026-10-23 14:02:26'),
(187, 'Quasar', NULL, 85, 'master-it-school-course', 0, 1, '2026-10-22 13:55:03', '2026-10-23 14:02:26'),
(188, 'JavaScript', NULL, 85, 'master-it-school-course', 0, 2, '2026-10-22 13:55:03', '2026-10-23 14:02:26'),
(189, 'BootStrap', NULL, 85, 'master-it-school-course', 0, 3, '2026-10-22 13:55:03', '2026-10-23 14:02:26'),
(190, 'Dynamic Website', NULL, 85, 'master-it-school-course', 0, 4, '2026-10-22 13:55:03', '2026-10-23 14:02:26'),
(191, 'Docker', NULL, 80, 'setec-institute-bachelor-degree', 0, 16, '2026-10-22 18:13:25', '2026-10-22 18:13:25'),
(192, 'Homan Resource Management', NULL, 80, 'setec-institute-masters-degree', 0, 1, '2026-10-22 18:17:10', '2026-10-22 18:17:10'),
(193, 'Business Statestics', NULL, 80, 'setec-institute-masters-degree', 0, 2, '2026-10-22 18:17:19', '2026-10-22 18:17:19'),
(194, 'Research Methodology', NULL, 80, 'setec-institute-masters-degree', 0, 3, '2026-10-22 18:17:26', '2026-10-22 18:17:26'),
(195, 'Relational Database Management System', NULL, 80, 'setec-institute-masters-degree', 0, 4, '2026-10-22 18:17:35', '2026-10-22 18:17:35'),
(196, 'Advance Database Administration Workshop I', NULL, 80, 'setec-institute-masters-degree', 0, 5, '2026-10-22 18:17:44', '2026-10-22 18:17:44'),
(197, 'Advance Database Administration Workshop II', NULL, 80, 'setec-institute-masters-degree', 0, 6, '2026-10-22 18:17:49', '2026-10-22 18:17:49'),
(198, 'Software Project Management', NULL, 80, 'setec-institute-masters-degree', 0, 7, '2026-10-22 18:17:58', '2026-10-22 18:17:58'),
(199, 'Web Application Development', NULL, 80, 'setec-institute-masters-degree', 0, 8, '2026-10-22 18:18:06', '2026-10-22 18:18:06'),
(200, 'Java Programming With Oracle', NULL, 80, 'setec-institute-masters-degree', 0, 9, '2026-10-22 18:18:35', '2026-10-22 18:18:35'),
(201, 'Project on Dot Net Framework', NULL, 80, 'setec-institute-masters-degree', 0, 10, '2026-10-22 18:18:46', '2026-10-22 18:18:46'),
(202, 'Microsoft Network Administration', NULL, 80, 'setec-institute-masters-degree', 0, 11, '2026-10-22 18:19:01', '2026-10-22 18:19:01'),
(203, 'Advance Microsoft Network Administration', NULL, 80, 'setec-institute-masters-degree', 0, 12, '2026-10-22 18:19:06', '2026-10-22 18:19:06'),
(204, 'Network Security', NULL, 80, 'setec-institute-masters-degree', 0, 13, '2026-10-22 18:19:15', '2026-10-22 18:19:15'),
(205, 'Advance Network Security', NULL, 80, 'setec-institute-masters-degree', 0, 14, '2026-10-22 18:19:23', '2026-10-22 18:19:23'),
(206, 'Open Source Mobile Application', NULL, 80, 'setec-institute-masters-degree', 0, 15, '2026-10-22 18:19:36', '2026-10-22 18:19:36'),
(207, 'iOS Mobile Application', NULL, 80, 'setec-institute-masters-degree', 0, 16, '2026-10-22 18:19:43', '2026-10-22 18:19:43'),
(208, 'Linux Administration', NULL, 80, 'setec-institute-masters-degree', 0, 17, '2026-10-22 18:19:52', '2026-10-22 18:19:52'),
(209, 'Advance Linux Administration', NULL, 80, 'setec-institute-masters-degree', 0, 18, '2026-10-22 18:19:57', '2026-10-22 18:19:57');

-- --------------------------------------------------------

--
-- Table structure for table `skill_categories`
--

CREATE TABLE `skill_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_km` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL DEFAULT 'Skills',
  `section_km` varchar(255) DEFAULT NULL,
  `show_bars` tinyint(1) NOT NULL DEFAULT 0,
  `accent` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skill_categories`
--

INSERT INTO `skill_categories` (`id`, `name`, `name_km`, `slug`, `section`, `section_km`, `show_bars`, `accent`, `sort_order`, `created_at`, `updated_at`) VALUES
(14, 'Personal Skills', 'ជំនាញផ្ទាល់ខ្លួន', 'personal', 'Skills', 'ជំនាញ', 1, 0, 0, '2026-10-22 13:55:03', '2026-10-22 13:55:03'),
(15, 'SETEC Institute (Bachelor Degree)', 'វិទ្យាស្ថានស៊ីតិកថ្នាក់បរិញ្ញាបត្រ', 'setec-institute-bachelor-degree', 'Skills', 'ជំនាញ', 0, 0, 1, '2026-10-22 13:55:03', '2026-10-22 18:09:53'),
(17, 'Master IT School (Course)', 'សាលា Master IT', 'master-it-school-course', 'Skills', 'ជំនាញ', 0, 1, 3, '2026-10-22 13:55:03', '2026-10-23 14:02:26'),
(18, 'SETEC Institute (Master\'s Degree)', 'វិទ្យាស្ថានស៊ីតិកថ្នាក់បរិញ្ញាបត្រជាន់ខ្ពស់', 'setec-institute-masters-degree', 'Skills', NULL, 0, 0, 2, '2026-10-22 18:10:23', '2026-10-22 18:10:45');

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE `trainings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `description_km` text DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trainings`
--

INSERT INTO `trainings` (`id`, `description`, `description_km`, `sort_order`, `created_at`, `updated_at`) VALUES
(17, 'Completed English Course at SETEC Institute', 'បានបញ្ចប់វគ្គភាសាអង់គ្លេសនៅវិទ្យាស្ថាន SETEC', 0, '2026-10-22 13:55:03', '2026-10-22 13:55:03'),
(18, 'Completed Microsoft Office Training at Appbook Computer Center', 'បានបញ្ចប់ការបណ្តុះបណ្តាល Microsoft Office នៅ Appbook Computer Center', 1, '2026-10-22 13:55:03', '2026-10-22 14:22:10'),
(19, 'Passed Bacc II Exam && Deplume', 'បានជាប់ប្រឡងមធ្យមសិក្សាទុតិយភូមិ នឹង មធ្យមសិក្សាបឋមភូមិ', 2, '2026-10-22 13:55:03', '2026-10-22 14:24:42'),
(20, 'Completed English Course New Headway (Elementary–Intermediate) Level 1–5', 'បានបញ្ចប់វគ្គភាសាអង់គ្លេស New Headway (Elementary–Intermediate) កម្រិត ១–៥', 3, '2026-10-22 13:55:03', '2026-10-22 14:20:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Tieng Chamrern', 'admin@chamrern.cv', NULL, '$2y$12$yVREtz7clcSs7IroWieUMOI46COA9PSGQPwEDoWUbpOuYiCEiTA.C', NULL, '2026-10-21 16:16:35', '2026-10-21 16:16:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aws_courses`
--
ALTER TABLE `aws_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `course_certificates`
--
ALTER TABLE `course_certificates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_certificates_aws_course_id_foreign` (`aws_course_id`);

--
-- Indexes for table `cv_files`
--
ALTER TABLE `cv_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cv_references`
--
ALTER TABLE `cv_references`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education_documents`
--
ALTER TABLE `education_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `education_documents_education_id_foreign` (`education_id`);

--
-- Indexes for table `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `interests`
--
ALTER TABLE `interests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skill_categories`
--
ALTER TABLE `skill_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `skill_categories_slug_unique` (`slug`);

--
-- Indexes for table `trainings`
--
ALTER TABLE `trainings`
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
-- AUTO_INCREMENT for table `aws_courses`
--
ALTER TABLE `aws_courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `course_certificates`
--
ALTER TABLE `course_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cv_files`
--
ALTER TABLE `cv_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cv_references`
--
ALTER TABLE `cv_references`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `education_documents`
--
ALTER TABLE `education_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interests`
--
ALTER TABLE `interests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT for table `skill_categories`
--
ALTER TABLE `skill_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `trainings`
--
ALTER TABLE `trainings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course_certificates`
--
ALTER TABLE `course_certificates`
  ADD CONSTRAINT `course_certificates_aws_course_id_foreign` FOREIGN KEY (`aws_course_id`) REFERENCES `aws_courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `education_documents`
--
ALTER TABLE `education_documents`
  ADD CONSTRAINT `education_documents_education_id_foreign` FOREIGN KEY (`education_id`) REFERENCES `education` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
