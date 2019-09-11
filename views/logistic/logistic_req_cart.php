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
			echo form_open('logistic/log_material_add_to_cart');?>
				<div class="box-body">
					<div class="col-xs-3">
					  <label>Tanggal Dibutuhkan</label>
						<input type="text" class="form-control" value="<?php echo date('d-m-Y',strtotime($this->session->userdata('pr_date_required')));?>" disabled>
					</div>
					
					<div class="col-xs-5">
					  <label>Keterangan</label>
						<input type="text" class="form-control" value="<?php echo $this->session->userdata('pr_note');?>" disabled>
					</div>
				</div>
				<div class="box-body">
					<div class="col-xs-3">
						<label>Material</label>
							<select name="pr_material_id" class="form-control select2" autofocus>
							<?php
							$materials	= $this->material_model->get_materialsbeli();
							foreach($materials as $material)
							{
							?>
								<option value="<?php echo $material->material_id;?>"><?php echo $material->material_name;?> (<?php echo $material->material_unit_name;?>)</option>
							<?php }?>
							</select>
					</div>
					<div class="col-xs-3">
					  <label>QTY</label>
						<input type="text" class="form-control" name="pr_material_qty" placeholder="QTY" value="<?php echo set_value('pr_material_qty');?>">
					</div>
                   <!-- <div class="col-xs-3">
					  <label>Supplier</label>
                      <select name="pr_supplier" class="form-control select2" autofocus>
					  <?php
					 $suppliers	= $this->purchase_model->get_suppliers();
					 foreach($suppliers AS $supplier)
					 {
						 $supplier_full_name	= $supplier->supplier_full_name;
						 $supplier_hp			= $supplier->supplier_hp;
						 $supplier_id			= $supplier->supplier_id;
						 ?>
                         <option value="<?php echo $supplier_id;?>#<?php echo $supplier_full_name;?>"><?php echo $supplier_full_name;?> (<?php echo $supplier_hp;?>)</option>
                         <?
					 }
					  ?>
                      
						</select>
					</div>-->
					<div class="col-xs-3">
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
							<th class="text-center">Satuan</th>
                            <!--<th class="text-center">Supplier</th>-->
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
						?>
					  <tr>
						<td><?php echo $items['name'];?></td>
						<td align="center"><?php echo number_format($items['qty'],0,',','.');?></td>
						<td align="center"><?php echo $material_unit_name;?></td>
                     <!--   <td align="center"><?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

                                                <?php echo $option_value; ?><br />

                                        <?php endforeach; ?></td>-->
						<td align="center"><a href="<?php echo base_url();?>purchase/pr_material_remove_from_cart/<?php echo $items['rowid'];?>" class="glyphicon glyphicon-remove"></a></td>
					  </tr>
					<?php } ?>
					</tbody>
				  </table>
				</div>
			  </div><!-- /.box-body -->
			  <?php
				echo form_open('logistic/logistic_save','class=form-horizontal');
				?>
			  <div class="box-footer">
			    <input type="hidden" name="pr_date_required" value="<?php echo $this->session->userdata('pr_date_required');?>">
				<a href="<?php echo base_url().'logistic/logistic_cancel';?>" class="btn btn-danger">Batal</a>
				<button type="submit" class="btn btn-lg btn-success pull-right">Simpan SR</button>
			  </div><!-- /.box-footer -->
			<?php echo form_close();?>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->