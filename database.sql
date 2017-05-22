-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-05-22 12:56:30
-- 服务器版本： 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rsl`
--
CREATE DATABASE IF NOT EXISTS `rsl` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `rsl`;

-- --------------------------------------------------------

--
-- 表的结构 `appointment`
--

CREATE TABLE `appointment` (
  `id` char(48) NOT NULL,
  `doctor` char(48) NOT NULL,
  `patient` char(48) NOT NULL,
  `reason` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '-1',
  `booktime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `appointment`
--

INSERT INTO `appointment` (`id`, `doctor`, `patient`, `reason`, `status`, `booktime`, `createdAt`, `updatedAt`) VALUES
('4356bf435cfc2f4f96e803aad93b754c4cfd0e04', '86c741fe68ef62f83dd90d33fc41efa4ecf12c69', '29c84426daefc16e8a980ded41edcfbba91ff785', '测试的还是', 1, '2017-05-13 15:08:59', '2017-05-10 13:34:16', '2017-05-10 13:34:16');

-- --------------------------------------------------------

--
-- 表的结构 `contract`
--

CREATE TABLE `contract` (
  `id` char(48) NOT NULL,
  `doctor` char(48) NOT NULL,
  `patient` char(48) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '-1',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `contract`
--

INSERT INTO `contract` (`id`, `doctor`, `patient`, `status`, `createdAt`, `updatedAt`) VALUES
('d6821c68598f9909407e151a8edf288cad576773', '86c741fe68ef62f83dd90d33fc41efa4ecf12c69', '29c84426daefc16e8a980ded41edcfbba91ff785', 1, '2017-05-12 07:12:48', '2017-05-12 07:12:48');

-- --------------------------------------------------------

--
-- 表的结构 `hospital`
--

CREATE TABLE `hospital` (
  `id` char(48) NOT NULL,
  `address` varchar(100) NOT NULL,
  `tel` varchar(12) NOT NULL,
  `level` tinyint(4) NOT NULL,
  `intro` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `question`
--

CREATE TABLE `question` (
  `id` char(48) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `qdescribe` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `qkey` varchar(20) NOT NULL,
  `options` varchar(100) NOT NULL,
  `answer` varchar(200) NOT NULL,
  `creator` char(48) NOT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `question`
--

INSERT INTO `question` (`id`, `type`, `qdescribe`, `qkey`, `options`, `answer`, `creator`, `score`, `createdAt`) VALUES
('1', 0, '今天食欲如何？', '{"A":10,"B":5,"C":0}', '{"A":"很好","B":"一般","C":"不好"}', '', '1', 0, '2017-04-20 12:06:38'),
('2', 0, '身体是否感觉不舒服？', '{"A":10,"B":5,"C":0}', '{"A":"感觉很好","B":"感觉一般","C":"感觉不佳"}', '', '1', 0, '2017-04-20 12:09:46'),
('3', 0, '服用药物后的感觉？', '{"A":10,"B":5,"C":0}', '{"A":"良好","B":"无感觉","C":"出现不适"}', '', '1', 0, '2017-04-20 12:11:21'),
('9b487c151636f7e767311b612101905ad68009d8', 1, '复用中药后是否嗜睡？', '{"A":5,"B":2,"C":0}', '{"A":"\\u5426","B":"\\u8f7b\\u5ea6","C":"\\u55dc\\u7761"}', '', '86c741fe68ef62f83dd90d33fc41efa4ecf12c69', 0, '2017-05-12 09:40:32');

-- --------------------------------------------------------

--
-- 表的结构 `questionnaire`
--

CREATE TABLE `questionnaire` (
  `id` char(48) NOT NULL,
  `doctor` char(48) NOT NULL,
  `patient` char(48) NOT NULL,
  `intro` varchar(400) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '-1',
  `level` int(11) NOT NULL DEFAULT '-1',
  `result` varchar(400) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `questionnaire`
--

INSERT INTO `questionnaire` (`id`, `doctor`, `patient`, `intro`, `status`, `level`, `result`, `createdAt`, `updatedAt`) VALUES
('03bd9c582563766cfc61db64bc26976e8d5a7faa', '86c741fe68ef62f83dd90d33fc41efa4ecf12c69', '29c84426daefc16e8a980ded41edcfbba91ff785', '测his', 2, 6, '', '2017-05-12 10:55:47', '2017-05-12 10:55:47'),
('b65a55a7892876ea4cac7c018bc9daebeba01428', '86c741fe68ef62f83dd90d33fc41efa4ecf12c69', '29c84426daefc16e8a980ded41edcfbba91ff785', '周末病情回访', 1, 0, '', '2017-05-12 10:56:31', '2017-05-12 10:56:31');

-- --------------------------------------------------------

--
-- 表的结构 `record`
--

CREATE TABLE `record` (
  `id` char(48) NOT NULL,
  `questionnaire` char(48) NOT NULL,
  `question` char(48) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `record`
--

INSERT INTO `record` (`id`, `questionnaire`, `question`, `answer`, `score`, `createdAt`) VALUES
('1f284055ab4c6d648d3e08ae196f886a4ba666bf', '03bd9c582563766cfc61db64bc26976e8d5a7faa', '3', 'B', 0, '2017-05-12 10:55:47'),
('9de9b22ed1f0ccd9b686331da32b5163f93384b3', 'b65a55a7892876ea4cac7c018bc9daebeba01428', '3', 'B', 0, '2017-05-12 10:56:31'),
('ab997234ec8e34ddd212f11f7382b68dfba1436f', '03bd9c582563766cfc61db64bc26976e8d5a7faa', '2', 'B', 0, '2017-05-12 10:55:48'),
('cdbeb0cb2f105eebc476b677a3a6969aa3303309', 'b65a55a7892876ea4cac7c018bc9daebeba01428', '2', 'B', 0, '2017-05-12 10:56:32');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` varchar(48) NOT NULL,
  `username` varchar(24) NOT NULL,
  `password` char(24) NOT NULL,
  `nickname` char(24) NOT NULL,
  `phone` char(11) NOT NULL,
  `sex` tinyint(4) NOT NULL DEFAULT '-1',
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `verify` tinyint(4) NOT NULL DEFAULT '-1',
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `no` char(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nickname`, `phone`, `sex`, `type`, `verify`, `updatedAt`, `no`) VALUES
('1', 'admin', 'admin', 'admin', '18777552223', 1, 0, 1, '2017-04-18 06:07:34', '1'),
('29c84426daefc16e8a980ded41edcfbba91ff785', 'test', '123456', '体重', '18777552223', 0, 2, -1, '2017-04-18 15:53:15', ''),
('86c741fe68ef62f83dd90d33fc41efa4ecf12c69', 'tom', '123456', '', '', -1, 1, 1, '2017-04-19 03:31:26', ''),
('95c97e1ea2feaa33fca55a09abedc3c6eed89aac', '123', '123456', '', '', -1, 2, -1, '2017-04-19 13:19:02', ''),
('ed22fa9bf380a63e424ee16dc8f6dccfb8f2a0fa', 'sandy', '123456', '', '', -1, 1, -1, '2017-04-19 03:37:55', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor` (`doctor`),
  ADD KEY `patient` (`patient`),
  ADD KEY `doctor_2` (`doctor`);

--
-- Indexes for table `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor` (`doctor`),
  ADD KEY `patient` (`patient`),
  ADD KEY `doctor_2` (`doctor`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `i_creator` (`creator`);

--
-- Indexes for table `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `q_doctor` (`doctor`),
  ADD KEY `q_patient` (`patient`);

--
-- Indexes for table `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `r_quest` (`questionnaire`),
  ADD KEY `r_question` (`question`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- 限制导出的表
--

--
-- 限制表 `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `a_doctor` FOREIGN KEY (`doctor`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `a_patient` FOREIGN KEY (`patient`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `contract`
--
ALTER TABLE `contract`
  ADD CONSTRAINT `c_doctor` FOREIGN KEY (`doctor`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `c_patient` FOREIGN KEY (`patient`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `q_creator` FOREIGN KEY (`creator`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD CONSTRAINT `q_doctor` FOREIGN KEY (`doctor`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `q_patient` FOREIGN KEY (`patient`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `record`
--
ALTER TABLE `record`
  ADD CONSTRAINT `r_qst` FOREIGN KEY (`question`) REFERENCES `question` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `r_qsta` FOREIGN KEY (`questionnaire`) REFERENCES `questionnaire` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
