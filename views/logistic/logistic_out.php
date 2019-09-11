<script>
	$(function () {

	$('#created_time').datepicker({
						format: 'dd-mm-yyyy',
						todayBtn: true,
						todayHighlight: true,
						autoclose: true
					});




  });
</script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Main content -->
	<section class="content">

	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-success">
			<div class="box-body">
			<?php
				if ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
				elseif ($this->session->flashdata('message_sucess')) echo '<div class="alert alert-success">'.$this->session->flashdata('message_sucess').'</div>';?>
			<?php
			echo '<span class=text-red>'.validation_errors().'</span>';
			echo form_open('logistic/addcart_logistic');?>
				<div class="box-body">

					<div class="col-xs-6 col-md-3">
					  <label>Tanggal Keluar</label>
						<input type="text" class="form-control" value="<? if ($this->session->userdata('created_time')!=""){echo date('d-m-Y', strtotime($this->session->userdata('created_time')));}else{ echo date("d-m-Y");}?>" name="created_time" id="created_time" >
					</div>
                    <div class="col-xs-12 col-md-3">
						<label>Lokasi</label>
						<select name="logistic_location_id" class="form-control select2" >
							<?php
							$loc	= $this->logistic_model->get_logistic_location();
							foreach($loc as $loct)
							{
							?>
								<option value="<?php echo $loct->logistic_location_id;?>" <? if ($this->session->userdata('logistic_location_id')==$loct->logistic_location_id){echo "selected";}?>  ><?php echo $loct->logistic_location_name;?> </option>
							<?php }?>
							</select>
					</div>
					<div class="col-xs-12 col-md-3">
						<label>Status</label>
						<select class="form-control select2" name="logistic_description">
								<option value="Rusak">rusak</option>
								<option value="Return">return</option>
								<option value="Expired">expired</option>
								<option value="Hilang">hilang</option>
						</select>
					</div>
				</div>
				<div class="box-body">
					<div class="col-xs-12 col-md-6">
						<label>Material</label>
							<select name="po_material_id" class="form-control select2" autofocus>
							<?php
							$group_id = $this->session->userdata('group_id');
							$materials	= $this->material_model->get_materials($group_id);
							foreach($materials as $material)
							{
							?>
								<option value="<?php echo $material->material_id;?>"><?php echo $material->material_name;?> (<?php echo $material->material_unit_name;?>)</option>
							<?php }?>
							</select>
					</div>
					<div class="col-xs-6 col-md-2">
					  <label>QTY</label>
						<input type="text" class="form-control" name="po_material_qty" placeholder="QTY" value="<?php echo set_value('po_material_qty');?>" required >
					</div>
					<div class="col-xs-12 col-md-2">
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
							<!--<th class="text-center">Harga</th>-->
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
						<!--<td align="center"><?php echo number_format($items['price'],0,',','.');?></td>-->
						<td align="center"><a href="<?php echo base_url();?>logistic/log_remove/<?php echo $items['rowid'];?>" class="glyphicon glyphicon-remove"></a></td>
					  </tr>
					<?php } ?>
						<!--<tr>
							<td colspan="2" align="right"><b>Total :</b></td>
							<td align="center"><b><?php echo number_format($total,0,',','.');?></b></td>
							<td></td>
						</tr>-->
					</tbody>
				  </table>
				</div>
			  </div><!-- /.box-body -->
			  <?php
				echo form_open('logistic/logistic_simpan','class=form-horizontal');
				?>
			  <div class="box-footer">
			    <input type="hidden" name="totalpo" value="<?php echo $total;?>">
				<a href="<?php echo base_url().'logistic';?>" class="btn btn-danger">Batal</a>
				<button type="submit" class="btn btn-success pull-right">Simpan </button>
			  </div><!-- /.box-footer -->
			<?php echo form_close();?>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->
