<!-- <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
    </div>
</footer> -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Summernote -->
<script src="../assets/plugins/summernote/summernote-bs4.min.js"></script>

<!-- Page specific script -->
<script>
    $(function() {
        // Summernote
        $('#summernote').summernote()
    })
</script>

<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard -->
<script src="../assets/dist/js/pages/dashboard.js"></script>

<!-- DataTables  & ../assets/plugins -->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../assets/plugins/jszip/jszip.min.js"></script>
<script src="../assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Page specific script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            // aaSorting ใช้สำหรับเรียงลำดับจากมากไปหาน้อย ถ้าไม่อยากให้เรียงมากไปหาน้อยให้เอา 2 บรรทัดนี้ออก 
            "aaSorting": [
                [0, "desc"]
            ],
            // "buttons": ["excel", "pdf", "print",
            //     "colvis"
            // ]
            // "copy", "csv", "excel", "pdf", "print", "colvis"
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

    // แปลงข้อมูลจาก PHP เป็น JSON สำหรับกราฟสถานะ
    const statusData = <?php echo json_encode($statusData); ?>;

    // แปลงข้อมูลสำหรับแสดงในกราฟสถานะ
    const statusLabels = statusData.map(item => item.status_name);
    const statusCounts = statusData.map(item => item.status_count);

    // สีสำหรับกราฟสถานะ
    const statusBackgroundColors = [
        'rgba(134, 213, 245, 0.5)',
        'rgba(238, 191, 112, 0.5)',
        'rgba(141, 99, 255, 0.5)',
        'rgba(255, 99, 99, 0.5)'

    ];
    const statusBorderColors = [
        '#5dade2',
        'rgba(255, 159, 64, 1)',
        'rgba(141, 99, 255, 1)',
        'rgba(255, 99, 99, 1)',

    ];

    // สร้างกราฟคอลัมน์สถานะ
    const ctxStatus = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(ctxStatus, {
        type: 'bar',
        data: {
            labels: statusLabels,
            datasets: [{
                label: 'จำนวน',
                data: statusCounts,
                backgroundColor: statusBackgroundColors.slice(0, statusLabels.length),
                borderColor: statusBorderColors.slice(0, statusLabels.length),
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // แปลงข้อมูลจาก PHP เป็น JSON สำหรับกราฟการประเมิน
    const assessmentData = <?php echo json_encode($assessmentData); ?>;

    // แปลงข้อมูล JSON เป็นรูปแบบที่กราฟต้องการ
    const assessmentLabels = assessmentData.map(item => item.assessment_name);
    const assessmentCounts = assessmentData.map(item => item.assessment_count);

    // สีสำหรับกราฟการประเมิน
    const assessmentBackgroundColors = [
        'rgba(255, 160, 206, 0.5)',
        'rgba(160, 255, 233, 0.5)',
        'rgba(253, 203, 67, 0.5)',
        'rgba(78, 67, 253, 0.5)',
        'rgba(75, 75, 75, 0.5)'
    ];
    const assessmentBorderColors = [
        'rgba(255, 99, 174, 1)',
        'rgba(160, 255, 233, 1)',
        'rgba(236, 177, 20, 1)',
        'rgba(78, 67, 253, 1)',
        'rgba(75, 75, 75, 1)'
    ];

    // สร้างกราฟคอลัมน์การประเมิน
    const ctxAssessment = document.getElementById('assessmentChart').getContext('2d');
    const assessmentChart = new Chart(ctxAssessment, {
        type: 'bar',
        data: {
            labels: assessmentLabels,
            datasets: [{
                label: 'จำนวน',
                data: assessmentCounts,
                backgroundColor: assessmentBackgroundColors.slice(0, assessmentLabels.length),
                borderColor: assessmentBorderColors.slice(0, assessmentLabels.length),
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1, // กำหนดให้แกน Y ขยับทีละ 1
                        precision: 0 // ป้องกันการแสดงค่าทศนิยม
                    }
                }
            }
        }
    });
</script>





</body>

</html>