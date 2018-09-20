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
-- Table structure for table `tbAfiliacao`
--

DROP TABLE IF EXISTS `tbAfiliacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbAfiliacao` (
  `idAfiliacao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `afiliacao` varchar(64) NOT NULL,
  `nivel` smallint(6) NOT NULL,
  PRIMARY KEY (`idAfiliacao`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbAfiliacao`
--

LOCK TABLES `tbAfiliacao` WRITE;
/*!40000 ALTER TABLE `tbAfiliacao` DISABLE KEYS */;
INSERT INTO `tbAfiliacao` VALUES (1,'Professor',3),(2,'CiÃªncia da ComputaÃ§Ã£o',4),(3,'Engenharia da ComputaÃ§Ã£o',4),(4,'Sistemas de InformaÃ§Ã£o',4),(5,'SecretÃ¡ria',1),(6,'TÃ©cnico',0),(7,'teste dkgjdf',4),(8,'teste afiliacao',4);
/*!40000 ALTER TABLE `tbAfiliacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbAlocaLab`
--

DROP TABLE IF EXISTS `tbAlocaLab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbAlocaLab` (
  `idLab` int(10) unsigned NOT NULL,
  `patrimonio` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idLab`,`patrimonio`),
  KEY `patrimonio` (`patrimonio`),
  CONSTRAINT `tbAlocaLab_ibfk_1` FOREIGN KEY (`idLab`) REFERENCES `tbLaboratorio` (`idLab`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbAlocaLab_ibfk_2` FOREIGN KEY (`patrimonio`) REFERENCES `tbEquipamento` (`patrimonio`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbAlocaLab`
--

LOCK TABLES `tbAlocaLab` WRITE;
/*!40000 ALTER TABLE `tbAlocaLab` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbAlocaLab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbAlocaReEq`
--

DROP TABLE IF EXISTS `tbAlocaReEq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbAlocaReEq` (
  `patrimonio` int(10) unsigned NOT NULL,
  `idReEq` int(10) unsigned NOT NULL,
  `idData` int(10) unsigned NOT NULL,
  PRIMARY KEY (`patrimonio`,`idReEq`,`idData`),
  KEY `idReEq` (`idReEq`),
  KEY `idData` (`idData`),
  CONSTRAINT `tbAlocaReEq_ibfk_1` FOREIGN KEY (`patrimonio`) REFERENCES `tbEquipamento` (`patrimonio`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbAlocaReEq_ibfk_2` FOREIGN KEY (`idReEq`) REFERENCES `tbControleDataEq` (`idReEq`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbAlocaReEq_ibfk_3` FOREIGN KEY (`idData`) REFERENCES `tbControleDataEq` (`idData`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbAlocaReEq`
--

LOCK TABLES `tbAlocaReEq` WRITE;
/*!40000 ALTER TABLE `tbAlocaReEq` DISABLE KEYS */;
INSERT INTO `tbAlocaReEq` VALUES (241235435,42,139);
/*!40000 ALTER TABLE `tbAlocaReEq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbAlocaReLab`
--

DROP TABLE IF EXISTS `tbAlocaReLab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbAlocaReLab` (
  `idLab` int(10) unsigned NOT NULL,
  `idReLab` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idLab`,`idReLab`),
  KEY `idReLab` (`idReLab`),
  CONSTRAINT `tbAlocaReLab_ibfk_1` FOREIGN KEY (`idLab`) REFERENCES `tbLaboratorio` (`idLab`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbAlocaReLab_ibfk_2` FOREIGN KEY (`idReLab`) REFERENCES `tbReservaLab` (`idReLab`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbAlocaReLab`
--

LOCK TABLES `tbAlocaReLab` WRITE;
/*!40000 ALTER TABLE `tbAlocaReLab` DISABLE KEYS */;
INSERT INTO `tbAlocaReLab` VALUES (1,1),(1,2),(1,3),(1,26),(1,28),(1,30),(1,31),(1,39),(1,40),(1,41),(1,42),(1,43),(2,26),(2,28);
/*!40000 ALTER TABLE `tbAlocaReLab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbAvisos`
--

DROP TABLE IF EXISTS `tbAvisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbAvisos` (
  `idAviso` int(11) NOT NULL AUTO_INCREMENT,
  `tituloAviso` varchar(50) NOT NULL,
  `textoAviso` text NOT NULL,
  `dataAviso` date NOT NULL,
  `statusAviso` enum('Ativo','Inativo') NOT NULL DEFAULT 'Ativo',
  PRIMARY KEY (`idAviso`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbAvisos`
--

LOCK TABLES `tbAvisos` WRITE;
/*!40000 ALTER TABLE `tbAvisos` DISABLE KEYS */;
INSERT INTO `tbAvisos` VALUES (1,'Fale com o DCOMP','&lt;p&gt;&lt;b&gt;Telefone&lt;/b&gt;&lt;br&gt;+55 79 2105-6678&lt;/p&gt;&lt;p&gt;&lt;b&gt;E-mail&lt;/b&gt;&lt;br&gt;dcomp.sec@ufs.br&lt;/p&gt;&lt;p&gt;&lt;b&gt;Nova Sede&lt;/b&gt;&lt;br&gt;Anexa ao Centro de VivÃªncia da UFS.&lt;/p&gt;&lt;p&gt;&lt;b&gt;Antiga Sede&lt;/b&gt;&lt;br&gt;Ao lado do Departamento de Engenharia Civil.&lt;/p&gt;','2015-09-25','Ativo');
/*!40000 ALTER TABLE `tbAvisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbBlock`
--

DROP TABLE IF EXISTS `tbBlock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbBlock` (
  `idBlock` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idUserBlock` int(10) unsigned NOT NULL,
  `idUser` int(10) unsigned DEFAULT NULL,
  `motivoBlock` text NOT NULL,
  `dataInicio` date NOT NULL,
  `dataFim` date NOT NULL,
  PRIMARY KEY (`idBlock`),
  KEY `idUserBlock` (`idUserBlock`),
  KEY `idUser` (`idUser`),
  CONSTRAINT `tbBlock_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbUsuario` (`idUser`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `tbBlock_ibfk_2` FOREIGN KEY (`idUserBlock`) REFERENCES `tbUsuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbBlock`
--

LOCK TABLES `tbBlock` WRITE;
/*!40000 ALTER TABLE `tbBlock` DISABLE KEYS */;
INSERT INTO `tbBlock` VALUES (1,1,10,'fgnskdlgns sfkagnfdlkgnfsd fkgnksfdlng gnfdlksg lkfmsdg fkgntkdfgnfsdÃ§lf gfkds onk fgnskdlgns sfkagnfdlkgnfsd fkgnksfdlng gnfdlksg lkfmsdg fkgntkdfgnfsdÃ§lf gfkds onk','2015-10-13','2015-10-15'),(2,4,10,'teste ngkfefsd fgdfsgfgfagagfsv','2015-12-11','2015-12-13'),(3,4,10,'ghndfhgfh','2015-12-11','2015-12-13');
/*!40000 ALTER TABLE `tbBlock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbChoqueEq`
--

DROP TABLE IF EXISTS `tbChoqueEq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbChoqueEq` (
  `idReEq` int(10) unsigned NOT NULL,
  `idData` int(10) unsigned NOT NULL,
  `idChoqueReEq` int(10) unsigned NOT NULL,
  `idChoqueData` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idReEq`,`idData`,`idChoqueReEq`,`idChoqueData`),
  KEY `idData` (`idData`),
  KEY `idChoqueReEq` (`idChoqueReEq`),
  KEY `idChoqueData` (`idChoqueData`),
  CONSTRAINT `tbChoqueEq_ibfk_1` FOREIGN KEY (`idReEq`, `idData`) REFERENCES `tbControleDataEq` (`idReEq`, `idData`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbChoqueEq_ibfk_2` FOREIGN KEY (`idReEq`) REFERENCES `tbReservaEq` (`idReEq`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbChoqueEq_ibfk_3` FOREIGN KEY (`idData`) REFERENCES `tbData` (`idData`),
  CONSTRAINT `tbChoqueEq_ibfk_4` FOREIGN KEY (`idChoqueReEq`) REFERENCES `tbReservaEq` (`idReEq`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbChoqueEq_ibfk_5` FOREIGN KEY (`idChoqueData`) REFERENCES `tbData` (`idData`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbChoqueEq`
--

LOCK TABLES `tbChoqueEq` WRITE;
/*!40000 ALTER TABLE `tbChoqueEq` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbChoqueEq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbChoqueLab`
--

DROP TABLE IF EXISTS `tbChoqueLab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbChoqueLab` (
  `idReLab` int(10) unsigned NOT NULL,
  `idData` int(10) unsigned NOT NULL,
  `idChoqueReLab` int(10) unsigned NOT NULL,
  `idChoqueData` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idReLab`,`idData`,`idChoqueReLab`,`idChoqueData`),
  KEY `tbChoqueLab_ibfk_2` (`idData`),
  KEY `tbChoqueLab_ibfk_3` (`idChoqueReLab`),
  KEY `tbChoqueLab_ibfk_4` (`idChoqueData`),
  CONSTRAINT `tbChoqueLab_ibfk_1` FOREIGN KEY (`idReLab`) REFERENCES `tbControleDataLab` (`idReLab`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbChoqueLab_ibfk_2` FOREIGN KEY (`idData`) REFERENCES `tbControleDataLab` (`idData`),
  CONSTRAINT `tbChoqueLab_ibfk_3` FOREIGN KEY (`idChoqueReLab`) REFERENCES `tbControleDataLab` (`idReLab`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbChoqueLab_ibfk_4` FOREIGN KEY (`idChoqueData`) REFERENCES `tbControleDataLab` (`idData`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbChoqueLab`
--

LOCK TABLES `tbChoqueLab` WRITE;
/*!40000 ALTER TABLE `tbChoqueLab` DISABLE KEYS */;
INSERT INTO `tbChoqueLab` VALUES (43,109,17,109),(43,109,31,109),(43,109,40,109),(43,109,41,109),(43,109,42,109);
/*!40000 ALTER TABLE `tbChoqueLab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbChoqueSala`
--

DROP TABLE IF EXISTS `tbChoqueSala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbChoqueSala` (
  `idReSala` int(10) unsigned NOT NULL,
  `idData` int(10) unsigned NOT NULL,
  `idChoqueReSala` int(10) unsigned NOT NULL,
  `idChoqueData` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idReSala`,`idData`,`idChoqueReSala`,`idChoqueData`),
  KEY `idData` (`idData`),
  KEY `idChoqueSala` (`idChoqueReSala`),
  KEY `idChoqueData` (`idChoqueData`),
  CONSTRAINT `tbChoqueSala_ibfk_1` FOREIGN KEY (`idReSala`) REFERENCES `tbReservaSala` (`idReSala`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbChoqueSala_ibfk_2` FOREIGN KEY (`idData`) REFERENCES `tbData` (`idData`),
  CONSTRAINT `tbChoqueSala_ibfk_4` FOREIGN KEY (`idChoqueData`) REFERENCES `tbData` (`idData`),
  CONSTRAINT `tbChoqueSala_ibfk_5` FOREIGN KEY (`idChoqueReSala`) REFERENCES `tbReservaSala` (`idReSala`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbChoqueSala`
--

LOCK TABLES `tbChoqueSala` WRITE;
/*!40000 ALTER TABLE `tbChoqueSala` DISABLE KEYS */;
INSERT INTO `tbChoqueSala` VALUES (2,136,1,136);
/*!40000 ALTER TABLE `tbChoqueSala` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbControleDataEq`
--

DROP TABLE IF EXISTS `tbControleDataEq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbControleDataEq` (
  `idReEq` int(10) unsigned NOT NULL,
  `idData` int(10) unsigned NOT NULL,
  `statusData` enum('Pendente','Aprovado','Entregue','Recebido','Expirado','Cancelado','Negado') NOT NULL,
  `justificativa` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idReEq`,`idData`),
  KEY `idData` (`idData`),
  CONSTRAINT `tbControleDataEq_ibfk_1` FOREIGN KEY (`idReEq`) REFERENCES `tbReservaEq` (`idReEq`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbControleDataEq_ibfk_2` FOREIGN KEY (`idData`) REFERENCES `tbData` (`idData`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbControleDataEq`
--

LOCK TABLES `tbControleDataEq` WRITE;
/*!40000 ALTER TABLE `tbControleDataEq` DISABLE KEYS */;
INSERT INTO `tbControleDataEq` VALUES (1,7,'Expirado',NULL),(2,8,'Expirado',NULL),(3,9,'Expirado',NULL),(4,10,'Expirado',NULL),(5,8,'Expirado',NULL),(7,15,'Expirado',NULL),(8,17,'Expirado',NULL),(9,17,'Expirado',NULL),(10,18,'Expirado',NULL),(11,19,'Expirado',NULL),(12,19,'Expirado',NULL),(13,19,'Expirado',NULL),(14,19,'Expirado',NULL),(15,19,'Expirado',NULL),(16,19,'Expirado',NULL),(18,50,'Expirado',NULL),(19,51,'Expirado',NULL),(20,52,'Expirado',NULL),(21,53,'Expirado',NULL),(22,55,'Negado','hgfhdfhfd'),(23,56,'Negado','fsgfsgfdsg'),(24,57,'Expirado',NULL),(25,58,'Expirado',NULL),(26,58,'Negado','dhfdhgdhfdh'),(27,59,'Negado',NULL),(28,59,'Negado','gdfsgfdgdfg'),(29,60,'Negado','fdhvhdvhvc'),(30,60,'Expirado',NULL),(31,58,'Negado','fbfdbvzbfg'),(32,58,'Negado','fhgfdgfdsgd'),(33,70,'Expirado',NULL),(33,71,'Expirado',NULL),(34,72,'Expirado',NULL),(34,73,'Expirado',NULL),(35,72,'Expirado',NULL),(35,73,'Expirado',NULL),(36,74,'Expirado',NULL),(36,75,'Expirado',NULL),(36,76,'Expirado',NULL),(36,77,'Expirado',NULL),(36,78,'Expirado',NULL),(36,79,'Aprovado',NULL),(36,80,'Aprovado',NULL),(36,81,'Aprovado',NULL),(36,82,'Aprovado',NULL),(37,83,'Expirado',NULL),(37,84,'Expirado',NULL),(37,85,'Expirado',NULL),(37,86,'Expirado',NULL),(37,87,'Expirado',NULL),(37,88,'Aprovado',NULL),(37,89,'Aprovado',NULL),(38,133,'Cancelado',''),(39,134,'Entregue',NULL),(40,135,'Entregue',NULL),(41,138,'Aprovado',NULL),(42,139,'Entregue',NULL),(43,148,'Aprovado',NULL),(45,148,'Cancelado','rgvdfsf');
/*!40000 ALTER TABLE `tbControleDataEq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbControleDataLab`
--

DROP TABLE IF EXISTS `tbControleDataLab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbControleDataLab` (
  `idReLab` int(10) unsigned NOT NULL,
  `idData` int(10) unsigned NOT NULL,
  `idLab` int(10) unsigned NOT NULL DEFAULT '0',
  `statusData` enum('Pendente','Aprovado','Entregue','Recebido','Expirado','Cancelado','Negado') NOT NULL,
  `justificativa` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idReLab`,`idData`,`idLab`),
  KEY `idData` (`idData`),
  KEY `idLab` (`idLab`),
  CONSTRAINT `tbControleDataLab_ibfk_1` FOREIGN KEY (`idReLab`) REFERENCES `tbReservaLab` (`idReLab`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbControleDataLab_ibfk_2` FOREIGN KEY (`idData`) REFERENCES `tbData` (`idData`),
  CONSTRAINT `tbControleDataLab_ibfk_3` FOREIGN KEY (`idLab`) REFERENCES `tbLaboratorio` (`idLab`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbControleDataLab`
--

LOCK TABLES `tbControleDataLab` WRITE;
/*!40000 ALTER TABLE `tbControleDataLab` DISABLE KEYS */;
INSERT INTO `tbControleDataLab` VALUES (1,6,1,'Expirado',NULL),(2,8,1,'Expirado',NULL),(3,8,1,'Expirado',NULL),(11,62,1,'Expirado',NULL),(12,63,1,'Expirado',NULL),(13,64,1,'Expirado',NULL),(14,65,1,'Expirado',NULL),(15,66,1,'Expirado',NULL),(15,67,1,'Expirado',NULL),(15,68,1,'Expirado',NULL),(15,69,1,'Expirado',NULL),(16,90,1,'Expirado',NULL),(16,91,1,'Expirado',NULL),(16,92,1,'Expirado',NULL),(16,93,1,'Expirado',NULL),(16,94,1,'Expirado',NULL),(17,77,1,'Expirado',NULL),(17,79,1,'Aprovado',NULL),(17,81,1,'Aprovado',NULL),(17,95,1,'Expirado',NULL),(17,96,1,'Expirado',NULL),(17,97,1,'Expirado',NULL),(17,98,1,'Aprovado',NULL),(17,99,1,'Aprovado',NULL),(17,100,1,'Aprovado',NULL),(17,101,1,'Aprovado',NULL),(17,102,1,'Aprovado',NULL),(17,103,1,'Aprovado',NULL),(17,104,1,'Aprovado',NULL),(17,105,1,'Aprovado',NULL),(17,106,1,'Aprovado',NULL),(17,107,1,'Aprovado',NULL),(17,108,1,'Aprovado',NULL),(17,109,1,'Aprovado',NULL),(17,110,1,'Aprovado',NULL),(17,111,1,'Aprovado',NULL),(18,80,1,'Pendente',NULL),(19,108,1,'Negado','tenkffxf'),(20,140,1,'Aprovado',NULL),(21,140,1,'Aprovado',NULL),(22,140,1,'Aprovado',NULL),(23,141,1,'Aprovado',NULL),(24,142,1,'Pendente',NULL),(25,143,1,'Pendente',NULL),(26,143,1,'Aprovado',NULL),(28,143,1,'Entregue',NULL),(29,144,1,'Cancelado','teste 23'),(29,145,1,'Cancelado','teste 23'),(29,146,1,'Cancelado','teste 23'),(29,147,1,'Cancelado','teste 23'),(30,108,1,'Pendente',NULL),(31,109,1,'Pendente',NULL),(40,109,1,'Pendente',NULL),(41,109,1,'Pendente',NULL),(42,109,1,'Pendente',NULL),(43,109,1,'Pendente',NULL);
/*!40000 ALTER TABLE `tbControleDataLab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbControleDataSala`
--

DROP TABLE IF EXISTS `tbControleDataSala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbControleDataSala` (
  `idReSala` int(10) unsigned NOT NULL,
  `idData` int(10) unsigned NOT NULL,
  `statusData` enum('Pendente','Aprovado','Entregue','Recebido','Expirado','Cancelado','Negado') NOT NULL,
  `justificativa` varchar(50) NOT NULL,
  PRIMARY KEY (`idReSala`,`idData`),
  KEY `idData` (`idData`),
  CONSTRAINT `tbControleDataSala_ibfk_1` FOREIGN KEY (`idReSala`) REFERENCES `tbReservaSala` (`idReSala`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbControleDataSala_ibfk_2` FOREIGN KEY (`idData`) REFERENCES `tbData` (`idData`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbControleDataSala`
--

LOCK TABLES `tbControleDataSala` WRITE;
/*!40000 ALTER TABLE `tbControleDataSala` DISABLE KEYS */;
INSERT INTO `tbControleDataSala` VALUES (1,136,'Pendente',''),(2,136,'Pendente',''),(3,153,'Pendente',''),(4,154,'Aprovado',''),(5,154,'Aprovado','');
/*!40000 ALTER TABLE `tbControleDataSala` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbCor`
--

DROP TABLE IF EXISTS `tbCor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbCor` (
  `idCor` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cor` varchar(7) NOT NULL,
  PRIMARY KEY (`idCor`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbCor`
--

LOCK TABLES `tbCor` WRITE;
/*!40000 ALTER TABLE `tbCor` DISABLE KEYS */;
INSERT INTO `tbCor` VALUES (1,'#3498DB'),(2,'#E67E22'),(3,'#1ABC9C'),(4,'#9B59B6'),(5,'#FF0000'),(6,'#60FF00'),(7,'#0400FF'),(8,'#FF00EB'),(9,'#26FF00'),(10,'#00FFB7');
/*!40000 ALTER TABLE `tbCor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbData`
--

DROP TABLE IF EXISTS `tbData`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbData` (
  `idData` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `inicio` datetime NOT NULL,
  `fim` datetime NOT NULL,
  PRIMARY KEY (`idData`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbData`
--

LOCK TABLES `tbData` WRITE;
/*!40000 ALTER TABLE `tbData` DISABLE KEYS */;
INSERT INTO `tbData` VALUES (6,'2015-09-08 15:00:00','2015-09-08 16:00:00'),(7,'2015-09-09 12:00:00','2015-09-09 14:00:00'),(8,'2015-09-09 00:00:00','2015-09-09 23:59:00'),(9,'2015-09-09 00:00:00','2015-09-09 00:00:00'),(10,'2015-09-10 00:00:00','2015-09-10 23:59:00'),(11,'2015-09-23 00:00:00','2015-09-23 23:59:00'),(12,'2015-09-24 00:00:00','2015-09-24 23:59:00'),(13,'2015-10-07 16:00:00','2015-10-07 17:00:00'),(14,'2015-10-07 16:00:00','2015-10-07 22:00:00'),(15,'2015-10-07 01:00:00','2015-10-07 18:00:00'),(16,'2015-10-07 02:00:00','2015-10-07 18:00:00'),(17,'2015-10-07 18:00:00','2015-10-07 22:00:00'),(18,'2015-10-09 05:00:00','2015-10-09 18:00:00'),(19,'2015-10-20 05:00:00','2015-10-20 15:00:00'),(20,'2015-10-14 08:00:00','2015-10-14 11:00:00'),(21,'2015-10-14 08:00:00','0000-00-00 00:00:00'),(22,'2015-10-19 05:00:00','2015-10-19 08:00:00'),(23,'2015-10-14 05:00:00','2015-10-14 08:00:00'),(24,'2015-10-21 05:00:00','2015-10-21 08:00:00'),(25,'2015-10-15 05:00:00','2015-10-15 08:00:00'),(26,'2015-10-22 05:00:00','2015-10-22 08:00:00'),(27,'2015-10-21 07:00:00','2015-10-21 09:00:00'),(28,'2015-10-28 07:00:00','2015-10-28 09:00:00'),(29,'2015-11-04 07:00:00','2015-11-04 09:00:00'),(30,'2015-11-11 07:00:00','2015-11-11 09:00:00'),(31,'2015-11-18 07:00:00','2015-11-18 09:00:00'),(32,'2015-11-25 07:00:00','2015-11-25 09:00:00'),(33,'2015-12-02 07:00:00','2015-12-02 09:00:00'),(34,'2015-12-09 07:00:00','2015-12-09 09:00:00'),(35,'2015-12-16 07:00:00','2015-12-16 09:00:00'),(36,'2015-12-23 07:00:00','2015-12-23 09:00:00'),(37,'2015-12-30 07:00:00','2015-12-30 09:00:00'),(38,'2015-10-16 07:00:00','2015-10-16 09:00:00'),(39,'2015-10-23 07:00:00','2015-10-23 09:00:00'),(40,'2015-10-30 07:00:00','2015-10-30 09:00:00'),(41,'2015-11-06 07:00:00','2015-11-06 09:00:00'),(42,'2015-11-13 07:00:00','2015-11-13 09:00:00'),(43,'2015-11-20 07:00:00','2015-11-20 09:00:00'),(44,'2015-11-27 07:00:00','2015-11-27 09:00:00'),(45,'2015-12-04 07:00:00','2015-12-04 09:00:00'),(46,'2015-12-11 07:00:00','2015-12-11 09:00:00'),(47,'2015-12-18 07:00:00','2015-12-18 09:00:00'),(48,'2015-12-25 07:00:00','2015-12-25 09:00:00'),(49,'2016-01-01 07:00:00','2016-01-01 09:00:00'),(50,'2015-10-21 00:00:00','2015-10-21 09:00:00'),(51,'2015-10-21 10:00:00','2015-10-21 15:00:00'),(52,'2015-10-23 00:00:00','2015-10-23 02:00:00'),(53,'2015-10-23 02:00:00','2015-10-23 04:00:00'),(54,'2015-10-23 00:00:00','2015-10-23 04:00:00'),(55,'2015-10-26 00:00:00','2015-10-26 04:00:00'),(56,'2015-10-26 04:00:00','2015-10-26 06:00:00'),(57,'2015-10-26 00:00:00','2015-10-26 07:00:00'),(58,'2015-10-26 00:00:00','2015-10-26 02:00:00'),(59,'2015-10-26 06:00:00','2015-10-26 08:00:00'),(60,'2015-10-26 01:00:00','2015-10-26 04:00:00'),(61,'2015-10-27 00:00:00','2015-10-27 02:00:00'),(62,'2015-10-27 00:00:00','2015-10-27 04:00:00'),(63,'2015-10-27 02:00:00','2015-10-27 06:00:00'),(64,'2015-10-27 04:00:00','2015-10-27 08:00:00'),(65,'2015-10-27 06:00:00','2015-10-27 08:00:00'),(66,'2015-10-28 06:00:00','2015-10-28 10:00:00'),(67,'2015-11-04 06:00:00','2015-11-04 10:00:00'),(68,'2015-10-30 06:00:00','2015-10-30 10:00:00'),(69,'2015-11-06 06:00:00','2015-11-06 10:00:00'),(70,'2015-10-29 08:00:00','2015-10-29 00:00:00'),(71,'2015-10-30 08:00:00','2015-10-30 00:00:00'),(72,'2015-10-29 08:00:00','2015-10-29 10:00:00'),(73,'2015-10-30 08:00:00','2015-10-30 10:00:00'),(74,'2015-10-29 10:00:00','2015-10-29 12:00:00'),(75,'2015-11-02 10:00:00','2015-11-02 12:00:00'),(76,'2015-11-05 10:00:00','2015-11-05 12:00:00'),(77,'2015-11-09 10:00:00','2015-11-09 12:00:00'),(78,'2015-11-12 10:00:00','2015-11-12 12:00:00'),(79,'2015-11-16 10:00:00','2015-11-16 12:00:00'),(80,'2015-11-19 10:00:00','2015-11-19 12:00:00'),(81,'2015-11-23 10:00:00','2015-11-23 12:00:00'),(82,'2015-11-26 10:00:00','2015-11-26 12:00:00'),(83,'2015-10-28 08:00:00','2015-10-28 10:00:00'),(84,'2015-11-02 08:00:00','2015-11-02 10:00:00'),(85,'2015-11-04 08:00:00','2015-11-04 10:00:00'),(86,'2015-11-09 08:00:00','2015-11-09 10:00:00'),(87,'2015-11-11 08:00:00','2015-11-11 10:00:00'),(88,'2015-11-16 08:00:00','2015-11-16 10:00:00'),(89,'2015-11-18 08:00:00','2015-11-18 10:00:00'),(90,'2015-10-29 12:00:00','2015-10-29 14:00:00'),(91,'2015-11-03 12:00:00','2015-11-03 14:00:00'),(92,'2015-11-05 12:00:00','2015-11-05 14:00:00'),(93,'2015-11-10 12:00:00','2015-11-10 14:00:00'),(94,'2015-11-12 12:00:00','2015-11-12 14:00:00'),(95,'2015-11-04 10:00:00','2015-11-04 12:00:00'),(96,'2015-11-06 10:00:00','2015-11-06 12:00:00'),(97,'2015-11-11 10:00:00','2015-11-11 12:00:00'),(98,'2015-11-13 10:00:00','2015-11-13 12:00:00'),(99,'2015-11-18 10:00:00','2015-11-18 12:00:00'),(100,'2015-11-20 10:00:00','2015-11-20 12:00:00'),(101,'2015-11-25 10:00:00','2015-11-25 12:00:00'),(102,'2015-11-27 10:00:00','2015-11-27 12:00:00'),(103,'2015-11-30 10:00:00','2015-11-30 12:00:00'),(104,'2015-12-02 10:00:00','2015-12-02 12:00:00'),(105,'2015-12-04 10:00:00','2015-12-04 12:00:00'),(106,'2015-12-07 10:00:00','2015-12-07 12:00:00'),(107,'2015-12-09 10:00:00','2015-12-09 12:00:00'),(108,'2015-12-11 10:00:00','2015-12-11 12:00:00'),(109,'2015-12-14 10:00:00','2015-12-14 12:00:00'),(110,'2015-12-16 10:00:00','2015-12-16 12:00:00'),(111,'2015-12-18 10:00:00','2015-12-18 12:00:00'),(112,'2015-11-05 07:00:00','2015-11-05 07:00:00'),(113,'2015-11-06 07:00:00','2015-11-06 07:00:00'),(114,'2015-11-12 07:00:00','2015-11-12 07:00:00'),(115,'2015-11-13 07:00:00','2015-11-13 07:00:00'),(116,'2015-11-19 07:00:00','2015-11-19 07:00:00'),(117,'2015-11-20 07:00:00','2015-11-20 07:00:00'),(118,'2015-11-05 12:00:00','2015-11-05 12:00:00'),(119,'2015-11-06 12:00:00','2015-11-06 12:00:00'),(120,'2015-11-12 12:00:00','2015-11-12 12:00:00'),(121,'2015-11-13 12:00:00','2015-11-13 12:00:00'),(122,'2015-11-19 12:00:00','2015-11-19 12:00:00'),(123,'2015-11-20 12:00:00','2015-11-20 12:00:00'),(124,'2015-11-05 10:00:00','2015-11-05 15:00:00'),(125,'2015-11-06 10:00:00','2015-11-06 15:00:00'),(126,'2015-11-12 10:00:00','2015-11-12 15:00:00'),(127,'2015-11-13 10:00:00','2015-11-13 15:00:00'),(128,'2015-11-19 10:00:00','2015-11-19 15:00:00'),(129,'2015-11-20 10:00:00','2015-11-20 15:00:00'),(130,'2015-11-09 00:00:00','2015-11-09 00:00:00'),(131,'2015-11-09 12:00:00','2015-11-25 14:00:00'),(132,'2015-11-10 06:00:00','2015-11-10 08:00:00'),(133,'2015-11-17 09:00:00','2015-11-17 11:00:00'),(134,'2015-11-24 10:00:00','2015-11-24 12:00:00'),(135,'2015-11-24 14:00:00','2015-11-24 16:00:00'),(136,'2015-11-26 10:00:00','2015-11-26 13:00:00'),(137,'2015-12-10 10:00:00','2015-12-10 14:00:00'),(138,'2015-12-10 10:00:00','2015-12-10 15:00:00'),(139,'2015-12-10 13:00:00','2015-12-10 15:00:00'),(140,'2015-12-10 10:00:00','2015-12-10 12:00:00'),(141,'2015-12-10 13:00:00','2015-12-10 16:00:00'),(142,'2015-12-10 14:00:00','2015-12-10 16:00:00'),(143,'2015-12-10 14:00:00','2015-12-10 18:00:00'),(144,'2015-12-15 12:00:00','2015-12-15 14:00:00'),(145,'2015-12-22 12:00:00','2015-12-22 14:00:00'),(146,'2015-12-17 12:00:00','2015-12-17 14:00:00'),(147,'2015-12-24 12:00:00','2015-12-24 14:00:00'),(148,'2015-12-10 08:00:00','2015-12-10 10:00:00'),(149,'2015-12-14 12:00:00','2015-12-14 14:00:00'),(150,'2015-12-21 12:00:00','2015-12-21 14:00:00'),(151,'2015-12-16 12:00:00','2015-12-16 14:00:00'),(152,'2015-12-23 12:00:00','2015-12-23 14:00:00'),(153,'2015-12-11 10:00:00','2015-12-11 14:00:00'),(154,'2015-12-11 12:00:00','2015-12-11 14:00:00');
/*!40000 ALTER TABLE `tbData` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbEquipamento`
--

DROP TABLE IF EXISTS `tbEquipamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbEquipamento` (
  `patrimonio` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idTipoEq` int(10) unsigned DEFAULT NULL,
  `modelo` varchar(255) NOT NULL,
  `statusEq` enum('Ativo','Inativo') NOT NULL,
  PRIMARY KEY (`patrimonio`),
  KEY `tbEquipamento_FKIndex1` (`idTipoEq`),
  KEY `idTipoEqp` (`idTipoEq`),
  CONSTRAINT `tbEquipamento_ibfk_1` FOREIGN KEY (`idTipoEq`) REFERENCES `tbTipoEq` (`idTipoEq`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2152344235 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbEquipamento`
--

LOCK TABLES `tbEquipamento` WRITE;
/*!40000 ALTER TABLE `tbEquipamento` DISABLE KEYS */;
INSERT INTO `tbEquipamento` VALUES (46523643,3,'hgfhgdshgdgdfsg','Ativo'),(241235435,2,'fdgsfdhfdgfdsgdfg','Ativo'),(2152344234,3,'gregfegbfdshdhgdfb','Ativo');
/*!40000 ALTER TABLE `tbEquipamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbImagem`
--

DROP TABLE IF EXISTS `tbImagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbImagem` (
  `idUser` int(10) unsigned NOT NULL,
  `imagem` blob NOT NULL,
  PRIMARY KEY (`idUser`),
  CONSTRAINT `tbImagem_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbUsuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbImagem`
--

LOCK TABLES `tbImagem` WRITE;
/*!40000 ALTER TABLE `tbImagem` DISABLE KEYS */;
INSERT INTO `tbImagem` VALUES (3,'‰PNG\r\n\Z\n\0\0\0\rIHDR\0\0\0×\0\0\0×\0\0\0‰}Äµ\0\00•IDATxÚí‰ÛÅ¹è¿?äŞóœQQD6ÙAPÜXdS\"\ZÄÄ1B7\\ãrİŠ ÑƒÆ5¸ DqAwOİùµ¼së«¯º»º§g¦{¦æyŞıà›™®ª_½k½ÕòÈıkT£Kï^=TûöíUÿşı)ıúõS}úôQ}ûöı·Ç{¬êÙ³§êŞ½{¬sÌ1ê\'?ù‰êÑ£‡õ3;wîù:tèü>rŞ9ST3¬¥$ÒÒyÅ¬Á`°¤Ò«W¯X¸ºté\n—¼G·nİb?çğÃŞ§s§êºEW{°š	.„‰/²öª`€Òµk×à}â>‹÷8ôĞCƒ÷x|uËÊ¥®fyPÑ^.¥‘mæ#c§01]>÷:äCT»’6»ä¢ó<\\Í\"ø^˜0Í—øGh`€Ğ±cÇØ÷À¿Jò™¼\'à2æ+–.òpQ&M8#0C\\l}&™Õe15šè°™‰l6.æ2€&7>x›5àQx¸\0ë°ÃS|pàWyšZ0ov\0Û=·ßèÍCCˆ8êp¡‘\0ÀUFEÃ~çˆ#Æœ¹±Í‰‡+Çp±@:ê(uôÑG;1 IˆØ&,&ÄÕhD-&áz	Ç»FR%ŸtìĞ|ÎÉCOôp	.&N&Å‚Fkñ;D·š0	và‹±!%ñ©*\ræá*\\¤ÀäAƒ>ŒûÈ#´\\³šˆ\nù.WÓĞrT¢Á˜;¿¹ƒ\r€˜¹&>0vmş-‹?›0ÉS¥ù=‚I6\'`”|¿Ë÷³ŸıLtĞAAd±‘’Ğ…‡‹Ğæ3ôîİ;ğÁ:uêY3UnTCr$™³víÚ•ç€÷üA\'W„oT\"”I0vÉ(s3±™ı¯J…ñO²IIÉ”>\'øËD~%t_x¸»‹‰áb’à—1¡a ¡ñ<,éMË¸jİtgŞlæ;¦b#”Q.ò&LDšÊvZN¯Á*«gtŒ1fŞĞT¶Mk?LÊ¨Š˜kˆò\'a&ÊC‘\ræ !°A0*êH	h +bø¾!àbgûİ/îü9â6;ñ»¢ƒM½ÕÊ×y³°^‚]Î$±Ëù…‰óƒãàÂ›6u’÷¹ò’¯¦iˆ?ÑÌ	ç¬ÍCàÂäƒ‹TŠ$œ‹Øhi­EâQLÃjW¼óşŞ·KfFÁE9Ê,0\0”ã+D	Óá¬X®á\Z‡•’ªßlœa¢M„n‰.ñßÕ.ÈM[W×¬å3ÌK¯şÜ9gOôpU’¿’( ÀÈ¹#lºL$»\\Òƒ}iBøÕşŒF*¶™Òü,ª\ZŸÊ}Ò\"¶f;æÍñfaVìpRÃ†\0QØÉZI@¦­•Kâ5[OJ´½M£¹æ&ä>s:ğ¸şŞçªFÿİ~—j\0&‰Ÿ›G×kq^K*=ÂD£€§shø`X5®Œı¯0„ihˆb&\rÍ§)àå³l€±Ó\"E„L,—>‰õ€ÿ¨’ÅP„èa¡¢…h°($Í3P¢LIL·¤GØe7¥ºÛŒŸ‹éÊB-Z\0DÚğy±.BÅFáBñ¬sÑHrm\'\'•]4Wš*ówùL³ò>Ú I÷^@“šÌz~76Ù¼°,\\pŠwÕ2ì¼D¨csI\0§Í“ñŞ6ÀÂúVk‘¯˜¤Ò»RÓ4®¹¨h7ù\\‘jÈ8ç½GKQÇTK»VK0ÉRj<Q¾UZíÅ–’Z\r$]œY-Æ¨^ñüÑp=\rÀß¹ö ©¶–F{åÙ÷*l…Fœÿv O Ã´\"hi«0ÄOA«’Ğ5FXê ‚JµK¯øj‹íl\\–ÚŒ7ÁÃå(ØÑä¶D¢z*œròTÅº,<\0:<¤A( mK5In4˜À«8ÒŠh×3gõÌ„K\Z“fÕÄ‚ñp%0ùˆI‰“Üas^ÏF\0€emßKh?Y¦C$=<²ÌÕÜ©Æç¥…²Nîc½ä5ï•[³ğŞ;W©	à‘&ŸfuôàAƒÊ ,²n4“Ö<4£„’læçÕ,¢Ã¥I–¾XMÃÜû\\gO™X.–È(Şe·Òƒh/ş>ë1m‘nX”Pü¨f\0L‡K^´l–5¨®”‚ù\'m\"ÍıuIï»Õ±©iK“\\òy$©œ4úVT¸lã•ö’^yì±Q¸0G›ÏŒ3B˜‰Yh1\0à}ÒïÉÂ`6*\\ñûû¬JÃ˜ë<6mÉs¨]oyÜí˜®‘swÄœ“ò§J|1½(‰gJ²·‘ ’ŸQ§ŒEƒg.Aûæ.¢…)$Xˆ)Šm‡”CvYZM¦ÃAÍbÒEáâcÕ;²—•0ÎŒ÷äÓO\næ¬İqòXk˜K¸äòì™3RC &­À05‹qÉªrB7‹ê‡1&Ò-wÙìóÕgîRíÛ^>©PMÀø¬WÒÆ3Ã†¤¾ØÍšŸL\nz™˜8SOJ›Ìğ:*ÉÂ»İ1,o•g˜a&ËE\nŒçˆÁÔó·-ÀBĞ^Œ·ËûU’§”ËÎ=\\	¥SÂÈŸë¢4‡ì¶R­!tÒ½H\nSmïdTß\'ÌÕÇâ;Ö2Ùt\0†?õ~º\0éé]\"©‘]:ª[ç_Z†J\rÆ¸º~´€IË\0WÂ\nø¸^Òš‹ß’¦ä\'¸J¨SÇ`çº‘Rúy°Èta×”>iœV‹ºÜ¼˜€…írçXÖšÉ&À\'×°\"×L?[mì¦6`!üSÜåBÂJCô|—Õ7\\ïáJâ{Åå¬Ìjˆ4¾Âãúª·î[^^ënXÈ×ıW°x0o\0ÏEõíÙF1?%üÄ“…–à½\0dÁf¡Ùt-/5ççãZY˜\\8~xğüÕ®¦ç{-ÏÙù®\\ÃEK5—„pÚUÌEFÄ.¤Â¢NÌ\"›6DÓÉU©¢åÂ4….æ}ÏÀ¦·–ËZs…\0…°q`ş…i*›àƒñ“nIMDWŠÎO.ÉÛ4Ú‹…*Q­ZˆhC4aœ64µŸ«`‚‰©ªûJ@®@KpB\n-¥*’\nÏëÒŸ°À<\\)®duÍM¹V:°ƒ–ÍÏ³œ\"l*‚ùU) ˜{¼cãbò%¾O\Z¿Ñ0WŠ«\\árIÔJ€ h`UN]*ÑJILå£Û™ÊWtÌÃ•P\\›{J^\\h,vùf+/Â¦æRµ‘¦ÑÃ•®°R£¨vÇ6ÁŸÀäñ‹¼¾Âæ–$÷¥§K¢\0óp¥hš¦ŒÈÄæOåòR=a“KXØ906`\"’>‰\\!\\ICï8ÑlW¿Â‹›°ÉtÁšÈ¢é\rZíğöÒÈõ‘“0¸’„Ş±ñ›1€QÀ°&’&˜mWŠW\\®5„äVFêïsN…\"áÌvW­eó»°N8ïçáJ\0WÔ3qÚKîêzãÎßù…œcyîÆùÁ&\ZU=w~*—a9ì¾›[¸èèW\\`ƒJƒçSŸ¬õAŒ<ËîÇVª›æœl„æUPú7é×hÓ\\®Õ6¸Ü¸#A9O»ÃÔ?ï¾N}ºîV¿ˆs,l~=¼\\?z¨sL\0±XÀuş¹g{¸*‹Ëå(¼h-&íÓõ·ùE\\\0¸Ø{vî(DF“{\0fäğò\\Ã%­ª“ä¶t­ÀõÔ\Z¿ˆs,XÌòøâY±ş—­5\0pÍ½ârW¸ôã&®GäÑZ˜2a~ç®’e!s…Ø7öˆŠy¸–çğ®®ÂÀ¥‘3\rqˆÙù6,Ÿëá*(\\¯Şüër“°^æš\0Æ¼B.\\qµ„äµNè}L«Éò¸XpéÚ+,aT><§7´ä¹hW‡Ë¥©²dÆWä³§oo¡yæ?êü—ä¾ĞdGwèàáJ—X8Áüf…LÒîÿ¾Ñ/àˆ	Á¨0ÓĞô¹Ğf\'èáªDsÅE1\rL“ĞÃUL¸Ä4´…åÍ`p8ıW%pÅ4&Ãoš„®âÂE’Èo\\0ƒ VûÄ\n®¨zBr[f”ĞÃUl¸Ø(M¸$il–>ıò²é®¤ı3\\ÍB¢„ÀeN‡«¸p‘P¶EõÊ+×å>O\"*¯¥\'±Ñ=\\—®¹¢ª3<\\)ó\\.mŸÑZ³&ğp5\\˜øİºtŠ=(	\\y¼U²0Iä¨³[äB€Ëfx¸Š¯¹ÌF¢¶#\'yM ªB#Ìç’`“ááj,¸l=6°bô\n<6¦)\\a‰d	f˜‘BWãú\\ºß•Ç«ƒr÷!“¡—+‚ÂÚU‡E\n=\\—ŞbÍÃUA¸c&®Æ„‹2¶0¸t¿ËÃU\\qW±FÁõÑ#7øÅ[P¸æ5®o¡‡«¸l÷;Ãå«â.3ïáJ!æÍ\Z–Hq¦‡ËÃe»”ÃÃUa;ë¨»·<\\\rkô3m½â=\\ÂåwIK\ZÒx¸ŠXR?v¢ÃeëïáÊà\n¡¨ÃÃ’ÈÈg¾Ãi’ÿıÀRõÁ=×¶’÷W_©Ş]zq¨ğ÷òoùıJïµ}Í‚Ê[•=y‹z}îøàÏJŞC‡¨1@øŞæØ¹~¾í˜¸:wêèáªôò»¨ªxşİŸæ_l ¨¾…,€-+fª—.\Z¬şvv¯Ìäùsû«WçŒRo-<«„¶ÇÏø7üPT\nŸÅ{ñù=úÇÈDààßnºì”LÇ\0áùÃ¾ƒ\\OØªÊ„kØĞ!A±‡+å±jãús«4uK4d½ \\„…Ì‚Fôï…æBô÷”Ï1?«–z\\Ìi\\l¼®*ïRÉ¡÷*Œ‚‹»\Z»t¥’…Ö*_ÏS‚4oÏØlhQMAmpéõ…®eôÈÓpôÁ«Œ\'²¤7§ùdíÍå‰ó+o²ùÚó*ò‘ÂÌÃziª8-¦?«´³¶	¦¾^¥a¶TtÂ@WV×E•B‘³5˜<&“IµMö+—Ÿªşñ›Ÿ«.¿¼¤Õ~[òG–´~¶uåœ²¼½øÁ¿×…÷ĞåÅ&òKª‰Ã·J˜ù¯_5®Í³êcñ¯[æ¶/„Ÿóo_3R=?íX«“\0P\\f}¡	×È§5¨®”·KJ\"9ÎïblpíºI3…$6˜²NSøûj†ºYÄQŸ_íçGøœ7çOjZä‰€K„ÆCafaÏ’%“×æ4¹‡Ë¼9ªÊ×w/*i‘~Ü-KËN¼ıö…5YPI¤Ú¹¤<=ë»K§«—/RlÛ-óBá2«4L¸ºwëæáª4o6tk×ı×«—g\ràbBk¡¥ò\n×‡ı!wÏŒéÈfÇ¦·}ÍüP¸èE)—2´\rÅŸèáªDÚ•|.½¦,Ìï.}RŞ˜w¦ÚúÇ_ªİŞ[¨j×G¬Èåsï~ôjçŸsÅf—H6áê”ãÎO¹‚ë±›§¾jJç÷¤‡Uúea‰dİÔ\'èãÇWå,´Jµáúø‰Õù{öÿ»T}öÔí¡s&BŠ%®G¦V\rïÒj½<{ùÈ`-y¸Èã7şFıuš=ªunß#ÛtŞƒËV_øáƒ¿Ï%\\h•ª×ï•qŞ[îªò·$×%=ãM¸úµ?Dİ5ú˜6k†µÄšòp•„İFO¦êukF×æúV›ßE+l‚¸]’d2»e%/3,í*ø|q‹¬ê{—L03ŠYÉóT’gf^âàâÆ©Ò°”Ô×\nkG×`M×¯Y^êüÌE±î†­Âña~—­)¨Y¥ÁŸ®\ZŒÅCÈ>«ä)¹/ÂÑ­rC˜FOßQ£êó;Ô®û~€Aş)Ëç8\'¸4öúğQ¥O¶k:\\“ÇŒà2Ÿ“5$ßµÕÔp­[|Y9±h«RØşØM­Âñ6¿‹hR\\úû²È,B‹Á¦™ÃÕ\'›UŸoŞ¤~wş8uÁÀ#Õ¼1İÕÕcz¨	Ç\\–ãÛı‡ê}èÿR\'u9XÍÛK5´“ê{øÿV;wlSòúè¯ÏHšd5ü_7]U³ËĞ©ë#§ÄÂ{oÙ%?VJÌ¨¾Û¿·üçÏœ®NêúSuŞğnê¬!‚gB†õŸåg½xĞQêš3{©¹£º©Éİª6¯0Ÿ­w]@f&•)èeRú|›†f^\\à’D²Wp»ÉàÖ÷”Ä9k«©ázfö¸rYLØâhß®uÄĞô»pxmwõ*0_„”	¸m·ı*\0`ó²™å…·÷ó=jàÑÿGM;ıuÑèê„?)/<S&x´š>¦§š0øhuı‚+•şÚşĞªà9I^×\nª°…÷ÂƒZÅ3_zÆsNã{¨ãÚÿgè3NÖ9ØD&\ZÏÈFÄûn^tN0ŞŒmì÷‰H ë\"pµªĞèÛÇ\n\"Õ8¬­¦†Kü-[Q§ƒØ­[·P¿¸Âªâ%ZèRìúò%ÃÔÎ\'ïnÅ¦çŸS£ú¡~1¢»:»´°Â2¤´ó_:®·:dwuñäQÊ|½·z~¹2¡p±è\0`ß¶wÚ<ãğ¾í­uöĞègZzÆËÆ÷QŒê¡.={L«÷ùz÷Nõæ¢_8Ÿ\'c^ÒÂEëšég[ßWjHëíwÕ®\r…‹A4¯Òı®8¸âZ¬a.a&™‹NŞØí`ÖŞ¿:øÙê¥×ÚŞ1?U—ŸÙG]XZx3Ï«l/\0‹ÒÒÕ€¶U~ÆãÛ«Ë&¯¾Ü·7Ğdƒ»úŒ3\'ô\r´xØ3¢¥)9‹;ËÅ¼¸À%U\Z:\\D—Í>?.ÖVSÃ%!x.v=*ÅÅ1]zJ§6CİïÂá\r;‰×bêq|İLÒ_øNc©.8\0×k/m…krÉ,üqáõPËÍSa/v÷Zk/€Æ?²½€iìÀ£Ô•çªŞ{kSğŒ#úw³>ã”ò3öT×^uYè3òYo^sN¤c^\\àÂŸ6áb=ã²e¸X[Ş,4Î3Q)®G¤\Z×­MÄP÷»bá\né¥±ã®E¯÷šó‹3Í…É7½¤•=â?Ú,º;¤f•šëç§v\r´AØß_sMí\ZÀ”4A•¨×‚K¦”ŸQhè2º_;uåYıƒg<\'æËÏyGø‘°ÂàB›­›Ø£¼FtÀ$$ßôf¡À¥›J=~~Åhµù·ÓTûv‡µéY\'~—\\4B1ûı[^S./´×9§÷V3Îè¥~9±Ÿš{ö\05uh§Ò.Ş1K‹rŞÔãÔìIÇª‹Jğıqñ¯bßó¾û¦fp}ùŞ&çg¼¸ôŒ³JÏ8{R?5iĞÑågœUò³æÏØ/xÆU×/p\Z»¾Ú§>yæDiâà¢Ö”õÀÚĞ7a3 Ñôpé%O28rŸQw&lö­¿Ë¬+LÒKã‹¿¯WßîŞjÊë·ŞPs/šìì@tåYÔÕ??.`›3ùX5c\\õğİ·Ä.¸¯·o|­àÚûÒãê«÷_Wßñi,`ÿÿûZŠMáyyÆËK~Ù+—Æj, â3÷l¸/ññş0¸ds%¸ÅÏ.é\"gÄd=±¶|ëÀ`08	S9ªNÕ´”Á˜A\rñ»\\àÒO$[¥´>~únµçµ\rAÔ+ìõì“¨;…ºmñµæºK¹ûWª\'î]ø.qÚŠ…^ÏVfßìÚÿÏ®U÷­úµºµôŒ·-¾$şû¡Û–D>ã76ªOşöˆÚóÜƒaø›Ã¥G\nI½è½G$—Ç\Z’Ÿ7}‹\Z0‚º}.¦!Er_“ír7¸nJtÀğÃ\'nUÿºgIà˜GÁ÷bÿúÃmjÿæ¡»x­Àì«]ÿR•¼|¹÷/S»\\¨UkËÁŒ5—O*»º©/İ¯z×æ¢¶0ìÈ»D©f é§Ô¿‹Ğâ&(í\'Ÿ>}GøØzëÂÀ9\'Ì,•aÂ‚ÛùèÍjç¨¸Ÿaµ“Ê<pü{ıŸ‚gã»‡=9@6œ`,Ö\\£>|8ıE®ax\\Ì÷_®Zî?¢¿¯ó…»ZPƒşfn†Ÿs.KÎ™A\rü®¨Šø2\\19—4åD6ÉºÑL­ÅÖU$ëBâ$p‰¿Í|Ì ÈeKÈKJ_¸{@Ö_sQ+¿K¬`w*\r$ƒŒmVj9r«Ğ­­Ÿ½»iúÃ‡F–>ñœíãŒ—Àen²XS®%mù\n	«n¿m~ùøÔ@“¹ÂÅ‡\",<³\\ëóçhšşğa\Z~7ë\0¸ÌJ½u^Lææ$²Tj˜¦!6õ;~]îdVjHBÑ	.í¸CŞM³VpıíÁ†‚+Iãÿ—l¤¬à2ı-1	ë]™‘;¸ô|—¾¸¨ûÃ®Ö¯•±ÁekZIÄ°²ãkZ}×½/>ÖPp%‰¾´üŠ`~9n‚K€‰ÈÏß_uE«óºIXïüVîàzbùÕVÓPrzO3™uËI« Æc+aî¸}aCÃåZ\r<0{J.Šuåhı(õ`†n²–<\\š<z÷*«i((¡[Zë\rkC=4°Ãk1¬Z´—µ‚ë‹WÖ5\\IÂğÇ¤`\\‚—Ûl0-u¸t“µäáŠ0\reà$´-B¾Ëô»øÿ¨#\'EŠîº÷º¶pıı©¦^6¨sP$Ğ¥K—V—êål’²É“I˜;¸ôj\r3¡¬ïvf¾+ê–“¢E‘c2Àµïõg›2RH³Ğ]àbõV:\\zâ8]ŸrÛTO\"a·a ¥äŞ.©5‹ê¡ÖO#—×-\\ûßz®q\"…W™òÎï.úV~Ç4Ô­}Ìd½ÔûpdîáÒy©³ÁeÖ\ZY{\'¸r1ä»5:\\I\"…T½qÈAÁå†˜„–Ïm—^KXïBİÜÃ¥·ZãAX§ ı|ÑÃ¨KÇ³¨1¬•/\nWNŠ~+f<¶Ò.úü3¯ÜtÒº/åŠVÇ“òÒJ­½â¥#”ó2øXºiè\Z×\'&ÏpÉsï}áÑ\0®F©Òp=ÚÏIæŸyEtŸZ6Hj<eÔ»ÓSaàÒs^’(4á\"ôN^àÂ&_2cJ¡ƒ\Z:\\D\r%ÇÕ(p%	fHEK¿P^àÊcn«·œHÎKêÇ>ûó­P¿^,ªwa‚\Z†oT¸’38®Ã¥›ü\\,¡›„y)w*\\¶ãÿ¶jé:$Êää.ñ¹¾Ø´¶aàJÌ[(OîÕ©Í¼ÊU¼yÌm®\'—\\Ñ&¡lÂ””Ô¹Fó\ZÔØYzNK*ãI 7\n\\®•ä·¤Å`™	\ZPÚ@äÕ$Ì5\\ú1	É£qÌ;s18@\'C×1Ï	ä Bã€éJéÓ¾76Dé\"H@ÙT½Úd»û”+œó[Òù‹\rS÷·¤“—Ş×2/åN…ºYÒ,äµ]9£›†îÃå¹ZˆìèºIˆ$\rÈïí<p‰wîü-‡ë‚ôüódf~KêC¥;Ø_.>Ùß,™\\6Ó“ALC\n;]áŠíU£Šª4p™ZA“å­úÄ®²;p÷¢¶şÖ—Ş„……KJ¡ô:Cs|òWç–£†I\nxë}ü„<Ö»K¦[ÁÊ®-7ÌlÕË¯(Écú¥\\Ò;ÅvªÁÃU…n¼²n½qvy¸¾“c(wºÂUïd2G$Èå„ÂUò±Ã#œD& !Bb9.ó*ê‚‹<&%¯Kpq|Éb!ãáª2\\dæ¥§¡Ü›LB™p¼;\\õK&Ë‰m·Ì…‹\r¨f-Ù÷ÚŸ­¥P¶÷à¿zÜ¨RIò˜’\'.æÚ¼1Eæÿ©_MópUR¥×êö`*8[õcÔ0)\\õJ&\\a`é>S ©Dƒm|Ø\Z5Ô~?¸kQğ»»î»>€K¿à\"ïşV9 Ñ\'s+™Ï‘§.O…„Ko¹fv„bĞõ“¨:™Ğ,t»¯ZşVœæ¢†kDSòczŠmñ÷Y§·:Y÷cıÒ.M÷±Ég1×¦öpU	.v1³äâsÇ\'æLt?éúÈ\ru[p,–\\35Ğ4ø@€´uåœVauóv–°zDŞÇü·¯Ì<­PşÖË3†¶9j$ÇJ¼æªâÙ.İæf73\'pÓWg°Ù“#¯—ßÅó¼~ÕØò³ğ§ô á‹Vşİ¦K‡µ2Ÿ0Åò)tÍoI¼yHVïo;ÖO%‡«Âcÿ.í”™Ü·Ü[ŞÙïªs¾Ë\0è‚kd5ÀÌVkÀÆïÉß¿¿ê¿­‡|”³&<®·™ˆIèâ#2>y<Ö_(¸(k‘A4@ÚDz)È^EÈwE]€şöµç¶òÃĞbfÒ9Ï=$Éo…™„Qóœ‡Ë\nBy‹­oTNîô*r¡ìĞøea¼Ua¤­\'Œ2	m‘G‰ æñ€d¡àÒı.½ÃªmĞõbN´Î~W^y¦Î?>ğ©0Ñfh«¸@G‘ê	¥PW.L7	óìo.½Y¨\r0š•Ñ9$ŸÓó]ææßU¨’ß²%1ıL“W+o\n	—?Ñ‹½5Müü®tâ-äù-‡;¸$q,İ›\\æ™“‡[L\Z.óğ¤M(•’È‘\0–Ä4,’F(D¿£-C\\-¡øOX*z~Ó&y7—´]ãH7 !ü7»¹‹Éä$ÉyıFÈ¢öËãüæibæš¹5ç;oíÓ\Z®4½1;Š’oä›LäxIü\'—¥è7IÎK?Ò·`Î¼$ŠÉå]Óº„à)ÏÊ{	“‡+¦÷¡k`#ï}ä«qñw½LB=·U$SÏÃeœd–Ë½i˜“ğ­…S\n‘öpÅTÕ\'	läÕ4,Öı[+œy®\rôpÅ6$oâ\Z–o¶¨aÖÏëbJ«êF\rd4\\zç^Wí•uB™*u—z9|)‚T…sÖK—¨â\\ù=ù·T6ğHRŸe€Ä¥PW*2Š’¯òp9„å]¢d‘PÎk•@¡4K¢|¦È‰j—Ê ÑĞÏ…	ÏïiBı÷–Ÿñw|G³•Bµze0Í µš.½Ñ\r¡ßZÖ\ZŠFB3°ÈMdJ„rá\0 ‚t>^à-ÅŸQ>b›ğ^ü»¬\".µ„~ot­Õ4pé‡.İ´Wşîğ’C”\0…äñWÜqşfÒZMW\ZíåË¡²ïğ$Z+¯\'x¸2Ğ^N‘Ã:6¯iÄL¤Ô)ÏM<=\\5ŒæıÖÜTd·~šB…ŒäµŠpTÄÃUaäÓ¯E¾œ¼Hç¶äÖ’<wÇõpeÜÑ¥b¤¨(½¯¥W¾çõ-WšŞĞqÈÅ÷ÊkI”„İ%_Uëîº?ˆ\\áÍA—½,Ê¥¨·—ÉÌæßÛ&7¥\'‰Ù0¹xÂÜµşqy-i—Ölæ`SÃeIq‰Ö£3/š!¾ÅŠ ä¨Öß/®³“ßo¦è ‡+¤m[\\r¹^Ml\0\rÑ²’¹ÊÑzõşˆ‚^ºç6£Ÿåá²„çñ\râEhÁV“óZÆÅï¶Š÷¢thòpå°f¯Üˆ:RâÁòpUX³&—¬z_Y7Ø,E¹®ª¶¢nWÕ³a˜ŸÅXIÈİƒåáŠÍ±XÌÛäÍ\0G3µ;)¦ ËÃå\\=ï¦oÀÂ\ZÎH“™fÎey¸RÀ…æS\'ª÷a£–(–<V®OõpåğÜ¾„ô{ Ú ¬ÿa£f«d¤òBşôpy¸öJóÊòbºdXh £Ñ\0³eÛl<\\®ÔpÉn­›AaÇU\Z0Xø63ÙÃåár;­üğİêÙÅ—¶K?>!³Ñf&0[õ…¸0<:\\ëÀ¯#—]¶¼ûµoÛ;jÓÌáV¸Ä43Ğì5‰ÅÌƒ™QAMsĞf—/„¿w…úö›o<`®¶òÜ³k•¼¾Û¿W½:wbd•†§şØSpŠE‹° Alä±ôçÃæÚlõüòØ}üÑ¿ızòpµ6÷ïûBé/\0ûä™{b¯Ÿ?mIç¼×\"š•z\0\'.‘È_UæëW_ôpy¸~”·ßzUÙ^?|ûµúü•§b›¯è>	Ó4Ÿ‚£!9ôÃ‚Æ2z\rÏçSêòÕ¶ÍÖqÃ<dÃòpy­,†¨W`¢Å¤‹-¢˜·@‡¸à»\nTüéÒ¼\',y±ay¸š|\00a\\^ûŞ~Ñ©›¾P%\'?L÷¯ĞVÒ¨Óªİ­Rß|üAìx±ay¸š|\0L_+êÅní˜¾hmzùa€SVßøÎ.`}·g·óx½ø·?{¸š¶Ôiı£*éÀXd.€‡híQK3QjuÍêÚ¿1Ø¹G}¿o¢±Úöş{®f”?İ±R½³ùM•æÅîí\n˜ğ\0¶ò‚~ä†ª¼ä€#ÚŠä¯^hOØeÏÁ¤/LÃ±cFªÙ3/VK¯[èájT¹mõ2uõ•³Ôyçœ¥N:qêÔ©“úàƒTÚWÀÄTÔzè¾ZZmµõÆÙeí‰ğ\\L@‚9iÀ’×Ô©Sƒ±9ıÔ“ÕŒ‹ÎS‹^lp®ÊXì˜ìœúÛj‚ûöí«¦M›¦*}}ï³‡×5HY“¡Å2êîûñã«Õ–fµ2ÿøÌØœ•!q*}=ôĞCjÜ¸qêä“OVıû÷W]»vm5ltS&6>6@W…‘QŸ<iÈ!jÌ˜1ÁNŠÜu×]*‹»:fS’E+ş˜ô\0Lµwş&µ©È]›MkŸ‘*4ò×»¶d2>¯¼òJyÌE¶îİ»·™«=z\"sÉéáª“fb·c\"Ì	êÕ«W\0“ü¿9¹;j–¯ıÿ|51`¶ü˜h™÷~?#ğ‰œ:ó¸vUŞÓõšÚJQ¯Í›7[ÇaÓc~\0M4›	°¡ÙØ<‹¦ÙZŠ>“iæ1)À4räH5yòäòäEÁµlÙ2•õ?ìãukRA&º$Wµ†]»jŞ,&fŸJ—/ŞØù˜¬[·NMœ8QM™2%.İ¢@&L˜ N;í45xğà`£4ÍHÌı\"€ÖRD ÄÌ¦°]1®Y³f©j¼0?ıË½©·®Í\0M÷ÍÂ³ \\nl©…h¾–,Y¢N=õTuÆg8Ãe\n¦À¦k¶¼ƒÖ’W °¹u ĞN°®™â$\n.dÛ¶mªZ¯/·¼ª>Y{sì=Á.¡|Ì;›Tò¾¥Ü³ñaõÃWûª6cÇ\rà²m„®p™‚fÃŒÔµ\Z¾vŞ@kÉSŞ‰Á©¨$p­\\¹RUóõİgªÏ7>TFPË©BµeEPDô„ş¿|o“úŸï¾©ÚóoÜ¸1\0+k¸\\@Ãoz¸ØiĞRz0‚ÁJ”.2àD§l©²oß¾ªÆâİ»i]«Ú>Bîl1÷W,%­‰v\"ßERri{_z\\}ÿÅ§ªÚ¯9sæ”áb“4Ç_ÂòYÌµD!1å}	†\0Y½òi-õ„Š(îGÅùPI%ngäó²\nÉ»h±=î-¦eñg&ÅÁÕÖVòzıõ×Ë`‰$µ,*|rñÏ€Œ\r¼ÖÕ.Ê`ô\\P‰YP)\\ø~øaM\0cQïß¼±.E»˜§µĞV6­%rÖYgÕ.¬ =qÍ†^+¿¬¥–>•®©€Êf*d)øl|VØçÈ¤ÑªåK|±ZõõöÍ5}>İ×Ò…|­á’h#šL‡ÿ¾!àâAPÍµ‚J7\røLşŒ‚ÁŒ©õë«÷_5³}oü¥ª‘@ë¹·’k­\r.¬	İ –A\nSËe>™\0Fğ¬šÅ-Õ©ë<X5abB˜@&ˆ‰Íeƒ‹6ıj7¬y±ÒâÇÊª/ş¾>ĞõxáÃÚÀBôÀ’WØ¿?ıôÓÕèÑ£Ø²\\\'¼Ÿ]$Z\r¬¥šÚJ©g=@ú@1Ã‡o39²K1æï¡ùïkÜƒ¬RŒ(à·»·×ílA]Øôdü±^dmDı.£FRgyffZï =²Öb-ÕXÈ‘uX¼í$@18Q“!p±K™ïÃ$Ù~§æ¡²æ\"šªPÅ™ƒ\"z•†˜ìƒ\rr†K,“¬6lİÃÒÊ*à‘)\\’¯â‹¥ÉZC±s%™\0¾C˜Ó,•¶İµæ¡-²øÍ®-‘ ¬e0êµjÕ*\' düeã;á„RÁeB[i®ŒõuÜqÊë%-Ö’eŞJ‚hŠ,ƒ{2pq\Z*Jd°Ìïƒæû…ª<½\0¿\rE¢ŞZÊ5:—¤IN9å”ŠáÒ}4,¥´fã¨Q#[Õ-æ.ó•Ís5û ›•Fz\0ŞÌuI„*Lêéµ1÷îUûo\\­>9îDµgÚêÛ—7åæ»¡åÃ¬\0Sô(±ø:Ã†\rË.2İ¿s	°è‚%Vw¸8kÃ—8p`\0†ÿŸDK1 L–İ§OŸò™!ıó\\àeG®÷ëË;ï	 ú¸[ŸVdßïÜY÷ï7}úôDóaæ¸¢,ˆJ˜YS¶ã.fäX|.Ö,&¢9*ñ¿Z²Hó%ørbz˜|Y—ãÕ`	Ç›i\0—ß­eõF›DóÛï\0™Péth´<ûY¶*\rÖ‡øæqDVÂ\Z3ÊTpÁ\"«\\älUzÃö@„Âk1°8Ì¶ïáúûìÌõ0£ ²i1`¬åkıúõ©æCæ]æ$+ó?­&-e‹ˆ†eVs¸ˆ¨D$;‚®½j•ÈĞ¡CÛDm9®(©U€_êÓSF&K—Zi±-[¶¤Æ^´ÖD­Ö-Âˆ&“¨¥ÍÂe–&É\\\\’Ï\nË7È®\0dìµ„**b˜.¨¾URù÷âëÕ×_]U°\\aU\Z²éY½àM†i\Z|“ïŠ…V3¸$§V·g†\\ë9ˆİºukµ;1ÁiŞS(ó0ûÎ±¾UÙ1~RĞqiïŞ½™W—D±‹+k¢–&aT‘AT­«ìHÚª¥’ 6©K‰I½M\0©#“ˆa%;/;wV¯Ï>ûLmÿëÌÀ\n‚SÏS[·nU/½ôR¦m\0+id0ÌK‚ÿ®\'\\ÒG1.\'+>bÒàF*¸äèˆKu»˜†¨ë êÑ J¢“YUpĞí\róÑú§2…Kü®ıû÷«×^{-hmöİwßå,Dü-u%›\\V9PÖ†Š³À’Tn´¤©Äˆ\nbèõúqû~ıúÕ]ı‹mÍÉn¤K’*ZZÀXèï¾ûn°è€W%ASôÜŸ…ö2ù¬4/:6\rDX(5‚˜yãÇ|ZÄ¦Ä’aıÔ.ÜQ¬Yr¬¶.UâJ$Õ^-iCïQGòe±Êà²¸™„z\r¢^c¨O8\0~ß—•ïÉ¤Ë.%>¥,Š}Â4€±Øß|óÍ6=ê‰f©µlæ\'Ÿ›Æ“Öh¶`\0c\"°ØºK?IÆŸqf¼õ`FÒZÑjº¤°\\y:|ëª½ZÒh­(_K·£@& wïŞ¹j ½lm”M‘§^Eoj·$\'˜ÅL[àû®[RXŸŸ6fh’Ë\'ÂÀ25˜^•ã*¤H*©ÍB˜cÑZúw	ë8&¡y*ç3‡K\"„a¾;“ù\0,J¾TÔ¡¸Zf©m’Ñ¨=T˜è»®˜µ|Ôë@\Z$êõùe¿LfåZI4§‹F»o×±ÅD‹ÉÎ.ş-ÂÏØĞ¤ÆS¤k9é¤“Ê®Í<å™¢|/—²¨Dpq,:,ºbÒ¯Qòïë= ˜|UøS\\b²èàé©ŒK­cT‘ïîİ»áâó\0Hš\\ZëG“¨ˆ&Y`iª/˜{é!(c‰f.\\ş¾‘c}= aëÖ<ÜiúŒ.E½ÎpÑÿ-ª7jw—cÕõPÛî%æ\"f~°3©³mŒŸ­]»Ö9Z÷Å¼©ÍB~7É‹@€}şùç™”5éf\"c\'f\"óN£^QpzØ¡Y›\"AÁŠÊ.9Rb+±™ƒfÑ$PæipÑbº	#ƒH86mrSO2‹¿²|ùòªƒ%’ô(\nZõÂ/,çî*)k2M*­˜‰,F|¬¼Í?k9n®m;‰>Çuõm©4!!Ì8“]\"Oƒ+¦ ®‰%úUÉûâ«è9!4zœIHéSÑB*=’¼şù²ùÃÆehœ±Ô«ßó6ÿ€ïZ©cF]Ãò-IšÍØº7¹NÈˆ#r5¸LvçÎ[ÕFFÙß•È†\r\"ËŸ²L\"\'©Ÿ7o^UÆVv{qş³8Ê_\rÍåj¡ <Ìu/foT`£Å5a+ĞM²ófs#Ç|¹QZ_ËE¢®+Ê²®0Ieü;ª6®h-	lÔ3¿·¹&­Ì±™†Q½ÿi7_Lí¢T˜\0\0\0\0IEND®B`‚‰PNG\r\n\Z\n\0\0\0\rIHDR\0\0\0×\0\0\0×\0\0\0‰}Äµ\0\00•IDATxÚí‰ÛÅ¹è¿?äŞóœQQD6ÙAPÜXdS\"\ZÄÄ1B7\\ãrİŠ ÑƒÆ5¸ DqAwOİùµ¼së«¯º»º§g¦{¦æyŞıà›™®ª_½k½ÕòÈıkT£Kï^=TûöíUÿşı)ıúõS}úôQ}ûöı·Ç{¬êÙ³§êŞ½{¬sÌ1ê\'?ù‰êÑ£‡õ3;wîù:tèü>rŞ9ST3¬¥$ÒÒyÅ¬Á`°¤Ò«W¯X¸ºté\n—¼G·nİb?çğÃŞ§s§êºEW{°š	.„‰/²öª`€Òµk×à}â>‹÷8ôĞCƒ÷x|uËÊ¥®fyPÑ^.¥‘mæ#c§01]>÷:äCT»’6»ä¢ó<\\Í\"ø^˜0Í—øGh`€Ğ±cÇØ÷À¿Jò™¼\'à2æ+–.òpQ&M8#0C\\l}&™Õe15šè°™‰l6.æ2€&7>x›5àQx¸\0ë°ÃS|pàWyšZ0ov\0Û=·ßèÍCCˆ8êp¡‘\0ÀUFEÃ~çˆ#Æœ¹±Í‰‡+Çp±@:ê(uôÑG;1 IˆØ&,&ÄÕhD-&áz	Ç»FR%ŸtìĞ|ÎÉCOôp	.&N&Å‚Fkñ;D·š0	và‹±!%ñ©*\ræá*\\¤ÀäAƒ>ŒûÈ#´\\³šˆ\nù.WÓĞrT¢Á˜;¿¹ƒ\r€˜¹&>0vmş-‹?›0ÉS¥ù=‚I6\'`”|¿Ë÷³ŸıLtĞAAd±‘’Ğ…‡‹Ğæ3ôîİ;ğÁ:uêY3UnTCr$™³víÚ•ç€÷üA\'W„oT\"”I0vÉ(s3±™ı¯J…ñO²IIÉ”>\'øËD~%t_x¸»‹‰áb’à—1¡a ¡ñ<,éMË¸jİtgŞlæ;¦b#”Q.ò&LDšÊvZN¯Á*«gtŒ1fŞĞT¶Mk?LÊ¨Š˜kˆò\'a&ÊC‘\ræ !°A0*êH	h +bø¾!àbgûİ/îü9â6;ñ»¢ƒM½ÕÊ×y³°^‚]Î$±Ëù…‰óƒãàÂ›6u’÷¹ò’¯¦iˆ?ÑÌ	ç¬ÍCàÂäƒ‹TŠ$œ‹Øhi­EâQLÃjW¼óşŞ·KfFÁE9Ê,0\0”ã+D	Óá¬X®á\Z‡•’ªßlœa¢M„n‰.ñßÕ.ÈM[W×¬å3ÌK¯şÜ9gOôpU’¿’( ÀÈ¹#lºL$»\\Òƒ}iBøÕşŒF*¶™Òü,ª\ZŸÊ}Ò\"¶f;æÍñfaVìpRÃ†\0QØÉZI@¦­•Kâ5[OJ´½M£¹æ&ä>s:ğ¸şŞçªFÿİ~—j\0&‰Ÿ›G×kq^K*=ÂD£€§shø`X5®Œı¯0„ihˆb&\rÍ§)àå³l€±Ó\"E„L,—>‰õ€ÿ¨’ÅP„èa¡¢…h°($Í3P¢LIL·¤GØe7¥ºÛŒŸ‹éÊB-Z\0DÚğy±.BÅFáBñ¬sÑHrm\'\'•]4Wš*ówùL³ò>Ú I÷^@“šÌz~76Ù¼°,\\pŠwÕ2ì¼D¨csI\0§Í“ñŞ6ÀÂúVk‘¯˜¤Ò»RÓ4®¹¨h7ù\\‘jÈ8ç½GKQÇTK»VK0ÉRj<Q¾UZíÅ–’Z\r$]œY-Æ¨^ñüÑp=\rÀß¹ö ©¶–F{åÙ÷*l…Fœÿv O Ã´\"hi«0ÄOA«’Ğ5FXê ‚JµK¯øj‹íl\\–ÚŒ7ÁÃå(ØÑä¶D¢z*œròTÅº,<\0:<¤A( mK5In4˜À«8ÒŠh×3gõÌ„K\Z“fÕÄ‚ñp%0ùˆI‰“Üas^ÏF\0€emßKh?Y¦C$=<²ÌÕÜ©Æç¥…²Nîc½ä5ï•[³ğŞ;W©	à‘&ŸfuôàAƒÊ ,²n4“Ö<4£„’læçÕ,¢Ã¥I–¾XMÃÜû\\gO™X.–È(Şe·Òƒh/ş>ë1m‘nX”Pü¨f\0L‡K^´l–5¨®”‚ù\'m\"ÍıuIï»Õ±©iK“\\òy$©œ4úVT¸lã•ö’^yì±Q¸0G›ÏŒ3B˜‰Yh1\0à}ÒïÉÂ`6*\\ñûû¬JÃ˜ë<6mÉs¨]oyÜí˜®‘swÄœ“ò§J|1½(‰gJ²·‘ ’ŸQ§ŒEƒg.Aûæ.¢…)$Xˆ)Šm‡”CvYZM¦ÃAÍbÒEáâcÕ;²—•0ÎŒ÷äÓO\næ¬İqòXk˜K¸äòì™3RC &­À05‹qÉªrB7‹ê‡1&Ò-wÙìóÕgîRíÛ^>©PMÀø¬WÒÆ3Ã†¤¾ØÍšŸL\nz™˜8SOJ›Ìğ:*ÉÂ»İ1,o•g˜a&ËE\nŒçˆÁÔó·-ÀBĞ^Œ·ËûU’§”ËÎ=\\	¥SÂÈŸë¢4‡ì¶R­!tÒ½H\nSmïdTß\'ÌÕÇâ;Ö2Ùt\0†?õ~º\0éé]\"©‘]:ª[ç_Z†J\rÆ¸º~´€IË\0WÂ\nø¸^Òš‹ß’¦ä\'¸J¨SÇ`çº‘Rúy°Èta×”>iœV‹ºÜ¼˜€…írçXÖšÉ&À\'×°\"×L?[mì¦6`!üSÜåBÂJCô|—Õ7\\ïáJâ{Åå¬Ìjˆ4¾Âãúª·î[^^ënXÈ×ıW°x0o\0ÏEõíÙF1?%üÄ“…–à½\0dÁf¡Ùt-/5ççãZY˜\\8~xğüÕ®¦ç{-ÏÙù®\\ÃEK5—„pÚUÌEFÄ.¤Â¢NÌ\"›6DÓÉU©¢åÂ4….æ}ÏÀ¦·–ËZs…\0…°q`ş…i*›àƒñ“nIMDWŠÎO.ÉÛ4Ú‹…*Q­ZˆhC4aœ64µŸ«`‚‰©ªûJ@®@KpB\n-¥*’\nÏëÒŸ°À<\\)®duÍM¹V:°ƒ–ÍÏ³œ\"l*‚ùU) ˜{¼cãbò%¾O\Z¿Ñ0WŠ«\\árIÔJ€ h`UN]*ÑJILå£Û™ÊWtÌÃ•P\\›{J^\\h,vùf+/Â¦æRµ‘¦ÑÃ•®°R£¨vÇ6ÁŸÀäñ‹¼¾Âæ–$÷¥§K¢\0óp¥hš¦ŒÈÄæOåòR=a“KXØ906`\"’>‰\\!\\ICï8ÑlW¿Â‹›°ÉtÁšÈ¢é\rZíğöÒÈõ‘“0¸’„Ş±ñ›1€QÀ°&’&˜mWŠW\\®5„äVFêïsN…\"áÌvW­eó»°N8ïçáJ\0WÔ3qÚKîêzãÎßù…œcyîÆùÁ&\ZU=w~*—a9ì¾›[¸èèW\\`ƒJƒçSŸ¬õAŒ<ËîÇVª›æœl„æUPú7é×hÓ\\®Õ6¸Ü¸#A9O»ÃÔ?ï¾N}ºîV¿ˆs,l~=¼\\?z¨sL\0±XÀuş¹g{¸*‹Ëå(¼h-&íÓõ·ùE\\\0¸Ø{vî(DF“{\0fäğò\\Ã%­ª“ä¶t­ÀõÔ\Z¿ˆs,XÌòøâY±ş—­5\0pÍ½ârW¸ôã&®GäÑZ˜2a~ç®’e!s…Ø7öˆŠy¸–çğ®®ÂÀ¥‘3\rqˆÙù6,Ÿëá*(\\¯Şüër“°^æš\0Æ¼B.\\qµ„äµNè}L«Éò¸XpéÚ+,aT><§7´ä¹hW‡Ë¥©²dÆWä³§oo¡yæ?êü—ä¾ĞdGwèàáJ—X8Áüf…LÒîÿ¾Ñ/àˆ	Á¨0ÓĞô¹Ğf\'èáªDsÅE1\rL“ĞÃUL¸Ä4´…åÍ`p8ıW%pÅ4&Ãoš„®âÂE’Èo\\0ƒ VûÄ\n®¨zBr[f”ĞÃUl¸Ø(M¸$il–>ıò²é®¤ı3\\ÍB¢„ÀeN‡«¸p‘P¶EõÊ+×å>O\"*¯¥\'±Ñ=\\—®¹¢ª3<\\)ó\\.mŸÑZ³&ğp5\\˜øİºtŠ=(	\\y¼U²0Iä¨³[äB€Ëfx¸Š¯¹ÌF¢¶#\'yM ªB#Ìç’`“ááj,¸l=6°bô\n<6¦)\\a‰d	f˜‘BWãú\\ºß•Ç«ƒr÷!“¡—+‚ÂÚU‡E\n=\\—ŞbÍÃUA¸c&®Æ„‹2¶0¸t¿ËÃU\\qW±FÁõÑ#7øÅ[P¸æ5®o¡‡«¸l÷;Ãå«â.3ïáJ!æÍ\Z–Hq¦‡ËÃe»”ÃÃUa;ë¨»·<\\\rkô3m½â=\\ÂåwIK\ZÒx¸ŠXR?v¢ÃeëïáÊà\n¡¨ÃÃ’ÈÈg¾Ãi’ÿıÀRõÁ=×¶’÷W_©Ş]zq¨ğ÷òoùıJïµ}Í‚Ê[•=y‹z}îøàÏJŞC‡¨1@øŞæØ¹~¾í˜¸:wêèáªôò»¨ªxşİŸæ_l ¨¾…,€-+fª—.\Z¬şvv¯Ìäùsû«WçŒRo-<«„¶ÇÏø7üPT\nŸÅ{ñù=úÇÈDààßnºì”LÇ\0áùÃ¾ƒ\\OØªÊ„kØĞ!A±‡+å±jãús«4uK4d½ \\„…Ì‚Fôï…æBô÷”Ï1?«–z\\Ìi\\l¼®*ïRÉ¡÷*Œ‚‹»\Z»t¥’…Ö*_ÏS‚4oÏØlhQMAmpéõ…®eôÈÓpôÁ«Œ\'²¤7§ùdíÍå‰ó+o²ùÚó*ò‘ÂÌÃziª8-¦?«´³¶	¦¾^¥a¶TtÂ@WV×E•B‘³5˜<&“IµMö+—Ÿªşñ›Ÿ«.¿¼¤Õ~[òG–´~¶uåœ²¼½øÁ¿×…÷ĞåÅ&òKª‰Ã·J˜ù¯_5®Í³êcñ¯[æ¶/„Ÿóo_3R=?íX«“\0P\\f}¡	×È§5¨®”·KJ\"9ÎïblpíºI3…$6˜²NSøûj†ºYÄQŸ_íçGøœ7çOjZä‰€K„ÆCafaÏ’%“×æ4¹‡Ë¼9ªÊ×w/*i‘~Ü-KËN¼ıö…5YPI¤Ú¹¤<=ë»K§«—/RlÛ-óBá2«4L¸ºwëæáª4o6tk×ı×«—g\ràbBk¡¥ò\n×‡ı!wÏŒéÈfÇ¦·}ÍüP¸èE)—2´\rÅŸèáªDÚ•|.½¦,Ìï.}RŞ˜w¦ÚúÇ_ªİŞ[¨j×G¬Èåsï~ôjçŸsÅf—H6áê”ãÎO¹‚ë±›§¾jJç÷¤‡Uúea‰dİÔ\'èãÇWå,´Jµáúø‰Õù{öÿ»T}öÔí¡s&BŠ%®G¦V\rïÒj½<{ùÈ`-y¸Èã7şFıuš=ªunß#ÛtŞƒËV_øáƒ¿Ï%\\h•ª×ï•qŞ[îªò·$×%=ãM¸úµ?Dİ5ú˜6k†µÄšòp•„İFO¦êukF×æúV›ßE+l‚¸]’d2»e%/3,í*ø|q‹¬ê{—L03ŠYÉóT’gf^âàâÆ©Ò°”Ô×\nkG×`M×¯Y^êüÌE±î†­Âña~—­)¨Y¥ÁŸ®\ZŒÅCÈ>«ä)¹/ÂÑ­rC˜FOßQ£êó;Ô®û~€Aş)Ëç8\'¸4öúğQ¥O¶k:\\“ÇŒà2Ÿ“5$ßµÕÔp­[|Y9±h«RØşØM­Âñ6¿‹hR\\úû²È,B‹Á¦™ÃÕ\'›UŸoŞ¤~wş8uÁÀ#Õ¼1İÕÕcz¨	Ç\\–ãÛı‡ê}èÿR\'u9XÍÛK5´“ê{øÿV;wlSòúè¯ÏHšd5ü_7]U³ËĞ©ë#§ÄÂ{oÙ%?VJÌ¨¾Û¿·üçÏœ®NêúSuŞğnê¬!‚gB†õŸåg½xĞQêš3{©¹£º©Éİª6¯0Ÿ­w]@f&•)èeRú|›†f^\\à’D²Wp»ÉàÖ÷”Ä9k«©ázfö¸rYLØâhß®uÄĞô»pxmwõ*0_„”	¸m·ı*\0`ó²™å…·÷ó=jàÑÿGM;ıuÑèê„?)/<S&x´š>¦§š0øhuı‚+•şÚşĞªà9I^×\nª°…÷ÂƒZÅ3_zÆsNã{¨ãÚÿgè3NÖ9ØD&\ZÏÈFÄûn^tN0ŞŒmì÷‰H ë\"pµªĞèÛÇ\n\"Õ8¬­¦†Kü-[Q§ƒØ­[·P¿¸Âªâ%ZèRìúò%ÃÔÎ\'ïnÅ¦çŸS£ú¡~1¢»:»´°Â2¤´ó_:®·:dwuñäQÊ|½·z~¹2¡p±è\0`ß¶wÚ<ãğ¾í­uöĞègZzÆËÆ÷QŒê¡.={L«÷ùz÷Nõæ¢_8Ÿ\'c^ÒÂEëšég[ßWjHëíwÕ®\r…‹A4¯Òı®8¸âZ¬a.a&™‹NŞØí`ÖŞ¿:øÙê¥×ÚŞ1?U—ŸÙG]XZx3Ï«l/\0‹ÒÒÕ€¶U~ÆãÛ«Ë&¯¾Ü·7Ğdƒ»úŒ3\'ô\r´xØ3¢¥)9‹;ËÅ¼¸À%U\Z:\\D—Í>?.ÖVSÃ%!x.v=*ÅÅ1]zJ§6CİïÂá\r;‰×bêq|İLÒ_øNc©.8\0×k/m…krÉ,üqáõPËÍSa/v÷Zk/€Æ?²½€iìÀ£Ô•çªŞ{kSğŒ#úw³>ã”ò3öT×^uYè3òYo^sN¤c^\\àÂŸ6áb=ã²e¸X[Ş,4Î3Q)®G¤\Z×­MÄP÷»bá\né¥±ã®E¯÷šó‹3Í…É7½¤•=â?Ú,º;¤f•šëç§v\r´AØß_sMí\ZÀ”4A•¨×‚K¦”ŸQhè2º_;uåYıƒg<\'æËÏyGø‘°ÂàB›­›Ø£¼FtÀ$$ßôf¡À¥›J=~~Åhµù·ÓTûv‡µéY\'~—\\4B1ûı[^S./´×9§÷V3Îè¥~9±Ÿš{ö\05uh§Ò.Ş1K‹rŞÔãÔìIÇª‹Jğıqñ¯bßó¾û¦fp}ùŞ&çg¼¸ôŒ³JÏ8{R?5iĞÑågœUò³æÏØ/xÆU×/p\Z»¾Ú§>yæDiâà¢Ö”õÀÚĞ7a3 Ñôpé%O28rŸQw&lö­¿Ë¬+LÒKã‹¿¯WßîŞjÊë·ŞPs/šìì@tåYÔÕ??.`›3ùX5c\\õğİ·Ä.¸¯·o|­àÚûÒãê«÷_Wßñi,`ÿÿûZŠMáyyÆËK~Ù+—Æj, â3÷l¸/ññş0¸ds%¸ÅÏ.é\"gÄd=±¶|ëÀ`08	S9ªNÕ´”Á˜A\rñ»\\àÒO$[¥´>~únµçµ\rAÔ+ìõì“¨;…ºmñµæºK¹ûWª\'î]ø.qÚŠ…^ÏVfßìÚÿÏ®U÷­úµºµôŒ·-¾$şû¡Û–D>ã76ªOşöˆÚóÜƒaø›Ã¥G\nI½è½G$—Ç\Z’Ÿ7}‹\Z0‚º}.¦!Er_“ír7¸nJtÀğÃ\'nUÿºgIà˜GÁ÷bÿúÃmjÿæ¡»x­Àì«]ÿR•¼|¹÷/S»\\¨UkËÁŒ5—O*»º©/İ¯z×æ¢¶0ìÈ»D©f é§Ô¿‹Ğâ&(í\'Ÿ>}GøØzëÂÀ9\'Ì,•aÂ‚ÛùèÍjç¨¸Ÿaµ“Ê<pü{ıŸ‚gã»‡=9@6œ`,Ö\\£>|8ıE®ax\\Ì÷_®Zî?¢¿¯ó…»ZPƒşfn†Ÿs.KÎ™A\rü®¨Šø2\\19—4åD6ÉºÑL­ÅÖU$ëBâ$p‰¿Í|Ì ÈeKÈKJ_¸{@Ö_sQ+¿K¬`w*\r$ƒŒmVj9r«Ğ­­Ÿ½»iúÃ‡F–>ñœíãŒ—Àen²XS®%mù\n	«n¿m~ùøÔ@“¹ÂÅ‡\",<³\\ëóçhšşğa\Z~7ë\0¸ÌJ½u^Lææ$²Tj˜¦!6õ;~]îdVjHBÑ	.í¸CŞM³VpıíÁ†‚+Iãÿ—l¤¬à2ı-1	ë]™‘;¸ô|—¾¸¨ûÃ®Ö¯•±ÁekZIÄ°²ãkZ}×½/>ÖPp%‰¾´üŠ`~9n‚K€‰ÈÏß_uE«óºIXïüVîàzbùÕVÓPrzO3™uËI« Æc+aî¸}aCÃåZ\r<0{J.Šuåhı(õ`†n²–<\\š<z÷*«i((¡[Zë\rkC=4°Ãk1¬Z´—µ‚ë‹WÖ5\\IÂğÇ¤`\\‚—Ûl0-u¸t“µäáŠ0\reà$´-B¾Ëô»øÿ¨#\'EŠîº÷º¶pıı©¦^6¨sP$Ğ¥K—V—êål’²É“I˜;¸ôj\r3¡¬ïvf¾+ê–“¢E‘c2Àµïõg›2RH³Ğ]àbõV:\\zâ8]ŸrÛTO\"a·a ¥äŞ.©5‹ê¡ÖO#—×-\\ûßz®q\"…W™òÎï.úV~Ç4Ô­}Ìd½ÔûpdîáÒy©³ÁeÖ\ZY{\'¸r1ä»5:\\I\"…T½qÈAÁå†˜„–Ïm—^KXïBİÜÃ¥·ZãAX§ ı|ÑÃ¨KÇ³¨1¬•/\nWNŠ~+f<¶Ò.úü3¯ÜtÒº/åŠVÇ“òÒJ­½â¥#”ó2øXºiè\Z×\'&ÏpÉsï}áÑ\0®F©Òp=ÚÏIæŸyEtŸZ6Hj<eÔ»ÓSaàÒs^’(4á\"ôN^àÂ&_2cJ¡ƒ\Z:\\D\r%ÇÕ(p%	fHEK¿P^àÊcn«·œHÎKêÇ>ûó­P¿^,ªwa‚\Z†oT¸’38®Ã¥›ü\\,¡›„y)w*\\¶ãÿ¶jé:$Êää.ñ¹¾Ø´¶aàJÌ[(OîÕ©Í¼ÊU¼yÌm®\'—\\Ñ&¡lÂ””Ô¹Fó\ZÔØYzNK*ãI 7\n\\®•ä·¤Å`™	\ZPÚ@äÕ$Ì5\\ú1	É£qÌ;s18@\'C×1Ï	ä Bã€éJéÓ¾76Dé\"H@ÙT½Úd»û”+œó[Òù‹\rS÷·¤“—Ş×2/åN…ºYÒ,äµ]9£›†îÃå¹ZˆìèºIˆ$\rÈïí<p‰wîü-‡ë‚ôüódf~KêC¥;Ø_.>Ùß,™\\6Ó“ALC\n;]áŠíU£Šª4p™ZA“å­úÄ®²;p÷¢¶şÖ—Ş„……KJ¡ô:Cs|òWç–£†I\nxë}ü„<Ö»K¦[ÁÊ®-7ÌlÕË¯(Écú¥\\Ò;ÅvªÁÃU…n¼²n½qvy¸¾“c(wºÂUïd2G$Èå„ÂUò±Ã#œD& !Bb9.ó*ê‚‹<&%¯Kpq|Éb!ãáª2\\dæ¥§¡Ü›LB™p¼;\\õK&Ë‰m·Ì…‹\r¨f-Ù÷ÚŸ­¥P¶÷à¿zÜ¨RIò˜’\'.æÚ¼1Eæÿ©_MópUR¥×êö`*8[õcÔ0)\\õJ&\\a`é>S ©Dƒm|Ø\Z5Ô~?¸kQğ»»î»>€K¿à\"ïşV9 Ñ\'s+™Ï‘§.O…„Ko¹fv„bĞõ“¨:™Ğ,t»¯ZşVœæ¢†kDSòczŠmñ÷Y§·:Y÷cıÒ.M÷±Ég1×¦öpU	.v1³äâsÇ\'æLt?éúÈ\ru[p,–\\35Ğ4ø@€´uåœVauóv–°zDŞÇü·¯Ì<­PşÖË3†¶9j$ÇJ¼æªâÙ.İæf73\'pÓWg°Ù“#¯—ßÅó¼~ÕØò³ğ§ô á‹Vşİ¦K‡µ2Ÿ0Åò)tÍoI¼yHVïo;ÖO%‡«Âcÿ.í”™Ü·Ü[ŞÙïªs¾Ë\0è‚kd5ÀÌVkÀÆïÉß¿¿ê¿­‡|”³&<®·™ˆIèâ#2>y<Ö_(¸(k‘A4@ÚDz)È^EÈwE]€şöµç¶òÃĞbfÒ9Ï=$Éo…™„Qóœ‡Ë\nBy‹­oTNîô*r¡ìĞøea¼Ua¤­\'Œ2	m‘G‰ æñ€d¡àÒı.½ÃªmĞõbN´Î~W^y¦Î?>ğ©0Ñfh«¸@G‘ê	¥PW.L7	óìo.½Y¨\r0š•Ñ9$ŸÓó]ææßU¨’ß²%1ıL“W+o\n	—?Ñ‹½5Müü®tâ-äù-‡;¸$q,İ›\\æ™“‡[L\Z.óğ¤M(•’È‘\0–Ä4,’F(D¿£-C\\-¡øOX*z~Ó&y7—´]ãH7 !ü7»¹‹Éä$ÉyıFÈ¢öËãüæibæš¹5ç;oíÓ\Z®4½1;Š’oä›LäxIü\'—¥è7IÎK?Ò·`Î¼$ŠÉå]Óº„à)ÏÊ{	“‡+¦÷¡k`#ï}ä«qñw½LB=·U$SÏÃeœd–Ë½i˜“ğ­…S\n‘öpÅTÕ\'	läÕ4,Öı[+œy®\rôpÅ6$oâ\Z–o¶¨aÖÏëbJ«êF\rd4\\zç^Wí•uB™*u—z9|)‚T…sÖK—¨â\\ù=ù·T6ğHRŸe€Ä¥PW*2Š’¯òp9„å]¢d‘PÎk•@¡4K¢|¦È‰j—Ê ÑĞÏ…	ÏïiBı÷–Ÿñw|G³•Bµze0Í µš.½Ñ\r¡ßZÖ\ZŠFB3°ÈMdJ„rá\0 ‚t>^à-ÅŸQ>b›ğ^ü»¬\".µ„~ot­Õ4pé‡.İ´Wşîğ’C”\0…äñWÜqşfÒZMW\ZíåË¡²ïğ$Z+¯\'x¸2Ğ^N‘Ã:6¯iÄL¤Ô)ÏM<=\\5ŒæıÖÜTd·~šB…ŒäµŠpTÄÃUaäÓ¯E¾œ¼Hç¶äÖ’<wÇõpeÜÑ¥b¤¨(½¯¥W¾çõ-WšŞĞqÈÅ÷ÊkI”„İ%_Uëîº?ˆ\\áÍA—½,Ê¥¨·—ÉÌæßÛ&7¥\'‰Ù0¹xÂÜµşqy-i—Ölæ`SÃeIq‰Ö£3/š!¾ÅŠ ä¨Öß/®³“ßo¦è ‡+¤m[\\r¹^Ml\0\rÑ²’¹ÊÑzõşˆ‚^ºç6£Ÿåá²„çñ\râEhÁV“óZÆÅï¶Š÷¢thòpå°f¯Üˆ:RâÁòpUX³&—¬z_Y7Ø,E¹®ª¶¢nWÕ³a˜ŸÅXIÈİƒåáŠÍ±XÌÛäÍ\0G3µ;)¦ ËÃå\\=ï¦oÀÂ\ZÎH“™fÎey¸RÀ…æS\'ª÷a£–(–<V®OõpåğÜ¾„ô{ Ú ¬ÿa£f«d¤òBşôpy¸öJóÊòbºdXh £Ñ\0³eÛl<\\®ÔpÉn­›AaÇU\Z0Xø63ÙÃåár;­üğİêÙÅ—¶K?>!³Ñf&0[õ…¸0<:\\ëÀ¯#—]¶¼ûµoÛ;jÓÌáV¸Ä43Ğì5‰ÅÌƒ™QAMsĞf—/„¿w…úö›o<`®¶òÜ³k•¼¾Û¿W½:wbd•†§şØSpŠE‹° Alä±ôçÃæÚlõüòØ}üÑ¿ızòpµ6÷ïûBé/\0ûä™{b¯Ÿ?mIç¼×\"š•z\0\'.‘È_UæëW_ôpy¸~”·ßzUÙ^?|ûµúü•§b›¯è>	Ó4Ÿ‚£!9ôÃ‚Æ2z\rÏçSêòÕ¶ÍÖqÃ<dÃòpy­,†¨W`¢Å¤‹-¢˜·@‡¸à»\nTüéÒ¼\',y±ay¸š|\00a\\^ûŞ~Ñ©›¾P%\'?L÷¯ĞVÒ¨Óªİ­Rß|üAìx±ay¸š|\0L_+êÅní˜¾hmzùa€SVßøÎ.`}·g·óx½ø·?{¸š¶Ôiı£*éÀXd.€‡híQK3QjuÍêÚ¿1Ø¹G}¿o¢±Úöş{®f”?İ±R½³ùM•æÅîí\n˜ğ\0¶ò‚~ä†ª¼ä€#ÚŠä¯^hOØeÏÁ¤/LÃ±cFªÙ3/VK¯[èájT¹mõ2uõ•³Ôyçœ¥N:qêÔ©“úàƒTÚWÀÄTÔzè¾ZZmµõÆÙeí‰ğ\\L@‚9iÀ’×Ô©Sƒ±9ıÔ“ÕŒ‹ÎS‹^lp®ÊXì˜ìœúÛj‚ûöí«¦M›¦*}}ï³‡×5HY“¡Å2êîûñã«Õ–fµ2ÿøÌØœ•!q*}=ôĞCjÜ¸qêä“OVıû÷W]»vm5ltS&6>6@W…‘QŸ<iÈ!jÌ˜1ÁNŠÜu×]*‹»:fS’E+ş˜ô\0Lµwş&µ©È]›MkŸ‘*4ò×»¶d2>¯¼òJyÌE¶îİ»·™«=z\"sÉéáª“fb·c\"Ì	êÕ«W\0“ü¿9¹;j–¯ıÿ|51`¶ü˜h™÷~?#ğ‰œ:ó¸vUŞÓõšÚJQ¯Í›7[ÇaÓc~\0M4›	°¡ÙØ<‹¦ÙZŠ>“iæ1)À4räH5yòäòäEÁµlÙ2•õ?ìãukRA&º$Wµ†]»jŞ,&fŸJ—/ŞØù˜¬[·NMœ8QM™2%.İ¢@&L˜ N;í45xğà`£4ÍHÌı\"€ÖRD ÄÌ¦°]1®Y³f©j¼0?ıË½©·®Í\0M÷ÍÂ³ \\nl©…h¾–,Y¢N=õTuÆg8Ãe\n¦À¦k¶¼ƒÖ’W °¹u ĞN°®™â$\n.dÛ¶mªZ¯/·¼ª>Y{sì=Á.¡|Ì;›Tò¾¥Ü³ñaõÃWûª6cÇ\rà²m„®p™‚fÃŒÔµ\Z¾vŞ@kÉSŞ‰Á©¨$p­\\¹RUóõİgªÏ7>TFPË©BµeEPDô„ş¿|o“úŸï¾©ÚóoÜ¸1\0+k¸\\@Ãoz¸ØiĞRz0‚ÁJ”.2àD§l©²oß¾ªÆâİ»i]«Ú>Bîl1÷W,%­‰v\"ßERri{_z\\}ÿÅ§ªÚ¯9sæ”áb“4Ç_ÂòYÌµD!1å}	†\0Y½òi-õ„Š(îGÅùPI%ngäó²\nÉ»h±=î-¦eñg&ÅÁÕÖVòzıõ×Ë`‰$µ,*|rñÏ€Œ\r¼ÖÕ.Ê`ô\\P‰YP)\\ø~øaM\0cQïß¼±.E»˜§µĞV6­%rÖYgÕ.¬ =qÍ†^+¿¬¥–>•®©€Êf*d)øl|VØçÈ¤ÑªåK|±ZõõöÍ5}>İ×Ò…|­á’h#šL‡ÿ¾!àâAPÍµ‚J7\røLşŒ‚ÁŒ©õë«÷_5³}oü¥ª‘@ë¹·’k­\r.¬	İ –A\nSËe>™\0Fğ¬šÅ-Õ©ë<X5abB˜@&ˆ‰Íeƒ‹6ıj7¬y±ÒâÇÊª/ş¾>ĞõxáÃÚÀBôÀ’WØ¿?ıôÓÕèÑ£Ø²\\\'¼Ÿ]$Z\r¬¥šÚJ©g=@ú@1Ã‡o39²K1æï¡ùïkÜƒ¬RŒ(à·»·×ílA]Øôdü±^dmDı.£FRgyffZï =²Öb-ÕXÈ‘uX¼í$@18Q“!p±K™ïÃ$Ù~§æ¡²æ\"šªPÅ™ƒ\"z•†˜ìƒ\rr†K,“¬6lİÃÒÊ*à‘)\\’¯â‹¥ÉZC±s%™\0¾C˜Ó,•¶İµæ¡-²øÍ®-‘ ¬e0êµjÕ*\' düeã;á„RÁeB[i®ŒõuÜqÊë%-Ö’eŞJ‚hŠ,ƒ{2pq\Z*Jd°Ìïƒæû…ª<½\0¿\rE¢ŞZÊ5:—¤IN9å”ŠáÒ}4,¥´fã¨Q#[Õ-æ.ó•Ís5û ›•Fz\0ŞÌuI„*Lêéµ1÷îUûo\\­>9îDµgÚêÛ—7åæ»¡åÃ¬\0Sô(±ø:Ã†\rË.2İ¿s	°è‚%Vw¸8kÃ—8p`\0†ÿŸDK1 L–İ§OŸò™!ıó\\àeG®÷ëË;ï	 ú¸[ŸVdßïÜY÷ï7}úôDóaæ¸¢,ˆJ˜YS¶ã.fäX|.Ö,&¢9*ñ¿Z²Hó%ørbz˜|Y—ãÕ`	Ç›i\0—ß­eõF›DóÛï\0™Péth´<ûY¶*\rÖ‡øæqDVÂ\Z3ÊTpÁ\"«\\älUzÃö@„Âk1°8Ì¶ïáúûìÌõ0£ ²i1`¬åkıúõ©æCæ]æ$+ó?­&-e‹ˆ†eVs¸ˆ¨D$;‚®½j•ÈĞ¡CÛDm9®(©U€_êÓSF&K—Zi±-[¶¤Æ^´ÖD­Ö-Âˆ&“¨¥ÍÂe–&É\\\\’Ï\nË7È®\0dìµ„**b˜.¨¾URù÷âëÕ×_]U°\\aU\Z²éY½àM†i\Z|“ïŠ…V3¸$§V·g†\\ë9ˆİºukµ;1ÁiŞS(ó0ûÎ±¾UÙ1~RĞqiïŞ½™W—D±‹+k¢–&aT‘AT­«ìHÚª¥’ 6©K‰I½M\0©#“ˆa%;/;wV¯Ï>ûLmÿëÌÀ\n‚SÏS[·nU/½ôR¦m\0+id0ÌK‚ÿ®\'\\ÒG1.\'+>bÒàF*¸äèˆKu»˜†¨ë êÑ J¢“YUpĞí\róÑú§2…Kü®ıû÷«×^{-hmöİwßå,Dü-u%›\\V9PÖ†Š³À’Tn´¤©Äˆ\nbèõúqû~ıúÕ]ı‹mÍÉn¤K’*ZZÀXèï¾ûn°è€W%ASôÜŸ…ö2ù¬4/:6\rDX(5‚˜yãÇ|ZÄ¦Ä’aıÔ.ÜQ¬Yr¬¶.UâJ$Õ^-iCïQGòe±Êà²¸™„z\r¢^c¨O8\0~ß—•ïÉ¤Ë.%>¥,Š}Â4€±Øß|óÍ6=ê‰f©µlæ\'Ÿ›Æ“Öh¶`\0c\"°ØºK?IÆŸqf¼õ`FÒZÑjº¤°\\y:|ëª½ZÒh­(_K·£@& wïŞ¹j ½lm”M‘§^Eoj·$\'˜ÅL[àû®[RXŸŸ6fh’Ë\'ÂÀ25˜^•ã*¤H*©ÍB˜cÑZúw	ë8&¡y*ç3‡K\"„a¾;“ù\0,J¾TÔ¡¸Zf©m’Ñ¨=T˜è»®˜µ|Ôë@\Z$êõùe¿LfåZI4§‹F»o×±ÅD‹ÉÎ.ş-ÂÏØĞ¤ÆS¤k9é¤“Ê®Í<å™¢|/—²¨Dpq,:,ºbÒ¯Qòïë= ˜|UøS\\b²èàé©ŒK­cT‘ïîİ»áâó\0Hš\\ZëG“¨ˆ&Y`iª/˜{é!(c‰f.\\ş¾‘c}= aëÖ<ÜiúŒ.E½ÎpÑÿ-ª7jw—cÕõPÛî%æ\"f~°3©³mŒŸ­]»Ö9Z÷Å¼©ÍB~7É‹@€}şùç™”5éf\"c\'f\"óN£^QpzØ¡Y›\"AÁŠÊ.9Rb+±™ƒfÑ$PæipÑbº	#ƒH86mrSO2‹¿²|ùòªƒ%’ô(\nZõÂ/,çî*)k2M*­˜‰,F|¬¼Í?k9n®m;‰>Çuõm©4!!Ì8“]\"Oƒ+¦ ®‰%úUÉûâ«è9!4zœIHéSÑB*=’¼şù²ùÃÆehœ±Ô«ßó6ÿ€ïZ©cF]Ãò-IšÍØº7¹NÈˆ#r5¸LvçÎ[ÕFFÙß•È†\r\"ËŸ²L\"\'©Ÿ7o^UÆVv{qş³8Ê_\rÍåj¡ <Ìu/foT`£Å5a+ĞM²ófs#Ç|¹QZ_ËE¢®+Ê²®0Ieü;ª6®h-	lÔ3¿·¹&­Ì±™†Q½ÿi7_Lí¢T˜\0\0\0\0IEND®B`‚');
/*!40000 ALTER TABLE `tbImagem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbLaboratorio`
--

DROP TABLE IF EXISTS `tbLaboratorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbLaboratorio` (
  `idLab` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nomeLab` varchar(45) NOT NULL,
  `capAluno` int(10) unsigned NOT NULL,
  `numComp` int(10) unsigned NOT NULL,
  `statusLab` enum('Ativo','Inativo') NOT NULL,
  `idCor` int(10) unsigned DEFAULT NULL,
  `subRede` varchar(25) NOT NULL,
  PRIMARY KEY (`idLab`),
  KEY `idCor` (`idCor`),
  CONSTRAINT `tbLaboratorio_ibfk_1` FOREIGN KEY (`idCor`) REFERENCES `tbCor` (`idCor`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbLaboratorio`
--

LOCK TABLES `tbLaboratorio` WRITE;
/*!40000 ALTER TABLE `tbLaboratorio` DISABLE KEYS */;
INSERT INTO `tbLaboratorio` VALUES (1,'LaboratÃ³rio de GraduaÃ§Ã£o 01',60,30,'Inativo',1,'10.27.11.0'),(2,'LaboratÃ³rio de GraduaÃ§Ã£o 02',30,12,'Ativo',2,'10.27.12.0'),(3,'LaboratÃ³rio de GraduaÃ§Ã£o 03',15,8,'Ativo',3,'10.27.13.0'),(4,'LaboratÃ³rio de GraduaÃ§Ã£o 04',40,20,'Ativo',4,'10.27.14.0'),(5,'LaboratÃ³rio de GraduaÃ§Ã£o 05',24,12,'Ativo',5,'10.27.15.0'),(6,'LaboratÃ³rio de GraduaÃ§Ã£o 06',6,6,'Ativo',6,'10.27.16.0'),(7,'LaboratÃ³rio de Hardware 01',21,7,'Ativo',7,'10.27.22.0'),(8,'LaboratÃ³rio Geral de Estudos',34,17,'Ativo',8,'10.27.21.0');
/*!40000 ALTER TABLE `tbLaboratorio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbMatricula`
--

DROP TABLE IF EXISTS `tbMatricula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbMatricula` (
  `idUser` int(10) unsigned NOT NULL,
  `matricula` varchar(12) NOT NULL,
  PRIMARY KEY (`idUser`),
  CONSTRAINT `tbMatricula_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbUsuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbMatricula`
--

LOCK TABLES `tbMatricula` WRITE;
/*!40000 ALTER TABLE `tbMatricula` DISABLE KEYS */;
INSERT INTO `tbMatricula` VALUES (1,'201310009998'),(11,'343243435443'),(12,'201320001598'),(13,'201320001598');
/*!40000 ALTER TABLE `tbMatricula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbNotiConexao`
--

DROP TABLE IF EXISTS `tbNotiConexao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbNotiConexao` (
  `idUser` int(10) unsigned NOT NULL,
  `idNoti` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idUser`,`idNoti`),
  KEY `idNoti` (`idNoti`),
  CONSTRAINT `tbNotiConexao_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbUsuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbNotiConexao_ibfk_2` FOREIGN KEY (`idNoti`) REFERENCES `tbNotificacao` (`idNoti`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbNotiConexao`
--

LOCK TABLES `tbNotiConexao` WRITE;
/*!40000 ALTER TABLE `tbNotiConexao` DISABLE KEYS */;
INSERT INTO `tbNotiConexao` VALUES (9,20),(10,20);
/*!40000 ALTER TABLE `tbNotiConexao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbNotificacao`
--

DROP TABLE IF EXISTS `tbNotificacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbNotificacao` (
  `idNoti` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `notificacao` text NOT NULL,
  `statusNoti` tinyint(1) NOT NULL,
  `expiraData` date DEFAULT NULL,
  PRIMARY KEY (`idNoti`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbNotificacao`
--

LOCK TABLES `tbNotificacao` WRITE;
/*!40000 ALTER TABLE `tbNotificacao` DISABLE KEYS */;
INSERT INTO `tbNotificacao` VALUES (3,'<li>\r\n                      <a href=\"noti.php?id=0&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(4,'<li>\r\n                      <a href=\"noti.php?id=4&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(5,'<li>\r\n                      <a href=\"noti.php?id=&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi \r\n                      </a>\r\n                    </li>',0,NULL),(6,'<li>\r\n                      <a href=\"noti.php?id=&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi \r\n                      </a>\r\n                    </li>',0,NULL),(7,'<li>\r\n                      <a href=\"noti.php?id=&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi \r\n                      </a>\r\n                    </li>',0,NULL),(8,'<li>\r\n                      <a href=\"noti.php?id=8&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(9,'<li>\r\n                      <a href=\"noti.php?id=9&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(10,'<li>\r\n                      <a href=\"noti.php?id=10&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(11,'<li>\r\n                      <a href=\"noti.php?id=11&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(12,'<li>\r\n                      <a href=\"noti.php?id=12&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(13,'<li>\r\n                      <a href=\"noti.php?id=13&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(14,'<li>\r\n                      <a href=\"noti.php?id=14&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(15,'<li>\r\n                      <a href=\"noti.php?id=15&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(16,'<li>\r\n                      <a href=\"noti.php?id=16&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(17,'<li>\r\n                      <a href=\"noti.php?id=17&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(18,'<li>\r\n                      <a href=\"noti.php?id=18&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(19,'<li>\r\n                      <a href=\"noti.php?id=19&ir=/salas/minhas\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-pencil-square-o text-red\"></i> Sua reserva foi Negada\r\n                      </a>\r\n                    </li>',0,NULL),(20,'<li>\r\n                      <a href=\"noti.php?id=20&ir=/perfil/2/\" style=\"background-color: #EFEEEE\">\r\n                        <i class=\"fa fa-retweet text-aqua\"></i> UsuÃ¡rio requisitou a troca de sua senha\r\n                      </a>\r\n                    </li>',1,'2016-02-22');
/*!40000 ALTER TABLE `tbNotificacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbOnline`
--

DROP TABLE IF EXISTS `tbOnline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbOnline` (
  `idUser` int(10) unsigned NOT NULL,
  `tempoExpirar` datetime NOT NULL,
  `sessao` varchar(30) NOT NULL,
  `senha` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idUser`),
  CONSTRAINT `tbOnline_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbUsuario` (`idUser`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbOnline`
--

LOCK TABLES `tbOnline` WRITE;
/*!40000 ALTER TABLE `tbOnline` DISABLE KEYS */;
INSERT INTO `tbOnline` VALUES (1,'2015-12-10 15:19:00','9j6rvkkmd358hj9atc641khn82',NULL),(2,'2015-11-17 18:36:13','n8cf99al8nth6k58oojdj7j2t5',NULL),(3,'2015-12-14 16:52:32','7hj012h6hloqvscp66g60s4jv2',NULL),(9,'2015-11-17 18:09:59','3glc456ei4n72etcjh4uatl7d1',NULL),(10,'2016-06-08 17:42:54','8ce2g5m4l42hp0ra6f4aajhg35',NULL);
/*!40000 ALTER TABLE `tbOnline` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbPrimeiroAcesso`
--

DROP TABLE IF EXISTS `tbPrimeiroAcesso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbPrimeiroAcesso` (
  `idUser` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idUser`),
  CONSTRAINT `tbPrimeiroAcesso_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbUsuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbPrimeiroAcesso`
--

LOCK TABLES `tbPrimeiroAcesso` WRITE;
/*!40000 ALTER TABLE `tbPrimeiroAcesso` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbPrimeiroAcesso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbRequerimentos`
--

DROP TABLE IF EXISTS `tbRequerimentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbRequerimentos` (
  `idReq` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(10) unsigned NOT NULL,
  `dataReq` date NOT NULL,
  `conteudoReq` text CHARACTER SET latin1 NOT NULL,
  `tipoReq` int(11) NOT NULL,
  `statusReq` enum('Pendente','Negado','Aprovado') CHARACTER SET latin1 NOT NULL DEFAULT 'Pendente',
  `justificativaReq` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idReq`),
  KEY `idUser` (`idUser`),
  CONSTRAINT `tbRequerimentos_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbUsuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbRequerimentos`
--

LOCK TABLES `tbRequerimentos` WRITE;
/*!40000 ALTER TABLE `tbRequerimentos` DISABLE KEYS */;
INSERT INTO `tbRequerimentos` VALUES (1,1,'2015-08-27','teste/+12/mm/yyyy/+10/mm/yyyy',1,'Negado','hgfhgfnbjmhbnvb');
/*!40000 ALTER TABLE `tbRequerimentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbReservaEq`
--

DROP TABLE IF EXISTS `tbReservaEq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbReservaEq` (
  `idReEq` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idUser` int(10) unsigned NOT NULL,
  `motivoReEq` varchar(255) NOT NULL,
  `tituloReEq` varchar(255) NOT NULL,
  `expiraReEq` date NOT NULL,
  PRIMARY KEY (`idReEq`),
  KEY `idReEq` (`idReEq`),
  KEY `idReserva` (`idUser`),
  CONSTRAINT `tbReservaEq_ibfk_3` FOREIGN KEY (`idUser`) REFERENCES `tbUsuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbReservaEq`
--

LOCK TABLES `tbReservaEq` WRITE;
/*!40000 ALTER TABLE `tbReservaEq` DISABLE KEYS */;
INSERT INTO `tbReservaEq` VALUES (1,3,'vnmbcxvhgcxb','gnbxxbncn','2016-03-07'),(2,3,',mb,bnmnvmbjncb','jhfjbvnbvn','2016-03-07'),(3,3,'gshhdvbxc','gnbcvbxvcn','2016-03-07'),(4,3,'kfnlkgdnglsnf','tefkdg','2016-03-08'),(5,3,'dsfsgdfas','sgfgsfgfdfasd','2016-03-22'),(7,1,'fgfdvhgsbnvbmfgd,kdbg nvcgdvfdbnv nvfdhfgbnhtn','tgrsfhfsdvncvbbf','2016-04-04'),(8,3,'fvbbxczvnbxzvb','gfsdavcxfvcb','2016-04-04'),(9,3,'fvbbxczvnbxzvb','gfsdavcxfvcb','2016-04-04'),(10,3,'ngdsngdnvdscb','gfshzbvc','2016-04-04'),(11,3,'cvznxcvnvcxbvc','ngvbc ncn','2016-04-04'),(12,3,'cvznxcvnvcxbvc','ngvbc ncn','2016-04-04'),(13,3,'cvznxcvnvcxbvc','ngvbc ncn','2016-04-04'),(14,3,'cvznxcvnvcxbvc','ngvbc ncn','2016-04-04'),(15,3,'cvznxcvnvcxbvc','ngvbc ncn','2016-04-04'),(16,3,'cvznxcvnvcxbvc','ngvbc ncn','2016-04-04'),(18,10,'bacsbdvbxvbs','thfsdhfddvbc','2016-04-18'),(19,3,'vdbfvw','teste','2016-04-18'),(20,3,'dfojbgkjas.dnggdag','t01','2016-04-20'),(21,3,'fgofegjlsdfhgskfhgggafg','t02','2016-04-20'),(22,3,'fgfsgfsgsfgdf','teste 1','2016-04-23'),(23,3,'gfdgsfdgf','teste 2f','2016-04-23'),(24,3,'gfsgfdgdf','teste 3','2016-04-23'),(25,3,'gfdsgfds','teste 4','2016-04-23'),(26,3,'fdsgdfgfd','teste 4','2016-04-23'),(27,3,'sfgfgsd','teste 5','2016-04-23'),(28,3,'sfagfsagfagag','teste 6','2016-04-23'),(29,3,'emrekjhgdklmhbgf','teste 7','2016-04-23'),(30,3,'rfhsgdhghdgh','TESTE 08','2016-04-23'),(31,3,'dskjkgbsdkjgnjsdg','teste 09','2016-04-23'),(32,3,'djbgkjfsdhgkfsngdfgg','teste 10','2016-04-23'),(33,3,'gsdgfdg','tyhtehyfdg','2016-04-25'),(34,3,'gsdgfdg','tyhtehyfdg','2016-04-25'),(35,3,'gsdgfdg','tyhtehyfdg','2016-04-25'),(36,3,'ghfghgdhfdvbd','teste 03','2016-04-25'),(37,3,'ndkmgnfdkjsgnfg','teste 04','2016-04-25'),(38,2,'Ã§jdabgsdkjfgfs','thdkjvzm','2016-05-15'),(39,3,'fknzvdbvvcx','teste 02','2016-05-22'),(40,3,'wrthyrehbfd','teste 03','2016-05-22'),(41,3,'dfgsgfsdd','teste fgndkf','2016-06-07'),(42,3,'gdsgfdgdsfgds','rwtregfg','2016-06-07'),(43,3,'fdfasdfdsfas','teste 01','2016-06-07'),(45,3,'fdsjgnkflsng','teste 03','2016-06-07');
/*!40000 ALTER TABLE `tbReservaEq` ENABLE KEYS */;
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `ExpiraReEq` BEFORE INSERT ON `tbReservaEq`
 FOR EACH ROW set new.expiraReEq = date_add(current_date(), interval 180 day) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `tbReservaLab`
--

DROP TABLE IF EXISTS `tbReservaLab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbReservaLab` (
  `idReLab` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idUser` int(10) unsigned NOT NULL,
  `motivoReLab` varchar(255) NOT NULL,
  `tituloReLab` varchar(255) NOT NULL,
  `tipoReLab` enum('Privado','Compartilhado') NOT NULL,
  `numPc` int(10) unsigned DEFAULT NULL,
  `expiraReLab` date DEFAULT NULL,
  PRIMARY KEY (`idReLab`),
  KEY `idUser` (`idUser`),
  CONSTRAINT `tbReservaLab_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbUsuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbReservaLab`
--

LOCK TABLES `tbReservaLab` WRITE;
/*!40000 ALTER TABLE `tbReservaLab` DISABLE KEYS */;
INSERT INTO `tbReservaLab` VALUES (1,3,'gdsgdsfd','teste','Privado',0,'2016-03-06'),(2,3,'fdzbvxzbxcvzx','cdvsvgdsfbfgdfshv','Privado',0,'2016-03-07'),(3,3,'gfghmvhjvhb','khghjvbvee','Privado',0,'2016-03-07'),(6,3,'bvxcbcvbvcx','bhvxbvzbv','Privado',0,'2016-04-11'),(11,3,'gfhngfnbdv','teste 02','Privado',0,'2016-04-24'),(12,3,'fhdshggngnf','teste 03','Compartilhado',1,'2016-04-24'),(13,3,'wkfnblsgdknhdf','teste 04','Compartilhado',1,'2016-04-24'),(14,3,'dwfasgdsgadsfg','teste 05','Compartilhado',2,'2016-04-24'),(15,3,'Ndlkfgnfdsglknfdgda','dfgstgsgmK','Privado',0,'2016-04-24'),(16,3,'dfhdfgdgsh','teste 01','Privado',0,'2016-04-25'),(17,3,'dkngaflsngdskng','testeX 01','Privado',0,'2016-05-01'),(18,2,'vbxvcbvcxb','gdfvsdbvc','Privado',0,'2016-05-15'),(19,3,'fdfdsafd','teste chang','Privado',0,'2016-06-07'),(20,3,'dfsdafdsfasdf','teste 01','Privado',0,'2016-06-07'),(21,3,'dfsdafdsfasdf','teste 01','Privado',0,'2016-06-07'),(22,3,'dfsdafdsfasdf','teste 01','Privado',0,'2016-06-07'),(23,3,'dfsdafdsfasdf','teste 02','Privado',0,'2016-06-07'),(24,3,'dfsdfdsfad','teste 03','Privado',0,'2016-06-07'),(25,3,'dgisafnbkcs,v','teknfdsvn','Privado',0,'2016-06-07'),(26,3,'dgisafnbkcs,v','teknfdsvn','Privado',0,'2016-06-07'),(28,3,'dgisafnbkcs,v','teknfdsvn','Privado',0,'2016-06-07'),(29,3,'fjbgmndgisafnbkcs,v','teste 05','Privado',0,'2016-06-07'),(30,3,'dwjobgjfjgdsgvsdfgc','testeX 02','Privado',0,'2016-06-08'),(31,3,'feooghflkdngd','testex 02','Privado',0,'2016-06-11'),(39,3,'fgjafdkbndkbsgdb','testex 03','Privado',0,'2016-06-11'),(40,3,'fgjafdkbndkbsgdb','testex 03','Privado',0,'2016-06-11'),(41,3,'fgjafdkbndkbsgdb','testex 03','Privado',0,'2016-06-11'),(42,3,'fgjafdkbndkbsgdb','testex 03','Privado',0,'2016-06-11'),(43,3,'fgjafdkbndkbsgdb','testex 03','Privado',0,'2016-06-11');
/*!40000 ALTER TABLE `tbReservaLab` ENABLE KEYS */;
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `ExpiraReLab` BEFORE INSERT ON `tbReservaLab`
 FOR EACH ROW set new.expiraReLab = date_add(current_date(), interval 180 day) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `tbReservaSala`
--

DROP TABLE IF EXISTS `tbReservaSala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbReservaSala` (
  `idReSala` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idUser` int(10) unsigned NOT NULL,
  `idSala` int(10) unsigned NOT NULL,
  `motivoReSala` varchar(255) NOT NULL,
  `tituloReSala` varchar(255) NOT NULL,
  `expirarReSala` date NOT NULL,
  PRIMARY KEY (`idReSala`),
  KEY `idUser` (`idUser`),
  KEY `idSala` (`idSala`),
  CONSTRAINT `tbReservaSala_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbUsuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbReservaSala_ibfk_2` FOREIGN KEY (`idSala`) REFERENCES `tbSala` (`idSala`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbReservaSala`
--

LOCK TABLES `tbReservaSala` WRITE;
/*!40000 ALTER TABLE `tbReservaSala` DISABLE KEYS */;
INSERT INTO `tbReservaSala` VALUES (1,10,4,'rgfdgfdgdsvb','teste dvvnskfn','2016-05-24'),(2,10,4,'rgfdgfdgdsvb','teste dvvnskfn','2016-05-24'),(3,10,4,'dpghfljkagdsg','teste 1','2016-06-08'),(4,3,4,'fdskgnkfdlgfgds','teste 3','2016-06-08'),(5,3,4,'dgnskflgnsf','teste 4','2016-06-08');
/*!40000 ALTER TABLE `tbReservaSala` ENABLE KEYS */;
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `ExpiraReSala` BEFORE INSERT ON `tbReservaSala`
 FOR EACH ROW set new.expirarReSala = date_add(current_date(), interval 180 day) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `tbReservaTipoEq`
--

DROP TABLE IF EXISTS `tbReservaTipoEq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbReservaTipoEq` (
  `idTipoEq` int(10) unsigned NOT NULL,
  `idReEq` int(10) unsigned NOT NULL,
  `numReEq` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idTipoEq`,`idReEq`),
  KEY `idReEq` (`idReEq`),
  CONSTRAINT `tbReservaTipoEq_ibfk_1` FOREIGN KEY (`idTipoEq`) REFERENCES `tbTipoEq` (`idTipoEq`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbReservaTipoEq_ibfk_2` FOREIGN KEY (`idReEq`) REFERENCES `tbReservaEq` (`idReEq`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbReservaTipoEq`
--

LOCK TABLES `tbReservaTipoEq` WRITE;
/*!40000 ALTER TABLE `tbReservaTipoEq` DISABLE KEYS */;
INSERT INTO `tbReservaTipoEq` VALUES (2,3,1),(2,7,1),(2,9,1),(2,25,1),(2,33,1),(2,34,1),(2,35,1),(2,38,1),(2,42,1),(2,43,1),(3,18,1),(3,19,1),(3,20,1),(3,21,1),(3,22,1),(3,23,1),(3,24,1),(3,26,1),(3,27,2),(3,28,2),(3,29,1),(3,30,1),(3,31,1),(3,32,1),(3,37,1),(3,39,1),(3,40,1),(3,43,1),(3,45,1);
/*!40000 ALTER TABLE `tbReservaTipoEq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbSala`
--

DROP TABLE IF EXISTS `tbSala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbSala` (
  `idSala` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nomeSala` varchar(50) NOT NULL,
  `numPessoa` int(10) unsigned NOT NULL,
  `statusSala` enum('Ativo','Inativo') NOT NULL,
  `idCor` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idSala`),
  KEY `idSala` (`idSala`),
  KEY `idCor` (`idCor`),
  CONSTRAINT `tbSala_ibfk_1` FOREIGN KEY (`idCor`) REFERENCES `tbCor` (`idCor`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbSala`
--

LOCK TABLES `tbSala` WRITE;
/*!40000 ALTER TABLE `tbSala` DISABLE KEYS */;
INSERT INTO `tbSala` VALUES (4,'teste 02',43,'Ativo',1),(5,'teste 03',32,'Ativo',2);
/*!40000 ALTER TABLE `tbSala` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbTelefone`
--

DROP TABLE IF EXISTS `tbTelefone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbTelefone` (
  `idTelefone` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idUser` int(10) unsigned NOT NULL,
  `numTelefone` varchar(13) NOT NULL,
  PRIMARY KEY (`idTelefone`),
  KEY `tbTelefone_FKIndex1` (`idUser`),
  CONSTRAINT `tbTelefone_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tbUsuario` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbTelefone`
--

LOCK TABLES `tbTelefone` WRITE;
/*!40000 ALTER TABLE `tbTelefone` DISABLE KEYS */;
INSERT INTO `tbTelefone` VALUES (1,1,'(79)9988-7766');
/*!40000 ALTER TABLE `tbTelefone` ENABLE KEYS */;
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
  CONSTRAINT `tbTempoRe_ibfk_1` FOREIGN KEY (`idReLab`) REFERENCES `tbReservaLab` (`idReLab`) ON DELETE CASCADE ON UPDATE NO ACTION
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
-- Table structure for table `tbTipoEq`
--

DROP TABLE IF EXISTS `tbTipoEq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbTipoEq` (
  `idTipoEq` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tipoEq` varchar(15) NOT NULL,
  `numEq` smallint(6) NOT NULL,
  `idCor` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idTipoEq`),
  KEY `idCor` (`idCor`),
  CONSTRAINT `tbTipoEq_ibfk_1` FOREIGN KEY (`idCor`) REFERENCES `tbCor` (`idCor`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbTipoEq`
--

LOCK TABLES `tbTipoEq` WRITE;
/*!40000 ALTER TABLE `tbTipoEq` DISABLE KEYS */;
INSERT INTO `tbTipoEq` VALUES (2,'Caixa de som',1,2),(3,'Projetor',2,1);
/*!40000 ALTER TABLE `tbTipoEq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbUsuario`
--

DROP TABLE IF EXISTS `tbUsuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbUsuario` (
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
  CONSTRAINT `tbUsuario_ibfk_1` FOREIGN KEY (`idAfiliacao`) REFERENCES `tbAfiliacao` (`idAfiliacao`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbUsuario`
--

LOCK TABLES `tbUsuario` WRITE;
/*!40000 ALTER TABLE `tbUsuario` DISABLE KEYS */;
INSERT INTO `tbUsuario` VALUES (1,2,'aluno',')?Ã¤5Ã˜BJGÂ£e	UÂ¶Ã‡Ã›','123','Aluno',4,'Inativo','abc@xyz.com'),(2,1,'professor','123','123','Professor',3,'Ativo','abc@xyz.com'),(3,5,'secretaria','','123','Secretaria',1,'Ativo','abc@abc.com'),(4,3,'aluno3','','LaLev-%b','Aluno 3',4,'Inativo','abc123@xyz.com'),(5,4,'aluno3','','w6jW81rP','Aluno 2',4,'Ativo','abc@xyz.com'),(6,5,'secretaria2','','123','Secretaria 2',1,'Ativo','abc@xyz.com'),(7,5,'secretaria3','','123','Secretaria 3',1,'Ativo','abc@xyz.com'),(8,1,'professor2','','123','Professor 2',3,'Ativo','abc@xyz.com'),(9,1,'professor3','','123','Professor 3',0,'Ativo','abc@xyz.com'),(10,6,'admin','123','123','Adminstrador',0,'Ativo','mgcaquino@gmail.com'),(11,2,'fgdb.gdhfdhgsd','â€“Ââ€ºxu*â€šÂ°â€¡@Ã¿jÃ½Å \Z','O@SD4FSU','fgdb gdhfdhgsd',4,'Ativo','Ã¸(Â\Z\rÂ§;Â¬?Å’Å =Â©Ã³\\`Â®Å¸l:O-ÃƒF5â€=Å¾'),(12,2,'teste.01','48478311360','ZdiA0!M1','teste 01',4,'Ativo','mgcaquino@gmail.com'),(13,7,'teste.02','13447447532','Q4%ub-!%','teste 02',4,'Ativo','mgcaquino@gmail.com');
/*!40000 ALTER TABLE `tbUsuario` ENABLE KEYS */;
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
INSERT INTO `tblabpasswd` VALUES (1,'”ªö\0ÃÍEb¡	');
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
