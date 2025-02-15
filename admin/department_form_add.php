  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>เพิ่มชื่อแผนก </h1>
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
                                              placeholder="ชื่อแผนก">
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label class="col-sm-2"></label>
                                      <div class="col-sm-4">
                                          <button type="submit" class="btn btn-primary"> เพิ่มข้อมูล </button>
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
    //เช็ค input ที่ส่งมาจากฟอร์ม
    // echo '<pre>';
    // print_r($_POST);
    // exit;

    if (isset($_POST['department_name'])) {
        //echo 'ถูกเงื่อนไข ส่งข้อมูลมาได้';

        //trigger exception in a "try" block
        try {

            //ประกาศตัวแปรรับค่าจากฟอร์ม
            $department_name = $_POST['department_name'];
            //เช็ค department_name ซ้ำ
            //single row query แสดงแค่ 1 รายการ   
            $stmtdepartmentDetail = $condb->prepare("SELECT department_name FROM tbl_department 
                      WHERE department_name=:department_name
                      ");
            //bindParam
            $stmtdepartmentDetail->bindParam(':department_name', $department_name, PDO::PARAM_STR);
            $stmtdepartmentDetail->execute();
            $row = $stmtdepartmentDetail->fetch(PDO::FETCH_ASSOC);

            //นับจำนวนการคิวรี่ ถ้าได้ 1 คือ department_name ซ้ำ
            // echo $stmtdepartmentDetail->rowCount();
            // echo '<hr>';
            if ($stmtdepartmentDetail->rowCount() == 1) {
                //echo 'department_name ซ้ำ';
                echo '<script>
                        setTimeout(function() {
                          swal({
                              title: "ชื่อแผนกซ้ำ !!",
                              text: "กรุณาเพิ่มข้อมูลใหม่อีกครั้ง",
                              department: "error"
                          }, function() {
                              window.location = "department.php?act=add"; //หน้าที่ต้องการให้กระโดดไป
                          });
                        }, 1000);
                    </script>';
            } else {
                //echo 'ไม่มี department_name ซ้ำ';
                //sql insert
                $stmtInsertdepartment = $condb->prepare("INSERT INTO tbl_department 
                    (department_name)
                    VALUES 
                    (:department_name)
                    ");

                //bindParam
                $stmtInsertdepartment->bindParam(':department_name', $department_name, PDO::PARAM_STR);
                $result = $stmtInsertdepartment->execute();

                $condb = null; //close connect db
                if ($result) {
                    echo '<script>
                              setTimeout(function() {
                                swal({
                                    title: "เพิ่มข้อมูลสำเร็จ",
                                    type: "success"
                                }, function() {
                                    window.location = "department.php"; //หน้าที่ต้องการให้กระโดดไป
                                });
                              }, 1000);
                          </script>';
                }
            } //เช็คข้อมูลซ้ำ                         
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
                                  window.location = "department.php"; //หน้าที่ต้องการให้กระโดดไป
                              });
                            }, 1000);
                        </script>';
        } //catch
    } //isset
    ?>