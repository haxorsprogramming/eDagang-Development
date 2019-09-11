<?php
	foreach($productiondevices as $productiondevice)
	{
		$production_devices_id			= $productiondevice->production_devices_id;
		if ($this->input->post('is_submitted'))
		{
			$production_devices_type		= $this->input->post('production_devices_type');
			$production_devices_name		= set_value('production_devices_name');
			$production_devices_ip_address	= set_value('production_devices_ip_address');
		}
		else
		{
			$production_devices_type		= $productiondevice->production_devices_type;
			$production_devices_name		= $productiondevice->production_devices_name;
			$production_devices_ip_address	= $productiondevice->production_devices_ip_address;

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
                <div class="box-header with-border">
                  <h3 class="box-title"><?=$sub_title?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				<?php
					if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
                <!-- form start -->
				<?php
				echo '<span class=text-red>'.validation_errors().'</span>';
				echo form_open_multipart('setting/production_devices_edit/' . $production_devices_id,['class'=>'form-horizontal']);?>
                  <div class="box-body">
					<div class="form-group">
						<label class="col-sm-3 control-label">Type</label>
							<div class="col-xs-3">
								<select name="production_devices_type" class="form-control">
									<option value="<?php echo $production_devices_type;?>"><?php
									if($productiondevice->production_devices_type == '1')
									{
										echo 'Printer';
									}
									elseif($productiondevice->production_devices_type == '2')
									{
										echo 'PC';
									}
									elseif($productiondevice->production_devices_type == '3')
									{
										echo 'FingerPrint';
									}
									;?></option>
									<option value="1">Printer</option>
									<option value="2">PC</option>
									<option value="3">FingerPrint</option>
								</select>
							</div>
					</div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Nama Perangkat</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" name="production_devices_name" placeholder="Nama Perangkat" value="<?php echo $production_devices_name;?>">
                      </div>
					  <label class="control-label">Tidak boleh mengandung ' atau "</label>
                    </div>
					<div class="form-group">
                      <label class="col-sm-3 control-label">IP Address (v4)</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" name="production_devices_ip_address" placeholder="(Contoh : 192.168.1.7)" value="<?php echo $production_devices_ip_address;?>">
                      </div>
                    </div>
				  </div><!-- /.box-body -->
                  <div class="box-footer">
					<input type="hidden" name="is_submitted" value="1">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?=base_url().'setting/production_devices'?>" class="btn btn-danger pull-right">Batal</a>
                  </div><!-- /.box-footer -->
               <?php echo form_close();?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			</div><!-- /.col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  <!-- page script rent_car_history-->
