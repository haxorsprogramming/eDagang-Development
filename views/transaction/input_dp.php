<script>
  $(function () {

	 $('#tgl_acara').datepicker({
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
		  <div class="box box-solid box-warning">
			<div class="box-body">
			<?php					
				if ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';?>
			<!-- form start -->
            <form role="form" action="<?=base_url()?>transaction/submit_dp" method="post">
			<div class="box-body">
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label class=" control-label pull-right">Acara</label>
                        </div>
                       	<div class="col-xs-3">
            			   <input type="text" class="form-control" name="nama_dp" >
            						
            			</div>
                     </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label class=" control-label pull-right">Tgl Acara</label>
                        </div>
                       	<div class="col-xs-3">
            			    <input type="text" class="form-control" id="tgl_acara" name="tgl_acara" value="<?php echo date('d-m-Y');?>">
            						
            			</div>
                     </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label class=" control-label pull-right">Catatan</label>
                        </div>
                       	<div class="col-xs-5">
            			  <textarea class="form-control" rows="4" name="ket_dp"></textarea>
            						
            			</div>
                     </div>
                </div>
                <br>
                 
                 <div class="row">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label class=" control-label pull-right">Total Biaya</label>
                        </div>
                       	<div class="col-xs-5">
            			   <!--<input type="text" maxlength="11" class="form-control" name="total_bayar"  style="text-align: right;">-->
                           <select class="form-control" name="total_bayar">
                          	<?php
        					foreach($ltu AS $dltu)
        					{
        					?>
        						<option value="<?=$dltu->transaction_id?>"><?=$dltu->transaction_code?> -  <?=$dltu->tgl?> - Rp.<?=$dltu->tagihan?></option>
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
                            <label class=" control-label pull-right">Uang Muka Pertama (DP1)</label>
                        </div>
                       	<div class="col-xs-3">
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
                       	<div class="col-xs-3">
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
                       	<div class="col-xs-3">
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
                       	<div class="col-xs-3">
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
                       	<div class="col-xs-3">
            			   <select class="form-control" name="v_jcc" id="v_jcc">
                           <option value="">-Pilih-</option>
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
                       	<div class="col-xs-3">
            			   <input type="text" id="v_nocc" name="v_nocc"   class="form-control"   >
            						
            			</div>
                     </div>
                </div>
              <br>
                 <div class="row">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label class=" control-label pull-right">No Reff</label>
                        </div>
                       	<div class="col-xs-3">
            			   <input type="text" id="v_noref" name="v_noref"   class="form-control"   >
            						
            			</div>
                     </div>
                </div>
			</div><!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" class="btn btn-success pull-right">Simpan</button>
				<a href="<?=base_url()?>transaction" class="btn btn-danger ">Batal</a>
			</div><!-- /.box-footer -->
		   <?php echo form_close();?>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->
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

  
  	function formatCurrency(angka) {
  	 
									var bilangan = parseInt(angka);
	
												var	number_string = bilangan.toString(),
													sisa 	= number_string.length % 3,
													rupiah 	= number_string.substr(0, sisa),
													ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
														
												if (ribuan) {
													separator = sisa ? '.' : '';
													rupiah += separator + ribuan.join('.');
												}

												// Cetak hasil
												//document.write(rupiah); // Hasil: 23.456.789
											//	alert(rupiah);
												return rupiah;
									}
  </script>