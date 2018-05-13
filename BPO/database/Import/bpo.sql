-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2018 at 04:16 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bpo`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesslevel`
--

CREATE TABLE `accesslevel` (
  `level` int(11) NOT NULL,
  `type` enum('superadmin','admin','assistant','student','ingenTilgang') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accesslevel`
--

INSERT INTO `accesslevel` (`level`, `type`) VALUES
(0, 'ingenTilgang'),
(1, 'student'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `dates`
--

CREATE TABLE `dates` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `documents_groups_number` int(11) NOT NULL,
  `documents_year` int(11) NOT NULL,
  `file_name` varchar(127) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_number` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `leader` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(127) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(127) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `searching` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `time` time NOT NULL,
  `user` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pos` int(11) NOT NULL,
  `command` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_02_11_130213_create_seeds_table', 1),
(2, '2018_02_11_210806_create_foreign_keys_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tittel` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `melding` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `presentation`
--

CREATE TABLE `presentation` (
  `presentation_group_number` int(11) NOT NULL,
  `presentation_year` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `presentation_room` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sensor` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prosjektforslag`
--

CREATE TABLE `prosjektforslag` (
  `id` int(10) UNSIGNED NOT NULL,
  `date_added` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(127) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sensors_supervisors`
--

CREATE TABLE `sensors_supervisors` (
  `email` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `username` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_points` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `program` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_groups`
--

CREATE TABLE `student_groups` (
  `student` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_groups_number` int(11) NOT NULL,
  `student_groups_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `firstname` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `level`, `firstname`, `lastname`, `email`, `password`, `sex`) VALUES
('root', 2, 'root', 'root', 'admin@hioa.no', 'root', 'M');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesslevel`
--
ALTER TABLE `accesslevel`
  ADD PRIMARY KEY (`level`);

--
-- Indexes for table `dates`
--
ALTER TABLE `dates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `connect_groups_idx` (`documents_year`,`documents_groups_number`),
  ADD KEY `documents_documents_groups_number_documents_year_foreign` (`documents_groups_number`,`documents_year`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_number`,`year`),
  ADD KEY `groups_supervisor_foreign` (`supervisor`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_user_foreign` (`user`);

--
-- Indexes for table `presentation`
--
ALTER TABLE `presentation`
  ADD PRIMARY KEY (`presentation_group_number`,`presentation_year`),
  ADD KEY `presentation_idx` (`presentation_room`),
  ADD KEY `presentation_sensor_foreign` (`sensor`);

--
-- Indexes for table `prosjektforslag`
--
ALTER TABLE `prosjektforslag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room`);

--
-- Indexes for table `sensors_supervisors`
--
ALTER TABLE `sensors_supervisors`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `student_groups`
--
ALTER TABLE `student_groups`
  ADD PRIMARY KEY (`student`,`student_groups_year`),
  ADD KEY `group_number_idx` (`student_groups_number`,`student_groups_year`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD KEY `level_idx` (`level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dates`
--
ALTER TABLE `dates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prosjektforslag`
--
ALTER TABLE `prosjektforslag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_documents_groups_number_documents_year_foreign` FOREIGN KEY (`documents_groups_number`,`documents_year`) REFERENCES `groups` (`group_number`, `year`);

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_supervisor_foreign` FOREIGN KEY (`supervisor`) REFERENCES `sensors_supervisors` (`email`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`username`);

--
-- Constraints for table `presentation`
--
ALTER TABLE `presentation`
  ADD CONSTRAINT `presentation_presentation_group_number_presentation_year_foreign` FOREIGN KEY (`presentation_group_number`,`presentation_year`) REFERENCES `groups` (`group_number`, `year`),
  ADD CONSTRAINT `presentation_presentation_room_foreign` FOREIGN KEY (`presentation_room`) REFERENCES `room` (`room`),
  ADD CONSTRAINT `presentation_sensor_foreign` FOREIGN KEY (`sensor`) REFERENCES `sensors_supervisors` (`email`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_username_foreign` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `student_groups`
--
ALTER TABLE `student_groups`
  ADD CONSTRAINT `student_groups_student_foreign` FOREIGN KEY (`student`) REFERENCES `student` (`username`),
  ADD CONSTRAINT `student_groups_student_groups_number_student_groups_year_foreign` FOREIGN KEY (`student_groups_number`,`student_groups_year`) REFERENCES `groups` (`group_number`, `year`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_level_foreign` FOREIGN KEY (`level`) REFERENCES `accesslevel` (`level`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
