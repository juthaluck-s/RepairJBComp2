<?php
if (isset($_GET['id']) && $_GET['act'] == 'edit') {

    //single row query แสดงแค่ 1 รายการ   
    $stmtpositionDetail = $condb->prepare("SELECT * FROM tbl_position WHERE position_id=?");
    $stmtpositionDetail->execute([$_GET['id']]);
    $row = $stmtpositionDetail->fetch(PDO::FETCH_ASSOC);

    // echo '<pre>';
    // print_r($row);    
    // exit;
    // echo $stmtpositionDetail->rowCount();
    // exit;

    //ถ้าคิวรี่ผิดพลาดให้หยุดการทำงาน
    if ($stmtpositionDetail->rowCount() != 1) {
        exit();
    }
} //isset
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>แก้ไขชื่อตำแหน่ง</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-body">
                        
                            <!-- form start -->
                            <form action="" method="post">
                                <div class="card-body">

                                    <div class="form-group row">
                                        <label class="col-sm-2">ชื่อตำแหน่ง</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="position_name" class="form-control" required
                                                placeholder="ชื่อตำแหน่ง" value="<?php echo $row['position_name']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2"></label>
                                        <div class="col-sm-4">
                                            <input type="hidden" name="position_id"
                                                value="<?php echo $row['position_id']; ?>">
                                            <button type="submit" class="btn btn-primary"> ปรับปรุงข้อมูล </button>
                                            <a href="position.php" class="btn btn-danger">ยกเลิก</a>
                                        </div>
                                    </div>

                                </div> <!-- /.card-body -->

                            </form>

                            <?php

                            // echo '<pre>';
                            // print_r($_POST);
                            // exit;

                            ?>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
// echo '<pre>';
// print_r($_POST);
//exit;

if (isset($_POST['position_id']) && isset($_POST['position_name'])) {

    //trigger exception in a "try" block
    try {
        //ประกาศตัวแปรรับค่าจากฟอร์ม
        $position_id = $_POST['position_id'];
        $position_name = $_POST['position_name'];

        //sql update
        $stmtUpdate = $condb->prepare("UPDATE tbl_position SET 
                    position_name=:position_name
                    WHERE position_id=:position_id
                    ");
        //bindParam
        $stmtUpdate->bindParam(':position_id', $position_id, PDO::PARAM_INT);
        $stmtUpdate->bindParam(':position_name', $position_name, PDO::PARAM_STR);

        $result = $stmtUpdate->execute();

        $condb = null; //close connect db

        if ($result) {
            echo '<script>
                             setTimeout(function() {
                              swal({
                                  title: "แก้ไขข้อมูลสำเร็จ",
                                  type: "success"
                              }, function() {
                                  window.location = "position.php";
                              });
                            }, 1000);
                        </script>';
        }
    } //try
    //catch exception
    catch (Exception $e) {
        //echo 'Message: ' .$e->getMessage();
        echo '<script>
         setTimeout(function() {
          swal({
              title: "เกิดข้อผิดพลาด || ข้อมูลซ้ำ !!",
              type: "error"
          }, function() {
              window.location = "position.php"; //หน้าที่ต้องการให้กระโดดไป
          });
        }, 1000);
    </script>';
    } //catch


} //isset

//window.location = "position.php?id='.$id.'&act=edit"; //หน้าที่ต้องการให้กระโดดไป
?>