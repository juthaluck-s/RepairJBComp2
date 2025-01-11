<?php
if (isset($_GET['m_id']) && $_GET['act'] == 'editPwd') {

    //sigle row query แสดงแค่ 1 รายการ เหมาะกับหน้าฟอร์มแก้ไข
    $stmtMemberDetail = $condb->prepare("SELECT * FROM tbl_member WHERE m_id=?");
    $stmtMemberDetail->execute([$_GET['m_id']]);
    $memberData = $stmtMemberDetail->fetch(PDO::FETCH_ASSOC);

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
                    <h1>แก้ไขรหัสผ่าน</h1>
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
                                    <label class="col-sm-2">Username</label>
                                    <div class="col-sm-4">
                                        <input type="username" name="username" class="form-control"
                                            value="<?php echo $memberData['username']; ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2">ชื่อ-สกุล</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="firstname" class="form-control" required
                                            placeholder="ชื่อ"
                                            value="<?php echo $memberData['title_name'] . $memberData['firstname'] . ' ' . $memberData['lastname']; ?>"
                                            disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2">New Password</label>
                                    <div class="col-sm-4">
                                        <input type="password" name="NewPassword" class="form-control" required
                                            placeholder="New Password">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2">Confirm Password</label>
                                    <div class="col-sm-4">
                                        <input type="password" name="ConfirmPassword" class="form-control" required
                                            placeholder="Confirm Password">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2"></label>
                                    <div class="col-sm-4">
                                        <input type="hidden" name="m_id" value="<?php echo $memberData['m_id']; ?>">
                                        <button type="submit" class="btn btn-primary">แก้ไขรหัสผ่าน</button>
                                        <a href="case.php" class="btn btn-danger">ยกเลิก</a>
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
if (isset($_POST['m_id']) && isset($_POST['NewPassword']) && isset($_POST['ConfirmPassword'])) {
    //trigger exception in a "try" block
    try {
        //ประกาศตัวแปรรับค่าจากฟอร์ม
        $id = $_POST['m_id'];

        $NewPassword = $_POST['NewPassword'];
        $ConfirmPassword = $_POST['ConfirmPassword'];

        //สร้างเงื่อนไขตรวจสอบรหัสผ่านว่าตรงกันไหม
        if ($NewPassword != $ConfirmPassword) {
            //echo 'รหัสผ่านไม่ตรงกัน';
            echo '<script>
        setTimeout(function() {
        swal({
        title: "รหัสผ่านไม่ตรงกัน !!",
        text: "กรุณากรอกรหัสผ่านใหม่อีกครั้ง",
        type: "error"
        }, function() {
        window.location = "member.php?id=' . $id . '&act=password"; //หน้าที่ต้องการให้กระโดดไป
        });
        }, 1000);
        </script>';
        } else {
            // echo 'รหัสผ่านตรงกัน';
            $password = sha1($_POST['NewPassword']);

            //sql update
            $stmtUpdate = $condb->prepare("UPDATE  tbl_member SET password=:password WHERE m_id=:id");


            //bindParam
            $stmtUpdate->bindParam(':id', $id, PDO::PARAM_INT);
            $stmtUpdate->bindParam(':password', $password, PDO::PARAM_STR);
            $result = $stmtUpdate->execute();

            $condb = null;
            if ($result) {
                echo '<script>
        setTimeout(function() {
        swal({
        title: "แก้ไขรหัสผ่านสำเร็จ",
        type: "success"
        }, function() {
        window.location = "case.php"; //หน้าที่ต้องการให้กระโดดไป
        });
        }, 1000);
        </script>';
            } else {
                echo '<script>
        setTimeout(function() {
        swal({
        title: "เกิดข้อผิดพลาด",
        type: "error"
        }, function() {
        window.location = member.php?id=' . $id . '&act=password"; //หน้าที่ต้องการให้กระโดดไป
        });
        }, 1000);
        </script>';
            }
        } //check password
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

<!-- window.location = "member.php?id=' . $id . '&act=editPwd"; //หน้าที่ต้องการให้กระโดดไป (เมื่อแก้ไขข้อมูลเสร็จแล้ว จะยังอยู่หน้าแก้ไขข้อมูลโดยไม่เด้งไปที่หน้าตาราง member.php)-->