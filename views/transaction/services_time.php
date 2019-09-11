<script>
  $(function () {

	 
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
	  <div class="box box-solid box-success">
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
				echo '<div><a href='.base_url().'transaction/receipt/'.$this->session->flashdata('transaction_code').' class=\'btn btn-lg btn-danger\' target=\'_blank\'>Cetak Struk</a></div><br>';
			}
			?>
            
            <div class="row">
            	  <div class="col-xs-12">
				<?php echo form_open('transaction/services_time');?>
				<div class="col-xs-12 col-md-3">
					<div class="input-group">
					 <span class="input-group-addon">Dari :</span>
					  <input type="text" class="form-control" id="start_date" name="start_date" value="<?php echo date('d-m-Y');?>">
					</div><!-- /.input group -->
				</div>
				<div class="col-xs-12 col-md-3">
					<div class="input-group">
					   <span class="input-group-addon">Sampai :</span>
					   <input type="text" class="form-control" id="end_date" name="end_date" value="<?php echo date('d-m-Y');?>">
					</div>
				</div><!-- /.input group -->
				<div class="col-xs-1">
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
            
		  <table id="transaction" class="table table-striped table-bordered table-hover">
<!--		  <table id="services_time" class="display" cellspacing="0" width="100%">-->
			<thead>
			  <tr>
				<th class="text-center">No. Order</th>
                <th class="text-center">Meja</th>
				<th class="text-center">Pemesan</th>
				<th class="text-center">Menu</th>
				<th class="text-center">Waktu Pesan</th>
				<th class="text-center">Waktu Respon</th>
				<th class="text-center">Waktu Selesai</th>
				<th class="text-center">Waktu Hantar</th>
                <th class="text-center">Waktu Layanan</th>
			  </tr>
			</thead>
			<tfoot>
			  <tr>
				<th class="text-center">No. Order</th>
                <th class="text-center">Meja</th>
				<th class="text-center">Pemesan</th>
				<th class="text-center">Menu</th>
				<th class="text-center">Waktu Pesan</th>
				<th class="text-center">Waktu Respon</th>
				<th class="text-center">Waktu Selesai</th>
				<th class="text-center">Waktu Hantar</th>
                  <th class="text-center">Waktu Layanan</th>
			  </tr>
			</tfoot>
			<tbody>
			<?php
				
				foreach($servicesrecord AS $service)
				{
				?>
			  <tr>
				<td align="center"><?php echo $service->order_id;?></td>
                <td align="center"><?php echo $service->table_category_name;?> <?php echo $service->table_name;?></td>
				<td align="center"><?php echo $service->full_name;?></td>
				<td align="center"><?php echo $service->product_name;?></td>
				<td align="center"><?php echo date('d-m-Y H:i:s',strtotime($service->created_time));?></td>
				<td align="center"><?php if ($service->inprogress_time == '0000-00-00 00:00:00') echo ''; else echo date('d-m-Y H:i:s',strtotime($service->inprogress_time));?></td>
				<td align="center"><?php if ($service->finished_time == '0000-00-00 00:00:00') echo ''; else echo date('d-m-Y H:i:s',strtotime($service->finished_time));?></td>
				<td align="center"><?php if ($service->done_time == '0000-00-00 00:00:00') echo ''; else echo date('d-m-Y H:i:s',strtotime($service->done_time));?></td>
				<td align="center"><?php if ($service->services_time == '-838:59:59') echo ''; else echo $service->services_time;?></td>
			  </tr>
			  <?php };
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
  $(function () {
	 $('#transaction').DataTable({
		 "lengthMenu": [[15, 50, 100, -1], [15, 50, 100, "All"]],
		 //"order": [[ 0, "desc" ]],
		 "pagingType": "full_numbers",
		 "scrollX": true,
		 //"processing": true,
        //"serverSide": true,
		"order": [],
//        "ajax": {
//			"url": "<?php echo base_url('transaction/services_time_ajax');?>",
//			"type": "POST"
//        },
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
	 });
	 $('div.dataTables_filter input').focus();
  });
</script>