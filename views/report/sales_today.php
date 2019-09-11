<script>
  $(function () {
	 $('#sales').DataTable({
		 "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		 "pagingType": "full_numbers"
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

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	
	<!-- Main content -->
	<section class="content">
	  <!-- Small boxes (Stat box) -->
	  <div class="row">
		<div class="col-xs-12">
        <div class="row">
        	<div class="col-xs-2">
        	<a class="btn btn-block btn-success" href="<?=base_url()?>report/sales_searchrekap">Rekap</a>
            </div>
        </div>
        <br>
		  <div class="box box-solid box-warning">
			<div class="box-header">
			  <h3 class="box-title"><?php echo $sub_title;?></h3>
			</div><!-- /.box-header -->
            
			<div class="box-body">
            <?php echo form_open('report/sales_search');?>
            <div class="row">
                	<div class="col-xs-3">
                    	<div class="input-group">
					   <span class="input-group-addon">Kategori</span>
					   <select class="form-control" name="v_kategory">
                       <option value="semua">-Semua-</option>
                       		<?
							foreach($kat AS $dkat)
							{
								?>
                                <option value="<?=$dkat->category_id?>"><?=$dkat->product_category_name?></option>
                                <?
							}
                            ?>
                       </select>
					</div>
                    	
                    </div>
                    <div class="col-xs-3">
                    	<div class="input-group">
					   <span class="input-group-addon">Sub Kategori</span>
					   <select class="form-control" name="v_subkategory">
                       <option value="semua">-Semua-</option>
                       		<?
							foreach($skat AS $dskat)
							{
								?>
                                <option value="<?=$dskat->category_id?>"><?=$dskat->product_category_name?></option>
                                <?
							}
                            ?>
                       </select>
					</div>
                    	
                    </div>
                </div>
                <br>
             <div class="row">
                <div class="col-xs-3">
					<div class="input-group">
					   <span class="input-group-addon">Metode Pembayaran</span>
					   <select class="form-control" name="v_metode">
                       		<option value="semua">Semua</option>
                            
                       		<option value="cash">Tunai</option>
                            <option value="cc">Non Tunai</option>
                            <option value="saldo">Saldo</option>
                            <option value="cashcc">Tunai dan Kartu Kredit/Debit</option>
                       </select>
					</div>
				</div><!-- /.input group -->
				<div class="col-xs-3">
					<div class="input-group">
					 <span class="input-group-addon">Dari :</span>
					  <input type="text" class="form-control" id="start_date" name="start_date" value="<?php echo date('d-m-Y');?>">
					</div><!-- /.input group -->
				</div>
				<div class="col-xs-3">
					<div class="input-group">
					   <span class="input-group-addon">Sampai :</span>
					   <input type="text" class="form-control" id="end_date" name="end_date" value="<?php echo date('d-m-Y');?>">
					</div>
				</div><!-- /.input group -->
                
				<div class="col-xs-1">
					<div class="input-group">
					   <button class="btn btn-block btn-primary">Cari</button>
					</div>
				</div><!-- /.input group -->
				<?php echo form_close();?>
			  </div>
			</div>
			<div class="box-body">
			  <div>
				  <table id="sales" class="table table-bordered table-hover">
					<thead>
					  <tr>
						<th>No.</th>
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
                        $jpc=0;
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
						<!--<td align="right"><?php echo number_format($ppn,0,',','.');?></td>-->
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
                        <th>Total Harga Pokok : <?=number_format($jpc,0,',','.')?></th>
					    <th>Total Harga Jual  : <?=number_format($jtotal,0,',','.')?></th>
                        <th>Diskon     : <?=number_format($jdisc,0,',','.')?></th>
						<th>Sub-Total  : <?=number_format($jtotal-$jdisc,0,',','.')?></th>
						
						<th>Tax        : <?=number_format($jtax,0,',','.')?></th>
     	                <th>Service    : <?=number_format($jservice,0,',','.')?></th>
						<th>Total      : <?=number_format($jsubtotal,0,',','.')?></th>
					  </tr>
					</thead>
                    </table>
                   
			   </div>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->