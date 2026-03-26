-- ============================================================
-- Training Management System - Full Database Schema & Seed Data
-- Compatible with: MySQL 5.7+ / MariaDB 10.3+
-- Usage: Import via phpMyAdmin or run: mysql -u root -p < tms_database.sql
-- ============================================================

CREATE DATABASE IF NOT EXISTS `tms_database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `tms_database`;

-- ============================================================
-- TABLE: users
-- ============================================================
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','trainer','trainee') NOT NULL DEFAULT 'trainee',
  `profile_photo` varchar(255) NULL DEFAULT NULL,
  `phone` varchar(20) NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: training_sessions
-- ============================================================
CREATE TABLE `training_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NULL,
  `trainer_id` bigint(20) UNSIGNED NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `location` varchar(255) NULL DEFAULT NULL,
  `max_trainees` int(11) NOT NULL DEFAULT 30,
  `status` enum('upcoming','active','completed','cancelled') NOT NULL DEFAULT 'upcoming',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`trainer_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: session_enrollments
-- ============================================================
CREATE TABLE `session_enrollments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `trainee_id` bigint(20) UNSIGNED NOT NULL,
  `enrolled_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('enrolled','completed','dropped') NOT NULL DEFAULT 'enrolled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_enrollment` (`session_id`, `trainee_id`),
  FOREIGN KEY (`session_id`) REFERENCES `training_sessions`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`trainee_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: session_materials (uploads by trainer)
-- ============================================================
CREATE TABLE `session_materials` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `uploaded_by` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NULL,
  `file_path` varchar(500) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL,
  `file_size` bigint(20) NOT NULL DEFAULT 0,
  `material_type` enum('document','image','video','audio','other') NOT NULL DEFAULT 'document',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`session_id`) REFERENCES `training_sessions`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`uploaded_by`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: reports
-- ============================================================
CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `type` enum('users','sessions','enrollments','materials','summary') NOT NULL DEFAULT 'summary',
  `generated_by` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(500) NULL DEFAULT NULL,
  `parameters` json NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`generated_by`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: activity_logs
-- ============================================================
CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NULL,
  `action` varchar(255) NOT NULL,
  `description` text NULL,
  `ip_address` varchar(45) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- SEED DATA: Users (passwords are bcrypt of "password123")
-- ============================================================
INSERT INTO `users` (`name`, `email`, `password`, `role`, `phone`, `is_active`, `created_at`, `updated_at`) VALUES
('Super Admin',    'admin@tms.com',    '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin',   '+237600000001', 1, NOW(), NOW()),
('Alice Trainer',  'trainer1@tms.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'trainer', '+237600000002', 1, NOW(), NOW()),
('Bob Trainer',    'trainer2@tms.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'trainer', '+237600000003', 1, NOW(), NOW()),
('Carol Trainee',  'trainee1@tms.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'trainee', '+237600000004', 1, NOW(), NOW()),
('David Trainee',  'trainee2@tms.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'trainee', '+237600000005', 1, NOW(), NOW()),
('Eve Trainee',    'trainee3@tms.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'trainee', '+237600000006', 1, NOW(), NOW());

-- ============================================================
-- SEED DATA: Training Sessions
-- ============================================================
INSERT INTO `training_sessions` (`title`, `description`, `trainer_id`, `start_date`, `end_date`, `location`, `max_trainees`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
('Laravel Web Development', 'Full course on Laravel framework from basics to advanced REST APIs.', 2, '2025-04-01', '2025-04-30', 'Room A - Douala HQ', 20, 'active',   1, NOW(), NOW()),
('PHP OOP Fundamentals',    'Object-Oriented Programming with PHP for beginners.',               3, '2025-05-01', '2025-05-15', 'Online - Zoom',       25, 'upcoming', 1, NOW(), NOW()),
('Database Design',         'MySQL and relational database design principles.',                  2, '2025-03-01', '2025-03-20', 'Room B - Douala HQ',  15, 'completed',1, NOW(), NOW());

-- ============================================================
-- SEED DATA: Enrollments
-- ============================================================
INSERT INTO `session_enrollments` (`session_id`, `trainee_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'enrolled',  NOW(), NOW()),
(1, 5, 'enrolled',  NOW(), NOW()),
(2, 4, 'enrolled',  NOW(), NOW()),
(3, 5, 'completed', NOW(), NOW()),
(3, 6, 'completed', NOW(), NOW());

-- ============================================================
-- USEFUL VIEWS for reporting
-- ============================================================
CREATE OR REPLACE VIEW `v_session_summary` AS
SELECT
  ts.id,
  ts.title,
  ts.status,
  ts.start_date,
  ts.end_date,
  u.name AS trainer_name,
  COUNT(se.id) AS enrolled_count,
  ts.max_trainees
FROM training_sessions ts
LEFT JOIN users u ON ts.trainer_id = u.id
LEFT JOIN session_enrollments se ON ts.id = se.session_id
GROUP BY ts.id;

CREATE OR REPLACE VIEW `v_user_summary` AS
SELECT
  role,
  COUNT(*) AS total,
  SUM(is_active) AS active_count
FROM users
GROUP BY role;
