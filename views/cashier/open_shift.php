<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Main content -->
	<section class="content">
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-info">
			<div class="box-body">
			<?php					
				if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
			<!-- form start -->
			<?php 
			echo validation_errors();
			echo form_open_multipart('cashier/open_shift',['class'=>'form-horizontal']);?>
			  <div class="box-body">
				<div class="form-group">
				  <label class="col-sm-2 control-label">Saldo Awal</label>
				  <div class="col-xs-5">
					<input type="text" class="form-control" name="capital_money" placeholder="Kas Awal" value="<?php echo set_value('capital_money');?>">
				  </div>
				</div>
			  </div><!-- /.box-body -->
			  <div class="box-footer">
				<button type="submit" class="btn btn-success">Simpan</button>
			  </div><!-- /.box-footer -->
		   <?php echo form_close();?>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <!-- page script rent_car_history-->