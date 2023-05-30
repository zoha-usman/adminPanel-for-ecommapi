-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2023 at 09:23 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `catname` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `sdesc` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `catname`, `image`, `sdesc`, `status`) VALUES
(1, 'Women', 'b8ff44b34939ed04188aa3afcfea13d9.jpg', 'woemenicon', 1),
(2, 'girls', 'Skirt with Simple  Top.jpg', 'vcsfgiuaw', 1),
(3, 'kids', 'red (1).jpg', ' chgeowq', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `orderID` int(11) NOT NULL,
  `inviceNo` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userPhone` varchar(255) NOT NULL,
  `userAddress` varchar(255) NOT NULL,
  `userCity` varchar(255) NOT NULL,
  `userID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `orderQuantity` int(11) NOT NULL,
  `orderStatus` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `orderTrackingID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `catname` text NOT NULL,
  `pname` text NOT NULL,
  `pimage` text NOT NULL,
  `pdesc` text NOT NULL,
  `price` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `quantity` text NOT NULL,
  `size` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `catid`, `catname`, `pname`, `pimage`, `pdesc`, `price`, `status`, `stock`, `quantity`, `size`) VALUES
(1, 0, 'Women', 'Party Ware ', 'b8ff44b34939ed04188aa3afcfea13d9.jpg', 'wudfacvbsphvjnvcoev', 10000, 1, 10, '11', 's'),
(2, 0, 'girls', 'pink', 'Black and white Dress.jpg', ' cjqhf9021u9', 20000, 1, 23, '14', 'l'),
(3, 0, 'kids', 'Black Ready to wear', 'Asset-6.png', 'black ', 15000, 1, 45, '40', 'm'),
(4, 0, 'girls', 'Maria B', 'red (1).jpg', 'maora b lates artical availablre', 15000, 1, 56, '88', 's'),
(5, 0, 'kids', 'Party Ware ', 'PinkLatedAbaya.jpg', 'wertyuiodfghjkcvbnm1234567890-', 11000, 1, 60, '10', 'x'),
(6, 0, 'kids', 'Latest product ', 'Slider.jpg', 'New Trend', 11000, 1, 10, '', ''),
(7, 0, 'kids', 'Kids Wear', 'Abaya Black.jpg', 'Summer/Spring Collection of digitally printed lawn suits for women. This season, upgrade your style with these outstanding three-piece sets that have elegance and charm. Each suit has Self Digital printed designs on the front, sleeves, and back. The set includes a lovely Bamber Chiffon Dupatta, which will give a touch of grace and elegance to your look. These outfits, along with printed trousers, provide the ideal balance of comfort and a fashion-forward aesthetic. With our engaging range of digitally painted lawn suits, you can welcome the color of summer.', 1100, 1, 11, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `contact` text NOT NULL,
  `address` text NOT NULL,
  `city` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `email`, `password`, `contact`, `address`, `city`) VALUES
(1, 'zoha usman', 'zoha@gmail.com', 'zoha@123usman', '', 'fsd 123 Near u', 'fsd'),
(2, 'zoha usman', 'zoha123456789@gmail.com', 'zoha@123usman6840346', '', 'fsd 123 Near u0qdnsai2ou3i3', 'fsd cjehfiqwj'),
(3, 'not applicable', 'namia@gmail.com', 'naima123', '', '', ''),
(4, 'not applicable', 'sir123@gmail.com', 'sir1234', '', '', ''),
(5, 'not applicable', 'maha@gmail.com', 'maha123', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `catname` (`catname`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
