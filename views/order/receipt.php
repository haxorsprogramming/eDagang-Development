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
	<tr>
		<td width="135">No. Transaksi</td>
		<td> : </td>
		<td><?php echo $trx->transaction_code;?></td>
	</tr>
	<tr>
		<td>Pemesan</td>
		<td> : </td>
		<td><?php
				$waiters = $this->account_model->get_user_by_user_id($trx->created_by);
				foreach($waiters AS $waiter)
				{
					echo $waiter->full_name;
				}
			?>
		</td>
	</tr>
	<tr>
		<td>No. Meja</td>
		<td> : </td>
		<td><?php echo $trx->table;?></td>
	</tr>
	<tr>
		<td colspan="3">------------------------------------------------</td>
	</tr>
	<?php
		foreach($ordersrecord AS $order)
		{
			$options	= unserialize($order->options);
			$remark		= element('remark',$options);
		?>
	<tr>
		<td colspan="3"><?php echo $order->product_name;?></td>
	</tr>
	<tr>
		<td colspan="3"><?php echo $order->qty;?></td>
	  </tr>
	<tr>
		<td colspan="3">------------------------------------------------</td>
	</tr>
</table>
<?php }?>