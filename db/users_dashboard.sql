-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2023 at 09:58 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users_dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `created`, `modified`, `last_login`) VALUES
(1, 'Gamal Nasser', 'gamal@mail.com', '$2y$10$mIZfOctN7LUa1XYi/bOqKu9xOiqOflkUDE0nn00sdGeAqgaXEEU5e', '9659883452', '2023-03-13 22:56:56', NULL, '2023-03-14 09:57:16'),
(2, 'Amr Saad', 'amr@mail.com', '$2y$10$qxBbb3RtAW82K4i2ZOv7s.7wssem5H30xzGHAw4Els4.56x3kF0NC', '9659882552', '2023-03-13 22:56:56', NULL, '2023-03-16 07:45:49'),
(3, 'Hamza Ahmed', 'hamza@mail.com', '$2y$10$76hexJY5DFtB5xxbid8Yo.6sna6M8oF1jiInyCPfyxJw8TbcxP75u', '9659442552', '2023-03-13 22:56:56', NULL, '2023-03-14 07:15:23'),
(4, '3esam rady', '3esam@mail.com', '$2y$10$tnnwMphsrmKhvRGOiv97OOc8yiGz3F8/cJs6yuzWWEN7Su/dg9RMW', '9659112552', '2023-03-13 22:56:56', NULL, '2023-03-15 08:35:34'),
(5, 'Malik Saad', 'Malik@mail.com', '$2y$10$qxBbb3RtAW82K4i2ZOv7s.7wssem5H30xzGHAw4Els4.56x3kF0NC', '9659882552', '2023-03-13 22:56:56', NULL, '2023-03-14 07:45:49'),
(6, 'Ahmed ali', 'Ahmed@mail.com', '$2y$10$tnnwMphsrmKhvRGOiv97OOc8yiGz3F8/cJs6yuzWWEN7Su/dg9RMW', '9659112552', '2023-03-13 22:56:56', NULL, '2023-03-15 08:35:34'),
(7, 'Younes gamal', 'Younes@mail.com', '$2y$10$qxBbb3RtAW82K4i2ZOv7s.7wssem5H30xzGHAw4Els4.56x3kF0NC', '9659882552', '2023-03-13 22:56:56', NULL, '2023-03-13 10:45:49'),
(8, 'Ahmed adel', 'Ahmed@mail.com', '$2y$10$qxBbb3RtAW82K4i2ZOv7s.7wssem5H30xzGHAw4Els4.56x3kF0NC', '9659882552', '2023-03-13 22:56:56', NULL, '2023-03-14 07:45:49'),
(9, 'Safy khalil', 'Safy@mail.com', '$2y$10$qxBbb3RtAW82K4i2ZOv7s.7wssem5H30xzGHAw4Els4.56x3kF0NC', '9659882552', '2023-03-13 22:56:56', NULL, '2023-03-14 07:45:49'),
(10, 'Mahmoud mohamed', 'Mahmoud@mail.com', '$2y$10$qxBbb3RtAW82K4i2ZOv7s.7wssem5H30xzGHAw4Els4.56x3kF0NC', '9659882552', '2023-03-13 22:56:56', NULL, '2023-03-13 12:45:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
