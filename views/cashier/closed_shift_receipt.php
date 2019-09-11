<script>
	window.print();
	jsPrintSetup.setSilentPrint(true);
	// Do Print
	jsPrintSetup.print();
</script>
<table width="250">
	<?php
	if($this->session->userdata('company_logo') == TRUE)
	{
	?>
	<!--tr align="center">
		<td colspan="3"><img src="<?php echo base_url();?>assets/img/<?php echo $this->session->userdata('company_logo');?>" width="250"></td>
	</tr-->
	<?php }?>
	<tr align="center">
		<td colspan="3"><h4><?php echo $this->session->userdata('company_name');?></h4></td>
	</tr>
	<tr align="center">
		<td colspan="3"><h4><?php echo $this->session->userdata('company_address');?></h4></td>
	</tr>
	<tr align="center">
		<td colspan="3"><h4>Serah Terima Kasir</h4></td>
	</tr>
	<?php
	foreach($data_shift AS $receipt)
	{
	?>
	<tr>
		<td width="90">No. Bukti Kasir</td>
		<td> : </td>
		<td><?php echo $receipt->se_id;?></td>
	</tr>
	<tr>
		<td width="90">Nama Kasir</td>
		<td> : </td>
		<td><?php echo $receipt->full_name;?></td>
	</tr>
	<tr>
		<td>Waktu Buka</td>
		<td> : </td>
		<td><?php echo $receipt->open_shift_time;?></td>
	</tr>
	<tr>
		<td>Waktu Tutup</td>
		<td> : </td>
		<td><?php echo $receipt->closed_shift_time;?>
		</td>
	</tr>
	<tr>
		<td>Saldo Awal</td>
		<td> : </td>
		<td>Rp. <?=number_format($receipt->capital_money,0,',','.')?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3"><b>Pendapatan</b></td>
	</tr>
	<tr>
		<td>Tunai</td>
		<td> : </td>
		<td>Rp. <?=number_format($receipt->income_cash,0,',','.')?></td>
	</tr>
	<tr>
		<td>Non Tunai</td>
		<td> : </td>
		<td>Rp. <?=number_format($receipt->income_noncash,0,',','.')?></td>
	</tr>
	<tr>
		<td>Total</td>
		<td> : </td>
		<td>Rp. <?=number_format($receipt->total_income,0,',','.')?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td>Total Uang Tunai</td>
		<td> : </td>
		<td>Rp. <?=number_format($receipt->total_cash,0,',','.')?></td>
	</tr>
	<tr>
		<td>Uang di Kasir</td>
		<td> : </td>
		<td>Rp. <?=number_format($receipt->actual_money,0,',','.')?></td>
	</tr>
	<tr>
		<td>Selisih</td>
		<td> : </td>
		<td>Rp. <?=number_format($receipt->margin,0,',','.')?></td>
	</tr>
	
	<tr>
		<td>Catatan</td>
		<td> : </td>
		<td><?=$receipt->closed_shift_notes?></td>
	</tr>
	<tr>
		<td colspan="3">---------------------------------------------</td>
	</tr>
	<tr align="center">
		<td>[ Kasir ]</td>
		<td></td>
		<td>[ Spv ]</td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr align="center">
		<td>( <?php echo $receipt->full_name;?> )</td>
		<td>&nbsp;</td>
		<td>----------------</td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr align="center">
		<td>[ Finance ]</td>
		<td></td>
		<td>[ Mgr ]</td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr align="center">
		<td>----------------</td>
		<td>&nbsp;</td>
		<td>----------------</td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr align="center">
		<td colspan="3">===============================</td>
	</tr>
	<?php }?>
</table>
<script>
	window.close();
</script>