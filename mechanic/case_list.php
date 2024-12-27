<?php
// ดึง m_id ของผู้ใช้งานจาก session หรือระบบการยืนยันตัวตน
// ตัวอย่างสมมุติว่าได้ m_id จาก session
$m_id = $_SESSION['staff_id'];  // ตรวจสอบว่า session ได้ตั้งค่า m_id หรือยัง

$queryCaseList = $condb->prepare("SELECT *
FROM tbl_case AS c
LEFT JOIN tbl_member AS m ON c.ref_m_id = m.m_id
LEFT JOIN tbl_mechanic AS mec ON c.ref_mec_id = mec.mec_id
LEFT JOIN tbl_head_mechanic AS hmec ON c.ref_head_mechanic_id = hmec.head_mechanic_id
LEFT JOIN tbl_equipment AS eqm ON c.ref_equipment_id = eqm.equipment_id
LEFT JOIN tbl_status AS stt ON c.ref_status_id = stt.status_id
LEFT JOIN tbl_assessment AS asm ON c.ref_assessment_id = asm.assessment_id
LEFT JOIN tbl_building AS bd ON c.ref_building_id = bd.building_id
WHERE c.ref_mec_id = :m_id");  // เงื่อนไขเพื่อเลือกเฉพาะข้อมูลที่มอบหมายให้ผู้ใช้งาน

$queryCaseList->bindParam(':m_id', $m_id, PDO::PARAM_INT);
$queryCaseList->execute();
$rsCaseList = $queryCaseList->fetchAll();




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
                    <h1>รายการแจ้งซ่อมคอมพิวเตอร์/อุปกรณ์ </h1>
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
                                    <tr class="bg-edit">
                                        <th width="5%" class="text-center">No.</th>
                                        <th width="5%" class="text-center">รูปภาพ</th>
                                        <th width="10%" class="text-center">อุปกรณ์</th>
                                        <th class="text-center">รายละเอียด</th>
                                        <th width="8%" class="text-center">สถานะ</th>
                                        <th width="12%" class="text-center">ผู้มอบหมายงาน</th>
                                        <th width="8%" class="text-center">Y/M/D</th>
                                        <th width="8%" class="text-center">ส่งงาน</th>
                                        <th width="10%" class="text-center">ผลประเมิน</th>

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



                                            <td>
                                                <b> <?= $row['case_detail']; ?> </b><br>
                                                สถานที่ : <?= $row['building_name']; ?> ชั้น
                                                <?= $row['case_floor']; ?> ห้อง
                                                <?= $row['case_room']; ?><br>
                                                <?= $row['title_name'] . ' ' . $row['firstname'] . ' ' . $row['lastname']; ?><br>
                                                เบอร์โทร : <?= $row['m_tel']; ?><br>
                                                Email : <?= $row['m_email']; ?><br>
                                            </td>
                                            <td align="center"><?= $row['status_name']; ?></td>
                                            <td>
                                                <?= $row['head_mechanic_title_name'] . ' ' . $row['head_mechanic_firstname'] . ' ' . $row['head_mechanic_lastname'] . ' <br>' . 'เบอร์โทร: ' . $row['head_mechanic_tel'] . '<br>' . 'Email: ' . $row['head_mechanic_email'] ?>
                                            </td>


                                            <td align="center"><?= $row['dateSave']; ?></a></td>

                                            <td align="center" style=" vertical-align: middle;">
                                                <?php if ($row['ref_status_id'] == 2) { // กำลังซ่อม 
                                                ?>
                                                    <a href="case.php?id=<?= $row['case_id']; ?>&act=openjob&no=<?= $i - 1; ?>"
                                                        class="btn-edit1 btn-sm">ส่งงาน</a>
                                                <?php } else { ?>
                                                    -
                                                <?php } ?>
                                            </td>

                                            <td align="center" style=" vertical-align: middle;">
                                                <?php
                                                if ($row['ref_status_id'] == 3) { // รอประเมินผล
                                                    echo "รอผลประเมิน";
                                                } elseif ($row['ref_status_id'] == 4) { // สถานะที่เกี่ยวข้องกับการประเมิน
                                                    // ใช้ echo แบบถูกต้องเพื่อแสดงลิงก์
                                                    echo '<a href="case.php?id=' . $row['case_id'] . '&act=view&no=' . ($i - 1) . '" class="btn-edit5 btn-sm">Open</a>';
                                                } else {
                                                    echo "-";
                                                }
                                                ?>
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