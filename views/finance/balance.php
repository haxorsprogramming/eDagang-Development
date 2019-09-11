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
        <form action="<?=base_url()?>finance/balance_search" method="post">
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
			<div class="col-xs-12 col-md-6">
			  <table class="table table-striped table-bordered table-hover">
				  <tr>
					<th colspan="4">Aktiva</th>
				  </tr>
			       <tr>
					<td></td>
                    <td colspan="2"><strong>Aktiva Lancar</strong></td>
                    <td align="right"><strong><?
                   //  print_r($dt11);
                      $jk=0;
                        $jd=0;
                        $jt=0;
                        $jaktiva11=0;
                        $jaktiva13=0;
                        $jpasiva2=0;
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
                        $jt=$jk-$jd;
                        $jaktiva11=$jt;
					    echo number_format($jt,0,',','.');
                    ?></strong></td>
				  </tr>
                  <tr>
					<td></td>
                    <td colspan="2"><strong>Kas</strong></td>
                    <td align="right"><strong><?
                       $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt11 AS $d11){
                    if(substr($d11->finance_account_code,0,6)=='111.01'  ){
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
                       $jt=$jk-$jd;
                       echo number_format($jt,0,',','.');
                  ?></strong>
                  </td>
				  </tr>
                  <?
                  foreach($dt11 AS $d11){
                    if(substr($d11->finance_account_code,0,6)=='111.01' ){
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
                       $jt=$jk-$jd;
                        
                  ?>
                  <tr>
					<td colspan="2">&nbsp;</td>
                    <td><?=$d11->finance_account_name?></td>
                    <td align="right"><? echo number_format($jt,0,',','.');?></td>
				  </tr>
                  <?
                    }
                  }
                  ?>
                  <tr>
					<td></td>
                    <td colspan="2"><strong>Bank</strong></td>
                    <td align="right"> <strong><?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt11 AS $d11){
                     if(substr($d11->finance_account_code,0,9)=='111.02.01' or substr($d11->finance_account_code,0,9)=='111.02.02' ){
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
                       $jt=$jk-$jd;
                        echo number_format($jt,0,',','.');
                  ?></strong>
                  </td>
				  </tr>
                   <?
                  foreach($dt11 AS $d11){
                    if(substr($d11->finance_account_code,0,9)=='111.02.01' or substr($d11->finance_account_code,0,9)=='111.02.02' ){
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
                       $jt=$jk-$jd;
                        
                  ?>
                  <tr>
					<td colspan="2">&nbsp;</td>
                    <td><?=$d11->finance_account_name?></td>
                    <td align="right"><? echo number_format($jt,0,',','.');?></td>
				  </tr>
                  <?
                    }
                  }
                  ?>
                  <tr>
					<td></td>
                    <td colspan="2"><strong>EDC</strong></td>
                    <td align="right"><strong> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt11 AS $d11){
                     if(substr($d11->finance_account_code,0,9)=='111.02.03' or substr($d11->finance_account_code,0,9)=='111.02.04' or substr($d11->finance_account_code,0,9)=='111.02.05' or substr($d11->finance_account_code,0,9)=='111.02.06' or substr($d11->finance_account_code,0,9)=='111.02.07' ){
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
                       $jt=$jk-$jd;
                        echo number_format($jt,0,',','.');
                  ?></strong>
                  </td>
				  </tr>
                  <!--
                     <?
                  foreach($dt11 AS $d11){
                     if(substr($d11->finance_account_code,0,9)=='111.02.03' or substr($d11->finance_account_code,0,9)=='111.02.04' or substr($d11->finance_account_code,0,9)=='111.02.05' or substr($d11->finance_account_code,0,9)=='111.02.06' or substr($d11->finance_account_code,0,9)=='111.02.07' ){
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
                       $jt=$jk-$jd;
                        
                  ?>
                  <tr>
					<td colspan="2">&nbsp;</td>
                    <td><?=$d11->finance_account_name?></td>
                    <td align="right"><? echo number_format($jt,0,',','.');?></td>
				  </tr>
                  <?
                    }
                  }
                  ?>-->
                  
                    <tr>
					<td></td>
                    <td colspan="2"><strong>Piutang Dagang</strong></td>
                    <td align="right"><strong> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt11 AS $d11){
                     if(substr($d11->finance_account_code,0,3)=='113'){
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
                       $jt=$jk-$jd;
                        echo number_format($jt,0,',','.');
                  ?></strong>
                  </td>
				  </tr>
                  
                      <!--
                     <?
                  foreach($dt11 AS $d11){
                     if(substr($d11->finance_account_code,0,3)=='113' ){
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
                       $jt=$jk-$jd;
                        
                  ?>
                  <tr>
					<td colspan="2">&nbsp;</td>
                    <td><?=$d11->finance_account_name?></td>
                    <td align="right"><? echo number_format($jt,0,',','.');?></td>
				  </tr>
                  <?
                    }
                  }
                  ?>-->
                  <tr>
					<td></td>
                    <td colspan="2"><strong>Piutang Karyawan dan Manajemen</strong></td>
                    <td align="right"><strong> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt11 AS $d11){
                     if(substr($d11->finance_account_code,0,6)=='114.01' or substr($d11->finance_account_code,0,6)=='114.02' or substr($d11->finance_account_code,0,6)=='114.03' or substr($d11->finance_account_code,0,6)=='114.04'){
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
                       $jt=$jk-$jd;
                        echo number_format($jt,0,',','.');
                  ?></strong>
                  </td>
				  </tr>
                  
                   <!--
                     <?
                  foreach($dt11 AS $d11){
                      if(substr($d11->finance_account_code,0,6)=='114.01' or substr($d11->finance_account_code,0,6)=='114.02' or substr($d11->finance_account_code,0,6)=='114.03' or substr($d11->finance_account_code,0,6)=='114.04'){
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
                       $jt=$jk-$jd;
                        
                  ?>
                  <tr>
					<td colspan="2">&nbsp;</td>
                    <td><?=$d11->finance_account_name?></td>
                    <td align="right"><? echo number_format($jt,0,',','.');?></td>
				  </tr>
                  <?
                    }
                  }
                  ?>
                  -->
                  
                   <tr>
					<td></td>
                    <td colspan="2"><strong>Piutang Bill Gantung</strong></td>
                    <td align="right"><strong> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt11 AS $d11){
                     if(substr($d11->finance_account_code,0,6)=='114.05' ){
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
                       $jt=$jk-$jd;
                        echo number_format($jt,0,',','.');
                  ?></strong>
                  </td>
				  </tr>
                  
                  <!--
                     <?
                  foreach($dt11 AS $d11){
                      if(substr($d11->finance_account_code,0,6)=='114.05' ){
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
                       $jt=$jk-$jd;
                        
                  ?>
                  <tr>
					<td colspan="2">&nbsp;</td>
                    <td><?=$d11->finance_account_name?></td>
                    <td align="right"><? echo number_format($jt,0,',','.');?></td>
				  </tr>
                  <?
                    }
                  }
                  ?>
                  -->
                  
                   <tr>
					<td></td>
                    <td colspan="2"><strong>Piutang Lain-Lain</strong></td>
                    <td align="right"><strong> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt11 AS $d11){
                     if(substr($d11->finance_account_code,0,3)=='115' ){
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
                       $jt=$jk-$jd;
                        echo number_format($jt,0,',','.');
                  ?></strong>
                  </td>
				  </tr>
                  
                    <tr>
					<td></td>
                    <td colspan="2"><strong>Persediaan</strong></td>
                    <td align="right"><strong> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt11 AS $d11){
                     if(substr($d11->finance_account_code,0,3)=='116' ){
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
                       $jt=$jk-$jd;
                        echo number_format($jt,0,',','.');
                  ?></strong>
                  </td>
				  </tr>
                  
                    
                     <?
                  foreach($dt11 AS $d11){
                      if(substr($d11->finance_account_code,0,9)=='116.01.01' or substr($d11->finance_account_code,0,9)=='116.01.02'  ){
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
                       $jt=$jk-$jd;
                        
                  ?>
                  <tr>
					<td colspan="2">&nbsp;</td>
                    <td><?=$d11->finance_account_name?></td>
                    <td align="right"><? echo number_format($jt,0,',','.');?></td>
				  </tr>
                  <?
                    }
                  }
                  ?>
                    
                       <tr>
					<td colspan="2"></td>
                    <td ><strong>Persediaan - Beauty</td>
                    <td align="right"><?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt11 AS $d11){
                     if(substr($d11->finance_account_code,0,9)=='116.01.03' or substr($d11->finance_account_code,0,9)=='116.01.04' or substr($d11->finance_account_code,0,9)=='116.01.05'   ){
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
                       $jt=$jk-$jd;
                        echo number_format($jt,0,',','.');
                  ?>
                  </td>
				  </tr>
                  
                   <tr>
					<td></td>
                    <td colspan="2"><strong>Uang Muka Pajak</strong></td>
                    <td align="right"><strong> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt11 AS $d11){
                     if(substr($d11->finance_account_code,0,3)=='117' ){
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
                       $jt=$jk-$jd;
                        echo number_format($jt,0,',','.');
                  ?></strong>
                  </td>
				  </tr>
                  
                   <tr>
					<td></td>
                    <td colspan="2"><strong>Aktiva Tetap</strong></td>
                    <td align="right"><strong> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt13 AS $d13){
                     if(substr($d13->finance_account_code,0,3)=='130' ){
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
                       
                       }
                       }
                       $jt=$jk-$jd;
                       $jaktiva13=$jt;
                       
                        echo number_format($jt,0,',','.');
                  ?></strong>
                  </td>
				  </tr>
                  
                   <?
                  foreach($dt13 AS $d13){
                      if(substr($d13->finance_account_code,0,3)=='130'  ){
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
                    <td><?=$d13->finance_account_name?></td>
                    <td align="right"><? echo number_format($jt,0,',','.');?></td>
				  </tr>
                  <?
                    }
                  }
                  ?>
                  
                  <tr>
					<td></td>
                    <td colspan="2"><strong>Aktiva Lain-Lain</strong></td>
                    <td align="right"><strong> <?
                        $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt13 AS $d13){
                     if(substr($d13->finance_account_code,0,3)=='131' ){
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
                       
                       }
                       }
                       $jt=$jk-$jd;
                        echo number_format($jt,0,',','.');
                  ?></strong>
                  </td>
				  </tr>
                  
			  </table>
			</div>
			<div class="col-xs-12 col-md-6">
			  <table class="table table-striped table-bordered table-hover">
				  <tr>
					<th colspan="4">Pasiva</th>
				  </tr>
			       <tr>
					<td></td>
                    <td colspan="2"><strong>Kewajiban</strong></td>
                    <td align="right"><strong><?
                   //  print_r($dt11);
                      $jk=0;
                        $jd=0;
                        $jt=0;
                        foreach($dt2 AS $d2){
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
                        //$jt=$jk-$jd;
                        $jt=$jd-$jk;
                         $jpasiva2=$jt;
                        
					    echo number_format($jt,0,',','.');
                    ?></strong></td>
				  </tr>
                  <tr>
					<td colspan="2"></td>
                    <td> <strong>Kewajiban Lancar</strong></td>
                    <td align="right"><strong><?
                       $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt2 AS $d2){
                    if(substr($d2->finance_account_code,0,2)=='21' ){
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
                       $jt=$jd-$jk;
                       echo number_format($jt,0,',','.');
                  ?></strong>
                  </td>
				  </tr>
                  
                   <tr>
					<td colspan="2"></td>
                    <td>Hutang Dagang</td>
                    <td align="right"><?
                       $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt2 AS $d2){
                    if(substr($d2->finance_account_code,0,3)=='211' ){
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
                       $jt=$jd-$jk;
                       echo number_format($jt,0,',','.');
                  ?>
                  </td>
				  </tr>
                  
				 <tr>
					<td colspan="2"></td>
                    <td>Biaya Yang Harus Dibayar</td>
                    <td align="right"><?
                       $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt2 AS $d2){
                    if(substr($d2->finance_account_code,0,3)=='212' ){
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
                       $jt=$jd-$jk;
                       echo number_format($jt,0,',','.');
                  ?>
                  </td>
				  </tr>
                   <tr>
					<td colspan="2"></td>
                    <td>Hutang Pajak</td>
                    <td align="right"><?
                       $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt2 AS $d2){
                    if(substr($d2->finance_account_code,0,3)=='213' ){
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
                       $jt=$jd-$jk;
                       echo number_format($jt,0,',','.');
                  ?>
                  </td>
				  </tr>
                  </tr>
                   <tr>
					<td colspan="2"></td>
                    <td>Hutang Kepada Pemegang Saham</td>
                    <td align="right"><?
                       $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt2 AS $d2){
                    if(substr($d2->finance_account_code,0,9)=='210.01.01' ){
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
                       $jt=$jd-$jk;
                       echo number_format($jt,0,',','.');
                  ?>
                  </td>
				  </tr>
                  
                  <tr>
					<td colspan="2"></td>
                    <td> <strong>Kewajiban Tidak Lancar</strong></td>
                    <td align="right"><strong><?
                       $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt2 AS $d2){
                    if(substr($d2->finance_account_code,0,3)=='220' ){
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
                       $jt=$jd-$jk;
                       echo number_format($jt,0,',','.');
                  ?></strong>
                  </td>
				  </tr>
                  
                  <tr>
					<td colspan="2"></td>
                    <td> <strong>Ekuitas</strong></td>
                    <td align="right"><strong><?
                       $jk=0;
                        $jd=0;
                        $jt=0;
                  foreach($dt3 AS $d3){
                    if(substr($d3->finance_account_code,0,1)=='3' ){
                            $id=$d3->finance_account_id;
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
                       $jt=$jd-$jk;
                       $jpasiva3=$jt;
                       echo number_format($jt,0,',','.');
                  ?></strong>
                  </td>
				  </tr>
                  
                     <?
                  foreach($dt3 AS $d3){
                      if(substr($d3->finance_account_code,0,3)=='310'  ){
                            $id=$d3->finance_account_id;
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
                       $jt=$jd-$jk;
                        
                  ?>
                  <tr>
					<td colspan="2">&nbsp;</td>
                    <td><?=$d3->finance_account_name?></td>
                    <td align="right"><? echo number_format($jt,0,',','.');?></td>
				  </tr>
                  <?
                    }
                  }
                  ?>
                  
			  </table>
			</div>
			</div>
			<div class="row">
			<div class="col-xs-12 col-md-6">
			  <table class="table table-striped table-bordered table-hover">
				  <tr>
					<th>TOTAL AKTIVA</th>
					<td align="right"><b><?php $total_aktiva=$jaktiva11+$jaktiva13; echo number_format($total_aktiva,0,',','.');?></b></td>
				  </tr>
			  </table>
			</div>
			<div class="col-xs-12 col-md-6">
			  <table class="table table-striped table-bordered table-hover">
				  <tr>
					<th>TOTAL PASIVA</th>
					<td align="right"><b><?php $total_pasiva=$jpasiva2+$jpasiva3; echo number_format($total_pasiva,0,',','.');?></b></td>
				  </tr>
			  </table>
			</div>
			</div>
            <div class="row">
			<div class="col-xs-12 col-md-6">
			  <table class="table table-striped table-bordered table-hover">
				  <tr>
					<th>SELISIH (AKTIVA-PASIVA)</th>
					<td align="right"><b><?php echo number_format($total_aktiva-$total_pasiva,0,',','.');?></b></td>
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