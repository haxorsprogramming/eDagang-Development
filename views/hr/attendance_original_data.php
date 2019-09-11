<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
	<section class="content-header">
        <a href="<?=base_url('hr/attendance_all')?>" class="btn btn-info">Kembali ke Absensi Karyawan</a>&nbsp;
		<a href="<?=base_url('hr/attendance_config')?>" class="btn btn-warning">Pengaturan Absensi</a>
	</section>

	<!-- Main content -->
	<section class="content">
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-success">
			<div class="box-header">
			  <h3 class="box-title"><?php echo $sub_title;?></h3> <!--<a href="<?php echo base_url();?>hr/attendance_create" class="btn btn-xs btn-primary pull-right"><span class="glyphicon glyphicon-plus"></span></a>-->
			</div><!-- /.box-header -->
			<div class="box-body">
                <table id="attendance_original_data" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Row</th>
                            <th>Nama Karyawan</th>
                            <th>Finger ID</th>
                            <th>Waktu</th>
                            <th>Status</th>
                        </tr>
                    <thead>
                    <tfoot>
                        <tr>
                            <th>Row</th>
                            <th>Nama Karyawan</th>
                            <th>Finger ID</th>
                            <th>Waktu</th>
                            <th>Status</th>
                        </tr>
                    <tfoot>
                    <tbody>
                        <?php
                        foreach ($attendance AS $attend)
                        {
                        ?>
                        <tr>
                            <td><?php echo $attend->attendance_id;?></td>
                            <td>
                            <?php
                            $employee = $this->hr_model->get_employee_by_finger_id($attend->finger_id);
                            if ($employee)
                            {
                                echo $employee->employee_name;
                            }
                            ?>
                            </td>
                            <td><?php echo $attend->finger_id;?></td>
                            <td><?php echo date('d-m-Y H:i:s', strtotime($attend->attendance_times));?></td>
                            <td><?php
                            if ($attend->attendance_status == '0')
                                echo "<b class='text-green'>Datang</a>";
                            elseif ($attend->attendance_status == '1')
                                echo "<b class='text-red'>Pulang</a>";
                                ?></td>
                        </tr>
                        <?php }?>
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
	 $('#attendance_original_data').DataTable({
		 "lengthMenu": [[50, 100, 250, -1], [50, 100, 250, "All"]],
		 "pagingType": "full_numbers",
         "order": [[0, "desc"]]
	 });
  });
</script>