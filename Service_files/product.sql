-- phpMyAdmin SQL Dump
-- version 4.2.13.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2015 at 06:50 PM
-- Server version: 5.1.73
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
`id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `imgName` varchar(255) DEFAULT NULL,
  `salePrice` decimal(10,2) DEFAULT NULL,
  `discounted` tinyint(1) DEFAULT NULL,
  `sellable` tinyint(1) DEFAULT NULL,
  `review` varchar(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `quantity`, `imgName`, `salePrice`, `discounted`, `sellable`, `review`) VALUES
(1, 'Rainforest', 'Everything you want from A to Z', '1000.25', 37, 'amazon.png', '500.10', 0, 1, 'This is the best product ever!!!'),
(2, 'Activity Area', 'Arts and Crafts for the everyday man', '900.80', 11, 'hobbylobby.png', '420.08', 1, 1, 'This is the best product ever!!!'),
(3, 'Marcys', 'The best department store', '55000.55', 41, 'macys.jpg', '25000.10', 0, 1, 'This is the best product ever!!!'),
(4, 'Good Buy', 'Pretty good electronics', '4500.27', 22, 'bestbuy.jpg', '2000.10', 0, 1, 'This is the best product ever!!!'),
(5, 'Paperclips', 'The office supply store', '25.00', 18, 'staples.jpg', '15.15', 1, 1, 'This is the best product ever!!!'),
(6, 'Pineapple', 'Home of the piPhone', '890000.00', 34, 'apple.png', '44000.00', 0, 1, 'This is the best product ever!!!'),
(7, 'Forever 55', 'Clothing for old people', '27000.00', 55, 'forever21.png', '10000.00', 0, 1, 'This is the best product ever!!!'),
(8, 'ACNE', 'Grocery store for teenagers', '8500.00', 16, 'acme.png', '85.00', 1, 1, 'This is the best product ever!!!'),
(9, 'Brickbuster', 'America''s Favorite VHS Rental store', '188.00', 5, 'blockbuster.jpg', '1.25', 1, 1, 'This is the best product ever!!!'),
(10, 'Shirtz', 'Food on the road', '3500.00', 294, 'sheetz.png', '2000.00', 0, 1, 'This is the best product ever!!!'),
(11, 'FlorMart', 'Prices as low as the floor', '20000.00', 781, 'walmart.png', '15000.00', 1, 1, 'This is the best product ever!!!'),
(12, 'Krueger', 'Groceries to DIE for', '1234.00', 288, 'kroger.png', '321.00', 0, 1, 'This is the best product ever!!!'),
(13, 'Sanic', 'Really fast food', '3324.00', 200, 'Sanic.gif', '324.00', 0, 1, 'This is the best product ever!!!'),
(14, 'JT Min', 'Really expensive clothes', '231.00', 140, 'tjmaxx.png', '230.00', 0, 1, 'This is the best product ever!!!'),
(15, 'Burger Prince', 'Have it the right way!', '3345.00', 1738, 'burgerking.jpg', '210.15', 0, 1, 'This is the best product ever!!!'),
(16, 'Catco', 'Bulk supplies for cats', '75000.00', 20000, 'costco.jpg', '25000.75', 0, 1, 'This is the best product ever!!!'),
(17, 'Hole', 'Really trendy clothing', '2875.22', 1000, 'gap.jpg', '1499.22', 0, 1, 'This is the best product ever!!!'),
(18, 'American Vulture', 'Young fashion', '9822.11', 3000, 'americaneagle.gif', '1499.22', 0, 1, 'This is the best product ever!!!'),
(19, 'Radiohut', 'From transistors to your next phone', '11.99', 4507, 'radioshack.jpg', '5.75', 0, 1, 'This is the best product ever!!!');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
