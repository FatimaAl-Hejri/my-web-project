-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29 يناير 2026 الساعة 14:29
-- إصدار الخادم: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `velvet_sweets`
--

-- --------------------------------------------------------

--
-- بنية الجدول `carts`
--

CREATE TABLE `carts` (
  `cart_ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `carts`
--

INSERT INTO `carts` (`cart_ID`, `user_id`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- بنية الجدول `cart_detail`
--

CREATE TABLE `cart_detail` (
  `cart_detail_ID` int(11) NOT NULL,
  `cart_ID` int(11) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `product_image` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `cart_detail`
--

INSERT INTO `cart_detail` (`cart_detail_ID`, `cart_ID`, `product_name`, `product_image`, `quantity`) VALUES
(1, 1, 'كيك اكواب شوكولاته', '', 1),
(2, 2, 'باقاه شوكولاته متوسطه', '', 1);

-- --------------------------------------------------------

--
-- بنية الجدول `categorys`
--

CREATE TABLE `categorys` (
  `category_ID` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL,
  `category_image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `categorys`
--

INSERT INTO `categorys` (`category_ID`, `category_name`, `category_image`) VALUES
(1, 'كيك اكواب', 'nav11.jpeg'),
(2, 'باقات فراوله', 'nav30.jpeg'),
(3, 'باقات شوكولاته', 'nav18.jpeg'),
(4, 'كيك فراوله', 'nav24.jpeg'),
(5, 'بوكسات فراوله', 'nav22.jpeg');

-- --------------------------------------------------------

--
-- بنية الجدول `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `contact_msg` text NOT NULL,
  `imag` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `created_at`, `contact_msg`, `imag`) VALUES
(1, 'yumna', 'yumna17aiman@gmail.com', 'الطعم لذيييذ', '2026-01-21 08:03:05', 'جديد', ''),
(2, 'asma', 'asma@gmail.com', 'good', '2026-01-21 08:03:30', 'جديد', '');

-- --------------------------------------------------------

--
-- بنية الجدول `orders`
--

CREATE TABLE `orders` (
  `order_ID` int(11) NOT NULL,
  `order_number` varchar(20) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `total` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `orders`
--

INSERT INTO `orders` (`order_ID`, `order_number`, `user_ID`, `order_date`, `total`, `phone`, `status`) VALUES
(1, 'ORD001', 1, '2026-01-01', 7000, '', ''),
(2, 'ORD002', 2, '2025-12-10', 15000, '', ''),
(3, 'ORD-9005', 0, '2026-01-17', 15500, '05xxxxxxx', 'قيد الانتظ'),
(4, 'ORD-9170', 0, '2026-01-17', 15500, '05xxxxxxx', 'قيد الانتظ'),
(5, 'ORD-5064', 0, '2026-01-17', 15500, '05xxxxxxx', 'قيد الانتظ'),
(6, 'ORD-7801', 0, '2026-01-17', 15500, '05xxxxxxx', 'قيد الانتظ'),
(7, 'ORD-9290', 0, '2026-01-17', 15500, '05xxxxxxx', 'قيد الانتظ'),
(8, 'ORD-1045', 0, '2026-01-17', 15500, '05xxxxxxx', 'قيد الانتظ'),
(9, 'ORD-9619', 0, '2026-01-17', 15500, '05xxxxxxx', 'قيد الانتظ'),
(10, 'ORD-5103', 0, '2026-01-17', 15500, '05xxxxxxx', 'قيد الانتظ'),
(11, 'ORD-8682', 0, '2026-01-17', 15500, '05xxxxxxx', 'قيد الانتظ'),
(12, 'ORD-4071', 0, '2026-01-17', 15500, '05xxxxxxx', 'مكتمل'),
(13, 'ORD-2523', 0, '2026-01-18', 19000, '05xxxxxxx', 'قيد الانتظ'),
(14, 'ORD-5767', 0, '2026-01-18', 17500, '05xxxxxxx', 'قيد الانتظ'),
(15, 'ORD-3666', 0, '2026-01-20', 3500, '05xxxxxxx', 'قيد الانتظ'),
(16, 'ORD-7913', 0, '2026-01-20', 3500, '05xxxxxxx', 'مكتمل'),
(17, 'ORD-2948', 0, '2026-01-20', 35500, '05xxxxxxx', 'مكتمل'),
(18, 'ORD-4146', 0, '2026-01-21', 43500, '05xxxxxxx', 'قيد الانتظ'),
(19, 'ORD-9191', 0, '2026-01-21', 41000, '05xxxxxxx', 'قيد الانتظ'),
(20, 'ORD-7971', 0, '2026-01-21', 41000, '05xxxxxxx', 'قيد الانتظ'),
(21, 'ORD-3692', 0, '2026-01-21', 41000, '05xxxxxxx', 'قيد الانتظ'),
(22, 'ORD-8637', 0, '2026-01-21', 31000, '05xxxxxxx', 'قيد الانتظ'),
(23, 'ORD-8232', 0, '2026-01-21', 31000, '05xxxxxxx', 'قيد الانتظ'),
(24, 'ORD-7747', 0, '2026-01-21', 4500, '05xxxxxxx', 'قيد الانتظ'),
(25, 'ORD-8837', 0, '2026-01-21', 19500, '05xxxxxxx', 'قيد الانتظ'),
(26, 'ORD-1468', 0, '2026-01-21', 10000, '05xxxxxxx', 'قيد الانتظ'),
(27, 'ORD-3615', 0, '2026-01-21', 3500, '05xxxxxxx', 'قيد الانتظ');

-- --------------------------------------------------------

--
-- بنية الجدول `order_detail`
--

CREATE TABLE `order_detail` (
  `detail_ID` int(11) NOT NULL,
  `order_ID` int(11) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `product_image` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `order_detail`
--

INSERT INTO `order_detail` (`detail_ID`, `order_ID`, `product_name`, `product_image`, `quantity`, `unit_price`, `total_price`) VALUES
(1, 23, 'باقه فراوله', '', 1, 8000, 8000),
(2, 23, 'بوكس فراوله', '', 1, 5000, 5000),
(3, 23, 'كيك فراوله', '', 1, 9500, 9500),
(4, 23, 'Red Velvet Cake', '', 1, 3500, 3500),
(5, 23, 'Chocolate Bouquet', '', 1, 5000, 5000),
(6, 24, 'Strawberry Bouquet', '', 1, 4500, 4500),
(7, 25, 'كيك فراوله', '', 1, 9500, 9500),
(8, 25, 'بوكس فراوله', '', 1, 10000, 10000),
(9, 26, 'بوكس فراوله', '', 1, 10000, 10000),
(10, 27, 'Caramel Cake', '', 1, 3500, 3500);

-- --------------------------------------------------------

--
-- بنية الجدول `products`
--

CREATE TABLE `products` (
  `product_ID` int(11) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `product_image` varchar(200) NOT NULL,
  `category_ID` int(11) NOT NULL,
  `category` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `products`
--

INSERT INTO `products` (`product_ID`, `product_name`, `description`, `price`, `product_image`, `category_ID`, `category`) VALUES
(5, 'بوكس فراوله', 'بوكس فراوله مغطاه شوكولاته بشكل كلمه LOVE ', 10000, 'nav39.jpeg', 5, ''),
(14, 'كيك فراوله', 'قالب فراوله طبقات مع ثيم happy birthday ', 9500, 'nav1.jpeg', 4, ''),
(15, 'Red Velvet Cake', 'كوؤس السعاده.. طبقات غنيه بالكريمه المخمليه و الريد فلفت كيك الهش و نضمن المذاق الذيذ ', 3500, 'nav5.jpeg', 1, ''),
(16, 'chocolate cake', 'كوؤس السعاده.. طبقات الشوكولاته اللذيذه و الكيك المخملي ', 3500, 'nav13.jpeg', 1, ''),
(17, 'Trend Dudai', 'ترند دبي اللذيذ ب طبقات كيك الشوكولاته الشهي وزبده الفستق و الكنافه', 4000, 'nav9.jpeg', 1, ''),
(18, 'Strawberry Cake', 'كيك طبقات كريمه و كيك فانيلا لذيذ و قطع فراوله طازجه', 3500, 'nav12.jpeg', 1, ''),
(19, 'Lotus Cake', 'كيك فانيلا طري و زبده اللوتس الشهيه و الكريمه', 3500, 'nav15.jpeg', 1, ''),
(20, 'Blueberry Cake', 'طبقات كيك االفانيلا الطري و الكريمه و صوص التوت اللذيذ\r\n', 3500, 'nav4.jpeg', 1, ''),
(21, 'Caramel Cake', 'صوص كاراميل لذيذ و كيك فانيلا شهي ', 3500, 'nav6.jpeg', 1, ''),
(22, 'Kinder Cake', 'كيك شوكولاته شهي مع صوص الكيندر الشهي', 4000, 'nav17.jpeg', 1, ''),
(23, 'Chocolate Bouquet', 'قطع شوكولاته بشكل ورد محشيه بنكهات لذيذه', 7000, 'nav21.jpeg', 3, ''),
(24, 'Chocolate Bouquet', 'قطع شوكولاته بشكل ورد محشيه بنكهات لذيذه و لون وردي و ابيض', 7000, 'nav18.jpeg', 3, ''),
(25, 'Chocolate Bouquet', 'قطع شوكولاته بشكل ورد محشيه بنكهات لذيذه \r\nداخل بوكس ', 5000, 'nav2.jpeg', 3, ''),
(26, 'Chocolate Bouquet', 'قطع شوكولاته بالحليب بشكل ورد محشيه بنكهات لذيذه ', 6500, 'nav19.jpeg', 3, ''),
(27, 'Chocolate Bouquet', 'قطع شوكولاته بشكل ورد محشيه بنكهات لذيذه في بوكس و بالوان فخمه', 5000, 'nav28.jpeg', 3, ''),
(28, 'LOVE Box', 'بوكس فراوله يقدم ك هديه بشكل L????V و لون زهري', 8000, 'nav36.jpeg', 5, ''),
(29, 'Strawberry Bouquet', 'باقه فراوله صغيره باللون الوردي', 4500, 'nav41.jpeg', 2, '');

-- --------------------------------------------------------

--
-- بنية الجدول `reviews`
--

CREATE TABLE `reviews` (
  `review_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `product_ID` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `reviews`
--

INSERT INTO `reviews` (`review_ID`, `user_ID`, `product_ID`, `rating`, `comment`) VALUES
(1, 1, 1, 5, 'great taste and beautiful shape'),
(2, 2, 7, 4, 'تصميم فخم و مميز');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `user_ID` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`user_ID`, `name`, `email`, `phone`) VALUES
(1, 'yumna aiman', 'yumna@gmail.com', 786098365),
(2, 'ahmed shaher', 'ahmed@gmaai.com', 776079375);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_ID`);

--
-- Indexes for table `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD PRIMARY KEY (`cart_detail_ID`);

--
-- Indexes for table `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`category_ID`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_ID`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`detail_ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_ID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categorys`
--
ALTER TABLE `categorys`
  MODIFY `category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `detail_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
