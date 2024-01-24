-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2023 at 01:09 PM
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
-- Database: `explore`
--

-- --------------------------------------------------------

--
-- Table structure for table `booked`
--

CREATE TABLE `booked` (
  `id` int(10) NOT NULL,
  `date` date NOT NULL,
  `seat` double NOT NULL,
  `status` varchar(30) NOT NULL,
  `userid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booked`
--

INSERT INTO `booked` (`id`, `date`, `seat`, `status`, `userid`) VALUES
(1, '2023-09-08', 5, 'booked', 1),
(2, '2023-09-07', 2, 'booked', 2);

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `name`, `email`, `message`) VALUES
(1, 'shubham', 'shubham@gmail.com', 'i want '),
(2, 'shubham', 'shubham@gmil.com', 'hjkjk j  '),
(3, 'vishal', 'vishal@gmail.com', 'i love you'),
(4, 'shubham', 'shubham.patil@gmail.com', 'please contact me 9448034520');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(10) NOT NULL,
  `user` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `userId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `user`, `pass`, `type`, `userId`) VALUES
(6, 'admin', 'pass', 'admin', 0),
(10, 'shradha@gmail.com', '123456', 'user', 1),
(11, 'shubham.patil@gmail.com', '123456', 'user', 2),
(12, 'vishuvy99@gmail.com', '7777', 'user', 3),
(13, 'shubham123@gmail.com', '123456', 'user', 4);

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `des` varchar(150) NOT NULL,
  `image` varchar(160) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `title`, `location`, `des`, `image`) VALUES
(1, 'BELGAUM FORT', 'BELGAUM', 'Belagavi Fort is in the city of Belgaum, in the Belgaum district, in Karnataka state, India. It was begun by Jaya Raya, also called Bichi Raja, an all', '../../image/2002-11-08-FRI-Belgaum-Fort (1).JPG'),
(2, 'BELGAUM FORT LAKE', 'BELGAUM ', 'Fort Lake (Kote Kere), Belgaum Overview The Fort Lake, also known as Kote Kere is one of the picnic spots of Belgaum City. Fort Lake is situated right', '../../image/IMG.jpg'),
(3, 'RAJHUNS GAD  ', 'YELLUR BELGAUM', 'Yellurgad (Yellur Fort), located within the vicinity of Belagavi Taluka, stands on a hill with a scenic view. Its original name was Rajhunsgad, and wa', '../../image/yellur.png'),
(4, 'SIDDHESHWAR TEMPLE', 'KANBARGI,BELGAUM', 'A wonderful Lord Shiva temple located 2 kms from Kanbargi (Kanbargi is about 10 kms from CBT Belgavi approximatey 20-25 mins drive). Its a wonderful t', '../../image/maxresdefault.jpg'),
(5, 'kamalbasti', 'belgaum', 'this is a kamal basti located in karnataka', '../../image/Kamal-Basti.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `id` int(11) NOT NULL,
  `name` double NOT NULL,
  `date` date NOT NULL,
  `available` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`id`, `name`, `date`, `available`) VALUES
(1, 20, '2023-09-07', 18),
(2, 50, '2023-09-08', 0),
(3, 26, '2023-09-09', 26),
(4, 30, '2023-09-09', 30);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone`, `gender`, `password`) VALUES
(1, 'shradha', 'shradha@gmail.com', '9900976897', 'FEMALE', '123456'),
(2, 'shubham patil', 'shubham.patil@gmail.com', '9448034520', 'MALE', '123456'),
(3, 'Vishal Yadav', 'vishuvy99@gmail.com', '8197087561', ' MALE', '7777'),
(4, 'shubham', 'shubham123@gmail.com', '9448034520', ' MALE', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booked`
--
ALTER TABLE `booked`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booked`
--
ALTER TABLE `booked`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `seat`
--
ALTER TABLE `seat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
