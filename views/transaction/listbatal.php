<script>
  $(function () {
	 $('#transaction').DataTable({
		 "lengthMenu": [[15, 50, 100, -1], [15, 50, 100, "All"]],
		 "order": [[ 6, "asc" ]],
		 "pagingType": "full_numbers",
		 "scrollX": true
	 });
	 $('div.dataTables_filter input').focus();
	 
	 $('#start_date').datepicker({
						format: 'dd-mm-yyyy',
						todayBtn: true,
						todayHighlight: true,
						autoclose: true
					});
	$('#end_date').datepicker({
						format: 'dd-mm-yyyy',
						todayBtn: true,
						todayHighlight: true,
						autoclose: true
					});
	 
  });
  
  
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <a href="<?php echo base_url();?>transaction/" class="btn btn-warning">Transaksi</a>
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
				//echo '<div><a href='.base_url().'transaction/receipt/'.$this->session->flashdata('transaction_code').' class=\'btn btn-lg btn-danger\' target=\'_blank\'>Cetak Struk</a></div><br>';
			}
			
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' or $group_id == '5' )
			{
			?>
            	<div class="row">
            	  <div class="col-xs-12">
				<?php echo form_open('transaction/listbatal');?>
				<div class="col-xs-3">
					<div class="input-group">
					 <span class="input-group-addon">Dari :</span>
					  <input type="text" class="form-control" id="start_date" name="start_date" value="<?php echo $tglawal;?>">
					</div>
				</div>
				<div class="col-xs-3">
					<div class="input-group">
					   <span class="input-group-addon">Sampai :</span>
					   <input type="text" class="form-control" id="end_date" name="end_date" value="<?php echo $tglakhir;?>">
					</div>
				</div>
				<div class="col-xs-1">
					<div class="input-group">
					   <button class="btn btn-block btn-primary">Cari</button>
					</div>
				</div>
				<div class="col-xs-2">
					
				</div> 
				<?php echo form_close();?>
			  </div>
              </div>
              <br>
              <?
			}
              ?>
		  <table id="transaction" class="table table-striped table-bordered table-hover">
			<thead>
			  <tr>
			    <th class="text-center">Kode Transaksi</th>
				<th class="text-center">Nama Produk</th>
				<th class="text-center">Tgl Order</th>
				<th class="text-center">Tgl Perubahan</th>
				<th class="text-center">User Perubahan</th>
				<th class="text-center">Jenis Perubahan</th>
			     <th class="text-center">Keterangan Perubahan</th>
			  </tr>
			</thead>
			<tfoot>
			    <tr>
			    <th class="text-center">Kode Transaksi</th>
				<th class="text-center">Nama Produk</th>
				<th class="text-center">Tgl Order</th>
				<th class="text-center">Tgl Perubahan</th>
				<th class="text-center">User Perubahan</th>
				<th class="text-center">Status Perubahan</th>
			     <th class="text-center">Keterangan Perubahan</th>
			
			  </tr>
			</tfoot>
			<tbody>
			<?php
				
				foreach($dp AS $trx)
				{
				?>
			  <tr>
			    <td align=""><?php echo $trx->transaction_code;?></td>
				<td align=""><?php echo $trx->product_name;?></td>
				<td align=""><?php echo date('d-m-Y H:i:s', strtotime($trx->created_time));?></td>
                <td align=""><?php echo date('d-m-Y H:i:s', strtotime($trx->tgl_batal));?></td>
			    <td align=""><?php echo $trx->username;?> (<?php echo $trx->full_name;?>)</td>
                <td align=""><?php echo $trx->status_batal;?></td>
                <td align=""><?php echo $trx->keterangan_batal;?></td>
			  </tr>
			  
				<?php }
			  ?>
			</tbody>
		  </table>
		</div><!-- /.box-body -->
	  </div><!-- /.box -->
	</div><!-- /.col -->
  </div><!-- /.row (main row) -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->
