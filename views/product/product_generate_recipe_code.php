<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Main content -->
<section class="content">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box box-solid box-success">
		<div class="box-header with-border">
		  <h3 class="box-title"><?=$sub_title?></h3>
		</div><!-- /.box-header -->
		<div class="box-body">
			<?php					
			if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';
			echo '<span class=text-red>'.validation_errors().'</span>';
			echo form_open('product/recipe_cart','class=form-horizontal');
			foreach($countrecipe as $recipe)
			{
				$recipe_number	= $recipe->count + 1;
				$recipe_code	= $this->session->userdata('product_recipe_prefix_code') . $recipe_number;
			}
			?>
			<div class="box-body">
				<div class="form-group">
					<label class="col-sm-5 col-md-2 control-label">Kode CoP</label>
					<div class="col-sm-4">
						<input type="text" name="product_recipe_code" class="form-control" value="<?php echo $recipe_code;?>" disabled>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-5 col-md-2 control-label">Nama CoP</label>
					<div class="col-sm-7">
						<input type="text" name="product_recipe_name" class="form-control" value="<?php echo set_value('product_recipe_name');?>" autofocus>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-5 col-md-2 control-label">Perkiraan Kehilangan</label>
					<div class="col-sm-2">
						<select name="product_recipe_loss_cost_percent" class="form-control select2" autofocus>
							<?php
							for($i=0;$i<=100;$i++)
							{
							?>
							<option value="<?php echo $i;?>"><?php echo $i;?>%</option>
							<?php }?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-5 col-md-2 control-label">Keterangan</label>
					<div class="col-sm-7">
						<input type="text" name="product_recipe_explanation" class="form-control" value="<?php echo set_value('product_recipe_explanation');?>">
					</div>
				</div>
			</div><!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" class="btn btn-success">Simpan</button>
				<a href="<?=base_url()?>product/recipe" class="btn btn-danger pull-right">Batal</a>
			</div><!-- /.box-footer -->
			<?php echo form_close();?>
		</div>
	</div><!-- /.box-body -->
  </div><!-- /.box -->
</div><!-- /.col -->
</div><!-- /.row (main row) -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->