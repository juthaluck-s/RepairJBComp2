<?php
if (isset($_GET['m_id']) && $_GET['act'] == 'delete') {

    //trigger exception in a "try" block
    try {

        $m_id = $_GET['m_id'];
        // echo $id;


        $stmtDelMember = $condb->prepare('DELETE FROM tbl_member WHERE m_id=:m_id');
        $stmtDelMember->bindParam(':m_id', $m_id, PDO::PARAM_INT);
        $stmtDelMember->execute();

        // echo $stmtDeMember->rowCount();
        $condb = null;
        if ($stmtDelMember->rowCount() == 1) {
            echo '<script>
             setTimeout(function() {
              swal({
                  title: "ลบข้อมูลสำเร็จ",
                  type: "success"
              }, function() {
                  window.location = "member.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
            exit();
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
                                  window.location = "member.php"; //หน้าที่ต้องการให้กระโดดไป
                              });
                            }, 1000);
                        </script>';
    } //catch
}
