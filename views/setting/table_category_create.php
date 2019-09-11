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
		<?php	echo form_open('setting/table_category/create/do',['class'=>'form-horizontal']);?>
			  <div class="box-body">
        <div class="form-group">
				  <label class="col-sm-6 col-md-3 control-label">Nama Kategori Meja / Ruangan</label>
				  <div class="col-sm-5">
					<input type="text" class="form-control" name="table_category_name" placeholder="Nama Kategori Meja / Ruangan" value="<?php echo set_value('table_category_name');?>" required minlength='3'>
				  </div>
				</div>
			  </div><!-- /.box-body -->
			  <div class="box-footer">
				<button type="submit" class="btn btn-success">Simpan</button>
				<a href="<?php echo base_url().'setting/table_category';?>" class="btn btn-danger pull-right">Batal</a>
			  </div><!-- /.box-footer -->
			<?php echo form_close();?>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->