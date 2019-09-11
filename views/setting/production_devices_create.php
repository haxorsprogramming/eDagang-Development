<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Main content -->
	<section class="content">

	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-success">
			<div class="box-header with-border">
			  <h3 class="box-title"><?php echo $sub_title;?></h3>
			</div><!-- /.box-header -->
			<div class="box-body">
			<?php
				if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
			<?php
			echo '<span class=text-red>'.validation_errors().'</span>';
			echo form_open('setting/production_devices_create',['class'=>'form-horizontal']);?>
			  <div class="box-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">Type</label>
						<div class="col-xs-2">
							<select name="production_devices_type" class="form-control">
								<option value="1">Printer</option>
								<option value="2">PC</option>
                <option value="3">FingerPrint</option>
							</select>
						</div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Nama Perangkat</label>
				  <div class="col-xs-3">
					<input type="text" class="form-control" name="production_devices_name" placeholder="Nama Perangkat" value="<?php echo set_value('production_devices_name');?>">
				  </div>
				  <label class="control-label">Tidak boleh mengandung ' atau "</label>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">IP Address (v4)</label>
				  <div class="col-xs-3">
					<input type="text" class="form-control" name="production_devices_ip_address" placeholder="(Contoh : 192.168.1.7)" value="<?php echo set_value('production_devices_ip_address');?>">
				  </div>
				</div>
			  </div><!-- /.box-body -->
			  <div class="box-footer">
				<button type="submit" class="btn btn-success">Simpan</button>
				<a href="<?php echo base_url().'setting/production_devices';?>" class="btn btn-danger pull-right">Batal</a>
			  </div><!-- /.box-footer -->
			<?php echo form_close();?>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->
