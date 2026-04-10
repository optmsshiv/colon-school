-- ============================================================
-- Colonel's Sainik Vidyalaya — Complete MySQL Database Schema
-- Version: 1.0  |  Created for Bluehost MySQL
-- ============================================================
-- HOW TO USE:
--   1. Log into Bluehost cPanel → MySQL Databases
--   2. Create a new database: csv_db
--   3. Create a user and assign full privileges
--   4. Open phpMyAdmin → select csv_db → click SQL tab
--   5. Paste this entire file and click Go
-- ============================================================

CREATE DATABASE IF NOT EXISTS `csv_db`
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;

USE `csv_db`;

-- ============================================================
-- TABLE 1: admin_users
-- Stores admin login credentials (hashed password)
-- Admin Panel: Login screen + Change Password panel
-- ============================================================
CREATE TABLE `admin_users` (
  `id`           INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `username`     VARCHAR(60)     NOT NULL UNIQUE,
  `password_hash`VARCHAR(255)    NOT NULL,               -- bcrypt hash
  `display_name` VARCHAR(100)    NOT NULL DEFAULT 'Administrator',
  `last_login`   DATETIME        DEFAULT NULL,
  `created_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Default admin: username=admin, password=admin123 (CHANGE THIS!)
INSERT INTO `admin_users` (`username`, `password_hash`, `display_name`)
VALUES ('admin', '$2y$12$YourHashHere', 'School Administrator');
-- NOTE: Replace the hash above by running: php -r "echo password_hash('admin123', PASSWORD_BCRYPT);"

-- ============================================================
-- TABLE 2: admin_sessions
-- Tracks active login sessions securely
-- ============================================================
CREATE TABLE `admin_sessions` (
  `id`           INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `user_id`      INT UNSIGNED    NOT NULL,
  `token`        VARCHAR(128)    NOT NULL UNIQUE,
  `ip_address`   VARCHAR(45)     DEFAULT NULL,
  `user_agent`   TEXT            DEFAULT NULL,
  `expires_at`   DATETIME        NOT NULL,
  `created_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `admin_users`(`id`) ON DELETE CASCADE,
  INDEX `idx_token` (`token`),
  INDEX `idx_expires` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- TABLE 3: school_info
-- Stores all editable school information
-- Admin Panel: School Info panel
-- ============================================================
CREATE TABLE `school_info` (
  `id`           INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `setting_key`  VARCHAR(80)     NOT NULL UNIQUE,
  `setting_value`TEXT            DEFAULT NULL,
  `updated_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP
                                 ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Default school settings (matches HTML defaults)
INSERT INTO `school_info` (`setting_key`, `setting_value`) VALUES
  ('school_name',    'Colonel\'s Sainik Vidyalaya'),
  ('tagline',        '"Cradle For Excellence"'),
  ('description',    'A premier institution blending Sainik discipline with modern CBSE education — nurturing character, academic brilliance, and leadership from Nursery to Class VIII.'),
  ('established',    '2026'),
  ('total_seats',    '500+'),
  ('founder_name',   'Dr. Anamika Kumar (W/o Col. Shishir Kumar)'),
  ('affiliation',    'CBSE, Delhi'),
  ('hero_image_url', ''),
  ('campus_title',   'Grand Campus — Madhepura, Bihar'),
  ('adm_session',    '2026–27'),
  ('adm_last_date',  'May 31, 2026');

-- ============================================================
-- TABLE 4: ticker_messages
-- Scrolling announcement bar messages
-- Admin Panel: School Info → Ticker section
-- ============================================================
CREATE TABLE `ticker_messages` (
  `id`           INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `message`      VARCHAR(255)    NOT NULL,
  `sort_order`   SMALLINT        NOT NULL DEFAULT 0,
  `is_active`    TINYINT(1)      NOT NULL DEFAULT 1,
  `created_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_active_order` (`is_active`, `sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `ticker_messages` (`message`, `sort_order`) VALUES
  ('🎖️ Admissions Open for 2026–27', 1),
  ('📚 CBSE Curriculum · Nursery to Class VIII', 2),
  ('🏠 Day Scholar · Day Boarder · Full Boarder Available', 3),
  ('⭐ Cradle For Excellence — Colonel\'s Sainik Vidyalaya, Madhepura', 4),
  ('🏆 Founding Batch 2026 — Limited Seats · Apply Now', 5);

-- ============================================================
-- TABLE 5: gallery_images
-- School photo gallery
-- Admin Panel: Gallery panel
-- ============================================================
CREATE TABLE `gallery_images` (
  `id`           INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `image_url`    TEXT            NOT NULL,
  `caption`      VARCHAR(200)    NOT NULL DEFAULT '',
  `category`     ENUM('Campus','Academics','Sports','Events','Sainik Training','Cultural')
                                 NOT NULL DEFAULT 'Campus',
  `sort_order`   SMALLINT        NOT NULL DEFAULT 0,
  `is_active`    TINYINT(1)      NOT NULL DEFAULT 1,
  `created_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_category` (`category`),
  INDEX `idx_active` (`is_active`, `sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- TABLE 6: academic_levels
-- Program levels (Pre-Primary, Primary, Upper Primary)
-- Admin Panel: Academics → Program Levels tab
-- ============================================================
CREATE TABLE `academic_levels` (
  `id`           INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `level_name`   VARCHAR(100)    NOT NULL,
  `class_range`  VARCHAR(100)    NOT NULL,
  `subjects`     TEXT            NOT NULL,               -- newline-separated list
  `sort_order`   SMALLINT        NOT NULL DEFAULT 0,
  `is_active`    TINYINT(1)      NOT NULL DEFAULT 1,
  `created_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `academic_levels` (`level_name`, `class_range`, `subjects`, `sort_order`) VALUES
  ('Pre-Primary', 'Nursery · LKG · UKG',
   'Play-Based Activity Learning\nHindi & English Language\nBasic Numeracy & Literacy\nArt, Craft & Music\nPhysical Development\nSocial & Emotional Skills', 1),
  ('Primary', 'Class I to Class V',
   'English, Hindi & Sanskrit\nMathematics (CBSE)\nEnvironmental Science\nSocial Studies & GK\nComputer Fundamentals\nPhysical Education & Art', 2),
  ('Upper Primary', 'Class VI to Class VIII',
   'English, Hindi & 3rd Language\nMathematics (Advanced CBSE)\nScience (Physics/Chem/Bio)\nSocial Science (CBSE)\nComputer Science\nMoral & Value Education', 3);

-- ============================================================
-- TABLE 7: cocurricular_activities
-- Co-curricular / extra-curricular activities
-- Admin Panel: Academics → Co-Curricular tab
-- ============================================================
CREATE TABLE `cocurricular_activities` (
  `id`           INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `icon`         VARCHAR(10)     NOT NULL DEFAULT '🎯',   -- emoji
  `activity_name`VARCHAR(100)    NOT NULL,
  `sort_order`   SMALLINT        NOT NULL DEFAULT 0,
  `is_active`    TINYINT(1)      NOT NULL DEFAULT 1,
  `created_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `cocurricular_activities` (`icon`, `activity_name`, `sort_order`) VALUES
  ('⚽', 'Sports & Athletics', 1), ('🎨', 'Fine Arts', 2),
  ('🎭', 'Drama & Elocution', 3), ('🎵', 'Music & Dance', 4),
  ('💻', 'Digital Literacy', 5), ('🎖️', 'Sainik Drill & Parade', 6),
  ('📖', 'Library & Reading Club', 7), ('🌱', 'Eco Club', 8),
  ('🔬', 'Science Club', 9), ('🗺️', 'Geography Club', 10);

-- ============================================================
-- TABLE 8: facilities
-- School facilities list
-- Admin Panel: Facilities panel
-- ============================================================
CREATE TABLE `facilities` (
  `id`           INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `icon`         VARCHAR(10)     NOT NULL DEFAULT '🏛️',
  `facility_name`VARCHAR(120)    NOT NULL,
  `description`  TEXT            NOT NULL DEFAULT '',
  `tags`         VARCHAR(255)    NOT NULL DEFAULT '',     -- comma-separated
  `sort_order`   SMALLINT        NOT NULL DEFAULT 0,
  `is_active`    TINYINT(1)      NOT NULL DEFAULT 1,
  `created_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `facilities` (`icon`, `facility_name`, `description`, `tags`, `sort_order`) VALUES
  ('🖥️', 'Smart Classrooms', 'Modern classrooms equipped with interactive whiteboards, projectors, and digital learning tools for an engaging learning environment.', 'Digital, Interactive, CBSE', 1),
  ('📚', 'Library', 'A well-stocked library with thousands of books, periodicals, and digital resources covering all academic and recreational needs.', 'Books, Research, Digital', 2),
  ('⚽', 'Sports Ground', 'Expansive sports ground supporting cricket, football, athletics, kabaddi, and other outdoor sports activities.', 'Cricket, Football, Athletics', 3),
  ('🔬', 'Science Labs', 'Fully equipped Physics, Chemistry, and Biology laboratories for hands-on experimental learning per CBSE curriculum.', 'Physics, Chemistry, Biology', 4),
  ('🏠', 'Hostel / Boarding', 'Safe, supervised residential facility with nutritious meals, study hours, and structured daily routines for boarders.', 'Residential, Meals, Supervised', 5),
  ('🎨', 'Art & Activity Room', 'Dedicated space for fine arts, crafts, music practice, and cultural activities to nurture creativity.', 'Arts, Crafts, Music', 6);

-- ============================================================
-- TABLE 9: admission_categories
-- Day Scholar / Day Boarder / Full Boarder details
-- Admin Panel: Admissions → General tab
-- ============================================================
CREATE TABLE `admission_categories` (
  `id`           INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `icon`         VARCHAR(10)     NOT NULL DEFAULT '🎓',
  `category_name`VARCHAR(80)     NOT NULL,
  `description`  TEXT            NOT NULL,
  `class_range`  VARCHAR(80)     NOT NULL,
  `sort_order`   SMALLINT        NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `admission_categories` (`icon`, `category_name`, `description`, `class_range`, `sort_order`) VALUES
  ('🏠', 'Day Scholar',  'Attends school daily from morning to evening, returns home. Full Sainik experience with academics and activities.', 'Nursery – Class VIII', 1),
  ('🌅', 'Day Boarder',  'Stays on campus through the day and evening including meals and study hours, but returns home at night.', 'Nursery – Class VIII', 2),
  ('🎖️', 'Full Boarder', 'Resides on campus 24/7 in a structured Sainik residential environment with full board and lodging.', 'Class I – Class VIII', 3);

-- ============================================================
-- TABLE 10: admission_dates
-- Key dates for admission cycle
-- Admin Panel: Admissions → Key Dates tab
-- ============================================================
CREATE TABLE `admission_dates` (
  `id`           INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `label`        VARCHAR(120)    NOT NULL,
  `date_value`   VARCHAR(80)     NOT NULL,
  `sort_order`   SMALLINT        NOT NULL DEFAULT 0,
  `created_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `admission_dates` (`label`, `date_value`, `sort_order`) VALUES
  ('Application Opens',    'April 2026', 1),
  ('Last Date to Apply',   'May 31, 2026', 2),
  ('Campus Interaction',   'June 2026', 3),
  ('Result Declaration',   'June 15, 2026', 4),
  ('Session Begins',       'July 1, 2026', 5);

-- ============================================================
-- TABLE 11: admission_documents
-- Required documents checklist
-- Admin Panel: Admissions → Documents tab
-- ============================================================
CREATE TABLE `admission_documents` (
  `id`           INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `document_name`VARCHAR(150)    NOT NULL,
  `requirement`  ENUM('Mandatory','Optional','If Applicable')
                                 NOT NULL DEFAULT 'Mandatory',
  `sort_order`   SMALLINT        NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `admission_documents` (`document_name`, `requirement`, `sort_order`) VALUES
  ('Birth Certificate',                        'Mandatory', 1),
  ('Aadhaar Card (Child)',                     'Mandatory', 2),
  ('Parent\'s ID Proof',                       'Mandatory', 3),
  ('Passport-size Photographs (4)',            'Mandatory', 4),
  ('Previous School Transfer Certificate',     'If Applicable', 5),
  ('Last Report Card / Mark Sheet',            'If Applicable', 6),
  ('Medical/Vaccination Record',               'Mandatory', 7),
  ('Address Proof',                            'Mandatory', 8),
  ('Caste Certificate',                        'If Applicable', 9);

-- ============================================================
-- TABLE 12: notices
-- School notices and circulars
-- Admin Panel: Notices panel | Public: Notices page
-- ============================================================
CREATE TABLE `notices` (
  `id`           INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `icon`         VARCHAR(10)     NOT NULL DEFAULT '📢',
  `notice_type`  ENUM('info','urgent','event','holiday','exam')
                                 NOT NULL DEFAULT 'info',
  `title`        VARCHAR(200)    NOT NULL,
  `description`  TEXT            NOT NULL,
  `notice_date`  DATE            NOT NULL,
  `is_active`    TINYINT(1)      NOT NULL DEFAULT 1,
  `created_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP
                                 ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_type_active` (`notice_type`, `is_active`),
  INDEX `idx_date` (`notice_date` DESC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `notices` (`icon`, `notice_type`, `title`, `description`, `notice_date`) VALUES
  ('🎖️', 'info',   'Admissions Open for 2026–27 Session', 'Applications are now being accepted for the 2026–27 academic session across all programs. Limited seats available.', '2026-04-01'),
  ('📅', 'event',  'Founding Day Celebration – July 1, 2026', 'The school will celebrate its Founding Day on July 1, 2026. All parents and guardians are warmly invited.', '2026-06-20'),
  ('📋', 'info',   'CBSE Affiliation Process Underway', 'The school is actively pursuing full CBSE affiliation, ensuring students receive nationally recognized education.', '2026-02-15');

-- ============================================================
-- TABLE 13: news_events
-- News articles and event updates
-- Admin Panel: News & Events panel | Public: News section
-- ============================================================
CREATE TABLE `news_events` (
  `id`           INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `title`        VARCHAR(250)    NOT NULL,
  `category`     VARCHAR(80)     NOT NULL DEFAULT 'News',
  `description`  TEXT            NOT NULL,
  `news_date`    DATE            NOT NULL,
  `cat_color`    VARCHAR(30)     DEFAULT 'var(--navy)',
  `is_active`    TINYINT(1)      NOT NULL DEFAULT 1,
  `created_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_active_date` (`is_active`, `news_date` DESC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `news_events` (`title`, `category`, `description`, `news_date`, `cat_color`) VALUES
  ('Grand Campus Inauguration Planned for 2026', 'Milestone', 'The formal inauguration of the Colonel\'s Sainik Vidyalaya campus is planned for July 2026, marking the beginning of a new era in education in Madhepura.', '2026-03-15', 'var(--gold)'),
  ('NCC Unit to Be Established in First Year', 'Achievement', 'An NCC unit will be established in the school\'s inaugural year, giving students early access to military training and discipline.', '2026-02-20', 'var(--navy)'),
  ('CBSE Affiliation Process Actively Underway', 'Notice', 'The school is actively pursuing full CBSE affiliation, ensuring all students receive a nationally recognized education.', '2026-02-10', 'var(--gold)');

-- ============================================================
-- TABLE 14: contact_info
-- School contact details
-- Admin Panel: Contact Info panel | Used across public site
-- ============================================================
CREATE TABLE `contact_info` (
  `id`           INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `info_key`     VARCHAR(60)     NOT NULL UNIQUE,
  `info_value`   TEXT            NOT NULL DEFAULT '',
  `updated_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP
                                 ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `contact_info` (`info_key`, `info_value`) VALUES
  ('address',    'Colonel\'s Sainik Vidyalaya, Madhepura, Bihar, India'),
  ('phone',      '+91 XXXXX XXXXX'),
  ('whatsapp',   '+91 XXXXX XXXXX'),
  ('email',      'info@colonelssainikvidyalaya.in'),
  ('website',    'www.colonelssainikvidyalaya.in'),
  ('hours',      'Monday to Saturday · 9:00 AM – 4:00 PM'),
  ('map_embed',  '');

-- ============================================================
-- TABLE 15: enquiries
-- Contact form submissions from public site
-- Admin Panel: Enquiry Inbox panel
-- ============================================================
CREATE TABLE `enquiries` (
  `id`           INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `enquiry_id`   VARCHAR(20)     NOT NULL UNIQUE,        -- e.g. ENQ-123456
  `parent_name`  VARCHAR(120)    NOT NULL,
  `phone`        VARCHAR(20)     NOT NULL,
  `email`        VARCHAR(120)    DEFAULT NULL,
  `class_interested` VARCHAR(30) DEFAULT NULL,
  `admission_type`   VARCHAR(30) DEFAULT NULL,
  `message`      TEXT            DEFAULT NULL,
  `enquiry_type` VARCHAR(60)     NOT NULL DEFAULT 'General Enquiry',
  `status`       ENUM('New','In Progress','Resolved')
                                 NOT NULL DEFAULT 'New',
  `is_read`      TINYINT(1)      NOT NULL DEFAULT 0,
  `ip_address`   VARCHAR(45)     DEFAULT NULL,
  `submitted_at` DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP
                                 ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_status` (`status`),
  INDEX `idx_read` (`is_read`),
  INDEX `idx_submitted` (`submitted_at` DESC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- TABLE 16: applications
-- Online admission applications from public site
-- Admin Panel: Applications panel | Public: Apply + Track pages
-- ============================================================
CREATE TABLE `applications` (
  `id`              INT UNSIGNED  NOT NULL AUTO_INCREMENT,
  `token`           VARCHAR(20)   NOT NULL UNIQUE,       -- e.g. CSV-2026-1042
  -- Student info
  `student_name`    VARCHAR(120)  NOT NULL,
  `date_of_birth`   DATE          DEFAULT NULL,
  `gender`          ENUM('Male','Female','Other') DEFAULT NULL,
  `class_applying`  VARCHAR(30)   NOT NULL,
  `admission_type`  ENUM('Day Scholar','Day Boarder','Full Boarder') NOT NULL,
  `prev_school`     VARCHAR(200)  DEFAULT NULL,
  `last_class`      VARCHAR(80)   DEFAULT NULL,
  -- Parent info
  `father_name`     VARCHAR(120)  NOT NULL,
  `mother_name`     VARCHAR(120)  DEFAULT NULL,
  `phone`           VARCHAR(20)   NOT NULL,
  `email`           VARCHAR(120)  DEFAULT NULL,
  `occupation`      VARCHAR(100)  DEFAULT NULL,
  `annual_income`   VARCHAR(50)   DEFAULT NULL,
  `address`         TEXT          NOT NULL,
  -- Additional
  `heard_from`      VARCHAR(80)   DEFAULT NULL,
  `special_message` TEXT          DEFAULT NULL,
  -- Status tracking
  `status`          ENUM('Pending','Under Review','Shortlisted','Rejected','Enrolled')
                                  NOT NULL DEFAULT 'Pending',
  `is_read`         TINYINT(1)    NOT NULL DEFAULT 0,
  -- Timeline JSON (stores step completion)
  `timeline`        JSON          DEFAULT NULL,
  -- Meta
  `ip_address`      VARCHAR(45)   DEFAULT NULL,
  `submitted_at`    DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`      DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP
                                  ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_token` (`token`),
  INDEX `idx_status` (`status`),
  INDEX `idx_class` (`class_applying`),
  INDEX `idx_type` (`admission_type`),
  INDEX `idx_read` (`is_read`),
  INDEX `idx_submitted` (`submitted_at` DESC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- TABLE 17: activity_log
-- Audit trail of admin actions
-- ============================================================
CREATE TABLE `activity_log` (
  `id`           INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `admin_id`     INT UNSIGNED    DEFAULT NULL,
  `action`       VARCHAR(80)     NOT NULL,               -- e.g. 'update_school_info'
  `description`  TEXT            DEFAULT NULL,
  `ip_address`   VARCHAR(45)     DEFAULT NULL,
  `created_at`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`admin_id`) REFERENCES `admin_users`(`id`) ON DELETE SET NULL,
  INDEX `idx_created` (`created_at` DESC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- SUMMARY OF TABLES
-- ============================================================
-- admin_users          → Login credentials & admin accounts
-- admin_sessions       → Secure session tokens
-- school_info          → All editable school info (key-value)
-- ticker_messages      → Scrolling announcement bar
-- gallery_images       → Photo gallery
-- academic_levels      → Program levels (Pre-Primary, Primary, etc.)
-- cocurricular_activities → Extra-curricular clubs
-- facilities           → Campus facilities
-- admission_categories → Day Scholar / Day Boarder / Full Boarder
-- admission_dates      → Key admission calendar dates
-- admission_documents  → Required documents checklist
-- notices              → School notices & circulars
-- news_events          → News articles & event updates
-- contact_info         → Address, phone, email, hours
-- enquiries            → Parent enquiry form submissions
-- applications         → Online admission applications
-- activity_log         → Admin audit trail
-- ============================================================
