-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2024 at 09:56 AM
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
  `assessment_name` varchar(30) NOT NULL,
  `assessment_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_assessment`
--

INSERT INTO `tbl_assessment` (`assessment_id`, `assessment_name`, `assessment_count`) VALUES
(1, 'ดีมาก', 2),
(2, 'ดี', 1),
(3, 'ปานกลาง', 1),
(4, 'พอใช้', 0),
(5, 'แย่', 0);

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
(1, 'อาคาร 1'),
(2, 'อาคาร 2'),
(3, 'อาคาร 3'),
(4, 'อาคาร 4'),
(5, 'อาคาร 5'),
(6, 'อาคาร 6'),
(7, 'อาคาร 7'),
(8, 'อาคาร 8');

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
  `dateSave` timestamp NOT NULL DEFAULT current_timestamp(),
  `ref_head_mechanic_id` int(11) NOT NULL,
  `ref_mec_id` int(11) NOT NULL,
  `case_update_log` varchar(250) NOT NULL,
  `case_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_case`
--

INSERT INTO `tbl_case` (`case_id`, `ref_equipment_id`, `case_detail`, `case_floor`, `case_room`, `case_img`, `ref_status_id`, `ref_m_id`, `ref_assessment_id`, `ref_building_id`, `dateSave`, `ref_head_mechanic_id`, `ref_mec_id`, `case_update_log`, `case_update`) VALUES
(1, 3, '<p>454554</p>', '5', '888', '156538651120241217_083850.png', 4, 2, 3, 1, '2024-12-17 07:38:50', 13, 15, '7821245', '2024-12-17 07:40:29'),
(2, 4, '<p>121121</p>', '4', '455', '89721860920241217_083904.png', 4, 2, 1, 4, '2024-12-17 07:39:04', 13, 15, '1278', '2024-12-17 07:40:23'),
(3, 1, '<p>546787</p>', '8', '784', '88437374720241217_083918.png', 4, 2, 2, 7, '2024-12-17 07:39:18', 13, 15, '7875', '2024-12-17 07:40:16'),
(4, 3, '<p>45678</p>', '8', '48', '91727354320241217_083930.jpg', 4, 2, 1, 4, '2024-12-17 07:39:30', 13, 15, '4545', '2024-12-17 07:40:11');

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
(12607, '2024-01-02 11:00:59');

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
-- Table structure for table `tbl_head_mechanic`
--

CREATE TABLE `tbl_head_mechanic` (
  `head_mechanic_id` int(11) NOT NULL,
  `head_mechanic_title_name` varchar(30) NOT NULL,
  `head_mechanic_firstname` varchar(100) NOT NULL,
  `head_mechanic_lastname` varchar(100) NOT NULL,
  `head_mechanic_tel` varchar(20) NOT NULL,
  `head_mechanic_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_head_mechanic`
--

INSERT INTO `tbl_head_mechanic` (`head_mechanic_id`, `head_mechanic_title_name`, `head_mechanic_firstname`, `head_mechanic_lastname`, `head_mechanic_tel`, `head_mechanic_email`) VALUES
(13, 'นาย', 'hmec01s', 'hmec01', '0865215482', 'hmec01@test.com'),
(14, 'นาย', 'hmec02', 'hmec02', '0865215483', 'hmec02@test.com'),
(18, 'นาย', 'hmec03', 'hmec03', '0874159628', 'hmec03@test.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_level`
--

CREATE TABLE `tbl_level` (
  `level_id` int(11) NOT NULL,
  `level_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_level`
--

INSERT INTO `tbl_level` (`level_id`, `level_name`) VALUES
(1, 'Admin'),
(2, 'Head Mechanic'),
(3, 'Mechanic'),
(4, 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mechanic`
--

CREATE TABLE `tbl_mechanic` (
  `mec_id` int(11) NOT NULL,
  `mec_title_name` varchar(30) NOT NULL,
  `mec_firstname` varchar(100) NOT NULL,
  `mec_lastname` varchar(100) NOT NULL,
  `mec_tel` varchar(20) NOT NULL,
  `mec_email` varchar(100) NOT NULL,
  `mec_doing` int(11) NOT NULL COMMENT 'งานที่ได้รับมอบหมาย(กำลังทำ)',
  `mec_close` int(11) NOT NULL COMMENT 'งานที่ปิดแล้ว',
  `mec_all_job` int(11) NOT NULL COMMENT 'งานทั้งหมดที่ได้รับมอบหมาย รวมกับปิด'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_mechanic`
--

INSERT INTO `tbl_mechanic` (`mec_id`, `mec_title_name`, `mec_firstname`, `mec_lastname`, `mec_tel`, `mec_email`, `mec_doing`, `mec_close`, `mec_all_job`) VALUES
(15, 'นาย', 'mec01', 'mec01', '0865215483', 'mec01@test.com', 0, 4, 4),
(16, 'นาง', 'mec02', 'mec02', '0865215482', 'mec02@test.com', 0, 0, 0),
(17, 'นาย', 'mec03', 'mec03', '0865215482', 'mec03@test.com', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `m_id` int(11) NOT NULL,
  `member_id` varchar(50) NOT NULL COMMENT 'รหัสพนักงาน',
  `ref_level_id` int(11) NOT NULL COMMENT 'admin, head-mechanic, mechanic, employee',
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

INSERT INTO `tbl_member` (`m_id`, `member_id`, `ref_level_id`, `username`, `password`, `title_name`, `firstname`, `lastname`, `ref_department_id`, `ref_position_id`, `m_tel`, `m_email`, `dateCreate`) VALUES
(1, 'AD0001', 1, 'admin01', 'cb0ef4c7be04ff1bf4cfcd104ef8df03251266ab', 'นาย', 'admin01111', 'admin01', 2, 2, '0865215482', 'admin01@test.com', '2024-12-13 06:28:49'),
(2, 'EMP0001', 4, 'emp01', '2f6c3a6a8aa8e37312bc51a4d6ec88b776fa64e4', 'นางสาว', 'emp01', 'emp01', 7, 1, '0812574891', 'emp01@gmail.com', '2024-12-13 06:32:59'),
(3, 'EMP0002', 4, 'emp02', '793e55df49c1da043cd0d9ddc60be60b5f8ba68f', 'นางสาว', 'emp02', 'emp02', 5, 3, '0865215482', 'emp02@gmail.com', '2024-12-13 06:33:24'),
(13, 'HMEC0001', 2, 'hmec01', '9a54969879eab7aaf596c250041290626d9eb155', 'นาย', 'hmec01s', 'hmec01', 0, 0, '0865215482', 'hmec01@test.com', '2024-12-14 10:31:36'),
(14, 'HMEC0002', 2, 'hmec02', '1e5fef21b67706d4ff70c4dda97ffd69de4d973d', 'นาย', 'hmec02', 'hmec02', 7, 3, '0865215483', 'hmec02@test.com', '2024-12-14 10:32:07'),
(15, 'MEC0001', 3, 'mec01', 'f24f39934c8a3ed0b4cd48600824c769f7a7e9fb', 'นาย', 'mec01', 'mec01', 5, 2, '0865215483', 'mec01@test.com', '2024-12-14 10:32:56'),
(16, 'MEC0002', 3, 'mec02', '7cd68a284039226ef40d4134755f6a55ae1f7257', 'นาง', 'mec02', 'mec02', 5, 2, '0865215482', 'mec02@test.com', '2024-12-14 10:33:18'),
(17, 'MEC0003', 3, 'mec03', 'cc5af8e7e5b442568fa48c20d8c404c9fcb90445', 'นาย', 'mec03', 'mec03', 2, 3, '0865215482', 'mec03@test.com', '2024-12-15 06:30:39'),
(18, 'HMEC0003', 2, 'hmec03', '5594c867d15c6ceff0874373abe0a171a84cda26', 'นาย', 'hmec03', 'hmec03', 2, 1, '0874159628', 'hmec03@test.com', '2024-12-16 07:52:33');

--
-- Triggers `tbl_member`
--
DELIMITER $$
CREATE TRIGGER `after_delete_head_mechanic` AFTER DELETE ON `tbl_member` FOR EACH ROW BEGIN
    -- ตรวจสอบว่า ref_level_id เดิมของข้อมูลที่ถูกลบคือ 2 (หัวหน้าช่าง)
    IF OLD.ref_level_id = 2 THEN
        -- ลบข้อมูลที่ตรงกันใน tbl_head_mechanic โดยใช้ head_mechanic_id
        DELETE FROM tbl_head_mechanic WHERE head_mechanic_id = OLD.m_id;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_delete_machanic` AFTER DELETE ON `tbl_member` FOR EACH ROW BEGIN
    -- ตรวจสอบว่า ref_level_id เดิมของข้อมูลที่ถูกลบคือ 3 (ช่าง)
    IF OLD.ref_level_id = 3 THEN
        -- ลบข้อมูลใน tbl_mechanic ที่มี mec_id ตรงกับ m_id ของ tbl_member ที่ถูกลบ
        DELETE FROM tbl_mechanic WHERE mec_id = OLD.m_id;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_delete_mechanic` AFTER DELETE ON `tbl_member` FOR EACH ROW BEGIN
    -- ตรวจสอบว่า ref_level_id เดิมของข้อมูลที่ถูกลบคือ 3 (ช่าง)
    IF OLD.ref_level_id = 3 THEN
        -- ลบข้อมูลใน tbl_mechanic ที่มี mec_id ตรงกับ m_id ของ tbl_member ที่ถูกลบ
        DELETE FROM tbl_mechanic WHERE mec_id = OLD.m_id;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_head_mechanic` AFTER INSERT ON `tbl_member` FOR EACH ROW BEGIN
    -- ตรวจสอบว่าระดับสิทธิ์ (ref_level_id) คือ 2 (หัวหน้าช่าง)
    IF NEW.ref_level_id = 2 THEN
        -- แทรกข้อมูลลงใน tbl_head_mechanic โดยใช้ข้อมูลจาก tbl_member
        INSERT INTO tbl_head_mechanic (head_mechanic_id, head_mechanic_title_name, head_mechanic_firstname, head_mechanic_lastname, head_mechanic_tel, head_mechanic_email)
        VALUES (NEW.m_id, NEW.title_name, NEW.firstname, NEW.lastname, NEW.m_tel, NEW.m_email);
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_mechanic` AFTER INSERT ON `tbl_member` FOR EACH ROW BEGIN
    -- ตรวจสอบว่า ref_level_id คือ 3 (ช่าง)
    IF NEW.ref_level_id = 3 THEN
        -- แทรกข้อมูลลงใน tbl_mechanic
        INSERT INTO tbl_mechanic (mec_id, mec_title_name, mec_firstname, mec_lastname, mec_tel, mec_email, mec_doing, mec_close)
        VALUES (NEW.m_id, NEW.title_name, NEW.firstname, NEW.lastname, NEW.m_tel, NEW.m_email, 0, 0);
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_head_mechanic` AFTER UPDATE ON `tbl_member` FOR EACH ROW BEGIN
    -- ตรวจสอบว่า ref_level_id เดิมคือ 2 และใหม่ไม่ใช่ 2
    IF OLD.ref_level_id = 2 AND NEW.ref_level_id != 2 THEN
        -- ลบข้อมูลใน tbl_head_mechanic ที่เกี่ยวข้อง
        DELETE FROM tbl_head_mechanic WHERE head_mechanic_id = OLD.m_id;
    END IF;

    -- หาก ref_level_id ใหม่คือ 2, แทรกข้อมูลใหม่ใน tbl_head_mechanic
    IF NEW.ref_level_id = 2 THEN
        INSERT INTO tbl_head_mechanic (head_mechanic_id, head_mechanic_title_name, head_mechanic_firstname, head_mechanic_lastname, head_mechanic_tel, head_mechanic_email)
        VALUES (NEW.m_id, NEW.title_name, NEW.firstname, NEW.lastname, NEW.m_tel, NEW.m_email);
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_mechanic` AFTER UPDATE ON `tbl_member` FOR EACH ROW BEGIN
    -- ตรวจสอบว่า ref_level_id เดิมคือ 3 และใหม่ไม่ใช่ 3
    IF OLD.ref_level_id = 3 AND NEW.ref_level_id != 3 THEN
        -- ลบข้อมูลใน tbl_mechanic ที่มี mec_id ตรงกับ m_id ของ tbl_member ที่ถูกอัปเดต
        DELETE FROM tbl_mechanic WHERE mec_id = OLD.m_id;
    END IF;

    -- หาก ref_level_id ใหม่คือ 3, แทรกข้อมูลใหม่ใน tbl_mechanic
    IF NEW.ref_level_id = 3 THEN
        INSERT INTO tbl_mechanic (mec_id, mec_title_name, mec_firstname, mec_lastname, mec_tel, mec_email, mec_doing, mec_close)
        VALUES (NEW.m_id, NEW.title_name, NEW.firstname, NEW.lastname, NEW.m_tel, NEW.m_email, 0, 0);
    END IF;
END
$$
DELIMITER ;

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
  `status_name` varchar(100) NOT NULL COMMENT '	ตำแหน่ง เช่น ผู้จัดการ, พนักงานบัญชี, พนักงานการตลาด, ช่างคอมพิวเตอร์, ช่างไฟฟ้า, พนักงานประชาสัมพันธ์	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`status_id`, `status_name`) VALUES
(1, 'รอดำเนินการ'),
(2, 'กำลังซ่อม'),
(3, 'รอประเมินผล'),
(4, 'ปิดงาน');

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
(0, 'คอมพิวเตอร์'),
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
-- Indexes for table `tbl_head_mechanic`
--
ALTER TABLE `tbl_head_mechanic`
  ADD PRIMARY KEY (`head_mechanic_id`);

--
-- Indexes for table `tbl_level`
--
ALTER TABLE `tbl_level`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `tbl_mechanic`
--
ALTER TABLE `tbl_mechanic`
  ADD PRIMARY KEY (`mec_id`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`m_id`),
  ADD UNIQUE KEY `member_id` (`member_id`,`username`);

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
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_case`
--
ALTER TABLE `tbl_case`
  MODIFY `case_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT for table `tbl_head_mechanic`
--
ALTER TABLE `tbl_head_mechanic`
  MODIFY `head_mechanic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_level`
--
ALTER TABLE `tbl_level`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_mechanic`
--
ALTER TABLE `tbl_mechanic`
  MODIFY `mec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
