-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 25, 2017 at 05:56 AM
-- Server version: 5.6.35
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cupcakes_marhaba`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `companyid` int(11) NOT NULL,
  `companyname` varchar(100) DEFAULT NULL,
  `companyaddress` varchar(100) DEFAULT NULL,
  `isdelete` varchar(1) DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`companyid`, `companyname`, `companyaddress`, `isdelete`) VALUES
(1, 'ASTER', 'UAE', 'N'),
(2, 'LA MARQUIS', 'UAE', 'N'),
(3, 'AL KABEER', 'UAE', 'N'),
(4, 'ACCESS', 'UAE', 'N'),
(5, 'FUJAIRAH NATIONAL CONSTRUCTION', 'DUBAI', 'N'),
(6, 'AMBER', 'GULF HEALTH CARE DUBAI', 'N'),
(7, 'NCE', 'ABU DHABI', 'N'),
(8, 'PURE GOLD', 'DUBAI', 'N'),
(9, 'MEDCARE', 'SHARJAH', 'N'),
(10, 'SMC', 'ABU DHABI', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `customers_auth`
--

CREATE TABLE `customers_auth` (
  `uid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` int(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers_auth`
--

INSERT INTO `customers_auth` (`uid`, `name`, `username`, `password`, `role`, `created`) VALUES
(187, 'Saleh Galiwal', 'Saleh', '$2a$10$34244f7e4d53f234a4099OqSMPWXbeE/tg4Mfr50.dtZG4/WGMQqS', 0, '2017-03-17 11:58:15'),
(188, 'Saleh G', 'salehg', '$2a$10$904eb8b988db828d5fa51uBZ9tPqr/y3kOroHPFdu5C3O9CFQbRhy', 0, '2017-04-08 14:35:08'),
(189, 'Tailor', 'tailor', '$2a$10$2ca073416eb36818a1345uWdLQXOqJxdmroG4qn370hI1PjQIO3g2', 2, '2017-05-16 05:55:18'),
(190, 'Fatema', 'Fatema', '$2a$10$9d9e0d2df62a131bc76d8uFkPPlWSOETXALx5A./cWl9THaVzxQHC', 1, '2017-05-29 10:48:43'),
(191, 'ZIA RAZZAK', 'ZIA', '$2a$10$ab3b5f950feda4a768a5bODHFawMIa4rRhRd8LuMYSky67vLMmRyG', 1, '2017-05-30 08:39:55'),
(192, 'Mubarak', 'Mubarak', '$2a$10$4487e8ba2c3411ba8ae52uxHUoj.2Oe8FZdI0WshNhU.kGdEFiZM2', 2, '2017-07-22 14:23:19');

-- --------------------------------------------------------

--
-- Table structure for table `dresses`
--

CREATE TABLE `dresses` (
  `dressid` int(11) NOT NULL,
  `dressname` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dresses`
--

INSERT INTO `dresses` (`dressid`, `dressname`) VALUES
(1, 'Shirt'),
(2, 'Trouser'),
(3, 'Jacket'),
(4, 'T-shirt'),
(5, 'Skirt'),
(6, 'Coat');

-- --------------------------------------------------------

--
-- Table structure for table `jobitems`
--

CREATE TABLE `jobitems` (
  `jobitemid` int(11) NOT NULL,
  `jobid` int(11) DEFAULT NULL,
  `dressid` int(11) DEFAULT NULL,
  `qty` int(5) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `assignto` int(11) DEFAULT NULL,
  `dateassigned` date DEFAULT NULL,
  `datecomplete` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jobitems`
--

INSERT INTO `jobitems` (`jobitemid`, `jobid`, `dressid`, `qty`, `status`, `assignto`, `dateassigned`, `datecomplete`) VALUES
(14, 25, 1, 30, 'Complete', 187, '2017-05-12', '2017-05-12'),
(15, 25, 2, 12, 'Pending', NULL, NULL, NULL),
(16, 25, 3, 11, 'Pending', NULL, NULL, NULL),
(17, 27, 1, 1, 'Complete', 188, NULL, '2017-05-12'),
(18, 28, 4, 3, 'Pending', NULL, NULL, NULL),
(19, 28, 5, 3, 'Pending', NULL, NULL, NULL),
(20, 28, 3, 1, 'Pending', NULL, NULL, NULL),
(21, 31, 1, 1, 'Complete', 187, NULL, '2017-05-12'),
(22, 32, 1, 1, 'Pending', 187, NULL, NULL),
(23, 33, 1, 1, 'Pending', NULL, NULL, NULL),
(24, 33, 2, 2, 'Pending', NULL, NULL, NULL),
(25, 33, 3, 3, 'Pending', NULL, NULL, NULL),
(26, 34, 1, 10, 'Processing', 188, '2017-05-13', NULL),
(27, 34, 2, 11, 'Pending', NULL, NULL, NULL),
(28, 35, 1, 10, 'Processing', 189, '2017-05-29', NULL),
(29, 39, 0, 0, 'Pending', NULL, NULL, NULL),
(30, 39, 0, 0, 'Pending', NULL, NULL, NULL),
(31, 40, 0, 0, 'Pending', NULL, NULL, NULL),
(32, 40, 0, 0, 'Pending', NULL, NULL, NULL),
(33, 40, 0, 0, 'Pending', NULL, NULL, NULL),
(34, 41, 0, 0, 'Pending', NULL, NULL, NULL),
(35, 41, 0, 0, 'Pending', NULL, NULL, NULL),
(36, 41, 0, 0, 'Pending', NULL, NULL, NULL),
(37, 42, 0, 0, 'Pending', NULL, NULL, NULL),
(38, 42, 0, 0, 'Pending', NULL, NULL, NULL),
(39, 42, 0, 0, 'Pending', NULL, NULL, NULL),
(40, 43, 1, 10, 'Pending', NULL, NULL, NULL),
(41, 43, 0, 0, 'Pending', NULL, NULL, NULL),
(42, 44, 1, 10, 'Pending', 187, NULL, NULL),
(43, 44, 0, 0, 'Pending', NULL, NULL, NULL),
(44, 44, 0, 0, 'Pending', NULL, NULL, NULL),
(45, 45, 1, 5, 'Pending', NULL, NULL, NULL),
(46, 45, 3, 5, 'Pending', NULL, NULL, NULL),
(47, 45, 0, 2, 'Pending', NULL, NULL, NULL),
(48, 46, 1, 2, 'Pending', NULL, NULL, NULL),
(49, 46, 0, 0, 'Pending', NULL, NULL, NULL),
(50, 46, 0, 0, 'Pending', NULL, NULL, NULL),
(51, 47, 1, 12, 'Pending', NULL, NULL, NULL),
(52, 47, 2, 15, 'Pending', NULL, NULL, NULL),
(53, 47, 3, 15, 'Pending', NULL, NULL, NULL),
(54, 48, 1, 5, 'Pending', NULL, NULL, NULL),
(55, 48, 2, 4, 'Pending', NULL, NULL, NULL),
(56, 48, 3, 2, 'Pending', NULL, NULL, NULL),
(57, 49, 1, 3, 'Processing', 192, '2017-07-22', '2017-06-27'),
(58, 49, 2, 3, 'Pending', NULL, NULL, NULL),
(59, 49, 3, 2, 'Pending', NULL, NULL, NULL),
(60, 50, 1, 2, 'Pending', NULL, NULL, NULL),
(61, 50, 0, 0, 'Pending', NULL, NULL, NULL),
(62, 50, 0, 0, 'Pending', NULL, NULL, NULL),
(63, 51, 1, 2, 'Pending', NULL, NULL, NULL),
(64, 52, 1, 3, 'Pending', NULL, NULL, NULL),
(65, 52, 2, 3, 'Pending', NULL, NULL, NULL),
(66, 52, 6, 2, 'Pending', NULL, NULL, NULL),
(67, 53, 1, 3, 'Pending', NULL, NULL, NULL),
(68, 53, 2, 3, 'Pending', NULL, NULL, NULL),
(69, 53, 6, 2, 'Pending', NULL, NULL, NULL),
(70, 54, 1, 3, 'Pending', NULL, NULL, NULL),
(71, 54, 2, 3, 'Complete', 192, '2017-07-22', '2017-07-22'),
(72, 55, 1, 3, 'Pending', NULL, NULL, NULL),
(73, 54, 6, 2, 'Pending', NULL, NULL, NULL),
(74, 55, 2, 3, 'Pending', NULL, NULL, NULL),
(75, 55, 6, 2, 'Pending', NULL, NULL, NULL),
(76, 56, 6, 2, 'Pending', NULL, NULL, NULL),
(77, 57, 1, 3, 'Pending', NULL, NULL, NULL),
(78, 57, 2, 3, 'Pending', NULL, NULL, NULL),
(79, 57, 6, 3, 'Pending', NULL, NULL, NULL),
(80, 58, 1, 20, 'Pending', NULL, NULL, NULL),
(81, 59, 1, 3, 'Pending', NULL, NULL, NULL),
(82, 59, 2, 3, 'Pending', NULL, NULL, NULL),
(83, 59, 3, 2, 'Pending', NULL, NULL, NULL),
(84, 60, 1, 3, 'Pending', NULL, NULL, NULL),
(85, 60, 2, 3, 'Pending', NULL, NULL, NULL),
(86, 60, 3, 2, 'Pending', NULL, NULL, NULL),
(87, 61, 1, 3, 'Pending', NULL, NULL, NULL),
(88, 61, 2, 3, 'Pending', NULL, NULL, NULL),
(89, 61, 3, 2, 'Pending', NULL, NULL, NULL),
(90, 62, 1, 3, 'Pending', NULL, NULL, NULL),
(91, 62, 2, 3, 'Pending', NULL, NULL, NULL),
(92, 62, 3, 2, 'Pending', NULL, NULL, NULL),
(93, 63, 1, 3, 'Pending', NULL, NULL, NULL),
(94, 63, 2, 3, 'Pending', NULL, NULL, NULL),
(95, 64, 1, 3, 'Pending', NULL, NULL, NULL),
(96, 64, 2, 3, 'Pending', NULL, NULL, NULL),
(97, 64, 3, 2, 'Pending', NULL, NULL, NULL),
(98, 65, 1, 3, 'Pending', NULL, NULL, NULL),
(99, 65, 2, 3, 'Pending', NULL, NULL, NULL),
(100, 66, 1, 3, 'Pending', NULL, NULL, NULL),
(101, 66, 2, 3, 'Pending', NULL, NULL, NULL),
(102, 67, 1, 3, 'Pending', NULL, NULL, NULL),
(103, 67, 2, 3, 'Pending', NULL, NULL, NULL),
(104, 68, 1, 3, 'Pending', NULL, NULL, NULL),
(105, 68, 2, 3, 'Pending', NULL, NULL, NULL),
(106, 69, 1, 3, 'Pending', NULL, NULL, NULL),
(107, 69, 2, 3, 'Pending', NULL, NULL, NULL),
(108, 70, 1, 3, 'Pending', NULL, NULL, NULL),
(109, 70, 2, 3, 'Pending', NULL, NULL, NULL),
(110, 71, 1, 3, 'Pending', NULL, NULL, NULL),
(111, 71, 2, 3, 'Pending', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobitemsmeasurements`
--

CREATE TABLE `jobitemsmeasurements` (
  `measurementitemsid` int(20) NOT NULL,
  `jobitemsid` int(11) DEFAULT NULL,
  `measurementid` varchar(11) DEFAULT NULL,
  `value` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jobitemsmeasurements`
--

INSERT INTO `jobitemsmeasurements` (`measurementitemsid`, `jobitemsid`, `measurementid`, `value`) VALUES
(42, 14, 's1', '0'),
(43, 14, 's2', '0'),
(44, 14, 's3', '0'),
(45, 14, 's4', '0'),
(46, 14, 's5', '0'),
(47, 14, 's6', '0'),
(48, 14, 's7', '0'),
(49, 14, 's8', '0'),
(50, 15, 's1', '0'),
(51, 15, 's2', '0'),
(52, 15, 's5', '0'),
(53, 15, 's9', '0'),
(54, 15, 's10', '0'),
(55, 15, 's11', '0'),
(56, 15, 's14', '0'),
(57, 16, 's1', '0'),
(58, 16, 's2', '0'),
(59, 16, 's3', '0'),
(60, 16, 's4', '0'),
(61, 16, 's5', '0'),
(62, 16, 's6', '0'),
(63, 16, 's12', '0'),
(64, 16, 's13', '0'),
(65, 17, 's1', '12'),
(66, 17, 's2', '10'),
(67, 17, 's3', '12'),
(68, 17, 's4', '10'),
(69, 17, 's5', '10'),
(70, 17, 's6', '10'),
(71, 17, 's7', '12'),
(72, 17, 's8', '12'),
(73, 18, 's1', '12'),
(74, 18, 's2', '11'),
(75, 18, 's3', '11'),
(76, 18, 's4', '111'),
(77, 18, 's5', '11'),
(78, 18, 's6', '11'),
(79, 18, 's8', '11'),
(80, 19, 's1', '11'),
(81, 19, 's2', '1'),
(82, 19, 's5', '1'),
(83, 19, 's9', '1'),
(84, 19, 's14', '1'),
(85, 19, 's10', '1'),
(86, 19, 's11', '1'),
(87, 20, 's1', '11'),
(88, 20, 's3', '1'),
(89, 20, 's4', '1'),
(90, 20, 's5', '1'),
(91, 20, 's6', '1'),
(92, 20, 's12', '1'),
(93, 20, 's13', '1'),
(94, 23, 's1', '0'),
(95, 23, 's2', '0'),
(96, 23, 's3', '0'),
(97, 23, 's4', '0'),
(98, 23, 's5', '0'),
(99, 23, 's6', '0'),
(100, 23, 's7', '0'),
(101, 23, 's8', '0'),
(102, 24, 's1', '0'),
(103, 24, 's2', '0'),
(104, 24, 's5', '0'),
(105, 24, 's9', '0'),
(106, 24, 's14', '0'),
(107, 24, 's10', '0'),
(108, 24, 's11', '0'),
(109, 25, 's1', '0'),
(110, 25, 's2', '0'),
(111, 25, 's3', '0'),
(112, 25, 's4', '0'),
(113, 25, 's5', '0'),
(114, 25, 's6', '0'),
(115, 25, 's12', '0'),
(116, 25, 's13', '0'),
(117, 26, 's1', '12'),
(118, 26, 's2', '14'),
(119, 26, 's3', '16'),
(120, 28, 's1', '15'),
(121, 28, 's2', '20'),
(122, 28, 's5', '35'),
(123, 29, 's1', '0'),
(124, 29, 's2', '0'),
(125, 29, 's3', '0'),
(126, 29, 's4', '0'),
(127, 29, 's5', '0'),
(128, 29, 's6', '0'),
(129, 29, 's7', '0'),
(130, 29, 's8', '0'),
(131, 30, 's1', '0'),
(132, 30, 's2', '0'),
(133, 30, 's5', '0'),
(134, 30, 's9', '0'),
(135, 30, 's14', '0'),
(136, 30, 's10', '0'),
(137, 30, 's11', '0'),
(138, 31, 's1', '0'),
(139, 31, 's2', '0'),
(140, 31, 's3', '0'),
(141, 31, 's4', '0'),
(142, 31, 's5', '0'),
(143, 31, 's6', '0'),
(144, 31, 's7', '0'),
(145, 31, 's8', '0'),
(146, 32, 's1', '0'),
(147, 32, 's2', '0'),
(148, 32, 's5', '0'),
(149, 32, 's9', '0'),
(150, 32, 's14', '0'),
(151, 32, 's10', '0'),
(152, 32, 's11', '0'),
(153, 33, 's1', '0'),
(154, 33, 's3', '0'),
(155, 33, 's4', '0'),
(156, 33, 's5', '0'),
(157, 33, 's6', '0'),
(158, 33, 's12', '0'),
(159, 33, 's13', '0'),
(160, 34, 's1', '0'),
(161, 34, 's2', '0'),
(162, 34, 's3', '0'),
(163, 34, 's4', '0'),
(164, 34, 's5', '0'),
(165, 34, 's6', '0'),
(166, 34, 's7', '0'),
(167, 34, 's8', '0'),
(168, 35, 's1', '0'),
(169, 35, 's2', '0'),
(170, 35, 's5', '0'),
(171, 35, 's9', '0'),
(172, 35, 's14', '0'),
(173, 35, 's10', '0'),
(174, 35, 's11', '0'),
(175, 36, 's1', '0'),
(176, 36, 's3', '0'),
(177, 36, 's4', '0'),
(178, 36, 's5', '0'),
(179, 36, 's6', '0'),
(180, 36, 's12', '0'),
(181, 36, 's13', '0'),
(182, 37, 's1', '0'),
(183, 37, 's2', '0'),
(184, 37, 's3', '0'),
(185, 37, 's4', '0'),
(186, 37, 's5', '0'),
(187, 37, 's6', '0'),
(188, 37, 's7', '0'),
(189, 37, 's8', '0'),
(190, 38, 's1', '0'),
(191, 38, 's2', '0'),
(192, 38, 's5', '0'),
(193, 38, 's9', '0'),
(194, 38, 's14', '0'),
(195, 38, 's10', '0'),
(196, 38, 's11', '0'),
(197, 39, 's1', '0'),
(198, 39, 's3', '0'),
(199, 39, 's4', '0'),
(200, 39, 's5', '0'),
(201, 39, 's6', '0'),
(202, 39, 's12', '0'),
(203, 39, 's13', '0'),
(204, 40, 's1', '1'),
(205, 40, 's2', '2'),
(206, 40, 's3', '0'),
(207, 40, 's4', '0'),
(208, 40, 's5', '0'),
(209, 40, 's6', '0'),
(210, 40, 's7', '0'),
(211, 40, 's8', '0'),
(212, 41, 's1', '0'),
(213, 41, 's2', '0'),
(214, 41, 's5', '0'),
(215, 41, 's9', '0'),
(216, 41, 's14', '0'),
(217, 41, 's10', '0'),
(218, 41, 's11', '0'),
(219, 42, 's1', '1'),
(220, 42, 's2', '2'),
(221, 42, 's3', '0'),
(222, 42, 's4', '0'),
(223, 42, 's5', '0'),
(224, 42, 's6', '0'),
(225, 42, 's7', '0'),
(226, 42, 's8', '0'),
(227, 43, 's1', '0'),
(228, 43, 's2', '0'),
(229, 43, 's5', '0'),
(230, 43, 's9', '0'),
(231, 43, 's14', '0'),
(232, 43, 's10', '0'),
(233, 43, 's11', '0'),
(234, 44, 's1', '0'),
(235, 44, 's3', '0'),
(236, 44, 's4', '0'),
(237, 44, 's5', '0'),
(238, 44, 's6', '0'),
(239, 44, 's12', '0'),
(240, 44, 's13', '0'),
(241, 45, 's1', '24.5'),
(242, 45, 's2', '16.5'),
(243, 45, 's3', '10.5'),
(244, 45, 's4', '10'),
(245, 45, 's5', '10.5'),
(246, 45, 's6', '23'),
(247, 45, 's7', '14.5'),
(248, 45, 's8', '0'),
(249, 46, 's1', '36'),
(250, 46, 's2', '34.5'),
(251, 46, 's5', '41'),
(252, 46, 's9', '25'),
(253, 46, 's14', '27.5'),
(254, 46, 's10', '17'),
(255, 46, 's11', '12.5'),
(256, 47, 's1', '24'),
(257, 47, 's3', '37/38.5'),
(258, 47, 's4', '33'),
(259, 47, 's5', '41'),
(260, 47, 's6', '22.5'),
(261, 47, 's12', '0'),
(262, 47, 's13', '0'),
(263, 47, 's2', '16'),
(264, 48, 's1', '12'),
(265, 48, 's2', '12'),
(266, 48, 's3', '12'),
(267, 48, 's4', '0'),
(268, 48, 's5', '0'),
(269, 48, 's6', '0'),
(270, 48, 's7', '0'),
(271, 48, 's8', '0'),
(272, 49, 's1', '0'),
(273, 49, 's2', '0'),
(274, 49, 's5', '0'),
(275, 49, 's9', '0'),
(276, 49, 's14', '0'),
(277, 49, 's10', '0'),
(278, 49, 's11', '0'),
(279, 50, 's1', '0'),
(280, 50, 's3', '0'),
(281, 50, 's4', '0'),
(282, 50, 's5', '0'),
(283, 50, 's6', '0'),
(284, 50, 's12', '0'),
(285, 50, 's13', '0'),
(286, 50, 's2', '0'),
(287, 51, 's1', '0'),
(288, 51, 's2', '0'),
(289, 51, 's3', '0'),
(290, 51, 's4', '0'),
(291, 51, 's5', '0'),
(292, 51, 's6', '0'),
(293, 51, 's7', '0'),
(294, 51, 's8', '0'),
(295, 52, 's1', '0'),
(296, 52, 's2', '0'),
(297, 52, 's5', '0'),
(298, 52, 's9', '0'),
(299, 52, 's14', '0'),
(300, 52, 's10', '0'),
(301, 52, 's11', '0'),
(302, 53, 's1', '0'),
(303, 53, 's3', '0'),
(304, 53, 's4', '0'),
(305, 53, 's5', '0'),
(306, 53, 's6', '0'),
(307, 53, 's12', '0'),
(308, 53, 's13', '0'),
(309, 54, 's1', '23'),
(310, 54, 's2', '16.5'),
(311, 54, 's3', ''),
(312, 54, 's4', '10'),
(313, 54, 's5', '10.5'),
(314, 54, 's6', ''),
(315, 54, 's7', '14.5'),
(316, 54, 's8', '0'),
(317, 55, 's1', '0'),
(318, 55, 's2', '12.5'),
(319, 55, 's5', ''),
(320, 55, 's9', '12.5'),
(321, 55, 's14', '12.5'),
(322, 55, 's10', ''),
(323, 55, 's11', '12.5'),
(324, 56, 's1', '29'),
(325, 56, 's3', ''),
(326, 56, 's4', '0'),
(327, 56, 's5', '12.5'),
(328, 56, 's6', ''),
(329, 56, 's12', '0'),
(330, 56, 's13', '12.5'),
(331, 56, 's2', '16'),
(332, 57, 's1', '23'),
(333, 57, 's2', '22'),
(334, 57, 's3', '22'),
(335, 57, 's4', '222'),
(336, 57, 's5', '22'),
(337, 57, 's6', '22'),
(338, 57, 's7', '0'),
(339, 57, 's8', '22'),
(340, 58, 's1', '22'),
(341, 58, 's2', '22'),
(342, 58, 's5', '22'),
(343, 58, 's9', '22'),
(344, 58, 's14', '22'),
(345, 58, 's10', '22'),
(346, 58, 's11', '22'),
(347, 59, 's1', '33'),
(348, 59, 's3', '33'),
(349, 59, 's4', '33'),
(350, 59, 's5', '33'),
(351, 59, 's6', '33'),
(352, 59, 's12', '33'),
(353, 59, 's13', '33'),
(354, 59, 's2', '33'),
(355, 60, 's1', '38'),
(356, 60, 's2', '18.5'),
(357, 60, 's3', '41.5'),
(358, 60, 's4', '37.5'),
(359, 60, 's5', '0'),
(360, 60, 's6', '24.5'),
(361, 60, 's7', '0'),
(362, 60, 's8', '0'),
(363, 61, 's1', '0'),
(364, 61, 's2', '0'),
(365, 61, 's5', '0'),
(366, 61, 's9', '0'),
(367, 61, 's14', '0'),
(368, 61, 's10', '0'),
(369, 61, 's11', '0'),
(370, 62, 's1', '0'),
(371, 62, 's3', '0'),
(372, 62, 's4', '0'),
(373, 62, 's5', '0'),
(374, 62, 's6', '0'),
(375, 62, 's12', '0'),
(376, 62, 's13', '0'),
(377, 63, 's1', '37.5'),
(378, 63, 's2', '18.5'),
(379, 63, 's3', '11.5'),
(380, 63, 's4', '12.5'),
(381, 63, 's5', '12.5'),
(382, 63, 's6', '23'),
(383, 63, 's7', ''),
(384, 63, 's8', ''),
(385, 64, 's1', '28'),
(386, 64, 's2', '20'),
(387, 64, 's3', '41'),
(388, 64, 's4', '40'),
(389, 64, 's5', '41.5'),
(390, 64, 's6', '9-15'),
(391, 64, 's7', '16'),
(392, 64, 's8', ''),
(393, 65, 's1', '39.5'),
(394, 65, 's2', '36'),
(395, 65, 's5', '41'),
(396, 65, 's9', '26'),
(397, 65, 's14', ''),
(398, 65, 's10', '20'),
(399, 65, 's11', '16'),
(400, 66, 's1', '38'),
(401, 66, 's3', '38'),
(402, 66, 's4', '35.5'),
(403, 66, 's5', ''),
(404, 66, 's6', '22'),
(405, 66, 's12', ''),
(406, 66, 's13', ''),
(407, 66, 's2', '19'),
(408, 67, 's1', '29'),
(409, 67, 's2', '18'),
(410, 67, 's3', '38'),
(411, 67, 's4', '35.5'),
(412, 67, 's5', ''),
(413, 67, 's6', '9.5-14'),
(414, 67, 's7', '16'),
(415, 67, 's8', ''),
(416, 68, 's1', '39.5'),
(417, 68, 's2', '36'),
(418, 68, 's5', '41'),
(419, 68, 's9', '26'),
(420, 68, 's14', ''),
(421, 68, 's10', '20'),
(422, 68, 's11', '16'),
(423, 69, 's1', '38'),
(424, 69, 's3', '38'),
(425, 69, 's4', '35.5'),
(426, 69, 's5', ''),
(427, 69, 's6', '22'),
(428, 69, 's12', ''),
(429, 69, 's13', ''),
(430, 69, 's2', '19'),
(431, 70, 's1', '22809562'),
(432, 70, 's2', '19'),
(433, 70, 's3', '38'),
(434, 70, 's4', '35.5'),
(435, 70, 's5', ''),
(436, 70, 's6', '9.5-14'),
(437, 70, 's7', '16'),
(438, 70, 's8', ''),
(439, 71, 's1', '39.5'),
(440, 71, 's2', '36'),
(441, 72, 's1', '22809562'),
(442, 71, 's5', '41'),
(443, 72, 's2', '19'),
(444, 71, 's9', '26'),
(445, 72, 's3', '38'),
(446, 71, 's14', ''),
(447, 72, 's4', '35.5'),
(448, 71, 's10', '20'),
(449, 72, 's5', ''),
(450, 71, 's11', '16'),
(451, 72, 's6', '9.5-14'),
(452, 72, 's7', '16'),
(453, 73, 's1', ''),
(454, 72, 's8', ''),
(455, 73, 's3', ''),
(456, 73, 's4', ''),
(457, 74, 's1', '39.5'),
(458, 73, 's5', ''),
(459, 74, 's2', '36'),
(460, 73, 's6', ''),
(461, 74, 's5', '41'),
(462, 73, 's12', ''),
(463, 74, 's9', '26'),
(464, 73, 's13', ''),
(465, 74, 's14', ''),
(466, 74, 's10', '20'),
(467, 74, 's11', '16'),
(468, 75, 's1', ''),
(469, 75, 's3', ''),
(470, 75, 's4', ''),
(471, 75, 's5', ''),
(472, 75, 's6', ''),
(473, 75, 's12', ''),
(474, 75, 's13', ''),
(475, 76, 's1', ''),
(476, 76, 's3', ''),
(477, 76, 's4', ''),
(478, 76, 's5', ''),
(479, 76, 's6', ''),
(480, 76, 's12', ''),
(481, 76, 's13', ''),
(482, 77, 's1', ''),
(483, 77, 's2', ''),
(484, 77, 's3', ''),
(485, 77, 's4', ''),
(486, 77, 's5', ''),
(487, 77, 's6', ''),
(488, 77, 's7', ''),
(489, 77, 's8', ''),
(490, 78, 's1', ''),
(491, 78, 's2', ''),
(492, 78, 's5', ''),
(493, 78, 's9', ''),
(494, 78, 's14', ''),
(495, 78, 's10', ''),
(496, 78, 's11', ''),
(497, 79, 's1', ''),
(498, 79, 's3', ''),
(499, 79, 's4', ''),
(500, 79, 's5', ''),
(501, 79, 's6', ''),
(502, 79, 's12', ''),
(503, 79, 's13', ''),
(504, 80, 's1', '10'),
(505, 80, 's2', '10'),
(506, 80, 's3', '10'),
(507, 80, 's4', '10'),
(508, 80, 's5', '10'),
(509, 80, 's6', '10'),
(510, 80, 's7', '10'),
(511, 80, 's8', '10'),
(512, 81, 's1', '0'),
(513, 81, 's2', '0'),
(514, 81, 's3', '0'),
(515, 81, 's4', '0'),
(516, 81, 's5', '0'),
(517, 81, 's6', '0'),
(518, 81, 's7', '0'),
(519, 81, 's8', '0'),
(520, 82, 's1', '0'),
(521, 82, 's2', '0'),
(522, 82, 's5', '0'),
(523, 82, 's9', '0'),
(524, 82, 's14', '0'),
(525, 82, 's10', '0'),
(526, 82, 's11', '0'),
(527, 83, 's1', '0'),
(528, 83, 's3', '0'),
(529, 83, 's4', '0'),
(530, 83, 's5', '0'),
(531, 83, 's6', '0'),
(532, 83, 's12', '0'),
(533, 83, 's13', '0'),
(534, 84, 's1', ''),
(535, 84, 's2', ''),
(536, 84, 's3', ''),
(537, 84, 's4', ''),
(538, 84, 's5', ''),
(539, 84, 's6', ''),
(540, 84, 's7', ''),
(541, 84, 's8', ''),
(542, 85, 's1', ''),
(543, 85, 's2', ''),
(544, 85, 's5', ''),
(545, 85, 's9', ''),
(546, 85, 's14', ''),
(547, 85, 's10', ''),
(548, 85, 's11', ''),
(549, 86, 's1', ''),
(550, 86, 's3', ''),
(551, 86, 's4', ''),
(552, 86, 's5', ''),
(553, 86, 's6', ''),
(554, 86, 's12', ''),
(555, 86, 's13', ''),
(556, 87, 's1', ''),
(557, 87, 's2', ''),
(558, 87, 's3', ''),
(559, 87, 's4', ''),
(560, 87, 's5', ''),
(561, 87, 's6', ''),
(562, 87, 's7', ''),
(563, 87, 's8', ''),
(564, 88, 's1', ''),
(565, 88, 's2', ''),
(566, 88, 's5', ''),
(567, 88, 's9', ''),
(568, 88, 's14', ''),
(569, 88, 's10', ''),
(570, 88, 's11', ''),
(571, 89, 's1', ''),
(572, 89, 's3', ''),
(573, 89, 's4', ''),
(574, 89, 's5', ''),
(575, 89, 's6', ''),
(576, 89, 's12', ''),
(577, 89, 's13', ''),
(578, 90, 's1', ''),
(579, 90, 's2', ''),
(580, 90, 's3', ''),
(581, 90, 's4', ''),
(582, 90, 's5', ''),
(583, 90, 's6', ''),
(584, 90, 's7', ''),
(585, 90, 's8', ''),
(586, 91, 's1', ''),
(587, 91, 's2', ''),
(588, 91, 's5', ''),
(589, 91, 's9', ''),
(590, 91, 's14', ''),
(591, 91, 's10', ''),
(592, 91, 's11', ''),
(593, 92, 's1', ''),
(594, 92, 's3', ''),
(595, 92, 's4', ''),
(596, 92, 's5', ''),
(597, 92, 's6', ''),
(598, 92, 's12', ''),
(599, 92, 's13', ''),
(600, 93, 's1', ''),
(601, 93, 's2', ''),
(602, 93, 's3', ''),
(603, 93, 's4', ''),
(604, 93, 's5', ''),
(605, 93, 's6', ''),
(606, 93, 's7', ''),
(607, 93, 's8', ''),
(608, 94, 's1', ''),
(609, 94, 's2', ''),
(610, 94, 's5', ''),
(611, 94, 's9', ''),
(612, 94, 's14', ''),
(613, 94, 's10', ''),
(614, 94, 's11', ''),
(615, 95, 's1', ''),
(616, 95, 's2', ''),
(617, 95, 's3', ''),
(618, 95, 's4', ''),
(619, 95, 's5', ''),
(620, 95, 's6', ''),
(621, 95, 's7', ''),
(622, 95, 's8', ''),
(623, 96, 's1', ''),
(624, 96, 's2', ''),
(625, 96, 's5', ''),
(626, 96, 's9', ''),
(627, 96, 's14', ''),
(628, 96, 's10', ''),
(629, 96, 's11', ''),
(630, 97, 's1', ''),
(631, 97, 's3', ''),
(632, 97, 's4', ''),
(633, 97, 's5', ''),
(634, 97, 's6', ''),
(635, 97, 's12', ''),
(636, 97, 's13', ''),
(637, 98, 's1', ''),
(638, 98, 's2', ''),
(639, 98, 's3', ''),
(640, 98, 's4', ''),
(641, 98, 's5', ''),
(642, 98, 's6', ''),
(643, 98, 's7', ''),
(644, 98, 's8', ''),
(645, 99, 's1', ''),
(646, 99, 's2', ''),
(647, 99, 's5', ''),
(648, 99, 's9', ''),
(649, 99, 's14', ''),
(650, 99, 's10', ''),
(651, 99, 's11', ''),
(652, 100, 's1', ''),
(653, 100, 's2', ''),
(654, 100, 's3', ''),
(655, 100, 's4', ''),
(656, 100, 's5', ''),
(657, 100, 's6', ''),
(658, 100, 's7', ''),
(659, 100, 's8', ''),
(660, 101, 's1', ''),
(661, 101, 's2', ''),
(662, 101, 's5', ''),
(663, 101, 's9', ''),
(664, 101, 's14', ''),
(665, 101, 's10', ''),
(666, 101, 's11', ''),
(667, 102, 's1', ''),
(668, 102, 's2', ''),
(669, 102, 's3', ''),
(670, 102, 's4', ''),
(671, 102, 's5', ''),
(672, 102, 's6', ''),
(673, 102, 's7', ''),
(674, 102, 's8', ''),
(675, 103, 's1', ''),
(676, 103, 's2', ''),
(677, 103, 's5', ''),
(678, 103, 's9', ''),
(679, 103, 's14', ''),
(680, 103, 's10', ''),
(681, 103, 's11', ''),
(682, 104, 's1', ''),
(683, 104, 's2', ''),
(684, 104, 's3', ''),
(685, 104, 's4', ''),
(686, 104, 's5', ''),
(687, 104, 's6', ''),
(688, 104, 's7', ''),
(689, 104, 's8', ''),
(690, 105, 's1', ''),
(691, 105, 's2', ''),
(692, 105, 's5', ''),
(693, 105, 's9', ''),
(694, 105, 's14', ''),
(695, 105, 's10', ''),
(696, 105, 's11', ''),
(697, 106, 's1', ''),
(698, 106, 's2', ''),
(699, 106, 's3', ''),
(700, 106, 's4', ''),
(701, 106, 's5', ''),
(702, 106, 's6', ''),
(703, 106, 's7', ''),
(704, 106, 's8', ''),
(705, 107, 's1', ''),
(706, 107, 's2', ''),
(707, 107, 's5', ''),
(708, 107, 's9', ''),
(709, 107, 's14', ''),
(710, 107, 's10', ''),
(711, 107, 's11', ''),
(712, 108, 's1', ''),
(713, 108, 's2', ''),
(714, 108, 's3', ''),
(715, 108, 's4', ''),
(716, 108, 's5', ''),
(717, 108, 's6', ''),
(718, 108, 's7', ''),
(719, 108, 's8', ''),
(720, 109, 's1', ''),
(721, 109, 's2', ''),
(722, 109, 's5', ''),
(723, 109, 's9', ''),
(724, 109, 's14', ''),
(725, 109, 's10', ''),
(726, 109, 's11', ''),
(727, 110, 's1', ''),
(728, 110, 's2', ''),
(729, 110, 's3', ''),
(730, 110, 's4', ''),
(731, 110, 's5', ''),
(732, 110, 's6', ''),
(733, 110, 's7', ''),
(734, 110, 's8', ''),
(735, 111, 's1', ''),
(736, 111, 's2', ''),
(737, 111, 's5', ''),
(738, 111, 's9', ''),
(739, 111, 's14', ''),
(740, 111, 's10', ''),
(741, 111, 's11', '');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `jobid` int(11) NOT NULL,
  `company` int(5) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `eid` varchar(100) DEFAULT NULL,
  `po` varchar(100) DEFAULT NULL,
  `jobtype` varchar(100) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isdelete` char(1) DEFAULT 'N',
  `datecompleted` date DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`jobid`, `company`, `name`, `location`, `eid`, `po`, `jobtype`, `gender`, `datecreated`, `isdelete`, `datecompleted`, `status`) VALUES
(25, 2, 'Saleh', 'Al Quoz', '11', '11', NULL, 'M', '2017-05-30 08:36:00', 'Y', NULL, 'Delivered'),
(26, 101, 'Sakina', NULL, 'A131', '1211', NULL, 'F', '2017-04-08 07:25:37', 'N', NULL, 'Pending'),
(27, 0, 'Saleh', NULL, '10', '10', NULL, 'M', '2017-04-08 07:25:39', 'N', NULL, 'Pending'),
(28, 0, 'Saleh', NULL, '12', '100', NULL, 'M', '2017-04-08 07:25:41', 'N', NULL, 'Pending'),
(29, 2, 'Saleh', NULL, '12', '15', '', 'M', '2017-05-30 08:36:15', 'Y', NULL, 'Complete'),
(30, 2, 'Saleh', NULL, '12', '15', '', 'M', '2017-05-30 08:37:49', 'Y', NULL, 'Complete'),
(31, 2, 'Saleh', NULL, '12', '15', '', 'M', '2017-05-30 08:40:37', 'Y', NULL, 'Complete'),
(32, 2, 'Saleh', NULL, '12', '15', '', 'M', '2017-05-30 09:21:37', 'Y', NULL, 'Complete'),
(33, 2, 'Saleh', NULL, '12', '15', '', 'M', '2017-04-11 07:17:44', 'Y', NULL, 'Pending'),
(34, 3, 'Sakina', NULL, '52', '114', '', 'F', '2017-06-25 21:12:51', 'Y', NULL, 'Complete'),
(35, 3, 'Aoife', NULL, '145', '185', '', 'M', '2017-06-25 21:12:53', 'Y', NULL, 'Complete'),
(36, 0, 'Aoife', NULL, '145', '11', 'Lab Coat', 'M', '2017-04-15 16:54:06', 'N', NULL, 'Pending'),
(37, 0, 'Aoife', NULL, '145', '11', 'Lab Coat', 'M', '2017-04-15 16:54:27', 'N', NULL, 'Pending'),
(38, 2, 'Saleh', NULL, '0', '11', 'hh', 'M', '2017-05-30 09:22:10', 'Y', NULL, 'Complete'),
(39, 3, 'Saleh Galiwala', NULL, '15', '11', 'Test', 'M', '2017-06-25 21:12:56', 'Y', NULL, 'Complete'),
(40, 3, 'Saleh Galiwala', NULL, '15', '11', 'Test', 'M', '2017-06-25 21:12:59', 'Y', NULL, 'Complete'),
(41, 3, 'Saleh Galiwala', NULL, '15', '11', 'Test', 'M', '2017-06-25 21:13:02', 'Y', NULL, 'Complete'),
(42, 0, 'Saleh', NULL, '120', '120', 'TTT', 'M', '2017-04-15 18:11:50', 'N', NULL, 'Pending'),
(43, 5, 'valuegate', NULL, '45', '15000', 'Coat', 'M', '2017-06-25 21:13:05', 'Y', NULL, 'Complete'),
(44, 5, 'valuegate', NULL, '45', '15000', 'Coat', 'M', '2017-06-25 21:13:08', 'Y', NULL, 'Complete'),
(45, 2, 'LOU', '', '120', 'EMAIL', 'STAFF', 'M', '2017-06-25 21:12:47', 'Y', NULL, 'Pending'),
(46, 1, 'Saleh', '', '1234', 'test', 'Coat', 'M', '2017-05-31 06:59:43', 'Y', NULL, 'Pending'),
(47, 1, 'test', '', '1112', '122', 'Coat', 'M', '2017-06-25 21:12:43', 'Y', NULL, 'Complete'),
(48, 4, 'Husain Abid', NULL, '0', '23356', '', 'M', '2017-06-25 21:14:19', 'Y', NULL, 'Pending'),
(49, 1, 'Husain Abid', NULL, 'E 2365', '78621', 'cse', 'M', '2017-06-27 12:13:39', 'N', NULL, 'Delivered'),
(50, 6, 'DR HESHAM', '', '50231', '836', 'DR COAT', 'M', '2017-07-22 14:21:38', 'N', NULL, 'Complete'),
(51, 6, 'DR SHOAIB', NULL, '50215', '836', '', 'M', '2017-07-22 14:21:44', 'N', NULL, 'Complete'),
(52, 6, 'MOHD HADYFA', NULL, '20463', '836', '', 'M', '2017-07-22 14:21:48', 'N', NULL, 'Complete'),
(53, 6, 'MR VIRGILIO', NULL, '50233', '836', '', 'M', '2017-07-03 09:47:33', 'N', NULL, 'Pending'),
(54, 6, 'DR AMER', NULL, '896-20723', '836', '', 'M', '2017-07-03 10:00:09', 'N', NULL, 'Pending'),
(55, 6, 'DR AMER', NULL, '896-20723', '836', '', 'M', '2017-07-03 10:00:56', 'Y', NULL, 'Pending'),
(56, 6, 'JONCEY', NULL, '17041-20462', '836', '', 'M', '2017-07-03 10:02:17', 'N', NULL, 'Pending'),
(57, 6, 'MARIA JOSELY', NULL, '000-20461', '836', '', 'M', '2017-07-03 10:04:14', 'N', NULL, 'Pending'),
(58, 1, 'Saleh Galiwala', '', '12345', '123', '5', 'M', '2017-07-06 06:43:29', 'N', NULL, 'Pending'),
(59, 8, 'RAHMATULLAH', NULL, '50086', '76434-073-1', '', 'M', '2017-07-12 07:33:07', 'N', NULL, 'Pending'),
(60, 8, 'RIZA', NULL, '30056', '76435-073-1', '', 'M', '2017-07-12 07:35:19', 'N', NULL, 'Pending'),
(61, 8, 'MAHROUS', NULL, '30557', '76435-073-1', '', 'M', '2017-07-12 07:36:36', 'N', NULL, 'Pending'),
(62, 8, 'RACQUEL', NULL, '30058', '76435-073-1', '', 'F', '2017-07-12 07:38:05', 'N', NULL, 'Pending'),
(63, 8, 'SUFYAN', NULL, '50090', '76435-073-1', '', 'M', '2017-07-12 07:40:05', 'N', NULL, 'Pending'),
(64, 8, 'SHWETA', '', '50091', '76434-073-1', '', 'F', '2017-07-12 07:41:44', 'N', NULL, 'Pending'),
(65, 9, 'ANU AGUSTINE', NULL, '50205', '889', '', 'F', '2017-07-12 07:45:17', 'N', NULL, 'Pending'),
(66, 9, 'LITHA PAUL', NULL, '7136', '889', '', 'F', '2017-07-12 10:57:51', 'N', NULL, 'Pending'),
(67, 9, 'MS JOMY', NULL, '5202', '886', '', 'F', '2017-07-12 10:59:06', 'N', NULL, 'Pending'),
(68, 9, 'MS KAVYA', NULL, '50228', '889', '', 'F', '2017-07-12 11:00:09', 'N', NULL, 'Pending'),
(69, 9, 'MOHD ALYAFI', NULL, '50220', '889', '', 'M', '2017-07-12 11:02:02', 'N', NULL, 'Pending'),
(70, 9, 'GERALD', NULL, '50225', '889', '', 'F', '2017-07-12 11:03:01', 'N', NULL, 'Pending'),
(71, 9, 'ANU VENGOPAL', NULL, '50226', '889', '', 'F', '2017-07-12 11:04:15', 'N', NULL, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `jobtype`
--

CREATE TABLE `jobtype` (
  `jobtypeid` int(12) NOT NULL,
  `jobtypename` varchar(100) DEFAULT NULL,
  `companyid` int(12) DEFAULT NULL,
  `isdelete` char(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jobtype`
--

INSERT INTO `jobtype` (`jobtypeid`, `jobtypename`, `companyid`, `isdelete`) VALUES
(5, 'Waist Coat', 1, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `measurements`
--

CREATE TABLE `measurements` (
  `measurementid` varchar(11) NOT NULL,
  `measurementname` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `measurements`
--

INSERT INTO `measurements` (`measurementid`, `measurementname`) VALUES
('1', 'L'),
('10', 'K'),
('11', 'B'),
('12', 'B/L/OP'),
('13', 'Arm'),
('14', 'U'),
('2', 'SH'),
('3', 'C'),
('4', 'W'),
('5', 'H'),
('6', 'S/L'),
('7', 'N'),
('8', 'CF'),
('9', 'T');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`companyid`);

--
-- Indexes for table `customers_auth`
--
ALTER TABLE `customers_auth`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `dresses`
--
ALTER TABLE `dresses`
  ADD PRIMARY KEY (`dressid`);

--
-- Indexes for table `jobitems`
--
ALTER TABLE `jobitems`
  ADD PRIMARY KEY (`jobitemid`);

--
-- Indexes for table `jobitemsmeasurements`
--
ALTER TABLE `jobitemsmeasurements`
  ADD PRIMARY KEY (`measurementitemsid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`jobid`);

--
-- Indexes for table `jobtype`
--
ALTER TABLE `jobtype`
  ADD PRIMARY KEY (`jobtypeid`);

--
-- Indexes for table `measurements`
--
ALTER TABLE `measurements`
  ADD PRIMARY KEY (`measurementid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `companyid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `customers_auth`
--
ALTER TABLE `customers_auth`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;
--
-- AUTO_INCREMENT for table `dresses`
--
ALTER TABLE `dresses`
  MODIFY `dressid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `jobitems`
--
ALTER TABLE `jobitems`
  MODIFY `jobitemid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
--
-- AUTO_INCREMENT for table `jobitemsmeasurements`
--
ALTER TABLE `jobitemsmeasurements`
  MODIFY `measurementitemsid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=742;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `jobid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `jobtype`
--
ALTER TABLE `jobtype`
  MODIFY `jobtypeid` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
