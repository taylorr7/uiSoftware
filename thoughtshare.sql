-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2016 at 08:53 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thoughtshare`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `courseid` int(11) NOT NULL,
  `commenterid` int(11) NOT NULL,
  `content` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `courseid`, `commenterid`, `content`, `timestamp`) VALUES
(1, 1, 2, 'Howdy!', '2016-11-07 18:36:56'),
(2, 1, 2, 'This is cool', '2016-11-07 18:57:03'),
(3, 1, 2, 'Test', '2016-11-07 19:00:25'),
(4, 1, 3, 'adsofijsdf', '2016-11-07 19:11:20'),
(5, 2, 3, 'hi\n', '2016-11-10 17:33:43');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `coursename` varchar(30) NOT NULL,
  `coursedescription` text NOT NULL,
  `coursecontent` text NOT NULL,
  `published` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `userid`, `coursename`, `coursedescription`, `coursecontent`, `published`) VALUES
(1, 2, 'Calculus 1', 'This course is an introduction to calculus. The course begins with a review of functions and basic arithmetic then transitions into an introduction to limits. Derivatives are then introduced and their applications are studied. The course ends with a brief introduction to anti-derivatives and definite integrals.', '~CHAPTER:name-Derivatives:~\r\n\r\n~LESSON:name-Power Rule:~', 1),
(2, 3, 'Calculus 2', 'This course is an introduction to integral calculus. The course begins with a review of antiderivatives then transitions into an introduction to definite integrals. Indefinite integrals are then introduced and their applications are studied. The course ends with a brief introduction to summations and infinite series.', '~CHAPTER:name-Chapter 1:~\r\n~LESSON:name-Product Rule:~\r\n~LESSON:name-Chain Rule:~', 1),
(3, 3, 'My Other Calculus Course', 'This is just a copy of the same course.', '~CHAPTER:name-Chapter 1:~\r\n~LESSON:name-Product Rule:~\r\n~LESSON:name-Chain Rule:~', 1),
(4, 4, 'Course I Am Working On', 'This is a course I am still working on so it shouldn''t be published!', '\r\n~LESSON:name-Quotient Rule:~', 0),
(5, 2, 'Test1', 'This be a test', 'Hi', 0);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `eventtypeid` int(11) NOT NULL,
  `user1id` int(11) NOT NULL,
  `user2id` int(11) DEFAULT NULL,
  `data` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `eventtypeid`, `user1id`, `user2id`, `data`, `timestamp`) VALUES
(1, 2, 2, NULL, 5, '2016-11-05 18:45:59'),
(4, 3, 2, NULL, 8, '2016-11-05 23:12:46'),
(5, 4, 2, NULL, 8, '2016-11-05 23:18:16'),
(6, 6, 2, 2, NULL, '2016-11-07 17:41:52'),
(16, 6, 2, 3, NULL, '2016-11-07 18:05:16'),
(17, 6, 2, 3, NULL, '2016-11-07 18:05:19'),
(18, 6, 2, 3, NULL, '2016-11-07 18:08:35'),
(19, 6, 2, 3, NULL, '2016-11-07 18:08:37'),
(20, 6, 2, 3, NULL, '2016-11-07 18:08:41'),
(21, 6, 2, 3, NULL, '2016-11-07 18:36:33'),
(22, 6, 2, 3, NULL, '2016-11-07 18:36:35'),
(23, 5, 2, 2, 1, '2016-11-07 18:36:56'),
(24, 5, 2, 2, 2, '2016-11-07 18:57:03'),
(25, 5, 2, 2, 3, '2016-11-07 19:00:25'),
(26, 5, 3, 2, 4, '2016-11-07 19:11:21'),
(27, 6, 3, 2, NULL, '2016-11-10 15:59:39'),
(28, 6, 3, 4, NULL, '2016-11-10 16:30:50'),
(29, 5, 3, 3, 5, '2016-11-10 17:33:43'),
(30, 4, 2, NULL, 1, '2016-11-14 19:52:06'),
(31, 4, 2, NULL, 1, '2016-11-14 19:52:49');

-- --------------------------------------------------------

--
-- Table structure for table `event_types`
--

CREATE TABLE `event_types` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_types`
--

INSERT INTO `event_types` (`id`, `name`) VALUES
(1, 'new_course'),
(2, 'edit_course'),
(3, 'new_lesson'),
(4, 'edit_lesson'),
(5, 'course_comment'),
(6, 'subscribe');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `lessonname` varchar(30) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `userid`, `lessonname`, `content`) VALUES
(1, 2, 'Power Rule', 'The Power Rule is a useful tool for determining the derivatives of functions. The rule itself is simple, given any function of the form f(x) = x^c, we can evaluate its derivative to be f-(x) = c x^(c-1). As an example, consider f(x) = x^2. We can use the Power Rule to quickly evaluate its derivative as f-(x) = 2x. \r\n\r\n~IMAGE:url-&lt;BASE_URL&gt;/public/media/mapleGraph.png:~ \r\n\r\nAs you can see from the graph, the function and its derivative are related. As the slope of the function increases, the value of the derivative increases as well. \r\n\r\n~QUIZ:name-What is the derivative of 6x^2?:answer-24x:correctAnswer-12x:answer-6x:answer-6:~'),
(4, 2, 'New Lesson', 'Let us make a new lesson.'),
(5, 3, 'Product Rule', 'If you define a function f as the product of two functions, g and h, you can define the derivative of f or f'' as (g'')h + g(h'').\r\n\r\n\r\n~QUIZ:name-What is the derivative of xcos(x)?:answer-cos(x):correctAnswer-cos(x) - xsin(x):answer-4:~\r\n'),
(6, 3, 'Chain Rule', 'To find the derivative of a function f, defined as the composition of two functions, g and h, we define f'' as g''(h)*h''.\r\n\r\n\r\n~QUIZ:name-What is the derivative of cos(x^2)?:answer-14:correctAnswer--2xsin(x^2):~\r\n\r\nThis is the chain rule of derivatives :)'),
(7, 4, 'Quotient Rule', 'For a function f, defined as the quotient of two functions g and h, we define the derivative of f, or f'' as [g''(h) - g(h'')] / [h^2].'),
(8, 2, 'Algebra', '1+1=2\r\n\r\n~QUIZ:name-What is 1+2?:answer-2:correctAnswer-3:answer-4:~\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `user1id` int(11) NOT NULL,
  `user2id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `user1id`, `user2id`) VALUES
(1, 3, 2),
(2, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` enum('unregistered','registered','admin') NOT NULL DEFAULT 'registered',
  `namefirst` varchar(20) NOT NULL,
  `namelast` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(45) NOT NULL,
  `education_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `namefirst`, `namelast`, `username`, `password`, `email`, `education_type`) VALUES
(2, 'registered', 'Taylor', 'Rydahl', 'taylorr7', 'password', 'taylorr7@vt.edu', 'md'),
(3, 'registered', 'John', 'Smith', 'jsmith', 'password', 'bob@gmail.com', 'bd'),
(4, 'registered', 'Jane', 'Smith', 'jsmith2', 'password', 'jsmith2@gmail.com', 'dd'),
(5, 'registered', 'John', 'Man', 'johnm', 'pass', 'johnm@gmail.com', 'no'),
(6, 'admin', 'Admin', 'Istrator', 'admin', 'admin', 'admin@istrator.com', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_types`
--
ALTER TABLE `event_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `event_types`
--
ALTER TABLE `event_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
