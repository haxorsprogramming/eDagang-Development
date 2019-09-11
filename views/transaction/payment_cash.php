
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
	<div class="col-xs-12">
	  <div class="box box-solid box-warning">
		<?php
		$settings	= $this->setting_model->get_settings();
		foreach($settings as $setting)
		{
			$company_logo		= $setting->company_logo;
			$company_name		= $setting->company_name;
			$company_address	= $setting->company_address;
		}
		//print_r($customerrecord);
		foreach($customerrecord as $customer)
		{
			$username				= $customer->username;
			$registered_date		= $customer->created_time;
			$customer_id			= $customer->customer_id;
			$customer_full_name		= $customer->customer_full_name;
			$customer_hp			= $customer->customer_hp;
			$customer_email			= $customer->customer_email;
			$customer_group_id		=$customer->customer_group_id;
		}

		foreach($transactionrecord AS $trx)
		{
      $order_status=$trx->order_status;
      $reservation_detail_id=$trx->reservation_detail_id;
		if ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
		echo form_open('transaction/payment_submit',['class'=>'form-horizontal']);
			?>
		<div class="box-body">
			<div class="col-xs-6">
				<input type="hidden" name="transaction_code" value="<?php echo $trx->transaction_code;?>">
				<?php }
					$price			= 0;
					$discount		= 0;
					$total 			= 0;
					$subtotal 		= 0;
					$tax 			= 0;
					$service 		= 0;
					$grandtotal		= 0;
					$disc_customer	= 0;
					$totalbaru=0;
					$jtax=0;
					$jservice=0;
					$jdisc_customer=0;
					//print_r($ordersrecord);
					foreach($ordersrecord AS $order)
					{

						$price			= $order->selling_price;
						$subtotal		= $order->qty * $price;
						$total			+= $subtotal;
						if(isset($customerrecord))
						{
							foreach($customerrecord as $customerrow)
							{
								$discount_customer	= $customerrow->customer_group_discount;
							}
                            if($order->tax=='no_taxes'){
                                	$disc_customer	= 0;
                            }else{
                                	$disc_customer	= $subtotal * ($discount_customer / 100);
                            }

							//$grandtotal	= $total + $tax + $service - $disc_customer;
						}
						else
						{
							//$grandtotal	= $total + $tax + $service;
						}

						$jdisc_customer=$jdisc_customer+$disc_customer;
						$totalbaru          =$subtotal-$disc_customer;
						if($order->tax=='includ_tax' or $order->tax=='no_taxes' or $customer_group_id=='6'){
							$tax				= 0;
							//echo $tax."tax0<br>";
						}else{
							$tax				= $totalbaru * ($this->session->userdata('tax_fare') / 100);
							//echo $tax."tax1<br>";
						}

						//$tax				= $totalbaru * ($this->session->userdata('tax_fare') / 100);
						if($payment_method == "saldo" or $trx->order_status=='take_away' or $customer_group_id=='6' or $order->tax=='no_taxes'){
							$service			= 0;
						}else{
							//if($trx->payment_method == "saldo" or $customer_group_id=='6' ){
							 $service=$totalbaru * ($this->session->userdata('service_fare') / 100);
						}
						//$service			= $totalbaru * ($this->session->userdata('service_fare') / 100);
						//echo "tobaru".$totalbaru." tax".$tax." service".$service."<br>";;
						$grandtotal_temp	= $totalbaru + $tax + $service;
						$grandtotal	= $grandtotal+$totalbaru ;
						$jtax=$jtax+$tax;
						$jservice=$jservice+$service;



					}
					//$grandtotal=
				?>
				<div class="form-group">
				  <label class="col-sm-5 control-label">Subtotal</label>
				  <div class="col-sm-4">
					<input type="text" class="form-control" value="<?php echo number_format($total,0,',','.');?>" disabled>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-5 control-label">Disc. Items</label>
				  <div class="col-sm-3">
					<input type="text" class="form-control" value="<?php echo number_format($jdisc_customer,0,',','.');?>" disabled>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-5 control-label">Total</label>
				  <div class="col-sm-4">
					<input type="text" class="form-control" value="<?php echo number_format($total-$jdisc_customer,0,',','.');?>" disabled>
				  </div>
				</div>
                <?php
				if(isset($customerrecord))
				{
				?>
				<div class="form-group">
				  <label class="col-sm-5 control-label">Discount Customer</label>
				  <div class="col-sm-4">
					<input type="text" class="form-control" value="<?php echo $discount_customer;?>% (<?php echo number_format($disc_customer,0,',','.');?>)" disabled>
					<input type="hidden" name="discount_customer" value="<?php echo $discount_customer;?>">
				  </div>
				</div>
				<?php
				}
				?>
				<div class="form-group">
				  <label class="col-sm-5 control-label">Tax + Service</label>
				  <div class="col-sm-4">
					<input type="text" class="form-control" value="<?php echo number_format($jtax,0,',','.');?> + <?php echo number_format($jservice,0,',','.');?>" disabled>
				  </div>
				</div>

<?php
if($order_status=='reservation'){
  $total_music=0;
  $total_photo=0;
  $total_beauty=0;
  $total_dekor=0;

  $reservation = $this->transaction_model->get_reservation_id_by_reservation_detail_id($reservation_detail_id);
  foreach ($reservation as $data) {
    $reservation_music_detail_id =	$data->reservation_music_detail_id;
    $reservation_photo_detail_id =	$data->reservation_photo_detail_id;
    $reservation_decor_detail_id =	$data->reservation_decor_detail_id;
    $reservation_beauty_detail_id =	$data->reservation_beauty_detail_id;
    $rpdp = $data->first_payment;
    $reservation_status = $data->reservation_status;
    $reservation_begin = $data->reservation_begin;
    $reservation_end = $data->reservation_end;
  }
$reservation_music = $this->transaction_model->get_reservation_music_by_detail_id($reservation_music_detail_id);
foreach ($reservation_music as $row) {
  $jumlah_music=$row->reservation_music_price;
  $total_music+=$jumlah_music;
  }

$reservation_photo = $this->transaction_model->get_reservation_photo_by_detail_id($reservation_photo_detail_id);
foreach ($reservation_photo as $row) {
    $jumlah_photo=$row->reservation_photo_price;
    $total_photo+=$jumlah_photo;
    }

$reservation_beauty = $this->transaction_model->get_reservation_beauty_by_detail_id($reservation_beauty_detail_id);
foreach ($reservation_beauty as $row) {
        $jumlah_beauty=$row->reservation_beauty_price;
        $total_beauty+=$jumlah_beauty;
        }

$reservation_decor = $this->transaction_model->get_reservation_decor_by_detail_id($reservation_decor_detail_id);
foreach ($reservation_decor as $row) {
        $jumlah_dekor=$row->reservation_decor_price;
        $total_dekor+=$jumlah_dekor;
        }

$total=$total+$total_music+$total_photo+$total_beauty+$total_dekor;
}
 ?>

<?php if($order_status=='reservation'){ ?>
  <div class="form-group">
    <label class="col-sm-5 control-label">Biaya Photo</label>
    <div class="col-sm-4">
    <input type="text" class="form-control" value="<?php echo number_format($total_photo,0,',','.');?>" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-5 control-label">Biaya Dekorasi</label>
    <div class="col-sm-4">
    <input type="text" class="form-control" value="<?php echo number_format($total_dekor,0,',','.');?>" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-5 control-label">Biaya Music</label>
    <div class="col-sm-4">
    <input type="text" class="form-control" value="<?php echo number_format($total_music,0,',','.');?>" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-5 control-label">Biaya Beauty</label>
    <div class="col-sm-4">
    <input type="text" class="form-control" value="<?php echo number_format($total_beauty,0,',','.');?>" readonly="readonly">
    </div>
  </div>
<?php } ?>


        <div class="form-group">
				  <label class="col-sm-5 control-label">Uang Muka (DP)</label>
				  <div class="col-sm-4">
					<input type="text" class="form-control" value="<?php echo number_format($rpdp,0,',','.');?>" readonly="readonly">
				  </div>
				</div>


				<div class="form-group">
				  <label class="col-sm-5 control-label">Grand Total</label>
				  <div class="col-sm-4">
					<input type="text" class="form-control" value="<?=number_format($total-$jdisc_customer+$jtax+$jservice-$rpdp,0,',','.')?>" disabled>
				  </div>
				</div>

				<div class="form-group">
				  <label class="col-sm-5 control-label">Bayar</label>
				  <div class="col-sm-4">
					<input type="text" name="remittance" class="form-control input-lg" autofocus onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
				  </div>
				</div>
			</div>
			<div class="col-xs-6">
				<div class="form-group">
				  <label class="col-sm-5 control-label">Kode Transaksi</label>
				  <div class="col-sm-5">
					<input type="text" class="form-control" value="<?php echo $trx->transaction_code;?>" disabled>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-5 control-label">Waktu Pesan</label>
				  <div class="col-sm-5">
					<input type="text" class="form-control" value="<?php echo date('d-m-Y H:i:s', strtotime($trx->created_time));?>" disabled>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-5 control-label">No. Meja</label>
				  <div class="col-sm-5">
					<input type="text" class="form-control" value="<?php echo $trx->table;?>" disabled>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-5 control-label">Customer</label>
				  <div class="col-sm-5">
					<input type="text" class="form-control" value="<?php echo $customer_full_name;?>" disabled>
					<input type="hidden" name="customer_id" value="<?php echo $customer_id;?>">
				  </div>
				</div>
			</div>
		</div><!-- /.box-header -->
		<div class="box-footer">
      <input type="hidden" name="rpdp" value="<?php echo $rpdp;?>">
			<input type="hidden" name="grand_total" value="<?php echo $total-$jdisc_customer+$jtax+$jservice-$rpdp;?>">
			<input type="hidden" name="payment_method" value="cash">
			<button type="submit" class="btn btn-lg btn-success" id="btsimpan" onClick="block_none()">Bayar</button>
			<a href="<?=base_url()?>transaction/payment/<?php echo $trx->transaction_code;?>" class="btn btn-danger pull-right">Kembali</a>
              <script>
					function block_none(){
					 //document.getElementById('hidden-div').classList.add('show');
					document.getElementById('btsimpan').classList.add('hide');
					}
				</script>
		</div><!-- /.box-footer -->
		<?php echo form_close();?>
	  </div><!-- /.box -->
	</div><!-- /.col -->
  </div><!-- /.row (main row) -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->
