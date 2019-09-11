<?

	header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
	header("Content-Disposition: attachment; filename=detailresep.xls");  //File name extension was wrong
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
right {
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

<body style="padding:10px; margin:10px">

	<table class="grid" width="100%">
				<thead>
                <tr>
					<td colspan="7" style="border: none;">Resep : <?=$pname?> (<?=$pcode?>)</td>
					
				  </tr>

                  <tr>
					<td colspan="7" style="border: none;"></td>
					
				  </tr>
				  <tr>
					<th class="text-center">Item</th>
					<th class="text-right">QTY</th>
					<th class="text-center">Satuan</th>
					<th class="text-right">Harga Act Satuan</th>
					<th class="text-right">Jumlah Act Satuan</th>
					<th class="text-right">Harga Satuan</th>
					<th class="text-right">Subtotal</th>
					
				  </tr>
				</thead>
				<tbody>
				<?php
				$subtotal=0;
				$total=0;
				$jqty=0;
				$cont=0;
				$mpurchase=0;
				$mprice=0;
				$cont=0;
				//foreach($this->cart->contents() AS $items) :
			//	print_r($recipesdetail );
				foreach($recipesdetail AS $reci){
					$allmaterial	= $this->material_model->get_material_by_material_idresep($reci->material_id);
					foreach($allmaterial AS $material)
					{
						$material_unit_code_name 		= $material->material_unit_code_name;
						$material_purchase_price 		= $material->material_purchase_price;
						$material_purchase_unit 		= $material->material_purchase_unit;
						$material_unit_id		 		= $material->material_unit_id;				
					}
					$material_price_unit	= ceil($material_purchase_price / $material_purchase_unit);
					//$subtotal		= $items['qty'] * $material_price_unit;
					$subtotal		= $reci->product_recipe_qty * $material_price_unit;
					
					$total			+= $subtotal;
					?>
				  <tr>
					<td><?php echo $reci->material_name;?> </td>
					<td align="right">
                    	<div class="col-xs-4">
                        <label id="lblqty<?=$reci->material_id?>"><?php echo $reci->product_recipe_qty;?></label>
                    
                        </div>
                       
                        
                       
                        
                    </td>
					<td align="left"><?php echo $material_unit_code_name;?></td>
					<td align="right"><?php echo $material_purchase_price;?></td>
					<td align="right"><?php echo $material_purchase_unit;?></td>
					<td align="right"><?php echo $material_price_unit;?></td>
					<td align="right"><?php echo $subtotal;?></td>
					
				  </tr>
				<?php
					$jqty=$jqty+$reci->product_recipe_qty;
					$cont=$cont+1;
					$mpurchase=$mpurchase+$material_purchase_unit;
					$mprice=$mprice+$material_price_unit;
				}
				// endforeach;
				 if($cont==0){
					 $tmpurchase=0;
					 $tmprice=0;
					 $material_unit_id="0";
				 }else{
				 	$tmpurchase=$mpurchase/$cont;
					$tmprice=$mprice/$cont;
				 }
					
				  ?>
				</tbody>
				<tfoot>
                	<!--<tr>
                    	<td align="right" >Total : </td>
						<td align="right"><?php echo $jqty."-".$material_purchase_unit;?></td>
						<td align="right"><?php echo $material_purchase_price;?></td>
						<td align="right"><?php echo $material_purchase_unit;?></td>
						<td align="right"><?php echo $material_price_unit,0;?></td>
						<td align="right"><?php echo $subtotal;?></td>
					</tr>-->
					<tr>
                    	<td align="right" ></td>
                    	<td align="right"><strong><?php echo $jqty;?></strong></td>
						<td align="right" colspan="3">Total : </td>
						<td align="right"><?php echo $total?></td>
						<td align="right"></td>
					</tr>
					<tr>
						<td align="right" colspan="5">Perkiraan Kehilangan : </td>
						<td align="right"><?php
						$product_recipe_loss_cost_percent = $total * $this->session->userdata('product_recipe_loss_cost_percent') / 100;
						echo $this->session->userdata('product_recipe_loss_cost_percent') . ' % (' . number_format($product_recipe_loss_cost_percent,0,',','.') . ')';?></td>
						<td align="right"></td>
					</tr>
					<tr>
						<td align="right" colspan="5">Grand Total : </td>
						<td align="right"><?php echo $total + $product_recipe_loss_cost_percent;?></td>
						<td align="right"></td>
					</tr>
				</tfoot>
			  </table>
