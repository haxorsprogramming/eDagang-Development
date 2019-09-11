<?php
$group_id = $this->session->userdata('group_id');

foreach($transactionrecord AS $trx)
{
	$transaction_code	= $trx->transaction_code;
	$created_time		= $trx->created_time;
	$table				= $trx->table;
	$status				= $trx->status;
	$order_status		= $trx->order_status;
	$deleted_status		= $trx->deleted_status;
	$remark_table		= $trx->remark_table;
	$note				= $trx->note;
    $payment_method		= $trx->payment_method;
    $customer_group_id =$trx->customer_group_id;
    $customer_id=$trx->customer_id;
    $kasir  =$trx->full_name;
    $remittance  =$trx->remittance;
    $refund  =$trx->refund;
    $jcc  =$trx->jcc;
    $ptime=$trx->payment_time;
    $created_timetrans=$trx->created_timetrans;
		$table_category_id = $trx->table_category_id;
		$reservation_detail_id = $trx->reservation_detail_id;
		$visitor = $trx->visitor;
}

$settings	= $this->setting_model->get_settings();
foreach($settings as $setting)
{
	$company_logo		= $setting->company_logo;
	$company_name		= $setting->company_name;
	$company_address	= $setting->company_address;
}

if($order_status=='reservation'){
	$reservation = $this->transaction_model->get_reservation_id_by_reservation_detail_id($reservation_detail_id);
	foreach ($reservation as $data) {
		$reservation_music_detail_id =	$data->reservation_music_detail_id;
		$reservation_photo_detail_id =	$data->reservation_photo_detail_id;
		$reservation_decor_detail_id =	$data->reservation_decor_detail_id;
		$reservation_beauty_detail_id =	$data->reservation_beauty_detail_id;
		$first_payment = $data->first_payment;
		$request_layout = $data->layout_request;
		$reservation_status = $data->reservation_status;
		$reservation_begin = $data->reservation_begin;
		$reservation_end = $data->reservation_end;
	}


	$data_customer = $this->customer_model->get_data_customer($customer_id);
	foreach ($data_customer as $row) {
		$customer_name = $row->customer_full_name;
		$customer_hp = $row->customer_hp;
		$customer_email = $row->customer_email;
	}

	$tables	= $this->order_model->get_table_category_name($table_category_id);
	foreach($tables AS $table)
	{
	$table_name	= $table->table_category_name;
	}

}else{
$table_list		= $this->transaction_model->get_table_status_by_transaction_code($transaction_code);
foreach($table_list as $tablelist)
{
	$table_status	= $tablelist->table_list_status;
}
if($table_status == 'lock')
	$table_status_value	= 'Terisi';
elseif($table_status == 'unlock')
	$table_status_value	= 'Kosong';
}


?>
<script>
function done_cooked(str)
		{
		  var id	= str;
		  $.ajax({
			 type: "POST",
			 url: "<?php echo base_url();?>production/done_cooked",
			 data: "order_id="+id,

             success: function(msg){
									window.location.href="<?=base_url()?>transaction/detail/<?=$transaction_code?>";
								}

		  });

          //window.location.href="<?=base_url()?>transaction/detail/<?=$transaction_code?>";
          //window.location.reload();
		}
</script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Main content -->
	<section class="content">
	  <!-- Small boxes (Stat box) -->
	  <div class="row">
		<div class="col-md-9">
		  <div class="box box-solid box-success">
			<div class="box-body">
				<?php if ($this->session->flashdata('message_success')) echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
				elseif ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';?>
				<div class="col-sm-3">

					<label>Kode Trx</label>
					<input type="text" class="form-control" value="<?php echo $transaction_code;?>" disabled>
				</div>
				<div class="col-sm-3">
					<label>Waktu Pesan</label>
					<input type="text" class="form-control" value="<?php echo date('d-m-Y H:i:s', strtotime($created_timetrans));?>" disabled>
				</div>
				<?php if($order_status=='reservation'){ ?>
					<div class="col-sm-3">
						<label>Ruang</label>
						<input type="text" class="form-control" value="<?php echo $table_name;?>" disabled>
					</div>
					<div class="col-sm-3">
						<label>Jumlah Tamu</label>
						<input type="text" class="form-control" value="<?php echo $visitor;?>" disabled>
					</div>
			<?php	}else{ ?>
				<div class="col-sm-3">
					<label>Meja</label>
					<input type="text" class="form-control" value="<?php echo $table . ' ('.$table_status_value.')';?>" disabled>
				</div>
			<?php } ?>
				<div class="col-sm-3">
					<label>Status Transaksi</label>
					<input type="text" class="form-control" value="<?php if ($status == 'unpaid' AND $deleted_status == 0)
						{
							echo "BELUM BAYAR";
						}
						elseif($status == 'paid' AND $deleted_status == 0)
						{
							echo "LUNAS";
						}
						elseif($deleted_status == 1)
						{
							echo "BATAL";
						}
						?>" disabled>
				</div>
			</div>
            <?
             if($status=='paid'){
            ?>
        	<div class="box-body">

				<div class="col-sm-3">
					<label>Pelanggan</label>
					<input type="text" class="form-control" value="<?php echo $customer_name;?>" disabled>
				</div>
				<div class="col-sm-3">
					<label>Kasir</label>
					<input type="text" class="form-control" value="<?php echo $kasir;?>" disabled>
				</div>
				<div class="col-sm-3">
					<label>Metode bayar</label>
					<input type="text" class="form-control" value="<?php echo $payment_method;?>" disabled>
				</div>
                <div class="col-sm-3">
					<label>Waktu bayar</label>
					<input type="text" class="form-control" value="<?php echo $ptime;?>" disabled>
				</div>

			</div>

            <div class="box-body">

				<div class="col-sm-3">
					<label>Bayar</label>
					<input type="text" class="form-control" value="<?php echo $remittance;?>" disabled>
				</div>
				<div class="col-sm-3">
					<label>Kembalian</label>
					<input type="text" class="form-control" value="<?php echo $refund;?>" disabled>
				</div>
				<div class="col-sm-3">
					<label>Jenis Kartu Kredit/Debit</label>
					<input type="text" class="form-control" value="<?php echo $jcc;?>" disabled>
				</div>

			</div>

            <?
            }
            ?>
   			<div class="box-body">
			  <table class="table table-striped table-bordered">
				<thead>
				  <tr>
					<th class="text-center">Pemesan</th>
					<th class="text-center">Waktu Pesan</th>
					<th class="text-center">Menu</th>
					<th class="text-center">QTY</th>
					<th class="text-center">@Harga</th>
					<th class="text-center">Catatan</th>
					<th class="text-center">Status</th>
				  </tr>
				</thead>
				<tbody>
				<?php
               // print_r($transactionrecord);
					$price			= 0;
					$discount		= 0;
					$total 			= 0;
					$subtotal 		= 0;
					$tax 			= 0;
					$service 		= 0;
					$grandtotal		= 0;
					$nst="";
					$kon=0;
					$kondone=0;
                    $jtax=0;
					$jservice=0;
                   // print_r($ordersrecord);
					foreach($ordersrecord AS $order)
					{
					   if($status=='paid'){
		                $price		= $order->selling_price;
						$subtotal	= $order->qty * $price;
						$total		+= $subtotal;
						$remark		= $order->remark;
						$discount	= $order->discount;
                        if($order->tax=='no_taxes'){
                                	$discount	= 0;
                            }else{
                                	$discount	= $subtotal * ($discount / 100);
                        }
                        $total=$total-$discount;




                        if($order->tax=='includ_tax' or $order->tax=='no_taxes' or $customer_group_id=='6'){
							$tax				= 0;
							//echo $tax."tax0<br>";
						}else{
						      $tax		= $total * ($this->session->userdata('tax_fare') / 100);
							//echo $tax."tax1<br>";
						}

						//$tax				= $totalbaru * ($this->session->userdata('tax_fare') / 100);
						if($payment_method == "saldo" or $trx->order_status=='take_away' or $customer_group_id=='6' or $order->tax=='no_taxes'){
							$service			= 0;
						}else{
							//if($trx->payment_method == "saldo" or $customer_group_id=='6' ){
								$service	= $total * ($this->session->userdata('service_fare') / 100);
						}


						$grandtotal	= $total + $tax + $service;
					   }else{

							 					 $price		= $order->selling_price;
							 $subtotal	= $order->qty * $price;
							 $total		+= $subtotal;
							 $remark		= $order->remark;
							 $discount	= $order->discount;
							 if($order->tax=='no_taxes'){
							 				 $discount	= 0;
							 	 }else{
							 				 $discount	= $subtotal * ($discount / 100);
							 }
							 $total=$total-$discount;




							 if($order->tax=='includ_tax' or $order->tax=='no_taxes' or $customer_group_id=='6'){
							 $tax				= 0;
							 //echo $tax."tax0<br>";
							 }else{
							 $tax		= $total * ($this->session->userdata('tax_fare') / 100);
							 //echo $tax."tax1<br>";
							 }

							 //$tax				= $totalbaru * ($this->session->userdata('tax_fare') / 100);
							 if($payment_method == "saldo" or $trx->order_status=='take_away' or $customer_group_id=='6' or $order->tax=='no_taxes'){
							 $service			= 0;
							 }else{
							 //if($trx->payment_method == "saldo" or $customer_group_id=='6' ){
							 $service	= $total * ($this->session->userdata('service_fare') / 100);
							 }
							 $grandtotal	= $total + $tax + $service;

					   }

					?>
				  <tr>
					<td><?php echo $order->full_name;?></td>
					<td align="center"><?php echo date('d-m-Y H:i:s',strtotime($order->created_time));?></td>
					<td>
                    <?
                    if ($order->status != 'done' and $trx->status != 'canceled' and $trx->status != 'paid' and ($group_id == '1' OR $group_id == '2' OR $group_id == '4' OR $group_id == '5') ){
                        ?>
                        <button type="button" onclick="done_cooked(<?php echo $order->order_id;?>)" class="btn btn-success btn-xs">Segera Hantar</button>
                        <?
                    }
                    ?>
                    <?php echo $order->product_name ;?>
                    </td>
					<td align="center">
							<div class="container-fluid" id='col_qty'>
							<div class="col-sm-8">
								<input type='number' class="form-control" id='qty<?php echo $order->order_id?>' value="<?php echo $order->qty;?>" disabled>
								<input type="text" class="hidden" id='order_id<?php echo $order->order_id?>' value="<?php echo $order->order_id?>">
							</div>
							<?
							if ($order->status != 'done' and $trx->status != 'canceled' and $trx->status != 'paid'  and ($group_id == '1' OR $group_id == '2' OR $group_id == '4' OR $group_id == '5') ){
							?>
							<div class="col-sm-1">
								<button type="button" class="btn btn-warning" id="edit_qty<?php echo $order->order_id?>"><span id="icon<?php echo $order->order_id?>" class="glyphicon glyphicon-pencil"><span></button>
							</div>
							<?
							  }
							  ?>
						</div>
						<script type="text/javascript">
							$(document).ready(function(){
								$('#edit_qty<?php echo $order->order_id?>').click(function(){
									$('#qty<?php echo $order->order_id?>').removeAttr('disabled');
									$('#icon<?php echo $order->order_id?>').removeClass('glyphicon-pencil');
									$('#edit_qty<?php echo $order->order_id?>').removeClass('btn-warning');
									$('#edit_qty<?php echo $order->order_id?>').addClass('btn-success');
									$('#icon<?php echo $order->order_id?>').addClass('glyphicon-ok');
									$('#edit_qty<?php echo $order->order_id?>').attr('onclick','simpan_edit<?php echo $order->order_id?>()');
								});
							});
								function simpan_edit<?php echo $order->order_id?>(){
									var jumlah = $('#qty<?php echo $order->order_id?>').val();
									var order_id = $('#order_id<?php echo $order->order_id?>').val();
									$('#col_qty').html('Sedang memproses..');
									$.ajax({
										type:"POST",
										url:"<?php echo base_url()?>transaction/edit_qty_order",
										data:"order_id="+order_id+"&&qty="+jumlah,
										success: function(msg){
				 							location.reload();
				 						}
									});
								}
						</script>
					</td>
					<td align="center"><?php echo number_format($price,0,',','.');?></td>
					<td><?php echo $remark;?></td>
					<td><?php
					if($order->status == 'reserved')
					{
						echo "Baru";
					}
					elseif($order->status == 'inprogress')
					{
						echo "Diproses";
					}
					elseif($order->status == 'finished')
					{
						echo "Dihantar";
					}
					elseif($order->status == 'done')
					{
						echo "Selesai";
						$kondone++;
					}
					elseif($order->status == 'canceled')
					{
						echo "Dibatalkan";
					}
					if($order->tax=='no_taxes' or $order->status == 'done' or $order->group_id==15 or $order->group_id==17){
						$kondone++;
					}

					?></td>
				  </tr>
				  <?php
				  	$kon++;
				  };
				  //echo "kon".$kon."-".$kondone;
				  ?>
				   <tr>
					<td colspan="7">
						<div class="col-sm-3">
							<label>Subtotal</label>
							<input type="text" class="form-control" value="<?php echo number_format($total,0,',','.');?>" disabled>
						</div>
						<div class="col-sm-3">
							<label>Disc.</label>
							<input type="text" class="form-control" value="<?php echo number_format($discount,0,',','.');?>" disabled>
						</div>
						<div class="col-sm-3">
							<label>Total</label>
							<input type="text" class="form-control" value="<?php echo number_format($total,0,',','.');?>" disabled>
						</div>
						<div class="col-sm-3">
							<label>Tax + Service</label>
							<input type="text" class="form-control" value="<?php echo number_format($tax,0,',','.')?> + <?php echo number_format($service,0,',','.');?>" disabled>
						</div>
					</td>
				  </tr>
				</tbody>
			  </table>
<?php if($order_status=='reservation'){
 $total_music=0;
 $total_dekor=0;
 $total_photo=0;
 $total_beauty=0;
 	?>
				<br>
				<b>Reservation Request</b>
				<br>
				<script type="text/javascript">
				function deletePhoto(str)
				{
					var pid			= str;
					//alert(remark);
					$('#photo_request').html("...............loading.........");
					$.ajax({
					 type: "POST",
					 url: "<?php echo base_url();?>order/delete_photo_request",
					 data: "id="+pid,
					 success: function(msg){
							location.reload();
						}
					});
					//
				}

				function deleteMusic(str)
				{
					var pid			= str;
					//alert(remark);
					$('#music_request').html("...............loading.........");
					$.ajax({
					 type: "POST",
					 url: "<?php echo base_url();?>order/delete_music_request",
					 data: "id="+pid,
					 success: function(msg){
							location.reload();
						}
					});
					//
				}

				function deleteBeauty(str)
				{
					var pid			= str;
					//alert(remark);
					$('#beauty_request').html("...............loading.........");
					$.ajax({
					 type: "POST",
					 url: "<?php echo base_url();?>order/delete_beauty_request",
					 data: "id="+pid,
					 success: function(msg){
							location.reload();
						}
					});
					//
				}

				function deleteDekor(str)
				{
					var pid			= str;
					//alert(remark);
					$('#dekor_request').html("...............loading.........");
					$.ajax({
					 type: "POST",
					 url: "<?php echo base_url();?>order/delete_dekor_request",
					 data: "id="+pid,
					 success: function(msg){
							location.reload();
						}
					});
					//
				}

				</script>
				<table class="table">
					<tr>
						<th>Pelanggan</th><td>:  <?php echo $customer_name ?></td>
					</tr>
					<tr>
						<th>Nomor HP</th><td>:  <?php echo $customer_hp ?></td>
					</tr>
					<tr>
						<th>Email</th><td>:  <?php echo $customer_email ?></td>
					</tr>
					<tr>
						<th>Request Layout</th><td>:  <?php echo $request_layout ?></td>
					</tr>
					<tr id='Tanggal_Reservasi'>
						<th>Dari</th>
						<td><div class='col-md-10'><input type="text" id='dari' name='dari_tanggal' value="<?php echo $reservation_begin ?>" class="form-control" disabled></div></td>
						<th>Sampai</th>
						<td><div class='col-md-10'><input type='text' class="form-control" id='sampai' name='sampai_tanggal' value="<?php echo $reservation_end ?>" disabled></div></td>
						<td><button class="btn btn-sm btn-warning" type="button" id='btn'>Edit</button></td>
						<script type="text/javascript">
							$(document).ready(function(){
								$('#btn').click(function(){
									$('#sampai').removeAttr('disabled');
									$('#dari').removeAttr('disabled');
									$('#btn').removeClass('btn-warning');
									$('#btn').addClass('btn-success');
									$('#btn').html("Simpan");
									$('#btn').attr("onclick","Edit_tanggal()")
									$('#btn').prop('id','btn-simpan');
								});
							});

							function Edit_tanggal(){
								var dari = $('#dari').val();
								var sampai = $('#sampai').val();
								var reservation_id = <?=$reservation_detail_id?>;
								$('#Tanggal_Reservasi').html('<div class="alert alert-info">Sedang Di Proses...</div>');
								$.ajax({
								 type: "POST",
								 url: "<?php echo base_url();?>transaction/edit_tanggal_reservasi",
								 data: "dari="+dari+"&&sampai="+sampai+"&&reservation_id="+reservation_id,
											 success: function(msg){
														location.reload();
													}
								});
							}
						</script>
					</tr>
				</table>
				<?php $reservation_beauty = $this->transaction_model->get_reservation_beauty_by_detail_id($reservation_beauty_detail_id);
				?>
				<table id='beauty_request' class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Kode Pesanan</th>
							<th>Reservation Beauty Detail</th>
							<th>Reservation Beauty Price</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php $kode_beauty=''; foreach ($reservation_beauty as $row): ?>
							<tr>
								<td><?php echo $kode_beauty=$row->reservation_beauty_detail_id ?></td><td><input type="text" value="<?php echo $row->reservation_beauty_request ?>" class="form-control" id='reservation_beauty_request<?=$row->reservation_beauty_id?>' disabled></td>
								<td><input type="text" class="form-control" id='reservation_beauty_price<?=$row->reservation_beauty_id?>' disabled value="<?php $jumlah_beauty= $row->reservation_beauty_price; echo $jumlah_beauty ?>"</td>
								<td><button type="button" class="btn btn-warning" id='btn-b<?=$row->reservation_beauty_id?>'>Edit</td>
									<script type="text/javascript">
										$(document).ready(function(){
											$('#btn-b<?=$row->reservation_beauty_id?>').click(function(){
												$('#reservation_beauty_request<?=$row->reservation_beauty_id?>').removeAttr('disabled');
												$('#reservation_beauty_price<?=$row->reservation_beauty_id?>').removeAttr('disabled');
												$('#btn-b<?=$row->reservation_beauty_id?>').removeClass('btn-warning');
												$('#btn-b<?=$row->reservation_beauty_id?>').addClass('btn-success');
												$('#btn-b<?=$row->reservation_beauty_id?>').html('Simpan');
												$('#btn-b<?=$row->reservation_beauty_id?>').attr('onclick','edit_beauty<?=$row->reservation_beauty_id?>()');
												$('#btn-b<?=$row->reservation_beauty_id?>').prop('id','btn-be<?=$row->reservation_beauty_id?>');
											});
										});

										function edit_beauty<?=$row->reservation_beauty_id;?>(){
											var detail_beauty_request<?=$row->reservation_beauty_id;?> = $('#reservation_beauty_request<?=$row->reservation_beauty_id;?>').val();
											var detail_beauty_price<?=$row->reservation_beauty_id;?> = $('#reservation_beauty_price<?=$row->reservation_beauty_id;?>').val();
											var id<?=$row->reservation_beauty_id;?> = <?=$row->reservation_beauty_id;?>;

											$('#beauty_request').html('<div class="alert alert-info">Proses edit sedang dilakukan...</div>');
											$.ajax({
												type:"POST",
												url:"<?php echo base_url()?>transaction/edit_reservation_beauty",
												data:"id="+id<?=$row->reservation_beauty_id;?>+"&&detail_beauty_request="+detail_beauty_request<?=$row->reservation_beauty_id;?>+"&&detail_beauty_price="+detail_beauty_price<?=$row->reservation_beauty_id;?>,
												success: function(msg){
														location.reload();
												}
											});
										}
									</script>
									<td align="center"><a  onclick="deleteBeauty('<?php echo $row->reservation_beauty_id?>')"  class="glyphicon glyphicon-remove"></a></td>
					<?php
					$total_beauty+=$jumlah_beauty;
				endforeach; ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="2">Total</td><td><?php echo number_format($total_beauty,0,',','.'); ?></td>
						</tr>
					</tfoot>
				</table>
				<button type="button" id='tambah_beauty' class="btn btn-primary" data-toggle="modal" data-target="#modals">Tambah Beauty</button>
				<?php $reservation_photo = $this->transaction_model->get_reservation_photo_by_detail_id($reservation_photo_detail_id);
				?>
				<br>
				<br>
				<table id='photo_request' class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Kode Pesanan</th>
							<th>Reservation Photo Detail</th>
							<th>Reservation Photo Price</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					<?php $kode_photo='';foreach ($reservation_photo as $row) {?>
						<tr>
							<td><?php echo $kode_photo=$row->reservation_photo_detail_id ?></td><td><input type="text" value="<?php echo $row->reservation_photo_request ?>" class="form-control" id='reservation_photo_request<?=$row->reservation_photo_id?>' disabled></td>
							<td><input type="text" class="form-control" id='reservation_photo_price<?=$row->reservation_photo_id?>' disabled value="<?php $jumlah_photo= $row->reservation_photo_price; echo $jumlah_photo ?>"</td>
							<td><button type="button" class="btn btn-warning" id='btn-p<?=$row->reservation_photo_id?>'>Edit</td>
								<script type="text/javascript">
									$(document).ready(function(){
										$('#btn-p<?=$row->reservation_photo_id?>').click(function(){
											$('#reservation_photo_request<?=$row->reservation_photo_id?>').removeAttr('disabled');
											$('#reservation_photo_price<?=$row->reservation_photo_id?>').removeAttr('disabled');
											$('#btn-p<?=$row->reservation_photo_id?>').removeClass('btn-warning');
											$('#btn-p<?=$row->reservation_photo_id?>').addClass('btn-success');
											$('#btn-p<?=$row->reservation_photo_id?>').html('Simpan');
											$('#btn-p<?=$row->reservation_photo_id?>').attr('onclick','edit_photo<?=$row->reservation_photo_id?>()');
											$('#btn-p<?=$row->reservation_photo_id?>').prop('id','btn-s<?=$row->reservation_photo_id?>');
										});
									});

									function edit_photo<?=$row->reservation_photo_id;?>(){
										var detail_photo_request<?=$row->reservation_photo_id;?> = $('#reservation_photo_request<?=$row->reservation_photo_id;?>').val();
										var detail_photo_price<?=$row->reservation_photo_id;?> = $('#reservation_photo_price<?=$row->reservation_photo_id;?>').val();
										var id<?=$row->reservation_photo_id;?> = <?=$row->reservation_photo_id;?>;

										$('#photo_request').html('<div class="alert alert-info">Proses edit sedang dilakukan...</div>');
										$.ajax({
											type:"POST",
											url:"<?php echo base_url()?>transaction/edit_reservation_photo",
											data:"id="+id<?=$row->reservation_photo_id;?>+"&&detail_photo_request="+detail_photo_request<?=$row->reservation_photo_id;?>+"&&detail_photo_price="+detail_photo_price<?=$row->reservation_photo_id;?>,
											success: function(msg){
													location.reload();
											}
										});
									}
								</script>
							<td align="center"><a  onclick="deletePhoto('<?php echo $row->reservation_photo_id?>')"  class="glyphicon glyphicon-remove"></a></td>
						</tr>
					<?php
					$total_photo+=$jumlah_photo;
				 } ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="2">Total</td><td><?php echo number_format($total_photo,0,',','.'); ?></td>
						</tr>
					</tfoot>
				</table>
				<button type="button" id='tambah_photo' class="btn btn-primary" data-toggle="modal" data-target="#modals">Tambah Photo</button>
				<?php $reservation_decor = $this->transaction_model->get_reservation_decor_by_detail_id($reservation_decor_detail_id);
				?>
				<br>
				<br>
				<table id='dekor_request' class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Kode Pesanan</th>
							<th>Reservation Dekor Detail</th>
							<th>Reservation Dekor Price</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php $kode_dekor=''; foreach ($reservation_decor as $row) {?>
							<tr>
								<td><?php echo $kode_dekor = $row->reservation_decor_detail_id ?></td><td><input type="text" value="<?php echo $row->reservation_decor_request ?>" class="form-control" id='reservation_decor_request<?=$row->reservation_decor_id?>' disabled></td>
								<td><input type="text" class="form-control" id='reservation_decor_price<?=$row->reservation_decor_id?>' disabled value="<?php $jumlah_dekor= $row->reservation_decor_price; echo $jumlah_dekor ?>"</td>
								<td><button type="button" class="btn btn-warning" id='btn-dek<?=$row->reservation_decor_id?>'>Edit</td>
									<script type="text/javascript">
										$(document).ready(function(){
											$('#btn-dek<?=$row->reservation_decor_id?>').click(function(){
												$('#reservation_decor_request<?=$row->reservation_decor_id?>').removeAttr('disabled');
												$('#reservation_decor_price<?=$row->reservation_decor_id?>').removeAttr('disabled');
												$('#btn-dek<?=$row->reservation_decor_id?>').removeClass('btn-warning');
												$('#btn-dek<?=$row->reservation_decor_id?>').addClass('btn-success');
												$('#btn-dek<?=$row->reservation_decor_id?>').html('Simpan');
												$('#btn-dek<?=$row->reservation_decor_id?>').attr('onclick','edit_decor<?=$row->reservation_decor_id?>()');
												$('#btn-dek<?=$row->reservation_decor_id?>').prop('id','btn-s<?=$row->reservation_decor_id?>');
											});
										});

										function edit_decor<?=$row->reservation_decor_id;?>(){
											var detail_decor_request<?=$row->reservation_decor_id;?> = $('#reservation_decor_request<?=$row->reservation_decor_id;?>').val();
											var detail_decor_price<?=$row->reservation_decor_id;?> = $('#reservation_decor_price<?=$row->reservation_decor_id;?>').val();
											var id<?=$row->reservation_decor_id;?> = <?=$row->reservation_decor_id;?>;

											$('#dekor_request').html('<div class="alert alert-info">Proses edit sedang dilakukan...</div>');
											$.ajax({
												type:"POST",
												url:"<?php echo base_url()?>transaction/edit_reservation_dekor",
												data:"id="+id<?=$row->reservation_decor_id;?>+"&&detail_decor_request="+detail_decor_request<?=$row->reservation_decor_id;?>+"&&detail_decor_price="+detail_decor_price<?=$row->reservation_decor_id;?>,
												success: function(msg){
														location.reload();
												}
											});
										}
									</script>
								<td align="center"><a  onclick="deleteDekor('<?php echo $row->reservation_decor_id?>')"  class="glyphicon glyphicon-remove"></a></td>
							</tr>
					<?php
					$total_dekor+=$jumlah_dekor;
				 } ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="2">Total</td><td><?php echo number_format($total_dekor,0,',','.'); ?></td>
						</tr>
					</tfoot>
				</table>
				<button type="button" id='tambah_dekor' class="btn btn-primary" data-toggle="modal" data-target="#modals">Tambah Dekor</button>
			<?php	$reservation_music = $this->transaction_model->get_reservation_music_by_detail_id($reservation_music_detail_id);
				?>
				<br>
				<br>
				<table id='music_request' class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Kode Pesanan</th>
							<th>Reservation Music Detail</th>
							<th>Reservation Music Price</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php $kode_music=''; foreach ($reservation_music as $row) {?>
						<tr>
							<td><?php echo $kode_music=$row->reservation_music_detail_id ?></td><td><?php echo $row->reservation_music_request ?></td><td><?php $jumlah_music=$row->reservation_music_price; echo number_format($jumlah_music,0,',','.');  ?></td>
							<td align="center"><a  onclick="deleteMusic('<?php echo $row->reservation_music_id?>')"  class="glyphicon glyphicon-remove"></a></td>
						</tr>
						<?php
						$total_music+=$jumlah_music;
					 } ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="2">Total</td><td><?php echo number_format($total_music,0,',','.'); ?></td>
						</tr>
					</tfoot>
				</table>
				<?php if($reservation_music_detail_id==''||$kode_music!=$reservation_music_detail_id){?>
				<button type="button" id='tambah_music' class="btn btn-primary" data-toggle="modal" data-target="#modals">Tambah Music</button>
				<?php } ?>
<?php } ?>

			</div>

            <div class="box-body">

            <?
            $kondp=count($dp);
            //echo $kondp;
            if($kondp>0){
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
			    <td align="center"><?php echo $trx->kode_dp;?></td>
				<td align="center"><?php echo $trx->nama_dp;?></td>
				<td align="center"><?php echo date('d-m-Y', strtotime($trx->tgl_acara));?></td>
			    <td align="center"><?=$trx->transaction_code?></td>
                <td align="center"><?php if($trx->status_dp=='L'){echo "LUNAS";}else{echo "UANG MUKA";};?></td>
			  </tr>

				<?php }
			  ?>
              <br>
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
                $dpdetail =$this->transaction_model->select_dp_detail_id($trx->id_dp);
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


			</tbody>
		  </table>
                <?
            }
            ?>
            </div>
		  </div><!-- /.box -->
		</div><!-- /.col -->
		<div class="col-md-3">
			<div class="box box-solid box-success">
				<div class="box-body">
					<table class="table">
						<?php if($order_status=='reservation'){ ?>
						<tr>
							<td>DP :</td><td><?php echo number_format($first_payment,0,',','.'); ?></td>
						</tr>
						<?php } ?>
						<tr>
							<td colspan="4" align="center"><h3><?php
							if($order_status=='reservation'){
								$grandstotal=$grandtotal+$total_photo+$total_music+$total_beauty+$total_dekor;
								echo number_format($grandstotal,0,',','.');
							}else{
							 echo number_format($grandtotal,0,',','.');
						 }
							 ?></h3></td>
						</tr>
						<tr>
							<td colspan="4">
							<?php
							if ($deleted_status == 0 AND $status == 'unpaid')
							{
								if ($group_id == '1' OR $group_id == '2' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6' OR $group_id == '7')
								{
									echo anchor('transaction/edit/' . $trx->transaction_code,'Edit Order', ['class'=>'btn btn-lg btn-warning btn-block']);
								}
								if ($group_id == '1' OR $group_id == '2' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6')
								{
									if($kondone>=$kon OR $order_status=='take_away')
                                    {
                                        if ($group_id == '6')
                                        {
                                        ?>
                                        <button class="btn btn-info btn-lg btn-block" data-toggle="modal" data-target="#print_bill">Cetak Bill</button>
                                        <?php
									//echo anchor('transaction/closure_bill/' . $trx->transaction_code,'Cetak Bill', ['class'=>'btn btn-lg btn-info btn-block']);
									//echo anchor('transaction/payment/' . $trx->transaction_code,'Bayar Bill', ['class'=>'btn btn-lg btn-success btn-block']);
                                        ?>
                                        <button class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#payment_bill">Bayar Bill</button>
                                        <?php
                                        }
									}
									if($order_status!='reservation'){
									echo anchor('transaction/split_bill/' . $trx->transaction_code,'Split Bill', ['class'=>'btn bg-black btn-lg btn-block']);
									//echo anchor('transaction/combine_bill/' . $trx->transaction_code."/".$table,'Gabung Bill / Meja', ['class'=>'btn bg-black btn-lg btn-block']);
                                        ?>
                                        <button class="btn bg-black btn-lg btn-block" data-toggle="modal" data-target="#combine_bill">Gabung Bill/Meja</button>
                                        <?php
									}

									if($order_status!='reservation'){
									if($table_status == 'lock')
									{
										//echo anchor('transaction/unlock_table/' . $trx->transaction_code,'Buka Meja', ['class'=>'btn bg-black btn-lg btn-block']);
                                        ?>
                                        <button class="btn bg-black btn-lg btn-block" data-toggle="modal" data-target="#unlock_table">Buka Meja</button>
                                        <?php
									}
									elseif($table_status == 'unlock')
									{
										//echo anchor('transaction/lock_table/' . $trx->transaction_code,'Kunci Meja', ['class'=>'btn bg-black btn-lg btn-block']);
                                        ?>
                                        <button class="btn bg-black btn-lg btn-block" data-toggle="modal" data-target="#lock_table">Kunci Meja</button>
                                        <?php
									}
									}
								}
								if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5')
								{
									//echo anchor('transaction/revoke/' . $trx->transaction_code,'Batal', ['class'=>'btn btn-lg btn-danger btn-block']);
                                    ?>
                                        <button class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#void">Batal</button>
                                    <?php
								}
							}
							elseif($status == 'paid')
							{
								if($this->session->userdata('receipt_max_print') == '0' OR $trx->receipt_count_print < $this->session->userdata('receipt_max_print'))
								{
									$group_id = $this->session->userdata('group_id');
									if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6')
									{
										echo anchor('transaction/receipt/' . $trx->transaction_code,'Cetak Struk', ['class'=>'btn btn-lg btn-success btn-block','target'=>'_self']);
									}
								}
							}
							if($trx->order_status=='reservation'){
								echo anchor('transaction/list_reservasi','Keluar', ['class'=>'btn btn-lg btn-primary btn-block']);
							}else{
							echo anchor('transaction','Keluar', ['class'=>'btn btn-lg btn-primary btn-block']);
							}
							?>

							</td>
						</tr>
					</table>
				</div>
			</div>
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->
	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->

	<script type="text/javascript">
	$(document).ready(function(){
					$("#modal").load('<?php echo base_url().'transaction/AddReservationInTransaction'?>');
	});
	$('#tambah_photo').click(function(){
		$('#judul').html('Tambah Photo');
		$('#proses').attr('name','proses_photo');
		$('#proses').html('Tambah Photo');
		$('#TextBoxesGroup').removeAttr('hidden','hidden');
		$('#total').removeAttr('hidden','hidden');
		$('#add').removeClass('hidden');
		$('#remove').removeClass('hidden');
		$('#music').attr('hidden','hidden');
		$('#kode_transaksi').val('<?php echo $transaction_code; ?>');
	});
	$('#tambah_beauty').click(function(){
		$('#judul').html('Tambah Beauty');
		$('#proses').attr('name','proses_beauty');
		$('#proses').html('Tambah Beauty');
		$('#TextBoxesGroup').removeAttr('hidden','hidden');
		$('#total').removeAttr('hidden','hidden');
		$('#add').removeClass('hidden');
		$('#remove').removeClass('hidden');
		$('#music').attr('hidden','hidden');
		$('#kode_transaksi').val('<?php echo $transaction_code; ?>');
	});
	$('#tambah_dekor').click(function(){
		$('#judul').html('Tambah Dekor');
		$('#proses').attr('name','proses_dekor');
		$('#proses').html('Tambah Dekor');
		$('#TextBoxesGroup').removeAttr('hidden','hidden');
		$('#total').removeAttr('hidden','hidden');
		$('#add').removeClass('hidden');
		$('#remove').removeClass('hidden');
		$('#music').attr('hidden','hidden');
		$('#kode_transaksi').val('<?php echo $transaction_code; ?>');
	});
	$('#tambah_music').click(function(){
		$('#judul').html('Tambah Music');
		$('#proses').attr('name','proses_music');
		$('#proses').html('Tambah Music');
		$('#TextBoxesGroup').attr('hidden','hidden');
		$('#total').attr('hidden','hidden');
		$('#add').addClass('hidden');
		$('#remove').addClass('hidden');
		$('#music').removeAttr('hidden');
		$('#kode_transaksi').val('<?php echo $transaction_code; ?>');
	});
	</script>
<div id='modal'>
</div>


<!-- Pembatalan Transaksi -->
<div id="void" class="modal fade" role="dialog" >
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Pembatalan Transaksi</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12"  >
                    <?php echo form_open('transaction/revoke_process',['class'=>'form-horizontal']);?>
                        <div class="box-body">
                        <?php
						echo '<span class=text-red>'.validation_errors().'</span>';
						if ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';?>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Alasan Pembatalan</label>
                                <div class="col-xs-8">
                                    <textarea type="text" class="form-control" name="note" placeholder="Alasan Pembatalan" rows="5" value="<?php echo set_value('note');?>" autofocus></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="transaction_code" value="<?php echo $transaction_code;?>">
                            <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-lg btn-success pull-right">Ya</button>
                        </div><!-- /.box-footer -->
					<?php echo form_close();?>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Buka Meja -->
<div id="unlock_table" class="modal fade" role="dialog" >
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Buka Meja</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12"  >
                    <?php echo form_open('transaction/unlock_table_process',['class'=>'form-horizontal']);?>
				<div class="box-body">
					<?php
					echo '<span class=text-red>'.validation_errors().'</span>';
					if ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';?>
					<div class="form-group">
					  <label class="col-sm-4 control-label">Alasan Buka Meja</label>
					  <div class="col-xs-8">
						<textarea class="form-control" rows="5" name="note" placeholder="Alasan Buka Meja" autofocus><?php echo set_value('note');?></textarea>
					  </div>
					</div>
				</div>
				<div class="box-footer">
					<input type="hidden" name="transaction_code" value="<?php echo $transaction_code;?>">
					<button type="submit" class="btn btn-lg btn-danger" data-dismiss="modal">Tidak</button>
					<button type="submit" class="btn btn-lg btn-success pull-right">Ya</button>
				</div><!-- /.box-footer -->
				<?php echo form_close();?>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Kunci Meja -->
<div id="lock_table" class="modal fade" role="dialog" >
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Kunci Meja</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12"  >
                    <?php echo form_open('transaction/lock_table_process',['class'=>'form-horizontal']);?>
				<div class="box-body">
					<?php
					echo '<span class=text-red>'.validation_errors().'</span>';
					if ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';?>
					<div class="form-group">
					  <label class="col-sm-4 control-label">Alasan Kunci Meja</label>
					  <div class="col-xs-8">
						<textarea class="form-control" rows="5" name="note" placeholder="Alasan Kunci Meja" autofocus><?php echo set_value('note');?></textarea>
					  </div>
					</div>
				</div>
				<div class="box-footer">
					<input type="hidden" name="transaction_code" value="<?php echo $transaction_code;?>">
					<button type="submit" class="btn btn-lg btn-danger" data-dismiss="modal">Tidak</button>
					<button type="submit" class="btn btn-lg btn-success pull-right">Ya</button>
				</div><!-- /.box-footer -->
				<?php echo form_close();?>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Gabung Bill -->
<div id="combine_bill" class="modal fade" role="dialog" >
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Gabung Bill</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12"  >
                    <?php echo form_open('transaction/combine_bill_process',['class'=>'form-horizontal']);?>
				<div class="box-body">
					<?php
					echo '<span class=text-red>'.validation_errors().'</span>';
					if ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';?>
                    <div class="form-group">
						  <label class="col-sm-5 col-md-5 control-label">Pilih Tujuan Kode Trx / Meja</label>
                    </div>
					<div class="form-group">
						  <div class="col-sm-12 col-md-12">
							<select name="transaction_code" class="form-control select2" style="width:100%">
							<?php
							$old_transaction	= $this->transaction_model->get_transaction_unpaidnon($transaction_code);
							foreach($old_transaction AS $oldtransaction)
							{
							?>
							<option value="<?php echo $oldtransaction->transaction_code;?>"><b>Kode Trx :</b> <?php echo $oldtransaction->transaction_code;?> / <b>Meja :</b> <?php echo $oldtransaction->table;?> / <b>Waktu Pesan :</b> <?php echo date('d-m-Y H:i:s', strtotime($oldtransaction->created_time));?></option>
							<?php
							}
							?>
							</select>
						  </div>
						</div>
				</div>
				<div class="box-footer">
					<input type="hidden" name="old_transaction_code" value="<?php echo $transaction_code;?>">
					<button type="submit" class="btn btn-lg btn-danger" data-dismiss="modal">Tidak</button>
					<button type="submit" class="btn btn-lg btn-success pull-right">Ya</button>
				</div><!-- /.box-footer -->
				<?php echo form_close();?>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cetak Bill -->
<div id="print_bill" class="modal fade" role="dialog" >
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Cetak Bill</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12"  >
                    <?php echo form_open('transaction/closure_bill_process',['class'=>'form-horizontal']);?>
				<div class="box-body">
					<?php
					echo '<span class=text-red>'.validation_errors().'</span>';
					if ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';?>
                    <div class="form-group">
						  <label class="col-sm-4 control-label">Pelanggan</label>
						  <div class="col-sm-8">
							<select name="customer_id" class="form-control select2" style="width:100%">
							<?php
							$customers	= $this->customer_model->get_customers();
							foreach($customers AS $customer)
							{
								?>
								<option value="<?php echo $customer->customer_id;?>" <? if($customer_id==$customer->customer_id){ echo "selected";} ?>><?php echo $customer->customer_full_name;?></option>
								<?php
							}
							?>
							</select>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<input type="hidden" name="transaction_code" value="<?php echo $transaction_code;?>">
					<button type="submit" class="btn btn-lg btn-danger" data-dismiss="modal">Tidak</button>
					<button type="submit" class="btn btn-lg btn-success pull-right">Cetak</button>
				</div><!-- /.box-footer -->
				<?php echo form_close();?>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bayar Bill -->
<div id="payment_bill" class="modal fade" role="dialog" >
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Bayar Bill</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12"  >
                    <?php echo form_open('transaction/payment_process',['class'=>'form-horizontal']);?>
				<div class="box-body">
					<?php
					echo '<span class=text-red>'.validation_errors().'</span>';
					if ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';?>
                    <div class="form-group">
						  <label class="col-sm-4 control-label">Metode Pembayaran</label>
						  <div class="col-sm-8">
							<select id="payment_method" name="payment_method" class="form-control select2" style="width:100%">
                                    <option value="cash">Tunai</option>
                                    <option value="cc">Kartu Kredit/Debit</option>
                                    <option value="saldo">Saldo</option>
                                    <option value="cashcc">Tunai dan Kartu Kredit/debit</option>
                                </select>
						</div>
					</div>
                    <div class="form-group">
						  <label class="col-sm-4 control-label">Pelanggan</label>
						  <div class="col-sm-8">
							<select name="customer_id" class="form-control select2" style="width:100%">
							<?php
							$customers	= $this->customer_model->get_customers();
							foreach($customers AS $customer)
							{
								?>
								<option value="<?php echo $customer->customer_id;?>" <? if($customer_id==$customer->customer_id){ echo "selected";} ?>><?php echo $customer->customer_full_name;?></option>
								<?php
							}
							?>
							</select>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<input type="hidden" name="transaction_code" value="<?php echo $transaction_code;?>">
					<button type="submit" class="btn btn-lg btn-danger" data-dismiss="modal">Tidak</button>
					<button type="submit" class="btn btn-lg btn-success pull-right">Bayar</button>
				</div><!-- /.box-footer -->
				<?php echo form_close();?>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>