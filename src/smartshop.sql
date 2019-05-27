-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2018 at 12:19 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `img` varchar(1000) NOT NULL,
  `link` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `icon` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `icon`) VALUES
(1, 'Vehicle', 'vehicle'),
(2, 'Furniture', 'furniture'),
(3, 'Electronics', 'electronics');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `lessee` varchar(20) NOT NULL,
  `dttime` varchar(20) NOT NULL,
  `fromdt` varchar(20) NOT NULL,
  `todt` varchar(20) NOT NULL,
  `pid` int(11) NOT NULL,
  `nid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL,
  `picture` varchar(1000) NOT NULL,
  `id_produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `picture`, `id_produit`) VALUES
(25, 'Oculus_Product_Dynamic 45.jpg', 10),
(26, 'OculusRift.jpg', 10),
(27, '61EsR4QA0PL._SL1500_.jpg', 10),
(28, 'five_pictures1_100259_201506200523405584885cedd68.png', 12),
(29, 'pi_ms-gp622qe-035za1.jpg', 12),
(30, 'pi_ms-gp622qe-035za3.jpg', 12),
(31, 'amazon_b00x4whp5e_echo_1187819.jpg', 13),
(32, 'amazonecho_4-100599473-orig.jpg', 13),
(33, 'amazon-echo-part-1-a-consumer-pr.jpg', 13),
(34, 'og-img.png', 14),
(35, 'h_51561794.jpg', 14),
(36, 'apple-watch-thumbnail-100571651-orig.jpg', 14),
(43, 'weddingcar1.png', 17),
(44, 'nexus-6p-9693.0.jpg', 17),
(45, 'Google-Nexus-6P-Review-Conc.jpg', 17),
(46, 'sofa1.png', 15),
(49, 'sofa2.png', 15);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `price` int(11) NOT NULL,
  `id_picture` int(11) NOT NULL,
  `thumbnail` varchar(1000) NOT NULL,
  `Available` int(11) NOT NULL DEFAULT '1',
  `uploaddate` datetime NOT NULL,
  `uid` int(11) NOT NULL,
  `paid` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `id_category`, `name`, `description`, `price`, `id_picture`, `thumbnail`, `Available`, `uploaddate`, `uid`, `paid`) VALUES
(10, 3, 'Oculus', 'High Resolution viewing, full HD for efficient gaming. ', 200, 25, 'Oculus_Product_Dynamic 45.jpg', 1, '2018-02-21 00:00:00', 11, 'yes'),
(12, 3, 'MSI GP62 Leopard Pro', 'In-depth review of the MSI GP62-2QEi781FD (Intel Core i7 5700HQ, NVIDIA GeForce GTX 950M, 15.6\", 2.3 kg) ... The MSI GE series is already the manufacturer\'s entry-level gaming series. ..... ', 2390, 12, 'msi-gp62-6qf-product_pictures-3d1.png', 1, '2018-03-09 03:00:00', 5, 'yes'),
(13, 3, 'Amazon Echo', 'Amazon Echo is a hands-free speaker you control with your voice. Echo connects to the Alexa Voice Service to play music, provide information, news, sports ...', 179, 13, 'amazon-echo-image.jpg', 1, '2018-02-01 00:00:00', 9, 'no'),
(14, 3, 'Apple Watch', 'The new Apple Watch is the ultimate device for your healthy life. Choose from a range of models including Apple Watch Series 2 and Apple Watch Nike+', 349, 14, 'apple-watch-premium-design-vs-pebble-time-round-classic-design.jpg', 0, '2018-03-09 00:00:00', 11, 'yes'),
(15, 2, 'Sofa Set', 'Flexsteel Dylan 100% Leather Reclining Sofa', 2000, 46, 'Sofa1.png', 1, '2018-03-14 10:00:00', 4, 'yes'),
(17, 1, 'Audi', 'White Audi on hire for weddings and other special occasions.', 10000, 43, 'weddingcar1.png', 1, '2018-03-01 00:00:00', 10, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `uadmin`
--

CREATE TABLE `uadmin` (
  `email` varchar(20) NOT NULL,
  `fullname` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uadmin`
--

INSERT INTO `uadmin` (`email`, `fullname`, `password`) VALUES
('alister@gmail.com', 'Alister Pereira', '*6BB4837EB74329105EE'),
('bev@gmail.com', 'Beverly Pereira', '*6BB4837EB74329105EE');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `firstname` varchar(1000) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `city` varchar(1000) NOT NULL,
  `zipcode` int(6) NOT NULL,
  `mob_no` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `firstname`, `password`, `city`, `zipcode`, `mob_no`) VALUES
(5, 'ismailghallou@hotmail.com', 'Ismail', 'f3b32717d5322d7ba7c505c230785468', 'Errachidia', 0, 0),
(6, 'ismail16smakosh23@gmail.com', 'ahmed', '9193ce3b31332b03f7d8af056c692b84', 'Errachidia', 0, 0),
(7, 'ismail@hotmail.com', 'omar', 'd4466cce49457cfea18222f5a7cd3573', 'Errachidia', 0, 0),
(8, 'anas@anas.com', 'anas', '76eb649c047cbecad7c36e71374bc9a5', 'Cairo', 0, 0),
(9, 'badris@hotmail.com', 'abdo', '267c88a9c130619b5e8fe370c0ae7730', 'Errachidia', 0, 0),
(10, 'mus@hotmail.com', 'mus', 'd62ec24d065e424dd816ce7828f62584', 'Cairo', 0, 0),
(11, 'ali@ali.com', 'ali', '86318e52f5ed4801abe1d13d509443de', 'Errachidia', 0, 0),
(12, 'z@gmail.com', 'zarina', '3b28228edb7193eb28ad3efa10bc3223', 'margao', 403602, 9765147452),
(1234, 'asdf@gmail.com', '1234', '1234', 'margao', 123456, 1234567889);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uadmin`
--
ALTER TABLE `uadmin`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `nid` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1235;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
