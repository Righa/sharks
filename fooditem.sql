-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2019 at 01:08 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fooditem`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `item` varchar(50) NOT NULL,
  `pic` blob NOT NULL,
  `price` int(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item`, `pic`, `price`) VALUES
(12, 'Burger  ', 0x6275726765722e6a7067, 5000),
(17, 'ice cream   ', 0x6963652d637265616d2e6a7067, 4000),
(18, 'lemongrass and shrimps  ', 0x6a617568656e6b7367732e6a7067, 5000),
(19, 'fry prawns ', 0x6a686473696271776f6965772e6a7067, 3334),
(20, 'big zanzibar crabby ', 0x6372616262697374736a662e6a7067, 4000),
(24, 'really scary creatures ', 0x666f6f645f77616c6c2e6a7067, 3532),
(25, 'baked durian', 0x62616b65642d64757269616e342d333030783230322e6a7067, 234),
(27, 'century eggs', 0x63656e747572792d656767732d706964616e2e6a7067, 542),
(28, 'tarantula', 0x66726965642d746172616e74756c612e6a7067, 867),
(29, 'cobra spring rolls', 0x636f6272612d737072696e672d726f6c6c732e6a7067, 590),
(30, 'haggis burger', 0x4861676769734275726765722d312e6a7067, 542),
(31, 'steamed hairy crabs', 0x68616972792d63726162732d64617a68617869652e6a7067, 7537),
(32, 'boiled rice', 0x626f696c2d726963652e6a7067, 521),
(35, 'pizza', 0x7065707065726f6e692d70697a7a612e6a7067, 7654);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(55) NOT NULL,
  `lname` varchar(55) NOT NULL,
  `sname` varchar(55) NOT NULL,
  `pass` varchar(66) NOT NULL,
  `type` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `sname`, `pass`, `type`) VALUES
(14, 'kiriu', 'xiao', 'robin', 'e93f9a5881daa23b0be01d651356b348', 'Customer'),
(15, 'Lawrence', 'righa', 'Rota', 'f2b0f4701bf8986e3cc347246c63c3a5', 'Customer'),
(16, 'lawrenco', 'dariga', 'guantexio', 'd1a346df2019a0c0fd79b4808e502cee', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
