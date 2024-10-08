-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 05, 2024 at 10:07 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcart`
--

CREATE TABLE `tblcart` (
  `id` int NOT NULL,
  `invoiceno` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `tblcart`
--

INSERT INTO `tblcart` (`id`, `invoiceno`, `user_id`, `product_id`, `quantity`, `price`) VALUES
(1, '20231117E0345', 1, 7, 1, 2500.00),
(4, '20231117R0218', 1, 5, 1, 6000.00),
(5, '20231117R0218', 1, 8, 1, 4000.00),
(6, '20231117R0218', 1, 6, 1, 4000.00),
(7, '20231118X90748', 1, 7, 1, 2500.00),
(8, '20231119R124', 1, 12, 1, 345000.00),
(9, '20231119O183', 1, 7, 1, 2500.00),
(10, '20231119P9806', 1, 6, 1, 4000.00),
(11, '20231119P9806', 1, 8, 1, 4000.00),
(12, '20231119P9806', 1, 5, 1, 6000.00),
(13, '20231119M54803', 1, 9, 1, 17500.00),
(14, '20231119P085217', 1, 4, 1, 2500.00),
(15, '20231119N430', 1, 4, 3, 2500.00),
(16, '20231119X8493', 1, 7, 1, 2500.00),
(17, '20231119X8493', 1, 4, 1, 2500.00),
(18, '20231119M51638', 1, 4, 1, 2500.00),
(19, '20231119W5387', 1, 7, 1, 2500.00),
(20, '20231119E4068', 1, 4, 1, 2500.00),
(21, '20231119E4068', 1, 9, 1, 17500.00),
(22, '20231119E4068', 1, 6, 1, 4000.00),
(23, '20231119J54831', 1, 8, 1, 4000.00),
(24, '20231119C729', 1, 4, 1, 2500.00),
(25, '20231119Z485', 1, 6, 1, 4000.00),
(26, '20231119R497158', 1, 7, 1, 2500.00),
(27, '20231119A9673', 1, 7, 1, 2500.00),
(28, '20231119A9673', 1, 6, 1, 4000.00),
(29, '20231119A9673', 1, 8, 1, 4000.00),
(30, '20231119A9673', 1, 5, 1, 6000.00),
(31, '20231119A9673', 1, 9, 1, 17500.00),
(32, '20231120S0931', 1, 7, 1, 2500.00),
(33, '20231120C653', 1, 8, 1, 4000.00),
(34, '20231120C653', 1, 9, 1, 17500.00),
(35, '20231120C653', 1, 11, 1, 90000.00),
(36, '20231120C653', 1, 6, 1, 4000.00),
(37, '20231120C653', 1, 5, 1, 6000.00),
(38, '20231201P018279', 1, 8, 1, 4000.00),
(39, '20231201L50926', 1, 4, 1, 2500.00),
(40, '20231201L50926', 1, 5, 1, 6000.00),
(41, '20231201L50926', 1, 8, 8, 4000.00),
(42, '20231201L50926', 1, 7, 1, 2500.00),
(43, '20231219D67319', 1, 10, 1, 72000.00),
(44, '20231219R854216', 1, 7, 1, 2500.00),
(45, '20231229Q9305', 1, 7, 1, 2500.00),
(46, '20240103M5943', 1, 7, 1, 2500.00),
(47, '20240103M5943', 1, 4, 1, 2500.00),
(48, '20240119Q834265', 1, 7, 1, 2500.00),
(49, '20240119Q834265', 1, 6, 1, 4000.00),
(50, '20240125C024', 1, 4, 1, 2500.00),
(51, '20240125C024', 1, 7, 1, 2500.00),
(52, '20240404F7489', 1, 7, 1, 2500.00),
(53, '20240405X104', 1, 4, 1, 2500.00),
(54, '20240405X104', 1, 7, 2, 2500.00);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `cat_id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`cat_id`, `name`, `created_date`, `updated_date`) VALUES
(1, 'beverages', '2023-11-10 15:38:29', '2023-11-10 15:55:54'),
(2, 'body cream', '2023-11-10 15:39:19', '2023-11-10 15:56:38'),
(4, 'beer', '2023-11-16 14:16:26', '2023-11-18 14:09:25'),
(5, 'BEVERAGES', '2023-11-16 14:16:26', NULL),
(6, 'BOOKS', '2023-11-16 14:16:26', NULL),
(7, 'COOKING OIL', '2023-11-16 14:16:26', NULL),
(8, 'CREAM', '2023-11-16 14:16:26', NULL),
(9, 'DRINKS', '2023-11-16 14:16:26', NULL),
(10, 'ENERGY DRINKS', '2023-11-16 14:16:26', NULL),
(11, 'EXERCISE BOOK', '2023-11-16 14:16:26', NULL),
(12, 'milk refill', '2023-11-16 14:16:26', '2023-11-18 14:08:42'),
(13, 'milk sachet', '2023-11-16 14:16:26', '2023-11-18 14:09:00'),
(14, 'milk tin', '2023-11-16 14:16:26', '2023-11-18 14:09:15'),
(15, 'OTHERS', '2023-11-16 14:16:26', NULL),
(16, 'SOFT DRINKS', '2023-11-16 14:16:26', NULL),
(17, 'TOMATO PASTE', '2023-11-16 14:16:26', NULL),
(18, 'WINE', '2023-11-16 14:16:26', NULL),
(19, 'YOGHURT', '2023-11-16 14:16:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblexpense`
--

CREATE TABLE `tblexpense` (
  `expense_id` int NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_swedish_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_swedish_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `tblexpense`
--

INSERT INTO `tblexpense` (`expense_id`, `title`, `description`, `created_date`, `updated_date`) VALUES
(1, 'samsung tv', '&lt;p&gt;paid for a samsung tv we bought for &lt;b&gt;100000 chai&lt;/b&gt;&lt;/p&gt;', '2023-11-14 16:05:45', '2023-11-14 16:17:53');

-- --------------------------------------------------------

--
-- Table structure for table `tblpayment`
--

CREATE TABLE `tblpayment` (
  `id` int NOT NULL,
  `invoiceno` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `total` decimal(20,2) NOT NULL,
  `paytype` varchar(10) COLLATE utf8mb4_swedish_ci NOT NULL,
  `payment_status` int NOT NULL,
  `date_paid` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `tblpayment`
--

INSERT INTO `tblpayment` (`id`, `invoiceno`, `total`, `paytype`, `payment_status`, `date_paid`) VALUES
(1, '20231117E0345', 2500.00, 'cash', 1, '2023-11-17 22:26:42'),
(4, '20231117R0218', 14000.00, 'cash', 1, '2023-11-17 22:32:30'),
(5, '20231118X90748', 2500.00, 'cash', 1, '2023-11-18 14:02:02'),
(6, '20231119R124', 345000.00, 'cash', 1, '2023-11-19 15:12:47'),
(7, '20231119O183', 2500.00, 'cash', 1, '2023-11-19 15:13:00'),
(8, '20231119P9806', 14000.00, 'cash', 1, '2023-11-19 15:13:11'),
(9, '20231119M54803', 17500.00, 'cash', 1, '2023-11-19 15:13:18'),
(10, '20231119P085217', 2500.00, 'cash', 1, '2023-11-19 15:13:29'),
(11, '20231119N430', 7500.00, 'cash', 1, '2023-11-19 15:14:06'),
(12, '20231119X8493', 5000.00, 'cash', 1, '2023-11-19 15:14:18'),
(13, '20231119M51638', 2500.00, 'cash', 1, '2023-11-19 15:14:25'),
(14, '20231119W5387', 2500.00, 'cash', 1, '2023-11-19 15:14:36'),
(15, '20231119E4068', 24000.00, 'cash', 1, '2023-11-19 15:14:49'),
(16, '20231119J54831', 4000.00, 'cash', 1, '2023-11-19 18:19:04'),
(17, '20231119C729', 2500.00, 'cash', 1, '2023-11-19 18:19:23'),
(18, '20231119Z485', 4000.00, 'cash', 1, '2023-11-19 18:47:36'),
(19, '20231119R497158', 2500.00, 'cash', 1, '2023-11-19 20:07:57'),
(20, '20231119A9673', 34000.00, 'cash', 1, '2023-11-19 20:37:10'),
(21, '20231120S0931', 2500.00, 'cash', 1, '2023-11-20 17:08:16'),
(22, '20231120C653', 121500.00, 'card', 1, '2023-11-20 17:09:20'),
(23, '20231201P018279', 4000.00, 'card', 1, '2023-12-01 09:20:49'),
(24, '20231201L50926', 43000.00, 'cash', 1, '2023-12-01 09:47:20'),
(25, '20231219D67319', 72000.00, 'cash', 1, '2023-12-19 12:49:50'),
(26, '20231219R854216', 2500.00, 'cash', 1, '2023-12-19 12:50:35'),
(27, '20231229Q9305', 2500.00, 'cash', 1, '2023-12-29 14:48:36'),
(28, '20240103M5943', 5000.00, 'card', 1, '2024-01-03 13:55:00'),
(29, '20240119Q834265', 6500.00, 'card', 1, '2024-01-19 18:33:24'),
(30, '20240125C024', 5000.00, 'card', 1, '2024-01-25 09:47:55'),
(31, '20240404F7489', 2500.00, 'cash', 1, '2024-04-04 20:16:55'),
(32, '20240405X104', 7500.00, 'cash', 1, '2024-04-05 21:59:13');

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct`
--

CREATE TABLE `tblproduct` (
  `product_id` int NOT NULL,
  `product_code` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `product_name` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `barcode` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `supplier_id` int NOT NULL,
  `category_id` int NOT NULL,
  `buying_price` decimal(20,2) NOT NULL,
  `selling_price` decimal(20,2) NOT NULL,
  `quantity` int NOT NULL,
  `unit` varchar(20) COLLATE utf8mb4_swedish_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `reorder_level` int NOT NULL,
  `status` int NOT NULL,
  `description` mediumtext COLLATE utf8mb4_swedish_ci,
  `manufacture_date` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `expiry_date` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `tblproduct`
--

INSERT INTO `tblproduct` (`product_id`, `product_code`, `product_name`, `barcode`, `supplier_id`, `category_id`, `buying_price`, `selling_price`, `quantity`, `unit`, `product_image`, `reorder_level`, `status`, `description`, `manufacture_date`, `expiry_date`, `created_date`, `updated_date`) VALUES
(4, 'L83640', 'coca cola', '5475875745745', 1, 1, 2000.00, 2500.00, 90, 'piece', 'PRO2023111228310911.png', 10, 1, '', '2023-08-02', '2023-11-30', '2023-11-11 23:28:27', '2024-04-05 21:59:00'),
(5, 'G046238', 'sneakers', '575339302222', 1, 2, 4500.00, 6000.00, 20, 'piece', 'PRO2023111254704A0F.png', 5, 1, '', '2023-11-08', '2025-01-16', '2023-11-11 23:54:09', '2024-02-05 00:29:16'),
(6, 'X859630', 'wrist watch', '738393839393', 1, 2, 3000.00, 4000.00, 9, 'unit', 'PRO2023111252BDD790.png', 10, 1, '', '2023-01-31', '2024-03-22', '2023-11-12 11:34:56', '2024-02-05 00:29:18'),
(7, 'N315', 'pizza', '895894578547845', 1, 9, 2000.00, 2500.00, 1, 'piece', 'PRO202311160774A951.jpg', 5, 1, 'N/A', '2023-11-16', '2023-11-30', '2023-11-16 16:07:41', '2024-04-05 21:59:05'),
(8, 'C2934', 'white tee shirt', '6457457845', 1, 15, 3000.00, 4000.00, 23, 'piece', 'PRO2023111614E0FD35.png', 5, 1, '', '2023-11-16', '2024-10-31', '2023-11-16 16:14:04', '2024-02-05 00:29:14'),
(9, 'D89753', 'refurbish watch', '95795678567', 1, 15, 15000.00, 17500.00, 6, 'piece', 'PRO202311161540A593.png', 3, 1, '', '2023-11-16', '2025-05-31', '2023-11-16 16:15:33', '2024-02-05 00:29:11'),
(10, 'P1402', 'iphone 6s', '47447877899', 1, 15, 65000.00, 72000.00, 0, 'piece', 'PRO202311161610FE61.png', 2, 1, '', '2023-11-16', '2025-01-31', '2023-11-16 16:16:36', '2023-12-19 12:49:31'),
(11, 'T80519', 'samsung', '7273289383', 1, 15, 80000.00, 90000.00, 0, 'piece', 'PRO2023111618959624.png', 2, 1, '', '2023-11-16', '2026-03-31', '2023-11-16 16:18:04', '2023-11-20 17:09:10'),
(12, 'X26840', 'iphone  12', '058585678567856', 1, 15, 300000.00, 345000.00, 1, 'piece', 'PRO2023111614163099.png', 2, 1, '', '2023-11-16', '2025-07-31', '2023-11-16 17:14:38', '2023-11-19 16:09:48'),
(13, 'L3564', 'mini laptop', '346464878989', 1, 15, 80000.00, 105000.00, 9, 'piece', 'PRO202311171269BF74.png', 2, 1, '', '2023-11-17', '2023-11-17', '2023-11-17 16:12:27', '2024-02-05 00:22:59'),
(14, 'B9650', 'test test', '547587574576576', 1, 17, 100.00, 120.00, 50, 'piece', 'PRO20240206007A3725.jpg', 5, 1, '', '2023-10-31', '2026-08-28', '2024-02-06 00:00:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblsettings`
--

CREATE TABLE `tblsettings` (
  `name` varchar(300) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `address` mediumtext COLLATE utf8mb4_swedish_ci,
  `motto` varchar(100) COLLATE utf8mb4_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `tblsettings`
--

INSERT INTO `tblsettings` (`name`, `phone`, `email`, `address`, `motto`) VALUES
('temidayo mini store', '08090949669', 'afolabi8120@gmail.com', 'Lagos State', 'lower prices always');

-- --------------------------------------------------------

--
-- Table structure for table `tblstockadjustment`
--

CREATE TABLE `tblstockadjustment` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `action` int NOT NULL,
  `reasons` mediumtext COLLATE utf8mb4_swedish_ci NOT NULL,
  `adjusted_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `tblstockadjustment`
--

INSERT INTO `tblstockadjustment` (`id`, `product_id`, `quantity`, `action`, `reasons`, `adjusted_date`) VALUES
(1, 4, 20, 1, 'The stock should be 28', '2023-11-15 21:31:04'),
(2, 4, 3, 2, 'The stock should be 25', '2023-11-15 21:32:41'),
(3, 6, 10, 1, 'Just testing it out', '2023-11-18 14:10:29'),
(4, 4, 100, 1, 'Added 100 new stock', '2023-11-19 15:13:51'),
(5, 5, 10, 1, 'added 10 new stock', '2023-12-20 09:33:07'),
(6, 6, 10, 2, '11', '2023-12-29 14:41:26'),
(7, 6, 11, 1, 's', '2023-12-29 14:41:51'),
(8, 5, 10, 1, 'kkkkkkkkkkkkkkkkkkkk', '2024-01-19 18:29:45');

-- --------------------------------------------------------

--
-- Table structure for table `tblsupplier`
--

CREATE TABLE `tblsupplier` (
  `supplier_id` int NOT NULL,
  `fullname` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL,
  `address` text COLLATE utf8mb4_swedish_ci,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `tblsupplier`
--

INSERT INTO `tblsupplier` (`supplier_id`, `fullname`, `email`, `phone`, `address`, `created_date`, `updated_date`) VALUES
(1, 'james temitope ema', 'james@gmail.com', '08090949669', 'No 5 Ayinke Agbetoba Street', '2023-11-10 17:48:53', '2023-11-10 17:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `user_id` int NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `usertype` enum('a','u') COLLATE utf8mb4_swedish_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`user_id`, `username`, `fullname`, `email`, `phone`, `password`, `usertype`, `created_date`, `updated_date`) VALUES
(1, 'afolabi', 'afolabi temidayo timothy', 'afolabi8120@gmail.com', '08090949669', '$2y$10$AWQsdjqR556PvKb8G4dMAuLJsIzIqTxvsPqUKyoFeL2V.JWkXZ0sG', 'a', '2023-11-10 16:48:17', '2023-11-14 16:59:43'),
(2, 'albert', 'albert faith segun', 'albert@gmail.com', '08090949660', '$2y$10$4bbjXyDog423rZu.p7UB9u19g6lem8eRK2.8FNCSDzTteD2A4Pjgq', 'u', '2023-11-10 16:48:45', '2023-11-10 17:20:34'),
(3, 'elonx', 'elon musk', 'elon.musk@spacex.com', '14470917282', '$2y$10$7.rD7G0L.tq8DKkSYEsYwuUvUvqQzAQvVwtMeJSilApxDxA4oCT4.', 'u', '2023-11-10 17:22:39', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcart`
--
ALTER TABLE `tblcart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tblexpense`
--
ALTER TABLE `tblexpense`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `tblpayment`
--
ALTER TABLE `tblpayment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tblstockadjustment`
--
ALTER TABLE `tblstockadjustment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsupplier`
--
ALTER TABLE `tblsupplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcart`
--
ALTER TABLE `tblcart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `cat_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tblexpense`
--
ALTER TABLE `tblexpense`
  MODIFY `expense_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblpayment`
--
ALTER TABLE `tblpayment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tblproduct`
--
ALTER TABLE `tblproduct`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblstockadjustment`
--
ALTER TABLE `tblstockadjustment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblsupplier`
--
ALTER TABLE `tblsupplier`
  MODIFY `supplier_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
