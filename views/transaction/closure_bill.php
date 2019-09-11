<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
	<div class="col-xs-8">
	  <div class="box box-solid box-warning">
		<?php
		//print_r($transactionrecord);
		foreach($transactionrecord AS $trx)
		{
      $customer_group_id =$trx->customer_group_id;
      $payment_method		= $trx->payment_method;
      $order_status=$trx->order_status;
      $reservation_detail_id=$trx->reservation_detail_id;
		$cst=$trx->customer_id;
		?>
		<div class="box-body">
			<?php if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
			<div class="col-sm-3">
				<label>Kode Trx</label>
				<input type="text" class="form-control" value="<?php echo $trx->transaction_code;?>" disabled>
			</div>
			<div class="col-sm-4">
				<label>Waktu Pesan</label>
				<input type="text" class="form-control" value="<?php echo date('d-m-Y H:i:s',strtotime($trx->created_time));?>" disabled>
			</div>
			<div class="col-sm-2">
				<label>No. Meja</label>
				<input type="text" class="form-control" value="<?php echo $trx->table;?>" disabled>
			</div>
			<div class="col-sm-3">
				<label>Status Transaksi</label>
				<input type="text" class="form-control" value="<?php if ($trx->status == 'unpaid' AND $trx->deleted_status == 0)
					{
						echo "BELUM BAYAR";
					}
					elseif($trx->status == 'paid' AND $trx->deleted_status == 0)
					{
						echo "LUNAS";
					}
					elseif($trx->deleted_status == 1)
					{
						echo "BATAL";
					}
					?>" disabled>
			</div>
		</div>
		<div class="box-body">
		  <table class="table table-striped table-bordered">
			<thead>
			  <tr>
				<th class="text-center">Pemesan</th>
				<th class="text-center">Waktu Pesan</th>
				<th class="text-center">Menu</th>
				<th class="text-center">QTY</th>
				<th class="text-center">@Harga</th>
				<th class="text-center">Total</th>
				<th class="text-center">Status</th>
			  </tr>
			</thead>
      <tbody>
			<?php
				$price			= 0;
				$discount		= 0;
				$total 			= 0;
				$subtotal 		= 0;
				$tax 			= 0;
				$service 		= 0;
				$grandtotal		= 0;
				foreach($ordersrecord AS $order)
				{
					$price		= $order->selling_price;
					$subtotal	= $order->qty * $price;
					$total		+= $subtotal;
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
				?>
			  <tr>
				<td><?php echo $order->full_name;?></td>
				<td><?php echo date('d-m-Y H:i:s',strtotime($order->created_time));?></td>
				<td><?php echo $order->product_name ;?></td>
				<td><?php echo $order->qty;?></td>
				<td><?php echo number_format($order->selling_price,0,',','.');?></td>
				<td><?php echo number_format($subtotal,0,',','.');?></td>
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
				}
				?></td>
			  </tr>
			  <?php };?>
			  <tr>
				<td colspan="7">
					<div class="col-sm-3">
						<label>Subtotal</label>
						<input type="text" class="form-control" value="<?php echo number_format($total,0,',','.');?>" disabled>
					</div>
					<div class="col-sm-3">
						<label>Disc. Items</label>
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
		<?php }?>
    <?php

    if($order_status=='reservation'){
      $reservation = $this->transaction_model->get_reservation_id_by_reservation_detail_id($reservation_detail_id);
      foreach ($reservation as $data) {
        $reservation_music_detail_id =	$data->reservation_music_detail_id;
        $reservation_photo_detail_id =	$data->reservation_photo_detail_id;
        $reservation_decor_detail_id =	$data->reservation_decor_detail_id;
        $reservation_beauty_detail_id =	$data->reservation_beauty_detail_id;
        $first_payment = $data->first_payment;
        $reservation_status = $data->reservation_status;
        $reservation_begin = $data->reservation_begin;
        $reservation_end = $data->reservation_end;
      }
      $total_music=0;
      $total_dekor=0;
      $total_photo=0;
      $total_beauty=0;
      ?>
      <br>
      <b>Reservation Request</b>
      <br>
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
            <?php } ?>
		</div>
	  </div><!-- /.box -->

	</div><!-- /.col -->
	<div class="col-xs-4">
		<div class="box box-solid box-warning">
			<?php
			$attributes = array('target' => '_self');
			echo form_open('transaction/closure_bill_process',$attributes);
			?>
			<div class="body">
				<table class="table">
					<tr>
						<td colspan="2" align="center"><h3><?=number_format($grandtotal,0,',','.')?></h3></td>
					</tr>
					<tr>
						<td align="right">Pelanggan</td>
						<td>
							<select name="customer_id" class="form-control select2">
							<?php
							$customers	= $this->customer_model->get_customers();
							foreach($customers AS $customer)
							{
								?>
								<option value="<?php echo $customer->customer_id;?>" <? if($cst==$customer->customer_id){ echo "selected";} ?>><?php echo $customer->customer_full_name;?></option>
								<?php
							}
							?>
							</select>
						</td>
					</tr>
				</table>
			</div>
			<div class="box-footer">
				<input type="hidden" class="form-control" name="transaction_code" value="<?php echo $trx->transaction_code;?>">
				<button type="submit" class="btn btn-lg btn-info btn-block">Cetak Bill</button>
				<?php echo anchor('transaction/detail/' . $trx->transaction_code, 'Kembali', ['class'=>'btn btn-primary btn-block']);?>
			</div><!-- /.box-footer -->
			<?php echo form_close();?>
		</div>
  </div><!-- /.row (main row) -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
