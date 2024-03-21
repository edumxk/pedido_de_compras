-- MySQL dump 10.13  Distrib 8.0.32, for Linux (x86_64)
--
-- Host: localhost    Database: compras
-- ------------------------------------------------------
-- Server version	8.0.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attachments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_extension` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_order_id` bigint unsigned DEFAULT NULL,
  `budget_id` bigint unsigned DEFAULT NULL,
  `interaction_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attachments_purchase_order_id_foreign` (`purchase_order_id`),
  KEY `attachments_budget_id_foreign` (`budget_id`),
  KEY `attachments_interaction_id_foreign` (`interaction_id`),
  CONSTRAINT `attachments_budget_id_foreign` FOREIGN KEY (`budget_id`) REFERENCES `budgets` (`id`),
  CONSTRAINT `attachments_interaction_id_foreign` FOREIGN KEY (`interaction_id`) REFERENCES `interactions` (`id`),
  CONSTRAINT `attachments_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachments`
--

LOCK TABLES `attachments` WRITE;
/*!40000 ALTER TABLE `attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `budgets`
--

DROP TABLE IF EXISTS `budgets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `budgets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `user_id` bigint unsigned NOT NULL,
  `purchase_order_id` bigint unsigned NOT NULL,
  `supplier_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `budgets_user_id_foreign` (`user_id`),
  KEY `budgets_purchase_order_id_foreign` (`purchase_order_id`),
  KEY `budgets_supplier_id_foreign` (`supplier_id`),
  CONSTRAINT `budgets_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`),
  CONSTRAINT `budgets_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`),
  CONSTRAINT `budgets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `budgets`
--

LOCK TABLES `budgets` WRITE;
/*!40000 ALTER TABLE `budgets` DISABLE KEYS */;
/*!40000 ALTER TABLE `budgets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Cabos',NULL,NULL),(2,'Canaletas',NULL,NULL),(3,'Conectores',NULL,NULL),(4,'Disjuntores',NULL,NULL),(5,'Eletrodutos',NULL,NULL),(6,'Fios',NULL,NULL),(7,'Fitas',NULL,NULL),(8,'Notebooks',NULL,NULL),(9,'Painéis',NULL,NULL),(10,'Pilhas',NULL,NULL),(11,'Placas',NULL,NULL),(12,'Eletronicos',NULL,NULL),(13,'Tomadas',NULL,NULL),(14,'Transformadores',NULL,NULL),(15,'Ventiladores',NULL,NULL),(16,'Motores Eletricos',NULL,NULL),(17,'Lampadas',NULL,NULL),(18,'Luminarias',NULL,NULL),(19,'Ferramentas',NULL,NULL),(20,'Eletrodomesticos',NULL,NULL),(21,'Eletroportateis',NULL,NULL),(22,'Papelaria',NULL,NULL),(23,'Materiais de Limpeza',NULL,NULL),(24,'Materiais de Escritorio',NULL,NULL),(25,'Materiais de Informatica',NULL,NULL),(26,'Som',NULL,NULL),(27,'Video',NULL,NULL),(28,'Educação',NULL,NULL),(29,'Marketing',NULL,NULL),(30,'Comunicação',NULL,NULL),(31,'Serviços',NULL,NULL),(32,'Outros',NULL,NULL),(33,'impedit','2024-03-12 10:36:50','2024-03-12 10:36:50'),(34,'enim','2024-03-12 10:36:50','2024-03-12 10:36:50'),(35,'quidem','2024-03-12 10:36:50','2024-03-12 10:36:50'),(36,'sunt','2024-03-12 10:36:50','2024-03-12 10:36:50'),(37,'sed','2024-03-12 10:36:50','2024-03-12 10:36:50'),(38,'numquam','2024-03-12 10:36:50','2024-03-12 10:36:50'),(39,'non','2024-03-12 10:36:50','2024-03-12 10:36:50'),(40,'nisi','2024-03-12 10:36:50','2024-03-12 10:36:50'),(41,'unde','2024-03-12 10:36:50','2024-03-12 10:36:50'),(42,'eum','2024-03-12 10:36:50','2024-03-12 10:36:50');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `call` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contacts_supplier_id_foreign` (`supplier_id`),
  CONSTRAINT `contacts_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'Gisselle Mueller','larkin.name@hotmail.com','(231) 642-7188','+1 (478) 535-2530',1,'2024-03-12 10:36:50','2024-03-12 10:36:50'),(2,'Boyd Kohler','jacynthe.jast@yahoo.com','+18322912739','(404) 302-1748',2,'2024-03-12 10:36:50','2024-03-12 10:36:50'),(3,'Brandt Rau','lempi.lind@macejkovic.info','307.566.5245','+1-740-571-8906',3,'2024-03-12 10:36:50','2024-03-12 10:36:50'),(4,'Thad Homenick','ankunding.margot@upton.org','(857) 840-8292','1-212-932-9679',4,'2024-03-12 10:36:50','2024-03-12 10:36:50'),(5,'Theresa Jaskolski','altenwerth.nathaniel@bechtelar.com','+1.561.356.4055','+1 (248) 456-0792',5,'2024-03-12 10:36:50','2024-03-12 10:36:50'),(6,'Ottilie Murray','guillermo.rowe@bins.com','681.407.6642','+17066201516',6,'2024-03-12 10:36:50','2024-03-12 10:36:50'),(7,'Antonio Hintz','ceffertz@grant.org','864-623-6456','+16232623584',7,'2024-03-12 10:36:50','2024-03-12 10:36:50'),(8,'Harrison Rice','oratke@yahoo.com','217-465-4122','+1-830-578-3197',8,'2024-03-12 10:36:50','2024-03-12 10:36:50'),(9,'Miss Freda Connelly MD','blanda.rosario@yahoo.com','1-551-713-8642','+1.469.702.1784',9,'2024-03-12 10:36:50','2024-03-12 10:36:50'),(10,'Tianna Legros','prosenbaum@gmail.com','951-997-3516','+1-989-588-0907',10,'2024-03-12 10:36:50','2024-03-12 10:36:50');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'Diretoria','Diretoria da empresa','2024-03-12 10:36:49',NULL),(2,'Financeiro','Setor financeiro da empresa','2024-03-12 10:36:49',NULL),(3,'RH','Setor de Recursos Humanos da empresa','2024-03-12 10:36:49',NULL),(4,'TI','Setor de Tecnologia da Informação da empresa','2024-03-12 10:36:49',NULL),(5,'Comercial','Setor Comercial da empresa','2024-03-12 10:36:49',NULL),(6,'Marketing','Setor de Marketing da empresa','2024-03-12 10:36:49',NULL),(7,'Produção','Setor de Produção da empresa','2024-03-12 10:36:49',NULL),(8,'Logística','Setor de Logística da empresa','2024-03-12 10:36:49',NULL),(9,'Manutenção','Setor de Manutenção da empresa','2024-03-12 10:36:49',NULL),(10,'WMS','Setor de WMS da empresa','2024-03-12 10:36:49',NULL),(11,'Limpeza','Setor de Limpeza da empresa','2024-03-12 10:36:49',NULL),(12,'Almoxarifado','Setor de Almoxarifado da empresa','2024-03-12 10:36:49',NULL),(13,'Compras','Setor de Compras da empresa','2024-03-12 10:36:49',NULL),(14,'Jurídico','Setor Jurídico da empresa','2024-03-12 10:36:49',NULL),(15,'Contabilidade','Setor de Contabilidade da empresa','2024-03-12 10:36:49',NULL),(16,'Fiscal','Setor Fiscal da empresa','2024-03-12 10:36:49',NULL),(17,'Contas a Pagar','Setor de Contas a Pagar da empresa','2024-03-12 10:36:49',NULL),(18,'Contas a Receber','Setor de Contas a Receber da empresa','2024-03-12 10:36:49',NULL),(19,'Faturamento','Setor de Faturamento da empresa','2024-03-12 10:36:49',NULL),(20,'PCP','Setor de Planejamento e Controle de Produção da empresa','2024-03-12 10:36:49',NULL),(21,'Qualidade','Setor de Controle de Qualidade da empresa','2024-03-12 10:36:49',NULL),(22,'Projetos','Setor de Projetos da empresa','2024-03-12 10:36:49',NULL),(23,'Suprimentos','Setor de Suprimentos da empresa','2024-03-12 10:36:49',NULL),(24,'P&D','Setor de Pesquisa e Desenvolvimento da empresa','2024-03-12 10:36:49',NULL),(25,'Comunicação','Setor de Comunicação da empresa','2024-03-12 10:36:49',NULL),(26,'Administração','Setor de Administração da empresa','2024-03-12 10:36:49',NULL);
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
-- Table structure for table `interactions`
--

DROP TABLE IF EXISTS `interactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `interactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `purchase_order_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `interactions_purchase_order_id_foreign` (`purchase_order_id`),
  KEY `interactions_user_id_foreign` (`user_id`),
  CONSTRAINT `interactions_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `interactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interactions`
--

LOCK TABLES `interactions` WRITE;
/*!40000 ALTER TABLE `interactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `interactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2024_01_10_195046_create_departments_table',1),(6,'2024_01_10_195047_create_purchase_orders_table',1),(7,'2024_01_11_195049_create_positions_table',1),(8,'2024_01_11_195050_update_users_table',1),(9,'2024_01_11_204904_create_suppliers_table',1),(10,'2024_01_11_204910_create_contacts_table',1),(11,'2024_01_11_205034_create_categories_table',1),(12,'2024_01_11_205101_create_products_table',1),(13,'2024_01_11_205235_create_budgets_table',1),(14,'2024_01_11_205236_create_payments_table',1),(15,'2024_01_12_140853_create_prices_suppliers_table',1),(16,'2024_01_12_155134_create_interactions_table',1),(17,'2024_01_13_140959_create_attachments_table',1),(18,'2024_01_30_161150_prices',1),(19,'2024_02_28_083401_create_provisions_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('debito','credito','boleto','pix','dinheiro','cheque','outros') COLLATE utf8mb4_unicode_ci NOT NULL,
  `installments` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `days` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `user_id` bigint unsigned NOT NULL,
  `budget_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_user_id_foreign` (`user_id`),
  KEY `payments_budget_id_foreign` (`budget_id`),
  CONSTRAINT `payments_budget_id_foreign` FOREIGN KEY (`budget_id`) REFERENCES `budgets` (`id`),
  CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `positions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `positions_department_id_foreign` (`department_id`),
  CONSTRAINT `positions_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `positions`
--

LOCK TABLES `positions` WRITE;
/*!40000 ALTER TABLE `positions` DISABLE KEYS */;
/*!40000 ALTER TABLE `positions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prices`
--

DROP TABLE IF EXISTS `prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `price` decimal(10,2) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `supplier_id` bigint unsigned NOT NULL,
  `budget_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prices_supplier_id_foreign` (`supplier_id`),
  KEY `prices_budget_id_foreign` (`budget_id`),
  KEY `prices_product_id_foreign` (`product_id`),
  CONSTRAINT `prices_budget_id_foreign` FOREIGN KEY (`budget_id`) REFERENCES `budgets` (`id`),
  CONSTRAINT `prices_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `prices_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prices`
--

LOCK TABLES `prices` WRITE;
/*!40000 ALTER TABLE `prices` DISABLE KEYS */;
/*!40000 ALTER TABLE `prices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prices_suppliers`
--

DROP TABLE IF EXISTS `prices_suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prices_suppliers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `budget_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prices_suppliers_supplier_id_foreign` (`supplier_id`),
  KEY `prices_suppliers_product_id_foreign` (`product_id`),
  KEY `prices_suppliers_budget_id_foreign` (`budget_id`),
  CONSTRAINT `prices_suppliers_budget_id_foreign` FOREIGN KEY (`budget_id`) REFERENCES `budgets` (`id`),
  CONSTRAINT `prices_suppliers_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `prices_suppliers_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prices_suppliers`
--

LOCK TABLES `prices_suppliers` WRITE;
/*!40000 ALTER TABLE `prices_suppliers` DISABLE KEYS */;
/*!40000 ALTER TABLE `prices_suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'rerum','ut','incidunt',33,'2024-03-12 10:36:50','2024-03-12 10:36:50'),(2,'autem','fuga','rem',34,'2024-03-12 10:36:50','2024-03-12 10:36:50'),(3,'corporis','nihil','facere',35,'2024-03-12 10:36:50','2024-03-12 10:36:50'),(4,'id','ut','quasi',36,'2024-03-12 10:36:50','2024-03-12 10:36:50'),(5,'iusto','sit','voluptate',37,'2024-03-12 10:36:50','2024-03-12 10:36:50'),(6,'ut','et','sed',38,'2024-03-12 10:36:50','2024-03-12 10:36:50'),(7,'animi','doloribus','autem',39,'2024-03-12 10:36:50','2024-03-12 10:36:50'),(8,'ipsam','et','explicabo',40,'2024-03-12 10:36:50','2024-03-12 10:36:50'),(9,'optio','voluptas','error',41,'2024-03-12 10:36:50','2024-03-12 10:36:50'),(10,'nihil','blanditiis','est',42,'2024-03-12 10:36:50','2024-03-12 10:36:50');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provisions`
--

DROP TABLE IF EXISTS `provisions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `provisions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','finished','canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `purchase_order_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `interaction_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `provisions_purchase_order_id_foreign` (`purchase_order_id`),
  KEY `provisions_user_id_foreign` (`user_id`),
  KEY `provisions_interaction_id_foreign` (`interaction_id`),
  CONSTRAINT `provisions_interaction_id_foreign` FOREIGN KEY (`interaction_id`) REFERENCES `interactions` (`id`),
  CONSTRAINT `provisions_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`),
  CONSTRAINT `provisions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provisions`
--

LOCK TABLES `provisions` WRITE;
/*!40000 ALTER TABLE `provisions` DISABLE KEYS */;
/*!40000 ALTER TABLE `provisions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_orders`
--

DROP TABLE IF EXISTS `purchase_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchase_orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `purchase_subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('opened','budget','rejected','approved','provision','purchase','received','finished') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'opened',
  `user_id` bigint unsigned NOT NULL,
  `department_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_orders_user_id_foreign` (`user_id`),
  KEY `purchase_orders_department_id_foreign` (`department_id`),
  CONSTRAINT `purchase_orders_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  CONSTRAINT `purchase_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_orders`
--

LOCK TABLES `purchase_orders` WRITE;
/*!40000 ALTER TABLE `purchase_orders` DISABLE KEYS */;
INSERT INTO `purchase_orders` VALUES (1,'Compra de AC - Financeiro','Necessidade de substituição do AC da sala do financeiro. \r\nTécnico identificou que o equipamento esta com vazamento de gás, provavelmente na serpentina. O reparo não tem garantia, e custa R$ 450,00.\r\nO equipamento já possui mais de 8 anos de uso.','opened',6,2,'2024-03-12 10:57:49','2024-03-12 10:57:49');
/*!40000 ALTER TABLE `purchase_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `suppliers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fantasy_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnpj` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` VALUES (1,'Zieme-Kovacek','Grimes, Reichert and Deckow','94138242575507','3067 Gleason Fields Suite 923\nMurrayborough, GA 34404-2572','2024-03-12 10:36:50','2024-03-12 10:36:50'),(2,'Senger, Stracke and Torphy','Crona-Blanda','00230512093848','7105 Kilback Flat\nTreutelchester, LA 68283','2024-03-12 10:36:50','2024-03-12 10:36:50'),(3,'Nienow, Ward and Fisher','Hilpert-Koelpin','74600747830163','5003 Cole Road Suite 285\nLabadiechester, CO 16260-8700','2024-03-12 10:36:50','2024-03-12 10:36:50'),(4,'Treutel LLC','Klein-Nolan','60516054852183','18249 Kyra Ranch Apt. 245\nFeestside, NY 83314','2024-03-12 10:36:50','2024-03-12 10:36:50'),(5,'Nikolaus-Bins','Beer, Hettinger and Bogisich','49177102063391','671 Enrico Locks\nKeeganburgh, CA 57219-7932','2024-03-12 10:36:50','2024-03-12 10:36:50'),(6,'Mayert, Prosacco and Hane','Nader, Abshire and Mraz','55847412422380','47704 Boehm Place\nMarquardthaven, GA 00729-5255','2024-03-12 10:36:50','2024-03-12 10:36:50'),(7,'Schinner, Hoeger and Cruickshank','Olson, Fritsch and Schuster','47237774947116','52030 Eliseo Canyon Apt. 708\nLake Minnie, AZ 20223','2024-03-12 10:36:50','2024-03-12 10:36:50'),(8,'Bartell and Sons','DuBuque, Hamill and Dach','00447889564686','6295 Nikolaus Stream\nSouth Emilechester, AR 41521-9809','2024-03-12 10:36:50','2024-03-12 10:36:50'),(9,'Feest-Ledner','Macejkovic, Beer and Watsica','92273924634632','444 Berneice Skyway\nEdnafort, NJ 04081-1876','2024-03-12 10:36:50','2024-03-12 10:36:50'),(10,'Kautzer LLC','VonRueden, Hartmann and Koch','79691513137141','85651 Reta Prairie\nMagalifort, KY 53959-4418','2024-03-12 10:36:50','2024-03-12 10:36:50');
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_buyer` tinyint(1) NOT NULL DEFAULT '0',
  `is_financial` tinyint(1) NOT NULL DEFAULT '0',
  `position_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_position_id_foreign` (`position_id`),
  CONSTRAINT `users_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Eduardo Patrick','eduardo.cavalcante@kokar.com.br','2024-03-12 10:36:42','$2y$12$sG1nh2rS3LhHLWD5m3.IQekmzocmTbbbk/cv3eI/SMylYHTz5OrJO','1OR4iVxFLyM37rJ2GcvunS8q3NKztv5xeNVih5AR02NzK8L1F2lL2coYefui','2024-03-12 10:36:43','2024-03-12 10:36:43','Eduardo TI',1,1,0,0,NULL),(2,'Wanderlei Cichelero','wanderlei@kokar.com.br','2024-03-12 10:36:45','$2y$12$aYH3Aoryh/LbnDHkhCmu8eFVOJpoCss20RDCZtfBDVLKwsDp6D6aC','kD5fZ1x9x7','2024-03-12 10:36:45','2024-03-12 10:36:45','Wanderlei',1,1,0,0,NULL),(3,'Edson Alves','edson@kokar.com.br','2024-03-12 10:36:46','$2y$12$dzB4fiBCm5oVoW1wn.8yweAb4f7vHfR.pvb9nX5NSawfLts4sYdom','uja61hVyCq','2024-03-12 10:36:46','2024-03-12 10:36:46','Edson',1,1,0,0,NULL),(4,'Valéria Cardoso','valeria.cardoso@kokar.com.br','2024-03-12 10:36:48','$2y$12$mbjANvqIxL/H7JwH9qa8LOBe915vkw7iw15wRmWz3lRTIgjPgWFq.','6Syjei2wch','2024-03-12 10:36:48','2024-03-12 10:36:48','Valéria',0,1,0,1,NULL),(5,'Maria Aparecida','mariaaparecida.ribeiro@kokar.com.br','2024-03-12 10:36:49','$2y$12$3Etd.4CfW6XsNjFSSo3i4e66nJvHDvkd1UgzKSEIJK5.deUmkIg3m','h1OkZrefCH','2024-03-12 10:36:49','2024-03-12 10:36:49','Maria Aparecida',0,1,0,1,NULL),(6,'Rodrigo Luvielmo','rodrigo.luvielmo@kokar.com.br',NULL,'$2y$12$22wE5nr.8bKV0Km1Zvu1m.7WYoSEESI5cV1V64eH55.rrMFjgLjrC',NULL,'2024-03-12 10:53:04','2024-03-12 10:53:04','Rodrigo - DHO',0,1,0,0,NULL);
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

-- Dump completed on 2024-03-13 18:47:25
