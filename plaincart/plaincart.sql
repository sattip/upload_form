-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 20, 2012 at 12:41 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `plaincart`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `ct_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pd_id` int(10) unsigned NOT NULL DEFAULT '0',
  `ct_qty` mediumint(8) unsigned NOT NULL DEFAULT '1',
  `ct_session_id` char(32) NOT NULL DEFAULT '',
  `ct_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ct_id`),
  KEY `pd_id` (`pd_id`),
  KEY `ct_session_id` (`ct_session_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`ct_id`, `pd_id`, `ct_qty`, `ct_session_id`, `ct_date`) VALUES
(1, 8, 1, '86361mjjap3lqvqg2ru7b0adj2', '2012-10-20 15:21:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_parent_id` int(11) NOT NULL DEFAULT '0',
  `cat_name` varchar(50) NOT NULL DEFAULT '',
  `cat_description` varchar(200) NOT NULL DEFAULT '',
  `cat_image` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`cat_id`),
  KEY `cat_parent_id` (`cat_parent_id`),
  KEY `cat_name` (`cat_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `cat_parent_id`, `cat_name`, `cat_description`, `cat_image`) VALUES
(12, 0, 'mobiles', 'mobiles', 'becc4e1dcd8e7d76c05cb287d2b77ccc.png'),
(13, 0, 'dress', 'dress', '62e110be7d5b9f0ba6d7f0860925210b.jpg'),
(14, 12, 'samsung', 'samsung', ''),
(15, 12, 'nokia', 'nokia', ''),
(16, 13, 'peter england', 'peter england', ''),
(17, 13, 'raymond', 'raymond', ''),
(18, 0, 'music', 'music', '959cfbb0a839341a270d34abefea32ed.png'),
(19, 18, 'guitar', 'guitar', '4732324a0ba9958540cb30a3a580258c.png'),
(20, 18, 'ada', 'dawdaw', ''),
(38, 0, 'edawda', 'dawdaw', '2d48965b95d1a252c5d79a4200d8d5ff.png'),
(39, 12, 'sony', 'adwadwadwadwad', '0fc562603972aa1cc570caebf1938baa.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_currency`
--

CREATE TABLE IF NOT EXISTS `tbl_currency` (
  `cy_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cy_code` char(3) NOT NULL DEFAULT '',
  `cy_symbol` varchar(8) NOT NULL DEFAULT '',
  PRIMARY KEY (`cy_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_currency`
--

INSERT INTO `tbl_currency` (`cy_id`, `cy_code`, `cy_symbol`) VALUES
(1, 'EUR', '&#8364;'),
(2, 'GBP', '&pound;'),
(3, 'JPY', '&yen;'),
(4, 'USD', '$');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE IF NOT EXISTS `tbl_order` (
  `od_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `od_date` datetime DEFAULT NULL,
  `od_last_update` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `od_status` enum('New','Paid','Shipped','Completed','Cancelled') NOT NULL DEFAULT 'New',
  `od_memo` varchar(255) NOT NULL DEFAULT '',
  `od_shipping_first_name` varchar(50) NOT NULL DEFAULT '',
  `od_shipping_last_name` varchar(50) NOT NULL DEFAULT '',
  `od_shipping_address1` varchar(100) NOT NULL DEFAULT '',
  `od_shipping_address2` varchar(100) NOT NULL DEFAULT '',
  `od_shipping_phone` varchar(32) NOT NULL DEFAULT '',
  `od_shipping_city` varchar(100) NOT NULL DEFAULT '',
  `od_shipping_state` varchar(32) NOT NULL DEFAULT '',
  `od_shipping_postal_code` varchar(10) NOT NULL DEFAULT '',
  `od_shipping_cost` decimal(5,2) DEFAULT '0.00',
  `od_payment_first_name` varchar(50) NOT NULL DEFAULT '',
  `od_payment_last_name` varchar(50) NOT NULL DEFAULT '',
  `od_payment_address1` varchar(100) NOT NULL DEFAULT '',
  `od_payment_address2` varchar(100) NOT NULL DEFAULT '',
  `od_payment_phone` varchar(32) NOT NULL DEFAULT '',
  `od_payment_city` varchar(100) NOT NULL DEFAULT '',
  `od_payment_state` varchar(32) NOT NULL DEFAULT '',
  `od_payment_postal_code` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`od_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`od_id`, `od_date`, `od_last_update`, `od_status`, `od_memo`, `od_shipping_first_name`, `od_shipping_last_name`, `od_shipping_address1`, `od_shipping_address2`, `od_shipping_phone`, `od_shipping_city`, `od_shipping_state`, `od_shipping_postal_code`, `od_shipping_cost`, `od_payment_first_name`, `od_payment_last_name`, `od_payment_address1`, `od_payment_address2`, `od_payment_phone`, `od_payment_city`, `od_payment_state`, `od_payment_postal_code`) VALUES
(1, '2012-10-19 16:59:44', '2012-10-19 16:59:44', 'New', '', 'Dawda', 'Dawdaw', 'dawdaw', 'dawd', '423423', 'Fsefes', 'sfsf', '4234', 5.00, 'Dawda', 'Dawdaw', 'dawdaw', 'dawd', '423423', 'Fsefes', 'sfsf', '4234'),
(2, '2012-10-19 18:07:56', '2012-10-19 18:07:56', 'New', '', 'Dawda', 'Dawdaw', 'dwad', 'awdawdaw', 'dawd', 'Dawda', 'awdaw', 'wdwad', 5.00, 'Dawda', 'Dawdaw', 'dwad', 'awdawdaw', 'dawd', 'Dawda', 'awdaw', 'wdwad'),
(3, '2012-10-19 18:08:59', '2012-10-19 18:08:59', 'New', '', 'Dawda', 'Dawdaw', 'dawdaw', 'awdawdaw', '423423', 'Dawda', 'awdaw', '4234', 5.00, 'Dawda', 'Dawdaw', 'dawdaw', 'awdawdaw', '423423', 'Dawda', 'awdaw', '4234'),
(4, '2012-10-19 18:14:35', '2012-10-19 18:14:35', 'New', '', 'Dawda', 'Dawdaw', 'dawdaw', 'awdawdaw', '423423', 'Dawda', 'awdaw', '4234', 5.00, 'Dawda', 'Dawdaw', 'dawdaw', 'awdawdaw', '423423', 'Dawda', 'awdaw', '4234'),
(5, '2012-10-19 18:35:04', '2012-10-19 18:35:04', 'New', '', 'Wad', 'Dawdaw', 'dawd', 'awdawdawdawd', 'wadwad', 'Dawda', 'awd', 'dawdwa', 5.00, 'Wad', 'Dawdaw', 'dawd', 'awdawdawdawd', 'wadwad', 'Dawda', 'awd', 'dawdwa'),
(6, '2012-10-19 18:44:18', '2012-10-19 18:44:18', 'New', '', 'Dawda', 'Dawdaw', 'dawdaw', 'awdawdaw', '423423', 'Dawda', 'awdaw', '4234', 5.00, 'Dawda', 'Dawdaw', 'dawdaw', 'awdawdaw', '423423', 'Dawda', 'awdaw', '4234'),
(7, '2012-10-19 19:01:26', '2012-10-19 19:01:26', 'New', '', 'Dawda', 'Dawdaw', 'dawdaw', 'awdawdaw', '423423', 'Dawda', 'awdaw', '4234', 5.00, 'Dawda', 'Dawdaw', 'dawdaw', 'awdawdaw', '423423', 'Dawda', 'awdaw', '4234');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_item`
--

CREATE TABLE IF NOT EXISTS `tbl_order_item` (
  `od_id` int(10) unsigned NOT NULL DEFAULT '0',
  `pd_id` int(10) unsigned NOT NULL DEFAULT '0',
  `od_qty` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`od_id`,`pd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order_item`
--

INSERT INTO `tbl_order_item` (`od_id`, `pd_id`, `od_qty`) VALUES
(1, 2, 9),
(1, 5, 5),
(2, 7, 1),
(3, 3, 1),
(4, 4, 1),
(5, 2, 1),
(6, 3, 2),
(7, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
  `pd_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` int(10) unsigned NOT NULL DEFAULT '0',
  `pd_name` varchar(100) NOT NULL DEFAULT '',
  `pd_description` text NOT NULL,
  `pd_price` decimal(9,2) NOT NULL DEFAULT '0.00',
  `pd_qty` smallint(5) unsigned NOT NULL DEFAULT '0',
  `pd_image` varchar(200) DEFAULT NULL,
  `pd_thumbnail` varchar(200) DEFAULT NULL,
  `pd_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pd_last_update` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`pd_id`),
  KEY `cat_id` (`cat_id`),
  KEY `pd_name` (`pd_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`pd_id`, `cat_id`, `pd_name`, `pd_description`, `pd_price`, `pd_qty`, `pd_image`, `pd_thumbnail`, `pd_date`, `pd_last_update`) VALUES
(2, 14, 'galaxy', 'galaxy', 32.00, 0, '76f344c95cb488194609751de43d3e4c.png', 'f88aacfd0d89ecfc2002f829f86b740e.png', '2012-10-10 18:58:12', '0000-00-00 00:00:00'),
(3, 15, 'ss', 'ss', 32.00, 96, 'e7fdf0bc1bdfcd983186d49705558568.jpg', 'a5190d10fb4e82bc3e1a0b78b6198eb8.jpg', '2012-10-10 18:58:35', '0000-00-00 00:00:00'),
(4, 16, 'suits', 'suits', 23.00, 99, 'c41c45daf05f35b3b52438689cdcaeb8.jpg', 'ffed84d588d1a18dad9fd9c9437538d3.jpg', '2012-10-10 18:59:00', '0000-00-00 00:00:00'),
(5, 17, 'sads', 'asda', 34.00, 95, 'e7c392daddb722b269a2814f281b4f01.jpg', 'e8ce2380ad0780447fbc0f0d76efc77c.jpg', '2012-10-10 18:59:21', '0000-00-00 00:00:00'),
(7, 20, 'dawda', 'dawdawdawd', 23.00, 3242, '', '', '2012-10-12 19:19:42', '0000-00-00 00:00:00'),
(8, 39, 'sony ersssion', 'gsfsefs', 12.00, 122, 'c7bf7fd14adce5ab7749c27b1645ddb0.png', '665d2c5399dc8919cc4d46aa68b4ed0c.png', '2012-10-20 15:03:24', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shop_config`
--

CREATE TABLE IF NOT EXISTS `tbl_shop_config` (
  `sc_name` varchar(50) NOT NULL DEFAULT '',
  `sc_address` varchar(100) NOT NULL DEFAULT '',
  `sc_phone` varchar(30) NOT NULL DEFAULT '',
  `sc_email` varchar(30) NOT NULL DEFAULT '',
  `sc_shipping_cost` decimal(5,2) NOT NULL DEFAULT '0.00',
  `sc_currency` int(10) unsigned NOT NULL DEFAULT '1',
  `sc_order_email` enum('y','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_shop_config`
--

INSERT INTO `tbl_shop_config` (`sc_name`, `sc_address`, `sc_phone`, `sc_email`, `sc_shipping_cost`, `sc_currency`, `sc_order_email`) VALUES
('PlainCart - Just a plain online shop', 'Old warehouse under the bridge,\r\nWater Seven, Grand Line', '777-FRANKY', 'franky@tomsworkers.com', 5.00, 3, 'y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL DEFAULT '',
  `user_password` varchar(32) NOT NULL DEFAULT '',
  `address` varchar(1000) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `user_level` int(11) NOT NULL,
  `user_regdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_password`, `address`, `phone`, `email`, `user_level`, `user_regdate`, `user_last_login`) VALUES
(1, 'admin', 'admin', '', '', '', 1, '2005-02-20 17:35:44', '2012-10-20 15:48:54'),
(3, 'webmaster', '026cf3fc6e903caf', '', '', '', 0, '2005-03-02 17:52:51', '0000-00-00 00:00:00'),
(4, 'rams', 'ram', '3423423vxdfvsdfasdfa', '3423423', 'ram@mail.com', 0, '2012-10-11 16:09:03', '2012-10-20 15:20:38'),
(5, 'sam', 'sam', 'sam fjsefjefioenof', '423423423', 'sam@mail.com', 0, '2012-10-18 18:43:25', '0000-00-00 00:00:00'),
(7, 'raja', 'raja', 'dajhdwiuah', '324234324', 'raja@mail.com', 0, '2012-10-18 19:01:14', '0000-00-00 00:00:00'),
(9, 'ramu', 'ramu', 'kdsiofhioeh', '2364732684', 'ramu@mail.com', 0, '2012-10-18 19:03:38', '2012-10-18 19:04:10');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
