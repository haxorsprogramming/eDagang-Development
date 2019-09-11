<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Main content -->
	<section class="content">

	  <div class="row">
		<div class="col-xs-12 col-md-12">
		  <div class="box box-solid box-success">
			<div class="box-header">
			  <h3 class="box-title"><?php echo $sub_title;?>
			</div><!-- /.box-header -->
			<div class="box-body">
        <div class="container-fluid">
			<?php
			if ($this->session->flashdata('message_success'))
				echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
			elseif ($this->session->flashdata('message_error'))
				echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
			?>
      <form class="form-horizontal" action="<?php echo base_url('hr/employee_create')?>" method="post" enctype="multipart/form-data">
      <div class="col-md-3">
        <center>
          <img src="<?php echo base_url('assets/img/user/avatar6.png')?>" alt="" class="img-responsive center" id="employee-image">
          <font class="text-center" color='red'>(Max file size 2MB)</font>
        </center>
          <input type="file" name="image" accept="image/jpeg,image/x-png" class="form-control" id='image-upload'>
      </div>
      <script type="text/javascript">
      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e) {
            $('#employee-image').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
        }
        }

        $("#image-upload").change(function() {
        readURL(this);
        });
      </script>
        <div class="col-md-4">
    				<div class="form-group">
    					<label class="control-label">Nomor Induk Kepegawaian</label>
    						<input type="text" class="form-control" name="employee_code" value="<?php echo set_value('employee_code');?>">
    				</div>
            <div class="form-group">
    					<label class="control-label">Username</label>
    						<input type="text" class="form-control" name="username" id='username'>
              <font id='alert_user' color='red'></font>
    				</div>
            <div class="form-group">
              <label class="control-label">Sapaan</label>
                <select class="form-control" name="employee_greeting" required>
                  <option>-Pilih Sapaan-</option>
                  <option value="Tuan">Tuan</option>
                  <option value="Nyonya">Nyonya</option>
                </select>
            </div>
    				<div class="form-group">
    					<label class="control-label">Nama Karyawan</label>
    						<input type="text" class="form-control" name="employee_name" value="<?php echo set_value('employee_name');?>">
    				</div>
            <div class="form-group">
              <label class="control-label">Jenis kelamin</label>
                <select class="form-control" name="employee_sex" required>
                  <option>-Pilih Jenis Kelamin-</option>
                  <option value="l">Laki-laki</option>
                  <option value="p">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
              <label class="control-label">Tgl Lahir</label>
                <input type="text" class="form-control" id="birth_date" name="employee_birth_date" value="<?php echo set_value('employee_birth_date');?>">
            </div>
    				<div class="form-group">
    					<label class="control-label">Alamat</label>
    						<input type="text" class="form-control" name="employee_address" value="<?php echo set_value('employee_address');?>">
    				</div>
    				<div class="form-group">
    					<label class="control-label">Tgl Gabung</label>
    						<input type="text" class="form-control" id="join_date" name="employee_join_date" value="<?php echo set_value('employee_join_date');?>">
    				</div>
    				<div class="form-group">
    					<label class="control-label">Departemen</label>
    						<select name="employee_department" class="form-control">
                                <option>-- Pilih Departemen --</option>
    						<?php
    						foreach($departmentrecord as $department)
    						{
                    if ($department->employee_departement_status!='0') {                      // code...
    						?>
    						<option value="<?php echo $department->employee_department_id;?>"><?php echo $department->employee_department_name;?></option>
    						<?php
                    }
                  }
                ?>
    						</select>
    				</div>
          </div>
          <div class="col-md-1">
          </div>
          <div class="col-md-4">
            <div class="form-group">
    					<label class="control-label">Hak akses pengguna</label>
    						<select name="group_id" class="form-control select2">
                <option value="">- Pilih hak akses -</option>
    						<?php
    						foreach($user_group as $key)
    						{
    						?>
    						<option value="<?php echo $key->group_id;?>"><?php echo $key->group_name;?></option>
    						<?php }?>
    						</select>
    				</div>
    				<div class="form-group">
    					<label class="control-label">Posisi</label>
    						<select name="employee_position" class="form-control">
                                <option>-- Pilih Posisi --</option>
    						<?php
    						foreach($positionrecord as $position)
    						{
                  if ($position->employee_position_status!='0') {
    						?>
    						<option value="<?php echo $position->employee_position_id;?>"><?php echo $position->employee_position_name;?></option>
    						<?php
                    }
                  }
                ?>
    						</select>
    				</div>
            <div class="form-group">
    					<label class="control-label">Email</label>
    						<input type="email" class="form-control" name="email" value="<?php echo set_value('employee_first_finger_id');?>">
    				</div>
            <div class="form-group">
    					<label class="control-label">No. HP</label>
    						<input type="text" class="form-control" name="hp" min="1" value="<?php echo set_value('employee_first_finger_id');?>">
    				</div>
            <div class="form-group">
    					<label class="control-label">Gaji Pokok</label>
    						<input type="number" class="form-control" name="employee_basic_salary" min="0" value="">
    				</div>
                    <div class="form-group">
    					<label class="control-label">Tunjangan Jabatan</label>
                        <input type="number" class="form-control" name="employee_position_allowance" min="0" value="">
    				</div>
                    <div class="form-group">
    					<label class="control-label">Tunjangan BPJS TK</label>
                        <input type="number" class="form-control" name="employee_bpjstk" min="0" value="">
    				</div>
            <div class="form-group">
    					<label class="control-label">ID Finger 1</label>
    						<input type="text" class="form-control" name="employee_first_finger_id" value="<?php echo set_value('employee_first_finger_id');?>">
    				</div>
            <div class="form-group">
    					<label class="control-label">ID Finger 2</label>
    						<input type="text" class="form-control" name="employee_second_finger_id" value="<?php echo set_value('employee_second_finger_id');?>">
    				</div>
            <div class="form-group">
    					<label class="control-label">ID Finger 3</label>
    						<input type="text" class="form-control" name="employee_third_finger_id" value="<?php echo set_value('employee_third_finger_id');?>">
            </div>
          </div>
				</div>
			</div><!-- /.box-body -->
			<div class="box-footer">
        <button type="submit" class="btn btn-success" id='submit'>Simpan</button>
				<a href="<?=base_url('hr/employee')?>" class="btn btn-danger pull-right">Batal</a>
			</div><!-- /.box-footer -->
      </form>
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->
    <script type="text/javascript">
      $('#username').change(function(){
        var username = $('#username').val();
        $.ajax({
          type:'POST',
          url:'<?php echo base_url('hr/check_username')?>',
          data:'username='+username,
          success:function(data){
            if(data=='1')
            {
              $('#alert_user').prop('color','green');
              $('#alert_user').text('username dapat digunakan');
              $('#submit').prop('disabled',false);
            }else {
              $('#alert_user').prop('color','red');
              $('#alert_user').text('username telah digunakan');
              $('#submit').prop('disabled',true);
            }
          }
        });
      });
    </script>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
  $(function () {
	 //Date range picker
	$('#join_date').datepicker({
						format: 'dd-mm-yyyy',
						todayBtn: true,
						todayHighlight: true,
						autoclose: true
					});
  $('#birth_date').datepicker({
       			format: 'dd-mm-yyyy',
       			todayBtn: true,
       			todayHighlight: true,
       			autoclose: true
       		});
  });
</script>