<?php
if (isset($_GET['id']) && $_GET['act'] == 'edit') {

    //single row query แสดงแค่ 1 รายการ   
    $stmtbuildingDetail = $condb->prepare("SELECT * FROM tbl_building WHERE building_id=?");
    $stmtbuildingDetail->execute([$_GET['id']]);
    $row = $stmtbuildingDetail->fetch(PDO::FETCH_ASSOC);

    // echo '<pre>';
    // print_r($row);    
    // exit;
    // echo $stmtbuildingDetail->rowCount();
    // exit;

    //ถ้าคิวรี่ผิดพลาดให้หยุดการทำงาน
    if ($stmtbuildingDetail->rowCount() != 1) {
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
                    <h1>แก้ไขชื่อตึก/อาคาร</h1>
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
                                    <label class="col-sm-2">ชื่อตึก/อาคาร</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="building_name" class="form-control" required
                                            placeholder="ชื่อตึก/อาคาร" value="<?php echo $row['building_name']; ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2"></label>
                                    <div class="col-sm-4">
                                        <input type="hidden" name="building_id"
                                            value="<?php echo $row['building_id']; ?>">
                                        <button building="submit" class="btn btn-primary"> ปรับปรุงข้อมูล </button>
                                        <a href="building.php" class="btn btn-danger">ยกเลิก</a>
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

if (isset($_POST['building_id']) && isset($_POST['building_name'])) {

    //trigger exception in a "try" block
    try {
        //ประกาศตัวแปรรับค่าจากฟอร์ม
        $building_id = $_POST['building_id'];
        $building_name = $_POST['building_name'];

        //sql update
        $stmtUpdate = $condb->prepare("UPDATE tbl_building SET 
                    building_name=:building_name
                    WHERE building_id=:building_id
                    ");
        //bindParam
        $stmtUpdate->bindParam(':building_id', $building_id, PDO::PARAM_INT);
        $stmtUpdate->bindParam(':building_name', $building_name, PDO::PARAM_STR);

        $result = $stmtUpdate->execute();

        $condb = null; //close connect db

        if ($result) {
            echo '<script>
                             setTimeout(function() {
                              swal({
                                  title: "แก้ไขข้อมูลสำเร็จ",
                                  type: "success"
                              }, function() {
                                  window.location = "building.php";
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
              window.location = "building.php"; //หน้าที่ต้องการให้กระโดดไป
          });
        }, 1000);
    </script>';
    } //catch


} //isset

//window.location = "building.php?id='.$id.'&act=edit"; //หน้าที่ต้องการให้กระโดดไป
?>