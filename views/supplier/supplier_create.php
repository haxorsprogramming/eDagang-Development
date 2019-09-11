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
					if ($this->session->flashdata('message_error'))
						echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
					elseif ($this->session->flashdata('message_success'))
						echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
				?>
                <!-- form start -->
				<?php 
				echo '<label class="text text-red">'.validation_errors().'</label>';
				echo form_open_multipart('supplier/create',['class'=>'form-horizontal']);?>
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-4 col-md-2 control-label">Nama Supplier</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="supplier_full_name" placeholder="Nama" value="<?php echo set_value('supplier_full_name');?>" autofocus>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 col-md-2 control-label">No. HP</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="supplier_hp" placeholder="No. HP" value="<?php echo set_value('supplier_hp');?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 col-md-2 control-label">No. Telp</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="supplier_telp" placeholder="No. HP" value="<?php echo set_value('supplier_telp');?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 col-md-2 control-label">Email</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="supplier_email" placeholder="Email" value="<?php echo set_value('supplier_email');?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 col-md-2 control-label">Alamat</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="supplier_address" placeholder="Alamat" value="<?php echo set_value('supplier_address');?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 col-md-2 control-label">Nama PIC</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="supplier_personal_contact_name" placeholder="PIC" value="<?php echo set_value('supplier_personal_contact_name');?>">
                      </div>
                    </div>
				  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?php echo base_url();?>supplier" class="btn btn-danger pull-right">Batal</a>
                  </div><!-- /.box-footer -->
               <?php echo form_close();?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			</div><!-- /.col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->