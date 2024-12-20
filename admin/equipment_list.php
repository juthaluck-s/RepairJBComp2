<?php
//คิวรี่ข้อมูลสมาชิก
$queryequipment = $condb->prepare("SELECT * FROM tbl_equipment");
$queryequipment->execute();
$rsequipment = $queryequipment->fetchAll();

// echo '<pre>';
// $queryequipment->debugDumpParams();
// exit;
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>จัดการรายการอุปกรณ์ทั้งหมด
                        <a href="equipment.php?act=add" class="btn btn-primary">เพิ่มข้อมูล</a>
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
                                    <tr class="bg-dark">
                                        <th width="5%" class="text-center">No.</th>
                                        <th width="85%" class="text-center">ชื่ออุปกรณ์</th>
                                        <th width="5%" class="text-center">แก้ไข</th>
                                        <th width="5%" class="text-center">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1; //start number
                                    foreach ($rsequipment as $row) { ?>
                                        <tr>
                                            <td align="center"> <?php echo $i++ ?> </td>
                                            <td><?= $row['equipment_name']; ?></td>
                                            <td align="center">
                                                <a href="equipment.php?id=<?= $row['equipment_id']; ?>&act=edit"
                                                    class="btn btn-warning btn-sm">แก้ไข</a>
                                            </td>
                                            <td align="center">
                                                <a href="equipment.php?id=<?= $row['equipment_id']; ?>&act=delete"
                                                    class="btn btn-danger btn-sm"
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