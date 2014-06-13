-- phpMyAdmin SQL Dump
-- version 4.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2014 at 08:25 AM
-- Server version: 5.6.17
-- PHP Version: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `indexer3`
--
CREATE DATABASE IF NOT EXISTS `indexer3` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `indexer3`;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
`id_file` bigint(20) unsigned NOT NULL,
  `name` varchar(200) NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `File_word`
--

DROP TABLE IF EXISTS `File_word`;
CREATE TABLE IF NOT EXISTS `File_word` (
  `count` int(11) NOT NULL,
  `id_file` bigint(20) unsigned NOT NULL,
  `id_word` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Meta_info`
--

DROP TABLE IF EXISTS `Meta_info`;
CREATE TABLE IF NOT EXISTS `Meta_info` (
  `content` text NOT NULL,
  `id_file` bigint(20) unsigned NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `words`
--

DROP TABLE IF EXISTS `words`;
CREATE TABLE IF NOT EXISTS `words` (
`id_word` bigint(20) unsigned NOT NULL,
  `word` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=138 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
 ADD PRIMARY KEY (`id_file`), ADD UNIQUE KEY `id_file` (`id_file`);

--
-- Indexes for table `File_word`
--
ALTER TABLE `File_word`
 ADD PRIMARY KEY (`id_file`,`id_word`), ADD KEY `fk_word` (`id_word`);

--
-- Indexes for table `Meta_info`
--
ALTER TABLE `Meta_info`
 ADD PRIMARY KEY (`id_file`,`type`);

--
-- Indexes for table `words`
--
ALTER TABLE `words`
 ADD PRIMARY KEY (`id_word`), ADD UNIQUE KEY `id_word` (`id_word`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
MODIFY `id_file` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `words`
--
ALTER TABLE `words`
MODIFY `id_word` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=138;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `File_word`
--
ALTER TABLE `File_word`
ADD CONSTRAINT `fk_word` FOREIGN KEY (`id_word`) REFERENCES `words` (`id_word`),
ADD CONSTRAINT `fk_file` FOREIGN KEY (`id_file`) REFERENCES `files` (`id_file`);

--
-- Constraints for table `Meta_info`
--
ALTER TABLE `Meta_info`
ADD CONSTRAINT `fk_file_meta` FOREIGN KEY (`id_file`) REFERENCES `files` (`id_file`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
