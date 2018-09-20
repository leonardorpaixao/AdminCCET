-- MySQL dump 10.16  Distrib 10.1.14-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: prodap
-- ------------------------------------------------------
-- Server version	10.1.14-MariaDB

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
-- Table structure for table `tbafiliacao`
--

DROP TABLE IF EXISTS `tbafiliacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbafiliacao` (
  `idAfiliacao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `afiliacao` varchar(64) NOT NULL,
  `nivel` smallint(6) NOT NULL,
  PRIMARY KEY (`idAfiliacao`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbafiliacao`
--

LOCK TABLES `tbafiliacao` WRITE;
/*!40000 ALTER TABLE `tbafiliacao` DISABLE KEYS */;
INSERT INTO `tbafiliacao` VALUES (1,'Professor',3),(2,'Ciência da Computação',4),(3,'Engenharia da Computação',4),(4,'Sistemas de Informação',4),(5,'Secretária',1),(6,'Técnico',0),(7,'teste dkgjdf',4),(8,'teste afiliacao',4);
/*!40000 ALTER TABLE `tbafiliacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbalocalab`
--

DROP TABLE IF EXISTS `tbalocalab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbalocalab` (
  `idLab` int(10) unsigned NOT NULL,
  `patrimonio` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idLab`,`patrimonio`),
  KEY `patrimonio` (`patrimonio`),
  CONSTRAINT `tbalocalab_ibfk_1` FOREIGN KEY (`idLab`) REFERENCES `tblaboratorio` (`idLab`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbalocalab_ibfk_2` FOREIGN KEY (`patrimonio`) REFERENCES `tbequipamento` (`patrimonio`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbalocalab`
--

LOCK TABLES `tbalocalab` WRITE;
/*!40000 ALTER TABLE `tbalocalab` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbalocalab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbalocareeq`
--

DROP TABLE IF EXISTS `tbalocareeq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbalocareeq` (
  `patrimonio` int(10) unsigned NOT NULL,
  `idReEq` int(10) unsigned NOT NULL,
  `idData` int(10) unsigned NOT NULL,
  PRIMARY KEY (`patrimonio`,`idReEq`,`idData`),
  KEY `idReEq` (`idReEq`),
  KEY `idData` (`idData`),
  CONSTRAINT `tbalocareeq_ibfk_1` FOREIGN KEY (`patrimonio`) REFERENCES `tbequipamento` (`patrimonio`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbalocareeq_ibfk_2` FOREIGN KEY (`idReEq`) REFERENCES `tbcontroledataeq` (`idReEq`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbalocareeq_ibfk_3` FOREIGN KEY (`idData`) REFERENCES `tbcontroledataeq` (`idData`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbalocareeq`
--

LOCK TABLES `tbalocareeq` WRITE;
/*!40000 ALTER TABLE `tbalocareeq` DISABLE KEYS */;
INSERT INTO `tbalocareeq` VALUES (241235435,42,139);
/*!40000 ALTER TABLE `tbalocareeq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbalocarelab`
--

DROP TABLE IF EXISTS `tbalocarelab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbalocarelab` (
  `idLab` int(10) unsigned NOT NULL,
  `idReLab` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idLab`,`idReLab`),
  KEY `idReLab` (`idReLab`),
  CONSTRAINT `tbalocarelab_ibfk_1` FOREIGN KEY (`idLab`) REFERENCES `tblaboratorio` (`idLab`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbalocarelab_ibfk_2` FOREIGN KEY (`idReLab`) REFERENCES `tbreservalab` (`idReLab`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbalocarelab`
--

LOCK TABLES `tbalocarelab` WRITE;
/*!40000 ALTER TABLE `tbalocarelab` DISABLE KEYS */;
INSERT INTO `tbalocarelab` VALUES (1,1),(1,2),(1,3),(1,26),(1,28),(1,30),(1,31),(1,39),(1,40),(1,41),(1,42),(1,43),(2,26),(2,28);
/*!40000 ALTER TABLE `tbalocarelab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbavisos`
--

DROP TABLE IF EXISTS `tbavisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbavisos` (
  `idAviso` int(11) NOT NULL AUTO_INCREMENT,
  `tituloAviso` varchar(50) NOT NULL,
  `textoAviso` text NOT NULL,
  `dataAviso` date NOT NULL,
  `statusAviso` enum('Ativo','Inativo') NOT NULL DEFAULT 'Ativo',
  PRIMARY KEY (`idAviso`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbavisos`
--

LOCK TABLES `tbavisos` WRITE;
/*!40000 ALTER TABLE `tbavisos` DISABLE KEYS */;
INSERT INTO `tbavisos` VALUES (1,'Fale com o DCOMP','&lt;p&gt;&lt;b&gt;Telefone&lt;/b&gt;&lt;br&gt;+55 79 2105-6678&lt;/p&gt;&lt;p&gt;&lt;b&gt;E-mail&lt;/b&gt;&lt;br&gt;dcomp.sec@ufs.br&lt;/p&gt;&lt;p&gt;&lt;b&gt;Nova Sede&lt;/b&gt;&lt;br&gt;Anexa ao Centro de Vivência da UFS.&lt;/p&gt;&lt;p&gt;&lt;b&gt;Antiga Sede&lt;/b&gt;&lt;br&gt;Ao lado do Departamento de Engenharia Civil.&lt;/p&gt;','2015-09-25','Ativo');
/*!40000 ALTER TABLE `tbavisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbblock`
--

DROP TABLE IF EXISTS `tbblock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbblock` (
  `idBlock` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idUserBlock` int(10) unsigned NOT NULL,
  `idUser` int(10) unsigned DEFAULT NULL,
  `motivoBlock` text NOT NULL,
  `dataInicio` date NOT NULL,
  `dataFim` date NOT NULL,
  PRIMARY KEY (`idBlock`),
  KEY `idUserBlock` (`idUserBlock`),
  KEY `idUser` (`idUser`),
  CONSTRAINT `tbblock_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `tbblock_ibfk_2` FOREIGN KEY (`idUserBlock`) REFERENCES `tbusuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbblock`
--

LOCK TABLES `tbblock` WRITE;
/*!40000 ALTER TABLE `tbblock` DISABLE KEYS */;
INSERT INTO `tbblock` VALUES (1,1,10,'fgnskdlgns sfkagnfdlkgnfsd fkgnksfdlng gnfdlksg lkfmsdg fkgntkdfgnfsdçlf gfkds onk fgnskdlgns sfkagnfdlkgnfsd fkgnksfdlng gnfdlksg lkfmsdg fkgntkdfgnfsdçlf gfkds onk','2015-10-13','2015-10-15'),(2,4,10,'teste ngkfefsd fgdfsgfgfagagfsv','2015-12-11','2015-12-13'),(3,4,10,'ghndfhgfh','2015-12-11','2015-12-13');
/*!40000 ALTER TABLE `tbblock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbchoqueeq`
--

DROP TABLE IF EXISTS `tbchoqueeq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbchoqueeq` (
  `idReEq` int(10) unsigned NOT NULL,
  `idData` int(10) unsigned NOT NULL,
  `idChoqueReEq` int(10) unsigned NOT NULL,
  `idChoqueData` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idReEq`,`idData`,`idChoqueReEq`,`idChoqueData`),
  KEY `idData` (`idData`),
  KEY `idChoqueReEq` (`idChoqueReEq`),
  KEY `idChoqueData` (`idChoqueData`),
  CONSTRAINT `tbchoqueeq_ibfk_1` FOREIGN KEY (`idReEq`, `idData`) REFERENCES `tbcontroledataeq` (`idReEq`, `idData`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbchoqueeq_ibfk_2` FOREIGN KEY (`idReEq`) REFERENCES `tbreservaeq` (`idReEq`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbchoqueeq_ibfk_3` FOREIGN KEY (`idData`) REFERENCES `tbdata` (`idData`),
  CONSTRAINT `tbchoqueeq_ibfk_4` FOREIGN KEY (`idChoqueReEq`) REFERENCES `tbreservaeq` (`idReEq`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbchoqueeq_ibfk_5` FOREIGN KEY (`idChoqueData`) REFERENCES `tbdata` (`idData`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbchoqueeq`
--

LOCK TABLES `tbchoqueeq` WRITE;
/*!40000 ALTER TABLE `tbchoqueeq` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbchoqueeq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbchoquelab`
--

DROP TABLE IF EXISTS `tbchoquelab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbchoquelab` (
  `idReLab` int(10) unsigned NOT NULL,
  `idData` int(10) unsigned NOT NULL,
  `idChoqueReLab` int(10) unsigned NOT NULL,
  `idChoqueData` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idReLab`,`idData`,`idChoqueReLab`,`idChoqueData`),
  KEY `tbchoquelab_ibfk_2` (`idData`),
  KEY `tbchoquelab_ibfk_3` (`idChoqueReLab`),
  KEY `tbchoquelab_ibfk_4` (`idChoqueData`),
  CONSTRAINT `tbchoquelab_ibfk_1` FOREIGN KEY (`idReLab`) REFERENCES `tbcontroledatalab` (`idReLab`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbchoquelab_ibfk_2` FOREIGN KEY (`idData`) REFERENCES `tbcontroledatalab` (`idData`),
  CONSTRAINT `tbchoquelab_ibfk_3` FOREIGN KEY (`idChoqueReLab`) REFERENCES `tbcontroledatalab` (`idReLab`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbchoquelab_ibfk_4` FOREIGN KEY (`idChoqueData`) REFERENCES `tbcontroledatalab` (`idData`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbchoquelab`
--

LOCK TABLES `tbchoquelab` WRITE;
/*!40000 ALTER TABLE `tbchoquelab` DISABLE KEYS */;
INSERT INTO `tbchoquelab` VALUES (43,109,17,109),(43,109,31,109),(43,109,40,109),(43,109,41,109),(43,109,42,109);
/*!40000 ALTER TABLE `tbchoquelab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbchoquesala`
--

DROP TABLE IF EXISTS `tbchoquesala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbchoquesala` (
  `idReSala` int(10) unsigned NOT NULL,
  `idData` int(10) unsigned NOT NULL,
  `idChoqueReSala` int(10) unsigned NOT NULL,
  `idChoqueData` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idReSala`,`idData`,`idChoqueReSala`,`idChoqueData`),
  KEY `idData` (`idData`),
  KEY `idChoqueSala` (`idChoqueReSala`),
  KEY `idChoqueData` (`idChoqueData`),
  CONSTRAINT `tbchoquesala_ibfk_1` FOREIGN KEY (`idReSala`) REFERENCES `tbreservasala` (`idReSala`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbchoquesala_ibfk_2` FOREIGN KEY (`idData`) REFERENCES `tbdata` (`idData`),
  CONSTRAINT `tbchoquesala_ibfk_4` FOREIGN KEY (`idChoqueData`) REFERENCES `tbdata` (`idData`),
  CONSTRAINT `tbchoquesala_ibfk_5` FOREIGN KEY (`idChoqueReSala`) REFERENCES `tbreservasala` (`idReSala`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbchoquesala`
--

LOCK TABLES `tbchoquesala` WRITE;
/*!40000 ALTER TABLE `tbchoquesala` DISABLE KEYS */;
INSERT INTO `tbchoquesala` VALUES (2,136,1,136);
/*!40000 ALTER TABLE `tbchoquesala` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbcontroledataeq`
--

DROP TABLE IF EXISTS `tbcontroledataeq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbcontroledataeq` (
  `idReEq` int(10) unsigned NOT NULL,
  `idData` int(10) unsigned NOT NULL,
  `statusData` enum('Pendente','Aprovado','Entregue','Recebido','Expirado','Cancelado','Negado') NOT NULL,
  `justificativa` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idReEq`,`idData`),
  KEY `idData` (`idData`),
  CONSTRAINT `tbcontroledataeq_ibfk_1` FOREIGN KEY (`idReEq`) REFERENCES `tbreservaeq` (`idReEq`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbcontroledataeq_ibfk_2` FOREIGN KEY (`idData`) REFERENCES `tbdata` (`idData`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbcontroledataeq`
--

LOCK TABLES `tbcontroledataeq` WRITE;
/*!40000 ALTER TABLE `tbcontroledataeq` DISABLE KEYS */;
INSERT INTO `tbcontroledataeq` VALUES (1,7,'Expirado',NULL),(2,8,'Expirado',NULL),(3,9,'Expirado',NULL),(4,10,'Expirado',NULL),(5,8,'Expirado',NULL),(7,15,'Expirado',NULL),(8,17,'Expirado',NULL),(9,17,'Expirado',NULL),(10,18,'Expirado',NULL),(11,19,'Expirado',NULL),(12,19,'Expirado',NULL),(13,19,'Expirado',NULL),(14,19,'Expirado',NULL),(15,19,'Expirado',NULL),(16,19,'Expirado',NULL),(18,50,'Expirado',NULL),(19,51,'Expirado',NULL),(20,52,'Expirado',NULL),(21,53,'Expirado',NULL),(22,55,'Negado','hgfhdfhfd'),(23,56,'Negado','fsgfsgfdsg'),(24,57,'Expirado',NULL),(25,58,'Expirado',NULL),(26,58,'Negado','dhfdhgdhfdh'),(27,59,'Negado',NULL),(28,59,'Negado','gdfsgfdgdfg'),(29,60,'Negado','fdhvhdvhvc'),(30,60,'Expirado',NULL),(31,58,'Negado','fbfdbvzbfg'),(32,58,'Negado','fhgfdgfdsgd'),(33,70,'Expirado',NULL),(33,71,'Expirado',NULL),(34,72,'Expirado',NULL),(34,73,'Expirado',NULL),(35,72,'Expirado',NULL),(35,73,'Expirado',NULL),(36,74,'Expirado',NULL),(36,75,'Expirado',NULL),(36,76,'Expirado',NULL),(36,77,'Expirado',NULL),(36,78,'Expirado',NULL),(36,79,'Aprovado',NULL),(36,80,'Aprovado',NULL),(36,81,'Aprovado',NULL),(36,82,'Aprovado',NULL),(37,83,'Expirado',NULL),(37,84,'Expirado',NULL),(37,85,'Expirado',NULL),(37,86,'Expirado',NULL),(37,87,'Expirado',NULL),(37,88,'Aprovado',NULL),(37,89,'Aprovado',NULL),(38,133,'Cancelado',''),(39,134,'Entregue',NULL),(40,135,'Entregue',NULL),(41,138,'Aprovado',NULL),(42,139,'Entregue',NULL),(43,148,'Aprovado',NULL),(45,148,'Cancelado','rgvdfsf');
/*!40000 ALTER TABLE `tbcontroledataeq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbcontroledatalab`
--

DROP TABLE IF EXISTS `tbcontroledatalab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbcontroledatalab` (
  `idReLab` int(10) unsigned NOT NULL,
  `idData` int(10) unsigned NOT NULL,
  `idLab` int(10) unsigned NOT NULL DEFAULT '0',
  `statusData` enum('Pendente','Aprovado','Entregue','Recebido','Expirado','Cancelado','Negado') NOT NULL,
  `justificativa` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idReLab`,`idData`,`idLab`),
  KEY `idData` (`idData`),
  KEY `idLab` (`idLab`),
  CONSTRAINT `tbcontroledatalab_ibfk_1` FOREIGN KEY (`idReLab`) REFERENCES `tbreservalab` (`idReLab`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbcontroledatalab_ibfk_2` FOREIGN KEY (`idData`) REFERENCES `tbdata` (`idData`),
  CONSTRAINT `tbcontroledatalab_ibfk_3` FOREIGN KEY (`idLab`) REFERENCES `tblaboratorio` (`idLab`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbcontroledatalab`
--

LOCK TABLES `tbcontroledatalab` WRITE;
/*!40000 ALTER TABLE `tbcontroledatalab` DISABLE KEYS */;
INSERT INTO `tbcontroledatalab` VALUES (1,6,1,'Expirado',NULL),(2,8,1,'Expirado',NULL),(3,8,1,'Expirado',NULL),(11,62,1,'Expirado',NULL),(12,63,1,'Expirado',NULL),(13,64,1,'Expirado',NULL),(14,65,1,'Expirado',NULL),(15,66,1,'Expirado',NULL),(15,67,1,'Expirado',NULL),(15,68,1,'Expirado',NULL),(15,69,1,'Expirado',NULL),(16,90,1,'Expirado',NULL),(16,91,1,'Expirado',NULL),(16,92,1,'Expirado',NULL),(16,93,1,'Expirado',NULL),(16,94,1,'Expirado',NULL),(17,77,1,'Expirado',NULL),(17,79,1,'Aprovado',NULL),(17,81,1,'Aprovado',NULL),(17,95,1,'Expirado',NULL),(17,96,1,'Expirado',NULL),(17,97,1,'Expirado',NULL),(17,98,1,'Aprovado',NULL),(17,99,1,'Aprovado',NULL),(17,100,1,'Aprovado',NULL),(17,101,1,'Aprovado',NULL),(17,102,1,'Aprovado',NULL),(17,103,1,'Aprovado',NULL),(17,104,1,'Aprovado',NULL),(17,105,1,'Aprovado',NULL),(17,106,1,'Aprovado',NULL),(17,107,1,'Aprovado',NULL),(17,108,1,'Aprovado',NULL),(17,109,1,'Aprovado',NULL),(17,110,1,'Aprovado',NULL),(17,111,1,'Aprovado',NULL),(18,80,1,'Pendente',NULL),(19,108,1,'Negado','tenkffxf'),(20,140,1,'Aprovado',NULL),(21,140,1,'Aprovado',NULL),(22,140,1,'Aprovado',NULL),(23,141,1,'Aprovado',NULL),(24,142,1,'Pendente',NULL),(25,143,1,'Pendente',NULL),(26,143,1,'Aprovado',NULL),(28,143,1,'Entregue',NULL),(29,144,1,'Cancelado','teste 23'),(29,145,1,'Cancelado','teste 23'),(29,146,1,'Cancelado','teste 23'),(29,147,1,'Cancelado','teste 23'),(30,108,1,'Pendente',NULL),(31,109,1,'Pendente',NULL),(40,109,1,'Pendente',NULL),(41,109,1,'Pendente',NULL),(42,109,1,'Pendente',NULL),(43,109,1,'Pendente',NULL);
/*!40000 ALTER TABLE `tbcontroledatalab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbcontroledatasala`
--

DROP TABLE IF EXISTS `tbcontroledatasala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbcontroledatasala` (
  `idReSala` int(10) unsigned NOT NULL,
  `idData` int(10) unsigned NOT NULL,
  `statusData` enum('Pendente','Aprovado','Entregue','Recebido','Expirado','Cancelado','Negado') NOT NULL,
  `justificativa` varchar(50) NOT NULL,
  PRIMARY KEY (`idReSala`,`idData`),
  KEY `idData` (`idData`),
  CONSTRAINT `tbcontroledatasala_ibfk_1` FOREIGN KEY (`idReSala`) REFERENCES `tbreservasala` (`idReSala`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbcontroledatasala_ibfk_2` FOREIGN KEY (`idData`) REFERENCES `tbdata` (`idData`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbcontroledatasala`
--

LOCK TABLES `tbcontroledatasala` WRITE;
/*!40000 ALTER TABLE `tbcontroledatasala` DISABLE KEYS */;
INSERT INTO `tbcontroledatasala` VALUES (1,136,'Pendente',''),(2,136,'Pendente',''),(3,153,'Pendente',''),(4,154,'Aprovado',''),(5,154,'Aprovado','');
/*!40000 ALTER TABLE `tbcontroledatasala` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbcor`
--

DROP TABLE IF EXISTS `tbcor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbcor` (
  `idCor` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cor` varchar(7) NOT NULL,
  PRIMARY KEY (`idCor`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbcor`
--

LOCK TABLES `tbcor` WRITE;
/*!40000 ALTER TABLE `tbcor` DISABLE KEYS */;
INSERT INTO `tbcor` VALUES (1,'#3498DB'),(2,'#E67E22'),(3,'#1ABC9C'),(4,'#9B59B6'),(5,'#FF0000'),(6,'#60FF00'),(7,'#0400FF'),(8,'#FF00EB'),(9,'#26FF00'),(10,'#00FFB7');
/*!40000 ALTER TABLE `tbcor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbdata`
--

DROP TABLE IF EXISTS `tbdata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbdata` (
  `idData` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `inicio` datetime NOT NULL,
  `fim` datetime NOT NULL,
  PRIMARY KEY (`idData`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbdata`
--

LOCK TABLES `tbdata` WRITE;
/*!40000 ALTER TABLE `tbdata` DISABLE KEYS */;
INSERT INTO `tbdata` VALUES (6,'2015-09-08 15:00:00','2015-09-08 16:00:00'),(7,'2015-09-09 12:00:00','2015-09-09 14:00:00'),(8,'2015-09-09 00:00:00','2015-09-09 23:59:00'),(9,'2015-09-09 00:00:00','2015-09-09 00:00:00'),(10,'2015-09-10 00:00:00','2015-09-10 23:59:00'),(11,'2015-09-23 00:00:00','2015-09-23 23:59:00'),(12,'2015-09-24 00:00:00','2015-09-24 23:59:00'),(13,'2015-10-07 16:00:00','2015-10-07 17:00:00'),(14,'2015-10-07 16:00:00','2015-10-07 22:00:00'),(15,'2015-10-07 01:00:00','2015-10-07 18:00:00'),(16,'2015-10-07 02:00:00','2015-10-07 18:00:00'),(17,'2015-10-07 18:00:00','2015-10-07 22:00:00'),(18,'2015-10-09 05:00:00','2015-10-09 18:00:00'),(19,'2015-10-20 05:00:00','2015-10-20 15:00:00'),(20,'2015-10-14 08:00:00','2015-10-14 11:00:00'),(21,'2015-10-14 08:00:00','0000-00-00 00:00:00'),(22,'2015-10-19 05:00:00','2015-10-19 08:00:00'),(23,'2015-10-14 05:00:00','2015-10-14 08:00:00'),(24,'2015-10-21 05:00:00','2015-10-21 08:00:00'),(25,'2015-10-15 05:00:00','2015-10-15 08:00:00'),(26,'2015-10-22 05:00:00','2015-10-22 08:00:00'),(27,'2015-10-21 07:00:00','2015-10-21 09:00:00'),(28,'2015-10-28 07:00:00','2015-10-28 09:00:00'),(29,'2015-11-04 07:00:00','2015-11-04 09:00:00'),(30,'2015-11-11 07:00:00','2015-11-11 09:00:00'),(31,'2015-11-18 07:00:00','2015-11-18 09:00:00'),(32,'2015-11-25 07:00:00','2015-11-25 09:00:00'),(33,'2015-12-02 07:00:00','2015-12-02 09:00:00'),(34,'2015-12-09 07:00:00','2015-12-09 09:00:00'),(35,'2015-12-16 07:00:00','2015-12-16 09:00:00'),(36,'2015-12-23 07:00:00','2015-12-23 09:00:00'),(37,'2015-12-30 07:00:00','2015-12-30 09:00:00'),(38,'2015-10-16 07:00:00','2015-10-16 09:00:00'),(39,'2015-10-23 07:00:00','2015-10-23 09:00:00'),(40,'2015-10-30 07:00:00','2015-10-30 09:00:00'),(41,'2015-11-06 07:00:00','2015-11-06 09:00:00'),(42,'2015-11-13 07:00:00','2015-11-13 09:00:00'),(43,'2015-11-20 07:00:00','2015-11-20 09:00:00'),(44,'2015-11-27 07:00:00','2015-11-27 09:00:00'),(45,'2015-12-04 07:00:00','2015-12-04 09:00:00'),(46,'2015-12-11 07:00:00','2015-12-11 09:00:00'),(47,'2015-12-18 07:00:00','2015-12-18 09:00:00'),(48,'2015-12-25 07:00:00','2015-12-25 09:00:00'),(49,'2016-01-01 07:00:00','2016-01-01 09:00:00'),(50,'2015-10-21 00:00:00','2015-10-21 09:00:00'),(51,'2015-10-21 10:00:00','2015-10-21 15:00:00'),(52,'2015-10-23 00:00:00','2015-10-23 02:00:00'),(53,'2015-10-23 02:00:00','2015-10-23 04:00:00'),(54,'2015-10-23 00:00:00','2015-10-23 04:00:00'),(55,'2015-10-26 00:00:00','2015-10-26 04:00:00'),(56,'2015-10-26 04:00:00','2015-10-26 06:00:00'),(57,'2015-10-26 00:00:00','2015-10-26 07:00:00'),(58,'2015-10-26 00:00:00','2015-10-26 02:00:00'),(59,'2015-10-26 06:00:00','2015-10-26 08:00:00'),(60,'2015-10-26 01:00:00','2015-10-26 04:00:00'),(61,'2015-10-27 00:00:00','2015-10-27 02:00:00'),(62,'2015-10-27 00:00:00','2015-10-27 04:00:00'),(63,'2015-10-27 02:00:00','2015-10-27 06:00:00'),(64,'2015-10-27 04:00:00','2015-10-27 08:00:00'),(65,'2015-10-27 06:00:00','2015-10-27 08:00:00'),(66,'2015-10-28 06:00:00','2015-10-28 10:00:00'),(67,'2015-11-04 06:00:00','2015-11-04 10:00:00'),(68,'2015-10-30 06:00:00','2015-10-30 10:00:00'),(69,'2015-11-06 06:00:00','2015-11-06 10:00:00'),(70,'2015-10-29 08:00:00','2015-10-29 00:00:00'),(71,'2015-10-30 08:00:00','2015-10-30 00:00:00'),(72,'2015-10-29 08:00:00','2015-10-29 10:00:00'),(73,'2015-10-30 08:00:00','2015-10-30 10:00:00'),(74,'2015-10-29 10:00:00','2015-10-29 12:00:00'),(75,'2015-11-02 10:00:00','2015-11-02 12:00:00'),(76,'2015-11-05 10:00:00','2015-11-05 12:00:00'),(77,'2015-11-09 10:00:00','2015-11-09 12:00:00'),(78,'2015-11-12 10:00:00','2015-11-12 12:00:00'),(79,'2015-11-16 10:00:00','2015-11-16 12:00:00'),(80,'2015-11-19 10:00:00','2015-11-19 12:00:00'),(81,'2015-11-23 10:00:00','2015-11-23 12:00:00'),(82,'2015-11-26 10:00:00','2015-11-26 12:00:00'),(83,'2015-10-28 08:00:00','2015-10-28 10:00:00'),(84,'2015-11-02 08:00:00','2015-11-02 10:00:00'),(85,'2015-11-04 08:00:00','2015-11-04 10:00:00'),(86,'2015-11-09 08:00:00','2015-11-09 10:00:00'),(87,'2015-11-11 08:00:00','2015-11-11 10:00:00'),(88,'2015-11-16 08:00:00','2015-11-16 10:00:00'),(89,'2015-11-18 08:00:00','2015-11-18 10:00:00'),(90,'2015-10-29 12:00:00','2015-10-29 14:00:00'),(91,'2015-11-03 12:00:00','2015-11-03 14:00:00'),(92,'2015-11-05 12:00:00','2015-11-05 14:00:00'),(93,'2015-11-10 12:00:00','2015-11-10 14:00:00'),(94,'2015-11-12 12:00:00','2015-11-12 14:00:00'),(95,'2015-11-04 10:00:00','2015-11-04 12:00:00'),(96,'2015-11-06 10:00:00','2015-11-06 12:00:00'),(97,'2015-11-11 10:00:00','2015-11-11 12:00:00'),(98,'2015-11-13 10:00:00','2015-11-13 12:00:00'),(99,'2015-11-18 10:00:00','2015-11-18 12:00:00'),(100,'2015-11-20 10:00:00','2015-11-20 12:00:00'),(101,'2015-11-25 10:00:00','2015-11-25 12:00:00'),(102,'2015-11-27 10:00:00','2015-11-27 12:00:00'),(103,'2015-11-30 10:00:00','2015-11-30 12:00:00'),(104,'2015-12-02 10:00:00','2015-12-02 12:00:00'),(105,'2015-12-04 10:00:00','2015-12-04 12:00:00'),(106,'2015-12-07 10:00:00','2015-12-07 12:00:00'),(107,'2015-12-09 10:00:00','2015-12-09 12:00:00'),(108,'2015-12-11 10:00:00','2015-12-11 12:00:00'),(109,'2015-12-14 10:00:00','2015-12-14 12:00:00'),(110,'2015-12-16 10:00:00','2015-12-16 12:00:00'),(111,'2015-12-18 10:00:00','2015-12-18 12:00:00'),(112,'2015-11-05 07:00:00','2015-11-05 07:00:00'),(113,'2015-11-06 07:00:00','2015-11-06 07:00:00'),(114,'2015-11-12 07:00:00','2015-11-12 07:00:00'),(115,'2015-11-13 07:00:00','2015-11-13 07:00:00'),(116,'2015-11-19 07:00:00','2015-11-19 07:00:00'),(117,'2015-11-20 07:00:00','2015-11-20 07:00:00'),(118,'2015-11-05 12:00:00','2015-11-05 12:00:00'),(119,'2015-11-06 12:00:00','2015-11-06 12:00:00'),(120,'2015-11-12 12:00:00','2015-11-12 12:00:00'),(121,'2015-11-13 12:00:00','2015-11-13 12:00:00'),(122,'2015-11-19 12:00:00','2015-11-19 12:00:00'),(123,'2015-11-20 12:00:00','2015-11-20 12:00:00'),(124,'2015-11-05 10:00:00','2015-11-05 15:00:00'),(125,'2015-11-06 10:00:00','2015-11-06 15:00:00'),(126,'2015-11-12 10:00:00','2015-11-12 15:00:00'),(127,'2015-11-13 10:00:00','2015-11-13 15:00:00'),(128,'2015-11-19 10:00:00','2015-11-19 15:00:00'),(129,'2015-11-20 10:00:00','2015-11-20 15:00:00'),(130,'2015-11-09 00:00:00','2015-11-09 00:00:00'),(131,'2015-11-09 12:00:00','2015-11-25 14:00:00'),(132,'2015-11-10 06:00:00','2015-11-10 08:00:00'),(133,'2015-11-17 09:00:00','2015-11-17 11:00:00'),(134,'2015-11-24 10:00:00','2015-11-24 12:00:00'),(135,'2015-11-24 14:00:00','2015-11-24 16:00:00'),(136,'2015-11-26 10:00:00','2015-11-26 13:00:00'),(137,'2015-12-10 10:00:00','2015-12-10 14:00:00'),(138,'2015-12-10 10:00:00','2015-12-10 15:00:00'),(139,'2015-12-10 13:00:00','2015-12-10 15:00:00'),(140,'2015-12-10 10:00:00','2015-12-10 12:00:00'),(141,'2015-12-10 13:00:00','2015-12-10 16:00:00'),(142,'2015-12-10 14:00:00','2015-12-10 16:00:00'),(143,'2015-12-10 14:00:00','2015-12-10 18:00:00'),(144,'2015-12-15 12:00:00','2015-12-15 14:00:00'),(145,'2015-12-22 12:00:00','2015-12-22 14:00:00'),(146,'2015-12-17 12:00:00','2015-12-17 14:00:00'),(147,'2015-12-24 12:00:00','2015-12-24 14:00:00'),(148,'2015-12-10 08:00:00','2015-12-10 10:00:00'),(149,'2015-12-14 12:00:00','2015-12-14 14:00:00'),(150,'2015-12-21 12:00:00','2015-12-21 14:00:00'),(151,'2015-12-16 12:00:00','2015-12-16 14:00:00'),(152,'2015-12-23 12:00:00','2015-12-23 14:00:00'),(153,'2015-12-11 10:00:00','2015-12-11 14:00:00'),(154,'2015-12-11 12:00:00','2015-12-11 14:00:00');
/*!40000 ALTER TABLE `tbdata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbequipamento`
--

DROP TABLE IF EXISTS `tbequipamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbequipamento` (
  `patrimonio` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idTipoEq` int(10) unsigned DEFAULT NULL,
  `modelo` varchar(255) NOT NULL,
  `statusEq` enum('Ativo','Inativo') NOT NULL,
  PRIMARY KEY (`patrimonio`),
  KEY `tbequipamento_FKIndex1` (`idTipoEq`),
  KEY `idTipoEqp` (`idTipoEq`),
  CONSTRAINT `tbequipamento_ibfk_1` FOREIGN KEY (`idTipoEq`) REFERENCES `tbtipoeq` (`idTipoEq`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2152344235 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbequipamento`
--

LOCK TABLES `tbequipamento` WRITE;
/*!40000 ALTER TABLE `tbequipamento` DISABLE KEYS */;
INSERT INTO `tbequipamento` VALUES (46523643,3,'hgfhgdshgdgdfsg','Ativo'),(241235435,2,'fdgsfdhfdgfdsgdfg','Ativo'),(2152344234,3,'gregfegbfdshdhgdfb','Ativo');
/*!40000 ALTER TABLE `tbequipamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbimagem`
--

DROP TABLE IF EXISTS `tbimagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbimagem` (
  `idUser` int(10) unsigned NOT NULL,
  `imagem` blob NOT NULL,
  PRIMARY KEY (`idUser`),
  CONSTRAINT `tbimagem_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbimagem`
--

LOCK TABLES `tbimagem` WRITE;
/*!40000 ALTER TABLE `tbimagem` DISABLE KEYS */;
INSERT INTO `tbimagem` VALUES (3,'�PNG\r\n\Z\n\0\0\0\rIHDR\0\0\0�\0\0\0�\0\0\0�}ĵ\0\00�IDATx�흉�Ź�?����QQD6�AP�XdS\"\Z��1B7\\�rݎ�����5� DqAwO����s뫯����g�{��y�����_�k�����kT�K�^=T���U���)���S}��Q}������{��ٳ��޽{�s�1�\'?���ѣ��3;w���:t��>r�9ST3��$��yŬ�`���ҫW�X��t�\n��G�n�b?���ާs���EW{��	.��/���`�ҵk��}�>��8��C��x|u�ʥ�fyP�^.��m�#c��01]>��:�CT��6���<\\�\"�^�0���Gh`�бc�����J�\'�2�+�.�pQ&M8#0C\\l}&��e15�谙�l6.�2�&7>x�5�Qx�\0��S|p�W�y�Z0ov\0�=����CC�8�p��\0�UFE�~�#�Ɯ��͉�+�p�@�:�(u��G;1�I��&,&�ՏhD-&�z	ǻFR%�t�Ў|��CO�p	.&N&���Fk�;D��0	v�!%�*\r��*\\���A�>�����#��\\���\n�.W��rT���;���\r���&>0vm�-�?�0�S��=�I6\'`�|������Lt�AAd���Ѕ����3���;��:u�Y3UnTCr$���v�ڕ����A\'W�oT\"�I0v�(s3����J��O�IIɔ>\'��D~%t_x�����b��1�a���<,�M˸j�tg�l�;�b#�Q.�&LD��vZN��*�gt�1f��T�Mk?Lʨ��k��\'a&�C�\r� !�A0*�H	h +b��!�bg��/��9�6;񻢃M����y��^�]�$�����������6u�������i�?��	��C�����T�$���hi�E�QL�jW���޷KfF�E9�,0\0��+D	��X��\Z�����l�a�M�n�.���.�M[W׬�3̝K����9gO�pU���( �ȹ#�l�L$�\\҃}iB����F*����,�\Z��}�\"�f;���faV�pRÆ\0Q��ZI@���K�5[O�J��M���&��>s:����F��~�j\0&���G�kq^K*=�D����sh�`X5����0��ih��b&\rͧ)��l���\"E�L,�>�������P��a���h�(�$�3P�LIL��G�e7��������B-Z\0D��y��.B�F�B��s�Hrm\'\'�]4W�*�w�L��>�� I�^@���z~76ټ�,\\p�w�2�D�csI\0�͓��6���Vk������R�4���h7�\\�j�8�GKQ�TK�VK0�Rj<Q�UZ����Z\r$]�Y-ƨ^���p=\r�߹�����F{���*l�F��v�O ô\"hi�0�OA���5FX� �J��K��j��l\\�ڌ�7���(���D�z*�r�Tź,<\0:<�A( mK5In4���8Ҋh�3g�̄K\Z�f�Ă�p%0��I��ܞas^�F\0�em�Kh?�Y�C$=<������祅�N�c��5�[���;W�	�&�fu��A���,�n4��<4���l���,��å�I��X�M���\\gO�X.��(�e�҃h/�>�1m�nX�P��f\0L�K^�l�5�����\'m\"��uIﻐձ�iK�\\��y$��4�VT�l㐕��^y�Q�0G����3B��Yh1\0�}����`6*\\����JØ�<6m�s�]oy�혮�swĜ��J|1�(��gJ������Q��E�g.A��.��)$X��)�m��CvYZM��A�b�E��c�;���0Ό���O\n�ݎq�Xk�K����3RC�&��05�qɪrB7��1&�-w���՞g�R��^>�PM���W��3Æ������L\nz��8SOJ���:*����1,o�g�a&�E\n�����-�B�^����U�����=\\	�S�ȟ�4��R�!tҽH\nSm�dT�\'�����;�2�t\0�?�~�\0��]\"���]:�[�_Z�J\rƸ�~���I�\0W�\n��^Ҏ��ߒ��\'�J�S�`獺�R�y��taה>i�V��ܼ����r�X֚�&�\'װ\"�L?[m�6`!�S��B�JC�|��7\\��J�{���j�4������[^^�nX���W�x0o\0�E���F1?%��������\0��d�f��t-�/5���Z�Y�\\8~x��ծ��{-����\\�EK5��p�U�EF�.��¢N�\"�6D��U����4�.�}������Zs�\0��q`��i*���nIMDW��O.��4ڋ�*Q�Z�hC4a�64���`�����J@�@KpB\n-�*�\n��ҟ��<\\)�du�M�V:����ϳ�\"l*��U)��{�c�b�%�O\Z��0W���\\�rI�J��h`UN]*�JIL����Wt�ÕP\\�{J�^\\h,v�f+/¦�R����Õ��R��v�6����񋼾��$���K�\0�p�h������O��R=a�KX�906`\"�>�\\!\\IC�8��lW����t��Ȣ�\rZ��������0���ޱ�1�Q��&�&�mW�W\\�5��VF��sN�\"��vW�e�N8���J\0W�3q�K��z������cy����&\ZU=w~�*�a9쾛[���W\\`�J��S���A�<���V���l��UP�7��h�\\��6�ܸ#A9O���?�N}��V��s,l~=�\\�?z�sL�\0�X�u��g{�*�����(�h-&�����E\\\0��{v�(D�F�{\0f���\\�%����t����\Z��s,X����Y����5\0pͽ�rW���&�G��Z�2a~���e!s��7���y��������3\rq���6,���*(\\����r��^��\0Ƽ�B.\\q���N�}L����Xp��+,�a�T><�7���hW�˥��d�W�䳧oo�y�?�����dGw���J�X8��f�L�����/��	��0����f\'��Ds�E1\rL���UL��4����`p�8�W%pŝ4&�o�����E���o\\0� V��\n��zBr[f���Ul��(M�$il�>������3\\�B���eN����p�P�E���+���>O�\"*��\'���=\\������3<\\)�\\.m��Z�&��p5\\��ݺt�=(	\\y�U�0I䨳[�B��fx�����F��#\'yM �B#��`���j,�l=6�b�\n�<6�)\\a�d	f��BW��\\�ߕǫ�r�!���+���U�E\n=\\���b��UA��c&�Ƅ�2�0�t���U\\qW�F���#7��[P��5�o����l�;���.3��J!��\Z�Hq����e����Ua;먻�<\\�\rk�3m��=\\��wI�K\Z�x��XR?v��e�����\n���Ò��g��i����R��=׶��W_��]zq����o��J�}͂�[�=y�z}����J�C��1@���ع~���:w����򻨪x�ݟ�_l�����,�-+f��.\Z��vv����s��W�Ro-<������7�PT\n��{��=��ȍD���n��L�\0��þ�\\Oتʄk��!A���+�j��s�4u�K4d��\\��̂F��B����1?��z\\�i\\l��*�Rɡ�*����\Z�t����*_�S�4o��lhQMAmp����e���p����\'��7��d����+o����*����zi�8-�?����	��^�a�Tt�@WV�E�B��5�<&�I�M�+����񛟫.����~[�G��~�u圲�����ׅ����&�K��÷J���_5�ͳ�c�[�/���o_�3R=?�X��\0P\\f}�	���5����KJ\"9��blp�I3��$6��NS��j��Y�Q�_��G��7�OjZ䉀K��Cafaϒ%���4��˼9���w/*i�~�-K�N����5YPI�ڹ�<=�K���/Rl�-�B�2�4L��w���4o6�t�k��׫�g\r�bBk���\nׇ�!wό��fǦ�}��P��E)�2�\rş��Dڕ|.��,��.}Rޘw����_�ݏސ[�j�G����s�~�j�s�f�H6����O��뱛���jJ�����U�ea�d��\'���W�,�J�������{���T}���s&B�%��G�V\r��j�<{��`-y���7�F�u�=�un�#�tލ��V_�ჿ�%\\h����qޞ[�$�%=�M���?D�5��6k��Ě�p���FO��ukF���V��E�+l��]�d2�e%/3,�*�|q���{�L03�Y��T�gf^�����Ұ���\nkG�`M��Y^���E�����a~��)�Y����\Z��C�>��)�/�ѭrC�FO�Q���;Ԯ�~�A�)��8\'�4���Q�O�k:\\�ǌ�2��5$ߍ���p�[|Y9�h�R���M���6��hR\\����,B������\'��U�oޤ~w�8u��#ռ1���cz�	�\\������}��R\'u9X��K�5���{��V;wlS��诏�H�d5�_7]U��Щ�#���{o�%?VJ̝��ۿ���Ϝ�N��Su��n�!��gB����g�x�Q�3{��������6�0��w]@f&��)�eR�|��f^\\�D�Wp�������9k���zf��rYL��h߮u���pxmw�*�0_���	�m��*\0`�具��=j���GM;�u��ꄎ?)/<S&�x��>���0�hu��+����Ъ�9I^�\n������Z��3_z�sN�{����g�3N�9�D&\Z��F��n^tN0ތm���H �\"p������\n\"�8����K�-[Q��ح[�P��ª�%Z�R���%���\'�nŦ�S���~1��:����2���_:��:dwu��Q�|��z~�2�p��\0`߶w�<����u���gZz����Q��.={L���z�N��_8�\'c^��E���g[�WjH��w��\r���A4����8��Z�a.a&��N�؁�`�޿:������1?U���G]XZx3��l/\0�������U~��۫�&��ܷ7�d����3\'�\r�x�3��)9�;�ż��%U\Z:\\D��>?.�VS�%!x.v=*��1]zJ�6C����\r;��b��q|�L�_�Nc�.8\0�k/m�kr�,�q��P��Sa/v�Zk/��?���i���ԕ睪�{kS�#�w�>��3�T�^uY�3�Yo^sN�c^\\�6�b=��e�X[�,4�3Q)�G�\Z׭M�P��b�\n饱�E�����3ͅ�7����=�?�,�;�f����v\r�A���_sM�\Z��4A��ׂK���Qh�2�_;u�Y��g<\'���yG�����B���أ�Ft�$$��f����J=~~�h����T�v���Y\'~�\\4B1���[^S./��9��V3��~9���{�\05uh��.�1�K�r�����IǪ�J��q�b�����fp}��&�g���J�8{R?5i���g�U����/x�U�/p\Z��ڧ>y�D�i��֔����7a3���p�%O28r��Qw&l���ˬ+L�K㋿�W���j�띷�Ps/���@t�Y��??.`�3�X5c\\��ݷ�.���o|��������_W��i,`���Z�M�yy��K~ٝ+��j,��3�l�/���0�ds%���.�\"g�d=��|���`08�	S9�Nմ���A\r�\\��O$[��>~�n��\rA�+��쓏�;��m���K��W�\'�]�.qڊ�^�Vf����ϮU�������-�$���ۖD>�76�O�����܃a��åG\nI��G$��\Z��7}��\Z0��}.�!E�r_��r7�nJt���\'nU��gI�G��b���mj�捡�x����]�R��|��/S�\\��U�k����5�O*���/ݯ�z�梶0�ȻD�f�������&(�\'�>}G��z���9\'�,�a����j����a���<p�{���g㻇=9@6�`,�\\�>|8�E�ax\\��_��Z�?����ZP���fn��s.KΙA\r�����2\\19�4�D6ɺ�L���U$�B�$p���|� �eK�KJ_�{@�_sQ+�K�`w*\r$���mVj9r��Э����i�Ç�F�>��㌗�en��XS�%m�\n	�n�m~����@�����\",<�\\���h���a\Z~7�\0��J�u^L��$�Tj��!6��;~]�dVjHB�	.�C�M�Vp�����+I����l���2�-1	�]��;��|�����î֯���ekZIİ���kZ}׽/>�Pp%�����`~9n�K�����_uE���IX��V��zb��V�PrzO3�u�I���c+a�}aC��Z\r�<0{J.�u�h�(�`�n��<\\�<z�*�i((�[Z�\rk�C=4��k1�Z�����W�5\\I��Ǟ�`\\���l0-u�t�����0\re�$�-B������#\'E�����p�����^6�sP$ХK�V���l��ɓI�;��j\r3���vf�+ꖓ�E�c2����g�2RH��]�b��V:\\z�8]�r�TO\"a�a����.�5���O#��-\\��z�q\"�W����.�V~�4ԭ}�d���pd���y���e�\ZY{\'�r1�5:\\I\"�T�q�A�冘���m�^KX�B��å�Z�AX� �|�èKǳ�1��/\nWN�~+f<��.��3��tҺ/�VǓ��J���#���2��X�i�\Z��\'&�p�s�}��\0�F��p=��I�yEt�Z6Hj<e�Ի�Sa��s^�(4�\"�N^��&_2cJ��\Z:\\D\r%��(p%	fHE�K�P^��cn���H�K��>���P�^,�wa�\Z�oT��38��å��\\,���y)w*\\����j�:$����.�ش�a�J̐[(O�թͼ�U�y�m�\'�\\�&�l����ԝ�F�\Z��YzN�K*�I 7\n\\��䷤�`�	\ZP�@��$�5\\�1	ɣq�;s18@\'Cם1�	�B��J�Ӿ76D��\"H@�T��d���+��[���\rS�������2/�N��Y�,�]9������Z���I�$\r���<p�w��-�����df~K�C�;�_.>��,�\\6��ALC\n;]��U���4p�ZA������;p��������ބ��KJ��:Cs|�W疣�I\nx�}��<ֻK�[���-7�l�˯(�c��\\�;�v���U�n��n�qvy���c(w��U�d2G$���U��#�D&�!Bb9.�*ꂋ<&�%�Kpq|�b!��2\\d楧�ܛLB�p�;\\�K&��m����\r�f-��ڟ��P����zܨRI�\'.�ڼ1E���_M�pUR����`*8�[�c�0)\\�J&\\a`�>S��D�m|�\Z5�~?�kQ��>�K��\"��V9��\'s+�ϑ�.O��Ko�fv�b����:��,t��Z�V�梏�kDS�cz�m��Y��:Y��c��.M���g1צ�pU	.v1���s��\'�Lt?���\ru[p,�\\35�4�@��u�Vau�v��zD������<�P���3��9j$�J����.��f73\'pӍWg�ٓ#�����~����� ��V�ݦK��2�0��)t�oI�yHV�o;�O%����c�.��ܷ�[���s��\0�kd5��Vk����߿����|��&<����I��#2>y<�_(�(k�A4@�Dz)ȝ^E�wE]��������bf�9�=$�o���Q��\nBy��oTN��*r�����ea��Ua��\'�2	m�G� ��d����.�êm��bN��~W�^y��?>�0�fh��@G��	�PW.�L7	��o.�Y�\r0���9$���]���U���߲%�1�L�W+o��\n	�?���5M����t�-��-�;�$q,ݛ\\���[L\Z.��M(��ȑ\0��4,�F(D��-C\\-��OX*z~�&y7��]�H7 !�7������$�y�FȢ�ː���ib暹5�;o��\Z�4�1;��o�L�xI�\'���7I�K?Ґ�`μ$���]Ӻ��)��{	��+���k`#�}�q�w�LB=�U$S��e�d�˽i���S\n��p�T�\'	l��4,��[+�y�\r�p�6$o�\Z�o��a���bJ��F\rd4\\z�^W�uB�*u�z9|)�T�s�K���\\�=��T6�HR�e�ĥPW*2����p9��]��d�P�k�@�4K�|�ȉj�������	��iB�����w|G��B�ze0͠��.��\r��Z�\Z�FB3��M�dJ�r�\0 �t>^�-şQ>b��^���\"�.��~ot��4p�.ݴW���C�\0���W�q�f�ZMW\Z��ˡ���$Z+�\'x�2�^N��:6�i�L��)�M<=\\5���֐�Td�~�B��䵊pT��Ua�ӯE���H��֒<w��pe�ѥb���(���W���-W���q����kI���%_U��?�\\��A��,ʥ������ߞ�&7�\'��0�x�ܵ��qy-i��l�`S�eIq�֣3/�!�Ŋ����/����o�蠇+�m[\\r�^Ml\0\r�����юz����^��6���ᲄ��\r�Eh�V��Z��ﶊ��th�p��f�܈:R���pUX�&��z_Y7�,E�����nWճa���XI�݃��́�X����\0G3�;)�����\\=��o��\Z�H��f�ey�R���S\'��a��(�<V�O�p������{�� ��a�f�d��B��py��J���b�dXh���\0��e�l<\\��p�n��Aa�U\Z0X��63����r;������ŗ��K?>!��f&0[���0<:\\���#�]����o�;j���V��43��5��̃�QA�M�s�f�/��w����o<`���ܳk���ۿW�:wbd�����Sp�E�� Al������l����}�ѿ�z�p�6���B�/\0��{b��?mI��\"��z\0\'.��_U��W_�py�~���zU�^?|������b���>	�4���!9�Â�2z\r��S��ն��q�<d��py�,��W`�Ť�-���@���\nT��Ҽ\',y�ay��|\00a\\^��~ѩ��P%�\'?L���VҨ��ݏ�R�|�A�x�ay��|\0L_+��n���hm�z�a��SV���.`}�g��x���?{����i��*��Xd.����h��QK3Qju��ڿ1���G}�o�����{�f�?ݱR���M�����\n��\0��~䆪��#ڊ�^hO�e�����/LñcF��3/VK�[��jT�m�2u����y眥N:q��ԩ���T�W��T�z�ZZm����e��\\L@�9i���ԩS��9�ԓՌ��S�^lp�ʍX����j����M��*}}����5HY���2�����Ֆf�2���؜�!q*}=��Cjܸq��OV���W]�vm5ltS&�6>6@W�����Q�<�iȐ!j̘1�N��u�]*��:fS�E+���\0L�w�&��ȝ]�Mk��*4�׻�d2>���Jy�E��ݻ����=z\"s��᪓fb�c\"�	�իW\0���9�;j����|51`���h��~?#�:��vU�����JQ�͛7[�a�c~\0M4�	����<���Z�>�i�1)�4r�H5y����E��l�2��?��ukRA&�$W��]�jށ,&f�J�/�ؐ���[�NM�8QM�2%.ݢ@&L��N;�45x��`�4�H��\"��RD�����]1�Y�f�j�0?�˽����\0M�����\\nl��h��,Y�N=�Tu�g8�e\n���k���֒W���u��N����$\n.d۶m�Z�/���>Y{s�=�.�|�;�T��ܳ�a��W��6cǎ\r�m��p��fÌԵ\Z�v�@k�Sމ���$p�\\�RU���g��7>TFP��B�eEPD���|o���ﾩ��oܸ1\0+k�\\@�oz��i�Rz0��J�.2�D�l���o߾���ݻi]��>B�l1�W,%��v\"�ERri{_z\\}�ŧ�گ9s��b�4�_��Y̵D!1�}	�\0Y��i-���(��G��PI%ng��\nɻh�=�-�e�g&����V�z����`�$�,*|r�π�\r�֐�.�`�\\P�YP)\\�~�aM\0cQ�߼�.E�����V6�%r�Yg�.� =q͆^+����>�����f*d)�l|V��ȤѪ�K|�Z�����5}>��҅�|��h#�L���!��AP͵�J7\r�L���������_5��}o����@빷�k��\r.�	����A\nS�e>�\0F��-���<X5abB�@&���e���6��j7�y������/��>Ў�x����B���Wؿ?�����ѣز\\\'��]$�Z\r����J�g=@�@1Ço39�K1������k���R�(෻���lA]��d��^dmD��.�F�Rg�yffZ��=��b-�XȑuX��$@18Q�!p�K���$�~����\"���Př�\"z����\rr�K,��6l����*�)\\�����ZC�s%�\0�C��,��ݵ�-��ͮ-�� �e0�j�*\' d�e�;�R�eB[i���u�q��%-֒e�J�h�,�{2pq\Z*Jd��������<�\0�\rE���Z�5:��IN9唊��}4,��f�Q#[�-�.���s5� ��Fz\0��uI�*L���1��U�o\\�>9�D�g��ۗ7�满�ì\0S�(��:Æ\r�.2ݿs	��%Vw�8k×8p`\0���DK1 L�ݧO��!��\\�eG����;�	���[�Vd���Y��7}��D�a渢,�J�YS��.f�X|.�,&�9*�Z�H�%�rbz�|Y���`	Ǜi\0�߭e�F�D���\0�P�th�<�Y�*\rև��qDV�\Z3�Tp�\"�\\�lUz��@��k1�8̶�������0���i1`��k�����C�]�$+�?�&-e���eVs���D$;���j��СC�Dm9�(�U�_��SF&K�Zi�-[����^��D�ց-&������e�&�\\\\��\n�7Ȯ\0d���**b�.��UR������_]U�\\aU\Z��Y��M�i\Z|�V3�$�V�g�\\�9�ݺuk�;1�i�S(�0�Ν��U�1~R�qi�޽�W�D��+k��&aT�AT���Hڍ��� 6�K�I�M\0�#��a%;/;wV��>�Lm�����\n�S�S[�nU/��R�m\0+id0�K���\'\\�G1.\'+>b��F*���Ku����� �ѠJ��YUp��\r����2�K�������^{-hm��w��,D�-u%�\\V9Pֆ�����Tn���Ĉ\nb���q�~���]��m͎�n�K�*ZZ�X���n���W%AS�����2��4/:6\rDX(5��y�Ǐ|ZĦĒa��.�Q�Yr��.U�J$�^-iC�QG�e��ಸ��z\r�^c�O8\0~ߗ��ɤ�.%>�,�}�4����|��6=�f��l�\'�����h�`\0c\"�غK?IƟqf��`F�Z�j���\\�y�:|몽Z�h�(_K��@&�w�޹j��lm�M��^Eoj�$\'��L[���[RX���6fh��\'��25�^��*�H*��B�c�Z�w	�8&�y*�3�K\"�a�;��\0,J�Tԡ�Zf�m�Ѩ=T�軮��|��@\Z$���e�Lf�ZI4��F�oױ�D���.�-���Ф�S��k9餓ʮ��<噢|/���Dpq,:,�bүQ���=��|U�S�\\b�����K�cT���ݻ����\0H�\\Z�G���&Y`i�/�{�!(c�f.\\����c}= a��<�i��.E��p��-�7jw�c��P��%�\"f�~�3��m���]��9Z�ż��B~7ɋ@�}��癔5�f\"c\'f\"�N��^QpzءY�\"A����.9Rb+���f�$P�ip�b�	#�H86mrSO2���|��%��(\nZ��/,��*)k2M*���,F|���?k9n�m�;�>�u�m�4�!!�8��]\"O�+����%�U����9!4z�IH�S�B*=��������Ɛeh��ԫ��6���Z�cF]��-I��غ7�NȈ#r5�Lv�Ν[�FF�ߕȆ\r\"˟�L\"\'���7o^U�Vv{q��8�_\r��j��<�u/foT`��5�a+�M��fs#�|�QZ_�E��+ʲ�0Ie��;�6�h-	l�3���&�̱��Q��i7_L�T�\0\0\0\0IEND�B`��PNG\r\n\Z\n\0\0\0\rIHDR\0\0\0�\0\0\0�\0\0\0�}ĵ\0\00�IDATx�흉�Ź�?����QQD6�AP�XdS\"\Z��1B7\\�rݎ�����5� DqAwO����s뫯����g�{��y�����_�k�����kT�K�^=T���U���)���S}��Q}������{��ٳ��޽{�s�1�\'?���ѣ��3;w���:t��>r�9ST3��$��yŬ�`���ҫW�X��t�\n��G�n�b?���ާs���EW{��	.��/���`�ҵk��}�>��8��C��x|u�ʥ�fyP�^.��m�#c��01]>��:�CT��6���<\\�\"�^�0���Gh`�бc�����J�\'�2�+�.�pQ&M8#0C\\l}&��e15�谙�l6.�2�&7>x�5�Qx�\0��S|p�W�y�Z0ov\0�=����CC�8�p��\0�UFE�~�#�Ɯ��͉�+�p�@�:�(u��G;1�I��&,&�ՏhD-&�z	ǻFR%�t�Ў|��CO�p	.&N&���Fk�;D��0	v�!%�*\r��*\\���A�>�����#��\\���\n�.W��rT���;���\r���&>0vm�-�?�0�S��=�I6\'`�|������Lt�AAd���Ѕ����3���;��:u�Y3UnTCr$���v�ڕ����A\'W�oT\"�I0v�(s3����J��O�IIɔ>\'��D~%t_x�����b��1�a���<,�M˸j�tg�l�;�b#�Q.�&LD��vZN��*�gt�1f��T�Mk?Lʨ��k��\'a&�C�\r� !�A0*�H	h +b��!�bg��/��9�6;񻢃M����y��^�]�$�����������6u�������i�?��	��C�����T�$���hi�E�QL�jW���޷KfF�E9�,0\0��+D	��X��\Z�����l�a�M�n�.���.�M[W׬�3̝K����9gO�pU���( �ȹ#�l�L$�\\҃}iB����F*����,�\Z��}�\"�f;���faV�pRÆ\0Q��ZI@���K�5[O�J��M���&��>s:����F��~�j\0&���G�kq^K*=�D����sh�`X5����0��ih��b&\rͧ)��l���\"E�L,�>�������P��a���h�(�$�3P�LIL��G�e7��������B-Z\0D��y��.B�F�B��s�Hrm\'\'�]4W�*�w�L��>�� I�^@���z~76ټ�,\\p�w�2�D�csI\0�͓��6���Vk������R�4���h7�\\�j�8�GKQ�TK�VK0�Rj<Q�UZ����Z\r$]�Y-ƨ^���p=\r�߹�����F{���*l�F��v�O ô\"hi�0�OA���5FX� �J��K��j��l\\�ڌ�7���(���D�z*�r�Tź,<\0:<�A( mK5In4���8Ҋh�3g�̄K\Z�f�Ă�p%0��I��ܞas^�F\0�em�Kh?�Y�C$=<������祅�N�c��5�[���;W�	�&�fu��A���,�n4��<4���l���,��å�I��X�M���\\gO�X.��(�e�҃h/�>�1m�nX�P��f\0L�K^�l�5�����\'m\"��uIﻐձ�iK�\\��y$��4�VT�l㐕��^y�Q�0G����3B��Yh1\0�}����`6*\\����JØ�<6m�s�]oy�혮�swĜ��J|1�(��gJ������Q��E�g.A��.��)$X��)�m��CvYZM��A�b�E��c�;���0Ό���O\n�ݎq�Xk�K����3RC�&��05�qɪrB7��1&�-w���՞g�R��^>�PM���W��3Æ������L\nz��8SOJ���:*����1,o�g�a&�E\n�����-�B�^����U�����=\\	�S�ȟ�4��R�!tҽH\nSm�dT�\'�����;�2�t\0�?�~�\0��]\"���]:�[�_Z�J\rƸ�~���I�\0W�\n��^Ҏ��ߒ��\'�J�S�`獺�R�y��taה>i�V��ܼ����r�X֚�&�\'װ\"�L?[m�6`!�S��B�JC�|��7\\��J�{���j�4������[^^�nX���W�x0o\0�E���F1?%��������\0��d�f��t-�/5���Z�Y�\\8~x��ծ��{-����\\�EK5��p�U�EF�.��¢N�\"�6D��U����4�.�}������Zs�\0��q`��i*���nIMDW��O.��4ڋ�*Q�Z�hC4a�64���`�����J@�@KpB\n-�*�\n��ҟ��<\\)�du�M�V:����ϳ�\"l*��U)��{�c�b�%�O\Z��0W���\\�rI�J��h`UN]*�JIL����Wt�ÕP\\�{J�^\\h,v�f+/¦�R����Õ��R��v�6����񋼾��$���K�\0�p�h������O��R=a�KX�906`\"�>�\\!\\IC�8��lW����t��Ȣ�\rZ��������0���ޱ�1�Q��&�&�mW�W\\�5��VF��sN�\"��vW�e�N8���J\0W�3q�K��z������cy����&\ZU=w~�*�a9쾛[���W\\`�J��S���A�<���V���l��UP�7��h�\\��6�ܸ#A9O���?�N}��V��s,l~=�\\�?z�sL�\0�X�u��g{�*�����(�h-&�����E\\\0��{v�(D�F�{\0f���\\�%����t����\Z��s,X����Y����5\0pͽ�rW���&�G��Z�2a~���e!s��7���y��������3\rq���6,���*(\\����r��^��\0Ƽ�B.\\q���N�}L����Xp��+,�a�T><�7���hW�˥��d�W�䳧oo�y�?�����dGw���J�X8��f�L�����/��	��0����f\'��Ds�E1\rL���UL��4����`p�8�W%pŝ4&�o�����E���o\\0� V��\n��zBr[f���Ul��(M�$il�>������3\\�B���eN����p�P�E���+���>O�\"*��\'���=\\������3<\\)�\\.m��Z�&��p5\\��ݺt�=(	\\y�U�0I䨳[�B��fx�����F��#\'yM �B#��`���j,�l=6�b�\n�<6�)\\a�d	f��BW��\\�ߕǫ�r�!���+���U�E\n=\\���b��UA��c&�Ƅ�2�0�t���U\\qW�F���#7��[P��5�o����l�;���.3��J!��\Z�Hq����e����Ua;먻�<\\�\rk�3m��=\\��wI�K\Z�x��XR?v��e�����\n���Ò��g��i����R��=׶��W_��]zq����o��J�}͂�[�=y�z}����J�C��1@���ع~���:w����򻨪x�ݟ�_l�����,�-+f��.\Z��vv����s��W�Ro-<������7�PT\n��{��=��ȍD���n��L�\0��þ�\\Oتʄk��!A���+�j��s�4u�K4d��\\��̂F��B����1?��z\\�i\\l��*�Rɡ�*����\Z�t����*_�S�4o��lhQMAmp����e���p����\'��7��d����+o����*����zi�8-�?����	��^�a�Tt�@WV�E�B��5�<&�I�M�+����񛟫.����~[�G��~�u圲�����ׅ����&�K��÷J���_5�ͳ�c�[�/���o_�3R=?�X��\0P\\f}�	���5����KJ\"9��blp�I3��$6��NS��j��Y�Q�_��G��7�OjZ䉀K��Cafaϒ%���4��˼9���w/*i�~�-K�N����5YPI�ڹ�<=�K���/Rl�-�B�2�4L��w���4o6�t�k��׫�g\r�bBk���\nׇ�!wό��fǦ�}��P��E)�2�\rş��Dڕ|.��,��.}Rޘw����_�ݏސ[�j�G����s�~�j�s�f�H6����O��뱛���jJ�����U�ea�d��\'���W�,�J�������{���T}���s&B�%��G�V\r��j�<{��`-y���7�F�u�=�un�#�tލ��V_�ჿ�%\\h����qޞ[�$�%=�M���?D�5��6k��Ě�p���FO��ukF���V��E�+l��]�d2�e%/3,�*�|q���{�L03�Y��T�gf^�����Ұ���\nkG�`M��Y^���E�����a~��)�Y����\Z��C�>��)�/�ѭrC�FO�Q���;Ԯ�~�A�)��8\'�4���Q�O�k:\\�ǌ�2��5$ߍ���p�[|Y9�h�R���M���6��hR\\����,B������\'��U�oޤ~w�8u��#ռ1���cz�	�\\������}��R\'u9X��K�5���{��V;wlS��诏�H�d5�_7]U��Щ�#���{o�%?VJ̝��ۿ���Ϝ�N��Su��n�!��gB����g�x�Q�3{��������6�0��w]@f&��)�eR�|��f^\\�D�Wp�������9k���zf��rYL��h߮u���pxmw�*�0_���	�m��*\0`�具��=j���GM;�u��ꄎ?)/<S&�x��>���0�hu��+����Ъ�9I^�\n������Z��3_z�sN�{����g�3N�9�D&\Z��F��n^tN0ތm���H �\"p������\n\"�8����K�-[Q��ح[�P��ª�%Z�R���%���\'�nŦ�S���~1��:����2���_:��:dwu��Q�|��z~�2�p��\0`߶w�<����u���gZz����Q��.={L���z�N��_8�\'c^��E���g[�WjH��w��\r���A4����8��Z�a.a&��N�؁�`�޿:������1?U���G]XZx3��l/\0�������U~��۫�&��ܷ7�d����3\'�\r�x�3��)9�;�ż��%U\Z:\\D��>?.�VS�%!x.v=*��1]zJ�6C����\r;��b��q|�L�_�Nc�.8\0�k/m�kr�,�q��P��Sa/v�Zk/��?���i���ԕ睪�{kS�#�w�>��3�T�^uY�3�Yo^sN�c^\\�6�b=��e�X[�,4�3Q)�G�\Z׭M�P��b�\n饱�E�����3ͅ�7����=�?�,�;�f����v\r�A���_sM�\Z��4A��ׂK���Qh�2�_;u�Y��g<\'���yG�����B���أ�Ft�$$��f����J=~~�h����T�v���Y\'~�\\4B1���[^S./��9��V3��~9���{�\05uh��.�1�K�r�����IǪ�J��q�b�����fp}��&�g���J�8{R?5i���g�U����/x�U�/p\Z��ڧ>y�D�i��֔����7a3���p�%O28r��Qw&l���ˬ+L�K㋿�W���j�띷�Ps/���@t�Y��??.`�3�X5c\\��ݷ�.���o|��������_W��i,`���Z�M�yy��K~ٝ+��j,��3�l�/���0�ds%���.�\"g�d=��|���`08�	S9�Nմ���A\r�\\��O$[��>~�n��\rA�+��쓏�;��m���K��W�\'�]�.qڊ�^�Vf����ϮU�������-�$���ۖD>�76�O�����܃a��åG\nI��G$��\Z��7}��\Z0��}.�!E�r_��r7�nJt���\'nU��gI�G��b���mj�捡�x����]�R��|��/S�\\��U�k����5�O*���/ݯ�z�梶0�ȻD�f�������&(�\'�>}G��z���9\'�,�a����j����a���<p�{���g㻇=9@6�`,�\\�>|8�E�ax\\��_��Z�?����ZP���fn��s.KΙA\r�����2\\19�4�D6ɺ�L���U$�B�$p���|� �eK�KJ_�{@�_sQ+�K�`w*\r$���mVj9r��Э����i�Ç�F�>��㌗�en��XS�%m�\n	�n�m~����@�����\",<�\\���h���a\Z~7�\0��J�u^L��$�Tj��!6��;~]�dVjHB�	.�C�M�Vp�����+I����l���2�-1	�]��;��|�����î֯���ekZIİ���kZ}׽/>�Pp%�����`~9n�K�����_uE���IX��V��zb��V�PrzO3�u�I���c+a�}aC��Z\r�<0{J.�u�h�(�`�n��<\\�<z�*�i((�[Z�\rk�C=4��k1�Z�����W�5\\I��Ǟ�`\\���l0-u�t�����0\re�$�-B������#\'E�����p�����^6�sP$ХK�V���l��ɓI�;��j\r3���vf�+ꖓ�E�c2����g�2RH��]�b��V:\\z�8]�r�TO\"a�a����.�5���O#��-\\��z�q\"�W����.�V~�4ԭ}�d���pd���y���e�\ZY{\'�r1�5:\\I\"�T�q�A�冘���m�^KX�B��å�Z�AX� �|�èKǳ�1��/\nWN�~+f<��.��3��tҺ/�VǓ��J���#���2��X�i�\Z��\'&�p�s�}��\0�F��p=��I�yEt�Z6Hj<e�Ի�Sa��s^�(4�\"�N^��&_2cJ��\Z:\\D\r%��(p%	fHE�K�P^��cn���H�K��>���P�^,�wa�\Z�oT��38��å��\\,���y)w*\\����j�:$����.�ش�a�J̐[(O�թͼ�U�y�m�\'�\\�&�l����ԝ�F�\Z��YzN�K*�I 7\n\\��䷤�`�	\ZP�@��$�5\\�1	ɣq�;s18@\'Cם1�	�B��J�Ӿ76D��\"H@�T��d���+��[���\rS�������2/�N��Y�,�]9������Z���I�$\r���<p�w��-�����df~K�C�;�_.>��,�\\6��ALC\n;]��U���4p�ZA������;p��������ބ��KJ��:Cs|�W疣�I\nx�}��<ֻK�[���-7�l�˯(�c��\\�;�v���U�n��n�qvy���c(w��U�d2G$���U��#�D&�!Bb9.�*ꂋ<&�%�Kpq|�b!��2\\d楧�ܛLB�p�;\\�K&��m����\r�f-��ڟ��P����zܨRI�\'.�ڼ1E���_M�pUR����`*8�[�c�0)\\�J&\\a`�>S��D�m|�\Z5�~?�kQ��>�K��\"��V9��\'s+�ϑ�.O��Ko�fv�b����:��,t��Z�V�梏�kDS�cz�m��Y��:Y��c��.M���g1צ�pU	.v1���s��\'�Lt?���\ru[p,�\\35�4�@��u�Vau�v��zD������<�P���3��9j$�J����.��f73\'pӍWg�ٓ#�����~����� ��V�ݦK��2�0��)t�oI�yHV�o;�O%����c�.��ܷ�[���s��\0�kd5��Vk����߿����|��&<����I��#2>y<�_(�(k�A4@�Dz)ȝ^E�wE]��������bf�9�=$�o���Q��\nBy��oTN��*r�����ea��Ua��\'�2	m�G� ��d����.�êm��bN��~W�^y��?>�0�fh��@G��	�PW.�L7	��o.�Y�\r0���9$���]���U���߲%�1�L�W+o��\n	�?���5M����t�-��-�;�$q,ݛ\\���[L\Z.��M(��ȑ\0��4,�F(D��-C\\-��OX*z~�&y7��]�H7 !�7������$�y�FȢ�ː���ib暹5�;o��\Z�4�1;��o�L�xI�\'���7I�K?Ґ�`μ$���]Ӻ��)��{	��+���k`#�}�q�w�LB=�U$S��e�d�˽i���S\n��p�T�\'	l��4,��[+�y�\r�p�6$o�\Z�o��a���bJ��F\rd4\\z�^W�uB�*u�z9|)�T�s�K���\\�=��T6�HR�e�ĥPW*2����p9��]��d�P�k�@�4K�|�ȉj�������	��iB�����w|G��B�ze0͠��.��\r��Z�\Z�FB3��M�dJ�r�\0 �t>^�-şQ>b��^���\"�.��~ot��4p�.ݴW���C�\0���W�q�f�ZMW\Z��ˡ���$Z+�\'x�2�^N��:6�i�L��)�M<=\\5���֐�Td�~�B��䵊pT��Ua�ӯE���H��֒<w��pe�ѥb���(���W���-W���q����kI���%_U��?�\\��A��,ʥ������ߞ�&7�\'��0�x�ܵ��qy-i��l�`S�eIq�֣3/�!�Ŋ����/����o�蠇+�m[\\r�^Ml\0\r�����юz����^��6���ᲄ��\r�Eh�V��Z��ﶊ��th�p��f�܈:R���pUX�&��z_Y7�,E�����nWճa���XI�݃��́�X����\0G3�;)�����\\=��o��\Z�H��f�ey�R���S\'��a��(�<V�O�p������{�� ��a�f�d��B��py��J���b�dXh���\0��e�l<\\��p�n��Aa�U\Z0X��63����r;������ŗ��K?>!��f&0[���0<:\\���#�]����o�;j���V��43��5��̃�QA�M�s�f�/��w����o<`���ܳk���ۿW�:wbd�����Sp�E�� Al������l����}�ѿ�z�p�6���B�/\0��{b��?mI��\"��z\0\'.��_U��W_�py�~���zU�^?|������b���>	�4���!9�Â�2z\r��S��ն��q�<d��py�,��W`�Ť�-���@���\nT��Ҽ\',y�ay��|\00a\\^��~ѩ��P%�\'?L���VҨ��ݏ�R�|�A�x�ay��|\0L_+��n���hm�z�a��SV���.`}�g��x���?{����i��*��Xd.����h��QK3Qju��ڿ1���G}�o�����{�f�?ݱR���M�����\n��\0��~䆪��#ڊ�^hO�e�����/LñcF��3/VK�[��jT�m�2u����y眥N:q��ԩ���T�W��T�z�ZZm����e��\\L@�9i���ԩS��9�ԓՌ��S�^lp�ʍX����j����M��*}}����5HY���2�����Ֆf�2���؜�!q*}=��Cjܸq��OV���W]�vm5ltS&�6>6@W�����Q�<�iȐ!j̘1�N��u�]*��:fS�E+���\0L�w�&��ȝ]�Mk��*4�׻�d2>���Jy�E��ݻ����=z\"s��᪓fb�c\"�	�իW\0���9�;j����|51`���h��~?#�:��vU�����JQ�͛7[�a�c~\0M4�	����<���Z�>�i�1)�4r�H5y����E��l�2��?��ukRA&�$W��]�jށ,&f�J�/�ؐ���[�NM�8QM�2%.ݢ@&L��N;�45x��`�4�H��\"��RD�����]1�Y�f�j�0?�˽����\0M�����\\nl��h��,Y�N=�Tu�g8�e\n���k���֒W���u��N����$\n.d۶m�Z�/���>Y{s�=�.�|�;�T��ܳ�a��W��6cǎ\r�m��p��fÌԵ\Z�v�@k�Sމ���$p�\\�RU���g��7>TFP��B�eEPD���|o���ﾩ��oܸ1\0+k�\\@�oz��i�Rz0��J�.2�D�l���o߾���ݻi]��>B�l1�W,%��v\"�ERri{_z\\}�ŧ�گ9s��b�4�_��Y̵D!1�}	�\0Y��i-���(��G��PI%ng��\nɻh�=�-�e�g&����V�z����`�$�,*|r�π�\r�֐�.�`�\\P�YP)\\�~�aM\0cQ�߼�.E�����V6�%r�Yg�.� =q͆^+����>�����f*d)�l|V��ȤѪ�K|�Z�����5}>��҅�|��h#�L���!��AP͵�J7\r�L���������_5��}o����@빷�k��\r.�	����A\nS�e>�\0F��-���<X5abB�@&���e���6��j7�y������/��>Ў�x����B���Wؿ?�����ѣز\\\'��]$�Z\r����J�g=@�@1Ço39�K1������k���R�(෻���lA]��d��^dmD��.�F�Rg�yffZ��=��b-�XȑuX��$@18Q�!p�K���$�~����\"���Př�\"z����\rr�K,��6l����*�)\\�����ZC�s%�\0�C��,��ݵ�-��ͮ-�� �e0�j�*\' d�e�;�R�eB[i���u�q��%-֒e�J�h�,�{2pq\Z*Jd��������<�\0�\rE���Z�5:��IN9唊��}4,��f�Q#[�-�.���s5� ��Fz\0��uI�*L���1��U�o\\�>9�D�g��ۗ7�满�ì\0S�(��:Æ\r�.2ݿs	��%Vw�8k×8p`\0���DK1 L�ݧO��!��\\�eG����;�	���[�Vd���Y��7}��D�a渢,�J�YS��.f�X|.�,&�9*�Z�H�%�rbz�|Y���`	Ǜi\0�߭e�F�D���\0�P�th�<�Y�*\rև��qDV�\Z3�Tp�\"�\\�lUz��@��k1�8̶�������0���i1`��k�����C�]�$+�?�&-e���eVs���D$;���j��СC�Dm9�(�U�_��SF&K�Zi�-[����^��D�ց-&������e�&�\\\\��\n�7Ȯ\0d���**b�.��UR������_]U�\\aU\Z��Y��M�i\Z|�V3�$�V�g�\\�9�ݺuk�;1�i�S(�0�Ν��U�1~R�qi�޽�W�D��+k��&aT�AT���Hڍ��� 6�K�I�M\0�#��a%;/;wV��>�Lm�����\n�S�S[�nU/��R�m\0+id0�K���\'\\�G1.\'+>b��F*���Ku����� �ѠJ��YUp��\r����2�K�������^{-hm��w��,D�-u%�\\V9Pֆ�����Tn���Ĉ\nb���q�~���]��m͎�n�K�*ZZ�X���n���W%AS�����2��4/:6\rDX(5��y�Ǐ|ZĦĒa��.�Q�Yr��.U�J$�^-iC�QG�e��ಸ��z\r�^c�O8\0~ߗ��ɤ�.%>�,�}�4����|��6=�f��l�\'�����h�`\0c\"�غK?IƟqf��`F�Z�j���\\�y�:|몽Z�h�(_K��@&�w�޹j��lm�M��^Eoj�$\'��L[���[RX���6fh��\'��25�^��*�H*��B�c�Z�w	�8&�y*�3�K\"�a�;��\0,J�Tԡ�Zf�m�Ѩ=T�軮��|��@\Z$���e�Lf�ZI4��F�oױ�D���.�-���Ф�S��k9餓ʮ��<噢|/���Dpq,:,�bүQ���=��|U�S�\\b�����K�cT���ݻ����\0H�\\Z�G���&Y`i�/�{�!(c�f.\\����c}= a��<�i��.E��p��-�7jw�c��P��%�\"f�~�3��m���]��9Z�ż��B~7ɋ@�}��癔5�f\"c\'f\"�N��^QpzءY�\"A����.9Rb+���f�$P�ip�b�	#�H86mrSO2���|��%��(\nZ��/,��*)k2M*���,F|���?k9n�m�;�>�u�m�4�!!�8��]\"O�+����%�U����9!4z�IH�S�B*=��������Ɛeh��ԫ��6���Z�cF]��-I��غ7�NȈ#r5�Lv�Ν[�FF�ߕȆ\r\"˟�L\"\'���7o^U�Vv{q��8�_\r��j��<�u/foT`��5�a+�M��fs#�|�QZ_�E��+ʲ�0Ie��;�6�h-	l�3���&�̱��Q��i7_L�T�\0\0\0\0IEND�B`�');
/*!40000 ALTER TABLE `tbimagem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblaboratorio`
--

DROP TABLE IF EXISTS `tblaboratorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblaboratorio` (
  `idLab` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nomeLab` varchar(45) NOT NULL,
  `capAluno` int(10) unsigned NOT NULL,
  `numComp` int(10) unsigned NOT NULL,
  `statusLab` enum('Ativo','Inativo') NOT NULL,
  `idCor` int(10) unsigned DEFAULT NULL,
  `subRede` varchar(25) NOT NULL,
  PRIMARY KEY (`idLab`),
  KEY `idCor` (`idCor`),
  CONSTRAINT `tblaboratorio_ibfk_1` FOREIGN KEY (`idCor`) REFERENCES `tbcor` (`idCor`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblaboratorio`
--

LOCK TABLES `tblaboratorio` WRITE;
/*!40000 ALTER TABLE `tblaboratorio` DISABLE KEYS */;
INSERT INTO `tblaboratorio` VALUES (1,'Laboratório de Graduação 01',60,30,'Inativo',1,'10.27.11.0'),(2,'Laboratório de Graduação 02',30,12,'Ativo',2,'10.27.12.0'),(3,'Laboratório de Graduação 03',15,8,'Ativo',3,'10.27.13.0'),(4,'Laboratório de Graduação 04',40,20,'Ativo',4,'10.27.14.0'),(5,'Laboratório de Graduação 05',24,12,'Ativo',5,'10.27.15.0'),(6,'Laboratório de Graduação 06',6,6,'Ativo',6,'10.27.16.0'),(7,'Laboratório de Hardware 01',21,7,'Ativo',7,'10.27.22.0'),(8,'Laboratório Geral de Estudos',34,17,'Ativo',8,'10.27.21.0');
/*!40000 ALTER TABLE `tblaboratorio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbmatricula`
--

DROP TABLE IF EXISTS `tbmatricula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbmatricula` (
  `idUser` int(10) unsigned NOT NULL,
  `matricula` varchar(12) NOT NULL,
  PRIMARY KEY (`idUser`),
  CONSTRAINT `tbmatricula_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbmatricula`
--

LOCK TABLES `tbmatricula` WRITE;
/*!40000 ALTER TABLE `tbmatricula` DISABLE KEYS */;
INSERT INTO `tbmatricula` VALUES (1,'201310009998'),(11,'343243435443'),(12,'201320001598'),(13,'201320001598');
/*!40000 ALTER TABLE `tbmatricula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbnoticonexao`
--

DROP TABLE IF EXISTS `tbnoticonexao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbnoticonexao` (
  `idUser` int(10) unsigned NOT NULL,
  `idNoti` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idUser`,`idNoti`),
  KEY `idNoti` (`idNoti`),
  CONSTRAINT `tbnoticonexao_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbnoticonexao_ibfk_2` FOREIGN KEY (`idNoti`) REFERENCES `tbnotificacao` (`idNoti`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbnoticonexao`
--

LOCK TABLES `tbnoticonexao` WRITE;
/*!40000 ALTER TABLE `tbnoticonexao` DISABLE KEYS */;
INSERT INTO `tbnoticonexao` VALUES (9,20),(10,20);
/*!40000 ALTER TABLE `tbnoticonexao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbnotificacao`
--

DROP TABLE IF EXISTS `tbnotificacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbnotificacao` (
  `idNoti` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `notificacao` text NOT NULL,
  `statusNoti` tinyint(1) NOT NULL,
  `expiraData` date DEFAULT NULL,
  PRIMARY KEY (`idNoti`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbnotificacao`
--

LOCK TABLES `tbnotificacao` WRITE;
/*!40000 ALTER TABLE `tbnotificacao` DISABLE KEYS */;
INSERT INTO `tbnotificacao` VALUES (3,'<li>\r\n                      <a href=\"noti.php?id=0&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(4,'<li>\r\n                      <a href=\"noti.php?id=4&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(5,'<li>\r\n                      <a href=\"noti.php?id=&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi \r\n                      </a>\r\n                    </li>',0,NULL),(6,'<li>\r\n                      <a href=\"noti.php?id=&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi \r\n                      </a>\r\n                    </li>',0,NULL),(7,'<li>\r\n                      <a href=\"noti.php?id=&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi \r\n                      </a>\r\n                    </li>',0,NULL),(8,'<li>\r\n                      <a href=\"noti.php?id=8&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(9,'<li>\r\n                      <a href=\"noti.php?id=9&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(10,'<li>\r\n                      <a href=\"noti.php?id=10&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(11,'<li>\r\n                      <a href=\"noti.php?id=11&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(12,'<li>\r\n                      <a href=\"noti.php?id=12&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(13,'<li>\r\n                      <a href=\"noti.php?id=13&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(14,'<li>\r\n                      <a href=\"noti.php?id=14&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(15,'<li>\r\n                      <a href=\"noti.php?id=15&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(16,'<li>\r\n                      <a href=\"noti.php?id=16&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(17,'<li>\r\n                      <a href=\"noti.php?id=17&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(18,'<li>\r\n                      <a href=\"noti.php?id=18&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(19,'<li>\r\n                      <a href=\"noti.php?id=19&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(20,'<li>\r\n                      <a href=\"noti.php?id=20&ir=/perfil/2/\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-retweet text-aqua\"></i> Usuário requisitou a troca de sua senha\r\n                      </a>\r\n                    </li>',1,'2016-02-22');
/*!40000 ALTER TABLE `tbnotificacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbonline`
--

DROP TABLE IF EXISTS `tbonline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbonline` (
  `idUser` int(10) unsigned NOT NULL,
  `tempoExpirar` datetime NOT NULL,
  `sessao` varchar(30) NOT NULL,
  `senha` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idUser`),
  CONSTRAINT `tbonline_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbonline`
--

LOCK TABLES `tbonline` WRITE;
/*!40000 ALTER TABLE `tbonline` DISABLE KEYS */;
INSERT INTO `tbonline` VALUES (1,'2015-12-10 15:19:00','9j6rvkkmd358hj9atc641khn82',NULL),(2,'2015-11-17 18:36:13','n8cf99al8nth6k58oojdj7j2t5',NULL),(3,'2015-12-14 16:52:32','7hj012h6hloqvscp66g60s4jv2',NULL),(9,'2015-11-17 18:09:59','3glc456ei4n72etcjh4uatl7d1',NULL),(10,'2016-06-08 17:42:54','8ce2g5m4l42hp0ra6f4aajhg35',NULL);
/*!40000 ALTER TABLE `tbonline` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbprimeiroacesso`
--

DROP TABLE IF EXISTS `tbprimeiroacesso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbprimeiroacesso` (
  `idUser` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idUser`),
  CONSTRAINT `tbprimeiroacesso_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbprimeiroacesso`
--

LOCK TABLES `tbprimeiroacesso` WRITE;
/*!40000 ALTER TABLE `tbprimeiroacesso` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbprimeiroacesso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbrequerimentos`
--

DROP TABLE IF EXISTS `tbrequerimentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbrequerimentos` (
  `idReq` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(10) unsigned NOT NULL,
  `dataReq` date NOT NULL,
  `conteudoReq` text CHARACTER SET latin1 NOT NULL,
  `tipoReq` int(11) NOT NULL,
  `statusReq` enum('Pendente','Negado','Aprovado') CHARACTER SET latin1 NOT NULL DEFAULT 'Pendente',
  `justificativaReq` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idReq`),
  KEY `idUser` (`idUser`),
  CONSTRAINT `tbrequerimentos_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbrequerimentos`
--

LOCK TABLES `tbrequerimentos` WRITE;
/*!40000 ALTER TABLE `tbrequerimentos` DISABLE KEYS */;
INSERT INTO `tbrequerimentos` VALUES (1,1,'2015-08-27','teste/+12/mm/yyyy/+10/mm/yyyy',1,'Negado','hgfhgfnbjmhbnvb');
/*!40000 ALTER TABLE `tbrequerimentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbreservaeq`
--

DROP TABLE IF EXISTS `tbreservaeq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbreservaeq` (
  `idReEq` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idUser` int(10) unsigned NOT NULL,
  `motivoReEq` varchar(255) NOT NULL,
  `tituloReEq` varchar(255) NOT NULL,
  `expiraReEq` date NOT NULL,
  PRIMARY KEY (`idReEq`),
  KEY `idReEq` (`idReEq`),
  KEY `idReserva` (`idUser`),
  CONSTRAINT `tbreservaeq_ibfk_3` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbreservaeq`
--

LOCK TABLES `tbreservaeq` WRITE;
/*!40000 ALTER TABLE `tbreservaeq` DISABLE KEYS */;
INSERT INTO `tbreservaeq` VALUES (1,3,'vnmbcxvhgcxb','gnbxxbncn','2016-03-07'),(2,3,',mb,bnmnvmbjncb','jhfjbvnbvn','2016-03-07'),(3,3,'gshhdvbxc','gnbcvbxvcn','2016-03-07'),(4,3,'kfnlkgdnglsnf','tefkdg','2016-03-08'),(5,3,'dsfsgdfas','sgfgsfgfdfasd','2016-03-22'),(7,1,'fgfdvhgsbnvbmfgd,kdbg nvcgdvfdbnv nvfdhfgbnhtn','tgrsfhfsdvncvbbf','2016-04-04'),(8,3,'fvbbxczvnbxzvb','gfsdavcxfvcb','2016-04-04'),(9,3,'fvbbxczvnbxzvb','gfsdavcxfvcb','2016-04-04'),(10,3,'ngdsngdnvdscb','gfshzbvc','2016-04-04'),(11,3,'cvznxcvnvcxbvc','ngvbc ncn','2016-04-04'),(12,3,'cvznxcvnvcxbvc','ngvbc ncn','2016-04-04'),(13,3,'cvznxcvnvcxbvc','ngvbc ncn','2016-04-04'),(14,3,'cvznxcvnvcxbvc','ngvbc ncn','2016-04-04'),(15,3,'cvznxcvnvcxbvc','ngvbc ncn','2016-04-04'),(16,3,'cvznxcvnvcxbvc','ngvbc ncn','2016-04-04'),(18,10,'bacsbdvbxvbs','thfsdhfddvbc','2016-04-18'),(19,3,'vdbfvw','teste','2016-04-18'),(20,3,'dfojbgkjas.dnggdag','t01','2016-04-20'),(21,3,'fgofegjlsdfhgskfhgggafg','t02','2016-04-20'),(22,3,'fgfsgfsgsfgdf','teste 1','2016-04-23'),(23,3,'gfdgsfdgf','teste 2f','2016-04-23'),(24,3,'gfsgfdgdf','teste 3','2016-04-23'),(25,3,'gfdsgfds','teste 4','2016-04-23'),(26,3,'fdsgdfgfd','teste 4','2016-04-23'),(27,3,'sfgfgsd','teste 5','2016-04-23'),(28,3,'sfagfsagfagag','teste 6','2016-04-23'),(29,3,'emrekjhgdklmhbgf','teste 7','2016-04-23'),(30,3,'rfhsgdhghdgh','TESTE 08','2016-04-23'),(31,3,'dskjkgbsdkjgnjsdg','teste 09','2016-04-23'),(32,3,'djbgkjfsdhgkfsngdfgg','teste 10','2016-04-23'),(33,3,'gsdgfdg','tyhtehyfdg','2016-04-25'),(34,3,'gsdgfdg','tyhtehyfdg','2016-04-25'),(35,3,'gsdgfdg','tyhtehyfdg','2016-04-25'),(36,3,'ghfghgdhfdvbd','teste 03','2016-04-25'),(37,3,'ndkmgnfdkjsgnfg','teste 04','2016-04-25'),(38,2,'çjdabgsdkjfgfs','thdkjvzm','2016-05-15'),(39,3,'fknzvdbvvcx','teste 02','2016-05-22'),(40,3,'wrthyrehbfd','teste 03','2016-05-22'),(41,3,'dfgsgfsdd','teste fgndkf','2016-06-07'),(42,3,'gdsgfdgdsfgds','rwtregfg','2016-06-07'),(43,3,'fdfasdfdsfas','teste 01','2016-06-07'),(45,3,'fdsjgnkflsng','teste 03','2016-06-07');
/*!40000 ALTER TABLE `tbreservaeq` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `ExpiraReEq` BEFORE INSERT ON `tbreservaeq`
 FOR EACH ROW set new.expiraReEq = date_add(current_date(), interval 180 day) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `tbreservalab`
--

DROP TABLE IF EXISTS `tbreservalab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbreservalab` (
  `idReLab` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idUser` int(10) unsigned NOT NULL,
  `motivoReLab` varchar(255) NOT NULL,
  `tituloReLab` varchar(255) NOT NULL,
  `tipoReLab` enum('Privado','Compartilhado') NOT NULL,
  `numPc` int(10) unsigned DEFAULT NULL,
  `expiraReLab` date DEFAULT NULL,
  PRIMARY KEY (`idReLab`),
  KEY `idUser` (`idUser`),
  CONSTRAINT `tbreservalab_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbreservalab`
--

LOCK TABLES `tbreservalab` WRITE;
/*!40000 ALTER TABLE `tbreservalab` DISABLE KEYS */;
INSERT INTO `tbreservalab` VALUES (1,3,'gdsgdsfd','teste','Privado',0,'2016-03-06'),(2,3,'fdzbvxzbxcvzx','cdvsvgdsfbfgdfshv','Privado',0,'2016-03-07'),(3,3,'gfghmvhjvhb','khghjvbvee','Privado',0,'2016-03-07'),(6,3,'bvxcbcvbvcx','bhvxbvzbv','Privado',0,'2016-04-11'),(11,3,'gfhngfnbdv','teste 02','Privado',0,'2016-04-24'),(12,3,'fhdshggngnf','teste 03','Compartilhado',1,'2016-04-24'),(13,3,'wkfnblsgdknhdf','teste 04','Compartilhado',1,'2016-04-24'),(14,3,'dwfasgdsgadsfg','teste 05','Compartilhado',2,'2016-04-24'),(15,3,'Ndlkfgnfdsglknfdgda','dfgstgsgmK','Privado',0,'2016-04-24'),(16,3,'dfhdfgdgsh','teste 01','Privado',0,'2016-04-25'),(17,3,'dkngaflsngdskng','testeX 01','Privado',0,'2016-05-01'),(18,2,'vbxvcbvcxb','gdfvsdbvc','Privado',0,'2016-05-15'),(19,3,'fdfdsafd','teste chang','Privado',0,'2016-06-07'),(20,3,'dfsdafdsfasdf','teste 01','Privado',0,'2016-06-07'),(21,3,'dfsdafdsfasdf','teste 01','Privado',0,'2016-06-07'),(22,3,'dfsdafdsfasdf','teste 01','Privado',0,'2016-06-07'),(23,3,'dfsdafdsfasdf','teste 02','Privado',0,'2016-06-07'),(24,3,'dfsdfdsfad','teste 03','Privado',0,'2016-06-07'),(25,3,'dgisafnbkcs,v','teknfdsvn','Privado',0,'2016-06-07'),(26,3,'dgisafnbkcs,v','teknfdsvn','Privado',0,'2016-06-07'),(28,3,'dgisafnbkcs,v','teknfdsvn','Privado',0,'2016-06-07'),(29,3,'fjbgmndgisafnbkcs,v','teste 05','Privado',0,'2016-06-07'),(30,3,'dwjobgjfjgdsgvsdfgc','testeX 02','Privado',0,'2016-06-08'),(31,3,'feooghflkdngd','testex 02','Privado',0,'2016-06-11'),(39,3,'fgjafdkbndkbsgdb','testex 03','Privado',0,'2016-06-11'),(40,3,'fgjafdkbndkbsgdb','testex 03','Privado',0,'2016-06-11'),(41,3,'fgjafdkbndkbsgdb','testex 03','Privado',0,'2016-06-11'),(42,3,'fgjafdkbndkbsgdb','testex 03','Privado',0,'2016-06-11'),(43,3,'fgjafdkbndkbsgdb','testex 03','Privado',0,'2016-06-11');
/*!40000 ALTER TABLE `tbreservalab` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `ExpiraReLab` BEFORE INSERT ON `tbreservalab`
 FOR EACH ROW set new.expiraReLab = date_add(current_date(), interval 180 day) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `tbreservasala`
--

DROP TABLE IF EXISTS `tbreservasala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbreservasala` (
  `idReSala` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idUser` int(10) unsigned NOT NULL,
  `idSala` int(10) unsigned NOT NULL,
  `motivoReSala` varchar(255) NOT NULL,
  `tituloReSala` varchar(255) NOT NULL,
  `expirarReSala` date NOT NULL,
  PRIMARY KEY (`idReSala`),
  KEY `idUser` (`idUser`),
  KEY `idSala` (`idSala`),
  CONSTRAINT `tbreservasala_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbreservasala_ibfk_2` FOREIGN KEY (`idSala`) REFERENCES `tbsala` (`idSala`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbreservasala`
--

LOCK TABLES `tbreservasala` WRITE;
/*!40000 ALTER TABLE `tbreservasala` DISABLE KEYS */;
INSERT INTO `tbreservasala` VALUES (1,10,4,'rgfdgfdgdsvb','teste dvvnskfn','2016-05-24'),(2,10,4,'rgfdgfdgdsvb','teste dvvnskfn','2016-05-24'),(3,10,4,'dpghfljkagdsg','teste 1','2016-06-08'),(4,3,4,'fdskgnkfdlgfgds','teste 3','2016-06-08'),(5,3,4,'dgnskflgnsf','teste 4','2016-06-08');
/*!40000 ALTER TABLE `tbreservasala` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `ExpiraReSala` BEFORE INSERT ON `tbreservasala`
 FOR EACH ROW set new.expirarReSala = date_add(current_date(), interval 180 day) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `tbreservatipoeq`
--

DROP TABLE IF EXISTS `tbreservatipoeq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbreservatipoeq` (
  `idTipoEq` int(10) unsigned NOT NULL,
  `idReEq` int(10) unsigned NOT NULL,
  `numReEq` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idTipoEq`,`idReEq`),
  KEY `idReEq` (`idReEq`),
  CONSTRAINT `tbreservatipoeq_ibfk_1` FOREIGN KEY (`idTipoEq`) REFERENCES `tbtipoeq` (`idTipoEq`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbreservatipoeq_ibfk_2` FOREIGN KEY (`idReEq`) REFERENCES `tbreservaeq` (`idReEq`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbreservatipoeq`
--

LOCK TABLES `tbreservatipoeq` WRITE;
/*!40000 ALTER TABLE `tbreservatipoeq` DISABLE KEYS */;
INSERT INTO `tbreservatipoeq` VALUES (2,3,1),(2,7,1),(2,9,1),(2,25,1),(2,33,1),(2,34,1),(2,35,1),(2,38,1),(2,42,1),(2,43,1),(3,18,1),(3,19,1),(3,20,1),(3,21,1),(3,22,1),(3,23,1),(3,24,1),(3,26,1),(3,27,2),(3,28,2),(3,29,1),(3,30,1),(3,31,1),(3,32,1),(3,37,1),(3,39,1),(3,40,1),(3,43,1),(3,45,1);
/*!40000 ALTER TABLE `tbreservatipoeq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbsala`
--

DROP TABLE IF EXISTS `tbsala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbsala` (
  `idSala` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nomeSala` varchar(50) NOT NULL,
  `numPessoa` int(10) unsigned NOT NULL,
  `statusSala` enum('Ativo','Inativo') NOT NULL,
  `idCor` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idSala`),
  KEY `idSala` (`idSala`),
  KEY `idCor` (`idCor`),
  CONSTRAINT `tbsala_ibfk_1` FOREIGN KEY (`idCor`) REFERENCES `tbcor` (`idCor`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbsala`
--

LOCK TABLES `tbsala` WRITE;
/*!40000 ALTER TABLE `tbsala` DISABLE KEYS */;
INSERT INTO `tbsala` VALUES (4,'teste 02',43,'Ativo',1),(5,'teste 03',32,'Ativo',2);
/*!40000 ALTER TABLE `tbsala` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbtelefone`
--

DROP TABLE IF EXISTS `tbtelefone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbtelefone` (
  `idTelefone` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idUser` int(10) unsigned NOT NULL,
  `numTelefone` varchar(13) NOT NULL,
  PRIMARY KEY (`idTelefone`),
  KEY `tbtelefone_FKIndex1` (`idUser`),
  CONSTRAINT `tbtelefone_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbusuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbtelefone`
--

LOCK TABLES `tbtelefone` WRITE;
/*!40000 ALTER TABLE `tbtelefone` DISABLE KEYS */;
INSERT INTO `tbtelefone` VALUES (1,1,'(79)9988-7766');
/*!40000 ALTER TABLE `tbtelefone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbTempoRe`
--

DROP TABLE IF EXISTS `tbTempoRe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbTempoRe` (
  `idReLab` int(10) unsigned NOT NULL,
  `dataInicio` date NOT NULL,
  `dataFim` date NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFim` time NOT NULL,
  `semana` varchar(70) NOT NULL,
  PRIMARY KEY (`idReLab`),
  CONSTRAINT `tbTempoRe_ibfk_1` FOREIGN KEY (`idReLab`) REFERENCES `tbreservalab` (`idReLab`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbTempoRe`
--

LOCK TABLES `tbTempoRe` WRITE;
/*!40000 ALTER TABLE `tbTempoRe` DISABLE KEYS */;
INSERT INTO `tbTempoRe` VALUES (17,'2015-11-03','2015-12-18','10:00:00','12:00:00','Seg,Qua,Sex');
/*!40000 ALTER TABLE `tbTempoRe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbtipoeq`
--

DROP TABLE IF EXISTS `tbtipoeq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbtipoeq` (
  `idTipoEq` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tipoEq` varchar(15) NOT NULL,
  `numEq` smallint(6) NOT NULL,
  `idCor` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idTipoEq`),
  KEY `idCor` (`idCor`),
  CONSTRAINT `tbtipoeq_ibfk_1` FOREIGN KEY (`idCor`) REFERENCES `tbcor` (`idCor`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbtipoeq`
--

LOCK TABLES `tbtipoeq` WRITE;
/*!40000 ALTER TABLE `tbtipoeq` DISABLE KEYS */;
INSERT INTO `tbtipoeq` VALUES (2,'Caixa de som',1,2),(3,'Projetor',2,1);
/*!40000 ALTER TABLE `tbtipoeq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbusuario`
--

DROP TABLE IF EXISTS `tbusuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbusuario` (
  `idUser` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idAfiliacao` int(10) unsigned DEFAULT NULL,
  `login` varchar(20) NOT NULL,
  `cpf` varchar(100) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `nomeUser` varchar(45) NOT NULL,
  `nivel` int(10) unsigned NOT NULL,
  `statusUser` enum('Ativo','Inativo','Bloqueado') NOT NULL DEFAULT 'Ativo',
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idUser`),
  KEY `idAfiliacao` (`idAfiliacao`),
  CONSTRAINT `tbusuario_ibfk_1` FOREIGN KEY (`idAfiliacao`) REFERENCES `tbafiliacao` (`idAfiliacao`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbusuario`
--

LOCK TABLES `tbusuario` WRITE;
/*!40000 ALTER TABLE `tbusuario` DISABLE KEYS */;
INSERT INTO `tbusuario` VALUES (1,2,'aluno',')?ä5ØBJG£e	U¶ÇÛ','123','Aluno',4,'Inativo','abc@xyz.com'),(2,1,'professor','123','123','Professor',3,'Ativo','abc@xyz.com'),(3,5,'secretaria','','123','Secretaria',1,'Ativo','abc@abc.com'),(4,3,'aluno3','','LaLev-%b','Aluno 3',4,'Inativo','abc123@xyz.com'),(5,4,'aluno3','','w6jW81rP','Aluno 2',4,'Ativo','abc@xyz.com'),(6,5,'secretaria2','','123','Secretaria 2',1,'Ativo','abc@xyz.com'),(7,5,'secretaria3','','123','Secretaria 3',1,'Ativo','abc@xyz.com'),(8,1,'professor2','','123','Professor 2',3,'Ativo','abc@xyz.com'),(9,1,'professor3','','123','Professor 3',0,'Ativo','abc@xyz.com'),(10,6,'admin','123','123','Adminstrador',0,'Ativo','mgcaquino@gmail.com'),(11,2,'fgdb.gdhfdhgsd','–›xu*‚°‡@ÿjýŠ\Z','O@SD4FSU','fgdb gdhfdhgsd',4,'Ativo','ø(\Z\r§;¬?ŒŠ=©ó\\`®Ÿl:O-ÃF5„=ž'),(12,2,'teste.01','48478311360','ZdiA0!M1','teste 01',4,'Ativo','mgcaquino@gmail.com'),(13,7,'teste.02','13447447532','Q4%ub-!%','teste 02',4,'Ativo','mgcaquino@gmail.com');
/*!40000 ALTER TABLE `tbusuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblabpasswd`
--

DROP TABLE IF EXISTS `tblabpasswd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblabpasswd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `passwd` varbinary(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblabpasswd`
--

LOCK TABLES `tblabpasswd` WRITE;
/*!40000 ALTER TABLE `tblabpasswd` DISABLE KEYS */;
INSERT INTO `tblabpasswd` VALUES (1,'���\0��Eb�	');
/*!40000 ALTER TABLE `tblabpasswd` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-08 16:22:21
