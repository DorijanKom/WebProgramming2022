-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: localhost    Database: Bookstore
-- ------------------------------------------------------
-- Server version	8.0.29

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
-- Table structure for table `Books`
--

DROP TABLE IF EXISTS `Books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Book_Name` varchar(100) DEFAULT NULL,
  `Writer_ID` int DEFAULT NULL,
  `Date_of_Publishing` date DEFAULT NULL,
  `Book_price` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Books_FK` (`Writer_ID`),
  CONSTRAINT `Books_FK` FOREIGN KEY (`Writer_ID`) REFERENCES `Writers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Books`
--

LOCK TABLES `Books` WRITE;
/*!40000 ALTER TABLE `Books` DISABLE KEYS */;
INSERT INTO `Books` VALUES (1,'Dune',2,'2021-10-14',29),(2,'Dreamcatcher',1,'2011-08-25',24.99),(4,'Red Rising',3,'2015-06-10',24.99),(17,'Son of Gold',3,'2022-03-30',20),(18,'MorningStar',3,'2022-03-27',24.99);
/*!40000 ALTER TABLE `Books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Orders`
--

DROP TABLE IF EXISTS `Orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Order_Amont` int DEFAULT NULL,
  `BookID` int DEFAULT NULL,
  `Order_price` float DEFAULT NULL,
  `Date_of_Order` date DEFAULT NULL,
  `Date_of_Delivery` date DEFAULT NULL,
  `User_ID` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Orders_FK` (`BookID`),
  KEY `Orders_FK_1` (`User_ID`),
  CONSTRAINT `Orders_FK` FOREIGN KEY (`BookID`) REFERENCES `Books` (`id`),
  CONSTRAINT `Orders_FK_1` FOREIGN KEY (`User_ID`) REFERENCES `Users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Orders`
--

LOCK TABLES `Orders` WRITE;
/*!40000 ALTER TABLE `Orders` DISABLE KEYS */;
INSERT INTO `Orders` VALUES (1,40,1,1160,'2021-10-20','2021-10-27',2),(2,35,2,525,'2011-09-01','2011-09-08',2);
/*!40000 ALTER TABLE `Orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Purchase`
--

DROP TABLE IF EXISTS `Purchase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Purchase` (
  `id` int NOT NULL AUTO_INCREMENT,
  `BookID` int DEFAULT NULL,
  `Time_of_Purchase` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Purchase_FK` (`BookID`),
  CONSTRAINT `Purchase_FK` FOREIGN KEY (`BookID`) REFERENCES `Books` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Purchase`
--

LOCK TABLES `Purchase` WRITE;
/*!40000 ALTER TABLE `Purchase` DISABLE KEYS */;
INSERT INTO `Purchase` VALUES (1,1,'2021-11-05 15:20:48'),(2,1,'2021-11-07 12:05:54');
/*!40000 ALTER TABLE `Purchase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `User_Name` varchar(100) DEFAULT NULL,
  `User_Last_Name` varchar(100) DEFAULT NULL,
  `User_email` varchar(100) DEFAULT NULL,
  `User_Role` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (1,'Dorijan','Komšić','dorijan.komsic@stu.ibu.edu.ba','Admin','827ccb0eea8a706c4c34a16891f84e7b'),(2,'Arijan','Komšić','arijan.komsic@stu.ibu.edu.ba','Employee','01cfcd4f6b8770febfb40cb906715822');
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Writers`
--

DROP TABLE IF EXISTS `Writers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Writers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Writer_Name` varchar(100) DEFAULT NULL,
  `Writer_Last_Name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Writers`
--

LOCK TABLES `Writers` WRITE;
/*!40000 ALTER TABLE `Writers` DISABLE KEYS */;
INSERT INTO `Writers` VALUES (1,'Stephen','King'),(2,'Frank','Herbert'),(3,'Pierce','Brown'),(12,'J.D','Salinger');
/*!40000 ALTER TABLE `Writers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'Bookstore'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-23  9:12:05
