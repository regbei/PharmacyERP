-- MariaDB dump 10.19  Distrib 10.4.18-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: shop
-- ------------------------------------------------------
-- Server version	10.4.18-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(222) CHARACTER SET utf8 NOT NULL,
  `pic` varchar(111) NOT NULL,
  `details` varchar(333) CHARACTER SET utf8 NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (13,'لحوم','IMG_20240424_204028.jpg','','2024-04-24 18:45:27'),(14,'خضروات','IMG_20240424_203928.jpg','','2024-04-24 18:45:48'),(15,'مشروبات','IMG_20240424_204013.jpg','','2024-04-24 18:46:09'),(16,'حلويات','IMG_20240424_203953.jpg','','2024-04-24 18:46:26'),(17,'منتجات ألبان','IMG_20240424_203900.jpg','','2024-04-24 18:46:40'),(18,'بهارات و بقوليات','IMG_20240424_203741.jpg','','2024-04-24 18:56:39');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `address` varchar(100) NOT NULL,
  `region` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (1,'دال للغذائيات','الخرطوم بحري','السودان'),(2,'المراعي للألبان','الرياض','السعودية');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currency`
--

DROP TABLE IF EXISTS `currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `price` int(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table created for dealing with variable currency price';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currency`
--

LOCK TABLES `currency` WRITE;
/*!40000 ALTER TABLE `currency` DISABLE KEYS */;
/*!40000 ALTER TABLE `currency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventeries`
--

DROP TABLE IF EXISTS `inventeries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventeries` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `bin` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'Bi21131D',
  `catId` bigint(20) NOT NULL,
  `supplier` varchar(222) CHARACTER SET utf16 NOT NULL,
  `name` text CHARACTER SET utf8 NOT NULL,
  `unit` text CHARACTER SET utf16 NOT NULL,
  `price` text CHARACTER SET utf16 NOT NULL,
  `quantity` int(20) NOT NULL DEFAULT 0,
  `company` varchar(111) CHARACTER SET utf16 NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `Barcode_index_key` (`bin`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventeries`
--

LOCK TABLES `inventeries` WRITE;
/*!40000 ALTER TABLE `inventeries` DISABLE KEYS */;
INSERT INTO `inventeries` VALUES (1,'6253225866850',17,'2','لبن أنكور فاخر','1kg','3000',9,'2','2024-05-04 10:27:38'),(2,'6253225866800',17,'2','زبادي كابو مشكل','1kg','781',23,'2','2024-05-04 10:28:40');
/*!40000 ALTER TABLE `inventeries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `lastacc`
--

DROP TABLE IF EXISTS `lastacc`;
/*!50001 DROP VIEW IF EXISTS `lastacc`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `lastacc` (
  `total` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `quick_sales`
--

DROP TABLE IF EXISTS `quick_sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quick_sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantity` int(30) NOT NULL,
  `price` int(50) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `product_id` int(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `product_id_index` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quick_sales`
--

LOCK TABLES `quick_sales` WRITE;
/*!40000 ALTER TABLE `quick_sales` DISABLE KEYS */;
INSERT INTO `quick_sales` VALUES (1,3,9000,'1kg',1,'2024-05-04 10:29:08'),(2,3,2343,'1kg',2,'2024-05-04 10:29:16'),(3,2,1562,'1kg',2,'2024-05-04 10:30:26'),(4,9,27000,'1kg',1,'2024-05-04 10:30:31'),(5,2,6000,'1kg',1,'2024-05-04 10:30:52'),(6,8,24000,'1kg',1,'2024-05-04 10:31:06'),(7,1,781,'1kg',2,'2024-05-04 10:31:17'),(8,10,30000,'1kg',1,'2024-05-04 18:08:10'),(9,10,7810,'1kg',2,'2024-05-04 18:08:33'),(10,4,12000,'1kg',1,'2024-05-04 19:03:50'),(11,4,3124,'1kg',2,'2024-05-04 19:03:55'),(12,13,10153,'1kg',2,'2024-05-04 19:35:22'),(13,21,63000,'1kg',1,'2024-05-04 19:35:30');
/*!40000 ALTER TABLE `quick_sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `quantity` int(100) NOT NULL,
  `price` int(11) NOT NULL,
  `unit` varchar(20) NOT NULL DEFAULT 'piece',
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `item` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site`
--

DROP TABLE IF EXISTS `site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(222) CHARACTER SET utf8 NOT NULL,
  `name` varchar(222) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site`
--

LOCK TABLES `site` WRITE;
/*!40000 ALTER TABLE `site` DISABLE KEYS */;
INSERT INTO `site` VALUES (1,'بقالة الأمانة للمواد الغذائية','بقالة الأمانة للمواد الغذائية');
/*!40000 ALTER TABLE `site` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sold`
--

DROP TABLE IF EXISTS `sold`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sold` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(222) CHARACTER SET utf8 NOT NULL,
  `contact` varchar(222) CHARACTER SET utf8 NOT NULL,
  `discount` varchar(222) NOT NULL,
  `amount` varchar(222) CHARACTER SET utf8 NOT NULL,
  `paid_amount` int(100) NOT NULL,
  `due` int(100) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `method` enum('كاش','أجل','بنكك','تم السداد') CHARACTER SET utf8 NOT NULL DEFAULT 'كاش',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sold`
--

LOCK TABLES `sold` WRITE;
/*!40000 ALTER TABLE `sold` DISABLE KEYS */;
/*!40000 ALTER TABLE `sold` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 NOT NULL,
  `phone` varchar(16) NOT NULL,
  `address` text CHARACTER SET utf8 NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` VALUES (1,'أسامة محمد عادل','09123001230','امدرمان ود نوباوي','2024-05-04 10:25:49'),(2,'عمر عبد العظيم','0921309123','الثورة شارع الوادي','2024-05-04 10:26:16');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(222) CHARACTER SET utf8 NOT NULL,
  `password` varchar(222) CHARACTER SET utf8 NOT NULL,
  `name` varchar(222) CHARACTER SET utf8 NOT NULL,
  `role` int(1) NOT NULL DEFAULT 2,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin@gmail.com','admin','Sameer Amjed',1,'2024-04-22 05:22:14'),(2,'Hana@pharmatician','admin','Hana Ahmed',2,'2024-04-22 05:23:28'),(9,'OsmanSons@mail.com','admin','وائل عثمان عوض',2,'2024-04-23 14:14:12'),(10,'samar@mail.com','admin','Samar ahmed mohammed',2,'2024-04-24 07:54:05');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `lastacc`
--

/*!50001 DROP TABLE IF EXISTS `lastacc`*/;
/*!50001 DROP VIEW IF EXISTS `lastacc`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `lastacc` AS select sum(`inventeries`.`quantity`) * sum(`inventeries`.`price`) AS `total` from `inventeries` group by `inventeries`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-05  2:58:52
