<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Main content -->
<section class="content">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box box-solid box-success">
		<div class="box-body">
			<?php					
			if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';
			echo '<span class=text-red>'.validation_errors().'</span>';
			echo form_open('finance/account_edit/'.$account_id,'class=form-horizontal');
			?>
			<div class="box-body">
				<?php
				foreach($accounts AS $account)
				{
				?>
				<div class="form-group">
					<label class="col-sm-3 control-label">Kode Akun</label>
					<div class="col-xs-3">
						<input type="text" name="account_code" class="form-control" value="<?php echo $account->finance_account_code;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Nama Akun</label>
					<div class="col-xs-3">
						<input type="text" name="account_name" class="form-control" value="<?php echo $account->finance_account_name;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Akun Perkiraan</label>
					<div class="col-xs-3">
						<select name="group_account" class="form-control">
						<?php
						foreach($groupaccount as $group)
						{
						?>
							<option value="<?php echo $group->finance_group_account_id;?>#<?php echo $group->finance_parent_group_account_id;?>" <? if($account->finance_group_account_id==$group->finance_group_account_id){ echo "selected";}?> ><?php echo $group->finance_group_account_code;?> - <?php echo $group->finance_group_account_name;?></option>
						<?php }?>
						</select>
					</div>
				</div>
				<?php }?>
				<div class="form-group">
					<label class="col-sm-3 control-label">Keterangan</label>
					<div class="col-xs-5">
						<input type="text" name="account_explanation" class="form-control" value="<?php echo $account->finance_account_explanation;?>">
					</div>
				</div>
			</div><!-- /.box-body -->
			<div class="box-footer">
				<input type="hidden" name="is_submitted" value="1">
				<button type="submit" class="btn btn-success">Simpan</button>
				<a href="<?=base_url()?>finance/account" class="btn btn-danger pull-right">Batal</a>
			</div><!-- /.box-footer -->
			<?php echo form_close();?>
		</div>
	</div><!-- /.box-body -->
  </div><!-- /.box -->
</div><!-- /.col -->
</div><!-- /.row (main row) -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->