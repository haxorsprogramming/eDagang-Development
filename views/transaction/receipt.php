<script>
	window.print();
	jsPrintSetup.setSilentPrint(false);
	// Do Print
	jsPrintSetup.print();
</script>
<?php
foreach($transactionrecord AS $trx)
{
?>
<table width="300">
	<?php
	if($trx->company_logo == TRUE)
	{?>
	<tr align="center">
		<td colspan="3"><img src="<?php echo base_url();?>assets/img/<?php echo $trx->company_logo;?>" width="250"></td>
	</tr>
	<?php }?>
	<tr align="center">
		<td colspan="3"><h3><?php echo $trx->company_name;?></h3></td>
	</tr>
	<tr align="center">
		<td colspan="3"><h4><?php echo $trx->company_address;?></h4></td>
	</tr>
	<?php
	if($trx->receipt_header == TRUE)
	{
	?>
	<tr align="center">
		<td colspan="3"><?php echo $trx->receipt_header;?></td>
	</tr>
	<tr align="center">
		<td colspan="3">&nbsp;</td>
	</tr>
	<?php }?>
	<tr>
		<td width="135">Kode Transaksi</td>
		<td> : </td>
		<td><?php echo $trx->transaction_code;?></td>
	</tr>
	<tr>
		<td>Waktu Bayar</td>
		<td> : </td>
		<td><?php echo $trx->payment_time;?></td>
	</tr>
	<tr>
		<td>Kasir</td>
		<td> : </td>
		<td><?php
				$cashiers = $this->account_model->get_user_by_user_id($trx->payment_by);
				foreach($cashiers AS $cashier)
				{
					echo $cashier->full_name;
				}
			?>
		</td>
	</tr>
	<tr>
		<td>No. Meja</td>
		<td> : </td>
		<td><?=$trx->table?></td>
	</tr>
	<tr>
		<td colspan="3">------------------------------------------------</td>
	</tr>
	<?php
		$price			= 0;
		$totalx			= 0;
		$discount		= 0;
		$discount_value = 0;
		$total 			= 0;
		$subtotal 		= 0;
		$tax 			= 0;
		$service 		= 0;
		$disc_member	= 0;
		$grandtotal		= 0;
		foreach($ordersrecord AS $order)
		{
			if($trx->discount_type == 'all')
			{
				$discount_value	= $this->session->userdata('discount_value');
				$price			= $order->selling_price;
				$subtotal		= $order->qty * $price;
				$totalx			+= $subtotal;
				$discount		= $totalx * ($discount_value / 100);
				$total			= $totalx - $discount;
			}
			elseif($trx->discount_type == 'normal')
			{
				$options		= unserialize($order->options);
				$discountvalue	= element('discount',$options);
				$pricex			= $order->selling_price * ($discountvalue / 100);
				$price			= $order->selling_price - $pricex;
				$subtotal		= $order->qty * $price;
				$totalx			+= $subtotal;
				$discount		+= $pricex + $pricex;
				$total			= $totalx;
			}
		?>
	<tr>
		<td colspan="3"><?php echo $order->product_name;?> <?php
		if($trx->discount_type == 'normal')
		{
			if($discountvalue)
				echo $discountvalue . ' %';
			else echo '';
		}?></td>
	</tr>
	<tr>
		<td colspan="3"><?php echo $order->qty;?> x Rp. <?php echo number_format($price,0,',','.');?> = Rp. <?php echo number_format($subtotal,0,',','.');?></td>
	  </tr>
	<?php };
	$tax		= $total * ($trx->tax_fare / 100);
	$service	= $total * ($trx->service_fare / 100);
	$grandtotal_temp	= $total + $tax + $service;
					
	if($trx->discount_type == 'manual')
	{
		if($trx->customer_id > 0)
		{
			$disc_member	= $total * ($trx->discount_member / 100);
			$grandtotal		= $total + $tax + $service - (($grandtotal_temp * $trx->discount_value)/100) - $disc_member;
		}
		else
		{
			$grandtotal	= $total + $tax + $service - (($grandtotal_temp * $trx->discount_value)/100);
		}
	}
	else
	{
		if($trx->customer_id > 0)
		{
			$disc_member	= $total * ($trx->discount_member / 100);
			$grandtotal	= $total + $tax + $service - $disc_member;
		}
		else
		{
			$grandtotal	= $total + $tax + $service;
		}
	}
	?>
	<tr>
		<td colspan="3">------------------------------------------------</td>
	</tr>
	<tr>
		<td>Subtotal</td>
		<td> : </td>
		<td>Rp. <?=number_format($totalx,0,',','.')?></td>
	</tr>
	<tr>
		<td>Disc. Items <?php if($discount_value == TRUE) echo $discount_value . '%';?></td>
		<td> : </td>
		<td>Rp. <?=number_format($discount,0,',','.')?></td>
	</tr>
	<tr>
		<td>Total</td>
		<td> : </td>
		<td>Rp. <?=number_format($total,0,',','.')?></td>
	</tr>
	<tr>
		<td>Tax</td>
		<td> : </td>
		<td>Rp. <?=number_format($tax,0,',','.')?></td>
	</tr> <tr>
		<td>Service</td>
		<td> : </td>
		<td>Rp. <?=number_format($service,0,',','.')?></td>
	</tr>
	<?php
	if($trx->discount_type == 'manual')
	{
	?>
	<tr>
		<td>Grand Total Origin</td>
		<td> : </td>
		<td>Rp. <?=number_format($grandtotal_temp,0,',','.')?></td>
	</tr> <tr>
		<td>Disc. <?=$trx->discount_value;?>%</td>
		<td> : </td>
		<td>Rp. <?=number_format(($grandtotal_temp * $trx->discount_value)/100,0,',','.')?></td>
	</tr>
	<?php }
	if($trx->customer_id > 0)
	{
	?>
	<tr>
		<td>Grand Total Origin</td>
		<td> : </td>
		<td>Rp. <?=number_format($grandtotal_temp,0,',','.')?></td>
	</tr>
	<tr>
		<td>Disc. Member <?=$trx->discount_member;?>%</td>
		<td> : </td>
		<td>Rp. <?=number_format($disc_member,0,',','.')?></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td> : </td>
		<td><?php
		$customerrecord	= $this->customer_model->get_customer_by_customer_id($trx->customer_id);
		foreach($customerrecord as $customer)
		{
			echo $customer->customer_full_name;
		}?></td>
	</tr>
	<?php }?>
	<tr>
		<td colspan="3">------------------------------------------------</td>
	</tr>
	<tr>
		<td><strong>Grand Total</strong></td>
		<td> : </td>
		<td><strong>Rp. <?=number_format($grandtotal,0,',','.')?></strong></td>
	</tr>
	<tr>
		<td>Bayar</td>
		<td> : </td>
		<td>Rp. <?=number_format($trx->remittance,0,',','.')?></td>
	</tr>
	<tr>
		<td>Kembali</td>
		<td> : </td>
		<td>Rp. <?=number_format($trx->refund,0,',','.')?></td>
	</tr>
	<tr>
		<td>Status</td>
		<td> : </td>
		<td><?php
		if ($trx->payment_method == "cash")
		{
			echo "TUNAI";
		}
		elseif ($trx->payment_method == "cc")
		{
			$issuer_id		= $trx->issuer_id;
			$issuerrecord 	= $this->transaction_model->get_issuer_by_issuer_id($issuer_id);
			foreach($issuerrecord AS $issuer)
			{
				$bank = $issuer->issuer_name;
				echo 'CC/DC ('.$bank.')';
			}
		}
		?></td>
	</tr>
	<tr>
		<td colspan="3">------------------------------------------------</td>
	</tr>
	<?php
	if($trx->receipt_footer == TRUE)
	{
	?>
	<tr align="center">
		<td colspan="3"><?php echo $trx->receipt_footer;?></td>
	</tr>
	<?php }
	if($trx->receipt_promo == TRUE)
	{
	?>
	<tr align="center">
		<td colspan="3"><b><?php echo $trx->receipt_promo;?></b></td>
	</tr>
	<?php }?>
	<tr>
		<td colspan="3">------------------------------------------------</td>
	</tr>
</table>
<?php }?>
<script>
	window.close();
</script>