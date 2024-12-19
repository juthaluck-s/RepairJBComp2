SELECT 
    c.case_id,
    c.case_detail,
    emp.firstname AS emp_firstname,
    emp.lastname AS emp_lastname,
    mec.firstname AS mec_firstname,
    mec.lastname AS mec_lastname
FROM 
    tbl_case AS c
LEFT JOIN 
    tbl_member AS emp ON c.ref_m_id = emp.m_id
LEFT JOIN 
    tbl_member AS mec ON c.ref_mechanic_id = mec.m_id;


ใช้ดึงข้อมูลจาก 
tbl_case เพิ่ม ตาราง  case_update, ref_mec_id
tbl_member emp คือ employee 
ส่วน mec คือ เพื่อดึง ตำแหน่ง mechanic

----------------------------------------------------------------------
CREATE TABLE `tbl_member` (
  `m_id` int(11) NOT NULL,
  `member_id` varchar(50) NOT NULL,
  `m_level` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `title_name` varchar(30) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `m_tel` varchar(20) NOT NULL,
  `m_email` varchar(100) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT current_timestamp()
);

CREATE TABLE `tbl_mechanic_details` (
  `mec_id` int(11) NOT NULL,
  `special_skill` varchar(100) NOT NULL,
  `experience_years` int(11) NOT NULL,
  FOREIGN KEY (`mec_id`) REFERENCES `tbl_member` (`m_id`)
);
---------------------------------------------------------------------

// เตรียม Query
$queryMechanic = $condb->prepare("
    SELECT 
        m_id, 
        firstname, 
        lastname, 
        m_tel, 
        m_email
    FROM 
        tbl_member
    WHERE 
        ref_level_id = :level_id
");

// กำหนดเงื่อนไขระดับสิทธิ์
$level_id = 3; // ช่าง
$queryMechanic->bindParam(':level_id', $level_id, PDO::PARAM_INT);

// รัน Query
$queryMechanic->execute();

// ดึงข้อมูล
$mechanics = $queryMechanic->fetchAll(PDO::FETCH_ASSOC);

// ตรวจสอบข้อมูล
foreach ($mechanics as $mechanic) {
    echo "ชื่อ: " . htmlspecialchars($mechanic['firstname']) . " " . htmlspecialchars($mechanic['lastname']) . "<br>";
    echo "เบอร์โทร: " . htmlspecialchars($mechanic['m_tel']) . "<br>";
    echo "อีเมล: " . htmlspecialchars($mechanic['m_email']) . "<br><br>";
}

---------------------------------------------------------------------
1. เพิ่มข้อมูลใน tbl_mechanic อัตโนมัติ
เมื่อเพิ่ม tbl_member ใหม่และ ref_level_id = 3 ให้สร้าง Trigger ในฐานข้อมูล เพื่อเพิ่ม mec_id ใน tbl_mechanic โดยอัตโนมัติ:


DELIMITER $$

CREATE TRIGGER `after_insert_head_mechanic` AFTER INSERT ON `tbl_member` FOR EACH ROW BEGIN
    -- ตรวจสอบว่าระดับสิทธิ์ (ref_level_id) คือ 2 (หัวหน้าช่าง)
    IF NEW.ref_level_id = 2 THEN
        -- แทรกข้อมูลลงใน tbl_head_mechanic โดยใช้ข้อมูลจาก tbl_member
        INSERT INTO tbl_head_mechanic (head_mechanic_id, head_mechanic_title_name, head_mechanic_firstname, head_mechanic_lastname, head_mechanic_tel, head_mechanic_email)
        VALUES (NEW.m_id, NEW.title_name, NEW.firstname, NEW.lastname, NEW.m_tel, NEW.m_email);
    END IF;
END$$

DELIMITER ;

DELIMITER $$

CREATE TRIGGER `after_insert_mechanic` AFTER INSERT ON `tbl_member` FOR EACH ROW BEGIN
    -- ตรวจสอบว่า ref_level_id คือ 3 (ช่าง)
    IF NEW.ref_level_id = 3 THEN
        -- แทรกข้อมูลลงใน tbl_mechanic
        INSERT INTO tbl_mechanic (mec_id, mec_title_name, mec_firstname, mec_lastname, mec_tel, mec_email, mec_doing, mec_close)
        VALUES (NEW.m_id, NEW.title_name, NEW.firstname, NEW.lastname, NEW.m_tel, NEW.m_email, 0, 0);
    END IF;
END$$

DELIMITER ;




----------------------------------------------------------------------
2. Trigger สำหรับการลบข้อมูลใน tbl_head_mechanic เมื่อ tbl_member ถูกลบ


DELIMITER $$

CREATE TRIGGER `after_delete_head_mechanic` AFTER DELETE ON `tbl_member` FOR EACH ROW BEGIN
    -- ตรวจสอบว่า ref_level_id เดิมของข้อมูลที่ถูกลบคือ 2 (หัวหน้าช่าง)
    IF OLD.ref_level_id = 2 THEN
        -- ลบข้อมูลที่ตรงกันใน tbl_head_mechanic โดยใช้ head_mechanic_id
        DELETE FROM tbl_head_mechanic WHERE head_mechanic_id = OLD.m_id;
    END IF;
END$$

DELIMITER ;

DELIMITER $$

CREATE TRIGGER `after_delete_mechanic` AFTER DELETE ON `tbl_member` FOR EACH ROW BEGIN
    -- ตรวจสอบว่า ref_level_id เดิมของข้อมูลที่ถูกลบคือ 3 (ช่าง)
    IF OLD.ref_level_id = 3 THEN
        -- ลบข้อมูลใน tbl_mechanic ที่มี mec_id ตรงกับ m_id ของ tbl_member ที่ถูกลบ
        DELETE FROM tbl_mechanic WHERE mec_id = OLD.m_id;
    END IF;
END$$

DELIMITER ;



---------------------------------------------------------------------------
3.Trigger สำหรับการอัปเดตข้อมูลใน tbl_member เมื่อ ref_level_id เปลี่ยนจาก 2 เป็นค่าอื่น

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
END$$

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
END$$

DELIMITER ;


DELIMITER $$

CREATE TRIGGER after_status_count_insert
AFTER INSERT ON tbl_case
FOR EACH ROW
BEGIN
    UPDATE tbl_status
    SET status_count = status_count + 1
    WHERE status_id = NEW.ref_status_id;
END$$

DELIMITER ;

DELIMITER $$

CREATE TRIGGER after_status_count_update
AFTER UPDATE ON tbl_case
FOR EACH ROW
BEGIN
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
END$$

DELIMITER ;


DELIMITER $$

CREATE TRIGGER after_status_count_delete
AFTER DELETE ON tbl_case
FOR EACH ROW
BEGIN
    UPDATE tbl_status
    SET status_count = status_count - 1
    WHERE status_id = OLD.ref_status_id;
END$$

DELIMITER ;
-----------------------------------------------------------------------
DELIMITER $$ 
CREATE TRIGGER `after_update_mechanic` AFTER UPDATE ON `tbl_member` 
FOR EACH ROW 
BEGIN
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
END $$ 
DELIMITER ;

---------------------------------------------------------------------

DELIMITER $$ 
CREATE TRIGGER `after_update_head_mechanic` AFTER UPDATE ON `tbl_member` 
FOR EACH ROW 
BEGIN
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
END $$ 
DELIMITER ;

--------------------------------------------------------------------
ลบ Trigger สำหรับการเขียนใหม่

DROP TRIGGER IF EXISTS `after_delete_head_mechanic`;
DROP TRIGGER IF EXISTS `after_delete_mechanic`;
DROP TRIGGER IF EXISTS `after_insert_head_mechanic`;
DROP TRIGGER IF EXISTS `after_insert_mechanic`;
DROP TRIGGER IF EXISTS `after_update_head_mechanic`;
DROP TRIGGER IF EXISTS `after_update_mechanic`;