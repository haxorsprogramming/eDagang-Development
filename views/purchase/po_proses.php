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
					<?php
					$i=1;
					foreach($porecord AS $pr)
					{

						if($i==1){

					?>
                    <div class="row">
					<div class="col-xs-4">
					  <label>Tanggal Dibuat</label>
						<input type="text" class="form-control" value="<?php echo date('d-m-Y H:i:s',strtotime($pr->created_time));?>" readonly>
					</div>
					<div class="col-xs-4">
					  <label>Tanggal Dibutuhkan</label>
						<input type="text" class="form-control" value="<?php echo date('d-m-Y',strtotime($pr->po_date_required));?>" readonly>
					</div>
					<div class="col-xs-4">
					  <label>Status</label>

						<input type="text" class="form-control" value="<?php echo $pr->po_status;?>" disabled>
					</div>
                    </div>
                    <div class="row">
					<div class="col-xs-6">
					  <label>Supplier</label>
					  <?php
					 $suppliers	= $this->purchase_model->get_supplier_by_supplier_id($pr->po_supplier_id);
					 foreach($suppliers AS $supplier)
					 {
						 $supplier_full_name	= $supplier->supplier_full_name;
						 $supplier_hp			= $supplier->supplier_hp;
					 }
					  ?>
						<input type="text" class="form-control" value="<?php echo $supplier_full_name . ' (' . $supplier_hp . ')';?>" readonly>
					</div>
					<div class="col-xs-6">
					  <label>Keterangan</label>
						<input type="text" class="form-control" value="<?php echo $pr->po_note;?>" disabled>
					</div>
					<?php
						}
					$i++;
					}

					?>
				</div>
                </div>
				<div class="box-body">
				  <table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="text-center">Nama Material</th>
							<th class="text-center">Tipe</th>
							<th class="text-center">QTY</th>
							<th class="text-center">Satuan</th>
							<th class="text-center">Harga</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$total=0;
					//$prdetails	= $this->purchase_model->get_pr_detail_by_pr_id($pr->pr_id);
					foreach($porecord AS $prdetail)
					{
					?>
					  <tr>
						<td><?php echo $prdetail->material_name;?></td>
						<td><?php echo $prdetail->material_type;?></td>
						<td style="text-align:right"><?php echo number_format($prdetail->po_qty,0,',','.');?></td>
						<td><?php echo $prdetail->material_unit_name;?></td>
						<td style="text-align:right"><?php echo number_format($prdetail->po_price,0,',','.');?></td>
						<td>
              <?php if ($prdetail->purchase_order_status==''){ ?>
                <button type="button" class="btn btn-success btn-xs" onclick="update('<?php echo $prdetail->po_detail_id;?>','accepted')"><i class="fa fa-check"></i></button>
                <button type="button" class="btn btn-danger btn-xs" onclick="update('<?php echo $prdetail->po_detail_id;?>','rejected')"><i class="fa fa-times"></i></button>
              <?php }else{ ?>
                  <?php if ($prdetail->purchase_order_status=='accepted'){ ?>
                    <i class="fa fa-check text-success"></i>
                  <?php }else{ ?>
                    <i class="fa fa-times text-danger"></i>
                  <?php } ?>
              <?php } ?>
            </td>
					  </tr>
					<?php
						$total+=$prdetail->po_price;
            if($prdetail->purchase_order_status=='rejected'){
              $total-=$prdetail->po_price;
            }
					} ?>
            <tr><th colspan="4" style="text-align:center">TOTAL</th>
						        <th style="text-align:right"><?php echo number_format($total,0,',','.');?></th>
					  </tr>
					</tbody>
				  </table>
				</div>
			  </div><!-- /.box-body -->
			  <div class="box-footer">
				<a href="<?php echo base_url().'purchase/po_list';?>" class="btn btn-primary">Kembali</a>&nbsp;
				<?php
				if($group_id == '1' OR $group_id == '2' OR $group_id == '3')
				{
				?>
					<a href="<?php echo base_url().'purchase/po_status/manager/1/' . $pr->po_id;?>" class="btn btn-success">Approve</a>&nbsp;
					<a href="<?php echo base_url().'purchase/po_status/manager/0/' . $pr->po_id;?>" class="btn btn-danger">Reject</a>
				<?php

				}elseif($group_id == '4'){
					?>
						<a href="<?php echo base_url().'purchase/po_status/finance/1/' . $pr->po_id;?>" class="btn btn-success">Approve</a>&nbsp;
						<a href="<?php echo base_url().'purchase/po_status/finance/0/' . $pr->po_id;?>" class="btn btn-danger">Reject</a>
					<?
				}
				?>
			  </div><!-- /.box-footer -->
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->
	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->
<script type="text/javascript">
  function update(id,status){
    $.ajax({
      url:"<?php echo base_url()."purchase/po_update_detail/"?>"+id,
      type:"POST",
      data:"status="+status,
      success:function(){
          location.reload();
      },error:function(){
        alert('Something error!!');
      }
    })
  }
</script>
