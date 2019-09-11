	<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title;?>
            <small><?php echo $sub_title;?></small>
          </h1>
          <!--ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $title;?></a></li>
            <li class="active"><?php echo $sub_title;?></li>
          </ol-->
        </section>

        <!-- Main content -->
        <section class="content">
			<?php
			if ($this->session->flashdata('message_error'))
				echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
			elseif ($this->session->flashdata('message_success'))
				echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
			foreach($settings as $setting)
			{
			echo form_open_multipart('setting/edit',['class'=>'form-horizontal']);
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
					  <h3 class="box-title"><?php echo $discount_title;?></h3>
					</div><!-- /.box-header -->
					<div class="box-body">
					<div class="form-horizontal">
					  <div class="box-body">
						<div class="form-group">
							<label class="col-sm-3 control-label">Discount Type</label>
						  <div class="col-xs-2">
							<select name="discount_type" class="form-control">
								<option value="<?php echo $setting->discount_type;?>"><?php echo $setting->discount_type;?></option>
								<option value="all">All</option>
								<option value="normal">Normal</option>
							</select>
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-sm-3 control-label">Discount</label>
						  <div class="col-xs-2">
							<input type="text" name="discount_value" class="form-control" value="<?php echo $setting->discount_value;?>">
						  </div>
						  <label class="control-label"> %</label>
						</div>
						<div class="form-group">
						  <label class="col-sm-3 control-label">Discount Member</label>
						  <div class="col-xs-2">
							<input type="text" name="discount_member" class="form-control" value="<?php echo $setting->discount_member;?>">
						  </div>
						  <label class="control-label"> %</label>
						</div>
						<div class="form-group">
						  <label class="col-sm-3 control-label">Maksimal Discount Manual</label>
						  <div class="col-xs-2">
							<input type="text" name="discount_manual_max" class="form-control" value="<?php echo $setting->discount_manual_max;?>">
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
					  <h3 class="box-title"><?php echo $misc_title;?></h3>
					</div><!-- /.box-header -->
					<div class="box-body">
					<div class="form-horizontal">
					  <div class="box-body">
						<div class="form-group">
							<label class="col-sm-3 control-label">Tarif Pajak</label>
						  <div class="col-xs-2">
							<input type="text" name="tax_fare" class="form-control" value="<?php echo $setting->tax_fare;?>">
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-sm-3 control-label">Tarif Service</label>
						  <div class="col-xs-2">
							<input type="text" name="service_fare" class="form-control" value="<?php echo $setting->service_fare;?>">
						  </div>
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
					<a href="<?=base_url()?>setting" class="btn btn-danger pull-right">Batal</a>
				</div>
			</div>
			
			<?php 
			echo form_close();
			}?>
			
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->