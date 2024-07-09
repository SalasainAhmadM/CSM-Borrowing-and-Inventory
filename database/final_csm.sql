-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2023 at 04:34 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_csm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_cred`
--

CREATE TABLE `admin_cred` (
  `sr_no` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_cred`
--

INSERT INTO `admin_cred` (`sr_no`, `admin_name`, `admin_pass`) VALUES
(1, 'csmadmin', 'csmadmin01');

-- --------------------------------------------------------

--
-- Table structure for table `admin_creds`
--

CREATE TABLE `admin_creds` (
  `sr_no` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `total_pay` varchar(100) NOT NULL,
  `room_no` int(11) DEFAULT NULL,
  `quantity_no` int(11) DEFAULT NULL,
  `user_name` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `year` varchar(155) NOT NULL,
  `teacher` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `quantity` int(50) NOT NULL,
  `group_no` int(50) NOT NULL,
  `volume` int(255) NOT NULL,
  `apr_no` int(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`sr_no`, `booking_id`, `room_name`, `price`, `total_pay`, `room_no`, `quantity_no`, `user_name`, `course`, `year`, `teacher`, `email`, `quantity`, `group_no`, `volume`, `apr_no`) VALUES
(478, 508, 'Beaker', 0, '0', NULL, 5, 'Reuel S. Mendoza', 'BSIT', '3rd', 'sir jason catadman', '2018-03853', 10, 5, 0, 103),
(479, 509, 'Beaker', 0, '0', 0, NULL, 'Reuel S. Mendoza', 'BSIT', '3rd', 'sir jason catadman', '2018-03853', 10, 3, 0, 103);

-- --------------------------------------------------------

--
-- Table structure for table `booking_order`
--

CREATE TABLE `booking_order` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `item_number` varchar(50) NOT NULL,
  `check_in` datetime NOT NULL DEFAULT current_timestamp(),
  `check_out` datetime NOT NULL DEFAULT current_timestamp(),
  `arrival` int(11) NOT NULL DEFAULT 0,
  `refund` int(11) DEFAULT NULL,
  `booking_status` varchar(100) NOT NULL DEFAULT 'pending',
  `order_id` varchar(150) NOT NULL,
  `txn_id` varchar(50) NOT NULL,
  `payment_gross` float(10,2) NOT NULL,
  `trans_id` int(200) DEFAULT NULL,
  `trans_amt` int(11) NOT NULL,
  `trans_status` varchar(100) NOT NULL DEFAULT 'pending',
  `currency` varchar(250) NOT NULL,
  `trans_res_msg` varchar(200) DEFAULT NULL,
  `rate_review` int(11) DEFAULT NULL,
  `datentime` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_order`
--

INSERT INTO `booking_order` (`booking_id`, `user_id`, `room_id`, `item_number`, `check_in`, `check_out`, `arrival`, `refund`, `booking_status`, `order_id`, `txn_id`, `payment_gross`, `trans_id`, `trans_amt`, `trans_status`, `currency`, `trans_res_msg`, `rate_review`, `datentime`) VALUES
(508, 148, 75, '', '2023-05-01 23:14:00', '2023-05-01 13:14:00', 0, 1, 'breakage', 'ORD_1489844717', '', 0.00, NULL, 0, 'pending', '', NULL, NULL, '2023-05-01'),
(509, 148, 75, '', '2023-05-01 22:14:00', '2023-05-01 12:15:00', 1, NULL, 'approved', 'ORD_1481928374', '', 0.00, NULL, 0, 'pending', '', NULL, 0, '2023-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `id` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chemical`
--

CREATE TABLE `chemical` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `area` varchar(100) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `quantity_added` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `avail` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `concentration` varchar(150) NOT NULL,
  `shelf` varchar(150) NOT NULL,
  `description` varchar(350) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `months` varchar(155) NOT NULL,
  `day` varchar(155) NOT NULL,
  `year` varchar(155) NOT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp(),
  `date_exp` date NOT NULL DEFAULT current_timestamp(),
  `code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chemical`
--

INSERT INTO `chemical` (`id`, `name`, `area`, `unit`, `quantity_added`, `quantity`, `avail`, `student`, `concentration`, `shelf`, `description`, `status`, `months`, `day`, `year`, `date_added`, `date_exp`, `code`) VALUES
(92, 'Acids', 350, 'control chemical', 1480, 0, 0, 0, '', 1, '', '', '', '', '', '2023-05-01', '2023-05-28', '001');

-- --------------------------------------------------------

--
-- Table structure for table `chemical_details_final`
--

CREATE TABLE `chemical_details_final` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `chemical_name` varchar(155) NOT NULL,
  `room_no` int(11) DEFAULT NULL,
  `quantity_no` int(11) DEFAULT NULL,
  `username` varchar(150) NOT NULL,
  `course` varchar(150) NOT NULL,
  `year` varchar(150) NOT NULL,
  `teacher` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `quantity` int(100) NOT NULL,
  `group_no` int(100) NOT NULL,
  `volume` int(255) NOT NULL,
  `apr_no` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chemical_details_final`
--

INSERT INTO `chemical_details_final` (`sr_no`, `booking_id`, `chemical_name`, `room_no`, `quantity_no`, `username`, `course`, `year`, `teacher`, `email`, `quantity`, `group_no`, `volume`, `apr_no`) VALUES
(27, 39, 'Acids', NULL, 20, 'Reuel S. Mendoza', 'BSIT', '3rd', 'Sir Baddy', '2018-03853', 1, 3, 20, 103);

-- --------------------------------------------------------

--
-- Table structure for table `chemical_facilities`
--

CREATE TABLE `chemical_facilities` (
  `sr_no` int(11) NOT NULL,
  `chemical_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chemical_order_final`
--

CREATE TABLE `chemical_order_final` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `chemical_id` int(11) NOT NULL,
  `check_in` datetime NOT NULL DEFAULT current_timestamp(),
  `check_out` datetime NOT NULL DEFAULT current_timestamp(),
  `arrival` int(11) NOT NULL DEFAULT 0,
  `refund` int(11) DEFAULT NULL,
  `booking_status` varchar(150) NOT NULL DEFAULT 'pending',
  `order_id` varchar(150) NOT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chemical_order_final`
--

INSERT INTO `chemical_order_final` (`booking_id`, `user_id`, `chemical_id`, `check_in`, `check_out`, `arrival`, `refund`, `booking_status`, `order_id`, `datentime`) VALUES
(39, 148, 92, '2023-05-01 22:28:00', '2023-05-02 22:28:00', 1, NULL, 'approved', 'ORD_1482775958', '2023-05-01 22:28:32');

-- --------------------------------------------------------

--
-- Table structure for table `clearance`
--

CREATE TABLE `clearance` (
  `sr_no` int(11) NOT NULL,
  `date` varchar(155) NOT NULL,
  `cais` int(100) NOT NULL,
  `carch` int(100) NOT NULL,
  `ccie` int(100) NOT NULL,
  `coe` int(100) NOT NULL,
  `ccs` int(100) NOT NULL,
  `cfes` int(100) NOT NULL,
  `che` int(100) NOT NULL,
  `cla` int(100) NOT NULL,
  `claw` int(100) NOT NULL,
  `cpers` int(100) NOT NULL,
  `csm` int(100) NOT NULL,
  `cswcd` int(100) NOT NULL,
  `cte` int(100) NOT NULL,
  `esu` int(100) NOT NULL,
  `graduate` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clearance`
--

INSERT INTO `clearance` (`sr_no`, `date`, `cais`, `carch`, `ccie`, `coe`, `ccs`, `cfes`, `che`, `cla`, `claw`, `cpers`, `csm`, `cswcd`, `cte`, `esu`, `graduate`) VALUES
(17, '2023-05-01', 1, 1, 0, 0, 0, 0, 0, 1, 1, 0, 1, 0, 0, 1, 3),
(18, '2023-05-01', 1, 1, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `clearance_confirm`
--

CREATE TABLE `clearance_confirm` (
  `sr_no` int(11) NOT NULL,
  `clearance_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clearance_facilities`
--

CREATE TABLE `clearance_facilities` (
  `sr_no` int(11) NOT NULL,
  `clearance_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gmap` varchar(150) NOT NULL,
  `pn1` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `insta` varchar(100) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `iframe` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn1`, `email`, `fb`, `insta`, `tw`, `iframe`) VALUES
(1, 'baliwasan', 'https://goo.gl/maps/sMwUxB1wSXG2biPWA', '091234567873', 'klc@gmail.com', 'facebook.com', '', 'twitter.com', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15841.99888741481!2d122.10684622345767!3d6.950226819657557!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x325043baf222c661:0xbf7bbf1883268333!2sBoalan, Zamboanga, Zamboanga Sibugay!5e0!3m2!1sen!2sph!4v1670488141288!5m2!1sen!2sph');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`) VALUES
(3, 'BSIT'),
(4, 'CS');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `made` varchar(100) NOT NULL,
  `shelf` varchar(100) NOT NULL,
  `cost` int(100) NOT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `name`, `brand`, `quantity`, `unit`, `made`, `shelf` , `cost`, `date_added`, `status`) VALUES
(4, 'Microscrope', 'Brand01', 5, 'inches', '', '', 2500, '2023-05-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `equipment_details_final`
--

CREATE TABLE `equipment_details_final` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `equipment_name` varchar(100) NOT NULL,
  `equipment_no` int(11) DEFAULT NULL,
  `quantity_no` int(11) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `teacher` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `quantity` int(100) NOT NULL,
  `group_no` int(100) NOT NULL,
  `volume` int(100) NOT NULL,
  `apr_no` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_order_final`
--

CREATE TABLE `equipment_order_final` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `check_in` datetime NOT NULL DEFAULT current_timestamp(),
  `check_out` datetime NOT NULL DEFAULT current_timestamp(),
  `arrival` int(11) NOT NULL DEFAULT 0,
  `refund` int(11) DEFAULT NULL,
  `booking_status` varchar(100) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `icon`, `name`, `description`) VALUES
(39, '', 'Sir Baddy', 'CSM'),
(42, '', 'sir reuel mendoza', 'biology'),
(43, '', 'sir jason catadman', 'chemistry');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(115, 'Volume'),
(117, 'Kilogram'),
(118, 'inches'),
(119, 'Liter'),
(120, 'gallon'),
(133, 'Percent');

-- --------------------------------------------------------

--
-- Table structure for table `rating_review`
--

CREATE TABLE `rating_review` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` varchar(200) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `datentime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `size` int(100) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `shelf` varchar(150) NOT NULL,
  `quantity_added` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `description` varchar(350) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `removed` int(11) NOT NULL DEFAULT 0,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `brand`, `size`, `unit`, `area`, `price`, `shelf`, `quantity_added`,`quantity`, `adult`, `children`, `description`, `status`, `removed`, `date`) VALUES
(75, 'Beaker', 'Beaker Brand', 250, 'Ml', 0, 0, '', 500, 450, 0, 0, '', 1, 0, '2023-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `room_facilities`
--

CREATE TABLE `room_facilities` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `sr_no` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `site_about` varchar(250) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`sr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'CSM Apparatus and Chemical Stock', 'Inventory and Barrowing Management System', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_cred`
--

CREATE TABLE `user_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(120) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `student_id` varchar(100) NOT NULL,
  `year` varchar(155) NOT NULL,
  `password` varchar(150) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `token` varchar(200) DEFAULT NULL,
  `t_expire` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_cred`
--

INSERT INTO `user_cred` (`id`, `name`, `email`, `address`, `phonenum`, `course`, `student_id`, `year`, `password`, `is_verified`, `token`, `t_expire`, `status`, `datentime`) VALUES
(148, 'Reuel S. Mendoza', 'bg201803853@wmsu.edu.ph', '', '09499401480', 'BSIT', '2018-03853', '3rd', '', 0, 'd37f42383e6f83223d85c5b0688ab1c7', NULL, 1, '2023-05-01 22:14:04');

-- --------------------------------------------------------

--
-- Table structure for table `user_queries`
--

CREATE TABLE `user_queries` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `message` varchar(500) NOT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_queries`
--

INSERT INTO `user_queries` (`sr_no`, `name`, `email`, `message`, `datentime`, `seen`) VALUES
(39, 'reuel', 'reuelmendoza29@gmail.com', 'is there any available room ?', '2022-09-16 00:00:00', 1),
(40, 'reueltest2', 'reuelmendozatest@gmail.com', 'saan exact location po kayo? kasi di ko po mahanap', '2022-09-21 00:00:00', 1),
(41, 'reuel test phase', 'reuelmendoza29@gmail.com', 'kailan ulit meron available na room?', '2022-09-21 00:00:00', 1),
(42, 'reuel test phase', 'reuelmendoza29@gmail.com', 'kailan ulit meron available na room?', '2022-09-21 00:00:00', 1),
(43, 'reuel', 'reuelmendoza@gmail.com', 'hello test', '2022-09-22 00:00:00', 1),
(45, 'mervin', 'reuelmendoza29@gmail.com', 'qwsqweqweqeqw', '2022-10-31 00:00:00', 1),
(46, 'mervin', 'reuelmendoza29@gmail.com', 'qwsqweqweqeqw', '2022-10-31 00:00:00', 1),
(47, 'mervin21355123231', 'reuelmendoza29@gmail.com', 'wqeqweqweqweqw', '2022-12-07 22:13:34', 1),
(48, 'mervin21355123231', 'reuelmendoza29@gmail.com', 'wqeqweqweqweqw', '2022-12-07 22:15:18', 1),
(49, 'mervin21355123231', 'sampleemail@gmail.com', 'hello wolrd', '2023-02-04 17:15:26', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chemical`
--
ALTER TABLE `chemical`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chemical_details_final`
--
ALTER TABLE `chemical_details_final`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `chemical_details_final_ibfk_1` (`booking_id`);

--
-- Indexes for table `chemical_facilities`
--
ALTER TABLE `chemical_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `facilities id` (`facilities_id`),
  ADD KEY `room id` (`chemical_id`);

--
-- Indexes for table `chemical_order_final`
--
ALTER TABLE `chemical_order_final`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `chemical_id` (`chemical_id`);

--
-- Indexes for table `clearance`
--
ALTER TABLE `clearance`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `clearance_confirm`
--
ALTER TABLE `clearance_confirm`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `clearance_facilities`
--
ALTER TABLE `clearance_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `clearance_id` (`clearance_id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment_details_final`
--
ALTER TABLE `equipment_details_final`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `equipment_order_final`
--
ALTER TABLE `equipment_order_final`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `equipment_id` (`equipment_id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating_review`
--
ALTER TABLE `rating_review`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `facilities_id` (`facilities_id`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`sr_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_cred`
--
ALTER TABLE `admin_cred`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=480;

--
-- AUTO_INCREMENT for table `booking_order`
--
ALTER TABLE `booking_order`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=510;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `chemical`
--
ALTER TABLE `chemical`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `chemical_details_final`
--
ALTER TABLE `chemical_details_final`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `chemical_facilities`
--
ALTER TABLE `chemical_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `chemical_order_final`
--
ALTER TABLE `chemical_order_final`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `clearance`
--
ALTER TABLE `clearance`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `clearance_confirm`
--
ALTER TABLE `clearance_confirm`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clearance_facilities`
--
ALTER TABLE `clearance_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `equipment_details_final`
--
ALTER TABLE `equipment_details_final`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `equipment_order_final`
--
ALTER TABLE `equipment_order_final`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `rating_review`
--
ALTER TABLE `rating_review`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `room_facilities`
--
ALTER TABLE `room_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=339;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `booking_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`);

--
-- Constraints for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD CONSTRAINT `booking_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`),
  ADD CONSTRAINT `booking_order_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `chemical_details_final`
--
ALTER TABLE `chemical_details_final`
  ADD CONSTRAINT `chemical_details_final_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `chemical_order_final` (`booking_id`);

--
-- Constraints for table `chemical_facilities`
--
ALTER TABLE `chemical_facilities`
  ADD CONSTRAINT `facilities id` FOREIGN KEY (`facilities_id`) REFERENCES `features` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room id` FOREIGN KEY (`chemical_id`) REFERENCES `chemical` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `chemical_order_final`
--
ALTER TABLE `chemical_order_final`
  ADD CONSTRAINT `chemical_order_final_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`),
  ADD CONSTRAINT `chemical_order_final_ibfk_2` FOREIGN KEY (`chemical_id`) REFERENCES `chemical` (`id`);

--
-- Constraints for table `clearance_facilities`
--
ALTER TABLE `clearance_facilities`
  ADD CONSTRAINT `clearance_facilities_ibfk_1` FOREIGN KEY (`clearance_id`) REFERENCES `clearance` (`sr_no`);

--
-- Constraints for table `equipment_details_final`
--
ALTER TABLE `equipment_details_final`
  ADD CONSTRAINT `equipment_details_final_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `equipment_order_final` (`booking_id`);

--
-- Constraints for table `equipment_order_final`
--
ALTER TABLE `equipment_order_final`
  ADD CONSTRAINT `equipment_order_final_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`),
  ADD CONSTRAINT `equipment_order_final_ibfk_2` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`);

--
-- Constraints for table `rating_review`
--
ALTER TABLE `rating_review`
  ADD CONSTRAINT `rating_review_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`),
  ADD CONSTRAINT `rating_review_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `rating_review_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`);

--
-- Constraints for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD CONSTRAINT `facilities_id` FOREIGN KEY (`facilities_id`) REFERENCES `features` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room_id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
