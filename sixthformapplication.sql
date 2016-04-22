-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2016 at 08:46 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sixthformapplication`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE `applicant` (
  `login_id` int(11) DEFAULT NULL,
  `applicant_id` int(11) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `sname` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `uln` varchar(10) NOT NULL,
  `uci` varchar(13) NOT NULL,
  `addressline1` varchar(30) NOT NULL,
  `addressline2` varchar(30) NOT NULL,
  `postcode` varchar(7) NOT NULL,
  `telnumber` varchar(11) NOT NULL,
  `mobilenumber` varchar(11) NOT NULL,
  `year11school` varchar(25) NOT NULL,
  `schooladdressline1` varchar(30) NOT NULL,
  `schooladdressline2` varchar(30) NOT NULL,
  `year11schoolpostcode` varchar(7) NOT NULL,
  `year11completed` year(4) NOT NULL,
  `highdownstudent` bit(1) NOT NULL,
  `parentcarerfname` varchar(25) NOT NULL,
  `parentcarersname` varchar(25) NOT NULL,
  `parentcareraddressline1` varchar(30) NOT NULL,
  `parentcareraddressline2` varchar(30) NOT NULL,
  `parentcarerpostcode` varchar(7) NOT NULL,
  `parentcarertelnumber` varchar(11) NOT NULL,
  `parentcarermobilenumber` varchar(11) NOT NULL,
  `contact2fname` varchar(25) NOT NULL,
  `contact2sname` varchar(25) NOT NULL,
  `contact2addressline1` varchar(30) NOT NULL,
  `contact2addressline2` varchar(30) NOT NULL,
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
  `selectedcourses_id` int(11) NOT NULL,
  `accepted` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`login_id`, `applicant_id`, `fname`, `sname`, `email`, `gender`, `uln`, `uci`, `addressline1`, `addressline2`, `postcode`, `telnumber`, `mobilenumber`, `year11school`, `schooladdressline1`, `schooladdressline2`, `year11schoolpostcode`, `year11completed`, `highdownstudent`, `parentcarerfname`, `parentcarersname`, `parentcareraddressline1`, `parentcareraddressline2`, `parentcarerpostcode`, `parentcarertelnumber`, `parentcarermobilenumber`, `contact2fname`, `contact2sname`, `contact2addressline1`, `contact2addressline2`, `contact2postcode`, `contact2telnumber`, `contact2mobilenumber`, `studentcourseinterest`, `entryrequirementsknown`, `specialrequirements`, `interviewnotes`, `subjectchoice`, `enrichment`, `tutoremail`, `studentachievements`, `learningneeds`, `learningneedsdetails`, `learningsupport`, `learningsupportdetails`, `statemented`, `statementeddetails`, `specialconsiderations`, `specialconsiderationsdetails`, `freeschoolmeals`, `fnameoftutor`, `snameoftutor`, `predictedoractualqualifications`, `tutorauthenticator`, `selectedcourses_id`, `accepted`) VALUES
(3, 1, 'Ermal', 'Laci', 'laciermal98@gmail.com', 'male', '', '', '', '', '', '', '', '', '', '', '', 2014, b'1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', b'1', b'0', '', '', 0, '', 'undefinedhawk@googlemail.com', 'loads', b'0', '', b'0', '', b'0', '', b'0', '', b'0', '', '', b'1', '7Rge46fiCLEp8AuVYB3N', 1, b'0'),
(4, 2, 'Erion', 'Laci', 'undefinedhawk@live.co.uk', 'male', '', '', '', '', '', '', '', '', '', '', '', 2014, b'1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', b'0', b'0', '', '', 0, '', 'laciermal98@gmail.com', '', b'0', '', b'0', '', b'0', '', b'0', '', b'0', '', '', b'0', 'oim2nxB7HfjOEe85gUFh', 2, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `grade_id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `predicted_grade` enum('A*','A','B','C','D','E','F','G','U') NOT NULL,
  `mock_result` enum('A*','A','B','C','D','E','F','G','U') NOT NULL,
  `actual_result` enum('A*','A','B','C','D','E','F','G','U') NOT NULL,
  `year_taken` year(4) NOT NULL,
  `applicant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`grade_id`, `subject_id`, `predicted_grade`, `mock_result`, `actual_result`, `year_taken`, `applicant_id`) VALUES
(1, 1, 'A', 'A', 'A', 2015, 1),
(2, 2, 'A*', 'B', 'C', 2015, 1),
(3, 1, 'B', 'C', 'D', 2015, 2),
(4, 2, 'A', 'A', 'A', 2015, 2);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `type` enum('admin','teacher','applicant') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `username`, `password`, `type`) VALUES
(2, 'admin', 'adminpass', 'admin'),
(3, 'ELaci', 'vjA0WXmydgFTLf1xM8JN', 'applicant'),
(4, 'ELaci2', 'PLBU7Wh9EAZ6bweQoiap', 'applicant');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `information` text,
  `nameofinformation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recipient`
--

CREATE TABLE `recipient` (
  `login_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `selected courses`
--

CREATE TABLE `selected courses` (
  `selectedcourse_id` int(11) NOT NULL,
  `block_a` int(11) DEFAULT NULL,
  `block_b` int(11) DEFAULT NULL,
  `block_c` int(11) DEFAULT NULL,
  `block_d` int(11) DEFAULT NULL,
  `block_e` int(11) DEFAULT NULL,
  `level2_block` int(11) DEFAULT NULL,
  `courses_reasons` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `selected courses`
--

INSERT INTO `selected courses` (`selectedcourse_id`, `block_a`, `block_b`, `block_c`, `block_d`, `block_e`, `level2_block`, `courses_reasons`) VALUES
(1, 1, 3, 8, 9, 12, NULL, 'Want'),
(2, 2, 4, 7, 9, 12, NULL, 've');

-- --------------------------------------------------------

--
-- Table structure for table `sixth form subject`
--

CREATE TABLE `sixth form subject` (
  `sixthformsubject_id` int(11) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `level` enum('A Level','Level 2') DEFAULT NULL,
  `block` enum('A','B','C','D','E') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sixth form subject`
--

INSERT INTO `sixth form subject` (`sixthformsubject_id`, `name`, `level`, `block`) VALUES
(1, 'Maths', 'A Level', 'A'),
(2, 'English', 'A Level', 'A'),
(3, 'Physics', 'A Level', 'B'),
(4, 'Biology', 'A Level', 'B'),
(5, 'Government Politics', 'A Level', 'B'),
(6, 'Sociology', 'A Level', 'B'),
(7, 'Physics', 'A Level', 'C'),
(8, 'Computing', 'A Level', 'C'),
(9, 'ICT', 'A Level', 'D'),
(10, 'Computing', 'A Level', 'D'),
(11, 'Further Maths', 'A Level', 'E'),
(12, 'Art', 'A Level', 'E'),
(13, 'Maths', 'Level 2', NULL),
(14, 'English', 'Level 2', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `storedinformation`
--

CREATE TABLE `storedinformation` (
  `dataid` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `type` enum('VARCHAR','ENUM','INT','TEXT','BIT','YEAR') NOT NULL,
  `length` varchar(50) NOT NULL,
  `display` varchar(60) NOT NULL,
  `validate` enum('postcode','email','numeric','name','none') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `storedinformation`
--

INSERT INTO `storedinformation` (`dataid`, `name`, `type`, `length`, `display`, `validate`) VALUES
(12, 'fname', 'VARCHAR', '25', 'First Name:', 'name'),
(13, 'sname', 'VARCHAR', '25', 'Surname:', 'name'),
(14, 'email', 'VARCHAR', '25', 'Email:', 'email'),
(15, 'gender', 'ENUM', 'male,female', 'Gender:', 'none'),
(17, 'uln', 'VARCHAR', '10', 'Unique Learner Number:', 'numeric'),
(18, 'uci', 'VARCHAR', '13', 'Unique Candidate Identifier:', 'numeric'),
(19, 'addressline1', 'VARCHAR', '30', 'Address:', 'none'),
(20, 'addressline2', 'VARCHAR', '30', 'Address line 2:', 'none'),
(21, 'postcode', 'VARCHAR', '7', 'Postcode:', 'postcode'),
(22, 'telnumber', 'VARCHAR', '11', 'Telephone Number:', 'numeric'),
(23, 'mobilenumber', 'VARCHAR', '11', 'Mobile Number:', 'numeric'),
(24, 'year11completed', 'YEAR', '2014-2016', 'Year in which you will complete (or have completed) Year 11:', 'none'),
(25, 'year11school', 'VARCHAR', '25', 'School attended in Year 11:', 'none'),
(26, 'schooladdressline1', 'VARCHAR', '30', 'Year 11 School Address:', 'none'),
(27, 'schooladdressline2', 'VARCHAR', '30', 'Year 11 School Address line 2:', 'none'),
(28, 'year11schoolpostcode', 'VARCHAR', '7', 'Year 11 School Postcode:', 'postcode'),
(29, 'highdownstudent', 'BIT', '1', 'Have you previously been a student at Highdown School?', 'none'),
(30, 'parentcarerfname', 'VARCHAR', '25', 'First Name Of Parent/Carer:', 'name'),
(31, 'parentcarersname', 'VARCHAR', '25', 'Surname Of Parent/Carer:', 'name'),
(32, 'parentcareraddressline1', 'VARCHAR', '30', 'Parent/Carer Address:', 'none'),
(33, 'parentcareraddressline2', 'VARCHAR', '30', 'Parent/Carer Address line 2:', 'none'),
(34, 'parentcarerpostcode', 'VARCHAR', '7', 'Parent/Carer Postcode:', 'postcode'),
(35, 'parentcarertelnumber', 'VARCHAR', '11', 'Parent/Carer Telephone Number:', 'numeric'),
(36, 'parentcarermobilenumber', 'VARCHAR', '11', 'Parent/Carer Mobile Number:', 'numeric'),
(37, 'contact2fname', 'VARCHAR', '25', 'Emergency Contact 2 First Name:', 'none'),
(38, 'contact2sname', 'VARCHAR', '25', 'Emergency Contact 2 Surname:', 'name'),
(39, 'contact2addressline1', 'VARCHAR', '30', 'Emergency contact 2 Address:', 'none'),
(40, 'contact2addressline2', 'VARCHAR', '30', 'Emergency contact 2 Address line 2:', 'none'),
(41, 'contact2postcode', 'VARCHAR', '7', 'Emergency Contact 2 Postcode:', 'postcode'),
(42, 'contact2telnumber', 'VARCHAR', '11', 'Emergency Contact 2 Telephone Number:', 'numeric'),
(43, 'contact2mobilenumber', 'VARCHAR', '11', 'Emergency Contact 2 Mobile Number:', 'numeric'),
(44, 'tutoremail', 'VARCHAR', '25', 'Tutor Email:', 'email');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `exam_board` enum('AQA','OCR','EDEXCEL') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(7, 'Computing', 'AQA'),
(8, 'P.E', 'AQA'),
(9, 'Physics', 'AQA'),
(10, 'Chemistry', 'AQA'),
(11, 'Biology', 'AQA'),
(12, 'Art Graphics', 'AQA'),
(13, 'Fine Art', 'AQA'),
(14, 'Drama', 'AQA'),
(15, 'Maths', 'OCR'),
(16, 'English', 'OCR'),
(17, 'History', 'OCR'),
(18, 'Geography', 'OCR'),
(19, 'Further Maths', 'OCR'),
(20, 'ICT', 'OCR'),
(21, 'Computing', 'OCR'),
(22, 'P.E', 'OCR'),
(23, 'Physics', 'OCR'),
(24, 'Chemistry', 'OCR'),
(25, 'Biology', 'OCR'),
(26, 'Art Graphics', 'OCR'),
(27, 'Fine Art', 'OCR'),
(28, 'Drama', 'OCR'),
(29, 'No Subject', NULL),
(30, 'No Subject', NULL),
(31, 'No Subject', 'AQA');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(11) NOT NULL,
  `fname` varchar(25) DEFAULT NULL,
  `sname` varchar(25) DEFAULT NULL,
  `department` set('Maths','English') DEFAULT NULL,
  `login_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicant`
--
ALTER TABLE `applicant`
  ADD PRIMARY KEY (`applicant_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `selectedcourses_id` (`selectedcourses_id`),
  ADD KEY `applicant` (`login_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grade_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `applicant_id` (`applicant_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `recipient`
--
ALTER TABLE `recipient`
  ADD PRIMARY KEY (`login_id`,`news_id`),
  ADD KEY `news_id` (`news_id`);

--
-- Indexes for table `selected courses`
--
ALTER TABLE `selected courses`
  ADD PRIMARY KEY (`selectedcourse_id`),
  ADD KEY `level2_block` (`level2_block`),
  ADD KEY `block_a` (`block_a`) USING BTREE,
  ADD KEY `block_b` (`block_b`) USING BTREE,
  ADD KEY `block_c` (`block_c`) USING BTREE,
  ADD KEY `block_d` (`block_d`) USING BTREE,
  ADD KEY `block_e` (`block_e`) USING BTREE;

--
-- Indexes for table `sixth form subject`
--
ALTER TABLE `sixth form subject`
  ADD PRIMARY KEY (`sixthformsubject_id`);

--
-- Indexes for table `storedinformation`
--
ALTER TABLE `storedinformation`
  ADD PRIMARY KEY (`dataid`),
  ADD UNIQUE KEY `display` (`display`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`),
  ADD KEY `login_id` (`login_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicant`
--
ALTER TABLE `applicant`
  MODIFY `applicant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `selected courses`
--
ALTER TABLE `selected courses`
  MODIFY `selectedcourse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sixth form subject`
--
ALTER TABLE `sixth form subject`
  MODIFY `sixthformsubject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `storedinformation`
--
ALTER TABLE `storedinformation`
  MODIFY `dataid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicant`
--
ALTER TABLE `applicant`
  ADD CONSTRAINT `applicant_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applicant_ibfk_2` FOREIGN KEY (`selectedcourses_id`) REFERENCES `selected courses` (`selectedcourse_id`);

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
  ADD CONSTRAINT `selected courses_ibfk_1` FOREIGN KEY (`block_a`) REFERENCES `sixth form subject` (`sixthformsubject_id`),
  ADD CONSTRAINT `selected courses_ibfk_2` FOREIGN KEY (`block_b`) REFERENCES `sixth form subject` (`sixthformsubject_id`),
  ADD CONSTRAINT `selected courses_ibfk_3` FOREIGN KEY (`block_c`) REFERENCES `sixth form subject` (`sixthformsubject_id`),
  ADD CONSTRAINT `selected courses_ibfk_4` FOREIGN KEY (`block_d`) REFERENCES `sixth form subject` (`sixthformsubject_id`),
  ADD CONSTRAINT `selected courses_ibfk_5` FOREIGN KEY (`block_e`) REFERENCES `sixth form subject` (`sixthformsubject_id`),
  ADD CONSTRAINT `selected courses_ibfk_6` FOREIGN KEY (`level2_block`) REFERENCES `sixth form subject` (`sixthformsubject_id`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
