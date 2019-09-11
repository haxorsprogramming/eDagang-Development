<?
//header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
//header("Content-Disposition: attachment; filename=laporandaftar.xls");  //File name extension was wrong
//header("Expires: 0");

?>
<style type="text/css">
{
font-family: Arial;
margin:0px;
padding:0px;
}

</style>
<?
//print_r($dstok);
?>
<script>
function pr(){
	window.print();
	window.close();
}
</script>
<body  onload="pr();">
<div class="atas">


<table >
		
     <?
	 	$no=1;
		$stok=0;
		//print_r($sk);
	 	foreach($serecord as $row)
		{
			$se_id				= $row->se_id;
			$created_by			= $row->created_by;
			$open_shift_time	= date('d-m-Y H:i:s',strtotime($row->open_shift_time));
			$capital_money		= $row->capital_money;
			$closed_shift_time	= date('d-m-Y H:i:s',strtotime($row->closed_shift_time));
			$income_cash		= $row->income_cash;
			$income_noncash		= $row->income_noncash;
			$total_cash			= $row->total_cash;
			$total_income		= $row->total_income;
			$actual_money		= $row->actual_money;
			$margin				= $row->margin;
			$closed_shift_notes	= $row->closed_shift_notes;
			$verified_time		= $row->verified_time;
			$verified_by		= $row->verified_by;
			
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
        <tr>
        	<td colspan="3" align="center"><h2>Detail Serah Terima Kasir</h2></td>
        </tr>
         <tr>
    	<td valign="top"><table>
        		<tr>
                	<td>No Bukti Kasir</td>
                    <td>:</td>
                    <td><?=$se_id?></td>
                </tr>
                <tr>
                	<td>Nama Kasir</td>
                    <td>:</td>
                    <td><?=$cashier_full_name?></td>
                </tr>
                <tr>
                	<td>Buka Kasir</td>
                    <td>:</td>
                    <td><?=$open_shift_time?></td>
                </tr>
                <tr>
                	<td>Tutup Kasir</td>
                    <td>:</td>
                    <td><?php if($closed_shift_time == TRUE) echo $closed_shift_time; else echo '';?></td>
                </tr>
                <tr>
                	<td>Saldo Awal</td>
                    <td>:</td>
                    <td align="right"><?=number_format($capital_money,0,',','.')?></td>
                </tr>
                <tr>
                	<td>Pendapatan Tunai</td>
                    <td>:</td>
                    <td align="right"><?=number_format($income_cash,0,',','.')?></td>
                </tr>
                 <tr>
                	<td>Pendapatan Non Tunai</td>
                    <td>:</td>
                    <td align="right"><?=number_format($income_noncash,0,',','.')?></td>
                </tr>
                 <tr>
                	<td>Pendapatan Tunai + Non Tunai</td>
                    <td>:</td>
                    <td align="right"><?=number_format($total_income,0,',','.')?></td>
                </tr>
        	</table>
        </td>
        <td valign="top">&nbsp;</td>
    	<td valign="top">
        	<table>
        		<tr>
                	<td>Total Uang Tunai</td>
                    <td>:</td>
                    <td align="right"><?=number_format($total_cash,0,',','.')?></td>
                </tr>
                <tr>
                	<td>Uang di Kasir</td>
                    <td>:</td>
                    <td align="right"><?=number_format($actual_money,0,',','.')?></td>
                </tr>
                <tr>
                	<td>Selisih</td>
                    <td>:</td>
                    <td align="right"><?=number_format($margin,0,',','.')?></td>
                </tr>
                <tr>
                	<td>Catatan</td>
                    <td>:</td>
                    <td ><?=$closed_shift_notes?></td>
                </tr>
                <tr>
                
        	</table>
        </td>        
       
    	</tr>
        
   
	 <?
	
     }
	 ?>  
    
  </table>
  <br>
  <div style=" font-size:12px">Tanggal Cetak : <?=date("d-m-Y H:i:s")?></div>
  </body>