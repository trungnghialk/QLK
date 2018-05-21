-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 26, 2018 at 02:03 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanlykho`
--

-- --------------------------------------------------------

--
-- Table structure for table `count`
--

DROP TABLE IF EXISTS `count`;
CREATE TABLE IF NOT EXISTS `count` (
  `count_order` int(255) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `count_receipt` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `count`
--

INSERT INTO `count` (`count_order`, `id`, `count_receipt`) VALUES
(5, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `goods-transfer`
--

DROP TABLE IF EXISTS `goods-transfer`;
CREATE TABLE IF NOT EXISTS `goods-transfer` (
  `goodstransfer_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `goodstransfer_send` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `goodstransfer_receive` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `materials_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `goodstransfer_amount` int(255) NOT NULL,
  `goodstransfer_date` date NOT NULL,
  `goodstransfer_accept_date` date NOT NULL,
  `goodstransfer_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`goodstransfer_id`,`materials_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `goods_issue`
--

DROP TABLE IF EXISTS `goods_issue`;
CREATE TABLE IF NOT EXISTS `goods_issue` (
  `goodsIssue_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `materials_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `goodsIssue_amount` int(255) NOT NULL,
  `goodsIssue_date` date NOT NULL,
  `goodsIssue_accept_user` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `warehouse_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`goodsIssue_id`,`materials_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `goods_receipt`
--

DROP TABLE IF EXISTS `goods_receipt`;
CREATE TABLE IF NOT EXISTS `goods_receipt` (
  `goodsreceipt_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `goodsreceipt_note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `goodsreceipt_date` date NOT NULL,
  `goodsreceipt_user` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `warehouse_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `order_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `goodsreceipt_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`goodsreceipt_id`,`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `goods_receipt`
--

INSERT INTO `goods_receipt` (`goodsreceipt_id`, `goodsreceipt_note`, `goodsreceipt_date`, `goodsreceipt_user`, `warehouse_id`, `order_id`, `goodsreceipt_created`) VALUES
('1-PNK2018', 'Nhập kho', '2018-04-26', 'trungnghialk', '1', '1-PMH2018', '2018-04-26 13:35:46'),
('2-PNK2018', 'Nhập kho', '2018-04-26', 'trungnghialk', '1', '1-PMH2018', '2018-04-26 13:35:53'),
('3-PNK2018', 'Nhập kho', '2018-04-26', 'trungnghialk', '1', '1-PMH2018', '2018-04-26 13:36:09'),
('4-PNK2018', 'Nhập kho', '2018-04-26', 'trungnghialk', '1', '2-PMH2018', '2018-04-26 13:49:15'),
('5-PNK2018', 'Nhập kho', '2018-04-26', 'trungnghialk', '1', '2-PMH2018', '2018-04-26 13:49:23'),
('6-PNK2018', 'Nhập kho', '2018-04-26', 'trungnghialk', '2', '3-PMH2018', '2018-04-26 13:52:14');

-- --------------------------------------------------------

--
-- Table structure for table `goods_receipt_contain`
--

DROP TABLE IF EXISTS `goods_receipt_contain`;
CREATE TABLE IF NOT EXISTS `goods_receipt_contain` (
  `goodsreceipt_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `materials_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `materialscount` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`goodsreceipt_id`,`materials_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `goods_receipt_contain`
--

INSERT INTO `goods_receipt_contain` (`goodsreceipt_id`, `materials_id`, `materialscount`) VALUES
('1-PNK2018', 'VT.AA1001', 10),
('1-PNK2018', 'VT.AA1002', 0),
('1-PNK2018', 'VT.AB1001', 0),
('1-PNK2018', 'VT.AC1001', 0),
('2-PNK2018', 'VT.AA1001', 200),
('2-PNK2018', 'VT.AA1002', 0),
('2-PNK2018', 'VT.AB1001', 0),
('2-PNK2018', 'VT.AC1001', 0),
('3-PNK2018', 'VT.AA1001', 0),
('3-PNK2018', 'VT.AA1002', 120),
('3-PNK2018', 'VT.AB1001', 10),
('3-PNK2018', 'VT.AC1001', 200),
('4-PNK2018', 'VT.AA1001', 50),
('5-PNK2018', 'VT.AA1001', 100),
('6-PNK2018', 'VT.AB1001', 50);

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

DROP TABLE IF EXISTS `materials`;
CREATE TABLE IF NOT EXISTS `materials` (
  `materials_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `materials_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `materials_unit` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `materials_cat_id` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `materials_Price` int(255) NOT NULL,
  `materials_discount_rate` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `materials_discounted` int(255) NOT NULL,
  `materials_modify` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `materials_amount` int(255) NOT NULL,
  `materials_note` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`materials_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`materials_id`, `materials_name`, `materials_unit`, `materials_cat_id`, `materials_Price`, `materials_discount_rate`, `materials_discounted`, `materials_modify`, `materials_amount`, `materials_note`) VALUES
('VT.AA1001', 'Xi măng', 'Bao', 'VT.AA', 200000, '2', 0, '2018-04-14 13:44:10', 0, ''),
('VT.AA1002', 'Xi măng trắng', 'Bao', 'VT.AA', 210000, '2', 0, '2018-04-14 13:44:39', 0, ''),
('VT.AB1001', 'Vữa xây tô Mác 50', 'Bao', 'VT.AB', 200000, '2', 0, '2018-04-14 13:49:45', 0, ''),
('VT.AB1002', 'Vữa xây tô Mác 75', 'Bao', 'VT.AB', 100, '2', 0, '2018-04-26 13:30:35', 0, ''),
('VT.AB1003', 'Vữa xây tô Mác 100', 'Bao', 'VT.AB', 100, '2', 0, '2018-04-26 13:31:02', 0, ''),
('VT.AC1001', 'Vải địa kỹ thuật', 'Bao', 'VT.AC', 200, '2', 0, '2018-04-26 13:31:33', 0, ''),
('VT.AD1001', 'Thép cuộn đường kính Fi 6', 'kg', 'VT.AD', 200, '2', 0, '2018-04-26 13:33:06', 0, ''),
('VT.AD1002', 'Thép cuộn đường kính Fi 8', 'kg', 'VT.AD', 200, '2', 0, '2018-04-26 13:32:49', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `materials_category`
--

DROP TABLE IF EXISTS `materials_category`;
CREATE TABLE IF NOT EXISTS `materials_category` (
  `materials_cat_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `materials_cat_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `materials_cat_count` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`materials_cat_id`),
  UNIQUE KEY `materials_cat_name` (`materials_cat_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `materials_category`
--

INSERT INTO `materials_category` (`materials_cat_id`, `materials_cat_name`, `materials_cat_count`) VALUES
('VT.AA', 'Xi măng', 2),
('VT.AB', 'Vữa', 3),
('VT.AC', 'Vải địa', 1),
('VT.AD', 'Thép', 2),
('VT.AE', 'Sơn & Bột trét các loại', 0),
('VT.AF', 'Gạch ốp lát', 0),
('VT.AG', 'Gạch xây & Gạch Block', 0),
('VT.AH', 'Cát & Đá', 0),
('VT.AI', 'Bê tông', 0),
('VT.AK', 'Phụ gia', 0),
('VT.AL', 'Van khóa', 0),
('VT.AM', 'Máy bơm', 0),
('VT.AN', 'Ổ cắm công tắc', 0),
('VT.AO', 'MCB', 0),
('VT.AP', 'Đèn', 0),
('VT.AQ', 'Ống điện và Phụ kiện', 0),
('VT.AR', 'Dây điện', 0),
('VT.AS', 'Ống nhựa & Phụ kiện PVC', 0),
('VT.AT', 'Ống nhựa & Phụ kiện PPR', 0),
('VT.AU', 'Vật tư phụ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `warehouse_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_accept_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `approve` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'wait',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `warehouse_id`, `supplier_id`, `order_date`, `order_accept_date`, `username`, `approve`) VALUES
('4-PMH2018', '2', '1', '2018-04-26 13:58:24', '2018-04-25 17:00:00', '', 'pass'),
('1-PMH2018', '1', '1', '2018-04-26 13:35:18', '2018-04-25 17:00:00', '', 'pass'),
('2-PMH2018', '1', '1', '2018-04-26 13:48:53', '2018-04-25 17:00:00', '', 'pass'),
('3-PMH2018', '2', '2', '2018-04-26 13:51:37', '2018-04-25 17:00:00', '', 'wait');

-- --------------------------------------------------------

--
-- Table structure for table `orders_contain`
--

DROP TABLE IF EXISTS `orders_contain`;
CREATE TABLE IF NOT EXISTS `orders_contain` (
  `order_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `materials_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `materialscount_in` int(10) NOT NULL DEFAULT '0',
  `materialscount_out` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_id`,`materials_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders_contain`
--

INSERT INTO `orders_contain` (`order_id`, `materials_id`, `materialscount_in`, `materialscount_out`) VALUES
('4-PMH2018', 'VT.AA1001', 100, 0),
('3-PMH2018', 'VT.AB1001', 100, 50),
('1-PMH2018', 'VT.AC1001', 200, 200),
('2-PMH2018', 'VT.AA1001', 100, 150),
('1-PMH2018', 'VT.AB1001', 10, 10),
('1-PMH2018', 'VT.AA1002', 120, 120),
('1-PMH2018', 'VT.AA1001', 110, 210);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
CREATE TABLE IF NOT EXISTS `permission` (
  `permission_id` int(11) NOT NULL,
  `Description` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `permission_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`permission_id`, `Description`, `permission_name`) VALUES
(1, 'Chỉ xem', 'view'),
(2, 'Thủ kho', 'edit'),
(3, 'Mua hàng', 'create'),
(4, 'Trưởng phòng mua hàng', 'Asign');

-- --------------------------------------------------------

--
-- Table structure for table `permission_asign`
--

DROP TABLE IF EXISTS `permission_asign`;
CREATE TABLE IF NOT EXISTS `permission_asign` (
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `warehouse_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Permision_value` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`username`,`warehouse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `supplier_id` int(255) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_addr` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_mobile` int(11) DEFAULT NULL,
  `supplier_taxcode` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `supplier_addr`, `supplier_mobile`, `supplier_taxcode`) VALUES
(1, 'Bê tông Lê Phan', '123 Trương định, Quận 3, TP. HCM', 0, ''),
(2, 'Công ty ABC', '123 Hồng Hà, Phường 2, Q.Tân Bình', 989898989, '12343212'),
(4, 'Công ty XYZ', '123a nkkn', 989898989, '112312121'),
(7, 'Công ty Nam Công', '262a Nam Kỳ Khởi Nghĩa, Phường 8, Quận, 3', 987888666, '321222322');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_category`
--

DROP TABLE IF EXISTS `supplier_category`;
CREATE TABLE IF NOT EXISTS `supplier_category` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_cat_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `hovaten` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sdt` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `manager` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `pass`, `hovaten`, `email`, `sdt`, `manager`, `warehouse_id`) VALUES
('trungnghialk', '123123', 'Tran Trung Nghia', 'trungnghiatran90@gmail.com', '0987868280', 'chuongtd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

DROP TABLE IF EXISTS `warehouse`;
CREATE TABLE IF NOT EXISTS `warehouse` (
  `warehouse_id` int(11) NOT NULL AUTO_INCREMENT,
  `warehouse_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `warehouse_adr` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Goodsreceipt_count` int(255) DEFAULT '0',
  `GoodsIssue_count` int(255) NOT NULL DEFAULT '0',
  `Order_count` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`warehouse_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`warehouse_id`, `warehouse_name`, `warehouse_adr`, `username`, `Goodsreceipt_count`, `GoodsIssue_count`, `Order_count`) VALUES
(1, 'Jamona City', 'Đào trí, QUận 7, TP. HCM', 'trungnghialk', 0, 0, 0),
(2, 'Công trình 251', 'Hoàng Văn Thụ, Phú Nhuận', 'trungnghialk', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_contain`
--

DROP TABLE IF EXISTS `warehouse_contain`;
CREATE TABLE IF NOT EXISTS `warehouse_contain` (
  `warehouse_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `materials_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `warehouse_contain_total` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`warehouse_id`,`materials_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `warehouse_contain`
--

INSERT INTO `warehouse_contain` (`warehouse_id`, `materials_id`, `warehouse_contain_total`) VALUES
('1', 'VT.AB1001', 10),
('1', 'VT.AA1002', 120),
('1', 'VT.AA1001', 360),
('1', 'VT.AC1001', 200),
('2', 'VT.AB1001', 50);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
