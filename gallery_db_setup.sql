-- ============================================================
--  Colonel's Sainik Vidyalaya — Gallery Database Setup
--  Run this in phpMyAdmin > SQL tab
--  Database: csv_school  (change to match your DB name)
-- ============================================================

-- 1. Create database (skip if already exists)
CREATE DATABASE IF NOT EXISTS `csv_school`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `csv_school`;

-- 2. Gallery images table
CREATE TABLE IF NOT EXISTS `gallery_images` (
  `id`           INT(11)       NOT NULL AUTO_INCREMENT,
  `filename`     VARCHAR(255)  NOT NULL COMMENT 'Stored filename on server',
  `original_name`VARCHAR(255)  NOT NULL COMMENT 'Original uploaded filename',
  `caption`      VARCHAR(255)  NOT NULL DEFAULT '' COMMENT 'Image caption/title',
  `category`     VARCHAR(100)  NOT NULL DEFAULT 'Campus' COMMENT 'Gallery category',
  `sort_order`   INT(11)       NOT NULL DEFAULT 0 COMMENT 'Display order (lower = first)',
  `is_active`    TINYINT(1)    NOT NULL DEFAULT 1 COMMENT '1=visible, 0=hidden',
  `file_size`    INT(11)       NOT NULL DEFAULT 0 COMMENT 'File size in bytes',
  `mime_type`    VARCHAR(100)  NOT NULL DEFAULT '' COMMENT 'image/jpeg etc.',
  `uploaded_at`  TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`   TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_category`  (`category`),
  KEY `idx_active`    (`is_active`),
  KEY `idx_sort`      (`sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Admin users table
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id`           INT(11)       NOT NULL AUTO_INCREMENT,
  `username`     VARCHAR(100)  NOT NULL UNIQUE,
  `password_hash`VARCHAR(255)  NOT NULL,
  `full_name`    VARCHAR(200)  NOT NULL DEFAULT '',
  `last_login`   DATETIME      DEFAULT NULL,
  `created_at`   TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Default admin user  (password: Admin@CSV2026)
--    Change the password immediately after first login!
INSERT INTO `admin_users` (`username`, `password_hash`, `full_name`)
VALUES (
  'admin',
  '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uHpAbVGQa',  -- Admin@CSV2026
  'School Administrator'
) ON DUPLICATE KEY UPDATE `id`=`id`;

-- 5. Gallery categories reference table (optional, informational)
CREATE TABLE IF NOT EXISTS `gallery_categories` (
  `id`    INT(11)      NOT NULL AUTO_INCREMENT,
  `name`  VARCHAR(100) NOT NULL UNIQUE,
  `icon`  VARCHAR(10)  NOT NULL DEFAULT '🖼️',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `gallery_categories` (`name`, `icon`) VALUES
  ('Campus',       '🏫'),
  ('Classrooms',   '📚'),
  ('Sports',       '🏃'),
  ('Events',       '🎉'),
  ('Parade',       '🎖️'),
  ('Hostel',       '🏠'),
  ('Lab',          '🔬'),
  ('Arts',         '🎨'),
  ('Achievements', '🏆'),
  ('Others',       '📷')
ON DUPLICATE KEY UPDATE `id`=`id`;
