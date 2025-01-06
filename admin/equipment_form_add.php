  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>แก้ไขชื่ออุปกรณ์ </h1>
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
                                          <label class="col-sm-2">ชื่ออุปกรณ์</label>
                                          <div class="col-sm-4">
                                              <input type="text" name="equipment_name" class="form-control" required
                                                  placeholder="ชื่ออุปกรณ์">
                                          </div>
                                      </div>

                                      <div class="form-group row">
                                          <label class="col-sm-2"></label>
                                          <div class="col-sm-4">
                                              <button type="submit" class="btn btn-primary"> เพิ่มข้อมูล </button>
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
    //เช็ค input ที่ส่งมาจากฟอร์ม
    // echo '<pre>';
    // print_r($_POST);
    // exit;

    if (isset($_POST['equipment_name'])) {
        //echo 'ถูกเงื่อนไข ส่งข้อมูลมาได้';

        //trigger exception in a "try" block
        try {

            //ประกาศตัวแปรรับค่าจากฟอร์ม
            $equipment_name = $_POST['equipment_name'];
            //เช็ค equipment_name ซ้ำ
            //single row query แสดงแค่ 1 รายการ   
            $stmtequipmentDetail = $condb->prepare("SELECT equipment_name FROM tbl_equipment 
                      WHERE equipment_name=:equipment_name
                      ");
            //bindParam
            $stmtequipmentDetail->bindParam(':equipment_name', $equipment_name, PDO::PARAM_STR);
            $stmtequipmentDetail->execute();
            $row = $stmtequipmentDetail->fetch(PDO::FETCH_ASSOC);

            //นับจำนวนการคิวรี่ ถ้าได้ 1 คือ equipment_name ซ้ำ
            // echo $stmtequipmentDetail->rowCount();
            // echo '<hr>';
            if ($stmtequipmentDetail->rowCount() == 1) {
                //echo 'equipment_name ซ้ำ';
                echo '<script>
                        setTimeout(function() {
                          swal({
                              title: "ชื่ออุปกรณ์ซ้ำ !!",
                              text: "กรุณาเพิ่มข้อมูลใหม่อีกครั้ง",
                              type: "error"
                          }, function() {
                              window.location = "equipment.php?act=add"; //หน้าที่ต้องการให้กระโดดไป
                          });
                        }, 1000);
                    </script>';
            } else {
                //echo 'ไม่มี equipment_name ซ้ำ';
                //sql insert
                $stmtInsertequipment = $condb->prepare("INSERT INTO tbl_equipment 
                    (equipment_name)
                    VALUES 
                    (:equipment_name)
                    ");

                //bindParam
                $stmtInsertequipment->bindParam(':equipment_name', $equipment_name, PDO::PARAM_STR);
                $result = $stmtInsertequipment->execute();

                $condb = null; //close connect db
                if ($result) {
                    echo '<script>
                              setTimeout(function() {
                                swal({
                                    title: "เพิ่มข้อมูลสำเร็จ",
                                    type: "success"
                                }, function() {
                                    window.location = "equipment.php"; //หน้าที่ต้องการให้กระโดดไป
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
                                  window.location = "equipment.php"; //หน้าที่ต้องการให้กระโดดไป
                              });
                            }, 1000);
                        </script>';
        } //catch
    } //isset
    ?>