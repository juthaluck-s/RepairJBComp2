<?php

try {
    // คิวรี่ข้อมูลผู้ใช้จากฐานข้อมูล
    $MemberDetail = $condb->prepare("SELECT * FROM tbl_member WHERE m_id = :m_id");
    $MemberDetail->bindParam(':m_id', $_SESSION['staff_id'], PDO::PARAM_INT);
    $MemberDetail->execute();
    $MemberData = $MemberDetail->fetch(PDO::FETCH_ASSOC);

    // ตรวจสอบว่าพบข้อมูลในฐานข้อมูลหรือไม่
    if ($MemberData) {
        $firstname = htmlspecialchars($MemberData['firstname']);
        $lastname = htmlspecialchars($MemberData['lastname']);
        $ref_level_id = htmlspecialchars($MemberData['ref_level_id']);
    } else {
        // หากไม่พบข้อมูลในฐานข้อมูล
        $firstname = "Unknown";
        $lastname = "User";
        $ref_level_id = "guest";
    }
} catch (PDOException $e) {
    // จัดการข้อผิดพลาดในการเชื่อมต่อหรือ Query ฐานข้อมูล
    echo "Error: " . $e->getMessage();
    // exit();
}
?>



<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="case.php" class="brand-link">
        <img src="../assets/dist/img/Logo Jb Comp3(BG).png" alt="JBCompLogo" class="brand-image img-circle ">
        <span class="brand-text font-weight-light">Repair JB Comp</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- โปรไฟล์ Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../assets/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image"
                    style="margin-top: 8px;">
            </div>

            <div class="info">

                <a href="#" class="d-block">
                    <?= htmlspecialchars($firstname . ' ' . $lastname); ?>
                </a>
                <a href="#" class="d-block m-level">สิทธิ์ใช้งาน :
                    <?php if ($ref_level_id): ?>
                        <?php if ($ref_level_id == '1'): ?>
                            <button class="btn btn-danger btn-custom-small">Admin</button>
                        <?php elseif ($ref_level_id == '2'): ?>
                            <button class="btn btn-warning btn-custom-small">Head Mechanic</button>
                        <?php elseif ($ref_level_id == '3'): ?>
                            <button class="btn btn-info btn-custom-small">Mechanic</button>
                        <?php elseif ($ref_level_id == '4'): ?>
                            <button class="btn btn-success btn-custom-small">Employee</button>
                        <?php endif; ?>
                    <?php else: ?>
                        <button class="btn btn-secondary btn-custom-small">Unknown</button>
                    <?php endif; ?>
                </a>


            </div>
            <style>
                .m-level {
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
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="case.php" class="nav-link">
                        <i class="nav-icon fas fa-screwdriver-wrench"></i>
                        <p>
                            รายการแจ้งซ่อม
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="report.php?act=report" class="nav-link">
                        <i class="nav-icon fa-solid fa-file-lines"></i>
                        <p>
                            รายงานแจ้งซ่อม
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="member.php?act=edit" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            แก้ไขข้อมูลส่วนตัว
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="member.php?act=password" class="nav-link">
                        <i class="nav-icon fa-solid fa-key"></i>
                        <p>
                            แก้ไขรหัสผ่าน
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="../logout.php" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            ออกจากระบบ
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>