-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: plateforme_emploi
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `candidat_competence`
--

DROP TABLE IF EXISTS `candidat_competence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `candidat_competence` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `competence_id` bigint(20) unsigned NOT NULL,
  `niveau` enum('debutant','intermediaire','avance','expert') NOT NULL DEFAULT 'intermediaire',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `candidat_competence_user_id_competence_id_unique` (`user_id`,`competence_id`),
  KEY `candidat_competence_competence_id_foreign` (`competence_id`),
  CONSTRAINT `candidat_competence_competence_id_foreign` FOREIGN KEY (`competence_id`) REFERENCES `competences` (`id`) ON DELETE CASCADE,
  CONSTRAINT `candidat_competence_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `candidat_competence`
--

LOCK TABLES `candidat_competence` WRITE;
/*!40000 ALTER TABLE `candidat_competence` DISABLE KEYS */;
INSERT INTO `candidat_competence` VALUES (1,25,12,'debutant','2026-03-13 09:44:42','2026-03-13 09:44:42'),(2,25,3,'debutant','2026-03-13 09:44:42','2026-03-13 09:44:42'),(3,25,2,'debutant','2026-03-13 09:44:42','2026-03-13 09:44:42'),(4,25,10,'debutant','2026-03-13 09:44:42','2026-03-13 09:44:42'),(5,25,1,'debutant','2026-03-13 09:44:42','2026-03-13 09:44:42'),(6,26,52,'intermediaire','2026-03-13 09:44:42','2026-03-13 09:44:42'),(7,26,45,'intermediaire','2026-03-13 09:44:42','2026-03-13 09:44:42'),(8,26,55,'intermediaire','2026-03-13 09:44:42','2026-03-13 09:44:42'),(9,26,49,'intermediaire','2026-03-13 09:44:42','2026-03-13 09:44:42'),(10,27,34,'avance','2026-03-13 09:44:42','2026-03-13 09:44:42'),(11,27,109,'avance','2026-03-13 09:44:42','2026-03-13 09:44:42'),(12,27,41,'avance','2026-03-13 09:44:42','2026-03-13 09:44:42'),(13,28,6,'debutant','2026-03-13 09:44:42','2026-03-13 09:44:42'),(14,28,4,'debutant','2026-03-13 09:44:42','2026-03-13 09:44:42'),(15,29,45,'intermediaire','2026-03-13 09:44:42','2026-03-13 09:44:42'),(16,29,47,'intermediaire','2026-03-13 09:44:42','2026-03-13 09:44:42'),(17,30,109,'avance','2026-03-13 09:44:42','2026-03-13 09:44:42'),(18,30,115,'avance','2026-03-13 09:44:42','2026-03-13 09:44:42'),(19,30,110,'avance','2026-03-13 09:44:42','2026-03-13 09:44:42'),(20,31,12,'debutant','2026-03-13 09:44:42','2026-03-13 09:44:42'),(21,31,3,'debutant','2026-03-13 09:44:42','2026-03-13 09:44:42'),(22,31,2,'debutant','2026-03-13 09:44:42','2026-03-13 09:44:42'),(23,31,10,'debutant','2026-03-13 09:44:42','2026-03-13 09:44:42'),(24,31,1,'debutant','2026-03-13 09:44:42','2026-03-13 09:44:42'),(25,32,52,'intermediaire','2026-03-13 09:44:42','2026-03-13 09:44:42'),(26,32,45,'intermediaire','2026-03-13 09:44:42','2026-03-13 09:44:42'),(27,32,55,'intermediaire','2026-03-13 09:44:42','2026-03-13 09:44:42'),(28,32,49,'intermediaire','2026-03-13 09:44:42','2026-03-13 09:44:42'),(29,33,34,'avance','2026-03-13 09:44:42','2026-03-13 09:44:42'),(30,33,109,'avance','2026-03-13 09:44:42','2026-03-13 09:44:42'),(31,33,41,'avance','2026-03-13 09:44:42','2026-03-13 09:44:42'),(32,34,6,'debutant','2026-03-13 09:44:42','2026-03-13 09:44:42'),(33,34,4,'debutant','2026-03-13 09:44:42','2026-03-13 09:44:42'),(34,35,45,'intermediaire','2026-03-13 09:44:42','2026-03-13 09:44:42'),(35,35,47,'intermediaire','2026-03-13 09:44:42','2026-03-13 09:44:42'),(36,36,109,'avance','2026-03-13 09:44:42','2026-03-13 09:44:42'),(37,36,115,'avance','2026-03-13 09:44:42','2026-03-13 09:44:42'),(38,36,110,'avance','2026-03-13 09:44:42','2026-03-13 09:44:42'),(39,37,12,'debutant','2026-03-13 09:44:42','2026-03-13 09:44:42'),(40,37,3,'debutant','2026-03-13 09:44:42','2026-03-13 09:44:42'),(41,37,2,'debutant','2026-03-13 09:44:42','2026-03-13 09:44:42'),(42,37,10,'debutant','2026-03-13 09:44:42','2026-03-13 09:44:42'),(43,37,1,'debutant','2026-03-13 09:44:42','2026-03-13 09:44:42'),(44,38,52,'intermediaire','2026-03-13 09:44:42','2026-03-13 09:44:42'),(45,38,45,'intermediaire','2026-03-13 09:44:42','2026-03-13 09:44:42'),(46,38,55,'intermediaire','2026-03-13 09:44:42','2026-03-13 09:44:42'),(47,38,49,'intermediaire','2026-03-13 09:44:42','2026-03-13 09:44:42'),(48,39,34,'avance','2026-03-13 09:44:42','2026-03-13 09:44:42'),(49,39,109,'avance','2026-03-13 09:44:42','2026-03-13 09:44:42'),(50,39,41,'avance','2026-03-13 09:44:42','2026-03-13 09:44:42'),(51,40,6,'debutant','2026-03-13 09:44:42','2026-03-13 09:44:42'),(52,40,4,'debutant','2026-03-13 09:44:42','2026-03-13 09:44:42'),(53,41,45,'intermediaire','2026-03-13 09:44:42','2026-03-13 09:44:42'),(54,41,47,'intermediaire','2026-03-13 09:44:42','2026-03-13 09:44:42'),(55,42,109,'avance','2026-03-13 09:44:42','2026-03-13 09:44:42'),(56,42,115,'avance','2026-03-13 09:44:42','2026-03-13 09:44:42'),(57,42,110,'avance','2026-03-13 09:44:42','2026-03-13 09:44:42');
/*!40000 ALTER TABLE `candidat_competence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `candidatures`
--

DROP TABLE IF EXISTS `candidatures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `candidatures` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `offre_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `lettre_motivation` text NOT NULL,
  `cv_path` varchar(255) DEFAULT NULL,
  `statut` enum('en_attente','vue','retenue','rejetee') NOT NULL DEFAULT 'en_attente',
  `note_recruteur` text DEFAULT NULL,
  `vue_le` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `candidatures_offre_id_user_id_unique` (`offre_id`,`user_id`),
  KEY `candidatures_user_id_foreign` (`user_id`),
  CONSTRAINT `candidatures_offre_id_foreign` FOREIGN KEY (`offre_id`) REFERENCES `offres` (`id`) ON DELETE CASCADE,
  CONSTRAINT `candidatures_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `candidatures`
--

LOCK TABLES `candidatures` WRITE;
/*!40000 ALTER TABLE `candidatures` DISABLE KEYS */;
/*!40000 ALTER TABLE `candidatures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Informatique et Technologies','informatique-et-technologies','Développement web, mobile, cybersécurité, réseaux, IA, etc.',1,'2026-03-13 09:44:33','2026-03-13 09:44:33'),(2,'Commerce et Vente','commerce-et-vente','Commercial, vendeur, technico-commercial, chargé de clientèle',1,'2026-03-13 09:44:33','2026-03-13 09:44:33'),(3,'Marketing et Communication','marketing-et-communication','Marketing digital, community manager, communication, publicité',1,'2026-03-13 09:44:33','2026-03-13 09:44:33'),(4,'Finance et Comptabilité','finance-et-comptabilite','Comptable, contrôleur de gestion, auditeur, analyste financier',1,'2026-03-13 09:44:33','2026-03-13 09:44:33'),(5,'Ressources Humaines','ressources-humaines','RH, recrutement, gestion du personnel, formation',1,'2026-03-13 09:44:33','2026-03-13 09:44:33'),(6,'Banque et Assurance','banque-et-assurance','Conseiller bancaire, chargé de clientèle, assureur',1,'2026-03-13 09:44:33','2026-03-13 09:44:33'),(7,'Santé et Médical','sante-et-medical','Médecin, infirmier, pharmacien, aide-soignant',1,'2026-03-13 09:44:33','2026-03-13 09:44:33'),(8,'Éducation et Formation','education-et-formation','Enseignant, formateur, professeur, éducateur',1,'2026-03-13 09:44:33','2026-03-13 09:44:33'),(9,'Ingénierie et BTP','ingenierie-et-btp','Ingénieur civil, architecte, chef de chantier, technicien',1,'2026-03-13 09:44:33','2026-03-13 09:44:33'),(10,'Juridique et Droit','juridique-et-droit','Avocat, juriste, notaire, assistant juridique',1,'2026-03-13 09:44:33','2026-03-13 09:44:33'),(11,'Transport et Logistique','transport-et-logistique','Chauffeur, logisticien, gestionnaire de stock, dispatcher',1,'2026-03-13 09:44:33','2026-03-13 09:44:33'),(12,'Hôtellerie et Restauration','hotellerie-et-restauration','Cuisinier, serveur, réceptionniste, chef de cuisine',1,'2026-03-13 09:44:33','2026-03-13 09:44:33'),(13,'Agriculture et Environnement','agriculture-et-environnement','Agronome, technicien agricole, environnementaliste',1,'2026-03-13 09:44:33','2026-03-13 09:44:33'),(14,'Art et Design','art-et-design','Graphiste, designer, photographe, vidéaste',1,'2026-03-13 09:44:33','2026-03-13 09:44:33'),(15,'Administration et Secrétariat','administration-et-secretariat','Secrétaire, assistant administratif, office manager',1,'2026-03-13 09:44:33','2026-03-13 09:44:33'),(16,'Télécommunications','telecommunications','Ingénieur réseau, technicien télécom, administrateur systèmes',1,'2026-03-13 09:44:33','2026-03-13 09:44:33'),(17,'Énergie et Environnement','energie-et-environnement','Technicien énergie solaire, électricien, ingénieur énergétique',1,'2026-03-13 09:44:33','2026-03-13 09:44:33'),(18,'Services Publics','services-publics','Fonctionnaire, agent d\'État, technicien des services publics',1,'2026-03-13 09:44:33','2026-03-13 09:44:33'),(19,'Microfinance et Économie Sociale','microfinance-et-economie-sociale','Agent de crédit, conseiller microfinance, gestionnaire de portefeuille',1,'2026-03-13 09:44:33','2026-03-13 09:44:33'),(20,'Restauration et Livraison','restauration-et-livraison','Livreur, gestionnaire de restaurant, cuisinier, barista',1,'2026-03-13 09:44:33','2026-03-13 09:44:33');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `competences`
--

DROP TABLE IF EXISTS `competences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `competences` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `type` enum('technique','transversale') NOT NULL DEFAULT 'technique',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `competences_nom_unique` (`nom`)
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `competences`
--

LOCK TABLES `competences` WRITE;
/*!40000 ALTER TABLE `competences` DISABLE KEYS */;
INSERT INTO `competences` VALUES (1,'PHP','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(2,'Laravel','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(3,'JavaScript','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(4,'React','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(5,'Vue.js','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(6,'Node.js','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(7,'HTML/CSS','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(8,'Tailwind CSS','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(9,'Bootstrap','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(10,'MySQL','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(11,'PostgreSQL','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(12,'Git','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(13,'API REST','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(14,'WordPress','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(15,'Python','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(16,'Java','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(17,'C#','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(18,'.NET','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(19,'Android','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(20,'iOS','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(21,'Flutter','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(22,'Cybersécurité','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(23,'Réseaux','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(24,'Cloud (AWS/Azure)','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(25,'Docker','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(26,'Linux','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(27,'Windows Server','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(28,'Photoshop','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(29,'Illustrator','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(30,'InDesign','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(31,'Figma','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(32,'Adobe XD','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(33,'After Effects','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(34,'Canva','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(35,'Montage vidéo','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(36,'Google Ads','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(37,'Facebook Ads','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(38,'SEO','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(39,'SEA','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(40,'Google Analytics','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(41,'Social Media Marketing','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(42,'Email Marketing','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(43,'Pack Office','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(44,'Excel','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(45,'Excel avancé','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(46,'Word','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(47,'PowerPoint','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(48,'Google Workspace','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(49,'Sage','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(50,'SAP','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(51,'ERP','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(52,'Comptabilité générale','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(53,'Comptabilité analytique','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(54,'Audit','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(55,'Fiscalité','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(56,'Contrôle de gestion','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(57,'Maçonnerie','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(58,'Plomberie','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(59,'Électricité bâtiment','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(60,'Peinture bâtiment','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(61,'Menuiserie','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(62,'Carrelage','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(63,'Soudure','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(64,'Lecture de plans','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(65,'Topographie','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(66,'Conduite d’engins','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(67,'Génie civil','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(68,'Architecture','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(69,'AutoCAD','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(70,'Revit','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(71,'SketchUp','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(72,'Conduite automobile','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(73,'Conduite poids lourd','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(74,'Logistique','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(75,'Gestion de stock','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(76,'Livraison','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(77,'Maintenance mécanique','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(78,'Mécanique automobile','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(79,'Électricité automobile','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(80,'Maintenance industrielle','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(81,'Électromécanique','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(82,'Automatisme','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(83,'Hydraulique','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(84,'Pneumatique','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(85,'Production industrielle','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(86,'Soins infirmiers','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(87,'Aide-soignant','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(88,'Pharmacie','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(89,'Laboratoire','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(90,'Hygiène hospitalière','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(91,'Sécurité privée','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(92,'Surveillance','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(93,'Gardiennage','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(94,'Sécurité incendie','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(95,'Contrôle d’accès','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(96,'Vente','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(97,'Gestion de caisse','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(98,'Prospection','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(99,'Négociation commerciale','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(100,'Relation client','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(101,'Merchandising','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(102,'Secrétariat','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(103,'Saisie informatique','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(104,'Archivage','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(105,'Gestion administrative','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(106,'Accueil','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(107,'Rédaction','technique','2026-03-13 09:44:33','2026-03-13 09:44:33'),(108,'Communication orale','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(109,'Communication écrite','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(110,'Travail en équipe','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(111,'Leadership','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(112,'Gestion du temps','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(113,'Résolution de problèmes','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(114,'Pensée critique','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(115,'Créativité','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(116,'Adaptabilité','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(117,'Gestion du stress','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(118,'Négociation','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(119,'Service client','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(120,'Organisation','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(121,'Prise de décision','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(122,'Esprit d\'initiative','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(123,'Rigueur','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(124,'Autonomie','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(125,'Gestion de projet','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(126,'Animation de réunion','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(127,'Sens commercial','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(128,'Ponctualité','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(129,'Sens des responsabilités','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(130,'Respect des consignes','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(131,'Respect des règles','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(132,'Respect des délais','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(133,'Sérieux','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(134,'Fiabilité','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(135,'Motivation','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(136,'Discipline','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(137,'Assiduité','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(138,'Polyvalence','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(139,'Travail sous pression','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(140,'Capacité d’apprentissage','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(141,'Sens du détail','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(142,'Respect de la hiérarchie','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(143,'Professionnalisme','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(144,'Loyauté','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(145,'Esprit d’équipe','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(146,'Gestion des priorités','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(147,'Patience','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(148,'Dynamisme','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(149,'Réactivité','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(150,'Implication','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(151,'Sens du service','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(152,'Adaptation rapide','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(153,'Esprit d’analyse','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(154,'Concentration','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(155,'Autocontrôle','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(156,'Respect du matériel','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(157,'Respect des normes','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(158,'Sécurité au travail','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(159,'Esprit d’amélioration','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(160,'Persévérance','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(161,'Travail autonome','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(162,'Capacité à suivre des instructions','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(163,'Capacité à atteindre les objectifs','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(164,'Bonne présentation','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33'),(165,'Bonne attitude','transversale','2026-03-13 09:44:33','2026-03-13 09:44:33');
/*!40000 ALTER TABLE `competences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entreprises`
--

DROP TABLE IF EXISTS `entreprises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entreprises` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `nom_entreprise` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `secteur_activite` varchar(255) NOT NULL,
  `site_web` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `ville` varchar(255) NOT NULL DEFAULT 'Cotonou',
  `telephone_entreprise` varchar(255) DEFAULT NULL,
  `effectif` int(11) DEFAULT NULL,
  `annee_creation` year(4) DEFAULT NULL,
  `statut` enum('en_attente','validee','rejetee') NOT NULL DEFAULT 'en_attente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `entreprises_slug_unique` (`slug`),
  KEY `entreprises_user_id_foreign` (`user_id`),
  CONSTRAINT `entreprises_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entreprises`
--

LOCK TABLES `entreprises` WRITE;
/*!40000 ALTER TABLE `entreprises` DISABLE KEYS */;
INSERT INTO `entreprises` VALUES (1,2,'TechSolutions Bénin','techsolutions-benin','Entreprise spécialisée dans le développement de solutions digitales pour les entreprises béninoises.',NULL,'Informatique et Technologies','https://www.techsolutions.bj','Rue 123, Akpakpa','Cotonou','+229 21 30 45 67',25,2018,'validee','2026-03-13 09:44:42','2026-03-13 09:44:42'),(2,3,'Cabinet Expertise Comptable & Audit','cabinet-expertise-comptable-audit','Cabinet d\'expertise comptable offrant des services de comptabilité, audit et conseil fiscal.',NULL,'Finance et Comptabilité','https://www.expertise-compta.bj','Avenue Steinmetz, Quartier des Affaires','Cotonou','+229 21 31 52 89',15,2015,'validee','2026-03-13 09:44:42','2026-03-13 09:44:42'),(3,4,'AgriVert Bénin SARL','agrivert-benin-sarl','Entreprise agricole moderne spécialisée dans la production de fruits et légumes bio.',NULL,'Agriculture et Environnement',NULL,'Zone Agricole, BP 456','Parakou','+229 97 45 23 18',50,2019,'validee','2026-03-13 09:44:42','2026-03-13 09:44:42'),(4,5,'Orange Bénin SA','orange-benin-sa','Opérateur télécom leader au Bénin, offrant des services mobiles, internet et solutions digitales aux particuliers et entreprises.',NULL,'Télécommunications','https://www.orange.bj','Boulevard Saint-Michel, Haie Vive','Cotonou','+229 21 36 00 00',500,2000,'validee','2026-03-13 09:44:42','2026-03-13 09:44:42'),(5,6,'MTN Bénin','mtn-benin','Opérateur de téléphonie mobile proposant des services voix, data et mobile money à travers tout le Bénin.',NULL,'Télécommunications','https://www.mtn.bj','Avenue Jean-Paul II','Cotonou','+229 21 37 00 00',400,2000,'validee','2026-03-13 09:44:42','2026-03-13 09:44:42'),(6,7,'BSIC Bénin','bsic-benin','Banque offrant des solutions financières innovantes pour les particuliers et les PME au Bénin.',NULL,'Banque et Assurance','https://www.bsic.bj','Avenue Clozel','Cotonou','+229 21 31 20 00',120,2005,'validee','2026-03-13 09:44:42','2026-03-13 09:44:42'),(7,8,'Orabank Bénin','orabank-benin','Institution financière panafricaine proposant des solutions bancaires adaptées aux besoins des entreprises et particuliers.',NULL,'Banque et Assurance','https://www.orabank.bj','Place des Martyrs','Cotonou','+229 21 31 30 00',200,2010,'validee','2026-03-13 09:44:42','2026-03-13 09:44:42'),(8,9,'Ecobank Bénin','ecobank-benin','Banque panafricaine présente dans 36 pays, offrant des services bancaires complets au Bénin.',NULL,'Banque et Assurance','https://www.ecobank.bj','Avenue Boufflers, Ganhi','Cotonou','+229 21 31 40 00',250,1999,'validee','2026-03-13 09:44:42','2026-03-13 09:44:42'),(9,10,'Cabinet Juridique Akpovi & Associés','cabinet-juridique-akpovi-associes','Cabinet d\'avocats spécialisé en droit des affaires, droit du travail et contentieux commercial.',NULL,'Juridique et Droit',NULL,'Rue du Commerce, Ganhi','Cotonou','+229 97 12 34 56',10,2012,'validee','2026-03-13 09:44:42','2026-03-13 09:44:42'),(10,11,'Clinique Sainte Marie','clinique-sainte-marie','Établissement de santé privé proposant des soins médicaux de qualité en médecine générale, chirurgie et pédiatrie.',NULL,'Santé et Médical','https://www.clinique-saintemarie.bj','Carrefour Vèdoko','Cotonou','+229 21 32 10 00',80,2008,'validee','2026-03-13 09:44:42','2026-03-13 09:44:42'),(11,12,'Groupe Scolaire Excellence','groupe-scolaire-excellence','Établissement d\'enseignement privé de la maternelle au lycée, axé sur l\'excellence académique et le développement personnel.',NULL,'Éducation et Formation','https://www.excellence.bj','Quartier Cadjehoun','Cotonou','+229 97 55 66 77',60,2005,'validee','2026-03-13 09:44:42','2026-03-13 09:44:42'),(12,13,'BTP Construct Bénin','btp-construct-benin','Entreprise de construction spécialisée dans le bâtiment, les travaux publics et l\'aménagement urbain.',NULL,'Ingénierie et BTP',NULL,'Zone Industrielle, Glo-Djigbé','Cotonou','+229 96 44 55 66',150,2010,'validee','2026-03-13 09:44:42','2026-03-13 09:44:42'),(13,14,'LogisTrans Bénin','logistrans-benin','Entreprise de logistique et transport offrant des solutions de livraison et gestion de stock pour les entreprises.',NULL,'Transport et Logistique','https://www.logistrans.bj','Port de Cotonou, Zone Franche','Cotonou','+229 97 33 44 55',75,2014,'validee','2026-03-13 09:44:42','2026-03-13 09:44:42'),(14,15,'Hôtel Azalaï Cotonou','hotel-azalai-cotonou','Hôtel 5 étoiles offrant hébergement de luxe, restauration gastronomique et salles de conférences pour les voyageurs d\'affaires.',NULL,'Hôtellerie et Restauration','https://www.azalaihotels.com','Avenue Clozel, Centre-ville','Cotonou','+229 21 30 10 00',200,2003,'validee','2026-03-13 09:44:42','2026-03-13 09:44:42'),(15,16,'BeninWeb Digital Agency','beninweb-digital-agency','Agence digitale spécialisée en création de sites web, marketing digital et stratégies de communication online.',NULL,'Marketing et Communication','https://www.beninweb.bj','Quartier Haie Vive','Cotonou','+229 96 78 90 12',20,2017,'validee','2026-03-13 09:44:42','2026-03-13 09:44:42'),(16,17,'SONEB - Société Nationale des Eaux','soneb-societe-nationale-des-eaux','Société nationale assurant la production et la distribution d\'eau potable sur l\'ensemble du territoire béninois.',NULL,'Services Publics','https://www.soneb.bj','Boulevard Saint-Michel','Cotonou','+229 21 31 00 00',800,1990,'validee','2026-03-13 09:44:42','2026-03-13 09:44:42'),(17,18,'SBEE - Société Béninoise d\'Énergie','sbee-societe-beninoise-d-energie','Société d\'état responsable de la production, du transport et de la distribution de l\'énergie électrique au Bénin.',NULL,'Énergie','https://www.sbee.bj','Avenue Mgr Steinmetz','Cotonou','+229 21 31 11 00',1200,1982,'validee','2026-03-13 09:44:42','2026-03-13 09:44:42'),(18,19,'Pharmacie Centrale du Bénin','pharmacie-centrale-du-benin','Centrale d\'approvisionnement en médicaments et produits pharmaceutiques pour les structures sanitaires du Bénin.',NULL,'Santé et Médical',NULL,'Avenue Jean-Paul II','Cotonou','+229 21 31 22 00',45,1995,'validee','2026-03-13 09:44:42','2026-03-13 09:44:42'),(19,20,'Studio Créatif Voodoo','studio-creatif-voodoo','Studio de création visuelle spécialisé en design graphique, photographie, vidéo et production artistique.',NULL,'Art et Design','https://www.voodoo-studio.bj','Quartier Zogbohouè','Cotonou','+229 96 11 22 33',12,2016,'validee','2026-03-13 09:44:42','2026-03-13 09:44:42'),(20,21,'AssuriBénin','assuribenin','Compagnie d\'assurance proposant des produits vie, auto, habitation et santé adaptés au marché béninois.',NULL,'Banque et Assurance','https://www.assuribenin.bj','Rue du Gouverneur Bayol','Cotonou','+229 21 31 55 00',90,2007,'validee','2026-03-13 09:44:42','2026-03-13 09:44:42'),(21,22,'FoodTech Bénin','foodtech-benin','Startup spécialisée dans la livraison de repas et la mise en relation entre restaurants et consommateurs via une application mobile.',NULL,'Restauration et Tech','https://www.foodtech.bj','Quartier Ouando','Porto-Novo','+229 97 99 88 77',30,2020,'validee','2026-03-13 09:44:42','2026-03-13 09:44:42'),(22,23,'EnergieSolaire Bénin','energiesolaire-benin','Entreprise spécialisée dans l\'installation de panneaux solaires et solutions d\'énergie renouvelable pour particuliers et entreprises.',NULL,'Énergie Renouvelable','https://www.energiesolaire.bj','Zone Industrielle Parakou','Parakou','+229 96 55 44 33',35,2018,'validee','2026-03-13 09:44:42','2026-03-13 09:44:42'),(23,24,'MicroFinance Alafia','microfinance-alafia','Institution de microfinance soutenant les petits entrepreneurs et artisans béninois par des crédits adaptés à leurs besoins.',NULL,'Microfinance',NULL,'Carrefour Godomey','Abomey-Calavi','+229 21 32 20 00',55,2011,'validee','2026-03-13 09:44:42','2026-03-13 09:44:42');
/*!40000 ALTER TABLE `entreprises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `experiences`
--

DROP TABLE IF EXISTS `experiences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `experiences` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `poste` varchar(255) NOT NULL,
  `entreprise` varchar(255) NOT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date DEFAULT NULL,
  `en_cours` tinyint(1) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `experiences_user_id_foreign` (`user_id`),
  CONSTRAINT `experiences_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `experiences`
--

LOCK TABLES `experiences` WRITE;
/*!40000 ALTER TABLE `experiences` DISABLE KEYS */;
INSERT INTO `experiences` VALUES (1,25,'Développeur Web Junior','Digital Agency BJ','Cotonou','2022-03-01','2023-12-31',0,'Développement de sites web avec Laravel et Vue.js','2026-03-13 09:44:42','2026-03-13 09:44:42'),(2,26,'Assistante Comptable','Cabinet COMPTA+','Porto-Novo','2020-09-01',NULL,1,'Gestion comptable, déclarations fiscales, suivi trésorerie','2026-03-13 09:44:42','2026-03-13 09:44:42'),(3,27,'Chargé Marketing Digital','StartUp BJ','Cotonou','2021-06-01','2023-05-31',0,'Gestion des réseaux sociaux et campagnes publicitaires','2026-03-13 09:44:42','2026-03-13 09:44:42'),(4,28,'Développeur Full Stack','TechBénin SARL','Cotonou','2023-01-01',NULL,1,'Développement d\'applications web avec Laravel et React','2026-03-13 09:44:42','2026-03-13 09:44:42'),(5,29,'Analyste Financier','Banque BOA','Cotonou','2019-09-01','2022-08-31',0,'Analyse des risques et reporting financier','2026-03-13 09:44:42','2026-03-13 09:44:42'),(6,30,'Infirmier Diplômé','Clinique Les Cocotiers','Cotonou','2020-03-01',NULL,1,'Soins aux patients, urgences, pédiatrie','2026-03-13 09:44:42','2026-03-13 09:44:42'),(7,31,'Enseignant Vacataire','Lycée Technique de Cotonou','Cotonou','2021-09-01','2023-06-30',0,'Enseignement informatique et mathématiques','2026-03-13 09:44:42','2026-03-13 09:44:42'),(8,32,'Commercial Terrain','Orange Bénin','Parakou','2022-01-01',NULL,1,'Vente de produits et services télécom','2026-03-13 09:44:42','2026-03-13 09:44:42'),(9,33,'Graphiste','Agence Créative Cotonou','Cotonou','2020-06-01','2022-12-31',0,'Création de supports visuels et identités visuelles','2026-03-13 09:44:42','2026-03-13 09:44:42'),(10,34,'Juriste d\'Entreprise','Cabinet Akpovi','Cotonou','2021-01-01',NULL,1,'Rédaction de contrats et conseil juridique','2026-03-13 09:44:42','2026-03-13 09:44:42'),(11,35,'Développeur Web Junior','Digital Agency BJ','Cotonou','2022-03-01','2023-12-31',0,'Développement de sites web avec Laravel et Vue.js','2026-03-13 09:44:42','2026-03-13 09:44:42'),(12,36,'Assistante Comptable','Cabinet COMPTA+','Porto-Novo','2020-09-01',NULL,1,'Gestion comptable, déclarations fiscales, suivi trésorerie','2026-03-13 09:44:42','2026-03-13 09:44:42'),(13,37,'Chargé Marketing Digital','StartUp BJ','Cotonou','2021-06-01','2023-05-31',0,'Gestion des réseaux sociaux et campagnes publicitaires','2026-03-13 09:44:42','2026-03-13 09:44:42'),(14,38,'Développeur Full Stack','TechBénin SARL','Cotonou','2023-01-01',NULL,1,'Développement d\'applications web avec Laravel et React','2026-03-13 09:44:42','2026-03-13 09:44:42'),(15,39,'Analyste Financier','Banque BOA','Cotonou','2019-09-01','2022-08-31',0,'Analyse des risques et reporting financier','2026-03-13 09:44:42','2026-03-13 09:44:42'),(16,40,'Infirmier Diplômé','Clinique Les Cocotiers','Cotonou','2020-03-01',NULL,1,'Soins aux patients, urgences, pédiatrie','2026-03-13 09:44:42','2026-03-13 09:44:42'),(17,41,'Enseignant Vacataire','Lycée Technique de Cotonou','Cotonou','2021-09-01','2023-06-30',0,'Enseignement informatique et mathématiques','2026-03-13 09:44:42','2026-03-13 09:44:42'),(18,42,'Commercial Terrain','Orange Bénin','Parakou','2022-01-01',NULL,1,'Vente de produits et services télécom','2026-03-13 09:44:42','2026-03-13 09:44:42');
/*!40000 ALTER TABLE `experiences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favoris`
--

DROP TABLE IF EXISTS `favoris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favoris` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `offre_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `favoris_user_id_offre_id_unique` (`user_id`,`offre_id`),
  KEY `favoris_offre_id_foreign` (`offre_id`),
  CONSTRAINT `favoris_offre_id_foreign` FOREIGN KEY (`offre_id`) REFERENCES `offres` (`id`) ON DELETE CASCADE,
  CONSTRAINT `favoris_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favoris`
--

LOCK TABLES `favoris` WRITE;
/*!40000 ALTER TABLE `favoris` DISABLE KEYS */;
/*!40000 ALTER TABLE `favoris` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formations`
--

DROP TABLE IF EXISTS `formations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `diplome` varchar(255) NOT NULL,
  `etablissement` varchar(255) NOT NULL,
  `domaine` varchar(255) DEFAULT NULL,
  `annee_obtention` year(4) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formations_user_id_foreign` (`user_id`),
  CONSTRAINT `formations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formations`
--

LOCK TABLES `formations` WRITE;
/*!40000 ALTER TABLE `formations` DISABLE KEYS */;
INSERT INTO `formations` VALUES (1,25,'Licence en Informatique','UAC','Génie Logiciel',2021,NULL,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(2,26,'BTS Comptabilité Gestion','ESTIM','Comptabilité',2020,NULL,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(3,27,'Licence en Marketing','FASEG','Marketing',2021,NULL,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(4,28,'Master Développement Web','IFRI','Technologies Web',2023,NULL,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(5,29,'Master Finance','FASEG - UAC','Finance d\'entreprise',2019,NULL,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(6,30,'BTS Soins Infirmiers','ISBA','Sciences de la Santé',2019,NULL,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(7,31,'Licence en Mathématiques','FAST - UAC','Mathématiques Appliquées',2020,NULL,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(8,32,'BTS Commerce','ESAG-NDE','Commerce et Vente',2021,NULL,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(9,33,'Licence Art et Design','INJEPS','Design Graphique',2020,NULL,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(10,34,'Master Droit des Affaires','FADESP - UAC','Droit',2021,NULL,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(11,35,'Licence Gestion RH','ESGIS','Ressources Humaines',2022,NULL,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(12,36,'BTS Informatique','IPNET','Développement Logiciel',2022,NULL,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(13,37,'Licence Logistique','ESTIM','Transport et Logistique',2021,NULL,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(14,38,'BTS Hôtellerie Restauration','Institut Hôtelier de Cotonou','Hôtellerie',2020,NULL,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(15,39,'Licence Agronomie','FSA - UAC','Agriculture',2022,NULL,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(16,40,'Master Génie Civil','EPAC - UAC','BTP',2021,NULL,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(17,41,'Licence Communication','FADESP','Communication',2023,NULL,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(18,42,'BTS Banque Assurance','CESAG','Banque et Finance',2022,NULL,'2026-03-13 09:44:42','2026-03-13 09:44:42');
/*!40000 ALTER TABLE `formations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_03_07_192302_create_entreprises_table',1),(5,'2026_03_07_192330_create_categories_table',1),(6,'2026_03_07_192340_create_offres_table',1),(7,'2026_03_07_192350_create_candidatures_table',1),(8,'2026_03_07_192358_create_experiences_table',1),(9,'2026_03_07_192407_create_formations_table',1),(10,'2026_03_07_192416_create_competences_table',1),(11,'2026_03_07_192429_create_candidat_competence_table',1),(12,'2026_03_07_192446_create_favoris_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offres`
--

DROP TABLE IF EXISTS `offres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offres` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `entreprise_id` bigint(20) unsigned NOT NULL,
  `categorie_id` bigint(20) unsigned NOT NULL,
  `titre` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `type_offre` enum('emploi','stage_professionnel','stage_academique') NOT NULL,
  `type_contrat` enum('CDI','CDD','temps_partiel','freelance','stage') DEFAULT NULL,
  `description` text NOT NULL,
  `missions` text NOT NULL,
  `profil_recherche` text NOT NULL,
  `competences_requises` text DEFAULT NULL,
  `niveau_etude` varchar(255) DEFAULT NULL,
  `annees_experience` int(11) NOT NULL DEFAULT 0,
  `ville` varchar(255) NOT NULL,
  `salaire_min` varchar(255) DEFAULT NULL,
  `salaire_max` varchar(255) DEFAULT NULL,
  `salaire_a_negocier` tinyint(1) NOT NULL DEFAULT 0,
  `nombre_postes` int(11) NOT NULL DEFAULT 1,
  `date_limite` date DEFAULT NULL,
  `statut` enum('active','fermee','pourvue') NOT NULL DEFAULT 'active',
  `vues` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `offres_slug_unique` (`slug`),
  KEY `offres_entreprise_id_foreign` (`entreprise_id`),
  KEY `offres_categorie_id_foreign` (`categorie_id`),
  CONSTRAINT `offres_categorie_id_foreign` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `offres_entreprise_id_foreign` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprises` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offres`
--

LOCK TABLES `offres` WRITE;
/*!40000 ALTER TABLE `offres` DISABLE KEYS */;
INSERT INTO `offres` VALUES (1,1,1,'Développeur Laravel Senior','developpeur-laravel-senior','emploi','CDI','Nous recherchons un développeur Laravel expérimenté pour rejoindre notre équipe.','- Développer des applications web avec Laravel\n- Participer à la conception technique\n- Assurer la maintenance des projets existants\n- Former les développeurs juniors','- Minimum 3 ans d\'expérience en Laravel\n- Maîtrise de PHP, MySQL, JavaScript\n- Connaissance de Git','Laravel, PHP, MySQL, JavaScript, Git','Licence/Master en Informatique',3,'Cotonou','250000','400000',0,2,'2026-04-12','active',45,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(2,4,1,'Ingénieur Réseau et Télécoms','ingenieur-reseau-et-telecoms','emploi','CDI','Orange Bénin recrute un ingénieur réseau pour renforcer son équipe technique.','- Gérer et optimiser le réseau mobile\n- Déployer les nouvelles infrastructures\n- Assurer la supervision et la maintenance','- Diplôme ingénieur en télécoms\n- 2 ans d\'expérience minimum\n- Maîtrise des protocoles réseau','Réseaux IP, 4G/5G, Cisco, supervision réseau','Master en Télécommunications',2,'Cotonou','400000','600000',1,1,'2026-04-27','active',89,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(3,2,4,'Comptable Confirmé','comptable-confirme','emploi','CDI','Notre cabinet recrute un comptable confirmé pour renforcer notre équipe.','- Tenir la comptabilité générale\n- Établir les déclarations fiscales\n- Préparer les bilans et comptes de résultat','- Diplôme en comptabilité\n- 2 ans d\'expérience minimum\n- Maîtrise de Sage','Comptabilité générale, Sage, Excel, Fiscalité','Licence/Master en Comptabilité',2,'Cotonou','200000','300000',1,1,'2026-04-07','active',62,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(4,8,6,'Chargé de Clientèle Particuliers','charge-de-clientele-particuliers','emploi','CDI','Ecobank Bénin recherche un chargé de clientèle dynamique pour sa direction commerciale.','- Gérer et développer un portefeuille clients\n- Proposer des produits bancaires adaptés\n- Atteindre les objectifs commerciaux','- Formation en banque/finance\n- Bon relationnel\n- Orienté résultats','Relation client, Produits bancaires, Négociation','Licence en Finance ou Commerce',1,'Cotonou','180000','280000',0,3,'2026-04-02','active',112,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(5,10,7,'Médecin Généraliste','medecin-generaliste','emploi','CDI','La Clinique Sainte Marie recrute un médecin généraliste pour renforcer son équipe médicale.','- Assurer les consultations médicales\n- Suivre les patients hospitalisés\n- Participer aux gardes de nuit','- Docteur en médecine\n- Inscrit à l\'Ordre des Médecins du Bénin\n- Expérience souhaitée','Médecine générale, Urgences, Pédiatrie','Doctorat en Médecine',0,'Cotonou','500000','800000',1,2,'2026-05-12','active',78,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(6,12,9,'Ingénieur Génie Civil','ingenieur-genie-civil','emploi','CDI','BTP Construct recrute un ingénieur génie civil pour ses projets de construction.','- Superviser les chantiers de construction\n- Vérifier la conformité des travaux\n- Gérer les équipes sur le terrain','- Ingénieur génie civil\n- 3 ans d\'expérience chantier\n- Maîtrise des logiciels BTP','Génie civil, AutoCAD, Management chantier','Master en Génie Civil',3,'Cotonou','350000','500000',1,2,'2026-04-17','active',55,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(7,15,3,'Community Manager Senior','community-manager-senior','emploi','CDI','BeninWeb Digital Agency cherche un community manager expérimenté pour gérer les réseaux sociaux de ses clients.','- Créer et planifier du contenu pour les réseaux sociaux\n- Animer les communautés en ligne\n- Analyser les performances et faire des rapports','- 2 ans d\'expérience en community management\n- Créativité et sens du storytelling\n- Maîtrise des outils de scheduling','Réseaux sociaux, Canva, Meta Ads, Analytics','Licence en Marketing/Communication',2,'Cotonou','150000','250000',0,1,'2026-03-28','active',143,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(8,13,11,'Responsable Logistique','responsable-logistique','emploi','CDI','LogisTrans Bénin recrute un responsable logistique pour optimiser sa chaîne d\'approvisionnement.','- Gérer les flux de marchandises\n- Optimiser les coûts logistiques\n- Superviser l\'équipe entrepôt','- Formation en logistique/supply chain\n- 3 ans d\'expérience\n- Sens de l\'organisation','Supply chain, WMS, Excel, Management','Licence en Logistique',3,'Cotonou','280000','380000',0,1,'2026-04-10','active',67,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(9,14,12,'Réceptionniste Bilingue','receptionniste-bilingue','emploi','CDI','L\'Hôtel Azalaï recrute une réceptionniste bilingue français/anglais pour son service d\'accueil.','- Accueillir les clients à leur arrivée\n- Gérer les réservations et le check-in/out\n- Répondre aux demandes des clients','- Formation hôtellerie ou équivalent\n- Bilingue français/anglais\n- Excellente présentation','Accueil, Anglais courant, Logiciel hôtelier','BTS Hôtellerie ou équivalent',1,'Cotonou','120000','180000',0,2,'2026-04-02','active',95,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(10,19,14,'Graphiste UI/UX Designer','graphiste-ui-ux-designer','emploi','CDI','Studio Créatif Voodoo recherche un graphiste UI/UX pour concevoir des interfaces web et mobiles attractives.','- Concevoir des interfaces utilisateur\n- Créer des maquettes et prototypes\n- Collaborer avec les développeurs','- Portfolio solide\n- Maîtrise de Figma et Adobe Suite\n- Sensibilité esthétique','Figma, Adobe Illustrator, Photoshop, UI/UX','Licence en Design ou équivalent',2,'Cotonou','200000','320000',1,1,'2026-04-07','active',187,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(11,1,1,'Stage Pro - Développeur Web Junior','stage-pro-developpeur-web-junior','stage_professionnel','stage','Stage rémunéré de 6 mois pour développeurs web débutants.','- Participer au développement de sites web\n- Corriger les bugs et effectuer les tests\n- Travailler en équipe avec des seniors','- Formation en développement web\n- Connaissances de base en HTML, CSS, JavaScript\n- Motivation et envie d\'apprendre','HTML/CSS, JavaScript, bases PHP','BTS/Licence en cours ou obtenu',0,'Cotonou','75000','75000',0,3,'2026-04-02','active',78,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(12,7,6,'Stage Pro - Assistant Analyste Crédit','stage-pro-assistant-analyste-credit','stage_professionnel','stage','Stage de 6 mois au sein de la direction des engagements d\'Orabank.','- Analyser les dossiers de crédit\n- Préparer les comités de crédit\n- Rédiger les notes d\'analyse','- Formation en finance/banque\n- Capacité d\'analyse\n- Rigueur','Analyse financière, Excel, Rédaction','Licence/Master Finance en cours',0,'Cotonou','60000','80000',0,2,'2026-04-12','active',137,'2026-03-13 09:44:42','2026-03-13 09:46:32'),(13,5,3,'Stage Pro - Chargé Marketing Digital','stage-pro-charge-marketing-digital','stage_professionnel','stage','Stage de 4 mois au sein de l\'équipe marketing de MTN Bénin.','- Assister dans la gestion des campagnes digitales\n- Analyser les performances des actions marketing\n- Créer du contenu pour les réseaux sociaux','- Formation en marketing digital\n- Bonne maîtrise des réseaux sociaux\n- Créativité','Marketing digital, Canva, Google Analytics','Licence Marketing en cours ou obtenu',0,'Cotonou','70000','70000',0,2,'2026-03-31','active',201,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(14,3,13,'Stage Pro - Technicien Agricole','stage-pro-technicien-agricole','stage_professionnel','stage','Stage de terrain de 6 mois en production maraîchère biologique.','- Participer aux activités de production\n- Apprendre les techniques bio\n- Suivre les cultures','- Formation en agronomie\n- Intérêt pour l\'agriculture bio\n- Résistance physique','Agriculture, Botanique, Terrain','BTS/Licence Agronomie',0,'Parakou','50000','60000',0,2,'2026-04-04','active',44,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(15,16,9,'Stage Pro - Technicien Génie Hydraulique','stage-pro-technicien-genie-hydraulique','stage_professionnel','stage','Stage de 6 mois à la direction technique de la SONEB.','- Participer à la supervision des réseaux d\'eau\n- Assister aux inspections terrain\n- Rédiger des rapports techniques','- Formation en génie hydraulique ou génie civil\n- Rigueur et sens du terrain','Hydraulique, AutoCAD, Rapports techniques','Licence en Génie Hydraulique',0,'Cotonou','65000','65000',0,3,'2026-04-22','active',58,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(16,1,3,'Stage Académique - Assistant Marketing Digital','stage-academique-assistant-marketing-digital','stage_academique','stage','Stage académique de 3 mois pour étudiant en Marketing.','- Assister dans les campagnes digitales\n- Gérer les réseaux sociaux\n- Créer du contenu avec Canva','- Étudiant en Licence/Master Marketing\n- Créativité\n- Disponibilité 3 à 6 mois','Réseaux sociaux, Canva, Communication','Licence en cours - Marketing',0,'Cotonou',NULL,NULL,0,2,'2026-03-28','active',134,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(17,9,10,'Stage Académique - Assistant Juridique','stage-academique-assistant-juridique','stage_academique','stage','Stage de fin d\'études en droit des affaires au sein du cabinet Akpovi.','- Assister à la rédaction de contrats\n- Effectuer des recherches juridiques\n- Préparer des plaidoiries','- Étudiant en Master Droit\n- Excellentes capacités rédactionnelles','Droit des affaires, Rédaction juridique, Recherche','Master Droit en cours',0,'Cotonou',NULL,NULL,0,1,'2026-04-12','active',76,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(18,21,1,'Stage Académique - Développeur Mobile React Native','stage-academique-developpeur-mobile-react-native','stage_academique','stage','Stage de fin de cycle pour développer des fonctionnalités sur l\'application FoodTech.','- Développer des fonctionnalités React Native\n- Intégrer les APIs backend\n- Tester et corriger les bugs','- Étudiant en informatique\n- Connaissances React Native ou React\n- Curieux et autonome','React Native, JavaScript, API REST','Licence/Master Informatique en cours',0,'Porto-Novo',NULL,NULL,0,2,'2026-04-07','active',223,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(19,20,6,'Stage Académique - Assistant Actuariat','stage-academique-assistant-actuariat','stage_academique','stage','Stage de 3 mois au sein du département actuariat d\'AssuriBénin.','- Participer aux calculs actuariels\n- Analyser les données sinistres\n- Contribuer aux rapports de risque','- Étudiant en mathématiques ou statistiques\n- Maîtrise d\'Excel et R\n- Rigueur analytique','Statistiques, Excel, R, Modélisation','Master Mathématiques/Statistiques en cours',0,'Cotonou',NULL,NULL,0,1,'2026-04-17','active',89,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(20,22,9,'Stage Académique - Assistant Technicien Énergie Solaire','stage-academique-assistant-technicien-energie-solaire','stage_academique','stage','Stage de 3 mois pour étudiant en énergie ou électrotechnique.','- Assister à l\'installation de panneaux solaires\n- Effectuer des audits énergétiques\n- Rédiger des rapports d\'intervention','- Étudiant en génie électrique ou énergétique\n- Intérêt pour les énergies renouvelables','Électrotechnique, Énergie solaire, Terrain','Licence Génie Électrique en cours',0,'Parakou',NULL,NULL,0,2,'2026-04-02','active',51,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(21,2,4,'Assistant Comptable (Poste Pourvu)','assistant-comptable-poste-pourvu','emploi','CDD','Poste d\'assistant comptable - Recrutement terminé.','Saisie comptable, classement documents, déclarations','BTS Comptabilité minimum',NULL,'BTS',0,'Cotonou','100000','120000',0,1,'2026-03-08','pourvue',156,'2026-03-13 09:44:42','2026-03-13 09:44:42');
/*!40000 ALTER TABLE `offres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('Fphz0KxITMjC4dQwu5G1n6m3GIVw67B8oFwdABzM',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUFVzR0xvNENPWnd1TWtBS3JHdW9nTU5udDN3dE9XeDA1bUh0NU56dyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vZmZyZXMiO3M6NToicm91dGUiO3M6MTI6Im9mZnJlcy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1773398798);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('candidat','entreprise','admin') NOT NULL DEFAULT 'candidat',
  `telephone` varchar(255) DEFAULT NULL,
  `localisation` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrateur','admin@plateforme-emploi.bj','2026-03-13 09:44:33','$2y$12$I3oyqr.bTmFpt34jXCMW1.BYoI43w62sqhYmPXupJoGVMJReIeUnW','admin','+229 97 00 00 00','Cotonou',1,NULL,'2026-03-13 09:44:33','2026-03-13 09:44:33'),(2,'TechSolutions Bénin','contact@techsolutions.bj','2026-03-13 09:44:33','$2y$12$cw.0EUhEPC2Q7J5bxRnae.ZGgk2ddpxZKbzKecdZdHG614gQOISOW','entreprise','+229 21 30 45 67','Cotonou',1,NULL,'2026-03-13 09:44:33','2026-03-13 09:44:33'),(3,'Cabinet Expertise Comptable','contact@expertise-compta.bj','2026-03-13 09:44:33','$2y$12$oK4dBB7o8cr098hJXGs1M.2sVvuMLIei0v4hxYBw3EUcE6fdh9Lyy','entreprise','+229 21 31 52 89','Cotonou',1,NULL,'2026-03-13 09:44:33','2026-03-13 09:44:33'),(4,'AgriVert Bénin','info@agrivert.bj','2026-03-13 09:44:34','$2y$12$cXTb.ErTrLmRmWCrbi1wiO/g7kRzCYSWfbwHYdKPWdsUZemCmYIvi','entreprise','+229 97 45 23 18','Parakou',1,NULL,'2026-03-13 09:44:34','2026-03-13 09:44:34'),(5,'Orange Bénin','rh@orange.bj','2026-03-13 09:44:34','$2y$12$Wu9sS1C0llD2kl.MLd48puHcPhgv9pX.PKk.yO9YIk8m7Jh5QNY0S','entreprise','+229 21 36 00 00','Cotonou',1,NULL,'2026-03-13 09:44:34','2026-03-13 09:44:34'),(6,'MTN Bénin','recrutement@mtn.bj','2026-03-13 09:44:34','$2y$12$2zQ1K1RIhZpulI39gwQOF.z7EVcyX8VFSqloyKCKFb5q20OnR3DTS','entreprise','+229 21 37 00 00','Cotonou',1,NULL,'2026-03-13 09:44:34','2026-03-13 09:44:34'),(7,'BSIC Bénin','rh@bsic.bj','2026-03-13 09:44:34','$2y$12$zbMzp12l/lQchHzKgejnpOBvjmYY241h/PRT8IjwA59BZ5O2.NPA2','entreprise','+229 21 31 20 00','Cotonou',1,NULL,'2026-03-13 09:44:34','2026-03-13 09:44:34'),(8,'Orabank Bénin','jobs@orabank.bj','2026-03-13 09:44:34','$2y$12$VWIoDn8aFN.tFQfVd16sAuOwGkbdex4GG25U5mS1Dj8WqLBlYdvN2','entreprise','+229 21 31 30 00','Cotonou',1,NULL,'2026-03-13 09:44:34','2026-03-13 09:44:34'),(9,'Ecobank Bénin','recrutement@ecobank.bj','2026-03-13 09:44:35','$2y$12$L5qo/PAjYiQKnBS6CYCBLefuB7RCT98p6RL5BYiGZYUIjh8AiDMZS','entreprise','+229 21 31 40 00','Cotonou',1,NULL,'2026-03-13 09:44:35','2026-03-13 09:44:35'),(10,'Cabinet Juridique Akpovi','contact@akpovi-juridique.bj','2026-03-13 09:44:35','$2y$12$q8FfOEm2T4iNBN0gjmi2/.26BIWOI8wfVLNZTwLQZOUrSCjp4K1dO','entreprise','+229 97 12 34 56','Cotonou',1,NULL,'2026-03-13 09:44:35','2026-03-13 09:44:35'),(11,'Clinique Sainte Marie','rh@clinique-saintemarie.bj','2026-03-13 09:44:35','$2y$12$9qkf3k7J.wgtXUNXZGEFeeSKKHemMGkDxRUpvrNdnPoz5/0tD5GA6','entreprise','+229 21 32 10 00','Cotonou',1,NULL,'2026-03-13 09:44:35','2026-03-13 09:44:35'),(12,'Groupe Scolaire Excellence','direction@excellence.bj','2026-03-13 09:44:35','$2y$12$VdJkzT9R2B5Yz0Fx6HAg9OKQLX5XVS8iZNnD3s18ND242NjnYVJy.','entreprise','+229 97 55 66 77','Cotonou',1,NULL,'2026-03-13 09:44:35','2026-03-13 09:44:35'),(13,'BTP Construct Bénin','rh@btpconstruct.bj','2026-03-13 09:44:36','$2y$12$hrfR0NZIl85aH7yfZXEVzesO5xiyQWoia5QnHO1qBjrSegHKItssG','entreprise','+229 96 44 55 66','Cotonou',1,NULL,'2026-03-13 09:44:36','2026-03-13 09:44:36'),(14,'LogisTrans Bénin','emploi@logistrans.bj','2026-03-13 09:44:36','$2y$12$7Z2OxGnfoTHl8WKXDjF/Be37MU3/n4XO5KCz0ukiTWbdVYv9kJt7i','entreprise','+229 97 33 44 55','Cotonou',1,NULL,'2026-03-13 09:44:36','2026-03-13 09:44:36'),(15,'Hôtel Azalaï','rh@azalai.bj','2026-03-13 09:44:36','$2y$12$UtkuDq4TXlt2tBrZ/eIl3ez21RoDg0lXdjGpP1VocRJG3taJXSUx.','entreprise','+229 21 30 10 00','Cotonou',1,NULL,'2026-03-13 09:44:36','2026-03-13 09:44:36'),(16,'Agence Digitale BeninWeb','jobs@beninweb.bj','2026-03-13 09:44:36','$2y$12$NWbreMGFXG8uvcOhnYsnmeZ/RMdn8P2MHYMZ.3tGfWy7Vsj9gLXs6','entreprise','+229 96 78 90 12','Cotonou',1,NULL,'2026-03-13 09:44:36','2026-03-13 09:44:36'),(17,'SONEB','recrutement@soneb.bj','2026-03-13 09:44:36','$2y$12$uFqQdXy48WcPaVb3/OhC2uYrPw2pLriQDm90tblxKbgPt.SMGf30O','entreprise','+229 21 31 00 00','Cotonou',1,NULL,'2026-03-13 09:44:36','2026-03-13 09:44:36'),(18,'SBEE','rh@sbee.bj','2026-03-13 09:44:37','$2y$12$L4zQHFZfRsOpfYou/.0TIO9q7VHPCO6vP7cKfMipP9a/CmJv4PDKO','entreprise','+229 21 31 11 00','Cotonou',1,NULL,'2026-03-13 09:44:37','2026-03-13 09:44:37'),(19,'Pharmacie Centrale Bénin','emploi@pharmaciecentrale.bj','2026-03-13 09:44:37','$2y$12$nTKzgkpbUJvqaxTydRV.Dur5f4x5W8MX9sUYscdU90KvzL0ZYU3t2','entreprise','+229 21 31 22 00','Cotonou',1,NULL,'2026-03-13 09:44:37','2026-03-13 09:44:37'),(20,'Studio Créatif Voodoo','hello@voodoo-studio.bj','2026-03-13 09:44:37','$2y$12$CYM/pcPtwjkyP/ru1nKsYuQeD5rtCgDxJWGBwoiJZrallos/lQeGu','entreprise','+229 96 11 22 33','Cotonou',1,NULL,'2026-03-13 09:44:37','2026-03-13 09:44:37'),(21,'AssuriBénin','rh@assuribenin.bj','2026-03-13 09:44:37','$2y$12$Q5UdTBD9/EMyN0UKaA8HnuYPQjiqw07sTjW0iPsxgb0HpRE0QmXyu','entreprise','+229 21 31 55 00','Cotonou',1,NULL,'2026-03-13 09:44:37','2026-03-13 09:44:37'),(22,'FoodTech Bénin','jobs@foodtech.bj','2026-03-13 09:44:38','$2y$12$zRCagIE1fYR5Q3piKjApXOGDS4jBzFSirMfPtdqf.CdTLIQO1Zybi','entreprise','+229 97 99 88 77','Porto-Novo',1,NULL,'2026-03-13 09:44:38','2026-03-13 09:44:38'),(23,'EnergieSolaire BJ','recrutement@energiesolaire.bj','2026-03-13 09:44:38','$2y$12$k4AHl87YZw7bD47qAe349.RRALYIUtDnrLP3kL3SrcL.h/ZHE.exu','entreprise','+229 96 55 44 33','Parakou',1,NULL,'2026-03-13 09:44:38','2026-03-13 09:44:38'),(24,'MicroFinance Alafia','rh@alafia.bj','2026-03-13 09:44:38','$2y$12$2xK3U.DdS014Y1H5QRoEheNae.i6o3byVa2p3uOvnZn7z6zn3f1oy','entreprise','+229 21 32 20 00','Abomey-Calavi',1,NULL,'2026-03-13 09:44:38','2026-03-13 09:44:38'),(25,'Jean-Baptiste AKPLOGAN','jb.akplogan@gmail.com','2026-03-13 09:44:38','$2y$12$1Fn7raAJYdO.vMclyJHj0OLEJ0M./lzeH1Epsv9ptvKqQit.5DeK6','candidat','+229 96 12 34 56','Cotonou',1,NULL,'2026-03-13 09:44:38','2026-03-13 09:44:38'),(26,'Marie DOSSOU','marie.dossou@yahoo.fr','2026-03-13 09:44:38','$2y$12$2bc0XldjnU8ecFBA02QHbuQ5A725kWmBwYJ9n27x1yhoTpxHC2BS2','candidat','+229 97 88 99 00','Porto-Novo',1,NULL,'2026-03-13 09:44:38','2026-03-13 09:44:38'),(27,'Rodrigue KPOGNON','r.kpognon@student.uac.bj','2026-03-13 09:44:39','$2y$12$PJeWIXVplFy3eEfkg5CXVeTjhdL6OkYs15Kb8/wt1noJPi4bbQMmq','candidat','+229 94 56 78 90','Abomey-Calavi',1,NULL,'2026-03-13 09:44:39','2026-03-13 09:44:39'),(28,'Fidèle AHOUANSOU','fidele.ahouansou@gmail.com','2026-03-13 09:44:39','$2y$12$0IwheGerI9zbReuBF9Q.f.jSzrNq8YNlJ8emzDEQVaeROU/f7Y/J.','candidat','+229 96 23 45 67','Cotonou',1,NULL,'2026-03-13 09:44:39','2026-03-13 09:44:39'),(29,'Raïssa GBAGUIDI','raissa.gbaguidi@gmail.com','2026-03-13 09:44:39','$2y$12$BUX0b9Idp/EiZ7pN4WNbGO26dJyAFyQb8pGNuzC/PttLCrNWlvUtO','candidat','+229 97 34 56 78','Cotonou',1,NULL,'2026-03-13 09:44:39','2026-03-13 09:44:39'),(30,'Arnaud HOUNKPONOU','arnaud.hounkponou@gmail.com','2026-03-13 09:44:39','$2y$12$Oyf7003km1qmkPaY1IK7Lesb1cVsvGfyT1uoP0ya0GsqsCKOQA49e','candidat','+229 96 45 67 89','Parakou',1,NULL,'2026-03-13 09:44:39','2026-03-13 09:44:39'),(31,'Christelle AGOSSA','christelle.agossa@gmail.com','2026-03-13 09:44:40','$2y$12$vYrr7CdG2uXv4AVde7YlKuNFzgF9ixA1KNgjaUh0PHtO0hrZGDX3K','candidat','+229 97 56 78 90','Cotonou',1,NULL,'2026-03-13 09:44:40','2026-03-13 09:44:40'),(32,'Wilfried AZONDEKON','wilfried.azondekon@gmail.com','2026-03-13 09:44:40','$2y$12$gzr3SSNulsqZOC51OOwMsuYepv/8ziqskFHOMSchX5XwhL8hyKZRO','candidat','+229 94 67 89 01','Abomey-Calavi',1,NULL,'2026-03-13 09:44:40','2026-03-13 09:44:40'),(33,'Sandrine TOKPO','sandrine.tokpo@yahoo.fr','2026-03-13 09:44:40','$2y$12$GcsmL8C5OX503aIM5gHz.Og3gBODiThfNPI4bcqhs9MUvslX4q6Zu','candidat','+229 96 78 90 12','Cotonou',1,NULL,'2026-03-13 09:44:40','2026-03-13 09:44:40'),(34,'Cyrille ADANWENON','cyrille.adanwenon@gmail.com','2026-03-13 09:44:40','$2y$12$Xx.jTayDcvUKwkxknpcH8.IJBGiBTutMhWEY4hpdh5CtEGV./CRFm','candidat','+229 97 89 01 23','Porto-Novo',1,NULL,'2026-03-13 09:44:40','2026-03-13 09:44:40'),(35,'Nadège HOUNSA','nadege.hounsa@gmail.com','2026-03-13 09:44:40','$2y$12$ekBfREefChZDU4KFu2IEtu2/7.oa3KyYfoe4noBbLUegYGCWtlZ5S','candidat','+229 96 90 12 34','Cotonou',1,NULL,'2026-03-13 09:44:40','2026-03-13 09:44:40'),(36,'Brice OSSE','brice.osse@gmail.com','2026-03-13 09:44:41','$2y$12$wA3m9tRubRWuyV/f0rg9uOHqnzFFpIC7zi4aOk.alAkPpGAuu5doy','candidat','+229 94 01 23 45','Cotonou',1,NULL,'2026-03-13 09:44:41','2026-03-13 09:44:41'),(37,'Vanessa ADOMOU','vanessa.adomou@gmail.com','2026-03-13 09:44:41','$2y$12$vyiFw5Ill1JUF/MyxD/uTeemGh167iO4mI8FV0yFwgt90rZx0H6M2','candidat','+229 97 12 34 56','Abomey-Calavi',1,NULL,'2026-03-13 09:44:41','2026-03-13 09:44:41'),(38,'Franck HOUNSOU','franck.hounsou@gmail.com','2026-03-13 09:44:41','$2y$12$UKZYj9mZRjCVghtO6Ho6wuW4a6Estm8xkYTdb5j3./yRx1tGMCnYi','candidat','+229 96 23 45 67','Parakou',1,NULL,'2026-03-13 09:44:41','2026-03-13 09:44:41'),(39,'Pélagie LOKO','pelagie.loko@gmail.com','2026-03-13 09:44:41','$2y$12$DRL7Iv662NeGJwA35IZS9OkA9QdvURBSrkJAt0SrGn/rhpaQKBJ46','candidat','+229 97 34 56 78','Cotonou',1,NULL,'2026-03-13 09:44:41','2026-03-13 09:44:41'),(40,'Roméo GNIMADI','romeo.gnimadi@gmail.com','2026-03-13 09:44:42','$2y$12$EEMUFL96XuS8xi.OeQKBqeCqVMuTeQtS/XORqnhRZMbBL56z0Ckb6','candidat','+229 94 45 67 89','Cotonou',1,NULL,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(41,'Aurélie ASSOGBA','aurelie.assogba@gmail.com','2026-03-13 09:44:42','$2y$12$sVnYfvkpoP/mZfu.bRFXU.qbRtisuxZfwZnbere3WsN5avm08JSXy','candidat','+229 96 56 78 90','Porto-Novo',1,NULL,'2026-03-13 09:44:42','2026-03-13 09:44:42'),(42,'Maxime VODOUNON','maxime.vodounon@gmail.com','2026-03-13 09:44:42','$2y$12$Qmuqdb3h9WUX/ZHQq0e02eAC5NWa9X0wQmGQY63rUYqy9Yg..c3y2','candidat','+229 97 67 89 01','Cotonou',1,NULL,'2026-03-13 09:44:42','2026-03-13 09:44:42');
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

-- Dump completed on 2026-03-13 11:48:38
