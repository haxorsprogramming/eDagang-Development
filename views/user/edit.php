<?php
foreach($users as $user)
{
	$id_user			= $user->user_id;
	$g_id				=$user->group_id;
	if ($this->input->post('is_submitted'))
	{
		$full_name		= set_value('full_name');
		$hp				= set_value('hp');
		$email			= set_value('email');
		//$gid			= set_value('email');
	}
	else
	{
		$username		= $user->username;
		$full_name		= $user->full_name;
		$hp				= $user->hp;
		$email			= $user->email;
		$foto			= $user->image;
		$id_finger = $user->id_finger;
		//$password			= $user->password;
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
			echo '<label class="text text-red">'.validation_errors().'</label>';
			echo form_open_multipart('account/edit',['class'=>'form-horizontal']);?>
            <div class="form-group">
					<label for="Category" class="col-sm-2 control-label">Group</label>
						<div class="col-xs-2">
							<select name="group_id" class="form-control">
                            <?
							foreach($dgroup AS $pr)
							{
								?>
                                <option value="<?=$pr->group_id?>" <? if($g_id==$pr->group_id){ echo "selected";} ?>><?=$pr->group_name?></option>
                                <?
							}
                            ?>
								<!--<option value="5">Kasir</option>
								<option value="7">Logistik</option>
								<option value="6">Pelayan</option>
								<option value="4">Supervisor</option>-->
							</select>
						</div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">username</label><font color="" id='alert_user'></font>
				  <div class="col-sm-2">
					<input type="hidden" name="id_user" value="<?php echo $id_user;?>">
					<input type="text" name="username" class="form-control" value="<?php echo $username;?>" id="username">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Nama Lengkap</label>
				  <div class="col-sm-4">
					<input type="hidden" name="id_user" value="<?php echo $id_user;?>">
					<input type="text" class="form-control" name="full_name" value="<?php echo $full_name;?>">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">HP</label>
				  <div class="col-sm-3">
					<input type="text" class="form-control" name="hp" value="<?php echo $hp;?>">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Email</label>
				  <div class="col-sm-4">
					<input type="text" class="form-control" name="email" value="<?php echo $email;?>">
				  </div>
				</div>
				<?php //if($this->session->userdata('group_id')=='1'){ ?>
				<!-- <div class="form-group">
				  <label class="col-sm-2 control-label">Password</label>
				  <div class="col-sm-4">
					<input type="text" class="form-control" name="password" placeholder="">
				  </div>
				</div> -->
			<?php //} ?>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Foto</label>
				  <div class="col-sm-4">
					<input type="file" class="form-control" name="userfile">
				  </div>
				  <label class="col-sm-2 control-label">Maks. 1 MB</label>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">ID Finger</label>
					<div class="col-sm-3">
					<input type="text" class="form-control" name="id_finger" value="<?php echo $id_finger;?>">
					</div>
				</div>
			  </div><!-- /.box-body -->
			  <div class="box-footer">
				<input type="hidden" name="is_submitted" value="1">
				<button type="submit" id="submit" class="btn btn-success">Simpan</button>
				<a href="<?=base_url()?>account/all" class="btn btn-danger pull-right">Batal</a>
			  </div><!-- /.box-footer -->
		   <?php echo form_close();?>
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->
		<script type="text/javascript">
      $('#username').change(function(){
        var username = $('#username').val();
        $.ajax({
          type:'POST',
          url:'<?php echo base_url('hr/check_username')?>',
          data:'username='+username,
          success:function(data){
            if(data=='1')
            {
              $('#alert_user').prop('color','green');
              $('#alert_user').text('username dapat digunakan');
              $('#submit').prop('disabled',false);
            }else {
              $('#alert_user').prop('color','red');
              $('#alert_user').text('username telah digunakan');
              $('#submit').prop('disabled',true);
            }
          }
        });
      });
    </script>
	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <!-- page script rent_car_history-->
