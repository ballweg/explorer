-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 02, 2013 at 04:30 PM
-- Server version: 5.5.29
-- PHP Version: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `explorer`
--

-- --------------------------------------------------------

--
-- Table structure for table `jqm_categories`
--

CREATE TABLE `jqm_categories` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `contains` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `jqm_categories`
--

INSERT INTO `jqm_categories` (`id`, `name`, `contains`) VALUES
(1, 'Notebooks', 3),
(2, 'Smartphones', 4),
(3, 'Tablets', 4);

-- --------------------------------------------------------

--
-- Table structure for table `jqm_products`
--

CREATE TABLE `jqm_products` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `category` int(6) unsigned NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `manufacturer` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `jqm_products`
--

INSERT INTO `jqm_products` (`id`, `category`, `name`, `manufacturer`, `price`) VALUES
(1, 1, 'MacBook Air', 'Apple', 999),
(2, 1, 'MacBook Pro', 'Apple', 1500),
(3, 1, 'Vaio', 'Sony', 899),
(4, 2, 'iPhone 4', 'Apple', 650),
(5, 2, 'Galaxy S2', 'Samsung', 620),
(6, 2, 'Incredible S', 'HTC', 560),
(7, 2, 'Sensation', 'HTC', 590),
(8, 3, 'iPad 2', 'Apple', 500),
(9, 3, 'Galaxy Tab', 'Samsung', 480),
(10, 3, 'Eee Pad', 'Asus', 400),
(11, 3, 'Iconia Tab', 'Acer', 480);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `interest` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `signup` date DEFAULT NULL,
  `first_logon` date DEFAULT NULL,
  `last_active` date DEFAULT NULL,
  `points` int(10) DEFAULT '0',
  `level` int(1) DEFAULT '0',
  `earned_rewards` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `completed` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `viewed` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `eligible` tinyint(1) DEFAULT NULL,
  `complete` tinyint(1) DEFAULT NULL,
  `complete_time` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `email`, `interest`, `signup`, `first_logon`, `last_active`, `points`, `level`, `earned_rewards`, `completed`, `viewed`, `eligible`, `complete`, `complete_time`) VALUES
(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'Jeff Ballweg', 'jeff.ballweg@cdu.edu.au', 'computers', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, 0, NULL);
