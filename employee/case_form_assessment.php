<?php
if (isset($_GET['id']) && isset($_GET['act']) && $_GET['act'] == 'assessment') {
    $case_id = $_GET['id'];  // รับค่า case_id ที่ส่งมาจาก URL

    // คิวรีเพื่อดึงข้อมูลจาก tbl_case ที่ตรงกับ case_id
    $stmtCase_open = $condb->prepare("SELECT *
                                        FROM tbl_case AS c
                                        LEFT JOIN tbl_member AS emp ON c.ref_m_id = emp.m_id
                                        INNER JOIN tbl_department AS dpm ON emp.ref_department_id = dpm.department_id
                                        INNER JOIN tbl_position AS pst ON emp.ref_position_id = pst.position_id
                                        LEFT JOIN tbl_head_mechanic AS hmec ON c.ref_head_mechanic_id = hmec.head_mechanic_id
                                        LEFT JOIN tbl_mechanic AS mec ON c.ref_mec_id = mec.mec_id
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

// Fetching assessment data from the database
$stmtAssessment = $condb->prepare("SELECT * FROM tbl_assessment");
$stmtAssessment->execute();
$rsAssessment = $stmtAssessment->fetchAll(PDO::FETCH_ASSOC);

?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>รายการส่งงานแจ้งซ่อมคอมพิวเตอร์/อุปกรณ์</h1>
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

                                    <div class="card">

                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table id="example3" class="table table-bordered table-striped table-sm">

                                                <thead>
                                                    <tr class="bg-edit">
                                                        <th width="5%" class="text-center">No.</th>
                                                        <th width="10%" class="text-center">รูปภาพ</th>
                                                        <th width="10%" class="text-center">อุปกรณ์</th>
                                                        <th class="text-center">รายละเอียด</th>
                                                    </tr>
                                                </thead>


                                                <?php
                                                $no = isset($_GET['no']) ? intval($_GET['no']) : '-'; // ถ้าไม่มีค่า no ให้ใช้เครื่องหมาย -
                                                ?>
                                                <form method="post" action="">

                                                    <tbody>
                                                        <tr>
                                                            <td align="center"><?= $no; ?></td>

                                                            <td><img src="../assets/case_img/<?= $rsCase_open['case_img']; ?>"
                                                                    width="180px"></td>
                                                            <td align="center"><?= $rsCase_open['equipment_name']; ?>
                                                            </td>
                                                            <td>
                                                                <b> <?= $rsCase_open['case_detail']; ?></b><br>
                                                                สถานที่ : <?= $rsCase_open['building_name']; ?> ชั้น
                                                                <?= $rsCase_open['case_floor']; ?> ห้อง
                                                                <?= $rsCase_open['case_room']; ?><br>
                                                                <?= $rsCase_open['title_name'] . '' . $rsCase_open['firstname'] . ' ' . $rsCase_open['lastname']; ?><br>
                                                                แผนก : <?= $rsCase_open['department_name']; ?><br>
                                                                ตำแหน่ง : <?= $rsCase_open['position_name']; ?><br>
                                                                เบอร์โทร : <?= $rsCase_open['m_tel']; ?><br>
                                                                Email : <?= $rsCase_open['m_email']; ?><br>
                                                                ว/ด/ป :
                                                                <?= date('d/m/Y H:i:s', strtotime($rsCase_open['dateSave'])); ?><br>
                                                                <font color="red">สถานะ
                                                                    <?= $rsCase_open['status_name']; ?></font>

                                                                <br>หัวหน้าช่าง :
                                                                <?= $rsCase_open['head_mechanic_title_name'] . '' . $rsCase_open['head_mechanic_firstname'] . ' ' . $rsCase_open['head_mechanic_lastname']; ?>
                                                                <br>ช่างที่รับผิดชอบ :
                                                                <?= $rsCase_open['mec_title_name'] . '' . $rsCase_open['mec_firstname'] . ' ' . $rsCase_open['mec_lastname']; ?>
                                                                <br>หมายเหตุ/อธิบายการแก้ปัญหา :


                                                                <textarea name="case_update_log" required
                                                                    class="form-control" rows="4" cols="50"
                                                                    style="background-color:#dcdcdd; text-align: left;"
                                                                    readonly><?= $rsCase_open['case_update_log']; ?></textarea>

                                                                <br>
                                                                ว/ด/ป ที่ส่งงาน:
                                                                <?= date('d/m/Y H:i:s', strtotime($rsCase_open['case_update'])); ?><br>
                                                                <font color="green">ผลประเมิน :
                                                                    <?= $rsCase_open['assessment_name']; ?></font>

                                                </form>


                                                </td>
                                                </tr>
                                                </tbody>
                                            </table>

                                            <div class="row">
                                                <div class="col-md-4"> <br />
                                                    <h4>ประเมินความพึงพอใจงานซ่อม</h4>
                                                    <form method="post" action="">
                                                        <table width="20%" border="1" align="center" cellpadding="0"
                                                            cellspacing="0" class="table table-bordered table-hover">
                                                            <?php foreach ($rsAssessment as $rsAsm) { ?>
                                                            <tr>
                                                                <td height="30" align="center">
                                                                    <input type="radio" name="assessment_id"
                                                                        value="<?= $rsAsm['assessment_id']; ?>"
                                                                        required />
                                                                </td>
                                                                <td height="30">
                                                                    <?= $rsAsm['assessment_name']; ?>
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                        </table>


                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn-edit6 btn" name="submit"
                                                        value="as">ส่งผลประเมิน</button>
                                                </div>
                                            </div>
                                            </form>

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



<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit']) && isset($_POST['assessment_id'])) {
    try {
        // รับค่า assessment_id ที่เลือก
        $assessment_id = $_POST['assessment_id'];
        $case_id = $_GET['id']; // รับ case_id จาก URL

        // เชื่อมต่อกับฐานข้อมูลและอัปเดตข้อมูลใน tbl_case
        $stmtUpdateAsm = $condb->prepare("
            UPDATE tbl_case
            SET ref_assessment_id = :assessment_id,
                ref_status_id = 4  -- เปลี่ยนสถานะเป็น 'ปิดงาน'
            WHERE case_id = :case_id
        ");
        $stmtUpdateAsm->bindParam(':assessment_id', $assessment_id, PDO::PARAM_INT);
        $stmtUpdateAsm->bindParam(':case_id', $case_id, PDO::PARAM_INT);
        $stmtUpdateAsm->execute();

        // อัปเดตค่าการประเมินใน tbl_assessment
        $stmtUpdateAsmCount = $condb->prepare("
            UPDATE tbl_assessment
            SET assessment_count = assessment_count + 1
            WHERE assessment_id = :assessment_id
        ");
        $stmtUpdateAsmCount->bindParam(':assessment_id', $assessment_id, PDO::PARAM_INT);
        $stmtUpdateAsmCount->execute();

        $stmtGetMecId = $condb->prepare("SELECT ref_mec_id FROM tbl_case WHERE case_id = :case_id");
        $stmtGetMecId->bindParam(':case_id', $case_id, PDO::PARAM_INT);
        $stmtGetMecId->execute();
        $rsGetMecId = $stmtGetMecId->fetch(PDO::FETCH_ASSOC);

        if ($rsGetMecId && isset($rsGetMecId['ref_mec_id'])) {
            $mec_id = $rsGetMecId['ref_mec_id'];

            // อัปเดต mec_close เพิ่ม +1
            $stmtUpdateMecClose = $condb->prepare("
                UPDATE tbl_mechanic 
                SET mec_close = mec_close + 1,
               mec_doing = mec_doing - 1
                WHERE mec_id = :mec_id
            ");
            $stmtUpdateMecClose->bindParam(':mec_id', $mec_id, PDO::PARAM_INT);
            $stmtUpdateMecClose->execute();
        }


        // แสดง alert ว่าส่งผลประเมินสำเร็จ
        echo '<script>
                setTimeout(function() {
                    swal({
                        title: "ส่งผลประเมินสำเร็จ!",
                        type: "success"
                    }, function() {
                        window.location = "case.php";  // เปลี่ยนหน้าไปที่หน้า case
                    });
                }, 1000);
            </script>';
    } catch (Exception $e) {
        // Handling exceptions
        echo '<script>
                setTimeout(function() {
                    swal({
                        title: "เกิดข้อผิดพลาด!",
                        text: "ไม่สามารถบันทึกข้อมูลได้: ' . $e->getMessage() . '",
                        type: "error"
                    }, function() {
                        window.location = "case.php";
                    });
                }, 1000);
            </script>';
    }
}

?>