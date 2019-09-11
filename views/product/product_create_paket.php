<script>
$(document).ready(function() {

	//here first get the contents of the div with name class copy-fields and add it to after "after-add-more" div class.
      $(".add-more").click(function(){ 
          var html = $(".copy-fields").html();
          $(".after-add-more").after(html);
      });
//here it will remove the current value of the remove button which has been pressed
      $("body").on("click",".remove",function(){ 
          $(this).parents(".control-group").remove();
      });

    });

</script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Main content -->
	<section class="content">
	
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-default">
			<?php if($this->session->userdata('division') == 1)
			{
			// Divisi Resto
			?>
			<div class="box-body">
			<?php					
				if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
			<?php 
			echo '<span class=text-red>'.validation_errors().'</span>';
			echo form_open_multipart('product/create_paket',['class'=>'form-horizontal']);?>
			  <div class="box-body">
				<div class="form-group">
					<label class="col-sm-4 col-md-2 control-label">Kategori</label>
					<div class="col-sm-6">
						<select name="category_id" id="category_id" class="form-control select2" autofocus>
						<?php
                        $group_id = $this->session->userdata('group_id');
                        if ($group_id =='14'){
                            $product_category	= $this->product_model->get_product_category3();
                        }elseif($group_id =='16'){
                             $product_category	= $this->product_model->get_product_category2();
                        }else{
                            $product_category	= $this->product_model->get_product_category();
                        }
						
						foreach($product_category as $category)
						{
						?>
							<option value="<?php echo $category->category_id."#".$category->product_category_name;?>"><?php echo $category->product_category_name;?></option>
						<?php }?>
						</select>
					</div>
				</div>
                   				
				<div class="form-group">
					<label class="col-sm-4 col-md-2 control-label">Sub Kategori</label>
						<div class="col-sm-8">
							<select id="sub_category_id" name="sub_category_id" class="form-control select2">
							<?php
                             if ($group_id =='14'){
                                 $product_sub_category	= $this->product_model->get_sub_category3();
                            }elseif($group_id =='16'){
                                 $product_sub_category	= $this->product_model->get_sub_category2();
                            }else{
                                $product_sub_category	= $this->product_model->get_sub_category();
                            }
							
							foreach($product_sub_category as $sub_category)
							{
							?>
								<option value="<?php echo $sub_category->category_id."#".$sub_category->product_category_name;?>"><?php echo $sub_category->product_category_name;?></option>
							<?php }?>
							</select>
						</div>
                        
                        	<script>
										$('#category_id').change(function(){
											var cid=$('#category_id').val();
											var cide=cid.split('#');
											//alert(cide[1]);
											$('#divproduct').html("loading......");
											$('#divproductother').html("loading......");
											if(cide[1]=='Paket'){
												$('#addcat').css({"visibility":"visible"});
												$('#lblresep').html('Produk');
												$('#divproduct').load('<?=base_url()?>product/v_product/0');
												$('#divproductother').load('<?=base_url()?>product/v_product/0');
											
											}else{
												$('#lblresep').html('Resep');
												$('#addcat').css({"visibility":"hidden"});
												$('#divproduct').load('<?=base_url()?>product/v_resep/0');
												$('#divproductother').load('<?=base_url()?>product/v_resep/0');
											}
											return false;
										});
										</script>
				</div>
				<div class="form-group" >
				  <label class="col-sm-4 col-md-2 control-label">Nama Produk</label>
				  <div class="col-sm-8">
					<input type="text" class="form-control" name="product_name" placeholder="Nama Produk" value="<?php echo set_value('product_name');?>">
				  <label class="control-label">Tidak boleh mengandung ' atau "</label>
                  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-4 col-md-2 control-label">Deskripsi</label>
				  <div class="col-sm-8">
				  <input type="text" class="form-control" name="product_description" placeholder="Deskripsi" value="<?php echo set_value('product_description');?>">
				  <label class="control-label">Tidak boleh mengandung ' atau "</label>
                  </div>
				</div>
                <div class="form-group">
                	<div>
					<label class="col-sm-4 col-md-2 control-label" id="lblresep">CoP</label>
						<div class="col-sm-8">
                        
                        <div class="input-group control-group after-add-more">
			
			<table class="table " >
				
                    <div id="education_fields">
					<tr>
						<td>
							<div class="col-xs-12">
                            	<div id="divproduct">
								<select name="product_recipe_id[]" class="form-control">
								<?php
								foreach($reseps as $resep)
                                        {
                                            
                                        ?>
                                            <option value="<?php echo $resep->product_recipe_id;?>"><?php echo $resep->product_recipe_name;?> => <?php echo $resep->product_recipe_grand_total;?></option>
                                        <?php }?>
								</select>
                                </div>
							</div>
						</td>
						
					</tr>
					
                    </div>
				</table>
			   <!--<input type="text" name="addmore[]" class="form-control" placeholder="Enter Name Here">-->
					  <div class="input-group-btn" style="visibility:hidden"  id="addcat"> 
						<button class="btn btn-success add-more"  type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
					  </div>
			  </div>

      
		

        <!-- Copy Fields-These are the fields which we get through jquery and then add after the above input,-->
        <div class="copy-fields hide">
          <div class="control-group input-group" style="margin-top:10px">
           <!-- <input type="text" name="addmore[]" class="form-control" placeholder="Enter Name Here">-->
           <table class="table ">
					
                    <div id="education_fields">
					<tr>
						<td>
							<div class="col-xs-12">
                            <div id="divproductother">
								<select name="product_recipe_id[]" class="form-control">
								<?php
								foreach($reseps as $resep)
                                        {
                                            
                                        ?>
                                            <option value="<?php echo $resep->product_recipe_id;?>"><?php echo $resep->product_recipe_name;?> => <?php echo $resep->product_recipe_grand_total;?></option>
                                        <?php }?>
								</select>
                            </div>
							</div>
						</td>
					
					</tr>
					
                    
                    </div>
				</table>
            <div class="input-group-btn"> 
              <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
            </div>
          </div>
        </div>
                        

                            
                            
                        </div>
                     </div>
                 </div>

                	
               
              
				<div class="form-group">
				  <label class="col-sm-4 col-md-2 control-label">Harga Jual</label>
				  <div class="col-sm-5">
					 <input type="text" class="form-control" name="product_selling_price">
				  </div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 col-md-2 control-label">Pajak</label>
					<div class="col-sm-5">
						<select name="product_tax" class="form-control">
							<option value="add_tax">Tambahkan Pajak</option>
							<option value="includ_tax">Termasuk Pajak</option>
							<option value="no_taxes">Tidak Ada Pajak</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 col-md-2 control-label">Lokasi Produksi</label>
						<div class="col-sm-6">
							<select name="production_devices_id" class="form-control">
								<option value="">-- Pilih --</option>
							<?php
							$production_devices	= $this->setting_model->get_production_devices();
							foreach($production_devices as $productiondevice)
							{
							?>
								<option value="<?php echo $productiondevice->production_devices_id;?>"><?php echo $productiondevice->production_devices_name;?></option>
							<?php }?>
							</select>
						</div>
				</div>
				<div class="form-group">
				  <label class="col-sm-4 col-md-2 control-label">Waktu Layanan</label>
				  <div class="col-sm-2">
					 <input type="text" class="form-control" name="product_service_time">
				  <label class="control-label"> Menit</label>
                  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-4 col-md-2 control-label">Gambar</label>
				  <div class="col-sm-6">
					<input type="file" class="form-control" name="userfile">
				  <label class="control-label">Maks. 500 Kb</label>
                  </div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 col-md-2 control-label">Status</label>
					<div class="col-sm-4">
						<select name="product_status" class="form-control">
							<option value="available">Aktif</option>
							<option value="not_available">Tidak Aktif</option>
						</select>
					</div>
				</div>
			  </div><!-- /.box-body -->
			  <div class="box-footer">
				<button type="submit" class="btn btn-success">Simpan</button>
				<a href="<?php echo base_url().'product';?>" class="btn btn-danger pull-right">Batal</a>
			  </div><!-- /.box-footer -->
			<?php echo form_close();?>
			</div><!-- /.box-body -->
			<?php
			}
			elseif($this->session->userdata('division') == 2)
			{
			// Studio
			?>
			<div class="box-body">
			<?php					
				if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
			<?php 
			echo '<span class=text-red>'.validation_errors().'</span>';
			echo form_open_multipart('product/create',['class'=>'form-horizontal']);?>
			  <div class="box-body">
				<div class="form-group">
					<label class="col-sm-4 col-md-2 control-label">Kategori</label>
						<div class="col-sm-6">
							<select name="category_id" class="form-control">
							<?php
							$product_category	= $this->product_model->get_product_category();
							foreach($product_category as $category)
							{
							?>
								<option value="<?php echo $category->category_id;?>"><?php echo $category->product_category_name;?></option>
							<?php }?>
							</select>
						</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 col-md-2 control-label">Sub Kategori</label>
						<div class="col-sm-6">
							<select name="category_id" class="form-control">
							<?php
							$product_category	= $this->product_model->get_sub_category();
							foreach($product_category as $category)
							{
							?>
								<option value="<?php echo $category->category_id;?>"><?php echo $category->product_category_name;?></option>
							<?php }?>
							</select>
						</div>
				</div>
				<div class="form-group">
				  <label class="col-sm-4 col-md-2 control-label">Nama Produk</label>
				  <div class="col-sm-8">
					<input type="text" class="form-control" name="name" placeholder="Nama" value="<?php echo set_value('name');?>">
				  <label class="control-label">Tidak boleh mengandung ' atau "</label>
                  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-4 col-md-2 control-label">Deskripsi</label>
				  <div class="col-sm-8">
					<textarea class="form-control" rows="5" name="description" placeholder="Deskripsi"><?php echo set_value('description');?></textarea>
				  <label class="control-label">Tidak boleh mengandung ' atau "</label>
                  </div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 col-md-2 control-label">CoP</label>
						<div class="col-sm-6">
							<select name="recipe_id" class="form-control">
								<option value="">-- Pilih --</option>
							<?php
							$reseps	= $this->product_model->get_recipe();
							foreach($reseps as $resep)
							{
							?>
								<option value="<?php echo $resep->product_recipe_id;?>"><?php echo $resep->product_recipe_name;?></option>
							<?php }?>
							</select>
						</div>
				</div>
				<div class="form-group">
				  <label class="col-sm-4 col-md-2 control-label">Tambahkan Pajak</label>
				  <div class="col-sm-5">
					 <input type="checkbox" class="minimal" name="tax_added">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Termasuk Pajak</label>
				  <div class="col-xs-5">
					 <input type="checkbox" class="minimal" name="tax_included">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Gambar</label>
				  <div class="col-xs-4">
					<input type="file" class="form-control" name="userfile">
				  </div>
				  <label class="control-label">Maks. 500 Kb</label>
				</div>
			  </div><!-- /.box-body -->
			  <div class="box-footer">
				<a href="<?php echo base_url().'product';?>" class="btn btn-danger">Batal</a>
				
				<button type="submit" class="btn btn-lg btn-success">Simpan</button>
			  </div><!-- /.box-footer -->
			<?php echo form_close();?>
			</div><!-- /.box-body -->
			<?php
			}
			elseif($this->session->userdata('division') == 3)
			{
			// Beuaty
			?>
			<div class="box-body">
			<?php					
				if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
			<?php 
			echo '<span class=text-red>'.validation_errors().'</span>';
			echo form_open_multipart('product/create',['class'=>'form-horizontal']);?>
			  <div class="box-body">
				<div class="form-group">
					<label class="col-sm-4 control-label">Kategori</label>
						<div class="col-xs-3">
							<select name="category_id" class="form-control">
							<?php
							$product_category	= $this->product_model->get_product_category();
							foreach($product_category as $category)
							{
							?>
								<option value="<?php echo $category->category_id;?>"><?php echo $category->product_category_name;?></option>
							<?php }?>
							</select>
						</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Sub Kategori</label>
						<div class="col-xs-3">
							<select name="category_id" class="form-control">
							<?php
							$product_category	= $this->product_model->get_sub_category();
							foreach($product_category as $category)
							{
							?>
								<option value="<?php echo $category->category_id;?>"><?php echo $category->product_category_name;?></option>
							<?php }?>
							</select>
						</div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Nama Produk</label>
				  <div class="col-xs-5">
					<input type="text" class="form-control" name="name" placeholder="Nama" value="<?php echo set_value('name');?>">
				  </div>
				  <label class="control-label">Tidak boleh mengandung ' atau "</label>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Deskripsi</label>
				  <div class="col-xs-5">
					<textarea class="form-control" rows="5" name="description" placeholder="Deskripsi"><?php echo set_value('description');?></textarea>
				  </div>
				  <label class="control-label">Tidak boleh mengandung ' atau "</label>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Resep</label>
						<div class="col-xs-3">
							<select name="recipe_id" class="form-control">
								<option value="">-- Pilih --</option>
							<?php
							$reseps	= $this->product_model->get_recipe();
							foreach($reseps as $resep)
							{
							?>
								<option value="<?php echo $resep->product_recipe_id;?>"><?php echo $resep->product_recipe_name;?></option>
							<?php }?>
							</select>
						</div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Tambahkan Pajak</label>
				  <div class="col-xs-5">
					 <input type="checkbox" class="minimal" name="tax_added">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Termasuk Pajak</label>
				  <div class="col-xs-5">
					 <input type="checkbox" class="minimal" name="tax_included">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Gambar</label>
				  <div class="col-xs-4">
					<input type="file" class="form-control" name="userfile">
				  </div>
				  <label class="control-label">Maks. 500 Kb</label>
				</div>
			  </div><!-- /.box-body -->
			  <div class="box-footer">
			  
				<a href="<?php echo base_url().'product';?>" class="btn btn-danger">Baatal</a>
				<button type="submit" class="btn btn-success">Simpan</button>
			  </div><!-- /.box-footer -->
			<?php echo form_close();?>
			</div><!-- /.box-body -->
			<?php	
			}
			?>
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->