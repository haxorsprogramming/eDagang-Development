<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
		<?=$title?>
		<small><?=$sub_title?></small>
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> <?=$title?></a></li>
		<li class="active"><?=$sub_title?></li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-warning">
			<div class="box-header with-border">
			  <h3 class="box-title"><?=$sub_title?></h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<?php					
				if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';
				echo '<span class=text-red>'.validation_errors().'</span>';
				echo form_open('finance/se_create','class=form-horizontal');
				?>
				<div class="box-body">
					<div class="form-group">
						<label class="col-sm-3 control-label">Nama Kasir</label>
						<div class="col-xs-3">
							<select name="cashier_id" class="form-control">
							<?php
							foreach($cashiers as $cashier)
							{
							?>
								<option value="<?=$cashier->user_id?>"><?=$cashier->full_name?></option>
							<?php
							}
							?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Buka Kasir</label>
						<div class="col-xs-3">
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Tutup Kasir</label>
						<div class="col-xs-3">
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Saldo Awal</label>
						<div class="col-xs-3">
							<input type="text" name="capital_money" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Pendapatan Tunai</label>
						<div class="col-xs-3">
							<input type="text" name="income_cash" class="form-control">
						</div>
					</div> 
					<div class="form-group">
						<label class="col-sm-3 control-label">Pendapatan Non Tunai</label>
						<div class="col-xs-3">
							<input type="text" name="income_noncash" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Total Uang Tunai</label>
						<div class="col-xs-3">
							<input type="text" name="total_cash" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Total Pendapatan</label>
						<div class="col-xs-3">
							<input type="text" name="total_income" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Uang di Kasir</label>
						<div class="col-xs-3">
							<input type="text" name="actual_money" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Selisih</label>
						<div class="col-xs-3">
							<input type="text" name="margin" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Catatan</label>
						<div class="col-xs-3">
							<textarea name="closed_shift_notes" class="form-control" rows="5"></textarea>
						</div>
					</div>
				</div><!-- /.box-body -->
				<div class="box-footer">
					<input type="hidden" name="is_submitted" value="1">
					<button type="submit" class="btn btn-success">Simpan</button>
					<a href="<?=base_url()?>finance/se_summary" class="btn btn-default pull-right">Kembali</a>
				</div><!-- /.box-footer -->
				<?php echo form_close();?>
			</div>
		</div><!-- /.box-body -->
	  </div><!-- /.box -->
	</div><!-- /.col -->
  </div><!-- /.row (main row) -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->