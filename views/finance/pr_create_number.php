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
				echo form_open('finance/pr_number_create','class=form-horizontal');
				?>
				<div class="box-body">
					<div class="form-group">
						<label class="col-sm-3 control-label">No. PR</label>
						<div class="col-xs-3">
							<input type="text" class="form-control" name="pr_number">
						</div>
					</div>
				</div><!-- /.box-body -->
				<div class="box-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<a href="<?=base_url()?>finance/pr_summary" class="btn btn-default pull-right">Kembali</a>
				</div><!-- /.box-footer -->
				<?php echo form_close();?>
			</div>
		</div><!-- /.box-body -->
	  </div><!-- /.box -->
	</div><!-- /.col -->
  </div><!-- /.row (main row) -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->