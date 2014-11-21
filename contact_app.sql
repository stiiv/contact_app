-- MySQL dump 10.13  Distrib 5.5.40, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: contact_app
-- ------------------------------------------------------
-- Server version	5.5.40-0ubuntu0.14.04.1

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
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT '1',
  `ime` varchar(20) NOT NULL,
  `prezime` varchar(32) DEFAULT NULL,
  `mob1` varchar(10) DEFAULT NULL,
  `mob2` varchar(10) DEFAULT NULL,
  `kucni` varchar(10) DEFAULT NULL,
  `posao` varchar(10) DEFAULT NULL,
  `slika` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `opis` text,
  `id_grad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (13,2,'Lima','','095333444','','','','default.jpg',' Some kid from the block',37),(14,4,'Mrki','','','','016553985','','default.jpg','Prijatelj iz osnovne škole.',75),(24,1,'Mare Zg','','1351546546','','','','default.jpg','                                                                                                                                                            ',37),(25,1,'Maša','Mrkić','','','1656161','','default.jpg','                                                                                                        ',NULL),(27,1,'Mrki','','1635465416','','','','default.jpg','',43),(35,1,'Hrco P','','26265454','','','','28.03.2009.piranha25.jpg','                                                        OŠ SAVSKI GAJ                                                                   ',NULL),(36,1,'Nina','','','','1635465465','','default.jpg','',37),(37,1,'Gringo','','','032569877','','','default.jpg','                                                                                                                                                                                                                ',64),(38,1,'Grga Ana','','','','0246546468','','28.03.2009.piranha23.jpg','                                                    ',8);
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gradovi`
--

DROP TABLE IF EXISTS `gradovi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gradovi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zip` char(5) NOT NULL,
  `ime` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gradovi`
--

LOCK TABLES `gradovi` WRITE;
/*!40000 ALTER TABLE `gradovi` DISABLE KEYS */;
INSERT INTO `gradovi` VALUES (1,'10000','Zagreb'),(2,'10290','Zaprešić'),(3,'10310','Ivanić Grad'),(4,'10340','Vrbovec'),(5,'10370','Dugo Selo'),(6,'10380','Sveti Ivan Zelina'),(7,'10410','Velika Gorica'),(8,'10430','Samobor'),(9,'10431','Sveta Nedelja'),(10,'10450','Jastrebarsko'),(11,'20000','Dubrovnik'),(12,'20260','Korčula'),(13,'20340','Ploče'),(14,'20350','Metković'),(15,'20355','Opuzen'),(16,'21000','Split'),(17,'21210','Solin'),(18,'21220','Trogir'),(19,'21230','Sinj'),(20,'21236','Vrlika'),(21,'21240','Trilj'),(22,'21260','Imotski'),(23,'21276','Vrgorac'),(24,'21300','Makarska'),(25,'21310','Omiš'),(26,'21400','Supetar'),(27,'21450','Hvar'),(28,'21460','Stari Grad'),(29,'21480','Vis'),(30,'21485','Komiža'),(31,'22000','Šibenik'),(32,'22211','Vodice'),(33,'22222','Skradin'),(34,'22300','Knin'),(35,'22320','Drniš'),(36,'23000','Zadar'),(37,'23210','Biograd na Moru'),(38,'23232','Nin'),(39,'23250','Pag'),(40,'23420','Benkovac'),(41,'23450','Obrovac'),(42,'31000','Osijek'),(43,'31300','Beli Manastir'),(44,'31400','Đakovo'),(45,'31500','Našice'),(46,'31540','Donji Miholjac'),(47,'31550','Valpovo'),(48,'31551','Belišće'),(49,'32000','Vukovar'),(50,'32100','Vinkovci'),(51,'32236','Ilok'),(52,'32252','Otok'),(53,'32270','Županja'),(54,'33000','Virovitica'),(55,'33515','Orahovica'),(56,'33520','Slatina'),(57,'34000','Požega'),(58,'34310','Pleternica'),(59,'34340','Kutjevo'),(60,'34550','Pakrac'),(61,'34551','Lipik'),(62,'35000','Slavonski Brod'),(63,'35400','Nova Gradiška'),(64,'40000','Čakovec'),(65,'40315','Mursko Središće'),(66,'40323','Prelog'),(67,'42000','Varaždin'),(68,'42220','Novi Marof'),(69,'42223','Varaždinske Toplice'),(70,'42230','Ludbreg'),(71,'42240','Ivanec'),(72,'42250','Lepoglava'),(73,'43000','Bjelovar'),(74,'43240','Čazma'),(75,'43280','Garešnica'),(76,'43290','Grubišno Polje'),(77,'43500','Daruvar'),(78,'44000','Sisak'),(79,'44250','Petrinja'),(80,'44320','Kutina'),(81,'44330','Novska'),(82,'44400','Glina'),(83,'44430','Hrvatska Kostajnica'),(84,'47000','Karlovac'),(85,'47240','Slunj'),(86,'47250','Duga Resa'),(87,'47280','Ozalj'),(88,'47300','Ogulin'),(89,'48000','Koprivnica'),(90,'48260','Križevci'),(91,'48350','&#272;ur&#273;evac'),(92,'49000','Krapina'),(93,'49210','Zabok'),(94,'49218','Pregrada'),(95,'49240','Donja Stubica'),(96,'49243','Oroslavje'),(97,'49250','Zlatar'),(98,'49290','Klanjec'),(99,'51000','Rijeka'),(100,'51215','Kastav'),(101,'51222','Bakar'),(102,'51250','Novi Vinodolski'),(103,'51260','Crikvenica'),(104,'51262','Kraljevica'),(105,'51280','Rab'),(106,'51300','Delnice'),(107,'51306','Čabar'),(108,'51326','Vrbovsko'),(109,'51410','Opatija'),(110,'51500','Krk'),(111,'51550','Mali Lošinj'),(112,'51557','Cres'),(113,'52000','Pazin'),(114,'52100','Pula'),(115,'52210','Rovinj'),(116,'52215','Vodnjan'),(117,'52220','Labin'),(118,'52420','Buzet'),(119,'52440','Poreč'),(120,'52460','Buje'),(121,'52466','Novigrad'),(122,'52470','Umag'),(123,'53000','Gospić'),(124,'53220','Otočac'),(125,'53270','Senj'),(126,'53291','Novalja');
/*!40000 ALTER TABLE `gradovi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'stiiv85','$2y$10$dhwBY66XvPbkQ52sgUfu6edE6053FKESiuOree0/JlhGg.EshvrJu','Ivan','Stipić Stiiv','ivan.stipic6@gmail.com'),(2,'kstipic','$2y$10$IC3aEDcZXkuE7vGz91u05OJyO897p6XQjpl.WiutJp2rSR9TjTEba','Krešo','Stipić','kstipic@gmail.com'),(3,'mate95','$2y$10$csNC/lXJMMu5MeSTb1h0hO3pfzSDb2gBdB.HWIbLTReegpxPTEbq6','Mate','Granić','mate95@hotmail.com'),(4,'domsi94','$2y$10$uLdRqXTtczs6suzFJ8n9nuLAhzwjoxU.ulWBhCEiSdo4Vh48uaYdS','Domagoj','Stipić','dstipic@gmail.com'),(5,'mario35','$2y$10$PHQ.WnVpq2uEOiNsyePjb.QRLdz.0aX9e84WYZ/mdhhAx2dXFHLMG','Mario','Pekmezić','mario.pek@domain.com');
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

-- Dump completed on 2014-11-07 14:48:46
