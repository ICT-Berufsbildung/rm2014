-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Lun 23 Septembre 2013 à 23:23
-- Version du serveur: 5.5.32
-- Version de PHP: 5.4.16

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données: `ict_championships`
--
CREATE DATABASE IF NOT EXISTS `ict_championships` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ict_championships`;

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id_tag` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_tag` varchar(250) NOT NULL,
  PRIMARY KEY (`id_tag`),
  UNIQUE KEY `name_tag_UNIQUE` (`name_tag`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `thread`
--

DROP TABLE IF EXISTS `thread`;
CREATE TABLE IF NOT EXISTS `thread` (
  `id_thread` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_thread` varchar(250) NOT NULL,
  PRIMARY KEY (`id_thread`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `thread`
--

INSERT INTO `thread` (`id_thread`, `name_thread`) VALUES
(1, 'First Thread'),
(2, 'Second Thread');

SET FOREIGN_KEY_CHECKS=1;
COMMIT;
