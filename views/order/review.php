<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-warning">
			<div class="box-header">
			  <h3 class="box-title"><?php
			  $tables	= $this->order_model->get_table_by_table_id($this->session->userdata('table_id'));
				foreach($tables AS $table)
				{
					$table_name	= $table->table_name;
				}
			  echo $sub_title;?> (Meja : <?php echo $table_name;?>)</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
			<!-- form start -->
			<?php
				if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
			  <table class="table table-bordered table-striped">
				<thead>
				  <tr>
					<th class="text-center">Menu</th>
					<th class="text-center">QTY</th>
					<th class="text-center">@Harga</th>
					<th class="text-center">Remark</th>
					<th></th>
				  </tr>
				</thead>
				<tbody>
				<?php 
				//print_r($this->cart->contents());
					foreach($this->cart->contents() AS $items) :
					?>
				  <tr>
					<td><?php //echo $items['id'];?><?php echo $items['name'];?></td>
					<td align="center"><?php echo $items['qty'];?></td>
					<td align="center">
					<?php
					$products	= $this->product_model->get_product_by_product_id($items['id']);
					foreach($products AS $product)
					{
						echo number_format($product->product_selling_price,0,',','.');
					}
					?></td>
					<td><?php
					$options	= $items['options'];
					//$remark		= element('remark',$options);
					$remark		= $items['options']['remark'];
					echo $remark;?></td>
					<td align="center"><a href="<?php echo base_url();?>order/remove_from_cart/<?php echo $items['rowid'];?>" class="glyphicon glyphicon-remove"></a></td>
				  </tr>
				  <?php endforeach; ?>
				</tbody>
			  </table>
			</div><!-- /.box-body -->
			<div class="box-footer">
				<a href="<?php echo base_url() . 'order/cancel';?>" class="btn btn-danger">Batal</a>
				<a href="<?php echo base_url() . 'order/select_menu';?>" class="btn btn-lg btn-primary">Menu</a>
				<a href="<?php echo base_url() . 'order/submit';?>" class="btn btn-lg btn-success pull-right" id="btsimpan" onClick="block_none()">Simpan</a>
                <script>
					function block_none(){
					 //document.getElementById('hidden-div').classList.add('show');
					document.getElementById('btsimpan').classList.add('hide');
					}
				</script>
			</div><!-- /.box-footer -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row -->
	
</section><!-- /.content -->
</div><!-- /.content-wrapper -->