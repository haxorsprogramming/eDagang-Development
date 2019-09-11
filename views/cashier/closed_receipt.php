<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Main content -->
	<section class="content">
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-warning">
			<div class="box-body">
			<?php					
				if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
			<div class="form-horizontal">
			<?php
			foreach($data_shift as $row)
			{
				$open_shift_time	= $row->open_shift_time;
				$capital_money		= $row->capital_money;
				$closed_shift_time	= $row->closed_shift_time;
				$income_cash		= $row->income_cash;
				$income_noncash		= $row->income_noncash;
				$total_cash			= $row->total_cash;
				$total_income		= $row->total_income;
				$actual_money		= $row->actual_money;
				$margin				= $row->margin;
				$closed_shift_notes	= $row->closed_shift_notes;
			}
			?>
			<div class="box-body">
				<div class="form-group">
					<label class="col-sm-4 control-label">No. Bukti Kasir</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" value="<?php echo $row->se_id;?>" disabled>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Buka Kasir</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" value="<?php echo $open_shift_time;?>" disabled>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Tutup Kasir</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" value="<?php echo $closed_shift_time;?>" disabled>
					</div>
				</div>
				<!--<div class="form-group">
					<label class="col-sm-4 control-label">Saldo Awal</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" value="<?php echo number_format($capital_money,0,',','.');?>" disabled>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Pendapatan Tunai</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" value="<?php echo number_format($income_cash,0,',','.');?>" disabled>
					</div>
				</div> 
				<div class="form-group">
					<label class="col-sm-4 control-label">Pendapatan Non Tunai</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" value="<?php echo number_format($income_noncash,0,',','.');?>" disabled>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Total Pendapatan Tunai + Non Tunai</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" value="<?php echo number_format($total_income,0,',','.');?>" disabled>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Total Uang Tunai</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" value="<?php echo number_format($total_cash,0,',','.');?>" disabled>
					</div>
				</div>-->
				<div class="form-group">
					<label class="col-sm-4 control-label">Uang di Kasir</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" value="<?php echo number_format($actual_money,0,',','.');?>" disabled>
					</div>
				</div>
				<!--<div class="form-group">
					<label class="col-sm-4 control-label">Selisih</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" value="<?php echo number_format($margin,0,',','.');?>" disabled>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Catatan</label>
					<div class="col-xs-3">
						<textarea class="form-control" rows="5" disabled><?php echo $closed_shift_notes;?></textarea>
					</div>
				</div>-->
			</div><!-- /.box-body -->
			<div class="box-footer">
				<!--<a href="<?php echo base_url();?>cashier/exchange_receipt" class="btn btn-lg btn-success" target="_blank">Cetak</a>-->
			</div><!-- /.box-footer -->
		   </div>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->