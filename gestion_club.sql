-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 19, 2023 at 12:25 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_club`
--

-- --------------------------------------------------------

--
-- Table structure for table `inscritpion`
--

DROP TABLE IF EXISTS `inscritpion`;
CREATE TABLE IF NOT EXISTS `inscritpion` (
  `id_Inscription` int NOT NULL AUTO_INCREMENT,
  `id_Membre` int NOT NULL,
  `id_planInscritpion` int NOT NULL,
  `date_inscription` date NOT NULL,
  `etat` varchar(255) NOT NULL,
  PRIMARY KEY (`id_Inscription`),
  KEY `n2` (`id_planInscritpion`),
  KEY `n1` (`id_Membre`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `membre`
--

DROP TABLE IF EXISTS `membre`;
CREATE TABLE IF NOT EXISTS `membre` (
  `id_membre` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  PRIMARY KEY (`id_membre`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `membre`
--

INSERT INTO `membre` (`id_membre`, `nom`, `prenom`, `adresse`, `email`, `telephone`) VALUES
(5, 'aziz', 'Mohammed', '06 rue intamim 01', 'azizmbu@gmail.com', '0616815066'),
(2, 'aziz', 'Mohammed', '06 rue intamim 01', 'azizmbu@gmail.com', '0616815066'),
(3, 'aziz', 'Mohammed', '06 rue intamim 01', 'azizmbu@gmail.com', '0616815066'),
(4, 'aziz', 'Mohammed', '06 rue intamim 01', 'azizmbu@gmail.com', '0616815066'),
(6, 'aziz', 'Mohammed', '06 rue intamim 01', 'azizmbu@gmail.com', '0616815066'),
(7, 'aziz', 'Mohammed', '06 rue intamim 01', 'azizmbu@gmail.com', '0616815066'),
(8, 'aziz', 'Mohammed', '06 rue intamim 01', 'azizmbu@gmail.com', '0616815066'),
(9, 'aziz', 'Mohammed', '06 rue intamim 01', 'azizmbu@gmail.com', '0616815066'),
(10, 'aziz', 'Mohammed', '06 rue intamim 01', 'azizmbu@gmail.com', '0616815066'),
(11, 'aziz', 'Mohammed', '06 rue intamim 01', 'azizmbu@gmail.com', '0616815066'),
(12, 'aziz', 'Mohammed', '06 rue intamim 01', 'azizmbu@gmail.com', '0616815066'),
(13, 'aziz', 'Mohammed', '06 rue intamim 01', 'azizmbu@gmail.com', '0616815066'),
(14, 'aziz', 'Mohammed', '06 rue intamim 01', 'azizmbu@gmail.com', '0616815066'),
(15, 'aziz', 'Mohammed', '06 rue intamim 01', 'azizmbu@gmail.com', '0616815066'),
(16, 'aziz', 'Mohammed', '06 rue intamim 01', 'azizmbu@gmail.com', '0616815066'),
(17, 'aziz', 'Mohammed', '06 rue intamim 01', 'azizmbu@gmail.com', '0616815066');

-- --------------------------------------------------------

--
-- Table structure for table `planinscription`
--

DROP TABLE IF EXISTS `planinscription`;
CREATE TABLE IF NOT EXISTS `planinscription` (
  `idPlanInscription` int NOT NULL AUTO_INCREMENT,
  `nomPlanInscription` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `prix` int NOT NULL,
  PRIMARY KEY (`idPlanInscription`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
