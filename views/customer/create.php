	<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            
			<div class="col-xs-12">
              <div class="box box-solid box-default">
                <div class="box-body">
				<?php					
					if ($this->session->flashdata('message_success')) echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
					elseif ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
					?>
                <!-- form start -->
				<?php 
				echo '<span class=text-red>'.validation_errors().'</span>';
				echo form_open_multipart('customer/create',['class'=>'form-horizontal']);?>
                  <div class="box-body">
				    <!--div class="form-group">
                      <label for="Name" class="col-sm-2 control-label">ID Pelanggan</label>
                      <div class="col-xs-2">
                        <input type="text" class="form-control" name="customer_id" placeholder="ID Pelanggan" value="<?php echo set_value('customer_id');?>" maxlength="12">
                      </div>
                    </div-->
					<div class="form-group">
                      <label for="Name" class="col-sm-2 control-label">Nama Lengkap</label>
                      <div class="col-xs-3	">
                        <input type="text" class="form-control" name="customer_full_name" placeholder="Nama Lengkap" value="<?php echo set_value('customer_full_name');?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label for="Name" class="col-sm-2 control-label">No. HP</label>
                      <div class="col-xs-3">
                        <input type="text" class="form-control" name="customer_hp" placeholder="No. HP" value="<?php echo set_value('customer_hp');?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label for="Name" class="col-sm-2 control-label">Email</label>
                      <div class="col-xs-3">
                        <input type="text" class="form-control" name="customer_email" placeholder="Email" value="<?php echo set_value('customer_email');?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label for="Stock" class="col-sm-2 control-label">Foto</label>
                      <div class="col-sm-3">
                        <input type="file" class="form-control" name="userfile">
                      </div>
					  <label class="control-label">Maks. 1 MB</label>
                    </div>
					<div class="form-group">
                      <label  class="col-sm-2 control-label">Group</label>
                      <div class="col-xs-3">
						<select name="customer_group" class="form-control">
							<?php
							$groups	= $this->customer_model->get_group();
							foreach($groups as $group)
							{
							?>
							<option value="<?php echo $group->customer_group_id;?>"><?php echo $group->customer_group_name;?></option>
							<?php }?>
						</select>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-2 control-label">Saldo</label>
                      <div class="col-xs-2">
                        <input type="text" class="form-control" name="customer_saldo" placeholder="Saldo">
                      </div>
                    </div>
				  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <a href="<?php echo base_url();?>customer/all" class="btn btn-danger"><i class='fa fa-close'></i> Batal</a>&nbsp;
					 <button type="submit" class="btn btn-success"><i class='fa fa-check-circle'></i> Simpan</button>
                  </div><!-- /.box-footer -->
               <?php echo form_close();?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			</div><!-- /.col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
</div><!-- /.content-wrapper -->