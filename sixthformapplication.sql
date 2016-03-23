-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2016 at 09:46 PM
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
  `enrichment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`login_id`, `applicant_id`, `selectedcourses_id`, `fname`, `sname`, `email`, `gcsetaken13`, `gcsetaken12`, `gcsetaken11`, `gcsetaken10`, `gcsetaken9`, `gcsetaken8`, `gcsetaken7`, `gcsetaken6`, `gcsetaken5`, `gcsetaken4`, `gcsetaken3`, `gcsetaken2`, `gcsetaken1`, `gender`, `uln`, `uci`, `postcode`, `telnumber`, `mobilenumber`, `year11school`, `year11schoolpostcode`, `highdownstudent`, `parentcarerfname`, `parentcarersname`, `parentcarerpostcode`, `parentcarertelnumber`, `parentcarermobilenumber`, `contact2fname`, `contact2sname`, `contact2postcode`, `contact2telnumber`, `contact2mobilenumber`, `studentcourseinterest`, `entryrequirementsknown`, `specialrequirements`, `interviewnotes`, `subjectchoice`, `enrichment`) VALUES
(3, 3, 1, 'ermal', 'laci', 'laciermal98@gmail.com', 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'male', '', '', '', '', '', '', '', b'0', '', '', '', '', '', '', '', '', '', '', b'0', b'0', '', '', 0, ''),
(5, 4, 1, 'erion', 'laci', 'undefinedhawk@googlemail.com', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'male', '', '', '', '', '', '', '', b'0', '', '', '', '', '', '', '', '', '', '', b'0', b'0', '', '', 0, '');

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
  `year_taken` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`grade_id`, `subject_id`, `predicted_grade`, `mock_result`, `actual_result`, `year_taken`) VALUES
(1, 1, 'A*', 'A*', 'A*', 2015),
(2, 2, 'C', 'A', 'A', 2015);

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
(3, 'elaci', 'pass', 'applicant'),
(4, 'admin', 'adminpass', 'admin'),
(5, 'elaci3', 'bpunUYLBNx', 'applicant');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `information` text,
  `nameofinformation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `information`, `nameofinformation`) VALUES
(7, '<h3 style=''color: red''> fef </h3>', 'admin - html');

-- --------------------------------------------------------

--
-- Table structure for table `recipient`
--

CREATE TABLE `recipient` (
  `login_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL
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

CREATE TABLE `selected courses` (
  `selectedcourse_id` int(11) NOT NULL,
  `applicant_id` int(11) DEFAULT NULL,
  `block_a` int(11) DEFAULT NULL,
  `block_b` int(11) DEFAULT NULL,
  `block_c` int(11) DEFAULT NULL,
  `block_d` int(11) DEFAULT NULL,
  `block_e` int(11) DEFAULT NULL,
  `courses_reasons` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `selected courses`
--

INSERT INTO `selected courses` (`selectedcourse_id`, `applicant_id`, `block_a`, `block_b`, `block_c`, `block_d`, `block_e`, `courses_reasons`) VALUES
(1, 3, 1, 2, 3, 4, 5, 'want to');

-- --------------------------------------------------------

--
-- Table structure for table `sixth form subject`
--

CREATE TABLE `sixth form subject` (
  `sixthformsubject_id` int(11) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `level` enum('A Level','Level 2') DEFAULT NULL,
  `block` set('A','B','C','D','E') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `storedinformation` (
  `dataid` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `type` enum('VARCHAR','ENUM','SET','INT','TEXT','BIT','YEAR') NOT NULL,
  `length` varchar(50) NOT NULL,
  `display` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `storedinformation`
--

INSERT INTO `storedinformation` (`dataid`, `name`, `type`, `length`, `display`) VALUES
(12, 'fname', 'VARCHAR', '25', 'First Name:'),
(13, 'sname', 'VARCHAR', '25', 'Surname:'),
(14, 'email', 'VARCHAR', '25', 'Email:'),
(15, 'gender', 'ENUM', '', 'Gender:'),
(17, 'uln', 'VARCHAR', '10', 'Unique Learner Number:'),
(18, 'uci', 'VARCHAR', '13', 'Unique Candidate Identifier:'),
(19, 'postcode', 'VARCHAR', '7', 'Postcode:'),
(20, 'telnumber', 'VARCHAR', '11', 'Telephone Number:'),
(21, 'mobilenumber', 'VARCHAR', '11', 'Mobile Number:'),
(22, 'year11completed', 'YEAR', '', 'Year in which you will complete (or have completed) Year 11:'),
(23, 'year11school', 'VARCHAR', '25', 'School attended in Year 11:'),
(24, 'year11schoolpostcode', 'VARCHAR', '7', 'Postcode:'),
(25, 'highdownstudent', 'BIT', '1', 'Have you previously been a student at Highdown School & Sixth Form Centre?'),
(26, 'parentcarerfname', 'VARCHAR', '25', 'First Name Of Parent/Carer:'),
(27, 'parentcarersname', 'VARCHAR', '25', 'Surname Of Parent/Carer:'),
(28, 'parentcarerpostcode', 'VARCHAR', '7', 'Postcode:'),
(29, 'parentcarertelnumber', 'VARCHAR', '11', 'Telephone Number:'),
(30, 'parentcarermobilenumber', 'VARCHAR', '11', 'Mobile Number:'),
(31, 'contact2fname', 'VARCHAR', '25', 'Emergency Contact 2 First Name:'),
(32, 'contact2sname', 'VARCHAR', '25', 'Emergency Contact 2 Surname:'),
(33, 'contact2postcode', 'VARCHAR', '7', 'Postcode:'),
(34, 'contact2telnumber', 'VARCHAR', '11', 'Telephone Number:'),
(35, 'contact2mobilenumber', 'VARCHAR', '11', 'Mobile Number:');

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
(1, 'maths', 'AQA'),
(2, 'english', 'AQA');

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
  ADD KEY `applicant` (`login_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grade_id`),
  ADD KEY `subject_id` (`subject_id`);

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
  ADD KEY `applicant_id` (`applicant_id`);

--
-- Indexes for table `sixth form subject`
--
ALTER TABLE `sixth form subject`
  ADD PRIMARY KEY (`sixthformsubject_id`);

--
-- Indexes for table `storedinformation`
--
ALTER TABLE `storedinformation`
  ADD PRIMARY KEY (`dataid`);

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
  MODIFY `applicant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `selected courses`
--
ALTER TABLE `selected courses`
  MODIFY `selectedcourse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sixth form subject`
--
ALTER TABLE `sixth form subject`
  MODIFY `sixthformsubject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `storedinformation`
--
ALTER TABLE `storedinformation`
  MODIFY `dataid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  ADD CONSTRAINT `applicant` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`);

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
