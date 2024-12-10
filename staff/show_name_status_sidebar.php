<?php
// คิวรี่ข้อมูลมาแสดงในตาราง
$stmtMemberDetail = $condb->prepare("SELECT name, surname,m_level FROM tbl_member WHERE id = ?"); // คำสั่ง SQL เพื่อดึงข้อมูล name และ surname
$stmtMemberDetail->bindParam(1, $_SESSION['id']); // ใช้ session id เพื่อดึงข้อมูลของผู้ใช้ปัจจุบัน
$stmtMemberDetail->execute();
$rsMember = $stmtMemberDetail->fetch(); // ดึงข้อมูลผู้ใช้คนเดียวจากฐานข้อมูล

// ตรวจสอบว่ามีข้อมูลหรือไม่
if ($rsMember) {
    $name = $rsMember['name'];
    $surname = $rsMember['surname'];
    $m_level = $rsMember['m_level'];
} else {
    // ถ้าไม่พบข้อมูลให้แสดงเป็น "Unknown User"
    $name = "Unknown";
    $surname = "User";
}
?>



<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href=" #" class="brand-link">
        <img src="../assets/dist/img/Logo JB Comp3(BG).png" alt="JBCompLogo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Repair JB Comp</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../dist/img/avatar4.png" class=" img-circle elevation-2" alt="User Image"
                    style="margin-top: 12px;">

            </div>
            <div class="info">

                <a href="#" class="d-block"><?= htmlspecialchars($name . ' ' . $surname); ?></a>
                <a href="#" class="d-block u-level">สิทธิ์ใช้งาน :
                    <?php
                    // สร้างปุ่มตามสิทธิ์การใช้งาน
                    if ($m_level == 'admin') {
                        echo '<button class="btn btn-success btn-custom-small">Admin</button>';
                    } elseif ($m_level == 'staff') {
                        echo '<button class="btn btn-info btn-custom-small">User</button>';
                    } else {
                        echo '<button class="btn btn-warning btn-custom-small">NT</button>';
                    }
                    ?>
                    <style>
                        .u-level {
                            margin-top: 2px;
                            font-size: 13px;
                        }

                        .btn-custom-small {
                            padding: 0px 3px;
                            /* ปรับขนาด padding ให้เล็ก */
                            font-size: 11px;
                            /* ปรับขนาดตัวอักษร */
                        }
                    </style>
                </a>

            </div>
        </div>