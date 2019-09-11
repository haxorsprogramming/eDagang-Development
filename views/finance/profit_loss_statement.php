<script>
  $(function () {
	 $('#balance_sheet').DataTable({
		 "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
		 "pagingType": "full_numbers",
		 "dom":"Bfrtip",
		 "buttons":['excel','pdf','print']
	 });
	 $('div.dataTables_filter input').focus();
	 $('#tgl1').datepicker({
			format: 'dd-mm-yyyy',
			todayBtn: true,
			todayHighlight: true,
			autoclose: true
		});
        $('#tgl2').datepicker({
			format: 'dd-mm-yyyy',
			todayBtn: true,
			todayHighlight: true,
			autoclose: true
		});
  });
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Main content -->
<section class="content">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box box-solid box-success">
		<div class="box-header">
		  <h3 class="box-title"><?=$sub_title?></h3>
		</div><!-- /.box-header -->
		<div class="box-body">
        <form action="<?=base_url()?>finance/profit_loss_search" method="post">
        <div class="row">
            <div class="col-xs-12 col-md-3">
            	<strong>Tanggal Awal :</strong><input type="text" class="form-control"   value="<?php echo $tgl1;?>" name="tgl1" id="tgl1">
            </div>
            <div class="col-xs-12 col-md-3">
            	<strong>Tanggal Akhir :</strong><input type="text" class="form-control"   value="<?php echo $tgl2;?>" name="tgl2" id="tgl2">
            </div>
            <div class="col-xs-3">
            	<br><button type="submit" class="btn btn-success">Tampil</button>
                </div>
            </div>
            </form>
        </div>
        
		<?php
		if ($this->session->flashdata('message_success'))
			echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
		elseif ($this->session->flashdata('message_error'))
			echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
		?>
		<!--div>
			<p>
			<?php //echo anchor('finance/se_create','Tambah', ['class'=>'btn btn-success']);?>
			</p>
		</div-->
			<div class="row">
			<div class="col-sm-12">
			  <table class="table table-striped table-bordered table-hover">
				 <!-- <tr>
					<th colspan="4">Aktiva</th>
				  </tr>-->
			       <tr>
					<td></td>
                    <td colspan="2"><strong>Pendapatan</strong></td>
                    <td align="right"><strong><?
                   //  print_r($dt11);
                      $jk=0;
                        $jd=0;
                        $jt=0;
                        $jual=0;
                        $biaya=0;
                        $hpp=0;
                        $jpasiva3=0;
                        foreach($dt11 AS $d11){
                            $id=$d11->finance_account_id;
                           $bb=$this->finance_model->detail_accounttgl($id,$tgl1,$tgl2);
                       
                        foreach($bb AS $dbb){
                       
                                if($dbb->debit_kredit == 1){
                                    
                                    $jk=$jk+$dbb->nominal;
                                }
                                
                                if($dbb->debit_kredit == 0){
                                   
                                    $jd=$jd+$dbb->nominal;
                                }
                       }
                       
                        }
                        //$jt=$jk-$jd;
                        $jt=$jd-$jk;
                        $jual=$jt;
					    echo number_format($jt,0,',','.');
                    ?></strong></td>
				  </tr>
                  <tr>
					<td colspan="2"></td>
                    <td >&nbsp;&nbsp;&nbsp;<strong>Pendapatan Unit Bisnis</strong></td>
                    <td align="right"><strong><?
                       $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt11 AS $d11){
                    if(substr($d11->finance_account_code,0,3)=='410'  ){
                            $id=$d11->finance_account_id;
                           $bb=$this->finance_model->detail_accounttgl($id,$tgl1,$tgl2);
                        
                        foreach($bb AS $dbb){
                       
                                if($dbb->debit_kredit == 1){
                                    
                                    $jk=$jk+$dbb->nominal;
                                }
                                
                                if($dbb->debit_kredit == 0){
                                   
                                    $jd=$jd+$dbb->nominal;
                                }
                       }
                       }
                       }
                       //$jt=$jk-$jd;
                       $jt=$jd-$jk;
                       echo number_format($jt,0,',','.');
                  ?></strong>
                  </td>
				  </tr>
                  <?
                  foreach($dt11 AS $d11){
                    if(substr($d11->finance_account_code,0,3)=='410' ){
                            $id=$d11->finance_account_id;
                           $bb=$this->finance_model->detail_accounttgl($id,$tgl1,$tgl2);
                        $jk=0;
                        $jd=0;
                        $jt=0;
                        foreach($bb AS $dbb){
                       
                                if($dbb->debit_kredit == 1){
                                    
                                    $jk=$jk+$dbb->nominal;
                                }
                                
                                if($dbb->debit_kredit == 0){
                                   
                                    $jd=$jd+$dbb->nominal;
                                }
                       }
                       //$jt=$jk-$jd;
                       $jt=$jd-$jk;
                        
                  ?>
                  <tr>
					<td colspan="2">&nbsp;</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$d11->finance_account_name?></td>
                    <td align="right"><? echo number_format($jt,0,',','.');?></td>
				  </tr>
                  <?
                    }
                  }
                  ?>
                  <tr>
					<td colspan="2"></td>
                    <td >&nbsp;&nbsp;&nbsp;<strong>Pendapatan Lain-lain</strong></td>
                    <td align="right"> <strong><?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt11 AS $d11){
                     if(substr($d11->finance_account_code,0,3)=='420'){
                            $id=$d11->finance_account_id;
                           $bb=$this->finance_model->detail_accounttgl($id,$tgl1,$tgl2);
                        
                        foreach($bb AS $dbb){
                       
                                if($dbb->debit_kredit == 1){
                                    
                                    $jk=$jk+$dbb->nominal;
                                }
                                
                                if($dbb->debit_kredit == 0){
                                   
                                    $jd=$jd+$dbb->nominal;
                                }
                       }
                       
                       }
                       }
                       //$jt=$jk-$jd;
                       $jt=$jd-$jk;
                        echo number_format($jt,0,',','.');
                  ?></strong>
                  </td>
				  </tr>
                  
                   <tr>
					<td></td>
                    <td colspan="2"><strong>HPP</strong></td>
                    <td align="right"><strong> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt13 AS $d13){
                     //if(substr($d13->finance_account_code,0,3)=='130' ){
                            $id=$d13->finance_account_id;
                           $bb=$this->finance_model->detail_accounttgl($id,$tgl1,$tgl2);
                        
                        foreach($bb AS $dbb){
                       
                                if($dbb->debit_kredit == 1){
                                    
                                    $jk=$jk+$dbb->nominal;
                                }
                                
                                if($dbb->debit_kredit == 0){
                                   
                                    $jd=$jd+$dbb->nominal;
                                }
                       }
                       
                       //}
                       }
                       $jt=$jk-$jd;
                       $hpp=$jt;
                       
                        echo number_format($jt,0,',','.');
                  ?></strong>
                  </td>
				  </tr>
                  
                   <?
                  foreach($dt13 AS $d13){
                      if(substr($d13->finance_account_code,0,3)=='510'  ){
                            $id=$d13->finance_account_id;
                           $bb=$this->finance_model->detail_accounttgl($id,$tgl1,$tgl2);
                        $jk=0;
                        $jd=0;
                        $jt=0;
                        foreach($bb AS $dbb){
                       
                                if($dbb->debit_kredit == 1){
                                    
                                    $jk=$jk+$dbb->nominal;
                                }
                                
                                if($dbb->debit_kredit == 0){
                                   
                                    $jd=$jd+$dbb->nominal;
                                }
                       }
                       $jt=$jk-$jd;
                        
                  ?>
                  <tr>
					<td colspan="2">&nbsp;</td>
                    <td>&nbsp;&nbsp;&nbsp;<?=$d13->finance_account_name?></td>
                    <td align="right"><? echo number_format($jt,0,',','.');?></td>
				  </tr>
                  <?
                    }
                  }
                  ?>
                  
                  <tr>
					<td></td>
                    <td colspan="2"><strong>Biaya</strong></td>
                    <td align="right"><strong> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                       // print_r($dt2);
                  foreach($dt2 AS $d2){
                     //if(substr($d13->finance_account_code,0,3)=='130' ){
                            $id=$d2->finance_account_id;
                           $bb=$this->finance_model->detail_accounttgl($id,$tgl1,$tgl2);
                        
                        foreach($bb AS $dbb){
                       
                                if($dbb->debit_kredit == 1){
                                    
                                    $jk=$jk+$dbb->nominal;
                                }
                                
                                if($dbb->debit_kredit == 0){
                                   
                                    $jd=$jd+$dbb->nominal;
                                }
                       }
                       
                       //}
                       }
                       $jt=$jk-$jd;
                       $biaya=$jt;
                       
                        echo number_format($jt,0,',','.');
                  ?></strong>
                  </td>
				  </tr>
                  
                   <tr>
					<td colspan="2"></td>
                    <td >&nbsp;&nbsp;&nbsp;<strong> Biaya Overhead </strong></td>
                    <td align="right"><strong> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt2 AS $d2){
                     if(substr($d2->finance_account_code,0,3)=='610' ){
                            $id=$d2->finance_account_id;
                           $bb=$this->finance_model->detail_accounttgl($id,$tgl1,$tgl2);
                        
                        foreach($bb AS $dbb){
                       
                                if($dbb->debit_kredit == 1){
                                    
                                    $jk=$jk+$dbb->nominal;
                                }
                                
                                if($dbb->debit_kredit == 0){
                                   
                                    $jd=$jd+$dbb->nominal;
                                }
                       }
                       
                        }
                       }
                       $jt=$jk-$jd;
                       $jaktiva13=$jt;
                       
                        echo number_format($jt,0,',','.');
                  ?></strong>
                  </td>
				  </tr>
                  
                  <tr>
					<td></td>
                    <td></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Gaji, Honor, Upah, Tunjangan</strong> </td>
                    <td align="right"> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt2 AS $d2){
                     if(substr($d2->finance_account_code,0,9)=='610.01.01' or substr($d2->finance_account_code,0,9)=='610.01.02' or substr($d2->finance_account_code,0,9)=='610.01.03' or substr($d2->finance_account_code,0,9)=='610.01.04' or substr($d2->finance_account_code,0,9)=='610.01.09' or substr($d2->finance_account_code,0,9)=='610.01.10' or substr($d2->finance_account_code,0,9)=='610.01.11' or substr($d2->finance_account_code,0,9)=='610.01.12' or substr($d2->finance_account_code,0,9)=='610.01.17' or substr($d2->finance_account_code,0,9)=='610.01.18' or substr($d2->finance_account_code,0,9)=='610.01.19' or substr($d2->finance_account_code,0,9)=='610.01.20' or substr($d2->finance_account_code,0,9)=='610.01.25' or substr($d2->finance_account_code,0,9)=='610.01.26' or substr($d2->finance_account_code,0,9)=='610.01.27' or substr($d2->finance_account_code,0,9)=='610.01.28' ){
                            $id=$d2->finance_account_id;
                           $bb=$this->finance_model->detail_accounttgl($id,$tgl1,$tgl2);
                        
                        foreach($bb AS $dbb){
                       
                                if($dbb->debit_kredit == 1){
                                    
                                    $jk=$jk+$dbb->nominal;
                                }
                                
                                if($dbb->debit_kredit == 0){
                                   
                                    $jd=$jd+$dbb->nominal;
                                }
                       }
                       
                        }
                       }
                       $jt=$jk-$jd;
                       $jaktiva13=$jt;
                       
                        echo number_format($jt,0,',','.');
                  ?>
                  </td>
				  </tr>
                  
				  <tr>
					<td></td>
                    <td></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Wahid Hasyim </td>
                    <td align="right"> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt2 AS $d2){
                     if(substr($d2->finance_account_code,0,9)=='610.01.01' or substr($d2->finance_account_code,0,9)=='610.01.02' or substr($d2->finance_account_code,0,9)=='610.01.03' or substr($d2->finance_account_code,0,9)=='610.01.04'){
                            $id=$d2->finance_account_id;
                           $bb=$this->finance_model->detail_accounttgl($id,$tgl1,$tgl2);
                        
                        foreach($bb AS $dbb){
                       
                                if($dbb->debit_kredit == 1){
                                    
                                    $jk=$jk+$dbb->nominal;
                                }
                                
                                if($dbb->debit_kredit == 0){
                                   
                                    $jd=$jd+$dbb->nominal;
                                }
                       }
                       
                        }
                       }
                       $jt=$jk-$jd;
                       $jaktiva13=$jt;
                       
                        echo number_format($jt,0,',','.');
                  ?>
                  </td>
				  </tr>
				  
				  <tr>
					<td></td>
                    <td></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Merdeka Walk </td>
                    <td align="right"> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt2 AS $d2){
                     if(substr($d2->finance_account_code,0,9)=='610.01.09' or substr($d2->finance_account_code,0,9)=='610.01.10' or substr($d2->finance_account_code,0,9)=='610.01.11' or substr($d2->finance_account_code,0,9)=='610.01.12'){
                            $id=$d2->finance_account_id;
                           $bb=$this->finance_model->detail_accounttgl($id,$tgl1,$tgl2);
                        
                        foreach($bb AS $dbb){
                       
                                if($dbb->debit_kredit == 1){
                                    
                                    $jk=$jk+$dbb->nominal;
                                }
                                
                                if($dbb->debit_kredit == 0){
                                   
                                    $jd=$jd+$dbb->nominal;
                                }
                       }
                       
                        }
                       }
                       $jt=$jk-$jd;
                       $jaktiva13=$jt;
                       
                        echo number_format($jt,0,',','.');
                  ?>
                  </td>
				  </tr>
				  
				  <tr>
					<td></td>
                    <td></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Studio </td>
                    <td align="right"> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt2 AS $d2){
                     if(substr($d2->finance_account_code,0,9)=='610.01.17' or substr($d2->finance_account_code,0,9)=='610.01.18' or substr($d2->finance_account_code,0,9)=='610.01.19' or substr($d2->finance_account_code,0,9)=='610.01.20'){
                            $id=$d2->finance_account_id;
                           $bb=$this->finance_model->detail_accounttgl($id,$tgl1,$tgl2);
                        
                        foreach($bb AS $dbb){
                       
                                if($dbb->debit_kredit == 1){
                                    
                                    $jk=$jk+$dbb->nominal;
                                }
                                
                                if($dbb->debit_kredit == 0){
                                   
                                    $jd=$jd+$dbb->nominal;
                                }
                       }
                       
                        }
                       }
                       $jt=$jk-$jd;
                       $jaktiva13=$jt;
                       
                        echo number_format($jt,0,',','.');
                  ?>
                  </td>
				  </tr>
				  
				  <tr>
					<td></td>
                    <td></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Beauty </td>
                    <td align="right"> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt2 AS $d2){
                     if(substr($d2->finance_account_code,0,9)=='610.01.25' or substr($d2->finance_account_code,0,9)=='610.01.26' or substr($d2->finance_account_code,0,9)=='610.01.27' or substr($d2->finance_account_code,0,9)=='610.01.28'){
                            $id=$d2->finance_account_id;
                           $bb=$this->finance_model->detail_accounttgl($id,$tgl1,$tgl2);
                        
                        foreach($bb AS $dbb){
                       
                                if($dbb->debit_kredit == 1){
                                    
                                    $jk=$jk+$dbb->nominal;
                                }
                                
                                if($dbb->debit_kredit == 0){
                                   
                                    $jd=$jd+$dbb->nominal;
                                }
                       }
                       
                        }
                       }
                       $jt=$jk-$jd;
                       $jaktiva13=$jt;
                       
                        echo number_format($jt,0,',','.');
                  ?>
                  </td>
				  </tr>
				  
                   <tr>
					<td></td>
                    <td></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>BPJS</strong> </td>
                    <td align="right"> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt2 AS $d2){
                     if(substr($d2->finance_account_code,0,9)=='610.01.05' or substr($d2->finance_account_code,0,9)=='610.01.06' or substr($d2->finance_account_code,0,9)=='610.01.07' or substr($d2->finance_account_code,0,9)=='610.01.13' or substr($d2->finance_account_code,0,9)=='610.01.14' or substr($d2->finance_account_code,0,9)=='610.01.15' or substr($d2->finance_account_code,0,9)=='610.01.21' or substr($d2->finance_account_code,0,9)=='610.01.22' or substr($d2->finance_account_code,0,9)=='610.01.23' or substr($d2->finance_account_code,0,9)=='610.01.29' or substr($d2->finance_account_code,0,9)=='610.01.30' or substr($d2->finance_account_code,0,9)=='610.01.31'){
                            $id=$d2->finance_account_id;
                           $bb=$this->finance_model->detail_accounttgl($id,$tgl1,$tgl2);
                        
                        foreach($bb AS $dbb){
                       
                                if($dbb->debit_kredit == 1){
                                    
                                    $jk=$jk+$dbb->nominal;
                                }
                                
                                if($dbb->debit_kredit == 0){
                                   
                                    $jd=$jd+$dbb->nominal;
                                }
                       }
                       
                        }
                       }
                       $jt=$jk-$jd;
                       $jaktiva13=$jt;
                       
                        echo number_format($jt,0,',','.');
                  ?>
                  </td>
				  </tr>
				  
				  
                   <tr>
					<td></td>
                    <td></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Tunjangan Lain-lain</strong></td>
                    <td align="right"> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt2 AS $d2){
                     if(substr($d2->finance_account_code,0,9)=='610.01.08' or substr($d2->finance_account_code,0,9)=='610.01.16' or substr($d2->finance_account_code,0,9)=='610.01.24' or substr($d2->finance_account_code,0,9)=='610.01.32'){
                            $id=$d2->finance_account_id;
                           $bb=$this->finance_model->detail_accounttgl($id,$tgl1,$tgl2);
                        
                        foreach($bb AS $dbb){
                       
                                if($dbb->debit_kredit == 1){
                                    
                                    $jk=$jk+$dbb->nominal;
                                }
                                
                                if($dbb->debit_kredit == 0){
                                   
                                    $jd=$jd+$dbb->nominal;
                                }
                       }
                       
                        }
                       }
                       $jt=$jk-$jd;
                       $jaktiva13=$jt;
                       
                        echo number_format($jt,0,',','.');
                  ?>
                  </td>
				  </tr>
				  
				  <tr>
					<td></td>
                    <td></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Biaya Overhead (Air, Listrik, Komunikasi, Sewa, Pemeliharaan)</strong></td>
                    <td align="right"> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt2 AS $d2){
                     if(substr($d2->finance_account_code,0,9)=='610.01.33' or substr($d2->finance_account_code,0,9)=='610.01.34' or substr($d2->finance_account_code,0,9)=='610.01.35' or substr($d2->finance_account_code,0,9)=='610.01.36' or substr($d2->finance_account_code,0,9)=='610.01.37' or substr($d2->finance_account_code,0,9)=='610.01.38' or substr($d2->finance_account_code,0,9)=='610.01.39' or substr($d2->finance_account_code,0,9)=='610.01.40' or substr($d2->finance_account_code,0,9)=='610.01.41' or substr($d2->finance_account_code,0,9)=='610.01.42' or substr($d2->finance_account_code,0,9)=='610.01.43' or substr($d2->finance_account_code,0,9)=='610.01.44' or substr($d2->finance_account_code,0,9)=='610.01.45' or substr($d2->finance_account_code,0,9)=='610.01.46' or substr($d2->finance_account_code,0,9)=='610.01.47' or substr($d2->finance_account_code,0,9)=='610.01.48' or substr($d2->finance_account_code,0,9)=='610.01.49' or substr($d2->finance_account_code,0,9)=='610.01.50' or substr($d2->finance_account_code,0,9)=='610.01.51' or substr($d2->finance_account_code,0,9)=='610.01.52' or substr($d2->finance_account_code,0,9)=='610.01.53' or substr($d2->finance_account_code,0,9)=='610.01.54' or substr($d2->finance_account_code,0,9)=='610.01.55' or substr($d2->finance_account_code,0,9)=='610.01.56' or substr($d2->finance_account_code,0,9)=='610.01.57' or substr($d2->finance_account_code,0,9)=='610.01.58' or substr($d2->finance_account_code,0,9)=='610.01.59' or substr($d2->finance_account_code,0,9)=='610.01.60' or substr($d2->finance_account_code,0,9)=='610.01.61' or substr($d2->finance_account_code,0,9)=='610.01.62' or substr($d2->finance_account_code,0,9)=='610.01.63' or substr($d2->finance_account_code,0,9)=='610.01.64' or substr($d2->finance_account_code,0,9)=='610.01.65' or substr($d2->finance_account_code,0,9)=='610.01.66' or substr($d2->finance_account_code,0,9)=='610.01.67' or substr($d2->finance_account_code,0,9)=='610.01.68' or substr($d2->finance_account_code,0,9)=='610.01.69' or substr($d2->finance_account_code,0,9)=='610.01.70' or substr($d2->finance_account_code,0,9)=='610.01.71' or substr($d2->finance_account_code,0,9)=='610.01.72' or substr($d2->finance_account_code,0,9)=='610.01.99'){
                            $id=$d2->finance_account_id;
                           $bb=$this->finance_model->detail_accounttgl($id,$tgl1,$tgl2);
                        
                        foreach($bb AS $dbb){
                       
                                if($dbb->debit_kredit == 1){
                                    
                                    $jk=$jk+$dbb->nominal;
                                }
                                
                                if($dbb->debit_kredit == 0){
                                   
                                    $jd=$jd+$dbb->nominal;
                                }
                       }
                       
                        }
                       }
                       $jt=$jk-$jd;
                       $jaktiva13=$jt;
                       
                        echo number_format($jt,0,',','.');
                  ?>
                  </td>
				  </tr>
				  
				  <tr>
					<td></td>
                    <td></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Wahid Hasyim</td>
                    <td align="right"> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt2 AS $d2){
                     if(substr($d2->finance_account_code,0,9)=='610.01.33' or substr($d2->finance_account_code,0,9)=='610.01.37' or substr($d2->finance_account_code,0,9)=='610.01.41' or substr($d2->finance_account_code,0,9)=='610.01.46' or substr($d2->finance_account_code,0,9)=='610.01.47' or substr($d2->finance_account_code,0,9)=='610.01.49' or substr($d2->finance_account_code,0,9)=='610.01.53' or substr($d2->finance_account_code,0,9)=='610.01.57' or substr($d2->finance_account_code,0,9)=='610.01.58' or substr($d2->finance_account_code,0,9)=='610.01.59' or substr($d2->finance_account_code,0,9)=='610.01.60' or substr($d2->finance_account_code,0,9)=='610.01.61' or substr($d2->finance_account_code,0,9)=='610.01.62' or substr($d2->finance_account_code,0,9)=='610.01.63' or substr($d2->finance_account_code,0,9)=='610.01.64' or substr($d2->finance_account_code,0,9)=='610.01.65' or substr($d2->finance_account_code,0,9)=='610.01.66' or substr($d2->finance_account_code,0,9)=='610.01.67' or substr($d2->finance_account_code,0,9)=='610.01.68' or substr($d2->finance_account_code,0,9)=='610.01.69' or substr($d2->finance_account_code,0,9)=='610.01.70' or substr($d2->finance_account_code,0,9)=='610.01.99'){
                            $id=$d2->finance_account_id;
                           $bb=$this->finance_model->detail_accounttgl($id,$tgl1,$tgl2);
                        
                        foreach($bb AS $dbb){
                       
                                if($dbb->debit_kredit == 1){
                                    
                                    $jk=$jk+$dbb->nominal;
                                }
                                
                                if($dbb->debit_kredit == 0){
                                   
                                    $jd=$jd+$dbb->nominal;
                                }
                       }
                       
                        }
                       }
                       $jt=$jk-$jd;
                       $jaktiva13=$jt;
                       
                        echo number_format($jt,0,',','.');
                  ?>
                  </td>
				  </tr>
				  
				  <tr>
					<td></td>
                    <td></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Merdeka Walk</td>
                    <td align="right"> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt2 AS $d2){
                     if(substr($d2->finance_account_code,0,9)=='610.01.34' or substr($d2->finance_account_code,0,9)=='610.01.38' or substr($d2->finance_account_code,0,9)=='610.01.42' or substr($d2->finance_account_code,0,9)=='610.01.45' or substr($d2->finance_account_code,0,9)=='610.01.48' or substr($d2->finance_account_code,0,9)=='610.01.50' or substr($d2->finance_account_code,0,9)=='610.01.54'){
                            $id=$d2->finance_account_id;
                           $bb=$this->finance_model->detail_accounttgl($id,$tgl1,$tgl2);
                        
                        foreach($bb AS $dbb){
                       
                                if($dbb->debit_kredit == 1){
                                    
                                    $jk=$jk+$dbb->nominal;
                                }
                                
                                if($dbb->debit_kredit == 0){
                                   
                                    $jd=$jd+$dbb->nominal;
                                }
                       }
                       
                        }
                       }
                       $jt=$jk-$jd;
                       $jaktiva13=$jt;
                       
                        echo number_format($jt,0,',','.');
                  ?>
                  </td>
				  </tr>
				  
				  <tr>
					<td></td>
                    <td></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Studio</td>
                    <td align="right"> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt2 AS $d2){
                     if(substr($d2->finance_account_code,0,9)=='610.01.35' or substr($d2->finance_account_code,0,9)=='610.01.43' or substr($d2->finance_account_code,0,9)=='610.01.51' or substr($d2->finance_account_code,0,9)=='610.01.55'){
                            $id=$d2->finance_account_id;
                           $bb=$this->finance_model->detail_accounttgl($id,$tgl1,$tgl2);
                        
                        foreach($bb AS $dbb){
                       
                                if($dbb->debit_kredit == 1){
                                    
                                    $jk=$jk+$dbb->nominal;
                                }
                                
                                if($dbb->debit_kredit == 0){
                                   
                                    $jd=$jd+$dbb->nominal;
                                }
                       }
                       
                        }
                       }
                       $jt=$jk-$jd;
                       $jaktiva13=$jt;
                       
                        echo number_format($jt,0,',','.');
                  ?>
                  </td>
				  </tr>
				  
				  <tr>
					<td></td>
                    <td></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Beauty</td>
                    <td align="right"> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt2 AS $d2){
                     if(substr($d2->finance_account_code,0,9)=='610.01.36' or substr($d2->finance_account_code,0,9)=='610.01.44' or substr($d2->finance_account_code,0,9)=='610.01.52' or substr($d2->finance_account_code,0,9)=='610.01.56'){
                            $id=$d2->finance_account_id;
                           $bb=$this->finance_model->detail_accounttgl($id,$tgl1,$tgl2);
                        
                        foreach($bb AS $dbb){
                       
                                if($dbb->debit_kredit == 1){
                                    
                                    $jk=$jk+$dbb->nominal;
                                }
                                
                                if($dbb->debit_kredit == 0){
                                   
                                    $jd=$jd+$dbb->nominal;
                                }
                       }
                       
                        }
                       }
                       $jt=$jk-$jd;
                       $jaktiva13=$jt;
                       
                        echo number_format($jt,0,',','.');
                  ?>
                  </td>
				  </tr>
				  
                  
                  <tr>
					<td colspan="2"></td>
                    <td >&nbsp;&nbsp;&nbsp;<strong> Biaya Penjualan dan Pemasaran </strong></td>
                    <td align="right"><strong> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt2 AS $d2){
                     if(substr($d2->finance_account_code,0,3)=='620' ){
                            $id=$d2->finance_account_id;
                           $bb=$this->finance_model->detail_accounttgl($id,$tgl1,$tgl2);
                        
                        foreach($bb AS $dbb){
                       
                                if($dbb->debit_kredit == 1){
                                    
                                    $jk=$jk+$dbb->nominal;
                                }
                                
                                if($dbb->debit_kredit == 0){
                                   
                                    $jd=$jd+$dbb->nominal;
                                }
                       }
                       
                        }
                       }
                       $jt=$jk-$jd;
                       $jaktiva13=$jt;
                       
                        echo number_format($jt,0,',','.');
                  ?></strong>
                  </td>
				  </tr>
                  <tr>
					<td colspan="2"></td>
                    <td >&nbsp;&nbsp;&nbsp;<strong> Biaya Administrasi dan Umum </strong></td>
                    <td align="right"><strong> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt2 AS $d2){
                     if(substr($d2->finance_account_code,0,2)=='63' ){
                            $id=$d2->finance_account_id;
                           $bb=$this->finance_model->detail_accounttgl($id,$tgl1,$tgl2);
                        
                        foreach($bb AS $dbb){
                       
                                if($dbb->debit_kredit == 1){
                                    
                                    $jk=$jk+$dbb->nominal;
                                }
                                
                                if($dbb->debit_kredit == 0){
                                   
                                    $jd=$jd+$dbb->nominal;
                                }
                       }
                       
                        }
                       }
                       $jt=$jk-$jd;
                       $jaktiva13=$jt;
                       
                        echo number_format($jt,0,',','.');
                  ?></strong>
                  </td>
				  </tr>
                  
                   <tr>
					<td colspan="2"></td>
                    <td >&nbsp;&nbsp;&nbsp;<strong> Biaya Lain-lain </strong></td>
                    <td align="right"><strong> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt2 AS $d2){
                     if(substr($d2->finance_account_code,0,3)=='650' ){
                            $id=$d2->finance_account_id;
                           $bb=$this->finance_model->detail_accounttgl($id,$tgl1,$tgl2);
                        
                        foreach($bb AS $dbb){
                       
                                if($dbb->debit_kredit == 1){
                                    
                                    $jk=$jk+$dbb->nominal;
                                }
                                
                                if($dbb->debit_kredit == 0){
                                   
                                    $jd=$jd+$dbb->nominal;
                                }
                       }
                       
                        }
                       }
                       $jt=$jk-$jd;
                       $jaktiva13=$jt;
                       
                        echo number_format($jt,0,',','.');
                  ?></strong>
                  </td>
				  </tr>
                  
                  
                  
			  </table>
			</div>
			
			</div>
            </br>
            </br>
			<div class="row">
			<div class="col-sm-12">
			  <table class="table table-striped table-bordered table-hover">
				  <tr>
					<th>TOTAL PENDAPATAN</th>
					<td align="right"><b><?php echo number_format($jual,0,',','.');?></b></td>
				  </tr>
                   <tr>
					<th>TOTAL HPP</th>
					<td align="right"><b><?php echo number_format($hpp,0,',','.');?></b></td>
				  </tr>
                  <tr>
					<th>TOTAL BIAYA</th>
					<td align="right"><b><?php echo number_format($biaya,0,',','.');?></b></td>
				  </tr>
			  </table>
			</div>
            </div>
              </br>   
            <div class="row">
			<div class="col-sm-12">
			  <table class="table table-striped table-bordered table-hover">
				  <tr>
					<th>LABA</th>
					<td align="right"><b><?php echo number_format($jual-$hpp-$biaya,0,',','.');?></b></td>
				  </tr>
			  </table>
			</div>
            </div>
		</div><!-- /.box-body -->
	  </div><!-- /.box -->
	</div><!-- /.col -->
  </div><!-- /.row (main row) -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->