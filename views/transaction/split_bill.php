<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
	<div class="col-xs-9">
	  <div class="box box-solid box-success">
		<?php
		foreach($transactionrecord AS $trx)
		{
		?>
		<div class="box-body">
			<?php
			if ($this->session->flashdata('message_error'))
				echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
			elseif ($this->session->flashdata('message_success'))
				echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
			?>
			<div class="col-sm-3">
				<label>Kode Trx</label>
				<input type="text" class="form-control" value="<?php echo $trx->transaction_code;?>" disabled>
			</div>
			<div class="col-sm-4">
				<label>Waktu Pesan</label>
				<input type="text" class="form-control" value="<?php echo date('d-m-Y H:i:s',strtotime($trx->created_time));?>" disabled>
			</div>
			<div class="col-sm-2">
				<label>Meja</label>
				<input type="text" class="form-control" value="<?php echo $trx->table;?>" disabled>
			</div>
			<div class="col-sm-3">
				<label>Status Transaksi</label>
				<input type="text" class="form-control" value="<?php if ($trx->status == 'unpaid' AND $trx->deleted_status == 0)
					{
						echo "BELUM BAYAR";
					}
					elseif($trx->status == 'paid' AND $trx->deleted_status == 0)
					{
						echo "LUNAS";
					}
					elseif($trx->deleted_status == 1)
					{
						echo "BATAL";
					}
					?>" disabled>
			</div>
		</div>
		<div class="box-body">
		  <table class="table table-striped table-bordered">
			<thead>
			  <tr>
				<th class="text-center">Pemesan</th>
				<th class="text-center">Waktu Pesan</th>
				<th class="text-center">Menu</th>
				<th class="text-center">QTY</th>
				<th class="text-center">@Harga</th>
				<th class="text-center">Total</th>
				<th class="text-center">Status</th>
				<th class="text-center"></th>
			  </tr>
			</thead>
			<tbody>
			<?php
				$price			= 0;
				$discount		= 0;
				$total 			= 0;
				$subtotal 		= 0;
				$tax 			= 0;
				$service 		= 0;
				$grandtotal		= 0;
				$k=0;
				foreach($ordersrecord AS $order)
				{
					$price			= $order->selling_price;
					$subtotal		= $order->qty * $price;
					$total			+= $subtotal;
					$tax		= $total * ($this->session->userdata('tax_fare') / 100);
					$service	= $total * ($this->session->userdata('service_fare') / 100);
					$grandtotal	= $total + $tax + $service;
			
			echo form_open('transaction/split_bill_process');
			?>
			  <tr>
				<td><?php echo $order->full_name;?></td>
				<td><?php echo date('d-m-Y H:i:s',strtotime($order->created_time));?></td>
				<td><?php echo $order->product_name ;?></td>
				<!--td>
				<select name="qty">
				<option value="<?php echo $order->qty;?>"><?php echo $order->qty;?></option>
				<?php
				
				for($i=1;$i<$order->qty;$i++)
				{
				?>
					<option value="<?php echo $i;?>"><?php echo $i;?></option>
				<?php
				}
				?>
				</select>
				</td-->
				<td><input type="hidden" value="<?php echo $order->qty;?>" name="qtysplitawal[]" ><input type="number" value="<?php echo $order->qty;?>" name="qtysplit[]" style="text-align:right"></td>
				<td><?php echo number_format($order->selling_price,0,',','.');?></td>
				<td><?php echo number_format($subtotal,0,',','.');?></td>
				<td><?php
				if($order->status == 'reserved')
				{
					echo "Pesanan Baru";
				}
				elseif($order->status == 'inprogress')
				{
					echo "Sedang Diproses";
				}
				elseif($order->status == 'finished')
				{
					echo "Sedang Dihantar";
				}
				elseif($order->status == 'done')
				{
					echo "Selesai";
				}
				?></td>
				<td><input type="checkbox" name="order_id[]" value="<?php echo $order->order_id;?>#<?php echo $k;?>"></td>
			  </tr>
			  <?php 
			  $k++;
			  };?>
			  <tr>
				<td colspan="8">
					<div class="col-sm-3">
						<label>Subtotal</label>
						<input type="text" class="form-control" value="<?php echo number_format($total,0,',','.');?>" disabled>
					</div>
					<div class="col-sm-3">
						<label>Disc. Items</label>
						<input type="text" class="form-control" value="<?php echo number_format($discount,0,',','.');?>" disabled>
					</div>
					<div class="col-sm-3">
						<label>Total</label>
						<input type="text" class="form-control" value="<?php echo number_format($total,0,',','.');?>" disabled>
					</div>
					<div class="col-sm-3">
						<label>Tax + Service</label>
						<input type="text" class="form-control" value="<?php echo number_format($tax,0,',','.')?> + <?php echo number_format($service,0,',','.');?>" disabled>
					</div>
				</td>
			  </tr>
			</tbody>
		  </table>
		<?php 
		
		}?>
		</div>
	  </div><!-- /.box -->
	</div><!-- /.col -->
	<div class="col-xs-3">
		<div class="box box-solid box-success">
			<!--div class="body">
				<table class="table">
					<!--tr>
						<td colspan="2" align="center"><h3>Grand Total<br>Rp. <?=number_format($grandtotal,0,',','.')?></h3></td>
					</tr>
					<!--tr>
						<td align="right">Pelanggan</td>
						<td>
							<select name="customer_id" class="form-control">
							<?php
							$customers	= $this->customer_model->get_customer_by_customer_id($trx->customer_id);
							foreach($customers AS $customer)
							{
								?>
								<option value="<?php echo $customer->customer_id;?>"><?php echo $customer->customer_full_name;?></option>
								<?php
							}
							?>
							</select>
						</td>
					</tr>
				</table>
			</div-->
			<div class="box-footer">
				<input type="hidden" name="transaction_code" value="<?php echo $trx->transaction_code;?>">
				<input type="hidden" name="table_id" value="<?php echo $trx->table_id;?>">
				<input type="hidden" name="table" value="<?php echo $trx->table;?>">
				<input type="hidden" name="customer_id" value="<?php echo $trx->customer_id;?>">
				<input type="hidden" name="remark_table" value="<?php echo $trx->remark_table;?>">
				<input type="hidden" name="transaction_note" value="Split Bill dari Kode Trx <?php echo $trx->transaction_code;?> / No. Meja <?php echo $trx->table;?>">
				<button type="submit" class="btn btn-lg btn-warning btn-block">Split Bill</button>
				<?php echo anchor('transaction/detail/' . $trx->transaction_code, 'Kembali', ['class'=>'btn btn-lg btn-primary btn-block']);?>
			</div><!-- /.box-footer -->
			<?php echo form_close();?>
		</div>
  </div><!-- /.row (main row) -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->