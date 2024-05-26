-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2024 at 08:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `only_pans_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `follower_id` bigint(20) NOT NULL,
  `followed_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`follower_id`, `followed_id`) VALUES
(2331851448713158, 401277857),
(2331851448713158, 868276548);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(19) NOT NULL,
  `postid` bigint(19) NOT NULL,
  `userid` bigint(19) NOT NULL,
  `post` text NOT NULL,
  `comments` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `postid`, `userid`, `post`, `comments`, `likes`, `date`) VALUES
(34, 743270828322, 2331851448713158, 'Hi I am Marko', 0, 0, 0),
(35, 673321550, 2331851448713158, 'Follow me for more content!', 0, 0, 0),
(36, 804135556779578, 5421374834, 'HI, I am Roki nice meeting you all.', 0, 0, 0),
(37, 11053527, 5421374834, 'I have nothing on my mind', 0, 0, 0),
(38, 37231, 5421374834, 'hi i am marko', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(19) NOT NULL,
  `userid` bigint(19) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `url_address` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userid`, `first_name`, `last_name`, `email`, `password`, `url_address`, `date`) VALUES
(1, 2331851448713158, 'Danilo', 'Daco', 'mvuckovic2003@gmail.com', 'Oktoih2003', 'danilo.daco', '2024-05-26 14:20:44'),
(2, 401277857, 'Kiki', 'Riki', 'kiki@gmail.com', 'kiki5', 'kiki.riki', '2024-05-26 14:21:15'),
(3, 868276548, 'Dejo', 'Curov', 'dejo@gmail.com', 'dejo5', 'dejo.curov', '2024-05-26 14:21:54'),
(7, 5421374834, 'Marko', 'Vuckovic', 'roki@gmail.com', 'roki5', 'marko.vuckovic', '2024-05-26 17:45:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postid` (`postid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `comments` (`comments`),
  ADD KEY `likes` (`likes`),
  ADD KEY `date` (`date`);
ALTER TABLE `posts` ADD FULLTEXT KEY `post` (`post`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `first_name` (`first_name`),
  ADD KEY `last_name` (`last_name`),
  ADD KEY `email` (`email`),
  ADD KEY `password` (`password`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(19) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(19) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
