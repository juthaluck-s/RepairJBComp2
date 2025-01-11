<?php
//คิวรี่ข้อมูลแผนก, ตำแหน่ง
$queryDepartment = $condb->prepare("SELECT * FROM `tbl_department`");
$queryDepartment->execute();
$rsDepartment = $queryDepartment->fetchAll();

$queryPosition = $condb->prepare("SELECT * FROM `tbl_position`");
$queryPosition->execute();
$rsPosition = $queryPosition->fetchAll();

$queryLevel = $condb->prepare("SELECT * FROM `tbl_level`");
$queryLevel->execute();
$rsLevel = $queryLevel->fetchAll();


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>เพิ่มข้อมูลพนักงาน</h1>
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
                                    <label class="col-sm-2">รหัสพนักงาน</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="member_id" class="form-control" required
                                            placeholder="รหัสพนักงาน">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2">สิทธิ์การใช้งาน</label>
                                    <div class="col-sm-2">
                                        <select name="ref_level_id" class="form-control" required>
                                            <option value="">กรุณาเลือก</option>
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
                                        <input type="username" name="username" class="form-control" required
                                            placeholder="Username">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2">Password</label>
                                    <div class="col-sm-4">
                                        <input type="password" name="password" class="form-control" required
                                            placeholder="Password">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2">คำนำหน้า</label>
                                    <div class="col-sm-2">
                                        <select name="title_name" class="form-control" required>
                                            <option value="">กรุณาเลือก</option>
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
                                            placeholder="ชื่อ">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2">นามสกุล</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="lastname" class="form-control" required
                                            placeholder="นามสกุล">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2">แผนก</label>
                                    <div class="col-sm-2">
                                        <select name="ref_department_id" class="form-control" required>
                                            <option value="">กรุณาเลือก</option>
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
                                        <select name="ref_position_id" class="form-control" required>
                                            <option value="">กรุณาเลือก</option>
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
                                            placeholder="เบอร์โทร">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2">Email</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="m_email" class="form-control" required
                                            placeholder="Email">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-sm-2"></label>
                                    <div class="col-sm-4">
                                        <button type="submit" class="btn btn-primary">เพิ่มข้อมูล</button>
                                        <a href="member.php" class="btn btn-danger">ยกเลิก</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- <?php
                                    echo '<pre></pre>';
                                    print_r($_POST);
                                    ?> -->


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
if (isset($_POST['username']) && isset($_POST['firstname']) && isset($_POST['lastname'])) {

    //trigger exception in a "try" block
    try {

        // รับค่าจากฟอร์ม
        $member_id = $_POST['member_id'];
        $ref_level_id = $_POST['ref_level_id'];
        $username = $_POST['username'];
        $password = sha1($_POST['password']);
        $title_name = $_POST['title_name'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $ref_department_id = $_POST['ref_department_id'];
        $ref_position_id = $_POST['ref_position_id'];
        $m_tel = $_POST['m_tel'];
        $m_email = $_POST['m_email'];

        //เช็ก username ซ้ำ
        $stmtMemberDetail = $condb->prepare("SELECT username FROM tbl_member WHERE username=:username");
        $stmtMember_idDetail = $condb->prepare("SELECT member_id FROM tbl_member WHERE member_id=:member_id");

        // Bind Parameters
        $stmtMemberDetail->bindParam(':username', $username, PDO::PARAM_STR);
        $stmtMemberDetail->execute();
        $row = $stmtMemberDetail->fetch(PDO::FETCH_ASSOC);

        $stmtMember_idDetail->bindParam(':member_id', $member_id, PDO::PARAM_STR);
        $stmtMember_idDetail->execute();
        $rowMem_id = $stmtMember_idDetail->fetch(PDO::FETCH_ASSOC);

        // ตรวจสอบข้อมูลซ้ำ
        if ($stmtMemberDetail->rowCount() == 1) {
            // Username ซ้ำ
            echo '<script>
            setTimeout(function() {
                swal({
                    title: "Username นี้มีอยู่ในระบบแล้ว",
                    text: "กรุณากรอกข้อมูลใหม่อีกครั้ง",
                    type: "error"
                }, function() {
                    window.location = "member.php?act=add"; // หน้าที่ต้องการให้กระโดดไป
                });
            }, 1000);
        </script>';
        } elseif ($stmtMember_idDetail->rowCount() == 1) {
            // Member ID ซ้ำ
            echo '<script>
            setTimeout(function() {
                swal({
                    title: "รหัสพนักงานนี้มีอยู่ในระบบแล้ว",
                    text: "กรุณากรอกข้อมูลใหม่อีกครั้ง",
                    type: "error"
                }, function() {
                    window.location = "member.php?act=add"; // หน้าที่ต้องการให้กระโดดไป
                });
            }, 1000);
        </script>';
        } else {
            //echo 'ไม่มี Username ซ้ำ';
            $stmtInsertMember = $condb->prepare("INSERT INTO tbl_member 
            (member_id, ref_level_id,username, password, title_name, firstname, lastname, ref_department_id, ref_position_id, m_tel, m_email)
            VALUES (:member_id, :ref_level_id,:username, '$password', :title_name, :firstname, :lastname, :ref_department_id, :ref_position_id, :m_tel, :m_email )");

            //bindParam
            $stmtInsertMember->bindParam(':member_id', $member_id, PDO::PARAM_STR);
            $stmtInsertMember->bindParam(':ref_level_id', $ref_level_id, PDO::PARAM_INT);
            $stmtInsertMember->bindParam(':username', $username, PDO::PARAM_STR);
            $stmtInsertMember->bindParam(':title_name', $title_name, PDO::PARAM_STR);
            $stmtInsertMember->bindParam(':firstname', $firstname, PDO::PARAM_STR);
            $stmtInsertMember->bindParam(':lastname', $lastname, PDO::PARAM_STR);

            $stmtInsertMember->bindParam(':ref_department_id', $ref_department_id, PDO::PARAM_INT);
            $stmtInsertMember->bindParam(':ref_position_id', $ref_position_id, PDO::PARAM_INT);
            $stmtInsertMember->bindParam(':m_tel', $m_tel, PDO::PARAM_STR);
            $stmtInsertMember->bindParam(':m_email', $m_email, PDO::PARAM_STR);

            $result = $stmtInsertMember->execute();

            $condb = null;
            if ($result) {
                echo '<script>
                    setTimeout(function() {
                        swal({
                            title: "เพิ่มข้อมูลสำเร็จ",
                            type: "success"
                        }, function() {
                            window.location = "member.php"; // หน้าที่ต้องการให้กระโดดไป
                        });
                    }, 1000);
                </script>';
            }
        } //เช็กข้อมูลซ้ำ
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
} //isset
?>