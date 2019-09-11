<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Main content -->
	<section class="content">
	  
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-success">
			<div class="box-header">
			  <h3 class="box-title"><?php echo $sub_title;?>
			</div><!-- /.box-header -->
			<div class="box-body">
			<?php
			if ($this->session->flashdata('message_success'))
				echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
			elseif ($this->session->flashdata('message_error'))
				echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
			echo form_open('hr/position_create','class=form-horizontal');
			?>
				<div class="form-group">
					<label class="col-sm-3 control-label">Nama Posisi</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="position_name" value="<?php echo set_value('position_name');?>">
					</div>
				</div>
			</div><!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" class="btn btn-success">Simpan</button>
				<a href="<?=base_url()?>hr/position" class="btn btn-danger pull-right">Batal</a>
			</div><!-- /.box-footer -->
			<?php echo form_close();?>
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->