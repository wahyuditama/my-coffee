-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2025 at 06:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mycoffee`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(12) NOT NULL,
  `username` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `suggestion` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_At` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `username`, `title`, `suggestion`, `foto`, `create_at`, `update_At`) VALUES
(1, 'wahyuramdany', '', 'Minuman kopi pekat dengan rasa kuat yang dibuat dari ekstraksi biji kopi halus menggunakan tekanan tinggi.', 'testimonials-4.jpg', '2025-01-12 17:28:34', '2025-01-23 06:12:57'),
(3, 'Doni Iryawan', '', 'Lorem Ipsum Dolor Site Amet Amor Rite arganto heriat, karyweint yoronis amnous aphoreus\r\n', 'testimonials-1.jpg', '2025-01-12 17:42:51', '2025-01-23 13:43:25'),
(4, 'Yohana Rahmadi', '', 'Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.', 'testimonials-3.jpg', '2025-01-23 13:43:16', '2025-01-23 13:43:44'),
(5, 'Ronald Eryawan', '', 'Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.', 'testimonials-5.jpg', '2025-01-23 13:44:13', '2025-01-23 13:44:13'),
(6, 'Yulia HedroJoyokusumo', '', 'Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.', 'testimonials-2.jpg', '2025-01-23 13:45:01', '2025-01-23 13:45:01');

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE `accessories` (
  `id` int(12) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(100) NOT NULL,
  `images` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accessories`
--

INSERT INTO `accessories` (`id`, `title`, `description`, `price`, `images`, `create_at`, `update_at`) VALUES
(1, 'sed consectetur. lorem', 'Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.', 15000, 'apple-touch-icon.png', '2025-01-27 05:09:34', '2025-01-27 06:06:32');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(12) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `stock` int(12) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `product_name`, `description`, `price`, `image`, `stock`, `created_at`, `update_at`) VALUES
(6, 'Coffee Espresso', 'To inspire and nurture the human spirit\"                                                            ', 0.00, 'testimonials-5.jpg', 0, '2025-01-23 12:34:57', '2025-01-23 12:57:44'),
(7, 'Starbucks', 'Lorem Ipsum Dolor Site amet aphoreous reguorio harpous                                              ', 0.00, '', 0, '2025-01-23 12:46:36', '2025-01-23 12:50:38'),
(8, 'Lavazza (Italia)', 'Qualità, passione e innovazione\" (Kualitas, passion, dan inovasi)                                   ', 0.00, '', 0, '2025-01-23 13:06:35', '2025-01-23 13:06:35'),
(9, 'Nespresso', 'Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas ', 0.00, '', 0, '2025-01-23 13:09:44', '2025-01-23 13:18:32'),
(10, 'Dunkin  Donuts', ' Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augu', 0.00, '', 0, '2025-01-23 13:23:22', '2025-01-23 13:23:22'),
(11, 'Costa Coffee (Inggris', 'Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl c', 0.00, '', 0, '2025-01-23 13:24:13', '2025-01-23 13:24:13'),
(12, 'Peets Coffee', '  Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egesta', 0.00, '', 0, '2025-01-23 13:28:09', '2025-01-23 13:28:09'),
(13, 'Caribou Coffee', 'Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.', 0.00, '', 0, '2025-01-23 13:29:56', '2025-01-23 13:29:56'),
(14, 'Tim Hortons (Kanada)', '  Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.                                             ', 0.00, '', 0, '2025-01-23 13:31:05', '2025-01-23 13:31:05'),
(15, 'Intelligentsia Coffee', '  Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.                                 ', 0.00, '', 0, '2025-01-23 13:31:39', '2025-01-23 13:31:39');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(12) NOT NULL,
  `name_category` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name_category`, `description`, `update_at`) VALUES
(1, 'Coffee-Based Drinks', '', '2024-12-24 15:08:08'),
(2, ' Non-Coffee Drinks', '', '2024-12-24 15:08:14'),
(3, ' Cold Brew & Iced Drinks', '', '2024-12-24 15:08:19');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(12) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` text NOT NULL,
  `messages` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_order`
--

CREATE TABLE `detail_order` (
  `id` int(12) NOT NULL,
  `id_order` int(12) NOT NULL,
  `id_product` int(12) NOT NULL,
  `qty` int(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  `refund` decimal(10,2) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_order`
--

INSERT INTO `detail_order` (`id`, `id_order`, `id_product`, `qty`, `price`, `payment`, `refund`, `create_at`, `update_at`) VALUES
(146, 201, 6, 2, 42000.00, 50000.00, 8000.00, '2025-01-30 14:34:46', '2025-01-30 14:34:46');

-- --------------------------------------------------------

--
-- Table structure for table `environment`
--

CREATE TABLE `environment` (
  `id` int(12) NOT NULL,
  `title` varchar(100) NOT NULL,
  `paragraf` varchar(1300) NOT NULL,
  `menu` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `environment`
--

INSERT INTO `environment` (`id`, `title`, `paragraf`, `menu`, `create_at`, `update_at`) VALUES
(1, 'Recycling & Reducing Waste', 'Despite the many challenges, we\'ve been tackling recycling and waste reduction on many fronts. \n\nRecycling in Stores\nWhen looking at the waste generated at a Starbucks store, most of it can be found behind the counter or in the backroom in the form of cardboard boxes, milk jugs, syrup bottles, and coffee grounds. Many of our stores recycle these items, but because it is done behind the counter and in the backroom, it’s not something our customers typically see. What they do see is what happens in the café area. \n\nRecycling success depends on the availability of commercial recycling services where our stores are located. While our policy is that stores recycle where space and services are available, execution often presents challenges, both with customer perception of the services being provided and the actual service itself. Also, different commercial recyclers accept different materials, so we’re not able to provide a consistent program from store to store. And for stores located in shared spaces like malls, it is often the landlord who controls waste collection and recycling. ', 'Recycling', '2025-01-27 08:00:44', '2025-01-27 10:13:26'),
(2, 'Energy Conservation', 'In the last few years we’ve made significant progress in understanding and developing new strategies to reduce our energy consumption. We continue to invest in renewable energy to offset the electricity used in our company-operated stores in the US and Canada, and are beginning to work with our markets around the world to identify additional renewable solutions. We’re also investing in new lighting and improving the efficiency of HVAC (heating, ventilation and cooling) systems and other equipment. \r\n\r\nThe next couple of years will be spent testing, refining, planning and pushing so that we’re fully prepared to meet our 2015 commitment. We’re optimistic about our future and will keep you informed on our progress.', 'Energy', '2025-01-27 08:06:47', '2025-01-27 13:02:09'),
(3, 'Environmental Stewardship', 'We share our customers\' commitment to the environment\r\nAnd we believe in the importance of caring for our planet and working with and encouraging others to do the same. As a company that relies on an agricultural product, it makes good business sense. And', 'Responsibility', '2025-01-27 09:02:09', '2025-01-27 09:02:09'),
(6, 'Water Conservation', 'We’ve made great strides in reducing water consumption in our stores, such as removing all “dipper wells” – those small bowls with continuous streams of water that cleaned spoons used for pouring milk into espresso drinks – and replacing them with manual faucets, which consume 15% less water. \r\n\r\nIn many markets, we use a blast of higher-pressure water to clean blender jugs instead of an open tap. We’ve also programmed our espresso machines to dispense less water when rinsing espresso shot glasses. And we train our partners (employees) to keep the refrigeration coils on ice machines clean to reduce the amount of latent heat from the machines and minimize ice melt. ', 'Water', '2025-01-27 13:03:43', '2025-01-27 13:03:43');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(12) NOT NULL,
  `level_name` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `level_name`, `create_at`, `update_at`) VALUES
(1, 'admin', '2024-12-24 02:45:30', '2024-12-24 02:45:30'),
(2, 'Guest', '2024-12-24 02:45:30', '2024-12-24 02:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(12) NOT NULL,
  `id_user` int(12) NOT NULL,
  `order_code` varchar(100) NOT NULL,
  `order_date` varchar(100) NOT NULL,
  `status` int(2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `id_user`, `order_code`, `order_date`, `status`, `total_price`, `create_at`, `update_at`) VALUES
(201, 20, 'INV/30012025/201', '2025-01-30', 1, 42000.00, '2025-01-30 14:34:46', '2025-01-30 15:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(12) NOT NULL,
  `id_category` int(12) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `stock` int(12) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `id_category`, `product_name`, `description`, `price`, `image`, `stock`, `created_at`, `update_at`) VALUES
(6, 3, 'Latte ', 'Espresso with more steamed milk and less foam.', 21000.00, 'img.1.jpg', 15, '2025-01-30 05:45:49', '2025-01-30 13:59:41'),
(7, 1, 'Mocha ', 'A combination of espresso, chocolate, steamed milk and whipped cream.', 23000.00, 'img2.jpg', 20, '2025-01-30 05:47:18', '2025-01-30 14:01:10'),
(8, 2, 'low sugar coffee', 'Similar to a latte, but with less of an espresso and a smoother milk texture.', 17000.00, 'img3.jpg', 15, '2025-01-30 05:50:37', '2025-01-30 14:01:27'),
(10, 1, 'Espresso ', 'Strong black coffee with fast extraction using an espresso machine.', 23000.00, 'im4.jpg', 15, '2025-01-30 06:33:13', '2025-01-30 14:01:51'),
(11, 1, 'Americano ', 'Espresso with hot water added produces lighter coffee.', 15000.00, 'img5.jpg', 12, '2025-01-30 06:48:43', '2025-01-30 14:02:09'),
(12, 3, 'Flat White', 'Similar to a latte, but with more espresso and a smoother milk texture.', 25000.00, 'img6.jpeg', 21, '2025-01-30 06:49:50', '2025-01-30 14:18:12'),
(13, 2, 'Affogato', 'Espresso poured over a scoop of vanilla ice cream.', 21000.00, 'img7.jpeg', 23, '2025-01-30 07:02:10', '2025-01-30 14:18:35'),
(14, 2, 'Macchiato ', 'Espresso with a little milk foam on top.', 17000.00, 'img8.jpg', 16, '2025-01-30 07:02:10', '2025-01-30 14:19:05');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(12) NOT NULL,
  `title` varchar(100) NOT NULL,
  `sub_title` text NOT NULL,
  `article` text NOT NULL,
  `description` text NOT NULL,
  `images` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `sub_title`, `article`, `description`, `images`, `create_at`, `update_at`) VALUES
(1, ' cursus magna', 'Morbi leo risus, porta ac consectetur ac, vestibulum at eros.Primeluis Boreisis. Aigis morus torekysis', 'Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor', '', 'pngwing.com (2).png', '2025-01-26 14:45:26', '2025-01-30 12:35:03'),
(2, 'sed consectetur.', 'Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.', 'Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.', '', 'pngwing.com5.png', '2025-01-26 15:05:25', '2025-01-30 13:45:13'),
(4, 'Aenean lacinia ', 'bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.', ' Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.', '', 'pngwing.com (4).png', '2025-01-30 12:51:33', '2025-01-30 12:53:48'),
(6, 'Finibus Bonorum', ' The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book.', 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book.', '', 'pngwing.com.png', '2025-01-30 13:22:02', '2025-01-30 13:40:19');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(12) NOT NULL,
  `id_level` int(12) NOT NULL,
  `username` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `id_level`, `username`, `phone`, `address`, `email`, `password`, `create_at`, `update_at`) VALUES
(1, 1, 'admin', '84895395', 'Cirebon', 'admin@gmail.com', '123', '2025-01-17 14:51:31', '2025-01-17 15:25:06'),
(2, 2, 'Jasen Yurhadi', '03947488', 'Jakarta', 'jasen@gmail.com', '123', '2025-01-17 15:24:12', '2025-01-18 12:05:29'),
(3, 2, 'Doni Iryawan', '03947488', 'Tangerang', '', '', '2025-01-18 11:16:58', '2025-01-21 15:50:53'),
(4, 2, 'Yohana Rahmadi', '03947488', 'Bandung', 'Yohana@gmail.com', '', '2025-01-21 17:01:04', '2025-01-21 17:01:35'),
(5, 2, 'Anton Martius', '03947488', 'Pasuruan', 'anton@gmail.com', '1234', '2025-01-22 03:46:12', '2025-01-28 11:10:34'),
(19, 2, 'Johan Septian Purwadi', '03947488', 'Pasuruan', 'Johan@gmail.com', '123', '2025-01-28 18:13:54', '2025-01-28 18:13:54'),
(20, 2, 'Ari Era', '082111760568', 'Eraari02@yahoo.co.id', 'Eraari02@yahoo.co.id', 'al666666', '2025-01-30 14:24:23', '2025-01-30 14:24:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_order`
--
ALTER TABLE `detail_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `environment`
--
ALTER TABLE `environment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_level` (`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `accessories`
--
ALTER TABLE `accessories`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_order`
--
ALTER TABLE `detail_order`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `environment`
--
ALTER TABLE `environment`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_order`
--
ALTER TABLE `detail_order`
  ADD CONSTRAINT `detail_order_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_order_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
