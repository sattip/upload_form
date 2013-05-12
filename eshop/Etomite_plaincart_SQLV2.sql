CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `ct_id` int(10) unsigned NOT NULL auto_increment,
  `pd_id` int(10) unsigned NOT NULL default '0',
  `ct_qty` mediumint(8) unsigned NOT NULL default '1',
  `ct_session_id` char(32) NOT NULL default '',
  `ct_date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`ct_id`),
  KEY `pd_id` (`pd_id`),
  KEY `ct_session_id` (`ct_session_id`)
) ENGINE=MyISAM  AUTO_INCREMENT=96 ;

INSERT INTO `tbl_cart` VALUES(72, 24, 1, '96e7b00ae697ac51f35ccebd0e55caea', '2008-02-12 11:26:16');
INSERT INTO `tbl_cart` VALUES(69, 22, 1, '7dbe2570c9172262f94eb7e957da61cb', '2008-02-12 01:18:47');

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `cat_id` int(10) unsigned NOT NULL auto_increment,
  `cat_parent_id` int(11) NOT NULL default '0',
  `cat_name` varchar(50) NOT NULL default '',
  `cat_description` varchar(200) NOT NULL default '',
  `cat_image` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`cat_id`),
  KEY `cat_parent_id` (`cat_parent_id`),
  KEY `cat_name` (`cat_name`)
) ENGINE=MyISAM   AUTO_INCREMENT=22 ;


INSERT INTO `tbl_category` VALUES(21, 19, 'Rock and Roll', 'Rock It !', 'a1527634b9265d806823d40bce624189.jpg');
INSERT INTO `tbl_category` VALUES(20, 18, 'Literary Classics', 'Timeless Classics', '8d50b087fe53661fb185561cc8844d45.jpg');
INSERT INTO `tbl_category` VALUES(18, 0, 'Books', 'The best range of best sellers.', '199f267a5a06b6436c296b6a3721edaa.jpg');
INSERT INTO `tbl_category` VALUES(19, 0, 'CD''s', 'The hottest range of the Latest CD''s', 'dcf63657b84ab8417a72ca3e247400d7.jpg');

CREATE TABLE IF NOT EXISTS `tbl_currency` (
  `cy_id` int(10) unsigned NOT NULL auto_increment,
  `cy_code` char(3) NOT NULL default '',
  `cy_symbol` varchar(8) NOT NULL default '',
  PRIMARY KEY  (`cy_id`)
) ENGINE=MyISAM  AUTO_INCREMENT=5 ;


INSERT INTO `tbl_currency` VALUES(1, 'EUR', '&#8364;');
INSERT INTO `tbl_currency` VALUES(2, 'GBP', '&pound;');
INSERT INTO `tbl_currency` VALUES(3, 'JPY', '&yen;');
INSERT INTO `tbl_currency` VALUES(4, 'USD', '$');


CREATE TABLE IF NOT EXISTS `tbl_order` (
  `od_id` int(10) unsigned NOT NULL auto_increment,
  `od_date` datetime default NULL,
  `od_last_update` datetime NOT NULL default '0000-00-00 00:00:00',
  `od_status` enum('New','Paid','Shipped','Completed','Cancelled') NOT NULL default 'New',
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
) ENGINE=MyISAM  AUTO_INCREMENT=1032 ;


INSERT INTO `tbl_order` VALUES(1031, '2008-02-13 17:01:28', '2008-02-13 17:03:56', 'Paid', 'Here is my memo as typed in the paypal site for the seller...', 'Tester', 'Tester', '123 long street', 'suburb', '12345555', 'Brisbane', 'QLD', '4001', '5.00', 'Tester', 'Tester', '123 long street', 'suburb', '12345555', 'Brisbane', 'QLD', '4001');


CREATE TABLE IF NOT EXISTS `tbl_order_item` (
  `od_id` int(10) unsigned NOT NULL default '0',
  `pd_id` int(10) unsigned NOT NULL default '0',
  `od_qty` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`od_id`,`pd_id`)
) ENGINE=MyISAM;


INSERT INTO `tbl_order_item` VALUES(1002, 22, 1);


CREATE TABLE IF NOT EXISTS `tbl_product` (
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
) ENGINE=MyISAM  AUTO_INCREMENT=28 ;


INSERT INTO `tbl_product` VALUES(25, 20, 'War and Peace', 'This literary Classic by Leo will keep you amused for hours.', '55.90', 100, '8cff6631e999f4f7735bde0b5a17e28f.jpg', '753e7aab1603c63ac56a2671ab52dc78.jpg', '2008-02-13 04:24:02', '0000-00-00 00:00:00');
INSERT INTO `tbl_product` VALUES(26, 21, 'RockJunkies', 'This band broke all records...you''ll never forget this album.', '12.55', 199, '600036dfe051c60de911ff3fa9c668db.jpg', 'c5c0f2edc9a777ab96f0947011d21129.jpg', '2008-02-13 05:12:32', '0000-00-00 00:00:00');
INSERT INTO `tbl_product` VALUES(27, 20, 'The Kids Book', 'This book is loved by kids of all ages.', '12.00', 58, '89e5fc78994decdc2e57525134178d18.jpg', '6a56f648083c3b1dbee99f75f53a3a0b.jpg', '2008-02-13 05:30:32', '0000-00-00 00:00:00');

CREATE TABLE IF NOT EXISTS `tbl_shop_config` (
  `sc_name` varchar(50) NOT NULL default '',
  `sc_address` varchar(100) NOT NULL default '',
  `sc_phone` varchar(30) NOT NULL default '',
  `sc_email` varchar(30) NOT NULL default '',
  `sc_shipping_cost` decimal(5,2) NOT NULL default '0.00',
  `sc_currency` int(10) unsigned NOT NULL default '1',
  `sc_order_email` enum('y','n') NOT NULL default 'n'
) ENGINE=MyISAM;


INSERT INTO `tbl_shop_config` VALUES('PlainCart - Just a plain online shop for Etomite', 'Address Here,\r\nCity, State, Country.', '61 07 333 333 33', 'email@biglake.com', '5.00', 4, 'n');


CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(10) unsigned NOT NULL auto_increment,
  `user_name` varchar(20) NOT NULL default '',
  `user_password` varchar(32) NOT NULL,
  `user_regdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `user_last_login` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=MyISAM  AUTO_INCREMENT=4 ;


INSERT INTO `tbl_user` VALUES(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', '2005-02-20 17:35:44', '2008-02-13 04:58:48');
