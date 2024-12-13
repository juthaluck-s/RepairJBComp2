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
