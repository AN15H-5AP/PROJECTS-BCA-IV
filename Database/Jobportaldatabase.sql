-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2023 at 08:15 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `Admin_id` int(20) UNSIGNED NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(10) UNSIGNED NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `conatact_personname` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `website` varchar(100) DEFAULT NULL,
  `category` varchar(100) NOT NULL,
  `description` varchar(512) NOT NULL,
  `Image_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_name`, `conatact_personname`, `email`, `phone`, `password`, `location`, `website`, `category`, `description`, `Image_name`) VALUES
(1, 'Techpana', 'Alex shrestha', 'techpana@gmail.com', '9876543210', '$2y$10$CTngzT7tqawiBo94QNP20uWJXQ433BAl28I/FH5rKmNBun7PPfwPy', 'kathmandu', 'https://techpana.com', '', 'This is an online based news portal', '');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` int(10) UNSIGNED NOT NULL,
  `category` varchar(200) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `posted_date` date DEFAULT NULL,
  `deadline_date` date DEFAULT NULL,
  `estimated_salary` varchar(100) DEFAULT NULL,
  `no_of_vacancy` int(11) NOT NULL,
  `job_address` varchar(200) NOT NULL,
  `job_type` varchar(50) NOT NULL,
  `job_description` varchar(255) NOT NULL,
  `companyID` int(10) UNSIGNED DEFAULT NULL,
  `companyName` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `category`, `job_title`, `posted_date`, `deadline_date`, `estimated_salary`, `no_of_vacancy`, `job_address`, `job_type`, `job_description`, `companyID`, `companyName`) VALUES
(2, 'IT&Telecommunication', 'software engineering', '2023-05-30', '2023-06-10', '100000', 2, 'kathmandu', 'Full-time', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum ab aperiam voluptatibus odit alias, ipsam at dolorum aut fugiat officiis doloremque assumenda quod, vero tenetur et commodi tempore nostrum voluptates! Totam, sint accusamus autem provident ei', 1, ''),
(3, 'Graphic Designing', 'software engineering', '2023-05-30', '2023-06-09', '100000', 4, 'kathmandu', 'Full-time', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum enim vero tempora repudiandae vitae doloribus sunt facilis dolor cumque eius quasi deleniti architecto quisquam nobis quos ipsa sed iusto nulla tenetur adipisci, optio nam? Saepe quidem blan', 1, ''),
(4, 'Medical', 'Doctor', '2023-05-30', '2023-06-10', '500000', 3, 'lalitpur', 'Full-time', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum enim vero tempora repudiandae vitae doloribus sunt facilis dolor cumque eius quasi deleniti architecto quisquam nobis quos ipsa sed iusto nulla tenetur adipisci, optio nam? Saepe quidem blan', 1, ''),
(5, 'Engineering/Architectures', 'Engineer', '2023-05-30', '2023-06-10', '500000', 2, 'lalitpur', 'Full-time', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum enim vero tempora repudiandae vitae doloribus sunt facilis dolor cumque eius quasi deleniti architecto quisquam nobis quos ipsa sed iusto nulla tenetur adipisci, optio nam? Saepe quidem blan', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `job_seeker`
--

CREATE TABLE `job_seeker` (
  `Job_seeker_id` int(20) UNSIGNED NOT NULL,
  `Full_name` varchar(100) NOT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `Phone` int(20) DEFAULT NULL,
  `Resume_file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`Admin_id`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `companyID` (`companyID`);

--
-- Indexes for table `job_seeker`
--
ALTER TABLE `job_seeker`
  ADD PRIMARY KEY (`Job_seeker_id`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Phone` (`Phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `Admin_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `job_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `job_seeker`
--
ALTER TABLE `job_seeker`
  MODIFY `Job_seeker_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `job_ibfk_1` FOREIGN KEY (`companyID`) REFERENCES `company` (`company_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
