<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
	<section class="content-header">
		<a href="<?=base_url('hr/attendance_config')?>" class="btn btn-warning">Pengaturan Absensi</a>
	</section>

	<!-- Main content -->
	<section class="content">
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-warning">
			<div class="box-header">
			  <h3 class="box-title"><?php echo $sub_title;?></h3> <!--<a href="<?php echo base_url();?>hr/attendance_create" class="btn btn-xs btn-primary pull-right"><span class="glyphicon glyphicon-plus"></span></a>-->
			</div><!-- /.box-header -->
			<div class="box-body">
			<?php
			if ($this->session->flashdata('message_success'))
				echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
			elseif ($this->session->flashdata('message_error'))
				echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
			?>
      <script type="text/javascript">
        $(document).ready(function(){
          setInterval(function(){
            $.ajax({
              url:"<?php echo base_url()?>hr/attendance_create",
              success:function(data){
                $('#attendance_system').html(data);
              },
              error:function()
              {
                $('#attendance_system').html('<div class="alert alert-danger">Error Koneksi terputus</div>');
              }
            });
          },10000);
        });
      </script>
      <div id="attendance_system">

      </div>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->
