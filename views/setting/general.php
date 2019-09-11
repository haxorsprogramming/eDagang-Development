	<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
			<?php
			if ($this->session->flashdata('message_error'))
				echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
			elseif ($this->session->flashdata('message_success'))
				echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
			foreach($settings as $setting)
			{
			echo form_open_multipart('setting/general_update',['class'=>'form-horizontal']);
			?>
			<div class="row">
				<div class="col-xs-12">
				  <div class="box box-solid box-info">
					<div class="box-header with-border">
					  <h3 class="box-title"><?php echo $company_title;?></h3>
					</div><!-- /.box-header -->
					<div class="box-body">
					<div class="form-horizontal">
					  <div class="box-body">
						<div class="form-group">
							<label class="col-sm-3 control-label">Nama Perusahaan</label>
						  <div class="col-xs-3">
							<input type="text" name="company_name" class="form-control" value="<?php echo $setting->company_name;?>">
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-sm-3 control-label">Alamat</label>
						  <div class="col-xs-6">
							<input type="text" name="company_address" class="form-control" value="<?php echo $setting->company_address;?>">
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-sm-3 control-label">Telepon</label>
						  <div class="col-xs-2">
							<input type="text" name="company_telp" class="form-control" value="<?php echo $setting->company_telp;?>">
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-sm-3 control-label">Email</label>
						  <div class="col-xs-3">
							<input type="text" name="company_email" class="form-control" value="<?php echo $setting->company_email;?>">
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-sm-3 control-label">Logo</label>
						  <div class="col-xs-5">
						    <?php
							if($setting->company_logo == TRUE)
							{
							?>
							<img src="<?php echo base_url();?>/assets/img/<?=$setting->company_logo?>" class="col-xs-6">
							<?php }?>
						  </div>
						  <label class="col-sm-2 control-label">Maks. 1 MB</label>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"></label>
							<div class="col-xs-5">
								<input type="file" class="col-xs-5" name="userfile">
							</div>
						  </div>
					  </div><!-- /.box-body -->
					</div>
					</div><!-- /.box-body -->
				  </div><!-- /.box -->
				</div><!-- /.col -->
			</div><!-- /.row -->

			<div class="row">
				<div class="col-xs-12">
				  <div class="box box-solid box-info">
					<div class="box-header with-border">
					  <h3 class="box-title"><?php echo $receipt_title;?></h3>
					</div><!-- /.box-header -->
					<div class="box-body">
					<div class="form-horizontal">
					  <div class="box-body">
						<div class="form-group">
							<label class="col-sm-3 control-label">Header</label>
						  <div class="col-xs-3">
							<input type="text" name="receipt_header" class="form-control" value="<?php echo $setting->receipt_header;?>">
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-sm-3 control-label">Footer</label>
						  <div class="col-xs-5">
							<input type="text" name="receipt_footer" class="form-control" value="<?php echo $setting->receipt_footer;?>">
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-sm-3 control-label">Promo</label>
						  <div class="col-xs-5">
							<input type="text" name="receipt_promo" class="form-control" value="<?php echo $setting->receipt_promo;?>">
						  </div>
						</div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Format Print</label>
              <div class="col-xs-5">
                <select class="form-control select" name="receipt_print_format" id='receipt_print_format'>
                  <option value="general">General/Umum</option>
                  <option value="detail">Detail</option>
                </select>
              </div>
            </div>
            <script type="text/javascript">
              $('#receipt_print_format').val('<?php echo $setting->receipt_print_format?>');
            </script>
						<div class="form-group">
						  <label class="col-sm-3 control-label">Maksimal Print Receipt</label>
						  <div class="col-xs-2">
							<select name="receipt_max_print" class="form-control">
								<option value="<?php echo $setting->receipt_max_print;?>"><?php echo $setting->receipt_max_print;?></option>
								<?php
								for($i=0;$i<=10;$i++)
								{
								?>
								<option value="<?php echo $i;?>"><?php echo $i;?></option>
								<?php
								}
								?>
							</select>
						  </div>
						</div>
						<label class="control-label">Tidak boleh mengandung karakter ' atau "</label>
					  </div><!-- /.box-body -->
					</div>
					</div><!-- /.box-body -->
				  </div><!-- /.box -->
				</div><!-- /.col -->
			</div><!-- /.row -->

			<div class="row">
			<div class="col-xs-12">
			  <div class="box box-solid box-info">
				<div class="box-header with-border">
				  <h3 class="box-title"><?php echo $finance_title;?></h3>
				</div><!-- /.box-header -->
				<div class="box-body">
				<div class="form-horizontal">
				  <div class="box-body">
					<div class="form-group">
						<label class="col-sm-3 control-label">Akun Belanja Harian</label>
					  <div class="col-xs-5">
						<select name="finance_account_daily" class="form-control select2">
							<?php
							$accountsdaily	= $this->finance_model->get_account_by_account_id($setting->finance_account_daily);
							foreach($accountsdaily AS $accountdaily)
							{
							?>
							<option value="<?php echo $accountdaily->finance_account_id;?>"><?php echo $accountdaily->finance_account_code;?> <?php echo $accountdaily->finance_account_name;?></option>
							<?php
							}
							$financeaccounts	= $this->finance_model->get_account();
							foreach($financeaccounts AS $financeaccount)
							{
							?>
							<option value="<?php echo $financeaccount->finance_account_id;?>"><?php echo $financeaccount->finance_account_code;?> <?php echo $financeaccount->finance_account_name;?></option>
							<?php }?>
						</select>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-3 control-label">Akun Belanja Bulanan</label>
					  <div class="col-xs-5">
						<select name="finance_account_monthly" class="form-control select2">
							<?php
							$accountsmonthly	= $this->finance_model->get_account_by_account_id($setting->finance_account_monthly);
							foreach($accountsmonthly AS $accountmonthly)
							{
							?>
							<option value="<?php echo $accountmonthly->finance_account_id;?>"><?php echo $accountmonthly->finance_account_code;?> <?php echo $accountmonthly->finance_account_name;?></option>
							<?php
							}
							$financeaccounts	= $this->finance_model->get_account();
							foreach($financeaccounts AS $financeaccount)
							{
							?>
							<option value="<?php echo $financeaccount->finance_account_id;?>"><?php echo $financeaccount->finance_account_code;?> <?php echo $financeaccount->finance_account_name;?></option>
							<?php }?>
						</select>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-3 control-label">Akun Penjualan</label>
					  <div class="col-xs-5">
						<select name="finance_account_sales" class="form-control select2">
							<?php
							$accountsprofit	= $this->finance_model->get_account_by_account_id($setting->finance_account_sales);
							foreach($accountsprofit AS $accountprofit)
							{
							?>
							<option value="<?php echo $accountprofit->finance_account_id;?>"><?php echo $accountprofit->finance_account_code;?> <?php echo $accountprofit->finance_account_name;?></option>
							<?php
							}
							$financeaccounts	= $this->finance_model->get_account();
							foreach($financeaccounts AS $financeaccount)
							{
							?>
							<option value="<?php echo $financeaccount->finance_account_id;?>"><?php echo $financeaccount->finance_account_code;?> <?php echo $financeaccount->finance_account_name;?></option>
							<?php }?>
						</select>
					  </div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Tarif Pajak</label>
						  <div class="col-xs-2">
							<select name="tax_fare" class="form-control select2">
								<option value="<?php echo $setting->tax_fare;?>"><?php echo $setting->tax_fare;?></option>
								<?php
								for($tax=1;$tax<=100;$tax++)
								{
								?>
								<option value="<?php echo $tax;?>"><?php echo $tax;?></option>
								<?php }?>
							</select>
						  </div>
						<label class="control-label"> %</label>
					</div>
					<div class="form-group">
					  <label class="col-sm-3 control-label">Tarif Service</label>
					  <div class="col-xs-2">
							<select name="service_fare" class="form-control select2">
								<option value="<?php echo $setting->service_fare;?>"><?php echo $setting->service_fare;?></option>
								<?php
								for($service=1;$service<=100;$service++)
								{
								?>
								<option value="<?php echo $service;?>"><?php echo $service;?></option>
								<?php }?>
							</select>
					  </div>
						<label class="control-label"> %</label>
					</div>
				  </div><!-- /.box-body -->
				</div>
				</div><!-- /.box-body -->
			  </div><!-- /.box -->
			</div><!-- /.col -->
		</div><!-- /.row -->

			<div class="row">
				<div class="col-xs-12">
				  <div class="box box-solid box-info">
					<div class="box-header with-border">
					  <h3 class="box-title"><?php echo $misc_title;?></h3>
					</div><!-- /.box-header -->
					<div class="box-body">
					<div class="form-horizontal">
					  <div class="box-body">
						<div class="form-group">
						  <label class="col-sm-3 control-label">Maksimal Discount Manual</label>
						  <div class="col-xs-1">
							<input type="text" name="discount_manual_max" class="form-control" value="<?php echo $setting->discount_manual_max;?>">
						  </div>
						  <label class="control-label"> %</label>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Upah Lembur Per Jam</label>
						  <div class="col-xs-2">
							<input type="text" name="overtime_fare_per_hour" class="form-control" value="<?php echo $setting->overtime_fare_per_hour;?>">
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-sm-3 control-label">Potongan Keterlambatan Per Menit</label>
						  <div class="col-xs-2">
							<input type="text" name="late_fare_per_minute" class="form-control" value="<?php echo $setting->late_fare_per_minute;?>">
						  </div>
						</div>
					  </div><!-- /.box-body -->
					</div>
					</div><!-- /.box-body -->
				  </div><!-- /.box -->
				</div><!-- /.col -->
			</div><!-- /.row -->

			<div class="box box-solid box-info">
				<div class="box-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<a href="<?php echo base_url();?>setting" class="btn btn-danger pull-right">Batal</a>
				</div>
			</div>

			<?php
			echo form_close();
			}?>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
