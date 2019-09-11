<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Main content -->
	<section class="content">
	  <!-- Small boxes (Stat box) -->
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-warning">
			<?php
			foreach($transactionrecord AS $trx)
			{
			?>
			<div class="form-horizontal">
			<div class="box-body">
				<table width="100%">
					<tr>
						<td><label>No. Transaksi</label></td>
						<td width="120"><input type="text" class="form-control" value="<?php echo $trx->transaction_code;?>" disabled></td>
						<td width="50">&nbsp;</td>
						<td><label>Waktu Pesan</label></td>
						<td width="170"><input type="text" class="form-control" value="<?php echo date('d-m-Y H:i:s', strtotime($trx->created_time));?>" disabled></td>
						<td width="50">&nbsp;</td>
						<td><label>No. Meja</label></td>
						<td width="100"><input type="text" class="form-control" value="<?=$trx->table?>" disabled></td>
					<tr>
				</table>
				<?php }?>
			</div><!-- /.box-header -->
			</div>
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
					<th>Remark</th>
				  </tr>
				</thead>
				<tbody>
				<?php
					foreach($ordersrecord AS $order)
					{
					?>
				  <tr>
					<td><?php echo $order->full_name;?></td>
					<td><?php echo date('d-m-Y H:i:s', strtotime($order->created_time));?></td>
					<td><?php echo $order->product_name;?></td>
					<td><?php echo $order->qty;?></td>
					<td><?php
					$options	= unserialize($order->options);
					$remark		= element('remark',$options);
					echo $remark;?></td>
				  </tr>
				  <?php };?>
				</tbody>
			  </table>
			</div><!-- /.box-body -->
			<div class="box-footer">
				<a href="<?php echo base_url();?>order/history" class="btn btn-primary">Kembali</a>
			</div><!-- /.box-footer -->
			<!-- general form elements disabled -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
</div><!-- /.content-wrapper -->