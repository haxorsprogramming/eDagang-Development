<?php
	foreach($tables as $table)
	{
		$table_id			= $table->table_list_id;
		if ($this->input->post('is_submitted'))
		{
			$table_name		= $this->input->post('table_name');
		}
		else
		{
			$table_name		= $table->table_name;
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
                  <h3 class="box-title"><?=$sub_title?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				<?php					
					if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
                <!-- form start -->
				<?php 
				echo '<span class=text-red>'.validation_errors().'</span>';
				echo form_open_multipart('setting/table_edit/' . $table_id,['class'=>'form-horizontal']);?>
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Nama Meja</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" name="table_name" placeholder="Nama Meja" value="<?php echo $table_name;?>">
                      </div>
                    </div>
				  </div><!-- /.box-body -->
                  <div class="box-footer">
					<input type="hidden" name="is_submitted" value="1">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?=base_url().'setting/table'?>" class="btn btn-danger pull-right">Batal</a>
                  </div><!-- /.box-footer -->
               <?php echo form_close();?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			</div><!-- /.col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  <!-- page script rent_car_history-->