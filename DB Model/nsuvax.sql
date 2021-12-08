-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2021 at 06:46 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nsuvax`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `full_name` varchar(60) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `password`, `full_name`, `email`) VALUES
(111, 'nsu1', 'Dr. Javed Bari', 'javed.bari@northsouth.edu'),
(222, 'nsu2', 'Dr. Rezaul Bari', 'rezaul.bari@northsouth.edu');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dno` int(1) NOT NULL,
  `dname` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dno`, `dname`) VALUES
(1, 'ECE'),
(2, 'BBA'),
(3, 'DMP'),
(4, 'CEE'),
(5, 'English'),
(6, 'Economics'),
(7, 'Law'),
(8, 'Arch');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `nsu_id` bigint(10) NOT NULL,
  `dno` int(1) NOT NULL,
  `vaxId` int(2) DEFAULT NULL,
  `doseTaken` int(1) DEFAULT 0,
  `password` varchar(10) NOT NULL,
  `fname` varchar(30) DEFAULT NULL,
  `lname` varchar(30) NOT NULL,
  `nsu_mail` varchar(40) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `city` varchar(10) DEFAULT NULL,
  `NID` int(16) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `birthRegNo` int(20) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`nsu_id`, `dno`, `vaxId`, `doseTaken`, `password`, `fname`, `lname`, `nsu_mail`, `phone`, `city`, `NID`, `DOB`, `birthRegNo`, `gender`) VALUES
(1721427642, 1, 1, 1, 'abab23', 'Shah Alvi', 'Hossain', 'alvi.hossain@northsouth.edu', 1726354242, 'DHAKA', 80563467, '1997-04-06', NULL, 'M'),
(1914455643, 4, NULL, 0, 'sdsda43', 'Fahim', 'Hasan', 'fahim.hasan@northsouth.edu', 1556454342, 'DHAKA', 21238879, '0199-05-05', 44210503, 'M'),
(2011264642, 6, NULL, 0, 'joker32', 'Marium', 'Begum', 'marium.begum@northsouth.edu', 1745656915, 'BARISHAL', 86234736, '2001-05-04', 78822385, 'F'),
(2012165642, 3, 3, 1, '@Aa21', 'Riad', 'Shafwan', 'riad.shafwan01@northsouth.edu', 1780898121, 'SYLHET', 34523436, '2000-01-25', 72626634, 'M'),
(2013356642, 1, NULL, 0, 'sdfsfjh45', 'Md. Nahin', 'Islam', 'nahin.islam@northsouth.edu', 1645348962, 'DHAKA', 89927493, '2000-02-25', 17296892, 'M'),
(2013664642, 1, 1, 2, 'asif123', 'Ihsanul Haque', 'Asif', 'ihsanul.asif@northsouth.edu', 1680898915, 'DHAKA', 96145789, '2001-06-09', 28427840, 'M'),
(2013994642, 4, NULL, 0, '##alpha', 'Isha', 'Khan', 'isha.esha@northsouth.edu', 1885890915, 'FENI', 89234736, '2000-07-01', 42786139, 'F'),
(2014534632, 2, 2, 2, 'jon123', 'Jon', 'Doe', 'jon.doe@northsouth.edu', 1725367846, 'COMILLA', 14579352, '1999-01-21', NULL, 'M'),
(2023554652, 5, 2, 1, 'asesa32', 'Sadia', 'Islam', 'sadia.islam@northsouth.edu', 1856747416, 'DHAKA', 73544523, '2002-02-25', 81322515, 'F'),
(2024521642, 4, 2, 1, 'play@1', 'Janntul', 'Ferdaus', 'jannatul.ferdaus03@northsouth.', 1530898915, 'CUMILLA', 98745473, '2000-04-29', 16283457, 'F'),
(2033124642, 7, 1, 2, '@rrr123', 'Abrar', 'Mahmud', 'abrar.mahmud02@northsouth.edu', 2147483647, 'KHULNA', 99734736, '2001-10-23', 60568282, 'M'),
(2033232642, 6, NULL, 0, 'B007', 'Shanto', 'Islam', 'shanto.islam03@northsouth.edu', 1698788915, 'DHAKA', 85234754, '2000-02-18', 68384763, 'M'),
(2112370642, 5, 2, 2, 'hasan121', 'S M', 'Mahedi Hasan', 'mahedi.hasan06@northsouth.edu', 1621887399, 'DHAKA', 98645131, '2001-08-19', 30993819, 'M'),
(2113452642, 7, 1, 2, 'UseLess32', 'Zahid', 'hasan', 'zahid.hasan08@northsouth.edu', 1985498915, 'CHOTTOGRAM', 34523736, '2000-07-07', 24088795, 'M'),
(2114954642, 2, 3, 1, '56rio', 'Nusrat Jahan', 'Faria', 'nusrat.jahan06@northsouth.edu', 2147483647, 'BOGRA', 54523473, '2001-07-09', 12085370, 'F'),
(2123674642, 8, 3, 2, 'No212', 'Monira', 'Islam', 'monira.islam04@northsouth.edu', 1798698915, 'DHAKA', 45234736, '2002-08-21', NULL, 'F');

-- --------------------------------------------------------

--
-- Table structure for table `stuff`
--

CREATE TABLE `stuff` (
  `stuff_id` bigint(10) NOT NULL,
  `dno` int(1) NOT NULL,
  `vaxId` int(2) DEFAULT NULL,
  `doseTaken` int(1) DEFAULT 0,
  `password` varchar(10) NOT NULL,
  `fname` varchar(30) DEFAULT NULL,
  `lname` varchar(30) NOT NULL,
  `designation` varchar(20) NOT NULL,
  `nsu_mail` varchar(30) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `city` varchar(10) DEFAULT NULL,
  `NID` int(16) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `birthRegNo` int(20) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stuff`
--

INSERT INTO `stuff` (`stuff_id`, `dno`, `vaxId`, `doseTaken`, `password`, `fname`, `lname`, `designation`, `nsu_mail`, `phone`, `city`, `NID`, `DOB`, `birthRegNo`, `gender`) VALUES
(1852854758, 1, 1, 2, 'xbcgsa', 'Mohammad Forhad', 'Uddin', 'Professor', 'mohammad.forhad@northsouth.edu', 1727463535, 'DHAKA', 94479791, '1972-04-08', NULL, 'M'),
(3740793446, 2, 2, 2, 'acasew', 'Rezaul', 'Karim', 'Lecturer', 'rezaul.karim@northsouth.edu', 1923746252, 'DHAKA', 79922644, '1977-03-01', NULL, 'M'),
(5990164093, 3, 3, 2, 'erterw', 'Azreen', 'Benazir', 'Assistant Lecturer', 'azreen.benazir@northsouth.edu', 1836251036, 'DHAKA', 41945528, '1980-05-09', NULL, 'F');

-- --------------------------------------------------------

--
-- Table structure for table `vax`
--

CREATE TABLE `vax` (
  `vaxId` int(2) NOT NULL,
  `vax_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vax`
--

INSERT INTO `vax` (`vaxId`, `vax_name`) VALUES
(1, 'Moderna'),
(2, 'Pfizer-Bio'),
(3, 'Sinopharm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dno`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`nsu_id`),
  ADD UNIQUE KEY `nsu_mail` (`nsu_mail`),
  ADD UNIQUE KEY `NID` (`NID`),
  ADD UNIQUE KEY `birthRegNo` (`birthRegNo`),
  ADD KEY `dno` (`dno`),
  ADD KEY `vaxId` (`vaxId`);

--
-- Indexes for table `stuff`
--
ALTER TABLE `stuff`
  ADD PRIMARY KEY (`stuff_id`),
  ADD UNIQUE KEY `nsu_mail` (`nsu_mail`),
  ADD UNIQUE KEY `NID` (`NID`),
  ADD UNIQUE KEY `birthRegNo` (`birthRegNo`),
  ADD KEY `dno` (`dno`),
  ADD KEY `vaxId` (`vaxId`);

--
-- Indexes for table `vax`
--
ALTER TABLE `vax`
  ADD PRIMARY KEY (`vaxId`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`dno`) REFERENCES `department` (`dno`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`vaxId`) REFERENCES `vax` (`vaxId`);

--
-- Constraints for table `stuff`
--
ALTER TABLE `stuff`
  ADD CONSTRAINT `stuff_ibfk_1` FOREIGN KEY (`dno`) REFERENCES `department` (`dno`),
  ADD CONSTRAINT `stuff_ibfk_2` FOREIGN KEY (`vaxId`) REFERENCES `vax` (`vaxId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
