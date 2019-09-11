	<script>
      $(function () {
         $('#users').DataTable(
		 {
			  "dom":"Bfrtip",
		 "buttons":['excel','pdf','print']
			 }
		 );
		 
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
			<!--<a href="<?php echo base_url();?>cashier/tambah_mbarang" class="btn btn-success">Tambah <?=$title?></a>-->
		</section>
		
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            
			<div class="col-xs-12">
              <div class="box box-solid box-warning">
              			<div class="box-body">
			  <div class="col-xs-12">
				<?php echo form_open('cashier/laptransaksi_search');
				
				?>
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
					if ($this->session->flashdata('message_error'))
						echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
					elseif ($this->session->flashdata('message_success'))
						echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
				?>
				<div>
				</div>
                  <table id="users" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
						<th class="text-center">No.</th>
						<th class="text-center">Kode Barang</th>
						<th class="text-center">Nama Barang</th>
                        <th class="text-center">QTY</th>
						<th class="text-align">Harga</th>
						<th class="text-center"></th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
						$no = 0;
						foreach($dbarang AS $user)
						{
						$no++;
						?>
                      <tr>
						<td><?php echo $no ;?></td>
                        <td><?php echo $user->kode_barang ;?></td>
						<td><?php echo $user->nama_barang;?></td>
                        <td align="right"><?php echo $user->qty_transaksi;?></td>
						<td align="right"><?php echo number_format($user->harga_transaksi,0,',','.');?></td>
						<td>
                                         
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
	  <!-- page script rent_car_history-->