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

INSERT INTO `thread` (`id_thread`, `name_thread`)
VALUES
  (1,'PDO'),
  (2,'PHP vs. Java'),
  (3,'Dash Documentation');

INSERT INTO `comment` (`id_comment`, `name_author`, `email_author`, `rating_up`, `rating_down`, `content`, `id_thread`)
VALUES
  (1,'Max Muster','max@muster.com',9,2,'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',1),
  (2,'Hans Ueli','hans@example.org',4,0,'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',2),
  (3,'Peter Müller','peter@example.org',19,10,'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',3),
  (6,'Hans Ueli','hans@example.org',2,1,'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',2);

INSERT INTO `tag` (`id_tag`, `name_tag`)
VALUES
  (1,'documentation'),
  (2,'php'),
  (3,'java'),
  (4,'dash');

INSERT INTO `thread_tag` (`id_thread`, `id_tag`)
VALUES
  (3,1),
  (1,2),
  (2,2),
  (3,2),
  (2,3),
  (3,4);

