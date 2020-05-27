-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 27, 2020 at 05:50 PM
-- Server version: 10.3.13-MariaDB-log
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rent_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `autos`
--

CREATE TABLE `autos` (
  `id` int(13) NOT NULL,
  `model` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_src` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int(13) NOT NULL,
  `milleage` int(13) NOT NULL,
  `status` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_id` int(13) NOT NULL,
  `rent_start_time` date DEFAULT NULL,
  `rent_end_time` date DEFAULT NULL,
  `price` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `autos`
--

INSERT INTO `autos` (`id`, `model`, `img_src`, `year`, `milleage`, `status`, `number`, `owner_id`, `rent_start_time`, `rent_end_time`, `price`) VALUES
(1, 'Toyota Camry 70', 'img/camry70.jpg', 2017, 10000, 'свободна', '01 754 ABC', 1, '2020-05-24', '2020-05-27', 19000),
(2, 'BMW i8', 'img/bmwi8.jpg', 2018, 23000, 'занята', '02 777 ZZZ', 4, '2020-05-26', '2020-05-31', 60000),
(3, 'KIA Cerato', 'img/cerato.jpg', 2017, 42000, 'занята', '01 459 KPA', 4, '2020-05-26', '2020-05-30', 13000),
(4, 'Ferrari 448', 'img/5ece7616ccdd4ferrari.jpg', 2017, 100, 'свободна', 'KZ 111 III', 4, NULL, NULL, 120000),
(5, 'Mercedes 222', 'img/5ece76b7200dfmerc.jpg', 2019, 1300, 'занята', 'KZ 777 ZZZ', 4, '2020-05-27', '2020-05-31', 90000),
(6, 'BMW AMG CAMRY', 'img/5ece7b1913625v.jpg', 1980, 265000, 'занята', 'KZ 497 VCK', 5, '2020-05-27', '2020-05-30', 200);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(13) NOT NULL,
  `fullname` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `login`, `password`) VALUES
(4, 'alibi duisenaliyev', 'realibi', 'lololo'),
(5, 'vadim kuprienko', 'vadimm', '123123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autos`
--
ALTER TABLE `autos`
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
-- AUTO_INCREMENT for table `autos`
--
ALTER TABLE `autos`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
