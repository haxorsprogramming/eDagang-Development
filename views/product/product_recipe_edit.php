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
			
			foreach($recipes as $recipe)
			{
				$product_recipe_id						= $recipe->product_recipe_id;
				$product_recipe_code					= $recipe->product_recipe_code;
				$product_recipe_name					= $recipe->product_recipe_name;
				$product_recipe_loss_cost_percent		= $recipe->product_recipe_loss_cost_percent;
				$product_recipe_explanation				= $recipe->product_recipe_explanation;
			}
			echo form_open('product/recipe_edit_cart/'.$product_recipe_id,'class=form-horizontal');
			?>
            
			<div class="box-body">
				<div class="form-group">
					<label class="col-sm-5 col-md-2 control-label">Kode CoP</label>
					<div class="col-sm-5">
						<input type="text" name="product_recipe_code" class="form-control" value="<?php echo $product_recipe_code;?>" disabled>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-5 col-md-2 control-label">Nama CoP</label>
					<div class="col-sm-6">
						<input type="text" name="product_recipe_edit_name" class="form-control" value="<?php echo $product_recipe_name;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-5 col-md-2 control-label">Perkiraan Kehilangan</label>
					<div class="col-sm-3">
						<select name="product_recipe_loss_cost_percent" class="form-control select2" autofocus>
							<option value="<?php echo $product_recipe_loss_cost_percent;?>"><?php echo $product_recipe_loss_cost_percent;?>%</option>
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
					<div class="col-sm-5">
						<input type="text" name="product_recipe_edit_explanation" class="form-control" value="<?php echo $product_recipe_explanation;?>">
					</div>
				</div>
			</div><!-- /.box-body -->
			<div class="box-footer">
				<input type="hidden" name="product_recipe_id" value="<?php echo $product_recipe_id;?>">
				<input type="hidden" name="product_recipe_code" value="<?php echo $product_recipe_code;?>">
				<button type="submit" class="btn btn-success">Edit</button>
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