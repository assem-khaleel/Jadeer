-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: jadeer_last
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.18.04.2

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_independent_reviewer`
--

LOCK TABLES `acc_independent_reviewer` WRITE;
/*!40000 ALTER TABLE `acc_independent_reviewer` DISABLE KEYS */;
INSERT INTO `acc_independent_reviewer` VALUES (1,'institution',0,25,'/files/Documents/2019/Institution/Accreditation/Review/Computer Scince program coordinator/CV-Computer Scince program coordinator.pdf','','<p>hgfhgfhdfghfhfsgdhdfh</p>','','');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_pre_visit_reviewer`
--

LOCK TABLES `acc_pre_visit_reviewer` WRITE;
/*!40000 ALTER TABLE `acc_pre_visit_reviewer` DISABLE KEYS */;
INSERT INTO `acc_pre_visit_reviewer` VALUES (1,'institution',0,22),(2,'program',5,20);
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
-- Table structure for table `ad_advice_topic`
--

DROP TABLE IF EXISTS `ad_advice_topic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_advice_topic` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `topic_ar` varchar(45) DEFAULT NULL,
  `topic_en` varchar(45) DEFAULT NULL,
  `user_id` varchar(45) NOT NULL,
  `program_id` varchar(45) NOT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_advice_topic`
--

LOCK TABLES `ad_advice_topic` WRITE;
/*!40000 ALTER TABLE `ad_advice_topic` DISABLE KEYS */;
INSERT INTO `ad_advice_topic` VALUES (1,'topic 1','topic 1','1','8',0,'2019-01-12 19:20:47'),(2,'topic 2','topic 2','1','8',0,'2019-01-12 19:20:54'),(3,'communication engineering topic','communication engineering topic','1','10',0,'2019-01-12 19:21:33'),(4,'communication engineering topic 3','communication engineering topic 3','1','10',0,'2019-01-12 19:21:42');
/*!40000 ALTER TABLE `ad_advice_topic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad_faculty_program`
--

DROP TABLE IF EXISTS `ad_faculty_program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_faculty_program` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `program_id` bigint(20) NOT NULL,
  `faculty_id` bigint(20) NOT NULL,
  `survey_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_faculty_program`
--

LOCK TABLES `ad_faculty_program` WRITE;
/*!40000 ALTER TABLE `ad_faculty_program` DISABLE KEYS */;
INSERT INTO `ad_faculty_program` VALUES (1,5,10,0),(2,5,11,0),(3,5,13,0);
/*!40000 ALTER TABLE `ad_faculty_program` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad_student_faculty`
--

DROP TABLE IF EXISTS `ad_student_faculty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_student_faculty` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) NOT NULL,
  `faculty_id` bigint(20) NOT NULL,
  `program_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_student_faculty`
--

LOCK TABLES `ad_student_faculty` WRITE;
/*!40000 ALTER TABLE `ad_student_faculty` DISABLE KEYS */;
INSERT INTO `ad_student_faculty` VALUES (3,2,10,5),(4,3,10,5),(5,4,11,5),(6,5,11,5),(7,2,13,5),(8,3,13,5),(9,4,13,5),(10,5,13,5);
/*!40000 ALTER TABLE `ad_student_faculty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad_survey`
--

DROP TABLE IF EXISTS `ad_survey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_survey` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `faculty_id` bigint(20) NOT NULL,
  `survey_id` bigint(20) NOT NULL,
  `survey_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_survey`
--

LOCK TABLES `ad_survey` WRITE;
/*!40000 ALTER TABLE `ad_survey` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_survey` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `al_action`
--

LOCK TABLES `al_action` WRITE;
/*!40000 ALTER TABLE `al_action` DISABLE KEYS */;
INSERT INTO `al_action` VALUES (1,1,'action one to take ','action one to take ','assem al jimzawi','assem al jimzawi','jordan time frame','jordan time frame');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `al_analysis`
--

LOCK TABLES `al_analysis` WRITE;
/*!40000 ALTER TABLE `al_analysis` DISABLE KEYS */;
INSERT INTO `al_analysis` VALUES (1,1,'<p>analysis to make this one is here</p>','<p>analysis to make this one is here</p>');
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
  `type_id` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `al_assessment_loop`
--

LOCK TABLES `al_assessment_loop` WRITE;
/*!40000 ALTER TABLE `al_assessment_loop` DISABLE KEYS */;
INSERT INTO `al_assessment_loop` VALUES (1,'Orm_Al_Assessment_Loop_Kpi',34,2,8,1,'{\"kpi_category_id\":\"1\"}',1,'2020-01-14',0),(3,'Orm_Al_Assessment_Loop_Custom',1,1,3,1,'[]',1,'2019-01-31',0),(4,'Orm_Al_Assessment_Loop_Objective',1,0,0,1,'[]',1,'2019-01-29',0),(5,'Orm_Al_Assessment_Loop_Clo',1,2,5,1,'{\"learning_domain\":\"1\",\"program_learning_outcome\":\"4\",\"course\":\"6\"}',1,'2019-01-26',1),(6,'Orm_Al_Assessment_Loop_Kpi',34,1,1,1,'{\"kpi_category_id\":\"1\"}',1,'2019-01-29',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `al_custom`
--

LOCK TABLES `al_custom` WRITE;
/*!40000 ALTER TABLE `al_custom` DISABLE KEYS */;
INSERT INTO `al_custom` VALUES (1,'assessment loop for press college','/files/Documents/2019/press_college_Saud_college/Assessment Loop/0.pdf','it\'s just special for college');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `al_measure`
--

LOCK TABLES `al_measure` WRITE;
/*!40000 ALTER TABLE `al_measure` DISABLE KEYS */;
INSERT INTO `al_measure` VALUES (1,1,'<p>measure to make it easy to go&nbsp;</p>','<p>measure to make it easy to go&nbsp;</p>');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `al_recommendation`
--

LOCK TABLES `al_recommendation` WRITE;
/*!40000 ALTER TABLE `al_recommendation` DISABLE KEYS */;
INSERT INTO `al_recommendation` VALUES (1,1,'<p>recommendation 1</p>','<p>recommendation 1</p>');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `al_result`
--

LOCK TABLES `al_result` WRITE;
/*!40000 ALTER TABLE `al_result` DISABLE KEYS */;
INSERT INTO `al_result` VALUES (1,1,'<p>result for all measures</p>','<p>result for all measures</p>');
/*!40000 ALTER TABLE `al_result` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_assessment_metric`
--

DROP TABLE IF EXISTS `am_assessment_metric`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_assessment_metric` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(45) NOT NULL,
  `semester_id` bigint(20) NOT NULL,
  `type` int(2) DEFAULT NULL,
  `level` int(2) NOT NULL,
  `target` float(8,2) NOT NULL,
  `name_ar` varchar(45) NOT NULL,
  `item_class` tinytext,
  `extra_data` text,
  `item_id` bigint(20) DEFAULT NULL,
  `college_id` bigint(20) NOT NULL,
  `department_id` bigint(20) NOT NULL,
  `program_id` bigint(20) NOT NULL,
  `weakness_en` text,
  `weakness_ar` text,
  `strength_en` text,
  `strength_ar` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_assessment_metric`
--

LOCK TABLES `am_assessment_metric` WRITE;
/*!40000 ALTER TABLE `am_assessment_metric` DISABLE KEYS */;
/*!40000 ALTER TABLE `am_assessment_metric` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_metric_item`
--

DROP TABLE IF EXISTS `am_metric_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_metric_item` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `component_ar` varchar(45) NOT NULL,
  `component_en` varchar(45) NOT NULL,
  `weight` float(8,2) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `high_score` float(8,2) NOT NULL,
  `average` float(8,2) NOT NULL,
  `result` float(8,2) NOT NULL,
  `assessment_metric_id` bigint(20) NOT NULL,
  `component_id` bigint(20) DEFAULT NULL,
  `component_type` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_metric_item`
--

LOCK TABLES `am_metric_item` WRITE;
/*!40000 ALTER TABLE `am_metric_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `am_metric_item` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `as_agency`
--

LOCK TABLES `as_agency` WRITE;
/*!40000 ALTER TABLE `as_agency` DISABLE KEYS */;
INSERT INTO `as_agency` VALUES (1,'NCAAA','NCAAA',5,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'ABET','ABET',1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,'AACSB','AACSB',5,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,'ACPE','ACPE',3,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,'JCI','JCI',3,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,'ASIIN','ASIIN',1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,'FCAAA','FCAAA',3,'2 years','0000-00-00 00:00:00','0000-00-00 00:00:00');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `as_agency_mapping`
--

LOCK TABLES `as_agency_mapping` WRITE;
/*!40000 ALTER TABLE `as_agency_mapping` DISABLE KEYS */;
INSERT INTO `as_agency_mapping` VALUES (1,1,6,'2019-01-11 23:12:31','0000-00-00 00:00:00'),(2,4,6,'2019-01-11 23:12:31','0000-00-00 00:00:00'),(3,3,6,'2019-01-11 23:12:31','0000-00-00 00:00:00'),(4,2,6,'2019-01-11 23:12:31','0000-00-00 00:00:00'),(5,1,1,'2019-01-11 23:12:47','0000-00-00 00:00:00'),(6,4,1,'2019-01-11 23:12:47','0000-00-00 00:00:00'),(7,3,1,'2019-01-11 23:12:47','0000-00-00 00:00:00'),(8,2,1,'2019-01-11 23:12:47','0000-00-00 00:00:00'),(9,1,2,'2019-01-11 23:13:05','0000-00-00 00:00:00'),(10,4,2,'2019-01-11 23:13:05','0000-00-00 00:00:00');
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
-- Table structure for table `c_committee`
--

DROP TABLE IF EXISTS `c_committee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_committee` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title_en` varchar(250) NOT NULL,
  `title_ar` varchar(250) NOT NULL,
  `description_en` text NOT NULL,
  `description_ar` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `type_id` bigint(20) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_committee`
--

LOCK TABLES `c_committee` WRITE;
/*!40000 ALTER TABLE `c_committee` DISABLE KEYS */;
INSERT INTO `c_committee` VALUES (1,'dddddddddddddd','dddddddddddddddddddddd','dddddddddddddddddddd','dddddddddddddddd','2019-01-13','2019-01-31',1,1,0),(2,'engineering committe','engineering committe','engineering committe','engineering committe','2019-01-14','2019-03-30',2,9,0);
/*!40000 ALTER TABLE `c_committee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_committee_member`
--

DROP TABLE IF EXISTS `c_committee_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_committee_member` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `committee_id` bigint(20) NOT NULL,
  `is_leader` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_committee_member`
--

LOCK TABLES `c_committee_member` WRITE;
/*!40000 ALTER TABLE `c_committee_member` DISABLE KEYS */;
INSERT INTO `c_committee_member` VALUES (1,11,1,1),(2,10,1,0),(3,15,1,0),(4,12,2,0),(5,15,2,0),(6,13,2,0),(7,17,2,0),(8,14,2,1);
/*!40000 ALTER TABLE `c_committee_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campus`
--

DROP TABLE IF EXISTS `campus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campus` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `integration_id` varchar(100) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `name_en` varchar(255) NOT NULL DEFAULT '',
  `name_ar` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campus`
--

LOCK TABLES `campus` WRITE;
/*!40000 ALTER TABLE `campus` DISABLE KEYS */;
INSERT INTO `campus` VALUES (1,'0',0,'KSU','جامعة الملك سعود'),(2,'0',0,'AL balqa applied university','جامعة البلقاء التطبيقية');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campus_college`
--

LOCK TABLES `campus_college` WRITE;
/*!40000 ALTER TABLE `campus_college` DISABLE KEYS */;
INSERT INTO `campus_college` VALUES (1,2,1),(2,2,2),(3,1,3),(4,1,4);
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
INSERT INTO `ci_sessions` VALUES ('hu3m255g49u2ua7qg81lg4309gtefb8j','127.0.0.1',1547121816,_binary '__ci_last_regenerate|i:1547121461;user_id|s:1:\"1\";semester_id|i:0;'),('4tn320rovroup4buroljp3gfoli8j2un','127.0.0.1',1547122156,_binary '__ci_last_regenerate|i:1547121817;user_id|s:1:\"1\";semester_id|s:1:\"1\";flash_message|s:18:\"Successfully Saved\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('0vgpt5lu1bguali9g6uan99ee3eaiat4','127.0.0.1',1547122449,_binary '__ci_last_regenerate|i:1547122157;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('uvc7ilc0uvjobr1e98qc2ivleg129vpp','127.0.0.1',1547122791,_binary '__ci_last_regenerate|i:1547122472;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('i6q8ljss8cfms7b6cpidu3p4lfd348c7','127.0.0.1',1547123103,_binary '__ci_last_regenerate|i:1547122803;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('jbas1qv0iapeegr621n2ek22ocl9skg2','127.0.0.1',1547123439,_binary '__ci_last_regenerate|i:1547123112;user_id|s:1:\"1\";semester_id|s:1:\"1\";flash_message|s:18:\"Successfully Saved\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('nmjikm5pft9a2m0ggbjd8a2l0np8h8ul','127.0.0.1',1547123896,_binary '__ci_last_regenerate|i:1547123439;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('0cpao5cvkss3tu0s25smpqpdj1fipeit','127.0.0.1',1547124218,_binary '__ci_last_regenerate|i:1547123909;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('e0ei9cltqblat507ck4nmuu601u8dqs2','127.0.0.1',1547124563,_binary '__ci_last_regenerate|i:1547124225;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('7u8so2ihacl2rvu11pfic2dh9bdcmcdv','127.0.0.1',1547126292,_binary '__ci_last_regenerate|i:1547124576;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('6k8367dk09ut7smusc2k2d0ssfqcah9j','127.0.0.1',1547129422,_binary '__ci_last_regenerate|i:1547129422;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('8n8gkuhrd49fs8124v059pe9caef5qmu','127.0.0.1',1547151468,_binary '__ci_last_regenerate|i:1547151187;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('vb2ccmafgs79cd36fb78entp3guasket','127.0.0.1',1547151855,_binary '__ci_last_regenerate|i:1547151506;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('oepkd836gmq01l76j124k1v5n1p84q7f','127.0.0.1',1547152397,_binary '__ci_last_regenerate|i:1547151878;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('d9p9njnatd5ic03k5mqfj5bb32pselnl','127.0.0.1',1547152685,_binary '__ci_last_regenerate|i:1547152410;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('4hum5knqkec1tg83lgm0qlvnnvdsv32g','127.0.0.1',1547153168,_binary '__ci_last_regenerate|i:1547152732;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('ariftp901mps6davg732580jo7aottf2','127.0.0.1',1547153504,_binary '__ci_last_regenerate|i:1547153182;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('3k1qvnjch9kk4p2cra7bckqhu8qq2t4j','127.0.0.1',1547154628,_binary '__ci_last_regenerate|i:1547153548;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('37tm4p1klbp80f8n7kp10kf8oujrf01p','127.0.0.1',1547155062,_binary '__ci_last_regenerate|i:1547154667;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('jiqcllu4kulotnn79j38nkhkl1qfvjcf','127.0.0.1',1547155570,_binary '__ci_last_regenerate|i:1547155089;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('q5evadbngbhl4hqfr777qs9shk18at16','127.0.0.1',1547156365,_binary '__ci_last_regenerate|i:1547155595;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('s5ib4a251t7okpls3h2hvo4uvfc4c1pc','127.0.0.1',1547216268,_binary '__ci_last_regenerate|i:1547216268;'),('ee7eqp36qvu1bklnbscmj4db72ts9h4a','127.0.0.1',1547216573,_binary '__ci_last_regenerate|i:1547216269;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('1hp8mcb324avgthjs8kfk02qso54tv64','127.0.0.1',1547217902,_binary '__ci_last_regenerate|i:1547216624;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('u21mjg7rp8gs6g1ajnq98glt5th75g7r','127.0.0.1',1547218293,_binary '__ci_last_regenerate|i:1547217955;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('dmknfh0ebeia89969ro0v22hvuu18h3u','127.0.0.1',1547218569,_binary '__ci_last_regenerate|i:1547218295;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('6agur7di87j82uj7nu6eakhvts39hjnl','127.0.0.1',1547222408,_binary '__ci_last_regenerate|i:1547218606;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('osbcffcomjo2v0rkaodfoids7vele605','127.0.0.1',1547222991,_binary '__ci_last_regenerate|i:1547222437;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('b8tu1uf32cg48d04fbgeov8odt4l9ff0','127.0.0.1',1547223300,_binary '__ci_last_regenerate|i:1547223028;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('0jp2juj9ps3rrlmh3pcn0hqjinr6757l','127.0.0.1',1547223618,_binary '__ci_last_regenerate|i:1547223332;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('cbjkq1cgo18ren2i9iedb08pmqq85ec2','127.0.0.1',1547223988,_binary '__ci_last_regenerate|i:1547223652;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('nnmnaehkro87mt6pto1kbl1or42nbg9f','127.0.0.1',1547224127,_binary '__ci_last_regenerate|i:1547223991;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('5m7v1k2kcdied4bkgaao12fvpbhsisgb','127.0.0.1',1547240301,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547239912;semester_id|s:1:\"1\";'),('jibe9d2onikm90dv5i4rpu8lgoj81qs0','127.0.0.1',1547240655,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547240310;semester_id|s:1:\"1\";'),('mvs11re97mh4ger1rm465q8dreblh2fm','127.0.0.1',1547240963,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547240663;semester_id|s:1:\"1\";'),('oo009r5pu5enoc93qtc9tkjp5oqkq2bd','127.0.0.1',1547241492,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547240994;semester_id|s:1:\"1\";'),('v1niotbl0boak0up8s19irk6gcve5bkf','127.0.0.1',1547241803,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547241496;semester_id|s:1:\"1\";'),('pgju3s1d3565v51ma77fuso1pb683ru6','127.0.0.1',1547242204,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547241854;semester_id|s:1:\"1\";flash_message|s:23:\"Role Successfully Saved\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('nrhbe57csmiap0g8l5u3kuki9vvuhal6','127.0.0.1',1547246202,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547242205;semester_id|s:1:\"1\";'),('qbtltn0qla5loqicv5cn36kfjgd877rj','127.0.0.1',1547246510,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547246205;semester_id|s:1:\"1\";'),('mv6art66vkvq96kasgrfneiq9v2g3jm7','127.0.0.1',1547247163,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547246514;semester_id|s:1:\"1\";'),('mmm6nf5bo2a0qij0ie0j6gi1v8el6vi2','127.0.0.1',1547247682,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547247205;semester_id|s:1:\"1\";'),('cf4qvgq5n6tntto0lq892t2f6hruj6ke','127.0.0.1',1547248213,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547247736;semester_id|s:1:\"1\";'),('leipfjgva0k0lio9rcij0tv251hlda9m','127.0.0.1',1547248982,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547248238;semester_id|s:1:\"1\";'),('ice70b602fsvos3l344r28grr0ik1nun','127.0.0.1',1547249349,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547248987;semester_id|s:1:\"1\";'),('tlleskdl6jq9bp1ksh3kf6p9go6qnivh','127.0.0.1',1547250113,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547249354;semester_id|s:1:\"1\";'),('g23ah8fuqo2vdn8315f0dlk2d1qhsepc','127.0.0.1',1547250420,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547250117;semester_id|s:1:\"1\";'),('3n7hncvntl7a84nqmqussadvm1bb2tpk','127.0.0.1',1547254392,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547250421;semester_id|s:1:\"1\";'),('11iehh1a86jljpb33irtnj0cea1dsrao','127.0.0.1',1547257733,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547254392;semester_id|s:1:\"1\";'),('ln8ki2cog4ldabv5fc8bih976jbvhhtm','127.0.0.1',1547258078,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547257778;semester_id|s:1:\"1\";'),('biv4oajgeoti391m6cn6s87aj9fvgf90','127.0.0.1',1547258652,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547258086;semester_id|s:1:\"1\";'),('525d6njpt2itpnfob31njkbjta638rao','127.0.0.1',1547258982,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547258675;semester_id|s:1:\"1\";'),('8gf6ln6hvelgahe3vveifp9gtliftdtl','127.0.0.1',1547259406,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547258991;semester_id|s:1:\"1\";'),('na2mrtro9e0c56tsli8undsmobloonnb','127.0.0.1',1547260626,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547259458;semester_id|s:1:\"1\";'),('lkb4d3l3id2pojpkhk94h58ee68tj2cp','127.0.0.1',1547261351,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547260646;semester_id|s:1:\"1\";'),('o5b9cf30qnnf51rac2l2qgos8vhb8pop','127.0.0.1',1547261716,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547261361;semester_id|s:1:\"1\";'),('j465ad47fchgoajpea8utqbkobfq788c','127.0.0.1',1547262292,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547261717;semester_id|s:1:\"1\";'),('aphaac5mmm3vt7gkvvhevgjrgg5tuvtm','127.0.0.1',1547262677,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547262299;semester_id|s:1:\"1\";'),('4usv03jq2sm8adfp3054cm4qt1iljvu9','127.0.0.1',1547264007,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547262703;semester_id|s:1:\"1\";'),('qaq2hql6cdiks1kbrb1615s3oh78358h','127.0.0.1',1547300418,_binary '__ci_last_regenerate|i:1547299879;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('35492dukuk1b1o4ki0paufmiul49qs4o','127.0.0.1',1547300801,_binary '__ci_last_regenerate|i:1547300465;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('76evi58eg7b52eqk7odal9sgmep0podh','127.0.0.1',1547301140,_binary '__ci_last_regenerate|i:1547300838;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('bkqg28tbdf19g0d39lno5acurl1u4mb4','127.0.0.1',1547301751,_binary '__ci_last_regenerate|i:1547301140;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('v7n2busbekuq54horj5vik09mmf8avqs','127.0.0.1',1547301777,_binary '__ci_last_regenerate|i:1547301757;user_id|s:2:\"20\";semester_id|s:1:\"1\";'),('d13l0c5gv9v2e21glpbpbrc53sbli3fk','127.0.0.1',1547313406,_binary '__ci_last_regenerate|i:1547313083;user_id|s:2:\"20\";semester_id|s:1:\"1\";flash_message|s:20:\"Successfully Created\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('j5lgs7611iv78qnjp1pjcjg93a39l2vj','127.0.0.1',1547313937,_binary '__ci_last_regenerate|i:1547313406;user_id|s:2:\"20\";semester_id|s:1:\"1\";'),('dq9gtnrprgm1fpoogl6irfc86h44h2oh','127.0.0.1',1547314868,_binary '__ci_last_regenerate|i:1547314180;user_id|s:2:\"18\";semester_id|s:1:\"1\";'),('5ind45fa4bo8ehf0pndj3idup6m6lhts','127.0.0.1',1547315333,_binary '__ci_last_regenerate|i:1547314888;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('ssrgnjikt4rat1h4pfdut40ge64s50sd','127.0.0.1',1547315711,_binary '__ci_last_regenerate|i:1547315347;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('l54a16mujvp16gj7b8mjmu1asn19gu59','127.0.0.1',1547316610,_binary '__ci_last_regenerate|i:1547315770;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('p3gi5v9o7jncsuqq73oevlj2qhbiqn4o','127.0.0.1',1547316916,_binary '__ci_last_regenerate|i:1547316611;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('ihl74cmeft6fp92lpunb3lqntiu2rc93','127.0.0.1',1547317553,_binary '__ci_last_regenerate|i:1547316985;user_id|s:2:\"12\";semester_id|s:1:\"1\";'),('v08upmficua2sbb8h2k9dj1kikstn5kh','127.0.0.1',1547317886,_binary '__ci_last_regenerate|i:1547317565;user_id|s:2:\"12\";semester_id|s:1:\"1\";flash_message|s:18:\"Successfully Saved\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:1;'),('eeiv0dhuagvvci58k3ajos3qlhu39rus','127.0.0.1',1547318608,_binary '__ci_last_regenerate|i:1547317886;user_id|s:2:\"12\";semester_id|s:1:\"1\";'),('0l4updes28r6vhemovhfvmfqroq38dqe','127.0.0.1',1547318923,_binary '__ci_last_regenerate|i:1547318621;user_id|s:2:\"12\";semester_id|s:1:\"1\";flash_message|s:16:\"Quiz has Started\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('f9ruraofkpd1rh5l3rctqauak89q7i8b','127.0.0.1',1547319631,_binary '__ci_last_regenerate|i:1547318979;user_id|s:1:\"3\";semester_id|s:1:\"1\";'),('depshmrd25l1l7l1gh9ec0edh0rqcakf','127.0.0.1',1547320043,_binary '__ci_last_regenerate|i:1547319724;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('ndjn38a6velkalhqlg9scigieje9e8rj','127.0.0.1',1547320768,_binary '__ci_last_regenerate|i:1547320052;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('fl5jr2heqjobaoik09hgiaobmr7glj73','127.0.0.1',1547321103,_binary '__ci_last_regenerate|i:1547320798;user_id|s:1:\"1\";semester_id|s:1:\"1\";flash_message|s:20:\"Successfully Deleted\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"old\";}flash_status|s:7:\"success\";flash_keep|b:1;'),('24l15anjfpo23f5lkkogtudk1cj762gs','127.0.0.1',1547321421,_binary '__ci_last_regenerate|i:1547321103;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('rks14s4j60a9c8tgr58dt36ungpf56au','127.0.0.1',1547321891,_binary '__ci_last_regenerate|i:1547321427;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('hp16ce2nm1f1m5fb7einolohnuvst3n4','127.0.0.1',1547322236,_binary '__ci_last_regenerate|i:1547321917;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('e6c15o3kpe7fvq2vq9lv6896hr3gq1tv','127.0.0.1',1547322556,_binary '__ci_last_regenerate|i:1547322243;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('ccaiurivlt93vome2qu4pql8t9lfn0g7','127.0.0.1',1547322848,_binary '__ci_last_regenerate|i:1547322556;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('oe0023gtnrhtp3graf9ri3d4v18iqb03','127.0.0.1',1547323275,_binary '__ci_last_regenerate|i:1547322857;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('o80s27n8upral2j2h25lc6d22355tsvf','127.0.0.1',1547365175,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547364845;semester_id|s:1:\"1\";'),('psuiqahq84oqonou78j99fmkml83gdf1','127.0.0.1',1547365498,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547365175;semester_id|s:1:\"1\";'),('cjuif4tci9ii1vbmbvgdd4erlvfmfma6','127.0.0.1',1547365804,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547365505;semester_id|s:1:\"1\";'),('b559mr4oclrqe9q9tcsdvqdjh431rsrs','127.0.0.1',1547366112,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547365807;semester_id|s:1:\"1\";'),('hctt38ofq56b5rdtv56k8gkv93ougp6e','127.0.0.1',1547366486,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547366112;semester_id|s:1:\"1\";'),('ueqkk6b7fvdg98nh0k105mkn28l4hc11','127.0.0.1',1547366910,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547366513;semester_id|s:1:\"1\";'),('bnffjus2ro9vhm4s20l6h0uqn6e3k0tp','127.0.0.1',1547367255,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547366918;semester_id|s:1:\"1\";'),('nh08fp5bi79h7ho3lie7lfd32dhu8k6m','127.0.0.1',1547367577,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547367272;semester_id|s:1:\"1\";flash_message|s:28:\"Questions Saved Successfully\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('05e1fhea3al5ie6qep2ipieeq1pkss3i','127.0.0.1',1547367987,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547367577;semester_id|s:1:\"1\";'),('04dtaumlhq0qbqbu6lt5vss3b86udkmk','127.0.0.1',1547368287,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547367989;semester_id|s:1:\"1\";'),('visq6388q1ouhpgl42rs9tkc455rfv0n','127.0.0.1',1547368647,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547368302;semester_id|s:1:\"1\";'),('b9ibd05hplvmfi9l0h8u74cb2gcuadgq','127.0.0.1',1547368998,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547368654;semester_id|s:1:\"1\";'),('gh9e9d98isl08hvo029oqrr0dpphak96','127.0.0.1',1547369365,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547369026;semester_id|s:1:\"1\";'),('q8m9vbot0q8q2m0l2h5g2uu2bddf2i9l','127.0.0.1',1547369685,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547369372;semester_id|s:1:\"1\";'),('sebvfkrbnobki76b409sdlpjivu51e6o','127.0.0.1',1547369577,_binary '__ci_last_regenerate|i:1547369577;'),('5ql10bjd250gjdljrh988vofql65pirv','127.0.0.1',1547370007,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547369690;semester_id|s:1:\"1\";'),('lca4agrj5jjnlnelpsih0vb3uggdggl0','127.0.0.1',1547370314,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547370016;semester_id|s:1:\"2\";'),('r5ln9cgrmk7fphhvhi8i3049pf8ugloc','127.0.0.1',1547370962,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547370317;semester_id|s:1:\"1\";'),('fjgkmqc8so7pn59pmfhljqh8m7g4lnkj','127.0.0.1',1547371368,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547370987;semester_id|s:1:\"1\";'),('1dcnid2pb01e4h0aifjbd0cf2pmahr68','127.0.0.1',1547371686,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547371379;semester_id|s:1:\"1\";'),('rq30dmu18djslc4s2sqfjm4dmkvq3nbg','127.0.0.1',1547376868,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547371691;semester_id|s:1:\"1\";'),('sm710tk0ef1rkrb1q9mab5j4eh5t83cg','127.0.0.1',1547377536,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547376879;semester_id|s:1:\"1\";flash_message|s:18:\"Successfully Saved\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('hrj623tp9gjpir5770h5qk5cn64ftcst','127.0.0.1',1547379113,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547377536;semester_id|s:1:\"1\";'),('ds6u8psr3tkip2u0u4l8ti1gggg7fqe7','127.0.0.1',1547379440,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547379115;semester_id|s:1:\"1\";'),('ja8g235quf9t3dg6gs5fahbmkc43eg9o','127.0.0.1',1547379750,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547379455;semester_id|s:1:\"1\";'),('e9s34h41e4gft1apasjtmkqp79f73rge','127.0.0.1',1547380529,_binary 'user_id|s:2:\"10\";__ci_last_regenerate|i:1547379756;semester_id|s:1:\"1\";'),('ah1v2dt2a0tu085igojlsh1et0519pjl','127.0.0.1',1547380883,_binary 'user_id|s:2:\"10\";__ci_last_regenerate|i:1547380571;semester_id|s:1:\"1\";flash_message|s:18:\"Successfully Saved\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:1;'),('jeo0f91b4ofa5gsovff6392kdb67bdm7','127.0.0.1',1547381226,_binary 'user_id|s:2:\"10\";__ci_last_regenerate|i:1547380883;semester_id|s:1:\"1\";'),('sukuud0o73so7stgdskn0nsjjn21ej7h','127.0.0.1',1547381586,_binary 'user_id|s:2:\"10\";__ci_last_regenerate|i:1547381249;semester_id|s:1:\"1\";flash_message|s:18:\"Exam has Published\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('07gd8ffhptdcvlqob9mclhnqe3nq6l9t','127.0.0.1',1547382186,_binary '__ci_last_regenerate|i:1547381877;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('43nre51c1s56obvpl02ga4adidmbisql','127.0.0.1',1547382516,_binary '__ci_last_regenerate|i:1547382194;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('7p5t1kuftm05d04ubdbhjsel8k7cic5r','127.0.0.1',1547382984,_binary '__ci_last_regenerate|i:1547382538;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('1mr06l19j64h96ggt4hntsb7e1g6frj5','127.0.0.1',1547383429,_binary '__ci_last_regenerate|i:1547383106;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('7henhb6s0mgouofanmf94v8ulssslgur','127.0.0.1',1547383733,_binary '__ci_last_regenerate|i:1547383450;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('n5rvgktjftgn2kt0iea54h736orl2hnr','127.0.0.1',1547384331,_binary '__ci_last_regenerate|i:1547383752;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('6rk2qie5ng54kee5c2bspls09hsev9bl','127.0.0.1',1547384631,_binary '__ci_last_regenerate|i:1547384333;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('tuoh6r2eta7vcu9633uqc20q9egkbmib','127.0.0.1',1547384977,_binary '__ci_last_regenerate|i:1547384634;user_id|s:2:\"10\";semester_id|s:1:\"1\";'),('l8vv2jjjmlokoct4ampe2na1nku23b6a','127.0.0.1',1547385282,_binary '__ci_last_regenerate|i:1547384978;user_id|s:2:\"10\";semester_id|s:1:\"1\";'),('44k69vlkefd3ikrnbhi655i52rsqo4d8','127.0.0.1',1547386868,_binary '__ci_last_regenerate|i:1547385446;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('v6dkl44l4ikqrauf4noo5a53nvjtjgb4','127.0.0.1',1547387271,_binary '__ci_last_regenerate|i:1547386891;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('q42nc810lub34h6rrcq744t5u2gt9k7d','127.0.0.1',1547387722,_binary '__ci_last_regenerate|i:1547387286;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('f1iq4tspqm1emmospv5qfn8nats34le3','127.0.0.1',1547388102,_binary '__ci_last_regenerate|i:1547387749;user_id|s:1:\"1\";semester_id|s:1:\"1\";flash_message|s:18:\"Successfully Saved\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('9ece7idv3k3me16bdltug0mn964on6r7','127.0.0.1',1547388610,_binary '__ci_last_regenerate|i:1547388102;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('6fge0i9rjgubitpa7lec64u0dshlbsj1','127.0.0.1',1547388942,_binary '__ci_last_regenerate|i:1547388615;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('mnckdtg4et0v8kv7av3mto4312n38dp4','127.0.0.1',1547389369,_binary '__ci_last_regenerate|i:1547388948;user_id|s:2:\"22\";semester_id|s:1:\"1\";'),('kkb7s84b0h42kq31j81fofgvbcq4sop0','127.0.0.1',1547389875,_binary '__ci_last_regenerate|i:1547389369;user_id|s:2:\"11\";semester_id|s:1:\"1\";'),('s93i6dadnh5ngbgkbejtrugamr7hrcoq','127.0.0.1',1547390199,_binary '__ci_last_regenerate|i:1547389901;user_id|s:2:\"11\";semester_id|s:1:\"1\";'),('nf2kqql67o26s2tarv30f7lcnr59l2ol','127.0.0.1',1547390552,_binary '__ci_last_regenerate|i:1547390221;user_id|s:2:\"11\";semester_id|s:1:\"1\";elFinderCaches|a:4:{s:8:\"_optsMD5\";s:32:\"77f9d9ace393c9d507ce9a00f3371328\";s:3:\"l1_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"9176b4b8629d0f64953e604054974ba3\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547390518;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l1_Lw\";s:4:\"name\";s:7:\"General\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l1_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l2_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"22e9ed7b28c42eff2cc2464afdd916cb\";a:12:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547313675;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l2_Lw\";s:4:\"name\";s:9:\"Documents\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l2_\";s:6:\"locked\";i:1;s:4:\"dirs\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l3_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"f0b95f741ab3bfc660d9af29da00f6f1\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547390518;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l3_Lw\";s:4:\"name\";s:8:\"My files\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l3_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}}elFinderCaches:LAST_ACTIVITY|i:1547390552;'),('lnjukuhej8eajjppqucbqf80liv6ti7m','127.0.0.1',1547390931,_binary '__ci_last_regenerate|i:1547390632;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('6q7u7bvun5fvlpqimtandg4l95vb5eur','127.0.0.1',1547391300,_binary '__ci_last_regenerate|i:1547390933;user_id|s:1:\"1\";semester_id|s:1:\"1\";elFinderCaches|a:4:{s:8:\"_optsMD5\";s:32:\"d4b3be3021e851b7b3efa20ed5c54363\";s:3:\"l1_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"9176b4b8629d0f64953e604054974ba3\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547390518;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l1_Lw\";s:4:\"name\";s:7:\"General\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l1_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l2_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"22e9ed7b28c42eff2cc2464afdd916cb\";a:12:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547390518;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l2_Lw\";s:4:\"name\";s:9:\"Documents\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l2_\";s:6:\"locked\";i:1;s:4:\"dirs\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l3_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"72c0c5e97d5b2aa8f15e22ba789b7539\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547391074;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l3_Lw\";s:4:\"name\";s:8:\"My files\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l3_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}}elFinderCaches:LAST_ACTIVITY|i:1547391095;'),('5k0em9a0abpnff2c1mjk1t28e5ktf9dv','127.0.0.1',1547392928,_binary '__ci_last_regenerate|i:1547391306;user_id|s:1:\"1\";semester_id|s:1:\"1\";elFinderCaches|a:4:{s:8:\"_optsMD5\";s:32:\"d4b3be3021e851b7b3efa20ed5c54363\";s:3:\"l1_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"9176b4b8629d0f64953e604054974ba3\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547390518;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l1_Lw\";s:4:\"name\";s:7:\"General\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l1_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l2_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"22e9ed7b28c42eff2cc2464afdd916cb\";a:12:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547390518;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l2_Lw\";s:4:\"name\";s:9:\"Documents\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l2_\";s:6:\"locked\";i:1;s:4:\"dirs\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l3_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"72c0c5e97d5b2aa8f15e22ba789b7539\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547391074;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l3_Lw\";s:4:\"name\";s:8:\"My files\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l3_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}}elFinderCaches:LAST_ACTIVITY|i:1547391095;'),('7ni802t7s65cevh1eh0f6iumh158n19i','127.0.0.1',1547448896,_binary '__ci_last_regenerate|i:1547448572;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";'),('0gi042k996fl7tn99itcocpq47j4uq5d','127.0.0.1',1547449351,_binary '__ci_last_regenerate|i:1547448927;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";'),('el8lfnl6gflu0l50mme58j70fu1lih7f','127.0.0.1',1547449715,_binary '__ci_last_regenerate|i:1547449351;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";'),('s212d5m2vkfdnuj4ided3v3lad42ne5d','127.0.0.1',1547450197,_binary '__ci_last_regenerate|i:1547449772;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";'),('bcplju8gvcdp1k1jf9e97d1qc999ds2a','127.0.0.1',1547450731,_binary '__ci_last_regenerate|i:1547450222;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";'),('luiobvgk3i2p5no09tgi6g2u9np6jifb','127.0.0.1',1547451243,_binary '__ci_last_regenerate|i:1547450774;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";flash_message|s:22:\"KPI Saved Successfully\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('5qsk65hvtj6uodd3dji7gu9sf555jkcr','127.0.0.1',1547451771,_binary '__ci_last_regenerate|i:1547451243;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";'),('cn8dojm6bp5o2c8laephhi9dn9a397ab','127.0.0.1',1547452907,_binary '__ci_last_regenerate|i:1547451773;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";flash_message|s:18:\"Successfully Saved\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('3vbelubgok5st4isnse2tagfbpt1kj9o','127.0.0.1',1547453202,_binary '__ci_last_regenerate|i:1547452907;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";'),('kgafl03r5me57e71a7obnhn1et6d3g1d','127.0.0.1',1547453517,_binary '__ci_last_regenerate|i:1547453218;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";'),('lsvklipi5ao60okqfeeqntl7hii0ipoo','127.0.0.1',1547453977,_binary '__ci_last_regenerate|i:1547453523;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";flash_message|s:35:\"Number of levels has not been added\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:5:\"error\";flash_keep|b:0;'),('4roh5vaahaaiqel08o2a4qiljpln6vg9','127.0.0.1',1547454267,_binary '__ci_last_regenerate|i:1547453978;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";'),('0a0ap2c2sjtpdvodb066qb3f2egj5pr1','127.0.0.1',1547454606,_binary '__ci_last_regenerate|i:1547454323;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";'),('626oo8rk89jv33pt8robs6gevqo83urg','127.0.0.1',1547454995,_binary '__ci_last_regenerate|i:1547454646;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";'),('utlui5cmtb70ehhgvont6i7dno3uqpav','127.0.0.1',1547455331,_binary '__ci_last_regenerate|i:1547455002;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";'),('s4hppf9dgngs92gjfn5ubu0kudtskli3','127.0.0.1',1547455772,_binary '__ci_last_regenerate|i:1547455367;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";elFinderCaches|a:4:{s:8:\"_optsMD5\";s:32:\"d4b3be3021e851b7b3efa20ed5c54363\";s:3:\"l1_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"9176b4b8629d0f64953e604054974ba3\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547390518;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l1_Lw\";s:4:\"name\";s:7:\"General\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l1_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l2_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"22e9ed7b28c42eff2cc2464afdd916cb\";a:12:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547390518;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l2_Lw\";s:4:\"name\";s:9:\"Documents\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l2_\";s:6:\"locked\";i:1;s:4:\"dirs\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l3_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"72c0c5e97d5b2aa8f15e22ba789b7539\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547391074;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l3_Lw\";s:4:\"name\";s:8:\"My files\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l3_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}}elFinderCaches:LAST_ACTIVITY|i:1547455416;'),('2rmdm87dumv3t1203qobd1vlh4f6hu2o','127.0.0.1',1547456098,_binary '__ci_last_regenerate|i:1547455787;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";elFinderCaches|a:4:{s:8:\"_optsMD5\";s:32:\"d4b3be3021e851b7b3efa20ed5c54363\";s:3:\"l1_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"9176b4b8629d0f64953e604054974ba3\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547390518;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l1_Lw\";s:4:\"name\";s:7:\"General\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l1_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l2_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"22e9ed7b28c42eff2cc2464afdd916cb\";a:12:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547390518;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l2_Lw\";s:4:\"name\";s:9:\"Documents\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l2_\";s:6:\"locked\";i:1;s:4:\"dirs\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l3_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"72c0c5e97d5b2aa8f15e22ba789b7539\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547391074;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l3_Lw\";s:4:\"name\";s:8:\"My files\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l3_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}}elFinderCaches:LAST_ACTIVITY|i:1547455416;'),('dosn1kp6r7e3ncv4l3qmtvjj4sp8j1ag','127.0.0.1',1547456442,_binary '__ci_last_regenerate|i:1547456123;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";elFinderCaches|a:4:{s:8:\"_optsMD5\";s:32:\"d4b3be3021e851b7b3efa20ed5c54363\";s:3:\"l1_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"9176b4b8629d0f64953e604054974ba3\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547390518;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l1_Lw\";s:4:\"name\";s:7:\"General\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l1_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l2_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"22e9ed7b28c42eff2cc2464afdd916cb\";a:12:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547390518;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l2_Lw\";s:4:\"name\";s:9:\"Documents\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l2_\";s:6:\"locked\";i:1;s:4:\"dirs\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l3_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"72c0c5e97d5b2aa8f15e22ba789b7539\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547391074;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l3_Lw\";s:4:\"name\";s:8:\"My files\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l3_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}}elFinderCaches:LAST_ACTIVITY|i:1547455416;flash_message|s:26:\"Project Saved Successfully\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('3lnhvlrs27vf0ps05v68f22qvtpvl4ak','127.0.0.1',1547456729,_binary '__ci_last_regenerate|i:1547456442;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";elFinderCaches|a:4:{s:8:\"_optsMD5\";s:32:\"d4b3be3021e851b7b3efa20ed5c54363\";s:3:\"l1_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"9176b4b8629d0f64953e604054974ba3\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547390518;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l1_Lw\";s:4:\"name\";s:7:\"General\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l1_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l2_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"22e9ed7b28c42eff2cc2464afdd916cb\";a:12:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547390518;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l2_Lw\";s:4:\"name\";s:9:\"Documents\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l2_\";s:6:\"locked\";i:1;s:4:\"dirs\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l3_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"72c0c5e97d5b2aa8f15e22ba789b7539\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547391074;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l3_Lw\";s:4:\"name\";s:8:\"My files\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l3_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}}elFinderCaches:LAST_ACTIVITY|i:1547455416;'),('btc3s4nk0kfr3c710k9tpjb29tv5o44l','127.0.0.1',1547457053,_binary '__ci_last_regenerate|i:1547456755;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";elFinderCaches|a:4:{s:8:\"_optsMD5\";s:32:\"d4b3be3021e851b7b3efa20ed5c54363\";s:3:\"l1_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"9176b4b8629d0f64953e604054974ba3\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547390518;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l1_Lw\";s:4:\"name\";s:7:\"General\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l1_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l2_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"22e9ed7b28c42eff2cc2464afdd916cb\";a:12:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547390518;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l2_Lw\";s:4:\"name\";s:9:\"Documents\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l2_\";s:6:\"locked\";i:1;s:4:\"dirs\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l3_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"72c0c5e97d5b2aa8f15e22ba789b7539\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547391074;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l3_Lw\";s:4:\"name\";s:8:\"My files\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l3_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}}elFinderCaches:LAST_ACTIVITY|i:1547455416;'),('iccdhsmp9cmvt9s505lhauaksi1uc28q','127.0.0.1',1547457378,_binary '__ci_last_regenerate|i:1547457057;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";elFinderCaches|a:4:{s:8:\"_optsMD5\";s:32:\"d4b3be3021e851b7b3efa20ed5c54363\";s:3:\"l1_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"9176b4b8629d0f64953e604054974ba3\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547390518;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l1_Lw\";s:4:\"name\";s:7:\"General\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l1_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l2_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"22e9ed7b28c42eff2cc2464afdd916cb\";a:12:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547390518;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l2_Lw\";s:4:\"name\";s:9:\"Documents\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l2_\";s:6:\"locked\";i:1;s:4:\"dirs\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l3_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"72c0c5e97d5b2aa8f15e22ba789b7539\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547391074;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l3_Lw\";s:4:\"name\";s:8:\"My files\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l3_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}}elFinderCaches:LAST_ACTIVITY|i:1547455416;flash_message|s:26:\"Project Saved Successfully\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('1s5ud0lkuqfv8odrpqb0i59lll85nc20','127.0.0.1',1547457807,_binary '__ci_last_regenerate|i:1547457378;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";elFinderCaches|a:4:{s:8:\"_optsMD5\";s:32:\"d4b3be3021e851b7b3efa20ed5c54363\";s:3:\"l1_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"9176b4b8629d0f64953e604054974ba3\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547390518;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l1_Lw\";s:4:\"name\";s:7:\"General\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l1_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l2_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"22e9ed7b28c42eff2cc2464afdd916cb\";a:12:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547390518;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l2_Lw\";s:4:\"name\";s:9:\"Documents\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l2_\";s:6:\"locked\";i:1;s:4:\"dirs\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l3_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"72c0c5e97d5b2aa8f15e22ba789b7539\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547391074;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l3_Lw\";s:4:\"name\";s:8:\"My files\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l3_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}}elFinderCaches:LAST_ACTIVITY|i:1547455416;'),('5d9te34pjbd2m79fvkoj7iannlh2s5h2','127.0.0.1',1547458133,_binary '__ci_last_regenerate|i:1547457830;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";elFinderCaches|a:4:{s:8:\"_optsMD5\";s:32:\"d4b3be3021e851b7b3efa20ed5c54363\";s:3:\"l1_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"9176b4b8629d0f64953e604054974ba3\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547390518;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l1_Lw\";s:4:\"name\";s:7:\"General\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l1_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l2_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"22e9ed7b28c42eff2cc2464afdd916cb\";a:12:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547390518;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l2_Lw\";s:4:\"name\";s:9:\"Documents\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l2_\";s:6:\"locked\";i:1;s:4:\"dirs\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l3_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"72c0c5e97d5b2aa8f15e22ba789b7539\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547391074;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l3_Lw\";s:4:\"name\";s:8:\"My files\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l3_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}}elFinderCaches:LAST_ACTIVITY|i:1547455416;flash_message|s:18:\"Saved Successfully\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('d203n0ess7k6tob288fba67gdj21slqp','127.0.0.1',1547459260,_binary '__ci_last_regenerate|i:1547458379;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('mi5lhf88rgaoff6d9vtgfsrjl479u16j','127.0.0.1',1547459957,_binary '__ci_last_regenerate|i:1547459288;user_id|s:1:\"1\";semester_id|s:1:\"1\";flash_message|s:18:\"Successfully Saved\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('hbl9e08n4upl6rb5biot7v5nadgquvsa','127.0.0.1',1547461445,_binary '__ci_last_regenerate|i:1547459957;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('5ens8fihkans7k2vjv9ha4poi11aad6g','127.0.0.1',1547462199,_binary '__ci_last_regenerate|i:1547461466;user_id|s:1:\"1\";semester_id|s:1:\"1\";flash_message|s:18:\"Successfully Saved\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('800lep1blanqucu9p57gq89k67t4rpqq','127.0.0.1',1547463605,_binary '__ci_last_regenerate|i:1547462440;user_id|s:2:\"13\";semester_id|s:1:\"1\";'),('kp76vba0kepnceroi38ljreuo16dtb33','127.0.0.1',1547465323,_binary '__ci_last_regenerate|i:1547463681;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('vgn2jsl3i1g7oaq56k47oiqs5tfg9hpm','127.0.0.1',1547465625,_binary '__ci_last_regenerate|i:1547465332;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('o1g38adlr52rpanb46agf8ikhir9qrgv','127.0.0.1',1547466024,_binary '__ci_last_regenerate|i:1547465649;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('rt7qit0nhk8q5gdfs7q30be1qdfb84e9','127.0.0.1',1547467182,_binary '__ci_last_regenerate|i:1547466028;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('62395ob99d7vtvuc401bob9t629vn9c4','127.0.0.1',1547467518,_binary '__ci_last_regenerate|i:1547467226;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('dip0jcce3orap38ecmlinvuhs9hgl93c','127.0.0.1',1547468092,_binary '__ci_last_regenerate|i:1547467554;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('sfl08j002s9jkv92us6scek35v173lkq','127.0.0.1',1547468487,_binary '__ci_last_regenerate|i:1547468106;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('eg73oucqktvnns8i0ffc41kbfib5elj4','127.0.0.1',1547468996,_binary '__ci_last_regenerate|i:1547468517;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('t6a69q1mr53ppgo4m2r1eb1u0d6r4i5o','127.0.0.1',1547469350,_binary '__ci_last_regenerate|i:1547469009;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('sekjjm27bi22u19unu468rgdmonrjk8e','127.0.0.1',1547469680,_binary '__ci_last_regenerate|i:1547469358;user_id|s:2:\"12\";semester_id|s:1:\"1\";'),('a3hgavdcst6bc425fcg1h4pohbtovbo4','127.0.0.1',1547470105,_binary '__ci_last_regenerate|i:1547469680;user_id|s:2:\"12\";semester_id|s:1:\"1\";'),('o7g7h44b4k2j2nhqsdc0ol9qr7tgmgar','127.0.0.1',1547470825,_binary '__ci_last_regenerate|i:1547470127;user_id|s:2:\"12\";semester_id|s:1:\"1\";'),('u1guf26slhl3batp65a7qefik0b1hjdi','127.0.0.1',1547471590,_binary '__ci_last_regenerate|i:1547470831;user_id|s:2:\"12\";semester_id|s:1:\"1\";'),('e632h3knd3m3fbeo65546oc68e89c9st','127.0.0.1',1547471895,_binary '__ci_last_regenerate|i:1547471595;user_id|s:2:\"12\";semester_id|s:1:\"1\";'),('tdmrt5i4ntr16o21sj669oq3oq9nqiqn','127.0.0.1',1547472635,_binary '__ci_last_regenerate|i:1547472177;user_id|s:1:\"1\";semester_id|s:1:\"1\";flash_message|s:26:\"Mission Successfully Saved\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('ihogfus207e4gf5qi82hb1rgjt45futp','127.0.0.1',1547473611,_binary '__ci_last_regenerate|i:1547472635;user_id|s:1:\"1\";semester_id|s:1:\"1\";flash_message|s:24:\"Value Successfully Saved\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('37jaohvqs9e974r2n27jon526i3lkoj8','127.0.0.1',1547473976,_binary '__ci_last_regenerate|i:1547473611;user_id|s:1:\"1\";semester_id|s:1:\"1\";flash_message|s:26:\"Mission Successfully Saved\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('rjbt0qonun6629ehk3bfhp3tbmjuuseo','127.0.0.1',1547474290,_binary '__ci_last_regenerate|i:1547473976;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('urqaobplg82b7olc0eh7151cfqma4q2i','127.0.0.1',1547475581,_binary '__ci_last_regenerate|i:1547474295;user_id|s:1:\"1\";semester_id|s:1:\"1\";flash_message|s:30:\"No Objectives to be integrated\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:5:\"error\";flash_keep|b:0;'),('ueq30754pptd79dld0dgoal86g4nb1k1','127.0.0.1',1547476058,_binary '__ci_last_regenerate|i:1547475581;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('hfd2arrkb2pl9ijha7fpjo8tualem1ha','127.0.0.1',1547489214,_binary '__ci_last_regenerate|i:1547476063;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('bf6f5begiblu33j2d9kujq1mariuajqa','127.0.0.1',1547542155,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547541832;semester_id|s:1:\"1\";'),('adppoc90lo5pmder0mekp2t04ia468mm','127.0.0.1',1547542581,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547542186;semester_id|s:1:\"1\";flash_message|s:23:\"Risk Successfully Saved\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('vrfgc37j8q0do7enj7m7bpjqt5rcvkbq','127.0.0.1',1547543004,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547542581;semester_id|s:1:\"1\";'),('qgt6el9k4bbl7ukeq0o0a8b2nt6n8s5t','127.0.0.1',1547543477,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547543024;semester_id|s:1:\"1\";'),('fbn510sjuuuiu2sn611nr8dg6n3gi6k1','127.0.0.1',1547543806,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547543509;semester_id|s:1:\"1\";'),('mvuirgf204jcgofvtco6p312rr7fi2ev','127.0.0.1',1547544169,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547543818;semester_id|s:1:\"1\";'),('6bbqq67ugvb302u3n739beksq29reun3','127.0.0.1',1547544498,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547544174;semester_id|s:1:\"1\";'),('5tlvmvnkapn27kked6okfqt9h3bkh9tk','127.0.0.1',1547544930,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547544522;semester_id|s:1:\"1\";flash_message|s:33:\"Recommendation Saved Successfully\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('epaec7n65foq7tlj1af89rf32k76idhl','127.0.0.1',1547545387,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547544930;semester_id|s:1:\"1\";flash_message|s:26:\"Project Saved Successfully\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('jkj0lcbgb3rjvft57pej51016ig3e3gv','127.0.0.1',1547545765,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547545387;semester_id|s:1:\"1\";flash_message|s:27:\"Activity Successfully Saved\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('ausghcl6uggtvf4tlpcsq3orsbtclre2','127.0.0.1',1547548019,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547545765;semester_id|s:1:\"1\";'),('q67rqor9q0c5i02p4ae695f8cjol1f44','127.0.0.1',1547550652,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547548027;semester_id|s:1:\"1\";flash_message|s:17:\"Successful Delete\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"old\";s:12:\"flash_status\";s:3:\"old\";s:10:\"flash_keep\";s:3:\"old\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('hn78jlqaaep8konoolu7dc5mljsndk6j','127.0.0.1',1547550971,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547550652;semester_id|s:1:\"1\";'),('okgs9806gjn7c6damk9ja4chrs2uqate','127.0.0.1',1547551307,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547550973;semester_id|s:1:\"1\";'),('7d0202qa0udkvjlff3sgr16cpfvh1akq','127.0.0.1',1547551647,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547551314;semester_id|s:1:\"1\";'),('ifq2g14nh2nu4en0117c1u61hknjleta','127.0.0.1',1547551633,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547551631;semester_id|s:1:\"1\";'),('rbvnor1mhqq73m518c8qmvp7jljt9h6r','127.0.0.1',1547554344,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547551649;semester_id|s:1:\"1\";'),('2pi8qoniftce3gvhler132gn28qp5132','127.0.0.1',1547554891,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547554345;semester_id|s:1:\"1\";'),('i64tm4bg01q3s9fq2kvifsp58rapbuna','127.0.0.1',1547555356,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547554917;semester_id|s:1:\"1\";'),('t6osnem6noerprq0mhj0mfme6j12klmg','127.0.0.1',1547555853,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547555357;semester_id|s:1:\"1\";'),('pq700c3u45op71gru3bid336humn5u4i','127.0.0.1',1547556432,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547555890;semester_id|s:1:\"1\";'),('t0pmfrfjuh6gjcom9rv2l2ek4ojlp94s','127.0.0.1',1547556759,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547556433;semester_id|s:1:\"1\";'),('k42tg97fs0g5ur7v3mh78ctepormqe8f','127.0.0.1',1547557114,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547556773;semester_id|s:1:\"1\";'),('75200bdmcta16b2u2hjkbnqjasimkqau','127.0.0.1',1547558162,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547557119;semester_id|s:1:\"1\";'),('rhvhjka0rgsghl3jcajpoahjf1ai6i0k','127.0.0.1',1547559357,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547558164;semester_id|s:1:\"1\";'),('onq382lhcvqdv3kd9r72650g1pgpml6a','127.0.0.1',1547560128,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547559369;semester_id|s:1:\"1\";flash_message|s:18:\"Successfully Saved\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('vs5d94toboeb992ovvecq7244b0kk18b','127.0.0.1',1547561384,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547560128;semester_id|s:1:\"1\";'),('0utrbrgafvujcpj07bnadivbq62hd41d','127.0.0.1',1547562263,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547561383;semester_id|s:1:\"1\";flash_message|s:18:\"Successfully Saved\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('ltp8nhc3uokj5keut0ic8p8t2tcp4sdf','127.0.0.1',1547562585,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547562263;semester_id|s:1:\"1\";'),('ui2slqc1n3b1hq7t842hnuti5ic0bnci','127.0.0.1',1547562902,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547562606;semester_id|s:1:\"1\";'),('dlkk5l6jhp9r4uh56rn9s1rokr5obu9b','127.0.0.1',1547563726,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547562911;semester_id|s:1:\"1\";'),('01e8m2epr6iv810ihkgaln6u8vqq73mv','127.0.0.1',1547565662,_binary '__ci_last_regenerate|i:1547564448;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('1uqq541v6bu5js8eqlgtancoq2658mq4','127.0.0.1',1547582941,_binary '__ci_last_regenerate|i:1547582011;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('o9qbo0gku5m2q74mlbu325mmlnf4q1c3','127.0.0.1',1547583555,_binary '__ci_last_regenerate|i:1547582977;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('9vbjl5jjjt9vjvnqn6kvcij3ckkjfhjj','127.0.0.1',1547584707,_binary '__ci_last_regenerate|i:1547583602;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('e0fuid6snhac007nmesbqhbs3i4fcc7e','127.0.0.1',1547587147,_binary '__ci_last_regenerate|i:1547584755;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('udbkrlolkpq37jeqd5pqhod1jldulkm3','127.0.0.1',1547587514,_binary '__ci_last_regenerate|i:1547587193;user_id|s:1:\"1\";semester_id|s:1:\"1\";flash_message|s:18:\"Successfully Saved\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('jnidn28kdo9nrvfjuko8ojqels5hvnb5','127.0.0.1',1547588416,_binary '__ci_last_regenerate|i:1547587657;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('e8nmtp9gs8h1nkd0lntkhh6eaop117d4','127.0.0.1',1547589444,_binary '__ci_last_regenerate|i:1547589107;user_id|s:1:\"1\";semester_id|s:1:\"1\";flash_message|s:18:\"Successfully Saved\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('42f2n6sr4fi0evfp186590i9c80j8vtf','127.0.0.1',1547589882,_binary '__ci_last_regenerate|i:1547589592;user_id|s:2:\"10\";semester_id|s:1:\"1\";'),('nlqi7fs4bvlak4qtuapsg99e5mtvlrdl','127.0.0.1',1547590440,_binary '__ci_last_regenerate|i:1547590163;user_id|s:2:\"20\";semester_id|s:1:\"1\";'),('jmapnqagbbfor4ra6omiifbns9bmts7o','127.0.0.1',1547590924,_binary '__ci_last_regenerate|i:1547590475;user_id|s:2:\"22\";semester_id|s:1:\"1\";'),('rg6irqs6gpoq5fbihbam0mv0el4ceuu0','127.0.0.1',1547591508,_binary '__ci_last_regenerate|i:1547591061;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('51hl0j20ev4v91mtis2b31m6ojgi22id','127.0.0.1',1547591814,_binary '__ci_last_regenerate|i:1547591508;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('11pviju8g96g5pnspj58k1aik6k1srun','127.0.0.1',1547592119,_binary '__ci_last_regenerate|i:1547591837;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('7fbv1totc77sq5hkjd5g4bau5nacogcf','127.0.0.1',1547592613,_binary '__ci_last_regenerate|i:1547592313;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('eilg9dmhhmls5a6b6jv4dq6fscjos8dq','127.0.0.1',1547592952,_binary '__ci_last_regenerate|i:1547592653;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('mgkj3s8dhoihd25nuq6vlhaqqtvqik03','127.0.0.1',1547593262,_binary '__ci_last_regenerate|i:1547592972;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('9gp3p14jovthbsjnkbtin4sa3vu57eqo','127.0.0.1',1547593727,_binary '__ci_last_regenerate|i:1547593276;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('olc418r46u6vskrpnr7iuv6lm6umcg1v','127.0.0.1',1547597388,_binary '__ci_last_regenerate|i:1547593737;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('4s5ol53v9p5rathrt853s9m6hvd4ep4c','127.0.0.1',1547621147,_binary '__ci_last_regenerate|i:1547621145;go_to|s:45:\"/strategic_planning/objective/?strategy_id=18\";'),('hj2lqj3h6co15p39708gv3f3qtgvp2p3','127.0.0.1',1547621437,_binary '__ci_last_regenerate|i:1547621145;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('vhun794uluutl2lh6ijho8u56j2fs37j','127.0.0.1',1547621884,_binary '__ci_last_regenerate|i:1547621471;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('07rhbb2juc2rvmjk9s00558bdk59aidr','127.0.0.1',1547622372,_binary '__ci_last_regenerate|i:1547621924;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('ep5lbva8e00ng8kaodhlc2cgo93l5jai','127.0.0.1',1547622856,_binary '__ci_last_regenerate|i:1547622375;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('uf0igqi1q95aspcuta97qc0vqv1cbcsp','127.0.0.1',1547623184,_binary '__ci_last_regenerate|i:1547622886;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('v9pisb1r0d4dgau8rh1u7penr7i4tlen','127.0.0.1',1547623621,_binary '__ci_last_regenerate|i:1547623187;user_id|s:1:\"1\";semester_id|s:1:\"1\";flash_message|s:18:\"Successfully Saved\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('ngp8b1ev56vggk7qk5hkuvf49id7140s','127.0.0.1',1547623997,_binary '__ci_last_regenerate|i:1547623621;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('d86go5u4cjfdq4nc2m5sjt6if6u7saf9','127.0.0.1',1547624485,_binary '__ci_last_regenerate|i:1547624028;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('mdq0jp5rcrrletvjt32n2frjn1jihe4s','127.0.0.1',1547624813,_binary '__ci_last_regenerate|i:1547624488;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('k3n8hsiqu4vjsp4q5ffd303k93hciff8','127.0.0.1',1547625551,_binary '__ci_last_regenerate|i:1547624844;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('t20p4j6tcp6n81rg6v59uc0siq0465j0','127.0.0.1',1547625888,_binary '__ci_last_regenerate|i:1547625557;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('ph3iifd3rkl3scfe55id7fves6p6rl3r','127.0.0.1',1547626228,_binary '__ci_last_regenerate|i:1547625902;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('1h10cibj7s8fg6tk82b5nc1oojgugtrs','127.0.0.1',1547626925,_binary '__ci_last_regenerate|i:1547626250;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('eeili1pb6shf6f3qjsctd491s6shlphr','127.0.0.1',1547627316,_binary '__ci_last_regenerate|i:1547626926;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('d6pg8ul3cvr6p5k6dpce350fpuvfjk28','127.0.0.1',1547627768,_binary '__ci_last_regenerate|i:1547627462;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('44memfq1acu0ptql8pbv4b1sn4l4u2bh','127.0.0.1',1547628395,_binary '__ci_last_regenerate|i:1547627904;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('9v0lom3mjgbc0jtgo84g6lcl1bnpmkme','127.0.0.1',1547628705,_binary '__ci_last_regenerate|i:1547628401;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('8i7hb8f86l0diub3c8ue0cui5gb9j2fo','127.0.0.1',1547629278,_binary '__ci_last_regenerate|i:1547628705;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('mlgelnjkqtfd2hffn9aubac5iqruajha','127.0.0.1',1547629595,_binary '__ci_last_regenerate|i:1547629282;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('jbor8qinph1qgovo38hqpo0qgtig0mem','127.0.0.1',1547629915,_binary '__ci_last_regenerate|i:1547629595;user_id|s:1:\"1\";semester_id|s:1:\"1\";flash_message|s:18:\"Successfully Saved\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:1;'),('ii5ojku6m8ju52bqg799acer41leegvh','127.0.0.1',1547631210,_binary '__ci_last_regenerate|i:1547629915;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('qn8kev25billp3k5eb4d96ea9sou8020','127.0.0.1',1547631753,_binary '__ci_last_regenerate|i:1547631216;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('fcbbbd5asctm3vvc85dudm0slegnh8nd','127.0.0.1',1547632077,_binary '__ci_last_regenerate|i:1547631766;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('4491973502cnq1gvm45f6411vjlhravi','127.0.0.1',1547632668,_binary '__ci_last_regenerate|i:1547632078;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('vhbndlfhcd3649as25d1qju08q5h0efg','127.0.0.1',1547633406,_binary '__ci_last_regenerate|i:1547633029;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('a2do35tufik6t7201tv2rjuqlr0plsic','127.0.0.1',1547633740,_binary '__ci_last_regenerate|i:1547633406;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('amgi4efgb4d4rhud16nc57bm42ip0gj2','127.0.0.1',1547634096,_binary '__ci_last_regenerate|i:1547633740;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('fsv0dqj2lk5300u94rjal3hqghqq33eg','127.0.0.1',1547634660,_binary '__ci_last_regenerate|i:1547634117;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('4suhkod409t29sg4r5kp7sskpnmfqi98','127.0.0.1',1547635021,_binary '__ci_last_regenerate|i:1547634663;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('rrtcduv2j9mc6vq0ufr9pkjoc3gac4ib','127.0.0.1',1547635501,_binary '__ci_last_regenerate|i:1547635030;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('qbcj2vegaue4f5bqgjfim2jru6sr4r60','127.0.0.1',1547635809,_binary '__ci_last_regenerate|i:1547635511;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('2pqj7c1t2978b0ph9t6i8hlcp94mkf3b','127.0.0.1',1547636536,_binary '__ci_last_regenerate|i:1547635813;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('04mm3abe4ifr2n41cr2a2eb42lvk4q5q','127.0.0.1',1547637972,_binary '__ci_last_regenerate|i:1547636564;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('dlhmn6g1urd0sr6v30d9bilkr2uv1o6m','127.0.0.1',1547641650,_binary '__ci_last_regenerate|i:1547637972;user_id|s:1:\"1\";semester_id|s:1:\"1\";flash_message|s:25:\"Report Saved Successfully\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('eptr6mais7u8tqk9tpouu7t2anvfgsah','127.0.0.1',1547641955,_binary '__ci_last_regenerate|i:1547641650;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('6p58s8jld6e258s14jvqpcldjaa4l4r2','127.0.0.1',1547642669,_binary '__ci_last_regenerate|i:1547641982;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('0eqss9ch9m51i048s8ak5m8hp23gulpv','127.0.0.1',1547644963,_binary '__ci_last_regenerate|i:1547644129;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('l8j8biipprkg778na0icg1kol23end61','127.0.0.1',1547647037,_binary '__ci_last_regenerate|i:1547644963;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('o666i2bjv9cofrvk19brsg81p6qikgbr','127.0.0.1',1547680737,_binary '__ci_last_regenerate|i:1547676771;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('a6om9lfd3ekuvmc4mh3daasm7712ceil','127.0.0.1',1547681145,_binary '__ci_last_regenerate|i:1547680744;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('6cnsadd6seah9sk9hgtp7bva9dioi8dm','127.0.0.1',1547682382,_binary '__ci_last_regenerate|i:1547681292;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('vtuufhskk6lvdshf9gfqpo1hpv009dl4','127.0.0.1',1547683301,_binary '__ci_last_regenerate|i:1547682419;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('gc2g0hlo77cr4psdtosao0dv67ai2pe7','127.0.0.1',1547683622,_binary '__ci_last_regenerate|i:1547683330;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('24clqouofpkav6j5176bj6d2kd62bl47','127.0.0.1',1547684586,_binary '__ci_last_regenerate|i:1547683659;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('ruknqm2ionsdenft6e5ls0ufs121jpui','127.0.0.1',1547685235,_binary '__ci_last_regenerate|i:1547684633;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('rm3p8qek8koblsfg2qpsk582ee13t949','127.0.0.1',1547685654,_binary '__ci_last_regenerate|i:1547685238;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('2g8pfm2se9608efm9me3jujg175dadme','127.0.0.1',1547686801,_binary '__ci_last_regenerate|i:1547685661;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('qoipl8639o64lqq000cdiddfojrj25lk','127.0.0.1',1547687225,_binary '__ci_last_regenerate|i:1547686813;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('d62rapjalg6lr2p7dg8fvljnovge1494','127.0.0.1',1547687986,_binary '__ci_last_regenerate|i:1547687250;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('mg885ag8i1f5t2fkd6ttb92qd4ln0mu0','127.0.0.1',1547688469,_binary '__ci_last_regenerate|i:1547688006;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('4q3198kngdcj7t60bo0dl0ro9fvdkglg','127.0.0.1',1547688957,_binary '__ci_last_regenerate|i:1547688501;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('sf665oqhiu3578rln2rnatn5qgdiquqg','127.0.0.1',1547689384,_binary '__ci_last_regenerate|i:1547689007;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('hhu18hgm08si3r10l9ubqsh3cgk02u5v','127.0.0.1',1547689689,_binary '__ci_last_regenerate|i:1547689402;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('qii9atuldpb53k1tn8em65m2q67otk83','127.0.0.1',1547690702,_binary '__ci_last_regenerate|i:1547689720;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('64k2kbjoq8gu1tdh5p16q2vgoipleb02','127.0.0.1',1547691048,_binary '__ci_last_regenerate|i:1547690706;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('k1emh81kf909ceosql3mr10esee6161i','127.0.0.1',1547691474,_binary '__ci_last_regenerate|i:1547691058;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('60u9e0tprmafa8bvlrdljadlr0ro058h','127.0.0.1',1547691947,_binary '__ci_last_regenerate|i:1547691496;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('aarpt36l9c4224bli7fd2ne8pmq3hjh3','127.0.0.1',1547692238,_binary '__ci_last_regenerate|i:1547691947;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('f7hhov7url85t4rju58rfqlbsjcdhd8s','127.0.0.1',1547692861,_binary '__ci_last_regenerate|i:1547692248;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('74hvae5l7km1ksqu10e28uhb2svphhld','127.0.0.1',1547693170,_binary '__ci_last_regenerate|i:1547692878;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('af5iv2hl31fiuqus2hcshpet51aibduq','127.0.0.1',1547693471,_binary '__ci_last_regenerate|i:1547693180;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('gi9pf3risa5ohrivu71lqcs1u5ktbb34','127.0.0.1',1547694036,_binary '__ci_last_regenerate|i:1547693491;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('gclif310ikd3gnknul7am2pnaelb2o1r','127.0.0.1',1547698724,_binary '__ci_last_regenerate|i:1547694046;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('2gug810bglehp18thflneiisd85tpg9b','127.0.0.1',1547721445,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547718032;semester_id|s:1:\"1\";'),('ksla9l7uota7nt3vlebpek220dvdbggf','127.0.0.1',1547723413,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547721488;semester_id|s:1:\"1\";'),('ra6bhfg4o814ffmc9h4gtqlea20t5e1a','127.0.0.1',1547723904,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547723505;semester_id|s:1:\"1\";'),('dou6hiqb0thbs3v61so4qp0n95pfmps0','127.0.0.1',1547724230,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547723927;semester_id|s:1:\"1\";'),('tef7hnus8cgn8jd8s9krlvtbmjevb8tp','127.0.0.1',1547724534,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547724231;semester_id|s:1:\"1\";flash_message|s:18:\"Successfully Saved\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"new\";s:12:\"flash_status\";s:3:\"new\";s:10:\"flash_keep\";s:3:\"new\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('kphbntpi1q4tisba6v4g4uierp9up351','127.0.0.1',1547724829,_binary 'user_id|s:1:\"1\";__ci_last_regenerate|i:1547724535;semester_id|s:1:\"1\";'),('vp9flfd62gbcjckmh0i2196mf795cinv','127.0.0.1',1547725988,_binary '__ci_last_regenerate|i:1547725247;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('lj5b6eio373or3hjlmuah7ssi4k726bg','127.0.0.1',1547726842,_binary '__ci_last_regenerate|i:1547725991;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('dv2keqr6c7kh1p1hjpkjo8fkifolg0ur','127.0.0.1',1547727987,_binary '__ci_last_regenerate|i:1547727683;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('h9ccuidd3rmj81q71edfs6jslgpdsk14','127.0.0.1',1547728300,_binary '__ci_last_regenerate|i:1547727988;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('7u3lo624ud101b977gns3b9ou0nsc125','127.0.0.1',1547728300,_binary '__ci_last_regenerate|i:1547728290;user_id|s:1:\"1\";semester_id|s:1:\"1\";flash_message|s:18:\"Successfully Added\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"old\";s:12:\"flash_status\";s:3:\"old\";s:10:\"flash_keep\";s:3:\"old\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('7htrfe4jjrdf3kbr9l1rhm8ook4hv689','127.0.0.1',1547728605,_binary '__ci_last_regenerate|i:1547728305;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('pgvhansv5ptv4scnb01q2j1ma364j7ab','127.0.0.1',1547729116,_binary '__ci_last_regenerate|i:1547728612;user_id|s:1:\"1\";semester_id|s:1:\"1\";elFinderCaches|a:4:{s:8:\"_optsMD5\";s:32:\"d4b3be3021e851b7b3efa20ed5c54363\";s:3:\"l1_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"9176b4b8629d0f64953e604054974ba3\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547390518;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l1_Lw\";s:4:\"name\";s:7:\"General\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l1_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l2_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"22e9ed7b28c42eff2cc2464afdd916cb\";a:12:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547467628;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l2_Lw\";s:4:\"name\";s:9:\"Documents\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l2_\";s:6:\"locked\";i:1;s:4:\"dirs\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l3_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"72c0c5e97d5b2aa8f15e22ba789b7539\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547391074;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l3_Lw\";s:4:\"name\";s:8:\"My files\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l3_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}}elFinderCaches:LAST_ACTIVITY|i:1547728613;'),('qqsdpk2oefcvphq3362eti4bss87875k','127.0.0.1',1547729116,_binary '__ci_last_regenerate|i:1547729116;user_id|s:1:\"1\";semester_id|s:1:\"1\";elFinderCaches|a:4:{s:8:\"_optsMD5\";s:32:\"d4b3be3021e851b7b3efa20ed5c54363\";s:3:\"l1_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"9176b4b8629d0f64953e604054974ba3\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547390518;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l1_Lw\";s:4:\"name\";s:7:\"General\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l1_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l2_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"22e9ed7b28c42eff2cc2464afdd916cb\";a:12:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547467628;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l2_Lw\";s:4:\"name\";s:9:\"Documents\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l2_\";s:6:\"locked\";i:1;s:4:\"dirs\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l3_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"72c0c5e97d5b2aa8f15e22ba789b7539\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547391074;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l3_Lw\";s:4:\"name\";s:8:\"My files\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l3_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}}elFinderCaches:LAST_ACTIVITY|i:1547728613;'),('d898qnb6s91k2l75j96sa29i2mq4sfte','127.0.0.1',1547734210,_binary '__ci_last_regenerate|i:1547729137;user_id|s:1:\"1\";semester_id|s:1:\"1\";elFinderCaches|a:4:{s:8:\"_optsMD5\";s:32:\"d4b3be3021e851b7b3efa20ed5c54363\";s:3:\"l1_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"9176b4b8629d0f64953e604054974ba3\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547390518;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l1_Lw\";s:4:\"name\";s:7:\"General\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l1_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l2_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"22e9ed7b28c42eff2cc2464afdd916cb\";a:12:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547467628;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l2_Lw\";s:4:\"name\";s:9:\"Documents\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l2_\";s:6:\"locked\";i:1;s:4:\"dirs\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l3_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"72c0c5e97d5b2aa8f15e22ba789b7539\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547391074;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l3_Lw\";s:4:\"name\";s:8:\"My files\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l3_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}}elFinderCaches:LAST_ACTIVITY|i:1547728613;'),('n6luskj10kb3despgogg5r2m1lfbfr5i','127.0.0.1',1547734629,_binary '__ci_last_regenerate|i:1547734236;user_id|s:1:\"1\";semester_id|s:1:\"1\";elFinderCaches|a:4:{s:8:\"_optsMD5\";s:32:\"d4b3be3021e851b7b3efa20ed5c54363\";s:3:\"l1_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"9176b4b8629d0f64953e604054974ba3\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547390518;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l1_Lw\";s:4:\"name\";s:7:\"General\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l1_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l2_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"22e9ed7b28c42eff2cc2464afdd916cb\";a:12:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547467628;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l2_Lw\";s:4:\"name\";s:9:\"Documents\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l2_\";s:6:\"locked\";i:1;s:4:\"dirs\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}s:3:\"l3_\";a:2:{s:8:\"rootstat\";a:1:{s:32:\"72c0c5e97d5b2aa8f15e22ba789b7539\";a:11:{s:7:\"isowner\";b:0;s:2:\"ts\";i:1547391074;s:4:\"mime\";s:9:\"directory\";s:4:\"read\";i:1;s:5:\"write\";i:1;s:4:\"size\";i:0;s:4:\"hash\";s:5:\"l3_Lw\";s:4:\"name\";s:8:\"My files\";s:6:\"csscls\";s:26:\"elfinder-navbar-root-local\";s:8:\"volumeid\";s:3:\"l3_\";s:6:\"locked\";i:1;}}s:15:\"ARCHIVERS_CACHE\";a:2:{s:6:\"create\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-cf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-czf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-cJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:3:\"zip\";s:4:\"argc\";s:3:\"-r9\";s:3:\"ext\";s:3:\"zip\";}}s:7:\"extract\";a:5:{s:17:\"application/x-tar\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:3:\"-xf\";s:3:\"ext\";s:3:\"tar\";}s:18:\"application/x-gzip\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xzf\";s:3:\"ext\";s:3:\"tgz\";}s:19:\"application/x-bzip2\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xjf\";s:3:\"ext\";s:3:\"tbz\";}s:16:\"application/x-xz\";a:3:{s:3:\"cmd\";s:3:\"tar\";s:4:\"argc\";s:4:\"-xJf\";s:3:\"ext\";s:2:\"xz\";}s:15:\"application/zip\";a:3:{s:3:\"cmd\";s:5:\"unzip\";s:4:\"argc\";s:0:\"\";s:3:\"ext\";s:3:\"zip\";}}}}}elFinderCaches:LAST_ACTIVITY|i:1547728613;'),('mfs6l2ff5qcpve4p9jq6qdiruhu9gfau','127.0.0.1',1547749577,_binary '__ci_last_regenerate|i:1547734630;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('ccnlkm642tmjlgjjeslg6gao122qgdpo','127.0.0.1',1547856609,_binary '__ci_last_regenerate|i:1547855941;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('gso5ej34l9kurdaeft0ajorktcsh246o','127.0.0.1',1547856954,_binary '__ci_last_regenerate|i:1547856609;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('lj57jtp1ff2c52ihdkc1hpsgtgc1du3i','127.0.0.1',1547857297,_binary '__ci_last_regenerate|i:1547857006;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('3pkj792v4io2inm71qgjvc5qtd3cijrq','127.0.0.1',1547857733,_binary '__ci_last_regenerate|i:1547857312;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('024njg361pr3qcs4js6tl1vkik0pctq4','127.0.0.1',1547858038,_binary '__ci_last_regenerate|i:1547857737;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('p729rehr0m8kv0q8bb6jl3m4lq14io67','127.0.0.1',1547858770,_binary '__ci_last_regenerate|i:1547858049;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('sij9dlboi7okj8ojpb61hk2qppvdpqf7','127.0.0.1',1547867716,_binary '__ci_last_regenerate|i:1547858807;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('cn2i0q8fia8ags1ho95lcc01csq9k4uc','127.0.0.1',1547902012,_binary '__ci_last_regenerate|i:1547896822;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('e02e8vptq7cbjn220eu51gfgb5n19o1e','127.0.0.1',1547967713,_binary '__ci_last_regenerate|i:1547966022;user_id|s:1:\"1\";semester_id|s:1:\"1\";flash_message|s:18:\"Successfully Saved\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"old\";s:12:\"flash_status\";s:3:\"old\";s:10:\"flash_keep\";s:3:\"old\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('t7a29ujqmop90hpuo9568ev8gh44njnm','127.0.0.1',1547969398,_binary '__ci_last_regenerate|i:1547967907;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('1q5v0gnrs6n7othb2p1ijjldr5hqo0fp','127.0.0.1',1547988159,_binary '__ci_last_regenerate|i:1547969432;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('7n3eulnp1nstopj8csk9n3352hpvmo5s','127.0.0.1',1547991781,_binary '__ci_last_regenerate|i:1547991486;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('o2l43n2cgjc9jvb08pcum08oq7frmu9u','127.0.0.1',1547992216,_binary '__ci_last_regenerate|i:1547991830;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('bk52fnhhgn5kqpehppii5t1dsp8l1dn3','127.0.0.1',1548147158,_binary '__ci_last_regenerate|i:1548147158;'),('va9r6igsomqb5d0i5ug0s8hhl88u0ktk','127.0.0.1',1548148031,_binary '__ci_last_regenerate|i:1548147159;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('muopj77em5no5i18pcg1f0tdve809210','127.0.0.1',1548148294,_binary '__ci_last_regenerate|i:1548148033;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('jqsg0dchhufreni5ktps1dogp27ght8a','127.0.0.1',1548150115,_binary '__ci_last_regenerate|i:1548148337;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('2u9rt4ce40nd3dlj7pukfe7kti30e38g','127.0.0.1',1548150936,_binary '__ci_last_regenerate|i:1548150145;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('fk2qqvso78h4uha9cki61eo6kopp96jj','127.0.0.1',1548573923,_binary '__ci_last_regenerate|i:1548573922;'),('njlcsmgun6f4hen0ai0h5cbdmsgpd649','127.0.0.1',1548576881,_binary '__ci_last_regenerate|i:1548573922;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('flh8usvqaudokr2hebgs6me1t5ovg5ee','127.0.0.1',1548576942,_binary '__ci_last_regenerate|i:1548576917;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('4qibodn2h7rcd2j5vb08vqc6opr3kifv','127.0.0.1',1548576966,_binary '__ci_last_regenerate|i:1548576966;go_to|s:20:\"/index.php/dashboard\";'),('e3a7vtapka3tfj0b53cnol0p9pqvdrci','127.0.0.1',1548675562,_binary '__ci_last_regenerate|i:1548675131;user_id|s:2:\"10\";semester_id|s:1:\"1\";'),('vn7fqiid7tquil379rr5ca2v58ia6e5e','127.0.0.1',1548675597,_binary '__ci_last_regenerate|i:1548675597;user_id|s:2:\"10\";semester_id|s:1:\"1\";'),('nv0588118ato3sojfqrqtrmtctof1ei2','127.0.0.1',1548761190,_binary '__ci_last_regenerate|i:1548759069;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('55k88qa32si0cguuq81doee2tadeiigc','127.0.0.1',1548766750,_binary '__ci_last_regenerate|i:1548764020;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('ua11r3memvu394a07ot54spaamsona04','127.0.0.1',1548766405,_binary '__ci_last_regenerate|i:1548766405;'),('880rkb70qjkc4go06v7lb3s7752lamc0','127.0.0.1',1548766828,_binary '__ci_last_regenerate|i:1548766575;user_id|s:1:\"1\";semester_id|s:1:\"1\";eaa_admin|b:1;'),('32c61k2l5op8s01mqs9iag5erjtduuif','127.0.0.1',1548766771,_binary '__ci_last_regenerate|i:1548766770;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('lni84cpih4oopmo6lj0ml6p31hk8dubn','127.0.0.1',1548767149,_binary '__ci_last_regenerate|i:1548766887;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('4p8fdc1cjsk4nks6d88blo3iuih95ebb','127.0.0.1',1548767862,_binary '__ci_last_regenerate|i:1548767201;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('c4oel33c36gc1marb8mpeqi2gkg1980o','127.0.0.1',1548768255,_binary '__ci_last_regenerate|i:1548767894;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('hu697qmt03e6o7mktpe6nqemg3ciolrb','127.0.0.1',1548768552,_binary '__ci_last_regenerate|i:1548768301;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('31ajgm92j7f7di5edguk5kcr9p9f2hei','127.0.0.1',1548768992,_binary '__ci_last_regenerate|i:1548768894;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('rdk4nopu4gsgrtvhodu11nnga9v0st70','127.0.0.1',1548769509,_binary '__ci_last_regenerate|i:1548769209;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('2s89hlp3i4e2gi32rj1ki24l90hotpdb','127.0.0.1',1548769991,_binary '__ci_last_regenerate|i:1548769510;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('2jf835eumrobmf743ffu2bip5ba3j027','127.0.0.1',1548770576,_binary '__ci_last_regenerate|i:1548770013;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('tqjee310925ovsphbjq3u9mleuspf13v','127.0.0.1',1548771133,_binary '__ci_last_regenerate|i:1548770604;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('0o3r4dm2i3te89fl0k2qciu1iejq3ahf','127.0.0.1',1548771512,_binary '__ci_last_regenerate|i:1548771153;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('eeea4pj1ctcml8bfq74bsri6n02rptj1','127.0.0.1',1548772315,_binary '__ci_last_regenerate|i:1548771520;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('45kff19aalnnjdo4o34vtn08ih6e1e17','127.0.0.1',1548773569,_binary '__ci_last_regenerate|i:1548772343;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('d276ep3e24opd82q003beonclk8tnjck','127.0.0.1',1548831489,_binary '__ci_last_regenerate|i:1548773591;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('j1smhs5cb6vb3fjrfvsqqsbd5hbpo16l','127.0.0.1',1548832337,_binary '__ci_last_regenerate|i:1548831493;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('apmhvn0fh9ql1k71tqdpbpn4o1npp8c6','127.0.0.1',1548833896,_binary '__ci_last_regenerate|i:1548832385;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('5ppfqcuhidmq48r6jukc6k5a7ugmeo1n','127.0.0.1',1548834410,_binary '__ci_last_regenerate|i:1548833905;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('62p7m332u50pbe9imterdokgnfe02uvg','127.0.0.1',1548836388,_binary '__ci_last_regenerate|i:1548834421;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('b6v8jvtcsfa994ocaeune0nc4ohb18pp','127.0.0.1',1548837025,_binary '__ci_last_regenerate|i:1548836421;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('4l13upsjkdu6nosk8vrf5o40lirg80e2','127.0.0.1',1548837471,_binary '__ci_last_regenerate|i:1548837056;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('l59t30ip0vi8i6t16smu67vtl6mmdcic','127.0.0.1',1548838504,_binary '__ci_last_regenerate|i:1548837495;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('kd11l7902et8rqub236eqhv1f88kocji','127.0.0.1',1548839010,_binary '__ci_last_regenerate|i:1548838519;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('5842plvlqvqbpc09ssi0s3coq0cot4d7','127.0.0.1',1548839782,_binary '__ci_last_regenerate|i:1548839070;user_id|s:1:\"1\";semester_id|s:1:\"1\";'),('ooipdt48h8e7gd8vp6tci2psj7vav5e5','127.0.0.1',1548840249,_binary '__ci_last_regenerate|i:1548839789;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";'),('vhsk5t09p02gi0ue41kkuq6ve7r7grlh','127.0.0.1',1548840588,_binary '__ci_last_regenerate|i:1548840277;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";flash_message|s:18:\"Successfully Saved\";__ci_vars|a:3:{s:13:\"flash_message\";s:3:\"old\";s:12:\"flash_status\";s:3:\"old\";s:10:\"flash_keep\";s:3:\"old\";}flash_status|s:7:\"success\";flash_keep|b:0;'),('5764v6vtr7jsi71sne3j7jpuiqtbqmsb','127.0.0.1',1548841257,_binary '__ci_last_regenerate|i:1548840600;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";'),('vai7r57qnej70ki92loifu5rnnflcaao','127.0.0.1',1548844372,_binary '__ci_last_regenerate|i:1548841297;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";'),('de3fg7brg1biqnfl4cu80ietdcasupkq','127.0.0.1',1548844733,_binary '__ci_last_regenerate|i:1548844408;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";'),('q82elj7hladv9nt3ftj7s50i8unelu8m','127.0.0.1',1548845276,_binary '__ci_last_regenerate|i:1548844790;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";'),('5lrh96g69agk035p084uu1e84prtkurg','127.0.0.1',1548845837,_binary '__ci_last_regenerate|i:1548845296;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";'),('7luak2vbce072skij27g8s7si37lqd9k','127.0.0.1',1548846549,_binary '__ci_last_regenerate|i:1548845855;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";'),('2tuocf751it2qpfqndk533j5kjnq5ona','127.0.0.1',1548846873,_binary '__ci_last_regenerate|i:1548846572;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";'),('luobpsqvi6n3ube644imla7ahlk1919o','127.0.0.1',1548848419,_binary '__ci_last_regenerate|i:1548846908;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";'),('hh6caep5h5uk4nhdihunhtq1f33jacqv','127.0.0.1',1548848670,_binary '__ci_last_regenerate|i:1548848429;user_id|s:1:\"1\";semester_id|s:1:\"1\";site_lang|s:7:\"english\";');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_active_data`
--

LOCK TABLES `cm_active_data` WRITE;
/*!40000 ALTER TABLE `cm_active_data` DISABLE KEYS */;
INSERT INTO `cm_active_data` VALUES (1,1,1,1,0),(2,1,5,1,0),(3,1,6,2,0),(4,1,8,1,0),(5,2,5,1,0),(6,1,10,1,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_assessment_component`
--

LOCK TABLES `cm_assessment_component` WRITE;
/*!40000 ALTER TABLE `cm_assessment_component` DISABLE KEYS */;
INSERT INTO `cm_assessment_component` VALUES (1,1,'Essay Questions','أسئلة مقالية',0),(2,1,'Multiple Choice','اختيار من متعدد',0),(3,1,'Fill in the Blanks','إملأ الفراغات',0),(4,1,'Matching','التطابق',0),(5,2,'Frequency of Participation','عدد مرات المشاركة',0),(6,2,'Quality of Participation','نوعية المشاركة',0),(7,3,'Essay Questions','اسئلة مقالية',0),(8,3,'Multiple Choice','اختيار من متعدد',0),(9,3,'Fill in the Blanks','إملأ الفراغات',0),(10,3,'Matching','التطابق',0),(11,4,'Essay Questions','اسئلة مقالية',0),(12,4,'Multiple Choice','اختيار من متعدد',0),(13,4,'Fill in the Blanks','إملأ الفراغات',0),(14,4,'Matching','التطابق',0),(15,1,'draw','الرسم',0);
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
-- Table structure for table `cm_assessment_plan`
--

DROP TABLE IF EXISTS `cm_assessment_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_assessment_plan` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name_ar` varchar(45) NOT NULL,
  `name_en` varchar(45) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_assessment_plan`
--

LOCK TABLES `cm_assessment_plan` WRITE;
/*!40000 ALTER TABLE `cm_assessment_plan` DISABLE KEYS */;
INSERT INTO `cm_assessment_plan` VALUES (1,'plan one to take','plan one to take',0),(2,'plan two to take','plan two to take',0);
/*!40000 ALTER TABLE `cm_assessment_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_assessment_plan_map`
--

DROP TABLE IF EXISTS `cm_assessment_plan_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_assessment_plan_map` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `assessment_plan_id` bigint(20) NOT NULL,
  `assessment_method_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_assessment_plan_map`
--

LOCK TABLES `cm_assessment_plan_map` WRITE;
/*!40000 ALTER TABLE `cm_assessment_plan_map` DISABLE KEYS */;
INSERT INTO `cm_assessment_plan_map` VALUES (1,1,1),(2,1,2),(3,1,3),(4,2,1),(5,2,2),(6,2,3);
/*!40000 ALTER TABLE `cm_assessment_plan_map` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_course_assessment_method`
--

LOCK TABLES `cm_course_assessment_method` WRITE;
/*!40000 ALTER TABLE `cm_course_assessment_method` DISABLE KEYS */;
INSERT INTO `cm_course_assessment_method` VALUES (1,6,3,'Assessment method for quiz to be take','Assessment method for quiz to be take'),(2,6,3,'assessment method will be taken as quickly as','assessment method will be taken as quickly as'),(3,6,4,'participate in course that taken','participate in course that taken');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_course_learning_outcome`
--

LOCK TABLES `cm_course_learning_outcome` WRITE;
/*!40000 ALTER TABLE `cm_course_learning_outcome` DISABLE KEYS */;
INSERT INTO `cm_course_learning_outcome` VALUES (1,6,4,1,'knowledge for AI for specific facts','knowledge for AI for specific facts','1.1'),(2,6,5,1,'concepts of AI','concepts of AI','1.2'),(3,6,7,2,'APPLY CONCEPTUAL ','APPLY CONCEPTUAL ','2.1'),(4,6,8,2,'apply procedures','apply procedures','2.2');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_course_learning_outcome_target`
--

LOCK TABLES `cm_course_learning_outcome_target` WRITE;
/*!40000 ALTER TABLE `cm_course_learning_outcome_target` DISABLE KEYS */;
INSERT INTO `cm_course_learning_outcome_target` VALUES (1,1,50.00),(2,2,60.00),(3,3,70.00),(4,4,80.00);
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_course_mapping_matrix`
--

LOCK TABLES `cm_course_mapping_matrix` WRITE;
/*!40000 ALTER TABLE `cm_course_mapping_matrix` DISABLE KEYS */;
INSERT INTO `cm_course_mapping_matrix` VALUES (1,6,1,1,6),(2,6,1,1,7),(3,6,1,1,10),(4,6,1,2,7),(5,6,1,2,8),(6,6,1,2,9),(7,6,1,3,11),(8,6,1,3,12),(9,6,2,1,6),(10,6,2,1,7),(11,6,2,1,8),(12,6,2,1,9),(13,6,2,1,10),(14,6,2,2,6),(15,6,2,2,8),(16,6,2,2,9),(17,6,2,2,10),(18,6,2,3,11),(19,6,2,3,12),(20,6,4,1,6),(21,6,4,1,7),(22,6,4,1,10),(23,6,4,2,7),(24,6,4,2,8),(25,6,4,2,9),(26,6,4,3,11),(27,6,4,3,12);
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
-- Table structure for table `cm_course_matrix`
--

DROP TABLE IF EXISTS `cm_course_matrix`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_course_matrix` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `clo_id` bigint(20) NOT NULL,
  `plo_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_course_matrix`
--

LOCK TABLES `cm_course_matrix` WRITE;
/*!40000 ALTER TABLE `cm_course_matrix` DISABLE KEYS */;
INSERT INTO `cm_course_matrix` VALUES (5,1,4),(6,2,4),(7,3,4),(8,4,4),(9,2,6),(10,3,6),(11,3,8),(12,4,8),(13,3,9),(14,2,10),(15,2,11),(16,3,11),(17,1,12),(18,4,12),(19,1,13),(20,3,13),(21,4,13);
/*!40000 ALTER TABLE `cm_course_matrix` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_course_offered_program`
--

LOCK TABLES `cm_course_offered_program` WRITE;
/*!40000 ALTER TABLE `cm_course_offered_program` DISABLE KEYS */;
INSERT INTO `cm_course_offered_program` VALUES (1,6,5);
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
  `type` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_learning_domain`
--

LOCK TABLES `cm_learning_domain` WRITE;
/*!40000 ALTER TABLE `cm_learning_domain` DISABLE KEYS */;
INSERT INTO `cm_learning_domain` VALUES (1,1,'Knowledge','المعرفة',0,1),(2,2,'Cognitive Skills','المهارات الإدراكية',0,1),(3,3,'Interpersonal Skills and Responsibility','المسؤولية والمهارات الشخصية',0,1),(4,4,'communication,\n                 information technology and numerical skills','والاتصالات وتكنولوجيا المعلومات والمهارات العددية',0,1),(5,5,'Psychomotor Skills','المهارات الحركية',0,1),(6,6,'Knowledge','مهارات معرفية',0,2),(7,7,'Skills','مهارات ذهنية',0,2),(8,8,'Competencies','الكفاءات',0,2),(9,9,'Cognitive Domain (Knowledge)','مهارات معرفية',0,3),(10,10,'Psychomotor Domain (Skills)','المجال النفسي (المهارات)',0,3),(11,11,'Affective Domain (Attitudes)','المجال العاطفي (التصرفات)',0,3);
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_program_assessment_component`
--

LOCK TABLES `cm_program_assessment_component` WRITE;
/*!40000 ALTER TABLE `cm_program_assessment_component` DISABLE KEYS */;
INSERT INTO `cm_program_assessment_component` VALUES (1,1,1,'Essay Questions','أسئلة مقالية'),(2,1,2,'Multiple Choice','اختيار من متعدد'),(3,1,3,'Fill in the Blanks','إملأ الفراغات'),(4,2,5,'Frequency of Participation','عدد مرات المشاركة'),(5,2,6,'Quality of Participation','نوعية المشاركة'),(11,4,5,'Frequency of Participation','عدد مرات المشاركة'),(12,4,6,'Quality of Participation','نوعية المشاركة'),(13,5,7,'Essay Questions','اسئلة مقالية');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_program_assessment_method`
--

LOCK TABLES `cm_program_assessment_method` WRITE;
/*!40000 ALTER TABLE `cm_program_assessment_method` DISABLE KEYS */;
INSERT INTO `cm_program_assessment_method` VALUES (1,1,1),(2,1,2),(3,5,1),(4,5,2),(5,5,3),(6,5,4),(7,1,3),(8,1,4);
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
-- Table structure for table `cm_program_domain`
--

DROP TABLE IF EXISTS `cm_program_domain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_program_domain` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `program_id` bigint(20) NOT NULL DEFAULT '0',
  `domain_type` int(11) NOT NULL DEFAULT '0',
  `semester_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_program_domain`
--

LOCK TABLES `cm_program_domain` WRITE;
/*!40000 ALTER TABLE `cm_program_domain` DISABLE KEYS */;
INSERT INTO `cm_program_domain` VALUES (1,1,1,1),(2,5,1,1);
/*!40000 ALTER TABLE `cm_program_domain` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_program_learning_outcome`
--

LOCK TABLES `cm_program_learning_outcome` WRITE;
/*!40000 ALTER TABLE `cm_program_learning_outcome` DISABLE KEYS */;
INSERT INTO `cm_program_learning_outcome` VALUES (1,1,1,1,'knowledge of specific facts.','knowledge of specific facts.','1'),(2,1,2,1,'knowledge of concepts, principles and theories.','knowledge of concepts, principles and theories.','2'),(3,1,3,1,'knowledge of procedures.','knowledge of procedures.','3'),(4,1,1,5,'knowledge of specific facts.','knowledge of specific facts.','1'),(5,1,2,5,'knowledge of concepts, principles and theories.','knowledge of concepts, principles and theories.','2'),(6,1,3,5,'knowledge of procedures.','knowledge of procedures.','3'),(7,2,4,5,'apply conceptual understanding of concepts, principles, theories.','apply conceptual understanding of concepts, principles, theories.','1'),(8,2,5,5,'apply procedures involved in critical thinking and creative problem solving, both when asked to do so, and when faced with unanticipated new situations.','apply procedures involved in critical thinking and creative problem solving, both when asked to do so, and when faced with unanticipated new situations.','2'),(9,2,6,5,'investigate issues and problems in a field of study using a range of sources and draw valid conclusions.','investigate issues and problems in a field of study using a range of sources and draw valid conclusions.','3'),(10,3,7,5,'take responsibility for their own learning and continuing personal and professional development.','take responsibility for their own learning and continuing personal and professional development.','1'),(11,3,8,5,'work effectively in groups and exercise leadership when appropriate.','work effectively in groups and exercise leadership when appropriate.','2'),(12,3,9,5,'act responsibly in personal and professional relationships.','act responsibly in personal and professional relationships.','3'),(13,3,10,5,'act ethically and consistently with high moral standards in personal and public forums.','act ethically and consistently with high moral standards in personal and public forums.','4'),(14,4,11,5,'communicate effectively in oral and written form.','communicate effectively in oral and written form.','2'),(15,2,4,1,'apply conceptual understanding of concepts, principles, theories.','apply conceptual understanding of concepts, principles, theories.','3'),(16,2,5,1,'apply procedures involved in critical thinking and creative problem solving, both when asked to do so, and when faced with unanticipated new situations.','apply procedures involved in critical thinking and creative problem solving, both when asked to do so, and when faced with unanticipated new situations.','3'),(17,2,6,1,'investigate issues and problems in a field of study using a range of sources and draw valid conclusions.','investigate issues and problems in a field of study using a range of sources and draw valid conclusions.','3');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_program_learning_outcome_target`
--

LOCK TABLES `cm_program_learning_outcome_target` WRITE;
/*!40000 ALTER TABLE `cm_program_learning_outcome_target` DISABLE KEYS */;
INSERT INTO `cm_program_learning_outcome_target` VALUES (1,4,50.00),(2,5,50.00),(3,6,60.00),(4,7,110.00),(5,8,90.00),(6,9,80.00);
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
  `ipa` enum('i','a','m','p') NOT NULL DEFAULT 'i',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_program_mapping_matrix`
--

LOCK TABLES `cm_program_mapping_matrix` WRITE;
/*!40000 ALTER TABLE `cm_program_mapping_matrix` DISABLE KEYS */;
INSERT INTO `cm_program_mapping_matrix` VALUES (1,5,1,1,'a'),(2,5,6,1,'i'),(3,5,8,1,'i'),(4,5,1,2,'i'),(5,5,6,2,'m'),(6,5,8,2,'m'),(7,5,1,3,'a'),(8,5,6,3,'a'),(9,5,8,3,'p'),(10,5,1,4,'a'),(11,5,6,4,'m'),(12,5,8,4,'p'),(13,5,1,5,'p'),(14,5,6,5,'p'),(15,5,8,5,'m'),(16,5,1,6,'m'),(17,5,6,6,'p'),(18,5,8,6,'m');
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
  `log_ipa` enum('i','a','m','p') NOT NULL DEFAULT 'i',
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
-- Table structure for table `cm_program_x_matrix`
--

DROP TABLE IF EXISTS `cm_program_x_matrix`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_program_x_matrix` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `program_id` bigint(20) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `program_learning_outcome_id` bigint(20) NOT NULL,
  `xmatrix` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_program_x_matrix`
--

LOCK TABLES `cm_program_x_matrix` WRITE;
/*!40000 ALTER TABLE `cm_program_x_matrix` DISABLE KEYS */;
INSERT INTO `cm_program_x_matrix` VALUES (45,5,8,4,1),(46,5,8,5,1),(47,5,8,6,1),(48,5,8,7,1),(49,5,8,8,1),(50,5,8,9,1),(51,5,8,10,1),(52,5,8,11,1),(53,5,1,4,1),(54,5,6,5,1),(55,5,6,6,1),(56,5,6,7,1),(57,5,6,8,1),(58,5,6,9,1);
/*!40000 ALTER TABLE `cm_program_x_matrix` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_program_x_matrix_log`
--

DROP TABLE IF EXISTS `cm_program_x_matrix_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_program_x_matrix_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `log_program_id` bigint(20) NOT NULL,
  `log_course_id` bigint(20) NOT NULL,
  `log_program_learning_outcome_id` bigint(20) NOT NULL,
  `log_xmatrix` tinyint(1) NOT NULL,
  `semester_id` bigint(20) NOT NULL,
  `log_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_program_x_matrix_log`
--

LOCK TABLES `cm_program_x_matrix_log` WRITE;
/*!40000 ALTER TABLE `cm_program_x_matrix_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_program_x_matrix_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_program_x_matrix_method`
--

DROP TABLE IF EXISTS `cm_program_x_matrix_method`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_program_x_matrix_method` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `program_id` bigint(20) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `assessment_method_id` bigint(20) NOT NULL,
  `program_learning_outcome_id` bigint(20) NOT NULL,
  `value` float(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_program_x_matrix_method`
--

LOCK TABLES `cm_program_x_matrix_method` WRITE;
/*!40000 ALTER TABLE `cm_program_x_matrix_method` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_program_x_matrix_method` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_program_x_matrix_method_log`
--

DROP TABLE IF EXISTS `cm_program_x_matrix_method_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_program_x_matrix_method_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `log_program_id` bigint(20) NOT NULL,
  `log_course_id` bigint(20) NOT NULL,
  `log_assessment_method_id` bigint(20) NOT NULL,
  `log_program_learning_outcome_id` bigint(20) NOT NULL,
  `semester_id` bigint(20) NOT NULL,
  `log_id` bigint(20) NOT NULL,
  `log_value` float(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_program_x_matrix_method_log`
--

LOCK TABLES `cm_program_x_matrix_method_log` WRITE;
/*!40000 ALTER TABLE `cm_program_x_matrix_method_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `cm_program_x_matrix_method_log` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_section_mapping_question`
--

LOCK TABLES `cm_section_mapping_question` WRITE;
/*!40000 ALTER TABLE `cm_section_mapping_question` DISABLE KEYS */;
INSERT INTO `cm_section_mapping_question` VALUES (2,1,1,60,'skill 1 to take from course','[2]'),(3,1,1,80,'skills to workout on multi course','[2]'),(4,1,2,90,'need to take as quick as','[2]'),(5,1,2,100,'i cant take it because a lot of things','[1,2]'),(6,1,3,120,'can improve yourself in course that your taken','[1,2]');
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_section_student_assessment`
--

LOCK TABLES `cm_section_student_assessment` WRITE;
/*!40000 ALTER TABLE `cm_section_student_assessment` DISABLE KEYS */;
INSERT INTO `cm_section_student_assessment` VALUES (1,1,2,2,60.00),(2,1,2,3,70.00),(3,1,3,2,60.00),(4,1,3,3,70.00),(5,1,4,2,40.00),(6,1,4,3,30.00),(7,1,2,4,60.00),(8,1,2,5,30.00),(9,1,3,4,80.00),(10,1,3,5,60.00),(11,1,4,4,40.00),(12,1,4,5,70.00),(13,1,2,6,100.00),(14,1,3,6,60.00),(15,1,4,6,80.00);
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
  `integration_id` varchar(100) NOT NULL DEFAULT '0',
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `college`
--

LOCK TABLES `college` WRITE;
/*!40000 ALTER TABLE `college` DISABLE KEYS */;
INSERT INTO `college` VALUES (1,'0',2,0,'Al Huson University College','كلية الحصن الجامعية',500.00,500.00,'to grow up and make engineering number 1 in north sector','النهوض في الكلية و جعلها الاولى على الشمال','to make Al huson college number one in irbid collegees','جعل كلية الحصن الاولى في اربد'),(2,'0',3,0,'prince ghazi college for information technology','كلية اﻷمير غازي لتكنولوجيا المعلومات',400.00,400.00,'','','',''),(3,'0',4,0,'press college Saud college ','كلية الأعلام جامعة الملك سعود',213.00,213.00,'','','',''),(4,'0',4,0,'pharmacy college','كلية الصيدلة ',300.00,300.00,'','','','');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `college_goal`
--

LOCK TABLES `college_goal` WRITE;
/*!40000 ALTER TABLE `college_goal` DISABLE KEYS */;
INSERT INTO `college_goal` VALUES (1,1,'goal 1 for huson college','الهدف الاول لكلية الحصن',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `college_objective`
--

LOCK TABLES `college_objective` WRITE;
/*!40000 ALTER TABLE `college_objective` DISABLE KEYS */;
INSERT INTO `college_objective` VALUES (1,1,'to make collge biger and make new building','لجعل الكلية اكبر من خلال بناء ابنية جديدة',0);
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
  KEY `course_department_id_index` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
INSERT INTO `course` VALUES (1,'0',1,0,'theoretical','introduction to computer science','مقدمة الى تكنولوجيا المعلومات','1','1'),(2,'0',9,0,'theoretical','statistics','الاحصاءات','2','2'),(3,'0',11,0,'theoretical','medicine reports','تقارير اﻷدوية','3','3'),(4,'0',10,0,'theoretical','logic','المنطق','4','4'),(5,'0',12,0,'theoretical','press 1','الصحافة 1','5','5'),(6,'0',1,0,'theoretical','AI','الذكاء اﻷصناعي','6','6'),(7,'0',9,0,'theoretical','liquid analysis','تحليل السوائل','7','7'),(8,'0',1,0,'practical','java','جافا','8','8'),(9,'0',9,0,'practical','soil analysis','تحليل التربة','9','9');
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
  `integration_id` varchar(100) NOT NULL DEFAULT '0',
  `course_id` bigint(20) NOT NULL,
  `semester_id` bigint(20) NOT NULL,
  `campus_id` bigint(20) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `section_no` varchar(128) NOT NULL DEFAULT '',
  `extra_params` text,
  `room_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_section_course_id_index` (`course_id`),
  KEY `course_section_semester_id_index` (`semester_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_section`
--

LOCK TABLES `course_section` WRITE;
/*!40000 ALTER TABLE `course_section` DISABLE KEYS */;
INSERT INTO `course_section` VALUES (1,'0',6,1,2,0,'33','{\"location\":\"khawrzme\",\"schedule\":{\"sunday\":{\"from\":\"1:30 PM\",\"to\":\"3:30 PM\"},\"tuesday\":{\"from\":\"3:35 PM\",\"to\":\"3:35 PM\"},\"thursday\":{\"from\":\"3:35 PM\",\"to\":\"3:35 PM\"}}}',0),(2,'0',6,1,2,0,'44','{\"location\":\"old building\",\"schedule\":{\"sunday\":{\"from\":\"3:45 PM\",\"to\":\"3:45 PM\"},\"tuesday\":{\"from\":\"3:45 PM\",\"to\":\"3:45 PM\"},\"thursday\":{\"from\":\"3:45 PM\",\"to\":\"3:45 PM\"}}}',0),(3,'0',1,1,2,0,'1','{\"location\":\"old building\",\"schedule\":{\"sunday\":{\"from\":\"3:50 PM\",\"to\":\"3:50 PM\"},\"tuesday\":{\"from\":\"3:50 PM\",\"to\":\"3:50 PM\"},\"thursday\":{\"from\":\"3:50 PM\",\"to\":\"3:50 PM\"}}}',0),(4,'0',8,1,2,0,'44','{\"location\":\"old building\",\"schedule\":{\"sunday\":{\"from\":\"3:55 PM\",\"to\":\"3:55 PM\"},\"tuesday\":{\"from\":\"3:55 PM\",\"to\":\"3:55 PM\"},\"wednesday\":{\"from\":\"3:55 PM\",\"to\":\"3:55 PM\"}}}',0),(5,'0',9,1,1,0,'33','{\"location\":\"old building\",\"schedule\":{\"sunday\":{\"from\":\"3:55 PM\",\"to\":\"3:55 PM\"},\"monday\":{\"from\":\"3:55 PM\",\"to\":\"3:55 PM\"},\"tuesday\":{\"from\":\"3:55 PM\",\"to\":\"3:55 PM\"}}}',0),(6,'0',3,1,1,0,'33','{\"location\":\"erewrew\",\"schedule\":{\"saturday\":{\"from\":\"8:50 PM\",\"to\":\"8:50 PM\"},\"sunday\":{\"from\":\"8:50 PM\",\"to\":\"8:50 PM\"}}}',0),(7,'0',5,1,2,0,'66','{\"location\":\"\",\"schedule\":{\"sunday\":{\"from\":\"4:50 PM\",\"to\":\"4:50 PM\"},\"monday\":{\"from\":\"4:50 PM\",\"to\":\"4:50 PM\"}}}',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_section_student`
--

LOCK TABLES `course_section_student` WRITE;
/*!40000 ALTER TABLE `course_section_student` DISABLE KEYS */;
INSERT INTO `course_section_student` VALUES (1,1,2),(2,1,3),(3,1,4),(4,2,2),(5,2,4),(6,2,8),(7,3,3),(8,3,4),(9,3,6),(10,3,8),(11,4,3),(12,4,2),(13,4,6),(14,4,7),(15,4,5),(16,5,2),(17,5,5),(18,5,6),(19,5,7),(20,6,3),(21,6,2),(22,7,2),(23,7,4),(24,7,7);
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_section_teacher`
--

LOCK TABLES `course_section_teacher` WRITE;
/*!40000 ALTER TABLE `course_section_teacher` DISABLE KEYS */;
INSERT INTO `course_section_teacher` VALUES (1,1,15),(2,1,13),(3,2,11),(4,2,10),(5,2,15),(6,3,11),(7,3,10),(8,3,13),(9,3,15),(10,4,10),(11,4,11),(12,4,13),(13,5,11),(14,5,14),(15,5,16),(16,5,19),(17,6,10),(18,6,12),(19,7,15),(20,7,12);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cron_job`
--

LOCK TABLES `cron_job` WRITE;
/*!40000 ALTER TABLE `cron_job` DISABLE KEYS */;
INSERT INTO `cron_job` VALUES (1,1,'strategic_planning index',1,'2019-01-12 04:56:17',0,'0000-00-00 00:00:00',3);
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
  `integration_id` varchar(100) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `name_en` varchar(255) NOT NULL DEFAULT '',
  `name_ar` varchar(255) NOT NULL DEFAULT '',
  `is_undergraduate` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `degree`
--

LOCK TABLES `degree` WRITE;
/*!40000 ALTER TABLE `degree` DISABLE KEYS */;
INSERT INTO `degree` VALUES (1,'0',1,'Degree for First year ','الدرجة للسنة الدراسية  اﻷولى',1),(2,'0',1,'master Degree','درجة ماجستير',4),(3,'0',1,'PHd Degree','درجة الدكتوراة',5),(4,'0',1,'Degree for second year Bachelor','درجة  السنة الدراسية الثانية بكالوريوس',1),(5,'0',0,'computer science degree','درجة علوم الحاسوب',1),(6,'0',0,'Engineering Degree','شهادة الهندسة ',1),(7,'0',0,'Pharmacy PHD Degree','شهادة دكتوراة الصيدلة',5);
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
  `integration_id` varchar(100) NOT NULL DEFAULT '0',
  `college_id` bigint(20) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `name_en` varchar(255) NOT NULL DEFAULT '',
  `name_ar` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES (1,'0',1,0,'Computer Department','قسم الحاسوب'),(2,'0',1,1,'Management Information System Department','قسم نظم المعلومات اﻷدارية'),(3,'0',1,1,'Mechanical Engineering Department','قسم هندسة الميكانيك'),(4,'0',2,1,'Computer Information System','كلية نظم المعلومات الحاسوبية'),(5,'0',2,1,'Software Engineering','هندسة البرمجيات'),(6,'0',3,1,'Edit and Publish Department','قسم التحرير و النشر'),(7,'0',3,1,'press Department','قسم الصحافة'),(8,'0',4,1,'medicine reports','التقارير الطبية'),(9,'0',1,0,'Engineering Department','قسم الهندسة'),(10,'0',2,0,'Information Technology Department','قسم تكنولوجيا المعلومات'),(11,'0',4,0,'Pharmacy Department in college','قسم الصيدلة في كلية الصيدلة'),(12,'0',3,0,'press and media','الصحافة و اﻷعلام');
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
-- Table structure for table `fp_eva_tab_col`
--

DROP TABLE IF EXISTS `fp_eva_tab_col`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_eva_tab_col` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title_en` tinytext,
  `title_ar` tinytext,
  `eva_tab_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_eva_tab_col`
--

LOCK TABLES `fp_eva_tab_col` WRITE;
/*!40000 ALTER TABLE `fp_eva_tab_col` DISABLE KEYS */;
INSERT INTO `fp_eva_tab_col` VALUES (1,'aaaaaaaaaaaaaaaaa','aaaaaaaaaa',1),(2,'rrrrrrrrrrrrr','rrrrrrrrrrrrr',1);
/*!40000 ALTER TABLE `fp_eva_tab_col` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_eva_tab_row`
--

DROP TABLE IF EXISTS `fp_eva_tab_row`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_eva_tab_row` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title_en` tinytext,
  `title_ar` tinytext,
  `eva_tab_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_eva_tab_row`
--

LOCK TABLES `fp_eva_tab_row` WRITE;
/*!40000 ALTER TABLE `fp_eva_tab_row` DISABLE KEYS */;
INSERT INTO `fp_eva_tab_row` VALUES (1,'ffff','ffff',1),(2,'ffffffff','ffffffff',1);
/*!40000 ALTER TABLE `fp_eva_tab_row` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_eva_tabs`
--

DROP TABLE IF EXISTS `fp_eva_tabs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_eva_tabs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `legend_id` bigint(20) DEFAULT NULL,
  `title_en` tinytext,
  `title_ar` tinytext,
  `points` int(11) DEFAULT NULL,
  `is_delete` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_eva_tabs`
--

LOCK TABLES `fp_eva_tabs` WRITE;
/*!40000 ALTER TABLE `fp_eva_tabs` DISABLE KEYS */;
INSERT INTO `fp_eva_tabs` VALUES (1,2,'sssssssssssss','sssssssssss',50,0);
/*!40000 ALTER TABLE `fp_eva_tabs` ENABLE KEYS */;
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
  `eva_tab_id` bigint(20) DEFAULT NULL,
  `eva_tab_row_id` bigint(20) DEFAULT NULL,
  `eva_tab_col_id` bigint(20) DEFAULT NULL,
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
INSERT INTO `fp_forms` VALUES (1,3,'Appointments as Editor','التعيينات كمحرر','2019-01-10 11:45:22','2019-01-10 11:45:22',0,'appointments_as_editor',0,0),(2,1,'Courses Taught','تدريس المواد الدراسية','2019-01-10 11:45:22','2019-01-10 11:45:22',0,'courses_taught',0,0),(3,3,'Conference Chair Organizer','منظم المؤتمر الرئيسي','2019-01-10 11:45:22','2019-01-10 11:45:22',0,'conference_chair_organizer',0,0),(4,1,'Course Development','تطوير المادة الدراسية','2019-01-10 11:45:22','2019-01-10 11:45:22',0,'course_development',0,0),(5,3,'Session Chair Organizer','منظم الجالسة الرئيسي','2019-01-10 11:45:23','2019-01-10 11:45:23',0,'session_chair_organizer',0,0),(6,1,'Laboratory Course Development','مكتبة تطوير المادة الدراسية','2019-01-10 11:45:23','2019-01-10 11:45:23',0,'laboratory_course_development',0,0),(7,3,'Reviewer','مراجع','2019-01-10 11:45:23','2019-01-10 11:45:23',0,'reviewer',0,0),(8,3,'Professional Committees','اللجان الفنية','2019-01-10 11:45:23','2019-01-10 11:45:23',0,'professional_committees',0,0),(9,3,'Examiner Committees','لجان الامتحانات','2019-01-10 11:45:23','2019-01-10 11:45:23',0,'examiner_committees',0,0),(10,3,'Departmental Committees','لجان الأقسام','2019-01-10 11:45:23','2019-01-10 11:45:23',0,'departmental_committees',0,0),(11,3,'College Committees','لجان الكلية','2019-01-10 11:45:23','2019-01-10 11:45:23',0,'college_committees',0,0),(12,1,'Curricular Revisions','المراجعات المنهجية','2019-01-10 11:45:23','2019-01-10 11:45:23',0,'curricular_revisions',0,0),(13,1,'Ph.D. Dissertations Completed','رسائل الدكتوراة المكتملة','2019-01-10 11:45:23','2019-01-10 11:45:23',0,'phd_dissertations_completed',0,0),(14,1,'MS Thesis Completed','رسائل الماجستير المكتملة','2019-01-10 11:45:23','2019-01-10 11:45:23',0,'ms_thesis_completed',0,0),(15,1,'MS Non-Thesis Completed','رسائل الماجستير غير المكتملة','2019-01-10 11:45:23','2019-01-10 11:45:23',0,'ms_non_thesis_completed',0,0),(16,3,'University Committees','لجان الجامعة','2019-01-10 11:45:23','2019-01-10 11:45:23',0,'university_committees',0,0),(17,3,'Miscellaneous Service Activities','أنشطة الخدمات المتنوعة','2019-01-10 11:45:23','2019-01-10 11:45:23',0,'miscellaneous',0,0),(18,3,'Consulting Activities - Organization Unpaid','الأنشطة الاستشارية - المنظمة بدون أجر','2019-01-10 11:45:23','2019-01-10 11:45:23',0,'organization_unpaid',0,0),(19,3,'Consulting Activities - Organization Service','الأنشطة الاستشارية - خدمة المنظمة','2019-01-10 11:45:23','2019-01-10 11:45:23',0,'organization_service',0,0),(20,3,'Consulting Activities - Professional Testimony','الأنشطة الاستشارية - شهادة مهنية','2019-01-10 11:45:23','2019-01-10 11:45:23',0,'professional_testimony',0,0),(21,3,'Teaching Awards - External','جوائز التدريس - الخارجية','2019-01-10 11:45:23','2019-01-10 11:45:23',0,'teaching_awards_external',0,0),(22,3,'Teaching Awards - Internal','جوائز التدريس - الداخلية','2019-01-10 11:45:23','2019-01-10 11:45:23',0,'teaching_awards_internal',0,0),(23,3,'Research Awards - External','جوائز البحث - الخارجية','2019-01-10 11:45:23','2019-01-10 11:45:23',0,'research_awards_external',0,0),(24,3,'Research Awards - Internal','جوائز البحث - الداخلية','2019-01-10 11:45:23','2019-01-10 11:45:23',0,'research_awards_internal',0,0),(25,3,'Service Awards - External','جوائز الخدمة - الخارجية','2019-01-10 11:45:23','2019-01-10 11:45:23',0,'service_awards_external',0,0),(26,3,'Service Awards - Internal','جوائز الخدمة - الداخلية','2019-01-10 11:45:23','2019-01-10 11:45:23',0,'service_awards_internal',0,0),(27,3,'Consulting Activities - Organization Paid','الأنشطة الاستشارية - المنظمة المدفوعة','2019-01-10 11:45:23','2019-01-10 11:45:23',0,'consulting',0,0),(28,1,'Adviser for Student Organization(s)','نصائح للمنظمات الطلابية','2019-01-10 11:45:24','2019-01-10 11:45:24',0,'adviser_for_student_organization',0,0),(29,1,'Post-Doctoral Students ','طلاب ما بعد الدكتوراة','2019-01-10 11:45:24','2019-01-10 11:45:24',0,'post_doctoral_students',0,0),(30,1,'Instructional techniques Utilized','التقنيات التعليمية المستخدمة','2019-01-10 11:45:24','2019-01-10 11:45:24',0,'instructional_techniques_utilized',0,0),(31,1,'Undergraduate Projects Completed','مشاريع التخرج المنتجزة','2019-01-10 11:45:24','2019-01-10 11:45:24',0,'undergraduate_projects_completed',0,0),(32,1,'Current Ph.D. Students and Support','دعم وطلاب الدكتوراة الحاليين','2019-01-10 11:45:24','2019-01-10 11:45:24',0,'current_phd_students_and_support',0,0),(33,1,'Current MS Students and Support','دعم وطلاب الماجستير الحاليين','2019-01-10 11:45:24','2019-01-10 11:45:24',0,'current_ms_students_and_support',0,0),(34,1,'Current Undergraduate Students','الطلاب الجامعيين الحاليين','2019-01-10 11:45:24','2019-01-10 11:45:24',0,'current_undergraduate_students',0,0),(35,2,'Journal Articles - Referred','مقالات صحفية محكمة','2019-01-10 11:45:24','2019-01-10 11:45:24',0,'journal_articles_refereed',0,0),(36,2,'Journal Articles - Non Referred','مقالات صحفية غير محكمة','2019-01-10 11:45:24','2019-01-10 11:45:24',0,'journal_articles_non_refereed',0,0),(37,2,'Conference Proceedings - Referred','وقائع المؤتمر المحكمة','2019-01-10 11:45:24','2019-01-10 11:45:24',0,'conference_proceedings_refereed',0,0),(38,2,'Conference Proceedings - Non Referred','وقائع المؤتمر غير المحكمة','2019-01-10 11:45:24','2019-01-10 11:45:24',0,'conference_proceedings_non_refereed',0,0),(39,2,'Books - Unpublished','الكتب - كتب جديدة','2019-01-10 11:45:24','2019-01-10 11:45:24',0,'books_new_books',0,0),(40,2,'Books - Edited or Revised','كتب - تعديل ومراجعة','2019-01-10 11:45:24','2019-01-10 11:45:24',0,'books_edited_or_revised',0,0),(41,2,'Books - Chapters','الكتب - فصول','2019-01-10 11:45:24','2019-01-10 11:45:24',0,'book_chapters',0,0),(42,2,'Books - Published','الكتب - كتب منشورة','2019-01-10 11:45:24','2019-01-10 11:45:24',0,'book_published_book',0,0),(43,2,'Meetings and Conferences','الاجتماعات والمؤتمرات','2019-01-10 11:45:24','2019-01-10 11:45:24',0,'meetings_and_conferences',0,0),(44,2,'Workshops and Short Courses','ورشات العمل والدورات القصيرة','2019-01-10 11:45:24','2019-01-10 11:45:24',0,'workshops_and_short_courses',0,0),(45,2,'Seminars at Other Universities or Industries','ندوات في الجامعات أو المؤسسات الأخرى','2019-01-10 11:45:24','2019-01-10 11:45:24',0,'seminars_at_other_universities_or_industry',0,0),(46,2,'Patents','براءات الاختراع','2019-01-10 11:45:24','2019-01-10 11:45:24',0,'patents',0,0),(47,2,'Intellectual Property Disclosures','الإفصاح عن الملكية الفكرية','2019-01-10 11:45:24','2019-01-10 11:45:24',0,'intellectual_property_disclosures',0,0),(48,2,'Computer Software','برامج الكمبيوتر','2019-01-10 11:45:24','2019-01-10 11:45:24',0,'computer_software',0,0),(49,2,'Governmental Grants','المنح الحكومية','2019-01-10 11:45:24','2019-01-10 11:45:24',0,'governmental_grants',0,0),(50,2,'External, Non-Governmental Grants','المنح الخارجية غير الحكومية','2019-01-10 11:45:24','2019-01-10 11:45:24',0,'external_non_governmental_grants',0,0),(51,2,'Internal, University Grants','المنح الجامعية الداخلية','2019-01-10 11:45:24','2019-01-10 11:45:24',0,'internal_university_grants',0,0),(52,2,'Successful New Grants Received','الحصول على منح جديدة ناجحة','2019-01-10 11:45:25','2019-01-10 11:45:25',0,'successful_new_grants_received',0,0),(53,2,'Proposals Declined, or Submitted and Pending','المقترحات المرفوضة أو المرسلة أو المعلقة ','2019-01-10 11:45:25','2019-01-10 11:45:25',0,'proposals_declined_or_submitted_and_pending',0,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_forms_deadline`
--

LOCK TABLES `fp_forms_deadline` WRITE;
/*!40000 ALTER TABLE `fp_forms_deadline` DISABLE KEYS */;
INSERT INTO `fp_forms_deadline` VALUES (1,'2019-01-22 22:00:00','2019-01-24 22:00:00','2019-01-15 23:09:15','2019-01-15 23:09:27',0);
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
INSERT INTO `fp_forms_inputs` VALUES (1,1,'Publication Name','اسم النشر','2019-01-10 11:45:25','2019-01-10 11:45:25',0),(2,1,'Member of Editorial Board','عضو هيئة التحرير','2019-01-10 11:45:25','2019-01-10 11:45:25',0),(3,3,'Chair Name','اسم المنظم','2019-01-10 11:45:25','2019-01-10 11:45:25',0),(4,4,'Semester','الفصل الدراسي','2019-01-10 11:45:25','2019-01-10 11:45:25',0),(6,4,'Course Title','اسم المادة','2019-01-10 11:45:25','2019-01-10 11:45:25',0),(7,4,'Brief Description','وصف عام','2019-01-10 11:45:25','2019-01-10 11:45:25',0),(8,5,'Chair Name','اسم المنظم','2019-01-10 11:45:25','2019-01-10 11:45:25',0),(9,6,'Semester','الفصل الدراسي','2019-01-10 11:45:25','2019-01-10 11:45:25',0),(11,6,'Course Title','اسم المادة','2019-01-10 11:45:25','2019-01-10 11:45:25',0),(12,6,'Brief Description','وصف عام','2019-01-10 11:45:25','2019-01-10 11:45:25',0),(13,7,'Chair Name','اسم المنظم','2019-01-10 11:45:25','2019-01-10 11:45:25',0),(14,8,'Committee Name','اسم اللجنة','2019-01-10 11:45:25','2019-01-10 11:45:25',0),(15,9,'Committee Name','اسم اللجنة','2019-01-10 11:45:25','2019-01-10 11:45:25',0),(16,10,'Committee Name','اسم اللجنة','2019-01-10 11:45:25','2019-01-10 11:45:25',0),(17,11,'Committee Name','اسم اللجنة','2019-01-10 11:45:25','2019-01-10 11:45:25',0),(18,16,'Committee Name','اسم اللجنة','2019-01-10 11:45:25','2019-01-10 11:45:25',0),(20,14,'Name','الاسم','2019-01-10 11:45:25','2019-01-10 11:45:25',0),(21,14,'Degree','الدرجة العملية','2019-01-10 11:45:25','2019-01-10 11:45:25',0),(22,14,'Thesis Title','عنوان الرسالة','2019-01-10 11:45:25','2019-01-10 11:45:25',0),(23,14,'Student Position','وضع الطالب','2019-01-10 11:45:25','2019-01-10 11:45:25',0),(24,15,'Name','الاسم','2019-01-10 11:45:25','2019-01-10 11:45:25',0),(25,15,'Degree','الدرجة العلمية','2019-01-10 11:45:26','2019-01-10 11:45:26',0),(26,15,'Thesis Title','عنوان الرسالة','2019-01-10 11:45:26','2019-01-10 11:45:26',0),(27,15,'Student Position','وضع الطالب','2019-01-10 11:45:26','2019-01-10 11:45:26',0),(28,28,'Summary','المراجعة','2019-01-10 11:45:26','2019-01-10 11:45:26',0),(29,29,'Summary','المراجعة','2019-01-10 11:45:26','2019-01-10 11:45:26',0),(30,30,'Summary','المراجعة','2019-01-10 11:45:26','2019-01-10 11:45:26',0),(31,31,'Name','الاسم','2019-01-10 11:45:26','2019-01-10 11:45:26',0),(32,31,'Program','البرنامج','2019-01-10 11:45:26','2019-01-10 11:45:26',0),(33,31,'Project Title','اسم المشروع','2019-01-10 11:45:26','2019-01-10 11:45:26',0),(34,32,'Name','الاسم','2019-01-10 11:45:26','2019-01-10 11:45:26',0),(35,32,'Department','القسم','2019-01-10 11:45:26','2019-01-10 11:45:26',0),(36,32,'Type Support','نوع الدعم','2019-01-10 11:45:26','2019-01-10 11:45:26',0),(37,32,'Department Support','دعم القسم','2019-01-10 11:45:26','2019-01-10 11:45:26',0),(38,33,'Name','الاسم','2019-01-10 11:45:26','2019-01-10 11:45:26',0),(39,33,'Department','القسم','2019-01-10 11:45:26','2019-01-10 11:45:26',0),(40,33,'Type Support','نوع الدعم','2019-01-10 11:45:26','2019-01-10 11:45:26',0),(41,33,'Department Support','دعم القسم','2019-01-10 11:45:26','2019-01-10 11:45:26',0),(42,34,'Name','الاسم','2019-01-10 11:45:26','2019-01-10 11:45:26',0),(43,34,'Program','البرنامج','2019-01-10 11:45:26','2019-01-10 11:45:26',0),(44,34,'Year','السنة','2019-01-10 11:45:26','2019-01-10 11:45:26',0),(45,12,'Semester','الفصل الدراسي','2019-01-10 11:45:26','2019-01-10 11:45:26',0),(47,12,'Course Title','اسم المادة','2019-01-10 11:45:26','2019-01-10 11:45:26',0),(48,12,'Brief Description','وصف عام','2019-01-10 11:45:26','2019-01-10 11:45:26',0),(49,13,'Name','الاسم','2019-01-10 11:45:26','2019-01-10 11:45:26',0),(50,13,'Degree','الدرجة العلمية','2019-01-10 11:45:27','2019-01-10 11:45:27',0),(51,13,'Thesis Title','عنوان الرسالة','2019-01-10 11:45:27','2019-01-10 11:45:27',0),(52,13,'Student Position','وضع الطالب','2019-01-10 11:45:27','2019-01-10 11:45:27',0),(53,2,'Semester','الفصل الدراسي','2019-01-10 11:45:27','2019-01-10 11:45:27',0),(55,2,'Course Title','اسم المادة','2019-01-10 11:45:27','2019-01-10 11:45:27',0),(57,2,'Number of Students Enrolled','عدد الطلاب المسجلين','2019-01-10 11:45:27','2019-01-10 11:45:27',0),(58,2,'Course Evaluation Overall Rating','التقييم العام للمادة الدراسية','2019-01-10 11:45:27','2019-01-10 11:45:27',0),(59,36,'Article Title','غير الحكم','2019-01-10 11:45:27','2019-01-10 11:45:27',0),(60,35,'Article Title','الحكم','2019-01-10 11:45:27','2019-01-10 11:45:27',0),(61,36,'Appeared and Accepted','الظهور والقبول','2019-01-10 11:45:27','2019-01-10 11:45:27',0),(62,37,'Name','الحكم','2019-01-10 11:45:27','2019-01-10 11:45:27',0),(63,37,'Appeared and Accepted','الظهور والقبول','2019-01-10 11:45:27','2019-01-10 11:45:27',0),(64,38,'Name','غير الحكم','2019-01-10 11:45:27','2019-01-10 11:45:27',0),(65,38,'Appeared and Accepted','الظهور والقبول','2019-01-10 11:45:27','2019-01-10 11:45:27',0),(67,39,'Book Title','كتاب جديد','2019-01-10 11:45:27','2019-01-10 11:45:27',0),(68,39,'Appeared and Accepted','الظهور والقبول','2019-01-10 11:45:27','2019-01-10 11:45:27',0),(69,40,'Book Title','تعديل أو مراجعة','2019-01-10 11:45:27','2019-01-10 11:45:27',0),(70,40,'Appeared and Accepted','الظهور والقبول','2019-01-10 11:45:27','2019-01-10 11:45:27',0),(71,41,'Chapter Title','عنوان الفصل','2019-01-10 11:45:27','2019-01-10 11:45:27',0),(72,41,'Book','الكتاب','2019-01-10 11:45:27','2019-01-10 11:45:27',0),(73,42,'Book Title','عنوان الكتاب','2019-01-10 11:45:28','2019-01-10 11:45:28',0),(74,42,'Reviewed Date','تاريخ المراجعة','2019-01-10 11:45:28','2019-01-10 11:45:28',0),(75,43,'Presentation Title','عنوان العرض','2019-01-10 11:45:28','2019-01-10 11:45:28',0),(76,43,'Location','الموقع','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(77,43,'Date','التاريخ','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(78,43,'Meeting or Conference','الاجتماعات والمؤتمرات','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(79,44,'Presentation Title','عنوان العرض','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(80,44,'Location','الموقع','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(81,44,'Date','التاريخ','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(82,44,'Meeting or Conference','الاجتماعات والمؤتمرات','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(83,45,'Presentation Title','عنوان العرض','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(84,45,'Location','الموقع','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(85,45,'Date','التاريخ','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(86,45,'Meeting or Conference','الاجتماعات والمؤتمرات','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(91,48,'Name','الاسم','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(92,48,'Date','التاريخ','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(93,49,'Title','العنوان','2019-01-10 11:45:28','2019-01-10 11:45:28',0),(94,49,'Funding Agency','وكالة التمويل','2019-01-10 11:45:28','2019-01-10 11:45:28',0),(95,49,'Amount Funded','المبلغ الممول','2019-01-10 11:45:28','2019-01-10 11:45:28',0),(96,49,'Funding Period','فترة التمويل','2019-01-10 11:45:28','2019-01-10 11:45:28',0),(97,49,'List of PI’s & Co-PIs','قائمة الباحثين الرئيسين والباحثين المشاركين','2019-01-10 11:45:28','2019-01-10 11:45:28',0),(98,49,'Your Percentage of Participation','النسبة المئوية الخاص من المشاركة','2019-01-10 11:45:28','2019-01-10 11:45:28',0),(99,50,'Title','العنوان','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(100,50,'Funding Agency','وكالة التمويل','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(101,50,'Amount Funded','المبلغ الممول','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(102,50,'Funding Period','فترة التمويل','2019-01-10 11:45:28','2019-01-10 11:45:28',0),(103,50,'List of PI’s & Co-PIs','قائمة الباحثين الرئيسين والباحثين المشاركين','2019-01-10 11:45:28','2019-01-10 11:45:28',0),(104,50,'Your Percentage of Participation','النسبة المئوية الخاص من المشاركة','2019-01-10 11:45:28','2019-01-10 11:45:28',0),(105,51,'Title','العنوان','2019-01-10 11:45:28','2019-01-10 11:45:28',0),(106,51,'Funding Agency','وكالة التمويل','2019-01-10 11:45:28','2019-01-10 11:45:28',0),(107,51,'Amount Funded','المبلغ الممول','2019-01-10 11:45:28','2019-01-10 11:45:28',0),(108,51,'Funding Period','فترة التمويل','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(109,51,'List of PI’s & Co-PIs','قائمة الباحثين الرئيسين والباحثين المشاركين','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(110,51,'Your Percentage of Participation','النسبة المئوية الخاص من المشاركة','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(111,52,'Title','العنوان','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(112,52,'Funding Agency','وكالة التمويل','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(113,52,'Amount Funded','المبلغ الممول','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(114,52,'Funding Period','فترة التمويل','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(115,52,'List of PI’s & Co-PIs','قائمة الباحثين الرئيسين والباحثين المشاركين','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(116,52,'Your Percentage of Participation','النسبة المئوية الخاص من المشاركة','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(117,53,'Title','العنوان','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(118,53,'Funding Agency','وكالة التمويل','2019-01-10 11:45:29','2019-01-10 11:45:29',0),(119,53,'Amount Funded','المبلغ الممول','2019-01-10 11:45:30','2019-01-10 11:45:30',0),(120,53,'Funding Period','فترة التمويل','2019-01-10 11:45:30','2019-01-10 11:45:30',0),(121,53,'List of PI’s & Co-PIs','قائمة الباحثين الرئيسين والباحثين المشاركين','2019-01-10 11:45:30','2019-01-10 11:45:30',0),(122,53,'Your Percentage of Participation','النسبة المئوية الخاص من المشاركة','2019-01-10 11:45:30','2019-01-10 11:45:30',0),(123,17,'Title','الاسم','2019-01-10 11:45:30','2019-01-10 11:45:30',0),(124,18,'Organization Name','اسم المنظمة','2019-01-10 11:45:30','2019-01-10 11:45:30',0),(125,18,'Number of Days','عدد الأيام','2019-01-10 11:45:30','2019-01-10 11:45:30',0),(126,19,'Organization Name','اسم المنظمة','2019-01-10 11:45:30','2019-01-10 11:45:30',0),(127,19,'Number of Days','عدد الأيام','2019-01-10 11:45:30','2019-01-10 11:45:30',0),(128,20,'Organization Name','اسم المنظمة','2019-01-10 11:45:30','2019-01-10 11:45:30',0),(129,20,'Number of Days','عدد الأيام','2019-01-10 11:45:30','2019-01-10 11:45:30',0),(130,21,'Award Name','اسم الجائزة','2019-01-10 11:45:30','2019-01-10 11:45:30',0),(131,22,'Award Name','اسم الجائزة','2019-01-10 11:45:30','2019-01-10 11:45:30',0),(132,23,'Award Name','اسم الجائزة','2019-01-10 11:45:30','2019-01-10 11:45:30',0),(133,24,'Award Name','اسم الجائزة','2019-01-10 11:45:30','2019-01-10 11:45:30',0),(134,25,'Award Name','اسم الجائزة','2019-01-10 11:45:30','2019-01-10 11:45:30',0),(135,26,'Award Name','اسم الجائزة','2019-01-10 11:45:30','2019-01-10 11:45:30',0),(136,27,'Organization Name','اسم المنظمة','2019-01-10 11:45:30','2019-01-10 11:45:30',0),(137,27,'Number of Days','عدد الأيام','2019-01-10 11:45:30','2019-01-10 11:45:30',0),(138,46,'Name','الاسم','2019-01-10 11:45:30','2019-01-10 11:45:30',0),(139,46,'Date','التاريخ','2019-01-10 11:45:30','2019-01-10 11:45:30',0),(140,47,'Name','الاسم','2019-01-10 11:45:31','2019-01-10 11:45:31',0),(141,47,'Date','التاريخ','2019-01-10 11:45:31','2019-01-10 11:45:31',0),(600,35,'Appeared and Accepted','الظهور والقبول','2019-01-10 11:45:27','2019-01-10 11:45:27',0);
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
INSERT INTO `fp_forms_type` VALUES (1,'Teaching','التدريس','2019-01-10 11:45:22','2019-01-10 11:45:22',0,0),(2,'Research','الابحاث','2019-01-10 11:45:22','2019-01-10 11:45:22',0,0),(3,'Service','الخدمات','2019-01-10 11:45:22','2019-01-10 11:45:22',0,0);
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
-- Table structure for table `fp_legend`
--

DROP TABLE IF EXISTS `fp_legend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_legend` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title_en` text,
  `title_ar` text,
  `is_delete` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_legend`
--

LOCK TABLES `fp_legend` WRITE;
/*!40000 ALTER TABLE `fp_legend` DISABLE KEYS */;
INSERT INTO `fp_legend` VALUES (1,'Band Performance Legend','رموز نظاق الأداء',0),(2,'legend 2','legend 2',0),(3,'legend two for college','legend two for college',0);
/*!40000 ALTER TABLE `fp_legend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fp_legend_desc`
--

DROP TABLE IF EXISTS `fp_legend_desc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_legend_desc` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `legend_id` bigint(20) DEFAULT NULL,
  `legend_en` text,
  `legend_ar` text,
  `min` int(11) DEFAULT NULL,
  `max` int(11) DEFAULT NULL,
  `desc_en` text,
  `desc_ar` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fp_legend_desc`
--

LOCK TABLES `fp_legend_desc` WRITE;
/*!40000 ALTER TABLE `fp_legend_desc` DISABLE KEYS */;
INSERT INTO `fp_legend_desc` VALUES (1,1,'B1','B1',0,10,'Poor Performance','أداء سيئ'),(2,1,'B2','B2',11,30,'Low Performance','اداء متدني'),(3,1,'B3','B3',31,50,'Below Average','اقل من المستوى'),(4,1,'B4','B4',51,65,'Average Performance','أداء متوسط'),(5,1,'B5','B5',66,85,'Good Performance','أداء جيد'),(6,1,'B6','B6',86,100,'Excellent Performance','اداء ممتاز'),(7,2,'12','12',1,5,'123123','1234213'),(8,3,'legend 1','legend 1',50,100,'legend 1','legend 1');
/*!40000 ALTER TABLE `fp_legend_desc` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `institution`
--

LOCK TABLES `institution` WRITE;
/*!40000 ALTER TABLE `institution` DISABLE KEYS */;
INSERT INTO `institution` VALUES (1,'Jadeer','جدير','/assets/jadeer/img/university/logo.png','/assets/jadeer/img/university/logo.png','/assets/jadeer/img/university/background.png','/assets/jadeer/img/university/background.png','','','','','','','','','our vision to deal with jadeer in a very good way','our vision to deal with jadeer in a very good way','mission to be best system and institution around the worldhgjk','mission to be best system and institution around the worldhop[]p[o]');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `institution_goal`
--

LOCK TABLES `institution_goal` WRITE;
/*!40000 ALTER TABLE `institution_goal` DISABLE KEYS */;
INSERT INTO `institution_goal` VALUES (1,1,'our goal ,, to make all students deal with system in easy way','our goal ,, to make all students deal with system in easy way',0),(2,1,'add new one to integrate in strategic planning','add new one to integrate in strategic planning',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `institution_objective`
--

LOCK TABLES `institution_objective` WRITE;
/*!40000 ALTER TABLE `institution_objective` DISABLE KEYS */;
INSERT INTO `institution_objective` VALUES (1,1,'our objective ti make this system wide in all ksa','our objective ti make this system wide in all ksa',0),(2,1,'it\'s new objective to take seriously in strategic planning','it\'s new objective to take seriously in strategic planning',1),(3,1,'new one to test strategic plan objective work','new one to test strategic plan objective work',1),(4,1,'objective displayed in strategic plan','objective displayed in strategic plan',0);
/*!40000 ALTER TABLE `institution_objective` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `is_industrial_relation`
--

DROP TABLE IF EXISTS `is_industrial_relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `is_industrial_relation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `industrial_id` bigint(20) NOT NULL DEFAULT '0',
  `rubric_row_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `is_industrial_relation`
--

LOCK TABLES `is_industrial_relation` WRITE;
/*!40000 ALTER TABLE `is_industrial_relation` DISABLE KEYS */;
/*!40000 ALTER TABLE `is_industrial_relation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `is_industrial_skills`
--

DROP TABLE IF EXISTS `is_industrial_skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `is_industrial_skills` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `program_id` bigint(20) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `college_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `is_industrial_skills`
--

LOCK TABLES `is_industrial_skills` WRITE;
/*!40000 ALTER TABLE `is_industrial_skills` DISABLE KEYS */;
/*!40000 ALTER TABLE `is_industrial_skills` ENABLE KEYS */;
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
  `unit_id` varchar(45) NOT NULL DEFAULT '0',
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
INSERT INTO `kpi` VALUES (1,7,'S1.1','Stakeholders\' awareness ratings of the Mission Statement and Objectives (Average rating on how well the mission is known to teaching staff, and undergraduate and graduate students, respectively, on a five- point scale in an annual survey).',1,'','0','0',0,0,0,0,0,0,0,1),(2,17,'S2.1','Stakeholder evaluation of the Policy Handbook, including administrative flow chart and job responsibilities (Average rating on the adequacy of the Policy Handbook on a five- point scale in an annual survey of teaching staff and final year students).',1,'','0','0',0,0,0,0,0,0,0,1),(3,24,'S3.1','Students\' overall evaluation on the quality of their learning experiences. (Average rating of the overall quality on a five point scale in an annual survey of final year students.)',1,'','0','0',0,0,0,0,0,0,0,1),(4,24,'S3.2','Proportion of courses in which student evaluations were conducted during the year.',2,'','0','0',0,0,0,0,0,0,0,1),(5,24,'S3.3','Proportion of programs in which there was an independent verification, within the institution, of standards of student achievement during the year.',2,'','0','0',0,0,0,0,0,0,0,1),(6,24,'S3.4','Proportion of programs in which there was an independent verification of standards of student achievement by people (evaluators) external to the institution during the year.',2,'','0','0',0,0,0,0,0,0,0,1),(7,37,'S4.1','Ratio of students to teaching staff. (Based on full time equivalents)',2,'','0','0',0,0,0,0,0,0,0,1),(8,37,'S4.2','Students overall rating on the quality of their courses. (Average rating of students on a five point scale on overall evaluation of courses.)',1,'','0','0',0,0,0,0,0,0,0,1),(9,37,'S4.3','Proportion of teaching staff with verified doctoral qualifications.',2,'','0','0',0,0,0,0,0,0,0,1),(10,37,'S4.4','Retention Rate; Percentage of students entering programs who successfully complete first year.',2,'','0','0',0,0,0,0,0,0,0,1),(11,37,'S4.5','Graduation Rate for Undergraduate Students: Proportion of students entering undergraduate programs who complete those programs in minimum time.',2,'','0','0',0,0,0,0,0,0,0,1),(12,37,'S4.6','Graduation Rates for Post Graduate Students: Proportion of students entering post graduate programs who complete those programs in specified time.',2,'','0','0',0,0,0,0,0,0,0,1),(13,37,'S4.7','Proportion of graduates from undergraduate programs who within six months of graduation are: \n(a) employed \n(b) enrolled in further study \n(c) not seeking employment or further study',2,'','0','0',0,0,0,0,0,0,0,1),(14,45,'S5.1','Ratio of students to administrative staff.',2,'','0','0',0,0,0,0,0,0,0,1),(15,45,'S5.2','Proportion of total operating funds (other than accommodation and student allowances) allocated to provision of student services.',2,'','0','0',0,0,0,0,0,0,0,1),(16,45,'S5.3','Student evaluation of academic and career counselling. (Average rating on the adequacy of academic and career counselling on a five- point scale in an annual survey of final year students.)',1,'','0','0',0,0,0,0,0,0,0,1),(17,50,'S6.1','Stakeholder evaluation of library and media center. (Average overall rating of the adequacy of the library & media center, including:\n a) Staff assistance,\nb) Current and up-to-date\nc) Copy & print facilities,\nd) Functionality of equipment,\ne) Atmosphere or climate for studying\nf) Availability of study sites, and\ng) Any other quality indicators of service on a five- point scale of an annual survey.) .',1,'','0','0',0,0,0,0,0,0,0,1),(18,50,'S6.2','Number of web site publication and journal subscriptions as a proportion of the number of programs offered.',2,'','0','0',0,0,0,0,0,0,0,1),(19,50,'S6.3','Stakeholder evaluation of the digital library. (Average overall rating of the adequacy of the digital library, including: \n a) User friendly website\nb) Availability of the digital databases,\nc) Accessibility for users,\nd) Library skill training and\ne) Any other quality indicators of service on a five- point scale of an annual survey.)',1,'','0','0',0,0,0,0,0,0,0,1),(20,57,'S7.1','Annual expenditure on IT budget, including: \na) Percentage of the total Institution, or College, or Program budget allocated for IT; \nb) Percentage of IT budget allocated per program for institutional or per student for programmatic; \nc) Percentage of IT budget allocated for software licences; \nd) Percentage of IT budget allocated for IT security; \ne) Percentage of IT budge allocated for IT maintenance',2,'','0','0',0,0,0,0,0,0,0,1),(21,57,'S7.2','Stakeholder evaluation of the IT services (Average overall rating of the adequacy of on a five- point scale of an annual survey). \na) IT availability, \nb) Website, \nc) e-learning services \nd) IT Security, \ne) Maintenance (hardware & software), \nf) Accessibility \ng) Support systems, \nh) Hardware, software & up-dates, and Web-based electronic data management system or electronic resources (for example: institutional website providing resource sharing, networking & relevant information, including e-learning, interactive learning & teaching between students & faculty).',1,'','0','0',0,0,0,0,0,0,0,1),(22,57,'S7.3','Stakeholder evaluation of facilities & equipment: \na) Classrooms, \nb) Laboratories, \nc) Bathrooms (cleanliness & maintenance), \nd) Campus security, \ne) Parking & access, \nf) Safety (first aide, fire extinguishers & alarm systems, secure chemicals) \ng) Access for those with disabilities or handicaps (ramps, lifts, bathroom furnishings), \nh) Sporting facilities & equipment.',1,'','0','0',0,0,0,0,0,0,0,1),(23,62,'S8.1','Total operating expenditure (other than accommodation and student allowances) per student.',2,'','0','0',0,0,0,0,0,0,0,1),(24,68,'S9.1','Proportion of teaching staff leaving the institution in the past year for reasons other than age retirement.',2,'','0','0',0,0,0,0,0,0,0,1),(25,68,'S9.2','Proportion of teaching staff participating in professional development activities during the past year.',2,'','0','0',0,0,0,0,0,0,0,1),(26,74,'S10.1','Number of refereed publications in the previous year per full time equivalent teaching staff. (Publications based on the formula in the Higher Council Bylaw excluding conference presentations)',2,'','0','0',0,0,0,0,0,0,0,1),(27,74,'S10.2','Number of citations in refereed journals in the previous year per full time equivalent faculty members.',2,'','0','0',0,0,0,0,0,0,0,1),(28,74,'S10.3','Proportion of full time member of teaching staff with at least one refereed publication during the previous year.',2,'','0','0',0,0,0,0,0,0,0,1),(29,74,'S10.4','Number of papers or reports presented at academic conferences during the past year per full time equivalent faculty members.',2,'','0','0',0,0,0,0,0,0,0,1),(30,74,'S10.5','Research income from external sources in the past year as a proportion of the number of full time faculty members.',2,'','0','0',0,0,0,0,0,0,0,1),(31,74,'S10.6','Proportion of the total, annual operational budget dedicated to research.',2,'','0','0',0,0,0,0,0,0,0,1),(32,79,'S11.1','Proportion of full time teaching and other staff actively engaged in community service activities.',2,'','0','0',0,0,0,0,0,0,0,1),(33,79,'S11.2','Number of community education programs provided as a proportion of the number of departments.',2,'','0','0',0,0,0,0,0,0,0,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_detail`
--

LOCK TABLES `kpi_detail` WRITE;
/*!40000 ALTER TABLE `kpi_detail` DISABLE KEYS */;
INSERT INTO `kpi_detail` VALUES (1,1,1),(2,2,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_institution_value`
--

LOCK TABLES `kpi_institution_value` WRITE;
/*!40000 ALTER TABLE `kpi_institution_value` DISABLE KEYS */;
INSERT INTO `kpi_institution_value` VALUES (1,1,10.000,50.000,30.000,30.000,15.000,'[]'),(2,2,20.000,70.000,10.000,60.000,20.000,'[]');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_legend`
--

LOCK TABLES `kpi_legend` WRITE;
/*!40000 ALTER TABLE `kpi_legend` DISABLE KEYS */;
INSERT INTO `kpi_legend` VALUES (1,'parameter1 to add',1),(2,'parameter 2 to add',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_level`
--

LOCK TABLES `kpi_level` WRITE;
/*!40000 ALTER TABLE `kpi_level` DISABLE KEYS */;
INSERT INTO `kpi_level` VALUES (1,'1547451243',34);
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
  `title` varchar(255) NOT NULL,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_level_settings`
--

LOCK TABLES `kpi_level_settings` WRITE;
/*!40000 ALTER TABLE `kpi_level_settings` DISABLE KEYS */;
INSERT INTO `kpi_level_settings` VALUES (1,'scale level 1 label','scale level 1 label',3);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_program_value`
--

LOCK TABLES `kpi_program_value` WRITE;
/*!40000 ALTER TABLE `kpi_program_value` DISABLE KEYS */;
INSERT INTO `kpi_program_value` VALUES (1,1,8,10.000,60.000,80.000,30.000,12.000,'[]'),(2,2,8,20.000,80.000,150.000,60.000,10.000,'[]');
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
-- Table structure for table `learning_domain_type`
--

DROP TABLE IF EXISTS `learning_domain_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `learning_domain_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `is_statics` varchar(45) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `learning_domain_type`
--

LOCK TABLES `learning_domain_type` WRITE;
/*!40000 ALTER TABLE `learning_domain_type` DISABLE KEYS */;
INSERT INTO `learning_domain_type` VALUES (1,'NCAAA 5 Learning Domain','مجالات التعلم (5) الخاصة ب NCAAA','1'),(2,'NCAAA 3 Learning Domain','مجالات التعلم (3) الخاصة ب NCAAA','1'),(3,'Standard Learning Domain','مجالات التعلم الثابتة','1');
/*!40000 ALTER TABLE `learning_domain_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `major`
--

DROP TABLE IF EXISTS `major`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `major` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `integration_id` varchar(100) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `name_en` varchar(255) NOT NULL DEFAULT '',
  `name_ar` varchar(255) NOT NULL DEFAULT '',
  `program_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `major`
--

LOCK TABLES `major` WRITE;
/*!40000 ALTER TABLE `major` DISABLE KEYS */;
INSERT INTO `major` VALUES (1,'0',0,'Programming in Computer Science','البرمجة في علم الحاسوب',5),(2,'0',0,'Networking in computer Science','الشبكات في علم الحاسوب',5),(3,'0',0,'engine management','ادارة المحركات',9),(4,'0',0,'Environment and water','المياه و البيئة',8),(5,'0',0,'wireless communicatin','اتصالات الاسلكي',10);
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
INSERT INTO `migrations` VALUES (20181107113850);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mm_action`
--

DROP TABLE IF EXISTS `mm_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mm_action` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `meeting_id` bigint(20) DEFAULT NULL,
  `owner_name` varchar(50) DEFAULT NULL,
  `action` text,
  `due` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mm_action`
--

LOCK TABLES `mm_action` WRITE;
/*!40000 ALTER TABLE `mm_action` DISABLE KEYS */;
INSERT INTO `mm_action` VALUES (1,1,'15','<p>this action will be implemented to be rank one in the company</p>','2019-02-01');
/*!40000 ALTER TABLE `mm_action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mm_agenda`
--

DROP TABLE IF EXISTS `mm_agenda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mm_agenda` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `meeting_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `topic` tinytext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mm_agenda`
--

LOCK TABLES `mm_agenda` WRITE;
/*!40000 ALTER TABLE `mm_agenda` DISABLE KEYS */;
INSERT INTO `mm_agenda` VALUES (1,1,13,'topic one to be inserted here');
/*!40000 ALTER TABLE `mm_agenda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mm_attendance`
--

DROP TABLE IF EXISTS `mm_attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mm_attendance` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `meeting_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `attended` int(1) DEFAULT NULL,
  `external_user_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mm_attendance`
--

LOCK TABLES `mm_attendance` WRITE;
/*!40000 ALTER TABLE `mm_attendance` DISABLE KEYS */;
INSERT INTO `mm_attendance` VALUES (1,1,13,0,''),(2,1,15,0,''),(3,1,11,1,''),(4,1,14,0,''),(5,1,0,0,'fahmi'),(6,1,0,0,'yazeed'),(7,1,0,1,'yaser'),(8,1,0,1,'firas');
/*!40000 ALTER TABLE `mm_attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mm_meeting`
--

DROP TABLE IF EXISTS `mm_meeting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mm_meeting` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `level` int(2) DEFAULT NULL,
  `level_id` bigint(20) DEFAULT NULL,
  `room_id` bigint(20) DEFAULT NULL,
  `type_class` varchar(100) DEFAULT NULL,
  `type_id` bigint(20) DEFAULT NULL,
  `facilitator_id` bigint(20) DEFAULT NULL,
  `name` tinytext,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `objective` text,
  `agenda_attachment` varchar(150) DEFAULT NULL,
  `meeting_minutes` text,
  `meeting_minutes_attachment` varchar(150) DEFAULT NULL,
  `action_attachment` varchar(150) DEFAULT NULL,
  `meeting_ref_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mm_meeting`
--

LOCK TABLES `mm_meeting` WRITE;
/*!40000 ALTER TABLE `mm_meeting` DISABLE KEYS */;
INSERT INTO `mm_meeting` VALUES (1,2,5,1,'Orm_Mm_Meeting_Individual',0,10,'Employee','2019-01-14 09:00:00','2019-01-14 10:00:00','<p><strong><em>objective related to meeting minutes</em></strong></p>','/files/Documents/2019/Al Huson University College/Computer Science Program/Meeting Management/Employee_1/agenda-2019_01_14.pdf','<p>meeting minutes one to display</p>','/files/Documents/2019/Al Huson University College/Computer Science Program/Meeting Management/Employee_1/meeting_minutes-2019_01_14.pdf','/files/Documents/2019/Al Huson University College/Computer Science Program/Meeting Management/Employee_1/action-2019_01_14.pdf',0);
/*!40000 ALTER TABLE `mm_meeting` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=457 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node`
--

LOCK TABLES `node` WRITE;
/*!40000 ALTER TABLE `node` DISABLE KEYS */;
INSERT INTO `node` VALUES (1,0,1,380,1,1,2019,'Institutional Forms V.2018','Node\\ncai18\\Root','2019-01-12 19:16:36',0,0,0,0,'0000-00-00 00:00:00','2020-01-01 23:59:59','none','[]'),(2,1,2,19,1,0,2019,'Institutional Profile','Node\\ncai18\\Inst_Profile','2019-01-12 19:16:37',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"date\":\"2019-01-11\",\"institution\":\"Jadeer\",\"rector\":{\"1\":{\"2\":{\"name\":\"zxcxzc\"}},\"3\":{\"2\":{\"address\":\"czxczx\"}},\"4\":{\"2\":{\"telephone\":\"czxczxcz\"}},\"5\":{\"2\":{\"email\":\"xczxczxczxc\"}}},\"vice_rector\":[{\"name_of_vice_Rector\":\"xzcxzczx\",\"address_of_vice_rector\":\"czxczxc\",\"telephone_of_vice_rector\":\"zxczxczxc\",\"email_of_vice_rector\":\"xzczxczxc\"}],\"dean_quality\":{\"1\":{\"2\":{\"name\":\"xzcxzczxc\"}},\"3\":{\"2\":{\"address\":\"xzczxc\"}},\"4\":{\"2\":{\"telephone\":\"xzcxzc\"}},\"5\":{\"2\":{\"email\":\"xzcxzcxzc\"}}},\"institutional_summary\":\"<p>xzczxcxzc<\\/p>\",\"branch\":[{\"branches\":\"xzcxzc\"}],\"units\":{\"1\":{\"2\":{\"deanship_num\":\"zxcxzc\"}},\"2\":{\"2\":{\"college_num\":\"xzcxzc\"}},\"3\":{\"2\":{\"program_num\":\"cxzcxzc\"}},\"4\":{\"2\":{\"Institute_num\":\"xzcxzcxz\"}},\"5\":{\"2\":{\"research_center_num\":\"cxzczxc\"}},\"6\":{\"2\":{\"research_chair_num\":\"zxczxcxzcxzc\"}},\"7\":{\"2\":{\"hospital_num\":\"xzczxczxc\"}},\"8\":{\"2\":{\"societies_num\":\"zxczxczxc\"}}},\"achievements\":\"<p>xzczxczxczxc<\\/p>\"}'),(3,2,3,4,1,0,2019,'Table1. Institutional Performance Indicators','Node\\ncai18\\Inst_Prof_Table_1','2019-01-12 19:16:37',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','compliant','{\"inst_performance\":[{\"code\":\"23123\",\"indicator\":\"23123123123\",\"value\":\"23123\"}]}'),(4,2,5,6,1,0,2019,'Table 2. Preparatory or Foundation Program','Node\\ncai18\\Inst_Prof_Table_2','2019-01-12 19:16:37',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','compliant','{\"program_foundation\":[{\"stream_or_sections\":\"234324\",\"male_student_saudi\":\"234234\",\"male_student_other\":\"324\",\"female_student_saudi\":\"43242\",\"female_student_other\":\"234234\",\"total_student_saudi\":\"32423d\",\"total_student_other\":\"dsfdsf\",\"teaching_staff_m\":\"fdsfdsf\",\"teaching_staff_f\":\"dsfdsf\",\"ratio_m\":\"dsfdsf\",\"ratio_f\":\"sdfsdf\",\"retention_rate_m\":\"fdsffds\",\"retention_rate_f\":\"sdf\",\"completion_rate_m\":\"sdfsd\",\"completion_rate_f\":\"\"}]}'),(5,2,7,8,1,0,2019,'Table 3. Program Data','Node\\ncai18\\Inst_Prof_Table_3','2019-01-12 19:16:37',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','partly_compliant','{\"program_data\":[{\"program_name\":\"\",\"start_date\":\"\",\"all_data\":{\"3\":{\"2\":{\"male\":\"\"},\"3\":{\"male\":\"\"},\"4\":{\"male\":\"\"},\"5\":{\"male\":\"\"},\"6\":{\"male\":\"\"},\"7\":{\"male\":\"\"},\"8\":{\"male\":\"\"},\"9\":{\"male\":\"\"},\"10\":{\"male\":\"\"},\"11\":{\"male\":\"\"},\"12\":{\"male\":\"\"}},\"4\":{\"2\":{\"female\":\"\"},\"3\":{\"female\":\"\"},\"4\":{\"female\":\"\"},\"5\":{\"female\":\"\"},\"6\":{\"female\":\"\"},\"7\":{\"female\":\"\"},\"8\":{\"female\":\"\"},\"9\":{\"female\":\"\"}}}}]}'),(6,2,9,10,1,0,2019,'Table 4. Summary of Programs\' Teaching Staff','Node\\ncai18\\Inst_Prof_Table_4','2019-01-12 19:16:37',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','not_compliant','{\"teaching_staff\":[{\"program_name\":\"\",\"professor_m_ft\":\"\",\"professor_m_pt\":\"\",\"professor_f_ft\":\"\",\"professor_f_pt\":\"\",\"associate_professor_m_ft\":\"\",\"associate_professor_m_pt\":\"\",\"associate_professor_f_ft\":\"\",\"associate_professor_f_pt\":\"\",\"assistant_professor_m_ft\":\"\",\"assistant_professor_m_pt\":\"\",\"assistant_professor_f_ft\":\"\",\"assistant_professor_f_pt\":\"\",\"lecture_m_ft\":\"\",\"lecture_m_pt\":\"\",\"lecture_f_ft\":\"\",\"lecture_f_pt\":\"\",\"teaching_m_ft\":\"\",\"teaching_m_pt\":\"\",\"teaching_f_ft\":\"\",\"teaching_f_pt\":\"\",\"total_f\":\"\",\"total_m\":\"\"}]}'),(7,2,11,12,1,0,2019,'Table 5. Numbers of Graduates in the Most Recent Year','Node\\ncai18\\Inst_Prof_Table_5','2019-01-12 19:16:37',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','not_compliant','{\"graduates\":[{\"program_name\":\"\",\"num_of_graduates\":{\"4\":{\"2\":{\"undergraduate_students_diploma\":\"\"},\"3\":{\"undergraduate_students_diploma\":\"\"},\"4\":{\"undergraduate_students_bachelor\":\"\"},\"5\":{\"undergraduate_students_bachelor\":\"\"},\"6\":{\"postgraduate_students_higher_diploma\":\"\"},\"7\":{\"postgraduate_students_higher_diploma\":\"\"},\"8\":{\"postgraduate_students_master\":\"\"},\"9\":{\"postgraduate_students_master\":\"\"},\"10\":{\"postgraduate_students_phd\":\"\"},\"11\":{\"postgraduate_students_phd\":\"\"}},\"5\":{\"2\":{\"undergraduate_students_diploma\":\"\"},\"3\":{\"undergraduate_students_diploma\":\"\"},\"4\":{\"undergraduate_students_bachelor\":\"\"},\"5\":{\"undergraduate_students_bachelor\":\"\"},\"6\":{\"postgraduate_students_higher_diploma\":\"\"},\"7\":{\"postgraduate_students_higher_diploma\":\"\"},\"8\":{\"postgraduate_students_master\":\"\"},\"9\":{\"postgraduate_students_master\":\"\"},\"10\":{\"postgraduate_students_phd\":\"\"},\"11\":{\"postgraduate_students_phd\":\"\"}},\"6\":{\"2\":{\"undergraduate_students_diploma\":\"\"},\"3\":{\"undergraduate_students_diploma\":\"\"},\"4\":{\"undergraduate_students_bachelor\":\"\"},\"5\":{\"undergraduate_students_bachelor\":\"\"},\"6\":{\"postgraduate_students_higher_diploma\":\"\"},\"7\":{\"postgraduate_students_higher_diploma\":\"\"},\"8\":{\"postgraduate_students_master\":\"\"},\"9\":{\"postgraduate_students_master\":\"\"},\"10\":{\"postgraduate_students_phd\":\"\"},\"11\":{\"postgraduate_students_phd\":\"\"}}}}]}'),(8,2,13,14,1,0,2019,'Table 6. Mode of Instruction – Student Enrollment','Node\\ncai18\\Inst_Prof_Table_6','2019-01-12 19:16:37',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"student_enrollment\":[{\"program_name\":\"\",\"student_enrollment\":{\"4\":{\"2\":{\"on_campus_ft\":\"\"},\"3\":{\"on_campus_ft\":\"\"},\"4\":{\"on_campus_pt\":\"\"},\"5\":{\"on_campus_pt\":\"\"},\"6\":{\"on_campus_fte\":\"\"},\"7\":{\"on_campus_fte\":\"\"},\"8\":{\"distance_education_programs_ft\":\"\"},\"9\":{\"distance_education_programs_ft\":\"\"},\"10\":{\"distance_education_programs_pt\":\"\"},\"11\":{\"distance_education_programs_pt\":\"\"},\"12\":{\"distance_education_programs_fte\":\"\"},\"13\":{\"distance_education_programs_fte\":\"\"}},\"5\":{\"2\":{\"on_campus_ft\":\"\"},\"3\":{\"on_campus_ft\":\"\"},\"4\":{\"on_campus_pt\":\"\"},\"5\":{\"on_campus_pt\":\"\"},\"6\":{\"on_campus_fte\":\"\"},\"7\":{\"on_campus_fte\":\"\"},\"8\":{\"distance_education_programs_ft\":\"\"},\"9\":{\"distance_education_programs_ft\":\"\"},\"10\":{\"distance_education_programs_pt\":\"\"},\"11\":{\"distance_education_programs_pt\":\"\"},\"12\":{\"distance_education_programs_fte\":\"\"},\"13\":{\"distance_education_programs_fte\":\"\"}},\"6\":{\"2\":{\"on_campus_ft\":\"\"},\"3\":{\"on_campus_ft\":\"\"},\"4\":{\"on_campus_pt\":\"\"},\"5\":{\"on_campus_pt\":\"\"},\"6\":{\"on_campus_fte\":\"\"},\"7\":{\"on_campus_fte\":\"\"},\"8\":{\"distance_education_programs_ft\":\"\"},\"9\":{\"distance_education_programs_ft\":\"\"},\"10\":{\"distance_education_programs_pt\":\"\"},\"11\":{\"distance_education_programs_pt\":\"\"},\"12\":{\"distance_education_programs_fte\":\"\"},\"13\":{\"distance_education_programs_fte\":\"\"}}}}]}'),(9,2,15,16,1,0,2019,'Table 7. Mode of Instruction – Teaching Staff','Node\\ncai18\\Inst_Prof_Table_7','2019-01-12 19:16:37',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','not_compliant','{\"instruction_teaching_staff\":[{\"program_name\":\"\",\"teaching_staff\":{\"4\":{\"2\":{\"on_campus_ft\":\"\"},\"3\":{\"on_campus_ft\":\"\"},\"4\":{\"on_campus_pt\":\"\"},\"5\":{\"on_campus_pt\":\"\"},\"6\":{\"on_campus_fte\":\"\"},\"7\":{\"on_campus_fte\":\"\"},\"8\":{\"distance_education_programs_ft\":\"\"},\"9\":{\"distance_education_programs_ft\":\"\"},\"10\":{\"distance_education_programs_pt\":\"\"},\"11\":{\"distance_education_programs_pt\":\"\"},\"12\":{\"distance_education_programs_fte\":\"\"},\"13\":{\"distance_education_programs_fte\":\"\"}},\"5\":{\"2\":{\"on_campus_ft\":\"\"},\"3\":{\"on_campus_ft\":\"\"},\"4\":{\"on_campus_pt\":\"\"},\"5\":{\"on_campus_pt\":\"\"},\"6\":{\"on_campus_fte\":\"\"},\"7\":{\"on_campus_fte\":\"\"},\"8\":{\"distance_education_programs_ft\":\"\"},\"9\":{\"distance_education_programs_ft\":\"\"},\"10\":{\"distance_education_programs_pt\":\"\"},\"11\":{\"distance_education_programs_pt\":\"\"},\"12\":{\"distance_education_programs_fte\":\"\"},\"13\":{\"distance_education_programs_fte\":\"\"}},\"6\":{\"2\":{\"on_campus_ft\":\"\"},\"3\":{\"on_campus_ft\":\"\"},\"4\":{\"on_campus_pt\":\"\"},\"5\":{\"on_campus_pt\":\"\"},\"6\":{\"on_campus_fte\":\"\"},\"7\":{\"on_campus_fte\":\"\"},\"8\":{\"distance_education_programs_ft\":\"\"},\"9\":{\"distance_education_programs_ft\":\"\"},\"10\":{\"distance_education_programs_pt\":\"\"},\"11\":{\"distance_education_programs_pt\":\"\"},\"12\":{\"distance_education_programs_fte\":\"\"},\"13\":{\"distance_education_programs_fte\":\"\"}}}}]}'),(10,2,17,18,1,0,2019,'Table 8. Program Completion Rate/Graduation Rate*','Node\\ncai18\\Inst_Prof_Table_8','2019-01-12 19:16:37',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','partly_compliant','{\"graduation_rate\":[{\"program_name\":\"\",\"student_rate\":{\"4\":{\"2\":{\"under_programs_4\":\"\"},\"3\":{\"under_programs_4\":\"\"},\"4\":{\"under_programs_4\":\"\"},\"5\":{\"under_programs_5\":\"\"},\"6\":{\"under_programs_5\":\"\"},\"7\":{\"under_programs_5\":\"\"},\"8\":{\"under_programs_6\":\"\"},\"9\":{\"under_programs_6\":\"\"},\"10\":{\"under_programs_6\":\"\"},\"11\":{\"master_programs_2\":\"\"},\"12\":{\"master_programs_2\":\"\"},\"13\":{\"master_programs_2\":\"\"},\"14\":{\"master_programs_3\":\"\"},\"15\":{\"master_programs_3\":\"\"},\"16\":{\"master_programs_3\":\"\"},\"17\":{\"master_programs_4\":\"\"},\"18\":{\"master_programs_4\":\"\"},\"19\":{\"master_programs_4\":\"\"},\"20\":{\"doctor_programs_3\":\"\"},\"21\":{\"doctor_programs_3\":\"\"},\"22\":{\"doctor_programs_3\":\"\"},\"23\":{\"doctor_programs_4\":\"\"},\"24\":{\"doctor_programs_4\":\"\"},\"25\":{\"doctor_programs_4\":\"\"},\"26\":{\"doctor_programs_5\":\"\"},\"27\":{\"doctor_programs_5\":\"\"},\"28\":{\"doctor_programs_5\":\"\"}},\"5\":{\"2\":{\"under_programs_4\":\"\"},\"3\":{\"under_programs_4\":\"\"},\"4\":{\"under_programs_4\":\"\"},\"5\":{\"under_programs_5\":\"\"},\"6\":{\"under_programs_5\":\"\"},\"7\":{\"under_programs_5\":\"\"},\"8\":{\"under_programs_6\":\"\"},\"9\":{\"under_programs_6\":\"\"},\"10\":{\"under_programs_6\":\"\"},\"11\":{\"master_programs_2\":\"\"},\"12\":{\"master_programs_2\":\"\"},\"13\":{\"master_programs_2\":\"\"},\"14\":{\"master_programs_3\":\"\"},\"15\":{\"master_programs_3\":\"\"},\"16\":{\"master_programs_3\":\"\"},\"17\":{\"master_programs_4\":\"\"},\"18\":{\"master_programs_4\":\"\"},\"19\":{\"master_programs_4\":\"\"},\"20\":{\"doctor_programs_3\":\"\"},\"21\":{\"doctor_programs_3\":\"\"},\"22\":{\"doctor_programs_3\":\"\"},\"23\":{\"doctor_programs_4\":\"\"},\"24\":{\"doctor_programs_4\":\"\"},\"25\":{\"doctor_programs_4\":\"\"},\"26\":{\"doctor_programs_5\":\"\"},\"27\":{\"doctor_programs_5\":\"\"},\"28\":{\"doctor_programs_5\":\"\"}},\"6\":{\"2\":{\"under_programs_4\":\"\"},\"3\":{\"under_programs_4\":\"\"},\"4\":{\"under_programs_4\":\"\"},\"5\":{\"under_programs_5\":\"\"},\"6\":{\"under_programs_5\":\"\"},\"7\":{\"under_programs_5\":\"\"},\"8\":{\"under_programs_6\":\"\"},\"9\":{\"under_programs_6\":\"\"},\"10\":{\"under_programs_6\":\"\"},\"11\":{\"master_programs_2\":\"\"},\"12\":{\"master_programs_2\":\"\"},\"13\":{\"master_programs_2\":\"\"},\"14\":{\"master_programs_3\":\"\"},\"15\":{\"master_programs_3\":\"\"},\"16\":{\"master_programs_3\":\"\"},\"17\":{\"master_programs_4\":\"\"},\"18\":{\"master_programs_4\":\"\"},\"19\":{\"master_programs_4\":\"\"},\"20\":{\"doctor_programs_3\":\"\"},\"21\":{\"doctor_programs_3\":\"\"},\"22\":{\"doctor_programs_3\":\"\"},\"23\":{\"doctor_programs_4\":\"\"},\"24\":{\"doctor_programs_4\":\"\"},\"25\":{\"doctor_programs_4\":\"\"},\"26\":{\"doctor_programs_5\":\"\"},\"27\":{\"doctor_programs_5\":\"\"},\"28\":{\"doctor_programs_5\":\"\"}}}}]}'),(11,1,20,63,1,0,2019,'Eligibility Requirements for an Application for Institutional Accreditation (ER)','Node\\ncai18\\Eligibility_Requirements','2019-01-12 19:16:37',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(12,11,21,22,1,0,2019,'1. Final Licence','Node\\ncai18\\Eligibility_Requirements_1','2019-01-12 19:16:37',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(13,11,23,24,1,0,2019,'2. Consistent activities','Node\\ncai18\\Eligibility_Requirements_2','2019-01-12 19:16:37',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(14,11,25,26,1,0,2019,'3. Mission','Node\\ncai18\\Eligibility_Requirements_3','2019-01-12 19:16:37',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(15,11,27,28,1,0,2019,'4. Strategic Plan and associated plans','Node\\ncai18\\Eligibility_Requirements_4','2019-01-12 19:16:37',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(16,11,29,30,1,0,2019,'5. Administrative Policies and Procedures','Node\\ncai18\\Eligibility_Requirements_5','2019-01-12 19:16:37',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(17,11,31,32,1,0,2019,'6. Student Handbooks and guides','Node\\ncai18\\Eligibility_Requirements_6','2019-01-12 19:16:37',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(18,11,33,34,1,0,2019,'7. Help Box Program Specifications (refer attachment 1)','Node\\ncai18\\Eligibility_Requirements_7','2019-01-12 19:16:38',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(19,11,35,36,1,0,2019,'8. Course Specifications  (refer attachment  2)','Node\\ncai18\\Eligibility_Requirements_8','2019-01-12 19:16:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(20,11,37,38,1,0,2019,'9. Program Approval Policy and procedures','Node\\ncai18\\Eligibility_Requirements_9','2019-01-12 19:16:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(21,11,39,40,1,0,2019,'10. Guide books for monitoring quality and improving programs.','Node\\ncai18\\Eligibility_Requirements_10','2019-01-12 19:16:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(22,11,41,42,1,0,2019,'11. Record Management','Node\\ncai18\\Eligibility_Requirements_11','2019-01-12 19:16:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(23,11,43,44,1,0,2019,'12. Student Evaluation','Node\\ncai18\\Eligibility_Requirements_12','2019-01-12 19:16:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(24,11,45,46,1,0,2019,'13. Quality Assurance System','Node\\ncai18\\Eligibility_Requirements_13','2019-01-12 19:16:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(25,11,47,48,1,0,2019,'14. Key Performance Indicators and Benchmarks','Node\\ncai18\\Eligibility_Requirements_14','2019-01-12 19:16:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(26,11,49,50,1,0,2019,'15. Comparative benchmarks','Node\\ncai18\\Eligibility_Requirements_15','2019-01-12 19:16:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(27,11,51,52,1,0,2019,'16. Research','Node\\ncai18\\Eligibility_Requirements_16','2019-01-12 19:16:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(28,11,53,54,1,0,2019,'17. Community Service activities','Node\\ncai18\\Eligibility_Requirements_17','2019-01-12 19:16:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(29,11,55,56,1,0,2019,'18. Alumni or Graduate Data','Node\\ncai18\\Eligibility_Requirements_18','2019-01-12 19:16:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(30,11,57,58,1,0,2019,'19. Self Evaluation Scales (SES) and Self Study for Institutions (SSRI) (refer attachment 3 & 4 )','Node\\ncai18\\Eligibility_Requirements_19','2019-01-12 19:16:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(31,11,59,60,1,0,2019,'Eligibility for Institutional Accreditation Checklist','Node\\ncai18\\Eligibility_Checklist','2019-01-12 19:16:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"institution\":\"\",\"date\":\"\",\"checklist_table\":[]}'),(32,11,61,62,1,0,2019,'Signatures','Node\\ncassr14\\Eligibility_Requirements_Signature','2019-01-12 19:16:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"university_rector\":\"\",\"date\":\"\"}'),(33,1,64,225,1,0,2019,'Self Evaluation Scales (SES)','Node\\ncai18\\Ses','2019-01-12 19:16:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(34,33,65,78,1,0,2019,'Standard 1. Mission Goals and Objectives','Node\\ncai18\\Ses_Standard_1','2019-01-12 19:16:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(35,34,66,67,1,0,2019,'1.1 Appropriateness of the Mission','Node\\ncai18\\Ses_Standard_1_1','2019-01-12 19:16:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"1_1_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_1_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_1_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_1_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_1_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_1_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(36,34,68,69,1,0,2019,'1.2 Usefulness of the Mission Statement','Node\\ncai18\\Ses_Standard_1_2','2019-01-12 19:16:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"1_2_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_2_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_2_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_2_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(37,34,70,71,1,0,2019,'1.3 Development and Review of the Mission','Node\\ncai18\\Ses_Standard_1_3','2019-01-12 19:16:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"1_3_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_3_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_3_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_3_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(38,34,72,73,1,0,2019,'1.4 Use Made of the Mission','Node\\ncai18\\Ses_Standard_1_4','2019-01-12 19:16:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"1_4_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_4_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_4_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(39,34,74,75,1,0,2019,'1.5 Relationship Between Mission, Goals and Objectives','Node\\ncai18\\Ses_Standard_1_5','2019-01-12 19:16:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"1_5_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_5_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_5_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_5_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_5_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(40,34,76,77,1,0,2019,'Overall Assessment of Mission Goals and Objectives','Node\\ncai18\\Ses_Standard_1_Overall','2019-01-12 19:16:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"1_1\":\"\",\"1_2\":\"\",\"1_3\":\"\",\"1_4\":\"\",\"1_5\":\"\",\"combined_assessment\":\"\",\"comment\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\",\"indicators_considered\":\"\",\"priorities_for_improvement\":\"\"}'),(41,33,79,98,1,0,2019,'Standard 2. Governance and Administration','Node\\ncai18\\Ses_Standard_2','2019-01-12 19:16:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(42,41,80,81,1,0,2019,'2.1 Governing Body','Node\\ncai18\\Ses_Standard_2_1','2019-01-12 19:16:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"2_1_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_1_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_1_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_1_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_1_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_1_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_1_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_1_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_1_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_1_10\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_1_11\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_1_12\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(43,41,82,83,1,0,2019,'2.2 Leadership','Node\\ncai18\\Ses_Standard_2_2','2019-01-12 19:16:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"2_2_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_2_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_2_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_2_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_2_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_2_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_2_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_2_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_2_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_2_10\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_2_11\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_2_12\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_2_13\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(44,41,84,85,1,0,2019,'2.3 Planning Processes','Node\\ncai18\\Ses_Standard_2_3','2019-01-12 19:16:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"2_3_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_3_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_3_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_3_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_3_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_3_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_3_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_3_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_3_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_3_10\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(45,41,86,87,1,0,2019,'2.4 Relationship Between Sections for Male and Female Students','Node\\ncai18\\Ses_Standard_2_4','2019-01-12 19:16:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"2_4_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_4_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_4_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_4_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(46,41,88,89,1,0,2019,'2.5 Integrity','Node\\ncai18\\Ses_Standard_2_5','2019-01-12 19:16:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"2_5_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_5_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_5_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_5_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_5_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(47,41,90,91,1,0,2019,'2.6 Internal Policies and Regulations','Node\\ncai18\\Ses_Standard_2_6','2019-01-12 19:16:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"2_6_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_6_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_6_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_6_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_6_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(48,41,92,93,1,0,2019,'2.7 Organizational Climate','Node\\ncai18\\Ses_Standard_2_7','2019-01-12 19:16:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"2_7_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_7_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_7_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_7_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_7_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(49,41,94,95,1,0,2019,'2.8 Associated Companies and Controlled Entities','Node\\ncai18\\Ses_Standard_2_8','2019-01-12 19:16:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"2_8_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_8_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_8_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_8_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_8_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_8_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(50,41,96,97,1,0,2019,'Overall Assessment of Governance and Administration','Node\\ncai18\\Ses_Standard_2_Overall','2019-01-12 19:16:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"2_1\":\"\",\"2_2\":\"\",\"2_3\":\"\",\"2_4\":\"\",\"2_5\":\"\",\"2_6\":\"\",\"2_7\":\"\",\"2_8\":\"\",\"combined_assessment\":\"\",\"comment\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\",\"indicators_considered\":\"\",\"priorities_for_improvement\":\"\"}'),(51,33,99,112,1,0,2019,'Standard 3. Management of Quality Assurance and Improvement Processes','Node\\ncai18\\Ses_Standard_3','2019-01-12 19:16:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(52,51,100,101,1,0,2019,'3.1 Institutional Commitment to Quality Improvement','Node\\ncai18\\Ses_Standard_3_1','2019-01-12 19:16:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"3_1_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_1_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_1_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_1_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_1_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_1_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_1_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(53,51,102,103,1,0,2019,'3.2 Scope of Quality Assurance Processes','Node\\ncai18\\Ses_Standard_3_2','2019-01-12 19:16:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"3_2_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_2_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_2_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_2_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_2_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_2_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_2_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(54,51,104,105,1,0,2019,'3.3 Administration of Quality Assurance Processes','Node\\ncai18\\Ses_Standard_3_3','2019-01-12 19:16:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"3_3_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_3_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_3_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_3_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_3_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_3_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_3_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_3_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_3_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_3_10\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_3_11\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_3_12\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(55,51,106,107,1,0,2019,'3.4 Use of Indicators and Benchmarks','Node\\ncai18\\Ses_Standard_3_4','2019-01-12 19:16:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"3_4_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_4_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_4_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_4_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_4_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_4_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(56,51,108,109,1,0,2019,'3.5 Independent Verification of Standards ','Node\\ncai18\\Ses_Standard_3_5','2019-01-12 19:16:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"3_5_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_5_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_5_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(57,51,110,111,1,0,2019,'Overall Assessment of Management of Quality Assurance and Improvement Processes','Node\\ncai18\\Ses_Standard_3_Overall','2019-01-12 19:16:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"3_1\":\"\",\"3_2\":\"\",\"3_3\":\"\",\"3_4\":\"\",\"3_5\":\"\",\"combined_assessment\":\"\",\"comment\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\",\"indicators_considered\":\"\",\"priorities_for_improvement\":\"\"}'),(58,33,113,138,1,0,2019,'Standard 4. Learning and Teaching','Node\\ncai18\\Ses_Standard_4','2019-01-12 19:16:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(59,58,114,115,1,0,2019,'4.1 Institutional Oversight of Quality of Learning and Teaching','Node\\ncai18\\Ses_Standard_4_1','2019-01-12 19:16:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"4_1_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_1_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_1_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_1_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_1_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_1_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_1_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_1_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_1_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_1_10\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_1_11\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_1_12\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(60,58,116,117,1,0,2019,'4.2 Student Learning Outcomes','Node\\ncai18\\Ses_Standard_4_2','2019-01-12 19:16:40',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"4_2_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_2_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_2_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_2_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_2_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(61,58,118,119,1,0,2019,'4.3 Program Development Processes','Node\\ncai18\\Ses_Standard_4_3','2019-01-12 19:16:40',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"4_3_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_3_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_3_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_3_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_3_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_3_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_3_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(62,58,120,121,1,0,2019,'4.4 Program Evaluation and Review Processes','Node\\ncai18\\Ses_Standard_4_4','2019-01-12 19:16:40',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"4_4_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_4_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_4_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_4_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_4_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_4_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_4_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_4_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_4_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_4_10\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(63,58,122,123,1,0,2019,'4.5 Student Assessment','Node\\ncai18\\Ses_Standard_4_5','2019-01-12 19:16:40',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"4_5_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_5_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_5_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_5_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_5_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_5_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_5_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_5_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_5_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_5_10\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(64,58,124,125,1,0,2019,'4.6 Educational Assistance for Students','Node\\ncai18\\Ses_Standard_4_6','2019-01-12 19:16:40',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"4_6_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_6_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_6_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_6_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_6_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_6_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_6_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_6_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_6_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_6_10\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_6_11\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_6_12\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_6_13\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_6_14\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(65,58,126,127,1,0,2019,'4.7 Quality of Teaching','Node\\ncai18\\Ses_Standard_4_7','2019-01-12 19:16:40',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"4_7_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_7_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_7_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_7_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_7_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_7_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_7_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_7_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_7_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_7_10\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_7_11\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_7_12\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(66,58,128,129,1,0,2019,'4.8 Support for Improvements in Quality of Teaching','Node\\ncai18\\Ses_Standard_4_8','2019-01-12 19:16:40',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"4_8_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_8_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_8_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_8_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_8_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_8_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_8_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(67,58,130,131,1,0,2019,'4.9 Qualifications and Experience of Teaching Staff','Node\\ncai18\\Ses_Standard_4_9','2019-01-12 19:16:40',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"4_9_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_9_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_9_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_9_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_9_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(68,58,132,133,1,0,2019,'4.10 Field Experience Activities','Node\\ncai18\\Ses_Standard_4_10','2019-01-12 19:16:40',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"4_10_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_10_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_10_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_10_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_10_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_10_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_10_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_10_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_10_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_10_10\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(69,58,134,135,1,0,2019,'4.11 Partnership Arrangements With Other Institutions','Node\\ncai18\\Ses_Standard_4_11','2019-01-12 19:16:40',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"4_11_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_11_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_11_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_11_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_11_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_11_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_11_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_11_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_11_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(70,58,136,137,1,0,2019,'Overall Assessment of Learning and Teaching','Node\\ncai18\\Ses_Standard_4_Overall','2019-01-12 19:16:40',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"4_1\":\"\",\"4_2\":\"\",\"4_3\":\"\",\"4_4\":\"\",\"4_5\":\"\",\"4_6\":\"\",\"4_7\":\"\",\"4_8\":\"\",\"4_9\":\"\",\"4_10\":\"\",\"4_11\":\"\",\"combined_assessment\":\"\",\"comment\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\",\"indicators_considered\":\"\",\"priorities_for_improvement\":\"\"}'),(71,33,139,154,1,0,2019,'Standard 5. Student Administration and Support Services','Node\\ncai18\\Ses_Standard_5','2019-01-12 19:16:40',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(72,71,140,141,1,0,2019,'5.1 Student Admissions','Node\\ncai18\\Ses_Standard_5_1','2019-01-12 19:16:40',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"5_1_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_1_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_1_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_1_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_1_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_1_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_1_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_1_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_1_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_1_10\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_1_11\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_1_12\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(73,71,142,143,1,0,2019,'5.2 Student Records','Node\\ncai18\\Ses_Standard_5_2','2019-01-12 19:16:40',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"5_2_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_2_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_2_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_2_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_2_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_2_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_2_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_2_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(74,71,144,145,1,0,2019,'5.3 Student Management','Node\\ncai18\\Ses_Standard_5_3','2019-01-12 19:16:40',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"5_3_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_3_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_3_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_3_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_3_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_3_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_3_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_3_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(75,71,146,147,1,0,2019,'5.4 Planning and Evaluation of Student Services','Node\\ncai18\\Ses_Standard_5_4','2019-01-12 19:16:40',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"5_4_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_4_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_4_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_4_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_4_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_4_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_4_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(76,71,148,149,1,0,2019,'5.5 Medical and Counselling Services','Node\\ncai18\\Ses_Standard_5_5','2019-01-12 19:16:40',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"5_5_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_5_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_5_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_5_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_5_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_5_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(77,71,150,151,1,0,2019,'5.6 Extra-curricular Activities for Students','Node\\ncai18\\Ses_Standard_5_6','2019-01-12 19:16:40',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"5_6_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_6_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_6_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_6_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_6_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(78,71,152,153,1,0,2019,'Overall Assessment of Student Administration and Support Services','Node\\ncai18\\Ses_Standard_5_Overall','2019-01-12 19:16:40',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"5_1\":\"\",\"5_2\":\"\",\"5_3\":\"\",\"5_4\":\"\",\"5_5\":\"\",\"5_6\":\"\",\"combined_assessment\":\"\",\"comment\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\",\"indicators_considered\":\"\",\"priorities_for_improvement\":\"\"}'),(79,33,155,166,1,0,2019,'Standard 6. Learning Resources','Node\\ncai18\\Ses_Standard_6','2019-01-12 19:16:40',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(80,79,156,157,1,0,2019,'6.1 Planning and Evaluation','Node\\ncai18\\Ses_Standard_6_1','2019-01-12 19:16:41',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"6_1_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_1_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_1_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_1_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_1_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_1_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_1_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(81,79,158,159,1,0,2019,'6.2 Organization','Node\\ncai18\\Ses_Standard_6_2','2019-01-12 19:16:41',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"6_2_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_2_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_2_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_2_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_2_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_2_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_2_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_2_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(82,79,160,161,1,0,2019,'6.3 Support for Users','Node\\ncai18\\Ses_Standard_6_3','2019-01-12 19:16:41',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"6_3_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_3_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_3_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_3_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_3_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_3_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_3_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(83,79,162,163,1,0,2019,'6.4 Resources and Facilities','Node\\ncai18\\Ses_Standard_6_4','2019-01-12 19:16:41',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"6_4_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_4_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_4_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_4_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_4_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_4_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_4_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_4_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_4_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(84,79,164,165,1,0,2019,'Overall Assessment of Learning Resources','Node\\ncai18\\Ses_Standard_6_Overall','2019-01-12 19:16:41',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"6_1\":\"\",\"6_2\":\"\",\"6_3\":\"\",\"6_4\":\"\",\"combined_assessment\":\"\",\"comment\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\",\"indicators_considered\":\"\",\"priorities_for_improvement\":\"\"}'),(85,33,167,180,1,0,2019,'Standard 7. Facilities and Equipment','Node\\ncai18\\Ses_Standard_7','2019-01-12 19:16:41',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(86,85,168,169,1,0,2019,'7.1 Policy and Planning','Node\\ncai18\\Ses_Standard_7_1','2019-01-12 19:16:41',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"7_1_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_1_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_1_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_1_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_1_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_1_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(87,85,170,171,1,0,2019,'7.2 Quality and Adequacy of Facilities and Equipment','Node\\ncai18\\Ses_Standard_7_2','2019-01-12 19:16:41',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"7_2_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_2_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_2_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_2_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_2_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_2_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_2_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_2_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_2_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(88,85,172,173,1,0,2019,'7.3 Management and Administration','Node\\ncai18\\Ses_Standard_7_3','2019-01-12 19:16:41',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"7_3_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_3_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_3_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_3_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_3_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_3_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_3_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_3_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(89,85,174,175,1,0,2019,'7.4 Information Technology','Node\\ncai18\\Ses_Standard_7_4','2019-01-12 19:16:41',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"7_4_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_4_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_4_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_4_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_4_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_4_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_4_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_4_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_4_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_4_10\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_4_11\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(90,85,176,177,1,0,2019,'7.5 Student Residences','Node\\ncai18\\Ses_Standard_7_5','2019-01-12 19:16:41',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"7_5_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_5_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_5_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_5_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_5_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_5_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_5_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_5_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(91,85,178,179,1,0,2019,'Overall Assessment of Facilities and Equipment','Node\\ncai18\\Ses_Standard_7_Overall','2019-01-12 19:16:41',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"7_1\":\"\",\"7_2\":\"\",\"7_3\":\"\",\"7_4\":\"\",\"7_5\":\"\",\"combined_assessment\":\"\",\"comment\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\",\"indicators_considered\":\"\",\"priorities_for_improvement\":\"\"}'),(92,33,181,190,1,0,2019,'Standard 8. Financial Planning and Management','Node\\ncai18\\Ses_Standard_8','2019-01-12 19:16:41',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(93,92,182,183,1,0,2019,'8.1 Financial Planning and Budgeting','Node\\ncai18\\Ses_Standard_8_1','2019-01-12 19:16:41',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"8_1_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_1_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_1_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_1_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_1_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_1_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_1_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_1_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_1_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(94,92,184,185,1,0,2019,'8.2 Financial Management','Node\\ncai18\\Ses_Standard_8_2','2019-01-12 19:16:41',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"8_2_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_2_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_2_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_2_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_2_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_2_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_2_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_2_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_2_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_2_10\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(95,92,186,187,1,0,2019,'8.3 Auditing and Risk assessment','Node\\ncai18\\Ses_Standard_8_3','2019-01-12 19:16:41',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"8_3_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_3_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_3_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_3_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(96,92,188,189,1,0,2019,'Overall Assessment of Financial Planning and Management','Node\\ncai18\\Ses_Standard_8_Overall','2019-01-12 19:16:41',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"8_1\":\"\",\"8_2\":\"\",\"8_3\":\"\",\"combined_assessment\":\"\",\"comment\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\",\"indicators_considered\":\"\",\"priorities_for_improvement\":\"\"}'),(97,33,191,202,1,0,2019,'Standard 9. Employment Processes','Node\\ncai18\\Ses_Standard_9','2019-01-12 19:16:41',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(98,97,192,193,1,0,2019,'9.1 Policy and Administration','Node\\ncai18\\Ses_Standard_9_1','2019-01-12 19:16:41',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"9_1_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_1_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_1_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_1_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_1_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_1_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_1_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_1_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_1_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(99,97,194,195,1,0,2019,'9.2 Recruitment','Node\\ncai18\\Ses_Standard_9_2','2019-01-12 19:16:41',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"9_2_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_2_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_2_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_2_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_2_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_2_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_2_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_2_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_2_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(100,97,196,197,1,0,2019,'9.3 Personal and Career Development','Node\\ncai18\\Ses_Standard_9_3','2019-01-12 19:16:41',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"9_3_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_3_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_3_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_3_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_3_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_3_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_3_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_3_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_3_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_3_10\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_3_11\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(101,97,198,199,1,0,2019,'9.4 Discipline, Complaints and Dispute Resolution','Node\\ncai18\\Ses_Standard_9_4','2019-01-12 19:16:41',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"9_4_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_4_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_4_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_4_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_4_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(102,97,200,201,1,0,2019,'Overall Assessment of Employment Processes','Node\\ncai18\\Ses_Standard_9_Overall','2019-01-12 19:16:42',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"9_1\":\"\",\"9_2\":\"\",\"9_3\":\"\",\"9_4\":\"\",\"combined_assessment\":\"\",\"comment\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\",\"indicators_considered\":\"\",\"priorities_for_improvement\":\"\"}'),(103,33,203,214,1,0,2019,'Standard 10. Research','Node\\ncai18\\Ses_Standard_10','2019-01-12 19:16:42',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(104,103,204,205,1,0,2019,'10.1 Institutional Research Policies','Node\\ncai18\\Ses_Standard_10_1','2019-01-12 19:16:42',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"10_1_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_1_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_1_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_1_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_1_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_1_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_1_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_1_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_1_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_1_10\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(105,103,206,207,1,0,2019,'10.2 Teaching Staff and Student Involvement','Node\\ncai18\\Ses_Standard_10_2','2019-01-12 19:16:42',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"10_2_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_2_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_2_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_2_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_2_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_2_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_2_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(106,103,208,209,1,0,2019,'10.3 Commercialization of Research','Node\\ncai18\\Ses_Standard_10_3','2019-01-12 19:16:42',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"10_3_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_3_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_3_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_3_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_3_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(107,103,210,211,1,0,2019,'10.4 Research Facilities and Equipment','Node\\ncai18\\Ses_Standard_10_4','2019-01-12 19:16:42',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"10_4_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_4_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_4_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_4_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_4_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(108,103,212,213,1,0,2019,'Overall Assessment of Research','Node\\ncai18\\Ses_Standard_10_Overall','2019-01-12 19:16:42',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"10_1\":\"\",\"10_2\":\"\",\"10_3\":\"\",\"10_4\":\"\",\"combined_assessment\":\"\",\"comment\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\",\"indicators_considered\":\"\",\"priorities_for_improvement\":\"\"}'),(109,33,215,224,1,0,2019,'Standard 11. Relationships with the Community','Node\\ncai18\\Ses_Standard_11','2019-01-12 19:16:42',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(110,109,216,217,1,0,2019,'11.1 Institutional Policies on Community Relationships','Node\\ncai18\\Ses_Standard_11_1','2019-01-12 19:16:42',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"11_1_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"11_1_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"11_1_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"11_1_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"11_1_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(111,109,218,219,1,0,2019,'11.2 Interactions With the Community','Node\\ncai18\\Ses_Standard_11_2','2019-01-12 19:16:42',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"11_2_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"11_2_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"11_2_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"11_2_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"11_2_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"11_2_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"11_2_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"11_2_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"11_2_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(112,109,220,221,1,0,2019,'11.3 Institutional Reputation','Node\\ncai18\\Ses_Standard_11_3','2019-01-12 19:16:42',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"11_3_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"11_3_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"11_3_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"11_3_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"11_3_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"11_3_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(113,109,222,223,1,0,2019,'Overall Assessment of Institutional Relationships with the Community','Node\\ncai18\\Ses_Standard_11_Overall','2019-01-12 19:16:42',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"11_1\":\"\",\"11_2\":\"\",\"11_3\":\"\",\"combined_assessment\":\"\",\"comment\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\",\"indicators_considered\":\"\",\"priorities_for_improvement\":\"\"}'),(114,1,226,379,1,0,2019,'Self Study Report for Institutions (SSRI)','Node\\ncai18\\Ssri','2019-01-12 19:16:42',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(115,114,227,228,1,0,2019,'A. General Information','Node\\ncai18\\Ssri_A_General_Info','2019-01-12 19:16:42',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"name_of_institution\":\"Jadeer\"}'),(116,114,229,250,1,0,2019,'B. Institutional Profile','Node\\ncai18\\Ssri_B_Institutional_Pro','2019-01-12 19:16:42',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"history_of_institution\":\"\",\"management_and_organizational\":\"\",\"institution_accreditation\":\"\",\"institution_quality\":\"\",\"institution_strategic_plan\":\"\",\"institution_achievements\":\"\"}'),(117,116,230,239,1,0,2019,'Periodic Institutional Profile Template A1','Node\\ncai18\\Ssri_Template_A1','2019-01-12 19:16:42',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"institution\":\"Jadeer\",\"date\":\"2019-01-12\"}'),(118,117,231,232,1,1,2019,'Al Huson University College (Programs Data)','Node\\ncai18\\Ssri_Template_A1_Program_Data','2019-01-12 19:16:42',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"college\":\"Al Huson University College\"}'),(119,117,233,234,1,4,2019,'pharmacy college (Programs Data)','Node\\ncai18\\Ssri_Template_A1_Program_Data','2019-01-12 19:16:42',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"college\":\"pharmacy college\"}'),(120,117,235,236,1,3,2019,'press college Saud college  (Programs Data)','Node\\ncai18\\Ssri_Template_A1_Program_Data','2019-01-12 19:16:42',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"college\":\"press college Saud college \"}'),(121,117,237,238,1,2,2019,'prince ghazi college for information technology (Programs Data)','Node\\ncai18\\Ssri_Template_A1_Program_Data','2019-01-12 19:16:42',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"college\":\"prince ghazi college for information technology\"}'),(122,116,240,249,1,0,2019,'Periodic Institutional Profile Template A2','Node\\ncai18\\Ssri_Template_A2','2019-01-12 19:16:43',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"institution\":\"Jadeer\",\"date\":\"2019-01-12\"}'),(123,122,241,242,1,1,2019,'Al Huson University College (Program Data)','Node\\ncai18\\Ssri_Template_A2_Program_Data','2019-01-12 19:16:43',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"college\":\"Al Huson University College\"}'),(124,122,243,244,1,4,2019,'pharmacy college (Program Data)','Node\\ncai18\\Ssri_Template_A2_Program_Data','2019-01-12 19:16:43',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"college\":\"pharmacy college\"}'),(125,122,245,246,1,3,2019,'press college Saud college  (Program Data)','Node\\ncai18\\Ssri_Template_A2_Program_Data','2019-01-12 19:16:43',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"college\":\"press college Saud college \"}'),(126,122,247,248,1,2,2019,'prince ghazi college for information technology (Program Data)','Node\\ncai18\\Ssri_Template_A2_Program_Data','2019-01-12 19:16:43',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"college\":\"prince ghazi college for information technology\"}'),(127,114,251,252,1,0,2019,'C. Self-Study Process','Node\\ncai18\\Ssri_C_Self_Study_Process','2019-01-12 19:16:43',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"description_of_procedures\":\"\"}'),(128,114,253,254,1,0,2019,'D. Context of the Self Study','Node\\ncai18\\Ssri_D_Context_Of_The_Self_Study','2019-01-12 19:16:43',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"environmental_context\":\"\",\"institutional_context\":\"\"}'),(129,114,255,256,1,0,2019,'E. Mission,Goals and Strategic Objectives for Quality Improvement.','Node\\ncai18\\Ssri_E_Mission_And_Goals','2019-01-12 19:16:43',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"mission\":\"\",\"strategic_plan\":[],\"strengths_and_recommendations\":\"\"}'),(130,114,257,258,1,0,2019,'F. Progress towards Quality Objectives','Node\\ncai18\\Ssri_F_Progress_Towards','2019-01-12 19:16:43',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"assessment\":\"\"}'),(131,114,259,370,1,0,2019,'G. Evaluation in Relation to Quality Standards','Node\\ncai18\\Ssri_G_Evaluation','2019-01-12 19:16:43',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(132,131,260,265,1,0,2019,'1. Mission and Objectives','Node\\ncai18\\Ssri_G_Evaluation_1_Mission','2019-01-12 19:16:43',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"overall_rating\":\"\",\"explanatory_report\":\"\",\"standard_description\":\"\",\"1_1\":\"\",\"1_2\":\"\",\"1_3\":\"\",\"1_4\":\"\",\"1_5\":\"\",\"quality_mission\":\"\"}'),(133,132,261,262,1,0,2019,'KPI S1.1','Node\\ncai18\\kpi','2019-01-12 19:16:43',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":1,\"kpi_id\":\"1\",\"kpi_info\":\"Stakeholders\' awareness ratings of the Mission Statement and Objectives (Average rating on how well the mission is known to teaching staff, and undergraduate and graduate students, respectively, on a five- point scale in an annual survey).\",\"kpi_ref_num\":\"S1.1\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(134,132,263,264,1,0,2019,'List of Annexes for standard 1','Node\\ncai18\\Annexes_List','2019-01-12 19:16:43',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":1}'),(135,131,266,271,1,0,2019,'2. Governance and Administration','Node\\ncai18\\Ssri_G_Evaluation_2_Administration','2019-01-12 19:16:43',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"overall_rating\":\"\",\"explanatory_report\":\"\",\"standard_description\":\"\",\"2_1\":\"\",\"2_2\":\"\",\"2_3\":\"\",\"2_4\":\"\",\"2_5\":\"\",\"2_6\":\"\",\"2_7\":\"\",\"2_8\":\"\",\"quality_mission\":\"\"}'),(136,135,267,268,1,0,2019,'KPI S2.1','Node\\ncai18\\kpi','2019-01-12 19:16:43',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":2,\"kpi_id\":\"2\",\"kpi_info\":\"Stakeholder evaluation of the Policy Handbook, including administrative flow chart and job responsibilities (Average rating on the adequacy of the Policy Handbook on a five- point scale in an annual survey of teaching staff and final year students).\",\"kpi_ref_num\":\"S2.1\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(137,135,269,270,1,0,2019,'List of Annexes for standard 2','Node\\ncai18\\Annexes_List','2019-01-12 19:16:43',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":2}'),(138,131,272,283,1,0,2019,'3. Management of Quality Assurance and Improvement','Node\\ncai18\\Ssri_G_Evaluation_3_Quality_Assurance','2019-01-12 19:16:43',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"overall_rating\":\"\",\"standard_description\":\"\",\"summary_report\":\"\",\"standard_kpi\":[],\"summary_and_analysis\":\"\",\"3_1\":\"\",\"3_2\":\"\",\"3_3\":\"\",\"3_4\":\"\",\"3_5\":\"\",\"quality_mission\":\"\"}'),(139,138,273,274,1,0,2019,'KPI S3.1','Node\\ncai18\\kpi','2019-01-12 19:16:43',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":3,\"kpi_id\":\"3\",\"kpi_info\":\"Students\' overall evaluation on the quality of their learning experiences. (Average rating of the overall quality on a five point scale in an annual survey of final year students.)\",\"kpi_ref_num\":\"S3.1\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(140,138,275,276,1,0,2019,'KPI S3.2','Node\\ncai18\\kpi','2019-01-12 19:16:44',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":3,\"kpi_id\":\"4\",\"kpi_info\":\"Proportion of courses in which student evaluations were conducted during the year.\",\"kpi_ref_num\":\"S3.2\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(141,138,277,278,1,0,2019,'KPI S3.3','Node\\ncai18\\kpi','2019-01-12 19:16:44',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":3,\"kpi_id\":\"5\",\"kpi_info\":\"Proportion of programs in which there was an independent verification, within the institution, of standards of student achievement during the year.\",\"kpi_ref_num\":\"S3.3\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(142,138,279,280,1,0,2019,'KPI S3.4','Node\\ncai18\\kpi','2019-01-12 19:16:44',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":3,\"kpi_id\":\"6\",\"kpi_info\":\"Proportion of programs in which there was an independent verification of standards of student achievement by people (evaluators) external to the institution during the year.\",\"kpi_ref_num\":\"S3.4\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(143,138,281,282,1,0,2019,'List of Annexes for standard 3','Node\\ncai18\\Annexes_List','2019-01-12 19:16:44',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":3}'),(144,131,284,301,1,0,2019,'4. Learning and Teaching.','Node\\ncai18\\Ssri_G_Evaluation_4_Learning_And_Teaching','2019-01-12 19:16:44',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"overall_rating\":\"\",\"standard_description\":\"\",\"4_1\":\"\",\"4_2\":\"\",\"4_3\":\"\",\"4_4\":\"\",\"4_5\":\"\",\"4_6\":\"\",\"4_7\":\"\",\"4_8\":\"\",\"4_9\":\"\",\"4_10\":\"\",\"4_11\":\"\",\"quality_mission\":\"\",\"general_conclusion\":\"\"}'),(145,144,285,286,1,0,2019,'KPI S4.1','Node\\ncai18\\kpi','2019-01-12 19:16:44',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":4,\"kpi_id\":\"7\",\"kpi_info\":\"Ratio of students to teaching staff. (Based on full time equivalents)\",\"kpi_ref_num\":\"S4.1\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(146,144,287,288,1,0,2019,'KPI S4.2','Node\\ncai18\\kpi','2019-01-12 19:16:44',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":4,\"kpi_id\":\"8\",\"kpi_info\":\"Students overall rating on the quality of their courses. (Average rating of students on a five point scale on overall evaluation of courses.)\",\"kpi_ref_num\":\"S4.2\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(147,144,289,290,1,0,2019,'KPI S4.3','Node\\ncai18\\kpi','2019-01-12 19:16:44',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":4,\"kpi_id\":\"9\",\"kpi_info\":\"Proportion of teaching staff with verified doctoral qualifications.\",\"kpi_ref_num\":\"S4.3\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(148,144,291,292,1,0,2019,'KPI S4.4','Node\\ncai18\\kpi','2019-01-12 19:16:44',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":4,\"kpi_id\":\"10\",\"kpi_info\":\"Retention Rate; Percentage of students entering programs who successfully complete first year.\",\"kpi_ref_num\":\"S4.4\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(149,144,293,294,1,0,2019,'KPI S4.5','Node\\ncai18\\kpi','2019-01-12 19:16:44',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":4,\"kpi_id\":\"11\",\"kpi_info\":\"Graduation Rate for Undergraduate Students: Proportion of students entering undergraduate programs who complete those programs in minimum time.\",\"kpi_ref_num\":\"S4.5\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(150,144,295,296,1,0,2019,'KPI S4.6','Node\\ncai18\\kpi','2019-01-12 19:16:44',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":4,\"kpi_id\":\"12\",\"kpi_info\":\"Graduation Rates for Post Graduate Students: Proportion of students entering post graduate programs who complete those programs in specified time.\",\"kpi_ref_num\":\"S4.6\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(151,144,297,298,1,0,2019,'KPI S4.7','Node\\ncai18\\kpi','2019-01-12 19:16:44',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":4,\"kpi_id\":\"13\",\"kpi_info\":\"Proportion of graduates from undergraduate programs who within six months of graduation are: \\n(a) employed \\n(b) enrolled in further study \\n(c) not seeking employment or further study\",\"kpi_ref_num\":\"S4.7\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(152,144,299,300,1,0,2019,'List of Annexes for standard 4','Node\\ncai18\\Annexes_List','2019-01-12 19:16:44',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":4}'),(153,131,302,311,1,0,2019,'5. Student Administration and Support Services','Node\\ncai18\\Ssri_G_Evaluation_5_Student_Administration','2019-01-12 19:16:44',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"overall_rating\":\"\",\"explanatory_report\":\"\",\"standard_description\":\"\",\"5_1\":\"\",\"5_2\":\"\",\"5_3\":\"\",\"5_4\":\"\",\"5_5\":\"\",\"5_6\":\"\",\"quality_mission\":\"\"}'),(154,153,303,304,1,0,2019,'KPI S5.1','Node\\ncai18\\kpi','2019-01-12 19:16:44',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":5,\"kpi_id\":\"14\",\"kpi_info\":\"Ratio of students to administrative staff.\",\"kpi_ref_num\":\"S5.1\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(155,153,305,306,1,0,2019,'KPI S5.2','Node\\ncai18\\kpi','2019-01-12 19:16:44',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":5,\"kpi_id\":\"15\",\"kpi_info\":\"Proportion of total operating funds (other than accommodation and student allowances) allocated to provision of student services.\",\"kpi_ref_num\":\"S5.2\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(156,153,307,308,1,0,2019,'KPI S5.3','Node\\ncai18\\kpi','2019-01-12 19:16:44',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":5,\"kpi_id\":\"16\",\"kpi_info\":\"Student evaluation of academic and career counselling. (Average rating on the adequacy of academic and career counselling on a five- point scale in an annual survey of final year students.)\",\"kpi_ref_num\":\"S5.3\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(157,153,309,310,1,0,2019,'List of Annexes for standard 5','Node\\ncai18\\Annexes_List','2019-01-12 19:16:44',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":5}'),(158,131,312,321,1,0,2019,'6. Learning Resources','Node\\ncai18\\Ssri_G_Evaluation_6_Learning_Resources','2019-01-12 19:16:44',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"overall_rating\":\"\",\"explanatory_report\":\"\",\"standard_description\":\"\",\"6_1\":\"\",\"6_2\":\"\",\"6_3\":\"\",\"6_4\":\"\",\"quality_mission\":\"\"}'),(159,158,313,314,1,0,2019,'KPI S6.1','Node\\ncai18\\kpi','2019-01-12 19:16:44',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":6,\"kpi_id\":\"17\",\"kpi_info\":\"Stakeholder evaluation of library and media center. (Average overall rating of the adequacy of the library & media center, including:\\n a) Staff assistance,\\nb) Current and up-to-date\\nc) Copy & print facilities,\\nd) Functionality of equipment,\\ne) Atmosphere or climate for studying\\nf) Availability of study sites, and\\ng) Any other quality indicators of service on a five- point scale of an annual survey.) .\",\"kpi_ref_num\":\"S6.1\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(160,158,315,316,1,0,2019,'KPI S6.2','Node\\ncai18\\kpi','2019-01-12 19:16:44',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":6,\"kpi_id\":\"18\",\"kpi_info\":\"Number of web site publication and journal subscriptions as a proportion of the number of programs offered.\",\"kpi_ref_num\":\"S6.2\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(161,158,317,318,1,0,2019,'KPI S6.3','Node\\ncai18\\kpi','2019-01-12 19:16:44',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":6,\"kpi_id\":\"19\",\"kpi_info\":\"Stakeholder evaluation of the digital library. (Average overall rating of the adequacy of the digital library, including: \\n a) User friendly website\\nb) Availability of the digital databases,\\nc) Accessibility for users,\\nd) Library skill training and\\ne) Any other quality indicators of service on a five- point scale of an annual survey.)\",\"kpi_ref_num\":\"S6.3\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(162,158,319,320,1,0,2019,'List of Annexes for standard 6','Node\\ncai18\\Annexes_List','2019-01-12 19:16:45',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":6}'),(163,131,322,331,1,0,2019,'7. Facilities and Equipment','Node\\ncai18\\Ssri_G_Evaluation_7_Facilities_And_Equipment','2019-01-12 19:16:45',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"overall_rating\":\"\",\"explanatory_report\":\"\",\"standard_description\":\"\",\"7_1\":\"\",\"7_2\":\"\",\"7_3\":\"\",\"7_4\":\"\",\"7_5\":\"\",\"quality_mission\":\"\"}'),(164,163,323,324,1,0,2019,'KPI S7.1','Node\\ncai18\\kpi','2019-01-12 19:16:45',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":7,\"kpi_id\":\"20\",\"kpi_info\":\"Annual expenditure on IT budget, including: \\na) Percentage of the total Institution, or College, or Program budget allocated for IT; \\nb) Percentage of IT budget allocated per program for institutional or per student for programmatic; \\nc) Percentage of IT budget allocated for software licences; \\nd) Percentage of IT budget allocated for IT security; \\ne) Percentage of IT budge allocated for IT maintenance\",\"kpi_ref_num\":\"S7.1\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(165,163,325,326,1,0,2019,'KPI S7.2','Node\\ncai18\\kpi','2019-01-12 19:16:45',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":7,\"kpi_id\":\"21\",\"kpi_info\":\"Stakeholder evaluation of the IT services (Average overall rating of the adequacy of on a five- point scale of an annual survey). \\na) IT availability, \\nb) Website, \\nc) e-learning services \\nd) IT Security, \\ne) Maintenance (hardware & software), \\nf) Accessibility \\ng) Support systems, \\nh) Hardware, software & up-dates, and Web-based electronic data management system or electronic resources (for example: institutional website providing resource sharing, networking & relevant information, including e-learning, interactive learning & teaching between students & faculty).\",\"kpi_ref_num\":\"S7.2\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(166,163,327,328,1,0,2019,'KPI S7.3','Node\\ncai18\\kpi','2019-01-12 19:16:45',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":7,\"kpi_id\":\"22\",\"kpi_info\":\"Stakeholder evaluation of facilities & equipment: \\na) Classrooms, \\nb) Laboratories, \\nc) Bathrooms (cleanliness & maintenance), \\nd) Campus security, \\ne) Parking & access, \\nf) Safety (first aide, fire extinguishers & alarm systems, secure chemicals) \\ng) Access for those with disabilities or handicaps (ramps, lifts, bathroom furnishings), \\nh) Sporting facilities & equipment.\",\"kpi_ref_num\":\"S7.3\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(167,163,329,330,1,0,2019,'List of Annexes for standard 7','Node\\ncai18\\Annexes_List','2019-01-12 19:16:45',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":7}'),(168,131,332,337,1,0,2019,'8. Financial Planning and Management','Node\\ncai18\\Ssri_G_Evaluation_8_Financial_Planning','2019-01-12 19:16:45',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"overall_rating\":\"\",\"explanatory_report\":\"\",\"standard_description\":\"\",\"8_1\":\"\",\"8_2\":\"\",\"8_3\":\"\",\"quality_mission\":\"\"}'),(169,168,333,334,1,0,2019,'KPI S8.1','Node\\ncai18\\kpi','2019-01-12 19:16:45',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":8,\"kpi_id\":\"23\",\"kpi_info\":\"Total operating expenditure (other than accommodation and student allowances) per student.\",\"kpi_ref_num\":\"S8.1\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(170,168,335,336,1,0,2019,'List of Annexes for standard 8','Node\\ncai18\\Annexes_List','2019-01-12 19:16:45',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":8}'),(171,131,338,345,1,0,2019,'9. Employment Processes','Node\\ncai18\\Ssri_G_Evaluation_9_Employment_Processes','2019-01-12 19:16:45',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"overall_rating\":\"\",\"explanatory_report\":\"\",\"standard_description\":\"\",\"9_1\":\"\",\"9_2\":\"\",\"9_3\":\"\",\"9_4\":\"\",\"quality_mission\":\"\"}'),(172,171,339,340,1,0,2019,'KPI S9.1','Node\\ncai18\\kpi','2019-01-12 19:16:45',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":9,\"kpi_id\":\"24\",\"kpi_info\":\"Proportion of teaching staff leaving the institution in the past year for reasons other than age retirement.\",\"kpi_ref_num\":\"S9.1\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(173,171,341,342,1,0,2019,'KPI S9.2','Node\\ncai18\\kpi','2019-01-12 19:16:45',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":9,\"kpi_id\":\"25\",\"kpi_info\":\"Proportion of teaching staff participating in professional development activities during the past year.\",\"kpi_ref_num\":\"S9.2\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(174,171,343,344,1,0,2019,'List of Annexes for standard 9','Node\\ncai18\\Annexes_List','2019-01-12 19:16:45',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":9}'),(175,131,346,361,1,0,2019,'10. Research','Node\\ncai18\\Ssri_G_Evaluation_10_Research','2019-01-12 19:16:45',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"overall_rating\":\"\",\"explanatory_report\":\"\",\"standard_description\":\"\",\"10_1\":\"\",\"10_2\":\"\",\"10_3\":\"\",\"10_4\":\"\",\"quality_mission_1\":\"\",\"quality_mission_2\":\"\"}'),(176,175,347,348,1,0,2019,'KPI S10.1','Node\\ncai18\\kpi','2019-01-12 19:16:45',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":10,\"kpi_id\":\"26\",\"kpi_info\":\"Number of refereed publications in the previous year per full time equivalent teaching staff. (Publications based on the formula in the Higher Council Bylaw excluding conference presentations)\",\"kpi_ref_num\":\"S10.1\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(177,175,349,350,1,0,2019,'KPI S10.2','Node\\ncai18\\kpi','2019-01-12 19:16:45',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":10,\"kpi_id\":\"27\",\"kpi_info\":\"Number of citations in refereed journals in the previous year per full time equivalent faculty members.\",\"kpi_ref_num\":\"S10.2\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(178,175,351,352,1,0,2019,'KPI S10.3','Node\\ncai18\\kpi','2019-01-12 19:16:45',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":10,\"kpi_id\":\"28\",\"kpi_info\":\"Proportion of full time member of teaching staff with at least one refereed publication during the previous year.\",\"kpi_ref_num\":\"S10.3\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(179,175,353,354,1,0,2019,'KPI S10.4','Node\\ncai18\\kpi','2019-01-12 19:16:45',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":10,\"kpi_id\":\"29\",\"kpi_info\":\"Number of papers or reports presented at academic conferences during the past year per full time equivalent faculty members.\",\"kpi_ref_num\":\"S10.4\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(180,175,355,356,1,0,2019,'KPI S10.5','Node\\ncai18\\kpi','2019-01-12 19:16:46',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":10,\"kpi_id\":\"30\",\"kpi_info\":\"Research income from external sources in the past year as a proportion of the number of full time faculty members.\",\"kpi_ref_num\":\"S10.5\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(181,175,357,358,1,0,2019,'KPI S10.6','Node\\ncai18\\kpi','2019-01-12 19:16:46',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":10,\"kpi_id\":\"31\",\"kpi_info\":\"Proportion of the total, annual operational budget dedicated to research.\",\"kpi_ref_num\":\"S10.6\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(182,175,359,360,1,0,2019,'List of Annexes for standard 10','Node\\ncai18\\Annexes_List','2019-01-12 19:16:46',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":10}'),(183,131,362,369,1,0,2019,'11. Institutional Relationships with the Community','Node\\ncai18\\Ssri_G_Evaluation_11_Institutional_Relationships','2019-01-12 19:16:46',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"overall_rating\":\"\",\"explanatory_report\":\"\",\"standard_description\":\"\",\"11_1\":\"\",\"11_2\":\"\",\"11_3\":\"\",\"quality_mission\":\"\"}'),(184,183,363,364,1,0,2019,'KPI S11.1','Node\\ncai18\\kpi','2019-01-12 19:16:46',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":11,\"kpi_id\":\"32\",\"kpi_info\":\"Proportion of full time teaching and other staff actively engaged in community service activities.\",\"kpi_ref_num\":\"S11.1\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(185,183,365,366,1,0,2019,'KPI S11.2','Node\\ncai18\\kpi','2019-01-12 19:16:46',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":11,\"kpi_id\":\"33\",\"kpi_info\":\"Number of community education programs provided as a proportion of the number of departments.\",\"kpi_ref_num\":\"S11.2\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(186,183,367,368,1,0,2019,'List of Annexes for standard 11','Node\\ncai18\\Annexes_List','2019-01-12 19:16:46',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":11}'),(187,114,371,372,1,0,2019,'H. Independent Evaluations','Node\\ncai18\\Ssri_H_Independent_Evaluations','2019-01-12 19:16:46',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"process_description\":\"\",\"recommendation_list\":\"\",\"response_report\":\"\",\"evaluation_report\":\"\"}'),(188,114,373,374,1,0,2019,'I. Conclusions','Node\\ncai18\\Ssri_I_Conclusions','2019-01-12 19:16:46',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"successful\":\"\",\"satisfactory\":\"\"}'),(189,114,375,376,1,0,2019,'J. Action Recommendations','Node\\ncai18\\Ssri_J_Action_Recommendations','2019-01-12 19:16:46',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"recommendation\":[]}'),(190,114,377,378,1,0,2019,'Authorized Signatures','Node\\ncai18\\Ssri_Signatures','2019-01-12 19:16:46',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"authorized_signature\":[]}'),(191,0,1,30,191,5,2019,'ABET ETAC V.2015','Node\\abet_etac\\Root','2019-01-12 19:43:43',0,1,0,0,'0000-00-00 00:00:00','2019-01-26 23:59:59','none','[]'),(192,191,2,3,191,0,2019,'BACKGROUND INFORMATION','Node\\abet_etac\\Background_Info','2019-01-12 19:43:43',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','not_compliant','{\"contact_info\":[{\"name\":\"\",\"email_address\":\"\",\"telephone\":\"\",\"fax_number\":\"\",\"email\":\"\"}],\"program_history_feilds\":\"<p>fdwfrwwrwer<\\/p>\",\"options_list\":\"\",\"program_delivery_modes\":\"\",\"program_locations\":\"\",\"public_disclosure_provider\":\"\",\"weakness\":\"\"}'),(193,191,4,5,191,0,2019,'CRITERION 1. STUDENTS','Node\\abet_etac\\Criterion_1','2019-01-12 19:43:43',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"student_admission\":\"<p>sfgddsfdsfdsfsd fdsf gfd dfgdf df dfgdfgfdgfdgfrrwertweqrewqr<\\/p>\",\"student_evaluation\":\"<p>dsfdsfsgdgwgfdsgfdsgsdfg<\\/p>\",\"student_and_course\":\"<p>dsfgsdfghffdshgwehgfdwhsdfh<\\/p>\",\"advising_and_career\":\"<p>sfdgdfgsdfgdfsghgfdhgfbsdfhytju<\\/p>\",\"work_in_lieu\":\"<p>fklsdp;kgfd;lghkfdsl;kgfhlk;gfhlg<\\/p>\",\"graduation_requirements\":\"<p>gfdgmfdl;kgj;plfdk;vgbkdg<\\/p>\",\"recent_graduates\":\"<p>sdfdsfsdjfc m,;fdj;f,l;fdsfsdffsdfsdfdsf<\\/p>\"}'),(194,191,6,7,191,0,2019,'CRITERION 2. PROGRAM EDUCATIONAL OBJECTIVES','Node\\abet_etac\\Criterion_2','2019-01-12 19:43:43',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','compliant','{\"mission_statement\":\"<p>sadhjkfanhjf nhjc hjklf<\\/p>\",\"program_educational_objective\":\"<p>fdsafjnhfc\\u00a0 \\u00a0 \\u00a0 \\u00a0 \\u00a0 \\u00a0nhskklg;jlgk;aq<\\/p>\",\"program_consistance_mission\":\"<p>sdffdsfdsfdgfdsgsdg<\\/p>\",\"program_constituencies_list\":\"<p>fdghfgjhgjytejtjtjytjyt<\\/p>\",\"review_process\":\"<p>fdhdgfh gfhb vfghvfghvdfgh<\\/p>\"}'),(195,191,8,9,191,0,2019,'CRITERION 3.  STUDENT OUTCOMES','Node\\abet_etac\\Criterion_3','2019-01-12 19:43:43',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"student_ourcones_revision\":\"\",\"student_outcomes_list\":\"\",\"educational_objective\":\"\"}'),(196,191,10,11,191,0,2019,'CRITERION 4. CONTINUOUS IMPROVEMENT','Node\\abet_etac\\Criterion_4','2019-01-12 19:43:43',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"student_outcomes_table\":{\"1\":{\"2\":{\"student_outcome\":\"\"}},\"2\":{\"2\":{\"student_outcome\":\"\"}},\"3\":{\"2\":{\"student_outcome\":\"\"}},\"4\":{\"2\":{\"student_outcome\":\"\"}},\"5\":{\"2\":{\"student_outcome\":\"\"}}},\"continuous_improvement\":\"\",\"additional_info\":\"\"}'),(197,191,12,13,191,0,2019,'CRITERION 5. CURRICULUM','Node\\abet_etac\\Criterion_5','2019-01-12 19:43:43',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"program_name\":\"Computer Science Program\",\"curriculum_table\":[{\"course\":\"\",\"indicate\":\"\",\"math\":\"\",\"topics\":\"\",\"education\":\"\",\"other\":\"\",\"course_term\":\"\",\"average_section\":\"\"}],\"curriculum_table_percent\":\"\",\"curriculum_table_overall\":{\"3\":{\"1\":{\"overall\":\"0\"},\"2\":{\"overall\":\"0\"},\"3\":{\"overall\":\"0\"},\"4\":{\"overall\":\"0\"}}},\"curriculum_aligns\":\"\",\"prerequisite\":\"\",\"worksheet\":\"\",\"specific_requirements\":\"\",\"culminating_experience\":\"\",\"curricular_requirements\":\"\",\"example\":\"\",\"syllabi\":\"\",\"advisory_committee\":\"\"}'),(198,191,14,15,191,0,2019,'CRITERION 6. FACULTY','Node\\abet_etac\\Criterion_6','2019-01-12 19:43:44',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"program_name\":\"Computer Science Program\",\"faculty_qualifications\":[{\"name\":\"\",\"degree\":\"\",\"rank\":\"\",\"academin_appointment\":\"\",\"practice\":\"\",\"teaching\":\"\",\"institution\":\"\",\"registration\":\"\",\"professional\":\"\",\"professional_development\":\"\",\"summer\":\"\"}],\"faculty_vitae\":\"\",\"program_name_for_faculty\":\"Computer Science Program\",\"summary\":[{\"name\":\"\",\"classes\":\"\",\"teaching\":\"\",\"research\":\"\",\"other\":\"\",\"percent\":\"0\"}],\"faculty_size_discussion\":\"\",\"professional_development_details\":\"\",\"authority_faculty\":\"\"}'),(199,191,16,17,191,0,2019,'CRITERION 7. FACILITIES','Node\\abet_etac\\Criterion_7','2019-01-12 19:43:44',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"office\":\"\",\"classroom\":\"\",\"laboratory\":\"\",\"computing_resources\":\"\",\"guidance_discribtion\":\"\",\"maintenance_facilities\":\"\",\"library_services_discribtion\":\"\",\"overall_comment\":\"\"}'),(200,191,18,19,191,0,2019,'CRITERION 8.  INSTITUTIONAL SUPPORT','Node\\abet_etac\\Criterion_8','2019-01-12 19:43:44',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"leadership\":\"\",\"process\":\"\",\"teaching\":\"\",\"resources\":\"\",\"sections\":\"\",\"staffing_describtion\":\"\",\"faculty_hiring_process\":\"\",\"faculty_hiring_qualified\":\"\",\"supports\":\"\"}'),(201,191,20,21,191,0,2019,'PROGRAM CRITERIA','Node\\abet_etac\\Program_Criteria','2019-01-12 19:43:44',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"list\":\"\",\"attchment\":\"\"}'),(202,191,22,23,191,0,2019,'Appendix A – Course Syllabi','Node\\abet_etac\\Appendix_A','2019-01-12 19:43:44',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"syllabi_text\":\"\",\"syllabi\":\"\"}'),(203,191,24,25,191,0,2019,'Appendix B – Faculty Vitae','Node\\abet_etac\\Appendix_B','2019-01-12 19:43:44',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"faculty_vitae_text\":\"\",\"faculty_vitae\":\"\"}'),(204,191,26,27,191,0,2019,'Appendix C – Equipment','Node\\abet_etac\\Appendix_C','2019-01-12 19:43:44',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"majors\":\"\"}'),(205,191,28,29,191,0,2019,'Appendix D – Institutional Summary','Node\\abet_etac\\Appendix_D','2019-01-12 19:43:44',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"institution_name\":\"Jadeer\",\"institution_address\":\"\",\"chief_name\":\"\",\"self_study_report\":\"\",\"organizations\":\"\",\"type_of_control_description\":\"\",\"educational_unit_description\":\"\",\"academic_support_units\":\"\",\"nonacademic_support_units\":\"\",\"credit_unit_description\":\"\",\"program\":\"Computer Science Program\",\"program_enrollment\":{\"3\":{\"2\":{\"academic_year\":\"\"},\"4\":{\"first_year\":\"\"},\"5\":{\"second_year\":\"\"},\"6\":{\"third_year\":\"\"},\"7\":{\"fourth_year\":\"\"},\"8\":{\"fifth_year\":\"\"},\"9\":{\"under_graduate\":\"\"},\"10\":{\"total_grad\":\"\"},\"11\":{\"associates_awarded\":\"\"},\"12\":{\"bachelors_awarded\":\"\"},\"13\":{\"master_awarded\":\"\"},\"14\":{\"doctorates_awarded\":\"\"}},\"4\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"},\"7\":{\"under_graduate\":\"\"},\"8\":{\"total_grad\":\"\"},\"9\":{\"associates_awarded\":\"\"},\"10\":{\"bachelors_awarded\":\"\"},\"11\":{\"master_awarded\":\"\"},\"12\":{\"doctorates_awarded\":\"\"}},\"5\":{\"2\":{\"academic_year\":\"\"},\"4\":{\"first_year\":\"\"},\"5\":{\"second_year\":\"\"},\"6\":{\"third_year\":\"\"},\"7\":{\"fourth_year\":\"\"},\"8\":{\"fifth_year\":\"\"},\"9\":{\"under_graduate\":\"\"},\"10\":{\"total_grad\":\"\"},\"11\":{\"associates_awarded\":\"\"},\"12\":{\"bachelors_awarded\":\"\"},\"13\":{\"master_awarded\":\"\"},\"14\":{\"doctorates_awarded\":\"\"}},\"6\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"},\"7\":{\"under_graduate\":\"\"},\"8\":{\"total_grad\":\"\"},\"9\":{\"associates_awarded\":\"\"},\"10\":{\"bachelors_awarded\":\"\"},\"11\":{\"master_awarded\":\"\"},\"12\":{\"doctorates_awarded\":\"\"}},\"7\":{\"2\":{\"academic_year\":\"\"},\"4\":{\"first_year\":\"\"},\"5\":{\"second_year\":\"\"},\"6\":{\"third_year\":\"\"},\"7\":{\"fourth_year\":\"\"},\"8\":{\"fifth_year\":\"\"},\"9\":{\"under_graduate\":\"\"},\"10\":{\"total_grad\":\"\"},\"11\":{\"associates_awarded\":\"\"},\"12\":{\"bachelors_awarded\":\"\"},\"13\":{\"master_awarded\":\"\"},\"14\":{\"doctorates_awarded\":\"\"}},\"8\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"},\"7\":{\"under_graduate\":\"\"},\"8\":{\"total_grad\":\"\"},\"9\":{\"associates_awarded\":\"\"},\"10\":{\"bachelors_awarded\":\"\"},\"11\":{\"master_awarded\":\"\"},\"12\":{\"doctorates_awarded\":\"\"}},\"9\":{\"2\":{\"academic_year\":\"\"},\"4\":{\"first_year\":\"\"},\"5\":{\"second_year\":\"\"},\"6\":{\"third_year\":\"\"},\"7\":{\"fourth_year\":\"\"},\"8\":{\"fifth_year\":\"\"},\"9\":{\"under_graduate\":\"\"},\"10\":{\"total_grad\":\"\"},\"11\":{\"associates_awarded\":\"\"},\"12\":{\"bachelors_awarded\":\"\"},\"13\":{\"master_awarded\":\"\"},\"14\":{\"doctorates_awarded\":\"\"}},\"10\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"},\"7\":{\"under_graduate\":\"\"},\"8\":{\"total_grad\":\"\"},\"9\":{\"associates_awarded\":\"\"},\"10\":{\"bachelors_awarded\":\"\"},\"11\":{\"master_awarded\":\"\"},\"12\":{\"doctorates_awarded\":\"\"}},\"11\":{\"2\":{\"academic_year\":\"\"},\"4\":{\"first_year\":\"\"},\"5\":{\"second_year\":\"\"},\"6\":{\"third_year\":\"\"},\"7\":{\"fourth_year\":\"\"},\"8\":{\"fifth_year\":\"\"},\"9\":{\"under_graduate\":\"\"},\"10\":{\"total_grad\":\"\"},\"11\":{\"associates_awarded\":\"\"},\"12\":{\"bachelors_awarded\":\"\"},\"13\":{\"master_awarded\":\"\"},\"14\":{\"doctorates_awarded\":\"\"}},\"12\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"},\"7\":{\"under_graduate\":\"\"},\"8\":{\"total_grad\":\"\"},\"9\":{\"associates_awarded\":\"\"},\"10\":{\"bachelors_awarded\":\"\"},\"11\":{\"master_awarded\":\"\"},\"12\":{\"doctorates_awarded\":\"\"}}},\"program_name\":\"Computer Science Program\",\"new_year\":\"2019\",\"presonnel\":{\"3\":{\"2\":{\"fulltime\":\"\"},\"3\":{\"parttime\":\"\"},\"4\":{\"fte\":\"\"}},\"4\":{\"2\":{\"fulltime\":\"\"},\"3\":{\"parttime\":\"\"},\"4\":{\"fte\":\"\"}},\"5\":{\"2\":{\"fulltime\":\"\"},\"3\":{\"parttime\":\"\"},\"4\":{\"fte\":\"\"}},\"6\":{\"2\":{\"fulltime\":\"\"},\"3\":{\"parttime\":\"\"},\"4\":{\"fte\":\"\"}},\"7\":{\"2\":{\"fulltime\":\"\"},\"3\":{\"parttime\":\"\"},\"4\":{\"fte\":\"\"}},\"8\":{\"2\":{\"fulltime\":\"\"},\"3\":{\"parttime\":\"\"},\"4\":{\"fte\":\"\"}},\"9\":{\"2\":{\"fulltime\":\"\"},\"3\":{\"parttime\":\"\"},\"4\":{\"fte\":\"\"}}}}'),(206,0,1,68,206,7,2019,'ACPE For Pharmacy V.2016','Node\\acpe\\Root','2019-01-12 19:44:09',0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(207,206,2,11,206,0,2019,'SECTION I: EDUCATIONAL OUTCOMES','Node\\acpe\\Acpe_Section_1','2019-01-12 19:44:09',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(208,207,3,4,206,0,2019,'Standard 1: Foundational Knowledge','Node\\acpe\\Acpe_Section_1_Standard_1','2019-01-12 19:44:09',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"foundational_sciences\":\"\",\"foundational_knowledge\":\"\"}'),(209,207,5,6,206,0,2019,'Standard 2: Essentials for Practice and Care','Node\\acpe\\Acpe_Section_1_Standard_2','2019-01-12 19:44:09',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"essentials\":\"\",\"patient_care\":\"\",\"medication_management\":\"\",\"health\":\"\",\"population\":\"\"}'),(210,207,7,8,206,0,2019,'Standard 3: Approach to Practice and Care','Node\\acpe\\Acpe_Section_1_Standard_3','2019-01-12 19:44:09',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"approach_care\":\"\",\"problem_solving\":\"\",\"education\":\"\",\"patient\":\"\",\"collaboration\":\"\",\"cultural_sensitivity\":\"\",\"communication\":\"\"}'),(211,207,9,10,206,0,2019,'Standard 4: Personal and Professional Development','Node\\acpe\\Acpe_Section_1_Standard_4','2019-01-12 19:44:09',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"personal_development\":\"\",\"self_awareness\":\"\",\"leadership\":\"\",\"innovation\":\"\",\"professionalism\":\"\"}'),(212,206,12,59,206,0,2019,'SECTION II: STRUCTURE AND PROCESS TO PROMOTE ACHIEVEMENT OF EDUCATIONAL OUTCOMES','Node\\acpe\\Acpe_Section_2','2019-01-12 19:44:09',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(213,212,13,24,206,0,2019,'Subsection IIA: Planning and Organization','Node\\acpe\\Acpe_Section_2_Sub_A','2019-01-12 19:44:09',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(214,213,14,15,206,0,2019,'Standard 5: Eligibility and Reporting Requirements','Node\\acpe\\Acpe_Section_2_Sub_A_Standard5','2019-01-12 19:44:09',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"autonomy\":\"\",\"legal\":\"\",\"dean_leadership\":\"\",\"regional\":\"\",\"regional_action\":\"\",\"change\":\"\"}'),(215,213,16,17,206,0,2019,'Standard 6: College or School Vision, Mission, and Goals','Node\\acpe\\Acpe_Section_2_Sub_A_Standard6','2019-01-12 19:44:09',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"college_mission\":\"\",\"commtiment\":\"\",\"education\":\"\",\"initiative\":\"\",\"goals\":\"\"}'),(216,213,18,19,206,0,2019,'Standard 7: Strategic Plan','Node\\acpe\\Acpe_Section_2_Sub_A_Standard7','2019-01-12 19:44:09',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"process\":\"\",\"resources\":\"\",\"planning\":\"\"}'),(217,213,20,21,206,0,2019,'Standard 8: Organization and Governance','Node\\acpe\\Acpe_Section_2_Sub_A_Standard8','2019-01-12 19:44:09',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"leadership\":\"\",\"qualified_dean\":\"\",\"qualified_team\":\"\",\"responsibilities\":\"\",\"resource\":\"\",\"university_governance\":\"\",\"faculty\":\"\",\"system_failures\":\"\",\"alternate_pathway\":\"\"}'),(218,213,22,23,206,0,2019,'Standard 9: Organizational Culture','Node\\acpe\\Acpe_Section_2_Sub_A_Standard9','2019-01-12 19:44:09',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"leadership\":\"\",\"behaviors\":\"\",\"culture\":\"\"}'),(219,212,25,34,206,0,2019,'Subsection IIB: Educational Program for the Doctor of Pharmacy Degree','Node\\acpe\\Acpe_Section_2_Sub_B','2019-01-12 19:44:09',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(220,219,26,27,206,0,2019,'Standard 10: Curriculum Design, Delivery, and Oversight','Node\\acpe\\Acpe_Section_2_Sub_B_Standard10','2019-01-12 19:44:09',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"program_duration\":\"\",\"curricular_oversight\":\"\",\"knowledge\":\"\",\"skill_development\":\"\",\"professional_attitude\":\"\",\"faculty\":\"\",\"breadth_and_depth\":\"\",\"patient_care_process\":\"\",\"electives\":\"\",\"feedback\":\"\",\"curriculum_review\":\"\",\"teaching_method\":\"\",\"diverse\":\"\",\"course_syllabi\":\"\",\"quality_assurance\":\"\",\"employment\":\"\",\"academic_integrity\":\"\"}'),(221,219,28,29,206,0,2019,'Standard 11: Interprofessional Education (IPE)','Node\\acpe\\Acpe_Section_2_Sub_B_Standard11','2019-01-12 19:44:10',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"team_dynamic\":\"\",\"interprofessional\":\"\",\"team_practice\":\"\"}'),(222,219,30,31,206,0,2019,'Standard 12: Pre-Advanced Pharmacy Practice Experience (Pre-APPE) Curriculum','Node\\acpe\\Acpe_Section_2_Sub_B_Standard12','2019-01-12 19:44:10',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"curriculum\":\"\",\"development\":\"\",\"domail_elements\":\"\",\"lifespan\":\"\",\"expectations\":\"\",\"duration\":\"\",\"simulation\":\"\"}'),(223,219,32,33,206,0,2019,'Standard 13: Advanced Pharmacy Practice Experience (APPE) Curriculum','Node\\acpe\\Acpe_Section_2_Sub_B_Standard13','2019-01-12 19:44:10',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"patient_care\":\"\",\"diverse\":\"\",\"experiences\":\"\",\"duration\":\"\",\"timing\":\"\",\"required_appe\":\"\",\"elective_appe\":\"\",\"restrictions\":\"\"}'),(224,212,35,44,206,0,2019,'Subsection IIC: Students','Node\\acpe\\Acpe_Section_2_Sub_C','2019-01-12 19:44:10',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(225,224,36,37,206,0,2019,'Standard 14: Student Services','Node\\acpe\\Acpe_Section_2_Sub_C_Standard14','2019-01-12 19:44:10',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"febra\":\"\",\"financial_aid\":\"\",\"healthcare\":\"\",\"advising\":\"\",\"nondiscrimination\":\"\",\"accommodation\":\"\",\"student_access\":\"\"}'),(226,224,38,39,206,0,2019,'Standard 15: Academic Environment','Node\\acpe\\Acpe_Section_2_Sub_C_Standard15','2019-01-12 19:44:10',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"student_information\":\"\",\"compliants_policy\":\"\",\"student_misconduct\":\"\",\"student_representation\":\"\",\"learning_policies\":\"\"}'),(227,224,40,41,206,0,2019,'Standard 16: Admissions','Node\\acpe\\Acpe_Section_2_Sub_C_Standard16','2019-01-12 19:44:10',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"enrollment_management\":\"\",\"admission_procedure\":\"\",\"program_description\":\"\",\"admission_criteria\":\"\",\"admission_material\":\"\",\"oral_communication\":\"\",\"candidate_interview\":\"\",\"transfer_policies\":\"\"}'),(228,224,42,43,206,0,2019,'Standard 17: Progression','Node\\acpe\\Acpe_Section_2_Sub_C_Standard17','2019-01-12 19:44:10',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"progression_polices_texts\":\"\",\"early_intervention\":\"\"}'),(229,212,45,58,206,0,2019,'Subsection IID: Resources','Node\\acpe\\Acpe_Section_2_Sub_D','2019-01-12 19:44:10',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(230,229,46,47,206,0,2019,'Standard 18: Faculty and Staff—Quantitative Factors','Node\\acpe\\Acpe_Section_2_Sub_D_Standard18','2019-01-12 19:44:10',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"sufficient_faculty_texts\":\"\",\"sufficient_staff_texts\":\"\"}'),(231,229,48,49,206,0,2019,'Standard 19: Faculty and Staff—Qualitative Factors','Node\\acpe\\Acpe_Section_2_Sub_D_Standard19','2019-01-12 19:44:10',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"educational_effectiveness\":\"\",\"scholarly_productivity\":\"\",\"service_commitment\":\"\",\"practice\":\"\",\"faculty_development\":\"\",\"policy_application\":\"\"}'),(232,229,50,51,206,0,2019,'Standards 20: Preceptors','Node\\acpe\\Acpe_Section_2_Sub_D_Standard20','2019-01-12 19:44:10',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"preceptor_criteria\":\"\",\"student_ratio\":\"\",\"preceptor_education\":\"\",\"preceptor_engagement\":\"\",\"educational_administration\":\"\"}'),(233,229,52,53,206,0,2019,'Standard 21: Physical Facilities and Educational Resources','Node\\acpe\\Acpe_Section_2_Sub_D_Standard21','2019-01-12 19:44:10',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"facilities\":\"\",\"facilities_Attribute\":\"\",\"educational_resources\":\"\",\"expertise_access\":\"\"}'),(234,229,54,55,206,0,2019,'Standard 22: Practice Facilities','Node\\acpe\\Acpe_Section_2_Sub_D_Standard22','2019-01-12 19:44:10',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"quality_criteria\":\"\",\"affiliation_agreement\":\"\",\"evaluation\":\"\"}'),(235,229,56,57,206,0,2019,'Standard 23: Financial Resources','Node\\acpe\\Acpe_Section_2_Sub_D_Standard23','2019-01-12 19:44:10',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"enrollment_support\":\"\",\"budgetary_input\":\"\",\"revenue_allcation\":\"\",\"equitable_allocation\":\"\"}'),(236,206,60,65,206,0,2019,'SECTION III: ASSESSMENT OF STANDARDS AND KEY ELEMENTS','Node\\acpe\\Acpe_Section_3','2019-01-12 19:44:10',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(237,236,61,62,206,0,2019,'Standard 24: Assessment Elements for Section I: Educational Outcomes','Node\\acpe\\Acpe_Section_3_Standard_24','2019-01-12 19:44:10',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"formative_assessment\":\"\",\"standardized_assessments\":\"\",\"student_achievement\":\"\",\"continuous_improvement\":\"\"}'),(238,236,63,64,206,0,2019,'Standard 25: Assessment Elements for Section II: Structure and Process','Node\\acpe\\Acpe_Section_3_Standard_25','2019-01-12 19:44:10',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"assessment_effectiveness\":\"\",\"program_evaluation\":\"\",\"curriculum_assessment\":\"\",\"faculty_productivity\":\"\",\"pathway\":\"\",\"interprofessional_preparedness\":\"\",\"clinical_reasoning\":\"\",\"appe_preparedness\":\"\",\"admission_criteria\":\"\"}'),(239,206,66,67,206,0,2019,'Appendices','Node\\acpe\\Acpe_Appendices','2019-01-12 19:44:10',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"appendix_1_attach\":\"\",\"appendix_2_attach\":\"\",\"appendix_3_attach\":\"\"}'),(240,0,1,98,240,1,2019,'Program Specifications and Reports V.2015','Node\\ncapm14\\Root','2019-01-13 15:59:49',0,0,0,0,'0000-00-00 00:00:00','2019-01-31 23:59:59','none','[]'),(241,240,2,49,240,1,2019,'Al Huson University College','Node\\ncapm14\\College','2019-01-13 16:05:24',0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(242,241,3,48,240,5,2019,'Computer Science Program','Node\\ncapm14\\Program','2019-01-13 16:05:24',0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(243,242,4,25,240,0,2019,'Program Specifications (PS)','Node\\ncapm14\\Program_Specifications','2019-01-13 16:05:24',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"institution\":\"Jadeer\",\"date_of_report\":\"2019-01-13\",\"college\":\"Al Huson University College\",\"department\":\"Computer Department\"}'),(244,243,5,6,240,0,2019,'A. Program Identification and General Information','Node\\ncapm14\\Program_Specifications_A','2019-01-13 16:05:24',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"program_title\":\"Computer Science Program\",\"program_code\":\"\",\"total_credit_hour\":\"0\",\"program_completion\":\"\",\"tracks_and_pathway\":\"\",\"exit_point\":\"\",\"professional_occupations\":\"\",\"new_program\":\"Yes\",\"planned_starting_date\":\"\",\"program_review\":\"\",\"note\":\"\",\"accreditation_review\":\"\",\"other\":\"\",\"program_coordinator\":\"\",\"approval_date\":[{\"campus_branch_location\":\"\",\"approval_by\":\"\",\"date\":\"\"}]}'),(245,243,7,8,240,0,2019,'B. Program Context','Node\\ncapm14\\Program_Specifications_B','2019-01-13 16:05:24',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"economic_reasons\":\"\",\"program_mission\":\"\",\"courses_meet_student\":\"\",\"courses_meet_department_student\":\"\",\"modifications_and_services\":\"\",\"program_courses\":\"\",\"program_require_students\":\"\",\"students_characteristics\":\"\"}'),(246,243,9,10,240,0,2019,'C. Mission, Goals and Objectives','Node\\ncapm14\\Program_Specifications_C','2019-01-13 16:05:24',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"program_missions\":\"\",\"list_of_goals\":\"\",\"goals_and_objective\":[{\"objectives\":\"\",\"measurable_indicators\":\"\",\"major_strategies\":\"\"}]}'),(247,243,11,12,240,0,2019,'D. Program Structure and Organization','Node\\ncapm14\\Program_Specifications_D','2019-01-13 16:05:24',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"curriculum_study_plan_levels\":[],\"experience_activity\":\"\",\"field_experience\":\"\",\"time_allocation\":\"\",\"credit_hours_2\":\"\",\"project_summery\":\"\",\"a_description\":\"\",\"major_learning_outcomes\":\"\",\"stages\":\"\",\"credit_hours_3\":\"\",\"academic_advising\":\"\",\"assessment_procedures\":\"\",\"national_qualification\":[],\"program_outcomes_knowledge\":[],\"program_outcomes_cognitive_skills\":[],\"program_outcomes_interpersonal_skills\":[],\"program_outcomes_communication\":[],\"program_outcomes_psychomotor\":[],\"handbook\":\"\",\"handbooks\":\"\"}'),(248,243,13,14,240,0,2019,'E. Regulations for Student Assessment and Verification of Standards','Node\\ncapm14\\Program_Specifications_E','2019-01-13 16:05:24',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"processes\":\"\"}'),(249,243,15,16,240,0,2019,'F. Student Administration and Support','Node\\ncapm14\\Program_Specifications_F','2019-01-13 16:05:24',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"academic_counselling\":\"\",\"student_appeals\":\"\"}'),(250,243,17,18,240,0,2019,'G. Learning Resources, Facilities and Equipment','Node\\ncapm14\\Program_Specifications_G','2019-01-13 16:05:24',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"processes\":\"\",\"teaching_staff_processes\":\"\",\"text_book\":\"\",\"resourses\":\"\",\"acquisition_and_approval\":\"\"}'),(251,243,19,20,240,0,2019,'H. Faculty and other Teaching Staff','Node\\ncapm14\\Program_Specifications_H','2019-01-13 16:05:24',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"appointments\":\"\",\"processes\":\"\",\"advisory_committee\":\"\",\"skills\":\"\",\"research\":\"\",\"orientation\":\"\",\"summary\":\"\"}'),(252,243,21,22,240,0,2019,'I. Program Evaluation and Improvement Processes','Node\\ncapm14\\Program_Specifications_I','2019-01-13 16:05:24',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"qa_processes\":\"\",\"faculty_skills\":\"\",\"student\":\"\",\"advisors\":\"\",\"stakeholders\":\"\",\"regulation\":\"\",\"specifications\":\"\"}'),(253,243,23,24,240,0,2019,'Authorized Signatures','Node\\ncai14\\Ssri_Signatures','2019-01-13 16:05:25',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"authorized_signature\":[]}'),(254,242,26,47,240,0,2019,'Annual Program Report (APR)','Node\\ncapm14\\Annual','2019-01-13 16:05:25',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"institution\":\"Jadeer\",\"date_of_report\":\"2019-01-13\",\"college\":\"Al Huson University College\",\"department\":\"Computer Department\"}'),(255,254,27,28,240,0,2019,'A. Program Identification and General Information','Node\\ncapm14\\Annual_A','2019-01-13 16:05:25',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"program_title\":\"Computer Science Program\",\"program_code\":\"\",\"name_and_position\":\"\",\"academic_year\":\"2019\"}'),(256,254,29,30,240,0,2019,'B. Statistical Information','Node\\ncapm14\\Annual_B','2019-01-13 16:05:25',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"num_of_students_started_program\":\"\",\"info\":\"\",\"major_tracks\":[{\"title\":\"\",\"no\":\"\"}],\"early_exit_point\":\"\",\"percentage_students_completed\":\"0\",\"percentage_students_completed_intermediate\":\"0\",\"comment\":\"\",\"cohort_a\":{\"2\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"},\"7\":{\"sixth_year\":\"\"}},\"3\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"},\"7\":{\"sixth_year\":\"\"}},\"4\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"},\"7\":{\"sixth_year\":\"\"}},\"5\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"},\"7\":{\"sixth_year\":\"\"}},\"6\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"},\"7\":{\"sixth_year\":\"\"}}},\"cohort_b\":{\"2\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"}},\"3\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"}},\"4\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"}},\"5\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"}},\"6\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"}}},\"cohort_c\":{\"2\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"}},\"3\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"}},\"4\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"}},\"5\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"}},\"6\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"}}},\"cohort_d\":{\"2\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"}},\"3\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"}},\"4\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"}},\"5\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"}},\"6\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"}}},\"date_of_survey\":\"\",\"number_surveyed\":\"\",\"number_responded\":\"\",\"response_rate\":\"0\",\"destination_of_graduates\":{\"3\":{\"2\":{\"number\":\"\"},\"3\":{\"number\":\"\"},\"4\":{\"number\":\"\"},\"5\":{\"number\":\"\"},\"6\":{\"number\":\"\"}},\"4\":{\"2\":{\"percents\":\"0\"},\"3\":{\"percents\":\"0\"},\"4\":{\"percents\":\"0\"},\"5\":{\"percents\":\"0\"},\"6\":{\"percents\":\"0\"}}},\"list_strengths\":\"\"}'),(257,254,31,32,240,0,2019,'C. Program Context','Node\\ncapm14\\Annual_C','2019-01-13 16:05:25',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"significant_changes_within_institution\":\"\",\"within_implications_for_the_program\":\"\",\"significant_changes_external_institution\":\"\",\"external_implications_for_the_program\":\"\"}'),(258,254,33,34,240,0,2019,'D. Course Information Summary','Node\\ncapm14\\Annual_D','2019-01-13 16:05:25',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"describe_how_the_individual\":\"\",\"completion_rate_analysis\":\"\",\"grade_distribution_analysis\":\"\",\"trend_analysis\":\"\",\"list_courses\":[],\"delivery_of_planned_courses\":[],\"compensating_action\":[]}'),(259,254,35,36,240,0,2019,'E. Program Management and Administration','Node\\ncapm14\\Annual_E','2019-01-13 16:05:25',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"program_managemnet\":[]}'),(260,254,37,38,240,0,2019,'F. Summary Program Evaluation','Node\\ncapm14\\Annual_F','2019-01-13 16:05:25',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"date_of_survey_graduating\":\"\",\"attach_survey\":\"\",\"list_improvement_strengths\":\"\",\"analysis\":\"\",\"changes_propsed\":\"\",\"describe_evaluation_process\":\"\",\"attach_review_report\":\"\",\"list_suggestions_for_improvement\":\"\",\"analysis_of_recommendations_for_improvement\":\"\",\"changes_proposed_in_the_program\":\"\",\"rating_substandard_of_standard_4\":[],\"analysis_of_sub_standards\":\"\"}'),(261,254,39,40,240,0,2019,'G. Program Course Evaluation','Node\\ncapm14\\Annual_G','2019-01-13 16:05:25',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"list_courses\":[],\"attach_list\":\"\",\"curriculum_study_plan_levels\":[],\"national_qualification\":[],\"analysis_program\":\"\",\"kpi_table\":[],\"orientation_program\":\"\",\"offered\":\"\",\"brief_description\":\"\",\"list_recommendations\":\"\",\"if_orientation\":\"\",\"professional_development\":[],\"summary_analysis\":\"\"}'),(262,254,41,42,240,0,2019,'H. Independent Opinion on Quality of the Program','Node\\ncapm14\\Annual_H','2019-01-13 16:05:25',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"matters_raised\":\"\",\"comment_by_program\":\"\",\"implications_for_planning\":\"\",\"kpi_table\":[],\"kpi_table_anlaysis\":\"\",\"program_action_plan\":[],\"program_action_plan_analysis\":\"\"}'),(263,254,43,44,240,0,2019,'I. Action Plan Progress Report','Node\\ncapm14\\Annual_I','2019-01-13 16:05:25',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"action_plan_progress\":[]}'),(264,254,45,46,240,0,2019,'Signatures','Node\\ncapm14\\Annual_Signature','2019-01-13 16:05:25',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"signatures\":[]}'),(265,240,50,97,240,2,2019,'prince ghazi college for information technology','Node\\ncapm14\\College','2019-01-13 16:20:18',0,1,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(266,265,51,96,240,6,2019,'Computer Information system','Node\\ncapm14\\Program','2019-01-13 16:20:18',0,1,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(267,266,52,73,240,0,2019,'Program Specifications (PS)','Node\\ncapm14\\Program_Specifications','2019-01-13 16:20:18',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','compliant','{\"institution\":\"Jadeer\",\"date_of_report\":\"2019-01-13\",\"college\":\"prince ghazi college for information technology\",\"department\":\"Information Technology Department\",\"dean\":\"\",\"program_flowchart\":\"<p>asdasdasd<\\/p>\",\"branches\":[{\"branch\":\"\"}]}'),(268,267,53,54,240,0,2019,'A. Program Identification and General Information','Node\\ncapm14\\Program_Specifications_A','2019-01-13 16:20:18',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"program_title\":\"Computer Information system\",\"program_code\":\"\",\"total_credit_hour\":\"0\",\"program_completion\":\"\",\"tracks_and_pathway\":\"\",\"exit_point\":\"\",\"professional_occupations\":\"\",\"planned_starting_date\":\"\",\"program_review\":\"\",\"note\":\"\",\"accreditation_review\":\"\",\"other\":\"\",\"program_coordinator\":\"\",\"approval_date\":[{\"campus_branch_location\":\"\",\"approval_by\":\"\",\"date\":\"\"}]}'),(269,267,55,56,240,0,2019,'B. Program Context','Node\\ncapm14\\Program_Specifications_B','2019-01-13 16:20:18',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"economic_reasons\":\"\",\"program_mission\":\"\",\"courses_meet_student\":\"\",\"courses_meet_department_student\":\"\",\"modifications_and_services\":\"\",\"program_courses\":\"\",\"program_require_students\":\"\",\"students_characteristics\":\"\"}'),(270,267,57,58,240,0,2019,'C. Mission, Goals and Objectives','Node\\ncapm14\\Program_Specifications_C','2019-01-13 16:20:18',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"program_missions\":\"\",\"list_of_goals\":\"\",\"goals_and_objective\":[{\"objectives\":\"\",\"measurable_indicators\":\"\",\"major_strategies\":\"\"}]}'),(271,267,59,60,240,0,2019,'D. Program Structure and Organization','Node\\ncapm14\\Program_Specifications_D','2019-01-13 16:20:18',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"curriculum_study_plan_levels\":[{\"level\":\"\",\"curriculum_study_plan\":[{\"course_code\":\"\",\"course_title\":\"\",\"prerequired_or_elective\":\"\",\"credit_houre\":\"\",\"college_or_department\":\"\"}]}],\"experience_activity\":\"\",\"field_experience\":\"\",\"time_allocation\":\"\",\"credit_hours_2\":\"\",\"project_summery\":\"\",\"a_description\":\"\",\"major_learning_outcomes\":\"\",\"stages\":\"\",\"credit_hours_3\":\"\",\"academic_advising\":\"\",\"assessment_procedures\":\"\",\"national_qualification\":{\"2\":{\"1\":{\"national_qualifications\":[{\"code\":\"\",\"learning_outcome\":\"\",\"teaching_strategies\":\"\",\"assessment_methods\":\"\"}]}},\"4\":{\"1\":{\"national_qualifications\":[{\"code\":\"\",\"learning_outcome\":\"\",\"teaching_strategies\":\"\",\"assessment_methods\":\"\"}]}},\"6\":{\"1\":{\"national_qualifications\":[{\"code\":\"\",\"learning_outcome\":\"\",\"teaching_strategies\":\"\",\"assessment_methods\":\"\"}]}},\"8\":{\"1\":{\"national_qualifications\":[{\"code\":\"\",\"learning_outcome\":\"\",\"teaching_strategies\":\"\",\"assessment_methods\":\"\"}]}},\"10\":{\"1\":{\"national_qualifications\":[{\"code\":\"\",\"learning_outcome\":\"\",\"teaching_strategies\":\"\",\"assessment_methods\":\"\"}]}}},\"program_outcomes_knowledge\":[{\"learning_outcomes\":\"\",\"course_levels\":[{\"course_code\":\"\",\"level\":\"I\"}]}],\"program_outcomes_cognitive_skills\":[{\"learning_outcomes\":\"\",\"course_levels\":[{\"course_code\":\"\",\"level\":\"I\"}]}],\"program_outcomes_interpersonal_skills\":[{\"learning_outcomes\":\"\",\"course_levels\":[{\"course_code\":\"\",\"level\":\"I\"}]}],\"program_outcomes_communication\":[{\"learning_outcomes\":\"\",\"course_levels\":[{\"course_code\":\"\",\"level\":\"I\"}]}],\"program_outcomes_psychomotor\":[{\"learning_outcomes\":\"\",\"course_levels\":[{\"course_code\":\"\",\"level\":\"I\"}]}],\"handbook\":\"\",\"handbooks\":\"\"}'),(272,267,61,62,240,0,2019,'E. Regulations for Student Assessment and Verification of Standards','Node\\ncapm14\\Program_Specifications_E','2019-01-13 16:20:18',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"processes\":\"\"}'),(273,267,63,64,240,0,2019,'F. Student Administration and Support','Node\\ncapm14\\Program_Specifications_F','2019-01-13 16:20:18',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"academic_counselling\":\"\",\"student_appeals\":\"\"}'),(274,267,65,66,240,0,2019,'G. Learning Resources, Facilities and Equipment','Node\\ncapm14\\Program_Specifications_G','2019-01-13 16:20:18',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"processes\":\"\",\"teaching_staff_processes\":\"\",\"text_book\":\"\",\"resourses\":\"\",\"acquisition_and_approval\":\"\"}'),(275,267,67,68,240,0,2019,'H. Faculty and other Teaching Staff','Node\\ncapm14\\Program_Specifications_H','2019-01-13 16:20:18',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"appointments\":\"\",\"processes\":\"\",\"advisory_committee\":\"\",\"skills\":\"\",\"research\":\"\",\"orientation\":\"\",\"summary\":\"\"}'),(276,267,69,70,240,0,2019,'I. Program Evaluation and Improvement Processes','Node\\ncapm14\\Program_Specifications_I','2019-01-13 16:20:18',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"qa_processes\":\"\",\"faculty_skills\":\"\",\"student\":\"\",\"advisors\":\"\",\"stakeholders\":\"\",\"regulation\":\"\",\"specifications\":\"\"}'),(277,267,71,72,240,0,2019,'Authorized Signatures','Node\\ncai14\\Ssri_Signatures','2019-01-13 16:20:18',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"authorized_signature\":[]}'),(278,266,74,95,240,0,2019,'Annual Program Report (APR)','Node\\ncapm14\\Annual','2019-01-13 16:20:18',0,1,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','compliant','{\"institution\":\"Jadeer\",\"date_of_report\":\"2019-01-13\",\"college\":\"prince ghazi college for information technology\",\"department\":\"Information Technology Department\",\"dean\":\"\",\"branches\":[{\"campus_branch_location\":\"\",\"approval_by\":\"\",\"date\":\"\"}]}'),(279,278,75,76,240,0,2019,'A. Program Identification and General Information','Node\\ncapm14\\Annual_A','2019-01-13 16:20:18',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"program_title\":\"Computer Information system\",\"program_code\":\"\",\"academic_year\":2019}'),(280,278,77,78,240,0,2019,'B. Statistical Information','Node\\ncapm14\\Annual_B','2019-01-13 16:20:18',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"num_of_students_started_program\":\"\",\"info\":\"\",\"major_tracks\":[],\"early_exit_point\":\"\",\"percentage_students_completed\":\"\",\"percentage_students_completed_intermediate\":\"\",\"comment\":\"\",\"cohort_a\":[],\"cohort_b\":[],\"cohort_c\":[],\"cohort_d\":[],\"date_of_survey\":\"\",\"number_surveyed\":\"\",\"number_responded\":\"\",\"response_rate\":\"\",\"destination_of_graduates\":[],\"list_strengths\":\"\"}'),(281,278,79,80,240,0,2019,'C. Program Context','Node\\ncapm14\\Annual_C','2019-01-13 16:20:18',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"significant_changes_within_institution\":\"\",\"within_implications_for_the_program\":\"\",\"significant_changes_external_institution\":\"\",\"external_implications_for_the_program\":\"\"}'),(282,278,81,82,240,0,2019,'D. Course Information Summary','Node\\ncapm14\\Annual_D','2019-01-13 16:20:18',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"describe_how_the_individual\":\"\",\"completion_rate_analysis\":\"\",\"grade_distribution_analysis\":\"\",\"trend_analysis\":\"\",\"list_courses\":[],\"delivery_of_planned_courses\":[],\"compensating_action\":[]}'),(283,278,83,84,240,0,2019,'E. Program Management and Administration','Node\\ncapm14\\Annual_E','2019-01-13 16:20:18',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"program_managemnet\":[]}'),(284,278,85,86,240,0,2019,'F. Summary Program Evaluation','Node\\ncapm14\\Annual_F','2019-01-13 16:20:19',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"date_of_survey_graduating\":\"\",\"attach_survey\":\"\",\"list_improvement_strengths\":\"\",\"analysis\":\"\",\"changes_propsed\":\"\",\"describe_evaluation_process\":\"\",\"attach_review_report\":\"\",\"list_suggestions_for_improvement\":\"\",\"analysis_of_recommendations_for_improvement\":\"\",\"changes_proposed_in_the_program\":\"\",\"rating_substandard_of_standard_4\":[],\"analysis_of_sub_standards\":\"\"}'),(285,278,87,88,240,0,2019,'G. Program Course Evaluation','Node\\ncapm14\\Annual_G','2019-01-13 16:20:19',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"list_courses\":[],\"attach_list\":\"\",\"curriculum_study_plan_levels\":[],\"national_qualification\":[],\"analysis_program\":\"\",\"kpi_table\":[],\"orientation_program\":\"\",\"offered\":\"\",\"brief_description\":\"\",\"list_recommendations\":\"\",\"if_orientation\":\"\",\"professional_development\":[],\"summary_analysis\":\"\"}'),(286,278,89,90,240,0,2019,'H. Independent Opinion on Quality of the Program','Node\\ncapm14\\Annual_H','2019-01-13 16:20:19',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"matters_raised\":\"\",\"comment_by_program\":\"\",\"implications_for_planning\":\"\",\"kpi_table\":[],\"kpi_table_anlaysis\":\"\",\"program_action_plan\":[],\"program_action_plan_analysis\":\"\"}'),(287,278,91,92,240,0,2019,'I. Action Plan Progress Report','Node\\ncapm14\\Annual_I','2019-01-13 16:20:19',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"action_plan_progress\":[]}'),(288,278,93,94,240,0,2019,'Signatures','Node\\ncapm14\\Annual_Signature','2019-01-13 16:20:19',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"signatures\":[]}'),(289,0,1,336,289,1,2019,'Self Study Reports V.2018','Node\\ncassr18\\Root','2019-01-17 14:28:05',0,0,0,0,'0000-00-00 00:00:00','2019-01-25 23:59:59','none','[]'),(290,289,2,335,289,1,2019,'Al Huson University College','Node\\ncassr18\\College','2019-01-17 14:31:30',0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(291,290,3,334,289,5,2019,'Computer Science Program','Node\\ncassr18\\Program','2019-01-17 14:31:31',0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(292,291,4,5,289,0,2019,'Program Profile','Node\\ncassr18\\Program_Profile','2019-01-17 14:31:31',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"institution\":\"Jadeer\",\"college\":\"Al Huson University College\",\"department\":\"Computer Department\",\"title_of_program\":\"Computer Science Program\",\"code_of_program\":\"\",\"credit_hour\":\"0\"}'),(293,291,6,37,289,0,2019,'Eligibility Requirements for an Application for Program Accreditation (ER)','Node\\ncassr18\\Eligibility_Requirements','2019-01-17 14:31:31',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(294,293,7,8,289,0,2019,'1. Authorization of Program','Node\\ncassr18\\Eligibility_Requirements_1','2019-01-17 14:31:31',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(295,293,9,10,289,0,2019,'2. Application for accreditation','Node\\ncassr18\\Eligibility_Requirements_2','2019-01-17 14:31:31',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(296,293,11,12,289,0,2019,'3. Program Specifications – T4','Node\\ncassr18\\Eligibility_Requirements_3','2019-01-17 14:31:31',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(297,293,13,14,289,0,2019,'4. Course Specifications and their corresponding Course Reports – T6','Node\\ncassr18\\Eligibility_Requirements_4','2019-01-17 14:31:31',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(298,293,15,16,289,0,2019,'5. Program or Course Requirements ','Node\\ncassr18\\Eligibility_Requirements_5','2019-01-17 14:31:31',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(299,293,17,18,289,0,2019,'6. Annual Program Report – T3','Node\\ncassr18\\Eligibility_Requirements_6','2019-01-17 14:31:31',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(300,293,19,20,289,0,2019,'7. Student Evaluation Survey Results','Node\\ncassr18\\Eligibility_Requirements_7','2019-01-17 14:31:31',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(301,293,21,22,289,0,2019,'8. Alumni and Employer Survey Results','Node\\ncassr18\\Eligibility_Requirements_8','2019-01-17 14:31:31',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(302,293,23,24,289,0,2019,'9. Program Advisory committees','Node\\ncassr18\\Eligibility_Requirements_9','2019-01-17 14:31:31',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(303,293,25,26,289,0,2019,'10. Program KPIs and Benchmarks','Node\\ncassr18\\Eligibility_Requirements_10','2019-01-17 14:31:31',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(304,293,27,28,289,0,2019,'11. Program Learning Outcome Mapping','Node\\ncassr18\\Eligibility_Requirements_11','2019-01-17 14:31:31',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(305,293,29,30,289,0,2019,'12. Self Evaluation Scales – D2.P','Node\\ncassr18\\Eligibility_Requirements_12','2019-01-17 14:31:31',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(306,293,31,32,289,0,2019,'13. Self Study Report for Programs – T12','Node\\ncassr18\\Eligibility_Requirements_13','2019-01-17 14:31:31',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(307,293,33,34,289,0,2019,'Eligibility for Program Accreditation Checklist','Node\\ncassr18\\Eligibility_Checklist','2019-01-17 14:31:31',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"institution\":\"Jadeer\",\"date\":\"2019-01-17\",\"program\":\"Computer Science Program\"}'),(308,293,35,36,289,0,2019,'Signatures','Node\\ncassr18\\Eligibility_Requirements_Signature','2019-01-17 14:31:32',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"university_rector\":\"\",\"date\":\"\"}'),(309,291,38,173,289,0,2019,'Self Evaluation Scales (SES)','Node\\ncassr18\\Ses','2019-01-17 14:31:32',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(310,309,39,52,289,0,2019,'Standard 1. Mission Goals and Objectives','Node\\ncassr18\\Ses_Standard_1','2019-01-17 14:31:32',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(311,310,40,41,289,0,2019,'1.1 Appropriateness of the Mission','Node\\ncassr18\\Ses_Standard_1_1','2019-01-17 14:31:32',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"1_1_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_1_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_1_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_1_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(312,310,42,43,289,0,2019,'1.2 Usefulness of the Mission Statement','Node\\ncassr18\\Ses_Standard_1_2','2019-01-17 14:31:32',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"1_2_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_2_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_2_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(313,310,44,45,289,0,2019,'1.3 Development and Review of the Mission ','Node\\ncassr18\\Ses_Standard_1_3','2019-01-17 14:31:32',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"1_3_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_3_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_3_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_3_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(314,310,46,47,289,0,2019,'1.4 Use Made of the Mission Statement','Node\\ncassr18\\Ses_Standard_1_4','2019-01-17 14:31:32',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"1_4_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_4_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_4_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(315,310,48,49,289,0,2019,'1.5 Relationship Between Mission, Goals and Objectives ','Node\\ncassr18\\Ses_Standard_1_5','2019-01-17 14:31:32',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"1_5_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_5_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_5_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"1_5_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(316,310,50,51,289,0,2019,'Overall Assessment of Mission Goals and Objectives','Node\\ncassr18\\Ses_Standard_1_Overall','2019-01-17 14:31:32',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"1_1\":\"\",\"1_2\":\"\",\"1_3\":\"\",\"1_4\":\"\",\"1_5\":\"\",\"combined_assessment\":\"\",\"comment\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\",\"indicators_considered\":\"\",\"priorities_for_improvement\":\"\"}'),(317,309,53,66,289,0,2019,'Standard 2. Program Administration','Node\\ncassr18\\Ses_Standard_2','2019-01-17 14:31:32',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(318,317,54,55,289,0,2019,'2.1 Leadership','Node\\ncassr18\\Ses_Standard_2_1','2019-01-17 14:31:32',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"2_1_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_1_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_1_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_1_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_1_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_1_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_1_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_1_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_1_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_1_10\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_1_11\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_1_12\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(319,317,56,57,289,0,2019,'2.2 Planning Processes','Node\\ncassr18\\Ses_Standard_2_2','2019-01-17 14:31:32',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"2_2_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_2_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_2_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_2_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_2_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_2_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_2_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_2_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_2_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(320,317,58,59,289,0,2019,'2.3 Relationship Between Sections for Male and Female Students','Node\\ncassr18\\Ses_Standard_2_3','2019-01-17 14:31:32',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"2_3_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_3_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_3_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_3_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_3_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(321,317,60,61,289,0,2019,'2.4 Integrity','Node\\ncassr18\\Ses_Standard_2_4','2019-01-17 14:31:32',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"2_4_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_4_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_4_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(322,317,62,63,289,0,2019,'2.5 Internal Policies and Regulations','Node\\ncassr18\\Ses_Standard_2_5','2019-01-17 14:31:32',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"2_5_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_5_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_5_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_5_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"2_5_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(323,317,64,65,289,0,2019,'Overall Assessment of Program Administration','Node\\ncassr18\\Ses_Standard_2_Overall','2019-01-17 14:31:33',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"2_1\":\"\",\"2_2\":\"\",\"2_3\":\"\",\"2_4\":\"\",\"2_5\":\"\",\"combined_assessment\":\"\",\"comment\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\",\"indicators_considered\":\"\",\"priorities_for_improvement\":\"\"}'),(324,309,67,80,289,0,2019,'Standard 3. Management of Program Quality Assurance','Node\\ncassr18\\Ses_Standard_3','2019-01-17 14:31:33',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(325,324,68,69,289,0,2019,'3.1 Commitment to Quality Improvement in the Program','Node\\ncassr18\\Ses_Standard_3_1','2019-01-17 14:31:33',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"3_1_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_1_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_1_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_1_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_1_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(326,324,70,71,289,0,2019,'3.2 Scope of Quality Assurance Processes','Node\\ncassr18\\Ses_Standard_3_2','2019-01-17 14:31:33',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"3_2_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_2_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_2_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_2_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_2_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_2_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(327,324,72,73,289,0,2019,'3.3 Administration of Quality Assurance Processes','Node\\ncassr18\\Ses_Standard_3_3','2019-01-17 14:31:33',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"3_3_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_3_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_3_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_3_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_3_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_3_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_3_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_3_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(328,324,74,75,289,0,2019,'3.4 Use of Performance Indicators and Benchmarks','Node\\ncassr18\\Ses_Standard_3_4','2019-01-17 14:31:33',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"3_4_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_4_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_4_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_4_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_4_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(329,324,76,77,289,0,2019,'3.5 Independent Verification of Standards','Node\\ncassr18\\Ses_Standard_3_5','2019-01-17 14:31:33',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"3_5_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_5_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"3_5_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(330,324,78,79,289,0,2019,'Overall Assessment of Management of Program Quality Assurance','Node\\ncassr18\\Ses_Standard_3_Overall','2019-01-17 14:31:33',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"3_1\":\"\",\"3_2\":\"\",\"3_3\":\"\",\"3_4\":\"\",\"3_5\":\"\",\"combined_assessment\":\"\",\"comment\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\",\"indicators_considered\":\"\",\"priorities_for_improvement\":\"\"}'),(331,309,81,104,289,0,2019,'Standard 4. Learning and Teaching','Node\\ncassr18\\Ses_Standard_4','2019-01-17 14:31:33',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(332,331,82,83,289,0,2019,'4.1 Student Learning Outcomes','Node\\ncassr18\\Ses_Standard_4_1','2019-01-17 14:31:33',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"4_1_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_1_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_1_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_1_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_1_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(333,331,84,85,289,0,2019,'4.2 Program Development Processes','Node\\ncassr18\\Ses_Standard_4_2','2019-01-17 14:31:33',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"4_2_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_2_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_2_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_2_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_2_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_2_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_2_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(334,331,86,87,289,0,2019,'4.3 Program Evaluation and Review Processes','Node\\ncassr18\\Ses_Standard_4_3','2019-01-17 14:31:33',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"4_3_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_3_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_3_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_3_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_3_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_3_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_3_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_3_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_3_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_3_10\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_3_11\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(335,331,88,89,289,0,2019,'4.4 Student Assessment','Node\\ncassr18\\Ses_Standard_4_4','2019-01-17 14:31:33',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"4_4_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_4_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_4_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_4_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_4_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_4_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_4_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_4_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_4_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_4_10\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(336,331,90,91,289,0,2019,'4.5 Educational Assistance for Students','Node\\ncassr18\\Ses_Standard_4_5','2019-01-17 14:31:33',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"4_5_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_5_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_5_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_5_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_5_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_5_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_5_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_5_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_5_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_5_10\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_5_11\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_5_12\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_5_13\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_5_14\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_5_15\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(337,331,92,93,289,0,2019,'4.6 Quality of Teaching','Node\\ncassr18\\Ses_Standard_4_6','2019-01-17 14:31:33',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"4_6_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_6_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_6_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_6_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_6_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_6_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_6_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_6_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_6_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_6_10\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_6_11\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_6_12\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(338,331,94,95,289,0,2019,'4.7 Support for Improvements in Quality of Teaching','Node\\ncassr18\\Ses_Standard_4_7','2019-01-17 14:31:33',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"4_7_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_7_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_7_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_7_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_7_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_7_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_7_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(339,331,96,97,289,0,2019,'4.8 Qualifications and Experience of Teaching Staff','Node\\ncassr18\\Ses_Standard_4_8','2019-01-17 14:31:33',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"4_8_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_8_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_8_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_8_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_8_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(340,331,98,99,289,0,2019,'4.9 Field Experience Activities','Node\\ncassr18\\Ses_Standard_4_9','2019-01-17 14:31:33',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"4_9_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_9_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_9_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_9_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_9_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_9_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_9_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_9_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_9_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(341,331,100,101,289,0,2019,'4.10 Partnership Arrangements With Other Institutions','Node\\ncassr18\\Ses_Standard_4_10','2019-01-17 14:31:33',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"4_10_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_10_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_10_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_10_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_10_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_10_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_10_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_10_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"4_10_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(342,331,102,103,289,0,2019,'Overall Assessment of Learning and Teaching','Node\\ncassr18\\Ses_Standard_4_Overall','2019-01-17 14:31:33',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"4_1\":\"\",\"4_2\":\"\",\"4_3\":\"\",\"4_4\":\"\",\"4_5\":\"\",\"4_6\":\"\",\"4_7\":\"\",\"4_8\":\"\",\"4_9\":\"\",\"4_10\":\"\",\"combined_assessment\":\"\",\"comment\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\",\"indicators_considered\":\"\",\"priorities_for_improvement\":\"\"}'),(343,309,105,116,289,0,2019,'Standard 5. Student Administration and Support Services','Node\\ncassr18\\Ses_Standard_5','2019-01-17 14:31:34',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(344,343,106,107,289,0,2019,'5.1 Student Admissions','Node\\ncassr18\\Ses_Standard_5_1','2019-01-17 14:31:34',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"5_1_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_1_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_1_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_1_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_1_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_1_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_1_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(345,343,108,109,289,0,2019,'5.2 Student Records','Node\\ncassr18\\Ses_Standard_5_2','2019-01-17 14:31:34',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"5_2_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_2_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_2_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_2_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(346,343,110,111,289,0,2019,'5.3 Student Management','Node\\ncassr18\\Ses_Standard_5_3','2019-01-17 14:31:34',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"5_3_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_3_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_3_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_3_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_3_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_3_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(347,343,112,113,289,0,2019,'5.4 Student Advising and Counseling Services','Node\\ncassr18\\Ses_Standard_5_4','2019-01-17 14:31:34',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"5_4_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_4_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_4_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"5_4_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(348,343,114,115,289,0,2019,'Overall Assessment of Student Administration and Support Services','Node\\ncassr18\\Ses_Standard_5_Overall','2019-01-17 14:31:34',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"5_1\":\"\",\"5_2\":\"\",\"5_3\":\"\",\"5_4\":\"\",\"combined_assessment\":\"\",\"comment\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\",\"indicators_considered\":\"\",\"priorities_for_improvement\":\"\"}'),(349,309,117,128,289,0,2019,'Standard 6. Learning Resources','Node\\ncassr18\\Ses_Standard_6','2019-01-17 14:31:34',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(350,349,118,119,289,0,2019,'6.1 Planning and Evaluation','Node\\ncassr18\\Ses_Standard_6_1','2019-01-17 14:31:34',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"6_1_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_1_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_1_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_1_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_1_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(351,349,120,121,289,0,2019,'6.2 Organization','Node\\ncassr18\\Ses_Standard_6_2','2019-01-17 14:31:34',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"6_2_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_2_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_2_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(352,349,122,123,289,0,2019,'6.3 Support for Users','Node\\ncassr18\\Ses_Standard_6_3','2019-01-17 14:31:34',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"6_3_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_3_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_3_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_3_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_3_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(353,349,124,125,289,0,2019,'6.4 Resources and Facilities','Node\\ncassr18\\Ses_Standard_6_4','2019-01-17 14:31:34',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"6_4_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_4_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_4_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"6_4_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(354,349,126,127,289,0,2019,'Overall Assessment of Learning Resources','Node\\ncassr18\\Ses_Standard_6_Overall','2019-01-17 14:31:34',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"6_1\":\"\",\"6_2\":\"\",\"6_3\":\"\",\"6_4\":\"\",\"combined_assessment\":\"\",\"comment\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\",\"indicators_considered\":\"\",\"priorities_for_improvement\":\"\"}'),(355,309,129,140,289,0,2019,'Standard 7. Facilities and Equipment','Node\\ncassr18\\Ses_Standard_7','2019-01-17 14:31:34',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(356,355,130,131,289,0,2019,'7.1 Policy and Planning','Node\\ncassr18\\Ses_Standard_7_1','2019-01-17 14:31:34',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"7_1_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_1_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_1_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(357,355,132,133,289,0,2019,'7.2 Quality and Adequacy of Facilities and Equipment','Node\\ncassr18\\Ses_Standard_7_2','2019-01-17 14:31:35',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"7_2_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_2_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_2_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_2_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_2_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(358,355,134,135,289,0,2019,'7.3 Management and Administration','Node\\ncassr18\\Ses_Standard_7_3','2019-01-17 14:31:35',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"7_3_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_3_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_3_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_3_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_3_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_3_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(359,355,136,137,289,0,2019,'7.4 Information Technology','Node\\ncassr18\\Ses_Standard_7_4','2019-01-17 14:31:35',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"7_4_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_4_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_4_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_4_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_4_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_4_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"7_4_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(360,355,138,139,289,0,2019,'Overall Assessment of Facilities and Equipment','Node\\ncassr18\\Ses_Standard_7_Overall','2019-01-17 14:31:35',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"7_1\":\"\",\"7_2\":\"\",\"7_3\":\"\",\"7_4\":\"\",\"combined_assessment\":\"\",\"comment\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\",\"indicators_considered\":\"\",\"priorities_for_improvement\":\"\"}'),(361,309,141,148,289,0,2019,'Standard 8. Financial Planning and Management','Node\\ncassr18\\Ses_Standard_8','2019-01-17 14:31:35',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(362,361,142,143,289,0,2019,'8.1 Financial Planning and Budgeting','Node\\ncassr18\\Ses_Standard_8_1','2019-01-17 14:31:35',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"8_1_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_1_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_1_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_1_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_1_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(363,361,144,145,289,0,2019,'8.2 Financial Management','Node\\ncassr18\\Ses_Standard_8_2','2019-01-17 14:31:35',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"8_2_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_2_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_2_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_2_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_2_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"8_2_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(364,361,146,147,289,0,2019,'Overall Assessment of Financial Planning and Management','Node\\ncassr18\\Ses_Standard_8_Overall','2019-01-17 14:31:35',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"8_1\":\"\",\"8_2\":\"\",\"combined_assessment\":\"\",\"comment\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\",\"indicators_considered\":\"\",\"priorities_for_improvement\":\"\"}'),(365,309,149,156,289,0,2019,'Standard 9. Employment Processes','Node\\ncassr18\\Ses_Standard_9','2019-01-17 14:31:35',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(366,365,150,151,289,0,2019,'9.1 Recruitment','Node\\ncassr18\\Ses_Standard_9_1','2019-01-17 14:31:35',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"9_1_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_1_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_1_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_1_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_1_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_1_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_1_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_1_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(367,365,152,153,289,0,2019,'9.2 Personal and Career Development','Node\\ncassr18\\Ses_Standard_9_2','2019-01-17 14:31:35',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"9_2_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_2_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_2_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_2_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_2_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_2_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_2_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_2_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_2_9\":{\"score\":0,\"applicable\":\"N\\/A\"},\"9_2_10\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(368,365,154,155,289,0,2019,'Overall Assessment of Employment Processes','Node\\ncassr18\\Ses_Standard_9_Overall','2019-01-17 14:31:35',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"9_1\":\"\",\"9_2\":\"\",\"combined_assessment\":\"\",\"comment\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\",\"indicators_considered\":\"\",\"priorities_for_improvement\":\"\"}'),(369,309,157,164,289,0,2019,'Standard 10. Research','Node\\ncassr18\\Ses_Standard_10','2019-01-17 14:31:35',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(370,369,158,159,289,0,2019,'10.1 Teaching Staff and Student Involvement in Research','Node\\ncassr18\\Ses_Standard_10_1','2019-01-17 14:31:35',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"10_1_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_1_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_1_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_1_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_1_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_1_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_1_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_1_8\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(371,369,160,161,289,0,2019,'10.2 Research Facilities and Equipmen','Node\\ncassr18\\Ses_Standard_10_2','2019-01-17 14:31:35',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"10_2_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_2_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_2_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"10_2_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(372,369,162,163,289,0,2019,'Overall Assessment of Research','Node\\ncassr18\\Ses_Standard_10_Overall','2019-01-17 14:31:35',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"10_1\":\"\",\"10_2\":\"\",\"combined_assessment\":\"\",\"comment\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\",\"indicators_considered\":\"\",\"priorities_for_improvement\":\"\"}'),(373,309,165,172,289,0,2019,'Standard 11. Relationships with the Community','Node\\ncassr18\\Ses_Standard_11','2019-01-17 14:31:35',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(374,373,166,167,289,0,2019,'11.1 Policies on Community Relationships','Node\\ncassr18\\Ses_Standard_11_1','2019-01-17 14:31:35',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"11_1_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"11_1_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"11_1_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"11_1_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(375,373,168,169,289,0,2019,'11.2 Interactions With the Community','Node\\ncassr18\\Ses_Standard_11_2','2019-01-17 14:31:35',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"11_2_1\":{\"score\":0,\"applicable\":\"N\\/A\"},\"11_2_2\":{\"score\":0,\"applicable\":\"N\\/A\"},\"11_2_3\":{\"score\":0,\"applicable\":\"N\\/A\"},\"11_2_4\":{\"score\":0,\"applicable\":\"N\\/A\"},\"11_2_5\":{\"score\":0,\"applicable\":\"N\\/A\"},\"11_2_6\":{\"score\":0,\"applicable\":\"N\\/A\"},\"11_2_7\":{\"score\":0,\"applicable\":\"N\\/A\"},\"overall_assessment\":\"\",\"comment\":\"\",\"priorities_for_improvement\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\"}'),(376,373,170,171,289,0,2019,'Overall Assessment of  Relationships with the Community','Node\\ncassr18\\Ses_Standard_11_Overall','2019-01-17 14:31:35',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"11_1\":\"\",\"11_2\":\"\",\"combined_assessment\":\"\",\"comment\":\"\",\"independent_opinion\":\"\",\"independent_opinion_comment\":\"\",\"indicators_considered\":\"\",\"priorities_for_improvement\":\"\"}'),(377,291,174,333,289,0,2019,'Self-Study Report for Programs (SSRP)','Node\\ncassr18\\Ssr','2019-01-17 14:31:36',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(378,377,175,176,289,0,2019,'A. General Information','Node\\ncassr18\\Ssr_A','2019-01-17 14:31:36',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"institution\":\"Jadeer\",\"title_of_college\":\"Al Huson University College\",\"title_of_department\":\"Computer Department\",\"title_of_program\":\"Computer Science Program\",\"date_of_report\":\"2019-01-17\"}'),(379,377,177,178,289,0,2019,'B. Program Profile Information','Node\\ncassr18\\Ssr_B','2019-01-17 14:31:36',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"historical_summary\":\"\",\"preparatory_program\":\"\",\"preparatory_program_offered\":\"\",\"foundation_year_program\":\"\",\"academic_credits\":\"\",\"total_credits\":\"\",\"courses\":\"\",\"summary\":\"\"}'),(380,377,179,180,289,0,2019,'C. Program Profile analysis Information','Node\\ncassr18\\Ssr_C','2019-01-17 14:31:36',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"student_enrollment\":[],\"phd_faculty\":[],\"faculty\":[],\"faculty_ratio\":[],\"male_std\":[],\"female_std\":[],\"graduate\":[],\"moi\":[]}'),(381,377,181,182,289,0,2019,'D. Program Faculty Profile Template B: College Data','Node\\ncassr18\\Ssr_D','2019-01-17 14:31:36',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"college\":\"Al Huson University College\",\"department\":\"Computer Department\",\"program\":\"Computer Science Program\"}'),(382,377,183,184,289,0,2019,'E. Self-Study Process','Node\\ncassr18\\Ssr_E','2019-01-17 14:31:36',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"self_study\":\"\"}'),(383,377,185,186,289,0,2019,'F. MISSION, GOALS AND OBJECTIVES','Node\\ncassr18\\Ssr_F','2019-01-17 14:31:36',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"mission\":\"\",\"goals_and_mission\":[],\"strength\":\"\",\"program_evaluation\":\"\"}'),(384,377,187,188,289,0,2019,'G. PROGRAM CONTEXT AND DEVELOPMENTS','Node\\ncassr18\\Ssr_G','2019-01-17 14:31:36',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"list\":\"\",\"cohort_a\":[],\"cohort_a_analysis\":\"\",\"cohort_b\":[],\"cohort_b_analysis\":\"\",\"cohort_c\":[],\"cohort_c_analysis\":\"\",\"cohort_d\":[],\"cohort_d_analysis\":\"\",\"period_list\":\"\",\"comparison\":[],\"analysis\":\"\"}'),(385,377,189,324,289,0,2019,'H. Evaluation in Relation to Quality Standards','Node\\ncassr18\\Ssr_H','2019-01-17 14:31:36',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(386,385,190,195,289,0,2019,'Standard 1. Mission and Objectives','Node\\ncassr18\\Ssr_H_Standard_1','2019-01-17 14:31:36',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"overall_rating\":\"\",\"standard_description\":\"\",\"explanatory_report\":\"\",\"1_1\":\"\",\"1_2\":\"\",\"1_3\":\"\",\"1_4\":\"\",\"1_5\":\"\",\"quality_mission\":\"\"}'),(387,386,191,192,289,0,2019,'KPI S1.1','Node\\ncassr18\\Kpi','2019-01-17 14:31:36',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":1,\"kpi_id\":\"1\",\"kpi_info\":\"Stakeholders\' awareness ratings of the Mission Statement and Objectives (Average rating on how well the mission is known to teaching staff, and undergraduate and graduate students, respectively, on a five- point scale in an annual survey).\",\"kpi_ref_num\":\"S1.1\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(388,386,193,194,289,0,2019,'List of Annexes for standard 1','Node\\ncassr18\\Annexes_List','2019-01-17 14:31:36',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":1}'),(389,385,196,201,289,0,2019,'Standard 2. Program Administration','Node\\ncassr18\\Ssr_H_Standard_2','2019-01-17 14:31:36',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"overall_rating\":\"\",\"standard_description\":\"\",\"explanatory_report\":\"\",\"2_1\":\"\",\"2_2\":\"\",\"2_3\":\"\",\"2_4\":\"\",\"2_5\":\"\",\"quality_mission\":\"\"}'),(390,389,197,198,289,0,2019,'KPI S2.1','Node\\ncassr18\\Kpi','2019-01-17 14:31:36',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":2,\"kpi_id\":\"2\",\"kpi_info\":\"Stakeholder evaluation of the Policy Handbook, including administrative flow chart and job responsibilities (Average rating on the adequacy of the Policy Handbook on a five- point scale in an annual survey of teaching staff and final year students).\",\"kpi_ref_num\":\"S2.1\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(391,389,199,200,289,0,2019,'List of Annexes for standard 2','Node\\ncassr18\\Annexes_List','2019-01-17 14:31:36',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":2}'),(392,385,202,213,289,0,2019,'Standard 3. Management of  Program Quality Assurance','Node\\ncassr18\\Ssr_H_Standard_3','2019-01-17 14:31:36',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"overall_rating\":\"\",\"standard_description\":\"\",\"quality_assurance_processes\":\"\",\"3_1\":\"\",\"3_2\":\"\",\"3_3\":\"\",\"3_4\":\"\",\"3_5\":\"\",\"quality_mission\":\"\"}'),(393,392,203,204,289,0,2019,'KPI S3.1','Node\\ncassr18\\Kpi','2019-01-17 14:31:36',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":3,\"kpi_id\":\"3\",\"kpi_info\":\"Students\' overall evaluation on the quality of their learning experiences. (Average rating of the overall quality on a five point scale in an annual survey of final year students.)\",\"kpi_ref_num\":\"S3.1\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(394,392,205,206,289,0,2019,'KPI S3.2','Node\\ncassr18\\Kpi','2019-01-17 14:31:36',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":3,\"kpi_id\":\"4\",\"kpi_info\":\"Proportion of courses in which student evaluations were conducted during the year.\",\"kpi_ref_num\":\"S3.2\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(395,392,207,208,289,0,2019,'KPI S3.3','Node\\ncassr18\\Kpi','2019-01-17 14:31:36',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":3,\"kpi_id\":\"5\",\"kpi_info\":\"Proportion of programs in which there was an independent verification, within the institution, of standards of student achievement during the year.\",\"kpi_ref_num\":\"S3.3\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(396,392,209,210,289,0,2019,'KPI S3.4','Node\\ncassr18\\Kpi','2019-01-17 14:31:37',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":3,\"kpi_id\":\"6\",\"kpi_info\":\"Proportion of programs in which there was an independent verification of standards of student achievement by people (evaluators) external to the institution during the year.\",\"kpi_ref_num\":\"S3.4\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(397,392,211,212,289,0,2019,'List of Annexes for standard 3','Node\\ncassr18\\Annexes_List','2019-01-17 14:31:37',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":3}'),(398,385,214,253,289,0,2019,'Standard 4. Learning and Teaching.','Node\\ncassr18\\Ssr_H_Standard_4','2019-01-17 14:31:37',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"overall_rating\":\"\",\"explanatory_report\":\"\",\"standard_description\":\"\"}'),(399,398,215,216,289,0,2019,'Subsection 4.1 Student Learning Outcomes','Node\\ncassr18\\Ssr_H_Standard_4_1','2019-01-17 14:31:37',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"rating\":\"\",\"standard_description\":\"\",\"national_qualification\":[],\"program_outcomes_discribtion\":\"\",\"program_discribtion\":\"\",\"process\":\"\",\"process_list\":\"\",\"evaluation_report\":\"\"}'),(400,398,217,218,289,0,2019,'Subsection 4.2 Program Development Processes','Node\\ncassr18\\Ssr_H_Standard_4_2','2019-01-17 14:31:37',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"rating\":\"\",\"process\":\"\",\"evaluation_report\":\"\"}'),(401,398,219,220,289,0,2019,'Subsection 4.3 Program Evaluation and Review Processes','Node\\ncassr18\\Ssr_H_Standard_4_3','2019-01-17 14:31:37',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"rating\":\"\",\"process\":\"\",\"evaluation_report\":\"\",\"process_list\":\"\"}'),(402,398,221,222,289,0,2019,'Subsection 4.4 Student Assessment','Node\\ncassr18\\Ssr_H_Standard_4_4','2019-01-17 14:31:37',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"rating\":\"\",\"process\":\"\",\"evaluation_report\":\"\"}'),(403,398,223,224,289,0,2019,'Subsection 4.5 Educational Assistance for Students','Node\\ncassr18\\Ssr_H_Standard_4_5','2019-01-17 14:31:37',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"rating\":\"\",\"summary_report\":\"\",\"evaluation_report\":\"\"}'),(404,398,225,226,289,0,2019,'Subsection 4.6 Quality of Teaching','Node\\ncassr18\\Ssr_H_Standard_4_6','2019-01-17 14:31:37',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"rating\":\"\",\"information\":\"\",\"evaluation_report\":\"\"}'),(405,398,227,228,289,0,2019,'Subsection 4.7 Support for Improvements in Quality of Teaching','Node\\ncassr18\\Ssr_H_Standard_4_7','2019-01-17 14:31:37',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"rating\":\"\",\"summary_report\":\"\",\"evaluation_report\":\"\"}'),(406,398,229,230,289,0,2019,'Subsection 4.8  Qualifications and Experience of Teaching Staff','Node\\ncassr18\\Ssr_H_Standard_4_8','2019-01-17 14:31:37',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"rating\":\"\",\"evaluation_report\":\"\",\"summary_report\":\"\"}'),(407,398,231,232,289,0,2019,'Subsection 4.9 Field Experience Activities','Node\\ncassr18\\Ssr_H_Standard_4_9','2019-01-17 14:31:37',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"rating\":\"\",\"process\":\"\",\"evaluation_report\":\"\"}'),(408,398,233,234,289,0,2019,'Subsection 4.10 Partnership Arrangements With Other Institutions','Node\\ncassr18\\Ssr_H_Standard_4_10','2019-01-17 14:31:37',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"rating\":\"\",\"process\":\"\",\"evaluation_report\":\"\"}'),(409,398,235,252,289,0,2019,'KPI','Node\\ncassr18\\Ssr_H_Standard_4_Kpi','2019-01-17 14:31:37',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','[]'),(410,409,236,237,289,0,2019,'KPI S4.1','Node\\ncassr18\\Kpi','2019-01-17 14:31:37',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":4,\"kpi_id\":\"7\",\"kpi_info\":\"Ratio of students to teaching staff. (Based on full time equivalents)\",\"kpi_ref_num\":\"S4.1\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(411,409,238,239,289,0,2019,'KPI S4.2','Node\\ncassr18\\Kpi','2019-01-17 14:31:37',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":4,\"kpi_id\":\"8\",\"kpi_info\":\"Students overall rating on the quality of their courses. (Average rating of students on a five point scale on overall evaluation of courses.)\",\"kpi_ref_num\":\"S4.2\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(412,409,240,241,289,0,2019,'KPI S4.3','Node\\ncassr18\\Kpi','2019-01-17 14:31:37',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":4,\"kpi_id\":\"9\",\"kpi_info\":\"Proportion of teaching staff with verified doctoral qualifications.\",\"kpi_ref_num\":\"S4.3\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(413,409,242,243,289,0,2019,'KPI S4.4','Node\\ncassr18\\Kpi','2019-01-17 14:31:37',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":4,\"kpi_id\":\"10\",\"kpi_info\":\"Retention Rate; Percentage of students entering programs who successfully complete first year.\",\"kpi_ref_num\":\"S4.4\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(414,409,244,245,289,0,2019,'KPI S4.5','Node\\ncassr18\\Kpi','2019-01-17 14:31:37',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":4,\"kpi_id\":\"11\",\"kpi_info\":\"Graduation Rate for Undergraduate Students: Proportion of students entering undergraduate programs who complete those programs in minimum time.\",\"kpi_ref_num\":\"S4.5\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(415,409,246,247,289,0,2019,'KPI S4.6','Node\\ncassr18\\Kpi','2019-01-17 14:31:37',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":4,\"kpi_id\":\"12\",\"kpi_info\":\"Graduation Rates for Post Graduate Students: Proportion of students entering post graduate programs who complete those programs in specified time.\",\"kpi_ref_num\":\"S4.6\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(416,409,248,249,289,0,2019,'KPI S4.7','Node\\ncassr18\\Kpi','2019-01-17 14:31:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":4,\"kpi_id\":\"13\",\"kpi_info\":\"Proportion of graduates from undergraduate programs who within six months of graduation are: \\n(a) employed \\n(b) enrolled in further study \\n(c) not seeking employment or further study\",\"kpi_ref_num\":\"S4.7\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(417,409,250,251,289,0,2019,'List of Annexes for standard 4','Node\\ncassr18\\Annexes_List','2019-01-17 14:31:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":4}'),(418,385,254,263,289,0,2019,'Standard 5. Student Administration and Support Services','Node\\ncassr18\\Ssr_H_Standard_5','2019-01-17 14:31:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"overall_rating\":\"\",\"standard_description\":\"\",\"student_adminstration\":\"\",\"5_1\":\"\",\"5_2\":\"\",\"5_3\":\"\",\"5_4\":\"\",\"quality_mission\":\"\"}'),(419,418,255,256,289,0,2019,'KPI S5.1','Node\\ncassr18\\Kpi','2019-01-17 14:31:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":5,\"kpi_id\":\"14\",\"kpi_info\":\"Ratio of students to administrative staff.\",\"kpi_ref_num\":\"S5.1\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(420,418,257,258,289,0,2019,'KPI S5.2','Node\\ncassr18\\Kpi','2019-01-17 14:31:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":5,\"kpi_id\":\"15\",\"kpi_info\":\"Proportion of total operating funds (other than accommodation and student allowances) allocated to provision of student services.\",\"kpi_ref_num\":\"S5.2\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(421,418,259,260,289,0,2019,'KPI S5.3','Node\\ncassr18\\Kpi','2019-01-17 14:31:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":5,\"kpi_id\":\"16\",\"kpi_info\":\"Student evaluation of academic and career counselling. (Average rating on the adequacy of academic and career counselling on a five- point scale in an annual survey of final year students.)\",\"kpi_ref_num\":\"S5.3\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(422,418,261,262,289,0,2019,'List of Annexes for standard 5','Node\\ncassr18\\Annexes_List','2019-01-17 14:31:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":5}'),(423,385,264,273,289,0,2019,'Standard 6. Learning Resources','Node\\ncassr18\\Ssr_H_Standard_6','2019-01-17 14:31:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"overall_rating\":\"\",\"standard_description\":\"\",\"explanatory_report\":\"\",\"6_1\":\"\",\"6_2\":\"\",\"6_3\":\"\",\"6_4\":\"\",\"quality_mission\":\"\"}'),(424,423,265,266,289,0,2019,'KPI S6.1','Node\\ncassr18\\Kpi','2019-01-17 14:31:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":6,\"kpi_id\":\"17\",\"kpi_info\":\"Stakeholder evaluation of library and media center. (Average overall rating of the adequacy of the library & media center, including:\\n a) Staff assistance,\\nb) Current and up-to-date\\nc) Copy & print facilities,\\nd) Functionality of equipment,\\ne) Atmosphere or climate for studying\\nf) Availability of study sites, and\\ng) Any other quality indicators of service on a five- point scale of an annual survey.) .\",\"kpi_ref_num\":\"S6.1\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(425,423,267,268,289,0,2019,'KPI S6.2','Node\\ncassr18\\Kpi','2019-01-17 14:31:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":6,\"kpi_id\":\"18\",\"kpi_info\":\"Number of web site publication and journal subscriptions as a proportion of the number of programs offered.\",\"kpi_ref_num\":\"S6.2\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(426,423,269,270,289,0,2019,'KPI S6.3','Node\\ncassr18\\Kpi','2019-01-17 14:31:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":6,\"kpi_id\":\"19\",\"kpi_info\":\"Stakeholder evaluation of the digital library. (Average overall rating of the adequacy of the digital library, including: \\n a) User friendly website\\nb) Availability of the digital databases,\\nc) Accessibility for users,\\nd) Library skill training and\\ne) Any other quality indicators of service on a five- point scale of an annual survey.)\",\"kpi_ref_num\":\"S6.3\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(427,423,271,272,289,0,2019,'List of Annexes for standard 6','Node\\ncassr18\\Annexes_List','2019-01-17 14:31:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":6}'),(428,385,274,283,289,0,2019,'Standard 7. Facilities and Equipment','Node\\ncassr18\\Ssr_H_Standard_7','2019-01-17 14:31:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"overall_rating\":\"\",\"standard_description\":\"\",\"explanatory_report\":\"\",\"7_1\":\"\",\"7_2\":\"\",\"7_3\":\"\",\"7_4\":\"\",\"quality_mission\":\"\"}'),(429,428,275,276,289,0,2019,'KPI S7.1','Node\\ncassr18\\Kpi','2019-01-17 14:31:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":7,\"kpi_id\":\"20\",\"kpi_info\":\"Annual expenditure on IT budget, including: \\na) Percentage of the total Institution, or College, or Program budget allocated for IT; \\nb) Percentage of IT budget allocated per program for institutional or per student for programmatic; \\nc) Percentage of IT budget allocated for software licences; \\nd) Percentage of IT budget allocated for IT security; \\ne) Percentage of IT budge allocated for IT maintenance\",\"kpi_ref_num\":\"S7.1\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(430,428,277,278,289,0,2019,'KPI S7.2','Node\\ncassr18\\Kpi','2019-01-17 14:31:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":7,\"kpi_id\":\"21\",\"kpi_info\":\"Stakeholder evaluation of the IT services (Average overall rating of the adequacy of on a five- point scale of an annual survey). \\na) IT availability, \\nb) Website, \\nc) e-learning services \\nd) IT Security, \\ne) Maintenance (hardware & software), \\nf) Accessibility \\ng) Support systems, \\nh) Hardware, software & up-dates, and Web-based electronic data management system or electronic resources (for example: institutional website providing resource sharing, networking & relevant information, including e-learning, interactive learning & teaching between students & faculty).\",\"kpi_ref_num\":\"S7.2\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(431,428,279,280,289,0,2019,'KPI S7.3','Node\\ncassr18\\Kpi','2019-01-17 14:31:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":7,\"kpi_id\":\"22\",\"kpi_info\":\"Stakeholder evaluation of facilities & equipment: \\na) Classrooms, \\nb) Laboratories, \\nc) Bathrooms (cleanliness & maintenance), \\nd) Campus security, \\ne) Parking & access, \\nf) Safety (first aide, fire extinguishers & alarm systems, secure chemicals) \\ng) Access for those with disabilities or handicaps (ramps, lifts, bathroom furnishings), \\nh) Sporting facilities & equipment.\",\"kpi_ref_num\":\"S7.3\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(432,428,281,282,289,0,2019,'List of Annexes for standard 7','Node\\ncassr18\\Annexes_List','2019-01-17 14:31:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":7}'),(433,385,284,289,289,0,2019,'Standard 8. Financial Planning and Management','Node\\ncassr18\\Ssr_H_Standard_8','2019-01-17 14:31:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"overall_rating\":\"\",\"standard_description\":\"\",\"explanatory_report\":\"\",\"8_1\":\"\",\"8_2\":\"\",\"evaluation_report\":\"\"}'),(434,433,285,286,289,0,2019,'KPI S8.1','Node\\ncassr18\\Kpi','2019-01-17 14:31:38',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":8,\"kpi_id\":\"23\",\"kpi_info\":\"Total operating expenditure (other than accommodation and student allowances) per student.\",\"kpi_ref_num\":\"S8.1\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(435,433,287,288,289,0,2019,'List of Annexes for standard 8','Node\\ncassr18\\Annexes_List','2019-01-17 14:31:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":8}'),(436,385,290,297,289,0,2019,'Standard 9. Employment Processes','Node\\ncassr18\\Ssr_H_Standard_9','2019-01-17 14:31:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"overall_rating\":\"\",\"standard_description\":\"\",\"explanatory_report\":\"\",\"9_1\":\"\",\"9_2\":\"\",\"evaluation_report\":\"\"}'),(437,436,291,292,289,0,2019,'KPI S9.1','Node\\ncassr18\\Kpi','2019-01-17 14:31:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":9,\"kpi_id\":\"24\",\"kpi_info\":\"Proportion of teaching staff leaving the institution in the past year for reasons other than age retirement.\",\"kpi_ref_num\":\"S9.1\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(438,436,293,294,289,0,2019,'KPI S9.2','Node\\ncassr18\\Kpi','2019-01-17 14:31:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":9,\"kpi_id\":\"25\",\"kpi_info\":\"Proportion of teaching staff participating in professional development activities during the past year.\",\"kpi_ref_num\":\"S9.2\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(439,436,295,296,289,0,2019,'List of Annexes for standard 9','Node\\ncassr18\\Annexes_List','2019-01-17 14:31:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":9}'),(440,385,298,313,289,0,2019,'Standard 10. Research ','Node\\ncassr18\\Ssr_H_Standard_10','2019-01-17 14:31:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"overall_rating\":\"\",\"standard_description\":\"\",\"explanatory_report\":\"\",\"10_1\":\"\",\"10_2\":\"\",\"evaluation_report\":\"\",\"program_research_table\":[],\"research_approval\":\"\",\"strategic_plan\":\"\",\"policy_manual\":\"\"}'),(441,440,299,300,289,0,2019,'KPI S10.1','Node\\ncassr18\\Kpi','2019-01-17 14:31:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":10,\"kpi_id\":\"26\",\"kpi_info\":\"Number of refereed publications in the previous year per full time equivalent teaching staff. (Publications based on the formula in the Higher Council Bylaw excluding conference presentations)\",\"kpi_ref_num\":\"S10.1\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(442,440,301,302,289,0,2019,'KPI S10.2','Node\\ncassr18\\Kpi','2019-01-17 14:31:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":10,\"kpi_id\":\"27\",\"kpi_info\":\"Number of citations in refereed journals in the previous year per full time equivalent faculty members.\",\"kpi_ref_num\":\"S10.2\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(443,440,303,304,289,0,2019,'KPI S10.3','Node\\ncassr18\\Kpi','2019-01-17 14:31:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":10,\"kpi_id\":\"28\",\"kpi_info\":\"Proportion of full time member of teaching staff with at least one refereed publication during the previous year.\",\"kpi_ref_num\":\"S10.3\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(444,440,305,306,289,0,2019,'KPI S10.4','Node\\ncassr18\\Kpi','2019-01-17 14:31:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":10,\"kpi_id\":\"29\",\"kpi_info\":\"Number of papers or reports presented at academic conferences during the past year per full time equivalent faculty members.\",\"kpi_ref_num\":\"S10.4\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(445,440,307,308,289,0,2019,'KPI S10.5','Node\\ncassr18\\Kpi','2019-01-17 14:31:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":10,\"kpi_id\":\"30\",\"kpi_info\":\"Research income from external sources in the past year as a proportion of the number of full time faculty members.\",\"kpi_ref_num\":\"S10.5\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(446,440,309,310,289,0,2019,'KPI S10.6','Node\\ncassr18\\Kpi','2019-01-17 14:31:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":10,\"kpi_id\":\"31\",\"kpi_info\":\"Proportion of the total, annual operational budget dedicated to research.\",\"kpi_ref_num\":\"S10.6\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(447,440,311,312,289,0,2019,'List of Annexes for standard 10','Node\\ncassr18\\Annexes_List','2019-01-17 14:31:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":10}'),(448,385,314,321,289,0,2019,'Standard 11. Relationships with the Community','Node\\ncassr18\\Ssr_H_Standard_11','2019-01-17 14:31:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"overall_rating\":\"\",\"standard_description\":\"\",\"explanatory_report\":\"\",\"11_1\":\"\",\"11_2\":\"\",\"evaluation_report\":\"\"}'),(449,448,315,316,289,0,2019,'KPI S11.1','Node\\ncassr18\\Kpi','2019-01-17 14:31:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":11,\"kpi_id\":\"32\",\"kpi_info\":\"Proportion of full time teaching and other staff actively engaged in community service activities.\",\"kpi_ref_num\":\"S11.1\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(450,448,317,318,289,0,2019,'KPI S11.2','Node\\ncassr18\\Kpi','2019-01-17 14:31:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":11,\"kpi_id\":\"33\",\"kpi_info\":\"Number of community education programs provided as a proportion of the number of departments.\",\"kpi_ref_num\":\"S11.2\",\"actual\":\"\",\"target\":\"\",\"internal\":\"\",\"external\":\"\",\"new_target\":\"\"}'),(451,448,319,320,289,0,2019,'List of Annexes for standard 11','Node\\ncassr18\\Annexes_List','2019-01-17 14:31:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"standard\":11}'),(452,385,322,323,289,0,2019,'H. Review of Courses','Node\\ncassr18\\Ssr_H_Courses_Review','2019-01-17 14:31:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"processs\":\"\",\"course_evaluation\":[],\"conclusions\":\"\"}'),(453,377,325,326,289,0,2019,'I. Independent Evaluations','Node\\ncassr18\\Ssr_I','2019-01-17 14:31:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"independent_analysis\":\"\",\"response_report\":\"\",\"analysis_report\":\"\",\"evaluation_report\":\"\"}'),(454,377,327,328,289,0,2019,'J. Conclusions','Node\\ncassr18\\Ssr_J','2019-01-17 14:31:39',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"describtion_list\":\"\",\"improved_program\":\"\"}'),(455,377,329,330,289,0,2019,'K. Action Proposals','Node\\ncassr18\\Ssr_K','2019-01-17 14:31:40',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"course_required_list\":\"\",\"add_Recommendation\":[],\"kpi_assessment\":[],\"kpi_analysis\":\"\"}'),(456,377,331,332,289,0,2019,'Authorized Signatures','Node\\ncassr18\\Ssr_Signatures','2019-01-17 14:31:40',0,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','none','{\"authorized_signature\":[]}');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node_assessor`
--

LOCK TABLES `node_assessor` WRITE;
/*!40000 ALTER TABLE `node_assessor` DISABLE KEYS */;
INSERT INTO `node_assessor` VALUES (2,1,14),(3,1,10),(4,191,10),(5,191,11),(6,242,13),(7,241,10),(8,266,26),(9,265,11),(10,291,13),(11,290,10);
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
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node_log`
--

LOCK TABLES `node_log` WRITE;
/*!40000 ALTER TABLE `node_log` DISABLE KEYS */;
INSERT INTO `node_log` VALUES (17,1,'2019-01-12 19:33:25',18,11,0,1,2019,'7. Help Box Program Specifications (refer attachment 1)','Node\\ncai18\\Eligibility_Requirements_7','2019-01-12 19:16:38',0,1,'0000-00-00 00:00:00','none','{\"attachment\":\"\",\"comment\":\"\"}'),(19,1,'2019-01-12 19:44:35',192,191,0,191,2019,'BACKGROUND INFORMATION','Node\\abet_etac\\Background_Info','2019-01-12 19:43:43',0,1,'0000-00-00 00:00:00','none','{\"contact_info\":[{\"name\":\"\",\"email_address\":\"\",\"telephone\":\"\",\"fax_number\":\"\",\"email\":\"\"}],\"program_history_feilds\":\"\",\"options_list\":\"\",\"program_delivery_modes\":\"\",\"program_locations\":\"\",\"public_disclosure_provider\":\"\",\"weakness\":\"\"}'),(20,1,'2019-01-13 14:53:40',193,191,0,191,2019,'CRITERION 1. STUDENTS','Node\\abet_etac\\Criterion_1','2019-01-12 19:43:43',0,1,'0000-00-00 00:00:00','none','{\"student_admission\":\"<p>sfgddsfdsfdsfsd fdsf gfd dfgdf df dfgdfgfdgfdg<\\/p>\",\"student_evaluation\":\"<p>dsfdsfsgdgwgfdsgfdsgsdfg<\\/p>\",\"student_and_course\":\"<p>dsfgsdfghffdshgwehgfdwhsdfh<\\/p>\",\"advising_and_career\":\"<p>sfdgdfgsdfgdfsghgfdhgfbsdfhytju<\\/p>\",\"work_in_lieu\":\"<p>fklsdp;kgfd;lghkfdsl;kgfhlk;gfhlg<\\/p>\",\"graduation_requirements\":\"<p>gfdgmfdl;kgj;plfdk;vgbkdg<\\/p>\",\"recent_graduates\":\"<p>sdfdsfsdjfc m,;fdj;f,l;fdsfsdf<\\/p>\"}'),(21,1,'2019-01-13 14:56:23',194,191,0,191,2019,'CRITERION 2. PROGRAM EDUCATIONAL OBJECTIVES','Node\\abet_etac\\Criterion_2','2019-01-12 19:43:43',0,1,'0000-00-00 00:00:00','none','{\"mission_statement\":\"<p>sadhjkfanhjf nhjc hjklf<\\/p>\",\"program_educational_objective\":\"<p>fdsafjnhfc\\u00a0 \\u00a0 \\u00a0 \\u00a0 \\u00a0 \\u00a0nhskklg;jlgk;aq<\\/p>\",\"program_consistance_mission\":\"<p>sdffdsfdsfdgfdsgsdg<\\/p>\",\"program_constituencies_list\":\"<p>fdghfgjhgjytejtjtjytjyt<\\/p>\",\"review_process\":\"<p>fdhdgfh gfhb vfghvfghvdfgh<\\/p>\"}'),(22,1,'2019-01-13 14:56:40',195,191,0,191,2019,'CRITERION 3.  STUDENT OUTCOMES','Node\\abet_etac\\Criterion_3','2019-01-12 19:43:43',0,1,'0000-00-00 00:00:00','none','{\"student_ourcones_revision\":\"\",\"student_outcomes_list\":\"\",\"educational_objective\":\"\"}'),(23,1,'2019-01-13 14:56:52',196,191,0,191,2019,'CRITERION 4. CONTINUOUS IMPROVEMENT','Node\\abet_etac\\Criterion_4','2019-01-12 19:43:43',0,1,'0000-00-00 00:00:00','none','{\"student_outcomes_table\":{\"1\":{\"2\":{\"student_outcome\":\"\"}},\"2\":{\"2\":{\"student_outcome\":\"\"}},\"3\":{\"2\":{\"student_outcome\":\"\"}},\"4\":{\"2\":{\"student_outcome\":\"\"}},\"5\":{\"2\":{\"student_outcome\":\"\"}}},\"continuous_improvement\":\"\",\"additional_info\":\"\"}'),(24,1,'2019-01-13 14:57:02',197,191,0,191,2019,'CRITERION 5. CURRICULUM','Node\\abet_etac\\Criterion_5','2019-01-12 19:43:43',0,1,'0000-00-00 00:00:00','none','{\"program_name\":\"Computer Science Program\",\"curriculum_table\":[{\"course\":\"\",\"indicate\":\"\",\"math\":\"\",\"topics\":\"\",\"education\":\"\",\"other\":\"\",\"course_term\":\"\",\"average_section\":\"\"}],\"curriculum_table_percent\":\"\",\"curriculum_table_overall\":{\"3\":{\"1\":{\"overall\":\"0\"},\"2\":{\"overall\":\"0\"},\"3\":{\"overall\":\"0\"},\"4\":{\"overall\":\"0\"}}},\"curriculum_aligns\":\"\",\"prerequisite\":\"\",\"worksheet\":\"\",\"specific_requirements\":\"\",\"culminating_experience\":\"\",\"curricular_requirements\":\"\",\"example\":\"\",\"syllabi\":\"\",\"advisory_committee\":\"\"}'),(25,1,'2019-01-13 14:57:09',198,191,0,191,2019,'CRITERION 6. FACULTY','Node\\abet_etac\\Criterion_6','2019-01-12 19:43:44',0,1,'0000-00-00 00:00:00','none','{\"program_name\":\"Computer Science Program\",\"faculty_qualifications\":[{\"name\":\"\",\"degree\":\"\",\"rank\":\"\",\"academin_appointment\":\"\",\"practice\":\"\",\"teaching\":\"\",\"institution\":\"\",\"registration\":\"\",\"professional\":\"\",\"professional_development\":\"\",\"summer\":\"\"}],\"faculty_vitae\":\"\",\"program_name_for_faculty\":\"Computer Science Program\",\"summary\":[{\"name\":\"\",\"classes\":\"\",\"teaching\":\"\",\"research\":\"\",\"other\":\"\",\"percent\":\"0\"}],\"faculty_size_discussion\":\"\",\"professional_development_details\":\"\",\"authority_faculty\":\"\"}'),(26,1,'2019-01-13 14:57:17',199,191,0,191,2019,'CRITERION 7. FACILITIES','Node\\abet_etac\\Criterion_7','2019-01-12 19:43:44',0,1,'0000-00-00 00:00:00','none','{\"office\":\"\",\"classroom\":\"\",\"laboratory\":\"\",\"computing_resources\":\"\",\"guidance_discribtion\":\"\",\"maintenance_facilities\":\"\",\"library_services_discribtion\":\"\",\"overall_comment\":\"\"}'),(27,1,'2019-01-13 14:57:23',200,191,0,191,2019,'CRITERION 8.  INSTITUTIONAL SUPPORT','Node\\abet_etac\\Criterion_8','2019-01-12 19:43:44',0,1,'0000-00-00 00:00:00','none','{\"leadership\":\"\",\"process\":\"\",\"teaching\":\"\",\"resources\":\"\",\"sections\":\"\",\"staffing_describtion\":\"\",\"faculty_hiring_process\":\"\",\"faculty_hiring_qualified\":\"\",\"supports\":\"\"}'),(28,1,'2019-01-13 14:57:29',201,191,0,191,2019,'PROGRAM CRITERIA','Node\\abet_etac\\Program_Criteria','2019-01-12 19:43:44',0,1,'0000-00-00 00:00:00','none','{\"list\":\"\",\"attchment\":\"\"}'),(29,1,'2019-01-13 14:57:35',202,191,0,191,2019,'Appendix A – Course Syllabi','Node\\abet_etac\\Appendix_A','2019-01-12 19:43:44',0,1,'0000-00-00 00:00:00','none','{\"syllabi_text\":\"\",\"syllabi\":\"\"}'),(30,1,'2019-01-13 14:57:39',203,191,0,191,2019,'Appendix B – Faculty Vitae','Node\\abet_etac\\Appendix_B','2019-01-12 19:43:44',0,1,'0000-00-00 00:00:00','none','{\"faculty_vitae_text\":\"\",\"faculty_vitae\":\"\"}'),(31,1,'2019-01-13 14:57:43',204,191,0,191,2019,'Appendix C – Equipment','Node\\abet_etac\\Appendix_C','2019-01-12 19:43:44',0,1,'0000-00-00 00:00:00','none','{\"majors\":\"\"}'),(32,1,'2019-01-13 14:57:54',205,191,0,191,2019,'Appendix D – Institutional Summary','Node\\abet_etac\\Appendix_D','2019-01-12 19:43:44',0,1,'0000-00-00 00:00:00','none','{\"institution_name\":\"Jadeer\",\"institution_address\":\"\",\"chief_name\":\"\",\"self_study_report\":\"\",\"organizations\":\"\",\"type_of_control_description\":\"\",\"educational_unit_description\":\"\",\"academic_support_units\":\"\",\"nonacademic_support_units\":\"\",\"credit_unit_description\":\"\",\"program\":\"Computer Science Program\",\"program_enrollment\":{\"3\":{\"2\":{\"academic_year\":\"\"},\"4\":{\"first_year\":\"\"},\"5\":{\"second_year\":\"\"},\"6\":{\"third_year\":\"\"},\"7\":{\"fourth_year\":\"\"},\"8\":{\"fifth_year\":\"\"},\"9\":{\"under_graduate\":\"\"},\"10\":{\"total_grad\":\"\"},\"11\":{\"associates_awarded\":\"\"},\"12\":{\"bachelors_awarded\":\"\"},\"13\":{\"master_awarded\":\"\"},\"14\":{\"doctorates_awarded\":\"\"}},\"4\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"},\"7\":{\"under_graduate\":\"\"},\"8\":{\"total_grad\":\"\"},\"9\":{\"associates_awarded\":\"\"},\"10\":{\"bachelors_awarded\":\"\"},\"11\":{\"master_awarded\":\"\"},\"12\":{\"doctorates_awarded\":\"\"}},\"5\":{\"2\":{\"academic_year\":\"\"},\"4\":{\"first_year\":\"\"},\"5\":{\"second_year\":\"\"},\"6\":{\"third_year\":\"\"},\"7\":{\"fourth_year\":\"\"},\"8\":{\"fifth_year\":\"\"},\"9\":{\"under_graduate\":\"\"},\"10\":{\"total_grad\":\"\"},\"11\":{\"associates_awarded\":\"\"},\"12\":{\"bachelors_awarded\":\"\"},\"13\":{\"master_awarded\":\"\"},\"14\":{\"doctorates_awarded\":\"\"}},\"6\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"},\"7\":{\"under_graduate\":\"\"},\"8\":{\"total_grad\":\"\"},\"9\":{\"associates_awarded\":\"\"},\"10\":{\"bachelors_awarded\":\"\"},\"11\":{\"master_awarded\":\"\"},\"12\":{\"doctorates_awarded\":\"\"}},\"7\":{\"2\":{\"academic_year\":\"\"},\"4\":{\"first_year\":\"\"},\"5\":{\"second_year\":\"\"},\"6\":{\"third_year\":\"\"},\"7\":{\"fourth_year\":\"\"},\"8\":{\"fifth_year\":\"\"},\"9\":{\"under_graduate\":\"\"},\"10\":{\"total_grad\":\"\"},\"11\":{\"associates_awarded\":\"\"},\"12\":{\"bachelors_awarded\":\"\"},\"13\":{\"master_awarded\":\"\"},\"14\":{\"doctorates_awarded\":\"\"}},\"8\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"},\"7\":{\"under_graduate\":\"\"},\"8\":{\"total_grad\":\"\"},\"9\":{\"associates_awarded\":\"\"},\"10\":{\"bachelors_awarded\":\"\"},\"11\":{\"master_awarded\":\"\"},\"12\":{\"doctorates_awarded\":\"\"}},\"9\":{\"2\":{\"academic_year\":\"\"},\"4\":{\"first_year\":\"\"},\"5\":{\"second_year\":\"\"},\"6\":{\"third_year\":\"\"},\"7\":{\"fourth_year\":\"\"},\"8\":{\"fifth_year\":\"\"},\"9\":{\"under_graduate\":\"\"},\"10\":{\"total_grad\":\"\"},\"11\":{\"associates_awarded\":\"\"},\"12\":{\"bachelors_awarded\":\"\"},\"13\":{\"master_awarded\":\"\"},\"14\":{\"doctorates_awarded\":\"\"}},\"10\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"},\"7\":{\"under_graduate\":\"\"},\"8\":{\"total_grad\":\"\"},\"9\":{\"associates_awarded\":\"\"},\"10\":{\"bachelors_awarded\":\"\"},\"11\":{\"master_awarded\":\"\"},\"12\":{\"doctorates_awarded\":\"\"}},\"11\":{\"2\":{\"academic_year\":\"\"},\"4\":{\"first_year\":\"\"},\"5\":{\"second_year\":\"\"},\"6\":{\"third_year\":\"\"},\"7\":{\"fourth_year\":\"\"},\"8\":{\"fifth_year\":\"\"},\"9\":{\"under_graduate\":\"\"},\"10\":{\"total_grad\":\"\"},\"11\":{\"associates_awarded\":\"\"},\"12\":{\"bachelors_awarded\":\"\"},\"13\":{\"master_awarded\":\"\"},\"14\":{\"doctorates_awarded\":\"\"}},\"12\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"},\"7\":{\"under_graduate\":\"\"},\"8\":{\"total_grad\":\"\"},\"9\":{\"associates_awarded\":\"\"},\"10\":{\"bachelors_awarded\":\"\"},\"11\":{\"master_awarded\":\"\"},\"12\":{\"doctorates_awarded\":\"\"}}},\"program_name\":\"Computer Science Program\",\"new_year\":\"2019\",\"presonnel\":{\"3\":{\"2\":{\"fulltime\":\"\"},\"3\":{\"parttime\":\"\"},\"4\":{\"fte\":\"\"}},\"4\":{\"2\":{\"fulltime\":\"\"},\"3\":{\"parttime\":\"\"},\"4\":{\"fte\":\"\"}},\"5\":{\"2\":{\"fulltime\":\"\"},\"3\":{\"parttime\":\"\"},\"4\":{\"fte\":\"\"}},\"6\":{\"2\":{\"fulltime\":\"\"},\"3\":{\"parttime\":\"\"},\"4\":{\"fte\":\"\"}},\"7\":{\"2\":{\"fulltime\":\"\"},\"3\":{\"parttime\":\"\"},\"4\":{\"fte\":\"\"}},\"8\":{\"2\":{\"fulltime\":\"\"},\"3\":{\"parttime\":\"\"},\"4\":{\"fte\":\"\"}},\"9\":{\"2\":{\"fulltime\":\"\"},\"3\":{\"parttime\":\"\"},\"4\":{\"fte\":\"\"}}}}'),(33,10,'2019-01-13 15:07:30',192,191,0,191,2019,'BACKGROUND INFORMATION','Node\\abet_etac\\Background_Info','2019-01-12 19:43:43',0,1,'0000-00-00 00:00:00','not_compliant','{\"contact_info\":[{\"name\":\"\",\"email_address\":\"\",\"telephone\":\"\",\"fax_number\":\"\",\"email\":\"\"}],\"program_history_feilds\":\"<p>fdwfrwwrwer<\\/p>\",\"options_list\":\"\",\"program_delivery_modes\":\"\",\"program_locations\":\"\",\"public_disclosure_provider\":\"\",\"weakness\":\"\"}'),(34,10,'2019-01-13 15:07:32',192,191,0,191,2019,'BACKGROUND INFORMATION','Node\\abet_etac\\Background_Info','2019-01-12 19:43:43',0,1,'0000-00-00 00:00:00','not_compliant','{\"contact_info\":[{\"name\":\"\",\"email_address\":\"\",\"telephone\":\"\",\"fax_number\":\"\",\"email\":\"\"}],\"program_history_feilds\":\"<p>fdwfrwwrwer<\\/p>\",\"options_list\":\"\",\"program_delivery_modes\":\"\",\"program_locations\":\"\",\"public_disclosure_provider\":\"\",\"weakness\":\"\"}'),(35,10,'2019-01-13 15:07:41',193,191,0,191,2019,'CRITERION 1. STUDENTS','Node\\abet_etac\\Criterion_1','2019-01-12 19:43:43',0,1,'0000-00-00 00:00:00','none','{\"student_admission\":\"<p>sfgddsfdsfdsfsd fdsf gfd dfgdf df dfgdfgfdgfdgfrrwertweqrewqr<\\/p>\",\"student_evaluation\":\"<p>dsfdsfsgdgwgfdsgfdsgsdfg<\\/p>\",\"student_and_course\":\"<p>dsfgsdfghffdshgwehgfdwhsdfh<\\/p>\",\"advising_and_career\":\"<p>sfdgdfgsdfgdfsghgfdhgfbsdfhytju<\\/p>\",\"work_in_lieu\":\"<p>fklsdp;kgfd;lghkfdsl;kgfhlk;gfhlg<\\/p>\",\"graduation_requirements\":\"<p>gfdgmfdl;kgj;plfdk;vgbkdg<\\/p>\",\"recent_graduates\":\"<p>sdfdsfsdjfc m,;fdj;f,l;fdsfsdf<\\/p>\"}'),(36,10,'2019-01-13 15:09:48',193,191,0,191,2019,'CRITERION 1. STUDENTS','Node\\abet_etac\\Criterion_1','2019-01-12 19:43:43',0,1,'0000-00-00 00:00:00','none','{\"student_admission\":\"<p>sfgddsfdsfdsfsd fdsf gfd dfgdf df dfgdfgfdgfdgfrrwertweqrewqr<\\/p>\",\"student_evaluation\":\"<p>dsfdsfsgdgwgfdsgfdsgsdfg<\\/p>\",\"student_and_course\":\"<p>dsfgsdfghffdshgwehgfdwhsdfh<\\/p>\",\"advising_and_career\":\"<p>sfdgdfgsdfgdfsghgfdhgfbsdfhytju<\\/p>\",\"work_in_lieu\":\"<p>fklsdp;kgfd;lghkfdsl;kgfhlk;gfhlg<\\/p>\",\"graduation_requirements\":\"<p>gfdgmfdl;kgj;plfdk;vgbkdg<\\/p>\",\"recent_graduates\":\"<p>sdfdsfsdjfc m,;fdj;f,l;fdsfsdffsdfsdfdsf<\\/p>\"}'),(37,1,'2019-01-13 16:01:42',240,0,1,240,2019,'Program Specifications and Reports V.2015','Node\\ncapm14\\Root','2019-01-13 15:59:49',0,0,'2019-01-31 23:59:59','none','[]'),(38,1,'2019-01-13 16:10:50',244,243,0,240,2019,'A. Program Identification and General Information','Node\\ncapm14\\Program_Specifications_A','2019-01-13 16:05:24',0,1,'0000-00-00 00:00:00','none','{\"program_title\":\"Computer Science Program\",\"program_code\":\"\",\"total_credit_hour\":\"0\",\"program_completion\":\"\",\"tracks_and_pathway\":\"\",\"exit_point\":\"\",\"professional_occupations\":\"\",\"planned_starting_date\":\"\",\"program_review\":\"\",\"note\":\"\",\"accreditation_review\":\"\",\"other\":\"\",\"program_coordinator\":\"\",\"approval_date\":[{\"campus_branch_location\":\"\",\"approval_by\":\"\",\"date\":\"\"}]}'),(39,1,'2019-01-13 16:10:58',245,243,0,240,2019,'B. Program Context','Node\\ncapm14\\Program_Specifications_B','2019-01-13 16:05:24',0,1,'0000-00-00 00:00:00','none','{\"economic_reasons\":\"\",\"program_mission\":\"\",\"courses_meet_student\":\"\",\"courses_meet_department_student\":\"\",\"modifications_and_services\":\"\",\"program_courses\":\"\",\"program_require_students\":\"\",\"students_characteristics\":\"\"}'),(40,1,'2019-01-13 16:11:17',246,243,0,240,2019,'C. Mission, Goals and Objectives','Node\\ncapm14\\Program_Specifications_C','2019-01-13 16:05:24',0,1,'0000-00-00 00:00:00','none','{\"program_missions\":\"\",\"list_of_goals\":\"\",\"goals_and_objective\":[{\"objectives\":\"\",\"measurable_indicators\":\"\",\"major_strategies\":\"\"}]}'),(41,1,'2019-01-13 16:11:26',255,254,0,240,2019,'A. Program Identification and General Information','Node\\ncapm14\\Annual_A','2019-01-13 16:05:25',0,1,'0000-00-00 00:00:00','none','{\"program_title\":\"Computer Science Program\",\"program_code\":\"\",\"name_and_position\":\"\",\"academic_year\":\"2019\"}'),(42,1,'2019-01-13 16:11:34',256,254,0,240,2019,'B. Statistical Information','Node\\ncapm14\\Annual_B','2019-01-13 16:05:25',0,1,'0000-00-00 00:00:00','none','{\"num_of_students_started_program\":\"\",\"info\":\"\",\"major_tracks\":[{\"title\":\"\",\"no\":\"\"}],\"early_exit_point\":\"\",\"percentage_students_completed\":\"0\",\"percentage_students_completed_intermediate\":\"0\",\"comment\":\"\",\"cohort_a\":{\"2\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"},\"7\":{\"sixth_year\":\"\"}},\"3\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"},\"7\":{\"sixth_year\":\"\"}},\"4\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"},\"7\":{\"sixth_year\":\"\"}},\"5\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"},\"7\":{\"sixth_year\":\"\"}},\"6\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"},\"7\":{\"sixth_year\":\"\"}}},\"cohort_b\":{\"2\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"}},\"3\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"}},\"4\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"}},\"5\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"}},\"6\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"},\"6\":{\"fifth_year\":\"\"}}},\"cohort_c\":{\"2\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"}},\"3\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"}},\"4\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"}},\"5\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"}},\"6\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"},\"5\":{\"fourth_year\":\"\"}}},\"cohort_d\":{\"2\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"}},\"3\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"}},\"4\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"}},\"5\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"}},\"6\":{\"2\":{\"first_year\":\"\"},\"3\":{\"second_year\":\"\"},\"4\":{\"third_year\":\"\"}}},\"date_of_survey\":\"\",\"number_surveyed\":\"\",\"number_responded\":\"\",\"response_rate\":\"0\",\"destination_of_graduates\":{\"3\":{\"2\":{\"number\":\"\"},\"3\":{\"number\":\"\"},\"4\":{\"number\":\"\"},\"5\":{\"number\":\"\"},\"6\":{\"number\":\"\"}},\"4\":{\"2\":{\"percents\":\"0\"},\"3\":{\"percents\":\"0\"},\"4\":{\"percents\":\"0\"},\"5\":{\"percents\":\"0\"},\"6\":{\"percents\":\"0\"}}},\"list_strengths\":\"\"}'),(43,20,'2019-01-13 16:17:52',244,243,0,240,2019,'A. Program Identification and General Information','Node\\ncapm14\\Program_Specifications_A','2019-01-13 16:05:24',0,1,'0000-00-00 00:00:00','none','{\"program_title\":\"Computer Science Program\",\"program_code\":\"\",\"total_credit_hour\":\"0\",\"program_completion\":\"\",\"tracks_and_pathway\":\"\",\"exit_point\":\"\",\"professional_occupations\":\"\",\"new_program\":\"Yes\",\"planned_starting_date\":\"\",\"program_review\":\"\",\"note\":\"\",\"accreditation_review\":\"\",\"other\":\"\",\"program_coordinator\":\"\",\"approval_date\":[{\"campus_branch_location\":\"\",\"approval_by\":\"\",\"date\":\"\"}]}'),(44,22,'2019-01-13 16:21:23',267,266,0,240,2019,'Program Specifications (PS)','Node\\ncapm14\\Program_Specifications','2019-01-13 16:20:18',0,1,'0000-00-00 00:00:00','none','{\"institution\":\"Jadeer\",\"date_of_report\":\"2019-01-13\",\"college\":\"prince ghazi college for information technology\",\"department\":\"Information Technology Department\",\"dean\":\"\",\"program_flowchart\":\"\",\"branches\":[{\"branch\":\"\"}]}'),(45,22,'2019-01-13 16:21:39',268,267,0,240,2019,'A. Program Identification and General Information','Node\\ncapm14\\Program_Specifications_A','2019-01-13 16:20:18',0,1,'0000-00-00 00:00:00','none','{\"program_title\":\"Computer Information system\",\"program_code\":\"\",\"total_credit_hour\":\"0\",\"program_completion\":\"\",\"tracks_and_pathway\":\"\",\"exit_point\":\"\",\"professional_occupations\":\"\",\"planned_starting_date\":\"\",\"program_review\":\"\",\"note\":\"\",\"accreditation_review\":\"\",\"other\":\"\",\"program_coordinator\":\"\",\"approval_date\":[{\"campus_branch_location\":\"\",\"approval_by\":\"\",\"date\":\"\"}]}'),(46,22,'2019-01-13 16:21:47',269,267,0,240,2019,'B. Program Context','Node\\ncapm14\\Program_Specifications_B','2019-01-13 16:20:18',0,1,'0000-00-00 00:00:00','none','{\"economic_reasons\":\"\",\"program_mission\":\"\",\"courses_meet_student\":\"\",\"courses_meet_department_student\":\"\",\"modifications_and_services\":\"\",\"program_courses\":\"\",\"program_require_students\":\"\",\"students_characteristics\":\"\"}'),(47,22,'2019-01-13 16:21:52',270,267,0,240,2019,'C. Mission, Goals and Objectives','Node\\ncapm14\\Program_Specifications_C','2019-01-13 16:20:18',0,1,'0000-00-00 00:00:00','none','{\"program_missions\":\"\",\"list_of_goals\":\"\",\"goals_and_objective\":[{\"objectives\":\"\",\"measurable_indicators\":\"\",\"major_strategies\":\"\"}]}'),(48,22,'2019-01-13 16:22:00',271,267,0,240,2019,'D. Program Structure and Organization','Node\\ncapm14\\Program_Specifications_D','2019-01-13 16:20:18',0,1,'0000-00-00 00:00:00','none','{\"curriculum_study_plan_levels\":[{\"level\":\"\",\"curriculum_study_plan\":[{\"course_code\":\"\",\"course_title\":\"\",\"prerequired_or_elective\":\"\",\"credit_houre\":\"\",\"college_or_department\":\"\"}]}],\"experience_activity\":\"\",\"field_experience\":\"\",\"time_allocation\":\"\",\"credit_hours_2\":\"\",\"project_summery\":\"\",\"a_description\":\"\",\"major_learning_outcomes\":\"\",\"stages\":\"\",\"credit_hours_3\":\"\",\"academic_advising\":\"\",\"assessment_procedures\":\"\",\"national_qualification\":{\"2\":{\"1\":{\"national_qualifications\":[{\"code\":\"\",\"learning_outcome\":\"\",\"teaching_strategies\":\"\",\"assessment_methods\":\"\"}]}},\"4\":{\"1\":{\"national_qualifications\":[{\"code\":\"\",\"learning_outcome\":\"\",\"teaching_strategies\":\"\",\"assessment_methods\":\"\"}]}},\"6\":{\"1\":{\"national_qualifications\":[{\"code\":\"\",\"learning_outcome\":\"\",\"teaching_strategies\":\"\",\"assessment_methods\":\"\"}]}},\"8\":{\"1\":{\"national_qualifications\":[{\"code\":\"\",\"learning_outcome\":\"\",\"teaching_strategies\":\"\",\"assessment_methods\":\"\"}]}},\"10\":{\"1\":{\"national_qualifications\":[{\"code\":\"\",\"learning_outcome\":\"\",\"teaching_strategies\":\"\",\"assessment_methods\":\"\"}]}}},\"program_outcomes_knowledge\":[{\"learning_outcomes\":\"\",\"course_levels\":[{\"course_code\":\"\",\"level\":\"I\"}]}],\"program_outcomes_cognitive_skills\":[{\"learning_outcomes\":\"\",\"course_levels\":[{\"course_code\":\"\",\"level\":\"I\"}]}],\"program_outcomes_interpersonal_skills\":[{\"learning_outcomes\":\"\",\"course_levels\":[{\"course_code\":\"\",\"level\":\"I\"}]}],\"program_outcomes_communication\":[{\"learning_outcomes\":\"\",\"course_levels\":[{\"course_code\":\"\",\"level\":\"I\"}]}],\"program_outcomes_psychomotor\":[{\"learning_outcomes\":\"\",\"course_levels\":[{\"course_code\":\"\",\"level\":\"I\"}]}],\"handbook\":\"\",\"handbooks\":\"\"}'),(49,22,'2019-01-13 16:22:06',272,267,0,240,2019,'E. Regulations for Student Assessment and Verification of Standards','Node\\ncapm14\\Program_Specifications_E','2019-01-13 16:20:18',0,1,'0000-00-00 00:00:00','none','{\"processes\":\"\"}'),(50,11,'2019-01-13 16:23:35',267,266,0,240,2019,'Program Specifications (PS)','Node\\ncapm14\\Program_Specifications','2019-01-13 16:20:18',0,1,'0000-00-00 00:00:00','none','{\"institution\":\"Jadeer\",\"date_of_report\":\"2019-01-13\",\"college\":\"prince ghazi college for information technology\",\"department\":\"Information Technology Department\",\"dean\":\"\",\"program_flowchart\":\"<p>asdasdasd<\\/p>\",\"branches\":[{\"branch\":\"\"}]}'),(51,11,'2019-01-13 16:23:53',278,266,0,240,2019,'Annual Program Report (APR)','Node\\ncapm14\\Annual','2019-01-13 16:20:18',0,1,'0000-00-00 00:00:00','none','{\"institution\":\"Jadeer\",\"date_of_report\":\"2019-01-13\",\"college\":\"prince ghazi college for information technology\",\"department\":\"Information Technology Department\",\"dean\":\"\",\"branches\":[{\"campus_branch_location\":\"\",\"approval_by\":\"\",\"date\":\"\"}]}'),(52,1,'2019-01-17 14:28:12',289,0,1,289,2019,'Self Study Reports V.2018','Node\\ncassr18\\Root','2019-01-17 14:28:05',0,0,'2019-01-25 23:59:59','none','[]');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node_review`
--

LOCK TABLES `node_review` WRITE;
/*!40000 ALTER TABLE `node_review` DISABLE KEYS */;
INSERT INTO `node_review` VALUES (1,3,18,'2019-01-12 19:35:03','compliant',''),(2,4,18,'2019-01-12 19:35:21','compliant',''),(3,5,18,'2019-01-12 19:35:35','partly_compliant',''),(4,6,18,'2019-01-12 19:38:27','not_compliant',''),(5,7,18,'2019-01-12 19:40:35','not_compliant',''),(6,7,18,'2019-01-12 19:40:50','not_compliant',''),(7,9,18,'2019-01-12 19:40:59','not_compliant',''),(8,10,18,'2019-01-12 19:41:07','partly_compliant',''),(9,192,10,'2019-01-13 15:05:34','not_compliant',''),(10,194,10,'2019-01-13 15:07:52','compliant',''),(11,267,11,'2019-01-13 16:23:42','compliant',''),(12,278,11,'2019-01-13 16:24:00','compliant','');
/*!40000 ALTER TABLE `node_review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `node_review_comments`
--

DROP TABLE IF EXISTS `node_review_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `node_review_comments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `review_id` bigint(20) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node_review_comments`
--

LOCK TABLES `node_review_comments` WRITE;
/*!40000 ALTER TABLE `node_review_comments` DISABLE KEYS */;
INSERT INTO `node_review_comments` VALUES (1,1,'goood'),(2,2,''),(3,3,'no9 no9'),(4,4,'sadasd'),(5,5,''),(6,6,''),(7,7,''),(8,8,''),(9,9,''),(10,10,''),(11,11,''),(12,12,'');
/*!40000 ALTER TABLE `node_review_comments` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node_reviewer`
--

LOCK TABLES `node_reviewer` WRITE;
/*!40000 ALTER TABLE `node_reviewer` DISABLE KEYS */;
INSERT INTO `node_reviewer` VALUES (1,1,18),(2,1,19),(3,191,15),(5,191,11),(6,242,20),(7,242,22),(8,266,14),(9,266,11);
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
) ENGINE=InnoDB AUTO_INCREMENT=192 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` VALUES (1,20,18,'New Assessor Added','<p>reviewer cs, A new assessor has been successfully added to the Institutional Forms V.2018 node.</p>',1,'2019-01-12 19:17:39',1),(2,20,14,'New Assessor Added','<p>civil engineer program coordinator, A new assessor has been successfully added to the Institutional Forms V.2018 node.</p>',1,'2019-01-12 19:17:54',1),(3,20,10,'New Assessor Added','<p>Computer Scince College Coordinator, A new assessor has been successfully added to the Institutional Forms V.2018 node.</p>',0,'2019-01-12 19:18:00',1),(4,20,18,'New Assessor Added','<p>reviewer cs, A new assessor has been successfully added to the Institutional Forms V.2018 node.</p>',1,'2019-01-12 19:18:06',1),(5,20,19,'New Assessor Added','<p>reviewr cicil engineer, A new assessor has been successfully added to the Institutional Forms V.2018 node.</p>',0,'2019-01-12 19:18:19',1),(6,20,18,'Assessor has Completed the Forms','<p>The assigned assessor has completed forms for the&nbsp;Institutional Profile node.</p>',1,'2019-01-12 19:25:37',1),(7,20,19,'Assessor has Completed the Forms','<p>The assigned assessor has completed forms for the&nbsp;Institutional Profile node.</p>',0,'2019-01-12 19:25:37',1),(8,18,10,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Table1. Institutional Performance Indicators node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-12 19:35:04',1),(9,18,11,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Table1. Institutional Performance Indicators node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-12 19:35:04',1),(10,18,12,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Table1. Institutional Performance Indicators node have been reviewed and accepted to compliant to standards.</p>',1,'2019-01-12 19:35:04',1),(11,18,13,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Table1. Institutional Performance Indicators node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-12 19:35:04',1),(12,18,14,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Table1. Institutional Performance Indicators node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-12 19:35:04',1),(13,18,24,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Table1. Institutional Performance Indicators node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-12 19:35:04',1),(14,18,25,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Table1. Institutional Performance Indicators node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-12 19:35:04',1),(15,18,26,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Table1. Institutional Performance Indicators node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-12 19:35:04',1),(16,18,27,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Table1. Institutional Performance Indicators node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-12 19:35:04',1),(17,18,10,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Table 2. Preparatory or Foundation Program node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-12 19:35:21',1),(18,18,11,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Table 2. Preparatory or Foundation Program node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-12 19:35:21',1),(19,18,12,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Table 2. Preparatory or Foundation Program node have been reviewed and accepted to compliant to standards.</p>',1,'2019-01-12 19:35:21',1),(20,18,13,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Table 2. Preparatory or Foundation Program node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-12 19:35:21',1),(21,18,14,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Table 2. Preparatory or Foundation Program node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-12 19:35:21',1),(22,18,24,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Table 2. Preparatory or Foundation Program node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-12 19:35:21',1),(23,18,25,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Table 2. Preparatory or Foundation Program node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-12 19:35:21',1),(24,18,26,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Table 2. Preparatory or Foundation Program node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-12 19:35:21',1),(25,18,27,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Table 2. Preparatory or Foundation Program node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-12 19:35:21',1),(26,18,14,'Form(s) have been Rejected','<p>The set of forms in the&nbsp;Table 3. Program Data node have been reviewed and rejected so please resubmit the forms accordingly with standards.</p>',0,'2019-01-12 19:35:35',1),(27,18,10,'Form(s) have been Rejected','<p>The set of forms in the&nbsp;Table 3. Program Data node have been reviewed and rejected so please resubmit the forms accordingly with standards.</p>',0,'2019-01-12 19:35:35',1),(28,18,14,'Form(s) have been Rejected','<p>The set of forms in the&nbsp;Table 4. Summary of Programs\' Teaching Staff node have been reviewed and rejected so please resubmit the forms accordingly with standards.</p>',0,'2019-01-12 19:38:27',1),(29,18,10,'Form(s) have been Rejected','<p>The set of forms in the&nbsp;Table 4. Summary of Programs\' Teaching Staff node have been reviewed and rejected so please resubmit the forms accordingly with standards.</p>',0,'2019-01-12 19:38:27',1),(30,18,14,'Form(s) have been Rejected','<p>The set of forms in the&nbsp;Table 5. Numbers of Graduates in the Most Recent Year node have been reviewed and rejected so please resubmit the forms accordingly with standards.</p>',0,'2019-01-12 19:40:35',1),(31,18,10,'Form(s) have been Rejected','<p>The set of forms in the&nbsp;Table 5. Numbers of Graduates in the Most Recent Year node have been reviewed and rejected so please resubmit the forms accordingly with standards.</p>',0,'2019-01-12 19:40:36',1),(32,18,14,'Form(s) have been Rejected','<p>The set of forms in the&nbsp;Table 5. Numbers of Graduates in the Most Recent Year node have been reviewed and rejected so please resubmit the forms accordingly with standards.</p>',0,'2019-01-12 19:40:50',1),(33,18,10,'Form(s) have been Rejected','<p>The set of forms in the&nbsp;Table 5. Numbers of Graduates in the Most Recent Year node have been reviewed and rejected so please resubmit the forms accordingly with standards.</p>',0,'2019-01-12 19:40:50',1),(34,18,14,'Form(s) have been Rejected','<p>The set of forms in the&nbsp;Table 7. Mode of Instruction &ndash; Teaching Staff node have been reviewed and rejected so please resubmit the forms accordingly with standards.</p>',0,'2019-01-12 19:40:59',1),(35,18,10,'Form(s) have been Rejected','<p>The set of forms in the&nbsp;Table 7. Mode of Instruction &ndash; Teaching Staff node have been reviewed and rejected so please resubmit the forms accordingly with standards.</p>',0,'2019-01-12 19:40:59',1),(36,18,14,'Form(s) have been Rejected','<p>The set of forms in the&nbsp;Table 8. Program Completion Rate/Graduation Rate* node have been reviewed and rejected so please resubmit the forms accordingly with standards.</p>',0,'2019-01-12 19:41:08',1),(37,18,10,'Form(s) have been Rejected','<p>The set of forms in the&nbsp;Table 8. Program Completion Rate/Graduation Rate* node have been reviewed and rejected so please resubmit the forms accordingly with standards.</p>',0,'2019-01-12 19:41:08',1),(38,1,10,'award candidate','<p>you have been nominated in award by admin@eaa.com.sa</p>',0,'2019-01-12 20:10:37',5),(39,1,11,'award candidate','<p>you have been nominated in award by admin@eaa.com.sa</p>',0,'2019-01-12 20:10:37',5),(40,1,10,'award candidate','<p>you have been nominated in award by admin@eaa.com.sa</p>',0,'2019-01-12 20:13:51',5),(41,1,12,'award candidate','<p>you have been nominated in award by admin@eaa.com.sa</p>',1,'2019-01-12 20:13:51',5),(42,1,14,'award candidate','<p>you have been nominated in award by admin@eaa.com.sa</p>',0,'2019-01-12 20:13:51',5),(43,1,10,'New Assessor Added','<p>Computer Scince College Coordinator, A new assessor has been successfully added to the ABET ETAC V.2015 node.</p>',0,'2019-01-13 14:58:57',1),(44,1,11,'New Assessor Added','<p>college coordinator prince ghazi, A new assessor has been successfully added to the ABET ETAC V.2015 node.</p>',0,'2019-01-13 14:59:03',1),(45,1,15,'New Assessor Added','<p>teacher coordinator, A new assessor has been successfully added to the ABET ETAC V.2015 node.</p>',1,'2019-01-13 14:59:12',1),(46,1,10,'New Assessor Added','<p>Computer Scince College Coordinator, A new assessor has been successfully added to the ABET ETAC V.2015 node.</p>',1,'2019-01-13 14:59:19',1),(47,1,11,'New Assessor Added','<p>college coordinator prince ghazi, A new assessor has been successfully added to the ABET ETAC V.2015 node.</p>',0,'2019-01-13 14:59:25',1),(48,10,10,'Form(s) have been Rejected','<p>The set of forms in the&nbsp;BACKGROUND INFORMATION node have been reviewed and rejected so please resubmit the forms accordingly with standards.</p>',0,'2019-01-13 15:05:34',1),(49,10,11,'Form(s) have been Rejected','<p>The set of forms in the&nbsp;BACKGROUND INFORMATION node have been reviewed and rejected so please resubmit the forms accordingly with standards.</p>',0,'2019-01-13 15:05:34',1),(50,10,10,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;CRITERION 2. PROGRAM EDUCATIONAL OBJECTIVES node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-13 15:07:53',1),(51,10,11,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;CRITERION 2. PROGRAM EDUCATIONAL OBJECTIVES node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-13 15:07:53',1),(52,10,12,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;CRITERION 2. PROGRAM EDUCATIONAL OBJECTIVES node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-13 15:07:53',1),(53,10,13,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;CRITERION 2. PROGRAM EDUCATIONAL OBJECTIVES node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-13 15:07:53',1),(54,10,14,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;CRITERION 2. PROGRAM EDUCATIONAL OBJECTIVES node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-13 15:07:53',1),(55,10,24,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;CRITERION 2. PROGRAM EDUCATIONAL OBJECTIVES node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-13 15:07:53',1),(56,10,25,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;CRITERION 2. PROGRAM EDUCATIONAL OBJECTIVES node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-13 15:07:53',1),(57,10,26,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;CRITERION 2. PROGRAM EDUCATIONAL OBJECTIVES node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-13 15:07:53',1),(58,10,27,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;CRITERION 2. PROGRAM EDUCATIONAL OBJECTIVES node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-13 15:07:53',1),(59,1,13,'New Assessor Added','<p>Computer Scince program coordinator, A new assessor has been successfully added to the Computer Science Program node.</p>',0,'2019-01-13 16:05:26',1),(60,1,10,'New Assessor Added','<p>Computer Scince College Coordinator, A new assessor has been successfully added to the Al Huson University College node.</p>',0,'2019-01-13 16:05:26',1),(61,1,20,'New Assessor Added','<p>super admin balqa university, A new assessor has been successfully added to the Computer Science Program node.</p>',1,'2019-01-13 16:05:56',1),(62,1,22,'New Assessor Added','<p>staff college coordinator ghazi, A new assessor has been successfully added to the Computer Science Program node.</p>',1,'2019-01-13 16:11:57',1),(63,22,26,'New Assessor Added','<p>program coor ghazi, A new assessor has been successfully added to the Computer Information system node %Link.</p>',0,'2019-01-13 16:20:19',1),(64,22,11,'New Assessor Added','<p>college coordinator prince ghazi, A new assessor has been successfully added to the prince ghazi college for information technology node %Link.</p>',0,'2019-01-13 16:20:19',1),(65,22,14,'New Assessor Added','<p>civil engineer program coordinator, A new assessor has been successfully added to the Computer Information system node %Link.</p>',0,'2019-01-13 16:20:40',1),(66,22,11,'New Assessor Added','<p>college coordinator prince ghazi, A new assessor has been successfully added to the Computer Information system node %Link.</p>',1,'2019-01-13 16:20:46',1),(67,11,10,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Program Specifications (PS) node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-13 16:23:43',1),(68,11,11,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Program Specifications (PS) node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-13 16:23:43',1),(69,11,12,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Program Specifications (PS) node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-13 16:23:43',1),(70,11,13,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Program Specifications (PS) node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-13 16:23:43',1),(71,11,14,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Program Specifications (PS) node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-13 16:23:43',1),(72,11,24,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Program Specifications (PS) node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-13 16:23:43',1),(73,11,25,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Program Specifications (PS) node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-13 16:23:43',1),(74,11,26,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Program Specifications (PS) node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-13 16:23:43',1),(75,11,27,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Program Specifications (PS) node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-13 16:23:43',1),(76,11,10,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Annual Program Report (APR) node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-13 16:24:00',1),(77,11,11,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Annual Program Report (APR) node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-13 16:24:00',1),(78,11,12,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Annual Program Report (APR) node have been reviewed and accepted to compliant to standards.</p>',1,'2019-01-13 16:24:00',1),(79,11,13,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Annual Program Report (APR) node have been reviewed and accepted to compliant to standards.</p>',1,'2019-01-13 16:24:00',1),(80,11,14,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Annual Program Report (APR) node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-13 16:24:00',1),(81,11,24,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Annual Program Report (APR) node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-13 16:24:00',1),(82,11,25,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Annual Program Report (APR) node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-13 16:24:00',1),(83,11,26,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Annual Program Report (APR) node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-13 16:24:00',1),(84,11,27,'Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;Annual Program Report (APR) node have been reviewed and accepted to compliant to standards.</p>',0,'2019-01-13 16:24:00',1),(85,1,2,'Fill out This Survey','<p>You are invitated to fill out the&nbsp;survey for AI course survey and give your input.</p>',0,'2019-01-15 16:32:42',2),(86,1,3,'Fill out This Survey','<p>You are invitated to fill out the&nbsp;survey for AI course survey and give your input.</p>',0,'2019-01-15 16:32:42',2),(87,1,4,'Fill out This Survey','<p>You are invitated to fill out the&nbsp;survey for AI course survey and give your input.</p>',0,'2019-01-15 16:32:42',2),(88,1,8,'Fill out This Survey','<p>You are invitated to fill out the&nbsp;survey for AI course survey and give your input.</p>',0,'2019-01-15 16:32:42',2),(89,1,3,'Fill out This Survey','<p>You are invitated to fill out the&nbsp;survey for AI course survey and give your input.</p>',0,'2019-01-15 16:32:42',2),(90,1,4,'Fill out This Survey','<p>You are invitated to fill out the&nbsp;survey for AI course survey and give your input.</p>',0,'2019-01-15 16:32:42',2),(91,1,6,'Fill out This Survey','<p>You are invitated to fill out the&nbsp;survey for AI course survey and give your input.</p>',0,'2019-01-15 16:32:42',2),(92,1,8,'Fill out This Survey','<p>You are invitated to fill out the&nbsp;survey for AI course survey and give your input.</p>',0,'2019-01-15 16:32:42',2),(93,1,2,'Fill out This Survey','<p>You are invitated to fill out the&nbsp;survey for AI course survey and give your input.</p>',0,'2019-01-15 16:32:42',2),(94,1,3,'Fill out This Survey','<p>You are invitated to fill out the&nbsp;survey for AI course survey and give your input.</p>',0,'2019-01-15 16:32:42',2),(95,1,5,'Fill out This Survey','<p>You are invitated to fill out the&nbsp;survey for AI course survey and give your input.</p>',0,'2019-01-15 16:32:42',2),(96,1,6,'Fill out This Survey','<p>You are invitated to fill out the&nbsp;survey for AI course survey and give your input.</p>',0,'2019-01-15 16:32:42',2),(97,1,7,'Fill out This Survey','<p>You are invitated to fill out the&nbsp;survey for AI course survey and give your input.</p>',0,'2019-01-15 16:32:42',2),(98,1,2,'Fill out This Survey','<p>You are invitated to fill out the&nbsp;survey for AI course survey and give your input.</p>',0,'2019-01-15 16:32:42',2),(99,1,3,'Fill out This Survey','<p>You are invitated to fill out the&nbsp;survey for AI course survey and give your input.</p>',0,'2019-01-15 16:32:42',2),(100,1,2,'Fill out This Survey','<p>You are invitated to fill out the&nbsp;survey for AI course survey and give your input.</p>',0,'2019-01-15 16:32:42',2),(101,1,5,'Fill out This Survey','<p>You are invitated to fill out the&nbsp;survey for AI course survey and give your input.</p>',0,'2019-01-15 16:32:42',2),(102,1,6,'Fill out This Survey','<p>You are invitated to fill out the&nbsp;survey for AI course survey and give your input.</p>',1,'2019-01-15 16:32:42',2),(103,1,7,'Fill out This Survey','<p>You are invitated to fill out the&nbsp;survey for AI course survey and give your input.</p>',0,'2019-01-15 16:32:42',2),(104,1,2,'Fill out This Survey','<p>You are invitated to fill out the&nbsp;survey for AI course survey and give your input.</p>',1,'2019-01-15 16:50:17',2),(105,1,4,'Fill out This Survey','<p>You are invitated to fill out the&nbsp;survey for AI course survey and give your input.</p>',0,'2019-01-15 16:50:17',2),(106,1,7,'Fill out This Survey','<p>You are invitated to fill out the&nbsp;survey for AI course survey and give your input.</p>',1,'2019-01-15 16:50:17',2),(107,1,2,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;survey for AI course survey as your input is valuable.</p>',1,'2019-01-15 16:51:48',2),(108,1,3,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;survey for AI course survey as your input is valuable.</p>',1,'2019-01-15 16:51:48',2),(109,1,4,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;survey for AI course survey as your input is valuable.</p>',1,'2019-01-15 16:51:48',2),(110,1,8,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;survey for AI course survey as your input is valuable.</p>',0,'2019-01-15 16:51:48',2),(111,1,2,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;survey for AI course survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=c673f7bdc430eaa8b91932d28cbef05b\">http://www.jadeer.com/survey/respond?token=c673f7bdc430eaa8b91932d28cbef05b</a></p>',1,'2019-01-15 22:39:46',2),(112,1,3,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;survey for AI course survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=1b534a4192247476fc2783dae2124bc1\">http://www.jadeer.com/survey/respond?token=1b534a4192247476fc2783dae2124bc1</a></p>',0,'2019-01-15 22:39:46',2),(113,1,4,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;survey for AI course survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=cef69cb1f3c6d70700410f4dabdb7a08\">http://www.jadeer.com/survey/respond?token=cef69cb1f3c6d70700410f4dabdb7a08</a></p>',0,'2019-01-15 22:39:46',2),(114,1,8,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;survey for AI course survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=dddd1421abb8d65855b9ad6816ea473a\">http://www.jadeer.com/survey/respond?token=dddd1421abb8d65855b9ad6816ea473a</a></p>',1,'2019-01-15 22:39:46',2),(115,1,2,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;student survey survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=13d2a819582b7c8ef4af6d2cd20a4e81\">http://www.jadeer.com/survey/respond?token=13d2a819582b7c8ef4af6d2cd20a4e81</a></p>',1,'2019-01-15 23:26:47',2),(116,1,3,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;student survey survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=17f17b51ab569335b4cee884cb94bf82\">http://www.jadeer.com/survey/respond?token=17f17b51ab569335b4cee884cb94bf82</a></p>',1,'2019-01-15 23:26:47',2),(117,1,4,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;student survey survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=0c49de94b192c8fa503eb2ed8f0bb61a\">http://www.jadeer.com/survey/respond?token=0c49de94b192c8fa503eb2ed8f0bb61a</a></p>',1,'2019-01-15 23:26:47',2),(118,1,5,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;student survey survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=4e46c1d835486b1d4d4f2cba24a6d797\">http://www.jadeer.com/survey/respond?token=4e46c1d835486b1d4d4f2cba24a6d797</a></p>',0,'2019-01-15 23:26:47',2),(119,1,6,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;student survey survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=e69b458778838a50e079a303c50dc832\">http://www.jadeer.com/survey/respond?token=e69b458778838a50e079a303c50dc832</a></p>',0,'2019-01-15 23:26:47',2),(120,1,7,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;student survey survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=e8fc5901d181716ca1c4e3b1965ef990\">http://www.jadeer.com/survey/respond?token=e8fc5901d181716ca1c4e3b1965ef990</a></p>',0,'2019-01-15 23:26:47',2),(121,1,8,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;student survey survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=bf986ab0b238b51bf5fde12a75148e43\">http://www.jadeer.com/survey/respond?token=bf986ab0b238b51bf5fde12a75148e43</a></p>',1,'2019-01-15 23:26:47',2),(122,1,9,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;student survey survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=c6968e85e09bf58328aa7d7f5f0af88a\">http://www.jadeer.com/survey/respond?token=c6968e85e09bf58328aa7d7f5f0af88a</a></p>',0,'2019-01-15 23:26:47',2),(123,1,6,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;student survey survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=e69b458778838a50e079a303c50dc832\">http://www.jadeer.com/survey/respond?token=e69b458778838a50e079a303c50dc832</a></p>',0,'2019-01-15 23:44:44',2),(124,1,1,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=edae2f09b6ec3af13c45a26d27031b87\">http://www.jadeer.com/survey/respond?token=edae2f09b6ec3af13c45a26d27031b87</a></p>',1,'2019-01-16 00:08:44',2),(125,1,20,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=0e6e18ce4f5f0f9b7c597c61bf1a55d8\">http://www.jadeer.com/survey/respond?token=0e6e18ce4f5f0f9b7c597c61bf1a55d8</a></p>',1,'2019-01-16 00:08:44',2),(126,1,21,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=e8619910abd4fb996f1b7a1606ca0107\">http://www.jadeer.com/survey/respond?token=e8619910abd4fb996f1b7a1606ca0107</a></p>',1,'2019-01-16 00:08:44',2),(127,1,22,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=0ebaa50f3ca9e5439e8638781b2dc050\">http://www.jadeer.com/survey/respond?token=0ebaa50f3ca9e5439e8638781b2dc050</a></p>',0,'2019-01-16 00:08:44',2),(128,1,23,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=fccd8cb9fb910d32e95401faf1577fea\">http://www.jadeer.com/survey/respond?token=fccd8cb9fb910d32e95401faf1577fea</a></p>',0,'2019-01-16 00:08:44',2),(129,1,24,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=e3f62ebc65f12014fb3c075b756bdbd5\">http://www.jadeer.com/survey/respond?token=e3f62ebc65f12014fb3c075b756bdbd5</a></p>',0,'2019-01-16 00:08:44',2),(130,1,25,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=0f9216652b6e0821d0b69adc02a17808\">http://www.jadeer.com/survey/respond?token=0f9216652b6e0821d0b69adc02a17808</a></p>',0,'2019-01-16 00:08:44',2),(131,1,26,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=b26cf0dff95cae54ec907249e1a3d060\">http://www.jadeer.com/survey/respond?token=b26cf0dff95cae54ec907249e1a3d060</a></p>',0,'2019-01-16 00:08:44',2),(132,1,27,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=bd7bf087309c87a0ff4c7d33f3deb32a\">http://www.jadeer.com/survey/respond?token=bd7bf087309c87a0ff4c7d33f3deb32a</a></p>',0,'2019-01-16 00:08:44',2),(133,1,28,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=d50f7052710c968b128df0ef2feb41fc\">http://www.jadeer.com/survey/respond?token=d50f7052710c968b128df0ef2feb41fc</a></p>',0,'2019-01-16 00:08:44',2),(134,1,29,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=3b193c40cc746313c82f03860e41993c\">http://www.jadeer.com/survey/respond?token=3b193c40cc746313c82f03860e41993c</a></p>',1,'2019-01-16 00:08:44',2),(135,1,30,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=d59da2aedfd09696fca0c77a2f509940\">http://www.jadeer.com/survey/respond?token=d59da2aedfd09696fca0c77a2f509940</a></p>',0,'2019-01-16 00:08:44',2),(136,1,31,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=6690f00b864b4e655762191ceeb49dbd\">http://www.jadeer.com/survey/respond?token=6690f00b864b4e655762191ceeb49dbd</a></p>',0,'2019-01-16 00:08:44',2),(137,20,1,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=edae2f09b6ec3af13c45a26d27031b87\">http://www.jadeer.com/survey/respond?token=edae2f09b6ec3af13c45a26d27031b87</a></p>',1,'2019-01-16 00:10:49',2),(138,20,20,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=0e6e18ce4f5f0f9b7c597c61bf1a55d8\">http://www.jadeer.com/survey/respond?token=0e6e18ce4f5f0f9b7c597c61bf1a55d8</a></p>',0,'2019-01-16 00:10:49',2),(139,20,21,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=e8619910abd4fb996f1b7a1606ca0107\">http://www.jadeer.com/survey/respond?token=e8619910abd4fb996f1b7a1606ca0107</a></p>',1,'2019-01-16 00:10:49',2),(140,20,22,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=0ebaa50f3ca9e5439e8638781b2dc050\">http://www.jadeer.com/survey/respond?token=0ebaa50f3ca9e5439e8638781b2dc050</a></p>',0,'2019-01-16 00:10:49',2),(141,20,23,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=fccd8cb9fb910d32e95401faf1577fea\">http://www.jadeer.com/survey/respond?token=fccd8cb9fb910d32e95401faf1577fea</a></p>',0,'2019-01-16 00:10:49',2),(142,20,24,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=e3f62ebc65f12014fb3c075b756bdbd5\">http://www.jadeer.com/survey/respond?token=e3f62ebc65f12014fb3c075b756bdbd5</a></p>',0,'2019-01-16 00:10:49',2),(143,20,25,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=0f9216652b6e0821d0b69adc02a17808\">http://www.jadeer.com/survey/respond?token=0f9216652b6e0821d0b69adc02a17808</a></p>',0,'2019-01-16 00:10:49',2),(144,20,26,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=b26cf0dff95cae54ec907249e1a3d060\">http://www.jadeer.com/survey/respond?token=b26cf0dff95cae54ec907249e1a3d060</a></p>',0,'2019-01-16 00:10:49',2),(145,20,27,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=bd7bf087309c87a0ff4c7d33f3deb32a\">http://www.jadeer.com/survey/respond?token=bd7bf087309c87a0ff4c7d33f3deb32a</a></p>',0,'2019-01-16 00:10:49',2),(146,20,28,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=d50f7052710c968b128df0ef2feb41fc\">http://www.jadeer.com/survey/respond?token=d50f7052710c968b128df0ef2feb41fc</a></p>',0,'2019-01-16 00:10:49',2),(147,20,29,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=3b193c40cc746313c82f03860e41993c\">http://www.jadeer.com/survey/respond?token=3b193c40cc746313c82f03860e41993c</a></p>',0,'2019-01-16 00:10:49',2),(148,20,30,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=d59da2aedfd09696fca0c77a2f509940\">http://www.jadeer.com/survey/respond?token=d59da2aedfd09696fca0c77a2f509940</a></p>',0,'2019-01-16 00:10:49',2),(149,20,31,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=6690f00b864b4e655762191ceeb49dbd\">http://www.jadeer.com/survey/respond?token=6690f00b864b4e655762191ceeb49dbd</a></p>',0,'2019-01-16 00:10:49',2),(150,20,1,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=ca6e7684f94c8f5157f891f1479a72dd\">http://www.jadeer.com/survey/respond?token=ca6e7684f94c8f5157f891f1479a72dd</a></p>',1,'2019-01-16 00:13:45',2),(151,20,20,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=b2a166089ef9b4880c27ee07fc012a0c\">http://www.jadeer.com/survey/respond?token=b2a166089ef9b4880c27ee07fc012a0c</a></p>',0,'2019-01-16 00:13:45',2),(152,20,21,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=d20cbabebf120d6d3946a1eea4ec6aa7\">http://www.jadeer.com/survey/respond?token=d20cbabebf120d6d3946a1eea4ec6aa7</a></p>',1,'2019-01-16 00:13:45',2),(153,20,22,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=563898b7baa39e614d7549c30f80c6f5\">http://www.jadeer.com/survey/respond?token=563898b7baa39e614d7549c30f80c6f5</a></p>',1,'2019-01-16 00:13:45',2),(154,20,23,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=ca68e9ef306acc4790bbda44052d9115\">http://www.jadeer.com/survey/respond?token=ca68e9ef306acc4790bbda44052d9115</a></p>',0,'2019-01-16 00:13:45',2),(155,20,24,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=b5fff28dc63af1b5abd281d465438e01\">http://www.jadeer.com/survey/respond?token=b5fff28dc63af1b5abd281d465438e01</a></p>',0,'2019-01-16 00:13:45',2),(156,20,25,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=708abba16a757ce8217b59ea2fd44611\">http://www.jadeer.com/survey/respond?token=708abba16a757ce8217b59ea2fd44611</a></p>',0,'2019-01-16 00:13:45',2),(157,20,26,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=d3638099ea9be66a0c7d0bd5f50c7bf6\">http://www.jadeer.com/survey/respond?token=d3638099ea9be66a0c7d0bd5f50c7bf6</a></p>',0,'2019-01-16 00:13:46',2),(158,20,27,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=a21798339703c4c80e8f305465870317\">http://www.jadeer.com/survey/respond?token=a21798339703c4c80e8f305465870317</a></p>',0,'2019-01-16 00:13:46',2),(159,20,28,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=cb0fd30292af60e9529b541b2ed282b9\">http://www.jadeer.com/survey/respond?token=cb0fd30292af60e9529b541b2ed282b9</a></p>',0,'2019-01-16 00:13:46',2),(160,20,29,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=97e60ebbdf3bf54cdea031a8d12c52bb\">http://www.jadeer.com/survey/respond?token=97e60ebbdf3bf54cdea031a8d12c52bb</a></p>',0,'2019-01-16 00:13:46',2),(161,20,30,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=07cc52a81a604448dc76502ec06fb8d2\">http://www.jadeer.com/survey/respond?token=07cc52a81a604448dc76502ec06fb8d2</a></p>',0,'2019-01-16 00:13:46',2),(162,20,31,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;ffff survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=9a76a8f938b4125166321aae792bff50\">http://www.jadeer.com/survey/respond?token=9a76a8f938b4125166321aae792bff50</a></p>',0,'2019-01-16 00:13:46',2),(163,1,33,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;iiiiiiiiiii survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=90e3da2bd7fb173fab12a5e0ca182626\">http://www.jadeer.com/survey/respond?token=90e3da2bd7fb173fab12a5e0ca182626</a></p>',0,'2019-01-16 00:40:12',2),(164,1,2,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;student survey survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=13d2a819582b7c8ef4af6d2cd20a4e81\">http://www.jadeer.com/survey/respond?token=13d2a819582b7c8ef4af6d2cd20a4e81</a></p>',0,'2019-01-16 10:05:14',2),(165,1,3,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;student survey survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=17f17b51ab569335b4cee884cb94bf82\">http://www.jadeer.com/survey/respond?token=17f17b51ab569335b4cee884cb94bf82</a></p>',0,'2019-01-16 10:05:14',2),(166,1,4,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;student survey survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=0c49de94b192c8fa503eb2ed8f0bb61a\">http://www.jadeer.com/survey/respond?token=0c49de94b192c8fa503eb2ed8f0bb61a</a></p>',1,'2019-01-16 10:05:14',2),(167,1,5,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;student survey survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=4e46c1d835486b1d4d4f2cba24a6d797\">http://www.jadeer.com/survey/respond?token=4e46c1d835486b1d4d4f2cba24a6d797</a></p>',0,'2019-01-16 10:05:14',2),(168,1,6,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;student survey survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=e69b458778838a50e079a303c50dc832\">http://www.jadeer.com/survey/respond?token=e69b458778838a50e079a303c50dc832</a></p>',0,'2019-01-16 10:05:14',2),(169,1,7,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;student survey survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=e8fc5901d181716ca1c4e3b1965ef990\">http://www.jadeer.com/survey/respond?token=e8fc5901d181716ca1c4e3b1965ef990</a></p>',0,'2019-01-16 10:05:14',2),(170,1,8,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;student survey survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=bf986ab0b238b51bf5fde12a75148e43\">http://www.jadeer.com/survey/respond?token=bf986ab0b238b51bf5fde12a75148e43</a></p>',1,'2019-01-16 10:05:14',2),(171,1,9,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;student survey survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=c6968e85e09bf58328aa7d7f5f0af88a\">http://www.jadeer.com/survey/respond?token=c6968e85e09bf58328aa7d7f5f0af88a</a></p>',0,'2019-01-16 10:05:14',2),(172,1,2,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;student survey survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=13d2a819582b7c8ef4af6d2cd20a4e81\">http://www.jadeer.com/survey/respond?token=13d2a819582b7c8ef4af6d2cd20a4e81</a></p>',1,'2019-01-16 10:29:24',2),(173,1,3,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;student survey survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=17f17b51ab569335b4cee884cb94bf82\">http://www.jadeer.com/survey/respond?token=17f17b51ab569335b4cee884cb94bf82</a></p>',1,'2019-01-16 10:29:24',2),(174,1,4,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;student survey survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=0c49de94b192c8fa503eb2ed8f0bb61a\">http://www.jadeer.com/survey/respond?token=0c49de94b192c8fa503eb2ed8f0bb61a</a></p>',1,'2019-01-16 10:29:24',2),(175,1,5,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;student survey survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=4e46c1d835486b1d4d4f2cba24a6d797\">http://www.jadeer.com/survey/respond?token=4e46c1d835486b1d4d4f2cba24a6d797</a></p>',0,'2019-01-16 10:29:24',2),(176,1,6,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;student survey survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=e69b458778838a50e079a303c50dc832\">http://www.jadeer.com/survey/respond?token=e69b458778838a50e079a303c50dc832</a></p>',1,'2019-01-16 10:29:24',2),(177,1,7,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;student survey survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=e8fc5901d181716ca1c4e3b1965ef990\">http://www.jadeer.com/survey/respond?token=e8fc5901d181716ca1c4e3b1965ef990</a></p>',0,'2019-01-16 10:29:24',2),(178,1,8,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;student survey survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=bf986ab0b238b51bf5fde12a75148e43\">http://www.jadeer.com/survey/respond?token=bf986ab0b238b51bf5fde12a75148e43</a></p>',1,'2019-01-16 10:29:24',2),(179,1,9,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;student survey survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=c6968e85e09bf58328aa7d7f5f0af88a\">http://www.jadeer.com/survey/respond?token=c6968e85e09bf58328aa7d7f5f0af88a</a></p>',0,'2019-01-16 10:29:24',2),(180,1,33,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;iiiiiiiiiii survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=90e3da2bd7fb173fab12a5e0ca182626\">http://www.jadeer.com/survey/respond?token=90e3da2bd7fb173fab12a5e0ca182626</a></p>',0,'2019-01-16 14:32:06',2),(181,1,11,'award candidate','<p>you have been nominated in award by admin@eaa.com.sa</p>',0,'2019-01-17 13:25:25',5),(182,1,10,'award candidate','<p>you have been nominated in award by admin@eaa.com.sa</p>',0,'2019-01-17 13:25:34',5),(183,1,10,'award candidate','<p>you have been nominated in award by admin@eaa.com.sa</p>',0,'2019-01-17 13:29:05',5),(184,1,15,'award candidate','<p>you have been nominated in award by admin@eaa.com.sa</p>',0,'2019-01-17 13:29:05',5),(185,1,2,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;survey for AI course survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=9a9f4391f9e541a01716799a0b563c78\">http://www.jadeer.com/survey/respond?token=9a9f4391f9e541a01716799a0b563c78</a></p>',0,'2019-01-17 13:40:08',2),(186,1,3,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;survey for AI course survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=6b823a30783f69f3b8ffd0f2aa051cc2\">http://www.jadeer.com/survey/respond?token=6b823a30783f69f3b8ffd0f2aa051cc2</a></p>',1,'2019-01-17 13:40:08',2),(187,1,5,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;survey for AI course survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=8b7839a6c4f28b4260fa4ec6621ac18d\">http://www.jadeer.com/survey/respond?token=8b7839a6c4f28b4260fa4ec6621ac18d</a></p>',0,'2019-01-17 13:40:08',2),(188,1,6,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;survey for AI course survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=9cec12a9bdce6cba43af12fc9ad3cb1c\">http://www.jadeer.com/survey/respond?token=9cec12a9bdce6cba43af12fc9ad3cb1c</a></p>',1,'2019-01-17 13:40:08',2),(189,1,7,'Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;survey for AI course survey as your input is valuable&nbsp;<a href=\"http://www.jadeer.com/survey/respond?token=bf9ae3db88afb0374fdda0fed76ff345\">http://www.jadeer.com/survey/respond?token=bf9ae3db88afb0374fdda0fed76ff345</a></p>',0,'2019-01-17 13:40:08',2),(190,1,13,'New Assessor Added','<p>Computer Scince program coordinator, A new assessor has been successfully added to the Computer Science Program node %Link.</p>',0,'2019-01-17 14:31:40',1),(191,1,10,'New Assessor Added','<p>Computer Scince College Coordinator, A new assessor has been successfully added to the Al Huson University College node %Link.</p>',0,'2019-01-17 14:31:40',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification_template`
--

LOCK TABLES `notification_template` WRITE;
/*!40000 ALTER TABLE `notification_template` DISABLE KEYS */;
INSERT INTO `notification_template` VALUES (1,'admin_add_user_on_node','New Assessor Added','<p>%receiver_name%, A new assessor has been successfully added to the %node_name% node %Link.</p>'),(2,'admin_entered_due_date_to_node','New Due Date from Admin','<p>The admin has assigned the&nbsp;%node_name% node to be submitted at&nbsp;%due_date%.</p>'),(3,'assessor_finished_entering_forms_data','Assessor has Completed the Forms','<p>The assigned assessor has completed forms for the&nbsp;%node_name% node.</p>'),(4,'all_form_data_enterd_and_checked_correctly','Forms Accepted as Compliant','<p>All&nbsp;forms in the&nbsp;%node_name% node have been reviewed and accepted to compliant to standards.</p>'),(5,'form_data_incorrect_or_not_enterd','Form(s) have been Rejected','<p>The set of forms in the&nbsp;%node_name% node have been reviewed and rejected so please resubmit the forms accordingly with standards.</p>'),(6,'survey_invitation','Fill out This Survey','<p>You are invitated to fill out the&nbsp;%survey_title_english% survey and give your input&nbsp;%link%</p>'),(7,'survey_alumni_invitation','Fill out This Survey','<p><span data-sheets-value=\"{\" data-sheets-userformat=\"{\">You are invitated to fill out the %survey_title_english% survey and give your input.%link%</span></p>'),(8,'survey_employer_invitation','Fill out This Survey','<p><span data-sheets-value=\"{\" data-sheets-userformat=\"{\">You are invitated to fill out the %survey_title_english% survey and give your input.%link%</span></p>'),(9,'survey_reminder','Don\'t Forget to Fill out This Survey','<p>Please don\'t forgot to fill the&nbsp;%survey_title_english% survey as your input is valuable&nbsp;%link%</p>'),(10,'forgot_password','Forgot Password Service','<p>You have requested to send your forgotton password. Your password is as follows:</p><p>%password%</p>'),(11,'alumni_employer_created','An Employer Entity Created','<p>The respected alumnus member has created a new employer entity to be associated with in the system as well other alumni if there exists a current or previous association with this employer.</p>'),(12,'email_received','You have a New Message','<p>%receiver_name% has sent you a new message from the %receiver_email% account.</p>'),(13,'remind_user_to_fill','Please Fill out Required Forms','<p>%receiver_name%, it is important that your assigned forms for the&nbsp;%node_name% node be filled so that accreditation can take place accordingly.</p>'),(14,'join_training','New Member need to join training','<p>%sender_name% need to join %training_name_english%</p><p>%link%</p>'),(15,'ignore_training','Training Request Ignored','<p>Your Request for Joining %training_name_english% ignored by %sender_name%</p>'),(16,'approve_training','Training Request Approved','<p>Your request to join %training_name_english% approved by %sender_name%</p>'),(17,'award_candidate','award candidate','<p>you have been nominated in award by %sender_name%</p>'),(18,'award_winner','award winner','<p>you have been nominated in award by %sender_name%</p>'),(19,'rubrics','You have been invited in rubric','<p> You hav been assigned to fill a rubric %rubrics_name_english% by %sender_name%</p><p>%link%</p>'),(20,'clubs','You have been invited to club','<p>You have been invited in %club_name_english% club by %sender_name%</p>');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_assignment`
--

LOCK TABLES `pc_assignment` WRITE;
/*!40000 ALTER TABLE `pc_assignment` DISABLE KEYS */;
INSERT INTO `pc_assignment` VALUES (1,6,'assignment for ai course is here','assignment for ai course is here','assignment for ai course is here','assignment for ai course is here',2,'2019-01-17 00:00:00','2019-01-31 00:00:00','/files/portfolio_course/assignment/assignment_info/assignment/file_path-1547635511.pdf',1,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_course_policies`
--

LOCK TABLES `pc_course_policies` WRITE;
/*!40000 ALTER TABLE `pc_course_policies` DISABLE KEYS */;
INSERT INTO `pc_course_policies` VALUES (1,6,'grading students for AI course','grading students for AI course','Attendance to this course must be at morning','Attendance to this course must be at morning','lateness for this  course is very danger','lateness for this  course is very danger','class participation is very important in this course','class participation is very important in this course','any student missed exam will not make anoter','any student missed exam will not make anoter','missed assignment will take it again','missed assignment will take it again','dishonesty for this course will be danger','dishonesty for this course will be danger','no plagiarism for this course , it will be very danger','no plagiarism for this course , it will be very danger',1,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_format`
--

LOCK TABLES `pc_format` WRITE;
/*!40000 ALTER TABLE `pc_format` DISABLE KEYS */;
INSERT INTO `pc_format` VALUES (1,6,'/files/portfolio_course/assignment/format_info/assignment/assignment_format_file-1547635559.pdf',NULL,NULL,NULL,1,0,'assignment format is here','assignment format is here'),(2,6,NULL,'/files/portfolio_course/assignment/format_info/homework/homework_format_file-1547635719.pdf',NULL,NULL,1,0,'solve network problem is here','solve network problem is here'),(3,6,NULL,NULL,'/files/portfolio_course/assignment/format_info/laboratory/lab_experiment_format_file-1547635753.pdf',NULL,1,0,'experiment format for AI ','experiment format for AI '),(4,6,NULL,NULL,NULL,'/files/portfolio_course/assignment/format_info/exercise/class_exercise_format_file-1547635793.pdf',1,0,'in-class exercises format','in-class exercises format');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_instructor_information`
--

LOCK TABLES `pc_instructor_information` WRITE;
/*!40000 ALTER TABLE `pc_instructor_information` DISABLE KEYS */;
INSERT INTO `pc_instructor_information` VALUES (1,5,1,'old building','4'),(2,5,2,'khawrzme','6'),(3,2,1,'khawrzme','5'),(4,3,2,'old building','7'),(5,4,2,'khawrzme','8');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_material`
--

LOCK TABLES `pc_material` WRITE;
/*!40000 ALTER TABLE `pc_material` DISABLE KEYS */;
INSERT INTO `pc_material` VALUES (1,6,'lab for manufacturing robots','lab for manufacturing robots','lab for creative students','lab for creative students',3,'in old building',1,0,'assem al jimzawi','2019-01-16 00:00:00','edition 1','ahmad zahran');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_report`
--

LOCK TABLES `pc_report` WRITE;
/*!40000 ALTER TABLE `pc_report` DISABLE KEYS */;
INSERT INTO `pc_report` VALUES (1,'report for AI course is here','report for AI course is here',6),(2,'report for program','report for program',6);
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_report_components`
--

LOCK TABLES `pc_report_components` WRITE;
/*!40000 ALTER TABLE `pc_report_components` DISABLE KEYS */;
INSERT INTO `pc_report_components` VALUES (1,1,1,1),(2,1,2,1),(3,1,6,1),(4,1,8,1),(5,2,1,1),(6,2,2,1),(7,2,3,1),(8,2,4,1),(9,2,5,1),(10,2,6,1),(11,2,7,1),(12,2,8,1),(13,2,9,1),(14,2,10,1),(15,2,11,1),(16,2,12,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_settings`
--

LOCK TABLES `pc_settings` WRITE;
/*!40000 ALTER TABLE `pc_settings` DISABLE KEYS */;
INSERT INTO `pc_settings` VALUES (1,'1','3');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_student_work`
--

LOCK TABLES `pc_student_work` WRITE;
/*!40000 ALTER TABLE `pc_student_work` DISABLE KEYS */;
INSERT INTO `pc_student_work` VALUES (1,6,'project one for student','project one for student','/files/portfolio_course/student_work/student_project_file-1547636611.pdf','',0,0,'',1),(2,6,'','','','guideline for project here',0,0,'guideline for project here',2);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_support_material`
--

LOCK TABLES `pc_support_material` WRITE;
/*!40000 ALTER TABLE `pc_support_material` DISABLE KEYS */;
INSERT INTO `pc_support_material` VALUES (1,6,'/files/portfolio_course/support_material/construction/construction_technique_file-1547635030.pdf',NULL,NULL,NULL,NULL,'','',1,0,'construction for AI here','construction for AI here',1),(2,6,NULL,'/files/portfolio_course/support_material/equipment/equipment_documentation_file-1547635047.pdf',NULL,NULL,NULL,'','',1,0,'equipment here','equipment here',1),(3,6,NULL,NULL,'/files/portfolio_course/support_material/computerDocumentation/computer_documentation_file-1547635153.pdf',NULL,NULL,'','',1,0,'computer Documentation is here','computer Documentation is here',1),(4,6,NULL,NULL,NULL,'/files/portfolio_course/support_material/troubleshootingTip/troubleshooting_tip_file-1547635189.pdf',NULL,'','',1,0,'Troubleshooting Tips for AI course','Troubleshooting Tips for AI course',1),(5,6,NULL,NULL,NULL,NULL,'/files/portfolio_course/support_material/debugging/debugging_tip_file-1547635218.pdf','','',1,0,'Debugging Tips for ai','Debugging Tips for ai',1),(6,6,NULL,NULL,NULL,NULL,NULL,'additions here for additions and revisions ','additions here for additions and revisions ',1,0,'','',2);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_support_service`
--

LOCK TABLES `pc_support_service` WRITE;
/*!40000 ALTER TABLE `pc_support_service` DISABLE KEYS */;
INSERT INTO `pc_support_service` VALUES (1,6,'support service for this course','support service for this course',1,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_teaching_material`
--

LOCK TABLES `pc_teaching_material` WRITE;
/*!40000 ALTER TABLE `pc_teaching_material` DISABLE KEYS */;
INSERT INTO `pc_teaching_material` VALUES (1,6,'/files/portfolio_course/teaching_material/course_manual_file-1547634663.pdf','','','','',0,0,'manual of AI course','manual of AI course',1),(2,6,'','lecture note is here','lecture note is here','','',0,0,'','',2),(3,6,'','','','revisions 1 will be here','revisions 1 will be here',0,0,'','',3);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_topic`
--

LOCK TABLES `pc_topic` WRITE;
/*!40000 ALTER TABLE `pc_topic` DISABLE KEYS */;
INSERT INTO `pc_topic` VALUES (1,6,'topic one for AI','topic one for AI','topic one for AI','topic one for AI','2019-01-16 00:00:00','2019-01-31 00:00:00',1);
/*!40000 ALTER TABLE `pc_topic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pm_phase`
--

DROP TABLE IF EXISTS `pm_phase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pm_phase` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title_en` varchar(255) NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `desc_en` text,
  `desc_ar` text,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pm_phase`
--

LOCK TABLES `pm_phase` WRITE;
/*!40000 ALTER TABLE `pm_phase` DISABLE KEYS */;
INSERT INTO `pm_phase` VALUES (1,'phase one for the project','phase one for the project','phase one for the project','phase one for the project','2019-01-13','2019-03-01'),(2,'last phase','last phase','','','2019-03-02','2019-05-31');
/*!40000 ALTER TABLE `pm_phase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pm_project`
--

DROP TABLE IF EXISTS `pm_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pm_project` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title_en` varchar(255) NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `budget` decimal(10,2) NOT NULL,
  `resources` text,
  `desc_en` text,
  `desc_ar` text,
  `responsible_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pm_project`
--

LOCK TABLES `pm_project` WRITE;
/*!40000 ALTER TABLE `pm_project` DISABLE KEYS */;
INSERT INTO `pm_project` VALUES (2,'customized project 1','customized project 1','2019-01-11','2019-05-31',1000.00,'customized project 1','description one is here','description one is here',1);
/*!40000 ALTER TABLE `pm_project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pm_project_phase`
--

DROP TABLE IF EXISTS `pm_project_phase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pm_project_phase` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) NOT NULL,
  `phase_id` bigint(20) NOT NULL,
  `project_type` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pm_project_phase`
--

LOCK TABLES `pm_project_phase` WRITE;
/*!40000 ALTER TABLE `pm_project_phase` DISABLE KEYS */;
INSERT INTO `pm_project_phase` VALUES (1,2,1,1),(2,2,2,1);
/*!40000 ALTER TABLE `pm_project_phase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pm_sub_phase`
--

DROP TABLE IF EXISTS `pm_sub_phase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pm_sub_phase` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title_en` varchar(255) NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `desc_en` text,
  `desc_ar` text,
  `phase_id` bigint(20) NOT NULL,
  `responsible` int(11) NOT NULL,
  `is_complete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pm_sub_phase`
--

LOCK TABLES `pm_sub_phase` WRITE;
/*!40000 ALTER TABLE `pm_sub_phase` DISABLE KEYS */;
INSERT INTO `pm_sub_phase` VALUES (1,'sub sub-phase one for the project','sub sub-phase one for the project','2019-01-13','2019-03-01','','',1,11,0),(2,'sub sub-phjase 1','sub sub-phjase 1','2019-03-02','2019-04-30','yyyyyyyyyyyyyyyyyyyyyyy','fsdfdsfdsfdsfsdfdsf',2,13,1),(3,'sub sub-phase 2','sub sub-phase 2','2019-05-01','2019-05-31','','',2,12,0);
/*!40000 ALTER TABLE `pm_sub_phase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `policies_procedures`
--

DROP TABLE IF EXISTS `policies_procedures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `policies_procedures` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `unit_id` bigint(20) NOT NULL DEFAULT '0',
  `unit_type` int(11) NOT NULL DEFAULT '0',
  `title_en` varchar(255) NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `desc_en` text,
  `desc_ar` text,
  `statement_en` text,
  `statement_ar` text,
  `definitions_en` text,
  `definitions_ar` text,
  `audience_en` text,
  `audience_ar` text,
  `reason_en` text,
  `reason_ar` text,
  `compliance_en` text,
  `compliance_ar` text,
  `regulations_en` text,
  `regulations_ar` text,
  `contact_def_en` text,
  `contact_def_ar` text,
  `history_en` text,
  `history_ar` text,
  `procedures_en` text,
  `procedures_ar` text,
  `standard_en` text,
  `standard_ar` text,
  `creator_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `policies_procedures`
--

LOCK TABLES `policies_procedures` WRITE;
/*!40000 ALTER TABLE `policies_procedures` DISABLE KEYS */;
INSERT INTO `policies_procedures` VALUES (1,1,1,'policy and procedure 1','policy and procedure 1','policy and procedure 1','policy and procedure 1','<p>statement one from managesrs to deal with this</p>','<p>statement one from managesrs to deal with this</p>','<p><strong>defintions are here to display</strong></p>','<p><strong>defintions are here to display</strong></p>','','','','','','','','','','','','','','','','',1);
/*!40000 ALTER TABLE `policies_procedures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `policies_procedures_contacts`
--

DROP TABLE IF EXISTS `policies_procedures_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `policies_procedures_contacts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `policies_id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `policies_procedures_contacts`
--

LOCK TABLES `policies_procedures_contacts` WRITE;
/*!40000 ALTER TABLE `policies_procedures_contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `policies_procedures_contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `policies_procedures_files`
--

DROP TABLE IF EXISTS `policies_procedures_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `policies_procedures_files` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `policy_id` bigint(20) NOT NULL,
  `form_name_en` varchar(255) NOT NULL,
  `form_name_ar` varchar(255) NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `policies_procedures_files`
--

LOCK TABLES `policies_procedures_files` WRITE;
/*!40000 ALTER TABLE `policies_procedures_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `policies_procedures_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `policies_procedures_managers`
--

DROP TABLE IF EXISTS `policies_procedures_managers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `policies_procedures_managers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `policy_id` bigint(20) NOT NULL,
  `manager_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `policies_procedures_managers`
--

LOCK TABLES `policies_procedures_managers` WRITE;
/*!40000 ALTER TABLE `policies_procedures_managers` DISABLE KEYS */;
INSERT INTO `policies_procedures_managers` VALUES (1,1,13),(2,1,14);
/*!40000 ALTER TABLE `policies_procedures_managers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `policies_procedures_responsible`
--

DROP TABLE IF EXISTS `policies_procedures_responsible`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `policies_procedures_responsible` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `policies_id` bigint(20) NOT NULL,
  `role` varchar(256) NOT NULL,
  `responsibilities` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `policies_procedures_responsible`
--

LOCK TABLES `policies_procedures_responsible` WRITE;
/*!40000 ALTER TABLE `policies_procedures_responsible` DISABLE KEYS */;
/*!40000 ALTER TABLE `policies_procedures_responsible` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program`
--

DROP TABLE IF EXISTS `program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `integration_id` varchar(100) NOT NULL DEFAULT '0',
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program`
--

LOCK TABLES `program` WRITE;
/*!40000 ALTER TABLE `program` DISABLE KEYS */;
INSERT INTO `program` VALUES (1,'0',1,0,'introduction in computer science','مقدمة في علوم الحاسوب','','',0,0,1,'','','',''),(2,'0',2,0,'build big web system','بناء نظام ويب متكامل','','',0,0,2,'','','',''),(3,'0',5,0,'computer Agriculture','بنية الحاسوب','','',0,0,4,'','','',''),(4,'0',8,0,'write medicine reports and understand it','كتابة و فهم الوصفات الطبية بمجملها','','',0,0,3,'','','',''),(5,'0',1,0,'Computer Science Program','برنامج علم الحاسوب','','',0,0,5,'to be 10 universitites in IT','to be 10 universitites in IT','to accelerate with new technology','to accelerate with new technology'),(6,'0',10,0,'Computer Information system','نظم المعلومات الحاسوبية','','',0,0,5,'','','',''),(7,'0',11,0,'pharmacy program','برنامج الصيدلة','','',0,0,7,'','','',''),(8,'0',9,0,'civil Engineering','الهندسة المدنية','','',0,0,6,'grow up with world','grow up with world','to be one in engineering','to be one in engineering'),(9,'0',9,0,'Mechanical Engineering Program','هندسة الميكانيك','','',0,0,6,'','','',''),(10,'0',9,0,'Communication Engineering','هندسة الاتصالات','','',0,0,6,'','','',''),(11,'0',9,0,'Industrial Engineering','الهندسة الصناعية','','',0,0,6,'','','',''),(12,'0',12,0,'press and media','الصحافة و اﻷعلام','','',0,0,7,'','','','');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program_objective`
--

LOCK TABLES `program_objective` WRITE;
/*!40000 ALTER TABLE `program_objective` DISABLE KEYS */;
INSERT INTO `program_objective` VALUES (1,5,'computer science will depending on many values to take in care to develop our objectives','computer science will depending on many values to take in care to develop our objectives',0);
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
  `integration_id` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `PP_IDX` (`program_id`,`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program_plan`
--

LOCK TABLES `program_plan` WRITE;
/*!40000 ALTER TABLE `program_plan` DISABLE KEYS */;
INSERT INTO `program_plan` VALUES (1,5,8,6,3,1,'0'),(2,5,6,8,6,1,'0'),(3,5,1,1,1,1,'0');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pt_college_program_relation`
--

LOCK TABLES `pt_college_program_relation` WRITE;
/*!40000 ALTER TABLE `pt_college_program_relation` DISABLE KEYS */;
INSERT INTO `pt_college_program_relation` VALUES (1,1,1,5);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pt_keyword`
--

LOCK TABLES `pt_keyword` WRITE;
/*!40000 ALTER TABLE `pt_keyword` DISABLE KEYS */;
INSERT INTO `pt_keyword` VALUES (1,'mission to take university seriously to be good college','mission to take university seriously to be good college'),(2,'our university depending on our college to be best one ','our university depending on our college to be best one '),(3,'computer science program must be best program in university','computer science program must be best program in university');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pt_keyword_college`
--

LOCK TABLES `pt_keyword_college` WRITE;
/*!40000 ALTER TABLE `pt_keyword_college` DISABLE KEYS */;
INSERT INTO `pt_keyword_college` VALUES (1,'our university depending on our college to be best one ','our university depending on our college to be best one ',2,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pt_keyword_program`
--

LOCK TABLES `pt_keyword_program` WRITE;
/*!40000 ALTER TABLE `pt_keyword_program` DISABLE KEYS */;
INSERT INTO `pt_keyword_program` VALUES (1,'computer science program must be best program in university','computer science program must be best program in university',3,5);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pt_keyword_uni`
--

LOCK TABLES `pt_keyword_uni` WRITE;
/*!40000 ALTER TABLE `pt_keyword_uni` DISABLE KEYS */;
INSERT INTO `pt_keyword_uni` VALUES (2,'mission to take university seriously to be good college','mission to take university seriously to be good college',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pt_obj_plo_relation`
--

LOCK TABLES `pt_obj_plo_relation` WRITE;
/*!40000 ALTER TABLE `pt_obj_plo_relation` DISABLE KEYS */;
INSERT INTO `pt_obj_plo_relation` VALUES (1,1,4,5),(2,1,5,5),(3,1,6,5),(4,1,7,5),(5,1,8,5),(6,1,9,5),(7,1,10,5),(8,1,11,5),(9,1,12,5),(10,1,13,5);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pt_obj_program_relation`
--

LOCK TABLES `pt_obj_program_relation` WRITE;
/*!40000 ALTER TABLE `pt_obj_program_relation` DISABLE KEYS */;
INSERT INTO `pt_obj_program_relation` VALUES (1,1,1,5);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pt_uni_college_relation`
--

LOCK TABLES `pt_uni_college_relation` WRITE;
/*!40000 ALTER TABLE `pt_uni_college_relation` DISABLE KEYS */;
INSERT INTO `pt_uni_college_relation` VALUES (1,1,1,1);
/*!40000 ALTER TABLE `pt_uni_college_relation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rb_evaluations`
--

DROP TABLE IF EXISTS `rb_evaluations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rb_evaluations` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `rubrics_id` bigint(20) DEFAULT NULL,
  `description_en` text,
  `description_ar` text,
  `date_added` date DEFAULT NULL,
  `criteria` text,
  PRIMARY KEY (`id`),
  KEY `rubrics_id` (`rubrics_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rb_evaluations`
--

LOCK TABLES `rb_evaluations` WRITE;
/*!40000 ALTER TABLE `rb_evaluations` DISABLE KEYS */;
/*!40000 ALTER TABLE `rb_evaluations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rb_result`
--

DROP TABLE IF EXISTS `rb_result`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rb_result` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `evaluator` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `semester_id` bigint(20) NOT NULL,
  `rubric_id` bigint(20) NOT NULL,
  `skill_id` bigint(20) NOT NULL,
  `scale_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `evaluator` (`evaluator`),
  KEY `user_id` (`user_id`),
  KEY `semester_id` (`semester_id`),
  KEY `rubric_id` (`rubric_id`),
  KEY `skill_id` (`skill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rb_result`
--

LOCK TABLES `rb_result` WRITE;
/*!40000 ALTER TABLE `rb_result` DISABLE KEYS */;
/*!40000 ALTER TABLE `rb_result` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rb_rubrics`
--

DROP TABLE IF EXISTS `rb_rubrics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rb_rubrics` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name_en` text,
  `name_ar` text,
  `desc_en` text,
  `desc_ar` text,
  `rubric_class` tinytext NOT NULL,
  `weight_type` int(1) NOT NULL DEFAULT '0',
  `extra_data` text NOT NULL,
  `rubric_type` int(1) NOT NULL DEFAULT '0',
  `creator` bigint(20) NOT NULL,
  `publisher` bigint(20) NOT NULL,
  `start_date` int(11) DEFAULT NULL,
  `end_date` int(11) DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `is_deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rb_rubrics`
--

LOCK TABLES `rb_rubrics` WRITE;
/*!40000 ALTER TABLE `rb_rubrics` DISABLE KEYS */;
INSERT INTO `rb_rubrics` VALUES (1,'rubric one to add','rubric one to add','rubric one to add','rubric one to add','Orm_Rb_Rubrics_Course',2,'6',1,1,0,0,0,'2019-01-15','2019-01-15',1),(2,'rubric one','المقياس اﻷول','rubric one to modify and add details for it','rubric one to modify and add details for it','Orm_Rb_Rubrics_Course',1,'6',1,1,0,0,0,'2019-01-15','2019-01-15',0);
/*!40000 ALTER TABLE `rb_rubrics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rb_scale`
--

DROP TABLE IF EXISTS `rb_scale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rb_scale` (
  `id` bigint(21) NOT NULL AUTO_INCREMENT,
  `rubrics_id` bigint(20) NOT NULL,
  `name_en` text,
  `name_ar` text,
  `weight` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `rubrics_id` (`rubrics_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rb_scale`
--

LOCK TABLES `rb_scale` WRITE;
/*!40000 ALTER TABLE `rb_scale` DISABLE KEYS */;
INSERT INTO `rb_scale` VALUES (4,2,'scale 1','مقياس 1',0),(5,2,'scale 2','مقياس 2',0),(6,2,'scale 3','مقياس 3',0),(7,2,'scale 4','مقياس 4',0);
/*!40000 ALTER TABLE `rb_scale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rb_settings`
--

DROP TABLE IF EXISTS `rb_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rb_settings` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `key_text` varchar(100) DEFAULT NULL,
  `key_value` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rb_settings`
--

LOCK TABLES `rb_settings` WRITE;
/*!40000 ALTER TABLE `rb_settings` DISABLE KEYS */;
INSERT INTO `rb_settings` VALUES (1,'scale_count','4'),(2,'scale_text_en','scale'),(3,'scale_text_ar','مقياس');
/*!40000 ALTER TABLE `rb_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rb_skills`
--

DROP TABLE IF EXISTS `rb_skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rb_skills` (
  `id` bigint(21) NOT NULL AUTO_INCREMENT,
  `rubrics_id` bigint(20) NOT NULL,
  `name_en` text,
  `name_ar` text,
  `value` int(4) NOT NULL DEFAULT '0',
  `extra_data` text,
  `date_added` int(11) NOT NULL DEFAULT '0',
  `date_modified` int(11) DEFAULT NULL,
  `is_deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `rubrics_id` (`rubrics_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rb_skills`
--

LOCK TABLES `rb_skills` WRITE;
/*!40000 ALTER TABLE `rb_skills` DISABLE KEYS */;
INSERT INTO `rb_skills` VALUES (1,2,'reading book of AI','reading book of AI',120,'',1547555904,1547557122,0),(2,2,'create robot from scratch','create robot from scratch',90,'',1547556773,1547557122,0);
/*!40000 ALTER TABLE `rb_skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rb_table`
--

DROP TABLE IF EXISTS `rb_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rb_table` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `rubric_id` bigint(20) NOT NULL,
  `skill_id` bigint(20) NOT NULL,
  `scale_id` bigint(20) NOT NULL,
  `target` int(4) NOT NULL DEFAULT '0',
  `description_en` text,
  `description_ar` text,
  `date_added` int(11) NOT NULL DEFAULT '0',
  `date_modified` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rubric_id` (`rubric_id`),
  KEY `skill_id_scale_id` (`skill_id`,`scale_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rb_table`
--

LOCK TABLES `rb_table` WRITE;
/*!40000 ALTER TABLE `rb_table` DISABLE KEYS */;
INSERT INTO `rb_table` VALUES (1,2,1,4,60,'understand headlines of the book','understand headlines of the book',1547555904,1547557122),(2,2,1,5,20,'finish the first 3 chapters of the book','finish the first 3 chapters of the book',1547555904,1547557122),(3,2,1,6,60,'finish another three chapters of the book','finish another three chapters of the book',1547555904,1547557122),(4,2,1,7,10,'finish whole the book from A to Z','finish whole the book from A to Z',1547555904,1547557122),(5,2,2,4,60,'understand of python programming language','understand of python programming language',1547556773,1547557122),(6,2,2,5,190,'make simple code of this language','make simple code of this language',1547556773,1547557122),(7,2,2,6,70,'goo ','goo ',1547556773,1547557122),(8,2,2,7,30,'goo too','goo too',1547556773,1547557122);
/*!40000 ALTER TABLE `rb_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rim_risk_management`
--

DROP TABLE IF EXISTS `rim_risk_management`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rim_risk_management` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `level_type` tinytext NOT NULL,
  `level_id` bigint(20) NOT NULL,
  `type` tinytext NOT NULL,
  `type_id` bigint(20) NOT NULL,
  `likely` int(11) NOT NULL,
  `severity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rim_risk_management`
--

LOCK TABLES `rim_risk_management` WRITE;
/*!40000 ALTER TABLE `rim_risk_management` DISABLE KEYS */;
/*!40000 ALTER TABLE `rim_risk_management` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rim_risk_treatment`
--

DROP TABLE IF EXISTS `rim_risk_treatment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rim_risk_treatment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `responsible_id` bigint(20) NOT NULL,
  `Risk_id` bigint(20) NOT NULL,
  `desc_ar` text,
  `desc_en` text,
  `risk_desc_ar` text,
  `risk_desc_en` text,
  `impact_ar` text,
  `impact_en` text,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rim_risk_treatment`
--

LOCK TABLES `rim_risk_treatment` WRITE;
/*!40000 ALTER TABLE `rim_risk_treatment` DISABLE KEYS */;
/*!40000 ALTER TABLE `rim_risk_treatment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rm_equipment`
--

DROP TABLE IF EXISTS `rm_equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rm_equipment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name_ar` mediumtext NOT NULL,
  `name_en` mediumtext NOT NULL,
  `additional` mediumtext,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rm_equipment`
--

LOCK TABLES `rm_equipment` WRITE;
/*!40000 ALTER TABLE `rm_equipment` DISABLE KEYS */;
/*!40000 ALTER TABLE `rm_equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rm_room_equipment`
--

DROP TABLE IF EXISTS `rm_room_equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rm_room_equipment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `room_id` bigint(20) NOT NULL,
  `equipment_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rm_room_equipment`
--

LOCK TABLES `rm_room_equipment` WRITE;
/*!40000 ALTER TABLE `rm_room_equipment` DISABLE KEYS */;
/*!40000 ALTER TABLE `rm_room_equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rm_room_management`
--

DROP TABLE IF EXISTS `rm_room_management`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rm_room_management` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name_ar` mediumtext NOT NULL,
  `name_en` mediumtext NOT NULL,
  `room_number` int(11) DEFAULT NULL,
  `campus_id` bigint(20) NOT NULL,
  `college_id` bigint(20) NOT NULL,
  `room_type` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rm_room_management`
--

LOCK TABLES `rm_room_management` WRITE;
/*!40000 ALTER TABLE `rm_room_management` DISABLE KEYS */;
INSERT INTO `rm_room_management` VALUES (1,'room for discussing','room for discussing',1,0,1,5);
/*!40000 ALTER TABLE `rm_room_management` ENABLE KEYS */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Super Admin','[\"settings-manage\",\"settings-semester\",\"settings-standard\",\"settings-criteria\",\"settings-item\",\"settings-unit\",\"settings-campus\",\"settings-institution\",\"settings-college\",\"settings-department\",\"settings-degree\",\"settings-program\",\"settings-major\",\"settings-program_plan\",\"settings-course\",\"settings-course_section\",\"settings-user\",\"settings-role\",\"settings-login_as\",\"settings-notification\",\"settings-translation\",\"settings-jobs\",\"settings-accreditation_status\",\"setup-mission\",\"setup-vision\",\"setup-goal\",\"setup-objective\",\"doc_repo-list\",\"doc_repo-manage\",\"dashboard-national_accreditation\",\"dashboard-international_accreditation\",\"dashboard-status\",\"dashboard-kpi\",\"accreditation-list\",\"accreditation-manage\",\"accreditation-read\",\"accreditation-report\",\"accreditation-statistics\",\"advisory-list\",\"advisory-manage\",\"advisory-report\",\"alumni-list\",\"alumni-manage\",\"alumni-report\",\"assessment_loop-list\",\"assessment_loop-manage\",\"assessment_metric-list\",\"assessment_metric-manage\",\"assessment_metric-report\",\"award_management-list\",\"award_management-manage\",\"award_management-report\",\"committee_work-manage\",\"committee_work-report\",\"committee_work-list\",\"curriculum_mapping-list\",\"curriculum_mapping-manage\",\"curriculum_mapping-report\",\"curriculum_mapping-settings\",\"examination-list\",\"examination-manage\",\"examination-report\",\"faculty_performance-forms\",\"faculty_performance-settings\",\"faculty_performance-report\",\"faculty_portfolio-list\",\"faculty_portfolio-manage\",\"faculty_portfolio-report\",\"gradebook-list\",\"gradebook-manage\",\"industrial_skills-list\",\"industrial_skills-manage\",\"industrial_skills-report\",\"kpi-list\",\"kpi-manage\",\"kpi-report\",\"kpi-values\",\"kpi-settings\",\"meeting_minutes-manage\",\"meeting_minutes-list\",\"meeting_minutes-report\",\"policies_procedures-list\",\"policies_procedures-manage\",\"policies_procedures-report\",\"portfolio_course-list\",\"portfolio_course-manage\",\"portfolio_course-report\",\"program_tree-manage\",\"program_tree-edit\",\"program_tree-list\",\"project_management-list\",\"project_management-manage\",\"project_management-report\",\"report-list\",\"report-report\",\"risk_management-list\",\"risk_management-manage\",\"risk_management-report\",\"room_management-list\",\"room_management-manage\",\"rubrics-list\",\"rubrics-manage\",\"rubrics-report\",\"rubrics-admin\",\"skills_transcript-list\",\"skills_transcript-manage\",\"skills_transcript-report\",\"strategic_planning-list\",\"strategic_planning-manage\",\"strategic_planning-report\",\"student_portfolio-list\",\"student_portfolio-manage\",\"student_portfolio-report\",\"survey_courses-list\",\"survey_courses-manage\",\"survey_courses-report\",\"survey_courses-evaluation\",\"survey_faculty-list\",\"survey_faculty-manage\",\"survey_faculty-report\",\"survey_faculty-evaluation\",\"survey_staff-list\",\"survey_staff-manage\",\"survey_staff-report\",\"survey_staff-evaluation\",\"survey_alumni-list\",\"survey_alumni-manage\",\"survey_alumni-report\",\"survey_alumni-evaluation\",\"survey_employer-list\",\"survey_employer-manage\",\"survey_employer-report\",\"survey_employer-evaluation\",\"survey_training-list\",\"survey_training-manage\",\"survey_training-report\",\"survey_training-evaluation\",\"survey_advisory-list\",\"survey_advisory-manage\",\"survey_advisory-report\",\"survey_advisory-evaluation\",\"team_formation-manage\",\"team_formation-list\",\"training_management-list\",\"training_management-manage\",\"survey_students-list\",\"survey_students-manage\",\"survey_students-report\",\"survey_students-evaluation\"]',5),(2,'College Coordinator','[\"setup-mission\",\"setup-vision\",\"setup-goal\",\"setup-objective\",\"doc_repo-list\",\"doc_repo-manage\",\"dashboard-national_accreditation\",\"dashboard-international_accreditation\",\"dashboard-status\",\"dashboard-kpi\",\"accreditation-list\",\"accreditation-manage\",\"accreditation-read\",\"accreditation-report\",\"accreditation-statistics\",\"advisory-list\",\"advisory-manage\",\"advisory-report\",\"alumni-list\",\"alumni-manage\",\"alumni-report\",\"assessment_loop-list\",\"assessment_loop-manage\",\"assessment_metric-list\",\"assessment_metric-manage\",\"assessment_metric-report\",\"award_management-list\",\"award_management-manage\",\"award_management-report\",\"committee_work-manage\",\"committee_work-report\",\"committee_work-list\",\"curriculum_mapping-list\",\"curriculum_mapping-manage\",\"curriculum_mapping-report\",\"curriculum_mapping-settings\",\"examination-list\",\"examination-manage\",\"examination-report\",\"faculty_performance-forms\",\"faculty_performance-settings\",\"faculty_performance-report\",\"faculty_portfolio-list\",\"faculty_portfolio-manage\",\"faculty_portfolio-report\",\"gradebook-list\",\"gradebook-manage\",\"industrial_skills-list\",\"industrial_skills-manage\",\"industrial_skills-report\",\"kpi-list\",\"kpi-manage\",\"kpi-report\",\"kpi-values\",\"kpi-settings\",\"meeting_minutes-manage\",\"meeting_minutes-list\",\"meeting_minutes-report\",\"policies_procedures-list\",\"policies_procedures-manage\",\"policies_procedures-report\",\"portfolio_course-list\",\"portfolio_course-manage\",\"portfolio_course-report\",\"program_tree-manage\",\"program_tree-edit\",\"program_tree-list\",\"project_management-list\",\"project_management-manage\",\"project_management-report\",\"report-list\",\"report-report\",\"risk_management-list\",\"risk_management-manage\",\"risk_management-report\",\"room_management-list\",\"room_management-manage\",\"rubrics-list\",\"rubrics-manage\",\"rubrics-report\",\"rubrics-admin\",\"skills_transcript-list\",\"skills_transcript-manage\",\"skills_transcript-report\",\"strategic_planning-list\",\"strategic_planning-manage\",\"strategic_planning-report\",\"student_portfolio-list\",\"student_portfolio-manage\",\"student_portfolio-report\",\"survey_courses-list\",\"survey_courses-manage\",\"survey_courses-report\",\"survey_courses-evaluation\",\"survey_students-list\",\"survey_students-manage\",\"survey_students-report\",\"survey_students-evaluation\",\"survey_faculty-list\",\"survey_faculty-manage\",\"survey_faculty-report\",\"survey_faculty-evaluation\",\"survey_staff-list\",\"survey_staff-manage\",\"survey_staff-report\",\"survey_staff-evaluation\",\"survey_alumni-list\",\"survey_alumni-manage\",\"survey_alumni-report\",\"survey_alumni-evaluation\",\"survey_employer-list\",\"survey_employer-manage\",\"survey_employer-report\",\"survey_employer-evaluation\",\"survey_training-list\",\"survey_training-manage\",\"survey_training-report\",\"survey_training-evaluation\",\"survey_advisory-list\",\"survey_advisory-manage\",\"survey_advisory-report\",\"survey_advisory-evaluation\",\"team_formation-manage\",\"team_formation-list\",\"training_management-list\",\"training_management-manage\"]',4),(3,'Program Coordinator','[\"setup-mission\",\"setup-vision\",\"setup-goal\",\"setup-objective\",\"doc_repo-list\",\"doc_repo-manage\",\"dashboard-national_accreditation\",\"dashboard-international_accreditation\",\"dashboard-status\",\"dashboard-kpi\",\"accreditation-list\",\"accreditation-manage\",\"accreditation-read\",\"accreditation-report\",\"accreditation-statistics\",\"advisory-list\",\"advisory-manage\",\"advisory-report\",\"alumni-list\",\"alumni-manage\",\"alumni-report\",\"assessment_loop-list\",\"assessment_loop-manage\",\"assessment_metric-list\",\"assessment_metric-manage\",\"assessment_metric-report\",\"award_management-list\",\"award_management-manage\",\"award_management-report\",\"committee_work-manage\",\"committee_work-report\",\"committee_work-list\",\"curriculum_mapping-list\",\"curriculum_mapping-manage\",\"curriculum_mapping-report\",\"curriculum_mapping-settings\",\"examination-list\",\"examination-manage\",\"examination-report\",\"faculty_performance-forms\",\"faculty_performance-settings\",\"faculty_performance-report\",\"faculty_portfolio-list\",\"faculty_portfolio-manage\",\"faculty_portfolio-report\",\"gradebook-list\",\"gradebook-manage\",\"industrial_skills-list\",\"industrial_skills-manage\",\"industrial_skills-report\",\"kpi-list\",\"kpi-manage\",\"kpi-report\",\"kpi-values\",\"kpi-settings\",\"meeting_minutes-manage\",\"meeting_minutes-list\",\"meeting_minutes-report\",\"policies_procedures-list\",\"policies_procedures-manage\",\"policies_procedures-report\",\"portfolio_course-list\",\"portfolio_course-manage\",\"portfolio_course-report\",\"program_tree-manage\",\"program_tree-edit\",\"program_tree-list\",\"project_management-list\",\"project_management-manage\",\"project_management-report\",\"report-list\",\"report-report\",\"risk_management-list\",\"risk_management-manage\",\"risk_management-report\",\"room_management-list\",\"room_management-manage\",\"rubrics-list\",\"rubrics-manage\",\"rubrics-report\",\"rubrics-admin\",\"skills_transcript-list\",\"skills_transcript-manage\",\"skills_transcript-report\",\"strategic_planning-list\",\"strategic_planning-manage\",\"strategic_planning-report\",\"student_portfolio-list\",\"student_portfolio-manage\",\"student_portfolio-report\",\"survey_courses-list\",\"survey_courses-manage\",\"survey_courses-report\",\"survey_courses-evaluation\",\"survey_students-list\",\"survey_students-manage\",\"survey_students-report\",\"survey_students-evaluation\",\"survey_faculty-list\",\"survey_faculty-manage\",\"survey_faculty-report\",\"survey_faculty-evaluation\",\"survey_staff-list\",\"survey_staff-manage\",\"survey_staff-report\",\"survey_staff-evaluation\",\"survey_alumni-list\",\"survey_alumni-manage\",\"survey_alumni-report\",\"survey_alumni-evaluation\",\"survey_employer-list\",\"survey_employer-manage\",\"survey_employer-report\",\"survey_employer-evaluation\",\"survey_training-list\",\"survey_training-manage\",\"survey_training-report\",\"survey_training-evaluation\",\"survey_advisory-list\",\"survey_advisory-manage\",\"survey_advisory-report\",\"survey_advisory-evaluation\",\"team_formation-manage\",\"team_formation-list\",\"training_management-list\",\"training_management-manage\"]',2),(4,'Teacher','[\"accreditation-list\",\"accreditation-manage\",\"accreditation-read\",\"accreditation-report\",\"accreditation-statistics\",\"curriculum_mapping-list\",\"curriculum_mapping-manage\",\"curriculum_mapping-report\",\"curriculum_mapping-settings\",\"faculty_performance-forms\",\"faculty_performance-settings\",\"faculty_performance-report\",\"faculty_portfolio-list\",\"faculty_portfolio-manage\",\"faculty_portfolio-report\",\"portfolio_course-list\",\"portfolio_course-manage\",\"portfolio_course-report\",\"student_portfolio-list\",\"student_portfolio-manage\",\"student_portfolio-report\"]',1),(5,'Employee','[\"accreditation-list\",\"accreditation-manage\",\"accreditation-read\",\"accreditation-report\",\"accreditation-statistics\",\"advisory-list\",\"advisory-manage\",\"advisory-report\",\"alumni-list\",\"alumni-manage\",\"alumni-report\",\"assessment_loop-list\",\"assessment_loop-manage\",\"assessment_metric-list\",\"assessment_metric-manage\",\"assessment_metric-report\",\"award_management-list\",\"award_management-manage\",\"award_management-report\",\"committee_work-manage\",\"committee_work-report\",\"committee_work-list\",\"curriculum_mapping-list\",\"curriculum_mapping-manage\",\"curriculum_mapping-report\",\"curriculum_mapping-settings\",\"examination-list\",\"examination-manage\",\"examination-report\",\"faculty_performance-forms\",\"faculty_performance-settings\",\"faculty_performance-report\",\"faculty_portfolio-list\",\"faculty_portfolio-manage\",\"faculty_portfolio-report\",\"gradebook-list\",\"gradebook-manage\",\"industrial_skills-list\",\"industrial_skills-manage\",\"industrial_skills-report\",\"kpi-list\",\"kpi-manage\",\"kpi-report\",\"kpi-values\",\"kpi-settings\",\"meeting_minutes-manage\",\"meeting_minutes-list\",\"meeting_minutes-report\",\"policies_procedures-list\",\"policies_procedures-manage\",\"policies_procedures-report\",\"portfolio_course-list\",\"portfolio_course-manage\",\"portfolio_course-report\",\"program_tree-manage\",\"program_tree-edit\",\"program_tree-list\",\"project_management-list\",\"project_management-manage\",\"project_management-report\",\"report-list\",\"report-report\",\"risk_management-list\",\"risk_management-manage\",\"risk_management-report\",\"room_management-list\",\"room_management-manage\",\"rubrics-list\",\"rubrics-manage\",\"rubrics-report\",\"rubrics-admin\",\"skills_transcript-list\",\"skills_transcript-manage\",\"skills_transcript-report\",\"strategic_planning-list\",\"strategic_planning-manage\",\"strategic_planning-report\",\"student_portfolio-list\",\"student_portfolio-manage\",\"student_portfolio-report\",\"survey_courses-list\",\"survey_courses-manage\",\"survey_courses-report\",\"survey_courses-evaluation\",\"survey_students-list\",\"survey_students-manage\",\"survey_students-report\",\"survey_students-evaluation\",\"survey_faculty-list\",\"survey_faculty-manage\",\"survey_faculty-report\",\"survey_faculty-evaluation\",\"survey_staff-list\",\"survey_staff-manage\",\"survey_staff-report\",\"survey_staff-evaluation\",\"survey_alumni-list\",\"survey_alumni-manage\",\"survey_alumni-report\",\"survey_alumni-evaluation\",\"survey_employer-list\",\"survey_employer-manage\",\"survey_employer-report\",\"survey_employer-evaluation\",\"survey_training-list\",\"survey_training-manage\",\"survey_training-report\",\"survey_training-evaluation\",\"survey_advisory-list\",\"survey_advisory-manage\",\"survey_advisory-report\",\"survey_advisory-evaluation\",\"team_formation-manage\",\"team_formation-list\",\"training_management-list\",\"training_management-manage\"]',1),(6,'Reviewer','[\"accreditation-list\",\"accreditation-manage\",\"accreditation-read\",\"accreditation-report\",\"accreditation-statistics\",\"advisory-list\",\"advisory-manage\",\"advisory-report\",\"alumni-list\",\"alumni-manage\",\"alumni-report\",\"assessment_loop-list\",\"assessment_loop-manage\",\"assessment_metric-list\",\"assessment_metric-manage\",\"assessment_metric-report\",\"award_management-list\",\"award_management-manage\",\"award_management-report\",\"committee_work-manage\",\"committee_work-report\",\"committee_work-list\",\"curriculum_mapping-list\",\"curriculum_mapping-manage\",\"curriculum_mapping-report\",\"curriculum_mapping-settings\",\"examination-list\",\"examination-manage\",\"examination-report\",\"faculty_performance-forms\",\"faculty_performance-settings\",\"faculty_performance-report\",\"faculty_portfolio-list\",\"faculty_portfolio-manage\",\"faculty_portfolio-report\",\"gradebook-list\",\"gradebook-manage\",\"industrial_skills-list\",\"industrial_skills-manage\",\"industrial_skills-report\",\"kpi-list\",\"kpi-manage\",\"kpi-report\",\"kpi-values\",\"kpi-settings\",\"meeting_minutes-manage\",\"meeting_minutes-list\",\"meeting_minutes-report\",\"policies_procedures-list\",\"policies_procedures-manage\",\"policies_procedures-report\",\"portfolio_course-list\",\"portfolio_course-manage\",\"portfolio_course-report\",\"program_tree-manage\",\"program_tree-edit\",\"program_tree-list\",\"project_management-list\",\"project_management-manage\",\"project_management-report\",\"report-list\",\"report-report\",\"risk_management-list\",\"risk_management-manage\",\"risk_management-report\",\"rubrics-list\",\"rubrics-manage\",\"rubrics-report\",\"rubrics-admin\",\"room_management-list\",\"room_management-manage\",\"skills_transcript-list\",\"skills_transcript-manage\",\"skills_transcript-report\",\"strategic_planning-list\",\"strategic_planning-manage\",\"strategic_planning-report\",\"student_portfolio-list\",\"student_portfolio-manage\",\"student_portfolio-report\",\"survey_courses-list\",\"survey_courses-manage\",\"survey_courses-report\",\"survey_courses-evaluation\",\"survey_students-list\",\"survey_students-manage\",\"survey_students-report\",\"survey_students-evaluation\",\"survey_faculty-list\",\"survey_faculty-manage\",\"survey_faculty-report\",\"survey_faculty-evaluation\",\"survey_staff-list\",\"survey_staff-manage\",\"survey_staff-report\",\"survey_staff-evaluation\",\"survey_alumni-list\",\"survey_alumni-manage\",\"survey_alumni-report\",\"survey_alumni-evaluation\",\"survey_employer-list\",\"survey_employer-manage\",\"survey_employer-report\",\"survey_employer-evaluation\",\"survey_training-list\",\"survey_training-manage\",\"survey_training-report\",\"survey_training-evaluation\",\"survey_advisory-list\",\"survey_advisory-manage\",\"survey_advisory-report\",\"survey_advisory-evaluation\",\"team_formation-manage\",\"team_formation-list\",\"training_management-list\",\"training_management-manage\"]',1);
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
  `integration_id` varchar(100) NOT NULL DEFAULT '0',
  `year` int(11) NOT NULL DEFAULT '0',
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `name_en` varchar(255) NOT NULL DEFAULT '',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `name_ar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `semester`
--

LOCK TABLES `semester` WRITE;
/*!40000 ALTER TABLE `semester` DISABLE KEYS */;
INSERT INTO `semester` VALUES (1,'0',2019,'2019-01-01','2019-04-01','current semester',0,'الفصل الحالي'),(2,'0',2018,'2018-08-01','2018-12-01','previous semester',0,'الفصل السابق');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_action_plan`
--

LOCK TABLES `sp_action_plan` WRITE;
/*!40000 ALTER TABLE `sp_action_plan` DISABLE KEYS */;
INSERT INTO `sp_action_plan` VALUES (1,1,1,'action plan 1 to take care about it ','action plan 1 to take care about it ','2019-03-13','2019-03-18',20.00,NULL,0,0),(2,1,3,'action plan 2 to start','action plan 2 to start','2019-03-13','2019-03-30',100.00,NULL,50,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_action_plan_recommend`
--

LOCK TABLES `sp_action_plan_recommend` WRITE;
/*!40000 ALTER TABLE `sp_action_plan_recommend` DISABLE KEYS */;
INSERT INTO `sp_action_plan_recommend` VALUES (1,2,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_activity`
--

LOCK TABLES `sp_activity` WRITE;
/*!40000 ALTER TABLE `sp_activity` DISABLE KEYS */;
INSERT INTO `sp_activity` VALUES (1,1,'activity one here','activity one here','2019-03-20','2019-03-23',10,50,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_goal`
--

LOCK TABLES `sp_goal` WRITE;
/*!40000 ALTER TABLE `sp_goal` DISABLE KEYS */;
INSERT INTO `sp_goal` VALUES (1,18,1,0,1,2,'our goal ,, to make all students deal with system in easy way','our goal ,, to make all students deal with system in easy way','1111',25,0),(2,18,2,0,1,2,'add new one to integrate in strategic planning','add new one to integrate in strategic planning','1.2.3',0,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_goal_goal`
--

LOCK TABLES `sp_goal_goal` WRITE;
/*!40000 ALTER TABLE `sp_goal_goal` DISABLE KEYS */;
INSERT INTO `sp_goal_goal` VALUES (1,1,1,'Orm_Institution_Goal'),(2,2,2,'Orm_Institution_Goal');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_initiative`
--

LOCK TABLES `sp_initiative` WRITE;
/*!40000 ALTER TABLE `sp_initiative` DISABLE KEYS */;
INSERT INTO `sp_initiative` VALUES (1,2,4,'2019-03-13','2019-03-31','111','initiative one to display here','initiative one to display here',25,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_initiative_milestone`
--

LOCK TABLES `sp_initiative_milestone` WRITE;
/*!40000 ALTER TABLE `sp_initiative_milestone` DISABLE KEYS */;
INSERT INTO `sp_initiative_milestone` VALUES (1,1,2019,2020.00);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_kpi`
--

LOCK TABLES `sp_kpi` WRITE;
/*!40000 ALTER TABLE `sp_kpi` DISABLE KEYS */;
INSERT INTO `sp_kpi` VALUES (1,34,1,'Orm_Sp_Initiative',1,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_objective`
--

LOCK TABLES `sp_objective` WRITE;
/*!40000 ALTER TABLE `sp_objective` DISABLE KEYS */;
INSERT INTO `sp_objective` VALUES (2,18,1,2,0,1,2,'4444','it\'s new objective to take seriously in strategic planning','it\'s new objective to take seriously in strategic planning','2019-03-12','2019-04-18','dsasadas','dsadsadasd',3,200,'',25,0),(4,18,2,4,0,1,2,'66666','objective displayed in strategic plan','objective displayed in strategic plan','2019-04-26','2019-05-24','sadasdsd','sadsadsad',4,0,'',0,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_objective_objective`
--

LOCK TABLES `sp_objective_objective` WRITE;
/*!40000 ALTER TABLE `sp_objective_objective` DISABLE KEYS */;
INSERT INTO `sp_objective_objective` VALUES (1,1,1,'Orm_Institution_Objective'),(2,2,2,'Orm_Institution_Objective'),(3,3,3,'Orm_Institution_Objective'),(4,4,4,'Orm_Institution_Objective');
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
  `perspective` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_objective_perspective`
--

LOCK TABLES `sp_objective_perspective` WRITE;
/*!40000 ALTER TABLE `sp_objective_perspective` DISABLE KEYS */;
INSERT INTO `sp_objective_perspective` VALUES (1,2,1),(2,4,2);
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
-- Table structure for table `sp_perspective`
--

DROP TABLE IF EXISTS `sp_perspective`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_perspective` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_perspective`
--

LOCK TABLES `sp_perspective` WRITE;
/*!40000 ALTER TABLE `sp_perspective` DISABLE KEYS */;
INSERT INTO `sp_perspective` VALUES (1,'perpective 1','perspective1'),(2,'perspective 2','perspective 2');
/*!40000 ALTER TABLE `sp_perspective` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_project`
--

LOCK TABLES `sp_project` WRITE;
/*!40000 ALTER TABLE `sp_project` DISABLE KEYS */;
INSERT INTO `sp_project` VALUES (1,2,1,0,1,2,'project 1 to start with','project 1 to start with','2019-03-13','2019-03-30',50.00,'asdsadsa','adsdasd','asdasd',50,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_recommendation`
--

LOCK TABLES `sp_recommendation` WRITE;
/*!40000 ALTER TABLE `sp_recommendation` DISABLE KEYS */;
INSERT INTO `sp_recommendation` VALUES (1,1,5,2019,'we need to improve this course as soon as possible','we need to improve this course as soon as possible');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_recommendation_type`
--

LOCK TABLES `sp_recommendation_type` WRITE;
/*!40000 ALTER TABLE `sp_recommendation_type` DISABLE KEYS */;
INSERT INTO `sp_recommendation_type` VALUES (1,'improve this program and accelerate to do it','improve this program and accelerate to do it','45678');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_risk_tab`
--

LOCK TABLES `sp_risk_tab` WRITE;
/*!40000 ALTER TABLE `sp_risk_tab` DISABLE KEYS */;
INSERT INTO `sp_risk_tab` VALUES (1,1,'Orm_Sp_Initiative','maybe we wanna be late after that','maybe we wanna be late after that'),(2,1,'Orm_Sp_Action_Plan','risk to increase budget for the action plan','risk to increase budget for the action plan'),(3,1,'Orm_Sp_Project','maybe it will fail in the future','maybe it will fail in the future');
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
  `start_year` int(11) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_strategy`
--

LOCK TABLES `sp_strategy` WRITE;
/*!40000 ALTER TABLE `sp_strategy` DISABLE KEYS */;
INSERT INTO `sp_strategy` VALUES (1,1,0,1,34,'Orm_Sp_Strategy_Institution',0,2019,2020,'Jadeer','جدير','','','','','strategy project for strateging','strategy project for strateging',0,0),(2,1,1,2,13,'Orm_Sp_Strategy_College',1,0,2020,'Al Huson University College','كلية الحصن الجامعية','','','','','','',0,0),(3,1,2,3,4,'Orm_Sp_Strategy_Program',8,0,2020,'civil Engineering','الهندسة المدنية','','','','','','',0,0),(4,1,2,5,6,'Orm_Sp_Strategy_Program',10,0,2020,'Communication Engineering','هندسة الاتصالات','','','','','','',0,0),(5,1,2,7,8,'Orm_Sp_Strategy_Program',5,0,2020,'Computer Science Program','برنامج علم الحاسوب','','','','','','',0,0),(6,1,2,9,10,'Orm_Sp_Strategy_Program',11,0,2020,'Industrial Engineering','الهندسة الصناعية','','','','','','',0,0),(7,1,2,11,12,'Orm_Sp_Strategy_Program',9,0,2020,'Mechanical Engineering Program','هندسة الميكانيك','','','','','','',0,0),(8,1,1,14,17,'Orm_Sp_Strategy_College',4,0,2020,'pharmacy college','كلية الصيدلة ','','','','','','',0,0),(9,1,8,15,16,'Orm_Sp_Strategy_Program',7,0,2020,'pharmacy program','برنامج الصيدلة','','','','','','',0,0),(10,1,1,18,21,'Orm_Sp_Strategy_College',3,0,2020,'press college Saud college ','كلية الأعلام جامعة الملك سعود','','','','','','',0,0),(11,1,10,19,20,'Orm_Sp_Strategy_Program',12,0,2020,'press and media','الصحافة و اﻷعلام','','','','','','',0,0),(12,1,1,22,25,'Orm_Sp_Strategy_College',2,0,2020,'prince ghazi college for information technology','كلية اﻷمير غازي لتكنولوجيا المعلومات','','','','','','',0,0),(13,1,12,23,24,'Orm_Sp_Strategy_Program',6,0,2020,'Computer Information system','نظم المعلومات الحاسوبية','','','','','','',0,0),(14,1,1,26,27,'Orm_Sp_Strategy_Unit',1,0,2020,'Assem Al Jimzawi','عاصم الجمزاوي','','','','','','',0,0),(15,1,1,28,29,'Orm_Sp_Strategy_Unit',2,0,2020,'isamaeel vice rector','اسماعيل نائب رئيس الفجامعة','','','','','','',0,0),(16,1,1,30,31,'Orm_Sp_Strategy_Unit',3,0,2020,'vice rector for prince ghazi college','نائب العميد لكلية اﻷمير غازي','','','','','','',0,0),(17,1,1,32,33,'Orm_Sp_Strategy_Unit',4,0,2020,'msharee vise rector for ksu campus','مشاري نائب العميد للأعلام','','','','','','',0,0),(18,18,0,1,34,'Orm_Sp_Strategy_Institution',0,2021,2023,'Jadeer','جدير','our vision to deal with jadeer in a very good way','our vision to deal with jadeer in a very good way','mission to be best system and institution around the world','mission to be best system and institution around the world','it\'s new strategic plan created by pharmacy college coordinator','it\'s new strategic plan created by pharmacy college coordinator',12.5,0),(19,18,18,2,13,'Orm_Sp_Strategy_College',1,0,2023,'Al Huson University College','كلية الحصن الجامعية','','','','','','',0,0),(20,18,19,3,4,'Orm_Sp_Strategy_Program',8,0,2023,'civil Engineering','الهندسة المدنية','','','','','','',0,0),(21,18,19,5,6,'Orm_Sp_Strategy_Program',10,0,2023,'Communication Engineering','هندسة الاتصالات','','','','','','',0,0),(22,18,19,7,8,'Orm_Sp_Strategy_Program',5,0,2023,'Computer Science Program','برنامج علم الحاسوب','','','','','','',0,0),(23,18,19,9,10,'Orm_Sp_Strategy_Program',11,0,2023,'Industrial Engineering','الهندسة الصناعية','','','','','','',0,0),(24,18,19,11,12,'Orm_Sp_Strategy_Program',9,0,2023,'Mechanical Engineering Program','هندسة الميكانيك','','','','','','',0,0),(25,18,18,14,17,'Orm_Sp_Strategy_College',4,0,2023,'pharmacy college','كلية الصيدلة ','','','','','','',0,0),(26,18,25,15,16,'Orm_Sp_Strategy_Program',7,0,2023,'pharmacy program','برنامج الصيدلة','','','','','','',0,0),(27,18,18,18,21,'Orm_Sp_Strategy_College',3,0,2023,'press college Saud college ','كلية الأعلام جامعة الملك سعود','','','','','','',0,0),(28,18,27,19,20,'Orm_Sp_Strategy_Program',12,0,2023,'press and media','الصحافة و اﻷعلام','','','','','','',0,0),(29,18,18,22,25,'Orm_Sp_Strategy_College',2,0,2023,'prince ghazi college for information technology','كلية اﻷمير غازي لتكنولوجيا المعلومات','','','','','','',0,0),(30,18,29,23,24,'Orm_Sp_Strategy_Program',6,0,2023,'Computer Information system','نظم المعلومات الحاسوبية','','','','','','',0,0),(31,18,18,26,27,'Orm_Sp_Strategy_Unit',1,0,2023,'Assem Al Jimzawi','عاصم الجمزاوي','','','','','','',0,0),(32,18,18,28,29,'Orm_Sp_Strategy_Unit',2,0,2023,'isamaeel vice rector','اسماعيل نائب رئيس الفجامعة','','','','','','',0,0),(33,18,18,30,31,'Orm_Sp_Strategy_Unit',3,0,2023,'vice rector for prince ghazi college','نائب العميد لكلية اﻷمير غازي','','','','','','',0,0),(34,18,18,32,33,'Orm_Sp_Strategy_Unit',4,0,2023,'msharee vise rector for ksu campus','مشاري نائب العميد للأعلام','','','','','','',0,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_values`
--

LOCK TABLES `sp_values` WRITE;
/*!40000 ALTER TABLE `sp_values` DISABLE KEYS */;
INSERT INTO `sp_values` VALUES (1,18,'strategic plan for the project is here ','strategic plan for the project is here ','value is here to be inserted','value is here to be inserted');
/*!40000 ALTER TABLE `sp_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sst_criteria`
--

DROP TABLE IF EXISTS `sst_criteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sst_criteria` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `group_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sst_criteria`
--

LOCK TABLES `sst_criteria` WRITE;
/*!40000 ALTER TABLE `sst_criteria` DISABLE KEYS */;
/*!40000 ALTER TABLE `sst_criteria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sst_criteria_map`
--

DROP TABLE IF EXISTS `sst_criteria_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sst_criteria_map` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `criteria_id` bigint(20) NOT NULL DEFAULT '0',
  `rubric_skill_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sst_criteria_map`
--

LOCK TABLES `sst_criteria_map` WRITE;
/*!40000 ALTER TABLE `sst_criteria_map` DISABLE KEYS */;
/*!40000 ALTER TABLE `sst_criteria_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sst_group`
--

DROP TABLE IF EXISTS `sst_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sst_group` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `creator_id` bigint(20) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sst_group`
--

LOCK TABLES `sst_group` WRITE;
/*!40000 ALTER TABLE `sst_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `sst_group` ENABLE KEYS */;
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
-- Table structure for table `stp_skill`
--

DROP TABLE IF EXISTS `stp_skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stp_skill` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `skill_name_en` varchar(45) DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `attachment` varchar(128) DEFAULT NULL,
  `skill_name_ar` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stp_skill`
--

LOCK TABLES `stp_skill` WRITE;
/*!40000 ALTER TABLE `stp_skill` DISABLE KEYS */;
/*!40000 ALTER TABLE `stp_skill` ENABLE KEYS */;
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
  `integration_id` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_status`
--

LOCK TABLES `student_status` WRITE;
/*!40000 ALTER TABLE `student_status` DISABLE KEYS */;
INSERT INTO `student_status` VALUES (1,'تخرج','graduated',''),(2,'مازال يدرس','still studing',''),(3,'التأخر في التخرج','late in graduate','');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_status_log`
--

LOCK TABLES `student_status_log` WRITE;
/*!40000 ALTER TABLE `student_status_log` DISABLE KEYS */;
INSERT INTO `student_status_log` VALUES (1,2,1,1,'2019-01-12'),(2,3,2,1,'2019-01-12'),(3,4,3,1,'2019-01-12'),(4,5,2,1,'2019-01-12'),(5,6,1,1,'2019-01-12'),(6,7,1,1,'2019-01-12'),(7,8,2,1,'2019-01-12'),(8,9,2,1,'2019-01-12');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey`
--

LOCK TABLES `survey` WRITE;
/*!40000 ALTER TABLE `survey` DISABLE KEYS */;
INSERT INTO `survey` VALUES (1,'dddd','dddd',1,'2019-01-10 23:19:14','2019-01-12 21:25:03',11,1),(2,'survey for AI course','survey for AI course',1,'2019-01-15 15:36:41','2019-01-17 13:39:06',8,0),(3,'student survey','student survey',1,'2019-01-15 23:20:38','2019-01-16 10:32:18',1,0),(4,'faculty survey','faculty survey',1,'2019-01-15 23:55:31','2019-01-15 23:55:31',2,0),(5,'ffff','fffff',1,'2019-01-16 00:07:05','2019-01-16 00:07:05',3,0),(6,'almuni','almuni',22,'2019-01-16 00:22:18','2019-01-16 00:22:18',4,0),(7,'iiiiiiiiiii','iiiiiiiii',1,'2019-01-16 00:39:03','2019-01-16 00:39:03',4,0),(8,'rrrrrrr Survey','rrrrrrrr Survey',1,'2019-01-16 01:01:01','2019-01-16 01:01:01',9,0),(9,'rrrrrrr Survey','rrrrrrrr Survey',1,'2019-01-16 01:01:01','2019-01-16 01:01:01',10,0),(10,'sdffffff Survey','ffdsffffffds Survey',1,'2019-01-16 01:03:37','2019-01-16 01:03:37',9,0),(11,'sdffffff Survey','ffdsffffffds Survey',1,'2019-01-16 01:03:37','2019-01-16 01:03:37',10,0),(12,'student 2 survey','student 2 survey',1,'2019-01-16 10:00:14','2019-01-16 10:00:14',1,0);
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
  `start` int(11) DEFAULT NULL,
  `end` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_evaluation`
--

LOCK TABLES `survey_evaluation` WRITE;
/*!40000 ALTER TABLE `survey_evaluation` DISABLE KEYS */;
INSERT INTO `survey_evaluation` VALUES (1,2,1,'AI','الذكاء اﻷصناعي','{\"course_id\":\"6\"}',1,'2019-01-15 16:32:41','2019-01-17 13:37:32',0,0),(2,2,1,'introduction to computer science','مقدمة الى تكنولوجيا المعلومات','{\"course_id\":\"1\"}',1,'2019-01-15 16:32:42','2019-01-17 13:37:32',0,0),(3,2,1,'java','جافا','{\"course_id\":\"8\"}',1,'2019-01-15 16:32:42','2019-01-17 13:40:02',1547724600,1547726400),(4,2,1,'medicine reports','تقارير اﻷدوية','{\"course_id\":\"3\"}',1,'2019-01-15 16:32:42','2019-01-17 13:37:32',0,0),(5,2,1,'soil analysis','تحليل التربة','{\"course_id\":\"9\"}',1,'2019-01-15 16:32:42','2019-01-17 13:37:32',0,0),(6,2,1,'press 1','الصحافة 1','{\"course_id\":\"5\"}',1,'2019-01-15 16:50:17','2019-01-17 13:37:32',0,0),(7,3,1,'eavava','asfasfdsad','{\"college_id\":\"\",\"department_id\":\"\",\"program_id\":\"\",\"class_type\":\"Orm_User_Student\",\"course_id\":\"\",\"section_id\":\"\"}',1,'2019-01-15 23:26:35','2019-01-16 10:34:01',1547627400,1547635500),(8,4,1,'eval faculty','eval faculty','{\"college_id\":\"\",\"department_id\":\"\",\"program_id\":\"\",\"class_type\":\"Orm_User_Faculty\"}',1,'2019-01-15 23:58:35','2019-01-15 23:58:35',1547589900,1547590500),(9,4,1,'','','{\"campus_in\":2,\"college_id\":1,\"department_id\":\"\",\"program_id\":\"\",\"class_type\":\"Orm_User_Faculty\"}',10,'2019-01-16 00:05:36','2019-01-16 00:05:36',1547590500,1547591400),(10,5,1,'dsfsd','fssdfsdf','{\"college_id\":\"\",\"department_id\":\"\",\"program_id\":\"\",\"class_type\":\"Orm_User_Staff\",\"unit_id\":\"0\"}',1,'2019-01-16 00:08:40','2019-01-16 00:08:40',1547589600,1547591400),(11,5,1,'bbbbbbbbbbb','bbbbbbbbbbbbbbbbbb','{\"college_id\":\"\",\"department_id\":\"\",\"program_id\":\"\",\"class_type\":\"Orm_User_Staff\",\"unit_id\":\"0\"}',20,'2019-01-16 00:13:36','2019-01-16 00:13:36',1547589600,1547591400),(12,6,1,'uuuuuuuu','uuuuuuuuuuuuuuuuuuuu','{\"college_id\":2,\"department_id\":\"\",\"program_id\":\"\",\"class_type\":\"Orm_User_Alumni\",\"graduated\":\"\",\"campus_in\":2}',22,'2019-01-16 00:24:06','2019-01-16 00:24:06',1547590500,1547591400),(13,7,1,'lllllllllll','kkkkkkkkkk','{\"college_id\":\"\",\"department_id\":\"\",\"program_id\":\"\",\"class_type\":\"Orm_User_Alumni\",\"graduated\":\"\"}',1,'2019-01-16 00:40:08','2019-01-16 14:33:05',1547591400,1547593200);
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
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_evaluator`
--

LOCK TABLES `survey_evaluator` WRITE;
/*!40000 ALTER TABLE `survey_evaluator` DISABLE KEYS */;
INSERT INTO `survey_evaluator` VALUES (1,1,2,'c673f7bdc430eaa8b91932d28cbef05b',0,'0000-00-00 00:00:00'),(2,1,3,'1b534a4192247476fc2783dae2124bc1',0,'0000-00-00 00:00:00'),(3,1,4,'cef69cb1f3c6d70700410f4dabdb7a08',0,'0000-00-00 00:00:00'),(4,1,8,'dddd1421abb8d65855b9ad6816ea473a',0,'0000-00-00 00:00:00'),(5,2,3,'46637a22de9da494868b6a0f6bcdc496',0,'0000-00-00 00:00:00'),(6,2,4,'f7fc3de3eb52460218861895c0c26f14',0,'0000-00-00 00:00:00'),(7,2,6,'e80ed1e70c71fff6b721f7b09fd3cb6a',0,'0000-00-00 00:00:00'),(8,2,8,'41a0cb0732fec1febe8eb8a547a971c5',0,'0000-00-00 00:00:00'),(9,3,2,'9a9f4391f9e541a01716799a0b563c78',0,'0000-00-00 00:00:00'),(10,3,3,'6b823a30783f69f3b8ffd0f2aa051cc2',0,'0000-00-00 00:00:00'),(11,3,5,'8b7839a6c4f28b4260fa4ec6621ac18d',0,'0000-00-00 00:00:00'),(12,3,6,'9cec12a9bdce6cba43af12fc9ad3cb1c',1,'2019-01-17 13:40:40'),(13,3,7,'bf9ae3db88afb0374fdda0fed76ff345',0,'0000-00-00 00:00:00'),(14,4,2,'61c79dcba2c18a042e72da87e656e108',0,'0000-00-00 00:00:00'),(15,4,3,'c63f96f1f69b8de76542990c9073e9dc',0,'0000-00-00 00:00:00'),(16,5,2,'284e71c2b74ac56f51ffd58b5e640a5e',0,'0000-00-00 00:00:00'),(17,5,5,'43c9b567a8072df4100ad1c0764a2379',0,'0000-00-00 00:00:00'),(18,5,6,'553e06e9ddb62f3d92f543172c5d4285',0,'0000-00-00 00:00:00'),(19,5,7,'90c390492c05f07963cb46be90236174',0,'0000-00-00 00:00:00'),(20,6,2,'8ac60fbfc0873a8caa3c178c7a8efe39',0,'0000-00-00 00:00:00'),(21,6,4,'e1ea67cf120d80e0f2b0ef88153e922c',0,'0000-00-00 00:00:00'),(22,6,7,'96cf22c57d60f2f212c9efed39421bc5',0,'0000-00-00 00:00:00'),(23,7,2,'13d2a819582b7c8ef4af6d2cd20a4e81',1,'2019-01-15 23:41:45'),(24,7,3,'17f17b51ab569335b4cee884cb94bf82',1,'2019-01-15 23:41:09'),(25,7,4,'0c49de94b192c8fa503eb2ed8f0bb61a',1,'2019-01-15 23:43:21'),(26,7,5,'4e46c1d835486b1d4d4f2cba24a6d797',1,'2019-01-15 23:45:15'),(27,7,6,'e69b458778838a50e079a303c50dc832',0,'0000-00-00 00:00:00'),(28,7,7,'e8fc5901d181716ca1c4e3b1965ef990',0,'0000-00-00 00:00:00'),(29,7,8,'bf986ab0b238b51bf5fde12a75148e43',1,'2019-01-16 10:36:36'),(30,7,9,'c6968e85e09bf58328aa7d7f5f0af88a',0,'0000-00-00 00:00:00'),(31,8,10,'d41742f0b0f700773fa2f2ad3c58b97a',0,'0000-00-00 00:00:00'),(32,8,11,'aa2e08ee7ac45c3e21806098d8be3bcc',0,'0000-00-00 00:00:00'),(33,8,12,'4588caca8750cc6db09e59b36dc4d5e6',0,'0000-00-00 00:00:00'),(34,8,13,'7395f312cfea261ae8c62dd4af043885',0,'0000-00-00 00:00:00'),(35,8,14,'b93a3595039b5f76c3fa5f6810a8e05b',0,'0000-00-00 00:00:00'),(36,8,15,'0b804636614c3bd65d15735921f6ad9f',0,'0000-00-00 00:00:00'),(37,8,16,'073f795c543fdc63c91f3d90707fcec0',0,'0000-00-00 00:00:00'),(38,8,17,'c7adacb0e4714e4551c7f5eae55c9e7d',0,'0000-00-00 00:00:00'),(39,8,18,'961db1132eed0ab711664463c0d3f4b9',0,'0000-00-00 00:00:00'),(40,8,19,'57535a3fffd9328f8478fa1423d14c52',0,'0000-00-00 00:00:00'),(41,10,1,'edae2f09b6ec3af13c45a26d27031b87',1,'2019-01-16 00:09:54'),(42,10,20,'0e6e18ce4f5f0f9b7c597c61bf1a55d8',1,'2019-01-16 00:10:37'),(43,10,21,'e8619910abd4fb996f1b7a1606ca0107',0,'0000-00-00 00:00:00'),(44,10,22,'0ebaa50f3ca9e5439e8638781b2dc050',0,'0000-00-00 00:00:00'),(45,10,23,'fccd8cb9fb910d32e95401faf1577fea',0,'0000-00-00 00:00:00'),(46,10,24,'e3f62ebc65f12014fb3c075b756bdbd5',0,'0000-00-00 00:00:00'),(47,10,25,'0f9216652b6e0821d0b69adc02a17808',0,'0000-00-00 00:00:00'),(48,10,26,'b26cf0dff95cae54ec907249e1a3d060',0,'0000-00-00 00:00:00'),(49,10,27,'bd7bf087309c87a0ff4c7d33f3deb32a',0,'0000-00-00 00:00:00'),(50,10,28,'d50f7052710c968b128df0ef2feb41fc',0,'0000-00-00 00:00:00'),(51,10,29,'3b193c40cc746313c82f03860e41993c',1,'2019-01-16 00:09:16'),(52,10,30,'d59da2aedfd09696fca0c77a2f509940',0,'0000-00-00 00:00:00'),(53,10,31,'6690f00b864b4e655762191ceeb49dbd',0,'0000-00-00 00:00:00'),(54,11,1,'ca6e7684f94c8f5157f891f1479a72dd',1,'2019-01-16 00:24:35'),(55,11,20,'b2a166089ef9b4880c27ee07fc012a0c',0,'0000-00-00 00:00:00'),(56,11,21,'d20cbabebf120d6d3946a1eea4ec6aa7',0,'0000-00-00 00:00:00'),(57,11,22,'563898b7baa39e614d7549c30f80c6f5',1,'2019-01-16 00:15:22'),(58,11,23,'ca68e9ef306acc4790bbda44052d9115',0,'0000-00-00 00:00:00'),(59,11,24,'b5fff28dc63af1b5abd281d465438e01',0,'0000-00-00 00:00:00'),(60,11,25,'708abba16a757ce8217b59ea2fd44611',0,'0000-00-00 00:00:00'),(61,11,26,'d3638099ea9be66a0c7d0bd5f50c7bf6',0,'0000-00-00 00:00:00'),(62,11,27,'a21798339703c4c80e8f305465870317',0,'0000-00-00 00:00:00'),(63,11,28,'cb0fd30292af60e9529b541b2ed282b9',0,'0000-00-00 00:00:00'),(64,11,29,'97e60ebbdf3bf54cdea031a8d12c52bb',0,'0000-00-00 00:00:00'),(65,11,30,'07cc52a81a604448dc76502ec06fb8d2',0,'0000-00-00 00:00:00'),(66,11,31,'9a76a8f938b4125166321aae792bff50',0,'0000-00-00 00:00:00'),(67,13,33,'90e3da2bd7fb173fab12a5e0ca182626',0,'0000-00-00 00:00:00'),(68,13,34,'daa44f8351a7378878cb33ba7f5dc131',0,'0000-00-00 00:00:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_page`
--

LOCK TABLES `survey_page` WRITE;
/*!40000 ALTER TABLE `survey_page` DISABLE KEYS */;
INSERT INTO `survey_page` VALUES (1,1,'','','','',1),(2,2,'','','','',1),(4,2,'','','','',2),(5,3,'','','','',1),(6,4,'','','','',1),(7,5,'','','','',1),(8,6,'','','','',1),(9,7,'','','','',1),(10,8,'','','','',1),(11,9,'','','','',1),(12,10,'','','','',1),(13,11,'','','','',1),(14,12,'','','','',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_question`
--

LOCK TABLES `survey_question` WRITE;
/*!40000 ALTER TABLE `survey_question` DISABLE KEYS */;
INSERT INTO `survey_question` VALUES (1,2,'Orm_Survey_Question_Type_Textarea','what you know about Artificial Intelligence course','what you know about Artificial Intelligence course','','',1,1),(2,4,'Orm_Survey_Question_Type_Radio','Artificial intelligence belong to ?','Artificial intelligence belong to ?','','',1,1),(3,2,'Orm_Survey_Question_Type_Checkbox','how can we use AI in our life ?','how can we use AI in our life ?','','',3,0),(5,4,'Orm_Survey_Question_Type_Factors_And_Statements','evaluation for AI Doctors course ','agree','','',2,1),(6,5,'Orm_Survey_Question_Type_Textarea','what is your filed','what is your filed','','',1,0),(7,5,'Orm_Survey_Question_Type_Factors_And_Statements','adasd','asdasdasd','','',2,0),(8,6,'Orm_Survey_Question_Type_Textarea','survey good','survey good','','',1,0),(9,6,'Orm_Survey_Question_Type_Factors_And_Statements','faculty','faculty','','',2,0),(10,7,'Orm_Survey_Question_Type_Factors_And_Statements','ffffffffff','ffffffff','','',1,0),(11,8,'Orm_Survey_Question_Type_Factors_And_Statements','dsasadssadvcxvcxvcxvcxv','sadsasdafcvcxvcxvcxvcxvcx','','',1,0),(12,9,'Orm_Survey_Question_Type_Factors_And_Statements','iiiiiiiiiiiii','iiiiiiiiiiiiiiiiiiii','','',1,0),(13,12,'Orm_Survey_Question_Type_Textarea','asdasd','asdasdasd','','',1,0),(14,10,'Orm_Survey_Question_Type_Textarea','xczds','dsfsda','','',1,0),(15,14,'Orm_Survey_Question_Type_Textarea','survey two for students','survey two for students','','',1,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_question_choice`
--

LOCK TABLES `survey_question_choice` WRITE;
/*!40000 ALTER TABLE `survey_question_choice` DISABLE KEYS */;
INSERT INTO `survey_question_choice` VALUES (1,2,'computer science program','computer science program'),(2,2,'civil engineer','civil engineer'),(3,2,'industrial engineer','industrial engineer'),(4,3,'for learning','for learning'),(5,3,'to make robots ','to make robots '),(6,3,'for cooking','for cooking'),(7,3,'to clean kitchen ground','to clean kitchen ground');
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_question_factor`
--

LOCK TABLES `survey_question_factor` WRITE;
/*!40000 ALTER TABLE `survey_question_factor` DISABLE KEYS */;
INSERT INTO `survey_question_factor` VALUES (1,4,'agree','agree','difficult for students in the first year','difficult for students in the first year'),(2,4,'agree','agree','easy fort students','easy fort students'),(3,5,'explain course for students','explain course for students','1','1'),(4,5,'communication skills with students','communication skills with students','2','2'),(5,7,'fdsfsdf','sdfsdfsdf','1','1'),(6,9,'bbbb','bbbbb','1','1'),(7,9,'feeeeel','feeeeel','2','2'),(8,10,'sdaaaaaaaaaaa','dsaaaaaaaaaaa','23','123'),(9,11,'tyyuiop[','ytuiopu','21221','213213'),(10,12,'iiiiiiiiiiiiiii','iiiiiiiiiiiiuu','99','99');
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_question_statement`
--

LOCK TABLES `survey_question_statement` WRITE;
/*!40000 ALTER TABLE `survey_question_statement` DISABLE KEYS */;
INSERT INTO `survey_question_statement` VALUES (1,1,'aqgree','aqgree','so difficult','so difficult'),(2,1,'disagree','disagree','normal','normal'),(3,2,'agree','agree','not easy','not easy'),(4,3,'explain it in a very good way for students','explain it in a very good way for students','1.1','1.1'),(5,3,'explain it but it\'s not clear for students','explain it but it\'s not clear for students','1.2','1.2'),(6,3,'he/she cant explain the course in a very good way','he/she cant explain the course in a very good way','1.3','1.3'),(7,4,'he\'s very good in communication skills','he\'s very good in communication skills','2.1','2.1'),(8,4,'can handle it with students','can handle it with students','2.2','2.2'),(9,4,'h\'es bad in that','h\'es bad in that','2.3','2.3'),(10,4,'noway to deal with students','noway to deal with students','2.4','2.4'),(11,5,'fdsfsdfdsfsdf','rewtrewrtewrew','1.1','1.1'),(12,5,'dasdsadsadas','fdgdssdfsdfsd','1.2','1.2'),(13,6,'yessss','yessss','1.1','1.1'),(14,6,'noooo ','noooo','1.2','1.2'),(15,7,'mmmmmm','mmmmmm','2.1','2.1'),(16,8,'treterte','rtertee','213123','213123'),(17,8,'efdsfdsf','dsfdsfsdf','321321','12321321'),(18,9,'4uiouiooipopoi','uyuiiiouoppoipoi','234234','23423432'),(19,10,'hjkhkh','jkhkhk','89898776','78979');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_user_response_choice`
--

LOCK TABLES `survey_user_response_choice` WRITE;
/*!40000 ALTER TABLE `survey_user_response_choice` DISABLE KEYS */;
INSERT INTO `survey_user_response_choice` VALUES (1,3,12,6),(2,2,12,3);
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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_user_response_factor`
--

LOCK TABLES `survey_user_response_factor` WRITE;
/*!40000 ALTER TABLE `survey_user_response_factor` DISABLE KEYS */;
INSERT INTO `survey_user_response_factor` VALUES (1,7,24,11,3),(2,7,24,12,1),(3,7,23,11,4),(4,7,23,12,2),(5,7,25,11,5),(6,7,25,12,3),(7,7,26,11,4),(8,7,26,12,4),(9,10,41,16,3),(10,10,41,17,3),(11,10,42,16,2),(12,10,42,17,1),(13,10,57,16,3),(14,10,57,17,1),(15,10,54,16,5),(16,10,54,17,1),(17,7,29,11,5),(18,7,29,12,5),(19,5,12,4,3),(20,5,12,5,4),(21,5,12,6,1),(22,5,12,7,4),(23,5,12,8,5),(24,5,12,9,1),(25,5,12,10,4);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_user_response_text`
--

LOCK TABLES `survey_user_response_text` WRITE;
/*!40000 ALTER TABLE `survey_user_response_text` DISABLE KEYS */;
INSERT INTO `survey_user_response_text` VALUES (1,6,24,'cs'),(2,6,23,'asdasdasd'),(3,6,25,'zxczd'),(4,6,26,'faylsoof'),(5,6,29,'arts'),(6,1,12,'dasdsadas');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (1,1,20,'<p>hello all please attach new file</p>','2019-01-12 00:00:00',0,'title from admin to another user'),(2,1,2,'<p>hello all please attach new file</p>','2019-01-12 00:00:00',1,'title from admin to another user'),(3,1,3,'<p>hello all please attach new file</p>','2019-01-12 00:00:00',0,'title from admin to another user');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tf_club`
--

DROP TABLE IF EXISTS `tf_club`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tf_club` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name_ar` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `policies_en` text,
  `policies_ar` text,
  `description_en` text,
  `description_ar` text,
  `creator` bigint(20) NOT NULL,
  `approval_post` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `logo` varchar(255) DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `member_gender` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tf_club`
--

LOCK TABLES `tf_club` WRITE;
/*!40000 ALTER TABLE `tf_club` DISABLE KEYS */;
/*!40000 ALTER TABLE `tf_club` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tf_post`
--

DROP TABLE IF EXISTS `tf_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tf_post` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `club_id` bigint(20) NOT NULL,
  `content` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `creator` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tf_post`
--

LOCK TABLES `tf_post` WRITE;
/*!40000 ALTER TABLE `tf_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `tf_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tf_user_club`
--

DROP TABLE IF EXISTS `tf_user_club`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tf_user_club` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `club_id` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tf_user_club`
--

LOCK TABLES `tf_user_club` WRITE;
/*!40000 ALTER TABLE `tf_user_club` DISABLE KEYS */;
/*!40000 ALTER TABLE `tf_user_club` ENABLE KEYS */;
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
-- Table structure for table `tm_level`
--

DROP TABLE IF EXISTS `tm_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tm_level` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `training_id` bigint(20) NOT NULL,
  `level_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tm_level`
--

LOCK TABLES `tm_level` WRITE;
/*!40000 ALTER TABLE `tm_level` DISABLE KEYS */;
INSERT INTO `tm_level` VALUES (1,2,4);
/*!40000 ALTER TABLE `tm_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tm_members`
--

DROP TABLE IF EXISTS `tm_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tm_members` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `training_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tm_members`
--

LOCK TABLES `tm_members` WRITE;
/*!40000 ALTER TABLE `tm_members` DISABLE KEYS */;
INSERT INTO `tm_members` VALUES (1,1,14,1),(2,1,15,1),(3,2,10,1);
/*!40000 ALTER TABLE `tm_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tm_survey`
--

DROP TABLE IF EXISTS `tm_survey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tm_survey` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `survey_id` bigint(20) NOT NULL,
  `training_id` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tm_survey`
--

LOCK TABLES `tm_survey` WRITE;
/*!40000 ALTER TABLE `tm_survey` DISABLE KEYS */;
INSERT INTO `tm_survey` VALUES (1,8,1,0),(2,9,1,1),(3,10,2,0),(4,11,2,1);
/*!40000 ALTER TABLE `tm_survey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tm_training`
--

DROP TABLE IF EXISTS `tm_training`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tm_training` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `type_id` bigint(20) NOT NULL,
  `organization` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `instructor_information` text NOT NULL,
  `description` text NOT NULL,
  `training_outline` text NOT NULL,
  `creator_id` bigint(20) NOT NULL,
  `level` bigint(20) NOT NULL,
  `college_id` bigint(20) NOT NULL,
  `department_id` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tm_training`
--

LOCK TABLES `tm_training` WRITE;
/*!40000 ALTER TABLE `tm_training` DISABLE KEYS */;
INSERT INTO `tm_training` VALUES (1,'rrrrrrr','rrrrrrrr','40','2019-01-16',1,'system','khawrzme','<p>zfdsfsdfdsfdsdsfds</p>','<p>asdas</p>','<p>sadsadasda</p>',1,0,0,0,0),(2,'sdffffff','ffdsffffffds','10','2019-01-16',3,'fdsdsfsdf','dfsdsfdfs','<p>saddsadassadsdasadsad</p>','<p>dsadsasdasadsad</p>','<p>dsasaddas</p>',1,1,0,0,1);
/*!40000 ALTER TABLE `tm_training` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tm_type`
--

DROP TABLE IF EXISTS `tm_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tm_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(250) NOT NULL,
  `name_ar` varchar(250) NOT NULL,
  `is_editable` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tm_type`
--

LOCK TABLES `tm_type` WRITE;
/*!40000 ALTER TABLE `tm_type` DISABLE KEYS */;
INSERT INTO `tm_type` VALUES (1,'Training Courses','دورات تدريبية',1),(2,'Conferences','مؤتمرات',1),(3,'Events','أحداث',1),(4,'Workshops','ورشات عمل',1),(5,'Scientific Visits','زيارات علمية',1);
/*!40000 ALTER TABLE `tm_type` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5639 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translation`
--

LOCK TABLES `translation` WRITE;
/*!40000 ALTER TABLE `translation` DISABLE KEYS */;
/*!40000 ALTER TABLE `translation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tst_exam`
--

DROP TABLE IF EXISTS `tst_exam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tst_exam` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `teacher_id` bigint(20) NOT NULL,
  `sections` text,
  `desc_en` text,
  `desc_ar` text,
  `type` int(4) NOT NULL DEFAULT '0',
  `start` int(11) DEFAULT NULL,
  `end` int(11) DEFAULT NULL,
  `semester_id` bigint(20) NOT NULL,
  `fullmark` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tst_exam`
--

LOCK TABLES `tst_exam` WRITE;
/*!40000 ALTER TABLE `tst_exam` DISABLE KEYS */;
INSERT INTO `tst_exam` VALUES (1,'exam 1','exam 1',3,0,12,'[]','','',0,0,0,1,100),(2,'new event','new event',3,0,12,'[]','','',0,0,0,1,30),(3,'assignment 1','assignment 1',3,0,12,'','assignment 1','assignment 1',1,0,0,1,100),(4,'quiz 1','quiz 1',3,0,12,'','','',2,1547318623,1547326123,1,100),(5,'AI  assignment','AI  assignment',6,0,1,'','AI  assignment','AI  assignment',1,0,0,1,100),(6,'exam to gradebook','exam to gradebook',6,0,1,'[\"2\"]','','',0,1547379722,1547394122,1,100),(7,'ssss','ssss',1,0,1,'[\"3\"]','','',0,0,0,1,100),(8,'exam for students','exam for students',8,0,10,'[\"4\"]','','',0,1547381700,1547384400,1,100),(9,'AI Exam','AI Exam',6,0,1,'[]','','',0,0,0,1,100),(10,'exam two for all students here','exam two for all students here',8,0,1,'[\"4\"]','','',2,1547727358,1547734858,1,150),(11,'ffdfff','dsfdsfds',1,0,1,'[]','','',0,0,0,1,100);
/*!40000 ALTER TABLE `tst_exam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tst_exam_attachment`
--

DROP TABLE IF EXISTS `tst_exam_attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tst_exam_attachment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `exam_id` bigint(20) NOT NULL,
  `file_type` varchar(100) NOT NULL,
  `path` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tst_exam_attachment_id_uindex` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tst_exam_attachment`
--

LOCK TABLES `tst_exam_attachment` WRITE;
/*!40000 ALTER TABLE `tst_exam_attachment` DISABLE KEYS */;
INSERT INTO `tst_exam_attachment` VALUES (1,3,'application/pdf','/files/Documents/2019/pharmacy college/pharmacy program/Assignments/medicine reports/pharmacy college coordinator/assignment 1/Institutional Profile.pdf'),(2,5,'application/pdf','/files/Documents/2019/Assignments/AI/Admin Eaa/AI  assignment/Standard 4. Learning and Teaching..pdf');
/*!40000 ALTER TABLE `tst_exam_attachment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tst_exam_attendance`
--

DROP TABLE IF EXISTS `tst_exam_attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tst_exam_attendance` (
  `exam_id` bigint(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `monitor_id` bigint(20) NOT NULL,
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `hash_code` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `exam_id` (`exam_id`),
  KEY `student_id` (`student_id`),
  KEY `monitor_id` (`monitor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tst_exam_attendance`
--

LOCK TABLES `tst_exam_attendance` WRITE;
/*!40000 ALTER TABLE `tst_exam_attendance` DISABLE KEYS */;
INSERT INTO `tst_exam_attendance` VALUES (8,3,1,1,''),(8,2,1,2,''),(8,6,1,3,''),(8,5,1,4,''),(6,2,1,5,''),(6,4,1,6,''),(6,8,1,7,'');
/*!40000 ALTER TABLE `tst_exam_attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tst_exam_monitors`
--

DROP TABLE IF EXISTS `tst_exam_monitors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tst_exam_monitors` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `exam_id` bigint(20) NOT NULL,
  `monitor_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tst_exam_monitors`
--

LOCK TABLES `tst_exam_monitors` WRITE;
/*!40000 ALTER TABLE `tst_exam_monitors` DISABLE KEYS */;
INSERT INTO `tst_exam_monitors` VALUES (1,7,10),(2,7,11),(3,6,1),(4,6,10),(5,8,10),(6,8,11),(7,8,12),(8,8,1),(9,9,1),(10,9,10);
/*!40000 ALTER TABLE `tst_exam_monitors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tst_exam_questions`
--

DROP TABLE IF EXISTS `tst_exam_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tst_exam_questions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `exam_id` bigint(20) NOT NULL,
  `question_id` bigint(20) NOT NULL,
  `mark` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tst_exam_questions`
--

LOCK TABLES `tst_exam_questions` WRITE;
/*!40000 ALTER TABLE `tst_exam_questions` DISABLE KEYS */;
INSERT INTO `tst_exam_questions` VALUES (1,1,1,30),(2,4,1,50),(3,4,2,50),(4,5,3,100),(5,7,1,50),(6,6,1,100),(7,8,4,50),(8,8,5,50),(9,9,6,100),(10,7,6,30),(11,10,6,70),(12,10,1,80);
/*!40000 ALTER TABLE `tst_exam_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tst_exam_response_attachment`
--

DROP TABLE IF EXISTS `tst_exam_response_attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tst_exam_response_attachment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `exam_id` bigint(20) NOT NULL DEFAULT '0',
  `question_id` bigint(20) NOT NULL DEFAULT '0',
  `path_file` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `exam_id` (`exam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tst_exam_response_attachment`
--

LOCK TABLES `tst_exam_response_attachment` WRITE;
/*!40000 ALTER TABLE `tst_exam_response_attachment` DISABLE KEYS */;
/*!40000 ALTER TABLE `tst_exam_response_attachment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tst_exam_response_choice`
--

DROP TABLE IF EXISTS `tst_exam_response_choice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tst_exam_response_choice` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `exam_id` bigint(20) NOT NULL DEFAULT '0',
  `question_id` bigint(20) NOT NULL DEFAULT '0',
  `choice_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `exam_id` (`exam_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tst_exam_response_choice`
--

LOCK TABLES `tst_exam_response_choice` WRITE;
/*!40000 ALTER TABLE `tst_exam_response_choice` DISABLE KEYS */;
INSERT INTO `tst_exam_response_choice` VALUES (1,2,10,1,1),(2,6,10,1,2);
/*!40000 ALTER TABLE `tst_exam_response_choice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tst_exam_response_text`
--

DROP TABLE IF EXISTS `tst_exam_response_text`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tst_exam_response_text` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `exam_id` bigint(20) NOT NULL DEFAULT '0',
  `question_id` bigint(20) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `exam_id` (`exam_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tst_exam_response_text`
--

LOCK TABLES `tst_exam_response_text` WRITE;
/*!40000 ALTER TABLE `tst_exam_response_text` DISABLE KEYS */;
INSERT INTO `tst_exam_response_text` VALUES (1,2,10,6,'yes i can do it with an easy way'),(2,6,10,6,'ldslaldsal');
/*!40000 ALTER TABLE `tst_exam_response_text` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tst_exam_student_mark`
--

DROP TABLE IF EXISTS `tst_exam_student_mark`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tst_exam_student_mark` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `exam_id` bigint(20) NOT NULL,
  `question_id` bigint(20) NOT NULL,
  `mark` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `exam_id` (`exam_id`),
  KEY `tst_exam_student_mark_exam_id_index` (`exam_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tst_exam_student_mark`
--

LOCK TABLES `tst_exam_student_mark` WRITE;
/*!40000 ALTER TABLE `tst_exam_student_mark` DISABLE KEYS */;
INSERT INTO `tst_exam_student_mark` VALUES (1,2,10,1,80),(2,6,10,1,0),(3,5,10,6,0),(4,5,10,1,0);
/*!40000 ALTER TABLE `tst_exam_student_mark` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tst_question`
--

DROP TABLE IF EXISTS `tst_question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tst_question` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `text_ar` text,
  `text_en` text,
  `type` varchar(255) NOT NULL,
  `difficulty` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `can_attach` tinyint(4) DEFAULT NULL,
  `is_assignment` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tst_question`
--

LOCK TABLES `tst_question` WRITE;
/*!40000 ALTER TABLE `tst_question` DISABLE KEYS */;
INSERT INTO `tst_question` VALUES (1,3,'is the medical is fit with our specilist','is the medical is fit with our specilist','Orm_Tst_Question_Type_Radio',0,3,12,0,0),(2,3,'here iam ','here iam ','Orm_Tst_Question_Type_Textarea',0,1,12,0,0),(3,6,'fewrewr','ewrewrewr','Orm_Tst_Question_Type_Textarea',0,3,1,1,1),(4,8,'what is the main function in java ?','what is the main function in java ?','Orm_Tst_Question_Type_Checkbox',0,1,10,0,0),(5,8,'could you describe java language','could you describe java language','Orm_Tst_Question_Type_Textarea',0,1,10,0,0),(6,6,'question for AI exam','question for AI exam','Orm_Tst_Question_Type_Textarea',0,1,1,0,0);
/*!40000 ALTER TABLE `tst_question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tst_question_attachment`
--

DROP TABLE IF EXISTS `tst_question_attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tst_question_attachment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `question_id` bigint(20) NOT NULL,
  `file_type` varchar(11) DEFAULT NULL,
  `path` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tst_question_attachment`
--

LOCK TABLES `tst_question_attachment` WRITE;
/*!40000 ALTER TABLE `tst_question_attachment` DISABLE KEYS */;
/*!40000 ALTER TABLE `tst_question_attachment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tst_question_option_points`
--

DROP TABLE IF EXISTS `tst_question_option_points`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tst_question_option_points` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `question_id` bigint(20) NOT NULL,
  `option_id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `point` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tst_question_option_points`
--

LOCK TABLES `tst_question_option_points` WRITE;
/*!40000 ALTER TABLE `tst_question_option_points` DISABLE KEYS */;
/*!40000 ALTER TABLE `tst_question_option_points` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tst_question_options`
--

DROP TABLE IF EXISTS `tst_question_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tst_question_options` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `question_id` bigint(20) NOT NULL,
  `text_ar` text,
  `text_en` text,
  `correct` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tst_question_options`
--

LOCK TABLES `tst_question_options` WRITE;
/*!40000 ALTER TABLE `tst_question_options` DISABLE KEYS */;
INSERT INTO `tst_question_options` VALUES (1,1,'yes','yes',1),(2,1,'no','no',0),(3,1,'mayve','matbe ',0),(4,4,'static void main','static void main',1),(5,4,'mainmain','mai main',0),(6,4,'nothing else','nothing else',0);
/*!40000 ALTER TABLE `tst_question_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tst_question_outcome`
--

DROP TABLE IF EXISTS `tst_question_outcome`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tst_question_outcome` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `question_id` bigint(20) DEFAULT NULL,
  `outcome_id` bigint(20) DEFAULT NULL,
  `type` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`),
  KEY `outcome_id` (`outcome_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tst_question_outcome`
--

LOCK TABLES `tst_question_outcome` WRITE;
/*!40000 ALTER TABLE `tst_question_outcome` DISABLE KEYS */;
INSERT INTO `tst_question_outcome` VALUES (1,6,1,2),(2,6,2,2);
/*!40000 ALTER TABLE `tst_question_outcome` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tst_student_attachment`
--

DROP TABLE IF EXISTS `tst_student_attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tst_student_attachment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `exam_id` bigint(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `file_type` varchar(100) NOT NULL,
  `path` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tst_student_attachment_id_uindex` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tst_student_attachment`
--

LOCK TABLES `tst_student_attachment` WRITE;
/*!40000 ALTER TABLE `tst_student_attachment` DISABLE KEYS */;
/*!40000 ALTER TABLE `tst_student_attachment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit`
--

DROP TABLE IF EXISTS `unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unit` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `integration_id` varchar(100) NOT NULL DEFAULT '0',
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit`
--

LOCK TABLES `unit` WRITE;
/*!40000 ALTER TABLE `unit` DISABLE KEYS */;
INSERT INTO `unit` VALUES (1,'0',0,0,'Assem Al Jimzawi','عاصم الجمزاوي','Orm_Unit_Rector',0,'to be number one in health sector around the world','لنصبح المركز الاول عالميا على مستوى الصحة','I want as a  rector top improve my university','اسعى لتطوير الجامعة '),(2,'0',1,0,'isamaeel vice rector','اسماعيل نائب رئيس الفجامعة','Orm_Unit_Vice_Rector',0,'','','',''),(3,'0',1,0,'vice rector for prince ghazi college','نائب العميد لكلية اﻷمير غازي','Orm_Unit_Vice_Rector',0,'','','',''),(4,'0',1,0,'msharee vise rector for ksu campus','مشاري نائب العميد للأعلام','Orm_Unit_Vice_Rector',0,'','','','');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit_goal`
--

LOCK TABLES `unit_goal` WRITE;
/*!40000 ALTER TABLE `unit_goal` DISABLE KEYS */;
INSERT INTO `unit_goal` VALUES (1,1,'goal to be number one for uni','goal to be number one for uni',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit_log`
--

LOCK TABLES `unit_log` WRITE;
/*!40000 ALTER TABLE `unit_log` DISABLE KEYS */;
INSERT INTO `unit_log` VALUES (1,1,1,2019),(2,1,2,2019),(3,1,3,2019),(4,1,4,2019);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit_objective`
--

LOCK TABLES `unit_objective` WRITE;
/*!40000 ALTER TABLE `unit_objective` DISABLE KEYS */;
INSERT INTO `unit_objective` VALUES (1,1,'grow up and improve myself in university','grow up and improve myself in university',0);
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
  `integration_id` varchar(100) NOT NULL DEFAULT '0',
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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Orm_User_Staff','0','','admin@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','0000-00-00','2019-01-30 10:20:23',1,'/assets/jadeer/img/avatar.png','Admin','Eaa',0,'','','','','','',NULL,0,0,0,''),(2,'Orm_User_Student','2','2','assem@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','1990-05-26','2019-01-20 09:04:45',1,'/assets/jadeer/img/avatar.png','Assem','aljimzawi',0,'Jordanian','','','','','',NULL,0,0,0,''),(3,'Orm_User_Student','3','3','nael@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','2008-06-01','2019-01-17 14:11:33',1,'/assets/jadeer/img/avatar.png','nael','wael',0,'Egyption','','','','','',NULL,0,0,0,''),(4,'Orm_User_Student','4','4','sara@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','2009-03-01','2019-01-30 10:20:07',1,'/assets/jadeer/img/avatar.png','sara','hadi',0,'syrian','','','','','',NULL,0,0,0,''),(5,'Orm_User_Student','5','5','we2am@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','1995-09-01','2019-01-15 23:44:57',1,'/assets/jadeer/img/avatar.png','we2am','zayed',1,'american','','','','','',NULL,0,0,0,''),(6,'Orm_User_Student','6','6','ismaeel@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','2010-06-01','2019-01-17 14:17:17',1,'/assets/jadeer/img/avatar.png','ismaeel','habeel',0,'Jordanian','','','','','',NULL,0,0,0,''),(7,'Orm_User_Student','7','7','issam@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','1999-01-12','2019-01-15 21:53:21',1,'/assets/jadeer/img/avatar.png','issam','afeef',0,'Jordanian','','','','','',NULL,0,0,0,''),(8,'Orm_User_Student','8','8','familia@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','1993-01-12','2019-01-16 10:36:21',1,'/assets/jadeer/img/avatar.png','familia','zayson',0,'argentina','','','','','',NULL,0,0,0,''),(9,'Orm_User_Student','9','9','9a7fe@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','2014-03-04','2019-01-12 19:56:04',1,'/assets/jadeer/img/avatar.png','9a7fe','press',0,'Jordanian','','','','','',NULL,0,0,0,''),(10,'Orm_User_Faculty','9','10','college_coordi@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','2005-01-01','2019-01-28 13:32:48',1,'/assets/jadeer/img/avatar.png','Computer Scince','College Coordinator',0,'Jordanian','','','','','',NULL,0,0,0,''),(11,'Orm_User_Faculty','11','11','college.coordinator.ghazi@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','2000-01-01','2019-01-13 16:23:08',1,'/assets/jadeer/img/avatar.png','college coordinator','prince ghazi',0,'Jordanian','','','','','',NULL,0,0,0,''),(12,'Orm_User_Faculty','12','12','pharmacy.coordintor@eaa.com.sa','c984aed014aec7623a54f0591da07a85fd4b762d','1998-01-01','2019-01-16 12:01:00',1,'/assets/jadeer/img/avatar.png','pharmacy','college coordinator',0,'Jordanian','','','','','',NULL,0,0,0,''),(13,'Orm_User_Faculty','12','12','program.coordinator@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','2006-01-09','2019-01-14 12:40:54',1,'/assets/jadeer/img/avatar.png','Computer Scince','program coordinator',0,'Jordanian','','','','','',NULL,0,0,0,''),(14,'Orm_User_Faculty','13','13','program.engineer@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','0000-00-00','2019-01-12 19:26:52',1,'/assets/jadeer/img/avatar.png','civil engineer','program coordinator',0,'Jordanian','','','','','',NULL,0,0,0,''),(15,'Orm_User_Faculty','13','13','teacher@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','0000-00-00','2019-01-16 12:03:41',1,'/assets/jadeer/img/avatar.png','teacher','coordinator',0,'Jordanian','','','','','',NULL,0,0,0,''),(16,'Orm_User_Faculty','14','14','teacher.engineer@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','2014-01-13','0000-00-00 00:00:00',1,'/assets/jadeer/img/avatar.png','teacher','engineer cicil',0,'Jordanian','','','','','',NULL,0,0,0,''),(17,'Orm_User_Faculty','15','15','employee.cs@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','2014-01-06','0000-00-00 00:00:00',1,'/assets/jadeer/img/avatar.png','employye','computer science',0,'Jordanian','','','','','',NULL,0,0,0,''),(18,'Orm_User_Faculty','16','16','review@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','2010-01-01','2019-01-12 19:34:06',1,'/assets/jadeer/img/avatar.png','reviewer','cs',1,'Jordanian','','','','','',NULL,0,0,0,''),(19,'Orm_User_Faculty','16','16','reviewer@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','2012-01-17','0000-00-00 00:00:00',1,'/assets/jadeer/img/avatar.png','reviewr','cicil engineer',0,'Egyption','','','','','',NULL,0,0,0,''),(20,'Orm_User_Staff','17','17','Super.admin@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','1980-01-01','2019-01-16 00:10:23',1,'/assets/jadeer/img/avatar.png','super admin','balqa university',0,'Jordanian','','','','','',NULL,0,0,0,''),(21,'Orm_User_Staff','18','18','super.admin.ksu@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','2005-01-12','2019-01-16 00:44:38',1,'/assets/jadeer/img/avatar.png','super admin','ksu',0,'argentina','','','','','',NULL,0,0,0,''),(22,'Orm_User_Staff','19','19','coleege.coord.ghazi@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','2006-01-02','2019-01-16 00:14:50',1,'/assets/jadeer/img/avatar.png','staff college coordinator','ghazi',0,'Jordanian','','','','','',NULL,0,0,0,''),(23,'Orm_User_Staff','20','20','press.college.coor@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','2018-11-06','0000-00-00 00:00:00',1,'/assets/jadeer/img/avatar.png','press coordinator','college ksu',0,'Egyption','','','','','',NULL,0,0,0,''),(24,'Orm_User_Staff','21','21','industrial.college@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','2008-01-29','0000-00-00 00:00:00',1,'/assets/jadeer/img/avatar.png','college coordinator','industrial eng',0,'Jordanian','','','','','',NULL,0,0,0,''),(25,'Orm_User_Staff','21','21','program.coordinator.staff@eaa.com.sa','c984aed014aec7623a54f0591da07a85fd4b762d','2018-02-08','0000-00-00 00:00:00',1,'/assets/jadeer/img/avatar.png','Computer Scince','program coordinator',0,'Jordanian','','','','','',NULL,0,0,0,''),(26,'Orm_User_Staff','22','22','program.coor.ghazi@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','1995-09-01','0000-00-00 00:00:00',1,'/assets/jadeer/img/avatar.png','program coor','ghazi',0,'Egyption','','','','','',NULL,0,0,0,''),(27,'Orm_User_Staff','23','23','ksu.program.coor@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','2018-10-09','0000-00-00 00:00:00',1,'/assets/jadeer/img/avatar.png','staff proogram','ksu press',0,'Jordanian','','','','','',NULL,0,0,0,''),(28,'Orm_User_Staff','24','24','staff.teacher@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','2015-03-24','0000-00-00 00:00:00',1,'/assets/jadeer/img/avatar.png','staff','teachrer',0,'Egyption','','','','','',NULL,0,0,0,''),(29,'Orm_User_Staff','26','26','teacher.staff.ksu@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','2018-08-24','2019-01-16 00:09:05',1,'/assets/jadeer/img/avatar.png','staff ksu','pharmacy teacher',0,'syrian','','','','','',NULL,0,0,0,''),(30,'Orm_User_Staff','28','28','reviewr@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','1990-05-26','0000-00-00 00:00:00',1,'/assets/jadeer/img/avatar.png','reviewr staff','computer science',0,'american','','','','','',NULL,0,0,0,''),(31,'Orm_User_Staff','30','30','reviewr.ksu@eaa.com.sa','7c4a8d09ca3762af61e59520943dc26494f8941b','2015-03-02','0000-00-00 00:00:00',1,'/assets/jadeer/img/avatar.png','reviewr staff','ksu press',0,'Jordanian','','','','','',NULL,0,0,0,''),(32,'Orm_User_Employer','0','','employer@gmail.com','7140fbebfdc4feea71553e1b09eca91f87b27355','2018-11-23','0000-00-00 00:00:00',1,'/assets/jadeer/img/avatar.png','emplyer','male',0,'argentina','','','','','',NULL,0,0,0,''),(33,'Orm_User_Alumni','0','','alumni@gmail.com','942fa7dbec29f92f1dff3b6d94a39aedd71e21b9','2018-10-31','0000-00-00 00:00:00',1,'/assets/jadeer/img/avatar.png','alumni','student',0,'syrian','','','','','',NULL,0,0,0,''),(34,'Orm_User_Alumni','0','','alumni2019@gmail.com','QKahTX28','2019-01-01','0000-00-00 00:00:00',1,'/assets/jadeer/img/avatar.png','alumni2019','last',0,'syrian','','','','','',NULL,0,0,0,'');
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
INSERT INTO `user_alumni` VALUES (33,1,9,10,2019,0,0,0,0),(34,2,10,6,2018,0,0,0,0);
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
INSERT INTO `user_employer` VALUES (32,0,0,0,0,1,1,5);
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
  `program_id` varchar(100) DEFAULT NULL,
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
INSERT INTO `user_faculty` VALUES (10,2,1,1,'5',1,1,6,'','','',0),(11,2,2,10,'6',1,0,2,'','','',0),(12,2,4,11,'7',1,1,2,'','','',0),(13,3,1,1,'5',1,2,1,'','','',0),(14,3,1,9,'8',1,0,1,'','','',0),(15,4,1,1,'5',1,2,1,'','','',0),(16,4,1,9,'8',1,0,1,'','','',0),(17,5,1,1,'5',1,0,1,'','','',0),(18,6,1,1,'5',1,0,1,'','','',0),(19,6,1,9,'8',1,0,1,'','','',0);
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
INSERT INTO `user_staff` VALUES (1,1,0,0,0,0,1,0,0),(20,1,1,1,1,5,1,1,2),(21,1,4,4,11,7,1,1,1),(22,2,3,2,10,6,1,0,2),(23,2,4,3,12,12,1,0,1),(24,2,2,1,9,11,1,0,2),(25,3,1,1,1,5,1,0,2),(26,3,1,2,10,6,1,0,2),(27,3,2,3,12,12,1,0,1),(28,4,2,1,1,5,1,0,2),(29,4,4,4,11,7,1,0,1),(30,6,4,1,1,5,1,0,2),(31,6,4,3,12,12,1,0,1);
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
INSERT INTO `user_student` VALUES (2,1,1,5,6,1),(3,1,1,5,3,2),(4,1,1,5,5,3),(5,1,1,5,4,2),(6,1,9,10,6,1),(7,1,9,10,6,1),(8,4,11,7,3,2),(9,3,12,12,3,2);
/*!40000 ALTER TABLE `user_student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wa_award`
--

DROP TABLE IF EXISTS `wa_award`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wa_award` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(45) NOT NULL,
  `name_ar` varchar(45) NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `date` timestamp NULL DEFAULT NULL,
  `description_ar` varchar(45) NOT NULL,
  `description_en` varchar(45) NOT NULL,
  `level` bigint(20) DEFAULT NULL,
  `level_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wa_award`
--

LOCK TABLES `wa_award` WRITE;
/*!40000 ALTER TABLE `wa_award` DISABLE KEYS */;
INSERT INTO `wa_award` VALUES (1,'award 1','award 1',1,1,'2019-01-17 22:00:00','description award 1','description award 1',1,1),(2,'award depending n institution','award depending n institution',1,0,'2019-01-15 22:00:00','award depending n institution','award depending n institution',0,0),(3,'award on press college','award on press college',1,0,'2019-01-11 22:00:00','award on press college','award on press college',1,3),(4,'ewqwqeq','weqweqwe',1,0,'2019-01-18 22:00:00','qweqweqwe','eqwe',1,3);
/*!40000 ALTER TABLE `wa_award` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wa_candidate_user`
--

DROP TABLE IF EXISTS `wa_candidate_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wa_candidate_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `award_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wa_candidate_user`
--

LOCK TABLES `wa_candidate_user` WRITE;
/*!40000 ALTER TABLE `wa_candidate_user` DISABLE KEYS */;
INSERT INTO `wa_candidate_user` VALUES (1,10,0),(2,11,0),(3,10,3),(4,12,3),(5,14,3),(6,11,2),(7,10,2),(8,10,4),(9,15,4);
/*!40000 ALTER TABLE `wa_candidate_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wa_winner_award`
--

DROP TABLE IF EXISTS `wa_winner_award`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wa_winner_award` (
  `award_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `received` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wa_winner_award`
--

LOCK TABLES `wa_winner_award` WRITE;
/*!40000 ALTER TABLE `wa_winner_award` DISABLE KEYS */;
/*!40000 ALTER TABLE `wa_winner_award` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-30 13:44:33