/*
Author: Srinivas
Description: Creates the stats_bed database table
*/

CREATE TABLE `stats_bed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stats_geo_id` int(11) DEFAULT NULL,
  `zip` int(5) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `county` varchar(45) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `bed_count` int(11) DEFAULT NULL,
  `average` decimal(10,2) DEFAULT NULL,
  `lowest` decimal(10,2) DEFAULT NULL,
  `highest` decimal(10,2) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `on_market` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


