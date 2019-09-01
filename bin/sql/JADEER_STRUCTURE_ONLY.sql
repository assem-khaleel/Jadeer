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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-10 16:20:31
