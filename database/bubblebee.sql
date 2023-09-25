-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2023 at 09:10 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bubblebee`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE `audit` (
  `id` int(11) NOT NULL,
  `date_time` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action_made` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audit`
--

INSERT INTO `audit` (`id`, `date_time`, `user_id`, `action_made`) VALUES
(1, '1673619534', 1, 'Created [asdasd] in the Main Category list'),
(2, '1673620648', 1, 'Updated [asdasd] in the Main Category list'),
(3, '1673620655', 1, 'Updated [asdasd] in the Main Category list'),
(4, '1673620742', 1, 'Updated [Test] in the Main Category list'),
(5, '1673620863', 1, 'Updated [TestingTesting] in the Main Category list'),
(6, '1673620970', 1, 'Updated [Test] in the Main Category list'),
(7, '1673621110', 1, 'Deleted [] in the Main Category list'),
(8, '1673621188', 1, 'Created [asdasdas] in the Main Category list'),
(9, '1673621194', 1, 'Deleted [id = 10] in the Main Category list'),
(10, '1673621229', 1, 'Deleted [id = ] in the Main Category list'),
(11, '1673621428', 1, 'Created [asdasdasd] in the Sub Category list'),
(12, '1673621438', 1, 'Updated [asdasdasd] in the Sub Category list'),
(13, '1673621468', 1, 'Created [id = 10] in the Main Category list'),
(14, '1673621610', 1, 'Created [asdasdsad] in the Product list'),
(15, '1673621662', 1, 'Updated [Mema] in the Product list'),
(16, '1673621673', 1, 'Deleted [13] in the Product list'),
(17, '1673621724', 1, 'Deleted [id = 11] in the Product list'),
(18, '1673621742', 1, 'Created [Pasdasd] in the Product list'),
(19, '1673621764', 1, 'Updated [Pasdasd] in the Product list'),
(20, '1673621771', 1, 'Deleted [id = 11] in the Product list'),
(21, '1673621777', 1, 'Deleted [id = 14] in the Product list'),
(22, '1673621777', 1, 'Deleted [id = 11] in the Product list'),
(23, '1673621885', 1, 'Created [asdasd50] in the Product list'),
(24, '1673621894', 1, 'Updated [asdasd50] in the Product list'),
(25, '1673621900', 1, 'Deleted [id = 15] in the Product list'),
(26, '1673621959', 1, 'Created [asdasd] in the Main Category list'),
(27, '1673621969', 1, 'Updated [asdasd] in the Main Category list'),
(28, '1673621980', 1, 'Deleted [id = 11] in the Main Category list'),
(29, '1673621980', 1, 'Deleted [id = 11] in the Main Category list'),
(30, '1673622009', 1, 'Created [asdasd] in the Main Category list'),
(31, '1673622011', 1, 'Deleted [id = 12] in the Main Category list'),
(32, '1673624977', 1, 'Created [asdasd] in the Discount list'),
(33, '1673625016', 1, 'Created [asdasd] in the Discount list'),
(34, '1673625064', 1, 'Updated [asdasd] in the Discount list'),
(35, '1673625068', 1, 'Deleted [id = 47] in the Discount list'),
(36, '1673625159', 1, 'Created [asda] in the Discount list'),
(37, '1673625161', 1, 'Deleted [id = asda] in the Discount list'),
(38, '1673625238', 1, 'Created [asdad] in the Product list'),
(39, '1673625241', 1, 'Deleted [id = asdad] in the Product list'),
(40, '1673625319', 1, 'Created [asdasd] in the Main Category list'),
(41, '1673625321', 1, 'Deleted [name = asdasd] in the Main Category list'),
(42, '1673625387', 1, 'Created [asdasd] in the Sub Category list'),
(43, '1673625389', 1, 'Deleted [name = asdasd] in the Sub Category list'),
(44, '1673625542', 1, 'Created [asdas] in the Payment Method list'),
(45, '1673625548', 1, 'Updated [asdas] in the Payment Method list'),
(46, '1673625551', 1, 'Deleted [name = asdas] in the Discount list'),
(47, '1673625708', 1, 'Created [asdasd] in the Tables list'),
(48, '1673625714', 1, 'Updated [asdasd] in the Table list'),
(49, '1673625718', 1, 'Deleted [name = asdasd] in the Tables list'),
(50, '1673625852', 1, 'Viewed Inventory Valuation'),
(51, '1673625922', 1, 'Generate Report For Inventory Valuation'),
(52, '1673625979', 1, 'Viewed Product Master List'),
(61, '1673626110', 1, 'Generate Report For Product Master List'),
(62, '1673626145', 1, 'Generate Report For Stock Adjustment'),
(63, '1673626511', 1, 'Created [Bill No = BUBBLE-2319] in the Order list'),
(64, '1673626522', 1, 'Updated [Bill No = BUBBLE-2319] in the Order list'),
(65, '1673626612', 1, 'Updated [Bill No = 118] in the Order list'),
(66, '1673626682', 1, 'Updated [Bill No = BUBBLE-182B] in the Order list'),
(67, '1673626779', 1, 'Viewed Product Stock'),
(68, '1673626878', 1, 'Updated Company Information'),
(69, '1673626973', 1, 'Updated User Information'),
(70, '1673627368', 1, 'Created [asdsad] in the Group list'),
(71, '1673627374', 1, 'Updated [asdsad] in the Group list'),
(72, '1673627379', 1, 'Deleted [id = 12] in the Group list'),
(73, '1673627520', 1, 'Created [sadasd] in the User list'),
(74, '1673627525', 1, 'Updated [sadasd] in the User list'),
(75, '1673627529', 1, 'Deleted [id = 13] in the User list'),
(76, '1673628042', 1, 'Created [OL No = OLCODE-C20A] in the OrderList'),
(77, '1673628048', 1, 'Updated [OL No = ] in the Orderlist'),
(78, '1673628070', 1, 'Updated [OL No = ] in the Orderlist'),
(79, '1673628119', 1, 'Updated [OL No = OLCODE-C20A] in the Orderlist'),
(80, '1673628127', 1, 'Deleted [Bill No = ] in the Order list'),
(81, '1673628128', 1, 'Deleted [Bill No = ] in the Order list'),
(82, '1673628171', 1, 'Deleted [OL No = ] in the Orderlist'),
(83, '1673628172', 1, 'Deleted [OL No = ] in the Orderlist'),
(84, '1673628297', 1, 'Created [OL No = OLCODE-BCFE] in the OrderList'),
(85, '1673628352', 1, 'Created [OL No = OLCODE-11EE] in the OrderList'),
(86, '1673628358', 1, 'Deleted [OL No = OLCODE-11EE] in the Orderlist'),
(87, '1673628363', 1, 'Updated [OL No = OLCODE-46D7] in the Orderlist'),
(88, '1673628363', 1, 'Updated [OL No = OLCODE-46D7] in the Orderlist'),
(89, '1673628476', 1, 'Updated [RO No = OLCODE-AEB9] in the Request Order'),
(90, '1673628537', 1, 'Deleted [RO No = ROCODE-F4CD] in the Request Order List'),
(91, '1673628787', 1, 'Updated [ST No = ] in the Stock Transfer List'),
(92, '1673628796', 1, 'Updated [ST No = STCODE-BB7B] in the Stock Transfer List'),
(93, '1673628961', 1, 'Added Stocks of [ST No = STCODE-30CE] in the Stock Adjusment'),
(94, '1673628970', 1, 'Removed some stocks of [ST No = STCODE-30CE] in the Stock Adjusment'),
(95, '1673628970', 1, 'Removed some stocks of [ST No = STCODE-30CE] in the Stock Adjusment'),
(96, '1673629050', 1, 'Added Stocks of [ST No = STCODE-30CE] in the Stock Adjusment'),
(97, '1673629050', 1, 'Added Stocks of [ST No = STCODE-30CE] in the Stock Adjusment'),
(98, '1673629106', 1, 'Removed some stocks of [ST No = STCODE-30CE] in the Stock Adjusment'),
(99, '1673629106', 1, 'Removed some stocks of [ST No = STCODE-30CE] in the Stock Adjusment'),
(100, '1673631598', 1, 'Created [asda] in the Sub Category list'),
(101, '1673631605', 1, 'Deleted [id = asda] in the Sub Category list'),
(102, '1673631736', 1, 'Created [asd] in the Sub Category list'),
(103, '1673631738', 1, 'Deleted [id = asd] in the Sub Category list'),
(104, '1673632332', 1, 'Created [REG Okinawa] in the Product list'),
(105, '1673634869', 1, 'Generate Report For Audit Trail'),
(106, '1673656378', 1, 'Deleted [Bill No = BUBBLE-0F4F] in the Order list'),
(107, '1673656381', 1, 'Deleted [Bill No = ] in the Order list'),
(108, '1673656381', 1, 'Deleted [Bill No = BUBBLE-CD6C] in the Order list'),
(109, '1673656384', 1, 'Deleted [Bill No = ] in the Order list'),
(110, '1673656384', 1, 'Deleted [Bill No = BUBBLE-8D26] in the Order list'),
(111, '1673656384', 1, 'Deleted [Bill No = ] in the Order list'),
(112, '1673656387', 1, 'Deleted [Bill No = ] in the Order list'),
(113, '1673656387', 1, 'Deleted [Bill No = ] in the Order list'),
(114, '1673656387', 1, 'Deleted [Bill No = ] in the Order list'),
(115, '1673656387', 1, 'Deleted [Bill No = BUBBLE-0E5B] in the Order list'),
(116, '1673656391', 1, 'Deleted [Bill No = ] in the Order list'),
(117, '1673656391', 1, 'Deleted [Bill No = ] in the Order list'),
(118, '1673656391', 1, 'Deleted [Bill No = ] in the Order list'),
(119, '1673656391', 1, 'Deleted [Bill No = ] in the Order list'),
(120, '1673656391', 1, 'Deleted [Bill No = BUBBLE-257B] in the Order list'),
(121, '1673656406', 1, 'Created [Bill No = BUBBLE-6F5A] in the Order list'),
(122, '1673656587', 1, 'Updated [Bill No = BUBBLE-6F5A] in the Order list'),
(123, '1673656669', 1, 'Generate Report For Product Master List'),
(124, '1673656849', 1, 'Generate Report For Product Master List'),
(125, '1673657343', 1, 'Created [Ace] in the Main Category list'),
(126, '1673657358', 1, 'Updated [Ace] in the Main Category list'),
(127, '1673657369', 1, 'Deleted [name = Ace] in the Main Category list'),
(128, '1673657420', 1, 'Created [dasda] in the Discount list'),
(129, '1673657444', 1, 'Updated [dasda] in the Discount list'),
(130, '1673657448', 1, 'Deleted [name = dasda] in the Discount list'),
(131, '1673657595', 1, 'Created [Bill No = BUBBLE-6822] in the Order list'),
(132, '1673657681', 1, 'Updated [Bill No = BUBBLE-6822] in the Order list'),
(133, '1673657800', 1, 'Generate Report For Audit Trail'),
(134, '1673658194', 1, 'Created [Ace] in the Main Category list'),
(135, '1673658203', 1, 'Updated [Ace] in the Main Category list'),
(136, '1673658214', 1, 'Deleted [name = Ace] in the Main Category list'),
(137, '1673658243', 1, 'Created [Ace] in the Sub Category list'),
(138, '1673658253', 1, 'Updated [Ace] in the Sub Category list'),
(139, '1673658261', 1, 'Deleted [id = Ace] in the Sub Category list'),
(140, '1673658359', 1, 'Created [Sabaw] in the Product list'),
(141, '1673658385', 1, 'Updated [Sabaw] in the Product list'),
(142, '1673658391', 1, 'Deleted [name = Sabaw] in the Product list'),
(143, '1673658442', 1, 'Created [Bill No = BUBBLE-985D] in the Order list'),
(144, '1673658574', 1, 'Created [OL No = OLCODE-F385] in the OrderList'),
(145, '1673658588', 1, 'Updated [RO No = OLCODE-F385] in the Request Order'),
(146, '1673658636', 1, 'Updated [RO No = ROCODE-44CB] in the Stock Transfer List'),
(147, '1673658675', 1, 'Added Stocks of [ST No = STCODE-84F2] in the Stock Adjusment'),
(148, '1673658702', 1, 'Removed some stocks of [ST No = STCODE-84F2] in the Stock Adjusment'),
(149, '1673658743', 1, 'Added Stocks of [ST No = STCODE-84F2] in the Stock Adjusment'),
(150, '1673658940', 1, 'Added Stocks of [ST No = STCODE-84F2] in the Stock Adjusment'),
(151, '1673658999', 1, 'Added Stocks of [ST No = STCODE-84F2] in the Stock Adjusment'),
(152, '1673659132', 1, 'Created [Bill No = BUBBLE-1FE1] in the Order list'),
(153, '1673659142', 1, 'Updated [Bill No = BUBBLE-1FE1] in the Order list'),
(154, '1673659327', 1, 'Updated [Bill No = BUBBLE-985D] in the Order list'),
(155, '1673659739', 1, 'Generate Report For Inventory Valuation'),
(156, '1673659778', 1, 'Generate Report For Inventory Valuation'),
(157, '1673659790', 1, 'Generate Report For Inventory Valuation'),
(158, '1673659803', 1, 'Generate Report For Inventory Valuation'),
(159, '1673659810', 1, 'Generate Report For Inventory Valuation'),
(160, '1673659824', 1, 'Generate Report For Inventory Valuation'),
(161, '1673659828', 1, 'Generate Report For Inventory Valuation'),
(162, '1673659840', 1, 'Generate Report For Inventory Valuation'),
(163, '1673659857', 1, 'Generate Report For Inventory Valuation'),
(164, '1673659869', 1, 'Generate Report For Inventory Valuation'),
(165, '1673659909', 1, 'Generate Report For Product Master List'),
(166, '1673659938', 1, 'Generate Report For Product Master List'),
(167, '1673659966', 1, 'Generate Report For Stock Adjustment'),
(168, '1673660046', 1, 'Generate Report For Audit Trail'),
(169, '1673668458', 1, 'Created [Bill No = BUBBLE-7F94] in the Order list'),
(170, '1673668501', 1, 'Created [Bill No = BUBBLE-F95E] in the Order list'),
(171, '1673669046', 1, 'Created [Bill No = BUBBLE-1CF3] in the Order list'),
(172, '1673669053', 1, 'Deleted [Bill No = BUBBLE-1CF3] in the Order list'),
(173, '1673669900', 1, 'Created [Bill No = BUBBLE-8024] in the Order list'),
(174, '1673669931', 1, 'Deleted [Bill No = BUBBLE-8024] in the Order list'),
(175, '1673669934', 1, 'Deleted [Bill No = ] in the Order list'),
(176, '1673669934', 1, 'Deleted [Bill No = BUBBLE-F95E] in the Order list'),
(177, '1673669938', 1, 'Deleted [Bill No = ] in the Order list'),
(178, '1673669938', 1, 'Deleted [Bill No = ] in the Order list'),
(179, '1673669938', 1, 'Deleted [Bill No = BUBBLE-7F94] in the Order list'),
(180, '1673670871', 1, 'Created [Bill No = BUBBLE-223E] in the Order list'),
(181, '1673670976', 1, 'Updated [Bill No = BUBBLE-223E] in the Order list'),
(182, '1673670976', 1, 'Updated [Bill No = BUBBLE-223E] in the Order list'),
(183, '1673671107', 1, 'Updated [Bill No = BUBBLE-223E] in the Order list'),
(184, '1673671119', 1, 'Created [Bill No = BUBBLE-FB52] in the Order list'),
(185, '1673693618', 1, 'Generate Report For Product Master List'),
(186, '1673693630', 1, 'Generate Report For Product Master List'),
(187, '1673693648', 1, 'Generate Report For Product Master List'),
(188, '1673693693', 1, 'Updated [REG Okinawa] in the Product list'),
(189, '1673693724', 1, 'Created [OL No = OLCODE-CE86] in the OrderList'),
(190, '1673693732', 1, 'Updated [RO No = OLCODE-CE86] in the Request Order'),
(191, '1673693732', 1, 'Updated [RO No = OLCODE-CE86] in the Request Order'),
(192, '1673693739', 1, 'Updated [RO No = ROCODE-CB48] in the Stock Transfer List'),
(193, '1673693739', 1, 'Updated [RO No = ROCODE-CB48] in the Stock Transfer List'),
(194, '1673693757', 1, 'Generate Report For Product Master List'),
(195, '1673702276', 1, 'Created [Bill No = BUBBLE-5928] in the Order list'),
(196, '1673702310', 1, 'Created [Bopis] in the Product list'),
(197, '1673702426', 1, 'Updated [Bopis] in the Product list'),
(198, '1673702446', 1, 'Created [OL No = OLCODE-EDD9] in the OrderList'),
(199, '1673702461', 1, 'Updated [RO No = OLCODE-EDD9] in the Request Order'),
(200, '1673702472', 1, 'Updated [RO No = ROCODE-A7EA] in the Stock Transfer List'),
(201, '1674819036', 1, 'Updated [Manager] in the Group list'),
(202, '1674834349', 1, 'User has restored database'),
(203, '1675238945', 1, 'User has logged In'),
(204, '1675238951', 1, 'User has logged out');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `service_charge_value` varchar(255) NOT NULL,
  `vat_charge_value` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `currency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name`, `service_charge_value`, `vat_charge_value`, `address`, `phone`, `country`, `message`, `currency`) VALUES
(1, 'Bubble Bee', '3', '12', 'Zone 1, Brgy. Maliwalo, Tarlac, Philippines', '0977 797 6188', '', 'From our humble beginnings in October 2020, Bubble Bee has continued to flourish attracting milk tea', 'PHP');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `discount_percent` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `name`, `discount_percent`, `active`) VALUES
(1, 'Senior', 20, 1),
(2, 'Person with disability', 20, 1),
(3, 'ChristmasDC', 15, 1),
(4, 'Custom', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `permission`) VALUES
(1, 'Super Administrator', 'a:57:{i:0;s:10:\"viewMainte\";i:1;s:10:\"createProd\";i:2;s:10:\"updateProd\";i:3;s:8:\"viewProd\";i:4;s:10:\"deleteProd\";i:5;s:13:\"createMaincat\";i:6;s:13:\"updateMaincat\";i:7;s:11:\"viewMaincat\";i:8;s:13:\"deleteMaincat\";i:9;s:12:\"createSubcat\";i:10;s:12:\"updateSubcat\";i:11;s:10:\"viewSubcat\";i:12;s:12:\"deleteSubcat\";i:13;s:10:\"createDisc\";i:14;s:10:\"updateDisc\";i:15;s:8:\"viewDisc\";i:16;s:10:\"deleteDisc\";i:17;s:11:\"createTable\";i:18;s:11:\"updateTable\";i:19;s:9:\"viewTable\";i:20;s:11:\"deleteTable\";i:21;s:11:\"createOrder\";i:22;s:11:\"updateOrder\";i:23;s:9:\"viewOrder\";i:24;s:11:\"deleteOrder\";i:25;s:9:\"viewInven\";i:26;s:15:\"createOrderList\";i:27;s:15:\"updateOrderList\";i:28;s:13:\"viewOrderList\";i:29;s:15:\"deleteOrderList\";i:30;s:14:\"createReqorder\";i:31;s:14:\"updateReqorder\";i:32;s:12:\"viewReqorder\";i:33;s:14:\"deleteReqorder\";i:34;s:19:\"createStocktransfer\";i:35;s:19:\"updateStocktransfer\";i:36;s:17:\"viewStocktransfer\";i:37;s:19:\"deleteStocktransfer\";i:38;s:21:\"createStockadjustment\";i:39;s:21:\"updateStockadjustment\";i:40;s:19:\"viewStockadjustment\";i:41;s:21:\"deleteStockadjustment\";i:42;s:9:\"viewStock\";i:43;s:10:\"viewReport\";i:44;s:10:\"viewSystem\";i:45;s:10:\"createUser\";i:46;s:10:\"updateUser\";i:47;s:8:\"viewUser\";i:48;s:10:\"deleteUser\";i:49;s:11:\"createGroup\";i:50;s:11:\"updateGroup\";i:51;s:9:\"viewGroup\";i:52;s:11:\"deleteGroup\";i:53;s:13:\"updateCompany\";i:54;s:11:\"viewProfile\";i:55;s:13:\"updateSetting\";i:56;s:12:\"createBackup\";}'),
(7, 'Cashier', 'a:5:{i:0;s:11:\"createOrder\";i:1;s:11:\"updateOrder\";i:2;s:9:\"viewOrder\";i:3;s:11:\"deleteOrder\";i:4;s:11:\"viewProfile\";}'),
(9, 'Manager', 'a:32:{i:0;s:10:\"viewMainte\";i:1;s:8:\"viewProd\";i:2;s:11:\"viewMaincat\";i:3;s:10:\"viewSubcat\";i:4;s:8:\"viewDisc\";i:5;s:9:\"viewTable\";i:6;s:11:\"createOrder\";i:7;s:11:\"updateOrder\";i:8;s:9:\"viewOrder\";i:9;s:9:\"viewInven\";i:10;s:15:\"createOrderList\";i:11;s:15:\"updateOrderList\";i:12;s:13:\"viewOrderList\";i:13;s:14:\"createReqorder\";i:14;s:14:\"updateReqorder\";i:15;s:12:\"viewReqorder\";i:16;s:19:\"createStocktransfer\";i:17;s:19:\"updateStocktransfer\";i:18;s:17:\"viewStocktransfer\";i:19;s:21:\"createStockadjustment\";i:20;s:21:\"updateStockadjustment\";i:21;s:19:\"viewStockadjustment\";i:22;s:10:\"viewReport\";i:23;s:10:\"viewSystem\";i:24;s:10:\"createUser\";i:25;s:10:\"updateUser\";i:26;s:8:\"viewUser\";i:27;s:10:\"deleteUser\";i:28;s:13:\"updateCompany\";i:29;s:11:\"viewProfile\";i:30;s:13:\"updateSetting\";i:31;s:12:\"createBackup\";}'),
(11, 'asdsad', 'a:1:{i:0;s:10:\"viewMainte\";}');

-- --------------------------------------------------------

--
-- Table structure for table `orderlist`
--

CREATE TABLE `orderlist` (
  `id` int(11) NOT NULL,
  `ol_code` varchar(255) NOT NULL,
  `date_time` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ro_code` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `st_code` varchar(255) NOT NULL,
  `st_status` int(11) NOT NULL,
  `st_exp_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderlist`
--

INSERT INTO `orderlist` (`id`, `ol_code`, `date_time`, `user_id`, `ro_code`, `status`, `remarks`, `st_code`, `st_status`, `st_exp_date`) VALUES
(3, 'OLCODE-AEB9', '1673507097', 1, 'ROCODE-F19A', 1, '  ', 'STCODE-30CE', 1, '1673650800'),
(14, 'OLCODE-F385', '1673658574', 1, 'ROCODE-44CB', 1, ' ', 'STCODE-84F2', 1, '1673823600'),
(15, 'OLCODE-CE86', '1673693724', 1, 'ROCODE-CB48', 1, ' ', 'STCODE-A52D', 1, '1673650800'),
(16, 'OLCODE-EDD9', '1673702446', 1, 'ROCODE-A7EA', 1, ' ', 'STCODE-758E', 1, '1673650800');

-- --------------------------------------------------------

--
-- Table structure for table `orderlist_items`
--

CREATE TABLE `orderlist_items` (
  `id` int(11) NOT NULL,
  `orderlist_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderlist_items`
--

INSERT INTO `orderlist_items` (`id`, `orderlist_id`, `product_id`, `qty`) VALUES
(56, 3, 4, '1'),
(57, 3, 4, '1'),
(58, 4, 4, '1'),
(59, 4, 4, '1'),
(60, 5, 4, '1'),
(61, 5, 4, '1'),
(62, 6, 4, '1'),
(63, 6, 4, '1'),
(66, 14, 4, '100'),
(67, 148, 4, '50'),
(68, 8, 4, '100'),
(73, 15, 17, '1000'),
(74, 15, 11, '500'),
(77, 16, 19, '1000');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `bill_no` varchar(255) NOT NULL,
  `date_time` varchar(255) NOT NULL,
  `gross_amount` varchar(255) NOT NULL,
  `service_charge_rate` varchar(255) NOT NULL,
  `service_charge_amount` varchar(255) NOT NULL,
  `vat_charge_rate` varchar(255) NOT NULL,
  `vat_charge_amount` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `net_amount` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `paid_status` int(11) NOT NULL,
  `cash_tendered` varchar(255) NOT NULL,
  `total_change` varchar(255) NOT NULL,
  `discount_id` text NOT NULL,
  `discount_percent` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `datetoday` date NOT NULL,
  `payment_id` text NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `senior_id` varchar(255) NOT NULL,
  `vattable_amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `bill_no`, `date_time`, `gross_amount`, `service_charge_rate`, `service_charge_amount`, `vat_charge_rate`, `vat_charge_amount`, `discount`, `net_amount`, `user_id`, `table_id`, `paid_status`, `cash_tendered`, `total_change`, `discount_id`, `discount_percent`, `remarks`, `datetoday`, `payment_id`, `reference_no`, `senior_id`, `vattable_amount`) VALUES
(1, 'BUBBLE-2EEC', '1673048051', '624.00', '3', '18.72', '12', '74.88', '143.52', '574.08', 1, 1, 1, '239.20', '0', '[\"1\"]', 20, ' ', '2023-01-07', '0', '', '', '0'),
(2, 'BUBBLE-7102', '1673048082', '416.00', '3', '12.48', '12', '49.92', '95.68', '382.72', 1, 2, 1, '239.20', '0', '[\"2\"]', 20, ' ', '2023-01-07', '0', '', '', '0'),
(3, 'BUBBLE-AC56', '1673048314', '624.00', '3', '18.72', '12', '74.88', '0.00', '717.60', 1, 2, 1, '239.20', '0', '[\"discount\"]', 20, ' ', '2023-01-07', '0', '', '', '0'),
(4, 'BUBBLE-9475', '1673051737', '125.00', '3', '3.75', '12', '15.00', '22.75', '121.00', 1, 1, 1, '239.20', '0', '[\"2\"]', 20, ' ', '2023-01-07', '0', '', '', '0'),
(5, 'BUBBLE-9D78', '1673051921', '625.00', '3', '18.75', '12', '75.00', '', '718.75', 1, 1, 2, '239.20', '0', '[\"discount\"]', 0, ' ', '2023-01-07', '0', '', '', '0'),
(6, 'BUBBLE-5D91', '1673053910', '12000.00', '3', '360.00', '12', '1440.00', '', '13800.00', 1, 1, 3, '239.20', '0', '[\"discount\"]', 0, '', '2023-01-07', '0', '', '', '0'),
(7, 'BUBBLE-CE29', '1673054351', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 1, 1, '239.20', '0', '[\"discount\"]', 0, ' ', '2023-01-07', '0', '', '', '0'),
(8, 'BUBBLE-4DB9', '1673054843', '208.00', '3', '6.24', '12', '24.96', '47.84', '191.36', 1, 1, 2, '239.20', '0', '[\"2\"]', 20, '   ', '2023-01-07', '0', '', '', '0'),
(9, 'BUBBLE-52C4', '1673057151', '2520.00', '3', '75.60', '12', '302.40', '579.60', '2318.40', 1, 1, 1, '239.20', '0', '[\"2\"]', 20, ' ', '2023-01-07', '0', '', '', '0'),
(10, 'BUBBLE-D71C', '1673057292', '9000.00', '3', '270.00', '12', '1080.00', '', '10350.00', 1, 1, 1, '239.20', '0', '[\"discount\"]', 0, ' ', '2023-01-07', '0', '', '', '0'),
(11, 'BUBBLE-F098', '1673341434', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 1, 1, '239.20', '0', '[\"discount\"]', 0, ' ', '2023-01-10', '0', '', '', '0'),
(18, 'BUBBLE-0EB1', '1673360426', '120.00', '3', '3.60', '12', '14.40', '20.70', '117.30', 1, 2, 1, '239.20', '0', '[\"3\"]', 15, '   ', '2023-01-10', '[\"1\"]', '', '', '0'),
(19, 'BUBBLE-1CA6', '1673361719', '1664.00', '3', '49.92', '12', '199.68', '', '1913.60', 1, 3, 3, '239.20', '0', '[\"discount\"]', 0, '', '2023-01-10', '[\"0\"]', '', '', '0'),
(20, 'BUBBLE-C2E0', '1673361879', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 1, 3, '239.20', '0', '[\"discount\"]', 0, '', '2023-01-10', '[\"--Select Payment Method--\"]', '', '', '0'),
(21, 'BUBBLE-C4D4', '1673362058', '125.00', '3', '3.75', '12', '15.00', '', '143.75', 1, 2, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, '   ', '2023-01-10', '[\"1\"]', '', '', '0'),
(22, 'BUBBLE-BE7A', '1673363692', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 3, 3, '239.20', '0', '[\"discount\"]', 0, '', '2023-01-10', '[\"--Select Payment Method--\"]', '', '', '0'),
(23, 'BUBBLE-CE78', '1673366045', '125.00', '3', '3.75', '12', '15.00', '', '143.75', 1, 1, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, ' ', '2023-01-10', '[\"1\"]', '', '', '0'),
(24, 'BUBBLE-5A2D', '1673367060', '125.00', '3', '3.75', '12', '15.00', '', '143.75', 1, 2, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, ' ', '2023-01-10', '[\"1\"]', '', '', '0'),
(25, 'BUBBLE-8B34', '1673367120', '125.00', '3', '3.75', '12', '15.00', '', '143.75', 1, 3, 2, '239.20', '0', '[\"--Select Discount--\"]', 0, '  ', '2023-01-10', '[\"1\"]', '', '', '0'),
(26, 'BUBBLE-2BCE', '1673367383', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 1, 0, '239.20', '0', '[\"--Select Discount--\"]', 0, '  ', '2023-01-10', '[\"1\"]', '', '', '0'),
(27, 'BUBBLE-DE0F', '1673367582', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 2, 3, '239.20', '0', '[\"discount\"]', 0, '', '2023-01-10', '[\"--Select Payment Method--\"]', '', '', '0'),
(28, 'BUBBLE-6B0F', '1673368533', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 3, 2, '239.20', '0', '[\"--Select Discount--\"]', 0, ' ', '2023-01-10', '[\"1\"]', '', '', '0'),
(29, 'BUBBLE-AACA', '1673368835', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 1, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, '  ', '2023-01-10', '[\"1\"]', '', '', '0'),
(30, 'BUBBLE-F9F4', '1673422745', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 2, 2, '239.20', '0', '[\"--Select Discount--\"]', 0, ' ', '2023-01-11', '[\"1\"]', '', '', '0'),
(31, 'BUBBLE-89CD', '1673423030', '333.00', '3', '9.99', '12', '39.96', '', '382.95', 1, 3, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, '   ', '2023-01-11', '[\"1\"]', '', '', '0'),
(32, 'BUBBLE-B2BE', '1673423407', '541.00', '3', '16.23', '12', '64.92', '', '622.15', 1, 1, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, '   ', '2023-01-11', '[\"1\"]', '', '', '0'),
(33, 'BUBBLE-ECD6', '1673423751', '125.00', '3', '3.75', '12', '15.00', '', '143.75', 1, 2, 3, '239.20', '0', '[\"discount\"]', 0, '', '2023-01-11', '[\"--Select Payment Method--\"]', '', '', '0'),
(34, 'BUBBLE-EA65', '1673423767', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 3, 3, '239.20', '0', '[\"discount\"]', 0, '', '2023-01-11', '[\"--Select Payment Method--\"]', '', '', '0'),
(35, 'BUBBLE-70AF', '1673424769', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 1, 3, '239.20', '0', '[\"discount\"]', 0, '', '2023-01-11', '[\"--Select Payment Method--\"]', '', '', '0'),
(36, 'BUBBLE-41E5', '1673424931', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 2, 3, '239.20', '0', '[\"discount\"]', 0, '', '2023-01-11', '[\"--Select Payment Method--\"]', '', '', '0'),
(37, 'BUBBLE-01DE', '1673424983', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 3, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, ' ', '2023-01-11', '[\"1\"]', '', '', '0'),
(38, 'BUBBLE-64B8', '1673425001', '333.00', '3', '9.99', '12', '39.96', '', '382.95', 1, 1, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, ' ', '2023-01-11', '[\"1\"]', '', '', '0'),
(39, 'BUBBLE-E8D2', '1673425371', '200304.00', '3', '6009.12', '12', '24036.48', '', '230349.60', 1, 2, 3, '239.20', '0', '[\"discount\"]', 0, '', '2023-01-11', '[\"--Select Payment Method--\"]', '', '', '0'),
(40, 'BUBBLE-8FCB', '1673425689', '198640.00', '3', '5959.20', '12', '23836.80', '', '228436.00', 1, 1, 3, '239.20', '0', '[\"discount\"]', 0, '', '2023-01-11', '[\"--Select Payment Method--\"]', '', '', '0'),
(41, 'BUBBLE-F859', '1673425822', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 2, 3, '239.20', '0', '[\"discount\"]', 0, '', '2023-01-11', '[\"--Select Payment Method--\"]', '', '', '0'),
(42, 'BUBBLE-E010', '1673459136', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 3, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, ' ', '2023-01-11', '[\"1\"]', '', '', '0'),
(43, 'BUBBLE-3972', '1673460114', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 1, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, ' ', '2023-01-11', '[\"1\"]', '', '', '0'),
(44, 'BUBBLE-44C9', '1673460563', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 2, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, '  ', '2023-01-11', '[\"2\"]', '', '', '0'),
(45, 'BUBBLE-2E90', '1673461124', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 1, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, ' ', '2023-01-11', '[\"2\"]', '', '', '0'),
(46, 'BUBBLE-1C65', '1673461186', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 2, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, ' ', '2023-01-11', '[\"payment\"]', '', '', '0'),
(47, 'BUBBLE-22DD', '1673461205', '125.00', '3', '3.75', '12', '15.00', '', '143.75', 1, 3, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, ' ', '2023-01-11', '[\"1\"]', '', '', '0'),
(48, 'BUBBLE-A8FB', '1673461354', '', '3', '0', '12', '0', '', '', 1, 1, 3, '239.20', '0', '[\"discount\"]', 0, '', '2023-01-11', '[\"--Select Payment Method--\"]', '', '', '0'),
(49, 'BUBBLE-5595', '1673461361', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 2, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, ' ', '2023-01-11', '[\"2\"]', '', '', '0'),
(50, 'BUBBLE-EF35', '1673461485', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 3, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, ' ', '2023-01-11', '[\"1\"]', '', '', '0'),
(51, 'BUBBLE-F1B1', '1673462532', '416.00', '3', '12.48', '12', '49.92', '', '478.40', 1, 1, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, '  ', '2023-01-11', '[\"1\"]', '', '', '0'),
(52, 'BUBBLE-F929', '1673490900', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 2, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, ' ', '2023-01-12', '[\"1\"]', '', '', '0'),
(53, 'BUBBLE-FC8C', '1673491433', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 1, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, ' ', '2023-01-12', '[\"1\"]', '', '', '0'),
(54, 'BUBBLE-C59C', '1673491573', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 2, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, ' ', '2023-01-12', '[\"1\"]', '', '', '0'),
(55, 'BUBBLE-F394', '1673491592', '1040.00', '3', '31.20', '12', '124.80', '', '1196.00', 1, 3, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, ' ', '2023-01-12', '[\"1\"]', '', '', '0'),
(56, 'BUBBLE-401A', '1673491615', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 3, 3, '239.20', '0', '[\"discount\"]', 0, '', '2023-01-12', '[\"--Select Payment Method--\"]', '', '', '0'),
(57, 'BUBBLE-C9F1', '1673491642', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 2, 3, '239.20', '0', '[\"discount\"]', 0, '', '2023-01-12', '[\"--Select Payment Method--\"]', '', '', '0'),
(58, 'BUBBLE-D0DF', '1673491710', '125.00', '3', '3.75', '12', '15.00', '', '143.75', 1, 1, 3, '239.20', '0', '[\"discount\"]', 0, '', '2023-01-12', '[\"--Select Payment Method--\"]', '', '', '0'),
(59, 'BUBBLE-D1A1', '1673491759', '416.00', '3', '12.48', '12', '49.92', '', '478.40', 1, 2, 3, '239.20', '0', '[\"discount\"]', 0, '', '2023-01-12', '[\"--Select Payment Method--\"]', '', '', '0'),
(60, 'BUBBLE-108B', '1673491870', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 3, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, '  ', '2023-01-12', '[\"2\"]', '', '', '0'),
(61, 'BUBBLE-43FD', '1673491910', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 1, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, ' ', '2023-01-12', '[\"payment\"]', '', '', '0'),
(62, 'BUBBLE-AD5D', '1673492046', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 1, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, ' ', '2023-01-12', '[\"payment\"]', '', '', '0'),
(63, 'BUBBLE-60FC', '1673494078', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 1, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, ' ', '2023-01-12', '[\"2\"]', 'cash_tendered', '', '0'),
(64, 'BUBBLE-E352', '1673494266', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 1, 1, '', '0', '[\"--Select Discount--\"]', 0, '   ', '2023-01-12', '[\"2\"]', '111111111', '', '0'),
(65, 'BUBBLE-D521', '1673495042', '125.00', '3', '3.75', '12', '15.00', '', '143.75', 1, 1, 1, '143.75', '0', '[\"--Select Discount--\"]', 0, '  ', '2023-01-12', '[\"2\"]', '111111111', '', '0'),
(66, 'BUBBLE-07E7', '1673495543', '208.00', '3', '6.24', '12', '24.96', '37.86', '151.42', 1, 1, 1, '200', '48.58', '[\"1\"]', 20, ' ', '2023-01-12', '[\"1\"]', '', '1234567899754', '0'),
(67, 'BUBBLE-93E8', '1673498123', '125.00', '3', '3.75', '12', '15.00', '22.75', '91.00', 1, 1, 1, '111', '20.00', '[\"1\"]', 20, ' ', '2023-01-12', '[\"1\"]', '', '12121212', '0'),
(68, 'BUBBLE-B4BB', '1673498368', '1248.00', '3', '37.44', '12', '149.76', '', '1435.20', 1, 1, 1, '1500', '64.80', '[\"--Select Discount--\"]', 0, ' ', '2023-01-12', '[\"1\"]', '', '', '0'),
(69, 'BUBBLE-2B16', '1673498396', '333.00', '3', '9.99', '12', '39.96', '', '382.95', 1, 1, 1, '384', '1.05', '[\"--Select Discount--\"]', 0, '    ', '2023-01-12', '[\"1\"]', '', '', '0'),
(70, 'BUBBLE-8B99', '1673499224', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 1, 1, '', '0', '[\"--Select Discount--\"]', 0, '  ', '2023-01-12', '[\"1\"]', '', '', '0'),
(71, 'BUBBLE-493D', '1673499273', '333.00', '3', '9.99', '12', '39.96', '', '382.95', 1, 2, 1, '1111', '632.60', '[\"--Select Discount--\"]', 0, '  ', '2023-01-12', '[\"1\"]', '', '', '0'),
(72, 'BUBBLE-04EF', '1673503346', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 3, 1, '300', '60.80', '[\"--Select Discount--\"]', 0, ' ', '2023-01-12', '[\"1\"]', '', '', '0'),
(73, 'BUBBLE-F4D7', '1673503408', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 3, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, ' ', '2023-01-12', '[\"2\"]', '111111111', '', '0'),
(74, 'BUBBLE-F58A', '1673503466', '208.00', '3', '6.24', '12', '24.96', '37.86', '151.42', 1, 3, 1, '151.43', '0.01', '[\"1\"]', 20, ' ', '2023-01-12', '[\"1\"]', '', '123456789', '0'),
(75, 'BUBBLE-C62C', '1673503521', '416.00', '3', '12.48', '12', '49.92', '', '478.40', 1, 3, 1, '500', '21.60', '[\"--Select Discount--\"]', 0, ' ', '2023-01-12', '[\"1\"]', '', '', '0'),
(76, 'BUBBLE-5E39', '1673516352', '328.00', '3', '9.84', '12', '39.36', '', '377.20', 1, 3, 1, '400', '22.80', '[\"--Select Discount--\"]', 0, '   ', '2023-01-12', '[\"1\"]', '', '', '0'),
(77, 'BUBBLE-7C01', '1673540524', '416.00', '3', '12.48', '12', '49.92', '', '478.40', 1, 3, 1, '300', '60.80', '[\"--Select Discount--\"]', 0, '  ', '2023-01-12', '[\"1\"]', '', '', '0'),
(78, 'BUBBLE-E4F5', '1673540868', '120.00', '3', '3.60', '12', '14.40', '', '138.00', 1, 1, 1, '200', '62.00', '[\"--Select Discount--\"]', 0, ' ', '2023-01-12', '[\"1\"]', '', '', '0'),
(79, 'BUBBLE-6843', '1673541000', '1576.00', '3', '47.28', '12', '189.12', '', '1812.40', 1, 2, 1, '1700', '25.60', '[\"--Select Discount--\"]', 0, '   ', '2023-01-12', '[\"1\"]', '', '', '0'),
(95, 'BUBBLE-B129', '1673544716', '328.00', '3', '9.84', '12', '39.36', '', '377.20', 1, 1, 1, '400', '22.80', '[\"--Select Discount--\"]', 0, ' ', '2023-01-12', '[\"1\"]', '', '', '0'),
(116, 'BUBBLE-F8FD', '1673618257', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 1, 1, '300', '60.80', '[\"--Select Discount--\"]', 0, ' ', '2023-01-13', '[\"1\"]', '', '', '232.96'),
(117, 'BUBBLE-C041', '1673618512', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 1, 1, '239.20', '0', '[\"--Select Discount--\"]', 0, ' ', '2023-01-13', '[\"2\"]', '123456789', '', '232.96'),
(119, 'BUBBLE-6F5A', '1673656406', '120.00', '3', '3.60', '12', '14.40', '21.84', '87.36', 1, 1, 1, '100', '12.64', '[\"1\"]', 20, ' ', '2023-01-14', '[\"1\"]', '', '123456789', '134.40'),
(120, 'BUBBLE-6822', '1673657595', '120.00', '3', '3.60', '12', '14.40', '20.70', '117.30', 1, 1, 1, '117.30', '0', '[\"3\"]', 15, ' ', '2023-01-14', '[\"2\"]', '123456789', '', '134.40'),
(121, 'BUBBLE-985D', '1673658442', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 1, 1, '300', '60.80', '[\"--Select Discount--\"]', 0, ' ', '2023-01-14', '[\"1\"]', '', '', '232.96'),
(122, 'BUBBLE-1FE1', '1673659132', '51.00', '3', '1.53', '12', '6.12', '', '58.65', 1, 2, 1, '58.65', '0', '[\"--Select Discount--\"]', 0, ' ', '2023-01-14', '[\"1\"]', '', '', '57.12'),
(127, 'BUBBLE-223E', '1673670871', '120.00', '3', '3.60', '12', '14.40', '', '138.00', 1, 2, 1, '', '0', '[\"--Select Discount--\"]', 0, '  ', '2023-01-14', '[\"payment\"]', '', '', '134.40'),
(128, 'BUBBLE-FB52', '1673671119', '208.00', '3', '6.24', '12', '24.96', '', '239.20', 1, 2, 3, '', '', '[\"discount\"]', 0, '', '2023-01-14', '[\"--Select Payment Method--\"]', '', '', '232.96'),
(129, 'BUBBLE-5928', '1673702276', '120.00', '3', '3.60', '12', '14.40', '', '138.00', 1, 3, 3, '', '', '[\"discount\"]', 0, '', '2023-01-14', '[\"--Select Payment Method--\"]', '', '', '134.40');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `subcat_name` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_name`, `product_id`, `subcat_name`, `qty`, `rate`, `amount`) VALUES
(3, 2, '\"Tapsilog\"', 2, '[\"3\"]', '2', '208.00', '416.00'),
(4, 1, '\"Porkchop\"', 3, '[\"3\"]', '3', '208.00', '624.00'),
(6, 3, '\"Tapsilog\"', 2, '[\"3\"]', '3', '208.00', '624.00'),
(8, 4, '\"OkinawaM\"', 1, '[\"1\"]', '1', '125.00', '125.00'),
(10, 5, '\"OkinawaM\"', 1, '[\"1\"]', '5', '125.00', '625.00'),
(12, 7, '\"Tapsilog\"', 2, '[\"3\"]', '1', '208.00', '208.00'),
(16, 8, '\"Porkchop\"', 3, '[\"3\"]', '1', '208.00', '208.00'),
(18, 9, '\"Red Horse\"', 4, '[\"5\"]', '21', '120.00', '2520.00'),
(20, 10, '\"Red Horse\"', 4, '[\"5\"]', '75', '120.00', '9000.00'),
(22, 11, '\"Porkchop\"', 3, '[\"3\"]', '1', '208.00', '208.00'),
(32, 18, '\"Red Horse\"', 4, '[\"5\"]', '1', '120.00', '120.00'),
(33, 19, '\"Longsilog\"', 3, '', '8', '208.00', '1664.00'),
(34, 20, '\"Baksilog\"', 2, '', '1', '208.00', '208.00'),
(38, 21, '\"OkinawaM\"', 1, '[\"1\"]', '1', '125.00', '125.00'),
(39, 22, '\"Longsilog\"', 3, '', '1', '208.00', '208.00'),
(41, 23, '\"OkinawaM\"', 1, '[\"1\"]', '1', '125.00', '125.00'),
(45, 24, '\"OkinawaM\"', 1, '[\"1\"]', '1', '125.00', '125.00'),
(46, 25, '\"OkinawaM\"', 1, '[\"1\"]', '1', '125.00', '125.00'),
(49, 26, '\"Tapsilog\"', 2, '[\"3\"]', '1', '208.00', '208.00'),
(50, 27, '\"Longsilog\"', 3, '', '1', '208.00', '208.00'),
(52, 28, '\"Porkchop\"', 3, '[\"3\"]', '1', '208.00', '208.00'),
(56, 30, '\"Porkchop\"', 3, '[\"3\"]', '1', '208.00', '208.00'),
(60, 31, '\"OkinawaM\"', 1, '[\"1\"]', '1', '125.00', '125.00'),
(64, 32, '\"Tapsilog\"', 2, '[\"3\"]', '1', '208.00', '208.00'),
(65, 29, '\"Porkchop\"', 3, '[\"3\"]', '1', '208.00', '208.00'),
(73, 38, '\"Tapsilog\"', 2, '[\"3\"]', '1', '208.00', '208.00'),
(74, 37, '\"Porkchop\"', 3, '[\"3\"]', '1', '208.00', '208.00'),
(80, 43, '\"Tapsilog\"', 2, '[\"3\"]', '1', '208.00', '208.00'),
(81, 42, '\"Porkchop\"', 3, '[\"3\"]', '1', '208.00', '208.00'),
(84, 44, '\"Porkchop\"', 3, '[\"3\"]', '1', '208.00', '208.00'),
(86, 45, '\"Tapsilog\"', 2, '[\"3\"]', '1', '208.00', '208.00'),
(88, 46, '\"Porkchop\"', 3, '[\"3\"]', '1', '208.00', '208.00'),
(93, 50, '\"Tapsilog\"', 2, '[\"3\"]', '1', '208.00', '208.00'),
(94, 49, '\"Tapsilog\"', 2, '[\"3\"]', '1', '208.00', '208.00'),
(97, 51, '\"Porkchop\"', 3, '[\"3\"]', '1', '208.00', '208.00'),
(99, 52, '\"Porkchop\"', 3, '[\"3\"]', '1', '208.00', '208.00'),
(100, 47, '\"OkinawaM\"', 1, '[\"1\"]', '1', '125.00', '125.00'),
(102, 53, '\"Tapsilog\"', 2, '[\"3\"]', '1', '208.00', '208.00'),
(104, 54, '\"Porkchop\"', 3, '[\"3\"]', '1', '208.00', '208.00'),
(106, 55, '\"Porkchop\"', 3, '[\"3\"]', '5', '208.00', '1040.00'),
(117, 62, '\"Tapsilog\"', 2, '[\"3\"]', '1', '208.00', '208.00'),
(118, 61, '\"Porkchop\"', 3, '[\"3\"]', '1', '208.00', '208.00'),
(120, 60, '\"Porkchop\"', 3, '[\"3\"]', '1', '208.00', '208.00'),
(122, 63, '\"Tapsilog\"', 2, '[\"3\"]', '1', '208.00', '208.00'),
(126, 64, '\"Tapsilog\"', 2, '[\"3\"]', '1', '208.00', '208.00'),
(129, 65, '\"OkinawaM\"', 1, '[\"1\"]', '1', '125.00', '125.00'),
(131, 66, '\"Porkchop\"', 3, '[\"3\"]', '1', '208.00', '208.00'),
(133, 67, '\"OkinawaM\"', 1, '[\"1\"]', '1', '125.00', '125.00'),
(135, 68, '\"Porkchop\"', 3, '[\"3\"]', '6', '208.00', '1248.00'),
(140, 69, '\"Porkchop\"', 3, '[\"3\"]', '1', '208.00', '208.00'),
(143, 70, '\"Porkchop\"', 3, '[\"3\"]', '1', '208.00', '208.00'),
(146, 71, '\"Tapsilog\"', 2, '[\"3\"]', '1', '208.00', '208.00'),
(148, 72, '\"Tapsilog\"', 2, '[\"3\"]', '1', '208.00', '208.00'),
(150, 73, '\"Porkchop\"', 3, '[\"3\"]', '1', '208.00', '208.00'),
(152, 74, '\"Porkchop\"', 3, '[\"3\"]', '1', '208.00', '208.00'),
(154, 75, '\"Porkchop\"', 3, '[\"3\"]', '1', '208.00', '208.00'),
(160, 77, '\"Porkchop\"', 3, '[\"3\"]', '1', '208.00', '208.00'),
(161, 77, '\"Porkchop\"', 2, '[\"3\"]', '1', '208.00', '208.00'),
(162, 76, '\"Porkchop\"', 3, '[\"3\"]', '1', '208.00', '208.00'),
(163, 76, '\"Porkchop\"', 4, '[\"3\"]', '1', '120.00', '120.00'),
(165, 78, '\"Red Horse\"', 4, '[\"5\"]', '1', '120.00', '120.00'),
(170, 79, '\"Porkchop\"', 3, '[\"3\"]', '6', '208.00', '1248.00'),
(171, 79, '\"Porkchop\"', 2, '[\"3\"]', '1', '208.00', '208.00'),
(172, 79, '\"Porkchop\"', 4, '[\"3\"]', '1', '120.00', '120.00'),
(201, 95, '\"Porkchop\"', 3, '[\"3\"]', '1', '208.00', '208.00'),
(202, 95, '\"Porkchop\"', 4, '[\"3\"]', '1', '120.00', '120.00'),
(228, 116, '\"Porkchop\"', 3, '[\"3\"]', '1', '208.00', '208.00'),
(230, 117, '\"Porkchop\"', 3, '[\"3\"]', '1', '208.00', '208.00'),
(234, 119, '\"Red Horse\"', 4, '[\"5\"]', '1', '120.00', '120.00'),
(236, 120, '\"Red Horse\"', 4, '[\"5\"]', '1', '120.00', '120.00'),
(239, 122, '\"Mema\"', 11, '[\"1\"]', '1', '51.00', '51.00'),
(240, 121, '\"Porkchop\"', 3, '[\"3\"]', '1', '208.00', '208.00'),
(251, 127, '\"Red Horse\"', 4, '[\"5\"]', '1', '120.00', '120.00'),
(252, 128, '', 3, '', '1', '208.00', '208.00'),
(253, 129, '', 4, '', '1', '120.00', '120.00');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`id`, `name`, `account_number`, `active`) VALUES
(1, 'Cash', '', 1),
(2, 'Gcash', '09156975050', 1),
(8, 'Paymaya', '09156975050', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `sub_category_id` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `srp` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `active` int(11) NOT NULL,
  `cost` varchar(255) NOT NULL,
  `markup` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `lead_time` varchar(255) NOT NULL,
  `daily_use` varchar(255) NOT NULL,
  `safety_stock` varchar(255) NOT NULL,
  `rop` int(11) NOT NULL,
  `main_category_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sub_category_id`, `name`, `srp`, `description`, `active`, `cost`, `markup`, `qty`, `lead_time`, `daily_use`, `safety_stock`, `rop`, `main_category_id`) VALUES
(1, '[\"1\"]', 'OkinawaM', '125.00', '', 1, '75', '50', '976', '2', '25', '175.00', 225, ''),
(2, '[\"3\"]', 'Tapsilog', '208.00', '<p>tapsilog</p>', 1, '108', '100', '970', '2', '50', '350.00', 450, ''),
(3, '[\"3\"]', 'Porkchop', '208.00', '<p>pork</p>', 1, '108', '100', '899', '2', '50', '350.00', 450, ''),
(4, '[\"5\"]', 'Red Horse', '120.00', '', 1, '70', '50', '149', '1', '1', '7.00', 8, ''),
(11, '[\"1\"]', 'Mema', '51.00', '', 1, '1', '50', '519', '1', '1', '7.00', 8, ''),
(17, '[\"1\"]', 'REG Okinawa', '100.00', '', 1, '50', '50', '1000', '1', '50', '350.00', 400, '[\"1\"]'),
(19, '[\"3\"]', 'Bopis', '150.00', '', 1, '50', '100', '1000', '1', '50', '350', 400, '[\"3\"]');

-- --------------------------------------------------------

--
-- Table structure for table `product_inventory`
--

CREATE TABLE `product_inventory` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `date_added` int(11) NOT NULL,
  `expiration_date` int(11) NOT NULL,
  `exp_status` int(11) NOT NULL,
  `st_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_inventory`
--

INSERT INTO `product_inventory` (`id`, `product_id`, `product_name`, `qty`, `active`, `date_added`, `expiration_date`, `exp_status`, `st_code`) VALUES
(1, 3, 'Porkchop', 899, 1, 1673047730, 1704582000, 0, 'STCODE-3D05'),
(2, 2, 'Tapsilog', 970, 1, 1673047730, 1704582000, 0, 'STCODE-3D05'),
(3, 1, 'OkinawaM', 975, 1, 1673047730, 1704582000, 0, 'STCODE-3D05'),
(4, 4, 'Red Horse', -10159, 1, 1673056639, 1673132400, 0, 'STCODE-80AE'),
(5, 4, 'Red Horse', 100, 1, 1673056810, 1673132400, 0, 'STCODE-80AE'),
(9, 4, 'Red Horse', 1, 1, 1673628787, 1673650800, 0, 'STCODE-BB7B'),
(10, 4, 'Red Horse', 1, 1, 1673628796, 1673650800, 0, 'STCODE-30CE'),
(11, 4, 'Red Horse', 1, 1, 1673628961, 1673650800, 0, 'STCODE-30CE'),
(12, 4, 'Red Horse', 1, 1, 1673629050, 1673650800, 0, 'STCODE-30CE'),
(13, 4, 'Red Horse', 1, 1, 1673629050, 1673650800, 0, 'STCODE-30CE'),
(14, 4, 'Red Horse', 100, 1, 1673658636, 1673823600, 0, 'STCODE-84F2'),
(15, 4, 'Red Horse', 100, 1, 1673658999, 1673823600, 0, 'STCODE-84F2'),
(16, 17, 'REG Okinawa', 1000, 1, 1673693739, 1673650800, 0, 'STCODE-A52D'),
(17, 11, 'Mema', 500, 1, 1673693739, 1673650800, 0, 'STCODE-A52D'),
(18, 19, 'Bopis', 1000, 1, 1673702472, 1673650800, 0, 'STCODE-758E');

-- --------------------------------------------------------

--
-- Table structure for table `stockadjustment`
--

CREATE TABLE `stockadjustment` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  `date_added` varchar(255) NOT NULL,
  `expiration_date` varchar(255) NOT NULL,
  `sa_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stockadjustment_info`
--

CREATE TABLE `stockadjustment_info` (
  `id` int(11) NOT NULL,
  `sa_code` varchar(255) NOT NULL,
  `date_time` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `st_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stockadjustment_info`
--

INSERT INTO `stockadjustment_info` (`id`, `sa_code`, `date_time`, `user_id`, `remarks`, `st_status`) VALUES
(1, 'STCODE-3D05', '1673048202', 1, '  ', 1),
(2, 'STCODE-80AE', '1673056810', 1, '  Not received tapsilog st  pork chop', 1),
(3, 'STCODE-30CE', '1673628961', 1, '   ', 1),
(4, 'STCODE-30CE', '1673628970', 1, '   ', 1),
(5, 'STCODE-30CE', '1673629050', 1, '   ', 1),
(6, 'STCODE-30CE', '1673629106', 1, '   ', 1),
(7, 'STCODE-84F2', '1673658702', 1, '  ', 1),
(8, 'STCODE-84F2', '1673658999', 1, '  ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock_history`
--

CREATE TABLE `stock_history` (
  `id` int(11) NOT NULL,
  `st_code` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  `date_added` varchar(255) NOT NULL,
  `expiration_date` varchar(255) NOT NULL,
  `exp_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_history`
--

INSERT INTO `stock_history` (`id`, `st_code`, `product_id`, `product_name`, `qty`, `active`, `date_added`, `expiration_date`, `exp_status`) VALUES
(1, 'STCODE-3D05', 3, 'Porkchop', '1000', 1, '1673047730', '1704582000', 0),
(2, 'STCODE-3D05', 2, 'Tapsilog', '1000', 1, '1673047730', '1704582000', 0),
(3, 'STCODE-3D05', 1, 'OkinawaM', '1000', 1, '1673047730', '1704582000', 0),
(4, 'STCODE-3D05', 3, 'Porkchop', '5', 1, '1673048202', '', 0),
(5, 'STCODE-3D05', 2, 'Tapsilog', '5', 1, '1673048202', '', 0),
(6, 'STCODE-3D05', 1, 'OkinawaM', '5', 1, '1673048202', '', 0),
(7, 'STCODE-80AE', 4, 'Red Horse', '1', 1, '1673056639', '1673132400', 0),
(8, 'STCODE-80AE', 4, 'Red Horse', '100', 1, '1673056810', '1673132400', 0),
(12, 'STCODE-BB7B', 4, 'Red Horse', '1', 1, '1673628787', '1673650800', 0),
(13, 'STCODE-30CE', 4, 'Red Horse', '1', 1, '1673628796', '1673650800', 0),
(14, 'STCODE-30CE', 4, 'Red Horse', '1', 1, '1673628961', '1673650800', 0),
(15, 'STCODE-30CE', 4, 'Red Horse', '1', 1, '1673628970', '', 0),
(16, 'STCODE-30CE', 4, 'Red Horse', '1', 1, '1673628970', '', 0),
(17, 'STCODE-30CE', 4, 'Red Horse', '1', 1, '1673629050', '1673650800', 0),
(18, 'STCODE-30CE', 4, 'Red Horse', '1', 1, '1673629050', '1673650800', 0),
(19, 'STCODE-30CE', 4, 'Red Horse', '1', 1, '1673629106', '', 0),
(20, 'STCODE-30CE', 4, 'Red Horse', '1', 1, '1673629106', '', 0),
(21, 'STCODE-84F2', 4, 'Red Horse', '100', 1, '1673658636', '1673823600', 0),
(22, 'STCODE-84F2', 4, 'Red Horse', '50', 1, '1673658702', '', 0),
(23, 'STCODE-84F2', 4, 'Red Horse', '100', 1, '1673658999', '1673823600', 0),
(24, 'STCODE-A52D', 17, 'REG Okinawa', '1000', 1, '1673693739', '1673650800', 0),
(25, 'STCODE-A52D', 11, 'Mema', '500', 1, '1673693739', '1673650800', 0),
(26, 'STCODE-758E', 19, 'Bopis', '1000', 1, '1673702472', '1673650800', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `capacity` varchar(255) NOT NULL,
  `available` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `table_name`, `capacity`, `available`, `active`) VALUES
(1, 'Table 1', '4', 1, 1),
(2, 'Table 2', '6', 1, 1),
(3, 'Table 3', '2', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_main_category`
--

CREATE TABLE `tbl_main_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  `button_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_main_category`
--

INSERT INTO `tbl_main_category` (`id`, `name`, `active`, `button_status`) VALUES
(1, 'Drinks', 1, ''),
(2, 'Coffee', 1, ''),
(3, 'Meals', 1, ''),
(4, 'Liquor', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sub_category`
--

CREATE TABLE `tbl_sub_category` (
  `id` int(11) NOT NULL,
  `main_category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  `markup` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sub_category`
--

INSERT INTO `tbl_sub_category` (`id`, `main_category_id`, `name`, `active`, `markup`, `description`) VALUES
(1, 1, 'Milktea', 1, 50, ''),
(2, 1, 'Milktea puff', 1, 60, ''),
(3, 3, 'Breakfast', 1, 100, ''),
(4, 3, 'Starter', 1, 50, ''),
(5, 4, 'Beers', 1, 50, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `hash_expiry` varchar(50) DEFAULT NULL,
  `login_attempts` int(11) NOT NULL,
  `logged` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `phone`, `gender`, `hash`, `hash_expiry`, `login_attempts`, `logged`) VALUES
(1, 'admin', '$2y$10$9MsgW8GDJCG04ODzfniuEeWE2VpwYT3hCo6uwz0PAMZuPvvGHDF9K', 'admin@gmail.com', 'John Carlo', 'Lapitan', '09185557063', 2, '431a0aa836d34248fdfc5d87763e1f333e0966c51217009637e265b23022bd36', '2022-12-05 19:21', 1, 0),
(12, 'johncarlo6', '$2y$10$/SaGns6j6QBudkVtJFfvoOeEKjgFbnXQuWGeJPsLbx8hvF3IN9DFC', 'johncarlolapitan6@gmail.com', 'John Carlo', 'Lapitan', '09156975050', 1, '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 2, 4),
(3, 3, 4),
(4, 4, 9),
(5, 5, 7),
(6, 6, 7),
(7, 7, 1),
(8, 8, 9),
(9, 9, 9),
(10, 10, 9),
(11, 11, 9),
(12, 12, 9),
(13, 13, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderlist`
--
ALTER TABLE `orderlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderlist_items`
--
ALTER TABLE `orderlist_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `product_inventory`
--
ALTER TABLE `product_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockadjustment`
--
ALTER TABLE `stockadjustment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockadjustment_info`
--
ALTER TABLE `stockadjustment_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_history`
--
ALTER TABLE `stock_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `table_name` (`table_name`),
  ADD UNIQUE KEY `table_name_2` (`table_name`);

--
-- Indexes for table `tbl_main_category`
--
ALTER TABLE `tbl_main_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `name_2` (`name`),
  ADD UNIQUE KEY `name_3` (`name`);

--
-- Indexes for table `tbl_sub_category`
--
ALTER TABLE `tbl_sub_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orderlist`
--
ALTER TABLE `orderlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orderlist_items`
--
ALTER TABLE `orderlist_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product_inventory`
--
ALTER TABLE `product_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `stockadjustment`
--
ALTER TABLE `stockadjustment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stockadjustment_info`
--
ALTER TABLE `stockadjustment_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stock_history`
--
ALTER TABLE `stock_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_main_category`
--
ALTER TABLE `tbl_main_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_sub_category`
--
ALTER TABLE `tbl_sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
