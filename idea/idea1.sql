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