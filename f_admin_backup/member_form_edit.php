<?php
if (isset($_GET['id']) && $_GET['act'] == 'edit') {

    //sigle row query แสดงแค่ 1 รายการ เหมาะกับหน้าฟอร์มแก้ไข
    $stmtMemberDetail = $condb->prepare("SELECT * FROM tbl_member WHERE id=?");
    $stmtMemberDetail->execute([$_GET['id']]);
    $row = $stmtMemberDetail->fetch(PDO::FETCH_ASSOC);

    //ถ้าคิวรี่ผิดพลาดให้หยุดการทำงาน
    if ($stmtMemberDetail->rowCount() != 1) {
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
                                            <select name="m_level" class="form-control" required>
                                                <option value="<?php echo $row['m_level']; ?>">
                                                    <?php echo $row['m_level']; ?> </option>
                                                <option disabled>กรุณาเลือกใหม่</option>
                                                <option value="admin">admin</option>
                                                <option value="staff">staff</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">Username</label>
                                        <div class="col-sm-4">
                                            <input type="username" name="username" class="form-control"
                                                value="<?php echo $row['username']; ?>" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">คำนำหน้า</label>
                                        <div class="col-sm-2">
                                            <select name="title_name" class="form-control" required>
                                                <option value="<?php echo $row['title_name']; ?>">
                                                    <?php echo $row['title_name']; ?> </option>
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
                                            <input type="text" name="firstname" class="form-control" required
                                                placeholder="ชื่อ" value="<?php echo $row['firstname']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">นามสกุล</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="lastname" class="form-control" required
                                                placeholder="นามสกุล" value="<?php echo $row['lastname']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2"></label>
                                        <div class="col-sm-4">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" class="btn btn-success">บันทึก</button>
                                            <a href="member.php" class="btn btn-danger">ยกเลิก</a>
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
if (isset($_POST['id']) && isset($_POST['firstname']) && isset($_POST['lastname'])) {
    //trigger exception in a "try" block
    try {

        //ประกาศตัวแปรรับค่าจากฟอร์ม
        $id = $_POST['id'];
        $title_name = $_POST['title_name'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $m_level = $_POST['m_level'];
        //sql update
        $stmtUpdate = $condb->prepare("UPDATE  tbl_member SET title_name=:title_name,firstname=:firstname, lastname=:lastname, m_level=:m_level
     WHERE id=:id");

        //bindParam
        $stmtUpdate->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtUpdate->bindParam(':title_name', $title_name, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':m_level', $m_level, PDO::PARAM_STR);
        $result = $stmtUpdate->execute();

        $condb = null;
        if ($result) {
            echo '<script>
        setTimeout(function() {
        swal({
        title: "แก้ไขข้อมูลสำเร็จ",
        type: "success"
        }, function() {
        window.location = "member.php"; //หน้าที่ต้องการให้กระโดดไป
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
                                  window.location = "member.php"; //หน้าที่ต้องการให้กระโดดไป
                              });
                            }, 1000);
                        </script>';
    } //catch
}
?>

<!-- window.location = "member.php?id=' . $id . '&act=edit"; //หน้าที่ต้องการให้กระโดดไป (เมื่อแก้ไขข้อมูลเสร็จแล้ว จะยังอยู่หน้าแก้ไขข้อมูลโดยไม่เด้งไปที่หน้าตาราง member.php)-->