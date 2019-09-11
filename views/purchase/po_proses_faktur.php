<?php
$group_id	= $this->session->userdata('group_id');

?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Main content -->
	<section class="content">

	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-success">
				<div class="box-body">
					<?php
					$i=1;
					foreach($porecord AS $pr)
					{

						if($i==1){
							$po_number=$pr->po_number;
							$po_id=$pr->po_id;
					?>
                    <div class="row">
					<div class="col-xs-4">
					  <label>Tanggal Dibuat</label>
						<input type="text" class="form-control" value="<?php echo date('d-m-Y H:i:s',strtotime($pr->created_time));?>" readonly>
					</div>
					<div class="col-xs-4">
					  <label>Tanggal Butuh</label>
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
							<th class="text-center">Jenis Material</th>
							<th class="text-center">QTY</th>
							<th class="text-center">Satuan Beli</th>
							<th class="text-center">Harga</th>
							<th class="text-center">Status</th>

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
						<td><?php echo $con->tmaterial($prdetail->material_type);?></td>
						<td style="text-align:right"><?php echo number_format($prdetail->po_qty,0,',','.');?></td>
						<td ><?php echo $prdetail->material_unit_name;?></td>
						<td style="text-align:right"><?php echo number_format($prdetail->po_price,0,',','.');?></td>
						<td align="text-center">
              <?php if($prdetail->purchase_order_status=='accepted'){
                echo "<b class='text-success'>Disetujui</b>";
              }else {
                echo "<b class='text-danger'>Ditolak</b>";
              }?>
            </td>
					  </tr>
					<?php
					$total=$total+$prdetail->po_price;
						if($prdetail->purchase_order_status=='rejected'){
							$total-=$prdetail->po_price;
						}
					} ?>
                    <tr><th colspan="4" style="text-align:center">TOTAL</th>
						<th style="text-align:right"><?php echo number_format($total,0,',','.');?></th>
                        <th></th>
					  </tr>
					</tbody>
				  </table>
				</div>
			  </div><!-- /.box-body -->
			  <div class="box-footer">
              <form action="<?=base_url()?>purchase/po_simpan_faktur" method="post" enctype="multipart/form-data">
                <div class="box box-solid box-success">
                    <div class="box-body">
                        <div class="col-xs-12">
					 		 <h3>Input Faktur</h3>
							 <div class="alert alert-danger">Harga Yang dimasukkan Mempengaruhi update harga pada material</div>
							 <hr>
						</div>

                    	<div class="row">
                        <div class="col-xs-4">
                          <label>No. Faktur</label>
                            <input type="text" class="form-control" name="no_faktur" required >
                            <input type="hidden" class="form-control" name="po_number" value="<?=$po_number?>"  >
                            <input type="hidden" class="form-control" name="po_id" value="<?=$po_id?>"   >
                        </div>
                        <div class="col-xs-4">
					 	 <label>Tanggal Faktur</label>
						 <input type="text" class="form-control" id="tgl_faktur" name="tgl_faktur" value="<?php echo date('d-m-Y');?>">
						</div>
                         <div class="col-xs-4">
					 	 <label>File Faktur (Jika ada)</label>
						 <input type="file" class="form-control" name="file_faktur" id="file_faktur" >
						</div>
					</div>
                </div>
				<div class="box-body">
				  <table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="text-center">Nama Material</th>
							<th class="text-center">Jenis Material</th>
							<th class="text-center">Satuan Gramasi</th>
                            <th class="text-center">QTY Faktur</th>
							<th class="text-center">Harga Faktur</th>

						</tr>
					</thead>
					<tbody>
					<?php
					$total=0;
					$jumlah=0;
					//$prdetails	= $this->purchase_model->get_pr_detail_by_pr_id($pr->pr_id);
					foreach($porecord AS $prdetail)
					{
						if($prdetail->purchase_order_status!='rejected'){
						$jumlah++;
					?>
					  <tr>
						<td><?php echo $prdetail->material_name;?> <input type="hidden" class="form-control" style="text-align:right" name="ids[]" value="<?php echo $prdetail->material_id;?>" ></td>
						<td><?php echo $con->tmaterial($prdetail->material_type);?></td>
                        <td align="center"><?php echo $prdetail->material_unit_name;?></td>
						<td align="center"><input type="number" class="form-control" style="text-align:right" id="pqty" name="pqty[]" value="<?php echo $prdetail->po_qty?>"></td>
						<td align="center"><input type="number" class="form-control qty1" onKeyUp="summ()"  style="text-align:right" name="pharga[]" value="<?php echo $prdetail->po_price;?>" min=100></td>
					  </tr>
						<?php } ?>
					<?php } ?>
                    <tr><th colspan="4" style="text-align:center">TOTAL</th>
						<th style="text-align:right"><div id="result"><?php echo number_format($total,0,',','.');?></div></th>
						<script>
								function summ(){
					//$(".qty1").on("blur", function(){
							var sum=0;
							$(".qty1").each(function(){
								if($(this).val() != "")
								  sum += parseInt($(this).val());
							});

							$("#result").html(sum.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
						//});/

						}
						</script>
					  </tr>
					</tbody>
				  </table>
                  <br>
                  <div class="row">
                        <div class="col-xs-12">
                            <input type="text" value="<?php echo $jumlah?>" name="jumlah" hidden>
                            <!--<a href="<?php echo base_url().'purchase/po_status/finance/1/' . $pr->po_id;?>" class="btn btn-success">Simpan</a>&nbsp;-->
                            <a href="<?php echo base_url().'purchase/po_list';?>" class="btn btn-danger">Kembali</a> &nbsp; <input type="submit" class="btn btn-success pull-right" value="Simpan" />
                        </div>
                </div>
				</div>
                </div>
                 </form>
			  </div><!-- /.box-body -->
			  </div><!-- /.box-footer -->
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->

<script type="text/javascript">
    $(function () {

                $('#tgl_faktur').datepicker({
                        format: 'dd-mm-yyyy',
                        todayBtn: true,
                        todayHighlight: true,
                        autoclose: true
                    });
            });
</script>