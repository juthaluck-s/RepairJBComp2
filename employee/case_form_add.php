<?php
$queryMemberCase_Add = $condb->prepare("SELECT * FROM `tbl_member`");
$queryMemberCase_Add->execute();
$rsMemberCase_Add = $queryMemberCase_Add->fetchAll();

//คิวรี่ข้อมูลอาคาร
$queryBuildingCase = $condb->prepare("SELECT * FROM `tbl_building`");
$queryBuildingCase->execute();
$rsBuildingCase = $queryBuildingCase->fetchAll();
//คิวรี่ข้อมูลอุปกรณ์
$queryEquipmentCase = $condb->prepare("SELECT * FROM `tbl_equipment`");
$queryEquipmentCase->execute();
$rsEquipmentCase = $queryEquipmentCase->fetchAll();

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>แจ้งซ่อมคอมพิวเตอร์/อุปกรณ์</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-body">
                        <div class="card card-primary">

                            <!-- form start -->
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="card-body">

                                    <div class="form-group row">
                                        <label class="col-sm-2">แจ้งซ่อมจากรหัสพนักงาน : </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="ref_m_id" class="form-control"
                                                value="<?php echo $memberData['member_id'];
                                                                                                            $_SESSION['staff_id']; ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">ตึก/อาคาร</label>
                                        <div class="col-sm-3">
                                            <select name="ref_building_id" class="form-control" required>
                                                <option value="">กรุณาเลือก</option>
                                                <?php foreach ($rsBuildingCase as $row) { ?>
                                                <option value="<?php echo $row['building_id']; ?>">
                                                    <?php echo $row['building_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">ชั้น</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="case_floor" class="form-control" required
                                                placeholder="ชั้น">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">ห้อง</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="case_room" class="form-control" required
                                                placeholder="ห้อง">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">อุปกรณ์</label>
                                        <div class="col-sm-3">
                                            <select name="ref_equipment_id" class="form-control" required>
                                                <option value="">กรุณาเลือก</option>
                                                <?php foreach ($rsEquipmentCase as $row) { ?>
                                                <option value="<?php echo $row['equipment_id']; ?>">
                                                    <?php echo $row['equipment_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">รายละเอียด</label>
                                        <div class="col-sm-10">
                                            <textarea name="case_detail" id="summernote"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">ภาพประกอบ</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="case_img" class="custom-file-input"
                                                        id="exampleInputFile" accept="image/*">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose
                                                        file</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2"></label>
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-primary">เพิ่มข้อมูล</button>
                                            <a href="case.php" class="btn btn-danger">ยกเลิก</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    try {
        // รับค่าจากฟอร์ม
        $ref_building_id = $_POST['ref_building_id'];
        $case_detail = $_POST['case_detail'];
        $ref_equipment_id = $_POST['ref_equipment_id'];
        $case_floor = $_POST['case_floor'];
        $case_room = $_POST['case_room'];
        $ref_status_id = 1;

        // ตัวแปรสำหรับวันที่และการตั้งชื่อไฟล์
        $date1 = date("Ymd_His");
        $numrand = mt_rand();
        $upload = $_FILES['case_img']['name'];

        // ตรวจสอบการอัพโหลดไฟล์
        if ($upload != '') {
            // ตรวจสอบนามสกุลไฟล์
            $typefile = strrchr($_FILES['case_img']['name'], ".");
            if (in_array($typefile, ['.jpg', '.jpeg', '.png'])) {
                $path = "../assets/case_img/";
                $newname = $numrand . $date1 . $typefile;
                $path_copy = $path . $newname;
                move_uploaded_file($_FILES['case_img']['tmp_name'], $path_copy);
            } else {
                echo '<script>alert("คุณอัปโหลดไฟล์ไม่ถูกต้อง"); window.location = "case.php";</script>';
                exit();
            }
        } else {
            $newname = NULL; // กรณีไม่มีการอัปโหลดไฟล์
        }

        // SQL Insert
        $stmtInSertCase = $condb->prepare("INSERT INTO tbl_case (ref_building_id, case_detail, case_floor, ref_equipment_id, case_img, case_room, ref_m_id, ref_status_id) VALUES (:ref_building_id, :case_detail, :case_floor, :ref_equipment_id, :case_img, :case_room, :ref_m_id ,:ref_status_id)");

        $stmtInSertCase->bindParam(':ref_building_id', $ref_building_id, PDO::PARAM_INT);
        $stmtInSertCase->bindParam(':case_detail', $case_detail, PDO::PARAM_STR);
        $stmtInSertCase->bindParam(':case_floor', $case_floor, PDO::PARAM_STR);
        $stmtInSertCase->bindParam(':ref_equipment_id', $ref_equipment_id, PDO::PARAM_INT);
        $stmtInSertCase->bindParam(':case_img', $newname, PDO::PARAM_STR);
        $stmtInSertCase->bindParam(':case_room', $case_room, PDO::PARAM_STR);
        $stmtInSertCase->bindParam(':ref_m_id', $_SESSION['staff_id'], PDO::PARAM_INT);
        $stmtInSertCase->bindParam(':ref_status_id', $ref_status_id, PDO::PARAM_INT);

        $result = $stmtInSertCase->execute();

        if ($result) {
            echo '<script>
                    setTimeout(function() {
                        swal({
                            title: "เพิ่มข้อมูลสำเร็จ",
                            type: "success"
                        }, function() {
                            window.location = "case.php";
                        });
                    }, 1000);
                </script>';
        }
    } catch (Exception $e) {
        echo '<script>
                setTimeout(function() {
                    swal({
                        title: "เกิดข้อผิดพลาด",
                        type: "error"
                    }, function() {
                        window.location = "case.php";
                    });
                }, 1000);
            </script>';
    }
}
?>