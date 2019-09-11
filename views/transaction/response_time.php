<script>
  $(function () {
	 $('#response_time').DataTable({
		 "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
		 "order": [[ 0, "desc" ]],
		 "pagingType": "full_numbers"
	 });
	 
  });
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	<a href="<?php echo base_url();?>transaction" class="btn btn-primary">Data Transaksi</a>
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
	  <div class="box box-solid box-warning">
		<div class="box-body">
		<?php
			$group_id = $this->session->userdata('group_id');
			
			if($this->session->flashdata('message_error'))
			{
				echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
			}
			elseif($this->session->flashdata('message_success'))
			{
				echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
				echo '<div><a href='.base_url().'transaction/receipt/'.$this->session->flashdata('transaction_id').' class=\'btn btn-lg btn-danger\' target=\'_blank\'>Cetak Struk</a></div><br>';
			}
			?>
		  <table id="response_time" class="table table-striped table-bordered table-hover">
			<thead>
			  <tr>
				<th class="text-center">No. Trx</th>
				<th class="text-center">Oleh</th>
				<th class="text-center">Menu</th>
				<th class="text-center">Waktu Pesan</th>
				<th class="text-center">Waktu Respon</th>
				<th class="text-center">Waktu Selesai</th>
				<th class="text-center">Waktu Hantar</th>
				<th class="text-center">Waktu Layanan</th>
			  </tr>
			</thead>
			<tbody>
			<?php
				foreach($responsesrecord AS $rsp)
				{
				?>
			  <tr>
				<td align="center"><?php echo $rsp->order_id;?></td>
				<td align="center"><?php echo $rsp->full_name;?></td>
				<td align="center"><?php echo $rsp->product_name;?></td>
				<td align="center"><?php echo date('d-m-Y H:i:s',strtotime($rsp->created_time));?></td>
				<td align="center"><?php if ($rsp->inprogress_time == '0000-00-00 00:00:00') echo ''; else echo date('d-m-Y H:i:s',strtotime($rsp->inprogress_time));?></td>
				<td align="center"><?php if ($rsp->finished_time == '0000-00-00 00:00:00') echo ''; else echo date('d-m-Y H:i:s',strtotime($rsp->finished_time));?></td>
				<td align="center"><?php if ($rsp->done_time == '0000-00-00 00:00:00') echo ''; else echo date('d-m-Y H:i:s',strtotime($rsp->done_time));?></td>
				<td align="center"><?php if ($rsp->responses == '-838:59:59') echo ''; else echo $rsp->responses;?></td>
			  </tr>
			  <?php };?>
			</tbody>
		  </table>
		</div><!-- /.box-body -->
	  </div><!-- /.box -->
	</div><!-- /.col -->
  </div><!-- /.row (main row) -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->