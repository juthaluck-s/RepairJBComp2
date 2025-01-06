  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>เพิ่มสิทธิ์การใช้งาน</h1>
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
                          <div class="card card-primary">
                              <!-- form start -->
                              <form action="" method="post">
                                  <div class="card-body">

                                      <div class="form-group row">
                                          <label class="col-sm-2">สิทธิ์การใช้งาน</label>
                                          <div class="col-sm-4">
                                              <input type="text" name="level_name" class="form-control" required
                                                  placeholder="ชื่อตำแหน่ง">
                                          </div>
                                      </div>

                                      <div class="form-group row">
                                          <label class="col-sm-2"></label>
                                          <div class="col-sm-4">
                                              <button type="submit" class="btn btn-primary"> เพิ่มข้อมูล </button>
                                              <a href="level.php" class="btn btn-danger">ยกเลิก</a>
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

    if (isset($_POST['level_name'])) {
        //echo 'ถูกเงื่อนไข ส่งข้อมูลมาได้';

        //trigger exception in a "try" block
        try {

            //ประกาศตัวแปรรับค่าจากฟอร์ม
            $level_name = $_POST['level_name'];
            //เช็ค level_name ซ้ำ
            //single row query แสดงแค่ 1 รายการ   
            $stmtlevelDetail = $condb->prepare("SELECT level_name FROM tbl_level 
                      WHERE level_name=:level_name
                      ");
            //bindParam
            $stmtlevelDetail->bindParam(':level_name', $level_name, PDO::PARAM_STR);
            $stmtlevelDetail->execute();
            $row = $stmtlevelDetail->fetch(PDO::FETCH_ASSOC);

            //นับจำนวนการคิวรี่ ถ้าได้ 1 คือ level_name ซ้ำ
            // echo $stmtlevelDetail->rowCount();
            // echo '<hr>';
            if ($stmtlevelDetail->rowCount() == 1) {
                //echo 'level_name ซ้ำ';
                echo '<script>
                        setTimeout(function() {
                          swal({
                              title: "ชื่อตำแหน่งซ้ำ !!",
                              text: "กรุณาเพิ่มข้อมูลใหม่อีกครั้ง",
                              type: "error"
                          }, function() {
                              window.location = "level.php?act=add"; //หน้าที่ต้องการให้กระโดดไป
                          });
                        }, 1000);
                    </script>';
            } else {
                //echo 'ไม่มี level_name ซ้ำ';
                //sql insert
                $stmtInsertlevel = $condb->prepare("INSERT INTO tbl_level 
                    (level_name)
                    VALUES 
                    (:level_name)
                    ");

                //bindParam
                $stmtInsertlevel->bindParam(':level_name', $level_name, PDO::PARAM_STR);
                $result = $stmtInsertlevel->execute();

                $condb = null; //close connect db
                if ($result) {
                    echo '<script>
                              setTimeout(function() {
                                swal({
                                    title: "เพิ่มข้อมูลสำเร็จ",
                                    type: "success"
                                }, function() {
                                    window.location = "level.php"; //หน้าที่ต้องการให้กระโดดไป
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
                                  window.location = "level.php"; //หน้าที่ต้องการให้กระโดดไป
                              });
                            }, 1000);
                        </script>';
        } //catch
    } //isset
    ?>