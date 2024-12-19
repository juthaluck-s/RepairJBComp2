<?php
$queryMember = $condb->prepare("SELECT *
FROM tbl_member AS m
INNER JOIN tbl_department AS dpm ON m.ref_department_id = dpm.department_id
INNER JOIN tbl_position AS pst ON m.ref_position_id = pst.position_id
INNER JOIN tbl_level AS lev ON m.ref_level_id = lev.level_id
");
$queryMember->execute();
$rsMember = $queryMember->fetchAll();


?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>จัดการข้อมูลพนักงาน

                        <a href="member.php?act=add" class="btn btn-primary">เพิ่มข้อมูล</a>


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
                                    <!-- <tr class="table-info">
                                        <th class="text-center">No.</th>
                                        <th class="text-center">ชื่อ - นามสกุล</th>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">ตำแหน่ง</th>
                                        <th class="text-center">แก้รหัสผ่าน</th>
                                        <th class="text-center">แก้ไขข้อมูล</th>
                                        <th class="text-center">ลบ</th>
                                    </tr> -->

                                    <tr class="table-info">
                                        <th width="5%" class="text-center">No.</th>
                                        <th width="10%" class="text-center">รหัสพนักงาน</th>
                                        <th width="8%" class="text-center">สิทธิ์ใช้งาน</th>
                                        <th class="text-center">ชื่อ - นามสกุล</th>
                                        <th width="8%" class="text-center">แผนก</th>
                                        <th width="8%" class="text-center">ตำแหน่ง</th>
                                        <th width="10%" class="text-center">Username</th>
                                        <th width="8%" class="text-center">แก้รหัสผ่าน</th>
                                        <th width="8%" class="text-center">แก้ไขข้อมูล</th>
                                        <th width="4%" class="text-center">ลบ</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    $i = 1;
                                    ?>

                                    <?php foreach ($rsMember as $row) { ?>

                                        <tr>
                                            <td align="center"> <?php echo $i++ ?></td>

                                            <td align="center"><?= $row['member_id']; ?></td>

                                            <td align="center"><?= $row['level_name']; ?></td>

                                            <td>
                                                <?=
                                                $row['title_name'] . $row['firstname'] . ' ' . $row['lastname'] . ' <br>' .  ' ' . 'เบอร์โทร :' . ' ' .
                                                    $row['m_tel'] . '<br>' . ' ' . 'Email :' . ' ' .
                                                    $row['m_email']
                                                ?>
                                            </td>
                                            <td align="center"><?= $row['department_name']; ?></td>
                                            <td align="center"><?= $row['position_name']; ?></td>
                                            <td align="center"><?= $row['username']; ?></td>

                                            <td align="center"><a href="member.php?m_id=<?= $row['m_id']; ?>&act=editPwd"
                                                    class="btn btn-info btn-sm">แก้รหัส</a></td>
                                            <td align="center"><a href="member.php?m_id=<?= $row['m_id']; ?>&act=edit"
                                                    class="btn btn-warning btn-sm">แก้ไข</a></td>
                                            <td align="center"><a href="member.php?m_id=<?= $row['m_id']; ?>&act=delete"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่');">ลบ</a>
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