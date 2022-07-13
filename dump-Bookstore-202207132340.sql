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
  `Publisher` int DEFAULT NULL,
  `Year_of_publishing` year DEFAULT NULL,
  `Book_price` float DEFAULT NULL,
  `In_inventory` int DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `Books_FK_1` (`Publisher`),
  CONSTRAINT `Books_FK_1` FOREIGN KEY (`Publisher`) REFERENCES `Publishers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Books`
--

LOCK TABLES `Books` WRITE;
/*!40000 ALTER TABLE `Books` DISABLE KEYS */;
INSERT INTO `Books` VALUES (4,'Red Rising',2,2015,24.99,91,1),(17,'Son of Gold',2,2022,19.99,78,1),(18,'MorningStar',2,2022,24.99,30,1),(48,'Children of Dune',1,2020,24.99,100,1),(61,'Heretics of Dune',1,2021,24.99,34,1),(62,'Dune Messiah',1,2021,24.99,176,1),(64,'Harry Potter And the Chamber of Secrets',1,2015,24.99,15,1),(65,'Harry Potter And The Philosophers Stone',1,2015,24.99,15,1),(88,'Catcher in the Rye',6,2015,21.99,11,1),(89,'Catcher in the Rye',6,2022,21.99,12,1),(90,'The Hobbit',5,2021,14.99,15,1);
/*!40000 ALTER TABLE `Books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `BooksAndWriters`
--

DROP TABLE IF EXISTS `BooksAndWriters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `BooksAndWriters` (
  `id` int NOT NULL AUTO_INCREMENT,
  `writerid` int NOT NULL,
  `bookid` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `BooksAndWriters_FK` (`bookid`),
  KEY `BooksAndWriters_FK_1` (`writerid`),
  CONSTRAINT `BooksAndWriters_FK` FOREIGN KEY (`bookid`) REFERENCES `Books` (`id`),
  CONSTRAINT `BooksAndWriters_FK_1` FOREIGN KEY (`writerid`) REFERENCES `Writers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BooksAndWriters`
--

LOCK TABLES `BooksAndWriters` WRITE;
/*!40000 ALTER TABLE `BooksAndWriters` DISABLE KEYS */;
INSERT INTO `BooksAndWriters` VALUES (3,3,4),(4,3,17),(5,3,18),(11,2,48),(22,2,61),(23,2,62),(25,21,64),(26,21,65),(46,12,88),(47,12,89),(48,22,90);
/*!40000 ALTER TABLE `BooksAndWriters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Orders`
--

DROP TABLE IF EXISTS `Orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `book_name` varchar(100) DEFAULT NULL,
  `Order_Amount` int DEFAULT NULL,
  `Order_price` float DEFAULT NULL,
  `Date_of_Order` date DEFAULT NULL,
  `Date_of_Delivery` date DEFAULT NULL,
  `ordered_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Orders_FK` (`ordered_by`),
  CONSTRAINT `Orders_FK` FOREIGN KEY (`ordered_by`) REFERENCES `Users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Orders`
--

LOCK TABLES `Orders` WRITE;
/*!40000 ALTER TABLE `Orders` DISABLE KEYS */;
INSERT INTO `Orders` VALUES (19,'Harry Potter And the Philosophers Stone',18,299.85,'2022-07-09','2022-07-14',2),(27,'Son of Gold',15,299.85,'2022-07-14','2022-07-21',1),(28,'Dune Messiah',20,499.8,'2022-07-14','2022-07-22',1),(29,'Children of Dune',10,249.9,'2022-06-08','2022-07-22',1);
/*!40000 ALTER TABLE `Orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Publishers`
--

DROP TABLE IF EXISTS `Publishers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Publishers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Publishers_UN` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Publishers`
--

LOCK TABLES `Publishers` WRITE;
/*!40000 ALTER TABLE `Publishers` DISABLE KEYS */;
INSERT INTO `Publishers` VALUES (1,'Egmont'),(5,'Harper Collins'),(6,'Nova Knjiga'),(2,'Sahinpasic'),(7,'Sarajevo Publishing'),(3,'Svjetlost'),(4,'Vulkan');
/*!40000 ALTER TABLE `Publishers` ENABLE KEYS */;
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
  `Date_of_Purchase` date DEFAULT NULL,
  `Sold_By` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Purchase_FK_1` (`Sold_By`),
  KEY `Purchase_FK` (`BookID`),
  CONSTRAINT `Purchase_FK` FOREIGN KEY (`BookID`) REFERENCES `Books` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `Purchase_FK_1` FOREIGN KEY (`Sold_By`) REFERENCES `Users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Purchase`
--

LOCK TABLES `Purchase` WRITE;
/*!40000 ALTER TABLE `Purchase` DISABLE KEYS */;
INSERT INTO `Purchase` VALUES (11,61,'2022-07-11 22:16:13','2022-07-11',2),(12,61,'2022-07-11 22:16:52','2022-07-11',2),(13,61,'2022-07-11 22:18:11','2022-07-11',2),(14,61,'2022-07-11 22:18:30','2022-07-11',2),(15,61,'2022-07-11 22:19:14','2022-07-11',2),(16,61,'2022-07-11 22:19:50','2022-07-11',2),(17,61,'2022-07-12 00:20:50','2022-07-12',2),(18,61,'2022-07-12 00:25:10','2022-07-12',2),(19,4,'2022-07-12 22:54:40','2022-07-12',1),(20,4,'2022-07-12 22:55:02','2022-07-12',1),(21,4,'2022-07-12 23:00:01','2022-07-12',1),(22,4,'2022-07-12 23:01:15','2022-07-12',1),(23,17,'2022-07-12 23:11:58','2022-07-12',1),(24,88,'2022-07-12 23:49:15','2022-07-12',1),(25,61,'2022-07-13 17:23:35','2022-07-13',2),(26,4,'2022-07-13 17:25:29','2022-07-13',2);
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `Writers_UN` (`Writer_Name`,`Writer_Last_Name`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Writers`
--

LOCK TABLES `Writers` WRITE;
/*!40000 ALTER TABLE `Writers` DISABLE KEYS */;
INSERT INTO `Writers` VALUES (2,'Frank','Herbert'),(18,'Franklin','Herbert'),(19,'Franklin','Herbertson'),(12,'J.D','Salinger'),(21,'J.K','Rowling'),(22,'J.R.R','Tolkien'),(23,'Joanne K.','Rowling'),(20,'John','Herbert'),(3,'Pierce','Brown'),(1,'Stephen','King');
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

-- Dump completed on 2022-07-13 23:40:47
