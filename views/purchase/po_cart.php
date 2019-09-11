<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Main content -->
	<section class="content">

	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-warning">
			<div class="box-body">
			<?php
				if ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
				elseif ($this->session->flashdata('message_sucess')) echo '<div class="alert alert-success">'.$this->session->flashdata('message_sucess').'</div>';?>
			<?php
			echo '<span class=text-red>'.validation_errors().'</span>';
			echo form_open('purchase/po_material_add_to_cart');?>
				<div class="box-body">
					<div class="col-xs-3">
						<label>PO Number</label>
						<input type="text" class="form-control" value="<?php echo $this->session->userdata('purchase_order_number');?>" readonly="readonly">
					</div>
					<div class="col-xs-3">
					  <label>Tanggal Dibutuhkan</label>
						<input type="text" class="form-control" value="<?php echo date('d-m-Y',strtotime($this->session->userdata('po_date_required')));?>" readonly="readonly">
					</div>
					<div class="col-xs-3">
					  <label>Supplier</label>
					  <?php
					 $suppliers	= $this->purchase_model->get_supplier_by_supplier_id($this->session->userdata('po_supplier_id'));
					 foreach($suppliers AS $supplier)
					 {
						 $supplier_full_name	= $supplier->supplier_full_name;
						 $supplier_hp			= $supplier->supplier_hp;
					 }
					  ?>
						<input type="text" class="form-control" value="<?php echo $supplier_full_name . ' (' . $supplier_hp . ')';?>" readonly="readonly">
					</div>
                    <div class="col-xs-3">
					  <label>Keterangan</label>
						<input type="text" class="form-control" value="<?php echo $this->session->userdata('po_note');?>" readonly="readonly">
					</div>
				</div>
				<div class="box-body">
					<div class="col-xs-6">
						<label>Material</label>
							<select name="po_material_id" class="form-control select2" autofocus>
							<?php
							$materials	= $this->material_model->get_materials();
							foreach($materials as $material)
							{
							?>
								<option value="<?php echo $material->material_id;?>"><?php echo $material->material_name;?> (<?php echo $material->material_unit_name;?>)</option>
							<?php }?>
							</select>
					</div>
					<!--<div class="col-xs-2">
					  <label>QTY</label>
						<input type="text" class="form-control" name="po_material_qty" placeholder="QTY" value="<?php echo set_value('po_material_qty');?>" required />
					</div>
					-->
					<div class="col-xs-2">
					  <label>Harga</label>
						<input type="text" class="form-control" name="po_material_price" placeholder="Harga" value="<?php echo set_value('po_material_price');?>" required />
					</div>
					<div class="col-xs-2">
						<label>&nbsp;</label><br>
						<button type="submit" class="btn btn-primary">Tambah</button>
					</div>
				</div>
				<?php echo form_close();?>
				<div class="box-body">
				  <table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="text-center">Nama Material</th>
							<th class="text-center">QTY</th>
							<th class="text-center">Satuan (Beli)</th>
							<th class="text-center">Harga</th>
							<th class="text-center"></th>
						</tr>
					</thead>
					<tbody>
					<?php
					$total=0;
					foreach($this->cart->contents() AS $items)
					{
						$allmaterial	= $this->material_model->get_material_by_material_id($items['id']);
						foreach($allmaterial AS $material)
						{
							$material_unit_name 	= $material->material_unit_name;
						}
						// $subtotal		= $items['qty'] * $items['price'];
						$total			+= $items['price'];
						?>
					  <tr>
						<td><?php echo $items['name'];?></td>
						<td align="center"><?php echo number_format($items['qty'],0,',','.');?></td>
						<td align="center"><?php echo $material_unit_name;?></td>
						<td align="center"><?php echo number_format($items['price'],0,',','.');?></td>
						<td align="center"><a href="<?php echo base_url();?>purchase/po_material_remove_from_cart/<?php echo $items['rowid'];?>" class="glyphicon glyphicon-remove"></a></td>
					  </tr>
					<?php } ?>
						<tr>
							<td colspan="3" align="right"><b>Total :</b></td>
							<td align="center"><b><?php echo number_format($total,0,',','.');?></b></td>
							<td></td>
						</tr>
					</tbody>
				  </table>
				</div>
			  </div><!-- /.box-body -->
			  <?php
				echo form_open('purchase/po_save','class=form-horizontal');
				?>
			  <div class="box-footer">
			    <input type="hidden" name="totalpo" value="<?php echo $total;?>">
				<a href="<?php echo base_url().'purchase';?>" class="btn btn-danger">Batal</a>
				<button type="submit" class="btn btn-lg btn-success pull-right">Simpan PO</button>
			  </div><!-- /.box-footer -->
			<?php echo form_close();?>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->
