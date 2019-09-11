<script>
		$(function () {
			 $('#cashier_summary').DataTable({
		 "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		 "order": [[ 0, "desc" ]],
		 "pagingType": "full_numbers",
		 "dom":"Bfrtip",
		 "buttons":['excel','pdf','print']
	 });
	 $('div.dataTables_filter input').focus();

	 $('#start_date').datepicker({
						format: 'yyyy-mm-dd',
						todayBtn: true,
						todayHighlight: true,
						autoclose: true
					});
	$('#end_date').datepicker({
						format: 'yyyy-mm-dd',
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
		<!--div class="row">
		<div class="col-xs-12">
			<div class="box box-solid">
				<div class="box-body">
					<a href="<?=base_url()?>finance/pr_summary" class="btn btn-primary">Purchase Requisition (PR)</a>
					<a href="<?=base_url()?>finance/po_summary" class="btn btn-primary">Purchase Order (PO)</a>
				</div>
			</div>
		</div>
		</div-->
		<div class="row">
			<div class="col-xs-12">
					<div class="box box-solid box-success">
				<div class="box-body">
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
			<?php echo form_open('finance/se_summary/search/');?>
			<div class="col-xs-12 col-md-3">
				<div class="input-group">
				 <span class="input-group-addon">Dari :</span>
					<input type="text" class="form-control" id="start_date" name="start_date" value="<?php echo $tglawal;?>">
				</div><!-- /.input group -->
			</div>
			<div class="col-xs-12 col-md-3">
				<div class="input-group">
					 <span class="input-group-addon">Sampai :</span>
					 <input type="text" class="form-control" id="end_date" name="end_date" value="<?php echo $tglakhir;?>">
				</div>
			</div><!-- /.input group -->
			<div class="col-xs-12 col-md-1">
				<div class="input-group">
					 <button class="btn btn-block btn-primary">Cari</button>
				</div>
			</div><!-- /.input group -->
			<div class="col-xs-2">

			</div><!-- /.input group -->
			<?php echo form_close();?>
			<br>
			<br>
			<br>
			<div>
								<table id="cashier_summary" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
					<th class="text-center">No. STK</th>
					<th class="text-center">Nama Kasir</th>
					<th class="text-center">Buka Kasir</th>
					<th class="text-center">Tutup Kasir</th>
					<th class="text-center">Saldo Awal</th>
					<th class="text-center">Tunai</th>
					<th class="text-center">Non Tunai</th>
					<th class="text-center">Total Penjualan</th>
					<th class="text-center">Total Uang Tunai</th>
					<th class="text-center">Verifikasi</th>
										</tr>
									</thead>
									<tbody>
				<?php
					foreach($serecord AS $se)
					{
					?>
										<tr>
					<td align="center"><?php echo anchor('finance/se_detail/' . $se->se_id,$se->se_id);?></td>
					<td align="center"><?php
										$get_cashier_name = $this->account_model->get_user_by_user_id($se->created_by);
										foreach($get_cashier_name as $cashier)
										{
											$cashier_full_name	= $cashier->full_name;
										}
										echo $cashier_full_name;?></td>
					<td align="center"><?php echo date("d-m-Y H:i:s",strtotime($se->open_shift_time));?></td>
					<td align="center"><?php if($se->closed_shift_time == TRUE) echo date("d-m-Y H:i:s",strtotime($se->closed_shift_time));?></td>
					<td align="center"><?php if($se->capital_money == TRUE) echo number_format($se->capital_money,0,',','.');?></td>
					<td align="center"><?php if($se->income_cash == TRUE) echo number_format($se->income_cash,0,',','.');?></td>
					<td align="center"><?php if($se->income_noncash == TRUE) echo number_format($se->income_noncash,0,',','.');?></td>
					<td align="center"><?php echo number_format($se->income_cash + $se->income_noncash,0,',','.');?></td>
					<td align="center"><?php if($se->total_cash == TRUE) echo number_format($se->total_cash,0,',','.');?></td>
					<td align="center"><?php
											if($se->verified_time == FALSE)
												echo "<span class=text-red>Belum</span>";
											else echo "<span class=text-green>Sudah</span>";?></td>
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
