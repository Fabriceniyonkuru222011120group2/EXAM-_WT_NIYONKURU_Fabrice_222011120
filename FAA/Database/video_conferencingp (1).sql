-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 09:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `video_conferencingp`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE `attendees` (
  `attendee_id` int(11) NOT NULL,
  `meeting_id` int(11) DEFAULT NULL,
  `attendee_name` varchar(255) DEFAULT NULL,
  `join_time` datetime DEFAULT NULL,
  `leave_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendees`
--

INSERT INTO `attendees` (`attendee_id`, `meeting_id`, `attendee_name`, `join_time`, `leave_time`) VALUES
(1, 1, 'bizzy', '2024-05-08 17:14:00', '2024-05-08 17:59:00'),
(2, 1, 'kim', '2024-05-17 20:13:00', '2024-05-17 08:13:00'),
(3, 1, 'ruth', '2024-05-17 20:19:00', '2024-05-17 20:19:00'),
(4, 2, 'james', '2024-05-22 11:09:00', '2024-05-22 23:09:00'),
(5, 2, 'mellisa', '2024-05-22 12:45:00', '2024-05-22 00:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `chatlogs`
--

CREATE TABLE `chatlogs` (
  `log_id` int(11) NOT NULL,
  `message_id` int(11) DEFAULT NULL,
  `sender_name` varchar(255) DEFAULT NULL,
  `meeting_id` int(11) DEFAULT NULL,
  `message_content` text DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chatlogs`
--

INSERT INTO `chatlogs` (`log_id`, `message_id`, `sender_name`, `meeting_id`, `message_content`, `timestamp`) VALUES
(1, 1, 'BENN', 1, 'helloo', '2024-05-08 17:09:00'),
(2, 2, 'kim', 2, 'thank you', '2024-05-09 09:27:00'),
(3, 3, 'hakim', 1, 'see you then', '2024-05-13 11:53:00'),
(4, 4, 'pelly', 5, 'meet at 10', '2024-05-13 19:28:00'),
(5, 5, 'merry', 1, 'how are you', '2024-05-17 19:34:00'),
(6, 6, 'john', 5, 'miss you', '2024-05-17 20:44:00'),
(7, 7, 'uwase', 2, 'how are you doing', '2024-05-22 15:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `meeting_id` int(11) DEFAULT NULL,
  `participant_name` varchar(255) DEFAULT NULL,
  `feedback_rating` int(11) DEFAULT NULL,
  `feedback_comment` text DEFAULT NULL,
  `feedback_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `meeting_id`, `participant_name`, `feedback_rating`, `feedback_comment`, `feedback_time`) VALUES
(1, 1, 'kim', 5, 'thank you for hosting us', '2024-05-10 16:22:00'),
(2, 1, 'peter', 3, 'you did well', '2024-05-09 09:43:00'),
(3, 2, 'mikeson', 3, 'not bad', '2024-05-22 15:01:00');

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE `invitations` (
  `invitation_id` int(11) NOT NULL,
  `sender_name` varchar(255) DEFAULT NULL,
  `recipient_name` varchar(255) DEFAULT NULL,
  `meeting_id` int(11) DEFAULT NULL,
  `invitation_status` varchar(250) DEFAULT NULL,
  `invitation_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invitations`
--

INSERT INTO `invitations` (`invitation_id`, `sender_name`, `recipient_name`, `meeting_id`, `invitation_status`, `invitation_time`) VALUES
(1, '0', 'fabrice', 1, 'pending', '2024-05-08 17:10:00'),
(2, '0', 'perry', 1, 'confirmed', '2024-05-17 19:35:00'),
(3, '0', 'kim', 2, 'pending', '2024-05-22 13:31:00'),
(4, '0', 'ken', 2, 'canceled', '2024-05-22 13:48:00'),
(5, '0', 'ken', 2, 'comfirmed', '2024-05-22 13:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `meeting_id` int(11) NOT NULL,
  `host_name` varchar(255) DEFAULT NULL,
  `topic` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `status` char(250) DEFAULT NULL,
  `password_protected` tinyint(1) DEFAULT NULL,
  `max_attendees` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`meeting_id`, `host_name`, `topic`, `description`, `start_time`, `end_time`, `duration`, `status`, `password_protected`, `max_attendees`) VALUES
(1, 'fabrice', 'environmental protection', 'it all about sorroundings', '2024-05-08 18:16:00', '2024-05-08 21:16:00', 3, '1', 1, 20),
(2, 'sam', 'economic integration', 'it\'s abount international relation', '2024-05-08 16:21:00', '2024-05-22 16:24:00', 2, '1', 2, 200),
(4, 'melissa', 'environmental protection', 'livingthings', '2024-05-18 13:49:00', '2024-04-09 13:49:00', 3, '0', 1, 54),
(5, 'paul', 'legal environment in business', 'how rules are applied in society', '2024-05-22 13:28:00', '2024-05-22 01:28:00', 54, '1', 2, 79),
(6, 'merry', 'rwandan culture', 'culture aspect', '2024-05-22 15:43:00', '2024-05-22 03:44:00', 12, '1', 4, 75);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `participant_name` varchar(255) DEFAULT NULL,
  `notification_content` varchar(255) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `read_status` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `participant_name`, `notification_content`, `timestamp`, `read_status`) VALUES
(1, 'john', 'let meet next', '2024-05-08 17:13:00', 'r'),
(2, 'betty', 'i wish i should stay with you , you have good hospitality', '2024-05-18 20:28:00', 'u'),
(3, 'kubwimana jada junior', 'thank you', '2024-05-18 20:29:00', 'r'),
(4, 'orutegha', 'congraturations', '2024-05-22 14:56:00', 'u');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `participant_id` int(11) NOT NULL,
  `meeting_id` int(11) DEFAULT NULL,
  `participant_name` varchar(255) DEFAULT NULL,
  `join_time` datetime DEFAULT NULL,
  `leave_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`participant_id`, `meeting_id`, `participant_name`, `join_time`, `leave_time`) VALUES
(1, 1, 'john', '2024-05-08 16:25:00', '2024-05-05 16:57:00'),
(2, 1, 'peter', '2024-05-08 16:28:00', '2024-05-08 16:57:00'),
(3, 1, 'sandra', '2024-05-13 11:51:00', '2024-05-13 23:51:00'),
(4, 2, 'linda', '2024-05-17 19:31:00', '2024-05-17 07:31:00');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permission_id` int(11) NOT NULL,
  `participant_name` varchar(255) DEFAULT NULL,
  `meeting_id` int(11) DEFAULT NULL,
  `permission_type` varchar(250) DEFAULT NULL,
  `granted_by_user_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permission_id`, `participant_name`, `meeting_id`, `permission_type`, `granted_by_user_name`) VALUES
(1, 'john', 1, 'co_host', 'fabrice'),
(2, 'maurice', 2, 'attendee', 'hackris'),
(3, 'sandra', 2, 'host', 'paul'),
(4, 'mike', 2, 'co_host', 'fabrice');

-- --------------------------------------------------------

--
-- Table structure for table `recording`
--

CREATE TABLE `recording` (
  `recording_id` int(11) NOT NULL,
  `meeting_id` int(11) DEFAULT NULL,
  `recording_url` varchar(255) DEFAULT NULL,
  `recording_start_time` datetime DEFAULT NULL,
  `recording_end_time` datetime DEFAULT NULL,
  `recording_duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recording`
--

INSERT INTO `recording` (`recording_id`, `meeting_id`, `recording_url`, `recording_start_time`, `recording_end_time`, `recording_duration`) VALUES
(1, 1, 'http', '2024-05-08 17:19:00', '2024-05-08 17:59:00', 38),
(2, 1, 'swa', '2024-05-13 11:52:00', '2024-05-13 23:52:00', 12),
(3, 2, 'http', '2024-05-17 19:31:00', '2024-05-17 07:32:00', 50),
(4, 2, 'http', '2024-05-22 12:32:00', '2024-05-22 00:32:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `setting_id` int(11) NOT NULL,
  `participant_name` varchar(255) DEFAULT NULL,
  `meeting_id` int(11) DEFAULT NULL,
  `setting_name` varchar(255) DEFAULT NULL,
  `setting_value` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `participant_name`, `meeting_id`, `setting_name`, `setting_value`) VALUES
(1, 'peter', 1, 'talk', 'T'),
(2, 'moise', 2, 'read', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `activation_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`firstname`, `lastname`, `email`, `username`, `password`, `telephone`, `activation_code`) VALUES
('niyonkuru', 'fabrice', 'fabriceniyo@gmail.com', 'fabrice', '$2y$10$h8GJ3i4VSsN45qVK/KN8w.inefHSaat/dF.GtjkMAU0UBbqdW.Kba', '1234567890', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendees`
--
ALTER TABLE `attendees`
  ADD PRIMARY KEY (`attendee_id`),
  ADD KEY `meeting_id` (`meeting_id`);

--
-- Indexes for table `chatlogs`
--
ALTER TABLE `chatlogs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `meeting_id` (`meeting_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `meeting_id` (`meeting_id`);

--
-- Indexes for table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`invitation_id`),
  ADD KEY `meeting_id` (`meeting_id`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`meeting_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`participant_id`),
  ADD KEY `meeting_id` (`meeting_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`),
  ADD KEY `meeting_id` (`meeting_id`);

--
-- Indexes for table `recording`
--
ALTER TABLE `recording`
  ADD PRIMARY KEY (`recording_id`),
  ADD KEY `meeting_id` (`meeting_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`setting_id`),
  ADD KEY `meeting_id` (`meeting_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendees`
--
ALTER TABLE `attendees`
  ADD CONSTRAINT `attendees_ibfk_1` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`meeting_id`);

--
-- Constraints for table `chatlogs`
--
ALTER TABLE `chatlogs`
  ADD CONSTRAINT `chatlogs_ibfk_1` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`meeting_id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`meeting_id`);

--
-- Constraints for table `invitations`
--
ALTER TABLE `invitations`
  ADD CONSTRAINT `invitations_ibfk_1` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`meeting_id`);

--
-- Constraints for table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participants_ibfk_1` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`meeting_id`);

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_ibfk_1` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`meeting_id`);

--
-- Constraints for table `recording`
--
ALTER TABLE `recording`
  ADD CONSTRAINT `recording_ibfk_1` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`meeting_id`);

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_ibfk_1` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`meeting_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
