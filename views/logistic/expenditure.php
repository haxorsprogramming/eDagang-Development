<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Main content -->
	<section class="content">
	  <!-- Small boxes (Stat box) -->
	  <div class="row">
		
		<div class="col-xs-12">
		  <div class="box box-solid box-warning">
			<div class="box-body">
			<?php					
				if ($this->session->flashdata('message_error'))
					echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
				elseif ($this->session->flashdata('message_success'))
					echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
			?>
			<!-- form start -->
			<?php 
			echo '<label class="text text-red">'.validation_errors().'</label>';
			echo form_open_multipart('logistic/expenditure',['class'=>'form-horizontal']);?>
			  <div class="box-body">
				<div class="form-group">
				  <label class="col-sm-2 control-label">Lokasi Tujuan</label>
				  <div class="col-xs-3">
					<select name="item_id" class="form-control select2">
					<?php
					$logistic_location = $this->logistic_model->get_logistic_location();
					foreach ($logistic_location as $row)
					{
					?>
						<option value="<?php echo $row->logistic_location_id;?>"><?php echo $row->logistic_location_name;?></option>
					<?php }?>
					</select>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Item</label>
				  <div class="col-xs-3">
					<select name="item_id" class="form-control select2">
					<?php
					$items = $this->logistic_model->get_items();
					foreach ($items as $item)
					{
					?>
						<option value="<?php echo $item->logistic_item_id;?>"><?php echo $item->logistic_item_name;?></option>
					<?php }?>
					</select>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Keterangan</label>
				  <div class="col-xs-5">
					<textarea class="form-control" name="description" placeholder="Keterangan" rows="5"><?php echo set_value('description');?></textarea>	
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Stok</label>
				  <div class="col-xs-2">
					<input type="text" class="form-control" name="stock" placeholder="Stok" value="<?php echo set_value('stock');?>">
				  </div>
				</div>
			  </div><!-- /.box-body -->
			  <div class="box-footer">
				<button type="submit" class="btn btn-success">Simpan</button>
				<a href="<?=base_url()?>logistic" class="btn btn-danger pull-right">Batal</a>
			  </div><!-- /.box-footer -->
		   <?php echo form_close();?>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <!-- page script rent_car_history-->