-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2016 at 05:42 PM
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
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `coursename` varchar(30) NOT NULL,
  `coursedescription` text NOT NULL,
  `coursecontent` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `userid`, `coursename`, `coursedescription`, `coursecontent`) VALUES
(1, 2, 'Calculus 1', 'This course is an introduction to calculus. The course begins with a review of functions and basic arithmetic then transitions into an introduction to limits. Derivatives are then introduced and their applications are studied. The course ends with a brief introduction to anti-derivatives and definite integrals.', '~CHAPTER:name-Derivatives:~\r\n\r\n~LESSON:name-Power Rule:~'),
(2, 3, 'Calculus 2', 'This course is an introduction to integral calculus. The course begins with a review of antiderivatives then transitions into an introduction to definite integrals. Indefinite integrals are then introduced and their applications are studied. The course ends with a brief introduction to summations and infinite series.', '');

-- --------------------------------------------------------

--
-- Table structure for table `hidden_courses`
--

CREATE TABLE `hidden_courses` (
  `id` int(11) NOT NULL,
  `courseid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hidden_courses`
--

INSERT INTO `hidden_courses` (`id`, `courseid`) VALUES
(18, 1);

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
(1, 2, 'Power Rule', 'The Power Rule is a useful tool for determining the derivatives of functions. The rule itself is simple, given any function of the form f(x) = x^c, we can evaluate its derivative to be f-(x) = c x^(c-1). As an example, consider f(x) = x^2. We can use the Power Rule to quickly evaluate its derivative as f-(x) = 2x. \r\n\r\n~IMAGE:url-&lt;BASE_URL&gt;.-/public/media/mapleGraph.png-:~ \r\n\r\nAs you can see from the graph, the function and its derivative are related. As the slope of the function increases, the value of the derivative increases as well. \r\n\r\n~QUIZ:name-What is the derivative of 6x^2?:answer-24x:correctAnswer-12x:answer-6x:answer-6:~'),
(4, 2, 'New Lesson', 'Let us make a new lesson.');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `courseid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `userid`, `courseid`) VALUES
(1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `namefirst` varchar(20) NOT NULL,
  `namelast` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `namefirst`, `namelast`, `username`, `password`, `email`) VALUES
(2, 'Taylor', 'Rydahl', 'taylorr7', 'password', 'taylorr7@vt.edu'),
(3, 'John', 'Smith', 'jsmith', 'password', 'jsmith@gmail.com'),
(4, 'jane', 'smith', 'jsmith2', 'password', 'jsmith2@gmail.com'),
(5, 'John', 'Man', 'johnm', 'pass', 'johnm@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hidden_courses`
--
ALTER TABLE `hidden_courses`
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
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `hidden_courses`
--
ALTER TABLE `hidden_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
