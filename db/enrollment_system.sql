-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2023 at 03:45 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `enrollment_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE IF NOT EXISTS `announcement` (
`actId` int(11) NOT NULL,
  `actName` text NOT NULL,
  `actDate` varchar(20) NOT NULL,
  `date_added` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`actId`, `actName`, `actDate`, `date_added`) VALUES
(2, 'Activity 5', '2022-12-23', ''),
(3, 'Activity 3', '2022-12-10', '2022-12-11'),
(4, 'Activity 2', '2022-12-11', '2022-12-11'),
(5, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem, ipsum delectus voluptatum? Molestias aut inventore eaque, maxime numquam dignissimos asperiores, voluptatibus consectetur distinctio excepturi odit architecto, saepe enim sunt, molestiae.', '2022-12-11', '2022-12-11'),
(6, 'sample', '2022-12-27', '2022-12-27'),
(8, 'gfdgfd', '2023-01-06', '2022-12-27');

-- --------------------------------------------------------

--
-- Table structure for table `customization`
--

CREATE TABLE IF NOT EXISTS `customization` (
`customID` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `status` varchar(150) NOT NULL DEFAULT 'Inactive',
  `date_added` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `customization`
--

INSERT INTO `customization` (`customID`, `picture`, `status`, `date_added`) VALUES
(10, 'wallpaperflare.com_wallpaper.jpg', 'Inactive', '2022-11-27'),
(11, 'minimalism-1644666519306-6515.jpg', 'Active', '2022-11-27'),
(18, 'logo.png', 'Inactive', '2022-11-27'),
(19, '2.jpg', 'Inactive', '2022-12-27');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE IF NOT EXISTS `enrollment` (
`enroll_Id` int(11) NOT NULL,
  `student_Id` int(11) NOT NULL,
  `section_Id` int(11) NOT NULL,
  `teacher_Id` int(11) NOT NULL,
  `date_enrolled` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`enroll_Id`, `student_Id`, `section_Id`, `teacher_Id`, `date_enrolled`) VALUES
(3, 77, 7, 73, '2023-01-31'),
(4, 80, 1, 66, '2023-01-31'),
(5, 79, 3, 67, '2023-01-31'),
(6, 67, 3, 67, '2023-01-31'),
(7, 83, 9, 75, '2023-02-02');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
`sectionId` int(11) NOT NULL,
  `sectionName` varchar(100) NOT NULL,
  `yearLevel` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`sectionId`, `sectionName`, `yearLevel`) VALUES
(1, 'Test 1234', 'Grade 8'),
(3, 'Test 123', 'Grade 7'),
(5, 'Test 123456', 'Grade 10'),
(7, 'Test 12345', 'Grade 9'),
(8, 'gfgfdgdfgd', 'Grade 7'),
(9, 'Sample section', 'Grade 7');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
`subjectId` int(11) NOT NULL,
  `sectionId` int(11) NOT NULL,
  `subjectName` varchar(100) NOT NULL,
  `subjectTime` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subjectId`, `sectionId`, `subjectName`, `subjectTime`) VALUES
(1, 3, 'test', ''),
(3, 1, 'gfd', '11:53'),
(4, 3, 'dfsfdsfsd', '11:02'),
(5, 1, 'fdsfdsfdsfsdfds', '11:01'),
(6, 1, 'Sample', '12:10'),
(7, 4, 'fgfd', '12:36'),
(8, 9, 'Subject 1', '11:25'),
(9, 9, 'Subject 2', '10:27'),
(10, 9, 'Subject 3', '10:27'),
(11, 9, 'Subject 4', '10:31');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
`teacher_Id` int(11) NOT NULL,
  `sectionAdvisory` int(11) NOT NULL,
  `t_firstname` varchar(255) NOT NULL,
  `t_middlename` varchar(255) NOT NULL,
  `t_lastname` varchar(255) NOT NULL,
  `t_suffix` varchar(255) NOT NULL,
  `t_dob` varchar(255) NOT NULL,
  `t_age` varchar(100) NOT NULL,
  `t_email` varchar(100) NOT NULL,
  `t_contact` varchar(100) NOT NULL,
  `t_birthplace` varchar(255) NOT NULL,
  `t_gender` varchar(255) NOT NULL,
  `t_civilstatus` varchar(50) NOT NULL,
  `t_occupation` varchar(50) NOT NULL,
  `t_religion` varchar(100) NOT NULL,
  `t_nationality` varchar(50) NOT NULL,
  `t_house_no` varchar(255) NOT NULL,
  `t_street_name` varchar(255) NOT NULL,
  `t_purok` varchar(255) NOT NULL,
  `t_zone` varchar(255) NOT NULL,
  `t_barangay` varchar(255) NOT NULL,
  `t_municipality` varchar(255) NOT NULL,
  `t_province` varchar(255) NOT NULL,
  `t_region` varchar(255) NOT NULL,
  `t_image` varchar(255) NOT NULL,
  `t_verification_code` int(11) NOT NULL,
  `t_date_registered` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=76 ;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_Id`, `sectionAdvisory`, `t_firstname`, `t_middlename`, `t_lastname`, `t_suffix`, `t_dob`, `t_age`, `t_email`, `t_contact`, `t_birthplace`, `t_gender`, `t_civilstatus`, `t_occupation`, `t_religion`, `t_nationality`, `t_house_no`, `t_street_name`, `t_purok`, `t_zone`, `t_barangay`, `t_municipality`, `t_province`, `t_region`, `t_image`, `t_verification_code`, `t_date_registered`) VALUES
(66, 1, 'Erwinfdsfds', 'Cabag', 'Son', '', '1997-09-22', '25 years old', 'admin@gmail.com', '9359428963', 'Poblacion, Medellin, Cebu', 'Male', 'Married', 'Web developer', 'Bible Baptist Church', '', '12343', 'Sitio Upper Landing', 'Purok San Isidro', 'Ambot', 'Daanlungsod', 'Medellin', 'fdsfs', 'VII', 'paom.png', 374025, '2022-11-25'),
(67, 3, 'dsd', 'd', 'd', '', '2016-03-09', '6 years old', 'sonerwin12@gmail.com', '', 'dsa', 'Male', 'Married', 'fdsf', '', '', 'fdsf', 'dsf', 'fdsf', 'fdsf', 'dsfsd', 'fdsf', 'fsdfsd', 'fds', '1.jpg', 474835, '2022-11-25'),
(72, 5, 'Samplefhfdsddffgg', 'gfdgfd', 'gdfgd', 'g', '2022-12-21', '5 days old', 'Norlyngelig16@gmail.com', '9359428963', 'gfdgfdg', 'Male', 'Married', 'gfdgfdgd', 'Buddhist', '', 'gfdg', 'fdg', 'gdfgdg', 'gfdg', 'dfgd', 'fdgdg', 'fdg', 'dfg', '12.jpg', 0, '2022-12-27'),
(73, 7, 'Norlyn', 'Son', 'Gelig', '', '2022-12-15', '1 week old', 'Norlynfdsfdgelig16@gmail.com', '9359428963', 'ewf', 'Male', 'Married', 'f', 'Methodist', '', 'gfd', 'gdfgd', 'gdfgdg', 'fdgd', 'gdf', 'gdgfdgdfgdfgd', 'Cebu', 'hgfhgfhfgghf', '4.jpg', 0, '2022-12-27'),
(75, 9, 'AdvisorAdvisor', 'AdvisorAdvisor', 'AdvisorAdvisor', '', '2023-01-30', '3 days old', 'AdvisorAdvisor23@gmail.com', '9132456789', 'AdvisorAdvisor', 'Female', 'Single', 'AdvisorAdvisor', 'Aglipayan', '', 'AdvisorAdvisor', 'AdvisorAdvisor', 'AdvisorAdvisor', 'AdvisorAdvisor', 'AdvisorAdvisor', 'AdvisorAdvisor', 'AdvisorAdvisor', 'AdvisorAdvisor', '360_F_206008696_bk0YsrrViCS1w9In3pEEEV97f2t6W85x.jpg', 0, '2023-02-02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_Id` int(11) NOT NULL,
  `enrollmentType` varchar(50) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `age` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `civilstatus` varchar(50) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `house_no` varchar(255) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `purok` varchar(255) NOT NULL,
  `zone` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `guardianName` varchar(150) NOT NULL,
  `guardianContact` varchar(50) NOT NULL,
  `schoolName` varchar(255) NOT NULL,
  `schoolAddress` varchar(255) NOT NULL,
  `yearLevel` varchar(20) NOT NULL,
  `user_type` varchar(50) NOT NULL DEFAULT 'User',
  `user_status` int(11) NOT NULL DEFAULT '0' COMMENT '0=Pending, 1=Enrolled',
  `verification_code` int(11) NOT NULL,
  `date_registered` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=84 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_Id`, `enrollmentType`, `firstname`, `middlename`, `lastname`, `suffix`, `dob`, `age`, `email`, `contact`, `birthplace`, `gender`, `civilstatus`, `occupation`, `religion`, `nationality`, `house_no`, `street_name`, `purok`, `zone`, `barangay`, `municipality`, `province`, `region`, `image`, `document`, `password`, `guardianName`, `guardianContact`, `schoolName`, `schoolAddress`, `yearLevel`, `user_type`, `user_status`, `verification_code`, `date_registered`) VALUES
(66, '', 'Erwin', 'Cabag', 'Son', '', '1997-09-22', '25 years old', 'admin@gmail.com', '9359428963', 'Poblacion, Medellin, Cebu', 'Male', 'Married', 'Web developer', 'Bible Baptist Church', '', '12343', 'Sitio Upper Landing', 'Purok San Isidro', 'Ambot', 'Daanlungsod', 'Medellin', '', 'VII', '3.jpg', '', '0192023a7bbd73250516f069df18b500', 'information', 'information', '', '', '', 'Admin', 0, 374025, '2022-11-25'),
(67, 'Old/Regular', 'dsd', 'd', 'd', '', '2016-03-09', '6 years old', 'sonerwin12@gmail.com', '9132456789', 'dsa', 'Male', 'Married', 'fdsf', 'Methodist', 'fdsf', 'fdsf', 'dsf', 'fdsf', 'fdsf', 'dsfsd', 'fdsf', 'fsdfsd', 'fds', '6207ad7e34af5.jpg', '', '0192023a7bbd73250516f069df18b500', 'information', '9132456789', 'information', 'gfd', 'Grade 7', 'User', 1, 175257, '2022-11-25'),
(74, 'Old/Regular', 'gfdgfdgdgs', 'dfgd', 'gdgdfg', 'dfgdf', '2022-12-15', '1 week old', 'gfdgdg232df@gmail.com', '9359428963', 'gfdg', 'Male', 'Single', 'gfdgdfg', 'Evangelical Christianity', 'fgdf', 'gfdgg', 'fdgfdgd', 'gdf', 'gfdgfd', 'gdf', 'gfdgd', 'gdfgd', 'gdf', '14.jpg', '', '225f667d9243201a6b2b35e008ebe3d3', 'fdsf', '9123456798', 'f', 'fgfdgd', 'Grade 9', 'User', 0, 0, '2022-12-27'),
(77, '', 'information', 'information', 'information', '', '2023-01-12', '2 weeks old', 'adminformationin@gmail.com', '9132456789', 'information', 'Male', 'Married', 'information', 'Buddhist', 'Filipino', 'information', 'information', 'information', 'information', 'information', 'information', 'information', 'information', '13.jpg', '13.jpg', 'bb3ccd5881d651448ded1dac904054ac', 'information', '9123456798', '', '', 'Grade 9', 'User', 1, 0, '2023-01-27'),
(79, 'Old/Regular', 'czczc', 'czczc', 'czczc', '', '2023-01-12', '2 weeks old', 'czczc@gmail.com', '9132456789', 'czczc', 'Male', 'Single', 'czczc', 'Evangelical Christianity', 'Filipino', '', 'czczcczczc', 'czczc', 'czczc', 'czczc', 'czczc', 'czczc', 'czczc', '16.jpg', '14.jpg', '518fa1ebd4b977f1a334b8c46da96f64', 'czczc', '9123456798', 'czczc', 'czczc@gmail.com', 'Grade 7', 'User', 1, 0, '2023-01-27'),
(80, 'New', 'czczcczczc', 'czczc', 'czczcczczc', 'czczcczczc', '2023-01-10', '2 weeks old', 'alburoczczc.jolina12@gmail.com', '9132456789', 'czczc', 'Male', 'Married', 'czczc', 'Evangelical Christianity', 'Filipino', 'czczc', 'czczc', 'czczc', 'czczc', 'czczc', 'czczc', 'czczc', 'czczc', '', '17.jpg', '518fa1ebd4b977f1a334b8c46da96f64', 'czczc', '9123456798', 'czczc', 'admczczcczczcin@gmail.com', 'Grade 8', 'User', 1, 0, '2023-01-27'),
(81, 'Old/Regular', 'updated', 'updated', 'updated', 'updated', '2023-01-26', '1 day old', 'updatedds23232adaadad@gmail.com', '9132456987', 'updated', 'Non-Binary', 'Widow/ER', 'updated', 'Aglipayan', 'Filipinodfds', 'updated', 'updated', 'updated', 'updated', 'updated', 'updated', 'updated', 'updated', 'mary.png', 'bpc.jpg', '200019070bde259585f1e8514be9b4ff', 'updated', '9123456987', 'updated', 'updated@gmail.comffdfdfdsfsfds', 'Grade 7', 'User', 1, 0, '2023-01-27'),
(82, '', 'teacher', 'teacher', 'teacher', '', '2023-01-09', '3 weeks old', 'teacher@gmail.com', '9132456789', 'teacher', 'Male', 'Married', 'teacher', 'Hindu', '', 'teacher', 'teacher', 'teacher', 'teacher', 'teacher', 'teacher', 'teacher', 'teacher', '2.jpg', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', '', '', '', 0, 0, '2023-01-31'),
(83, 'Old/Regular', 'first name', 'Sample name', 'Sample name', '', '2023-02-01', '1 day old', 'Samplename121@gmail.com', '9123456789', 'Sample name', 'Male', 'Single', 'Sample name', 'Buddhist', 'Filipino', 'Sample name', 'Sample name', 'Sample name', 'Sample name', 'Sample name', 'Sample name', 'Sample name', 'Sample name', '12.jpg', 'concep.png', '7488e331b8b64e5794da3fa4eb10ad5d', 'Sample name', '9123456789', 'Sample name', 'admSamplenamein@gmail.com', 'Grade 7', 'User', 1, 0, '2023-02-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
 ADD PRIMARY KEY (`actId`);

--
-- Indexes for table `customization`
--
ALTER TABLE `customization`
 ADD PRIMARY KEY (`customID`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
 ADD PRIMARY KEY (`enroll_Id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
 ADD PRIMARY KEY (`sectionId`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
 ADD PRIMARY KEY (`subjectId`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
 ADD PRIMARY KEY (`teacher_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
MODIFY `actId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `customization`
--
ALTER TABLE `customization`
MODIFY `customID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
MODIFY `enroll_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
MODIFY `sectionId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
MODIFY `subjectId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
MODIFY `teacher_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=84;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
