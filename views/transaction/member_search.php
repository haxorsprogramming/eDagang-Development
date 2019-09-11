	<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?=$title?>
            <small><?=$sub_title?></small>
          </h1>
          <!--ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> <?=$title?></a></li>
            <li class="active"><?=$sub_title?></li>
          </ol-->
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
			<div class="col-xs-12">
              <div class="box box-solid box-warning">
				<?php
				foreach($invoicerecord AS $invoice)
				{
				}
				$price			= 0;
				$totalx			= 0;
				$discount		= 0;
				$discount_value = 0;
				$total 			= 0;
				$subtotal 		= 0;
				$tax 			= 0;
				$service 		= 0;
				$grandtotal		= 0;
				foreach($ordersrecord AS $order)
				{
					if($this->session->userdata('discount_type') == 'all')
					{
						$discount_value	= $this->session->userdata('discount_value');
						$price			= $order->price;
						$subtotal		= $order->qty * $price;
						$totalx			+= $subtotal;
						$discount		= $totalx * ($discount_value / 100);
						$total			= $totalx - $discount;
					}
					elseif($this->session->userdata('discount_type') == 'normal')
					{
						$options		= unserialize($order->options);
						$discountvalue	= element('discount',$options);
						$pricex			= $order->price * ($discountvalue / 100);
						$price			= $order->price - $pricex;
						$subtotal		= $order->qty * $price;
						$totalx			+= $subtotal;
						$discount		+= $pricex + $pricex;
						$total			= $totalx;
					}
					$tax		= $total * 0.1;
					$service	= $total * 0.05;
					$grandtotal	= $total + $tax + $service;
				}
				?>
                <div class="box-header">
					<h3 class="box-title"><?=$sub_title?></h3>
				</div>
				<?php
				if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';
				echo form_open('invoices/member_search',['class'=>'form-horizontal']);
					?>
                <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">No. HP</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" name="hp">
                      </div>
                    </div>
                </div><!-- /.box-header -->
				<div class="box-footer">
					<input type="hidden" name="invoice_id" value="<?php echo $invoice->invoice_id;?>">
                    <button type="submit" class="btn btn-success">Cari</button>
					<a href="<?=base_url()?>invoices" class="btn btn-danger pull-right">Batal</a>
                </div><!-- /.box-footer -->
                <?php echo form_close();?>
              </div><!-- /.box -->
			</div><!-- /.col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->