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
                                <h4> รายงานภาพรวม </h4>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="info">
                                            <th width="70%">รายการ</th>
                                            <th width="10%">จำนวน</th>
                                            <th width="10%">หน่วย</th>
                                            <th width="5%">view</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> -จำนวนงานที่ได้รับมอบหมาย</td>
                                            <td align="center">198</td>
                                            <td align="center">งาน</td>
                                            <td align="center"><a href="index.php?p=all" class="btn btn-info btn-xs"
                                                    target="_blank">view</a></td>
                                        </tr>
                                        <tr>
                                            <td> -จำนวนงานที่กำลังทำ</td>
                                            <td align="center">15</td>
                                            <td align="center">งาน</td>
                                            <td align="center"><a href="index.php?p=doing" class="btn btn-info btn-xs"
                                                    target="_blank">view</a></td>
                                        </tr>
                                        <tr>
                                            <td> -จำนวนงานที่ทำเสร็จแล้ว</td>
                                            <td align="center">183</td>
                                            <td align="center">งาน</td>
                                            <td align="center">
                                                <a href="index.php?p=close" class="btn btn-info btn-xs" target="_blank">
                                                    view
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h4>การประเมิน</h4>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="bg-success">
                                            <th width="70%">รายการ</th>
                                            <th width="10%">จำนวน</th>
                                            <th width="10%">หน่วย</th>
                                            <th width="5%">view</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> -จำนวนงานที่ทำได้รับการประเมิน</td>
                                            <td align="center">148</td>
                                            <td align="center">งาน</td>
                                            <td align="center">
                                                <a href="report.php?act=rclose" class="btn btn-info btn-xs"
                                                    target="_blank">view</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> -ผลประเมิน = ดี</td>
                                            <td align="center">100</td>
                                            <td align="center">งาน</td>
                                            <td align="center">
                                                <a href="report.php?act=ev&st=ดี&view" class="btn btn-info btn-xs"
                                                    target="_blank">view</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> -ผลประเมิน = ปานกลาง</td>
                                            <td align="center">31</td>
                                            <td align="center">งาน</td>
                                            <td align="center">
                                                <a href="report.php?act=ev&st=ปานกลาง&view" class="btn btn-info btn-xs"
                                                    target="_blank">view</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> -ผลประเมิน = พอใช้</td>
                                            <td align="center">21</td>
                                            <td align="center">งาน</td>
                                            <td align="center">
                                                <a href="report.php?act=ev&st=พอใช้&view" class="btn btn-info btn-xs"
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