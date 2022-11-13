-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2022 at 04:31 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `sub_category` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `sub_category`, `status`) VALUES
(38, 'google', 0, 1),
(41, 'internet', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_price` double NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `products_ids` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `qty`, `total_price`, `status`, `date`, `user_id`, `products_ids`) VALUES
(179, 0, 1, 10, 0, '2022-09-22', 88, '{\"116\":{\"id\":116,\"quantity\":1,\"price\":10,\"name\":\"asdf\"}}');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`images`)),
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `discount` double NOT NULL DEFAULT 0,
  `description` text NOT NULL DEFAULT 'description of the product',
  `sizes` varchar(30) NOT NULL DEFAULT '["1","0","0","0"]',
  `rate` tinyint(1) NOT NULL DEFAULT 0,
  `category_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `quantity`, `price`, `images`, `status`, `discount`, `description`, `sizes`, `rate`, `category_id`, `date`) VALUES
(116, 'asdf', 1, 10, '[\"1172132_1939015.jpeg\",\"1835769_1673922.jpeg\",\"1263067_1055195.jpeg\",\"1133677_1210980.jpeg\"]', 0, 0, 'asdf', '[\"1\",\"0\",\"0\",\"0\"]', 0, 38, '2022-09-22 15:33:34');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user` varchar(30) NOT NULL DEFAULT '["0","0","0"]',
  `roles_s` varchar(30) NOT NULL DEFAULT '["0","0","0"]',
  `categories` varchar(30) NOT NULL DEFAULT '["0","0","0"]',
  `products` varchar(30) NOT NULL DEFAULT '["0","0","0"]',
  `orders` varchar(30) NOT NULL DEFAULT '["0","0","0"]',
  `db` varchar(30) NOT NULL DEFAULT '["0","0","0"]',
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `user`, `roles_s`, `categories`, `products`, `orders`, `db`, `date`) VALUES
(4, 'administrator', '[\"1\",\"1\",\"1\"]', '[\"1\",\"1\",\"1\"]', '[\"1\",\"1\",\"1\"]', '[\"1\",\"1\",\"1\"]', '[\"1\",\"1\",\"1\"]', '[\"1\",\"1\",\"1\"]', '2022-09-10 12:55:19'),
(13, 'client', '[\"0\",\"0\",\"0\"]', '[\"0\",\"0\",\"0\"]', '[\"0\",\"0\",\"0\"]', '[\"0\",\"0\",\"0\"]', '[\"0\",\"0\",\"0\"]', '[\"0\",\"0\",\"0\"]', '2022-09-15 16:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `google_id` bigint(22) DEFAULT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `password` varchar(64) CHARACTER SET utf8 NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `rule` int(11) NOT NULL,
  `code` varchar(6) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `expires` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `avatar` text DEFAULT 'avatar.png',
  `gender` varchar(8) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `city` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `second_email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `google_id`, `username`, `email`, `password`, `first_name`, `last_name`, `rule`, `code`, `verified`, `expires`, `status`, `avatar`, `gender`, `date`, `city`, `address`, `full_name`, `phone`, `second_email`) VALUES
(64, 9223372036854775807, '113272096707648888483', 'tammer2302@gmail.com', '24174111132720967076488884832898681', 'Mohamed', 'Attar', 4, '', 1, NULL, 2, '2642958_2219468.jpeg', NULL, '2022-09-16 14:40:48', '', '', '', '', ''),
(88, NULL, 'mohamedattar2302', 'mohammedattar0100020@gmail.com', '3e741a47a15a958555aa8b88dd4917a6d0c56372', 'asfd', 'asdf', 13, '199580', 1, '2022-09-22 14:42:48', 2, 'avatar.png', NULL, '2022-09-22 13:42:46', 'Alexandria', 'Alex', 'Alex', '01203137613', 'mohammedattar0100020@gmail.com'),
(90, NULL, 'admin@admin', 'admin@admin.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Admin', NULL, 4, '', 1, NULL, 2, 'avatar.png', NULL, '2022-09-22 16:30:43', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `status` (`status`),
  ADD KEY `userid` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `quantity` (`quantity`),
  ADD KEY `price` (`price`),
  ADD KEY `cat_id` (`category_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `roles` (`rule`),
  ADD KEY `google_id` (`google_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `cat_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `roles` FOREIGN KEY (`rule`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
