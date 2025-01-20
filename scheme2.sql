-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for youdemy
CREATE DATABASE IF NOT EXISTS `youdemy` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `youdemy`;

-- Dumping structure for table youdemy.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table youdemy.categories: ~3 rows (approximately)
INSERT IGNORE INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'test', 'dhdddddd', '2025-01-15 14:09:42', '2025-01-15 14:09:42'),
	(2, 'test2', 'gshgshdghsgh', '2025-01-20 09:29:27', '2025-01-20 09:29:29'),
	(4, 'testttt', NULL, '2025-01-20 09:56:50', '2025-01-20 09:56:50');

-- Dumping structure for table youdemy.courses
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `teacher_id` int NOT NULL,
  `category_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `TYPE` enum('document','video') NOT NULL,
  `link` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `teacher_id` (`teacher_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`),
  CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table youdemy.courses: ~71 rows (approximately)
INSERT IGNORE INTO `courses` (`id`, `title`, `description`, `teacher_id`, `category_id`, `created_at`, `updated_at`, `TYPE`, `link`) VALUES
	(1, 'testttts', 'rrrrrrr', 1, 2, '2025-01-15 14:10:30', '2025-01-20 09:32:54', 'document', ''),
	(2, 'Introduction to Programming', 'Learn the basics of programming.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(3, 'Advanced Mathematics', 'Deep dive into advanced mathematical concepts.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(4, 'Data Structures and Algorithms', 'Master the fundamentals of data structures and algorithms.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(5, 'Web Development Basics', 'Get started with web development.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(6, 'Database Management', 'Learn how to manage and query databases.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(7, 'Machine Learning Fundamentals', 'Introduction to machine learning concepts.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(8, 'Software Engineering Principles', 'Learn the principles of software engineering.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(9, 'Mobile App Development', 'Build mobile apps for iOS and Android.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(10, 'Cloud Computing Basics', 'Understand the basics of cloud computing.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(11, 'Cybersecurity Essentials', 'Learn the basics of cybersecurity.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(12, 'Artificial Intelligence Basics', 'Introduction to AI concepts.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(13, 'DevOps Fundamentals', 'Learn the basics of DevOps.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(14, 'UI/UX Design Principles', 'Master the principles of UI/UX design.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(15, 'Blockchain Technology', 'Introduction to blockchain and cryptocurrencies.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(16, 'Game Development Basics', 'Get started with game development.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(17, 'Python Programming', 'Learn Python from scratch.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(18, 'Java Programming', 'Master the basics of Java programming.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(19, 'C++ Programming', 'Learn C++ programming fundamentals.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(20, 'React.js Fundamentals', 'Learn the basics of React.js.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(21, 'Node.js Basics', 'Introduction to Node.js and backend development.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(22, 'Angular Framework', 'Learn the basics of Angular.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(23, 'Vue.js Fundamentals', 'Introduction to Vue.js.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(24, 'Data Science Basics', 'Introduction to data science.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(25, 'Big Data Technologies', 'Learn about big data tools.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(26, 'Linux System Administration', 'Master Linux system administration.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(27, 'Networking Fundamentals', 'Learn the basics of computer networking.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(28, 'Ethical Hacking', 'Introduction to ethical hacking.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(29, 'Digital Marketing Basics', 'Learn the fundamentals of digital marketing.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(31, 'Business Analytics', 'Introduction to business analytics.', 1, 1, '2025-01-16 10:26:55', '2025-01-16 10:26:55', 'document', ''),
	(37, 'Esse eum aliquip qui', 'Facere enim voluptas', 1, 1, '2025-01-16 21:56:13', '2025-01-16 21:56:13', 'document', ''),
	(38, 'Numquam itaque eveni', 'Aut ut dolorem autem', 1, 1, '2025-01-18 16:07:08', '2025-01-18 16:07:08', 'document', 'https://www.zujeninawitol.com.au'),
	(39, 'Numquam itaque eveni', 'Aut ut dolorem autem', 1, 1, '2025-01-18 16:07:27', '2025-01-18 16:07:27', 'document', 'https://www.zujeninawitol.com.au'),
	(40, 'Numquam itaque eveni', 'Aut ut dolorem autem', 1, 1, '2025-01-18 16:07:47', '2025-01-18 16:07:47', 'document', 'https://www.zujeninawitol.com.au'),
	(41, 'Numquam itaque eveni', 'Aut ut dolorem autem', 1, 1, '2025-01-18 16:10:06', '2025-01-18 16:10:06', 'document', 'https://www.zujeninawitol.com.au'),
	(42, 'Numquam itaque eveni', 'Aut ut dolorem autem', 1, 1, '2025-01-18 16:10:32', '2025-01-18 16:10:32', 'document', 'https://www.zujeninawitol.com.au'),
	(43, 'Numquam itaque eveni', 'Aut ut dolorem autem', 1, 1, '2025-01-18 16:10:45', '2025-01-18 16:10:45', 'document', 'https://www.zujeninawitol.com.au'),
	(44, 'Numquam itaque eveni', 'Aut ut dolorem autem', 1, 1, '2025-01-18 16:10:51', '2025-01-18 16:10:51', 'document', 'https://www.zujeninawitol.com.au'),
	(45, 'Numquam itaque eveni', 'Aut ut dolorem autem', 1, 1, '2025-01-18 16:10:53', '2025-01-18 16:10:53', 'document', 'https://www.zujeninawitol.com.au'),
	(46, 'Numquam itaque eveni', 'Aut ut dolorem autem', 1, 1, '2025-01-18 16:11:01', '2025-01-18 16:11:01', 'document', 'https://www.zujeninawitol.com.au'),
	(47, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 16:11:10', '2025-01-18 16:11:10', 'document', 'https://www.zujeninawitol.com.a'),
	(48, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 16:11:22', '2025-01-18 16:11:22', 'document', 'https://www.zujeninawitol.com.a'),
	(49, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 16:11:23', '2025-01-18 16:11:23', 'document', 'https://www.zujeninawitol.com.a'),
	(50, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 16:11:25', '2025-01-18 16:11:25', 'document', 'https://www.zujeninawitol.com.a'),
	(51, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 16:40:35', '2025-01-18 16:40:35', 'document', 'https://www.zujeninawitol.com.a'),
	(52, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 16:42:24', '2025-01-18 16:42:24', 'document', '/uploads/678bcbe0838c2_Profile (1).pdf'),
	(53, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 16:51:26', '2025-01-18 16:51:26', 'document', '/uploads/678bcdfe6619e_Profile (1).pdf'),
	(54, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 16:51:52', '2025-01-18 16:51:52', 'document', '/uploads/678bce184a341_Profile (1).pdf'),
	(55, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 16:52:21', '2025-01-18 16:52:21', 'document', '/uploads/678bce350fd62_Profile (1).pdf'),
	(56, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 16:54:42', '2025-01-18 16:54:42', 'document', '/uploads/678bcec26933c_Profile (1).pdf'),
	(57, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 16:55:38', '2025-01-18 16:55:38', 'document', '/uploads/678bcefa5eec2_Profile (1).pdf'),
	(58, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 16:56:21', '2025-01-18 16:56:21', 'document', '/uploads/678bcf2565664_Profile (1).pdf'),
	(59, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 16:59:14', '2025-01-18 16:59:14', 'document', '/uploads/678bcfd29bc22_Profile (1).pdf'),
	(60, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 16:59:43', '2025-01-18 16:59:43', 'document', '/uploads/678bcfef53550_Profile (1).pdf'),
	(61, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 17:01:27', '2025-01-18 17:01:27', 'document', '/uploads/678bd05752fc6_Profile (1).pdf'),
	(62, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 17:01:44', '2025-01-18 17:01:44', 'document', '/uploads/678bd068e64be_Profile (1).pdf'),
	(63, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 17:23:14', '2025-01-18 17:23:14', 'document', '/uploads/678bd57255130_Profile (1).pdf'),
	(64, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 17:24:49', '2025-01-18 17:24:49', 'document', '/uploads/678bd5d15c6be_Profile (1).pdf'),
	(65, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 17:25:12', '2025-01-18 17:25:12', 'document', '/uploads/678bd5e8732e2_Profile (1).pdf'),
	(66, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 17:25:45', '2025-01-18 17:25:45', 'document', '/uploads/678bd60954621_Profile (1).pdf'),
	(67, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 23:26:35', '2025-01-18 23:26:35', 'document', '/uploads/678c2a9ba15a2_Profile (1).pdf'),
	(68, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 23:27:31', '2025-01-18 23:27:31', 'document', '/uploads/678c2ad3396d2_Profile (1).pdf'),
	(69, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 23:28:07', '2025-01-18 23:28:07', 'document', '/uploads/678c2af7a9bba_Profile (1).pdf'),
	(70, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 23:28:13', '2025-01-18 23:28:13', 'document', '/uploads/678c2afd33697_Profile (1).pdf'),
	(71, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 23:29:00', '2025-01-18 23:29:00', 'document', '/uploads/678c2b2c65dc5_Profile (1).pdf'),
	(72, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 23:29:48', '2025-01-18 23:29:48', 'document', '/uploads/678c2b5c18a34_Profile (1).pdf'),
	(73, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 23:30:07', '2025-01-18 23:30:07', 'document', '/uploads/678c2b6f1b489_Profile (1).pdf'),
	(74, 'Numquam itaque even', 'Aut ut dolorem atem', 1, 1, '2025-01-18 23:30:09', '2025-01-18 23:30:09', 'document', '/uploads/678c2b71a2e2a_Profile (1).pdf'),
	(75, 'Labore veniam sed s', 'Corrupti dolores si', 1, 1, '2025-01-19 00:02:06', '2025-01-19 00:02:06', 'document', 'https://www.cetabitilin.us'),
	(76, 'Labore veniam sed s', 'Corrupti dolores si', 1, 1, '2025-01-19 01:01:02', '2025-01-19 01:01:02', 'document', 'https://www.cetabitilin.us'),
	(77, 'Labore veniam sed s', 'Corrupti dolores si', 1, 1, '2025-01-19 01:03:33', '2025-01-19 01:03:33', 'document', 'https://www.cetabitilin.us');

-- Dumping structure for table youdemy.coursetags
CREATE TABLE IF NOT EXISTS `coursetags` (
  `tag_id` int NOT NULL,
  `course_id` int NOT NULL,
  KEY `tag_id` (`tag_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `coursetags_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`),
  CONSTRAINT `coursetags_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table youdemy.coursetags: ~2 rows (approximately)
INSERT IGNORE INTO `coursetags` (`tag_id`, `course_id`) VALUES
	(1, 3),
	(1, 37),
	(1, 38),
	(1, 39),
	(1, 40),
	(1, 41),
	(1, 42),
	(1, 43),
	(1, 44),
	(1, 45),
	(1, 46),
	(1, 47),
	(1, 48),
	(1, 49),
	(1, 50),
	(1, 51),
	(1, 52),
	(1, 53),
	(1, 54),
	(1, 55),
	(1, 56),
	(1, 57),
	(1, 58),
	(1, 59),
	(1, 60),
	(1, 61),
	(1, 62),
	(1, 63),
	(1, 64),
	(1, 65),
	(1, 66),
	(1, 67),
	(1, 68),
	(1, 69),
	(1, 70),
	(1, 71),
	(1, 72),
	(1, 73),
	(1, 74),
	(1, 75),
	(1, 76),
	(1, 77);

-- Dumping structure for table youdemy.enrolments
CREATE TABLE IF NOT EXISTS `enrolments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` int NOT NULL,
  `course_id` int NOT NULL,
  `enrolled_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `enrolments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`),
  CONSTRAINT `enrolments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table youdemy.enrolments: ~1 rows (approximately)
INSERT IGNORE INTO `enrolments` (`id`, `student_id`, `course_id`, `enrolled_at`) VALUES
	(1, 7, 77, '2025-01-19 15:07:55');

-- Dumping structure for table youdemy.tags
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table youdemy.tags: ~2 rows (approximately)
INSERT IGNORE INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'tag1', '2025-01-16 11:11:55', '2025-01-16 11:11:56'),
	(3, 'shshsghs', '2025-01-20 09:56:54', '2025-01-20 09:56:54'),
	(4, 'sjqjq', '2025-01-20 09:56:58', '2025-01-20 09:56:58'),
	(5, 'sjsjs', '2025-01-20 09:56:58', '2025-01-20 09:56:58');

-- Dumping structure for table youdemy.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin','student','teacher') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('active','inactive','banned') DEFAULT 'active',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table youdemy.users: ~2 rows (approximately)
INSERT IGNORE INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`, `status`) VALUES
	(1, 'Abdel Droid', 'admin@gmail.com', '$2y$10$ksx943uaFp5tuK4N1BM22ukawG2k6bWevs6Z4fdHVWwHq1jvOHIJK', 'teacher', '2025-01-14 15:07:51', '2025-01-20 10:03:04', 'active'),
	(7, 'Ria Brennan', 'guzewe@mailinator.com', '$2y$10$KdG0roEygkZJ8fDlNlTDne.LxovrHhmxLJ36s2v663VQZcc4y7Vzi', 'student', '2025-01-14 17:25:51', '2025-01-19 15:07:27', 'active');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
