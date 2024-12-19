-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2024 at 09:28 AM
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
(1, 'ดีมาก', 0),
(2, 'ดี', 0),
(3, 'ปานกลาง', 0),
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
-- Triggers `tbl_case`
--
DELIMITER $$
CREATE TRIGGER `after_status_count_delete` AFTER DELETE ON `tbl_case` FOR EACH ROW BEGIN
    UPDATE tbl_status
    SET status_count = status_count - 1
    WHERE status_id = OLD.ref_status_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_status_count_insert` AFTER INSERT ON `tbl_case` FOR EACH ROW BEGIN
    UPDATE tbl_status
    SET status_count = status_count + 1
    WHERE status_id = NEW.ref_status_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_status_count_update` AFTER UPDATE ON `tbl_case` FOR EACH ROW BEGIN
    -- ลดค่าของ ref_status_id เก่า
    IF OLD.ref_status_id IS NOT NULL THEN
        UPDATE tbl_status
        SET status_count = status_count - 1
        WHERE status_id = OLD.ref_status_id;
    END IF;

    -- เพิ่มค่าของ ref_status_id ใหม่
    IF NEW.ref_status_id IS NOT NULL THEN
        UPDATE tbl_status
        SET status_count = status_count + 1
        WHERE status_id = NEW.ref_status_id;
    END IF;
END
$$
DELIMITER ;

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
(1, 'บัญชี'),
(2, 'การเงิน'),
(3, 'บุคคล'),
(4, 'บริหาร'),
(5, 'วิจัยและพัฒนา'),
(6, 'จัดซื้อ'),
(7, 'ขนส่ง'),
(8, 'เทคโนโลยีสารสนเทศ'),
(9, 'การตลาด'),
(10, 'ดูแลลูกค้าหลังการขาย'),
(11, 'ซ่อมบำรุง');

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
(4, 'เครื่องฉายสไลด์ (Projector)'),
(6, 'โต๊ะทำงาน'),
(7, 'ตู้เก็บเอกสาร'),
(9, 'เครื่องพิมพ์ (Printer)'),
(10, 'โทรศัพท์ตั้งโต๊ะ'),
(11, 'เครื่องแฟกซ์ (Fax)'),
(12, 'เครื่องทำลายเอกสาร'),
(14, 'ปลั๊กไฟ/ปลั๊กพ่วง'),
(15, 'เครื่องสแกน (Flatbed Scanner)'),
(16, 'ไอแพด/แท็บเล็ตส่วนกลาง'),
(17, 'ระบบอินเทอร์เน็ต'),
(18, 'ก็อกน้ำ'),
(19, 'พัดลม'),
(20, 'แอร์'),
(21, 'เครื่องสำรองไฟ (UPS)'),
(22, 'ไมโครเวฟ'),
(23, 'ตู้เย็น'),
(24, 'โทรทัศน์'),
(25, 'ชุดเครื่องเสียง'),
(26, 'กาต้มน้ำ'),
(27, 'เครื่องปิ้งขนมปัง'),
(28, 'กล้องวงจรปิด');

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
(4, 'นาย', 'ธนินท์', 'รัตนเศรษฐา', '0841527891', 'hmec01@test.com'),
(5, 'นาย', 'ยศพล', 'เกียรติบวรสกุล', '0674182578', 'hmec02@test.com');

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
(6, 'นาย', 'ภาณุพล', 'อุดมวงศ์', '0952154781', 'mec01@test.com', 0, 0, 0),
(7, 'นาย', 'ชวิศ', 'เหล่าพงษ์', '0647884517', 'mec02@test.com', 0, 0, 0),
(8, 'นาย', 'ธเนษฐ', 'พงศ์พิไล', '0823451877', 'mec03@test.com', 0, 0, 0);

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
(2, 'AD0001', 1, 'admin01', 'cb0ef4c7be04ff1bf4cfcd104ef8df03251266ab', 'นาย', 'ธัชพล', 'เจริญผลวัฒนา', 11, 3, '0812574891', 'admin01@test.com', '2024-12-19 06:00:07'),
(3, 'AD0002', 1, 'admin02', 'd5f3f4db6d8400f894bde2523e8247b9ff2346fb', 'นางสาว', 'กรภัทร', 'จรัสโสภณ', 11, 2, '0865215482', 'admin02@test.com', '2024-12-19 06:01:31'),
(4, 'HMEC0001', 2, 'hmec01', '9a54969879eab7aaf596c250041290626d9eb155', 'นาย', 'ธนินท์', 'รัตนเศรษฐา', 11, 9, '0841527891', 'hmec01@test.com', '2024-12-19 06:03:14'),
(5, 'HMEC0002', 2, 'hmec02', '1e5fef21b67706d4ff70c4dda97ffd69de4d973d', 'นาย', 'ยศพล', 'เกียรติบวรสกุล', 11, 9, '0674182578', 'hmec02@test.com', '2024-12-19 06:04:28'),
(6, 'MEC0001', 3, 'mec01', 'f24f39934c8a3ed0b4cd48600824c769f7a7e9fb', 'นาย', 'ภาณุพล', 'อุดมวงศ์', 11, 27, '0952154781', 'mec01@test.com', '2024-12-19 06:05:27'),
(7, 'MEC0002', 3, 'mec02', '7cd68a284039226ef40d4134755f6a55ae1f7257', 'นาย', 'ชวิศ', 'เหล่าพงษ์', 11, 28, '0647884517', 'mec02@test.com', '2024-12-19 06:07:10'),
(8, 'MEC0003', 3, 'mec03', 'cc5af8e7e5b442568fa48c20d8c404c9fcb90445', 'นาย', 'ธเนษฐ', 'พงศ์พิไล', 11, 29, '0823451877', 'mec03@test.com', '2024-12-19 06:08:27'),
(9, 'EMP0001', 4, 'emp01', '2f6c3a6a8aa8e37312bc51a4d6ec88b776fa64e4', 'นางสาว', 'พิชญาภรณ์', 'จงจำรัส', 1, 8, '0841744888', 'emp01@gmail.com', '2024-12-19 06:09:21'),
(10, 'EMP0002', 4, 'emp02', '793e55df49c1da043cd0d9ddc60be60b5f8ba68f', 'นาง', 'ณิชนันทน์', 'แก้ววิไล', 10, 11, '0923447884', 'emp02@test.com', '2024-12-19 06:10:41'),
(11, 'EMP0003', 4, 'emp03', '665aed9bf1c73eb32b16600844dc618a932144dc', 'นาย', 'ธาริน', 'ตรีพงศ์สกุล', 8, 21, '0855512477', 'emp03@test.com', '2024-12-19 06:12:42');

--
-- Triggers `tbl_member`
--
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
CREATE TRIGGER `after_update_head_mechanic` AFTER UPDATE ON `tbl_member` FOR EACH ROW BEGIN
    -- ตรวจสอบว่าข้อมูลมีการเปลี่ยนแปลงใน ref_level_id หรือข้อมูลสำคัญเท่านั้น
    IF (OLD.ref_level_id != NEW.ref_level_id OR 
        OLD.title_name != NEW.title_name OR 
        OLD.firstname != NEW.firstname OR 
        OLD.lastname != NEW.lastname OR 
        OLD.m_tel != NEW.m_tel OR 
        OLD.m_email != NEW.m_email) THEN

        -- หาก ref_level_id เดิมคือ 2 และใหม่ไม่ใช่ 2 ให้ลบข้อมูลจาก tbl_head_mechanic
        IF OLD.ref_level_id = 2 AND NEW.ref_level_id != 2 THEN
            DELETE FROM tbl_head_mechanic WHERE head_mechanic_id = OLD.m_id;
        END IF;

        -- หาก ref_level_id ใหม่คือ 2 ให้แทรกหรืออัปเดตข้อมูลใน tbl_head_mechanic
        IF NEW.ref_level_id = 2 THEN
            REPLACE INTO tbl_head_mechanic (
                head_mechanic_id, head_mechanic_title_name, head_mechanic_firstname, head_mechanic_lastname, head_mechanic_tel, head_mechanic_email
            ) VALUES (
                NEW.m_id, NEW.title_name, NEW.firstname, NEW.lastname, NEW.m_tel, NEW.m_email
            );
        END IF;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_mechanic` AFTER UPDATE ON `tbl_member` FOR EACH ROW BEGIN
    -- ตรวจสอบว่าข้อมูลมีการเปลี่ยนแปลงใน ref_level_id หรือข้อมูลสำคัญเท่านั้น
    IF (OLD.ref_level_id != NEW.ref_level_id OR 
        OLD.title_name != NEW.title_name OR 
        OLD.firstname != NEW.firstname OR 
        OLD.lastname != NEW.lastname OR 
        OLD.m_tel != NEW.m_tel OR 
        OLD.m_email != NEW.m_email) THEN

        -- หาก ref_level_id เดิมคือ 3 และใหม่ไม่ใช่ 3 ให้ลบข้อมูลจาก tbl_mechanic
        IF OLD.ref_level_id = 3 AND NEW.ref_level_id != 3 THEN
            DELETE FROM tbl_mechanic WHERE mec_id = OLD.m_id;
        END IF;

        -- หาก ref_level_id ใหม่คือ 3 ให้แทรกหรืออัปเดตข้อมูลใน tbl_mechanic
        IF NEW.ref_level_id = 3 THEN
            REPLACE INTO tbl_mechanic (
                mec_id, mec_title_name, mec_firstname, mec_lastname, mec_tel, mec_email, mec_doing, mec_close, mec_all_job
            ) VALUES (
                NEW.m_id, NEW.title_name, NEW.firstname, NEW.lastname, NEW.m_tel, NEW.m_email, 0, 0, 0
            );
        END IF;
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
(1, 'ผู้จัดการทั่วไป'),
(2, 'ผู้จัดการ'),
(3, 'หัวหน้าแผนก'),
(4, 'ผู้จัดการฝ่ายบุคคล'),
(5, 'ผู้จัดการฝ่ายการเงิน'),
(6, 'ผู้จัดการฝ่ายขาย'),
(8, 'ผู้จัดการฝ่ายบัญชี'),
(9, 'หัวหน้าทีม'),
(11, 'เลขานุการ'),
(15, 'พนักงานทั่วไป'),
(16, 'CTO (Chief Technology Officer)'),
(17, 'CIO (Chief Information Officer)'),
(18, 'IT Director'),
(19, 'IT Project Manager'),
(20, 'IT Security Manager'),
(21, 'Full-stack Developer'),
(22, 'Mobile developer'),
(23, 'Data Engineer'),
(24, 'Data analyst'),
(25, 'Machine Learning Engineer'),
(26, 'IT Support'),
(27, 'ช่างซ่อมบำรุง'),
(28, 'ช่างเทคนิค'),
(29, 'ช่างไฟฟ้า อิเล็กทรอนิกส์และคอมพิวเตอร์');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(100) NOT NULL,
  `status_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`status_id`, `status_name`, `status_count`) VALUES
(1, 'รอดำเนินการ', 0),
(2, 'กำลังซ่อม', 0),
(3, 'รอประเมินผล', 0),
(4, 'ปิดงาน', 0);

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
  MODIFY `case_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_equipment`
--
ALTER TABLE `tbl_equipment`
  MODIFY `equipment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_position`
--
ALTER TABLE `tbl_position`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
