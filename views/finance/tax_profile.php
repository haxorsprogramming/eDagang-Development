<?php
foreach($taxprofile as $wp)
{
	$npwp		= $wp->npwp;
	$nama		= $wp->nama;
	$alamat		= $wp->alamat;
	$kota		= $wp->kota;
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Main content -->
<section class="content">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box box-solid box-success">
		<div class="box-header with-border">
		  <h3 class="box-title"><?=$sub_title?></h3>
		</div><!-- /.box-header -->
		<div class="box-body">
			<?php					
			if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';
			echo '<span class=text-red>'.validation_errors().'</span>';
			echo form_open('finance/tax_profile','class=form-horizontal');
			?>
			<div class="box-body">
				<div class="form-group">
					<label class="col-xs-6 col-md-3 control-label">NPWP</label>
					<div class="col-xs-6 col-md-3">
						<input type="text" name="npwp" class="form-control" value="<?php echo $npwp;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-6 col-md-3 control-label">Nama Wajib Pajak</label>
					<div class="col-xs-6 col-md-3">
						<input type="text" name="wp_name" class="form-control" value="<?php echo $nama;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-6 col-md-3 control-label">Alamat</label>
					<div class="col-xs-6 col-md-3">
						<input type="text" name="wp_address" class="form-control" value="<?php echo $alamat;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-6 col-md-3 control-label">Kota</label>
					<div class="col-xs-6 col-md-3">
						<input type="text" name="wp_city" class="form-control" value="<?php echo $kota;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-6 col-md-3 control-label">Telepon</label>
					<div class="col-xs-6 col-md-3">
						<input type="text" name="wp_telepon" class="form-control">
					</div>
				</div> 
				<div class="form-group">
					<label class="col-xs-6 col-md-3 control-label">Fax</label>
					<div class="col-xs-6 col-md-3">
						<input type="text" name="wp_fax" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-6 col-md-3 control-label">Email</label>
					<div class="col-xs-6 col-md-3">
						<input type="text" name="wp_email" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-6 col-md-3 control-label">Jenis Usaha</label>
					<div class="col-xs-6 col-md-3">
						<input type="text" name="wp_type_business" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-6 col-md-3 control-label">KLU</label>
					<div class="col-xs-6 col-md-3">
						<input type="text" name="wp_klu" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-6 col-md-3 control-label">Penandatangan Wajib Pajak</label>
					<div class="col-xs-6 col-md-3">
						<input type="text" name="wp_wp" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-6 col-md-3 control-label">NPWP Penandatangan Wajib Pajak</label>
					<div class="col-xs-6 col-md-3">
						<input type="text" name="wp_npwp" class="form-control">
					</div>
				</div>
			</div><!-- /.box-body -->
			<div class="box-footer">
				<input type="hidden" name="is_submitted" value="1">
				<button type="submit" class="btn btn-success">Simpan</button>
				<a href="<?=base_url()?>finance/se_summary" class="btn btn-danger pull-right">Batal</a>
			</div><!-- /.box-footer -->
			<?php echo form_close();?>
		</div>
	</div><!-- /.box-body -->
  </div><!-- /.box -->
</div><!-- /.col -->
</div><!-- /.row (main row) -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->