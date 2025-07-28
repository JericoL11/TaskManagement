-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 28, 2025 at 12:17 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `TaskDb`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(200) DEFAULT NULL,
  `created_At` datetime DEFAULT NULL,
  `updated_At` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_id`, `dept_name`, `created_At`, `updated_At`) VALUES
(1, 'IT - APP DEV', '2025-07-24 09:34:42', '2025-07-24 11:43:26'),
(2, 'PROCUREMENT', '2025-07-24 09:37:16', '2025-07-24 11:05:11'),
(3, 'PAYROLL', '2025-07-24 10:33:26', '2025-07-25 15:04:34'),
(4, 'HR', '2025-07-24 10:49:21', '2025-07-28 11:19:55'),
(5, 'GENERAL ACCOUNTING', '2025-07-25 15:05:05', '2025-07-25 15:05:05'),
(6, 'IT SUPPORT TECHNICAL STAFF', '2025-07-28 11:28:14', '2025-07-28 11:28:21');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `emp_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `dept_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `person_id`, `created_at`, `updated_at`, `dept_id`, `user_id`) VALUES
(34, 4, '2025-07-25 09:54:31', '2025-07-28 11:13:51', 1, 1),
(35, 5, '2025-07-25 09:54:35', '2025-07-25 13:15:18', 1, 1),
(36, 6, '2025-07-25 09:54:39', '2025-07-25 09:54:39', 1, 2),
(38, 8, '2025-07-25 11:17:40', '2025-07-28 11:17:47', 3, 1),
(39, 9, '2025-07-28 11:27:30', '2025-07-28 11:28:34', 6, 1),
(40, 10, '2025-07-28 11:35:52', '2025-07-28 11:35:52', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('jecoylabs@gmail.com', '117743', '2025-07-28 02:02:47'),
('printchoice11@gmail.com', '474567', '2025-07-28 01:38:53');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
CREATE TABLE `person` (
  `person_id` int(11) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `middleName` varchar(255) DEFAULT NULL,
  `birthDate` datetime DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contactNo` varchar(20) DEFAULT NULL,
  `created_At` datetime DEFAULT NULL,
  `updated_At` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`person_id`, `firstName`, `lastName`, `middleName`, `birthDate`, `address`, `contactNo`, `created_At`, `updated_At`, `is_deleted`) VALUES
(1, 'batman', 'Martinez', 'Labajo', '2001-11-01 00:00:00', 'Talisay', '09123213123', '2025-07-25 09:44:15', '2025-07-25 09:51:19', 1),
(2, 'Superman', 'Martinez', 'Labajo', '2001-11-01 00:00:00', 'Talisay', '09123213123', '2025-07-25 09:44:26', '2025-07-25 09:51:15', 1),
(3, 'Ironman', 'Martinez', 'Labajo', '2001-11-01 00:00:00', 'Talisay', '09123213123', '2025-07-25 09:44:30', '2025-07-25 09:44:38', 1),
(4, 'Iron', 'Martinez', 'Labajo', '2001-11-01 00:00:00', 'Talisay', '09123213123', '2025-07-25 09:54:31', '2025-07-28 11:13:51', 0),
(5, 'Mike', 'Martinez', 'Labajo', '2001-11-01 00:00:00', 'Talisay', '09123213123', '2025-07-25 09:54:35', '2025-07-25 13:15:18', 0),
(6, 'Jvr', 'Martinez', 'Labajo', '2001-11-01 00:00:00', 'Talisay', '09123213123', '2025-07-25 09:54:39', '2025-07-25 09:54:39', 0),
(7, 'Felix', 'Doe', 'T.', '1998-06-18 00:00:00', 'Cebu City', '09888777766', '2025-07-25 11:14:53', '2025-07-25 11:16:43', 1),
(8, 'Test', 'Tests', 'T.', '2016-05-31 00:00:00', 'Cebu City', '09123231313', '2025-07-25 11:17:40', '2025-07-28 11:17:47', 0),
(9, 'Lyndon', 'Ramirez', NULL, '2004-02-19 00:00:00', 'Bulacao Cebu City', '09123123321', '2025-07-28 11:27:30', '2025-07-28 11:28:34', 0),
(10, 'Jerico', 'Labajo', NULL, '2001-01-11 00:00:00', 'talisay', '09123213313', '2025-07-28 11:35:52', '2025-07-28 11:35:52', 0),
(11, 'jerico', 'labajo', NULL, '2001-01-11 00:00:00', 'Tangke', '09123131231', '2025-07-28 09:40:03', '2025-07-28 09:40:03', NULL),
(14, 'Jericoy', 'Labajo', NULL, '2001-01-11 00:00:00', 'tangke', '09123213321', '2025-07-28 09:52:22', '2025-07-28 09:52:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
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
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `dueDate` datetime DEFAULT NULL,
  `created_At` datetime DEFAULT NULL,
  `updated_At` datetime DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `status` varchar(150) DEFAULT NULL,
  `completed_At` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `name`, `description`, `dueDate`, `created_At`, `updated_At`, `emp_id`, `status`, `completed_At`) VALUES
(16, 'Graphic Artists', 'Bday tarp lAYOUT', '2025-08-01 00:00:00', '2025-07-25 11:19:21', '2025-07-25 11:19:46', 34, 'Complete', '2025-07-25 14:58:38'),
(17, 'Edit Dashboard', 'Urgent', '2025-07-25 00:00:00', '2025-07-25 11:29:17', '2025-07-25 14:47:09', 35, 'Complete', '2025-07-25 14:58:38'),
(19, 'Edit token', 'Add token beared each controllers', '2025-07-25 00:00:00', '2025-07-25 15:01:55', '2025-07-25 15:02:08', 35, 'Complete', '2025-07-25 15:02:08'),
(20, 'Bios problem - laptop 241', 'Cnage bios battery', '2025-07-29 00:00:00', '2025-07-28 11:29:52', '2025-07-28 11:39:40', 39, 'Complete', '2025-07-28 11:39:40'),
(21, 'Forgot Password Login', 'Send code via gmail', '2025-07-28 00:00:00', '2025-07-28 11:36:39', '2025-07-28 11:36:39', 40, 'in-progress', NULL),
(22, 'Carwash', 'Hugasa motor ni jerico', '2025-07-29 00:00:00', '2025-07-28 11:41:34', '2025-07-28 12:52:25', 35, 'Complete', '2025-07-28 12:52:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `person_id` int(11) DEFAULT NULL,
  `created_At` datetime DEFAULT NULL,
  `updated_At` datetime DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `person_id`, `created_At`, `updated_At`, `email`) VALUES
(1, 'admin', '$2y$10$BglmV6YZ8wtK1Yh9u78t5eL9rYenW3.k4cG89UUZYDHoL6R4vL5Gi', 4, '2025-07-24 06:07:30', '2025-07-28 09:32:17', 'printchoice11@gmail.com'),
(2, 'sample', '$2y$10$v4f3dREJQPL9158yE9ufJO2xztSxikhykhns8Dvj.Q1011mQQQKKm', 7, '2025-07-24 06:12:13', '2025-07-24 06:12:13', NULL),
(3, 'jerico11', '$2y$10$7AJ.M7qMtqwFciV4s1EmGuYVh/7h1mv/9PINNqp7tmXYIGvGqaFd2', 11, '2025-07-28 09:40:03', '2025-07-28 09:40:03', NULL),
(6, 'jerico', '$2y$10$YTo5WD4yuVOGDxJCEZ0I1ONIASMZyKO1anPPsZn8gNOudw0UTGc0q', 14, '2025-07-28 09:52:22', '2025-07-28 09:54:23', 'jecoylabs@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `person_id` (`person_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `person_id` (`person_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`),
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `employees_ibfk_3` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`dept_id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `emp_id` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
