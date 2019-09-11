<?php
	foreach($members as $member)
	{
		$member_id			= $member->user_id;
		$id_member			= $member->member_id;
		$member_group_id	= $member->member_group_id;
		if ($this->input->post('is_submitted'))
		{
			$username		= $member->username;
			$full_name		= set_value('full_name');
			$hp				= set_value('hp');
			$email			= set_value('email');
			$saldo			= set_value('saldo');
		}
		else
		{
			$username		= $member->username;
			$full_name		= $member->full_name;
			$hp				= $member->hp;
			$email			= $member->email;
			$saldo			= $member->saldo;
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
				echo form_open_multipart('member/edit/' . $member_id,['class'=>'form-horizontal']);?>
                  <div class="box-body">
					<div class="form-group">
                      <label class="col-sm-3 control-label">ID Member</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" value="<?php echo $id_member;?>" disabled>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">HP</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" name="hp" value="<?php echo $hp;?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-3 control-label">Nama Lengkap</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" name="full_name" placeholder="Nama Lengkap" value="<?php echo $full_name;?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-3 control-label">Email</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo $email;?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-3 control-label">Foto</label>
                      <div class="col-sm-4">
                        <input type="file" class="form-control" name="userfile">
                      </div>
					  <label class="control-label">Maks. 1 MB</label>
                    </div>
					<div class="form-group">
                      <label class="col-sm-3 control-label">Group</label>
                      <div class="col-sm-3">
						<select name="group" class="form-control">
							<?php 
							$groups	= $this->member_model->get_group_by_group_id($member_group_id);
							foreach($groups as $row)
							{
							?>
							<option value="<?php echo $row->member_group_id?>"><?php echo $row->member_group_name?></option>
							<?php }
							$groupss	= $this->member_model->get_group();
							foreach($groupss as $rows)
							{
							?>
							<option value="<?php echo $rows->member_group_id?>"><?php echo $rows->member_group_name?></option>
							<?php }?>
						</select>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-3 control-label">Saldo</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="saldo" value="<?php echo $saldo;?>">
                      </div>
                    </div>
				  </div><!-- /.box-body -->
                  <div class="box-footer">
					<input type="hidden" name="is_submitted" value="1">
					<input type="hidden" name="member_id" value="<?=$member_id?>">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?php echo base_url();?>member/all" class="btn btn-danger pull-right">Batal</a>
                  </div><!-- /.box-footer -->
               <?php echo form_close();?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			</div><!-- /.col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  <!-- page script rent_car_history-->