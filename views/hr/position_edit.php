<?php
	foreach($position as $row)
	{
		$position_id		= $row->employee_position_id;
		if ($this->input->post('is_submitted'))
		{
			$position_name	= set_value('position_name');
		}
		else
		{
			$position_id		= $row->employee_position_id;
			$position_name	= $row->employee_position_name;
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
                  <h3 class="box-title"><?php echo $sub_title;?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				<?php					
					if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
                <!-- form start -->
				<?php 
				echo '<span class=text-red>'.validation_errors().'</span>';
				echo form_open('hr/position_edit/' . $position_id,['class'=>'form-horizontal']);?>
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Nama Posisi</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" name="position_name" value="<?php echo $position_name;?>">
                      </div>
                    </div>
				  </div><!-- /.box-body -->
                  <div class="box-footer">
					<input type="hidden" name="position_id" value="<?php echo $position_id;?>">
					<input type="hidden" name="is_submitted" value="1">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?php echo base_url();?>hr/position" class="btn btn-danger pull-right">Batal</a>
                  </div><!-- /.box-footer -->
               <?php echo form_close();?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			</div><!-- /.col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  <!-- page script rent_car_history-->