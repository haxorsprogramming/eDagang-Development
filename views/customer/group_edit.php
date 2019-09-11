<?php
	foreach($group as $row)
	{
		$customer_group_id	= $row->customer_group_id;
		if ($this->input->post('is_submitted'))
		{
			$customer_group_name			= $row->customer_group_name;
			$customer_group_discount		= $row->customer_group_discount;
			$customer_group_selling_price	= $row->customer_group_selling_price;
		}
		else
		{
			$customer_group_name			= $row->customer_group_name;
			$customer_group_discount		= $row->customer_group_discount;
			$customer_group_selling_price	= $row->customer_group_selling_price;
		}
		if($customer_group_selling_price == 'purchase_price')
		{
			$customer_group_selling_price_name	= 'Harga Modal';
		}
		elseif($customer_group_selling_price == 'selling_price')
		{
			$customer_group_selling_price_name	= 'Harga Jual';
		}
	}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
	
	<div class="col-xs-12">
	  <div class="box box-solid box-success">
		<div class="box-header with-border">
		  <h3 class="box-title"><?php echo $sub_title;?></h3>
		</div><!-- /.box-header -->
		<div class="box-body">
		<?php					
			if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
		<!-- form start -->
		<?php 
		echo '<span class=text-red>'.validation_errors().'</span>';
		echo form_open('customer/group_edit/' . $customer_group_id,['class'=>'form-horizontal']);?>
		  <div class="box-body">
			<div class="form-group">
			  <label class="col-sm-2 control-label">Nama Group</label>
			  <div class="col-sm-4">
				<input type="text" class="form-control" name="customer_group_name" value="<?php echo $customer_group_name;?>">
			  </div>
			</div>
			<div class="form-group">
			  <label class="col-sm-2 control-label">Harga Jual</label>
			  <div class="col-xs-3">
					<select name="customer_group_selling_price" class="form-control">
						<option value="<?php echo $customer_group_selling_price;?>"><?php echo $customer_group_selling_price_name;?></option>
						<option value="selling_price">Harga Jual</option>
						<option value="purchase_price">Harga Modal</option>
					</select>
			  </div>
			</div>
			<div class="form-group">
			  <label class="col-sm-2 control-label">Discount</label>
			  <div class="col-xs-2">
				<select name="customer_group_discount" class="form-control">
					<option value="<?php echo $customer_group_discount;?>"><?php echo $customer_group_discount;?>%</option>
					<?php
					for($i=1;$i<=100;$i++)
					{
						$r=$i+=4;
						?>
						<option value="<?=$r?>"><?=$r?>%</option>
						<?php
					}
					?>
				</select>
			  </div>
			</div>
		  </div><!-- /.box-body -->
		  <div class="box-footer">
			<input type="hidden" name="is_submitted" value="1">
			<button type="submit" class="btn btn-success">Simpan</button>
			<a href="<?php echo base_url();?>customer/group" class="btn btn-danger pull-right">Batal</a>
		  </div><!-- /.box-footer -->
	   <?php echo form_close();?>
		</div><!-- /.box-body -->
	  </div><!-- /.box -->
	</div><!-- /.col -->
  </div><!-- /.row (main row) -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->