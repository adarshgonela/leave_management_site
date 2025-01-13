-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: lmsbtech
-- ------------------------------------------------------
-- Server version	8.0.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `notificationsmsg` varchar(225) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fromrollnumber` varchar(225) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `torollnumber` varchar(225) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notificationtime` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,'Your leave request for [dates] has been approved by the HOD.','19941A0449','19941A0445','01:46'),(2,'Your leave request for [dates] has been approved by the Student.','19941A0445','19941A0449','01:47'),(3,'Your leave request forecho $noofdaystakenhas been approved','19941A0449','19941A0333','2025-01-07 18:33:24'),(4,'Your leave request forecho $noofdaystakenhas been approved','19941A0445','19941A0333','2025-01-07 18:35:07'),(5,'Your leave request has been approved','19941A0445','19941A0333','2025-01-07 18:39:28'),(6,'Your leave request has been rejected','19941A0445','19941A0333','2025-01-07 18:40:42'),(7,'Your leave request has been approved','19941A0445','19941A0222','2025-01-09 12:20:59'),(8,'Your leave request has been rejected','19941A0445','19941A0111','2025-01-09 13:52:37'),(9,'Your leave request has been rejected','19941A0445','19941A0111','2025-01-09 13:53:47'),(10,'Your leave request has been rejected','19941A0445','19941A0111','2025-01-08 13:55:09'),(11,'Your leave request has been rejected','19941A0445','19941A0111','2025-01-09 13:56:27'),(12,'Your leave request has been rejected','19941A0445','19941A0455','2025-01-12 12:25:42'),(13,'Your leave request has been rejected','19941A0445','19941A0455','2025-01-12 12:28:22'),(14,'Your leave request has been rejected','19941A0445','19941A0455','2025-01-12 12:34:18'),(15,'Your leave request has been rejected','19941A0445','19941A0455','2025-01-12 12:39:46'),(16,'Your leave request has been rejected','19941A0445','19941A0455','2025-01-12 12:41:27'),(17,'You have a new leave request from student . The status of the request is ','19941A0455',NULL,'2025-01-12 13:07:07'),(18,'You have a new leave request from student . The status of the request is ','19941A0455','19941A0445','2025-01-13 16:32:16'),(19,'You have a new leave request from student . The status of the request is ','19941A0455','19941A0445','2025-01-12 17:40:23'),(20,'Your leave request has been approved','19941A0445','19941A0455','2025-01-13 18:51:20'),(21,'You have a new leave request from student . The status of the request is ','19941A0455','19941A0445','2025-01-13 09:47:27'),(22,'You have a new leave request from student  \'19941A0455\'','19941A0455','19941A0445','2025-01-13 10:16:04');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-13 14:20:24
