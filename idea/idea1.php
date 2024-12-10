<?php
if (isset($_POST['update_status'])) {
    // รับค่าจากฟอร์ม
    $case_id = $_POST['case_id'];
    $status_id = $_POST['status_id']; // สถานะใหม่
    $mechanic_name = "นายช่าง"; // ชื่อนายช่างที่ต้องการเพิ่มในตาราง employee

    // อัปเดตสถานะในตาราง tbl_case
    $updateCase = $condb->prepare("UPDATE tbl_case SET ref_status_id = :status_id WHERE case_id = :case_id");
    $updateCase->bindParam(':status_id', $status_id, PDO::PARAM_INT);
    $updateCase->bindParam(':case_id', $case_id, PDO::PARAM_INT);
    $updateCase->execute();

    // อัปเดตสถานะในตาราง tbl_employee
    $updateEmployee = $condb->prepare("UPDATE tbl_employee SET status_id = :status_id, mechanic_name = :mechanic_name WHERE ref_case_id = :case_id");
    $updateEmployee->bindParam(':status_id', $status_id, PDO::PARAM_INT);
    $updateEmployee->bindParam(':mechanic_name', $mechanic_name, PDO::PARAM_STR);
    $updateEmployee->bindParam(':case_id', $case_id, PDO::PARAM_INT);
    $updateEmployee->execute();

    // ตรวจสอบผลลัพธ์
    if ($updateCase && $updateEmployee) {
        echo "สถานะถูกอัปเดตเรียบร้อยแล้ว!";
    } else {
        echo "เกิดข้อผิดพลาดในการอัปเดตสถานะ";
    }
}


// update ข้อมูลการเปลี่ยนสถานะในตารางอื่นๆ