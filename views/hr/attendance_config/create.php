<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Main content -->
	<section class="content">
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-warning">
			<div class="box-header">
			  <h3 class="box-title"><?php echo $sub_title;?></h3>
			</div><!-- /.box-header -->
			   <div class="box-body">
           <form action="<?php echo base_url('hr/attendance_config/do_create');?>" method="post">
           <div class="col-md-4">
             <div class="form-group">
                <label for="">Waktu kehadiran</label>
                  <input type="time" name="ac_present_times" class="form-control">
             </div>
             <div class="form-group">
                <label for="">Keterangan Masuk</label>
                  <input type="text" name="ac_description" class="form-control" placeholder="Contoh:Masuk pagi">
             </div>
             <div class="form-group">
                <label for="">Toleransi kehadiran (Menit)</label>
                  <input type="number" name="ac_tolerant_times" class="form-control">
              </div>
              <div class="form-group">
                 <label for="">Jam kerja (Jam)</label>
                   <input type="number" name="ac_working_hours" class="form-control">
               </div>
               <div class="form-group">
                  <label for="">Batas maksimum keterlambatan (Menit)</label>
                    <input type="number" name="ac_late_maximum" class="form-control">
                </div>
               <hr>
               <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
           </div>
          </form>
			   </div><!-- /.box-body -->
		    </div><!-- /.box -->
		  </div><!-- /.col -->
	  </div><!-- /.row (main row) -->
	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->
