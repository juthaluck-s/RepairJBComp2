<?php
//คิวรี่ข้อมูลสมาชิก
$querybuilding = $condb->prepare("SELECT * FROM tbl_building");
$querybuilding->execute();
$rsbuilding = $querybuilding->fetchAll();

// echo '<pre>';
// $querybuilding->debugDumpParams();
// exit;
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>จัดการข้อมูลตึก/อาคาร
                        <a href="building.php?act=add" class="btn-edit4 btn-lg">เพิ่มข้อมูล</a>
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
                                    <tr class="bg-edit">
                                        <th width="5%" class="text-center">No.</th>
                                        <th width="85%" class="text-center">ตึก/อาคาร</th>
                                        <th width="5%" class="text-center">แก้ไข</th>
                                        <th width="5%" class="text-center">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1; //start number
                                    foreach ($rsbuilding as $row) { ?>
                                    <tr>
                                        <td align="center"> <?php echo $i++ ?> </td>
                                        <td><?= $row['building_name']; ?></td>
                                        <td align="center" style=" vertical-align: middle;">
                                            <a href="building.php?id=<?= $row['building_id']; ?>&act=edit"
                                                class="btn-edit1 btn-sm">แก้ไข</a>
                                        </td>
                                        <td align="center">
                                            <a href="building.php?id=<?= $row['building_id']; ?>&act=delete"
                                                class="btn-edit3  btn-sm"
                                                onclick="return confirm('ยืนยันการลบข้อมูล??');">ลบ</a>
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