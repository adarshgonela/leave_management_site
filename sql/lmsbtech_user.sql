CREATE DATABASE  IF NOT EXISTS `lmsbtech` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `lmsbtech`;
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
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(225) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `role` varchar(45) DEFAULT NULL,
  `age` varchar(45) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `phno` varchar(45) DEFAULT NULL,
  `rollnumber` varchar(45) DEFAULT NULL,
  `profileimg` blob,
  `address` varchar(225) DEFAULT NULL,
  `department` varchar(45) DEFAULT NULL,
  `yearsem` varchar(45) DEFAULT NULL,
  `totalleaves` int DEFAULT '25',
  `remainingleaves` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'a@gmail.com','1','adarsh12','student','23','male','9999999','19941A0449',NULL,'erragada,mental hospital','ECE','1-1',25,NULL),(2,'add12@gmail.com','1','asus123','hod','22','male','1111111','19941A0445',NULL,'charminar oldcity,hyd','ECE',NULL,25,NULL),(4,'asd@gmail.com','$2y$10$sZsm8jpn8rMimZyMf/xLauRGskP4qVa30FdSYBevp7KQHsJJq3ehO','admin','hod',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,25,NULL),(5,'asd1@gmail.com','$2y$10$3dm8F/uMufj8ebwUf/LtneflCk7Dv/o9tUQtL.etrAf6cQ.kseH7G','admin1','classincharge',NULL,NULL,NULL,'19941A0443',NULL,NULL,'ECE',NULL,25,NULL),(6,'inas@gmail.com','$2y$10$5UqKWnHHaWed1BKb3Z0J6.Z6uyJ1ckt1HclKS.s3SgIjFl2KP1bvK','inas','student',NULL,NULL,NULL,'19941A0441',NULL,NULL,NULL,NULL,25,NULL),(7,'inas@gmail.com','$2y$10$pmBBdGRLwvmfp5St.FjXHuUv5rPJGdq89V3co8vt5OjuUXzBsk/Iq','inas','student',NULL,NULL,NULL,'19941A0442',NULL,NULL,NULL,NULL,25,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-04 12:35:03
