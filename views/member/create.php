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
					if ($this->session->flashdata('message_success')) echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
					elseif ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
					?>
                <!-- form start -->
				<?php 
				echo '<span class=text-red>'.validation_errors().'</span>';
				echo form_open_multipart('member/create',['class'=>'form-horizontal']);?>
                  <div class="box-body">
				    <div class="form-group">
                      <label for="Name" class="col-sm-3 control-label">ID Member</label>
                      <div class="col-xs-5">
                        <input type="text" class="form-control" name="member_id" placeholder="ID Member" value="<?php echo set_value('member_id');?>" maxlength="12">
                      </div>
                    </div>
					<div class="form-group">
                      <label for="Name" class="col-sm-3 control-label">Nama Lengkap</label>
                      <div class="col-xs-5">
                        <input type="text" class="form-control" name="full_name" placeholder="Nama" value="<?php echo set_value('full_name');?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label for="Name" class="col-sm-3 control-label">No. HP</label>
                      <div class="col-xs-5">
                        <input type="text" class="form-control" name="hp" placeholder="No. HP" value="<?php echo set_value('hp');?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label for="Name" class="col-sm-3 control-label">Email</label>
                      <div class="col-xs-5">
                        <input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo set_value('email');?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label for="Stock" class="col-sm-3 control-label">Foto</label>
                      <div class="col-sm-5">
                        <input type="file" class="form-control" name="userfile">
                      </div>
					  <label class="control-label">Maks. 1 MB</label>
                    </div>
					<div class="form-group">
                      <label  class="col-sm-3 control-label">Group</label>
                      <div class="col-xs-5">
						<select name="group" class="form-control">
							<?php
							$groups	= $this->member_model->get_group();
							foreach($groups as $group)
							{
							?>
							<option value="<?php echo $group->member_group_id;?>"><?php echo $group->member_group_name;?></option>
							<?php }?>
						</select>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-3 control-label">Saldo</label>
                      <div class="col-xs-2">
                        <input type="text" class="form-control" name="saldo" placeholder="Saldo" value="<?php echo set_value('saldo');?>">
                      </div>
                    </div>
				  </div><!-- /.box-body -->
                  <div class="box-footer">
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