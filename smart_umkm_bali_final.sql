-- MySQL dump 10.13  Distrib 8.0.44, for macos15 (arm64)
--
-- Host: localhost    Database: smart_umkm_bali
-- ------------------------------------------------------
-- Server version	8.0.44

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
-- Table structure for table `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_logs_store_id_foreign` (`store_id`),
  KEY `activity_logs_user_id_foreign` (`user_id`),
  CONSTRAINT `activity_logs_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE,
  CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_logs`
--

LOCK TABLES `activity_logs` WRITE;
/*!40000 ALTER TABLE `activity_logs` DISABLE KEYS */;
INSERT INTO `activity_logs` VALUES (1,NULL,2,'login','User login ke sistem','2026-06-19 07:48:44','2026-06-19 07:48:44'),(2,NULL,3,'login','User login ke sistem','2026-06-19 07:48:44','2026-06-19 07:48:44'),(3,NULL,3,'login','User login ke sistem','2026-06-19 07:48:46','2026-06-19 07:48:46'),(4,NULL,3,'login','User login ke sistem','2026-06-19 07:48:47','2026-06-19 07:48:47'),(5,NULL,3,'login','User login ke sistem','2026-06-19 07:48:48','2026-06-19 07:48:48'),(6,NULL,3,'login','User login ke sistem','2026-06-19 07:48:48','2026-06-19 07:48:48'),(7,NULL,2,'login','User login ke sistem','2026-06-19 07:48:50','2026-06-19 07:48:50'),(8,NULL,2,'login','User login ke sistem','2026-06-19 07:48:52','2026-06-19 07:48:52'),(9,NULL,2,'login','User login ke sistem','2026-06-19 07:48:53','2026-06-19 07:48:53'),(10,NULL,2,'login','User login ke sistem','2026-06-19 07:48:54','2026-06-19 07:48:54'),(11,NULL,2,'logout','User logout dari sistem','2026-06-19 07:48:55','2026-06-19 07:48:55'),(12,NULL,2,'login','User login ke sistem','2026-06-19 07:48:55','2026-06-19 07:48:55'),(13,NULL,2,'login','User login ke sistem','2026-06-19 07:48:55','2026-06-19 07:48:55'),(14,1,4,'login','User login ke sistem','2026-06-19 07:48:57','2026-06-19 07:48:57'),(15,1,4,'login','User login ke sistem','2026-06-19 07:48:58','2026-06-19 07:48:58'),(16,1,4,'login','User login ke sistem','2026-06-19 07:49:01','2026-06-19 07:49:01'),(17,NULL,1,'login','User login ke sistem','2026-06-19 07:49:03','2026-06-19 07:49:03'),(18,NULL,1,'login','User login ke sistem','2026-06-19 07:49:04','2026-06-19 07:49:04'),(19,NULL,1,'login','User login ke sistem','2026-06-19 07:49:05','2026-06-19 07:49:05'),(20,NULL,3,'login','User login ke sistem','2026-06-19 07:49:06','2026-06-19 07:49:06'),(21,NULL,3,'login','User login ke sistem','2026-06-19 07:49:07','2026-06-19 07:49:07'),(22,NULL,2,'login','User login ke sistem','2026-06-19 07:49:08','2026-06-19 07:49:08'),(23,NULL,3,'login','User login ke sistem','2026-06-19 07:49:08','2026-06-19 07:49:08'),(24,NULL,2,'login','User login ke sistem','2026-06-19 07:49:08','2026-06-19 07:49:08'),(25,1,4,'login','User login ke sistem','2026-06-19 07:49:10','2026-06-19 07:49:10'),(26,NULL,5,'login','User login ke sistem','2026-06-19 07:49:11','2026-06-19 07:49:11'),(27,1,4,'login','User login ke sistem','2026-06-19 07:49:12','2026-06-19 07:49:12'),(28,NULL,3,'login','User login ke sistem','2026-06-19 07:49:13','2026-06-19 07:49:13'),(29,NULL,3,'login','User login ke sistem','2026-06-19 07:49:13','2026-06-19 07:49:13'),(30,NULL,2,'login','User login ke sistem','2026-06-19 07:49:14','2026-06-19 07:49:14'),(31,NULL,1,'login','User login ke sistem','2026-06-19 07:49:14','2026-06-19 07:49:14'),(32,NULL,2,'logout','User logout dari sistem','2026-06-19 07:49:15','2026-06-19 07:49:15'),(33,NULL,2,'login','User login ke sistem','2026-06-19 07:49:19','2026-06-19 07:49:19'),(34,NULL,1,'login','User login ke sistem','2026-06-19 07:49:20','2026-06-19 07:49:20'),(35,NULL,1,'login','User login ke sistem','2026-06-19 07:49:22','2026-06-19 07:49:22'),(36,NULL,6,'login','User login ke sistem','2026-06-19 07:49:22','2026-06-19 07:49:22'),(37,NULL,2,'login','User login ke sistem','2026-06-19 07:49:23','2026-06-19 07:49:23'),(38,NULL,2,'login','User login ke sistem','2026-06-19 07:49:56','2026-06-19 07:49:56'),(39,NULL,3,'login','User login ke sistem','2026-06-19 07:49:56','2026-06-19 07:49:56'),(40,NULL,3,'login','User login ke sistem','2026-06-19 07:50:47','2026-06-19 07:50:47'),(41,NULL,2,'login','User login ke sistem','2026-06-19 07:50:47','2026-06-19 07:50:47'),(42,NULL,3,'login','User login ke sistem','2026-06-19 07:50:49','2026-06-19 07:50:49'),(43,NULL,3,'login','User login ke sistem','2026-06-19 07:50:50','2026-06-19 07:50:50'),(44,NULL,3,'login','User login ke sistem','2026-06-19 07:50:51','2026-06-19 07:50:51'),(45,NULL,3,'login','User login ke sistem','2026-06-19 07:50:52','2026-06-19 07:50:52'),(46,NULL,2,'login','User login ke sistem','2026-06-19 07:50:54','2026-06-19 07:50:54'),(47,NULL,2,'login','User login ke sistem','2026-06-19 07:50:55','2026-06-19 07:50:55'),(48,NULL,2,'login','User login ke sistem','2026-06-19 07:50:56','2026-06-19 07:50:56'),(49,NULL,2,'login','User login ke sistem','2026-06-19 07:50:57','2026-06-19 07:50:57'),(50,NULL,2,'logout','User logout dari sistem','2026-06-19 07:50:57','2026-06-19 07:50:57'),(51,NULL,2,'login','User login ke sistem','2026-06-19 07:50:58','2026-06-19 07:50:58'),(52,NULL,2,'login','User login ke sistem','2026-06-19 07:50:59','2026-06-19 07:50:59'),(53,1,4,'login','User login ke sistem','2026-06-19 07:51:01','2026-06-19 07:51:01'),(54,1,4,'login','User login ke sistem','2026-06-19 07:51:03','2026-06-19 07:51:03'),(55,1,4,'login','User login ke sistem','2026-06-19 07:51:04','2026-06-19 07:51:04'),(56,NULL,1,'login','User login ke sistem','2026-06-19 07:51:07','2026-06-19 07:51:07'),(57,NULL,1,'login','User login ke sistem','2026-06-19 07:51:08','2026-06-19 07:51:08'),(58,NULL,1,'login','User login ke sistem','2026-06-19 07:51:09','2026-06-19 07:51:09'),(59,NULL,3,'login','User login ke sistem','2026-06-19 07:51:11','2026-06-19 07:51:11'),(60,NULL,3,'login','User login ke sistem','2026-06-19 07:51:11','2026-06-19 07:51:11'),(61,NULL,2,'login','User login ke sistem','2026-06-19 07:51:12','2026-06-19 07:51:12'),(62,NULL,3,'login','User login ke sistem','2026-06-19 07:51:12','2026-06-19 07:51:12'),(63,NULL,2,'login','User login ke sistem','2026-06-19 07:51:12','2026-06-19 07:51:12'),(64,1,4,'login','User login ke sistem','2026-06-19 07:51:13','2026-06-19 07:51:13'),(65,NULL,7,'login','User login ke sistem','2026-06-19 07:51:14','2026-06-19 07:51:14'),(66,NULL,3,'login','User login ke sistem','2026-06-19 07:51:15','2026-06-19 07:51:15'),(67,1,4,'login','User login ke sistem','2026-06-19 07:51:15','2026-06-19 07:51:15'),(68,NULL,3,'login','User login ke sistem','2026-06-19 07:51:16','2026-06-19 07:51:16'),(69,NULL,2,'login','User login ke sistem','2026-06-19 07:51:17','2026-06-19 07:51:17'),(70,NULL,1,'login','User login ke sistem','2026-06-19 07:51:17','2026-06-19 07:51:17'),(71,NULL,2,'logout','User logout dari sistem','2026-06-19 07:51:18','2026-06-19 07:51:18'),(72,NULL,2,'login','User login ke sistem','2026-06-19 07:51:21','2026-06-19 07:51:21'),(73,NULL,1,'login','User login ke sistem','2026-06-19 07:51:23','2026-06-19 07:51:23'),(74,NULL,1,'login','User login ke sistem','2026-06-19 07:51:25','2026-06-19 07:51:25'),(75,NULL,2,'login','User login ke sistem','2026-06-19 07:51:25','2026-06-19 07:51:25'),(76,NULL,8,'login','User login ke sistem','2026-06-19 07:51:26','2026-06-19 07:51:26');
/*!40000 ALTER TABLE `activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_categories`
--

DROP TABLE IF EXISTS `article_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `article_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `article_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_categories`
--

LOCK TABLES `article_categories` WRITE;
/*!40000 ALTER TABLE `article_categories` DISABLE KEYS */;
INSERT INTO `article_categories` VALUES (1,'Budaya','budaya',NULL,'2026-06-19 07:48:12','2026-06-19 07:48:12'),(2,'Bisnis','bisnis',NULL,'2026-06-19 07:48:12','2026-06-19 07:48:12'),(3,'Inovasi','inovasi',NULL,'2026-06-19 07:48:12','2026-06-19 07:48:12');
/*!40000 ALTER TABLE `article_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_store`
--

DROP TABLE IF EXISTS `article_store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `article_store` (
  `article_id` bigint unsigned NOT NULL,
  `store_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`article_id`,`store_id`),
  KEY `article_store_store_id_foreign` (`store_id`),
  CONSTRAINT `article_store_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `article_store_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_store`
--

LOCK TABLES `article_store` WRITE;
/*!40000 ALTER TABLE `article_store` DISABLE KEYS */;
/*!40000 ALTER TABLE `article_store` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `articles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `article_category_id` bigint unsigned DEFAULT NULL,
  `author_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('draft','published') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `articles_slug_unique` (`slug`),
  KEY `articles_article_category_id_foreign` (`article_category_id`),
  KEY `articles_author_id_foreign` (`author_id`),
  KEY `idx_articles_status` (`status`),
  CONSTRAINT `articles_article_category_id_foreign` FOREIGN KEY (`article_category_id`) REFERENCES `article_categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `articles_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,1,1,'Filosofi Tridatu pada Kerajinan Perak Bali','filosofi-tridatu-kerajinan-perak-bali','Mengapa benang tiga warna sangat sakral bagi masyarakat Bali dan bagaimana hal ini diadaptasi ke perhiasan.','Tridatu terdiri dari tiga warna yaitu Merah, Putih, dan Hitam. Dalam pembuatan perhiasan perak di Desa Celuk, elemen tridatu ini...',NULL,'published','2026-06-19 07:48:14',NULL,NULL,'2026-06-19 07:48:14','2026-06-19 07:48:14',NULL),(2,3,1,'Transformasi Digital Kopi Kintamani','transformasi-digital-kopi-kintamani','Petani Kopi Kintamani kini memanfaatkan teknologi IoT untuk memantau kelembaban biji kopi.','Melalui platform Smart UMKM Bali, petani lokal...',NULL,'published','2026-06-19 07:48:14',NULL,NULL,'2026-06-19 07:48:14','2026-06-19 07:48:14',NULL);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
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
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('smart-umkm-bali-cache-admin_dashboard_stats','a:4:{s:11:\"total_users\";i:4;s:12:\"total_stores\";i:2;s:14:\"total_products\";i:9;s:18:\"active_suspensions\";i:0;}',1781885043),('smart-umkm-bali-cache-store_1_dashboard_data','a:16:{s:5:\"store\";O:16:\"App\\Models\\Store\":35:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"stores\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:12:{s:2:\"id\";i:1;s:7:\"user_id\";i:2;s:4:\"name\";s:22:\"Warung Kopi Bali Wayan\";s:4:\"slug\";s:22:\"warung-kopi-bali-wayan\";s:8:\"category\";N;s:17:\"store_category_id\";i:1;s:7:\"contact\";s:12:\"081234567890\";s:7:\"address\";s:35:\"Jl. Raya Ubud No. 23, Gianyar, Bali\";s:11:\"description\";s:134:\"Warung kopi tradisional Bali dengan sentuhan modern, menyajikan kopi khas Kintamani dan makanan ringan lokal dengan cita rasa otentik.\";s:10:\"created_at\";s:19:\"2026-06-19 15:48:13\";s:10:\"updated_at\";s:19:\"2026-06-19 15:48:13\";s:10:\"deleted_at\";N;}s:11:\"\0*\0original\";a:12:{s:2:\"id\";i:1;s:7:\"user_id\";i:2;s:4:\"name\";s:22:\"Warung Kopi Bali Wayan\";s:4:\"slug\";s:22:\"warung-kopi-bali-wayan\";s:8:\"category\";N;s:17:\"store_category_id\";i:1;s:7:\"contact\";s:12:\"081234567890\";s:7:\"address\";s:35:\"Jl. Raya Ubud No. 23, Gianyar, Bali\";s:11:\"description\";s:134:\"Warung kopi tradisional Bali dengan sentuhan modern, menyajikan kopi khas Kintamani dan makanan ringan lokal dengan cita rasa otentik.\";s:10:\"created_at\";s:19:\"2026-06-19 15:48:13\";s:10:\"updated_at\";s:19:\"2026-06-19 15:48:13\";s:10:\"deleted_at\";N;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:8:{i:0;s:7:\"user_id\";i:1;s:4:\"name\";i:2;s:4:\"slug\";i:3;s:8:\"category\";i:4;s:17:\"store_category_id\";i:5;s:7:\"contact\";i:6;s:7:\"address\";i:7;s:11:\"description\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;s:16:\"\0*\0scoutMetadata\";a:0:{}}s:13:\"totalProducts\";i:5;s:16:\"lowStockProducts\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:17:\"todayTransactions\";i:1;s:12:\"todayRevenue\";s:9:\"130000.00\";s:12:\"monthRevenue\";s:10:\"8146000.00\";s:11:\"monthProfit\";s:10:\"3258400.00\";s:11:\"topProducts\";O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:5:{i:0;O:8:\"stdClass\":2:{s:4:\"name\";s:22:\"Kacang Kapri Tari Bali\";s:14:\"total_quantity\";s:2:\"17\";}i:1;O:8:\"stdClass\":2:{s:4:\"name\";s:23:\"Kopi Arabica Plaga 200g\";s:14:\"total_quantity\";s:2:\"14\";}i:2;O:8:\"stdClass\":2:{s:4:\"name\";s:31:\"Pie Susu Bali Premium (1 Kotak)\";s:14:\"total_quantity\";s:2:\"13\";}i:3;O:8:\"stdClass\":2:{s:4:\"name\";s:22:\"Es Kopi Susu Gula Aren\";s:14:\"total_quantity\";s:2:\"11\";}i:4;O:8:\"stdClass\":2:{s:4:\"name\";s:24:\"Kopi Bali Kintamani 250g\";s:14:\"total_quantity\";s:1:\"9\";}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:12:\"slowProducts\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:10:\"busiestDay\";O:22:\"App\\Models\\Transaction\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:12:\"transactions\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:4:{s:4:\"date\";s:10:\"2026-06-16\";s:13:\"total_revenue\";s:9:\"655000.00\";s:18:\"total_transactions\";i:2;s:14:\"date_formatted\";s:14:\"Selasa, 16 Jun\";}s:11:\"\0*\0original\";a:3:{s:4:\"date\";s:10:\"2026-06-16\";s:13:\"total_revenue\";s:9:\"655000.00\";s:18:\"total_transactions\";i:2;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:12:\"total_amount\";s:9:\"decimal:2\";s:10:\"total_cost\";s:9:\"decimal:2\";s:14:\"payment_amount\";s:9:\"decimal:2\";s:13:\"change_amount\";s:9:\"decimal:2\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:8:{i:0;s:8:\"store_id\";i:1;s:7:\"user_id\";i:2;s:14:\"invoice_number\";i:3;s:12:\"total_amount\";i:4;s:10:\"total_cost\";i:5;s:14:\"payment_amount\";i:6;s:13:\"change_amount\";i:7;s:5:\"notes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:9:\"chartData\";a:3:{s:6:\"labels\";a:7:{i:0;s:6:\"13 Jun\";i:1;s:6:\"14 Jun\";i:2;s:6:\"15 Jun\";i:3;s:6:\"16 Jun\";i:4;s:6:\"17 Jun\";i:5;s:6:\"18 Jun\";i:6;s:6:\"19 Jun\";}s:7:\"revenue\";a:7:{i:0;d:565000;i:1;d:155000;i:2;d:255000;i:3;d:655000;i:4;d:622000;i:5;d:50000;i:6;d:130000;}s:5:\"sales\";a:7:{i:0;i:3;i:1;i:1;i:2;i:1;i:3;i:2;i:4;i:3;i:5;i:1;i:6;i:1;}}s:18:\"recentTransactions\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:5:{i:0;O:22:\"App\\Models\\Transaction\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:12:\"transactions\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:65;s:8:\"store_id\";i:1;s:7:\"user_id\";i:4;s:14:\"invoice_number\";s:21:\"INV-20260619-0001-old\";s:12:\"total_amount\";s:8:\"25000.00\";s:10:\"total_cost\";s:8:\"15000.00\";s:14:\"payment_amount\";s:8:\"25000.00\";s:13:\"change_amount\";s:4:\"0.00\";s:5:\"notes\";s:12:\"Migrated POS\";s:10:\"created_at\";s:19:\"2026-06-20 12:26:14\";s:10:\"updated_at\";s:19:\"2026-06-20 10:53:14\";}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:65;s:8:\"store_id\";i:1;s:7:\"user_id\";i:4;s:14:\"invoice_number\";s:21:\"INV-20260619-0001-old\";s:12:\"total_amount\";s:8:\"25000.00\";s:10:\"total_cost\";s:8:\"15000.00\";s:14:\"payment_amount\";s:8:\"25000.00\";s:13:\"change_amount\";s:4:\"0.00\";s:5:\"notes\";s:12:\"Migrated POS\";s:10:\"created_at\";s:19:\"2026-06-20 12:26:14\";s:10:\"updated_at\";s:19:\"2026-06-20 10:53:14\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:12:\"total_amount\";s:9:\"decimal:2\";s:10:\"total_cost\";s:9:\"decimal:2\";s:14:\"payment_amount\";s:9:\"decimal:2\";s:13:\"change_amount\";s:9:\"decimal:2\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:4:\"user\";O:15:\"App\\Models\\User\":36:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:4;s:4:\"name\";s:10:\"Kadek Sari\";s:4:\"role\";s:7:\"cashier\";s:8:\"store_id\";i:1;s:5:\"email\";s:23:\"cashier@smart-umkm.test\";s:17:\"email_verified_at\";s:19:\"2026-06-19 15:48:13\";s:8:\"password\";s:60:\"$2y$12$.qUw3BG2Mf9k4WywIMOxAuoIIb3RJbVgYIDtG3VseW5vjE/c.K4tu\";s:14:\"remember_token\";N;s:10:\"created_at\";s:19:\"2026-06-19 15:48:13\";s:10:\"updated_at\";s:19:\"2026-06-19 15:48:13\";s:10:\"deleted_at\";N;}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:4;s:4:\"name\";s:10:\"Kadek Sari\";s:4:\"role\";s:7:\"cashier\";s:8:\"store_id\";i:1;s:5:\"email\";s:23:\"cashier@smart-umkm.test\";s:17:\"email_verified_at\";s:19:\"2026-06-19 15:48:13\";s:8:\"password\";s:60:\"$2y$12$.qUw3BG2Mf9k4WywIMOxAuoIIb3RJbVgYIDtG3VseW5vjE/c.K4tu\";s:14:\"remember_token\";N;s:10:\"created_at\";s:19:\"2026-06-19 15:48:13\";s:10:\"updated_at\";s:19:\"2026-06-19 15:48:13\";s:10:\"deleted_at\";N;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:3:{s:17:\"email_verified_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:4:\"name\";i:1;s:5:\"email\";i:2;s:8:\"password\";i:3;s:4:\"role\";i:4;s:8:\"store_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";s:16:\"\0*\0forceDeleting\";b:0;}s:7:\"details\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;O:28:\"App\\Models\\TransactionDetail\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:19:\"transaction_details\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:131;s:14:\"transaction_id\";i:65;s:10:\"product_id\";i:5;s:12:\"product_name\";s:22:\"Kacang Kapri Tari Bali\";s:8:\"quantity\";i:1;s:10:\"cost_price\";s:8:\"15000.00\";s:10:\"sell_price\";s:8:\"25000.00\";s:8:\"subtotal\";s:8:\"25000.00\";s:10:\"created_at\";s:19:\"2026-06-20 12:26:14\";s:10:\"updated_at\";s:19:\"2026-06-20 10:53:14\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:131;s:14:\"transaction_id\";i:65;s:10:\"product_id\";i:5;s:12:\"product_name\";s:22:\"Kacang Kapri Tari Bali\";s:8:\"quantity\";i:1;s:10:\"cost_price\";s:8:\"15000.00\";s:10:\"sell_price\";s:8:\"25000.00\";s:8:\"subtotal\";s:8:\"25000.00\";s:10:\"created_at\";s:19:\"2026-06-20 12:26:14\";s:10:\"updated_at\";s:19:\"2026-06-20 10:53:14\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:8:\"quantity\";s:7:\"integer\";s:10:\"cost_price\";s:9:\"decimal:2\";s:10:\"sell_price\";s:9:\"decimal:2\";s:8:\"subtotal\";s:9:\"decimal:2\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:14:\"transaction_id\";i:1;s:10:\"product_id\";i:2;s:12:\"product_name\";i:3;s:8:\"quantity\";i:4;s:10:\"cost_price\";i:5;s:10:\"sell_price\";i:6;s:8:\"subtotal\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:8:{i:0;s:8:\"store_id\";i:1;s:7:\"user_id\";i:2;s:14:\"invoice_number\";i:3;s:12:\"total_amount\";i:4;s:10:\"total_cost\";i:5;s:14:\"payment_amount\";i:6;s:13:\"change_amount\";i:7;s:5:\"notes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:22:\"App\\Models\\Transaction\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:12:\"transactions\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:66;s:8:\"store_id\";i:1;s:7:\"user_id\";i:4;s:14:\"invoice_number\";s:21:\"INV-20260619-0002-old\";s:12:\"total_amount\";s:9:\"157000.00\";s:10:\"total_cost\";s:8:\"94200.00\";s:14:\"payment_amount\";s:9:\"157000.00\";s:13:\"change_amount\";s:4:\"0.00\";s:5:\"notes\";s:12:\"Migrated POS\";s:10:\"created_at\";s:19:\"2026-06-20 08:57:14\";s:10:\"updated_at\";s:19:\"2026-06-20 00:44:14\";}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:66;s:8:\"store_id\";i:1;s:7:\"user_id\";i:4;s:14:\"invoice_number\";s:21:\"INV-20260619-0002-old\";s:12:\"total_amount\";s:9:\"157000.00\";s:10:\"total_cost\";s:8:\"94200.00\";s:14:\"payment_amount\";s:9:\"157000.00\";s:13:\"change_amount\";s:4:\"0.00\";s:5:\"notes\";s:12:\"Migrated POS\";s:10:\"created_at\";s:19:\"2026-06-20 08:57:14\";s:10:\"updated_at\";s:19:\"2026-06-20 00:44:14\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:12:\"total_amount\";s:9:\"decimal:2\";s:10:\"total_cost\";s:9:\"decimal:2\";s:14:\"payment_amount\";s:9:\"decimal:2\";s:13:\"change_amount\";s:9:\"decimal:2\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:4:\"user\";r:233;s:7:\"details\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:3:{i:0;O:28:\"App\\Models\\TransactionDetail\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:19:\"transaction_details\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:132;s:14:\"transaction_id\";i:66;s:10:\"product_id\";i:2;s:12:\"product_name\";s:22:\"Es Kopi Susu Gula Aren\";s:8:\"quantity\";i:1;s:10:\"cost_price\";s:8:\"13200.00\";s:10:\"sell_price\";s:8:\"22000.00\";s:8:\"subtotal\";s:8:\"22000.00\";s:10:\"created_at\";s:19:\"2026-06-20 08:57:14\";s:10:\"updated_at\";s:19:\"2026-06-20 00:44:14\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:132;s:14:\"transaction_id\";i:66;s:10:\"product_id\";i:2;s:12:\"product_name\";s:22:\"Es Kopi Susu Gula Aren\";s:8:\"quantity\";i:1;s:10:\"cost_price\";s:8:\"13200.00\";s:10:\"sell_price\";s:8:\"22000.00\";s:8:\"subtotal\";s:8:\"22000.00\";s:10:\"created_at\";s:19:\"2026-06-20 08:57:14\";s:10:\"updated_at\";s:19:\"2026-06-20 00:44:14\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:8:\"quantity\";s:7:\"integer\";s:10:\"cost_price\";s:9:\"decimal:2\";s:10:\"sell_price\";s:9:\"decimal:2\";s:8:\"subtotal\";s:9:\"decimal:2\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:14:\"transaction_id\";i:1;s:10:\"product_id\";i:2;s:12:\"product_name\";i:3;s:8:\"quantity\";i:4;s:10:\"cost_price\";i:5;s:10:\"sell_price\";i:6;s:8:\"subtotal\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:28:\"App\\Models\\TransactionDetail\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:19:\"transaction_details\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:133;s:14:\"transaction_id\";i:66;s:10:\"product_id\";i:4;s:12:\"product_name\";s:23:\"Kopi Arabica Plaga 200g\";s:8:\"quantity\";i:1;s:10:\"cost_price\";s:8:\"51000.00\";s:10:\"sell_price\";s:8:\"85000.00\";s:8:\"subtotal\";s:8:\"85000.00\";s:10:\"created_at\";s:19:\"2026-06-20 08:57:14\";s:10:\"updated_at\";s:19:\"2026-06-20 00:44:14\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:133;s:14:\"transaction_id\";i:66;s:10:\"product_id\";i:4;s:12:\"product_name\";s:23:\"Kopi Arabica Plaga 200g\";s:8:\"quantity\";i:1;s:10:\"cost_price\";s:8:\"51000.00\";s:10:\"sell_price\";s:8:\"85000.00\";s:8:\"subtotal\";s:8:\"85000.00\";s:10:\"created_at\";s:19:\"2026-06-20 08:57:14\";s:10:\"updated_at\";s:19:\"2026-06-20 00:44:14\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:8:\"quantity\";s:7:\"integer\";s:10:\"cost_price\";s:9:\"decimal:2\";s:10:\"sell_price\";s:9:\"decimal:2\";s:8:\"subtotal\";s:9:\"decimal:2\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:14:\"transaction_id\";i:1;s:10:\"product_id\";i:2;s:12:\"product_name\";i:3;s:8:\"quantity\";i:4;s:10:\"cost_price\";i:5;s:10:\"sell_price\";i:6;s:8:\"subtotal\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:28:\"App\\Models\\TransactionDetail\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:19:\"transaction_details\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:134;s:14:\"transaction_id\";i:66;s:10:\"product_id\";i:5;s:12:\"product_name\";s:22:\"Kacang Kapri Tari Bali\";s:8:\"quantity\";i:2;s:10:\"cost_price\";s:8:\"15000.00\";s:10:\"sell_price\";s:8:\"25000.00\";s:8:\"subtotal\";s:8:\"50000.00\";s:10:\"created_at\";s:19:\"2026-06-20 08:57:14\";s:10:\"updated_at\";s:19:\"2026-06-20 00:44:14\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:134;s:14:\"transaction_id\";i:66;s:10:\"product_id\";i:5;s:12:\"product_name\";s:22:\"Kacang Kapri Tari Bali\";s:8:\"quantity\";i:2;s:10:\"cost_price\";s:8:\"15000.00\";s:10:\"sell_price\";s:8:\"25000.00\";s:8:\"subtotal\";s:8:\"50000.00\";s:10:\"created_at\";s:19:\"2026-06-20 08:57:14\";s:10:\"updated_at\";s:19:\"2026-06-20 00:44:14\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:8:\"quantity\";s:7:\"integer\";s:10:\"cost_price\";s:9:\"decimal:2\";s:10:\"sell_price\";s:9:\"decimal:2\";s:8:\"subtotal\";s:9:\"decimal:2\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:14:\"transaction_id\";i:1;s:10:\"product_id\";i:2;s:12:\"product_name\";i:3;s:8:\"quantity\";i:4;s:10:\"cost_price\";i:5;s:10:\"sell_price\";i:6;s:8:\"subtotal\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:8:{i:0;s:8:\"store_id\";i:1;s:7:\"user_id\";i:2;s:14:\"invoice_number\";i:3;s:12:\"total_amount\";i:4;s:10:\"total_cost\";i:5;s:14:\"payment_amount\";i:6;s:13:\"change_amount\";i:7;s:5:\"notes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:22:\"App\\Models\\Transaction\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:12:\"transactions\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:67;s:8:\"store_id\";i:1;s:7:\"user_id\";i:2;s:14:\"invoice_number\";s:21:\"INV-20260619-0003-old\";s:12:\"total_amount\";s:9:\"116000.00\";s:10:\"total_cost\";s:8:\"69600.00\";s:14:\"payment_amount\";s:9:\"116000.00\";s:13:\"change_amount\";s:4:\"0.00\";s:5:\"notes\";s:12:\"Migrated POS\";s:10:\"created_at\";s:19:\"2026-06-20 06:54:14\";s:10:\"updated_at\";s:19:\"2026-06-20 09:23:14\";}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:67;s:8:\"store_id\";i:1;s:7:\"user_id\";i:2;s:14:\"invoice_number\";s:21:\"INV-20260619-0003-old\";s:12:\"total_amount\";s:9:\"116000.00\";s:10:\"total_cost\";s:8:\"69600.00\";s:14:\"payment_amount\";s:9:\"116000.00\";s:13:\"change_amount\";s:4:\"0.00\";s:5:\"notes\";s:12:\"Migrated POS\";s:10:\"created_at\";s:19:\"2026-06-20 06:54:14\";s:10:\"updated_at\";s:19:\"2026-06-20 09:23:14\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:12:\"total_amount\";s:9:\"decimal:2\";s:10:\"total_cost\";s:9:\"decimal:2\";s:14:\"payment_amount\";s:9:\"decimal:2\";s:13:\"change_amount\";s:9:\"decimal:2\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:4:\"user\";O:15:\"App\\Models\\User\":36:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:2;s:4:\"name\";s:13:\"Wayan Sudirta\";s:4:\"role\";s:5:\"owner\";s:8:\"store_id\";N;s:5:\"email\";s:21:\"owner@smart-umkm.test\";s:17:\"email_verified_at\";s:19:\"2026-06-19 15:48:13\";s:8:\"password\";s:60:\"$2y$12$16KrdFs5ikWpAU0mKQThJuWH9WB6ECwZQFQ0qeaBobQdYdkHVfe1C\";s:14:\"remember_token\";N;s:10:\"created_at\";s:19:\"2026-06-19 15:48:13\";s:10:\"updated_at\";s:19:\"2026-06-19 15:48:13\";s:10:\"deleted_at\";N;}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:2;s:4:\"name\";s:13:\"Wayan Sudirta\";s:4:\"role\";s:5:\"owner\";s:8:\"store_id\";N;s:5:\"email\";s:21:\"owner@smart-umkm.test\";s:17:\"email_verified_at\";s:19:\"2026-06-19 15:48:13\";s:8:\"password\";s:60:\"$2y$12$16KrdFs5ikWpAU0mKQThJuWH9WB6ECwZQFQ0qeaBobQdYdkHVfe1C\";s:14:\"remember_token\";N;s:10:\"created_at\";s:19:\"2026-06-19 15:48:13\";s:10:\"updated_at\";s:19:\"2026-06-19 15:48:13\";s:10:\"deleted_at\";N;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:3:{s:17:\"email_verified_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:4:\"name\";i:1;s:5:\"email\";i:2;s:8:\"password\";i:3;s:4:\"role\";i:4;s:8:\"store_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";s:16:\"\0*\0forceDeleting\";b:0;}s:7:\"details\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:2:{i:0;O:28:\"App\\Models\\TransactionDetail\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:19:\"transaction_details\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:135;s:14:\"transaction_id\";i:67;s:10:\"product_id\";i:2;s:12:\"product_name\";s:22:\"Es Kopi Susu Gula Aren\";s:8:\"quantity\";i:3;s:10:\"cost_price\";s:8:\"13200.00\";s:10:\"sell_price\";s:8:\"22000.00\";s:8:\"subtotal\";s:8:\"66000.00\";s:10:\"created_at\";s:19:\"2026-06-20 06:54:14\";s:10:\"updated_at\";s:19:\"2026-06-20 09:23:14\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:135;s:14:\"transaction_id\";i:67;s:10:\"product_id\";i:2;s:12:\"product_name\";s:22:\"Es Kopi Susu Gula Aren\";s:8:\"quantity\";i:3;s:10:\"cost_price\";s:8:\"13200.00\";s:10:\"sell_price\";s:8:\"22000.00\";s:8:\"subtotal\";s:8:\"66000.00\";s:10:\"created_at\";s:19:\"2026-06-20 06:54:14\";s:10:\"updated_at\";s:19:\"2026-06-20 09:23:14\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:8:\"quantity\";s:7:\"integer\";s:10:\"cost_price\";s:9:\"decimal:2\";s:10:\"sell_price\";s:9:\"decimal:2\";s:8:\"subtotal\";s:9:\"decimal:2\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:14:\"transaction_id\";i:1;s:10:\"product_id\";i:2;s:12:\"product_name\";i:3;s:8:\"quantity\";i:4;s:10:\"cost_price\";i:5;s:10:\"sell_price\";i:6;s:8:\"subtotal\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:28:\"App\\Models\\TransactionDetail\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:19:\"transaction_details\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:136;s:14:\"transaction_id\";i:67;s:10:\"product_id\";i:5;s:12:\"product_name\";s:22:\"Kacang Kapri Tari Bali\";s:8:\"quantity\";i:2;s:10:\"cost_price\";s:8:\"15000.00\";s:10:\"sell_price\";s:8:\"25000.00\";s:8:\"subtotal\";s:8:\"50000.00\";s:10:\"created_at\";s:19:\"2026-06-20 06:54:14\";s:10:\"updated_at\";s:19:\"2026-06-20 09:23:14\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:136;s:14:\"transaction_id\";i:67;s:10:\"product_id\";i:5;s:12:\"product_name\";s:22:\"Kacang Kapri Tari Bali\";s:8:\"quantity\";i:2;s:10:\"cost_price\";s:8:\"15000.00\";s:10:\"sell_price\";s:8:\"25000.00\";s:8:\"subtotal\";s:8:\"50000.00\";s:10:\"created_at\";s:19:\"2026-06-20 06:54:14\";s:10:\"updated_at\";s:19:\"2026-06-20 09:23:14\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:8:\"quantity\";s:7:\"integer\";s:10:\"cost_price\";s:9:\"decimal:2\";s:10:\"sell_price\";s:9:\"decimal:2\";s:8:\"subtotal\";s:9:\"decimal:2\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:14:\"transaction_id\";i:1;s:10:\"product_id\";i:2;s:12:\"product_name\";i:3;s:8:\"quantity\";i:4;s:10:\"cost_price\";i:5;s:10:\"sell_price\";i:6;s:8:\"subtotal\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:8:{i:0;s:8:\"store_id\";i:1;s:7:\"user_id\";i:2;s:14:\"invoice_number\";i:3;s:12:\"total_amount\";i:4;s:10:\"total_cost\";i:5;s:14:\"payment_amount\";i:6;s:13:\"change_amount\";i:7;s:5:\"notes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:22:\"App\\Models\\Transaction\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:12:\"transactions\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:64;s:8:\"store_id\";i:1;s:7:\"user_id\";i:2;s:14:\"invoice_number\";s:21:\"INV-20260618-0001-old\";s:12:\"total_amount\";s:9:\"130000.00\";s:10:\"total_cost\";s:8:\"78000.00\";s:14:\"payment_amount\";s:9:\"130000.00\";s:13:\"change_amount\";s:4:\"0.00\";s:5:\"notes\";s:12:\"Migrated POS\";s:10:\"created_at\";s:19:\"2026-06-19 09:40:14\";s:10:\"updated_at\";s:19:\"2026-06-19 11:55:14\";}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:64;s:8:\"store_id\";i:1;s:7:\"user_id\";i:2;s:14:\"invoice_number\";s:21:\"INV-20260618-0001-old\";s:12:\"total_amount\";s:9:\"130000.00\";s:10:\"total_cost\";s:8:\"78000.00\";s:14:\"payment_amount\";s:9:\"130000.00\";s:13:\"change_amount\";s:4:\"0.00\";s:5:\"notes\";s:12:\"Migrated POS\";s:10:\"created_at\";s:19:\"2026-06-19 09:40:14\";s:10:\"updated_at\";s:19:\"2026-06-19 11:55:14\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:12:\"total_amount\";s:9:\"decimal:2\";s:10:\"total_cost\";s:9:\"decimal:2\";s:14:\"payment_amount\";s:9:\"decimal:2\";s:13:\"change_amount\";s:9:\"decimal:2\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:4:\"user\";r:712;s:7:\"details\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;O:28:\"App\\Models\\TransactionDetail\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:19:\"transaction_details\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:130;s:14:\"transaction_id\";i:64;s:10:\"product_id\";i:1;s:12:\"product_name\";s:24:\"Kopi Bali Kintamani 250g\";s:8:\"quantity\";i:2;s:10:\"cost_price\";s:8:\"39000.00\";s:10:\"sell_price\";s:8:\"65000.00\";s:8:\"subtotal\";s:9:\"130000.00\";s:10:\"created_at\";s:19:\"2026-06-19 09:40:14\";s:10:\"updated_at\";s:19:\"2026-06-19 11:55:14\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:130;s:14:\"transaction_id\";i:64;s:10:\"product_id\";i:1;s:12:\"product_name\";s:24:\"Kopi Bali Kintamani 250g\";s:8:\"quantity\";i:2;s:10:\"cost_price\";s:8:\"39000.00\";s:10:\"sell_price\";s:8:\"65000.00\";s:8:\"subtotal\";s:9:\"130000.00\";s:10:\"created_at\";s:19:\"2026-06-19 09:40:14\";s:10:\"updated_at\";s:19:\"2026-06-19 11:55:14\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:8:\"quantity\";s:7:\"integer\";s:10:\"cost_price\";s:9:\"decimal:2\";s:10:\"sell_price\";s:9:\"decimal:2\";s:8:\"subtotal\";s:9:\"decimal:2\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:14:\"transaction_id\";i:1;s:10:\"product_id\";i:2;s:12:\"product_name\";i:3;s:8:\"quantity\";i:4;s:10:\"cost_price\";i:5;s:10:\"sell_price\";i:6;s:8:\"subtotal\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:8:{i:0;s:8:\"store_id\";i:1;s:7:\"user_id\";i:2;s:14:\"invoice_number\";i:3;s:12:\"total_amount\";i:4;s:10:\"total_cost\";i:5;s:14:\"payment_amount\";i:6;s:13:\"change_amount\";i:7;s:5:\"notes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:4;O:22:\"App\\Models\\Transaction\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:12:\"transactions\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:63;s:8:\"store_id\";i:1;s:7:\"user_id\";i:2;s:14:\"invoice_number\";s:21:\"INV-20260617-0001-old\";s:12:\"total_amount\";s:8:\"50000.00\";s:10:\"total_cost\";s:8:\"30000.00\";s:14:\"payment_amount\";s:8:\"50000.00\";s:13:\"change_amount\";s:4:\"0.00\";s:5:\"notes\";s:12:\"Migrated POS\";s:10:\"created_at\";s:19:\"2026-06-18 09:22:14\";s:10:\"updated_at\";s:19:\"2026-06-18 03:07:14\";}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:63;s:8:\"store_id\";i:1;s:7:\"user_id\";i:2;s:14:\"invoice_number\";s:21:\"INV-20260617-0001-old\";s:12:\"total_amount\";s:8:\"50000.00\";s:10:\"total_cost\";s:8:\"30000.00\";s:14:\"payment_amount\";s:8:\"50000.00\";s:13:\"change_amount\";s:4:\"0.00\";s:5:\"notes\";s:12:\"Migrated POS\";s:10:\"created_at\";s:19:\"2026-06-18 09:22:14\";s:10:\"updated_at\";s:19:\"2026-06-18 03:07:14\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:12:\"total_amount\";s:9:\"decimal:2\";s:10:\"total_cost\";s:9:\"decimal:2\";s:14:\"payment_amount\";s:9:\"decimal:2\";s:13:\"change_amount\";s:9:\"decimal:2\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:4:\"user\";r:712;s:7:\"details\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;O:28:\"App\\Models\\TransactionDetail\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:19:\"transaction_details\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:129;s:14:\"transaction_id\";i:63;s:10:\"product_id\";i:5;s:12:\"product_name\";s:22:\"Kacang Kapri Tari Bali\";s:8:\"quantity\";i:2;s:10:\"cost_price\";s:8:\"15000.00\";s:10:\"sell_price\";s:8:\"25000.00\";s:8:\"subtotal\";s:8:\"50000.00\";s:10:\"created_at\";s:19:\"2026-06-18 09:22:14\";s:10:\"updated_at\";s:19:\"2026-06-18 03:07:14\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:129;s:14:\"transaction_id\";i:63;s:10:\"product_id\";i:5;s:12:\"product_name\";s:22:\"Kacang Kapri Tari Bali\";s:8:\"quantity\";i:2;s:10:\"cost_price\";s:8:\"15000.00\";s:10:\"sell_price\";s:8:\"25000.00\";s:8:\"subtotal\";s:8:\"50000.00\";s:10:\"created_at\";s:19:\"2026-06-18 09:22:14\";s:10:\"updated_at\";s:19:\"2026-06-18 03:07:14\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:8:\"quantity\";s:7:\"integer\";s:10:\"cost_price\";s:9:\"decimal:2\";s:10:\"sell_price\";s:9:\"decimal:2\";s:8:\"subtotal\";s:9:\"decimal:2\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:14:\"transaction_id\";i:1;s:10:\"product_id\";i:2;s:12:\"product_name\";i:3;s:8:\"quantity\";i:4;s:10:\"cost_price\";i:5;s:10:\"sell_price\";i:6;s:8:\"subtotal\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:8:{i:0;s:8:\"store_id\";i:1;s:7:\"user_id\";i:2;s:14:\"invoice_number\";i:3;s:12:\"total_amount\";i:4;s:10:\"total_cost\";i:5;s:14:\"payment_amount\";i:6;s:13:\"change_amount\";i:7;s:5:\"notes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:22:\"marketplaceTotalOrders\";i:67;s:23:\"marketplaceTotalRevenue\";s:11:\"12088000.00\";s:24:\"marketplaceCustomerCount\";i:2;s:23:\"marketplaceRecentOrders\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:5:{i:0;O:16:\"App\\Models\\Order\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"orders\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:17:{s:2:\"id\";i:65;s:14:\"invoice_number\";s:17:\"INV-20260619-0001\";s:7:\"user_id\";i:4;s:8:\"store_id\";i:1;s:22:\"payment_transaction_id\";N;s:6:\"status\";s:9:\"completed\";s:14:\"payment_method\";s:4:\"cash\";s:16:\"shipping_courier\";N;s:15:\"tracking_number\";N;s:12:\"courier_name\";N;s:15:\"courier_service\";N;s:14:\"waybill_number\";N;s:12:\"shipping_fee\";s:4:\"0.00\";s:12:\"total_amount\";s:8:\"25000.00\";s:5:\"notes\";s:27:\"Pembelian langsung di toko.\";s:10:\"created_at\";s:19:\"2026-06-20 12:26:14\";s:10:\"updated_at\";s:19:\"2026-06-20 10:53:14\";}s:11:\"\0*\0original\";a:17:{s:2:\"id\";i:65;s:14:\"invoice_number\";s:17:\"INV-20260619-0001\";s:7:\"user_id\";i:4;s:8:\"store_id\";i:1;s:22:\"payment_transaction_id\";N;s:6:\"status\";s:9:\"completed\";s:14:\"payment_method\";s:4:\"cash\";s:16:\"shipping_courier\";N;s:15:\"tracking_number\";N;s:12:\"courier_name\";N;s:15:\"courier_service\";N;s:14:\"waybill_number\";N;s:12:\"shipping_fee\";s:4:\"0.00\";s:12:\"total_amount\";s:8:\"25000.00\";s:5:\"notes\";s:27:\"Pembelian langsung di toko.\";s:10:\"created_at\";s:19:\"2026-06-20 12:26:14\";s:10:\"updated_at\";s:19:\"2026-06-20 10:53:14\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:4:\"user\";O:15:\"App\\Models\\User\":36:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:4;s:4:\"name\";s:10:\"Kadek Sari\";s:4:\"role\";s:7:\"cashier\";s:8:\"store_id\";i:1;s:5:\"email\";s:23:\"cashier@smart-umkm.test\";s:17:\"email_verified_at\";s:19:\"2026-06-19 15:48:13\";s:8:\"password\";s:60:\"$2y$12$.qUw3BG2Mf9k4WywIMOxAuoIIb3RJbVgYIDtG3VseW5vjE/c.K4tu\";s:14:\"remember_token\";N;s:10:\"created_at\";s:19:\"2026-06-19 15:48:13\";s:10:\"updated_at\";s:19:\"2026-06-19 15:48:13\";s:10:\"deleted_at\";N;}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:4;s:4:\"name\";s:10:\"Kadek Sari\";s:4:\"role\";s:7:\"cashier\";s:8:\"store_id\";i:1;s:5:\"email\";s:23:\"cashier@smart-umkm.test\";s:17:\"email_verified_at\";s:19:\"2026-06-19 15:48:13\";s:8:\"password\";s:60:\"$2y$12$.qUw3BG2Mf9k4WywIMOxAuoIIb3RJbVgYIDtG3VseW5vjE/c.K4tu\";s:14:\"remember_token\";N;s:10:\"created_at\";s:19:\"2026-06-19 15:48:13\";s:10:\"updated_at\";s:19:\"2026-06-19 15:48:13\";s:10:\"deleted_at\";N;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:3:{s:17:\"email_verified_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:4:\"name\";i:1;s:5:\"email\";i:2;s:8:\"password\";i:3;s:4:\"role\";i:4;s:8:\"store_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";s:16:\"\0*\0forceDeleting\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:14:\"invoice_number\";i:1;s:7:\"user_id\";i:2;s:8:\"store_id\";i:3;s:22:\"payment_transaction_id\";i:4;s:6:\"status\";i:5;s:14:\"payment_method\";i:6;s:16:\"shipping_courier\";i:7;s:15:\"tracking_number\";i:8;s:12:\"courier_name\";i:9;s:15:\"courier_service\";i:10;s:14:\"waybill_number\";i:11;s:12:\"shipping_fee\";i:12;s:12:\"total_amount\";i:13;s:5:\"notes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:16:\"App\\Models\\Order\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"orders\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:17:{s:2:\"id\";i:66;s:14:\"invoice_number\";s:17:\"INV-20260619-0002\";s:7:\"user_id\";i:4;s:8:\"store_id\";i:1;s:22:\"payment_transaction_id\";N;s:6:\"status\";s:9:\"completed\";s:14:\"payment_method\";s:4:\"cash\";s:16:\"shipping_courier\";N;s:15:\"tracking_number\";N;s:12:\"courier_name\";N;s:15:\"courier_service\";N;s:14:\"waybill_number\";N;s:12:\"shipping_fee\";s:4:\"0.00\";s:12:\"total_amount\";s:9:\"157000.00\";s:5:\"notes\";s:27:\"Pembelian langsung di toko.\";s:10:\"created_at\";s:19:\"2026-06-20 08:57:14\";s:10:\"updated_at\";s:19:\"2026-06-20 00:44:14\";}s:11:\"\0*\0original\";a:17:{s:2:\"id\";i:66;s:14:\"invoice_number\";s:17:\"INV-20260619-0002\";s:7:\"user_id\";i:4;s:8:\"store_id\";i:1;s:22:\"payment_transaction_id\";N;s:6:\"status\";s:9:\"completed\";s:14:\"payment_method\";s:4:\"cash\";s:16:\"shipping_courier\";N;s:15:\"tracking_number\";N;s:12:\"courier_name\";N;s:15:\"courier_service\";N;s:14:\"waybill_number\";N;s:12:\"shipping_fee\";s:4:\"0.00\";s:12:\"total_amount\";s:9:\"157000.00\";s:5:\"notes\";s:27:\"Pembelian langsung di toko.\";s:10:\"created_at\";s:19:\"2026-06-20 08:57:14\";s:10:\"updated_at\";s:19:\"2026-06-20 00:44:14\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:4:\"user\";r:1278;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:14:\"invoice_number\";i:1;s:7:\"user_id\";i:2;s:8:\"store_id\";i:3;s:22:\"payment_transaction_id\";i:4;s:6:\"status\";i:5;s:14:\"payment_method\";i:6;s:16:\"shipping_courier\";i:7;s:15:\"tracking_number\";i:8;s:12:\"courier_name\";i:9;s:15:\"courier_service\";i:10;s:14:\"waybill_number\";i:11;s:12:\"shipping_fee\";i:12;s:12:\"total_amount\";i:13;s:5:\"notes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:16:\"App\\Models\\Order\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"orders\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:17:{s:2:\"id\";i:67;s:14:\"invoice_number\";s:17:\"INV-20260619-0003\";s:7:\"user_id\";i:2;s:8:\"store_id\";i:1;s:22:\"payment_transaction_id\";N;s:6:\"status\";s:9:\"completed\";s:14:\"payment_method\";s:4:\"cash\";s:16:\"shipping_courier\";N;s:15:\"tracking_number\";N;s:12:\"courier_name\";N;s:15:\"courier_service\";N;s:14:\"waybill_number\";N;s:12:\"shipping_fee\";s:4:\"0.00\";s:12:\"total_amount\";s:9:\"116000.00\";s:5:\"notes\";s:27:\"Pembelian langsung di toko.\";s:10:\"created_at\";s:19:\"2026-06-20 06:54:14\";s:10:\"updated_at\";s:19:\"2026-06-20 09:23:14\";}s:11:\"\0*\0original\";a:17:{s:2:\"id\";i:67;s:14:\"invoice_number\";s:17:\"INV-20260619-0003\";s:7:\"user_id\";i:2;s:8:\"store_id\";i:1;s:22:\"payment_transaction_id\";N;s:6:\"status\";s:9:\"completed\";s:14:\"payment_method\";s:4:\"cash\";s:16:\"shipping_courier\";N;s:15:\"tracking_number\";N;s:12:\"courier_name\";N;s:15:\"courier_service\";N;s:14:\"waybill_number\";N;s:12:\"shipping_fee\";s:4:\"0.00\";s:12:\"total_amount\";s:9:\"116000.00\";s:5:\"notes\";s:27:\"Pembelian langsung di toko.\";s:10:\"created_at\";s:19:\"2026-06-20 06:54:14\";s:10:\"updated_at\";s:19:\"2026-06-20 09:23:14\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:4:\"user\";O:15:\"App\\Models\\User\":36:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:2;s:4:\"name\";s:13:\"Wayan Sudirta\";s:4:\"role\";s:5:\"owner\";s:8:\"store_id\";N;s:5:\"email\";s:21:\"owner@smart-umkm.test\";s:17:\"email_verified_at\";s:19:\"2026-06-19 15:48:13\";s:8:\"password\";s:60:\"$2y$12$16KrdFs5ikWpAU0mKQThJuWH9WB6ECwZQFQ0qeaBobQdYdkHVfe1C\";s:14:\"remember_token\";N;s:10:\"created_at\";s:19:\"2026-06-19 15:48:13\";s:10:\"updated_at\";s:19:\"2026-06-19 15:48:13\";s:10:\"deleted_at\";N;}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:2;s:4:\"name\";s:13:\"Wayan Sudirta\";s:4:\"role\";s:5:\"owner\";s:8:\"store_id\";N;s:5:\"email\";s:21:\"owner@smart-umkm.test\";s:17:\"email_verified_at\";s:19:\"2026-06-19 15:48:13\";s:8:\"password\";s:60:\"$2y$12$16KrdFs5ikWpAU0mKQThJuWH9WB6ECwZQFQ0qeaBobQdYdkHVfe1C\";s:14:\"remember_token\";N;s:10:\"created_at\";s:19:\"2026-06-19 15:48:13\";s:10:\"updated_at\";s:19:\"2026-06-19 15:48:13\";s:10:\"deleted_at\";N;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:3:{s:17:\"email_verified_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:4:\"name\";i:1;s:5:\"email\";i:2;s:8:\"password\";i:3;s:4:\"role\";i:4;s:8:\"store_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";s:16:\"\0*\0forceDeleting\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:14:\"invoice_number\";i:1;s:7:\"user_id\";i:2;s:8:\"store_id\";i:3;s:22:\"payment_transaction_id\";i:4;s:6:\"status\";i:5;s:14:\"payment_method\";i:6;s:16:\"shipping_courier\";i:7;s:15:\"tracking_number\";i:8;s:12:\"courier_name\";i:9;s:15:\"courier_service\";i:10;s:14:\"waybill_number\";i:11;s:12:\"shipping_fee\";i:12;s:12:\"total_amount\";i:13;s:5:\"notes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:16:\"App\\Models\\Order\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"orders\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:17:{s:2:\"id\";i:64;s:14:\"invoice_number\";s:17:\"INV-20260618-0001\";s:7:\"user_id\";i:2;s:8:\"store_id\";i:1;s:22:\"payment_transaction_id\";N;s:6:\"status\";s:9:\"completed\";s:14:\"payment_method\";s:4:\"cash\";s:16:\"shipping_courier\";N;s:15:\"tracking_number\";N;s:12:\"courier_name\";N;s:15:\"courier_service\";N;s:14:\"waybill_number\";N;s:12:\"shipping_fee\";s:4:\"0.00\";s:12:\"total_amount\";s:9:\"130000.00\";s:5:\"notes\";s:27:\"Pembelian langsung di toko.\";s:10:\"created_at\";s:19:\"2026-06-19 09:40:14\";s:10:\"updated_at\";s:19:\"2026-06-19 11:55:14\";}s:11:\"\0*\0original\";a:17:{s:2:\"id\";i:64;s:14:\"invoice_number\";s:17:\"INV-20260618-0001\";s:7:\"user_id\";i:2;s:8:\"store_id\";i:1;s:22:\"payment_transaction_id\";N;s:6:\"status\";s:9:\"completed\";s:14:\"payment_method\";s:4:\"cash\";s:16:\"shipping_courier\";N;s:15:\"tracking_number\";N;s:12:\"courier_name\";N;s:15:\"courier_service\";N;s:14:\"waybill_number\";N;s:12:\"shipping_fee\";s:4:\"0.00\";s:12:\"total_amount\";s:9:\"130000.00\";s:5:\"notes\";s:27:\"Pembelian langsung di toko.\";s:10:\"created_at\";s:19:\"2026-06-19 09:40:14\";s:10:\"updated_at\";s:19:\"2026-06-19 11:55:14\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:4:\"user\";r:1515;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:14:\"invoice_number\";i:1;s:7:\"user_id\";i:2;s:8:\"store_id\";i:3;s:22:\"payment_transaction_id\";i:4;s:6:\"status\";i:5;s:14:\"payment_method\";i:6;s:16:\"shipping_courier\";i:7;s:15:\"tracking_number\";i:8;s:12:\"courier_name\";i:9;s:15:\"courier_service\";i:10;s:14:\"waybill_number\";i:11;s:12:\"shipping_fee\";i:12;s:12:\"total_amount\";i:13;s:5:\"notes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:4;O:16:\"App\\Models\\Order\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"orders\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:17:{s:2:\"id\";i:63;s:14:\"invoice_number\";s:17:\"INV-20260617-0001\";s:7:\"user_id\";i:2;s:8:\"store_id\";i:1;s:22:\"payment_transaction_id\";N;s:6:\"status\";s:9:\"completed\";s:14:\"payment_method\";s:4:\"cash\";s:16:\"shipping_courier\";N;s:15:\"tracking_number\";N;s:12:\"courier_name\";N;s:15:\"courier_service\";N;s:14:\"waybill_number\";N;s:12:\"shipping_fee\";s:4:\"0.00\";s:12:\"total_amount\";s:8:\"50000.00\";s:5:\"notes\";s:27:\"Pembelian langsung di toko.\";s:10:\"created_at\";s:19:\"2026-06-18 09:22:14\";s:10:\"updated_at\";s:19:\"2026-06-18 03:07:14\";}s:11:\"\0*\0original\";a:17:{s:2:\"id\";i:63;s:14:\"invoice_number\";s:17:\"INV-20260617-0001\";s:7:\"user_id\";i:2;s:8:\"store_id\";i:1;s:22:\"payment_transaction_id\";N;s:6:\"status\";s:9:\"completed\";s:14:\"payment_method\";s:4:\"cash\";s:16:\"shipping_courier\";N;s:15:\"tracking_number\";N;s:12:\"courier_name\";N;s:15:\"courier_service\";N;s:14:\"waybill_number\";N;s:12:\"shipping_fee\";s:4:\"0.00\";s:12:\"total_amount\";s:8:\"50000.00\";s:5:\"notes\";s:27:\"Pembelian langsung di toko.\";s:10:\"created_at\";s:19:\"2026-06-18 09:22:14\";s:10:\"updated_at\";s:19:\"2026-06-18 03:07:14\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:4:\"user\";r:1515;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:14:\"invoice_number\";i:1;s:7:\"user_id\";i:2;s:8:\"store_id\";i:3;s:22:\"payment_transaction_id\";i:4;s:6:\"status\";i:5;s:14:\"payment_method\";i:6;s:16:\"shipping_courier\";i:7;s:15:\"tracking_number\";i:8;s:12:\"courier_name\";i:9;s:15:\"courier_service\";i:10;s:14:\"waybill_number\";i:11;s:12:\"shipping_fee\";i:12;s:12:\"total_amount\";i:13;s:5:\"notes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}',1781885024);
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
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
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
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cart_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_items_cart_id_foreign` (`cart_id`),
  KEY `cart_items_product_id_foreign` (`product_id`),
  CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_items`
--

LOCK TABLES `cart_items` WRITE;
/*!40000 ALTER TABLE `cart_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`),
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (1,3,'2026-06-19 07:48:48','2026-06-19 07:48:48');
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_addresses`
--

DROP TABLE IF EXISTS `customer_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_addresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Rumah',
  `recipient_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_addresses_user_id_foreign` (`user_id`),
  CONSTRAINT `customer_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_addresses`
--

LOCK TABLES `customer_addresses` WRITE;
/*!40000 ALTER TABLE `customer_addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_profiles`
--

DROP TABLE IF EXISTS `customer_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_profiles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `gender` enum('L','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_profiles_user_id_foreign` (`user_id`),
  CONSTRAINT `customer_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_profiles`
--

LOCK TABLES `customer_profiles` WRITE;
/*!40000 ALTER TABLE `customer_profiles` DISABLE KEYS */;
INSERT INTO `customer_profiles` VALUES (1,5,NULL,NULL,NULL,NULL,'2026-06-19 07:49:11','2026-06-19 07:49:11'),(2,7,NULL,NULL,NULL,NULL,'2026-06-19 07:51:14','2026-06-19 07:51:14');
/*!40000 ALTER TABLE `customer_profiles` ENABLE KEYS */;
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
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
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
-- Table structure for table `global_settings`
--

DROP TABLE IF EXISTS `global_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `global_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `global_settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `global_settings`
--

LOCK TABLES `global_settings` WRITE;
/*!40000 ALTER TABLE `global_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `global_settings` ENABLE KEYS */;
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
  `attempts` smallint unsigned NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_01_01_000001_create_businesses_table',1),(5,'2025_01_01_000002_create_products_table',1),(6,'2025_01_01_000003_create_transactions_table',1),(7,'2025_01_01_000004_create_transaction_details_table',1),(8,'2025_01_02_000001_add_soft_deletes_to_products_table',1),(9,'2026_06_12_170748_add_user_role_to_users_table',1),(10,'2026_06_12_172106_refactor_businesses_to_stores',1),(11,'2026_06_13_035527_add_slug_to_stores_table',1),(12,'2026_06_13_035527_create_activity_logs_table',1),(13,'2026_06_16_023752_create_customer_addresses_table',1),(14,'2026_06_16_023752_create_customer_profiles_table',1),(15,'2026_06_16_023752_update_user_role_enum_to_customer',1),(16,'2026_06_16_025542_create_product_categories_table',1),(17,'2026_06_16_025542_create_product_images_table',1),(18,'2026_06_16_025542_create_store_banners_table',1),(19,'2026_06_16_025543_add_marketplace_fields_to_products',1),(20,'2026_06_16_031243_a_create_carts_table',1),(21,'2026_06_16_031243_b_create_cart_items_table',1),(22,'2026_06_16_031244_a_create_orders_table',1),(23,'2026_06_16_031244_b_create_order_items_table',1),(24,'2026_06_16_031244_c_create_order_addresses_table',1),(25,'2026_06_16_063750_a_create_payment_transactions_table',1),(26,'2026_06_16_063750_b_add_payment_transaction_id_to_orders_table',1),(27,'2026_06_16_064649_create_personal_access_tokens_table',1),(28,'2026_06_16_064914_create_product_reviews_table',1),(29,'2026_06_16_064914_create_store_reviews_table',1),(30,'2026_06_16_070311_add_visibility_to_products_table',1),(31,'2026_06_16_070311_create_store_categories_table',1),(32,'2026_06_16_070311_create_store_settings_table',1),(33,'2026_06_16_070311_update_category_in_stores_table',1),(34,'2026_06_17_025109_add_deleted_at_to_users_and_stores_table',1),(35,'2026_06_17_031408_add_admin_to_user_role',1),(36,'2026_06_17_031409_create_global_settings_table',1),(37,'2026_06_17_031409_create_suspensions_table',1),(38,'2026_06_17_032430_add_logistics_to_orders_table',1),(39,'2026_06_17_032430_add_weight_to_products_table',1),(40,'2026_06_17_034116_add_performance_indexes',1),(41,'2026_06_17_035223_create_article_categories_table',1),(42,'2026_06_17_035223_create_articles_table',1),(43,'2026_06_17_035224_create_article_store_table',1),(44,'2026_06_18_000000_add_theme_config_to_store_settings_table',1),(45,'2026_06_19_104512_add_tracking_info_to_orders_table',1),(46,'2026_06_19_112937_add_marketplace_indexes',1),(47,'2026_06_19_151529_fix_database_audit_issues',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_addresses`
--

DROP TABLE IF EXISTS `order_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_addresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `recipient_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_addresses_order_id_foreign` (`order_id`),
  CONSTRAINT `order_addresses_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_addresses`
--

LOCK TABLES `order_addresses` WRITE;
/*!40000 ALTER TABLE `order_addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `quantity` int NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,1,1,'Kopi Bali Kintamani 250g',65000.00,1,65000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(2,2,1,'Kopi Bali Kintamani 250g',65000.00,1,65000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(3,3,2,'Es Kopi Susu Gula Aren',22000.00,3,66000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(4,3,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,2,70000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(5,3,5,'Kacang Kapri Tari Bali',25000.00,1,25000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(6,4,1,'Kopi Bali Kintamani 250g',65000.00,2,130000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(7,4,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,3,105000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(8,5,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,3,105000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(9,5,4,'Kopi Arabica Plaga 200g',85000.00,1,85000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(10,5,5,'Kacang Kapri Tari Bali',25000.00,2,50000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(11,6,2,'Es Kopi Susu Gula Aren',22000.00,3,66000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(12,7,1,'Kopi Bali Kintamani 250g',65000.00,1,65000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(13,7,5,'Kacang Kapri Tari Bali',25000.00,1,25000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(14,8,1,'Kopi Bali Kintamani 250g',65000.00,2,130000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(15,8,2,'Es Kopi Susu Gula Aren',22000.00,2,44000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(16,9,1,'Kopi Bali Kintamani 250g',65000.00,2,130000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(17,9,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,2,70000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(18,9,4,'Kopi Arabica Plaga 200g',85000.00,1,85000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(19,10,2,'Es Kopi Susu Gula Aren',22000.00,3,66000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(20,10,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,1,35000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(21,10,4,'Kopi Arabica Plaga 200g',85000.00,1,85000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(22,11,1,'Kopi Bali Kintamani 250g',65000.00,1,65000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(23,12,1,'Kopi Bali Kintamani 250g',65000.00,1,65000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(24,12,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,3,105000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(25,13,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,3,105000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(26,13,5,'Kacang Kapri Tari Bali',25000.00,3,75000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(27,14,4,'Kopi Arabica Plaga 200g',85000.00,2,170000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(28,15,2,'Es Kopi Susu Gula Aren',22000.00,2,44000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(29,15,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,1,35000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(30,15,4,'Kopi Arabica Plaga 200g',85000.00,3,255000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(31,16,1,'Kopi Bali Kintamani 250g',65000.00,2,130000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(32,16,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,3,105000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(33,16,5,'Kacang Kapri Tari Bali',25000.00,3,75000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(34,17,2,'Es Kopi Susu Gula Aren',22000.00,1,22000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(35,17,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,1,35000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(36,17,5,'Kacang Kapri Tari Bali',25000.00,2,50000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(37,18,1,'Kopi Bali Kintamani 250g',65000.00,2,130000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(38,18,4,'Kopi Arabica Plaga 200g',85000.00,2,170000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(39,18,5,'Kacang Kapri Tari Bali',25000.00,1,25000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(40,19,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,3,105000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(41,19,5,'Kacang Kapri Tari Bali',25000.00,1,25000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(42,20,1,'Kopi Bali Kintamani 250g',65000.00,3,195000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(43,20,2,'Es Kopi Susu Gula Aren',22000.00,1,22000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(44,20,5,'Kacang Kapri Tari Bali',25000.00,1,25000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(45,21,2,'Es Kopi Susu Gula Aren',22000.00,1,22000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(46,21,4,'Kopi Arabica Plaga 200g',85000.00,3,255000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(47,22,1,'Kopi Bali Kintamani 250g',65000.00,1,65000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(48,23,1,'Kopi Bali Kintamani 250g',65000.00,3,195000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(49,23,2,'Es Kopi Susu Gula Aren',22000.00,2,44000.00,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(50,24,1,'Kopi Bali Kintamani 250g',65000.00,3,195000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(51,25,4,'Kopi Arabica Plaga 200g',85000.00,2,170000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(52,26,5,'Kacang Kapri Tari Bali',25000.00,2,50000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(53,27,2,'Es Kopi Susu Gula Aren',22000.00,3,66000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(54,27,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,1,35000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(55,27,4,'Kopi Arabica Plaga 200g',85000.00,2,170000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(56,28,4,'Kopi Arabica Plaga 200g',85000.00,2,170000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(57,28,5,'Kacang Kapri Tari Bali',25000.00,2,50000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(58,29,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,1,35000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(59,29,4,'Kopi Arabica Plaga 200g',85000.00,2,170000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(60,30,2,'Es Kopi Susu Gula Aren',22000.00,3,66000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(61,31,1,'Kopi Bali Kintamani 250g',65000.00,2,130000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(62,31,4,'Kopi Arabica Plaga 200g',85000.00,2,170000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(63,31,5,'Kacang Kapri Tari Bali',25000.00,3,75000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(64,32,2,'Es Kopi Susu Gula Aren',22000.00,3,66000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(65,33,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,1,35000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(66,33,4,'Kopi Arabica Plaga 200g',85000.00,2,170000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(67,34,2,'Es Kopi Susu Gula Aren',22000.00,2,44000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(68,34,4,'Kopi Arabica Plaga 200g',85000.00,2,170000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(69,35,2,'Es Kopi Susu Gula Aren',22000.00,1,22000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(70,36,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,2,70000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(71,36,4,'Kopi Arabica Plaga 200g',85000.00,1,85000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(72,36,5,'Kacang Kapri Tari Bali',25000.00,2,50000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(73,37,2,'Es Kopi Susu Gula Aren',22000.00,2,44000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(74,37,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,1,35000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(75,37,4,'Kopi Arabica Plaga 200g',85000.00,1,85000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(76,38,1,'Kopi Bali Kintamani 250g',65000.00,3,195000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(77,38,2,'Es Kopi Susu Gula Aren',22000.00,2,44000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(78,38,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,3,105000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(79,39,1,'Kopi Bali Kintamani 250g',65000.00,3,195000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(80,39,2,'Es Kopi Susu Gula Aren',22000.00,3,66000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(81,39,5,'Kacang Kapri Tari Bali',25000.00,1,25000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(82,40,2,'Es Kopi Susu Gula Aren',22000.00,3,66000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(83,40,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,1,35000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(84,41,5,'Kacang Kapri Tari Bali',25000.00,3,75000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(85,42,1,'Kopi Bali Kintamani 250g',65000.00,3,195000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(86,42,5,'Kacang Kapri Tari Bali',25000.00,3,75000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(87,43,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,2,70000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(88,43,5,'Kacang Kapri Tari Bali',25000.00,1,25000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(89,44,1,'Kopi Bali Kintamani 250g',65000.00,2,130000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(90,44,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,3,105000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(91,44,5,'Kacang Kapri Tari Bali',25000.00,3,75000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(92,45,4,'Kopi Arabica Plaga 200g',85000.00,2,170000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(93,45,5,'Kacang Kapri Tari Bali',25000.00,1,25000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(94,46,1,'Kopi Bali Kintamani 250g',65000.00,2,130000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(95,46,2,'Es Kopi Susu Gula Aren',22000.00,3,66000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(96,46,4,'Kopi Arabica Plaga 200g',85000.00,1,85000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(97,47,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,1,35000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(98,47,4,'Kopi Arabica Plaga 200g',85000.00,3,255000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(99,47,5,'Kacang Kapri Tari Bali',25000.00,3,75000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(100,48,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,3,105000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(101,49,5,'Kacang Kapri Tari Bali',25000.00,2,50000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(102,50,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,3,105000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(103,51,2,'Es Kopi Susu Gula Aren',22000.00,1,22000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(104,51,5,'Kacang Kapri Tari Bali',25000.00,3,75000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(105,52,2,'Es Kopi Susu Gula Aren',22000.00,3,66000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(106,52,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,1,35000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(107,53,1,'Kopi Bali Kintamani 250g',65000.00,2,130000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(108,53,2,'Es Kopi Susu Gula Aren',22000.00,2,44000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(109,53,5,'Kacang Kapri Tari Bali',25000.00,3,75000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(110,54,1,'Kopi Bali Kintamani 250g',65000.00,2,130000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(111,54,4,'Kopi Arabica Plaga 200g',85000.00,1,85000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(112,55,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,2,70000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(113,56,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,2,70000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(114,56,4,'Kopi Arabica Plaga 200g',85000.00,1,85000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(115,57,4,'Kopi Arabica Plaga 200g',85000.00,3,255000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(116,58,1,'Kopi Bali Kintamani 250g',65000.00,1,65000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(117,58,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,2,70000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(118,58,4,'Kopi Arabica Plaga 200g',85000.00,1,85000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(119,59,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,3,105000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(120,59,4,'Kopi Arabica Plaga 200g',85000.00,3,255000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(121,59,5,'Kacang Kapri Tari Bali',25000.00,3,75000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(122,60,2,'Es Kopi Susu Gula Aren',22000.00,1,22000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(123,60,4,'Kopi Arabica Plaga 200g',85000.00,1,85000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(124,61,3,'Pie Susu Bali Premium (1 Kotak)',35000.00,3,105000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(125,61,4,'Kopi Arabica Plaga 200g',85000.00,2,170000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(126,61,5,'Kacang Kapri Tari Bali',25000.00,1,25000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(127,62,1,'Kopi Bali Kintamani 250g',65000.00,2,130000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(128,62,4,'Kopi Arabica Plaga 200g',85000.00,1,85000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(129,63,5,'Kacang Kapri Tari Bali',25000.00,2,50000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(130,64,1,'Kopi Bali Kintamani 250g',65000.00,2,130000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(131,65,5,'Kacang Kapri Tari Bali',25000.00,1,25000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(132,66,2,'Es Kopi Susu Gula Aren',22000.00,1,22000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(133,66,4,'Kopi Arabica Plaga 200g',85000.00,1,85000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(134,66,5,'Kacang Kapri Tari Bali',25000.00,2,50000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(135,67,2,'Es Kopi Susu Gula Aren',22000.00,3,66000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(136,67,5,'Kacang Kapri Tari Bali',25000.00,2,50000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14'),(137,68,6,'Cincin Perak Ukir Tridatu',350000.00,1,350000.00,'2026-06-19 07:48:14','2026-06-19 07:48:14');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `store_id` bigint unsigned DEFAULT NULL,
  `payment_transaction_id` bigint unsigned DEFAULT NULL,
  `status` enum('pending','paid','processing','shipped','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_courier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tracking_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `courier_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `courier_service` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `waybill_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_fee` decimal(12,2) NOT NULL DEFAULT '0.00',
  `total_amount` decimal(15,2) NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_invoice_number_unique` (`invoice_number`),
  KEY `orders_payment_transaction_id_foreign` (`payment_transaction_id`),
  KEY `idx_orders_store_status` (`store_id`,`status`),
  KEY `idx_orders_user` (`user_id`),
  CONSTRAINT `orders_payment_transaction_id_foreign` FOREIGN KEY (`payment_transaction_id`) REFERENCES `payment_transactions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'INV-20260521-0001',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,65000.00,'Pembelian langsung di toko.','2026-05-21 23:39:13','2026-05-22 01:16:13'),(2,'INV-20260521-0002',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,65000.00,'Pembelian langsung di toko.','2026-05-21 20:34:13','2026-05-22 02:13:13'),(3,'INV-20260521-0003',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,161000.00,'Pembelian langsung di toko.','2026-05-21 22:15:13','2026-05-22 03:38:13'),(4,'INV-20260521-0004',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,235000.00,'Pembelian langsung di toko.','2026-05-22 04:29:13','2026-05-21 19:30:13'),(5,'INV-20260522-0001',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,240000.00,'Pembelian langsung di toko.','2026-05-23 02:16:13','2026-05-23 02:07:13'),(6,'INV-20260522-0002',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,66000.00,'Pembelian langsung di toko.','2026-05-22 20:03:13','2026-05-22 21:44:13'),(7,'INV-20260523-0001',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,90000.00,'Pembelian langsung di toko.','2026-05-23 16:54:13','2026-05-24 00:39:13'),(8,'INV-20260523-0002',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,174000.00,'Pembelian langsung di toko.','2026-05-24 04:35:13','2026-05-23 19:53:13'),(9,'INV-20260523-0003',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,285000.00,'Pembelian langsung di toko.','2026-05-23 21:36:13','2026-05-24 03:36:13'),(10,'INV-20260523-0004',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,186000.00,'Pembelian langsung di toko.','2026-05-23 17:22:13','2026-05-23 22:53:13'),(11,'INV-20260524-0001',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,65000.00,'Pembelian langsung di toko.','2026-05-25 04:26:13','2026-05-25 02:13:13'),(12,'INV-20260524-0002',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,170000.00,'Pembelian langsung di toko.','2026-05-24 16:49:13','2026-05-24 23:42:13'),(13,'INV-20260525-0001',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,180000.00,'Pembelian langsung di toko.','2026-05-25 19:03:13','2026-05-25 21:14:13'),(14,'INV-20260526-0001',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,170000.00,'Pembelian langsung di toko.','2026-05-27 01:00:13','2026-05-27 01:32:13'),(15,'INV-20260527-0001',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,334000.00,'Pembelian langsung di toko.','2026-05-28 02:19:13','2026-05-27 20:43:13'),(16,'INV-20260527-0002',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,310000.00,'Pembelian langsung di toko.','2026-05-28 03:04:13','2026-05-27 19:23:13'),(17,'INV-20260528-0001',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,107000.00,'Pembelian langsung di toko.','2026-05-28 20:05:13','2026-05-28 20:02:13'),(18,'INV-20260529-0001',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,325000.00,'Pembelian langsung di toko.','2026-05-30 02:15:13','2026-05-29 19:47:13'),(19,'INV-20260529-0002',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,130000.00,'Pembelian langsung di toko.','2026-05-29 17:41:13','2026-05-30 00:52:13'),(20,'INV-20260530-0001',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,242000.00,'Pembelian langsung di toko.','2026-05-31 04:26:13','2026-05-31 03:54:13'),(21,'INV-20260530-0002',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,277000.00,'Pembelian langsung di toko.','2026-05-31 03:27:13','2026-05-30 21:35:13'),(22,'INV-20260530-0003',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,65000.00,'Pembelian langsung di toko.','2026-05-30 20:12:13','2026-05-31 03:45:13'),(23,'INV-20260531-0001',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,239000.00,'Pembelian langsung di toko.','2026-06-01 00:01:13','2026-06-01 03:27:13'),(24,'INV-20260531-0002',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,195000.00,'Pembelian langsung di toko.','2026-06-01 02:24:13','2026-06-01 00:16:13'),(25,'INV-20260601-0001',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,170000.00,'Pembelian langsung di toko.','2026-06-01 17:57:14','2026-06-02 04:30:14'),(26,'INV-20260602-0001',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,50000.00,'Pembelian langsung di toko.','2026-06-03 03:05:14','2026-06-02 16:57:14'),(27,'INV-20260602-0002',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,271000.00,'Pembelian langsung di toko.','2026-06-02 22:10:14','2026-06-03 04:16:14'),(28,'INV-20260602-0003',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,220000.00,'Pembelian langsung di toko.','2026-06-03 02:58:14','2026-06-03 03:31:14'),(29,'INV-20260602-0004',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,205000.00,'Pembelian langsung di toko.','2026-06-02 18:17:14','2026-06-03 03:50:14'),(30,'INV-20260603-0001',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,66000.00,'Pembelian langsung di toko.','2026-06-04 04:14:14','2026-06-03 16:47:14'),(31,'INV-20260603-0002',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,375000.00,'Pembelian langsung di toko.','2026-06-03 16:26:14','2026-06-04 01:08:14'),(32,'INV-20260604-0001',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,66000.00,'Pembelian langsung di toko.','2026-06-04 21:22:14','2026-06-04 18:41:14'),(33,'INV-20260604-0002',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,205000.00,'Pembelian langsung di toko.','2026-06-05 00:46:14','2026-06-04 20:37:14'),(34,'INV-20260605-0001',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,214000.00,'Pembelian langsung di toko.','2026-06-05 19:05:14','2026-06-06 02:45:14'),(35,'INV-20260605-0002',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,22000.00,'Pembelian langsung di toko.','2026-06-05 16:35:14','2026-06-05 23:32:14'),(36,'INV-20260605-0003',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,205000.00,'Pembelian langsung di toko.','2026-06-06 01:42:14','2026-06-05 22:33:14'),(37,'INV-20260606-0001',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,164000.00,'Pembelian langsung di toko.','2026-06-06 16:46:14','2026-06-07 00:46:14'),(38,'INV-20260607-0001',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,344000.00,'Pembelian langsung di toko.','2026-06-07 19:30:14','2026-06-08 01:08:14'),(39,'INV-20260607-0002',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,286000.00,'Pembelian langsung di toko.','2026-06-07 21:08:14','2026-06-07 19:48:14'),(40,'INV-20260607-0003',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,101000.00,'Pembelian langsung di toko.','2026-06-08 03:14:14','2026-06-07 16:40:14'),(41,'INV-20260608-0001',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,75000.00,'Pembelian langsung di toko.','2026-06-09 04:20:14','2026-06-08 22:37:14'),(42,'INV-20260608-0002',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,270000.00,'Pembelian langsung di toko.','2026-06-09 02:21:14','2026-06-09 01:26:14'),(43,'INV-20260608-0003',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,95000.00,'Pembelian langsung di toko.','2026-06-08 18:07:14','2026-06-09 00:42:14'),(44,'INV-20260608-0004',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,310000.00,'Pembelian langsung di toko.','2026-06-08 22:38:14','2026-06-09 00:18:14'),(45,'INV-20260609-0001',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,195000.00,'Pembelian langsung di toko.','2026-06-09 20:11:14','2026-06-09 20:39:14'),(46,'INV-20260609-0002',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,281000.00,'Pembelian langsung di toko.','2026-06-10 01:26:14','2026-06-09 23:32:14'),(47,'INV-20260610-0001',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,365000.00,'Pembelian langsung di toko.','2026-06-11 00:22:14','2026-06-11 00:52:14'),(48,'INV-20260610-0002',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,105000.00,'Pembelian langsung di toko.','2026-06-11 03:33:14','2026-06-10 17:00:14'),(49,'INV-20260610-0003',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,50000.00,'Pembelian langsung di toko.','2026-06-10 15:49:14','2026-06-10 20:05:14'),(50,'INV-20260610-0004',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,105000.00,'Pembelian langsung di toko.','2026-06-11 00:11:14','2026-06-10 23:07:14'),(51,'INV-20260611-0001',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,97000.00,'Pembelian langsung di toko.','2026-06-11 20:17:14','2026-06-12 04:44:14'),(52,'INV-20260612-0001',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,101000.00,'Pembelian langsung di toko.','2026-06-12 19:50:14','2026-06-12 23:11:14'),(53,'INV-20260612-0002',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,249000.00,'Pembelian langsung di toko.','2026-06-13 02:59:14','2026-06-13 03:55:14'),(54,'INV-20260612-0003',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,215000.00,'Pembelian langsung di toko.','2026-06-12 17:59:14','2026-06-12 16:10:14'),(55,'INV-20260612-0004',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,70000.00,'Pembelian langsung di toko.','2026-06-12 15:58:14','2026-06-12 18:11:14'),(56,'INV-20260613-0001',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,155000.00,'Pembelian langsung di toko.','2026-06-14 02:15:14','2026-06-14 03:55:14'),(57,'INV-20260614-0001',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,255000.00,'Pembelian langsung di toko.','2026-06-14 19:44:14','2026-06-15 04:21:14'),(58,'INV-20260615-0001',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,220000.00,'Pembelian langsung di toko.','2026-06-15 19:53:14','2026-06-16 03:35:14'),(59,'INV-20260615-0002',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,435000.00,'Pembelian langsung di toko.','2026-06-15 19:57:14','2026-06-15 23:53:14'),(60,'INV-20260616-0001',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,107000.00,'Pembelian langsung di toko.','2026-06-16 23:07:14','2026-06-17 02:24:14'),(61,'INV-20260616-0002',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,300000.00,'Pembelian langsung di toko.','2026-06-16 18:38:14','2026-06-17 04:14:14'),(62,'INV-20260616-0003',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,215000.00,'Pembelian langsung di toko.','2026-06-16 20:45:14','2026-06-16 20:56:14'),(63,'INV-20260617-0001',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,50000.00,'Pembelian langsung di toko.','2026-06-18 01:22:14','2026-06-17 19:07:14'),(64,'INV-20260618-0001',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,130000.00,'Pembelian langsung di toko.','2026-06-19 01:40:14','2026-06-19 03:55:14'),(65,'INV-20260619-0001',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,25000.00,'Pembelian langsung di toko.','2026-06-20 04:26:14','2026-06-20 02:53:14'),(66,'INV-20260619-0002',4,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,157000.00,'Pembelian langsung di toko.','2026-06-20 00:57:14','2026-06-19 16:44:14'),(67,'INV-20260619-0003',2,1,NULL,'completed','cash',NULL,NULL,NULL,NULL,NULL,0.00,116000.00,'Pembelian langsung di toko.','2026-06-19 22:54:14','2026-06-20 01:23:14'),(68,'INV-20260619-9999',3,2,NULL,'pending','bank_transfer','JNE',NULL,NULL,NULL,NULL,25000.00,375000.00,'Tolong bungkus yang rapi ya Bli.','2026-06-19 07:48:14','2026-06-19 07:48:14');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
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
-- Table structure for table `payment_transactions`
--

DROP TABLE IF EXISTS `payment_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `reference_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `status` enum('pending','paid','failed','expired') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `snap_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payment_transactions_reference_number_unique` (`reference_number`),
  KEY `payment_transactions_user_id_foreign` (`user_id`),
  KEY `idx_payment_transactions_status` (`status`),
  CONSTRAINT `payment_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_transactions`
--

LOCK TABLES `payment_transactions` WRITE;
/*!40000 ALTER TABLE `payment_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` VALUES (1,'Makanan','makanan','2026-06-19 07:48:12','2026-06-19 07:48:12'),(2,'Minuman','minuman','2026-06-19 07:48:12','2026-06-19 07:48:12'),(3,'Pakaian','pakaian','2026-06-19 07:48:12','2026-06-19 07:48:12'),(4,'Aksesoris','aksesoris','2026-06-19 07:48:12','2026-06-19 07:48:12'),(5,'Kesenian','kesenian','2026-06-19 07:48:12','2026-06-19 07:48:12');
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_product_id_foreign` (`product_id`),
  CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_reviews`
--

DROP TABLE IF EXISTS `product_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `order_id` bigint unsigned NOT NULL,
  `rating` int NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_reviews_user_id_product_id_order_id_unique` (`user_id`,`product_id`,`order_id`),
  KEY `product_reviews_product_id_foreign` (`product_id`),
  KEY `product_reviews_order_id_foreign` (`order_id`),
  CONSTRAINT `product_reviews_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_reviews`
--

LOCK TABLES `product_reviews` WRITE;
/*!40000 ALTER TABLE `product_reviews` DISABLE KEYS */;
INSERT INTO `product_reviews` VALUES (1,3,6,68,5,'Cincin Tridatu-nya pas di jari saya. Mantap Bli!','2026-06-19 07:48:14','2026-06-19 07:48:14');
/*!40000 ALTER TABLE `product_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint unsigned NOT NULL,
  `product_category_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `cost_price` decimal(12,2) NOT NULL,
  `sell_price` decimal(12,2) NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `weight` int NOT NULL DEFAULT '1000' COMMENT 'Weight in grams',
  `min_stock` int NOT NULL DEFAULT '5',
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `products_store_id_foreign` (`store_id`),
  KEY `idx_products_published_stock` (`is_published`,`stock`),
  KEY `idx_products_category` (`product_category_id`),
  CONSTRAINT `products_product_category_id_foreign` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `products_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,2,'Kopi Bali Kintamani 250g','kopi-bali-kintamani-250g','Produk asli buatan Bali dengan kualitas premium.',35000.00,65000.00,50,250,5,1,0,'2026-06-19 07:48:13','2026-06-19 07:48:13',NULL),(2,1,2,'Es Kopi Susu Gula Aren','es-kopi-susu-gula-aren','Produk asli buatan Bali dengan kualitas premium.',10000.00,22000.00,100,200,5,1,1,'2026-06-19 07:48:13','2026-06-19 07:48:13',NULL),(3,1,1,'Pie Susu Bali Premium (1 Kotak)','pie-susu-bali-premium-1-kotak','Produk asli buatan Bali dengan kualitas premium.',15000.00,35000.00,30,500,5,1,1,'2026-06-19 07:48:13','2026-06-19 07:48:13',NULL),(4,1,2,'Kopi Arabica Plaga 200g','kopi-arabica-plaga-200g','Produk asli buatan Bali dengan kualitas premium.',45000.00,85000.00,40,200,5,1,1,'2026-06-19 07:48:13','2026-06-19 07:48:13',NULL),(5,1,1,'Kacang Kapri Tari Bali','kacang-kapri-tari-bali','Produk asli buatan Bali dengan kualitas premium.',12000.00,25000.00,80,300,5,1,0,'2026-06-19 07:48:13','2026-06-19 07:48:13',NULL),(6,2,4,'Cincin Perak Ukir Tridatu','cincin-perak-ukir-tridatu','Kerajinan tangan otentik khas pengerajin lokal Bali.',150000.00,350000.00,15,50,2,1,1,'2026-06-19 07:48:13','2026-06-19 07:48:13',NULL),(7,2,4,'Kalung Mutiara Air Tawar','kalung-mutiara-air-tawar','Kerajinan tangan otentik khas pengerajin lokal Bali.',250000.00,600000.00,8,100,2,1,1,'2026-06-19 07:48:13','2026-06-19 07:48:13',NULL),(8,2,4,'Gelang Perak Anyam','gelang-perak-anyam','Kerajinan tangan otentik khas pengerajin lokal Bali.',120000.00,280000.00,20,80,2,1,1,'2026-06-19 07:48:13','2026-06-19 07:48:13',NULL),(9,2,4,'Bros Kebaya Perak','bros-kebaya-perak','Kerajinan tangan otentik khas pengerajin lokal Bali.',180000.00,450000.00,12,120,2,1,1,'2026-06-19 07:48:13','2026-06-19 07:48:13',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
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
INSERT INTO `sessions` VALUES ('0QXEaCXpdluu3Vg1x2I8DtuDtHWqrN5RVyfrDFjL',4,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiI1WEV6QVBDbWFJWk5NMWFrMG8wdjZzQVY2S3RrSEdnNnBFSDVlSFJ6IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6NH0=',1781884141),('0xbxB9TYFu3r4xspi2j54KLAyOnyKIzFgMcsI2wP',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJtczhYN0VMTXZXZklDTFZYZ0YzQ1JoREJmTjF4Sk4xeHNhMEh4MDZJIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9wcm9kdWN0c1wva29waS1iYWxpLWtpbnRhbWFuaS0yNTBnIiwicm91dGUiOiJwcm9kdWN0cy5zaG93In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjN9',1781884153),('1Gx8cyk5lRjKVIeCGn1nvWuFxmyeFWKdDG2jKuLx',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJrOEtVNmF4Y1c1QzdBVkxBMGRVZzVMUGVhZGsyZkdnUVI4Mkk1TzJVIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9jdXN0b21lclwvZGFzaGJvYXJkIiwicm91dGUiOiJjdXN0b21lci5kYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6M30=',1781884127),('2Q9RRmUkMfDRuqGEyQYTWuChpYJlwuqgPWsIabNs',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiI5TTBkOUVIOG9qUXdkNDFBM0xJRUVpVnpTbFZYSlpuVk5FNE15eTVhIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884157),('4HlUupxi5atYzLJB8mgrJzfZOnzz8UI7EhEoG2GU',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJKaWl2VDVDMlRZRzczeFRHRE1tMktGTllaSGlnRkJtaDFyOTBoWUk1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9wcm9kdWN0cyIsInJvdXRlIjoicHJvZHVjdHMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884124),('4poypOJTE69rgCTCN6jEhYDNklHvj6oRb2phNyyW',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJOQXJobjBmM3BPUUxTeWc1dzFrM1lWUzhjRlkxdU9YTnhIOWRZTVNBIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==',1781884259),('4qsqM3HTEoqVGcT75pkWlEtVW8rjdHMiIKxPkzdT',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJHYmJUUkZoNjFaM1pIWHJSUXNLZjliRXVwZXVySGFpTmJDcFhBQTJVIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9wcm9kdWN0cyIsInJvdXRlIjoicHJvZHVjdHMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884157),('5hEmBUII4TQnuoKhFJ3vyleORzWhlpoUnEaDMVpF',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJmQnl2YjF3Y3FxT1lpVjF1WDQ1ZWJPNk1aOUpGbzVsVFhvSHNrSVNtIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2N1c3RvbWVyXC9vcmRlcnNcLzk5OTk5OSJ9LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2N1c3RvbWVyXC9vcmRlcnNcLzk5OTk5OSIsInJvdXRlIjoiY3VzdG9tZXIub3JkZXJzLnNob3cifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884161),('5O9YgBScts9BmyrDX5b9gTC4t8tUBMfFD3tYvh1F',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiIxRWdDOXlicjN4TW53VGt3dmQyVTFUcjdmZkcwUXc3a2tyY0MwUjZ1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvc3RvcmVzIiwicm91dGUiOiJhZG1pbi5zdG9yZXMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=',1781884269),('6R55DgzgIKZeQvqSzxdlKtyn6oVKILxb1K127J5B',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJlNEN4NzhnU2pQYklkZFNJUFplcVc2R21Fb1QzY1FxRFJWUmRVV1JtIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884279),('7KvH0989dhY5qmhLPxjSjhqhbYsovh4zxdIKVio9',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJsRTNnWnBpampnV1hucVVOWmNzTnNzNWZLQkt6aGJHeW9td1RDcUsxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9jYXJ0Iiwicm91dGUiOiJjYXJ0LmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjN9',1781884271),('86OZlVkn9D5FUWAKmTOLNYe97O10MHNbB45IlLri',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJTWlZuMzV3Sk9PaFl2a0VWTU53QnNXVlVSTUM4OEEwOFVEdmtBQW9XIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvc3RvcmVzIiwicm91dGUiOiJhZG1pbi5zdG9yZXMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=',1781884161),('8DWPkeGWsTQx0XJjLi0aPoOKvN3GO0YqirixwLKy',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJMSnlteURnMFFMRHc4Q2kzMHVIUjJadEw1TDFLRTltaDBCaW5DNjZ6IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==',1781884255),('8jcmBAp0nxiGHjFW95YpYQGrqvXWunWcmi6JNja1',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiIxRDNSWlJLV3p5RVM3SHVtTGN4cm0yQTZoUmNOZUFjYkY3S0YyVmxXIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvc3RvcmVzIiwicm91dGUiOiJhZG1pbi5zdG9yZXMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=',1781884145),('ALfom2rspurx4Hg0FjmSCK002PxV0ftfLmQ8MRES',7,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJ5VENLVjFXZDJMem5zWm5xQ0l4d1BPY1RESTJjV1VBVDg5Rmg5SkRWIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9jdXN0b21lclwvZGFzaGJvYXJkIiwicm91dGUiOiJjdXN0b21lci5kYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6N30=',1781884274),('aTh3xVy61kfAgzq7FiKxsNVtjbVPcnRrEPldbPPU',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJCY2RvN3VkWWFXREVydjMycHNuam91QXlBaEh2T21mREg4ZVBOQk9lIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9yZWdpc3RlciIsInJvdXRlIjoicmVnaXN0ZXIifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884246),('aXUBnf1s46uOwqcJp7zek2bgvJsGHqcKYhoY66w0',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJYOHA3SUd2T05yQk5RWEJWU3pXdG9EQ01FTFNpam1yT2hqZGtsaHZsIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==',1781884159),('BHToXTlN96kIWFgwOhG81v1JiYopagjM8hPh6gyc',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiI5cmY0WVIzd0x5am90d1ZqSjNuaXVOemcwRlhEeTBreDRxRk9qVnZhIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvZGFzaGJvYXJkIiwicm91dGUiOiJhZG1pbi5kYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=',1781884285),('C86hjncCZl83E394sksGx31BwMU7Fmwk23ShqNF9',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJCaVUyT1dRY0Q0RWloalR6TTlkelF1bFE5QTJCWlAxekJiSUxBT2pWIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9yZWdpc3RlciIsInJvdXRlIjoicmVnaXN0ZXIifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884195),('cis7e4YPBxFkW23cyYnMlVmLbQF2VjElbr7t3IaK',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJSazhLZXVPMFJPQVpWc1lUUWd6WDR2djc3WURPRmJlelhhU3ZjdDBFIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9jdXN0b21lclwvb3JkZXJzXC82OCIsInJvdXRlIjoiY3VzdG9tZXIub3JkZXJzLnNob3cifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6M30=',1781884273),('dbL6vVU2y1fO5C7cg6B4FBLQYAk2OyBC0IlsBV6A',6,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJhaDh2UVAzMmpycnBlM2ZIQnR4ZlhieEdiVmZIQkduMkpNUlc3UnhJIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9zdG9yZXNcL2NyZWF0ZSIsInJvdXRlIjoic3RvcmVzLmNyZWF0ZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjo2fQ==',1781884162),('DdtsU52OJyJ10KZiFYUWv7j5SVEhSE9XK1HrFDwP',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJYTWFvNW90Slp1UGphRnJPWHJkZlpLbUZ3V1NKYlZacjZxRnJSbjVkIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884149),('De3SZ1dp58IVO34LGIQ1fjy5lzYj2BydPS8X9lJx',4,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJ2UWV4T3VzUUQ3clZBdnRwb2t1cXJpVGR1OWh3bWQzQVV5WTVaT2dlIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6NH0=',1781884138),('DgsXDFwUcRDK55lcZdKyLjwGdi7uo5jiRLXdKpPg',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJEM2JxMm5OVDFvcEhIbldGR3QxWjNPQ2piUjJVeWg1R1VISmwxdjFwIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvc3RvcmVzIiwicm91dGUiOiJhZG1pbi5zdG9yZXMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=',1781884145),('dkJOsMhnBhY8qRyMaKu8bu2rDU8jJYBHgtcxniDp',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJRd3BGTEtaUGRRZ09SeWJKeDhzdHdJUUhUS01vSExkVFlqVEZ4WFd3IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884273),('DNcPZaejFb3B98Fzzwx2QeGQqXtiD3e7drhBuwcy',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJCR2x1b2RZT2hnRGRCSmgxM0tYamVrank2Q2czT3RXNm1NMnJ4NEZIIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9jYXJ0Iiwicm91dGUiOiJjYXJ0LmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjN9',1781884271),('DvSzkbafp5Um15tQzUxc9IjDWV6rxaryfrS1ERbv',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJYME95SEhzc04wT2g0VVlscGRnemM5cnh4aXJ5TERvSHpNOEt5WDlXIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9jdXN0b21lclwvZGFzaGJvYXJkIiwicm91dGUiOiJjdXN0b21lci5kYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6M30=',1781884250),('E9rd1uKDrjbPqPcSp3CxHuoyaGH5PbaUd3YqGuhk',4,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJmQ3dVVHBud09RaGNxMUFGWlBVeGJZODlJZEN1a0V2T0laNzBsbGd1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6NH0=',1781884264),('eBBE0k5uW9FGSqn3QS2BDDKGxC73GXWEhGzWDOBA',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJ4elNVdGNIeXFFdVoxYnZCRGkzWGRRM2k3NzFxdmVOTHlWZU9ETHU3IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9jdXN0b21lclwvb3JkZXJzIiwicm91dGUiOiJjdXN0b21lci5vcmRlcnMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6M30=',1781884129),('EC0hqlvIffd4xXFQEhc5ocleSxiNCeny4hpuBZlF',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJiV0I1MGVYREZwb2dheUhGcndkd1lSYnQydnNWYWhOaUM4QWV4bzJ5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvc3RvcmVzIiwicm91dGUiOiJhZG1pbi5zdG9yZXMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=',1781884278),('Ei85NnI4Oa5xlEcyt94z13YG3GR9ZLUZkEzbR4aH',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJnbzB4YlB3bnAzNkQwd3RHN3dreVNvTmFYdmNKRFpGUXEyajN2RDg1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9wcm9kdWN0cyIsInJvdXRlIjoicHJvZHVjdHMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884145),('eZYykCTETkqPKlrZoqv7oQP4fYsBd62QxLzzNk71',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJ1bWY1UDFkMHBVVWxrdGlydXgxMEtMYnZZMlBCTzhiQVowSW54WktVIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJ1cmwiOnsiaW50ZW5kZWQiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYWRtaW5cL2Rhc2hib2FyZCJ9LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xvZ2luIiwicm91dGUiOiJsb2dpbiJ9fQ==',1781884273),('f3vjGbMgnhww35rZP2va9kmTGerGCpAzNKYE3Vux',4,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJkVHRSaFdRSzl6RjNlZ2RZY0g3S3RvUFJkWnl0ejdvaTk2bDR1Q3RPIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6NH0=',1781884273),('F5FMj3ArgaF3q7aAnQ486XgYdE3zojFixFBt8ogE',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJPMEdCc2htZVRJbFBoQ1hkR1pUb0NDOUptMmN6aGdONWczemhjVGkyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9yZWdpc3RlciIsInJvdXRlIjoicmVnaXN0ZXIifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884278),('Fb4HIhDTS4KcOqeF1p6KLcKgCtLaoDk77jhoiebZ',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJwZXZhb0lla2I5ZTNxY3lBNTNwaXBiQnpWUG9TQXc0cXdtWlRFTDJPIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884149),('ffuci3VZNR3Iw8IsSbEJUupjvIhyzmJC8tfwv2oY',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiIzYnpQNjRvQnBJUGpkRkpnTzJiOWZpenBSQTNEOUkwUTF4R3NNRHBsIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9wcm9kdWN0cyIsInJvdXRlIjoicHJvZHVjdHMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884248),('fLpwsrs7tzcEWUYg7yfLGkOttvJn5kSVy1sdpELe',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJkUEhnSXNVQ0ZlOTY1RGRSUzdDcml4M0NkZEltcWNpNlpiejFIWkRtIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2N1c3RvbWVyXC9vcmRlcnNcLzk5OTk5OSJ9LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2N1c3RvbWVyXC9vcmRlcnNcLzk5OTk5OSIsInJvdXRlIjoiY3VzdG9tZXIub3JkZXJzLnNob3cifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884283),('G9wOiDQNyjfPAqcCZ9BOXOGGmEMUJz2mYcJ3okce',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJMQU9XY0Zqd1YyNHZqV1FadjlMcTZLWXpwbEZTNGxGNDJGYjhIcXYxIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDAiLCJyb3V0ZSI6ImxhbmRpbmcifX0=',1781884278),('Gdgt7Z1oFalvQpwdzSyJxx3CHUkJcBqLCkldpOsy',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJ5ZGFsZ0R0YXBPUThNcEJ5VWRYWWxkVVdCTE9tbTNSdHF5TDJBYURrIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9yZWdpc3RlciIsInJvdXRlIjoicmVnaXN0ZXIifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884121),('gF0PeGHtgiRKhMZBp1W9kK4ZEf1XsgMWqwNyKLUF',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJDQk5YR1dPb1BkdmpTa1NDM2FqcE4xRE5DUG1ZS3VLeTlyMmtkZ2xlIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884273),('gqa4DE5vtg6Zdh05PzIIe8QWwA6iKR1AGpZYzn0S',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJES3lhQ0lZdjJSRGJTSmVWc0k2VHVheHhMYWFUeXJhUnZTWjBPNXBBIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmRcL29yZGVycyIsInJvdXRlIjoiZGFzaGJvYXJkLm9yZGVycy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==',1781884134),('H5jSqlWNx9RJ3yW4vTC25AOpacQhY8bJQ7QgRQSZ',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJOMEQ5dnd6emRWeml0Z3c3NVlmVkVxTVo0Z2dUNks4NWZOaHVoOHBnIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884159),('Hc7f7ZrVT8FsCbmvlgLMM6qvgPce56LnrWdx9rlK',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJ4MDdQZnhnenJGaDZmRmdFWXBKVjNVWkU3QWV1MlZSU0xRS2laQmpCIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJ1cmwiOnsiaW50ZW5kZWQiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYWRtaW5cL2Rhc2hib2FyZCJ9LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xvZ2luIiwicm91dGUiOiJsb2dpbiJ9fQ==',1781884149),('hCl7aE6Mm2SF6yYoBsC3YUBbbp71Mvwc5uBpKpPf',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJ4bnJHWVdNWkRuWWJzTzFpODFRTG9vVjRBQlA2TUlxQ2lBOXJKUjMzIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9wcm9kdWN0cyIsInJvdXRlIjoicHJvZHVjdHMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884280),('HHPC2Z7GwmaFb0VZqMuUYnyCm1IVb5RUBiVgKYJ3',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJMcTRRVEU3R3ZCWWhNWFlWdWUxUEJyVG1GcnhlVzlkd3BpeFRWSXdZIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvZGFzaGJvYXJkIiwicm91dGUiOiJhZG1pbi5kYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=',1781884267),('hIPeC8RSoemXqPFe3S6Rc6DJNV35Z3BFCC2r3dXB',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJkdndTeEZCNjBGaFh0ZG5QbktBU3kyNzN2dUF0Rk9uWU42ZFROWllNIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9jdXN0b21lclwvZGFzaGJvYXJkIiwicm91dGUiOiJjdXN0b21lci5kYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6M30=',1781884250),('hjXyx7Y4B0016QRLxthm9CpsiZGyETCkFY11ZGgH',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJHUGN1dnJxQlBPOG9vTWJTellGNHBwVlVBRURDb2lYRHVwVWhCNnUyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9jYXJ0Iiwicm91dGUiOiJjYXJ0LmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjN9',1781884276),('hsVaXeJ1O3ttCWT06LukbCxQUE7zRDNJ9gl1GHeG',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJCdm51NTlxQVYzUVlkN0JvZTI1TGUzcXphU3hpZEhDbExqWWxHbmFmIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9wcm9kdWN0cyIsInJvdXRlIjoicHJvZHVjdHMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884124),('hut1lrwaNFBJoC1q4HGOkzZHARmRnq5sDJqFNJFf',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJFN1RXUGV3a3FUVUdWTXRqVndoVlJZVTI4ODg5S2NHTTQxTEVsM1dhIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmRcL29yZGVycyIsInJvdXRlIjoiZGFzaGJvYXJkLm9yZGVycy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==',1781884149),('I3asaIb5NNXnGkqHd87dhWxExoEnIKfzGgKYsq81',4,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJUUW5LSkdKSnpNQTBMdEtMWUVKQnJrRUljUGRGNUE0Z3l0dHZhOTA4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6NH0=',1781884263),('IKcl2OhE5GOPV9Haa3SBT8gKzNQ604bci3iSzX7Q',4,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJUZVkza2RkM0NyRXZVWUdRVjJKZmszTEp2NjVLTWFZbXFadXY5MTdiIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6NH0=',1781884150),('j6EmwDNCTMDcHlwHLwvqL8eaJe2piEunTX6mPk1D',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJGNmV5VFo1dEY1dllGeEdlNDQyQnhORzdBY3VPSDUzZ2o3TWh2SDZOIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9zdG9yZSIsInJvdXRlIjoic3RvcmUuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884284),('j6s8V9lkwawfJu13v7JHXcYsNs5GeD0gwhNzBrnX',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJRMjNvZzM2UHBXQ1VzRjNTQ1Rpa0JlRjEyYW16Y2pvYm1lRG9mQXl1IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884158),('jllQ6PxptV62PAlXKd61DyoJYCUMEDIiM5oY9yxz',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiI4cGR4d2ZtN3N2T2dtSUhQdWp6emhaakF0ckxORlhuU1c3YVdJZXJWIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJ1cmwiOnsiaW50ZW5kZWQiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvY3VzdG9tZXJcL29yZGVyc1wvOTk5OTk5In0sIl9wcmV2aW91cyI6eyJ1cmwiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvbG9naW4iLCJyb3V0ZSI6ImxvZ2luIn19',1781884151),('KhJ5tCqyQtyqCEDuiL4UPEXzMSwxJyqcRVWTR0ZI',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJuMjZWa251UmNmdFZncE5KOHp6djdIM2RNNU9QaU1EQThXZHd1NEdxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9wcm9kdWN0c1wva29waS1iYWxpLWtpbnRhbWFuaS0yNTBnIiwicm91dGUiOiJwcm9kdWN0cy5zaG93In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjN9',1781884276),('kJGma17ftJgdFOb4jsvl5SrHU08nplZtCVvHXBJJ',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJrWkgwaXdSSGFuTDBFTTMyaEkwNHd5TkFjSjNwamZ0TnAzMk1aaXU5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==',1781884124),('KmmCq0BzVThkpNB8vcmv9O7a2vbIlwmMnJaxi1Be',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJRNUs3QXUzc2JzQXZJdDVRbjNhbXZoODJzQ1FEQkplTGlRWTBOS2lWIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9yZWdpc3RlciIsInJvdXRlIjoicmVnaXN0ZXIifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884286),('lpM28OCAWB5dZCR19QZpKRvNNMSgqft3KEgJpz6c',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJHcHNWWjJXWXR0dEhSTUtvd2VmMEVRSHc0VnF5MXpDZ0N2NDRxRVJYIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==',1781884281),('lzdpVEzTRbFY0pJgoeP8i6VfvMgPgkxfcwVtvBhk',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJCM3BTcTd5YmF3TDFSdFF0empQbjdvNXQwWlZIUnRrNVVZRWRjcHFsIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmRcL29yZGVycyIsInJvdXRlIjoiZGFzaGJvYXJkLm9yZGVycy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==',1781884272),('m2N9Vq4R59l4w7wje2sgTIdQuCObxeuQJNBEVdG1',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJHTDFORlNXa1JTSHY5b1VHYXdUT045TkJ4aEhoWXVzaURiVDBsc3FZIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==',1781884259),('MBNWwDCPByk80kaxGKb9dLdmybq1OmVrfGeIbsSb',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJ6SDVEZ09US1AxeEZoVklKa0Z0RjI2TGVRbjZHcHVsMTVjSllRNURIIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmRcL29yZGVycyIsInJvdXRlIjoiZGFzaGJvYXJkLm9yZGVycy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==',1781884149),('MDfTrNOp37u75xkCwOCyu5Z68SPglXKhyl9dhEBT',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiI1REY5NlNPM2JQRDBCcm9aNkNWRzE4RDNFRWV3SjFwanhHNHZLN2xkIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9jdXN0b21lclwvZGFzaGJvYXJkIiwicm91dGUiOiJjdXN0b21lci5kYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6M30=',1781884196),('MhHdNU0k3yXhz3XfcsMsRxguhfcumRufgFa015rH',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiIwVE5CekpVMnNzb0pxSjNhN0ZjSHJwZ1VzY0d3czhGSVl5V0VySzVtIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvc3RvcmVzIiwicm91dGUiOiJhZG1pbi5zdG9yZXMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=',1781884268),('MJyqOFuD4eHljMHQ8VBIuo7zBPaCup8JCEC2m8Uf',5,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJqYmRkQm9xYjFWRDgyM1JCYjRlWU1CcU4yVmpZWko1M0tnNzloQnVxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9jdXN0b21lclwvZGFzaGJvYXJkIiwicm91dGUiOiJjdXN0b21lci5kYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6NX0=',1781884151),('MTCXt1Rz6ZdQzo1BHauqy7pz8Hq8FK6QNIjzPMMP',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJ4Mmw1bnBQSzZ3TEd0bmlrcmdHZDZxWE03S2ZobVhpNzhQeEYxNEMzIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJ1cmwiOnsiaW50ZW5kZWQiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvY3VzdG9tZXJcL29yZGVyc1wvOTk5OTk5In0sIl9wcmV2aW91cyI6eyJ1cmwiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvbG9naW4iLCJyb3V0ZSI6ImxvZ2luIn19',1781884274),('O8gyeHIXPknGfs3rvfy43bp9BxQnEbPS0KldVsYe',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJWTVZMdWZPbm9SbW5Idm9od2p0TVJuSDhqU201OVNLYnVDRlA4WEw2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9jdXN0b21lclwvb3JkZXJzXC82OCIsInJvdXRlIjoiY3VzdG9tZXIub3JkZXJzLnNob3cifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6M30=',1781884149),('O8QwxtEmIZexFkzDz7wS1FFKng4gh9DpwNciLyXz',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiIyd3hsaGR0UlViTERmYzNuaVBCaFNYSjM5ZlVhTzZxYWpOckJ6RHkyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9jdXN0b21lclwvb3JkZXJzIiwicm91dGUiOiJjdXN0b21lci5vcmRlcnMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6M30=',1781884252),('Or7wDtUPchYh6fja3vM5Mk2v8mcFwFfnnttBujT7',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJFN1ZySzlwNlBocXhlVGFoT2hNT041REMxeVNLZGdjcXpTWDJMT0pjIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJ1cmwiOnsiaW50ZW5kZWQiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvY3VzdG9tZXJcL29yZGVyc1wvMSJ9LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xvZ2luIiwicm91dGUiOiJsb2dpbiJ9fQ==',1781884157),('OSC0T7M4hQ16iUwtDDWh0we3UCeCfftEaEzWdJsr',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJhMmJNc0I2djRiMWVwd0dXNVhFRFl2STZYVjg5S3VoaGgzeHNOeGJhIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvc3RvcmVzIiwicm91dGUiOiJhZG1pbi5zdG9yZXMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=',1781884154),('ouXNEoqIYfjlAquyEDD3w0HjphTAmro4iCChdXGq',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJucEZWczV5NERNek01OVh3MVNTNUtHNk9zNUt2cXY2MGk5UEFDcklNIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmRcL3Byb2R1Y3RzIiwicm91dGUiOiJkYXNoYm9hcmQucHJvZHVjdHMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6Mn0=',1781884255),('OY7VzKzbqpLMfWk0YycaTFk2nTQJaj4rRtcDhsDp',4,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJxSG9SVXdRUDFBZTNwYmM2V241cU9URmEyMHlMY3Z3WGxjZk9wRkpBIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6NH0=',1781884152),('Pg0ajicR53eg4E2FEZXjKb1yTmIXUNa6q3RyYELk',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJsRG9WMHk3Qks4SjZDSnlUSUIwcDh3NXR2bEhaaDNBT05qc20xSW9TIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9zdG9yZSIsInJvdXRlIjoic3RvcmUuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884161),('PH5ZgjfRlTyaiXxlSjtpv7SWWgOLjeLn9tFuloLc',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJaQk9RRHVHekFKZTBjdDJrUFdDdERacGM4TFVVUjRPZDlLUVhpcGpiIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884273),('pLXpNbMlPo5LHUqaK6xHrTY5ycHiMbI2uU0dHBtw',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJpdjVka3ZDM1FFMHV1M054d3RYcVZIWUlaR0t2Z3JLaUR3cEpSWEJsIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJsYW5kaW5nIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1781884246),('pmpUB0Hs5oHlshJByq1Pwe5BUPdBS4lYIZ0cH0gK',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJRdlMzbnY4WW15bTZ2QXViZDFHUUJ1ZkJWNENFUzVoUEJFbmNDa0h6IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884151),('QRD6Sp3diROvMkF5EfTPamKEvBwMIc4KOs89HpFY',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiI0Zm9pa1FaWHRrSmlXbDFFaTFZUW45cEh6SWloSXJxektNekJvYTZNIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmRcL3Byb2R1Y3RzIiwicm91dGUiOiJkYXNoYm9hcmQucHJvZHVjdHMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6Mn0=',1781884132),('QVWIao6B31odXQgg86EktsZ2Cu0WTUgFu2aicEFe',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJVRGY0Q3FOQ0NHNU5pUW9na090VXVhNzVlTG13dDZpQjFLMFJsODA0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvZGFzaGJvYXJkIiwicm91dGUiOiJhZG1pbi5kYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=',1781884143),('qYGYQYG84Z3qVaaQbAoTT1gZb3dJOf3FNe6eF6rd',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJMY0hyWlhwVlVzSFdEUmsxdnA2eWdzMFV3TW5UTFNKTGgwRERBYXBSIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDAiLCJyb3V0ZSI6ImxhbmRpbmcifX0=',1781884257),('raDksUgdzVyYQpYROaKNWbHvJLQhs2yCsRjceWLm',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJRQXZjSVdWYjhVVmZiVWh6RlhONFdiNmp2eTgwVzhrRE9Xd0FPRWFHIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvc3RvcmVzIiwicm91dGUiOiJhZG1pbi5zdG9yZXMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=',1781884283),('rhOwQQnXEAw1VPoGkv9Ih8pihnXPvAnQdAg8xVgR',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiI1MGxRdFBxbFpORzVNQjFaM3BNZDZIanRjbUR6QnR2bmZaR2lQelRCIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9jYXJ0Iiwicm91dGUiOiJjYXJ0LmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjN9',1781884153),('RZEnRXy1ZrSz02nk9uCI3by7o2GqsCKVS0yVLBpl',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJ2TUxIejhtejBMdXFmb2JuNW1KR3hqWEk5dWZWZzhSRkJvYkZVa2NFIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884274),('Sd3u43zoQfPCXQ2y0HYiBzoDZB3HLhBkaEbKVR0r',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJsb3ViaEplT3VQYjdYbUM3bGZHbUlWaHpnZVhZSTlWZVIzWnNZZjFMIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9jYXJ0Iiwicm91dGUiOiJjYXJ0LmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjN9',1781884147),('SmNTmeoXY7Drjmrd3qi5AK9vugb3mwGV5PkxZawB',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJ6QVVXRW5sWjRmUWJxd3E1UHpxd3pudEVoeDhlQmEwUTM5UFZsSFpJIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9jdXN0b21lclwvZGFzaGJvYXJkIiwicm91dGUiOiJjdXN0b21lci5kYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6M30=',1781884247),('SwQFKzFZRoKc1WfTr6eHoCKplbLFDHj6TnP1IE08',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJmMnVZOTBDb05JRG1WR3dUcVQ2N2ZaaGNsMzY3V3FkWGl3WkZoc1hnIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9jdXN0b21lclwvZGFzaGJvYXJkIiwicm91dGUiOiJjdXN0b21lci5kYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6M30=',1781884126),('TphRj9Fi3d0QxexGtRqrEYACSrTMfDD4OGZRijXB',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJ6TnB1OFk4UG90WTFyQWhzcnk2VzhMREtxcGpsNkpyOGc1bE8wUWVkIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==',1781884131),('Tx2hVdMOgn936qmVPJB0Lkcs6mHiAfq7rJiBbM99',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJXYnJndWtqSGxDVjBBVW1jNW1EU2UwN01hTVNUOTlMTHNtQm45Qm5vIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9jYXJ0Iiwicm91dGUiOiJjYXJ0LmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjN9',1781884147),('TxFhvs9ia7i9hl3W74qIbWHEeB3MBSCQAd3JabUt',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJqQTVuYzhCdGpTZ2dJNUNYRWd1ZWd3enBZT0VvSk9wZ0JVQ1ZaWG1IIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDAiLCJyb3V0ZSI6ImxhbmRpbmcifX0=',1781884135),('u8nAsH6VL0MXqy8eJzrVait7kg61tdqAAUm3TJkx',4,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJwUmRTVmtab0ZpYThieTBnczVBNk5NTTRKRTJzMWlnREpqeDJydEJ1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6NH0=',1781884261),('UB505B5RzNVuNSEhOnvnrWcT3yqeFFKrBUAxkU1m',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJVb1A5YWVFenE2MWh1MmFIcUxJem5aNTd1Rmhrc2NtRVdmNktTTEd3IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9yZWdpc3RlciIsInJvdXRlIjoicmVnaXN0ZXIifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884163),('uv7HvsIrSxUn823yWhda3TJ0xwFnagLCs8wbD9Kg',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJCM056SGZIc2pTWVZKTHE1S3k5Q3p4M21lZmxjYkY4dUZOUUNZSjRHIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmRcL3Byb2R1Y3RzXC9jcmVhdGUiLCJyb3V0ZSI6ImRhc2hib2FyZC5wcm9kdWN0cy5jcmVhdGUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6Mn0=',1781884163),('V7WMd83pHGABJIHMxHHtKIbAkYoubB59Kplqp8Qh',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJacUx6VTQ2S2pvSExBWlVRbmhBaWI0c2R0c1p6UzRKQXVOZDdLWTZKIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884280),('v8Mfwg5D4BcB2ZyEDTDmh4sbmUwbyEb8bSx1NzN3',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJhN3JNZ2FScFZHc3JRUWtvOWZlYU5wSXQxVzBHV2doeW9vbktRQlB0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9wcm9kdWN0cyIsInJvdXRlIjoicHJvZHVjdHMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884247),('VeY3jWMRgX2tByuHGg8vZdXxirumV2NRjmKheI1L',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJRUzdpMkVmaE1MdFloNTV3VTQxRXF6Sjc1TUpiUmZjb1lFUEpjcjRRIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9jdXN0b21lclwvZGFzaGJvYXJkIiwicm91dGUiOiJjdXN0b21lci5kYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6M30=',1781884124),('Vme2zmUzyiNyfn2jEXoIrUlwztENVUtPBVsbbV2y',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJwQXZ2d3lNd3oxQ0RiUlZlbVg5OUI2SFRXWnJKdnhTVUwzUHlsVDVLIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884282),('wBKWzMVBTMeDUFHxbNhSuL8Sybn2G9mitGS9Pdco',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJpZUJteEZvbThxbWlQeUUyODFWT2h5M1VIbEZrZjNUUlgxNjhScGFPIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9jYXJ0Iiwicm91dGUiOiJjYXJ0LmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjN9',1781884251),('WSeNy54viIdX8ukB1CFj0lgYPR1Xyfr02hQ48IcK',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJYZVJNb3RncWJqZnExYVpOTktzdExhTWc5Z0VEajdaZGdYNjVqbmY1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==',1781884196),('wSH7uyHXWZtbC9MvQl2BV5GwRer1hZEkwi0CQMIm',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiI4b3VHUVFjWlU4UDRMVmw1OW9tTzhFMVRXOXdwOUxic2tQNU1LT2tLIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmRcL3Byb2R1Y3RzXC9jcmVhdGUiLCJyb3V0ZSI6ImRhc2hib2FyZC5wcm9kdWN0cy5jcmVhdGUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6Mn0=',1781884286),('wSSFkENgxui3rRfb3J5l04opPmtofaSjyR6KE8vq',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJBdTVjM0JKdFVpbkJvQ0NxTUJRMmFuajFVdXFzNWhBdk53Qk9rZWdaIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDAiLCJyb3V0ZSI6ImxhbmRpbmcifX0=',1781884155),('X8LYpCIVuEiYWP3aCeF2m2gRBuyzSM4H4LQvqfdl',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJtblRwaFJleTRwbHRvZXE4dlBDVFpVUHQ1blFlQ2JpZThueUdHRDB5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9jYXJ0Iiwicm91dGUiOiJjYXJ0LmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjN9',1781884128),('x9NbESej3TbeX0MY1URNNqLmgforl5eh7j67mmF1',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJJaXdIQWRhbmlOWjFWRmI1RDc2azRjekxYUGxrS3J2bVdwUU1OYUNBIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmRcL29yZGVycyIsInJvdXRlIjoiZGFzaGJvYXJkLm9yZGVycy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==',1781884272),('X9pesX3MlNidlr3jUHG5YpWHWMK2oRhSn6GfWizV',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJ6S0Z2TWxkdVhISXJMU2Nub3BuTmlQNWZKMWJsMUJwZ2M2QlZvdlZ0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==',1781884248),('XmdGVdE5UuUo2wExnQhyyRd4potP3oETURqby1jP',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJ3VDltYjRGRFlWMWs5VWJDbjhSNG56UUV5U3g5ak81T25BR29qZkl5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==',1781884136),('xO7C0PCyRm0rTrxnCAzKwQlE2kdbsLAL0Ark6sGN',8,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJYTWt4eUNoRVNMQmN4QlFOMVJ5V20wemdvZHp1NnNGazlrTmUyZ3JJIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9zdG9yZXNcL2NyZWF0ZSIsInJvdXRlIjoic3RvcmVzLmNyZWF0ZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjo4fQ==',1781884286),('XpxTH6n6iZBdBt3LXAiEsvI0RFtPRsjELB2iwxqn',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJJcEdzbmY3dE1XSENjMUpzam1VUVhvSzcyOVpBckd2b2phdlA5VUtaIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9yZWdpc3RlciIsInJvdXRlIjoicmVnaXN0ZXIifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884155),('Y08ERlnbJJI9X7kIlVwaRvqUmqGOOrMNgVAmssox',4,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJGSlljeTFBVkYxNU1NQm91VGx2dTdweTI1RW15QmZnWno4aG1yeEpRIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6NH0=',1781884276),('ybdmCDNYpoLC3phpjRoMUGl8naJ58wZOjNNBhJxT',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJLc0phM2VFZVNjaGRNU2pZSVlYQjk1NmhISzVpN3lnNVZDa0VkT0VpIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmRcL29yZGVycyIsInJvdXRlIjoiZGFzaGJvYXJkLm9yZGVycy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==',1781884257),('YBNl5RJPibrrL12pd2Ud3c1xW7vUEfLIXMDCtoaL',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJBRkZrS1RrRHRWc1h5SlpqSUFPcGNvSmdHbmQySjBoRnI5bHNhV0V6IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9wcm9kdWN0cyIsInJvdXRlIjoicHJvZHVjdHMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884269),('YR5fZsykQSKbq2y9ImgF2uDe2pQC6qmowsdYA1Uw',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJCcHpMa1JDT1RKdjBLcjZXbUx1UjFUcHk1WjBjMkFPSnJmT3NmT1RlIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884149),('ZB5RtEXfugD8viO0ilZxFEe58NhuTrRR4a91iNSu',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJNbkRkVGxneUF1blBaczN2NEJMYlkyRnpIeFJrZEg2WEYyYXFOMllFIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==',1781884136),('ZDyrvJRNTINIKxnFaxxD8u7wjex5H96PpWEjrfOt',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiI2MkVGVTg0eEdwNkdqcm4xd1RnMTRWaTNZVWtxcmpSWFpBUFV1bGxkIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884160),('zghoNWojveIO0geLukQOAAayqDIQGeHwtVk6V5qY',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJra3ZTbVd4eXFqWjFKZDFlRkl6cmpRdkt1NXl5RkhZWXk2MElGbzREIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJsYW5kaW5nIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1781884121),('ZPD9cSgulxH188Qx5bdNHZQIOeRXB8qnu4lweHQH',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJwdlJRRnpJR1B1WGpzZ3J3d2NIMXVZcEpBN2tJbXluOW9vZ0tPZzI0IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJ1cmwiOnsiaW50ZW5kZWQiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvY3VzdG9tZXJcL29yZGVyc1wvMSJ9LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xvZ2luIiwicm91dGUiOiJsb2dpbiJ9fQ==',1781884279),('zpPYx20PcF7CFATrPixk7EYpb5RWW6SfHpPGKkdd',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJyTE1WWEdXUllVa2hmSDB6WFA5ZThRbjBJM1hGNW85NmlSMUF4Mk9WIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781884283),('zuxVcViC2KHbk30dpOqyFQC1zf4mCFc3rcpUxL0C',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJiUXlvOUhLU0hndXkxcFBsdUxMcGdPV3k0ekVIdjM5Y3BQWjF3Q1cwIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvZGFzaGJvYXJkIiwicm91dGUiOiJhZG1pbi5kYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=',1781884162),('ZWx3qz3oFFdN2rIMQSPHeg7lVANIAoBvZ39Fwyt2',4,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36','eyJfdG9rZW4iOiJRYTVmaHBQNXBCaVNEMEhGQVA2anlxY0NsN2h4RVdtRFM0MlFaMDVPIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6NH0=',1781884138);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store_banners`
--

DROP TABLE IF EXISTS `store_banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `store_banners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint unsigned NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `store_banners_store_id_foreign` (`store_id`),
  CONSTRAINT `store_banners_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store_banners`
--

LOCK TABLES `store_banners` WRITE;
/*!40000 ALTER TABLE `store_banners` DISABLE KEYS */;
/*!40000 ALTER TABLE `store_banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store_categories`
--

DROP TABLE IF EXISTS `store_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `store_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `store_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store_categories`
--

LOCK TABLES `store_categories` WRITE;
/*!40000 ALTER TABLE `store_categories` DISABLE KEYS */;
INSERT INTO `store_categories` VALUES (1,'Kuliner','kuliner','2026-06-19 07:48:12','2026-06-19 07:48:12'),(2,'Kerajinan Tangan','kerajinan-tangan','2026-06-19 07:48:12','2026-06-19 07:48:12'),(3,'Fashion','fashion','2026-06-19 07:48:12','2026-06-19 07:48:12'),(4,'Jasa','jasa','2026-06-19 07:48:12','2026-06-19 07:48:12');
/*!40000 ALTER TABLE `store_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store_reviews`
--

DROP TABLE IF EXISTS `store_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `store_reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `store_id` bigint unsigned NOT NULL,
  `order_id` bigint unsigned NOT NULL,
  `rating` int NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `store_reviews_user_id_store_id_order_id_unique` (`user_id`,`store_id`,`order_id`),
  KEY `store_reviews_store_id_foreign` (`store_id`),
  KEY `store_reviews_order_id_foreign` (`order_id`),
  CONSTRAINT `store_reviews_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `store_reviews_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE,
  CONSTRAINT `store_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store_reviews`
--

LOCK TABLES `store_reviews` WRITE;
/*!40000 ALTER TABLE `store_reviews` DISABLE KEYS */;
INSERT INTO `store_reviews` VALUES (1,3,2,68,5,'Peraknya sangat indah dan ukirannya rapi!','2026-06-19 07:48:14','2026-06-19 07:48:14');
/*!40000 ALTER TABLE `store_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store_settings`
--

DROP TABLE IF EXISTS `store_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `store_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint unsigned NOT NULL,
  `logo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operational_hours` json DEFAULT NULL,
  `social_links` json DEFAULT NULL,
  `theme_config` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `store_settings_store_id_foreign` (`store_id`),
  CONSTRAINT `store_settings_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store_settings`
--

LOCK TABLES `store_settings` WRITE;
/*!40000 ALTER TABLE `store_settings` DISABLE KEYS */;
INSERT INTO `store_settings` VALUES (1,1,NULL,NULL,NULL,NULL,NULL,'2026-06-19 07:48:13','2026-06-19 07:48:13'),(2,2,NULL,NULL,NULL,NULL,NULL,'2026-06-19 07:48:13','2026-06-19 07:48:13');
/*!40000 ALTER TABLE `store_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_category_id` bigint unsigned DEFAULT NULL,
  `contact` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `stores_slug_unique` (`slug`),
  KEY `businesses_user_id_foreign` (`user_id`),
  KEY `stores_store_category_id_foreign` (`store_category_id`),
  CONSTRAINT `businesses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `stores_store_category_id_foreign` FOREIGN KEY (`store_category_id`) REFERENCES `store_categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stores`
--

LOCK TABLES `stores` WRITE;
/*!40000 ALTER TABLE `stores` DISABLE KEYS */;
INSERT INTO `stores` VALUES (1,2,'Warung Kopi Bali Wayan','warung-kopi-bali-wayan',NULL,1,'081234567890','Jl. Raya Ubud No. 23, Gianyar, Bali','Warung kopi tradisional Bali dengan sentuhan modern, menyajikan kopi khas Kintamani dan makanan ringan lokal dengan cita rasa otentik.','2026-06-19 07:48:13','2026-06-19 07:48:13',NULL),(2,2,'Kerajinan Perak Celuk','kerajinan-perak-celuk',NULL,2,'081234567891','Desa Celuk, Gianyar, Bali','Pengrajin perak asli Desa Celuk yang memproduksi aksesoris perak 925 buatan tangan dengan ukiran khas Bali yang detail dan elegan.','2026-06-19 07:48:13','2026-06-19 07:48:13',NULL);
/*!40000 ALTER TABLE `stores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suspensions`
--

DROP TABLE IF EXISTS `suspensions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `suspensions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` bigint unsigned NOT NULL,
  `suspendable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suspendable_id` bigint unsigned NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `suspensions_admin_id_foreign` (`admin_id`),
  KEY `suspensions_suspendable_type_suspendable_id_index` (`suspendable_type`,`suspendable_id`),
  CONSTRAINT `suspensions_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suspensions`
--

LOCK TABLES `suspensions` WRITE;
/*!40000 ALTER TABLE `suspensions` DISABLE KEYS */;
/*!40000 ALTER TABLE `suspensions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_details`
--

DROP TABLE IF EXISTS `transaction_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaction_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `cost_price` decimal(12,2) NOT NULL,
  `sell_price` decimal(12,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_details_transaction_id_foreign` (`transaction_id`),
  KEY `idx_td_created_at` (`created_at`),
  KEY `transaction_details_product_id_foreign` (`product_id`),
  CONSTRAINT `transaction_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  CONSTRAINT `transaction_details_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_details`
--

LOCK TABLES `transaction_details` WRITE;
/*!40000 ALTER TABLE `transaction_details` DISABLE KEYS */;
INSERT INTO `transaction_details` VALUES (1,1,1,'Kopi Bali Kintamani 250g',1,39000.00,65000.00,65000.00,'2026-05-21 23:39:13','2026-05-22 01:16:13'),(2,2,1,'Kopi Bali Kintamani 250g',1,39000.00,65000.00,65000.00,'2026-05-21 20:34:13','2026-05-22 02:13:13'),(3,3,2,'Es Kopi Susu Gula Aren',3,13200.00,22000.00,66000.00,'2026-05-21 22:15:13','2026-05-22 03:38:13'),(4,3,3,'Pie Susu Bali Premium (1 Kotak)',2,21000.00,35000.00,70000.00,'2026-05-21 22:15:13','2026-05-22 03:38:13'),(5,3,5,'Kacang Kapri Tari Bali',1,15000.00,25000.00,25000.00,'2026-05-21 22:15:13','2026-05-22 03:38:13'),(6,4,1,'Kopi Bali Kintamani 250g',2,39000.00,65000.00,130000.00,'2026-05-22 04:29:13','2026-05-21 19:30:13'),(7,4,3,'Pie Susu Bali Premium (1 Kotak)',3,21000.00,35000.00,105000.00,'2026-05-22 04:29:13','2026-05-21 19:30:13'),(8,5,3,'Pie Susu Bali Premium (1 Kotak)',3,21000.00,35000.00,105000.00,'2026-05-23 02:16:13','2026-05-23 02:07:13'),(9,5,4,'Kopi Arabica Plaga 200g',1,51000.00,85000.00,85000.00,'2026-05-23 02:16:13','2026-05-23 02:07:13'),(10,5,5,'Kacang Kapri Tari Bali',2,15000.00,25000.00,50000.00,'2026-05-23 02:16:13','2026-05-23 02:07:13'),(11,6,2,'Es Kopi Susu Gula Aren',3,13200.00,22000.00,66000.00,'2026-05-22 20:03:13','2026-05-22 21:44:13'),(12,7,1,'Kopi Bali Kintamani 250g',1,39000.00,65000.00,65000.00,'2026-05-23 16:54:13','2026-05-24 00:39:13'),(13,7,5,'Kacang Kapri Tari Bali',1,15000.00,25000.00,25000.00,'2026-05-23 16:54:13','2026-05-24 00:39:13'),(14,8,1,'Kopi Bali Kintamani 250g',2,39000.00,65000.00,130000.00,'2026-05-24 04:35:13','2026-05-23 19:53:13'),(15,8,2,'Es Kopi Susu Gula Aren',2,13200.00,22000.00,44000.00,'2026-05-24 04:35:13','2026-05-23 19:53:13'),(16,9,1,'Kopi Bali Kintamani 250g',2,39000.00,65000.00,130000.00,'2026-05-23 21:36:13','2026-05-24 03:36:13'),(17,9,3,'Pie Susu Bali Premium (1 Kotak)',2,21000.00,35000.00,70000.00,'2026-05-23 21:36:13','2026-05-24 03:36:13'),(18,9,4,'Kopi Arabica Plaga 200g',1,51000.00,85000.00,85000.00,'2026-05-23 21:36:13','2026-05-24 03:36:13'),(19,10,2,'Es Kopi Susu Gula Aren',3,13200.00,22000.00,66000.00,'2026-05-23 17:22:13','2026-05-23 22:53:13'),(20,10,3,'Pie Susu Bali Premium (1 Kotak)',1,21000.00,35000.00,35000.00,'2026-05-23 17:22:13','2026-05-23 22:53:13'),(21,10,4,'Kopi Arabica Plaga 200g',1,51000.00,85000.00,85000.00,'2026-05-23 17:22:13','2026-05-23 22:53:13'),(22,11,1,'Kopi Bali Kintamani 250g',1,39000.00,65000.00,65000.00,'2026-05-25 04:26:13','2026-05-25 02:13:13'),(23,12,1,'Kopi Bali Kintamani 250g',1,39000.00,65000.00,65000.00,'2026-05-24 16:49:13','2026-05-24 23:42:13'),(24,12,3,'Pie Susu Bali Premium (1 Kotak)',3,21000.00,35000.00,105000.00,'2026-05-24 16:49:13','2026-05-24 23:42:13'),(25,13,3,'Pie Susu Bali Premium (1 Kotak)',3,21000.00,35000.00,105000.00,'2026-05-25 19:03:13','2026-05-25 21:14:13'),(26,13,5,'Kacang Kapri Tari Bali',3,15000.00,25000.00,75000.00,'2026-05-25 19:03:13','2026-05-25 21:14:13'),(27,14,4,'Kopi Arabica Plaga 200g',2,51000.00,85000.00,170000.00,'2026-05-27 01:00:13','2026-05-27 01:32:13'),(28,15,2,'Es Kopi Susu Gula Aren',2,13200.00,22000.00,44000.00,'2026-05-28 02:19:13','2026-05-27 20:43:13'),(29,15,3,'Pie Susu Bali Premium (1 Kotak)',1,21000.00,35000.00,35000.00,'2026-05-28 02:19:13','2026-05-27 20:43:13'),(30,15,4,'Kopi Arabica Plaga 200g',3,51000.00,85000.00,255000.00,'2026-05-28 02:19:13','2026-05-27 20:43:13'),(31,16,1,'Kopi Bali Kintamani 250g',2,39000.00,65000.00,130000.00,'2026-05-28 03:04:13','2026-05-27 19:23:13'),(32,16,3,'Pie Susu Bali Premium (1 Kotak)',3,21000.00,35000.00,105000.00,'2026-05-28 03:04:13','2026-05-27 19:23:13'),(33,16,5,'Kacang Kapri Tari Bali',3,15000.00,25000.00,75000.00,'2026-05-28 03:04:13','2026-05-27 19:23:13'),(34,17,2,'Es Kopi Susu Gula Aren',1,13200.00,22000.00,22000.00,'2026-05-28 20:05:13','2026-05-28 20:02:13'),(35,17,3,'Pie Susu Bali Premium (1 Kotak)',1,21000.00,35000.00,35000.00,'2026-05-28 20:05:13','2026-05-28 20:02:13'),(36,17,5,'Kacang Kapri Tari Bali',2,15000.00,25000.00,50000.00,'2026-05-28 20:05:13','2026-05-28 20:02:13'),(37,18,1,'Kopi Bali Kintamani 250g',2,39000.00,65000.00,130000.00,'2026-05-30 02:15:13','2026-05-29 19:47:13'),(38,18,4,'Kopi Arabica Plaga 200g',2,51000.00,85000.00,170000.00,'2026-05-30 02:15:13','2026-05-29 19:47:13'),(39,18,5,'Kacang Kapri Tari Bali',1,15000.00,25000.00,25000.00,'2026-05-30 02:15:13','2026-05-29 19:47:13'),(40,19,3,'Pie Susu Bali Premium (1 Kotak)',3,21000.00,35000.00,105000.00,'2026-05-29 17:41:13','2026-05-30 00:52:13'),(41,19,5,'Kacang Kapri Tari Bali',1,15000.00,25000.00,25000.00,'2026-05-29 17:41:13','2026-05-30 00:52:13'),(42,20,1,'Kopi Bali Kintamani 250g',3,39000.00,65000.00,195000.00,'2026-05-31 04:26:13','2026-05-31 03:54:13'),(43,20,2,'Es Kopi Susu Gula Aren',1,13200.00,22000.00,22000.00,'2026-05-31 04:26:13','2026-05-31 03:54:13'),(44,20,5,'Kacang Kapri Tari Bali',1,15000.00,25000.00,25000.00,'2026-05-31 04:26:13','2026-05-31 03:54:13'),(45,21,2,'Es Kopi Susu Gula Aren',1,13200.00,22000.00,22000.00,'2026-05-31 03:27:13','2026-05-30 21:35:13'),(46,21,4,'Kopi Arabica Plaga 200g',3,51000.00,85000.00,255000.00,'2026-05-31 03:27:13','2026-05-30 21:35:13'),(47,22,1,'Kopi Bali Kintamani 250g',1,39000.00,65000.00,65000.00,'2026-05-30 20:12:13','2026-05-31 03:45:13'),(48,23,1,'Kopi Bali Kintamani 250g',3,39000.00,65000.00,195000.00,'2026-06-01 00:01:13','2026-06-01 03:27:13'),(49,23,2,'Es Kopi Susu Gula Aren',2,13200.00,22000.00,44000.00,'2026-06-01 00:01:13','2026-06-01 03:27:13'),(50,24,1,'Kopi Bali Kintamani 250g',3,39000.00,65000.00,195000.00,'2026-06-01 02:24:13','2026-06-01 00:16:13'),(51,25,4,'Kopi Arabica Plaga 200g',2,51000.00,85000.00,170000.00,'2026-06-01 17:57:14','2026-06-02 04:30:14'),(52,26,5,'Kacang Kapri Tari Bali',2,15000.00,25000.00,50000.00,'2026-06-03 03:05:14','2026-06-02 16:57:14'),(53,27,2,'Es Kopi Susu Gula Aren',3,13200.00,22000.00,66000.00,'2026-06-02 22:10:14','2026-06-03 04:16:14'),(54,27,3,'Pie Susu Bali Premium (1 Kotak)',1,21000.00,35000.00,35000.00,'2026-06-02 22:10:14','2026-06-03 04:16:14'),(55,27,4,'Kopi Arabica Plaga 200g',2,51000.00,85000.00,170000.00,'2026-06-02 22:10:14','2026-06-03 04:16:14'),(56,28,4,'Kopi Arabica Plaga 200g',2,51000.00,85000.00,170000.00,'2026-06-03 02:58:14','2026-06-03 03:31:14'),(57,28,5,'Kacang Kapri Tari Bali',2,15000.00,25000.00,50000.00,'2026-06-03 02:58:14','2026-06-03 03:31:14'),(58,29,3,'Pie Susu Bali Premium (1 Kotak)',1,21000.00,35000.00,35000.00,'2026-06-02 18:17:14','2026-06-03 03:50:14'),(59,29,4,'Kopi Arabica Plaga 200g',2,51000.00,85000.00,170000.00,'2026-06-02 18:17:14','2026-06-03 03:50:14'),(60,30,2,'Es Kopi Susu Gula Aren',3,13200.00,22000.00,66000.00,'2026-06-04 04:14:14','2026-06-03 16:47:14'),(61,31,1,'Kopi Bali Kintamani 250g',2,39000.00,65000.00,130000.00,'2026-06-03 16:26:14','2026-06-04 01:08:14'),(62,31,4,'Kopi Arabica Plaga 200g',2,51000.00,85000.00,170000.00,'2026-06-03 16:26:14','2026-06-04 01:08:14'),(63,31,5,'Kacang Kapri Tari Bali',3,15000.00,25000.00,75000.00,'2026-06-03 16:26:14','2026-06-04 01:08:14'),(64,32,2,'Es Kopi Susu Gula Aren',3,13200.00,22000.00,66000.00,'2026-06-04 21:22:14','2026-06-04 18:41:14'),(65,33,3,'Pie Susu Bali Premium (1 Kotak)',1,21000.00,35000.00,35000.00,'2026-06-05 00:46:14','2026-06-04 20:37:14'),(66,33,4,'Kopi Arabica Plaga 200g',2,51000.00,85000.00,170000.00,'2026-06-05 00:46:14','2026-06-04 20:37:14'),(67,34,2,'Es Kopi Susu Gula Aren',2,13200.00,22000.00,44000.00,'2026-06-05 19:05:14','2026-06-06 02:45:14'),(68,34,4,'Kopi Arabica Plaga 200g',2,51000.00,85000.00,170000.00,'2026-06-05 19:05:14','2026-06-06 02:45:14'),(69,35,2,'Es Kopi Susu Gula Aren',1,13200.00,22000.00,22000.00,'2026-06-05 16:35:14','2026-06-05 23:32:14'),(70,36,3,'Pie Susu Bali Premium (1 Kotak)',2,21000.00,35000.00,70000.00,'2026-06-06 01:42:14','2026-06-05 22:33:14'),(71,36,4,'Kopi Arabica Plaga 200g',1,51000.00,85000.00,85000.00,'2026-06-06 01:42:14','2026-06-05 22:33:14'),(72,36,5,'Kacang Kapri Tari Bali',2,15000.00,25000.00,50000.00,'2026-06-06 01:42:14','2026-06-05 22:33:14'),(73,37,2,'Es Kopi Susu Gula Aren',2,13200.00,22000.00,44000.00,'2026-06-06 16:46:14','2026-06-07 00:46:14'),(74,37,3,'Pie Susu Bali Premium (1 Kotak)',1,21000.00,35000.00,35000.00,'2026-06-06 16:46:14','2026-06-07 00:46:14'),(75,37,4,'Kopi Arabica Plaga 200g',1,51000.00,85000.00,85000.00,'2026-06-06 16:46:14','2026-06-07 00:46:14'),(76,38,1,'Kopi Bali Kintamani 250g',3,39000.00,65000.00,195000.00,'2026-06-07 19:30:14','2026-06-08 01:08:14'),(77,38,2,'Es Kopi Susu Gula Aren',2,13200.00,22000.00,44000.00,'2026-06-07 19:30:14','2026-06-08 01:08:14'),(78,38,3,'Pie Susu Bali Premium (1 Kotak)',3,21000.00,35000.00,105000.00,'2026-06-07 19:30:14','2026-06-08 01:08:14'),(79,39,1,'Kopi Bali Kintamani 250g',3,39000.00,65000.00,195000.00,'2026-06-07 21:08:14','2026-06-07 19:48:14'),(80,39,2,'Es Kopi Susu Gula Aren',3,13200.00,22000.00,66000.00,'2026-06-07 21:08:14','2026-06-07 19:48:14'),(81,39,5,'Kacang Kapri Tari Bali',1,15000.00,25000.00,25000.00,'2026-06-07 21:08:14','2026-06-07 19:48:14'),(82,40,2,'Es Kopi Susu Gula Aren',3,13200.00,22000.00,66000.00,'2026-06-08 03:14:14','2026-06-07 16:40:14'),(83,40,3,'Pie Susu Bali Premium (1 Kotak)',1,21000.00,35000.00,35000.00,'2026-06-08 03:14:14','2026-06-07 16:40:14'),(84,41,5,'Kacang Kapri Tari Bali',3,15000.00,25000.00,75000.00,'2026-06-09 04:20:14','2026-06-08 22:37:14'),(85,42,1,'Kopi Bali Kintamani 250g',3,39000.00,65000.00,195000.00,'2026-06-09 02:21:14','2026-06-09 01:26:14'),(86,42,5,'Kacang Kapri Tari Bali',3,15000.00,25000.00,75000.00,'2026-06-09 02:21:14','2026-06-09 01:26:14'),(87,43,3,'Pie Susu Bali Premium (1 Kotak)',2,21000.00,35000.00,70000.00,'2026-06-08 18:07:14','2026-06-09 00:42:14'),(88,43,5,'Kacang Kapri Tari Bali',1,15000.00,25000.00,25000.00,'2026-06-08 18:07:14','2026-06-09 00:42:14'),(89,44,1,'Kopi Bali Kintamani 250g',2,39000.00,65000.00,130000.00,'2026-06-08 22:38:14','2026-06-09 00:18:14'),(90,44,3,'Pie Susu Bali Premium (1 Kotak)',3,21000.00,35000.00,105000.00,'2026-06-08 22:38:14','2026-06-09 00:18:14'),(91,44,5,'Kacang Kapri Tari Bali',3,15000.00,25000.00,75000.00,'2026-06-08 22:38:14','2026-06-09 00:18:14'),(92,45,4,'Kopi Arabica Plaga 200g',2,51000.00,85000.00,170000.00,'2026-06-09 20:11:14','2026-06-09 20:39:14'),(93,45,5,'Kacang Kapri Tari Bali',1,15000.00,25000.00,25000.00,'2026-06-09 20:11:14','2026-06-09 20:39:14'),(94,46,1,'Kopi Bali Kintamani 250g',2,39000.00,65000.00,130000.00,'2026-06-10 01:26:14','2026-06-09 23:32:14'),(95,46,2,'Es Kopi Susu Gula Aren',3,13200.00,22000.00,66000.00,'2026-06-10 01:26:14','2026-06-09 23:32:14'),(96,46,4,'Kopi Arabica Plaga 200g',1,51000.00,85000.00,85000.00,'2026-06-10 01:26:14','2026-06-09 23:32:14'),(97,47,3,'Pie Susu Bali Premium (1 Kotak)',1,21000.00,35000.00,35000.00,'2026-06-11 00:22:14','2026-06-11 00:52:14'),(98,47,4,'Kopi Arabica Plaga 200g',3,51000.00,85000.00,255000.00,'2026-06-11 00:22:14','2026-06-11 00:52:14'),(99,47,5,'Kacang Kapri Tari Bali',3,15000.00,25000.00,75000.00,'2026-06-11 00:22:14','2026-06-11 00:52:14'),(100,48,3,'Pie Susu Bali Premium (1 Kotak)',3,21000.00,35000.00,105000.00,'2026-06-11 03:33:14','2026-06-10 17:00:14'),(101,49,5,'Kacang Kapri Tari Bali',2,15000.00,25000.00,50000.00,'2026-06-10 15:49:14','2026-06-10 20:05:14'),(102,50,3,'Pie Susu Bali Premium (1 Kotak)',3,21000.00,35000.00,105000.00,'2026-06-11 00:11:14','2026-06-10 23:07:14'),(103,51,2,'Es Kopi Susu Gula Aren',1,13200.00,22000.00,22000.00,'2026-06-11 20:17:14','2026-06-12 04:44:14'),(104,51,5,'Kacang Kapri Tari Bali',3,15000.00,25000.00,75000.00,'2026-06-11 20:17:14','2026-06-12 04:44:14'),(105,52,2,'Es Kopi Susu Gula Aren',3,13200.00,22000.00,66000.00,'2026-06-12 19:50:14','2026-06-12 23:11:14'),(106,52,3,'Pie Susu Bali Premium (1 Kotak)',1,21000.00,35000.00,35000.00,'2026-06-12 19:50:14','2026-06-12 23:11:14'),(107,53,1,'Kopi Bali Kintamani 250g',2,39000.00,65000.00,130000.00,'2026-06-13 02:59:14','2026-06-13 03:55:14'),(108,53,2,'Es Kopi Susu Gula Aren',2,13200.00,22000.00,44000.00,'2026-06-13 02:59:14','2026-06-13 03:55:14'),(109,53,5,'Kacang Kapri Tari Bali',3,15000.00,25000.00,75000.00,'2026-06-13 02:59:14','2026-06-13 03:55:14'),(110,54,1,'Kopi Bali Kintamani 250g',2,39000.00,65000.00,130000.00,'2026-06-12 17:59:14','2026-06-12 16:10:14'),(111,54,4,'Kopi Arabica Plaga 200g',1,51000.00,85000.00,85000.00,'2026-06-12 17:59:14','2026-06-12 16:10:14'),(112,55,3,'Pie Susu Bali Premium (1 Kotak)',2,21000.00,35000.00,70000.00,'2026-06-12 15:58:14','2026-06-12 18:11:14'),(113,56,3,'Pie Susu Bali Premium (1 Kotak)',2,21000.00,35000.00,70000.00,'2026-06-14 02:15:14','2026-06-14 03:55:14'),(114,56,4,'Kopi Arabica Plaga 200g',1,51000.00,85000.00,85000.00,'2026-06-14 02:15:14','2026-06-14 03:55:14'),(115,57,4,'Kopi Arabica Plaga 200g',3,51000.00,85000.00,255000.00,'2026-06-14 19:44:14','2026-06-15 04:21:14'),(116,58,1,'Kopi Bali Kintamani 250g',1,39000.00,65000.00,65000.00,'2026-06-15 19:53:14','2026-06-16 03:35:14'),(117,58,3,'Pie Susu Bali Premium (1 Kotak)',2,21000.00,35000.00,70000.00,'2026-06-15 19:53:14','2026-06-16 03:35:14'),(118,58,4,'Kopi Arabica Plaga 200g',1,51000.00,85000.00,85000.00,'2026-06-15 19:53:14','2026-06-16 03:35:14'),(119,59,3,'Pie Susu Bali Premium (1 Kotak)',3,21000.00,35000.00,105000.00,'2026-06-15 19:57:14','2026-06-15 23:53:14'),(120,59,4,'Kopi Arabica Plaga 200g',3,51000.00,85000.00,255000.00,'2026-06-15 19:57:14','2026-06-15 23:53:14'),(121,59,5,'Kacang Kapri Tari Bali',3,15000.00,25000.00,75000.00,'2026-06-15 19:57:14','2026-06-15 23:53:14'),(122,60,2,'Es Kopi Susu Gula Aren',1,13200.00,22000.00,22000.00,'2026-06-16 23:07:14','2026-06-17 02:24:14'),(123,60,4,'Kopi Arabica Plaga 200g',1,51000.00,85000.00,85000.00,'2026-06-16 23:07:14','2026-06-17 02:24:14'),(124,61,3,'Pie Susu Bali Premium (1 Kotak)',3,21000.00,35000.00,105000.00,'2026-06-16 18:38:14','2026-06-17 04:14:14'),(125,61,4,'Kopi Arabica Plaga 200g',2,51000.00,85000.00,170000.00,'2026-06-16 18:38:14','2026-06-17 04:14:14'),(126,61,5,'Kacang Kapri Tari Bali',1,15000.00,25000.00,25000.00,'2026-06-16 18:38:14','2026-06-17 04:14:14'),(127,62,1,'Kopi Bali Kintamani 250g',2,39000.00,65000.00,130000.00,'2026-06-16 20:45:14','2026-06-16 20:56:14'),(128,62,4,'Kopi Arabica Plaga 200g',1,51000.00,85000.00,85000.00,'2026-06-16 20:45:14','2026-06-16 20:56:14'),(129,63,5,'Kacang Kapri Tari Bali',2,15000.00,25000.00,50000.00,'2026-06-18 01:22:14','2026-06-17 19:07:14'),(130,64,1,'Kopi Bali Kintamani 250g',2,39000.00,65000.00,130000.00,'2026-06-19 01:40:14','2026-06-19 03:55:14'),(131,65,5,'Kacang Kapri Tari Bali',1,15000.00,25000.00,25000.00,'2026-06-20 04:26:14','2026-06-20 02:53:14'),(132,66,2,'Es Kopi Susu Gula Aren',1,13200.00,22000.00,22000.00,'2026-06-20 00:57:14','2026-06-19 16:44:14'),(133,66,4,'Kopi Arabica Plaga 200g',1,51000.00,85000.00,85000.00,'2026-06-20 00:57:14','2026-06-19 16:44:14'),(134,66,5,'Kacang Kapri Tari Bali',2,15000.00,25000.00,50000.00,'2026-06-20 00:57:14','2026-06-19 16:44:14'),(135,67,2,'Es Kopi Susu Gula Aren',3,13200.00,22000.00,66000.00,'2026-06-19 22:54:14','2026-06-20 01:23:14'),(136,67,5,'Kacang Kapri Tari Bali',2,15000.00,25000.00,50000.00,'2026-06-19 22:54:14','2026-06-20 01:23:14');
/*!40000 ALTER TABLE `transaction_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `invoice_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` decimal(15,2) NOT NULL,
  `total_cost` decimal(15,2) NOT NULL,
  `payment_amount` decimal(15,2) NOT NULL,
  `change_amount` decimal(15,2) NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transactions_invoice_number_unique` (`invoice_number`),
  KEY `transactions_user_id_foreign` (`user_id`),
  KEY `transactions_store_id_foreign` (`store_id`),
  CONSTRAINT `transactions_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,1,2,'INV-20260521-0001-old',65000.00,39000.00,65000.00,0.00,'Migrated POS','2026-05-21 23:39:13','2026-05-22 01:16:13'),(2,1,2,'INV-20260521-0002-old',65000.00,39000.00,65000.00,0.00,'Migrated POS','2026-05-21 20:34:13','2026-05-22 02:13:13'),(3,1,2,'INV-20260521-0003-old',161000.00,96600.00,161000.00,0.00,'Migrated POS','2026-05-21 22:15:13','2026-05-22 03:38:13'),(4,1,4,'INV-20260521-0004-old',235000.00,141000.00,235000.00,0.00,'Migrated POS','2026-05-22 04:29:13','2026-05-21 19:30:13'),(5,1,4,'INV-20260522-0001-old',240000.00,144000.00,240000.00,0.00,'Migrated POS','2026-05-23 02:16:13','2026-05-23 02:07:13'),(6,1,4,'INV-20260522-0002-old',66000.00,39600.00,66000.00,0.00,'Migrated POS','2026-05-22 20:03:13','2026-05-22 21:44:13'),(7,1,4,'INV-20260523-0001-old',90000.00,54000.00,90000.00,0.00,'Migrated POS','2026-05-23 16:54:13','2026-05-24 00:39:13'),(8,1,4,'INV-20260523-0002-old',174000.00,104400.00,174000.00,0.00,'Migrated POS','2026-05-24 04:35:13','2026-05-23 19:53:13'),(9,1,2,'INV-20260523-0003-old',285000.00,171000.00,285000.00,0.00,'Migrated POS','2026-05-23 21:36:13','2026-05-24 03:36:13'),(10,1,2,'INV-20260523-0004-old',186000.00,111600.00,186000.00,0.00,'Migrated POS','2026-05-23 17:22:13','2026-05-23 22:53:13'),(11,1,4,'INV-20260524-0001-old',65000.00,39000.00,65000.00,0.00,'Migrated POS','2026-05-25 04:26:13','2026-05-25 02:13:13'),(12,1,4,'INV-20260524-0002-old',170000.00,102000.00,170000.00,0.00,'Migrated POS','2026-05-24 16:49:13','2026-05-24 23:42:13'),(13,1,2,'INV-20260525-0001-old',180000.00,108000.00,180000.00,0.00,'Migrated POS','2026-05-25 19:03:13','2026-05-25 21:14:13'),(14,1,2,'INV-20260526-0001-old',170000.00,102000.00,170000.00,0.00,'Migrated POS','2026-05-27 01:00:13','2026-05-27 01:32:13'),(15,1,4,'INV-20260527-0001-old',334000.00,200400.00,334000.00,0.00,'Migrated POS','2026-05-28 02:19:13','2026-05-27 20:43:13'),(16,1,4,'INV-20260527-0002-old',310000.00,186000.00,310000.00,0.00,'Migrated POS','2026-05-28 03:04:13','2026-05-27 19:23:13'),(17,1,4,'INV-20260528-0001-old',107000.00,64200.00,107000.00,0.00,'Migrated POS','2026-05-28 20:05:13','2026-05-28 20:02:13'),(18,1,4,'INV-20260529-0001-old',325000.00,195000.00,325000.00,0.00,'Migrated POS','2026-05-30 02:15:13','2026-05-29 19:47:13'),(19,1,4,'INV-20260529-0002-old',130000.00,78000.00,130000.00,0.00,'Migrated POS','2026-05-29 17:41:13','2026-05-30 00:52:13'),(20,1,4,'INV-20260530-0001-old',242000.00,145200.00,242000.00,0.00,'Migrated POS','2026-05-31 04:26:13','2026-05-31 03:54:13'),(21,1,2,'INV-20260530-0002-old',277000.00,166200.00,277000.00,0.00,'Migrated POS','2026-05-31 03:27:13','2026-05-30 21:35:13'),(22,1,2,'INV-20260530-0003-old',65000.00,39000.00,65000.00,0.00,'Migrated POS','2026-05-30 20:12:13','2026-05-31 03:45:13'),(23,1,2,'INV-20260531-0001-old',239000.00,143400.00,239000.00,0.00,'Migrated POS','2026-06-01 00:01:13','2026-06-01 03:27:13'),(24,1,2,'INV-20260531-0002-old',195000.00,117000.00,195000.00,0.00,'Migrated POS','2026-06-01 02:24:13','2026-06-01 00:16:13'),(25,1,4,'INV-20260601-0001-old',170000.00,102000.00,170000.00,0.00,'Migrated POS','2026-06-01 17:57:14','2026-06-02 04:30:14'),(26,1,4,'INV-20260602-0001-old',50000.00,30000.00,50000.00,0.00,'Migrated POS','2026-06-03 03:05:14','2026-06-02 16:57:14'),(27,1,2,'INV-20260602-0002-old',271000.00,162600.00,271000.00,0.00,'Migrated POS','2026-06-02 22:10:14','2026-06-03 04:16:14'),(28,1,2,'INV-20260602-0003-old',220000.00,132000.00,220000.00,0.00,'Migrated POS','2026-06-03 02:58:14','2026-06-03 03:31:14'),(29,1,4,'INV-20260602-0004-old',205000.00,123000.00,205000.00,0.00,'Migrated POS','2026-06-02 18:17:14','2026-06-03 03:50:14'),(30,1,4,'INV-20260603-0001-old',66000.00,39600.00,66000.00,0.00,'Migrated POS','2026-06-04 04:14:14','2026-06-03 16:47:14'),(31,1,4,'INV-20260603-0002-old',375000.00,225000.00,375000.00,0.00,'Migrated POS','2026-06-03 16:26:14','2026-06-04 01:08:14'),(32,1,4,'INV-20260604-0001-old',66000.00,39600.00,66000.00,0.00,'Migrated POS','2026-06-04 21:22:14','2026-06-04 18:41:14'),(33,1,4,'INV-20260604-0002-old',205000.00,123000.00,205000.00,0.00,'Migrated POS','2026-06-05 00:46:14','2026-06-04 20:37:14'),(34,1,2,'INV-20260605-0001-old',214000.00,128400.00,214000.00,0.00,'Migrated POS','2026-06-05 19:05:14','2026-06-06 02:45:14'),(35,1,2,'INV-20260605-0002-old',22000.00,13200.00,22000.00,0.00,'Migrated POS','2026-06-05 16:35:14','2026-06-05 23:32:14'),(36,1,4,'INV-20260605-0003-old',205000.00,123000.00,205000.00,0.00,'Migrated POS','2026-06-06 01:42:14','2026-06-05 22:33:14'),(37,1,2,'INV-20260606-0001-old',164000.00,98400.00,164000.00,0.00,'Migrated POS','2026-06-06 16:46:14','2026-06-07 00:46:14'),(38,1,2,'INV-20260607-0001-old',344000.00,206400.00,344000.00,0.00,'Migrated POS','2026-06-07 19:30:14','2026-06-08 01:08:14'),(39,1,4,'INV-20260607-0002-old',286000.00,171600.00,286000.00,0.00,'Migrated POS','2026-06-07 21:08:14','2026-06-07 19:48:14'),(40,1,2,'INV-20260607-0003-old',101000.00,60600.00,101000.00,0.00,'Migrated POS','2026-06-08 03:14:14','2026-06-07 16:40:14'),(41,1,2,'INV-20260608-0001-old',75000.00,45000.00,75000.00,0.00,'Migrated POS','2026-06-09 04:20:14','2026-06-08 22:37:14'),(42,1,4,'INV-20260608-0002-old',270000.00,162000.00,270000.00,0.00,'Migrated POS','2026-06-09 02:21:14','2026-06-09 01:26:14'),(43,1,4,'INV-20260608-0003-old',95000.00,57000.00,95000.00,0.00,'Migrated POS','2026-06-08 18:07:14','2026-06-09 00:42:14'),(44,1,2,'INV-20260608-0004-old',310000.00,186000.00,310000.00,0.00,'Migrated POS','2026-06-08 22:38:14','2026-06-09 00:18:14'),(45,1,4,'INV-20260609-0001-old',195000.00,117000.00,195000.00,0.00,'Migrated POS','2026-06-09 20:11:14','2026-06-09 20:39:14'),(46,1,2,'INV-20260609-0002-old',281000.00,168600.00,281000.00,0.00,'Migrated POS','2026-06-10 01:26:14','2026-06-09 23:32:14'),(47,1,2,'INV-20260610-0001-old',365000.00,219000.00,365000.00,0.00,'Migrated POS','2026-06-11 00:22:14','2026-06-11 00:52:14'),(48,1,2,'INV-20260610-0002-old',105000.00,63000.00,105000.00,0.00,'Migrated POS','2026-06-11 03:33:14','2026-06-10 17:00:14'),(49,1,4,'INV-20260610-0003-old',50000.00,30000.00,50000.00,0.00,'Migrated POS','2026-06-10 15:49:14','2026-06-10 20:05:14'),(50,1,2,'INV-20260610-0004-old',105000.00,63000.00,105000.00,0.00,'Migrated POS','2026-06-11 00:11:14','2026-06-10 23:07:14'),(51,1,2,'INV-20260611-0001-old',97000.00,58200.00,97000.00,0.00,'Migrated POS','2026-06-11 20:17:14','2026-06-12 04:44:14'),(52,1,2,'INV-20260612-0001-old',101000.00,60600.00,101000.00,0.00,'Migrated POS','2026-06-12 19:50:14','2026-06-12 23:11:14'),(53,1,2,'INV-20260612-0002-old',249000.00,149400.00,249000.00,0.00,'Migrated POS','2026-06-13 02:59:14','2026-06-13 03:55:14'),(54,1,2,'INV-20260612-0003-old',215000.00,129000.00,215000.00,0.00,'Migrated POS','2026-06-12 17:59:14','2026-06-12 16:10:14'),(55,1,2,'INV-20260612-0004-old',70000.00,42000.00,70000.00,0.00,'Migrated POS','2026-06-12 15:58:14','2026-06-12 18:11:14'),(56,1,4,'INV-20260613-0001-old',155000.00,93000.00,155000.00,0.00,'Migrated POS','2026-06-14 02:15:14','2026-06-14 03:55:14'),(57,1,2,'INV-20260614-0001-old',255000.00,153000.00,255000.00,0.00,'Migrated POS','2026-06-14 19:44:14','2026-06-15 04:21:14'),(58,1,4,'INV-20260615-0001-old',220000.00,132000.00,220000.00,0.00,'Migrated POS','2026-06-15 19:53:14','2026-06-16 03:35:14'),(59,1,4,'INV-20260615-0002-old',435000.00,261000.00,435000.00,0.00,'Migrated POS','2026-06-15 19:57:14','2026-06-15 23:53:14'),(60,1,2,'INV-20260616-0001-old',107000.00,64200.00,107000.00,0.00,'Migrated POS','2026-06-16 23:07:14','2026-06-17 02:24:14'),(61,1,4,'INV-20260616-0002-old',300000.00,180000.00,300000.00,0.00,'Migrated POS','2026-06-16 18:38:14','2026-06-17 04:14:14'),(62,1,2,'INV-20260616-0003-old',215000.00,129000.00,215000.00,0.00,'Migrated POS','2026-06-16 20:45:14','2026-06-16 20:56:14'),(63,1,2,'INV-20260617-0001-old',50000.00,30000.00,50000.00,0.00,'Migrated POS','2026-06-18 01:22:14','2026-06-17 19:07:14'),(64,1,2,'INV-20260618-0001-old',130000.00,78000.00,130000.00,0.00,'Migrated POS','2026-06-19 01:40:14','2026-06-19 03:55:14'),(65,1,4,'INV-20260619-0001-old',25000.00,15000.00,25000.00,0.00,'Migrated POS','2026-06-20 04:26:14','2026-06-20 02:53:14'),(66,1,4,'INV-20260619-0002-old',157000.00,94200.00,157000.00,0.00,'Migrated POS','2026-06-20 00:57:14','2026-06-19 16:44:14'),(67,1,2,'INV-20260619-0003-old',116000.00,69600.00,116000.00,0.00,'Migrated POS','2026-06-19 22:54:14','2026-06-20 01:23:14');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
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
  `role` enum('owner','cashier','customer','admin') COLLATE utf8mb4_unicode_ci DEFAULT 'customer',
  `store_id` bigint unsigned DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_store_id_foreign` (`store_id`),
  CONSTRAINT `users_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Super Admin','admin',NULL,'admin@smart-umkm.test','2026-06-19 07:48:13','$2y$12$4FxQ5WXJEkMY6xyah7bwWutzAArB4VDLSOyWOwaZkGcIm/4XqESZC',NULL,'2026-06-19 07:48:13','2026-06-19 07:48:13',NULL),(2,'Wayan Sudirta','owner',NULL,'owner@smart-umkm.test','2026-06-19 07:48:13','$2y$12$16KrdFs5ikWpAU0mKQThJuWH9WB6ECwZQFQ0qeaBobQdYdkHVfe1C',NULL,'2026-06-19 07:48:13','2026-06-19 07:48:13',NULL),(3,'Ni Luh Putu','customer',NULL,'customer@smart-umkm.test','2026-06-19 07:48:13','$2y$12$L3fgy1jysIp9xeoyYRrZYeD9SBgzQ7EQXJjr0mdT/AAd0cVme4ll2',NULL,'2026-06-19 07:48:13','2026-06-19 07:48:13',NULL),(4,'Kadek Sari','cashier',1,'cashier@smart-umkm.test','2026-06-19 07:48:13','$2y$12$.qUw3BG2Mf9k4WywIMOxAuoIIb3RJbVgYIDtG3VseW5vjE/c.K4tu',NULL,'2026-06-19 07:48:13','2026-06-19 07:48:13',NULL),(5,'New Owner','customer',NULL,'new_owner_1781884149747@example.com',NULL,'$2y$12$699nyUcRN0LVJVneaz8tz.BeICzF018j5w.PAoNvT71J8n//exVdW',NULL,'2026-06-19 07:49:11','2026-06-19 07:49:11',NULL),(6,'Owner Regression','owner',NULL,'owner_regression_1781884161972@smart-umkm.test',NULL,'$2y$12$.vLXDS4HJ4.A5IXElEsZ/uWZjQnH86ERsLYX3KWMNwud8zHnqscqi',NULL,'2026-06-19 07:49:22','2026-06-19 07:49:22',NULL),(7,'New Owner','customer',NULL,'new_owner_1781884273193@example.com',NULL,'$2y$12$YvlHf2Q8A2CYUg6XNEVQ3O.J.Y/oteTQncJrJi.tkJUrKQozTkQR.',NULL,'2026-06-19 07:51:14','2026-06-19 07:51:14',NULL),(8,'Owner Regression','owner',NULL,'owner_regression_1781884285540@smart-umkm.test',NULL,'$2y$12$dAlD4it8UOtbTjxKUU95l.9T/q4hshYYbs.XrhUxT7n/a.IC6uXsO',NULL,'2026-06-19 07:51:26','2026-06-19 07:51:26',NULL);
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

-- Dump completed on 2026-06-19 23:54:09
