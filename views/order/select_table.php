<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	
	<!-- Main content -->
	<section class="content">
	
		<div class="col-md-6">
			<div class="box box-solid box-warning">
				<div class="box-header with-border">
				  <h1 class="box-title"><?php echo $sub_title;?></h1>
				</div><!-- /.box-header -->
				<div class="box-body">
					<!-- form start -->
					<?php
					$attributes = array('class' => 'form-horizontal');
					echo form_open('order/select_menu'); ?>
					<?php if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
					  <div class="box-body">
						<div class="form-group">
						<label>Nomor Meja</label>
							<select name="table" class="form-control">
							<?php
							foreach($tableavailable as $table)
							{
							?>
								<option value="<?php echo $table->table_name;?>"><?php echo $table->table_name;?></option>
							<?php }
							?>
							</select>
						</div>
						<div class="form-group">
						<label>Remark</label>
							<input type="text" name="remark_table" class="form-control">
						</div>
						<div class="form-group">
						<label>Jumlah Pengunjung</label>
							<input type="text" name="visitor" class="form-control">
						</div>
					  </div><!-- /.box-body -->
					  <div class="box-footer">
						<a href="<?php echo base_url() . 'order/cancel';?>" class="btn btn-danger">Batal</a>
						<button type="submit" class="btn btn-lg btn-primary pull-right">Simpan</button>
					  </div><!-- /.box-footer -->
					<?php echo form_close();?>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
		
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->