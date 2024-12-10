<?php
$queryCaseList = $condb->prepare("
    SELECT * 
    FROM tbl_case AS c
    LEFT JOIN tbl_member AS emp ON c.ref_m_id = emp.m_id
    LEFT JOIN tbl_member AS mec ON c.ref_mec_id = mec.m_id
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
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-sm">

                                <thead>
                                    <tr class="table-info">
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
                                            <td><?= $row['equipment_name']; ?></td>
                                            <td><?= $row['case_detail'] . '' . $row['building_name'] . ' ชั้น ' . $row['case_floor'] . ' ห้อง ' . $row['case_room'] ?>
                                            </td>
                                            <td align="center"><?= htmlspecialchars($row['status_name']); ?></td>

                                            <td>
                                                <?php if ($row['m_level'] == 'mechanic'): ?>
                                                    <?php if (!empty($row['title_name']) && !empty($row['firstname']) && !empty($row['lastname'])): ?>
                                                        <?= $row['title_name'] . ' ' . $row['firstname'] . ' ' . $row['lastname'] . '<br>เบอร์โทร: ' . $row['m_tel'] . '<br>Email: ' . $row['m_email']; ?>
                                                    <?php else: ?>
                                                        -
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>



                                            <td align="center">
                                                <?php if ($row['status_name'] === 'รอประเมินผล'): ?>
                                                    <a href="case.php?id=<?= $row['assessment_name']; ?>&act=assessment"
                                                        class="btn btn-info btn-sm">ประเมิน</a>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>


                                        </tr>
                                    <?php } ?>
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
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
    // รับค่าจากฟอร์ม
    $case_id = $_POST['case_id'];
    $status_id = $_POST['status_id']; // สถานะใหม่
    $ref_mec_id = $_POST['m_id']; // ช่างที่รับผิดชอบงาน

    // อัปเดตสถานะในตาราง tbl_case
    $updateCase = $condb->prepare("UPDATE tbl_case SET ref_status_id = :status_id WHERE case_id = :case_id");
    $updateCase->bindParam(':status_id', $status_id, PDO::PARAM_INT);
    $updateCase->bindParam(':case_id', $case_id, PDO::PARAM_INT);
    $updateCase->execute();

    // อัปเดตสถานะในตาราง tbl_employee (เชื่อมโยงกับเคส)
    // เชื่อมโยง ref_case_id ไปยัง tbl_employee
    $updateEmployee = $condb->prepare("UPDATE tbl_employee SET status_id = :status_id, ref_mec_id = :ref_mec_id WHERE ref_case_id = :case_id");
    $updateEmployee->bindParam(':status_id', $status_id, PDO::PARAM_INT);
    $updateEmployee->bindParam(':ref_mec_id', $ref_mec_id, PDO::PARAM_INT); // แก้เป็น ref_mec_id
    $updateEmployee->bindParam(':case_id', $case_id, PDO::PARAM_INT);
    $updateEmployee->execute();

    // ตรวจสอบผลลัพธ์
    if ($updateCase && $updateEmployee) {
        echo "สถานะถูกอัปเดตเรียบร้อยแล้ว!";
    } else {
        echo "เกิดข้อผิดพลาดในการอัปเดตสถานะ";
    }
}
?>