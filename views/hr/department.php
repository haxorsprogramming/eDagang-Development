<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <a href="<?php echo base_url();?>hr/employee" class="btn btn-info">Kembali ke Data Karyawan</a> &nbsp;
        <a href="<?php echo base_url('hr/department_create');?>" class="btn btn-warning">Tambah Departemen</a>
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
        <a href="<?php echo base_url();?>hr/department/1" class="btn btn-success">Departemen aktif</a> &nbsp;
        <a href="<?php echo base_url();?>hr/department/0" class="btn btn-danger">Departemen tidak aktif</a> &nbsp;
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
			  <table id="department" class="table table-striped table-bordered table-hover">
				<thead>
				  <tr>
					<th>No.</th>
					<th>Nama Departemen</th>
          <th>Status</th>
					<th></th>
				  </tr>
				</thead>
				<tbody>
				<?php
					$no=1;
					foreach($departmentrecord AS $row)
					{
					?>
				  <tr>
					<td align="center"><?php echo $no++;?></td>
					<td align="center"><?php echo $row->employee_department_name;?></td>
          <td align="center"><?php
          if ($row->employee_departement_status=='0') {
            $status = "<span class='btn btn-xs btn-danger btn-rounded'>Tidak aktif</span>";
            $alert = "Apakah anda yakin akan mengaktifkan kembali department ".$row->employee_department_name;
          }else {
            $status = "<span class='btn btn-xs btn-success btn-rounded'>aktif</span>";
            $alert = "Apakah anda yakin akan menonaktifkan department ".$row->employee_department_name;
          }
          echo $status;?></td>
					<td>
            <?php echo anchor('hr/department_edit/' . $row->employee_department_id,'Edit', ['class'=>'btn btn-warning']);?>
            <?php if ($edit_status=='0'): ?>
              <a href="<?php echo base_url('hr/department_edit_status').'/'.$edit_status.'/'.$row->employee_department_id;?>" onclick="return confirm('<?php echo $alert;?>')" class="btn btn-md btn-danger btn-rounded">Non-aktifkan</a>
              <?php else: ?>
              <a href="<?php echo base_url('hr/department_edit_status').'/'.$edit_status.'/'.$row->employee_department_id;?>" onclick="return confirm('<?php echo $alert;?>')" class="btn btn-md btn-success btn-rounded">aktifkan</a>
            <?php endif; ?>
          </td>
				  </tr>
				  <?php };?>
				</tbody>
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
	 $('#department').DataTable({
		 "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
		 "order": [[ 0, "asc" ]],
		 "pagingType": "full_numbers"
	 });
  });
</script>
