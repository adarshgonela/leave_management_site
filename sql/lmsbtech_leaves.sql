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
-- Table structure for table `leaves`
--

DROP TABLE IF EXISTS `leaves`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leaves` (
  `id` int NOT NULL AUTO_INCREMENT,
  `studentrollnumber` varchar(225) DEFAULT NULL,
  `leavetype` varchar(225) DEFAULT NULL,
  `reason` varchar(45) DEFAULT NULL,
  `todate` varchar(50) DEFAULT NULL,
  `fromdate` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `hodrollnumber` varchar(45) DEFAULT NULL,
  `classinchargerollnumber` varchar(45) DEFAULT NULL,
  `applyingtime` varchar(45) DEFAULT NULL,
  `noofdaystaken` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leaves`
--

LOCK TABLES `leaves` WRITE;
/*!40000 ALTER TABLE `leaves` DISABLE KEYS */;
INSERT INTO `leaves` VALUES (1,'19941A0444','sick','gng to hosp','23-12-20204','25-12-2024','pending','123','234',NULL,NULL),(2,'19941A0445','Personal Leave','aa','2024-12-20','2024-12-20','Approved','19941A0445','19941A0443',NULL,NULL),(3,'19941A0445','Personal Leave','aa','2024-12-20','2024-12-20','Approved','19941A0445','19941A0443',NULL,NULL),(4,'19941A0441','casual Leave','aaa','2025-01-04','2025-01-04','pending','19941A0445','19941A0443',NULL,NULL),(5,'19941A0445','Emergency Leave','ADD','2024-12-28','2024-12-27','approved','19941A0445','19941A0443','2024-12-26 19:03:04',NULL),(6,'19941A0445','vacation Leave','','2025-01-04','2025-01-01','approved','19941A0445','19941A0443','2024-12-26 19:06:36',NULL),(7,'19941A0445','Emergency Leave','','2024-12-27','2024-12-25','approved','19941A0445','19941A0443','2024-12-26 19:10:03',NULL),(8,'19941A0445','Personal Leave','gng to mental hosp','2025-01-03','2025-01-01','approved','19941A0445','19941A0443','2024-12-27 10:48:07',NULL),(9,'19941A0445','Personal Leave','','','','approved','19941A0445','19941A0443','2024-12-27 10:51:49',NULL),(10,'19941A0445','Emergency Leave','','2024-12-28','2024-12-27','approved','19941A0445','19941A0443','27-12-2024 10:56:24',NULL),(11,'19941A0445','Personal Leave','dd','2024-12-29','2024-12-27','approved','19941A0445','19941A0443','27-12-2024 11:15:47',NULL),(12,'19941A0445','Emergency Leave','qqqq','2024-12-29','2024-12-27','approved','19941A0445','19941A0443','27-12-2024 11:18:19',2),(13,'19941A0445','Personal Leave','zzzzzzzz','2024-12-30','2024-12-28','approved','19941A0445','19941A0443','27-12-2024 11:51:19',2),(14,'19941A0442','vacation Leave','','2025-01-09','2024-12-31','approved','19941A0445','19941A0443','27-12-2024 11:57:50',9),(15,'19941A0445','sick leaves','','09-01-2025','28-12-2024','approved','19941A0445','19941A0443','27-12-2024 12:03:03',12),(16,'19941A0449','vacation Leave','fever','11-01-2025','02-01-2025','approved','19941A0445','19941A0443','30-12-2024 11:54:28',9),(17,'19941A0449','Personal Leave','aaaa','17-01-2025','10-01-2025','approved','19941A0445','19941A0443','04-01-2025 19:36:53',7),(18,'19941A0449','Personal Leave','','23-01-2025','21-01-2025','approved','19941A0445','19941A0443','05-01-2025 18:06:50',2),(19,'19941A0333','sick leaves','fever','06-01-2025','05-01-2025','approved','19941A0445','19941A0443','2025-01-05 18:24:31',1),(20,'19941A0333','casual Leave','','06-01-2025','05-01-2025','approved','19941A0445','19941A0443','2025-01-05 19:10:34',1),(21,'19941A0333','Personal Leave','','08-01-2025','06-01-2025','approved','19941A0445','19941A0443','2025-01-06 11:25:45',2),(22,'19941A0333','casual Leave','gng to mve','08-01-2025','06-01-2025','approved','19941A0445','19941A0443','2025-01-06 11:27:52',2),(23,'19941A0333','Emergency Leave','','09-01-2025','07-01-2025','approved','19941A0445','19941A0443','2025-01-07 18:22:05',2),(24,'19941A0111','Emergency Leave','aaa','2025-01-11','2025-01-09','rejected','','','2025-01-09 13:51:41',2),(25,'19941A0455','Personal Leave','','2025-01-14','2025-01-12','approved','19941A0445','19941A0443','2025-01-12 12:14:50',2),(26,'19941A0455','casual Leave','','2025-01-14','2025-01-12','approved','19941A0445','19941A0443','2025-01-12 13:07:07',2),(27,'19941A0455','Emergency Leave','mmm','2025-01-16','2025-01-12','approved','19941A0445','19941A0443','2025-01-12 16:32:16',4),(28,'19941A0455','sick leaves','','2025-01-13','2025-01-12','approved','19941A0445','19941A0443','2025-01-12 17:40:23',1),(29,'19941A0455','Personal Leave','','2025-01-13','2025-01-13','pending','19941A0445','19941A0443','2025-01-13 09:47:27',0),(30,'19941A0455','vacation Leave','','2025-01-15','2025-01-14','pending','19941A0445','19941A0443','2025-01-13 09:49:04',1);
/*!40000 ALTER TABLE `leaves` ENABLE KEYS */;
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
