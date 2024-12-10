-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2024 at 03:21 PM
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
-- Database: `db_repair_jbcomp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assessment`
--

CREATE TABLE `tbl_assessment` (
  `assessment_id` int(11) NOT NULL,
  `assessment_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_assessment`
--

INSERT INTO `tbl_assessment` (`assessment_id`, `assessment_name`) VALUES
(1, 'ดีมาก'),
(2, 'ดี'),
(3, 'ปานกลาง'),
(4, 'พอใช้'),
(5, 'แย่');


-- --------------------------------------------------------

--
-- Table structure for table `tbl_building`
--

CREATE TABLE `tbl_building` (
  `building_id` int(11) NOT NULL,
  `building_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_building`
--

INSERT INTO `tbl_building` (`building_id`, `building_name`) VALUES
(4, 'อาคาร1'),
(5, 'อาคาร2'),
(7, 'อาคาร4'),
(8, 'อาคาร5');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_case`
--

CREATE TABLE `tbl_case` (
  `case_id` int(11) NOT NULL,
  `ref_equipment_id` int(11) NOT NULL,
  `case_detail` varchar(250) NOT NULL,
  `case_floor` varchar(20) NOT NULL,
  `case_room` varchar(50) NOT NULL,
  `case_img` varchar(100) NOT NULL,
  `ref_status_id` int(11) NOT NULL,
  `ref_m_id` int(11) NOT NULL,
  `ref_assessment_id` int(11) NOT NULL,
  `ref_building_id` int(11) NOT NULL,
  `dateSave` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_case`
--

INSERT INTO `tbl_case` (`case_id`, `ref_equipment_id`, `case_detail`, `case_floor`, `case_room`, `case_img`, `ref_status_id`, `ref_m_id`, `ref_assessment_id`, `ref_building_id`, `dateSave`) VALUES
(1, 2, '<p>หหห</p>', '2', '201', '59665423520241201_102037.png', 0, 0, 0, 4, '2024-12-01 09:20:37'),
(2, 3, '<p>เสีย</p>', '2', '201', '144261748020241201_102049.png', 0, 0, 0, 5, '2024-12-01 09:20:49'),
(3, 3, '<p>หหห</p>', '5', '405', '160200434720241201_102312.png', 0, 0, 0, 7, '2024-12-01 09:23:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_counter`
--

CREATE TABLE `tbl_counter` (
  `c_id` int(10) NOT NULL,
  `c_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_counter`
--

INSERT INTO `tbl_counter` (`c_id`, `c_date`) VALUES
(12597, '2024-01-01 02:38:48'),
(12598, '2024-01-01 03:31:42'),
(12599, '2024-01-01 03:32:33'),
(12600, '2024-01-01 03:32:44'),
(12601, '2024-01-01 03:34:42'),
(12602, '2024-01-01 03:34:47'),
(12603, '2024-01-01 04:18:40'),
(12604, '2024-01-01 09:42:38'),
(12605, '2024-01-02 07:26:21'),
(12606, '2024-01-02 07:26:41'),
(12607, '2024-01-02 11:00:59'),
(12608, '2024-01-02 11:01:28'),
(12609, '2024-01-03 08:55:38'),
(12610, '2024-01-03 16:51:21'),
(12611, '2024-01-04 03:27:07'),
(12612, '2024-01-04 03:27:14'),
(12613, '2024-01-04 03:27:29'),
(12614, '2024-01-04 03:27:56'),
(12615, '2024-01-04 03:28:57'),
(12616, '2024-01-04 15:15:56'),
(12617, '2024-01-04 16:47:48'),
(12618, '2024-01-04 16:47:48'),
(12619, '2024-01-04 16:47:48'),
(12620, '2024-01-04 19:44:45'),
(12621, '2024-01-05 02:30:25'),
(12622, '2024-01-05 02:33:42'),
(12623, '2024-01-05 02:34:51'),
(12624, '2024-01-05 02:36:25'),
(12625, '2024-01-05 14:36:42'),
(12626, '2024-01-05 17:42:47'),
(12627, '2024-01-06 02:32:36'),
(12628, '2024-01-06 04:57:52'),
(12629, '2024-01-06 04:58:26'),
(12630, '2024-01-06 11:16:14'),
(12631, '2024-01-06 12:32:29'),
(12632, '2024-01-06 13:01:44'),
(12633, '2024-01-06 13:21:10'),
(12634, '2024-01-06 13:21:31'),
(12635, '2024-01-06 13:41:45'),
(12636, '2024-01-06 15:07:26'),
(12637, '2024-01-06 16:19:18'),
(12638, '2024-01-07 06:41:44'),
(12639, '2024-01-07 06:55:33'),
(12640, '2024-01-07 06:58:40'),
(12641, '2024-01-07 07:16:56'),
(12642, '2024-01-07 11:06:23'),
(12643, '2024-01-07 14:13:50'),
(12644, '2024-01-07 14:15:09'),
(12645, '2024-01-07 14:15:35'),
(12646, '2024-01-07 14:15:40'),
(12647, '2024-01-07 15:22:54'),
(12648, '2024-01-07 15:40:26'),

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL COMMENT 'แผนก ประกอบด้วย บัญชี,การตลาด,การจัดการทั่วไป,การเงิน,IT'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`department_id`, `department_name`) VALUES
(2, 'บัญชี'),
(5, 'ดูแลลูกค้าหลังการขาย'),
(7, 'การตลาด');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_equipment`
--

CREATE TABLE `tbl_equipment` (
  `equipment_id` int(11) NOT NULL,
  `equipment_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_equipment`
--

INSERT INTO `tbl_equipment` (`equipment_id`, `equipment_name`) VALUES
(1, 'คอมพิวเตอร์'),
(2, 'เก้าอี้'),
(3, 'หลอดไฟ'),
(4, 'โปรเจกเตอร์');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `m_id` int(11) NOT NULL,
  `member_id` varchar(50) NOT NULL COMMENT 'รหัสพนักงาน',
  `m_level` varchar(100) NOT NULL COMMENT 'admin, head-mechanic, mechanic, employee',
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `title_name` varchar(30) NOT NULL COMMENT 'นาย, นาง, นางสาว',
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `ref_department_id` int(11) NOT NULL COMMENT 'แผนก ประกอบด้วย บัญชี,การตลาด,การจัดการทั่วไป,การเงิน,IT',
  `ref_position_id` int(11) NOT NULL COMMENT 'ตำแหน่ง เช่น ผู้จัดการ, พนักงานบัญชี, พนักงานการตลาด, ช่างคอมพิวเตอร์, ช่างไฟฟ้า, พนักงานประชาสัมพันธ์ ',
  `m_tel` varchar(20) NOT NULL COMMENT 'เบอร์โทร',
  `m_email` varchar(100) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`m_id`, `member_id`, `m_level`, `username`, `password`, `title_name`, `firstname`, `lastname`, `ref_department_id`, `ref_position_id`, `m_tel`, `m_email`, `dateCreate`) VALUES
(6, 'admin01', 'admin', 'admin01', 'cb0ef4c7be04ff1bf4cfcd104ef8df03251266ab', 'นาย', 'admin01', 'test', 5, 3, '0874157947', 'admin01@test.com', '2024-12-01 07:50:25'),
(7, 'EMP0001', 'employee', 'emp01', '2f6c3a6a8aa8e37312bc51a4d6ec88b776fa64e4', 'นางสาว', 'emp001', 'test', 0, 0, '0874157964', 'emp01@test.com', '2024-12-01 07:50:53'),
(8, 'HMEC0001', 'head-mechanic', 'hmec01', '9a54969879eab7aaf596c250041290626d9eb155', 'นาย', 'hmec01', 'test', 7, 2, '0941264785', 'hmec01@test.com', '2024-12-01 07:51:19'),
(9, 'MEC0001', 'mechanic', 'mec01', 'f24f39934c8a3ed0b4cd48600824c769f7a7e9fb', 'นาย', 'mec01', 'test', 7, 2, '0941264774', 'mec01@test.com', '2024-12-01 07:51:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_position`
--

CREATE TABLE `tbl_position` (
  `position_id` int(11) NOT NULL,
  `position_name` varchar(100) NOT NULL COMMENT '	ตำแหน่ง เช่น ผู้จัดการ, พนักงานบัญชี, พนักงานการตลาด, ช่างคอมพิวเตอร์, ช่างไฟฟ้า, พนักงานประชาสัมพันธ์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_position`
--

INSERT INTO `tbl_position` (`position_id`, `position_name`) VALUES
(1, 'พนักงานบัญชี'),
(2, 'ช่างซ่อมคอมพิวเตอร์'),
(3, 'ช่างซ่อมไฟฟ้า');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `ref_type_id` int(11) NOT NULL COMMENT 'tbl_type type_id',
  `product_name` varchar(200) NOT NULL,
  `product_detail` text NOT NULL,
  `product_qty` int(3) NOT NULL,
  `product_price` int(6) NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `ref_type_id`, `product_name`, `product_detail`, `product_qty`, `product_price`, `product_image`, `dateCreate`) VALUES
(7, 2, 'ดเกด', '<p>cvbzdf</p>', 123, 23123, '141944145820241104_113121.png', '2024-11-04 09:43:20'),
(8, 2, 'เก้าอี้aa', '<ol><li>เก้าอี้</li><li>เก้าอี้เก้าอี้</li><li>เก้าอี้เก้าอี้เก้าอี้</li><li>เก้าอี้เก้าอี้เก้าอี้เก้าอี้</li></ol>', 5, 8000, '208204183320241105_104956.png', '2024-11-05 09:49:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_image`
--

CREATE TABLE `tbl_product_image` (
  `no` int(11) NOT NULL,
  `ref_p_id` int(11) NOT NULL,
  `product_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`status_id`, `status_name`) VALUES
(1, 'รอดำเนินการ'),
(2, 'กำลังซ่อม'),
(3, 'รอประเมินผล'),
(5, 'ปิดงาน');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type`
--

CREATE TABLE `tbl_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_type`
--

INSERT INTO `tbl_type` (`type_id`, `type_name`) VALUES
(0, 'สายไฟ'),
(0, 'คอมพิวเตอร์');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_assessment`
--
ALTER TABLE `tbl_assessment`
  ADD PRIMARY KEY (`assessment_id`);

--
-- Indexes for table `tbl_building`
--
ALTER TABLE `tbl_building`
  ADD PRIMARY KEY (`building_id`);

--
-- Indexes for table `tbl_case`
--
ALTER TABLE `tbl_case`
  ADD PRIMARY KEY (`case_id`);

--
-- Indexes for table `tbl_counter`
--
ALTER TABLE `tbl_counter`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `tbl_equipment`
--
ALTER TABLE `tbl_equipment`
  ADD PRIMARY KEY (`equipment_id`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `tbl_position`
--
ALTER TABLE `tbl_position`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product_image`
--
ALTER TABLE `tbl_product_image`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_assessment`
--
ALTER TABLE `tbl_assessment`
  MODIFY `assessment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_building`
--
ALTER TABLE `tbl_building`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_case`
--
ALTER TABLE `tbl_case`
  MODIFY `case_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_counter`
--
ALTER TABLE `tbl_counter`
  MODIFY `c_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14308;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_equipment`
--
ALTER TABLE `tbl_equipment`
  MODIFY `equipment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_position`
--
ALTER TABLE `tbl_position`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_product_image`
--
ALTER TABLE `tbl_product_image`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
