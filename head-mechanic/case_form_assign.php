<?php
if (isset($_GET['id']) && isset($_GET['act']) && $_GET['act'] == 'assign') {
	$case_id = $_GET['id'];  // รับค่า case_id ที่ส่งมาจาก URL

	// คิวรีเพื่อดึงข้อมูลจาก tbl_case ที่ตรงกับ case_id
	$stmtCase_Detail = $condb->prepare("SELECT *
										FROM tbl_case AS c
										LEFT JOIN tbl_member AS emp ON c.ref_m_id = emp.m_id
									 
										LEFT JOIN tbl_equipment AS eqm ON c.ref_equipment_id = eqm.equipment_id
										LEFT JOIN tbl_status AS stt ON c.ref_status_id = stt.status_id
										LEFT JOIN tbl_assessment AS asm ON c.ref_assessment_id = asm.assessment_id
										LEFT JOIN tbl_building AS bd ON c.ref_building_id = bd.building_id
										WHERE c.case_id = :case_id");


	$stmtCase_Detail->bindParam(':case_id', $case_id, PDO::PARAM_INT);
	$stmtCase_Detail->execute();
	$rsCase_Detail = $stmtCase_Detail->fetch(PDO::FETCH_ASSOC);

	// ตรวจสอบผลลัพธ์
	if (!$rsCase_Detail) {
		echo "ไม่พบข้อมูลกรณีที่เลือก";
	} else {
		// echo "<pre>";
		// print_r($rsCase_Detail); // ดูข้อมูลที่ได้จากฐานข้อมูล
		// echo "</pre>";
	}
} else {
	echo "กรุณาเลือกกรณีที่จะทำการ Assign";
}

if (isset($_GET['no'])) {
	$no = $_GET['no'];
}


?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>รายการแจ้งซ่อมคอมพิวเตอร์/อุปกรณ์</h1>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">

				<div class="col-md-12">
					<div class="box">
						<div class="row">
							<div class="col-md-12">
								<div class="box-body">
									<p>
										<a href="case.php" class="btn btn-primary">
											NEW <span class="badge">5</span></a>
										<a href="case.php?act=doing" class="btn btn-warning">
											Assigned <span class="badge">16</span></a>
										<a href="case.php?act=success" class="btn btn-success">
											Success <span class="badge">179</span></a>
										<a href="case.php?act=all" class="btn btn-danger">
											AllJob <span class="badge">200</span></a>
									</p>
									<div class="card">

										<!-- /.card-header -->
										<div class="card-body">
											<table id="example3" class="table table-bordered table-striped table-sm">

												<thead>
													<tr class="table-info">
														<th width="5%" class="text-center">No.</th>
														<th width="10%" class="text-center">รูปภาพ</th>
														<th width="10%" class="text-center">อุปกรณ์</th>
														<th class="text-center">รายละเอียด</th>
													</tr>
												</thead>


												<?php
												$no = isset($_GET['no']) ? intval($_GET['no']) : '-'; // ถ้าไม่มีค่า no ให้ใช้เครื่องหมาย -
												?>

												<tbody>
													<tr>
														<td align="center"><?= $no; ?></td>

														<td><img src="../assets/case_img/<?= $rsCase_Detail['case_img']; ?>"
																width="180px"></td>
														<td align="center"><?= $rsCase_Detail['equipment_name']; ?></td>
														<td>
															<?= $rsCase_Detail['case_detail']; ?><br>
															สถานที่ : <?= $rsCase_Detail['building_name']; ?> ชั้น
															<?= $rsCase_Detail['case_floor']; ?> ห้อง
															<?= $rsCase_Detail['case_room']; ?><br>
															<?= $rsCase_Detail['title_name'] . ' ' . $rsCase_Detail['firstname'] . ' ' . $rsCase_Detail['lastname']; ?><br>
															เบอร์โทร : <?= $rsCase_Detail['m_tel']; ?><br>
															Email : <?= $rsCase_Detail['m_email']; ?><br>
															ว/ด/ป :
															<?= date('d/m/Y H:i:s', strtotime($rsCase_Detail['dateSave'])); ?><br>
															<font color="red">สถานะ
																<?= $rsCase_Detail['status_name']; ?></font>
														</td>
													</tr>
												</tbody>

											</table>

											<?php
											// Query ช่าง Mechanic
											$querySelectMechanic = "
    SELECT 
        m.m_id, 
        m.firstname, 
        m.lastname, 
        m.m_tel, 
        m.m_email, 
        dpm.department_name, 
        pst.position_name, 
        mec.mec_doing, 
        mec.mec_close
    FROM tbl_member AS m
    INNER JOIN tbl_department AS dpm ON m.ref_department_id = dpm.department_id
    INNER JOIN tbl_position AS pst ON m.ref_position_id = pst.position_id
    INNER JOIN tbl_mechanic AS mec ON m.m_id = mec.mec_id
    WHERE m.ref_level_id = 3
    ORDER BY mec.mec_doing ASC"; // จัดลำดับจากงานที่กำลังทำ

											$result = $condb->query($querySelectMechanic);

											// ตรวจสอบการ Assign
											if (isset($_POST['m_id']) && isset($_GET['id'])) {
												$mec_id = $_POST['m_id'];
												$case_id = $_GET['id']; // รับค่า case_id จาก URL

												$queryAssign = $condb->prepare("
        UPDATE tbl_case 
        SET ref_mec_id = :mec_id 
        WHERE case_id = :case_id
    ");
												$queryAssign->bindParam(':mec_id', $mec_id, PDO::PARAM_INT);
												$queryAssign->bindParam(':case_id', $case_id, PDO::PARAM_INT);

												if ($queryAssign->execute()) {
													echo "<div class='alert alert-success'>บันทึกการ Assign งานสำเร็จ!</div>";
												} else {
													echo "<div class='alert alert-danger'>เกิดข้อผิดพลาดในการบันทึกการ Assign งาน</div>";
												}
											}

											?>

											<form method="post"
												action="assign_db.php?id=<?= isset($_GET['id']) ? htmlspecialchars($_GET['id']) : ''; ?>"
												class="form-horizontal">
												<h4> :: รายการช่าง :: </h4>
												<table class="table table-bordered table-striped">
													<thead>
														<tr class='danger'>
															<th width='5%'>
																<center>เลือก</center>
															</th>
															<th width='50%'>รายละเอียดช่าง</th>
															<th width='5%'>
																<center>doing</center>
															</th>
															<th width='5%'>
																<center>close</center>
															</th>
														</tr>
													</thead>

													<?php
													if ($result->rowCount() > 0) {
														while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
													?>
															<tr>
																<td style="text-align: center; vertical-align: middle;">
																	<input type="radio" name="m_id" required
																		value="<?= htmlspecialchars($row['m_id']); ?>">
																	<span>เลือก</span>
																</td>
																<td>
																	<?= htmlspecialchars($row['firstname']) . ' ' . htmlspecialchars($row['lastname']); ?><br>
																	เบอร์โทร : <?= htmlspecialchars($row['m_tel']); ?> <br>
																	Email : <?= htmlspecialchars($row['m_email']); ?><br>
																	แผนก : <?= htmlspecialchars($row['department_name']); ?><br>
																	ตำแหน่ง : <?= htmlspecialchars($row['position_name']); ?>
																</td>
																<td align='center'><?= htmlspecialchars($row['mec_doing']); ?>
																</td>
																<td align='center'><?= htmlspecialchars($row['mec_close']); ?>
																</td>
															</tr>
													<?php
														}
													} else {
														echo "<tr><td colspan='4' class='text-center'>ไม่มีข้อมูลช่างที่เป็น mechanic</td></tr>";
													}
													?>
												</table>
												<p align="right">
													<button type="submit" class="btn btn-primary" name="submit"
														value="as">บันทึกการ Assign งาน</button>
												</p>
											</form>


										</div>
										<!-- /.card-body -->
									</div>
									<!-- /.card -->
								</div>
								<!-- /.col -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- content-wrapper -->