-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2023 at 09:22 PM
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
(157, '53651adb9a39da0.jpeg', 30000, 'cropped top with up to 10 different colors.', 'skirt', 'New', '2023-10-02', '', 53, 6);

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
(1, 'Truth', 'irechukwutruth1@gmail.com', '$2y$10$Iqw0XOUe5EHOSg/RKHZvBuy/.wtGKBMiv3ta8oSolWy7xCv4GVxEy', 'admin', '08104441382', '616d79fef786254e84a90efe5e2e5ec3', 1, '2023-02-07', '', '', 'The admin of unnmarketplace ', '63e3482d75b9b.jpg', 7),
(53, 'Ireh', 'irechukwuchukwuka@gmail.com', '$2y$10$HfebA6jBYdbiSaI9yFCYoOW2YzpagNnieyYv980Eg155XoSnDqjaq', 'vendor', '8104441382', '4ca96afe7ec79c2810fda060304e8e46', 1, '2023-03-02', '', 'hilltop', 'For the love of the community.', '651a9cf2e99d5.jpeg', 58),
(63, 'Enwerem Patrick', 'enweremeric9@gmail.com', '$2y$10$X/M0k/jrXWZ40RyVbdX1BORGvhgukYNQvFY8pEiKGkFQf4Bn0gj/2', 'vendor', '9013684550', 'ae90d091a294e09b2d0d0309ddfa6ad6', 1, '2023-03-21', '', '', '', NULL, 4),
(64, 'Fgg hu', 'paulginika01@gmail.com', '$2y$10$4n3gjWVZpqoWPf3sI4ZSEe3XV7JQT87ucGvMGD9iyEx7n.FKvS1bu', 'vendor', '8107632512', 'a59910d7f9c5cfe8187aaf5f420bae73', 1, '2023-03-22', '', '', '', NULL, 2),
(65, 'Pleasant', 'eze.pleasant001@gmail.com', '$2y$10$4bFx1Fxsy/guMZVrpwVPcu9IUmxtHyC5JhSuvl17t9jy2qyoM4D8a', 'vendor', '8107650350', 'd659d767ea0b5db4618578bf0e82dc88', 1, '2023-03-22', '', '', '', NULL, 32),
(66, 'Obeta Emmanuel', 'obetaemmanuel123@gmail.com', '$2y$10$d1.ThruityCeDuQsqWO8peY6dDm7U1jmJFVyOp7GDelZYmdOFPLfm', 'vendor', '9029170724', 'b20b06ec068d4bf4c4f8fd9aa865607c', 1, '2023-03-22', '', '', '', NULL, 2),
(67, 'Obinna', 'igedeobinna81@gmail.com', '$2y$10$UYDxsPYcjuY9qpP.8SVPX.SGHvoxuU1K1Ir2oWbwfhYWgH6s.uVhS', 'vendor', '8137372305', '5130991165efb8c1f5b7bda4496a40cb', 1, '2023-03-22', '', '', '', NULL, 2),
(68, 'Aniedu Chisom', 'anieduchisom23@gmail.com', '$2y$10$JEp3mSJCglTzHnRcwZwkb.QPSzzQXJ/hivDophLfbQYDHMTaFALlq', 'vendor', '9086119929', 'c76613dc8b5ba317f28515f95fe26a9a', 0, '2023-03-22', '', '', '', NULL, 0),
(69, 'Nkemdilim perpetual ugwu', 'dnkem114@gmail.com', '$2y$10$D5QyV/9fO83tSns1d1zEY.1wHIlKxj85qS27uyQGCYTYYuodWE.dS', 'vendor', '9067648739', '7b0af93c510eccea50524c00540bdefc', 1, '2023-03-24', '', '', '', NULL, 4),
(70, 'Anastacia', 'anastaciamba27@gmail.com', '$2y$10$fvB0wYii7w/7OewVS2xikeLvx7/HO6HD3DiMYQ5m5H1VUGkqZDrXa', 'vendor', '8067874291', '57ced4dc0773b42c59c61fff32a72df1', 1, '2023-03-27', '', '', '', NULL, 1),
(71, 'David', 'david_umanah@yahoo.com', '$2y$10$dMG1ayJ3bsw5SfpTpnrGWeTIvjQNVfxNZgYhPlcA0XkSW3EZ/Sm8W', 'vendor', '9043678780', '98a87b55e41dece0f5541e34f9dbb8fd', 1, '2023-04-02', '', '', '', NULL, 1),
(72, 'Ceejay', 'cjkanu1@gmail.com', '$2y$10$wSbk1e4vXrQJOHCm7ZZ.DuB7PtbZcg.Q/sTk6Rpc/N5tpMBlfFZKO', 'vendor', '8124190203', '15160b64d4a17736f0f7747ae25441ec', 0, '2023-05-30', '', '', '', NULL, 0),
(73, 'Prince', 'aniprince442@gmail.com', '$2y$10$zwMii3YT8eNau75F0oI2z.8GO.MiuVlw/m3ImXeLPyb6MplLDJhSW', 'vendor', '7068238318', 'bf834f17dcb097d0b571da9b01d81f39', 0, '2023-08-02', '', '', '', NULL, 0);

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
