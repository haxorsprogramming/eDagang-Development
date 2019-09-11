<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Content Header (Page header) -->

	<!-- Main content -->
	<section class="content">
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-success">
                <div class="box-header">
                    <h3 class="box-title"><?php echo $panel_info;?></h3>
                </div><!-- /.box-header -->
                  <div class="box-body">
                      <?php echo form_open('hr/'.$link.'/'.$employee_id.'/search','method="get"');?>
                      <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="input-group">
                         <span class="input-group-addon">Dari :</span>
                          <input type="text" class="form-control" id="start_date" name="start_date" value="<?php echo $start_date;?>">
                        </div><!-- /.input group -->
                      </div>
                      <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="input-group">
                           <span class="input-group-addon">Sampai :</span>
                           <input type="text" class="form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>">
                        </div>
                      </div><!-- /.input group -->
                      <div class="col-xs-6 col-sm-4 col-md-2">
                        <div class="input-group">
                           <button class="btn btn-block btn-primary" type="submit">Cari</button>
                        </div>
                      </div><!-- /.input group -->
                      <?php echo form_close();?>
                  </div>
      <div class="box-body table-responsive">
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
			<div class="col-xs-12 table-responsive">
			  <table id="attendance" class="table table-striped table-bordered table-hover">
				<thead>
				  <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Jam Datang</th>
                        <th class="text-center">Keterangan Datang</th>
                        <th class="text-center">Lembur Datang</th>
                        <th class="text-center">Jam Pulang</th>
                        <th class="text-center">Keterangan Pulang</th>
                        <th class="text-center">Lembur Pulang</th>
				  </tr>
				</thead>
				<tbody>
                  <?php $no=1;?>
                  <?php
                  $total_jam = 0;
                  $total_menit = 0;
                  
                  $total_menit_datang_cepat_pagi = 0;
                  $total_menit_datang_cepat_sore = 0;
                  
                  $total_jam_datang_cepat_pagi = 0;
                  $total_jam_datang_cepat_sore = 0;
                  
                  $total_jam_datang_telat_pagi = 0;
                  $total_jam_datang_telat_sore = 0;
                  
                  $total_menit_datang_telat_pagi=0;
                  $total_menit_datang_telat_sore=0;
                  
                  $total_menit_datang_telat_pagi_pemotongan=0;
                  $total_menit_datang_telat_sore_pemotongan=0;
                  
                  $total_menit_pulang_cepat_pagi = 0;
                  $total_menit_pulang_cepat_sore = 0;
                  
                  $total_jam_pulang_cepat_pagi = 0;
                  $total_jam_pulang_cepat_sore = 0;
                  
                  $total_jam_pulang_lewat_pagi = 0;
                  $total_jam_pulang_lewat_sore = 0;
                  
                  $total_jam_datang_cepat_pagi_lembur = 0;
                  $total_jam_datang_cepat_sore_lembur = 0;
                  
                  $total_jam_pulang_lewat_pagi_lembur = 0;
                  $total_jam_pulang_lewat_sore_lembur = 0;
                  
                  $total_jam_telat = 0;
                  $total_jam_lembur = 0;
                  $total_jam_datang_cepat = 0;
                  $total_jam_pulang_lewat = 0;
                  $total_uang_lembur_bersih = 0;
                  
                  foreach ($employee AS $key)
                  {
                      $jam_absen_datang = strtotime(date('H:i:s',strtotime($key->attendance_recap_time_in)));
                      $jam_absen_pulang = strtotime(date('H:i:s',strtotime($key->attendance_recap_time_out)));
                      
                      $jam_absen_datang_lengkap = strtotime(date('d-m-Y H:i:s',strtotime($key->attendance_recap_time_in)));
                      $jam_absen_pulang_lengkap = strtotime(date('d-m-Y H:i:s',strtotime($key->attendance_recap_time_out)));
                      ?>
                    <tr>
    					<td align="center"><?php echo $no++;?></td>
                        <td align="center"><?php echo date('d-m-Y', strtotime($key->attendance_recap_date));?></td>
                        <td align="center"><?php echo date('d-m-Y H:i:s', strtotime($key->attendance_recap_time_in));?></td>
                        <td align="center"><?php
                        // Datang cepat pagi
                        if ($jam_absen_datang <= strtotime($masuk_pagi) && $jam_absen_datang < strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi)) && $jam_absen_datang < strtotime($masuk_sore))
                        {
                            unset($jam_datang_cepat_sore_lembur);
                            $jam_datang_cepat_sore_lembur=0;
                            unset($menit_datang_cepat_sore);
                            $menit_datang_cepat_sore=0;
                            $menit_datang_telat_sore=0;
                            
                            $jam_masuk = strtotime($masuk_pagi);
                            $diff = $jam_masuk - $jam_absen_datang;
                            $jam   = floor($diff / (60 * 60));
                            $menit = $diff - $jam * (60 * 60);
                              
                            $menit_datang_cepat_pagi = floor($menit / 60);
                            $jam_datang_cepat_pagi = $jam;
                              
                            if ($key->attendance_recap_time_in_overtime_approve_by > 0)
                            {
                                $jam_datang_cepat_pagi_lembur = $jam_datang_cepat_pagi;
                                  //echo $total_jam_datang_cepat_pagi_lembur;
                            }

                            echo '<b>- ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit</b>';
                              
                            unset($jam_datang_cepat_sore);
                            $jam_datang_cepat_sore=0;
                            $jam_datang_cepat_pagi_lembur=0;
                            unset($jam_datang_cepat_sore_lembur);
                            $jam_datang_cepat_sore_lembur=0;
                        }
                        // Datang cepat sore
                        elseif ($jam_absen_datang <= strtotime($masuk_sore) && $jam_absen_datang > strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi)) &&
                        $jam_absen_datang < strtotime("+".$maksimum_telat_sore." minutes",strtotime($masuk_sore)))
                        {
                            unset($jam_datang_cepat_sore_lembur);
                            $jam_datang_cepat_sore_lembur=0;
                            unset($menit_datang_cepat_sore);
                            $menit_datang_cepat_sore=0;
                            unset($menit_datang_telat_sore);
                            $menit_datang_telat_sore=0;

                              $jam_masuk = strtotime($masuk_sore);
                              $diff = $jam_masuk - $jam_absen_datang;
                              $jam   = floor($diff / (60 * 60));
                              $menit = $diff - $jam * (60 * 60);
                              
                              $menit_datang_cepat_sore = floor($menit / 60);
                              $jam_datang_cepat_sore = $jam;
                              
                              if ($key->attendance_recap_time_in_overtime_approve_by > 0)
                              {
                                    $jam_datang_cepat_sore_lembur = $jam_datang_cepat_sore;
                                    //echo $total_jam_datang_cepat_sore_lembur;
                              }

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
                            $jam_pulang_cepat_pagi=0;
                            $jam_datang_cepat_sore=0;
                            $jam_datang_cepat_pagi=0;
                            $menit_datang_cepat_sore=0;
                            unset($menit_datang_cepat_pagi);
                              $menit_datang_cepat_pagi=0;
                              unset($menit_datang_telat_pagi);
                            $menit_datang_telat_pagi=0;
                            unset($menit_datang_telat_sore);
                            $menit_datang_telat_sore=0;
                            
                            $jam_masuk = strtotime("+".$toleransi_kehadiran_pagi." minutes",strtotime($masuk_pagi));
                            $diff = $jam_absen_datang - $jam_masuk;
                            $jam   = floor($diff / (60 * 60));
                            $menit = $diff - $jam * (60 * 60);
                            
                            $menit_datang_telat_pagi = floor($menit / 60);
                            $total_menit_to_jam = $total_menit / 60;
                            
                            $jam_datang_telat_pagi = $jam;

                            echo '<b class="text-danger">+ ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit</b>';
                            
                            unset($menit_datang_telat_sore);
                            $menit_datang_telat_sore=0;
                        }
                        // Telat sore
                        elseif ($jam_absen_datang > strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi))
                          && $jam_absen_datang > strtotime("+".$toleransi_kehadiran_sore." minutes",strtotime($masuk_sore))
                          && $jam_absen_datang < strtotime("+".$maksimum_telat_sore." minutes",strtotime($masuk_sore)))
                          {
                              unset($menit_datang_telat_pagi);
                            $menit_datang_telat_pagi=0;
                            unset($menit_datang_telat_sore);
                            $menit_datang_telat_sore=0;
                              
                            $jam_masuk = strtotime("+".$toleransi_kehadiran_sore." minutes",strtotime($masuk_sore));
                            $diff = $jam_absen_datang - $jam_masuk;
                            $jam   = floor($diff / (60 * 60));
                            $menit = $diff - $jam * (60 * 60);
                            
                            $menit_datang_telat_sore = floor($menit / 60);
                            
                            $jam_datang_telat_sore = $jam;

                            echo '<b class="text-danger">+ ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit</b>';
                        }
                        else
                        {
                            echo "Absensi belum lengkap?";
                        }
                        ?>
                      </td>
                      <td>
                        <?php
                        if ($key->attendance_recap_time_in_overtime_approve_by > 0)
                        {
                            echo "Disetujui";
                        }
                        ?>
                      </td> 
                      <td align="center"><?php
                      if ($key->attendance_recap_time_out == '0000-00-00 00:00:00')
                          echo "";
                      else echo date('d-m-Y H:i:s', strtotime($key->attendance_recap_time_out));
                      ?></td>
                      <td align="center"><?php
                        // Pulang cepat pagi
                        if ($jam_absen_pulang < strtotime($jam_pulang_pagi))
                        {
                            unset($jam_pulang_lewat_sore);
                            
                              $diff = $jam_absen_pulang - $jam_pulang_pagi;
                              $jam   = floor($diff / (60 * 60));
                              $menit = $diff - $jam * (60 * 60);
                              
                              $menit_pulang_cepat_pagi = $menit / 60;
                              $jam_pulang_cepat_pagi = $jam;

                              echo '<b>- ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit</b>';
                              $jam_pulang_cepat_sore=0;
                        }
                        // Pulang cepat sore
                        elseif (($jam_absen_datang <= strtotime($masuk_sore) && $jam_absen_datang > strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi)) &&
                        $jam_absen_datang < strtotime("+".$maksimum_telat_sore." minutes",strtotime($masuk_sore))) OR ($jam_absen_datang > strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi))
                          && $jam_absen_datang <= strtotime("+".$toleransi_kehadiran_sore." minutes",strtotime($masuk_sore))
                          && $jam_absen_datang < strtotime("+".$maksimum_telat_sore." minutes",strtotime($masuk_sore))) OR ($jam_absen_datang > strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi))
                          && $jam_absen_datang > strtotime("+".$toleransi_kehadiran_sore." minutes",strtotime($masuk_sore))
                          && $jam_absen_datang < strtotime("+".$maksimum_telat_sore." minutes",strtotime($masuk_sore))) &&  $jam_absen_pulang < $jam_pulang_sore)
                        {
                            unset($jam_pulang_cepat_pagi);
                            $jam_pulang_cepat_pagi=0;
                            
                              $diff = $jam_pulang_sore - $jam_absen_pulang;
                              $jam   = floor($diff / (60 * 60));
                              $menit = $diff - $jam * (60 * 60);
                              
                              $menit_pulang_cepat_sore = $menit / 60;
                              $jam_pulang_cepat_sore = $jam;

                              echo '<b>- ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit</b>';
                              unset($jam_pulang_lewat_pagi);
                              $jam_pulang_lewat_pagi = 0;
                        }
                        // Lebih pagi
                        /* elseif (($jam_absen_datang <= strtotime($masuk_pagi) && $jam_absen_datang < strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi)) && $jam_absen_datang < strtotime($masuk_sore)) OR ($jam_absen_datang <= strtotime("+".$toleransi_kehadiran_pagi." minutes",strtotime($masuk_pagi))
                          && $jam_absen_datang < strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi))) OR ($jam_absen_datang > strtotime("+".$toleransi_kehadiran_pagi." minutes",strtotime($masuk_pagi))
                          && $jam_absen_datang < strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi))
                          ) && $jam_absen_pulang > $jam_pulang_pagi && $key->attendance_recap_time_out !== '0000-00-00 00:00:00') */
                          elseif ((($jam_absen_datang <= strtotime($masuk_pagi) && $jam_absen_datang < strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi)) && $jam_absen_datang < strtotime($masuk_sore)) OR ($jam_absen_datang <= strtotime("+".$toleransi_kehadiran_pagi." minutes",strtotime($masuk_pagi)) && $jam_absen_datang < strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi))) OR ($jam_absen_datang > strtotime("+".$toleransi_kehadiran_pagi." minutes",strtotime($masuk_pagi))
                          && $jam_absen_datang < strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi))
                          )) && $key->attendance_recap_time_out !== "0000-00-00 00:00:00")
                        {
                            $jam_pulang_lewat_sore_lembur=0;
                            $jam_pulang_lewat_pagi_lembur=0;
                            $menit_pulang_cepat_sore=0;
                            unset($jam_pulang_cepat_pagi);
                            $jam_pulang_cepat_pagi=0;
                            $menit_pulang_cepat_pagi=0;
                            $jam_pulang_cepat_sore=0;
                            //unset($total_jam_pulang_lewat_pagi);
                            
                              $diff =  $jam_absen_pulang - $jam_pulang_pagi;
                              $jam   = floor($diff / (60 * 60));
                              $menit = $diff - $jam * (60 * 60);
                              $total_menit = $menit / 60;
                              
                              $jam_pulang_lewat_pagi = $jam;
                              
                              if ($key->attendance_recap_time_out_overtime_approve_by > 0)
                              {
                                    $jam_pulang_lewat_pagi_lembur = $jam_pulang_lewat_pagi;
                                    //echo $total_jam_pulang_lewat_pagi_lembur;
                              }

                              echo '<b class="text-info">+ ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit</b>';
                              
                              unset($jam_pulang_lewat_sore);
                              $jam_pulang_lewat_sore = 0;
                        }
                        // Lebih sore
                        elseif (($jam_absen_datang <= strtotime($masuk_sore) && $jam_absen_datang > strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi)) &&
                        $jam_absen_datang < strtotime("+".$maksimum_telat_sore." minutes",strtotime($masuk_sore))) OR ($jam_absen_datang > strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi))
                          && $jam_absen_datang <= strtotime("+".$toleransi_kehadiran_sore." minutes",strtotime($masuk_sore))
                          && $jam_absen_datang < strtotime("+".$maksimum_telat_sore." minutes",strtotime($masuk_sore))) OR ($jam_absen_datang > strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi))
                          && $jam_absen_datang > strtotime("+".$toleransi_kehadiran_sore." minutes",strtotime($masuk_sore))
                          && $jam_absen_datang < strtotime("+".$maksimum_telat_sore." minutes",strtotime($masuk_sore))) && $jam_absen_pulang > $jam_pulang_sore && $key->attendance_recap_time_out !== '0000-00-00 00:00:00')
                        {                            
                            unset($jam_pulang_lewat_pagi);
                            $jam_pulang_lewat_pagi=0;
                            
                              $diff =  $jam_absen_pulang - $jam_pulang_sore;
                              $jam   = floor($diff / (60 * 60));
                              $menit = $diff - $jam * (60 * 60);
                              
                              $total_menit = $menit / 60;
                              
                              $jam_pulang_lewat_sore = $jam;
                              
                              if ($key->attendance_recap_time_out_overtime_approve_by > 0)
                              {
                                $jam_pulang_lewat_sore_lembur = $jam_pulang_lewat_sore;
                              }

                              echo '<b class="text-info">+ ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit</b>';
                        }
                        else
                        {                            
                            echo "Absensi belum lengkap?";
                        }
                            ?></td>
                            <td>
                                <?php
                                if ($key->attendance_recap_time_out_overtime_approve_by > 0)
                                {
                                    echo "Disetujui";
                                }
                                ?>
                            </td>
                        </tr>
                      <?php
                      //if ($total_jam_pulang_lewat_pagi > 0)
                      //{
                        //echo $menit_datang_telat_sore;
                        
                        $total_jam_pulang_lewat_pagi += $jam_pulang_lewat_pagi;
                        $total_jam_pulang_lewat_sore += $jam_pulang_lewat_sore;
                        
                        $total_menit_datang_cepat_pagi    += $menit_datang_cepat_pagi;
                      $total_menit_datang_cepat_sore    += $menit_datang_cepat_sore;
                      
                      $total_jam_datang_cepat_pagi  += $jam_datang_cepat_pagi;
                      $total_jam_datang_cepat_sore  += $jam_datang_cepat_sore;
                      
                      if ($menit_datang_telat_pagi >= 30)
                      {
                        $total_menit_datang_telat_pagi_pemotongan += $menit_datang_telat_pagi;
                      }
                      
                      if ($menit_datang_telat_sore >= 30)
                      {
                        $total_menit_datang_telat_sore_pemotongan += $menit_datang_telat_sore;
                      }
                      
                      $total_menit_datang_telat_pagi += $menit_datang_telat_pagi;
                      $total_menit_datang_telat_sore += $menit_datang_telat_sore;
                      
                      $total_jam_pulang_cepat_pagi += $jam_pulang_cepat_pagi;
                      $total_jam_pulang_cepat_sore += $jam_pulang_cepat_sore;
                      
                      $total_menit_pulang_cepat_pagi    += $menit_pulang_cepat_pagi;
                      $total_menit_pulang_cepat_sore    += $menit_pulang_cepat_sore;
                      
                        $total_jam_datang_cepat_pagi_lembur += $jam_datang_cepat_pagi_lembur;
                      $total_jam_datang_cepat_sore_lembur += $jam_datang_cepat_sore_lembur;
                      
                      $total_jam_pulang_lewat_pagi_lembur += $jam_pulang_lewat_pagi_lembur;
                      $total_jam_pulang_lewat_sore_lembur += $jam_pulang_lewat_sore_lembur;
                      //}
                  }
                  
                  $total_jam_datang_cepat = round(($total_menit_datang_cepat_pagi + $total_menit_datang_cepat_sore) / 60) + $total_jam_datang_cepat_pagi + $total_jam_datang_cepat_sore;
                  
                  $total_jam_pulang_cepat = round(($total_jam_pulang_cepat_pagi + $total_jam_pulang_cepat_sore) / 60);
                  
                  $total_menit_datang_telat = $total_menit_datang_telat_pagi + $total_menit_datang_telat_sore;
                  $total_menit_datang_telat_pemotongan = $total_menit_datang_telat_pagi_pemotongan + $total_menit_datang_telat_sore_pemotongan;
                  
                  $total_jam_datang_telat = $total_jam_datang_telat_pagi + $total_jam_datang_telat_sore;
                  
                  $total_jam_pulang_lewat = $total_jam_pulang_lewat_pagi + $total_jam_pulang_lewat_sore;
                  
                  $total_jam_lembur = ($total_jam_datang_cepat_pagi_lembur + $total_jam_datang_cepat_sore_lembur + $total_jam_pulang_lewat_pagi_lembur + $total_jam_pulang_lewat_sore_lembur) - 26;
                  if ($total_jam_lembur > 0)
                  {
                    $total_uang_lembur_bersih = $total_jam_lembur * $this->session->userdata('overtime_fare_per_hour');
                  }
                  
                  //echo $total_menit_datang_telat_pemotongan;
                ?>
				</tbody>
                <tfoot>
                    <tr><td colspan="8">&nbsp;</td></tr>
                    <tr>
                        <td colspan="3"><b>Total Datang Cepat</b></td>
                        <td><b><?=$total_jam_datang_cepat?> jam</b></td>
                        <td colspan="2"><b>Total Pulang Cepat</b></td>
                        <td colspan="2"><b><?=$total_jam_pulang_cepat?> jam</b></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-red"><b>Total Keterlambatan</b></td>
                        <td class="text-red"><b><?=floor($total_menit_datang_telat)?> menit</b></td>
                        <td colspan="2" class="text-blue"><b>Total Jam Lebih</b></td>
                        <td colspan="2" class="text-blue"><b><?php echo $total_jam_datang_cepat + $total_jam_pulang_lewat;?> jam</b></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-red"><b>Total Potongan Keterlambatan</b></td>
                        <td class="text-red"><b>Rp. <?php
                        
                        echo number_format(floor($total_menit_datang_telat_pemotongan / 30) * $this->session->userdata('attendance_late_fare'));
                        ?></b></td>
                        <td colspan="2" class="text-orange"><b>Total Jam Lembur</b></td>
                        <td colspan="2" class="text-orange"><b><?php echo $total_jam_lembur;?> jam</b></td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td colspan="2" class="text-orange"><b>Total Uang Lembur</b></td>
                        <td colspan="2" class="text-orange"><b>Rp. <?=number_format($total_uang_lembur_bersih)?></b></td>
                    </tr>
                </tfoot>
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
	 //$('#attendance').DataTable();
    /*$('#attendance2').DataTable({
		 "lengthMenu": [[-1, 15, 25, 100], ["All", 15, 25, 100]],
		 "pagingType": "full_numbers"
	 });*/
	 $('#start_date').datepicker({
					format: 'dd-mm-yyyy',
					autoclose: true
				});
	$('#end_date').datepicker({
					format: 'dd-mm-yyyy',
					autoclose: true
				});
  });
</script>