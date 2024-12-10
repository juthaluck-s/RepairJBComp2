<?php
// ตรวจสอบว่ามีการส่งค่ามาครบถ้วน
if (isset($_POST['submit']) && isset($_POST['m_id']) && isset($_GET['id'])) {
    $m_id = $_POST['m_id']; // ID ของช่างที่เลือก
    $case_id = $_GET['id']; // ID ของงาน

    // เชื่อมต่อฐานข้อมูล
    require '../config/condb.php';

    // อัปเดตสถานะของงาน
    $stmtUpdate = $condb->prepare("UPDATE tbl_case 
                                  SET ref_m_id = :m_id, ref_status_id = 2 -- กำลังซ่อม
                                  WHERE case_id = :case_id");
    $stmtUpdate->bindParam(':m_id', $m_id, PDO::PARAM_INT);
    $stmtUpdate->bindParam(':case_id', $case_id, PDO::PARAM_INT);

    if ($stmtUpdate->execute()) {
        echo "<script>
            alert('Assign งานสำเร็จ');
            window.location.href = 'case.php'; // กลับไปยังหน้า case.php
        </script>";
    } else {
        echo "<script>
            alert('เกิดข้อผิดพลาด ไม่สามารถ Assign งานได้');
            window.history.back(); // กลับไปหน้าก่อนหน้า
        </script>";
    }
} else {
    echo "<script>
        alert('ข้อมูลไม่ครบถ้วน');
        window.history.back();
    </script>";
}