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
						echo form_open('order/select_product'); ?>
						<?php if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
						  <div class="box-body">
							<div class="form-group">
							<label>Nama Pelanggan</label>
								<input type="text" name="customer_name" class="form-control">
							</div>
							<div class="form-group">
							<label>Email</label>
								<input type="text" name="customer_email" class="form-control">
							</div>
							<div class="form-group">
							<label>Nomor HP</label>
								<input type="text" name="customer_phone_number" class="form-control">
							</div>
						  </div><!-- /.box-body -->
						  <div class="box-footer">
							<a href="<?php echo base_url() . 'order/cancel';?>" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-success pull-right">Simpan</button>
						  </div><!-- /.box-footer -->
						<?php echo form_close();?>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div>
			
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->