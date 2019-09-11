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
		foreach($settings as $setting)
		{
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
						<input type="text" class="form-control" value="<?php echo $setting->company_name;?>" disabled>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-3 control-label">Alamat</label>
					  <div class="col-xs-6">
						<input type="text" class="form-control" value="<?php echo $setting->company_address;?>" disabled>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-3 control-label">Telepon</label>
					  <div class="col-xs-6">
						<input type="text" class="form-control" value="<?php echo $setting->company_telp;?>" disabled>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-3 control-label">Email</label>
					  <div class="col-xs-6">
						<input type="text" class="form-control" value="<?php echo $setting->company_email;?>" disabled>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-3 control-label">Logo</label>
					  <div class="col-xs-6">
						<?php
						if($setting->company_logo == TRUE)
						{
						?>
						<img src="<?php echo base_url();?>/assets/img/<?php echo $setting->company_logo;?>" class="col-xs-6">
						<?php }?>
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
						<input type="text" class="form-control" value="<?php echo $setting->discount_type;?>" disabled>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-3 control-label">Discount Produk</label>
					  <div class="col-xs-2">
						<input type="text" class="form-control" value="<?php echo $setting->discount_value;?>" disabled>
					  </div>
					  <label class="control-label"> %</label>
					</div>
					<div class="form-group">
					  <label class="col-sm-3 control-label">Discount Member</label>
					  <div class="col-xs-2">
						<input type="text" class="form-control" value="<?php echo $setting->discount_member;?>" disabled>
					  </div>
					  <label class="control-label"> %</label>
					</div>
					<div class="form-group">
					  <label class="col-sm-3 control-label">Maksimal Discount Manual</label>
					  <div class="col-xs-2">
						<input type="text" class="form-control" value="<?php echo $setting->discount_manual_max;?>" disabled>
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
						<input type="text" class="form-control" value="<?php echo $setting->receipt_header;?>" disabled>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-3 control-label">Footer</label>
					  <div class="col-xs-6">
						<input type="text" class="form-control" value="<?php echo $setting->receipt_footer;?>" disabled>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-3 control-label">Promo</label>
					  <div class="col-xs-6">
						<input type="text" class="form-control" value="<?php echo $setting->receipt_promo;?>" disabled>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-3 control-label">Maksimal Print Receipt</label>
					  <div class="col-xs-1">
						<input type="text" class="form-control" value="<?php echo $setting->receipt_max_print;?>" disabled>
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
				  <h3 class="box-title"><?php echo $finance_title;?></h3>
				</div><!-- /.box-header -->
				<div class="box-body">
				<div class="form-horizontal">
				  <div class="box-body">
					<div class="form-group">
						<label class="col-sm-3 control-label">Akun Belanja Harian</label>
					  <div class="col-xs-2">
						<input type="text" class="form-control" value="<?php echo $setting->mail_server_address;?>" disabled>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-3 control-label">Akun Belanja Bulanan</label>
					  <div class="col-xs-2">
						<input type="text" class="form-control" value="<?php echo $setting->mail_server_port;?>" disabled>
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
				  <h3 class="box-title"><?php echo $mail_title;?></h3>
				</div><!-- /.box-header -->
				<div class="box-body">
				<div class="form-horizontal">
				  <div class="box-body">
					<div class="form-group">
						<label class="col-sm-3 control-label">Alamat Server</label>
					  <div class="col-xs-2">
						<input type="text" class="form-control" value="<?php echo $setting->mail_server_address;?>" disabled>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-3 control-label">Port Server</label>
					  <div class="col-xs-2">
						<input type="text" class="form-control" value="<?php echo $setting->mail_server_port;?>" disabled>
					  </div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Username</label>
					  <div class="col-xs-2">
						<input type="text" class="form-control" value="<?php echo $setting->mail_server_username;?>" disabled>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-3 control-label">Password</label>
					  <div class="col-xs-2">
						<input type="password" class="form-control" value="<?php echo $setting->mail_server_password;?>" disabled>
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
				  <h3 class="box-title"><?php echo $misc_title;?></h3>
				</div><!-- /.box-header -->
				<div class="box-body">
				<div class="form-horizontal">
				  <div class="box-body">
					<div class="form-group">
						<label class="col-sm-3 control-label">Tarif Pajak</label>
					  <div class="col-xs-2">
						<input type="text" class="form-control" value="<?php echo $setting->tax_fare;?>" disabled>
					  </div>
					  <label class="control-label"> %</label>
					</div>
					<div class="form-group">
					  <label class="col-sm-3 control-label">Tarif Service</label>
					  <div class="col-xs-2">
						<input type="text" class="form-control" value="<?php echo $setting->service_fare;?>" disabled>
					  </div>
					  <label class="control-label"> %</label>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Upah Lembur Per Jam</label>
					  <div class="col-xs-2">
						<input type="text" class="form-control" value="<?php echo $setting->overtime_fare_per_hour;?>" disabled>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-3 control-label">Potongan Keterlambatan Per Menit</label>
					  <div class="col-xs-2">
						<input type="text" class="form-control" value="<?php echo $setting->late_fare_per_minute;?>" disabled>
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
				<a href="<?=base_url()?>setting/edit" class="btn btn-lg btn-success">Edit</a>
			</div>
		</div>
		
		<?php }?>
		
	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->