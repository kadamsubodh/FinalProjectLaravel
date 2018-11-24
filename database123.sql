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
INSERT INTO `banners` VALUES (1,'Banner1','girl1.jpg',1,'2018-10-31 00:33:16','2018-11-02 09:09:30'),(2,'Banner2','girl2.jpg',1,'2018-10-31 00:33:46','2018-10-31 02:04:36'),(3,'Banner3','girl1.jpg',1,'2018-10-31 00:34:14','2018-10-31 02:04:24');
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Fashion',0,1,1,'2018-10-29 00:11:40','2018-10-29 00:11:40'),(2,'Interiors',0,1,1,'2018-10-29 00:11:50','2018-10-29 00:11:50'),(3,'Households',2,1,1,'2018-10-29 00:12:00','2018-10-29 00:12:00'),(4,'Clothing',1,1,1,'2018-10-29 00:12:12','2018-10-29 00:12:12'),(5,'Bags',1,1,1,'2018-10-29 00:12:20','2018-10-29 00:12:20'),(6,'Shoes',1,1,1,'2018-10-29 00:12:29','2018-10-29 00:12:29'),(7,'Sportswear',4,1,1,'2018-10-29 00:13:15','2018-10-29 00:13:15'),(8,'Electronics',0,2,2,'2018-10-31 04:25:32','2018-10-31 04:25:32'),(9,'saacfs',0,2,2,'2018-11-19 22:45:21','2018-11-19 22:45:21'),(15,'Electronics',9,2,2,'2018-11-19 22:55:47','2018-11-19 22:55:47');
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
  `note_admin` text COLLATE utf8mb4_unicode_ci,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modify_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_us`
--

LOCK TABLES `contact_us` WRITE;
/*!40000 ALTER TABLE `contact_us` DISABLE KEYS */;
INSERT INTO `contact_us` VALUES (7,'subodh kadam','kadamsubodh0619@gmail.com','7845124578','hello admin\r\nhow are you?','none of your bussiness','subodh kadam','subodh kadam','2018-11-24 03:34:53','2018-11-24 04:47:40');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupon_useds`
--

LOCK TABLES `coupon_useds` WRITE;
/*!40000 ALTER TABLE `coupon_useds` DISABLE KEYS */;
INSERT INTO `coupon_useds` VALUES (3,23,11,3,'2018-11-20 04:01:22','2018-11-20 04:01:22');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` VALUES (1,'Null',1.00,1,1,NULL,NULL,0),(2,'RsYbVkev',15.00,2,2,NULL,NULL,4),(3,'RI80LM3n',8.00,2,2,NULL,NULL,4),(4,'RHY7vu2p',12.00,2,2,NULL,NULL,4),(5,'s123dsfa',21.00,1,1,NULL,NULL,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_templates`
--

LOCK TABLES `email_templates` WRITE;
/*!40000 ALTER TABLE `email_templates` DISABLE KEYS */;
INSERT INTO `email_templates` VALUES (1,'Reset Password','New password of your Eshopers account','hi,\n##username##,\nAs you requested, we reset your password.\nYour new password is: ##password##.\nDo not disclose your password with any one.\n\nNote: This is system generated mail. Do not reply to this mail.\nThank You,\nEshopers Team.',2,2,'2018-11-02 03:41:12','2018-11-02 03:41:12'),(2,'userSignUpNotificationToUser','Welcome to Eshopers site.','<html>\r\n<body>\r\n<h2><b> Welcome to My Shopping Cart</b></h2>\r\n<p>To log in when visiting our site just click <a href=\"#\">Login</a> at the top of every page and then enter following credentials.</p>\r\n<div style=\"border=\"1px solid black; \">\r\n<p>Email: {email}</p>\r\n<p>Password:{password}</p>\r\n<br>\r\n<p> when you log in to your account, you will be able to do following:</p>\r\n<ul>\r\n<li>Proceed through checkout faster when making a purchase</li>\r\n<li>view past orders</li>\r\n<li> check status of orders</li>\r\n<li>change your password</li>\r\n</ul>\r\n\r\n<b><u>Note:</u><b> please do not share your credentials with others.\r\n<br>\r\n<br>\r\n\r\nThank You,<br>\r\n<b>Eshopers Team.<b>\r\n</body>\r\n</html>',2,2,'2018-11-23 05:38:33','2018-11-23 07:21:09'),(4,'userSignUpNotificationToAdmin','Welcome to Eshopers site.','<html>\r\n<body>\r\n<h2><b> Welcome to My Shopping Cart</b></h2>\r\n<p>To log in when visiting our site just click <a href=\"#\">Login</a> at the top of every page and then enter following credentials.</p>\r\n<div style=\"border=\"1px solid black; \">\r\n<p>Email: {email}</p>\r\n<br>\r\n<p> when you log in to your account, you will be able to do following:</p>\r\n<ul>\r\n<li>Proceed through checkout faster when making a purchase<li>\r\n<li>view past orders</li>\r\n<li> check status of orders</li>\r\n<li>change your password</li>\r\n</ul>\r\n\r\n<b><u>Note:</u><b> please do not share your credentials with others.\r\n<br>\r\nThank You,<br>\r\n<b>Eshopers Team.<b>\r\n</body>\r\n</html>',2,2,'2018-11-23 05:50:14','2018-11-23 05:50:14'),(5,'orderDetails','Your order is  placed Successfully!!','<html>\r\n<body>\r\n<div style=\"background-color:​#cce6ff;\">\r\n<h2>Thank you for your order from Eshopers.</h2>\r\n<p>Once your package ships we will send an email with a link to track your order. Your order summary is below. Thank you again for your business.\r\n</div>\r\n<p style=\"align:center\">Your Order # {id} </p>\r\n<p style=\"align:center\">Placed on: {date}</p>\r\n\r\n<div>\r\n{orderDetails}\r\n</div>\r\n<p>Total:</p>\r\n{total}\r\n<br>\r\n<h3>Bill To:</h3>\r\n<table>\r\n<tr>\r\n<td style=\"vertical-align:top;\">Billing Address</td><td> {billed_to}</td>\r\n</tr>\r\n<tr>\r\n<td style=\"vertical-align:top;\">Shipping Address</td><td>{shipped_to}</td>\r\n</tr>\r\n</table>\r\n\r\n<h3><b>Payment Method</b>: {paymentMethod}.</h3> \r\n<br>\r\nThank You,<br>\r\n<b>Eshopers Team.<b>\r\n</body>\r\n<html>',2,2,'2018-11-23 06:24:19','2018-11-24 05:21:48'),(6,'contactToAdmin','Contact to admin','<html>\r\n<body>\r\n<p>Dear Administrator,</p>\r\n<p> Please check below details of customer</p>\r\n<table border=\'1\' style=\'border-collapse: collapse;\'>\r\n<tr>\r\n<td>Name:</td> <td> {customerName}</td>\r\n<tr>\r\n<tr>\r\n<td>Email:</td><td>{customerEmail}</td>\r\n</tr>\r\n<tr>\r\n<td>Contact No.</td><td>{customerContact}</td>\r\n</tr>\r\n<tr>\r\n<td>Message:</td><td>{customerMessage}</td>\r\n</tr>\r\n</table>\r\n<br>\r\n<p>Form posted from ip: {ip}</p\r\n\r\n<br>\r\nThank You,<br>\r\n<b>Eshopers Team.<b>\r\n</body>\r\n​</html>',2,2,'2018-11-23 06:35:26','2018-11-24 03:36:52'),(7,'adminComment','Regarding your queries','<html>\r\n<body>\r\n<p>Dear {customerName},</p>\r\n<p> Please check following comments from admin regarding your query: </p>\r\n<table border=\'1\' style=\'border-collapse:collapse;\'>\r\n<tr>\r\n<td>Name:</td> <td> {customerName}</td>\r\n<tr>\r\n<tr>\r\n<td>Email:</td><td>{customerEmail}</td>\r\n</tr>\r\n<tr>\r\n<td>Contact No.</td><td>{customerContact}</td>\r\n</tr>\r\n<tr>\r\n<td>Message:</td><td>{customerMessage}</td>\r\n</tr>\r\n</table>\r\n<br>\r\n<p><b>Comments From Admin:</b></p>\r\n<p>{adminComment}</p>\r\n<br>\r\n<p>Form posted from ip: {ip}</p\r\n\r\n<br>\r\nThank You,<br>\r\n<b>Eshopers Team.<b>\r\n</body>\r\n</html>',2,2,'2018-11-23 06:40:55','2018-11-24 05:00:28'),(8,'todaysAllOrder','Daily sales report','<html>\r\n<body>\r\n<p>Dear Administrator,</p>\r\n<p>This is the report of all orders placed today.</p>\r\n<div style=\'text-align:center; width:80%;\'>\r\n{todaysOrderDetails} \r\n</div>\r\n<br>\r\n<h3><b>Today\' order summary:</b></h3>\r\n<div style=\'text-align:center; width:80%;\'>\r\n{todaysOrderSummary}\r\n</div>\r\n<br>\r\n\r\n</body>\r\n</html>',2,2,'2018-11-24 06:46:14','2018-11-24 06:46:14');
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
INSERT INTO `model_has_permissions` VALUES (1,'App\\User',2),(2,'App\\User',2),(4,'App\\User',4),(4,'App\\User',5),(1,'App\\User',24),(2,'App\\User',24),(3,'App\\User',24),(4,'App\\User',25);
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
INSERT INTO `model_has_roles` VALUES (1,'App\\User',2),(5,'App\\User',4),(5,'App\\User',5),(2,'App\\User',24),(5,'App\\User',25);
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
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_details`
--

LOCK TABLES `order_details` WRITE;
/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;
INSERT INTO `order_details` VALUES (3,7,10,2,4242.00,'2018-11-20 00:20:28','2018-11-20 00:20:28'),(4,7,3,2,468.00,'2018-11-20 00:20:28','2018-11-20 00:20:28'),(5,7,9,1,3235.00,'2018-11-20 00:20:29','2018-11-20 00:20:29'),(9,10,2,1,312.00,'2018-11-20 03:57:25','2018-11-20 03:57:25'),(10,10,10,1,2121.00,'2018-11-20 03:57:25','2018-11-20 03:57:25'),(11,11,10,1,2121.00,'2018-11-20 04:01:22','2018-11-20 04:01:22'),(15,14,10,1,2121.00,'2018-11-21 03:50:46','2018-11-21 03:50:46'),(50,38,10,2,68.00,'2018-11-23 09:15:04','2018-11-23 09:15:04'),(51,38,12,2,78.00,'2018-11-23 09:15:04','2018-11-23 09:15:04'),(65,50,5,1,53.00,'2018-11-24 01:24:07','2018-11-24 01:24:07'),(66,51,7,3,99.00,'2018-11-24 01:49:36','2018-11-24 01:49:36'),(67,52,7,3,99.00,'2018-11-24 01:50:21','2018-11-24 01:50:21'),(68,53,7,3,99.00,'2018-11-24 01:50:37','2018-11-24 01:50:37'),(69,54,10,3,102.00,'2018-11-24 02:28:05','2018-11-24 02:28:05'),(70,55,3,4,60.00,'2018-11-24 05:10:21','2018-11-24 05:10:21'),(71,56,7,4,132.00,'2018-11-24 05:12:36','2018-11-24 05:12:36'),(72,56,5,5,265.00,'2018-11-24 05:12:37','2018-11-24 05:12:37'),(73,56,13,5,325.00,'2018-11-24 05:12:37','2018-11-24 05:12:37'),(74,56,15,3,153.00,'2018-11-24 05:12:37','2018-11-24 05:12:37'),(75,57,10,2,68.00,'2018-11-24 05:22:17','2018-11-24 05:22:17');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_gateways`
--

LOCK TABLES `payment_gateways` WRITE;
/*!40000 ALTER TABLE `payment_gateways` DISABLE KEYS */;
INSERT INTO `payment_gateways` VALUES (1,'cod',2,2,'2018-11-18 23:39:22','2018-11-18 23:39:22'),(2,'payPal',2,2,'2018-11-18 23:39:22','2018-11-18 23:39:22');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Add','web',NULL,NULL),(2,'Edit','web',NULL,NULL),(3,'Delete\r\n','web',NULL,NULL),(4,'Customer','',NULL,NULL),(5,'guest','web','2018-11-19 07:09:00','2018-11-19 07:09:00');
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
INSERT INTO `product_images` VALUES (2,2,'girl2.jpg','0',2,2,'2018-10-30 08:50:44','2018-10-30 08:50:44'),(3,3,'girl2.jpg','0',2,2,'2018-10-30 08:56:28','2018-10-30 08:56:28'),(4,4,'girl2.jpg','1',2,2,'2018-10-31 01:03:04','2018-10-31 01:03:04'),(5,5,'girl2.jpg','1',2,2,'2018-10-31 01:04:42','2018-10-31 01:04:42'),(6,6,'girl2.jpg','1',2,2,'2018-10-31 01:05:49','2018-10-31 01:05:49'),(7,7,'girl2.jpg','1',2,2,'2018-10-31 01:10:43','2018-10-31 01:10:43'),(8,8,'girl2.jpg','1',2,2,'2018-10-31 01:17:17','2018-10-31 01:17:17'),(9,9,'girl1.jpg','1',2,2,'2018-10-31 01:18:50','2018-10-31 01:18:50'),(10,10,'girl3.jpg','1',2,2,'2018-10-31 01:21:35','2018-10-31 01:21:35'),(11,11,'girl2.jpg','1',2,2,'2018-10-31 01:24:39','2018-10-31 01:24:39'),(12,12,'girl2.jpg','1',2,2,'2018-10-31 01:25:58','2018-10-31 01:25:58'),(13,13,'girl2.jpg','0',2,2,'2018-10-31 01:27:35','2018-10-31 01:27:35'),(14,14,'girl2.jpg','1',2,2,'2018-10-31 01:36:57','2018-10-31 01:36:57'),(15,15,'girl2.jpg','1',2,2,'2018-10-31 04:55:24','2018-10-31 04:55:24');
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
INSERT INTO `products` VALUES (2,'Polotshirt','4ew','sdf','sfsf',25.00,23.00,'2018-11-05','2018-11-10','1',214,'wdsads','dsadasdf ff faf fsdffsff','ffafafa tshirts',2,2,'2018-10-30 08:50:44','2018-10-31 00:51:17',1,1),(3,'handbag','d','3sdfsadfas','fasfsafasf',18.00,15.00,'2018-10-30','2018-11-17','1',3419,'fasf','fsdfasdf','fasfasf,tshirts',2,2,'2018-10-30 08:56:28','2018-10-31 00:50:26',1,1),(4,'product3','ww','fasfdff','fffafafs',26.00,20.00,'2018-10-31','2018-11-06','1',123,'edfasdf','fasdfasffasf','fasfasfs,tshirts',2,2,'2018-10-31 01:03:04','2018-10-31 01:03:04',1,1),(5,'product4','sscsff','asffs','fsfsafasf',55.00,53.00,'2018-11-02','2018-11-10','1',318,'fewfe','dfsdgfdg','gsdgsdgd tshirts',2,2,'2018-10-31 01:04:42','2018-10-31 01:04:42',1,1),(6,'fdfdfd','edgdgd','dgdgdgdg','gdgdg gdgd ggesgdg edfgsdgfds sdfgdgdg gsdgdsgsdg',49.00,45.00,'2018-11-03','2018-11-10','1',3423,'rtgertg','rghergrg','rgregrger tshirts',2,2,'2018-10-31 01:05:49','2018-10-31 01:05:49',1,1),(7,'product5','asdas','fasdf','ffa fsdasdf asdfsdfdsg rergv sefetgrf nh  segsfgsed',35.00,33.00,'2018-10-31','2018-11-25','0',206,'gdsgdfg','fsdfdsfsd','fsdfdsfdfdf bags',2,2,'2018-10-31 01:10:43','2018-10-31 01:10:43',1,1),(8,'fdsdf','jkjkgjhk','hghjhgjh',',jhkujkghjkghjfhf',60.00,57.00,'2018-11-08','2018-11-11','1',3423,'sfsdfgsd dg gsdg','gsdg dsgsdgsdg','segs segsegegbags',2,2,'2018-10-31 01:17:17','2018-10-31 01:17:17',0,1),(9,'poduct7','cfefsd','tyurtuyetetge ewtfgewg','gertgryrtujrtu trurtueumtr trsu5tryu turtutuy tytrysrtzh r',27.00,21.00,'2018-10-31','2018-11-04','1',342,'esrfgetts','ergwerfg','etwetwet,bags',2,2,'2018-10-31 01:18:50','2018-10-31 01:18:50',1,1),(10,'shdgvash','sdhdsh','afsdfabjksdf','svafjcs fbasjbjasd fasfsjkf fhasjkfsjk fjhafjskasb fasfjks fasjfakjf alkfjaslk assff ashfj .\r\nfhhfafns  asjkfbasjkf .',36.00,34.00,'2018-10-31','2018-11-08','1',337,'dgsdgds','gdsgsdgdg','dgsd sdgsdgdsg,bags',2,2,'2018-10-31 01:21:35','2018-10-31 01:21:35',1,1),(11,'dgsdtgr','gdsgdsg','dgdssd','dgsdgsdgd',16.00,12.00,'2018-10-31','2018-11-08','1',323,'grgrdsg','dfgsdgg','ggdgdg,bags',2,2,'2018-10-31 01:24:39','2018-10-31 01:24:39',1,1),(12,'gegeg','dgsdgs','gerwetgb rhegh','redrfbhdf hdrdrdr hrdhr',45.00,39.00,'2018-10-31','2018-11-07','1',2342,'ssssdgfgsd','dsgsdgsdg','gsdgsdgdsg gdgsdgsdg dgsdg,kids',2,2,'2018-10-31 01:25:58','2018-10-31 01:25:58',1,1),(13,'dfgsdg','dgdsg','scsafcas','sfasf afafaf ffafsf',70.00,65.00,'2018-10-31','2018-11-23','1',10,'efgsgf','sdgsgdg','gsdgsdgd gsdgsdd g, kids',2,2,'2018-10-31 01:27:35','2018-10-31 01:27:35',1,1),(14,'egege','ggsgd','gsdgdg','gsdgsdgd',66.00,63.00,'2018-11-01','2018-11-17','1',2323,'gbsdfgds','sdgds sdgsdgsdg sdgsdgd','sgsdgsdgdg,kids',2,2,'2018-10-31 01:36:56','2018-10-31 01:36:56',1,1),(15,'dfsdf','dfasfdasdf','fafafa','fasfaf',55.00,51.00,'2018-11-07','2018-11-08','1',1318,'fsadfd','dgsdgsdg','gdsgsdfgsdg.kids',2,2,'2018-10-31 04:55:24','2018-10-31 04:55:24',0,1);
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
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(1,2),(2,2),(3,2),(1,3),(2,3),(1,4),(2,4),(4,5),(5,6);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'superadmin','web','2018-10-26 05:35:02','2018-10-26 05:35:02'),(2,'admin','web','2018-10-26 05:35:02','2018-10-26 05:35:02'),(3,'inventory_manager','web','2018-10-26 05:35:02','2018-10-26 05:35:02'),(4,'order_manager','web','2018-10-26 05:35:02','2018-10-26 05:35:02'),(5,'customer','web','2018-10-26 05:35:02','2018-10-26 05:35:02'),(6,'guest','web',NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_addresses`
--

LOCK TABLES `user_addresses` WRITE;
/*!40000 ALTER TABLE `user_addresses` DISABLE KEYS */;
INSERT INTO `user_addresses` VALUES (13,7,'jaydeep nagar','nahur','mumbai','maharashtra','india','400042','2018-11-20 00:16:15','2018-11-20 00:16:15'),(14,23,'dvds','dvcx','sdvsd','dvd','dd','232323','2018-11-20 03:57:25','2018-11-20 03:57:25'),(15,26,'rable','rabale','mumbai','maharashtra','India','2432542','2018-11-21 03:29:32','2018-11-21 03:29:32'),(16,42,'jaideep nagar','nahur','mumbai','maharashtra','india','234543','2018-11-23 08:34:35','2018-11-23 08:34:35'),(17,43,'neosoft','rabale','new mumbai','maharashtra','India','400042','2018-11-24 01:24:07','2018-11-24 01:24:07');
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
  `shipping_method` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `AWB_NO` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_gateway_id` int(10) unsigned NOT NULL,
  `transaction_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('p','o','s','d') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'p',
  `grand_total` double(12,2) NOT NULL,
  `shipping_charges` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_id` int(10) unsigned DEFAULT NULL,
  `billed_to_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_address_1` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_address_2` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_city` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_state` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_country` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_zipcode` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipped_to_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_orders`
--

LOCK TABLES `user_orders` WRITE;
/*!40000 ALTER TABLE `user_orders` DISABLE KEYS */;
INSERT INTO `user_orders` VALUES (7,7,'Free','abcd123',1,'null','p',7947.00,'Free',1,'deepak sharma','jaydeep nagar','nahur','mumbai','maharashtra','india','400042','deepak sharma','','','','','','','2018-11-20 00:20:28','2018-11-20 00:20:28'),(10,23,'Free','abcd123',1,'null','p',2435.00,'Free',1,'gauri naik','dvds','dvcx','sdvsd','dvd','dd','232323','subodh kadam','jaydeep nagar','nahur','mumbai','maharashtra','India','400042','2018-11-20 03:57:25','2018-11-20 03:57:25'),(11,23,'Free','abcd123',1,'null','p',1954.00,'Free',3,'gauri naik','dvds','dvcx','sdvsd','dvd','dd','232323','dfsd dsfd','fdfd','fdf','fdfds','fds','fd','fdf','2018-11-20 04:01:22','2018-11-20 04:01:22'),(14,26,'Free','abcd123',1,'null','p',2123.00,'Free',1,'rohit kendre','rable','rabale','mumbai','maharashtra','India','2432542','rohit kendre','rable','rabale','mumbai','maharashtra','India','2432542','2018-11-21 03:50:46','2018-11-21 03:50:46'),(38,42,'charged','abcd123',1,'null','p',198.00,'50',1,'subodh kadam','jaideep nagar','nahur','mumbai','maharashtra','india','234543','subodh kadam','jaideep nagar','nahur','mumbai','maharashtra','india','234543','2018-11-23 09:15:04','2018-11-23 09:15:04'),(50,43,'charged','abcd123',1,'null','p',105.00,'50',1,'eshopers eshopers','neosoft','rabale','new mumbai','maharashtra','India','400042','eshopers eshopers','neosoft','rabale','new mumbai','maharashtra','India','400042','2018-11-24 01:24:07','2018-11-24 01:24:07'),(51,43,'charged','abcd123',1,'null','p',151.00,'50',1,'eshopers eshopers','neosoft','rabale','new mumbai','maharashtra','India','400042','eshopers eshopers','neosoft','rabale','new mumbai','maharashtra','India','400042','2018-11-24 01:49:36','2018-11-24 01:49:36'),(52,43,'charged','abcd123',1,'null','p',151.00,'50',1,'eshopers eshopers','neosoft','rabale','new mumbai','maharashtra','India','400042','eshopers eshopers','neosoft','rabale','new mumbai','maharashtra','India','400042','2018-11-24 01:50:21','2018-11-24 01:50:21'),(53,43,'charged','abcd123',1,'null','p',151.00,'50',1,'eshopers eshopers','neosoft','rabale','new mumbai','maharashtra','India','400042','eshopers eshopers','neosoft','rabale','new mumbai','maharashtra','India','400042','2018-11-24 01:50:37','2018-11-24 01:50:37'),(54,42,'charged','abcd123',1,'null','p',154.00,'50',1,'subodh kadam','jaideep nagar','nahur','mumbai','maharashtra','india','234543','subodh kadam','jaideep nagar','nahur','mumbai','maharashtra','india','234543','2018-11-24 02:28:05','2018-11-24 02:28:05'),(55,42,'charged','abcd123',1,'null','p',112.00,'50',1,'subodh kadam','jaideep nagar','nahur','mumbai','maharashtra','india','234543','subodh kadam','jaideep nagar','nahur','mumbai','maharashtra','india','234543','2018-11-24 05:10:21','2018-11-24 05:10:21'),(56,42,'Free','abcd123',1,'null','p',877.00,'0',1,'subodh kadam','jaideep nagar','nahur','mumbai','maharashtra','india','234543','subodh kadam','jaideep nagar','nahur','mumbai','maharashtra','india','234543','2018-11-24 05:12:36','2018-11-24 05:12:36'),(57,42,'charged','abcd123',1,'null','p',120.00,'50',1,'subodh kadam','jaideep nagar','nahur','mumbai','maharashtra','india','234543','subodh kadam','jaideep nagar','nahur','mumbai','maharashtra','india','234543','2018-11-24 05:22:17','2018-11-24 05:22:17');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_wish_lists`
--

LOCK TABLES `user_wish_lists` WRITE;
/*!40000 ALTER TABLE `user_wish_lists` DISABLE KEYS */;
INSERT INTO `user_wish_lists` VALUES (1,5,10,'2018-11-02 09:30:37','2018-11-02 09:30:37'),(2,5,6,'2018-11-02 09:55:29','2018-11-02 09:55:29'),(3,5,10,'2018-11-02 09:55:45','2018-11-02 09:55:45'),(4,5,13,'2018-11-02 10:06:02','2018-11-02 10:06:02'),(5,5,9,'2018-11-03 06:19:49','2018-11-03 06:19:49'),(11,7,7,'2018-11-13 04:38:53','2018-11-13 04:38:53');
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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'Abcd','abcd','subodhkadam0619@gmail.com','$2y$10$qIgWChQIknNDIw4gCbisb.w/vBQi6a/z78NoNFNPeE0GSY.fJaAwW','1','2018-10-26','null','null','null','n',1,'2018-10-26 05:37:20','2018-10-26 05:37:20','E6UuehdQccTyFcdaqhTXetFJypXOSmZiDi0cGREHnpgUWv83InciTfUsTb1X'),(5,'rajesh','surve','raj@gmail.com','$2y$12$HlztNnITpB5HA46fNaKdne6itpx/TtPCGLdr7IXILdiodmteuPGRS','1','2018-10-30',NULL,NULL,NULL,'n',5,'2018-10-30 05:21:35','2018-10-30 05:21:35','miUzRpYC3xyfujqmc86ZeouYyjCwDMoJWsWaqw5cLUFqNm4lUk2jj3KEBnYt'),(6,'subodh','Kadam','abc@gmail.com','$2y$10$I3h3swMoFlJSM7aUITxWYeDDa3xVAvMd4a6iZIl2S.PaMH1ZfpeGC','1','2018-11-02',NULL,NULL,NULL,'n',5,'2018-11-02 01:40:42','2018-11-02 01:40:42','Y59FyMftGSuz4FSCndMeQPAGLGx8MBrznY1oP7CPspXIwVkG55qzncYa3SOb'),(7,'deepak','kadam','deepak@gmail.com','$2y$10$yYBF9sJYW.V81h1PLdiiWer9Izx5.pnLZTXPRSgJjkRp3n6X3reOC','1','2018-11-03',NULL,NULL,NULL,'n',5,'2018-11-03 03:36:02','2018-11-20 03:45:24','CtvLWZiB1YX6UzJeisZlWCAVRLLEeOcwAkxM2Gwmo3hNLf8MtjtaaNH7tkOb'),(8,'avinash','Gayakwad','avi@gmail.com','$2y$10$W8nv/fHH3paErRlM9jmM0.FbUfUV2cBWDKBy671mtIkUn4LFhSUD2','1','2018-11-15',NULL,NULL,NULL,'n',5,'2018-11-14 23:28:25','2018-11-14 23:28:25','zRQUBwfQkCsM3SKti6BLxhs8ZB1D22W1gZkK1IvY0AuNygrgKM0TunZMxywL'),(23,'gauri','naik','gauri@gmail.com','$2y$10$ZjcJI31qfmZHuG.jIgGy..Lhzy5HBikyr3OKuYfXcTUZf13jPxytK','1','2018-11-20',NULL,NULL,NULL,'n',5,'2018-11-20 03:57:25','2018-11-20 03:57:25','yvdwRqDFsq7iFD5yROXvVV07TkwsHa0vCygCBESzjpDzNGOBtjSxx4ZytHZ6'),(25,'demo3','demo3','demo@gmail.com','$2y$10$3JPfCza8UofQ0HtIAZfuq.SNtLpsh4UNz37I7sQNzc3LNi3j5vyhe','0','2018-11-21',NULL,NULL,NULL,'n',5,'2018-11-21 00:50:53','2018-11-21 01:09:03','tCpzp2dXCiLcPXwT9tc1fhvNevMHXvXYBpxvstnqiRXuRnjcuvrjCCqzl7Y7'),(26,'rohit','kendre','rohit.kendre@neosofttech.com','$2y$10$GOJyWXC/Z.i6KZ9kQ1XP7eMrhA5sHndMQC1jS722qJBcQCJjgykt2','1','2018-11-21',NULL,NULL,NULL,'n',5,'2018-11-21 03:29:32','2018-11-21 03:29:32','hpFrO00WcLc28pVS9XQSVRMm2YwkASYObYfwaeIUh4HXt7hojWmY6D2fkLGY'),(42,'subodh','kadam','kadamsubodh0619@gmail.com','$2y$10$ScdUo9NYvbNModlBJ63mT.KwI6svHEGTiKP41706j0ePXK.id6d1W','1','2018-11-23',NULL,NULL,NULL,'n',5,'2018-11-23 07:30:32','2018-11-23 07:30:32','yxtVPvYrmX2xW4ntUL8YFDd0dUdmITgjeLqTFbd7h6KvszHj7lBRHFmZV1LE'),(43,'eshopers','eshopers','eshopersnoreply@gmail.com','$2y$10$GPbQR9Qg4cL/CdQdq9wCYOGK01KTg9PK9basnuRUe.rsntnp6t.2e','1','2018-11-24',NULL,NULL,NULL,'n',5,'2018-11-24 01:24:07','2018-11-24 01:24:07','ECofnV3t6HsVvBMbC83suELD7H77bU28QN4ugRd63q02vPytD4mfjQzuKgtq');
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

-- Dump completed on 2018-11-24 19:29:40
