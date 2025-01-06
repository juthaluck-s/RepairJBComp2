  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>เพิ่มชื่อตำแหน่ง</h1>
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
                                          <label class="col-sm-2">ชื่อตำแหน่ง</label>
                                          <div class="col-sm-4">
                                              <input type="text" name="position_name" class="form-control" required
                                                  placeholder="ชื่อตำแหน่ง">
                                          </div>
                                      </div>

                                      <div class="form-group row">
                                          <label class="col-sm-2"></label>
                                          <div class="col-sm-4">
                                              <button type="submit" class="btn btn-primary"> เพิ่มข้อมูล </button>
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
    //เช็ค input ที่ส่งมาจากฟอร์ม
    // echo '<pre>';
    // print_r($_POST);
    // exit;

    if (isset($_POST['position_name'])) {
        //echo 'ถูกเงื่อนไข ส่งข้อมูลมาได้';

        //trigger exception in a "try" block
        try {

            //ประกาศตัวแปรรับค่าจากฟอร์ม
            $position_name = $_POST['position_name'];
            //เช็ค position_name ซ้ำ
            //single row query แสดงแค่ 1 รายการ   
            $stmtpositionDetail = $condb->prepare("SELECT position_name FROM tbl_position 
                      WHERE position_name=:position_name
                      ");
            //bindParam
            $stmtpositionDetail->bindParam(':position_name', $position_name, PDO::PARAM_STR);
            $stmtpositionDetail->execute();
            $row = $stmtpositionDetail->fetch(PDO::FETCH_ASSOC);

            //นับจำนวนการคิวรี่ ถ้าได้ 1 คือ position_name ซ้ำ
            // echo $stmtpositionDetail->rowCount();
            // echo '<hr>';
            if ($stmtpositionDetail->rowCount() == 1) {
                //echo 'position_name ซ้ำ';
                echo '<script>
                        setTimeout(function() {
                          swal({
                              title: "ชื่อตำแหน่งซ้ำ !!",
                              text: "กรุณาเพิ่มข้อมูลใหม่อีกครั้ง",
                              type: "error"
                          }, function() {
                              window.location = "position.php?act=add"; //หน้าที่ต้องการให้กระโดดไป
                          });
                        }, 1000);
                    </script>';
            } else {
                //echo 'ไม่มี position_name ซ้ำ';
                //sql insert
                $stmtInsertposition = $condb->prepare("INSERT INTO tbl_position 
                    (position_name)
                    VALUES 
                    (:position_name)
                    ");

                //bindParam
                $stmtInsertposition->bindParam(':position_name', $position_name, PDO::PARAM_STR);
                $result = $stmtInsertposition->execute();

                $condb = null; //close connect db
                if ($result) {
                    echo '<script>
                              setTimeout(function() {
                                swal({
                                    title: "เพิ่มข้อมูลสำเร็จ",
                                    type: "success"
                                }, function() {
                                    window.location = "position.php"; //หน้าที่ต้องการให้กระโดดไป
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
                                  window.location = "position.php"; //หน้าที่ต้องการให้กระโดดไป
                              });
                            }, 1000);
                        </script>';
        } //catch
    } //isset
    ?>