-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2023 at 03:30 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `students_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `id` int(11) NOT NULL,
  `student_class` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classrooms`
--

INSERT INTO `classrooms` (`id`, `student_class`) VALUES
(3, '(React) Frontend'),
(5, 'PHP Backend'),
(11, 'DevOps'),
(12, 'Data Science'),
(13, 'Scrum Master');

-- --------------------------------------------------------

--
-- Table structure for table `students_record`
--

CREATE TABLE `students_record` (
  `id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `class` varchar(50) NOT NULL,
  `image_file` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students_record`
--

INSERT INTO `students_record` (`id`, `student_name`, `username`, `email`, `grade`, `class`, `image_file`) VALUES
(4, 'Victoria Elena', 'vikky_elena', 'vikky_elena', 'B', 'DevOps', 'elena_pics.jpg'),
(6, 'Nwokorie Alex', 'lexiscode', 'lexiscode', 'A+', 'PHP Backend', 'my_pics.jpg'),
(7, 'Hennadii Shvedko', 'hennadii', 'hennadiizz', 'A+', 'Data Science', 'hennadii_pics-2.jpg'),
(8, 'Elina Chifeac', 'elina_chifeac', 'elina_chifeac', 'B', '(React) Frontend', 'elina_pics.jpg'),
(9, 'Ana Indoitu', 'ana_indoitu', 'ana_indoitu', 'A', 'DevOps', 'ana_pics.jpg'),
(10, 'Raul Raul', 'raul_raul', 'raul_raul', 'A+', 'PHP Backend', 'raul_pics.jpg'),
(11, 'Ruth Osoro', 'rutty_osoro', 'rutty_osoro', 'A+', 'PHP Backend', 'ruth_pics.jpg'),
(12, 'Chioma Nirozi', 'chioma_presh', 'chioma_presh', 'A', '(React) Frontend', 'chioma_pics.jpg'),
(13, 'Joy Chidinma', 'joyjoy', 'joyjoy', 'B', '(React) Frontend', 'joy_pics.jpg'),
(14, 'Johnson Joy', 'joy_funmi', 'joy_funmi', 'C', 'PHP Backend', 'funmi_pics.jpg'),
(15, 'Joseph Tosin', 'tosin_boy', 'tosin_boy', 'A', 'Scrum Master', 'tosin_pics.jpg'),
(19, 'Valentina Muller', 'valentina', 'valentina', 'A+', 'PHP Backend', 'valentina_pics.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'lexischool', '$2y$10$Y.0QLE4jJK2AUkE9VFbWteKihYuRRzBIUHY/TkH9TaGScamk92EIu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_record`
--
ALTER TABLE `students_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `students_record`
--
ALTER TABLE `students_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
