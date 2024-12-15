<?php
// เริ่มต้น session ก่อนการใช้งาน $_SESSION
session_start();

// ตรวจสอบว่ามีการส่งค่ามาครบถ้วน
if (isset($_POST['submit']) && isset($_POST['mec_id']) && isset($_GET['id'])) {
    $mec_id = $_POST['mec_id']; // ID ของช่างที่เลือก
    $case_id = $_GET['id']; // ID ของงาน

    // ดึงข้อมูล m_id ของผู้มอบหมายงานจาก session
    if (isset($_SESSION['staff_id'])) {
        $head_mechanic_id = $_SESSION['staff_id']; // ใช้ 'staff_id' จาก session เป็น head_mechanic_id
    } else {
        // ถ้าไม่มีการตั้งค่า session 'staff_id' จะแสดงข้อความแสดงข้อผิดพลาด
        echo "<script>
                alert('ไม่พบข้อมูลผู้มอบหมายงานใน session');
                window.history.back(); // กลับไปหน้าก่อนหน้า
              </script>";
        exit;
    }

    // เชื่อมต่อฐานข้อมูล
    require '../config/condb.php';

    try {
        // อัปเดตสถานะของงานและเก็บข้อมูลผู้มอบหมายงาน
        $stmtUpdate = $condb->prepare ("UPDATE tbl_case 
                                       SET ref_mec_id = :mec_id, ref_status_id = 2, ref_head_mechanic_id = :head_mechanic_id
                                       WHERE case_id = :case_id");
        $stmtUpdate->bindParam(':mec_id', $mec_id, PDO::PARAM_INT);
        $stmtUpdate->bindParam(':head_mechanic_id', $head_mechanic_id, PDO::PARAM_INT);  // ใช้ $head_mechanic_id จาก session
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
    } catch (PDOException $e) {
        // หากเกิดข้อผิดพลาดในการเชื่อมต่อหรือ query
        echo "<script>
                alert('เกิดข้อผิดพลาด: " . $e->getMessage() . "');
                window.history.back(); // กลับไปหน้าก่อนหน้า
              </script>";
    }
} else {
    // หากข้อมูลไม่ครบถ้วน
    echo "<script>
            alert('ข้อมูลไม่ครบถ้วน');
            window.history.back(); // กลับไปหน้าก่อนหน้า
          </script>";
}
?>
