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
<?
foreach($products as $prs){
	$product_id				= $prs->product_id;
	$category_id			= $prs->category_id;
	$sub_category_id		= $prs->sub_category_id;
	$product_name			= $prs->product_name;
	$product_description	= $prs->product_description;
	$product_recipe_id		= $prs->product_recipe_id;
	$product_selling_price	= $prs->product_selling_price;
	$product_tax			= $prs->product_tax;
	$production_devices_id	= $prs->product_production_devices_id;
	$product_service_time	= $prs->product_service_time;
	$product_status			= $prs->product_available;
}
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Main content -->
	<section class="content">

	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-success">
			<?php
			//print_r($products);

			if($this->session->userdata('division') == 1 or $this->session->userdata('division') == 2 or $this->session->userdata('division') == 3)
			{
			// Divisi Resto
			?>
			<div class="box-body">
			<?php
				if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
			<?php
			echo '<span class=text-red>'.validation_errors().'</span>';
			echo form_open_multipart('product/edit/'.$product_id,['class'=>'form-horizontal']);?>
			  <div class="box-body">
				<div class="form-group">
					<label class="col-sm-4 col-md-2 control-label">Kategori </label>
					<div class="col-sm-6">
                    	<?
						//print_r($gp);
						 $group_id = $this->session->userdata('group_id');
                        if ($group_id =='14'){
                            $product_category	= $this->product_model->get_product_category3();
                        }elseif($group_id =='16'){
                             $product_category	= $this->product_model->get_product_category2();
                        }else{
                            $product_category	= $this->product_model->get_product_category();
                        }
						//print_r($product_category);
                        ?>
						<select name="category_id" class="form-control select2" autofocus >
						<?php
						$product_paketid=0;

						foreach($gp as $dgp){
							$product_paketid=$dgp->product_paketid;
						}


						foreach($product_category as $category)
						{
						?>
							<option value="<?php echo $category->category_id;?>#<?php echo $category->product_category_name;?>" <? if($category_id==$category->category_id){ echo "selected";} ?>><?php echo $category->product_category_name;?></option>
						<?php }?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 col-md-2 control-label">Sub Kategori</label>
						<div class="col-sm-6">
							<select name="sub_category_id" class="form-control select2">
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
								<option value="<?php echo $sub_category->category_id;?>" <? if($sub_category_id==$sub_category->category_id){ echo "selected";} ?>><?php echo $sub_category->product_category_name;?></option>
							<?php }?>
							</select>
						</div>
				</div>
				<div class="form-group">
				  <label class="col-sm-4 col-md-2 control-label">Nama Produk</label>
				  <div class="col-sm-8">
					<input type="text" class="form-control" name="product_name" placeholder="Nama Produk" value="<?php echo $product_name;?>">
				  <label class="control-label">Tidak boleh mengandung ' atau "</label>
                  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-4 col-md-2 control-label">Deskripsi</label>
				  <div class="col-sm-8">
				  <input type="text" class="form-control" name="product_description" placeholder="Deskripsi" value="<?php echo $product_description;?>">
				  <label class="control-label">Tidak boleh mengandung ' atau "</label>
                  </div>
				</div>
				<div class="form-group">
                <?
				if($product_paketid==0){
                ?>
					<label class="col-sm-4 col-md-2 control-label">CoP</label>
                    <?
				}else{
					?>
                    <label class="col-sm-4 col-md-2 control-label">Produk</label>
                    <?
				}
                    ?>
						<div class="col-sm-8">
                        <?
						if($product_paketid==0){
                        ?>
								<div id="divproduct">
								<select name="product_recipe_id[]" class="form-control">
								<?php
								foreach($reseps as $resep)
                                        {

                                        ?>
                                            <option value="<?php echo $resep->product_recipe_id;?>" <? if($product_recipe_id==$resep->product_recipe_id){ echo "selected";} ?>><?php echo $resep->product_recipe_name;?> => <?php echo $resep->product_recipe_grand_total;?></option>
                                        <?php }?>
								</select>
                                </div>
                         <?
						}else{
							?>
                   <div class="input-group control-group after-add-more">
			<?
			$kon=0;
			foreach($gp as $dgp){
				if($kon==0){
            ?>
			<table class="table " style="width:100%" >

                    <div id="education_fields" style="width:100%" >
					<tr>
						<td>
							<div class="col-xs-12">
                            	<div id="divproduct">
								<select name="product_recipe_id[]" class="form-control" style="width:100%">
								<?php
								foreach($resepspaket as $reseppaket)
                                        {

                                        ?>
                                            <option value="<?php echo $reseppaket->product_id;?>" <? if($reseppaket->product_id==$dgp->product_id){ echo "selected";} ?> ><?php echo $reseppaket->product_name;?> => <?php echo $reseppaket->product_selling_price;?></option>
                                        <?php }?>
								</select>
                                </div>
							</div>
						</td>

					</tr>

                    </div>
				</table>
			   <!--<input type="text" name="addmore[]" class="form-control" placeholder="Enter Name Here">-->
					  <div class="input-group-btn"  id="addcat">
						<button class="btn btn-success add-more"  type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
					  </div>
                      </div>
                      <?
				}else{
					?>
                           <!-- Copy Fields-These are the fields which we get through jquery and then add after the above input,-->
        <div class="copy-fields">
          <div class="control-group input-group" style="margin-top:10px">
           <!-- <input type="text" name="addmore[]" class="form-control" placeholder="Enter Name Here">-->
           <table class="table ">

                    <div id="education_fields">
					<tr>
						<td>
							<div class="col-xs-12">
                            <div id="divproductother">
								<select name="product_recipe_id[]" class="form-control" style="width:100%">
								<?php
								foreach($resepspaket as $reseppaket)
                                        {

                                        ?>
                                            <option value="<?php echo $reseppaket->product_id;?>" <? if($reseppaket->product_id==$dgp->product_id){ echo "selected";} ?> ><?php echo $reseppaket->product_name;?> => <?php echo $reseppaket->product_selling_price;?></option>
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
                    <?
				}
					  $kon++;
			}
                      ?>

                            <?
						}
                                ?>

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
								<select name="product_recipe_id[]" class="form-control" style="width:100%">
								<?php
								foreach($resepspaket as $reseppaket)
                                        {

                                        ?>
                                            <option value="<?php echo $reseppaket->product_id;?>"><?php echo $reseppaket->product_name;?> => <?php echo $reseppaket->product_selling_price;?></option>
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
				<div class="form-group">
				  <label class="col-sm-4 col-md-2 control-label">Harga Jual</label>
				  <div class="col-sm-4">
					 <input type="text" class="form-control" name="product_selling_price" value="<?=$product_selling_price?>">
				  </div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 col-md-2 control-label">Pajak </label>
					<div class="col-sm-6">
						<select name="product_tax" class="form-control">
							<option value="add_tax" <? if($product_tax=="add_tax"){echo "selected";}?>>Tambahkan Pajak</option>
							<option value="includ_tax" <? if($product_tax=="include_tax" ){echo "selected";}?>>Termasuk Pajak</option>
							<option value="no_taxes" <? if($product_tax=="no_taxes"){echo "selected";}?>>Tidak Ada Pajak</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 col-md-2 control-label">Lokasi Produksi</label>
						<div class="col-sm-6">
							<select name="production_devices_id" class="form-control">

							<?php
							$production_devices	= $this->setting_model->get_production_devices();
							foreach($production_devices as $productiondevice)
							{
							?>
								<option value="<?php echo $productiondevice->production_devices_id;?>" <? if($production_devices_id==$productiondevice->production_devices_id){ echo "selected";} ?>><?php echo $productiondevice->production_devices_name;?></option>
							<?php }?>
							</select>
						</div>
				</div>
				<div class="form-group">
				  <label class="col-sm-4 col-md-2 control-label">Standar Layanan</label>
				  <div class="col-sm-3">
					 <input type="text" class="form-control" name="product_service_time" value="<?=$product_service_time?>">
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
							<option value="available" <? if($product_status=='available'){echo "selected";}?>>Aktif</option>
							<option value="not_available" <? if($product_status=='not_available'){echo "selected";}?>>Tidak Aktif</option>
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
			elseif($this->session->userdata('division') == 22)
			{
			// Studio
			?>
			<div class="box-body">
			<?php
				if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
			<?php
			echo '<span class=text-red>'.validation_errors().'</span>';
			echo form_open_multipart('product/edit',['class'=>'form-horizontal']);?>
			  <div class="box-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">Kategori</label>
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
				<button type="submit" class="btn btn-lg btn-success">Simpan</button>
				<a href="<?php echo base_url().'product';?>" class="btn btn-danger pull-right">Batal</a>
			  </div><!-- /.box-footer -->
			<?php echo form_close();?>
			</div><!-- /.box-body -->
			<?php
			}
			elseif($this->session->userdata('division') == 32)
			{
			// Beuaty
			?>
			<div class="box-body">
			<?php
				if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
			<?php
			echo '<span class=text-red>'.validation_errors().'</span>';
			echo form_open_multipart('product/edit',['class'=>'form-horizontal']);?>
			  <div class="box-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">Kategori</label>
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
				<button type="submit" class="btn btn-lg btn-success">Simpan</button>
				<a href="<?php echo base_url().'product';?>" class="btn btn-danger pull-right">Batal</a>
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
