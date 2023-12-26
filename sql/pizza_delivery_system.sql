-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2022 at 12:12 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizza_delivery_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_reply`
--

CREATE TABLE `admin_reply` (
  `id` int(21) NOT NULL,
  `contact_id` int(21) NOT NULL,
  `customer_id` int(25) NOT NULL,
  `message` text NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `item_id` int(11) NOT NULL,
  `pizza_id` int(11) NOT NULL,
  `quantity` int(100) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `add_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_message`
--

CREATE TABLE `customer_message` (
  `contact_id` int(21) NOT NULL,
  `customer_id` int(21) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone_num` bigint(21) NOT NULL,
  `order_id` int(21) NOT NULL DEFAULT 0 COMMENT 'For non-order based comments the order id = 0',
  `message` text NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_info`
--

CREATE TABLE `delivery_info` (
  `id` int(21) NOT NULL,
  `order_id` int(21) NOT NULL,
  `deliveryMan_Name` varchar(40) NOT NULL,
  `deliveryMan_phone_num` bigint(25) NOT NULL,
  `time_mins` int(200) NOT NULL COMMENT 'Time is in minutes.',
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ordered_items`
--

CREATE TABLE `ordered_items` (
  `id` int(21) NOT NULL,
  `order_id` int(21) NOT NULL,
  `pizza_id` int(21) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(21) NOT NULL,
  `customer_id` int(21) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zip_code` int(21) NOT NULL,
  `phone_num` bigint(21) NOT NULL,
  `order_amount` int(200) NOT NULL,
  `payment_Method` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=Cash on Delivery, \r\n1=Mobile Banking ',
  `order_Status` enum('0','1','2','3','4','5','6') NOT NULL DEFAULT '0' COMMENT '0=Order Placed.\r\n1=Order Confirmed.\r\n2=Preparing your Order.\r\n3=Your order is on the way!\r\n4=Order Delivered.\r\n5=Order Denied.\r\n6=Order Cancelled.',
  `order_Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pizza_items`
--

CREATE TABLE `pizza_items` (
  `pizza_id` int(12) NOT NULL,
  `pizza_Name` varchar(255) NOT NULL,
  `pizza_Price` int(12) NOT NULL,
  `pizza_Description` text NOT NULL,
  `pizza_res_id` int(12) NOT NULL,
  `pizza_AddDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pizza_items`
--

INSERT INTO `pizza_items` (`pizza_id`, `pizza_Name`, `pizza_Price`, `pizza_Description`, `pizza_res_id`, `pizza_AddDate`) VALUES
(1, 'Margherita', 99, 'A hugely popular margherita, with a deliciously tangy single cheese topping\r\n\r\n', 1, '2021-03-17 21:03:26'),
(2, 'Double Cheese Margherita', 199, 'The ever-popular Margherita - loaded with extra cheese... oodies of it', 1, '2021-03-17 21:20:58'),
(3, 'Farm House\r\n', 149, 'A pizza that goes ballistic on veggies! Check out this mouth watering overload of crunchy, crisp capsicum, succulent mushrooms and fresh tomatoes\r\n\r\n', 1, '2021-03-17 21:22:07'),
(4, 'Peppy Paneer', 249, 'Chunky paneer with crisp capsicum and spicy red pepper - quite a mouthful!\r\n\r\n', 1, '2021-03-17 21:23:05'),
(5, 'Mexican Green Wave\r\n', 149, 'A pizza loaded with crunchy onions, crisp capsicum, juicy tomatoes and jalapeno with a liberal sprinkling of exotic Mexican herbs.\r\n\r\n', 1, '2021-03-17 21:23:48'),
(6, 'Deluxe Veggie\r\n', 319, 'For a vegetarian looking for a BIG treat that goes easy on the spices, this one\'s got it all.. The onions, the capsicum, those delectable mushrooms - with paneer and golden corn to top it all.\r\n\r\n', 1, '2021-03-17 21:24:38'),
(7, 'Veg Extravaganza\r\n', 299, 'A pizza that decidedly staggers under an overload of golden corn, exotic black olives, crunchy onions, crisp capsicum, succulent mushrooms, juicyfresh tomatoes and jalapeno - with extra cheese to go all around.\r\n\r\n', 1, '2021-03-17 21:25:42'),
(8, 'Cheese N Corn\r\n', 199, 'Cheese I Golden Corn', 1, '2021-03-17 21:26:31'),
(9, 'PANEER MAKHANI\r\n', 219, 'Paneer and Capsicum on Makhani Sauce', 1, '2021-03-17 21:27:21'),
(10, 'VEGGIE PARADISE\r\n', 299, 'Goldern Corn, Black Olives, Capsicum & Red Paprika\r\n\r\n', 1, '2021-03-17 21:28:06'),
(11, 'FRESH VEGGIE', 149, 'Onion I Capsicum', 1, '2021-03-17 21:28:49'),
(12, 'Indi Tandoori Paneer\r\n', 349, 'It is hot. It is spicy. It is oh-so-Indian. Tandoori paneer with capsicum I red paprika I mint mayo\r\n\r\n', 1, '2021-03-17 21:29:41'),
(13, 'PEPPER BARBECUE CHICKEN', 199, 'Pepper Barbecue Chicken I Cheese', 2, '2021-03-17 21:34:37'),
(14, 'CHICKEN SAUSAGE', 249, 'Chicken Sausage I Cheese', 2, '2021-03-17 21:35:31'),
(15, 'Chicken Golden Delight\r\n', 249, 'Mmm! Barbeque chicken with a topping of golden corn loaded with extra cheese. Worth its weight in gold!\r\n\r\n', 2, '2021-03-17 21:36:36'),
(16, 'Non Veg Supreme\r\n', 399, 'Bite into supreme delight of Black Olives, Onions, Grilled Mushrooms, Pepper BBQ Chicken, Peri-Peri Chicken, Grilled Chicken Rashers\r\n\r\n', 2, '2021-03-17 21:37:21'),
(17, 'Chicken Dominator', 319, 'Treat your taste buds with Double Pepper Barbecue Chicken, Peri-Peri Chicken, Chicken Tikka & Grilled Chicken Rashers', 2, '2021-03-17 21:38:13'),
(18, 'PEPPER BARBECUE & ONION\r\n', 249, 'Pepper Barbecue Chicken I Onion', 2, '2021-03-17 21:39:49'),
(19, 'CHICKEN FIESTA', 199, 'Grilled Chicken Rashers I Peri-Peri Chicken I Onion I Capsicum', 2, '2021-03-17 21:40:58'),
(20, 'Indi Chicken Tikka', 349, 'The wholesome flavour of tandoori masala with Chicken tikka I onion I red paprika I mint mayo', 2, '2021-03-17 21:41:49'),
(21, 'TOMATO', 99, 'Juicy tomato in a flavourful combination with cheese I tangy sauce', 3, '2021-03-17 21:44:44'),
(22, 'VEG LOADED', 149, 'Tomato | Grilled Mushroom |Jalapeno |Golden Corn | Beans in a fresh pan crust', 3, '2021-03-17 21:45:34'),
(23, 'CHEESY', 99, 'Orange Cheddar Cheese I Mozzarella', 3, '2021-03-17 21:46:21'),
(24, 'CAPSICUM', 99, 'Capsicum', 3, '2021-03-17 21:47:07'),
(25, 'ONION', 99, 'onion', 3, '2021-03-17 21:47:51'),
(26, 'GOLDEN CORN', 139, 'Golden Corn', 3, '2021-03-17 21:48:44'),
(27, 'PANEER & ONION', 149, 'Creamy Paneer | Onion', 3, '2021-03-17 21:49:36'),
(28, 'CHEESE N TOMATO', 149, 'A delectable combination of cheese and juicy tomato', 3, '2021-03-17 21:50:20'),
(29, 'Garlic Breadsticks', 99, 'The endearing tang of garlic in breadstics baked to perfection.', 4, '2021-03-17 22:01:33'),
(30, 'Stuffed Garlic Bread', 99, 'Freshly Baked Garlic Bread stuffed with mozzarella cheese, sweet corns & tangy and spicy jalapenos', 4, '2021-03-17 22:02:50'),
(31, 'Veg Pasta Italiano White', 99, 'Penne Pasta tossed with extra virgin olive oil, exotic herbs & a generous helping of new flavoured sauce.', 4, '2021-03-17 22:03:44'),
(32, 'Non Veg Pasta Italiano White', 99, 'Penne Pasta tossed with extra virgin olive oil, exotic herbs & a generous helping of new flavoured sauce.', 4, '2021-03-17 22:05:08'),
(33, 'Cheese Jalapeno Dip', 35, 'A soft creamy cheese dip spiced with jalapeno.', 4, '2021-03-17 22:06:06'),
(34, 'Cheese Dip', 35, 'A dreamy creamy cheese dip to add that extra tang to your snack.', 4, '2021-03-17 22:06:59'),
(35, 'Lava Cake', 99, 'Filled with delecious molten chocolate inside.', 4, '2021-03-17 22:08:13'),
(36, 'Butterscotch Mousse Cake', 149, 'A Creamy & Chocolaty indulgence with layers of rich, fluffy Butterscotch Cream and delicious Dark Chocolate Cake, topped with crunchy Dark Chocolate morsels - for a perfect dessert treat!', 4, '2021-03-17 22:08:58'),
(37, 'Lipton Ice Tea', 25, ' 250ml', 5, '2021-03-17 22:12:53'),
(38, 'Mirinda', 35, '500ml', 5, '2021-03-17 22:13:38'),
(39, 'PEPSI BLACK CAN', 45, 'PEPSI BLACK CAN', 5, '2021-03-17 22:14:24'),
(40, 'Pepsi\r\n', 52, '500ml', 5, '2021-03-17 22:16:29'),
(41, '7Up', 52, '500ml', 5, '2021-03-17 22:17:08'),
(42, 'Cheese Burst', 249, 'Crust with oodles of yummy liquid cheese filled inside.', 6, '2021-03-18 07:57:27'),
(43, 'Classic Hand Tossed', 249, 'Dominos traditional hand stretched crust, crisp on outside, soft & light inside.', 6, '2021-03-18 07:59:52'),
(44, 'Wheat Thin Crust', 299, 'Presenting the light healthier and delicious light wheat thin crust from Pizza Palace.', 6, '2021-03-18 08:00:39'),
(45, 'Fresh Pan Pizza', 299, 'Tastiest Pan Pizza. Ever.\r\nFreshly made pan-baked pizza; deliciously soft, buttery, extra cheesy and delightfully crunchy.', 6, '2021-03-18 08:01:29'),
(46, 'New Hand Tossed', 299, 'Classic Pizza Express crust. Fresh, hand stretched.', 6, '2021-03-18 08:03:17'),
(47, 'BURGER PIZZA- CLASSIC VEG', 129, 'Bite into delight! Witness the epic combination of pizza and burger with our classic Burger Pizza, that looks good and tastes great!', 7, '2021-03-18 08:09:17'),
(48, 'BURGER PIZZA- PREMIUM VEG', 139, 'The good just got better! Treat yourself to the premium taste of the Burger Pizza, that looks good and tastes great with paneer and red paprika.', 7, '2021-03-18 08:09:59'),
(49, 'BURGER PIZZA- CLASSIC NON VEG', 149, 'For all the meat cravers, try the classic non-veg Burger Pizza loaded with the goodness of burger and the greatness of pizza.', 7, '2021-03-18 08:10:37'),
(50, 'Extra Cheese', 35, 'Extra Cheese', 8, '2021-03-18 08:14:52'),
(51, 'veg toppings', 55, 'Black Olives, Crisp Capsicum, Paneer, Mushroom, Golden Corn, Fresh Tomato, Jalapeno, Red Pepper & Babycorn.', 8, '2021-03-18 08:15:36'),
(52, 'Non Veg Toppings', 55, 'Barbeque Chicken, Hot \'n\' Spicy Chicken,Chunky Chicken and Chicken Salami.', 8, '2021-03-18 08:16:29'),
(53, 'Packaged Drinking Water', 20, 'Drinking Water	', 5, '2021-03-18 08:20:40');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `res_id` int(12) NOT NULL,
  `res_Name` varchar(255) NOT NULL,
  `res_Description` text NOT NULL,
  `res_RegDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`res_id`, `res_Name`, `res_Description`, `res_RegDate`) VALUES
(1, 'Vegan\'s Pizza Shop', 'A delight for veggie lovers! Choose from our wide range of delicious vegetarian pizzas, it\'s softer and tastier', '2021-03-17 18:16:28'),
(2, 'Marco\'s Pizza', 'Choose your favorite non-veg pizzas from the Marco\'s Pizza menu. Get fresh non-veg pizza with your choice of crusts & toppings', '2021-03-17 18:17:14'),
(3, 'Slice of Italy Pizza', 'Indulge into mouth-watering taste of Pizza mania range, perfect answer to all your food cravings', '2021-03-17 18:17:43'),
(4, 'Side Orders', 'Complement your pizza with wide range of sides available at Pizza Palace Gulshan', '2021-03-17 18:19:10'),
(5, 'Beverages', 'Complement your pizza with wide range of beverages available at Pizza Palace Gulshan', '2021-03-17 21:58:58'),
(6, 'Choice of Crusts', 'Fresh Pan Pizza tastiest Pan Pizza. ... Pizza Palace freshly made pan-baked pizza; deliciously soft, buttery, extra cheesy and delightfully crunchy.', '2021-03-18 07:55:28'),
(7, 'Special Burger Pizza', 'Pizza Palace introducing all new Burger Pizza with the tag line looks like a burger, tastes like a pizza. Burger Pizza is burger sized but comes in a small pizza box. It is come with pizza toppings such as herbs, vegetables, tomato sauce and mozzarella', '2021-03-18 08:06:30'),
(8, 'Quality Toppings', 'Choose the toppings of your own liking', '2021-03-18 08:13:47');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `interim_id` int(11) NOT NULL,
  `sys_Name` varchar(21) NOT NULL,
  `email` varchar(40) NOT NULL,
  `sys_Contact01` bigint(21) NOT NULL,
  `contact2` bigint(21) DEFAULT NULL COMMENT 'Not required',
  `address` text NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`interim_id`, `sys_Name`, `email`, `sys_Contact01`, `contact2`, `address`, `date_time`) VALUES
(1, 'Pizza Palace', 'pizza.palace@gmail.com', 32110952121, 32210952122, '49 Gulshan Link Road, <br> Dhaka 1205.', '2021-03-23 19:56:25');

-- --------------------------------------------------------

--
-- Table structure for table `system_users`
--

CREATE TABLE `system_users` (
  `id` int(21) NOT NULL,
  `username` varchar(21) NOT NULL,
  `first_name` varchar(21) NOT NULL,
  `last_name` varchar(21) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` bigint(21) NOT NULL,
  `user_group` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=Customer,\r\n1=Admin',
  `password` varchar(255) NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_users`
--

INSERT INTO `system_users` (`id`, `username`, `first_name`, `last_name`, `email`, `phone`, `user_group`, `password`, `reg_date`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@gmail.com', 13456789213, '1', '$2y$10$AAfxRFOYbl7FdN17rN3fgeiPu/xQrx6MnvRGzqjVHlGqHAM4d9T1i', '2021-04-11 11:40:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_reply`
--
ALTER TABLE `admin_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `customer_message`
--
ALTER TABLE `customer_message`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `delivery_info`
--
ALTER TABLE `delivery_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`) USING BTREE;

--
-- Indexes for table `ordered_items`
--
ALTER TABLE `ordered_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `pizza_items`
--
ALTER TABLE `pizza_items`
  ADD PRIMARY KEY (`pizza_id`);
ALTER TABLE `pizza_items` ADD FULLTEXT KEY `pizza_Name` (`pizza_Name`,`pizza_Description`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`res_id`);
ALTER TABLE `restaurants` ADD FULLTEXT KEY `res_Name` (`res_Name`,`res_Description`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`interim_id`);

--
-- Indexes for table `system_users`
--
ALTER TABLE `system_users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_reply`
--
ALTER TABLE `admin_reply`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer_message`
--
ALTER TABLE `customer_message`
  MODIFY `contact_id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `delivery_info`
--
ALTER TABLE `delivery_info`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ordered_items`
--
ALTER TABLE `ordered_items`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pizza_items`
--
ALTER TABLE `pizza_items`
  MODIFY `pizza_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `res_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `interim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `system_users`
--
ALTER TABLE `system_users`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
