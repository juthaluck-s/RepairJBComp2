<!-- Footer Section (Commented Out) -->
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

<!-- PDFMake with custom font encoding -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script>
    // Define the font in Base64 (replace these placeholders with actual Base64 encoded data)
</script>

<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard -->
<script src="../assets/dist/js/pages/dashboard.js"></script>

<!-- DataTables & Plugins -->
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


<!-- Page-specific script for DataTable initialization -->
<script>
    $(function() {
        // Initialize the main DataTable
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "aaSorting": [
                [0, "desc"]
            ],
            "buttons": ["excel", "pdf", "print",
                "colvis"
            ]
            // "copy",
            // "csv",
            // "excel",
            // "pdf",
            // "print",
            // "colvis"
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        // Initialize another DataTable for example2
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        });
    });

    // Handle file input changes
    document.getElementById('exampleInputFile').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name || 'Choose file';
        const label = e.target.nextElementSibling; // Find the label element
        label.textContent = fileName; // Update the label with the selected file name
    });
</script>
</body>

</html>