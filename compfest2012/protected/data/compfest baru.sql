-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 03, 2012 at 05:35 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `compfest2012-2`
--
DROP DATABASE `compfest2012-2`;
CREATE DATABASE `compfest2012-2` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `compfest2012-2`;

-- --------------------------------------------------------

--
-- Table structure for table `kumpulan_materi`
--

DROP TABLE IF EXISTS `kumpulan_materi`;
CREATE TABLE IF NOT EXISTS `kumpulan_materi` (
  `materi_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `deskripsi` text COLLATE utf8_bin NOT NULL,
  `judul` varchar(300) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`materi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- RELATIONS FOR TABLE `kumpulan_materi`:
--   `materi_id`
--       `materi` -> `materi_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

DROP TABLE IF EXISTS `materi`;
CREATE TABLE IF NOT EXISTS `materi` (
  `materi_id` int(11) NOT NULL AUTO_INCREMENT,
  `materi_type` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `template_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  `deskripsi` text COLLATE utf8_bin NOT NULL,
  `judul` varchar(300) COLLATE utf8_bin NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`materi_id`),
  KEY `template_id` (`template_id`),
  KEY `FK_user_materi` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- RELATIONS FOR TABLE `materi`:
--   `template_id`
--       `template` -> `id_template`
--   `user_id`
--       `user` -> `user_id`
--

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`materi_id`, `materi_type`, `type_id`, `template_id`, `user_id`, `urutan`, `deskripsi`, `judul`, `create_time`, `update_time`) VALUES
(2, 1, 1, 1, 4, 1, 0x746573, 'tes', 1343926550, 1343982734),
(3, 1, 1, 6, 4, 1, 0x496e69206164616c61682070656c616a6172616e20616c6a61626172206c696e656172, 'Matematika', 1343983286, 1343983316),
(4, 2, 1, 1, 4, 1, 0x746573, 'tes', 1343988155, 1343988155);

-- --------------------------------------------------------

--
-- Table structure for table `materi_kuliah`
--

DROP TABLE IF EXISTS `materi_kuliah`;
CREATE TABLE IF NOT EXISTS `materi_kuliah` (
  `materi_kuliah_id` int(11) NOT NULL AUTO_INCREMENT,
  `isi_kuliah` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`materi_kuliah_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `materi_kuliah`
--

INSERT INTO `materi_kuliah` (`materi_kuliah_id`, `isi_kuliah`) VALUES
(1, 0x0d0a746577),
(2, 0x312b31203d20320d0a322b32203d20340d0a647374);

-- --------------------------------------------------------

--
-- Table structure for table `materi_pp`
--

DROP TABLE IF EXISTS `materi_pp`;
CREATE TABLE IF NOT EXISTS `materi_pp` (
  `materi_pp_id` int(11) NOT NULL AUTO_INCREMENT,
  `link_pp` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`materi_pp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `materi_pp`
--

INSERT INTO `materi_pp` (`materi_pp_id`, `link_pp`) VALUES
(1, 0x2f636f6d7066657374323031322f696d616765732f536c696465732f656e657267792e707074);

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
CREATE TABLE IF NOT EXISTS `profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `tgllahir` date NOT NULL,
  `alamat` text NOT NULL,
  `hp` varchar(20) NOT NULL,
  `email` varchar(70) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- RELATIONS FOR TABLE `profiles`:
--   `user_id`
--       `user` -> `user_id`
--

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`user_id`, `name`, `tgllahir`, `alamat`, `hp`, `email`) VALUES
(4, 'Jordan Fernando', '2012-08-22', 'adasdadsad', '+1237124812', 'tes@tes.com'),
(5, 'Jordan Fernando', '1994-08-22', 'Jal;dnaklsnclasnmclasc', '+6289234923', 'fernandojordan.92@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `profiles_fields`
--

DROP TABLE IF EXISTS `profiles_fields`;
CREATE TABLE IF NOT EXISTS `profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` int(3) NOT NULL DEFAULT '0',
  `field_size_min` int(3) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `profiles_fields`
--

INSERT INTO `profiles_fields` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`) VALUES
(2, 'name', 'Nama', 'VARCHAR', 100, 3, 1, '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', 0, 3),
(3, 'tgllahir', 'Tanggal Lahir', 'DATE', 0, 0, 1, '', '', 'Incorrect Date', '', '', '', '', 2, 3),
(5, 'alamat', 'Alamat', 'TEXT', 200, 0, 1, '', '', 'Incorrect Address', '', '', '', '', 3, 3),
(6, 'hp', 'Nomor Handphone', 'VARCHAR', 20, 4, 1, '', '', 'Incorrect Number', '', '', '', '', 4, 3),
(7, 'email', 'Alamat Email', 'VARCHAR', 70, 5, 1, '', '', 'Incorrect Email', '', '', '', '', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

DROP TABLE IF EXISTS `template`;
CREATE TABLE IF NOT EXISTS `template` (
  `id_template` int(11) NOT NULL AUTO_INCREMENT,
  `background_link` varchar(40) COLLATE utf8_bin NOT NULL,
  `preview_link` text COLLATE utf8_bin NOT NULL,
  `icon_x` int(11) NOT NULL,
  `icon_y` int(11) NOT NULL,
  `judul_x` int(11) NOT NULL,
  `judul_y` int(11) NOT NULL,
  `isi_x` int(11) NOT NULL,
  `isi_y` int(11) NOT NULL,
  PRIMARY KEY (`id_template`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id_template`, `background_link`, `preview_link`, `icon_x`, `icon_y`, `judul_x`, `judul_y`, `isi_x`, `isi_y`) VALUES
(1, '2.jpg', 0x74656d706c617465322e706e67, 900, 250, 100, 100, 100, 180),
(3, '', 0x74656d706c617465332e706e67, 0, 0, 0, 0, 0, 0),
(5, '', 0x74656d706c617465342e706e67, 1, 1, 1, 1, 1, 1),
(6, '', 0x74656d706c617465352e706e67, 1, 1, 1, 1, 1, 1),
(7, '', 0x74656d706c617465362e706e67, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

DROP TABLE IF EXISTS `upload`;
CREATE TABLE IF NOT EXISTS `upload` (
  `id` int(11) NOT NULL,
  `power_point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `user_type` int(11) NOT NULL,
  `activation_code` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_type` (`user_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- RELATIONS FOR TABLE `user`:
--   `user_type`
--       `user_type` -> `type_id`
--

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `user_type`, `activation_code`) VALUES
(4, 'dragoon20', 'ac43724f16e9241d990427ab7c8f4228', 0, 0x3533646438626361306365636535303665616137326235623766323662306433),
(5, 'tes', '432c73e8f6a224d4810ffa75a2067ec0', 0, 0x3731303265316563313830333333663433656435393464313266373165333830);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
CREATE TABLE IF NOT EXISTS `user_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`type_id`, `type_name`) VALUES
(0, 'learner');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kumpulan_materi`
--
ALTER TABLE `kumpulan_materi`
  ADD CONSTRAINT `kumpulan_materi_ibfk_1` FOREIGN KEY (`materi_id`) REFERENCES `materi` (`materi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`template_id`) REFERENCES `template` (`id_template`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materi_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `user_profile_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_type`) REFERENCES `user_type` (`type_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
