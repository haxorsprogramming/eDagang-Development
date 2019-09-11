<?php
foreach($customerrecord AS $customer)
{
	$customer_id		 = $customer->customer_id;
	$customer_full_name = $customer->customer_full_name;
	$customer_saldo 	= $customer->customer_saldo;
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
                <div class="box-body">
				<?php					
					if ($this->session->flashdata('message_success')) echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
					elseif ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
					?>
                <!-- form start -->
				<?php 
				echo '<span class=text-red>'.validation_errors().'</span>';
				echo form_open_multipart('customer/reset_balance/' . $customer_id,['class'=>'form-horizontal']);?>
                  <div class="box-body">
				    <!--div class="form-group">
                      <label for="Name" class="col-sm-2 control-label">ID Pelanggan</label>
                      <div class="col-xs-2">
                        <input type="text" class="form-control" name="customer_id" placeholder="ID Pelanggan" value="<?php echo set_value('customer_id');?>" maxlength="12">
                      </div>
                    </div-->
					<div class="form-group">
                      <label for="Name" class="col-sm-2 control-label">Nama Pelanggan</label>
                      <div class="col-xs-3	">
                        <input type="text" class="form-control" value="<?php echo $customer_full_name;?>" disabled>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="Name" class="col-sm-2 control-label">Tambah Saldo</label>
                      <div class="col-xs-3">
                        <input type="text" class="form-control" name="customer_saldo_new" placeholder="Tambah Saldo" value="<?php echo set_value('customer_saldo_new');?>">
                      </div>
                    </div>
				  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-lg btn-success">Simpan</button>
                    <a href="<?php echo base_url();?>customer/all" class="btn btn-danger pull-right">Batal</a>
                  </div><!-- /.box-footer -->
               <?php echo form_close();?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			</div><!-- /.col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  <!-- page script rent_car_history-->