<?php
$group_id	= $this->session->userdata('group_id');
?>
<script>
  $(function () {
	 $('#purchase').DataTable({
		 "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		 "pagingType": "full_numbers",
		 "order": [[ 0, "desc" ]],
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
	$('div.dataTables_filter input').focus();
  });
</script>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<?php
		if($group_id == '10' or $group_id == '11')
		{
		?>
		<a href="<?=base_url()?>logistic/log_create" class="btn btn-success">Permintaan</a>
		<?php }?>
	</section>
	
	<!-- Main content -->
	<section class="content">
		
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-warning">
			<div class="box-body">
            	<?php
				if ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
				elseif ($this->session->flashdata('message_sucess')) echo '<div class="alert alert-success">'.$this->session->flashdata('message_sucess').'</div>';?>
			
			  <div class="col-xs-12">
				<?php echo form_open('logistic/pr_list_search');?>
				<div class="col-xs-3">
					<div class="input-group">
					 <span class="input-group-addon">Dari :</span>
					  <input type="text" class="form-control" id="start_date" name="start_date" value="<?php echo date('d-m-Y');?>">
					</div><!-- /.input group -->
				</div>
				<div class="col-xs-3">
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
				<?php echo form_close();?>
			  </div>
			</div>
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
			  <table id="purchase" class="table table-bordered table-hover">
				<thead>
				  <tr>
					<th class="text-center">SR Number</th>
					<th class="text-center">Tanggal Dibuat</th>
					<th class="text-center">Tanggal Dibutuhkan</th>
					<th class="text-center">Keterangan</th>
					<th class="text-center">Status</th>
                    <th class="text-center"></th>
				  </tr>
				</thead>
				<tbody>
				<?php
				 //print_r($prrecord);
					foreach($prrecord AS $pr)
					{
					?>
				  <tr>
					<td><?php echo anchor('logistic/log_view/' . $pr->pr_number,$pr->pr_number);?></td>
					<td><?php echo date('d-m-Y H:i:s',strtotime($pr->created_time));?></td>
					<td><?php echo date('d-m-Y',strtotime($pr->pr_date_required));?></td>
					<td><?php echo $pr->pr_note;?></td>
					<td><?php
					if($pr->pr_status == 'request')
					{
						$requesters	= $this->account_model->get_user_by_user_id($pr->created_by);
						foreach($requesters AS $requester)
						{
							echo $pr->pr_status . ' (' . $requester->full_name . ')';
						}
					}
					if($pr->pr_status == 'approved')
					{
						$requesters	= $this->account_model->get_user_by_user_id($pr->pr_approved_by);
						foreach($requesters AS $requester)
						{
							echo $pr->pr_status . ' (' . $requester->full_name .') ' . date('d-m-Y H:i:s',strtotime($pr->pr_approved_time));
						}
					}
					if($pr->pr_status == 'rejected')
					{
						$requesters	= $this->account_model->get_user_by_user_id($pr->pr_rejected_by);
						foreach($requesters AS $requester)
						{
							echo $pr->pr_status . ' (' . $requester->full_name . ')';
						}
					}
					if($pr->pr_status == 'approved_warehouse')
					{
						$requesters	= $this->account_model->get_user_by_user_id($pr->warehouse_approved_by);
						foreach($requesters AS $requester)
						{
							echo $pr->pr_status . ' (' . $requester->full_name . ')';
						}
					}
					if($pr->pr_status == 'rejected_warehouse')
					{
						$requesters	= $this->account_model->get_user_by_user_id($pr->warehouse_approved_by);
						foreach($requesters AS $requester)
						{
							echo $pr->pr_status . ' (' . $requester->full_name . ')';
						}
					}
					
					if($pr->pr_status == 'approved_manager')
					{
						$requesters	= $this->account_model->get_user_by_user_id($pr->manager_approved_by);
						foreach($requesters AS $requester)
						{
							echo $pr->pr_status . ' (' . $requester->full_name . ')';
						}
					}
					if($pr->pr_status == 'manager_warehouse')
					{
						$requesters	= $this->account_model->get_user_by_user_id($pr->manager_approved_by);
						foreach($requesters AS $requester)
						{
							echo $pr->pr_status . ' (' . $requester->full_name . ')';
						}
					}
					if($pr->pr_status == 'logistic_out')
					{
						$requesters	= $this->account_model->get_user_by_user_id($pr->logistic_out_by);
						foreach($requesters AS $requester)
						{
							echo $pr->pr_status . ' (' . $requester->full_name . ')';
						}
					}
					
					?></td>
                    <td>
                    	<?
						if($pr->pr_status == 'request'){
							?>
                            <a href="<?=base_url()?>logistic/log_view/<?=$pr->pr_number?>" class="btn btn-success">Proses</a>
                            <?
						}
                       
						if($pr->pr_status == 'approved_warehouse'){
							?>
                            <a href="<?=base_url()?>logistic/log_view/<?=$pr->pr_number?>" class="btn btn-success">Proses</a>
                            <?
						}
						if($pr->pr_status == 'approved_manager'){
							?>
                            <a href="<?=base_url()?>logistic/log_view/<?=$pr->pr_number?>" class="btn btn-success">Barang Keluar</a>
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