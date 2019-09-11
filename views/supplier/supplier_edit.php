<?php
	foreach($suppliers as $supplier)
	{
		$supplier_id		= $supplier->supplier_id;
		if ($this->input->post('is_submitted'))
		{
			$supplier_full_name	= set_value('supplier_full_name');
		}
		else
		{
			$supplier_full_name					= $supplier->supplier_full_name;
			$supplier_email						= $supplier->supplier_email;
			$supplier_hp						= $supplier->supplier_hp;
			$supplier_telp						= $supplier->supplier_telp;
			$supplier_address					= $supplier->supplier_address;
			$supplier_personal_contact_name		= $supplier->supplier_personal_contact_name;
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
					if($this->session->flashdata('message_success'))
					{
						echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
					}
					elseif($this->session->flashdata('message_error'))
					{
						echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
					}
					
				echo '<span class=text-red>'.validation_errors().'</span>';
				echo form_open('supplier/edit/' . $supplier_id,['class'=>'form-horizontal']);?>
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-4 col-md-2 control-label">Nama Supplier</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="supplier_full_name" placeholder="Nama" value="<?php echo $supplier_full_name;?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 col-md-2 control-label">No. HP</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="supplier_hp" placeholder="No. HP" value="<?php echo $supplier_hp;?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 col-md-2 control-label">Email</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="supplier_email" placeholder="Email" value="<?php echo $supplier_email;?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 col-md-2 control-label">Telp.</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="supplier_telp" placeholder="Telp." value="<?php echo $supplier_telp;?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 col-md-2 control-label">Alamat</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="supplier_address" placeholder="Alamat" value="<?php echo $supplier_address;?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-4 col-md-2 control-label">Nama PIC</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="supplier_personal_contact_name" placeholder="PIC" value="<?php echo $supplier_personal_contact_name;?>">
                      </div>
                    </div>
				  </div><!-- /.box-body -->
                  <div class="box-footer">
					<input type="hidden" name="is_submitted" value="1">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?php echo base_url().'supplier';?>" class="btn btn-danger pull-right">Batal</a>
                  </div><!-- /.box-footer -->
               <?php echo form_close();?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			</div><!-- /.col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->