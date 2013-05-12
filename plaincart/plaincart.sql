CREATE DATABASE IF NOT EXISTS plaincart;
USE plaincart;

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_cart`
-- 

DROP TABLE IF EXISTS `tbl_cart`;
CREATE TABLE `tbl_cart` (
  `ct_id` int(10) unsigned NOT NULL auto_increment,
  `pd_id` int(10) unsigned NOT NULL default '0',
  `ct_qty` mediumint(8) unsigned NOT NULL default '1',
  `ct_session_id` char(32) NOT NULL default '',
  `ct_date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`ct_id`),
  KEY `pd_id` (`pd_id`),
  KEY `ct_session_id` (`ct_session_id`)
) TYPE=MyISAM AUTO_INCREMENT=58 ;


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_category`
-- 

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE `tbl_category` (
  `cat_id` int(10) unsigned NOT NULL auto_increment,
  `cat_parent_id` int(11) NOT NULL default '0',
  `cat_name` varchar(50) NOT NULL default '',
  `cat_description` varchar(200) NOT NULL default '',
  `cat_image` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`cat_id`),
  KEY `cat_parent_id` (`cat_parent_id`),
  KEY `cat_name` (`cat_name`)
) TYPE=MyISAM AUTO_INCREMENT=18 ;

-- 
-- Dumping data for table `tbl_category`
-- 

INSERT INTO `tbl_category` (`cat_id`, `cat_parent_id`, `cat_name`, `cat_description`, `cat_image`) VALUES (17, 13, 'Hunter X Hunter', 'Story about hunter and combat', '');
INSERT INTO `tbl_category` (`cat_id`, `cat_parent_id`, `cat_name`, `cat_description`, `cat_image`) VALUES (12, 0, 'Cars', 'Expensive and luxurious cars', 'dce08605333d805106217aaab7f93b95.jpg');
INSERT INTO `tbl_category` (`cat_id`, `cat_parent_id`, `cat_name`, `cat_description`, `cat_image`) VALUES (13, 0, 'Manga', 'It''s all about manga, yay....', '2a5d7eb60c1625144b3bd785bf70342c.jpg');
INSERT INTO `tbl_category` (`cat_id`, `cat_parent_id`, `cat_name`, `cat_description`, `cat_image`) VALUES (14, 12, 'Volvo', 'Swedish luxury car', '');
INSERT INTO `tbl_category` (`cat_id`, `cat_parent_id`, `cat_name`, `cat_description`, `cat_image`) VALUES (15, 12, 'Mercedes-Benz', 'Expensive but real good', '');
INSERT INTO `tbl_category` (`cat_id`, `cat_parent_id`, `cat_name`, `cat_description`, `cat_image`) VALUES (16, 13, 'Naruto', 'This is the story of Naruto and all his gang', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_currency`
-- 

DROP TABLE IF EXISTS `tbl_currency`;
CREATE TABLE `tbl_currency` (
  `cy_id` int(10) unsigned NOT NULL auto_increment,
  `cy_code` char(3) NOT NULL default '',
  `cy_symbol` varchar(8) NOT NULL default '',
  PRIMARY KEY  (`cy_id`)
) TYPE=MyISAM AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `tbl_currency`
-- 

INSERT INTO `tbl_currency` (`cy_id`, `cy_code`, `cy_symbol`) VALUES (1, 'EUR', '&#8364;');
INSERT INTO `tbl_currency` (`cy_id`, `cy_code`, `cy_symbol`) VALUES (2, 'GBP', '&pound;');
INSERT INTO `tbl_currency` (`cy_id`, `cy_code`, `cy_symbol`) VALUES (3, 'JPY', '&yen;');
INSERT INTO `tbl_currency` (`cy_id`, `cy_code`, `cy_symbol`) VALUES (4, 'USD', '$');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_order`
-- 

DROP TABLE IF EXISTS `tbl_order`;
CREATE TABLE `tbl_order` (
  `od_id` int(10) unsigned NOT NULL auto_increment,
  `od_date` datetime default NULL,
  `od_last_update` datetime NOT NULL default '0000-00-00 00:00:00',
  `od_status` enum('New', 'Paid', 'Shipped','Completed','Cancelled') NOT NULL default 'New',
  `od_memo` varchar(255) NOT NULL default '',
  `od_shipping_first_name` varchar(50) NOT NULL default '',
  `od_shipping_last_name` varchar(50) NOT NULL default '',
  `od_shipping_address1` varchar(100) NOT NULL default '',
  `od_shipping_address2` varchar(100) NOT NULL default '',
  `od_shipping_phone` varchar(32) NOT NULL default '',
  `od_shipping_city` varchar(100) NOT NULL default '',
  `od_shipping_state` varchar(32) NOT NULL default '',
  `od_shipping_postal_code` varchar(10) NOT NULL default '',
  `od_shipping_cost` decimal(5,2) default '0.00',
  `od_payment_first_name` varchar(50) NOT NULL default '',
  `od_payment_last_name` varchar(50) NOT NULL default '',
  `od_payment_address1` varchar(100) NOT NULL default '',
  `od_payment_address2` varchar(100) NOT NULL default '',
  `od_payment_phone` varchar(32) NOT NULL default '',
  `od_payment_city` varchar(100) NOT NULL default '',
  `od_payment_state` varchar(32) NOT NULL default '',
  `od_payment_postal_code` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`od_id`)
) TYPE=MyISAM AUTO_INCREMENT=1001 ;


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_order_item`
-- 

DROP TABLE IF EXISTS `tbl_order_item`;
CREATE TABLE `tbl_order_item` (
  `od_id` int(10) unsigned NOT NULL default '0',
  `pd_id` int(10) unsigned NOT NULL default '0',
  `od_qty` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`od_id`,`pd_id`)
) TYPE=MyISAM;


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_product`
-- 

DROP TABLE IF EXISTS `tbl_product`;
CREATE TABLE `tbl_product` (
  `pd_id` int(10) unsigned NOT NULL auto_increment,
  `cat_id` int(10) unsigned NOT NULL default '0',
  `pd_name` varchar(100) NOT NULL default '',
  `pd_description` text NOT NULL,
  `pd_price` decimal(9,2) NOT NULL default '0.00',
  `pd_qty` smallint(5) unsigned NOT NULL default '0',
  `pd_image` varchar(200) default NULL,
  `pd_thumbnail` varchar(200) default NULL,
  `pd_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `pd_last_update` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`pd_id`),
  KEY `cat_id` (`cat_id`),
  KEY `pd_name` (`pd_name`)
) TYPE=MyISAM AUTO_INCREMENT=22 ;


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_shop_config`
-- 

DROP TABLE IF EXISTS `tbl_shop_config`;
CREATE TABLE `tbl_shop_config` (
  `sc_name` varchar(50) NOT NULL default '',
  `sc_address` varchar(100) NOT NULL default '',
  `sc_phone` varchar(30) NOT NULL default '',
  `sc_email` varchar(30) NOT NULL default '',
  `sc_shipping_cost` decimal(5,2) NOT NULL default '0.00',
  `sc_currency` int(10) unsigned NOT NULL default '1',
  `sc_order_email` enum('y','n') NOT NULL default 'n'
) TYPE=MyISAM;

-- 
-- Dumping data for table `tbl_shop_config`
-- 

INSERT INTO `tbl_shop_config` (`sc_name`, `sc_address`, `sc_phone`, `sc_email`, `sc_shipping_cost`, `sc_currency`, `sc_order_email`) VALUES ('PlainCart - Just a plain online shop', 'Old warehouse under the bridge,\r\nWater Seven, Grand Line', '777-FRANKY', 'franky@tomsworkers.com', 5.00, 4, 'y');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_user`
-- 

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `user_id` int(10) unsigned NOT NULL auto_increment,
  `user_name` varchar(20) NOT NULL default '',
  `user_password` varchar(32) NOT NULL default '',
  `user_regdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `user_last_login` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) TYPE=MyISAM AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `tbl_user`
-- 

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_password`, `user_regdate`, `user_last_login`) VALUES (1, 'admin', '43e9a4ab75570f5b', '2005-02-20 17:35:44', '2005-03-02 21:00:14');
INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_password`, `user_regdate`, `user_last_login`) VALUES (3, 'webmaster', '026cf3fc6e903caf', '2005-03-02 17:52:51', '0000-00-00 00:00:00');