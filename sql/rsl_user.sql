CREATE DATABASE  IF NOT EXISTS `rsl` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `rsl`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: rsl
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.13-MariaDB

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
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` varchar(48) NOT NULL,
  `username` varchar(24) NOT NULL,
  `password` char(24) NOT NULL,
  `nickname` char(24) NOT NULL,
  `phone` char(11) NOT NULL,
  `sex` tinyint(4) NOT NULL DEFAULT '-1',
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `verify` tinyint(4) NOT NULL DEFAULT '-1',
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `no` char(24) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('1','admin','admin','admin','18777552223',1,0,1,'2017-04-18 06:07:34','1'),('29c84426daefc16e8a980ded41edcfbba91ff785','test','123456','','',-1,2,-1,'2017-04-18 15:53:15',''),('86c741fe68ef62f83dd90d33fc41efa4ecf12c69','tom','123456','','',-1,1,1,'2017-04-19 03:31:26',''),('95c97e1ea2feaa33fca55a09abedc3c6eed89aac','123','123456','','',-1,2,-1,'2017-04-19 13:19:02',''),('ed22fa9bf380a63e424ee16dc8f6dccfb8f2a0fa','sandy','123456','','',-1,1,-1,'2017-04-19 03:37:55','');
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

-- Dump completed on 2017-04-21 10:00:08
