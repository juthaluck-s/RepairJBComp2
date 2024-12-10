SELECT p.id, p.product_name, p.product_qty, p.product_price, p.product_image, t.type_name
FROM tbl_product  as p 
INNER JOIN tbl_type as t 
ON p.ref_type_id = t.type_id
GROUP by p.id

---------------------------------------
-- สามารถเขียนได้ 2 แบบ โดยที่แบบข้างบนจะต้อง as .... เพื่อให้ย่อชื่อตาราง
-- ส่วนแบบที่ 2 จะต้องเขียนชื่อตารางแบบเต็มทุกรายการ

SELECT tbl_product.id, tbl_product.product_name, tbl_product.product_price, tbl_product.product_image, tbl_type.type_name
FROM tbl_product
INNER JOIN tbl_type 
ON tbl_product.ref_type_id = tbl_type.type_name
GROUP by tbl_product.id

--------------------------------
จำนวนผู้เข้าชมเว็บไซต์ทั้งหมด
SELECT COUNT(*) as totalView FROM tbl_counter

จำนวนสมาชิก
SELECT COUNT(*) as totalMember FROM tbl_member

จำนวนสินค้า
SELECT COUNT(*) as totalProduct FROM tbl_product

-----------------------------------------

SELECT DATE_FORMAT(c_date,'%d/%m/%Y') as datesave,  COUNT(*) as total 
FROM tbl_counter
GROUP BY DATE_FORMAT(c_date,'%Y-%m-%d')
ORDER BY DATE_FORMAT(c_date,'%Y-%m-%d') DESC

---------------------------------------
แสดงจำนวนผู้ชมเว็บไซต์แยกเป็นรายเดือน
SELECT MONTHNAME(c_date) as monthNames, COUNT(*) as totalByMonth
FROM tbl_counter
GROUP BY MONTH(c_date)
ORDER BY DATE_FORMAT(c_date, '%Y-%m') DESC;

แสดงจำนวนผู้ชมเว็บไซต์แยกเป็นรายปี
SELECT YEAR(c_date) as years, COUNT(*) as totalByYear
FROM tbl_counter
GROUP BY YEAR(c_date)
ORDER BY YEAR(c_date) DESC;