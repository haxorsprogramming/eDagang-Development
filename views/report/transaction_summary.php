<script>
  $(function () {
	 $('#transaction').DataTable({
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
    <section class="content-header">
    	<a href="<?=base_url()?>transaction/rekap_transaksi" class="btn btn-primary">Rekap</a>
    </section>

	<!-- Main content -->
	<section class="content">
	  <!-- Small boxes (Stat box) -->
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-warning">
			<div class="box-header">
			  <h3 class="box-title"><?php echo $sub_title;?></h3>
			</div><!-- /.box-header -->
			<div class="box-body">
			  <div class="col-xs-12">
				<?php echo form_open('report/transaction_search');?>
				<div class="col-xs-3">
					<div class="input-group">
					 <span class="input-group-addon">Dari :</span>
					  <input type="text" class="form-control" id="start_date" name="start_date" value="<?php echo $start_date;?>">
					</div><!-- /.input group -->
				</div>
				<div class="col-xs-3">
					<div class="input-group">
					   <span class="input-group-addon">Sampai :</span>
					   <input type="text" class="form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>">
					</div>
				</div><!-- /.input group -->
				<div class="col-xs-1">
					<div class="input-group">
					   <button class="btn btn-block btn-primary">Cari</button>
					</div>
				</div><!-- /.input group -->
				<div class="col-xs-2">
					<div class="input-group">
					       <a class="btn btn-primary pull-right" style="margin-right: 5px;" href="<?php echo base_url().'report'.'/transaction_export_to_excel/'.$start_date.'/'.$end_date;?>"><i class="fa fa-download"></i> Export to Excel</a>
                        </div>
				</div><!-- /.input group -->
				<?php echo form_close();?>
			  </div>
			</div>
			<div class="box-body">
			  <div>
				  <table id="transaction" class="table table-striped table-bordered table-hover">
					<thead>
					  <tr>
						<th>No. Trx</th>
						<th>Waktu Pesan</th>
						<th>Waktu Bayar</th>
						<th>Pelayan</th>
						<th>No. Meja</th>
						<th>Pengunjung</th>
						<th>Catatan</th>
						<th>Status</th>
					  </tr>
					</thead>
					<tbody>
					<?php
						foreach($transactionrecord AS $trx)
						{
						?>
					  <tr>
						<td><?php echo $trx->transaction_code;?></td>
						<td><?php echo date('d-m-Y H:i:s',strtotime($trx->created_time));?></td>
						<td><?php if($trx->payment_time) echo date('d-m-Y H:i:s',strtotime($trx->payment_time));?></td>
						<td><?php echo $trx->full_name;?></td>
						<td><?php echo $trx->table;?></td>
						<td><?php echo $trx->visitor;?></td>
						<td><?php echo $trx->remark_table;?></td>
						<td><?php echo $trx->status;?></td>
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
