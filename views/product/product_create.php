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
			echo form_open_multipart('product/create',['class'=>'form-horizontal']);?>
			  <div class="box-body box-default>
				<div class="form-group">
					<label class="col-sm-2 control-label">Kategori</label>
					<div class="col-xs-3">
						<select name="category_id" class="form-control select2" autofocus>
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
						<div class="col-xs-5">
							<select name="sub_category_id" class="form-control select2">
							<?php
							$product_sub_category	= $this->product_model->get_sub_category();
							foreach($product_sub_category as $sub_category)
							{
							?>
								<option value="<?php echo $sub_category->category_id;?>"><?php echo $sub_category->product_category_name;?></option>
							<?php }?>
							</select>
						</div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Nama Produk</label>
				  <div class="col-xs-5">
					<input type="text" class="form-control" name="product_name" placeholder="Nama Produk" value="<?php echo set_value('product_name');?>">
				  </div>
				  <label class="control-label">Tidak boleh mengandung ' atau "</label>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Deskripsi</label>
				  <div class="col-xs-7">
				  <input type="text" class="form-control" name="product_description" placeholder="Deskripsi" value="<?php echo set_value('product_description');?>">
				  </div>
				  <label class="control-label">Tidak boleh mengandung ' atau "</label>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Resep</label>
						<div class="col-xs-5">
							<select name="product_recipe_id" class="form-control select2">
								<option value="">-- Pilih --</option>
							<?php
							$loss_percent_on_product	= $this->session->userdata('loss_percent_on_product');
							$reseps	= $this->product_model->get_recipe();
							foreach($reseps as $resep)
							{
								$allmaterial	= $this->product_model->get_product_recipe_by_product_recipe_id($resep->product_recipe_id);
								foreach($allmaterial AS $material)
								{
									$product_recipe_prices	= $this->product_model->get_product_recipe_price_by_product_recipe_id($resep->product_recipe_id,$resep->product_recipe_loss_cost_percent);
									foreach($product_recipe_prices AS $product_recipe_price)
									{
										$product_recipe_total			= $product_recipe_price->product_recipe_total;
										$product_recipe_estimated_loss	= $product_recipe_price->product_recipe_estimated_loss;
										$product_recipe_grand_total		= $product_recipe_price->product_recipe_grand_total;
									}
								}
								if($product_recipe_grand_total > 0)
								{
									$price_purchase		= ceil($product_recipe_grand_total);
								}
								else
								{
									$price_purchase		= '0';
								}
							?>
								<option value="<?php echo $resep->product_recipe_id;?>"><?php echo $resep->product_recipe_name;?> => <?php echo $price_purchase;?></option>
							<?php }?>
							</select>
						</div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Harga Jual</label>
				  <div class="col-xs-2">
					 <input type="text" class="form-control" name="product_selling_price">
				  </div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Pajak</label>
					<div class="col-xs-3">
						<select name="product_tax" class="form-control">
							<option value="add_tax" >Tambahkan Pajak</option>
							<option value="include_tax" >Termasuk Pajak</option>
							<option value="no_taxes" >Tidak Ada Pajak</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Perangkat Produksi</label>
						<div class="col-xs-3">
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
				  <label class="col-sm-2 control-label">Waktu Layanan</label>
				  <div class="col-xs-1">
					 <input type="text" class="form-control" name="product_service_time">
				  </div>
				  <label class="control-label"> Menit</label>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Gambar</label>
				  <div class="col-xs-4">
					<input type="file" class="form-control" name="userfile">
				  </div>
				  <label class="control-label">Maks. 500 Kb</label>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Status</label>
					<div class="col-xs-2">
						<select name="product_status" class="form-control">
							<option value="available">Aktif</option>
							<option value="not_available">Tidak Aktif</option>
						</select>
					</div>
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
				<a href="<?php echo base_url().'product';?>" class="btn btn-danger">Batal</a>
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