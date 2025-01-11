<?php
if (isset($_GET['id']) && $_GET['act'] == 'edit') {

    //single row query แสดงแค่ 1 รายการ   
    $stmtdepartmentDetail = $condb->prepare("SELECT * FROM tbl_department WHERE department_id=?");
    $stmtdepartmentDetail->execute([$_GET['id']]);
    $row = $stmtdepartmentDetail->fetch(PDO::FETCH_ASSOC);

    // echo '<pre>';
    // print_r($row);    
    // exit;
    // echo $stmtdepartmentDetail->rowCount();
    // exit;

    //ถ้าคิวรี่ผิดพลาดให้หยุดการทำงาน
    if ($stmtdepartmentDetail->rowCount() != 1) {
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
                    <h1>แก้ไขชื่อแผนก</h1>
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
                                        <label class="col-sm-2">ชื่อแผนก</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="department_name" class="form-control" required
                                                placeholder="ชื่อแผนก" value="<?php echo $row['department_name']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2"></label>
                                        <div class="col-sm-4">
                                            <input type="hidden" name="department_id"
                                                value="<?php echo $row['department_id']; ?>">
                                            <button type="submit" class="btn btn-primary"> ปรับปรุงข้อมูล
                                            </button>
                                            <a href="department.php" class="btn btn-danger">ยกเลิก</a>
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

if (isset($_POST['department_id']) && isset($_POST['department_name'])) {

    //trigger exception in a "try" block
    try {
        //ประกาศตัวแปรรับค่าจากฟอร์ม
        $department_id = $_POST['department_id'];
        $department_name = $_POST['department_name'];

        //sql update
        $stmtUpdate = $condb->prepare("UPDATE tbl_department SET 
                    department_name=:department_name
                    WHERE department_id=:department_id
                    ");
        //bindParam
        $stmtUpdate->bindParam(':department_id', $department_id, PDO::PARAM_INT);
        $stmtUpdate->bindParam(':department_name', $department_name, PDO::PARAM_STR);

        $result = $stmtUpdate->execute();

        $condb = null; //close connect db

        if ($result) {
            echo '<script>
                             setTimeout(function() {
                              swal({
                                  title: "แก้ไขข้อมูลสำเร็จ",
                                  type: "success"
                              }, function() {
                                  window.location = "department.php";
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
              window.location = "department.php"; //หน้าที่ต้องการให้กระโดดไป
          });
        }, 1000);
    </script>';
    } //catch


} //isset

//window.location = "department.php?id='.$id.'&act=edit"; //หน้าที่ต้องการให้กระโดดไป
?>