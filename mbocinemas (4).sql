-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 24, 2025 at 11:34 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mbocinemas`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `movie_id` int NOT NULL,
  `show_time` varchar(20) NOT NULL,
  `num_tickets` int NOT NULL,
  `booking_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `movie_id`, `show_time`, `num_tickets`, `booking_date`) VALUES
(6, 10, 1, '10:15', 1, '2025-01-24 11:10:55'),
(7, 14, 1, '15:00', 1, '2025-01-24 11:13:24'),
(9, 10, 1, '10:15', 1, '2025-01-24 11:26:32');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `rating` float NOT NULL,
  `duration` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `locations` varchar(255) NOT NULL,
  `times` varchar(255) NOT NULL,
  `imageUrl` varchar(512) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `genre`, `rating`, `duration`, `description`, `locations`, `times`, `imageUrl`, `created_at`) VALUES
(1, 'Inside Out 2', 'Animation', 4.4, '1h 40m', 'Riley is a teenager now, and her emotions are more complicated than ever.', 'amsterdam,den-haag', '10:15,12:30,15:00,17:15', '../MBO-Cinemas/images/inside out 2 image.jpg', '2024-12-20 13:17:51'),
(2, 'Furiosa: A Mad Max Saga', 'Action', 4.8, '2h 15m', 'The origin story of the mighty warrior Furiosa.', 'den-haag,amsterdam', '11:00,14:00,17:00,20:00', '../MBO-Cinemas/images/furiosa image.jpg', '2024-12-20 13:17:51'),
(4, 'Kingdom of the Planet of the Apes', 'Sci-Fi', 4.6, '2h 25m', 'The next chapter in the Planet of the Apes saga.', 'amsterdam,rotterdam', '12:00,15:30,19:00,22:00', '../MBO-Cinemas/images/kingdom of apes image.jpg', '2024-12-20 13:17:51'),
(12, 'Mufasa: The Lion King', 'action', 4.8, '118', 'In Mufasa: The Lion King vertelt Rafiki de legende van Mufasa aan de jonge leeuwenwelp Kiara, dochter van Simba en Nala. Hierbij wordt hij op eigenzinnige wijze ondersteund door Timon en Pumbaa', 'amsterdam', '19:00, 20:00, 22:00', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSkbh7aQXD4y8HoajnrE1O2XYZk3ybxTqk61UDg1_AMtQzNUEb7', '2025-01-13 09:51:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`) VALUES
(1, 'abdulmalik@info.com', '$2y$10$1wJdqhd7fVV0VsZBQ0JlHuITuFb2s9h01KHBBXbft5YtGcGlpk3he', 'admin'),
(2, 'tariq@info.com', '$2y$10$1wJdqhd7fVV0VsZBQ0JlHuITuFb2s9h01KHBBXbft5YtGcGlpk3he', 'admin'),
(5, 'tarqassaban@gmail.com', '$2y$10$jrY47MUicAKbcOLTOpfykOP3.WTIbe7F3PeVpLuSJbPGQbuCsY0WS', 'user'),
(6, 'roanvandekamp@icloud.com', '$2y$10$7yI4qkULfCXVBYTx8jvWbOWqc3oplpD.k2G/XDzDoz8Ja/8QwCZzm', 'user'),
(8, '6039213@mborijnland.nl', '$2y$10$16JEKZKl5dG8kmZeklu7.OqfzwUw91Ctu6LqaKI9iCKtCkAYgPaiK', 'user'),
(9, 'admin@mbocinemas.com', '$2y$10$1wJdqhd7fVV0VsZBQ0JlHuITuFb2s9h01KHBBXbft5YtGcGlpk3he', 'admin'),
(10, 'bananenkiller@gmail.com', '$2y$10$zi5AQZoF5yB0FBkH1e1wFekLixDSbNZilK2ZONKhXWoRbI3q9c4q6', 'admin'),
(11, 'maronborriehodge@gmail.com', '$2y$10$hfmfxUrGaOH/m/cVIo8eg.QfUv9q5S28Mc2rc/nwXNukM2fbhwj5.', 'user'),
(12, 'lt.verschuur@gmail.com', '$2y$10$.ZUpNZEMu2KvGPC2s789Be..r0RCz/ArPHtqHfkIeXOkIRqOIpMvy', 'user'),
(13, 'tariq@gmail.com', '$2y$10$WZ5xKu1ZhpVoCjZKSdlL2OugqdieaCukYg/Xic7gFpZNOmYBiLltC', 'user'),
(14, 'ramon@hotmail.com', '$2y$10$BXrKksH9bIZtDtuROgIwjetl6tsk7fRYT3QgeajNCD8f1Upp0Fuum', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
