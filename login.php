<?php
// เริ่มต้นการใช้เซสชั่น
session_start();
require_once 'config/condb.php';

// ตรวจสอบว่า username, password และ action ถูกส่งมาหรือไม่
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['action']) && $_POST['action'] == 'login') {

    // ประกาศตัวแปรรับค่าจากฟอร์ม
    $username = $_POST['username'];
    $password = sha1($_POST['password']); // เก็บรหัสผ่านในรูปแบบ sha1

    // ตรวจสอบ username และ password ในฐานข้อมูล
    $stmtLogin = $condb->prepare("SELECT m_id, ref_level_id FROM tbl_member WHERE username = :username AND password = :password");

    // bind parameter
    $stmtLogin->bindParam(':username', $username, PDO::PARAM_STR);
    $stmtLogin->bindParam(':password', $password, PDO::PARAM_STR);
    $stmtLogin->execute();

    // ตรวจสอบว่า username และ password ถูกต้องหรือไม่
    if ($stmtLogin->rowCount() == 1) {
        // fetch ข้อมูลจากฐานข้อมูล
        $row = $stmtLogin->fetch(PDO::FETCH_ASSOC);

        // สร้างตัวแปร session
        $_SESSION['staff_id'] = $row['m_id'];
        $_SESSION['ref_level_id'] = $row['ref_level_id'];

        // ปิดการเชื่อมต่อฐานข้อมูล
        $condb = null;

        // ตรวจสอบสิทธิ์การใช้งานของผู้ใช้
        if ($_SESSION['ref_level_id'] == '1') {
            header('Location: admin/'); // ไปที่หน้าของ admin
            exit();
        } else if ($_SESSION['ref_level_id'] == '2') {
            header('Location: head-mechanic/case.php'); // ไปที่หน้าของ head-mechanic
            exit();
        } else if ($_SESSION['ref_level_id'] == '3') {
            header('Location: mechanic/case.php'); // ไปที่หน้าของ mechanic
            exit();
        } else if ($_SESSION['ref_level_id'] == '4') {
            header('Location: employee/case.php'); // ไปที่หน้าของ employee
            exit();
        }
    } else {
        // ถ้า username หรือ password ไม่ถูกต้อง
        echo '<script>
            setTimeout(function() {
                swal({
                    title: "เกิดข้อผิดพลาด",
                    text: "Username หรือ Password ไม่ถูกต้อง ลองใหม่อีกครั้ง",
                    type: "warning"
                }, function() {
                    window.location = "login.php"; // กลับไปที่หน้าล็อกอิน
                });
            }, 1000);
        </script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair JBComp Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/dist/css/login.css">

    <!-- SweetAlert -->
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>

<body>

    <div class="container" id="Login">
        <div class="logo-container">
            <img src="assets/dist/img/Logo JB Comp2.png" alt="Logo">
        </div>
        <!-- <h1 class="form-title">Log in</h1> -->

        <form method="post" action="">

            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="username" class="form-control" placeholder="Username" required>
                <label for="username">Username</label>
            </div>

            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <label for="password">Password</label>
            </div>

            <div class="row">
                <div class="col-12">
                    <button type="submit" name="action" value="login" class="btn btn-primary btn-block">Log In</button>
                </div>
            </div>
        </form>
    </div>

</body>

</html>