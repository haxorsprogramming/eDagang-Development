	<script>
      $(function () {
         $('#income_year').DataTable({
			 "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
			 "pagingType": "full_numbers"
		 });
      });
    </script>
	
	<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?=$title?>
            <small><?=$sub_title?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> <?=$title?></a></li>
            <li class="active"><?=$sub_title?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
			<div class="col-xs-12">
              <div class="box box-solid box-warning">
                <div class="box-header">
                  <h3 class="box-title"><?=$sub_title?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<?php
						$grand_total = 0;
						foreach($incomesrecord AS $income)
						{
							$total			= $income->income;
							$grand_total	+= $total;
						}
						?>
					<div>
						<h2><?=$sub_title?> : Rp. <?=number_format($grand_total,0,',','.')?></h2>
					</div>
					<div>
						<table id="income_year" class="table table-striped table-bordered table-hover">
						<thead>
						  <tr>
							<th>No. SE</th>
							<th>Bulan</th>
							<th>Jumlah</th>
						  </tr>
						</thead>
						<tbody>
							<?php
							foreach($incomesrecord AS $income)
							{
							?>
						  <tr>
							<td><?php echo $income->se_id;?></td>
							<td><?php echo $income->income_date;?></td>
							<td><?php echo number_format($total,0,',','.')?></td>
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