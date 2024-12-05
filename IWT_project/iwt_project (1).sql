-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 05:56 PM
-- Server version: 8.0.14
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iwt_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_credentails`
--

CREATE TABLE `admin_credentails` (
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin_credentails`
--

INSERT INTO `admin_credentails` (`user_name`, `password`) VALUES
('sanskar_narwaria', 'sanskar@1234');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `customer_name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` bigint(15) NOT NULL,
  `movie_name` varchar(40) NOT NULL,
  `show_time` datetime NOT NULL,
  `seats` varchar(700) NOT NULL,
  `total_amount` int(6) NOT NULL DEFAULT '0',
  `movie_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`customer_name`, `email`, `phone`, `movie_name`, `show_time`, `seats`, `total_amount`, `movie_id`) VALUES
('Sanskar Narwaria', 'san@gmail.com', 1234567890, 'Animal', '2024-10-17 09:45:00', '10,11,12,13,32,33,34,35', 2400, 1),
('Sanskar Narwaria', 'san@gmail.com', 1234567890, 'Animal', '2024-10-17 16:20:00', '98,99,100,101,120,121,122,123', 2400, 1),
('Sanjeev Patel', 'patelSanjeev@gmail.com', 9876543210, 'Animal', '2024-10-17 17:20:00', '74,75,76,77,78,79', 1800, 1),
('Rahul Rajpoot', 'rahulrajpoot@gmail.com', 5947136820, 'Animal', '2024-10-17 12:15:00', '73,74,75,76,77,78,79,80,81', 2700, 1),
('Satish Mansore', 'mansoresatish420@gmail.com', 8729455660, 'Animal', '2024-10-17 16:20:00', '131,132', 600, 1),
('Ankit Narwaria', 'rajpootankit01@gmail.com', 7402195836, 'Animal', '2024-10-17 16:20:00', '52,53,54,55', 1200, 1),
('Sanskar Narwaria', 'sanskarnarwaria26@gmail.com', 7000586184, 'Animal', '2024-10-17 16:20:00', '58,59,60,61', 1200, 1);

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `id` int(5) NOT NULL,
  `movie_name` varchar(255) NOT NULL,
  `genre` varchar(30) DEFAULT NULL,
  `img_src` varchar(255) DEFAULT NULL,
  `relDate` date NOT NULL,
  `movieDirector` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `movieActors` varchar(200) NOT NULL,
  `seat_price` int(5) NOT NULL DEFAULT '0',
  `duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id`, `movie_name`, `genre`, `img_src`, `relDate`, `movieDirector`, `movieActors`, `seat_price`, `duration`) VALUES
(1, 'Animal', 'Action', 'movies_imgs/Animal2.jpg', '2026-06-23', 'Sandeep Reddy Vanga', 'Ranbir Kapoor, Anil Kapoor, Rashmika Mandanna, Bobby Deol, Tripti Dimri', 300, 135),
(2, 'PK', 'action', 'movies_imgs/PK2.jpg', '2014-12-19', 'Rajkumar Hirani', 'Aamir Khan, Anushka Sharma, Sushant Singh Rajput, Sanjay Dutt, Boman Irani', 250, 120),
(3, 'The Nun', 'Horror', 'movies_imgs/Nun_img.jpg', '2018-09-07', 'Corin Hardy', 'Taissa Farmiga, Demian Bichir, Bonnie Aarons', 300, 105),
(4, 'The RoundUp', 'Action', 'movies_imgs/The_round_up_img.jpg', '2022-05-18', 'Lee Sang-yong', 'Ma Dong-seok, Son Suk-ku, Choi Gwi-hwa', 400, 165),
(5, 'Bhool Bhulaiyaa', 'Comedy', 'movies_imgs/Bhool_bhulaiyaa_img.jpg', '2007-10-02', 'Priyadarshan', 'Akshay Kumar, Vidya Balan, Shiney Ahuja', 200, 135);

-- --------------------------------------------------------

--
-- Table structure for table `showtimes`
--

CREATE TABLE `showtimes` (
  `movie_id` int(5) DEFAULT NULL,
  `movie_name` varchar(255) DEFAULT NULL,
  `show_date` date DEFAULT NULL,
  `show_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `showtimes`
--

INSERT INTO `showtimes` (`movie_id`, `movie_name`, `show_date`, `show_time`) VALUES
(1, 'Animal', '2024-10-16', '18:30:00'),
(1, 'Animal', '2024-10-16', '11:40:00'),
(1, 'Animal', '2024-10-16', '15:00:00'),
(1, 'Animal', '2024-10-16', '21:15:00'),
(1, 'Animal', '2024-10-17', '09:45:00'),
(1, 'Animal', '2024-10-17', '12:15:00'),
(1, 'Animal', '2024-10-17', '16:20:00'),
(1, 'Animal', '2024-10-17', '21:00:00'),
(1, 'Animal', '2024-10-18', '10:15:00'),
(1, 'Animal', '2024-10-18', '13:40:00'),
(1, 'Animal', '2024-10-17', '17:20:00'),
(1, 'Animal', '2024-10-18', '19:00:00'),
(2, 'PK', '2024-10-16', '18:20:00'),
(2, 'PK', '2024-10-16', '21:00:00'),
(2, 'PK', '2024-10-17', '11:00:00'),
(2, 'PK', '2024-10-17', '13:20:00'),
(2, 'PK', '2024-10-17', '15:45:00'),
(2, 'PK', '2024-10-17', '18:00:00'),
(2, 'PK', '2024-10-17', '21:10:00'),
(2, 'PK', '2024-10-18', '09:45:00'),
(2, 'PK', '2024-10-18', '12:00:00'),
(2, 'PK', '2024-10-18', '15:20:00'),
(2, 'PK', '2024-10-18', '18:45:00'),
(3, 'The Nun', '2024-10-16', '20:30:00'),
(3, 'The Nun', '2024-10-16', '23:00:00'),
(3, 'The Nun', '2024-10-17', '09:30:00'),
(3, 'The Nun', '2024-10-17', '12:00:00'),
(3, 'The Nun', '2024-10-17', '18:30:00'),
(3, 'The Nun', '2024-10-17', '21:00:00'),
(3, 'The Nun', '2024-10-18', '08:30:00'),
(3, 'The Nun', '2024-10-18', '14:00:00'),
(3, 'The Nun', '2024-10-18', '18:30:00'),
(3, 'The Nun', '2024-10-19', '09:00:00'),
(3, 'The Nun', '2024-10-19', '11:30:00'),
(3, 'The Nun', '2024-10-19', '15:30:00'),
(3, 'The Nun', '2024-10-19', '20:00:00'),
(3, 'The Nun', '2024-10-19', '22:30:00'),
(4, 'The RoundUp', '2024-10-16', '19:30:00'),
(4, 'The RoundUp', '2024-10-17', '10:00:00'),
(4, 'The RoundUp', '2024-10-17', '13:00:00'),
(4, 'The RoundUp', '2024-10-17', '16:30:00'),
(4, 'The RoundUp', '2024-10-17', '20:00:00'),
(4, 'The RoundUp', '2024-10-18', '09:00:00'),
(4, 'The RoundUp', '2024-10-18', '12:30:00'),
(4, 'The RoundUp', '2024-10-18', '15:00:00'),
(4, 'The RoundUp', '2024-10-18', '18:00:00'),
(4, 'The RoundUp', '2024-10-19', '09:30:00'),
(4, 'The RoundUp', '2024-10-19', '12:00:00'),
(4, 'The RoundUp', '2024-10-19', '16:00:00'),
(4, 'The RoundUp', '2024-10-19', '19:00:00'),
(4, 'The RoundUp', '2024-10-19', '21:30:00'),
(5, 'Bhool Bhulaiyaa', '2024-10-16', '17:45:00'),
(5, 'Bhool Bhulaiyaa', '2024-10-16', '19:00:00'),
(5, 'Bhool Bhulaiyaa', '2024-10-16', '20:30:00'),
(5, 'Bhool Bhulaiyaa', '2024-10-16', '22:00:00'),
(5, 'Bhool Bhulaiyaa', '2024-10-17', '09:30:00'),
(5, 'Bhool Bhulaiyaa', '2024-10-17', '12:00:00'),
(5, 'Bhool Bhulaiyaa', '2024-10-17', '15:00:00'),
(5, 'Bhool Bhulaiyaa', '2024-10-17', '17:30:00'),
(5, 'Bhool Bhulaiyaa', '2024-10-18', '08:30:00'),
(5, 'Bhool Bhulaiyaa', '2024-10-18', '11:00:00'),
(5, 'Bhool Bhulaiyaa', '2024-10-18', '14:30:00'),
(5, 'Bhool Bhulaiyaa', '2024-10-18', '17:00:00'),
(5, 'Bhool Bhulaiyaa', '2024-10-19', '10:00:00'),
(5, 'Bhool Bhulaiyaa', '2024-10-19', '12:30:00'),
(5, 'Bhool Bhulaiyaa', '2024-10-19', '15:30:00'),
(5, 'Bhool Bhulaiyaa', '2024-10-19', '18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `usercredentials`
--

CREATE TABLE `usercredentials` (
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(30) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usercredentials`
--

INSERT INTO `usercredentials` (`email`, `password`, `username`) VALUES
('abc@gmail.com', 'abc', 'abc'),
('san@gmail.com', 'abcd', 'Sanskar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD KEY `fk_movie_id` (`movie_id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD KEY `movie_id` (`movie_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_movie_id` FOREIGN KEY (`movie_id`) REFERENCES `showtimes` (`movie_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD CONSTRAINT `showtimes_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ON DELETE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `delete_old_bookings` ON SCHEDULE EVERY 1 DAY STARTS '2024-10-15 23:44:22' ON COMPLETION NOT PRESERVE ENABLE DO DELETE b
FROM bookings b
JOIN show_times s
ON b.movie_name = s.movie_name
AND b.show_time = CONCAT(s.show_date, ' ', s.show_time)
WHERE CONCAT(s.show_date, ' ', s.show_time) < NOW()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
