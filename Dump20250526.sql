-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: restaurantmanagement
-- ------------------------------------------------------
-- Server version	8.0.42

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
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `city` (
  `cityID` varchar(20) NOT NULL,
  `cityName` varchar(45) NOT NULL,
  PRIMARY KEY (`cityID`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` VALUES ('CT01','Jakarta'),('CT02','Bandung'),('CT03','Surabaya'),('CT04','Yogyakarta'),('CT05','Denpasar');
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membertype`
--

DROP TABLE IF EXISTS `membertype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `membertype` (
  `memberTypeID` varchar(20) NOT NULL,
  `memberType` varchar(45) NOT NULL,
  PRIMARY KEY (`memberTypeID`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membertype`
--

LOCK TABLES `membertype` WRITE;
/*!40000 ALTER TABLE `membertype` DISABLE KEYS */;
INSERT INTO `membertype` VALUES ('MT01','Regular'),('MT02','Silver'),('MT03','Gold'),('MT04','Platinum'),('MT05','VIP');
/*!40000 ALTER TABLE `membertype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2025_05_18_075554_create_sessions_table',1),(2,'2025_05_25_061515_add_timestamps_to_msstaff_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mscustomer`
--

DROP TABLE IF EXISTS `mscustomer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mscustomer` (
  `customerID` varchar(20) NOT NULL,
  `customerName` varchar(45) NOT NULL,
  `customerAddress` varchar(100) NOT NULL,
  `memberTypeID` varchar(45) NOT NULL,
  `cityID` varchar(45) NOT NULL,
  PRIMARY KEY (`customerID`),
  KEY `cityID_idx` (`cityID`),
  KEY `memberTypeID_idx` (`memberTypeID`),
  CONSTRAINT `cityID` FOREIGN KEY (`cityID`) REFERENCES `city` (`cityID`),
  CONSTRAINT `memberTypeID` FOREIGN KEY (`memberTypeID`) REFERENCES `membertype` (`memberTypeID`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mscustomer`
--

LOCK TABLES `mscustomer` WRITE;
/*!40000 ALTER TABLE `mscustomer` DISABLE KEYS */;
INSERT INTO `mscustomer` VALUES ('CU001','Andi Setiawan','Jl. Mawar No.1','MT01','CT01'),('CU002','Budi Santoso','Jl. Melati No.2','MT02','CT02'),('CU003','Citra Dewi','Jl. Kenanga No.3','MT03','CT03'),('CU004','Dimas Ardi','Jl. Kamboja No.4','MT04','CT04'),('CU005','Eka Putri','Jl. Anggrek No.5','MT05','CT05');
/*!40000 ALTER TABLE `mscustomer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `msmenu`
--

DROP TABLE IF EXISTS `msmenu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `msmenu` (
  `menuID` varchar(20) NOT NULL,
  `menuName` varchar(45) NOT NULL,
  `menuPrice` int NOT NULL,
  `menuCalorie` varchar(45) NOT NULL,
  `menuType` varchar(45) NOT NULL,
  `menuImage` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`menuID`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `msmenu`
--

LOCK TABLES `msmenu` WRITE;
/*!40000 ALTER TABLE `msmenu` DISABLE KEYS */;
INSERT INTO `msmenu` VALUES ('M001','Croissant',20000,'100','Pastry','products/k2IDN586o7i1oDTG3kVWRbEFvqjIU01NUhOAvYoX.jpg'),('M002','Cheesecake',30000,'400','Dessert','products/bzmlgZLoEQSZfLeW1Gu5OXXPdLZsRJdpvTfoaw5H.jpg'),('M003','Nasi Goreng Ayam',25000,'500','Main Course','products/Fj3tKM7Sbux5ZAIIJqp4Z3qZU9VWUBXplYhwtorN.jpg'),('M004','Latte',15000,'100','Drinks','products/l8DUxNGsTtbNGs4gmwWLPZI1RFUDRmdTWySSRdyC.jpg'),('M005','Brownies',22000,'400','Dessert','products/O6AMluP0Ldoku8buRk6agqqRMMJyOb3dU6p85GPa.jpg'),('MN00123','Mouse',100000,'1000','Main Course','products/AW8lMbDzXdpHepwQ72iFCxBs1SKBbWqp74j6RxEF.jpg'),('MN005','Carrot Cake',25000,'200','Dessert','products/bnctdslFhsplpsJe8SQQugfwfgb5eDD9DaceEJxG.jpg'),('MN006','Nasi Seblak',20000,'1000','Main Course','products/egY9H4JTXOaS9rA4ApSrFKVZG9BFd7Ni7OfK2EV8.jpg'),('MN007','Americano',13000,'100','Drinks','products/RltDTTcCmSukErZDcFipqgvgmXVJr0C1KhJ1jzYs.jpg'),('MN008','Mouse',100000,'1000','Main Course',NULL),('MNU0001','Menu 1',61692,'400','Dessert','products/AGHb3GuIuOnnVGkSTs1S40ACHz6UYEpIG1nzgwlR.jpg'),('MNU0003','Menu 3',60478,'400','Drinks','products/VMV98pBJe6npoDu5NDGuYu9J8oAj1T84gQRkcBIc.jpg'),('MNU0004','Menu 4',69187,'970','Drinks',NULL),('MNU0005','Menu 5',26745,'522','Drinks',NULL),('MNU0006','Menu 6',67769,'878','Drinks',NULL),('MNU0007','Menu 7',23763,'602','Drinks',NULL),('MNU0008','Menu 8',54695,'627','Drinks',NULL),('MNU0009','Menu 9',34648,'400','Pastry','products/IV8FVwxhNyIfwAKP4pdtk9lyA61oImGti7TZCEob.jpg'),('MNU0010','Menu 10',37291,'300','Pastry','products/g8OjjQDzT48cSpbdEVQ8CV7MZnGh3M0uGiqZTaIq.jpg'),('MNU0011','Menu 11',45769,'374','Pastry',NULL),('MNU0012','Menu 12',86937,'750','Dessert',NULL),('MNU0013','Menu 13',79439,'610','Dessert',NULL),('MNU0014','Menu 14',13949,'115','Drinks',NULL),('MNU0015','Menu 15',14889,'692','Drinks',NULL),('MNU0016','Menu 16',24628,'887','Dessert',NULL),('MNU0017','Menu 17',85868,'892','Dessert',NULL),('MNU0018','Menu 18',42463,'888','Drinks',NULL),('MNU0019','Menu 19',20338,'932','Pastry',NULL),('MNU0020','Menu 20',12117,'992','Dessert',NULL),('MNU0022','Menu 22',53097,'537','Drinks',NULL),('MNU0025','Menu 25',68134,'622','Drinks',NULL),('MNU0026','Menu 26',19310,'806','Drinks',NULL),('MNU0027','Menu 27',20620,'187','Drinks',NULL),('MNU0028','Menu 28',15831,'212','Main Course',NULL),('MNU0029','Menu 29',40781,'310','Drinks',NULL),('MNU0030','Menu 30',10880,'120','Drinks',NULL),('MNU0031','Menu 31',18232,'121','Main Course',NULL),('MNU0032','Menu 32',94314,'277','Dessert',NULL),('MNU0033','Menu 33',16725,'291','Drinks',NULL),('MNU0034','Menu 34',87595,'320','Drinks',NULL),('MNU0035','Menu 35',56242,'772','Drinks',NULL),('MNU0036','Menu 36',99249,'853','Drinks',NULL),('MNU0037','Menu 37',99684,'436','Main Course',NULL),('MNU0038','Menu 38',37003,'892','Main Course',NULL),('MNU0039','Menu 39',33542,'306','Drinks',NULL),('MNU0040','Menu 40',20664,'823','Drinks',NULL),('MNU0041','Menu 41',98772,'435','Drinks',NULL),('MNU0042','Menu 42',58552,'865','Drinks',NULL),('MNU0043','Menu 43',33014,'149','Main Course',NULL),('MNU0044','Menu 44',95145,'653','Drinks',NULL),('MNU0045','Menu 45',36611,'746','Drinks',NULL),('MNU0046','Menu 46',17524,'890','Drinks',NULL),('MNU0047','Menu 47',36110,'583','Pastry',NULL),('MNU0048','Menu 48',85502,'924','Pastry',NULL),('MNU0049','Menu 49',61395,'712','Main Course',NULL),('MNU0050','Menu 50',35731,'197','Drinks',NULL),('MNU0051','Menu 51',41036,'726','Drinks',NULL),('MNU0052','Menu 52',55686,'460','Drinks',NULL),('MNU0053','Menu 53',95025,'908','Drinks',NULL),('MNU0054','Menu 54',65459,'352','Drinks',NULL),('MNU0056','Menu 56',11224,'455','Main Course',NULL),('MNU0057','Menu 57',62864,'625','Drinks',NULL),('MNU0058','Menu 58',77087,'170','Drinks',NULL),('MNU0059','Menu 59',95676,'829','Drinks',NULL),('MNU0060','Menu 60',99615,'742','Drinks',NULL),('MNU0061','Menu 61',31896,'288','Drinks',NULL),('MNU0062','Menu 62',18554,'461','Main Course',NULL),('MNU0063','Menu 63',25821,'447','Drinks',NULL),('MNU0064','Menu 64',31974,'542','Drinks',NULL),('MNU0065','Menu 65',32793,'350','Drinks',NULL),('MNU0066','Menu 66',37390,'945','Drinks',NULL),('MNU0067','Menu 67',97308,'113','Drinks',NULL),('MNU0068','Menu 68',31596,'674','Drinks',NULL),('MNU0069','Menu 69',87039,'736','Drinks',NULL),('MNU0070','Menu 70',35467,'873','Drinks',NULL),('MNU0071','Menu 71',37820,'292','Drinks',NULL),('MNU0072','Menu 72',88347,'484','Drinks',NULL),('MNU0073','Menu 73',43963,'670','Main Course',NULL),('MNU0074','Menu 74',16813,'327','Drinks',NULL),('MNU0075','Menu 75',62463,'765','Drinks',NULL),('MNU0076','Menu 76',83031,'416','Drinks',NULL),('MNU0077','Menu 77',40184,'612','Drinks',NULL),('MNU0078','Menu 78',29271,'897','Drinks',NULL),('MNU0079','Menu 79',98370,'325','Main Course',NULL),('MNU0080','Menu 80',65191,'233','Drinks',NULL),('MNU0081','Menu 81',82542,'321','Drinks',NULL),('MNU0082','Menu 82',21816,'238','Drinks',NULL),('MNU0083','Menu 83',31998,'967','Drinks',NULL),('MNU0084','Menu 84',68591,'104','Drinks',NULL),('MNU0085','Menu 85',81491,'230','Drinks',NULL),('MNU0086','Menu 86',61842,'947','Main Course',NULL),('MNU0087','Menu 87',46141,'671','Drinks',NULL),('MNU0088','Menu 88',75562,'693','Pastry',NULL),('MNU0089','Menu 89',35973,'874','Drinks',NULL),('MNU0090','Menu 90',51025,'476','Drinks',NULL),('MNU0091','Menu 91',94628,'911','Pastry',NULL),('MNU0092','Menu 92',96496,'505','Drinks',NULL),('MNU0093','Menu 93',30286,'884','Pastry',NULL),('MNU0094','Menu 94',78601,'171','Drinks',NULL),('MNU0095','Menu 95',68165,'132','Drinks',NULL),('MNU0096','Menu 96',29588,'729','Drinks',NULL),('MNU0097','Menu 97',31221,'729','Drinks',NULL),('MNU0098','Menu 98',90866,'179','Drinks',NULL),('MNU0099','Menu 99',85880,'788','Drinks',NULL),('MNU0100','Menu 100',13619,'811','Pastry',NULL);
/*!40000 ALTER TABLE `msmenu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `msstaff`
--

DROP TABLE IF EXISTS `msstaff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `msstaff` (
  `staffID` varchar(20) NOT NULL,
  `staffName` varchar(45) NOT NULL,
  `staffAddress` varchar(100) NOT NULL,
  `staffPositionId` varchar(20) NOT NULL,
  `staffEmail` varchar(45) NOT NULL,
  `staffPhone` varchar(20) DEFAULT NULL,
  `staffJoinDate` date DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `staffPassword` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`staffID`),
  KEY `staffPositionID_idx` (`staffPositionId`),
  KEY `idx_staff_position` (`staffPositionId`),
  CONSTRAINT `fk_staff_position` FOREIGN KEY (`staffPositionId`) REFERENCES `staffposition` (`staffPositionID`) ON DELETE RESTRICT,
  CONSTRAINT `staffPositionID` FOREIGN KEY (`staffPositionId`) REFERENCES `staffposition` (`staffPositionID`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `msstaff`
--

LOCK TABLES `msstaff` WRITE;
/*!40000 ALTER TABLE `msstaff` DISABLE KEYS */;
INSERT INTO `msstaff` VALUES ('ST001','Rina','Jl. Sawo No.1','SP01','rina@thepeeps.com',NULL,NULL,1,'$2y$12$3PjAxlahR.Zoc9UvInvyaOoV5oUWiei0NoqVAUbwXkPFPdPYrE26i',NULL,NULL),('ST002','Bayu','Jl. Durian No.2','SP02','bayu@thepeeps.com',NULL,NULL,1,'',NULL,NULL),('ST003','Sinta','Jl. Rambutan No.3','SP03','sinta@thepeeps.com',NULL,NULL,1,'',NULL,NULL),('ST004','Agus','Jl. Jeruk No.4','SP04','agus@thepeeps.com',NULL,NULL,1,'$2y$12$twOc3uVmQ5Oq.nP7JEXCK.I5DzuQKIdYwNIw03APJWI2W8dkBGxzq',NULL,NULL),('ST005','Lina','Jl. Apel No.5','SP05','lina@thepeeps.com',NULL,NULL,1,'',NULL,NULL),('ST006','Calvin','Jl. Kebon Jeruk','SP04','calvinaritama@thepeeps.com',NULL,'2025-05-25',1,'$2y$12$qtdx3WD/dGaVqL5OXZMixu1NDFWSH7eck9PauaizWkMEw4nbUdD3y','2025-05-25 07:16:07','2025-05-25 07:16:07');
/*!40000 ALTER TABLE `msstaff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment` enum('Cash','E-Wallet') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('ShopeeFood','GoFood','GrabFood') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('On Kitchen','Delivered','Completed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int NOT NULL,
  `price` bigint NOT NULL,
  PRIMARY KEY (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES ('1','Customer 1','E-Wallet','ShopeeFood','Completed',461958,100),('10','Customer 10','Cash','GoFood','Delivered',355000,105),('11','Customer 11','E-Wallet','ShopeeFood','Completed',299999,70),('12','Customer 12','Cash','GoFood','Delivered',330000,85),('14','Customer 14','Cash','ShopeeFood','Completed',520000,115),('15','Customer 15','E-Wallet','GoFood','Completed',250000,60),('16','Customer 16','Cash','GrabFood','Delivered',430000,95),('2','Customer 2','E-Wallet','ShopeeFood','Completed',461958,100),('3','Customer 3','Cash','GrabFood','On Kitchen',298500,80),('5','Customer 5','E-Wallet','ShopeeFood','Delivered',389000,90),('6','Customer 6','Cash','GoFood','Completed',315000,95),('7','Customer 7','E-Wallet','GrabFood','Completed',265000,75),('8','Customer 8','Cash','ShopeeFood','On Kitchen',410000,100),('9','Customer 9','E-Wallet','GrabFood','Completed',487000,110);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('8ooIeVBzWHT6JTF8yIMHkZfNWxF0EK3TZKQ6cayG','ST006','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTkt6ajJDaFBVUXRIa2p6UzkySEVBdmVoUTJKQWxrYkc3SktDM3I3dyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ1OiJodHRwOi8vcmVzdGF1cmFudC1tYW5hZ2VtZW50LXYuMy50ZXN0L3Byb2R1Y3QiO31zOjUyOiJsb2dpbl9zdGFmZl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtzOjU6IlNUMDA2Ijt9',1748185364),('Joro8LUTQ7VMSA4EKwyndJUw3dM7NQ4xA9swcWQC',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.20.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQUs1SWg4RTdPTk9MSzFqanNZUHNvTzY1Zm5wVUhvVU5NZEFITnM4MiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1MToiaHR0cDovL3Jlc3RhdXJhbnQtbWFuYWdlbWVudC12LjMudGVzdC8/aGVyZD1wcmV2aWV3Ijt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTE6Imh0dHA6Ly9yZXN0YXVyYW50LW1hbmFnZW1lbnQtdi4zLnRlc3QvP2hlcmQ9cHJldmlldyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1748216472),('yllVOsBJnpehpw06d2h3sQZXHCbv5xIOkjlBVIZk',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.20.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOEVFVWFVcWJHSFpXY0JqZEo0R1c1SmNNcmZpWnpuQTBDVkc2akdnSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly9yZXN0YXVyYW50LW1hbmFnZW1lbnQtdi4zLnRlc3QvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1748216473);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staffposition`
--

DROP TABLE IF EXISTS `staffposition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staffposition` (
  `staffPositionID` varchar(20) NOT NULL,
  `staffPosition` varchar(45) NOT NULL,
  PRIMARY KEY (`staffPositionID`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staffposition`
--

LOCK TABLES `staffposition` WRITE;
/*!40000 ALTER TABLE `staffposition` DISABLE KEYS */;
INSERT INTO `staffposition` VALUES ('SP01','Cashier'),('SP02','Chef'),('SP03','Waiter'),('SP04','Manager'),('SP05','Barista');
/*!40000 ALTER TABLE `staffposition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactiondetail`
--

DROP TABLE IF EXISTS `transactiondetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactiondetail` (
  `transactionID` varchar(20) NOT NULL,
  `transactionDate` date NOT NULL,
  `menuID` varchar(20) NOT NULL,
  `quantity` int NOT NULL,
  KEY `transactionID_idx` (`transactionID`),
  KEY `menuID_idx` (`menuID`),
  CONSTRAINT `menuID` FOREIGN KEY (`menuID`) REFERENCES `msmenu` (`menuID`),
  CONSTRAINT `transactionID` FOREIGN KEY (`transactionID`) REFERENCES `transactionheader` (`transactionID`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactiondetail`
--

LOCK TABLES `transactiondetail` WRITE;
/*!40000 ALTER TABLE `transactiondetail` DISABLE KEYS */;
INSERT INTO `transactiondetail` VALUES ('TR001','2025-05-18','M001',2),('TR001','2025-05-18','M004',1),('TR002','2025-05-17','M002',1),('TR003','2025-05-17','M005',3),('TR004','2025-05-16','M003',1),('TR005','2025-05-15','M001',2);
/*!40000 ALTER TABLE `transactiondetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactionheader`
--

DROP TABLE IF EXISTS `transactionheader`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactionheader` (
  `transactionID` varchar(20) NOT NULL,
  `customerID` varchar(20) NOT NULL,
  `staffID` varchar(20) NOT NULL,
  PRIMARY KEY (`transactionID`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactionheader`
--

LOCK TABLES `transactionheader` WRITE;
/*!40000 ALTER TABLE `transactionheader` DISABLE KEYS */;
INSERT INTO `transactionheader` VALUES ('TR001','CU001','ST001'),('TR002','CU002','ST002'),('TR003','CU003','ST003'),('TR004','CU004','ST004'),('TR005','CU005','ST005');
/*!40000 ALTER TABLE `transactionheader` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-26  9:48:11
