<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
	<section class="content-header">
		<a href="<?=base_url('hr/salary_create')?>" class="btn btn-warning">Input Gaji</a>
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
          <form class="" action="<?php echo base_url()?>hr/salary_search" method="get">
					<div class="col-xs-3">
						<div class="input-group">
						 <span class="input-group-addon">PERIODE :</span>
						  <select class="form-control" name="month">
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
						</div><!-- /.input group -->
					</div>
					<div class="col-xs-3">
						<div class="input-group">
						   <span class="input-group-addon">Tahun :</span>
						   <input type="text" class="form-control" id="year" name="year" value="<?php echo date('Y');?>">
						</div>
					</div><!-- /.input group -->
					<div class="col-xs-2">
						<div class="input-group">
						   <button class="btn btn-block btn-primary">Cari</button>
						</div>
					</div><!-- /.input group -->
        </form>
			</div>
			<div class="box-body">
			<?php
			if ($this->session->flashdata('message_success'))
				echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
			elseif ($this->session->flashdata('message_error'))
				echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
			?>
			  <table id="salary" class="table table-striped table-bordered table-hover">
				<thead>
				  <tr>
					<th>No.</th>
                    <th>NIK</th>
					<th>Nama Karyawan</th>
					<th>Gaji Pokok</th>
					<th>Tunjangan Jabatan</th>
                    <th>Uang Kerajinan</th>
                    <th>Hari</th>
                    <th>Uang Transport + Makan</th>
					<th>Tgl Terima</th>
					<th></th>
				  </tr>
				</thead>
				<tbody>
				<?php
					$no=1;
					foreach($salaryrecord AS $row)
					{
					?>
				  <tr>
					<td align="center"><?php echo $no++;?></td>
                    <td align="center"><?php echo $row->employee_code;?></td>
					<td align="center"><?php echo $row->employee_name;?></td>
					<td align="center"><?php echo number_format($row->employee_basic_salary,0,',','.');?></td>
					<td align="center"><?php echo number_format($row->employee_position_allowance,0,',','.');?></td>
                    <td align="center"><?php echo number_format($row->employee_salary_additional_allowance,0,',','.');?></td>
					<td align="center"><?php echo $row->employee_salary_attendance;?></td>
                    <td align="center"><?php echo $row->employee_salary_meal_transport;?></td>
                    <td align="center"><?php echo date('d-m-Y', strtotime($row->employee_salary_receive_date));?></td>
					<td><a href="<?php echo base_url();?>hr/slip/<?php echo $row->employee_salary_id;?>" class="btn btn-success" target="_blank">Slip</a></td>
				  </tr>
				  <?php };?>
				</tbody>
			  </table>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
  $(function () {
	 $('#salary').DataTable({
		 "lengthMenu": [[15, 50, 100, -1], [15, 50, 100, "All"]],
		 "pagingType": "full_numbers"
	 });
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
  });
</script>