<?php
	foreach($subcategory as $sc)
	{
		$category_id			= $sc->category_id;
		if ($this->input->post('is_submitted'))
		{
			$sub_category_name	= set_value('sub_category_name');
		}
		else
		{
			$parent_category_id	= $sc->parent_category_id;
			$sub_category_id	= $sc->category_id;
			$sub_category_name	= $sc->product_category_name;
		}
		
		$parent_category	= $this->product_model->get_sub_category_by_product_sub_category_id($parent_category_id);
		foreach($parent_category as $pc)
		{
			$parent_category_name	= $pc->product_category_name;
		}
	}
?>
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
					if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
                <!-- form start -->
				<?php 
				echo '<span class=text-red>'.validation_errors().'</span>';
				echo form_open_multipart('product/edit_sub_category/' . $category_id,['class'=>'form-horizontal']);?>
                  <div class="box-body">
					<div class="form-group">
						<label class="col-sm-4 col-md-2 control-label">Main Kategori</label>
							<div class="col-sm-5">
								<select name="category_id" class="form-control">
								<option value="<?=$parent_category_id?>"><?=$parent_category_name?></option>
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
									<option value="<?=$category->category_id?>"><?=$category->product_category_name?></option>
								<?php }?>
								</select>
							</div>
					</div>
                    <div class="form-group">
                      <label class="col-sm-4 col-md-2 control-label">Nama Kategori</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="sub_category_name" placeholder="Nama Kategori" value="<?php echo $sub_category_name;?>">
                      </div>
                    </div>
				  </div><!-- /.box-body -->
                  <div class="box-footer">
					<input type="hidden" name="is_submitted" value="1">
					<input type="hidden" name="sub_category_id" value="<?php echo $sub_category_id;?>">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?=base_url().'product/sub_category'?>" class="btn btn-danger pull-right">Batal</a>
                  </div><!-- /.box-footer -->
               <?php echo form_close();?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			</div><!-- /.col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  <!-- page script rent_car_history-->