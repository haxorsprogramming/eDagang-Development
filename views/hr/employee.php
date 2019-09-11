<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<a href="<?php echo base_url();?>hr/employee_create" class="btn btn-warning">Tambah Karyawan</a>
		<a href="<?=base_url()?>hr/department/1" class="btn btn-primary">Departemen</a>
		<a href="<?=base_url()?>hr/position/1" class="btn btn-primary">Jabatan/Posisi</a>
	</section>

	<!-- Main content -->
	<section class="content">
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-success">
			<div class="box-header">
			  <h3 class="box-title"><?php echo $sub_title;?></h3>
			</div><!-- /.box-header -->
			<div class="box-body">
			<?php
			if ($this->session->flashdata('message_success'))
				echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
			elseif ($this->session->flashdata('message_error'))
				echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
			?>
			<div>
			  <table id="employee" class="table table-striped table-bordered table-hover">
				<thead>
				  <tr>
					<th class="text-center">No.</th>
					<th class="text-center">Nomor Induk Kepegawaian</th>
					<th class="text-center">Nama Karyawan</th>
					<th class="text-center">Tanggal Gabung</th>
					<th class="text-center">Departemen</th>
					<th class="text-center">Posisi</th>
					<th class="text-center">Action</th>
				  </tr>
				</thead>
				<tbody>
				<?php
					$no=1;
					foreach($employeerecord AS $row)
					{
					?>
				  <tr>
					<td align="center"><?php echo $no++;?></td>
					<td align="center"><?php echo $row->employee_code;?></td>
					<td align="center"><?php echo $row->employee_name;?></td>
					<td align="center"><?php echo date("d-m-Y",strtotime($row->employee_join_date));?></td>
					<td align="center"><?php
					$departments = $this->hr_model->get_department_by_employee_department_id($row->employee_department_id);
					foreach($departments as $department)
					{
						echo $department->employee_department_name;
					}
					?></td>
					<td align="center"><?php
					$positions = $this->hr_model->get_position_by_employee_position_id($row->employee_position_id);
					foreach($positions as $position)
					{
						echo $position->employee_position_name;
					}
					?></td>
          <td>
            <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#<?php echo $row->employee_id?>"><i class="fa fa-edit"></i></button>
            <a class="btn btn-danger btn-xs" href="<?php echo base_url()."hr/delete_employee/".$row->employee_id?>" onclick="return confirm('apakah anda yakin akan menghapus karyawan? data yg sudah dihapus tidak bisa dikembalikan!')"><i class="fa fa-times"></i></a>&nbsp;
            <a href="<?php echo base_url('hr/attendance_rekap').'/'.$row->employee_id;?>" target="_blank" class="btn btn-info btn-xs">Cek absen</a>
          </td>
				  </tr>
				  <?php };?>
				</tbody>
			  </table>
			 </div>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <?php
    $tgl=1;
    $no=1;$tanda_department=1;$tanda_position=1;
    $tanda_group=1;
    foreach($employeerecord AS $row)
    {
        $employee_user_id = $row->employee_user_id;
        $users = $this->account_model->get_user_by_user_id($employee_user_id);
        foreach ($users AS $user)
        {
            $username = $user->username;
        }
      $employee_id=$row->employee_id;
    ?>
  <!-- Modal -->
  <div class="modal fade" id="<?php echo $row->employee_id?>" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <?php
      if ($this->session->flashdata('message_success'))
        echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
      elseif ($this->session->flashdata('message_error'))
        echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
      echo form_open('hr/employee_edit/'.$employee_id,'class=panel-body');
      ?>
      <div class="modal-content">
        <div class="modal-header animated  fadeInLeft">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Data Karyawan</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-4">
                <table class="table table-striped table-bordered">
                  <tr>
                    <td colspan="2">
                      <img src="<?php //echo base_url().$row->image?>" class="img-responsive" alt="">
                    </td>
                    <tr>
                      <td><label>Nomor Induk Kepegawaian</label></td>
                      <td><input type="text" class="form-control" name="employee_code" value="<?php echo $row->employee_code;?>"></td>
                    </tr>
                  </tr>
                </table>
              </div>
            <div class="col-md-4">
                <table class="table table-striped table-bordered">
                  <tr>
                    <td><label>Nomor Induk Kepegawaian</label></td>
                    <td><input type="text" class="form-control" name="employee_code" value="<?php echo $row->employee_code;?>"></td>
                  </tr>
                  <tr>
                    <td><label>Username</label><font id='alert_user<?php echo $row->employee_code;?>' color='red'></font></td>
                    <td>
                      <input type="text" class="form-control" name="username" value="<?php echo $username;?>" onchange="check_username(this,'<?php echo $row->employee_code;?>')">
                      <input type="hidden" name="employee_user_id" value="<?php echo $employee_user_id;?>" />
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label class="col-sm-3 control-label">Sapaan</label>
                    </td>
                    <td>
                      <select class="form-control" id='greeting<?php echo $no?>' name="employee_greeting" required>
                        <option>-Pilih Sapaan-</option>
                        <option value="Tuan">Tuan</option>
                        <option value="Nyonya">Nyonya</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td><label>Nama Karyawan</label></td>
                    <td><input type="text" class="form-control" name="employee_name" value="<?php echo $row->employee_name;?>"></td>
                  </tr>
                  <tr>
                    <td>
                        <label class="col-sm-3 control-label">Tgl Lahir</label>
                    </td>
                    <td>
                          <input type="text" class="form-control" id="birth_date<?php echo $no ?>" name="employee_birth_date" value="<?php echo date('Y-m-d',strtotime($row->employee_birth_date));?>">
                    </td>
                  </tr>
                  <tr>
                    <td><label>Alamat</label></td>
                    <td><input type="text" class="form-control" name="employee_address" value="<?php echo $row->employee_address;?>"></td>
                  </tr>
                  <tr>
                    <td><label>Tgl Gabung</label></td>
                    <td><input type="text" class="form-control" id="join_date<?php echo $tgl++?>" name="employee_join_date" value="<?php echo date('d-m-Y',strtotime($row->employee_join_date));?>"></td>
                  </tr>
                  <tr>
                    <td>
                        <label class="col-sm-3 control-label">Jenis kelamin</label>
                    </td>
                    <td>
                          <select class="form-control" id='jenkel<?php echo $no?>' name="employee_sex" required>
                            <option>-Pilih Jenis Kelamin-</option>
                            <option value="l">Laki-laki</option>
                            <option value="p">Perempuan</option>
                          </select>
                    </td>
                  </tr>
                </table>
              </div>
              <div class="col-md-4">
                  <table class="table table-striped table-bordered">
                    <tr>
                      <td><label>Departemen</label></td>
                      <td><select name="employee_department" id="employee_department<?=$tanda_department++?>" class="form-control">
                                  <?php
                                  foreach($departmentrecord as $department)
                                  {
                                    if ($department->employee_departement_status!='0'){
                                  ?>
                                  <option value="<?php echo $department->employee_department_id;?>"><?php echo $department->employee_department_name;?></option>
                                  <?php
                                      }
                                    }
                                  ?>
                                  </select>
                      </td>
                    </tr>
                    <script type="text/javascript">
                      $("#employee_department<?=$tanda_department-1?>").val("<?=$row->employee_department_id?>");
                    </script>
                    <tr>
                      <td><label>Hak akses pengguna</label></td>
                      <td><select name="group" id="group<?=$tanda_group++?>" class="form-control">
                      						<?php
                      						foreach($group as $key)
                      						{
                      						?>
                      						<option value="<?php echo $key->group_id;?>" <?php if($user->group_id==$key->group_id){ echo "selected"; }?>><?php echo $key->group_name;?></option>
                      						<?php }?>
                      						</select>
                      </td>
                    </tr>
                    <script type="text/javascript">
                      $("#group<?=$tanda_group-1?>").val("<?=$row->group_id?>");
                    </script>
                    <tr>
                      <td><label>Posisi</label></td>
                      <td><select name="employee_position" id="employee_position<?=$tanda_position++?>" class="form-control">
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
                      						</select></td>
                    </tr>
                    <script type="text/javascript">
                      $("#employee_position<?=$tanda_position-1?>").val("<?=$row->employee_position_id?>");
                    </script>
                    <tr>
                      <td>
                        <label class="col-sm-3 control-label">Gaji pokok</label>
                      </td>
                      <td>
                          <input type="number" min="0" class="form-control" name="employee_basic_salary" value="<?php echo $row->employee_basic_salary;?>">
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="col-sm-3 control-label">Tunjangan jabatan</label>
                      </td>
                      <td>
                          <input type="number" min="0" class="form-control" name="employee_position_allowance" value="<?php echo $row->employee_position_allowance;?>">
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="col-sm-3 control-label">Tunjangan BPJS TK</label>
                      </td>
                      <td>
                          <input type="number" min="0" class="form-control" name="employee_bpjstk" value="<?php echo $row->employee_bpjstk;?>">
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="col-sm-3 control-label">ID Finger 1</label>
                      </td>
                      <td>
                          <input type="text" class="form-control" name="employee_first_finger_id" value="<?php echo $row->employee_first_finger_id;?>">
                      </td>
                    </tr>
                    <tr>
                        <td>
                          <label class="col-sm-3 control-label">ID Finger 2</label>
                        </td>
                        <td>
                          <input type="text" class="form-control" name="employee_second_finger_id" value="<?php echo $row->employee_second_finger_id;?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                          <label class="col-sm-3 control-label">ID Finger 3</label>
                        </td>
                        <td>
                          <input type="text" class="form-control" name="employee_third_finger_id" value="<?php echo $row->employee_third_finger_id;?>">
                        </td>
                    </tr>
                  </table>
                  <div class="alert alert-info">Pilih Bagian Posisi dan Departemen untuk mengedit Posisi dan Departemen yang baru</div>
                </div>
            </div>
            <hr>
          <button type="submit" class="btn btn-info" name="kirim" id="submit<?php echo $row->employee_code;?>">Simpan</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
  $('#greeting<?php echo $no?>').val('<?php echo $row->employee_greeting?>');
  $('#jenkel<?php echo $no?>').val('<?php echo $row->employee_sex?>');
  </script>
  <script>
    $(function () {
  	 //Date range picker
  	$('#join_date<?php echo $no?>').datepicker({
  						format: 'dd-mm-yyyy',
  						todayBtn: true,
  						todayHighlight: true,
  						autoclose: true
  					});
    $('#birth_date<?php echo $no++?>').datepicker({
              format: 'yyyy-mm-dd',
              todayBtn: true,
              todayHighlight: true,
              autoclose: true
            });
    });
  </script>
<?php };?>

<script type="text/javascript">
  function check_username(user_name,employee_code){
    var username = $(user_name).val();
    $.ajax({
      type:'POST',
      url:'<?php echo base_url('hr/check_username')?>',
      data:'username='+username,
      success:function(data){
        if(data=='1')
        {
          $('#alert_user'+employee_code).prop('color','green');
          $('#alert_user'+employee_code).text('username dapat digunakan');
          $('#submit'+employee_code).prop('disabled',false);
        }else {
          $('#alert_user'+employee_code).prop('color','red');
          $('#alert_user'+employee_code).text('username telah digunakan');
          $('#submit'+employee_code).prop('disabled',true);
        }
      }
    });
  }
</script>
<script>
  $(function () {
	 $('#employee').DataTable({
		 "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		 "pagingType": "full_numbers"
	 });
  });
</script>