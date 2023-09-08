-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 07, 2023 at 10:00 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `learnypy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`username`, `password`) VALUES
('nahida', 'nahida'),
('suny', 'suny');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_name` varchar(100) NOT NULL,
  `course_category` varchar(100) NOT NULL,
  `course_instructor` varchar(100) NOT NULL,
  `course_description` varchar(300) DEFAULT NULL,
  `course_difficulty` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_name`, `course_category`, `course_instructor`, `course_description`, `course_difficulty`) VALUES
('cse302', 'general', 'dmrh', 'This is a general Category Course. You will learn everything about database. Like Database Manipulation . Database Definition . Data Query. And others', 'intermediate'),
('cse412', 'developing', 'ntn', 'Software Engineering Related Course', 'introductory'),
('cse347', 'general', 'ntn', 'Just Simple Non Major Course to introduce you to system design', 'introductory'),
('CSE488', 'data science', 'dmrh', 'Big Data', 'advanced');

-- --------------------------------------------------------

--
-- Table structure for table `course_category`
--

CREATE TABLE `course_category` (
  `category_name` varchar(100) NOT NULL,
  `category_description` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_category`
--

INSERT INTO `course_category` (`category_name`, `category_description`) VALUES
('data science', 'Make a good use of data . Visualize it , mine it , make machine learn it. All up to you !'),
('developing', 'Web Database, Software Engineering, Mobile Programming everything is related to Developing.'),
('general', 'this is general category. Both data science and software engineering students can take this'),
('non departmental', 'Courses that are not related to your department. Such as Gen , Mat . This type of courses');

-- --------------------------------------------------------

--
-- Table structure for table `course_material`
--

CREATE TABLE `course_material` (
  `course_material_id` int(100) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_category` varchar(100) NOT NULL,
  `course_instructor` varchar(100) NOT NULL,
  `course_material_type` varchar(100) DEFAULT NULL,
  `course_material_name` varchar(100) DEFAULT NULL,
  `course_material_description` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_material`
--

INSERT INTO `course_material` (`course_material_id`, `course_name`, `course_category`, `course_instructor`, `course_material_type`, `course_material_name`, `course_material_description`) VALUES
(3, 'cse347', 'general', 'ntn', 'quiz', NULL, NULL),
(5, 'cse412', 'developing', 'ntn', 'quiz', NULL, NULL),
(6, 'cse412', 'developing', 'ntn', 'pdf', 'ppa.pdf', 'Learn Plant Propagation Algorithm Using this PDF'),
(8, 'cse412', 'developing', 'ntn', 'jpg', 'Anime_room.png', 'This is a nice picture you can set it as your wallpaper'),
(9, 'cse412', 'developing', 'ntn', 'jpg', 'Anime_room2.jpg', 'This is another picture that you can set as wallpaper'),
(10, 'cse347', 'general', 'ntn', 'jpg', 'Something_to_type.jpg', 'You can set it as your desktop wallpaper'),
(11, 'cse412', 'developing', 'ntn', 'jpg', 'cartoon-illustration-of-thai-female-teacher-holding-a-stick-in-front-of-blackboard-vector.jpg', 'This is just a cartoon hope you will like it'),
(13, 'cse412', 'developing', 'ntn', 'quiz', NULL, NULL),
(15, 'cse412', 'developing', 'ntn', 'quiz', NULL, NULL),
(16, 'cse412', 'developing', 'ntn', 'quiz', NULL, NULL),
(17, 'cse412', 'developing', 'ntn', 'quiz', NULL, NULL),
(18, 'cse302', 'general', 'dmrh', 'quiz', NULL, NULL),
(19, 'cse302', 'general', 'dmrh', 'pdf', 'Topic 1.pdf', 'pdf'),
(20, 'cse302', 'general', 'dmrh', 'quiz', NULL, NULL),
(21, 'cse302', 'general', 'dmrh', 'quiz', NULL, NULL),
(22, 'cse412', 'developing', 'ntn', 'quiz', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_quiz`
--

CREATE TABLE `course_quiz` (
  `quiz_serial` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_category` varchar(100) NOT NULL,
  `course_instructor` varchar(100) NOT NULL,
  `course_quiz_question` varchar(500) NOT NULL,
  `course_quiz_marks` int(100) NOT NULL,
  `course_material_type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_quiz`
--

INSERT INTO `course_quiz` (`quiz_serial`, `course_name`, `course_category`, `course_instructor`, `course_quiz_question`, `course_quiz_marks`, `course_material_type`) VALUES
(9, 'cse412', 'developing', 'ntn', 'Please State What is Water Fall model ? Why it is least used?', 10, ''),
(10, 'cse412', 'developing', 'ntn', 'What is Black box testing?', 10, ''),
(12, 'cse347', 'general', 'ntn', 'What is Activity Diagram?', 15, ''),
(13, 'cse347', 'general', 'ntn', 'What is Dataflow diagram?', 15, ''),
(15, 'cse412', 'developing', 'ntn', 'Tell me did you like the course?', 10, NULL),
(16, 'cse412', 'developing', 'ntn', 'Testing if the quiz option works or not', 50, NULL),
(18, 'cse302', 'general', 'dmrh', 'write report for 302', 20, NULL),
(19, 'cse302', 'general', 'dmrh', 'write sql', 20, NULL),
(20, 'cse412', 'developing', 'ntn', 'Write something about software engineering?', 50, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `instructor_info`
--

CREATE TABLE `instructor_info` (
  `instructor_fname` varchar(100) DEFAULT NULL,
  `instructor_lname` varchar(100) DEFAULT NULL,
  `instructor_username` varchar(100) NOT NULL,
  `instructor_password` varchar(100) DEFAULT NULL,
  `instructor_email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instructor_info`
--

INSERT INTO `instructor_info` (`instructor_fname`, `instructor_lname`, `instructor_username`, `instructor_password`, `instructor_email`) VALUES
('Dr Mohammad ', 'Rezwanul hoque', 'dmrh', 'dmrh', NULL),
('myr', 'myr', 'myr', 'myr', NULL),
('Nishat Tasnim', 'Niloy', 'ntn', 'ntn', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_ans`
--

CREATE TABLE `quiz_ans` (
  `student_email` varchar(300) NOT NULL,
  `course_name` varchar(300) NOT NULL,
  `course_category` varchar(300) NOT NULL,
  `course_instructor` varchar(300) NOT NULL,
  `quiz_ans` varchar(1000) NOT NULL,
  `quiz_marks` int(10) DEFAULT NULL,
  `quiz_serial` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_ans`
--

INSERT INTO `quiz_ans` (`student_email`, `course_name`, `course_category`, `course_instructor`, `quiz_ans`, `quiz_marks`, `quiz_serial`) VALUES
('ayon@gmail.com', 'cse412', 'developing', 'ntn', ' something something', 50, 9),
('ayon@gmail.com', 'cse347', 'general', 'ntn', ' An activity diagram is a type of UML (Unified Modeling Language) diagram used in software engineering and business process modeling to visualize and describe the steps', 50, 12),
('liza@gmail.com', 'cse302', 'general', 'dmrh', ' Not in a mood to write it now .', 12, 18),
('liza@gmail.com', 'cse302', 'general', 'dmrh', ' Sql', 12, 19);

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `student_email` varchar(100) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_category` varchar(100) NOT NULL,
  `course_instructor` varchar(100) NOT NULL,
  `course_review_bool` varchar(10) DEFAULT 'false',
  `course_review_star` int(10) NOT NULL DEFAULT 0,
  `course_review` varchar(100) DEFAULT NULL,
  `course_marks` int(50) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_course`
--

INSERT INTO `student_course` (`student_email`, `course_name`, `course_category`, `course_instructor`, `course_review_bool`, `course_review_star`, `course_review`, `course_marks`) VALUES
('alfeysuny@gmail.com', 'cse302', 'general', 'dmrh', 'false', 0, '', 0),
('ayon@gmail.com', 'cse302', 'general', 'dmrh', 'true', 5, 'He is a really good Teacher', 0),
('ayon@gmail.com', 'cse347', 'general', 'ntn', 'true', 5, 'Maam is really great. Nice Course', 0),
('ayon@gmail.com', 'cse412', 'developing', 'ntn', 'false', 0, NULL, 0),
('liza@gmail.com', 'cse302', 'general', 'dmrh', 'true', 5, 'Enjoyed the course . Great instructor.', 0),
('liza@gmail.com', 'CSE488', 'data science', 'dmrh', 'false', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `student_fname` varchar(100) NOT NULL,
  `student_lname` varchar(100) NOT NULL,
  `student_email` varchar(100) NOT NULL,
  `student_password` varchar(100) NOT NULL,
  `student_pic` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`student_fname`, `student_lname`, `student_email`, `student_password`, `student_pic`) VALUES
('alfe', 'suny', 'alfeysuny@gmail.com', '3fc9b689459d738f8c88a3a48aa9e33542016b7a4052e001aaa536fca74813cb', NULL),
('nahida', 'hoque', 'nahida@gmail.com', '8dcca2f61cf29936eca5e149e36700ad41562308719fcb2fb60f04731919b90e', NULL),
('ayon', 'talha', 'ayon@gmail.com', '0002fb3b4e2f6431bb8fcefd891eff3e457878d0701577bd4e5f22010859fbe6', NULL),
('Maimuna', 'Akter', '2019-2-60-088@std.ewubd.edu', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL),
('sultan', 'shaon', 'shaon@gmail.com', 'c7e14e96f577dc31bbd0257a8130da44093ff224f9bfc4460bcff6c1b3b3f277', NULL),
('ayotrika', 'ayotrika', 'ayotrika@gmail.com', '26aaa61f92f364db3e75a0b369ac12acaf7590db9ed8fffa862d3a7b33e47bf5', NULL),
('Maimuna', 'Akter', 'liza@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL),
('Maimuna', 'Akter', 'maimuna@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course_material`
--
ALTER TABLE `course_material`
  ADD PRIMARY KEY (`course_material_id`);

--
-- Indexes for table `course_quiz`
--
ALTER TABLE `course_quiz`
  ADD PRIMARY KEY (`quiz_serial`);

--
-- Indexes for table `instructor_info`
--
ALTER TABLE `instructor_info`
  ADD PRIMARY KEY (`instructor_username`);

--
-- Indexes for table `quiz_ans`
--
ALTER TABLE `quiz_ans`
  ADD PRIMARY KEY (`student_email`,`quiz_serial`),
  ADD KEY `quiz_ans_ibfk_1` (`quiz_serial`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course_material`
--
ALTER TABLE `course_material`
  MODIFY `course_material_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `course_quiz`
--
ALTER TABLE `course_quiz`
  MODIFY `quiz_serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `quiz_ans`
--
ALTER TABLE `quiz_ans`
  ADD CONSTRAINT `quiz_ans_ibfk_1` FOREIGN KEY (`quiz_serial`) REFERENCES `course_quiz` (`quiz_serial`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
