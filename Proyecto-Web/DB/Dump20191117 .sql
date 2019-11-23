CREATE DATABASE  IF NOT EXISTS `proyectoweb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `proyectoweb`;
-- MySQL dump 10.13  Distrib 5.7.25, for Win64 (x86_64)
--
-- Host: 192.168.1.82    Database: proyectoweb
-- ------------------------------------------------------
-- Server version	5.7.26

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Paisajes'),(2,'Pokemon'),(3,'Batman'),(4,'xd'),(5,'Cumpleaños'),(6,'navidad');
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
  `saludo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idEnvio`),
  KEY `idRemitente` (`idRemitente`,`emailRemitente`),
  KEY `idDestinatario` (`idDestinatario`,`emailDestinatario`),
  KEY `idPostal` (`idPostal`),
  CONSTRAINT `envio_ibfk_1` FOREIGN KEY (`idRemitente`, `emailRemitente`) REFERENCES `usuario` (`idUser`, `email`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `envio_ibfk_2` FOREIGN KEY (`idDestinatario`, `emailDestinatario`) REFERENCES `usuario` (`idUser`, `email`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `envio_ibfk_3` FOREIGN KEY (`idPostal`) REFERENCES `postal` (`idPostal`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `envio`
--

LOCK TABLES `envio` WRITE;
/*!40000 ALTER TABLE `envio` DISABLE KEYS */;
INSERT INTO `envio` VALUES (1,2,'david-reach-halo@hotmail.com',1,'xtremeigraviti@hotmail.com',1,'Hola!1','2019-11-05','Saludos!1'),(2,2,'david-reach-halo@hotmail.com',1,'xtremeigraviti@hotmail.com',2,'wtf2','2019-11-09','Hola!2'),(3,2,'david-reach-halo@hotmail.com',1,'xtremeigraviti@hotmail.com',3,'Hola!3','2019-11-05','Saludos!3'),(4,2,'david-reach-halo@hotmail.com',1,'xtremeigraviti@hotmail.com',2,'wtf4','2019-11-09','Hola!4'),(5,2,'david-reach-halo@hotmail.com',1,'xtremeigraviti@hotmail.com',4,'Hola!5','2019-11-05','Saludos!5'),(6,2,'david-reach-halo@hotmail.com',1,'xtremeigraviti@hotmail.com',1,'Hola!1','2019-11-05','Saludos!1'),(7,2,'david-reach-halo@hotmail.com',1,'xtremeigraviti@hotmail.com',2,'wtf2','2019-11-09','Hola!2'),(8,2,'david-reach-halo@hotmail.com',1,'xtremeigraviti@hotmail.com',3,'Hola!3','2019-11-05','Saludos!3'),(9,2,'david-reach-halo@hotmail.com',1,'xtremeigraviti@hotmail.com',2,'wtf4','2019-11-09','Hola!4'),(10,2,'david-reach-halo@hotmail.com',1,'xtremeigraviti@hotmail.com',4,'Hola!5','2019-11-05','Saludos!5'),(11,2,'david-reach-halo@hotmail.com',1,'xtremeigraviti@hotmail.com',5,'Hola!3','2019-11-05','Saludos!3'),(12,2,'david-reach-halo@hotmail.com',1,'xtremeigraviti@hotmail.com',5,'wtf4','2019-11-09','Hola!4'),(13,2,'david-reach-halo@hotmail.com',1,'xtremeigraviti@hotmail.com',1,'Hola!5','2019-11-05','Saludos!5');
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postal`
--

LOCK TABLES `postal` WRITE;
/*!40000 ALTER TABLE `postal` DISABLE KEYS */;
INSERT INTO `postal` VALUES (1,'bosquePostal1','Img/paisaje1.jpg',1),(2,'pokemonPostal1.','Img/pokemon.jpg',2),(3,'batmanPostal1','Img/batman.jpg',3),(4,'bosquePostal2','Img/paisaje2.jpg',1),(5,'bosquePostal3','Img/paisaje3.jpg',1),(6,'xdPosta1','Img/xdPosta1.jpg',4),(7,'pokemonPostal2','Img/pokemon.jpg',2),(8,'CumplePostal1','Img/CumplePostal1.jpg',5),(9,'NavidadPostal1','Img/NavidadPostal1.jpg',6),(10,'paisajepostal4','Img/paisaje4.jpg',1),(11,'paisajepostal5','Img/paisaje5.jpg',1),(12,'paisajepostal6','Img/paisaje6.jpg',1),(13,'paisajepostal7','Img/paisaje7.jpg',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'xtremeigraviti@hotmail.com','David','Lopez','Hernandez','8fd66ad6c937bcc3981d4c3f7d3ecbc7','1998-09-15','Normal','Activo','Img/01f9b25da85798e569a26c7adb812759.jpeg','2019-10-26 23:35:04'),(2,'david-reach-halo@hotmail.com','Fernando','Cruz','Huerta','c3981fa8d26e95d911fe8eaeb6570f2f','1998-09-15','Admin','Activo','Img/636c93cd1501b236a06ea9a9262eafe0.jpg','2019-10-26 23:35:04'),(14,'xtremeigraviti@gmail.com','David','Lopez','Hernandez','d8578edf8458ce06fbc5bb76a58c5ca4','1998-07-14','Normal','Activo','Img/d1b46ef77442dc5efcd236d4e9d9f4e9.jpg','2019-10-27 01:00:51'),(15,'xtremeigraviti@hotmaild.com','David','Lopez Hernandez','dasd','7627cb9027e713e301e83a8f13057055','1998-09-03','Normal','Activo','Img/yuna.jpg','2019-10-28 13:47:05'),(16,'krla_9323@hotmail.com','karla','sasa','diaz','e10adc3949ba59abbe56e057f20f883e','1998-07-01','Normal','Activo','Img/fef80ef0ed17fd32364207cfc27fd375.jpg','2019-10-28 13:47:20'),(17,'xtremeigraviti@hotmaiil.com','dada','dada','dada','7627cb9027e713e301e83a8f13057055','1998-09-15','Normal','Activo','Img/yuna.jpg','2019-10-29 14:44:11'),(18,'qwerty@hotmail.com','David','Lopez','Hernandez','8fd66ad6c937bcc3981d4c3f7d3ecbc7','1998-09-15','Normal','Activo','Img/yuna.jpg','2019-11-12 20:11:51'),(19,'panda@hotmail.com','panda','dada','papa','d8578edf8458ce06fbc5bb76a58c5ca4','1998-07-09','Normal','Activo','Img/3897ac84437f51bf477d8abdad3a4d6d.jpg','2019-11-12 22:23:31');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'proyectoweb'
--

--
-- Dumping routines for database 'proyectoweb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-17 17:54:28
