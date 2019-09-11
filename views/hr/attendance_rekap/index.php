<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
	<section class="content-header">
		<a href="<?=base_url('hr/attendance_config')?>" class="btn btn-warning">Pengaturan Absensi</a>&nbsp;
        <a href="<?=base_url('hr/attendance_original_data')?>" class="btn btn-primary">Data Absensi Asli</a>
	</section>

	<!-- Main content -->
	<section class="content">
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-success">
			<div class="box-header">
			  <h3 class="box-title"><?php echo $panel_info;?></h3>
			</div><!-- /.box-header -->
              <div class="box-body">
                  <?php echo form_open('hr/'.$link.'/search','method="get"');?>
                  <div class="col-xs-12 col-sm-4 col-md-3">
                    <div class="input-group">
                     <span class="input-group-addon">Dari :</span>
                      <input type="text" class="form-control" id="start_date" name="start_date" value="<?php echo $start_date;?>">
                    </div><!-- /.input group -->
                  </div>
                  <div class="col-xs-12 col-sm-4 col-md-3">
                    <div class="input-group">
                       <span class="input-group-addon">Sampai :</span>
                       <input type="text" class="form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>">
                    </div>
                  </div><!-- /.input group -->
                  <div class="col-xs-12 col-sm-2">
                    <div class="input-group">
                       <button class="btn btn-block btn-primary" type="submit">Cari</button>
                    </div>
                  </div><!-- /.input group -->
                  <?php echo form_close();?>
              </div>
              <div class="box-body">
                <table class="table table-striped table-bordered table-hover">
                <thead style="background-color:yellow">
                  <tr>
                  <th>No.</th>
                  <th>Keterangan Masuk</th>
                  <th>Jam Masuk</th>
                  <th>Toleransi Kehadiran</th>
                  <th>Jam Kerja</th>
                  <th>Batas Maksimum Keterlambatan</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($attendance_config AS $row)
                  {
                  ?>
                  <tr>
                  <td align="center"><?php echo $no++;?></td>
                  <td align="center"><?php echo $row->ac_description;?></td>
                  <td align="center"><?php echo $row->ac_present_times;?></td>
                  <td align="center"><?php echo $row->ac_tolerant_times;?> (Menit)</td>
                  <td align="center"><?php echo $row->ac_working_hours;?> (Jam)</td>
                  <td align="center"><?php echo $row->ac_late_maximum;?> (Menit)</td>
                  </tr>
                  <?php }?>
                </tbody>
                </table>
                <?php foreach ($attendance_config as $key): ?>
                  <?php $masuk[] = $key->ac_present_times; ?>
                  <?php $max_late[] = $key->ac_late_maximum; ?>
                  <?php $tolerant_times[] = $key->ac_tolerant_times; ?>
                  <?php $working_hours[] = $key->ac_working_hours; ?>
                <?php endforeach; ?>
                <?php $masuk_pagi = $masuk[0]; ?>
                <?php $masuk_sore = $masuk[1]; ?>
                <?php $jam_pulang_pagi = strtotime($masuk_pagi) + $working_hours[0]*60*60; ?>
                <?php $jam_pulang_sore = strtotime($masuk_sore) + $working_hours[1]*60*60; ?>
                <?php $maksimum_telat_pagi = $max_late[0]; ?>
                <?php $maksimum_telat_sore = $max_late[1]; ?>
                <?php $toleransi_kehadiran_pagi = $tolerant_times[0]; ?>
                <?php $toleransi_kehadiran_sore = $tolerant_times[1]; ?>
              </div>
			<div class="box-body">
			<?php
			if ($this->session->flashdata('message_success'))
				echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
			elseif ($this->session->flashdata('message_error'))
				echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
			?>
			<div class="col-md-12">
			  <table id="attendance" class="table table-striped table-bordered table-hover">
				<thead style="background-color:red;color:white;">
				  <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">NIK</th>
                        <th class="text-center">Nama karyawan</th>
                        <th class="text-center">Jam Hadir</th>
                        <th class="text-center">Keterangan Hadir</th>
                        <th class="text-center">Lembur</th>
				  </tr>
				</thead>
				<tbody>
                  <?php $no=1;?>
                  <?php
                  $total_jam_datang_cepat_pagi = 0;
                  $total_jam_datang_cepat_sore = 0;
                  
                  foreach ($employee as $key)
                  {
                  $jam_absen_datang = strtotime(date('H:i:s',strtotime($key->attendance_recap_time_in)));
                  ?>
				  <tr>
    					<td align="center"><?php echo $no++;?></td>
    					<td align="center"><a href="<?php echo base_url('hr/attendance_rekap').'/'.$key->employee_id;?>"><?php echo $key->employee_code;?></a></td>
                      <td align="center"><?php echo $key->employee_name;?></td>
                      <td align="center"><?php echo date('d-m-Y H:i:s', strtotime($key->attendance_recap_time_in));?></td>
                      <td align="center"><?php
                        // Datang cepat pagi
                        if ($jam_absen_datang <= strtotime($masuk_pagi) && $jam_absen_datang < strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi)) && $jam_absen_datang < strtotime($masuk_sore))
                        {
                              $jam_masuk = strtotime($masuk_pagi);

                              $diff = $jam_masuk - $jam_absen_datang;

                              $jam   = floor($diff / (60 * 60));

                              $menit = $diff - $jam * (60 * 60);
                              
                                $total_jam_datang_cepat_pagi = $jam;
                                $total_jam_datang_cepat_sore = 0;

                              echo '<b>- ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit</b>';

                        }
                        // Datang cepat sore
                        elseif ($jam_absen_datang <= strtotime($masuk_sore) && $jam_absen_datang > strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi)) &&
                        $jam_absen_datang < strtotime("+".$maksimum_telat_sore." minutes",strtotime($masuk_sore)))
                        {
                              $jam_masuk = strtotime($masuk_sore);

                              $diff = $jam_masuk - $jam_absen_datang;

                              $jam   = floor($diff / (60 * 60));

                              $menit = $diff - $jam * (60 * 60);
                              
                              $total_jam_datang_cepat_pagi = 0;
                                $total_jam_datang_cepat_sore = $jam;

                              echo '<b>- ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit</b>';

                        }
                        // Tepat waktu pagi
                        elseif ($jam_absen_datang <= strtotime("+".$toleransi_kehadiran_pagi." minutes",strtotime($masuk_pagi))
                          && $jam_absen_datang < strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi)))
                        {

                            echo "<i class='fa fa-thumbs-up'></i>";

                        }
                        // Tepat waktu sore
                        elseif ($jam_absen_datang > strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi))
                          && $jam_absen_datang <= strtotime("+".$toleransi_kehadiran_sore." minutes",strtotime($masuk_sore))
                          && $jam_absen_datang < strtotime("+".$maksimum_telat_sore." minutes",strtotime($masuk_sore)))
                          {

                            echo "<i class='fa fa-thumbs-up'></i>";

                        }
                        // Telat pagi
                        elseif ($jam_absen_datang > strtotime("+".$toleransi_kehadiran_pagi." minutes",strtotime($masuk_pagi))
                          && $jam_absen_datang < strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi))
                          )
                        {
                            $jam_masuk = strtotime("+".$toleransi_kehadiran_pagi." minutes",strtotime($masuk_pagi));

                            $diff = $jam_absen_datang - $jam_masuk;

                            $jam   = floor($diff / (60 * 60));

                            $menit = $diff - $jam * (60 * 60);
                            
                            echo '<b class="text-danger">+ ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit</b>';

                        }
                        // Telat sore
                        elseif ($jam_absen_datang > strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi))
                          && $jam_absen_datang > strtotime("+".$toleransi_kehadiran_sore." minutes",strtotime($masuk_sore))
                          && $jam_absen_datang < strtotime("+".$maksimum_telat_sore." minutes",strtotime($masuk_sore)))
                          {
                            $jam_masuk = strtotime("+".$toleransi_kehadiran_sore." minutes",strtotime($masuk_sore));

                            $diff = $jam_absen_datang - $jam_masuk;

                            $jam   = floor($diff / (60 * 60));

                            $menit = $diff - $jam * (60 * 60);

                            echo '<b class="text-danger">+ ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit</b>';
                        }
                        else
                        {
                            $total_jam_datang_cepat_pagi = 0;
                            $total_jam_datang_cepat_sore = 0;
                        }
                       ?></td>
                        <td>
                        <?php
                        if ($key->attendance_recap_time_in_overtime_approve_by == '1')
                        {
                            echo "Disetujui";
                            //unset ($total_jam_datang_cepat_pagi);
                            //unset ($total_jam_datang_cepat_sore);
                        }
                       /*  elseif ($key->overtime_reject_by == '1')
                        {
                            echo "Tidak Lembur";
                        } */
                        if (($total_jam_datang_cepat_pagi > 0 OR $total_jam_datang_cepat_sore > 0) && ($key->attendance_recap_time_in_overtime_approve_by == '0' AND $key->attendance_recap_time_in_overtime_reject_by == '0'))
                        {
                            ?>
                            <a href="#" class="btn btn-xs btn-success" id="approve_in<?=$key->attendance_recap_id?>" onclick="approve_overtime('<?=$key->attendance_recap_id?>','approve_in')" >Approve</a>
                            &nbsp;<a href="#" class="btn btn-xs btn-danger" id="reject_in<?=$key->attendance_recap_id?>" onclick="approve_overtime('<?=$key->attendance_recap_id?>','reject_in')" >Reject</a>
                            <?
                            unset ($total_jam_datang_cepat_pagi);
                            unset ($total_jam_datang_cepat_sore);
                        }
                        ?>
                        </td>
				  </tr>
          <?php } ?>
				</tbody>
			  </table>
        <br>
        <br>
        <br>
        <br>
			 </div>
       <div class="col-md-12">
         <table id="attendance2" class="table table-striped table-bordered table-hover">
         <thead style="background-color:blue;color:white;">
           <tr>
             <th class="text-center">No.</th>
              <th class="text-center">NIK</th>
              <th class="text-center">Nama karyawan</th>
              <th class="text-center">Jam Pulang</th>
              <th class="text-center">Keterangan Pulang</th>
              <th class="text-center">Lembur</th>
           </tr>
         </thead>
         <tbody>
            <?php $no=1;?>
            <?php
            $total_jam_pulang_lewat_pagi = 0;
            $total_jam_pulang_lewat_sore = 0;
            
            foreach ($employee as $key)
            {
                $jam_absen_datang = strtotime(date('H:i:s',strtotime($key->attendance_recap_time_in)));
                $jam_absen_pulang = strtotime(date('H:i:s',strtotime($key->attendance_recap_time_out)));
                ?>
           <tr>
               <td align="center"><?php echo $no++;?></td>
               <td align="center"><a href="<?php echo base_url('hr/attendance_rekap').'/'.$key->employee_id;?>"><?php echo $key->employee_code;?></a></td>
                <td align="center"><?php echo $key->employee_name;?></td>
                <td align="center">
                <?php
                    if ($key->attendance_recap_time_out == '0000-00-00 00:00:00')
                          echo "";
                      else echo date('d-m-Y H:i:s', strtotime($key->attendance_recap_time_out));
                ?></td>
                <td align="center">
                <?php
                    // Pulang cepat pagi
                    if ($jam_absen_pulang < strtotime($jam_pulang_pagi) && $key->attendance_recap_time_out !== '0000-00-00 00:00:00')
                    {
                          $diff = $jam_absen_pulang - $jam_pulang_pagi;

                          $jam   = floor($diff / (60 * 60));

                          $menit = $diff - $jam * (60 * 60);
                          
                          $total_jam_pulang_lewat_pagi = 0;
                            $total_jam_pulang_lewat_sore = 0;
                          
                          echo '<b>- ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit</b>';
                          unset($jam);

                    }
                    // Pulang cepat sore
                    elseif (($jam_absen_datang <= strtotime($masuk_sore) && $jam_absen_datang > strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi)) &&
                    $jam_absen_datang < strtotime("+".$maksimum_telat_sore." minutes",strtotime($masuk_sore))) OR ($jam_absen_datang > strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi))
                      && $jam_absen_datang <= strtotime("+".$toleransi_kehadiran_sore." minutes",strtotime($masuk_sore))
                      && $jam_absen_datang < strtotime("+".$maksimum_telat_sore." minutes",strtotime($masuk_sore))) OR ($jam_absen_datang > strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi))
                      && $jam_absen_datang > strtotime("+".$toleransi_kehadiran_sore." minutes",strtotime($masuk_sore))
                      && $jam_absen_datang < strtotime("+".$maksimum_telat_sore." minutes",strtotime($masuk_sore))) &&  $jam_absen_pulang < $jam_pulang_sore && $key->attendance_recap_time_out !== '0000-00-00 00:00:00')
                    {
                          $diff = $jam_pulang_sore - $jam_absen_pulang;

                          $jam   = floor($diff / (60 * 60));

                          $menit = $diff - $jam * (60 * 60);
                          
                          $total_jam_pulang_lewat_pagi = 0;
                        $total_jam_pulang_lewat_sore = 0;

                          echo '<b>- ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit</b>';
                        unset($jam);
                    }
                    // Lebih pagi
                    elseif (($jam_absen_datang <= strtotime($masuk_pagi) && $jam_absen_datang < strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi)) && $jam_absen_datang < strtotime($masuk_sore)) OR ($jam_absen_datang <= strtotime("+".$toleransi_kehadiran_pagi." minutes",strtotime($masuk_pagi))
                      && $jam_absen_datang < strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi))) OR ($jam_absen_datang > strtotime("+".$toleransi_kehadiran_pagi." minutes",strtotime($masuk_pagi))
                      && $jam_absen_datang < strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi))
                      ) && $jam_absen_pulang > $jam_pulang_pagi && $key->attendance_recap_time_out !== '0000-00-00 00:00:00')
                    {
                          $diff =  $jam_absen_pulang - $jam_pulang_pagi;

                          $jam   = floor($diff / (60 * 60));

                          $menit = $diff - $jam * (60 * 60);
                          
                          $total_jam_pulang_lewat_pagi = $jam;
                          $total_jam_pulang_lewat_sore = 0;

                          echo '<b class="text-info">+ ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit</b>';
                          unset($jam);
                    }
                    // Lebih sore
                    elseif (($jam_absen_datang <= strtotime($masuk_sore) && $jam_absen_datang > strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi)) &&
                    $jam_absen_datang < strtotime("+".$maksimum_telat_sore." minutes",strtotime($masuk_sore))) OR ($jam_absen_datang > strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi))
                      && $jam_absen_datang <= strtotime("+".$toleransi_kehadiran_sore." minutes",strtotime($masuk_sore))
                      && $jam_absen_datang < strtotime("+".$maksimum_telat_sore." minutes",strtotime($masuk_sore))) OR ($jam_absen_datang > strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi))
                      && $jam_absen_datang > strtotime("+".$toleransi_kehadiran_sore." minutes",strtotime($masuk_sore))
                      && $jam_absen_datang < strtotime("+".$maksimum_telat_sore." minutes",strtotime($masuk_sore))) && $jam_absen_pulang > $jam_pulang_sore && $key->attendance_recap_time_out !== '0000-00-00 00:00:00')
                    {
                          $diff =  $jam_absen_pulang - $jam_pulang_sore;

                          $jam   = floor($diff / (60 * 60));

                          $menit = $diff - $jam * (60 * 60);
                         
                         $total_jam_pulang_lewat_pagi = 0;
                          $total_jam_pulang_lewat_sore = $jam;

                          echo '<b class="text-info">+ ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit</b>';
                        unset($jam);
                    }
                    else
                    {
                        echo "Absensi salah?";
                    }
                ?>
                </td>
                        <td>
                        <?php
                        if ($key->attendance_recap_time_out_overtime_approve_by > 0)
                        {
                            echo "Disetujui";
                        }
                        /* elseif ($key->attendance_recap_time_in_overtime_approve_by == '1')
                        {
                            echo "Tidak Lembur";
                        } */
                       elseif (($total_jam_pulang_lewat_pagi > 0 OR $total_jam_pulang_lewat_sore > 0) && $key->attendance_recap_time_out_overtime_approve_by == '0' && $key->attendance_recap_time_out_overtime_reject_by == '0')
                        {
                            ?>
                            <a href="#" class="btn btn-xs btn-success" id="approve_out<?=$key->attendance_recap_id?>" onclick="approve_overtime('<?=$key->attendance_recap_id?>','approve_out')" >Approve</a>
                            &nbsp;<a href="#" class="btn btn-xs btn-danger" id="reject_out<?=$key->attendance_recap_id?>" onclick="approve_overtime('<?=$key->attendance_recap_id?>','reject_out')">Reject</a>
                            <?
                            unset ($total_jam_pulang_lewat_pagi);
                            //unset ($total_jam_pulang_lewat_sore);
                        }
                        elseif ($key->attendance_recap_time_out_overtime_reject_by > '0')
                        {
                            echo "Ditolak";
                        }
                        ?>
                        </td>
           </tr>
            <?php } ?>
         </tbody>
         </table>
       </div>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
  $(function () {
	 $('#attendance').DataTable({
		 "lengthMenu": [[15, 50, 100, -1], [15, 50, 100, "All"]],
		 "pagingType": "full_numbers"
	 });
   $('#attendance2').DataTable({
		 "lengthMenu": [[15, 50, 100, -1], [15, 50, 100, "All"]],
		 "pagingType": "full_numbers"
	 });
	 $('#start_date').datepicker({
					format: 'yyyy-mm-dd',
					autoclose: true
				});
	$('#end_date').datepicker({
					format: 'yyyy-mm-dd',
					autoclose: true
				});
  });
  
  function approve_overtime(attendance_recap_id,events)
  {
      var attendance_recap_id = attendance_recap_id;
      var events = events;
      
      $.ajax({
         type: "POST",
         url: "<?php echo base_url('hr/attendance_action_overtime');?>",
         data: "attendance_recap_id="+attendance_recap_id+"&events="+events,
         beforeSend: function()
         {
             if (events = 'approve_in')
             {
                 $('#approve_in'+attendance_recap_id).text('Proccessing');
             }
             if (events = 'approve_out')
             {
                 $('#approve_out'+attendance_recap_id).text('Proccessing');
             }
             if (events = 'reject_in')
             {
                 $('#reject_in'+attendance_recap_id).text('Proccessing');
             }
             if (events = 'reject_out')
             {
                 $('#reject_out'+attendance_recap_id).text('Proccessing');
             }
         },
         success: function(msg)
         {
             if (msg = 'success')
             {
                 if (events = 'approve_in')
                 {
                     $('#approve_in'+attendance_recap_id).text('Disetujui');
                 }
                 if (events = 'approve_out')
                 {
                     $('#approve_out'+attendance_recap_id).text('Disetujui');
                 }
                 if (events = 'reject_in')
                 {
                     $('#reject_in'+attendance_recap_id).hide();
                 }
                 if (events = 'reject_out')
                 {
                     $('#reject_out'+attendance_recap_id).hide();
                 }
             }
        }
      });
  }
</script>