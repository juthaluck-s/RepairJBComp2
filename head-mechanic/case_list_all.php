<?php

// คิวรีรายการกรณีทั้งหมด
$queryCaseList = $condb->prepare("SELECT *
                                  FROM tbl_case AS c
                                  LEFT JOIN tbl_member AS emp ON c.ref_m_id = emp.m_id
                                   INNER JOIN tbl_department AS dpm ON emp.ref_department_id = dpm.department_id
                                    INNER JOIN tbl_position AS pst ON emp.ref_position_id = pst.position_id
                                  LEFT JOIN tbl_equipment AS eqm ON c.ref_equipment_id = eqm.equipment_id
                                  LEFT JOIN tbl_status AS stt ON c.ref_status_id = stt.status_id
                                  LEFT JOIN tbl_assessment AS asm ON c.ref_assessment_id = asm.assessment_id
                                  LEFT JOIN tbl_building AS bd ON c.ref_building_id = bd.building_id WHERE c.ref_status_id IN (1,2,3,4)
                                --   WHERE c.ref_status_id IN (3, 4) เปิดทีหลัง
                                  ");

$queryCaseList->execute();
$rsCaseList = $queryCaseList->fetchAll();
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
                                            NEW <span class="badge"></span></a>
                                        <a href="case.php?act=doing" class="btn btn-warning">
                                            Assigned <span class="badge"></span></a>
                                        <a href="case.php?act=success" class="btn btn-success">
                                            Success <span class="badge"></span></a>
                                        <a href="case.php?act=all" class="btn btn-danger">
                                            AllJob <span class="badge"></span></a>
                                    </p>
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

                                                        <th width="8%" class="text-center">ดูงาน</th>

                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    <?php
                                                    $i = 1;
                                                    ?>

                                                    <?php $i = 1; // เริ่มต้นลำดับที่ 1 
                                                    ?>
                                                    <?php foreach ($rsCaseList as $row) { ?>
                                                        <tr>
                                                            <td align="center"> <?php echo $i++; // แสดงลำดับปัจจุบัน และเพิ่มค่าในบรรทัดเดียว 
                                                                                ?></td>
                                                            <td><img src="../assets/case_img/<?= $row['case_img']; ?>"
                                                                    width="70px"></td>
                                                            <td align="center"><?= $row['equipment_name']; ?></td>
                                                            <td>
                                                                <?= $row['case_detail'] . 'สถานที่ : ' . $row['building_name'] . ' ชั้น ' . $row['case_floor'] . ' ห้อง ' . $row['case_room'] . '<br>' . $row['title_name'] . ' ' . $row['firstname'] . ' ' . $row['lastname'] .
                                                                    '<br>แผนก :  ' . $row['department_name'] . '<br>ตำแหน่ง : ' . $row['position_name'] . '<br>เบอร์โทร :  ' . $row['m_tel'] . '<br>Email : ' . $row['m_email'] . '<br>ว/ด/ป ' . date('d/m/Y H:i:s', strtotime($row['dateSave'])) ?>
                                                            </td>
                                                            <td align="center"><?= htmlspecialchars($row['status_name']); ?>
                                                            </td>
                                                            <td align="center">
                                                                <a href="case.php?id=<?= $row['case_id']; ?>&act=view&no=<?= $i - 1; ?>"
                                                                    class="btn btn-success btn-sm">Open</a>
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