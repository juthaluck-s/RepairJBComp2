<?php
if (isset($_GET['id']) && isset($_GET['act']) && $_GET['act'] == 'openjob') {
    $case_id = $_GET['id'];  // รับค่า case_id ที่ส่งมาจาก URL

    // คิวรีเพื่อดึงข้อมูลจาก tbl_case ที่ตรงกับ case_id
    $stmtCase_open = $condb->prepare("SELECT *
                                        FROM tbl_case AS c
                                        LEFT JOIN tbl_member AS emp ON c.ref_m_id = emp.m_id
                                      
                                        LEFT JOIN tbl_equipment AS eqm ON c.ref_equipment_id = eqm.equipment_id
                                        LEFT JOIN tbl_status AS stt ON c.ref_status_id = stt.status_id
                                        LEFT JOIN tbl_assessment AS asm ON c.ref_assessment_id = asm.assessment_id
                                        LEFT JOIN tbl_building AS bd ON c.ref_building_id = bd.building_id
                                        WHERE c.case_id = :case_id  ");

    $stmtCase_open->bindParam(':case_id', $case_id, PDO::PARAM_INT);
    $stmtCase_open->execute();
    $rsCase_open = $stmtCase_open->fetch(PDO::FETCH_ASSOC);

    // ตรวจสอบผลลัพธ์
    if (!$rsCase_open) {
        echo "ไม่พบข้อมูลกรณีที่เลือก";
    } else {
        // echo "<pre>";
        // print_r($rsCase_open); // ดูข้อมูลที่ได้จากฐานข้อมูล
        // echo "</pre>";
    }
} else {
    echo "กรุณาเลือกกรณีที่จะทำการ Assign";
}

if (isset($_GET['no'])) {
    $no = $_GET['no'];
}


?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>รายการแจ้งซ่อมคอมพิวเตอร์/อุปกรณ์</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <div class="box">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <p>
                                        <a href="case.php" class="btn btn-primary">
                                            NEW <span class="badge">5</span></a>
                                        <a href="case.php?act=doing" class="btn btn-warning">
                                            Assigned <span class="badge">16</span></a>
                                        <a href="case.php?act=success" class="btn btn-success">
                                            Success <span class="badge">179</span></a>
                                        <a href="case.php?act=all" class="btn btn-danger">
                                            AllJob <span class="badge">200</span></a>
                                    </p>
                                    <div class="card">

                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table id="example3" class="table table-bordered table-striped table-sm">

                                                <thead>
                                                    <tr class="table-info">
                                                        <th width="5%" class="text-center">No.</th>
                                                        <th width="10%" class="text-center">รูปภาพ</th>
                                                        <th width="10%" class="text-center">อุปกรณ์</th>
                                                        <th class="text-center">รายละเอียด</th>
                                                    </tr>
                                                </thead>


                                                <?php
                                                $no = isset($_GET['no']) ? intval($_GET['no']) : '-'; // ถ้าไม่มีค่า no ให้ใช้เครื่องหมาย -
                                                ?>

                                                <tbody>
                                                    <tr>
                                                        <td align="center"><?= $no; ?></td>

                                                        <td><img src="../assets/case_img/<?= $rsCase_open['case_img']; ?>"
                                                                width="180px"></td>
                                                        <td align="center"><?= $rsCase_open['equipment_name']; ?></td>
                                                        <td>
                                                            <?= $rsCase_open['case_detail']; ?><br>
                                                            สถานที่ : <?= $rsCase_open['building_name']; ?> ชั้น
                                                            <?= $rsCase_open['case_floor']; ?> ห้อง
                                                            <?= $rsCase_open['case_room']; ?><br>
                                                            <?= $rsCase_open['title_name'] . ' ' . $rsCase_open['firstname'] . ' ' . $rsCase_open['lastname']; ?><br>
                                                            เบอร์โทร : <?= $rsCase_open['m_tel']; ?><br>
                                                            Email : <?= $rsCase_open['m_email']; ?><br>
                                                            ว/ด/ป :
                                                            <?= date('d/m/Y H:i:s', strtotime($rsCase_open['dateSave'])); ?><br>
                                                            <font color="red">สถานะ
                                                                <?= $rsCase_open['status_name']; ?></font>

                                                                <br>หัวหน้าช่าง : 
                                                                <br>ช่างที่รับผิดชอบ : 
                                                                <br>หมายเหตุ/อธิบายการแก้ปัญหา : 
                                                                <br>ว/ด/ป ที่ส่งงาน : 
                                                                <br>ผลประเมิน : 
                                                        </td>
                                                    </tr>
                                                </tbody>

                                            </table>

                                      

                                           
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- content-wrapper -->