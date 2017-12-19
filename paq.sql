-- MySQL dump 10.13  Distrib 5.6.23, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: paq
-- ------------------------------------------------------
-- Server version	5.5.32

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
-- Table structure for table `package_descs`
--

DROP TABLE IF EXISTS `package_descs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `package_descs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) DEFAULT NULL,
  `carrier` varchar(50) DEFAULT NULL,
  `dest` varchar(100) DEFAULT NULL,
  `reference_number` varchar(100) DEFAULT NULL,
  `ship_mode` varchar(50) DEFAULT NULL,
  `charge_type` varchar(50) DEFAULT NULL,
  `airport_depart` varchar(100) DEFAULT NULL,
  `airport_dest` varchar(100) DEFAULT NULL,
  `notify_party` varchar(100) DEFAULT NULL,
  `export_instructions` varchar(100) DEFAULT NULL,
  `place_of_reception` varchar(100) DEFAULT NULL,
  `shop_line` varchar(100) DEFAULT NULL,
  `port_of_loading` varchar(100) DEFAULT NULL,
  `place_of_deliver` varchar(100) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package_descs`
--

LOCK TABLES `package_descs` WRITE;
/*!40000 ALTER TABLE `package_descs` DISABLE KEYS */;
/*!40000 ALTER TABLE `package_descs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package_locations`
--

DROP TABLE IF EXISTS `package_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `package_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package_locations`
--

LOCK TABLES `package_locations` WRITE;
/*!40000 ALTER TABLE `package_locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `package_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `package_type` int(11) DEFAULT NULL,
  `shipper_id` int(11) DEFAULT NULL,
  `consignee` varchar(50) DEFAULT NULL,
  `location` text,
  `observation` text,
  `box_qty` int(11) DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `height` float DEFAULT NULL,
  `width` float DEFAULT NULL,
  `length` float DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packages`
--

LOCK TABLES `packages` WRITE;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recover_passwords`
--

DROP TABLE IF EXISTS `recover_passwords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recover_passwords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `hash` varchar(100) DEFAULT NULL,
  `duration` timestamp NULL DEFAULT NULL,
  `was_used` int(11) DEFAULT '0',
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recover_passwords`
--

LOCK TABLES `recover_passwords` WRITE;
/*!40000 ALTER TABLE `recover_passwords` DISABLE KEYS */;
/*!40000 ALTER TABLE `recover_passwords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(20) DEFAULT NULL,
  `description` varchar(20) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'root','root',NULL,NULL),(2,'administrador','administrador',NULL,NULL),(3,'cliente','cliente',NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shippers`
--

DROP TABLE IF EXISTS `shippers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shippers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `address` text,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shippers`
--

LOCK TABLES `shippers` WRITE;
/*!40000 ALTER TABLE `shippers` DISABLE KEYS */;
/*!40000 ALTER TABLE `shippers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(100) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'procesando','procesando',NULL,NULL),(2,'en-camino','en camino',NULL,NULL),(3,'en-aeropuerto','en aeropuerto',NULL,NULL),(4,'en-puerto','en purto',NULL,NULL),(5,'entregado','entregado',NULL,NULL);
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `types`
--

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` VALUES (1,'puerta-a-puerta','puerta a puerta',NULL,NULL),(2,'aereos','aereos',NULL,NULL),(3,'maritimos','maritimos',NULL,NULL);
/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL DEFAULT '',
  `password` varchar(60) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `role_id` int(11) DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$1qehMfY9b5NISXn9WCVbqOdhMfRMHrwRqdF9PGbI9BE9F3V7uZpOe',NULL,NULL,0,2,'TDBuPFUSO1hYxwt1P41JipQlSBa6GRmFdzVk5DTozKF7mAs6ApoSfU5UX39G',NULL,'2017-11-02'),(2,'administrador','$2y$10$xBkl3nNIaEl1Rd5kKKIT1uZT0.ntKbIIzmKgaiofGFXGySMcq5f/y','emaila@modificame.com',NULL,0,2,NULL,'2017-09-28','2017-09-28'),(3,'cliente','$2y$10$Mw3zxahvIFcHO/QAYsP3eOU8fxev47mlFY4e2e.L3oHjKJ8nnidOS','cliente@email.com',NULL,0,3,'3iesNQ4oATb9tHUBAOymjShJC0Wh4g0zoQbfj4qAykuoplkcKKsZ2fitJWRS','2017-09-28','2017-10-16'),(4,'cliente2','$2y$10$R.jTConf677UocQQmdVDceTB/.WBQBEs4D3rbiogjwaWOlw6sguUe','cliente2@email.com',NULL,0,3,NULL,'2017-09-28','2017-09-28'),(5,'cliente3','$2y$10$R.jTConf677UocQQmdVDceTB/.WBQBEs4D3rbiogjwaWOlw6sguUe','cliente3@email.com',NULL,0,3,NULL,'2017-09-28','2017-09-28'),(6,'cliente4','$2y$10$R.jTConf677UocQQmdVDceTB/.WBQBEs4D3rbiogjwaWOlw6sguUe','cliente4@email.com',NULL,0,3,NULL,'2017-09-28','2017-09-28'),(7,'cliente5','$2y$10$R.jTConf677UocQQmdVDceTB/.WBQBEs4D3rbiogjwaWOlw6sguUe','cliente5@email.com',NULL,0,3,NULL,'2017-09-28','2017-09-28'),(8,'cliente6','$2y$10$R.jTConf677UocQQmdVDceTB/.WBQBEs4D3rbiogjwaWOlw6sguUe','cliente6@email.com',NULL,0,3,NULL,'2017-09-28','2017-09-28'),(9,'cliente7','$2y$10$R.jTConf677UocQQmdVDceTB/.WBQBEs4D3rbiogjwaWOlw6sguUe','cliente7@email.com',NULL,0,3,NULL,'2017-09-28','2017-09-28'),(10,'cliente8','$2y$10$R.jTConf677UocQQmdVDceTB/.WBQBEs4D3rbiogjwaWOlw6sguUe','cliente8@email.com',NULL,0,3,NULL,'2017-09-28','2017-09-28'),(11,'cliente9','$2y$10$R.jTConf677UocQQmdVDceTB/.WBQBEs4D3rbiogjwaWOlw6sguUe','cliente9@email.com',NULL,0,3,NULL,'2017-09-28','2017-09-28'),(12,'usuariocool','$2y$10$lw3URr33dKEYzFXJ5ZVt/.qf8qItdDGMTLiQNpHp9EG2K8KFQnssC','email@email.com','pepito perez',0,3,NULL,'2017-11-02','2017-11-02');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'paq'
--

--
-- Dumping routines for database 'paq'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-02 11:13:39
