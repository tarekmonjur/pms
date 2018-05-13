-- MySQL dump 10.15  Distrib 10.0.34-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: pms
-- ------------------------------------------------------
-- Server version	10.0.34-MariaDB-0ubuntu0.16.04.1

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
-- Table structure for table `accesses`
--

DROP TABLE IF EXISTS `accesses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accesses` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_type` int(10) unsigned DEFAULT '0',
  `project_id` int(10) unsigned DEFAULT '0',
  `story_id` int(10) unsigned DEFAULT '0',
  `task_id` int(11) unsigned DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesses`
--

LOCK TABLES `accesses` WRITE;
/*!40000 ALTER TABLE `accesses` DISABLE KEYS */;
INSERT INTO `accesses` VALUES (1,1,9,0,0),(4,4,9,0,0),(5,4,9,0,0),(3,2,10,0,0),(2,3,10,0,0),(1,1,11,0,0),(4,4,11,0,0),(5,4,11,0,0),(5,4,11,1,0),(4,4,11,1,0),(5,4,11,1,1),(5,4,11,1,1),(4,4,11,1,1),(5,4,11,1,1),(5,4,11,1,1),(4,4,11,1,1),(1,1,11,2,0),(5,4,11,2,0),(1,1,11,2,2),(1,1,11,2,2),(5,4,11,2,2),(5,4,11,1,0),(4,4,11,1,0),(1,1,11,0,0),(4,4,11,0,0),(5,4,11,0,0),(5,4,11,1,1),(5,4,11,1,1),(4,4,11,1,1),(1,1,11,2,2),(1,1,11,2,2),(5,4,11,2,2),(1,1,11,3,0),(1,1,11,0,0),(4,4,11,0,0),(5,4,11,0,0),(1,1,11,3,0),(4,4,11,3,0),(5,4,11,3,0),(5,4,11,1,0),(4,4,11,1,0),(1,1,11,3,3),(1,1,11,3,3),(4,4,11,3,3),(1,1,11,3,3),(1,1,11,3,3),(4,4,11,3,3),(1,1,11,3,4),(1,1,11,3,4),(5,4,11,3,4);
/*!40000 ALTER TABLE `accesses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activities` (
  `user_id` int(10) unsigned NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `story_id` int(10) unsigned NOT NULL,
  `task_id` int(10) unsigned NOT NULL,
  `activity` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities`
--

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
INSERT INTO `activities` VALUES (1,9,0,0,'<a><strong>Tarek Monjur</strong></a> created <strong>Stock Manage Inventory System</strong> project.','2018-05-13 01:29:28'),(3,10,0,0,'<a><strong>Asif Ahammed</strong></a> created <strong>Digital Attendance Device with IOT</strong> project.','2018-05-13 01:42:43'),(1,11,0,0,'<a><strong>Tarek Monjur</strong></a> created <strong>Human Resource Management System</strong> project.','2018-05-13 01:49:02'),(5,11,1,0,'<a><strong>Asad Hossian</strong></a> created <strong>Personal Information Management</strong> story.','2018-05-13 02:26:57'),(5,11,1,1,'<a><strong>Asad Hossian</strong></a> created <strong>Employee Information manage</strong> task.','2018-05-13 02:32:23'),(5,11,1,1,'<a><strong>Asad Hossian</strong></a> updated <strong>Employee Information manage</strong> task.','2018-05-13 02:33:31'),(1,11,2,0,'<a><strong>Tarek Monjur</strong></a> created <strong>Attendance Management</strong> story.','2018-05-13 02:35:36'),(1,11,2,2,'<a><strong>Tarek Monjur</strong></a> created <strong>Attendance Timesheet Generate</strong> task.','2018-05-13 02:38:53'),(1,11,1,0,'<a><strong>Tarek Monjur</strong></a> updated <strong>Personal Information Management</strong> story.','2018-05-13 02:40:01'),(1,11,0,0,'<a><strong>Tarek Monjur</strong></a> updated <strong>Human Resource Management System</strong> project.','2018-05-13 02:41:07'),(1,11,1,1,'<a><strong>Tarek Monjur</strong></a> updated <strong>Employee Information manage</strong> task.','2018-05-13 02:42:09'),(5,11,2,2,'<a><strong>Asad Hossian</strong></a> updated <strong>Attendance Timesheet Generate</strong> task.','2018-05-13 02:44:09'),(1,11,3,0,'<a><strong>Tarek Monjur</strong></a> created <strong>PayRoll Management</strong> story.','2018-05-13 02:47:22'),(1,11,0,0,'<a><strong>Tarek Monjur</strong></a> updated <strong>Human Resource Management System</strong> project.','2018-05-13 02:49:53'),(1,11,3,0,'<a><strong>Tarek Monjur</strong></a> updated <strong>PayRoll Management</strong> story.','2018-05-13 02:50:33'),(1,11,1,0,'<a><strong>Tarek Monjur</strong></a> updated <strong>Personal Information Management</strong> story.','2018-05-13 02:50:49'),(1,11,3,3,'<a><strong>Tarek Monjur</strong></a> updated <strong>Salary Sheet Generate</strong> task.','2018-05-13 02:58:51'),(4,11,3,3,'<a><strong>Shahin Khan</strong></a> comments on <strong>Salary Sheet Generate</strong> task.','2018-05-13 02:59:48'),(1,11,3,4,'<a><strong>Tarek Monjur</strong></a> created <strong>Bonus and Increment Manage</strong> task.','2018-05-13 03:02:47'),(5,11,3,4,'<a><strong>Asad Hossian</strong></a> comments on <strong>Bonus and Increment Manage</strong> task.','2018-05-13 03:04:13'),(1,11,3,3,'<a><strong>Tarek Monjur</strong></a> comments on <strong>Salary Sheet Generate</strong> task.','2018-05-13 03:08:12');
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'IDDL','Gulshan','2018-05-12 01:08:12','2018-05-12 01:08:12'),(2,'RS Software','Rampura, Dhaka','2018-05-12 15:23:08','2018-05-12 15:23:08'),(3,'Pixel Mind','Badda, Dhaka','2018-05-12 15:23:40','2018-05-12 15:23:40'),(4,'NanoSoft','Badda, Dhaka','2018-05-12 15:24:02','2018-05-12 15:24:02'),(5,'Digitalistic','Bonani,Dhaka','2018-05-12 15:24:30','2018-05-12 15:24:30');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(10) unsigned NOT NULL,
  `department_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departments_company_id_foreign` (`company_id`),
  CONSTRAINT `departments_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,1,'Software Department','2018-05-12 01:08:13','2018-05-12 17:37:24'),(2,2,'Web Development','2018-05-12 17:36:56','2018-05-12 17:36:56'),(3,5,'Digital Merketing','2018-05-12 17:38:06','2018-05-12 17:38:06'),(4,4,'Network Department','2018-05-12 17:38:35','2018-05-12 17:38:35'),(5,3,'Hardwork Department','2018-05-12 17:38:59','2018-05-12 17:38:59'),(6,3,'Network Department','2018-05-12 18:34:21','2018-05-12 18:34:21');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL DEFAULT '0',
  `story_id` int(11) NOT NULL DEFAULT '0',
  `task_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` VALUES (1,'Project-Demo.jpeg',10,0,0,'2018-05-13 01:44:08','2018-05-13 01:44:08'),(2,'Project-SRS.pdf',11,0,0,'2018-05-13 02:05:46','2018-05-13 02:05:46'),(3,'Feature-Document.png',11,1,0,'2018-05-13 02:28:43','2018-05-13 02:28:43'),(4,'Attendance.png',11,2,0,'2018-05-13 02:36:54','2018-05-13 02:36:54'),(5,'PaySlip-Demo.jpeg',11,3,0,'2018-05-13 02:52:34','2018-05-13 02:52:34'),(6,'PayRoll-SRS.pdf',11,3,0,'2018-05-13 02:53:15','2018-05-13 02:53:15'),(7,'payslip-client-demo.png',11,3,3,'2018-05-13 03:07:28','2018-05-13 03:07:28');
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2017_11_16_113012_create_projects_table',1),(4,'2017_11_16_113425_create_tasks_table',1),(5,'2017_11_16_113835_create_task_comments_table',1),(6,'2017_11_22_074752_create_comapnies_table',1),(7,'2017_11_22_075038_create_departments_table',1),(8,'2017_11_23_085520_create_stories_table',1),(9,'2017_11_23_105423_add_relations_all_table',1),(10,'2017_12_03_111621_create_activities_table',1),(11,'2017_12_04_084458_create_teams_table',1),(12,'2017_12_04_084633_create_team_members_table',1),(13,'2017_12_14_055640_create_table_role_permissions',1),(14,'2017_12_18_105913_create_documents_table',1),(15,'2018_01_09_104002_create_task_works_table',1),(16,'2018_05_11_193045_create_accesses_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('tarekmonjur@gmail.com','$2y$10$MLrfZYokK/SR.caA4SCTJevk7FxxosGkwgRy3LrAxiMeXmm65wUl6','2018-05-12 16:29:25');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_team` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_start_date` date DEFAULT NULL,
  `project_end_date` date DEFAULT NULL,
  `project_status` enum('initiate','pending','progress','done') COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_details` text COLLATE utf8mb4_unicode_ci,
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (9,'Stock Manage Inventory System','2','2018-05-01','2018-07-31','initiate','Inventory management software is a software system for tracking inventory levels, orders, sales and deliveries. It can also be used in the manufacturing industry to create a work order, bill of materials and other production-related documents',1,0,'2018-05-13 01:29:28','2018-05-13 01:29:28'),(10,'Digital Attendance Device with IOT','1','2018-05-20','2018-06-30','initiate','The word ‘Digital System’ refers to the collection of discrete values. Currently, digital attendance system is being used because the digital information is easy to process and far easy to access as compared to manual data. Growing technology and contemporary science has given birth to various digital attendance systems that also play a major role in production and development for an organization.',3,0,'2018-05-13 01:42:43','2018-05-13 01:42:43'),(11,'Human Resource Management System','2','2018-05-01','2018-10-01','initiate','A HRMS (Human Resource Management System) is a combination of systems and processes that connect human resource management and information technology through HR software. A HRMS may help to revolutionize a workplace.',1,1,'2018-05-13 01:49:02','2018-05-13 02:49:53');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_permissions`
--

DROP TABLE IF EXISTS `role_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_permission` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_permissions`
--

LOCK TABLES `role_permissions` WRITE;
/*!40000 ALTER TABLE `role_permissions` DISABLE KEYS */;
INSERT INTO `role_permissions` VALUES (1,'Admin','Admin role permission','a:32:{i:0;s:8:\"projects\";i:1;s:15:\"projects/create\";i:2;s:13:\"projects/edit\";i:3;s:15:\"projects/delete\";i:4;s:16:\"projects/stories\";i:5;s:14:\"stories/create\";i:6;s:12:\"stories/edit\";i:7;s:14:\"stories/delete\";i:8;s:13:\"stories/tasks\";i:9;s:12:\"tasks/create\";i:10;s:10:\"tasks/edit\";i:11;s:12:\"tasks/delete\";i:12;s:5:\"users\";i:13;s:12:\"users/create\";i:14;s:10:\"users/edit\";i:15;s:12:\"users/delete\";i:16;s:5:\"roles\";i:17;s:12:\"roles/create\";i:18;s:10:\"roles/edit\";i:19;s:12:\"roles/delete\";i:20;s:5:\"teams\";i:21;s:12:\"teams/create\";i:22;s:10:\"teams/edit\";i:23;s:12:\"teams/delete\";i:24;s:7:\"company\";i:25;s:14:\"company/create\";i:26;s:12:\"company/edit\";i:27;s:14:\"company/delete\";i:28;s:10:\"department\";i:29;s:17:\"department/create\";i:30;s:15:\"department/edit\";i:31;s:17:\"department/delete\";}',0,0,'2018-05-12 01:08:13','2018-05-12 17:57:55'),(2,'Manager','This role permission for project manager','a:32:{i:0;s:8:\"projects\";i:1;s:15:\"projects/create\";i:2;s:13:\"projects/edit\";i:3;s:15:\"projects/delete\";i:4;s:16:\"projects/stories\";i:5;s:14:\"stories/create\";i:6;s:12:\"stories/edit\";i:7;s:14:\"stories/delete\";i:8;s:13:\"stories/tasks\";i:9;s:12:\"tasks/create\";i:10;s:10:\"tasks/edit\";i:11;s:12:\"tasks/delete\";i:12;s:5:\"users\";i:13;s:12:\"users/create\";i:14;s:10:\"users/edit\";i:15;s:12:\"users/delete\";i:16;s:5:\"roles\";i:17;s:12:\"roles/create\";i:18;s:10:\"roles/edit\";i:19;s:12:\"roles/delete\";i:20;s:5:\"teams\";i:21;s:12:\"teams/create\";i:22;s:10:\"teams/edit\";i:23;s:12:\"teams/delete\";i:24;s:7:\"company\";i:25;s:14:\"company/create\";i:26;s:12:\"company/edit\";i:27;s:14:\"company/delete\";i:28;s:10:\"department\";i:29;s:17:\"department/create\";i:30;s:15:\"department/edit\";i:31;s:17:\"department/delete\";}',0,0,'2018-05-12 17:55:51','2018-05-12 17:55:51'),(3,'Team Leader','This role permission for project team lead','a:16:{i:0;s:16:\"projects/stories\";i:1;s:14:\"stories/create\";i:2;s:12:\"stories/edit\";i:3;s:14:\"stories/delete\";i:4;s:13:\"stories/tasks\";i:5;s:12:\"tasks/create\";i:6;s:10:\"tasks/edit\";i:7;s:12:\"tasks/delete\";i:8;s:5:\"users\";i:9;s:12:\"users/create\";i:10;s:10:\"users/edit\";i:11;s:12:\"users/delete\";i:12;s:5:\"teams\";i:13;s:12:\"teams/create\";i:14;s:10:\"teams/edit\";i:15;s:12:\"teams/delete\";}',0,0,'2018-05-12 17:57:33','2018-05-13 01:37:45'),(4,'Employee','This role permission for all project worker','a:6:{i:0;s:16:\"projects/stories\";i:1;s:14:\"stories/create\";i:2;s:12:\"stories/edit\";i:3;s:13:\"stories/tasks\";i:4;s:12:\"tasks/create\";i:5;s:10:\"tasks/edit\";}',0,0,'2018-05-12 17:59:03','2018-05-13 01:31:31');
/*!40000 ALTER TABLE `role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stories`
--

DROP TABLE IF EXISTS `stories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL,
  `story_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `story_member` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `story_status` enum('pending','progress','postponed','done') COLLATE utf8mb4_unicode_ci NOT NULL,
  `story_details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stories_project_id_foreign` (`project_id`),
  CONSTRAINT `stories_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stories`
--

LOCK TABLES `stories` WRITE;
/*!40000 ALTER TABLE `stories` DISABLE KEYS */;
INSERT INTO `stories` VALUES (1,11,'Personal Information Management','4','pending','This core module  maintains  all relevant  employee related  information',5,1,'2018-05-13 02:26:57','2018-05-13 02:50:49'),(2,11,'Attendance Management','5','pending','Follow the project SRS',1,0,'2018-05-13 02:35:36','2018-05-13 02:35:36'),(3,11,'PayRoll Management','1,4,5','pending','Payroll with Salary Process and Report',1,1,'2018-05-13 02:47:22','2018-05-13 02:50:33');
/*!40000 ALTER TABLE `stories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_comments`
--

DROP TABLE IF EXISTS `task_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `task_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `attach` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `task_comments_task_id_foreign` (`task_id`),
  KEY `task_comments_user_id_foreign` (`user_id`),
  CONSTRAINT `task_comments_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `task_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_comments`
--

LOCK TABLES `task_comments` WRITE;
/*!40000 ALTER TABLE `task_comments` DISABLE KEYS */;
INSERT INTO `task_comments` VALUES (1,3,4,'I am started salary sheet generate work',NULL,'2018-05-13 02:59:48','2018-05-13 02:59:48'),(2,4,5,'Hi dear, I am started this task',NULL,'2018-05-13 03:04:13','2018-05-13 03:04:13'),(3,3,1,'okey, carry on',NULL,'2018-05-13 03:08:12','2018-05-13 03:08:12');
/*!40000 ALTER TABLE `task_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_works`
--

DROP TABLE IF EXISTS `task_works`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_works` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `task_id` int(10) unsigned NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime DEFAULT NULL,
  `total_time` double(5,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_works`
--

LOCK TABLES `task_works` WRITE;
/*!40000 ALTER TABLE `task_works` DISABLE KEYS */;
INSERT INTO `task_works` VALUES (1,3,'2018-05-13 08:59:17','2018-05-13 10:20:01',1.20,'2018-05-13 02:59:17','2018-05-13 04:20:01'),(2,4,'2018-05-13 09:03:34','2018-05-13 10:21:51',1.18,'2018-05-13 03:03:34','2018-05-13 04:21:51'),(3,4,'2018-05-13 10:24:56','2018-05-13 10:32:32',0.70,'2018-05-13 04:24:56','2018-05-13 04:32:32'),(4,3,'2018-05-13 10:31:45',NULL,0.00,'2018-05-13 04:31:45','2018-05-13 04:31:45'),(5,4,'2018-05-13 10:34:02',NULL,0.00,'2018-05-13 04:34:02','2018-05-13 04:34:02');
/*!40000 ALTER TABLE `task_works` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL,
  `story_id` int(10) unsigned NOT NULL,
  `task_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_type` enum('task','bug','issue') COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_start_date` date DEFAULT NULL,
  `task_end_date` date DEFAULT NULL,
  `task_work_hour` double(5,2) DEFAULT NULL,
  `task_details` text COLLATE utf8mb4_unicode_ci,
  `task_status` enum('pending','progress','paused','postponed','done') COLLATE utf8mb4_unicode_ci NOT NULL,
  `assign_by` int(10) unsigned NOT NULL DEFAULT '0',
  `assign_to` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tasks_project_id_foreign` (`project_id`),
  KEY `tasks_story_id_foreign` (`story_id`),
  CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  CONSTRAINT `tasks_story_id_foreign` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (1,11,1,'Employee Information manage','task','2018-05-15','2018-05-30',90.00,'Follow the document','pending',5,4,5,1,'2018-05-13 02:32:23','2018-05-13 02:42:09'),(2,11,2,'Attendance Timesheet Generate','task','2018-05-15','2018-06-25',100.00,'Please follow the project SRS guide and instruction','pending',1,5,1,5,'2018-05-13 02:38:53','2018-05-13 02:44:09'),(3,11,3,'Salary Sheet Generate','task','2018-05-05','2018-05-10',20.00,'Follow the document','progress',1,4,1,1,'2018-05-13 02:55:55','2018-05-13 04:31:45'),(4,11,3,'Bonus and Increment Manage','task','2018-05-10','2018-05-15',40.00,'Please follow the SRS document','progress',1,5,1,0,'2018-05-13 03:02:47','2018-05-13 04:34:02');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_members`
--

DROP TABLE IF EXISTS `team_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team_members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `team_id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `team_members_team_id_foreign` (`team_id`),
  CONSTRAINT `team_members_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_members`
--

LOCK TABLES `team_members` WRITE;
/*!40000 ALTER TABLE `team_members` DISABLE KEYS */;
INSERT INTO `team_members` VALUES (1,1,3,1,0,'2018-05-12 18:35:21','2018-05-12 18:35:21'),(2,1,2,1,0,'2018-05-12 18:35:21','2018-05-12 18:35:21'),(3,2,1,1,0,'2018-05-12 18:37:47','2018-05-12 18:37:47'),(4,2,5,1,0,'2018-05-12 18:37:47','2018-05-12 18:37:47'),(5,2,4,1,0,'2018-05-12 18:37:47','2018-05-12 18:37:47');
/*!40000 ALTER TABLE `team_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `team_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_details` text COLLATE utf8mb4_unicode_ci,
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (1,'Team no 0001',NULL,1,0,'2018-05-12 18:35:21','2018-05-12 18:35:21'),(2,'Team no 0002',NULL,1,0,'2018-05-12 18:37:47','2018-05-12 18:37:47');
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` int(10) unsigned NOT NULL,
  `designation` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` int(11) NOT NULL DEFAULT '0',
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_department_id_foreign` (`department_id`),
  CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Tarek','Monjur','tarekmonjur@gmail.com','$2y$10$xI1eRlafOo7RNlahLdLofOzQpWdiSHZPoyvfUBDhDM67d6fLq71rK','lUkwLDHW1itxmRZQxIyKtPH3r4rxf3nqmaQiMBfoPzUNtCd9NoPt5wqKb7ml',1,'software engineer','01832308565',1,'1526166833.jpeg','active',NULL,0,0,'2018-05-12 01:08:13','2018-05-12 17:13:53'),(2,'Mathub','Kamal','mathub@gmail.com','$2y$10$J2lEQLjNedkoGQhZ6mCBz.PRdKwmFUXSnvFxDHMmCwmIdH6ujfVWO',NULL,5,'Hardware Engineer','01816782983',3,NULL,NULL,NULL,0,0,'2018-05-12 18:15:21','2018-05-12 18:15:21'),(3,'Asif','Ahammed','asif@gmail.com','$2y$10$neNO9J3CKtHlZ.mmOrYlAeLpxicoURFeaI1BIjedqiuGW9viXKjPq','G91y2HzdXcmxgc5HK1AJ3K7tedXWihRke2FM4m6I86YOJRKsqAfqygeuZxjU',6,'Network Engineer','01718937654',2,NULL,NULL,NULL,0,0,'2018-05-12 18:17:17','2018-05-12 18:34:38'),(4,'Shahin','Khan','shahin@gmail.com','$2y$10$IGfkHL8qu8Uufh4KIozqZeuPSBcwzPrLIXCBu3huXItBDx.yFEStK','jBBJaFAqvHIeUZnGu9P4qNZiVwMkLQ4i63I7pIbcBSt5QyTLEKMxKqIFEN3K',1,'Software Engineer','01628928735',4,NULL,NULL,NULL,0,0,'2018-05-12 18:19:27','2018-05-12 18:24:20'),(5,'Asad','Hossian','asad@gmail.com','$2y$10$COnQzgEoH40To.GeEOcYyOFBcG9VJrn26K5DeKTcdYb4vJAIlPeFy','YhOmO2gcnH4CTPkMof0XFpJvVWIyjLox88989FDq4OuNzOlpC9OJvRG03wgQ',1,'Programmer','01719383736',4,NULL,NULL,NULL,0,0,'2018-05-12 18:21:08','2018-05-12 18:21:08');
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

-- Dump completed on 2018-05-13 17:44:55
