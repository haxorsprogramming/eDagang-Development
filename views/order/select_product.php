<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Main content -->
	<section class="content">
  <?php
  if($this->session->userdata('template_waiter') == '1')
  {?>
	<script>
	  $(function () {
		 $('#select_menu').DataTable({
			 "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
			 "pagingType": "full_numbers"
		 });
	  });
	  
	  function addtocart()
	  {
		  var product_id	= $('#product_id').val();
		  var qty			= $('#qty').val();
		  var remark		= $('#remark').val();
		  $.ajax({
			 type: "POST",
			 url: "<?php echo base_url();?>order/add_to_cart",
			 data: "product_id="+product_id+"&qty="+qty+"&remark="+remark
		  });
	  }
	</script>
	
		<div class="row">
			<div class="col-xs-12">
			  <div class="box box-solid box-warning">
				<div class="box-body">
					<table id="select_menu" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>Menu</th>
								<th>QTY</th>
								<th>Remark</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($menurecord AS $row) : ?>
							<tr>
								<td><?php echo $row->name;?></td>
								<?php echo form_open('order/add_to_cart');?>
								<input type="hidden" name="session_form" value="menu">
								<td><?php
										if ($row->stock < '1')
										{
											echo "<strong><span class=text-red>Out of Stock</span></strong>";
										}
										else
										{
										?>
											<select name="qty">
											<?php
											if ($row->stock > 10)
											{
												$stock = 10;
											}
											else
											{
												$stock = $row->stock;
											}
											for ($q=1;$q<=$stock;$q++)
											{
											?>
											<option value="<?php echo $q;?>"><?php echo $q;?></option>
										<?php } ?>
										</select>
										<?php
										}
										?>
								</td>
								<td>
									<input type="text" name="remark">
								</td>
								<td>
								<?php
									if ($row->stock < '1')
									{
										$disabled = "disabled";
									}
									else
									{
										$disabled = "";
									}
									?>
									<input type="hidden" name="product_id" value="<?php echo $row->product_id;?>">
									<button type="submit" class="btn btn-primary <?php echo $disabled;?>">Pesan</button>
									<?php echo form_close();?>
								</td>
							</tr>
						<?php endforeach;?>
						</tbody>
					</table>
				</div><!-- /.box-body -->
				<div class="box-footer">
					<a href="<?php echo base_url() . 'order/cancel';?>" class="btn btn-danger">Batal</a>
					<?php if($this->cart->total_items() > 0)
					{?>
					<a href="<?php echo base_url() . 'order/review';?>" class="btn btn-success pull-right">Lihat Pesanan</a>
					<?php }?>
				</div><!-- /.box-footer -->
				</div><!-- /.box -->
			</div><!-- /.col -->
		</div><!-- /.row -->
 <?php }
 elseif($this->session->userdata('template_waiter') == '2')
 {
?>
		<div class="row">
			<div class="col-xs-12">
			  <div class="box box-solid box-warning">
				<div class="box-body">
					<?php
					foreach($subcategoryrecord as $category)
					{
					?>
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#cat-<?php echo $category->category_id;?>"><?php echo $category->product_category_name;?></button>
					
						<!-- Modal Menu -->
						<div class="modal fade" id="cat-<?php echo $category->category_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<!--h4 class="modal-title" id="myModalLabel">Makanan</h4-->
							  </div>
							  <div class="modal-body">
								<?php
								$product	= $this->product_model->get_product_by_category_id($category->category_id);
								foreach($product as $menu)
								{?>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#prd-<?php echo $menu->product_id;?>"><?php echo $menu->product_name;?></button>
								<?php }?>
							  </div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
							  </div>
							</div>
						  </div>
						</div>
						
					<?php 
					}
					
					$products	= $this->product_model->get_menu();
					foreach($products as $product)
					{
					?>
					<!-- Modal Item -->
					<div class="modal fade" id="prd-<?php echo $product->product_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <?php echo form_open();?>
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<!--h4 class="modal-title" id="myModalLabel">Makanan</h4-->
						  </div>
						  <div class="modal-body">
								<div class="form-group">
									<label>QTY</label>
									<?php
									if ($product->product_available = '0')
									{
										echo "<strong><span class=text-red>Out of Stock</span></strong>";
									}
									else
									{
									?>
									<select id="qty-<?php echo $product->product_id;?>" name="qty" class="form-control">
									<?php
										$stock = 0;
										for ($q=1;$q<=50;$q++)
										{
										?>
										<option value="<?php echo $q;?>"><?php echo $q;?></option>
										<?php } ?>
									</select>
									<?php } ?>
								</div>
								<div class="form-group">
									<label>Catatan</label>
									<input type="text" id="remark-<?php echo $product->product_id;?>" class="form-control">
									<input type="hidden" id="product_id-<?php echo $product->product_id;?>" value="<?php echo $product->product_id;?>">
									<input type="hidden" name="session_form" value="menu">
								</div>
						  </div>
						  <div class="modal-footer">
							<button type="button" onclick="addTocart(<?php echo $product->product_id;?>)" class="btn btn-success" data-dismiss="modal">Simpan</button>
						  </div>
						  <?php echo form_close();?>
						</div>
					  </div>
					</div>
					<?php }?>
					
				</div><!-- /.box-body -->
				<div class="box-footer">
					<a href="<?php echo base_url() . 'order/cancel';?>" class="btn btn-danger">Batal</a>
					<?php if($this->cart->total_items() > 0)
					{?>
					<a href="<?php echo base_url() . 'order/review';?>" class="btn btn-success pull-right">Lihat Pesanan</a>
					<?php }?>
				</div><!-- /.box-footer -->
				</div><!-- /.box -->
			</div><!-- /.col -->
		</div><!-- /.row -->
		<script>
			function addTocart(str)
			{
			  var id			= str;
			  var product_id	= $('#product_id-'+str).val();
			  var qty			= $('#qty-'+str).val();
			  var remark		= $('#remark-'+str).val();
			  $.ajax({
				 type: "POST",
				 url: "<?php echo base_url();?>order/add_to_cart",
				 data: "product_id="+product_id+"&qty="+qty+"&remark="+remark
			  });
			}
		</script>
<?php }
?>
	</section>
</div><!-- /.content-wrapper -->