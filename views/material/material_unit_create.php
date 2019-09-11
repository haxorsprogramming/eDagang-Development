<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Main content -->
	<section class="content">
	  <!-- Small boxes (Stat box) -->
	  <div class="row">
		
		<div class="col-xs-12">
		  <div class="box box-solid box-success">
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
			echo form_open_multipart('material/unit_create',['class'=>'form-horizontal']);?>
			  <div class="box-body">
              
				<div class="form-group">
				  <label class="col-sm-4 col-md-2 control-label">Nama Satuan</label>
				  <div class="col-sm-5">
					<input type="text" class="form-control" name="name" placeholder="Nama Satuan" value="<?php echo set_value('name');?>">
				  </div>
				</div>
                <div class="form-group">
				  <label class="col-sm-4 col-md-2 control-label">Kode Satuan</label>
				  <div class="col-sm-5">
					<input type="text" class="form-control" name="kode" placeholder="Kode Satuan" value="<?php echo set_value('kode');?>">
				  </div>
				</div>
			  </div><!-- /.box-body -->
			  <div class="box-footer">
				<button type="submit" class="btn btn-success">Simpan</button>
				<a href="<?=base_url()?>material/units" class="btn btn-danger pull-right">Batal</a>
			  </div><!-- /.box-footer -->
		   <?php echo form_close();?>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
</div><!-- /.content-wrapper -->