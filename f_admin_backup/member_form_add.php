<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ฟอร์มเพิ่มข้อมูลพนักงาน</h1>
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
                                                <option value="">กรุณาเลือก</option>
                                                <option value="admin">admin</option>
                                                <option value="staff">staff</option>

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
        $username = $_POST['username'];
        $password = sha1($_POST['password']);
        $title_name = $_POST['title_name'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $m_level = $_POST['m_level']; //admin, staff

        //เช็ก username ซ้ำ
        $stmtMemberDetail = $condb->prepare("SELECT username FROM tbl_member WHERE username=:username");

        //bindParam
        $stmtMemberDetail->bindParam(':username', $username, PDO::PARAM_STR);
        $stmtMemberDetail->execute();
        $row = $stmtMemberDetail->fetch(PDO::FETCH_ASSOC);

        //นับจำนวนการคิวรี่ ถ้าได้ 1 คือ username ซ้ำ
        if ($stmtMemberDetail->rowCount() == 1) {
            // echo 'Username ซ้ำ';
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
        } else {
            //echo 'ไม่มี Username ซ้ำ';
            $stmtInsertMember = $condb->prepare("INSERT INTO tbl_member 
            (username, password, title_name, firstname, lastname,m_level)
            VALUES (:username, '$password', :title_name, :firstname, :lastname, :m_level)");

            //bindParam
            $stmtInsertMember->bindParam(':username', $username, PDO::PARAM_STR);
            $stmtInsertMember->bindParam(':title_name', $title_name, PDO::PARAM_STR);
            $stmtInsertMember->bindParam(':firstname', $firstname, PDO::PARAM_STR);
            $stmtInsertMember->bindParam(':lastname', $lastname, PDO::PARAM_STR);
            $stmtInsertMember->bindParam(':m_level', $m_level, PDO::PARAM_STR);
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