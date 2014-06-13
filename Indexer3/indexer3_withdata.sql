-- phpMyAdmin SQL Dump
-- version 4.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2014 at 08:23 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
`id_file` bigint(20) unsigned NOT NULL,
  `name` varchar(200) NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id_file`, `name`, `url`) VALUES
(1, 'tchauu', '/Users/bihletti/Documents/apachefiles/tchauu.html'),
(2, 'Homework3testpage', '/Users/bihletti/Documents/apachefiles/teste/Homework3testpage.html'),
(3, 'oii', '/Users/bihletti/Documents/apachefiles/teste/oii.html'),
(4, 'oii', '/Users/bihletti/Documents/apachefiles/oii.html');

-- --------------------------------------------------------

--
-- Table structure for table `File_word`
--

CREATE TABLE IF NOT EXISTS `File_word` (
  `count` int(11) NOT NULL,
  `id_file` bigint(20) unsigned NOT NULL,
  `id_word` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `File_word`
--

INSERT INTO `File_word` (`count`, `id_file`, `id_word`) VALUES
(1, 1, 1),
(1, 1, 2),
(1, 2, 2),
(1, 2, 3),
(1, 2, 4),
(7, 2, 5),
(1, 2, 6),
(1, 2, 7),
(1, 2, 8),
(6, 2, 9),
(1, 2, 10),
(3, 2, 11),
(1, 2, 12),
(1, 2, 13),
(1, 2, 14),
(1, 2, 15),
(1, 2, 16),
(1, 2, 17),
(2, 2, 18),
(1, 2, 19),
(1, 2, 20),
(1, 2, 21),
(2, 2, 22),
(1, 2, 23),
(5, 2, 24),
(1, 2, 25),
(1, 2, 26),
(1, 2, 27),
(1, 2, 28),
(1, 2, 29),
(1, 2, 30),
(1, 2, 31),
(1, 2, 32),
(1, 2, 33),
(1, 2, 34),
(1, 2, 35),
(1, 2, 36),
(1, 2, 37),
(1, 2, 38),
(1, 2, 39),
(1, 2, 40),
(1, 2, 41),
(1, 2, 42),
(1, 2, 43),
(1, 2, 44),
(1, 2, 45),
(1, 2, 46),
(1, 2, 47),
(1, 2, 48),
(1, 2, 49),
(1, 2, 50),
(1, 2, 51),
(1, 2, 52),
(1, 2, 53),
(2, 2, 54),
(2, 2, 55),
(2, 2, 56),
(4, 2, 57),
(1, 2, 58),
(3, 2, 59),
(1, 2, 60),
(1, 2, 61),
(1, 2, 62),
(1, 2, 63),
(1, 2, 64),
(1, 2, 65),
(2, 2, 66),
(1, 2, 67),
(1, 2, 68),
(1, 2, 69),
(2, 2, 70),
(1, 2, 71),
(1, 2, 72),
(1, 2, 73),
(1, 2, 74),
(1, 2, 75),
(1, 2, 76),
(1, 2, 77),
(1, 2, 78),
(8, 2, 79),
(1, 2, 80),
(1, 2, 81),
(3, 2, 82),
(1, 2, 83),
(1, 2, 84),
(1, 2, 85),
(1, 2, 86),
(1, 2, 87),
(1, 2, 88),
(1, 2, 89),
(1, 2, 90),
(1, 2, 91),
(1, 2, 92),
(1, 2, 93),
(1, 2, 94),
(1, 2, 95),
(1, 2, 96),
(2, 2, 97),
(1, 2, 98),
(1, 2, 99),
(1, 2, 100),
(1, 2, 101),
(1, 2, 102),
(1, 2, 103),
(1, 2, 104),
(1, 2, 105),
(1, 2, 106),
(1, 2, 107),
(1, 2, 108),
(15, 2, 109),
(1, 2, 110),
(2, 2, 111),
(2, 2, 112),
(7, 2, 113),
(1, 2, 114),
(1, 2, 115),
(2, 2, 116),
(1, 2, 117),
(1, 2, 118),
(1, 2, 119),
(1, 2, 120),
(1, 2, 121),
(1, 2, 122),
(1, 2, 123),
(1, 2, 124),
(1, 2, 125),
(1, 2, 126),
(1, 2, 127),
(1, 2, 128),
(3, 2, 129),
(1, 2, 130),
(1, 2, 131),
(1, 2, 132),
(1, 2, 133),
(1, 2, 134),
(3, 2, 135),
(1, 2, 136),
(1, 3, 2),
(1, 3, 137),
(1, 4, 2),
(1, 4, 137);

-- --------------------------------------------------------

--
-- Table structure for table `Meta_info`
--

CREATE TABLE IF NOT EXISTS `Meta_info` (
  `content` text NOT NULL,
  `id_file` bigint(20) unsigned NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Meta_info`
--

INSERT INTO `Meta_info` (`content`, `id_file`, `type`) VALUES
('SGabarro', 2, 'author'),
('This is a stupid page, but who cares', 2, 'description'),
('NOTEPAD', 2, 'generator'),
('test page, homework 3b, stupid, silly, PHP', 2, 'keywords');

-- --------------------------------------------------------

--
-- Table structure for table `words`
--

CREATE TABLE IF NOT EXISTS `words` (
`id_word` bigint(20) unsigned NOT NULL,
  `word` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=138 ;

--
-- Dumping data for table `words`
--

INSERT INTO `words` (`id_word`, `word`) VALUES
(1, 'tchau'),
(2, 'test'),
(3, '186k'),
(4, 'affection'),
(5, 'alicante'),
(6, 'all'),
(7, 'always'),
(8, 'an'),
(9, 'and'),
(10, 'another'),
(11, 'as'),
(12, 'aspects'),
(13, 'author'),
(14, 'average'),
(15, 'beaches'),
(16, 'beauty'),
(17, 'between'),
(18, 'by'),
(19, 'can'),
(20, 'care'),
(21, 'centre'),
(22, 'choose'),
(23, 'cities'),
(24, 'city'),
(25, 'climate'),
(26, 'communication'),
(27, 'congress'),
(28, 'cuisine'),
(29, 'culture'),
(30, 'deeply-felt'),
(31, 'do'),
(32, 'done'),
(33, 'doubt'),
(34, 'enjoy'),
(35, 'enrapturing'),
(36, 'exceptional'),
(37, 'exchange'),
(38, 'fair'),
(39, 'festivities'),
(40, 'find'),
(41, 'first'),
(42, 'for'),
(43, 'friendliest'),
(44, 'from'),
(45, 'fuster'),
(46, 'gabriel'),
(47, 'gardens'),
(48, 'gil-albert'),
(49, 'go'),
(50, 'has'),
(51, 'help'),
(52, 'history'),
(53, 'homework'),
(54, 'if'),
(55, 'in'),
(56, 'information'),
(57, 'is'),
(58, 'it'),
(59, 'its'),
(60, 'joan'),
(61, 'juan'),
(62, 'just'),
(63, 'kind'),
(64, 'links'),
(65, 'live'),
(66, 'location'),
(67, 'looks'),
(68, 'love'),
(69, 'map'),
(70, 'mediterranean'),
(71, 'mildness'),
(72, 'mir&oacute'),
(73, 'monuments'),
(74, 'mountains'),
(75, 'museums'),
(76, 'my'),
(77, 'native'),
(78, 'nights'),
(79, 'of'),
(80, 'offices'),
(81, 'on'),
(82, 'one'),
(83, 'or'),
(84, 'page'),
(85, 'parks'),
(86, 'pervaded'),
(87, 'pierced'),
(88, 'playing'),
(89, 'premises'),
(90, 'privileged'),
(91, 'provides'),
(92, 'roams'),
(93, 'role'),
(94, 'round'),
(95, 'said'),
(96, 'savour'),
(97, 'sea'),
(98, 'seaport'),
(99, 'second'),
(100, 'shopping'),
(101, 'shown'),
(102, 'special'),
(103, 'sports'),
(104, 'stems'),
(105, 'streets'),
(106, 'take'),
(107, 'temperature'),
(108, 'that'),
(109, 'the'),
(110, 'these'),
(111, 'this'),
(112, 'through'),
(113, 'to'),
(114, 'tourist'),
(115, 'trade'),
(116, 'trip'),
(117, 'two'),
(118, 'uninterruptedly'),
(119, 'valencian'),
(120, 'village'),
(121, 'virtual'),
(122, 'walk'),
(123, 'were'),
(124, 'what'),
(125, 'where'),
(126, 'wherever'),
(127, 'which'),
(128, 'will'),
(129, 'with'),
(130, 'without'),
(131, 'words'),
(132, 'would'),
(133, 'wrote'),
(134, 'year'),
(135, 'you'),
(136, '18'),
(137, 'oi');

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
