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
        $m_level = htmlspecialchars($MemberData['m_level']);
    } else {
        // หากไม่พบข้อมูลในฐานข้อมูล
        $firstname = "Unknown";
        $lastname = "User";
        $m_level = "guest";
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
    <a href="index3.html" class="brand-link">
        <img src="../assets/dist/img/Logo Jb Comp3(BG).png" alt="JBCompLogo" class="brand-image img-circle ">
        <span class="brand-text font-weight-light">Repair JB Comp</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- โปรไฟล์ Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../assets/dist/img/avatar4.png" class="img-circle elevation-2" alt="User Image"
                    style="margin-top: 10px;">
            </div>

            <div class="info">

                <a href="#" class="d-block">
                    <?= htmlspecialchars($firstname . ' ' . $lastname); ?>
                </a>
                <a href="#" class="d-block m-level">สิทธิ์ใช้งาน :
                    <?php if ($m_level): ?>
                        <?php if ($m_level == 'admin'): ?>
                            <button class="btn btn-danger btn-custom-small">Admin</button>
                        <?php elseif ($m_level == 'head-mechanic'): ?>
                            <button class="btn btn-warning btn-custom-small">Head Mechanic</button>
                        <?php elseif ($m_level == 'mechanic'): ?>
                            <button class="btn btn-info btn-custom-small">Mechanic</button>
                        <?php elseif ($m_level == 'employee'): ?>
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
                    <a href="index.php" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <!-- <li class="nav-item">
                    <a href="form.php" class="nav-link">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                            ฟอร์ม
                        </p>
                    </a>
                </li> -->

                <li class="nav-item">
                    <a href="member.php" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            จัดการข้อมูลพนักงาน
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="department.php" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            จัดการแผนก
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="position.php" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            จัดการตำแหน่ง
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="equipment.php" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            จัดการอุปกรณ์
                        </p>
                    </a>
                </li>



                <li class="nav-item">
                    <a href="status.php" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            จัดการสถานะ
                        </p>
                    </a>
                </li>



                <li class="nav-item">
                    <a href="building.php" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            จัดการอาคาร
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