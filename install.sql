
CREATE DATABASE `xc_todo` /*!40100 DEFAULT CHARACTER SET utf8 */;

CREATE TABLE `todo_entry` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `is_done` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;



