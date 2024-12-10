<?php
//คิวรี่ข้อมูลสมาชิก
$queryMember = $condb->prepare("SELECT * FROM `tbl_member`");
$queryMember->execute();
$rsMember = $queryMember->fetchAll();

// echo '<pre></pre>';
// $queryMember->debugDumpParams();
// exit;

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
                                    <tr class="table-info">
                                        <th width="5%" class="text-center">No.</th>
                                        <th width="46%" class="text-center">ชื่อ - นามสกุล</th>
                                        <th width="20%" class="text-center">Username</th>
                                        <th width="10%" class="text-center">ตำแหน่ง</th>
                                        <th width="7%" class="text-center">แก้รหัสผ่าน</th>
                                        <th width="7%" class="text-center">แก้ไขข้อมูล</th>
                                        <th width="5%" class="text-center">ลบ</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    $i = 1;
                                    ?>

                                    <?php foreach ($rsMember as $row) { ?>

                                        <tr>
                                            <td align="center"> <?php echo $i++ ?></td>
                                            <td>
                                                <?= $row['title_name'] . $row['firstname'] . ' ' . $row['lastname']; ?>
                                            </td>
                                            <td>
                                                <?= $row['username']; ?>
                                            </td>
                                            <td align="center">
                                                <?= $row['m_level']; ?>
                                            </td>
                                            <td align="center"><a href="member.php?id=<?= $row['id']; ?>&act=editPwd"
                                                    class="btn btn-info btn-sm">แก้รหัส</a></td>
                                            <td align="center"><a href="member.php?id=<?= $row['id']; ?>&act=edit"
                                                    class="btn btn-warning btn-sm">แก้ไข</a></td>
                                            <td align="center"><a href="member.php?id=<?= $row['id']; ?>&act=delete"
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