	<!-- Main Footer -->
	<footer class="main-footer">
		<div class="float-right d-none d-sm-inline">
			<small><?php echo $app_fullname;?> Version 1.0</small>
		</div>
		<small>Copyright &copy; <?php echo $app_copyyear;?>. <a href=""><?php echo $org_fullname;?></a>. All rights reserved.</small>
	</footer>
</div>
<?php $conn->close();?>
<!-- REQUIRED SCRIPTS -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/toastr/toastr.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>