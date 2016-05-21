CREATE TABLE `stats_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `listtype` varchar(9) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `proptype` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `total_new` decimal(10,2) DEFAULT NULL,
  `total_off_market` decimal(10,2) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `on_market` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1571 DEFAULT CHARSET=latin1;
