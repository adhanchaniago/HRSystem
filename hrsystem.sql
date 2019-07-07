-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2019 at 07:46 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE `applicant` (
  `applicant_id` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_id` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recruiter_id` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `applied_date` date NOT NULL,
  `current_step` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`applicant_id`, `job_id`, `user_id`, `recruiter_id`, `applied_date`, `current_step`, `status`, `created_at`, `updated_at`) VALUES
('APL0001', 'JOB0001', 'USR0002', 'USR0001', '2019-07-02', 'final', 'accepted', '2019-07-02 11:27:31', '2019-07-04 20:41:26'),
('APL0002', 'JOB0001', 'USR0005', NULL, '2019-07-02', 'final', 'accepted', '2019-07-02 11:32:56', '2019-07-04 20:45:43'),
('APL0003', 'JOB0001', 'USR0003', 'USR0001', '2019-07-03', 'final', 'accepted', '2019-07-03 00:42:43', '2019-07-05 09:24:49'),
('APL0004', 'JOB0002', 'USR0002', NULL, '2019-07-06', 'final', 'waiting', '2019-07-05 19:47:27', '2019-07-06 11:19:47'),
('APL0005', 'JOB0002', 'USR0003', NULL, '2019-07-06', 'final', 'accepted', '2019-07-05 19:47:27', '2019-07-06 20:40:43'),
('APL0006', 'JOB0002', 'USR0004', NULL, '2019-07-06', 'technical_test', 'waiting', '2019-07-05 19:47:27', '2019-07-05 14:52:22'),
('APL0007', 'JOB0002', 'USR0005', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27'),
('APL0008', 'JOB0002', 'USR0006', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27'),
('APL0009', 'JOB0002', 'USR0007', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27'),
('APL0010', 'JOB0002', 'USR0008', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27'),
('APL0011', 'JOB0002', 'USR0009', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27'),
('APL0012', 'JOB0002', 'USR0010', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27'),
('APL0013', 'JOB0002', 'USR0011', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27'),
('APL0014', 'JOB0002', 'USR0012', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27'),
('APL0015', 'JOB0002', 'USR0013', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27'),
('APL0016', 'JOB0002', 'USR0014', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27'),
('APL0017', 'JOB0002', 'USR0015', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27'),
('APL0018', 'JOB0002', 'USR0016', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27'),
('APL0019', 'JOB0002', 'USR0017', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27'),
('APL0020', 'JOB0002', 'USR0018', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27'),
('APL0021', 'JOB0002', 'USR0019', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27'),
('APL0022', 'JOB0002', 'USR0020', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27'),
('APL0023', 'JOB0002', 'USR0021', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27'),
('APL0024', 'JOB0002', 'USR0022', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27'),
('APL0025', 'JOB0002', 'USR0023', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27'),
('APL0026', 'JOB0002', 'USR0024', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27'),
('APL0027', 'JOB0002', 'USR0025', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27'),
('APL0028', 'JOB0002', 'USR0026', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27'),
('APL0029', 'JOB0002', 'USR0027', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27'),
('APL0030', 'JOB0002', 'USR0028', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27'),
('APL0031', 'JOB0002', 'USR0029', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27'),
('APL0032', 'JOB0002', 'USR0030', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27'),
('APL0033', 'JOB0002', 'USR0031', NULL, '2019-07-06', 'apply', 'waiting', '2019-07-05 19:47:27', '2019-07-05 19:47:27');

-- --------------------------------------------------------

--
-- Table structure for table `application_progress`
--

CREATE TABLE `application_progress` (
  `application_progress_id` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_id` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `progress_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `application_progress`
--

INSERT INTO `application_progress` (`application_progress_id`, `job_id`, `progress_name`, `sequence`, `created_at`, `updated_at`) VALUES
('APR0001', 'JOB0001', 'Initial Test', 1, '2019-07-02 11:22:21', '2019-07-02 11:22:21'),
('APR0003', 'JOB0002', 'Initial Test', 1, '2019-07-03 12:17:30', '2019-07-03 12:17:30'),
('APR0004', 'JOB0001', 'Psychotest', 3, '2019-07-04 21:07:38', '2019-07-04 21:07:38'),
('APR0005', 'JOB0003', 'Initial Test', 1, '2019-07-05 11:28:28', '2019-07-05 11:28:28'),
('APR0006', 'JOB0004', 'Initial Test', 1, '2019-07-05 11:45:25', '2019-07-05 11:45:25');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `created_at`, `updated_at`) VALUES
('DPT0001', 'Research and Development', NULL, NULL),
('DPT0002', 'Human Resources', NULL, NULL),
('DPT0004', 'Marketing', NULL, NULL),
('DPT0005', 'Legal', NULL, NULL),
('DPT0006', 'Support', NULL, NULL),
('DPT0007', 'Services', NULL, NULL),
('DPT0008', 'IT', NULL, NULL),
('DPT0009', 'Database', '2019-07-05 11:20:14', '2019-07-05 11:20:14');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `document_id` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `regarding_id` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_type_id` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_url` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`document_id`, `regarding_id`, `document_name`, `document_type_id`, `document_url`, `created_at`, `updated_at`) VALUES
('DOC0001', 'USR0003', 'CV', 'DTY0001', '/documents/user/USR0003CV_1562248280.pdf', '2019-07-04 06:51:20', '2019-07-04 06:51:20'),
('DOC0002', 'APR0004', 'APR0004_Psychotest.jpg', 'DTY0004', '/documents/test_attachment/APR0004_Psychotest.jpg', '2019-07-04 21:07:38', '2019-07-04 21:07:38'),
('DOC0003', 'APR0001', 'APR0001_Initial_Test.png', 'DTY0004', '/documents/test_attachment/APR0001_Initial_Test.png', '2019-07-04 21:28:31', '2019-07-04 21:28:31'),
('DOC0004', 'USR0002', 'My First CV', 'DTY0001', '/documents/user/USR0002My_First_CV_1562357183.doc', '2019-07-05 13:06:23', '2019-07-05 13:06:23'),
('DOC0005', 'APR0003', 'APR0003_Initial_Test.png', 'DTY0004', '/documents/test_attachment/APR0003_Initial_Test.png', '2019-07-05 14:15:02', '2019-07-05 14:15:02'),
('DOC0007', 'APL0004', 'APL0004APR0003InitialTest', 'DTY0003', '/documents/test_answers/APL0004/APL0004APR0003InitialTest.docx', '2019-07-05 22:46:03', '2019-07-05 22:46:03'),
('DOC0008', 'APL0006', 'APL0006APR0003InitialTest', 'DTY0003', '/documents/test_answers/APL0006/APL0006APR0003InitialTest.doc', '2019-07-05 22:47:15', '2019-07-05 22:47:15'),
('DOC0009', 'APL0005', 'APL0005APR0003InitialTest', 'DTY0003', '/documents/test_answers/APL0005/APL0005APR0003InitialTest.docx', '2019-07-07 03:16:19', '2019-07-07 03:16:19');

-- --------------------------------------------------------

--
-- Table structure for table `document_type`
--

CREATE TABLE `document_type` (
  `document_type_id` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_type_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `document_type`
--

INSERT INTO `document_type` (`document_type_id`, `document_type_name`, `created_at`, `updated_at`) VALUES
('DTY0001', 'CV', '2019-07-02 10:50:19', '2019-07-02 10:50:19'),
('DTY0002', 'Certificate', '2019-07-02 10:50:19', '2019-07-02 10:50:19'),
('DTY0003', 'Test Answers', '2019-07-02 10:50:19', '2019-07-02 10:50:19'),
('DTY0004', 'Test Questions', '2019-07-02 10:50:19', '2019-07-02 10:50:19');

-- --------------------------------------------------------

--
-- Table structure for table `interview`
--

CREATE TABLE `interview` (
  `interview_id` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interview_type_id` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interviewer_id` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `applicant_id` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interview_venue` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interview_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interview_score` int(11) DEFAULT NULL,
  `interview_datetime` datetime NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interview`
--

INSERT INTO `interview` (`interview_id`, `interview_type_id`, `interviewer_id`, `applicant_id`, `interview_venue`, `interview_code`, `interview_score`, `interview_datetime`, `status`, `created_at`, `updated_at`) VALUES
('ITV0001', 'ITY0002', 'USR0001', 'APL0001', NULL, 'HNVmBkQO', NULL, '2019-07-04 01:56:00', 'pass', '2019-07-03 11:28:50', '2019-07-04 20:41:26'),
('ITV0002', 'ITY0001', 'USR0001', 'APL0002', 'Kantor saya', NULL, 80, '2019-07-05 10:45:00', 'pass', '2019-07-04 20:44:35', '2019-07-04 20:45:43'),
('ITV0003', 'ITY0001', 'USR0001', 'APL0003', 'kantorrrrr', NULL, 90, '2019-07-05 13:08:00', 'pass', '2019-07-05 09:17:38', '2019-07-05 09:24:49'),
('ITV0004', 'ITY0001', 'USR0001', 'APL0004', 'asdasdasd', NULL, 85, '2019-07-08 11:30:00', 'completed', '2019-07-06 10:58:58', '2019-07-06 11:19:47'),
('ITV0005', 'ITY0001', 'USR0001', 'APL0005', 'Gedung Wisma Nugra Santana Lantai 16 PT.Dynamo', NULL, 85, '2019-07-08 13:30:00', 'pass', '2019-07-06 20:20:23', '2019-07-06 20:40:43');

-- --------------------------------------------------------

--
-- Table structure for table `interview_type`
--

CREATE TABLE `interview_type` (
  `interview_type_id` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interview_type_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interview_type`
--

INSERT INTO `interview_type` (`interview_type_id`, `interview_type_name`, `created_at`, `updated_at`) VALUES
('ITY0001', 'Face to Face', '2019-07-03 11:27:23', '2019-07-03 11:27:23'),
('ITY0002', 'Online Interview', '2019-07-03 11:27:23', '2019-07-03 11:27:23');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` int(11) DEFAULT NULL,
  `minimum_age` int(11) DEFAULT NULL,
  `minimum_experience` int(11) DEFAULT NULL,
  `active_date` date NOT NULL,
  `expired_date` date NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `department_id`, `job_name`, `description`, `salary`, `minimum_age`, `minimum_experience`, `active_date`, `expired_date`, `status`, `created_at`, `updated_at`) VALUES
('JOB0001', 'DPT0004', 'Marketing Officer', 'Marketing officerrss\r\naasdasd\r\nasdasdasdasdads', 4500000, 25, 2, '2019-07-02', '2019-07-17', 'open', '2019-07-02 11:22:20', '2019-07-02 11:22:20'),
('JOB0002', 'DPT0008', 'Full Stack Developer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla imperdiet, mi dignissim dapibus porta, diam urna \r\nrhoncus erat, eget commodo felis quam vel enim.', 9000000, 23, 2, '2019-07-03', '2019-07-06', 'open', '2019-07-03 12:17:30', '2019-07-03 12:17:30'),
('JOB0003', 'DPT0009', 'Data Analyst', 'Menganalisa dan input data untuk kelengkapan vendor serta customer', 6500000, 22, 1, '2019-07-06', '2019-08-17', 'open', '2019-07-05 11:28:28', '2019-07-05 11:28:28'),
('JOB0004', 'DPT0004', 'Akutansi', 'memeriksa keuangan perusahaan. dan mengatur management keuangan', 5500000, 20, 2, '2019-07-06', '2019-08-06', 'open', '2019-07-05 11:45:25', '2019-07-05 11:45:25');

-- --------------------------------------------------------

--
-- Table structure for table `job_skill`
--

CREATE TABLE `job_skill` (
  `job_skill_id` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_id` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skill_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_skill`
--

INSERT INTO `job_skill` (`job_skill_id`, `job_id`, `skill_name`, `rate`, `created_at`, `updated_at`) VALUES
('JSK0001', 'JOB0001', 'Communication', 70, NULL, NULL),
('JSK0002', 'JOB0001', 'Teamwork', 30, NULL, NULL),
('JSK0003', 'JOB0002', 'PHP', 50, NULL, NULL),
('JSK0004', 'JOB0002', 'C#', 50, NULL, NULL),
('JSK0005', 'JOB0003', 'mysql', 30, NULL, NULL),
('JSK0006', 'JOB0003', 'sql', 45, NULL, NULL),
('JSK0007', 'JOB0004', 'comunication', 25, NULL, NULL),
('JSK0008', 'JOB0004', 'marketing', 45, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_important` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment_url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `subject`, `body`, `from`, `to`, `is_important`, `attachment_url`, `status`, `created_at`, `updated_at`) VALUES
('MSG0001', 'Pengumuman Perubahan Jadwal Interview', 'lorem ipsum dolot sit amet', 'USR0001', 'chen@mail.com, enrico@mail.com', NULL, NULL, 'read', '2019-07-03 18:00:16', '2019-07-03 22:41:19'),
('MSG0002', 'asdasdasd', 'asdasdasdasdasdasdasd', 'USR0001', 'chen@mail.com', 'yes', NULL, 'read', '2019-07-03 17:00:00', '2019-07-03 18:35:56'),
('MSG0003', 'alsdkalskdj', 'akdjaksdlakdsjdsa', 'USR0001', 'chen@mail.com', NULL, NULL, 'read', '2019-07-04 00:50:35', '2019-07-04 02:07:15'),
('MSG0004', 'test', 'asdasdasdasdasdasdasdasdasdasdasdasdasd\r\nasdasdasdasdasdasdasd\r\nasdasdasd\r\n\r\nadsasdasd', 'USR0002', 'alim@mail.com', NULL, NULL, 'read', '2019-07-06 10:18:08', '2019-07-06 10:18:14'),
('MSG0005', 'Testing', 'hai chen', 'USR0001', 'chen@mail.com', NULL, NULL, 'read', '2019-07-06 22:25:50', '2019-07-06 22:26:32');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2012_06_18_233014_create_role_table', 1),
(2, '2013_06_14_092414_create_department_table', 1),
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2019_06_12_131351_create_document_type_table', 1),
(6, '2019_06_14_064424_create_job_table', 1),
(7, '2019_06_14_235033_create_document_table', 1),
(8, '2019_06_15_183805_create_applicant_table', 1),
(9, '2019_06_21_000553_create_technical_test_table', 1),
(10, '2019_06_21_000554_create_interview_table', 1),
(11, '2019_06_22_002432_create_application_progress_table', 1),
(12, '2019_06_22_021239_create_user_experience_table', 1),
(13, '2019_06_22_021257_create_user_education_table', 1),
(14, '2019_06_22_021310_create_user_skill_table', 1),
(15, '2019_06_22_062311_create_job_skill_table', 1),
(16, '2019_06_28_131423_create_interview_type_table', 1),
(17, '2019_07_02_023441_create_task_table', 1),
(18, '2019_07_02_023547_create_message_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `created_at`, `updated_at`) VALUES
('ROLE001', 'Recruitment Unit', '2019-07-02 10:50:17', '2019-07-02 10:50:17'),
('ROLE002', 'Applicant', '2019-07-02 10:50:17', '2019-07-02 10:50:17');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `task_description` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_date` date NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `user_id`, `task_description`, `task_date`, `status`, `created_at`, `updated_at`) VALUES
('TSK0001', 'USR0001', 'Bukber', '2019-07-05', '', '2019-07-03 12:40:41', '2019-07-03 12:40:41'),
('TSK0002', 'USR0001', 'Meeting Client', '2019-07-10', '', '2019-07-03 12:49:23', '2019-07-03 12:49:23'),
('TSK0003', 'USR0001', 'Meeting cok', '2019-07-04', '', '2019-07-03 12:49:37', '2019-07-03 12:49:37'),
('TSK0004', 'USR0001', 'Servis HP', '2019-07-03', NULL, '2019-07-03 13:12:43', '2019-07-03 13:12:43');

-- --------------------------------------------------------

--
-- Table structure for table `technical_test`
--

CREATE TABLE `technical_test` (
  `technical_test_id` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `applicant_id` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score_1` int(11) DEFAULT NULL,
  `score_2` int(11) DEFAULT NULL,
  `score_3` int(11) DEFAULT NULL,
  `score_4` int(11) DEFAULT NULL,
  `average_score` int(11) DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `technical_test`
--

INSERT INTO `technical_test` (`technical_test_id`, `applicant_id`, `score_1`, `score_2`, `score_3`, `score_4`, `average_score`, `status`, `created_at`, `updated_at`) VALUES
('TCT0001', 'APL0001', 80, 90, NULL, NULL, 85, 'pass', '2019-07-02 18:35:12', '2019-07-03 11:28:50'),
('TCT0002', 'APL0002', 70, 79, 89, NULL, 79, 'pass', '2019-07-04 06:13:35', '2019-07-04 20:44:34'),
('TCT0003', 'APL0003', 90, NULL, 90, NULL, 90, 'pass', '2019-07-04 20:45:52', '2019-07-05 09:17:38'),
('TCT0004', 'APL0004', 90, NULL, NULL, NULL, 90, 'pass', '2019-07-05 13:03:26', '2019-07-06 10:58:58'),
('TCT0005', 'APL0006', NULL, NULL, NULL, NULL, NULL, 'not_tested', '2019-07-05 14:52:22', '2019-07-05 14:52:22'),
('TCT0006', 'APL0005', 90, NULL, NULL, NULL, 90, 'pass', '2019-07-06 20:14:35', '2019-07-06 20:20:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date DEFAULT NULL,
  `birth_place` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `university` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `major` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `degree` varchar(51) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_url` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `birth_date`, `birth_place`, `gender`, `phone`, `address`, `university`, `major`, `degree`, `role_id`, `photo_url`, `remember_token`, `created_at`, `updated_at`) VALUES
('USR0001', 'Alim', 'Rafli', 'alim@mail.com', '$2y$10$RlNwZVdNfgALaCyGAOvyNOB0cedMuXO12x0GOpRSm5rs1KTuCgGPm', '1998-09-25', 'Jakarta', 'Male', '081208120812', 'Jalan Sesama', 'Universitas Bina Nusantara', 'Computer Science', 'S1', 'ROLE001', '/assets/img/users/Alim_RafliUSR0001.jpg', 'xKZdZdfxcgiPfS725f2dfZmPhjXoThSCMqrGlsTUd0CYz6y3iBb14VOWeHCq', '2019-07-03 03:25:32', '2019-07-03 22:00:16'),
('USR0002', 'Enrico', 'Bortol', 'Enrico@mail.com', '$2y$10$CiH9w97/Qb4wW1kxq/TA0.2ffaNEPdhSVhoCdV9WyRm3Q52qwqquO', '1990-11-27', 'Erfurt', 'Male', '083218903476', '', 'Privredna Akademija (Business Academy)', 'IT', 'S3', 'ROLE002', '/assets/img/users/Enrico_BortolUSR0002.jpg', 'EU37OmGciErpbmpg5y6Z1efFxrOWhJLF1Uv2AjuHxa3cy4VmYJvK7W4V8wMO', '2019-07-03 03:25:32', '2019-07-06 00:59:51'),
('USR0003', 'Chen', 'prayitno', 'Chen@mail.com', '$2y$10$HYtNN4JS.hTq5RPcXAYXueTW1doPDKuvWZL8aUJXJuivpD62NeuLC', '1998-08-25', 'Bekasi', 'Male', '82257761644', 'Jalan timur raya. Rt 04. Rw 03. Nomor 39', 'Universitas Dian Nuswantoro', 'IT', 'S2', 'ROLE002', '', 'dUuu4FGooFZgWe21yI8PceVnNLeTnrJPwyh7AIVil2oDcwlZjA37p5JHzO3R', '2019-07-03 03:25:32', '2019-07-03 00:28:47'),
('USR0004', 'Arch', 'Calyton', 'Arch@mail.com', '$2y$10$hbpPZGda88d29YdQUFWP5Oanwvkm2opmAkh33ZtAaH4eG7eOmeQLi', '1996-02-15', 'Chashnikovo', 'Male', '083218903476', '', 'Jarvis Christian College', '', '', 'ROLE002', '', 'opekPYZ9iU1726FV9DDBJFMrtGJAWoJoN3Onk5lKfwqbdEFVhYtySSeG130k', '2019-07-03 03:25:32', '2019-07-03 03:25:32'),
('USR0005', 'Melvin', 'Rowlands', 'Melvin@mail.com', '$2y$10$wLS6JQwX7nLWJV9TeAiIt.etLZAwrrJEFdMZBLkeeSF/prbBwcco.', '1997-10-28', 'Hvozdná', 'Male', '083218903476', '', 'Bina Nusantara University', 'IT', 'S1', 'ROLE002', '', 'l6je5bOqQCgseqQnSxFD5xQ9xtMyC1qm5rMmFw8M11FO7cGwY4PPszVAMAbS', '2019-07-03 03:25:32', '2019-07-05 11:01:29'),
('USR0006', 'Giffie', 'Cancellieri', 'Giffie@mail.com', '$2y$10$XXRYDlnDXrN3D.R6h.KZqeCwfXRF0uilYCgzH49dJ/aCUluRUVPNq', '1992-11-10', 'Boquira', 'Male', '083218903476', '', 'Bina Nusantara University', 'IT', 'S1', 'ROLE002', '', 'ytlTQ10BFhjnhqmFIzdg4cavl8HGlQDw64acscq36KQAhCOwWoLh90H6ItK6', '2019-07-03 03:25:32', '2019-07-05 10:58:03'),
('USR0007', 'Tess', 'Dewer', 'Tess@mail.com', '$2y$10$k9GnnqrOA02BD6g/RVoGSe6S1AMbvfqYeJBHIyp7xQAxN2IjvDFdu', '1997-03-29', 'Vári', 'Female', '083218903476', '', 'Bina Nusantara University', 'IT', 'S1', 'ROLE002', '', '7v38YYi3G0nsqQczo68kJpRdbVtmngHIAAmUqj6KPAU8bojc8peItiCMHegU', '2019-07-03 03:25:33', '2019-07-05 10:53:15'),
('USR0008', 'Rockwell', 'McCandless', 'Rockwell@mail.com', '$2y$10$GSWqVeiGo8Ghdtg2s4jvceXRyqW7nRdDrrYMEkc93LtqMjqxkMWzi', '1990-08-03', 'Thio', 'Male', '083218903476', '', 'Bina Nusantara University', 'IT', 'S1', 'ROLE002', '', 'yjtwt7LHhEyttYLzraziAxpNFxIIvXCIZwvqGYkTXlUUHJl19JSMXPV4e7tG', '2019-07-03 03:25:33', '2019-07-05 10:46:41'),
('USR0009', 'Ricca', 'Linklet', 'Ricca@mail.com', '$2y$10$C.8XjCMDDUHjmX1jUxGnIOaucvZGVusAnIuVeZALIXJaHmWL2/XqC', '1987-04-25', 'Matsubase', 'Female', '083218903476', '', 'Bina Nusantara University', 'IT', 'S1', 'ROLE002', '', 'PQHpCH5lNe6cnS7MOypOoCo8WgZDQBRfEWDCSfqnmbANkZnUS7GOJpEA4xAY', '2019-07-03 03:25:33', '2019-07-05 10:32:55'),
('USR0010', 'Niko', 'Lighten', 'Niko@mail.com', '$2y$10$uDMM/JKNXn0oZMHj.gBDhei9Em92C7l6WFNycOWXmWn7TJkfJZlay', '1992-09-18', 'Paokmotong Utara', 'Male', '083218903476', '', 'Bina Nusantara University', 'IT', 'S1', 'ROLE002', '', 'y6YsUsy8vK4CyT3PYwRRnkXXfkEpdsvtV6dGbNshCCPJjDz8I45qGfUaru23', '2019-07-03 03:25:33', '2019-07-05 09:28:31'),
('USR0011', 'Jennifer', 'Scollan', 'Jennifer@mail.com', '$2y$10$Rrlyf2gi8vSXOZmTZ1O2kuySqal3OoTToEu.CPDJ2AIUhmw0qpVsK', '1999-03-27', 'Besançon', 'Female', '083218903476', '', 'Bina Nusantara University', 'IT', 'S1', 'ROLE002', '', 'P2pq9RSvEZL9sQveSg01E1Fo8H3Lsb7EjUyGemaOhUfwt1IOUbPLzzoat3Pv', '2019-07-03 03:25:33', '2019-07-05 09:23:49'),
('USR0012', 'Danita', 'Brickner', 'Danita@mail.com', '$2y$10$xCydSHU9P081ampGgpj3XOwOGXHTLup3.4SxARAwysZsM4esrFmaS', '1993-01-19', 'Dambulla', 'Female', '083218903476', '', 'Bina Nusantara University', 'IT', 'S1', 'ROLE002', '', 'mJV7XyVNaIXOtgomgv6wBv83IB4eMxLcha7Bhxbx2qkooCsCp5LIQqVo1tfX', '2019-07-03 03:25:33', '2019-07-05 09:14:13'),
('USR0013', 'Grannie', 'Del Monte', 'Grannie@mail.com', '$2y$10$faFfPYaJnx755HeUTCpb4uKr5h5glR.91aeOMZkFNnWDctGib9lB6', '1996-09-02', 'Morden', 'Male', '083218903476', '', 'Bina Nusantara University', 'IT', 'S1', 'ROLE002', '', 'WGy071hZAqwL5va6FUWNI55Iz1vS4c6G7O71B5N9xcPAiq434tzCgsQ60OSn', '2019-07-03 03:25:33', '2019-07-05 09:09:28'),
('USR0014', 'Brannon', 'Aujean', 'Brannon@mail.com', '$2y$10$k/jtpXIApuMEluno1kvZN.j7Wuq.dZ4uwJyxmpGQM2ABEi/YQuLz2', '1993-10-01', 'Driyorejo', 'Male', '083218903476', '', 'Bina Nusantara University', 'IT', 'S1', 'ROLE002', '', 'FF4MGj2YjLzJ6OjqHP7b1SlQucmR1bUeHecEO0s2XOPRACVqlunEiQK6qLnh', '2019-07-03 03:25:33', '2019-07-05 08:59:34'),
('USR0015', 'Arluene', 'Gloster', 'Arluene@mail.com', '$2y$10$rjuxyS38qbw5P95pR5VQ0.aQzHBmwumZSTIX41HTkV1Yz2S/DXgTq', '1992-04-06', 'Bella Vista', 'Female', '083218903476', '', 'Bina Nusantara University', 'IT', 'S1', 'ROLE002', '', 'UpM0HWw57baaFWzX4mvFftOVvYsnRzqpGnLh0741rgs1QBJDwiRBTgEPav1G', '2019-07-03 03:25:34', '2019-07-05 08:54:28'),
('USR0016', 'Zolly', 'Camsey', 'Zolly@mail.com', '$2y$10$neFbnqQHGlkctmU1wirq6.oAPcklFv/nji97X1RHeN7r3YqsbC.z.', '1988-10-20', 'Klapagada', 'Male', '083218903476', '', 'Bina Nusantara University', 'SI', 'S1', 'ROLE002', '', 'R8B6cCSkiizdOsFgUbLtYgbyEnKKBf1jSFZPPimNciuXaFXY8aevoXuJfdRR', '2019-07-03 03:25:34', '2019-07-05 08:45:14'),
('USR0017', 'Heywood', 'Suddards', 'Heywood@mail.com', '$2y$10$LlZU0Lu4nr0BHSz5UrdlN.GOeDJXSzyTn10mxKKx.fdoG3MV8Zj/m', '1997-08-09', 'Chillia', 'Male', '083218903476', '', 'Bina Nusantara University', 'IT', 'S1', 'ROLE002', '', 'UsmpFtaUjnbdCoCMp0Ma0MhWETzRzwqOHhtbyTVyMhdmHXhFl5OZlfLD1vOg', '2019-07-03 03:25:34', '2019-07-05 08:19:47'),
('USR0018', 'Gabi', 'Pranger', 'Gabi@mail.com', '$2y$10$7pZc4iylqjRBmdKmsawmEOIww0BcKHNxy.xJnY2krWSmLsdZ3mFvm', '1996-05-07', 'Makueni', 'Male', '083218903476', '', 'Bina Nusantara University', 'IT', 'S1', 'ROLE002', '', 'CKcpdfsoFn0J8atkehksHQ3oq3QKjt58bRDmpOFWSu72KTM7cBa2sHeAnF8C', '2019-07-03 03:25:34', '2019-07-05 08:15:06'),
('USR0019', 'Sherie', 'Ciepluch', 'Sherie@mail.com', '$2y$10$RUp4y5WCCTPMavXxaYXKNulsOQDAcs/HI5QyJ6oGw3j358cLdMFbq', '1995-01-18', 'Emiliano Zapata', 'Female', '083218903476', '', 'Bina Nusantara University', 'SI', 'S1', 'ROLE002', '', 'm0s5oP1pMU89pWjliviRiH7NFG2jLxanZ2iMP47dLvsAazx5vDe3V4Lnqd4p', '2019-07-03 03:25:34', '2019-07-05 07:58:52'),
('USR0020', 'Vincenz', 'McLane', 'Vincenz@mail.com', '$2y$10$qIUG183Sxg7byThqojZ4huTyo1JJelknC2EPc8mFpqeOooXorLo7u', '1989-04-11', 'Shirochanka', 'Male', '083218903476', '', 'Bina Nusantara University', 'IT', 'S1', 'ROLE002', '', 'BNPJQkOj7X1j3vyi1wJvtQNakshAaabBDKX6tiMpmQ0I3L4kIng3jcvi8o1t', '2019-07-03 03:25:34', '2019-07-05 07:56:34'),
('USR0021', 'Trish', 'Lonie', 'Trish@mail.com', '$2y$10$Xo2edAEENWP1ucl.arJfC.xwj.AclGxR8x0uUc0sV8CQAOEuQWnDK', '1989-04-11', 'Metsemotlhaba', 'Female', '083218903476', '', 'Bina Nusantara university', 'IT', 'S1', 'ROLE002', '', '7JlOQvs4sDW8inyOJWhmNyC65pvOKzeAdb4IL5n6q7M43bzql8qCchLbUhCV', '2019-07-03 03:25:34', '2019-07-04 06:54:31'),
('USR0022', 'Quentin', 'Sustin', 'Quentin@mail.com', '$2y$10$PSFB9qvbf/I9ykj7/ScYEuycoPrqDE/gwN1M2qv1iDzgqSsQFrVla', '1997-07-23', 'Preko', 'Female', '083218903476', '', 'Politeknik Negeri Bandung', 'SI', 'S1', 'ROLE002', '', 'dpWLgINJl4n9Vy47th6ulw4XHROVIEvPcBGJQaWTYV51SKW6nH01P9XcwCOs', '2019-07-03 03:25:34', '2019-07-04 06:32:58'),
('USR0023', 'Jaine', 'Weerdenburg', 'Jaine@mail.com', '$2y$10$3f9xShrcpitgWiOREXjk0Odol1qHak5h.94.v9zYyEHnI4ey5V0gm', '1990-03-06', 'Guyi', 'Female', '083218903476', '', 'Institut Teknologi Sumatera, Bandar Lampung', 'SI', 'S1', 'ROLE002', '', '1389HmwYcrSEKrYKjG7LTJjDasQ4tqMvUOVZsLHmszNsmMgf2lhzHxBHS36U', '2019-07-03 03:25:35', '2019-07-04 06:10:53'),
('USR0024', 'Remus', 'Trethowan', 'Remus@mail.com', '$2y$10$xguvhl/6JZCpV9bJT39Hcu1pujHgvbHtGa1n0n2R6rXGUhUMionS6', '1993-12-27', 'Veghel', 'Male', '083218903476', '', 'Universidad Autónoma de Las Américas', '', '', 'ROLE002', '', 'WXWkwypy6X4g32sQlzzUaaogKOnF5ZWy3MUJgjAcLB3rdMmvPa8EBLLo4aqV', '2019-07-03 03:25:35', '2019-07-03 03:25:35'),
('USR0025', 'Arny', 'McKaile', 'Arny@mail.com', '$2y$10$Zeyus6C4vw1WVnzO88j1PuU.fv.mW0DWbqZPy/IYhzwWaMzQ8Y/BG', '1998-03-18', 'Daping', 'Male', '083218903476', '', 'Politeknik Negeri Sriwijaya, Palembang', 'IT', 'S1', 'ROLE002', '', 'FfkKplQHAtOvaItP4ps6SDiUruL0pIqHp4yoZyhIKaVr9ZyVpGk3FI09YQig', '2019-07-03 03:25:35', '2019-07-04 05:51:40'),
('USR0026', 'Griselda', 'Ludl', 'Griselda@mail.com', '$2y$10$gASyfMkB5SclZ2BktVuORuH5.2E.OdhT/LEIEa4AzFoqxtQkuiVPa', '1994-02-22', 'Quintãs', 'Female', '083218903476', '', 'Bina Nusantara University', 'SI', 'S1', 'ROLE002', '', 't8CBETuJb55u9Isyapl4FWdauRkH0D3rcFvRzUdHa27Y4UiPxFHvyOlPG7JH', '2019-07-03 03:25:35', '2019-07-04 07:14:02'),
('USR0027', 'Othello', 'Tregale', 'Othello@mail.com', '$2y$10$pFWqXcIijU6X/cbtp8Nwu.uOMO0V3wuRXs02oquw3WaxqrL0.CnlW', '1980-01-17', 'Itapevi', 'Male', '083218903476', '', 'Bina Nusantara university', 'IT', 'S1', 'ROLE002', '', 'Uz06Wx4tJnKnPuv3QWtd4RhlpKfYtTI6ulnWRwLwzyLvu6oxiawdWtv4Smd3', '2019-07-03 03:25:35', '2019-07-04 07:34:39'),
('USR0028', 'Broddie', 'Bone', 'Broddie@mail.com', '$2y$10$ztk0FuVzUjJ247MhZhUvMuZAhl8zhtFRltFlBhLYW8g8XsSTTmw1e', '1991-01-08', 'Kupavna', 'Male', '083218903476', '', 'Bina Nusantara university', 'IT', 'S1', 'ROLE002', '', '00veMF5bDDeHoYc9URlxJsHvarkKdLXlv3AHDZnz5z61mXRTuPlTHbi1Wa28', '2019-07-03 03:25:35', '2019-07-04 08:29:43'),
('USR0029', 'Caryn', 'Kendal', 'Caryn@mail.com', '$2y$10$W7aJPTH6AG7uTW7.xCxmAOTVArTdbZ3S91NlnhMLwGqsRbsz86EZi', '1992-05-16', 'Al Hufūf', 'Female', '083218903476', '', 'Bina Nusantara University', 'IT', 'S1', 'ROLE002', '', 'WpJmwxMplKKVRWoTFldz0kPZ4S0gcGEskifnW6ymiARMyog9Sm6XFCL509eZ', '2019-07-03 03:25:35', '2019-07-04 09:03:01'),
('USR0030', 'Griz', 'Collist', 'Griz@mail.com', '$2y$10$KJadzbmR1HG3dR08xV4M1ueRyvvldZK4hqXTMHtzcEjWcUP8Aeeqy', '1984-01-17', 'Dallas', 'Male', '083218903476', '', 'Bina Nusantara University', 'IT', 'S1', 'ROLE002', '', 'HCJn2QHuy0nklJ6uWSo6KfxkYjJ63yXPHKa4oZNy43SkDbrAdZQSOsGXAYTG', '2019-07-03 03:25:35', '2019-07-04 08:14:40'),
('USR0031', 'Charles', 'Xavier', 'charles@mail.com', '$2y$10$KiWBC3ydzDNQWBm2.oLdNe6YtWMa8YX9Bp1fnWkuEJ9h7Jlv6cjJW', '1995-07-06', 'Bandung', 'Male', NULL, 'Jalan Salemba', 'Bina Sarana Informatika', 'Sinematografi', 'S1', 'ROLE002', NULL, 'RjtEZDIX149L17asrqAmXixZIDWzknjRJhir9gsiYY7oKTYhmPW9BHhWLOB4', '2019-07-05 12:39:25', '2019-07-05 12:56:54');

-- --------------------------------------------------------

--
-- Table structure for table `user_education`
--

CREATE TABLE `user_education` (
  `user_education_id` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `education_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `period_start` date NOT NULL,
  `period_end` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_education`
--

INSERT INTO `user_education` (`user_education_id`, `user_id`, `education_name`, `period_start`, `period_end`, `created_at`, `updated_at`) VALUES
('UED0001', 'USR0002', 'SMA Joyoboya', '2019-07-02', '2019-07-13', NULL, NULL),
('UED0003', 'USR0003', 'sekolah dasar kuloko', '2002-02-05', '2008-01-29', NULL, NULL),
('UED0004', 'USR0003', 'sekolah menengah pertama kuloko 2', '2009-07-08', '2012-03-13', NULL, NULL),
('UED0005', 'USR0003', 'sekolah menengah atas kunnkara 78', '2013-06-11', '2016-05-10', NULL, NULL),
('UED0006', 'USR0003', 'universitas dian nuswantoro', '2016-03-16', '2019-07-03', NULL, NULL),
('UED0007', 'USR0024', 'SMA Kanisius', '2015-02-05', '2017-02-14', NULL, NULL),
('UED0008', 'USR0024', 'Universitas Andalas, Padang', '2017-03-07', '2019-07-01', NULL, NULL),
('UED0009', 'USR0025', 'SMA Budi Agung', '2015-02-12', '2018-02-01', NULL, NULL),
('UED0010', 'USR0025', 'Politeknik Negeri Sriwijaya, Palembang', '2018-02-07', '2019-07-04', NULL, NULL),
('UED0011', 'USR0023', 'SMA Bunga Hati Bangsa', '2014-02-05', '2017-02-07', NULL, NULL),
('UED0012', 'USR0023', 'Institut Teknologi Sumatera, Bandar Lampung', '2017-08-08', '2019-07-04', NULL, NULL),
('UED0013', 'USR0022', 'SMA Diakonia', '2014-06-17', '2016-08-10', NULL, NULL),
('UED0014', 'USR0022', 'Politeknik Negeri Bandung', '2016-09-12', '2019-06-12', NULL, NULL),
('UED0015', 'USR0021', 'SMA Permata Indah', '2014-02-06', '2017-02-07', NULL, NULL),
('UED0016', 'USR0021', 'Bina Nusantara university', '2017-02-10', '2019-07-04', NULL, NULL),
('UED0017', 'USR0026', 'SMA Bina Tunas Bangsa', '2015-06-10', '2017-06-06', NULL, NULL),
('UED0018', 'USR0026', 'Bina Nusantara University', '2017-08-09', '2019-07-04', NULL, NULL),
('UED0019', 'USR0027', 'SMA Seruni Don Bosco', '2014-02-13', '2016-07-13', NULL, NULL),
('UED0020', 'USR0027', 'Bina Nusantara University', '2016-11-11', '2019-07-04', NULL, NULL),
('UED0021', 'USR0030', 'SMA Muhammadiyah 18', '2015-02-12', '2017-06-14', NULL, NULL),
('UED0022', 'USR0030', 'Bina Nusantara University', '2017-07-17', '2019-07-04', NULL, NULL),
('UED0023', 'USR0028', 'SMA Budi Waluyo', '2014-06-06', '2016-08-24', NULL, NULL),
('UED0024', 'USR0028', 'Bina Nusantara University', '2016-11-17', '2019-07-04', NULL, NULL),
('UED0025', 'USR0029', 'SMA Santo Alexius', '2014-06-17', '2016-10-06', NULL, NULL),
('UED0026', 'USR0029', 'Bina Nusantara University', '2016-11-15', '2019-07-04', NULL, NULL),
('UED0027', 'USR0020', 'SMA Negeri 35 Jakarta', '2012-06-12', '2015-07-15', NULL, NULL),
('UED0028', 'USR0020', 'Bina Nusantara University', '2016-02-03', '2019-07-05', NULL, NULL),
('UED0029', 'USR0019', 'SMA Bukit Sion', '2013-02-07', '2016-01-04', NULL, NULL),
('UED0030', 'USR0019', 'Bina Nusantara University', '2016-02-11', '2019-07-05', NULL, NULL),
('UED0031', 'USR0018', 'SMA Harapan Jaya', '2013-02-07', '2015-12-24', NULL, NULL),
('UED0032', 'USR0018', 'Bina Nusantara University', '2016-01-14', '2019-07-05', NULL, NULL),
('UED0033', 'USR0017', 'SMA Lamanolot', '2013-01-17', '2015-02-10', NULL, NULL),
('UED0034', 'USR0017', 'Bina Nusantara University', '2016-01-03', '2019-07-05', NULL, NULL),
('UED0035', 'USR0016', 'SMA Notre Dame', '2013-01-01', '2016-01-04', NULL, NULL),
('UED0036', 'USR0016', 'Bina Nusantara University', '2016-02-08', '2019-07-05', NULL, NULL),
('UED0037', 'USR0015', 'SMA Panindi', '2013-02-04', '2015-02-18', NULL, NULL),
('UED0038', 'USR0015', 'Bina Nusantara University', '2015-06-09', '2019-07-05', NULL, NULL),
('UED0039', 'USR0014', 'SMA Tunas Muda', '2014-06-17', '2016-06-14', NULL, NULL),
('UED0040', 'USR0014', 'Bina Nusantara University', '2016-02-09', '2019-07-05', NULL, NULL),
('UED0041', 'USR0013', 'SMAK Samaria', '2013-06-04', '2015-07-15', NULL, NULL),
('UED0042', 'USR0013', 'Bina Nusantara University', '2016-01-05', '2019-07-04', NULL, NULL),
('UED0043', 'USR0012', 'SMA Saint John\'s School', '2014-02-04', '2016-02-08', NULL, NULL),
('UED0044', 'USR0012', 'Bina Nusantara University', '2016-11-16', '2019-07-05', NULL, NULL),
('UED0045', 'USR0011', 'SMA Mahatma Gandh', '2013-02-05', '2016-01-06', NULL, NULL),
('UED0046', 'USR0011', 'Bina Nusantara University', '2016-06-14', '2019-07-05', NULL, NULL),
('UED0047', 'USR0010', 'SMA YADIKA 1', '2014-01-22', '2016-06-13', NULL, NULL),
('UED0048', 'USR0010', 'Bina Nusantara University', '2016-10-18', '2019-07-05', NULL, NULL),
('UED0049', 'USR0009', 'SMAI Al Chasanah', '2014-01-09', '2016-01-05', NULL, NULL),
('UED0050', 'USR0009', 'Bina Nusantara University', '2016-04-05', '2019-07-06', NULL, NULL),
('UED0051', 'USR0008', 'SMAI Fajrul', '2013-05-09', '2016-02-09', NULL, NULL),
('UED0052', 'USR0008', 'Bina Nusantara University', '2016-08-02', '2019-07-06', NULL, NULL),
('UED0053', 'USR0007', 'SMA Triwibawa', '2013-06-11', '2015-11-24', NULL, NULL),
('UED0054', 'USR0007', 'Bina Nusantara University', '2016-02-10', '2019-07-06', NULL, NULL),
('UED0055', 'USR0006', 'SMA Dewi Sartika', '2014-02-05', '2016-02-19', NULL, NULL),
('UED0056', 'USR0006', 'Bina Nusantara University', '2016-06-10', '2019-07-06', NULL, NULL),
('UED0057', 'USR0005', 'SMAN Jakarta', '2019-07-03', '2019-07-03', NULL, NULL),
('UED0058', 'USR0031', 'SMAN 5 Jakarta', '2019-07-06', '2019-07-06', NULL, NULL),
('UED0059', 'USR0004', 'Binusmaya', '2015-02-03', '2019-07-06', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_experience`
--

CREATE TABLE `user_experience` (
  `user_experience_id` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `period_start` date NOT NULL,
  `period_end` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_experience`
--

INSERT INTO `user_experience` (`user_experience_id`, `user_id`, `experience_name`, `period_start`, `period_end`, `created_at`, `updated_at`) VALUES
('UEX0001', 'USR0002', 'Work exp 1', '2015-07-18', '2017-07-06', NULL, NULL),
('UEX0002', 'USR0002', 'Work exp 2', '2016-06-14', '2017-08-15', NULL, NULL),
('UEX0003', 'USR0002', 'Work exp 3', '2018-02-07', '2019-07-03', NULL, NULL),
('UEX0005', 'USR0003', 'magang mastersystem', '2018-10-23', '2018-12-13', NULL, NULL),
('UEX0006', 'USR0003', 'magang dynamia', '2019-01-29', '2019-07-03', NULL, NULL),
('UEX0007', 'USR0024', 'IT consultant Attitude Solution', '2018-03-06', '2018-12-19', NULL, NULL),
('UEX0008', 'USR0025', 'Assisten Dosen Laboratorium', '2019-03-05', '2019-07-04', NULL, NULL),
('UEX0009', 'USR0023', 'Pengurus Himti', '2019-01-01', '2019-07-03', NULL, NULL),
('UEX0010', 'USR0022', 'Tecs Hardware', '2017-01-19', '2018-01-10', NULL, NULL),
('UEX0011', 'USR0021', 'Assistant Lab', '2018-01-02', '2019-06-11', NULL, NULL),
('UEX0012', 'USR0026', 'Magang MNC group', '2019-01-01', '2019-05-08', NULL, NULL),
('UEX0013', 'USR0027', 'Magang Tokopedia', '2018-03-15', '2018-12-11', NULL, NULL),
('UEX0014', 'USR0030', 'Magang dimension data', '2018-07-13', '2019-02-13', NULL, NULL),
('UEX0015', 'USR0028', 'Magang Wings IT dev', '2018-09-10', '2019-06-10', NULL, NULL),
('UEX0016', 'USR0029', 'Maju Hardware', '2017-06-15', '2018-02-07', NULL, NULL),
('UEX0017', 'USR0029', 'Magang Ralali', '2018-06-06', '2019-03-05', NULL, NULL),
('UEX0018', 'USR0020', 'Magang active space', '2018-01-10', '2019-07-01', NULL, NULL),
('UEX0019', 'USR0019', 'Maju Hardware', '2017-02-02', '2019-07-05', NULL, NULL),
('UEX0020', 'USR0018', 'Magang tokopedia', '2017-01-26', '2019-06-10', NULL, NULL),
('UEX0021', 'USR0017', 'Arwana IT Consult', '2017-02-02', '2019-07-04', NULL, NULL),
('UEX0022', 'USR0016', 'RSU Ambarawa', '2017-05-18', '2019-07-05', NULL, NULL),
('UEX0023', 'USR0015', 'Magang bukalapak', '2016-01-04', '2019-07-05', NULL, NULL),
('UEX0024', 'USR0014', 'Bank BCA', '2016-01-15', '2019-07-08', NULL, NULL),
('UEX0025', 'USR0013', 'Magang Active Space', '2017-06-13', '2019-07-05', NULL, NULL),
('UEX0026', 'USR0012', 'IT Bank BRI', '2017-01-19', '2019-07-05', NULL, NULL),
('UEX0027', 'USR0011', 'IT Bank BRI', '2017-01-17', '2019-07-05', NULL, NULL),
('UEX0028', 'USR0010', 'IT  ENTER Komputer', '2017-02-07', '2019-07-05', NULL, NULL),
('UEX0029', 'USR0009', 'attitude consultant it', '2014-01-07', '2019-07-02', NULL, NULL),
('UEX0030', 'USR0008', 'Magnus Datamia', '2016-02-12', '2019-07-06', NULL, NULL),
('UEX0031', 'USR0007', 'Magang IT Sidomuncul', '2017-01-09', '2019-07-06', NULL, NULL),
('UEX0032', 'USR0006', 'Master system', '2015-01-05', '2019-07-06', NULL, NULL),
('UEX0033', 'USR0005', 'Marketing officer', '2019-07-03', '2019-07-03', NULL, NULL),
('UEX0034', 'USR0031', 'Magang tukang cilor', '2018-02-06', '2019-05-09', NULL, NULL),
('UEX0035', 'USR0031', 'Selebtwit', '2017-01-03', '2019-07-01', NULL, NULL),
('UEX0036', 'USR0004', 'Penyanyi', '2015-02-05', '2019-07-06', NULL, NULL),
('UEX0037', 'USR0004', 'Selebgram', '2018-01-30', '2019-07-06', NULL, NULL),
('UEX0038', 'USR0004', 'Magang di Tokopedia', '2016-01-01', '2017-01-04', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_skill`
--

CREATE TABLE `user_skill` (
  `user_skill_id` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skill_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_skill`
--

INSERT INTO `user_skill` (`user_skill_id`, `user_id`, `skill_name`, `rate`, `created_at`, `updated_at`) VALUES
('USK0001', 'USR0002', 'Communication', 90, NULL, NULL),
('USK0002', 'USR0002', 'Problem solving', 80, NULL, NULL),
('USK0003', 'USR0002', 'Initiative', 80, NULL, NULL),
('USK0006', 'USR0003', 'mysql', 80, NULL, NULL),
('USK0007', 'USR0003', 'php', 70, NULL, NULL),
('USK0008', 'USR0003', 'comunication', 80, NULL, NULL),
('USK0009', 'USR0024', 'Dot Net', 70, NULL, NULL),
('USK0010', 'USR0024', 'Bahasa Inggris', 78, NULL, NULL),
('USK0011', 'USR0024', 'Team Work', 85, NULL, NULL),
('USK0012', 'USR0024', 'C#', 90, NULL, NULL),
('USK0013', 'USR0025', 'PhP', 84, NULL, NULL),
('USK0014', 'USR0025', 'Bahasa Inggris', 75, NULL, NULL),
('USK0015', 'USR0025', 'CSS', 90, NULL, NULL),
('USK0016', 'USR0025', 'word', 90, NULL, NULL),
('USK0017', 'USR0023', 'C++', 75, NULL, NULL),
('USK0018', 'USR0023', 'Python', 70, NULL, NULL),
('USK0019', 'USR0023', 'Bahasa Inggris', 60, NULL, NULL),
('USK0020', 'USR0023', 'excel', 40, NULL, NULL),
('USK0021', 'USR0022', 'over Clocking', 70, NULL, NULL),
('USK0022', 'USR0022', 'comunication', 88, NULL, NULL),
('USK0023', 'USR0022', 'Router setup', 75, NULL, NULL),
('USK0024', 'USR0022', 'team work', 90, NULL, NULL),
('USK0025', 'USR0021', 'Unity', 70, NULL, NULL),
('USK0026', 'USR0021', 'Java', 85, NULL, NULL),
('USK0027', 'USR0021', 'Bahasa Inggris', 80, NULL, NULL),
('USK0028', 'USR0021', 'PHP', 85, NULL, NULL),
('USK0029', 'USR0026', 'HTML', 80, NULL, NULL),
('USK0030', 'USR0026', 'CSS', 90, NULL, NULL),
('USK0031', 'USR0026', 'Bahasa Inggris', 80, NULL, NULL),
('USK0032', 'USR0026', 'Team Work', 75, NULL, NULL),
('USK0033', 'USR0027', 'Java, PHP', 80, NULL, NULL),
('USK0034', 'USR0027', 'React Native', 75, NULL, NULL),
('USK0035', 'USR0027', 'Bahasa Inggris', 80, NULL, NULL),
('USK0036', 'USR0027', 'ms office', 90, NULL, NULL),
('USK0037', 'USR0030', 'comunication', 80, NULL, NULL),
('USK0038', 'USR0030', 'sql', 75, NULL, NULL),
('USK0039', 'USR0030', 'mysql', 80, NULL, NULL),
('USK0040', 'USR0030', 'postgresql', 70, NULL, NULL),
('USK0041', 'USR0028', 'mysql', 58, NULL, NULL),
('USK0042', 'USR0028', 'C#', 60, NULL, NULL),
('USK0043', 'USR0028', 'comunication', 50, NULL, NULL),
('USK0044', 'USR0028', 'c++', 70, NULL, NULL),
('USK0045', 'USR0029', 'Hardware Service', 80, NULL, NULL),
('USK0046', 'USR0029', 'R programing', 80, NULL, NULL),
('USK0047', 'USR0029', 'C#', 79, NULL, NULL),
('USK0048', 'USR0029', 'React native', 85, NULL, NULL),
('USK0049', 'USR0020', 'PHP', 70, NULL, NULL),
('USK0050', 'USR0020', 'Bahasa Indonesia', 90, NULL, NULL),
('USK0051', 'USR0020', 'komunikasi', 80, NULL, NULL),
('USK0052', 'USR0020', 'css', 68, NULL, NULL),
('USK0053', 'USR0019', 'mysql', 80, NULL, NULL),
('USK0054', 'USR0019', 'C#', 50, NULL, NULL),
('USK0055', 'USR0019', 'C++', 80, NULL, NULL),
('USK0056', 'USR0019', 'excel', 50, NULL, NULL),
('USK0057', 'USR0018', 'mysql', 80, NULL, NULL),
('USK0058', 'USR0018', 'java', 70, NULL, NULL),
('USK0059', 'USR0018', 'word', 70, NULL, NULL),
('USK0060', 'USR0018', 'phyton', 60, NULL, NULL),
('USK0061', 'USR0017', 'sql', 75, NULL, NULL),
('USK0062', 'USR0017', 'java', 80, NULL, NULL),
('USK0063', 'USR0017', 'C#', 90, NULL, NULL),
('USK0064', 'USR0017', 'komunikasi', 70, NULL, NULL),
('USK0065', 'USR0016', 'sql', 70, NULL, NULL),
('USK0066', 'USR0016', 'c++', 68, NULL, NULL),
('USK0067', 'USR0016', 'Java', 78, NULL, NULL),
('USK0068', 'USR0016', 'komunikasi', 90, NULL, NULL),
('USK0069', 'USR0015', 'C#', 80, NULL, NULL),
('USK0070', 'USR0015', 'php', 70, NULL, NULL),
('USK0071', 'USR0015', 'komunikasi', 85, NULL, NULL),
('USK0072', 'USR0015', 'marketing', 68, NULL, NULL),
('USK0073', 'USR0014', 'mysql', 70, NULL, NULL),
('USK0074', 'USR0014', 'php', 80, NULL, NULL),
('USK0075', 'USR0014', 'SQL', 70, NULL, NULL),
('USK0076', 'USR0014', 'BAHASA INDONESIA', 50, NULL, NULL),
('USK0077', 'USR0013', 'mysql', 75, NULL, NULL),
('USK0078', 'USR0013', 'PHP', 80, NULL, NULL),
('USK0079', 'USR0013', 'C#', 75, NULL, NULL),
('USK0080', 'USR0013', 'BAHASA INDONESIA', 80, NULL, NULL),
('USK0081', 'USR0012', 'mysql', 80, NULL, NULL),
('USK0082', 'USR0012', 'PHP', 75, NULL, NULL),
('USK0083', 'USR0012', 'Bahasa Inggris', 80, NULL, NULL),
('USK0084', 'USR0012', 'excel', 73, NULL, NULL),
('USK0085', 'USR0011', 'marketing', 70, NULL, NULL),
('USK0086', 'USR0011', 'sql', 70, NULL, NULL),
('USK0087', 'USR0011', 'java', 80, NULL, NULL),
('USK0088', 'USR0011', 'mysql', 78, NULL, NULL),
('USK0089', 'USR0010', 'mysql', 80, NULL, NULL),
('USK0090', 'USR0010', 'excel', 90, NULL, NULL),
('USK0091', 'USR0010', 'sql', 64, NULL, NULL),
('USK0092', 'USR0010', 'java', 80, NULL, NULL),
('USK0093', 'USR0009', 'mysql', 80, NULL, NULL),
('USK0094', 'USR0009', 'PHP', 87, NULL, NULL),
('USK0095', 'USR0009', 'CSS', 90, NULL, NULL),
('USK0096', 'USR0009', 'TEAM WORK', 70, NULL, NULL),
('USK0097', 'USR0008', 'mysql', 89, NULL, NULL),
('USK0098', 'USR0008', 'excel', 81, NULL, NULL),
('USK0099', 'USR0008', 'team work', 70, NULL, NULL),
('USK0100', 'USR0008', 'java', 65, NULL, NULL),
('USK0101', 'USR0007', 'mysql', 80, NULL, NULL),
('USK0102', 'USR0007', 'excel', 80, NULL, NULL),
('USK0103', 'USR0007', 'java', 87, NULL, NULL),
('USK0104', 'USR0007', 'team work', 90, NULL, NULL),
('USK0105', 'USR0006', 'mysql', 78, NULL, NULL),
('USK0106', 'USR0006', 'php', 50, NULL, NULL),
('USK0107', 'USR0006', 'marketing', 80, NULL, NULL),
('USK0108', 'USR0006', 'java', 60, NULL, NULL),
('USK0109', 'USR0005', 'Interview', 80, NULL, NULL),
('USK0110', 'USR0005', 'Open Minded', 90, NULL, NULL),
('USK0111', 'USR0005', 'php', 50, NULL, NULL),
('USK0112', 'USR0005', 'java', 36, NULL, NULL),
('USK0113', 'USR0031', 'PHP', 80, NULL, NULL),
('USK0114', 'USR0031', 'Video editing', 90, NULL, NULL),
('USK0115', 'USR0004', 'HTML', 90, NULL, NULL),
('USK0116', 'USR0004', 'JS', 80, NULL, NULL),
('USK0117', 'USR0004', 'Menyanyi', 80, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicant`
--
ALTER TABLE `applicant`
  ADD PRIMARY KEY (`applicant_id`),
  ADD KEY `applicant_job_id_foreign` (`job_id`),
  ADD KEY `applicant_user_id_foreign` (`user_id`),
  ADD KEY `applicant_recruiter_id_foreign` (`recruiter_id`);

--
-- Indexes for table `application_progress`
--
ALTER TABLE `application_progress`
  ADD PRIMARY KEY (`application_progress_id`),
  ADD KEY `application_progress_job_id_foreign` (`job_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `document_document_type_id_foreign` (`document_type_id`);

--
-- Indexes for table `document_type`
--
ALTER TABLE `document_type`
  ADD PRIMARY KEY (`document_type_id`);

--
-- Indexes for table `interview`
--
ALTER TABLE `interview`
  ADD PRIMARY KEY (`interview_id`),
  ADD KEY `interview_interviewer_id_foreign` (`interviewer_id`),
  ADD KEY `interview_applicant_id_foreign` (`applicant_id`);

--
-- Indexes for table `interview_type`
--
ALTER TABLE `interview_type`
  ADD PRIMARY KEY (`interview_type_id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `job_department_id_foreign` (`department_id`);

--
-- Indexes for table `job_skill`
--
ALTER TABLE `job_skill`
  ADD PRIMARY KEY (`job_skill_id`),
  ADD KEY `job_skill_job_id_foreign` (`job_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `message_from_foreign` (`from`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD UNIQUE KEY `role_role_id_unique` (`role_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `task_user_id_foreign` (`user_id`);

--
-- Indexes for table `technical_test`
--
ALTER TABLE `technical_test`
  ADD PRIMARY KEY (`technical_test_id`),
  ADD KEY `technical_test_applicant_id_foreign` (`applicant_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_education`
--
ALTER TABLE `user_education`
  ADD PRIMARY KEY (`user_education_id`),
  ADD KEY `user_education_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_experience`
--
ALTER TABLE `user_experience`
  ADD PRIMARY KEY (`user_experience_id`),
  ADD KEY `user_experience_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_skill`
--
ALTER TABLE `user_skill`
  ADD PRIMARY KEY (`user_skill_id`),
  ADD KEY `user_skill_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicant`
--
ALTER TABLE `applicant`
  ADD CONSTRAINT `applicant_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `applicant_recruiter_id_foreign` FOREIGN KEY (`recruiter_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `applicant_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `application_progress`
--
ALTER TABLE `application_progress`
  ADD CONSTRAINT `application_progress_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`) ON DELETE CASCADE;

--
-- Constraints for table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `document_document_type_id_foreign` FOREIGN KEY (`document_type_id`) REFERENCES `document_type` (`document_type_id`) ON DELETE CASCADE;

--
-- Constraints for table `interview`
--
ALTER TABLE `interview`
  ADD CONSTRAINT `interview_applicant_id_foreign` FOREIGN KEY (`applicant_id`) REFERENCES `applicant` (`applicant_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `interview_interviewer_id_foreign` FOREIGN KEY (`interviewer_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `job_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON DELETE CASCADE;

--
-- Constraints for table `job_skill`
--
ALTER TABLE `job_skill`
  ADD CONSTRAINT `job_skill_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`) ON DELETE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_from_foreign` FOREIGN KEY (`from`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `technical_test`
--
ALTER TABLE `technical_test`
  ADD CONSTRAINT `technical_test_applicant_id_foreign` FOREIGN KEY (`applicant_id`) REFERENCES `applicant` (`applicant_id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE SET NULL;

--
-- Constraints for table `user_education`
--
ALTER TABLE `user_education`
  ADD CONSTRAINT `user_education_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_experience`
--
ALTER TABLE `user_experience`
  ADD CONSTRAINT `user_experience_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_skill`
--
ALTER TABLE `user_skill`
  ADD CONSTRAINT `user_skill_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
