<script>
  $(function () {
	 $('#profit').DataTable({
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
	  <!-- Small boxes (Stat box) -->
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-success">
			<div class="box-header">
			  <h3 class="box-title"><?php echo $sub_title;?></h3>
			</div><!-- /.box-header -->
			<div class="box-body">
			  <div class="col-xs-12">
				<?php echo form_open('report/profit_search');?>
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
				<div class="col-xs-2">
					
				</div><!-- /.input group -->
				<?php echo form_close();?>
			  </div>
			</div>
			<div class="box-body">
			  <div>
				  <table id="profit" class="table table-striped table-bordered table-hover">
					<thead>
					  <tr>
						<th>No.</th>
						<th>Tanggal</th>
						<th>Modal</th>
						<th>Penjualan</th>
						<th>Profit</th>
					  </tr>
					</thead>
					<tbody>
					<?php
						$no=1;
						foreach($profitrecord AS $profit)
						{
						?>
					  <tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $profit->sales_date;?></td>
						<td><?php echo number_format($profit->purchase_price,0,',','.');?></td>
						<td><?php echo number_format($profit->selling_price,0,',','.');?></td>
						<td><?php echo number_format($profit->profit,0,',','.');?></td>
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