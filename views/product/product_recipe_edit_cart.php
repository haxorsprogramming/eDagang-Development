<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Main content -->
<section class="content">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box box-solid box-warning">
		<div class="box-body">
			<?php					
			if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';
			echo '<span class=text-red>'.validation_errors().'</span>';
			echo form_open('product/recipe_edit_material_add_to_cart');
			?>
			<div class="box-body">				
				<div class="col-xs-8">
					<label>Nama Material</label>
					<select name="product_recipe_material_id" class="form-control select2" autofocus>
					<?php
                    $group_id=$group_id = $this->session->userdata('group_id');
					$materials	= $this->material_model->get_materials_sortby_name($group_id);
					foreach($materials as $material)
					{
					?>
						<option value="<?php echo $material->material_id;?>"><?php echo $material->material_name . ' ('.$material->material_unit_name .')';?></option>
					<?php }?>
					</select>
				</div>					
				<div class="col-xs-2">
					<label>QTY</label>
					<input type="text" name="product_recipe_qty" class="form-control" value="<?php echo set_value('product_recipe_qty');?>">
				</div>
				<div>
					<label>&nbsp;</label><br>
					<button type="submit" class="btn btn-primary">Tambah</button>
				</div>
			</div><!-- /.box-body -->
			<?php echo form_close();?>
		</div>
	</div><!-- /.box-body -->
  </div><!-- /.box -->
	<div class="col-xs-12">
	  <div class="box box-solid box-warning">
		<div class="box-header with-border">
		  <h3 class="box-title">Item Resep (<?php echo $this->session->userdata('product_recipe_edit_name');?> - <?php echo $this->session->userdata('product_recipe_edit_code');?>)</h3>
		</div><!-- /.box-header -->
		<div class="box-body">
			<?php					
			if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';
			echo '<span class=text-red>'.validation_errors().'</span>';
			echo form_open('product/recipe_update','class=form-horizontal');
			?>
			<table class="table table-bordered table-striped">
				<thead>
				  <tr>
					<th class="text-center">Item</th>
					<th class="text-center">QTY</th>
					<th class="text-center">Satuan</th>
					<th class="text-center">Harga Act Satuan</th>
					<th class="text-center">Jumlah Act Satuan</th>
					<th class="text-center">Harga Satuan</th>
					<th class="text-center">Subtotal</th>
					<th></th>
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
				//print_r($recipesdetail );
				foreach($recipesdetail AS $reci){
					$allmaterial	= $this->material_model->get_material_by_material_idresep($reci->material_id);
					foreach($allmaterial AS $material)
					{
						$material_unit_code_name 		= $material->material_unit_code_name;
						$material_purchase_price 		= $material->material_purchase_price;
						$material_purchase_unit 		= $material->material_purchase_unit;
						$material_unit_id		 		= $material->material_unit_id;				
					}
					$material_price_unit	= $material_purchase_price / $material_purchase_unit;
					//$subtotal		= $items['qty'] * $material_price_unit;
					$subtotal		= $reci->product_recipe_qty * $material_price_unit;
					
					$total			+= $subtotal;
					?>
				  <tr>
					<td><?php echo $reci->material_name;?> </td>
					<td align="center">
                    	<div class="col-xs-4">
                        <label id="lblqty<?=$reci->material_id?>"><?php echo $reci->product_recipe_qty;?></label>
                    	<input type="number" class="form-control" id="txtqty<?=$reci->material_id?>" value="<?php echo $reci->product_recipe_qty;?>">
                        </div>
                        <div class="col-xs-4">
                        <a href="#" class="btn btn-primary" id="bedit<?=$reci->material_id?>" >Edit</a>
                        <a href="#" class="btn btn-success" id="bsave<?=$reci->material_id?>" >Save</a>
                        </div>
                        
                        <script>

						$('#bsave<?=$reci->material_id?>').hide();
						$('#txtqty<?=$reci->material_id?>').hide();
						$('#bedit<?=$reci->material_id?>').click(function(){
							$('#bsave<?=$reci->material_id?>').show();
							$('#bedit<?=$reci->material_id?>').hide();
							$('#txtqty<?=$reci->material_id?>').show();
							$('#lblqty<?=$reci->material_id?>').hide();
							return false;
						});
						$('#bsave<?=$reci->material_id?>').click(function(){
							var v_id='<?=$reci->material_id?>';
							var v_qty=$('#txtqty<?=$reci->material_id?>').val();
							var product_recipe_edit_id='<?=$this->session->userdata('product_recipe_edit_id')?>';
							var rowid='<?=$reci->material_id?>';
							
							$.ajax({
								type: "POST",
								url: "<?php echo base_url()?>product/update_product_recipe_detail",
								data: "rowid="+rowid+"&v_qty="+v_qty+"&product_recipe_edit_id="+product_recipe_edit_id+"&v_id="+v_id,
								
								success: function(msg){
									//alert(msg);
									//if(msg=='SUKSES'){
										//alert('DATA BERHASIL DISIMPAN');
										window.location='<?=base_url()?>product/recipe_edit_cart/<?=$prid?>';
									//}else{
									//	alert(msg);
									//}
								}
							});
							return false;
						});
						</script>
                        
                    </td>
					<td align="center"><?php echo $material_unit_code_name;?></td>
					<td align="center"><?php echo number_format($material_purchase_price,0,',','.');?></td>
					<td align="center"><?php echo number_format($material_purchase_unit,0,',','.');?></td>
					<td align="center"><?php echo number_format($material_price_unit,0,',','.');?></td>
					<td align="center"><?php echo number_format($subtotal,0,',','.');?></td>
					<td align="center"><a href="<?php echo base_url();?>product/recipe_edit_material_remove_from_cart/<?php echo $reci->material_id . '/' . $reci->material_id ;?>/<?=$prid?>" class="glyphicon glyphicon-remove"></a></td>
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
						<td align="center"><?php echo $jqty."-".$material_purchase_unit;?></td>
						<td align="center"><?php echo number_format($material_purchase_price,0,',','.');?></td>
						<td align="center"><?php echo number_format($material_purchase_unit,0,',','.');?></td>
						<td align="center"><?php echo number_format($material_price_unit,0,',','.');?></td>
						<td align="center"><?php echo number_format($subtotal,0,',','.');?></td>
					</tr>-->
					<tr>
                    	<td align="right" ></td>
                    	<td align="center"><strong><?php echo $jqty;?></strong></td>
						<td align="right" colspan="4">Total : </td>
						<td align="center"><?php echo number_format($total,0,',','.');?></td>
						<td align="center"></td>
					</tr>
					<tr>
						<td align="right" colspan="6">Perkiraan Kehilangan : </td>
						<td align="center"><?php
						$product_recipe_loss_cost_percent = $total * $this->session->userdata('product_recipe_loss_cost_percent') / 100;
						echo $this->session->userdata('product_recipe_loss_cost_percent') . ' % (' . number_format($product_recipe_loss_cost_percent,0,',','.') . ')';?></td>
						<td align="center"></td>
					</tr>
					<tr>
						<td align="right" colspan="6">Grand Total : </td>
						<td align="center"><?php echo number_format($total + $product_recipe_loss_cost_percent,0,',','.');?></td>
						<td align="center"></td>
					</tr>
				</tfoot>
			  </table>
              <!--<div class="pull-right" ><input type="checkbox" value="1" name="cekresep"  > Cek Jika dijadikan Untuk Resep lain
              </div>-->
		</div>
        <?
		$gtotal=$total + $product_recipe_loss_cost_percent;
        ?>
		<div class="box-footer">
        <?
		if($cont>0){
        ?>
        	<input type="hidden" name="product_recipe_name" value="<?php echo $this->session->userdata('product_recipe_name');?>">
            <input type="hidden" name="material_unit_id" value="<?php echo $material_unit_id;?>">
			<input type="hidden" name="material_purchase_unit" value="<?php echo $jqty?>">
            <input type="hidden" name="material_standard_stock" value="<?php echo $jqty;?>">
            <input type="hidden" name="material_purchase_price" value="<?php echo $gtotal;?>">
            
			<input type="hidden" name="product_recipe_loss_cost_percent" value="<?php echo $this->session->userdata('product_recipe_loss_cost_percent');?>">
            <?
		}
            ?>
			<a href="<?=base_url()?>product/recipe" class="btn btn-danger">Batal</a>
			<button type="submit" class="btn btn-success btn-lg pull-right">Simpan</button>
		</div><!-- /.box-header -->
		<?php echo form_close();?>
	</div><!-- /.box-body -->
  </div><!-- /.box -->
</div><!-- /.col -->
</div><!-- /.row (main row) -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->