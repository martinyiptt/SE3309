-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: localhost    Database: test
-- ------------------------------------------------------
-- Server version	5.7.20

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
-- Table structure for table `customeraccount`
--

DROP TABLE IF EXISTS `customeraccount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customeraccount` (
  `accountnumber` int(15) NOT NULL AUTO_INCREMENT,
  `balance` decimal(11,2) NOT NULL DEFAULT '0.00',
  `adid` int(11) DEFAULT NULL,
  `customerid` int(11) DEFAULT NULL,
  `branchnumber` int(4) DEFAULT NULL,
  PRIMARY KEY (`accountnumber`),
  KEY `adid` (`adid`),
  KEY `customerid` (`customerid`),
  KEY `branchnumber` (`branchnumber`),
  CONSTRAINT `customeraccount_ibfk_1` FOREIGN KEY (`adid`) REFERENCES `accountdescription` (`adid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `customeraccount_ibfk_2` FOREIGN KEY (`customerid`) REFERENCES `customer` (`customerid`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `customeraccount_ibfk_3` FOREIGN KEY (`branchnumber`) REFERENCES `branch` (`branchnumber`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customeraccount`
--

LOCK TABLES `customeraccount` WRITE;
/*!40000 ALTER TABLE `customeraccount` DISABLE KEYS */;
INSERT INTO `customeraccount` VALUES (1,100.00,1,1,1),(2,231.00,3,4,1),(3,412.00,2,1,1),(4,555.00,2,NULL,1),(5,2314.00,1,NULL,1),(7,314.00,2,2,2),(8,4122.00,2,2,3);
/*!40000 ALTER TABLE `customeraccount` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-06 22:09:54
