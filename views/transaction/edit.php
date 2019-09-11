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
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6' OR $group_id == '7')
			{
			echo form_open('transaction/table_change');
			?>
			<div class="box-body">
				<?php
				if($this->session->flashdata('message_error'))
				{
					echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
				}
				elseif($this->session->flashdata('message_success'))
				{
					echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
				}
				?>
				<div class="col-sm-3">
				  <label>Kode Trx</label>
				  <input type="text" class="form-control" value="<?php echo $trx->transaction_code;?>" disabled>
				</div>
				<div class="col-sm-4">
				  <label>Waktu Pesan</label>
				  <input type="text" class="form-control" value="<?php echo $waktu = date('d-m-Y h:i:s', strtotime($trx->created_timetrans));?>" disabled>
				</div>
				<div class="col-sm-2">
          <?php if($trx->order_status=='reservation'){
        		$table_category_id = $trx->table_category_id;
            $tables	= $this->order_model->get_table_category_name($table_category_id);
            foreach($tables AS $table)
            {
            $table_name	= $table->table_category_name;
            }
            ?>
            <label>Ruangan</label>
            <input type='text' class="form-control" value="<?php echo $table_name ?>" disabled>
            <input type='text' name="table" class="form-control hidden" value="<?php echo $table_name; ?>">
          <?php }else{ ?>
				  <label>Meja</label>
				  <select name="table" class="form-control select2">
					<option value="<?php echo $trx->table_id;?>"><?php echo $trx->table;?></option>
					  <?php
					   foreach($tablelist as $table)
					  {
						  if($table->table_list_status == 'unlock')
							{
								$class		= "";
								$disable	= "";
							}
							elseif($table->table_list_status == 'lock')
							{
								$class		= "text-yellow";
								$disable	= " disabled";
							}
					  ?>
						<option value="<?php echo $table->table_list_id;?>" class="<?php echo $class;?>"<?php echo $disable;?>><?php echo $table->table_name;?></option>
					<?php }?>
					</select>
        <?php } ?>
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
				<?php }?>
			</div><!-- /.box-header -->
			<div class="box-body">
			  <table class="table table-striped table-bordered">
				<thead>
				  <tr>
					<th class="text-center">Pemesan</th>
					<th class="text-center">Waktu Pesan</th>
					<th class="text-center">Menu</th>
					<th class="text-center">QTY</th>
					<th class="text-center">Catatan</th>
					<th class="text-center">Status</th>
					<?php
					if($group_id == '1' OR $group_id == '2')
					{?><th></th>
					<?php }?>
				  </tr>
				</thead>
				<tbody>
				<?php
					foreach($ordersrecord AS $order)
					{
					?>
				  <tr>
					<td><?php echo $order->full_name;?></td>
					<td align="center"><?php echo date('d-m-Y H:i:s', strtotime($order->created_time));?></td>
					<td><?php echo $order->product_name;?></td>
					<td align="center"><?php echo $order->qty;?></td>
					<td><?php echo $order->remark;?></td>
					<td><?php
					if($order->status == 'reserved')
					{
						echo "Baru";
					}
					elseif($order->status == 'inprogress')
					{
						echo "Diproses";
					}
					elseif($order->status == 'finished')
					{
						echo "Dihantar";
					}
					elseif($order->status == 'done')
					{
						echo "Selesai";
					}
					elseif($order->status == 'canceled')
					{
						echo "Dibatalkan";
					}
					?></td>
					<td>
					<?php
					if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '5')
					{
						if($order->status == 'reserved')
						{
							echo anchor('transaction/revoke_order/' . $trx->transaction_code.'/' . $order->order_id,'Batalkan', ['class'=>'btn btn-xs btn-danger', 'onclick'=>'return confirm(\'Apakah Anda Yakin?\')']);

						}
						elseif($order->status == 'canceled')
						{
							$users = $this->account_model->get_user_by_user_id($order->deleted_by);
							foreach($users AS $user)
							{
								$cancel_by_name	= $user->full_name;
							}
							echo "<label class=\"text-red\">Batal</label> ($cancel_by_name)";

						}
					}
					?>
					</td>
				  </tr>
				  <?php };?>
				</tbody>
			  </table>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
		<div class="col-xs-3">
			<div class="box box-solid box-success">
				<div class="box-body">
					<input type="hidden" name="transaction_code" value="<?php echo $trx->transaction_code;?>">
					<button type="submit" class="btn btn-lg btn-success btn-block">Simpan</button>
          <?php if($trx->order_status=='reservation'){ ?>
          <a href="<?php echo base_url();?>order/add_order_reservation/<?php echo $trx->transaction_code .'/'. $table_name .'/'. 'reservation' .'/'. 'edit/' . $waktu?>" class="btn btn-lg btn-warning btn-block">Tambah Pesanan</a>
          <?php }else{ ?>
          <a href="<?php echo base_url();?>order/add_order/<?php echo $trx->transaction_code .'/'. $trx->table_id;?>" class="btn btn-lg btn-warning btn-block">Tambah Pesanan</a>
          <?php } ?>
          <a href="<?php echo base_url()?>transaction/detail/<?php echo $trx->transaction_code;?>" class="btn btn-lg btn-primary btn-block">Kembali</a>
				</div>
			</div>
		</div>
		<?php echo form_close();
			}
		?>
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->
