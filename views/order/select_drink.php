	<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title;?>
            <small><?php echo $title;?></small>
          </h1>
          <!--ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $title;?></a></li>
            <li class="active"><?php echo $sub_title;?></li>
          </ol-->
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
		  <div class="row">
			<div class="col-xs-12">
              <div class="box box-solid box-success">
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
				<?php foreach($drinksrecord AS $row) : ?>
					<?php echo form_open('order/add_to_cart');?>
					<div class="col-sm-3 col-md-3">
						<div class="thumbnail">
							<input type="hidden" name="product_id" value="<?php echo $row->product_id;?>">
							<input type="hidden" name="session_form" value="drink">
							<!--h3 align="center"><?php //echo $row->product_id;?></h3-->
							<br><img src="<?php echo base_url();?>assets/img/product/<?php echo $row->image?>" style="max-width:100%;max-height:100%;height:100px" class="img-circle" alt="<?php echo $row->name;?>">
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
						<a href="<?php echo base_url() . 'order/select_food';?>" class="btn btn-primary">Pilih Makanan</a>
						<a href="<?php echo base_url() . 'order/cancel';?>" class="btn btn-danger">Cancel</a>
						<a href="<?php echo base_url() . 'order/review';?>" class="btn btn-success pull-right">Next</a>
					</div><!-- /.box-footer -->
				</div>
			</div

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->