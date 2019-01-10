drop database if exists articlestore;
create database if not exists articlestore default character set utf8mb4 collate utf8mb4_unicode_ci;
use articlestore;
-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: articlestore
-- ------------------------------------------------------
-- Server version	5.5.38-0ubuntu0.14.04.1

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
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `description` text COLLATE utf8_slovenian_ci NOT NULL,
  `price` float NOT NULL,
  `activated` boolean NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES 
(1,'Gamepad Logitech F510','F510 igralni plošček podpira vse vrste iger. Priložena Logitech programska oprema omogoča uporabo ploščka tudi pri igrah, ki tega ne podpirajo. Igranje bo postalo še večji užitek zaradi dveh vgrajenih vibracijskih motorjev, domače postavitve gumbov in edinstvene oblike D-ploščka.', 40.00, true),
(2,'Pametni telefon Huawei P20 Lite moder','Telefon boste sedaj lahko odklepali s svojim obrazom, vgrajeni 4GB delovnega spomina pa omogočajo hitro uporabo in nemoteno preklapljanje med aplikacijami. Na zadnji strani je Huawei v svoji “Lite” različici P serije prvič ponudil dve kameri – 16MP in 2MP. Da bo telefon z lahkoto sledil vašemu živahnemu življenskemu stilu, bo 3000 mAh baterija s funkcijo Quick Charge napolnjena hitro in varno.', 299.99, true),
(3,'Tablični računalnik SAMSUNG GALAXY TAB S2','Uživajte še več fleksibilnosti z Galaxy Tab S2 kot kdajkoli prej. Zaradi njegovih izjemno tankih in ultra-lahkih značilnosti lahko napravo uporabljate za branje e-knjig, pregledovanje fotografij, video posnetkov in datotek, povezanih z vašim delom, kjerkoli že ste.', 479.99, true);
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `lastName` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `type` smallint NOT NULL default 2,
  `address` varchar(255) COLLATE utf8_slovenian_ci,
  `phone` varchar(100) COLLATE utf8_slovenian_ci,
  `hash` varchar(32) COLLATE utf8_slovenian_ci NOT NULL,
  `activated` boolean NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES 
(1,'Miha', 'Zahradnik', 'miha@zahradnik.si', 'mihec1', 0, '', '', '', true),
(2, 'Nika', 'Godec', 'nika@godec.si', 'niki1', 1, '', '', '', true),
(3, 'Maja', 'Lobnik', 'maja@lobnik.si', 'majci1', 2, 'Večna pot 113, 1000 Ljubljana', '040123456', '', true);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;


DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `status` smallint NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_order_user` FOREIGN KEY(`id_user`) REFERENCES `user`(`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

DROP TABLE IF EXISTS `order_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_article` (
  `id_article` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id_article`, `id_order`),
  CONSTRAINT `FK_oa_order` FOREIGN KEY(`id_order`) REFERENCES `order`(`id`),
  CONSTRAINT `FK_oa_article` FOREIGN KEY (`id_article`) REFERENCES `article`(`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-12 16:45:04
