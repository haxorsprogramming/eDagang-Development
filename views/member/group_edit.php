<?php
	foreach($group as $row)
	{
		$member_group_id	= $row->member_group_id;
		if ($this->input->post('is_submitted'))
		{
			$member_group_name		= $row->member_group_name;
			$member_group_discount	= $row->member_group_discount;
		}
		else
		{
			$member_group_name		= $row->member_group_name;
			$member_group_discount	= $row->member_group_discount;
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
	  <div class="box box-solid box-warning">
		<div class="box-header with-border">
		  <h3 class="box-title"><?php echo $sub_title;?></h3>
		</div><!-- /.box-header -->
		<div class="box-body">
		<?php					
			if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
		<!-- form start -->
		<?php 
		echo '<span class=text-red>'.validation_errors().'</span>';
		echo form_open('member/group_edit/' . $member_group_id,['class'=>'form-horizontal']);?>
		  <div class="box-body">
			<div class="form-group">
			  <label class="col-sm-3 control-label">Nama Group</label>
			  <div class="col-sm-4">
				<input type="text" class="form-control" name="member_group_name" value="<?php echo $member_group_name;?>">
			  </div>
			</div>
			<div class="form-group">
			  <label class="col-sm-3 control-label">Dsicount</label>
			  <div class="col-sm-4">
				<input type="text" class="form-control" name="member_group_discount" value="<?php echo $member_group_discount;?>">
			  </div>
			</div>
		  </div><!-- /.box-body -->
		  <div class="box-footer">
			<input type="hidden" name="is_submitted" value="1">
			<button type="submit" class="btn btn-success">Simpan</button>
			<a href="<?php echo base_url();?>member/group" class="btn btn-danger pull-right">Batal</a>
		  </div><!-- /.box-footer -->
	   <?php echo form_close();?>
		</div><!-- /.box-body -->
	  </div><!-- /.box -->
	</div><!-- /.col -->
  </div><!-- /.row (main row) -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- page script rent_car_history-->