<?php


?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ฟอร์มแก้ไขข้อมูลพนักงาน</h1>
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
                                        <div class="col-sm-2">
                                            <select name="m_level" class="form-control" disabled>
                                                <option value="<?php echo $MemberData['m_level']; ?>">
                                                    <?php echo $MemberData['m_level']; ?> </option>


                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">Username</label>
                                        <div class="col-sm-4">
                                            <input type="username" name="username" class="form-control"
                                                value="<?php echo $MemberData['username']; ?>" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">คำนำหน้า</label>
                                        <div class="col-sm-2">
                                            <select name="title_name" class="form-control" required>
                                                <option value="<?php echo $MemberData['title_name']; ?>">
                                                    <?php echo $MemberData['title_name']; ?> </option>
                                                <option disabled>กรุณาเลือกใหม่</option>
                                                <option value="นาย">นาย</option>
                                                <option value="นาง">นาง</option>
                                                <option value="นางสาว">นางสาว</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">ชื่อ</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="name" class="form-control" required
                                                placeholder="ชื่อ" value="<?php echo $MemberData['name']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">นามสกุล</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="surname" class="form-control" required
                                                placeholder="นามสกุล" value="<?php echo $MemberData['surname']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2"></label>
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-success">บันทึก</button>
                                            <a href="index.php" class="btn btn-danger">ยกเลิก</a>
                                        </div>

                                    </div>
                                </div>
                            </form>

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
if (isset($_SESSION['staff_id']) && isset($_POST['name']) && isset($_POST['surname'])) {
    //trigger exception in a "try" block
    try {

        //ประกาศตัวแปรรับค่าจากฟอร์ม
        $title_name = $_POST['title_name'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];

        //sql update
        $stmtUpdate = $condb->prepare("UPDATE  tbl_member SET title_name=:title_name,name=:name, surname=:surname
     WHERE id=:id");

        //bindParam
        $stmtUpdate->bindParam(':id', $_SESSION['staff_id'], PDO::PARAM_INT);
        $stmtUpdate->bindParam(':title_name', $title_name, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':name', $name, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':surname', $surname, PDO::PARAM_STR);

        $result = $stmtUpdate->execute();

        $condb = null;
        if ($result) {
            echo '<script>
        setTimeout(function() {
        swal({
        title: "แก้ไขข้อมูลสำเร็จ",
        type: "success"
        }, function() {
        window.location = "member.php?act=edit"; //หน้าที่ต้องการให้กระโดดไป
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
                                  title: "เกิดข้อผิดพลาด",
                                  type: "error"
                              }, function() {
                                  window.location = "member.php?act=edit"; //หน้าที่ต้องการให้กระโดดไป
                              });
                            }, 1000);
                        </script>';
    } //catch
}
?>

<!-- window.location = "member.php?id=' . $id . '&act=edit"; //หน้าที่ต้องการให้กระโดดไป (เมื่อแก้ไขข้อมูลเสร็จแล้ว จะยังอยู่หน้าแก้ไขข้อมูลโดยไม่เด้งไปที่หน้าตาราง member.php)-->