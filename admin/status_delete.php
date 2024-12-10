<?php

if (isset($_GET['id']) && $_GET['act'] == 'delete') {


    //trigger exception in a "try" block
    try {

        $id = $_GET['id'];
        //echo $id;

        $stmtDelstatus = $condb->prepare('DELETE FROM tbl_status WHERE status_id=:id');
        $stmtDelstatus->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtDelstatus->execute();

        $condb = null; //close connect db
        //echo 'จำนวน row ที่ลบได้ ' .$stmtDelstatus->rowCount();
        if ($stmtDelstatus->rowCount() == 1) {
            echo '<script>
         setTimeout(function() {
          swal({
              title: "ลบข้อมูลสำเร็จ",
              type: "success"
          }, function() {
              window.location = "status.php"; //หน้าที่ต้องการให้กระโดดไป
          });
        }, 1000);
    </script>';
            exit;
        }
    } //try
    //catch exception
    catch (Exception $e) {
        //echo 'Message: ' .$e->getMessage();
        echo '<script>
         setTimeout(function() {
          swal({
              title: "เกิดข้อผิดพลาด",
              type: "error"
          }, function() {
              window.location = "status.php"; //หน้าที่ต้องการให้กระโดดไป
          });
        }, 1000);
    </script>';
    } //catch
} //isset