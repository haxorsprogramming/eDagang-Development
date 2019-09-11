<?php
	foreach($customers as $customer)
	{
		$customer_id			= $customer->customer_id;
		$customer_group_id	= $customer->customer_group_id;
		if ($this->input->post('is_submitted'))
		{
			$customer_username		= $customer->username;
			$customer_full_name		= set_value('customer_full_name');
			$customer_hp			= set_value('customer_hp');
			$customer_email			= set_value('customer_email');
			$customer_saldo			= set_value('customer_saldo');
		}
		else
		{
			$customer_username		= $customer->username;
			$customer_full_name		= $customer->customer_full_name;
			$customer_hp			= $customer->customer_hp;
			$customer_email			= $customer->customer_email;
			$customer_saldo			= $customer->customer_saldo;
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
                <div class="box-body">
				<?php					
					if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
                <!-- form start -->
				<?php 
				echo '<span class=text-red>'.validation_errors().'</span>';
				echo form_open_multipart('customer/edit/' . $customer_id,['class'=>'form-horizontal']);?>
                  <div class="box-body">
					<div class="form-group">
                      <label class="col-sm-2 control-label">ID Pelanggan</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" value="<?php echo $customer_id;?>" disabled>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-2 control-label">Nama Lengkap</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" name="customer_full_name" placeholder="Nama Lengkap" value="<?php echo $customer_full_name;?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-2 control-label">HP</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" name="customer_hp" value="<?php echo $customer_hp;?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" name="customer_email" placeholder="Email" value="<?php echo $customer_email;?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-2 control-label">Foto</label>
                      <div class="col-sm-3">
                        <input type="file" class="form-control" name="userfile">
                      </div>
					  <label class="control-label">Maks. 1 MB</label>
                    </div>
					<div class="form-group">
                      <label class="col-sm-2 control-label">Group</label>
                      <div class="col-sm-2">
						<select name="customer_group" class="form-control">
							<?php 
							$groups	= $this->customer_model->get_group_by_group_id($customer_group_id);
							foreach($groups as $row)
							{
							?>
							<option value="<?php echo $row->customer_group_id?>"><?php echo $row->customer_group_name?></option>
							<?php }
							$groupss	= $this->customer_model->get_group();
							foreach($groupss as $rows)
							{
							?>
							<option value="<?php echo $rows->customer_group_id?>"><?php echo $rows->customer_group_name?></option>
							<?php }?>
						</select>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-2 control-label">Saldo</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="customer_saldo" value="<?php echo $customer_saldo;?>" disabled>
                      </div>
					  <?php echo anchor('customer/reset_balance/' . $customer->customer_id,'Reset Saldo', ['class'=>'btn btn-primary']);?>
                    </div>
				  </div><!-- /.box-body -->
                  <div class="box-footer">
					<input type="hidden" name="is_submitted" value="1">
					<input type="hidden" name="customer_id" value="<?=$customer_id?>">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?php echo base_url();?>customer/all" class="btn btn-danger pull-right">Batal</a>
                  </div><!-- /.box-footer -->
               <?php echo form_close();?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			</div><!-- /.col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
</div><!-- /.content-wrapper -->