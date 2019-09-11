<script>
  $(function () {
	 $('#product').DataTable({
		 "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		 "pagingType": "full_numbers",
		 "order": [[ 0, 'asc' ], [ 1, 'asc' ], [ 5, 'asc' ]],
		 "scrollX": true,
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
		<a href="<?=base_url()?>product/create_paket" class="btn btn-warning"><i class='fa fa-plus-circle'></i> Tambah Produk</a>&nbsp;
		<a href="<?=base_url()?>product/recipe" class="btn btn-primary"><i class='fa fa-usd'></i> Cost of Product</a>&nbsp;
        <!--<a href="<?=base_url()?>product/create_paket" class="btn btn-success">Tambah Paket</a>-->
		<a href="<?=base_url()?>product/sub_category" class="btn btn-primary"><i class='fa fa-sliders'></i> Sub Kategori</a>
	</section>

	<!-- Main content -->
	<section class="content">

	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-default">
			<div class="box-body">
			<?php
			if ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
			if ($this->session->flashdata('message_success')) echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
			?>
			  <table id="product" class="table table-striped table-bordered table-hover">
				<thead>
				  <tr>
					<th class="text-center">Sub Kategori</th>
					<th class="text-center">Nama Produk</th>
					<th class="text-center">Harga Modal</th>
					<th class="text-center">Harga Jual</th>
					<th class="text-center">Layanan (menit)</th>
					<th class="text-center">Status</th>
          <?php if($this->session->userdata('group_id')=='1'){ ?>
          <th class="text-center">Action</th>
          <?php } ?>
				  </tr>
				</thead>
				<tbody>
				<?php
					$total=0;
                    $group_id = $this->session->userdata('group_id');
					$loss_percent_on_product	= $this->session->userdata('loss_percent_on_product');

					foreach($productsrecord AS $product)
					{
					?>
				  <tr>
					<td><?php echo $product->sub_category_name;?></td>
					<td><?php echo anchor('product/edit/' . $product->product_id,$product->product_name);?></td>
					<td><?php
						$product_recipe	= $this->product_model->get_product_recipe_by_product_id($product->product_id);
                        $product_recipe_grand_total=0;
						foreach($product_recipe as $productrecipe)
						{
							$product_recipe_prices	= $this->product_model->get_product_recipe_price_by_product_recipe_id($productrecipe->product_recipe_id,$this->session->userdata('loss_percent_on_product'));

							foreach($product_recipe_prices AS $product_recipe_price)
							{
								$product_recipe_total			= $product_recipe_price->product_recipe_total;
								$product_recipe_estimated_loss	= $product_recipe_price->product_recipe_estimated_loss;
								$product_recipe_grand_total		= $product_recipe_price->product_recipe_grand_total;
							}
						}

						if($product_recipe_grand_total > 0)
						{
							echo number_format(ceil($product_recipe_grand_total),0,',',',');
						}
						else
						{
							echo '0';
						}
					?></td>
					<td><?php echo number_format($product->product_selling_price,0,',',',');?></td>
					<td><?php echo $product->product_service_time;?></td>
					<td><?php if($product->product_available == 'not_available') echo "Tidak Aktif"; elseif($product->product_available == 'available') echo "Aktif";?></td>
          <?php if($this->session->userdata('group_id')=='1'){ ?>
          <td class="text-center"><button onclick="Delete('<?php echo $product->product_id?>','<?php echo $product->product_name?>')" class="btn btn-xs btn-danger"><i class='fa fa-trash'></i> Hapus</button></td>
          <?php } ?>
          </tr>
				  <?php }?>
				</tbody>
			  </table>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->
<?php if($this->session->userdata('group_id')=='1'){ ?>
<script type="text/javascript">
  function Delete(id,name)
  {
    var cfm = confirm('Apakah anda yakin ingin menghapus produk '+name+' ?');
    if(cfm==true)
    {
      $.ajax({
        type:'POST',
        url:'<?php echo base_url()?>product/delete/'+id,
        success:function(data)
        {
          if(!alert(data)){window.location.reload();}
        }
      })
    }else
    {
        alert("Produk tidak jadi dihapus");
    }
  }
</script>
<?php } ?>
	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->
