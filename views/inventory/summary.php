<script>
  $(function () {
	 $('#inventory').DataTable({
		 "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		 "pagingType": "full_numbers"
	 });
	  //Date range picker
	$('#start_date').datepicker({
						format: 'dd-mm-yyyy',
						todayBtn: true,
						todayHighlight: true,
						autoclose: true
					});
	$('#end_date').datepicker({
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
			<div class="box-body">
			  <div class="col-xs-12">
				<?php echo form_open('inventory/search');?>
				<div class="col-xs-3">
					<div class="input-group">
					 <span class="input-group-addon">Dari :</span>
					  <input type="text" class="form-control" id="start_date" name="start_date" value="<?php echo date('d-m-Y');?>">
					</div><!-- /.input group -->
				</div>
				<div class="col-xs-3">
					<div class="input-group">
					   <span class="input-group-addon">Sampai :</span>
					   <input type="text" class="form-control" id="end_date" name="end_date" value="<?php echo date('d-m-Y');?>">
					</div>
				</div><!-- /.input group -->
				<div class="col-xs-1">
					<div class="input-group">
					   <button class="btn btn-block btn-primary">Cari</button>
					</div>
				</div><!-- /.input group -->
				<?php echo form_close();?>
			  </div>
			</div>
			<div class="box-body">
			<?php
				if($this->session->flashdata('message'))
				{
					echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';
				}
				elseif($this->session->flashdata('success'))
				{
					echo '<div class="alert alert-success">'.$this->session->flashdata('success').'</div>';
				}
				?>
			  <table id="inventory" class="table table-striped table-bordered table-hover">
				<thead>
				  <tr>
					<th class="text-center">No.</th>
					<th class="text-center">Tanggal</th>
					<th class="text-center">Inventory Name</th>
					<th class="text-center">QTY</th>
					<th class="text-center">Satuan</th>
					<th class="text-center">Keterangan</th>
					<th class="text-center">Status</th>
				  </tr>
				</thead>
				<tbody>
				<?php
					$no=1;
					foreach($inventoryrecord AS $inventory)
					{
					?>
				  <tr>
					<td><?php echo $no++;?></td>
					<td><?php echo date('d-m-Y H:i:s',strtotime($inventory->created_time));?></td>
					<td><?php echo $inventory->material_name;?></td>
					<td><?php echo $inventory->inventory_stock;?></td>
					<td><?php echo $inventory->material_unit_name;?></td>
					<td><?php echo $inventory->inventory_description;?></td>
					<td><?php echo $inventory->inventory_status;?></td>
				  </tr>
				<?php };?>
				</tbody>
				<tfoot>
				  <tr>
					<th class="text-center">No.</th>
					<th class="text-center">Tanggal</th>
					<th class="text-center">Inventory Name</th>
					<th class="text-center">QTY</th>
					<th class="text-center">Satuan</th>
					<th class="text-center">Keterangan</th>
					<th class="text-center">Status</th>
				  </tr>
				</tfoot>
			  </table>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->