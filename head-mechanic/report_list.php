<?php
$stmtCountAllCases = $condb->prepare("SELECT COUNT(*) as totalAllCases FROM tbl_case WHERE ref_status_id IN (1,2,3,4)");
$stmtCountAllCases->execute();
$rowAllCases = $stmtCountAllCases->fetch(PDO::FETCH_ASSOC);

$stmtCountAssignedCases = $condb->prepare("SELECT COUNT(*) as totalAssignedCases FROM tbl_case WHERE ref_status_id = 2");
$stmtCountAssignedCases->execute();
$rowAssignedCases = $stmtCountAssignedCases->fetch(PDO::FETCH_ASSOC);

$stmtCountSuccessCases = $condb->prepare("SELECT COUNT(*) as totalSuccessCases FROM tbl_case WHERE ref_status_id IN (3,4)");
$stmtCountSuccessCases->execute();
$rowSuccessCases = $stmtCountSuccessCases->fetch(PDO::FETCH_ASSOC);

$stmtCountAssessmentCase = $condb->prepare("
    SELECT SUM(assessment_count) as totalAssessmentCase 
    FROM tbl_assessment
");
$stmtCountAssessmentCase->execute();
$rowCountAssessmentCase = $stmtCountAssessmentCase->fetch(PDO::FETCH_ASSOC);

$stmtCountAssessmentCase_1 = $condb->prepare("
    SELECT SUM(assessment_count) as totalAssessmentCase_1
    FROM tbl_assessment 
    WHERE assessment_id = 1
");
$stmtCountAssessmentCase_1->execute();
$rowCountAssessmentCase_1 = $stmtCountAssessmentCase_1->fetch(PDO::FETCH_ASSOC);

$stmtCountAssessmentCase_2 = $condb->prepare("
    SELECT SUM(assessment_count) as totalAssessmentCase_2
    FROM tbl_assessment 
    WHERE assessment_id = 2
");
$stmtCountAssessmentCase_2->execute();
$rowCountAssessmentCase_2 = $stmtCountAssessmentCase_2->fetch(PDO::FETCH_ASSOC);

$stmtCountAssessmentCase_3 = $condb->prepare("
    SELECT SUM(assessment_count) as totalAssessmentCase_3
    FROM tbl_assessment 
    WHERE assessment_id = 3
");
$stmtCountAssessmentCase_3->execute();
$rowCountAssessmentCase_3 = $stmtCountAssessmentCase_3->fetch(PDO::FETCH_ASSOC);

$stmtCountAssessmentCase_4 = $condb->prepare("
    SELECT SUM(assessment_count) as totalAssessmentCase_4
    FROM tbl_assessment 
    WHERE assessment_id = 4
");
$stmtCountAssessmentCase_4->execute();
$rowCountAssessmentCase_4 = $stmtCountAssessmentCase_4->fetch(PDO::FETCH_ASSOC);

$stmtCountAssessmentCase_5 = $condb->prepare("
    SELECT SUM(assessment_count) as totalAssessmentCase_5
    FROM tbl_assessment 
    WHERE assessment_id = 5
");
$stmtCountAssessmentCase_5->execute();
$rowCountAssessmentCase_5 = $stmtCountAssessmentCase_5->fetch(PDO::FETCH_ASSOC);


$stmtStatusData = $condb->prepare("SELECT status_name, status_count FROM tbl_status");
$stmtStatusData->execute();
$statusData = $stmtStatusData->fetchAll(PDO::FETCH_ASSOC);

$stmtAssessmentData = $condb->prepare("SELECT assessment_name, assessment_count FROM tbl_assessment");
$stmtAssessmentData->execute();
$assessmentData = $stmtAssessmentData->fetchAll(PDO::FETCH_ASSOC);

?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        <h1>รายงาน - การแจ้งซ่อม</h1>
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


                                <div class="row">
                                    <div class="col-sm-6">
                                        <h4>กราฟรายงานจำนวนสถานะงาน</h4>
                                        <canvas id="statusChart"></canvas>
                                    </div>

                                    <div class="col-sm-6">
                                        <h4>กราฟรายงานจำนวนผลประเมิน</h4>
                                        <canvas id="assessmentChart"></canvas>
                                    </div>
                                </div>




                                <h4>รายงานภาพรวม</h4>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="bg-info">
                                            <th width="70%" class="text-center">รายการ</th>
                                            <th width="10%" class="text-center">จำนวน</th>
                                            <th width="10%" class="text-center">หน่วย</th>
                                            <th width="5%" class="text-center">View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>งานแจ้งซ่อมทั้งหมด</td>
                                            <td align="center">
                                                <?= htmlspecialchars($rowAllCases['totalAllCases']) ?>
                                            <td align="center">งาน</td>
                                            <td align="center"><a href="case.php?act=all" class="btn btn-info btn-xs"
                                                    target="_blank">view</a></td>
                                        </tr>
                                        <tr>
                                            <td>งานแจ้งซ่อมที่กำลังดำเนินการ</td>
                                            <td align="center">
                                                <?= htmlspecialchars($rowAssignedCases['totalAssignedCases']) ?>
                                            <td align="center">งาน</td>
                                            <td align="center"><a href="case.php?act=doing" class="btn btn-info btn-xs"
                                                    target="_blank">view</a></td>
                                        </tr>
                                        <tr>
                                            <td>งานแจ้งซ่อมที่ทำเสร็จแล้ว</td>
                                            <td align="center">
                                                <?= htmlspecialchars($rowSuccessCases['totalSuccessCases']) ?>
                                            <td align="center">งาน</td>
                                            <td align="center">
                                                <a href="case.php?act=success" class="btn btn-info btn-xs"
                                                    target="_blank">
                                                    view
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h4>การประเมิน</h4>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="bg-info">
                                            <th width="70%" class="text-center">รายการ</th>
                                            <th width="10%" class="text-center">จำนวน</th>
                                            <th width="10%" class="text-center">หน่วย</th>
                                            <th width="5%" class="text-center">View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            <td>งานแจ้งซ่อมที่ได้รับการประเมิน</td>
                                            <td align="center">
                                                <?= htmlspecialchars($rowCountAssessmentCase['totalAssessmentCase']) ?>
                                            <td align="center">งาน</td>
                                            <td align="center">
                                                <a href="report.php?act=asmclose" class="btn btn-info btn-xs"
                                                    target="_blank">view</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>งานแจ้งซ่อมที่ได้ผลประเมินดีมาก</td>
                                            <td align="center">
                                                <?= htmlspecialchars($rowCountAssessmentCase_1['totalAssessmentCase_1']) ?>
                                            <td align="center">งาน</td>
                                            <td align="center">
                                                <a href="report.php?act=asm1" class="btn btn-info btn-xs"
                                                    target="_blank">view</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>งานแจ้งซ่อมที่ได้ผลประเมินดี</td>
                                            <td align="center">
                                                <?= htmlspecialchars($rowCountAssessmentCase_2['totalAssessmentCase_2']) ?>
                                            <td align="center">งาน</td>
                                            <td align="center">
                                                <a href="report.php?act=asm2" class="btn btn-info btn-xs"
                                                    target="_blank">view</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>งานแจ้งซ่อมที่ได้ผลประเมินปานกลาง</td>
                                            <td align="center">
                                                <?= htmlspecialchars($rowCountAssessmentCase_3['totalAssessmentCase_3']) ?>
                                            <td align="center">งาน</td>
                                            <td align="center">
                                                <a href="report.php?act=asm3" class="btn btn-info btn-xs"
                                                    target="_blank">view</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>งานแจ้งซ่อมที่ได้ผลประเมินพอใช้</td>
                                            <td align="center">
                                                <?= htmlspecialchars($rowCountAssessmentCase_4['totalAssessmentCase_4']) ?>
                                            <td align="center">งาน</td>
                                            <td align="center">
                                                <a href="report.php?act=asm4" class="btn btn-info btn-xs"
                                                    target="_blank">view</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>งานแจ้งซ่อมที่ได้ผลประเมินแย่</td>
                                            <td align="center">
                                                <?= htmlspecialchars($rowCountAssessmentCase_5['totalAssessmentCase_5']) ?>
                                            <td align="center">งาน</td>
                                            <td align="center">
                                                <a href="report.php?act=asm5" class="btn btn-info btn-xs"
                                                    target="_blank">view</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>