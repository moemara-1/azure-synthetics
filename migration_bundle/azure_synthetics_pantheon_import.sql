-- MariaDB dump 10.19-11.4.9-MariaDB, for Linux (x86_64)
--
-- Host: db    Database: wordpress
-- ------------------------------------------------------
-- Server version	11.4.10-MariaDB-ubu2404

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

--
-- Table structure for table `wp_actionscheduler_actions`
--

DROP TABLE IF EXISTS `wp_actionscheduler_actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_actionscheduler_actions` (
  `action_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `hook` varchar(191) NOT NULL,
  `status` varchar(20) NOT NULL,
  `scheduled_date_gmt` datetime DEFAULT '0000-00-00 00:00:00',
  `scheduled_date_local` datetime DEFAULT '0000-00-00 00:00:00',
  `priority` tinyint(3) unsigned NOT NULL DEFAULT 10,
  `args` varchar(191) DEFAULT NULL,
  `schedule` longtext DEFAULT NULL,
  `group_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `attempts` int(11) NOT NULL DEFAULT 0,
  `last_attempt_gmt` datetime DEFAULT '0000-00-00 00:00:00',
  `last_attempt_local` datetime DEFAULT '0000-00-00 00:00:00',
  `claim_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `extended_args` varchar(8000) DEFAULT NULL,
  PRIMARY KEY (`action_id`),
  KEY `hook_status_scheduled_date_gmt` (`hook`(163),`status`,`scheduled_date_gmt`),
  KEY `status_scheduled_date_gmt` (`status`,`scheduled_date_gmt`),
  KEY `scheduled_date_gmt` (`scheduled_date_gmt`),
  KEY `args` (`args`),
  KEY `group_id` (`group_id`),
  KEY `last_attempt_gmt` (`last_attempt_gmt`),
  KEY `claim_id_status_priority_scheduled_date_gmt` (`claim_id`,`status`,`priority`,`scheduled_date_gmt`),
  KEY `status_last_attempt_gmt` (`status`,`last_attempt_gmt`),
  KEY `status_claim_id` (`status`,`claim_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_actionscheduler_actions`
--

LOCK TABLES `wp_actionscheduler_actions` WRITE;
/*!40000 ALTER TABLE `wp_actionscheduler_actions` DISABLE KEYS */;
INSERT INTO `wp_actionscheduler_actions` VALUES
(6,'action_scheduler/migration_hook','complete','2026-04-19 16:07:39','2026-04-19 16:07:39',10,'[]','O:30:\"ActionScheduler_SimpleSchedule\":2:{s:22:\"\0*\0scheduled_timestamp\";i:1776614859;s:41:\"\0ActionScheduler_SimpleSchedule\0timestamp\";i:1776614859;}',1,1,'2026-04-20 22:55:00','2026-04-20 22:55:00',2,NULL),
(7,'woocommerce_run_product_attribute_lookup_update_callback','complete','2026-04-19 16:06:48','2026-04-19 16:06:48',10,'[23,1]','O:30:\"ActionScheduler_SimpleSchedule\":2:{s:22:\"\0*\0scheduled_timestamp\";i:1776614808;s:41:\"\0ActionScheduler_SimpleSchedule\0timestamp\";i:1776614808;}',2,1,'2026-04-20 22:55:00','2026-04-20 22:55:00',2,NULL),
(8,'woocommerce_run_product_attribute_lookup_update_callback','complete','2026-04-19 16:06:48','2026-04-19 16:06:48',10,'[24,1]','O:30:\"ActionScheduler_SimpleSchedule\":2:{s:22:\"\0*\0scheduled_timestamp\";i:1776614808;s:41:\"\0ActionScheduler_SimpleSchedule\0timestamp\";i:1776614808;}',2,1,'2026-04-20 22:55:00','2026-04-20 22:55:00',2,NULL),
(9,'woocommerce_run_product_attribute_lookup_update_callback','complete','2026-04-19 16:06:48','2026-04-19 16:06:48',10,'[25,1]','O:30:\"ActionScheduler_SimpleSchedule\":2:{s:22:\"\0*\0scheduled_timestamp\";i:1776614808;s:41:\"\0ActionScheduler_SimpleSchedule\0timestamp\";i:1776614808;}',2,1,'2026-04-20 22:55:00','2026-04-20 22:55:00',2,NULL),
(10,'woocommerce_run_product_attribute_lookup_update_callback','complete','2026-04-19 16:06:48','2026-04-19 16:06:48',10,'[26,1]','O:30:\"ActionScheduler_SimpleSchedule\":2:{s:22:\"\0*\0scheduled_timestamp\";i:1776614808;s:41:\"\0ActionScheduler_SimpleSchedule\0timestamp\";i:1776614808;}',2,1,'2026-04-20 22:55:00','2026-04-20 22:55:00',2,NULL),
(11,'woocommerce_run_product_attribute_lookup_update_callback','complete','2026-04-19 16:06:49','2026-04-19 16:06:49',10,'[27,1]','O:30:\"ActionScheduler_SimpleSchedule\":2:{s:22:\"\0*\0scheduled_timestamp\";i:1776614809;s:41:\"\0ActionScheduler_SimpleSchedule\0timestamp\";i:1776614809;}',2,1,'2026-04-20 22:55:00','2026-04-20 22:55:00',2,NULL),
(12,'woocommerce_run_product_attribute_lookup_update_callback','complete','2026-04-19 16:06:49','2026-04-19 16:06:49',10,'[28,1]','O:30:\"ActionScheduler_SimpleSchedule\":2:{s:22:\"\0*\0scheduled_timestamp\";i:1776614809;s:41:\"\0ActionScheduler_SimpleSchedule\0timestamp\";i:1776614809;}',2,1,'2026-04-20 22:55:00','2026-04-20 22:55:00',2,NULL),
(13,'woocommerce_run_product_attribute_lookup_update_callback','complete','2026-04-19 16:06:49','2026-04-19 16:06:49',10,'[25,2]','O:30:\"ActionScheduler_SimpleSchedule\":2:{s:22:\"\0*\0scheduled_timestamp\";i:1776614809;s:41:\"\0ActionScheduler_SimpleSchedule\0timestamp\";i:1776614809;}',2,1,'2026-04-20 22:55:00','2026-04-20 22:55:00',2,NULL);
/*!40000 ALTER TABLE `wp_actionscheduler_actions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_actionscheduler_claims`
--

DROP TABLE IF EXISTS `wp_actionscheduler_claims`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_actionscheduler_claims` (
  `claim_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date_created_gmt` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`claim_id`),
  KEY `date_created_gmt` (`date_created_gmt`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_actionscheduler_claims`
--

LOCK TABLES `wp_actionscheduler_claims` WRITE;
/*!40000 ALTER TABLE `wp_actionscheduler_claims` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_actionscheduler_claims` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_actionscheduler_groups`
--

DROP TABLE IF EXISTS `wp_actionscheduler_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_actionscheduler_groups` (
  `group_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`group_id`),
  KEY `slug` (`slug`(191))
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_actionscheduler_groups`
--

LOCK TABLES `wp_actionscheduler_groups` WRITE;
/*!40000 ALTER TABLE `wp_actionscheduler_groups` DISABLE KEYS */;
INSERT INTO `wp_actionscheduler_groups` VALUES
(1,'action-scheduler-migration'),
(2,'woocommerce-db-updates');
/*!40000 ALTER TABLE `wp_actionscheduler_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_actionscheduler_logs`
--

DROP TABLE IF EXISTS `wp_actionscheduler_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_actionscheduler_logs` (
  `log_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `action_id` bigint(20) unsigned NOT NULL,
  `message` text NOT NULL,
  `log_date_gmt` datetime DEFAULT '0000-00-00 00:00:00',
  `log_date_local` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`log_id`),
  KEY `action_id` (`action_id`),
  KEY `log_date_gmt` (`log_date_gmt`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_actionscheduler_logs`
--

LOCK TABLES `wp_actionscheduler_logs` WRITE;
/*!40000 ALTER TABLE `wp_actionscheduler_logs` DISABLE KEYS */;
INSERT INTO `wp_actionscheduler_logs` VALUES
(1,6,'action created','2026-04-19 16:06:39','2026-04-19 16:06:39'),
(2,7,'action created','2026-04-19 16:06:47','2026-04-19 16:06:47'),
(3,8,'action created','2026-04-19 16:06:47','2026-04-19 16:06:47'),
(4,9,'action created','2026-04-19 16:06:47','2026-04-19 16:06:47'),
(5,10,'action created','2026-04-19 16:06:47','2026-04-19 16:06:47'),
(6,11,'action created','2026-04-19 16:06:48','2026-04-19 16:06:48'),
(7,12,'action created','2026-04-19 16:06:48','2026-04-19 16:06:48'),
(8,13,'action created','2026-04-19 16:06:48','2026-04-19 16:06:48'),
(9,7,'action started via WP Cron','2026-04-20 22:55:00','2026-04-20 22:55:00'),
(10,7,'action complete via WP Cron','2026-04-20 22:55:00','2026-04-20 22:55:00'),
(11,8,'action started via WP Cron','2026-04-20 22:55:00','2026-04-20 22:55:00'),
(12,8,'action complete via WP Cron','2026-04-20 22:55:00','2026-04-20 22:55:00'),
(13,9,'action started via WP Cron','2026-04-20 22:55:00','2026-04-20 22:55:00'),
(14,9,'action complete via WP Cron','2026-04-20 22:55:00','2026-04-20 22:55:00'),
(15,10,'action started via WP Cron','2026-04-20 22:55:00','2026-04-20 22:55:00'),
(16,10,'action complete via WP Cron','2026-04-20 22:55:00','2026-04-20 22:55:00'),
(17,11,'action started via WP Cron','2026-04-20 22:55:00','2026-04-20 22:55:00'),
(18,11,'action complete via WP Cron','2026-04-20 22:55:00','2026-04-20 22:55:00'),
(19,12,'action started via WP Cron','2026-04-20 22:55:00','2026-04-20 22:55:00'),
(20,12,'action complete via WP Cron','2026-04-20 22:55:00','2026-04-20 22:55:00'),
(21,13,'action started via WP Cron','2026-04-20 22:55:00','2026-04-20 22:55:00'),
(22,13,'action complete via WP Cron','2026-04-20 22:55:00','2026-04-20 22:55:00'),
(23,6,'action started via WP Cron','2026-04-20 22:55:00','2026-04-20 22:55:00'),
(24,6,'action complete via WP Cron','2026-04-20 22:55:00','2026-04-20 22:55:00');
/*!40000 ALTER TABLE `wp_actionscheduler_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_commentmeta`
--

DROP TABLE IF EXISTS `wp_commentmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_commentmeta`
--

LOCK TABLES `wp_commentmeta` WRITE;
/*!40000 ALTER TABLE `wp_commentmeta` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_commentmeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_comments`
--

DROP TABLE IF EXISTS `wp_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT 0,
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT 0,
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT 'comment',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT 0,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`),
  KEY `comment_author_email` (`comment_author_email`(10)),
  KEY `woo_idx_comment_type` (`comment_type`),
  KEY `woo_idx_comment_date_type` (`comment_date_gmt`,`comment_type`,`comment_approved`,`comment_post_ID`),
  KEY `woo_idx_comment_approved_type` (`comment_approved`,`comment_type`,`comment_post_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_comments`
--

LOCK TABLES `wp_comments` WRITE;
/*!40000 ALTER TABLE `wp_comments` DISABLE KEYS */;
INSERT INTO `wp_comments` VALUES
(1,1,'A WordPress Commenter','wapuu@wordpress.example','https://wordpress.org/','','2026-04-19 15:56:12','2026-04-19 15:56:12','Hi, this is a comment.\nTo get started with moderating, editing, and deleting comments, please visit the Comments screen in the dashboard.\nCommenter avatars come from <a href=\"https://gravatar.com/\">Gravatar</a>.',0,'1','','comment',0,0);
/*!40000 ALTER TABLE `wp_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_links`
--

DROP TABLE IF EXISTS `wp_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_links` (
  `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_image` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(25) NOT NULL DEFAULT '',
  `link_description` varchar(255) NOT NULL DEFAULT '',
  `link_visible` varchar(20) NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT 1,
  `link_rating` int(11) NOT NULL DEFAULT 0,
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL DEFAULT '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_links`
--

LOCK TABLES `wp_links` WRITE;
/*!40000 ALTER TABLE `wp_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_options`
--

DROP TABLE IF EXISTS `wp_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_options` (
  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(191) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`),
  KEY `autoload` (`autoload`)
) ENGINE=InnoDB AUTO_INCREMENT=444 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_options`
--

LOCK TABLES `wp_options` WRITE;
/*!40000 ALTER TABLE `wp_options` DISABLE KEYS */;
INSERT INTO `wp_options` VALUES
(1,'cron','a:11:{i:1776727717;a:1:{s:26:\"action_scheduler_run_queue\";a:1:{s:32:\"0d04ed39571b55704c122d726248bbac\";a:3:{s:8:\"schedule\";s:12:\"every_minute\";s:4:\"args\";a:1:{i:0;s:7:\"WP Cron\";}s:8:\"interval\";i:60;}}}i:1776729372;a:1:{s:34:\"wp_privacy_delete_old_export_files\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"hourly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:3600;}}}i:1776729999;a:2:{s:20:\"jetpack_clean_nonces\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"hourly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:3600;}}s:33:\"wc_admin_process_orders_milestone\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"hourly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:3600;}}}i:1776747371;a:1:{s:16:\"wp_version_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1776749171;a:1:{s:17:\"wp_update_plugins\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1776750971;a:1:{s:16:\"wp_update_themes\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1776786972;a:1:{s:32:\"recovery_mode_clean_expired_keys\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1776787599;a:1:{s:20:\"jetpack_v2_heartbeat\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1777218974;a:1:{s:30:\"wp_delete_temp_updater_backups\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"weekly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:604800;}}}i:1777305372;a:1:{s:30:\"wp_site_health_scheduled_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"weekly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:604800;}}}s:7:\"version\";i:2;}','on'),
(2,'siteurl','https://azure-synthetics.loca.lt','on'),
(3,'home','https://azure-synthetics.loca.lt','on'),
(4,'blogname','Azure Synthetics','on'),
(5,'blogdescription','Clinical-grade peptide storefront','on'),
(6,'users_can_register','0','on'),
(7,'admin_email','admin@example.com','on'),
(8,'start_of_week','1','on'),
(9,'use_balanceTags','0','on'),
(10,'use_smilies','1','on'),
(11,'require_name_email','1','on'),
(12,'comments_notify','1','on'),
(13,'posts_per_rss','10','on'),
(14,'rss_use_excerpt','0','on'),
(15,'mailserver_url','mail.example.com','on'),
(16,'mailserver_login','login@example.com','on'),
(17,'mailserver_pass','','on'),
(18,'mailserver_port','110','on'),
(19,'default_category','1','on'),
(20,'default_comment_status','open','on'),
(21,'default_ping_status','open','on'),
(22,'default_pingback_flag','1','on'),
(23,'posts_per_page','10','on'),
(24,'date_format','F j, Y','on'),
(25,'time_format','g:i a','on'),
(26,'links_updated_date_format','F j, Y g:i a','on'),
(27,'comment_moderation','0','on'),
(28,'moderation_notify','1','on'),
(29,'permalink_structure','/%postname%/','on'),
(30,'rewrite_rules','a:188:{s:24:\"^wc-auth/v([1]{1})/(.*)?\";s:63:\"index.php?wc-auth-version=$matches[1]&wc-auth-route=$matches[2]\";s:21:\"^wc/file/transient/?$\";s:33:\"index.php?wc-transient-file-name=\";s:24:\"^wc/file/transient/(.+)$\";s:44:\"index.php?wc-transient-file-name=$matches[1]\";s:22:\"^wc-api/v([1-3]{1})/?$\";s:51:\"index.php?wc-api-version=$matches[1]&wc-api-route=/\";s:24:\"^wc-api/v([1-3]{1})(.*)?\";s:61:\"index.php?wc-api-version=$matches[1]&wc-api-route=$matches[2]\";s:7:\"shop/?$\";s:27:\"index.php?post_type=product\";s:37:\"shop/feed/(feed|rdf|rss|rss2|atom)/?$\";s:44:\"index.php?post_type=product&feed=$matches[1]\";s:32:\"shop/(feed|rdf|rss|rss2|atom)/?$\";s:44:\"index.php?post_type=product&feed=$matches[1]\";s:24:\"shop/page/([0-9]{1,})/?$\";s:45:\"index.php?post_type=product&paged=$matches[1]\";s:11:\"^wp-json/?$\";s:22:\"index.php?rest_route=/\";s:14:\"^wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:21:\"^index.php/wp-json/?$\";s:22:\"index.php?rest_route=/\";s:24:\"^index.php/wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:17:\"^wp-sitemap\\.xml$\";s:23:\"index.php?sitemap=index\";s:17:\"^wp-sitemap\\.xsl$\";s:36:\"index.php?sitemap-stylesheet=sitemap\";s:23:\"^wp-sitemap-index\\.xsl$\";s:34:\"index.php?sitemap-stylesheet=index\";s:48:\"^wp-sitemap-([a-z]+?)-([a-z\\d_-]+?)-(\\d+?)\\.xml$\";s:75:\"index.php?sitemap=$matches[1]&sitemap-subtype=$matches[2]&paged=$matches[3]\";s:34:\"^wp-sitemap-([a-z]+?)-(\\d+?)\\.xml$\";s:47:\"index.php?sitemap=$matches[1]&paged=$matches[2]\";s:15:\"^checkout-link$\";s:28:\"index.php?checkout-link=true\";s:47:\"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:42:\"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:23:\"category/(.+?)/embed/?$\";s:46:\"index.php?category_name=$matches[1]&embed=true\";s:35:\"category/(.+?)/page/?([0-9]{1,})/?$\";s:53:\"index.php?category_name=$matches[1]&paged=$matches[2]\";s:43:\"category/(.+?)/wc/file/transient(/(.*))?/?$\";s:65:\"index.php?category_name=$matches[1]&wc/file/transient=$matches[3]\";s:32:\"category/(.+?)/wc-api(/(.*))?/?$\";s:54:\"index.php?category_name=$matches[1]&wc-api=$matches[3]\";s:17:\"category/(.+?)/?$\";s:35:\"index.php?category_name=$matches[1]\";s:44:\"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:39:\"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:20:\"tag/([^/]+)/embed/?$\";s:36:\"index.php?tag=$matches[1]&embed=true\";s:32:\"tag/([^/]+)/page/?([0-9]{1,})/?$\";s:43:\"index.php?tag=$matches[1]&paged=$matches[2]\";s:40:\"tag/([^/]+)/wc/file/transient(/(.*))?/?$\";s:55:\"index.php?tag=$matches[1]&wc/file/transient=$matches[3]\";s:29:\"tag/([^/]+)/wc-api(/(.*))?/?$\";s:44:\"index.php?tag=$matches[1]&wc-api=$matches[3]\";s:14:\"tag/([^/]+)/?$\";s:25:\"index.php?tag=$matches[1]\";s:45:\"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:40:\"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:21:\"type/([^/]+)/embed/?$\";s:44:\"index.php?post_format=$matches[1]&embed=true\";s:33:\"type/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?post_format=$matches[1]&paged=$matches[2]\";s:15:\"type/([^/]+)/?$\";s:33:\"index.php?post_format=$matches[1]\";s:44:\"brand/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?product_brand=$matches[1]&feed=$matches[2]\";s:39:\"brand/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?product_brand=$matches[1]&feed=$matches[2]\";s:20:\"brand/(.+?)/embed/?$\";s:46:\"index.php?product_brand=$matches[1]&embed=true\";s:32:\"brand/(.+?)/page/?([0-9]{1,})/?$\";s:53:\"index.php?product_brand=$matches[1]&paged=$matches[2]\";s:14:\"brand/(.+?)/?$\";s:35:\"index.php?product_brand=$matches[1]\";s:55:\"product-category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?product_cat=$matches[1]&feed=$matches[2]\";s:50:\"product-category/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?product_cat=$matches[1]&feed=$matches[2]\";s:31:\"product-category/(.+?)/embed/?$\";s:44:\"index.php?product_cat=$matches[1]&embed=true\";s:43:\"product-category/(.+?)/page/?([0-9]{1,})/?$\";s:51:\"index.php?product_cat=$matches[1]&paged=$matches[2]\";s:25:\"product-category/(.+?)/?$\";s:33:\"index.php?product_cat=$matches[1]\";s:52:\"product-tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?product_tag=$matches[1]&feed=$matches[2]\";s:47:\"product-tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?product_tag=$matches[1]&feed=$matches[2]\";s:28:\"product-tag/([^/]+)/embed/?$\";s:44:\"index.php?product_tag=$matches[1]&embed=true\";s:40:\"product-tag/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?product_tag=$matches[1]&paged=$matches[2]\";s:22:\"product-tag/([^/]+)/?$\";s:33:\"index.php?product_tag=$matches[1]\";s:35:\"product/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:45:\"product/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:65:\"product/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:60:\"product/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:60:\"product/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:41:\"product/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:24:\"product/([^/]+)/embed/?$\";s:40:\"index.php?product=$matches[1]&embed=true\";s:28:\"product/([^/]+)/trackback/?$\";s:34:\"index.php?product=$matches[1]&tb=1\";s:48:\"product/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:46:\"index.php?product=$matches[1]&feed=$matches[2]\";s:43:\"product/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:46:\"index.php?product=$matches[1]&feed=$matches[2]\";s:36:\"product/([^/]+)/page/?([0-9]{1,})/?$\";s:47:\"index.php?product=$matches[1]&paged=$matches[2]\";s:43:\"product/([^/]+)/comment-page-([0-9]{1,})/?$\";s:47:\"index.php?product=$matches[1]&cpage=$matches[2]\";s:44:\"product/([^/]+)/wc/file/transient(/(.*))?/?$\";s:59:\"index.php?product=$matches[1]&wc/file/transient=$matches[3]\";s:33:\"product/([^/]+)/wc-api(/(.*))?/?$\";s:48:\"index.php?product=$matches[1]&wc-api=$matches[3]\";s:50:\"product/[^/]+/([^/]+)/wc/file/transient(/(.*))?/?$\";s:62:\"index.php?attachment=$matches[1]&wc/file/transient=$matches[3]\";s:61:\"product/[^/]+/attachment/([^/]+)/wc/file/transient(/(.*))?/?$\";s:62:\"index.php?attachment=$matches[1]&wc/file/transient=$matches[3]\";s:39:\"product/[^/]+/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:50:\"product/[^/]+/attachment/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:32:\"product/([^/]+)(?:/([0-9]+))?/?$\";s:46:\"index.php?product=$matches[1]&page=$matches[2]\";s:24:\"product/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:34:\"product/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:54:\"product/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:49:\"product/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:49:\"product/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:30:\"product/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:12:\"robots\\.txt$\";s:18:\"index.php?robots=1\";s:13:\"favicon\\.ico$\";s:19:\"index.php?favicon=1\";s:12:\"sitemap\\.xml\";s:23:\"index.php?sitemap=index\";s:48:\".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$\";s:18:\"index.php?feed=old\";s:20:\".*wp-app\\.php(/.*)?$\";s:19:\"index.php?error=403\";s:18:\".*wp-register.php$\";s:23:\"index.php?register=true\";s:32:\"feed/(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:27:\"(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:8:\"embed/?$\";s:21:\"index.php?&embed=true\";s:20:\"page/?([0-9]{1,})/?$\";s:28:\"index.php?&paged=$matches[1]\";s:27:\"comment-page-([0-9]{1,})/?$\";s:39:\"index.php?&page_id=11&cpage=$matches[1]\";s:28:\"wc/file/transient(/(.*))?/?$\";s:40:\"index.php?&wc/file/transient=$matches[2]\";s:17:\"wc-api(/(.*))?/?$\";s:29:\"index.php?&wc-api=$matches[2]\";s:41:\"comments/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:36:\"comments/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:17:\"comments/embed/?$\";s:21:\"index.php?&embed=true\";s:37:\"comments/wc/file/transient(/(.*))?/?$\";s:40:\"index.php?&wc/file/transient=$matches[2]\";s:26:\"comments/wc-api(/(.*))?/?$\";s:29:\"index.php?&wc-api=$matches[2]\";s:44:\"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:39:\"search/(.+)/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:20:\"search/(.+)/embed/?$\";s:34:\"index.php?s=$matches[1]&embed=true\";s:32:\"search/(.+)/page/?([0-9]{1,})/?$\";s:41:\"index.php?s=$matches[1]&paged=$matches[2]\";s:40:\"search/(.+)/wc/file/transient(/(.*))?/?$\";s:53:\"index.php?s=$matches[1]&wc/file/transient=$matches[3]\";s:29:\"search/(.+)/wc-api(/(.*))?/?$\";s:42:\"index.php?s=$matches[1]&wc-api=$matches[3]\";s:14:\"search/(.+)/?$\";s:23:\"index.php?s=$matches[1]\";s:47:\"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:42:\"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:23:\"author/([^/]+)/embed/?$\";s:44:\"index.php?author_name=$matches[1]&embed=true\";s:35:\"author/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?author_name=$matches[1]&paged=$matches[2]\";s:43:\"author/([^/]+)/wc/file/transient(/(.*))?/?$\";s:63:\"index.php?author_name=$matches[1]&wc/file/transient=$matches[3]\";s:32:\"author/([^/]+)/wc-api(/(.*))?/?$\";s:52:\"index.php?author_name=$matches[1]&wc-api=$matches[3]\";s:17:\"author/([^/]+)/?$\";s:33:\"index.php?author_name=$matches[1]\";s:69:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:64:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:45:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$\";s:74:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true\";s:57:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]\";s:65:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/wc/file/transient(/(.*))?/?$\";s:93:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&wc/file/transient=$matches[5]\";s:54:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/wc-api(/(.*))?/?$\";s:82:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&wc-api=$matches[5]\";s:39:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$\";s:63:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]\";s:56:\"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:51:\"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:32:\"([0-9]{4})/([0-9]{1,2})/embed/?$\";s:58:\"index.php?year=$matches[1]&monthnum=$matches[2]&embed=true\";s:44:\"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]\";s:52:\"([0-9]{4})/([0-9]{1,2})/wc/file/transient(/(.*))?/?$\";s:77:\"index.php?year=$matches[1]&monthnum=$matches[2]&wc/file/transient=$matches[4]\";s:41:\"([0-9]{4})/([0-9]{1,2})/wc-api(/(.*))?/?$\";s:66:\"index.php?year=$matches[1]&monthnum=$matches[2]&wc-api=$matches[4]\";s:26:\"([0-9]{4})/([0-9]{1,2})/?$\";s:47:\"index.php?year=$matches[1]&monthnum=$matches[2]\";s:43:\"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:38:\"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:19:\"([0-9]{4})/embed/?$\";s:37:\"index.php?year=$matches[1]&embed=true\";s:31:\"([0-9]{4})/page/?([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&paged=$matches[2]\";s:39:\"([0-9]{4})/wc/file/transient(/(.*))?/?$\";s:56:\"index.php?year=$matches[1]&wc/file/transient=$matches[3]\";s:28:\"([0-9]{4})/wc-api(/(.*))?/?$\";s:45:\"index.php?year=$matches[1]&wc-api=$matches[3]\";s:13:\"([0-9]{4})/?$\";s:26:\"index.php?year=$matches[1]\";s:27:\".?.+?/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\".?.+?/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\".?.+?/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"(.?.+?)/embed/?$\";s:41:\"index.php?pagename=$matches[1]&embed=true\";s:20:\"(.?.+?)/trackback/?$\";s:35:\"index.php?pagename=$matches[1]&tb=1\";s:40:\"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:35:\"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:28:\"(.?.+?)/page/?([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&paged=$matches[2]\";s:35:\"(.?.+?)/comment-page-([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&cpage=$matches[2]\";s:36:\"(.?.+?)/wc/file/transient(/(.*))?/?$\";s:60:\"index.php?pagename=$matches[1]&wc/file/transient=$matches[3]\";s:25:\"(.?.+?)/wc-api(/(.*))?/?$\";s:49:\"index.php?pagename=$matches[1]&wc-api=$matches[3]\";s:28:\"(.?.+?)/order-pay(/(.*))?/?$\";s:52:\"index.php?pagename=$matches[1]&order-pay=$matches[3]\";s:33:\"(.?.+?)/order-received(/(.*))?/?$\";s:57:\"index.php?pagename=$matches[1]&order-received=$matches[3]\";s:25:\"(.?.+?)/orders(/(.*))?/?$\";s:49:\"index.php?pagename=$matches[1]&orders=$matches[3]\";s:29:\"(.?.+?)/view-order(/(.*))?/?$\";s:53:\"index.php?pagename=$matches[1]&view-order=$matches[3]\";s:28:\"(.?.+?)/downloads(/(.*))?/?$\";s:52:\"index.php?pagename=$matches[1]&downloads=$matches[3]\";s:31:\"(.?.+?)/edit-account(/(.*))?/?$\";s:55:\"index.php?pagename=$matches[1]&edit-account=$matches[3]\";s:31:\"(.?.+?)/edit-address(/(.*))?/?$\";s:55:\"index.php?pagename=$matches[1]&edit-address=$matches[3]\";s:34:\"(.?.+?)/payment-methods(/(.*))?/?$\";s:58:\"index.php?pagename=$matches[1]&payment-methods=$matches[3]\";s:32:\"(.?.+?)/lost-password(/(.*))?/?$\";s:56:\"index.php?pagename=$matches[1]&lost-password=$matches[3]\";s:34:\"(.?.+?)/customer-logout(/(.*))?/?$\";s:58:\"index.php?pagename=$matches[1]&customer-logout=$matches[3]\";s:37:\"(.?.+?)/add-payment-method(/(.*))?/?$\";s:61:\"index.php?pagename=$matches[1]&add-payment-method=$matches[3]\";s:40:\"(.?.+?)/delete-payment-method(/(.*))?/?$\";s:64:\"index.php?pagename=$matches[1]&delete-payment-method=$matches[3]\";s:45:\"(.?.+?)/set-default-payment-method(/(.*))?/?$\";s:69:\"index.php?pagename=$matches[1]&set-default-payment-method=$matches[3]\";s:42:\".?.+?/([^/]+)/wc/file/transient(/(.*))?/?$\";s:62:\"index.php?attachment=$matches[1]&wc/file/transient=$matches[3]\";s:53:\".?.+?/attachment/([^/]+)/wc/file/transient(/(.*))?/?$\";s:62:\"index.php?attachment=$matches[1]&wc/file/transient=$matches[3]\";s:31:\".?.+?/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:42:\".?.+?/attachment/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:24:\"(.?.+?)(?:/([0-9]+))?/?$\";s:47:\"index.php?pagename=$matches[1]&page=$matches[2]\";s:27:\"[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\"[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\"[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\"[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"([^/]+)/embed/?$\";s:37:\"index.php?name=$matches[1]&embed=true\";s:20:\"([^/]+)/trackback/?$\";s:31:\"index.php?name=$matches[1]&tb=1\";s:40:\"([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?name=$matches[1]&feed=$matches[2]\";s:35:\"([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?name=$matches[1]&feed=$matches[2]\";s:28:\"([^/]+)/page/?([0-9]{1,})/?$\";s:44:\"index.php?name=$matches[1]&paged=$matches[2]\";s:35:\"([^/]+)/comment-page-([0-9]{1,})/?$\";s:44:\"index.php?name=$matches[1]&cpage=$matches[2]\";s:36:\"([^/]+)/wc/file/transient(/(.*))?/?$\";s:56:\"index.php?name=$matches[1]&wc/file/transient=$matches[3]\";s:25:\"([^/]+)/wc-api(/(.*))?/?$\";s:45:\"index.php?name=$matches[1]&wc-api=$matches[3]\";s:42:\"[^/]+/([^/]+)/wc/file/transient(/(.*))?/?$\";s:62:\"index.php?attachment=$matches[1]&wc/file/transient=$matches[3]\";s:53:\"[^/]+/attachment/([^/]+)/wc/file/transient(/(.*))?/?$\";s:62:\"index.php?attachment=$matches[1]&wc/file/transient=$matches[3]\";s:31:\"[^/]+/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:42:\"[^/]+/attachment/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:24:\"([^/]+)(?:/([0-9]+))?/?$\";s:43:\"index.php?name=$matches[1]&page=$matches[2]\";s:16:\"[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:26:\"[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:46:\"[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:41:\"[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:41:\"[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:22:\"[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";}','on'),
(31,'hack_file','0','on'),
(32,'blog_charset','UTF-8','on'),
(33,'moderation_keys','','off'),
(34,'active_plugins','a:2:{i:0;s:47:\"azure-synthetics-core/azure-synthetics-core.php\";i:1;s:27:\"woocommerce/woocommerce.php\";}','on'),
(35,'category_base','','on'),
(36,'ping_sites','https://rpc.pingomatic.com/','on'),
(37,'comment_max_links','2','on'),
(38,'gmt_offset','0','on'),
(39,'default_email_category','1','on'),
(40,'recently_edited','','off'),
(41,'template','azure-synthetics','on'),
(42,'stylesheet','azure-synthetics','on'),
(43,'comment_registration','0','on'),
(44,'html_type','text/html','on'),
(45,'use_trackback','0','on'),
(46,'default_role','subscriber','on'),
(47,'db_version','60717','on'),
(48,'uploads_use_yearmonth_folders','1','on'),
(49,'upload_path','','on'),
(50,'blog_public','1','on'),
(51,'default_link_category','2','on'),
(52,'show_on_front','page','on'),
(53,'tag_base','','on'),
(54,'show_avatars','1','on'),
(55,'avatar_rating','G','on'),
(56,'upload_url_path','','on'),
(57,'thumbnail_size_w','150','on'),
(58,'thumbnail_size_h','150','on'),
(59,'thumbnail_crop','1','on'),
(60,'medium_size_w','300','on'),
(61,'medium_size_h','300','on'),
(62,'avatar_default','mystery','on'),
(63,'large_size_w','1024','on'),
(64,'large_size_h','1024','on'),
(65,'image_default_link_type','none','on'),
(66,'image_default_size','','on'),
(67,'image_default_align','','on'),
(68,'close_comments_for_old_posts','0','on'),
(69,'close_comments_days_old','14','on'),
(70,'thread_comments','1','on'),
(71,'thread_comments_depth','5','on'),
(72,'page_comments','0','on'),
(73,'comments_per_page','50','on'),
(74,'default_comments_page','newest','on'),
(75,'comment_order','asc','on'),
(76,'sticky_posts','a:0:{}','on'),
(77,'widget_categories','a:0:{}','on'),
(78,'widget_text','a:0:{}','on'),
(79,'widget_rss','a:0:{}','on'),
(80,'uninstall_plugins','a:0:{}','off'),
(81,'timezone_string','','on'),
(82,'page_for_posts','0','on'),
(83,'page_on_front','11','on'),
(84,'default_post_format','0','on'),
(85,'link_manager_enabled','0','on'),
(86,'finished_splitting_shared_terms','1','on'),
(87,'site_icon','0','on'),
(88,'medium_large_size_w','768','on'),
(89,'medium_large_size_h','0','on'),
(90,'wp_page_for_privacy_policy','3','on'),
(91,'show_comments_cookies_opt_in','1','on'),
(92,'admin_email_lifespan','1792166171','on'),
(93,'disallowed_keys','','off'),
(94,'comment_previously_approved','1','on'),
(95,'auto_plugin_theme_update_emails','a:0:{}','off'),
(96,'auto_update_core_dev','enabled','on'),
(97,'auto_update_core_minor','enabled','on'),
(98,'auto_update_core_major','enabled','on'),
(99,'wp_force_deactivated_plugins','a:0:{}','on'),
(100,'wp_attachment_pages_enabled','0','on'),
(101,'wp_notes_notify','1','on'),
(102,'initial_db_version','60717','on'),
(103,'wp_user_roles','a:7:{s:13:\"administrator\";a:2:{s:4:\"name\";s:13:\"Administrator\";s:12:\"capabilities\";a:115:{s:13:\"switch_themes\";b:1;s:11:\"edit_themes\";b:1;s:16:\"activate_plugins\";b:1;s:12:\"edit_plugins\";b:1;s:10:\"edit_users\";b:1;s:10:\"edit_files\";b:1;s:14:\"manage_options\";b:1;s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:6:\"import\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:8:\"level_10\";b:1;s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:12:\"delete_users\";b:1;s:12:\"create_users\";b:1;s:17:\"unfiltered_upload\";b:1;s:14:\"edit_dashboard\";b:1;s:14:\"update_plugins\";b:1;s:14:\"delete_plugins\";b:1;s:15:\"install_plugins\";b:1;s:13:\"update_themes\";b:1;s:14:\"install_themes\";b:1;s:11:\"update_core\";b:1;s:10:\"list_users\";b:1;s:12:\"remove_users\";b:1;s:13:\"promote_users\";b:1;s:18:\"edit_theme_options\";b:1;s:13:\"delete_themes\";b:1;s:6:\"export\";b:1;s:18:\"manage_woocommerce\";b:1;s:16:\"create_customers\";b:1;s:24:\"view_woocommerce_reports\";b:1;s:12:\"edit_product\";b:1;s:12:\"read_product\";b:1;s:14:\"delete_product\";b:1;s:13:\"edit_products\";b:1;s:20:\"edit_others_products\";b:1;s:16:\"publish_products\";b:1;s:21:\"read_private_products\";b:1;s:15:\"delete_products\";b:1;s:23:\"delete_private_products\";b:1;s:25:\"delete_published_products\";b:1;s:22:\"delete_others_products\";b:1;s:21:\"edit_private_products\";b:1;s:23:\"edit_published_products\";b:1;s:20:\"manage_product_terms\";b:1;s:18:\"edit_product_terms\";b:1;s:20:\"delete_product_terms\";b:1;s:20:\"assign_product_terms\";b:1;s:15:\"edit_shop_order\";b:1;s:15:\"read_shop_order\";b:1;s:17:\"delete_shop_order\";b:1;s:16:\"edit_shop_orders\";b:1;s:23:\"edit_others_shop_orders\";b:1;s:19:\"publish_shop_orders\";b:1;s:24:\"read_private_shop_orders\";b:1;s:18:\"delete_shop_orders\";b:1;s:26:\"delete_private_shop_orders\";b:1;s:28:\"delete_published_shop_orders\";b:1;s:25:\"delete_others_shop_orders\";b:1;s:24:\"edit_private_shop_orders\";b:1;s:26:\"edit_published_shop_orders\";b:1;s:23:\"manage_shop_order_terms\";b:1;s:21:\"edit_shop_order_terms\";b:1;s:23:\"delete_shop_order_terms\";b:1;s:23:\"assign_shop_order_terms\";b:1;s:16:\"edit_shop_coupon\";b:1;s:16:\"read_shop_coupon\";b:1;s:18:\"delete_shop_coupon\";b:1;s:17:\"edit_shop_coupons\";b:1;s:24:\"edit_others_shop_coupons\";b:1;s:20:\"publish_shop_coupons\";b:1;s:25:\"read_private_shop_coupons\";b:1;s:19:\"delete_shop_coupons\";b:1;s:27:\"delete_private_shop_coupons\";b:1;s:29:\"delete_published_shop_coupons\";b:1;s:26:\"delete_others_shop_coupons\";b:1;s:25:\"edit_private_shop_coupons\";b:1;s:27:\"edit_published_shop_coupons\";b:1;s:24:\"manage_shop_coupon_terms\";b:1;s:22:\"edit_shop_coupon_terms\";b:1;s:24:\"delete_shop_coupon_terms\";b:1;s:24:\"assign_shop_coupon_terms\";b:1;}}s:6:\"editor\";a:2:{s:4:\"name\";s:6:\"Editor\";s:12:\"capabilities\";a:34:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;}}s:6:\"author\";a:2:{s:4:\"name\";s:6:\"Author\";s:12:\"capabilities\";a:10:{s:12:\"upload_files\";b:1;s:10:\"edit_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;s:22:\"delete_published_posts\";b:1;}}s:11:\"contributor\";a:2:{s:4:\"name\";s:11:\"Contributor\";s:12:\"capabilities\";a:5:{s:10:\"edit_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;}}s:10:\"subscriber\";a:2:{s:4:\"name\";s:10:\"Subscriber\";s:12:\"capabilities\";a:2:{s:4:\"read\";b:1;s:7:\"level_0\";b:1;}}s:8:\"customer\";a:2:{s:4:\"name\";s:8:\"Customer\";s:12:\"capabilities\";a:1:{s:4:\"read\";b:1;}}s:12:\"shop_manager\";a:2:{s:4:\"name\";s:12:\"Shop manager\";s:12:\"capabilities\";a:93:{s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:4:\"read\";b:1;s:18:\"read_private_pages\";b:1;s:18:\"read_private_posts\";b:1;s:10:\"edit_posts\";b:1;s:10:\"edit_pages\";b:1;s:20:\"edit_published_posts\";b:1;s:20:\"edit_published_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"edit_private_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:17:\"edit_others_pages\";b:1;s:13:\"publish_posts\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_posts\";b:1;s:12:\"delete_pages\";b:1;s:20:\"delete_private_pages\";b:1;s:20:\"delete_private_posts\";b:1;s:22:\"delete_published_pages\";b:1;s:22:\"delete_published_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:19:\"delete_others_pages\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:17:\"moderate_comments\";b:1;s:12:\"upload_files\";b:1;s:6:\"export\";b:1;s:6:\"import\";b:1;s:10:\"list_users\";b:1;s:18:\"edit_theme_options\";b:1;s:18:\"manage_woocommerce\";b:1;s:16:\"create_customers\";b:1;s:24:\"view_woocommerce_reports\";b:1;s:12:\"edit_product\";b:1;s:12:\"read_product\";b:1;s:14:\"delete_product\";b:1;s:13:\"edit_products\";b:1;s:20:\"edit_others_products\";b:1;s:16:\"publish_products\";b:1;s:21:\"read_private_products\";b:1;s:15:\"delete_products\";b:1;s:23:\"delete_private_products\";b:1;s:25:\"delete_published_products\";b:1;s:22:\"delete_others_products\";b:1;s:21:\"edit_private_products\";b:1;s:23:\"edit_published_products\";b:1;s:20:\"manage_product_terms\";b:1;s:18:\"edit_product_terms\";b:1;s:20:\"delete_product_terms\";b:1;s:20:\"assign_product_terms\";b:1;s:15:\"edit_shop_order\";b:1;s:15:\"read_shop_order\";b:1;s:17:\"delete_shop_order\";b:1;s:16:\"edit_shop_orders\";b:1;s:23:\"edit_others_shop_orders\";b:1;s:19:\"publish_shop_orders\";b:1;s:24:\"read_private_shop_orders\";b:1;s:18:\"delete_shop_orders\";b:1;s:26:\"delete_private_shop_orders\";b:1;s:28:\"delete_published_shop_orders\";b:1;s:25:\"delete_others_shop_orders\";b:1;s:24:\"edit_private_shop_orders\";b:1;s:26:\"edit_published_shop_orders\";b:1;s:23:\"manage_shop_order_terms\";b:1;s:21:\"edit_shop_order_terms\";b:1;s:23:\"delete_shop_order_terms\";b:1;s:23:\"assign_shop_order_terms\";b:1;s:16:\"edit_shop_coupon\";b:1;s:16:\"read_shop_coupon\";b:1;s:18:\"delete_shop_coupon\";b:1;s:17:\"edit_shop_coupons\";b:1;s:24:\"edit_others_shop_coupons\";b:1;s:20:\"publish_shop_coupons\";b:1;s:25:\"read_private_shop_coupons\";b:1;s:19:\"delete_shop_coupons\";b:1;s:27:\"delete_private_shop_coupons\";b:1;s:29:\"delete_published_shop_coupons\";b:1;s:26:\"delete_others_shop_coupons\";b:1;s:25:\"edit_private_shop_coupons\";b:1;s:27:\"edit_published_shop_coupons\";b:1;s:24:\"manage_shop_coupon_terms\";b:1;s:22:\"edit_shop_coupon_terms\";b:1;s:24:\"delete_shop_coupon_terms\";b:1;s:24:\"assign_shop_coupon_terms\";b:1;}}}','on'),
(104,'fresh_site','0','off'),
(105,'user_count','1','off'),
(106,'widget_block','a:6:{i:2;a:1:{s:7:\"content\";s:19:\"<!-- wp:search /-->\";}i:3;a:1:{s:7:\"content\";s:154:\"<!-- wp:group --><div class=\"wp-block-group\"><!-- wp:heading --><h2>Recent Posts</h2><!-- /wp:heading --><!-- wp:latest-posts /--></div><!-- /wp:group -->\";}i:4;a:1:{s:7:\"content\";s:227:\"<!-- wp:group --><div class=\"wp-block-group\"><!-- wp:heading --><h2>Recent Comments</h2><!-- /wp:heading --><!-- wp:latest-comments {\"displayAvatar\":false,\"displayDate\":false,\"displayExcerpt\":false} /--></div><!-- /wp:group -->\";}i:5;a:1:{s:7:\"content\";s:146:\"<!-- wp:group --><div class=\"wp-block-group\"><!-- wp:heading --><h2>Archives</h2><!-- /wp:heading --><!-- wp:archives /--></div><!-- /wp:group -->\";}i:6;a:1:{s:7:\"content\";s:150:\"<!-- wp:group --><div class=\"wp-block-group\"><!-- wp:heading --><h2>Categories</h2><!-- /wp:heading --><!-- wp:categories /--></div><!-- /wp:group -->\";}s:12:\"_multiwidget\";i:1;}','auto'),
(107,'sidebars_widgets','a:3:{s:19:\"wp_inactive_widgets\";a:2:{i:0;s:7:\"block-5\";i:1;s:7:\"block-6\";}s:12:\"shop-sidebar\";a:3:{i:0;s:7:\"block-2\";i:1;s:7:\"block-3\";i:2;s:7:\"block-4\";}s:13:\"array_version\";i:3;}','auto'),
(108,'widget_pages','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(109,'widget_calendar','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(110,'widget_archives','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(111,'widget_media_audio','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(112,'widget_media_image','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(113,'widget_media_gallery','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(114,'widget_media_video','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(115,'widget_meta','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(116,'widget_search','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(117,'widget_recent-posts','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(118,'widget_recent-comments','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(119,'widget_tag_cloud','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(120,'widget_nav_menu','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(121,'widget_custom_html','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(122,'_transient_wp_core_block_css_files','a:2:{s:7:\"version\";s:5:\"6.9.4\";s:5:\"files\";a:584:{i:0;s:31:\"accordion-heading/style-rtl.css\";i:1;s:35:\"accordion-heading/style-rtl.min.css\";i:2;s:27:\"accordion-heading/style.css\";i:3;s:31:\"accordion-heading/style.min.css\";i:4;s:28:\"accordion-item/style-rtl.css\";i:5;s:32:\"accordion-item/style-rtl.min.css\";i:6;s:24:\"accordion-item/style.css\";i:7;s:28:\"accordion-item/style.min.css\";i:8;s:29:\"accordion-panel/style-rtl.css\";i:9;s:33:\"accordion-panel/style-rtl.min.css\";i:10;s:25:\"accordion-panel/style.css\";i:11;s:29:\"accordion-panel/style.min.css\";i:12;s:23:\"accordion/style-rtl.css\";i:13;s:27:\"accordion/style-rtl.min.css\";i:14;s:19:\"accordion/style.css\";i:15;s:23:\"accordion/style.min.css\";i:16;s:23:\"archives/editor-rtl.css\";i:17;s:27:\"archives/editor-rtl.min.css\";i:18;s:19:\"archives/editor.css\";i:19;s:23:\"archives/editor.min.css\";i:20;s:22:\"archives/style-rtl.css\";i:21;s:26:\"archives/style-rtl.min.css\";i:22;s:18:\"archives/style.css\";i:23;s:22:\"archives/style.min.css\";i:24;s:20:\"audio/editor-rtl.css\";i:25;s:24:\"audio/editor-rtl.min.css\";i:26;s:16:\"audio/editor.css\";i:27;s:20:\"audio/editor.min.css\";i:28;s:19:\"audio/style-rtl.css\";i:29;s:23:\"audio/style-rtl.min.css\";i:30;s:15:\"audio/style.css\";i:31;s:19:\"audio/style.min.css\";i:32;s:19:\"audio/theme-rtl.css\";i:33;s:23:\"audio/theme-rtl.min.css\";i:34;s:15:\"audio/theme.css\";i:35;s:19:\"audio/theme.min.css\";i:36;s:21:\"avatar/editor-rtl.css\";i:37;s:25:\"avatar/editor-rtl.min.css\";i:38;s:17:\"avatar/editor.css\";i:39;s:21:\"avatar/editor.min.css\";i:40;s:20:\"avatar/style-rtl.css\";i:41;s:24:\"avatar/style-rtl.min.css\";i:42;s:16:\"avatar/style.css\";i:43;s:20:\"avatar/style.min.css\";i:44;s:21:\"button/editor-rtl.css\";i:45;s:25:\"button/editor-rtl.min.css\";i:46;s:17:\"button/editor.css\";i:47;s:21:\"button/editor.min.css\";i:48;s:20:\"button/style-rtl.css\";i:49;s:24:\"button/style-rtl.min.css\";i:50;s:16:\"button/style.css\";i:51;s:20:\"button/style.min.css\";i:52;s:22:\"buttons/editor-rtl.css\";i:53;s:26:\"buttons/editor-rtl.min.css\";i:54;s:18:\"buttons/editor.css\";i:55;s:22:\"buttons/editor.min.css\";i:56;s:21:\"buttons/style-rtl.css\";i:57;s:25:\"buttons/style-rtl.min.css\";i:58;s:17:\"buttons/style.css\";i:59;s:21:\"buttons/style.min.css\";i:60;s:22:\"calendar/style-rtl.css\";i:61;s:26:\"calendar/style-rtl.min.css\";i:62;s:18:\"calendar/style.css\";i:63;s:22:\"calendar/style.min.css\";i:64;s:25:\"categories/editor-rtl.css\";i:65;s:29:\"categories/editor-rtl.min.css\";i:66;s:21:\"categories/editor.css\";i:67;s:25:\"categories/editor.min.css\";i:68;s:24:\"categories/style-rtl.css\";i:69;s:28:\"categories/style-rtl.min.css\";i:70;s:20:\"categories/style.css\";i:71;s:24:\"categories/style.min.css\";i:72;s:19:\"code/editor-rtl.css\";i:73;s:23:\"code/editor-rtl.min.css\";i:74;s:15:\"code/editor.css\";i:75;s:19:\"code/editor.min.css\";i:76;s:18:\"code/style-rtl.css\";i:77;s:22:\"code/style-rtl.min.css\";i:78;s:14:\"code/style.css\";i:79;s:18:\"code/style.min.css\";i:80;s:18:\"code/theme-rtl.css\";i:81;s:22:\"code/theme-rtl.min.css\";i:82;s:14:\"code/theme.css\";i:83;s:18:\"code/theme.min.css\";i:84;s:22:\"columns/editor-rtl.css\";i:85;s:26:\"columns/editor-rtl.min.css\";i:86;s:18:\"columns/editor.css\";i:87;s:22:\"columns/editor.min.css\";i:88;s:21:\"columns/style-rtl.css\";i:89;s:25:\"columns/style-rtl.min.css\";i:90;s:17:\"columns/style.css\";i:91;s:21:\"columns/style.min.css\";i:92;s:33:\"comment-author-name/style-rtl.css\";i:93;s:37:\"comment-author-name/style-rtl.min.css\";i:94;s:29:\"comment-author-name/style.css\";i:95;s:33:\"comment-author-name/style.min.css\";i:96;s:29:\"comment-content/style-rtl.css\";i:97;s:33:\"comment-content/style-rtl.min.css\";i:98;s:25:\"comment-content/style.css\";i:99;s:29:\"comment-content/style.min.css\";i:100;s:26:\"comment-date/style-rtl.css\";i:101;s:30:\"comment-date/style-rtl.min.css\";i:102;s:22:\"comment-date/style.css\";i:103;s:26:\"comment-date/style.min.css\";i:104;s:31:\"comment-edit-link/style-rtl.css\";i:105;s:35:\"comment-edit-link/style-rtl.min.css\";i:106;s:27:\"comment-edit-link/style.css\";i:107;s:31:\"comment-edit-link/style.min.css\";i:108;s:32:\"comment-reply-link/style-rtl.css\";i:109;s:36:\"comment-reply-link/style-rtl.min.css\";i:110;s:28:\"comment-reply-link/style.css\";i:111;s:32:\"comment-reply-link/style.min.css\";i:112;s:30:\"comment-template/style-rtl.css\";i:113;s:34:\"comment-template/style-rtl.min.css\";i:114;s:26:\"comment-template/style.css\";i:115;s:30:\"comment-template/style.min.css\";i:116;s:42:\"comments-pagination-numbers/editor-rtl.css\";i:117;s:46:\"comments-pagination-numbers/editor-rtl.min.css\";i:118;s:38:\"comments-pagination-numbers/editor.css\";i:119;s:42:\"comments-pagination-numbers/editor.min.css\";i:120;s:34:\"comments-pagination/editor-rtl.css\";i:121;s:38:\"comments-pagination/editor-rtl.min.css\";i:122;s:30:\"comments-pagination/editor.css\";i:123;s:34:\"comments-pagination/editor.min.css\";i:124;s:33:\"comments-pagination/style-rtl.css\";i:125;s:37:\"comments-pagination/style-rtl.min.css\";i:126;s:29:\"comments-pagination/style.css\";i:127;s:33:\"comments-pagination/style.min.css\";i:128;s:29:\"comments-title/editor-rtl.css\";i:129;s:33:\"comments-title/editor-rtl.min.css\";i:130;s:25:\"comments-title/editor.css\";i:131;s:29:\"comments-title/editor.min.css\";i:132;s:23:\"comments/editor-rtl.css\";i:133;s:27:\"comments/editor-rtl.min.css\";i:134;s:19:\"comments/editor.css\";i:135;s:23:\"comments/editor.min.css\";i:136;s:22:\"comments/style-rtl.css\";i:137;s:26:\"comments/style-rtl.min.css\";i:138;s:18:\"comments/style.css\";i:139;s:22:\"comments/style.min.css\";i:140;s:20:\"cover/editor-rtl.css\";i:141;s:24:\"cover/editor-rtl.min.css\";i:142;s:16:\"cover/editor.css\";i:143;s:20:\"cover/editor.min.css\";i:144;s:19:\"cover/style-rtl.css\";i:145;s:23:\"cover/style-rtl.min.css\";i:146;s:15:\"cover/style.css\";i:147;s:19:\"cover/style.min.css\";i:148;s:22:\"details/editor-rtl.css\";i:149;s:26:\"details/editor-rtl.min.css\";i:150;s:18:\"details/editor.css\";i:151;s:22:\"details/editor.min.css\";i:152;s:21:\"details/style-rtl.css\";i:153;s:25:\"details/style-rtl.min.css\";i:154;s:17:\"details/style.css\";i:155;s:21:\"details/style.min.css\";i:156;s:20:\"embed/editor-rtl.css\";i:157;s:24:\"embed/editor-rtl.min.css\";i:158;s:16:\"embed/editor.css\";i:159;s:20:\"embed/editor.min.css\";i:160;s:19:\"embed/style-rtl.css\";i:161;s:23:\"embed/style-rtl.min.css\";i:162;s:15:\"embed/style.css\";i:163;s:19:\"embed/style.min.css\";i:164;s:19:\"embed/theme-rtl.css\";i:165;s:23:\"embed/theme-rtl.min.css\";i:166;s:15:\"embed/theme.css\";i:167;s:19:\"embed/theme.min.css\";i:168;s:19:\"file/editor-rtl.css\";i:169;s:23:\"file/editor-rtl.min.css\";i:170;s:15:\"file/editor.css\";i:171;s:19:\"file/editor.min.css\";i:172;s:18:\"file/style-rtl.css\";i:173;s:22:\"file/style-rtl.min.css\";i:174;s:14:\"file/style.css\";i:175;s:18:\"file/style.min.css\";i:176;s:23:\"footnotes/style-rtl.css\";i:177;s:27:\"footnotes/style-rtl.min.css\";i:178;s:19:\"footnotes/style.css\";i:179;s:23:\"footnotes/style.min.css\";i:180;s:23:\"freeform/editor-rtl.css\";i:181;s:27:\"freeform/editor-rtl.min.css\";i:182;s:19:\"freeform/editor.css\";i:183;s:23:\"freeform/editor.min.css\";i:184;s:22:\"gallery/editor-rtl.css\";i:185;s:26:\"gallery/editor-rtl.min.css\";i:186;s:18:\"gallery/editor.css\";i:187;s:22:\"gallery/editor.min.css\";i:188;s:21:\"gallery/style-rtl.css\";i:189;s:25:\"gallery/style-rtl.min.css\";i:190;s:17:\"gallery/style.css\";i:191;s:21:\"gallery/style.min.css\";i:192;s:21:\"gallery/theme-rtl.css\";i:193;s:25:\"gallery/theme-rtl.min.css\";i:194;s:17:\"gallery/theme.css\";i:195;s:21:\"gallery/theme.min.css\";i:196;s:20:\"group/editor-rtl.css\";i:197;s:24:\"group/editor-rtl.min.css\";i:198;s:16:\"group/editor.css\";i:199;s:20:\"group/editor.min.css\";i:200;s:19:\"group/style-rtl.css\";i:201;s:23:\"group/style-rtl.min.css\";i:202;s:15:\"group/style.css\";i:203;s:19:\"group/style.min.css\";i:204;s:19:\"group/theme-rtl.css\";i:205;s:23:\"group/theme-rtl.min.css\";i:206;s:15:\"group/theme.css\";i:207;s:19:\"group/theme.min.css\";i:208;s:21:\"heading/style-rtl.css\";i:209;s:25:\"heading/style-rtl.min.css\";i:210;s:17:\"heading/style.css\";i:211;s:21:\"heading/style.min.css\";i:212;s:19:\"html/editor-rtl.css\";i:213;s:23:\"html/editor-rtl.min.css\";i:214;s:15:\"html/editor.css\";i:215;s:19:\"html/editor.min.css\";i:216;s:20:\"image/editor-rtl.css\";i:217;s:24:\"image/editor-rtl.min.css\";i:218;s:16:\"image/editor.css\";i:219;s:20:\"image/editor.min.css\";i:220;s:19:\"image/style-rtl.css\";i:221;s:23:\"image/style-rtl.min.css\";i:222;s:15:\"image/style.css\";i:223;s:19:\"image/style.min.css\";i:224;s:19:\"image/theme-rtl.css\";i:225;s:23:\"image/theme-rtl.min.css\";i:226;s:15:\"image/theme.css\";i:227;s:19:\"image/theme.min.css\";i:228;s:29:\"latest-comments/style-rtl.css\";i:229;s:33:\"latest-comments/style-rtl.min.css\";i:230;s:25:\"latest-comments/style.css\";i:231;s:29:\"latest-comments/style.min.css\";i:232;s:27:\"latest-posts/editor-rtl.css\";i:233;s:31:\"latest-posts/editor-rtl.min.css\";i:234;s:23:\"latest-posts/editor.css\";i:235;s:27:\"latest-posts/editor.min.css\";i:236;s:26:\"latest-posts/style-rtl.css\";i:237;s:30:\"latest-posts/style-rtl.min.css\";i:238;s:22:\"latest-posts/style.css\";i:239;s:26:\"latest-posts/style.min.css\";i:240;s:18:\"list/style-rtl.css\";i:241;s:22:\"list/style-rtl.min.css\";i:242;s:14:\"list/style.css\";i:243;s:18:\"list/style.min.css\";i:244;s:22:\"loginout/style-rtl.css\";i:245;s:26:\"loginout/style-rtl.min.css\";i:246;s:18:\"loginout/style.css\";i:247;s:22:\"loginout/style.min.css\";i:248;s:19:\"math/editor-rtl.css\";i:249;s:23:\"math/editor-rtl.min.css\";i:250;s:15:\"math/editor.css\";i:251;s:19:\"math/editor.min.css\";i:252;s:18:\"math/style-rtl.css\";i:253;s:22:\"math/style-rtl.min.css\";i:254;s:14:\"math/style.css\";i:255;s:18:\"math/style.min.css\";i:256;s:25:\"media-text/editor-rtl.css\";i:257;s:29:\"media-text/editor-rtl.min.css\";i:258;s:21:\"media-text/editor.css\";i:259;s:25:\"media-text/editor.min.css\";i:260;s:24:\"media-text/style-rtl.css\";i:261;s:28:\"media-text/style-rtl.min.css\";i:262;s:20:\"media-text/style.css\";i:263;s:24:\"media-text/style.min.css\";i:264;s:19:\"more/editor-rtl.css\";i:265;s:23:\"more/editor-rtl.min.css\";i:266;s:15:\"more/editor.css\";i:267;s:19:\"more/editor.min.css\";i:268;s:30:\"navigation-link/editor-rtl.css\";i:269;s:34:\"navigation-link/editor-rtl.min.css\";i:270;s:26:\"navigation-link/editor.css\";i:271;s:30:\"navigation-link/editor.min.css\";i:272;s:29:\"navigation-link/style-rtl.css\";i:273;s:33:\"navigation-link/style-rtl.min.css\";i:274;s:25:\"navigation-link/style.css\";i:275;s:29:\"navigation-link/style.min.css\";i:276;s:33:\"navigation-submenu/editor-rtl.css\";i:277;s:37:\"navigation-submenu/editor-rtl.min.css\";i:278;s:29:\"navigation-submenu/editor.css\";i:279;s:33:\"navigation-submenu/editor.min.css\";i:280;s:25:\"navigation/editor-rtl.css\";i:281;s:29:\"navigation/editor-rtl.min.css\";i:282;s:21:\"navigation/editor.css\";i:283;s:25:\"navigation/editor.min.css\";i:284;s:24:\"navigation/style-rtl.css\";i:285;s:28:\"navigation/style-rtl.min.css\";i:286;s:20:\"navigation/style.css\";i:287;s:24:\"navigation/style.min.css\";i:288;s:23:\"nextpage/editor-rtl.css\";i:289;s:27:\"nextpage/editor-rtl.min.css\";i:290;s:19:\"nextpage/editor.css\";i:291;s:23:\"nextpage/editor.min.css\";i:292;s:24:\"page-list/editor-rtl.css\";i:293;s:28:\"page-list/editor-rtl.min.css\";i:294;s:20:\"page-list/editor.css\";i:295;s:24:\"page-list/editor.min.css\";i:296;s:23:\"page-list/style-rtl.css\";i:297;s:27:\"page-list/style-rtl.min.css\";i:298;s:19:\"page-list/style.css\";i:299;s:23:\"page-list/style.min.css\";i:300;s:24:\"paragraph/editor-rtl.css\";i:301;s:28:\"paragraph/editor-rtl.min.css\";i:302;s:20:\"paragraph/editor.css\";i:303;s:24:\"paragraph/editor.min.css\";i:304;s:23:\"paragraph/style-rtl.css\";i:305;s:27:\"paragraph/style-rtl.min.css\";i:306;s:19:\"paragraph/style.css\";i:307;s:23:\"paragraph/style.min.css\";i:308;s:35:\"post-author-biography/style-rtl.css\";i:309;s:39:\"post-author-biography/style-rtl.min.css\";i:310;s:31:\"post-author-biography/style.css\";i:311;s:35:\"post-author-biography/style.min.css\";i:312;s:30:\"post-author-name/style-rtl.css\";i:313;s:34:\"post-author-name/style-rtl.min.css\";i:314;s:26:\"post-author-name/style.css\";i:315;s:30:\"post-author-name/style.min.css\";i:316;s:25:\"post-author/style-rtl.css\";i:317;s:29:\"post-author/style-rtl.min.css\";i:318;s:21:\"post-author/style.css\";i:319;s:25:\"post-author/style.min.css\";i:320;s:33:\"post-comments-count/style-rtl.css\";i:321;s:37:\"post-comments-count/style-rtl.min.css\";i:322;s:29:\"post-comments-count/style.css\";i:323;s:33:\"post-comments-count/style.min.css\";i:324;s:33:\"post-comments-form/editor-rtl.css\";i:325;s:37:\"post-comments-form/editor-rtl.min.css\";i:326;s:29:\"post-comments-form/editor.css\";i:327;s:33:\"post-comments-form/editor.min.css\";i:328;s:32:\"post-comments-form/style-rtl.css\";i:329;s:36:\"post-comments-form/style-rtl.min.css\";i:330;s:28:\"post-comments-form/style.css\";i:331;s:32:\"post-comments-form/style.min.css\";i:332;s:32:\"post-comments-link/style-rtl.css\";i:333;s:36:\"post-comments-link/style-rtl.min.css\";i:334;s:28:\"post-comments-link/style.css\";i:335;s:32:\"post-comments-link/style.min.css\";i:336;s:26:\"post-content/style-rtl.css\";i:337;s:30:\"post-content/style-rtl.min.css\";i:338;s:22:\"post-content/style.css\";i:339;s:26:\"post-content/style.min.css\";i:340;s:23:\"post-date/style-rtl.css\";i:341;s:27:\"post-date/style-rtl.min.css\";i:342;s:19:\"post-date/style.css\";i:343;s:23:\"post-date/style.min.css\";i:344;s:27:\"post-excerpt/editor-rtl.css\";i:345;s:31:\"post-excerpt/editor-rtl.min.css\";i:346;s:23:\"post-excerpt/editor.css\";i:347;s:27:\"post-excerpt/editor.min.css\";i:348;s:26:\"post-excerpt/style-rtl.css\";i:349;s:30:\"post-excerpt/style-rtl.min.css\";i:350;s:22:\"post-excerpt/style.css\";i:351;s:26:\"post-excerpt/style.min.css\";i:352;s:34:\"post-featured-image/editor-rtl.css\";i:353;s:38:\"post-featured-image/editor-rtl.min.css\";i:354;s:30:\"post-featured-image/editor.css\";i:355;s:34:\"post-featured-image/editor.min.css\";i:356;s:33:\"post-featured-image/style-rtl.css\";i:357;s:37:\"post-featured-image/style-rtl.min.css\";i:358;s:29:\"post-featured-image/style.css\";i:359;s:33:\"post-featured-image/style.min.css\";i:360;s:34:\"post-navigation-link/style-rtl.css\";i:361;s:38:\"post-navigation-link/style-rtl.min.css\";i:362;s:30:\"post-navigation-link/style.css\";i:363;s:34:\"post-navigation-link/style.min.css\";i:364;s:27:\"post-template/style-rtl.css\";i:365;s:31:\"post-template/style-rtl.min.css\";i:366;s:23:\"post-template/style.css\";i:367;s:27:\"post-template/style.min.css\";i:368;s:24:\"post-terms/style-rtl.css\";i:369;s:28:\"post-terms/style-rtl.min.css\";i:370;s:20:\"post-terms/style.css\";i:371;s:24:\"post-terms/style.min.css\";i:372;s:31:\"post-time-to-read/style-rtl.css\";i:373;s:35:\"post-time-to-read/style-rtl.min.css\";i:374;s:27:\"post-time-to-read/style.css\";i:375;s:31:\"post-time-to-read/style.min.css\";i:376;s:24:\"post-title/style-rtl.css\";i:377;s:28:\"post-title/style-rtl.min.css\";i:378;s:20:\"post-title/style.css\";i:379;s:24:\"post-title/style.min.css\";i:380;s:26:\"preformatted/style-rtl.css\";i:381;s:30:\"preformatted/style-rtl.min.css\";i:382;s:22:\"preformatted/style.css\";i:383;s:26:\"preformatted/style.min.css\";i:384;s:24:\"pullquote/editor-rtl.css\";i:385;s:28:\"pullquote/editor-rtl.min.css\";i:386;s:20:\"pullquote/editor.css\";i:387;s:24:\"pullquote/editor.min.css\";i:388;s:23:\"pullquote/style-rtl.css\";i:389;s:27:\"pullquote/style-rtl.min.css\";i:390;s:19:\"pullquote/style.css\";i:391;s:23:\"pullquote/style.min.css\";i:392;s:23:\"pullquote/theme-rtl.css\";i:393;s:27:\"pullquote/theme-rtl.min.css\";i:394;s:19:\"pullquote/theme.css\";i:395;s:23:\"pullquote/theme.min.css\";i:396;s:39:\"query-pagination-numbers/editor-rtl.css\";i:397;s:43:\"query-pagination-numbers/editor-rtl.min.css\";i:398;s:35:\"query-pagination-numbers/editor.css\";i:399;s:39:\"query-pagination-numbers/editor.min.css\";i:400;s:31:\"query-pagination/editor-rtl.css\";i:401;s:35:\"query-pagination/editor-rtl.min.css\";i:402;s:27:\"query-pagination/editor.css\";i:403;s:31:\"query-pagination/editor.min.css\";i:404;s:30:\"query-pagination/style-rtl.css\";i:405;s:34:\"query-pagination/style-rtl.min.css\";i:406;s:26:\"query-pagination/style.css\";i:407;s:30:\"query-pagination/style.min.css\";i:408;s:25:\"query-title/style-rtl.css\";i:409;s:29:\"query-title/style-rtl.min.css\";i:410;s:21:\"query-title/style.css\";i:411;s:25:\"query-title/style.min.css\";i:412;s:25:\"query-total/style-rtl.css\";i:413;s:29:\"query-total/style-rtl.min.css\";i:414;s:21:\"query-total/style.css\";i:415;s:25:\"query-total/style.min.css\";i:416;s:20:\"query/editor-rtl.css\";i:417;s:24:\"query/editor-rtl.min.css\";i:418;s:16:\"query/editor.css\";i:419;s:20:\"query/editor.min.css\";i:420;s:19:\"quote/style-rtl.css\";i:421;s:23:\"quote/style-rtl.min.css\";i:422;s:15:\"quote/style.css\";i:423;s:19:\"quote/style.min.css\";i:424;s:19:\"quote/theme-rtl.css\";i:425;s:23:\"quote/theme-rtl.min.css\";i:426;s:15:\"quote/theme.css\";i:427;s:19:\"quote/theme.min.css\";i:428;s:23:\"read-more/style-rtl.css\";i:429;s:27:\"read-more/style-rtl.min.css\";i:430;s:19:\"read-more/style.css\";i:431;s:23:\"read-more/style.min.css\";i:432;s:18:\"rss/editor-rtl.css\";i:433;s:22:\"rss/editor-rtl.min.css\";i:434;s:14:\"rss/editor.css\";i:435;s:18:\"rss/editor.min.css\";i:436;s:17:\"rss/style-rtl.css\";i:437;s:21:\"rss/style-rtl.min.css\";i:438;s:13:\"rss/style.css\";i:439;s:17:\"rss/style.min.css\";i:440;s:21:\"search/editor-rtl.css\";i:441;s:25:\"search/editor-rtl.min.css\";i:442;s:17:\"search/editor.css\";i:443;s:21:\"search/editor.min.css\";i:444;s:20:\"search/style-rtl.css\";i:445;s:24:\"search/style-rtl.min.css\";i:446;s:16:\"search/style.css\";i:447;s:20:\"search/style.min.css\";i:448;s:20:\"search/theme-rtl.css\";i:449;s:24:\"search/theme-rtl.min.css\";i:450;s:16:\"search/theme.css\";i:451;s:20:\"search/theme.min.css\";i:452;s:24:\"separator/editor-rtl.css\";i:453;s:28:\"separator/editor-rtl.min.css\";i:454;s:20:\"separator/editor.css\";i:455;s:24:\"separator/editor.min.css\";i:456;s:23:\"separator/style-rtl.css\";i:457;s:27:\"separator/style-rtl.min.css\";i:458;s:19:\"separator/style.css\";i:459;s:23:\"separator/style.min.css\";i:460;s:23:\"separator/theme-rtl.css\";i:461;s:27:\"separator/theme-rtl.min.css\";i:462;s:19:\"separator/theme.css\";i:463;s:23:\"separator/theme.min.css\";i:464;s:24:\"shortcode/editor-rtl.css\";i:465;s:28:\"shortcode/editor-rtl.min.css\";i:466;s:20:\"shortcode/editor.css\";i:467;s:24:\"shortcode/editor.min.css\";i:468;s:24:\"site-logo/editor-rtl.css\";i:469;s:28:\"site-logo/editor-rtl.min.css\";i:470;s:20:\"site-logo/editor.css\";i:471;s:24:\"site-logo/editor.min.css\";i:472;s:23:\"site-logo/style-rtl.css\";i:473;s:27:\"site-logo/style-rtl.min.css\";i:474;s:19:\"site-logo/style.css\";i:475;s:23:\"site-logo/style.min.css\";i:476;s:27:\"site-tagline/editor-rtl.css\";i:477;s:31:\"site-tagline/editor-rtl.min.css\";i:478;s:23:\"site-tagline/editor.css\";i:479;s:27:\"site-tagline/editor.min.css\";i:480;s:26:\"site-tagline/style-rtl.css\";i:481;s:30:\"site-tagline/style-rtl.min.css\";i:482;s:22:\"site-tagline/style.css\";i:483;s:26:\"site-tagline/style.min.css\";i:484;s:25:\"site-title/editor-rtl.css\";i:485;s:29:\"site-title/editor-rtl.min.css\";i:486;s:21:\"site-title/editor.css\";i:487;s:25:\"site-title/editor.min.css\";i:488;s:24:\"site-title/style-rtl.css\";i:489;s:28:\"site-title/style-rtl.min.css\";i:490;s:20:\"site-title/style.css\";i:491;s:24:\"site-title/style.min.css\";i:492;s:26:\"social-link/editor-rtl.css\";i:493;s:30:\"social-link/editor-rtl.min.css\";i:494;s:22:\"social-link/editor.css\";i:495;s:26:\"social-link/editor.min.css\";i:496;s:27:\"social-links/editor-rtl.css\";i:497;s:31:\"social-links/editor-rtl.min.css\";i:498;s:23:\"social-links/editor.css\";i:499;s:27:\"social-links/editor.min.css\";i:500;s:26:\"social-links/style-rtl.css\";i:501;s:30:\"social-links/style-rtl.min.css\";i:502;s:22:\"social-links/style.css\";i:503;s:26:\"social-links/style.min.css\";i:504;s:21:\"spacer/editor-rtl.css\";i:505;s:25:\"spacer/editor-rtl.min.css\";i:506;s:17:\"spacer/editor.css\";i:507;s:21:\"spacer/editor.min.css\";i:508;s:20:\"spacer/style-rtl.css\";i:509;s:24:\"spacer/style-rtl.min.css\";i:510;s:16:\"spacer/style.css\";i:511;s:20:\"spacer/style.min.css\";i:512;s:20:\"table/editor-rtl.css\";i:513;s:24:\"table/editor-rtl.min.css\";i:514;s:16:\"table/editor.css\";i:515;s:20:\"table/editor.min.css\";i:516;s:19:\"table/style-rtl.css\";i:517;s:23:\"table/style-rtl.min.css\";i:518;s:15:\"table/style.css\";i:519;s:19:\"table/style.min.css\";i:520;s:19:\"table/theme-rtl.css\";i:521;s:23:\"table/theme-rtl.min.css\";i:522;s:15:\"table/theme.css\";i:523;s:19:\"table/theme.min.css\";i:524;s:24:\"tag-cloud/editor-rtl.css\";i:525;s:28:\"tag-cloud/editor-rtl.min.css\";i:526;s:20:\"tag-cloud/editor.css\";i:527;s:24:\"tag-cloud/editor.min.css\";i:528;s:23:\"tag-cloud/style-rtl.css\";i:529;s:27:\"tag-cloud/style-rtl.min.css\";i:530;s:19:\"tag-cloud/style.css\";i:531;s:23:\"tag-cloud/style.min.css\";i:532;s:28:\"template-part/editor-rtl.css\";i:533;s:32:\"template-part/editor-rtl.min.css\";i:534;s:24:\"template-part/editor.css\";i:535;s:28:\"template-part/editor.min.css\";i:536;s:27:\"template-part/theme-rtl.css\";i:537;s:31:\"template-part/theme-rtl.min.css\";i:538;s:23:\"template-part/theme.css\";i:539;s:27:\"template-part/theme.min.css\";i:540;s:24:\"term-count/style-rtl.css\";i:541;s:28:\"term-count/style-rtl.min.css\";i:542;s:20:\"term-count/style.css\";i:543;s:24:\"term-count/style.min.css\";i:544;s:30:\"term-description/style-rtl.css\";i:545;s:34:\"term-description/style-rtl.min.css\";i:546;s:26:\"term-description/style.css\";i:547;s:30:\"term-description/style.min.css\";i:548;s:23:\"term-name/style-rtl.css\";i:549;s:27:\"term-name/style-rtl.min.css\";i:550;s:19:\"term-name/style.css\";i:551;s:23:\"term-name/style.min.css\";i:552;s:28:\"term-template/editor-rtl.css\";i:553;s:32:\"term-template/editor-rtl.min.css\";i:554;s:24:\"term-template/editor.css\";i:555;s:28:\"term-template/editor.min.css\";i:556;s:27:\"term-template/style-rtl.css\";i:557;s:31:\"term-template/style-rtl.min.css\";i:558;s:23:\"term-template/style.css\";i:559;s:27:\"term-template/style.min.css\";i:560;s:27:\"text-columns/editor-rtl.css\";i:561;s:31:\"text-columns/editor-rtl.min.css\";i:562;s:23:\"text-columns/editor.css\";i:563;s:27:\"text-columns/editor.min.css\";i:564;s:26:\"text-columns/style-rtl.css\";i:565;s:30:\"text-columns/style-rtl.min.css\";i:566;s:22:\"text-columns/style.css\";i:567;s:26:\"text-columns/style.min.css\";i:568;s:19:\"verse/style-rtl.css\";i:569;s:23:\"verse/style-rtl.min.css\";i:570;s:15:\"verse/style.css\";i:571;s:19:\"verse/style.min.css\";i:572;s:20:\"video/editor-rtl.css\";i:573;s:24:\"video/editor-rtl.min.css\";i:574;s:16:\"video/editor.css\";i:575;s:20:\"video/editor.min.css\";i:576;s:19:\"video/style-rtl.css\";i:577;s:23:\"video/style-rtl.min.css\";i:578;s:15:\"video/style.css\";i:579;s:19:\"video/style.min.css\";i:580;s:19:\"video/theme-rtl.css\";i:581;s:23:\"video/theme-rtl.min.css\";i:582;s:15:\"video/theme.css\";i:583;s:19:\"video/theme.min.css\";}}','on'),
(127,'theme_mods_twentytwentyfive','a:2:{s:18:\"custom_css_post_id\";i:-1;s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1776614800;s:4:\"data\";a:3:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:3:{i:0;s:7:\"block-2\";i:1;s:7:\"block-3\";i:2;s:7:\"block-4\";}s:9:\"sidebar-2\";a:2:{i:0;s:7:\"block-5\";i:1;s:7:\"block-6\";}}}}','off'),
(128,'_transient_wp_styles_for_blocks','a:2:{s:4:\"hash\";s:32:\"39b3a0a5221a418af7681ca0e79cf85c\";s:6:\"blocks\";a:6:{s:11:\"core/button\";s:0:\"\";s:14:\"core/site-logo\";s:0:\"\";s:18:\"core/post-template\";s:0:\"\";s:18:\"core/term-template\";s:0:\"\";s:12:\"core/columns\";s:0:\"\";s:14:\"core/pullquote\";s:69:\":root :where(.wp-block-pullquote){font-size: 1.5em;line-height: 1.6;}\";}}','on'),
(129,'_site_transient_update_core','O:8:\"stdClass\":4:{s:7:\"updates\";a:1:{i:0;O:8:\"stdClass\":10:{s:8:\"response\";s:6:\"latest\";s:8:\"download\";s:59:\"https://downloads.wordpress.org/release/wordpress-6.9.4.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:59:\"https://downloads.wordpress.org/release/wordpress-6.9.4.zip\";s:10:\"no_content\";s:70:\"https://downloads.wordpress.org/release/wordpress-6.9.4-no-content.zip\";s:11:\"new_bundled\";s:71:\"https://downloads.wordpress.org/release/wordpress-6.9.4-new-bundled.zip\";s:7:\"partial\";s:0:\"\";s:8:\"rollback\";s:0:\"\";}s:7:\"current\";s:5:\"6.9.4\";s:7:\"version\";s:5:\"6.9.4\";s:11:\"php_version\";s:6:\"7.2.24\";s:13:\"mysql_version\";s:5:\"5.5.5\";s:11:\"new_bundled\";s:3:\"6.7\";s:15:\"partial_version\";s:0:\"\";}}s:12:\"last_checked\";i:1776725776;s:15:\"version_checked\";s:5:\"6.9.4\";s:12:\"translations\";a:0:{}}','off'),
(134,'action_scheduler_hybrid_store_demarkation','5','auto'),
(135,'schema-ActionScheduler_StoreSchema','8.0.1776614797','auto'),
(136,'schema-ActionScheduler_LoggerSchema','3.0.1776614797','auto'),
(142,'woocommerce_newly_installed','yes','auto'),
(143,'woocommerce_order_stats_has_fulfillment_column','no','off'),
(144,'woocommerce_schema_version','920','auto'),
(145,'woocommerce_store_address','','on'),
(146,'woocommerce_store_address_2','','on'),
(147,'woocommerce_store_city','','on'),
(148,'woocommerce_default_country','US:CA','on'),
(149,'woocommerce_store_postcode','','on'),
(150,'woocommerce_allowed_countries','all','on'),
(151,'woocommerce_all_except_countries','','on'),
(152,'woocommerce_specific_allowed_countries','','on'),
(153,'woocommerce_ship_to_countries','','on'),
(154,'woocommerce_specific_ship_to_countries','','on'),
(155,'woocommerce_default_customer_address','base','on'),
(156,'woocommerce_address_autocomplete_enabled','no','on'),
(157,'woocommerce_calc_taxes','no','on'),
(158,'woocommerce_enable_coupons','yes','on'),
(159,'woocommerce_calc_discounts_sequentially','no','off'),
(160,'woocommerce_currency','USD','on'),
(161,'woocommerce_currency_pos','left','on'),
(162,'woocommerce_price_thousand_sep',',','on'),
(163,'woocommerce_price_decimal_sep','.','on'),
(164,'woocommerce_price_num_decimals','2','on'),
(165,'woocommerce_shop_page_id','6','on'),
(166,'woocommerce_cart_redirect_after_add','no','on'),
(167,'woocommerce_enable_ajax_add_to_cart','yes','on'),
(168,'woocommerce_placeholder_image','5','on'),
(169,'woocommerce_weight_unit','lbs','on'),
(170,'woocommerce_dimension_unit','in','on'),
(171,'woocommerce_enable_reviews','yes','on'),
(172,'woocommerce_review_rating_verification_label','yes','off'),
(173,'woocommerce_review_rating_verification_required','no','off'),
(174,'woocommerce_enable_review_rating','yes','on'),
(175,'woocommerce_review_rating_required','yes','off'),
(176,'woocommerce_manage_stock','yes','on'),
(177,'woocommerce_hold_stock_minutes','60','off'),
(178,'woocommerce_notify_low_stock','yes','off'),
(179,'woocommerce_notify_no_stock','yes','off'),
(180,'woocommerce_stock_email_recipient','admin@example.com','off'),
(181,'woocommerce_notify_low_stock_amount','2','off'),
(182,'woocommerce_notify_no_stock_amount','0','on'),
(183,'woocommerce_hide_out_of_stock_items','no','on'),
(184,'woocommerce_stock_format','','on'),
(185,'woocommerce_file_download_method','force','off'),
(186,'woocommerce_downloads_redirect_fallback_allowed','no','off'),
(187,'woocommerce_downloads_require_login','no','off'),
(188,'woocommerce_downloads_grant_access_after_payment','yes','off'),
(189,'woocommerce_downloads_deliver_inline','','off'),
(190,'woocommerce_downloads_add_hash_to_filename','yes','on'),
(191,'woocommerce_downloads_count_partial','yes','on'),
(193,'woocommerce_attribute_lookup_direct_updates','no','on'),
(194,'woocommerce_attribute_lookup_optimized_updates','no','on'),
(195,'woocommerce_product_match_featured_image_by_sku','no','on'),
(196,'woocommerce_prices_include_tax','no','on'),
(197,'woocommerce_tax_based_on','shipping','on'),
(198,'woocommerce_shipping_tax_class','inherit','on'),
(199,'woocommerce_tax_round_at_subtotal','no','on'),
(200,'woocommerce_tax_classes','','on'),
(201,'woocommerce_tax_display_shop','excl','on'),
(202,'woocommerce_tax_display_cart','excl','on'),
(203,'woocommerce_price_display_suffix','','on'),
(204,'woocommerce_tax_total_display','itemized','off'),
(205,'woocommerce_enable_shipping_calc','yes','off'),
(206,'woocommerce_shipping_cost_requires_address','no','on'),
(207,'woocommerce_shipping_hide_rates_when_free','no','off'),
(208,'woocommerce_ship_to_destination','billing','off'),
(209,'woocommerce_shipping_debug_mode','no','on'),
(210,'woocommerce_enable_guest_checkout','yes','off'),
(211,'woocommerce_enable_checkout_login_reminder','no','off'),
(212,'woocommerce_enable_delayed_account_creation','no','off'),
(213,'woocommerce_enable_signup_and_login_from_checkout','no','off'),
(214,'woocommerce_enable_myaccount_registration','no','off'),
(215,'woocommerce_registration_generate_password','yes','off'),
(216,'woocommerce_registration_generate_username','yes','off'),
(217,'woocommerce_erasure_request_removes_order_data','no','off'),
(218,'woocommerce_erasure_request_removes_download_data','no','off'),
(219,'woocommerce_allow_bulk_remove_personal_data','no','off'),
(220,'woocommerce_registration_privacy_policy_text','Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our [privacy_policy].','on'),
(221,'woocommerce_checkout_privacy_policy_text','Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our [privacy_policy].','on'),
(222,'woocommerce_delete_inactive_accounts','a:2:{s:6:\"number\";s:0:\"\";s:4:\"unit\";s:6:\"months\";}','off'),
(223,'woocommerce_trash_pending_orders','','off'),
(224,'woocommerce_trash_failed_orders','','off'),
(225,'woocommerce_trash_cancelled_orders','','off'),
(226,'woocommerce_anonymize_refunded_orders','a:2:{s:6:\"number\";s:0:\"\";s:4:\"unit\";s:6:\"months\";}','off'),
(227,'woocommerce_anonymize_completed_orders','a:2:{s:6:\"number\";s:0:\"\";s:4:\"unit\";s:6:\"months\";}','off'),
(228,'woocommerce_email_from_address','admin@example.com','off'),
(229,'woocommerce_email_header_image','','off'),
(230,'woocommerce_email_header_image_width','120','on'),
(231,'woocommerce_email_header_alignment','left','on'),
(232,'woocommerce_email_font_family','Helvetica','on'),
(233,'woocommerce_email_footer_text','{site_title}<br />{store_address}','off'),
(234,'woocommerce_email_base_color','#720eec','off'),
(235,'woocommerce_email_background_color','#f7f7f7','off'),
(236,'woocommerce_email_body_background_color','#ffffff','off'),
(237,'woocommerce_email_text_color','#3c3c3c','off'),
(238,'woocommerce_email_footer_text_color','#3c3c3c','off'),
(239,'woocommerce_email_auto_sync_with_theme','no','off'),
(240,'woocommerce_pos_store_address','','on'),
(241,'woocommerce_pos_store_phone','','on'),
(242,'woocommerce_pos_store_email','admin@example.com','on'),
(243,'woocommerce_pos_refund_returns_policy','','on'),
(244,'woocommerce_cart_page_id','7','off'),
(245,'woocommerce_checkout_page_id','8','off'),
(246,'woocommerce_myaccount_page_id','9','off'),
(247,'woocommerce_terms_page_id','18','off'),
(248,'woocommerce_force_ssl_checkout','no','on'),
(249,'woocommerce_unforce_ssl_checkout','no','on'),
(250,'woocommerce_checkout_pay_endpoint','order-pay','on'),
(251,'woocommerce_checkout_order_received_endpoint','order-received','on'),
(252,'woocommerce_myaccount_add_payment_method_endpoint','add-payment-method','on'),
(253,'woocommerce_myaccount_delete_payment_method_endpoint','delete-payment-method','on'),
(254,'woocommerce_myaccount_set_default_payment_method_endpoint','set-default-payment-method','on'),
(255,'woocommerce_myaccount_orders_endpoint','orders','on'),
(256,'woocommerce_myaccount_view_order_endpoint','view-order','on'),
(257,'woocommerce_myaccount_downloads_endpoint','downloads','on'),
(258,'woocommerce_myaccount_edit_account_endpoint','edit-account','on'),
(259,'woocommerce_myaccount_edit_address_endpoint','edit-address','on'),
(260,'woocommerce_myaccount_payment_methods_endpoint','payment-methods','on'),
(261,'woocommerce_myaccount_lost_password_endpoint','lost-password','on'),
(262,'woocommerce_logout_endpoint','customer-logout','on'),
(263,'woocommerce_api_enabled','no','on'),
(264,'woocommerce_allow_tracking','no','on'),
(265,'woocommerce_show_marketplace_suggestions','yes','off'),
(266,'woocommerce_custom_orders_table_enabled','no','on'),
(267,'woocommerce_analytics_enabled','yes','on'),
(268,'woocommerce_feature_rate_limit_checkout_enabled','no','on'),
(269,'woocommerce_feature_order_attribution_enabled','yes','on'),
(270,'woocommerce_feature_site_visibility_badge_enabled','yes','on'),
(271,'woocommerce_hpos_datastore_caching_enabled','no','on'),
(272,'woocommerce_feature_remote_logging_enabled','yes','on'),
(273,'woocommerce_feature_email_improvements_enabled','no','on'),
(274,'_transient_timeout_wc_settings_email_improvements_reverted','1776614813','off'),
(275,'_transient_wc_settings_email_improvements_reverted','yes','off'),
(276,'woocommerce_email_improvements_disabled_count','1','auto'),
(277,'woocommerce_email_improvements_first_disabled_at','2026-04-19 16:06:38','auto'),
(278,'woocommerce_email_improvements_last_disabled_at','2026-04-19 16:06:38','auto'),
(279,'woocommerce_feature_blueprint_enabled','yes','on'),
(280,'woocommerce_feature_cost_of_goods_sold_enabled','no','on'),
(281,'woocommerce_hpos_fts_index_enabled','no','on'),
(282,'woocommerce_feature_block_email_editor_enabled','no','on'),
(283,'woocommerce_feature_point_of_sale_enabled','yes','on'),
(284,'woocommerce_feature_mcp_integration_enabled','no','on'),
(285,'woocommerce_feature_destroy-empty-sessions_enabled','no','on'),
(286,'woocommerce_feature_rest_api_caching_enabled','no','on'),
(287,'woocommerce_feature_product_instance_caching_enabled','no','on'),
(288,'woocommerce_single_image_width','600','on'),
(289,'woocommerce_thumbnail_image_width','300','on'),
(290,'woocommerce_checkout_highlight_required_fields','yes','on'),
(291,'woocommerce_demo_store','no','off'),
(292,'wc_downloads_approved_directories_mode','enabled','auto'),
(293,'woocommerce_permalinks','a:5:{s:12:\"product_base\";s:7:\"product\";s:13:\"category_base\";s:16:\"product-category\";s:8:\"tag_base\";s:11:\"product-tag\";s:14:\"attribute_base\";s:0:\"\";s:22:\"use_verbose_page_rules\";b:0;}','auto'),
(294,'current_theme_supports_woocommerce','yes','auto'),
(295,'woocommerce_queue_flush_rewrite_rules','no','auto'),
(296,'_transient_wc_attribute_taxonomies','a:0:{}','on'),
(300,'default_product_cat','15','auto'),
(301,'woocommerce_refund_returns_page_id','10','auto'),
(302,'_transient_timeout__wc_activation_redirect','1776614829','off'),
(303,'_transient__wc_activation_redirect','1','off'),
(304,'woocommerce_paypal_settings','a:25:{s:7:\"enabled\";s:2:\"no\";s:5:\"title\";s:6:\"PayPal\";s:11:\"description\";s:85:\"Pay via PayPal; you can pay with your credit card if you don\'t have a PayPal account.\";s:5:\"email\";s:17:\"admin@example.com\";s:8:\"advanced\";s:0:\"\";s:8:\"testmode\";s:2:\"no\";s:13:\"paymentaction\";s:4:\"sale\";s:14:\"paypal_buttons\";s:3:\"yes\";s:14:\"invoice_prefix\";s:3:\"WC-\";s:13:\"send_shipping\";s:3:\"yes\";s:16:\"address_override\";s:2:\"no\";s:5:\"debug\";s:2:\"no\";s:9:\"image_url\";s:0:\"\";s:16:\"ipn_notification\";s:3:\"yes\";s:14:\"receiver_email\";s:17:\"admin@example.com\";s:14:\"identity_token\";s:0:\"\";s:11:\"api_details\";s:0:\"\";s:12:\"api_username\";s:0:\"\";s:12:\"api_password\";s:0:\"\";s:13:\"api_signature\";s:0:\"\";s:20:\"sandbox_api_username\";s:0:\"\";s:20:\"sandbox_api_password\";s:0:\"\";s:21:\"sandbox_api_signature\";s:0:\"\";s:28:\"transact_onboarding_complete\";s:2:\"no\";s:12:\"_should_load\";s:2:\"no\";}','on'),
(305,'woocommerce_version','10.7.0','auto'),
(306,'woocommerce_db_version','10.7.0','auto'),
(307,'woocommerce_store_id','a21a5889-d77e-4e5f-a610-f944cf0fc21a','auto'),
(308,'woocommerce_admin_install_timestamp','1776614799','auto'),
(309,'woocommerce_inbox_variant_assignment','4','auto'),
(310,'woocommerce_remote_variant_assignment','50','auto'),
(311,'woocommerce_attribute_lookup_enabled','no','auto'),
(312,'_transient_timeout__woocommerce_upload_directory_status','1776701199','off'),
(313,'_transient__woocommerce_upload_directory_status','protected','off'),
(314,'_transient_woocommerce_activated_plugin','woocommerce/woocommerce.php','on'),
(315,'_transient_jetpack_autoloader_plugin_paths','a:1:{i:0;s:29:\"{{WP_PLUGIN_DIR}}/woocommerce\";}','on'),
(316,'woocommerce_admin_notices','a:2:{i:0;s:20:\"no_secure_connection\";i:1;s:14:\"template_files\";}','auto'),
(317,'woocommerce_maxmind_geolocation_settings','a:1:{s:15:\"database_prefix\";s:32:\"RbQE3E49HckWCPYXxqSWX2GsYP1f1N76\";}','on'),
(318,'_transient_woocommerce_webhook_ids_status_active','a:0:{}','on'),
(319,'widget_woocommerce_widget_cart','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(320,'widget_woocommerce_layered_nav_filters','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(321,'widget_woocommerce_layered_nav','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(322,'widget_woocommerce_price_filter','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(323,'widget_woocommerce_product_categories','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(324,'widget_woocommerce_product_search','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(325,'widget_woocommerce_product_tag_cloud','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(326,'widget_woocommerce_products','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(327,'widget_woocommerce_recently_viewed_products','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(328,'widget_woocommerce_top_rated_products','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(329,'widget_woocommerce_recent_reviews','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(330,'widget_woocommerce_rating_filter','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(331,'widget_wc_brands_brand_description','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(332,'widget_woocommerce_brand_nav','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(333,'widget_wc_brands_brand_thumbnails','a:1:{s:12:\"_multiwidget\";i:1;}','auto'),
(334,'_site_transient_timeout_woocommerce_blocks_patterns','1779206799','off'),
(335,'_site_transient_woocommerce_blocks_patterns','a:2:{s:7:\"version\";s:6:\"10.7.0\";s:8:\"patterns\";a:41:{i:0;a:11:{s:5:\"title\";s:6:\"Banner\";s:4:\"slug\";s:25:\"woocommerce-blocks/banner\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:29:\"WooCommerce, featured-selling\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:10:\"banner.php\";}i:1;a:11:{s:5:\"title\";s:23:\"Coming Soon Entire Site\";s:4:\"slug\";s:35:\"woocommerce/coming-soon-entire-site\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:11:\"WooCommerce\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:5:\"false\";s:11:\"featureFlag\";s:17:\"launch-your-store\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:27:\"coming-soon-entire-site.php\";}i:2;a:11:{s:5:\"title\";s:22:\"Coming Soon Store Only\";s:4:\"slug\";s:34:\"woocommerce/coming-soon-store-only\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:11:\"WooCommerce\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:5:\"false\";s:11:\"featureFlag\";s:17:\"launch-your-store\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:26:\"coming-soon-store-only.php\";}i:3;a:11:{s:5:\"title\";s:11:\"Coming Soon\";s:4:\"slug\";s:23:\"woocommerce/coming-soon\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:11:\"WooCommerce\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:5:\"false\";s:11:\"featureFlag\";s:17:\"launch-your-store\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:15:\"coming-soon.php\";}i:4;a:11:{s:5:\"title\";s:29:\"Content Right with Image Left\";s:4:\"slug\";s:48:\"woocommerce-blocks/content-right-with-image-left\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:18:\"WooCommerce, About\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:28:\"content-right-image-left.php\";}i:5;a:11:{s:5:\"title\";s:29:\"Featured Category Cover Image\";s:4:\"slug\";s:48:\"woocommerce-blocks/featured-category-cover-image\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:18:\"WooCommerce, Intro\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:33:\"featured-category-cover-image.php\";}i:6;a:11:{s:5:\"title\";s:24:\"Featured Category Triple\";s:4:\"slug\";s:43:\"woocommerce-blocks/featured-category-triple\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:29:\"WooCommerce, featured-selling\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:28:\"featured-category-triple.php\";}i:7;a:11:{s:5:\"title\";s:12:\"Large Footer\";s:4:\"slug\";s:31:\"woocommerce-blocks/footer-large\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:11:\"WooCommerce\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:25:\"core/template-part/footer\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:16:\"footer-large.php\";}i:8;a:11:{s:5:\"title\";s:23:\"Footer with Simple Menu\";s:4:\"slug\";s:37:\"woocommerce-blocks/footer-simple-menu\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:11:\"WooCommerce\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:25:\"core/template-part/footer\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:22:\"footer-simple-menu.php\";}i:9;a:11:{s:5:\"title\";s:19:\"Footer with 3 Menus\";s:4:\"slug\";s:38:\"woocommerce-blocks/footer-with-3-menus\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:11:\"WooCommerce\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:25:\"core/template-part/footer\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:23:\"footer-with-3-menus.php\";}i:10;a:11:{s:5:\"title\";s:28:\"Four Image Grid Content Left\";s:4:\"slug\";s:47:\"woocommerce-blocks/four-image-grid-content-left\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:18:\"WooCommerce, About\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:32:\"four-image-grid-content-left.php\";}i:11;a:11:{s:5:\"title\";s:20:\"Centered Header Menu\";s:4:\"slug\";s:39:\"woocommerce-blocks/header-centered-menu\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:11:\"WooCommerce\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:25:\"core/template-part/header\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:27:\"header-centered-pattern.php\";}i:12;a:11:{s:5:\"title\";s:23:\"Distraction Free Header\";s:4:\"slug\";s:42:\"woocommerce-blocks/header-distraction-free\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:11:\"WooCommerce\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:25:\"core/template-part/header\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:27:\"header-distraction-free.php\";}i:13;a:11:{s:5:\"title\";s:16:\"Essential Header\";s:4:\"slug\";s:35:\"woocommerce-blocks/header-essential\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:11:\"WooCommerce\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:25:\"core/template-part/header\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:20:\"header-essential.php\";}i:14;a:11:{s:5:\"title\";s:12:\"Large Header\";s:4:\"slug\";s:31:\"woocommerce-blocks/header-large\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:11:\"WooCommerce\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:25:\"core/template-part/header\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:16:\"header-large.php\";}i:15;a:11:{s:5:\"title\";s:14:\"Minimal Header\";s:4:\"slug\";s:33:\"woocommerce-blocks/header-minimal\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:11:\"WooCommerce\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:25:\"core/template-part/header\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:18:\"header-minimal.php\";}i:16;a:11:{s:5:\"title\";s:46:\"Heading with Three Columns of Content and Link\";s:4:\"slug\";s:66:\"woocommerce-blocks/heading-with-three-columns-of-content-with-link\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:21:\"WooCommerce, Services\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:51:\"heading-with-three-columns-of-content-with-link.php\";}i:17;a:11:{s:5:\"title\";s:20:\"Hero Product 3 Split\";s:4:\"slug\";s:39:\"woocommerce-blocks/hero-product-3-split\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:29:\"WooCommerce, featured-selling\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:24:\"hero-product-3-split.php\";}i:18;a:11:{s:5:\"title\";s:23:\"Hero Product Chessboard\";s:4:\"slug\";s:42:\"woocommerce-blocks/hero-product-chessboard\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:29:\"WooCommerce, featured-selling\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:27:\"hero-product-chessboard.php\";}i:19;a:11:{s:5:\"title\";s:18:\"Hero Product Split\";s:4:\"slug\";s:37:\"woocommerce-blocks/hero-product-split\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:18:\"WooCommerce, Intro\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:22:\"hero-product-split.php\";}i:20;a:11:{s:5:\"title\";s:33:\"Centered Content with Image Below\";s:4:\"slug\";s:52:\"woocommerce-blocks/centered-content-with-image-below\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:18:\"WooCommerce, Intro\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:43:\"intro-centered-content-with-image-below.php\";}i:21;a:11:{s:5:\"title\";s:22:\"Just Arrived Full Hero\";s:4:\"slug\";s:41:\"woocommerce-blocks/just-arrived-full-hero\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:18:\"WooCommerce, Intro\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:26:\"just-arrived-full-hero.php\";}i:22;a:11:{s:5:\"title\";s:33:\"No Products Found - Clear Filters\";s:4:\"slug\";s:43:\"woocommerce/no-products-found-clear-filters\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:11:\"WooCommerce\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:2:\"no\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:29:\"no-products-found-filters.php\";}i:23;a:11:{s:5:\"title\";s:17:\"No Products Found\";s:4:\"slug\";s:29:\"woocommerce/no-products-found\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:11:\"WooCommerce\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:2:\"no\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:21:\"no-products-found.php\";}i:24;a:11:{s:5:\"title\";s:19:\"Default Coming Soon\";s:4:\"slug\";s:36:\"woocommerce/page-coming-soon-default\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:11:\"WooCommerce\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:5:\"false\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:11:\"coming-soon\";s:6:\"source\";s:28:\"page-coming-soon-default.php\";}i:25;a:11:{s:5:\"title\";s:25:\"Coming Soon Image Gallery\";s:4:\"slug\";s:42:\"woocommerce/page-coming-soon-image-gallery\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:11:\"WooCommerce\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:5:\"false\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:11:\"coming-soon\";s:6:\"source\";s:34:\"page-coming-soon-image-gallery.php\";}i:26;a:11:{s:5:\"title\";s:30:\"Coming Soon Minimal Left Image\";s:4:\"slug\";s:47:\"woocommerce/page-coming-soon-minimal-left-image\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:11:\"WooCommerce\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:5:\"false\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:11:\"coming-soon\";s:6:\"source\";s:39:\"page-coming-soon-minimal-left-image.php\";}i:27;a:11:{s:5:\"title\";s:24:\"Coming Soon Modern Black\";s:4:\"slug\";s:41:\"woocommerce/page-coming-soon-modern-black\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:11:\"WooCommerce\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:5:\"false\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:11:\"coming-soon\";s:6:\"source\";s:33:\"page-coming-soon-modern-black.php\";}i:28;a:11:{s:5:\"title\";s:29:\"Coming Soon Split Right Image\";s:4:\"slug\";s:46:\"woocommerce/page-coming-soon-split-right-image\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:11:\"WooCommerce\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:5:\"false\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:11:\"coming-soon\";s:6:\"source\";s:38:\"page-coming-soon-split-right-image.php\";}i:29;a:11:{s:5:\"title\";s:34:\"Coming Soon with Header and Footer\";s:4:\"slug\";s:47:\"woocommerce/page-coming-soon-with-header-footer\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:11:\"WooCommerce\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:5:\"false\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:11:\"coming-soon\";s:6:\"source\";s:39:\"page-coming-soon-with-header-footer.php\";}i:30;a:11:{s:5:\"title\";s:28:\"Product Collection 3 Columns\";s:4:\"slug\";s:47:\"woocommerce-blocks/product-collection-3-columns\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:11:\"WooCommerce\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:32:\"product-collection-3-columns.php\";}i:31;a:11:{s:5:\"title\";s:28:\"Product Collection 4 Columns\";s:4:\"slug\";s:47:\"woocommerce-blocks/product-collection-4-columns\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:29:\"WooCommerce, featured-selling\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:32:\"product-collection-4-columns.php\";}i:32;a:11:{s:5:\"title\";s:28:\"Product Collection 5 Columns\";s:4:\"slug\";s:47:\"woocommerce-blocks/product-collection-5-columns\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:29:\"WooCommerce, featured-selling\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:32:\"product-collection-5-columns.php\";}i:33;a:11:{s:5:\"title\";s:47:\"Product Collection: Featured Products 5 Columns\";s:4:\"slug\";s:65:\"woocommerce-blocks/product-collection-featured-products-5-columns\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:29:\"WooCommerce, featured-selling\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:50:\"product-collection-featured-products-5-columns.php\";}i:34;a:11:{s:5:\"title\";s:15:\"Product Gallery\";s:4:\"slug\";s:48:\"woocommerce-blocks/product-query-product-gallery\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:29:\"WooCommerce, featured-selling\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:36:\"core/query/woocommerce/product-query\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:33:\"product-query-product-gallery.php\";}i:35;a:11:{s:5:\"title\";s:14:\"Product Search\";s:4:\"slug\";s:31:\"woocommerce/product-search-form\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:11:\"WooCommerce\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:2:\"no\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:23:\"product-search-form.php\";}i:36;a:11:{s:5:\"title\";s:16:\"Related Products\";s:4:\"slug\";s:35:\"woocommerce-blocks/related-products\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:11:\"WooCommerce\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:5:\"false\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:20:\"related-products.php\";}i:37;a:11:{s:5:\"title\";s:33:\"Social: Follow Us on Social Media\";s:4:\"slug\";s:51:\"woocommerce-blocks/social-follow-us-in-social-media\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:25:\"WooCommerce, social-media\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:36:\"social-follow-us-in-social-media.php\";}i:38;a:11:{s:5:\"title\";s:22:\"Testimonials 3 Columns\";s:4:\"slug\";s:41:\"woocommerce-blocks/testimonials-3-columns\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:20:\"WooCommerce, Reviews\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:26:\"testimonials-3-columns.php\";}i:39;a:11:{s:5:\"title\";s:18:\"Testimonial Single\";s:4:\"slug\";s:38:\"woocommerce-blocks/testimonials-single\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:20:\"WooCommerce, Reviews\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:23:\"testimonials-single.php\";}i:40;a:11:{s:5:\"title\";s:37:\"Three Columns with Images and Content\";s:4:\"slug\";s:56:\"woocommerce-blocks/three-columns-with-images-and-content\";s:11:\"description\";s:0:\"\";s:13:\"viewportWidth\";s:0:\"\";s:10:\"categories\";s:21:\"WooCommerce, Services\";s:8:\"keywords\";s:0:\"\";s:10:\"blockTypes\";s:0:\"\";s:8:\"inserter\";s:0:\"\";s:11:\"featureFlag\";s:0:\"\";s:13:\"templateTypes\";s:0:\"\";s:6:\"source\";s:41:\"three-columns-with-images-and-content.php\";}}}','off'),
(336,'woocommerce_checkout_phone_field','optional','auto'),
(337,'woocommerce_checkout_company_field','hidden','auto'),
(338,'woocommerce_checkout_address_2_field','optional','auto'),
(339,'current_theme','Azure Synthetics','auto'),
(340,'theme_switched','','auto'),
(341,'_transient_timeout_woocommerce_blocks_asset_api_script_data','1779318114','off'),
(342,'_transient_woocommerce_blocks_asset_api_script_data','{\"script_data\":{\"assets\\/client\\/blocks\\/wc-settings.js\":{\"src\":\"http:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-settings.js\",\"version\":\"a6cb3c938fd270888ce4\",\"dependencies\":[\"wc-types\",\"wp-hooks\",\"wp-polyfill\"]},\"assets\\/client\\/blocks\\/wc-types.js\":{\"src\":\"http:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-types.js\",\"version\":\"f0cc692c0367e0930c80\",\"dependencies\":[\"wp-polyfill\"]},\"assets\\/client\\/blocks\\/wc-entities.js\":{\"src\":\"http:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-entities.js\",\"version\":\"cdb01de69fb7dbbbb30f\",\"dependencies\":[\"wc-settings\",\"wp-core-data\",\"wp-data\",\"wp-i18n\",\"wp-polyfill\"]},\"assets\\/client\\/blocks\\/wc-blocks-middleware.js\":{\"src\":\"http:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-blocks-middleware.js\",\"version\":\"d79dedade2f2e4dc9df4\",\"dependencies\":[\"wp-api-fetch\",\"wp-polyfill\",\"wp-url\"]},\"assets\\/client\\/blocks\\/wc-blocks-data.js\":{\"src\":\"http:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-blocks-data.js\",\"version\":\"ffb2849a705ee55d810e\",\"dependencies\":[\"wc-blocks-checkout-events\",\"wc-blocks-registry\",\"wc-settings\",\"wc-types\",\"wp-api-fetch\",\"wp-data\",\"wp-data-controls\",\"wp-deprecated\",\"wp-dom\",\"wp-element\",\"wp-hooks\",\"wp-html-entities\",\"wp-i18n\",\"wp-is-shallow-equal\",\"wp-notices\",\"wp-polyfill\",\"wp-url\"]},\"assets\\/client\\/blocks\\/wc-blocks-vendors.js\":{\"src\":\"http:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-blocks-vendors.js\",\"version\":\"9b3f9ad7437063887d6c\",\"dependencies\":[\"wp-polyfill\"]},\"assets\\/client\\/blocks\\/wc-blocks-registry.js\":{\"src\":\"http:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-blocks-registry.js\",\"version\":\"6436a923b42f4d1b1f6d\",\"dependencies\":[\"react-jsx-runtime\",\"wc-settings\",\"wp-data\",\"wp-deprecated\",\"wp-element\",\"wp-hooks\",\"wp-polyfill\"]},\"assets\\/client\\/blocks\\/wc-blocks.js\":{\"src\":\"http:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-blocks.js\",\"version\":\"0db759a8a6e010732c50\",\"dependencies\":[\"react-jsx-runtime\",\"wp-blocks\",\"wp-compose\",\"wp-element\",\"wp-hooks\",\"wp-polyfill\"]},\"assets\\/client\\/blocks\\/wc-blocks-shared-context.js\":{\"src\":\"http:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-blocks-shared-context.js\",\"version\":\"621353d8a3a7c8d44b41\",\"dependencies\":[\"react-jsx-runtime\",\"wp-element\",\"wp-polyfill\"]},\"assets\\/client\\/blocks\\/wc-blocks-shared-hocs.js\":{\"src\":\"http:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-blocks-shared-hocs.js\",\"version\":\"c18bbb2325f333897e6b\",\"dependencies\":[\"react-jsx-runtime\",\"wc-blocks-data-store\",\"wc-blocks-shared-context\",\"wc-types\",\"wp-data\",\"wp-element\",\"wp-is-shallow-equal\",\"wp-polyfill\"]},\"assets\\/client\\/blocks\\/price-format.js\":{\"src\":\"http:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/price-format.js\",\"version\":\"0df720e448f7ab3c5d0d\",\"dependencies\":[\"wc-settings\",\"wp-polyfill\"]},\"assets\\/client\\/blocks\\/wc-blocks-frontend-vendors-frontend.js\":{\"src\":\"http:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-blocks-frontend-vendors-frontend.js\",\"version\":\"00b931bcc27024fa60ca\",\"dependencies\":[\"wp-polyfill\"]},\"assets\\/client\\/blocks\\/wc-cart-checkout-vendors-frontend.js\":{\"src\":\"http:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-cart-checkout-vendors-frontend.js\",\"version\":\"04a71982bb4ef85763c1\",\"dependencies\":[\"wp-polyfill\"]},\"assets\\/client\\/blocks\\/wc-cart-checkout-base-frontend.js\":{\"src\":\"http:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-cart-checkout-base-frontend.js\",\"version\":\"f669b3c33346e637602f\",\"dependencies\":[\"wp-polyfill\"]},\"assets\\/client\\/blocks\\/blocks-checkout.js\":{\"src\":\"http:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/blocks-checkout.js\",\"version\":\"da57c8c98d31b28d806e\",\"dependencies\":[\"wc-cart-checkout-base\",\"wc-cart-checkout-vendors\",\"react\",\"react-dom\",\"react-jsx-runtime\",\"wc-blocks-checkout-events\",\"wc-blocks-components\",\"wc-blocks-data-store\",\"wc-blocks-registry\",\"wc-sanitize\",\"wc-settings\",\"wc-types\",\"wp-a11y\",\"wp-compose\",\"wp-data\",\"wp-deprecated\",\"wp-element\",\"wp-html-entities\",\"wp-i18n\",\"wp-is-shallow-equal\",\"wp-notices\",\"wp-polyfill\",\"wp-primitives\",\"wp-warning\"]},\"assets\\/client\\/blocks\\/blocks-checkout-events.js\":{\"src\":\"http:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/blocks-checkout-events.js\",\"version\":\"2d0fd4590f6cc663947c\",\"dependencies\":[\"wc-types\",\"wp-polyfill\"]},\"assets\\/client\\/blocks\\/blocks-components.js\":{\"src\":\"http:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/blocks-components.js\",\"version\":\"8b64025baef8d338aa5e\",\"dependencies\":[\"wc-cart-checkout-base\",\"wc-cart-checkout-vendors\",\"react\",\"react-dom\",\"react-jsx-runtime\",\"wc-blocks-data-store\",\"wc-sanitize\",\"wc-settings\",\"wc-types\",\"wp-a11y\",\"wp-compose\",\"wp-data\",\"wp-deprecated\",\"wp-element\",\"wp-html-entities\",\"wp-i18n\",\"wp-notices\",\"wp-polyfill\",\"wp-primitives\"]},\"assets\\/client\\/blocks\\/wc-schema-parser.js\":{\"src\":\"http:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-schema-parser.js\",\"version\":\"f762078aeb4207fe9c3d\",\"dependencies\":[\"wp-polyfill\"]},\"assets\\/client\\/admin\\/sanitize\\/index.js\":{\"src\":\"http:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/admin\\/sanitize\\/index.js\",\"version\":\"5e942711022623794947\",\"dependencies\":[]},\"assets\\/client\\/admin\\/customer-effort-score\\/index.js\":{\"src\":\"http:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/admin\\/customer-effort-score\\/index.js\",\"version\":\"ed4a4ae27866cf6eafe2\",\"dependencies\":[\"react\",\"wc-experimental\",\"wc-navigation\",\"wc-store-data\",\"wc-tracks\",\"wp-api-fetch\",\"wp-components\",\"wp-compose\",\"wp-data\",\"wp-data-controls\",\"wp-element\",\"wp-i18n\"]}},\"version\":\"wc-10.7.0\",\"hash\":\"3a7ec91f725ff21ab3a21c1ef6730e63\"}','off'),
(345,'theme_mods_azure-synthetics','a:2:{s:18:\"nav_menu_locations\";a:2:{s:7:\"primary\";i:19;s:6:\"footer\";i:19;}s:18:\"custom_css_post_id\";i:-1;}','auto'),
(346,'woocommerce_catalog_rows','8','auto'),
(347,'woocommerce_catalog_columns','4','auto'),
(348,'woocommerce_maybe_regenerate_images_hash','fb1e79e105ca6bf3fee4ac9f79f133a2','auto'),
(350,'azure_synthetics_footer_disclaimer','For research use only. Not for human consumption.','auto'),
(351,'azure_synthetics_default_product_disclaimer','For research use only. Not for human consumption. Handle and store according to the published product guidance.','auto'),
(352,'azure_synthetics_default_shipping_note','Temperature-sensitive inventory is packed to reduce transit instability; inspect product immediately upon delivery.','auto'),
(353,'azure_synthetics_checkout_ack_label','I confirm this order is placed for lawful laboratory or research use only, and not for human consumption.','auto'),
(355,'_transient_shipping-transient-version','1776722353','on'),
(356,'woocommerce_pickup_location_settings','a:4:{s:7:\"enabled\";s:2:\"no\";s:5:\"title\";s:0:\"\";s:4:\"cost\";s:0:\"\";s:10:\"tax_status\";s:7:\"taxable\";}','auto'),
(359,'product_cat_children','a:0:{}','auto'),
(360,'_transient_product_query-transient-version','1776722354','on'),
(363,'_transient_product-transient-version','1776722354','on'),
(364,'_transient_woocommerce_product_task_has_product_transient','yes','on'),
(365,'woocommerce_task_list_tracked_completed_tasks','a:1:{i:0;s:8:\"products\";}','auto'),
(370,'_transient_timeout_wc_term_counts','1779206840','off'),
(371,'_transient_wc_term_counts','a:3:{s:14:\"17_product_cat\";i:1;s:14:\"16_product_cat\";i:2;s:14:\"18_product_cat\";i:1;}','off'),
(384,'_site_transient_update_plugins','O:8:\"stdClass\":5:{s:12:\"last_checked\";i:1776725777;s:8:\"response\";a:0:{}s:12:\"translations\";a:0:{}s:9:\"no_update\";a:3:{s:19:\"akismet/akismet.php\";O:8:\"stdClass\":10:{s:2:\"id\";s:21:\"w.org/plugins/akismet\";s:4:\"slug\";s:7:\"akismet\";s:6:\"plugin\";s:19:\"akismet/akismet.php\";s:11:\"new_version\";s:3:\"5.6\";s:3:\"url\";s:38:\"https://wordpress.org/plugins/akismet/\";s:7:\"package\";s:54:\"https://downloads.wordpress.org/plugin/akismet.5.6.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:60:\"https://ps.w.org/akismet/assets/icon-256x256.png?rev=2818463\";s:2:\"1x\";s:60:\"https://ps.w.org/akismet/assets/icon-128x128.png?rev=2818463\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:63:\"https://ps.w.org/akismet/assets/banner-1544x500.png?rev=2900731\";s:2:\"1x\";s:62:\"https://ps.w.org/akismet/assets/banner-772x250.png?rev=2900731\";}s:11:\"banners_rtl\";a:0:{}s:8:\"requires\";s:3:\"5.8\";}s:9:\"hello.php\";O:8:\"stdClass\":10:{s:2:\"id\";s:25:\"w.org/plugins/hello-dolly\";s:4:\"slug\";s:11:\"hello-dolly\";s:6:\"plugin\";s:9:\"hello.php\";s:11:\"new_version\";s:5:\"1.7.2\";s:3:\"url\";s:42:\"https://wordpress.org/plugins/hello-dolly/\";s:7:\"package\";s:60:\"https://downloads.wordpress.org/plugin/hello-dolly.1.7.2.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:64:\"https://ps.w.org/hello-dolly/assets/icon-256x256.jpg?rev=2052855\";s:2:\"1x\";s:64:\"https://ps.w.org/hello-dolly/assets/icon-128x128.jpg?rev=2052855\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:67:\"https://ps.w.org/hello-dolly/assets/banner-1544x500.jpg?rev=2645582\";s:2:\"1x\";s:66:\"https://ps.w.org/hello-dolly/assets/banner-772x250.jpg?rev=2052855\";}s:11:\"banners_rtl\";a:0:{}s:8:\"requires\";s:3:\"4.6\";}s:27:\"woocommerce/woocommerce.php\";O:8:\"stdClass\":10:{s:2:\"id\";s:25:\"w.org/plugins/woocommerce\";s:4:\"slug\";s:11:\"woocommerce\";s:6:\"plugin\";s:27:\"woocommerce/woocommerce.php\";s:11:\"new_version\";s:6:\"10.7.0\";s:3:\"url\";s:42:\"https://wordpress.org/plugins/woocommerce/\";s:7:\"package\";s:61:\"https://downloads.wordpress.org/plugin/woocommerce.10.7.0.zip\";s:5:\"icons\";a:2:{s:2:\"1x\";s:56:\"https://ps.w.org/woocommerce/assets/icon.svg?rev=3234504\";s:3:\"svg\";s:56:\"https://ps.w.org/woocommerce/assets/icon.svg?rev=3234504\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:67:\"https://ps.w.org/woocommerce/assets/banner-1544x500.png?rev=3234504\";s:2:\"1x\";s:66:\"https://ps.w.org/woocommerce/assets/banner-772x250.png?rev=3234504\";}s:11:\"banners_rtl\";a:0:{}s:8:\"requires\";s:3:\"6.8\";}}s:7:\"checked\";a:4:{s:19:\"akismet/akismet.php\";s:3:\"5.6\";s:47:\"azure-synthetics-core/azure-synthetics-core.php\";s:5:\"1.0.0\";s:9:\"hello.php\";s:5:\"1.7.2\";s:27:\"woocommerce/woocommerce.php\";s:6:\"10.7.0\";}}','off'),
(385,'_site_transient_update_themes','O:8:\"stdClass\":5:{s:12:\"last_checked\";i:1776725777;s:7:\"checked\";a:4:{s:16:\"azure-synthetics\";s:5:\"1.0.0\";s:16:\"twentytwentyfive\";s:3:\"1.4\";s:16:\"twentytwentyfour\";s:3:\"1.4\";s:17:\"twentytwentythree\";s:3:\"1.6\";}s:8:\"response\";a:0:{}s:9:\"no_update\";a:3:{s:16:\"twentytwentyfive\";a:6:{s:5:\"theme\";s:16:\"twentytwentyfive\";s:11:\"new_version\";s:3:\"1.4\";s:3:\"url\";s:46:\"https://wordpress.org/themes/twentytwentyfive/\";s:7:\"package\";s:62:\"https://downloads.wordpress.org/theme/twentytwentyfive.1.4.zip\";s:8:\"requires\";s:3:\"6.7\";s:12:\"requires_php\";s:3:\"7.2\";}s:16:\"twentytwentyfour\";a:6:{s:5:\"theme\";s:16:\"twentytwentyfour\";s:11:\"new_version\";s:3:\"1.4\";s:3:\"url\";s:46:\"https://wordpress.org/themes/twentytwentyfour/\";s:7:\"package\";s:62:\"https://downloads.wordpress.org/theme/twentytwentyfour.1.4.zip\";s:8:\"requires\";s:3:\"6.4\";s:12:\"requires_php\";s:3:\"7.0\";}s:17:\"twentytwentythree\";a:6:{s:5:\"theme\";s:17:\"twentytwentythree\";s:11:\"new_version\";s:3:\"1.6\";s:3:\"url\";s:47:\"https://wordpress.org/themes/twentytwentythree/\";s:7:\"package\";s:63:\"https://downloads.wordpress.org/theme/twentytwentythree.1.6.zip\";s:8:\"requires\";s:3:\"6.1\";s:12:\"requires_php\";s:3:\"5.6\";}}s:12:\"translations\";a:0:{}}','off'),
(386,'jetpack_connection_active_plugins','a:1:{s:11:\"woocommerce\";a:1:{s:4:\"name\";s:11:\"WooCommerce\";}}','auto'),
(387,'_transient_timeout_wc_shipping_method_count','1779314441','off'),
(388,'_transient_wc_shipping_method_count','a:4:{s:7:\"version\";s:10:\"1776722353\";s:6:\"legacy\";i:0;s:7:\"enabled\";i:0;s:8:\"disabled\";i:0;}','off'),
(389,'_transient_timeout_woocommerce_block_asset_resource_hints','1777220310','off'),
(390,'_transient_woocommerce_block_asset_resource_hints','a:2:{s:5:\"files\";a:2:{s:17:\"checkout-frontend\";a:48:{i:0;a:2:{s:4:\"href\";s:130:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/checkout-frontend.js?ver=fd3b672b3e6033d2fcf3\";s:2:\"as\";s:6:\"script\";}i:1;a:2:{s:4:\"href\";s:143:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/wc-cart-checkout-base-frontend.js?ver=f669b3c33346e637602f\";s:2:\"as\";s:6:\"script\";}i:2;a:2:{s:4:\"href\";s:89:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/vendor/wp-polyfill.min.js?ver=3.15.0\";s:2:\"as\";s:6:\"script\";}i:3;a:2:{s:4:\"href\";s:89:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/i18n.min.js?ver=c26c3dc7bed366793375\";s:2:\"as\";s:6:\"script\";}i:4;a:2:{s:4:\"href\";s:90:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/hooks.min.js?ver=dd5603f07f9220ed27f1\";s:2:\"as\";s:6:\"script\";}i:5;a:2:{s:4:\"href\";s:146:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/wc-cart-checkout-vendors-frontend.js?ver=04a71982bb4ef85763c1\";s:2:\"as\";s:6:\"script\";}i:6;a:2:{s:4:\"href\";s:85:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/vendor/react.min.js?ver=18.3.1.1\";s:2:\"as\";s:6:\"script\";}i:7;a:2:{s:4:\"href\";s:95:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/vendor/react-jsx-runtime.min.js?ver=18.3.1\";s:2:\"as\";s:6:\"script\";}i:8;a:2:{s:4:\"href\";s:128:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/blocks-checkout.js?ver=da57c8c98d31b28d806e\";s:2:\"as\";s:6:\"script\";}i:9;a:2:{s:4:\"href\";s:89:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/vendor/react-dom.min.js?ver=18.3.1.1\";s:2:\"as\";s:6:\"script\";}i:10;a:2:{s:4:\"href\";s:135:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/blocks-checkout-events.js?ver=2d0fd4590f6cc663947c\";s:2:\"as\";s:6:\"script\";}i:11;a:2:{s:4:\"href\";s:121:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/wc-types.js?ver=f0cc692c0367e0930c80\";s:2:\"as\";s:6:\"script\";}i:12;a:2:{s:4:\"href\";s:130:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/blocks-components.js?ver=8b64025baef8d338aa5e\";s:2:\"as\";s:6:\"script\";}i:13;a:2:{s:4:\"href\";s:127:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/wc-blocks-data.js?ver=ffb2849a705ee55d810e\";s:2:\"as\";s:6:\"script\";}i:14;a:2:{s:4:\"href\";s:131:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/wc-blocks-registry.js?ver=6436a923b42f4d1b1f6d\";s:2:\"as\";s:6:\"script\";}i:15;a:2:{s:4:\"href\";s:124:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/wc-settings.js?ver=a6cb3c938fd270888ce4\";s:2:\"as\";s:6:\"script\";}i:16;a:2:{s:4:\"href\";s:94:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/api-fetch.min.js?ver=3a4d9af2b423048b0dee\";s:2:\"as\";s:6:\"script\";}i:17;a:2:{s:4:\"href\";s:88:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/url.min.js?ver=9e178c9516d1222dc834\";s:2:\"as\";s:6:\"script\";}i:18;a:2:{s:4:\"href\";s:89:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/data.min.js?ver=f940198280891b0b6318\";s:2:\"as\";s:6:\"script\";}i:19;a:2:{s:4:\"href\";s:92:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/compose.min.js?ver=7a9b375d8c19cf9d3d9b\";s:2:\"as\";s:6:\"script\";}i:20;a:2:{s:4:\"href\";s:95:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/deprecated.min.js?ver=e1f84915c5e8ae38964c\";s:2:\"as\";s:6:\"script\";}i:21;a:2:{s:4:\"href\";s:88:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/dom.min.js?ver=26edef3be6483da3de2e\";s:2:\"as\";s:6:\"script\";}i:22;a:2:{s:4:\"href\";s:92:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/element.min.js?ver=6a582b0c827fa25df3dd\";s:2:\"as\";s:6:\"script\";}i:23;a:2:{s:4:\"href\";s:96:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/escape-html.min.js?ver=6561a406d2d232a6fbd2\";s:2:\"as\";s:6:\"script\";}i:24;a:2:{s:4:\"href\";s:101:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/is-shallow-equal.min.js?ver=e0f9f1d78d83f5196979\";s:2:\"as\";s:6:\"script\";}i:25;a:2:{s:4:\"href\";s:93:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/keycodes.min.js?ver=34c8fb5e7a594a1c8037\";s:2:\"as\";s:6:\"script\";}i:26;a:2:{s:4:\"href\";s:99:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/priority-queue.min.js?ver=2d59d091223ee9a33838\";s:2:\"as\";s:6:\"script\";}i:27;a:2:{s:4:\"href\";s:97:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/private-apis.min.js?ver=4f465748bda624774139\";s:2:\"as\";s:6:\"script\";}i:28;a:2:{s:4:\"href\";s:98:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/redux-routine.min.js?ver=8bb92d45458b29590f53\";s:2:\"as\";s:6:\"script\";}i:29;a:2:{s:4:\"href\";s:98:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/data-controls.min.js?ver=49f5587e8b90f9e7cc7e\";s:2:\"as\";s:6:\"script\";}i:30;a:2:{s:4:\"href\";s:98:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/html-entities.min.js?ver=e8b78b18a162491d5e5f\";s:2:\"as\";s:6:\"script\";}i:31;a:2:{s:4:\"href\";s:92:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/notices.min.js?ver=f62fbf15dcc23301922f\";s:2:\"as\";s:6:\"script\";}i:32;a:2:{s:4:\"href\";s:133:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/wc-blocks-middleware.js?ver=d79dedade2f2e4dc9df4\";s:2:\"as\";s:6:\"script\";}i:33;a:2:{s:4:\"href\";s:126:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/admin/sanitize/index.js?ver=5e942711022623794947\";s:2:\"as\";s:6:\"script\";}i:34;a:2:{s:4:\"href\";s:89:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/a11y.min.js?ver=cb460b4676c94bd228ed\";s:2:\"as\";s:6:\"script\";}i:35;a:2:{s:4:\"href\";s:94:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/dom-ready.min.js?ver=f77871ff7694fffea381\";s:2:\"as\";s:6:\"script\";}i:36;a:2:{s:4:\"href\";s:95:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/primitives.min.js?ver=0b5dcc337aa7cbf75570\";s:2:\"as\";s:6:\"script\";}i:37;a:2:{s:4:\"href\";s:92:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/warning.min.js?ver=d69bc18c456d01c11d5a\";s:2:\"as\";s:6:\"script\";}i:38;a:2:{s:4:\"href\";s:134:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/wc-blocks-shared-hocs.js?ver=c18bbb2325f333897e6b\";s:2:\"as\";s:6:\"script\";}i:39;a:2:{s:4:\"href\";s:137:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/wc-blocks-shared-context.js?ver=621353d8a3a7c8d44b41\";s:2:\"as\";s:6:\"script\";}i:40;a:2:{s:4:\"href\";s:125:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/price-format.js?ver=0df720e448f7ab3c5d0d\";s:2:\"as\";s:6:\"script\";}i:41;a:2:{s:4:\"href\";s:90:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/autop.min.js?ver=9fb50649848277dd318d\";s:2:\"as\";s:6:\"script\";}i:42;a:2:{s:4:\"href\";s:95:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/components.min.js?ver=0d72a218dfea8f6f442f\";s:2:\"as\";s:6:\"script\";}i:43;a:2:{s:4:\"href\";s:89:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/date.min.js?ver=795a56839718d3ff7eae\";s:2:\"as\";s:6:\"script\";}i:44;a:2:{s:4:\"href\";s:84:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/vendor/moment.min.js?ver=2.30.1\";s:2:\"as\";s:6:\"script\";}i:45;a:2:{s:4:\"href\";s:94:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/rich-text.min.js?ver=5bdbb44f3039529e3645\";s:2:\"as\";s:6:\"script\";}i:46;a:2:{s:4:\"href\";s:92:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/plugins.min.js?ver=039ed87b5b9f7036ceee\";s:2:\"as\";s:6:\"script\";}i:47;a:2:{s:4:\"href\";s:94:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/wordcount.min.js?ver=c5b97f11206928ea9130\";s:2:\"as\";s:6:\"script\";}}s:13:\"cart-frontend\";a:45:{i:0;a:2:{s:4:\"href\";s:126:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/cart-frontend.js?ver=38214368643f2bc1f44d\";s:2:\"as\";s:6:\"script\";}i:1;a:2:{s:4:\"href\";s:143:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/wc-cart-checkout-base-frontend.js?ver=f669b3c33346e637602f\";s:2:\"as\";s:6:\"script\";}i:2;a:2:{s:4:\"href\";s:89:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/vendor/wp-polyfill.min.js?ver=3.15.0\";s:2:\"as\";s:6:\"script\";}i:3;a:2:{s:4:\"href\";s:89:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/i18n.min.js?ver=c26c3dc7bed366793375\";s:2:\"as\";s:6:\"script\";}i:4;a:2:{s:4:\"href\";s:90:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/hooks.min.js?ver=dd5603f07f9220ed27f1\";s:2:\"as\";s:6:\"script\";}i:5;a:2:{s:4:\"href\";s:146:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/wc-cart-checkout-vendors-frontend.js?ver=04a71982bb4ef85763c1\";s:2:\"as\";s:6:\"script\";}i:6;a:2:{s:4:\"href\";s:85:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/vendor/react.min.js?ver=18.3.1.1\";s:2:\"as\";s:6:\"script\";}i:7;a:2:{s:4:\"href\";s:95:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/vendor/react-jsx-runtime.min.js?ver=18.3.1\";s:2:\"as\";s:6:\"script\";}i:8;a:2:{s:4:\"href\";s:128:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/blocks-checkout.js?ver=da57c8c98d31b28d806e\";s:2:\"as\";s:6:\"script\";}i:9;a:2:{s:4:\"href\";s:89:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/vendor/react-dom.min.js?ver=18.3.1.1\";s:2:\"as\";s:6:\"script\";}i:10;a:2:{s:4:\"href\";s:135:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/blocks-checkout-events.js?ver=2d0fd4590f6cc663947c\";s:2:\"as\";s:6:\"script\";}i:11;a:2:{s:4:\"href\";s:121:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/wc-types.js?ver=f0cc692c0367e0930c80\";s:2:\"as\";s:6:\"script\";}i:12;a:2:{s:4:\"href\";s:130:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/blocks-components.js?ver=8b64025baef8d338aa5e\";s:2:\"as\";s:6:\"script\";}i:13;a:2:{s:4:\"href\";s:127:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/wc-blocks-data.js?ver=ffb2849a705ee55d810e\";s:2:\"as\";s:6:\"script\";}i:14;a:2:{s:4:\"href\";s:131:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/wc-blocks-registry.js?ver=6436a923b42f4d1b1f6d\";s:2:\"as\";s:6:\"script\";}i:15;a:2:{s:4:\"href\";s:124:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/wc-settings.js?ver=a6cb3c938fd270888ce4\";s:2:\"as\";s:6:\"script\";}i:16;a:2:{s:4:\"href\";s:94:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/api-fetch.min.js?ver=3a4d9af2b423048b0dee\";s:2:\"as\";s:6:\"script\";}i:17;a:2:{s:4:\"href\";s:88:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/url.min.js?ver=9e178c9516d1222dc834\";s:2:\"as\";s:6:\"script\";}i:18;a:2:{s:4:\"href\";s:89:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/data.min.js?ver=f940198280891b0b6318\";s:2:\"as\";s:6:\"script\";}i:19;a:2:{s:4:\"href\";s:92:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/compose.min.js?ver=7a9b375d8c19cf9d3d9b\";s:2:\"as\";s:6:\"script\";}i:20;a:2:{s:4:\"href\";s:95:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/deprecated.min.js?ver=e1f84915c5e8ae38964c\";s:2:\"as\";s:6:\"script\";}i:21;a:2:{s:4:\"href\";s:88:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/dom.min.js?ver=26edef3be6483da3de2e\";s:2:\"as\";s:6:\"script\";}i:22;a:2:{s:4:\"href\";s:92:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/element.min.js?ver=6a582b0c827fa25df3dd\";s:2:\"as\";s:6:\"script\";}i:23;a:2:{s:4:\"href\";s:96:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/escape-html.min.js?ver=6561a406d2d232a6fbd2\";s:2:\"as\";s:6:\"script\";}i:24;a:2:{s:4:\"href\";s:101:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/is-shallow-equal.min.js?ver=e0f9f1d78d83f5196979\";s:2:\"as\";s:6:\"script\";}i:25;a:2:{s:4:\"href\";s:93:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/keycodes.min.js?ver=34c8fb5e7a594a1c8037\";s:2:\"as\";s:6:\"script\";}i:26;a:2:{s:4:\"href\";s:99:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/priority-queue.min.js?ver=2d59d091223ee9a33838\";s:2:\"as\";s:6:\"script\";}i:27;a:2:{s:4:\"href\";s:97:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/private-apis.min.js?ver=4f465748bda624774139\";s:2:\"as\";s:6:\"script\";}i:28;a:2:{s:4:\"href\";s:98:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/redux-routine.min.js?ver=8bb92d45458b29590f53\";s:2:\"as\";s:6:\"script\";}i:29;a:2:{s:4:\"href\";s:98:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/data-controls.min.js?ver=49f5587e8b90f9e7cc7e\";s:2:\"as\";s:6:\"script\";}i:30;a:2:{s:4:\"href\";s:98:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/html-entities.min.js?ver=e8b78b18a162491d5e5f\";s:2:\"as\";s:6:\"script\";}i:31;a:2:{s:4:\"href\";s:92:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/notices.min.js?ver=f62fbf15dcc23301922f\";s:2:\"as\";s:6:\"script\";}i:32;a:2:{s:4:\"href\";s:133:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/wc-blocks-middleware.js?ver=d79dedade2f2e4dc9df4\";s:2:\"as\";s:6:\"script\";}i:33;a:2:{s:4:\"href\";s:126:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/admin/sanitize/index.js?ver=5e942711022623794947\";s:2:\"as\";s:6:\"script\";}i:34;a:2:{s:4:\"href\";s:89:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/a11y.min.js?ver=cb460b4676c94bd228ed\";s:2:\"as\";s:6:\"script\";}i:35;a:2:{s:4:\"href\";s:94:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/dom-ready.min.js?ver=f77871ff7694fffea381\";s:2:\"as\";s:6:\"script\";}i:36;a:2:{s:4:\"href\";s:95:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/primitives.min.js?ver=0b5dcc337aa7cbf75570\";s:2:\"as\";s:6:\"script\";}i:37;a:2:{s:4:\"href\";s:92:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/warning.min.js?ver=d69bc18c456d01c11d5a\";s:2:\"as\";s:6:\"script\";}i:38;a:2:{s:4:\"href\";s:137:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/wc-blocks-shared-context.js?ver=621353d8a3a7c8d44b41\";s:2:\"as\";s:6:\"script\";}i:39;a:2:{s:4:\"href\";s:134:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/wc-blocks-shared-hocs.js?ver=c18bbb2325f333897e6b\";s:2:\"as\";s:6:\"script\";}i:40;a:2:{s:4:\"href\";s:125:\"https://azure-synthetics.loca.lt/wp-content/plugins/woocommerce/assets/client/blocks/price-format.js?ver=0df720e448f7ab3c5d0d\";s:2:\"as\";s:6:\"script\";}i:41;a:2:{s:4:\"href\";s:90:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/autop.min.js?ver=9fb50649848277dd318d\";s:2:\"as\";s:6:\"script\";}i:42;a:2:{s:4:\"href\";s:92:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/plugins.min.js?ver=039ed87b5b9f7036ceee\";s:2:\"as\";s:6:\"script\";}i:43;a:2:{s:4:\"href\";s:97:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/style-engine.min.js?ver=7c6fcedc37dadafb8a81\";s:2:\"as\";s:6:\"script\";}i:44;a:2:{s:4:\"href\";s:94:\"https://azure-synthetics.loca.lt/wp-includes/js/dist/wordcount.min.js?ver=c5b97f11206928ea9130\";s:2:\"as\";s:6:\"script\";}}}s:7:\"version\";a:3:{s:11:\"woocommerce\";s:6:\"10.7.0\";s:9:\"wordpress\";s:5:\"6.9.4\";s:8:\"site_url\";s:32:\"https://azure-synthetics.loca.lt\";}}','off'),
(405,'_transient_timeout_as-post-store-dependencies-met','1776796952','off'),
(406,'_transient_as-post-store-dependencies-met','yes','off'),
(409,'_transient_timeout_wc_product_children_25','1779314389','off'),
(410,'_transient_wc_product_children_25','a:2:{s:3:\"all\";a:2:{i:0;i:26;i:1;i:27;}s:7:\"visible\";a:2:{i:0;i:26;i:1;i:27;}}','off'),
(411,'_transient_timeout_wc_var_prices_25','1779314389','off'),
(412,'_transient_wc_var_prices_25','{\"f9e544f77b7eac7add281ef28ca5559f\":{\"price\":{\"26\":\"105.00\",\"27\":\"198.00\"},\"regular_price\":{\"26\":\"105.00\",\"27\":\"198.00\"},\"sale_price\":{\"26\":\"105.00\",\"27\":\"198.00\"}}}','off'),
(415,'_transient_timeout_woocommerce_blocks_asset_api_script_data_ssl','1779319614','off'),
(416,'_transient_woocommerce_blocks_asset_api_script_data_ssl','{\"script_data\":{\"assets\\/client\\/blocks\\/wc-settings.js\":{\"src\":\"https:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-settings.js\",\"version\":\"a6cb3c938fd270888ce4\",\"dependencies\":[\"wc-types\",\"wp-hooks\",\"wp-polyfill\"]},\"assets\\/client\\/blocks\\/wc-types.js\":{\"src\":\"https:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-types.js\",\"version\":\"f0cc692c0367e0930c80\",\"dependencies\":[\"wp-polyfill\"]},\"assets\\/client\\/blocks\\/wc-entities.js\":{\"src\":\"https:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-entities.js\",\"version\":\"cdb01de69fb7dbbbb30f\",\"dependencies\":[\"wc-settings\",\"wp-core-data\",\"wp-data\",\"wp-i18n\",\"wp-polyfill\"]},\"assets\\/client\\/blocks\\/wc-blocks-middleware.js\":{\"src\":\"https:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-blocks-middleware.js\",\"version\":\"d79dedade2f2e4dc9df4\",\"dependencies\":[\"wp-api-fetch\",\"wp-polyfill\",\"wp-url\"]},\"assets\\/client\\/blocks\\/wc-blocks-data.js\":{\"src\":\"https:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-blocks-data.js\",\"version\":\"ffb2849a705ee55d810e\",\"dependencies\":[\"wc-blocks-checkout-events\",\"wc-blocks-registry\",\"wc-settings\",\"wc-types\",\"wp-api-fetch\",\"wp-data\",\"wp-data-controls\",\"wp-deprecated\",\"wp-dom\",\"wp-element\",\"wp-hooks\",\"wp-html-entities\",\"wp-i18n\",\"wp-is-shallow-equal\",\"wp-notices\",\"wp-polyfill\",\"wp-url\"]},\"assets\\/client\\/blocks\\/wc-blocks-vendors.js\":{\"src\":\"https:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-blocks-vendors.js\",\"version\":\"9b3f9ad7437063887d6c\",\"dependencies\":[\"wp-polyfill\"]},\"assets\\/client\\/blocks\\/wc-blocks-registry.js\":{\"src\":\"https:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-blocks-registry.js\",\"version\":\"6436a923b42f4d1b1f6d\",\"dependencies\":[\"react-jsx-runtime\",\"wc-settings\",\"wp-data\",\"wp-deprecated\",\"wp-element\",\"wp-hooks\",\"wp-polyfill\"]},\"assets\\/client\\/blocks\\/wc-blocks.js\":{\"src\":\"https:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-blocks.js\",\"version\":\"0db759a8a6e010732c50\",\"dependencies\":[\"react-jsx-runtime\",\"wp-blocks\",\"wp-compose\",\"wp-element\",\"wp-hooks\",\"wp-polyfill\"]},\"assets\\/client\\/blocks\\/wc-blocks-shared-context.js\":{\"src\":\"https:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-blocks-shared-context.js\",\"version\":\"621353d8a3a7c8d44b41\",\"dependencies\":[\"react-jsx-runtime\",\"wp-element\",\"wp-polyfill\"]},\"assets\\/client\\/blocks\\/wc-blocks-shared-hocs.js\":{\"src\":\"https:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-blocks-shared-hocs.js\",\"version\":\"c18bbb2325f333897e6b\",\"dependencies\":[\"react-jsx-runtime\",\"wc-blocks-data-store\",\"wc-blocks-shared-context\",\"wc-types\",\"wp-data\",\"wp-element\",\"wp-is-shallow-equal\",\"wp-polyfill\"]},\"assets\\/client\\/blocks\\/price-format.js\":{\"src\":\"https:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/price-format.js\",\"version\":\"0df720e448f7ab3c5d0d\",\"dependencies\":[\"wc-settings\",\"wp-polyfill\"]},\"assets\\/client\\/blocks\\/wc-blocks-frontend-vendors-frontend.js\":{\"src\":\"https:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-blocks-frontend-vendors-frontend.js\",\"version\":\"00b931bcc27024fa60ca\",\"dependencies\":[\"wp-polyfill\"]},\"assets\\/client\\/blocks\\/wc-cart-checkout-vendors-frontend.js\":{\"src\":\"https:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-cart-checkout-vendors-frontend.js\",\"version\":\"04a71982bb4ef85763c1\",\"dependencies\":[\"wp-polyfill\"]},\"assets\\/client\\/blocks\\/wc-cart-checkout-base-frontend.js\":{\"src\":\"https:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-cart-checkout-base-frontend.js\",\"version\":\"f669b3c33346e637602f\",\"dependencies\":[\"wp-polyfill\"]},\"assets\\/client\\/blocks\\/blocks-checkout.js\":{\"src\":\"https:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/blocks-checkout.js\",\"version\":\"da57c8c98d31b28d806e\",\"dependencies\":[\"wc-cart-checkout-base\",\"wc-cart-checkout-vendors\",\"react\",\"react-dom\",\"react-jsx-runtime\",\"wc-blocks-checkout-events\",\"wc-blocks-components\",\"wc-blocks-data-store\",\"wc-blocks-registry\",\"wc-sanitize\",\"wc-settings\",\"wc-types\",\"wp-a11y\",\"wp-compose\",\"wp-data\",\"wp-deprecated\",\"wp-element\",\"wp-html-entities\",\"wp-i18n\",\"wp-is-shallow-equal\",\"wp-notices\",\"wp-polyfill\",\"wp-primitives\",\"wp-warning\"]},\"assets\\/client\\/blocks\\/blocks-checkout-events.js\":{\"src\":\"https:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/blocks-checkout-events.js\",\"version\":\"2d0fd4590f6cc663947c\",\"dependencies\":[\"wc-types\",\"wp-polyfill\"]},\"assets\\/client\\/blocks\\/blocks-components.js\":{\"src\":\"https:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/blocks-components.js\",\"version\":\"8b64025baef8d338aa5e\",\"dependencies\":[\"wc-cart-checkout-base\",\"wc-cart-checkout-vendors\",\"react\",\"react-dom\",\"react-jsx-runtime\",\"wc-blocks-data-store\",\"wc-sanitize\",\"wc-settings\",\"wc-types\",\"wp-a11y\",\"wp-compose\",\"wp-data\",\"wp-deprecated\",\"wp-element\",\"wp-html-entities\",\"wp-i18n\",\"wp-notices\",\"wp-polyfill\",\"wp-primitives\"]},\"assets\\/client\\/blocks\\/wc-schema-parser.js\":{\"src\":\"https:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/wc-schema-parser.js\",\"version\":\"f762078aeb4207fe9c3d\",\"dependencies\":[\"wp-polyfill\"]},\"assets\\/client\\/admin\\/sanitize\\/index.js\":{\"src\":\"https:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/admin\\/sanitize\\/index.js\",\"version\":\"5e942711022623794947\",\"dependencies\":[]},\"assets\\/client\\/admin\\/customer-effort-score\\/index.js\":{\"src\":\"https:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/admin\\/customer-effort-score\\/index.js\",\"version\":\"ed4a4ae27866cf6eafe2\",\"dependencies\":[\"react\",\"wc-experimental\",\"wc-navigation\",\"wc-store-data\",\"wc-tracks\",\"wp-api-fetch\",\"wp-components\",\"wp-compose\",\"wp-data\",\"wp-data-controls\",\"wp-element\",\"wp-i18n\"]},\"assets\\/client\\/blocks\\/cart.js\":{\"src\":\"https:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/cart.js\",\"version\":\"d7aab23deff6ea435917\",\"dependencies\":[\"react\",\"react-jsx-runtime\",\"wc-blocks-checkout\",\"wc-blocks-checkout-events\",\"wc-blocks-components\",\"wc-blocks-data-store\",\"wc-blocks-registry\",\"wc-blocks-shared-context\",\"wc-blocks-shared-hocs\",\"wc-price-format\",\"wc-sanitize\",\"wc-settings\",\"wc-types\",\"wp-a11y\",\"wp-api-fetch\",\"wp-autop\",\"wp-block-editor\",\"wp-blocks\",\"wp-components\",\"wp-compose\",\"wp-core-data\",\"wp-data\",\"wp-deprecated\",\"wp-dom\",\"wp-element\",\"wp-hooks\",\"wp-html-entities\",\"wp-i18n\",\"wp-is-shallow-equal\",\"wp-keycodes\",\"wp-notices\",\"wp-plugins\",\"wp-polyfill\",\"wp-primitives\",\"wp-style-engine\",\"wp-url\",\"wp-wordcount\"]},\"assets\\/client\\/blocks\\/cart-frontend.js\":{\"src\":\"https:\\/\\/azure-synthetics.loca.lt\\/wp-content\\/plugins\\/woocommerce\\/assets\\/client\\/blocks\\/cart-frontend.js\",\"version\":\"38214368643f2bc1f44d\",\"dependencies\":[\"wc-cart-checkout-base\",\"wc-cart-checkout-vendors\",\"react\",\"react-jsx-runtime\",\"wc-blocks-checkout\",\"wc-blocks-checkout-events\",\"wc-blocks-components\",\"wc-blocks-data-store\",\"wc-blocks-registry\",\"wc-blocks-shared-context\",\"wc-blocks-shared-hocs\",\"wc-price-format\",\"wc-sanitize\",\"wc-settings\",\"wc-types\",\"wp-a11y\",\"wp-api-fetch\",\"wp-autop\",\"wp-compose\",\"wp-data\",\"wp-deprecated\",\"wp-element\",\"wp-hooks\",\"wp-html-entities\",\"wp-i18n\",\"wp-is-shallow-equal\",\"wp-keycodes\",\"wp-notices\",\"wp-plugins\",\"wp-polyfill\",\"wp-primitives\",\"wp-style-engine\",\"wp-wordcount\"]}},\"version\":\"wc-10.7.0\",\"hash\":\"3a7ec91f725ff21ab3a21c1ef6730e63\"}','off'),
(417,'recovery_keys','a:0:{}','off'),
(418,'jetpack_options','a:1:{s:14:\"last_heartbeat\";i:1776725700;}','auto'),
(421,'action_scheduler_migration_status','complete','auto'),
(422,'as_has_wp_comment_logs','no','on'),
(424,'_transient_timeout__woocommerce_helper_subscriptions','1776726676','off'),
(425,'_transient__woocommerce_helper_subscriptions','a:0:{}','off'),
(426,'_site_transient_timeout_theme_roots','1776727576','off'),
(427,'_site_transient_theme_roots','a:4:{s:16:\"azure-synthetics\";s:7:\"/themes\";s:16:\"twentytwentyfive\";s:7:\"/themes\";s:16:\"twentytwentyfour\";s:7:\"/themes\";s:17:\"twentytwentythree\";s:7:\"/themes\";}','off'),
(428,'_site_transient_timeout_php_check_0fbbe329bc0ccd676924cb4c767b781d','1777330577','off'),
(429,'_site_transient_php_check_0fbbe329bc0ccd676924cb4c767b781d','a:5:{s:19:\"recommended_version\";s:3:\"8.3\";s:15:\"minimum_version\";s:6:\"7.2.24\";s:12:\"is_supported\";b:0;s:9:\"is_secure\";b:1;s:13:\"is_acceptable\";b:1;}','off'),
(430,'_transient_health-check-site-status-result','{\"good\":19,\"recommended\":5,\"critical\":0}','on'),
(434,'product_brand_children','a:0:{}','auto'),
(435,'_transient_timeout_wc_related_25','1776814033','off'),
(436,'_transient_wc_related_25','a:1:{s:50:\"limit=4&exclude_ids%5B0%5D=0&exclude_ids%5B1%5D=25\";a:1:{i:0;s:2:\"23\";}}','off'),
(440,'_site_transient_timeout_wp_theme_files_patterns-855220f138ccd03b944ede7d6f488dbb','1776729398','off'),
(441,'_site_transient_wp_theme_files_patterns-855220f138ccd03b944ede7d6f488dbb','a:2:{s:7:\"version\";s:5:\"1.0.0\";s:8:\"patterns\";a:0:{}}','off');
/*!40000 ALTER TABLE `wp_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_postmeta`
--

DROP TABLE IF EXISTS `wp_postmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_postmeta`
--

LOCK TABLES `wp_postmeta` WRITE;
/*!40000 ALTER TABLE `wp_postmeta` DISABLE KEYS */;
INSERT INTO `wp_postmeta` VALUES
(1,2,'_wp_page_template','default'),
(2,3,'_wp_page_template','default'),
(3,5,'_wp_attached_file','woocommerce-placeholder.webp'),
(4,5,'_wp_attachment_metadata','a:6:{s:5:\"width\";i:1200;s:6:\"height\";i:1200;s:4:\"file\";s:28:\"woocommerce-placeholder.webp\";s:8:\"filesize\";i:9892;s:5:\"sizes\";a:7:{s:21:\"woocommerce_thumbnail\";a:6:{s:4:\"file\";s:36:\"woocommerce-placeholder-760x760.webp\";s:5:\"width\";i:760;s:6:\"height\";i:760;s:9:\"mime-type\";s:10:\"image/webp\";s:8:\"filesize\";i:4386;s:9:\"uncropped\";b:0;}s:29:\"woocommerce_gallery_thumbnail\";a:5:{s:4:\"file\";s:36:\"woocommerce-placeholder-100x100.webp\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/webp\";s:8:\"filesize\";i:868;}s:18:\"woocommerce_single\";a:5:{s:4:\"file\";s:38:\"woocommerce-placeholder-1100x1100.webp\";s:5:\"width\";i:1100;s:6:\"height\";i:1100;s:9:\"mime-type\";s:10:\"image/webp\";s:8:\"filesize\";i:7132;}s:6:\"medium\";a:5:{s:4:\"file\";s:36:\"woocommerce-placeholder-300x300.webp\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/webp\";s:8:\"filesize\";i:1362;}s:5:\"large\";a:5:{s:4:\"file\";s:38:\"woocommerce-placeholder-1024x1024.webp\";s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:9:\"mime-type\";s:10:\"image/webp\";s:8:\"filesize\";i:6032;}s:9:\"thumbnail\";a:5:{s:4:\"file\";s:36:\"woocommerce-placeholder-150x150.webp\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/webp\";s:8:\"filesize\";i:662;}s:12:\"medium_large\";a:5:{s:4:\"file\";s:36:\"woocommerce-placeholder-768x768.webp\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/webp\";s:8:\"filesize\";i:4240;}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(5,16,'_wp_page_template','page-templates/template-faq.php'),
(6,17,'_wp_page_template','page-templates/template-contact.php'),
(7,18,'_wp_page_template','page-templates/template-compliance.php'),
(8,19,'_wp_attached_file','2026/04/card-bpc157.png'),
(9,19,'_wp_attachment_metadata','a:6:{s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:4:\"file\";s:23:\"2026/04/card-bpc157.png\";s:8:\"filesize\";i:512448;s:5:\"sizes\";a:7:{s:6:\"medium\";a:5:{s:4:\"file\";s:23:\"card-bpc157-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:11808;}s:9:\"thumbnail\";a:5:{s:4:\"file\";s:23:\"card-bpc157-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:4498;}s:12:\"medium_large\";a:5:{s:4:\"file\";s:23:\"card-bpc157-768x768.png\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:45875;}s:18:\"azure-product-card\";a:5:{s:4:\"file\";s:23:\"card-bpc157-720x720.png\";s:5:\"width\";i:720;s:6:\"height\";i:720;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:40731;}s:17:\"azure-hero-visual\";a:5:{s:4:\"file\";s:23:\"card-bpc157-840x960.png\";s:5:\"width\";i:840;s:6:\"height\";i:960;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:60976;}s:21:\"woocommerce_thumbnail\";a:6:{s:4:\"file\";s:23:\"card-bpc157-760x760.png\";s:5:\"width\";i:760;s:6:\"height\";i:760;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:44974;s:9:\"uncropped\";b:0;}s:29:\"woocommerce_gallery_thumbnail\";a:5:{s:4:\"file\";s:23:\"card-bpc157-100x100.png\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:2721;}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(10,20,'_wp_attached_file','2026/04/card-motsc.png'),
(11,20,'_wp_attachment_metadata','a:6:{s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:4:\"file\";s:22:\"2026/04/card-motsc.png\";s:8:\"filesize\";i:477739;s:5:\"sizes\";a:7:{s:6:\"medium\";a:5:{s:4:\"file\";s:22:\"card-motsc-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:11288;}s:9:\"thumbnail\";a:5:{s:4:\"file\";s:22:\"card-motsc-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:4363;}s:12:\"medium_large\";a:5:{s:4:\"file\";s:22:\"card-motsc-768x768.png\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:43994;}s:18:\"azure-product-card\";a:5:{s:4:\"file\";s:22:\"card-motsc-720x720.png\";s:5:\"width\";i:720;s:6:\"height\";i:720;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:39844;}s:17:\"azure-hero-visual\";a:5:{s:4:\"file\";s:22:\"card-motsc-840x960.png\";s:5:\"width\";i:840;s:6:\"height\";i:960;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:58342;}s:21:\"woocommerce_thumbnail\";a:6:{s:4:\"file\";s:22:\"card-motsc-760x760.png\";s:5:\"width\";i:760;s:6:\"height\";i:760;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:43676;s:9:\"uncropped\";b:0;}s:29:\"woocommerce_gallery_thumbnail\";a:5:{s:4:\"file\";s:22:\"card-motsc-100x100.png\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:2660;}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(12,21,'_wp_attached_file','2026/04/card-cjcipa.png'),
(13,21,'_wp_attachment_metadata','a:6:{s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:4:\"file\";s:23:\"2026/04/card-cjcipa.png\";s:8:\"filesize\";i:473934;s:5:\"sizes\";a:7:{s:6:\"medium\";a:5:{s:4:\"file\";s:23:\"card-cjcipa-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:12324;}s:9:\"thumbnail\";a:5:{s:4:\"file\";s:23:\"card-cjcipa-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:4798;}s:12:\"medium_large\";a:5:{s:4:\"file\";s:23:\"card-cjcipa-768x768.png\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:46158;}s:18:\"azure-product-card\";a:5:{s:4:\"file\";s:23:\"card-cjcipa-720x720.png\";s:5:\"width\";i:720;s:6:\"height\";i:720;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:41709;}s:17:\"azure-hero-visual\";a:5:{s:4:\"file\";s:23:\"card-cjcipa-840x960.png\";s:5:\"width\";i:840;s:6:\"height\";i:960;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:59151;}s:21:\"woocommerce_thumbnail\";a:6:{s:4:\"file\";s:23:\"card-cjcipa-760x760.png\";s:5:\"width\";i:760;s:6:\"height\";i:760;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:45429;s:9:\"uncropped\";b:0;}s:29:\"woocommerce_gallery_thumbnail\";a:5:{s:4:\"file\";s:23:\"card-cjcipa-100x100.png\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:2983;}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(14,22,'_wp_attached_file','2026/04/card-glp3.png'),
(15,22,'_wp_attachment_metadata','a:6:{s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:4:\"file\";s:21:\"2026/04/card-glp3.png\";s:8:\"filesize\";i:441915;s:5:\"sizes\";a:7:{s:6:\"medium\";a:5:{s:4:\"file\";s:21:\"card-glp3-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:11484;}s:9:\"thumbnail\";a:5:{s:4:\"file\";s:21:\"card-glp3-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:4548;}s:12:\"medium_large\";a:5:{s:4:\"file\";s:21:\"card-glp3-768x768.png\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:44444;}s:18:\"azure-product-card\";a:5:{s:4:\"file\";s:21:\"card-glp3-720x720.png\";s:5:\"width\";i:720;s:6:\"height\";i:720;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:39826;}s:17:\"azure-hero-visual\";a:5:{s:4:\"file\";s:21:\"card-glp3-840x960.png\";s:5:\"width\";i:840;s:6:\"height\";i:960;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:58231;}s:21:\"woocommerce_thumbnail\";a:6:{s:4:\"file\";s:21:\"card-glp3-760x760.png\";s:5:\"width\";i:760;s:6:\"height\";i:760;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:43821;s:9:\"uncropped\";b:0;}s:29:\"woocommerce_gallery_thumbnail\";a:5:{s:4:\"file\";s:21:\"card-glp3-100x100.png\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:2796;}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(16,23,'_sku','AZ-BPC157-10'),
(17,23,'_regular_price','95'),
(18,23,'total_sales','0'),
(19,23,'_tax_status','taxable'),
(20,23,'_tax_class',''),
(21,23,'_manage_stock','no'),
(22,23,'_backorders','no'),
(23,23,'_sold_individually','no'),
(24,23,'_virtual','no'),
(25,23,'_downloadable','no'),
(26,23,'_download_limit','-1'),
(27,23,'_download_expiry','-1'),
(28,23,'_thumbnail_id','19'),
(29,23,'_stock',NULL),
(30,23,'_stock_status','instock'),
(31,23,'_wc_average_rating','0'),
(32,23,'_wc_review_count','0'),
(33,23,'_product_attributes','a:2:{s:9:\"vial-size\";a:6:{s:4:\"name\";s:9:\"Vial Size\";s:5:\"value\";s:5:\"10 mg\";s:8:\"position\";i:0;s:10:\"is_visible\";i:1;s:12:\"is_variation\";i:0;s:11:\"is_taxonomy\";i:0;}s:11:\"form-factor\";a:6:{s:4:\"name\";s:11:\"Form Factor\";s:5:\"value\";s:18:\"Lyophilized powder\";s:8:\"position\";i:1;s:10:\"is_visible\";i:1;s:12:\"is_variation\";i:0;s:11:\"is_taxonomy\";i:0;}}'),
(34,23,'_product_version','10.7.0'),
(35,23,'_price','95'),
(36,23,'_azure_subtitle','Protocol-ready repair support'),
(37,23,'_azure_lab_descriptor','Recovery / repair'),
(38,23,'_azure_purity_percent','99.1%–99.6%'),
(39,23,'_azure_form_factor','Lyophilized powder'),
(40,23,'_azure_vial_amount','10 mg'),
(41,23,'_azure_storage_instructions','Store frozen for long-term stability; refrigerate after reconstitution when applicable.'),
(42,23,'_azure_shipping_warning','Cold-chain stabilizing pack included on every order.'),
(43,23,'_azure_batch_reference','COA + lot QR linked on fulfillment.'),
(44,23,'_azure_reconstitution_guidance','Use only validated sterile lab diluent according to your internal protocol.'),
(45,23,'_azure_research_disclaimer','For research use only. Not for human consumption.'),
(46,23,'_azure_product_faqs','[{\"question\":\"How is lot verification surfaced?\",\"answer\":\"Each shipment references a lot ID and a supporting COA workflow.\"},{\"question\":\"Is the vial pre-mixed?\",\"answer\":\"No. The default catalog presentation is lyophilized powder unless noted otherwise.\"}]'),
(47,24,'_sku','AZ-MOTSC-10'),
(48,24,'_regular_price','110'),
(49,24,'total_sales','0'),
(50,24,'_tax_status','taxable'),
(51,24,'_tax_class',''),
(52,24,'_manage_stock','no'),
(53,24,'_backorders','no'),
(54,24,'_sold_individually','no'),
(55,24,'_virtual','no'),
(56,24,'_downloadable','no'),
(57,24,'_download_limit','-1'),
(58,24,'_download_expiry','-1'),
(59,24,'_thumbnail_id','20'),
(60,24,'_stock',NULL),
(61,24,'_stock_status','instock'),
(62,24,'_wc_average_rating','0'),
(63,24,'_wc_review_count','0'),
(64,24,'_product_attributes','a:2:{s:9:\"vial-size\";a:6:{s:4:\"name\";s:9:\"Vial Size\";s:5:\"value\";s:5:\"10 mg\";s:8:\"position\";i:0;s:10:\"is_visible\";i:1;s:12:\"is_variation\";i:0;s:11:\"is_taxonomy\";i:0;}s:11:\"form-factor\";a:6:{s:4:\"name\";s:11:\"Form Factor\";s:5:\"value\";s:18:\"Lyophilized powder\";s:8:\"position\";i:1;s:10:\"is_visible\";i:1;s:12:\"is_variation\";i:0;s:11:\"is_taxonomy\";i:0;}}'),
(65,24,'_product_version','10.7.0'),
(66,24,'_price','110'),
(67,24,'_azure_subtitle','Metabolic support'),
(68,24,'_azure_lab_descriptor','Longevity + energy'),
(69,24,'_azure_purity_percent','98.8%–99.4%'),
(70,24,'_azure_form_factor','Lyophilized powder'),
(71,24,'_azure_vial_amount','10 mg'),
(72,24,'_azure_storage_instructions','Freeze unopened inventory and minimize repeated temperature cycling.'),
(73,24,'_azure_shipping_warning','Insulated packaging used for transit stability.'),
(74,24,'_azure_batch_reference','Lot-linked analytical release file.'),
(75,24,'_azure_reconstitution_guidance','Follow validated internal handling procedures only.'),
(76,24,'_azure_research_disclaimer','For research use only. Not for human consumption.'),
(77,24,'_azure_product_faqs','[{\"question\":\"What documentation accompanies the product?\",\"answer\":\"Orders include traceability references and supporting assay documentation.\"}]'),
(78,25,'_sku','AZ-CJCIPA'),
(79,25,'total_sales','0'),
(80,25,'_tax_status','taxable'),
(81,25,'_tax_class',''),
(82,25,'_manage_stock','no'),
(83,25,'_backorders','no'),
(84,25,'_sold_individually','no'),
(85,25,'_virtual','no'),
(86,25,'_downloadable','no'),
(87,25,'_download_limit','-1'),
(88,25,'_download_expiry','-1'),
(89,25,'_stock',NULL),
(90,25,'_stock_status','instock'),
(91,25,'_wc_average_rating','0'),
(92,25,'_wc_review_count','0'),
(93,25,'_product_attributes','a:2:{s:9:\"pack-size\";a:6:{s:4:\"name\";s:9:\"Pack Size\";s:5:\"value\";s:14:\"1 kit | 2 kits\";s:8:\"position\";i:0;s:10:\"is_visible\";i:1;s:12:\"is_variation\";i:1;s:11:\"is_taxonomy\";i:0;}s:9:\"vial-size\";a:6:{s:4:\"name\";s:9:\"Vial Size\";s:5:\"value\";s:11:\"5 mg / 5 mg\";s:8:\"position\";i:1;s:10:\"is_visible\";i:1;s:12:\"is_variation\";i:1;s:11:\"is_taxonomy\";i:0;}}'),
(94,25,'_product_version','10.7.0'),
(95,25,'_azure_subtitle','Sleep and recovery stack'),
(96,25,'_azure_lab_descriptor','Recovery + repair'),
(97,25,'_azure_purity_percent','97.9%–99.1%'),
(98,25,'_azure_form_factor','Dual-vial kit'),
(99,25,'_azure_vial_amount','5 mg / 5 mg'),
(100,25,'_azure_storage_instructions','Store at frozen temperatures until validated use.'),
(101,25,'_azure_shipping_warning','Ships in insulated kit packaging.'),
(102,25,'_azure_batch_reference','Paired COA references per component.'),
(103,25,'_azure_reconstitution_guidance','Reference internal SOPs for multi-vial handling.'),
(104,25,'_azure_research_disclaimer','For research use only. Not for human consumption.'),
(105,25,'_azure_product_faqs','[{\"question\":\"Can I purchase multiple kits in one line item?\",\"answer\":\"Yes. Use the Pack Size selector to place a WooCommerce-native variation order.\"}]'),
(106,25,'_thumbnail_id','21'),
(107,26,'_variation_description',''),
(108,26,'_sku','AZ-CJCIPA-1KIT'),
(109,26,'_regular_price','105'),
(110,26,'total_sales','0'),
(111,26,'_tax_status','taxable'),
(112,26,'_tax_class','parent'),
(113,26,'_manage_stock','no'),
(114,26,'_backorders','no'),
(115,26,'_sold_individually','no'),
(116,26,'_virtual','no'),
(117,26,'_downloadable','no'),
(118,26,'_download_limit','-1'),
(119,26,'_download_expiry','-1'),
(120,26,'_stock',NULL),
(121,26,'_stock_status','instock'),
(122,26,'_wc_average_rating','0'),
(123,26,'_wc_review_count','0'),
(124,26,'attribute_Pack Size','1 kit'),
(125,26,'attribute_Vial Size','5 mg / 5 mg'),
(126,26,'_price','105'),
(127,26,'_product_version','10.7.0'),
(128,27,'_variation_description',''),
(129,27,'_sku','AZ-CJCIPA-2KIT'),
(130,27,'_regular_price','198'),
(131,27,'total_sales','0'),
(132,27,'_tax_status','taxable'),
(133,27,'_tax_class','parent'),
(134,27,'_manage_stock','no'),
(135,27,'_backorders','no'),
(136,27,'_sold_individually','no'),
(137,27,'_virtual','no'),
(138,27,'_downloadable','no'),
(139,27,'_download_limit','-1'),
(140,27,'_download_expiry','-1'),
(141,27,'_stock',NULL),
(142,27,'_stock_status','instock'),
(143,27,'_wc_average_rating','0'),
(144,27,'_wc_review_count','0'),
(145,27,'attribute_Pack Size','2 kits'),
(146,27,'attribute_Vial Size','5 mg / 5 mg'),
(147,27,'_price','198'),
(148,27,'_product_version','10.7.0'),
(149,28,'_sku','AZ-GLP3-15'),
(150,28,'_regular_price','130'),
(151,28,'total_sales','0'),
(152,28,'_tax_status','taxable'),
(153,28,'_tax_class',''),
(154,28,'_manage_stock','no'),
(155,28,'_backorders','no'),
(156,28,'_sold_individually','no'),
(157,28,'_virtual','no'),
(158,28,'_downloadable','no'),
(159,28,'_download_limit','-1'),
(160,28,'_download_expiry','-1'),
(161,28,'_thumbnail_id','22'),
(162,28,'_stock',NULL),
(163,28,'_stock_status','instock'),
(164,28,'_wc_average_rating','0'),
(165,28,'_wc_review_count','0'),
(166,28,'_product_attributes','a:2:{s:9:\"vial-size\";a:6:{s:4:\"name\";s:9:\"Vial Size\";s:5:\"value\";s:5:\"15 mg\";s:8:\"position\";i:0;s:10:\"is_visible\";i:1;s:12:\"is_variation\";i:0;s:11:\"is_taxonomy\";i:0;}s:11:\"form-factor\";a:6:{s:4:\"name\";s:11:\"Form Factor\";s:5:\"value\";s:18:\"Lyophilized powder\";s:8:\"position\";i:1;s:10:\"is_visible\";i:1;s:12:\"is_variation\";i:0;s:11:\"is_taxonomy\";i:0;}}'),
(167,28,'_product_version','10.7.0'),
(168,28,'_price','130'),
(169,28,'_azure_subtitle','Body composition protocols'),
(170,28,'_azure_lab_descriptor','Body composition'),
(171,28,'_azure_purity_percent','98.5%–99.2%'),
(172,28,'_azure_form_factor','Lyophilized powder'),
(173,28,'_azure_vial_amount','15 mg'),
(174,28,'_azure_storage_instructions','Frozen storage recommended; avoid heat exposure during staging.'),
(175,28,'_azure_shipping_warning','Priority handling recommended for warm-weather routes.'),
(176,28,'_azure_batch_reference','Batch archive available on request.'),
(177,28,'_azure_reconstitution_guidance','Reference lab SOPs before handling.'),
(178,28,'_azure_research_disclaimer','For research use only. Not for human consumption.'),
(179,28,'_azure_product_faqs','[{\"question\":\"Is this positioned as a consumer wellness product?\",\"answer\":\"No. Catalog language is intentionally restricted to research and laboratory contexts.\"}]'),
(180,25,'_crosssell_ids','a:0:{}'),
(181,29,'_menu_item_type','custom'),
(182,29,'_menu_item_menu_item_parent','0'),
(183,29,'_menu_item_object_id','29'),
(184,29,'_menu_item_object','custom'),
(185,29,'_menu_item_target',''),
(186,29,'_menu_item_classes','a:1:{i:0;s:0:\"\";}'),
(187,29,'_menu_item_xfn',''),
(188,29,'_menu_item_url','https://azure-synthetics.loca.lt/'),
(189,30,'_menu_item_type','custom'),
(190,30,'_menu_item_menu_item_parent','0'),
(191,30,'_menu_item_object_id','30'),
(192,30,'_menu_item_object','custom'),
(193,30,'_menu_item_target',''),
(194,30,'_menu_item_classes','a:1:{i:0;s:0:\"\";}'),
(195,30,'_menu_item_xfn',''),
(196,30,'_menu_item_url','https://azure-synthetics.loca.lt/shop/'),
(197,31,'_menu_item_type','custom'),
(198,31,'_menu_item_menu_item_parent','0'),
(199,31,'_menu_item_object_id','31'),
(200,31,'_menu_item_object','custom'),
(201,31,'_menu_item_target',''),
(202,31,'_menu_item_classes','a:1:{i:0;s:0:\"\";}'),
(203,31,'_menu_item_xfn',''),
(204,31,'_menu_item_url','https://azure-synthetics.loca.lt/science/'),
(205,32,'_menu_item_type','custom'),
(206,32,'_menu_item_menu_item_parent','0'),
(207,32,'_menu_item_object_id','32'),
(208,32,'_menu_item_object','custom'),
(209,32,'_menu_item_target',''),
(210,32,'_menu_item_classes','a:1:{i:0;s:0:\"\";}'),
(211,32,'_menu_item_xfn',''),
(212,32,'_menu_item_url','https://azure-synthetics.loca.lt/faq/'),
(213,25,'_price','105'),
(214,25,'_price','198'),
(215,37,'_wp_page_template','page-templates/template-science.php'),
(216,29,'_wp_old_date','2026-04-19'),
(217,30,'_wp_old_date','2026-04-19'),
(218,31,'_wp_old_date','2026-04-19'),
(219,32,'_wp_old_date','2026-04-19');
/*!40000 ALTER TABLE `wp_postmeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_posts`
--

DROP TABLE IF EXISTS `wp_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_posts` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT 0,
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(255) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT 0,
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT 0,
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`(191)),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`),
  KEY `type_status_author` (`post_type`,`post_status`,`post_author`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_posts`
--

LOCK TABLES `wp_posts` WRITE;
/*!40000 ALTER TABLE `wp_posts` DISABLE KEYS */;
INSERT INTO `wp_posts` VALUES
(1,1,'2026-04-19 15:56:12','2026-04-19 15:56:12','<!-- wp:paragraph -->\n<p>Welcome to WordPress. This is your first post. Edit or delete it, then start writing!</p>\n<!-- /wp:paragraph -->','Hello world!','','publish','open','open','','hello-world','','','2026-04-19 15:56:12','2026-04-19 15:56:12','',0,'https://azure-synthetics.loca.lt/?p=1',0,'post','',1),
(2,1,'2026-04-19 15:56:12','2026-04-19 15:56:12','<!-- wp:paragraph -->\n<p>This is an example page. It\'s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\">\n<!-- wp:paragraph -->\n<p>Hi there! I\'m a bike messenger by day, aspiring actor by night, and this is my website. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin\' caught in the rain.)</p>\n<!-- /wp:paragraph -->\n</blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>...or something like this:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\">\n<!-- wp:paragraph -->\n<p>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</p>\n<!-- /wp:paragraph -->\n</blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>As a new WordPress user, you should go to <a href=\"https://azure-synthetics.loca.lt/wp-admin/\">your dashboard</a> to delete this page and create new pages for your content. Have fun!</p>\n<!-- /wp:paragraph -->','Sample Page','','publish','closed','open','','sample-page','','','2026-04-19 15:56:12','2026-04-19 15:56:12','',0,'https://azure-synthetics.loca.lt/?page_id=2',0,'page','',0),
(3,1,'2026-04-19 15:56:12','2026-04-19 15:56:12','<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Who we are</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>Our website address is: https://azure-synthetics.loca.lt.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Comments</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>When visitors leave comments on the site we collect the data shown in the comments form, and also the visitor&#8217;s IP address and browser user agent string to help spam detection.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>An anonymized string created from your email address (also called a hash) may be provided to the Gravatar service to see if you are using it. The Gravatar service privacy policy is available here: https://automattic.com/privacy/. After approval of your comment, your profile picture is visible to the public in the context of your comment.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Media</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>If you upload images to the website, you should avoid uploading images with embedded location data (EXIF GPS) included. Visitors to the website can download and extract any location data from images on the website.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Cookies</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>If you leave a comment on our site you may opt-in to saving your name, email address and website in cookies. These are for your convenience so that you do not have to fill in your details again when you leave another comment. These cookies will last for one year.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>If you visit our login page, we will set a temporary cookie to determine if your browser accepts cookies. This cookie contains no personal data and is discarded when you close your browser.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>When you log in, we will also set up several cookies to save your login information and your screen display choices. Login cookies last for two days, and screen options cookies last for a year. If you select &quot;Remember Me&quot;, your login will persist for two weeks. If you log out of your account, the login cookies will be removed.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>If you edit or publish an article, an additional cookie will be saved in your browser. This cookie includes no personal data and simply indicates the post ID of the article you just edited. It expires after 1 day.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Embedded content from other websites</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>Articles on this site may include embedded content (e.g. videos, images, articles, etc.). Embedded content from other websites behaves in the exact same way as if the visitor has visited the other website.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>These websites may collect data about you, use cookies, embed additional third-party tracking, and monitor your interaction with that embedded content, including tracking your interaction with the embedded content if you have an account and are logged in to that website.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Who we share your data with</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>If you request a password reset, your IP address will be included in the reset email.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">How long we retain your data</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>If you leave a comment, the comment and its metadata are retained indefinitely. This is so we can recognize and approve any follow-up comments automatically instead of holding them in a moderation queue.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>For users that register on our website (if any), we also store the personal information they provide in their user profile. All users can see, edit, or delete their personal information at any time (except they cannot change their username). Website administrators can also see and edit that information.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">What rights you have over your data</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>If you have an account on this site, or have left comments, you can request to receive an exported file of the personal data we hold about you, including any data you have provided to us. You can also request that we erase any personal data we hold about you. This does not include any data we are obliged to keep for administrative, legal, or security purposes.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Where your data is sent</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class=\"privacy-policy-tutorial\">Suggested text: </strong>Visitor comments may be checked through an automated spam detection service.</p>\n<!-- /wp:paragraph -->\n','Privacy Policy','','draft','closed','open','','privacy-policy','','','2026-04-19 15:56:12','2026-04-19 15:56:12','',0,'https://azure-synthetics.loca.lt/?page_id=3',0,'page','',0),
(4,0,'2026-04-19 16:06:28','2026-04-19 16:06:28','<!-- wp:page-list /-->','Navigation','','publish','closed','closed','','navigation','','','2026-04-19 16:06:28','2026-04-19 16:06:28','',0,'https://azure-synthetics.loca.lt/?p=4',0,'wp_navigation','',0),
(5,0,'2026-04-19 16:06:38','2026-04-19 16:06:38','','woocommerce-placeholder','','inherit','open','closed','','woocommerce-placeholder','','','2026-04-19 16:06:38','2026-04-19 16:06:38','',0,'https://azure-synthetics.loca.lt/wp-content/uploads/2026/04/woocommerce-placeholder.webp',0,'attachment','image/webp',0),
(6,1,'2026-04-19 16:06:39','2026-04-19 16:06:39','<!-- wp:woocommerce/product-catalog /-->','Shop','','publish','closed','closed','','shop','','','2026-04-20 21:59:13','2026-04-20 21:59:13','',0,'https://azure-synthetics.loca.lt/?page_id=6',0,'page','',0),
(7,1,'2026-04-19 16:06:39','2026-04-19 16:06:39','<!-- wp:woocommerce/cart /-->','Cart','','publish','closed','closed','','cart','','','2026-04-20 21:59:13','2026-04-20 21:59:13','',0,'https://azure-synthetics.loca.lt/?page_id=7',0,'page','',0),
(8,1,'2026-04-19 16:06:39','2026-04-19 16:06:39','<!-- wp:woocommerce/checkout /-->','Checkout','','publish','closed','closed','','checkout','','','2026-04-20 21:59:13','2026-04-20 21:59:13','',0,'https://azure-synthetics.loca.lt/?page_id=8',0,'page','',0),
(9,1,'2026-04-19 16:06:39','2026-04-19 16:06:39','<!-- wp:woocommerce/my-account /-->','My account','','publish','closed','closed','','my-account','','','2026-04-20 21:59:13','2026-04-20 21:59:13','',0,'https://azure-synthetics.loca.lt/?page_id=9',0,'page','',0),
(10,1,'2026-04-19 16:06:39','0000-00-00 00:00:00','<!-- wp:paragraph -->\n<p><b>This is a sample page.</b></p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Overview</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Our refund and returns policy lasts 30 days. If 30 days have passed since your purchase, we can’t offer you a full refund or exchange.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>To be eligible for a return, your item must be unused and in the same condition that you received it. It must also be in the original packaging.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Several types of goods are exempt from being returned. Perishable goods such as food, flowers, newspapers or magazines cannot be returned. We also do not accept products that are intimate or sanitary goods, hazardous materials, or flammable liquids or gases.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Additional non-returnable items:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:list -->\n<ul>\n<li>Gift cards</li>\n<li>Downloadable software products</li>\n<li>Some health and personal care items</li>\n</ul>\n<!-- /wp:list -->\n\n<!-- wp:paragraph -->\n<p>To complete your return, we require a receipt or proof of purchase.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Please do not send your purchase back to the manufacturer.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>There are certain situations where only partial refunds are granted:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:list -->\n<ul>\n<li>Book with obvious signs of use</li>\n<li>CD, DVD, VHS tape, software, video game, cassette tape, or vinyl record that has been opened.</li>\n<li>Any item not in its original condition, is damaged or missing parts for reasons not due to our error.</li>\n<li>Any item that is returned more than 30 days after delivery</li>\n</ul>\n<!-- /wp:list -->\n\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Refunds</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Once your return is received and inspected, we will send you an email to notify you that we have received your returned item. We will also notify you of the approval or rejection of your refund.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>If you are approved, then your refund will be processed, and a credit will automatically be applied to your credit card or original method of payment, within a certain amount of days.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading {\"level\":3} -->\n<h3 class=\"wp-block-heading\">Late or missing refunds</h3>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>If you haven’t received a refund yet, first check your bank account again.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Then contact your credit card company, it may take some time before your refund is officially posted.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Next contact your bank. There is often some processing time before a refund is posted.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>If you’ve done all of this and you still have not received your refund yet, please contact us at {email address}.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading {\"level\":3} -->\n<h3 class=\"wp-block-heading\">Sale items</h3>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Only regular priced items may be refunded. Sale items cannot be refunded.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Exchanges</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>We only replace items if they are defective or damaged. If you need to exchange it for the same item, send us an email at {email address} and send your item to: {physical address}.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Gifts</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>If the item was marked as a gift when purchased and shipped directly to you, you’ll receive a gift credit for the value of your return. Once the returned item is received, a gift certificate will be mailed to you.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>If the item wasn’t marked as a gift when purchased, or the gift giver had the order shipped to themselves to give to you later, we will send a refund to the gift giver and they will find out about your return.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Shipping returns</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>To return your product, you should mail your product to: {physical address}.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>You will be responsible for paying for your own shipping costs for returning your item. Shipping costs are non-refundable. If you receive a refund, the cost of return shipping will be deducted from your refund.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Depending on where you live, the time it may take for your exchanged product to reach you may vary.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>If you are returning more expensive items, you may consider using a trackable shipping service or purchasing shipping insurance. We don’t guarantee that we will receive your returned item.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Need help?</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Contact us at {email} for questions related to refunds and returns.</p>\n<!-- /wp:paragraph -->','Refund and Returns Policy','','draft','closed','closed','','refund_returns','','','2026-04-19 16:06:39','0000-00-00 00:00:00','',0,'https://azure-synthetics.loca.lt/?page_id=10',0,'page','',0),
(11,0,'2026-04-19 16:06:46','2026-04-19 16:06:46','','Home','','publish','closed','closed','','home','','','2026-04-20 21:59:13','2026-04-20 21:59:13','',0,'https://azure-synthetics.loca.lt/home/',0,'page','',0),
(12,0,'2026-04-19 16:06:46','2026-04-19 16:06:46','<!-- wp:woocommerce/product-catalog /-->','Shop','','inherit','closed','closed','','6-revision-v1','','','2026-04-19 16:06:46','2026-04-19 16:06:46','',6,'https://azure-synthetics.loca.lt/?p=12',0,'revision','',0),
(13,0,'2026-04-19 16:06:46','2026-04-19 16:06:46','<!-- wp:woocommerce/cart /-->','Cart','','inherit','closed','closed','','7-revision-v1','','','2026-04-19 16:06:46','2026-04-19 16:06:46','',7,'https://azure-synthetics.loca.lt/?p=13',0,'revision','',0),
(14,0,'2026-04-19 16:06:46','2026-04-19 16:06:46','<!-- wp:woocommerce/checkout /-->','Checkout','','inherit','closed','closed','','8-revision-v1','','','2026-04-19 16:06:46','2026-04-19 16:06:46','',8,'https://azure-synthetics.loca.lt/?p=14',0,'revision','',0),
(15,0,'2026-04-19 16:06:46','2026-04-19 16:06:46','<!-- wp:woocommerce/my-account /-->','My account','','inherit','closed','closed','','9-revision-v1','','','2026-04-19 16:06:46','2026-04-19 16:06:46','',9,'https://azure-synthetics.loca.lt/?p=15',0,'revision','',0),
(16,0,'2026-04-19 16:06:46','2026-04-19 16:06:46','','FAQ','','publish','closed','closed','','faq','','','2026-04-20 21:59:13','2026-04-20 21:59:13','',0,'https://azure-synthetics.loca.lt/faq/',0,'page','',0),
(17,0,'2026-04-19 16:06:46','2026-04-19 16:06:46','','Contact','','publish','closed','closed','','contact','','','2026-04-20 21:59:13','2026-04-20 21:59:13','',0,'https://azure-synthetics.loca.lt/contact/',0,'page','',0),
(18,0,'2026-04-19 16:06:46','2026-04-19 16:06:46','For research use only. Not for human consumption. Azure Synthetics products are sold exclusively for laboratory, analytical, and investigational environments. Do not market, position, or rely on this catalog for diagnosis, treatment, mitigation, or cure claims.','Research Use Policy','','publish','closed','closed','','research-use-policy','','','2026-04-20 21:59:13','2026-04-20 21:59:13','',0,'https://azure-synthetics.loca.lt/research-use-policy/',0,'page','',0),
(19,0,'2026-04-19 16:06:46','2026-04-19 16:06:46','','card-bpc157','','inherit','open','closed','','card-bpc157','','','2026-04-19 16:06:46','2026-04-19 16:06:46','',0,'https://azure-synthetics.loca.lt/card-bpc157/',0,'attachment','image/png',0),
(20,0,'2026-04-19 16:06:46','2026-04-19 16:06:46','','card-motsc','','inherit','open','closed','','card-motsc','','','2026-04-19 16:06:46','2026-04-19 16:06:46','',0,'https://azure-synthetics.loca.lt/card-motsc/',0,'attachment','image/png',0),
(21,0,'2026-04-19 16:06:47','2026-04-19 16:06:47','','card-cjcipa','','inherit','open','closed','','card-cjcipa','','','2026-04-19 16:06:47','2026-04-19 16:06:47','',0,'https://azure-synthetics.loca.lt/card-cjcipa/',0,'attachment','image/png',0),
(22,0,'2026-04-19 16:06:47','2026-04-19 16:06:47','','card-glp3','','inherit','open','closed','','card-glp3','','','2026-04-19 16:06:47','2026-04-19 16:06:47','',0,'https://azure-synthetics.loca.lt/card-glp3/',0,'attachment','image/png',0),
(23,0,'2026-04-19 16:06:47','2026-04-19 16:06:47','Built for recovery and repair-oriented research programs that prioritize documentation, packaging stability, and lot continuity over generic catalog merchandising.','BPC-157','Lyophilized recovery peptide with traceable COA support.','publish','open','closed','','bpc-157','','','2026-04-20 21:59:14','2026-04-20 21:59:14','',0,'https://azure-synthetics.loca.lt/product/bpc-157/',0,'product','',0),
(24,0,'2026-04-19 16:06:47','2026-04-19 16:06:47','Positioned for longevity and metabolic support research workflows that value legible technical metadata and repeat-order continuity.','MOTS-C','Mitochondrial research compound with premium cold-chain presentation.','publish','open','closed','','mots-c','','','2026-04-20 21:59:14','2026-04-20 21:59:14','',0,'https://azure-synthetics.loca.lt/product/mots-c/',0,'product','',0),
(25,0,'2026-04-19 16:06:47','2026-04-19 16:06:47','A variable product scaffold for vial and kit purchasing, demonstrating WooCommerce-native pack options without custom checkout hacks.','CJC / IPA','Variable format peptide stack presented with clean protocol metadata.','publish','open','closed','','cjc-ipa','','','2026-04-20 21:59:14','2026-04-20 21:59:14','',0,'https://azure-synthetics.loca.lt/product/cjc-ipa/',0,'product','',0),
(26,0,'2026-04-19 16:06:47','2026-04-19 16:06:47','','CJC / IPA','','publish','closed','closed','','cjc-ipa-1-kit-5-mg-5-mg','','','2026-04-19 16:06:47','2026-04-19 16:06:47','',25,'https://azure-synthetics.loca.lt/?post_type=product_variation&p=26',0,'product_variation','',0),
(27,0,'2026-04-19 16:06:48','2026-04-19 16:06:48','','CJC / IPA','','publish','closed','closed','','cjc-ipa-2-kits-5-mg-5-mg','','','2026-04-19 16:06:48','2026-04-19 16:06:48','',25,'https://azure-synthetics.loca.lt/?post_type=product_variation&p=27',0,'product_variation','',0),
(28,0,'2026-04-19 16:06:48','2026-04-19 16:06:48','Uses the emphasized card styling from the reference design and demonstrates high-contrast product merchandising for flagship catalog entries.','GLP-3','Body composition research peptide displayed with premium dark-surface merchandising.','publish','open','closed','','glp-3','','','2026-04-20 21:59:14','2026-04-20 21:59:14','',0,'https://azure-synthetics.loca.lt/product/glp-3/',0,'product','',0),
(29,0,'2026-04-20 21:59:14','2026-04-19 16:06:48','','Home','','publish','closed','closed','','home','','','2026-04-20 21:59:14','2026-04-20 21:59:14','',0,'https://azure-synthetics.loca.lt/home/',5,'nav_menu_item','',0),
(30,0,'2026-04-20 21:59:14','2026-04-19 16:06:48','','Shop','','publish','closed','closed','','shop','','','2026-04-20 21:59:14','2026-04-20 21:59:14','',0,'https://azure-synthetics.loca.lt/shop/',5,'nav_menu_item','',0),
(31,0,'2026-04-20 21:59:14','2026-04-19 16:06:48','','Science','','publish','closed','closed','','science','','','2026-04-20 21:59:14','2026-04-20 21:59:14','',0,'https://azure-synthetics.loca.lt/science/',5,'nav_menu_item','',0),
(32,0,'2026-04-20 21:59:14','2026-04-19 16:06:48','','FAQ','','publish','closed','closed','','faq','','','2026-04-20 21:59:14','2026-04-20 21:59:14','',0,'https://azure-synthetics.loca.lt/faq/',5,'nav_menu_item','',0),
(33,0,'2026-04-19 16:07:30','2026-04-19 16:07:30','','Home','','inherit','closed','closed','','11-revision-v1','','','2026-04-19 16:07:30','2026-04-19 16:07:30','',11,'https://azure-synthetics.loca.lt/?p=33',0,'revision','',0),
(34,0,'2026-04-19 16:07:30','2026-04-19 16:07:30','','FAQ','','inherit','closed','closed','','16-revision-v1','','','2026-04-19 16:07:30','2026-04-19 16:07:30','',16,'https://azure-synthetics.loca.lt/?p=34',0,'revision','',0),
(35,0,'2026-04-19 16:07:30','2026-04-19 16:07:30','','Contact','','inherit','closed','closed','','17-revision-v1','','','2026-04-19 16:07:30','2026-04-19 16:07:30','',17,'https://azure-synthetics.loca.lt/?p=35',0,'revision','',0),
(36,0,'2026-04-19 16:07:30','2026-04-19 16:07:30','For research use only. Not for human consumption. Azure Synthetics products are sold exclusively for laboratory, analytical, and investigational environments. Do not market, position, or rely on this catalog for diagnosis, treatment, mitigation, or cure claims.','Research Use Policy','','inherit','closed','closed','','18-revision-v1','','','2026-04-19 16:07:30','2026-04-19 16:07:30','',18,'https://azure-synthetics.loca.lt/?p=36',0,'revision','',0),
(37,0,'2026-04-19 17:51:58','2026-04-19 17:51:58','','Science','','publish','closed','closed','','science','','','2026-04-20 21:59:13','2026-04-20 21:59:13','',0,'https://azure-synthetics.loca.lt/science/',0,'page','',0),
(38,0,'2026-04-19 18:14:40','2026-04-19 18:14:40','','Science','','inherit','closed','closed','','37-revision-v1','','','2026-04-19 18:14:40','2026-04-19 18:14:40','',37,'https://azure-synthetics.loca.lt/?p=38',0,'revision','',0);
/*!40000 ALTER TABLE `wp_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_term_relationships`
--

DROP TABLE IF EXISTS `wp_term_relationships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `term_order` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_term_relationships`
--

LOCK TABLES `wp_term_relationships` WRITE;
/*!40000 ALTER TABLE `wp_term_relationships` DISABLE KEYS */;
INSERT INTO `wp_term_relationships` VALUES
(1,1,0),
(23,2,0),
(23,8,0),
(23,16,0),
(24,2,0),
(24,8,0),
(24,18,0),
(25,4,0),
(25,8,0),
(25,16,0),
(28,2,0),
(28,8,0),
(28,17,0),
(29,19,0),
(30,19,0),
(31,19,0),
(32,19,0);
/*!40000 ALTER TABLE `wp_term_relationships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_term_taxonomy`
--

DROP TABLE IF EXISTS `wp_term_taxonomy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT 0,
  `count` bigint(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_term_taxonomy`
--

LOCK TABLES `wp_term_taxonomy` WRITE;
/*!40000 ALTER TABLE `wp_term_taxonomy` DISABLE KEYS */;
INSERT INTO `wp_term_taxonomy` VALUES
(1,1,'category','',0,1),
(2,2,'product_type','',0,3),
(3,3,'product_type','',0,0),
(4,4,'product_type','',0,1),
(5,5,'product_type','',0,0),
(6,6,'product_visibility','',0,0),
(7,7,'product_visibility','',0,0),
(8,8,'product_visibility','',0,4),
(9,9,'product_visibility','',0,0),
(10,10,'product_visibility','',0,0),
(11,11,'product_visibility','',0,0),
(12,12,'product_visibility','',0,0),
(13,13,'product_visibility','',0,0),
(14,14,'product_visibility','',0,0),
(15,15,'product_cat','',0,0),
(16,16,'product_cat','',0,2),
(17,17,'product_cat','',0,1),
(18,18,'product_cat','',0,1),
(19,19,'nav_menu','',0,4);
/*!40000 ALTER TABLE `wp_term_taxonomy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_termmeta`
--

DROP TABLE IF EXISTS `wp_termmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_termmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `term_id` (`term_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_termmeta`
--

LOCK TABLES `wp_termmeta` WRITE;
/*!40000 ALTER TABLE `wp_termmeta` DISABLE KEYS */;
INSERT INTO `wp_termmeta` VALUES
(1,16,'product_count_product_cat','2'),
(2,18,'product_count_product_cat','1'),
(3,17,'product_count_product_cat','1');
/*!40000 ALTER TABLE `wp_termmeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_terms`
--

DROP TABLE IF EXISTS `wp_terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_terms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`term_id`),
  KEY `slug` (`slug`(191)),
  KEY `name` (`name`(191))
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_terms`
--

LOCK TABLES `wp_terms` WRITE;
/*!40000 ALTER TABLE `wp_terms` DISABLE KEYS */;
INSERT INTO `wp_terms` VALUES
(1,'Uncategorized','uncategorized',0),
(2,'simple','simple',0),
(3,'grouped','grouped',0),
(4,'variable','variable',0),
(5,'external','external',0),
(6,'exclude-from-search','exclude-from-search',0),
(7,'exclude-from-catalog','exclude-from-catalog',0),
(8,'featured','featured',0),
(9,'outofstock','outofstock',0),
(10,'rated-1','rated-1',0),
(11,'rated-2','rated-2',0),
(12,'rated-3','rated-3',0),
(13,'rated-4','rated-4',0),
(14,'rated-5','rated-5',0),
(15,'Uncategorized','uncategorized',0),
(16,'Recovery + Repair','recovery-repair',0),
(17,'Body Composition','body-composition',0),
(18,'Longevity + Energy','longevity-energy',0),
(19,'Primary Navigation','primary-navigation',0);
/*!40000 ALTER TABLE `wp_terms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_usermeta`
--

DROP TABLE IF EXISTS `wp_usermeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_usermeta`
--

LOCK TABLES `wp_usermeta` WRITE;
/*!40000 ALTER TABLE `wp_usermeta` DISABLE KEYS */;
INSERT INTO `wp_usermeta` VALUES
(1,1,'nickname','admin'),
(2,1,'first_name',''),
(3,1,'last_name',''),
(4,1,'description',''),
(5,1,'rich_editing','true'),
(6,1,'syntax_highlighting','true'),
(7,1,'comment_shortcuts','false'),
(8,1,'admin_color','fresh'),
(9,1,'use_ssl','0'),
(10,1,'show_admin_bar_front','true'),
(11,1,'locale',''),
(12,1,'wp_capabilities','a:1:{s:13:\"administrator\";b:1;}'),
(13,1,'wp_user_level','10'),
(14,1,'dismissed_wp_pointers',''),
(15,1,'show_welcome_panel','1');
/*!40000 ALTER TABLE `wp_usermeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_users`
--

DROP TABLE IF EXISTS `wp_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(255) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT 0,
  `display_name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`),
  KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_users`
--

LOCK TABLES `wp_users` WRITE;
/*!40000 ALTER TABLE `wp_users` DISABLE KEYS */;
INSERT INTO `wp_users` VALUES
(1,'admin','$wp$2y$10$klFlUHOFyAjFfGFDhQga5ONh3ysWD3piCxZEQCVq5Dj92ZEg860RO','admin','admin@example.com','https://azure-synthetics.loca.lt','2026-04-19 15:56:12','',0,'admin');
/*!40000 ALTER TABLE `wp_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_wc_admin_note_actions`
--

DROP TABLE IF EXISTS `wp_wc_admin_note_actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_wc_admin_note_actions` (
  `action_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `note_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `query` longtext NOT NULL,
  `status` varchar(255) NOT NULL,
  `actioned_text` varchar(255) NOT NULL,
  `nonce_action` varchar(255) DEFAULT NULL,
  `nonce_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`action_id`),
  KEY `note_id` (`note_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_wc_admin_note_actions`
--

LOCK TABLES `wp_wc_admin_note_actions` WRITE;
/*!40000 ALTER TABLE `wp_wc_admin_note_actions` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_wc_admin_note_actions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_wc_admin_notes`
--

DROP TABLE IF EXISTS `wp_wc_admin_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_wc_admin_notes` (
  `note_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `locale` varchar(20) NOT NULL,
  `title` longtext NOT NULL,
  `content` longtext NOT NULL,
  `content_data` longtext DEFAULT NULL,
  `status` varchar(200) NOT NULL,
  `source` varchar(200) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_reminder` datetime DEFAULT NULL,
  `is_snoozable` tinyint(1) NOT NULL DEFAULT 0,
  `layout` varchar(20) NOT NULL DEFAULT '',
  `image` varchar(200) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `icon` varchar(200) NOT NULL DEFAULT 'info',
  PRIMARY KEY (`note_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_wc_admin_notes`
--

LOCK TABLES `wp_wc_admin_notes` WRITE;
/*!40000 ALTER TABLE `wp_wc_admin_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_wc_admin_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_wc_category_lookup`
--

DROP TABLE IF EXISTS `wp_wc_category_lookup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_wc_category_lookup` (
  `category_tree_id` bigint(20) unsigned NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`category_tree_id`,`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_wc_category_lookup`
--

LOCK TABLES `wp_wc_category_lookup` WRITE;
/*!40000 ALTER TABLE `wp_wc_category_lookup` DISABLE KEYS */;
INSERT INTO `wp_wc_category_lookup` VALUES
(16,16),
(17,17),
(18,18);
/*!40000 ALTER TABLE `wp_wc_category_lookup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_wc_customer_lookup`
--

DROP TABLE IF EXISTS `wp_wc_customer_lookup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_wc_customer_lookup` (
  `customer_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `username` varchar(60) NOT NULL DEFAULT '',
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `date_last_active` timestamp NULL DEFAULT NULL,
  `date_registered` timestamp NULL DEFAULT NULL,
  `country` char(2) NOT NULL DEFAULT '',
  `postcode` varchar(20) NOT NULL DEFAULT '',
  `city` varchar(100) NOT NULL DEFAULT '',
  `state` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `user_id` (`user_id`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_wc_customer_lookup`
--

LOCK TABLES `wp_wc_customer_lookup` WRITE;
/*!40000 ALTER TABLE `wp_wc_customer_lookup` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_wc_customer_lookup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_wc_download_log`
--

DROP TABLE IF EXISTS `wp_wc_download_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_wc_download_log` (
  `download_log_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `timestamp` datetime NOT NULL,
  `permission_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `user_ip_address` varchar(100) DEFAULT '',
  PRIMARY KEY (`download_log_id`),
  KEY `permission_id` (`permission_id`),
  KEY `timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_wc_download_log`
--

LOCK TABLES `wp_wc_download_log` WRITE;
/*!40000 ALTER TABLE `wp_wc_download_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_wc_download_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_wc_order_coupon_lookup`
--

DROP TABLE IF EXISTS `wp_wc_order_coupon_lookup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_wc_order_coupon_lookup` (
  `order_id` bigint(20) unsigned NOT NULL,
  `coupon_id` bigint(20) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `discount_amount` double NOT NULL DEFAULT 0,
  PRIMARY KEY (`order_id`,`coupon_id`),
  KEY `coupon_id` (`coupon_id`),
  KEY `date_created` (`date_created`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_wc_order_coupon_lookup`
--

LOCK TABLES `wp_wc_order_coupon_lookup` WRITE;
/*!40000 ALTER TABLE `wp_wc_order_coupon_lookup` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_wc_order_coupon_lookup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_wc_order_product_lookup`
--

DROP TABLE IF EXISTS `wp_wc_order_product_lookup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_wc_order_product_lookup` (
  `order_item_id` bigint(20) unsigned NOT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `variation_id` bigint(20) unsigned NOT NULL,
  `customer_id` bigint(20) unsigned DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `product_qty` int(11) NOT NULL,
  `product_net_revenue` double NOT NULL DEFAULT 0,
  `product_gross_revenue` double NOT NULL DEFAULT 0,
  `coupon_amount` double NOT NULL DEFAULT 0,
  `tax_amount` double NOT NULL DEFAULT 0,
  `shipping_amount` double NOT NULL DEFAULT 0,
  `shipping_tax_amount` double NOT NULL DEFAULT 0,
  PRIMARY KEY (`order_item_id`,`order_id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  KEY `customer_id` (`customer_id`),
  KEY `date_created` (`date_created`),
  KEY `customer_product_date` (`customer_id`,`product_id`,`date_created`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_wc_order_product_lookup`
--

LOCK TABLES `wp_wc_order_product_lookup` WRITE;
/*!40000 ALTER TABLE `wp_wc_order_product_lookup` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_wc_order_product_lookup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_wc_order_stats`
--

DROP TABLE IF EXISTS `wp_wc_order_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_wc_order_stats` (
  `order_id` bigint(20) unsigned NOT NULL,
  `parent_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_created_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_paid` datetime DEFAULT '0000-00-00 00:00:00',
  `date_completed` datetime DEFAULT '0000-00-00 00:00:00',
  `num_items_sold` int(11) NOT NULL DEFAULT 0,
  `total_sales` double NOT NULL DEFAULT 0,
  `tax_total` double NOT NULL DEFAULT 0,
  `shipping_total` double NOT NULL DEFAULT 0,
  `net_total` double NOT NULL DEFAULT 0,
  `returning_customer` tinyint(1) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `customer_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `date_created` (`date_created`),
  KEY `customer_id` (`customer_id`),
  KEY `status` (`status`),
  KEY `idx_date_paid_status_parent` (`date_paid`,`status`,`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_wc_order_stats`
--

LOCK TABLES `wp_wc_order_stats` WRITE;
/*!40000 ALTER TABLE `wp_wc_order_stats` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_wc_order_stats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_wc_order_tax_lookup`
--

DROP TABLE IF EXISTS `wp_wc_order_tax_lookup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_wc_order_tax_lookup` (
  `order_id` bigint(20) unsigned NOT NULL,
  `tax_rate_id` bigint(20) unsigned NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `shipping_tax` double NOT NULL DEFAULT 0,
  `order_tax` double NOT NULL DEFAULT 0,
  `total_tax` double NOT NULL DEFAULT 0,
  PRIMARY KEY (`order_id`,`tax_rate_id`),
  KEY `tax_rate_id` (`tax_rate_id`),
  KEY `date_created` (`date_created`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_wc_order_tax_lookup`
--

LOCK TABLES `wp_wc_order_tax_lookup` WRITE;
/*!40000 ALTER TABLE `wp_wc_order_tax_lookup` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_wc_order_tax_lookup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_wc_product_attributes_lookup`
--

DROP TABLE IF EXISTS `wp_wc_product_attributes_lookup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_wc_product_attributes_lookup` (
  `product_id` bigint(20) NOT NULL,
  `product_or_parent_id` bigint(20) NOT NULL,
  `taxonomy` varchar(32) NOT NULL,
  `term_id` bigint(20) NOT NULL,
  `is_variation_attribute` tinyint(1) NOT NULL,
  `in_stock` tinyint(1) NOT NULL,
  PRIMARY KEY (`product_or_parent_id`,`term_id`,`product_id`,`taxonomy`),
  KEY `is_variation_attribute_term_id` (`is_variation_attribute`,`term_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_wc_product_attributes_lookup`
--

LOCK TABLES `wp_wc_product_attributes_lookup` WRITE;
/*!40000 ALTER TABLE `wp_wc_product_attributes_lookup` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_wc_product_attributes_lookup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_wc_product_download_directories`
--

DROP TABLE IF EXISTS `wp_wc_product_download_directories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_wc_product_download_directories` (
  `url_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(256) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`url_id`),
  KEY `url` (`url`(191))
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_wc_product_download_directories`
--

LOCK TABLES `wp_wc_product_download_directories` WRITE;
/*!40000 ALTER TABLE `wp_wc_product_download_directories` DISABLE KEYS */;
INSERT INTO `wp_wc_product_download_directories` VALUES
(1,'file:///var/www/html/wp-content/uploads/woocommerce_uploads/',1),
(2,'http://localhost:8080/wp-content/uploads/woocommerce_uploads/',1);
/*!40000 ALTER TABLE `wp_wc_product_download_directories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_wc_product_meta_lookup`
--

DROP TABLE IF EXISTS `wp_wc_product_meta_lookup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_wc_product_meta_lookup` (
  `product_id` bigint(20) NOT NULL,
  `sku` varchar(100) DEFAULT '',
  `global_unique_id` varchar(100) DEFAULT '',
  `virtual` tinyint(1) DEFAULT 0,
  `downloadable` tinyint(1) DEFAULT 0,
  `min_price` decimal(19,4) DEFAULT NULL,
  `max_price` decimal(19,4) DEFAULT NULL,
  `onsale` tinyint(1) DEFAULT 0,
  `stock_quantity` double DEFAULT NULL,
  `stock_status` varchar(100) DEFAULT 'instock',
  `rating_count` bigint(20) DEFAULT 0,
  `average_rating` decimal(3,2) DEFAULT 0.00,
  `total_sales` bigint(20) DEFAULT 0,
  `tax_status` varchar(100) DEFAULT 'taxable',
  `tax_class` varchar(100) DEFAULT '',
  PRIMARY KEY (`product_id`),
  KEY `virtual` (`virtual`),
  KEY `downloadable` (`downloadable`),
  KEY `stock_status` (`stock_status`),
  KEY `stock_quantity` (`stock_quantity`),
  KEY `onsale` (`onsale`),
  KEY `min_max_price` (`min_price`,`max_price`),
  KEY `sku` (`sku`(50))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_wc_product_meta_lookup`
--

LOCK TABLES `wp_wc_product_meta_lookup` WRITE;
/*!40000 ALTER TABLE `wp_wc_product_meta_lookup` DISABLE KEYS */;
INSERT INTO `wp_wc_product_meta_lookup` VALUES
(23,'AZ-BPC157-10','',0,0,95.0000,95.0000,0,NULL,'instock',0,0.00,0,'taxable',''),
(24,'AZ-MOTSC-10','',0,0,110.0000,110.0000,0,NULL,'instock',0,0.00,0,'taxable',''),
(25,'AZ-CJCIPA','',0,0,105.0000,198.0000,0,NULL,'instock',0,0.00,0,'taxable',''),
(26,'AZ-CJCIPA-1KIT','',0,0,105.0000,105.0000,0,NULL,'instock',0,0.00,0,'taxable','parent'),
(27,'AZ-CJCIPA-2KIT','',0,0,198.0000,198.0000,0,NULL,'instock',0,0.00,0,'taxable','parent'),
(28,'AZ-GLP3-15','',0,0,130.0000,130.0000,0,NULL,'instock',0,0.00,0,'taxable','');
/*!40000 ALTER TABLE `wp_wc_product_meta_lookup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_wc_rate_limits`
--

DROP TABLE IF EXISTS `wp_wc_rate_limits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_wc_rate_limits` (
  `rate_limit_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `rate_limit_key` varchar(200) NOT NULL,
  `rate_limit_expiry` bigint(20) unsigned NOT NULL,
  `rate_limit_remaining` smallint(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`rate_limit_id`),
  UNIQUE KEY `rate_limit_key` (`rate_limit_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_wc_rate_limits`
--

LOCK TABLES `wp_wc_rate_limits` WRITE;
/*!40000 ALTER TABLE `wp_wc_rate_limits` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_wc_rate_limits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_wc_reserved_stock`
--

DROP TABLE IF EXISTS `wp_wc_reserved_stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_wc_reserved_stock` (
  `order_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `stock_quantity` double NOT NULL DEFAULT 0,
  `timestamp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `expires` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`order_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_wc_reserved_stock`
--

LOCK TABLES `wp_wc_reserved_stock` WRITE;
/*!40000 ALTER TABLE `wp_wc_reserved_stock` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_wc_reserved_stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_wc_tax_rate_classes`
--

DROP TABLE IF EXISTS `wp_wc_tax_rate_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_wc_tax_rate_classes` (
  `tax_rate_class_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`tax_rate_class_id`),
  UNIQUE KEY `slug` (`slug`(191))
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_wc_tax_rate_classes`
--

LOCK TABLES `wp_wc_tax_rate_classes` WRITE;
/*!40000 ALTER TABLE `wp_wc_tax_rate_classes` DISABLE KEYS */;
INSERT INTO `wp_wc_tax_rate_classes` VALUES
(1,'Reduced rate','reduced-rate'),
(2,'Zero rate','zero-rate');
/*!40000 ALTER TABLE `wp_wc_tax_rate_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_wc_webhooks`
--

DROP TABLE IF EXISTS `wp_wc_webhooks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_wc_webhooks` (
  `webhook_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(200) NOT NULL,
  `name` text NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `delivery_url` text NOT NULL,
  `secret` text NOT NULL,
  `topic` varchar(200) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_created_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `api_version` smallint(4) NOT NULL,
  `failure_count` smallint(10) NOT NULL DEFAULT 0,
  `pending_delivery` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`webhook_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_wc_webhooks`
--

LOCK TABLES `wp_wc_webhooks` WRITE;
/*!40000 ALTER TABLE `wp_wc_webhooks` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_wc_webhooks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_woocommerce_api_keys`
--

DROP TABLE IF EXISTS `wp_woocommerce_api_keys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_woocommerce_api_keys` (
  `key_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `permissions` varchar(10) NOT NULL,
  `consumer_key` char(64) NOT NULL,
  `consumer_secret` char(43) NOT NULL,
  `nonces` longtext DEFAULT NULL,
  `truncated_key` char(7) NOT NULL,
  `last_access` datetime DEFAULT NULL,
  PRIMARY KEY (`key_id`),
  KEY `consumer_key` (`consumer_key`),
  KEY `consumer_secret` (`consumer_secret`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_woocommerce_api_keys`
--

LOCK TABLES `wp_woocommerce_api_keys` WRITE;
/*!40000 ALTER TABLE `wp_woocommerce_api_keys` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_woocommerce_api_keys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_woocommerce_attribute_taxonomies`
--

DROP TABLE IF EXISTS `wp_woocommerce_attribute_taxonomies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_woocommerce_attribute_taxonomies` (
  `attribute_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `attribute_name` varchar(200) NOT NULL,
  `attribute_label` varchar(200) DEFAULT NULL,
  `attribute_type` varchar(20) NOT NULL,
  `attribute_orderby` varchar(20) NOT NULL,
  `attribute_public` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`attribute_id`),
  KEY `attribute_name` (`attribute_name`(20))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_woocommerce_attribute_taxonomies`
--

LOCK TABLES `wp_woocommerce_attribute_taxonomies` WRITE;
/*!40000 ALTER TABLE `wp_woocommerce_attribute_taxonomies` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_woocommerce_attribute_taxonomies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_woocommerce_downloadable_product_permissions`
--

DROP TABLE IF EXISTS `wp_woocommerce_downloadable_product_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_woocommerce_downloadable_product_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `download_id` varchar(36) NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `order_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `order_key` varchar(200) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `downloads_remaining` varchar(9) DEFAULT NULL,
  `access_granted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access_expires` datetime DEFAULT NULL,
  `download_count` bigint(20) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`permission_id`),
  KEY `download_order_key_product` (`product_id`,`order_id`,`order_key`(16),`download_id`),
  KEY `download_order_product` (`download_id`,`order_id`,`product_id`),
  KEY `order_id` (`order_id`),
  KEY `user_order_remaining_expires` (`user_id`,`order_id`,`downloads_remaining`,`access_expires`),
  KEY `idx_user_email` (`user_email`(100))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_woocommerce_downloadable_product_permissions`
--

LOCK TABLES `wp_woocommerce_downloadable_product_permissions` WRITE;
/*!40000 ALTER TABLE `wp_woocommerce_downloadable_product_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_woocommerce_downloadable_product_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_woocommerce_log`
--

DROP TABLE IF EXISTS `wp_woocommerce_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_woocommerce_log` (
  `log_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `timestamp` datetime NOT NULL,
  `level` smallint(4) NOT NULL,
  `source` varchar(200) NOT NULL,
  `message` longtext NOT NULL,
  `context` longtext DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `level` (`level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_woocommerce_log`
--

LOCK TABLES `wp_woocommerce_log` WRITE;
/*!40000 ALTER TABLE `wp_woocommerce_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_woocommerce_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_woocommerce_order_itemmeta`
--

DROP TABLE IF EXISTS `wp_woocommerce_order_itemmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_woocommerce_order_itemmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_item_id` bigint(20) unsigned NOT NULL,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `order_item_id` (`order_item_id`),
  KEY `meta_key` (`meta_key`(32))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_woocommerce_order_itemmeta`
--

LOCK TABLES `wp_woocommerce_order_itemmeta` WRITE;
/*!40000 ALTER TABLE `wp_woocommerce_order_itemmeta` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_woocommerce_order_itemmeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_woocommerce_order_items`
--

DROP TABLE IF EXISTS `wp_woocommerce_order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_woocommerce_order_items` (
  `order_item_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_item_name` text NOT NULL,
  `order_item_type` varchar(200) NOT NULL DEFAULT '',
  `order_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`order_item_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_woocommerce_order_items`
--

LOCK TABLES `wp_woocommerce_order_items` WRITE;
/*!40000 ALTER TABLE `wp_woocommerce_order_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_woocommerce_order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_woocommerce_payment_tokenmeta`
--

DROP TABLE IF EXISTS `wp_woocommerce_payment_tokenmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_woocommerce_payment_tokenmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `payment_token_id` bigint(20) unsigned NOT NULL,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `payment_token_id` (`payment_token_id`),
  KEY `meta_key` (`meta_key`(32))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_woocommerce_payment_tokenmeta`
--

LOCK TABLES `wp_woocommerce_payment_tokenmeta` WRITE;
/*!40000 ALTER TABLE `wp_woocommerce_payment_tokenmeta` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_woocommerce_payment_tokenmeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_woocommerce_payment_tokens`
--

DROP TABLE IF EXISTS `wp_woocommerce_payment_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_woocommerce_payment_tokens` (
  `token_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `gateway_id` varchar(200) NOT NULL,
  `token` text NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `type` varchar(200) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`token_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_woocommerce_payment_tokens`
--

LOCK TABLES `wp_woocommerce_payment_tokens` WRITE;
/*!40000 ALTER TABLE `wp_woocommerce_payment_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_woocommerce_payment_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_woocommerce_sessions`
--

DROP TABLE IF EXISTS `wp_woocommerce_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_woocommerce_sessions` (
  `session_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `session_key` char(32) NOT NULL,
  `session_value` longtext NOT NULL,
  `session_expiry` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`session_id`),
  UNIQUE KEY `session_key` (`session_key`),
  KEY `session_expiry` (`session_expiry`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_woocommerce_sessions`
--

LOCK TABLES `wp_woocommerce_sessions` WRITE;
/*!40000 ALTER TABLE `wp_woocommerce_sessions` DISABLE KEYS */;
INSERT INTO `wp_woocommerce_sessions` VALUES
(1,'t_e28e6e5b9bcf853cd247cca682882d','a:2:{s:11:\"cart_totals\";s:396:\"a:15:{s:8:\"subtotal\";s:3:\"130\";s:12:\"subtotal_tax\";d:0;s:14:\"shipping_total\";s:1:\"0\";s:12:\"shipping_tax\";d:0;s:14:\"shipping_taxes\";a:0:{}s:14:\"discount_total\";d:0;s:12:\"discount_tax\";d:0;s:19:\"cart_contents_total\";s:3:\"130\";s:17:\"cart_contents_tax\";i:0;s:19:\"cart_contents_taxes\";a:0:{}s:9:\"fee_total\";s:1:\"0\";s:7:\"fee_tax\";d:0;s:9:\"fee_taxes\";a:0:{}s:5:\"total\";s:6:\"130.00\";s:9:\"total_tax\";d:0;}\";s:4:\"cart\";s:412:\"a:1:{s:32:\"33e75ff09dd601bbe69f351039152189\";a:11:{s:3:\"key\";s:32:\"33e75ff09dd601bbe69f351039152189\";s:10:\"product_id\";i:28;s:12:\"variation_id\";i:0;s:9:\"variation\";a:0:{}s:8:\"quantity\";i:1;s:9:\"data_hash\";s:32:\"b5c1d5ca8bae6d4896cf1807cdf763f0\";s:13:\"line_tax_data\";a:2:{s:8:\"subtotal\";a:0:{}s:5:\"total\";a:0:{}}s:13:\"line_subtotal\";d:130;s:17:\"line_subtotal_tax\";d:0;s:10:\"line_total\";d:130;s:8:\"line_tax\";d:0;}}\";}',1776895188);
/*!40000 ALTER TABLE `wp_woocommerce_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_woocommerce_shipping_zone_locations`
--

DROP TABLE IF EXISTS `wp_woocommerce_shipping_zone_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_woocommerce_shipping_zone_locations` (
  `location_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `zone_id` bigint(20) unsigned NOT NULL,
  `location_code` varchar(200) NOT NULL,
  `location_type` varchar(40) NOT NULL,
  PRIMARY KEY (`location_id`),
  KEY `zone_id` (`zone_id`),
  KEY `location_type_code` (`location_type`(10),`location_code`(20))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_woocommerce_shipping_zone_locations`
--

LOCK TABLES `wp_woocommerce_shipping_zone_locations` WRITE;
/*!40000 ALTER TABLE `wp_woocommerce_shipping_zone_locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_woocommerce_shipping_zone_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_woocommerce_shipping_zone_methods`
--

DROP TABLE IF EXISTS `wp_woocommerce_shipping_zone_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_woocommerce_shipping_zone_methods` (
  `zone_id` bigint(20) unsigned NOT NULL,
  `instance_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `method_id` varchar(200) NOT NULL,
  `method_order` bigint(20) unsigned NOT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`instance_id`),
  KEY `zone_id` (`zone_id`),
  KEY `method_id` (`method_id`(20))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_woocommerce_shipping_zone_methods`
--

LOCK TABLES `wp_woocommerce_shipping_zone_methods` WRITE;
/*!40000 ALTER TABLE `wp_woocommerce_shipping_zone_methods` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_woocommerce_shipping_zone_methods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_woocommerce_shipping_zones`
--

DROP TABLE IF EXISTS `wp_woocommerce_shipping_zones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_woocommerce_shipping_zones` (
  `zone_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `zone_name` varchar(200) NOT NULL,
  `zone_order` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`zone_id`),
  KEY `zone_order_id` (`zone_order`,`zone_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_woocommerce_shipping_zones`
--

LOCK TABLES `wp_woocommerce_shipping_zones` WRITE;
/*!40000 ALTER TABLE `wp_woocommerce_shipping_zones` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_woocommerce_shipping_zones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_woocommerce_tax_rate_locations`
--

DROP TABLE IF EXISTS `wp_woocommerce_tax_rate_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_woocommerce_tax_rate_locations` (
  `location_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `location_code` varchar(200) NOT NULL,
  `tax_rate_id` bigint(20) unsigned NOT NULL,
  `location_type` varchar(40) NOT NULL,
  PRIMARY KEY (`location_id`),
  KEY `tax_rate_id` (`tax_rate_id`),
  KEY `location_type_code` (`location_type`(10),`location_code`(20))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_woocommerce_tax_rate_locations`
--

LOCK TABLES `wp_woocommerce_tax_rate_locations` WRITE;
/*!40000 ALTER TABLE `wp_woocommerce_tax_rate_locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_woocommerce_tax_rate_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_woocommerce_tax_rates`
--

DROP TABLE IF EXISTS `wp_woocommerce_tax_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wp_woocommerce_tax_rates` (
  `tax_rate_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tax_rate_country` varchar(2) NOT NULL DEFAULT '',
  `tax_rate_state` varchar(200) NOT NULL DEFAULT '',
  `tax_rate` varchar(8) NOT NULL DEFAULT '',
  `tax_rate_name` varchar(200) NOT NULL DEFAULT '',
  `tax_rate_priority` bigint(20) unsigned NOT NULL,
  `tax_rate_compound` int(1) NOT NULL DEFAULT 0,
  `tax_rate_shipping` int(1) NOT NULL DEFAULT 1,
  `tax_rate_order` bigint(20) unsigned NOT NULL,
  `tax_rate_class` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`tax_rate_id`),
  KEY `tax_rate_country` (`tax_rate_country`),
  KEY `tax_rate_state` (`tax_rate_state`(2)),
  KEY `tax_rate_class` (`tax_rate_class`(10)),
  KEY `tax_rate_priority` (`tax_rate_priority`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_woocommerce_tax_rates`
--

LOCK TABLES `wp_woocommerce_tax_rates` WRITE;
/*!40000 ALTER TABLE `wp_woocommerce_tax_rates` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_woocommerce_tax_rates` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Dump completed on 2026-04-20 23:29:01
