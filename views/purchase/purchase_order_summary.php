<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	
	<!-- Content Header (Page header) -->
	<?
	//echo $this->session->userdata('group_id');
	if($this->session->userdata('group_id')==3 or $this->session->userdata('group_id')==4 or $this->session->userdata('group_id')==18){
	}else{
	?>
	<section class="content-header">
		<a href="<?=base_url()?>purchase/po_create" class="btn btn-warning">Buat PO</a>&nbsp;
	</section>
	<?
	}
	?>
	
	<!-- Main content -->
	<section class="content">
		
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-success">
			<div class="box-body">
			  <div class="col-xs-12">
				<?php echo form_open('purchase/po_search');?>
				<div class="col-xs-3">
					<div class="input-group">
					 <span class="input-group-addon">Dari :</span>
					  <input type="text" class="form-control" id="start_date" name="start_date" value="<?php echo $start_date;?>">
					</div><!-- /.input group -->
				</div>
				<div class="col-xs-3">
					<div class="input-group">
					   <span class="input-group-addon">Sampai :</span>
					   <input type="text" class="form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>">
					</div>
				</div><!-- /.input group -->
				<div class="col-xs-1">
					<div class="input-group">
					   <button class="btn btn-block btn-primary">Cari</button>
					</div>
				</div><!-- /.input group -->
				<?php echo form_close();?>
			  </div>
			</div>
			<div class="box-body">
			<?php
				if($this->session->flashdata('message'))
				{
					echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';
				}
				elseif($this->session->flashdata('success'))
				{
					echo '<div class="alert alert-success">'.$this->session->flashdata('success').'</div>';
				}
				?>
			  <table id="purchase" class="table table-striped table-bordered table-hover">
				<thead>
				  <tr>
					<th class="text-center">No.</th>
                    <th class="text-center">Tanggal PO</th>
					<th class="text-center">Tanggal Dibutuhkan</th>
					<th class="text-center">Oleh</th>
					<th class="text-center">PO Number</th>
                    <th class="text-center">Supplier</th>
					<th class="text-center">Keterangan</th>
					<th class="text-center">Status</th>
					<th class="text-center"></th>
				  </tr>
				</thead>
				<tbody>
				<?php
					$no=1;
					foreach($porecord AS $po)
					{
					?>
				  <tr>
					<td><?php echo $no++;?></td>
					<td><?php echo date('d-m-Y H:i:s',strtotime($po->created_time));?></td>
                    <td><?php echo date('d-m-Y',strtotime($po->po_date_required));?></td>
					<td><?php echo $po->full_name;?></td>
					<td><a href="<?=base_url()?>purchase/po_detail/<?=$po->po_id?>/<?=$po->po_number?>"><?php echo $po->po_number;?></a></td>
                    <td><?php echo $po->supplier_full_name;?></td>
					<td><?php echo $po->po_note;?> (<?php echo $po->pr_number;?>)</td>
					<td><?php echo $po->po_status;?></td>
					<td>
					<?
					if($this->session->userdata('group_id')==4 || $this->session->userdata('group_id')==1 and $po->po_status=="order"){
					?>
						<a href="<?=base_url()?>purchase/po_proses/<?=$po->po_id?>/<?=$po->po_number?>" class="btn btn-success">Proses</a>&nbsp;
					<?
        }elseif($this->session->userdata('group_id')==3 || $this->session->userdata('group_id')==1 and $po->po_status=="approved finance"){
					?>
						<a href="<?=base_url()?>purchase/po_proses/<?=$po->po_id?>/<?=$po->po_number?>" class="btn btn-success">Proses</a>&nbsp;
					<?
					//}elseif($this->session->userdata('group_id')==4 and $po->po_status=="approved manager"){
          }elseif($this->session->userdata('group_id')==4 || $this->session->userdata('group_id')==1 and $po->po_status=="approved finance" || $po->po_status=="approved manager"){
					?>
							<a href="<?=base_url()?>purchase/po_proses_faktur/<?=$po->po_id?>/<?=$po->po_number?>" class="btn btn-success">Input Faktur</a>
              <br><br>
              <a href="<?php echo base_url().'purchase/po_status/finance/0/' . $po->po_id;?>" class="btn btn-danger">Reject</a>
					<?
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
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->
<script>
  $(function () {
	 $('#purchase').DataTable({
		 "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		 "pagingType": "full_numbers",
         "order": [[1, "desc"]]
	 });
	  //Date range picker
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