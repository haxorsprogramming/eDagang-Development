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
					if ($this->session->flashdata('message_error'))
						echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
					elseif ($this->session->flashdata('message_success'))
						echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
				?>
                <!-- form start -->
				<?php 
				echo '<label class="text text-red">'.validation_errors().'</label>';
				echo form_open_multipart('material/create',['class'=>'form-horizontal']);?>
                  <div class="box-body">
                  <div class="form-group">
					  <label class="col-sm-6 col-md-2 control-label">Kategori</label>
					  <div class="col-sm-6">
						<select name="kategori_material" class="form-control">
                        <option value="">-Pilih-</option>
						<?php
						$km = $this->material_model->kategori_material();
						foreach ($km AS $dkm)
						{
						?>
							<option value="<?php echo $dkm->id_km;?>"><?php echo $dkm->nama_km;?></option>
						<?php }?>
						</select>
					  </div>
					</div>
                    <div class="form-group">
                      <label class="col-sm-6 col-md-2 control-label">Nama Material</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="material_name" placeholder="Nama Material" value="<?php echo set_value('material_name');?>" autofocus>
                      </div>
                    </div>
					<div class="form-group">
					  <label class="col-sm-6 col-md-2 control-label">Satuan Gramasi</label>
					  <div class="col-sm-6">
						<select name="material_unit_id" class="form-control">
						<?php
						$units = $this->material_model->get_units();
						foreach ($units AS $unit)
						{
						?>
							<option value="<?php echo $unit->material_unit_id;?>"><?php echo $unit->material_unit_name;?></option>
						<?php }?>
						</select>
					  </div>
					</div>
                    <div class="form-group">
					  <label class="col-sm-6 col-md-2 control-label">Satuan Beli</label>
					  <div class="col-sm-6">
						<select name="satuan_beli" class="form-control">
						<?php
						$units = $this->material_model->get_units();
						foreach ($units AS $unit)
						{
						?>
							<option value="<?php echo $unit->material_unit_id;?>"><?php echo $unit->material_unit_name;?></option>
						<?php }?>
						</select>
					  </div>
					</div>
                    <div class="form-group">
                      <label class="col-sm-6 col-md-2 control-label">Nilai Konversi</label>
                      <div class="col-sm-6">
                        <input type="number" class="form-control" name="konversi" placeholder="Konversi" value="<?php echo set_value('konversi');?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-6 col-md-2 control-label">Harga Pembelian (Satuan)</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="material_purchase_price" placeholder="Harga Pembelian (Satuan)" value="<?php echo set_value('material_purchase_price');?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-6 col-md-2 control-label">Jumlah Pembelian (Satuan)</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="material_purchase_unit" placeholder="Jumlah Pembelian (Satuan)" value="<?php echo set_value('material_purchase_unit');?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-6 col-md-2 control-label">Standar Stock</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" name="material_standard_stock" placeholder="Standart Stock" value="<?php echo set_value('material_standard_stock');?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-6 col-md-2 control-label">Batas Bawah Stock</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" name="material_bottom_line_stock" placeholder="Batas Bawah Stock" value="<?php echo set_value('material_bottom_line_stock');?>">
                      </div>
                    </div>
					<!--div class="form-group">
						<label class="col-sm-6 col-md-2 control-label">Akun Kas</label>
						<div class="col-sm-6">
						<select name="material_account_id" class="form-control">
                        <option value="">-Silahkan Pilih-</option>
							<?php
							$finance_accounts	= $this->custom_model->get_finance_account_for_material();
							foreach($finance_accounts AS $financeaccount)
							{
							?>
							<option value="<?php echo $financeaccount->finance_account_id;?>"><?php echo $financeaccount->finance_account_name;?></option>
							<?php }?>
						</select>
						</div>
					</div-->

						<div class="form-group">
						<label class="col-sm-6 col-md-2 control-label">Jenis Material</label>
						<div class="col-sm-5">
						<select name="jstok" class="form-control">
                        <option value="">-Silahkan Pilih-</option>
							<?php
							$jst	= $this->material_model->jstok();
							foreach($jst AS $js)
							{
							?>
							<option value="<?php echo $js->kode_jstok;?>"><?php echo $js->nama_jstok;?></option>
							<?php }?>
						</select>
						</div>
					</div>
				  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?=base_url()?>material" class="btn btn-danger pull-right">Batal</a>
                  </div><!-- /.box-footer -->
               <?php echo form_close();?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			</div><!-- /.col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->