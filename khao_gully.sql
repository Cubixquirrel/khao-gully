-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2020 at 10:31 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `khao_gully`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(100) NOT NULL,
  `admin_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_id`, `admin_name`) VALUES
(1, '9503111603', 'Khao Gully');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users_login`
--

CREATE TABLE `admin_users_login` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `user_auth` varchar(100) NOT NULL,
  `user_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_users_login`
--

INSERT INTO `admin_users_login` (`id`, `user_id`, `user_auth`, `user_status`) VALUES
(1, '1', 'a48w59kde11e90iwapxki76d3rpw3t4sbucvcqa6iokmrt5rjm1hphsipaqmkd2ixevqo67x6sd6cteb', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `usersBanner1` varchar(300) NOT NULL,
  `usersBanner2` varchar(300) NOT NULL,
  `usersBanner3` varchar(300) NOT NULL,
  `usersBanner4` varchar(300) NOT NULL,
  `usersBanner5` varchar(300) NOT NULL,
  `usersBanner6` varchar(300) NOT NULL,
  `restaurantBanner1` varchar(300) NOT NULL,
  `restaurantBanner2` varchar(300) NOT NULL,
  `restaurantBanner3` varchar(300) NOT NULL,
  `restaurantBanner4` varchar(300) NOT NULL,
  `restaurantBanner5` varchar(300) NOT NULL,
  `restaurantBanner6` varchar(300) NOT NULL,
  `driversBanner1` varchar(300) NOT NULL,
  `driversBanner2` varchar(300) NOT NULL,
  `driversBanner3` varchar(300) NOT NULL,
  `driversBanner4` varchar(300) NOT NULL,
  `driversBanner5` varchar(300) NOT NULL,
  `driversBanner6` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `usersBanner1`, `usersBanner2`, `usersBanner3`, `usersBanner4`, `usersBanner5`, `usersBanner6`, `restaurantBanner1`, `restaurantBanner2`, `restaurantBanner3`, `restaurantBanner4`, `restaurantBanner5`, `restaurantBanner6`, `driversBanner1`, `driversBanner2`, `driversBanner3`, `driversBanner4`, `driversBanner5`, `driversBanner6`) VALUES
(1, '4188828_chicken.jpg', '4188828_chicken.jpg', '4188828_chicken.jpg', '4188828_chicken.jpg', '4188828_chicken.jpg', '4188828_chicken.jpg', '4188828_chicken.jpg', '4188828_chicken.jpg', '4188828_chicken.jpg', '4188828_chicken.jpg', '4188828_chicken.jpg', '4188828_chicken.jpg', '4188828_chicken.jpg', '4188828_chicken.jpg', '4188828_chicken.jpg', '4188828_chicken.jpg', '4188828_chicken.jpg', '4188828_chicken.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `restaurant_id` varchar(200) NOT NULL,
  `category_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(6) NOT NULL,
  `coupon_description` varchar(30) NOT NULL,
  `coupon_type` varchar(100) NOT NULL,
  `coupon_value` varchar(100) NOT NULL,
  `min_value` varchar(100) NOT NULL,
  `coupon_expiry` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `coupon_code`, `coupon_description`, `coupon_type`, `coupon_value`, `min_value`, `coupon_expiry`) VALUES
(1, 'NEWW50', 'Get Rs. 50 Off On All Order', 'Fixed', '50', '100', 'false'),
(2, 'HOT100', 'Get Rs. 100 Off On All Order', 'Fixed', '100', '200', 'true'),
(3, 'KHAO50', 'Get 50% Off On All Order', 'Percentage', '50', '100', 'true'),
(4, 'BITE30', 'Get 30% Off On All Order', 'Fixed', '30', '50', 'false'),
(5, 'WINTER', 'Flat 50 Rs Off On All Products', 'Fixed', '50', '200', 'false'),
(6, 'SUMMER', 'Flat 10% On All Products', 'Percentage', '10', '100', 'false'),
(8, 'OFF10%', 'GOOD FOOD GOOD LIFE', 'Percentage', '10', '140', 'false'),
(9, 'OFF100', 'Get Flat 100 /- Rs Off On Abov', 'Fixed', '100', '500', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `driver_id` varchar(100) NOT NULL,
  `driver_lat` varchar(200) NOT NULL,
  `driver_lng` varchar(200) NOT NULL,
  `driver_status` varchar(100) NOT NULL,
  `driver_login_status` varchar(100) NOT NULL,
  `driver_delivery_status` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `rating` varchar(100) NOT NULL,
  `total_delivery` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `pincode` varchar(100) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `aadhaar_card` varchar(1000) NOT NULL,
  `cheque_passbook` varchar(1000) NOT NULL,
  `driver_photo` varchar(1000) NOT NULL,
  `driving_licence` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `driver_users_login`
--

CREATE TABLE `driver_users_login` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `user_auth` varchar(100) NOT NULL,
  `user_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `user_feedback` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `food_status` varchar(100) NOT NULL,
  `restaurant_id` varchar(200) NOT NULL,
  `category_id` varchar(200) NOT NULL,
  `food_name` varchar(200) NOT NULL,
  `tmp_price` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `veg_non_veg` varchar(200) NOT NULL,
  `stock` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `help_message`
--

CREATE TABLE `help_message` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `user_help_message` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `notification_name` varchar(100) NOT NULL,
  `notification_description` varchar(100) NOT NULL,
  `notification_created_on` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_id`
--

CREATE TABLE `order_id` (
  `id` int(11) NOT NULL,
  `restaurant_id` varchar(100) NOT NULL,
  `driver_id` varchar(100) NOT NULL,
  `food_id` varchar(1000) NOT NULL,
  `food_name` varchar(1000) NOT NULL,
  `food_quantity` varchar(1000) NOT NULL,
  `food_price` varchar(100) NOT NULL,
  `item_total` varchar(100) NOT NULL,
  `taxes_charges` varchar(100) NOT NULL,
  `delivery_charges` varchar(100) NOT NULL,
  `safety_packaging` varchar(100) NOT NULL,
  `rider_tip` varchar(100) NOT NULL,
  `coupon_code_name` varchar(100) NOT NULL,
  `coupon_code_value` varchar(100) NOT NULL,
  `grand_total` varchar(100) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `user_location` varchar(200) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_mobile` varchar(100) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `order_status` varchar(100) NOT NULL,
  `order_created_on` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `id` int(11) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `otp` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `restaurant_id` varchar(100) NOT NULL,
  `restaurant_lat` varchar(200) NOT NULL,
  `restaurant_lng` varchar(200) NOT NULL,
  `restaurant_status` varchar(100) NOT NULL,
  `restaurant_login_status` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `margin` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `rating` varchar(100) NOT NULL,
  `total_delivery` varchar(100) NOT NULL,
  `main_tag` varchar(100) NOT NULL,
  `average_pricing` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `cuisines` varchar(1000) NOT NULL,
  `pincode` varchar(100) NOT NULL,
  `contact_persons_name` varchar(100) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `sun_timing` varchar(100) NOT NULL,
  `mon_timing` varchar(100) NOT NULL,
  `tue_timing` varchar(100) NOT NULL,
  `wed_timing` varchar(100) NOT NULL,
  `thu_timing` varchar(100) NOT NULL,
  `fri_timing` varchar(100) NOT NULL,
  `sat_timing` varchar(100) NOT NULL,
  `aadhaar_card` varchar(1000) NOT NULL,
  `cheque_passbook` varchar(1000) NOT NULL,
  `owner_photo` varchar(1000) NOT NULL,
  `fssai_licence` varchar(1000) NOT NULL,
  `gst_number` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rest_users_login`
--

CREATE TABLE `rest_users_login` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `user_auth` varchar(100) NOT NULL,
  `user_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_mobile` varchar(200) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_location` varchar(200) NOT NULL,
  `user_latlng` varchar(200) NOT NULL,
  `date_of_birth` varchar(200) NOT NULL,
  `wallet_cash` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users_login`
--

CREATE TABLE `users_login` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `user_auth` varchar(100) NOT NULL,
  `user_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users_login`
--
ALTER TABLE `admin_users_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver_users_login`
--
ALTER TABLE `driver_users_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `help_message`
--
ALTER TABLE `help_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_id`
--
ALTER TABLE `order_id`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rest_users_login`
--
ALTER TABLE `rest_users_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_login`
--
ALTER TABLE `users_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_users_login`
--
ALTER TABLE `admin_users_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `driver_users_login`
--
ALTER TABLE `driver_users_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `help_message`
--
ALTER TABLE `help_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_id`
--
ALTER TABLE `order_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rest_users_login`
--
ALTER TABLE `rest_users_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_login`
--
ALTER TABLE `users_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
