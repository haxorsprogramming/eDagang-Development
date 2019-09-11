<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Main content -->
	<section class="content">

	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-success">
			<div class="box-header">
			  <h3 class="box-title"><?php echo $sub_title;?>
			</div><!-- /.box-header -->
			<div class="box-body">
			<?php
			if ($this->session->flashdata('message_success'))
				echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
			elseif ($this->session->flashdata('message_error'))
				echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
			echo '<span class=text-red>'.validation_errors().'</span>';
			echo form_open('hr/salary_create','class=form-horizontal');
			?>
			<div class="col-xs-12">
                <div class="form-group">
					<label class="col-sm-3 control-label">Bulan</label>
					<div class="col-xs-3">
						<select class="form-control" name="salary_month">
                            <option value="01" <?php if (date('m') == '01') echo " selected";?>>Januari</option>
                            <option value="02" <?php if (date('m') == '02') echo " selected";?>>Februari</option>
                            <option value="03" <?php if (date('m') == '03') echo " selected";?>>Maret</option>
                            <option value="04" <?php if (date('m') == '04') echo " selected";?>>April</option>
                            <option value="05" <?php if (date('m') == '05') echo " selected";?>>Mei</option>
                            <option value="06" <?php if (date('m') == '06') echo " selected";?>>Juni</option>
                            <option value="07" <?php if (date('m') == '07') echo " selected";?>>Juli</option>
                            <option value="08" <?php if (date('m') == '08') echo " selected";?>>Agustus</option>
                            <option value="09" <?php if (date('m') == '09') echo " selected";?>>September</option>
                            <option value="10" <?php if (date('m') == '10') echo " selected";?>>Oktober</option>
                            <option value="11" <?php if (date('m') == '11') echo " selected";?>>November</option>
                            <option value="12" <?php if (date('m') == '12') echo " selected";?>>Desember</option>
                          </select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Nama Karyawan</label>
					<div class="col-xs-6">
						<select  id="employee_id" name="employee_id" class="form-control select2">
                            <option value="">-- Pilih Karyawan --</option>
						<?php
						foreach($employeerecord as $row)
						{
						?>
						<option value="<?php echo $row->employee_id;?>"><?php echo $row->employee_name;?></option>
						<?php }?>
						</select>
					</div>
				</div>
                 <div class="form-group">
					<label class="col-sm-3 control-label">Tunjangan THR</label>
					<div class="col-xs-2">
						<input type="text" name="salary_thr" class="form-control">
					</div>
				</div>
                <div class="form-group">
					<label class="col-sm-3 control-label">Piutang Karyawan</label>
					<div class="col-xs-2">
						<input type="text" name="employee_loan" class="form-control">
					</div>
				</div>
                 <div class="form-group">
					<label class="col-sm-3 control-label">Fee Tambahan</label>
					<div class="col-xs-2">
						<input type="text" name="employee_incentive" class="form-control">
					</div>
				</div>
                <div class="form-group">
					<label class="col-sm-3 control-label">Tanggal Terima</label>
					<div class="col-xs-2">
						<input type="text" id="receive_date" name="salary_receive_date" class="form-control" value="<?=date('d-m-Y')?>">
					</div>
				</div>
			</div>
			</div><!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" class="btn btn-success">Hitung Gaji</button>
				<a href="<?php echo base_url('hr/salary');?>" class="btn btn-danger pull-right">Batal</a>
			</div><!-- /.box-footer -->
			<?php echo form_close();?>
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->
<script>
  $(function () {
	 //Date range picker
	$('#month').datepicker({
					format: 'mm',
					startView: 'year',
					miniViewMode: 'year',
					autoclose: true
				});
	$('#year').datepicker({
					format: 'yyyy',
					startView: 'year',
					miniViewMode: 'year',
					autoclose: true
				});
	$('#receive_date').datepicker({
					format: 'dd-mm-yyyy',
					todayBtn: true,
					todayHighlight: true,
					autoclose: true
				});
  });
</script>