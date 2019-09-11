<?php
foreach($transactionrecord AS $trx)
{
	$old_transaction_code		= $trx->transaction_code;
}
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	<!-- Content Header (Page header) -->

	<!-- Main content -->
	<section class="content">
		
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-xs-8">
				<div class="box box-solid box-warning">
					<?php echo form_open('transaction/combine_bill_process',['class'=>'form-horizontal']);?>
					<div class="box-body">
						<?php
						echo '<span class=text-red>'.validation_errors().'</span>';
						if ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';?>
						<div class="form-group">
						  <label class="col-sm-6 control-label">Pilih Kode Trx / Meja</label>
						  <div class="col-sm-6">
							<select name="transaction_code" class="form-control select2">
							<?php
							$old_transaction	= $this->transaction_model->get_transaction_unpaidnon($tc);
							foreach($old_transaction AS $oldtransaction)
							{
							?>
							<option value="<?php echo $oldtransaction->transaction_code;?>"><?php echo $oldtransaction->transaction_code;?> / <?php echo $oldtransaction->table;?> / <?php echo date('d-m-Y H:i:s', strtotime($oldtransaction->created_time));?></option>
							<?php
							}
							?>
							</select>
                            <input type="hidden" id="tid" name="tid" value="<?=$tid?>">
						  </div>
						</div>
					</div>
					<div class="box-footer">
						<input type="hidden" name="old_transaction_code" value="<?php echo $old_transaction_code;?>">
						<a href="<?php echo base_url();?>transaction/detail/<?php echo $old_transaction_code;?>" class="btn btn-danger">Kembali</a>
						<button type="submit" class="btn btn-lg btn-success pull-right">Simpan</button>
					</div><!-- /.box-footer -->
					<?php echo form_close();?>
				</div>
			</div>
		</div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->