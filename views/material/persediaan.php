<script>
      $(function () {
         $('#customer').DataTable({
			 "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
			 "pagingType": "full_numbers",
			 "dom":"Bfrtip",
			 "buttons":['excel','pdf','print']
		 });
		 $('div.dataTables_filter input').focus();

         $('#tgl2').datepicker({
						format: 'dd-mm-yyyy',
						todayBtn: true,
						todayHighlight: true,
						autoclose: true
					});
	$('#tgl1').datepicker({
						format: 'dd-mm-yyyy',
						todayBtn: true,
						todayHighlight: true,
						autoclose: true
					});
      });
    </script>

	<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
		<section class="content-header">

		</section>
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">

			<div class="col-xs-12">
              <div class="box box-solid box-success">
                <div class="box-body">
                 <div class="row">

                    <div class="col-xs-3">
                    <form action="<?=base_url()?>material/persediaan_search" method="post">
                    <div class="input-group">
                    <span class="input-group-addon">Jenis Material</span>
                        <select class="form-control" name="mt">
                            <option value="stock" <? if ($mt=='stock'){ echo "selected";}?>>Produksi</option>
                            <option value="non_stock" <? if ($mt=='non_stock'){ echo "selected";}?>>Non Produksi</option>
                            <option value="asset" <? if ($mt=='asset'){ echo "selected";}?>>Asset</option>
                            <option value="asset" <? if ($mt=='stock_beauty'){ echo "selected";}?>>Stock Beauty</option>
                            <option value="asset" <? if ($mt=='stock_studio'){ echo "selected";}?>>Stock Studio</option>
                        </select>
                        </div>

                    </div>
                  <div class="col-xs-3">
					<div class="input-group">
					 <span class="input-group-addon">Dari :</span>
					  <input type="text" class="form-control" id="tgl1" name="tgl1" value="<?php echo $tgl1;?>">
					</div><!-- /.input group -->
				</div>
				<div class="col-xs-3">
					<div class="input-group">
					   <span class="input-group-addon">Sampai :</span>
					   <input type="text" class="form-control" id="tgl2" name="tgl2" value="<?php echo $tgl2;?>">
					</div>
				</div><!-- /.input group -->
				<div class="col-xs-1">
					<div class="input-group">
					   <button class="btn btn-block btn-primary">Cari</button>
					</div>
				</div><!-- /.input group -->
                 </div>
                 <br>
                  <table id="customer" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                      <th class="text-center">Kode Material</th>
						<th class="text-center">Nama Material</th>
						<th class="text-center">Lokasi Material</th>
                        <th class="text-center">Satuan Gramasi</th>
						<th class="text-center">Jumlah Masuk</th>
                        <th class="text-center">Jumlah Keluar</th>
                        <th class="text-center">Saldo (QTY)</th>
                        <th class="text-center">Harga Satuan</th>
                      <th class="text-center">Saldo (Rp.)</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                      <th class="text-center">Kode Material</th>
						<th class="text-center">Nama Material</th>
						<th class="text-center">Lokasi Material</th>
                        <th class="text-center">Satuan Gramasi</th>
						<th class="text-center">Jumlah Masuk</th>
                        <th class="text-center">Jumlah Keluar</th>
                        <th class="text-center">Saldo (QTY)</th>
                        <th class="text-center">Harga Satuan</th>
                      <th class="text-center">Saldo (Rp.)</th>
                      </tr>
                    </tfoot>
                    <tbody>
					<?php
                        $juin=0;
                        $jsisarp=0;
						$group_id = $this->session->userdata('group_id');
						foreach($materialsrecord AS $customer)
						{
						 // $juin=$customer->jumin*$customer->konversi;
                          $juin=$customer->jumin;
                          $sisa=$juin-$customer->jumout;
                          $harga1=$customer->material_purchase_price/$customer->material_purchase_unit ;
                          $sisarp=ceil($harga1)*$sisa;
                          $jsisarp=$jsisarp+$sisarp;
						?>
                      <tr>

						<td><?php echo $con->kode_material($customer->material_type,$customer->material_id);?></td>
						<td><?php echo $customer->material_name;?></td>
                        	<td><?php echo $customer->logistic_location_name;?></td>
                            <td><?php echo $customer->material_unit_name;?></td>
                            	<td align="right"><?php echo number_format($juin,0,',',',');?></td>
                                <td align="right"><?php echo number_format($customer->jumout,0,',',',');?></td>
                                <td align="right"><?php echo number_format($sisa,0,',',',');?></td>
                                <td align="right"><?php echo number_format(ceil($harga1),0,',',',');?></td>
                                <td align="right"><?php echo number_format($sisarp,0,',',',');?></td>
                      </tr>
					  <?php };?>
                    </tbody>
                  </table>
                  <div style="text-align: right;"><strong>Total Saldo : <?php echo number_format($jsisarp,0,',',',');?></strong></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			</div><!-- /.col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
