<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <a href="<?php echo base_url('hr/employee');?>" class="btn btn-info">Kembali ke Karyawan</a>
        <a href="<?php echo base_url('hr/position_create');?>" class="btn btn-warning">Tambah Posisi</a>
    </section>

	<!-- Main content -->
	<section class="content">

	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-success">
			<div class="box-header">
			  <h3 class="box-title"><?php echo $sub_title;?></h3>
			</div><!-- /.box-header -->
			<div class="box-body">
        <a href="<?php echo base_url();?>hr/position/1" class="btn btn-success">Posisi aktif</a> &nbsp;
        <a href="<?php echo base_url();?>hr/position/0" class="btn btn-danger">Posisi tidak aktif</a> &nbsp;
        <br>
        <br>
			<?php
			if ($this->session->flashdata('message_success'))
				echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
			elseif ($this->session->flashdata('message_error'))
				echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
			?>
			<!--div>
				<p>
				<?php //echo anchor('finance/se_create','Tambah', ['class'=>'btn btn-success']);?>
				</p>
			</div-->
			<div>
			  <table id="position" class="table table-striped table-bordered table-hover">
				<thead>
				  <tr>
					<th class="text-center">Nama Posisi</th>
          <th>Status</th>
					<th></th>
				  </tr>
				</thead>
				<tbody>
				<?php
					foreach($positionrecord AS $row)
					{
					?>
				  <tr>
					<td><?php echo $row->employee_position_name;?></td>
          <td>
            <?php
            if ($row->employee_position_status=='0') {
              $status = "<span class='btn btn-xs btn-danger btn-rounded'>Tidak aktif</span>";
              $alert = "Apakah anda yakin akan mengaktifkan kembali position ".$row->employee_position_name;
            }else {
              $status = "<span class='btn btn-xs btn-success btn-rounded'>aktif</span>";
              $alert = "Apakah anda yakin akan menonaktifkan position ".$row->employee_position_name;
            }
            echo $status;?>
          </td>
					<td>
            <?php echo anchor('hr/position_edit/' . $row->employee_position_id,'Edit', ['class'=>'btn btn-md btn-warning']);?>
            <?php if ($edit_status=='0'): ?>
              <a href="<?php echo base_url('hr/position_edit_status').'/'.$edit_status.'/'.$row->employee_position_id;?>" onclick="return confirm('<?php echo $alert;?>')" class="btn btn-md btn-danger btn-rounded">Non-aktifkan</a>
              <?php else: ?>
              <a href="<?php echo base_url('hr/position_edit_status').'/'.$edit_status.'/'.$row->employee_position_id;?>" onclick="return confirm('<?php echo $alert;?>')" class="btn btn-md btn-success btn-rounded">aktifkan</a>
            <?php endif; ?>
          </td>
				  </tr>
				  <?php };?>
				</tbody>
        <tfoot>
				  <tr>
					<th class="text-center">Nama Posisi</th>
          <th>Status</th>
					<th></th>
				  </tr>
				</tfoot>
			  </table>
			 </div>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->
<script>
  $(function () {
	 $('#position').DataTable({
		 "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		 "order": [[ 1, "asc" ]],
		 "pagingType": "full_numbers"
	 });
  });
</script>
