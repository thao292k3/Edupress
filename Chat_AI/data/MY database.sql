-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for edupress
CREATE DATABASE IF NOT EXISTS `edupress` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `edupress`;

-- Dumping structure for table edupress.answers
CREATE TABLE IF NOT EXISTS `answers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question_id` bigint unsigned NOT NULL,
  `answer_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `answers_question_id_foreign` (`question_id`),
  CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.answers: ~21 rows (approximately)
INSERT INTO `answers` (`id`, `question_id`, `answer_text`, `is_correct`, `created_at`, `updated_at`) VALUES
	(1, 1, 'B.  <input type = "submit"', 1, '2025-12-10 06:33:43', '2025-12-15 02:56:36'),
	(2, 2, 'B. <input type ="button">', 1, '2025-12-10 06:35:03', '2025-12-15 02:56:46'),
	(3, 3, 'A. <input type= "file">', 1, '2025-12-10 06:36:58', '2025-12-15 02:56:54'),
	(4, 4, 'C. Tabindex', 1, '2025-12-10 06:38:13', '2025-12-15 02:57:10'),
	(5, 5, 'A. <input type= "text">', 0, '2025-12-12 07:46:33', '2025-12-22 01:36:11'),
	(6, 6, 'A. <input type= "file">', 0, '2025-12-12 08:16:36', '2025-12-22 01:38:08'),
	(7, 7, 'A. <input type= "file">', 1, '2025-12-12 08:17:39', '2025-12-22 01:39:24'),
	(8, 8, 'A. Focus', 0, '2025-12-12 08:18:52', '2025-12-22 01:40:16'),
	(9, 9, 'A. External style sheet, internal style sheet, browser default, inline style', 0, '2025-12-12 08:19:55', '2025-12-22 01:41:04'),
	(10, 5, '<input type = "submit">', 1, '2025-12-22 01:36:11', '2025-12-22 01:36:11'),
	(11, 5, '<input type="password">', 0, '2025-12-22 01:36:11', '2025-12-22 01:36:11'),
	(12, 5, 'D.  <input type ="reset">', 0, '2025-12-22 01:36:11', '2025-12-22 01:36:11'),
	(13, 6, 'B. <input type ="button">', 1, '2025-12-22 01:38:08', '2025-12-22 01:38:08'),
	(14, 6, 'C.  <input type= "hidden"', 0, '2025-12-22 01:38:08', '2025-12-22 01:38:08'),
	(15, 6, 'D. <input type ="image">', 0, '2025-12-22 01:38:08', '2025-12-22 01:38:08'),
	(16, 7, 'B. <input type = "button">', 0, '2025-12-22 01:39:24', '2025-12-22 01:39:24'),
	(17, 7, 'C. <input type= "hidden">', 0, '2025-12-22 01:39:24', '2025-12-22 01:39:24'),
	(18, 7, 'D. <input type = "image">', 0, '2025-12-22 01:39:24', '2025-12-22 01:39:24'),
	(19, 8, 'B. Accesskey', 0, '2025-12-22 01:40:16', '2025-12-22 01:40:16'),
	(20, 8, 'C. Tabindex', 1, '2025-12-22 01:40:16', '2025-12-22 01:40:16'),
	(21, 8, 'D. Id', 0, '2025-12-22 01:40:16', '2025-12-22 01:40:16'),
	(22, 9, 'B. Inline style, browser default, external style sheet, internal style sheet', 0, '2025-12-22 01:41:04', '2025-12-22 01:41:04'),
	(23, 9, 'C. Browser default, internal style sheet, inline style, external style sheet', 0, '2025-12-22 01:41:04', '2025-12-22 01:41:04'),
	(24, 9, 'D. Browser default, external style sheet, internal style sheet, inline style', 1, '2025-12-22 01:41:04', '2025-12-22 01:41:04'),
	(25, 10, 'A. Hyperlinks and Text Markup Language', 0, '2025-12-26 10:53:16', '2025-12-26 10:53:16'),
	(26, 10, 'B. Home Tool Markup Language', 0, '2025-12-26 10:53:16', '2025-12-26 10:53:16'),
	(27, 10, 'C. Hyper Text Markup Language', 1, '2025-12-26 10:53:16', '2025-12-26 10:53:16'),
	(28, 11, 'A. Tổ chức World Wide Web Consortium (W3C)', 1, '2025-12-26 10:54:16', '2025-12-26 10:54:16'),
	(29, 11, 'B. Apple', 0, '2025-12-26 10:54:16', '2025-12-26 10:54:16'),
	(30, 11, 'C. Google', 0, '2025-12-26 10:54:16', '2025-12-26 10:54:16'),
	(31, 11, 'D. Microsoft', 0, '2025-12-26 10:54:16', '2025-12-26 10:54:16'),
	(32, 12, 'A. <h6>', 0, '2025-12-26 10:55:30', '2025-12-26 10:55:30'),
	(33, 12, 'B. <h1>', 1, '2025-12-26 10:55:30', '2025-12-26 10:55:30'),
	(34, 12, 'C. <head>', 0, '2025-12-26 10:55:30', '2025-12-26 10:55:30'),
	(35, 12, 'D. <heading>', 0, '2025-12-26 10:55:30', '2025-12-26 10:55:30'),
	(36, 13, 'A. <enter>', 0, '2025-12-26 10:56:37', '2025-12-26 10:56:37'),
	(37, 13, 'B. <br>', 1, '2025-12-26 10:56:37', '2025-12-26 10:56:37'),
	(38, 13, 'C.<break>', 0, '2025-12-26 10:56:37', '2025-12-26 10:56:37'),
	(39, 13, 'D.<ib>', 0, '2025-12-26 10:56:37', '2025-12-26 10:56:37'),
	(40, 14, 'A. <body style="background-color:red;">', 1, '2025-12-26 10:58:32', '2025-12-26 10:58:32'),
	(41, 14, 'B. <body bg="red">', 0, '2025-12-26 10:58:32', '2025-12-26 10:58:32'),
	(42, 14, 'C. <background>red</background>', 0, '2025-12-26 10:58:32', '2025-12-26 10:58:32'),
	(43, 14, 'D. <body style="color:red;">', 0, '2025-12-26 10:58:32', '2025-12-26 10:58:32');

-- Dumping structure for table edupress.assessment_questions
CREATE TABLE IF NOT EXISTS `assessment_questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `instructor_id` bigint unsigned DEFAULT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` json DEFAULT NULL,
  `correct_option` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.assessment_questions: ~6 rows (approximately)
INSERT INTO `assessment_questions` (`id`, `instructor_id`, `question`, `options`, `correct_option`, `created_at`, `updated_at`) VALUES
	(1, 2, 'Bạn có kinh nghiệm như thế nào với JavaScript?', '[{"text": "A. Tôi chưa từng học qua JavaScript", "level": "Beginner", "weight": 1}, {"text": "B. Tôi biết các cú pháp cơ bản như biến và vòng lặp", "level": "Intermediate", "weight": 5}, {"text": "C. Tôi thành thạo xử lý bất đồng bộ và các Framework", "level": "Advanced", "weight": 10}]', NULL, '2025-12-18 07:02:49', '2025-12-18 07:02:49'),
	(2, 2, 'Câu hỏi 2: Bạn hiểu thế nào về các thẻ HTML Semantic (như <article>, <section>, <nav>)?', '[{"text": "A. Tôi chưa nghe tới khái niệm này", "level": "Beginner", "weight": 1}, {"text": "B. Tôi biết dùng nhưng thường chỉ dùng thẻ <div> cho nhanh", "level": "Intermediate", "weight": 5}, {"text": "C. Tôi luôn dùng chúng để tối ưu SEO và cấu trúc trang web chuẩn", "level": "Advanced", "weight": 10}]', NULL, '2025-12-18 07:06:58', '2025-12-18 07:06:58'),
	(3, 2, 'Câu hỏi 3: Khả năng xử lý giao diện đáp ứng (Responsive Design) của bạn như thế nào?', '[{"text": "A. Tôi chỉ biết tạo trang web với kích thước cố định", "level": "Beginner", "weight": 1}, {"text": "B. Tôi biết sử dụng Media Queries để thay đổi giao diện theo màn hình", "level": "Intermediate", "weight": 5}, {"text": "C. Tôi thành thạo Flexbox, Grid và các Framework như Tailwind/Bootstrap", "level": "Advanced", "weight": 10}]', NULL, '2025-12-18 07:07:47', '2025-12-18 07:07:47'),
	(4, 2, 'Câu hỏi 4: Bạn có tự tin khi viết logic bằng JavaScript thuần (Vanilla JS) không?', '[{"text": "A.Tôi chưa từng viết code JavaScript", "level": "Beginner", "weight": 1}, {"text": "B. Tôi biết dùng biến, vòng lặp và xử lý sự kiện click đơn giản", "level": "Intermediate", "weight": 5}, {"text": "C. Tôi hiểu rõ về ES6+, DOM Manipulation và Closure", "level": "Advanced", "weight": 10}]', NULL, '2025-12-18 07:08:41', '2025-12-18 07:08:41'),
	(5, 2, 'Câu hỏi: Bạn đã từng làm việc với dữ liệu từ bên ngoài (API) chưa?', '[{"text": "A.Tôi chưa biết API là gì", "level": "Beginner", "weight": 1}, {"text": "B. Tôi biết dùng Fetch hoặc Axios để lấy dữ liệu về hiển thị", "level": "Intermediate", "weight": 5}, {"text": "C. Tôi có thể tự xây dựng RESTful API và xử lý xác thực người dùng", "level": "Advanced", "weight": 10}]', NULL, '2025-12-18 07:09:28', '2025-12-18 07:09:28'),
	(6, 2, 'Câu hỏi 6: Bạn quản lý phiên bản code của mình như thế nào?', '[{"text": "A. Tôi thường copy thư mục để lưu trữ các phiên bản", "level": "Beginner", "weight": 1}, {"text": "B. Tôi biết dùng các lệnh Git cơ bản như Commit, Push, Pull", "level": "Intermediate", "weight": 5}, {"text": "C. Tôi thành thạo việc tạo nhánh (Branching) và giải quyết xung đột", "level": "Advanced", "weight": 10}]', NULL, '2025-12-18 07:10:48', '2025-12-18 07:10:48');

-- Dumping structure for table edupress.attendances
CREATE TABLE IF NOT EXISTS `attendances` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `live_session_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `role` enum('teacher','student') COLLATE utf8mb4_unicode_ci NOT NULL,
  `joined_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `attendances_live_session_id_user_id_unique` (`live_session_id`,`user_id`),
  KEY `attendances_user_id_foreign` (`user_id`),
  CONSTRAINT `attendances_live_session_id_foreign` FOREIGN KEY (`live_session_id`) REFERENCES `live_sessions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `attendances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.attendances: ~0 rows (approximately)
INSERT INTO `attendances` (`id`, `live_session_id`, `user_id`, `role`, `joined_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, 'teacher', '2025-12-12 19:16:24', '2025-12-12 19:16:24', '2025-12-12 19:16:24');

-- Dumping structure for table edupress.blogs
CREATE TABLE IF NOT EXISTS `blogs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blogs_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.blogs: ~1 rows (approximately)
INSERT INTO `blogs` (`id`, `title`, `slug`, `description`, `image`, `tags`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'testdceljeprvjevrmrvp', 'test', '<p>ưhcbeicbncoevnrvpvrmvvrvkmp45o4vm</p>', 'uploads/blogs/1765910655.webp', NULL, 1, '2025-12-16 11:42:45', '2025-12-16 11:44:15');

-- Dumping structure for table edupress.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.cache: ~1 rows (approximately)

-- Dumping structure for table edupress.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.cache_locks: ~0 rows (approximately)

-- Dumping structure for table edupress.carts
CREATE TABLE IF NOT EXISTS `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `guest_token` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`),
  KEY `carts_course_id_foreign` (`course_id`),
  CONSTRAINT `carts_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.carts: ~1 rows (approximately)

-- Dumping structure for table edupress.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.categories: ~8 rows (approximately)
INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `created_at`, `updated_at`) VALUES
	(2, 'Marketing', 'marketing', 'uploads/category/1765202723_6936db2321cc5.jfif', '2025-12-08 07:05:23', '2025-12-08 07:05:23'),
	(3, 'Design', 'design', 'uploads/category/1765202750_6936db3e0b7d6.jfif', '2025-12-08 07:05:50', '2025-12-08 07:05:50'),
	(4, 'Photography', 'photography', 'uploads/category/1765266719_6937d51f195da.jfif', '2025-12-08 07:07:06', '2025-12-09 00:51:59'),
	(5, 'Health', 'health', 'uploads/category/1765266052_6937d284a7c71.jfif', '2025-12-08 07:07:58', '2025-12-09 00:40:52'),
	(6, 'Business', 'business', 'uploads/category/1765203509_6936de35527fc.jfif', '2025-12-08 07:18:29', '2025-12-08 07:18:29'),
	(7, 'Finance & Accounting', 'finance--accounting', 'uploads/category/1765203590_6936de866d374.jfif', '2025-12-08 07:19:50', '2025-12-09 01:03:54'),
	(8, 'Logistics', 'logistics', 'uploads/category/1765203752_6936df286f6e9.jfif', '2025-12-08 07:22:32', '2025-12-08 07:22:32'),
	(9, 'Development', 'development', 'uploads/category/1765266810_6937d57a794c7.jfif', '2025-12-09 00:53:30', '2025-12-09 00:53:30');

-- Dumping structure for table edupress.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `blog_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `helpful_count` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_blog_id_foreign` (`blog_id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_parent_id_foreign` (`parent_id`),
  CONSTRAINT `comments_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.comments: ~0 rows (approximately)
INSERT INTO `comments` (`id`, `blog_id`, `user_id`, `parent_id`, `content`, `approved`, `helpful_count`, `created_at`, `updated_at`) VALUES
	(1, 1, 5, NULL, 'bài viết này hay quá', 0, 0, '2025-12-16 21:36:33', '2025-12-16 21:36:33');

-- Dumping structure for table edupress.coupons
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `instructor_id` int NOT NULL,
  `coupon_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_discount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_validity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `coupon_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.coupons: ~1 rows (approximately)
INSERT INTO `coupons` (`id`, `instructor_id`, `coupon_name`, `coupon_discount`, `coupon_validity`, `status`, `created_at`, `updated_at`, `coupon_type`) VALUES
	(1, 2, 'LMS', '5', '2025-12-31', 1, '2025-12-15 03:07:28', '2025-12-18 07:42:49', 'percent');

-- Dumping structure for table edupress.courses
CREATE TABLE IF NOT EXISTS `courses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `subcategory_id` bigint unsigned DEFAULT NULL,
  `instructor_id` bigint unsigned NOT NULL,
  `is_free` tinyint(1) NOT NULL DEFAULT '0',
  `course_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_name_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `course_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resources` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate_template` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selling_price` decimal(10,2) DEFAULT NULL,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `bestseller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `highestrated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `average_rating` float NOT NULL DEFAULT '0',
  `preview_count` int NOT NULL DEFAULT '1',
  `pass_score` int NOT NULL DEFAULT '60',
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0 = Inactive, 1 = Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `limit_duration_months` tinyint DEFAULT NULL,
  `course_benefits` longtext COLLATE utf8mb4_unicode_ci,
  `commission` int NOT NULL DEFAULT '35',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.courses: ~8 rows (approximately)
INSERT INTO `courses` (`id`, `category_id`, `subcategory_id`, `instructor_id`, `is_free`, `course_image`, `course_name`, `course_name_slug`, `course_title`, `description`, `course_level`, `course_duration`, `resources`, `certificate`, `certificate_template`, `selling_price`, `discount_price`, `bestseller`, `featured`, `highestrated`, `average_rating`, `preview_count`, `pass_score`, `status`, `created_at`, `updated_at`, `duration`, `limit_duration_months`, `course_benefits`, `commission`) VALUES
	(1, 9, 42, 2, 1, 'uploads/course/1765268225_6937db01483e0.jfif', 'Lập trình Web', 'l-p-tr-nh-web', 'Tự học lập trình web chỉ 5 phút mỗi ngày', '<div data-sfc-cp="" data-hveid="CAEQAA" data-processed="true" style=\'font-family: "Google Sans", Roboto, Arial, sans-serif; font-size: 16px; line-height: 24px; overflow-wrap: break-word; margin: 0px 0px 20px; color: rgb(10, 10, 10); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\' data-pasted="true">Kh&oacute;a học HTML &amp; CSS <mark data-processed="true" style="color: rgb(0, 29, 53); border-radius: 4px; background: linear-gradient(90deg, rgb(211, 227, 253) 50%, rgba(0, 0, 0, 0) 50%) 75% 0px / 200% 100% no-repeat scroll padding-box border-box rgba(0, 0, 0, 0); padding: 0px 2px; font-weight: 500; animation: 0.75s cubic-bezier(0.05, 0.7, 0.1, 1) 0.25s 1 normal forwards running highlight-animation;">l&agrave; kh&oacute;a học nền tảng về ph&aacute;t triển web, dạy c&aacute;ch sử dụng <strong data-processed="true" style="font-weight: bolder;">HTML</strong> để x&acirc;y dựng cấu tr&uacute;c nội dung (khung xương) v&agrave; <strong data-processed="true" style="font-weight: bolder;">CSS</strong> để thiết kế giao diện (trang điểm) cho website</mark>, gi&uacute;p trang web trở n&ecirc;n đẹp mắt, chuy&ecirc;n nghiệp, responsive tr&ecirc;n mọi thiết bị, đi từ cơ bản đến n&acirc;ng cao, bao gồm c&aacute;c thẻ HTML, thuộc t&iacute;nh, selector CSS, box model, typography, v&agrave; c&oacute; thể th&ecirc;m kiến thức về Bootstrap, Sass, Git.<span data-wiz-uids="hcFPob_e,hcFPob_f,hcFPob_g" data-processed="true"><span data-animation-atomic="" data-wiz-attrbind="class=hcFPob_e/TKHnVd;" data-processed="true" style="white-space: nowrap; position: relative;">&nbsp;</span></span></div><div data-animation-nesting="" data-sfc-cp="" data-processed="true" style=\'color: rgb(0, 29, 53); font-family: "Google Sans", Roboto, Arial, sans-serif; font-size: 20px; line-height: 28px; margin: 20px 0px 10px; font-weight: 600; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\'><a data-wiz-uids="hcFPob_o" data-ved="2ahUKEwjyovn74LmRAxWsr1YBHXIsLT8QgK4QegQIAhAA" data-hveid="CAIQAA" data-processed="true" href="https://www.google.com/search?q=M%E1%BB%A5c+ti%C3%AAu+kh%C3%B3a+h%E1%BB%8Dc&sca_esv=35aab6487a6cfb8f&sxsrf=AE3TifP9IPazjnKd7tb-Bq3ss9oGNLfd-A%3A1765600223734&ei=3-s8abC7LL-m2roP69meuAk&oq=m%C3%B4+kh%C3%B3a+h%E1%BB%8Dc+HTML+CSS&gs_lp=Egxnd3Mtd2l6LXNlcnAiGG3DtCBraMOzYSBo4buNYyBIVE1MIENTUyoCCAEyCBAhGKABGMMEMggQIRigARjDBEiaGlAAWKIDcAJ4AZABAZgBjAGgAZ0EqgEDMC40uAEByAEA-AEBmAIFoAKzA8ICChAhGKABGMMEGAqYAwCSBwMyLjOgB_8LsgcDMC4zuAetA8IHBzAuMi4yLjHIBxiACAA&sclient=gws-wiz-serp&mstk=AUtExfDdZ7lyov2AMUmzrrwYho080Xfr2n8sqLWDePRx7ZxwBrcnUjjvRbsWMemJhKKtS6P4O2cwGmGgfA-r57b4mXRjaTlZ-sbUEYEMFbzQwBaeDJOnxHo5lcvqbbf2XcCHk8hKFg8HGMmHJQBqV6wQ4YyaqF3mCcVFWrSQzGTK_g57O44&csui=3&ved=2ahUKEwjyovn74LmRAxWsr1YBHXIsLT8QgK4QegQIAhAA" style="color: unset; text-decoration: underline 8% dotted rgb(94, 94, 94); -webkit-tap-highlight-color: rgba(0, 0, 0, 0.1); text-underline-offset: 10%; white-space: normal; outline: 0px;">Mục ti&ecirc;u kh&oacute;a học</a></div><ul data-processed="true" style=\'margin: 10px 0px 20px; padding: 0px; font-family: "Google Sans", Roboto, Arial, sans-serif; font-size: 16px; line-height: 24px; padding-inline-start: 16px; color: rgb(10, 10, 10); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\'><li data-hveid="CAMQAA" data-processed="true" style="margin: 0px 0px 12px; padding: 0px; list-style: disc; padding-inline-start: 4px;"><span data-sfc-cp="" data-processed="true" style="overflow-wrap: break-word;">Nắm vững kiến thức về cấu tr&uacute;c trang web bằng HTML v&agrave; tạo kiểu bằng CSS.</span></li><li data-hveid="CAMQAQ" data-processed="true" style="margin: 0px 0px 12px; padding: 0px; list-style: disc; padding-inline-start: 4px;"><span data-sfc-cp="" data-processed="true" style="overflow-wrap: break-word;">X&acirc;y dựng c&aacute;c trang web tĩnh, đẹp, c&oacute; t&iacute;nh tương t&aacute;c cơ bản.</span></li><li data-hveid="CAMQAg" data-processed="true" style="margin: 0px 0px 12px; padding: 0px; list-style: disc; padding-inline-start: 4px;"><span data-sfc-cp="" data-processed="true" style="overflow-wrap: break-word;">L&agrave;m quen với c&aacute;c c&ocirc;ng cụ v&agrave; kỹ thuật thiết kế web hiện đại (responsive design, Sass, Bootstrap).</span></li><li data-hveid="CAMQAw" data-processed="true" style="margin: 0px 0px 12px; padding: 0px; list-style: disc; padding-inline-start: 4px;"><span data-sfc-cp="" data-processed="true" style="overflow-wrap: break-word;">Tạo nền tảng vững chắc để học c&aacute;c c&ocirc;ng nghệ Front-end phức tạp hơn (JavaScript, Frameworks).</span><span data-wiz-uids="hcFPob_11,hcFPob_12,hcFPob_13" data-processed="true"><span data-animation-atomic="" data-wiz-attrbind="class=hcFPob_11/TKHnVd;" data-processed="true" style="white-space: nowrap; position: relative;"> </span></span></li></ul><div data-sfc-cp="" data-processed="true" style=\'color: rgb(10, 10, 10); font-family: "Google Sans", Roboto, Arial, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\'><br></div><div data-animation-nesting="" data-sfc-cp="" data-processed="true" style=\'color: rgb(0, 29, 53); font-family: "Google Sans", Roboto, Arial, sans-serif; font-size: 20px; line-height: 28px; margin: 20px 0px 10px; font-weight: 600; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\'>Nội dung ch&iacute;nh</div><ul data-processed="true" style=\'margin: 10px 0px 20px; padding: 0px; font-family: "Google Sans", Roboto, Arial, sans-serif; font-size: 16px; line-height: 24px; padding-inline-start: 16px; color: rgb(10, 10, 10); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\'><li data-hveid="CAUQAA" data-processed="true" style="margin: 0px 0px 12px; padding: 0px; list-style: disc; padding-inline-start: 4px;"><span data-sfc-cp="" data-processed="true" style="overflow-wrap: break-word;"><strong data-processed="true" style="font-weight: bolder;">HTML:</strong> Cấu tr&uacute;c thẻ, thuộc t&iacute;nh, form, bảng, li&ecirc;n kết, thẻ meta, Emmet.</span></li><li data-hveid="CAUQAQ" data-processed="true" style="margin: 0px 0px 12px; padding: 0px; list-style: disc; padding-inline-start: 4px;"><span data-sfc-cp="" data-processed="true" style="overflow-wrap: break-word;"><strong data-processed="true" style="font-weight: bolder;">CSS:</strong> Selector, box model, đơn vị đo, typography, m&agrave;u sắc, h&igrave;nh ảnh nền, position, kế thừa, biến CSS, BEM.</span></li><li data-hveid="CAUQAg" data-processed="true" style="margin: 0px 0px 12px; padding: 0px; list-style: disc; padding-inline-start: 4px;"><span data-sfc-cp="" data-processed="true" style="overflow-wrap: break-word;"><strong data-processed="true" style="font-weight: bolder;">Responsive Web Design (RWD):</strong> Thiết kế cho nhiều k&iacute;ch thước m&agrave;n h&igrave;nh.</span></li><li data-hveid="CAUQAw" data-processed="true" style="margin: 0px 0px 12px; padding: 0px; list-style: disc; padding-inline-start: 4px;"><span data-sfc-cp="" data-processed="true" style="overflow-wrap: break-word;"><strong data-processed="true" style="font-weight: bolder;">C&ocirc;ng cụ n&acirc;ng cao (t&ugrave;y kh&oacute;a):</strong> Bootstrap (framework CSS), Sass (CSS preprocessor), Gulp (task runner).</span></li><li data-hveid="CAUQBA" data-processed="true" style="margin: 0px 0px 12px; padding: 0px; list-style: disc; padding-inline-start: 4px;"><span data-sfc-cp="" data-processed="true" style="overflow-wrap: break-word;"><strong data-processed="true" style="font-weight: bolder;">Thực h&agrave;nh:</strong> Cắt giao diện từ thiết kế (PSD) sang HTML/CSS, l&agrave;m dự &aacute;n c&aacute; nh&acirc;n.</span><span data-wiz-uids="hcFPob_1u,hcFPob_1v,hcFPob_1w" data-processed="true"><span data-animation-atomic="" data-wiz-attrbind="class=hcFPob_1u/TKHnVd;" data-processed="true" style="white-space: nowrap; position: relative;"> </span></span></li></ul><div data-animation-nesting="" data-sfc-cp="" data-processed="true" style=\'color: rgb(0, 29, 53); font-family: "Google Sans", Roboto, Arial, sans-serif; font-size: 20px; line-height: 28px; margin: 20px 0px 10px; font-weight: 600; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\'>D&agrave;nh cho đối tượng n&agrave;o?</div><ul data-processed="true" style=\'margin: 10px 0px 20px; padding: 0px; font-family: "Google Sans", Roboto, Arial, sans-serif; font-size: 16px; line-height: 24px; padding-inline-start: 16px; color: rgb(10, 10, 10); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\'><li data-hveid="CAcQAA" data-processed="true" style="margin: 0px 0px 12px; padding: 0px; list-style: disc; padding-inline-start: 4px;"><span data-sfc-cp="" data-processed="true" style="overflow-wrap: break-word;">Người mới bắt đầu muốn l&agrave;m quen với ph&aacute;t triển web.</span></li><li data-hveid="CAcQAQ" data-processed="true" style="margin: 0px 0px 12px; padding: 0px; list-style: disc; padding-inline-start: 4px;"><span data-sfc-cp="" data-processed="true" style="overflow-wrap: break-word;">Ai muốn x&acirc;y dựng website/landing page cơ bản.</span></li><li data-hveid="CAcQAg" data-processed="true" style="margin: 0px 0px 12px; padding: 0px; list-style: disc; padding-inline-start: 4px;"><span data-sfc-cp="" data-processed="true" style="overflow-wrap: break-word;">Người muốn n&acirc;ng cao kỹ năng thiết kế giao diện Front-end.</span><span data-wiz-uids="hcFPob_2e,hcFPob_2f,hcFPob_2g" data-processed="true"><span data-animation-atomic="" data-wiz-attrbind="class=hcFPob_2e/TKHnVd;" data-processed="true" style="white-space: nowrap; position: relative;"> </span></span></li></ul>', 'Beginner', NULL, '200', 'no', 'uploads/certificates/1765268225_6937db014893c.jpg', NULL, NULL, 'no', 'no', 'no', 0, 1, 100, 1, '2025-12-09 01:17:05', '2025-12-13 07:14:29', NULL, NULL, '<p>Kh&oacute;a học HTML &amp; CSS mang lại lợi &iacute;ch lớn:&nbsp;</p><p><mark data-processed="true" style=\'color: rgb(0, 29, 53); border-radius: 4px; background: linear-gradient(90deg, rgb(211, 227, 253) 50%, rgba(0, 0, 0, 0) 50%) 75% 0px / 200% 100% no-repeat scroll padding-box border-box rgba(0, 0, 0, 0); padding: 0px 2px; font-weight: 500; animation: 0.75s cubic-bezier(0.05, 0.7, 0.1, 1) 0.25s 1 normal forwards running highlight-animation; font-family: "Google Sans", Roboto, Arial, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\' data-pasted="true">x&acirc;y dựng nền tảng ph&aacute;t triển web, tạo cấu tr&uacute;c v&agrave; giao diện đẹp mắt cho website.</mark></p><p><mark data-processed="true" style=\'color: rgb(0, 29, 53); border-radius: 4px; background: linear-gradient(90deg, rgb(211, 227, 253) 50%, rgba(0, 0, 0, 0) 50%) 75% 0px / 200% 100% no-repeat scroll padding-box border-box rgba(0, 0, 0, 0); padding: 0px 2px; font-weight: 500; animation: 0.75s cubic-bezier(0.05, 0.7, 0.1, 1) 0.25s 1 normal forwards running highlight-animation; font-family: "Google Sans", Roboto, Arial, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\'>&nbsp;Tiết kiệm chi ph&iacute; tự l&agrave;m web c&aacute; nh&acirc;n/dự &aacute;n, v&agrave; mở ra cơ hội nghề nghiệp (<a data-wiz-uids="IfKLzb_c" data-ved="2ahUKEwj-t66x3bmRAxXvsFYBHQpoE0AQgK4QegQIARAC" data-hveid="CAEQAg" data-processed="true" href="https://www.google.com/search?q=Front-End+Developer&mstk=AUtExfB_AIS4VQiEbytbwwj3Hu8mhrJGAjONr4ZTv2Vfa1hPYjMy8i6mKzkZIYXCQO8Wk3O64kLXCB5S9t7qXdT5pYxa62f9SlP_IzyHARwAYax2GwdXEBQqyX3xPrja2HO0oZ2ijFTkPBEc42c_9BQaYGd4osq7_2ggv33Gu9XoDe3vQf0&csui=3&ved=2ahUKEwj-t66x3bmRAxXvsFYBHQpoE0AQgK4QegQIARAC" style="color: unset; text-decoration: underline 8% dotted rgb(94, 94, 94); -webkit-tap-highlight-color: rgba(0, 0, 0, 0.1); text-underline-offset: 10%; white-space: normal; outline: 0px;">Front-End Developer</a>, <a data-wiz-uids="IfKLzb_d" data-ved="2ahUKEwj-t66x3bmRAxXvsFYBHQpoE0AQgK4QegQIARAD" data-hveid="CAEQAw" data-processed="true" href="https://www.google.com/search?q=Web+Designer&mstk=AUtExfB_AIS4VQiEbytbwwj3Hu8mhrJGAjONr4ZTv2Vfa1hPYjMy8i6mKzkZIYXCQO8Wk3O64kLXCB5S9t7qXdT5pYxa62f9SlP_IzyHARwAYax2GwdXEBQqyX3xPrja2HO0oZ2ijFTkPBEc42c_9BQaYGd4osq7_2ggv33Gu9XoDe3vQf0&csui=3&ved=2ahUKEwj-t66x3bmRAxXvsFYBHQpoE0AQgK4QegQIARAD" style="color: unset; text-decoration: underline 8% dotted rgb(94, 94, 94); -webkit-tap-highlight-color: rgba(0, 0, 0, 0.1); text-underline-offset: 10%; white-space: normal; outline: 0px;">Web Designer</a>),</mark></p><p><mark data-processed="true" style=\'color: rgb(0, 29, 53); border-radius: 4px; background: linear-gradient(90deg, rgb(211, 227, 253) 50%, rgba(0, 0, 0, 0) 50%) 75% 0px / 200% 100% no-repeat scroll padding-box border-box rgba(0, 0, 0, 0); padding: 0px 2px; font-weight: 500; animation: 0.75s cubic-bezier(0.05, 0.7, 0.1, 1) 0.25s 1 normal forwards running highlight-animation; font-family: "Google Sans", Roboto, Arial, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\'>Đồng thời gi&uacute;p học c&aacute;c ng&ocirc;n ngữ lập tr&igrave;nh phức tạp hơn (như <a data-wiz-uids="IfKLzb_e" data-ved="2ahUKEwj-t66x3bmRAxXvsFYBHQpoE0AQgK4QegQIARAE" data-hveid="CAEQBA" data-processed="true" href="https://www.google.com/search?q=JavaScript&mstk=AUtExfB_AIS4VQiEbytbwwj3Hu8mhrJGAjONr4ZTv2Vfa1hPYjMy8i6mKzkZIYXCQO8Wk3O64kLXCB5S9t7qXdT5pYxa62f9SlP_IzyHARwAYax2GwdXEBQqyX3xPrja2HO0oZ2ijFTkPBEc42c_9BQaYGd4osq7_2ggv33Gu9XoDe3vQf0&csui=3&ved=2ahUKEwj-t66x3bmRAxXvsFYBHQpoE0AQgK4QegQIARAE" style="color: unset; text-decoration: underline 8% dotted rgb(94, 94, 94); -webkit-tap-highlight-color: rgba(0, 0, 0, 0.1); text-underline-offset: 10%; white-space: normal; outline: 0px;">JavaScript</a>) dễ d&agrave;ng hơn.</mark></p><p><mark data-processed="true" style=\'color: rgb(0, 29, 53); border-radius: 4px; background: linear-gradient(90deg, rgb(211, 227, 253) 50%, rgba(0, 0, 0, 0) 50%) 75% 0px / 200% 100% no-repeat scroll padding-box border-box rgba(0, 0, 0, 0); padding: 0px 2px; font-weight: 500; animation: 0.75s cubic-bezier(0.05, 0.7, 0.1, 1) 0.25s 1 normal forwards running highlight-animation; font-family: "Google Sans", Roboto, Arial, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\'>Ph&aacute;t triển kỹ năng tư duy logic v&agrave; giải quyết vấn đề, v&agrave; n&acirc;ng cao hiệu quả SEO cho trang web</mark></p>', 35),
	(2, 3, 19, 2, 0, 'uploads/course/1765288488_69382a28b1d32.jpeg', 'Làm phim hoạt hình 3D ', 'l-m-phim-ho-t-h-nh-3d-v-i-iclone', 'Bài 1 Mở đầu', '<p>L&agrave;m phim hoạt h&igrave;nh 3D với Iclone&nbsp;</p>', 'Beginner', NULL, '10', 'yes', 'uploads/certificates/1765288488_69382a28b277d.jpg', 1200000.00, 1100000.00, 'yes', NULL, NULL, 0, 1, 60, 1, '2025-12-09 06:54:48', '2025-12-10 08:51:50', NULL, 3, NULL, 35),
	(3, 9, 44, 2, 0, 'uploads/course/1765354166_69392ab654d58.jfif', 'Lập trình Android từ A - Z', 'l-p-tr-nh-android-t-a-z', 'Lập trình Android - Bài 1.0: Hướng dẫn cài đặt và sử dụng Android Studio', '<p><span style="color: rgb(33, 56, 8); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; background-color: rgba(0, 0, 0, 0.05); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;" data-pasted="true">Hướng dẫn c&agrave;i đặt Android Studio phi&ecirc;n bản mới nhất, Đơn giản, ngắn gọn, dễ thực hiện.</span></p>', 'Beginner', NULL, '36', 'yes', 'uploads/certificates/1765354166_69392ab655289.jpg', 900000.00, NULL, 'no', 'yes', 'no', 0, 1, 60, 1, '2025-12-10 00:14:50', '2025-12-10 08:52:08', NULL, 3, NULL, 35),
	(5, 2, 21, 2, 0, 'uploads/course/1765461922_693acfa291522.webp', 'Social Media Marketing', 'social-media-marketing', 'Social Media Marketing Tutorial For Beginners', '<p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(4, 40, 60);" data-pasted="true">This social media marketing tutorial will help you learn what social media marketing is, How to start social media marketing, what are the channels used for SMM and how can you use them, what are the tools for social media marketing and few important tips to become a good social media marketer. Social media was introduced as an easier way to connect with our closed ones. But, now it has turned out to be an affordable and important marketing strategy for businesses of all types.&nbsp;</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(4, 40, 60);">&nbsp;Also, below are the topics covered in the video:&nbsp;</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(4, 40, 60);">1. What is social media marketing? (</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=KEirK5QWgrA&list=PLEiEAq2VkUUK4-Inc4LAUDeiCSLWFX2u-&index=1&t=137s" target="" style="text-decoration: none; display: inline; color: inherit;">02:17</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(4, 40, 60);">)&nbsp;</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(4, 40, 60);">2. Why do social media marketing? (</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=KEirK5QWgrA&list=PLEiEAq2VkUUK4-Inc4LAUDeiCSLWFX2u-&index=1&t=208s" target="" style="text-decoration: none; display: inline; color: inherit;">03:28</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(4, 40, 60);">)&nbsp;</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(4, 40, 60);">3. What are the channels used for SMM and how can you use them? (</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=KEirK5QWgrA&list=PLEiEAq2VkUUK4-Inc4LAUDeiCSLWFX2u-&index=1&t=373s" target="" style="text-decoration: none; display: inline; color: inherit;">06:13</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(4, 40, 60);">)&nbsp;</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(4, 40, 60);">4. What are the tools for social media marketing? (</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=KEirK5QWgrA&list=PLEiEAq2VkUUK4-Inc4LAUDeiCSLWFX2u-&index=1&t=2630s" target="" style="text-decoration: none; display: inline; color: inherit;">43:50</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(4, 40, 60);">)&nbsp;</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(4, 40, 60);">5. Tips to be a good social media marketer (</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=KEirK5QWgrA&list=PLEiEAq2VkUUK4-Inc4LAUDeiCSLWFX2u-&index=1&t=2828s" target="" style="text-decoration: none; display: inline; color: inherit;">47:08</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(4, 40, 60);">)&nbsp;</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(4, 40, 60);">Subscribe to our channel for more Digital marketing Tutorials:&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/user/Simplilearn?sub_confirmation=1" rel="nofollow" target="" style="text-decoration: none; display: inline; color: inherit;">https://www.youtube.com/user/Simplile...</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(4, 40, 60);">&nbsp;📚&nbsp;</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(4, 40, 60);">For a more detailed understanding on Social Media Marketing, do visit:&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/redirect?event=video_description&redir_token=QUFFLUhqbHFBbmhZUUZpRTVCbkpZZng0eVVqV0k4OFNjZ3xBQ3Jtc0tuVU5FNGwxMXNnQm83cVlaajZSNml5Zm9wdDFkWmlSeGRGNFZ2Y3JjVEZReGc1a01mcy1wMzBpX2R4VDh0aDl2RHV3ZUhMekhOQXJMWkZqTEZTa1pVazVycXhzMjRkU0JCaUtMUG1vS1ozemRSUlFGQQ&q=https%3A%2F%2Fwww.simplilearn.com%2Fhow-to-start-winning-with-social-media-marketing-article%3F%26utm_medium%3DDescription%26utm_source%3Dyoutube&v=KEirK5QWgrA" rel="nofollow" target="_blank" style="text-decoration: none; display: inline; color: inherit;">https://www.simplilearn.com/how-to-st...</a></span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(4, 40, 60);">You will find in-depth content on Social Media Marketing.&nbsp;</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(4, 40, 60);">Browse further to discover similar resources on related topics, made available to you as a learning path.&nbsp;</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(4, 40, 60);">Enjoy top-quality learning for FREE.</span></p>', 'Beginner', NULL, '35', 'yes', 'uploads/certificates/1765461922_693acfa291a24.jpg', 1500000.00, 1000000.00, 'no', 'no', 'no', 0, 1, 100, 0, '2025-12-11 07:05:22', '2025-12-12 21:34:43', NULL, 2, NULL, 35),
	(6, 2, 23, 2, 1, 'uploads/course/1765623464_693d46a8e15a7.jfif', 'Marketting', 'marketting', 'testtss', '<p>tesssst</p>', NULL, NULL, '10', NULL, NULL, NULL, NULL, 'no', 'no', 'no', 0, 1, 60, 0, '2025-12-13 03:57:44', '2025-12-13 03:57:44', NULL, NULL, NULL, 35),
	(7, 5, 27, 2, 0, 'uploads/course/1765624935_693d4c6785e64.png', 'Giảm cân đón tết', 'gi-m-c-n-n-t-t', 'Mỗi ngày 5 phát để có body vạn người mê', '<p>jgkrkgmvpfrmv</p>', 'Beginner', NULL, '15', 'yes', 'uploads/certificates/1765624935_693d4c678641a.jpg', 700000.00, NULL, NULL, 'yes', NULL, 0, 1, 60, 1, '2025-12-13 04:22:15', '2025-12-13 04:24:12', NULL, 1, '<p>evjkenvojevnrivn ldfnmlvmkl&ecirc;deee</p>', 35),
	(10, 4, 34, 2, 1, 'uploads/course/1765635959_693d7777d6eb1.jfif', 'test', 'test', 'edhnoivcnrohnv', '<p>cecm,lp;,cmpelrjvir</p>', NULL, NULL, '15', 'no', NULL, NULL, NULL, 'no', 'no', 'no', 0, 1, 60, 0, '2025-12-13 07:25:59', '2025-12-16 06:11:26', NULL, NULL, NULL, 35),
	(11, 3, 35, 7, 0, 'uploads/course/1766510083_694ace03432aa.jfif', 'KHÓA HỌC EDIT VIDEO CAPCUT', 'kh-a-h-c-edit-video-capcut', 'Giới thiệu khóa', '<p>Kh&oacute;a học thiết kế video (Video Design)&nbsp;<mark data-processed="true" style=\'color: rgb(0, 29, 53); border-radius: 4px; background: linear-gradient(90deg, rgb(211, 227, 253) 50%, rgba(0, 0, 0, 0) 50%) 75% 0px / 200% 100% no-repeat scroll padding-box border-box rgba(0, 0, 0, 0); padding: 0px 2px; font-weight: 500; animation: 0.75s cubic-bezier(0.05, 0.7, 0.1, 1) 0.25s 1 normal forwards running highlight-animation; font-family: "Google Sans", Arial, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\' data-pasted="true">cung cấp kiến thức v&agrave; kỹ năng to&agrave;n diện từ tư duy h&igrave;nh ảnh, quay dựng đến kỹ thuật hậu kỳ chuy&ecirc;n nghiệp, gi&uacute;p học vi&ecirc;n th&agrave;nh thạo c&aacute;c phần mềm như Adobe Premiere Pro, After Effects để tạo ra video quảng c&aacute;o, motion graphics, kỹ xảo ấn tượng, ph&ugrave; hợp cho nhiều lĩnh vực như marketing, sự kiện, truyền th&ocirc;ng, biến những &yacute; tưởng s&aacute;ng tạo th&agrave;nh sản phẩm đa phương tiện sống động.</mark></p>', NULL, NULL, '20', 'yes', 'uploads/certificates/1766510083_694ace0343da3.jpg', 500000.00, NULL, NULL, NULL, NULL, 0, 1, 60, 1, '2025-12-23 10:14:43', '2025-12-23 10:14:43', NULL, 2, NULL, 35);

-- Dumping structure for table edupress.course_enrollments
CREATE TABLE IF NOT EXISTS `course_enrollments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'paid',
  `issued_certificate` tinyint(1) NOT NULL DEFAULT '0',
  `certificate_date` timestamp NULL DEFAULT NULL,
  `enrolled_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `limit_access_until` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `course_enrollments_course_id_user_id_unique` (`course_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.course_enrollments: ~2 rows (approximately)
INSERT INTO `course_enrollments` (`id`, `course_id`, `user_id`, `price`, `payment_status`, `issued_certificate`, `certificate_date`, `enrolled_at`, `limit_access_until`, `created_at`, `updated_at`) VALUES
	(1, 3, 5, 900000.00, 'paid', 0, NULL, '2025-12-23 08:05:29', NULL, '2025-12-23 08:05:29', '2025-12-23 08:05:29'),
	(2, 1, 5, 0.00, 'paid', 1, '2025-12-26 11:03:55', '2025-12-23 09:56:41', NULL, '2025-12-23 09:56:41', '2025-12-26 11:03:55');

-- Dumping structure for table edupress.course_goals
CREATE TABLE IF NOT EXISTS `course_goals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `goal_name` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_goals_course_id_foreign` (`course_id`),
  CONSTRAINT `course_goals_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.course_goals: ~10 rows (approximately)
INSERT INTO `course_goals` (`id`, `course_id`, `goal_name`, `created_at`, `updated_at`) VALUES
	(4, 10, 'ewcokepcwk', '2025-12-13 07:25:59', '2025-12-13 07:25:59'),
	(5, 10, 'êcnjrnocren', '2025-12-13 07:25:59', '2025-12-13 07:25:59'),
	(7, 1, 'Nắm vững HTML: Hiểu cấu trúc, các thẻ HTML, thuộc tính, cách tạo tiêu đề, đoạn văn, liên kết, bảng, hình ảnh.', '2025-12-13 07:39:56', '2025-12-13 07:39:56'),
	(8, 1, 'Thành thạo CSS: Làm đẹp trang web, tùy chỉnh màu sắc, font chữ, bố cục, khoảng cách, sử dụng selectors, Box Model, Flexbox, Grid và kỹ thuật Responsive (hiển thị tốt trên mọi thiết bị).', '2025-12-13 07:39:56', '2025-12-13 07:39:56'),
	(9, 1, 'Xây dựng sản phẩm thực tế: Tự tay code các thành phần web (menu, button) và dựng các giao diện website hoàn chỉnh (ví dụ: Facebook, CV cá nhân).', '2025-12-13 07:39:56', '2025-12-13 07:39:56'),
	(10, 1, 'Phát triển kỹ năng: Hiểu cách hoạt động của web, đặt tên class theo chuẩn (BEM), sử dụng công cụ như Emmet, và có nền tảng vững chắc để học các công nghệ phức tạp hơn (JavaScript, Frameworks).', '2025-12-13 07:39:56', '2025-12-13 07:39:56'),
	(11, 1, 'Chuẩn bị cho nghề nghiệp: Vững kiến thức Front-end, tự tin chuyển ngành hoặc nâng cao kỹ năng cho Lập trình viên Back-end.', '2025-12-13 07:39:56', '2025-12-13 07:39:56'),
	(12, 11, 'Thành thạo các công cụ dựng video', '2025-12-23 10:14:43', '2025-12-23 10:14:43'),
	(13, 11, 'Kỹ năng kể chuyện bằng hình ảnh', '2025-12-23 10:14:43', '2025-12-23 10:14:43'),
	(14, 11, 'Kiến thức về âm thanh và ánh sáng', '2025-12-23 10:14:43', '2025-12-23 10:14:43');

-- Dumping structure for table edupress.course_videos
CREATE TABLE IF NOT EXISTS `course_videos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `video_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_videos_course_id_foreign` (`course_id`),
  CONSTRAINT `course_videos_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.course_videos: ~0 rows (approximately)
INSERT INTO `course_videos` (`id`, `course_id`, `video_url`, `video_file`, `position`, `created_at`, `updated_at`, `video_type`) VALUES
	(1, 1, 'https://fullstack.edu.vn/learning/html-css?id=278ad346-397b-4818-81f9-be421edbbdd4', NULL, 0, '2025-12-09 07:02:25', '2025-12-09 07:02:25', 'youtube');

-- Dumping structure for table edupress.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table edupress.googles
CREATE TABLE IF NOT EXISTS `googles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.googles: ~0 rows (approximately)
INSERT INTO `googles` (`id`, `client_id`, `secret_key`, `created_at`, `updated_at`) VALUES
	(1, 'eduidedjoeip', 'edujiodrjoeriop', '2025-12-16 07:29:00', '2025-12-16 07:29:00');

-- Dumping structure for table edupress.info_boxes
CREATE TABLE IF NOT EXISTS `info_boxes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.info_boxes: ~0 rows (approximately)

-- Dumping structure for table edupress.instructor_earnings
CREATE TABLE IF NOT EXISTS `instructor_earnings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `instructor_id` bigint unsigned NOT NULL,
  `order_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `admin_commission` decimal(10,2) NOT NULL,
  `instructor_amount` decimal(10,2) NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `instructor_earnings_instructor_id_foreign` (`instructor_id`),
  KEY `instructor_earnings_order_id_foreign` (`order_id`),
  KEY `instructor_earnings_course_id_foreign` (`course_id`),
  CONSTRAINT `instructor_earnings_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `instructor_earnings_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`),
  CONSTRAINT `instructor_earnings_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.instructor_earnings: ~2 rows (approximately)
INSERT INTO `instructor_earnings` (`id`, `instructor_id`, `order_id`, `course_id`, `total_price`, `admin_commission`, `instructor_amount`, `payment_status`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, 2, 1100000.00, 220000.00, 880000.00, 'paid', '2025-12-15 11:39:45', '2025-12-25 22:16:28'),
	(2, 2, 3, 3, 900000.00, 180000.00, 720000.00, 'paid', '2025-12-23 08:05:29', '2025-12-24 01:53:33');

-- Dumping structure for table edupress.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.jobs: ~0 rows (approximately)

-- Dumping structure for table edupress.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.job_batches: ~0 rows (approximately)

-- Dumping structure for table edupress.lessons
CREATE TABLE IF NOT EXISTS `lessons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int DEFAULT NULL,
  `section_id` bigint unsigned NOT NULL,
  `lesson_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `quiz_id` bigint unsigned DEFAULT NULL,
  `lecture_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `duration` decimal(8,2) DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `is_preview` tinyint(1) NOT NULL DEFAULT '0',
  `video_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lesson_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lesson_document_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lessons_section_id_foreign` (`section_id`),
  KEY `lessons_quiz_id_foreign` (`quiz_id`),
  CONSTRAINT `lessons_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lessons_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.lessons: ~9 rows (approximately)
INSERT INTO `lessons` (`id`, `course_id`, `section_id`, `lesson_type`, `quiz_id`, `lecture_title`, `url`, `content`, `duration`, `order`, `is_preview`, `video_file`, `lesson_file`, `lesson_document_link`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '0', NULL, 'Học được gì trong khóa học', 'https://youtu.be/q-3VyQQ_wFM?si=4R3CPDFt1aXOCXBu', '<p>our04rfu0fjr04</p>', 4.00, 0, 1, NULL, NULL, NULL, NULL, '2025-12-12 05:11:36', '2025-12-12 05:11:36'),
	(2, 1, 1, '0', NULL, 'Tìm hiểu về HTML CSS', 'https://fullstack.edu.vn/learning/html-css?id=c9e52060-39cb-4bdb-8ad7-58f52896d5e2', '<p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);" data-pasted="true">Trong video đầu ti&ecirc;n n&agrave;y ch&uacute;ng ta c&ugrave;ng nhau t&igrave;m hiểu HTML, CSS l&agrave; g&igrave;?&nbsp;</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">HTML l&agrave; chữ viết tắt của Hypertext Markup Language.&nbsp;</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">N&oacute; gi&uacute;p người d&ugrave;ng tạo v&agrave; cấu tr&uacute;c c&aacute;c th&agrave;nh phần trong trang web hoặc ứng dụng, ph&acirc;n chia c&aacute;c đoạn văn, deading, links, blockquotes, vv...&nbsp;</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">CSS l&agrave; ng&ocirc;n ngữ tạo phong c&aacute;ch cho trang web - Cascading Style Sheet language.&nbsp;</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">N&oacute; d&ugrave;ng để tạo phong c&aacute;ch v&agrave; định kiểu cho những yếu tố được viết dưới dạng ng&ocirc;n ngữ đ&aacute;nh dấu, như l&agrave;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">HTML.&nbsp;</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/hoclaptrinh" target="" style="text-decoration: none; display: inline; color: inherit;">#hoclaptrinh</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/mienphi" target="" style="text-decoration: none; display: inline; color: inherit;">#mienphi</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/frontend" target="" style="text-decoration: none; display: inline; color: inherit;">#frontend</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/backend" target="" style="text-decoration: none; display: inline; color: inherit;">#backend</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/devops" target="" style="text-decoration: none; display: inline; color: inherit;">#devops</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">Ph&acirc;n đoạn trong video:</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=zwsPND378OQ" target="" style="text-decoration: none; display: inline; color: inherit;">00:00</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;- Giới thiệu</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=zwsPND378OQ&t=16s" target="" style="text-decoration: none; display: inline; color: inherit;">00:16</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;- HTML l&agrave; g&igrave;</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=zwsPND378OQ&t=71s" target="" style="text-decoration: none; display: inline; color: inherit;">01:11</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;- CSS l&agrave; g&igrave;</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=zwsPND378OQ&t=93s" target="" style="text-decoration: none; display: inline; color: inherit;">01:33</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;- V&iacute; dụ trực quan về HTML &amp; CSS</span></p>', 2.00, 1, 0, NULL, NULL, NULL, NULL, '2025-12-12 05:21:00', '2025-12-12 05:21:00'),
	(8, 1, 1, '0', NULL, 'Làm quen với Dev tools', 'https://www.youtube.com/watch?v=7BJiPyN4zZ0&t=1s', '<p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);" data-pasted="true">Trong video n&agrave;y ch&uacute;ng ta c&ugrave;ng nhau l&agrave;m quen v&agrave; t&igrave;m hiểu về Dev tools. Dev tools được hiểu đơn giản l&agrave; một bộ c&aacute;c c&ocirc;ng cụ d&agrave;nh cho c&aacute;c lập tr&igrave;nh vi&ecirc;n website, n&oacute; được t&iacute;ch hợp sẵn ngay b&ecirc;n trong c&aacute;c tr&igrave;nh duyệt hiện nay. Đ&acirc;y l&agrave; một c&ocirc;ng cụ hỗ trợ cơ bản, đắc lực v&agrave; bắt buộc phải nắm vững đối với một nh&agrave; ph&aacute;t triển website.&nbsp;</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/hoclaptrinh" target="" style="text-decoration: none; display: inline; color: inherit;">#hoclaptrinh</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/hoclaptrinhmienphi" target="" style="text-decoration: none; display: inline; color: inherit;">#hoclaptrinhmienphi</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/html_css" target="" style="text-decoration: none; display: inline; color: inherit;">#html_css</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/frontend" target="" style="text-decoration: none; display: inline; color: inherit;">#frontend</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/backend" target="" style="text-decoration: none; display: inline; color: inherit;">#backend</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/devops" target="" style="text-decoration: none; display: inline; color: inherit;">#devops</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/devtools" target="" style="text-decoration: none; display: inline; color: inherit;">#devtools</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;Ph&acirc;n đoạn trong video:</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=7BJiPyN4zZ0" target="" style="text-decoration: none; display: inline; color: inherit;">00:00</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;- Giới thiệu dev tools</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=7BJiPyN4zZ0&t=61s" target="" style="text-decoration: none; display: inline; color: inherit;">01:01</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;- Tab elements &amp; styles</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=7BJiPyN4zZ0&t=105s" target="" style="text-decoration: none; display: inline; color: inherit;">01:45</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;- Tab console &amp; sources</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=7BJiPyN4zZ0&t=144s" target="" style="text-decoration: none; display: inline; color: inherit;">02:24</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;- Tab network</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=7BJiPyN4zZ0&t=187s" target="" style="text-decoration: none; display: inline; color: inherit;">03:07</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;- Toggle device toolbar</span></p>', 4.00, 2, 0, NULL, NULL, NULL, NULL, '2025-12-13 19:55:57', '2025-12-13 19:55:57'),
	(9, 1, 5, '0', NULL, 'Cấu trúc của 1 file HTML', 'https://youtu.be/LYnrFSGLCl8?si=UyT_PokvZDLfKe8w', '<p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);" data-pasted="true">Video n&agrave;y giới thiệu đến c&aacute;c bạn những cấu ch&uacute;c đơn giản của một file HTML, hướng dẫn khởi tạo folder dự &aacute;n v&agrave; giới thiệu một số thẻ cơ bản.&nbsp;</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/hoclaptrinh" target="" style="text-decoration: none; display: inline; color: inherit;">#hoclaptrinh</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/hoclaptrinhmienphi" target="" style="text-decoration: none; display: inline; color: inherit;">#hoclaptrinhmienphi</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/html_css" target="" style="text-decoration: none; display: inline; color: inherit;">#html_css</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/frontend" target="" style="text-decoration: none; display: inline; color: inherit;">#frontend</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/backend" target="" style="text-decoration: none; display: inline; color: inherit;">#backend</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/devops" target="" style="text-decoration: none; display: inline; color: inherit;">#devops</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;&nbsp;</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">Ph&acirc;n đoạn trong video:</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=LYnrFSGLCl8&list=PL_-VfJajZj0U9nEXa4qyfB4U5ZIYCMPlz&index=5" target="" style="text-decoration: none; display: inline; color: inherit;">00:00</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;- Intro</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=LYnrFSGLCl8&list=PL_-VfJajZj0U9nEXa4qyfB4U5ZIYCMPlz&index=5&t=15s" target="" style="text-decoration: none; display: inline; color: inherit;">00:15</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;- Tạo folder dự &aacute;n</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=LYnrFSGLCl8&list=PL_-VfJajZj0U9nEXa4qyfB4U5ZIYCMPlz&index=5&t=136s" target="" style="text-decoration: none; display: inline; color: inherit;">02:16</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;- Thẻ html</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=LYnrFSGLCl8&list=PL_-VfJajZj0U9nEXa4qyfB4U5ZIYCMPlz&index=5&t=206s" target="" style="text-decoration: none; display: inline; color: inherit;">03:26</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;- Thẻ title</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=LYnrFSGLCl8&list=PL_-VfJajZj0U9nEXa4qyfB4U5ZIYCMPlz&index=5&t=289s" target="" style="text-decoration: none; display: inline; color: inherit;">04:49</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;- thẻ meta</span></p>', 7.00, 4, 0, NULL, 'lesson/files/p0enAllfpIEMm7MVTlMskDs8LM87sdaU2PlgS1CA.docx', NULL, NULL, '2025-12-13 20:05:23', '2025-12-13 20:05:23'),
	(10, 1, 5, '0', NULL, 'Comments trong HTML', 'https://www.youtube.com/watch?v=JG0pdfdKjgQ&list=PL_-VfJajZj0U9nEXa4qyfB4U5ZIYCMPlz&index=6', '<p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);" data-pasted="true">Video n&agrave;y giới thiệu tới c&aacute;c bạn về Comments trong HTML, mục đ&iacute;ch sử dụng cũng như c&uacute; ph&aacute;p mở v&agrave; đ&oacute;ng Comments.</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/hoclaptrinh" target="" style="text-decoration: none; display: inline; color: inherit;">#hoclaptrinh</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/hoclaptrinhmienphi" target="" style="text-decoration: none; display: inline; color: inherit;">#hoclaptrinhmienphi</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/html_css" target="" style="text-decoration: none; display: inline; color: inherit;">#html_css</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/frontend" target="" style="text-decoration: none; display: inline; color: inherit;">#frontend</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/backend" target="" style="text-decoration: none; display: inline; color: inherit;">#backend</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/devops" target="" style="text-decoration: none; display: inline; color: inherit;">#devops</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/vscode" target="" style="text-decoration: none; display: inline; color: inherit;">#vscode</a></span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;Ph&acirc;n đoạn trong video:</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=JG0pdfdKjgQ&list=PL_-VfJajZj0U9nEXa4qyfB4U5ZIYCMPlz&index=6" target="" style="text-decoration: none; display: inline; color: inherit;">00:00</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;- C&uacute; ph&aacute;p Comments trong HTML</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=JG0pdfdKjgQ&list=PL_-VfJajZj0U9nEXa4qyfB4U5ZIYCMPlz&index=6&t=74s" target="" style="text-decoration: none; display: inline; color: inherit;">01:14</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(3, 41, 61);">&nbsp;- Mục đ&iacute;ch sử dụng Comments&nbsp;</span></p>', 3.00, 4, 0, NULL, NULL, NULL, NULL, '2025-12-13 20:07:47', '2025-12-13 20:07:47'),
	(11, 1, 6, '0', NULL, 'Cách sử dụng CSS trong HTML', 'https://www.youtube.com/watch?v=NsSsJTg29oE&list=PL_-VfJajZj0U9nEXa4qyfB4U5ZIYCMPlz&index=9', '<p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(7, 27, 57);" data-pasted="true">Video n&agrave;y ch&uacute;ng ta c&ugrave;ng t&igrave;m hiểu về c&aacute;c c&aacute;ch sử dụng CSS trong file HTML v&agrave; chi tiết cụ thể của từng c&aacute;ch.&nbsp;</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/hoclaptrinh" target="" style="text-decoration: none; display: inline; color: inherit;">#hoclaptrinh</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(7, 27, 57);">&nbsp;&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/hoclaptrinhmienphi" target="" style="text-decoration: none; display: inline; color: inherit;">#hoclaptrinhmienphi</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(7, 27, 57);">&nbsp;&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/html_css" target="" style="text-decoration: none; display: inline; color: inherit;">#html_css</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(7, 27, 57);">&nbsp;&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/frontend" target="" style="text-decoration: none; display: inline; color: inherit;">#frontend</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(7, 27, 57);">&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/backend" target="" style="text-decoration: none; display: inline; color: inherit;">#backend</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(7, 27, 57);">&nbsp;&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/devops" target="" style="text-decoration: none; display: inline; color: inherit;">#devops</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(7, 27, 57);">&nbsp;&nbsp;</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(7, 27, 57);">&nbsp;Ph&acirc;n đoạn trong video:</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=NsSsJTg29oE&list=PL_-VfJajZj0U9nEXa4qyfB4U5ZIYCMPlz&index=9" target="" style="text-decoration: none; display: inline; color: inherit;">00:00</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(7, 27, 57);">&nbsp;- Giới thiệu</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=NsSsJTg29oE&list=PL_-VfJajZj0U9nEXa4qyfB4U5ZIYCMPlz&index=9&t=49s" target="" style="text-decoration: none; display: inline; color: inherit;">00:49</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(7, 27, 57);">&nbsp;- Sử dụng Internal</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=NsSsJTg29oE&list=PL_-VfJajZj0U9nEXa4qyfB4U5ZIYCMPlz&index=9&t=179s" target="" style="text-decoration: none; display: inline; color: inherit;">02:59</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(7, 27, 57);">&nbsp;- Sử dụng External</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=NsSsJTg29oE&list=PL_-VfJajZj0U9nEXa4qyfB4U5ZIYCMPlz&index=9&t=322s" target="" style="text-decoration: none; display: inline; color: inherit;">05:22</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(7, 27, 57);">&nbsp;- Sử dụng Inline</span></p>', 8.00, 5, 0, NULL, NULL, NULL, NULL, '2025-12-13 20:09:28', '2025-12-13 20:09:28'),
	(12, 1, 6, '0', NULL, 'ID và Class trong CSS selectors', 'https://www.youtube.com/watch?v=4J6d8cr0X48&list=PL_-VfJajZj0U9nEXa4qyfB4U5ZIYCMPlz&index=10', '<p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(7, 28, 57);" data-pasted="true">Trong b&agrave;i n&agrave;y ch&uacute;ng ta c&ugrave;ng t&igrave;m hiểu về kh&aacute;i niệm ID v&agrave; Class trong CSS selectors. C&aacute;ch sử dụng ID &amp; Class.&nbsp;</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/hoclaptrinh" target="" style="text-decoration: none; display: inline; color: inherit;">#hoclaptrinh</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(7, 28, 57);">&nbsp;&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/hoclaptrinhmienphi" target="" style="text-decoration: none; display: inline; color: inherit;">#hoclaptrinhmienphi</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(7, 28, 57);">&nbsp;&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/html_css" target="" style="text-decoration: none; display: inline; color: inherit;">#html_css</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(7, 28, 57);">&nbsp;&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/frontend" target="" style="text-decoration: none; display: inline; color: inherit;">#frontend</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(7, 28, 57);">&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/backend" target="" style="text-decoration: none; display: inline; color: inherit;">#backend</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(7, 28, 57);">&nbsp;&nbsp;</span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/hashtag/devops" target="" style="text-decoration: none; display: inline; color: inherit;">#devops</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(7, 28, 57);">&nbsp;&nbsp;</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(7, 28, 57);">&nbsp;Ph&acirc;n đoạn trong video:</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=4J6d8cr0X48&list=PL_-VfJajZj0U9nEXa4qyfB4U5ZIYCMPlz&index=10" target="" style="text-decoration: none; display: inline; color: inherit;">00:00</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(7, 28, 57);">&nbsp;- Kh&aacute;i niệm CSS selectors</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=4J6d8cr0X48&list=PL_-VfJajZj0U9nEXa4qyfB4U5ZIYCMPlz&index=10&t=97s" target="" style="text-decoration: none; display: inline; color: inherit;">01:37</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(7, 28, 57);">&nbsp;- ID</span></p><p><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(6, 95, 212);"><a tabindex="0" href="https://www.youtube.com/watch?v=4J6d8cr0X48&list=PL_-VfJajZj0U9nEXa4qyfB4U5ZIYCMPlz&index=10&t=135s" target="" style="text-decoration: none; display: inline; color: inherit;">02:15</a></span><span dir="auto" style="margin: 0px; padding: 0px; border: 0px; background: rgba(0, 0, 0, 0.05); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(7, 28, 57);">&nbsp;- Class</span></p>', 5.00, 6, 0, NULL, NULL, NULL, NULL, '2025-12-13 20:12:32', '2025-12-13 20:12:32'),
	(13, 1, 6, '0', NULL, 'teest', 'https://youtu.be/q-3VyQQ_wFM?si=4R3CPDFt1aXOCXBu', '<p>&egrave;hceorcnorec</p>', 6.00, 7, 0, NULL, NULL, NULL, NULL, '2025-12-13 20:42:14', '2025-12-13 20:42:14'),
	(14, 1, 1, 'quiz', 3, 'Bài test cuối chương 1', NULL, NULL, NULL, 3, 0, NULL, NULL, NULL, NULL, '2025-12-19 09:18:35', '2025-12-22 01:41:17'),
	(15, 11, 10, '0', NULL, 'Giới thiệu khóa học edit video trên phần mềm capcut', 'https://www.youtube.com/watch?v=mV9HKoC8PXk&list=PL_M35Fsct2YXVEmtOi_uh3q3rvCW95lfB&index=1', '<p><span style="color: rgb(61, 3, 3); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; background-color: rgba(0, 0, 0, 0.05); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;" data-pasted="true">Kh&oacute;a học edit video tr&ecirc;n phần mềm capcut pc - B&agrave;i 1 Bạn muốn edit video tr&ecirc;n m&aacute;y t&iacute;nh nhưng kh&ocirc;ng biết lựa chọn phần mềm n&agrave;o v&agrave; bắt đầu từ đ&acirc;u. Bạn đang edit video tr&ecirc;n capcut pc nhưng gặp kh&oacute; khăn khi sử dụng c&aacute;c c&ocirc;ng cụ l&agrave;m việc. kh&oacute;a học chỉnh sửa video tr&ecirc;n capcut pc từ cơ bản đến n&acirc;ng cao, c&aacute;c video chi tiết nhất gi&uacute;p bạn hiểu r&otilde; được những c&ocirc;ng cụ l&agrave;m việc tr&ecirc;n capcut m&aacute;y t&iacute;nh. Hướng dẫn c&aacute;ch edit video hay v&agrave; hấp dẫn.</span></p>', 3.02, 1, 1, NULL, NULL, NULL, NULL, '2025-12-23 10:19:01', '2025-12-23 10:19:01'),
	(16, 1, 5, 'quiz', 4, NULL, NULL, NULL, NULL, 5, 0, NULL, NULL, NULL, NULL, '2025-12-26 10:51:33', '2025-12-26 10:51:33');

-- Dumping structure for table edupress.lesson_attachments
CREATE TABLE IF NOT EXISTS `lesson_attachments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lesson_id` bigint unsigned NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lesson_attachments_lesson_id_foreign` (`lesson_id`),
  CONSTRAINT `lesson_attachments_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.lesson_attachments: ~0 rows (approximately)

-- Dumping structure for table edupress.lesson_contents
CREATE TABLE IF NOT EXISTS `lesson_contents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lesson_id` bigint unsigned NOT NULL,
  `type` enum('video','text','quiz') COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lesson_contents_lesson_id_foreign` (`lesson_id`),
  CONSTRAINT `lesson_contents_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.lesson_contents: ~0 rows (approximately)

-- Dumping structure for table edupress.lesson_options
CREATE TABLE IF NOT EXISTS `lesson_options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.lesson_options: ~0 rows (approximately)

-- Dumping structure for table edupress.lesson_progress
CREATE TABLE IF NOT EXISTS `lesson_progress` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `lesson_id` bigint unsigned NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lesson_progress_user_id_lesson_id_unique` (`user_id`,`lesson_id`),
  KEY `lesson_progress_lesson_id_foreign` (`lesson_id`),
  CONSTRAINT `lesson_progress_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lesson_progress_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.lesson_progress: ~0 rows (approximately)

-- Dumping structure for table edupress.lesson_questions
CREATE TABLE IF NOT EXISTS `lesson_questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.lesson_questions: ~0 rows (approximately)

-- Dumping structure for table edupress.live_sessions
CREATE TABLE IF NOT EXISTS `live_sessions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `topic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `platform` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Zoom',
  `meeting_link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_at` datetime NOT NULL,
  `duration_minutes` int NOT NULL DEFAULT '60',
  `is_teacher_joined` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `live_sessions_course_id_foreign` (`course_id`),
  CONSTRAINT `live_sessions_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.live_sessions: ~2 rows (approximately)
INSERT INTO `live_sessions` (`id`, `course_id`, `topic`, `description`, `platform`, `meeting_link`, `start_at`, `duration_minutes`, `is_teacher_joined`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Giải đáp thắc mắc chương 1', 'test', 'Microsoft Teams', 'https://teams.microsoft.com/l/meetup-join/19%3ameeting_ZWNiYTdiMzctZDQ3MC00YWNmLThiNTAtMmU4NjFhZTAwNmFi%40thread.v2/0?context=%7b%22Tid%22%3a%224ef78439-6d6c-4ea0-ab14-49b9284ab4c9%22%2c%22Oid%22%3a%2235d97efe-d641-4888-bb4f-8eb4641339bc%22%7d', '2025-12-13 08:47:00', 60, 1, '2025-12-12 18:47:52', '2025-12-12 19:16:25'),
	(2, 1, 'Giải đáp chương 2', 'Giải đáp chương 2', 'Microsoft Teams', 'https://teams.microsoft.com/l/meetup-join/19%3ameeting_ZWNiYTdiMzctZDQ3MC00YWNmLThiNTAtMmU4NjFhZTAwNmFi%40thread.v2/0?context=%7b%22Tid%22%3a%224ef78439-6d6c-4ea0-ab14-49b9284ab4c9%22%2c%22Oid%22%3a%2235d97efe-d641-4888-bb4f-8eb4641339bc%22%7d', '2025-12-31 22:10:00', 60, 0, '2025-12-26 01:13:37', '2025-12-26 07:49:24');

-- Dumping structure for table edupress.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.migrations: ~39 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_11_07_153822_create_categories_table', 1),
	(5, '2025_11_08_155818_create_sub_categories_table', 1),
	(6, '2025_11_11_155004_create_sliders_table', 1),
	(7, '2025_11_13_155537_create_info_boxes_table', 1),
	(8, '2025_11_18_151922_create_courses_table', 1),
	(9, '2025_11_18_162304_create_lesson_progresses_table', 1),
	(10, '2025_11_18_162329_create_course_enrollments_table', 1),
	(11, '2025_11_18_162412_create_certificates_table', 1),
	(12, '2025_11_18_163101_create_course_lessons_table', 1),
	(13, '2025_11_18_163142_create_lesson_questions_table', 1),
	(14, '2025_11_18_163209_create_lesson_options_table', 1),
	(15, '2025_11_18_163236_create_course_quizzes_table', 1),
	(16, '2025_11_18_163305_create_course_quiz_options_table', 1),
	(17, '2025_11_18_163334_create_user_course_progresses_table', 1),
	(18, '2025_11_18_163404_create_user_course_results_table', 1),
	(19, '2025_11_18_163432_create_course_certificates_table', 1),
	(20, '2025_11_30_134851_create_lessons_table', 1),
	(21, '2025_11_30_135640_create_course_videos_table', 1),
	(22, '2025_12_08_012305_create_lesson_attachments_table', 1),
	(25, '2025_12_10_031632_create_sections_table', 2),
	(26, '2025_12_09_134312_remove_video_url_from_courses', 3),
	(27, '2025_12_09_165223_create_lesson_contents_table', 3),
	(28, '2025_12_10_090206_create_sections_table', 4),
	(29, '2025_12_10_120930_create_quizzes_table', 4),
	(30, '2025_12_10_121131_create_questions_table', 4),
	(31, '2025_12_10_121350_create_answers_table', 4),
	(32, '2025_12_10_153633_add_limit_duration_to_courses_table', 5),
	(33, '2025_12_10_155708_create_lesson_progress_table', 6),
	(34, '2025_12_10_160158_create_course_enrollments_table', 7),
	(35, '2025_12_11_180334_create_course_lectures_table', 7),
	(36, '2025_12_12_015455_create_course_lectures_table', 8),
	(37, '2025_12_12_113502_create_lessons_table', 9),
	(38, '2025_12_12_115029_create_question_attachments_table', 10),
	(39, '2025_12_12_120112_create_lesson_attachments_table', 11),
	(40, '2025_12_12_142245_add_lesson_type_and_quiz_id_to_lessons_table', 12),
	(41, '2025_12_12_165615_create_coupons_table', 13),
	(42, '2025_12_12_172354_create_live_sessions_table', 14),
	(43, '2025_12_12_172503_create_attendances_table', 14),
	(44, '2025_12_13_021320_create_course_user_table', 15),
	(45, '2025_12_13_125436_create_course_goals_table', 16),
	(46, '2025_12_13_125752_create_course_goals_table', 17),
	(47, '2025_12_14_092353_create_wishlists_table', 18),
	(48, '2025_12_14_125605_create_carts_table', 19),
	(49, '2025_12_15_045109_create_payments_table', 20),
	(50, '2025_12_15_045238_create_orders_table', 20),
	(51, '2025_12_15_045541_create_stripes_table', 20),
	(52, '2025_12_15_085805_create_coupons_table', 21),
	(53, '2025_12_15_152424_create_stripes_table', 22),
	(54, '2025_12_16_123811_create_partners_table', 23),
	(55, '2025_12_16_125230_create_site_infos_table', 24),
	(56, '2025_12_16_130059_create_googles_table', 25),
	(57, '2025_12_16_164448_create_smtps_table', 26),
	(58, '2025_12_16_182418_create_blogs_table', 27),
	(59, '2025_12_16_184742_create_reviews_table', 28),
	(60, '2025_12_17_000000_create_comments_table', 29),
	(61, '2025_12_17_000001_add_tags_to_blogs_table', 29),
	(62, '2025_12_18_000003_create_assessment_questions_table', 30),
	(63, '2025_12_18_141902_add_type_to_coupons_table', 31),
	(64, '2025_12_18_185105_add_user_id_to_lesson_progresses', 32),
	(65, '2025_12_18_185627_create_lesson_progress_table', 33),
	(66, '2025_12_19_154658_create_quizzes_table', 34),
	(67, '2025_12_21_151317_create_quiz_results_table', 35),
	(68, '2025_12_24_035711_create_instructor_earnings_table', 36),
	(69, '2025_12_24_085129_add_course_id_to_instructor_earnings', 37),
	(70, '2025_12_24_085945_create_withdrawals_table', 38),
	(71, '2025_12_24_091018_add_bank_fields_to_users_table', 39),
	(72, '2025_12_25_045510_create_payrolls_table', 40),
	(73, '2025_12_25_050447_add_salary_fields_to_users_table', 41),
	(74, '2025_12_26_033414_add_commission_to_courses_table', 42),
	(75, '2025_12_26_040212_add_commission_rate_to_users_table', 42),
	(76, '2025_12_26_160617_add_certificate_status_to_enrollments', 43);

-- Dumping structure for table edupress.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `payment_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `course_id` int DEFAULT NULL,
  `instructor_id` int DEFAULT NULL,
  `course_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.orders: ~1 rows (approximately)
INSERT INTO `orders` (`id`, `payment_id`, `user_id`, `course_id`, `instructor_id`, `course_title`, `price`, `created_at`, `updated_at`) VALUES
	(1, 1, 5, 2, 2, 'Làm phim hoạt hình 3D', 1100000, '2025-12-15 11:39:45', '2025-12-15 11:39:45'),
	(3, 3, 5, 3, 2, 'Lập trình Android từ A - Z', 900000, '2025-12-23 08:05:29', '2025-12-23 08:05:29');

-- Dumping structure for table edupress.partners
CREATE TABLE IF NOT EXISTS `partners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.partners: ~5 rows (approximately)
INSERT INTO `partners` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
	(1, 'HEXA', 'uploads/slider/1765906970_69419a1a2e903.png', '2025-12-16 10:36:08', '2025-12-16 10:42:50'),
	(2, 'Cricle', 'uploads/slider/1765906612_694198b404b53.png', '2025-12-16 10:36:52', '2025-12-16 10:36:52'),
	(3, 'kanba', 'uploads/slider/1765906635_694198cbd886c.png', '2025-12-16 10:37:15', '2025-12-16 10:37:15'),
	(4, 'liva', 'uploads/slider/1765906654_694198dee4cc4.png', '2025-12-16 10:37:34', '2025-12-16 10:37:34'),
	(5, 'treva.', 'uploads/slider/1765906696_69419908138de.png', '2025-12-16 10:38:16', '2025-12-16 10:38:16');

-- Dumping structure for table edupress.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table edupress.payments
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cash_delivery` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.payments: ~2 rows (approximately)
INSERT INTO `payments` (`id`, `transaction_id`, `name`, `email`, `phone`, `address`, `cash_delivery`, `total_amount`, `payment_type`, `invoice_no`, `order_date`, `order_month`, `order_year`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'pi_3SeggJC7rDogFa2W0Dbqjm94', 'fruheo', 'pp6686336@gmail.com', NULL, NULL, NULL, '1100000', 'stripe', 'INV-694055F13ED10', '2025-12-15', 'December', '2025', 'completed', '2025-12-15 11:39:45', '2025-12-15 11:39:45'),
	(2, 'pi_3ShX6PC7rDogFa2W1mbGQaFs', 'fruheo', 'pp6686336@gmail.com', NULL, NULL, NULL, '900000', 'stripe', 'INV-694AAF0142E18', '2025-12-23', 'December', '2025', 'completed', '2025-12-23 08:02:25', '2025-12-23 08:02:25');

-- Dumping structure for table edupress.payrolls
CREATE TABLE IF NOT EXISTS `payrolls` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `instructor_id` bigint unsigned NOT NULL,
  `payroll_month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fixed_salary` decimal(15,2) NOT NULL DEFAULT '0.00',
  `support_fee` decimal(15,2) NOT NULL DEFAULT '0.00',
  `course_revenue` decimal(15,2) NOT NULL DEFAULT '0.00',
  `student_count` int NOT NULL DEFAULT '0',
  `total_amount` decimal(15,2) NOT NULL,
  `bank_receipt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('draft','sent_to_instructor','approved','paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `admin_note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payrolls_instructor_id_foreign` (`instructor_id`),
  CONSTRAINT `payrolls_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.payrolls: ~1 rows (approximately)
INSERT INTO `payrolls` (`id`, `instructor_id`, `payroll_month`, `fixed_salary`, `support_fee`, `course_revenue`, `student_count`, `total_amount`, `bank_receipt`, `status`, `admin_note`, `created_at`, `updated_at`) VALUES
	(2, 2, '2025-12', 8000000.00, 100000.00, 880000.00, 0, 8980000.00, NULL, 'paid', NULL, '2025-12-25 20:31:41', '2025-12-25 22:16:28');

-- Dumping structure for table edupress.questions
CREATE TABLE IF NOT EXISTS `questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `quiz_id` bigint unsigned NOT NULL,
  `type` enum('multiple_choice','single_choice','text') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'single_choice',
  `question_text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `marks` int NOT NULL DEFAULT '1',
  `order` int NOT NULL DEFAULT '0',
  `correct_answer_text` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_quiz_id_foreign` (`quiz_id`),
  CONSTRAINT `questions_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.questions: ~9 rows (approximately)
INSERT INTO `questions` (`id`, `quiz_id`, `type`, `question_text`, `marks`, `order`, `correct_answer_text`, `created_at`, `updated_at`) VALUES
	(1, 1, 'single_choice', 'Để khai báo một phần tử điều khiển khi nhấn vào sẽ gửi thông tin của form đi ta sử dụng thẻ:\r\nA. <input type= "text">\r\nB.  <input type = "submit"\r\n\r\nC.  <input type="password"\r\n\r\nD.  <input type ="reset"', 2, 1, NULL, '2025-12-10 06:33:43', '2025-12-15 02:56:36'),
	(2, 1, 'single_choice', 'Để khai báo một phần tử điều khiển tạo một nút nhấn trên trang web ta sử dụng thẻ:\r\nA. <input type= "file">\r\n\r\nB. <input type ="button">\r\n\r\nC.  <input type= "hidden"\r\n\r\nD. <input type ="image">', 2, 2, NULL, '2025-12-10 06:35:03', '2025-12-15 02:56:45'),
	(3, 1, 'single_choice', 'Câu 3:\r\nĐể khai báo một phần tử điều khiển để mở một hộp thoại giúp người dùng mở một file trên hệ thống thư mục của máy tính ta sử dụng thẻ:\r\nA. <input type= "file">\r\nB. <input type = "button">\r\nC. <input type= "hidden"\r\nD. <input type = "image">', 2, 3, NULL, '2025-12-10 06:36:58', '2025-12-15 02:56:54'),
	(4, 1, 'single_choice', 'Để xác định trình tự nhận tiêu điểm của phần tử thông qua bàn phím ta sử dụng thuộc tính:\r\nA. Focus\r\nB. Accesskey\r\nC. Tabindex\r\nD. Id', 2, 4, NULL, '2025-12-10 06:38:13', '2025-12-15 02:57:10'),
	(5, 3, 'single_choice', 'Câu 1:\r\nĐể khai báo một phần tử điều khiển khi nhấn vào sẽ gửi thông tin của form đi ta sử dụng thẻ:', 2, 1, NULL, '2025-12-12 07:46:33', '2025-12-22 01:36:11'),
	(6, 3, 'single_choice', 'Câu 2:\r\nĐể khai báo một phần tử điều khiển tạo một nút nhấn trên trang web ta sử dụng thẻ:', 2, 2, NULL, '2025-12-12 08:16:36', '2025-12-22 01:38:08'),
	(7, 3, 'single_choice', 'Câu 3: Để khai báo một phần tử điều khiển để mở một hộp thoại giúp người dùng mở một file trên hệ thống thư mục của máy tính ta sử dụng thẻ:', 1, 3, NULL, '2025-12-12 08:17:39', '2025-12-22 01:39:24'),
	(8, 3, 'single_choice', 'Câu 4: Để xác định trình tự nhận tiêu điểm của phần tử thông qua bàn phím ta sử dụng thuộc tính:', 3, 4, NULL, '2025-12-12 08:18:52', '2025-12-22 01:40:16'),
	(9, 3, 'single_choice', 'Câu 5:\r\nThứ tự xép tầng của css theo độ ưu tiên từ thấp đến cao như sau:', 2, 5, NULL, '2025-12-12 08:19:55', '2025-12-22 01:41:04'),
	(10, 4, 'single_choice', 'HTML là viết tắt của...', 1, 1, NULL, '2025-12-26 10:53:16', '2025-12-26 10:53:16'),
	(11, 4, 'single_choice', 'Ai là người đưa ra các tiêu chuẩn Web?', 1, 2, NULL, '2025-12-26 10:54:16', '2025-12-26 10:54:16'),
	(12, 4, 'single_choice', 'Chọn thẻ HTML đúng nhất cho định dạng tiêu đề lớn nhất?', 1, 3, NULL, '2025-12-26 10:55:30', '2025-12-26 10:55:30'),
	(13, 4, 'single_choice', 'Thẻ nào dùng để xuống dòng trong HTML?', 1, 4, NULL, '2025-12-26 10:56:37', '2025-12-26 10:56:37'),
	(14, 4, 'single_choice', 'Mã HTML nào thực hiện việc thêm màu nền cho trang web?', 1, 5, NULL, '2025-12-26 10:58:32', '2025-12-26 10:58:32');

-- Dumping structure for table edupress.quizzes
CREATE TABLE IF NOT EXISTS `quizzes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `section_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `total_marks` int NOT NULL DEFAULT '0',
  `pass_score` int NOT NULL DEFAULT '60',
  `duration_minutes` int DEFAULT NULL,
  `show_result_immediately` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quizzes_course_id_foreign` (`course_id`),
  KEY `quizzes_section_id_foreign` (`section_id`),
  CONSTRAINT `quizzes_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `quizzes_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.quizzes: ~1 rows (approximately)
INSERT INTO `quizzes` (`id`, `course_id`, `section_id`, `title`, `description`, `total_marks`, `pass_score`, `duration_minutes`, `show_result_immediately`, `status`, `created_at`, `updated_at`) VALUES
	(3, 1, 1, 'Bài test cuối chương 1', 'Bài kiểm tra kiến thức', 0, 60, 2, 1, 1, '2025-12-19 09:18:35', '2025-12-22 01:41:17'),
	(4, 1, 5, 'Bài kiểm tra chương 2', 'Bài kiểm tra kiến thức chương 2', 5, 60, 2, 1, 1, '2025-12-26 10:51:33', '2025-12-26 10:58:32');

-- Dumping structure for table edupress.quiz_results
CREATE TABLE IF NOT EXISTS `quiz_results` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `quiz_id` bigint unsigned NOT NULL,
  `total_questions` int NOT NULL,
  `correct_answers` int NOT NULL,
  `score` decimal(5,2) NOT NULL,
  `percentage` int NOT NULL,
  `status` enum('pass','fail','pending') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_results_user_id_foreign` (`user_id`),
  KEY `quiz_results_quiz_id_foreign` (`quiz_id`),
  CONSTRAINT `quiz_results_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `quiz_results_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.quiz_results: ~2 rows (approximately)
INSERT INTO `quiz_results` (`id`, `user_id`, `quiz_id`, `total_questions`, `correct_answers`, `score`, `percentage`, `status`, `created_at`, `updated_at`) VALUES
	(1, 5, 3, 5, 0, 0.00, 0, 'fail', '2025-12-22 02:57:46', '2025-12-22 02:57:46'),
	(2, 5, 3, 5, 5, 10.00, 100, 'pass', '2025-12-22 06:40:10', '2025-12-22 06:40:10'),
	(3, 5, 3, 5, 5, 10.00, 100, 'pass', '2025-12-22 06:43:37', '2025-12-22 06:43:37'),
	(4, 5, 4, 5, 4, 4.00, 80, 'pass', '2025-12-26 11:00:18', '2025-12-26 11:00:18'),
	(5, 5, 4, 5, 4, 4.00, 80, 'pass', '2025-12-26 11:03:55', '2025-12-26 11:03:55');

-- Dumping structure for table edupress.reviews
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.reviews: ~0 rows (approximately)
INSERT INTO `reviews` (`id`, `course_id`, `user_id`, `comment`, `rating`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 5, 'ehrfhjkfnkcneref rjv', '4', 0, '2025-12-18 22:02:25', '2025-12-18 22:02:25');

-- Dumping structure for table edupress.sections
CREATE TABLE IF NOT EXISTS `sections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sections_course_id_foreign` (`course_id`),
  CONSTRAINT `sections_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.sections: ~5 rows (approximately)
INSERT INTO `sections` (`id`, `course_id`, `title`, `position`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Chương mở đầu', 0, '2025-12-11 18:48:21', '2025-12-11 18:48:21'),
	(2, 2, 'Chương 1', 0, '2025-12-12 00:16:14', '2025-12-12 00:16:14'),
	(3, 2, 'Chương 2', 0, '2025-12-12 00:47:09', '2025-12-12 00:47:09'),
	(5, 1, 'Làm quen với HTML', 0, '2025-12-12 05:27:04', '2025-12-12 05:27:04'),
	(6, 1, 'Làm quen với CSS', 0, '2025-12-12 05:27:32', '2025-12-12 05:27:32'),
	(9, 5, 'Chương 1', 0, '2025-12-12 21:33:39', '2025-12-12 21:33:39'),
	(10, 11, 'Chương 1: Chương bắt đầu', 0, '2025-12-23 10:15:16', '2025-12-23 10:15:16');

-- Dumping structure for table edupress.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.sessions: ~1 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('qOzW29PYmZuxI1dx6EV8sfpA2RKNRYjofgxqNBCM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWnhBVUFBb3VWMFV3OTNlNFpJVUlWd2pwWnBOZks4Qk1xQmtSWGoyTSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czoxMzoiZnJvbnRlbmQuaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766823662),
	('UXDibrXYAV20NFhOSNJ1YvT1vIgDUBfVtGlIJTsq', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMDJ4Q0I1aEFnOFJXd1lETWt1SFNjTzhscllTZ0dyVW5KbFJpU25IVSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yeS85IjtzOjU6InJvdXRlIjtzOjE1OiJjYXRlZ29yeS5jb3Vyc2UiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O30=', 1766813699);

-- Dumping structure for table edupress.site_infos
CREATE TABLE IF NOT EXISTS `site_infos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.site_infos: ~0 rows (approximately)

-- Dumping structure for table edupress.sliders
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.sliders: ~3 rows (approximately)
INSERT INTO `sliders` (`id`, `title`, `short_description`, `video_url`, `image`, `created_at`, `updated_at`) VALUES
	(1, 'We Help You Learn What You Love', 'Emply dummy text of the printing and typesetting industry orem Ipsum has been the industry\'s standard dummy text ever sinceprinting and typesetting industry', 'https://youtu.be/fMwnhhCrlkk?si=_3we_exX47oeGPHX', 'uploads/slider/1765267604_6937d894a54f4.jpg', '2025-12-08 07:53:41', '2025-12-09 01:06:44'),
	(2, 'Join Educa & Get Your Free Courses', 'Emply dummy text of the printing and typesetting industry orem Ipsum has been the industry\'s standard dummy text ever sinceprinting and typesetting industry.', 'https://www.youtube.com/watch?v=ezbJwaLmOeM', 'uploads/slider/1765205835_6936e74bce23e.jpg', '2025-12-08 07:57:15', '2025-12-08 07:57:15'),
	(3, 'Learn Anything, Anytime, Anywhere', 'Emply dummy text of the printing and typesetting industry orem Ipsum has been the industry\'s standard dummy text ever sinceprinting and typesetting industry.', 'https://www.youtube.com/watch?v=ezbJwaLmOeM', 'uploads/slider/1765205899_6936e78b6b922.jpg', '2025-12-08 07:58:19', '2025-12-08 07:58:19');

-- Dumping structure for table edupress.smtps
CREATE TABLE IF NOT EXISTS `smtps` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mailer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `host` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `port` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `encryption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.smtps: ~0 rows (approximately)
INSERT INTO `smtps` (`id`, `mailer`, `host`, `port`, `username`, `password`, `encryption`, `from_address`, `created_at`, `updated_at`) VALUES
	(1, 'smtp', 'sandbox.smtp.mailtrap.io', '2525', 'bd52d3d4ccd05a', '1aa4f5d142122e', 'tls', 'pp6686336@gmail.com', '2025-12-16 10:02:36', '2025-12-16 10:02:36');

-- Dumping structure for table edupress.stripes
CREATE TABLE IF NOT EXISTS `stripes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `publish_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secret_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.stripes: ~0 rows (approximately)

-- Dumping structure for table edupress.sub_categories
CREATE TABLE IF NOT EXISTS `sub_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_categories_category_id_foreign` (`category_id`),
  CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.sub_categories: ~39 rows (approximately)
INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
	(9, 6, 'All Business', 'all-business', '2025-12-08 07:30:34', '2025-12-08 07:30:34'),
	(10, 6, 'Finance', 'finance', '2025-12-08 07:30:52', '2025-12-08 07:30:52'),
	(11, 6, 'Entrepreneurship', 'entrepreneurship', '2025-12-08 07:31:27', '2025-12-08 07:31:27'),
	(12, 6, 'Home Business', 'home-business', '2025-12-08 07:31:53', '2025-12-08 07:31:53'),
	(13, 6, 'Communication', 'communication', '2025-12-08 07:32:11', '2025-12-08 07:32:11'),
	(14, 6, 'Industry', 'industry', '2025-12-08 07:32:25', '2025-12-08 07:32:25'),
	(15, 3, 'All Design', 'all-design', '2025-12-08 07:32:50', '2025-12-08 07:32:50'),
	(16, 3, 'Graphic Design', 'graphic-design', '2025-12-08 07:33:08', '2025-12-08 07:33:08'),
	(17, 3, 'Web Design', 'web-design', '2025-12-08 07:33:31', '2025-12-08 07:33:31'),
	(18, 3, 'Design Tool', 'design-tool', '2025-12-08 07:33:47', '2025-12-08 07:33:47'),
	(19, 3, '3D & Animation', '3d--animation', '2025-12-08 07:34:13', '2025-12-08 07:34:13'),
	(20, 3, 'User Experience', 'user-experience', '2025-12-08 07:34:38', '2025-12-08 07:34:38'),
	(21, 2, 'Social Media Marketing', 'social-media-marketing', '2025-12-08 07:35:27', '2025-12-08 07:35:27'),
	(22, 2, 'Branding', 'branding', '2025-12-08 07:35:41', '2025-12-08 07:35:41'),
	(23, 2, 'Video & Mobile Marketing', 'video--mobile-marketing', '2025-12-08 07:36:07', '2025-12-08 07:36:07'),
	(24, 2, 'Affiliate Marketing', 'affiliate-marketing', '2025-12-08 07:36:37', '2025-12-08 07:36:37'),
	(25, 2, 'Growth Hacking', 'growth-hacking', '2025-12-08 07:36:56', '2025-12-08 07:36:56'),
	(26, 5, 'All Health & Fitness', 'all-health--fitness', '2025-12-08 07:37:36', '2025-12-08 07:37:36'),
	(27, 5, 'Dance', 'dance', '2025-12-08 07:37:52', '2025-12-08 07:37:52'),
	(28, 5, 'Yoga', 'yoga', '2025-12-08 07:38:02', '2025-12-08 07:38:02'),
	(29, 5, 'Sports', 'sports', '2025-12-08 07:38:16', '2025-12-08 07:38:16'),
	(30, 5, 'Dieting', 'dieting', '2025-12-08 07:38:31', '2025-12-08 07:38:31'),
	(31, 4, 'All Photography', 'all-photography', '2025-12-08 07:39:08', '2025-12-08 07:39:08'),
	(32, 4, 'Digital Photography', 'digital-photography', '2025-12-08 07:39:42', '2025-12-08 07:39:42'),
	(33, 4, 'Photography Fundamentals', 'photography-fundamentals', '2025-12-08 07:40:13', '2025-12-08 07:40:13'),
	(34, 4, 'Commercial Photography', 'commercial-photography', '2025-12-08 07:40:45', '2025-12-08 07:40:45'),
	(35, 4, 'Video Design', 'video-design', '2025-12-08 07:41:14', '2025-12-08 07:41:14'),
	(36, 4, 'Photography Tools', 'photography-tools', '2025-12-08 07:42:14', '2025-12-08 07:42:14'),
	(37, 7, 'AllFinance & Accouning', 'allfinance--accouning', '2025-12-08 07:43:26', '2025-12-08 07:43:26'),
	(38, 7, 'Accouning & Bookkeeping', 'accouning--bookkeeping', '2025-12-08 07:43:47', '2025-12-08 07:43:47'),
	(39, 7, 'Accouning & Blockchain', 'accouning--blockchain', '2025-12-08 07:44:11', '2025-12-08 07:44:11'),
	(40, 7, 'Economics', 'economics', '2025-12-08 07:44:41', '2025-12-08 07:44:41'),
	(41, 7, 'Investing & Trading', 'investing--trading', '2025-12-08 07:45:07', '2025-12-08 07:45:07'),
	(42, 9, 'Web Development', 'web-development', '2025-12-09 01:01:25', '2025-12-09 01:01:25'),
	(43, 9, 'All Development', 'all-development', '2025-12-09 01:01:49', '2025-12-09 01:01:49'),
	(44, 9, 'Mobile App', 'mobile-app', '2025-12-09 01:02:01', '2025-12-09 01:02:01'),
	(45, 9, 'Game Development', 'game-development', '2025-12-09 01:02:17', '2025-12-09 01:02:17'),
	(46, 9, 'Database', 'database', '2025-12-09 01:02:32', '2025-12-09 01:02:32'),
	(47, 9, 'Programming Language', 'programming-language', '2025-12-09 01:02:50', '2025-12-09 01:02:50'),
	(48, 9, 'Software Testing', 'software-testing', '2025-12-09 01:03:12', '2025-12-09 01:03:12'),
	(49, 9, 'Ecommerce', 'ecommerce', '2025-12-09 01:03:33', '2025-12-09 01:03:33');

-- Dumping structure for table edupress.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('user','instructor','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `commission_rate` int NOT NULL DEFAULT '40',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `bio` longtext COLLATE utf8mb4_unicode_ci,
  `day` int DEFAULT NULL,
  `month` int DEFAULT NULL,
  `year` int DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fixed_salary` decimal(15,2) NOT NULL DEFAULT '0.00',
  `hourly_rate` decimal(15,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.users: ~6 rows (approximately)
INSERT INTO `users` (`id`, `first_name`, `last_name`, `name`, `email`, `email_verified_at`, `password`, `photo`, `phone`, `address`, `role`, `commission_rate`, `status`, `bio`, `day`, `month`, `year`, `city`, `country`, `experience`, `gender`, `remember_token`, `created_at`, `updated_at`, `bank_name`, `bank_account_number`, `bank_account_name`, `fixed_salary`, `hourly_rate`) VALUES
	(1, NULL, NULL, 'Admin User', 'admin@gmail.com', '2025-12-08 06:47:32', '$2y$12$dniFe6wcUzT9ahxr74f5QuH6RHukB7DH.QPUEMC.W6SidTO7lwB2W', 'uploads/user/1765205159_6936e4a7298bc.png', '123456789', 'Nghệ An', 'admin', 40, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-08 06:47:32', '2025-12-08 07:45:59', NULL, NULL, NULL, 0.00, 0.00),
	(2, NULL, NULL, 'Instructor User', 'instructor@gmail.com', '2025-12-08 06:47:32', '$2y$12$R25bvMeOwPSxZJfUjkbJwuG.xTYW5qPkNGkGXY4gk94hcbR27ovZ.', 'uploads/user/1765339051_6938efab26c0c.png', '987654321', 'Hà Nội', 'instructor', 40, '1', 'Là một chuyên gia trong lĩnh vực Công nghệ Thông tin, sở hữu bằng Tiến sĩ Khoa học Máy tính từ Đại học Quốc gia Kiev, Ukraina. Với hơn 20 năm kinh nghiệm giảng dạy tại các trường đại học danh tiếng ở TP. HCM.\r\nLà một giảng viên giàu kinh nghiệm, còn là một nhà nghiên cứu khoa học. Nhiều bài báo trên các tạp chí uy tín và tham gia biên soạn giáo trình giảng dạy. Nền tảng kiến thức chuyên môn vững chắc trong lĩnh vực Công nghệ Thông tin và hiện đang giảng dạy nhiều môn học quan trọng như: Toán rời rạc, Cấu trúc dữ liệu và giải thuật, Lý thuyết đồ thị và Bảo mật thông tin.', NULL, NULL, NULL, NULL, NULL, 'Web Development', 'male', NULL, '2025-12-08 06:47:32', '2025-12-26 02:27:00', 'Vietcombank', '0123456789', 'NGUYEN VAN A', 8000000.00, 0.00),
	(3, NULL, NULL, 'Regular User', 'user@gmail.com', '2025-12-08 06:47:32', '$2y$12$19WUHtyfFQa7gENiB9tHjuZ4UI81W1d3polXSz0nvjruzRvflUARG', NULL, '111222333', 'Đà Nẵng', 'user', 40, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-08 06:47:32', '2025-12-08 06:47:32', NULL, NULL, NULL, 0.00, 0.00),
	(5, 'Phạm Thị', NULL, 'Phương Thảo', 'pp6686336@gmail.com', NULL, '$2y$12$BtRT6tfT3ytedCFwqtsC6ewct5TIWx3WAuh/KfZjhR4QTxe9VvNLq', 'uploads/user/1765692018_693e5272a59e7.jpg', '35895709643', 'Nghệ An', 'user', 40, '1', 'cẹhirehcruhvcru9v94v', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-13 22:36:44', '2025-12-14 02:15:27', NULL, NULL, NULL, 0.00, 0.00),
	(6, NULL, NULL, 'Lê Hòa', 'hoa@gmail.com', NULL, '$2y$12$yE.q5f5Pl3c76ylOWXEycuMVPko930M0WLAxr1FQ29uWc549xqPFO', NULL, NULL, NULL, 'instructor', 40, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 03:07:06', '2025-12-16 03:43:35', NULL, NULL, NULL, 0.00, 0.00),
	(7, NULL, NULL, 'Võ Phương Oanh', 'phuongoanh@gmail.com', NULL, '$2y$12$VujafjaR84WlprT6DJ3AEuSuwt9jSANSX88RhBZJyplcjV4bpbE3.', NULL, '954865784', 'Đà Nẵng', 'instructor', 40, '1', 'Là một nhà thiết kế thời trang, cố vấn thời trang, stylist trong nước và quốc tế. Với sự tài năng và sáng tạo', NULL, NULL, NULL, NULL, NULL, 'Design', 'male', NULL, '2025-12-23 10:03:13', '2025-12-23 10:08:11', NULL, NULL, NULL, 0.00, 0.00);

-- Dumping structure for table edupress.user_course_progresses
CREATE TABLE IF NOT EXISTS `user_course_progresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.user_course_progresses: ~0 rows (approximately)

-- Dumping structure for table edupress.user_course_results
CREATE TABLE IF NOT EXISTS `user_course_results` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.user_course_results: ~0 rows (approximately)

-- Dumping structure for table edupress.wishlists
CREATE TABLE IF NOT EXISTS `wishlists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wishlists_user_id_foreign` (`user_id`),
  KEY `wishlists_course_id_foreign` (`course_id`),
  CONSTRAINT `wishlists_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.wishlists: ~0 rows (approximately)
INSERT INTO `wishlists` (`id`, `user_id`, `course_id`, `created_at`, `updated_at`) VALUES
	(3, 5, 3, '2025-12-14 19:10:23', '2025-12-14 19:10:23'),
	(4, 5, 2, '2025-12-18 10:36:50', '2025-12-18 10:36:50'),
	(5, 5, 1, '2025-12-26 21:58:25', '2025-12-26 21:58:25');

-- Dumping structure for table edupress.withdrawals
CREATE TABLE IF NOT EXISTS `withdrawals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `instructor_id` bigint unsigned NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `bank_info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `withdrawals_instructor_id_foreign` (`instructor_id`),
  CONSTRAINT `withdrawals_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edupress.withdrawals: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
