-- MySQL dump 10.13  Distrib 5.5.61, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: opencart
-- ------------------------------------------------------
-- Server version	5.6.33-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banners` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `banner_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (1,'Banner1','girl3.jpg',1,'2018-10-31 00:33:16','2018-10-31 02:04:47'),(2,'Banner2','girl2.jpg',1,'2018-10-31 00:33:46','2018-10-31 02:04:36'),(3,'Banner3','girl1.jpg',1,'2018-10-31 00:34:14','2018-10-31 02:04:24');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modify_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Fashion',0,1,1,'2018-10-29 00:11:40','2018-10-29 00:11:40'),(2,'Interiors',0,1,1,'2018-10-29 00:11:50','2018-10-29 00:11:50'),(3,'Households',2,1,1,'2018-10-29 00:12:00','2018-10-29 00:12:00'),(4,'Clothing',1,1,1,'2018-10-29 00:12:12','2018-10-29 00:12:12'),(5,'Bags',1,1,1,'2018-10-29 00:12:20','2018-10-29 00:12:20'),(6,'Shoes',1,1,1,'2018-10-29 00:12:29','2018-10-29 00:12:29'),(7,'Sportswear',4,1,1,'2018-10-29 00:13:15','2018-10-29 00:13:15'),(8,'Electronics',0,2,2,'2018-10-31 04:25:32','2018-10-31 04:25:32');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms`
--

DROP TABLE IF EXISTS `cms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `modify_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms`
--

LOCK TABLES `cms` WRITE;
/*!40000 ALTER TABLE `cms` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuration_tables`
--

DROP TABLE IF EXISTS `configuration_tables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuration_tables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `conf_key` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conf_value` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `modify_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `configuration_tables_created_by_foreign` (`created_by`),
  KEY `configuration_tables_modify_by_foreign` (`modify_by`),
  CONSTRAINT `configuration_tables_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `configuration_tables_modify_by_foreign` FOREIGN KEY (`modify_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuration_tables`
--

LOCK TABLES `configuration_tables` WRITE;
/*!40000 ALTER TABLE `configuration_tables` DISABLE KEYS */;
INSERT INTO `configuration_tables` VALUES (1,'DB_DATABASE','opencart','1',2,2,'2018-10-31 00:22:59','2018-10-31 00:22:59'),(2,'Email','subodhkadam0619@gmail.com','1',2,2,'2018-10-31 00:24:52','2018-10-31 00:24:52');
/*!40000 ALTER TABLE `configuration_tables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_us` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `note_admin` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `modify_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_us`
--

LOCK TABLES `contact_us` WRITE;
/*!40000 ALTER TABLE `contact_us` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_us` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupon_useds`
--

DROP TABLE IF EXISTS `coupon_useds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupon_useds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `coupon_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coupon_useds_user_id_foreign` (`user_id`),
  KEY `coupon_useds_coupon_id_foreign` (`coupon_id`),
  KEY `coupon_useds_order_id_foreign` (`order_id`),
  CONSTRAINT `coupon_useds_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`),
  CONSTRAINT `coupon_useds_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `user_orders` (`id`),
  CONSTRAINT `coupon_useds_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupon_useds`
--

LOCK TABLES `coupon_useds` WRITE;
/*!40000 ALTER TABLE `coupon_useds` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupon_useds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percent_off` double(12,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modify_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `no_of_uses` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` VALUES (1,'s123dsfa',21.00,1,1,NULL,NULL,2),(2,'RsYbVkev',15.00,2,2,NULL,NULL,4),(3,'RI80LM3n',8.00,2,2,NULL,NULL,4);
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `modify_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_templates`
--

LOCK TABLES `email_templates` WRITE;
/*!40000 ALTER TABLE `email_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2018_10_10_074519_create_users_table',1),(2,'2018_10_10_100810_create_cms_table',1),(3,'2018_10_10_101548_create_contact_uses_table',1),(4,'2018_10_10_102245_create_banners_table',1),(5,'2018_10_10_111411_create_email_templates_table',1),(6,'2018_10_10_113300_create_configuration_tables_table',1),(7,'2018_10_10_120004_create_coupons_table',1),(8,'2018_10_10_120629_create_user_addresses_table',1),(9,'2018_10_10_121302_create_payment_gateways_table',1),(10,'2018_10_10_124824_create_products_table',1),(11,'2018_10_10_132110_create_product_images_table',1),(12,'2018_10_10_134018_create_product_attributes_table',1),(13,'2018_10_10_134404_create_product_attribute_values_table',1),(14,'2018_10_10_135147_create_product_attribute_assocs_table',1),(15,'2018_10_10_141719_create_categories_table',1),(16,'2018_10_10_142100_create_product_categories_table',1),(17,'2018_10_10_142427_create_user_wish_lists_table',1),(18,'2018_10_10_143105_create_user_orders_table',1),(19,'2018_10_10_144912_create_coupon_useds_table',1),(20,'2018_10_10_145451_create_order_details_table',1),(21,'2018_10_15_063935_update_banners_tables',1),(22,'2018_10_16_045733_create_permission_tables',1),(23,'2018_10_26_093547_update_users_table',1),(24,'2018_10_26_120018_stored_procedure_to_create_coupon',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
INSERT INTO `model_has_permissions` VALUES (1,'App\\User',2),(2,'App\\User',2),(4,'App\\User',4),(4,'App\\User',5);
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\User',2),(5,'App\\User',4),(5,'App\\User',5);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `ammount` double(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_details_order_id_foreign` (`order_id`),
  KEY `order_details_product_id_foreign` (`product_id`),
  CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `user_orders` (`id`),
  CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_details`
--

LOCK TABLES `order_details` WRITE;
/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_gateways`
--

DROP TABLE IF EXISTS `payment_gateways`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_gateways` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `modify_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_gateways`
--

LOCK TABLES `payment_gateways` WRITE;
/*!40000 ALTER TABLE `payment_gateways` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_gateways` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Add','web',NULL,NULL),(2,'Edit','web',NULL,NULL),(3,'Delete\r\n','web',NULL,NULL),(4,'Customer','',NULL,NULL);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_attribute_assocs`
--

DROP TABLE IF EXISTS `product_attribute_assocs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_attribute_assocs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `product_attribute_id` int(10) unsigned NOT NULL,
  `product_attribute_value_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_attribute_assocs_product_attribute_id_foreign` (`product_attribute_id`),
  KEY `product_id` (`product_id`),
  KEY `product_id_2` (`product_id`),
  KEY `product_attribute_assocs_product_attribute_value_id_foreign` (`product_attribute_value_id`),
  CONSTRAINT `product_attribute_assocs_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_attribute_assocs_product_attribute_id_foreign` FOREIGN KEY (`product_attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_attribute_assocs_product_attribute_value_id_foreign` FOREIGN KEY (`product_attribute_value_id`) REFERENCES `product_attribute_values` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_attribute_assocs`
--

LOCK TABLES `product_attribute_assocs` WRITE;
/*!40000 ALTER TABLE `product_attribute_assocs` DISABLE KEYS */;
INSERT INTO `product_attribute_assocs` VALUES (14,3,3,14,'2018-10-31 00:50:26','2018-10-31 00:50:26'),(15,3,1,15,'2018-10-31 00:50:26','2018-10-31 00:50:26'),(16,2,1,16,'2018-10-31 00:51:17','2018-10-31 00:51:17'),(17,2,3,17,'2018-10-31 00:51:17','2018-10-31 00:51:17'),(18,2,4,18,'2018-10-31 00:51:17','2018-10-31 00:51:17'),(19,4,3,19,'2018-10-31 01:03:04','2018-10-31 01:03:04'),(20,4,4,20,'2018-10-31 01:03:04','2018-10-31 01:03:04'),(21,5,1,21,'2018-10-31 01:04:42','2018-10-31 01:04:42'),(22,6,2,22,'2018-10-31 01:05:49','2018-10-31 01:05:49'),(23,7,1,23,'2018-10-31 01:10:43','2018-10-31 01:10:43'),(24,8,1,24,'2018-10-31 01:17:17','2018-10-31 01:17:17'),(25,9,3,25,'2018-10-31 01:18:51','2018-10-31 01:18:51'),(26,9,1,26,'2018-10-31 01:18:51','2018-10-31 01:18:51'),(27,10,1,27,'2018-10-31 01:21:35','2018-10-31 01:21:35'),(28,10,4,28,'2018-10-31 01:21:36','2018-10-31 01:21:36'),(29,11,1,29,'2018-10-31 01:24:39','2018-10-31 01:24:39'),(30,11,4,30,'2018-10-31 01:24:39','2018-10-31 01:24:39'),(31,12,1,31,'2018-10-31 01:25:58','2018-10-31 01:25:58'),(32,13,1,32,'2018-10-31 01:27:35','2018-10-31 01:27:35'),(33,13,3,33,'2018-10-31 01:27:35','2018-10-31 01:27:35'),(34,14,3,34,'2018-10-31 01:36:57','2018-10-31 01:36:57'),(35,14,2,35,'2018-10-31 01:36:57','2018-10-31 01:36:57'),(36,15,2,36,'2018-10-31 04:55:24','2018-10-31 04:55:24');
/*!40000 ALTER TABLE `product_attribute_assocs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_attribute_values`
--

DROP TABLE IF EXISTS `product_attribute_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_attribute_values` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_attribute_id` int(10) unsigned NOT NULL,
  `attribute_value` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `modify_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_attribute_values_product_attribute_id_foreign` (`product_attribute_id`),
  CONSTRAINT `product_attribute_values_product_attribute_id_foreign` FOREIGN KEY (`product_attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_attribute_values`
--

LOCK TABLES `product_attribute_values` WRITE;
/*!40000 ALTER TABLE `product_attribute_values` DISABLE KEYS */;
INSERT INTO `product_attribute_values` VALUES (14,3,'asffs',2,2,'2018-10-31 00:50:26','2018-10-31 00:50:26'),(15,1,'faf',2,2,'2018-10-31 00:50:26','2018-10-31 00:50:26'),(16,1,'m',2,2,'2018-10-31 00:51:17','2018-10-31 00:51:17'),(17,3,'gray',2,2,'2018-10-31 00:51:17','2018-10-31 00:51:17'),(18,4,'silk',2,2,'2018-10-31 00:51:17','2018-10-31 00:51:17'),(19,3,'fasf',2,2,'2018-10-31 01:03:04','2018-10-31 01:03:04'),(20,4,'fsfsfasf',2,2,'2018-10-31 01:03:04','2018-10-31 01:03:04'),(21,1,'dgdgdgd',2,2,'2018-10-31 01:04:42','2018-10-31 01:04:42'),(22,2,'rgrgg',2,2,'2018-10-31 01:05:49','2018-10-31 01:05:49'),(23,1,'dsfsfsf',2,2,'2018-10-31 01:10:43','2018-10-31 01:10:43'),(24,1,'gdgvdfgvd',2,2,'2018-10-31 01:17:17','2018-10-31 01:17:17'),(25,3,'dgsbd',2,2,'2018-10-31 01:18:51','2018-10-31 01:18:51'),(26,1,'dvbdgv',2,2,'2018-10-31 01:18:51','2018-10-31 01:18:51'),(27,1,'dsgd gd',2,2,'2018-10-31 01:21:35','2018-10-31 01:21:35'),(28,4,'dsgdgd',2,2,'2018-10-31 01:21:36','2018-10-31 01:21:36'),(29,1,'sdgedsd',2,2,'2018-10-31 01:24:39','2018-10-31 01:24:39'),(30,4,'vretgwerg',2,2,'2018-10-31 01:24:39','2018-10-31 01:24:39'),(31,1,'dgbsgb',2,2,'2018-10-31 01:25:58','2018-10-31 01:25:58'),(32,1,'dgvsdfg',2,2,'2018-10-31 01:27:35','2018-10-31 01:27:35'),(33,3,'dfdfdf',2,2,'2018-10-31 01:27:35','2018-10-31 01:27:35'),(34,3,'sdgsdgds',2,2,'2018-10-31 01:36:57','2018-10-31 01:36:57'),(35,2,'gsdgdsg',2,2,'2018-10-31 01:36:57','2018-10-31 01:36:57'),(36,2,'xvzd',2,2,'2018-10-31 04:55:24','2018-10-31 04:55:24');
/*!40000 ALTER TABLE `product_attribute_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_attributes`
--

DROP TABLE IF EXISTS `product_attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_attributes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `modify_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_attributes`
--

LOCK TABLES `product_attributes` WRITE;
/*!40000 ALTER TABLE `product_attributes` DISABLE KEYS */;
INSERT INTO `product_attributes` VALUES (1,'Size',2,2,'2018-10-30 07:39:02','2018-10-30 07:39:02'),(2,'weight',2,2,'2018-10-30 07:39:17','2018-10-30 07:39:17'),(3,'color',2,2,'2018-10-30 07:39:22','2018-10-30 07:39:22'),(4,'material',2,2,'2018-10-30 07:39:34','2018-10-30 07:39:34');
/*!40000 ALTER TABLE `product_attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_categories_product_id_foreign` (`product_id`),
  KEY `product_categories_category_id_foreign` (`category_id`),
  CONSTRAINT `product_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_categories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` VALUES (2,2,4,'2018-10-30 08:50:44','2018-10-30 08:50:44'),(3,3,5,'2018-10-30 08:56:28','2018-10-30 08:56:28'),(4,4,4,'2018-10-31 01:03:04','2018-10-31 01:03:04'),(5,5,7,'2018-10-31 01:04:42','2018-10-31 01:04:42'),(6,6,3,'2018-10-31 01:05:49','2018-10-31 01:05:49'),(7,7,4,'2018-10-31 01:10:43','2018-10-31 01:10:43'),(8,8,3,'2018-10-31 01:17:17','2018-10-31 01:17:17'),(9,9,4,'2018-10-31 01:18:50','2018-10-31 01:18:50'),(10,10,4,'2018-10-31 01:21:35','2018-10-31 01:21:35'),(11,11,4,'2018-10-31 01:24:39','2018-10-31 01:24:39'),(12,12,4,'2018-10-31 01:25:58','2018-10-31 01:25:58'),(13,13,4,'2018-10-31 01:27:35','2018-10-31 01:27:35'),(14,14,4,'2018-10-31 01:36:56','2018-10-31 01:36:56'),(15,15,4,'2018-10-31 04:55:24','2018-10-31 04:55:24');
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `image_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `modify_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
INSERT INTO `product_images` VALUES (2,2,'product10.jpg','0',2,2,'2018-10-30 08:50:44','2018-10-30 08:50:44'),(3,3,'product9.jpg','0',2,2,'2018-10-30 08:56:28','2018-10-30 08:56:28'),(4,4,'product4.jpg','1',2,2,'2018-10-31 01:03:04','2018-10-31 01:03:04'),(5,5,'product5.jpg','1',2,2,'2018-10-31 01:04:42','2018-10-31 01:04:42'),(6,6,'girl2.jpg','1',2,2,'2018-10-31 01:05:49','2018-10-31 01:05:49'),(7,7,'product6.jpg','1',2,2,'2018-10-31 01:10:43','2018-10-31 01:10:43'),(8,8,'recommend3.jpg','1',2,2,'2018-10-31 01:17:17','2018-10-31 01:17:17'),(9,9,'girl1.jpg','1',2,2,'2018-10-31 01:18:50','2018-10-31 01:18:50'),(10,10,'girl3.jpg','1',2,2,'2018-10-31 01:21:35','2018-10-31 01:21:35'),(11,11,'girl2.jpg','1',2,2,'2018-10-31 01:24:39','2018-10-31 01:24:39'),(12,12,'product1.jpg','1',2,2,'2018-10-31 01:25:58','2018-10-31 01:25:58'),(13,13,'gallery1.jpg','0',2,2,'2018-10-31 01:27:35','2018-10-31 01:27:35'),(14,14,'product6.jpg','1',2,2,'2018-10-31 01:36:57','2018-10-31 01:36:57'),(15,15,'product1.jpg','1',2,2,'2018-10-31 04:55:24','2018-10-31 04:55:24');
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(14,2) NOT NULL,
  `special_price` double(14,2) NOT NULL,
  `special_price_from` date NOT NULL,
  `special_price_to` date NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `meta_title` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `modify_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '1',
  `product_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (2,'Polotshirt','4ew','sdf','sfsf',323.00,312.00,'2018-11-05','2018-11-10','1',214,'wdsads','dsadasdf ff faf fsdffsff','ffafafa',2,2,'2018-10-30 08:50:44','2018-10-31 00:51:17',1,1),(3,'handbag','d','3sdfsadfas','fasfsafasf',453.00,234.00,'2018-10-30','2018-11-17','1',3423,'fasf','fsdfasdf','fasfasf',2,2,'2018-10-30 08:56:28','2018-10-31 00:50:26',1,1),(4,'product3','ww','fasfdff','fffafafs',2332.00,2290.00,'2018-10-31','2018-11-06','1',123,'edfasdf','fasdfasffasf','fasfasfs',2,2,'2018-10-31 01:03:04','2018-10-31 01:03:04',1,1),(5,'product4','sscsff','asffs','fsfsafasf',4000.00,3500.00,'2018-11-02','2018-11-10','1',323,'fewfe','dfsdgfdg','gsdgsdgd',2,2,'2018-10-31 01:04:42','2018-10-31 01:04:42',1,1),(6,'fdfdfd','edgdgd','dgdgdgdg','gdgdg gdgd ggesgdg edfgsdgfds sdfgdgdg gsdgdsgsdg',131.00,100.00,'2018-11-03','2018-11-10','1',3423,'rtgertg','rghergrg','rgregrger',2,2,'2018-10-31 01:05:49','2018-10-31 01:05:49',1,1),(7,'product5','asdas','fasdf','ffa fsdasdf asdfsdfdsg rergv sefetgrf nh  segsfgsed',2321.00,2313.00,'2018-10-31','2018-11-25','0',213,'gdsgdfg','fsdfdsfsd','fsdfdsfdfdf',2,2,'2018-10-31 01:10:43','2018-10-31 01:10:43',1,1),(8,'fdsdf','jkjkgjhk','hghjhgjh',',jhkujkghjkghjfhf',2313.00,2234.00,'2018-11-08','2018-11-11','1',3423,'sfsdfgsd dg gsdg','gsdg dsgsdgsdg','segs segsegeg',2,2,'2018-10-31 01:17:17','2018-10-31 01:17:17',0,1),(9,'poduct7','cfefsd','tyurtuyetetge ewtfgewg','gertgryrtujrtu trurtueumtr trsu5tryu turtutuy tytrysrtzh r',4222.00,3235.00,'2018-10-31','2018-11-04','1',342,'esrfgetts','ergwerfg','etwetwet',2,2,'2018-10-31 01:18:50','2018-10-31 01:18:50',1,1),(10,'shdgvash','sdhdsh','afsdfabjksdf','svafjcs fbasjbjasd fasfsjkf fhasjkfsjk fjhafjskasb fasfjks fasjfakjf alkfjaslk assff ashfj .\r\nfhhfafns  asjkfbasjkf .',3212.00,2121.00,'2018-10-31','2018-11-08','1',342,'dgsdgds','gdsgsdgdg','dgsd sdgsdgdsg',2,2,'2018-10-31 01:21:35','2018-10-31 01:21:35',1,1),(11,'dgsdtgr','gdsgdsg','dgdssd','dgsdgsdgd',342.00,322.00,'2018-10-31','2018-11-08','1',323,'grgrdsg','dfgsdgg','ggdgdg',2,2,'2018-10-31 01:24:39','2018-10-31 01:24:39',1,1),(12,'gegeg','dgsdgs','gerwetgb rhegh','redrfbhdf hdrdrdr hrdhr',3243.00,2344.00,'2018-10-31','2018-11-07','1',2342,'ssssdgfgsd','dsgsdgsdg','gsdgsdgdsg gdgsdgsdg dgsdg',2,2,'2018-10-31 01:25:58','2018-10-31 01:25:58',1,1),(13,'dfgsdg','dgdsg','scsafcas','sfasf afafaf ffafsf',231.00,221.00,'2018-10-31','2018-11-23','1',15,'efgsgf','sdgsgdg','gsdgsdgd gsdgsdd g',2,2,'2018-10-31 01:27:35','2018-10-31 01:27:35',1,1),(14,'egege','ggsgd','gsdgdg','gsdgsdgd',352.00,232.00,'2018-11-01','2018-11-17','1',2323,'gbsdfgds','sdgds sdgsdgsdg sdgsdgd','sgsdgsdgdg',2,2,'2018-10-31 01:36:56','2018-10-31 01:36:56',1,1),(15,'dfsdf','dfasfdasdf','fafafa','fasfaf',13223.00,2321.00,'2018-11-07','2018-11-08','1',1321,'fsadfd','dgsdgsdg','gdsgsdfgsdg',2,2,'2018-10-31 04:55:24','2018-10-31 04:55:24',0,1);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(1,2),(2,2),(3,2),(1,3),(2,3),(1,4),(2,4),(4,5);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'superadmin','web','2018-10-26 05:35:02','2018-10-26 05:35:02'),(2,'admin','web','2018-10-26 05:35:02','2018-10-26 05:35:02'),(3,'inventory_manager','web','2018-10-26 05:35:02','2018-10-26 05:35:02'),(4,'order_manager','web','2018-10-26 05:35:02','2018-10-26 05:35:02'),(5,'customer','web','2018-10-26 05:35:02','2018-10-26 05:35:02');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_addresses`
--

DROP TABLE IF EXISTS `user_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_addresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `address_1` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_2` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_addresses_user_id_foreign` (`user_id`),
  CONSTRAINT `user_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_addresses`
--

LOCK TABLES `user_addresses` WRITE;
/*!40000 ALTER TABLE `user_addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_orders`
--

DROP TABLE IF EXISTS `user_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `shipping_method` int(11) NOT NULL,
  `AWB_NO` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_gateway_id` int(10) unsigned NOT NULL,
  `transaction_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `grand_total` double(12,2) NOT NULL,
  `shipping_charges` double(12,2) NOT NULL,
  `coupon_id` int(10) unsigned NOT NULL,
  `billing_address_1` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_address_2` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_city` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_state` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_country` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_zipcode` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_address_1` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_address_2` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_city` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_state` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_country` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_zipcode` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_orders_user_id_foreign` (`user_id`),
  KEY `user_orders_coupon_id_foreign` (`coupon_id`),
  KEY `user_orders_payment_gateway_id_foreign` (`payment_gateway_id`),
  CONSTRAINT `user_orders_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`),
  CONSTRAINT `user_orders_payment_gateway_id_foreign` FOREIGN KEY (`payment_gateway_id`) REFERENCES `payment_gateways` (`id`),
  CONSTRAINT `user_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_orders`
--

LOCK TABLES `user_orders` WRITE;
/*!40000 ALTER TABLE `user_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_wish_lists`
--

DROP TABLE IF EXISTS `user_wish_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_wish_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_wish_lists_user_id_foreign` (`user_id`),
  KEY `user_wish_lists_product_id_foreign` (`product_id`),
  CONSTRAINT `user_wish_lists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `user_wish_lists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_wish_lists`
--

LOCK TABLES `user_wish_lists` WRITE;
/*!40000 ALTER TABLE `user_wish_lists` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_wish_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` date NOT NULL,
  `fb_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registration_method` enum('n','f','t','g') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'n',
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'Abcd','abcd','subodhkadam0619@gmail.com','$2y$10$qIgWChQIknNDIw4gCbisb.w/vBQi6a/z78NoNFNPeE0GSY.fJaAwW','1','2018-10-26','null','null','null','n',1,'2018-10-26 05:37:20','2018-10-26 05:37:20','T9Ied4l0OdtE02qOGxgI6X0QkDSb5BOV0oyCb3MpATbTZ7rd0P5xqhwjeyyH'),(4,'subodh','kadam','kadamsubodh0619@gmail.com','$2y$10$z3w2wCfwauVTpoepHWuPHeDNmKvdzbBSJMml44Y3tWHoZnaR/OmAu','1','2018-10-30',NULL,NULL,'ya29.GltGBgALCb8U0zhu83ILT9-UdNddNqsnv1XES0Go1wReWW190CXCH1GHFs24UnyAEBayxDkrgZEF5BWaQV3h0IvaZW6toNZrps828qyQ6xo2npGmfKaJcMeZD_zE','g',5,'2018-10-30 04:17:04','2018-10-30 04:17:04','8l5xBxKqNIDHFk6EWioQJPRhT9R1euZalixhMER8lV6dnO8wWTPC0wcrz6X1'),(5,'rajesh','surve','raj@gmail.com','$2y$10$dVC.5n24BsI3i2Y.yxfVBe5bla0w.m/MJ1FagPtNiRmtfErovJHTK','1','2018-10-30',NULL,NULL,NULL,'n',5,'2018-10-30 05:21:35','2018-10-30 05:21:35','tuguGDQcPCt8UdGd5ae868lfcKpiI6jZaELhHOrJqaGFcOC3qktzoRW3CMEa');
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

-- Dump completed on 2018-10-31 20:42:50
