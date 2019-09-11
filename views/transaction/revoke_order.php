<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	<!-- Content Header (Page header) -->

	<!-- Main content -->
	<section class="content">
		
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-solid box-warning">
					<?php echo form_open('transaction/revoke_order_process',['class'=>'form-horizontal']);?>
					<div class="box-body">
						<?php
						echo '<span class=text-red>'.validation_errors().'</span>';
						if ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';?>
						<div class="form-group">
						  <label class="col-sm-2 control-label">Kode Trx</label>
						  <div class="col-xs-3">
							<input type="text" class="form-control" value="<?php echo $transaction_code;?>" disabled>
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-sm-2 control-label">No. Order</label>
						  <div class="col-xs-3">
							<input type="text" class="form-control" value="<?php echo $order_id;?>" disabled>
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-sm-2 control-label">Alasan Pembatalan</label>
						  <div class="col-xs-5">
							<textarea class="form-control" rows="5" name="note" placeholder="Alasan Pembatalan"><?php echo set_value('note');?></textarea>
						  </div>
						</div>
					</div>
					<div class="box-footer">
						<input type="hidden" name="transaction_code" value="<?php echo $transaction_code;?>">
						<input type="hidden" name="order_id" value="<?php echo $order_id;?>">
						<a href="<?php echo base_url();?>transaction/detail/<?php echo $transaction_code;?>" class="btn btn-primary">Kembali</a>
						<button type="submit" class="btn btn-lg btn-success pull-right">Simpan</button>
					</div><!-- /.box-footer -->
					<?php echo form_close();?>
				</div>
			</div>
		</div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->