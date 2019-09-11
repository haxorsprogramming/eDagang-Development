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
	<a href="<?php echo base_url();?>transaction" class="btn btn-primary">Transaksi</a>
</section>

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
	<div class="col-xs-12">
	  <div class="box box-solid box-warning">
		<div class="box-body">
		<?php


			if($this->session->flashdata('message_error'))
			{
				echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
			}
			elseif($this->session->flashdata('message_success'))
			{
				echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
				echo '<div><a href='.base_url().'transaction/receipt/'.$this->session->flashdata('transaction_code').' class=\'btn btn-lg btn-danger\' target=\'_blank\'>Cetak Struk</a></div><br>';
			}

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' or $group_id == '5' or $group_id == '6' )
			{
			?>
            	<div class="row">
            	  <div class="col-xs-12">
				<?php echo form_open('transaction/list_reservasi_search');?>
				<div class="col-xs-12 col-md-3">
					<div class="input-group">
					 <span class="input-group-addon">Dari :</span>
					  <input type="text" class="form-control" id="start_date" name="start_date" value="<?php echo $tglawal;?>">
					</div><!-- /.input group -->
				</div>
				<div class="col-xs-12 col-md-3">
					<div class="input-group">
					   <span class="input-group-addon">Sampai :</span>
					   <input type="text" class="form-control" id="end_date" name="end_date" value="<?php echo $tglakhir;?>">
					</div>
				</div><!-- /.input group -->
				<div class="col-xs-12 col-md-1">
					<div class="input-group">
					   <button class="btn btn-block btn-primary">Cari</button>
					</div>
				</div><!-- /.input group -->
				<div class="col-xs-2">

				</div><!-- /.input group -->
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

				<th class="text-center">Kode Trx</th>
				<th class="text-center">Waktu Pesan</th>
				<!--th class="text-center">Pemesan</th-->
				<th class="text-center">Ruangan</th>
                 <th class="text-center">Pelanggan</th>
				<th class="text-center">Catatan</th>
				<th class="text-center">Keterangan</th>
				<th class="text-center">Status</th>
			  </tr>
			</thead>
			<tfoot>
			  <tr>

				<th class="text-center">Kode Trx</th>
				<th class="text-center">Waktu Pesan</th>
				<!--th class="text-center">Pemesan</th-->
				<th class="text-center">Ruangan</th>
        <th class="text-center">Pelanggan</th>
				<th class="text-center">Catatan</th>
				<th class="text-center">Keterangan</th>
				<th class="text-center">Status</th>
			  </tr>
			</tfoot>
			<tbody>
			<?php
				$group_id	= $this->session->userdata('group_id');
				if(isset($transactionsrecord))
				{
				    //print_r($transactionsrecord);
				foreach($transactionsrecord AS $trx)
				{
          if($trx->order_status=='reservation'){
				?>
			  <tr>

				<td align="center"><?php echo $trx->transaction_code;?></td>
				<td align="center"><?php echo date('d-m-Y H:i:s', strtotime($trx->created_time));?></td>
				<!--td align="center"><?php
				$createdbyname	= $this->account_model->get_user_by_user_id($trx->created_by);
				foreach($createdbyname AS $createdby_name)
				{
					$createdbyname	= $createdby_name->full_name;
				}
				if($createdbyname)
					echo $createdbyname;
				else
					echo '';
				?></td-->
				<td align="center"><?php
				if ($trx->deleted_status == 0 AND ($trx->status == 'unpaid' OR $trx->status == 'paid'))
				{
					if($trx->order_status == 'on_the_spot')
					{
						$order_status	= 'Makan Di Tempat';
					}
					elseif($trx->order_status == 'take_away')
					{
						$order_status	= 'Take Away';
					}
					elseif($trx->order_status == 'reservation')
					{
						$order_status	= 'Reservasi';
					}
					//echo anchor('transaction/detail/' . $trx->transaction_code,$trx->table, ['class'=>'btn btn-xs btn-primary btn-block']);
				}
        if($trx->table!=NULL){

      }if($trx->table_category_id!=NULL){
				echo anchor('transaction/detail/' . $trx->transaction_code,$trx->table_category_name.'(Reservasi)', ['class'=>'btn btn-xs btn-warning btn-block']);
        }
        //if($trx->deleted_status == 1 AND ($group_id = 1 OR $group_id = 2 OR $group_id = 3 OR $group_id = 4 OR $group_id = 5 OR $group_id = 6))
				//{
					//echo anchor('transaction/detail/' . $trx->transaction_code,$trx->table, ['class'=>'btn btn-xs btn-primary btn-block']);
				//}
				?></td>
        <td align="center"><?php echo $trx->customer_full_name;?></td>
				<td align="center"><?php echo $trx->remark_table;?></td>
				<td align="center"><?php echo $trx->note;?></td>
				<td align="center"><?php
					if ($trx->status == 'unpaid' AND $trx->deleted_status ==0 )
					{
						echo "<span class=text-yellow>Belum Bayar</span>";
					}
					elseif($trx->status == 'paid' AND $trx->deleted_status ==0 )
					{
						echo "<span class=text-green>Lunas</span>";
					}
					elseif($trx->deleted_status == 1 OR $trx->status == 'canceled')
					{
						echo "<span class=text-red>Batal</span>";
					}
					?>
				</td>
			  </tr>
			  <?php }
          }
				}
				else
				{?>
					<div class="overlay">
					  <i class="fa fa-refresh fa-spin"></i>
					</div>
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
<script>
	function printReceipt()
	{
		var payment_method			= $('#payment_method').val();
		var customer_id				= $('#customer_id').val();
		var transaction_code		= $('#transaction_code').val();
		//alert(customer_id);
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>transaction/payment_process",
			data: "payment_method="+payment_method+"&customer_id="+customer_id+"&transaction_code="+transaction_code
		});
	}
</script>
