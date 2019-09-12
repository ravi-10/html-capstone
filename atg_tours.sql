-- MySQL dump 10.13  Distrib 5.7.24, for Win64 (x86_64)
--
-- Host: localhost    Database: atg_tours
-- ------------------------------------------------------
-- Server version	5.7.24

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
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogs` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_at` datetime DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `allow_comments` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`blog_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` VALUES (1,2,'Be Your Own Guide','compass.jpg','compass.jpg','Donec non diam eget nunc elementum rutrum.','2019-01-12 00:00:00',1,0,'2019-07-24 08:09:34',NULL),(2,2,'Into the Unknown','unknown.jpg','unknown.jpg','Donec non diam eget nunc elementum rutrum.','2019-02-15 00:00:00',1,0,'2019-07-24 08:09:34',NULL),(3,2,'Plan a Road Trip for Summer','roadtrip.jpg','roadtrip.jpg','Donec non diam eget nunc elementum rutrum.','2019-03-21 00:00:00',1,0,'2019-07-24 08:09:34',NULL),(4,2,'Essential Things to Experience Lava Safely','lava.jpg','lava.jpg','Donec non diam eget nunc elementum rutrum.',NULL,0,0,'2019-07-24 08:09:34',NULL),(5,2,'Beginners Tips for Camping','camping.jpg','camping.jpg','Donec non diam eget nunc elementum rutrum.','2019-04-15 00:00:00',1,0,'2019-07-24 08:09:34',NULL);
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking_line_items`
--

DROP TABLE IF EXISTS `booking_line_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booking_line_items` (
  `booking_line_items_id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `unit_price` decimal(6,2) NOT NULL,
  `quantity` int(1) NOT NULL,
  PRIMARY KEY (`booking_line_items_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_line_items`
--

LOCK TABLES `booking_line_items` WRITE;
/*!40000 ALTER TABLE `booking_line_items` DISABLE KEYS */;
INSERT INTO `booking_line_items` VALUES (1,1,15,240.20,2),(2,1,14,342.12,3),(3,2,14,342.12,3),(4,2,16,320.75,2),(5,2,19,179.99,2),(6,3,17,210.10,1),(7,3,14,342.12,3),(8,3,18,89.90,4),(9,4,15,240.20,2),(10,4,14,342.12,1),(11,5,15,240.20,1),(12,5,19,179.99,2),(13,6,2,355.50,1),(14,6,16,320.75,2);
/*!40000 ALTER TABLE `booking_line_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `customer_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `gst` decimal(6,2) NOT NULL,
  `pst` decimal(6,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (1,1,'River Osborne, Winnipeg, R3L0E6, Manitoba, Canada',1506.76,120.54,75.34,1702.64,'paid','2019-09-10 15:55:37',NULL),(2,1,'River Osborne, Winnipeg, R3L0E6, Manitoba, Canada',2027.84,162.23,101.39,2291.46,'paid','2019-09-10 16:04:08',NULL),(3,1,'River Osborne, Winnipeg, R3L0E6, Manitoba, Canada',1596.06,127.68,79.80,1803.55,'paid','2019-09-11 01:03:34',NULL),(4,1,'River Osborne, Winnipeg, R3L0E6, Manitoba, Canada',822.52,65.80,41.13,929.45,'paid','2019-09-11 01:08:12',NULL),(5,1,'River Osborne, Winnipeg, R3L0E6, Manitoba, Canada',600.18,48.01,30.01,678.20,'paid','2019-09-11 01:31:13',NULL),(6,1,'River Osborne, Winnipeg, R3L0E6, Manitoba, Canada',997.00,79.76,49.85,1126.61,'paid','2019-09-11 03:22:18',NULL);
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Solo','Sed et vehicula augue, sed malesuada massa. Curabitur tempor id purus vitae porta.','2019-07-24 06:39:46',NULL),(2,'Group','Vivamus tempor varius dolor, vel egestas tortor egestas eu. Fusce fermentum odio est, et pellentesque sem laoreet id.','2019-07-24 06:39:46',NULL),(3,'Family','Nullam consectetur, ex eu laoreet suscipit, nisl arcu tincidunt est, vitae imperdiet magna turpis eget nulla.','2019-07-24 06:39:46',NULL),(4,'Dine Around','Aliquam gravida sem dui, vitae convallis lectus convallis sit amet.','2019-07-24 06:39:46',NULL),(5,'Explore Hidden Places','Donec semper, nunc luctus venenatis ultrices, libero eros blandit nulla, ut scelerisque massa ligula id libero.','2019-07-24 06:39:46',NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faqs` (
  `faq_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`faq_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (1,1,'What payment modes are available?','Fusce fermentum odio est, et pellentesque sem laoreet id.',1,'2019-07-24 08:19:59',NULL),(2,1,'What is the refund policy?','Fusce fermentum odio est, et pellentesque sem laoreet id.',1,'2019-07-24 08:19:59',NULL),(3,1,'Is cancellation available?','Fusce fermentum odio est, et pellentesque sem laoreet id.',1,'2019-07-24 08:19:59',NULL),(4,1,'Are there any membership plans and benefits?','Fusce fermentum odio est, et pellentesque sem laoreet id.',1,'2019-07-24 08:19:59',NULL),(5,1,'Can I book after booking deadline has gone?','Fusce fermentum odio est, et pellentesque sem laoreet id.',1,'2019-07-24 08:19:59',NULL);
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itineraries`
--

DROP TABLE IF EXISTS `itineraries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itineraries` (
  `itinerary_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`itinerary_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itineraries`
--

LOCK TABLES `itineraries` WRITE;
/*!40000 ALTER TABLE `itineraries` DISABLE KEYS */;
INSERT INTO `itineraries` VALUES (1,'All Foods','Sed et vehicula augue, sed malesuada massa. Curabitur tempor id purus vitae porta.','2019-07-24 07:53:16',NULL),(2,'All Drinks','Sed et vehicula augue, sed malesuada massa. Curabitur tempor id purus vitae porta.','2019-07-24 07:53:16',NULL),(3,'Local Food Guide','Sed et vehicula augue, sed malesuada massa. Curabitur tempor id purus vitae porta.','2019-07-24 07:53:16',NULL),(4,'Local Site Seeing','Sed et vehicula augue, sed malesuada massa. Curabitur tempor id purus vitae porta.','2019-07-24 07:53:16',NULL),(5,'Bruches','Sed et vehicula augue, sed malesuada massa. Curabitur tempor id purus vitae porta.','2019-07-24 07:53:16',NULL);
/*!40000 ALTER TABLE `itineraries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itineraries_tours`
--

DROP TABLE IF EXISTS `itineraries_tours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itineraries_tours` (
  `itinerary_id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itineraries_tours`
--

LOCK TABLES `itineraries_tours` WRITE;
/*!40000 ALTER TABLE `itineraries_tours` DISABLE KEYS */;
INSERT INTO `itineraries_tours` VALUES (2,1),(5,1),(3,2),(1,4),(4,5),(5,12),(2,16),(1,19),(1,20),(2,20);
/*!40000 ALTER TABLE `itineraries_tours` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testimonials` (
  `testimonial_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`testimonial_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,2,'Super Thrilling','Corporis blanditiis provident est quas, totam vitae quo quibusdam magni esse, perspiciatis dolorum.',1,'2019-07-24 08:14:25',NULL),(2,4,'Best Return on Investments','Corporis blanditiis provident est quas, totam vitae quo quibusdam magni esse, perspiciatis dolorum.',1,'2019-07-24 08:14:25',NULL),(3,5,'Animi quam dolor vero aperiam','Corporis blanditiis provident est quas, totam vitae quo quibusdam magni esse, perspiciatis dolorum.',0,'2019-07-24 08:14:25',NULL),(4,2,'Life-long memorable Experience','Corporis blanditiis provident est quas, totam vitae quo quibusdam magni esse, perspiciatis dolorum.',1,'2019-07-24 08:14:25',NULL),(5,4,'Can not wait to board again','Corporis blanditiis provident est quas, totam vitae quo quibusdam magni esse, perspiciatis dolorum.',1,'2019-07-24 08:14:25',NULL);
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tours`
--

DROP TABLE IF EXISTS `tours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tours` (
  `tour_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `booking_ends` date NOT NULL,
  `bookings_available` int(3) NOT NULL,
  `max_allowed_bookings` int(1) NOT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`tour_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tours`
--

LOCK TABLES `tours` WRITE;
/*!40000 ALTER TABLE `tours` DISABLE KEYS */;
INSERT INTO `tours` VALUES (1,'Grand Tour of France',5,'France1.jpg','France1.jpg','Sed mattis quam sit amet ipsum dictum, vel blandit arcu pulvinar.','France','2019-10-02','2019-10-07',533.50,'2019-09-20',100,5,0,1,'2019-07-24 07:40:32',NULL),(2,'Berlin Bike Tour',2,'Germany1.jpeg','Germany1.jpeg','Sed mattis quam sit amet ipsum dictum, vel blandit arcu pulvinar.','Germany','2019-11-05','2019-11-09',355.50,'2019-10-20',100,3,1,1,'2019-07-24 07:41:54','2019-09-05 01:01:19'),(3,'Classical Spain',5,'Spain2.jpg','Spain2.jpg','Sed mattis quam sit amet ipsum dictum, vel blandit arcu pulvinar.','Spain','2019-10-07','2019-10-09',185.70,'2019-09-25',100,4,0,0,'2019-07-24 07:41:54',NULL),(4,'Boat Trip To Murano, Torcello & Burano',2,'France3.jpg','France3.jpg','Sed mattis quam sit amet ipsum dictum, vel blandit arcu pulvinar.','Italy','2019-11-09','2019-11-12',215.50,'2019-09-30',100,7,0,1,'2019-07-24 07:41:54',NULL),(5,'Eating Amsterdam, Jordaan Food Tour',4,'Netherlands1.jpg','Netherlands1.jpg','Sed mattis quam sit amet ipsum dictum, vel blandit arcu pulvinar.','Netherlands','2019-10-14','2019-10-15',99.50,'2019-10-01',100,2,0,1,'2019-07-24 07:41:54',NULL),(6,'Ibiza Beach Camp Experience',1,'Ibiza1.jpg','Ibiza1.jpg','Sed mattis quam sit amet ipsum dictum, vel blandit arcu pulvinar.','Spain','2019-12-20','2019-12-22',123.90,'2019-12-05',100,8,0,1,'2019-07-24 07:41:54',NULL),(7,'Bali Hai Sunset Dinner Cruise',4,'Bali1.jpg','Bali1.jpg','Sed mattis quam sit amet ipsum dictum, vel blandit arcu pulvinar.','Indonesia','2019-10-23','2019-10-24',79.00,'2019-10-15',100,7,0,0,'2019-07-24 07:41:54','2019-09-05 01:46:16'),(8,'La Tomatina to Ibiza',2,'Spain6.jpg','Spain6.jpg','Sed mattis quam sit amet ipsum dictum, vel blandit arcu pulvinar.','Spain','2019-10-26','2019-10-29',250.45,'2019-09-27',100,9,0,1,'2019-07-24 07:41:54',NULL),(9,'Rederij De Jordaan Private Boat Tour',3,'Italy1.jpg','Italy1.jpg','Sed mattis quam sit amet ipsum dictum, vel blandit arcu pulvinar.','Netherlands','2019-10-01','2019-10-03',150.50,'2019-09-20',100,3,0,1,'2019-07-24 07:41:54',NULL),(10,'Venice Carnival Grand Ball Gala Dinner & Show',2,'Venice1.jpg','Venice1.jpg','Sed mattis quam sit amet ipsum dictum, vel blandit arcu pulvinar.','Italy','2019-10-05','2019-10-06',100.99,'2019-09-25',100,2,0,1,'2019-07-24 07:41:54',NULL),(11,'Spanish Fiesta',3,'Spain4.jpg','Spain4.jpg','Sed mattis quam sit amet ipsum dictum, vel blandit arcu pulvinar.','Spain','2019-10-08','2019-10-10',200.00,'2019-09-28',100,5,0,1,'2019-07-24 07:41:54',NULL),(12,'Private Day Trip to Potsdam from Berlin by Train',1,'Berlin1.jpg','Berlin1.jpg','Sed mattis quam sit amet ipsum dictum, vel blandit arcu pulvinar.','Germany','2019-11-11','2019-11-15',300.00,'2019-10-01',100,4,0,1,'2019-07-24 07:41:54',NULL),(13,'The Jewels of Normandy and Paris in Comfort and Luxury',2,'France2.jpg','France2.jpg','Sed mattis quam sit amet ipsum dictum, vel blandit arcu pulvinar.','France','2019-11-15','2019-11-18',267.50,'2019-11-02',100,6,0,0,'2019-07-24 07:41:54',NULL),(14,'Private Exploring East Coast Bali Tour',3,'Indonesia1.jpg','Indonesia1.jpg','Sed mattis quam sit amet ipsum dictum, vel blandit arcu pulvinar.','Indonesia','2019-11-20','2019-11-23',342.12,'2019-10-12',100,3,0,1,'2019-07-24 07:41:54',NULL),(15,'Spring Break Ibiza',3,'Spain5.jpg','Spain5.jpg','Sed mattis quam sit amet ipsum dictum, vel blandit arcu pulvinar.','Spain','2019-09-22','2019-09-25',240.20,'2019-09-16',100,2,0,1,'2019-07-24 07:41:54',NULL),(16,'Black Heritage Tour of Amsterdam',5,'Amsterdam1.jpg','Amsterdam1.jpg','Sed mattis quam sit amet ipsum dictum, vel blandit arcu pulvinar.','Netherlands','2019-09-26','2019-09-30',320.75,'2019-09-18',100,3,0,1,'2019-07-24 07:41:54',NULL),(17,'The Mysterious Venice Walking Tour',5,'Italy3.jpg','Italy3.jpg','Sed mattis quam sit amet ipsum dictum, vel blandit arcu pulvinar.','Italy','2019-10-02','2019-10-05',210.10,'2019-09-25',100,1,0,1,'2019-07-24 07:41:54',NULL),(18,'Madrid and Barcelona',2,'Spain3.jpg','Spain3.jpg','Sed mattis quam sit amet ipsum dictum, vel blandit arcu pulvinar.','Spain','2019-10-07','2019-10-07',89.90,'2019-10-01',100,6,0,1,'2019-07-24 07:41:54',NULL),(19,'Capital Dinner Cruise at Sunset with Sightseeing of Berlin',4,'Italy2.jpg','Italy2.jpg','Sed mattis quam sit amet ipsum dictum, vel blandit arcu pulvinar.','Germany','2019-10-09','2019-10-10',179.99,'2019-10-02',100,2,0,1,'2019-07-24 07:41:54',NULL),(20,'In Love with Paris',3,'France4.jpeg','France4.jpeg','Sed mattis quam sit amet ipsum dictum, vel blandit arcu pulvinar.','France','2019-10-10','2019-10-12',150.00,'2019-10-02',100,2,0,1,'2019-07-24 07:41:54',NULL),(21,'My tour',1,'Canada1.jpg','Canada1.jpg','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.','Canada','2019-10-15','2019-10-21',450.00,'2019-10-02',100,5,0,0,'2019-08-26 15:44:45',NULL);
/*!40000 ALTER TABLE `tours` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','blogger','customer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Ravi','Patel','River Osborne','Winnipeg','R3L0E6','Manitoba','Canada','2043333111','patel.ravi04@gmail.com','$2y$10$MPPBgbAXyPDSJgHsECXI/u1/JKcKPHScXjAqBCXLpalloRxxF4DKm','admin','2019-08-23 02:11:17',NULL),(2,'Ravi','Patel','River Osborne','Winnipeg','R3L0E6','Manitoba','Canada','2043333111','patel.ravi04_z@gmail.com','$2y$10$tt27/idwqMW.uVwQONCcMu.HfAW1cmQ./Qq8ZXRPlyABnezVIQYFS','customer','2019-08-23 02:14:58',NULL),(3,'Ravi','Patel','River Osborne','Winnipeg','R3L0E6','Manitoba','Canada','2043333111','patel.ravi04_zz@gmail.com','$2y$10$BXOpZL/ei69o8z08dklDMulAjAnxdZ4B1dvftzq6pCltcydnwG/zi','customer','2019-08-23 03:31:20',NULL),(4,'Katie','Peters','45 new road','winnipeg','r5n1k9','manitoba','canada','2041234567','kpeters@hotmail.com','$2y$10$wR5AL9wn39UPWZ0h18iu.OgsVY3GxXXwI1Z0SCanE.cQuTTwJw0RW','customer','2019-09-09 09:58:42',NULL),(5,'Ravi','Patel','River Osborne','Winnipeg','R3L0E6','Manitoba','Canada','2043333111','patel.ravi0444@gmail.com','$2y$10$O5B9WUy58CwPUTzcZoKZZO.c5RmlNa0xi.kaqkDbmzf3eTQ7Z0RR6','customer','2019-09-11 01:23:53',NULL);
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

-- Dump completed on 2019-09-11  3:49:24
