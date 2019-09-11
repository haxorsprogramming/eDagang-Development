	<script>
      $(function () {
         $('#sales').DataTable({
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
                  <table id="sales" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
						<th>No.</th>
						<th>Tanggal</th>
						<th>No. Produk</th>
						<th>Produk</th>
						<th>QTY</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
						$no=1;
						foreach($salesrecord AS $sales)
						{
						?>
                      <tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $sales->sales_date;?></td>
                        <td><?php echo $sales->product_id;?></td>
						<td><?php echo $sales->product_name;?></td>
						<td><?php echo $sales->qty;?></td>
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