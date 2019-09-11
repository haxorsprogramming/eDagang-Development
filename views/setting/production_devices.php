<script>
  $(function () {
	 $('#production_devices').DataTable({
		 "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		 "pagingType": "full_numbers",
		 "scrollX": true
	 });
  });
</script>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<a href="<?=base_url()?>setting/production_devices_create" class="btn btn-warning">Tambah Perangkat</a>
	</section>

	<!-- Main content -->
	<section class="content">

	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-success">
			<div class="box-body">
			<?php
			if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';
			?>
			  <table id="production_devices" class="table table-striped table-bordered table-hover">
				<thead>
				  <tr>
					<th>No.</th>
					<th>Type</th>
					<th>Nama Perangkat</th>
					<th>IP Address</th>
					<th></th>
				  </tr>
				</thead>
				<tbody>
				<?php
					$no = 1;
					foreach($productiondevices AS $productiondevice)
					{
					?>
				  <tr>
					<td align="center"><?php echo $no++;?></td>
					<td><?php
					if($productiondevice->production_devices_type == '1')
						echo 'Printer';
					elseif($productiondevice->production_devices_type == '2')
						echo 'PC';
          elseif($productiondevice->production_devices_type == '3')
            echo 'FingerPrint';?></td>
					<td><?php echo $productiondevice->production_devices_name;?></td>
					<td><?php echo $productiondevice->production_devices_ip_address;?></td>
					<td><?php
						$group_id = $this->session->userdata('group_id');
						if($group_id == '1' OR $group_id == '2')
						{
							echo anchor('setting/production_devices_edit/' . $productiondevice->production_devices_id,'Edit', ['class'=>'btn btn-xs btn-warning']);
						}?>
					</td>
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
