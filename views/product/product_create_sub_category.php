<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Main content -->
	<section class="content">
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-success">
			<div class="box-body">
			<?php					
				if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
			<?php 
			echo '<span class=text-red>'.validation_errors().'</span>';
			echo form_open_multipart('product/create_sub_category',['class'=>'form-horizontal']);?>
			  <div class="box-body">
				<div class="form-group">
					<label class="col-sm-4 col-md-2 control-label">Main Kategori</label>
						<div class="col-sm-5">
							<select name="parent_category_id" class="form-control">
							<?php
                            $group_id = $this->session->userdata('group_id');
                            if ($group_id =='14'){
                                $product_category	= $this->product_model->get_product_category3();
                            }elseif ($group_id =='16'){
                                $product_category	= $this->product_model->get_product_category2();
                            }else{
                                $product_category	= $this->product_model->get_product_category();
                            }
							//$product_category	= $this->product_model->get_product_category();
							foreach($product_category as $category)
							{
							?>
								<option value="<?php echo $category->category_id;?>"><?php echo $category->product_category_name;?></option>
							<?php }?>
							</select>
						</div>
				</div>
				<div class="form-group">
				  <label class="col-sm-4 col-md-2 control-label">Nama Kategori</label>
				  <div class="col-sm-6">
					<input type="text" class="form-control" name="sub_category_name" placeholder="Nama Kategori" value="<?php echo set_value('sub_category_name');?>">
				  <label class="control-label">Tidak boleh mengandung ' atau "</label>
                  </div>
				  
				</div>
			  </div><!-- /.box-body -->
			  <div class="box-footer">
				<button type="submit" class="btn btn-success">Simpan</button>
				<a href="<?php echo base_url().'product/sub_category';?>" class="btn btn-danger pull-right">Batal</a>
			  </div><!-- /.box-footer -->
		   <?php echo form_close();?>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->