<?php

// คิวรีรายการกรณีทั้งหมด
$queryCaseAsm3 = $condb->prepare("SELECT *
                                  FROM tbl_case AS c
                                  LEFT JOIN tbl_member AS emp ON c.ref_m_id = emp.m_id
                                   INNER JOIN tbl_department AS dpm ON emp.ref_department_id = dpm.department_id
                                    INNER JOIN tbl_position AS pst ON emp.ref_position_id = pst.position_id
                                  LEFT JOIN tbl_equipment AS eqm ON c.ref_equipment_id = eqm.equipment_id
                                  LEFT JOIN tbl_status AS stt ON c.ref_status_id = stt.status_id
                                  LEFT JOIN tbl_assessment AS asm ON c.ref_assessment_id = asm.assessment_id
                                  LEFT JOIN tbl_building AS bd ON c.ref_building_id = bd.building_id  WHERE c.ref_status_id IN (4) AND asm.assessment_id = 3
                                                                ");

$queryCaseAsm3->execute();
$rsCaseAsm3 = $queryCaseAsm3->fetchAll();


?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>รายงานการแจ้งซ่อมที่ได้ผลประเมินปานกลาง</h1>
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
                                            <table id="example1" class="table table-bordered table-striped table-sm">

                                                <thead>
                                                    <tr class="bg-edit">
                                                        <th width="5%" class="text-center">No.</th>
                                                        <th width="5%" class="text-center">รูปภาพ</th>
                                                        <th width="10%" class="text-center">อุปกรณ์</th>
                                                        <th class="text-center">รายละเอียด</th>
                                                        <th width="8%" class="text-center">สถานะ</th>
                                                        <th width="8%" class="text-center">ผลประเมิน</th>
                                                        <th width="8%" class="text-center">ดูงาน</th>

                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    <?php
                                                    $i = 1;
                                                    ?>

                                                    <?php $i = 1; // เริ่มต้นลำดับที่ 1 
                                                    ?>
                                                    <?php foreach ($rsCaseAsm3 as $row) { ?>
                                                    <tr>
                                                        <td align="center"> <?php echo $i++; // แสดงลำดับปัจจุบัน และเพิ่มค่าในบรรทัดเดียว 
                                                                                ?></td>
                                                        <td><img src="../assets/case_img/<?= $row['case_img']; ?>"
                                                                width="70px"></td>
                                                        <td align="center"><?= $row['equipment_name']; ?></td>
                                                        <td>
                                                            <?= $row['case_detail'] . '<br>สถานที่ : ' . $row['building_name'] . ' ชั้น ' . $row['case_floor'] . ' ห้อง ' . $row['case_room'] . '<br>' . $row['title_name'] . '' . $row['firstname'] . ' ' . $row['lastname'] .
                                                                    '<br>แผนก :  ' . $row['department_name'] . '<br>ตำแหน่ง : ' . $row['position_name'] . '<br>เบอร์โทร :  ' . $row['m_tel'] . '<br>Email : ' . $row['m_email'] . '<br>ว/ด/ป ' . date('d/m/Y H:i:s', strtotime($row['dateSave'])) ?>
                                                        </td>
                                                        <td align="center" style=" vertical-align: middle;">
                                                            <?= htmlspecialchars($row['status_name']); ?>
                                                        </td>
                                                        </td>
                                                        <td align="center" style=" vertical-align: middle;">
                                                            <?= htmlspecialchars($row['assessment_name']); ?>
                                                        </td>
                                                        <td align="center" style=" vertical-align: middle;">
                                                            <a href="case.php?id=<?= $row['case_id']; ?>&act=view&no=<?= $i - 1; ?>"
                                                                class="btn-edit5  btn-sm">Open</a>
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
<!-- /.content-wrapper -->