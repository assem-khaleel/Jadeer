-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: 127.0.0.1    Database: jplus_migration
-- ------------------------------------------------------
-- Server version	5.6.27

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
-- Table structure for table `acc_independent_reviewer`
--

DROP TABLE IF EXISTS `acc_independent_reviewer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acc_independent_reviewer` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` enum('institution','program') NOT NULL,
  `type_id` bigint(20) NOT NULL,
  `reviewer_id` bigint(20) NOT NULL,
  `cv_attachment` varchar(255) NOT NULL,
  `report_attachment` varchar(255) DEFAULT NULL,
  `cv_text` text NOT NULL,
  `recommendations` text,
  `report_text` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_independent_reviewer`
--

LOCK TABLES `acc_independent_reviewer` WRITE;
/*!40000 ALTER TABLE `acc_independent_reviewer` DISABLE KEYS */;
/*!40000 ALTER TABLE `acc_independent_reviewer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acc_pre_visit_reviewer`
--

DROP TABLE IF EXISTS `acc_pre_visit_reviewer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acc_pre_visit_reviewer` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` enum('institution','program') DEFAULT NULL,
  `type_id` bigint(20) DEFAULT NULL,
  `reviewer_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_pre_visit_reviewer`
--

LOCK TABLES `acc_pre_visit_reviewer` WRITE;
/*!40000 ALTER TABLE `acc_pre_visit_reviewer` DISABLE KEYS */;
/*!40000 ALTER TABLE `acc_pre_visit_reviewer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acc_pre_visit_reviewer_action_plan`
--

DROP TABLE IF EXISTS `acc_pre_visit_reviewer_action_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acc_pre_visit_reviewer_action_plan` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `description` text,
  `due_date` date DEFAULT NULL,
  `responsible` int(11) DEFAULT NULL,
  `progress` int(11) DEFAULT NULL,
  `recommendation_id` bigint(20) NOT NULL,
  `date_added` date NOT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_pre_visit_reviewer_action_plan`
--

LOCK TABLES `acc_pre_visit_reviewer_action_plan` WRITE;
/*!40000 ALTER TABLE `acc_pre_visit_reviewer_action_plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `acc_pre_visit_reviewer_action_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acc_pre_visit_reviewer_recommendation`
--

DROP TABLE IF EXISTS `acc_pre_visit_reviewer_recommendation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acc_pre_visit_reviewer_recommendation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `visit_reviewer_id` bigint(20) NOT NULL,
  `recommendation` text,
  `type` enum('institution','program') NOT NULL,
  `type_id` bigint(20) NOT NULL,
  `reviewer_id` bigint(20) NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_pre_visit_reviewer_recommendation`
--

LOCK TABLES `acc_pre_visit_reviewer_recommendation` WRITE;
/*!40000 ALTER TABLE `acc_pre_visit_reviewer_recommendation` DISABLE KEYS */;
/*!40000 ALTER TABLE `acc_pre_visit_reviewer_recommendation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acc_status`
--

DROP TABLE IF EXISTS `acc_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acc_status` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `agency` varchar(256) NOT NULL,
  `program_id` bigint(20) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `status_date` date NOT NULL DEFAULT '0000-00-00',
  `note` text,
  `quitity_coordinator` int(11) DEFAULT '0',
  `program_chair` int(11) DEFAULT '0',
  `dean` int(11) DEFAULT '0',
  `year` int(11) DEFAULT '0',
  `attachment` varchar(255) DEFAULT NULL,
  `accredited` tinyint(4) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_status`
--

LOCK TABLES `acc_status` WRITE;
/*!40000 ALTER TABLE `acc_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `acc_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acc_visit_reviewer`
--

DROP TABLE IF EXISTS `acc_visit_reviewer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acc_visit_reviewer` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` enum('institution','program') DEFAULT NULL,
  `type_id` bigint(20) DEFAULT NULL,
  `reviewer_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_visit_reviewer`
--

LOCK TABLES `acc_visit_reviewer` WRITE;
/*!40000 ALTER TABLE `acc_visit_reviewer` DISABLE KEYS */;
/*!40000 ALTER TABLE `acc_visit_reviewer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acc_visit_reviewer_action_plan`
--

DROP TABLE IF EXISTS `acc_visit_reviewer_action_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acc_visit_reviewer_action_plan` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `description` text,
  `due_date` date DEFAULT NULL,
  `responsible` int(11) DEFAULT NULL,
  `progress` int(11) DEFAULT NULL,
  `recommendation_id` bigint(20) NOT NULL,
  `date_added` date NOT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_visit_reviewer_action_plan`
--

LOCK TABLES `acc_visit_reviewer_action_plan` WRITE;
/*!40000 ALTER TABLE `acc_visit_reviewer_action_plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `acc_visit_reviewer_action_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acc_visit_reviewer_recommendation`
--

DROP TABLE IF EXISTS `acc_visit_reviewer_recommendation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acc_visit_reviewer_recommendation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `visit_reviewer_id` bigint(20) NOT NULL,
  `recommendation` text,
  `type` enum('institution','program') NOT NULL,
  `type_id` bigint(20) NOT NULL,
  `reviewer_id` bigint(20) NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_visit_reviewer_recommendation`
--

LOCK TABLES `acc_visit_reviewer_recommendation` WRITE;
/*!40000 ALTER TABLE `acc_visit_reviewer_recommendation` DISABLE KEYS */;
/*!40000 ALTER TABLE `acc_visit_reviewer_recommendation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `al_action`
--

DROP TABLE IF EXISTS `al_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `al_action` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `assessment_loop_id` bigint(20) DEFAULT NULL,
  `action_en` text,
  `action_ar` text,
  `responsible_en` tinytext,
  `responsible_ar` tinytext,
  `time_frame_en` tinytext,
  `time_frame_ar` tinytext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `al_action`
--

LOCK TABLES `al_action` WRITE;
/*!40000 ALTER TABLE `al_action` DISABLE KEYS */;
/*!40000 ALTER TABLE `al_action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `al_analysis`
--

DROP TABLE IF EXISTS `al_analysis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `al_analysis` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `assessment_loop_id` bigint(20) DEFAULT NULL,
  `text_en` text,
  `text_ar` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `al_analysis`
--

LOCK TABLES `al_analysis` WRITE;
/*!40000 ALTER TABLE `al_analysis` DISABLE KEYS */;
/*!40000 ALTER TABLE `al_analysis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `al_assessment_loop`
--

DROP TABLE IF EXISTS `al_assessment_loop`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `al_assessment_loop` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `item_class` tinytext,
  `item_id` bigint(20) DEFAULT NULL,
  `item_type` int(2) DEFAULT NULL,
  `item_type_id` bigint(20) DEFAULT NULL,
  `semester_id` bigint(20) DEFAULT NULL,
  `extra_data` text,
  `user_id` bigint(20) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `al_assessment_loop`
--

LOCK TABLES `al_assessment_loop` WRITE;
/*!40000 ALTER TABLE `al_assessment_loop` DISABLE KEYS */;
/*!40000 ALTER TABLE `al_assessment_loop` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `al_custom`
--

DROP TABLE IF EXISTS `al_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `al_custom` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` tinytext,
  `attachment` varchar(100) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `al_custom`
--

LOCK TABLES `al_custom` WRITE;
/*!40000 ALTER TABLE `al_custom` DISABLE KEYS */;
/*!40000 ALTER TABLE `al_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `al_measure`
--

DROP TABLE IF EXISTS `al_measure`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `al_measure` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `assessment_loop_id` bigint(20) DEFAULT NULL,
  `text_en` text,
  `text_ar` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `al_measure`
--

LOCK TABLES `al_measure` WRITE;
/*!40000 ALTER TABLE `al_measure` DISABLE KEYS */;
/*!40000 ALTER TABLE `al_measure` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `al_recommendation`
--

DROP TABLE IF EXISTS `al_recommendation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `al_recommendation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `assessment_loop_id` bigint(20) DEFAULT NULL,
  `text_en` text,
  `text_ar` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `al_recommendation`
--

LOCK TABLES `al_recommendation` WRITE;
/*!40000 ALTER TABLE `al_recommendation` DISABLE KEYS */;
/*!40000 ALTER TABLE `al_recommendation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `al_result`
--

DROP TABLE IF EXISTS `al_result`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `al_result` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `assessment_loop_id` bigint(20) DEFAULT NULL,
  `text_en` text,
  `text_ar` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `al_result`
--

LOCK TABLES `al_result` WRITE;
/*!40000 ALTER TABLE `al_result` DISABLE KEYS */;
/*!40000 ALTER TABLE `al_result` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ams_log`
--

DROP TABLE IF EXISTS `ams_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ams_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_added` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `is_released` tinyint(1) NOT NULL DEFAULT '0',
  `date_released` datetime DEFAULT NULL,
  `comment` text,
  `forms` text,
  `type` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ams_log`
--

LOCK TABLES `ams_log` WRITE;
/*!40000 ALTER TABLE `ams_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `ams_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `as_agency`
--

DROP TABLE IF EXISTS `as_agency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `as_agency` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name_ar` varchar(125) NOT NULL,
  `name_en` varchar(125) NOT NULL,
  `accredited_years` int(11) NOT NULL DEFAULT '0',
  `notify_before` varchar(255) DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `as_agency`
--

LOCK TABLES `as_agency` WRITE;
/*!40000 ALTER TABLE `as_agency` DISABLE KEYS */;
INSERT INTO `as_agency` VALUES (1,'NCAAA','NCAAA',5,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'ABET','ABET',1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,'AACSB','AACSB',5,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,'ACPE','ACPE',3,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,'JCI','JCI',3,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,'ASIIN','ASIIN',1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `as_agency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `as_agency_mapping`
--

DROP TABLE IF EXISTS `as_agency_mapping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `as_agency_mapping` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `college_id` bigint(20) NOT NULL DEFAULT '0',
  `agency_id` bigint(20) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `agency_mapping_idx` (`college_id`,`agency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `as_agency_mapping`
--

LOCK TABLES `as_agency_mapping` WRITE;
/*!40000 ALTER TABLE `as_agency_mapping` DISABLE KEYS */;
/*!40000 ALTER TABLE `as_agency_mapping` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `as_status`
--

DROP TABLE IF EXISTS `as_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `as_status` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `agency` int(11) NOT NULL,
  `program_id` bigint(20) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `status_date` date NOT NULL DEFAULT '0000-00-00',
  `note` text,
  `quality_coordinator` int(11) DEFAULT '0',
  `program_chair` int(11) DEFAULT '0',
  `chair_name` varchar(255) DEFAULT NULL,
  `chair_phone` varchar(255) DEFAULT NULL,
  `chair_email` varchar(125) DEFAULT NULL,
  `dean` int(11) DEFAULT '0',
  `dean_name` varchar(255) DEFAULT NULL,
  `dean_email` varchar(255) DEFAULT NULL,
  `dean_phone` varchar(125) DEFAULT NULL,
  `year` int(11) DEFAULT '0',
  `attachment` varchar(255) DEFAULT NULL,
  `accredited` tinyint(4) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `as_status`
--

LOCK TABLES `as_status` WRITE;
/*!40000 ALTER TABLE `as_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `as_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backup`
--

DROP TABLE IF EXISTS `backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backup` (
  `id` bigint(20) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `params` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup`
--

LOCK TABLES `backup` WRITE;
/*!40000 ALTER TABLE `backup` DISABLE KEYS */;
/*!40000 ALTER TABLE `backup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campus`
--

DROP TABLE IF EXISTS `campus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campus` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `integration_id` bigint(20) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `name_en` varchar(255) NOT NULL DEFAULT '',
  `name_ar` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campus`
--

LOCK TABLES `campus` WRITE;
/*!40000 ALTER TABLE `campus` DISABLE KEYS */;
/*!40000 ALTER TABLE `campus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campus_college`
--

DROP TABLE IF EXISTS `campus_college`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campus_college` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `campus_id` bigint(20) NOT NULL DEFAULT '0',
  `college_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campus_college`
--

LOCK TABLES `campus_college` WRITE;
/*!40000 ALTER TABLE `campus_college` DISABLE KEYS */;
/*!40000 ALTER TABLE `campus_college` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ci_sessions`
--

LOCK TABLES `ci_sessions` WRITE;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
INSERT INTO `ci_sessions` VALUES ('hnml06e5vsujhatmq1pbnhmfi64p8v9m','127.0.0.1',1497100772,'__ci_last_regenerate|i:1497100353;user_id|s:1:\"1\";semester_id|i:0;');
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_active_data`
--

DROP TABLE IF EXISTS `cm_active_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_active_data` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `semester_id` bigint(20) NOT NULL,
  `type_id` bigint(20) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `is_archived` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_active_data`
--

LOCK TABLES `cm_active_data` WRITE;
/*!40000 ALTER TABLE `cm_active_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_active_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_assessment_component`
--

DROP TABLE IF EXISTS `cm_assessment_component`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_assessment_component` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `assessment_method_id` bigint(20) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_assessment_component`
--

LOCK TABLES `cm_assessment_component` WRITE;
/*!40000 ALTER TABLE `cm_assessment_component` DISABLE KEYS */;
INSERT INTO `cm_assessment_component` VALUES (1,1,'Essay Questions','أسئلة مقالية',0),(2,1,'Multiple Choice','اختيار من متعدد',0),(3,1,'Fill in the Blanks','إملأ الفراغات',0),(4,1,'Matching','التطابق',0),(5,2,'Frequency of Participation','عدد مرات المشاركة',0),(6,2,'Quality of Participation','نوعية المشاركة',0),(7,3,'Essay Questions','اسئلة مقالية',0),(8,3,'Multiple Choice','اختيار من متعدد',0),(9,3,'Fill in the Blanks','إملأ الفراغات',0),(10,3,'Matching','التطابق',0),(11,4,'Essay Questions','اسئلة مقالية',0),(12,4,'Multiple Choice','اختيار من متعدد',0),(13,4,'Fill in the Blanks','إملأ الفراغات',0),(14,4,'Matching','التطابق',0);
/*!40000 ALTER TABLE `cm_assessment_component` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_assessment_method`
--

DROP TABLE IF EXISTS `cm_assessment_method`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_assessment_method` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title_en` varchar(255) NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_assessment_method`
--

LOCK TABLES `cm_assessment_method` WRITE;
/*!40000 ALTER TABLE `cm_assessment_method` DISABLE KEYS */;
INSERT INTO `cm_assessment_method` VALUES (1,'Quiz','أمتحان قصير',0),(2,'Class Participation','المشاركة في الصف',0),(3,'Examination (Mid-Term)','امتحان منتصف الفترة',0),(4,'Examination (Final)','الامتحان النهائي',0);
/*!40000 ALTER TABLE `cm_assessment_method` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_course_assessment_method`
--

DROP TABLE IF EXISTS `cm_course_assessment_method`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_course_assessment_method` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) NOT NULL,
  `program_assessment_method_id` bigint(20) NOT NULL,
  `text_en` varchar(255) NOT NULL,
  `text_ar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cm_course_assessment_method_course_id_index` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_course_assessment_method`
--

LOCK TABLES `cm_course_assessment_method` WRITE;
/*!40000 ALTER TABLE `cm_course_assessment_method` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_course_assessment_method` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_course_assessment_method_log`
--

DROP TABLE IF EXISTS `cm_course_assessment_method_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_course_assessment_method_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `semester_id` bigint(20) NOT NULL,
  `log_id` bigint(20) NOT NULL,
  `log_course_id` bigint(20) NOT NULL,
  `log_program_assessment_method_id` bigint(20) NOT NULL,
  `log_text_en` varchar(255) NOT NULL,
  `log_text_ar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_course_assessment_method_log`
--

LOCK TABLES `cm_course_assessment_method_log` WRITE;
/*!40000 ALTER TABLE `cm_course_assessment_method_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_course_assessment_method_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_course_learning_outcome`
--

DROP TABLE IF EXISTS `cm_course_learning_outcome`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_course_learning_outcome` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) NOT NULL,
  `program_learning_outcome_id` bigint(20) NOT NULL,
  `learning_domain_id` bigint(20) DEFAULT NULL,
  `text_en` text NOT NULL,
  `text_ar` text NOT NULL,
  `code` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cm_course_learning_outcome_course_id_index` (`course_id`),
  KEY `cm_course_learning_outcome_program_learning_outcome_id_index` (`program_learning_outcome_id`),
  KEY `cm_course_learning_outcome_learning_domain_id_index` (`learning_domain_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_course_learning_outcome`
--

LOCK TABLES `cm_course_learning_outcome` WRITE;
/*!40000 ALTER TABLE `cm_course_learning_outcome` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_course_learning_outcome` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_course_learning_outcome_log`
--

DROP TABLE IF EXISTS `cm_course_learning_outcome_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_course_learning_outcome_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `semester_id` bigint(20) NOT NULL,
  `log_id` bigint(20) NOT NULL,
  `log_course_id` bigint(20) NOT NULL,
  `log_program_learning_outcome_id` bigint(20) NOT NULL,
  `log_learning_domain_id` bigint(20) DEFAULT NULL,
  `log_text_en` text NOT NULL,
  `log_text_ar` text NOT NULL,
  `log_code` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_course_learning_outcome_log`
--

LOCK TABLES `cm_course_learning_outcome_log` WRITE;
/*!40000 ALTER TABLE `cm_course_learning_outcome_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_course_learning_outcome_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_course_learning_outcome_survey`
--

DROP TABLE IF EXISTS `cm_course_learning_outcome_survey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_course_learning_outcome_survey` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `course_learning_outcome_id` bigint(20) NOT NULL,
  `survey_id` bigint(20) NOT NULL,
  `factor_id` bigint(20) NOT NULL,
  `statement_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_course_learning_outcome_survey`
--

LOCK TABLES `cm_course_learning_outcome_survey` WRITE;
/*!40000 ALTER TABLE `cm_course_learning_outcome_survey` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_course_learning_outcome_survey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_course_learning_outcome_target`
--

DROP TABLE IF EXISTS `cm_course_learning_outcome_target`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_course_learning_outcome_target` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `course_learning_outcome_id` bigint(20) NOT NULL,
  `target` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_course_learning_outcome_target`
--

LOCK TABLES `cm_course_learning_outcome_target` WRITE;
/*!40000 ALTER TABLE `cm_course_learning_outcome_target` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_course_learning_outcome_target` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_course_learning_outcome_target_log`
--

DROP TABLE IF EXISTS `cm_course_learning_outcome_target_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_course_learning_outcome_target_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `semester_id` bigint(20) NOT NULL,
  `log_id` bigint(20) NOT NULL,
  `log_course_learning_outcome_id` bigint(20) NOT NULL,
  `log_target` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_course_learning_outcome_target_log`
--

LOCK TABLES `cm_course_learning_outcome_target_log` WRITE;
/*!40000 ALTER TABLE `cm_course_learning_outcome_target_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_course_learning_outcome_target_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_course_mapping_matrix`
--

DROP TABLE IF EXISTS `cm_course_mapping_matrix`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_course_mapping_matrix` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) NOT NULL DEFAULT '0',
  `course_learning_outcome_id` bigint(20) NOT NULL DEFAULT '0',
  `course_assessment_method_id` bigint(20) NOT NULL DEFAULT '0',
  `course_assessment_component_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cm_course_mapping_matrix_course_id_index` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_course_mapping_matrix`
--

LOCK TABLES `cm_course_mapping_matrix` WRITE;
/*!40000 ALTER TABLE `cm_course_mapping_matrix` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_course_mapping_matrix` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_course_mapping_matrix_log`
--

DROP TABLE IF EXISTS `cm_course_mapping_matrix_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_course_mapping_matrix_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `semester_id` bigint(20) NOT NULL DEFAULT '0',
  `log_id` bigint(20) NOT NULL DEFAULT '0',
  `log_course_id` bigint(20) NOT NULL DEFAULT '0',
  `log_course_learning_outcome_id` bigint(20) NOT NULL DEFAULT '0',
  `log_course_assessment_method_id` bigint(20) NOT NULL DEFAULT '0',
  `log_course_assessment_component_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_course_mapping_matrix_log`
--

LOCK TABLES `cm_course_mapping_matrix_log` WRITE;
/*!40000 ALTER TABLE `cm_course_mapping_matrix_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_course_mapping_matrix_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_course_offered_program`
--

DROP TABLE IF EXISTS `cm_course_offered_program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_course_offered_program` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) NOT NULL DEFAULT '0',
  `program_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cm_course_offered_program_course_id_index` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_course_offered_program`
--

LOCK TABLES `cm_course_offered_program` WRITE;
/*!40000 ALTER TABLE `cm_course_offered_program` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_course_offered_program` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_learning_domain`
--

DROP TABLE IF EXISTS `cm_learning_domain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_learning_domain` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ncaaa_code` tinyint(1) NOT NULL DEFAULT '1',
  `title_en` varchar(255) NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_learning_domain`
--

LOCK TABLES `cm_learning_domain` WRITE;
/*!40000 ALTER TABLE `cm_learning_domain` DISABLE KEYS */;
INSERT INTO `cm_learning_domain` VALUES (1,1,'Knowledge','المعرفة',0),(2,2,'Cognitive Skills','المهارات الإدراكية',0),(3,3,'Interpersonal Skills and Responsibility','المسؤولية والمهارات الشخصية',0),(4,4,'communication, information technology and numerical skills','والاتصالات وتكنولوجيا المعلومات والمهارات العددية',0),(5,5,'Psychomotor Skills','المهارات الحركية',0);
/*!40000 ALTER TABLE `cm_learning_domain` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_learning_outcome`
--

DROP TABLE IF EXISTS `cm_learning_outcome`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_learning_outcome` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `learning_domain_id` bigint(20) NOT NULL,
  `title_en` text NOT NULL,
  `title_ar` text NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_learning_outcome`
--

LOCK TABLES `cm_learning_outcome` WRITE;
/*!40000 ALTER TABLE `cm_learning_outcome` DISABLE KEYS */;
INSERT INTO `cm_learning_outcome` VALUES (1,1,'knowledge of specific facts.','knowledge of specific facts.',0),(2,1,'knowledge of concepts, principles and theories.','knowledge of concepts, principles and theories.',0),(3,1,'knowledge of procedures.','knowledge of procedures.',0),(4,2,'apply conceptual understanding of concepts, principles, theories.','apply conceptual understanding of concepts, principles, theories.',0),(5,2,'apply procedures involved in critical thinking and creative problem solving, both when asked to do so, and when faced with unanticipated new situations.','apply procedures involved in critical thinking and creative problem solving, both when asked to do so, and when faced with unanticipated new situations.',0),(6,2,'investigate issues and problems in a field of study using a range of sources and draw valid conclusions.','investigate issues and problems in a field of study using a range of sources and draw valid conclusions.',0),(7,3,'take responsibility for their own learning and continuing personal and professional development.','take responsibility for their own learning and continuing personal and professional development.',0),(8,3,'work effectively in groups and exercise leadership when appropriate.','work effectively in groups and exercise leadership when appropriate.',0),(9,3,'act responsibly in personal and professional relationships.','act responsibly in personal and professional relationships.',0),(10,3,'act ethically and consistently with high moral standards in personal and public forums.','act ethically and consistently with high moral standards in personal and public forums.',0),(11,4,'communicate effectively in oral and written form.','communicate effectively in oral and written form.',0),(12,4,'use information and communications technology.','use information and communications technology.',0),(13,4,'use basic mathematical and statistical techniques.','use basic mathematical and statistical techniques.',0);
/*!40000 ALTER TABLE `cm_learning_outcome` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_program_assessment_component`
--

DROP TABLE IF EXISTS `cm_program_assessment_component`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_program_assessment_component` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `program_assessment_method_id` bigint(20) NOT NULL,
  `assessment_component_id` bigint(20) NOT NULL DEFAULT '0',
  `text_en` varchar(255) NOT NULL,
  `text_ar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_program_assessment_component`
--

LOCK TABLES `cm_program_assessment_component` WRITE;
/*!40000 ALTER TABLE `cm_program_assessment_component` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_program_assessment_component` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_program_assessment_component_log`
--

DROP TABLE IF EXISTS `cm_program_assessment_component_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_program_assessment_component_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `semester_id` bigint(20) NOT NULL,
  `log_id` bigint(20) NOT NULL DEFAULT '0',
  `log_program_assessment_method_id` bigint(20) NOT NULL,
  `log_assessment_component_id` bigint(20) NOT NULL DEFAULT '0',
  `log_text_en` varchar(255) NOT NULL,
  `log_text_ar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_program_assessment_component_log`
--

LOCK TABLES `cm_program_assessment_component_log` WRITE;
/*!40000 ALTER TABLE `cm_program_assessment_component_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_program_assessment_component_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_program_assessment_method`
--

DROP TABLE IF EXISTS `cm_program_assessment_method`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_program_assessment_method` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `program_id` bigint(20) NOT NULL,
  `assessment_method_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_program_assessment_method`
--

LOCK TABLES `cm_program_assessment_method` WRITE;
/*!40000 ALTER TABLE `cm_program_assessment_method` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_program_assessment_method` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_program_assessment_method_log`
--

DROP TABLE IF EXISTS `cm_program_assessment_method_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_program_assessment_method_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `semester_id` bigint(20) NOT NULL,
  `log_id` bigint(20) NOT NULL,
  `log_program_id` bigint(20) NOT NULL,
  `log_assessment_method_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_program_assessment_method_log`
--

LOCK TABLES `cm_program_assessment_method_log` WRITE;
/*!40000 ALTER TABLE `cm_program_assessment_method_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_program_assessment_method_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_program_learning_outcome`
--

DROP TABLE IF EXISTS `cm_program_learning_outcome`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_program_learning_outcome` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `learning_domain_id` bigint(20) NOT NULL,
  `learning_outcome_id` bigint(20) NOT NULL DEFAULT '0',
  `program_id` bigint(20) NOT NULL DEFAULT '0',
  `text_en` text NOT NULL,
  `text_ar` text NOT NULL,
  `code` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_program_learning_outcome`
--

LOCK TABLES `cm_program_learning_outcome` WRITE;
/*!40000 ALTER TABLE `cm_program_learning_outcome` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_program_learning_outcome` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_program_learning_outcome_log`
--

DROP TABLE IF EXISTS `cm_program_learning_outcome_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_program_learning_outcome_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `semester_id` bigint(20) NOT NULL DEFAULT '0',
  `log_id` bigint(20) NOT NULL DEFAULT '0',
  `log_learning_domain_id` bigint(20) NOT NULL,
  `log_learning_outcome_id` bigint(20) NOT NULL DEFAULT '0',
  `log_program_id` bigint(20) NOT NULL DEFAULT '0',
  `log_text_en` text NOT NULL,
  `log_text_ar` text NOT NULL,
  `log_code` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_program_learning_outcome_log`
--

LOCK TABLES `cm_program_learning_outcome_log` WRITE;
/*!40000 ALTER TABLE `cm_program_learning_outcome_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_program_learning_outcome_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_program_learning_outcome_survey`
--

DROP TABLE IF EXISTS `cm_program_learning_outcome_survey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_program_learning_outcome_survey` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `program_learning_outcome_id` bigint(20) NOT NULL,
  `survey_id` bigint(20) NOT NULL,
  `factor_id` bigint(20) NOT NULL,
  `statement_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_program_learning_outcome_survey`
--

LOCK TABLES `cm_program_learning_outcome_survey` WRITE;
/*!40000 ALTER TABLE `cm_program_learning_outcome_survey` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_program_learning_outcome_survey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_program_learning_outcome_target`
--

DROP TABLE IF EXISTS `cm_program_learning_outcome_target`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_program_learning_outcome_target` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `program_learning_outcome_id` bigint(20) NOT NULL,
  `target` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_program_learning_outcome_target`
--

LOCK TABLES `cm_program_learning_outcome_target` WRITE;
/*!40000 ALTER TABLE `cm_program_learning_outcome_target` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_program_learning_outcome_target` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_program_learning_outcome_target_log`
--

DROP TABLE IF EXISTS `cm_program_learning_outcome_target_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_program_learning_outcome_target_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `semester_id` bigint(20) NOT NULL,
  `log_id` bigint(20) NOT NULL,
  `log_program_learning_outcome_id` bigint(20) NOT NULL,
  `log_target` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_program_learning_outcome_target_log`
--

LOCK TABLES `cm_program_learning_outcome_target_log` WRITE;
/*!40000 ALTER TABLE `cm_program_learning_outcome_target_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_program_learning_outcome_target_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_program_mapping_matrix`
--

DROP TABLE IF EXISTS `cm_program_mapping_matrix`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_program_mapping_matrix` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `program_id` bigint(20) NOT NULL DEFAULT '0',
  `course_id` bigint(20) NOT NULL DEFAULT '0',
  `program_learning_outcome_id` bigint(20) NOT NULL DEFAULT '0',
  `ipa` enum('i','a','p') NOT NULL DEFAULT 'i',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_program_mapping_matrix`
--

LOCK TABLES `cm_program_mapping_matrix` WRITE;
/*!40000 ALTER TABLE `cm_program_mapping_matrix` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_program_mapping_matrix` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_program_mapping_matrix_log`
--

DROP TABLE IF EXISTS `cm_program_mapping_matrix_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_program_mapping_matrix_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `semester_id` bigint(20) NOT NULL,
  `log_id` bigint(20) NOT NULL DEFAULT '0',
  `log_program_id` bigint(20) NOT NULL DEFAULT '0',
  `log_course_id` bigint(20) NOT NULL DEFAULT '0',
  `log_program_learning_outcome_id` bigint(20) NOT NULL DEFAULT '0',
  `log_ipa` enum('i','a','p') NOT NULL DEFAULT 'i',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_program_mapping_matrix_log`
--

LOCK TABLES `cm_program_mapping_matrix_log` WRITE;
/*!40000 ALTER TABLE `cm_program_mapping_matrix_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_program_mapping_matrix_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_section_mapping_question`
--

DROP TABLE IF EXISTS `cm_section_mapping_question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_section_mapping_question` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `section_id` bigint(20) NOT NULL DEFAULT '0',
  `course_assessment_method_id` bigint(20) NOT NULL DEFAULT '0',
  `full_mark` int(11) NOT NULL DEFAULT '0',
  `question` text NOT NULL,
  `course_learning_outcomes_ids` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cm_section_mapping_question_section_id_index` (`section_id`),
  KEY `cm_section_mapping_question_course_assessment_method_id_index` (`course_assessment_method_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_section_mapping_question`
--

LOCK TABLES `cm_section_mapping_question` WRITE;
/*!40000 ALTER TABLE `cm_section_mapping_question` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_section_mapping_question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_section_student_assessment`
--

DROP TABLE IF EXISTS `cm_section_student_assessment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_section_student_assessment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `section_id` bigint(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `section_mapping_question_id` bigint(20) NOT NULL,
  `score` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `SMQ_IDX` (`section_id`,`section_mapping_question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_section_student_assessment`
--

LOCK TABLES `cm_section_student_assessment` WRITE;
/*!40000 ALTER TABLE `cm_section_student_assessment` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_section_student_assessment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `college`
--

DROP TABLE IF EXISTS `college`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `college` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `integration_id` bigint(20) NOT NULL DEFAULT '0',
  `unit_id` bigint(20) DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `name_en` varchar(255) NOT NULL DEFAULT '',
  `name_ar` varchar(255) NOT NULL DEFAULT '',
  `area` decimal(10,2) DEFAULT '0.00',
  `size` decimal(10,2) DEFAULT '0.00',
  `vision_en` text,
  `vision_ar` text,
  `mission_en` text,
  `mission_ar` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `college`
--

LOCK TABLES `college` WRITE;
/*!40000 ALTER TABLE `college` DISABLE KEYS */;
/*!40000 ALTER TABLE `college` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `college_goal`
--

DROP TABLE IF EXISTS `college_goal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `college_goal` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `college_id` bigint(20) DEFAULT NULL,
  `title_en` tinytext,
  `title_ar` tinytext,
  `is_deleted` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `college_goal`
--

LOCK TABLES `college_goal` WRITE;
/*!40000 ALTER TABLE `college_goal` DISABLE KEYS */;
/*!40000 ALTER TABLE `college_goal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `college_objective`
--

DROP TABLE IF EXISTS `college_objective`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `college_objective` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `college_id` bigint(20) DEFAULT NULL,
  `title_en` tinytext,
  `title_ar` tinytext,
  `is_deleted` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `college_objective`
--

LOCK TABLES `college_objective` WRITE;
/*!40000 ALTER TABLE `college_objective` DISABLE KEYS */;
/*!40000 ALTER TABLE `college_objective` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `integration_id` varchar(100) NOT NULL DEFAULT '0',
  `department_id` bigint(20) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `type` varchar(45) NOT NULL DEFAULT 'theoretical',
  `name_en` varchar(255) NOT NULL DEFAULT '',
  `name_ar` varchar(255) NOT NULL DEFAULT '',
  `code_en` varchar(100) NOT NULL DEFAULT '',
  `code_ar` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `course_idx` (`integration_id`),
  KEY `course_department_id_index` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_section`
--

DROP TABLE IF EXISTS `course_section`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_section` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `integration_id` bigint(20) NOT NULL DEFAULT '0',
  `course_id` bigint(20) NOT NULL,
  `semester_id` bigint(20) NOT NULL,
  `campus_id` bigint(20) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `section_no` varchar(128) NOT NULL DEFAULT '',
  `extra_params` text,
  PRIMARY KEY (`id`),
  KEY `course_section_course_id_index` (`course_id`),
  KEY `course_section_semester_id_index` (`semester_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_section`
--

LOCK TABLES `course_section` WRITE;
/*!40000 ALTER TABLE `course_section` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_section` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_section_student`
--

DROP TABLE IF EXISTS `course_section_student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_section_student` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `section_id` bigint(20) NOT NULL DEFAULT '0',
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `course_section_student_section_id_index` (`section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_section_student`
--

LOCK TABLES `course_section_student` WRITE;
/*!40000 ALTER TABLE `course_section_student` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_section_student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_section_teacher`
--

DROP TABLE IF EXISTS `course_section_teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_section_teacher` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `section_id` bigint(20) NOT NULL DEFAULT '0',
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_section_teacher`
--

LOCK TABLES `course_section_teacher` WRITE;
/*!40000 ALTER TABLE `course_section_teacher` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_section_teacher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `criteria`
--

DROP TABLE IF EXISTS `criteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `criteria` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `standard_id` bigint(20) NOT NULL,
  `is_program` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `date_added` int(11) NOT NULL,
  `date_modified` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `criteria`
--

LOCK TABLES `criteria` WRITE;
/*!40000 ALTER TABLE `criteria` DISABLE KEYS */;
INSERT INTO `criteria` VALUES (1,'1.1','Appropriateness of the Mission',1,1,0,0,0,0,0),(2,'1.2','Usefulness of the Mission Statement',1,1,0,0,0,0,0),(3,'1.3','Development and Review of the Mission',1,1,0,0,0,0,0),(4,'1.4','Use Made of the Mission',1,1,0,0,0,0,0),(5,'1.5','Relationship Between Mission, Goals and Objectives',1,1,0,0,0,0,0),(6,'1.5','Relationship Between Mission, Goals and Objectives',1,1,0,0,0,0,0),(7,'1.6','KPIs',2,1,0,0,0,0,0),(8,'1.7','College KPIs',3,1,0,0,0,0,0),(9,'2.1','Governing Body',1,2,0,0,0,0,0),(10,'2.2','Leadership',1,2,0,0,0,0,0),(11,'2.3','Planning Processes',1,2,0,0,0,0,0),(12,'2.4','Relationship Between Sections for Male and Female Students',1,2,0,0,0,0,0),(13,'2.5','Integrity',1,2,0,0,0,0,0),(14,'2.6','Internal Policies and Regulations',1,2,0,0,0,0,0),(15,'2.7','Organizational Climate',1,2,0,0,0,0,0),(16,'2.8','Associated Companies and Controlled Entities',1,2,0,0,0,0,0),(17,'2.9','KPIs',2,2,0,0,0,0,0),(18,'2.10','College KPIs',3,2,0,0,0,0,0),(19,'3.1','Institutional Commitment to Quality Improvement',1,3,0,0,0,0,0),(20,'3.2','Scope of Quality Assurance Processes',1,3,0,0,0,0,0),(21,'3.3','Administration of Quality Assurance Processes',1,3,0,0,0,0,0),(22,'3.4','Use of Performance Indicators and Benchmarks',1,3,0,0,0,0,0),(23,'3.5','Independent Verification of Evaluations',1,3,0,0,0,0,0),(24,'3.6','KPIs',2,3,0,0,0,0,0),(25,'3.7','College KPIs',3,3,0,0,0,0,0),(26,'4.1','Institutional Oversight of Quality of Learning and Teaching',1,4,0,0,0,0,0),(27,'4.2','Student Learning Outcomes',1,4,0,0,0,0,0),(28,'4.3','Program Development Processes',1,4,0,0,0,0,0),(29,'4.4','Program Evaluation and Review Processes',1,4,0,0,0,0,0),(30,'4.5','Student Assessment',1,4,0,0,0,0,0),(31,'4.6','Educational Assistance for Students',1,4,0,0,0,0,0),(32,'4.7','Student Assessment',1,4,0,0,0,0,0),(33,'4.8','Support for Improvements in Quality of Teaching',1,4,0,0,0,0,0),(34,'4.9','Qualifications and Experience of Teaching Staff',1,4,0,0,0,0,0),(35,'4.10','Field Experience Activities',1,4,0,0,0,0,0),(36,'4.11','Partnership Arrangements With Other Institutions',1,4,0,0,0,0,0),(37,'4.12','KPIs',2,4,0,0,0,0,0),(38,'4.13','College KPIs',3,4,0,0,0,0,0),(39,'5.1','Institutional Oversight of Quality of Learning and Teaching',1,5,0,0,0,0,0),(40,'5.2','Student Records',1,5,0,0,0,0,0),(41,'5.3','Student Management',1,5,0,0,0,0,0),(42,'5.5','Planning and Evaluation of Student Services',1,5,0,0,0,0,0),(43,'5.5','Medical and Counselling Services',1,5,0,0,0,0,0),(44,'5.6','Extra-curricular Activities for Students',1,5,0,0,0,0,0),(45,'5.7','KPIs',2,5,0,0,0,0,0),(46,'5.8','College KPIs',3,5,0,0,0,0,0),(47,'6.1','Planning and Evaluation',1,6,0,0,0,0,0),(48,'6.2','Organization',1,6,0,0,0,0,0),(49,'6.4','Resources and Facilities',1,6,0,0,0,0,0),(50,'6.5','KPIs',2,6,0,0,0,0,0),(51,'6.6','College KPIs',3,6,0,0,0,0,0),(52,'7.1','Policy and Planning',1,7,0,0,0,0,0),(53,'7.2','Quality and Adequacy of Facilities and Equipment',1,7,0,0,0,0,0),(54,'7.3','Management and Administration of Facilities and Equipment',1,7,0,0,0,0,0),(55,'7.4','Information Technology',1,7,0,0,0,0,0),(56,'7.5','Student Residences',1,7,0,0,0,0,0),(57,'7.6','KPIs',2,7,0,0,0,0,0),(58,'7.7','College KPIs',3,7,0,0,0,0,0),(59,'8.1','Financial Planning and Budgeting',1,8,0,0,0,0,0),(60,'8.2','Financial Management',1,8,0,0,0,0,0),(61,'8.3','Auditing and Risk assessment',1,8,0,0,0,0,0),(62,'8.4','KPIs',2,8,0,0,0,0,0),(63,'8.5','College KPIs',3,8,0,0,0,0,0),(64,'9.1','Policy and Administration',1,9,0,0,0,0,0),(65,'9.2','Recruitment',1,9,0,0,0,0,0),(66,'9.3','Personal and Career Development',1,9,0,0,0,0,0),(67,'9.4','Discipline, Complaints and Dispute Resolution',1,9,0,0,0,0,0),(68,'9.5','KPIs',2,9,0,0,0,0,0),(69,'9.6','College KPIs',3,9,0,0,0,0,0),(70,'10.1','Institutional Research Policies',1,10,0,0,0,0,0),(71,'10.2','Teaching Staff and Student Involvement in Research',1,10,0,0,0,0,0),(72,'10.3','Commercialization of Research',1,10,0,0,0,0,0),(73,'10.4','Research Facilities and Equipment',1,10,0,0,0,0,0),(74,'10.5','KPIs',2,10,0,0,0,0,0),(75,'10.6','College KPIs',3,10,0,0,0,0,0),(76,'11.1','Institutional Policies on Community Relationships',1,11,0,0,0,0,0),(77,'11.2','Interactions With the Community',1,11,0,0,0,0,0),(78,'11.3','Interactions With the Community',1,11,0,0,0,0,0),(79,'11.4','KPIs',2,11,0,0,0,0,0),(80,'11.5','College KPIs',3,11,0,0,0,0,0);
/*!40000 ALTER TABLE `criteria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cron_job`
--

DROP TABLE IF EXISTS `cron_job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cron_job` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `job_key` int(11) NOT NULL,
  `job` varchar(255) NOT NULL,
  `user_added` int(11) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `is_released` tinyint(1) NOT NULL DEFAULT '0',
  `date_released` datetime DEFAULT NULL,
  `schedule` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cron_job`
--

LOCK TABLES `cron_job` WRITE;
/*!40000 ALTER TABLE `cron_job` DISABLE KEYS */;
INSERT INTO `cron_job` VALUES (2,1,'strategic_planning index',1,'2017-06-10 15:16:54',0,'0000-00-00 00:00:00',3),(3,2,'backup index',1,'2017-06-10 15:16:57',0,'0000-00-00 00:00:00',4);
/*!40000 ALTER TABLE `cron_job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_academic_units`
--

DROP TABLE IF EXISTS `data_academic_units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_academic_units` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `academic_year` int(11) DEFAULT NULL,
  `no_deanships` int(11) DEFAULT NULL,
  `no_colleges` int(11) DEFAULT NULL,
  `no_programs` int(11) DEFAULT NULL,
  `no_institutions` int(11) DEFAULT NULL,
  `no_research_center` int(11) DEFAULT NULL,
  `no_research_chairs` int(11) DEFAULT NULL,
  `no_medical_hospital` int(11) DEFAULT NULL,
  `no_scientific` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_academic_units`
--

LOCK TABLES `data_academic_units` WRITE;
/*!40000 ALTER TABLE `data_academic_units` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_academic_units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_cohort`
--

DROP TABLE IF EXISTS `data_cohort`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_cohort` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `program_id` bigint(20) NOT NULL,
  `report_year` int(11) NOT NULL,
  `level_year` int(11) NOT NULL,
  `started_on` int(11) NOT NULL,
  `status_id` bigint(20) NOT NULL,
  `student_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_cohort`
--

LOCK TABLES `data_cohort` WRITE;
/*!40000 ALTER TABLE `data_cohort` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_cohort` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_cohort_status`
--

DROP TABLE IF EXISTS `data_cohort_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_cohort_status` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `status_id` bigint(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_cohort_status`
--

LOCK TABLES `data_cohort_status` WRITE;
/*!40000 ALTER TABLE `data_cohort_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_cohort_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_cohort_table`
--

DROP TABLE IF EXISTS `data_cohort_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_cohort_table` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `program_id` bigint(20) DEFAULT NULL,
  `report_year` int(11) DEFAULT NULL,
  `start_year` int(11) DEFAULT NULL,
  `level_year` int(11) DEFAULT NULL,
  `cohort_enroll` int(11) DEFAULT NULL,
  `retain_till_year` int(11) DEFAULT NULL,
  `withdrawn_enrolled` int(11) DEFAULT NULL,
  `withdrawn_good` int(11) DEFAULT NULL,
  `graduated` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_cohort_table`
--

LOCK TABLES `data_cohort_table` WRITE;
/*!40000 ALTER TABLE `data_cohort_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_cohort_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_college`
--

DROP TABLE IF EXISTS `data_college`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_college` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `college_id` bigint(20) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `phone` varchar(128) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_college`
--

LOCK TABLES `data_college` WRITE;
/*!40000 ALTER TABLE `data_college` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_college` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_competion_rate`
--

DROP TABLE IF EXISTS `data_competion_rate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_competion_rate` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `program_id` bigint(20) NOT NULL,
  `academic_year` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `number_of_years` int(11) NOT NULL,
  `graduate_count` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `SearchIndx` (`academic_year`,`program_id`,`gender`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_competion_rate`
--

LOCK TABLES `data_competion_rate` WRITE;
/*!40000 ALTER TABLE `data_competion_rate` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_competion_rate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_course_grade`
--

DROP TABLE IF EXISTS `data_course_grade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_course_grade` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `program_id` bigint(20) DEFAULT '0',
  `course_id` bigint(20) NOT NULL,
  `section_id` bigint(20) NOT NULL,
  `semester_id` bigint(20) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `student_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_course_grade`
--

LOCK TABLES `data_course_grade` WRITE;
/*!40000 ALTER TABLE `data_course_grade` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_course_grade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_course_pre`
--

DROP TABLE IF EXISTS `data_course_pre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_course_pre` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `program_id` bigint(20) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `pre_course_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_course_pre`
--

LOCK TABLES `data_course_pre` WRITE;
/*!40000 ALTER TABLE `data_course_pre` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_course_pre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_course_status`
--

DROP TABLE IF EXISTS `data_course_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_course_status` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `program_id` bigint(20) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `section_id` bigint(20) NOT NULL,
  `semester_id` bigint(20) NOT NULL,
  `status_id` bigint(20) NOT NULL,
  `student_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_course_status`
--

LOCK TABLES `data_course_status` WRITE;
/*!40000 ALTER TABLE `data_course_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_course_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_course_statuses`
--

DROP TABLE IF EXISTS `data_course_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_course_statuses` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `status_id` bigint(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_course_statuses`
--

LOCK TABLES `data_course_statuses` WRITE;
/*!40000 ALTER TABLE `data_course_statuses` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_course_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_course_students`
--

DROP TABLE IF EXISTS `data_course_students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_course_students` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `program_id` bigint(20) DEFAULT NULL,
  `course_id` bigint(20) NOT NULL,
  `section_id` bigint(20) DEFAULT NULL,
  `semester_id` bigint(20) NOT NULL,
  `student_start_count` int(11) NOT NULL,
  `student_complete_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_course_students`
--

LOCK TABLES `data_course_students` WRITE;
/*!40000 ALTER TABLE `data_course_students` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_course_students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_faculty`
--

DROP TABLE IF EXISTS `data_faculty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_faculty` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `program_id` bigint(20) DEFAULT NULL,
  `academic_year` int(11) DEFAULT NULL,
  `teaching_assistant_male` int(11) DEFAULT NULL,
  `teaching_assistant_female` int(11) DEFAULT NULL,
  `instructor_male` int(11) DEFAULT NULL,
  `instructor_female` int(11) DEFAULT NULL,
  `assistant_prof_male` int(11) DEFAULT NULL,
  `assistant_prof_female` int(11) DEFAULT NULL,
  `associate_prof_male` int(11) DEFAULT NULL,
  `associate_prof_female` int(11) DEFAULT NULL,
  `prof_male` int(11) DEFAULT NULL,
  `prof_female` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_faculty`
--

LOCK TABLES `data_faculty` WRITE;
/*!40000 ALTER TABLE `data_faculty` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_faculty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_graduate`
--

DROP TABLE IF EXISTS `data_graduate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_graduate` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `program_id` bigint(20) NOT NULL,
  `academic_year` varchar(255) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `major` text NOT NULL,
  `graduate_count` int(11) NOT NULL,
  `enrolled_count` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `SearchIndx` (`academic_year`,`program_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_graduate`
--

LOCK TABLES `data_graduate` WRITE;
/*!40000 ALTER TABLE `data_graduate` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_graduate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_institution`
--

DROP TABLE IF EXISTS `data_institution`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_institution` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `academic_year` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `telephone` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_institution`
--

LOCK TABLES `data_institution` WRITE;
/*!40000 ALTER TABLE `data_institution` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_institution` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_level_enrolled`
--

DROP TABLE IF EXISTS `data_level_enrolled`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_level_enrolled` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `program_id` bigint(20) NOT NULL,
  `academic_year` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `enrolled_count` int(11) NOT NULL,
  `nationality` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_level_enrolled`
--

LOCK TABLES `data_level_enrolled` WRITE;
/*!40000 ALTER TABLE `data_level_enrolled` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_level_enrolled` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_periodic_program`
--

DROP TABLE IF EXISTS `data_periodic_program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_periodic_program` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `program_id` bigint(20) NOT NULL,
  `academic_year` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `phd_holder_count` int(11) NOT NULL,
  `teaching_staff_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_periodic_program`
--

LOCK TABLES `data_periodic_program` WRITE;
/*!40000 ALTER TABLE `data_periodic_program` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_periodic_program` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_periodic_program_ext`
--

DROP TABLE IF EXISTS `data_periodic_program_ext`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_periodic_program_ext` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `program_id` bigint(20) DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `academic_year` int(11) DEFAULT NULL,
  `work_load` int(11) DEFAULT NULL,
  `class_size` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_periodic_program_ext`
--

LOCK TABLES `data_periodic_program_ext` WRITE;
/*!40000 ALTER TABLE `data_periodic_program_ext` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_periodic_program_ext` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_preparatory_year`
--

DROP TABLE IF EXISTS `data_preparatory_year`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_preparatory_year` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `stream` varchar(255) NOT NULL,
  `academic_year` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `student_count` int(11) NOT NULL,
  `teaching_staff_count` int(11) NOT NULL,
  `completion_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_preparatory_year`
--

LOCK TABLES `data_preparatory_year` WRITE;
/*!40000 ALTER TABLE `data_preparatory_year` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_preparatory_year` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_preparatory_year_faculty`
--

DROP TABLE IF EXISTS `data_preparatory_year_faculty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_preparatory_year_faculty` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `stream` varchar(255) DEFAULT NULL,
  `academic_year` int(11) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `teacher_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_preparatory_year_faculty`
--

LOCK TABLES `data_preparatory_year_faculty` WRITE;
/*!40000 ALTER TABLE `data_preparatory_year_faculty` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_preparatory_year_faculty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_research_budget`
--

DROP TABLE IF EXISTS `data_research_budget`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_research_budget` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `program_id` bigint(20) NOT NULL,
  `academic_year` varchar(255) NOT NULL,
  `research_budget_total_amount` int(11) NOT NULL,
  `research_budget_actual_expenditure` int(11) NOT NULL,
  `publications_count` int(11) NOT NULL,
  `conferece_presentation_count` int(11) NOT NULL,
  `male_faculty_member_count` int(11) NOT NULL,
  `female_faculty_member_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_research_budget`
--

LOCK TABLES `data_research_budget` WRITE;
/*!40000 ALTER TABLE `data_research_budget` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_research_budget` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_workload`
--

DROP TABLE IF EXISTS `data_workload`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_workload` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `program_id` bigint(20) DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `academic_year` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `work_load` decimal(10,2) DEFAULT NULL,
  `class_size` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_workload`
--

LOCK TABLES `data_workload` WRITE;
/*!40000 ALTER TABLE `data_workload` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_workload` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `degree`
--

DROP TABLE IF EXISTS `degree`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `degree` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `integration_id` bigint(20) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `name_en` varchar(255) NOT NULL DEFAULT '',
  `name_ar` varchar(255) NOT NULL DEFAULT '',
  `is_undergraduate` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `degree`
--

LOCK TABLES `degree` WRITE;
/*!40000 ALTER TABLE `degree` DISABLE KEYS */;
/*!40000 ALTER TABLE `degree` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `integration_id` varchar(255) NOT NULL DEFAULT '0',
  `college_id` bigint(20) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `name_en` varchar(255) NOT NULL DEFAULT '',
  `name_ar` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_academic_article`
--

DROP TABLE IF EXISTS `fp_academic_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_academic_article` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `authors` text,
  `year` int(11) DEFAULT NULL,
  `author_type` tinyint(1) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `publisher` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_academic_article`
--

LOCK TABLES `fp_academic_article` WRITE;
/*!40000 ALTER TABLE `fp_academic_article` DISABLE KEYS */;
/*!40000 ALTER TABLE `fp_academic_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_academic_qualification`
--

DROP TABLE IF EXISTS `fp_academic_qualification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_academic_qualification` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `country` varchar(128) DEFAULT NULL,
  `city` varchar(128) DEFAULT NULL,
  `university` varchar(128) DEFAULT NULL,
  `college` varchar(128) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `degree` varchar(45) DEFAULT NULL,
  `grade` varchar(45) DEFAULT NULL,
  `speciality` varchar(128) DEFAULT NULL,
  `supervisor_name` varchar(128) DEFAULT NULL,
  `thises_title` varchar(128) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_academic_qualification`
--

LOCK TABLES `fp_academic_qualification` WRITE;
/*!40000 ALTER TABLE `fp_academic_qualification` DISABLE KEYS */;
/*!40000 ALTER TABLE `fp_academic_qualification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_academic_rank`
--

DROP TABLE IF EXISTS `fp_academic_rank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_academic_rank` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `academic_rank` int(11) DEFAULT NULL,
  `rank_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_academic_rank`
--

LOCK TABLES `fp_academic_rank` WRITE;
/*!40000 ALTER TABLE `fp_academic_rank` DISABLE KEYS */;
/*!40000 ALTER TABLE `fp_academic_rank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_administrative_work`
--

DROP TABLE IF EXISTS `fp_administrative_work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_administrative_work` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `position` varchar(128) DEFAULT NULL,
  `college_id` bigint(20) DEFAULT NULL,
  `department_id` bigint(20) DEFAULT NULL,
  `deanship_id` bigint(20) DEFAULT NULL,
  `vice_recotrate` varchar(128) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_administrative_work`
--

LOCK TABLES `fp_administrative_work` WRITE;
/*!40000 ALTER TABLE `fp_administrative_work` DISABLE KEYS */;
/*!40000 ALTER TABLE `fp_administrative_work` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_advising`
--

DROP TABLE IF EXISTS `fp_advising`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_advising` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `semester_id` bigint(20) NOT NULL,
  `level` int(11) DEFAULT NULL,
  `number_of_students` int(11) DEFAULT NULL,
  `number_of_sections` int(11) DEFAULT NULL,
  `subject_taught` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_advising`
--

LOCK TABLES `fp_advising` WRITE;
/*!40000 ALTER TABLE `fp_advising` DISABLE KEYS */;
/*!40000 ALTER TABLE `fp_advising` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_award`
--

DROP TABLE IF EXISTS `fp_award`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_award` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `domain` varchar(128) DEFAULT NULL,
  `party` varchar(128) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `address` varchar(512) DEFAULT NULL,
  `material_value` text,
  `moral_value` text,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_award`
--

LOCK TABLES `fp_award` WRITE;
/*!40000 ALTER TABLE `fp_award` DISABLE KEYS */;
/*!40000 ALTER TABLE `fp_award` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_book`
--

DROP TABLE IF EXISTS `fp_book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_book` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `title` varchar(128) DEFAULT NULL,
  `author_type` tinyint(1) DEFAULT NULL,
  `authors` text,
  `authors_no` int(11) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `publisher` varchar(128) DEFAULT NULL,
  `pages_count` int(11) DEFAULT NULL,
  `attachment` varchar(128) DEFAULT NULL,
  `is_translate` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_book`
--

LOCK TABLES `fp_book` WRITE;
/*!40000 ALTER TABLE `fp_book` DISABLE KEYS */;
/*!40000 ALTER TABLE `fp_book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_committee`
--

DROP TABLE IF EXISTS `fp_committee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_committee` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_committee`
--

LOCK TABLES `fp_committee` WRITE;
/*!40000 ALTER TABLE `fp_committee` DISABLE KEYS */;
/*!40000 ALTER TABLE `fp_committee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_conference`
--

DROP TABLE IF EXISTS `fp_conference`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_conference` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `is_workshop` tinyint(1) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `location` text,
  `participation_type` tinyint(1) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_conference`
--

LOCK TABLES `fp_conference` WRITE;
/*!40000 ALTER TABLE `fp_conference` DISABLE KEYS */;
/*!40000 ALTER TABLE `fp_conference` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_creative_work`
--

DROP TABLE IF EXISTS `fp_creative_work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_creative_work` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `owner_name` varchar(128) DEFAULT NULL,
  `dissemination_type` tinyint(1) DEFAULT NULL,
  `funds_type` tinyint(1) DEFAULT NULL,
  `funds` int(11) DEFAULT NULL,
  `attachment` varchar(128) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_creative_work`
--

LOCK TABLES `fp_creative_work` WRITE;
/*!40000 ALTER TABLE `fp_creative_work` DISABLE KEYS */;
/*!40000 ALTER TABLE `fp_creative_work` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_dissertation`
--

DROP TABLE IF EXISTS `fp_dissertation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_dissertation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `level` int(11) DEFAULT NULL,
  `semester_id` bigint(20) DEFAULT NULL,
  `is_new` tinyint(1) DEFAULT NULL,
  `is_main` tinyint(1) DEFAULT NULL,
  `dissertation_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_dissertation`
--

LOCK TABLES `fp_dissertation` WRITE;
/*!40000 ALTER TABLE `fp_dissertation` DISABLE KEYS */;
/*!40000 ALTER TABLE `fp_dissertation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_evaluation`
--

DROP TABLE IF EXISTS `fp_evaluation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_evaluation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `academic_year` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `user_score` float DEFAULT NULL,
  `peer_id` bigint(20) DEFAULT NULL,
  `peer_score` float DEFAULT NULL,
  `supervisor_id` bigint(20) DEFAULT NULL,
  `supervisor_score` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_evaluation`
--

LOCK TABLES `fp_evaluation` WRITE;
/*!40000 ALTER TABLE `fp_evaluation` DISABLE KEYS */;
/*!40000 ALTER TABLE `fp_evaluation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_experience`
--

DROP TABLE IF EXISTS `fp_experience`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_experience` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `organization` varchar(128) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `position` varchar(128) DEFAULT NULL,
  `address` text,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_experience`
--

LOCK TABLES `fp_experience` WRITE;
/*!40000 ALTER TABLE `fp_experience` DISABLE KEYS */;
/*!40000 ALTER TABLE `fp_experience` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_forms`
--

DROP TABLE IF EXISTS `fp_forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_forms` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type_id` bigint(20) NOT NULL,
  `form_name_en` varchar(300) NOT NULL,
  `form_name_ar` varchar(300) NOT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` tinyint(1) NOT NULL DEFAULT '0',
  `static_file` mediumtext,
  `is_hidden` tinyint(1) NOT NULL DEFAULT '0',
  `is_editable` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_forms`
--

LOCK TABLES `fp_forms` WRITE;
/*!40000 ALTER TABLE `fp_forms` DISABLE KEYS */;
INSERT INTO `fp_forms` VALUES (1,3,'Appointments as Editor','التعيينات كمحرر','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'appointments_as_editor',0,0),(2,1,'Courses Taught','تدريس المواد الدراسية','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'courses_taught',0,0),(3,3,'Conference Chair Organizer','منظم المؤتمر الرئيسي','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'conference_chair_organizer',0,0),(4,1,'Course Development','تطوير المادة الدراسية','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'course_development',0,0),(5,3,'Session Chair Organizer','منظم الجالسة الرئيسي','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'session_chair_organizer',0,0),(6,1,'Laboratory Course Development','مكتبة تطوير المادة الدراسية','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'laboratory_course_development',0,0),(7,3,'Reviewer','مراجع','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'reviewer',0,0),(8,3,'Professional Committees','اللجان الفنية','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'professional_committees',0,0),(9,3,'Examiner Committees','لجان الامتحانات','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'examiner_committees',0,0),(10,3,'Departmental Committees','لجان الأقسام','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'departmental_committees',0,0),(11,3,'College Committees','لجان الكلية','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'college_committees',0,0),(12,1,'Curricular Revisions','المراجعات المنهجية','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'curricular_revisions',0,0),(13,1,'Ph.D. Dissertations Completed','رسائل الدكتوراة المكتملة','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'PhD_dissertations_completed',0,0),(14,1,'MS Thesis Completed','رسائل الماجستير المكتملة','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'ms_thesis_completed',0,0),(15,1,'MS Non-Thesis Completed','رسائل الماجستير غير المكتملة','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'ms_non-thesis_completed',0,0),(16,3,'University Committees','لجان الجامعة','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'university_committees',0,0),(17,3,'Miscellaneous Service Activities','أنشطة الخدمات المتنوعة','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'miscellaneous',0,0),(18,3,'Consulting Activities - Organization Unpaid','الأنشطة الاستشارية - المنظمة بدون أجر','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'organization_unpaid',0,0),(19,3,'Consulting Activities - Organization Service','الأنشطة الاستشارية - خدمة المنظمة','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'organization_service',0,0),(20,3,'Consulting Activities - Professional Testimony','الأنشطة الاستشارية - شهادة مهنية','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'professional_testimony',0,0),(21,3,'Teaching Awards - External','جوائز التدريس - الخارجية','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'teaching_awards _ external',0,0),(22,3,'Teaching Awards - Internal','جوائز التدريس - الداخلية','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'teaching_awards_internal',0,0),(23,3,'Research Awards - External','جوائز البحث - الخارجية','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'research_awards_external',0,0),(24,3,'Research Awards - Internal','جوائز البحث - الداخلية','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'research_awards_internal',0,0),(25,3,'Service Awards - External','جوائز الخدمة - الخارجية','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'service_awards_external',0,0),(26,3,'Service Awards - Internal','جوائز الخدمة - الداخلية','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'service_awards_internal',0,0),(27,3,'Consulting Activities - Organization Paid','الأنشطة الاستشارية - المنظمة المدفوعة','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'consulting',0,0),(28,1,'Adviser for Student Organization(s)','نصائح للمنظمات الطلابية','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'adviser_for_student_organization',0,0),(29,1,'Post-Doctoral Students ','طلاب ما بعد الدكتوراة','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'post-doctoral_students',0,0),(30,1,'Instructional techniques Utilized','التقنيات التعليمية المستخدمة','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'instructional_techniques_utilized',0,0),(31,1,'Undergraduate Projects Completed','مشاريع التخرج المنتجزة','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'undergraduate_projects_completed',0,0),(32,1,'Current Ph.D. Students and Support','دعم وطلاب الدكتوراة الحاليين','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'current_phD_students_and_support',0,0),(33,1,'Current MS Students and Support','دعم وطلاب الماجستير الحاليين','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'current_MS_students_and_support',0,0),(34,1,'Current Undergraduate Students','الطلاب الجامعيين الحاليين','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'current_undergraduate_students',0,0),(35,2,'Journal Articles - Referred','مقالات صحفية محكمة','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'journal_articles_refereed',0,0),(36,2,'Journal Articles - Non Referred','مقالات صحفية غير محكمة','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'journal_articles_non_refereed',0,0),(37,2,'Conference Proceedings - Referred','وقائع المؤتمر المحكمة','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'conference_proceedings_refereed',0,0),(38,2,'Conference Proceedings - Non Referred','وقائع المؤتمر غير المحكمة','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'conference_proceedings_non_refereed',0,0),(39,2,'Books - Unpublished','الكتب - كتب جديدة','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'books_new_books',0,0),(40,2,'Books - Edited or Revised','كتب - تعديل ومراجعة','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'books_edited_or_revised',0,0),(41,2,'Books - Chapters','الكتب - فصول','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'book_chapters',0,0),(42,2,'Books - Published','الكتب - كتب منشورة','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'book_published_book',0,0),(43,2,'Meetings and Conferences','الاجتماعات والمؤتمرات','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'meetings_and_conferences',0,0),(44,2,'Workshops and Short Courses','ورشات العمل والدورات القصيرة','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'workshops_and_short_courses',0,0),(45,2,'Seminars at Other Universities or Industries','ندوات في الجامعات أو المؤسسات الأخرى','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'seminars_at_other_universities_or_industry',0,0),(46,2,'Patents','براءات الاختراع','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'patents',0,0),(47,2,'Intellectual Property Disclosures','الإفصاح عن الملكية الفكرية','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'intellectual_property_disclosures',0,0),(48,2,'Computer Software','برامج الكمبيوتر','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'computer_software',0,0),(49,2,'Governmental Grants','المنح الحكومية','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'governmental_grants',0,0),(50,2,'External, Non-Governmental Grants','المنح الخارجية غير الحكومية','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'external_non_governmental_grants',0,0),(51,2,'Internal, University Grants','المنح الجامعية الداخلية','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'internal_university_grants',0,0),(52,2,'Successful New Grants Received','الحصول على منح جديدة ناجحة','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'successful_new_grants_received',0,0),(53,2,'Proposals Declined, or Submitted and Pending','المقترحات المرفوضة أو المرسلة أو المعلقة ','2017-06-10 12:12:28','2017-06-10 12:12:28',0,'proposals_declined_or_submitted_and_pending',0,0);
/*!40000 ALTER TABLE `fp_forms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_forms_deadline`
--

DROP TABLE IF EXISTS `fp_forms_deadline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_forms_deadline` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `start_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_forms_deadline`
--

LOCK TABLES `fp_forms_deadline` WRITE;
/*!40000 ALTER TABLE `fp_forms_deadline` DISABLE KEYS */;
/*!40000 ALTER TABLE `fp_forms_deadline` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_forms_evaluations`
--

DROP TABLE IF EXISTS `fp_forms_evaluations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_forms_evaluations` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `type_id` bigint(20) NOT NULL,
  `value` double NOT NULL,
  `deadline_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_forms_evaluations`
--

LOCK TABLES `fp_forms_evaluations` WRITE;
/*!40000 ALTER TABLE `fp_forms_evaluations` DISABLE KEYS */;
/*!40000 ALTER TABLE `fp_forms_evaluations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_forms_inputs`
--

DROP TABLE IF EXISTS `fp_forms_inputs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_forms_inputs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `form_id` bigint(20) DEFAULT NULL,
  `input_label_en` varchar(300) NOT NULL,
  `input_label_ar` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=601 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_forms_inputs`
--

LOCK TABLES `fp_forms_inputs` WRITE;
/*!40000 ALTER TABLE `fp_forms_inputs` DISABLE KEYS */;
INSERT INTO `fp_forms_inputs` VALUES (1,1,'Publication Name','اسم النشر','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(2,1,'Member of Editorial Board','عضو هيئة التحرير','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(3,3,'Chair Name','اسم المنظم','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(4,4,'Semester','الفصل الدراسي','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(5,4,'Course Code','رمز المادة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(6,4,'Course Title','اسم المادة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(7,4,'Brief Description','وصف عام','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(8,5,'Chair Name','اسم المنظم','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(9,6,'Semester','الفصل الدراسي','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(10,6,'Course Code','رمز المادة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(11,6,'Course Title','اسم المادة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(12,6,'Brief Description','وصف عام','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(13,7,'Chair Name','اسم المنظم','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(14,8,'Committee Name','اسم اللجنة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(15,9,'Committee Name','اسم اللجنة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(16,10,'Committee Name','اسم اللجنة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(17,11,'Committee Name','اسم اللجنة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(18,16,'Committee Name','اسم اللجنة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(20,14,'Name','الاسم','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(21,14,'Degree','الدرجة العملية','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(22,14,'Thesis Title','عنوان الرسالة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(23,14,'Student Position','وضع الطالب','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(24,15,'Name','الاسم','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(25,15,'Degree','الدرجة العلمية','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(26,15,'Thesis Title','عنوان الرسالة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(27,15,'Student Position','وضع الطالب','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(28,28,'Summary','المراجعة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(29,29,'Summary','المراجعة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(30,30,'Summary','المراجعة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(31,31,'Name','الاسم','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(32,31,'Program','البرنامج','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(33,31,'Project Title','اسم المشروع','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(34,32,'Name','الاسم','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(35,32,'Department','القسم','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(36,32,'Type Support','نوع الدعم','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(37,32,'Department Support','دعم القسم','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(38,33,'Name','الاسم','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(39,33,'Department','القسم','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(40,33,'Type Support','نوع الدعم','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(41,33,'Department Support','دعم القسم','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(42,34,'Name','الاسم','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(43,34,'Program','البرنامج','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(44,34,'Year','السنة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(45,12,'Semester','الفصل الدراسي','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(46,12,'Course Number','رقم المادة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(47,12,'Course Title','اسم المادة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(48,12,'Brief Description','وصف عام','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(49,13,'Name','الاسم','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(50,13,'Degree','الدرجة العلمية','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(51,13,'Thesis Title','عنوان الرسالة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(52,13,'Student Position','وضع الطالب','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(53,2,'Semester','الفصل الدراسي','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(54,2,'Course Number','رقم المادة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(55,2,'Course Title','اسم المادة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(57,2,'Number of Students Enrolled','عدد الطلاب المسجلين','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(58,2,'Course Evaluation Overall Rating','التقييم العام للمادة الدراسية','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(59,36,'Article Title','غير الحكم','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(60,35,'Article Title','الحكم','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(61,36,'Appeared and Accepted','الظهور والقبول','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(62,37,'Name','الحكم','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(63,37,'Appeared and Accepted','الظهور والقبول','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(64,38,'Name','غير الحكم','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(65,38,'Appeared and Accepted','الظهور والقبول','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(67,39,'Book Title','كتاب جديد','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(68,39,'Appeared and Accepted','الظهور والقبول','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(69,40,'Book Title','تعديل أو مراجعة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(70,40,'Appeared and Accepted','الظهور والقبول','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(71,41,'Chapter Title','عنوان الفصل','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(72,41,'Book','الكتاب','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(73,42,'Book Title','عنوان الكتاب','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(74,42,'Reviewed Date','تاريخ المراجعة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(75,43,'Presentation Title','عنوان العرض','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(76,43,'Location','الموقع','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(77,43,'Date','التاريخ','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(78,43,'Meeting or Conference','الاجتماعات والمؤتمرات','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(79,44,'Presentation Title','عنوان العرض','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(80,44,'Location','الموقع','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(81,44,'Date','التاريخ','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(82,44,'Meeting or Conference','الاجتماعات والمؤتمرات','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(83,45,'Presentation Title','عنوان العرض','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(84,45,'Location','الموقع','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(85,45,'Date','التاريخ','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(86,45,'Meeting or Conference','الاجتماعات والمؤتمرات','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(91,48,'Name','الاسم','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(92,48,'Date','التاريخ','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(93,49,'Title','العنوان','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(94,49,'Funding Agency','وكالة التمويل','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(95,49,'Amount Funded','المبلغ الممول','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(96,49,'Funding Period','فترة التمويل','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(97,49,'List of PI’s & Co-PIs','قائمة الباحثين الرئيسين والباحثين المشاركين','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(98,49,'Your Percentage of Participation','النسبة المئوية الخاص من المشاركة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(99,50,'Title','العنوان','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(100,50,'Funding Agency','وكالة التمويل','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(101,50,'Amount Funded','المبلغ الممول','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(102,50,'Funding Period','فترة التمويل','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(103,50,'List of PI’s & Co-PIs','قائمة الباحثين الرئيسين والباحثين المشاركين','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(104,50,'Your Percentage of Participation','النسبة المئوية الخاص من المشاركة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(105,51,'Title','العنوان','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(106,51,'Funding Agency','وكالة التمويل','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(107,51,'Amount Funded','المبلغ الممول','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(108,51,'Funding Period','فترة التمويل','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(109,51,'List of PI’s & Co-PIs','قائمة الباحثين الرئيسين والباحثين المشاركين','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(110,51,'Your Percentage of Participation','النسبة المئوية الخاص من المشاركة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(111,52,'Title','العنوان','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(112,52,'Funding Agency','وكالة التمويل','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(113,52,'Amount Funded','المبلغ الممول','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(114,52,'Funding Period','فترة التمويل','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(115,52,'List of PI’s & Co-PIs','قائمة الباحثين الرئيسين والباحثين المشاركين','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(116,52,'Your Percentage of Participation','النسبة المئوية الخاص من المشاركة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(117,53,'Title','العنوان','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(118,53,'Funding Agency','وكالة التمويل','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(119,53,'Amount Funded','المبلغ الممول','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(120,53,'Funding Period','فترة التمويل','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(121,53,'List of PI’s & Co-PIs','قائمة الباحثين الرئيسين والباحثين المشاركين','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(122,53,'Your Percentage of Participation','النسبة المئوية الخاص من المشاركة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(123,17,'Title','الاسم','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(124,18,'Organization Name','اسم المنظمة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(125,18,'Number of Days','عدد الأيام','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(126,19,'Organization Name','اسم المنظمة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(127,19,'Number of Days','عدد الأيام','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(128,20,'Organization Name','اسم المنظمة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(129,20,'Number of Days','عدد الأيام','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(130,21,'Award Name','اسم الجائزة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(131,22,'Award Name','اسم الجائزة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(132,23,'Award Name','اسم الجائزة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(133,24,'Award Name','اسم الجائزة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(134,25,'Award Name','اسم الجائزة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(135,26,'Award Name','اسم الجائزة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(136,27,'Organization Name','اسم المنظمة','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(137,27,'Number of Days','عدد الأيام','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(138,46,'Name','الاسم','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(139,46,'Date','التاريخ','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(140,47,'Name','الاسم','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(141,47,'Date','التاريخ','2017-06-10 12:12:28','2017-06-10 12:12:28',0),(600,35,'Appeared and Accepted','الظهور والقبول','2017-06-10 12:12:28','2017-06-10 12:12:28',0);
/*!40000 ALTER TABLE `fp_forms_inputs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_forms_rate`
--

DROP TABLE IF EXISTS `fp_forms_rate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_forms_rate` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `deadline_id` bigint(20) NOT NULL,
  `type_id` bigint(20) NOT NULL,
  `rate` double NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_forms_rate`
--

LOCK TABLES `fp_forms_rate` WRITE;
/*!40000 ALTER TABLE `fp_forms_rate` DISABLE KEYS */;
/*!40000 ALTER TABLE `fp_forms_rate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_forms_recommendation`
--

DROP TABLE IF EXISTS `fp_forms_recommendation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_forms_recommendation` (
  `recommendation_ar` varchar(300) DEFAULT NULL,
  `recommendation_en` varchar(300) DEFAULT NULL,
  `action_ar` varchar(300) DEFAULT NULL,
  `action_en` varchar(300) DEFAULT NULL,
  `deadline_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_forms_recommendation`
--

LOCK TABLES `fp_forms_recommendation` WRITE;
/*!40000 ALTER TABLE `fp_forms_recommendation` DISABLE KEYS */;
/*!40000 ALTER TABLE `fp_forms_recommendation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_forms_result`
--

DROP TABLE IF EXISTS `fp_forms_result`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_forms_result` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `form_id` bigint(20) NOT NULL,
  `input_id` bigint(20) NOT NULL,
  `input_value_en` text NOT NULL,
  `input_value_ar` text NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `deadline_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_forms_result`
--

LOCK TABLES `fp_forms_result` WRITE;
/*!40000 ALTER TABLE `fp_forms_result` DISABLE KEYS */;
/*!40000 ALTER TABLE `fp_forms_result` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_forms_type`
--

DROP TABLE IF EXISTS `fp_forms_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_forms_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type_name_en` varchar(100) NOT NULL,
  `type_name_ar` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` tinyint(1) NOT NULL DEFAULT '0',
  `is_removable` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_forms_type`
--

LOCK TABLES `fp_forms_type` WRITE;
/*!40000 ALTER TABLE `fp_forms_type` DISABLE KEYS */;
INSERT INTO `fp_forms_type` VALUES (1,'Teaching','التدريس','2017-06-10 12:12:28','2017-06-10 12:12:28',0,0),(2,'Research','الابحاث','2017-06-10 12:12:28','2017-06-10 12:12:28',0,0),(3,'Service','الخدمات','2017-06-10 12:12:28','2017-06-10 12:12:28',0,0);
/*!40000 ALTER TABLE `fp_forms_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_general_information`
--

DROP TABLE IF EXISTS `fp_general_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_general_information` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `mobile_no` varchar(45) DEFAULT NULL,
  `personal_email` varchar(128) DEFAULT NULL,
  `contract_date` date DEFAULT NULL,
  `contract_type` tinyint(1) DEFAULT NULL,
  `contract_attachment` varchar(255) DEFAULT NULL,
  `cv_attachment` varchar(255) DEFAULT NULL,
  `cv_text_ar` text,
  `cv_text_en` text,
  `website` varchar(128) DEFAULT NULL,
  `twitter` varchar(128) DEFAULT NULL,
  `facebook` varchar(128) DEFAULT NULL,
  `linkedin` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_general_information`
--

LOCK TABLES `fp_general_information` WRITE;
/*!40000 ALTER TABLE `fp_general_information` DISABLE KEYS */;
/*!40000 ALTER TABLE `fp_general_information` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_language`
--

DROP TABLE IF EXISTS `fp_language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_language` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `language` varchar(128) DEFAULT NULL,
  `is_native` tinyint(1) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_language`
--

LOCK TABLES `fp_language` WRITE;
/*!40000 ALTER TABLE `fp_language` DISABLE KEYS */;
/*!40000 ALTER TABLE `fp_language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_project`
--

DROP TABLE IF EXISTS `fp_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_project` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `membership` varchar(128) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_project`
--

LOCK TABLES `fp_project` WRITE;
/*!40000 ALTER TABLE `fp_project` DISABLE KEYS */;
/*!40000 ALTER TABLE `fp_project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_research`
--

DROP TABLE IF EXISTS `fp_research`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_research` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `number` varchar(128) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `subject` varchar(128) DEFAULT NULL,
  `publish_type` tinyint(1) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `language` varchar(128) DEFAULT NULL,
  `summary` text,
  `attachment` varchar(128) DEFAULT NULL,
  `comments` text,
  `issn` varchar(128) DEFAULT NULL,
  `isi` varchar(128) DEFAULT NULL,
  `other` varchar(128) DEFAULT NULL,
  `isbn` varchar(128) DEFAULT NULL,
  `source` text,
  `published_in` varchar(128) DEFAULT NULL,
  `page_from` int(11) DEFAULT NULL,
  `page_to` int(11) DEFAULT NULL,
  `page_count` int(11) DEFAULT NULL,
  `original_type` tinyint(1) DEFAULT NULL,
  `original_language` varchar(128) DEFAULT NULL,
  `original_researcher` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `authors` text,
  `participant_count` int(11) DEFAULT NULL,
  `position_rank` int(11) DEFAULT NULL,
  `agreement_date` date DEFAULT NULL,
  `agreement_attachment` varchar(128) DEFAULT NULL,
  `country` varchar(128) DEFAULT NULL,
  `research_center` varchar(128) DEFAULT NULL,
  `research_budget` int(11) DEFAULT NULL,
  `support_party` varchar(128) DEFAULT NULL,
  `paper_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_research`
--

LOCK TABLES `fp_research` WRITE;
/*!40000 ALTER TABLE `fp_research` DISABLE KEYS */;
/*!40000 ALTER TABLE `fp_research` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_skill`
--

DROP TABLE IF EXISTS `fp_skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_skill` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(512) DEFAULT NULL,
  `rank` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_skill`
--

LOCK TABLES `fp_skill` WRITE;
/*!40000 ALTER TABLE `fp_skill` DISABLE KEYS */;
/*!40000 ALTER TABLE `fp_skill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_supervision`
--

DROP TABLE IF EXISTS `fp_supervision`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_supervision` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `thises_type` tinyint(1) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `level` tinyint(4) DEFAULT NULL,
  `thises_title_ar` varchar(128) DEFAULT NULL,
  `thises_title_en` varchar(128) DEFAULT NULL,
  `grant_date` date DEFAULT NULL,
  `researcher` text,
  `summary_ar` text,
  `summary_en` text,
  `attachment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_supervision`
--

LOCK TABLES `fp_supervision` WRITE;
/*!40000 ALTER TABLE `fp_supervision` DISABLE KEYS */;
/*!40000 ALTER TABLE `fp_supervision` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_training`
--

DROP TABLE IF EXISTS `fp_training`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_training` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `title` varchar(128) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `address` text,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_training`
--

LOCK TABLES `fp_training` WRITE;
/*!40000 ALTER TABLE `fp_training` DISABLE KEYS */;
/*!40000 ALTER TABLE `fp_training` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `institution`
--

DROP TABLE IF EXISTS `institution`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `institution` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) DEFAULT NULL,
  `name_ar` varchar(255) DEFAULT NULL,
  `univ_logo_en` varchar(255) DEFAULT NULL,
  `univ_logo_ar` varchar(255) DEFAULT NULL,
  `login_bg_en` varchar(255) DEFAULT NULL,
  `login_bg_ar` varchar(255) DEFAULT NULL,
  `cs_cover` varchar(255) DEFAULT NULL,
  `cr_cover` varchar(255) DEFAULT NULL,
  `fes_cover` varchar(255) DEFAULT NULL,
  `fer_cover` varchar(255) DEFAULT NULL,
  `ps_cover` varchar(255) DEFAULT NULL,
  `pr_cover` varchar(255) DEFAULT NULL,
  `ssr_cover` varchar(255) DEFAULT NULL,
  `sesr_cover` varchar(255) DEFAULT NULL,
  `vision_en` text,
  `vision_ar` text,
  `mission_en` text,
  `mission_ar` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `institution`
--

LOCK TABLES `institution` WRITE;
/*!40000 ALTER TABLE `institution` DISABLE KEYS */;
/*!40000 ALTER TABLE `institution` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `institution_goal`
--

DROP TABLE IF EXISTS `institution_goal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `institution_goal` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `institution_id` bigint(20) DEFAULT NULL,
  `title_en` tinytext,
  `title_ar` tinytext,
  `is_deleted` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `institution_goal`
--

LOCK TABLES `institution_goal` WRITE;
/*!40000 ALTER TABLE `institution_goal` DISABLE KEYS */;
/*!40000 ALTER TABLE `institution_goal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `institution_objective`
--

DROP TABLE IF EXISTS `institution_objective`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `institution_objective` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `institution_id` bigint(20) DEFAULT NULL,
  `title_en` tinytext,
  `title_ar` tinytext,
  `is_deleted` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `institution_objective`
--

LOCK TABLES `institution_objective` WRITE;
/*!40000 ALTER TABLE `institution_objective` DISABLE KEYS */;
/*!40000 ALTER TABLE `institution_objective` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(128) NOT NULL,
  `title` text NOT NULL,
  `criteria_id` bigint(20) DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=439 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (1,'1.1.1','The mission should be consistent with the establishment charter of the institution. (including any objectives or purposes in by-laws or regulations, company objectives or comparable documents.)',1,0),(2,'1.1.2','The mission should be appropriate for an institution of its type (for example a small private college, a research university, a women’s college in a regional community, etc.)',1,0),(3,'1.1.3','The mission should be consistent with Islamic beliefs and values.',1,0),(4,'1.1.4','The mission should be relevant to the needs of the community or communities served by the institution.',1,0),(5,'1.1.5','The mission should be consistent with the economic and cultural requirements of the Kingdom of Saudi Arabia.',1,0),(6,'1.1.6','The appropriateness of the mission should be explained to stakeholders in an accompanying written statement commenting on significant aspects of the environment within which the institution operates. (which may relate to local, national or international issues)',1,0),(7,'1.2.1','The mission statement should be sufficiently specific to provide an effective guide for decision-making and choices among alternative planning strategies.',2,0),(8,'1.2.2','The mission should be relevant to all of the institution’s important activities.',2,0),(9,'1.2.3','The mission should be achievable through effective strategies that can be implemented within the level of resources expected to be available.',2,0),(10,'1.2.4','The mission statement should be clear enough to provide criteria for evaluation of progress towards the institutions goals and objectives.',2,0),(11,'1.3.1','The mission should be defined in consultation with and with the support of major stakeholders in the institution and its community',3,0),(12,'1.3.2','The mission should be formally approved by the governing body of the institution.',3,0),(13,'1.3.3','The mission should be periodically reviewed and reaffirmed or amended as appropriate in the light of changing circumstances.',3,0),(14,'1.3.4','Stakeholders should be kept informed about the mission and any changes in it.',3,0),(15,'1.4.1','The mission should be used as the basis for a strategic plan over a specified medium term (eg. 5 year) planning period.',4,0),(16,'1.4.2','The mission should be publicised widely within the institution and action taken to ensure that it is known about and supported by teaching and other staff and students.',4,0),(17,'1.4.3','The mission should be consistently used as a guide in resource allocation and major program, project or policy decisions.',4,0),(18,'1.5.1','Medium and long term goals for the development of the institution and its programs and organizational units should be consistent with and support the mission.',5,0),(19,'1.5.2','Goals should be stated clearly enough to guide planning and decision making in ways that are consistent with the mission.',5,0),(20,'1.5.3','The goals for development should be periodically reviewed in the light of changing circumstances to ensure that they continue to be appropriate and support the mission.',5,0),(21,'1.5.4','Specific objectives established for total institutional initiatives and for activities of organizational units within it should be consistent with the mission and broader goals for development derived from it.',5,0),(22,'1.5.5','Statements of major objectives should be accompanied by specification of clearly defined and measurable indicators that are used to judge the extent to which objectives are being achieved.',5,0),(23,'1.5.1','Medium and long term goals for the development of the institution and its programs and organizational units should be consistent with and support the mission.',6,0),(24,'1.5.2','Goals should be stated clearly enough to guide planning and decision making in ways that are consistent with the mission.',6,0),(25,'1.5.3','The goals for development should be periodically reviewed in the light of changing circumstances to ensure that they continue to be appropriate and support the mission.',6,0),(26,'1.5.4','Specific objectives established for total institutional initiatives and for activities of organizational units within it should be consistent with the mission and broader goals for development derived from it.',6,0),(27,'1.5.5','Statements of major objectives should be accompanied by specification of clearly defined and measurable indicators that are used to judge the extent to which objectives are being achieved.',6,0),(28,'2.1.1','The governing body should have as its primary objective the effective development of the institution in the interests of its students and the communities it serves.',9,0),(29,'2.1.2','Membership of the governing body should include individuals with the range of perspectives and expertise needed to guide the educational policies of the institution.',9,0),(30,'2.1.3','The members of the governing body should be familiar with the range of activities of the institution and the needs of the communities it serves.',9,0),(31,'2.1.4','New members of the governing body should be thoroughly inducted into their role with information about the institution, and the role and processes of the governing body itself.',9,0),(32,'2.1.5','The governing body should periodically review the mission, goals and objectives of the institution through processes that give all sections of the community an opportunity to contribute their views.',9,0),(33,'2.1.6','The governing body should ensure that the mission, goals and objectives of the institution are reflected in detailed planning and activities.',9,0),(34,'2.1.7','The governing body should monitor and accept responsibility for the total operations of the institution, but avoid interference in management or academic affairs. If there are concerns about academic matters these should be referred back for further consideration but not changed by the governing body itself.',9,0),(35,'2.1.8','The governing body should establish sub committees (including members of the governing body, senior faculty and staff, and outside persons as appropriate) to give detailed consideration to major responsibilities such as finance and budget, staffing policies and remuneration, strategic planning, and facilities.',9,0),(36,'2.1.9','The responsibilities of the governing body should be defined in such a way that the respective roles and responsibilities of the governing body for overall policy and accountability, the senior administration for management, and the academic decision making structures for academic program development, are clearly differentiated, defined, and followed in practice.',9,0),(37,'2.1.10','In a private institution, the relative responsibilities of the governing body and the owners or company directors should be clearly defined and avoid interference in academic matters.',9,0),(38,'2.1.11','In their role as members of the governing body, those who are also members of faculty or staff of the institution should act in the interests of the institution as a whole rather than as representatives of sectional interests.',9,0),(39,'2.1.12','The governing body should regularly review its own effectiveness and develop and implement plans for improvement in the way it operates.',9,0),(40,'2.2.1','The responsibilities of administrators should be clearly defined in position descriptions.',10,0),(41,'2.2.2','Administrators should anticipate issues and opportunities and exercise initiative in response.',10,0),(42,'2.2.3','Administrators should ensure that action needed in their area of responsibility is taken in an effective and timely manner.',10,0),(43,'2.2.4','The levels of supervision and approval for academic affairs should provide for monitoring of quality and approval of major changes by senior administrators and the senior academic committee while allowing appropriate flexibility at course and program levels. (eg. departments should have delegated authority to change text and reference lists, modify planned teaching strategies, details of assessment tasks and updating of course content as far as possible subject to conditions set by the university council or other responsible authority.)(see also section 4.1.3)',10,0),(44,'2.2.5','Administrators should encourage teamwork and cooperation in achievement of institutional goals and objectives within their areas of responsibility.',10,0),(45,'2.2.6','Administrators at all levels in the institution should work cooperatively with colleagues in other sections of the institution to ensure effective overall functioning of the total institution.',10,0),(46,'2.2.7','Administrators at all levels should accept responsibility for the quality and effectiveness of activities within their area of responsibility regardless of whether those activities are undertaken by them personally or by others responsible to them.',10,0),(47,'2.2.8','When responsibilities are delegated to others this should be done appropriately within a clearly defined reporting and accountability framework.',10,0),(48,'2.2.9','Delegations should be formally specified in documents signed by the person delegating and the person given delegated authority, that describe clearly the limits of delegated responsibility and responsibility for reporting on decisions made.',10,0),(49,'2.2.10','Regulations governing delegations of authority should be established for the institution and approved by the governing board. These regulations should indicate key functions that cannot be delegated, and specify that delegation of authority to another person or organization does not remove responsibility for consequences of decisions made from the person giving the delegation.',10,0),(50,'2.2.11','Administrators should provide leadership, and encourage and reward initiative on the part of subordinates within clearly defined policy guidelines.',10,0),(51,'2.2.12','Regular and constructive feedback should be given on performance of subordinates in a manner that contributes to their personal and professional development',10,0),(52,'2.2.13','Senior administrators should ensure that submissions to the governing body are fully documented and presented in a form that clearly identifies policy issues for decision and the consequences of alternatives.',10,0),(53,'2.3.1','A comprehensive strategic plan that provides a planning framework for all sections within the institution should be developed for the institution as a whole.',11,0),(54,'2.3.2','Planning throughout the institution should be strategic, incorporating priorities for development and appropriate sequencing of action to produce the most effective short-term and long-term results.',11,0),(55,'2.3.3','Plans should take full and realistic account of aspects of the internal and external environment affecting development of the institution.',11,0),(56,'2.3.4','Planning processes should provide for appropriate levels of involvement and understanding with stakeholders throughout the institutional community.',11,0),(57,'2.3.5','Plans should be effectively communicated to all concerned, with impacts and requirements made clear for different constituencies.',11,0),(58,'2.3.6','Implementation of plans should be monitored with checks made against short term and medium term targets and outcomes evaluated.',11,0),(59,'2.3.7','Plans should be reviewed, adapted and modified, with corrective action taken as required in response to operational developments, formative evaluation, and changing circumstances.',11,0),(60,'2.3.8','Plans should be directly linked to information management systems that provide regular feedback on both ongoing routine activities and progress in strategic initiatives through key performance indicators and other information as required.',11,0),(61,'2.3.9','Risk assessment and management should be an integral component of planning strategies with appropriate mechanisms developed for risk assessment and minimization.',11,0),(62,'2.3.10','Strategic planning should be integrated with annual and longer term budget processes that provide for medium term adjustments as required.',11,0),(63,'2.4.1','Male and female sections should be adequately represented in the membership of relevant committees and councils and participate fully in decision making through processes that are consistent with bylaws and regulations of the Higher Council of Education.',12,0),(64,'2.4.2','There should be effective communication between members from each section on these committees and councils, and individuals in the different sections carrying out related activities should be fully involved in planning, evaluations and decision making.',12,0),(65,'2.4.3','Planning processes and mechanisms for performance evaluation should lead to comparable standards in each section while taking account of differing needs.',12,0),(66,'2.4.4','Quality indicators, evaluations and reports should show results for both sections indicating similarities and differences as well as overall performance.',12,0),(67,'2.5.1','Codes of practice for ethical and responsible behaviour should be established to require that teaching and other staff and students, and all committees and organizations, act consistently with high standards of ethical conduct and avoidance of plagiarism in the conduct and reporting of research, in teaching, performance evaluation and assessment, and in the conduct of administrative and service activities.',13,0),(68,'2.5.2','Policies and procedures should be regularly reviewed and modified as necessary to ensure continuing high standards of ethical conduct.',13,0),(69,'2.5.3','The institution should represent itself honestly and accurately to internal constituencies and external agencies and the general public. (Advertising and promotional material should always be truthful, provide complete information, and avoid any actual or implied misrepresentations or exaggerated claims, or negative comments about other institutions.)',13,0),(70,'2.5.4','Regulations should be established to provide for declarations of pecuniary interest and avoidance of conflict of interest and these regulations should be consistently followed. The regulations should apply to all staff, to the governing board and to all committees and other decision making bodies in the institution.',13,0),(71,'2.5.5','Hiring, disciplinary and dismissal practices should be clearly documented and administered in a way that ensures fair treatment for all Saudi Arabian and expatriate teaching and other staff, whether appointed on a full time or part time basis.',13,0),(72,'2.6.1','The institution should establish and maintain a policy and procedures manual setting out internal regulations and procedures for dealing with all major areas of activity within the institution.',14,0),(73,'2.6.2','Terms of reference or statements of responsibility should be established for major committees and administrative and academic positions within the institution and included in the policy and procedures manual.',14,0),(74,'2.6.3','Policies, regulations and related documents should be made available and kept in locations that are readily accessible to all teaching and other staff and students who are affected by them, including new members of teaching and other staff, and members of committees.',14,0),(75,'2.6.4','Student responsibilities, codes of conduct, and regulations affecting their behaviour should be specified and made known to students before they begin their studies at the institution and regularly thereafter.',14,0),(76,'2.6.5','A systemic program of review should be followed through which all policies, regulations, terms of reference and statements of responsibility are periodically reviewed.',14,0),(77,'2.7.1','Developing and maintaining a positive organizational climate should be taken seriously by senior administrators and appropriate strategies adopted and disseminated throughout the institution to achieve this result.',15,0),(78,'2.7.2','Opinions of teaching and other staff should be sought on major initiatives and information provided on how those opinions have been considered and responded to.',15,0),(79,'2.7.3','Significant achievements and contributions to the institution or the community by teaching and other staff or students should be recognized and appropriately acknowledged.',15,0),(80,'2.7.4','Information about issues, plans and developments at the institution should be regularly communicated to teaching and other staff through means such as newsletters, internal publications or electronic communications.',15,0),(81,'2.7.5','Responsibility should be given to a senior administrator or central unit to conduct periodic surveys dealing with issues relevant to organizational climate including such matters as job satisfaction, confidence in future development, sense of involvement in planning and development.',15,0),(82,'2.8.1','The institution should ensure that there is consistency between the functions of any associated companies or controlled entities and the establishment charter and mission of the institution.',16,0),(83,'2.8.2','Policies affecting the controlled entity including administrative and financial relationships with the institution should be clearly specified.',16,0),(84,'2.8.3','Reporting mechanisms should be established that ensure that the governing body has effective oversight of the activities of the controlled entity.',16,0),(85,'2.8.4','Audited financial reports on the financial affairs of the controlled entity should be reviewed regularly by the relevant committee of the governing body.',16,0),(86,'2.8.5','Administrative arrangements and planning mechanisms for activities of the controlled entity should provide for adequate risk assessment including protection for the institution against financial or legal liabilities.',16,0),(87,'2.8.6','In any arrangement under which an institution contracts out to another organization the provision of services to students or to future students (eg. a preparatory year program) the service contract should include requirements to meet all relevant quality standards. (The institution will be held responsible for ensuring the standards are met.)',16,0),(88,'3.1.1','The Rector or Dean should give strong support for quality assurance improvement activities.',19,0),(89,'3.1.2','Adequate resources should be provided for the leadership and management of quality assurance processes.',19,0),(90,'3.1.3','All teaching and other staff should participate in self-evaluations and cooperate with reporting and improvement processes in their sphere of activity.',19,0),(91,'3.1.4','Innovation and creativity should be encouraged at all levels in the organization within a framework of clear policy guidelines and accountability processes.',19,0),(92,'3.1.5','Mistakes and weaknesses should be recognized by those responsible and used as a basis for planning for improvement.',19,0),(93,'3.1.6','Improvements in performance and outstanding achievements should be recognized',19,0),(94,'3.1.7','Evaluation and planning for improvement should be integrated into normal planning processes.',19,0),(95,'3.2.1','All academic and administrative units within the institution (including the governing body and senior management) should participate in the processes of quality assurance and improvement',20,0),(96,'3.2.2','Regular evaluations should be carried out and reports prepared that provide an overview of performance for the institution as a whole and for organizational units and major functions within it',20,0),(97,'3.2.3','Evaluations should consider inputs and processes and outcomes but give particular attention to quality of outcomes.',20,0),(98,'3.2.4','Evaluations should deal with performance in relation to continuing routine activities as well as to strategic objectives.',20,0),(99,'3.2.5','Evaluations should ensure that required standards are met, and also that there is continuing improvement in performance.',20,0),(100,'3.2.6','Institutional research relevant to the achievement of the institution’s goals and objectives and the monitoring and improvement of quality should be carried out and the results made known to senior management and the institutional community.',20,0),(101,'3.3.1','Responsibility should be assigned and sufficient time given for a senior member of faculty to provide guidance and support for the quality processes within the institution.',21,0),(102,'3.3.2','A quality center should be established within the institution’s central administration and sufficient staff, resources and administrative support given for the center to operate effectively.',21,0),(103,'3.3.3','A quality committee should be formed with members drawn from all major sections of the institution. (as a general guideline this might involve 12 to 15 members and in a large institution might require representatives from groups of colleges in similar fields rather than from each college)',21,0),(104,'3.3.4','A member of the institution’s senior administration should be appointed to chair the committee. (This person should normally be at the level of a vice rector in a university or a deputy dean in a college and work closely with the director of the quality center in leading and supporting quality initiatives throughout the institution.)',21,0),(105,'3.3.5','The roles and responsibilities of the quality center and committee, and the relationship of these to other administrative and planning units should be clearly specified.',21,0),(106,'3.3.6','If quality assurance functions are managed by more than one organizational unit, their activities should be effectively coordinated under the supervision of a senior administrator',21,0),(107,'3.3.7','Quality assurance functions throughout the organization should be fully integrated into normal planning and development strategies in a defined cycle of planning, implementation, assessment and review.',21,0),(108,'3.3.8','Evaluations should be (i) based on evidence, (ii) linked to appropriate standards, (iii) include predetermined performance indicators, and (iv) take account of independent verification of interpretations.',21,0),(109,'3.3.9','Common forms and survey instruments should be used for similar activities across the institution (eg. courses, programs, libraries, etc) and responses used in independent analyses of results including trends over time. (This does not preclude additional questions relevant to different programs or special instruments dealing with particular functions eg. specialized libraries or student services) Survey data should be collected from students and analysed for individual courses, the program as a whole, and also from graduates and employers of those graduates.',21,0),(110,'3.3.10','Statistical data (including pass rates, progression and completion rates and other data required for indicators) should be retained in an accessible central data base and provided routinely and promptly to colleges and departments (normally each semester or at least annually) for their use in preparation of reports on indicators and other tasks in monitoring quality.',21,0),(111,'3.3.11','The quality assurance arrangements should themselves be regularly evaluated, reported on and improved in a comparable manner to other functions within the institution. As part of these reviews unnecessary requirements should be removed to streamline the system and avoid unnecessary work.',21,0),(112,'3.3.12','Processes for evaluation of quality should be transparent with criteria for judgments and evidence considered made clear.',21,0),(113,'3.4.1','A limited number of key performance indicators that are capable of objective measurement should be identified for monitoring and evaluation of the performance of sections within the institution (including colleges and departments) and of the institution as a whole.',22,0),(114,'3.4.2','Additional key performance indicators should be selected for monitoring the performance of different academic and administrative units within the institution.',22,0),(115,'3.4.3','When functions are carried out in a number of different academic or administrative units there should be some common indicators and these should be used for comparisons of performance within the institution as well as for overall institutional evaluation.',22,0),(116,'3.4.4','Benchmarks for comparing quality of performance should be established for the institution as a whole, and for academic and administrative units. These benchmarks should include past performance at the institution but must also include appropriate external comparisons for selected important items',22,0),(117,'3.4.5','Key performance indicators and benchmarks identified for major organizational units or functions should be approved by the appropriate senior committee or council within the institution (eg. senior academic committee, university council)',22,0),(118,'3.4.6','The format for specifying indicators and benchmarks should be consistent across the institution.',22,0),(119,'3.5.1','Self-evaluations of quality of performance should whenever possible be based on several related sources of evidence including feedback through user surveys and opinions of stakeholders such as students and teaching staff, graduates and employers.',23,0),(120,'3.5.2','Conclusions based on interpretations of evidence should be verified through independent advice. This advice should be provided by persons familiar with the type of activity ',23,0),(121,'3.5.3','Standards of learning outcomes achieved by students should be checked in relation to the requirements of the National Qualifications Framework and standards at other comparable institutions',23,0),(122,'4.1.1','New program proposals and proposals for major changes in programs should be thoroughly evaluated and approved by the institution’s senior academic committee.',26,0),(123,'4.1.2','The evaluation of new programs or major changes in programs by the senior academic committee should include consideration of the matters described in the standard for learning and teaching, including any special requirements applicable to the field of study concerned, and requirements for graduates in that field in Saudi Arabia.',26,0),(124,'4.1.3','Guidelines should be established defining the levels for reviewing indicators and reports on courses and programs. (for example a head of department might review and approve course reports for all courses and a departmental committee approve minor changes to keep courses up to date. A dean might review and approve program reports that include summary information about courses. The vice rector responsible for academic affairs, the quality committee and the senior academic committee might review and approve a general summary of program reports and data on key performance indicators, and approve more significant changes in programs.',26,0),(125,'4.1.4','Senior academic committees should delegate and establish guidelines defining the levels for approval of changes in courses and programs. Minor changes required to keep programs up to date and respond to course and program evaluations should be made flexibly and rapidly at departmental level and more substantial changes referred to the relevant senior committees for approval',26,0),(126,'4.1.5','Data on key performance indicators for all programs should be reviewed at least annually by senior administrators responsible for academic affairs, the institution’s quality committee and the institution’s senior academic committee, with overall institutional performance reported to the governing board.',26,0),(127,'4.1.6','The institution should ensure that annual reports for all programs are prepared, and reviewed by department/college committees, and appropriate action taken in response to action recommendations in those reports.',26,0),(128,'4.1.7','The institution should ensure that self evaluations using the self evaluation scales for higher education programs are undertaken periodically (eg. every two or three years) for each program and reports prepared for consideration by the quality committee and the relevant academic committees.',26,0),(129,'4.1.8','Reports on the overall quality of programs for the institution as a whole should be prepared periodically (eg. every three years) for consideration within the institution indicating common strengths and weaknesses, and significant variations in quality between programs/departments and sections.',26,0),(130,'4.1.9','Reports by departments to their college, or by departments or colleges to the central administration should be appropriately acknowledged with responses made to any queries or proposals made.',26,0),(131,'4.1.10','The senior administrator responsible for academic affairs should take responsibility, in cooperation with the quality committee and deans/heads of department, for developing and implementing strategies for improvement when required, to deal with common issues affecting programs across the institution.',26,0),(132,'4.1.11','Colleges/departments should cooperate with and support participation in general institutional strategies for improvement, and take additional initiatives to deal with quality issues found in their own programs.',26,0),(133,'4.1.12','If programs are offered in different sections, including sections for male and female students, or in branch campuses, the standards of learning outcomes, the resources provided (including learning resources and staffing provisions and resources to undertake research) should be comparable in all sections. Data used for evaluations and performance indicators should be provided for all sections as well as for the programs in total.',26,0),(134,'4.2.1','Relevant academic and professional advice should be considered when defining intended learning outcomes.',27,0),(135,'4.2.2','Intended learning outcomes should be consistent with the National Qualifications Framework. (covering all of the domains of learning at the standards required).',27,0),(136,'4.2.3','Programs leading to professional qualifications should develop learning outcomes that meet requirements for professional practice in the Kingdom of Saudi Arabia in the fields concerned. (These requirements should include local accreditation requirements and also take account of international accreditation requirements for that field of study, and any Saudi Arabian regulations or regional needs.)',27,0),(137,'4.2.4','Any special student attributes specified by the institution for its graduates should be incorporated as intended learning outcomes in all programs offered and appropriate teaching strategies and forms of student assessment used for them.',27,0),(138,'4.2.5','Appropriate program evaluation mechanisms, including graduating student surveys, employment outcome data, employer feedback and subsequent performance of graduates, should be used to provide evidence about the appropriateness of intended learning outcomes and the extent to which they are achieved.',27,0),(139,'4.3.1','Plans for delivery and evaluation of programs should be set out in detailed program specifications that include knowledge and skills to be acquired, and strategies for teaching and assessment for the progressive development of learning in all the domains of learning.',28,0),(140,'4.3.2','Plans for courses should be set out in course specifications that include knowledge and skills to be acquired and strategies for teaching and assessment for the domains of learning to be addressed in each course.',28,0),(141,'4.3.3','The content and strategies set out in course specifications should be coordinated and followed in practice to ensure effective progressive development of learning for the total program in all the domains of learning. ',28,0),(142,'4.3.4','Planning should include any action necessary to ensure that teaching staff are familiar with and are able to use the strategies included in the program and course specifications.',28,0),(143,'4.3.5','The academic or professional fields for which students are being prepared should be monitored on a continuing basis with necessary adjustments made in programs and in text and reference materials to ensure continuing relevance and quality.',28,0),(144,'4.3.6','In all professional programs continuing advisory panels with membership that includes leading practitioners from the relevant occupations or professions should be used to monitor and advise on content and quality of programs.',28,0),(145,'4.3.7','New program proposals or major changes in programs should be assessed and approved or rejected by the institution’s senior academic committee using criteria that ensure thorough and appropriate consultation in planning and capacity for effective implementation.',28,0),(146,'4.4.1','Courses and programs should be evaluated and reported on annually and reports should include information about the effectiveness of planned strategies and the extent to which intended learning outcomes are being achieved.',29,0),(147,'4.4.2','When changes are made as a result of evaluations details of those changes and the reasons for them should be retained in course and program portfolios.',29,0),(148,'4.4.3','Quality indicators that include learning outcome measures should be established for all courses and programs.',29,0),(149,'4.4.4','Records of student completion rates should be kept for all courses and for programs as a whole and included among quality indicators.',29,0),(150,'4.4.5','Reports on programs should be reviewed annually by senior administrators and quality committees',29,0),(151,'4.4.6','Systems should be established for central recording and analysis of course completion and program progression and completion rates and student course and program evaluations, with summaries and comparative data distributed automatically to departments, colleges, senior administrators and relevant committees at least once each year.',29,0),(152,'4.4.7','If problems are found through program evaluations appropriate action should be taken to make improvements, either within the program concerned or through institutional action as appropriate.',29,0),(153,'4.4.8','In addition to annual evaluations a comprehensive reassessment of every program should be conducted at least once every five years. Policies and procedures for conducting these reassessments should be published within the institution.',29,0),(154,'4.4.9','Program reviews should involve experienced people from relevant industries and professions, and experienced faculty from other institutions.',29,0),(155,'4.4.10','In program reviews opinions about the quality of the program including the extent to which intended learning outcomes are achieved should be sought from students and graduates through surveys and interviews, discussions with faculty, and other stakeholders such as employers.',29,0),(156,'4.5.1','Student assessment mechanisms should be appropriate for the different forms of learning sought.',30,0),(157,'4.5.2','Assessment practices should be clearly communicated to students at the beginning of courses.',30,0),(158,'4.5.3','Appropriate, valid and reliable mechanisms should be used in programs throughout the institution for verifying standards of student achievement in relation to relevant internal and external benchmarks. The standard of work required for different grades should be consistent over time, comparable in courses offered within a program and college and the institution as a whole, and in comparison with other highly regarded institutions. (Arrangements for verifying standards may include measures such as check marking of random samples of student work by teaching staff at other institutions, and independent comparisons of standards achieved with other comparable institutions within Saudi Arabia, and internationally.)',30,0),(159,'4.5.4','Grading of students tests, assignments and projects should be assisted by the use of matrices or other means to ensure that the planned range of domains of student learning outcomes are addressed.',30,0),(160,'4.5.5','Arrangements should be made within the institution for training of teaching staff in the theory and practice of student assessment.',30,0),(161,'4.5.6','Policies and procedures should include action to be taken to deal with situations where standards of student achievement are inadequate or inconsistently assessed.',30,0),(162,'4.5.7','Effective procedures should be used to ensure that work submitted by students is actually done by the students concerned.',30,0),(163,'4.5.8','Feedback to students on their performance and results of assessments during each semester should be given promptly and accompanied by mechanisms for assistance if needed.',30,0),(164,'4.5.9','Assessments of student work should be conducted fairly and objectively.',30,0),(165,'4.5.10','Criteria and processes for academic appeals are made known to students and administered equitably',30,0),(166,'4.6.1','Teaching staff should be available at sufficient scheduled times for both full time and part time students as appropriate for consultation and advice to students. (this should be confirmed, not assumed because of planned arrangements).',31,0),(167,'4.6.2','Teaching resources (including staffing, learning resources and equipment, and clinical or other field placements) should be sufficient to ensure achievement of the intended learning outcomes.',31,0),(168,'4.6.3','If arrangements for student academic counselling and advice include electronic communications through email or other means the effectiveness of those processes should be evaluated through means such as analysis of response times and student evaluations.',31,0),(169,'4.6.4','Adequate tutorial assistance should be provided to ensure understanding and ability to apply learning.',31,0),(170,'4.6.5','Appropriate preparatory and orientation mechanisms should be used to prepare students for study in a higher education environment. Particular attention should be given to preparation for the language of instruction, self directed learning, and transition programs if necessary for students transferring to the institution with credit for previous studies. Preparatory studies must not be counted within the minimum credit hour requirements for programs.',31,0),(171,'4.6.6','For any programs in which the language of instruction isother than Arabic, action should be taken to ensure that language skills are adequate for instruction in that language when students begin their studies. (This may be done through language training prior to admission to the program. Language skills expected on entry should be benchmarked against other highly regarded institutions with the objective of skills at least comparable to minimum requirements for admission of international students in universities in countries where that language is the native language. The benchmarking process should involve testing of at least a representative sample of students on major recognized language tests)',31,0),(172,'4.6.7','If preparatory programs in other languages or other areas of learning are required and outsourced to other providers the institution offering the higher education program to which they are admitted must still accept responsibility for the effectiveness of those services and for ensuring the required standards for admission are met.',31,0),(173,'4.6.8','Systems should be established within each program for monitoring and coordinating student workload across courses.',31,0),(174,'4.6.9','Systems should be in place for monitoring the progress of individual students with assistance and/or counselling given to those facing difficulties.',31,0),(175,'4.6.10','Year to year progression rates and program completion rates should be monitored and analysed to identify and provide assistance to any categories of students who may be having difficulty.',31,0),(176,'4.6.11','Adequate facilities should be provided for private study, with access to computer terminals and other necessary equipment.',31,0),(177,'4.6.12','Teaching staff should be familiar with the range of support services available in the institution for students, and should refer them to appropriate sources of assistance when required.',31,0),(178,'4.6.13','The adequacy of arrangements for assistance to students should be periodically assessed through processes that include, but are not restricted to, feedback from students.',31,0),(179,'4.7.1','Effective orientation and training programs should be provided within the institution for new, short term and part time staff. (To be effective these programs should ensure that teaching staff are fully briefed on required learning outcomes, on planned teaching and assessment strategies, and the contribution of their course to the program as a whole.)',32,0),(180,'4.7.2','Teaching strategies should be appropriate for the different types of learning outcomes programs are intended to develop.',32,0),(181,'4.7.3','Strategies of teaching and assessment set out in program and course specifications should be followed by teaching staff with flexibility to meet the needs of different groups of students.',32,0),(182,'4.7.4','Students should be fully informed about course requirements in advance through course descriptions that include knowledge and skills to be developed, work requirements and assessment processes.',32,0),(183,'4.7.5','The conduct of courses should be consistent with the outlines provided to students and with the course specifications.',32,0),(184,'4.7.6','Textbooks and reference material should be up to date and incorporate the latest developments in the field of study.',32,0),(185,'4.7.7','Textbooks and other required materials should be available in sufficient quantities before classes commence.',32,0),(186,'4.7.8','Attendance requirements in courses should be made clear to students and compliance with these requirements monitored and enforced.',32,0),(187,'4.7.9','Effective systems including but not limited to student surveys should be used for evaluation of courses and of teaching.',32,0),(188,'4.7.10','The effectiveness of planned teaching strategies in achieving different types of learning outcomes should be regularly assessed and adjustments should be made in response to evidence about their effectiveness.',32,0),(189,'4.7.11','Reports should be provided to program administrators on the delivery of each course and these should include details if any planned content could not be dealt with and any difficulties found in using planned strategies.',32,0),(190,'4.7.12','Appropriate adjustments should be made in plans for teaching after consideration of course reports.',32,0),(191,'4.8.1','Training programs in teaching skills should be provided within the institution for both new and continuing teaching staff including those with part time teaching responsibilities.',33,0),(192,'4.8.2','Training programs in teaching should include effective use of new and emerging technology.',33,0),(193,'4.8.3','Adequate opportunities should be provided for additional professional and academic development of teaching staff, with special assistance given to any who are facing difficulties.',33,0),(194,'4.8.4','The extent to which teaching staff are involved in professional development to improve quality of teaching should be monitored.',33,0),(195,'4.8.5','Teaching staff should be encouraged to develop strategies for improvement of their own teaching and to maintain a portfolio of evidence of evaluations and strategies for improvement.',33,0),(196,'4.8.6','Formal recognition should be given to outstanding teaching, and encouragement given for innovation and creativity.',33,0),(197,'4.8.7','Strategies for improving quality of teaching should include improving the quality of learning materials and the teaching strategies incorporated in them.',33,0),(198,'4.9.1','Teaching staff should have appropriate qualifications and experience for the courses they teach. (For undergraduate and masters degree programs this would normally require academic qualifications in their specific teaching area at least one level above that of the program in which they teach.)',34,0),(199,'4.9.2','If part time teaching staff are appointed there should be an appropriate mix of full time and part time teaching staff. (As a general guideline at least 75 % of teaching staff should be employed on a full time basis).',34,0),(200,'4.9.3','All teaching staff should be involved on a continuing basis in scholarly activities that ensure they remain up to date with the latest developments in their field and can involve their students in learning that incorporates those developments.',34,0),(201,'4.9.4','Full time staff teaching post-graduate courses should be active in scholarship and research in the fields of study they teach.',34,0),(202,'4.9.5','In professional programs teaching teams should include some experienced and highly skilled professionals in the field.',34,0),(203,'4.10.1','In programs that include field experience the intended student learning outcomes from the field experience should be clearly specified and effective processes followed to ensure that those learning outcomes, and strategies to develop that learning, are understood by students and supervising staff in the field setting.',35,0),(204,'4.10.2','Supervising staff in field locations should be thoroughly briefed on their role and the relationship of the field experience to the program as a whole.',35,0),(205,'4.10.3','Teaching staff from the institution should visit the field setting for observations and consultations with students and field supervisors often enough to provide proper oversight and support. (Normally at least twice during a field experience activity)',35,0),(206,'4.10.4','Students should be thoroughly prepared for participation in the field experience through briefings and descriptive material.',35,0),(207,'4.10.5','Students should be required to prepare a report on their field experience that is appropriate for the nature of the activity and the learning outcomes expected.',35,0),(208,'4.10.6','Arrangements should be made through follow up meetings or classes for students to reflect on and generalize from their experience, applying that experience to situations likely to be faced in later employment.',35,0),(209,'4.10.7','Field experience placements that are selected should have the capacity to develop the learning outcomes sought and their effectiveness in developing that learning should be evaluated.',35,0),(210,'4.10.8','If supervisors in the field setting and teaching staff from the institution are both involved in student assessments, criteria for assessment should be clearly specified and explained, and procedures established for reconciling differing opinions.',35,0),(211,'4.10.9','Provision should be made for evaluations of the field experience activity by students, by supervising staff in the field setting, and by teaching staff of the institution, and the results of those evaluations considered in subsequent planning.',35,0),(212,'4.10.10','Preparations for the field experience should include a thorough risk assessment for all parties involved, and plans for responsible staff to minimize and deal with those risks.',35,0),(213,'4.11.1','The respective responsibilities of the local institution and the partner should be clearly defined in formal agreements enforceable under the laws of Saudi Arabia.',36,0),(214,'4.11.2','The effectiveness of the partnership arrangements should be regularly reviewed.',36,0),(215,'4.11.3','Briefings and consultations on course and program requirements should be adequate, and effective mechanisms should be available for ongoing consultation on emerging issues.',36,0),(216,'4.11.4','Teaching staff from the partner institution who are familiar with the content of courses offered under the partnership arrangement should visit the local institution regularly for consultation about course details and standards of assessments.',36,0),(217,'4.11.5','If arrangements involve assessment of student work by the partner institution in addition to assessments within the local institution, procedures should be used that ensure that final assessments are completed promptly and results made available to students within the time specified for reporting of student results under Saudi Arabian regulations.',36,0),(218,'4.11.6','If programs are based on those of partner institutions, courses, assignments and examinations should be adapted to the local environment, avoid unfamiliar colloquial expressions, and use examples and illustrations relevant to the local setting where the programs are to be offered. This may require amended and/or supplementary materials, and special tutorial assistance to apply learning to the local environment',36,0),(219,'4.11.7','Programs and courses should be consistent with the requirements of the Qualifications Framework for Saudi Arabia, and in vocational or professional programs, include regulations and conventions relevant to the Saudi Arabian environment.',36,0),(220,'4.11.8','If courses or programs developed by a partner institution are delivered in Saudi Arabia adequate processes should be followed to ensure that standards of student achievement are at least equal to those achieved elsewhere by the partner institution as well as by other appropriate institutions selected for benchmarking purposes.',36,0),(221,'4.11.9',' If an international institution or other organization is invited to provide programs, or to assist in the development of programs for use in Saudi Arabia full information should be provided in advance about relevant Ministry regulations and NCAAA requirements for the National Qualifications Framework and requirements for program and course specifications and reports.',36,0),(222,'5.1.1','Student registration processes should not be unduly time consuming and should be simple for students to use',39,0),(223,'5.1.2','Computerized systems used for admission processes should be linked to data recording and retrieval systems. (For example to fee payment requirements if applicable, the issue of student identity cards, program and course registrations, and statistical reporting requirements.)',39,0),(224,'5.1.3','Admissions requirements should be clearly specified and appropriate for the institution and its programs',39,0),(225,'5.1.4','Admission requirements should be consistently and fairly applied.',39,0),(226,'5.1.5','If programs or courses include components offered by distance education, or use of e-learning in blended programs information should be provided before enrolment about any special skills or resources needed to study in these modes. (For distance education programs a separate set of standards that include requirements for that mode of program delivery are set out in a a different document, Standards for Quality Assurance and Accreditation of Higher Education Programs Offered by Distance Education.)',39,0),(227,'5.1.6','Student fees, if required, should be paid at the time of registration unless specific approval has been given in advance for deferral of payments.',39,0),(228,'5.1.7','If the institution’s regulations provide for deferral of payments, the conditions and dates for payment should be clearly specified in a formal agreement signed by the student and witnessed, and opportunities for financial counselling provided.',39,0),(229,'5.1.8','Student advisors familiar with details of course requirements should be available to provide assistance prior to and during the student registration process.',39,0),(230,'5.1.9','Rules governing admission with credit for previous studies should be clearly specified.',39,0),(231,'5.1.10','Decisions on credit for previous studies should be made known to students by qualified faculty or authorized staff before classes commence.',39,0),(232,'5.1.11','Complete information about the institution, including the range of courses and programs, program requirements, costs, services and other relevant information should be publicly available to potential students and families prior to applications for admission.',39,0),(233,'5.1.12','A comprehensive orientation program should be available for beginning students to ensure thorough understanding of the range of services and facilities available to them, and of their obligations and responsibilities.',39,0),(234,'5.2.1','Effective security should be provided for student records. (Central files containing cumulative records of student’s enrolment and performance should be maintained in a secure area with back up files kept in a different and secure location, preferably in a different building or off campus).',40,0),(235,'5.2.2','Formal policies should be developed to specify the content of permanent student records and their retention and disposal.',40,0),(236,'5.2.3','The student record system should regularly provide statistical data required for planning, reporting and quality assurance to departments, colleges, the quality center and senior managers.',40,0),(237,'5.2.4','Clear rules should be established and maintained governing privacy of information and controlling access to individual student records.',40,0),(238,'5.2.5','Automated procedures should be in place for monitoring student progress throughout their programs.',40,0),(239,'5.2.6','Timelines for reporting and recording results and updating records should be clearly defined and adhered to.',40,0),(240,'5.2.7','Results should be finalized, officially approved, and communicated to students within times specified in institutional and Ministry requirements.',40,0),(241,'5.2.8','Eligibility for graduation should be formally verified in relation to program and course requirements.',40,0),(242,'5.3.1','A code of behaviour should be approved by the governing body and made widely available within the institution, specifying rights and responsibilities of students.',41,0),(243,'5.3.2','Regulations should specify action to be taken for breaches of student discipline including the responsibilities of relevant officers and committees, and penalties, which may be imposed.',41,0),(244,'5.3.3','Disciplinary action should be taken promptly, and full documentation including details of evidence should be retained in secure institutional records.',41,0),(245,'5.3.4','Student appeal and grievance procedures should be specified in regulations, published, and made widely known within the institution. The regulations should make clear the grounds on which academic appeals may be based, the criteria for decisions, and the remedies available.',41,0),(246,'5.3.5','Appeal and grievance procedures should protect against time wasting on trivial issues, but still provide adequate opportunity for matters of concern to students to be fairly dealt with and supported by student counselling provisions.',41,0),(247,'5.3.6','Appeal and grievance procedures should guarantee impartial consideration by persons or committees independent of the parties involved in the issue, or who made a decision or imposed a penalty that is being appealed against.',41,0),(248,'5.3.7','Procedures should be established to ensure that students are protected against subsequent punitive action or discrimination following consideration of a grievance or appeal.',41,0),(249,'5.3.8','Appropriate policies and procedures should be in place to deal with academic misconduct, including plagiarism and other forms of cheating.',41,0),(250,'5.4.1','The range of services provided and the resources devoted to them should reflect the mission of the institution and any special requirements of the student population.',42,0),(251,'5.4.2','Formal plans should be developed for the provision and improvement of student services and the implementation and effectiveness of those plans should be monitored on a regular basis.',42,0),(252,'5.4.3','A senior member of teaching or other staff should be assigned responsibility for oversight and development of student services.',42,0),(253,'5.4.4','The effectiveness and relevance of services should be regularly monitored through processes that include surveys of student usage and satisfaction. Services should be modified in response to evaluation and feedback.',42,0),(254,'5.4.5','Adequate facilities and financial support should be provided for the student services that are needed.',42,0),(255,'5.4.6','If services are provided through student organizations, assistance should be given in management and organization if required, and there should be effective oversight of financial management and reporting.',42,0),(256,'5.4.7','If student newspapers or other student documents are published there should be clear guidelines defining publication standards and editorial policy and the extent and nature of oversight by the institution.',42,0),(257,'5.5.1','Student medical services should be staffed by people with the necessary professional qualifications.',43,0),(258,'5.5.2','Medical services should be readily accessible with provision made for emergency assistance when required. (Fees for services may be charged and they may be provided on a part time basis.)',43,0),(259,'5.5.3','Provision should be made for academic counselling and for career planning and employment advice in colleges, departments or other appropriate locations within the institution.',43,0),(260,'5.5.4','Personal or psychological counselling services should be made available with easy access for students from any part of the institution.',43,0),(261,'5.5.5','Adequate protection should be provided, and supported by regulations or a code of conduct, to protect the confidentiality of academic or personal issues discussed with teaching or other staff or students.',43,0),(262,'5.5.6','Effective mechanisms should be established for follow up to ensure student welfare and to evaluate quality of service. ',43,0),(263,'5.6.1','Opportunities should be provided for participation in religious observances consistent with Islamic beliefs and traditions.',44,0),(264,'5.6.2','Arrangements should be made to organize and encourage student participation in cultural activities such as clubs and societies, and special events in the arts and other fields appropriate to their interests and needs.',44,0),(265,'5.6.3','Opportunities should be provided through appropriate facilities and organizational arrangements for informal social interaction among students.',44,0),(266,'5.6.4','Participation in sports should be encouraged, both for skilled athletes and for others, and appropriate competitive and non-competitive physical activities in which they can be involved should be arranged.',44,0),(267,'5.6.5','The extent of student participation in extra-curricular activities should be monitored and benchmarked against other comparable institutions, and where necessary strategies developed to improve levels of participation',44,0),(268,'6.1.1','Policies guiding the provision of library/resource center services should give special attention to support for the particular educational programs and research requirements of the institution.',47,0),(269,'6.1.2','A learning resource strategy should be developed which is directly linked to strategic priorities for program development, and adjusted as required as new programs are introduced.',47,0),(270,'6.1.3','The adequacy of library and resource center materials should be monitored continually and formally evaluated at least once every two years.',47,0),(271,'6.1.4','Evaluation procedures should include user surveys dealing with effectiveness in meeting user needs (considering teaching staff and student satisfaction, extent of usage, consistency with requirements of teaching and learning at the institution, range of services provided, and comparisons with other comparable institutions).',47,0),(272,'6.1.5','Evaluation processes include analysis of data on usage of resources in relation to teaching and learning requirements for different programs in the institution.',47,0),(273,'6.1.6','Advice should be obtained from teaching staff responsible for courses and programs about requirements to support teaching and learning in sufficient time for appropriate provision to be made.',47,0),(274,'6.1.7','Reserve book collections and other reference materials should be regularly reviewed with advice from teaching staff to ensure adequate access to necessary materials for courses on offer at any time.',47,0),(275,'6.2.1','Library and resource centers and associated facilities and services should be available for extended hours beyond normal class time to ensure access when required by users.',48,0),(276,'6.2.2','Collections should be arranged catalogued according to internationally recognized good library practice.',48,0),(277,'6.2.3','Agreements should be made for cooperation with other libraries and resource centers for interlibrary loans and sharing of resources and services. ',48,0),(278,'6.2.4','Reliable systems should be used for recording loans and returns, with efficient follow up for overdue material.',48,0),(279,'6.2.5','Heavy-demand and required reading materials should be held in in a reserve collection.',48,0),(280,'6.2.6','There should be reliable and efficient access to on-line data-bases and research and journal material relevant to the institution’s programs.',48,0),(281,'6.2.7','Rules for behaviour within the library should be established and enforced to ensure maintenance of an environment conducive to effective study and student and staff research.',48,0),(282,'6.2.8','Effective security systems should be used to prevent loss of materials and inappropriate use of the internet.',48,0),(283,'6.4.1','Adequate financial resources must be provided for acquisitions, cataloguing, equipment, and for services and system development.',49,0),(284,'6.4.2','The availability of on line access and inter library loan facilities should not be used to reduce commitment to providing adequate physical resources on-site.',49,0),(285,'6.4.3','Adequate facilities should be provided to house collections in a way that makes them readily accessible.',49,0),(286,'6.4.4','Up to date computer equipment and software should be provided to support electronic access to resources and reference material. ',49,0),(287,'6.4.5','Copying facilities supported by efficient payment mechanisms for users should be provided.',49,0),(288,'6.4.6','Facilities should be available for using personal laptop computers.',49,0),(289,'6.4.7','Books, journals and other materials should be available in Arabic and English (or other languages) as required for programs taught and research undertaken in the institution.',49,0),(290,'6.4.8','Facilities should be provided for both individual and small group study and research.',49,0),(291,'6.4.9','The level of provision of facilities and resources (numbers of books, seats, group study facilities etc) should be benchmarked against good quality similar institutions and be adequate for the size of the institution and the programs offered.',49,0),(292,'7.1.1','A long-term master plan that provides for capital developments and maintenance of facilities and equipment should be approved by the governing body.',52,0),(293,'7.1.2','Equipment planning should provide plans and schedules for major equipment acquisition, servicing and replacement.',52,0),(294,'7.1.3','Future users of facilities or major equipment should be involved in detailed consultations prior to acquisitions or development to ensure that current and anticipated future needs are met.',52,0),(295,'7.1.4','Equipment policies should ensure to the greatest feasible extent, compatibility of equipment and systems across the institution.',52,0),(296,'7.1.5','Business plans should be prepared prior to major equipment acquisitions, with evaluation of alternatives of leasing or shared use with other agencies.',52,0),(297,'7.1.6','Proposals for leasing of major facilities and for outsourced building and management of facilities should be fully evaluated in the long-term interests of the institution and managed in a way that ensures effective quality control and financial benefits.',52,0),(298,'7.2.1','A clean, attractive and well maintained physical environment of both buildings and grounds should be maintained.',53,0),(299,'7.2.2','Facilities should fully meet health and safety requirements.',53,0),(300,'7.2.3','Quality assessment processes used should include both feedback from principal users about the adequacy and quality of facilities, and mechanisms for considering and responding to their views.',53,0),(301,'7.2.4','Standards of provision of teaching, laboratory and research facilities should be benchmarked through comparisons with equivalent provisions at other comparable institutions. (This includes such things as classroom space, laboratory facilities and equipment, access to computing facilities and associated software, private study facilities, and research equipment.',53,0),(302,'7.2.5','Adequate facilities should be available for confidential consultations between teaching staff and students)',53,0),(303,'7.2.6','Appropriate facilities should be provided for religious observances.',53,0),(304,'7.2.7','Food service facilities should be adequate and appropriate for the needs of staff and students.',53,0),(305,'7.2.8','Appropriate provision should be made for students and staff with physical disabilities or other special needs.',53,0),(306,'7.2.9','Facilities should be provided for cultural, sporting and other extra curricular activities that are appropriate for the needs of the students attending the institution.',53,0),(307,'7.3.1','Complete inventories should be maintained of equipment owned or controlled by the institution including equipment assigned to individual staff for teaching and research. ',54,0),(308,'7.3.2','Services such as cleaning, waste disposal, minor maintenance, safety, and environmental management should be maintained efficiently and effectively under the supervision of a senior administrative officer.',54,0),(309,'7.3.3','Regular condition assessments should be carried out and provision made for preventative and corrective maintenance and replacement when required.',54,0),(310,'7.3.4','Effective security should be provided for specialized facilities and equipment for teaching and research, with responsibility between individual members of staff, departments or colleges, or central administration clearly defined.',54,0),(311,'7.3.5','Effective systems should be used to ensure the personal security of teaching and other staff and students, with appropriate provisions for the security of their personal property.',54,0),(312,'7.3.6','Space utilization should be monitored and when appropriate facilities reallocated in response to changing requirements.',54,0),(313,'7.3.7','Scheduling of general-purpose facilities should be managed through an electronic booking and reservation system, and reports made to senior management on the extent and efficiency of use.',54,0),(314,'7.3.8','Arrangements should be made for shared use of underutilized facilities with adequate mechanisms for security of equipment.',54,0),(315,'7.4.1','Adequate computer equipment should be available and accessible for teaching and other staff and students throughout the institution.',55,0),(316,'7.4.2','The adequacy of provision of computer equipment should be regularly assessed through surveys or other means and comparisons with other institutions.',55,0),(317,'7.4.3','Policies governing the use of personal computers by students should be established and provision made for facilities to support their use in keeping with these policies.',55,0),(318,'7.4.4','Technical support should be available for teaching and other staff and students using information and communications technology.',55,0),(319,'7.4.5','Opportunities should be provided for teaching staff input into plans for acquisition and replacement of computing equipment and software.',55,0),(320,'7.4.6','Institution-wide acquisitions and replacement policies for software and hardware should be established to ensure that systems remain up to date and that compatibility is maintained as replacements are made.',55,0),(321,'7.4.7','Security systems should be established to protect privacy of personal and institutional information, and to protect against externally introduced viruses.',55,0),(322,'7.4.8','A code of conduct relating to inappropriate use of material on the internet should be established. Compliance with this code of conduct should be checked and instances of inappropriate behaviour appropriately dealt with',55,0),(323,'7.4.9','Training programs should be provided for teaching and other staff to ensure effective use of computing equipment and appropriate software for teaching, student assessment, and administration.',55,0),(324,'7.4.10','Effective use should be made of information technology for administrative systems, reporting, and communications across the institution with secure access where appropriate.',55,0),(325,'7.4.11','Internal information systems should be compatible with external reporting requirements.',55,0),(326,'7.5.1','Accommodation should be of appropriate standard, providing a healthy, safe and secure environment for students.',56,0),(327,'7.5.2','Facilities should make adequate provision for privacy and individual study.',56,0),(328,'7.5.3','Facilities for social, cultural and physical activities should be adequate and appropriate for the students attending the institution',56,0),(329,'7.5.4','Clearly defined codes of behaviour should be established and be formally agreed to by students.',56,0),(330,'7.5.5','Effective supervision should be provided by staff with the experience, expertise and authority to manage the facility as a secure and supportive learning environment.',56,0),(331,'7.5.6','Adequate food services, maintenance and medical facilities should be available or readily accessible.',56,0),(332,'7.5.7','Provision should be made for adequate and appropriate religious facilities.',56,0),(333,'7.5.8','If accommodation is provided it should be on or close to the campus or transport facilities provided to ensure easy access',56,0),(334,'8.1.1','Budgeting and resource allocations should be aligned with the mission and goals of the institution and strategic planning to achieve those goals.',59,0),(335,'8.1.2','Annual budgets should be established within a framework of long term revenue and expenditure projections, which are progressively adjusted in the light of experience.',59,0),(336,'8.1.3','Budget proposals should be developed by senior academic and administrative staff in consultation with cost center managers, carefully reviewed, and presented to the governing body for approval.',59,0),(337,'8.1.4','Proposals for new programs or major activities, equipment or facilities should be accompanied by business plans that include independently verified cost estimates and cost impacts on other services and activities.',59,0),(338,'8.1.5','If new projects or activities are cross-subsidized from existing funding sources the cost sharing strategy should be made explicit and intermediate and long term costs and benefits assessed.',59,0),(339,'8.1.6','If loans are used debt and liquidity ratios should be monitored and benchmarked against commercial practice and equivalent ratios in other higher education institutions.',59,0),(340,'8.1.7','Ratios of expenditure on salaries and other major expense categories relative to total expenditure should be planned and monitored, allowing appropriate variations for colleges or departments with different cost structures.',59,0),(341,'8.1.8','Borrowing and other long term financing schemes should be used sparingly as a strategic financing strategy to improve capacity rather than to meet unanticipated short term operating costs, and financial planning should ensure that obligations can be met from projected additional revenue or from known existing revenue sources.',59,0),(342,'8.1.9','Strategies should be developed to diversify revenue through a range of activities, which, while consistent with the charter and mission of the institution, reduce its dependence on a single funding source.',59,0),(343,'8.2.1','Oversight and management of the institution’s budgeting and accounting functions should be carried out by a business or financial office responsible to a senior administrator.',60,0),(344,'8.2.2','Sufficient delegations of spending authority should be given to managers of organizational units within the institution for effective and efficient administration.',60,0),(345,'8.2.3','Details of any financial delegations should be clearly specified, and conformity with regulations and reporting requirements confirmed through audit processes.',60,0),(346,'8.2.4','Cost center managers should be involved in the budget planning process, and be held accountable for expenditure within approved budgets.',60,0),(347,'8.2.5','There should be accurate monitoring of expenditure and commitments against budgets with reports prepared for each cost center and for the institution as a whole at least once each semester.',60,0),(348,'8.2.6','Any discrepancies from expenditure estimates should be explained and their impact on annual budget projections assessed.',60,0),(349,'8.2.7','Accounting systems should comply with accepted professional accounting standards and as far as possible attribute total cost to particular activities.',60,0),(350,'8.2.8','Funds provided for particular purposes should be used for those purposes and the accounting systems should verify that this has occurred.',60,0),(351,'8.2.9','Where possibilities of conflict of interest exist or may be perceived to exist the persons concerned should declare their interest and refrain from participation in decisions.',60,0),(352,'8.2.10','Financial processes should be managed so that allowable carry-forward provisions are sufficiently flexible to avoid rushed end of year expenditure or disincentives for long term planning.',60,0),(353,'8.3.1','Financial planning processes should include independently verified risk assessment.',61,0),(354,'8.3.2','Risk minimization strategies should be in place and adequate reserves maintained to meet realistically assessed financial risks.',61,0),(355,'8.3.3','Internal audit processes should operate independently of accounting and business managers, and report directly to the Rector or Dean or chair of the relevant governing board committee.',61,0),(356,'8.3.4','External audits should be conducted annually by an independent government agency or a reputable external audit firm that is independent of the institution, its financial or other senior staff and members of the governing body.',61,0),(357,'9.1.1','A desired staffing profile appropriate to the mission and nature of the institution should be approved by the governing body. (The profile should include matters such as age structure, gender balance where relevant, classification levels, qualifications, cultural mix and educational background, and objectives for Saudization.)',64,0),(358,'9.1.2','Regular comparisons should be made of current provision of teaching and other staff with the desired staffing profile and progress towards it should be monitored.',64,0),(359,'9.1.3','A comprehensive set of policies and regulations should be included in an employment handbook or manual and accessible to teaching and other staff. (It should include rights and responsibilities of teaching and other staff, recruitment processes, supervision, performance evaluation, promotion, counselling and support processes, professional development, and complaints, discipline and appeal procedures.)',64,0),(360,'9.1.4','Effective strategies should be used for succession planning in relation to leadership positions.',64,0),(361,'9.1.5','Teaching loads should be equitable across the institution, taking account of the nature of teaching requirements in different fields of study',64,0),(362,'9.1.6','Promotion policies and processes should be clearly documented and implemented fairly.',64,0),(363,'9.1.7','There should be appropriate delegations relating to employment processes across the institution and the exercise of these delegations should be monitored to ensure equitable treatment. (These delegations may relate to matters such as junior appointments, junior promotions, rewards for outstanding performance, and professional development opportunities.)',64,0),(364,'9.1.8','Indicators of successful administration of staffing and employment policies and teaching and other staff performance should be established and compared with successful practice elsewhere.',64,0),(365,'9.1.9','The governing board should receive and consider annual reports from the responsible senior manager on implementation of policies and staffing and employment practices.',64,0),(366,'9.2.1','Recruitment processes should ensure that teaching staff have the specific areas of expertise, and the personal qualities, experience and skill to meet teaching requirements and that other staff are appropriately qualified and experienced for their work.',65,0),(367,'9.2.2','When appointments are to be made through promotion or transfer within the institution rather than by external appointment, the appointments made should meet qualifications and skill requirements, and contribute to achievement of the desired staffing profile.',65,0),(368,'9.2.3','If a particular appointment can be made either from within or from outside the institution procedures should be used that ensure equitable treatment of all applicants (For example positions should be publicly advertised, internal candidates should be given adequate opportunity to apply, and judgments made should be equitable considering the experience, qualifications, and current levels of performance of the applicants.)',65,0),(369,'9.2.4','Candidates for employment should be provided with full position descriptions and conditions of employment, together with general information about the institution and its mission and programs. (The information provided should include details of employment expectations, indicators of performance, and processes of performance evaluation.)',65,0),(370,'9.2.5','References should be checked, and claims of experience and qualifications verified before appointments are made.',65,0),(371,'9.2.6','The legitimacy of qualifications claimed by applicants should be checked through processes that consider the standing and reputation of the institutions from which they were obtained, taking account of recognition of qualifications by the Ministry of Higher Education.',65,0),(372,'9.2.7','In professional programs there should be sufficient teaching staff with successful experience in the relevant profession to provide practical advice and guidance to students about work place requirements. ',65,0),(373,'9.2.8','New teaching staff should be given an effective orientation to ensure familiarity with the institution and its services, programs and student development strategies, and institutional priorities for development.',65,0),(374,'9.2.9','The level of provision of teaching staff in all departments and colleges (ie the ratio of students per teaching staff member calculated as full time equivalents) should be adequate for the programs offered and benchmarked against comparable student/teaching staff ratios at good quality Saudi Arabian and international institutions.',65,0),(375,'4.3.1','Criteria and processes for performance evaluation should be clearly specified and made known in advance to teaching and other staff.',66,0),(376,'4.3.2','Consultations about work performance by supervisors (including deans, heads of department, administrative supervisors etc) should be confidential and supportive and occur on a formal basis at least once each year.',66,0),(377,'4.3.3','If performance is considered less than satisfactory clear requirements should be established for improvement.',66,0),(378,'4.3.4','Performance assessments of teaching and other staff should be kept confidential but should be documented and retained. Teaching and other staff should have the opportunity to include on file their own comments relating to these assessments, including points of disagreement.',66,0),(379,'4.3.5','Outstanding academic or administrative performance at any level of the institution should be recognized and rewarded.',66,0),(380,'4.3.6','All teaching and other staff should be given appropriate and fair opportunities for personal and career development.',66,0),(381,'4.3.7','Junior teaching and other staff with leadership potential should be identified and given a range of experiences to prepare them for future career development.',66,0),(382,'4.3.8','Promotion criteria should include contributions to the mission of the institution, and in the case of teaching staff include proper recognition of quality of teaching and efforts to improve it, and service to the institution and the community as well as research.',66,0),(383,'4.3.9','Assistance should be given in arranging professional development activities to improve skills and upgrade qualifications.',66,0),(384,'4.3.10','Appropriate training and professional development activities should be provided to assist with new programs or policy initiatives.',66,0),(385,'4.3.11','Teaching staff should be expected to participate in activities that ensure they keep up to date with developments in their field and the extent to which they do so should be monitored.',66,0),(386,'9.4.1','Procedures for dealing with complaints about or by teaching or other staff, and resolving disputes among them, should be clearly specified in policies and regulations.',67,0),(387,'9.4.2','Procedures for resolving disputes (that cannot be settled by those directly involved) should include an initial step of conciliation by a person independent of the issue, with the possibility of referral to a committee or senior officer for determination if required.',67,0),(388,'9.4.3','Disciplinary processes for neglect of responsibilities, failure to comply with instructions, or inappropriate behaviour should be specified in regulations and consistently followed.',67,0),(389,'9.4.4','Appropriate provision should be made in regulations for rights of appeal against disciplinary decisions.',67,0),(390,'9.4.5','Serious disputes should be dealt with through quasi-judicial processes that include provision and verification of evidence, and impartial judgments by a person or persons experienced in such procedures.',67,0),(391,'10.1.1','A research development plan that is consistent with the nature and mission of the institution and the economic and cultural development needs of the region should be prepared and made widely available.',70,0),(392,'10.1.2','The research development plan should include clearly specified indicators and benchmarks for performance targets.',70,0),(393,'10.1.3','What is recognized as research should be clearly specified and consistent with international standards. (This normally includes both self-generated and commissioned activity, but requires creative original work, independently validated by peers, and published in media that are highly regarded by scholars in the field.)',70,0),(394,'10.1.4','Annual reports should be published on institutional research performance and records maintained of the research activities of individuals, departments and colleges.',70,0),(395,'10.1.5','Cooperation with local industry and with other research agencies should be encouraged. When appropriate these forms of cooperation should involve joint research projects, shared use of equipment, and cooperative strategies for development.',70,0),(396,'10.1.6','Mechanisms should be established to support collaboration and cooperation with international universities and research networks.',70,0),(397,'10.1.7','Policies should provide for the establishment, accountability, and periodic review of research institutes or centers.',70,0),(398,'10.1.8','The establishment of research institutes or centers should not inhibit research activity by others not involved in those organizations.',70,0),(399,'10.1.9','A high level committee should be established to monitor compliance with ethical standards and approve research projects with potential impact on ethical issues.',70,0),(400,'10.1.10','The institution should develop an adequate research budget to enable the achievement of its research plan.',70,0),(401,'10.2.1','Expectations for teaching staff involvement in research and scholarly activities should be specified and performance in relation to these expectations considered in performance evaluation and promotion criteria. (For universities, criteria should require at least some research and/or appropriate scholarly activity of all full time teaching staff).',71,0),(402,'10.2.2','Support should be provided for junior teaching staff in the development of their research programs through mechanisms such as mentoring by senior colleagues, inclusion in project teams, assistance in developing research proposals, and start up funding to help initiate new research projects.',71,0),(403,'10.2.3','Support should be provided for junior teaching staff in the development of their research programs through mechanisms such as mentoring by senior colleagues, inclusion in project teams, assistance in developing research proposals, and seed funding.',71,0),(404,'10.2.4','Opportunities should be provided for postgraduate research students to participate in joint research projects.',71,0),(405,'10.2.5','Participation by research students in joint research projects should be appropriately acknowledged. When a significant contribution has been made reports and publications should indicate joint authorship.',71,0),(406,'10.2.6','Assistance should be given for teaching staff to develop collaborative research arrangements with colleagues in other institutions and in the international community.',71,0),(407,'10.2.7','Teaching staff should be encouraged to include information about their research and scholarly activities that are relevant to courses they teach in their teaching, together with other significant research developments in the field.',71,0),(408,'10.2.8','Strategies should be introduced for identifying and capitalizing on the expertise of teaching staff and postgraduate students in providing research and development services to the community and generating financial returns to the institution.',71,0),(409,'10.3.1','A research development unit or center should be established with capacity to identify and publicize institutional expertise and commercial development opportunities, assist in developing proposals and business plans, help with preparation of contracts, and when appropriate, help with the development of spin off companies.',72,0),(410,'10.3.2','Ideas with potential for commercial development should be critically evaluated, and advice obtained from experienced persons from industry and relevant professions before investment by the institution is authorized.',72,0),(411,'10.3.3','Policies should be established for ownership of intellectual property and clear procedures set out for commercialization of ideas developed by staff and students. The policies should specify scales for equitable sharing of returns to the inventor(s), and the institution.',72,0),(412,'10.3.4','A culture of entrepreneurship should be encouraged throughout the institution, with particular emphasis on teaching staff and postgraduate students',72,0),(413,'10.3.5','Regulations should be established that require disclosure of pecuniary interest and avoidance of conflict of interest in activities related to research.',72,0),(414,'10.4.1','Adequate laboratory space and equipment, library and information systems and resources should be provided to support the research activities of teaching staff and students in the fields in which programs are offered.',73,0),(415,'10.4.2','In a university an adequate budget should be available for conduct of research (including research equipment and facilities) in all departments and colleges.',73,0),(416,'10.4.3','Advantage should be taken of opportunities for joint ownership or shared access to major equipment items within the institution, and with other organizations.',73,0),(417,'10.4.4','Effective security systems should be established to ensure safety for researchers and their activities, and for others in the institutional community and the surrounding area.',73,0),(418,'10.4.5','Policies should be established that make clear the ownership and responsibility for maintenance of equipment obtained through research grant applications, commissioned research or other cooperative ventures with industry or other external sources.',73,0),(419,'11.1.1','The service commitment of the institution should be relevant to the community or communities within which it operates and included in its mission.',76,0),(420,'11.1.2','Policies on the institution’s service role should be approved by the governing body and these policies should be supported in decisions made by senior administrators',76,0),(421,'11.1.3','Annual reports should be prepared on the institution’s contributions to the community',76,0),(422,'11.1.4','Contributions to the community should be included in promotion criteria and staff assessments.',76,0),(423,'11.1.5','Websites providing details of institutional structures and activities, including news items of potential interest to potential students and members of the wider community, should be provided and kept up to date.',76,0),(424,'11.2.1','Teaching and other staff should be encouraged to participate in forums in which significant community issues are discussed and plans for community development considered.',77,0),(425,'11.2.2','The institution and its colleges and departments should cooperate in the establishment of community support or professional service agencies relevant to the needs of the community, drawing on the expertise of staff members.',77,0),(426,'11.2.3','A range of community education courses should be provided in areas of interest and need.',77,0),(427,'11.2.4','Relationships should be established with local industries and employers to assist program delivery. (These may include, for example, placement of students for work-study programs, part time employment opportunities, and identification of issues for analysis in student project activities.)',77,0),(428,'11.2.5','Local employers and members of professions should be invited to join appropriate advisory committees considering programs and other institutional activities',77,0),(429,'11.2.6','Continuing contact should be maintained with schools in the community, offering assistance and support in areas of specialization, providing information about the institution’s programs and activities and subsequent career opportunities, and arranging enrichment activities for the schools',77,0),(430,'11.2.7','Regular contact should be maintained with alumni, keeping them informed about institutional developments, inviting their participation in activities, and encouraging their financial and other support for new developments.',77,0),(431,'11.2.8','Advantage should be taken of opportunities to seek funding support from individuals and organizations in the community for research and other developments in the institution.',77,0),(432,'11.2.9','A central data-base should be maintained in which records are maintained of community services undertaken by individuals and organizations throughout the institution.',77,0),(433,'11.3.1','A comprehensive strategy should be developed for monitoring and improving the reputation of the institution in the local and other relevant communities.',78,0),(434,'11.3.2','Clear guidelines should be established for public comments on behalf of the institution, normally restricting such comments to the Rector or Dean or a media office responsible to the Rector or Dean.',78,0),(435,'11.3.3','Guidelines should be established for public comments on community issues by members of staff, where such comments could be associated with the institution',78,0),(436,'11.3.4','An institutional media office should be established with responsibility for managing media communications, seeking information about activities of the institution of potential interest to the community, and arranging for publication.',78,0),(437,'11.3.5','Community views about the institution and its activities should be sought and strategies developed for improving perceptions.',78,0),(438,'11.3.6','If issues or concerns about operational issues involving the institution are raised in public forums these should be dealt with immediately and objectively by the Rector or Dean or other designated senior members of faculty or staff.',78,0);
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kpi`
--

DROP TABLE IF EXISTS `kpi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kpi` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `criteria_id` bigint(20) NOT NULL,
  `code` varchar(64) NOT NULL,
  `title` text NOT NULL,
  `kpi_type` tinyint(1) DEFAULT NULL,
  `chart_y_title` varchar(128) NOT NULL DEFAULT '',
  `college_id` varchar(45) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `category_id` bigint(20) NOT NULL DEFAULT '0',
  `is_semester` tinyint(1) DEFAULT '0',
  `overall` tinyint(4) NOT NULL DEFAULT '0',
  `is_core` tinyint(4) NOT NULL DEFAULT '0',
  `institution_score` int(11) NOT NULL DEFAULT '0',
  `college_score` int(11) NOT NULL DEFAULT '0',
  `ncaaa` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi`
--

LOCK TABLES `kpi` WRITE;
/*!40000 ALTER TABLE `kpi` DISABLE KEYS */;
INSERT INTO `kpi` VALUES (1,7,'S1.1','Stakeholders\' awareness ratings of the Mission Statement and Objectives (Average rating on how well the mission is known to teaching staff, and undergraduate and graduate students, respectively, on a five- point scale in an annual survey).',1,'','0',0,0,0,0,0,0,0,1),(2,17,'S2.1','Stakeholder evaluation of the Policy Handbook, including administrative flow chart and job responsibilities (Average rating on the adequacy of the Policy Handbook on a five- point scale in an annual survey of teaching staff and final year students).',1,'','0',0,0,0,0,0,0,0,1),(3,24,'S3.1','Students\' overall evaluation on the quality of their learning experiences. (Average rating of the overall quality on a five point scale in an annual survey of final year students.)',1,'','0',0,0,0,0,0,0,0,1),(4,24,'S3.2','Proportion of courses in which student evaluations were conducted during the year.',2,'','0',0,0,0,0,0,0,0,1),(5,24,'S3.3','Proportion of programs in which there was an independent verification, within the institution, of standards of student achievement during the year.',2,'','0',0,0,0,0,0,0,0,1),(6,24,'S3.4','Proportion of programs in which there was an independent verification of standards of student achievement by people (evaluators) external to the institution during the year.',2,'','0',0,0,0,0,0,0,0,1),(7,37,'S4.1','Ratio of students to teaching staff. (Based on full time equivalents)',2,'','0',0,0,0,0,0,0,0,1),(8,37,'S4.2','Students overall rating on the quality of their courses. (Average rating of students on a five point scale on overall evaluation of courses.)',1,'','0',0,0,0,0,0,0,0,1),(9,37,'S4.3','Proportion of teaching staff with verified doctoral qualifications.',2,'','0',0,0,0,0,0,0,0,1),(10,37,'S4.4','Retention Rate; Percentage of students entering programs who successfully complete first year.',2,'','0',0,0,0,0,0,0,0,1),(11,37,'S4.5','Graduation Rate for Undergraduate Students: Proportion of students entering undergraduate programs who complete those programs in minimum time.',2,'','0',0,0,0,0,0,0,0,1),(12,37,'S4.6','Graduation Rates for Post Graduate Students: Proportion of students entering post graduate programs who complete those programs in specified time.',2,'','0',0,0,0,0,0,0,0,1),(13,37,'S4.7','Proportion of graduates from undergraduate programs who within six months of graduation are: \n(a) employed \n(b) enrolled in further study \n(c) not seeking employment or further study',2,'','0',0,0,0,0,0,0,0,1),(14,45,'S5.1','Ratio of students to administrative staff.',2,'','0',0,0,0,0,0,0,0,1),(15,45,'S5.2','Proportion of total operating funds (other than accommodation and student allowances) allocated to provision of student services.',2,'','0',0,0,0,0,0,0,0,1),(16,45,'S5.3','Student evaluation of academic and career counselling. (Average rating on the adequacy of academic and career counselling on a five- point scale in an annual survey of final year students.)',1,'','0',0,0,0,0,0,0,0,1),(17,50,'S6.1','Stakeholder evaluation of library and media center. (Average overall rating of the adequacy of the library & media center, including:\n a) Staff assistance,\nb) Current and up-to-date\nc) Copy & print facilities,\nd) Functionality of equipment,\ne) Atmosphere or climate for studying\nf) Availability of study sites, and\ng) Any other quality indicators of service on a five- point scale of an annual survey.) .',1,'','0',0,0,0,0,0,0,0,1),(18,50,'S6.2','Number of web site publication and journal subscriptions as a proportion of the number of programs offered.',2,'','0',0,0,0,0,0,0,0,1),(19,50,'S6.3','Stakeholder evaluation of the digital library. (Average overall rating of the adequacy of the digital library, including: \n a) User friendly website\nb) Availability of the digital databases,\nc) Accessibility for users,\nd) Library skill training and\ne) Any other quality indicators of service on a five- point scale of an annual survey.)',1,'','0',0,0,0,0,0,0,0,1),(20,57,'S7.1','Annual expenditure on IT budget, including: \na) Percentage of the total Institution, or College, or Program budget allocated for IT; \nb) Percentage of IT budget allocated per program for institutional or per student for programmatic; \nc) Percentage of IT budget allocated for software licences; \nd) Percentage of IT budget allocated for IT security; \ne) Percentage of IT budge allocated for IT maintenance',2,'','0',0,0,0,0,0,0,0,1),(21,57,'S7.2','Stakeholder evaluation of the IT services (Average overall rating of the adequacy of on a five- point scale of an annual survey). \na) IT availability, \nb) Website, \nc) e-learning services \nd) IT Security, \ne) Maintenance (hardware & software), \nf) Accessibility \ng) Support systems, \nh) Hardware, software & up-dates, and Web-based electronic data management system or electronic resources (for example: institutional website providing resource sharing, networking & relevant information, including e-learning, interactive learning & teaching between students & faculty).',1,'','0',0,0,0,0,0,0,0,1),(22,57,'S7.3','Stakeholder evaluation of facilities & equipment: \na) Classrooms, \nb) Laboratories, \nc) Bathrooms (cleanliness & maintenance), \nd) Campus security, \ne) Parking & access, \nf) Safety (first aide, fire extinguishers & alarm systems, secure chemicals) \ng) Access for those with disabilities or handicaps (ramps, lifts, bathroom furnishings), \nh) Sporting facilities & equipment.',1,'','0',0,0,0,0,0,0,0,1),(23,62,'S8.1','Total operating expenditure (other than accommodation and student allowances) per student.',2,'','0',0,0,0,0,0,0,0,1),(24,68,'S9.1','Proportion of teaching staff leaving the institution in the past year for reasons other than age retirement.',2,'','0',0,0,0,0,0,0,0,1),(25,68,'S9.2','Proportion of teaching staff participating in professional development activities during the past year.',2,'','0',0,0,0,0,0,0,0,1),(26,74,'S10.1','Number of refereed publications in the previous year per full time equivalent teaching staff. (Publications based on the formula in the Higher Council Bylaw excluding conference presentations)',2,'','0',0,0,0,0,0,0,0,1),(27,74,'S10.2','Number of citations in refereed journals in the previous year per full time equivalent faculty members.',2,'','0',0,0,0,0,0,0,0,1),(28,74,'S10.3','Proportion of full time member of teaching staff with at least one refereed publication during the previous year.',2,'','0',0,0,0,0,0,0,0,1),(29,74,'S10.4','Number of papers or reports presented at academic conferences during the past year per full time equivalent faculty members.',2,'','0',0,0,0,0,0,0,0,1),(30,74,'S10.5','Research income from external sources in the past year as a proportion of the number of full time faculty members.',2,'','0',0,0,0,0,0,0,0,1),(31,74,'S10.6','Proportion of the total, annual operational budget dedicated to research.',2,'','0',0,0,0,0,0,0,0,1),(32,79,'S11.1','Proportion of full time teaching and other staff actively engaged in community service activities.',2,'','0',0,0,0,0,0,0,0,1),(33,79,'S11.2','Number of community education programs provided as a proportion of the number of departments.',2,'','0',0,0,0,0,0,0,0,1);
/*!40000 ALTER TABLE `kpi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kpi_college_value`
--

DROP TABLE IF EXISTS `kpi_college_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kpi_college_value` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `detail_id` bigint(20) NOT NULL,
  `college_id` bigint(20) NOT NULL,
  `actual_benchmark` decimal(11,3) NOT NULL,
  `internal_college_benchmark` decimal(11,3) NOT NULL DEFAULT '0.000',
  `internal_institution_benchmark` decimal(11,3) NOT NULL DEFAULT '0.000',
  `target_benchmark` decimal(11,3) NOT NULL DEFAULT '0.000',
  `new_benchmark` decimal(11,3) NOT NULL DEFAULT '0.000',
  `external_benchmark` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_college_value`
--

LOCK TABLES `kpi_college_value` WRITE;
/*!40000 ALTER TABLE `kpi_college_value` DISABLE KEYS */;
/*!40000 ALTER TABLE `kpi_college_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kpi_detail`
--

DROP TABLE IF EXISTS `kpi_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kpi_detail` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `legend_id` bigint(20) NOT NULL,
  `semester_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_detail`
--

LOCK TABLES `kpi_detail` WRITE;
/*!40000 ALTER TABLE `kpi_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `kpi_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kpi_escalation_legend_value`
--

DROP TABLE IF EXISTS `kpi_escalation_legend_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kpi_escalation_legend_value` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `escalation_level_id` bigint(20) DEFAULT NULL,
  `legend_id` bigint(20) DEFAULT NULL,
  `value` decimal(10,2) DEFAULT NULL,
  `is_less` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_escalation_legend_value`
--

LOCK TABLES `kpi_escalation_legend_value` WRITE;
/*!40000 ALTER TABLE `kpi_escalation_legend_value` DISABLE KEYS */;
/*!40000 ALTER TABLE `kpi_escalation_legend_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kpi_escalation_level`
--

DROP TABLE IF EXISTS `kpi_escalation_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kpi_escalation_level` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `color` varchar(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_escalation_level`
--

LOCK TABLES `kpi_escalation_level` WRITE;
/*!40000 ALTER TABLE `kpi_escalation_level` DISABLE KEYS */;
/*!40000 ALTER TABLE `kpi_escalation_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kpi_escalation_plan`
--

DROP TABLE IF EXISTS `kpi_escalation_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kpi_escalation_plan` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `legend_value_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `plan` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_escalation_plan`
--

LOCK TABLES `kpi_escalation_plan` WRITE;
/*!40000 ALTER TABLE `kpi_escalation_plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `kpi_escalation_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kpi_escalation_polarity`
--

DROP TABLE IF EXISTS `kpi_escalation_polarity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kpi_escalation_polarity` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kpi_id` bigint(20) NOT NULL,
  `polarity` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_escalation_polarity`
--

LOCK TABLES `kpi_escalation_polarity` WRITE;
/*!40000 ALTER TABLE `kpi_escalation_polarity` DISABLE KEYS */;
/*!40000 ALTER TABLE `kpi_escalation_polarity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kpi_escalation_user`
--

DROP TABLE IF EXISTS `kpi_escalation_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kpi_escalation_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `escalation_level_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_escalation_user`
--

LOCK TABLES `kpi_escalation_user` WRITE;
/*!40000 ALTER TABLE `kpi_escalation_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `kpi_escalation_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kpi_institution_value`
--

DROP TABLE IF EXISTS `kpi_institution_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kpi_institution_value` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `detail_id` bigint(20) NOT NULL,
  `actual_benchmark` decimal(11,3) NOT NULL,
  `internal_college_benchmark` decimal(11,3) NOT NULL DEFAULT '0.000',
  `internal_institution_benchmark` decimal(11,3) NOT NULL DEFAULT '0.000',
  `target_benchmark` decimal(11,3) NOT NULL DEFAULT '0.000',
  `new_benchmark` decimal(11,3) NOT NULL DEFAULT '0.000',
  `external_benchmark` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_institution_value`
--

LOCK TABLES `kpi_institution_value` WRITE;
/*!40000 ALTER TABLE `kpi_institution_value` DISABLE KEYS */;
/*!40000 ALTER TABLE `kpi_institution_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kpi_legend`
--

DROP TABLE IF EXISTS `kpi_legend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kpi_legend` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `level_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_legend`
--

LOCK TABLES `kpi_legend` WRITE;
/*!40000 ALTER TABLE `kpi_legend` DISABLE KEYS */;
/*!40000 ALTER TABLE `kpi_legend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kpi_level`
--

DROP TABLE IF EXISTS `kpi_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kpi_level` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `level` varchar(128) NOT NULL,
  `kpi_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_level`
--

LOCK TABLES `kpi_level` WRITE;
/*!40000 ALTER TABLE `kpi_level` DISABLE KEYS */;
/*!40000 ALTER TABLE `kpi_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kpi_level_description`
--

DROP TABLE IF EXISTS `kpi_level_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kpi_level_description` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kpi_id` bigint(20) NOT NULL,
  `level_number` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kpi_level_description_id_uindex` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_level_description`
--

LOCK TABLES `kpi_level_description` WRITE;
/*!40000 ALTER TABLE `kpi_level_description` DISABLE KEYS */;
/*!40000 ALTER TABLE `kpi_level_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kpi_level_settings`
--

DROP TABLE IF EXISTS `kpi_level_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kpi_level_settings` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `label_ar` varchar(255) DEFAULT NULL,
  `label_en` varchar(255) DEFAULT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kpi_level_settings_id_uindex` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_level_settings`
--

LOCK TABLES `kpi_level_settings` WRITE;
/*!40000 ALTER TABLE `kpi_level_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `kpi_level_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kpi_program_value`
--

DROP TABLE IF EXISTS `kpi_program_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kpi_program_value` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `detail_id` bigint(20) NOT NULL,
  `program_id` bigint(20) NOT NULL,
  `actual_benchmark` decimal(11,3) NOT NULL,
  `internal_college_benchmark` decimal(11,3) NOT NULL DEFAULT '0.000',
  `internal_institution_benchmark` decimal(11,3) NOT NULL DEFAULT '0.000',
  `target_benchmark` decimal(11,3) NOT NULL DEFAULT '0.000',
  `new_benchmark` decimal(11,3) NOT NULL DEFAULT '0.000',
  `external_benchmark` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_program_value`
--

LOCK TABLES `kpi_program_value` WRITE;
/*!40000 ALTER TABLE `kpi_program_value` DISABLE KEYS */;
/*!40000 ALTER TABLE `kpi_program_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kpi_survey`
--

DROP TABLE IF EXISTS `kpi_survey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kpi_survey` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kpi_id` bigint(20) NOT NULL,
  `survey_id` bigint(20) NOT NULL,
  `factor_id` bigint(20) NOT NULL,
  `statement_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ` (`kpi_id`,`survey_id`,`factor_id`,`statement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_survey`
--

LOCK TABLES `kpi_survey` WRITE;
/*!40000 ALTER TABLE `kpi_survey` DISABLE KEYS */;
/*!40000 ALTER TABLE `kpi_survey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `major`
--

DROP TABLE IF EXISTS `major`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `major` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `integration_id` bigint(20) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `name_en` varchar(255) NOT NULL DEFAULT '',
  `name_ar` varchar(255) NOT NULL DEFAULT '',
  `program_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `major`
--

LOCK TABLES `major` WRITE;
/*!40000 ALTER TABLE `major` DISABLE KEYS */;
/*!40000 ALTER TABLE `major` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manual`
--

DROP TABLE IF EXISTS `manual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manual` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `label_arabic` varchar(128) NOT NULL DEFAULT '',
  `label_english` varchar(128) NOT NULL DEFAULT '',
  `link_arabic` varchar(128) NOT NULL DEFAULT '',
  `link_english` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manual`
--

LOCK TABLES `manual` WRITE;
/*!40000 ALTER TABLE `manual` DISABLE KEYS */;
/*!40000 ALTER TABLE `manual` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (20170606114555);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `node`
--

DROP TABLE IF EXISTS `node`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `node` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `parent_lft` int(11) NOT NULL DEFAULT '0',
  `parent_rgt` int(11) NOT NULL DEFAULT '0',
  `system_number` int(11) NOT NULL DEFAULT '0',
  `item_id` bigint(20) NOT NULL DEFAULT '0',
  `year` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `class_type` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `is_finished` tinyint(1) NOT NULL DEFAULT '0',
  `is_form` tinyint(1) NOT NULL DEFAULT '0',
  `is_shared` tinyint(1) NOT NULL DEFAULT '0',
  `shared_date` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `review_status` enum('none','compliant','not_compliant','partly_compliant') NOT NULL DEFAULT 'none',
  `properties` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `LftIndx` (`parent_lft`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node`
--

LOCK TABLES `node` WRITE;
/*!40000 ALTER TABLE `node` DISABLE KEYS */;
/*!40000 ALTER TABLE `node` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `node_assessor`
--

DROP TABLE IF EXISTS `node_assessor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `node_assessor` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `node_id` bigint(20) NOT NULL DEFAULT '0',
  `assessor_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node_assessor`
--

LOCK TABLES `node_assessor` WRITE;
/*!40000 ALTER TABLE `node_assessor` DISABLE KEYS */;
/*!40000 ALTER TABLE `node_assessor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `node_builder`
--

DROP TABLE IF EXISTS `node_builder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `node_builder` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `agency_id` bigint(20) NOT NULL,
  `class_type` varchar(255) NOT NULL,
  `version` varchar(45) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link_pdf` tinyint(1) NOT NULL,
  `link_view` tinyint(1) NOT NULL,
  `link_edit` tinyint(1) NOT NULL,
  `components` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node_builder`
--

LOCK TABLES `node_builder` WRITE;
/*!40000 ALTER TABLE `node_builder` DISABLE KEYS */;
/*!40000 ALTER TABLE `node_builder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `node_log`
--

DROP TABLE IF EXISTS `node_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `node_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `logged_user_id` bigint(20) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `node_id` bigint(20) NOT NULL DEFAULT '0',
  `node_parent_id` bigint(20) NOT NULL DEFAULT '0',
  `node_item_id` bigint(20) NOT NULL DEFAULT '0',
  `node_system_number` int(11) NOT NULL DEFAULT '0',
  `node_year` int(11) NOT NULL DEFAULT '0',
  `node_name` varchar(255) NOT NULL,
  `node_class_type` varchar(255) NOT NULL,
  `node_date_added` datetime NOT NULL,
  `node_is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `node_is_finished` tinyint(1) NOT NULL DEFAULT '0',
  `node_due_date` datetime NOT NULL,
  `node_review_status` enum('none','compliant','not_compliant','partly_compliant') NOT NULL DEFAULT 'none',
  `node_properties` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node_log`
--

LOCK TABLES `node_log` WRITE;
/*!40000 ALTER TABLE `node_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `node_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `node_review`
--

DROP TABLE IF EXISTS `node_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `node_review` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `node_id` bigint(20) NOT NULL,
  `reviewer_id` bigint(20) NOT NULL,
  `date_added` datetime NOT NULL,
  `status` enum('none','compliant','not_compliant','partly_compliant') NOT NULL DEFAULT 'none',
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node_review`
--

LOCK TABLES `node_review` WRITE;
/*!40000 ALTER TABLE `node_review` DISABLE KEYS */;
/*!40000 ALTER TABLE `node_review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `node_reviewer`
--

DROP TABLE IF EXISTS `node_reviewer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `node_reviewer` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `node_id` bigint(20) NOT NULL DEFAULT '0',
  `reviewer_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node_reviewer`
--

LOCK TABLES `node_reviewer` WRITE;
/*!40000 ALTER TABLE `node_reviewer` DISABLE KEYS */;
/*!40000 ALTER TABLE `node_reviewer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sender_id` bigint(20) NOT NULL DEFAULT '0',
  `receiver_id` bigint(20) NOT NULL DEFAULT '0',
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification_settings`
--

DROP TABLE IF EXISTS `notification_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification_settings` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `notification_name` varchar(45) NOT NULL,
  `allow_email` tinyint(1) NOT NULL DEFAULT '1',
  `allow_sms` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification_settings`
--

LOCK TABLES `notification_settings` WRITE;
/*!40000 ALTER TABLE `notification_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification_template`
--

DROP TABLE IF EXISTS `notification_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification_template` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification_template`
--

LOCK TABLES `notification_template` WRITE;
/*!40000 ALTER TABLE `notification_template` DISABLE KEYS */;
INSERT INTO `notification_template` VALUES (1,'admin_add_user_on_node','New Assessor Added','<p>%receiver_name%, A new assessor has been successfully added to the %node_name% node.</p>'),(2,'admin_entered_due_date_to_node','New Due Date from Admin','<p>The admin has assigned the&nbsp;%node_name% node to be submitted at&nbsp;%due_date%.</p>'),(3,'assessor_finished_entering_forms_data','Assessor has Completed the Forms','<p>The assigned assessor has completed forms for the&nbsp;%node_name% node.</p>'),(4,'all_form_data_enterd_and_checked_correctly','Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;%node_name% node have been reviewed and accepted to compliant to standards.</p>'),(5,'form_data_incorrect_or_not_enterd','Form(s) have been Rejected','<p>The set of forms in the&nbsp;%node_name% node have been reviewed and rejected so please resubmit the forms accordingly with standards.</p>'),(6,'survey_invitation','Fill out This Survey','<p>You are invitated to fill out the&nbsp;%survey_title_english% survey and give your input.</p>'),(7,'survey_alumni_invitation','Fill out This Survey','<p><span data-sheets-value=\"{&quot;1&quot;:2,&quot;2&quot;:&quot;You are invitated to fill out the %survey_title_english% survey and give your input.&quot;}\" data-sheets-userformat=\"{&quot;2&quot;:513,&quot;3&quot;:{&quot;1&quot;:0},&quot;12&quot;:0}\">You are invitated to fill out the %survey_title_english% survey and give your input.</span></p>'),(8,'survey_employer_invitation','Fill out This Survey','<p><span data-sheets-value=\"{&quot;1&quot;:2,&quot;2&quot;:&quot;You are invitated to fill out the %survey_title_english% survey and give your input.&quot;}\" data-sheets-userformat=\"{&quot;2&quot;:513,&quot;3&quot;:{&quot;1&quot;:0},&quot;12&quot;:0}\">You are invitated to fill out the %survey_title_english% survey and give your input.</span></p>'),(9,'survey_reminder','Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;%survey_title_english% survey as your input is valuable.</p>'),(10,'forgot_password','Forgot Password Service','<p>You have requested to send your forgotton password. Your password is as follows:</p><p>%password%</p>'),(11,'alumni_employer_created','An Employer Entity Created','<p>The respected alumnus member has created a new employer entity to be associated with in the system as well other alumni if there exists a current or previous association with this employer.</p>'),(12,'email_received','You have a New Message','<p>%receiver_name% has sent you a new message from the %receiver_email% account.</p>'),(13,'remind_user_to_fill','Please Fill out Required Forms','<p>%receiver_name%, it is important that your assigned forms for the&nbsp;%node_name% node be filled so that accreditation can take place accordingly.</p>');
/*!40000 ALTER TABLE `notification_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pc_assignment`
--

DROP TABLE IF EXISTS `pc_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pc_assignment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) NOT NULL,
  `title_ar` text NOT NULL,
  `title_en` text NOT NULL,
  `description_ar` text NOT NULL,
  `description_en` text NOT NULL,
  `type` smallint(6) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `file_path` text NOT NULL,
  `semester_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_assignment`
--

LOCK TABLES `pc_assignment` WRITE;
/*!40000 ALTER TABLE `pc_assignment` DISABLE KEYS */;
/*!40000 ALTER TABLE `pc_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pc_catalog_information`
--

DROP TABLE IF EXISTS `pc_catalog_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pc_catalog_information` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) NOT NULL,
  `credit_hours` int(11) NOT NULL,
  `semester_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_catalog_information`
--

LOCK TABLES `pc_catalog_information` WRITE;
/*!40000 ALTER TABLE `pc_catalog_information` DISABLE KEYS */;
/*!40000 ALTER TABLE `pc_catalog_information` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pc_category`
--

DROP TABLE IF EXISTS `pc_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pc_category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) NOT NULL,
  `title_ar` varchar(500) NOT NULL,
  `title_en` varchar(500) NOT NULL,
  `description_ar` varchar(500) NOT NULL,
  `description_en` varchar(500) NOT NULL,
  `level` varchar(250) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_category`
--

LOCK TABLES `pc_category` WRITE;
/*!40000 ALTER TABLE `pc_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `pc_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pc_course_policies`
--

DROP TABLE IF EXISTS `pc_course_policies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pc_course_policies` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) NOT NULL,
  `grading_ar` text,
  `grading_en` text,
  `attendance_ar` text,
  `attendance_en` text,
  `lateness_ar` text,
  `lateness_en` text,
  `class_participation_en` text,
  `class_participation_ar` text,
  `missed_exam_ar` text,
  `missed_exam_en` text,
  `missed_assignment_ar` text,
  `missed_assignment_en` text,
  `academic_dishonesty_ar` text,
  `academic_dishonesty_en` text,
  `academic_plagiarism_ar` text,
  `academic_plagiarism_en` text,
  `semester_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_course_policies`
--

LOCK TABLES `pc_course_policies` WRITE;
/*!40000 ALTER TABLE `pc_course_policies` DISABLE KEYS */;
/*!40000 ALTER TABLE `pc_course_policies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pc_format`
--

DROP TABLE IF EXISTS `pc_format`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pc_format` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) NOT NULL,
  `assignment_format_file` text,
  `homework_format_file` text,
  `lab_experiment_format_file` text,
  `class_exercise_format_file` text,
  `semester_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `file_name_en` text,
  `file_name_ar` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_format`
--

LOCK TABLES `pc_format` WRITE;
/*!40000 ALTER TABLE `pc_format` DISABLE KEYS */;
/*!40000 ALTER TABLE `pc_format` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pc_instructor_information`
--

DROP TABLE IF EXISTS `pc_instructor_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pc_instructor_information` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `faculty_id` bigint(20) NOT NULL,
  `section_id` bigint(20) NOT NULL,
  `office_location` text NOT NULL,
  `office_hours` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_instructor_information`
--

LOCK TABLES `pc_instructor_information` WRITE;
/*!40000 ALTER TABLE `pc_instructor_information` DISABLE KEYS */;
/*!40000 ALTER TABLE `pc_instructor_information` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pc_material`
--

DROP TABLE IF EXISTS `pc_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pc_material` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) NOT NULL,
  `title_ar` text NOT NULL,
  `title_en` text NOT NULL,
  `description_ar` text NOT NULL,
  `description_en` text NOT NULL,
  `material_type` smallint(6) NOT NULL,
  `material_location` text NOT NULL,
  `semester_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `author` text NOT NULL,
  `release_date` datetime NOT NULL,
  `edition` text NOT NULL,
  `publisher` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_material`
--

LOCK TABLES `pc_material` WRITE;
/*!40000 ALTER TABLE `pc_material` DISABLE KEYS */;
/*!40000 ALTER TABLE `pc_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pc_report`
--

DROP TABLE IF EXISTS `pc_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pc_report` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title_ar` varchar(128) NOT NULL,
  `title_en` varchar(128) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_report`
--

LOCK TABLES `pc_report` WRITE;
/*!40000 ALTER TABLE `pc_report` DISABLE KEYS */;
/*!40000 ALTER TABLE `pc_report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pc_report_components`
--

DROP TABLE IF EXISTS `pc_report_components`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pc_report_components` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `report_id` bigint(20) NOT NULL,
  `component_id` bigint(20) NOT NULL,
  `is_core` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_report_components`
--

LOCK TABLES `pc_report_components` WRITE;
/*!40000 ALTER TABLE `pc_report_components` DISABLE KEYS */;
/*!40000 ALTER TABLE `pc_report_components` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pc_settings`
--

DROP TABLE IF EXISTS `pc_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pc_settings` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `entity_key` text NOT NULL,
  `entity_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_settings`
--

LOCK TABLES `pc_settings` WRITE;
/*!40000 ALTER TABLE `pc_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `pc_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pc_student_work`
--

DROP TABLE IF EXISTS `pc_student_work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pc_student_work` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) NOT NULL,
  `title_ar` text NOT NULL,
  `title_en` text NOT NULL,
  `student_project_file` text NOT NULL,
  `grading_guideline_ar` text NOT NULL,
  `semester_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `grading_guideline_en` text NOT NULL,
  `type` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_student_work`
--

LOCK TABLES `pc_student_work` WRITE;
/*!40000 ALTER TABLE `pc_student_work` DISABLE KEYS */;
/*!40000 ALTER TABLE `pc_student_work` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pc_support_material`
--

DROP TABLE IF EXISTS `pc_support_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pc_support_material` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) NOT NULL,
  `construction_technique_file` text,
  `equipment_documentation_file` text,
  `computer_documentation_file` text,
  `troubleshooting_tip_file` text,
  `debugging_tip_file` text,
  `addition_ar` text NOT NULL,
  `addition_en` text NOT NULL,
  `semester_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `file_name_en` text,
  `file_name_ar` text,
  `type` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_support_material`
--

LOCK TABLES `pc_support_material` WRITE;
/*!40000 ALTER TABLE `pc_support_material` DISABLE KEYS */;
/*!40000 ALTER TABLE `pc_support_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pc_support_service`
--

DROP TABLE IF EXISTS `pc_support_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pc_support_service` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) NOT NULL,
  `available_support_service_ar` text NOT NULL,
  `available_support_service_en` text NOT NULL,
  `semester_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_support_service`
--

LOCK TABLES `pc_support_service` WRITE;
/*!40000 ALTER TABLE `pc_support_service` DISABLE KEYS */;
/*!40000 ALTER TABLE `pc_support_service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pc_syllabus_fields`
--

DROP TABLE IF EXISTS `pc_syllabus_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pc_syllabus_fields` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `title_ar` varchar(500) NOT NULL,
  `title_en` varchar(500) NOT NULL,
  `description_ar` text NOT NULL,
  `description_en` text NOT NULL,
  `field_type` enum('text','richtext','date','checkbox','file','radio') NOT NULL,
  `value` text NOT NULL,
  `required` enum('0','1') NOT NULL,
  `display` enum('0','1') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_syllabus_fields`
--

LOCK TABLES `pc_syllabus_fields` WRITE;
/*!40000 ALTER TABLE `pc_syllabus_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `pc_syllabus_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pc_syllabus_fields_value`
--

DROP TABLE IF EXISTS `pc_syllabus_fields_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pc_syllabus_fields_value` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `value` text NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_syllabus_fields_value`
--

LOCK TABLES `pc_syllabus_fields_value` WRITE;
/*!40000 ALTER TABLE `pc_syllabus_fields_value` DISABLE KEYS */;
/*!40000 ALTER TABLE `pc_syllabus_fields_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pc_teaching_material`
--

DROP TABLE IF EXISTS `pc_teaching_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pc_teaching_material` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) NOT NULL,
  `course_manual_file` text NOT NULL,
  `lecture_note_ar` text NOT NULL,
  `lecture_note_en` text NOT NULL,
  `addition_ar` text NOT NULL,
  `addition_en` text NOT NULL,
  `semester_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `course_manual_title_en` text,
  `course_manual_title_ar` text,
  `type` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_teaching_material`
--

LOCK TABLES `pc_teaching_material` WRITE;
/*!40000 ALTER TABLE `pc_teaching_material` DISABLE KEYS */;
/*!40000 ALTER TABLE `pc_teaching_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pc_topic`
--

DROP TABLE IF EXISTS `pc_topic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pc_topic` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) NOT NULL,
  `title_ar` text NOT NULL,
  `title_en` text NOT NULL,
  `description_ar` text NOT NULL,
  `description_en` text NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `semester_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_topic`
--

LOCK TABLES `pc_topic` WRITE;
/*!40000 ALTER TABLE `pc_topic` DISABLE KEYS */;
/*!40000 ALTER TABLE `pc_topic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program`
--

DROP TABLE IF EXISTS `program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `integration_id` bigint(20) NOT NULL DEFAULT '0',
  `department_id` bigint(20) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `name_en` varchar(255) NOT NULL DEFAULT '',
  `name_ar` varchar(255) NOT NULL DEFAULT '',
  `code_en` varchar(255) NOT NULL DEFAULT '',
  `code_ar` varchar(255) NOT NULL DEFAULT '',
  `credit_hours` int(5) NOT NULL DEFAULT '0',
  `duration` int(5) NOT NULL DEFAULT '0',
  `degree_id` bigint(20) NOT NULL DEFAULT '0',
  `vision_en` text,
  `vision_ar` text,
  `mission_en` text,
  `mission_ar` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program`
--

LOCK TABLES `program` WRITE;
/*!40000 ALTER TABLE `program` DISABLE KEYS */;
/*!40000 ALTER TABLE `program` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program_goal`
--

DROP TABLE IF EXISTS `program_goal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program_goal` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `program_id` bigint(20) DEFAULT NULL,
  `title_en` tinytext,
  `title_ar` tinytext,
  `is_deleted` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program_goal`
--

LOCK TABLES `program_goal` WRITE;
/*!40000 ALTER TABLE `program_goal` DISABLE KEYS */;
/*!40000 ALTER TABLE `program_goal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program_objective`
--

DROP TABLE IF EXISTS `program_objective`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program_objective` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `program_id` bigint(20) DEFAULT NULL,
  `title_en` tinytext,
  `title_ar` tinytext,
  `is_deleted` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program_objective`
--

LOCK TABLES `program_objective` WRITE;
/*!40000 ALTER TABLE `program_objective` DISABLE KEYS */;
/*!40000 ALTER TABLE `program_objective` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program_plan`
--

DROP TABLE IF EXISTS `program_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program_plan` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `program_id` bigint(20) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `level` int(11) NOT NULL,
  `credit_hours` int(5) NOT NULL DEFAULT '0',
  `is_required` tinyint(1) DEFAULT '0',
  `integration_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `PP_IDX` (`program_id`,`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program_plan`
--

LOCK TABLES `program_plan` WRITE;
/*!40000 ALTER TABLE `program_plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `program_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pt_college_program_relation`
--

DROP TABLE IF EXISTS `pt_college_program_relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pt_college_program_relation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kcollege_id` bigint(20) NOT NULL,
  `kprogram_id` bigint(20) NOT NULL,
  `program_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pt_college_program_relation`
--

LOCK TABLES `pt_college_program_relation` WRITE;
/*!40000 ALTER TABLE `pt_college_program_relation` DISABLE KEYS */;
/*!40000 ALTER TABLE `pt_college_program_relation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pt_goal_program`
--

DROP TABLE IF EXISTS `pt_goal_program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pt_goal_program` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title_ar` text NOT NULL,
  `title_en` text NOT NULL,
  `program_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pt_goal_program`
--

LOCK TABLES `pt_goal_program` WRITE;
/*!40000 ALTER TABLE `pt_goal_program` DISABLE KEYS */;
/*!40000 ALTER TABLE `pt_goal_program` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pt_keyword`
--

DROP TABLE IF EXISTS `pt_keyword`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pt_keyword` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title_ar` text NOT NULL,
  `title_en` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pt_keyword`
--

LOCK TABLES `pt_keyword` WRITE;
/*!40000 ALTER TABLE `pt_keyword` DISABLE KEYS */;
/*!40000 ALTER TABLE `pt_keyword` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pt_keyword_college`
--

DROP TABLE IF EXISTS `pt_keyword_college`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pt_keyword_college` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title_ar` text NOT NULL,
  `title_en` text NOT NULL,
  `keyword_id` bigint(20) NOT NULL,
  `college_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pt_keyword_college`
--

LOCK TABLES `pt_keyword_college` WRITE;
/*!40000 ALTER TABLE `pt_keyword_college` DISABLE KEYS */;
/*!40000 ALTER TABLE `pt_keyword_college` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pt_keyword_program`
--

DROP TABLE IF EXISTS `pt_keyword_program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pt_keyword_program` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title_ar` text NOT NULL,
  `title_en` text NOT NULL,
  `keyword_id` bigint(20) NOT NULL,
  `program_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pt_keyword_program`
--

LOCK TABLES `pt_keyword_program` WRITE;
/*!40000 ALTER TABLE `pt_keyword_program` DISABLE KEYS */;
/*!40000 ALTER TABLE `pt_keyword_program` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pt_keyword_uni`
--

DROP TABLE IF EXISTS `pt_keyword_uni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pt_keyword_uni` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title_ar` text NOT NULL,
  `title_en` text NOT NULL,
  `keyword_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pt_keyword_uni`
--

LOCK TABLES `pt_keyword_uni` WRITE;
/*!40000 ALTER TABLE `pt_keyword_uni` DISABLE KEYS */;
/*!40000 ALTER TABLE `pt_keyword_uni` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pt_kpi_major_relation`
--

DROP TABLE IF EXISTS `pt_kpi_major_relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pt_kpi_major_relation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `major_id` bigint(20) NOT NULL,
  `kpi_id` bigint(20) NOT NULL,
  `program_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pt_kpi_major_relation`
--

LOCK TABLES `pt_kpi_major_relation` WRITE;
/*!40000 ALTER TABLE `pt_kpi_major_relation` DISABLE KEYS */;
/*!40000 ALTER TABLE `pt_kpi_major_relation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pt_obj_plo_relation`
--

DROP TABLE IF EXISTS `pt_obj_plo_relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pt_obj_plo_relation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `obj_id` bigint(20) NOT NULL,
  `plo_id` bigint(20) NOT NULL,
  `program_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pt_obj_plo_relation`
--

LOCK TABLES `pt_obj_plo_relation` WRITE;
/*!40000 ALTER TABLE `pt_obj_plo_relation` DISABLE KEYS */;
/*!40000 ALTER TABLE `pt_obj_plo_relation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pt_obj_program_relation`
--

DROP TABLE IF EXISTS `pt_obj_program_relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pt_obj_program_relation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `obj_id` bigint(20) NOT NULL,
  `kprogram_id` bigint(20) NOT NULL,
  `program_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pt_obj_program_relation`
--

LOCK TABLES `pt_obj_program_relation` WRITE;
/*!40000 ALTER TABLE `pt_obj_program_relation` DISABLE KEYS */;
/*!40000 ALTER TABLE `pt_obj_program_relation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pt_uni_college_relation`
--

DROP TABLE IF EXISTS `pt_uni_college_relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pt_uni_college_relation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kuni_id` bigint(20) NOT NULL,
  `kcollege_id` bigint(20) NOT NULL,
  `college_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pt_uni_college_relation`
--

LOCK TABLES `pt_uni_college_relation` WRITE;
/*!40000 ALTER TABLE `pt_uni_college_relation` DISABLE KEYS */;
/*!40000 ALTER TABLE `pt_uni_college_relation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `credential` text,
  `admin_level` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Super Admin','[\"settings-manage\",\"settings-semester\",\"settings-standard\",\"settings-criteria\",\"settings-item\",\"settings-unit\",\"settings-campus\",\"settings-institution\",\"settings-college\",\"settings-department\",\"settings-degree\",\"settings-program\",\"settings-major\",\"settings-program_plan\",\"settings-course\",\"settings-course_section\",\"settings-user\",\"settings-role\",\"settings-login_as\",\"settings-notification\",\"settings-translation\",\"settings-jobs\",\"settings-accreditation_status\",\"setup-mission\",\"setup-vision\",\"setup-goal\",\"setup-objective\",\"dashboard-national_accreditation\",\"dashboard-international_accreditation\",\"dashboard-status\",\"dashboard-kpi\",\"dashboard-strategic_planning\",\"doc_repo-manage\",\"accreditation-list\",\"accreditation-manage\",\"accreditation-read\",\"accreditation-report\",\"alumni-list\",\"alumni-manage\",\"alumni-report\",\"assessment_loop-list\",\"assessment_loop-manage\",\"curriculum_mapping-list\",\"curriculum_mapping-manage\",\"curriculum_mapping-report\",\"curriculum_mapping-settings\",\"faculty_performance-settings\",\"faculty_performance-manage\",\"faculty_performance-report\",\"faculty_portfolio-list\",\"faculty_portfolio-manage\",\"faculty_portfolio-report\",\"kpi-list\",\"kpi-manage\",\"kpi-report\",\"kpi-values\",\"kpi-settings\",\"portfolio_course-list\",\"portfolio_course-manage\",\"portfolio_course-report\",\"program_tree-manage\",\"program_tree-edit\",\"program_tree-list\",\"strategic_planning-list\",\"strategic_planning-manage\",\"strategic_planning-report\",\"student_portfolio-list\",\"student_portfolio-manage\",\"student_portfolio-report\",\"survey_courses-list\",\"survey_courses-manage\",\"survey_courses-report\",\"survey_courses-evaluation\",\"survey_students-list\",\"survey_students-manage\",\"survey_students-report\",\"survey_students-evaluation\",\"survey_faculty-list\",\"survey_faculty-manage\",\"survey_faculty-report\",\"survey_faculty-evaluation\",\"survey_staff-list\",\"survey_staff-manage\",\"survey_staff-report\",\"survey_staff-evaluation\",\"survey_alumni-list\",\"survey_alumni-manage\",\"survey_alumni-report\",\"survey_alumni-evaluation\",\"survey_employer-list\",\"survey_employer-manage\",\"survey_employer-report\",\"survey_employer-evaluation\"]',5),(2,'College Coordinator','[\"setup-mission\",\"setup-vision\",\"setup-goal\",\"setup-objective\",\"dashboard-national_accreditation\",\"dashboard-international_accreditation\",\"dashboard-status\",\"dashboard-kpi\",\"dashboard-strategic_planning\",\"doc_repo-manage\",\"accreditation-list\",\"accreditation-manage\",\"accreditation-read\",\"accreditation-report\",\"alumni-list\",\"alumni-manage\",\"alumni-report\",\"assessment_loop-list\",\"assessment_loop-manage\",\"curriculum_mapping-list\",\"curriculum_mapping-manage\",\"curriculum_mapping-report\",\"curriculum_mapping-settings\",\"faculty_performance-settings\",\"faculty_performance-manage\",\"faculty_performance-report\",\"faculty_portfolio-list\",\"faculty_portfolio-manage\",\"faculty_portfolio-report\",\"kpi-list\",\"kpi-manage\",\"kpi-report\",\"kpi-values\",\"kpi-settings\",\"portfolio_course-list\",\"portfolio_course-manage\",\"portfolio_course-report\",\"program_tree-manage\",\"program_tree-edit\",\"program_tree-list\",\"strategic_planning-list\",\"strategic_planning-manage\",\"strategic_planning-report\",\"student_portfolio-list\",\"student_portfolio-manage\",\"student_portfolio-report\",\"survey_courses-list\",\"survey_courses-manage\",\"survey_courses-report\",\"survey_courses-evaluation\",\"survey_students-list\",\"survey_students-manage\",\"survey_students-report\",\"survey_students-evaluation\",\"survey_faculty-list\",\"survey_faculty-manage\",\"survey_faculty-report\",\"survey_faculty-evaluation\",\"survey_staff-list\",\"survey_staff-manage\",\"survey_staff-report\",\"survey_staff-evaluation\",\"survey_alumni-list\",\"survey_alumni-manage\",\"survey_alumni-report\",\"survey_alumni-evaluation\",\"survey_employer-list\",\"survey_employer-manage\",\"survey_employer-report\",\"survey_employer-evaluation\"]',4),(3,'Program Coordinator','[\"setup-mission\",\"setup-vision\",\"setup-goal\",\"setup-objective\",\"dashboard-national_accreditation\",\"dashboard-international_accreditation\",\"dashboard-status\",\"dashboard-kpi\",\"dashboard-strategic_planning\",\"doc_repo-manage\",\"accreditation-list\",\"accreditation-manage\",\"accreditation-read\",\"accreditation-report\",\"alumni-list\",\"alumni-manage\",\"alumni-report\",\"assessment_loop-list\",\"assessment_loop-manage\",\"curriculum_mapping-list\",\"curriculum_mapping-manage\",\"curriculum_mapping-report\",\"curriculum_mapping-settings\",\"faculty_performance-settings\",\"faculty_performance-manage\",\"faculty_performance-report\",\"faculty_portfolio-list\",\"faculty_portfolio-manage\",\"faculty_portfolio-report\",\"kpi-list\",\"kpi-manage\",\"kpi-report\",\"kpi-values\",\"kpi-settings\",\"portfolio_course-list\",\"portfolio_course-manage\",\"portfolio_course-report\",\"program_tree-manage\",\"program_tree-edit\",\"program_tree-list\",\"strategic_planning-list\",\"strategic_planning-manage\",\"strategic_planning-report\",\"student_portfolio-list\",\"student_portfolio-manage\",\"student_portfolio-report\",\"survey_courses-list\",\"survey_courses-manage\",\"survey_courses-report\",\"survey_courses-evaluation\",\"survey_students-list\",\"survey_students-manage\",\"survey_students-report\",\"survey_students-evaluation\",\"survey_faculty-list\",\"survey_faculty-manage\",\"survey_faculty-report\",\"survey_faculty-evaluation\",\"survey_staff-list\",\"survey_staff-manage\",\"survey_staff-report\",\"survey_staff-evaluation\",\"survey_alumni-list\",\"survey_alumni-manage\",\"survey_alumni-report\",\"survey_alumni-evaluation\",\"survey_employer-list\",\"survey_employer-manage\",\"survey_employer-report\",\"survey_employer-evaluation\"]',2),(4,'Teacher','[\"accreditation-list\",\"accreditation-manage\",\"accreditation-read\",\"accreditation-report\",\"curriculum_mapping-list\",\"curriculum_mapping-manage\",\"curriculum_mapping-report\",\"curriculum_mapping-settings\",\"faculty_performance-settings\",\"faculty_performance-manage\",\"faculty_performance-report\",\"faculty_portfolio-list\",\"faculty_portfolio-manage\",\"faculty_portfolio-report\",\"portfolio_course-list\",\"portfolio_course-manage\",\"portfolio_course-report\",\"student_portfolio-list\",\"student_portfolio-manage\",\"student_portfolio-report\"]',1),(5,'Employee','[]',1),(6,'Reviewer','[\"accreditation-list\",\"accreditation-manage\",\"accreditation-read\",\"accreditation-report\"]',1);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `semester`
--

DROP TABLE IF EXISTS `semester`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `semester` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `integration_id` bigint(20) NOT NULL DEFAULT '0',
  `year` int(11) NOT NULL DEFAULT '0',
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `name_en` varchar(255) NOT NULL DEFAULT '',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `name_ar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `integration_idx` (`integration_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `semester`
--

LOCK TABLES `semester` WRITE;
/*!40000 ALTER TABLE `semester` DISABLE KEYS */;
/*!40000 ALTER TABLE `semester` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_action_plan`
--

DROP TABLE IF EXISTS `sp_action_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_action_plan` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `initiative_id` bigint(20) NOT NULL DEFAULT '0',
  `responsible_id` bigint(20) NOT NULL DEFAULT '0',
  `title_en` varchar(255) NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `budget` decimal(10,2) NOT NULL DEFAULT '0.00',
  `resources` text,
  `lead` float NOT NULL DEFAULT '0',
  `lag` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_action_plan`
--

LOCK TABLES `sp_action_plan` WRITE;
/*!40000 ALTER TABLE `sp_action_plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_action_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_action_plan_history`
--

DROP TABLE IF EXISTS `sp_action_plan_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_action_plan_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `action_plan_id` bigint(20) NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  `lead` float NOT NULL DEFAULT '0',
  `lag` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_action_plan_history`
--

LOCK TABLES `sp_action_plan_history` WRITE;
/*!40000 ALTER TABLE `sp_action_plan_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_action_plan_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_action_plan_recommend`
--

DROP TABLE IF EXISTS `sp_action_plan_recommend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_action_plan_recommend` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `action_plan_id` bigint(20) NOT NULL DEFAULT '0',
  `recommend_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `action_plan_idx` (`action_plan_id`,`recommend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_action_plan_recommend`
--

LOCK TABLES `sp_action_plan_recommend` WRITE;
/*!40000 ALTER TABLE `sp_action_plan_recommend` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_action_plan_recommend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_activity`
--

DROP TABLE IF EXISTS `sp_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_activity` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) NOT NULL DEFAULT '0',
  `title_en` varchar(255) NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `weight` int(11) DEFAULT '0',
  `lead` float NOT NULL DEFAULT '0',
  `lag` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_activity`
--

LOCK TABLES `sp_activity` WRITE;
/*!40000 ALTER TABLE `sp_activity` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_activity_history`
--

DROP TABLE IF EXISTS `sp_activity_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_activity_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `activity_id` bigint(20) NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  `lead` float NOT NULL DEFAULT '0',
  `lag` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_activity_history`
--

LOCK TABLES `sp_activity_history` WRITE;
/*!40000 ALTER TABLE `sp_activity_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_activity_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_activity_milestone`
--

DROP TABLE IF EXISTS `sp_activity_milestone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_activity_milestone` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `activity_id` bigint(20) NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  `value` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_activity_milestone`
--

LOCK TABLES `sp_activity_milestone` WRITE;
/*!40000 ALTER TABLE `sp_activity_milestone` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_activity_milestone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_bi_monthly_report`
--

DROP TABLE IF EXISTS `sp_bi_monthly_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_bi_monthly_report` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `action_plan_id` bigint(20) NOT NULL DEFAULT '0',
  `date_generated` datetime NOT NULL,
  `approved_by` varchar(255) DEFAULT NULL,
  `summary_report` text,
  `completion_certifed` varchar(255) DEFAULT NULL,
  `date_completed` datetime DEFAULT NULL,
  `next_steps` text,
  `timeline_actions` text,
  `overall_approval_by` text,
  PRIMARY KEY (`id`),
  KEY `action_plan_idx` (`action_plan_id`,`date_generated`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_bi_monthly_report`
--

LOCK TABLES `sp_bi_monthly_report` WRITE;
/*!40000 ALTER TABLE `sp_bi_monthly_report` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_bi_monthly_report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_bi_monthly_summary`
--

DROP TABLE IF EXISTS `sp_bi_monthly_summary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_bi_monthly_summary` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `action_plan_id` bigint(20) NOT NULL DEFAULT '0',
  `date_generated` datetime NOT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `signatory_program` text,
  `signatory_mentor` text,
  PRIMARY KEY (`id`),
  KEY `action_plan_idx` (`action_plan_id`,`date_generated`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_bi_monthly_summary`
--

LOCK TABLES `sp_bi_monthly_summary` WRITE;
/*!40000 ALTER TABLE `sp_bi_monthly_summary` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_bi_monthly_summary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_goal`
--

DROP TABLE IF EXISTS `sp_goal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_goal` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `strategy_id` bigint(20) NOT NULL DEFAULT '0',
  `goal_id` bigint(20) NOT NULL DEFAULT '0',
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `parent_lft` int(11) NOT NULL DEFAULT '0',
  `parent_rtl` int(11) NOT NULL DEFAULT '0',
  `title_en` varchar(255) NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `code` varchar(45) NOT NULL,
  `lead` float NOT NULL DEFAULT '0',
  `lag` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_goal`
--

LOCK TABLES `sp_goal` WRITE;
/*!40000 ALTER TABLE `sp_goal` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_goal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_goal_goal`
--

DROP TABLE IF EXISTS `sp_goal_goal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_goal_goal` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sp_goal_id` bigint(20) NOT NULL,
  `goal_id` bigint(20) NOT NULL,
  `goal_class_type` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_goal_goal`
--

LOCK TABLES `sp_goal_goal` WRITE;
/*!40000 ALTER TABLE `sp_goal_goal` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_goal_goal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_goal_history`
--

DROP TABLE IF EXISTS `sp_goal_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_goal_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `goal_id` bigint(20) NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  `lead` float NOT NULL DEFAULT '0',
  `lag` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_goal_history`
--

LOCK TABLES `sp_goal_history` WRITE;
/*!40000 ALTER TABLE `sp_goal_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_goal_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_initiative`
--

DROP TABLE IF EXISTS `sp_initiative`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_initiative` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `objective_id` bigint(20) NOT NULL DEFAULT '0',
  `owner_id` bigint(20) DEFAULT '0',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `code` varchar(45) DEFAULT NULL,
  `title_en` varchar(255) NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `lead` float NOT NULL DEFAULT '0',
  `lag` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_initiative`
--

LOCK TABLES `sp_initiative` WRITE;
/*!40000 ALTER TABLE `sp_initiative` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_initiative` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_initiative_history`
--

DROP TABLE IF EXISTS `sp_initiative_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_initiative_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `initiative_id` bigint(20) NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  `lead` float NOT NULL DEFAULT '0',
  `lag` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_initiative_history`
--

LOCK TABLES `sp_initiative_history` WRITE;
/*!40000 ALTER TABLE `sp_initiative_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_initiative_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_initiative_milestone`
--

DROP TABLE IF EXISTS `sp_initiative_milestone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_initiative_milestone` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `initiative_id` bigint(20) NOT NULL,
  `year` int(11) NOT NULL,
  `target` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_initiative_milestone`
--

LOCK TABLES `sp_initiative_milestone` WRITE;
/*!40000 ALTER TABLE `sp_initiative_milestone` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_initiative_milestone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_kpi`
--

DROP TABLE IF EXISTS `sp_kpi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_kpi` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kpi_id` bigint(20) NOT NULL DEFAULT '0',
  `type_id` bigint(20) NOT NULL DEFAULT '0',
  `class_type` varchar(128) NOT NULL,
  `polarity` tinyint(1) NOT NULL DEFAULT '0',
  `band` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_kpi`
--

LOCK TABLES `sp_kpi` WRITE;
/*!40000 ALTER TABLE `sp_kpi` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_kpi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_kpi_history`
--

DROP TABLE IF EXISTS `sp_kpi_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_kpi_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kpi_id` bigint(20) NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  `band` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_kpi_history`
--

LOCK TABLES `sp_kpi_history` WRITE;
/*!40000 ALTER TABLE `sp_kpi_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_kpi_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_objective`
--

DROP TABLE IF EXISTS `sp_objective`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_objective` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `strategy_id` bigint(20) NOT NULL DEFAULT '0',
  `goal_id` bigint(20) NOT NULL DEFAULT '0',
  `objective_id` bigint(20) NOT NULL DEFAULT '0',
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `parent_lft` int(11) NOT NULL DEFAULT '0',
  `parent_rtl` int(11) NOT NULL DEFAULT '0',
  `code` varchar(45) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description_en` text NOT NULL,
  `description_ar` text NOT NULL,
  `owner_id` bigint(20) NOT NULL DEFAULT '0',
  `budget` float NOT NULL DEFAULT '0',
  `resources` text NOT NULL,
  `lead` float NOT NULL DEFAULT '0',
  `lag` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_objective`
--

LOCK TABLES `sp_objective` WRITE;
/*!40000 ALTER TABLE `sp_objective` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_objective` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_objective_history`
--

DROP TABLE IF EXISTS `sp_objective_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_objective_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `objective_id` bigint(20) NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  `lead` float NOT NULL DEFAULT '0',
  `lag` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_objective_history`
--

LOCK TABLES `sp_objective_history` WRITE;
/*!40000 ALTER TABLE `sp_objective_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_objective_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_objective_milestone`
--

DROP TABLE IF EXISTS `sp_objective_milestone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_objective_milestone` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `objective_id` bigint(20) NOT NULL,
  `year` int(11) NOT NULL,
  `target` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_objective_milestone`
--

LOCK TABLES `sp_objective_milestone` WRITE;
/*!40000 ALTER TABLE `sp_objective_milestone` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_objective_milestone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_objective_objective`
--

DROP TABLE IF EXISTS `sp_objective_objective`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_objective_objective` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sp_objective_id` bigint(20) NOT NULL,
  `objective_id` bigint(20) NOT NULL,
  `objective_class_type` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_objective_objective`
--

LOCK TABLES `sp_objective_objective` WRITE;
/*!40000 ALTER TABLE `sp_objective_objective` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_objective_objective` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_objective_perspective`
--

DROP TABLE IF EXISTS `sp_objective_perspective`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_objective_perspective` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `objective_id` bigint(20) DEFAULT NULL,
  `perspective` enum('none','customer','learning_and_growth','internal_processes','finance') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_objective_perspective`
--

LOCK TABLES `sp_objective_perspective` WRITE;
/*!40000 ALTER TABLE `sp_objective_perspective` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_objective_perspective` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_overall_action_plan`
--

DROP TABLE IF EXISTS `sp_overall_action_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_overall_action_plan` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `action_plan_id` bigint(20) NOT NULL DEFAULT '0',
  `date_generated` datetime NOT NULL,
  `academic_year` varchar(125) DEFAULT NULL,
  `completion_certifed` text,
  `date_completed` datetime DEFAULT NULL,
  `perpared_by` varchar(255) DEFAULT NULL,
  `accepted_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `action_plan_idx` (`action_plan_id`,`date_generated`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_overall_action_plan`
--

LOCK TABLES `sp_overall_action_plan` WRITE;
/*!40000 ALTER TABLE `sp_overall_action_plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_overall_action_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_project`
--

DROP TABLE IF EXISTS `sp_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_project` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `action_plan_id` bigint(20) NOT NULL DEFAULT '0',
  `project_id` bigint(20) NOT NULL DEFAULT '0',
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `parent_lft` int(11) NOT NULL DEFAULT '0',
  `parent_rtl` int(11) NOT NULL DEFAULT '0',
  `title_en` varchar(255) NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `budget` decimal(10,2) DEFAULT NULL,
  `resources` text,
  `desc_en` text,
  `desc_ar` text,
  `lead` float NOT NULL DEFAULT '0',
  `lag` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_project`
--

LOCK TABLES `sp_project` WRITE;
/*!40000 ALTER TABLE `sp_project` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_project_history`
--

DROP TABLE IF EXISTS `sp_project_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_project_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  `lead` float NOT NULL DEFAULT '0',
  `lag` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_project_history`
--

LOCK TABLES `sp_project_history` WRITE;
/*!40000 ALTER TABLE `sp_project_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_project_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_reason_action_plan`
--

DROP TABLE IF EXISTS `sp_reason_action_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_reason_action_plan` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `overall_id` bigint(20) NOT NULL DEFAULT '0',
  `reason_type` varchar(125) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  KEY `overall_idx` (`overall_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_reason_action_plan`
--

LOCK TABLES `sp_reason_action_plan` WRITE;
/*!40000 ALTER TABLE `sp_reason_action_plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_reason_action_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_recommendation`
--

DROP TABLE IF EXISTS `sp_recommendation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_recommendation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `recommendation_type_id` bigint(20) NOT NULL DEFAULT '0',
  `program_id` bigint(20) NOT NULL DEFAULT '0',
  `academic_year` int(11) NOT NULL DEFAULT '0',
  `title_en` varchar(255) NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_recommendation`
--

LOCK TABLES `sp_recommendation` WRITE;
/*!40000 ALTER TABLE `sp_recommendation` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_recommendation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_recommendation_type`
--

DROP TABLE IF EXISTS `sp_recommendation_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_recommendation_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title_en` varchar(255) NOT NULL DEFAULT '',
  `title_ar` varchar(255) NOT NULL DEFAULT '',
  `code` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_recommendation_type`
--

LOCK TABLES `sp_recommendation_type` WRITE;
/*!40000 ALTER TABLE `sp_recommendation_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_recommendation_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_risk_tab`
--

DROP TABLE IF EXISTS `sp_risk_tab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_risk_tab` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type_id` bigint(20) NOT NULL DEFAULT '0',
  `class_type` varchar(128) NOT NULL,
  `risk` text,
  `impact` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_risk_tab`
--

LOCK TABLES `sp_risk_tab` WRITE;
/*!40000 ALTER TABLE `sp_risk_tab` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_risk_tab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_strategy`
--

DROP TABLE IF EXISTS `sp_strategy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_strategy` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `strategy_id` bigint(20) NOT NULL DEFAULT '0',
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `parent_lft` int(11) NOT NULL DEFAULT '0',
  `parent_rgt` int(11) NOT NULL DEFAULT '0',
  `item_class` varchar(255) NOT NULL,
  `item_id` bigint(20) NOT NULL DEFAULT '0',
  `year` int(11) NOT NULL DEFAULT '0',
  `title_en` varchar(255) NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `vision_en` text NOT NULL,
  `vision_ar` text NOT NULL,
  `mission_en` text NOT NULL,
  `mission_ar` text NOT NULL,
  `description_en` text NOT NULL,
  `description_ar` text NOT NULL,
  `lead` float NOT NULL DEFAULT '0',
  `lag` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_strategy`
--

LOCK TABLES `sp_strategy` WRITE;
/*!40000 ALTER TABLE `sp_strategy` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_strategy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_strategy_history`
--

DROP TABLE IF EXISTS `sp_strategy_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_strategy_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `strategy_id` bigint(20) NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  `lead` float NOT NULL DEFAULT '0',
  `lag` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_strategy_history`
--

LOCK TABLES `sp_strategy_history` WRITE;
/*!40000 ALTER TABLE `sp_strategy_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_strategy_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_values`
--

DROP TABLE IF EXISTS `sp_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_values` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `strategy_id` bigint(20) NOT NULL DEFAULT '0',
  `title_en` varchar(255) NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `desc_en` text,
  `desc_ar` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_values`
--

LOCK TABLES `sp_values` WRITE;
/*!40000 ALTER TABLE `sp_values` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `standard`
--

DROP TABLE IF EXISTS `standard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `standard` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `title` varchar(155) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_added` int(11) NOT NULL,
  `date_modified` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `standard`
--

LOCK TABLES `standard` WRITE;
/*!40000 ALTER TABLE `standard` DISABLE KEYS */;
INSERT INTO `standard` VALUES (1,'1','Mission Goals and Objectives',0,0,0,0),(2,'2','Governance and Administration',0,0,0,0),(3,'3','Management of Quality Assurance and Improvement',0,0,0,0),(4,'4','Learning and Teaching',0,0,0,0),(5,'5','Student Administration and Support Services',0,0,0,0),(6,'6','Learning Resources',0,0,0,0),(7,'7','Facilities and Equipment',0,0,0,0),(8,'8','Financial Planning and Management',0,0,0,0),(9,'9','Employment Processes',0,0,0,0),(10,'10','Research',0,0,0,0),(11,'11','Relationships with the Community',0,0,0,0);
/*!40000 ALTER TABLE `standard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stp_academic`
--

DROP TABLE IF EXISTS `stp_academic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stp_academic` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) NOT NULL,
  `lms_link` varchar(45) DEFAULT NULL,
  `edugate_link` varchar(45) DEFAULT NULL,
  `student_academic_advicing` text,
  PRIMARY KEY (`id`,`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stp_academic`
--

LOCK TABLES `stp_academic` WRITE;
/*!40000 ALTER TABLE `stp_academic` DISABLE KEYS */;
/*!40000 ALTER TABLE `stp_academic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stp_activities`
--

DROP TABLE IF EXISTS `stp_activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stp_activities` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stp_activities`
--

LOCK TABLES `stp_activities` WRITE;
/*!40000 ALTER TABLE `stp_activities` DISABLE KEYS */;
/*!40000 ALTER TABLE `stp_activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stp_awards_and_publications`
--

DROP TABLE IF EXISTS `stp_awards_and_publications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stp_awards_and_publications` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) DEFAULT NULL,
  `title` tinytext,
  `publish_date` date DEFAULT NULL,
  `attachement` varchar(150) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stp_awards_and_publications`
--

LOCK TABLES `stp_awards_and_publications` WRITE;
/*!40000 ALTER TABLE `stp_awards_and_publications` DISABLE KEYS */;
/*!40000 ALTER TABLE `stp_awards_and_publications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stp_community_services`
--

DROP TABLE IF EXISTS `stp_community_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stp_community_services` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `number_of_hours` int(5) DEFAULT NULL,
  `supervisor` varchar(100) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stp_community_services`
--

LOCK TABLES `stp_community_services` WRITE;
/*!40000 ALTER TABLE `stp_community_services` DISABLE KEYS */;
/*!40000 ALTER TABLE `stp_community_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stp_complaints`
--

DROP TABLE IF EXISTS `stp_complaints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stp_complaints` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) DEFAULT NULL,
  `attachement` varchar(150) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `complaints` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stp_complaints`
--

LOCK TABLES `stp_complaints` WRITE;
/*!40000 ALTER TABLE `stp_complaints` DISABLE KEYS */;
/*!40000 ALTER TABLE `stp_complaints` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stp_personal`
--

DROP TABLE IF EXISTS `stp_personal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stp_personal` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) DEFAULT NULL,
  `resume` varchar(150) DEFAULT NULL,
  `personal_goals` text,
  `hobbies` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stp_personal`
--

LOCK TABLES `stp_personal` WRITE;
/*!40000 ALTER TABLE `stp_personal` DISABLE KEYS */;
/*!40000 ALTER TABLE `stp_personal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stp_recommendations`
--

DROP TABLE IF EXISTS `stp_recommendations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stp_recommendations` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `attachement` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stp_recommendations`
--

LOCK TABLES `stp_recommendations` WRITE;
/*!40000 ALTER TABLE `stp_recommendations` DISABLE KEYS */;
/*!40000 ALTER TABLE `stp_recommendations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stp_social`
--

DROP TABLE IF EXISTS `stp_social`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stp_social` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) DEFAULT NULL,
  `facebook` varchar(128) DEFAULT NULL,
  `tweeter` varchar(128) DEFAULT NULL,
  `linkedin` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stp_social`
--

LOCK TABLES `stp_social` WRITE;
/*!40000 ALTER TABLE `stp_social` DISABLE KEYS */;
/*!40000 ALTER TABLE `stp_social` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_status`
--

DROP TABLE IF EXISTS `student_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_status` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name_ar` varchar(128) NOT NULL,
  `name_en` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_status`
--

LOCK TABLES `student_status` WRITE;
/*!40000 ALTER TABLE `student_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_status_log`
--

DROP TABLE IF EXISTS `student_status_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_status_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) NOT NULL,
  `status_id` bigint(20) NOT NULL,
  `semester_id` bigint(20) NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_status_log`
--

LOCK TABLES `student_status_log` WRITE;
/*!40000 ALTER TABLE `student_status_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_status_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `survey`
--

DROP TABLE IF EXISTS `survey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `survey` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title_english` varchar(255) NOT NULL DEFAULT '',
  `title_arabic` varchar(255) NOT NULL DEFAULT '',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_survey_created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey`
--

LOCK TABLES `survey` WRITE;
/*!40000 ALTER TABLE `survey` DISABLE KEYS */;
/*!40000 ALTER TABLE `survey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `survey_evaluation`
--

DROP TABLE IF EXISTS `survey_evaluation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `survey_evaluation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `survey_id` bigint(20) NOT NULL DEFAULT '0',
  `semester_id` bigint(20) NOT NULL DEFAULT '0',
  `description_english` text NOT NULL,
  `description_arabic` text NOT NULL,
  `criteria` text NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sk_survey_evaluation_created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_evaluation`
--

LOCK TABLES `survey_evaluation` WRITE;
/*!40000 ALTER TABLE `survey_evaluation` DISABLE KEYS */;
/*!40000 ALTER TABLE `survey_evaluation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `survey_evaluator`
--

DROP TABLE IF EXISTS `survey_evaluator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `survey_evaluator` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `survey_evaluation_id` bigint(20) NOT NULL DEFAULT '0',
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `hash_code` varchar(100) NOT NULL DEFAULT '',
  `response_status` tinyint(1) NOT NULL DEFAULT '0',
  `response_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_evaluator`
--

LOCK TABLES `survey_evaluator` WRITE;
/*!40000 ALTER TABLE `survey_evaluator` DISABLE KEYS */;
/*!40000 ALTER TABLE `survey_evaluator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `survey_page`
--

DROP TABLE IF EXISTS `survey_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `survey_page` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `survey_id` bigint(20) NOT NULL DEFAULT '0',
  `title_english` varchar(255) NOT NULL DEFAULT '',
  `title_arabic` varchar(255) NOT NULL DEFAULT '',
  `description_english` text NOT NULL,
  `description_arabic` text NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_survey_page_survey_id` (`survey_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_page`
--

LOCK TABLES `survey_page` WRITE;
/*!40000 ALTER TABLE `survey_page` DISABLE KEYS */;
/*!40000 ALTER TABLE `survey_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `survey_question`
--

DROP TABLE IF EXISTS `survey_question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `survey_question` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `page_id` bigint(20) NOT NULL DEFAULT '0',
  `class_type` varchar(255) NOT NULL DEFAULT '',
  `question_english` text NOT NULL,
  `question_arabic` text NOT NULL,
  `description_english` text NOT NULL,
  `description_arabic` text NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `is_require` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_survey_question_page_id` (`page_id`),
  KEY `fk_survey_question_question_type_id` (`class_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_question`
--

LOCK TABLES `survey_question` WRITE;
/*!40000 ALTER TABLE `survey_question` DISABLE KEYS */;
/*!40000 ALTER TABLE `survey_question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `survey_question_choice`
--

DROP TABLE IF EXISTS `survey_question_choice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `survey_question_choice` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `question_id` bigint(20) NOT NULL DEFAULT '0',
  `choice_english` varchar(255) NOT NULL DEFAULT '',
  `choice_arabic` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `fk_survey_question_choice_question_id` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_question_choice`
--

LOCK TABLES `survey_question_choice` WRITE;
/*!40000 ALTER TABLE `survey_question_choice` DISABLE KEYS */;
/*!40000 ALTER TABLE `survey_question_choice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `survey_question_factor`
--

DROP TABLE IF EXISTS `survey_question_factor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `survey_question_factor` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `question_id` bigint(20) NOT NULL DEFAULT '0',
  `title_english` varchar(255) NOT NULL DEFAULT '',
  `title_arabic` varchar(255) NOT NULL DEFAULT '',
  `abbreviation_english` varchar(45) NOT NULL DEFAULT '',
  `abbreviation_arabic` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `fk_survey_question_column_label_question_id` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_question_factor`
--

LOCK TABLES `survey_question_factor` WRITE;
/*!40000 ALTER TABLE `survey_question_factor` DISABLE KEYS */;
/*!40000 ALTER TABLE `survey_question_factor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `survey_question_statement`
--

DROP TABLE IF EXISTS `survey_question_statement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `survey_question_statement` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `factor_id` bigint(20) NOT NULL DEFAULT '0',
  `title_english` varchar(255) NOT NULL DEFAULT '',
  `title_arabic` varchar(255) NOT NULL DEFAULT '',
  `abbreviation_english` varchar(45) NOT NULL DEFAULT '',
  `abbreviation_arabic` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_question_statement`
--

LOCK TABLES `survey_question_statement` WRITE;
/*!40000 ALTER TABLE `survey_question_statement` DISABLE KEYS */;
/*!40000 ALTER TABLE `survey_question_statement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `survey_user_response_choice`
--

DROP TABLE IF EXISTS `survey_user_response_choice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `survey_user_response_choice` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `question_id` bigint(20) NOT NULL DEFAULT '0',
  `survey_evaluator_id` bigint(20) NOT NULL DEFAULT '0',
  `choice_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_user_response_choice`
--

LOCK TABLES `survey_user_response_choice` WRITE;
/*!40000 ALTER TABLE `survey_user_response_choice` DISABLE KEYS */;
/*!40000 ALTER TABLE `survey_user_response_choice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `survey_user_response_factor`
--

DROP TABLE IF EXISTS `survey_user_response_factor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `survey_user_response_factor` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `question_id` bigint(20) NOT NULL DEFAULT '0',
  `survey_evaluator_id` bigint(20) NOT NULL DEFAULT '0',
  `statement_id` bigint(20) NOT NULL DEFAULT '0',
  `rank` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_user_response_factor`
--

LOCK TABLES `survey_user_response_factor` WRITE;
/*!40000 ALTER TABLE `survey_user_response_factor` DISABLE KEYS */;
/*!40000 ALTER TABLE `survey_user_response_factor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `survey_user_response_text`
--

DROP TABLE IF EXISTS `survey_user_response_text`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `survey_user_response_text` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `question_id` bigint(20) NOT NULL DEFAULT '0',
  `survey_evaluator_id` bigint(20) NOT NULL DEFAULT '0',
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_user_response_text`
--

LOCK TABLES `survey_user_response_text` WRITE;
/*!40000 ALTER TABLE `survey_user_response_text` DISABLE KEYS */;
/*!40000 ALTER TABLE `survey_user_response_text` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `from` int(11) DEFAULT NULL,
  `to` int(11) DEFAULT NULL,
  `text` text,
  `time` datetime DEFAULT NULL,
  `done` int(1) DEFAULT '0',
  `title` tinytext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thread`
--

DROP TABLE IF EXISTS `thread`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thread` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `last_message_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thread`
--

LOCK TABLES `thread` WRITE;
/*!40000 ALTER TABLE `thread` DISABLE KEYS */;
/*!40000 ALTER TABLE `thread` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thread_group`
--

DROP TABLE IF EXISTS `thread_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thread_group` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `group_name_en` varchar(255) NOT NULL,
  `group_name_ar` varchar(255) NOT NULL,
  `group_desc_en` text,
  `group_desc_ar` text,
  `creator_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thread_group`
--

LOCK TABLES `thread_group` WRITE;
/*!40000 ALTER TABLE `thread_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `thread_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thread_group_members`
--

DROP TABLE IF EXISTS `thread_group_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thread_group_members` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `group_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thread_group_members`
--

LOCK TABLES `thread_group_members` WRITE;
/*!40000 ALTER TABLE `thread_group_members` DISABLE KEYS */;
/*!40000 ALTER TABLE `thread_group_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thread_message`
--

DROP TABLE IF EXISTS `thread_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thread_message` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `thread_id` bigint(20) NOT NULL,
  `sender_id` bigint(20) NOT NULL,
  `sent_date` datetime NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `body` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thread_message`
--

LOCK TABLES `thread_message` WRITE;
/*!40000 ALTER TABLE `thread_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `thread_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thread_message_read_state`
--

DROP TABLE IF EXISTS `thread_message_read_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thread_message_read_state` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `thread_message_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `read_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thread_message_read_state`
--

LOCK TABLES `thread_message_read_state` WRITE;
/*!40000 ALTER TABLE `thread_message_read_state` DISABLE KEYS */;
/*!40000 ALTER TABLE `thread_message_read_state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thread_participant`
--

DROP TABLE IF EXISTS `thread_participant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thread_participant` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `thread_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `is_important` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thread_participant`
--

LOCK TABLES `thread_participant` WRITE;
/*!40000 ALTER TABLE `thread_participant` DISABLE KEYS */;
/*!40000 ALTER TABLE `thread_participant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thread_participant_group`
--

DROP TABLE IF EXISTS `thread_participant_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thread_participant_group` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `thread_id` bigint(20) DEFAULT NULL,
  `type_class` varchar(45) DEFAULT NULL,
  `type_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thread_participant_group`
--

LOCK TABLES `thread_participant_group` WRITE;
/*!40000 ALTER TABLE `thread_participant_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `thread_participant_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translation`
--

DROP TABLE IF EXISTS `translation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `translation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `string` text NOT NULL,
  `translation` text NOT NULL,
  `language_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `string` (`string`(255)),
  KEY `language_id` (`language_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3521 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translation`
--

LOCK TABLES `translation` WRITE;
/*!40000 ALTER TABLE `translation` DISABLE KEYS */;
INSERT INTO `translation` VALUES (1,'a_strategy','استراتيجية',1),(2,'a_strategy','a Strategy',2),(3,'a_survey_has_not_been_set_in_the_settings_for_the_courses','هذا الاستبيان لم يتم وضعه في إعدادات المادة الدراسية',1),(4,'a_survey_has_not_been_set_in_the_settings_for_the_courses','A survey has not been set in the settings for the courses',2),(5,'abbreviation','الاختصار',1),(6,'abbreviation','Abbreviation',2),(7,'about','حول',1),(8,'about','About',2),(9,'about_me','بياناتي',1),(10,'about_me','About Me',2),(11,'about_me_changed_successfully','تم إدخال بياناتي بنجاح',1),(12,'about_me_changed_successfully','About Me Changed Successfully',2),(13,'academic','الأكاديمي',1),(14,'academic','Academic',2),(15,'academic_advising','نصائح أكاديمية',1),(16,'academic_advising','Academic Advising',2),(17,'academic_article','المادة الأكاديمية',1),(18,'academic_article','Academic Article',2),(19,'academic_dishonesty','عدم الامانة الأكاديمية',1),(20,'academic_dishonesty','Academic dishonesty',2),(21,'academic_dishonesty_policies','سياسات عدم الأمانة الأكاديمية',1),(22,'academic_dishonesty_policies','Academic Dishonesty Policies',2),(23,'academic_information','البيانات الأكاديمية',1),(24,'academic_information','Academic Information',2),(25,'academic_plagiarism','الانتحال الأكاديمي',1),(26,'academic_plagiarism','Academic plagiarism',2),(27,'academic_plagiarism_policies','سياسات الانتحال الأكاديمي',1),(28,'academic_plagiarism_policies','Academic Plagiarism Policies',2),(29,'academic_qualification','المؤهل العلمي',1),(30,'academic_qualification','Academic Qualification',2),(31,'academic_qualifications','المؤهلات العلمية',1),(32,'academic_qualifications','Academic Qualifications',2),(33,'academic_rank','الرتبة الأكاديمية',1),(34,'academic_rank','Academic Rank',2),(35,'academic_ranks','الرتب العلمية',1),(36,'academic_ranks','Academic Ranks',2),(37,'academic_unit','الوحدة الأكاديمية',1),(38,'academic_unit','Academic Unit',2),(39,'academic_year','السنة الأكاديمية',1),(40,'academic_year','Academic Year',2),(41,'accepted_for_international_conference','المقبولة للمؤتمرات الدولية',1),(42,'accepted_for_international_conference','Accepted for International Conference',2),(43,'account_settings','إعدادات الملف الشخصي',1),(44,'account_settings','Account Settings',2),(45,'accreditation','اعتماد',1),(46,'accreditation','Accreditation',2),(47,'accreditation_agency_removed_successfully','تم إزالة هيئة الاعتماد بنجاح',1),(48,'accreditation_agency_removed_successfully','Accreditation Agency removed successfully',2),(49,'accreditation_kpi','مؤشر الأداء الرئيسي للاعتماد',1),(50,'accreditation_kpi','Accreditation KPI',2),(51,'accreditation_kpis','مؤشرات الأداء الرئيسية للاعتماد',1),(52,'accreditation_kpis','Accreditation KPIs',2),(53,'accreditation_kpis_benchmarks_report','تقرير مؤشر مؤشرات الأداء الرئيسية للاعتماد',1),(54,'accreditation_kpis_benchmarks_report','Accreditation KPIs Benchmarks Report',2),(55,'accreditation_kpis_details_report','التقرير التفصيلي لمؤشرات الأداء الخاصة بالإعتماد',1),(56,'accreditation_kpis_details_report','Accreditation KPIs Details Report',2),(57,'accreditation_kpis_trend_report','تقرير اتجاه مؤشرات الأداء الرئيسية للاعتماد',1),(58,'accreditation_kpis_trend_report','Accreditation KPIs Trend Report',2),(59,'accreditation_name','اسم الاعتماد',1),(60,'accreditation_name','Accreditation Name',2),(61,'accreditation_progress','تقدم الاعتماد',1),(62,'accreditation_progress','Accreditation Progress',2),(63,'accreditation_status','حالة الاعتماد',1),(64,'accreditation_status','Accreditation Status',2),(65,'accreditation_status_not_attached!','حالة الاعتماد غير مرفقة',1),(66,'accreditation_status_not_attached!','Accreditation Status Not Attached!',2),(67,'accreditation_status_not_found!','لم يتم العثور على حالة الاعتماد',1),(68,'accreditation_status_not_found!','Accreditation Status Not Found!',2),(69,'accreditation_status_settings','إعدادات حالات الاعتماد',1),(70,'accreditation_status_settings','Accreditation Status Settings',2),(71,'accreditation_status_successfully_saved','تم حفظ حالة الاعتماد بنجاح',1),(72,'accreditation_status_successfully_saved','Accreditation Status Successfully Saved',2),(73,'accreditation_to_fill','اعتماد للتعبئة',1),(74,'accreditation_to_fill','Accreditation To Fill',2),(75,'accreditation_to_review','اعتماد للمراجعة',1),(76,'accreditation_to_review','Accreditation To Review',2),(77,'accreditations','اعتمادات',1),(78,'accreditations','Accreditations',2),(79,'accredited','اعتمد',1),(80,'accredited','Accredited',2),(81,'accredited_years','سنوات الاعتماد',1),(82,'accredited_years','Accredited Years',2),(83,'achievement','إنجازات',1),(84,'achievement','Achievement',2),(85,'action','الإجراء',1),(86,'action','Action',2),(87,'action_has_entered','إجراء تم إدخاله',1),(88,'action_has_entered','Action has Entered',2),(89,'action_list','لائحة الإجراءات',1),(90,'action_list','Action List',2),(91,'action_plan','خطة العمل',1),(92,'action_plan','Action Plan',2),(93,'action_plan_description','وصف خطة العمل',1),(94,'action_plan_description','Action Plan Description',2),(95,'action_plan_list','لائحة خطة العمل',1),(96,'action_plan_list','Action Plan List',2),(97,'action_plan_removed_successfully','تم حذف خطة العمل بنجاح',1),(98,'action_plan_removed_successfully','Action Plan removed successfully',2),(99,'action_plan_successfully_saved','تم حفظ خطة العمل بنجاح',1),(100,'action_plan_successfully_saved','Action Plan Successfully Saved',2),(101,'action_plans','خطط العمل',1),(102,'action_plans','Action Plans',2),(103,'actions','الإجراءات',1),(104,'actions','Actions',2),(105,'active','نشط',1),(106,'active','Active',2),(107,'active_semester','الفصل الدراسي النشط',1),(108,'active_semester','Active Semester',2),(109,'activities','الأنشطة',1),(110,'activities','Activities',2),(111,'activity','نشاط',1),(112,'activity','Activity',2),(113,'activity_log','سجل الأنشطة',1),(114,'activity_log','Activity Log',2),(115,'activity_removed_successfully','تم حذف النشاط بنجاح',1),(116,'activity_removed_successfully','Activity removed successfully',2),(117,'activity_successfully_saved','تم حفظ النشاط بنجاح',1),(118,'activity_successfully_saved','Activity Successfully Saved',2),(119,'actual_benchmark','المؤشر الفعلي',1),(120,'actual_benchmark','Actual Benchmark',2),(121,'actual_performance','الأداء الفعلي',1),(122,'actual_performance','Actual Performance',2),(123,'add','إضافة',1),(124,'add','Add',2),(125,'add_questions_and_control_the_layout_and_structure_of_your_survey','إضافة الأسئلة والسيطرة على تخطيط وهيكل الاستبيانة الخاص بك',1),(126,'add_questions_and_control_the_layout_and_structure_of_your_survey','Add Questions and control the layout and structure of your survey',2),(127,'addition','إضافة',1),(128,'addition','Addition',2),(129,'additions_and_revision','الإضافات والمراجعة',1),(130,'additions_and_revision','Additions and Revision',2),(131,'additions_and_revisions','الإضافات والمراجعات',1),(132,'additions_and_revisions','Additions and Revisions',2),(133,'address','العنوان',1),(134,'address','Address',2),(135,'administrative_work','عمل إداري',1),(136,'administrative_work','Administrative Work',2),(137,'administrative_works','الأعمال الإدارية',1),(138,'administrative_works','Administrative Works',2),(139,'advanced_competency','الكفاءة المتقدمة',1),(140,'advanced_competency','Advanced Competency',2),(141,'advising','نصيحة',1),(142,'advising','Advising',2),(143,'advisings','النصائح',1),(144,'advisings','Advisings',2),(145,'agencies','الهيئات',1),(146,'agencies','Agencies',2),(147,'agency','الهيئة',1),(148,'agency','Agency',2),(149,'agency_already_exist','هيئة موجودة مسبقاً',1),(150,'agency_already_exist','agency already exist',2),(151,'agency_mapping','ربط الهيئات',1),(152,'agency_mapping','Agency Mapping',2),(153,'agreement_attachment','ارفاق الإتفاقية',1),(154,'agreement_attachment','Agreement Attachment',2),(155,'agreement_date','تاريخ الاتفاقية',1),(156,'agreement_date','Agreement Date',2),(157,'aims_integration','الارتباط مع AIMS',1),(158,'aims_integration','AIMS Integration',2),(159,'all_campus','جميع الأفرع',1),(160,'all_campus','All Campus',2),(161,'all_campuses','جميع الأفرع',1),(162,'all_campuses','All Campuses',2),(163,'all_college','جميع الكليات',1),(164,'all_college','All College',2),(165,'all_colleges','جميع الكليات',1),(166,'all_colleges','All Colleges',2),(167,'all_course','جميع المواد الدراسية',1),(168,'all_course','All Course',2),(169,'all_course_sections','جميع شعب المواد الدراسية',1),(170,'all_course_sections','All Course Sections',2),(171,'all_courses','جميع المواد الدراسية',1),(172,'all_courses','All Courses',2),(173,'all_courses_form_generated_successfully','تم تحميل جميع النماذج الخاصة بالمواد الدراسية بنجاح',1),(174,'all_courses_form_generated_successfully','All Courses Form Generated Successfully',2),(175,'all_deanship','جميع العمادات',1),(176,'all_deanship','All Deanship',2),(177,'all_degrees','جميع الدرجات',1),(178,'all_degrees','All Degrees',2),(179,'all_department','جميع الأقسام',1),(180,'all_department','All Department',2),(181,'all_field_is_required','جميع الحقول المطلوبة',1),(182,'all_field_is_required','All field is Required',2),(183,'all_languages','جميع اللغات',1),(184,'all_languages','All Languages',2),(185,'all_program','جميع البرامج',1),(186,'all_program','All Program',2),(187,'all_programs','جميع البرامج',1),(188,'all_programs','All Programs',2),(189,'all_role','جميع المسميات الوظيفية',1),(190,'all_role','All Role',2),(191,'all_section','جميع الشعب',1),(192,'all_section','All Section',2),(193,'all_semesters','جميع الفصول الدراسية',1),(194,'all_semesters','All Semesters',2),(195,'all_types','جميع الأنواع',1),(196,'all_types','All Types',2),(197,'all_unit','جميع الوحدات',1),(198,'all_unit','All Unit',2),(199,'all_units','جميع الوحد',1),(200,'all_units','All Units',2),(201,'all_years','جميع السنوات',1),(202,'all_years','All years',2),(203,'alumni','خريج',1),(204,'alumni','Alumni',2),(205,'alumni_center','مركز الخريجين',1),(206,'alumni_center','Alumni Center',2),(207,'alumni_works','أعمال الخريجين',1),(208,'alumni_works','Alumni works',2),(209,'an_error_encountered_during_importing_the_form','حدث خطأ أثناء عملية استيراد النموذج',1),(210,'an_error_encountered_during_importing_the_form','An error encountered during importing the form',2),(211,'an_error_encountered_during_revert_the_form','حدث خطأ أثناء عملية استرجاع الملف',1),(212,'an_error_encountered_during_revert_the_form','An error encountered during revert the form',2),(213,'analysis','التحليلات',1),(214,'analysis','Analysis',2),(215,'analysis_has_entered','تحليل تم إدخاله',1),(216,'analysis_has_entered','analysis has Entered',2),(217,'and_above','و أعلى',1),(218,'and_above','and above',2),(219,'and_the_min_value_is_0','وأقل قيمة هي 0',1),(220,'and_the_min_value_is_0','and The Min value is 0',2),(221,'and_the_total_of_all_rates_must_not_exceed_100','ومجموع جميع النسب لا يتجاوز 100',1),(222,'and_the_total_of_all_rates_must_not_exceed_100','and the total of all rates must not exceed 100',2),(223,'annual_overall','السنوي بشكل عام',1),(224,'annual_overall','Annual Overall',2),(225,'annual_overall_administrative_work_contribution_performance','أداء التعاون في الاشراف على العمل الكلي السنوي',1),(226,'annual_overall_administrative_work_contribution_performance','Annual Overall Administrative Work Contribution Performance',2),(227,'annual_overall_research_contributions_performance','أداء التعاون البحثي العام السنوي',1),(228,'annual_overall_research_contributions_performance','Annual Overall Research Contributions Performance',2),(229,'annual_overall_societal_responsibility_performance','أداء التعاون الاشتراكي الكلي السنوي',1),(230,'annual_overall_societal_responsibility_performance','Annual Overall Societal Responsibility Performance',2),(231,'another_factor','عامل آخر',1),(232,'another_factor','Another Factor',2),(233,'apply','تطبيق',1),(234,'apply','Apply',2),(235,'arabic','العربية',1),(236,'arabic','العربية',2),(237,'are_you_sure_?','هل أنت متأكد ؟',1),(238,'are_you_sure_?','Are you sure ?',2),(239,'are_you_sure_you_want_to_analyze_this_kpi.','هل أنت متأكد أنك تريد تحليل هذا المؤشر',1),(240,'are_you_sure_you_want_to_analyze_this_kpi.','Are you sure you want to analyze this KPI.',2),(241,'are_you_sure_you_want_to_apply_changes_to_the_form?','هل أنت متأكد من حفظ التعديلات على النموذج ؟',1),(242,'are_you_sure_you_want_to_apply_changes_to_the_form?','Are you sure you want to apply changes to the form?',2),(243,'assessed_students','الطللاب المقيّمين',1),(244,'assessed_students','Assessed Students',2),(245,'assessment_component','محتوى التقييم',1),(246,'assessment_component','Assessment Component',2),(247,'assessment_components','محتويات التقييم',1),(248,'assessment_components','Assessment Components',2),(249,'assessment_loop','دائرة التقييم',1),(250,'assessment_loop','Assessment Loop',2),(251,'assessment_loop_type','نوع دائرة التقييم',1),(252,'assessment_loop_type','Assessment Loop Type',2),(253,'assessment_method','طريقة التقييم',1),(254,'assessment_method','Assessment Method',2),(255,'assessment_method_instance','نموذج طريقة التقييم',1),(256,'assessment_method_instance','Assessment Method Instance',2),(257,'assessment_methods','طرق التقييم',1),(258,'assessment_methods','Assessment Methods',2),(259,'assessment_methods_dashboard','لوحة القيادة لطرق التقييم',1),(260,'assessment_methods_dashboard','Assessment Methods Dashboard',2),(261,'assessment_methods_defined','طرق التقييم المحددة',1),(262,'assessment_methods_defined','Assessment Methods Defined',2),(263,'assessment_methods_defined_in','طرق التقييم المحددة ب',1),(264,'assessment_methods_defined_in','Assessment methods defined in',2),(265,'assessment_methods_defined_in','طرق التقييم المحددة ب',1),(266,'assessment_methods_defined_in','Assessment methods defined in',2),(267,'assessor','مقيم',1),(268,'assessor','Assessor',2),(269,'assigned_date','التاريخ المحدد',1),(270,'assigned_date','Assigned Date',2),(271,'assigned_from','النموذج المحدد',1),(272,'assigned_from','Assigned From',2),(273,'assigned_to','مخصصة ل',1),(274,'assigned_to','Assigned To',2),(275,'assignment_&_exams_management','إدارة الوظائف والإختبارات',1),(276,'assignment_&_exams_management','Assignment & Exams Management',2),(277,'assignment_format','تصميم الوظيفة',1),(278,'assignment_format','Assignment format',2),(279,'assignment_title','عنوان الوظيفة',1),(280,'assignment_title','Assignment Title',2),(281,'assignment/exam_information','معلومات الاختبارات / الوظائف',1),(282,'assignment/exam_information','Assignment/Exam Information',2),(283,'assignments','الوظائف',1),(284,'assignments','Assignments',2),(285,'assignments,_exams_and_quizzes_information','بيانات الوظائف، الإختبارات والاختبارات القصيرة',1),(286,'assignments,_exams_and_quizzes_information','Assignments, Exams and Quizzes information',2),(287,'attachment','المرفق',1),(288,'attachment','Attachment',2),(289,'attendance','الحضور',1),(290,'attendance','Attendance',2),(291,'attendance_policies','سياسات الحضور',1),(292,'attendance_policies','Attendance Policies',2),(293,'author','المؤلف',1),(294,'author','Author',2),(295,'author_rank','رتبة المؤلف',1),(296,'author_rank','Author Rank',2),(297,'author_type','نوع المؤلف',1),(298,'author_type','Author Type',2),(299,'authorization_error','خطأ في التفويض',1),(300,'authorization_error','authorization Error',2),(301,'authors','اسم المرلف',1),(302,'authors','Authors',2),(303,'authors_count','عدد المؤلفين',1),(304,'authors_count','Authors Count',2),(305,'authorship_contribution','المساهمة في التأليف',1),(306,'authorship_contribution','Authorship Contribution',2),(307,'available_support_service','خدمة الدعم المتوفرة',1),(308,'available_support_service','Available Support service',2),(309,'available_support_services','خدمات الدعم المتوقرة',1),(310,'available_support_services','Available support services',2),(311,'available_support_services_for_course','خدمات الدعم المتوفرة للمادة الدراسية',1),(312,'available_support_services_for_course','Available support services for course',2),(313,'average','المعدل',1),(314,'average','Average',2),(315,'average_contribution','معدل المساهمة',1),(316,'average_contribution','Average contribution',2),(317,'average_evaluation','معدل التقييم',1),(318,'average_evaluation','Average Evaluation',2),(319,'average_initiative','معدل المبادرات',1),(320,'average_initiative','Average Initiative',2),(321,'average_participation','معدل المشاركة',1),(322,'average_participation','Average participation',2),(323,'average_performance','معدل الأداء',1),(324,'average_performance','Average Performance',2),(325,'avg._overall','متوسط القيم بشكل عام',1),(326,'avg._overall','Avg. Overall',2),(327,'avg._peer_assessed_score','معدل نقاط التقييم للنظير',1),(328,'avg._peer_assessed_score','Avg. Peer Assessed Score',2),(329,'avg._personal_assessed_score','معدل نقاط التقييم الشخصي',1),(330,'avg._personal_assessed_score','Avg. Personal Assessed Score',2),(331,'avg._supervisor_assessed_score','معدل نقاط التقييم للمشرف',1),(332,'avg._supervisor_assessed_score','Avg. Supervisor Assessed Score',2),(333,'award','جائزة',1),(334,'award','Award',2),(335,'award_title','اسم الجائزة',1),(336,'award_title','Award Title',2),(337,'awards','الجوائز',1),(338,'awards','Awards',2),(339,'back','رجوع',1),(340,'back','Back',2),(341,'backup','نسخة احتياطية',1),(342,'backup','Backup',2),(343,'backup_type','نوع النسخة الاحتياطية',1),(344,'backup_type','Backup Type',2),(345,'backups','النسخة الاحتياطية',1),(346,'backups','Backups',2),(347,'balanced_scorecard','بطاقة الأهداف المتوازنة',1),(348,'balanced_scorecard','Balanced Scorecard',2),(349,'band_performance','أداء الفرقة',1),(350,'band_performance','Band Performance',2),(351,'band_performance_legend','المسميات التوضيحية لأداء الفرق',1),(352,'band_performance_legend','Band Performance Legend',2),(353,'band_performance_legend_for_authorship_contribution','المسميات التوضيحية لأداء الفرقة والمتعلقة بالتعاون على التأليف',1),(354,'band_performance_legend_for_authorship_contribution','Band Performance Legend for Authorship Contribution',2),(355,'band_performance_legend_for_paper_status','المسمسيات التوضيحية ﻷداء الفرق لحالة الورق',1),(356,'band_performance_legend_for_paper_status','Band Performance Legend for Paper Status',2),(357,'basic_foundation','الركيزة الأساسية',1),(358,'basic_foundation','Basic Foundation',2),(359,'begin_by_searching_for_a_faculty_member.','البداية من خلال البحث عن عضو الهيئة التدريسية',1),(360,'begin_by_searching_for_a_faculty_member.','Begin by searching for a faculty member.',2),(361,'begin_by_searching_for_a_student.','البداية بالبحث عن طالب',1),(362,'begin_by_searching_for_a_student.','Begin by searching for a student.',2),(363,'below_average','أقل من المتوسط',1),(364,'below_average','Below Average',2),(365,'benchmarks','المؤشرات',1),(366,'benchmarks','Benchmarks',2),(367,'birth_date','تاريخ الميلاد',1),(368,'birth_date','Birth Date',2),(369,'body','الموضوع',1),(370,'body','Body',2),(371,'book','الكتاب',1),(372,'book','Book',2),(373,'book_title','اسم الكتاب',1),(374,'book_title','Book Title',2),(375,'books','الكتب',1),(376,'books','Books',2),(377,'both','كلاهما',1),(378,'both','Both',2),(379,'browse','استعراض',1),(380,'browse','Browse',2),(381,'budget','الميزانية',1),(382,'budget','Budget',2),(383,'build','بناء',1),(384,'build','Build',2),(385,'building_size','حجم المبنى',1),(386,'building_size','Building Size',2),(387,'by','بواسطة',1),(388,'by','by',2),(389,'campus','فرع الجامعة',1),(390,'campus','Campus',2),(391,'campuses','أفرع الجامعة',1),(392,'campuses','Campuses',2),(393,'can_edit','يمكن تعديله',1),(394,'can_edit','Can Edit',2),(395,'can_not_be_changed_in_edit_mode','لا يمكن التغيير في وضع التعديل',1),(396,'can_not_be_changed_in_edit_mode','Can not be changed in edit mode',2),(397,'cancel','إلغاء',1),(398,'cancel','Cancel',2),(399,'cancel_copy','إلغاء النسخ',1),(400,'cancel_copy','Cancel Copy',2),(401,'cancel_move','إلغاء النقل',1),(402,'cancel_move','Cancel Move',2),(403,'cannot_remove_the_selected_role_because_it_has_a_users_with_that_role','لا يمكن حذف المسمى الوظيفي لوجود مستخدمين بهذا المسمى',1),(404,'cannot_remove_the_selected_role_because_it_has_a_users_with_that_role','Can\'t remove the selected Role because it has a users with that role',2),(405,'career_opening','الافتتاح الوظيفي',1),(406,'career_opening','Career Opening',2),(407,'catalogue_information','معلومات الفهرس',1),(408,'catalogue_information','Catalogue information',2),(409,'category','فئة',1),(410,'category','Category',2),(411,'category_name','اسم الفئة',1),(412,'category_name','Category Name',2),(413,'category_settings','إعدادات الفئة',1),(414,'category_settings','Category Settings',2),(415,'cell_phone','رقم الهاتف',1),(416,'cell_phone','Cell Phone',2),(417,'change','تغيير',1),(418,'change','Change',2),(419,'change_image','تغيير الصورة',1),(420,'change_image','Change Image',2),(421,'change_password','تغيير كلمة السر',1),(422,'change_password','Change Password',2),(423,'check_all','تحديد الكل',1),(424,'check_all','Check All',2),(425,'check_read','تحديد المقروء',1),(426,'check_read','Check Read',2),(427,'check_starred','تحديد المميزة بنجمة',1),(428,'check_starred','Check Starred',2),(429,'check_unread','تحديد غير المقروء',1),(430,'check_unread','Check Unread',2),(431,'check_unstarred','تحديد غير المميزة بنجمة',1),(432,'check_unstarred','Check Unstarred',2),(433,'check_your_email','تحقق من البريد الإلكتروني الخاص بك',1),(434,'check_your_email','Check Your Email',2),(435,'child_goals_of','أهداف الطفل',1),(436,'child_goals_of','Child Goals of',2),(437,'child_objectives_of','غايات الطفل',1),(438,'child_objectives_of','Child Objectives of',2),(439,'choice','الخيارات',1),(440,'choice','Choice',2),(441,'choose_file...','اختر ملف...',1),(442,'choose_file...','Choose file...',2),(443,'choose_question_type','اختر نوع السؤال',1),(444,'choose_question_type','Choose Question Type',2),(445,'choose_unit_head','اختر رئيس الوحدة',1),(446,'choose_unit_head','Choose Unit Head',2),(447,'cited_paper_in_isi_journals','ورقة الاستشهاد في مجلات ISI',1),(448,'cited_paper_in_isi_journals','Cited Paper in ISI Journals',2),(449,'city','المدينة',1),(450,'city','City',2),(451,'class_participation','المشاركة في الحصة',1),(452,'class_participation','Class participation',2),(453,'class_participation_policies','سياسات المشاركة في الحصة',1),(454,'class_participation_policies','Class Participation Policies',2),(455,'classroom_location','موقع الغرفة الصفية',1),(456,'classroom_location','Classroom location',2),(457,'clear','إزالة',1),(458,'clear','Clear',2),(459,'click_link_to_download','أنقر على الرابط للتحميل',1),(460,'click_link_to_download','Click link to download',2),(461,'clo_result','نتائج مخرجات التعلم للمادة الدراسية',1),(462,'clo_result','CLO Result',2),(463,'close','إغلاق',1),(464,'close','Close',2),(465,'code','الرمز',1),(466,'code','Code',2),(467,'college','الكلية',1),(468,'college','College',2),(469,'college_benchmark','مؤشر الكلية',1),(470,'college_benchmark','College Benchmark',2),(471,'college_defined','كلية معرًفة',1),(472,'college_defined','College Defined',2),(473,'college_goals','أهداف الكلية',1),(474,'college_goals','College Goals',2),(475,'college_keyword','الكلمة المفتاحية للكلية',1),(476,'college_keyword','College Keyword',2),(477,'college_mission','رؤية الكلية',1),(478,'college_mission','College Mission',2),(479,'college_mission_keyword','الكلمة المفتاحية لرؤية الكلية',1),(480,'college_mission_keyword','College Mission Keyword',2),(481,'college_mission_keywords','الكلمات المفتاحية لرؤية الكلية',1),(482,'college_mission_keywords','College Mission Keywords',2),(483,'college_mission_keywords_to_be_displayed.','الكلمة المفتاحية للكلية ليتم عرضها',1),(484,'college_mission_keywords_to_be_displayed.','college mission Keywords to be displayed.',2),(485,'college_mission_to_be_displayed.','مهمة الكلية ليتم عرضها',1),(486,'college_mission_to_be_displayed.','college mission to be displayed.',2),(487,'college_objectives','غاية الكلية',1),(488,'college_objectives','College Objectives',2),(489,'college_performance','أداء الكلية',1),(490,'college_performance','college performance',2),(491,'college_program_data','بيانات برامج الكلية',1),(492,'college_program_data','College Program Data',2),(493,'college_report','تقرير الكلية',1),(494,'college_report','College Report',2),(495,'colleges','الكليات',1),(496,'colleges','Colleges',2),(497,'colleges_scores','نتائج الكلية',1),(498,'colleges_scores','Colleges Scores',2),(499,'color','اللون',1),(500,'color','Color',2),(501,'color_is_required','اللون مطلوب',1),(502,'color_is_required','Color is Required',2),(503,'comment','تعليق',1),(504,'comment','Comment',2),(505,'comment/essay_box','مقال\\تعليق',1),(506,'comment/essay_box','Comment/Essay Box',2),(507,'comments','التعليقات',1),(508,'comments','Comments',2),(509,'committee','لجنة',1),(510,'committee','Committee',2),(511,'committees','اللجان',1),(512,'committees','Committees',2),(513,'competencies_dimension','بعد الكفاءات',1),(514,'competencies_dimension','Competencies Dimension',2),(515,'complaint','شكوى',1),(516,'complaint','Complaint',2),(517,'complaints','الشكاوي',1),(518,'complaints','Complaints',2),(519,'completed','منتهي',1),(520,'completed','Completed',2),(521,'completing','الانتهاء',1),(522,'completing','Completing',2),(523,'completion_count','عدد الشكاوي',1),(524,'completion_count','Completion Count',2),(525,'completion_rate','نسبة الشكاوي',1),(526,'completion_rate','Completion Rate',2),(527,'completion_rate_report','تقرير نسبة الكشاوي',1),(528,'completion_rate_report','Completion Rate Report',2),(529,'compliant','متوافق',1),(530,'compliant','Compliant',2),(531,'component','محتوى',1),(532,'component','Component',2),(533,'compose','إنشاء',1),(534,'compose','Compose',2),(535,'computer_documentation','وثائق الحاسوب',1),(536,'computer_documentation','Computer Documentation',2),(537,'conference','مؤتمر',1),(538,'conference','Conference',2),(539,'conference_count','عدد المؤتمرات',1),(540,'conference_count','Conference Count',2),(541,'conference_name','اسم المؤتمر',1),(542,'conference_name','Conference Name',2),(543,'conferences','المؤتمر',1),(544,'conferences','Conferences',2),(545,'confirm_password','تأكيد كلمة السر',1),(546,'confirm_password','Confirm Password',2),(547,'confirm_password_are_not_match_with_now','تأكيد كلمة السر غير متطابق مع الحالي',1),(548,'confirm_password_are_not_match_with_now','Confirm Password are not Match with Now',2),(549,'construction_technique','تقنية البناء',1),(550,'construction_technique','Construction Technique',2),(551,'contact_email','بريد التواصل الإلكتروني',1),(552,'contact_email','Contact Email',2),(553,'contact_info','بيانات التواصل',1),(554,'contact_info','Contact info',2),(555,'content','المحتوى',1),(556,'content','Content',2),(557,'contract_attachment','العقد المرفق',1),(558,'contract_attachment','Contract Attachment',2),(559,'contract_date','تاريخ العقد',1),(560,'contract_date','Contract Date',2),(561,'contract_type','نوع العقد',1),(562,'contract_type','Contract Type',2),(563,'conversations_have_been_marked_as_important.','تم وضع علامة \"مهمة\" على المحادثة',1),(564,'conversations_have_been_marked_as_important.','conversations have been marked as \"important\".',2),(565,'conversations_have_been_marked_as_not_important.','تم وضع علامة \"غير مهمة\" على المحادثة',1),(566,'conversations_have_been_marked_as_not_important.','conversations have been marked as \"not important\".',2),(567,'conversations_have_been_marked_as_unread.','تم وضع علامة \"غير مقروء\" على المحادثة',1),(568,'conversations_have_been_marked_as_unread.','conversations have been marked as \"unread\".',2),(569,'conversations_have_been_moved_to_the_inbox.','تم نقل المحادثة إلى الصنوق الوارد',1),(570,'conversations_have_been_moved_to_the_inbox.','conversations have been moved to the Inbox.',2),(571,'conversations_have_been_moved_to_the_trash.','تم نقل المحادثة إلى سلة المهملات',1),(572,'conversations_have_been_moved_to_the_trash.','conversations have been moved to the Trash.',2),(573,'coordinators','منسق',1),(574,'coordinators','Coordinators',2),(575,'copy','نسخ',1),(576,'copy','Copy',2),(577,'copy_an_existing_survey','النسخ من استبيان موجود مسبقاً',1),(578,'copy_an_existing_survey','Copy an Existing Survey',2),(579,'core_component','المحتوى الأساسي',1),(580,'core_component','Core Component',2),(581,'count','العدد',1),(582,'count','Count',2),(583,'country','البلد',1),(584,'country','Country',2),(585,'course','المادة الدراسية',1),(586,'course','Course',2),(587,'course_assessment_matrix','مصفوفة تقييم المواد الدراسية',1),(588,'course_assessment_matrix','Course Assessment Matrix',2),(589,'course_assessment_method','طرق التقييم للمادة الدراسية',1),(590,'course_assessment_method','Course Assessment Method',2),(591,'course_assessment_rubric','تقييم موضوع للمواد الدراسية',1),(592,'course_assessment_rubric','Course Assessment Rubric',2),(593,'course_calender','تقويم المادة الدراسية',1),(594,'course_calender','Course calender',2),(595,'course_code','رمز المادة الدراسية',1),(596,'course_code','Course Code',2),(597,'course_completion_rate','نسبة انجاز المادة الدراسية',1),(598,'course_completion_rate','Course Completion Rate',2),(599,'course_description_and_education_objectives','وصف المادة الدراسية والغاية التعليمية',1),(600,'course_description_and_education_objectives','Course description and education objectives',2),(601,'course_evaluation','تقييم المادة الدراسية',1),(602,'course_evaluation','Course Evaluation',2),(603,'course_grades','علامات المادة الدراسية',1),(604,'course_grades','Course Grades',2),(605,'course_learning_domain','مجال التعلم للمادة الدراسية',1),(606,'course_learning_domain','Course Learning Domain',2),(607,'course_learning_outcome','مخرجات التعلم للمادة الدراسية',1),(608,'course_learning_outcome','Course Learning Outcome',2),(609,'course_learning_outcome_mapped_to_survey','مخرج التعلم للمادة الدراسية المرتبط باستبيان',1),(610,'course_learning_outcome_mapped_to_survey','Course Learning Outcome Mapped to Survey',2),(611,'course_learning_outcomes','مخرجات التعلم للمادة الدراسية',1),(612,'course_learning_outcomes','Course Learning Outcomes',2),(613,'course_management','إدارة المواد الدراسية',1),(614,'course_management','Course Management',2),(615,'course_management_has_not_been_created!','لم يتم إنشاء المادة الدراسية',1),(616,'course_management_has_not_been_created!','Course Management has not been created!',2),(617,'course_manual','دليل المادة الدراسية',1),(618,'course_manual','Course Manual',2),(619,'course_name','اسم المادة الدراسية',1),(620,'course_name','Course Name',2),(621,'course_no','رقم المادة الدراسية',1),(622,'course_no','Course No',2),(623,'course_not_found','لم يتم العثور على المداة الدراسية',1),(624,'course_not_found','Course not found',2),(625,'course_number','رقم المادة الدراسية',1),(626,'course_number','Course Number',2),(627,'course_policies','سياسة المادة الدراسية',1),(628,'course_policies','Course policies',2),(629,'course_portfolio','ملف المادة الدراسية',1),(630,'course_portfolio','Course Portfolio',2),(631,'course_report_cover','غلاف تقارير المواد الدراسية',1),(632,'course_report_cover','Course Report Cover',2),(633,'course_report._cr_score','تقارير المادة الدراسية و نقاط CR',1),(634,'course_report._cr_score','Course Report. CR Score',2),(635,'course_section','شعبة المادة الدراسية',1),(636,'course_section','Course Section',2),(637,'course_sections','شعب المادة الدراسية',1),(638,'course_sections','Course Sections',2),(639,'course_sections_to_be_displayed','شعب المادة الدراسية ليتم عرضها',1),(640,'course_sections_to_be_displayed','course sections to be displayed',2),(641,'course_specification_cover','غلاف خصائص المواد الدراسية',1),(642,'course_specification_cover','Course Specification Cover',2),(643,'course_specifications_and_reports','مواصفات وتقارير المادة الدراسية',1),(644,'course_specifications_and_reports','Course Specifications and Reports',2),(645,'course_specs._cs_score','خصائص المادة الدراسية ونقاط CS',1),(646,'course_specs._cs_score','Course Specs. CS Score',2),(647,'course_status','حالة المادة الدراسية',1),(648,'course_status','Course Status',2),(649,'course_statuses','حالات المادة الدراسية',1),(650,'course_statuses','Course Statuses',2),(651,'course_students','طلاب المادة الدراسية',1),(652,'course_students','Course Students',2),(653,'course_title','اسم المادة الدراسية',1),(654,'course_title','Course Title',2),(655,'courses','المواد الدراسية',1),(656,'courses','Courses',2),(657,'courses_accreditation','اعتماد المواد الدراسية',1),(658,'courses_accreditation','Courses Accreditation',2),(659,'cr.','CR',1),(660,'cr.','CR',2),(661,'create','إنشاء',1),(662,'create','Create',2),(663,'create_role','إنشاء مسمى وظيفي',1),(664,'create_role','Create Role',2),(665,'created','تم الإنشاء',1),(666,'created','Created',2),(667,'created_at','أُنشئت في',1),(668,'created_at','Created At',2),(669,'creative_work','العمل الإبداعي',1),(670,'creative_work','Creative Work',2),(671,'creative_works','الأعمال الإبداعية',1),(672,'creative_works','Creative Works',2),(673,'credentials','الصلاحيات',1),(674,'credentials','Credentials',2),(675,'credit_hours','الساعات المعتمدة',1),(676,'credit_hours','Credit hours',2),(677,'credit_hours_is_required','عدد الساعات المعتمدة مطلوب',1),(678,'credit_hours_is_required','Credit Hours is Required',2),(679,'criteria','مقياس',1),(680,'criteria','Criteria',2),(681,'criterias','المقاييس',1),(682,'criterias','Sub-Standard',2),(683,'cs_and_cr_completed_for_2_years','تم الانتهاء من CS و CR لمدة سنتين',1),(684,'cs_and_cr_completed_for_2_years','CS and CR completed for 2 years',2),(685,'cs_completed_and_cr_started','تم الانتهاء من CS وبدء العمل على CR',1),(686,'cs_completed_and_cr_started','CS completed and CR started',2),(687,'cs_completed_but_no_cr','تم الانتهاء من CS ولم ينته العمل على CR',1),(688,'cs_completed_but_no_cr','CS completed but No CR',2),(689,'cs/cr_mean_score',' متوسط نقاط CS/CR',1),(690,'cs/cr_mean_score','CS/CR Mean Score',2),(691,'current','الحالي',1),(692,'current','Current',2),(693,'current_deadline','الموعد النهائي الحالي',1),(694,'current_deadline','Current Deadline',2),(695,'current_year','السنة الحالية',1),(696,'current_year','Current Year',2),(697,'curriculum','منهاج دراسي',1),(698,'curriculum','Curriculum',2),(699,'curriculum_mapping','خريطة المناهج',1),(700,'curriculum_mapping','Curriculum Mapping',2),(701,'custom_component','محتوى مخصص',1),(702,'custom_component','Custom Component',2),(703,'custom_items','عناصر مخصصة',1),(704,'custom_items','Custom Items',2),(705,'custom_title','عنوان مخصص',1),(706,'custom_title','Custom Title',2),(707,'cv','السيرة الذاتية',1),(708,'cv','CV',2),(709,'cv_&_report','السيرة الذاتية والتقرير',1),(710,'cv_&_report','CV & Report',2),(711,'cv_attachment','السيرة الذاتية المرفقة',1),(712,'cv_attachment','CV Attachment',2),(713,'cv_text','نص السيرة الذاتية',1),(714,'cv_text','CV Text',2),(715,'dashboard','لوحة القيادة',1),(716,'dashboard','Dashboard',2),(717,'dashboards','لوحات القيادة',1),(718,'dashboards','Dashboards',2),(719,'data','البيانات',1),(720,'data','Data',2),(721,'data_capture','التقاط البيانات',1),(722,'data_capture','Data Capture',2),(723,'data_to_be_displayed.','بيانات ليتم عرضها',1),(724,'data_to_be_displayed.',']ata to be ]isplayed.',2),(725,'date','التاريخ',1),(726,'date','Date',2),(727,'date_accredited','تاريخ الاعتماد',1),(728,'date_accredited','Date Accredited',2),(729,'date_format_is_correct','تنسيق التاريخ صحيح',1),(730,'date_format_is_correct','Date format is correct',2),(731,'date_from','من تاريخ',1),(732,'date_from','Date From',2),(733,'date_period','فترة التاريخ',1),(734,'date_period','Date period',2),(735,'date_range_are_conflict_with_another_deadline','مدى التاريخ يتعارض مع موعد نهائي آخر',1),(736,'date_range_are_conflict_with_another_deadline','Date Range are Conflict with another deadline',2),(737,'date_range_is_wrong','المدى بين التواريخ خاطئ',1),(738,'date_range_is_wrong','Date Range is Wrong',2),(739,'date_submitted','تاريخ التقديم',1),(740,'date_submitted','Date Submitted',2),(741,'date_to','إلى تاريخ',1),(742,'date_to','Date To',2),(743,'date_visited','تاريخ الزيارة',1),(744,'date_visited','Date Visited',2),(745,'day','يوم',1),(746,'day','Day',2),(747,'days','أيام',1),(748,'days','Days',2),(749,'deadline','الموعد النهائي',1),(750,'deadline','Deadline',2),(751,'deadline_successfully_saved','تم حفظ الموعد النهائي بنجاح',1),(752,'deadline_successfully_saved','Deadline successfully Saved',2),(753,'dean','عميد',1),(754,'dean','Dean',2),(755,'deanship','عمادة',1),(756,'deanship','Deanship',2),(757,'deanship_id','رقم العمادة',1),(758,'deanship_id','Deanship Id',2),(759,'debugging_tips','نصائح التصحيح',1),(760,'debugging_tips','Debugging Tips',2),(761,'degree','الدرجة العلمية',1),(762,'degree','Degree',2),(763,'degrees','الدرجات العلمية',1),(764,'degrees','Degrees',2),(765,'delete','حذف',1),(766,'delete','Delete',2),(767,'deleted_successfully','تم الحذف بنجاح',1),(768,'deleted_successfully','Deleted Successfully',2),(769,'demographics','معلومات عامة',1),(770,'demographics','Demographics',2),(771,'department','قسم',1),(772,'department','Department',2),(773,'department_name','اسم القسم',1),(774,'department_name','Department Name',2),(775,'department_performance','أداء القسم',1),(776,'department_performance','Department performance',2),(777,'department_report','تقرير القسم',1),(778,'department_report','Department Report',2),(779,'departments','الأقسام',1),(780,'departments','Departments',2),(781,'description','الوصف',1),(782,'description','Description',2),(783,'design','التصميم',1),(784,'design','Design',2),(785,'detailed_report','التقرير التفصيلي',1),(786,'detailed_report','Detailed Report',2),(787,'details','التفاصيل',1),(788,'details','Details',2),(789,'developmental_planning','التخطيط التنموي',1),(790,'developmental_planning','Developmental Planning',2),(791,'display','عرض',1),(792,'display','Display',2),(793,'dissemination_type','نوع النشر',1),(794,'dissemination_type','Dissemination Type',2),(795,'documentation','توثيق',1),(796,'documentation','Documentation',2),(797,'documents','الوثائق',1),(798,'documents','Documents',2),(799,'documents_to_review','وثائق للمراجعة',1),(800,'documents_to_review','Documents to Review',2),(801,'domain','المجال',1),(802,'domain','Domain',2),(803,'done','منتهي',1),(804,'done','Done',2),(805,'download','تحميل',1),(806,'download','Download',2),(807,'download_as','تحميل ك',1),(808,'download_as','Download As',2),(809,'download_attachment','تنزيل المرفق',1),(810,'download_attachment','Download Attachment',2),(811,'due_date','موعد التسليم',1),(812,'due_date','Due Date',2),(813,'due_date_exceeded','موعد التسليم منتهي',1),(814,'due_date_exceeded','Due Date Exceeded',2),(815,'due_date_not_assigned','موعد التسليم غير محدد',1),(816,'due_date_not_assigned','Due Date Not Assigned',2),(817,'due_date_not_chosen_yet','لم يتم تحديد موعد التسليم',1),(818,'due_date_not_chosen_yet','Due Date not chosen yet',2),(819,'due_date_passed','تجاوز موعد التسليم',1),(820,'due_date_passed','Due Date Passed',2),(821,'due_in','ينتهي في',1),(822,'due_in','Due in',2),(823,'due_today','ينتهي اليوم',1),(824,'due_today','Due Today',2),(825,'duration','المدة الزمنية',1),(826,'duration','Duration',2),(827,'edit','تعديل',1),(828,'edit','Edit',2),(829,'edit_&_resend','تعديل و إعادة إرسال',1),(830,'edit_&_resend','Edit & Resend',2),(831,'edition','الطبعة',1),(832,'edition','Edition',2),(833,'elective','اختياري',1),(834,'elective','Elective',2),(835,'eligibility_minimum_requirement_was_added_successfully','Eligibility minimum requirement  تم إضافته بنجاح',1),(836,'eligibility_minimum_requirement_was_added_successfully','Eligibility minimum requirement was added successfully',2),(837,'email','البريد الإلكتروني',1),(838,'email','Email',2),(839,'email_already_exists','البريد الإلكتروني موجود مسبقا',1),(840,'email_already_exists','Email Already Exists',2),(841,'email_is_wrong','البريد الإلكتروني خاطئ',1),(842,'email_is_wrong','Email is wrong',2),(843,'email_me_when','ارسال بريد إلكتروني في الحالات',1),(844,'email_me_when','Email me when',2),(845,'email_notifications','اشعارات البريد الإلكتروني',1),(846,'email_notifications','Email Notifications',2),(847,'emergent_proficiency','الكفاءة الناشئة',1),(848,'emergent_proficiency','Emergent Proficiency',2),(849,'employer','صاحب العمل',1),(850,'employer','Employer',2),(851,'employers','أصحاب العمل',1),(852,'employers','Employers',2),(853,'end','الإنتهاء',1),(854,'end','End',2),(855,'end_date','تاريخ الإنتهاء',1),(856,'end_date','End Date',2),(857,'end_date_must_be_on_or_after','تاريخ الانتهاء يجب أن يكون بعد',1),(858,'end_date_must_be_on_or_after','End Date must be on or after',2),(859,'end_date_must_be_on_or_before','تاريخ الانتهاء  يجب أن يكون قبل',1),(860,'end_date_must_be_on_or_before','End Date must be on or before',2),(861,'end_date_should_be_after_start_date','تاريخ الانتهاء سجي أن يكون بعد تاريخ البدء',1),(862,'end_date_should_be_after_start_date','End Date should be after Start Date',2),(863,'english','English',1),(864,'english','English',2),(865,'enrolled','المقيدين',1),(866,'enrolled','Enrolled',2),(867,'enrolled_count','عدد المقيدين',1),(868,'enrolled_count','Enrolled Count',2),(869,'enter_your_email','أدخل البريد الإلكرتوني',1),(870,'enter_your_email','Enter your Email',2),(871,'epartments','وثائق المعدات',1),(872,'epartments','Epartments',2),(873,'equipment_documentation','وثائق المعدات',1),(874,'equipment_documentation','Equipment Documentation',2),(875,'error_:_please_try_again','خطأ: يرجى المحاولة مرة أخرى',1),(876,'error_:_please_try_again','Error : Please try Again',2),(877,'error:_already_submit_the_survey','خطأ : تم تسليم هذا الاستبيان مسبقاً',1),(878,'error:_already_submit_the_survey','Error: Already Submit the Survey',2),(879,'error:_due_date_has_passed','خطأ: تم تجاوز الموعد النهائي للتسليم',1),(880,'error:_due_date_has_passed','Error: Due Date has Passed',2),(881,'error:_eligibility_minimum_requirement_already_added','خطأ :\"Eligibility minimum requirement \" تم إضافته مسبقا',1),(882,'error:_eligibility_minimum_requirement_already_added','Error: Eligibility minimum requirement already added',2),(883,'error:_invalid_email','خطأ:البريد الإلكتروني خاطىء',1),(884,'error:_invalid_email','Error: Invalid Email',2),(885,'error:_invalid_token','خطأ: رمز غير صحسح',1),(886,'error:_invalid_token','Error: Invalid Token',2),(887,'error:_no_system_selected,_please_select_one','خطأ: لم يتم إختيار نظام , يرجى إختيار واحد',1),(888,'error:_no_system_selected,_please_select_one','Error: No System Selected, Please Select One',2),(889,'error:_permission_denied!','خطأ : تم رفض الصلاحية',1),(890,'error:_permission_denied!','Error: Permission Denied!',2),(891,'error:_please_add_1_or_more_questions_to_the_survey_before_continuing.','خطأ يرجى إضافة سؤال أو أكثر على الاستبيان قبل المتابعة',1),(892,'error:_please_add_1_or_more_questions_to_the_survey_before_continuing.','Error: Please add 1 or more questions to the survey before continuing.',2),(893,'error:_please_make_sure_you_are_finished_all_sub-form','خطأ: يرجى التأكد من انهاء جميع النماذج الفرعية',1),(894,'error:_please_make_sure_you_are_finished_all_sub-form','Error: Please make sure you are Finished all Sub-Form',2),(895,'error:_please_select_at_least_one_conversation.','يرجى اختيار محاثة واحدة على الأقل',1),(896,'error:_please_select_at_least_one_conversation.','Error: Please Select at least one conversation.',2),(897,'error:_please_select_at_least_one_group.','خطأ: يرجى اختيار مجموعة واحدة على الأقل',1),(898,'error:_please_select_at_least_one_group.','Error: Please Select at least one group.',2),(899,'error:_please_try_again','خطأ: يرجى المحاولة مرة أخرى',1),(900,'error:_please_try_again','Error: Please try again',2),(901,'error:_this_field_has_invalid_value','خطأ: هذا الحقل يحتوي على قيمة غير صحيحة',1),(902,'error:_this_field_has_invalid_value','Error: This field has invalid value',2),(903,'error:_this_field_is_required','خطأ: هذا الحقل مطلوب',1),(904,'error:_this_field_is_required','Error: This field is required',2),(905,'error:_this_field_is_required_&_should_be_a_number','خطأ: هذه الحقل مطلوب ويجب أن تكون القيمة رقم',1),(906,'error:_this_field_is_required_&_should_be_a_number','Error: This field is required & should be a number',2),(907,'error:_this_field_is_required_at_least_one_parameter','خطأ : هذا الحقل مطلوب ويجب أن يحتوي على عنصر واحد على الأقل',1),(908,'error:_this_field_is_required_at_least_one_parameter','Error: This field is required at least one parameter',2),(909,'error:_you_are_not_active','خطأ: أنت غير نشط',1),(910,'error:_you_are_not_active','Error: You are not Active',2),(911,'error:_you_dont_have_permission','خطأ: لا تملك الصلاحية',1),(912,'error:_you_dont_have_permission','Error: You Don\'t have Permission',2),(913,'escalation','تصعيد',1),(914,'escalation','Escalation',2),(915,'escalation_actions','إجراءات التصعيد',1),(916,'escalation_actions','Escalation Actions',2),(917,'escalation_level','مستوى التصعيد',1),(918,'escalation_level','Escalation Level',2),(919,'escalation_levels','مستويات التصعيد',1),(920,'escalation_levels','Escalation Levels',2),(921,'escalation_plans','خطط التصعيد',1),(922,'escalation_plans','Escalation Plans',2),(923,'evaluate_as_manager','تقييم كمدير',1),(924,'evaluate_as_manager','Evaluate as Manager',2),(925,'evaluate_as_peer','تقييم كنظير',1),(926,'evaluate_as_peer','Evaluate as Peer',2),(927,'evaluation','التقييم',1),(928,'evaluation','Evaluation',2),(929,'evaluation_management','إدارة التقييم',1),(930,'evaluation_management','Evaluation Management',2),(931,'evaluation_overall','التقييم بشكل عام',1),(932,'evaluation_overall','Evaluation Overall',2),(933,'evaluations','التقييم',1),(934,'evaluations','Evaluations',2),(935,'evaluator','مقيّم',1),(936,'evaluator','Evaluator',2),(937,'example_evaluation_help_text_here.','مثال على التقييم نص التعليمات هنا',1),(938,'example_evaluation_help_text_here.','Example evaluation help text here.',2),(939,'exams,_assignments_and_quizzes','الامتحانات، الوظائف والاختبارات',1),(940,'exams,_assignments_and_quizzes','Exams, Assignments and Quizzes',2),(941,'excellent_performance','أداء ممتاز',1),(942,'excellent_performance','Excellent Performance',2),(943,'exclude_not_started','استثناء \"لم يبدأ به\"',1),(944,'exclude_not_started','Exclude Not Started',2),(945,'existing_survey','استبيان موجود مسبقاً',1),(946,'existing_survey','Existing Survey',2),(947,'experience','الخبرة',1),(948,'experience','Experience',2),(949,'experiences','الخبرات',1),(950,'experiences','Experiences',2),(951,'expiration','تاريخ الإنتهاء',1),(952,'expiration','Expiration',2),(953,'export','تصدير',1),(954,'export','Export',2),(955,'external','خارجي',1),(956,'external','External',2),(957,'external_benchmark','مؤشر خارجي',1),(958,'external_benchmark','External Benchmark',2),(959,'external_benchmarks','المؤشرات الخارجية',1),(960,'external_benchmarks','External Benchmarks',2),(961,'facebook','فيسبوك',1),(962,'facebook','Facebook',2),(963,'factor','عامل',1),(964,'factor','Factor',2),(965,'factor_and_statement','العوامل والبيانات',1),(966,'factor_and_statement','Factor And Statement',2),(967,'factors','العوامل',1),(968,'factors','Factors',2),(969,'factors_and_statements','العوامل والبيانات',1),(970,'factors_and_statements','Factors And Statements',2),(971,'faculty',' هيئة التدريس',1),(972,'faculty','Faculty',2),(973,'faculty_actions','إجراءات عضو الهيئة التدريسية',1),(974,'faculty_actions','Faculty Actions',2),(975,'faculty_are_founded','العثور على  عضو الهيئة التدريسية',1),(976,'faculty_are_founded','Faculty are Founded',2),(977,'faculty_forms','نماذج عضو الهيئة التدريسية',1),(978,'faculty_forms','Faculty Forms',2),(979,'faculty_id','رقم عضو الهيئة التدريسية',1),(980,'faculty_id','Faculty ID',2),(981,'faculty_name','اسم عضو الهيئة التدريسية',1),(982,'faculty_name','Faculty Name',2),(983,'faculty_performance','أداء عضو الهيئة التدريسية',1),(984,'faculty_performance','Faculty Performance',2),(985,'faculty_performance_deadline','الموعد النهائي ',1),(986,'faculty_performance_deadline','Deadline',2),(987,'faculty_performance_evaluation','تقييم أداء عضو الهيئة التدريسية',1),(988,'faculty_performance_evaluation','Faculty Performance Evaluation',2),(989,'faculty_performance_form_settings','إعدادات نموذج أداء عضو الهيئة التدريسية',1),(990,'faculty_performance_form_settings','Faculty Performance Form Settings',2),(991,'faculty_performance_from','نموذج أداء عضو الهيئة التدريسية',1),(992,'faculty_performance_from','faculty performance from',2),(993,'faculty_performance_report','تقرير أداء عضو الهيئة التدريسية',1),(994,'faculty_performance_report','Faculty Performance Report',2),(995,'faculty_performance_settings','إعدادات أداء عضو الهيئة التدريسية',1),(996,'faculty_performance_settings','Faculty Performance Settings',2),(997,'faculty_performance_type','نوع أداء عضو الهيئة التدريسية',1),(998,'faculty_performance_type','Faculty Performance Type',2),(999,'faculty_performance_type_settings','إعدادات نوع أداء عضو الهيئة التدريسية',1),(1000,'faculty_performance_type_settings','Faculty Performance Type Settings',2),(1001,'faculty_portfolio','ملف أعضاء الهيئة التدريس',1),(1002,'faculty_portfolio','Faculty Portfolio',2),(1003,'faculty_recommendation','توصيات عضو الهيئة التدريسية',1),(1004,'faculty_recommendation','Faculty Recommendation',2),(1005,'faculty_report','تقرير عضو الهيئة التدريسية',1),(1006,'faculty_report','Faculty Report',2),(1007,'fax','الفاكس',1),(1008,'fax','Fax',2),(1009,'fax_no','رقم الفاكس',1),(1010,'fax_no','Fax No',2),(1011,'fax_number','رقم الفاكس',1),(1012,'fax_number','Fax Number',2),(1013,'female_faculty_members','أعضاء الهيئة التدريسية الإناث',1),(1014,'female_faculty_members','Female Faculty Members',2),(1015,'field_experience_report_cover','غلاف تقارير الخبرة الميدانية',1),(1016,'field_experience_report_cover','Field Experience Report Cover',2),(1017,'field_experience_specification_cover','غلاف خصائص الخبرة الميدانية',1),(1018,'field_experience_specification_cover','Field Experience Specification Cover',2),(1019,'field_required','يرجى إدخال هذا الحقل',1),(1020,'field_required','Field Required',2),(1021,'fifth_author','المؤلف الخامس',1),(1022,'fifth_author','Fifth Author',2),(1023,'file_exceeds_maximum_allowed_size.','حجم الملف يتجاوز الحد المسموح',1),(1024,'file_exceeds_maximum_allowed_size.','File exceeds maximum allowed size.',2),(1025,'file_not_found.','الملف غير موجود',1),(1026,'file_not_found.','File not found.',2),(1027,'file_repository','مستودع الملف',1),(1028,'file_repository','File Repository',2),(1029,'file_type_not_allowed.','نوع الملف غير مسموح',1),(1030,'file_type_not_allowed.','File type not allowed.',2),(1031,'files_repository','مستودع الملفات',1),(1032,'files_repository','Files Repository',2),(1033,'filters','المرشحات',1),(1034,'filters','Filters',2),(1035,'find_members','العثور على الأعضاء',1),(1036,'find_members','Find Members',2),(1037,'find_strategic_planning','البحث عن التخطيط الاستراتيجي',1),(1038,'find_strategic_planning','Find Strategic Planning',2),(1039,'finish','انهاء',1),(1040,'finish','Finish',2),(1041,'first_name','الاسم الأول',1),(1042,'first_name','First Name',2),(1043,'for','ل',1),(1044,'for','For',2),(1045,'for_the_course_titled','لعنوان المادة الدراسية',1),(1046,'for_the_course_titled','For the Course Titled',2),(1047,'for_year','لسنة',1),(1048,'for_year','For Year',2),(1049,'forgot_your_password?','هل نسيت كلمة السر؟',1),(1050,'forgot_your_password?','Forgot your Password?',2),(1051,'form','نموذج',1),(1052,'form','Form',2),(1053,'form_compliant','النموذج متوافق',1),(1054,'form_compliant','Form Compliant',2),(1055,'form_has_been_successfully_displayed','تم إظهار النموذج بنجاح',1),(1056,'form_has_been_successfully_displayed','Form has been successfully displayed',2),(1057,'form_has_been_successfully_hidden','تم إخفاء النموذج بنجاح',1),(1058,'form_has_been_successfully_hidden','Form has been successfully hidden',2),(1059,'form_input','مُدخل النموذج',1),(1060,'form_input','Form Input',2),(1061,'form_name','اسم النموذج',1),(1062,'form_name','Form Name',2),(1063,'form_ongoing_or_saved','النماذج المستمرة أو المحفوظة',1),(1064,'form_ongoing_or_saved','Form Ongoing or Saved',2),(1065,'form_partly_compliant','النموذج متوافق جزئيا',1),(1066,'form_partly_compliant','Form Partly Compliant',2),(1067,'form_result_delete_successfully','تم حذف نتيبجة النموذج بنجاح',1),(1068,'form_result_delete_successfully','Form Result Delete Successfully',2),(1069,'form_saved_and_finish','تم حفظ و إرسال النموذج',1),(1070,'form_saved_and_finish','Form Saved and Finish',2),(1071,'form_settings','إعدادات النموذج',1),(1072,'form_settings','Form Settings',2),(1073,'form_successfully_add','تم إضافة النموذج بنجاح',1),(1074,'form_successfully_add','Form Successfully Added',2),(1075,'form_type','نوع النموذج',1),(1076,'form_type','Form Type',2),(1077,'form_type_evaluation','تقييم نوع النموذج',1),(1078,'form_type_evaluation','Form Type Evaluation',2),(1079,'form_types','أنواع النماذج',1),(1080,'form_types','Form Types',2),(1081,'format_information','تصميم البيانات',1),(1082,'format_information','Format Information',2),(1083,'forms','نماذج',1),(1084,'forms','Forms',2),(1085,'forms_for_this_type','نماذج لهذا النوع',1),(1086,'forms_for_this_type','Forms for This type',2),(1087,'forms_type','نوع النماذج',1),(1088,'forms_type','Forms Type',2),(1089,'fourth_author','المؤلف الرابع',1),(1090,'fourth_author','Fourth Author',2),(1091,'from','من',1),(1092,'from','From',2),(1093,'from_date','من التاريخ',1),(1094,'from_date','From Date',2),(1095,'full_contribution','مساهمة كاملة',1),(1096,'full_contribution','Full contribution',2),(1097,'full_initiative','مبادرات كاملة',1),(1098,'full_initiative','Full Initiative',2),(1099,'full_name','الاسم الكامل',1),(1100,'full_name','Full Name',2),(1101,'full_participation','مشاركة كاملة',1),(1102,'full_participation','Full participation',2),(1103,'funds','موارد مالية',1),(1104,'funds','Funds',2),(1105,'funds_type','نوع الموارد المالية',1),(1106,'funds_type','Funds Type',2),(1107,'gantt','جانت',1),(1108,'gantt','Gantt',2),(1109,'gender','الجنس',1),(1110,'gender','Gender',2),(1111,'general','بشكل عام',1),(1112,'general','General',2),(1113,'general_info','بيانات عامة',1),(1114,'general_info','General Info',2),(1115,'general_information','البيانات العامة',1),(1116,'general_information','General Information',2),(1117,'general_report','تقرير عام',1),(1118,'general_report','General Report',2),(1119,'generate','استخراج',1),(1120,'generate','Generate',2),(1121,'generate_all_forms','استخراج جميع النماذج',1),(1122,'generate_all_forms','Generate All Forms',2),(1123,'generate_forms','استخراج النماذج',1),(1124,'generate_forms','Generate Forms',2),(1125,'generate_pdf','استخراج PDF',1),(1126,'generate_pdf','Generate PDF',2),(1127,'generate_program_plan_courses_form','استخراج نماذج المواد الدراسية لخطة البرنامج',1),(1128,'generate_program_plan_courses_form','Generate Program Plan Courses Form',2),(1129,'generate_strategy','استخراج تخطيط  استراتيجي',1),(1130,'generate_strategy','Generate Strategy',2),(1131,'get_shared','الحصول على مشترك',1),(1132,'get_shared','Get Shared',2),(1133,'get_summary','الحصول على مراجعة',1),(1134,'get_summary','Get Summary',2),(1135,'go','اذهب',1),(1136,'go','Go',2),(1137,'go_back','رجوع',1),(1138,'go_back','Go back',2),(1139,'goal','هدف',1),(1140,'goal','Goal',2),(1141,'goal_not_found','لم يتم العثور على الهدف',1),(1142,'goal_not_found','Goal not found',2),(1143,'goal_removed_successfully','تم حذف الهدف بنجاح',1),(1144,'goal_removed_successfully','Goal removed successfully',2),(1145,'goal_successfully_saved','تم حفظ الهدف بنجاح',1),(1146,'goal_successfully_saved','Goal Successfully Saved',2),(1147,'goals','أهداف',1),(1148,'goals','Goals',2),(1149,'good_contribution','مساهمة جيدة',1),(1150,'good_contribution','Good contribution',2),(1151,'good_initiative','مبادرات جيدة',1),(1152,'good_initiative','Good Initiative',2),(1153,'good_participation','مشاركة جيدة',1),(1154,'good_participation','Good participation',2),(1155,'good_performance','أداء جيد',1),(1156,'good_performance','Good Performance',2),(1157,'grade','علامة',1),(1158,'grade','Grade',2),(1159,'grading','العلامات',1),(1160,'grading','Grading',2),(1161,'grading_policies','سياسات العلامات',1),(1162,'grading_policies','Grading Policies',2),(1163,'graduate_count','عدد الخريجين',1),(1164,'graduate_count','Graduate Count',2),(1165,'graduated','تخرج',1),(1166,'graduated','Graduated',2),(1167,'grant_date','تاريخ المنحة',1),(1168,'grant_date','Grant Date',2),(1169,'group','مجموعة',1),(1170,'group','Group',2),(1171,'group_name','اسم المجموعة',1),(1172,'group_name','Group Name',2),(1173,'group_should_have_members','يجب أن تحتوي المجموعة على أعضاء',1),(1174,'group_should_have_members','Group should have members',2),(1175,'groups','المجموعات',1),(1176,'groups','Groups',2),(1177,'help','مساعدة',1),(1178,'help','Help',2),(1179,'hide','إخفاء',1),(1180,'hide','Hide',2),(1181,'highly_cited_paper_in_isi_journals','ورق الاستشهاد العالية في مجلات ISI',1),(1182,'highly_cited_paper_in_isi_journals','Highly Cited Paper in ISI Journals',2),(1183,'history_date','تاريخ التاريخ',1),(1184,'history_date','History Date',2),(1185,'hobbies','الهوايات',1),(1186,'hobbies','Hobbies',2),(1187,'homework_problems','مشاكل الوظيفة المنزلية',1),(1188,'homework_problems','Homework problems',2),(1189,'html_report','تقرير HTML',1),(1190,'html_report','HTML Report',2),(1191,'id','الرقم',1),(1192,'id','Id',2),(1193,'if_any','لو أي',1),(1194,'if_any','If Any',2),(1195,'if_the_kpi_has_multiple_values_and_can_be_average','إذا كان يحتوي مؤشر الأداء على أكثر من قيمة ويمكن أن تكون معدّل',1),(1196,'if_the_kpi_has_multiple_values_and_can_be_average','If the KPI has multiple values and can be average',2),(1197,'if_the_values_released_per_semester_or_academic_year','اذا كانت القيم تحرر لكل فصل أو سنة دراسية',1),(1198,'if_the_values_released_per_semester_or_academic_year','If the values released per semester or academic year',2),(1199,'illegal_inputs','مدخلات غير مسموحة',1),(1200,'illegal_inputs','Illegal Inputs',2),(1201,'image','صورة',1),(1202,'image','Image',2),(1203,'impact','التأثير',1),(1204,'impact','Impact',2),(1205,'import','تصدير',1),(1206,'import','Import',2),(1207,'important','المهمة',1),(1208,'important','Important',2),(1209,'in','في',1),(1210,'in','in',2),(1211,'in_progress','في تقدم',1),(1212,'in_progress','In progress',2),(1213,'in-class_exercises_format','تصميم التمارين الصفية',1),(1214,'in-class_exercises_format','In-class exercises format',2),(1215,'inbox','البريد الوارد',1),(1216,'inbox','Inbox',2),(1217,'income_messages','الرسائل الواردة',1),(1218,'income_messages','Income Messages',2),(1219,'independent_reviewer','مراجع مستقل',1),(1220,'independent_reviewer','Independent Reviewer',2),(1221,'independent_reviewers','مراجعون مستقلون',1),(1222,'independent_reviewers','Independent Reviewers',2),(1223,'information','المعلومات',1),(1224,'information','Information',2),(1225,'initiate','بدء',1),(1226,'initiate','Initiate',2),(1227,'initiative','المبادرة',1),(1228,'initiative','Initiative',2),(1229,'initiative_milestone','معلم المبادرة',1),(1230,'initiative_milestone','Initiative Milestone',2),(1231,'initiative_milestone_successfully_saved','تم حفظ معلم المبادرة بنجاح',1),(1232,'initiative_milestone_successfully_saved','Initiative Milestone Successfully Saved',2),(1233,'initiative_removed_successfully','تم حذف المبادرة بنجاح',1),(1234,'initiative_removed_successfully','Initiative removed successfully',2),(1235,'initiative_successfully_saved','تم حفظ المبادرة بنجاح',1),(1236,'initiative_successfully_saved','Initiative Successfully Saved',2),(1237,'initiatives','المبادرات',1),(1238,'initiatives','Initiatives',2),(1239,'input_label','تسمية المدخل',1),(1240,'input_label','Input Label',2),(1241,'instance','نموذج',1),(1242,'instance','Instance',2),(1243,'institution','المؤسسة',1),(1244,'institution','Institution',2),(1245,'institution_account','حساب المؤسسة',1),(1246,'institution_account','Institution Account',2),(1247,'institution_benchmark','مؤشر المؤسسة',1),(1248,'institution_benchmark','Institution Benchmark',2),(1249,'institution_criteria','مقياس المؤسسة',1),(1250,'institution_criteria','Institution Criteria',2),(1251,'institution_goals','أهداف المؤسسة',1),(1252,'institution_goals','Institution Goals',2),(1253,'institution_kpi','مؤشر أداء مؤسسي',1),(1254,'institution_kpi','Institution KPI',2),(1255,'institution_name','اسم المؤسسة',1),(1256,'institution_name','Institution Name',2),(1257,'institution_objectives','غايات المؤسسة',1),(1258,'institution_objectives','Institution Objectives',2),(1259,'institution_profile_tables','جداول الملف الشخصي للمؤسسة',1),(1260,'institution_profile_tables','Institution Profile Tables',2),(1261,'institutional','مؤسسة',1),(1262,'institutional','Institutional',2),(1263,'institutional_requirement','متطلبات المؤسسة',1),(1264,'institutional_requirement','Institutional Requirement',2),(1265,'institutions','المؤسسات',1),(1266,'institutions','Institutions',2),(1267,'instructional_and_assessment_methods','الأساليب التعليمية والتقيمية',1),(1268,'instructional_and_assessment_methods','Instructional and assessment methods',2),(1269,'instructor_information','معلومات المدرس',1),(1270,'instructor_information','Instructor information',2),(1271,'integrate','ربط',1),(1272,'integrate','Integrate',2),(1273,'integrate_objective','ربط الغاية',1),(1274,'integrate_objective','Integrate Objective',2),(1275,'integration','ربط',1),(1276,'integration','Integration',2),(1277,'intermediate_proficiency','الكفاءة المتوسطة',1),(1278,'intermediate_proficiency','Intermediate Proficiency',2),(1279,'internal_reviewer','مراجع داخلي',1),(1280,'internal_reviewer','Internal Reviewer',2),(1281,'international','دولي',1),(1282,'international','International',2),(1283,'international_accreditation','إعتماد دولي',1),(1284,'international_accreditation','International Accreditation',2),(1285,'invalid_code!','الرمز خاطئ',1),(1286,'invalid_code!','Invalid code!',2),(1287,'invalid_college!','كلية خاطئة',1),(1288,'invalid_college!','Invalid College!',2),(1289,'invalid_course','مادة دراسية خاطئة',1),(1290,'invalid_course','Invalid Course',2),(1291,'invalid_department','قسم خاطئ',1),(1292,'invalid_department','Invalid Department',2),(1293,'invalid_email','البريد الإلكتروني خاطىء',1),(1294,'invalid_email','Invalid Email',2),(1295,'invalid_email_or_password','البريد الإلكتروني أو كلمة السر خاطئة',1),(1296,'invalid_email_or_password','Invalid Email or Password',2),(1297,'invalid_end_date','تاريخ الانتهاء خاطئ',1),(1298,'invalid_end_date','Invalid End Date',2),(1299,'invalid_form_name','اسم النموذج خاطئ',1),(1300,'invalid_form_name','Invalid Form Name',2),(1301,'invalid_impact!','التأثير خاطئ',1),(1302,'invalid_impact!','Invalid Impact!',2),(1303,'invalid_initiative!','المبادرة خاطئة',1),(1304,'invalid_initiative!','Invalid Initiative!',2),(1305,'invalid_kpi!','مؤشر أداء خاطئ',1),(1306,'invalid_kpi!','Invalid Kpi!',2),(1307,'invalid_name!','الاسم خاطئ',1),(1308,'invalid_name!','Invalid Name!',2),(1309,'invalid_objective!','غاية خاطئة',1),(1310,'invalid_objective!','Invalid Objective!',2),(1311,'invalid_position','منصب خاطئ',1),(1312,'invalid_position','Invalid Position',2),(1313,'invalid_program!','برنامج خاطئ',1),(1314,'invalid_program!','Invalid Program!',2),(1315,'invalid_risk!','المجازفة خاطئة',1),(1316,'invalid_risk!','Invalid Risk!',2),(1317,'invalid_role_name!','اسم المسمى الوظيفي خاطئ',1),(1318,'invalid_role_name!','Invalid role name!',2),(1319,'invalid_start_and_end_date','تاريخ البدء والانتهاء خاطئ',1),(1320,'invalid_start_and_end_date','Invalid start and end date',2),(1321,'invalid_start_date','تاريخ البدء خاطئ',1),(1322,'invalid_start_date','Invalid Start Date',2),(1323,'invalid_student','طالب خاطئ',1),(1324,'invalid_student','Invalid Student',2),(1325,'invalid_survey_id','رقم الاستبيان خاطئ',1),(1326,'invalid_survey_id','Invalid Survey Id',2),(1327,'invalid_target!','الهدف خاطئ',1),(1328,'invalid_target!','Invalid Target!',2),(1329,'invalid_title','الاسم خاطئ',1),(1330,'invalid_title','Invalid Title',2),(1331,'invalid_type','النوع خاطئ',1),(1332,'invalid_type','Invalid Type',2),(1333,'invalid_type_name','اسم النوع خاطئ',1),(1334,'invalid_type_name','Invalid Type Name',2),(1335,'invalid_value','قيمة خاطئة',1),(1336,'invalid_value','Invalid Value',2),(1337,'invalid_year','سنة خاطئة',1),(1338,'invalid_year','Invalid Year',2),(1339,'is_active','نشط',1),(1340,'is_active','Is Active',2),(1341,'is_program','هل هو برنامج ؟',1),(1342,'is_program','Is Program',2),(1343,'is_translated_book','هل هو كتاب مترجم',1),(1344,'is_translated_book','is Translated Book',2),(1345,'is_workshop','هل هي ورشة عمل',1),(1346,'is_workshop','Is Workshop',2),(1347,'isbn','ISBN',1),(1348,'isbn','ISBN',2),(1349,'isi','ISI',1),(1350,'isi','ISI',2),(1351,'issn','ISSN',1),(1352,'issn','ISSN',2),(1353,'issues_identified_and_remedied_in_cr','القضايا التي تم تحديدها ومعالجتها في CR',1),(1354,'issues_identified_and_remedied_in_cr','Issues Identified and Remedied in CR',2),(1355,'it_is_a_required_filed_to_select_date.','اختيار التاريخ حقل مطلوب',1),(1356,'it_is_a_required_filed_to_select_date.','It is a Required Filed to Select Date.',2),(1357,'it_is_a_required_filed_to_select_one_item.','اختيار عنصر واحد حقل مطلوب',1),(1358,'it_is_a_required_filed_to_select_one_item.','It is a Required Filed to Select One Item.',2),(1359,'item','عنصر',1),(1360,'item','Item',2),(1361,'items','العناصر',1),(1362,'items','Sub-Sub-Standards',2),(1363,'job_position','المركز الوظيفي',1),(1364,'job_position','Job Position',2),(1365,'jobs','الوظائف',1),(1366,'jobs','Jobs',2),(1367,'key_performance_indicator','مؤشر الأداء الرئيسي',1),(1368,'key_performance_indicator','Key Performance Indicator',2),(1369,'key_performance_indicator_tables','جداول مؤشر الأداء الرئيسي',1),(1370,'key_performance_indicator_tables','Key Performance Indicator Tables',2),(1371,'key_performance_indicators','مؤشرات الأداء الرئيسية',1),(1372,'key_performance_indicators','Key Performance Indicators',2),(1373,'keyword','الكلمة',1),(1374,'keyword','Keyword',2),(1375,'kpi','KPI',1),(1376,'kpi','KPI',2),(1377,'kpi_achievements_level','مستوى انجاز مؤشرات الأداء الرئيسية',1),(1378,'kpi_achievements_level','KPI Achievement Scale',2),(1379,'kpi_benchmarks','مؤشر مؤشر الأداء',1),(1380,'kpi_benchmarks','KPI Benchmarks',2),(1381,'kpi_category','فئة مؤشر الأداء',1),(1382,'kpi_category','KPI Category',2),(1383,'kpi_code','رمز مؤشر الأداء',1),(1384,'kpi_code','KPI Code',2),(1385,'kpi_details_view','عرض تفاصيل مؤشر الأداء',1),(1386,'kpi_details_view','KPI Details View',2),(1387,'kpi_dimensions_only_apply_to_quantitative_kpi_types.','أبعاد مؤشرات الأداء تنطبق فقط على النوع الكمي',1),(1388,'kpi_dimensions_only_apply_to_quantitative_kpi_types.','KPI Dimensions only apply to Quantitative KPI types.',2),(1389,'kpi_escalation','تصعيد مؤشرات الأداء',1),(1390,'kpi_escalation','KPI Escalation',2),(1391,'kpi_label','تسمية مؤشر الأداء',1),(1392,'kpi_label','KPI Label',2),(1393,'kpi_legends','المسميات التوضيحية لمؤشرات الأداء',1),(1394,'kpi_legends','KPI Legends',2),(1395,'kpi_measure_type','نوع مقياس مؤشر الأداء',1),(1396,'kpi_measure_type','KPI Measure Type',2),(1397,'kpi_polarity','قطبية مؤشر الأداء',1),(1398,'kpi_polarity','KPI Polarity',2),(1399,'kpi_removed_successfully','تم حذف مؤشر الأداء بنجاح',1),(1400,'kpi_removed_successfully','KPI Removed Successfully',2),(1401,'kpi_result','نتائج مؤشرات الأداء',1),(1402,'kpi_result','KPI Result',2),(1403,'kpi_results_for_the_5_periodic_points','نتائج مؤشرات الأداء لل 5 نقاط الدورية',1),(1404,'kpi_results_for_the_5_periodic_points','KPI Results for the 5 Periodic Points',2),(1405,'kpi_saved_successfully','تم حفظ مؤشرات الأداء',1),(1406,'kpi_saved_successfully','KPI Saved Successfully',2),(1407,'kpi_stakeholder','مؤشر الأداء الرئيسي لأصحاب العمل',1),(1408,'kpi_stakeholder','KPI Stakeholder',2),(1409,'kpi_status','حالة مؤشر الأداء الرئيسي',1),(1410,'kpi_status','KPI Status',2),(1411,'kpi_successfully_saved','تم حفظ مؤشر الأداء بنجاح',1),(1412,'kpi_successfully_saved','KPI Successfully Saved',2),(1413,'kpi_title','اسم مؤشر الأداء',1),(1414,'kpi_title','KPI Title',2),(1415,'kpi_trend','اتجاه مؤشر الأداء',1),(1416,'kpi_trend','KPI Trend',2),(1417,'kpi_type','نوع مؤشر الأداء',1),(1418,'kpi_type','KPI Type',2),(1419,'kpi_value','قيمة مؤشر الأداء',1),(1420,'kpi_value','KPI Value',2),(1421,'kpis','مؤشرات الأداء الرئيسية',1),(1422,'kpis','KPIs',2),(1423,'kpis_benchmarks_report','تقرير مؤشرات مؤشرات الأداء',1),(1424,'kpis_benchmarks_report','KPIs Benchmarks Report',2),(1425,'kpis_categories','فئات مؤشرات الأداء',1),(1426,'kpis_categories','KPIs Categories',2),(1427,'kpis_details_report','تقرير تفصيلي لمؤشرات الأداء',1),(1428,'kpis_details_report','KPIs Details Report',2),(1429,'kpis_measure_type','أنواع مقاييس مؤشرات الأداء',1),(1430,'kpis_measure_type','KPIs Measure Type',2),(1431,'kpis_trend_analysis','تحليل اتجاه مؤشرات الأدء',1),(1432,'kpis_trend_analysis','KPIs Trend Analysis',2),(1433,'kpis_trend_report','تقرير اتجاهي لمؤشرات الأداء',1),(1434,'kpis_trend_report','KPIs Trend Report',2),(1435,'label','التسمية',1),(1436,'label','Label',2),(1437,'laboratory_experiment_format','تصميم تجارب المختبر',1),(1438,'laboratory_experiment_format','Laboratory experiment format',2),(1439,'lag','التأخر',1),(1440,'lag','Lag',2),(1441,'lag_kpi','تأخر مؤشرات الأداء',1),(1442,'lag_kpi','Lag Kpi',2),(1443,'lag_kpi_removed_successfully','تم حذف تأخر مؤشرات الأداء بنجاح',1),(1444,'lag_kpi_removed_successfully','Lag Kpi removed successfully',2),(1445,'lag_kpi_successfully_saved','تم حفظ تأخر مؤشرات الأداء بنجاح',1),(1446,'lag_kpi_successfully_saved','Lag Kpi Successfully Saved',2),(1447,'lag_kpis','تأخر مؤشرات الأداء الريسية',1),(1448,'lag_kpis','Lag KPIs',2),(1449,'land_area','مساحة الأرض',1),(1450,'land_area','Land Area',2),(1451,'language','اللغة',1),(1452,'language','Language',2),(1453,'languages','اللغات',1),(1454,'languages','languages',2),(1455,'last','الأخير',1),(1456,'last','Last',2),(1457,'last_5_years','آخر 5 سنوات',1),(1458,'last_5_years','Last 5 Years',2),(1459,'last_invitation','آخر دعوة',1),(1460,'last_invitation','Last Invitation',2),(1461,'last_name','الاسم الأخير',1),(1462,'last_name','Last Name',2),(1463,'last_semester','آخر فصل دراسي',1),(1464,'last_semester','Last Semester',2),(1465,'lateness','التأخير',1),(1466,'lateness','Lateness',2),(1467,'lateness_policies','سياسات التأخير',1),(1468,'lateness_policies','Lateness Policies',2),(1469,'launch_to_all_courses','إطلاق لجميع المواد الدراسية',1),(1470,'launch_to_all_courses','Launch To All Courses',2),(1471,'lead','القيادة',1),(1472,'lead','Lead',2),(1473,'leadership','القيادة',1),(1474,'leadership','Leadership',2),(1475,'learning_domain','مجالات التعلم',1),(1476,'learning_domain','Learning Domain',2),(1477,'learning_domains','مجالات التعلم',1),(1478,'learning_domains','Learning Domains',2),(1479,'learning_domains_dashboard','لوحية القيادة لمجالات التعلم',1),(1480,'learning_domains_dashboard','Learning Domains Dashboard',2),(1481,'learning_domains_indirect_assessment_results_dashboard','لوحة القيادة لنتائج التقييم غير المباشر لمجالات التعلم',1),(1482,'learning_domains_indirect_assessment_results_dashboard','Learning Domains Indirect Assessment Results Dashboard',2),(1483,'learning_outcome','مخرجات التعلم',1),(1484,'learning_outcome','Learning Outcome',2),(1485,'learning_outcome_in','مخرجات التعلم ل',1),(1486,'learning_outcome_in','Learning Outcome in',2),(1487,'learning_outcome_mapping','ربط مخرجات التعلم',1),(1488,'learning_outcome_mapping','Learning Outcome Mapping',2),(1489,'learning_outcome_target_has_been_set_successfully','تم حفظ هدف مخرج التعلم بنجاح',1),(1490,'learning_outcome_target_has_been_set_successfully','Learning Outcome Target has been set successfully',2),(1491,'learning_outcomes','مخرجات التعلم',1),(1492,'learning_outcomes','Learning Outcomes',2),(1493,'learning_outcomes_defined_in','مخرجات التعلم معرّفة في',1),(1494,'learning_outcomes_defined_in','Learning Outcomes defined in',2),(1495,'learning_outcomes_indirect_assessment_dashboard','لوحة القيادة للتقييم غير المباشر لمخرجات التعلم',1),(1496,'learning_outcomes_indirect_assessment_dashboard','Learning Outcomes Indirect Assessment Dashboard',2),(1497,'learning_outcomes_scores','نتائج مخرجات التعلم',1),(1498,'learning_outcomes_scores','Learning Outcomes Scores',2),(1499,'lecture_note','ملاحظات المحاضر',1),(1500,'lecture_note','Lecture Note',2),(1501,'lecture_time','وقت المحاضرة',1),(1502,'lecture_time','Lecture time',2),(1503,'legend','مسمى توضيحي',1),(1504,'legend','Legend',2),(1505,'legends','المسميات التوضيحية',1),(1506,'legends','Legends',2),(1507,'less','أقل',1),(1508,'less','Less',2),(1509,'level','المستوى',1),(1510,'level','Level',2),(1511,'level_color','لون المستوى',1),(1512,'level_color','Level Color',2),(1513,'level_description','وصف المستوى',1),(1514,'level_description','Level Description',2),(1515,'level_label','تسمية مستوى المقياس',1),(1516,'level_label','Scale Level Label',2),(1517,'level_of_study','مستوى الدراسة',1),(1518,'level_of_study','Level of Study',2),(1519,'level_settings','اعدادات المقياس',1),(1520,'level_settings','Scale Settings',2),(1521,'level_title','عنوان المستوى',1),(1522,'level_title','Level Title',2),(1523,'levels','المستويات',1),(1524,'levels','Levels',2),(1525,'levels_saved_successfully','تم حفظ المستويات بنجاح',1),(1526,'levels_saved_successfully','Levels saved successfully',2),(1527,'license_info','معلومات الرخصة',1),(1528,'license_info','License Info',2),(1529,'link','الرابط',1),(1530,'link','Link',2),(1531,'linkedin','لينكدان',1),(1532,'linkedin','LinkedIn',2),(1533,'links','الروابط',1),(1534,'links','Links',2),(1535,'list_of_previous_student_projects','لائحة مشاريع الطالب السابقة',1),(1536,'list_of_previous_student_projects','List of Previous student projects',2),(1537,'little_contribution','مساهمة قليلة',1),(1538,'little_contribution','Little contribution',2),(1539,'little_initiative','مبادرات قليلة',1),(1540,'little_initiative','Little Initiative',2),(1541,'little_participation','مشاركة قليلة',1),(1542,'little_participation','Little participation',2),(1543,'loading','قيد التحميل',1),(1544,'loading','Loading',2),(1545,'location','الموقع',1),(1546,'location','Location',2),(1547,'log','السجل',1),(1548,'log','Log',2),(1549,'log_out','تسجيل الخروج',1),(1550,'log_out','Log Out',2),(1551,'logged_successfully','تم الدخول بنجاح',1),(1552,'logged_successfully','Logged Successfully',2),(1553,'login_as','الدخول ك',1),(1554,'login_as','Login as',2),(1555,'logs','السجلات',1),(1556,'logs','Logs',2),(1557,'low_performance','أداء ضعيف',1),(1558,'low_performance','Low Performance',2),(1559,'main','الرئيسي',1),(1560,'main','Main',2),(1561,'major','التخصص',1),(1562,'major','Major',2),(1563,'major_strategies','استراتيجيات التخصص',1),(1564,'major_strategies','Major Strategies',2),(1565,'major_strategy','استراتيجية التخصص',1),(1566,'major_strategy','Major Strategy',2),(1567,'majors','التخصصات',1),(1568,'majors','Majors',2),(1569,'male_faculty_members','أعضاء الهيئة التدريسية الذكور',1),(1570,'male_faculty_members','Male Faculty Members',2),(1571,'manage','إدارة',1),(1572,'manage','Manage',2),(1573,'management','إدارة',1),(1574,'management','Management',2),(1575,'manual','دليل المستخدم',1),(1576,'manual','Manual',2),(1577,'manuals','أدلة المستخدم',1),(1578,'manuals','Manuals',2),(1579,'map_the_plo_with_survey','ربط مخرجات التعلم للبرنامج مع استبيان',1),(1580,'map_the_plo_with_survey','Map the PLO with Survey',2),(1581,'mapping','ربط',1),(1582,'mapping','Mapping',2),(1583,'mapping_matrix','مصفوفة الربط',1),(1584,'mapping_matrix','Mapping Matrix',2),(1585,'material_description','وصف المادة',1),(1586,'material_description','Material Description',2),(1587,'material_title','عنوان المادة',1),(1588,'material_title','Material Title',2),(1589,'material_type','نوع المادة',1),(1590,'material_type','Material Type',2),(1591,'material_value','قيمة المادة',1),(1592,'material_value','Material Value',2),(1593,'mean_score','معنى النقاط',1),(1594,'mean_score','Mean Score',2),(1595,'means','المعنى',1),(1596,'means','Means',2),(1597,'measurable_objective','الغايات القياسية',1),(1598,'measurable_objective','Measurable Objective',2),(1599,'measure','القياس',1),(1600,'measure','Measure',2),(1601,'measure_has_entered','قياس تم إدخاله',1),(1602,'measure_has_entered','Measure has Entered',2),(1603,'member','الأعضاء',1),(1604,'member','Member',2),(1605,'members','الأعضاء',1),(1606,'members','Members',2),(1607,'membership','العضوية',1),(1608,'membership','Membership',2),(1609,'message','رسالة',1),(1610,'message','Message',2),(1611,'milestone','معلم',1),(1612,'milestone','Milestone',2),(1613,'minimal_contribution','الحد الأدنى للمساهمة',1),(1614,'minimal_contribution','Minimal contribution',2),(1615,'minimal_initiative','الحد الأدنى للمبادرات',1),(1616,'minimal_initiative','minimal Initiative',2),(1617,'minimal_participation','الحد الأدنى للمشاركة',1),(1618,'minimal_participation','Minimal participation',2),(1619,'missed_assignment','التغيب عن الوظائف',1),(1620,'missed_assignment','Missed Assignment',2),(1621,'missed_assignment_policies','سياسات التغيب عن الوظيفة',1),(1622,'missed_assignment_policies','Missed Assignment Policies',2),(1623,'missed_exam','التغيب عن الامتحان',1),(1624,'missed_exam','Missed Exam',2),(1625,'missed_exam_policies','سياسات التغيب عن الإمتحان',1),(1626,'missed_exam_policies','Missed Exam Policies',2),(1627,'mission','رؤية',1),(1628,'mission','Mission',2),(1629,'mission_successfully_saved','تم حفظ الرؤية بنجاح',1),(1630,'mission_successfully_saved','Mission Successfully Saved',2),(1631,'mobile_no.','رقم الهاتف',1),(1632,'mobile_no.','Mobile No.',2),(1633,'month','شهر',1),(1634,'month','Month',2),(1635,'months','أشهر',1),(1636,'months','months',2),(1637,'moral_value','قيمة أخلاقية',1),(1638,'moral_value','Moral Value',2),(1639,'more','المزيد',1),(1640,'more','More',2),(1641,'more_inputs','المزيد من المدخلات',1),(1642,'more_inputs','More Inputs',2),(1643,'more_notifications','جميع الإشعارات',1),(1644,'more_notifications','More Notifications',2),(1645,'more_response','جميع الاستجابات',1),(1646,'more_response','More Response',2),(1647,'move','نقل',1),(1648,'move','Move',2),(1649,'move_here','انقل هنا',1),(1650,'move_here','Move Here',2),(1651,'must_be_greater_than_0','يجب أن يكون أعلى من 0',1),(1652,'must_be_greater_than_0','Must Be Greater than 0',2),(1653,'must_be_less_than_100','يجب أن يكون أقل من 100',1),(1654,'must_be_less_than_100','Must Be less than 100',2),(1655,'must_be_real_number','يجب أن يكون رقم',1),(1656,'must_be_real_number','Must Be Real Number',2),(1657,'must_select_type','يجب اختيار نوع',1),(1658,'must_select_type','Must select Type',2),(1659,'my_files','ملفاتي',1),(1660,'my_files','My files',2),(1661,'my_groups','مجموعاتي',1),(1662,'my_groups','My Groups',2),(1663,'my_portfolio','ملفي الشخصي',1),(1664,'my_portfolio','My Portfolio',2),(1665,'my_tasks','المهام الخاصة بي',1),(1666,'my_tasks','My Tasks',2),(1667,'n/a','غير قابل للتطبيق',1),(1668,'n/a','N/A',2),(1669,'name','الاسم',1),(1670,'name','Name',2),(1671,'name_is_required','الاسم مطلوب',1),(1672,'name_is_required','Name is Required',2),(1673,'national','وطني',1),(1674,'national','National',2),(1675,'national_accreditation','إعتماد وطني',1),(1676,'national_accreditation','National Accreditation',2),(1677,'nationality','الجنسية',1),(1678,'nationality','Nationality',2),(1679,'ncaaa','NCAAA',1),(1680,'ncaaa','NCAAA',2),(1681,'ncaaa_domain','مجال NCAAA',1),(1682,'ncaaa_domain','NCAAA Domain',2),(1683,'ncaaa_kpi','مؤشر أداء خاص ب NCAAA',1),(1684,'ncaaa_kpi','NCAAA KPI',2),(1685,'ncaaa_kpi?','مؤشر أداء NCAAA ؟',1),(1686,'ncaaa_kpi?','NCAAA KPI?',2),(1687,'ncaaa_kpis','مؤشرات الأداء الخاصة ب NCAAA',1),(1688,'ncaaa_kpis','NCAAA KPIs',2),(1689,'ncaaa_out_of_all','جميع NCAAA',1),(1690,'ncaaa_out_of_all','NCAAA out of All',2),(1691,'ncaaa_outcomes','مخرجات NCAAA',1),(1692,'ncaaa_outcomes','NCAAA Outcomes',2),(1693,'ncaaa_student_outcomes','مخرجات الطالب NCAAA',1),(1694,'ncaaa_student_outcomes','NCAAA Student Outcomes',2),(1695,'negative','سالب',1),(1696,'negative','Negative',2),(1697,'new','جديد',1),(1698,'new','New',2),(1699,'new_action_plan','خطة عمل جديدة',1),(1700,'new_action_plan','New Action Plan',2),(1701,'new_benchmark','مؤشر جديد',1),(1702,'new_benchmark','New Benchmark',2),(1703,'new_email','بريد إلكتروني جديد',1),(1704,'new_email','New Email',2),(1705,'new_group','مجموعة جديدة',1),(1706,'new_group','New Group',2),(1707,'new_material','مادة جديدة',1),(1708,'new_material','New Material',2),(1709,'new_measure','مقياس جديد',1),(1710,'new_measure','New Measure',2),(1711,'new_password','كلمة السر الجديدة',1),(1712,'new_password','New Password',2),(1713,'new_question','سؤال جديد',1),(1714,'new_question','New Question',2),(1715,'new_works','أعمال جديدة',1),(1716,'new_works','New Works',2),(1717,'next','التالي',1),(1718,'next','Next',2),(1719,'next_step','الخطوة التالية',1),(1720,'next_step','Next Step',2),(1721,'no','لا',1),(1722,'no','No',2),(1723,'no_activities,_check_projects_dashboard','لا يوجد نشاطات، تفقد لوحة القيادة الخاصة بمشروعك',1),(1724,'no_activities,_check_projects_dashboard','No activities, Check projects dashboard',2),(1725,'no_changes','لا يوجد تعديلات',1),(1726,'no_changes','No Changes',2),(1727,'no_contribution','لا يوجد مساهمات',1),(1728,'no_contribution','No contribution',2),(1729,'no_cs_or_cr_done','لا يوجد CS أو CR تم الإنتهاء منها',1),(1730,'no_cs_or_cr_done','No CS or CR done',2),(1731,'no_custom_items','لا يوجد عناصر مخصصة',1),(1732,'no_custom_items','No Custom Items',2),(1733,'no_data','لا يوجد بيانات',1),(1734,'no_data','No Data',2),(1735,'no_goals','لا يوجد أهداف',1),(1736,'no_goals','No Goals',2),(1737,'no_goals_to_be_integrated','لا يوجد أهداف ليتم ربطها',1),(1738,'no_goals_to_be_integrated','No Goals to be Integrated',2),(1739,'no_graph_to_be_displayed','لا يوجد أهداف ليتم عرضها',1),(1740,'no_graph_to_be_displayed','آNo Graph to be Displayed',2),(1741,'no_groups','لا يوجد مجموعات',1),(1742,'no_groups','No Groups',2),(1743,'no_initiative','لا يوجد مبادرات',1),(1744,'no_initiative','No Initiative',2),(1745,'no_kpis','لا يوجد مؤشرات أداء',1),(1746,'no_kpis','No KPIs',2),(1747,'no_kpis_to_be_display_for_this_kpi_type.','لا يوجد مؤشرات أداء يمكن إظهارها لهذا النوع من مؤشرات الأداء',1),(1748,'no_kpis_to_be_display_for_this_kpi_type.','No KPIs to be display for this KPI type.',2),(1749,'no_kpis_to_be_displayed','لا يوجد مؤشرات أداء رئيسية ليتم عرضها',1),(1750,'no_kpis_to_be_displayed','No KPIs to be Displayed',2),(1751,'no_messages','لا يوجد رسائل',1),(1752,'no_messages','No Messages',2),(1753,'no_notification','لا يوجد إشعار',1),(1754,'no_notification','No Notification',2),(1755,'no_objectives_found.','لم يتم العثور على الغايات',1),(1756,'no_objectives_found.','No Objectives found.',2),(1757,'no_objectives_to_be_integrated','لا يوجد غايات ليتم ربطها',1),(1758,'no_objectives_to_be_integrated','No Objectives to be integrated',2),(1759,'no_participation','لا يوجد  مشاركة',1),(1760,'no_participation','No participation',2),(1761,'no_pending_surveys','لا يوجد استبيانات معلقة',1),(1762,'no_pending_surveys','No Pending Surveys',2),(1763,'no_permission','لا يوجد صلاحية',1),(1764,'no_permission','No Permission',2),(1765,'no_permissions','لا يوجد صلاحيات',1),(1766,'no_permissions','No Permissions',2),(1767,'no_program_selected','لم يتم اختيار برنامج',1),(1768,'no_program_selected','No program selected',2),(1769,'no_recommendations_to_be_displayed','لا يوجد توصيات ليتم عرضها',1),(1770,'no_recommendations_to_be_displayed','No recommendations to be displayed',2),(1771,'no_related_program_plan','لا يوجد خطة برنامج لها علاقة',1),(1772,'no_related_program_plan','No related program plan',2),(1773,'no_results_found_for','لا يوجد نتائج',1),(1774,'no_results_found_for','No results found for',2),(1775,'no_reviews','لا يوجد مراجعات',1),(1776,'no_reviews','No Reviews',2),(1777,'no_semesters','لا يوجد فصول دراسية',1),(1778,'no_semesters','No Semesters',2),(1779,'no_strategy_found,_please_build_a_strategy','لا يوجد استراتيجية، يرجى القيام ببناء استراتيجية',1),(1780,'no_strategy_found,_please_build_a_strategy','No Strategy Found, Please build a strategy',2),(1781,'no_strategy_on_this_semester','لا يوجد تخطيط استراتيجي لهذا الفصل',1),(1782,'no_strategy_on_this_semester','No Strategy on this semester',2),(1783,'no_values','لا يوجد قيمة',1),(1784,'no_values','No Values',2),(1785,'no_values_to_be_displayed','قيم ليتم عرضها',1),(1786,'no_values_to_be_displayed','No values to be displayed',2),(1787,'no._of_courses','عدد المواد الدراسية',1),(1788,'no._of_courses','No. of Courses',2),(1789,'no._of_kpis','عدد مؤشرات الأداء',1),(1790,'no._of_kpis','No. Of KPIs',2),(1791,'non-ncaaa_kpi','مؤشر أداء غير NCAAA',1),(1792,'non-ncaaa_kpi','Non-NCAAA KPI',2),(1793,'not_applicable','غير قابل للتطبيق',1),(1794,'not_applicable','Not Applicable',2),(1795,'not_completed','لم ينته',1),(1796,'not_completed','Not Completed',2),(1797,'not_compliant','غير متوافق',1),(1798,'not_compliant','Not Compliant',2),(1799,'not_defined','غير موجود',1),(1800,'not_defined','Not Defined',2),(1801,'not_reported','لم يبلغ عنها',1),(1802,'not_reported','Not Reported',2),(1803,'not_selected','غير مختارة',1),(1804,'not_selected','Not Selected',2),(1805,'not_specified','غير محدد',1),(1806,'not_specified','Not Specified',2),(1807,'not_started','لم يبدأ',1),(1808,'not_started','Not Started',2),(1809,'not_submitted','لم يتم التسليم',1),(1810,'not_submitted','Not Submitted',2),(1811,'note','ملاحظة',1),(1812,'note','Note',2),(1813,'notice','تنويه',1),(1814,'notice','Notice',2),(1815,'notification','إشعار',1),(1816,'notification','Notification',2),(1817,'notification_before','الاشعار قبل',1),(1818,'notification_before','Notification Before',2),(1819,'notification_name','اسم الإشعار',1),(1820,'notification_name','Notification Name',2),(1821,'notification_settings','إعدادات الإشعارات',1),(1822,'notification_settings','Notification Settings',2),(1823,'notification_settings_saved_successfully','تم حفظ إعدادات الاشعارات بنجاح',1),(1824,'notification_settings_saved_successfully','Notification Settings Saved Successfully',2),(1825,'notification_subject','موضوع الإشعار',1),(1826,'notification_subject','Notification Subject',2),(1827,'notifications','الإشعارات',1),(1828,'notifications','Notifications',2),(1829,'notifications_list','لائحة الإشعارات',1),(1830,'notifications_list','Notifications List',2),(1831,'number_of_colleges','عدد الكليات',1),(1832,'number_of_colleges','Number of Colleges',2),(1833,'number_of_faculty','عدد أعضاء هيئة التدريس',1),(1834,'number_of_faculty','Number of faculty',2),(1835,'number_of_hours','عدد الساعات',1),(1836,'number_of_hours','Number Of Hours',2),(1837,'number_of_levels','عدد المستويات في المقياس',1),(1838,'number_of_levels','Number of Levels in the Scale',2),(1839,'number_of_levels_has_not_been_added','لم يتم إضافة عدد المستويات',1),(1840,'number_of_levels_has_not_been_added','Number of levels has not been added',2),(1841,'number_of_programs','عدد البرامج',1),(1842,'number_of_programs','Number of Programs',2),(1843,'number_of_sections','عدد الشعب',1),(1844,'number_of_sections','Number of sections',2),(1845,'number_of_students','عدد الطلاب',1),(1846,'number_of_students','Number of Students',2),(1847,'number_of_years','عدد السنوات',1),(1848,'number_of_years','Number of Years',2),(1849,'objective','غاية',1),(1850,'objective','Objective',2),(1851,'objective_kpis','غاية مؤشرات الأداء الرئيسية',1),(1852,'objective_kpis','Objective KPIs',2),(1853,'objective_milestone','معلم الغاية',1),(1854,'objective_milestone','Objective Milestone',2),(1855,'objective_milestone_successfully_saved','تم حفظ معلم الغاية بنجاح',1),(1856,'objective_milestone_successfully_saved','Objective Milestone Successfully Saved',2),(1857,'objective_not_found','لم يتم العثور على الغاية',1),(1858,'objective_not_found','Objective not found',2),(1859,'objective_removed_successfully','تم حذف الغاية بنجاح',1),(1860,'objective_removed_successfully','Objective removed successfully',2),(1861,'objective_successfully_saved','تم حفظ الغاية بنجاح',1),(1862,'objective_successfully_saved','Objective Successfully Saved',2),(1863,'objective_title','عنوان الغاية',1),(1864,'objective_title','Objective Title',2),(1865,'objective_with_aligned_to_institutional_objective','الغايات ومحاذاتها لمهام المؤسسة',1),(1866,'objective_with_aligned_to_institutional_objective','Objective with Aligned to Institutional Objective',2),(1867,'objectives','الغايات',1),(1868,'objectives','Objectives',2),(1869,'objectives_result','نتائج الغايات',1),(1870,'objectives_result','Objectives Result',2),(1871,'observation','ملاحظة',1),(1872,'observation','Observation',2),(1873,'of_reviewers','من المراجعين',1),(1874,'of_reviewers','of Reviewers',2),(1875,'of_students','من الطلاب',1),(1876,'of_students','of Students',2),(1877,'offered_program','البرنامج المقدّم',1),(1878,'offered_program','Offered Program',2),(1879,'office_hours','الساعات المكتبية',1),(1880,'office_hours','Office hours',2),(1881,'office_location','موقع المكتب',1),(1882,'office_location','Office Location',2),(1883,'office_no','رقم المكتب',1),(1884,'office_no','Office No',2),(1885,'office_number','رقم المكتب',1),(1886,'office_number','Office Number',2),(1887,'old','قديم',1),(1888,'old','Old',2),(1889,'old_password','كلمة السر القديمة',1),(1890,'old_password','Old Password',2),(1891,'old_password_is_incorrect','كلمة السر القديمة غير صحيحة',1),(1892,'old_password_is_incorrect','old password is incorrect',2),(1893,'only_integer_value_is_allowed','فقط الأرقام الصحيحة مسموحة',1),(1894,'only_integer_value_is_allowed','Only integer value is allowed',2),(1895,'optional','خياري',1),(1896,'optional','optional',2),(1897,'oral','شفهي',1),(1898,'oral','Oral',2),(1899,'organization','التنظيم',1),(1900,'organization','Organization',2),(1901,'organization_chart','مخطط تنظيمي',1),(1902,'organization_chart','Organization Chart',2),(1903,'original_language','اللغة الأصلية',1),(1904,'original_language','Original Language',2),(1905,'original_researcher','الباحثين الأصليين',1),(1906,'original_researcher','Original Researcher',2),(1907,'original_type','النوع الأصلي',1),(1908,'original_type','Original Type',2),(1909,'other_supporting_author','دعم المؤلف الأخرى',1),(1910,'other_supporting_author','Other supporting author',2),(1911,'others','أخرى',1),(1912,'others','Others',2),(1913,'outcome','المخرج',1),(1914,'outcome','Outcome',2),(1915,'outcomes','المخرجات',1),(1916,'outcomes','Outcomes',2),(1917,'outcomes_results','نتائج المخرجات',1),(1918,'outcomes_results','Outcomes Results',2),(1919,'overall','الجميع',1),(1920,'overall','Overall',2),(1921,'overall_allowed','مسموح كلياً',1),(1922,'overall_allowed','Overall allowed',2),(1923,'overall_band_performance','أداء الفرقة العام',1),(1924,'overall_band_performance','Overall Band Performance',2),(1925,'overall_band_performance_based_on_slos','أداء الفرقة العام المعتمد على مخرجات التعلم للطلاب',1),(1926,'overall_band_performance_based_on_slos','Overall Band Performance based on SLOs',2),(1927,'overall_developmental_action_plan_for_academic_year','خطة العمل التنموية العامة للسنة الدراسية',1),(1928,'overall_developmental_action_plan_for_academic_year','Overall developmental action plan for academic year',2),(1929,'overall_evaluation','التقييم العام',1),(1930,'overall_evaluation','Overall Evaluation',2),(1931,'overall_faculty_performance','أداؤ عضو الهيئة التدريسية العام',1),(1932,'overall_faculty_performance','overall faculty performance',2),(1933,'overall_mean_avg._score','المعنى العام لمعدل النقاط',1),(1934,'overall_mean_avg._score','Overall Mean Avg. Score',2),(1935,'overall_performance_band','أداء الفرق العام',1),(1936,'overall_performance_band','Overall Performance Band',2),(1937,'overall_weighted_score','النتيجة المرجحة الكلية',1),(1938,'overall_weighted_score','Overall Weighted Score',2),(1939,'owner_name','اسم المنشئ',1),(1940,'owner_name','Owner Name',2),(1941,'package','المحفظة',1),(1942,'package','Package',2),(1943,'page','صفحة',1),(1944,'page','Page',2),(1945,'page_count','عدد الصفحة',1),(1946,'page_count','Page Count',2),(1947,'page_from','صفحة من',1),(1948,'page_from','Page From',2),(1949,'page_to','صفحة إلى',1),(1950,'page_to','Page To',2),(1951,'pages_count','عدد الصفحات',1),(1952,'pages_count','Pages Count',2),(1953,'paper_in_progress','ورق في تقدم',1),(1954,'paper_in_progress','Paper In Progress',2),(1955,'paper_status','حالة الورقة',1),(1956,'paper_status','Paper Status',2),(1957,'parameter','متغير',1),(1958,'parameter','Parameter',2),(1959,'params','المتغيرات',1),(1960,'params','Params',2),(1961,'parent_goal','الهدف الرئيسي',1),(1962,'parent_goal','Parent Goal',2),(1963,'parent_objective','المهام الرئيسية',1),(1964,'parent_objective','Parent Objective',2),(1965,'parent_project','المشروع الرئيسي',1),(1966,'parent_project','Parent Project',2),(1967,'parent_unit','الوحدة الرئيسية',1),(1968,'parent_unit','Parent Unit',2),(1969,'participation','مشاركة',1),(1970,'participation','Participation',2),(1971,'participation_type','نوع المشاركة',1),(1972,'participation_type','Participation Type',2),(1973,'partly_compliant','متوافق جزئي',1),(1974,'partly_compliant','Partly Compliant',2),(1975,'party','حفل',1),(1976,'party','Party',2),(1977,'password','البريد الإلكتروني',1),(1978,'password','Password',2),(1979,'password_changed_successfully','تم تغيير كلمة السر بنجاح',1),(1980,'password_changed_successfully','Password Changed Successfully',2),(1981,'password_has_been_successfully_changed','تم تغيير كلمة السر بنجاح',1),(1982,'password_has_been_successfully_changed','Password has been Successfully Changed',2),(1983,'password_must_be_between_6_and_20_digits','كلمة السر يجب أن تتراوح بي 6-20 خانة',1),(1984,'password_must_be_between_6_and_20_digits','Password Must Be Between 6 and 20 Digits',2),(1985,'password_reset','إعادة تعيين كلمة السر',1),(1986,'password_reset','Password reset',2),(1987,'passwords_not_matched','كلمات السر لم تتطابق',1),(1988,'passwords_not_matched','Passwords not Matched',2),(1989,'paste_here','الصق هنا',1),(1990,'paste_here','Paste Here',2),(1991,'path','مسار',1),(1992,'path','Path',2),(1993,'pdf','PDF',1),(1994,'pdf','PDF',2),(1995,'peer','نظير',1),(1996,'peer','Peer',2),(1997,'per_accreditation_statuses','في حالات الاعتماد',1),(1998,'per_accreditation_statuses','per accreditation statuses',2),(1999,'percentage','نسبة',1),(2000,'percentage','Percentage',2),(2001,'performance','الأداء',1),(2002,'performance','Performance',2),(2003,'performance_achievement','إنجاز الأداء الأداء',1),(2004,'performance_achievement','Performance Achievement',2),(2005,'performance_achievement_for_academic_year','إنجاز الأداء للسنة الأكاديمية',1),(2006,'performance_achievement_for_academic_year','Performance Achievement for academic year',2),(2007,'permission_denied','لا تملك الصلاحية',1),(2008,'permission_denied','Permission Denied',2),(2009,'permissions_denied','لا تملك الصلاحيات',1),(2010,'permissions_denied','Permissions Denied',2),(2011,'personal','شخصي',1),(2012,'personal','Personal',2),(2013,'personal_email','البريد الإلكتروني الشخصي',1),(2014,'personal_email','Personal Email',2),(2015,'personal_info','البيانات الشخصية',1),(2016,'personal_info','Personal Info',2),(2017,'personal_information','البيانات الشخصية',1),(2018,'personal_information','Personal Information',2),(2019,'perspectives','وجهات النظر',1),(2020,'perspectives','Perspectives',2),(2021,'perspectives_legends','المسميات التوضيحية لوجهات النظر',1),(2022,'perspectives_legends','Perspectives Legends',2),(2023,'phd_holder','حاملي شهادة الدكتوراة',1),(2024,'phd_holder','PhD Holder',2),(2025,'phone','الهاتف',1),(2026,'phone','Phone',2),(2027,'phone_number','رقم الهاتف',1),(2028,'phone_number','Phone Number',2),(2029,'placeholders','الرموز',1),(2030,'placeholders','Placeholders',2),(2031,'plan','خطة',1),(2032,'plan','Plan',2),(2033,'please_add_at_least_one_assessment_component','يرجى إدخال عنصر تقييم واحد على الأقل',1),(2034,'please_add_at_least_one_assessment_component','Please add at least one assessment component',2),(2035,'please_add_at_least_one_learning_outcome','يرجى إضافة مخرج تعلم واحد على الأقل',1),(2036,'please_add_at_least_one_learning_outcome','Please add at least one learning outcome',2),(2037,'please_add_your_options_separated_by_comma','يرجى إضافة الخيارات الخاصة بك وبينها فاصلة \" ، \"',1),(2038,'please_add_your_options_separated_by_comma','Please Add your options Separated by comma',2),(2039,'please_check_due_date','يرجى التحقق من موعد التسليم',1),(2040,'please_check_due_date','Please Check Due Date',2),(2041,'please_choice_available_status','يرجى اختيار حالة متاحة',1),(2042,'please_choice_available_status','Please choice available status',2),(2043,'please_choose_kpi_category_/_no_kpis_found.','يرجى اختيار فئة مؤشرات الأداء / لم يتم العثور على مؤشرات أداء',1),(2044,'please_choose_kpi_category_/_no_kpis_found.','Please choose KPI Category / No KPIs found.',2),(2045,'please_choose_one_of_assessment_loop_type','يرجى اختيار أحد أنواع دائرة التقييم',1),(2046,'please_choose_one_of_assessment_loop_type','Please Choose One Of Assessment Loop Type',2),(2047,'please_choose_program_/_no_course_learning_outcome_found.','يرجى اختيار برنامج / ليم يتم العثور على مخرجات التعلم للمادة الدراسية',1),(2048,'please_choose_program_/_no_course_learning_outcome_found.','Please choose Program / No Course Learning Outcome found.',2),(2049,'please_choose_program_/_no_program_learning_outcome_found.','يرجى اختيار برنامج / لم يتم العثور على مخرجات التعلم للبرنامج',1),(2050,'please_choose_program_/_no_program_learning_outcome_found.','Please choose Program / No Program Learning Outcome found.',2),(2051,'please_choose_the_review_status','يرجى اختيار حالة المراجعة',1),(2052,'please_choose_the_review_status','Please choose the review status',2),(2053,'please_click_on_survey_to_fill_your_survey','يرجى النقر على \"استبيان\" لتبعئة الاستبيان الخاص بك',1),(2054,'please_click_on_survey_to_fill_your_survey','Please click on survey to fill your survey',2),(2055,'please_contact_college_/_program_admin','يرجى التواصل مع مشرف الكلية / البرنامج',1),(2056,'please_contact_college_/_program_admin','Please Contact College / Program Admin',2),(2057,'please_enter','يرجى إدخال',1),(2058,'please_enter','Please enter',2),(2059,'please_enter_a_comment.','يرجى إدخال تعليق',1),(2060,'please_enter_a_comment.','Please Enter a Comment.',2),(2061,'please_enter_a_due_date_for_this_form','يرجى إدخال موعد تسليم لهذا النموذج',1),(2062,'please_enter_a_due_date_for_this_form','Please Enter a Due Date For This Form',2),(2063,'please_enter_accredited_years','يرجى إدخال عدد سنوات الإعتماد',1),(2064,'please_enter_accredited_years','Please Enter Accredited Years',2),(2065,'please_enter_action','يرجى إدخال إجراء',1),(2066,'please_enter_action','Please Enter Action',2),(2067,'please_enter_additions_and_revisions','يرجى إخال اﻹضافات والمراجعات',1),(2068,'please_enter_additions_and_revisions','Please enter Additions and Revisions',2),(2069,'please_enter_agency_name','يرجى إدخال اسم الهيئة',1),(2070,'please_enter_agency_name','Please Enter Agency Name',2),(2071,'please_enter_analysis','يرجى إدخال التحليل',1),(2072,'please_enter_analysis','Please Enter Analysis',2),(2073,'please_enter_assessment_method_title','يرجى إدخال عنوان طريقة التقييم',1),(2074,'please_enter_assessment_method_title','Please enter assessment method Title',2),(2075,'please_enter_campus_name','يرجى إدخال اسم الفرع الجامعي',1),(2076,'please_enter_campus_name','Please Enter Campus Name',2),(2077,'please_enter_college_mission_keyword','يرجى إدخال الكلمة المفتاحية للكلية',1),(2078,'please_enter_college_mission_keyword','Please enter College Mission Keyword',2),(2079,'please_enter_college_name','يرجى إدخال اسم الكلية',1),(2080,'please_enter_college_name','Please Enter College Name',2),(2081,'please_enter_course_code','يرجى إدخال رمز المادة الدراسية',1),(2082,'please_enter_course_code','Please Enter Course Code',2),(2083,'please_enter_course_name','يرجى إدخال اسم المادة الدراسية',1),(2084,'please_enter_course_name','Please Enter Course Name',2),(2085,'please_enter_course_type','يرجى إدخال نوع المادة الدراسية',1),(2086,'please_enter_course_type','Please Enter Course Type',2),(2087,'please_enter_criteria_code','يرجى ادخال رمز المقياس',1),(2088,'please_enter_criteria_code','Please Enter Criteria Code',2),(2089,'please_enter_criteria_title','يرجى ادخال عنوان المقياس',1),(2090,'please_enter_criteria_title','Please Enter Criteria Title',2),(2091,'please_enter_degree_name','يرجى إدخال اسم الدرجة العلمية',1),(2092,'please_enter_degree_name','Please Enter Degree Name',2),(2093,'please_enter_department_name','يرجى إدخال اسم القسم',1),(2094,'please_enter_department_name','Please Enter Department Name',2),(2095,'please_enter_description','يرجى إدخال الوصف',1),(2096,'please_enter_description','Please enter Description',2),(2097,'please_enter_end_date','يرجى إدخال تاريخ الإنتهاء',1),(2098,'please_enter_end_date','Please Enter end date',2),(2099,'please_enter_file_title','يرجى إدخال اسم الملف',1),(2100,'please_enter_file_title','Please enter File Title',2),(2101,'please_enter_institution_name','يرجى إدخال اسم المؤسسة',1),(2102,'please_enter_institution_name','Please Enter Institution Name',2),(2103,'please_enter_item_code','يرجى ادخال رمز العنصر',1),(2104,'please_enter_item_code','Please Enter Item Code',2),(2105,'please_enter_item_title','يرجى ادخال عنوان العنصر',1),(2106,'please_enter_item_title','Please Enter Item Title',2),(2107,'please_enter_kind','يرجى اختيار النوع',1),(2108,'please_enter_kind','Please Enter Kind',2),(2109,'please_enter_learning_domain_title','يرجى إدخال عنوان مجال التعلم',1),(2110,'please_enter_learning_domain_title','Please enter learning domain Title',2),(2111,'please_enter_major_name','يرجى إدخال اسم التخصص',1),(2112,'please_enter_major_name','Please Enter Major Name',2),(2113,'please_enter_manual_label','يرجى إدخال تسمية دليل المستخدم',1),(2114,'please_enter_manual_label','Please Enter Manual Label',2),(2115,'please_enter_manual_link','يرجى إدخال رابط دليل المستخدم',1),(2116,'please_enter_manual_link','Please Enter Manual Link',2),(2117,'please_enter_measure_text','يرجى إدخال نص المقياس',1),(2118,'please_enter_measure_text','Please Enter Measure Text',2),(2119,'please_enter_name','يرجى إدخال الاسم',1),(2120,'please_enter_name','Please Enter name',2),(2121,'please_enter_notification_before','يرجى إدخال وقت ارسال الإشعار',1),(2122,'please_enter_notification_before','Please Enter Notification Before',2),(2123,'please_enter_notification_body','يرجى إدخال نص الإشعار',1),(2124,'please_enter_notification_body','Please Enter Notification Body',2),(2125,'please_enter_notification_name','يرجى إدخال اسم الإشعار',1),(2126,'please_enter_notification_name','Please Enter Notification Name',2),(2127,'please_enter_notification_subject','يرجى إدخال عنوان الإشعار',1),(2128,'please_enter_notification_subject','Please Enter Notification Subject',2),(2129,'please_enter_options','يرجى إدخال الخيارات',1),(2130,'please_enter_options','Please Enter Options',2),(2131,'please_enter_program_mission_keyword','يرجى إدخال الكلمة المفتاحية للبرنامج',1),(2132,'please_enter_program_mission_keyword','Please enter Program Mission Keyword',2),(2133,'please_enter_program_name','يرجى إدخال اسم البرنامج',1),(2134,'please_enter_program_name','Please Enter Program Name',2),(2135,'please_enter_recommendation_text','يرجى إدخال نص التوصية',1),(2136,'please_enter_recommendation_text','Please Enter Recommendation Text',2),(2137,'please_enter_responsible','يرجى إدخال الشخص المسؤول',1),(2138,'please_enter_responsible','Please Enter responsible',2),(2139,'please_enter_result_text','يرجى إدخال نص النتيجة',1),(2140,'please_enter_result_text','Please Enter Result Text',2),(2141,'please_enter_search_text','يرجى إدخال نص البحث',1),(2142,'please_enter_search_text','Please Enter Search Text',2),(2143,'please_enter_section_no.','يرجى إدخال رقم الشعبة',1),(2144,'please_enter_section_no.','Please Enter Section No.',2),(2145,'please_enter_standard_code','يرجى ادخال رمز المعيار',1),(2146,'please_enter_standard_code','Please Enter Standard Code',2),(2147,'please_enter_standard_name','يرجى إدخال اسم المعيار',1),(2148,'please_enter_standard_name','Please Enter Standard Name',2),(2149,'please_enter_start_date','يرجى إدخال تاريخ البدء',1),(2150,'please_enter_start_date','Please Enter start date',2),(2151,'please_enter_student_status_name','يرجى إدخال اسم حالة الطالب',1),(2152,'please_enter_student_status_name','Please Enter Student Status Name',2),(2153,'please_enter_subject','يرجى اختيار عنوان للرسالة',1),(2154,'please_enter_subject','Please Enter Subject',2),(2155,'please_enter_text','يرجى إدخال النص',1),(2156,'please_enter_text','Please enter Text',2),(2157,'please_enter_the_key_performance_indicator_or_this_is_a_duplicate_kpi_and_strategy_entry.','يرجى إدخال مؤشر أداء رئيسي أم أنه تكرار لمؤشر أداء آخر وإدخال الاستراتيجية',1),(2158,'please_enter_the_key_performance_indicator_or_this_is_a_duplicate_kpi_and_strategy_entry.','Please Enter the Key Performance Indicator or This is a Duplicate KPI and Strategy entry.',2),(2159,'please_enter_time_frame','يرجى إدخال المدة الزمنية',1),(2160,'please_enter_time_frame','Please Enter Time Frame',2),(2161,'please_enter_title','يرجى إدخال العنوان',1),(2162,'please_enter_title','Please enter Title',2),(2163,'please_enter_type','يرجى إدخال النوع',1),(2164,'please_enter_type','Please enter Type',2),(2165,'please_enter_unit_name','يرجى إدخال اسم الوحدة',1),(2166,'please_enter_unit_name','Please Enter Unit Name',2),(2167,'please_enter_university_mission_keyword','يرجى إدخال الكملة المفتاحية للجامعة',1),(2168,'please_enter_university_mission_keyword','Please enter University Mission Keyword',2),(2169,'please_enter_valid_kind','يرجى اختيار نوع صحيح',1),(2170,'please_enter_valid_kind','Please Enter Valid Kind',2),(2171,'please_enter_your_options_separated_by_comma','يرجى إدخال الخيارات الخاصة بك وبينها فاصلة \" ، \"',1),(2172,'please_enter_your_options_separated_by_comma','Please enter your options separated by comma',2),(2173,'please_enter_your_password','يرجى إدخال كلمة السر',1),(2174,'please_enter_your_password','Please Enter Your Password',2),(2175,'please_fill_description_field','يرجى تعبئة الحقل الخاص بالوصف',1),(2176,'please_fill_description_field','Please Fill Description Field',2),(2177,'please_fill_progress_field','يرجى تعبئة الحقل الخاص بالتقدم',1),(2178,'please_fill_progress_field','Please Fill Progress Field',2),(2179,'please_select__employer','يرجى اختيار موظف',1),(2180,'please_select__employer','Please Select  Employer',2),(2181,'please_select_a_course!','يرجى اختيار مادة دراسية',1),(2182,'please_select_a_course!','Please Select a Course!',2),(2183,'please_select_a_student!','يرجى اختيار طالب',1),(2184,'please_select_a_student!','Please Select a Student!',2),(2185,'please_select_a_valid_type','يرجى اختيار نوع متاح',1),(2186,'please_select_a_valid_type','Please select a valid type',2),(2187,'please_select_agency','يرجى اختيار هيئة',1),(2188,'please_select_agency','Please select Agency',2),(2189,'please_select_an_assessment_method_from_left_list','يرجى اختيار طريقة تقييم من اللائحة',1),(2190,'please_select_an_assessment_method_from_left_list','Please select an Assessment Method from left list',2),(2191,'please_select_assessment_method','يرجى اختيار طريقة تقييم',1),(2192,'please_select_assessment_method','Please Select Assessment Method',2),(2193,'please_select_at_least_one_form.','يرجى اختيار نموذج واحد على الأقل',1),(2194,'please_select_at_least_one_form.','Please Select at Least one Form.',2),(2195,'please_select_at_lest_one_teacher','يرجى اختيار مدرس واحد على الأقل',1),(2196,'please_select_at_lest_one_teacher','Please Select at lest one Teacher',2),(2197,'please_select_campus','يرجى اختيار فرع الجامعة',1),(2198,'please_select_campus','Please Select Campus',2),(2199,'please_select_college','يرجى اختيار كلية',1),(2200,'please_select_college','Please Select College',2),(2201,'please_select_course','يرجى اختيار مادة دراسية',1),(2202,'please_select_course','Please Select Course',2),(2203,'please_select_criteria','يرجى اختيار قياس',1),(2204,'please_select_criteria','Please Select Criteria',2),(2205,'please_select_date','يرجى اختيار تاريخ',1),(2206,'please_select_date','Please Select Date',2),(2207,'please_select_dean','يرجى اختيار عميد',1),(2208,'please_select_dean','Please Select Dean',2),(2209,'please_select_degree','يرجى اختيار درجة علمية',1),(2210,'please_select_degree','Please Select Degree',2),(2211,'please_select_department','يرجى اختيار قسم',1),(2212,'please_select_department','Please Select Department',2),(2213,'please_select_due_date','يرجى اختيار موعد الانتهاء',1),(2214,'please_select_due_date','Please Select Due Date',2),(2215,'please_select_field_type','يرجى اختيار نوع الحقل',1),(2216,'please_select_field_type','Please Select Field Type',2),(2217,'please_select_form','يرجى اختيار نموذج',1),(2218,'please_select_form','Please Select Form',2),(2219,'please_select_level','يرجى اختيار مستوى',1),(2220,'please_select_level','Please Select Level',2),(2221,'please_select_manuals','يرجى اختيار دليل',1),(2222,'please_select_manuals','Please select Manuals',2),(2223,'please_select_material_type','يرجى اختيار نوع المادة',1),(2224,'please_select_material_type','Please Select Material Type',2),(2225,'please_select_ncaaa_learning_domain','يرجى اختيار إحدى مجالات التعلم الخاصة ب NCAAA',1),(2226,'please_select_ncaaa_learning_domain','Please select NCAAA learning domain',2),(2227,'please_select_on_of_the_forms_type_to_show_the_forms','يرجى اختيار نوع النموذج لتظهر النماذج الخاصة بهذا النوع',1),(2228,'please_select_on_of_the_forms_type_to_show_the_forms','Please Select one Of the Forms Type to Show the Forms',2),(2229,'please_select_program','يرجى اختيار برنامج',1),(2230,'please_select_program','Please Select Program',2),(2231,'please_select_program_chair','يرجى اختيار رئيس البرنامج',1),(2232,'please_select_program_chair','Please select Program chair',2),(2233,'please_select_projects','يرجى اختيار المشاريع',1),(2234,'please_select_projects','Please select Projects',2),(2235,'please_select_question_type','يرجى اختيار نوع السؤال',1),(2236,'please_select_question_type','Please Select Question Type',2),(2237,'please_select_responsible','يرجى اختيار المسؤول',1),(2238,'please_select_responsible','Please select responsible',2),(2239,'please_select_reviewer','يرجى اختيار المراجع',1),(2240,'please_select_reviewer','Please select Reviewer',2),(2241,'please_select_role','يرجى اختيار مسمى وظيفي',1),(2242,'please_select_role','Please Select Role',2),(2243,'please_select_semester','يرجى اختيار فصل دراسي',1),(2244,'please_select_semester','Please Select Semester',2),(2245,'please_select_standard','يرجى اختيار معيار',1),(2246,'please_select_standard','Please Select Standard',2),(2247,'please_select_status','يرجى اختيار حالة',1),(2248,'please_select_status','Please select Status',2),(2249,'please_select_survey','يرجى اختيار استبيان',1),(2250,'please_select_survey','Please Select Survey',2),(2251,'please_select_teacher','يرجى اختيار مدرس',1),(2252,'please_select_teacher','Please Select Teacher',2),(2253,'please_select_the_major_strategy_or_this_is_a_duplicate_kpi_and_strategy_entry.','يرجى اختيار الخطة الاستراتيجية الرئيسية  أم أنها تكرار لمؤشر أداء آخر وإدخال الاستراتيجية',1),(2254,'please_select_the_major_strategy_or_this_is_a_duplicate_kpi_and_strategy_entry.','Please Select the Major Strategy or this is a Duplicate KPI and Strategy Entry.',2),(2255,'please_select_the_unit_type','يرجى اختيار نوع الوحدة',1),(2256,'please_select_the_unit_type','Please Select the Unit Type',2),(2257,'please_select_user','يرجى اختيار مستخدم',1),(2258,'please_select_user','Please Select User',2),(2259,'please_select_year','يرجى اختيار سنة',1),(2260,'please_select_year','Please Select Year',2),(2261,'please_specify_at_least_one_recipient.','يرحى تحديد مستقبل واحد على الأقل',1),(2262,'please_specify_at_least_one_recipient.','Please specify at least one recipient.',2),(2263,'please_try_again','يرجى المحاولة مرة أخرى',1),(2264,'please_try_again','Please Try Again',2),(2265,'plo','مخرجات التعلم للبرنامج',1),(2266,'plo','PLO',2),(2267,'plo_result','نتائج مخرجات التعلم للبرنامج',1),(2268,'plo_result','PLO Result',2),(2269,'plo_to_ncaaa','مخرجات التعلم مع NCAAA',1),(2270,'plo_to_ncaaa','PLO to NCAAA',2),(2271,'plo_to_program_objectives','مخرجات التعلم للبرنامج مع رؤية البرنامج',1),(2272,'plo_to_program_objectives','PLO to Program Objectives',2),(2273,'points','النقاط',1),(2274,'points','points',2),(2275,'polarity','القطبية',1),(2276,'polarity','Polarity',2),(2277,'poor_performance','أداء سيء',1),(2278,'poor_performance','Poor Performance',2),(2279,'portfolio','الملف',1),(2280,'portfolio','Portfolio',2),(2281,'portfolio_course','ملف المواد الدراسية',1),(2282,'portfolio_course','Course Portfolio',2),(2283,'portfolios','الملفات',1),(2284,'portfolios','Portfolios',2),(2285,'position','الموقع',1),(2286,'position','Position',2),(2287,'positive','موجب',1),(2288,'positive','Positive',2),(2289,'postgraduate','دراسات عليا',1),(2290,'postgraduate','Postgraduate',2),(2291,'practical','عملي',1),(2292,'practical','practical',2),(2293,'pre-visit_reviewer','مراجع قبل الزيارة',1),(2294,'pre-visit_reviewer','Pre-Visit Reviewer',2),(2295,'preparatory_year','السنة التحضيرية',1),(2296,'preparatory_year','Preparatory Year',2),(2297,'preparatory_year_report','تقرير السنة التحضيرية',1),(2298,'preparatory_year_report','Preparatory Year Report',2),(2299,'preview','عرض',1),(2300,'preview','Preview',2),(2301,'preview_evaluation','عرض التقييم',1),(2302,'preview_evaluation','Preview Evaluation',2),(2303,'preview_survey','عرض الاستبيان',1),(2304,'preview_survey','Preview Survey',2),(2305,'previous','السابق',1),(2306,'previous','Previous',2),(2307,'print','طباعة',1),(2308,'print','Print',2),(2309,'print_survey','طباعة الاستبيان',1),(2310,'print_survey','Print Survey',2),(2311,'process_based','استناد العملية',1),(2312,'process_based','Process Based',2),(2313,'process_or_result','التقدم أو النتائج',1),(2314,'process_or_result','Process Or Result',2),(2315,'proficiency','البراعة',1),(2316,'proficiency','Proficiency',2),(2317,'profile','الملف الشخصي',1),(2318,'profile','Profile',2),(2319,'program','برنامج',1),(2320,'program','Program',2),(2321,'program_&_institution_criteria','مقياس المؤسسة والبرنامج',1),(2322,'program_&_institution_criteria','Program & Institution Criteria',2),(2323,'program_agencies','هيئات البرامج',1),(2324,'program_agencies','Program Agencies',2),(2325,'program_assessment_component','محتوى تقييم البرنامج',1),(2326,'program_assessment_component','Program Assessment Component',2),(2327,'program_assessment_method','طرق التقييم للبرنامج',1),(2328,'program_assessment_method','Program Assessment Method',2),(2329,'program_by_level_enrolled','البرنامج من مستوى المقيدين',1),(2330,'program_by_level_enrolled','Program by Level Enrolled',2),(2331,'program_chair','رئيس البرنامج',1),(2332,'program_chair','Program Chair',2),(2333,'program_criteria','مقياس البرنامج',1),(2334,'program_criteria','Program Criteria',2),(2335,'program_faculty_profile','ملف عضو هيئة البرنامج',1),(2336,'program_faculty_profile','Program Faculty Profile',2),(2337,'program_goals','أهداف البرنامج',1),(2338,'program_goals','Program Goals',2),(2339,'program_graduates_&_enrolled','خريجي البرنامج والمقيدين',1),(2340,'program_graduates_&_enrolled','Program Graduates & Enrolled',2),(2341,'program_keyword','الكلمة المفتاحية للبرنامج',1),(2342,'program_keyword','Program Keyword',2),(2343,'program_learning_domain','مجال التعلم للبرنامج',1),(2344,'program_learning_domain','Program Learning Domain',2),(2345,'program_learning_outcome','مخرج تعلم البرنامج',1),(2346,'program_learning_outcome','Program Learning Outcome',2),(2347,'program_learning_outcome_mapped_to_survey','مخرجات التعلم للبرنامج المرتبطة باستبيان',1),(2348,'program_learning_outcome_mapped_to_survey','Program Learning Outcome Mapped to Survey',2),(2349,'program_learning_outcome_plos_to_be_displayed.','مخرجات تعلم للبرنامج ليتم عرضها',1),(2350,'program_learning_outcome_plos_to_be_displayed.','program learning outcome PLOs to be displayed.',2),(2351,'program_learning_outcomes','مخرجات التعلم للبرنامج',1),(2352,'program_learning_outcomes','Program Learning Outcomes',2),(2353,'program_linked_to_this_course','ربط البرنامج لهذه المادة الدراسية',1),(2354,'program_linked_to_this_course','Program Linked to this course',2),(2355,'program_management','إدارة البرنامج',1),(2356,'program_management','Program Management',2),(2357,'program_management_has_not_been_created!','لم يتم إنشاء إدارة البرنامج',1),(2358,'program_management_has_not_been_created!','Program Management has not been created!',2),(2359,'program_mapping_matrix','مصفوفة ربط البرنامج',1),(2360,'program_mapping_matrix','Program Mapping Matrix',2),(2361,'program_mission','رؤية البرنامج',1),(2362,'program_mission','Program Mission',2),(2363,'program_mission_keyword','الكلمة المفتاحية لرؤية البرنامج',1),(2364,'program_mission_keyword','Program mission keyword',2),(2365,'program_mission_keywords','الكلمات المفتاحية لرؤية البرنامج',1),(2366,'program_mission_keywords','Program Mission Keywords',2),(2367,'program_mission_keywords_to_be_displayed.','كلمات مفتاحية للبرنامج ليتم عرضها',1),(2368,'program_mission_keywords_to_be_displayed.','program mission Keywords to be displayed.',2),(2369,'program_mission_to_program_objectives','رؤية البرنامج مع مهام البرنامج',1),(2370,'program_mission_to_program_objectives','Program Mission to Program Objectives',2),(2371,'program_name','اسم البرنامج',1),(2372,'program_name','Program Name',2),(2373,'program_objactives_to_be_displayed.','غايات البرنامج ليتم عرضها',1),(2374,'program_objactives_to_be_displayed.','program objactives to be displayed.',2),(2375,'program_objective','غاية البرنامج',1),(2376,'program_objective','Program Objective',2),(2377,'program_objective_keywords','الكلمات المفتاحية لغاية البرنامج',1),(2378,'program_objective_keywords','Program Objective Keywords',2),(2379,'program_objective_keywords_to_be_displayed.','الكلة المفتاحية لغاية البرنامج ليتم عرضها',1),(2380,'program_objective_keywords_to_be_displayed.','program objective keywords to be displayed.',2),(2381,'program_objective_to_be_displayed.','غاية البرنامج ليتم عرضها',1),(2382,'program_objective_to_be_displayed.','program objective to be displayed.',2),(2383,'program_objectives','غايات البرنامج',1),(2384,'program_objectives','Program Objectives',2),(2385,'program_objectives_to_be_displayed.','غايات البرنام ليت عرضها',1),(2386,'program_objectives_to_be_displayed.','program objectives to be displayed.',2),(2387,'program_outcome','مخرجات البرنامج',1),(2388,'program_outcome','Program Outcome',2),(2389,'program_performance','أداء البرنامج',1),(2390,'program_performance','Program Performance',2),(2391,'program_plan','خطة البرنامج',1),(2392,'program_plan','Program Plan',2),(2393,'program_report','تقرير البرنامج',1),(2394,'program_report','Program Report',2),(2395,'program_report_cover','غلاف تقرير البرنامج',1),(2396,'program_report_cover','Program Report Cover',2),(2397,'program_specification_and_report','مواصفات وتقارير البرنامج',1),(2398,'program_specification_and_report','Program Specification and Report',2),(2399,'program_specification_cover','غلاف خصائص البرنامج',1),(2400,'program_specification_cover','Program Specification Cover',2),(2401,'program_specifications_and_report','مواصفات وتقارير البرنامج',1),(2402,'program_specifications_and_report','Program Specifications and Report',2),(2403,'program_specifications_and_reports','مواصفات وتقارير البرنامج',1),(2404,'program_specifications_and_reports','Program Specifications and Reports',2),(2405,'program_tree','شجرة البرامج',1),(2406,'program_tree','Program Tree',2),(2407,'program_tree_chart','مخطط شجرة البرنامج',1),(2408,'program_tree_chart','Program Tree Chart',2),(2409,'programmatic','برامجي',1),(2410,'programmatic','Programmatic',2),(2411,'programs','البرامج',1),(2412,'programs','Programs',2),(2413,'programs_accreditation','إعتماد البرامج',1),(2414,'programs_accreditation','Programs Accreditation',2),(2415,'programs_in','برنامج في',1),(2416,'programs_in','programs in',2),(2417,'programs_of','برامج',1),(2418,'programs_of','Programs of',2),(2419,'progress','التقدم',1),(2420,'progress','Progress',2),(2421,'progress_must_be_equal_or_greater_than_zero','يجب أن تكون قيمة التقدم مساوية أو أكبر من 0',1),(2422,'progress_must_be_equal_or_greater_than_zero','Progress must be Equal or Greater than 0',2),(2423,'progress_must_be_equal_or_less_than_100','يجب أن تكون قيمة التقدم مساوية أو أقل من 100',1),(2424,'progress_must_be_equal_or_less_than_100','Progress must be Equal or Less than 100',2),(2425,'project','مشروع',1),(2426,'project','Project',2),(2427,'project_grading_guideline','القواعد الإرشادية لعلامات المشروع',1),(2428,'project_grading_guideline','Project grading guideline',2),(2429,'project_name','اسم المشروع',1),(2430,'project_name','Project Name',2),(2431,'project_not_found','لم يتم العثور على المشروع',1),(2432,'project_not_found','Project not found',2),(2433,'project_removed_successfully','تم حذف المشروع بنجاح',1),(2434,'project_removed_successfully','Project removed successfully',2),(2435,'project_saved_successfully','تم حفظ المشروع بنجاح',1),(2436,'project_saved_successfully','Project Saved Successfully',2),(2437,'projects','المشاريع',1),(2438,'projects','Projects',2),(2439,'publication','النشر',1),(2440,'publication','Publication',2),(2441,'publication_count','عدد النشر',1),(2442,'publication_count','Publication Count',2),(2443,'publication_in_conference_proceedings','نشر وقائع المؤتمر',1),(2444,'publication_in_conference_proceedings','Publication in Conference Proceedings',2),(2445,'publication_in_isi_journals','النشر في مجلات ISI',1),(2446,'publication_in_isi_journals','Publication in ISI Journals',2),(2447,'publish_date','تاريخ النشر',1),(2448,'publish_date','Publish Date',2),(2449,'publish_type','نوع النشر',1),(2450,'publish_type','Publish Type',2),(2451,'published_in','النشر في',1),(2452,'published_in','Published In',2),(2453,'publisher','الناشر',1),(2454,'publisher','publisher',2),(2455,'push_to_aims','الارتباط مع AIMS',1),(2456,'push_to_aims','Push to AIMS',2),(2457,'push_to_aims_note','الارتباط مع NCAAA هي بوابة داخلية فعالة تسمح بنقل ملفات الاعتماد للهيئة الوطنية للاعتماد والتقييم الأكاديمي NCAAA بكل سهولة ويسر، تساعد هذه البوابة المؤسسة على فهم جميع متطلبات الاعتماد والإجراءات الرسمية المتعلقة به بطريقة إلكترونية عوضاً عن الطريقة التقليدية من خلال الورق.<\\br><\\br>وذلك لا يعني انقطاع التعاون بين المؤسسة وهيئة الاعتماد ، إذ أن هيئة الاعتماد يتوجب عليها أخذ زمام الأمور بالوقت المناسب من مسؤولي المؤسسة واتخاذ التدابير اللازمة خطوة بخطوة لتأكيد طلب الاعتماد الخاصة بالمؤسسة.',1),(2458,'push_to_aims_note','The push to AIMS internal portal is a great leap forward allowing users to effectively transmit the accreditation portfolio to the NCAAA (National Commission for Academic Accreditation and Assessment) securely. This minimizes collaboration between NCAAA and the institution as this portal has learned all requirements and formal procedures to successfully transmit the accreditation portfolio that is electronic prepared and organized from the accreditation module. As the assigned individual to transmit the accreditation portfolio to NCAAA you should collaborate with an institution to take the necessary initiative at the appropriate time and take great caution before confirming the submission.',2),(2459,'q','س',1),(2460,'q','Q',2),(2461,'qms_course_management','إدارة المادة الدراسية',1),(2462,'qms_course_management','Course Management',2),(2463,'qms_program_management','إدارة البرنامج',1),(2464,'qms_program_management','Program Management',2),(2465,'qualitative','نوعي',1),(2466,'qualitative','Qualitative',2),(2467,'qualitative_kpi','مؤشر أداء نوعية',1),(2468,'qualitative_kpi','Qualitative KPI',2),(2469,'quality','الجودة',1),(2470,'quality','Quality',2),(2471,'quantitative','كمي',1),(2472,'quantitative','Quantitative',2),(2473,'quantitative_kpi','مؤشرات أداء كمية',1),(2474,'quantitative_kpi','Quantitative KPI',2),(2475,'quarter','ربع',1),(2476,'quarter','Quarter',2),(2477,'question','سؤال',1),(2478,'question','Question',2),(2479,'question_choices','خيارات السؤال',1),(2480,'question_choices','Question Choices',2),(2481,'question_note','ملاحظة على السؤال',1),(2482,'question_note','Question Note',2),(2483,'question_type','نوع السؤال',1),(2484,'question_type','Question Type',2),(2485,'questions','الأسئلة',1),(2486,'questions','Questions',2),(2487,'questions_saved_successfully','تم حفظ الأسئلة بنجاح',1),(2488,'questions_saved_successfully','Questions Saved Successfully',2),(2489,'rank','الرتبة',1),(2490,'rank','Rank',2),(2491,'rank_date','تاريخ الرتبة',1),(2492,'rank_date','Rank Date',2),(2493,'rate_added_successfully','تم إضافة النسبة بنجاح',1),(2494,'rate_added_successfully','Rate Added Successfully',2),(2495,'rate_must_be_larger_than_0','يجب أن تكون فيمة النسبة أكبر من 0',1),(2496,'rate_must_be_larger_than_0','Rate must be larger than 0',2),(2497,'rate_must_be_less_than_100','يجب أن تكون فيمة النسبة أقل من 100',1),(2498,'rate_must_be_less_than_100','Rate must be Less than 100',2),(2499,'rate_must_be_less_than_the_rates_of_each_form_type','يجب أن تكون قيمة النسبة أقل من النسب الخاصة بنوع النموذج',1),(2500,'rate_must_be_less_than_the_rates_of_each_form_type','Rate Must be Less than the Rates Of each Form Type',2),(2501,'rate_must_be_numeric','يجب أن تكون قسم النسبة رقم',1),(2502,'rate_must_be_numeric','Rate must be Numeric',2),(2503,'rate_percentage','النسبة',1),(2504,'rate_percentage','Rate Percentage',2),(2505,'rate_value','قيمة النسبة',1),(2506,'rate_value','Rate Value',2),(2507,'ratio_of_programs_in','النسبة للبرنامج في',1),(2508,'ratio_of_programs_in','Ratio of programs in',2),(2509,'read_more','قراءة المزيد',1),(2510,'read_more','Read More',2),(2511,'recommendation','التوصيات',1),(2512,'recommendation','Recommendation',2),(2513,'recommendation_deleted_successfully','تم حذف التوصية بنجاح',1),(2514,'recommendation_deleted_successfully','Recommendation deleted successfully',2),(2515,'recommendation_has_entered','تم إدخال التوصية',1),(2516,'recommendation_has_entered','recommendation has Entered',2),(2517,'recommendation_list','لائحة التوصية',1),(2518,'recommendation_list','Recommendation List',2),(2519,'recommendation_saved_successfully','تم حفظ التوصية بنجاح',1),(2520,'recommendation_saved_successfully','Recommendation Saved Successfully',2),(2521,'recommendation_type','نوع التوصية',1),(2522,'recommendation_type','Recommendation Type',2),(2523,'recommendation_types','أنواع التوصية',1),(2524,'recommendation_types','Recommendation Types',2),(2525,'recommendations','التوصيات',1),(2526,'recommendations','Recommendations',2),(2527,'recommendations_&_complaint','النصائح والشكاوي',1),(2528,'recommendations_&_complaint','Recommendations & Complaint',2),(2529,'record_has_entered','سجلات مدخلة.',1),(2530,'record_has_entered','records entered.',2),(2531,'refresh','Refresh',1),(2532,'refresh','Refresh',2),(2533,'release_date','تاريخ النشر',1),(2534,'release_date','Release Date',2),(2535,'reload','تحديث',1),(2536,'reload','Reload',2),(2537,'remember_me','تذكرني',1),(2538,'remember_me','Remember me',2),(2539,'remind','تذكير',1),(2540,'remind','Remind',2),(2541,'remove','حذف',1),(2542,'remove','Remove',2),(2543,'remove_offered_program','إزالة البرنامج المقدّم',1),(2544,'remove_offered_program','Remove Offered Program',2),(2545,'removing_this_keyword_will_destroy_all_its_existing_relationships','حذف هذه الكلمة المفتاحية قد يؤدي إلى تدمير إحدى العلاقات الموجودة',1),(2546,'removing_this_keyword_will_destroy_all_its_existing_relationships','Removing this keyword will destroy all its existing relationships',2),(2547,'report','تقرير',1),(2548,'report','Report',2),(2549,'report_attachment','التقرير المرفق',1),(2550,'report_attachment','Report Attachment',2),(2551,'report_deleted_successfully','تم حذف التقرير بنجاح',1),(2552,'report_deleted_successfully','Report deleted successfully',2),(2553,'report_details','تفاصيل التقرير',1),(2554,'report_details','Report Details',2),(2555,'report_for','تقرير ل',1),(2556,'report_for','Report For',2),(2557,'report_name','اسم التقرير',1),(2558,'report_name','Report Name',2),(2559,'report_saved_successfully','تم حفظ التقرير بنجاح',1),(2560,'report_saved_successfully','Report Saved Successfully',2),(2561,'report_text','نص التقرير',1),(2562,'report_text','Report Text',2),(2563,'report_title','عنوان التقرير',1),(2564,'report_title','Report Title',2),(2565,'reporting','تقارير',1),(2566,'reporting','Reporting',2),(2567,'reports','التقارير',1),(2568,'reports','Reports',2),(2569,'require_an_answer_to_this_question','هذا السؤال متطلب إجابتة',1),(2570,'require_an_answer_to_this_question','Require an answer to this Question',2),(2571,'required','مطلوب',1),(2572,'required','Required',2),(2573,'required_action_plan','خطة العمل مطلوبة',1),(2574,'required_action_plan','required Action Plan',2),(2575,'required_and_recommended_materials','المواد المطلوبة والمقترحة',1),(2576,'required_and_recommended_materials','Required and recommended materials',2),(2577,'required_email','مطلوب إدخال البريد الإلكتروني',1),(2578,'required_email','Required Email',2),(2579,'required_end_date','تاريخ الانتهاء مطلوب',1),(2580,'required_end_date','required End Date',2),(2581,'required_factor_abbreviation','عامل الاختصار مطلوب',1),(2582,'required_factor_abbreviation','Required Factor Abbreviation',2),(2583,'required_factor_title','اسم الاختصار مطلوب',1),(2584,'required_factor_title','Required Factor title',2),(2585,'required_field','حقل مطلوب',1),(2586,'required_field','Required Field',2),(2587,'required_fields_missing','حقل مطلوب مفقود',1),(2588,'required_fields_missing','Required Fields Missing',2),(2589,'required_filed','حقل مطلوب',1),(2590,'required_filed','Required Filed',2),(2591,'required_materials','المواد مطلوبة',1),(2592,'required_materials','Required Materials',2),(2593,'required_name','مطلوب الاسم',1),(2594,'required_name','Required Name',2),(2595,'required_password','مطلوب إدخال  كلمة السر',1),(2596,'required_password','Required Password',2),(2597,'required_project','المشروع مطلوب',1),(2598,'required_project','required Project',2),(2599,'required_question','السؤال مطلوب',1),(2600,'required_question','Required Question',2),(2601,'required_question_choice','مطلوب خياران السؤال',1),(2602,'required_question_choice','Required Question choice',2),(2603,'required_start_date','مطلوب تاريخ البدء',1),(2604,'required_start_date','required Start Date',2),(2605,'required_statement_abbreviation','اختصار البيانات مطلوب',1),(2606,'required_statement_abbreviation','Required Statement abbreviation',2),(2607,'required_statement_title','عنوان البيانات مطلوب',1),(2608,'required_statement_title','Required Statement Title',2),(2609,'required_title','الاسم مطلوب',1),(2610,'required_title','required Title',2),(2611,'required,_recommended_and_support_materials','مواد الدعمـ المقترحة والمطلوبة',1),(2612,'required,_recommended_and_support_materials','Required, recommended and support materials',2),(2613,'research','البحث',1),(2614,'research','Research',2),(2615,'research_budget','ميزانية البحث',1),(2616,'research_budget','Research Budget',2),(2617,'research_budget_actual_expenditure','النفقات الفعلية ليمزانية البحث',1),(2618,'research_budget_actual_expenditure','Research Budget Actual Expenditure',2),(2619,'research_budget_total_amount','المبلغ الفعلي لميزانية البحث',1),(2620,'research_budget_total_amount','Research Budget Total Amount',2),(2621,'research_center','مركز البحث',1),(2622,'research_center','Research Center',2),(2623,'research_number','رثم البحث',1),(2624,'research_number','Research Number',2),(2625,'research_paper','أوراق البحث',1),(2626,'research_paper','Research Paper',2),(2627,'research_statistics','إحصائيات البحث',1),(2628,'research_statistics','Research Statistics',2),(2629,'research_subject','موضوع البحث',1),(2630,'research_subject','Research Subject',2),(2631,'research_title','عنوان البحث',1),(2632,'research_title','Research Title',2),(2633,'researcher','الباحث',1),(2634,'researcher','Researcher',2),(2635,'researches','الأبحاث',1),(2636,'researches','Researches',2),(2637,'reset','إعادة تعيين',1),(2638,'reset','Reset',2),(2639,'reset_password','إعادة تعيين كلمة السر',1),(2640,'reset_password','Reset Password',2),(2641,'resources','المصادر',1),(2642,'resources','Resources',2),(2643,'respondent','المستجيب',1),(2644,'respondent','Respondent',2),(2645,'response','الإستجابة',1),(2646,'response','Response',2),(2647,'responsible','المسؤول',1),(2648,'responsible','Responsible',2),(2649,'restore','إستعادة',1),(2650,'restore','Restore',2),(2651,'result','النتائج',1),(2652,'result','Result',2),(2653,'result_based','استناد النتائج',1),(2654,'result_based','Result Based',2),(2655,'result_has_entered','نتائج تم إدخالها',1),(2656,'result_has_entered','result has Entered',2),(2657,'results','النتائج',1),(2658,'results','Results',2),(2659,'resume','الاستئناف',1),(2660,'resume','Resume',2),(2661,'review','مراجعة',1),(2662,'review','Review',2),(2663,'reviewer','المراجعين',1),(2664,'reviewer','Reviewer',2),(2665,'reviewer_already_selected','تم اختيار المراجع مسبقاً',1),(2666,'reviewer_already_selected','Reviewer already selected',2),(2667,'reviewer_area','منطقة المراجع',1),(2668,'reviewer_area','Reviewer Area',2),(2669,'reviewer_cv','السيرة الذاتية للمراجع',1),(2670,'reviewer_cv','Reviewer CV',2),(2671,'reviewer_cv_attachment','السيرة الذاتية المرفقة للمراجع',1),(2672,'reviewer_cv_attachment','Reviewer CV Attachment',2),(2673,'reviewer_cv_text','نص السيرة الذاتية للمراجع',1),(2674,'reviewer_cv_text','Reviewer CV Text',2),(2675,'reviewer_info','معلومات المراجع',1),(2676,'reviewer_info','Reviewer Info',2),(2677,'reviewer_information','معلومات المراجع',1),(2678,'reviewer_information','Reviewer Information',2),(2679,'reviewer_name','اسم المراجع',1),(2680,'reviewer_name','Reviewer Name',2),(2681,'reviewer_report','تقرير المراجع',1),(2682,'reviewer_report','Reviewer Report',2),(2683,'reviewer_report_attachment','تقرير المراجع المرفق',1),(2684,'reviewer_report_attachment','Reviewer Report Attachment',2),(2685,'reviewer_report_text','نص تقرير المراجع',1),(2686,'reviewer_report_text','Reviewer Report Text',2),(2687,'reviewers','المراجعين',1),(2688,'reviewers','Reviewers',2),(2689,'reviewers_list','لائحة المراجعين',1),(2690,'reviewers_list','Reviewers List',2),(2691,'risk','المخاطر',1),(2692,'risk','Risk',2),(2693,'risk_successfully_saved','تم حفظ المجازفة بنجاح',1),(2694,'risk_successfully_saved','Risk Successfully Saved',2),(2695,'risk_tab','علامة التبويب \" المخاطر \"',1),(2696,'risk_tab','Risk Tab',2),(2697,'risk_tabs','علامات التبويب المخاطر',1),(2698,'risk_tabs','Risk Tabs',2),(2699,'program_mission_to_be_displayed.','رؤية الجامعة ليتم عرضها',1),(2700,'program_mission_to_be_displayed.','Program mission to be displayed.',2),(2701,'role','المسمى الوظيفي',1),(2702,'role','Role',2),(2703,'role_name','اسم المسمى الوظيفي',1),(2704,'role_name','Role Name',2),(2705,'role_removed_successfully','تم حذف المسمى الوظيفي بنجاح',1),(2706,'role_removed_successfully','Role removed successfully',2),(2707,'role_successfully_saved','تم حفظ المسمى الوظيفي بنجاح',1),(2708,'role_successfully_saved','Role Successfully Saved',2),(2709,'role_type','نوع المسمى الوظيفي',1),(2710,'role_type','Role Type',2),(2711,'roles','المسميات الوظيفية',1),(2712,'roles','Roles',2),(2713,'run','تنفيذ',1),(2714,'run','Run',2),(2715,'save','حفظ',1),(2716,'save','Save',2),(2717,'save_&_finish','حفظ وإنهاء',1),(2718,'save_&_finish','Save & Finish',2),(2719,'save_&_go_next','حفظ والذهاب للتالي',1),(2720,'save_&_go_next','Save & Go Next',2),(2721,'save_&_next','حفظ والتالي',1),(2722,'save_&_next','Save & Next',2),(2723,'save_and_continue_later','حفظ والإكمال لاحقا',1),(2724,'save_and_continue_later','Save and Continue Later',2),(2725,'save_changes','حفظ التعديلات',1),(2726,'save_changes','Save Changes',2),(2727,'save_update','حفظ التحديثات',1),(2728,'save_update','Save Update',2),(2729,'saved_successfully','تم الحفظ بنجاح',1),(2730,'saved_successfully','Saved Successfully',2),(2731,'scale','مقياس',1),(2732,'scale','Scale',2),(2733,'scaled_scoring_performance','إنجازات الأداء المقاسة',1),(2734,'scaled_scoring_performance','Scaled Scoring Performance',2),(2735,'schedule','الجدول الزمني',1),(2736,'schedule','Schedule',2),(2737,'scheduled_tasks','المهمات المجدولة',1),(2738,'scheduled_tasks','Scheduled Tasks',2),(2739,'score','نقاط',1),(2740,'score','Score',2),(2741,'scripts','الوظائف',1),(2742,'scripts','Scripts',2),(2743,'search','بحث',1),(2744,'search','Search',2),(2745,'second_author','المؤلف الثاني',1),(2746,'second_author','Second Author',2),(2747,'section','شعبة',1),(2748,'section','Section',2),(2749,'section_#','رقم الشعبة',1),(2750,'section_#','Section #',2),(2751,'section_information','بيانات الشعبة',1),(2752,'section_information','Section Information',2),(2753,'section_name','اسم الشعبة',1),(2754,'section_name','Section Name',2),(2755,'section_no','رقم الشعبة',1),(2756,'section_no','Section no',2),(2757,'section_number','رقم الشعبة',1),(2758,'section_number','Section Number',2),(2759,'sections','الشعب',1),(2760,'sections','Sections',2),(2761,'sections_extra_info','بيانات إضافية عن الشعب',1),(2762,'sections_extra_info','Sections Extra info',2),(2763,'select','اختر',1),(2764,'select','Select',2),(2765,'select_a_college','اختر كلية',1),(2766,'select_a_college','Select a College',2),(2767,'select_a_standard','اختر معيار',1),(2768,'select_a_standard','Select a Standard',2),(2769,'select_agency','اختر هيئة',1),(2770,'select_agency','Select Agency',2),(2771,'select_all','اختيار الكل',1),(2772,'select_all','Select All',2),(2773,'select_at_least_one_learning_outcome','يرجى اختيار مخرج تعلم واحد على الأقل',1),(2774,'select_at_least_one_learning_outcome','Select at least one Learning Outcome',2),(2775,'select_kpi','اختر مؤشر أداء',1),(2776,'select_kpi','Select KPI',2),(2777,'select_level','اختر مستوى',1),(2778,'select_level','Select Level',2),(2779,'select_offered_program','اختر االبرنامج المقدّم',1),(2780,'select_offered_program','Select Offered Program',2),(2781,'select_one','اختر واحد',1),(2782,'select_one','Select One',2),(2783,'select_program','اختر برنامج',1),(2784,'select_program','Select Program',2),(2785,'select_survey','اختر استبيان',1),(2786,'select_survey','Select Survey',2),(2787,'select_the_recommendations','اختر إحدى التوصيات',1),(2788,'select_the_recommendations','Select the Recommendations',2),(2789,'selected','مختار',1),(2790,'selected','Selected',2),(2791,'self_study_report','تقرير الدراسة الذاتية',1),(2792,'self_study_report','Self Study Report',2),(2793,'self_study_reports','تقارير الدراسة الذاتية',1),(2794,'self_study_reports','Self Study Reports',2),(2795,'self-evaluation_scale_report_cover','غلاف تقرير مقياس التقييم الذاتي',1),(2796,'self-evaluation_scale_report_cover','Self-Evaluation Scale Report Cover',2),(2797,'self-study_report_cover','غلاف تقرير الدراسة الذاتية',1),(2798,'self-study_report_cover','Self-Study Report Cover',2),(2799,'semester','الفصل الدراسي',1),(2800,'semester','Semester',2),(2801,'semester_based','يعتمد على الفصل الدراسي',1),(2802,'semester_based','Semester Based',2),(2803,'semesters','الفصول الدراسية',1),(2804,'semesters','Semesters',2),(2805,'send','ارسال',1),(2806,'send','Send',2),(2807,'send_password_reset_link','إرسال رابط إعادة تعيين كلمة السر',1),(2808,'send_password_reset_link','SEND PASSWORD RESET LINK',2),(2809,'send_sms_when','ارسال رسالة قصير عندما',1),(2810,'send_sms_when','Send SMS when',2),(2811,'send_to_review','إرسال للمراجعة',1),(2812,'send_to_review','Send To Review',2),(2813,'sent_mail','البريد المرسل',1),(2814,'sent_mail','Sent mail',2),(2815,'serial_no.','الرقم التسلسلي',1),(2816,'serial_no.','Serial No.',2),(2817,'server_ip','خادم بروتوكول الانترنت',1),(2818,'server_ip','Server IP',2),(2819,'service','خدمة',1),(2820,'service','Service',2),(2821,'service_time','وقت الخدمة',1),(2822,'service_time','Service Time',2),(2823,'services','الخدمات',1),(2824,'services','Services',2),(2825,'set_due_date','إضافة موعد تسليم',1),(2826,'set_due_date','Set Due Date',2),(2827,'set_level_description','إضافة وصف المستوى',1),(2828,'set_level_description','Set Level Description',2),(2829,'set_plan','إضافة خطة',1),(2830,'set_plan','Set Plan',2),(2831,'set_rate','إضافة نسبة',1),(2832,'set_rate','Set Rate',2),(2833,'set_score','إضافة نقطة',1),(2834,'set_score','Set Score',2),(2835,'set_values','وضع قيم',1),(2836,'set_values','Set Values',2),(2837,'settings','الإعدادات',1),(2838,'settings','Settings',2),(2839,'settings_for_sms','إعدادات الرسائل القصيرة',1),(2840,'settings_for_sms','Settings for SMS',2),(2841,'settings_saved_successfully','تم حفظ الإعدادات بنجاح',1),(2842,'settings_saved_successfully','Settings Saved Successfully',2),(2843,'share','مشاركة',1),(2844,'share','Share',2),(2845,'show','عرض',1),(2846,'show','Show',2),(2847,'show_details','عرض التفاصيل',1),(2848,'show_details','Show Details',2),(2849,'show_more','عرض المزيد',1),(2850,'show_more','Show More',2),(2851,'sign_in','تسجيل الدخول',1),(2852,'sign_in','SIGN IN',2),(2853,'sign_in_to_your_account','الدخول الى حسابك الخاص',1),(2854,'sign_in_to_your_account','Sign In to your Account',2),(2855,'skill','المهارة',1),(2856,'skill','Skill',2),(2857,'skill,_question_or_dimension','مهارة، سؤال أو بعد',1),(2858,'skill,_question_or_dimension','Skill, Question or Dimension',2),(2859,'skills','المهارات',1),(2860,'skills','Skills',2),(2861,'skills,_questions_or_dimensions','المهارات، أسئلة أو الأبعاد',1),(2862,'skills,_questions_or_dimensions','Skills, Questions or Dimensions',2),(2863,'sms_notifications','إشعارات الرسائل القصيرة',1),(2864,'sms_notifications','SMS Notifications',2),(2865,'social','تواصل',1),(2866,'social','Social',2),(2867,'social_information','بيانات التواصل',1),(2868,'social_information','Social Information',2),(2869,'some_users_not_exist','بعض المستخدمين غير موجودين',1),(2870,'some_users_not_exist','Some users not exist',2),(2871,'something_went_wrong!','حصل خطأ ما !',1),(2872,'something_went_wrong!','SOMETHING WENT WRONG!',2),(2873,'sophisticated_competency','الكفاءات المتطورة',1),(2874,'sophisticated_competency','Sophisticated Competency',2),(2875,'source','المصدر',1),(2876,'source','Source',2),(2877,'source_deleted','تم حذف المصدر',1),(2878,'source_deleted','Source Deleted',2),(2879,'speciality','تخصص',1),(2880,'speciality','Speciality',2),(2881,'split_page_here','اقسم الصفحة هنا',1),(2882,'split_page_here','Split Page Here',2),(2883,'ssr_accreditation','إعتماد SSR',1),(2884,'ssr_accreditation','SSR Accreditation',2),(2885,'staff','العاملين',1),(2886,'staff','Staff',2),(2887,'stakeholder','أصحاب المصلحة',1),(2888,'stakeholder','Stakeholder',2),(2889,'standard','معيار',1),(2890,'standard','Standard',2),(2891,'standards','المعايير',1),(2892,'standards','Standards',2),(2893,'standards_overall_quality_metrics','المعايير العامة لمقاييس الجودة',1),(2894,'standards_overall_quality_metrics','Standards Overall Quality Metrics',2),(2895,'start','البداية',1),(2896,'start','Start',2),(2897,'start_date','تاريخ البدء',1),(2898,'start_date','Start Date',2),(2899,'start_date_must_be_before_end_date','تاريخ البدء يجب أن يكون قبل تاريخ الانتهاء',1),(2900,'start_date_must_be_before_end_date','Start Date must be before End Date',2),(2901,'start_date_must_be_less_than_end_date','تاريخ البدء يجب أن يكون أقل من تاريخ الانتهاء',1),(2902,'start_date_must_be_less_than_end_date','Start Date Must be Less than End Date',2),(2903,'start_date_must_be_on_or_after','تاريخ البدء يجب أن يكون بعد',1),(2904,'start_date_must_be_on_or_after','Start Date must be on or after',2),(2905,'start_date_must_be_on_or_before','تاريخ البدء يجب أن يكون قبل',1),(2906,'start_date_must_be_on_or_before','Start Date must be on or before',2),(2907,'start_date_must_equal_or_larger_than_the_current_date','تاريخ البدء يجب أن يكون مساوٍ أو أقل من التاريخ الحالي',1),(2908,'start_date_must_equal_or_larger_than_the_current_date','Start Date Must equal or Larger than the current date',2),(2909,'started_on_cs_and_cr','البدء ب CS و CR',1),(2910,'started_on_cs_and_cr','Started on CS and CR',2),(2911,'starting','البدء',1),(2912,'starting','Starting',2),(2913,'statements','البيانات',1),(2914,'statements','Statements',2),(2915,'statistics','الإحصاءات',1),(2916,'statistics','Statistics',2),(2917,'statistics_reports','تقارير الإحصائيات',1),(2918,'statistics_reports','Statistics Reports',2),(2919,'status','حالة',1),(2920,'status','Status',2),(2921,'status_name','اسم الحالة',1),(2922,'status_name','Status Name',2),(2923,'strategic_kpi','مؤشرات الأداء الرئيسية الاستراتيجية',1),(2924,'strategic_kpi','Strategic KPI',2),(2925,'strategic_kpis','مؤشرات الأداء الرئيسية الإستراتيجية',1),(2926,'strategic_kpis','Strategic KPIs',2),(2927,'strategic_kpis_benchmarks_report','تقرير مؤشرات مؤشرات الأداء الاستراتيجية',1),(2928,'strategic_kpis_benchmarks_report','Strategic KPIs Benchmarks Report',2),(2929,'strategic_kpis_details_report','تقرير تفاصيل مؤشرات الأداء الاستراتيجية',1),(2930,'strategic_kpis_details_report','Strategic KPIs Details Report',2),(2931,'strategic_kpis_trend_report','تقرير اتجاه مؤشرات الأداء الاستراتيجية',1),(2932,'strategic_kpis_trend_report','Strategic KPIs Trend Report',2),(2933,'strategic_objective','الغاية الاستراتيجية',1),(2934,'strategic_objective','Strategic Objective',2),(2935,'strategic_planning','التخطيط الإستراتيجي',1),(2936,'strategic_planning','Strategic Planning',2),(2937,'stream','مجرى',1),(2938,'stream','Stream',2),(2939,'string','ركيزة',1),(2940,'string','String',2),(2941,'student','الطالب',1),(2942,'student','Student',2),(2943,'student_assessment','تقييم الطلاب',1),(2944,'student_assessment','Student Assessment',2),(2945,'student_assessment_matrix','مصفوفة تقييم الطلاب',1),(2946,'student_assessment_matrix','Student Assessment Matrix',2),(2947,'student_assessment_rubric','تقييم موضوع الطلاب',1),(2948,'student_assessment_rubric','Student Assessment Rubric',2),(2949,'student_assessment_successfully_saved','تم حفظ تقييم الطلاب بنجاح',1),(2950,'student_assessment_successfully_saved','Student Assessment Successfully Saved',2),(2951,'student_count','عدد الطلاب',1),(2952,'student_count','Student Count',2),(2953,'student_name','اسم الطالب',1),(2954,'student_name','Student name',2),(2955,'student_portfolio','ملف الطالب',1),(2956,'student_portfolio','Student Portfolio',2),(2957,'student_portfolios','ملفات الطالب',1),(2958,'student_portfolios','Student Portfolios',2),(2959,'student_score','نقاط الطلاب',1),(2960,'student_score','Student Score',2),(2961,'student_status','حالة الطالب',1),(2962,'student_status','Student Status',2),(2963,'student_statuses','حالات الطالب',1),(2964,'student_statuses','Student Statuses',2),(2965,'student_work','عمل الطالب',1),(2966,'student_work','Student Work',2),(2967,'student_work_management','إدارة عمل الطلاب',1),(2968,'student_work_management','Student Work Management',2),(2969,'students','الطلاب',1),(2970,'students','Students',2),(2971,'students_are_founded','العثور على الطلاب',1),(2972,'students_are_founded','students are Founded',2),(2973,'students_assigned_to_this_course_section.','طالب مسجل في هذه الشعبة الدراسية',1),(2974,'students_assigned_to_this_course_section.','students assigned to this course section.',2),(2975,'students_count','عدد الطلاب',1),(2976,'students_count','Students Count',2),(2977,'students_scores','نقاط الطلاب',1),(2978,'students_scores','Students Scores',2),(2979,'sub_goals','الأهداف الفرعية',1),(2980,'sub_goals','Sub Goals',2),(2981,'sub_menu','القائمة الفرعية',1),(2982,'sub_menu','Sub Menu',2),(2983,'sub_objectives','الغايات الفرعية',1),(2984,'sub_objectives','Sub Objectives',2),(2985,'sub_projects','المشاريع الفرعية',1),(2986,'sub_projects','Sub Projects',2),(2987,'subject','العنوان',1),(2988,'subject','Subject',2),(2989,'subject_taught','موضوع التدريس',1),(2990,'subject_taught','Subject Taught',2),(2991,'submission_date','موعد التسليم',1),(2992,'submission_date','Submission Date',2),(2993,'submission_type','نوع التسليم',1),(2994,'submission_type','Submission Type',2),(2995,'submit','تسليم',1),(2996,'submit','Submit',2),(2997,'successful_delete','تم الحذف بنجاح',1),(2998,'successful_delete','Successful Delete',2),(2999,'successfully_added','تمت الإضافة بنجاح',1),(3000,'successfully_added','Successfully Added',2),(3001,'successfully_changed','تم التعديل بنجاح',1),(3002,'successfully_changed','Successfully Changed',2),(3003,'successfully_copied','تم النسخ بنجاح',1),(3004,'successfully_copied','Successfully Copied',2),(3005,'successfully_created','تم الإنشاء بنجاح',1),(3006,'successfully_created','Successfully Created',2),(3007,'successfully_deleted','تم الحذف بنجاح',1),(3008,'successfully_deleted','Successfully Deleted',2),(3009,'successfully_moved','تم النقل بنجاح',1),(3010,'successfully_moved','Successfully Moved',2),(3011,'successfully_reminded','تم التذكير بنجاح',1),(3012,'successfully_reminded','Successfully Reminded',2),(3013,'successfully_saved','تم الحفظ بنجاح',1),(3014,'successfully_saved','Successfully Saved',2),(3015,'successfully_sent','تم الإرسال بنجاح',1),(3016,'successfully_sent','Successfully Sent',2),(3017,'successfully_shared','تمت المشاركة بنجاح',1),(3018,'successfully_shared','Successfully Shared',2),(3019,'successfully_split','تم الفصل بنجاح',1),(3020,'successfully_split','Successfully Split',2),(3021,'successfully_update','تم التعديل بنجاح',1),(3022,'successfully_update','Successfully Update',2),(3023,'summary','الملخص',1),(3024,'summary','Summary',2),(3025,'supervision','الإشراف',1),(3026,'supervision','Supervision',2),(3027,'supervision_type','نوع الإشراف',1),(3028,'supervision_type','Supervision Type',2),(3029,'supervisions','الإشرافات',1),(3030,'supervisions','Supervisions',2),(3031,'supervisor','مشرف',1),(3032,'supervisor','Supervisor',2),(3033,'supervisor_name','اسم المشرف',1),(3034,'supervisor_name','Supervisor Name',2),(3035,'support_material_management','إدارة مادة الدعم',1),(3036,'support_material_management','Support Material Management',2),(3037,'support_materials','مواد الدعم',1),(3038,'support_materials','Support Materials',2),(3039,'support_party','حفل الدعم',1),(3040,'support_party','Support Party',2),(3041,'survey','استبيان',1),(3042,'survey','Survey',2),(3043,'survey_has_been_successfully_launched.','تم إطلاق الاستبيان بنجاح',1),(3044,'survey_has_been_successfully_launched.','Survey has been successfully launched.',2),(3045,'survey_results','نتائج الاستبيان',1),(3046,'survey_results','survey results',2),(3047,'survey_statement','بيانات الاستبيان',1),(3048,'survey_statement','Survey Statement',2),(3049,'survey_title','عنوان الاستبيان',1),(3050,'survey_title','Survey Title',2),(3051,'surveys','الاستبيانات',1),(3052,'surveys','Surveys',2),(3053,'surveys_preview','عرض الاستبيانات',1),(3054,'surveys_preview','Surveys Preview',2),(3055,'surveys_to_take','استبيانات يمكن أخذها',1),(3056,'surveys_to_take','Surveys to Take',2),(3057,'syllabus','مخطط المادة الدراسية',1),(3058,'syllabus','Syllabus',2),(3059,'syllabus_fields','حقول مخطط المادة الدراسية',1),(3060,'syllabus_fields','Syllabus Fields',2),(3061,'syllabus_management','إدارة مخطط المادة الدراسية',1),(3062,'syllabus_management','Syllabus Management',2),(3063,'system_groups','مجموعات النظام',1),(3064,'system_groups','System Groups',2),(3065,'table_2._preparatory_or_foundation_program','جدول 2. البرنامج التحضيري أو الأساسي',1),(3066,'table_2._preparatory_or_foundation_program','Table 2. Preparatory or Foundation Program',2),(3067,'table_3._program_data','جدول 3. بيانات البرنامج',1),(3068,'table_3._program_data','Table 3. Program Data',2),(3069,'table_4._summary_of_programs_teaching_staff','جدول 4. ملخص أعضاء هيئة التدريس للبرنامج',1),(3070,'table_4._summary_of_programs_teaching_staff','Table 4. Summary of Programs\' Teaching Staff',2),(3071,'table_5._numbers_of_graduates_in_the_most_recent_year','جدول 5. عدد الخريجين في السنة الأخيرة',1),(3072,'table_5._numbers_of_graduates_in_the_most_recent_year','Table 5. Numbers of Graduates in the Most Recent Year',2),(3073,'table_6._mode_of_instruction_–_student_enrollment','جدول 6. طريقة التدريس - تسجيل الطالب',1),(3074,'table_6._mode_of_instruction_–_student_enrollment','Table 6. Mode of Instruction – Student Enrollment',2),(3075,'table_7._mode_of_instruction_–_teaching_staff','جدول 7. طريقة التدريس - أعضاء الهيئة التدريسية',1),(3076,'table_7._mode_of_instruction_–_teaching_staff','Table 7. Mode of Instruction – Teaching Staff',2),(3077,'table_8._program_completion_rate/graduation_rate','جدول 8. معدل إنجاز البرنامج / معدل التخرج',1),(3078,'table_8._program_completion_rate/graduation_rate','Table 8. Program Completion Rate/Graduation Rate',2),(3079,'take_survey','أخذ الاستبيان',1),(3080,'take_survey','Take Survey',2),(3081,'target','الهدف',1),(3082,'target','Target',2),(3083,'target_benchmark','المؤشر الهدف',1),(3084,'target_benchmark','Target Benchmark',2),(3085,'task','مهمة',1),(3086,'task','Task',2),(3087,'task_text','نص المهمة',1),(3088,'task_text','Task Text',2),(3089,'task_title','عنوان المهمة',1),(3090,'task_title','Task Title',2),(3091,'tasks','المهام',1),(3092,'tasks','Tasks',2),(3093,'tasks_given','المهام المعطاة لي',1),(3094,'tasks_given','Tasks Given',2),(3095,'teachers','المدرسين',1),(3096,'teachers','Teachers',2),(3097,'teaching_material_management','إدارة المادة التعليمية',1),(3098,'teaching_material_management','Teaching Material Management',2),(3099,'teaching_materials','المواد التعليمية',1),(3100,'teaching_materials','Teaching Materials',2),(3101,'teaching_staff_count','عدد أعضاء الهيئة التدريسيو',1),(3102,'teaching_staff_count','Teaching Staff Count',2),(3103,'teaching_work_load','أعباء التدريس',1),(3104,'teaching_work_load','Teaching workload',2),(3105,'term','الفصل الدراسي',1),(3106,'term','Term',2),(3107,'test','تجربة',1),(3108,'test','Test',2),(3109,'text','نص',1),(3110,'text','Text',2),(3111,'thank_you!','شكراً لك',1),(3112,'thank_you!','THANK YOU!',2),(3113,'the_budget_value_can_not_be_less_than_0','قيمة المايزانية لا يجب أن تقل عن 0',1),(3114,'the_budget_value_can_not_be_less_than_0','the budget value can not be less than 0',2),(3115,'the_college_was_added_in_this_system',' الكلية تم إضافتها على النظام',1),(3116,'the_college_was_added_in_this_system','The College was added in this system',2),(3117,'the_component_review_is:','المحتوى المراجع',1),(3118,'the_component_review_is:','The component review is:',2),(3119,'the_conversation_has_been_marked_as_important.','تم وضع علامة \"مهمة\" على الرسالة',1),(3120,'the_conversation_has_been_marked_as_important.','The conversation has been marked as important.',2),(3121,'the_conversation_has_been_marked_as_not_important.','تم وضع علامة \"غير مهمة\" على الرسالة',1),(3122,'the_conversation_has_been_marked_as_not_important.','The conversation has been marked as not important.',2),(3123,'the_conversation_has_been_marked_as_unread.','تم وضع علامة \"غير مقروء\" على المحادثة',1),(3124,'the_conversation_has_been_marked_as_unread.','The conversation has been marked as unread.',2),(3125,'the_conversation_has_been_moved_to_the_inbox.','تم نقل المحادثة إلى البريد الوارد',1),(3126,'the_conversation_has_been_moved_to_the_inbox.','The conversation has been moved to the Inbox.',2),(3127,'the_conversation_has_been_moved_to_the_trash.','تم نقل المحادثة إلى المهملات',1),(3128,'the_conversation_has_been_moved_to_the_trash.','The conversation has been moved to the Trash.',2),(3129,'the_course_has_been_initiated','تم البدء بالمادة الدراسية',1),(3130,'the_course_has_been_initiated','The course has been initiated',2),(3131,'the_deadline_range_not_set,_please_contact_the_administration_to_get_a_new_deadline','لم يتم تحديد المدة الزمنية للموعد النهائي، يرجى التواصل مع المشرف لإضافة موعد نهائي جديد ',1),(3132,'the_deadline_range_not_set,_please_contact_the_administration_to_get_a_new_deadline','the deadline range not set, please contact the administration to get a new deadline',2),(3133,'the_group/s_has_been_deleted.','تم حذف المجموعة',1),(3134,'the_group/s_has_been_deleted.','The Group/s has been deleted.',2),(3135,'the_max_value_is','أعلى قيمة هي',1),(3136,'the_max_value_is','The max value is',2),(3137,'the_maximum_rate_value_is','أعلى نسبة قيمة عي',1),(3138,'the_maximum_rate_value_is','The maximum rate value is',2),(3139,'the_program_has_been_initiated','تم بدء البرنامج',1),(3140,'the_program_has_been_initiated','The program has been initiated',2),(3141,'the_responsible_users_of_this_branch:','الأشخاص المسؤولين عن هذا الفرع',1),(3142,'the_responsible_users_of_this_branch:','The responsible users of this branch:',2),(3143,'the_selected_course_does_not_have_the_selected_assessment_method','المادة الدراسية المتخارة لا تحتوي على طريقة تقييم',1),(3144,'the_selected_course_does_not_have_the_selected_assessment_method','The selected course does not have the selected assessment method',2),(3145,'the_selected_project_has_activities','المشروع المختار يمتلك  أنشطة',1),(3146,'the_selected_project_has_activities','the selected project has activities',2),(3147,'the_selected_project_has_sub-projects','المشرع المختار يحتوي على مشاريع فرعية',1),(3148,'the_selected_project_has_sub-projects','the selected project has sub-projects',2),(3149,'the_weight_value_should_be_between_1_and_10.','يجب أن يتراوح الوزن بين 1-10',1),(3150,'the_weight_value_should_be_between_1_and_10.','the weight value should be between 1 and 10.',2),(3151,'theme_settings_saved_successfully','تم حفظ تعديلات الموضوع بنجاح',1),(3152,'theme_settings_saved_successfully','Theme Settings Saved Successfully',2),(3153,'there_are_no','لا يوجد',1),(3154,'there_are_no','There Are No',2),(3155,'there_is','يوجد',1),(3156,'there_is','There is',2),(3157,'there_is_no','لا يوجد',1),(3158,'there_is_no','There is no',2),(3159,'these_inputs__have_results,_to_remove_it_make_sure_that_all_result_are_remove','هذا المدخل يحتوي على بيانات، للقيام بحفه قم بحذف جميع النتائج المرتبة به',1),(3160,'these_inputs__have_results,_to_remove_it_make_sure_that_all_result_are_remove','These Inputs  have results, to remove it make sure that all result are remove',2),(3161,'thesis_title','عنوان الأطروحة',1),(3162,'thesis_title','Thesis Title',2),(3163,'third_author','المؤلف الثالث',1),(3164,'third_author','Third Author',2),(3165,'this_assessment_method_not_used_in_this_course','طريقة التقييم هذه غير مستخدمة لهذه المادة الدراسية',1),(3166,'this_assessment_method_not_used_in_this_course','This Assessment Method not used in this Course',2),(3167,'this_assessor_has_been_selected_before','تم اختيار هذه المقيّم من قبل',1),(3168,'this_assessor_has_been_selected_before','This Assessor Has been Selected Before',2),(3169,'this_course_has_not_been_assessed_yet','هذه المادة الدراسية لم تقيّم بعد',1),(3170,'this_course_has_not_been_assessed_yet','This Course has not been assessed yet',2),(3171,'this_deadline_forms_has_data,_you_cant_remove_it','النماذج المرتبطة بهذا الموعد النهائي تحتوي على نتائج وبيانات لا يمكنك حذفها',1),(3172,'this_deadline_forms_has_data,_you_cant_remove_it','This Deadline Forms has data, You can\'t remove it',2),(3173,'this_field_is_required','هذا الحقل مطلوب',1),(3174,'this_field_is_required','This Field is Required',2),(3175,'this_field_must_be_a_number','هذا الجقل يجب أن يكون عدد',1),(3176,'this_field_must_be_a_number','This Field Must be a Number',2),(3177,'this_form_are_hidden,_please_select_another_form','تم إخفاء هذا النموذج، بيرجى اختيار نموذج آخر',1),(3178,'this_form_are_hidden,_please_select_another_form','This Form are Hidden, Please Select Another Form',2),(3179,'this_form_has_a_result,you_cant_add_any_input','يحتوي هذا النموذج على نتائج، لا يمكنك إضافة مدخل جديد عليه',1),(3180,'this_form_has_a_result,you_cant_add_any_input','This Form has a Result,You Can\'t Add any Input',2),(3181,'this_form_has_been_imported_successfully','تم تصدير النموذج بنجاح',1),(3182,'this_form_has_been_imported_successfully','This Form has been Imported Successfully',2),(3183,'this_form_has_been_reverted_successfully','تم استرجاع النموذج بنجاح',1),(3184,'this_form_has_been_reverted_successfully','This Form has been Reverted Successfully',2),(3185,'this_form_has_removed,_you_cant_see_it_anymore','تم حذف هذا النموذج، لا يمكن رؤيته بعد الآن',1),(3186,'this_form_has_removed,_you_cant_see_it_anymore','This Form has Removed, You Can\'t see it Anymore',2),(3187,'this_form_has_results,_to_remove_it_make_sure_that_all_result_are_remove','يحتوي هذا النموذج على نتائج، لحذفه قم بإزالة جميع النتائج المتعلقة بهذا النموذج',1),(3188,'this_form_has_results,_to_remove_it_make_sure_that_all_result_are_remove','This Form has results, to remove it make sure that all result are remove',2),(3189,'this_is_a_duplicate_kpi_and_strategy_entry.','مؤشر الأداء مكرر و إدخال الاستراتيجيات',1),(3190,'this_is_a_duplicate_kpi_and_strategy_entry.','This is a Duplicate KPI and Strategy entry.',2),(3191,'this_is_a_required_field','هذا الحقل مطلوب',1),(3192,'this_is_a_required_field','This is a Required Field',2),(3193,'this_process_will_take_a_few_moments','هذه العملية تحتاج إلى دقائق معدودة',1),(3194,'this_process_will_take_a_few_moments','This Process Will take a few Moments',2),(3195,'this_reviewer_has_been_selected_before','تم اختيار هذا المراجع من قبل',1),(3196,'this_reviewer_has_been_selected_before','This Reviewer Has been Selected Before',2),(3197,'this_section_is_not_available_in_this_semester','هذه الشعبة غير متاحة لهذا الفصل الدراسي',1),(3198,'this_section_is_not_available_in_this_semester','This Section is not Available in this Semester',2),(3199,'this_student_does_not_attend_this_course','هذا الطالب لم يحضر هذه المادة الدراسية',1),(3200,'this_student_does_not_attend_this_course','This student does not attend this course',2),(3201,'this_student_has_not_been_assessed_yet','لم يتم تقييم هذا الطالب بعد',1),(3202,'this_student_has_not_been_assessed_yet','This Student Has not been Assessed yet',2),(3203,'this_survey_does_not_have_a_\"factor_and_statement\"_question_type.','هذا الاستبيان لا يحتوي على سؤال من نواع \" عوامل وبيانات\"',1),(3204,'this_survey_does_not_have_a_\"factor_and_statement\"_question_type.','This survey does not have a \"Factor and Statement\" question type.',2),(3205,'this_survey_was_created_by_another_user_you_cannot_edit_the_layout_or_the_survey_structure','هذا الاستبيان تم إنشاؤه من قبل مستخدم آخر لا يمكنك التعديل عليها أو على بناء الاستبيان',1),(3206,'this_survey_was_created_by_another_user_you_cannot_edit_the_layout_or_the_survey_structure','This survey was created by another user you cannot edit the layout or the survey structure',2),(3207,'this_text_is_displayed_if_your_browser_does_not_support_the_canvas_html_element.','هذا النص سوف يظهر في حال أن المتصفح لا يدعم العناصر من نوع \" Canvas HTML \"',1),(3208,'this_text_is_displayed_if_your_browser_does_not_support_the_canvas_html_element.','This text is displayed if your browser does not support the Canvas HTML element.',2),(3209,'this_type_has_forms,_to_remove_it_make_sure_that_all_forms_&_result_are_remove','هذا النوع يحتوي على نماذج، للقيام بحذفه تأكد من حذف جميع النماذج الخاصة بهذا النوع ',1),(3210,'this_type_has_forms,_to_remove_it_make_sure_that_all_forms_&_result_are_remove','This type has forms, to remove it make sure that all forms & result are remove',2),(3211,'this_value_exceeds_the_remaining_action_plan_budget_balance_of','هذه القيمة تزيد عن قيمة ميزانية خطة العمل  المقترحة ب',1),(3212,'this_value_exceeds_the_remaining_action_plan_budget_balance_of','This value exceeds the remaining Action Plan budget balance of',2),(3213,'this_value_exceeds_the_remaining_objective_budget_balance_of','هذه القيمة تزيد عن قيمة ميزانية الغاية المقترحة ب',1),(3214,'this_value_exceeds_the_remaining_objective_budget_balance_of','This value exceeds the remaining Objective budget balance of',2),(3215,'this_value_is_less_than_the_sum_of_all_the_action_plans_budget_of','هذه القيمة أقل من مجموع ميزانية خطة العمل',1),(3216,'this_value_is_less_than_the_sum_of_all_the_action_plans_budget_of','This value is less than the sum of all the Action Plans\' budget of',2),(3217,'this_value_is_less_than_the_sum_of_all_the_projects_budget_of','هذه القيمة أقل من مجموع ميزانية المشاريع',1),(3218,'this_value_is_less_than_the_sum_of_all_the_projects_budget_of','This value is less than the sum of all the Projects\' budget of',2),(3219,'thises_title','عنوان الرسالة',1),(3220,'thises_title','Thises Title',2),(3221,'time_frame','المدة الزمنية',1),(3222,'time_frame','Time Frame',2),(3223,'title','العنوان',1),(3224,'title','Title',2),(3225,'to','إلى',1),(3226,'to','To',2),(3227,'to_another_server','لخادم آخر',1),(3228,'to_another_server','To Another Server',2),(3229,'to_be_alerted','ليتم تنبيهه',1),(3230,'to_be_alerted','To be Alerted',2),(3231,'to_date_greater_than_from_date','إلى تاريخ أكبر من التاريخ',1),(3232,'to_date_greater_than_from_date','To Date Greater than From Date',2),(3233,'to_google_account','لحساب جوجل',1),(3234,'to_google_account','To Google Account',2),(3235,'to_the_server','للخادم',1),(3236,'to_the_server','To the Server',2),(3237,'topic_title','عنوان الموضوع',1),(3238,'topic_title','Topic Title',2),(3239,'topics','المواضيع',1),(3240,'topics','Topics',2),(3241,'total_of_rate_type_must_be_less_than_100','مجموع نسب النوع يجب أن تكون أقل من 100',1),(3242,'total_of_rate_type_must_be_less_than_100','Total of Rate Type must be Less than 100',2),(3243,'total_performance','مجموع الأداء',1),(3244,'total_performance','Total Performance',2),(3245,'tracks','المسارات',1),(3246,'tracks','Tracks',2),(3247,'training_title','عنوان التدريب',1),(3248,'training_title','Training Title',2),(3249,'trainings','التدريبات',1),(3250,'trainings','Trainings',2),(3251,'translated_book','كتاب مترجم',1),(3252,'translated_book','Translated Book',2),(3253,'translation','الترجمة',1),(3254,'translation','Translation',2),(3255,'translations','الترجمات',1),(3256,'translations','Translations',2),(3257,'trash','المهملات',1),(3258,'trash','Trash',2),(3259,'tree','الشجرة',1),(3260,'tree','Tree',2),(3261,'trend','الإتجاه',1),(3262,'trend','Trend',2),(3263,'troubleshooting_tips','نصائح الكشف عن الأخطاء وإصلاحها',1),(3264,'troubleshooting_tips','Troubleshooting Tips',2),(3265,'twitter','تويتر',1),(3266,'twitter','Twitter',2),(3267,'type','النوع',1),(3268,'type','Type',2),(3269,'type_invalid!','نوع خاطئ',1),(3270,'type_invalid!','Type Invalid!',2),(3271,'type_name','اسم النوع',1),(3272,'type_name','Type Name',2),(3273,'type_rate','نسبة النوع',1),(3274,'type_rate','Type Rate',2),(3275,'type_settings','إعدادات النوع',1),(3276,'type_settings','Type Settings',2),(3277,'type_successfully_add','تم إضافة النوع بنجاح',1),(3278,'type_successfully_add','Type Successfully Added',2),(3279,'type_title','عنوان النوع',1),(3280,'type_title','Type Title',2),(3281,'type1:_analysis_based_on_all_quality_metrics_standards','النوع 1 : النوع يعتمد على جميع المعايير الخاصة بمعايير الجودة',1),(3282,'type1:_analysis_based_on_all_quality_metrics_standards','Type1: Analysis based on all Quality Metrics Standards',2),(3283,'types','الأنواع',1),(3284,'types','Types',2),(3285,'unacceptable','غير مقبول',1),(3286,'unacceptable','Unacceptable',2),(3287,'uncheck_all','الغاء تحديد الكل',1),(3288,'uncheck_all','Uncheck All',2),(3289,'under_maintenance','قيد الصيانة',1),(3290,'under_maintenance','Under Maintenance',2),(3291,'undergraduate','قيد التخرج',1),(3292,'undergraduate','Undergraduate',2),(3293,'unimportant','غير مهمة',1),(3294,'unimportant','Unimportant',2),(3295,'unique_field','تمت إضافته في تجسيل سابق',1),(3296,'unique_field','This has already been added in a record previously.',2),(3297,'unit','وحدة',1),(3298,'unit','Unit',2),(3299,'unit_goals','أهداف الوحدة',1),(3300,'unit_goals','Unit Goals',2),(3301,'unit_head','رئيس الوحدة',1),(3302,'unit_head','Unit Head',2),(3303,'unit_objectives','غاية الوحدة',1),(3304,'unit_objectives','Unit Objectives',2),(3305,'unit_type','نوع الوحدة',1),(3306,'unit_type','Unit Type',2),(3307,'units','الوحدات',1),(3308,'units','Units',2),(3309,'university','الجامعة',1),(3310,'university','University',2),(3311,'university_keyword','الكلمة المفتاحية للجامعة',1),(3312,'university_keyword','University Keyword',2),(3313,'university_logo','شعار الجامعة',1),(3314,'university_logo','University Logo',2),(3315,'university_mission','رؤية الجامعة',1),(3316,'university_mission','University Mission',2),(3317,'university_mission_keyword','الكلمة المفتاحية لرؤية الجامعة',1),(3318,'university_mission_keyword','University Mission Keyword',2),(3319,'university_mission_keywords','الكلمات المفتاحية لرؤية الجامعة',1),(3320,'university_mission_keywords','University Mission Keywords',2),(3321,'university_mission_keywords_to_be_displayed.','الكلمة المفتاحية لرؤية الجامعة ليتم عرضها',1),(3322,'university_mission_keywords_to_be_displayed.','university mission Keywords to be displayed.',2),(3323,'university_mission_title','عنوان رؤية الجامعة',1),(3324,'university_mission_title','University Mission Title',2),(3325,'university_mission_to_be_displayed.','رؤية الجامعة ليتم عرضها',1),(3326,'university_mission_to_be_displayed.','university mission to be displayed.',2),(3327,'university_mission_to_college_mission','رؤية الجامعة مع روؤية الكلية',1),(3328,'university_mission_to_college_mission','University Mission to College Mission',2),(3329,'university_performance','أداء الجامعة',1),(3330,'university_performance','University Performance',2),(3331,'university_report','تقرير الجامعة',1),(3332,'university_report','University Report',2),(3333,'unknown','غير معروف',1),(3334,'unknown','Unknown',2),(3335,'unlimited','غير محدد',1),(3336,'unlimited','Unlimited',2),(3337,'unread','غير مقروء',1),(3338,'unread','Unread',2),(3339,'update','تحديث',1),(3340,'update','Update',2),(3341,'update_info','تحديث البيانات',1),(3342,'update_info','Update Info',2),(3343,'user','مستخدم',1),(3344,'user','User',2),(3345,'user_contact_info','بيانات الاتصال للمستخدم',1),(3346,'user_contact_info','User Contact Info',2),(3347,'user_info','بيانات المستخدم',1),(3348,'user_info','User Info',2),(3349,'user_list','لائحة المستخدمين',1),(3350,'user_list','User List',2),(3351,'user_login_info','بيانات الدخول للمستخدم',1),(3352,'user_login_info','User Login Info',2),(3353,'user_name','اسم المستخدم',1),(3354,'user_name','User Name',2),(3355,'user_name_or_email','اسم المستخدم',1),(3356,'user_name_or_email','User Name or Email',2),(3357,'user_personal_info','البيانات الشخصية للمستخدم',1),(3358,'user_personal_info','User Personal Info',2),(3359,'user_removed_successfully','تم حذف المستخدم بنجاح',1),(3360,'user_removed_successfully','User Removed Successfully',2),(3361,'user_successfully_saved','تم حفظ المستخدم بنجاح',1),(3362,'user_successfully_saved','User Successfully Saved',2),(3363,'users','المستخدمين',1),(3364,'users','Users',2),(3365,'value','القيمة',1),(3366,'value','Value',2),(3367,'value_not_found','لم يتم العثور على قيمة',1),(3368,'value_not_found','Value not found',2),(3369,'value_removed_successfully','تم حذف القيمة بنجاح',1),(3370,'value_removed_successfully','Value removed successfully',2),(3371,'value_successfully_saved','تم حفظ القيمة بنجاح',1),(3372,'value_successfully_saved','Value Successfully Saved',2),(3373,'values','القيمة',1),(3374,'values','Values',2),(3375,'vice_rectorate','نائب إدارة الجامعة',1),(3376,'vice_rectorate','Vice Rectorate',2),(3377,'view','عرض',1),(3378,'view','View',2),(3379,'view_your_launced_surveys_and_edit_them','عرض الاستبيان الذي بدأت به وتعديله',1),(3380,'view_your_launced_surveys_and_edit_them','view your launced surveys and edit them',2),(3381,'vision','رسالة',1),(3382,'vision','Vision',2),(3383,'vision_&_mission','الرؤية والرسالة',1),(3384,'vision_&_mission','Vision & Mission',2),(3385,'vision_successfully_saved','تم حفظ الرسالة بنجاح',1),(3386,'vision_successfully_saved','Vision Successfully Saved',2),(3387,'visit_reviewer','زيارة مراجع',1),(3388,'visit_reviewer','Visit Reviewer',2),(3389,'visit_reviewers','زيارة المراجعين',1),(3390,'visit_reviewers','Visit Reviewers',2),(3391,'warning','تحذير',1),(3392,'warning','Warning',2),(3393,'warning,_changing_this_number_will_affect_the_saved_levels_in_each_kpi','ملاحظة: التعديل على هذا الرقم سوف يؤثر على مستويات مؤشرات الأداء المحفوظة',1),(3394,'warning,_changing_this_number_will_affect_the_saved_levels_in_each_kpi','Note: Changing the number of levels in the scale of the KPIs may affect previously inputted level descriptions in all KPIs.',2),(3395,'weve_almost_done!','تم الإنتهاء تقريبا !',1),(3396,'weve_almost_done!','WE\'VE ALMOST DONE!',2),(3397,'website','الموقع الإلكتروني',1),(3398,'website','Website',2),(3399,'weight','الوزن',1),(3400,'weight','Weight',2),(3401,'weights','الأوزان',1),(3402,'weights','Weights',2),(3403,'where_to_find','أماكن وجوده',1),(3404,'where_to_find','Where to find',2),(3405,'with_all_agencies','مع جميع الهيئات',1),(3406,'with_all_agencies','with all agencies',2),(3407,'within','ضمن',1),(3408,'within','within',2),(3409,'wizard_step_1','إعتماد: الخطوة الأولى',1),(3410,'wizard_step_1','Wizard Step 1',2),(3411,'wizard_step_2','إعتماد: الخطوة الثانية',1),(3412,'wizard_step_2','Wizard Step 2',2),(3413,'work','العمل',1),(3414,'work','Work',2),(3415,'work_list','لائحة العمل',1),(3416,'work_list','Work List',2),(3417,'work_successfully_saved','تم حفظ العمل بنجاح',1),(3418,'work_successfully_saved','Work Successfully Saved',2),(3419,'works','الأعمال',1),(3420,'works','Works',2),(3421,'works_removed_successfully','تم حذف العمل بنجاح',1),(3422,'works_removed_successfully','Works Removed Successfully',2),(3423,'writing','كتابة',1),(3424,'writing','Writing',2),(3425,'wrong_text_entered','النص المدخل خاطئ',1),(3426,'wrong_text_entered','Wrong Text Entered',2),(3427,'xls','Xls',1),(3428,'xls','Xls',2),(3429,'year','سنة',1),(3430,'year','Year',2),(3431,'year_is_not_valid','السنة خاطئة',1),(3432,'year_is_not_valid','Year is not valid',2),(3433,'years','السنوات',1),(3434,'years','Years',2),(3435,'yes','نعم',1),(3436,'yes','Yes',2),(3437,'yes_/_no','نعم / لا',1),(3438,'yes_/_no','Yes / No',2),(3439,'you_are_already_added_this_kpi!','قمت بإضافة مؤشر الأداء سابقاً',1),(3440,'you_are_already_added_this_kpi!','you are Already Added this KPI!',2),(3441,'you_are_independent_reviewer.','أنت مراجع مستقل',1),(3442,'you_are_independent_reviewer.','You are Independent Reviewer.',2),(3443,'you_can_not_change_the_rate_because_deadline_is_started','لا يمكنك تعديل النسبة لأن الموعد النهائي بدء',1),(3444,'you_can_not_change_the_rate_because_deadline_is_started','you Can\'t Change the Rate because Deadline is started',2),(3445,'you_can_not_change_this_to_a_blank_value','لا يمكنك ترك القيمة فارغة',1),(3446,'you_can_not_change_this_to_a_blank_value','You can\'t Change this to a Blank Value',2),(3447,'you_can_not_have_more_than_one_course_-_accreditations_per_semester.','لا يمكنك إضافة إعتماد مادة دراسية أكثر من مرة واحدة في الفصل الدراسي',1),(3448,'you_can_not_have_more_than_one_course_-_accreditations_per_semester.','You Can\'t have More than One Course - Accreditations per Semester.',2),(3449,'you_can_not_have_more_than_one_institutional_-_accreditations_per_year.','لا يمكنك الحصول على أكثر من إعتماد مؤسسي في السنة الواحدة',1),(3450,'you_can_not_have_more_than_one_institutional_-_accreditations_per_year.','You Can\'t have More than One Institutional - Accreditations per Year.',2),(3451,'you_can_not_have_more_than_one_program_-_accreditations_per_year.','لا يمكنك الحصول على أكثر من إعتماد برامجي في السنة',1),(3452,'you_can_not_have_more_than_one_program_-_accreditations_per_year.','You Can\'t have More than One Program - Accreditations per year.',2),(3453,'you_can_not_have_more_than_one_ssr_-_accreditations_per_2_year.','لا يمكنك الحصول على اعتماد SSR أكثر من مرة واحدة كل سنتين',1),(3454,'you_can_not_have_more_than_one_ssr_-_accreditations_per_2_year.','You can\'t have More than One SSR - Accreditations per 2 year.',2),(3455,'you_can_not_leave_this_to_a_blank_value','لا يمكنك ترك القيمة فارغة',1),(3456,'you_can_not_leave_this_to_a_blank_value','You Can\'t Leave this to a Blank Value',2),(3457,'you_can_search_for_a_faculty_member_by_his/her_name_or_email','يمكن البحث عن عضو الهيئة التدريسية من خلال الاسم أو البريد الإلكتروني',1),(3458,'you_can_search_for_a_faculty_member_by_his/her_name_or_email','You can search for a faculty member by his/her name or email',2),(3459,'you_can_search_for_a_student_by_his/her_name_or_email','يمكن البحث عن الطالب من خلال الاسم أو البريد الإلكتروني',1),(3460,'you_can_search_for_a_student_by_his/her_name_or_email','You can search for a student by his/her name or email',2),(3461,'you_cant_leave_it_empty','لا يمكنك ترك هذا الحقل فارغ',1),(3462,'you_cant_leave_it_empty','You Can\'t Leave It Empty',2),(3463,'you_dont_have_any_notifications','لا يوجد لديك اشعارات',1),(3464,'you_dont_have_any_notifications','You Don\'t have any Notifications',2),(3465,'you_have_already_answered_this_survey.','لقد قمت بالإجابة على هذا الاستبيان مسبقاً',1),(3466,'you_have_already_answered_this_survey.','You have Already Answered this Survey.',2),(3467,'you_have_no_evaluation_requests.','لا يوجد لديك أي طلبات تقييم',1),(3468,'you_have_no_evaluation_requests.','You have no Evaluation Requests.',2),(3469,'you_have_nothing_to_review','لا يوجد ما يحتاج المراجعغة',1),(3470,'you_have_nothing_to_review','You have Nothing to Review',2),(3471,'you_have_to_add_at_least_one_field.','يجب عليك إضافة حقل واحد على الأقل',1),(3472,'you_have_to_add_at_least_one_field.','You have to Add at Least One Field.',2),(3473,'you_have_to_enter_task','يجب  إدخال المهمة',1),(3474,'you_have_to_enter_task','You have to Enter Task',2),(3475,'you_have_to_enter_title','يجب إدخال  العنوان',1),(3476,'you_have_to_enter_title','You have to Enter Title',2),(3477,'you_have_to_select_user','يجب اختيار مستخدم',1),(3478,'you_have_to_select_user','You have to Select User',2),(3479,'you_must_add_at_least_one_form_input','يجب إضافة مدخل واحد على الأقل',1),(3480,'you_must_add_at_least_one_form_input','You must Add at Least One Form Input',2),(3481,'you_must_fill_rate_input','يجب تعبئة المدخل الخاص بالنسبة',1),(3482,'you_must_fill_rate_input','You must Fill Rate Input',2),(3483,'you_will_lose_your_changes_when_closing_the_form_without_saving.<\\br><\\br>are_you_sure_you_want_to_continue?','سوف تخسر جميع التعديلات الخاصة بك إذا لم تقم بحفظها. </br></br>\nهل أنت متأكد من المتابعة',1),(3484,'you_will_lose_your_changes_when_closing_the_form_without_saving.<\\br><\\br>are_you_sure_you_want_to_continue?','You will Loose your Changes when Closing the Form Without Saving.<\\br><\\br>Are you sure you Want to Continue?',2),(3485,'your_link_is_inactive','الرابط الخاص بك غير نشط',1),(3486,'your_link_is_inactive','Your Link is inactive',2),(3487,'your_plan','خطتك',1),(3488,'your_plan','Your Plan',2),(3489,'male','Male',1),(3490,'male','Male',2),(3491,'female','Female',1),(3492,'female','Female',2),(3493,'first','First',1),(3494,'first','First',2),(3495,'second','Second',1),(3496,'second','Second',2),(3497,'third','Third',1),(3498,'third','Third',2),(3499,'fourth','Fourth',1),(3500,'fourth','Fourth',2),(3501,'fifth','Fifth',1),(3502,'fifth','Fifth',2),(3503,'sixth','Sixth',1),(3504,'sixth','Sixth',2),(3505,'cli','Cli',1),(3506,'cli','Cli',2),(3507,'job','Job',1),(3508,'job','Job',2),(3509,'one_time','One Time',1),(3510,'one_time','One Time',2),(3511,'daily','Daily',1),(3512,'daily','Daily',2),(3513,'weekly','Weekly',1),(3514,'weekly','Weekly',2),(3515,'monthly','Monthly',1),(3516,'monthly','Monthly',2),(3517,'owner','Owner',1),(3518,'owner','Owner',2),(3519,'date_released','Date Released',1),(3520,'date_released','Date Released',2);
/*!40000 ALTER TABLE `translation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit`
--

DROP TABLE IF EXISTS `unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unit` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `integration_id` bigint(20) NOT NULL DEFAULT '0',
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `name_en` varchar(255) NOT NULL DEFAULT '',
  `name_ar` varchar(255) NOT NULL DEFAULT '',
  `class_type` varchar(64) DEFAULT NULL,
  `is_academic` tinyint(1) NOT NULL DEFAULT '0',
  `vision_en` text,
  `vision_ar` text,
  `mission_en` text,
  `mission_ar` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit`
--

LOCK TABLES `unit` WRITE;
/*!40000 ALTER TABLE `unit` DISABLE KEYS */;
/*!40000 ALTER TABLE `unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit_goal`
--

DROP TABLE IF EXISTS `unit_goal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unit_goal` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `unit_id` bigint(20) DEFAULT NULL,
  `title_en` tinytext,
  `title_ar` tinytext,
  `is_deleted` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit_goal`
--

LOCK TABLES `unit_goal` WRITE;
/*!40000 ALTER TABLE `unit_goal` DISABLE KEYS */;
/*!40000 ALTER TABLE `unit_goal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit_log`
--

DROP TABLE IF EXISTS `unit_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unit_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `unit_id` bigint(20) NOT NULL,
  `year` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit_log`
--

LOCK TABLES `unit_log` WRITE;
/*!40000 ALTER TABLE `unit_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `unit_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit_objective`
--

DROP TABLE IF EXISTS `unit_objective`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unit_objective` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `unit_id` bigint(20) DEFAULT NULL,
  `title_en` tinytext,
  `title_ar` tinytext,
  `is_deleted` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit_objective`
--

LOCK TABLES `unit_objective` WRITE;
/*!40000 ALTER TABLE `unit_objective` DISABLE KEYS */;
/*!40000 ALTER TABLE `unit_objective` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `class_type` varchar(45) NOT NULL DEFAULT '',
  `integration_id` bigint(20) NOT NULL DEFAULT '0',
  `login_id` varchar(45) DEFAULT NULL,
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(45) NOT NULL DEFAULT '',
  `birth_date` date NOT NULL DEFAULT '2012-06-01',
  `last_login` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `avatar` varchar(255) NOT NULL DEFAULT '',
  `first_name` varchar(100) NOT NULL DEFAULT '',
  `last_name` varchar(100) NOT NULL DEFAULT '',
  `gender` tinyint(1) NOT NULL,
  `nationality` varchar(45) NOT NULL DEFAULT '',
  `phone` varchar(45) NOT NULL DEFAULT '',
  `fax_no` varchar(45) NOT NULL DEFAULT '',
  `office_no` varchar(45) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `token` varchar(128) DEFAULT '',
  `theme` varchar(45) DEFAULT 'ksu',
  `theme_fixed_navbar` tinyint(1) DEFAULT '0',
  `theme_fixed_menu` tinyint(1) DEFAULT '0',
  `theme_flip_menu` tinyint(1) DEFAULT '0',
  `about_me` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Orm_User_Staff',0,'','admin@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','0000-00-00','2017-06-10 15:13:15',1,'/assets/jadeer/img/avatar.png','Admin','Eaa',0,'','','','','','',NULL,0,0,0,'');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_alumni`
--

DROP TABLE IF EXISTS `user_alumni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_alumni` (
  `user_id` bigint(20) NOT NULL,
  `college_id` bigint(20) NOT NULL,
  `department_id` bigint(20) NOT NULL,
  `program_id` bigint(20) NOT NULL,
  `graduated` int(11) NOT NULL DEFAULT '0',
  `job_status` int(11) NOT NULL DEFAULT '0',
  `professional_category` int(11) NOT NULL DEFAULT '0',
  `activity` int(11) NOT NULL DEFAULT '0',
  `employer_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_alumni`
--

LOCK TABLES `user_alumni` WRITE;
/*!40000 ALTER TABLE `user_alumni` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_alumni` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_employer`
--

DROP TABLE IF EXISTS `user_employer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_employer` (
  `user_id` bigint(20) NOT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `employed_duration` int(11) NOT NULL DEFAULT '0',
  `employed_in` int(11) NOT NULL DEFAULT '0',
  `activity` int(11) NOT NULL DEFAULT '0',
  `college_id` bigint(20) NOT NULL DEFAULT '0',
  `department_id` bigint(20) NOT NULL DEFAULT '0',
  `program_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_employer`
--

LOCK TABLES `user_employer` WRITE;
/*!40000 ALTER TABLE `user_employer` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_employer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_faculty`
--

DROP TABLE IF EXISTS `user_faculty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_faculty` (
  `user_id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL DEFAULT '6',
  `college_id` bigint(20) DEFAULT NULL,
  `department_id` bigint(20) DEFAULT NULL,
  `program_id` bigint(20) DEFAULT NULL,
  `service_time` int(11) NOT NULL DEFAULT '1',
  `job_position` tinyint(1) NOT NULL DEFAULT '0',
  `academic_rank` int(11) NOT NULL DEFAULT '1',
  `general_specialty` varchar(255) DEFAULT NULL,
  `specific_specialty` varchar(255) DEFAULT NULL,
  `graduate_from` varchar(255) DEFAULT NULL,
  `degree` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_faculty`
--

LOCK TABLES `user_faculty` WRITE;
/*!40000 ALTER TABLE `user_faculty` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_faculty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_staff`
--

DROP TABLE IF EXISTS `user_staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_staff` (
  `user_id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL DEFAULT '8',
  `unit_id` bigint(20) DEFAULT NULL,
  `college_id` bigint(20) DEFAULT NULL,
  `department_id` bigint(20) DEFAULT NULL,
  `program_id` bigint(20) DEFAULT NULL,
  `service_time` int(11) NOT NULL DEFAULT '1',
  `job_position` tinyint(1) NOT NULL DEFAULT '0',
  `campus_id` bigint(20) DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_staff`
--

LOCK TABLES `user_staff` WRITE;
/*!40000 ALTER TABLE `user_staff` DISABLE KEYS */;
INSERT INTO `user_staff` VALUES (1,1,0,0,0,0,1,0,0);
/*!40000 ALTER TABLE `user_staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_student`
--

DROP TABLE IF EXISTS `user_student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_student` (
  `user_id` bigint(20) NOT NULL,
  `college_id` bigint(20) NOT NULL,
  `department_id` bigint(20) NOT NULL,
  `program_id` bigint(20) NOT NULL,
  `level_of_study` int(11) NOT NULL DEFAULT '1',
  `status_id` bigint(20) DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_student`
--

LOCK TABLES `user_student` WRITE;
/*!40000 ALTER TABLE `user_student` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_student` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-10 16:19:41
