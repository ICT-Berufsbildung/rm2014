CREATE TABLE `comment` (
  `id_comment` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name_author` varchar(250) NOT NULL DEFAULT '',
  `email_author` varchar(250) NOT NULL DEFAULT '',
  `rating_up` int(11) NOT NULL DEFAULT '0',
  `rating_down` int(11) NOT NULL DEFAULT '0',
  `content` mediumtext NOT NULL,
  `id_thread` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_comment`),
  KEY `id_thread` (`id_thread`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_thread`) REFERENCES `thread` (`id_thread`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tag` (
  `id_tag` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name_tag` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `thread` (
  `id_thread` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name_thread` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_thread`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `thread_tag` (
  `id_thread` int(11) unsigned NOT NULL,
  `id_tag` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_thread`,`id_tag`),
  KEY `id_tag` (`id_tag`),
  CONSTRAINT `thread_tag_ibfk_2` FOREIGN KEY (`id_tag`) REFERENCES `tag` (`id_tag`),
  CONSTRAINT `thread_tag_ibfk_1` FOREIGN KEY (`id_thread`) REFERENCES `thread` (`id_thread`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
