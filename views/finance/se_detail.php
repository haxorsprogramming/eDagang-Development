<script>
  $(function () {

	$('#finance_journal_date').datepicker({
						format: 'dd-mm-yyyy',
						todayBtn: true,
						todayHighlight: true,
						autoclose: true
					});
					
					


  });
</script>

<?php

foreach($serecord as $row)
{
	$se_id				= $row->se_id;
	$created_by			= $row->created_by;
	$open_shift_time	= date('d-m-Y H:i:s',strtotime($row->open_shift_time));
    $tgl	= date('Y-m-d',strtotime($row->open_shift_time));
	$capital_money		= $row->capital_money;
	$closed_shift_time	= date('d-m-Y H:i:s',strtotime($row->closed_shift_time));
	$income_cash		= $row->income_cash;
	$income_noncash		= $row->income_noncash;
	$total_cash			= $row->total_cash;
    $dptunai		= $row->dptunai;
    $dptunainon		= $row->dptunainon; 
	$total_income		= $row->total_income;
	$actual_money		= $row->actual_money;
	$margin				= $row->margin;
	$closed_shift_notes	= $row->closed_shift_notes;
	$verified_time		= $row->verified_time;
	$verified_by		= $row->verified_by;
    //$total_income=$total_income+$dptunai+$dptunainon	;
           
}
$verified_full_name	= '';
$get_cashier_name = $this->account_model->get_user_by_user_id($created_by);
foreach($get_cashier_name as $cashier)
{
	$cashier_full_name	= $cashier->full_name;
}
if ($verified_time == TRUE)
{
	$get_verified_name = $this->account_model->get_user_by_user_id($verified_by);
	foreach($get_verified_name as $verified)
	{
		$verified_full_name	= $verified->full_name;
	}
}
?>

	<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          <div class="row">
			<div class="col-xs-12">
              <div class="box box-success">
                <div class="box-header">
                    <div class="col-sm-4">
                        <label class="control-label">No. Bukti Kasir</label>
                        <input type="text" class="form-control" value="<?=$se_id?>" disabled>
                    </div>
                    <div class="col-sm-4">
                        <label class="ontrol-label">User ID Kasir</label>
                        <input type="text" class="form-control" value="<?=$created_by?>" disabled>
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Nama Kasir</label>
                        <input type="text" class="form-control" value="<?=$cashier_full_name?>" disabled>
                    </div>
                </div>
                <div class="box-body">
				<?php					
					if ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';?>
					<div class="col-xs-6">
						<div class="box-body">
							<?php					
							//if ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';?>
                            <form role="form" method="post" action="<?=base_url()?>finance/se_verified/<?=$se_id?>">
							<div class="form-horizontal">
								<div class="form-group">
									<label class="col-sm-6 control-label">Buka Kasir</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" value="<?=$open_shift_time?>" disabled>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-6 control-label">Tutup Kasir</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" value="<?php if($closed_shift_time == TRUE) echo $closed_shift_time; else echo '';?>" disabled>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-6 control-label">Saldo Awal</label>
									<div class="col-xs-4">
										<input type="text" style="text-align: right;" id="saldoawal" name="saldoawal" class="form-control" value="<?=number_format($capital_money,0,',','.')?>" readonly="readonly">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-6 control-label">Pendapatan Tunai</label>
									<div class="col-xs-4">
										<!--<input type="number" name="pendapatantunai" id="pendapatantunai" onKeyPress="tot();" onKeyUp="tot();" class="form-control" value="<?=$income_cash?>" readonly> -->
                                        <input style="text-align: right;"  name="pendapatantunai" id="pendapatantunai" onKeyPress="tot();" onKeyUp="tot();" class="form-control" value="<?=number_format($income_cash,0,',','.')?>" readonly="readonly">
									</div>
								</div> 
								<div class="form-group">
									<label class="col-sm-6 control-label">Pendapatan Non Tunai</label>
									<div class="col-xs-4">
									<!--	<input type="number" id="pendapatannontunai" name="pendapatannontunai" onKeyPress="tot();" onKeyUp="tot();" class="form-control" value="<?=$income_noncash?>" readonly>-->
                                        <input style="text-align: right;"  id="pendapatannontunai" name="pendapatannontunai" onKeyPress="tot();" onKeyUp="tot();" class="form-control" value="<?=number_format($income_noncash,0,',','.')?>" readonly="readonly">
									</div>
                                    
								</div>
                                <div class="form-group">
									<label class="col-sm-6 control-label">Uang Muka (DP) Tunai</label>
									<div class="col-xs-4">
									<!--	<input type="number" id="pendapatannontunai" name="pendapatannontunai" onKeyPress="tot();" onKeyUp="tot();" class="form-control" value="<?=$income_noncash?>" readonly>-->
                                        <input style="text-align: right;" name="dptunai"   class="form-control" value="<?=number_format($dptunai,0,',','.')?>" readonly="readonly">
									</div>
                                    
								</div>
                                <div class="form-group">
									<label class="col-sm-6 control-label">Uang Muka (DP) Non Tunai</label>
									<div class="col-xs-4">
									<!--	<input type="number" id="pendapatannontunai" name="pendapatannontunai" onKeyPress="tot();" onKeyUp="tot();" class="form-control" value="<?=$income_noncash?>" readonly>-->
                                        <input style="text-align: right;" name="dptunainon"  class="form-control" value="<?=number_format($dptunainon,0,',','.')?>" readonly="readonly">
									</div>
                                    
								</div>
								<div class="form-group">
									<label class="col-sm-6 control-label">Total Pendapatan Tunai + Non Tunai</label>
									<div class="col-xs-4">
										<input style="text-align: right;"  type="text" id="v_total" name="v_total" class="form-control" value="<?=number_format($total_income,0,',','.')?>" readonly="readonly">
									</div>
								</div>
                                
                                
                                <div class="form-group">
                                <table class="table table-bordered">
                                <tr>
                                    <th colspan="4" align="center">Detail Non Tunai</th>
                                </tr>
                                <tr>
                                    <th>Bank</th>
                                    <th>Jenis</th>
                                     <th>Kredit/Debit</th>
                                     <th>Total</th>
                                </tr>
                                
								<?
                                $tnon=0;
                                $detailbank =$this->finance_model->detailbank($created_by,$tgl);
                               // print_r($detailbank);
                                foreach($detailbank as $db)
                                {
                                    ?>
                                    <tr>
                                    <td><?=$db->issuer_name?></td>
                                    <td><?=$db->jcc?></td>
                                     <td><?
                                            if($db->pcc=='dc'){
                                                echo "Kartu Debit";
                                            }elseif($db->pcc=='cc'){
                                                echo "Kartu Kredit";
                                            }
                                     ?></td>
                                     <td align="right"><?=number_format($db->total,0,',','.')?></td>
                                    </tr>
                                    <?
                                    $tnon=$tnon+$db->total;
                                    }
                                     $detailbankc =$this->finance_model->detailbankcashcc($created_by,$tgl);
                                     foreach($detailbankc as $dbc)
                                {
                                    ?>
                                    <tr>
                                    <td><?=$dbc->issuer_name?></td>
                                    <td><?=$dbc->jcc?></td>
                                     <td><?
                                            if($dbc->pcc=='dc'){
                                                echo "Kartu Debit";
                                            }elseif($dbc->pcc=='cc'){
                                                echo "Kartu Kredit";
                                            }
                                     ?></td>
                                     <td align="right"><?=number_format($dbc->total,0,',','.')?></td>
                                    </tr>
                                    <?
                                    $tnon=$tnon+$dbc->total;
                                    }
                                     
                                ?>
                                <tr>
                                    <td colspan="3" align="center"><strong>TOTAL</strong></td>
                                    <td align="right"><strong><?=number_format($tnon,0,',','.')?></strong></td>
                                </tr>
                                </table>
								</div>
							</div>
						</div><!-- /.box-body -->
					</div>
					<div class="col-xs-6">
						<div class="box-body">
							<div class="form-horizontal">
								<div class="form-group">
									<label class="col-sm-4 control-label">Total Uang Tunai</label>
									<div class="col-xs-4">
										<input style="text-align: right;"  type="text" id="totaluangtunai" name="totaluangtunai" class="form-control" value="<?=number_format($total_cash,0,',','.')?>" readonly="readonly">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Uang di Kasir</label>
									<div class="col-xs-4">
										<input style="text-align: right;"  type="text" id="uangdikasir" name="uangdikasir" class="form-control"  value="<?=number_format($actual_money,0,',','.')?>" readonly="readonly">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Selisih</label>
									<div class="col-xs-3">
										<input type="text" id="selisih" name="selisih" class="form-control" value="<?=number_format($margin,0,',','.')?>" readonly="readonly">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Catatan</label>
									<div class="col-xs-5">
										<textarea class="form-control" id="catatan" name="catatan" rows="5" readonly="readonly"><?=$closed_shift_notes?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Waktu Verifikasi</label>
									<div class="col-xs-4">
										<input type="text"  class="form-control" value="<?=$verified_time?>" readonly="readonly">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Di Verifikasi Oleh</label>
									<div class="col-xs-5">
										<input type="text" class="form-control" value="<?=$verified_full_name?>" readonly="readonly">
									</div>
								</div>
							</div>
						</div><!-- /.box-body -->
					</div>
				</div><!-- /.box-body -->
                <hr>
                <div class="box-body">
                <div class="row" align="center">
                	<div class="form-group">
					<label class="col-sm-3 control-label">Nomor Bukti</label>
					<div class="col-xs-3">
						<input type="text" class="form-control"  name="finance_journal_number">
                        <input type="hidden" class="form-control" value="1" name="finance_journal_type_id">
                        
					</div>
				</div>
                </div>
                <br>
                <div class="row" align="center">
                	<div class="form-group">
					<label class="col-sm-3 control-label">Tanggal</label>
					<div class="col-sm-4">
						<input type="text"  class="form-control" value="<?php echo date("d-m-Y");?>" name="finance_journal_date" id="finance_journal_date">
					</div>
				</div>
                </div>
                <br>
               <!-- <div class="row" align="center">
                	<div class="form-group">
					<label class="col-sm-3 control-label">Keterangan</label>
					<div class="col-xs-5">
						<input type="text"  class="form-control" name="keterangan">
					</div>
				</div>
                </div>-->
                </div>
                
                <div class="box-body">
                <div class="row" align="center">
                <div class="col-xs-12">
                	 <table class="table table-bordered">
					<tr>
						<td align="center"><b>Akun</b></td>
						<td align="center"><b>Debit</b></td>
						<td align="center"><b>Kredit</b></td>
                        <td align="center"><b>Keterangan</b></td>
					</tr>
					<tr>
						<td>
							<div class="col-xs-12">
								<select name="akun1" class="form-control select2">
								<?php
								foreach($account as $acc)
								{
								?>
									<option value="<?php echo $acc->finance_account_id;?>"><?php echo $acc->finance_account_code;?> - <?php echo $acc->finance_account_name;?></option>
								<?php }?>
								</select>
							</div>
						</td>
						<td>
							<div class="col-xs-12">
								<input type="number" id="debit1" name="debit1" class="form-control" style="text-align:right" value="0">
							</div>
						</td>
						<td>
							<div class="col-xs-12">
								<input type="number" id="kredit1" name="kredit1" class="form-control" style="text-align:right" value="0">
							</div>
						</td>
                        <td>
							<div class="col-xs-12">
								<input type="text"  name="ket1" class="form-control">
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="col-xs-12">
								<select name="akun2" class="form-control select2">
								<?php
								foreach($account as $acc)
								{
								?>
									<option value="<?php echo $acc->finance_account_id;?>"><?php echo $acc->finance_account_code;?> - <?php echo $acc->finance_account_name;?></option>
								<?php }?>
								</select>
							</div>
						</td>
						<td>
							<div class="col-xs-12">
								<input type="number" id="debit2" name="debit2" style="text-align:right" value="0" class="form-control">
							</div>
						</td>
						<td>
							<div class="col-xs-12">
								<input type="number" id="kredit2" name="kredit2" style="text-align:right" value="0" class="form-control">
							</div>
						</td>
                        <td>
							<div class="col-xs-12">
								<input type="text"  name="ket2" class="form-control">
							</div>
						</td>
					</tr>
				</table>
                <script>
						$(document).ready(function()
						{   
						$("#debit1").on('focus',function()
						{		
								
								$('#kredit1').val("0")   ;
								
						});
						$("#kredit1").on('focus',function()
						{
								
								$('#debit1').val("0")   ;
						
						});
						
						$("#debit2").on('focus',function()
						{		
								
								$('#kredit2').val("0")   ;
								
						});
						$("#kredit2").on('focus',function()
						{
								
								$('#debit2').val("0")   ;
						
						});
					
					});
				</script>
                </div>
                </div>
                </div>
                
                
				<div class="box-footer">
					<?php
						if($closed_shift_time == TRUE AND $verified_time == FALSE)
						{
						?>
						<button type="submit" value="Verifikasi" class="btn btn-success">Verifikasi</button>
                        </form>
                        <a href="#" class="btn btn-primary" id="btnedit" data-toggle="modal" data-target="#tampilpin">Edit</a>
                        <a href="#" class="btn btn-warning" id="btnprint" style="display:none" >Print</a>
                       <div id="tampilpin" class="modal fade" role="dialog" >
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Masukkan Pin </h4>
              </div>
              <div class="modal-body">
                      <div class="row">
                        <div class="col-md-12"  >
                          
							 <div class="form-group">
                                   <label for="exampleInputEmail1">Pin</label>
									<input type="text"  class="form-control" id="txtpin" >								
								</div>
                                <div class="form-group">
                                  <!-- <a  class="btn btn-success" onClick="btok();" id="btnok">OK</a> -->
                                  <button class="btn btn-success" value="OK" onClick="btok();" id="btnok">OK</button>
								</div>
								
                               
                                    
                       </div>
              </div>
			  
             
            </div>
		

						
          </div>
          </div>

          </div>

                        <script>
						
						$('#btnprint').click(function(){
											
														
							window.open("<?php echo base_url()?>finance/printse_detail/<?=$se_id?>");
												
												return false;
											});
						
						function btok(){	
										 // var id			= str;
										  var txtpin	= $('#txtpin').val();

										  $.ajax({
											 type: "POST",
											 url: "<?php echo base_url();?>account/select_pin",
											 data: "txtpin="+txtpin,
											 success: function(msg){
												 //alert(msg);
													if(msg=='yes'){
														deldis();
														$('#tampilpin').modal('hide');
														$('.modal-backdrop').hide();
                                                        
                                                        $('body').removeClass('modal-open');
                                                        $('.modal-backdrop').remove();
                                                        
														$('#btnprint').show();
														$('#btnedit').hide();
													}else{
														alert('Pin Salah');
													}
																							
												}
										  });
										  $('#catmenut').val("");
										  $("#qtypop").prop('selectedIndex',0);
										}
					
						function toRp(angka){
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
												//alert(rupiah);
												return rupiah;
										}
							
									function tot(){
											var j=parseInt($('#pendapatantunai').val());
											var b=parseInt($('#pendapatannontunai').val());
											var total=j+b;
											//alert(total);
											var cetot=toRp(total);
										  	$('#v_total').val(cetot);
										}
										
										function formatCurrency(num) {
									   num = num.toString().replace(/\$|\./g,'');
									   if(isNaN(num))
									   num = "0";
									   sign = (num == (num = Math.abs(num)));
									   num = Math.floor(num*100+0.50000000001);
									   cents = num;
									   num = Math.floor(num/100).toString();
									   for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
									   num = num.substring(0,num.length-(4*i+3))+'.'+
									   num.substring(num.length-(4*i+3));
									   return (((sign)?'':'-') + num);
									}
										
										
										
										$("#totaluangtunai").keyup(function(){
											var j=$('#totaluangtunai').val();
											var cetot=formatCurrency(j);
											$('#totaluangtunai').val(cetot)
									});
									$("#uangdikasir").keyup(function(){
											var j=$('#uangdikasir').val();
											var cetot=formatCurrency(j);
											$('#uangdikasir').val(cetot)
									});
										
										
										
										
							function deldis(){	
								$('#catatan').removeAttr("readonly");
								$('#selisih').removeAttr("readonly");
								$('#uangdikasir').removeAttr("readonly");
								$('#totaluangtunai').removeAttr("readonly");
								$('#saldoawal').removeAttr("readonly");
								//$('#pendapatantunai').removeAttr("readonly");
								//$('#pendapatannontunai').removeAttr("readonly");
								
							}
						</script>
						<?php
						}
						?>                    
					<a href="<?=base_url()?>finance/se_summary" class="btn btn-danger pull-right">Kembali</a>
				</div><!-- /.box-footer -->
               </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			</div><!-- /.col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->