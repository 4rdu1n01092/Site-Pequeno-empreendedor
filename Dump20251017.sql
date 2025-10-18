-- MySQL dump 10.13  Distrib 8.0.43, for Win64 (x86_64)
--
-- Host: localhost    Database: u252634646_site
-- ------------------------------------------------------
-- Server version	9.1.0

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
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empresas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  `Produto1` varchar(45) DEFAULT NULL,
  `Produto2` varchar(45) DEFAULT NULL,
  `Plano` enum('B','P','O') NOT NULL,
  `Descricao` text,
  `Imagem` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Nome_UNIQUE` (`Nome`),
  UNIQUE KEY `Produto1_UNIQUE` (`Produto1`) /*!80000 INVISIBLE */,
  UNIQUE KEY `Produto2_UNIQUE` (`Produto2`),
  CONSTRAINT `Name` FOREIGN KEY (`Produto2`) REFERENCES `produto2` (`Nome`),
  CONSTRAINT `Nome` FOREIGN KEY (`Produto1`) REFERENCES `produto1` (`Nome`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (1,'American Girls',NULL,NULL,'O',NULL,NULL),(2,'Antonios food\'s and Acessories',NULL,NULL,'O',NULL,NULL),(3,'Artes e sabores',NULL,NULL,'O',NULL,NULL),(4,'Banana Flutuante',NULL,NULL,'O',NULL,NULL),(5,'Bia yas delícias',NULL,NULL,'O',NULL,NULL),(6,'Blue SKy',NULL,NULL,'O',NULL,NULL),(7,'Boomerang Company',NULL,NULL,'O',NULL,NULL),(8,'C&J',NULL,NULL,'O',NULL,NULL),(9,'Candy Store',NULL,NULL,'O',NULL,NULL),(10,'Ceber',NULL,NULL,'O',NULL,NULL),(11,'EB',NULL,NULL,'O',NULL,NULL),(12,'Franquin',NULL,NULL,'O',NULL,NULL),(13,'Gui\'s Store',NULL,NULL,'O',NULL,NULL),(14,'Mariana e Livia',NULL,NULL,'O',NULL,NULL),(16,'Maria e Cécilia comércios',NULL,NULL,'O',NULL,NULL),(17,'Mercado Pokémon',NULL,NULL,'O',NULL,NULL),(18,'MP pulseiras',NULL,NULL,'O',NULL,NULL),(19,'Oriciental',NULL,NULL,'B',NULL,NULL),(20,'AL Plantas e Cocadas',NULL,NULL,'O',NULL,NULL),(21,'Produtos do céu',NULL,NULL,'O',NULL,NULL),(22,'R&L refrescos',NULL,NULL,'B',NULL,NULL),(23,'Th beauty',NULL,NULL,'O',NULL,NULL),(24,'Uniacqua e Sabores',NULL,NULL,'O',NULL,NULL),(25,'Encantos e Sabores',NULL,NULL,'O',NULL,NULL),(26,'Casa dos personagens e dos pastéis',NULL,NULL,'O',NULL,NULL),(27,'BL doçuras aromáticas',NULL,NULL,'O',NULL,NULL),(28,'R e L',NULL,NULL,'O',NULL,NULL);
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto1`
--

DROP TABLE IF EXISTS `produto1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produto1` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Nome` varchar(60) NOT NULL,
  `preço` decimal(10,0) NOT NULL,
  `Empresa` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Nome_UNIQUE` (`Nome`),
  UNIQUE KEY `Empresa_UNIQUE` (`Empresa`),
  CONSTRAINT `fk_produto1_empresa` FOREIGN KEY (`Empresa`) REFERENCES `empresas` (`Nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto1`
--

LOCK TABLES `produto1` WRITE;
/*!40000 ALTER TABLE `produto1` DISABLE KEYS */;
/*!40000 ALTER TABLE `produto1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto2`
--

DROP TABLE IF EXISTS `produto2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produto2` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Nome` varchar(60) NOT NULL,
  `preço` decimal(10,0) NOT NULL,
  `Empresa` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Nome_UNIQUE` (`Nome`),
  UNIQUE KEY `Empresa_UNIQUE` (`Empresa`),
  CONSTRAINT `fk_produto2_empresa` FOREIGN KEY (`Empresa`) REFERENCES `empresas` (`Nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto2`
--

LOCK TABLES `produto2` WRITE;
/*!40000 ALTER TABLE `produto2` DISABLE KEYS */;
/*!40000 ALTER TABLE `produto2` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-17  0:25:41
