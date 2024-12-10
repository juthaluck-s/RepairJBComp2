<?php

$queryCaseList = $condb->prepare("SELECT c.case_id, c.case_detail, c.case_floor, c.case_room, c.case_img, eqm.equipment_name, stt.status_name, asm.assessment_name, bd.building_name,
    m.title_name, m.firstname, m.lastname, m.m_tel, m.m_email
FROM tbl_case AS c
LEFT JOIN tbl_member AS m ON c.ref_m_id = m.m_id
LEFT JOIN tbl_equipment AS eqm ON c.ref_equipment_id = eqm.equipment_id
LEFT JOIN tbl_status AS stt ON c.ref_status_id = stt.status_id
LEFT JOIN tbl_assessment AS asm ON c.ref_assessment_id = asm.assessment_id
LEFT JOIN tbl_building AS bd ON c.ref_building_id = bd.building_id
");

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
                    <h1>แจ้งซ่อมคอมพิวเตอร์/อุปกรณ์

                        <a href="case.php?act=add" class="btn btn-primary">เพิ่มข้อมูล</a>


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
                                            <td><?= $row['case_detail']; ?></td>
                                            <td align="right"><?= $row['status_name']; ?></td>
                                            <td>
                                                <?= $row['title_name'] . ' ' . $row['firstname'] . ' ' . $row['lastname'] . ' <br>' . 'เบอร์โทร: ' . $row['m_tel'] . '<br>' . 'Email: ' . $row['m_email'] ?>
                                            </td>


                                            <!-- <td align="center"><a href="case.php?id=<?= $row['id']; ?>&act=image"
                                                    class="btn btn-info btn-sm">+ภาพ</a></td> -->

                                            <td align="center"><a
                                                    href="case.php?id=<?= $row['assessment_name']; ?>&act=assessment"
                                                    class="btn btn-info btn-sm">ประเมิน</a></td>


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