<?php
if (isset($_GET['id']) && $_GET['act'] == 'edit') {

    //single row query แสดงแค่ 1 รายการ   
    $stmtequipmentDetail = $condb->prepare("SELECT * FROM tbl_equipment WHERE equipment_id=?");
    $stmtequipmentDetail->execute([$_GET['id']]);
    $row = $stmtequipmentDetail->fetch(PDO::FETCH_ASSOC);

    // echo '<pre>';
    // print_r($row);    
    // exit;
    // echo $stmtequipmentDetail->rowCount();
    // exit;

    //ถ้าคิวรี่ผิดพลาดให้หยุดการทำงาน
    if ($stmtequipmentDetail->rowCount() != 1) {
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
                    <h1>แก้ไขชื่ออุปกรณ์</h1>
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
                                        <label class="col-sm-2">ชื่ออุปกรณ์</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="equipment_name" class="form-control" required
                                                placeholder="ชื่ออุปกรณ์" value="<?php echo $row['equipment_name']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2"></label>
                                        <div class="col-sm-4">
                                            <input type="hidden" name="equipment_id"
                                                value="<?php echo $row['equipment_id']; ?>">
                                            <button type="submit" class="btn btn-primary"> ปรับปรุงข้อมูล </button>
                                            <a href="equipment.php" class="btn btn-danger">ยกเลิก</a>
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

if (isset($_POST['equipment_id']) && isset($_POST['equipment_name'])) {

    //trigger exception in a "try" block
    try {
        //ประกาศตัวแปรรับค่าจากฟอร์ม
        $equipment_id = $_POST['equipment_id'];
        $equipment_name = $_POST['equipment_name'];

        //sql update
        $stmtUpdateequipment = $condb->prepare("UPDATE tbl_equipment SET 
                    equipment_name=:equipment_name
                    WHERE equipment_id=:equipment_id
                    ");
        //bindParam
        $stmtUpdateequipment->bindParam(':equipment_id', $equipment_id, PDO::PARAM_INT);
        $stmtUpdateequipment->bindParam(':equipment_name', $equipment_name, PDO::PARAM_STR);

        $result = $stmtUpdateequipment->execute();

        $condb = null; //close connect db

        if ($result) {
            echo '<script>
                             setTimeout(function() {
                              swal({
                                  title: "แก้ไขข้อมูลสำเร็จ",
                                  type: "success"
                              }, function() {
                                  window.location = "equipment.php";
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
              window.location = "equipment.php"; //หน้าที่ต้องการให้กระโดดไป
          });
        }, 1000);
    </script>';
    } //catch


} //isset

//window.location = "equipment.php?id='.$id.'&act=edit"; //หน้าที่ต้องการให้กระโดดไป
?>