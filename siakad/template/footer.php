</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer text-center">
    <strong><span class="text-info">UPTD SMPN 14 Pematangsiantar</span>
        <p>Copyright &copy; <?= date('Y') ?>,
    </strong> All rights reserved.</p>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= $main_url ?>asset/dashboard/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= $main_url ?>asset/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="<?= $main_url ?>asset/dashboard/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="<?= $main_url ?>asset/dashboard/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= $main_url ?>asset/dashboard/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= $main_url ?>asset/dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= $main_url ?>asset/dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= $main_url ?>asset/dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= $main_url ?>asset/dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>

<script>
    $(function() {
        $('#tblData').DataTable();
    });
</script>

</body>

</html>