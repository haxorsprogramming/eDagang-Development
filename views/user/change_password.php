<?php
	foreach($users as $user)
	{
		$username		= $user->username;
		$full_name		= $user->full_name;
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
                  <h3 class="box-title"><?=$sub_title?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<?php					
						if($this->session->flashdata('message_error'))
						{
							echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
						}
						elseif($this->session->flashdata('message_success'))
						{
							echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
						}
					echo '<label class="text text-red">'.validation_errors().'</label>';
					echo form_open_multipart('account/change_password',['class'=>'form-horizontal']);?>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">Username</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" value="<?php echo $username;?>" disabled>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label">Nama Lengkap</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" value="<?php echo $full_name;?>" disabled>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label">Password Baru</label>
                      <div class="col-sm-4">
                        <input type="password" class="form-control" name="new_password" value="<?=set_value('new_password')?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 control-label">Kofirmasi Password Baru</label>
                      <div class="col-sm-4">
                        <input type="password" class="form-control" name="cnew_password" value="<?=set_value('cnew_password')?>">
                      </div>
                    </div>
				  </div><!-- /.box-body -->
                  <div class="box-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?=base_url()?>users" class="btn btn-danger pull-right">Batal</a>
                  </div><!-- /.box-footer -->
               <?php echo form_close();?>
              </div><!-- /.box -->
			</div><!-- /.col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->