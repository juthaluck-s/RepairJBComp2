<?php
if (isset($_POST['submit'])) {
    // รับค่าจาก textarea
    $case_update_log = $_POST['case_update_log'];
    $case_id = $_GET['id'];  // รับค่า case_id จาก URL
    

    // ตรวจสอบข้อมูลจาก textarea
    if (!empty($case_update_log)) {
        // สมมุติว่า tbl_case_update_log ใช้สำหรับเก็บข้อมูลการอัปเดต
        try {
            // สร้างคำสั่ง SQL เพื่อบันทึก log
            $stmtCaseupdatelog = $condb->prepare("INSERT INTO tbl_case
            (case_id,  case_update_log, case_update) 
                                     VALUES (:case_id, :case_update_log, NOW())");
            $stmtCaseupdatelog->bindParam(':case_id', $case_id, PDO::PARAM_INT);
           
            $stmtCaseupdatelog->bindParam(':case_update_log', $case_update_log, PDO::PARAM_STR);

            // Execute การบันทึก log
            if ($stmtCaseupdatelog->execute()) {
                echo "<script>
                        alert('บันทึกส่งงานสำเร็จ');
                        window.location.href = 'case.php'; // กลับไปยังหน้า case.php หรือหน้าที่ต้องการ
                      </script>";
            } else {
                echo "<script>
                        alert('เกิดข้อผิดพลาดในการบันทึก');
                        window.history.back(); // กลับไปหน้าก่อนหน้า
                      </script>";
            }
        } catch (PDOException $e) {
            // หากเกิดข้อผิดพลาด
            echo "<script>
                    alert('เกิดข้อผิดพลาด: " . $e->getMessage() . "');
                    window.history.back();
                  </script>";
        }
    } else {
        echo "<script>
                alert('กรุณากรอกข้อมูลในฟอร์ม');
                window.history.back();
              </script>";
    }
}
?>
