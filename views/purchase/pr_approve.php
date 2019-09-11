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
						if ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
						elseif ($this->session->flashdata('message_sucess')) echo '<div class="alert alert-success">'.$this->session->flashdata('message_sucess').'</div>';?>
					<?php
					echo '<span class=text-red>'.validation_errors().'</span>';
					//echo form_open('purchase/po_cart',['class'=>'form-horizontal']);
					//echo form_open('purchase/pr_proses_po',['class'=>'form-horizontal']);
					?>
                    <form action="<?php echo base_url();?>purchase/pr_proses_ponew" method="post"  accept-charset="utf-8" >
                    <div class="col-xs-4">
					  <label>PR Number</label>
						<input type="text" class="form-control" value="<?php echo $pr_number;?>" name="po_number" readonly>
                        <input type="hidden" class="form-control" value="<?php echo $pr_number;?>" name="pr_number" >
					</div>
                    <?
					foreach($prrecord AS $pr)
					{
					?>
					<div class="col-xs-4">
					  <label>Tanggal Dibuat</label>
						<input type="text" class="form-control" value="<?php echo date('d-m-Y H:i:s',strtotime($pr->created_time));?>" disabled>
					</div>
					<div class="col-xs-4">
					  <label>Tanggal Dibutuhkan</label>
						<input type="text" class="form-control" name="po_date_required" value="<?php echo date('d-m-Y',strtotime($pr->pr_date_required));?>" readonly>
					</div>
					<div class="col-xs-4">
					  <label>Status</label>
						<?php
                        if($pr->pr_status == 'approved_mp')
					{
						$requesters	= $this->account_model->get_user_by_user_id($pr->pr_approved_by);
						foreach($requesters AS $requester)
						{
							$pr_status=  $pr->pr_status . ' (' . $requester->full_name . ')';
						}
					}
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
						?>
						<input type="text" class="form-control" value="<?php echo $pr_status;?>" disabled>
					</div>
					<div class="col-xs-4">
					  <label>Keterangan</label>
						<input type="text" class="form-control" name="pr_note" value="<?php echo $pr->pr_note;//heru?>" readonly>
					</div>
                    
					<!--<div class="col-xs-4">
						<label>Supplier</label>
						<select name="supplier_id" class="form-control select2">
							<option value="">-- Pilih --</option>
						<?php
						$suppliers	= $this->purchase_model->get_suppliers();
						foreach($suppliers as $supplier)
						{
						?>
							<option value="<?php echo $supplier->supplier_id;?>"><?php echo $supplier->supplier_full_name;?></option>
						<?php }?>
						</select>
					</div>>-->
					<?php }?>
				</div>
                <div class="box-body">
                <br>
				  <table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="text-center">Nama Material</th>
							<th class="text-center">Jenis Material</th>
							<th class="text-center">QTY</th>
							<th class="text-center">Satuan</th>
						
							<th class="text-center">Stok Saat Ini</th>
						
                            <th class="text-center">Harga Terakhir</th>
							<th class="text-center">PO QTY</th>
							<th class="text-center">PO Plan Harga</th>
                            <th>Supplier</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$total=0;
					$prdetails	= $this->purchase_model->get_pr_detail_by_pr_id($pr->pr_id);
					foreach($prdetails AS $prdetail)
					{
					?>
					  <tr>
						<td><?php echo $prdetail->material_name;?><input type="hidden" value="<?php echo $prdetail->material_id;?>" name="material_id[]"></td>
						<td><?php echo $con->tmaterial($prdetail->material_type);?></td>
						<td align="center"><?php echo number_format($prdetail->pr_qty,0,',','.');?></td>
						<td align="center"><?php echo $prdetail->material_unit_name;?></td>
						
						<td align="right"><?php echo number_format($prdetail->material_stock,0,',','.');?></td>
                        <td align="right"><?php echo number_format($prdetail->hargat,0,',','.');?></td>
						
						<td align="center"><input type="number" class="form-control" name="pqty[]" value="<?php echo $prdetail->pr_qty;?>" style="text-align:right"></td>
						<td align="center"><input type="number" class="form-control" name="pharga[]" value="0" style="text-align:right"></td>
                        <td><select id="supplier_id<?php echo $prdetail->pr_detail_id;?>" name="supplier_id<?php echo $prdetail->pr_detail_id;?>" class="form-control select2">
							<option value="">-- Pilih --</option>
						<?php
						$suppliers	= $this->purchase_model->get_suppliers();
						foreach($suppliers as $supplier)
						{
						?>
							<option value="<?php echo $supplier->supplier_id;?>" <? if($supplier->supplier_id==$prdetail->pr_supplier){ echo "selected";} ?>><?php echo $supplier->supplier_full_name;?></option>
						<?php }?>
						</select>
                        
                        <script>
						//$pr_detail_id=$_POST['pr_detail_id'];	
						//$id_supplier=$_POST['id_supplier'];	
						$('#supplier_id<?php echo $prdetail->pr_detail_id;?>').change(function(){
						var pr_detail_id='<?=$prdetail->pr_detail_id?>'
						var id_supplier=$('#supplier_id<?php echo $prdetail->pr_detail_id;?>').val();
					$.ajax({
						type: "POST",
						url: "<?php echo base_url()?>purchase/cupdate_supplier_pr",
						data: "pr_detail_id="+pr_detail_id+"&id_supplier="+id_supplier,
																	
						success: function(msg){
							
						}
						
						});
					
					return false;
				});
				</script>
                        
                        </td>
					  </tr>
					<?php } ?>
					</tbody>
				  </table>
				</div>
                
			  </div><!-- /.box-body -->
			  <div class="box-footer">
				<a href="<?php echo base_url().'purchase/pr_view/' . $pr->pr_number;?>" class="btn btn-primary">Kembali</a>
				<button class="btn btn-success pull-right">Approve PR</button>
                </form>
			  </div><!-- /.box-footer -->
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->