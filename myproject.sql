-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2023 at 08:39 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `salt`, `created_at`) VALUES
(1, '', '', 'test', 'test@gmail.com', '$2y$10$G9JYGAKKaqCaaqF6C757vudCIAo9iTJZRl63xDtVGdt7ejgQ4GH5K', 'c75b8e14180ed857aab6fc09ad70502b', '2023-03-14 14:05:11'),
(2, '', '', 'test1', 'test1@gmail.com', '$2y$10$XEE9QYAbUwW1fD1LZ8tsu.WvgfLTf4dKmUB.jCdqA44B9S3/s2Mr2', '7ff135b48b89b3e01ef2acf6a49f79c1', '2023-03-16 08:50:13'),
(3, '', '', 'fds', 'sdf@gmail.com', '$2y$10$8jDinbSplHU/phujE/ymgumikbgDfIaa0mZR0SxpcdU4Ft3Pw4j1m', '18d0451f22a3c9c3d6f2aa2e8b304f81', '2023-03-16 09:49:50'),
(4, '', '', 'fds', 'sdf@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$Wnc5U0tZdEFLQWhvZmtGcw$2u/fPz3MHahEHeHLUp2O0YAAcX5WmwjGcZm0+pZn+SM', '65b4faf5cfdf7b49545b0f1506a2a956', '2023-03-16 09:50:29'),
(5, '', '', '1111', 'sdf@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$dEZobmtZcmt3VU5vS2U3cA$8jTD9pUcA/mp9GoIj04ok3mTUgqB6/YM9EVNB473tcQ', '89f99e62697d567a87b97422277d3612', '2023-03-16 09:50:47');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role`) VALUES
(1, 1, 'user'),
(2, 2, 'user'),
(3, 3, 'user'),
(4, 4, 'user'),
(5, 5, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
