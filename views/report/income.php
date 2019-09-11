	<script>
      $(function () {
         $('#income').DataTable({
			 "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			 "pagingType": "full_numbers"
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
	
	<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
			<div class="col-xs-12">
              <div class="box box-solid box-warning">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $sub_title;?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<?php
						$total_cash 	= 0;
						$total_noncash 	= 0;
						foreach($incomesrecord AS $income)
						{
							$income_cash		= $income->income_cash;
							$income_noncash		= $income->income_noncash;
							$total_cash			+= $income_cash;
							$total_noncash		+= $income_noncash;
						}
						?>
					<div class="col-xs-6">
						<h3>Pendapatan Tunai : Rp. <?php echo number_format($total_cash,0,',','.');?></h3>
					</div>
					<div class="col-xs-6">
						<h3>Pendapatan Non Tunai : Rp. <?=number_format($total_noncash,0,',','.');?></h3>
					</div>
					<div class="col-xs-12">
					<?php echo form_open('report/income_search');?>
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
					<div class="col-xs-2">
					    <div class="input-group">
					       <button class="btn btn-block btn-primary">Cari</button>
                        </div>
					</div><!-- /.input group -->
					<?php echo form_close();?>
                  </div>
				 </div>
				 <div class="box-body">
					<div>
						<table id="income" class="table table-striped table-bordered table-hover">
						<thead>
						  <tr>
							<th>No. SE</th>
							<th>Kasir</th>
							<th>Tanggal</th>
							<th>Pendapatan Tunai</th>
							<th>Pendapatan Non Tunai</th>
							<th>Keterangan</th>
						  </tr>
						</thead>
						<tbody>
							<?php
							foreach($incomesrecord AS $income)
							{
							?>
						  <tr>
							<td><?php echo $income->se_id;?></td>
							<td><?php echo $income->full_name;?></td>
							<td><?php echo date("d-m-Y H:i:s",strtotime($income->closed_shift_time));?></td>
							<td><?php echo number_format($income->income_cash,0,',','.');?></td>
							<td><?php echo number_format($income->income_noncash,0,',','.');?></td>
							<td><?php echo $income->closed_shift_notes;?></td>
						  </tr>
						<?php }?>
						</tbody>
					  </table>
				   </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			</div><!-- /.col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->