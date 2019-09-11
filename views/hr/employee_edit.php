<script>
  $(function () {
	 //Date range picker
	$('#join_date').datepicker({
						format: 'dd-mm-yyyy',
						todayBtn: true,
						todayHighlight: true,
						autoclose: true
					});
  });
</script>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	
	<!-- Main content -->
	<section class="content">
	  
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-warning">
			<div class="box-header">
			  <h3 class="box-title"><?php echo $sub_title;?>
			</div><!-- /.box-header -->
			<div class="box-body">
			<?php
			if ($this->session->flashdata('message_success'))
				echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
			elseif ($this->session->flashdata('message_error'))
				echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
			echo form_open('hr/employee_create','class=form-horizontal');
			?>
				<div class="form-group">
					<label class="col-sm-3 control-label">Kode Karyawan</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" name="employee_code" value="<?php echo set_value('employee_code');?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Nama Karyawan</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" name="employee_name" value="<?php echo set_value('employee_name');?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Alamat</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" name="employee_address" value="<?php echo set_value('employee_address');?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Tgl Gabung</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" id="join_date" name="employee_join_date" value="<?php echo set_value('employee_join_date');?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Gaji Pokok</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" name="employee_basic_salary" value="<?php echo set_value('employee_basic_salary');?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Tunjangan</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" name="employee_allowance" value="<?php echo set_value('employee_allowance');?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Departemen</label>
					<div class="col-xs-3">
						<select name="employee_department" class="form-control">
						<?php
						foreach($departmentrecord as $department)
						{
						?>
						<option value="<?php echo $department->employee_department_id;?>"><?php echo $department->employee_department_name;?></option>
						<?php }?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Posisi</label>
					<div class="col-xs-3">
						<select name="employee_position" class="form-control">
						<?php
						foreach($positionrecord as $position)
						{
						?>
						<option value="<?php echo $position->employee_position_id;?>"><?php echo $position->employee_position_name;?></option>
						<?php }?>
						</select>
					</div>
				</div>
			</div><!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" class="btn btn-success">Simpan</button>
				<a href="<?=base_url()?>hr/position" class="btn btn-primary pull-right">Kembali</a>
			</div><!-- /.box-footer -->
			<?php echo form_close();?>
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->