<script>
  $(function () {
	 $('#recipe').DataTable({
		 "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		 "pagingType": "full_numbers",
		 "scrollX": true,
		 "order": [[ 1, 'asc' ], [ 2, 'asc' ]],
		 "dom":"Bfrtip",
		 "buttons":['excel','pdf','print']
	 });
	 $('div.dataTables_filter input').focus();
  });
</script>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<?php $group_id = $this->session->userdata('group_id');
		if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '14' OR $group_id == '16' OR $group_id=='18')
		{ echo anchor('product/generate_recipe_code','Tambah CoP', ['class'=>'btn btn-warning']).'&nbsp;';}?>
		<a href="<?=base_url()?>product" class="btn btn-primary">Produk</a>&nbsp;
		<a href="<?=base_url()?>product/sub_category" class="btn btn-primary">Sub Kategori</a>
	</section>

	<!-- Main content -->
	<section class="content">

	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-success">
			<div class="box-body">
			<?php
			if ($this->session->flashdata('message')) echo '<div class="alert alert-info">'.$this->session->flashdata('message').'</div>';
			?>
			  <table id="recipe" class="table table-striped table-bordered table-hover">
				<thead>
				  <tr>
					<th class="text-center">Kode CoP</th>
					<th class="text-center">Nama CoP</th>
					<th class="text-center">Total Biaya</th>
					<th class="text-center">Perkiraan Kehilangan</th>
					<th class="text-center">Harga Pokok Penjualan</th>
					<th class="text-center">Keterangan</th>
                    <th class="text-center"> </th>
				  </tr>
				</thead>
                <tfoot>
				  <tr>
					<th class="text-center">Kode CoP</th>
					<th class="text-center">Nama CoP</th>
					<th class="text-center">Total Biaya</th>
					<th class="text-center">Perkiraan Kehilangan</th>
					<th class="text-center">Harga Pokok Penjualan</th>
					<th class="text-center">Keterangan</th>
				  </tr>
				</tfoot>
				<tbody>
				<?php
				//print_r($reciperecord);
					foreach($reciperecord AS $recipe)
					{
						$product_recipe	= $this->product_model->get_product_recipe_by_product_recipe_id($recipe->product_recipe_id);
						foreach($product_recipe as $productrecipe)
						{
							$product_recipe_prices	= $this->product_model->get_product_recipe_price_by_product_recipe_id($productrecipe->product_recipe_id,$productrecipe->product_recipe_loss_cost_percent);
							foreach($product_recipe_prices AS $product_recipe_price)
							{
								$product_recipe_total			= $product_recipe_price->product_recipe_total;
								$product_recipe_estimated_loss	= $product_recipe_price->product_recipe_estimated_loss;
								$product_recipe_grand_total		= $product_recipe_price->product_recipe_grand_total;
							}
						}

						if($product_recipe_grand_total > 0)
						{
							$product_recipe_grand_total	= $product_recipe_grand_total;
						}
						else
						{
							$product_recipe_grand_total	= '0';
						}
					?>
				  <tr>
					<td><?php echo $recipe->product_recipe_code;?></td>
					<td><?php echo anchor('product/recipe_edit/' . $recipe->product_recipe_id,$recipe->product_recipe_name);?></td>
					<td><?php echo number_format($product_recipe_total,0,',',',');?></td>
					<td><?php echo number_format($product_recipe_estimated_loss,0,',',',');?> (<?php echo $productrecipe->product_recipe_loss_cost_percent;?>%)</td>
					<td><?php echo number_format($product_recipe_grand_total,0,',',',');?></td>
					<td><?php $recipe->product_recipe_explanation;?></td>
                    <td><?
						if($recipe->kon==0){
							?>
                            <a href="<?=base_url()?>product/delete_recipe/<?php echo $recipe->product_recipe_id;?>" class=" btn btn-warning btn-xs">Hapus</a>&nbsp;
                            <?
						}
                        $pname=$recipe->product_recipe_name;
							//echo $recipe->kon;
						?>
                        <a href="<?=base_url()?>product/recipe_detail/<?php echo $recipe->product_recipe_id;?>/<?php echo str_replace(")"," ",str_replace("("," ",str_replace('%20',' ',$pname)));?>/<?php echo $recipe->product_recipe_code;?>" target="_blank" class=" btn btn-success btn-xs">Detail</a>
                    </td>
				  </tr>
				  <?php };?>
				</tbody>
			  </table>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->
