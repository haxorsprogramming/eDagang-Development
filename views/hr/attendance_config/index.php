<script>
  $(function () {
	 $('#attendance').DataTable({
		 "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
		 "pagingType": "full_numbers"
	 });
  });
</script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<a href="<?php echo base_url();?>hr/attendance_config/create" class="btn btn-success">Tambah Waktu absensi</a>
	</section>

	<!-- Main content -->
	<section class="content">
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-warning">
			<div class="box-header">
			  <h3 class="box-title"><?php echo $sub_title;?></h3>
			</div><!-- /.box-header -->
			<div class="box-body">
			<?php
			if ($this->session->flashdata('message_success'))
				echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
			elseif ($this->session->flashdata('message_error'))
				echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
			?>
			<div>
			  <table id="attendance" class="table table-striped table-bordered table-hover">
				<thead>
				  <tr>
					<th>No.</th>
					<th>Keterangan masuk</th>
					<th>Jam Masuk</th>
					<th>Toleransi kehadiran</th>
					<th>Jam kerja</th>
          <th>Batas maksimum keterlambatan</th>
					<th>Action</th>
				  </tr>
				</thead>
				<tbody>
				<?php
					$no=1;
					foreach($attendance_config AS $row)
					{
					?>
				  <tr>
					<td align="center"><?php echo $no++;?></td>
					<td align="center"><?php echo $row->ac_description;?></td>
					<td align="center"><?php echo $row->ac_present_times;?></td>
          <td align="center"><?php echo $row->ac_tolerant_times."(Menit)";?></td>
          <td align="center"><?php echo $row->ac_working_hours."(Jam)";?></td>
          <td align="center"><?php echo $row->ac_late_maximum."(Menit)";?></td>
          <td>
            <a class="btn btn-warning btn-xs" href="<?php echo base_url()."hr/attendance_config/update/".$row->ac_id;?>"><i class="fa fa-edit"></i></button>
            <a class="btn btn-danger btn-xs" href="<?php echo base_url()."hr/attendance_config/hapus/".$row->ac_id?>" onclick="return confirm('apakah anda yakin akan menghapus karyawan? data yg sudah dihapus tidak bisa dikembalikan!')"><i class="fa fa-times"></i></button>
          </td>
				  </tr>
				  <?php }?>
				</tbody>
			  </table>
			 </div>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->
