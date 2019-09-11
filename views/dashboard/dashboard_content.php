<!-- Content Header (Page header) -->
<section class="content-header">
  <!--ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $title;?></a></li>
	<li class="active"><?php echo $sub_title;?></li>
  </ol-->
</section>
<!-- Main content -->
<section class="content">
  <!--div class="alert alert-warning">Info Berdasarkan dari tanggal <b><?php echo $lastMonth?></b> sampai hingga <b><?php echo $thisMonth?></b></div>
  <br>
  <!--div class="alert alert-info">
    <h2><marquee direction="left">New Update tampilan dan untuk melakukan order sekarang ada di menu transaksi</marquee></h2>
  </div>
  <!-- Info boxes -->
  <div class="row">

    <a href="<?php echo base_url('transaction');?>">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3>
          <?php
    		  foreach($counttransactions as $countt)
    		  {
    			echo number_format($countt->count_transactions,0,',','.');
    		  }
    		  ?>
        </h3>
          <p>Transactions</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <div class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </div>
      </div>
  </div>
    </a>

    <a href="<?php echo base_url('product');?>">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <h3>
          <?php
          foreach($countproducts as $countp)
          {
          echo number_format($countp->count_products,0,',','.');
          }
          ?>
        </h3>
          <p>Products</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <div class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </div>
    </div>
  </div>
    </a>

    <a href="<?php echo base_url('report/sales');?>">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>
            <?php
            foreach($countsales as $counts)
            {
            echo number_format($counts->count_sales,0,',','.');
            }
            ?>
          </h3>
            <p>Sales</p>
        </div>
        <div class="icon">
            <i class="fa fa-shopping-cart"></i>
        </div>
        <div class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
          </div>
      </div>
  </div>
  </a>

    <a href="<?php echo base_url('customer/all');?>">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">
          <h3>
            <?php
            foreach($countmember as $countm)
            {
            echo number_format($countm->count_member,0,',','.');
            }
            ?>
          </h3>
            <p>Customers</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-people"></i>
        </div>
        <div class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
        </div>
      </div>
  </div>
        </a>


  </div><!-- /.row -->

  <!-- Main row -->
  <div class="row">
	<!-- Left col -->

  <div class="col-md-4">
	  <!-- DIRECT CHAT -->
	  <div class="box box-warning box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title">Top 10 Foods</h3>
		</div><!-- /.box-header -->
		<div class="box-body">
		  <div class="table-responsive">
			<table class="table no-margin">
			  <thead>
				<tr>
				  <th>Product</th>
				  <th>QTY</th>
				</tr>
			  </thead>
			  <tbody>
				<?php
				foreach ($topfoodsrecord as $toporder)
				{
				?>
				<tr>
				  <td><?php echo $toporder->product_name;?></td>
				  <td><?php echo number_format($toporder->qty,0,',','.');?></td>
				</tr>
				<?php }?>
			  </tbody>
			</table>
		  </div><!-- /.table-responsive -->
		</div><!-- /.box-body -->
	  </div><!-- /.box -->
	</div><!-- /.col -->

  <div class="col-md-4">
	  <!-- DIRECT CHAT -->
	  <div class="box box-warning box-solid">
		<div class="box-header bg-purple with-border">
		  <h3 class="box-title">Top 10 Beverages</h3>
		</div><!-- /.box-header -->
		<div class="box-body">
		  <div class="table-responsive">
			<table class="table no-margin">
			  <thead>
				<tr>
				  <th>Product</th>
				  <th>QTY</th>
				</tr>
			  </thead>
			  <tbody>
				<?php
				foreach ($topdrinksrecord as $toporder)
				{
				?>
				<tr>
				  <td><?php echo $toporder->product_name;?></td>
				  <td><?php echo number_format($toporder->qty,0,',','.');?></td>
				</tr>
				<?php }?>
			  </tbody>
			</table>
		  </div><!-- /.table-responsive -->
		</div><!-- /.box-body -->
	  </div><!-- /.box -->
	</div><!-- /.col -->

  <div class="col-md-4">
	  <div class="box box-default box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title">Top 10 Servers</h3>
		</div><!-- /.box-header -->
		<div class="box-body">
			<div class="table-responsive">
				<table class="table no-margin">
				  <thead>
					<tr>
					  <th>Server Name</th>
					  <th>QTY</th>
					</tr>
				  </thead>
				  <tbody>
					<?php
					foreach ($topwaitersrecord as $towaiter)
					{
					?>
					<tr>
					  <td><?php echo $towaiter->full_name;?></td>
					  <td><?php echo number_format($towaiter->qty,0,',','.');?></td>
					</tr>
					<?php }?>
				  </tbody>
				</table>
			  </div><!-- /.table-responsive -->
		</div><!-- /.box-body -->
	  </div><!-- /.box -->
	</div><!-- /.col -->

	</div><!-- /.row -->

  <div class="row">

  <div class="col-md-4">
  	  <!-- USERS LIST -->
  	  <div class="box box-danger box-solid">
  		<div class="box-header with-border">
  		  <h3 class="box-title">Top 10 Customers</h3>
  		</div><!-- /.box-header -->
  		<div class="box-body">
  		  <!-- <ul class="users-list clearfix">
  			<?php
  			//foreach ($membersrecord as $member)
  			{
  			?>
  			<li>
  			  <img src="<?php //echo base_url();?>assets/img/members/<?php //echo $member->image;?>" alt="User Image">
  			  <a class="users-list-name" href="#"><?php //echo $member->full_name;?></a>
  			</li>
  			<?php }?>
      </ul><!-- /.users-list -->
        <script type="text/javascript">
        $(function () {
         $('#dataTables').DataTable({
           paging: false,
           searching: false,
           "order": [[ 1, "desc" ]]
          });
         });
        </script>
			<table class="table" id='dataTables'>
			  <thead>
				<tr>
				  <th>Customer Name</th>
                    <th>QTY Trx</th>
        </tr>
			  </thead>
        <tbody>
          <?php foreach ($topcustomer as $key): ?>
          <tr>
            <td><?php echo $key->customer_full_name?></td>
            <td><?php echo $key->jumlah_transaksi?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
  		</div><!-- /.box-body -->
  	  </div><!--/.box -->
  </div><!-- /.col -->

    <!-- TABLE: LATEST ORDERS -->
    <div class="col-md-8">
      <div class="box box-info box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Latest Orders</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive">
        <table class="table no-margin">
          <thead>
          <tr>
            <!-- <th>Order ID</th> -->
            <th>Time</th>
            <th>Server</th>
            <th>Product</th>
            <th>Qty</th>
            <th>Status</th>
          </tr>
          </thead>
          <tbody>
          <?php
          foreach ($ordersrecord as $order)
          {
            if($order->status == 'urgent')
            {
              $label = ' label-primary';
            }
            elseif($order->status == 'reserved')
            {
              $label = ' label-info';
            }
            elseif($order->status == 'inprogress')
            {
              $label = ' label-warning';
            }
            elseif($order->status == 'finished')
            {
              $label = ' label-primary';
            }
            elseif($order->status == 'done')
            {
              $label = ' label-success';
            }
            elseif($order->status == 'canceled')
            {
              $label = ' label-danger';
            }
          ?>
          <tr>
            <!-- <td><?php echo $order->order_id;?></td> -->
            <td><?php echo date('d-m-Y H:i:s', strtotime($order->created_time));?></td>
            <td><?php echo $order->full_name;?></td>
            <td><?php echo $order->product_name;?></td>
            <td><?php echo $order->qty;?></td>
            <td><span class="label<?php echo $label;?>"><?php echo $order->status;?></span></td>
          </tr>
          <?php }?>
          </tbody>
        </table>
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->

  </div><!-- /.row -->

</section><!-- /.content -->
