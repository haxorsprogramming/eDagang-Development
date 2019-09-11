<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Main content -->
	<section class="content">
	  <!-- Small boxes (Stat box) -->
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-warning">
			<div class="box-header">
			<?php
			foreach($transactionrecord AS $trx)
			{
			?>
				<h3 class="box-title"><?=$sub_title?></h3> <?php echo anchor('order/add_order/'.$trx->transaction_code.'/'.$trx->table,'Tambah Pesanan', ['class'=>'btn btn-xs btn-primary pull-right']);?>
			</div>
			<?php echo form_open('order/table_change',['class'=>'form-horizontal']);?>
			<div class="box-body">
				<div class="col-sm-3">
				  <label>No. Transaksi</label>
				  <input type="text" class="form-control" value="<?php echo $trx->transaction_code;?>" disabled>
				</div>
				<div class="col-sm-3">
				  <label>Status</label>
				  <input type="text" class="form-control" value="<?php 
						if ($trx->status == 'unpaid')
						{
							echo "BELUM BAYAR";
						}
						elseif($trx->status == 'paid')
						{
							echo "LUNAS";
						}
						?>" disabled>
				</div>
				<div class="col-sm-4">
				  <label>Waktu Pesan</label>
				  <input type="hidden" name="transaction_code" value="<?php echo $trx->transaction_code;?>">
				  <input type="text" class="form-control" value="<?php echo date('d-m-Y H:i:s', strtotime($trx->created_time));?>" disabled>
				</div>
				<div class="col-sm-2">
				  <label>No. Meja</label>
					<select name="table" class="form-control">
					<option value="<?php echo $trx->table_id;?>"><?php echo $trx->table;?></option>
					  <?php
					  foreach($tableavailable as $table)
					  {
						  if($table->available == 0)
							{
								$class		= "";
								$disable	= "";
							}
							elseif($table->available == 1)
							{
								$class		= "text-yellow";
								$disable	= " disabled";
							}
					  ?>
						<option value="<?php echo $table->table_list_id;?>" class="<?php echo $class;?>"<?php echo $disable;?>><?php echo $table->table_name;?></option>
					<?php }?>
					</select>
				</div>
				<?php }?>
			</div><!-- /.box-header -->
			<div class="box-body">
			<?php
				if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
			  <table class="table table-striped table-bordered">
				<thead>
				  <tr>
					<th>Oleh</th>
					<th>Waktu Pesan</th>
					<th>Menu</th>
					<th>Jumlah</th>
				  </tr>
				</thead>
				<tbody>
				<?php
					foreach($ordersrecord AS $order)
					{
					?>
				  <tr>
					<td><?php echo $order->full_name;?></td>
					<td><?php echo date('d-m-Y H:i', strtotime($order->created_time));?></td>
					<td><?php echo $order->product_name ;?></td>
					<td><?php echo $order->qty;?></td>
				  </tr>
				  <?php };?>
				</tbody>
			  </table>
			</div><!-- /.box-body -->
			<div class="box-footer">
				<a href="<?=base_url()?>order/history" class="btn btn-primary">Kembali</a>
				<button type="submit" class="btn btn-success pull-right">Simpan</button>
			</div><!-- /.box-footer -->
		   <?php echo form_close();?>
			<!-- general form elements disabled -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->