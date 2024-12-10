<?php
//คิวรี่ข้อมูลสมาชิก
$queryproduct = $condb->prepare("SELECT p.id, p.product_name, p.product_qty, p.product_price, p.product_image, t.type_name
FROM tbl_product  as p 
INNER JOIN tbl_type as t ON p.ref_type_id = t.type_id
GROUP by p.id");
$queryproduct->execute();
$rsproduct = $queryproduct->fetchAll();

// echo '<pre></pre>';
// $queryproduct->debugDumpParams();
// exit;

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>จัดการข้อมูลสินค้า

                        <a href="product.php?act=add" class="btn btn-primary">เพิ่มข้อมูล</a>


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
                                        <th width="5%">ภาพสินค้า</th>
                                        <th width="20%">ประเภทสินค้า</th>
                                        <th width="33%">ชื่อสินค้า</th>
                                        <th width="10%" class="text-center">สต็อก</th>
                                        <th width="10%" class="text-center">ราคา</th>
                                        <th width="5%" class="text-center">+ภาพ</th>
                                        <th width="7%" class="text-center">แก้ไขข้อมูล</th>
                                        <th width="5%" class="text-center">ลบ</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    $i = 1;
                                    ?>

                                    <?php foreach ($rsproduct as $row) { ?>

                                    <tr>
                                        <td align="center"> <?php echo $i++ ?></td>
                                        <td><img src="../assets/product_img/<?= $row['product_image']; ?>" width="70px">
                                        </td>
                                        <td><?= $row['type_name']; ?></td>
                                        <td><?= $row['product_name']; ?></td>
                                        <td align="right"><?= $row['product_qty']; ?></td>
                                        <td align="right"><?= number_format($row['product_price'], 2); ?></td>

                                        <td align="center"><a href="product.php?id=<?= $row['id']; ?>&act=image"
                                                class="btn btn-info btn-sm">+ภาพ</a></td>

                                        <td align="center"><a href="product.php?id=<?= $row['id']; ?>&act=edit"
                                                class="btn btn-warning btn-sm">แก้ไข</a></td>
                                        <td align="center"><a href="product.php?id=<?= $row['id']; ?>&act=delete"
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