-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 08, 2016 at 02:01 AM
-- Server version: 5.6.12
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sixthformapplication`
--
CREATE DATABASE IF NOT EXISTS `sixthformapplication` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sixthformapplication`;

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE IF NOT EXISTS `applicant` (
  `login_id` int(11) DEFAULT NULL,
  `applicant_id` int(11) NOT NULL AUTO_INCREMENT,
  `selectedcourses_id` int(11) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `sname` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gcsetaken13` int(11) NOT NULL,
  `gcsetaken12` int(11) NOT NULL,
  `gcsetaken11` int(11) NOT NULL,
  `gcsetaken10` int(11) NOT NULL,
  `gcsetaken9` int(11) NOT NULL,
  `gcsetaken8` int(11) NOT NULL,
  `gcsetaken7` int(11) NOT NULL,
  `gcsetaken6` int(11) NOT NULL,
  `gcsetaken5` int(11) NOT NULL,
  `gcsetaken4` int(11) NOT NULL,
  `gcsetaken3` int(11) NOT NULL,
  `gcsetaken2` int(11) NOT NULL,
  `gcsetaken1` int(11) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `uln` varchar(10) NOT NULL,
  `uci` varchar(13) NOT NULL,
  `postcode` varchar(7) NOT NULL,
  `telnumber` varchar(11) NOT NULL,
  `mobilenumber` varchar(11) NOT NULL,
  `year11school` varchar(25) NOT NULL,
  `year11schoolpostcode` varchar(7) NOT NULL,
  `year11completed` year(4) NOT NULL,
  `highdownstudent` bit(1) NOT NULL,
  `parentcarerfname` varchar(25) NOT NULL,
  `parentcarersname` varchar(25) NOT NULL,
  `parentcarerpostcode` varchar(7) NOT NULL,
  `parentcarertelnumber` varchar(11) NOT NULL,
  `parentcarermobilenumber` varchar(11) NOT NULL,
  `contact2fname` varchar(25) NOT NULL,
  `contact2sname` varchar(25) NOT NULL,
  `contact2postcode` varchar(7) NOT NULL,
  `contact2telnumber` varchar(11) NOT NULL,
  `contact2mobilenumber` varchar(11) NOT NULL,
  `studentcourseinterest` bit(1) NOT NULL,
  `entryrequirementsknown` bit(1) NOT NULL,
  `specialrequirements` text NOT NULL,
  `interviewnotes` text NOT NULL,
  `subjectchoice` int(11) NOT NULL,
  `enrichment` text NOT NULL,
  `tutoremail` varchar(50) NOT NULL,
  `studentachievements` text NOT NULL,
  `learningneeds` bit(1) NOT NULL,
  `learningneedsdetails` text NOT NULL,
  `learningsupport` bit(1) NOT NULL,
  `learningsupportdetails` text NOT NULL,
  `statemented` bit(1) NOT NULL,
  `statementeddetails` text NOT NULL,
  `specialconsiderations` bit(1) NOT NULL,
  `specialconsiderationsdetails` text NOT NULL,
  `freeschoolmeals` bit(1) NOT NULL,
  `fnameoftutor` varchar(25) NOT NULL,
  `snameoftutor` varchar(25) NOT NULL,
  `predictedoractualqualifications` bit(1) NOT NULL,
  `tutorauthenticator` varchar(20) NOT NULL,
  PRIMARY KEY (`applicant_id`),
  UNIQUE KEY `email` (`email`),
  KEY `applicant` (`login_id`),
  KEY `selectedcourse_id` (`selectedcourses_id`),
  KEY `gcsetaken13` (`gcsetaken13`),
  KEY `gcsetaken12` (`gcsetaken12`),
  KEY `gcsetaken11` (`gcsetaken11`),
  KEY `gcsetaken10` (`gcsetaken10`),
  KEY `gcsetaken9` (`gcsetaken9`),
  KEY `gcsetaken8` (`gcsetaken8`),
  KEY `gcsetaken7` (`gcsetaken7`),
  KEY `gcsetaken6` (`gcsetaken6`),
  KEY `gcsetaken5` (`gcsetaken5`),
  KEY `gcsetaken4` (`gcsetaken4`),
  KEY `gcsetaken3` (`gcsetaken3`),
  KEY `gcsetaken2` (`gcsetaken2`),
  KEY `gcsetaken1` (`gcsetaken1`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE IF NOT EXISTS `grades` (
  `grade_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) DEFAULT NULL,
  `predicted_grade` enum('A*','A','B','C','D','E','F','G','U') NOT NULL,
  `mock_result` enum('A*','A','B','C','D','E','F','G','U') NOT NULL,
  `actual_result` enum('A*','A','B','C','D','E','F','G','U') NOT NULL,
  `year_taken` year(4) NOT NULL,
  PRIMARY KEY (`grade_id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `type` enum('admin','teacher','applicant') DEFAULT NULL,
  PRIMARY KEY (`login_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `information` text,
  `nameofinformation` varchar(50) NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `recipient`
--

CREATE TABLE IF NOT EXISTS `recipient` (
  `login_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  PRIMARY KEY (`login_id`,`news_id`),
  KEY `news_id` (`news_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `selected courses`
--

CREATE TABLE IF NOT EXISTS `selected courses` (
  `selectedcourse_id` int(11) NOT NULL AUTO_INCREMENT,
  `block_a` int(11) DEFAULT NULL,
  `block_b` int(11) DEFAULT NULL,
  `block_c` int(11) DEFAULT NULL,
  `block_d` int(11) DEFAULT NULL,
  `block_e` int(11) DEFAULT NULL,
  `courses_reasons` text NOT NULL,
  PRIMARY KEY (`selectedcourse_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `sixth form subject`
--

CREATE TABLE IF NOT EXISTS `sixth form subject` (
  `sixthformsubject_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) DEFAULT NULL,
  `level` enum('A Level','Level 2') DEFAULT NULL,
  `block` set('A','B','C','D','E') DEFAULT NULL,
  PRIMARY KEY (`sixthformsubject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `storedinformation`
--

CREATE TABLE IF NOT EXISTS `storedinformation` (
  `dataid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `type` enum('VARCHAR','ENUM','SET','INT','TEXT','BIT','YEAR') NOT NULL,
  `length` varchar(50) NOT NULL,
  `display` varchar(60) NOT NULL,
  PRIMARY KEY (`dataid`),
  UNIQUE KEY `display` (`display`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `exam_board` enum('AQA','OCR','EDEXCEL') DEFAULT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(25) DEFAULT NULL,
  `sname` varchar(25) DEFAULT NULL,
  `department` set('Maths','English') DEFAULT NULL,
  `login_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`teacher_id`),
  KEY `login_id` (`login_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicant`
--
ALTER TABLE `applicant`
  ADD CONSTRAINT `applicant_ibfk_15` FOREIGN KEY (`gcsetaken1`) REFERENCES `grades` (`grade_id`),
  ADD CONSTRAINT `applicant_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applicant_ibfk_10` FOREIGN KEY (`gcsetaken6`) REFERENCES `grades` (`grade_id`),
  ADD CONSTRAINT `applicant_ibfk_11` FOREIGN KEY (`gcsetaken5`) REFERENCES `grades` (`grade_id`),
  ADD CONSTRAINT `applicant_ibfk_12` FOREIGN KEY (`gcsetaken4`) REFERENCES `grades` (`grade_id`),
  ADD CONSTRAINT `applicant_ibfk_13` FOREIGN KEY (`gcsetaken3`) REFERENCES `grades` (`grade_id`),
  ADD CONSTRAINT `applicant_ibfk_14` FOREIGN KEY (`gcsetaken2`) REFERENCES `grades` (`grade_id`),
  ADD CONSTRAINT `applicant_ibfk_2` FOREIGN KEY (`selectedcourses_id`) REFERENCES `selected courses` (`selectedcourse_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `applicant_ibfk_3` FOREIGN KEY (`gcsetaken13`) REFERENCES `grades` (`grade_id`),
  ADD CONSTRAINT `applicant_ibfk_4` FOREIGN KEY (`gcsetaken12`) REFERENCES `grades` (`grade_id`),
  ADD CONSTRAINT `applicant_ibfk_5` FOREIGN KEY (`gcsetaken11`) REFERENCES `grades` (`grade_id`),
  ADD CONSTRAINT `applicant_ibfk_6` FOREIGN KEY (`gcsetaken10`) REFERENCES `grades` (`grade_id`),
  ADD CONSTRAINT `applicant_ibfk_7` FOREIGN KEY (`gcsetaken9`) REFERENCES `grades` (`grade_id`),
  ADD CONSTRAINT `applicant_ibfk_8` FOREIGN KEY (`gcsetaken8`) REFERENCES `grades` (`grade_id`),
  ADD CONSTRAINT `applicant_ibfk_9` FOREIGN KEY (`gcsetaken7`) REFERENCES `grades` (`grade_id`);

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE;

--
-- Constraints for table `recipient`
--
ALTER TABLE `recipient`
  ADD CONSTRAINT `recipient_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recipient_ibfk_2` FOREIGN KEY (`news_id`) REFERENCES `news` (`news_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
