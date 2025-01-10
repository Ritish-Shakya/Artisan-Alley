-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 06, 2024 at 02:57 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_425`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_tbl`
--

CREATE TABLE `cart_tbl` (
  `cart_id` int NOT NULL,
  `product_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `qty` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_tbl`
--

INSERT INTO `cart_tbl` (`cart_id`, `product_id`, `user_id`, `qty`) VALUES
(44, 23, 1, 1),
(46, 23, 7, 1),
(47, 21, 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `customer_id` int NOT NULL,
  `customer_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`customer_id`, `customer_name`, `address`, `contact_no`, `username`, `password`, `email`) VALUES
(1, 'Alisha Manandhar', 'Kamalbinayak', '9861770872', 'alisha65', '$2y$10$vCnmuCQ.I8fW59gVF/So8eQcmvSNIC2jn47miouKfr4gfKTEwQOMe', 'mdhr@gmail.com'),
(2, 'Swexa Chhetri', 'Bhairahawa', '9869028576', 'cswexa', '$2y$10$hryjHAnKNirNYW2vJxaNfe5dU5u93xhSZ2hESQpi0NsOtWnNpt0MC', 'cswek@gmail.com'),
(3, 'Nischal Shakya', 'Kumaripati', '9840151590', 'nischal1', '$2y$10$tgZ80UN2PmKwVYTVy/0g2uKN60xXXQ8K3CHbakKimkMt2MhoIveHO', 'shakya@gmail.com'),
(4, 'Manisha Shrestha', 'Kalanki', '9841211651', 'manisha', '$2y$10$ALtP0VTpnHFhUYZaIebyK.3J81/M.0DC4jdU8EAMItBnPdo7pYh42', 'shrestha@gmail.com'),
(7, 'Urusha Mdhr', 'Satdobato', '9861781324', 'mdhrurusha', '$2y$10$ep/QQwn0NjqhVVWMdG81.egjXis9pEzLceh5K7c0vCMODmHC3pnPO', 'uru@gmail.com'),
(9, 'Shraddha Chhetri', 'Nagarjun', '9873847283', 'shraddha', '$2y$10$NH9fWYjKZXNNkHcKg.6FFezcUrtPbg0Ppm4wyPGxqj/XQMiIANlHq', 'shrd@gmail.com'),
(10, 'Suzal Mdhr', 'Bkt', '9854635746', 'sujal', '$2y$10$O1yMMNjPOM0N1QxZBziouuoitlCjGUGI0imuPNeaPAKKidVRQwuCK', 'suja;@gmail.com'),
(11, 'Ab', 'bsb', '9538753692', 'abcd', '$2y$10$8y7PP./PR8a/laCN7uCe3OOqrSQkMT8exaVMtTl17GiKNgfCiZUta', 'abcd@gmail.com'),
(12, 'Urmila Manandhar', 'Bkt', '9869028575', 'urmila', '$2y$10$gWfQzAPwQpI9u413/HRlluFb05.gFsyWK1XhK2GVjoEJXgrO34frW', 'urmi@gmail.com'),
(13, 'Ram Sundar', 'Pulchowk Lalitpur', '9841085500', 'ramsundar', '$2y$10$zSCzKApRzy7A5GJrsJugYuzjQFL5xeHQNnWHC2KZ47XMGQ2mTSBV6', 'ram@gmail.com'),
(16, 'Sahil Awal', 'Banepa', '9881382883', 'sahil', '$2y$10$5AkF2jqDn.wQ14XcDv7c5u5Xmnbr.zEY3wG3zBke3tFxMGjhzAcja', 'sahil@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `product_id` int NOT NULL,
  `qty` int NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordered_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `customer_id`, `product_id`, `qty`, `payment_status`, `order_status`, `ordered_date`) VALUES
(1, 1, 5, 2, 'esewa', 'Completed', '2024-07-20'),
(3, 1, 7, 2, 'cash', 'in_delivery', '2024-07-25'),
(5, 1, 8, 1, 'esewa', 'in_delivery', '2024-07-27'),
(8, 2, 8, 1, 'cash', 'in_delivery', '2024-07-20'),
(10, 4, 15, 1, 'esewa', 'Completed', '2024-08-02'),
(11, 4, 20, 1, 'esewa', 'cancelled', '2024-08-04'),
(14, 3, 14, 1, 'cash', 'in_delivery', '2024-08-06'),
(15, 3, 16, 1, 'esewa', 'in_delivery', '2024-08-10'),
(18, 7, 21, 1, 'cash', 'Completed', '2024-08-12'),
(19, 1, 7, 1, 'esewa', 'Pending', '2024-08-14'),
(20, 1, 14, 1, 'esewa', 'Pending', '2024-08-20'),
(21, 1, 8, 1, 'esewa', 'Completed', '2024-08-27'),
(22, 1, 5, 1, 'esewa', 'in_delivery', '2024-09-05'),
(23, 1, 23, 1, 'esewa', 'cancelled', '2024-09-10'),
(24, 1, 14, 1, 'esewa', 'Pending', '2024-09-15'),
(25, 9, 22, 1, 'esewa', 'Pending', '2024-09-17'),
(26, 10, 7, 1, 'esewa', 'Pending', '2024-09-18'),
(27, 10, 20, 1, 'esewa', 'Pending', '2024-09-20'),
(28, 12, 25, 1, 'esewa', 'Pending', '2024-09-22'),
(29, 12, 21, 3, 'esewa', 'Pending', '2024-09-23'),
(31, 16, 5, 1, 'esewa', 'Pending', '2024-10-27'),
(33, 16, 7, 1, 'esewa', 'Pending', '2024-10-30'),
(34, 16, 20, 1, 'esewa', 'Pending', '2024-10-30');

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `product_id` int NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` double NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_qty` int DEFAULT NULL,
  `product_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`product_id`, `product_name`, `product_price`, `product_image`, `product_qty`, `product_desc`, `category`) VALUES
(5, 'Rimmel Red Lipstick', 400, 'lipstick2.jpg', 5, 'High colour impact for up to 8 hours wear. Colour that turns long-lasting colour up to 8 hours +25% colour impact •', 'cosmetic'),
(6, 'Discoloration Serum', 1200, 'faceserum.webp', 8, 'Improve the appearance of skin discoloration and uneven skin tone with Discoloration Correcting Serum.', 'skinCare'),
(7, 'UV Coz Sunscreen', 840, 'suns.jpg', 5, 'A photostable formula with broad spectrum filtering system, along with other powerful filters, protects the skin from UVA and UVB rays. ', 'skinCare'),
(8, 'Rimmel Pencil Liner', 800, 'rimmel pencil.webp', 8, 'immel London Lasting Finish 8Hr Lip Liner gives long lasting definition to elevate your pout! The long-wearing formula of this liner ensures that it will stay in place flawlessly for up to 8 hours. ', 'cosmetic'),
(14, 'Ordinary Serum', 2200, 'ordinary serum.jpeg', 8, 'vacs JSDV ', 'skinCare'),
(15, 'Loreal Foundation', 1600, 'foundation.jpg', 10, 'A long lasting foundation with our most lightweight, breathable texture for up to 24 hours of fresh staying power. ', 'cosmetic'),
(16, 'Cetaphil Cleanser', 700, 'cetaphil cleanser.jpg', 5, 'The gentle formula of Cetaphil Gentle Skin Cleanser helps to cleanse the skin without stripping it of its natural oils or causing irritation.', 'skinCare'),
(20, 'CeraVe Hydrating', 2200, 'cerave hydrating.jpg', 8, 'Hydrating Facial Cleanser gently cleanses the skin.', 'skinCare'),
(21, 'Cetaphil', 900, 'cetaphil mois.jpg', 4, 'Cetaphil moisturizer for dry and oily skin...', 'skinCare'),
(22, 'Mac Pallete', 1205, 'mac pallete.jpg', 5, 'Unleash your inner artist with MAC eye shadow palettes, featuring colour-coordinated and on-trend eye shades. ', 'cosmetic'),
(23, 'Acmist ', 636, 'Acmist.jpg', 1, 'acmist moisturizer for all types of skin', 'cosmetic'),
(25, 'Mascara', 1200, 'mascara.jpg', 7, 'lasts for 24 Hours.', 'cosmetic');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `username`, `password`, `email_id`) VALUES
(1, 'admin', '$2y$10$QGm9CGZwzwedity4yJWIX.LHKKOwZ.IvOaZW6/g8O1u5O337t3mRC', 'admin@gmail.com'),
(2, 'admin2', '$2y$10$RaLV1RzjJS9QK4QswecIpuemgH31JVYJiCdbpq9FWCiHkRhvwzSES', 'admin2@gmail.com'),
(3, 'admin2', '$2y$10$uVYRhoootpTqFx8kfr00j./7M/s4CkCA31HKnbPJoVYBv2lPi8BRu', 'admin2@gmail.com'),
(4, 'admin3', '$2y$10$CqSNv5YimK5ILT1wrsGJsujSgiYUA9wMAyCd101dlP2ZrrSvavmg6', 'admin3@gmai.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_tbl`
--
ALTER TABLE `cart_tbl`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_tbl`
--
ALTER TABLE `cart_tbl`
  MODIFY `cart_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `customer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
