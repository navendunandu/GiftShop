-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2024 at 07:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_giftshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(60) NOT NULL,
  `admin_email` varchar(60) NOT NULL,
  `admin_password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(9, 'anjana', 'anjana@gmail.com', '162'),
(13, 'Adhu', 'anjanaammuzz716@gmail.com', '2334');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `booking_id` int(11) NOT NULL,
  `booking_amount` varchar(250) NOT NULL,
  `booking_status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `booking_date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`booking_id`, `booking_amount`, `booking_status`, `user_id`, `booking_date`) VALUES
(1, '1000', 2, 15, '2024-08-03'),
(7, '700', 2, 29, '2024-08-04'),
(8, '1000', 2, 15, '2024-08-05'),
(9, '2000', 2, 15, '2024-09-22'),
(10, '1050', 2, 29, '2024-08-16'),
(11, '1000', 1, 15, ''),
(12, '250', 2, 15, '2024-10-07'),
(13, '1000', 1, 15, ''),
(14, '1000', 2, 15, '2024-10-08'),
(15, '250', 2, 15, '2024-10-31'),
(16, '1000', 2, 15, '2024-11-01'),
(17, '3000', 2, 29, '2024-11-01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brand_id`, `brand_name`) VALUES
(3, 'homebakedgoods'),
(13, 'flowerknows'),
(14, 'chocolicks'),
(15, 'hamperin'),
(17, 'Crispykorns');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `cart_quantity` int(11) NOT NULL DEFAULT 1,
  `cart_status` int(11) DEFAULT 0,
  `product_id` int(11) NOT NULL,
  `deliveryagent_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `cart_quantity`, `cart_status`, `product_id`, `deliveryagent_id`, `booking_id`) VALUES
(1, 1, 3, 38, 4, 1),
(3, 1, 3, 46, 4, 2),
(4, 1, 3, 46, 4, 3),
(5, 1, 3, 38, 4, 4),
(6, 1, 3, 46, 4, 5),
(7, 1, 3, 38, 4, 6),
(8, 2, 3, 46, 4, 7),
(10, 1, 3, 38, 4, 8),
(11, 2, 3, 38, 4, 9),
(12, 3, 3, 46, 4, 10),
(13, 1, 1, 38, 0, 11),
(14, 1, 1, 39, 0, 12),
(15, 1, 1, 38, 0, 13),
(16, 1, 1, 38, 0, 14),
(18, 1, 1, 39, 0, 15),
(20, 2, 1, 44, 0, 16),
(21, 2, 2, 52, 0, 17);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`) VALUES
(14, 'Flower'),
(15, 'Cakes'),
(16, 'Hampers'),
(17, 'Chocolate kits'),
(18, 'Gifts for him'),
(19, 'Gifts for her');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaint`
--

CREATE TABLE `tbl_complaint` (
  `complaint_id` int(11) NOT NULL,
  `complaint_date` varchar(250) NOT NULL,
  `complaint_reply` varchar(500) NOT NULL,
  `complaint_status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `complaint_title` varchar(250) NOT NULL,
  `complaint_description` varchar(500) NOT NULL,
  `complaint_file` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_complaint`
--

INSERT INTO `tbl_complaint` (`complaint_id`, `complaint_date`, `complaint_reply`, `complaint_status`, `user_id`, `product_id`, `complaint_title`, `complaint_description`, `complaint_file`) VALUES
(12, '2024-07-12', 'thankyou', 1, 15, 39, 'perfume', 'very good', '1e0fc0ae03fb84a9db10fce1be6573f3.jpg'),
(13, '2024-08-04', 'sorry', 0, 15, 46, 'old flowers', 'the flowers were not very fresh', 'pexels-pixabay-56866.jpg'),
(14, '2024-11-01', 'very sorry to hear about that! We\'ll work on refunding or an exchange option.', 1, 15, 38, 'they were bad', 'blah', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_deliveryagent`
--

CREATE TABLE `tbl_deliveryagent` (
  `deliveryagent_id` int(11) NOT NULL,
  `deliveryagent_name` varchar(250) NOT NULL,
  `deliveryagent_gender` varchar(100) NOT NULL,
  `deliveryagent_email` varchar(150) NOT NULL,
  `deliveryagent_password` varchar(50) NOT NULL,
  `deliveryagent_photo` varchar(1000) NOT NULL,
  `deliveryagent_contact` varchar(100) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `deliveryagent_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_deliveryagent`
--

INSERT INTO `tbl_deliveryagent` (`deliveryagent_id`, `deliveryagent_name`, `deliveryagent_gender`, `deliveryagent_email`, `deliveryagent_password`, `deliveryagent_photo`, `deliveryagent_contact`, `seller_id`, `deliveryagent_status`) VALUES
(4, 'Basil Johny', 'Male', 'basil@gmail.com', '123', 'GSLnJ_mboAEwbsW.jpeg', '9876543200', 3, 0),
(5, 'Mohan', 'Male', 'mohan@gmail.com', 'mohan123', 'pexels-pixabay-56866.jpg', '9292484839', 2, 0),
(6, 'Adhya KS', 'Male', 'adhya1704@gmail.com', '123', '0de813bb5fbc480c3ec527a9c8880194.jpg', '127346447347', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`department_id`, `department_name`) VALUES
(3, 'BBA'),
(4, 'BCA');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_designation`
--

CREATE TABLE `tbl_designation` (
  `designation_id` int(11) NOT NULL,
  `designation_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_designation`
--

INSERT INTO `tbl_designation` (`designation_id`, `designation_name`) VALUES
(1, 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `district_name`) VALUES
(30, 'kollam'),
(31, 'kottayam'),
(32, 'thrissur'),
(33, 'ernakulam'),
(34, 'Mallapuram'),
(35, 'Pattanamthitta');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `employee_id` int(11) NOT NULL,
  `employee_name` varchar(60) NOT NULL,
  `employee_gender` varchar(60) NOT NULL,
  `employee_basicsalary` int(11) NOT NULL,
  `employee_contact` int(20) NOT NULL,
  `employee_email` varchar(11) NOT NULL,
  `employee_DOB` varchar(20) NOT NULL,
  `employee_DOJ` varchar(20) NOT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`employee_id`, `employee_name`, `employee_gender`, `employee_basicsalary`, `employee_contact`, `employee_email`, `employee_DOB`, `employee_DOJ`, `department_id`, `designation_id`) VALUES
(2, 'Anjana', 'rd_female', 500000, 2147483647, 'ikuklino@gm', '2024', '2024', 3, 1),
(3, 'Lino', 'Male', 1000000, 1234567890, 'ikuklino@gm', '2024', '2024', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gallery`
--

CREATE TABLE `tbl_gallery` (
  `gallery_id` int(11) NOT NULL,
  `gallery_image` varchar(500) NOT NULL,
  `product_id` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_gallery`
--

INSERT INTO `tbl_gallery` (`gallery_id`, `gallery_image`, `product_id`) VALUES
(1, 'dbdf844586a36294c659bf621fd832e4.jpg', ''),
(2, 'dbdf844586a36294c659bf621fd832e4.jpg', ''),
(3, 'dbdf844586a36294c659bf621fd832e4.jpg', ''),
(4, 'dbdf844586a36294c659bf621fd832e4.jpg', ''),
(5, 'dbdf844586a36294c659bf621fd832e4.jpg', ''),
(6, 'dbdf844586a36294c659bf621fd832e4.jpg', ''),
(8, 'dbdf844586a36294c659bf621fd832e4.jpg', '39'),
(9, 'dbdf844586a36294c659bf621fd832e4.jpg', '39'),
(10, 'cf4dcd1ddc03d32aef1e48441bdc2eaa.jpg', '39'),
(11, '65a13e34a5b232ab2be88c8c6304a330.jpg', '39'),
(12, 'dbdf844586a36294c659bf621fd832e4.jpg', ''),
(13, 'dbdf844586a36294c659bf621fd832e4.jpg', ''),
(14, 'dbdf844586a36294c659bf621fd832e4.jpg', ''),
(15, 'CLASSIC-CHOCOLATE-CAKE.webp', '38'),
(16, 'dbdf844586a36294c659bf621fd832e4.jpg', '38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place`
--

CREATE TABLE `tbl_place` (
  `place_id` int(11) NOT NULL,
  `place_name` varchar(60) NOT NULL,
  `place_pincode` int(60) NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_place`
--

INSERT INTO `tbl_place` (`place_id`, `place_name`, `place_pincode`, `district_id`) VALUES
(3, 'Muvattupuzha', 682366, 0),
(4, 'thiruvaniyoor', 682305, 0),
(5, 'puthenkurish', 682308, 0),
(6, '', 0, 0),
(7, 'Muvattupuzha', 682305, 0),
(8, 'Muvattupuzha', 682366, 0),
(10, 'Muvattupuzha', 682366, 0),
(14, 'Muvattupuzha', 682366, 33),
(15, 'thiruvaniyoor', 682305, 33),
(16, 'Kundara', 43434, 30),
(17, 'Mayyanad', 372465, 30),
(18, 'Erattupetta', 435272, 31),
(19, 'Ettumanoor', 564448, 31),
(21, 'Athirapilly', 455784, 32),
(32, 'Guruvayoor', 8754678, 32),
(34, 'thrissur', 123, 30);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `product_price` int(60) NOT NULL,
  `product_details` varchar(150) NOT NULL,
  `product_photo` varchar(60) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `product_price`, `product_details`, `product_photo`, `subcategory_id`, `seller_id`, `brand_id`) VALUES
(38, 'Boquete', 1000, 'edrdq', '6dd3f426534070096400f54cd7a8f731.jpg', 20, 3, 3),
(39, 'Iconic Perfume', 250, '100ML of pure perfume', '1e0fc0ae03fb84a9db10fce1be6573f3.jpg', 28, 3, 13),
(40, 'choco hamper', 550, 'very fresh', '65a13e34a5b232ab2be88c8c6304a330.jpg', 37, 3, 14),
(44, 'Gift', 500, '.', '0ebc3522594dbe511b21f60813f89609.jpg', 22, 3, 13),
(46, 'Tulips', 350, '**Tulip Bouquet**\r\n\r\nBrighten any occasion with a stunning tulip bouquet! Vibrant, elegant, and available in a rainbow of colors, tulips symbolize per', '41d4ce895e9240392eb845e713e2e2c8.jpg', 11, 2, 13),
(48, '', 0, '', '', 0, 3, 0),
(49, 'Rose Boquette', 500, 'fresh Flowers', '12548b2bc83c306f3477a0ee5ed169b4.jpg', 10, 3, 13),
(50, 'YSL perfume for Men - 100 ml', 1000, 'Yves Saint Laurent Y Eau De Parfum', '6c1a9e56b738a3a268ba9a8220b7c8e0.jpg', 28, 3, 15),
(51, 'Wallet', 250, 'wallets for men- leather', '8a2cda728680da697d56a82767990a15.jpg', 29, 5, 15),
(52, 'perfume for men', 1500, 'perfumes for men ', '0de813bb5fbc480c3ec527a9c8880194.jpg', 28, 5, 15);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `rating_id` int(11) NOT NULL,
  `rating_datetime` varchar(10) NOT NULL,
  `rating_value` int(11) NOT NULL,
  `rating_content` varchar(500) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_rating`
--

INSERT INTO `tbl_rating` (`rating_id`, `rating_datetime`, `rating_value`, `rating_content`, `product_id`, `user_id`) VALUES
(1, '2024-08-03', 3, 'very good', 44, 15),
(2, '2024-08-11', 4, 'very good', 38, 15),
(3, '2024-09-22', 4, 'The cake could have been better :)', 38, 15),
(4, '2024-11-01', 5, 'wowwwww', 39, 15);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_seller`
--

CREATE TABLE `tbl_seller` (
  `seller_id` int(11) NOT NULL,
  `seller_name` varchar(250) NOT NULL,
  `seller_email` varchar(100) NOT NULL,
  `seller_password` varchar(150) NOT NULL,
  `seller_contact` varchar(100) NOT NULL,
  `seller_proof` varchar(100) NOT NULL,
  `seller_status` int(11) NOT NULL DEFAULT 0,
  `seller_logo` varchar(500) NOT NULL,
  `place_id` int(11) NOT NULL,
  `seller_gender` varchar(50) NOT NULL,
  `district_id` int(11) NOT NULL,
  `seller_photo` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_seller`
--

INSERT INTO `tbl_seller` (`seller_id`, `seller_name`, `seller_email`, `seller_password`, `seller_contact`, `seller_proof`, `seller_status`, `seller_logo`, `place_id`, `seller_gender`, `district_id`, `seller_photo`) VALUES
(2, 'Annnnn', 'ann@gmail.com', '123', '98765432100', 'download.jpeg', 2, '412148373_6459129864188499_1908522092898971776_n.webp', 15, 'Female', 33, 'download (1).jpeg'),
(3, 'Adhya', 'adhyaks@gmail.com', '123', '7510315992', 'download (1).jpeg', 1, 'download.jpeg', 14, 'Female', 33, 'download.jpeg'),
(4, 'Nandhu', 'nandhu@gmail.com', 'nandhu123', '996162061', 'FR2M0vQVgAAAuL8.jpg', 0, 'c43c132ea0498d12aac6017b8e319c95.jpg', 19, 'Male', 31, 'cdf7b3b2508e0fbf5a413a0af8ee920f.jpg'),
(5, 'Bibin', 'bibinthankachan119@gmail.com', '123', '1234567890', '6c1a9e56b738a3a268ba9a8220b7c8e0.jpg', 2, '6c1a9e56b738a3a268ba9a8220b7c8e0.jpg', 14, 'Male', 33, 'ff13b4443a0afc87e0973e9442bdc9ab-removebg-preview.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock`
--

CREATE TABLE `tbl_stock` (
  `stock_id` int(11) NOT NULL,
  `stock_date` varchar(100) NOT NULL,
  `stock_quantity` varchar(150) NOT NULL,
  `product_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_stock`
--

INSERT INTO `tbl_stock` (`stock_id`, `stock_date`, `stock_quantity`, `product_id`) VALUES
(24, '2024-07-19', '15', 38),
(25, '2024-08-04', '15', 46),
(26, '2024-08-12', '20', 39),
(27, '2024-08-12', '20', 44),
(28, '2024-08-12', '15', 40),
(29, '2024-10-31', '20', 38),
(30, '2024-11-01', '15', 49),
(31, '2024-11-01', '5', 49),
(32, '2024-11-01', '5', 50),
(33, '2024-11-01', '10', 51),
(34, '2024-11-01', '5', 52);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategory`
--

CREATE TABLE `tbl_subcategory` (
  `subcategory_id` int(11) NOT NULL,
  `subcategory_name` varchar(60) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_subcategory`
--

INSERT INTO `tbl_subcategory` (`subcategory_id`, `subcategory_name`, `category_id`) VALUES
(1, 'obc', 12),
(2, 'general1', 13),
(3, 'obc', 12),
(4, 'obc321', 12),
(10, 'Roses', 14),
(11, 'Tulips', 14),
(12, 'Babys Breath', 14),
(13, 'Mixed bouquet', 14),
(14, 'Chocolate Cake', 15),
(15, 'Mango Cakes', 15),
(16, 'Vanilla Vibes', 15),
(17, 'Scottish Butter', 15),
(18, 'Strawberry Saga', 15),
(19, 'Oreo Cheesecakes', 15),
(20, 'Cupcakes', 15),
(22, 'Birthday Hampers', 16),
(23, 'Anniversary Hampers', 16),
(28, 'Perfumes', 18),
(29, 'Wallets', 18),
(30, 'jewellery sets', 19),
(31, 'skincare', 19),
(32, 'Skiincare', 18),
(33, 'DairyMilk set', 17),
(34, 'Kitkat set', 17),
(35, 'Kinder set', 17),
(36, 'Snickers', 17),
(37, 'Galaxy ', 17),
(38, 'Choco cake', 15);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_gender` varchar(100) NOT NULL,
  `user_contact` varchar(25) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_photo` varchar(100) NOT NULL,
  `user_proof` varchar(100) NOT NULL,
  `district_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `user_address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_gender`, `user_contact`, `user_email`, `user_password`, `user_photo`, `user_proof`, `district_id`, `place_id`, `user_address`) VALUES
(15, 'Leeknow', 'Male', '1234567890', 'ikuklino@gmail.com', '123', 'lino.jpeg.webp', 'lino.jpeg.webp', 30, 17, 'muvattupuzha'),
(29, 'Divya Ginesh', 'Female', '7510315992', 'anjanaginesh925@gmail.com', '123', '41d4ce895e9240392eb845e713e2e2c8.jpg', '41d4ce895e9240392eb845e713e2e2c8.jpg', 32, 32, 'Kollodiyil house, Kokkapilly P. O vandipetta'),
(30, 'Divya Ginesh', 'Female', '1234567890', 'lino@gmail.com', '12345', '0ebc3522594dbe511b21f60813f89609.jpg', 'dbdf844586a36294c659bf621fd832e4.jpg', 31, 18, 'Kollodiyil house, Kokkapilly P. O vandipetta');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `wishlist_date` varchar(150) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`wishlist_id`, `wishlist_date`, `product_id`, `user_id`) VALUES
(2, '', 39, 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `tbl_deliveryagent`
--
ALTER TABLE `tbl_deliveryagent`
  ADD PRIMARY KEY (`deliveryagent_id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `tbl_designation`
--
ALTER TABLE `tbl_designation`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `tbl_place`
--
ALTER TABLE `tbl_place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `tbl_seller`
--
ALTER TABLE `tbl_seller`
  ADD PRIMARY KEY (`seller_id`);

--
-- Indexes for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  ADD PRIMARY KEY (`subcategory_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD PRIMARY KEY (`wishlist_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_deliveryagent`
--
ALTER TABLE `tbl_deliveryagent`
  MODIFY `deliveryagent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_designation`
--
ALTER TABLE `tbl_designation`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_place`
--
ALTER TABLE `tbl_place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_seller`
--
ALTER TABLE `tbl_seller`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
