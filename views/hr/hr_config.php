<?php
foreach ($settings AS $setting)
{
    $overtime_fare_per_hour             = $setting->overtime_fare_per_hour;
    $overtime_meal_fare_per_day         = $setting->overtime_meal_fare_per_day;
    $attendance_multiple_late_minutes   = $setting->attendance_multiple_late_minutes;
    $attendance_late_fare               = $setting->attendance_late_fare;
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
					if ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
                    if ($this->session->flashdata('message_success')) echo '<div class="alert alert-warning">'.$this->session->flashdata('message_success').'</div>';
                    ?>
                <!-- form start -->
				<?php 
				echo '<span class=text-red>'.validation_errors().'</span>';
				echo form_open('hr/config',['class'=>'form-horizontal']);
                ?>
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Lembur Per Jam</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" name="overtime_fare_per_hour" value="<?php echo $overtime_fare_per_hour;?>">
                      </div>
                       <label class="control-label">/ Jam</label>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Uang Makan Lembur Per Hari</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" name="overtime_meal_fare_per_day" value="<?php echo $overtime_meal_fare_per_day;?>">
                      </div>
                       <label class="control-label">/ Hari</label>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Kelipatan Keterlambatan (Menit)</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" name="attendance_multiple_late_minutes" value="<?php echo $attendance_multiple_late_minutes;?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Potongan Keterlambatan</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" name="attendance_late_fare" value="<?php echo $attendance_late_fare;?>">
                      </div>
                    </div>
                    <p>
                        <label>Jika tidak ada nilai wajib diisi dengan nilai nol (0)</label>
                    </p>
				  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?php echo base_url('hr/config');?>" class="btn btn-danger pull-right">Batal</a>
                  </div><!-- /.box-footer -->
               <?php echo form_close();?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row (main row) -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->