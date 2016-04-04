-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 04, 2016 at 06:45 PM
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
  KEY `applicant` (`login_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`login_id`, `applicant_id`, `selectedcourses_id`, `fname`, `sname`, `email`, `gcsetaken13`, `gcsetaken12`, `gcsetaken11`, `gcsetaken10`, `gcsetaken9`, `gcsetaken8`, `gcsetaken7`, `gcsetaken6`, `gcsetaken5`, `gcsetaken4`, `gcsetaken3`, `gcsetaken2`, `gcsetaken1`, `gender`, `uln`, `uci`, `postcode`, `telnumber`, `mobilenumber`, `year11school`, `year11schoolpostcode`, `year11completed`, `highdownstudent`, `parentcarerfname`, `parentcarersname`, `parentcarerpostcode`, `parentcarertelnumber`, `parentcarermobilenumber`, `contact2fname`, `contact2sname`, `contact2postcode`, `contact2telnumber`, `contact2mobilenumber`, `studentcourseinterest`, `entryrequirementsknown`, `specialrequirements`, `interviewnotes`, `subjectchoice`, `enrichment`, `tutoremail`, `studentachievements`, `learningneeds`, `learningneedsdetails`, `learningsupport`, `learningsupportdetails`, `statemented`, `statementeddetails`, `specialconsiderations`, `specialconsiderationsdetails`, `freeschoolmeals`, `fnameoftutor`, `snameoftutor`, `predictedoractualqualifications`, `tutorauthenticator`) VALUES
(3, 3, 1, 'ermal', 'laci', 'laciermal@gmail.com', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 'male', '', '', '', '', '', '', '', 0000, b'0', '', '', '', '', '', '', '', '', '', '', b'0', b'0', '', '', 0, '', 'laciermal98@gmail.com', 'should work', b'1', 'ggewg', b'1', 'gewg', b'1', 'gerg', b'1', 'her', b'1', 'hgrh', 'hrhhh', b'1', 'hey'),
(6, 5, 0, 'test1f', 'test1s', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'male', '', '', '', '', '', '', '', 2014, b'1', '', '', '', '', '', '', '', '', '', '', b'0', b'0', '', '', 0, '', '', '', b'0', '', b'0', '', b'0', '', b'0', '', b'0', '', '', b'0', 'g4kh7cP8eCwBzf2toapV');

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

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`grade_id`, `subject_id`, `predicted_grade`, `mock_result`, `actual_result`, `year_taken`) VALUES
(1, 1, 'A*', 'A*', 'A*', 2015),
(2, 2, 'C', 'A', 'A', 2015),
(3, 3, 'A*', 'A', 'B', 2015),
(4, 4, 'B', 'F', 'D', 2015),
(5, 5, 'C', 'B', 'B', 2015),
(6, 6, 'D', 'B', 'D', 2015),
(7, 7, 'B', 'B', 'A', 2015),
(8, 8, 'B', 'A*', 'A*', 2015),
(9, 9, 'C', 'D', 'C', 2015),
(10, 10, 'B', 'A*', 'B', 2015),
(11, 11, 'E', 'E', 'E', 2015),
(12, 12, 'D', 'C', 'E', 2015),
(13, 13, 'E', 'B', 'D', 2015);

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

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `username`, `password`, `type`) VALUES
(3, 'elaci', 'pass', 'applicant'),
(4, 'admin', 'adminpass', 'admin'),
(5, 'ttest1s', 'lZyGEWDse1KgBjwM3TJb', 'applicant'),
(6, 'ttest1s2', 'XIuEBHR4vD81n2a6SsAr', 'applicant');

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

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `information`, `nameofinformation`) VALUES
(7, '<h3 style=''color: red''> fef </h3>', 'admin - html');

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

--
-- Dumping data for table `recipient`
--

INSERT INTO `recipient` (`login_id`, `news_id`) VALUES
(3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `selected courses`
--

CREATE TABLE IF NOT EXISTS `selected courses` (
  `selectedcourse_id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) DEFAULT NULL,
  `block_a` int(11) DEFAULT NULL,
  `block_b` int(11) DEFAULT NULL,
  `block_c` int(11) DEFAULT NULL,
  `block_d` int(11) DEFAULT NULL,
  `block_e` int(11) DEFAULT NULL,
  `courses_reasons` text NOT NULL,
  PRIMARY KEY (`selectedcourse_id`),
  KEY `applicant_id` (`applicant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `selected courses`
--

INSERT INTO `selected courses` (`selectedcourse_id`, `applicant_id`, `block_a`, `block_b`, `block_c`, `block_d`, `block_e`, `courses_reasons`) VALUES
(1, 3, 1, 2, 3, 4, 5, 'I want to');

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

--
-- Dumping data for table `sixth form subject`
--

INSERT INTO `sixth form subject` (`sixthformsubject_id`, `name`, `level`, `block`) VALUES
(1, 'Maths', 'A Level', 'A'),
(2, 'English', 'A Level', 'B'),
(3, 'ICT', 'A Level', 'C'),
(4, 'Economics', 'A Level', 'D'),
(5, 'Computing', 'A Level', 'E');

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

--
-- Dumping data for table `storedinformation`
--

INSERT INTO `storedinformation` (`dataid`, `name`, `type`, `length`, `display`) VALUES
(12, 'fname', 'VARCHAR', '25', 'First Name:'),
(13, 'sname', 'VARCHAR', '25', 'Surname:'),
(14, 'email', 'VARCHAR', '25', 'Email:'),
(15, 'gender', 'ENUM', 'male,female', 'Gender:'),
(17, 'uln', 'VARCHAR', '10', 'Unique Learner Number:'),
(18, 'uci', 'VARCHAR', '13', 'Unique Candidate Identifier:'),
(19, 'postcode', 'VARCHAR', '7', 'Postcode:'),
(20, 'telnumber', 'VARCHAR', '11', 'Telephone Number:'),
(21, 'mobilenumber', 'VARCHAR', '11', 'Mobile Number:'),
(22, 'year11completed', 'YEAR', '2014-2016', 'Year in which you will complete (or have completed) Year 11:'),
(23, 'year11school', 'VARCHAR', '25', 'School attended in Year 11:'),
(24, 'year11schoolpostcode', 'VARCHAR', '7', 'Year 11 School Postcode:'),
(25, 'highdownstudent', 'BIT', '1', 'Have you previously been a student at Highdown School?'),
(26, 'parentcarerfname', 'VARCHAR', '25', 'First Name Of Parent/Carer:'),
(27, 'parentcarersname', 'VARCHAR', '25', 'Surname Of Parent/Carer:'),
(28, 'parentcarerpostcode', 'VARCHAR', '7', 'Parent/Carer Postcode:'),
(29, 'parentcarertelnumber', 'VARCHAR', '11', 'Parent/Carer Telephone Number:'),
(30, 'parentcarermobilenumber', 'VARCHAR', '11', 'Parent/Carer Mobile Number:'),
(31, 'contact2fname', 'VARCHAR', '25', 'Emergency Contact 2 First Name:'),
(32, 'contact2sname', 'VARCHAR', '25', 'Emergency Contact 2 Surname:'),
(33, 'contact2postcode', 'VARCHAR', '7', 'Emergency Contact 2 Postcode:'),
(34, 'contact2telnumber', 'VARCHAR', '11', 'Emergency Contact 2 Telephone Number:'),
(35, 'contact2mobilenumber', 'VARCHAR', '11', 'Emergency Contact 2 Mobile Number:'),
(36, 'tutoremail', 'VARCHAR', '25', 'Tutor Email:');

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

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `name`, `exam_board`) VALUES
(1, 'Maths', 'AQA'),
(2, 'English', 'AQA'),
(3, 'History', 'AQA'),
(4, 'Geography', 'AQA'),
(5, 'Further Maths', 'AQA'),
(6, 'ICT', 'AQA'),
(7, 'Computing', 'OCR'),
(8, 'P.E', 'AQA'),
(9, 'Physics', 'AQA'),
(10, 'Chemistry', 'AQA'),
(11, 'Biology', 'AQA'),
(12, 'Art Graphics', 'AQA'),
(13, 'Fine Art', 'AQA'),
(14, 'Drama', 'AQA');

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
  ADD CONSTRAINT `applicant_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `selected courses`
--
ALTER TABLE `selected courses`
  ADD CONSTRAINT `selected courses_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicant` (`applicant_id`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
