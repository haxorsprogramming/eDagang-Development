<script>
  $(function () {
	 $('#transaction').DataTable({
		 "lengthMenu": [[15, 50, 100, -1], [15, 50, 100, "All"]],
		 "order": [[ 6, "asc" ]],
		 "pagingType": "full_numbers"
	 });
	 $('div.dataTables_filter input').focus();
	 
	 $('#start_date').datepicker({
						format: 'dd-mm-yyyy',
						todayBtn: true,
						todayHighlight: true,
						autoclose: true
					});
	$('#end_date').datepicker({
						format: 'dd-mm-yyyy',
						todayBtn: true,
						todayHighlight: true,
						autoclose: true
					});
	 
  });
  
  
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
   <?
  // print_r($dp);
   foreach($dp AS $trx){
        $sts=$trx->status_dp;
    }
    if($sts=='DP'){
        ?>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah Uang Muka (DP)</button>
        <?
    }
   ?>
	
</section>
<br />
<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
	<div class="col-xs-12">
	  <div class="box box-solid box-warning">
		<div class="box-body">
		<?php
			$group_id = $this->session->userdata('group_id');
			
			if($this->session->flashdata('message_error'))
			{
				echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
			}
			elseif($this->session->flashdata('message_success'))
			{
				echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
				
			}
			
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' or $group_id == '5' or $group_id == '6' )
			{
			?>
            	<!--<div class="row">
            	  <div class="col-xs-12">
				<?php echo form_open('transaction');?>
				<div class="col-xs-3">
					<div class="input-group">
					 <span class="input-group-addon">Dari :</span>
					  <input type="text" class="form-control" id="start_date" name="start_date" value="<?php echo date('d-m-Y');?>">
					</div>
				</div>
				<div class="col-xs-3">
					<div class="input-group">
					   <span class="input-group-addon">Sampai :</span>
					   <input type="text" class="form-control" id="end_date" name="end_date" value="<?php echo date('d-m-Y');?>">
					</div>
				</div>
				<div class="col-xs-1">
					<div class="input-group">
					   <button class="btn btn-block btn-primary">Cari</button>
					</div>
				</div>
				<div class="col-xs-2">
					
				</div> /.input group 
				<?php echo form_close();?>
			  </div>
              </div>
              <br>-->
              <?
			}
              ?>
		  <table id="transaction" class="table table-striped table-bordered table-hover">
			<thead>
			  <tr>
			    <th class="text-center">Kode Uang Muka (DP)</th>
				<th class="text-center">Acara</th>
				<th class="text-center">Tgl Acara</th>
				<!--th class="text-center">Pemesan</th-->
				<th class="text-center">Kode Transaksi</th>
				<th class="text-center">Status</th>
			
			  </tr>
			</thead>
		
			<tbody>
			<?php
				
				foreach($dp AS $trx)
				{
				    $v_iddp=$trx->id_dp;
                    $v_kodedp=$trx->kode_dp;
                    $nama_dp=$trx->nama_dp;
                    $ket_dp=$trx->ket_dp;
                    $total_bayar=$trx->total_bayar;
                    $tgl_acara=$trx->tgl_acara;
				?>
			  <tr>
			    <td align="center"><a href="<?=base_url()?>transaction/detail_dp/<?=$trx->id_dp?>"><?php echo $trx->kode_dp;?></a></td>
				<td align="center"><?php echo $trx->nama_dp;?></td>
				<td align="center"><?php echo date('d-m-Y', strtotime($trx->tgl_acara));?></td>
			    <td align="center"><a href="<?=base_url()?>transaction/detail/<?=$trx->transaction_code?>"><?=$trx->transaction_code?></a></td>
                <td align="center"><?php if($trx->status_dp=='L'){echo "LUNAS";}else{echo "UANG MUKA";};?></td>
			  </tr>
			  
				<?php }
			  ?>
			</tbody>
		  </table>
		</div><!-- /.box-body -->
        
        	<div class="box-body">
		<?php
			$group_id = $this->session->userdata('group_id');
			
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' or $group_id == '5' or $group_id == '6' )
			{
			?>
            	<!--<div class="row">
            	  <div class="col-xs-12">
				<?php echo form_open('transaction');?>
				<div class="col-xs-3">
					<div class="input-group">
					 <span class="input-group-addon">Dari :</span>
					  <input type="text" class="form-control" id="start_date" name="start_date" value="<?php echo date('d-m-Y');?>">
					</div>
				</div>
				<div class="col-xs-3">
					<div class="input-group">
					   <span class="input-group-addon">Sampai :</span>
					   <input type="text" class="form-control" id="end_date" name="end_date" value="<?php echo date('d-m-Y');?>">
					</div>
				</div>
				<div class="col-xs-1">
					<div class="input-group">
					   <button class="btn btn-block btn-primary">Cari</button>
					</div>
				</div>
				<div class="col-xs-2">
					
				</div> /.input group 
				<?php echo form_close();?>
			  </div>
              </div>
              <br>-->
              <?
			}
              ?>
		  <table id="transaction" class="table table-striped table-bordered table-hover" >
			<thead>
			  <tr>
              <th class="text-center">No.</th>
				<th class="text-center">Tgl DP</th>
				<!--th class="text-center">Pemesan</th-->
				<th class="text-center">Uang Muka</th>
			     <th class="text-center">Metode Pembayaran</th>
                 <th class="text-center">Bank</th>
                 <th class="text-center">Jenis Kartu</th>
                 <th class="text-center">No Kartu</th>
                 <th class="text-center">No Reff</th>
			  </tr>
			</thead>
		
			<tbody>
			<?php
				$no=1;
				foreach($dpdetail AS $dtrx)
				{
				?>
			  <tr>
                <td align="center"><?php echo $no;?></td>
				<td align="center"><?php echo date('d-m-Y H:i:s', strtotime($dtrx->tgl_dp));?></td>
			    <td align="right"><?=number_format($dtrx->rp_dp,0,',','.')?></td>
               <td align="center"><? if($dtrx->payment_methode=='cash' or $dtrx->payment_methode==''){ echo "TUNAI";}else{ echo "NON TUNAI"; }?></td>
               <td align="center"><?=$dtrx->issuer_name?></td>
               <td align="center"><?=$dtrx->jcc?></td>
               <td align="center"><?=$dtrx->nocc?></td>
               <td align="center"><?=$dtrx->noref?></td>
			  </tr>
			  
				<?php
                $no++; 
                }
			  ?>
			</tbody>
		  </table>
          <br />
          <a href="<?=base_url()?>transaction/listdp" class="btn btn-success">Kembali</a>
		</div><!-- /.box-body -->
        
	  </div><!-- /.box -->
	</div><!-- /.col -->
  </div><!-- /.row (main row) -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
      <form method="post" action="<?=base_url()?>transaction/insert_dp_detail">
      <input type="hidden" name="v_iddp" value="<?=$v_iddp?>" />
      <input type="hidden" name="v_kodedp" value="<?=$v_kodedp?>" />
      <input type="hidden" name="nama_dp" value="<?=$nama_dp?>" />
      <input type="hidden" name="ket_dp" value="<?=$ket_dp?>" />
      <input type="hidden" name="total_bayar" value="<?=$total_bayar?>" />
      <input type="hidden" name="tgl_acara" value="<?=$tgl_acara?>" />
      
      
        <div class="row">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label class=" control-label pull-right">Bayar Uang Muka</label>
                        </div>
                       	<div class="col-xs-6">
            			   <input type="text" id="rp_dp" name="rp_dp"   class="form-control"   style="text-align: right;">
            						
            			</div>
                     </div>
                </div>
			      <br>
                 <div class="row">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label class=" control-label pull-right">Status</label>
                        </div>
                       	<div class="col-xs-6">
            			   <select class="form-control" name="v_status">
                            <option value="DP">Uang Muka (DP)</option>
                            <option value="L">Lunas</option>
                           </select>
            						
            			</div>
                     </div>
                </div>
                
                 <br>
                 <div class="row">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label class=" control-label pull-right">Metode Pembayaran</label>
                        </div>
                       	<div class="col-xs-6">
            			   <select class="form-control"  id="v_pm"  name="v_pm" onchange="che()">
                            <option value="cash">TUNAI</option>
                            <option value="cc">NON TUNAI</option>
                           </select>
            						
            			</div>
                     </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-4">
                        <?
                       // print_r($issuerbankrecord);
                        
                        ?>
                            <label class=" control-label pull-right">Bank</label>
                        </div>
                       	<div class="col-xs-6">
            			  	<select id="v_bank" name="v_bank" class="form-control select2" autofocus>
        						<option value="">-- Pilih --</option>
        					<?php
        					foreach($issuerbankrecord AS $issuerbank)
        					{
        					?>
        						<option value="<?=$issuerbank->issuer_id?>"><?=$issuerbank->issuer_name?></option>
        					<?php
        					}
        					?>
        					</select>
            						
            			</div>
                     </div>
                </div>
                 <br>
                 <div class="row">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label class=" control-label pull-right">Jenis Kartu</label>
                        </div>
                       	<div class="col-xs-6">
            			   <select class="form-control" name="v_jcc" id="v_jcc">
                            <option value="VISA">VISA</option>
                            <option value="MASTERCARD">MASTERCARD</option>
                           </select>
            						
            			</div>
                     </div>
                </div>
                 <br>
                 <div class="row">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label class=" control-label pull-right">No Kartu</label>
                        </div>
                       	<div class="col-xs-6">
            			   <input type="text" id="v_nocc" name="v_nocc"   class="form-control"   style="text-align: right;">
            						
            			</div>
                     </div>
                </div>
              <br>
                 <div class="row">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label class=" control-label pull-right">No Reff</label>
                        </div>
                       	<div class="col-xs-6">
            			   <input type="text" id="v_noref" name="v_noref"   class="form-control"   style="text-align: right;">
            						
            			</div>
                     </div>
                </div>
                
                <br>
                 <div class="row">
                    <div class="form-group">
                        <div class="col-sm-8">
                            <input type="submit" value="Simpan" class="btn btn-primary pull-right" />
                        </div>
                       	
                     </div>
                </div>
                
         </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script>
 
        document.getElementById("v_nocc").setAttribute("readonly", true);
        document.getElementById("v_noref").setAttribute("readonly", true);
  function che(){
    
    var ci =document.getElementById("v_pm").value;
    if(ci=='cash'){
        
        document.getElementById("v_nocc").setAttribute("readonly", true);
        document.getElementById("v_noref").setAttribute("readonly", true);
    }else{
        

        document.getElementById("v_nocc").removeAttribute("readonly");
        document.getElementById("v_noref").removeAttribute("readonly");
        
    }
    //alert(ci);
  }
  </script>
