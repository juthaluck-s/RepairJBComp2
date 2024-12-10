<?php

if (isset($_GET['id']) && $_GET['act'] == 'delete') {


    //trigger exception in a "try" block
    try {

        $id = $_GET['id'];
        //echo $id;

        $stmtDelposition = $condb->prepare('DELETE FROM tbl_position WHERE position_id=:id');
        $stmtDelposition->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtDelposition->execute();

        $condb = null; //close connect db
        //echo 'จำนวน row ที่ลบได้ ' .$stmtDelposition->rowCount();
        if ($stmtDelposition->rowCount() == 1) {
            echo '<script>
         setTimeout(function() {
          swal({
              title: "ลบข้อมูลสำเร็จ",
              type: "success"
          }, function() {
              window.location = "position.php"; //หน้าที่ต้องการให้กระโดดไป
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
              window.location = "position.php"; //หน้าที่ต้องการให้กระโดดไป
          });
        }, 1000);
    </script>';
    } //catch
} //isset