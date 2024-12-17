<?php

//จำนวนงานแจ้งซ่อมทั้งหมด
$stmtCountCase = $condb->prepare("SELECT COUNT(*) as totalCase FROM tbl_case");
$stmtCountCase->execute();
$rowCase = $stmtCountCase->fetch(PDO::FETCH_ASSOC);

//จำนวนสมาชิก
$stmtCountMember = $condb->prepare("SELECT COUNT(*) as totalMember FROM tbl_member");
$stmtCountMember->execute();
$rowM = $stmtCountMember->fetch(PDO::FETCH_ASSOC);

//จำนวนสินค้า
$stmtCountProduct = $condb->prepare("SELECT COUNT(*) as totalProduct FROM tbl_product");
$stmtCountProduct->execute();
$rowP = $stmtCountProduct->fetch(PDO::FETCH_ASSOC);

//จำนวนผู้เข้าชมเว็บไซต์แยกตามวัน
$queryViewByDay = $condb->prepare("SELECT DATE_FORMAT(c_date,'%d/%m/%Y') as datesave, COUNT(*) as total
FROM tbl_counter
GROUP BY DATE_FORMAT(c_date,'%Y-%m-%d')
ORDER BY DATE_FORMAT(c_date,'%Y-%m-%d') DESC");
$queryViewByDay->execute();
$rsVd = $queryViewByDay->fetchAll();

//นำข้อมูลที่ได้จากคิวรี่มากำหนดรูปแบบข้อมุลให้ถูกโครงสร้างของกราฟที่ใช้ *อ่าน docs เพิ่มเติม
$report_data = array();
foreach ($rsVd as $rs) {
    /*
โครงสร้างข้อมูลของกราฟ
{
name: "Chrome",
y: 62.74,
drilldown: "Chrome"
},
*/
    //ทำข้อมูลให้ถูกโครงสร้างก่อนนำไปแสดงในกราฟ docs : https://www.highcharts.com/demo/column-drilldown
    $report_data[] = '
{
name:' . '"' . $rs['datesave'] . '"' . ',' //label
        . 'y:' . $rs['total'] . //ตัวเลขยอดขาย
        ','
        . 'drilldown:' . '"' . $rs['datesave'] . '"' . ',' //label ด้านล่าง
        . '}';
}
//ตัด , ตัวสุดท้ายออก
$report_data = implode(",", $report_data);

//จำนวนผู้ใช้แยกตามเดือน
$queryViewByMonth = $condb->prepare("SELECT MONTHNAME(c_date) as monthNames, COUNT(*) as totalByMonth
FROM tbl_counter
GROUP BY MONTH(c_date)
ORDER BY DATE_FORMAT(c_date, '%Y-%m') DESC;");
$queryViewByMonth->execute();
$rsVM = $queryViewByMonth->fetchAll();

//นำข้อมูลที่ได้จากคิวรี่มากำหนดรูปแบบข้อมุลให้ถูกโครงสร้างของกราฟที่ใช้ *อ่าน docs เพิ่มเติม
$report_data_month = array();
foreach ($rsVM as $rs) {
    $report_data_month[] = '
{
name:' . '"' . $rs['monthNames'] . '"' . ',' //label
        . 'y:' . $rs['totalByMonth'] . //ตัวเลขยอดขาย
        ','
        . 'drilldown:' . '"' . $rs['monthNames'] . '"' . ',' //label ด้านล่าง
        . '}';
}
//ตัด , ตัวสุดท้ายออก
$report_data_month = implode(",", $report_data_month);

//จำนวนผู้ใช้แยกตามปี
$queryViewByYear = $condb->prepare("SELECT YEAR(c_date) as years, COUNT(*) as totalByYear
FROM tbl_counter
GROUP BY YEAR(c_date)
ORDER BY YEAR(c_date) DESC;");
$queryViewByYear->execute();
$rsVy = $queryViewByYear->fetchAll();

//นำข้อมูลที่ได้จากคิวรี่มากำหนดรูปแบบข้อมุลให้ถูกโครงสร้างของกราฟที่ใช้ *อ่าน docs เพิ่มเติม
$report_data_year = array();
foreach ($rsVy as $rs) {
    $report_data_year[] = '
{
name:' . '"' . $rs['years'] . '"' . ',' //label
        . 'y:' . $rs['totalByYear'] . //ตัวเลขยอดขาย
        ','
        . 'drilldown:' . '"' . $rs['years'] . '"' . ',' //label ด้านล่าง
        . '}';
}
//ตัด , ตัวสุดท้ายออก
$report_data_year = implode(",", $report_data_year);



?>




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard/รายงานภาพรวม</h1>
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

                            <!-- Small boxes (Stat box) -->
                            <div class="row">
                                <div class="col-lg-6 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h3><?= $rowCase['totalCase']; ?></h3>

                                            <p>จำนวนงานแจ้งซ่อมทั้งหมด</p>

                                        </div>
                                        <div class="icon">
                                            <i class="nav-icon fas fa-screwdriver-wrench"></i>
                                        </div>
                                        <!-- <a href="#" class="small-box-footer">More info <i
                                                class="fas fa-arrow-circle-right"></i></a> -->
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-6 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-warning">
                                        <div class="inner">
                                            <h3><?= $rowM['totalMember']; ?></h3>

                                            <p>จำนวนพนักงานทั้งหมด</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-person-stalker"></i>
                                        </div>
                                        <!-- <a href="member.php" class="small-box-footer">More info <i
                                                class="fas fa-arrow-circle-right"></i></a> -->
                                    </div>
                                </div>

                            </div>

                            <!-- /.row -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <figure class="highcharts-figure">
                                        <div id="container"></div>
                                        <p class="highcharts-description">.....</p>
                                    </figure>
                                    <script>
                                        // Create the chart
                                        Highcharts.chart('container', {
                                            chart: {
                                                type: 'line'
                                            },
                                            title: {
                                                // text: 'จำนวนการทำแบบประเมินแยกตามวัน'
                                                text: 'จำนวนการเข้าชมเว็บไซต์แยกตามวัน'
                                            },
                                            subtitle: {
                                                text: 'รวมทั้งสิ้น <?= $rowCase['totalCase']; ?> ครั้ง '
                                            },
                                            accessibility: {
                                                announceNewData: {
                                                    enabled: true
                                                }
                                            },
                                            xAxis: {
                                                type: 'category'
                                            },
                                            yAxis: {
                                                title: {
                                                    // text: 'จำนวนการประเมินเว็บไซต์'
                                                    text: 'จำนวนการเข้าชมเว็บไซต์'
                                                }
                                            },
                                            legend: {
                                                enabled: false
                                            },
                                            plotOptions: {
                                                series: {
                                                    borderWidth: 0,
                                                    dataLabels: {
                                                        enabled: true,
                                                        format: '{point.y:.0f} ครั้ง'
                                                    }
                                                }
                                            },
                                            tooltip: {
                                                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f} ครั้ง</b> of total<br/>'
                                            },
                                            series: [{
                                                // name: "จำนวนการประเมินเว็บไซต์",
                                                name: "จำนวนการเข้าชมเว็บไซต์",
                                                colorByPoint: true,
                                                //เอาข้อมูลมา echo ตรงนี้
                                                data: [<?= $report_data; ?>]
                                            }]
                                        });
                                    </script>
                                </div>

                                <div class="col-sm-8">
                                    <figure class="highcharts-figure">
                                        <div id="container2"></div>
                                        <p class="highcharts-description">....</p>
                                    </figure>
                                    <script>
                                        // Create the chart
                                        Highcharts.chart('container2', {
                                            chart: {
                                                type: 'column'
                                            },
                                            title: {
                                                // text: 'จำนวนการทำแบบประเมินแยกตามวัน'
                                                text: 'จำนวนการเข้าชมเว็บไซต์แยกตามเดือน'
                                            },
                                            subtitle: {
                                                text: 'รวมทั้งสิ้น <?= $rowCase['totalCase']; ?> ครั้ง '
                                            },
                                            accessibility: {
                                                announceNewData: {
                                                    enabled: true
                                                }
                                            },
                                            xAxis: {
                                                type: 'category'
                                            },
                                            yAxis: {
                                                title: {
                                                    // text: 'จำนวนการประเมินเว็บไซต์'
                                                    text: 'จำนวนการเข้าชมเว็บไซต์'
                                                }
                                            },
                                            legend: {
                                                enabled: false
                                            },
                                            plotOptions: {
                                                series: {
                                                    borderWidth: 0,
                                                    dataLabels: {
                                                        enabled: true,
                                                        format: '{point.y:.0f} ครั้ง'
                                                    }
                                                }
                                            },
                                            tooltip: {
                                                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f} ครั้ง</b> of total<br/>'
                                            },
                                            series: [{
                                                // name: "จำนวนการประเมินเว็บไซต์",
                                                name: "จำนวนการเข้าชมเว็บไซต์",
                                                colorByPoint: true,
                                                //เอาข้อมูลมา echo ตรงนี้
                                                data: [<?= $report_data_month; ?>]
                                            }]
                                        });
                                    </script>
                                </div>

                                <div class="col-sm-4">
                                    <figure class="highcharts-figure">
                                        <div id="container3"></div>
                                        <p class="highcharts-description">.</p>
                                    </figure>
                                    <script>
                                        // Create the chart
                                        Highcharts.chart('container3', {
                                            chart: {
                                                type: 'column'
                                            },
                                            title: {
                                                // text: 'จำนวนการทำแบบประเมินแยกตามวัน'
                                                text: 'จำนวนการเข้าชมเว็บไซต์แยกตามปี'
                                            },
                                            subtitle: {
                                                text: 'รวมทั้งสิ้น <?= $rowCase['totalCase']; ?> ครั้ง '
                                            },
                                            accessibility: {
                                                announceNewData: {
                                                    enabled: true
                                                }
                                            },
                                            xAxis: {
                                                type: 'category'
                                            },
                                            yAxis: {
                                                title: {
                                                    // text: 'จำนวนการประเมินเว็บไซต์'
                                                    text: 'จำนวนการเข้าชมเว็บไซต์'
                                                }
                                            },
                                            legend: {
                                                enabled: false
                                            },
                                            plotOptions: {
                                                series: {
                                                    borderWidth: 0,
                                                    dataLabels: {
                                                        enabled: true,
                                                        format: '{point.y:.0f} ครั้ง'
                                                    }
                                                }
                                            },
                                            tooltip: {
                                                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f} ครั้ง</b> of total<br/>'
                                            },
                                            series: [{
                                                // name: "จำนวนการประเมินเว็บไซต์",
                                                name: "จำนวนการเข้าชมเว็บไซต์",
                                                colorByPoint: true,
                                                //เอาข้อมูลมา echo ตรงนี้
                                                data: [<?= $report_data_year; ?>]
                                            }]
                                        });
                                    </script>
                                </div>

                            </div>
                            <!-- /.row -->

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