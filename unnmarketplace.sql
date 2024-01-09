-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2024 at 06:49 PM
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
-- Database: `unnmarketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `clientmessage`
--

CREATE TABLE `clientmessage` (
  `1d` int(11) NOT NULL,
  `name` text NOT NULL,
  `message` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `name` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `descp` text NOT NULL,
  `name` text NOT NULL,
  `type` tinytext NOT NULL,
  `date` date NOT NULL,
  `category` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_views_count` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `image`, `amount`, `descp`, `name`, `type`, `date`, `category`, `user_id`, `product_views_count`) VALUES
(156, '53651adac86627b.jpeg', 10000, 'sfff', 'irechukwu', '', '2023-10-02', '', 53, 1),
(157, '53651adb9a39da0.jpeg', 30000, 'cropped top with up to 10 different colors.', 'skirt', 'New', '2023-10-02', '', 53, 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` text NOT NULL,
  `number` text NOT NULL,
  `verifytoken` varchar(200) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `date` date NOT NULL,
  `link` varchar(100) NOT NULL,
  `location` mediumtext NOT NULL,
  `about` text NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `page_views_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `usertype`, `number`, `verifytoken`, `status`, `date`, `link`, `location`, `about`, `image`, `page_views_count`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$10jB2lupSfvAUfocjguzSeN95LkwgZJUM7aQBdb2Op7XzJ.BhNoHq', 'admin', '08104441382', '616d79fef786254e84a90efe5e2e5ec3', 1, '2023-02-07', '', '', 'The admin of unnmarketplace ', '63e3482d75b9b.jpg', 7),
(53, 'user', 'vendor@gmail.com', '$2y$10$10jB2lupSfvAUfocjguzSeN95LkwgZJUM7aQBdb2Op7XzJ.BhNoHq', 'vendor', '8104441382', '4ca96afe7ec79c2810fda060304e8e46', 1, '2023-03-02', '', 'hilltop', 'For the love of the community.', '651a9cf2e99d5.jpeg', 58);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientmessage`
--
ALTER TABLE `clientmessage`
  ADD PRIMARY KEY (`1d`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientmessage`
--
ALTER TABLE `clientmessage`
  MODIFY `1d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
