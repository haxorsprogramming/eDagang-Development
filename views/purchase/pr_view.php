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
                    if ($this->session->flashdata('message_success')) echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
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
					  <label>Status dan Lokasi</label>
						<?php
                         if($pr->pr_status == 'approved_mp')
					{
						$requesters	= $this->account_model->get_user_by_user_id($pr->pr_approved_by);
						foreach($requesters AS $requester)
						{
							$pr_status=  $pr->pr_status . ' (' . $requester->full_name . ')';
              $nama_lokasi = $requester->full_name;
						}
					}
                       if($pr->pr_status == 'rejected_mp')
					{
						$requesters	= $this->account_model->get_user_by_user_id($pr->pr_approved_by);
						foreach($requesters AS $requester)
						{
							$pr_status=  $pr->pr_status . ' (' . $requester->full_name . ')';
              $nama_lokasi = $requester->full_name;
						}
					}
						if($pr->pr_status == 'request')
						{
							$requesters	= $this->account_model->get_user_by_user_id($pr->created_by);
							foreach($requesters AS $requester)
							{
								$pr_status	= $pr->pr_status . ' (' . $requester->full_name . ')';
                $nama_lokasi = $requester->full_name;
							}
						}
						if($pr->pr_status == 'approved')
						{
							$requesters	= $this->account_model->get_user_by_user_id($pr->pr_approved_by);
							foreach($requesters AS $requester)
							{
								$pr_status	= $pr->pr_status . ' (' . $requester->full_name . ')';
                $nama_lokasi = $requester->full_name;
							}
						}
						if($pr->pr_status == 'rejected')
						{
							$requesters	= $this->account_model->get_user_by_user_id($pr->pr_rejected_by);
							foreach($requesters AS $requester)
							{
								$pr_status	= $pr->pr_status . ' (' . $requester->full_name . ')';
                $nama_lokasi = $requester->full_name;
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
							<th class="text-center">Jenis Material</th>
							<th class="text-center">QTY</th>
							<th class="text-center">Satuan</th>
							<?php
							if($pr->pr_status == 'request')
							{
							?>
							<th class="text-center">Stok Saat Ini</th>

                            <th></th>
                            <?php }?>
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
						<td><?php echo $prdetail->material_name;?></td>
						<td><?php echo $con->tmaterial($prdetail->material_type);?></td>
						<td align="center">

                        <?php ///echo number_format($prdetail->pr_qty,0,',','.');?>
                        <div class="row">
                        <div class="col-xs-3">
                        <label id="lblqty<?=$prdetail->pr_detail_id?>"><?php echo $prdetail->pr_qty;?></label>
                         <?php
						if($group_id == '18' and $pr->pr_status == 'request')
						{
						?>
                    	<input type="number" class="form-control" id="txtqty<?=$prdetail->pr_detail_id?>" value="<?php echo $prdetail->pr_qty;?>" >
                        <?php }?>

                        </div>
                        <div class="col-xs-4">
                        <?php
						if($group_id == '18' and $pr->pr_status == 'request')
						{
						?>
                        <a href="#" class="btn btn-primary" id="bedit<?=$prdetail->pr_detail_id?>" >Edit</a>
                        <a href="#" class="btn btn-success" id="bsave<?=$prdetail->pr_detail_id?>" >Save</a>
                        <script>

						$('#bsave<?=$prdetail->pr_detail_id?>').hide();
						$('#txtqty<?=$prdetail->pr_detail_id?>').hide();
                        $('#bedit<?=$prdetail->pr_detail_id?>').click(function(){
							$('#bsave<?=$prdetail->pr_detail_id?>').show();
							$('#bedit<?=$prdetail->pr_detail_id?>').hide();
							$('#txtqty<?=$prdetail->pr_detail_id?>').show();
							$('#lblqty<?=$prdetail->pr_detail_id?>').hide();
							return false;
						});

                        $('#bsave<?=$prdetail->pr_detail_id?>').click(function(){
							var v_id='<?=$prdetail->pr_detail_id?>';
							var v_qty=$('#txtqty<?=$prdetail->pr_detail_id?>').val();


							$.ajax({
								type: "POST",
								url: "<?php echo base_url()?>purchase/prdetail_update/<?=$pr->pr_number?>",
								data: "v_id="+v_id+"&v_qty="+v_qty,

								success: function(msg){
									//alert(msg);
									//if(msg=='SUKSES'){
										//alert('DATA BERHASIL DISIMPAN');
										window.location='<?=base_url()?>purchase/pr_view/<?=$pr->pr_number?>';
									//}else{
									//	alert(msg);
									//}
								}
							});
							return false;
						});
                        </script>
                        <?php }?>
                         </div>
                        </div>
                        </td>
						<td align="center"><?php echo $prdetail->material_unit_name;?></td>
						<?php
						if(($group_id == '1' OR $group_id == '2' OR $group_id == '18') and $pr->pr_status == 'request')
						{
							$mt='stock';
							$thnbln	= new DateTime($pr->created_time);
							$bln=date_format($thnbln,"Y-m");
							$cek_materials	= $this->material_model->cek_persediaan_bulan_ini($mt,$prdetail->material_id,$bln,$nama_lokasi);
							foreach($cek_materials AS $cek_material)
							{
								$material_stock_saat_ini	= $cek_material->jumin - $cek_material->jumout;
							}
						?>
						<td align="center"><?php echo number_format($material_stock_saat_ini,0,',','.');?></td>

                          <td><a href="<?php echo base_url();?>purchase/prdetail_delete/<?=$prdetail->pr_detail_id?>/<?=$pr->pr_number?>" class="glyphicon glyphicon-remove"></a></td>
                          <?php }?>
					  </tr>
					<?php } ?>

					</tbody>
				  </table>
				</div>
			  </div><!-- /.box-body -->
			  <div class="box-footer">
				<a href="<?php echo base_url().'purchase/pr_list';?>" class="btn btn-primary">Kembali</a>&nbsp;
				<?php
				if($group_id == '8' AND $pr->pr_status == 'approved_mp')
				{
				?>
				<a href="<?php echo base_url().'purchase/pr_approve/' . $pr->pr_number;?>" class="btn btn-success">Approve</a>&nbsp;
				<a href="<?php echo base_url().'purchase/pr_reject/' . $pr->pr_number;?>" class="btn btn-danger">Reject</a>
				<?php
                }elseif($group_id == '18' AND $pr->pr_status == 'request'){
                    ?>
                    <a href="<?php echo base_url().'purchase/pr_approverejectmp/' . $pr->pr_number."/approved_mp";?>" class="btn btn-success">Approve</a>&nbsp;
				<a href="<?php echo base_url().'purchase/pr_approverejectmp/' . $pr->pr_number."/rejected_mp";?>" class="btn btn-danger">Reject</a>
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
