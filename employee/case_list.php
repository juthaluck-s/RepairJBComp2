<?php
$queryCaseList = $condb->prepare("SELECT  * 
    FROM tbl_case AS c
    LEFT JOIN tbl_member AS emp ON c.ref_m_id = emp.m_id
    LEFT JOIN tbl_mechanic AS mec ON c.ref_mec_id = mec.mec_id
    LEFT JOIN tbl_equipment AS eqm ON c.ref_equipment_id = eqm.equipment_id
    LEFT JOIN tbl_status AS stt ON c.ref_status_id = stt.status_id
    LEFT JOIN tbl_assessment AS asm ON c.ref_assessment_id = asm.assessment_id
    LEFT JOIN tbl_building AS bd ON c.ref_building_id = bd.building_id
    WHERE c.ref_m_id = :staff_id
");

$queryCaseList->bindParam(':staff_id', $_SESSION['staff_id'], PDO::PARAM_INT);
$queryCaseList->execute();
$rsCaseList = $queryCaseList->fetchAll();





// $stmtrmID->execute();
// $queryCaseList->execute();
// $rsCaseList = $queryCaseList->fetchAll();




// echo '<pre></pre>';
// $queryCaseList->debugDumpParams();
// exit;

?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>แจ้งซ่อมคอมพิวเตอร์/อุปกรณ์

                        <a href="case.php?act=add" class="btn btn-danger">แจ้งซ่อม</a>


                    </h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <!-- /.card-header -->
                        <form action="update_status" method="POST">
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped table-sm">


                                    <thead>
                                        <tr class="bg-dark">
                                            <th width="5%" class="text-center">No.</th>

                                            <th width="5%" class="text-center">รูปภาพ</th>
                                            <th width="10%" class="text-center">อุปกรณ์</th>
                                            <th class="text-center">รายละเอียด</th>
                                            <th width="8%" class="text-center">สถานะ</th>
                                            <th width="12%" class="text-center">ช่างที่รับผิดชอบงาน</th>
                                            <th width="8%" class="text-center">ประเมินผล</th>

                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php
                                        $i = 1;
                                        ?>

                                        <?php foreach ($rsCaseList as $row) { ?>

                                            <tr>
                                                <td align="center"> <?php echo $i++ ?></td>

                                                <td><img src="../assets/case_img/<?= $row['case_img']; ?>" width="70px">
                                                </td>
                                                <td align="center"><?= $row['equipment_name']; ?></td>
                                                <td>
                                                    <b> <?= nl2br(wordwrap($row['case_detail'], 250, "\n", true)) ?>
                                                    </b><br>
                                                    สถานที่ : <?= $row['building_name'] ?> ชั้น
                                                    <?= $row['case_floor'] ?>
                                                    ห้อง
                                                    <?= $row['case_room'] ?>
                                                </td>


                                                <td align="center"><?= htmlspecialchars($row['status_name']); ?></td>

                                                <td>
                                                    <?php if ($row['ref_status_id'] != 1): ?>
                                                        <!-- ตรวจสอบว่าสถานะไม่ใช่ 1 -->
                                                        <?php if (!empty($row['title_name']) && !empty($row['firstname']) && !empty($row['lastname'])): ?>
                                                            <?= $row['mec_title_name'] . ' ' . $row['mec_firstname'] . ' ' . $row['mec_lastname'] . '<br>เบอร์โทร: ' . $row['mec_tel'] . '<br>Email: ' . $row['mec_email']; ?>
                                                        <?php else: ?>
                                                            ข้อมูลช่างไม่สมบูรณ์
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <div class="text-center">-</div>
                                                        <!-- หากสถานะเป็น 1 ให้แสดง "-" -->
                                                    <?php endif; ?>
                                                </td>

                                                <td align="center">
                                                    <?php if ($row['ref_status_id'] == 3): ?>
                                                        <!-- ถ้าสถานะเป็น 3 จะแสดงปุ่ม "ประเมิน" -->
                                                        <a href="case.php?id=<?= $row['case_id']; ?>&act=assessment&no=<?= $i - 1; ?>"
                                                            class="btn btn-info btn-sm">ประเมิน</a>
                                                    <?php elseif ($row['ref_status_id'] == 4): ?>
                                                        <!-- ถ้าสถานะเป็น 4 จะแสดงปุ่ม "Open" -->
                                                        <a href="case.php?id=<?= $row['case_id']; ?>&act=view&no=<?= $i - 1; ?>"
                                                            class="btn btn-success btn-sm">Open</a>
                                                    <?php else: ?>
                                                        <!-- ถ้าสถานะเป็น 1 หรือ 2 จะแสดงเครื่องหมาย "-" -->
                                                        -
                                                    <?php endif; ?>
                                                </td>



                                            </tr>
                                        <?php } ?>
                                    </tbody>

                                </table>

                            </div>
                            <!-- /.card-body -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
if (isset($_POST['update_status'])) {
    $case_id = $_POST['case_id'];
    $status_id = $_POST['status_id']; // สถานะใหม่
    $ref_mec_id = $_POST['m_id']; // ช่างที่รับผิดชอบงาน

    try {
        $condb->beginTransaction();

        // อัปเดตสถานะในตาราง tbl_case
        $updateCase = $condb->prepare("UPDATE tbl_case SET ref_status_id = :status_id WHERE case_id = :case_id");
        $updateCase->bindParam(':status_id', $status_id, PDO::PARAM_INT);
        $updateCase->bindParam(':case_id', $case_id, PDO::PARAM_INT);
        $updateCase->execute();

        // อัปเดตสถานะในตาราง tbl_member สำหรับพนักงาน
        $updateEmployeeStatus = $condb->prepare("UPDATE tbl_case SET ref_status_id = :status_id WHERE ref_m_id = :staff_id");
        $updateEmployeeStatus->bindParam(':status_id', $status_id, PDO::PARAM_INT);
        $updateEmployeeStatus->bindParam(':staff_id', $_SESSION['staff_id'], PDO::PARAM_INT);
        $updateEmployeeStatus->execute();

        $condb->commit();

        echo "<script>alert('สถานะถูกอัปเดตเรียบร้อยแล้ว!');</script>";
    } catch (PDOException $e) {
        $condb->rollBack();
        echo "<script>alert('เกิดข้อผิดพลาดในการอัปเดตสถานะ: " . $e->getMessage() . "');</script>";
    }
}
?>