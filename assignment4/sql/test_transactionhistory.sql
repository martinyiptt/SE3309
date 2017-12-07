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
-- Table structure for table `transactionhistory`
--

DROP TABLE IF EXISTS `transactionhistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactionhistory` (
  `transactionid` int(11) NOT NULL AUTO_INCREMENT,
  `transactiondate` date NOT NULL,
  `netchange` decimal(9,2) NOT NULL,
  `accountnumber` int(15) DEFAULT NULL,
  `transactiontypeid` int(11) DEFAULT NULL,
  PRIMARY KEY (`transactionid`),
  KEY `accountnumber` (`accountnumber`),
  KEY `transactiontypeid` (`transactiontypeid`),
  CONSTRAINT `transactionhistory_ibfk_1` FOREIGN KEY (`accountnumber`) REFERENCES `customeraccount` (`accountnumber`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transactionhistory_ibfk_2` FOREIGN KEY (`transactiontypeid`) REFERENCES `transactiontype` (`transactiontypeid`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactionhistory`
--

LOCK TABLES `transactionhistory` WRITE;
/*!40000 ALTER TABLE `transactionhistory` DISABLE KEYS */;
INSERT INTO `transactionhistory` VALUES (1,'2016-11-11',12.00,1,1),(4,'2016-11-13',19.00,3,2),(5,'2012-12-01',54.00,2,2),(6,'2012-12-01',54.00,2,1),(7,'2016-11-15',51.00,3,1),(9,'2016-11-11',41.00,4,2),(12,'2016-11-22',14.00,4,1),(17,'2016-11-13',42.00,1,3),(18,'2016-11-15',31.00,3,1),(19,'2011-11-01',2414.00,1,2);
/*!40000 ALTER TABLE `transactionhistory` ENABLE KEYS */;
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
