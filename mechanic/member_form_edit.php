<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>แก้ไขข้อมูลส่วนตัว</h1>
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
                                        <label class="col-sm-2">รหัสพนักงาน</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="member_id" class="form-control"
                                                value="<?php echo $memberData['member_id']; ?>" readonly>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-2">สิทธิ์การใช้งาน</label>
                                        <div class="col-sm-2">
                                            <select name="ref_level_id" class="form-control" disabled>
                                                <?php foreach ($rsLevel as $rowlev): ?>
                                                    <option value="<?= htmlspecialchars($rowlev['level_id']); ?>">
                                                        <?= htmlspecialchars($rowlev['level_name']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">Username</label>
                                        <div class="col-sm-4">
                                            <input type="username" name="username" class="form-control"
                                                value="<?php echo $memberData['username']; ?>" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">คำนำหน้า</label>
                                        <div class="col-sm-2">
                                            <select name="title_name" class="form-control" required>
                                                <option value="<?php echo $memberData['title_name']; ?>">
                                                    <?php echo $memberData['title_name']; ?> </option>
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
                                                placeholder="ชื่อ" value="<?php echo $memberData['firstname']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">นามสกุล</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="lastname" class="form-control" required
                                                placeholder="นามสกุล" value="<?php echo $memberData['lastname']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">แผนก</label>
                                        <div class="col-sm-2">
                                            <select name="ref_department_id" class="form-control" disabled>
                                                <option disabled>กรุณาเลือกใหม่</option>
                                                <?php foreach ($rsDepartment as $rowdpm): ?>
                                                    <option value="<?= htmlspecialchars($rowdpm['department_id']); ?>">
                                                        <?= htmlspecialchars($rowdpm['department_name']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">ตำแหน่ง</label>
                                        <div class="col-sm-2">
                                            <select name="ref_position_id" class="form-control" disabled>
                                                <option disabled>กรุณาเลือกใหม่</option>
                                                <?php foreach ($rsPosition as $rowpst): ?>
                                                    <option value="<?= htmlspecialchars($rowpst['position_id']); ?>">
                                                        <?= htmlspecialchars($rowpst['position_name']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">เบอร์โทร</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="m_tel" class="form-control" required
                                                placeholder="เบอร์โทร" value="<?php echo $memberData['m_tel']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">Email</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="m_email" class="form-control" required
                                                placeholder="Email" value="<?php echo $memberData['m_email']; ?>">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-2"></label>
                                        <div class="col-sm-4">
                                            <input type="hidden" name="m_id" value="<?php echo $memberData['m_id']; ?>">
                                            <button type="submit" class="btn btn-success">บันทึก</button>
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
if (isset($_POST['m_id']) && isset($_POST['firstname']) && isset($_POST['lastname'])) {
    //trigger exception in a "try" block
    try {

        //ประกาศตัวแปรรับค่าจากฟอร์ม
        $m_id = $_POST['m_id'];
        $member_id = $_POST['member_id'];
        $ref_level_id = $_POST['ref_level_id'];
        $username = $_POST['username'];
        $title_name = $_POST['title_name'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $ref_department_id = $_POST['ref_department_id'];
        $ref_position_id = $_POST['ref_position_id'];
        $m_tel = $_POST['m_tel'];
        $m_email = $_POST['m_email'];

        //sql update
        $stmtUpdate = $condb->prepare("UPDATE tbl_member SET m_id=:m_id, member_id=:member_id, ref_level_id=:ref_level_id ,title_name=:title_name,firstname=:firstname, lastname=:lastname, ref_department_id=:ref_department_id, ref_position_id=:ref_position_id, m_tel=:m_tel, m_email=:m_email
     WHERE m_id=:m_id");

        //bindParam
        $stmtUpdate->bindParam(':m_id', $m_id, PDO::PARAM_INT);
        $stmtUpdate->bindParam(':member_id', $member_id, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':ref_level_id', $ref_level_id, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':username', $username, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':title_name', $title_name, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':ref_department_id', $ref_department_id, PDO::PARAM_INT);
        $stmtUpdate->bindParam(':ref_position_id', $ref_position_id, PDO::PARAM_INT);
        $stmtUpdate->bindParam(':m_tel', $m_tel, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':m_email', $m_email, PDO::PARAM_STR);
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