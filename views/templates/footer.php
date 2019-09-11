<footer class="main-footer bg-green">
	<table width="100%">
		<tr>
			<td>www.<?php echo $this->config->item('app_name');?></td>
			<td align="center"><?php echo $this->benchmark->elapsed_time();?> detik</td>
			<td align="right"><?php echo $this->config->item('app_name');?> v<?php echo $this->config->item('app_version');?></td>
		</tr>
	</table>
		</footer>

</div><!-- ./wrapper -->
<!-- Bootstrap 3.3.5 -->
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
<!--     <script src="<?php echo base_url();?>assets/js/jquery-ui.min.js"></script> -->
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		//$.widget.bridge('uibutton', $.ui.button);
	</script>
<!-- Select2 -->
	<script src="<?php echo base_url();?>assets/plugins/select2/select2.full.min.js"></script>
	<!-- Sparkline -->
	<!--script src="<?php echo base_url();?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
	<!-- jvectormap -->
	<!--script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<!--script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="<?php echo base_url();?>assets/plugins/knob/jquery.knob.js"></script>
	<!-- daterangepicker -->
	<!--script src="<?php echo base_url();?>assets/js/moment.min.js"></script-->
	<script src="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- datepicker -->
	<script src="<?php echo base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
	<!-- Bootstrap WYSIHTML5 -->
	<!--script src="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- iCheck 1.0.1 -->
	<script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js"></script>
	<!-- FastClick -->
	<script src="<?php echo base_url();?>assets/plugins/fastclick/fastclick.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url();?>assets/js/app.min.js"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<!--script src="<?php echo base_url();?>assets/js/pages/dashboard.js"></script>
	<!-- AdminLTE for demo purposes -->
	<!--script src="<?php echo base_url();?>assets/js/demo.js"></script>

<!-- DataTables -->
	<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/jszip.min.js"></script>
<!-- 	<script src="<?php echo base_url();?>assets/plugins/datatables/pdfmake.min.js"></script> -->
<!-- 	<script src="<?php echo base_url();?>assets/plugins/datatables/vfs_fonts.js"></script> -->
<script src="<?php echo base_url();?>assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/buttons.print.min.js"></script>

<!-- Datetime Picker -->
	<script src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>
<script>
		$(function () {
			//Initialize Select2 Elements
			$(".select2").select2();

	//iCheck for checkbox and radio inputs
			$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
				checkboxClass: 'icheckbox_minimal-blue',
				radioClass: 'iradio_minimal-blue'
			});

	// Remove active for all items.
	$('.page-sidebar-menu li').removeClass('active');

	// highlight submenu item
	$('li a[href="' + this.location.pathname + '"]').parent().addClass('active');

	// Highlight parent menu item.
	$('ul a[href="' + this.location.pathname + '"]').parents('li').addClass('active');

		});
	</script>
</body>
</html>
