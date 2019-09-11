<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	<?php
	if($this->session->userdata('group_id') == '6')
	{
	?>
	<script>
	  $(function () {
		 $('#select_food').DataTable({
			 "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
			 "pagingType": "full_numbers"
		 });
	  });
	</script>
	
	<!-- Main content -->
	<section class="content">
		<!--div class="row">
			<div class="col-xs-12">
			  <div class="box box-solid box-primary">
				<div class="box-header">
				  <h5 class="box-title"><?php echo $sub_title;?></h5>
				</div><!-- /.box-header >
			  </div>
			</div>
		</div-->
		<div class="row">
			<div class="col-xs-12">
			  <div class="box box-solid box-warning">
				<div class="box-header">
				  <h5 class="box-title"><?php echo $sub_title;?></h5>
				</div><!-- /.box-header -->
				<div class="box-body">
					<?php echo form_open('order/add_to_cart');?>
					<input type="hidden" name="session_form" value="food">
					<table id="select_food" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>Menu</th>
								<th>QTY</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($foodsrecord AS $row) : ?>
							<tr>
								<td><?php echo $row->name;?></td>
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
									<button type="submit" class="btn btn-xs btn-primary <?php echo $disabled;?>">Pesan</button>
								</td>
							</tr>
						<?php endforeach;?>
						</tbody>
					</table>
					<input type="hidden" name="product_id" value="<?php echo $row->product_id;?>">
					<?php echo form_close();?>
				</div><!-- /.box-body -->
				<div class="box-footer">
					<a href="<?php echo base_url() . 'order/cancel';?>" class="btn btn-danger">Cancel</a>
					<a href="<?php echo base_url() . 'order/review';?>" class="btn btn-success pull-right">Review</a>
					<a href="<?php echo base_url() . 'order/select_drink';?>" class="btn btn-primary pull-right">Pilih Minuman</a>
				</div><!-- /.box-footer -->
				</div><!-- /.box -->
			</div><!-- /.col -->
		</div><!-- /.row -->
		
	</section><!-- /.content -->
	<?php
	}
	else
	{
	?>
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
		<?php echo $title;?>
		<small><?php echo $sub_title;?></small>
	  </h1>
	  <!--ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $title;?></a></li>
		<li class="active"><?php echo $sub_title;?></li>
	  </ol-->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
			  <div class="box box-solid box-primary">
				<div class="box-header">
				  <h3 class="box-title"><?php echo $sub_title;?></h3>
				</div><!-- /.box-header -->
			  </div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-xs-12">
			  <div class="box box-solid box-warning">
				<div class="box-body">
				<?php foreach($foodsrecord AS $row) : ?>
					<?php echo form_open('order/add_to_cart');?>
					<div class="col-sm-3 col-md-3">
						<div class="thumbnail">
							<input type="hidden" name="product_id" value="<?php echo $row->product_id;?>">
							<input type="hidden" name="session_form" value="food">
							<!--h2 align="center"><?php //echo $row->product_id;?></h2-->
							<br><img src="<?php echo base_url();?>assets/img/product/<?php echo $row->image;?>" style="max-width:100%;max-height:100%;height:100px" class="img-circle" alt="<?php echo $row->name;?>">
							<div class="caption">
								<h4 align="center" style="min-height:60px"><?php echo $row->name;?></h4>
								<p align="center">
									<?php
									if ($row->stock < '1')
									{
										echo "<strong><span class=text-red>Out of Stock</span></strong>";
									}
									else
									{
									?>
										<select name="qty" class="form-control">
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
								</p>
								<p align="center">Rp. <?php echo number_format($row->selling_price,0,',','.');?></p>
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
								<p align="center">
									<button type="submit" class="btn btn-primary <?php echo $disabled;?>">Pesan</button>
								</p>
							</div>
						</div>
					</div>
					<?php echo form_close();?>
				<?php endforeach;?>
				</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div><!-- /.col -->
		</div><!-- /.row -->
		
		<div class="row">
			<div class="col-xs-12">
				<div class="box-footer">
					<a href="<?php echo base_url() . 'order/cancel';?>" class="btn btn-danger">Cancel</a>
					<a href="<?php echo base_url() . 'order/select_drink';?>" class="btn btn-primary pull-right">Pilih Minuman</a>
					<a href="<?php echo base_url() . 'order/review';?>" class="btn btn-success pull-right">Review</a>
				</div><!-- /.box-footer -->
			</div>
		</div>

	</section><!-- /.content -->
<?php }?>
</div><!-- /.content-wrapper -->