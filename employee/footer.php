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

<script>
$('#summernote').summernote({
    height: 200, // ความสูงของ textarea
    placeholder: 'กรุณากรอกรายละเอียด',
    tabsize: 2,
    toolbar: [
        // แสดงทุกเครื่องมือ ยกเว้นเครื่องมือที่เกี่ยวข้องกับรูปภาพ/วิดีโอ
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript',
            'clear'
        ]],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['table', ['table']],
        ['view', ['fullscreen', 'codeview', 'help']]
    ],
    callbacks: {
        onImageUpload: function(files) {
            // ปิดการอัปโหลดรูปภาพ
            alert('การแนบไฟล์รูปภาพไม่ได้รับอนุญาต');
        },
        onMediaDelete: function(target) {
            // ปิดการลบวิดีโอหรือสื่ออื่น
            alert('ไม่สามารถลบสื่อได้');
            target.remove();
        },
        onKeydown: function(e) {
            // ปิดการแทรกลิงก์ (ผ่าน Ctrl+K)
            if (e.ctrlKey && e.key === 'k') {
                e.preventDefault();
                alert('ไม่อนุญาตให้แทรกลิงก์');
            }
        },
        onPaste: function(e) {
            // ปิดการวางไฟล์รูปภาพ/วิดีโอใน textarea
            const clipboardData = e.originalEvent.clipboardData || window.clipboardData;
            if (clipboardData && clipboardData.files.length > 0) {
                e.preventDefault();
                alert('ไม่อนุญาตให้วางไฟล์');
            }
        }
    }
});
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        // aaSorting ใช้สำหรับเรียงลำดับจากมากไปหาน้อย ถ้าไม่อยากให้เรียงมากไปหาน้อยให้เอา 2 บรรทัดนี้ออก 
        "aaSorting": [
            [0, "desc"]
        ],
        "buttons": ["excel", "print",
            "colvis"
        ]
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
document.getElementById('exampleInputFile').addEventListener('change', function(e) {
    const fileName = e.target.files[0]?.name || 'Choose file';
    const label = e.target.nextElementSibling; // Find the label element
    label.textContent = fileName;
});
</script>


</body>

</html>