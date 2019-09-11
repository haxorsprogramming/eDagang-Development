<?

	header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
	header("Content-Disposition: attachment; filename=detailaccount.xls");  //File name extension was wrong
	header("Expires: 0");


?>
<style type="text/css">
*{
font-family: Arial;
margin:0px;
padding:0px;
}
@page {
 margin-left:3cm 2cm 2cm 2cm;
}
table.grid{

font-size: 12px;
border-collapse:collapse;
}
table.grid th{
	padding:5px;
	margin:5px;
	padding:5px;
}
table.grid th{
background: #F0F0F0;
border-top: 0.2mm solid #000;
border-bottom: 0.2mm solid #000;
text-align:center;
border:1px solid #000;
margin:5px;
padding:5px;
}
table.grid tr td{
	padding:3px;
	border-bottom:0.2mm solid #000;
	border:1px solid #000;
	margin:5px;
	padding:5px;
}
h1{
font-size: 18px;
}
h2{
font-size: 14px;
}
h3{
font-size: 12px;
}
p {
font-size: 10px;
}
center {
	padding:8px;
}
.atas{
display: block;

margin:5px;
padding:5px;
}
.kanan tr td{
	font-size:12px;
}
.attr{
font-size:9pt;
width: 100%;
padding-top:2pt;
padding-bottom:2pt;
border-top: 0.2mm solid #000;
border-bottom: 0.2mm solid #000;
}
.pagebreak {
width:20.99cm ;
page-break-after: always;
margin-bottom:10px;
}
.akhir {
width:20.99cm ;
font-size:13px;
}
.page {
width:20.99cm ;
font-size:12px;
padding:10px;
}
table.footer{
width:20.99cm ;
font-size: 12px;
border-collapse:collapse;
}
</style>
<?
$konbb=count($sk);
                        $saw=0;
                        $sak=0;
                        $na="";
                        $nk="";
                        if($konbb>0){

                            $nk=$sk[0]->finance_account_code;
                            $na=$sk[0]->finance_account_name;
                        }
                        
                        $jk=0;
        $jd=0;
        $jt=0;
	 	foreach($sk as $dbb){ 
      
                                if($dbb->debit_kredit == 1){
                                   // echo $dbb->nominal;
                                   $jk=$jk+$dbb->nominal;
                                }
                                
                                if($dbb->debit_kredit == 0){
                                   //echo $dbb->nominal;
                                    $jd=$jd+$dbb->nominal;
                                
                                }
     }
     $jt=$jk-$jd;
     $sak=$jt;
	 ?>  
<body style="padding:10px; margin:10px">

<table class="grid" width="100%">
    <tr>
        <td colspan="4" style="border: none;">
        <h3>
        <?
       
        echo $nk." ".$na;
        ?></h3>
        </td>
    </tr>
    <tr>
       
        <td colspan="4" style="border: none;">
        <h3>
        <?
       
        echo "Saldo Akhir : ".$sak;
        ?>
        <h3>
        </td>
    </tr>
		<tr>
        <th >Tanggal</th>
        <th >Debit</th>
        <th >Kredit</th>
        <th >Keterangan</th>
       
	</tr>    
     <?
	 	$no=1;
		$stok=0;
		//print_r($sk);
	 	foreach($sk as $dbb){ ?>
         <tr>
    	<td ><?=date('d-m-Y',strtotime($dbb->finance_journal_date));?></td>
        <td align="right"><?
                                if($dbb->debit_kredit == 1){
                                    echo $dbb->nominal;
                                   //$jk=$jk+$dbb->nominal;
                                }
                                ?></td>
    	<td align="right"><?
                                if($dbb->debit_kredit == 0){
                                   echo $dbb->nominal;
                                   // $jd=$jd+$dbb->nominal;
                                
                                }
                                ?></td>
        <td ><?=$dbb->ket?></td>
       
        
    </tr>
        
   
	 <?
	$no++;
     }
	 ?>  
    <tr>
        <th >Total</th>
        <th align="right" style="text-align: right;"><? echo $jk;?></th>
        <th align="right" style="text-align: right;"><? echo $jd;?></th>
        <th  >&nbsp;</th>
       
	</tr>
  </table>
