<?php
if (!isset($_SESSION['staff_id'])) {
    // ถ้ายังไม่ได้ล็อกอินให้ส่งกลับไปหน้าเข้าสู่ระบบ
    echo "<script>alert('กรุณาเข้าสู่ระบบก่อน'); window.location = 'login.php';</script>";
    exit;
}

$mec_id = $_SESSION['staff_id']; // ใช้ mec_id จาก session

// คิวรีข้อมูลช่างจาก tbl_mechanic
$queryMecReport = $condb->prepare("SELECT * FROM tbl_mechanic WHERE mec_id = :mec_id");
$queryMecReport->bindParam(':mec_id', $mec_id, PDO::PARAM_INT);
$queryMecReport->execute();
$rsMecReport = $queryMecReport->fetch(PDO::FETCH_ASSOC);

// ตรวจสอบว่าพบข้อมูลหรือไม่
if (!$rsMecReport) {
    echo "<script>alert('ไม่พบข้อมูลสำหรับช่างนี้'); window.history.back();</script>";
    exit;
}

// คิวรีข้อมูลการประเมินจาก tbl_case
$queryAssessmentReport = $condb->prepare("
    SELECT 
        c.ref_assessment_id,
        COUNT(*) AS assessment_count,
        a.assessment_name
    FROM 
        tbl_case c
    JOIN
        tbl_assessment a ON c.ref_assessment_id = a.assessment_id
    WHERE 
        c.ref_mec_id = :ref_mec_id
    GROUP BY 
        c.ref_assessment_id, a.assessment_name
    ORDER BY 
        c.ref_assessment_id
");
$queryAssessmentReport->bindParam(':ref_mec_id', $mec_id, PDO::PARAM_INT);
$queryAssessmentReport->execute();
$assessmentData = $queryAssessmentReport->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        <h1>รายงานการทำงานของช่าง : <?= htmlspecialchars($rsMecReport['mec_firstname']) ?></h1>
                    </h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="box-body">
                                <h4>รายงานภาพรวม</h4>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="info">
                                            <th width="80%" class="text-center">รายการ</th>
                                            <th width="10%" class="text-center">จำนวน</th>
                                            <th width="10%" class="text-center">หน่วย</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>จำนวนงานที่ได้รับมอบหมาย</td>
                                            <td align="center"><?= htmlspecialchars($rsMecReport['mec_all_job']) ?>
                                            </td>
                                            <td align="center">งาน</td>
                                        </tr>
                                        <tr>
                                            <td>จำนวนงานที่กำลังทำ</td>
                                            <td align="center"><?= htmlspecialchars($rsMecReport['mec_doing']) ?>
                                            <td align="center">งาน</td>
                                        </tr>
                                        <tr>
                                            <td>จำนวนงานที่ทำเสร็จแล้ว</td>
                                            <td align="center"><?= htmlspecialchars($rsMecReport['mec_close']) ?>
                                            <td align="center">งาน</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <h4>ผลการประเมินงานทั้งหมด</h4>
                                <?php if ($assessmentData): ?>
                                    <table class="table table-bordered table-striped ">
                                        <thead>
                                            <tr class="bg-success">
                                                <th width="80%" class="text-center">รายการ</th>
                                                <th width="10%" class="text-center">จำนวน</th>
                                                <th width="10%" class="text-center">หน่วย</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($assessmentData as $row) {
                                                echo "
                                                    <tr>
                                                        <td>{$row['assessment_name']}</td>
                                                        <td align='center'>{$row['assessment_count']}</td>
                                                        <td align='center'>งาน</td>
                                                    </tr>
                                                ";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <p>ไม่มีข้อมูลการประเมินสำหรับช่างนี้</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>