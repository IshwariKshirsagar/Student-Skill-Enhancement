-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2026 at 07:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentskillenhancement`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `user_id`, `message`, `timestamp`) VALUES
(9, 1, 'hello everyone', '2025-12-17 19:42:35'),
(10, 4, 'hello', '2025-12-17 19:42:49'),
(11, 1, 'can you completed java course', '2025-12-17 19:45:05'),
(12, 4, 'half is done', '2025-12-17 19:45:16'),
(13, 1, 'ohh till which lecture ?', '2025-12-17 19:45:32'),
(14, 4, '4.5', '2025-12-17 19:45:45'),
(15, 1, 'how are you', '2025-12-17 19:46:38'),
(16, 4, 'fine', '2025-12-17 19:46:43'),
(17, 4, 'what about you', '2025-12-17 19:46:51'),
(18, 1, 'same', '2025-12-17 19:46:57'),
(19, 4, 'hii', '2025-12-18 20:37:40'),
(20, 1, 'hello', '2025-12-18 20:38:55'),
(21, 4, 'bol naaaa', '2025-12-18 20:40:10'),
(22, 6, 'hii', '2025-12-18 20:41:03'),
(23, 5, 'hi', '2026-01-01 14:19:18'),
(24, 1, 'How was the course progress', '2026-01-16 19:39:42'),
(25, 5, 'Fine', '2026-01-16 19:39:52');

-- --------------------------------------------------------

--
-- Table structure for table `course_database`
--

CREATE TABLE `course_database` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(200) NOT NULL,
  `course_type` int(11) NOT NULL,
  `course_owner` int(11) NOT NULL,
  `course_date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_database`
--

INSERT INTO `course_database` (`course_id`, `course_name`, `course_type`, `course_owner`, `course_date_created`) VALUES
(1, 'Java Programming', 1, 6, '2025-12-15 07:51:26'),
(2, 'Python Programming', 1, 17, '2025-12-15 08:19:16'),
(3, 'Android Programming', 5, 19, '2025-12-15 08:20:40'),
(4, 'Elements of Electrical Engineering', 2, 16, '2025-12-15 08:33:52'),
(5, 'Thermodynamics', 6, 22, '2025-12-15 09:54:17'),
(6, 'PHP', 1, 17, '2025-12-16 03:50:02'),
(7, 'Javascript', 1, 16, '2026-01-16 14:05:26');

-- --------------------------------------------------------

--
-- Table structure for table `course_type`
--

CREATE TABLE `course_type` (
  `course_type_id` int(11) NOT NULL,
  `course_type_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_type`
--

INSERT INTO `course_type` (`course_type_id`, `course_type_name`) VALUES
(1, 'Computer Engineering'),
(2, 'Electrical Engineering'),
(3, 'Civil Engineering'),
(4, 'Electronics Engineering'),
(5, 'Information Technology'),
(6, 'Mechanical Enginnering');

-- --------------------------------------------------------

--
-- Table structure for table `course_videos`
--

CREATE TABLE `course_videos` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `Thumbnail` varchar(500) NOT NULL,
  `VideoTitle` varchar(100) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `video` varchar(200) NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_videos`
--

INSERT INTO `course_videos` (`id`, `course_id`, `Thumbnail`, `VideoTitle`, `Description`, `video`, `Status`) VALUES
(2, 1, '../thumbnail/1768382294_Yogesh.png', 'T1', 'Desc2', '../course_videos/1768382294_watchanimeworld.mp4', 1),
(3, 1, '../thumbnail/1768382525_Screenshot 2025-08-26 023737.png', 'AJP', 'Desc2', '../course_videos/1768382525_shinchan new episode in hindi without zoom effect #25095095.mp4', 1),
(5, 1, '../thumbnail/1768383123_Screenshot 2026-01-11 090447.png', 'Title 4', 'desc 4', '../course_videos/1768383123_Golmaal.Returns.720p.themoviesflix.in.mkv', 1),
(6, 1, '../thumbnail/1768383123_Screenshot 2026-01-11 090447.png', 'Title 5', 'Desc 5', '../course_videos/1768385065_ssvid.net--Doremon-New-Latest-episode-in-HindiDoremon-New-Episode-In-Hindi_480p.mp4', 0),
(9, 4, '../thumbnail/1768388481_YO.png', 'T1', 'D1', '../course_videos/1768388481_ssvid.net--Doremon-New-Latest-episode-in-HindiDoremon-New-Episode-In-Hindi_480p.mp4', 1),
(10, 4, '../thumbnail/1768407591_Screenshot (14).png', 'T7', 'D7', '../course_videos/1768407591_videoplayback.mp4', 1),
(11, 7, '../thumbnail/1768572388_Screenshot (27).png', 'Video 1', 'Desc 1', '../course_videos/1768572388_watchanimeworld.mp4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `studentcourseregistered`
--

CREATE TABLE `studentcourseregistered` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentcourseregistered`
--

INSERT INTO `studentcourseregistered` (`id`, `course_id`, `user_id`) VALUES
(2, 1, 5),
(4, 4, 26),
(5, 2, 5),
(8, 6, 5),
(9, 2, 26);

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(200) NOT NULL,
  `project_owner_name` varchar(200) NOT NULL,
  `project_owner_email` varchar(200) NOT NULL,
  `project_owner_contact_no` varchar(200) NOT NULL,
  `project_owner_address` varchar(200) NOT NULL,
  `project_ra` varchar(200) NOT NULL,
  `project_login_d` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`project_id`, `project_name`, `project_owner_name`, `project_owner_email`, `project_owner_contact_no`, `project_owner_address`, `project_ra`, `project_login_d`) VALUES
(1, 'Student Skill Enhancement', 'Kshirsagar Ishwari Dattatraya', 'ishwarikshirsagar1234@gmail.com', '+919209547440', 'Dharashiv', '🚫 Admin Restricted Login Access', 'Login is currently disabled by administrator.');

-- --------------------------------------------------------

--
-- Table structure for table `users_database`
--

CREATE TABLE `users_database` (
  `user_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_type` int(11) NOT NULL,
  `phone_number` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `facebook` text NOT NULL,
  `instagram` text NOT NULL,
  `linkedin` text NOT NULL,
  `twitter` text NOT NULL,
  `github` text NOT NULL,
  `profile_information` text NOT NULL,
  `recent_activities` text NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_database`
--

INSERT INTO `users_database` (`user_id`, `name`, `email`, `password`, `user_type`, `phone_number`, `address`, `facebook`, `instagram`, `linkedin`, `twitter`, `github`, `profile_information`, `recent_activities`, `created_on`) VALUES
(1, 'Kshirsagar Ishwari Dattatraya', 'ishwarikshirsagar1234@gmail.com', 'ishwarikshirsagar1234@gmail.com', 1, '+919209547440', 'Dharashiv', 'https://www.facebook.com/share/1H2yUrdsxF/', 'https://www.instagram.com/yogeshkshirsagar_0001/', 'https://www.linkedin.com/in/yogesh-kshirsagar-838a2428b/', 'https://x.com/YogeshK11389', 'https://github.com/YoKshirsagar', 'Hello! I am Kshirsagar Yogesh Dattatraya, an enthusiastic developer and the admin of this Event Management System. With a keen interest in web development and programming, I am always eager to learn new technologies and improve my skills.Feel free to connect with me through my social media links. Let\'s collaborate and make great things happen!', 'Recently, I had the privilege of securing the 2nd place (Runner-up) in the Technical Event 2023 at Terna College of Engineering, Dharashiv, which was an incredible experience competing with talented peers and gaining valuable insights. Additionally, I completed a 6-session workshop on \"Essential Principles of Meaningful Life\" organized by the Personality Development Club at Government College of Engineering Chh. Sambhajinagar.', '2025-01-10 12:12:25'),
(4, 'Amruta Patil', 'patilamruta0000@gmail.com', 'patilamruta0000@gmail.com', 2, '+918669164306', 'Dharashiv', '', '', '', '', '', 'Hello! I am Om Shingare, an enthusiastic developer and one of the Organizer of this Event Management System.', '', '2025-01-10 14:54:49'),
(5, 'Ashwashradha Pawar', 'ashwashradhapawar@gmail.com', 'ashwashradhapawar@gmail.com', 3, '+919359777316', 'Jalgaon', '', '', '', '', '', '', '', '2025-01-10 14:56:17'),
(6, 'Ashwsandhya Pawar', 'ashwsandhyapawar@gmail.com', 'ashwsandhyapawar@gmail.com', 2, '+919529250152', 'Dharashiv', '', '', '', '', '', '', '', '2025-01-10 14:57:45'),
(16, 'Shlok Javheri', 'shlokjavheri@gmail.com', 'shlokjavheri@gmail.com', 2, '+918888888888', 'Dharashiv', '', '', '', '', '', '', '', '2025-01-12 14:16:51'),
(17, 'Vinod Kumar', 'vinodkumar@gmail.com', 'vinodkumar@gmail.com', 2, '+919999999999', 'Latur', '', '', '', '', '', '', '', '2025-01-12 14:21:47'),
(19, 'Tushar Gawande', 'tushargawande@gmail.com', 'tushargawande@gmail.com', 2, '+919022361966', 'Chhatrapati Sambhajinagar', '', '', '', '', '', '', '', '2025-02-20 14:08:06'),
(22, 'Kajal Patil', 'kajalpatil@gmail.com', 'kajalpatil@gmail.com', 2, '+916666666666', 'Mumbai', '', '', '', '', '', '', '', '2025-12-15 15:23:05'),
(26, 'Rupa', 'rupasharma@gmail.com', 'rupasharma@gmail.com', 3, '+918292829282', 'Solapur', '', '', '', '', '', '', '', '2025-12-19 22:37:42'),
(27, 'Sharma', 'sharma@gmail.com', 'sharma@gmail.com', 3, '+919999999999', 'Dharashiv', '', '', '', '', '', '', '', '2026-01-16 19:31:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `course_database`
--
ALTER TABLE `course_database`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `course_type` (`course_type`),
  ADD KEY `course_owner` (`course_owner`);

--
-- Indexes for table `course_type`
--
ALTER TABLE `course_type`
  ADD PRIMARY KEY (`course_type_id`);

--
-- Indexes for table `course_videos`
--
ALTER TABLE `course_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_course_videos_course` (`course_id`);

--
-- Indexes for table `studentcourseregistered`
--
ALTER TABLE `studentcourseregistered`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `users_database`
--
ALTER TABLE `users_database`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `course_database`
--
ALTER TABLE `course_database`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `course_type`
--
ALTER TABLE `course_type`
  MODIFY `course_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `course_videos`
--
ALTER TABLE `course_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `studentcourseregistered`
--
ALTER TABLE `studentcourseregistered`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_database`
--
ALTER TABLE `users_database`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_database` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `course_database`
--
ALTER TABLE `course_database`
  ADD CONSTRAINT `course_owner` FOREIGN KEY (`course_owner`) REFERENCES `users_database` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_type` FOREIGN KEY (`course_type`) REFERENCES `course_type` (`course_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_videos`
--
ALTER TABLE `course_videos`
  ADD CONSTRAINT `fk_course_videos_course` FOREIGN KEY (`course_id`) REFERENCES `course_database` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `studentcourseregistered`
--
ALTER TABLE `studentcourseregistered`
  ADD CONSTRAINT `course_id` FOREIGN KEY (`course_id`) REFERENCES `course_database` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users_database` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
