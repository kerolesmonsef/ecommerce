-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2018 at 12:44 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` smallint(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `ordiring` int(11) NOT NULL,
  `visiblity` tinyint(1) NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) NOT NULL DEFAULT '0',
  `allow_adds` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `ordiring`, `visiblity`, `allow_comment`, `allow_adds`) VALUES
(3, 'menoliza', '02132', 3210, 0, 0, 1),
(5, 'Electronics', '', 3, 0, 0, 0),
(8, 'new part', 'this is new part', 12, 1, 0, 0),
(11, 'toys', 'this is a description', 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `country` int(11) NOT NULL,
  `image` blob NOT NULL,
  `status` varchar(255) NOT NULL,
  `rating` smallint(6) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date` date NOT NULL,
  `groupid` tinyint(1) NOT NULL DEFAULT '0',
  `truststatus` tinyint(1) NOT NULL DEFAULT '0',
  `fallname` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `regstatus` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `date`, `groupid`, `truststatus`, `fallname`, `regstatus`) VALUES
(2, 'keroles123', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', 'koko@koko.com', '2018-03-14', 1, 0, 'keroles monsef123', 1),
(13, 'keroles1', '1885361b50bd0ab9abf80c3a1d4d7d5455fddd36', 'kjljk@idhkd.fflkj', '2018-03-03', 0, 0, 'jfkfkjhfkj kjf', 0),
(14, 'keroles', '1885361b50bd0ab9abf80c3a1d4d7d5455fddd36', 'kdjkjc@lkfjk.flfj', '2018-03-03', 0, 0, 'dlkdj kh', 0),
(16, 'koko', '1885361b50bd0ab9abf80c3a1d4d7d5455fddd36', 'fhfijh@kdjfk.fkfh', '2018-03-04', 0, 0, 'kfjhf jh', 0),
(17, 'noran', 'f3b4db404e248ed61d13e47781c52111d1eb28d2', 'dlkj', '2018-03-15', 0, 0, ';;klk;l ;lk ;l', 0),
(19, 'noran1', 'f3b4db404e248ed61d13e47781c52111d1eb28d2', 'dlkj', '2018-03-15', 0, 0, ';;klk;l ;lk ;l', 0),
(20, 'noran2', 'f3b4db404e248ed61d13e47781c52111d1eb28d2', 'dlkj', '2018-03-15', 0, 0, ';;klk;l ;lk ;l', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
