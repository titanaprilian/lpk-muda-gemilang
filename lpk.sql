-- MySQL dump 10.13  Distrib 8.0.44, for Linux (x86_64)
--
-- Host: localhost    Database: laravel_lpk
-- ------------------------------------------------------
-- Server version	8.0.44-0ubuntu0.24.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `announcement`
--

DROP TABLE IF EXISTS `announcement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `announcement` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_by` bigint unsigned NOT NULL,
  `publish_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `announcement_published_by_foreign` (`published_by`),
  CONSTRAINT `announcement_published_by_foreign` FOREIGN KEY (`published_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcement`
--

LOCK TABLES `announcement` WRITE;
/*!40000 ALTER TABLE `announcement` DISABLE KEYS */;
/*!40000 ALTER TABLE `announcement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faq`
--

DROP TABLE IF EXISTS `faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faq` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT '1',
  `display_order` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faq`
--

LOCK TABLES `faq` WRITE;
/*!40000 ALTER TABLE `faq` DISABLE KEYS */;
/*!40000 ALTER TABLE `faq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_image`
--

DROP TABLE IF EXISTS `gallery_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery_image` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Path to the stored image',
  `title` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_public` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Display Control',
  `uploaded_by` bigint unsigned DEFAULT NULL,
  `upload_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `gallery_image_uploaded_by_foreign` (`uploaded_by`),
  CONSTRAINT `gallery_image_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_image`
--

LOCK TABLES `gallery_image` WRITE;
/*!40000 ALTER TABLE `gallery_image` DISABLE KEYS */;
/*!40000 ALTER TABLE `gallery_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_09_02_075243_add_two_factor_columns_to_users_table',1),(5,'2025_12_10_234248_add_role_and_last_login',1),(6,'2025_12_10_234436_create_program_table',1),(7,'2025_12_10_234527_create_registrant_table',1),(8,'2025_12_10_234653_create_uploaded_document_table',1),(9,'2025_12_10_234928_create_gallery_image_table',1),(10,'2025_12_10_235033_create_faq_table',1),(11,'2025_12_10_235037_create_testimonial_table',1),(12,'2025_12_10_235041_create_announcement_table',1),(13,'2025_12_24_024324_drop_registration_number_from_registrant_table',1),(14,'2025_12_30_014018_add_documents_to_registrant_table',1),(15,'2025_12_30_074451_alter_programs_table_for_cms_style',1),(16,'2025_12_30_080508_add_subtitle_and_icon_to_programs_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program`
--

DROP TABLE IF EXISTS `program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `program` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `program_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nama Program',
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bi-collection',
  `description` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `program_program_name_unique` (`program_name`),
  UNIQUE KEY `program_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program`
--

LOCK TABLES `program` WRITE;
/*!40000 ALTER TABLE `program` DISABLE KEYS */;
INSERT INTO `program` VALUES (1,'Program Magang','Internship Jepang (Jisshusei)','program-magang','assets/img/programs/magang.jpg','bi-bounding-box-circles','Menyediakan kesempatan bagi peserta untuk mendapatkan pengalaman kerja langsung di perusahaan Jepang.','\n                    <h3>Program Pemagangan ke Jepang</h3>\n                    <p>Program ini bertujuan untuk meningkatkan keterampilan teknis peserta melalui praktik kerja langsung di Jepang selama 3 tahun.</p>\n                    \n                    <h4>Fasilitas:</h4>\n                    <ul>\n                        <li>Asrama di Jepang</li>\n                        <li>Asuransi Kesehatan</li>\n                        <li>Gaji standar Jepang</li>\n                    </ul>\n\n                    <h4>Persyaratan:</h4>\n                    <ul>\n                        <li>Usia 18-26 Tahun</li>\n                        <li>Minimal lulusan SMA/SMK Sederajat</li>\n                        <li>Sehat Jasmani dan Rohani</li>\n                        <li>Tidak buta warna</li>\n                    </ul>\n                ',1,'2025-12-30 01:18:09','2025-12-30 01:18:09'),(2,'Tokutei Ginou','Specified Skilled Worker','tokutei-ginou','assets/img/programs/tokutei.jpg','bi-collection','Membantu peserta yang telah memiliki pengalaman dan kemampuan kerja agar dapat bekerja di Jepang secara legal.','\n                    <h3>Program Tokutei Ginou (SSW)</h3>\n                    <p>Visa kerja khusus bagi tenaga kerja asing yang memiliki keahlian spesifik di bidang tertentu. Program ini memungkinkan Anda bekerja hingga 5 tahun di Jepang.</p>\n                    \n                    <h4>Bidang Pekerjaan:</h4>\n                    <ul>\n                        <li>Caregiver (Perawat Lansia)</li>\n                        <li>Pertanian</li>\n                        <li>Konstruksi</li>\n                        <li>Pengolahan Makanan</li>\n                    </ul>\n\n                    <h4>Persyaratan:</h4>\n                    <ul>\n                        <li>Usia 18-35 Tahun</li>\n                        <li>Memiliki sertifikat bahasa Jepang (JLPT N4 / JFT Basic A2)</li>\n                        <li>Memiliki sertifikat skill (SSW) sesuai bidang</li>\n                    </ul>\n                ',1,'2025-12-30 01:18:09','2025-12-30 01:18:09'),(3,'IM Japan','Independent Member of Japan','im-japan','assets/img/programs/tokutei.jpg','bi-calendar4-week','Memberikan kesempatan bagi peserta untuk bekerja dan tinggal di Jepang secara mandiri dengan dukungan dari LPK.','\n                    <h3>Program IM Japan</h3>\n                    <p>Memberikan kesempatan bagi peserta untuk bekerja dan tinggal di Jepang secara mandiri dengan dukungan dari LPK.</p>\n\n                    <h4>Bidang Pekerjaan:</h4>\n                    <ul>\n                        <li>Caregiver (Perawat Lansia)</li>\n                        <li>Pertanian</li>\n                        <li>Konstruksi</li>\n                        <li>Pengolahan Makanan</li>\n                    </ul>\n\n                    <h4>Persyaratan:</h4>\n                    <ul>\n                        <li>Usia 18-35 Tahun</li>\n                        <li>Memiliki sertifikat bahasa Jepang (JLPT N4 / JFT Basic A2)</li>\n                        <li>Memiliki sertifikat skill (SSW) sesuai bidang</li>\n                    </ul>\n                ',1,'2025-12-30 01:18:09','2025-12-30 01:18:09');
/*!40000 ALTER TABLE `program` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registrant`
--

DROP TABLE IF EXISTS `registrant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registrant` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `program_id` bigint unsigned NOT NULL,
  `full_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_place` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `age` int DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Pria/Wanita',
  `address` text COLLATE utf8mb4_unicode_ci,
  `origin_school` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Phone/WhatsApp',
  `parent_guardian_phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hobby` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height_cm` int DEFAULT NULL COMMENT 'Tinggi Badan',
  `weight_kg` int DEFAULT NULL COMMENT 'Berat Badan',
  `work_experience` text COLLATE utf8mb4_unicode_ci COMMENT 'Pengalaman Kerja',
  `registration_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `scan_ktp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scan_kk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scan_akta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scan_ijazah_sd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scan_ijazah_smp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `registrant_program_id_foreign` (`program_id`),
  CONSTRAINT `registrant_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registrant`
--

LOCK TABLES `registrant` WRITE;
/*!40000 ALTER TABLE `registrant` DISABLE KEYS */;
INSERT INTO `registrant` VALUES (2,1,'Spongebob Squarepants','Bikini Bottom',NULL,26,'Laki-laki','Jl. Bikini Bottom No.10','SMAN 1 Bikini Bottom','089988776655','089988776655','spongebobsquarepants@bikinibottom.com','Memasak',155,44,'Chef Krusty Krab','2025-12-30 12:17:48','Verified',NULL,'documents/POyEKYEVuGmiofwZLWCVRvXytTnYu2Dz4MXg1ZGi.png','documents/TnGLbTJmWMKVvTflYlcmK2e3dJuo90V7v0Eozef0.png','documents/OaxkqrTHkduwkzgrlh9CHISIoprziJQ8beTMMHqZ.png','documents/M0pOqOPQ6nF8gpdZ07nGrPjd6hknfvvzOJarvl4B.png','documents/iarGmsz3fHQcVqINfmtxoo4SBxwxILt4zG8JuhWH.pdf');
/*!40000 ALTER TABLE `registrant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('3uqGN3cKhwcMVsMuGX7D36AWCb8xI1bQ5dp3I4br',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiY0xnM3VvV3FmYkt3eGZUekhmVXpvVHZmdlVTOU9JYUlQanNMdUdObSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9sb2dpbiI7czo1OiJyb3V0ZSI7czoxMToiYWRtaW4ubG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1767161029),('bvflAp5ppxUFq6jRUBWoodyCoyYVo2nDlKLjNnyL',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoieTVHbjZrSkQxS2c2MnBNVTR4RUcyMWtFbVRCZFF3ckxFODZoOU1nVyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly83YWI2ZDYzMmZmNzkubmdyb2stZnJlZS5hcHAvYWRtaW4vbG9naW4iO3M6NToicm91dGUiO3M6MTE6ImFkbWluLmxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1MDoiaHR0cDovLzdhYjZkNjMyZmY3OS5uZ3Jvay1mcmVlLmFwcC9hZG1pbi9kYXNoYm9hcmQiO319',1767161451),('iiHtEjRD5gbyucVkgGGjmAsR7S3NxILKoeVkDGog',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRWNFeWZPM0JhSGR0RUlZYTJWQjRQMmh4V1k3OTZtM09FcDNvRzV1ZiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9sb2dpbiI7czo1OiJyb3V0ZSI7czoxMToiYWRtaW4ubG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1767161611),('jDF4Q2zsuOoPWpRAKJTgEg9is0fM2AhbEcmhg8Dj',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaDg4RVR3R3FISnZpSzBjcVNBVTJCaWgxMXJuVW5xRGNldzhhZ0JPMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9sb2dpbiI7czo1OiJyb3V0ZSI7czoxMToiYWRtaW4ubG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1767161454),('Kf9E5DtpyLTfDBNhlkUjCKlMmPZDVjyYDQfdarQc',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRklqSDczdUxIeFpUTWtkYWFTeU5rNUNNT0ZoWXdCS1E5dnV5a1dkdyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2FkbWluL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMzOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRtaW4vbG9naW4iO3M6NToicm91dGUiO3M6MTE6ImFkbWluLmxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1767161617),('sKczcE7FxK4FP2TidJIbAXiMvWnGbPJ1C97Akgp5',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQTZyM2I5cm9qV0t0Z2RTRHoxWnZ4SWlLZ1lUMkRPd3FwNE94ZGRmQiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMzOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRtaW4vbG9naW4iO3M6NToicm91dGUiO3M6MTE6ImFkbWluLmxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1767161614),('vs0HVEvsSlD1X9ukQA5SaU1hNVqFfPxL9YDvCacf',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNVVwZHU0V2J1a2pDTUU5QVpOa0ljN2RsZ3JQSjJJMWJ6bXRiOG5USiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMzOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRtaW4vbG9naW4iO3M6NToicm91dGUiO3M6MTE6ImFkbWluLmxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1767161615),('Wtj8wFk95Fh5pIIAc0s4LKare5eAhBuGCJGC5keV',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUWtmdzcyN0tpdThGYUdsNWRNalVuNVR5SGl1b01Fdkx2MFBtYnRoaSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMzOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRtaW4vbG9naW4iO3M6NToicm91dGUiO3M6MTE6ImFkbWluLmxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1767161617),('XfO2XcATIEi0oPwkWz3EtQUxtL4uRoNqe7M1LWgN',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYXVpcUR1YnpvajVrS0RzNDBVdjVwVlM3OVpZTXNnRmh1eXBGbzVqMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly83YWI2ZDYzMmZmNzkubmdyb2stZnJlZS5hcHAvYWRtaW4vbG9naW4iO3M6NToicm91dGUiO3M6MTE6ImFkbWluLmxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1767160804);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonial`
--

DROP TABLE IF EXISTS `testimonial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonial` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `alumni_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_taken` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `display_order` int DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonial`
--

LOCK TABLES `testimonial` WRITE;
/*!40000 ALTER TABLE `testimonial` DISABLE KEYS */;
/*!40000 ALTER TABLE `testimonial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uploaded_document`
--

DROP TABLE IF EXISTS `uploaded_document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `uploaded_document` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `registrant_id` bigint unsigned NOT NULL,
  `document_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'e.g., KTP, Ijazah, Photo',
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Path to stored file in Laravel storage',
  `file_mime_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upload_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `uploaded_document_registrant_id_foreign` (`registrant_id`),
  CONSTRAINT `uploaded_document_registrant_id_foreign` FOREIGN KEY (`registrant_id`) REFERENCES `registrant` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uploaded_document`
--

LOCK TABLES `uploaded_document` WRITE;
/*!40000 ALTER TABLE `uploaded_document` DISABLE KEYS */;
/*!40000 ALTER TABLE `uploaded_document` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Staff',
  `last_login` datetime DEFAULT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Super Admin','admin@muda.gemilang','2025-12-30 01:18:09','$2y$12$ylmXdJzurQ65lHSBLa7HIu/Q6SvlUQpbvJ9BR1cOWksiWIiJ1Cy6q','Admin',NULL,NULL,NULL,NULL,'6OE2DwcMSyow1HtFiXbsxb7t9SXSbNlcY9IAuKcOuhzNNzhwt5G59vdciShV','2025-12-30 01:18:09','2025-12-30 01:18:09');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-12-31 15:43:13
