CREATE DATABASE  IF NOT EXISTS `proyectoweb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `proyectoweb`;
-- MySQL dump 10.13  Distrib 5.7.25, for Win64 (x86_64)
--
-- Host: localhost    Database: proyectoweb
-- ------------------------------------------------------
-- Server version	5.7.25-log

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
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCat` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `envio`
--

DROP TABLE IF EXISTS `envio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `envio` (
  `idEnvio` int(11) NOT NULL AUTO_INCREMENT,
  `idRemitente` int(11) DEFAULT NULL,
  `emailRemitente` varchar(30) DEFAULT NULL,
  `idDestinatario` int(11) DEFAULT NULL,
  `emailDestinatario` varchar(30) DEFAULT NULL,
  `idPostal` int(11) DEFAULT NULL,
  `mensaje` varchar(200) DEFAULT NULL,
  `fechaEnv` date DEFAULT NULL,
  PRIMARY KEY (`idEnvio`),
  KEY `idRemitente` (`idRemitente`,`emailRemitente`),
  KEY `idDestinatario` (`idDestinatario`,`emailDestinatario`),
  KEY `idPostal` (`idPostal`),
  CONSTRAINT `envio_ibfk_1` FOREIGN KEY (`idRemitente`, `emailRemitente`) REFERENCES `usuario` (`idUser`, `email`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `envio_ibfk_2` FOREIGN KEY (`idDestinatario`, `emailDestinatario`) REFERENCES `usuario` (`idUser`, `email`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `envio_ibfk_3` FOREIGN KEY (`idPostal`) REFERENCES `postal` (`idPostal`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `envio`
--

LOCK TABLES `envio` WRITE;
/*!40000 ALTER TABLE `envio` DISABLE KEYS */;
/*!40000 ALTER TABLE `envio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postal`
--

DROP TABLE IF EXISTS `postal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `postal` (
  `idPostal` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(60) DEFAULT NULL,
  `dirPostal` varchar(100) DEFAULT NULL,
  `idCat` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPostal`),
  KEY `idCat` (`idCat`),
  CONSTRAINT `postal_ibfk_1` FOREIGN KEY (`idCat`) REFERENCES `categoria` (`idcategoria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postal`
--

LOCK TABLES `postal` WRITE;
/*!40000 ALTER TABLE `postal` DISABLE KEYS */;
/*!40000 ALTER TABLE `postal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `primerAp` varchar(45) NOT NULL,
  `segundoAp` varchar(45) DEFAULT NULL,
  `contrasena` varchar(45) NOT NULL,
  `fechaNac` date DEFAULT NULL,
  `tipoUser` varchar(30) NOT NULL,
  `estado` varchar(15) DEFAULT NULL,
  `profile_Img` varchar(45) DEFAULT NULL,
  `FechaRegistro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idUser`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'xtremeigraviti@hotmail.com','David','Lopez','Hernandez','8fd66ad6c937bcc3981d4c3f7d3ecbc7','1998-09-15','Normal','Activo','Img/01f9b25da85798e569a26c7adb812759.jpeg','2019-10-26 23:35:04'),(2,'david-reach-halo@hotmail.com','Fernando','Cruz','Huerta','c3981fa8d26e95d911fe8eaeb6570f2f','1998-09-27','Admin','Activo','Img/636c93cd1501b236a06ea9a9262eafe0.jpg','2019-10-26 23:35:04'),(14,'xtremeigraviti@gmail.com','David','Lopez','Hernandez','d8578edf8458ce06fbc5bb76a58c5ca4','1998-07-14','Normal','Activo','Img/d1b46ef77442dc5efcd236d4e9d9f4e9.jpg','2019-10-27 01:00:51'),(15,'xtremeigraviti@hotmaild.com','David','Lopez Hernandez','dasd','7627cb9027e713e301e83a8f13057055','1998-09-03','Normal','Activo','Img/yuna.jpg','2019-10-28 13:47:05'),(16,'krla_9323@hotmail.com','karla','sasa','diaz','e10adc3949ba59abbe56e057f20f883e','1998-07-01','Normal','Activo','Img/fef80ef0ed17fd32364207cfc27fd375.jpg','2019-10-28 13:47:20'),(17,'xtremeigraviti@hotmaiil.com','dada','dada','dada','7627cb9027e713e301e83a8f13057055','1998-09-15','Normal','Activo','Img/yuna.jpg','2019-10-29 14:44:11');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-10-30  0:07:19
