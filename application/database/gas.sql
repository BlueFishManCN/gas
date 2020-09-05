/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 100413
 Source Host           : localhost:3306
 Source Schema         : gas

 Target Server Type    : MySQL
 Target Server Version : 100413
 File Encoding         : 65001

 Date: 06/09/2020 02:38:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for amp_country
-- ----------------------------
DROP TABLE IF EXISTS `amp_country`;
CREATE TABLE `amp_country` (
  `AMP_ID` varchar(16) NOT NULL,
  `Asia` int(10) unsigned DEFAULT 0,
  `Europe` int(10) unsigned DEFAULT 0,
  `Africa` int(10) unsigned DEFAULT 0,
  `South_America` int(10) unsigned DEFAULT 0,
  `North_America` int(10) unsigned DEFAULT 0,
  `Oceania` int(10) unsigned DEFAULT 0,
  `Pacific_Ocean` int(10) unsigned DEFAULT 0,
  `New_Zaeland` int(10) unsigned DEFAULT 0,
  `na` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`AMP_ID`) USING BTREE,
  UNIQUE KEY `AMP_ID` (`AMP_ID`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=311663 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of amp_country
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for amp_db
-- ----------------------------
DROP TABLE IF EXISTS `amp_db`;
CREATE TABLE `amp_db` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `times` int(10) unsigned NOT NULL DEFAULT 0,
  `time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `name` (`name`(250)) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of amp_db
-- ----------------------------
BEGIN;
INSERT INTO `amp_db` VALUES (1, 'GAS.fasta', 0, '2020-09-06 02:34:58');
COMMIT;

-- ----------------------------
-- Table structure for amp_environment
-- ----------------------------
DROP TABLE IF EXISTS `amp_environment`;
CREATE TABLE `amp_environment` (
  `AMP_ID` varchar(16) NOT NULL,
  `Freshwater` int(10) unsigned DEFAULT 0,
  `Gut` int(10) unsigned DEFAULT 0,
  `Marine` int(10) unsigned DEFAULT 0,
  `Milk` int(10) unsigned DEFAULT 0,
  `Oral_Cavity` int(10) unsigned DEFAULT 0,
  `Respiratory_Tract` int(10) unsigned DEFAULT 0,
  `Skin` int(10) unsigned DEFAULT 0,
  `Soil` int(10) unsigned DEFAULT 0,
  `Surface` int(10) unsigned DEFAULT 0,
  `Vagina` int(10) unsigned DEFAULT 0,
  `Wastewater` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`AMP_ID`) USING BTREE,
  UNIQUE KEY `AMP_ID` (`AMP_ID`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=311663 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of amp_environment
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for amp_family
-- ----------------------------
DROP TABLE IF EXISTS `amp_family`;
CREATE TABLE `amp_family` (
  `AMP_ID` varchar(16) NOT NULL,
  `Family_ID` varchar(16) NOT NULL,
  `Sequence` varchar(255) DEFAULT NULL,
  `Length` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`AMP_ID`,`Family_ID`) USING BTREE,
  UNIQUE KEY `AMP_ID` (`AMP_ID`) USING BTREE,
  KEY `Sequence` (`Sequence`(250)) USING HASH,
  KEY `Length` (`Length`) USING BTREE,
  KEY `Family_ID` (`Family_ID`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=311663 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of amp_family
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for amp_feature
-- ----------------------------
DROP TABLE IF EXISTS `amp_feature`;
CREATE TABLE `amp_feature` (
  `AMP_ID` varchar(16) NOT NULL,
  `Sequence` varchar(255) DEFAULT NULL,
  `Length` int(10) unsigned DEFAULT 0,
  `tinyAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `smallAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `aliphaticAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `aromaticAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `nonpolarAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `polarAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `chargedAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `basicAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `acidicAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `charge` decimal(32,16) DEFAULT 0.0000000000000000,
  `pI` decimal(32,16) DEFAULT 0.0000000000000000,
  `aindex` decimal(32,16) DEFAULT 0.0000000000000000,
  `instaindex` decimal(32,16) DEFAULT 0.0000000000000000,
  `boman` decimal(32,16) DEFAULT 0.0000000000000000,
  `hydrophobicity` decimal(32,16) DEFAULT 0.0000000000000000,
  `hmoment` decimal(32,16) DEFAULT 0.0000000000000000,
  `SA_Group1_residue0` decimal(32,16) DEFAULT 0.0000000000000000,
  `SA_Group2_residue0` decimal(32,16) DEFAULT 0.0000000000000000,
  `SA_Group3_residue0` decimal(32,16) DEFAULT 0.0000000000000000,
  `HB_Group1_residue0` decimal(32,16) DEFAULT 0.0000000000000000,
  `HB_Group2_residue0` decimal(32,16) DEFAULT 0.0000000000000000,
  `HB_Group3_residue0` decimal(32,16) DEFAULT 0.0000000000000000,
  `AGG` decimal(32,16) DEFAULT 0.0000000000000000,
  `AMYLO` decimal(32,16) DEFAULT 0.0000000000000000,
  `TURN` decimal(32,16) DEFAULT 0.0000000000000000,
  `HELIX` decimal(32,16) DEFAULT 0.0000000000000000,
  `HELAGG` varchar(255) DEFAULT '0',
  `BETA` decimal(32,16) DEFAULT 0.0000000000000000,
  `Level_I` varchar(255) DEFAULT NULL,
  `Level_II` varchar(255) DEFAULT NULL,
  `Level_III` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`AMP_ID`) USING BTREE,
  UNIQUE KEY `id` (`AMP_ID`) USING BTREE,
  KEY `pI` (`pI`) USING BTREE,
  KEY `charge` (`charge`) USING BTREE,
  KEY `Length` (`Length`) USING BTREE,
  KEY `Sequence` (`Sequence`(250)) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=311663 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of amp_feature
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for amp_metagenome
-- ----------------------------
DROP TABLE IF EXISTS `amp_metagenome`;
CREATE TABLE `amp_metagenome` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `AMP_ID` varchar(16) NOT NULL,
  `metagenomes` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `AMP_ID` (`AMP_ID`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of amp_metagenome
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for amp_prediction
-- ----------------------------
DROP TABLE IF EXISTS `amp_prediction`;
CREATE TABLE `amp_prediction` (
  `AMP_ID` varchar(16) NOT NULL,
  `AMP_Class` varchar(255) DEFAULT NULL,
  `AMP_Probability` decimal(32,16) DEFAULT 0.0000000000000000,
  `Hemolysis_Class` varchar(255) DEFAULT NULL,
  `Hemolysis_Probability` decimal(32,16) DEFAULT 0.0000000000000000,
  PRIMARY KEY (`AMP_ID`) USING BTREE,
  UNIQUE KEY `AMP_ID` (`AMP_ID`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=311663 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of amp_prediction
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for blast_log
-- ----------------------------
DROP TABLE IF EXISTS `blast_log`;
CREATE TABLE `blast_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL,
  `directory` varchar(255) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of blast_log
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for family_avg_feature
-- ----------------------------
DROP TABLE IF EXISTS `family_avg_feature`;
CREATE TABLE `family_avg_feature` (
  `Family_ID` varchar(16) NOT NULL,
  `tinyAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `smallAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `aliphaticAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `aromaticAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `nonpolarAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `polarAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `chargedAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `basicAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `acidicAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `charge` decimal(32,16) DEFAULT 0.0000000000000000,
  `pI` decimal(32,16) DEFAULT 0.0000000000000000,
  `aindex` decimal(32,16) DEFAULT 0.0000000000000000,
  `instaindex` decimal(32,16) DEFAULT 0.0000000000000000,
  `boman` decimal(32,16) DEFAULT 0.0000000000000000,
  `hydrophobicity` decimal(32,16) DEFAULT 0.0000000000000000,
  `hmoment` decimal(32,16) DEFAULT 0.0000000000000000,
  `SA_Group1_residue0` decimal(32,16) DEFAULT 0.0000000000000000,
  `SA_Group2_residue0` decimal(32,16) DEFAULT 0.0000000000000000,
  `SA_Group3_residue0` decimal(32,16) DEFAULT 0.0000000000000000,
  `HB_Group1_residue0` decimal(32,16) DEFAULT 0.0000000000000000,
  `HB_Group2_residue0` decimal(32,16) DEFAULT 0.0000000000000000,
  `HB_Group3_residue0` decimal(32,16) DEFAULT 0.0000000000000000,
  `AGG` decimal(32,16) DEFAULT 0.0000000000000000,
  `AMYLO` decimal(32,16) DEFAULT 0.0000000000000000,
  `TURN` decimal(32,16) DEFAULT 0.0000000000000000,
  `HELIX` decimal(32,16) DEFAULT 0.0000000000000000,
  `HELAGG` varchar(255) DEFAULT '0',
  `BETA` decimal(32,16) DEFAULT 0.0000000000000000,
  PRIMARY KEY (`Family_ID`) USING BTREE,
  UNIQUE KEY `Family_ID` (`Family_ID`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4683 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of family_avg_feature
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for family_std_feature
-- ----------------------------
DROP TABLE IF EXISTS `family_std_feature`;
CREATE TABLE `family_std_feature` (
  `Family_ID` varchar(16) NOT NULL,
  `tinyAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `smallAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `aliphaticAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `aromaticAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `nonpolarAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `polarAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `chargedAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `basicAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `acidicAA` decimal(32,16) DEFAULT 0.0000000000000000,
  `charge` decimal(32,16) DEFAULT 0.0000000000000000,
  `pI` decimal(32,16) DEFAULT 0.0000000000000000,
  `aindex` decimal(32,16) DEFAULT 0.0000000000000000,
  `instaindex` decimal(32,16) DEFAULT 0.0000000000000000,
  `boman` decimal(32,16) DEFAULT 0.0000000000000000,
  `hydrophobicity` decimal(32,16) DEFAULT 0.0000000000000000,
  `hmoment` decimal(32,16) DEFAULT 0.0000000000000000,
  `SA_Group1_residue0` decimal(32,16) DEFAULT 0.0000000000000000,
  `SA_Group2_residue0` decimal(32,16) DEFAULT 0.0000000000000000,
  `SA_Group3_residue0` decimal(32,16) DEFAULT 0.0000000000000000,
  `HB_Group1_residue0` decimal(32,16) DEFAULT 0.0000000000000000,
  `HB_Group2_residue0` decimal(32,16) DEFAULT 0.0000000000000000,
  `HB_Group3_residue0` decimal(32,16) DEFAULT 0.0000000000000000,
  `AGG` decimal(32,16) DEFAULT 0.0000000000000000,
  `AMYLO` decimal(32,16) DEFAULT 0.0000000000000000,
  `TURN` decimal(32,16) DEFAULT 0.0000000000000000,
  `HELIX` decimal(32,16) DEFAULT 0.0000000000000000,
  `HELAGG` varchar(255) DEFAULT '0',
  `BETA` decimal(32,16) DEFAULT 0.0000000000000000,
  PRIMARY KEY (`Family_ID`) USING BTREE,
  UNIQUE KEY `Family_ID` (`Family_ID`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4683 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of family_std_feature
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for hmmer_db
-- ----------------------------
DROP TABLE IF EXISTS `hmmer_db`;
CREATE TABLE `hmmer_db` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `times` int(10) unsigned NOT NULL DEFAULT 0,
  `time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `name` (`name`(250)) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of hmmer_db
-- ----------------------------
BEGIN;
INSERT INTO `hmmer_db` VALUES (1, 'GAF.hmm', 0, '2020-09-06 02:35:51');
COMMIT;

-- ----------------------------
-- Table structure for hmmer_log
-- ----------------------------
DROP TABLE IF EXISTS `hmmer_log`;
CREATE TABLE `hmmer_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL,
  `directory` varchar(255) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of hmmer_log
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for visit_log
-- ----------------------------
DROP TABLE IF EXISTS `visit_log`;
CREATE TABLE `visit_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of visit_log
-- ----------------------------
BEGIN;
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
