-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 15, 2019 at 03:28 PM
-- Server version: 5.7.21
-- PHP Version: 7.1.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `online-fashion-store`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `bill_no` int(7) NOT NULL,
  `service_id` varchar(7) NOT NULL,
  `bill_amt` float NOT NULL,
  `vatin_perc` float NOT NULL,
  `net_amt` float NOT NULL,
  `bill_date` datetime DEFAULT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `label` varchar(150) NOT NULL DEFAULT '',
  `link_url` varchar(255) NOT NULL DEFAULT '#',
  `parent_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `label`, `link_url`, `parent_id`) VALUES
(1, 'Men', '#', 0),
(2, 'Women', '#', 0),
(6, 'Dresses', '#', 2),
(8, 'T-Shirts', '#', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(7) NOT NULL,
  `passwd` varchar(20) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) DEFAULT NULL,
  `h_no` varchar(20) NOT NULL,
  `locality` varchar(20) DEFAULT NULL,
  `city` varchar(15) NOT NULL,
  `state` varchar(15) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `contact1` varchar(20) NOT NULL,
  `email_id` varchar(20) NOT NULL,
  `dor` datetime NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE `customer_order` (
  `order_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(100) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_method` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`order_id`, `cust_id`, `product_id`, `quantity`, `size`, `order_date`, `payment_method`) VALUES
(3, 2, 3, 1, 'md', '2019-09-02 15:26:20', 'paypal'),
(4, 2, 4, 1, 'lg', '2019-09-02 16:32:41', 'direct bank transfer'),
(5, 2, 2, 1, 'xl', '2019-09-02 16:33:19', 'paypal'),
(9, 1, 21, 5, 'md', '2019-09-08 11:46:46', 'direct bank transfer'),
(10, 1, 21, 1, 'sm', '2019-09-08 11:46:46', 'direct bank transfer'),
(11, 1, 16, 2, 'sm', '2019-09-08 12:10:25', 'direct bank transfer'),
(12, 1, 21, 1, 'xl', '2019-09-15 12:17:49', 'cash on delivery');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(7) NOT NULL,
  `dept_name` varchar(15) NOT NULL,
  `emp_id` varchar(7) NOT NULL,
  `designation` varchar(15) NOT NULL,
  `basic_sal` int(11) NOT NULL,
  `branch_code` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_size` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `product_id`, `product_size`, `quantity`) VALUES
(5, 2, 'sm', 100),
(6, 2, 'md', 100),
(7, 2, 'lg', 100),
(8, 2, 'xl', 100),
(9, 3, 'sm', 100),
(10, 3, 'md', 100),
(11, 3, 'lg', 100),
(12, 3, 'xl', 100),
(13, 4, 'sm', 100),
(14, 4, 'md', 100),
(15, 4, 'lg', 100),
(16, 4, 'xl', 100),
(17, 5, 'sm', 100),
(18, 5, 'md', 100),
(19, 5, 'lg', 100),
(20, 5, 'xl', 100),
(21, 8, 'sm', 100),
(22, 8, 'md', 100),
(23, 8, 'lg', 100),
(24, 8, 'xl', 100),
(25, 10, 'sm', 100),
(26, 10, 'md', 100),
(27, 10, 'lg', 100),
(28, 10, 'xl', 100),
(29, 11, 'sm', 100),
(30, 11, 'md', 100),
(31, 11, 'lg', 100),
(32, 11, 'xl', 100),
(33, 12, 'sm', 100),
(34, 12, 'md', 100),
(35, 12, 'lg', 100),
(36, 12, 'xl', 100),
(37, 13, 'sm', 100),
(38, 13, 'md', 100),
(39, 13, 'lg', 100),
(40, 13, 'xl', 100),
(41, 14, 'sm', 100),
(42, 14, 'md', 100),
(43, 14, 'lg', 100),
(44, 14, 'xl', 100),
(45, 15, 'sm', 100),
(46, 15, 'md', 100),
(47, 15, 'lg', 100),
(48, 15, 'xl', 100),
(49, 16, 'sm', 0),
(50, 16, 'md', 100),
(51, 16, 'lg', 100),
(52, 16, 'xl', 100),
(53, 21, 'sm', 100),
(54, 21, 'md', 100),
(55, 21, 'lg', 100),
(56, 21, 'xl', 99);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(20) NOT NULL,
  `passwd` varchar(20) NOT NULL,
  `emp_id` varchar(7) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Is it a Featured product?',
  `product_price` float NOT NULL,
  `product_short_desc` varchar(150) NOT NULL,
  `product_description` text NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_category_id`, `is_featured`, `product_price`, `product_short_desc`, `product_description`, `product_image`, `created`) VALUES
(2, 'Polo Shirt', 2, 1, 49.99, 'Stylish enough to turn around the heads', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'cloth_2.jpg', '2019-09-01 14:29:20'),
(3, 'Tank Top', 1, 1, 50, 'Finding perfect T-shirt', 'Finding perfect T-shirt description long', 'cloth_1.jpg', '2019-08-12 14:29:20'),
(4, 'Corater Shoes', 1, 1, 30.56, 'Finding perfect corater shoes', 'Finding perfect corater shoes long description', 'shoe_1.jpg', '2019-07-08 14:29:20'),
(5, 'Pattern T-shirt', 1, 1, 60.85, 'Attractive Pattern T-shirt ', 'Attractive Pattern T-shirt long description', 'cloth_3.jpg', '2019-09-02 14:29:20'),
(8, 'Tea Shirt', 8, 0, 120, 'Stylish T-shirt for tea lovers', 'REGULAR FIT\r\n\r\nFits just right - not too tight, not too loose.\r\n\r\nSINGLE JERSEY, 100% COTTON\r\n\r\nClassic, lightweight jersey fabric comprising 100% cotton with ribbed knit crew neck.', 'black-shirt.jpg', '2019-09-05 12:10:35'),
(10, 'Knitted Black Wrap Dress', 6, 1, 280, 'Knitted Wrap Dress', 'REGULAR FIT\r\n\r\nFits just right - not too tight, not too loose.\r\n\r\nSINGLE JERSEY, 100% COTTON\r\n\r\nClassic, lightweight jersey fabric comprising 100% cotton with ribbed knit crew neck.', 'knitted-black-dress.jpg', '2019-09-05 12:16:11'),
(11, 'Louis Performance T-shirt', 8, 0, 130, 'Louis Performance T-shirt', 'REGULAR FIT\r\n\r\nFits just right - not too tight, not too loose.\r\n\r\nSINGLE JERSEY, 100% COTTON\r\n\r\nClassic, lightweight jersey fabric comprising 100% cotton with ribbed knit crew neck.', 'louis-shirt.jpeg', '2019-09-05 12:17:53'),
(12, 'Lucy Pattern Dress', 6, 1, 130, 'Flowered Pattern Dress', 'REGULAR FIT\r\n\r\nFits just right - not too tight, not too loose.\r\n\r\nSINGLE JERSEY, 100% COTTON\r\n\r\nClassic, lightweight jersey fabric comprising 100% cotton with ribbed knit crew neck.', 'lucy-dress.jpg', '2019-09-05 12:20:37'),
(13, 'Maroon solid dress', 6, 0, 220, 'Maroon  plain solid dress', 'REGULAR FIT\r\n\r\nFits just right - not too tight, not too loose.\r\n\r\nSINGLE JERSEY, 100% COTTON\r\n\r\nClassic, lightweight jersey fabric comprising 100% cotton with ribbed knit crew neck.', 'maroon-dress.jpeg', '2019-09-05 12:26:15'),
(14, 'Grey T-shirts Set', 8, 0, 199.5, 'Grey labelled T-shirts', 'REGULAR FIT\r\n\r\nFits just right - not too tight, not too loose.\r\n\r\nSINGLE JERSEY, 100% COTTON\r\n\r\nClassic, lightweight jersey fabric comprising 100% cotton with ribbed knit crew neck.', 'men-t-shirt.jpg', '2019-09-05 12:28:11'),
(15, 'OM printed T-shirt', 8, 0, 125, 'Printed orange yellow T-shirt', 'REGULAR FIT\r\n\r\nFits just right - not too tight, not too loose.\r\n\r\nSINGLE JERSEY, 100% COTTON\r\n\r\nClassic, lightweight jersey fabric comprising 100% cotton with ribbed knit crew neck.', 'om-shirt.jpg', '2019-09-05 12:29:43'),
(16, 'Simpsons Printed T-shirt', 8, 0, 120, 'Grey Printed T-shirt', 'REGULAR FIT\r\n\r\nFits just right - not too tight, not too loose.\r\n\r\nSINGLE JERSEY, 100% COTTON\r\n\r\nClassic, lightweight jersey fabric comprising 100% cotton with ribbed knit crew neck.', 'sabrina-shirt.jpg', '2019-09-05 12:32:10'),
(21, 'Deadpool Unicorn T-shirt', 8, 1, 160, 'Marvel Deadpool T-shirt', 'REGULAR FIT\r\n\r\nFits just right - not too tight, not too loose.\r\n\r\nSINGLE JERSEY, 100% COTTON\r\n\r\nClassic, lightweight jersey fabric comprising 100% cotton with ribbed knit crew neck.', 'deadpool-shirt.png', '2019-09-07 14:28:10');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(7) NOT NULL,
  `pur_date` datetime NOT NULL,
  `product_id` varchar(7) NOT NULL,
  `rateper_piece` float NOT NULL,
  `discount` float NOT NULL,
  `quantity` float NOT NULL,
  `net_cost` float NOT NULL,
  `supplier_id` varchar(7) NOT NULL,
  `branch_code` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` int(7) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rateper_piece` float NOT NULL,
  `discount_in_perc` float NOT NULL,
  `net_rate` float NOT NULL,
  `cust_id` int(11) NOT NULL,
  `dos` datetime NOT NULL,
  `soldby` varchar(7) NOT NULL,
  `branch_code` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'user' COMMENT 'role of user',
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(150) NOT NULL,
  `company` varchar(250) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `address` text NOT NULL,
  `country` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `role`, `user_name`, `email`, `password`, `name`, `company`, `phone`, `address`, `country`) VALUES
(1, 'admin', 'anand', 'anand123@gmail.com', '1234', 'Anand Kashyap', 'ABC', '9871233211', 'B-23, janakpuri', 'india'),
(2, 'user', 'filip', 'filip@outlook.com', 'filip234', 'Filip Skalka', 'DEF', '5765432113', '16192 Coastal Highway\r\nLewes 19958\r\nDelaware, USA', 'usa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_no`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `cust_id` (`cust_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `bill_no` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sale_id` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD CONSTRAINT `customer id` FOREIGN KEY (`cust_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `product id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
