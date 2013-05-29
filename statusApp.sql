-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 29, 2013 at 07:54 PM
-- Server version: 5.5.25
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `statusApp`
--

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `emailId` varchar(100) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `year` varchar(11) NOT NULL,
  PRIMARY KEY (`emailId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`emailId`, `firstName`, `lastName`, `password`, `year`) VALUES
('abc@123.com', 'ddd', 'ddddd', 'd8578edf8458ce06fbc5bb76a58c5ca4', '3'),
('qwerty@ffff.com', 'Rad', 'doubleRad', 'd8578edf8458ce06fbc5bb76a58c5ca4', '3'),
('rap@gmail.com', 'assssss', 'asdasdad', '2e2d7fe5d75b602595df021c7841243b', '2'),
('rapidwein@gmail.com', 'Varun', 'Sekar', 'd8578edf8458ce06fbc5bb76a58c5ca4', '2'),
('zzz@zzz.com', 'xzbxnzb', 'bxnzbxnb', 'f3abb86bd34cf4d52698f14c0da1dc60', '3');

-- --------------------------------------------------------

--
-- Table structure for table `userStatus`
--

CREATE TABLE `userStatus` (
  `emailId` varchar(100) NOT NULL,
  `curStatus` varchar(100) NOT NULL,
  `prevStatuses` mediumtext NOT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `task` varchar(100) NOT NULL,
  `completed` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userStatus`
--

INSERT INTO `userStatus` (`emailId`, `curStatus`, `prevStatuses`, `timeStamp`, `task`, `completed`) VALUES
('rapidwein@gmail.com', 'and i am doing great', 'life is good#2013-05-29 23:21:52;', '2013-05-29 17:52:34', 'how is life', 0),
('rap@gmail.com', ':) :)', 'No#2013-05-16 16:06:37;its#2013-05-16 16:06:37;Not!#2013-05-16 16:06:37;Period.#2013-05-16 16:06:37;:(#2013-05-16 16:06:37;', '2013-05-16 10:36:37', '', 0),
('rapidwein@gmail.com', 'and verified', 'status uploaded#2013-05-29 23:22:18;', '2013-05-29 17:52:49', 'task assigned', 0);
