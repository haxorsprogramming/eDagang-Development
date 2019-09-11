<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	
	<!-- Main content -->
	<section class="content">
	  <!-- Small boxes (Stat box) -->
	  <div class="row">
		<div class="col-xs-12">
        
        <div class="row">
        	<div class="col-xs-3 col-md-2">
        	<a class="btn btn-block btn-success" href="<?=base_url()?>report/sales_searchrekap">Rekap</a>
            </div>
        </div>
        
        <br>
		  <div class="box box-solid box-success">
			<div class="box-header">
			  <h3 class="box-title"><?php echo $title ." ".$sub_title;?></h3>
			</div><!-- /.box-header -->
			<div class="box-body">
            
			 
				<?php echo form_open('report/sales_search');?>
                <div class="row">
                	<div class="col-xs-12 col-md-3">
                    	<div class="input-group">
                           <span class="input-group-addon">Kategori</span>
                           <select class="form-control" name="v_kategory">
                           <option value="semua">-Semua-</option>
                                <?
                                foreach($kat AS $dkat)
                                {
                                    ?>
                                    <option value="<?=$dkat->category_id?>" <? if($dkat->category_id==$v_kategory){ echo "selected";} ?> ><?=$dkat->product_category_name?></option>
                                    <?
                                }
                                ?>
                           </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3">
                    	<div class="input-group">
                           <span class="input-group-addon">Sub Kategori</span>
                           <select class="form-control" name="v_subkategory">
                           <option value="semua">-Semua-</option>
                                <?
                                foreach($skat AS $dskat)
                                {
                                    ?>
                                    <option value="<?=$dskat->category_id?>" <? if($dskat->category_id==$v_subkategory){ echo "selected";} ?>><?=$dskat->product_category_name?></option>
                                    <?
                                }
                                ?>
                           </select>
                        </div>                    	
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <div class="input-group">
                           <span class="input-group-addon">Metode Pembayaran</span>
                           <select class="form-control" name="v_metode">
                                <option value="semua">Semua</option>
                                <option value="cash">Tunai</option>
                                <option value="cc">Non Tunai</option>
                                <option value="saldo">Compliment</option>
                                <option value="cashcc">Tunai dan Kartu Kredit/Debit</option>
                           </select>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                
				<div class="col-xs-12 col-md-3">
					<div class="input-group">
					 <span class="input-group-addon">Dari :</span>
					  <input type="text" class="form-control" id="start_date" name="start_date" value="<?php echo $start_date;?>">
					</div><!-- /.input group -->
				</div>
				<div class="col-xs-12 col-md-3">
					<div class="input-group">
					   <span class="input-group-addon">Sampai :</span>
					   <input type="text" class="form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>">
					</div>
				</div><!-- /.input group -->
				<div class="col-xs-3 col-md-1">
					<div class="input-group">
					   <button class="btn btn-block btn-primary">Cari</button>
					</div>
				</div><!-- /.input group -->
				<div class="col-xs-3 col-md-1">
					    <div class="input-group">
					       <a class="btn btn-primary pull-right" style="margin-right: 5px;" href="<?php echo base_url().'report'.'/sales_export_to_excel/'.$start_date.'/'.$end_date.'/'.$v_metode.'/'.$v_kategory.'/'.$v_subkategory;?>"><i class="fa fa-download"></i> Export</a>
                        </div>
					</div><!-- /.input group -->
				<?php echo form_close();?>
			  </div>
			</div>
			<div class="box-body">
			  <div>
				  <table id="sales" class="table table-bordered table-hover table-striped">
					<thead>
					  <tr>
						<th>Kode Trx</th>
						<th>Tanggal</th>
						<th>Kategori</th>
						<th>Produk</th>
						<th>Harga Pokok</th>
						<th>Harga Jual</th>
						<th>QTY</th>
                        <th>Diskon</th>
						<th>Sub-Total</th>
						<th>Tax</th>
                        <th>Service</th>
						<!--<th>PPN</th>-->
						<th>Total</th>
					  </tr>
					</thead>
					<tbody>
					<?php
						$no			= 1;
						$subtotal	= 0;
						$totaldis=0;
						$jtotal=0;
						$jdisc=0;
						$jppn=0;
						$jsubtotal=0;
                        $jtax=0;
                        $jservice=0;
                        $stotal=0;
                        $ttunai=0;
                        $ttunainon=0;
                        $tsaldo=0;
                        $jpc=0;
                        $t1Mdc=0;$t1Mcc=0;$t1Vdc=0;$t1Vcc=0;
                        $t2Mdc=0;$t2Mcc=0;$t2Vdc=0;$t2Vcc=0;
                        $t3Mdc=0;$t3Mcc=0;$t3Vdc=0;$t3Vcc=0;
                        $t4Mdc=0;$t4Mcc=0;$t4Vdc=0;$t4Vcc=0;
                        $t5Mdc=0;$t5Mcc=0;$t5Vdc=0;$t5Vcc=0;
                        $t6Mdc=0;$t6Mcc=0;$t6Vdc=0;$t6Vcc=0;
                        $t7Mdc=0;$t7Mcc=0;$t7Vdc=0;$t7Vcc=0;
                        $t8Mdc=0;$t8Mcc=0;$t8Vdc=0;$t8Vcc=0;
                        $t9Mdc=0;$t9Mcc=0;$t9Vdc=0;$t9Vcc=0;
                        $t10Mdc=0;$t10Mcc=0;$t10Vdc=0;$t10Vcc=0;
                        $t11Mdc=0;$t11Mcc=0;$t11Vdc=0;$t11Vcc=0;
                        $t12Mdc=0;$t12Mcc=0;$t12Vdc=0;$t12Vcc=0;
                        $t13Mdc=0;$t13Mcc=0;$t13Vdc=0;$t13Vcc=0;
                        $t14Mdc=0;$t14Mcc=0;$t14Vdc=0;$t14Vcc=0;
                        $t15Mdc=0;$t15Mcc=0;$t15Vdc=0;$t15Vcc=0;
                        
                        //print_r($salesrecord);
						foreach($salesrecord AS $sales)
						{
							$total		=	$sales->selling_price * $sales->qty;
                            $jpc=$jpc+($sales->purchase_price * $sales->qty);
                            $stotal=$stotal+$total;
                            if($sales->tax=='no_taxes'){
                                $disc=0;
                            }else{
                                $disc		=	$total * ($sales->diskon / 100);
                            }
							
							$totaldis	=	$total-($disc);
                            
                            
                            if($sales->tax=='includ_tax' or $sales->tax=='no_taxes' or $sales->customer_group_id=='6'){
                				$tax				= 0;
                				
                			}else{
                				$tax				= $totaldis * ($sales->tax_fare / 100);
                			}
                			//echo 
                			if(($sales->payment_method == "saldo" and $sales->status=='paid') or $sales->order_status=='take_away' or $sales->customer_group_id=='6' or $sales->tax=='no_taxes'){
                				$service			= 0;
                
                			}else{
                					$service			= $totaldis * ($sales->service_fare / 100);
                				
                			}
                            
                            $subtotal=$totaldis+$tax+$service;
                            
                            if($sales->payment_method=='cash'){
                                $ttunai=$ttunai+$subtotal;
                            }
                            if($sales->payment_method=='cc' or $sales->payment_method=='cashcc'){
                                $ttunainon=$ttunainon+$subtotal;
                            }
                            if($sales->payment_method=='saldo'){
                                $tsaldo=$tsaldo+$subtotal;
                            }
                            
                            if($sales->payment_method=='cc' or $sales->payment_method=='cashcc'){
                                
                                if($sales->issuer_id=='1' ){
                                    
                                    if( $sales->jcc=='Mastercard' and $sales->pcc='dc'){
                                        
                                         $t1Mdc=$t1Mdc+$subtotal;
                                    }elseif( $sales->jcc=='Mastercard' and $sales->pcc='cc'){
                                        
                                        $t1Mcc=$t1Mcc+$subtotal; 
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='dc'){
                                        
                                        $t1Vdc=$t1Vdc+$subtotal;   
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='cc'){
                                        
                                        $t1Vcc=$t1Vcc+$subtotal;  
                                    }
                                    
                                   
                                }
                                
                                if($sales->issuer_id=='2' ){
                                    
                                    if( $sales->jcc=='Mastercard' and $sales->pcc='dc'){
                                        
                                         $t2Mdc=$t2Mdc+$subtotal;
                                    }elseif( $sales->jcc=='Mastercard' and $sales->pcc='cc'){
                                        
                                        $t2Mcc=$t2Mcc+$subtotal; 
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='dc'){
                                       
                                        $t2Vdc=$t2Vdc+$subtotal;   
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='cc'){
                                        
                                        $t2Vcc=$t2Vcc+$subtotal;  
                                    }
                                    
                                   
                                }
                                
                                if($sales->issuer_id=='3' ){
                                    
                                    if( $sales->jcc=='Mastercard' and $sales->pcc='dc'){
                                        
                                         $t3Mdc=$t3Mdc+$subtotal;
                                    }elseif( $sales->jcc=='Mastercard' and $sales->pcc='cc'){
                                        
                                        $t3Mcc=$t3Mcc+$subtotal; 
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='dc'){
                                        
                                        $t3Vdc=$t3Vdc+$subtotal;   
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='cc'){
                                        
                                        $t3Vcc=$t3Vcc+$subtotal;  
                                    }
                                    
                                   
                                }
                                if($sales->issuer_id=='4' ){
                                    
                                    if( $sales->jcc=='Mastercard' and $sales->pcc='dc'){
                                        
                                         $t4Mdc=$t4Mdc+$subtotal;
                                    }elseif( $sales->jcc=='Mastercard' and $sales->pcc='cc'){
                                        
                                        $t4Mcc=$t4Mcc+$subtotal; 
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='dc'){
                                        
                                        $t4Vdc=$t4Vdc+$subtotal;   
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='cc'){
                                        
                                        $t4Vcc=$t4Vcc+$subtotal;  
                                    }
                                    
                                   
                                }
                                if($sales->issuer_id=='5' ){
                                    
                                    if( $sales->jcc=='Mastercard' and $sales->pcc='dc'){
                                        
                                         $t5Mdc=$t5Mdc+$subtotal;
                                    }elseif( $sales->jcc=='Mastercard' and $sales->pcc='cc'){
                                        
                                        $t5Mcc=$t5Mcc+$subtotal; 
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='dc'){
                                        
                                        $t5Vdc=$t5Vdc+$subtotal;   
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='cc'){
                                        
                                        $t5Vcc=$t5Vcc+$subtotal;  
                                    }
                                    
                                   
                                }
                                if($sales->issuer_id=='6' ){
                                    
                                    if( $sales->jcc=='Mastercard' and $sales->pcc='dc'){
                                        
                                         $t6Mdc=$t6Mdc+$subtotal;
                                    }elseif( $sales->jcc=='Mastercard' and $sales->pcc='cc'){
                                        
                                        $t6Mcc=$t6Mcc+$subtotal; 
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='dc'){
                                        
                                        $t6Vdc=$t6Vdc+$subtotal;   
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='cc'){
                                        
                                        $t6Vcc=$t6Vcc+$subtotal;  
                                    }
                                    
                                   
                                }
                                if($sales->issuer_id=='7' ){
                                    
                                    if( $sales->jcc=='Mastercard' and $sales->pcc='dc'){
                                        
                                         $t7Mdc=$t7Mdc+$subtotal;
                                    }elseif( $sales->jcc=='Mastercard' and $sales->pcc='cc'){
                                        
                                        $t7Mcc=$t7Mcc+$subtotal; 
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='dc'){
                                        
                                        $t7Vdc=$t7Vdc+$subtotal;   
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='cc'){
                                        
                                        $t7Vcc=$t7Vcc+$subtotal;  
                                    }
                                    
                                   
                                }
                                if($sales->issuer_id=='8' ){
                                    
                                    if( $sales->jcc=='Mastercard' and $sales->pcc='dc'){
                                        
                                         $t8Mdc=$t8Mdc+$subtotal;
                                    }elseif( $sales->jcc=='Mastercard' and $sales->pcc='cc'){
                                        
                                        $t8Mcc=$t8Mcc+$subtotal; 
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='dc'){
                                        
                                        $t8Vdc=$t8Vdc+$subtotal;   
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='cc'){
                                        
                                        $t8Vcc=$t8Vcc+$subtotal;  
                                    }
                                    
                                   
                                }
                                if($sales->issuer_id=='9' ){
                                    
                                    if( $sales->jcc=='Mastercard' and $sales->pcc='dc'){
                                        
                                         $t9Mdc=$t9Mdc+$subtotal;
                                    }elseif( $sales->jcc=='Mastercard' and $sales->pcc='cc'){
                                        
                                        $t9Mcc=$t9Mcc+$subtotal; 
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='dc'){
                                        
                                        $t9Vdc=$t9Vdc+$subtotal;   
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='cc'){
                                        
                                        $t9Vcc=$t9Vcc+$subtotal;  
                                    }
                                    
                                   
                                }
                                if($sales->issuer_id=='10' ){
                                    
                                    if( $sales->jcc=='Mastercard' and $sales->pcc='dc'){
                                        
                                         $t10Mdc=$t10Mdc+$subtotal;
                                    }elseif( $sales->jcc=='Mastercard' and $sales->pcc='cc'){
                                        
                                        $t10Mcc=$t10Mcc+$subtotal; 
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='dc'){
                                        
                                        $t10Vdc=$t10Vdc+$subtotal;   
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='cc'){
                                        
                                        $t10Vcc=$t10Vcc+$subtotal;  
                                    }
                                    
                                   
                                }
                                if($sales->issuer_id=='11' ){
                                    
                                    if( $sales->jcc=='Mastercard' and $sales->pcc='dc'){
                                        
                                         $t11Mdc=$t11Mdc+$subtotal;
                                    }elseif( $sales->jcc=='Mastercard' and $sales->pcc='cc'){
                                        
                                        $t11Mcc=$t11Mcc+$subtotal; 
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='dc'){
                                        
                                        $t11Vdc=$t11Vdc+$subtotal;   
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='cc'){
                                        
                                        $t11Vcc=$t11Vcc+$subtotal;  
                                    }
                                    
                                   
                                }
                                if($sales->issuer_id=='12' ){
                                    
                                    if( $sales->jcc=='Mastercard' and $sales->pcc='dc'){
                                        
                                         $t12Mdc=$t12Mdc+$subtotal;
                                    }elseif( $sales->jcc=='Mastercard' and $sales->pcc='cc'){
                                        
                                        $t12Mcc=$t12Mcc+$subtotal; 
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='dc'){
                                        
                                        $t12Vdc=$t1Vdc+$subtotal;   
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='cc'){
                                        
                                        $t12Vcc=$t12Vcc+$subtotal;  
                                    }
                                    
                                   
                                }
                                if($sales->issuer_id=='13' ){
                                    
                                    if( $sales->jcc=='Mastercard' and $sales->pcc='dc'){
                                        
                                         $t13Mdc=$t13Mdc+$subtotal;
                                    }elseif( $sales->jcc=='Mastercard' and $sales->pcc='cc'){
                                        
                                        $t13Mcc=$t13Mcc+$subtotal; 
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='dc'){
                                        
                                        $t13Vdc=$t13Vdc+$subtotal;   
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='cc'){
                                        
                                        $t13Vcc=$t13Vcc+$subtotal;  
                                    }
                                    
                                   
                                }
                                if($sales->issuer_id=='14' ){
                                    
                                    if( $sales->jcc=='Mastercard' and $sales->pcc='dc'){
                                        
                                         $t14Mdc=$t14Mdc+$subtotal;
                                    }elseif( $sales->jcc=='Mastercard' and $sales->pcc='cc'){
                                        
                                        $t14Mcc=$t14Mcc+$subtotal; 
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='dc'){
                                        
                                        $t14Vdc=$t14Vdc+$subtotal;   
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='cc'){
                                        
                                        $t14Vcc=$t14Vcc+$subtotal;  
                                    }
                                    
                                   
                                }
                                if($sales->issuer_id=='15' ){
                                    
                                    if( $sales->jcc=='Mastercard' and $sales->pcc='dc'){
                                        
                                         $t15Mdc=$t15Mdc+$subtotal;
                                    }elseif( $sales->jcc=='Mastercard' and $sales->pcc='cc'){
                                        
                                        $t15Mcc=$t15Mcc+$subtotal; 
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='dc'){
                                        
                                        $t15Vdc=$t15Vdc+$subtotal;   
                                    }elseif( $sales->jcc=='Visa' and $sales->pcc='cc'){
                                        
                                        $t15Vcc=$t15Vcc+$subtotal;  
                                    }
                                    
                                   
                                }
                              
                                
                                
                            }
                            
							//$ppn		=	$totalts	 * 0.1;
							//$subtotal	=	$totalts + $ppn;
						?>
					  <tr>
						<td><?php echo $sales->transaction_code;?></td>
						<td><?php echo $sales->sales_date;?></td>
						<td><?php echo $sales->product_category_name;?></td>
						<td><?php echo $sales->product_name;?></td>
                        <td align="right"><?php echo number_format($sales->purchase_price,0,',','.');?></td>
						<td align="right"><?php echo number_format($sales->selling_price,0,',','.');?></td>
						<td align="right"><?php echo $sales->qty;?></td>
                        <td align="right">(<?php echo $sales->diskon;?> %) <?php echo number_format($disc,0,',','.');?></td>
						<td align="right"><?php echo number_format($totaldis,0,',','.');?></td>
						<td align="right"><?php echo number_format($tax,0,',','.');?></td>
                        <td align="right"><?php echo number_format($service,0,',','.');?></td>
						<!--<td align="right"><?php //echo number_format($ppn,0,',','.');?></td>-->
						<td align="right"><?php echo number_format($subtotal,0,',','.');?></td>
					  </tr>
					  <?php
					        $jtotal=$jtotal+$total;
							$jdisc=$jdisc+$disc;
						//	$jppn=$jppn+$ppn;
                            $jtax=$jtax+$tax;
                            $jservice=$jservice+$service;
							$jsubtotal=$jsubtotal+$subtotal;
					   };?>
					</tbody>
				  </table>
                  <table id="sales" class="table table-bordered table-hover">
					<thead>
					  <tr>
					    <th>Harga Pokok : <?=number_format($jpc,0,',','.')?></th>
					    <th>Harga Jual : <?=number_format($jtotal,0,',','.')?></th>
                        <th>Diskon : <?=number_format($jdisc,0,',','.')?></th>
						<th>Subtotal : <?=number_format($jtotal-$jdisc,0,',','.')?></th>
						<th>Tax : <?=number_format($jtax,0,',','.')?></th>
     	                <th>Service : <?=number_format($jservice,0,',','.')?></th>
						<th colspan="2">Total : <?=number_format($jsubtotal,0,',','.')?></th>
					  </tr>
                      
                      <tr>
					    <th colspan="8">Total Detail</th>
                      </tr>
                      <tr>
					    <th colspan="2">Total Tunai : <?=number_format($ttunai,0,',','.')?></th>
                        <th colspan="2">Total Non Tunai : <?=number_format($ttunainon,0,',','.')?></th>
                        <th colspan="2">Total Compliment : <?=number_format($tsaldo,0,',','.')?></th>
                        <th colspan="2">Total Belum Bayar : <?=number_format($jsubtotal-$ttunai-$ttunainon-$tsaldo,0,',','.')?></th>
                      </tr>
                      <?php
                      foreach ($salescashier AS $cashier)
                      {
                          $ctotal		=	$cashier->selling_price * $cashier->qty;
                            
                            if($cashier->tax=='no_taxes'){
                                $cdisc=0;
                            }else{
                                $cdisc =	$ctotal * ($cashier->diskon / 100);
                            }
							
							$ctotaldis	=	$ctotal-($cdisc);
                                                        
                            if($cashier->tax=='includ_tax' or $cashier->tax=='no_taxes' or $cashier->customer_group_id=='6')
                            {
                				$ctax = 0;
                				
                			}else{
                				$ctax = $ctotaldis * ($cashier->tax_fare / 100);
                			}
                			//echo 
                			if (($cashier->payment_method == "saldo" and $cashier->status=='paid') or $cashier->order_status=='take_away' or $cashier->customer_group_id=='6' or $cashier->tax=='no_taxes'){
                				$cservice			= 0;
                
                			}else{
                					$cservice = $ctotaldis * ($cashier->service_fare / 100);
                				
                			}
                            
                            $csubtotal=$ctotaldis+$ctax+$cservice;
                          
                        if ($cashier->payment_method=='cash')  
                        {
                            $cttunai=$cttunai+$csubtotal;
                        //}
                      //}
                      ?>
                      <!--
                      Kasir (Tunai)
                       <!--tr>
					    <th colspan="2"><?=$cashier->full_name?></th>
                        <th colspan="6"><?=number_format($cttunai,0,',','.')?></th>
                      </tr-->         
                      <?php } } //}?>
					</thead>
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
	 $('#sales').DataTable({
		 "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		 "pagingType": "full_numbers",
		 "scrollX": true
		/* "dom":"Bfrtip",
		"buttons":['excel','pdf','print']*/


	 });
	 //Date range picker
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