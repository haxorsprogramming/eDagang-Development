<?php
	foreach($serecord as $row)
	{
		$open_shift_time	= '';
		$closed_shift_time	= '';
		$verified_time		= '';
		$cashier_full_name	= '';
		$verified_full_name	= '';
		
		$se_id				= $row->se_id;
		
		if ($this->input->post('is_submitted'))
		{
			$capital_money			= set_value('capital_money');
			$income_cash			= set_value('income_cash');
			$income_noncash			= set_value('income_noncash');
			$total_cash				= set_value('total_cash');
			$total_income			= set_value('total_income');
			$actual_money			= set_value('actual_money');
			$margin					= set_value('margin');
			$closed_shift_notes		= set_value('closed_shift_notes');
		}
		else
		{
			$created_by				= $row->created_by;
			$open_shift_time		= $row->open_shift_time;
			$capital_money			= $row->capital_money;
			$closed_shift_time		= $row->closed_shift_time;
			$income_cash			= $row->income_cash;
			$income_noncash			= $row->income_noncash;
			$total_cash				= $row->total_cash;
			$total_income			= $row->total_income;
			$actual_money			= $row->actual_money;
			$margin					= $row->margin;
			$closed_shift_notes		= $row->closed_shift_notes;
			$verified_time			= $row->verified_time;
			$verified_by			= $row->verified_by;
		}
		
		if ($verified_time == TRUE)
		{
			$get_cashier_name = $this->account_model->get_user_by_user_id($created_by);
			foreach($get_cashier_name as $cashier)
			{
				$cashier_full_name	= $cashier->full_name;
			}
			$get_verified_name = $this->account_model->get_user_by_user_id($verified_by);
			foreach($get_verified_name as $verified)
			{
				$verified_full_name	= $verified->full_name;
			}
		}
		else
		{
			$verified_time = '';
		}
	}
?>
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
				echo form_open('finance/se_edit/'.$se_id,'class=form-horizontal');
				?>
				<div class="box-body">
					<div class="form-group">
						<label class="col-sm-3 control-label">No. SE</label>
						<div class="col-xs-3">
							<input type="text" class="form-control" value="<?=$se_id?>" disabled>
							<input type="hidden" name="se_id" class="form-control" value="<?=$se_id?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Nama Kasir</label>
						<div class="col-xs-3">
							<input type="text" class="form-control" value="<?=$cashier_full_name?>" disabled>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Buka Kasir</label>
						<div class="col-xs-3">
							<input type="text" class="form-control" value="<?=$open_shift_time?>" disabled>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Tutup Kasir</label>
						<div class="col-xs-3">
							<input type="text" class="form-control" value="<?=$closed_shift_time?>" disabled>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Saldo Awal</label>
						<div class="col-xs-3">
							<input type="text" name="capital_money" class="form-control" value="<?=$capital_money?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Pendapatan Tunai</label>
						<div class="col-xs-3">
							<input type="text" name="income_cash" class="form-control" value="<?=$income_cash?>">
						</div>
					</div> 
					<div class="form-group">
						<label class="col-sm-3 control-label">Pendapatan Non Tunai</label>
						<div class="col-xs-3">
							<input type="text" name="income_noncash" class="form-control" value="<?=$income_noncash?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Total Uang Tunai</label>
						<div class="col-xs-3">
							<input type="text" name="total_cash" class="form-control" value="<?=$total_cash?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Total Pendapatan</label>
						<div class="col-xs-3">
							<input type="text" name="total_income" class="form-control" value="<?=$total_income?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Uang di Kasir</label>
						<div class="col-xs-3">
							<input type="text" name="actual_money" class="form-control" value="<?=$actual_money?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Selisih</label>
						<div class="col-xs-3">
							<input type="text" name="margin" class="form-control" value="<?=$margin?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Catatan</label>
						<div class="col-xs-3">
							<textarea name="closed_shift_notes" class="form-control" rows="5"><?=$closed_shift_notes?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Waktu Verifikasi</label>
						<div class="col-xs-3">
							<input type="text" class="form-control" value="<?=$verified_time?>" disabled>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Verifikasi Oleh</label>
						<div class="col-xs-3">
							<input type="text" class="form-control" value="<?=$verified_full_name?>" disabled>
						</div>
					</div>
				</div><!-- /.box-body -->
				<div class="box-footer">
					<input type="hidden" name="is_submitted" value="1">
					<?php
						if($verified_time == FALSE)
						{
						?>
						<button type="submit" class="btn btn-success">Simpan</button>
						<?php
						}
						?>                    
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
<!-- page script rent_car_history-->