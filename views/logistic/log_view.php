<?php
$group_id	= $this->session->userdata('group_id');
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Main content -->
	<section class="content">
	
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-warning">
			<div class="box-body">
				<div class="box-body">
					<?php
					foreach($prrecord AS $pr)
					{
					?>
					<div class="col-xs-3">
					  <label>Tanggal Dibuat</label>
						<input type="text" class="form-control" value="<?php echo date('d-m-Y H:i:s',strtotime($pr->created_time));?>" disabled>
					</div>
					<div class="col-xs-2">
					  <label>Tanggal Dibutuhkan</label>
						<input type="text" class="form-control" value="<?php echo date('d-m-Y',strtotime($pr->pr_date_required));?>" disabled>
					</div>
					<div class="col-xs-3">
					  <label>Status</label>
						<?php
						if($pr->pr_status == 'request')
						{
							$requesters	= $this->account_model->get_user_by_user_id($pr->created_by);
							foreach($requesters AS $requester)
							{
								$pr_status	= $pr->pr_status . ' (' . $requester->full_name . ')';
							}
						}
						if($pr->pr_status == 'approved')
						{
							$requesters	= $this->account_model->get_user_by_user_id($pr->pr_approved_by);
							foreach($requesters AS $requester)
							{
								$pr_status	= $pr->pr_status . ' (' . $requester->full_name . ')';
							}
						}
						if($pr->pr_status == 'rejected')
						{
							$requesters	= $this->account_model->get_user_by_user_id($pr->pr_rejected_by);
							foreach($requesters AS $requester)
							{
								$pr_status	= $pr->pr_status . ' (' . $requester->full_name . ')';
							}
						}
						if($pr->pr_status == 'approved_warehouse')
						{
							$requesters	= $this->account_model->get_user_by_user_id($pr->warehouse_approved_by);
							foreach($requesters AS $requester)
							{
								$pr_status	= $pr->pr_status . ' (' . $requester->full_name . ')';
							}
						}
						if($pr->pr_status == 'rejected_warehouse')
						{
							$requesters	= $this->account_model->get_user_by_user_id($pr->warehouse_approved_by);
							foreach($requesters AS $requester)
							{
								$pr_status	= $pr->pr_status . ' (' . $requester->full_name . ')';
							}
						}
						
						if($pr->pr_status == 'approved_manager')
						{
							$requesters	= $this->account_model->get_user_by_user_id($pr->manager_approved_by);
							foreach($requesters AS $requester)
							{
								$pr_status	= $pr->pr_status . ' (' . $requester->full_name . ')';
							}
						}
						if($pr->pr_status == 'rejected_manager')
						{
							$requesters	= $this->account_model->get_user_by_user_id($pr->manager_approved_by);
							foreach($requesters AS $requester)
							{
								$pr_status	= $pr->pr_status . ' (' . $requester->full_name . ')';
							}
						}
						?>
						<input type="text" class="form-control" value="<?php echo $pr_status;?>" disabled>
					</div>
					<!--div class="col-xs-3">
					  <label>Supplier</label>
					  <?php
					 $suppliers	= $this->purchase_model->get_supplier_by_supplier_id($this->session->userdata('pr_supplier_id'));
					 foreach($suppliers AS $supplier)
					 {
						 $supplier_full_name	= $supplier->supplier_full_name;
						 $supplier_hp			= $supplier->supplier_hp;
					 }
					  ?>
						<input type="text" class="form-control" value="<?php echo $supplier_full_name . ' (' . $supplier_hp . ')';?>" disabled>
					</div-->
					<div class="col-xs-4">
					  <label>Keterangan</label>
						<input type="text" class="form-control" value="<?php echo $pr->pr_note;//heru?>" disabled> 
					</div>
					<?php }?>
				</div>
				<div class="box-body">
				  <table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="text-center">Nama Material</th>
							<th class="text-center">Tipe</th>
							<th class="text-center">QTY</th>
							<th class="text-center">Satuan</th>
							<?php
							//if($pr->pr_status == 'request')
							//{
							?>
							<th class="text-center">Stok Saat Ini</th>
							<?php //}?>
						</tr>
					</thead>
					<tbody>
					<?php
					$total=0;
					$prdetails	= $this->logistic_model->get_pr_detail_by_pr_id($pr->pr_id);
					foreach($prdetails AS $prdetail)
					{
					?>
					  <tr>
						<td><?php echo $prdetail->material_name;?></td>
						<td><?php echo $prdetail->material_type;?></td>
						<td align="center"><?php echo number_format($prdetail->pr_qty,0,',','.');?></td>
						<td align="center"><?php echo $prdetail->material_unit_name;?></td>
						<?php
						//if($pr->pr_status == 'request')
						//{
						?>
						<td align="center"><?php echo number_format($prdetail->material_stock,0,',','.');?></td>
						<?php //}?>
					  </tr>
					<?php } ?>
					</tbody>
				  </table>
				</div>
			  </div><!-- /.box-body -->
			  <div class="box-footer">
				<a href="<?php echo base_url().'purchase/pr_list';?>" class="btn btn-primary">Kembali</a>&nbsp;
				<?php
				if($group_id == '9' AND $pr->pr_status == 'request')
				{
				?>
				<a href="<?php echo base_url().'logistic/pr_approve_reject/' . $pr->pr_number."/approved_warehouse";?>" class="btn btn-success">Approve</a>&nbsp;
				<a href="<?php echo base_url().'logistic/pr_approve_reject/' . $pr->pr_number."/rejected_warehouse";?>" class="btn btn-danger">Reject</a>
				<?php }?>
                
                <?php
				if($group_id == '3' AND $pr->pr_status == 'approved_warehouse')
				{
				?>
				<a href="<?php echo base_url().'logistic/manager_approve_reject/' . $pr->pr_number."/approved_manager";?>" class="btn btn-success">Approve</a>&nbsp;
				<a href="<?php echo base_url().'logistic/manager_approve_reject/' . $pr->pr_number."/rejected_manager";?>" class="btn btn-danger">Reject</a>
				<?php }?>
                
                <?php
				if($group_id == '9' AND $pr->pr_status == 'approved_manager')
				{
				?>
				<a href="<?php echo base_url().'logistic/logisticout_approve/' . $pr->pr_number."/logistic_out";?>" class="btn btn-success">Approve</a>&nbsp;
				
				<?php }?>
                
			  </div><!-- /.box-footer -->
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->