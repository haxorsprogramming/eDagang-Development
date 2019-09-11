<script>
	window.print();
	jsPrintSetup.setSilentPrint(false);
	// Do Print
	jsPrintSetup.print();
</script>
<?php
$settings	= $this->setting_model->get_settings();
foreach($settings as $setting)
{
	$company_logo		= $setting->company_logo;
	$company_name		= $setting->company_name;
	$company_address	= $setting->company_address;
}

foreach($transactionrecord AS $trx)
{
?>
<table width="300">
	<?php
	if($company_logo == TRUE)
	{?>
	<tr align="center">
		<td colspan="3"><img src="<?php echo base_url();?>assets/img/<?=$company_logo;?>" width="250"></td>
	</tr>
	<?php }?>
	<tr align="center">
		<td colspan="3"><h2><b><?=$company_name;?></b></h2></td>
	</tr>
	<tr align="center">
		<td colspan="3"><h4><?=$company_address;?></h4></td>
	</tr>
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
	$discount		= 0;
	$total 			= 0;
	$subtotal 		= 0;
	$tax 			= 0;
	$service 		= 0;
	$grandtotal		= 0;
	foreach($ordersrecord AS $order)
	{
		$price			= $order->selling_price;
		$subtotal		= $order->qty * $price;
		$total			+= $subtotal;
		$tax				= $total * ($this->session->userdata('tax_fare') / 100);
		$service			= $total * ($this->session->userdata('service_fare') / 100);
		$grandtotal	= $total + $tax + $service;
	?>
	<tr>
		<td colspan="3"><?php echo $order->product_name;?></td>
	</tr>
	<tr>
		<td colspan="3"><?php echo $order->qty;?> x Rp. <?=number_format($price,0,',','.')?> = Rp. <?=number_format($subtotal,0,',','.')?></td>
	  </tr>
	<?php }
	?>
	<tr>
		<td colspan="3">------------------------------------------------</td>
	</tr>
	<tr>
		<td>Subtotal</td>
		<td> : </td>
		<td>Rp. <?=number_format($total,0,',','.')?></td>
	</tr>
	<tr>
		<td>Disc. Items</td>
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
				echo 'KREDIT/DEBIT ('.$bank.')';
			}
		}
		else
		{
			echo "TAGIHAN";
		}
		?></td>
	</tr>
	<tr>
		<td colspan="3">------------------------------------------------</td>
	</tr>
	<?php
	if($this->session->userdata('receipt_footer') == TRUE)
	{
	?>
	<tr align="center">
		<td colspan="3"><?=$this->session->userdata('receipt_footer')?></td>
	</tr>
	<?php }
	if($this->session->userdata('receipt_promo') == TRUE)
	{
	?>
	<tr align="center">
		<td colspan="3"><b><?=$this->session->userdata('receipt_promo')?></b></td>
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
