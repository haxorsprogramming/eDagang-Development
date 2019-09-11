<?php
//print_r($materials);
	foreach($materials as $material)
	{
		$material_id		= $material->material_id;
		if ($this->input->post('is_submitted'))
		{
			$material_name	= set_value('material_name');
		}
		else
		{
			$material_name						= $material->material_name;
			$material_standard_stock			= $material->material_standard_stock;
			$material_unit_id					= $material->material_unit_id;
			$satuan_beli						= $material->satuan_beli;
			$konversi							= $material->konversi;
			$jstok								= $material->material_type;
			$kategori_material					= $material->kategori_material;
			$material_purchase_price			= $material->material_purchase_price;
			$material_purchase_unit				= $material->material_purchase_unit;
            $fa=$material->finance_account_id;
            $kodem=$controller->kode_material($jstok,$material_id);
		}
		$unitsitem	= $this->material_model->get_unit_by_unit_id($material_unit_id);
		foreach($unitsitem AS $unititem)
		{
			$material_unit_name	= $unititem->material_unit_name;
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
				echo form_open('material/edit/' . $material_id,['class'=>'form-horizontal']);?>
                  <div class="box-body">
                   <div class="form-group">
                      <label class="col-sm-6 col-md-2 control-label">Kode Material</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control"  value="<?php echo $kodem;?>" readonly="readonly">
                      </div>
                    </div>
                  <div class="form-group">
                      <label class="col-sm-6 col-md-2 control-label">Kategori </label>
                      <div class="col-sm-6">
                        <select name="kategori_material" class="form-control">
                        <option value="">-Pilih-</option>
						<?php
						$km = $this->material_model->kategori_material();
						foreach ($km AS $dkm)
						{
						?>
							<option value="<?php echo $dkm->id_km;?>" <? if($kategori_material==$dkm->id_km){ echo "selected";} ?>><?php echo $dkm->nama_km;?></option>
						<?php }?>
						</select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-6 col-md-2 control-label">Nama Material</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="material_name" placeholder="Nama Material" value="<?php echo $material_name;?>" autofocus>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-6 col-md-2 control-label">Satuan CoP</label>
                      <div class="col-sm-6">
                        <select name="material_unit_id" class="form-control">
							
							<?php
							$units	= $this->material_model->get_units();
							foreach($units AS $unit)
							{?>
								<option value="<?php echo $unit->material_unit_id;?>" <?php if($material_unit_id==$unit->material_unit_id){echo "selected";}?>><?php echo $unit->material_unit_name;?></option>
							<?php }
							?>
						</select>
                      </div>
                    </div>
                    <div class="form-group">
					  <label class="col-sm-6 col-md-2 control-label">Satuan Beli </label>
					  <div class="col-sm-6">
						<select name="satuan_beli" class="form-control">
						<?php
						$units = $this->material_model->get_units();
						foreach ($units AS $unit)
						{
						?>
							<option value="<?php echo $unit->material_unit_id;?>" <?php if($satuan_beli==$unit->material_unit_id){echo "selected";}?>><?php echo $unit->material_unit_name;?></option>
						<?php }?>
						</select>
					  </div>
					</div>
                    <div class="form-group">
                      <label class="col-sm-6 col-md-2 control-label">Konversi</label>
                      <div class="col-sm-6">
                        <input type="number" style="text-align:right" class="form-control" name="konversi" placeholder="Konversi" value="<?php echo $konversi;?>" autofocus>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-6 col-md-2 control-label">Harga Pembelian (Satuan)</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" name="material_purchase_price" placeholder="Harga Pembelian (Satuan)" value="<?php echo $material_purchase_price;?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-6 col-md-2 control-label">Jumlah Pembelian (Satuan)</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="material_purchase_unit" placeholder="Jumlah Pembelian (Satuan)" value="<?php echo $material_purchase_unit;?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-6 col-md-2 control-label">Standar Stock</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" name="material_standard_stock" placeholder="Standart Stock" value="<?php echo $material_standard_stock;?>">
                      </div>
                    </div>
                     <div class="form-group">
						<label class="col-sm-6 col-md-2 control-label">Jenis Material </label>
						<div class="col-sm-6">
						<select name="jstok" class="form-control">
                        <option value="">-Silahkan Pilih-</option>
							<?php
							$jst	= $this->material_model->jstok();
							foreach($jst AS $js)
							{
							?>
							<option value="<?php echo $js->kode_jstok;?>" <?php if($jstok==$js->kode_jstok){echo "selected";}?>><?php echo $js->nama_jstok;?></option>
							<?php }?>
						</select>
						</div>
					</div>
                    <!--div class="form-group">
						<label class="col-sm-2 control-label">Akun Kas</label>
						<div class="col-xs-3">
						<select name="material_account_id" class="form-control">
                        <option value="">-Silahkan Pilih-</option>
							<?php
							$finance_accounts	= $this->custom_model->get_finance_account_for_material();
							foreach($finance_accounts AS $financeaccount)
							{
							?>
							<option value="<?php echo $financeaccount->finance_account_id;?>" <?php if($financeaccount->finance_account_id==$fa){echo "selected";}?>><?php echo $financeaccount->finance_account_name;?></option>
							<?php }?>
						</select>
						</div>
					</div-->
				  </div><!-- /.box-body -->
                  <div class="box-footer">
					<input type="hidden" name="is_submitted" value="1">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?=base_url().'material'?>" class="btn btn-danger pull-right">Batal</a>
                  </div><!-- /.box-footer -->
               <?php echo form_close();?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			</div><!-- /.col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->