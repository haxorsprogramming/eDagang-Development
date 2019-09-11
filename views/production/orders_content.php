		<?php
        $konorder=count($ordersrecord);
        $konordersrecordpaket=count($ordersrecordpaket);
        if($konorder>0 or $konordersrecordpaket>0){
		$reminderaudio = base_url() . 'assets/sounds/echoed-ding.mp3';
		$neworderaudio = base_url() . 'assets/sounds/alarm-frenzy.mp3';
		
		echo "<embed src=".$reminderaudio." hidden=TRUE autostart=true></embed>";
        }
		?>
		<div class="container-fluid">
          <div class="row">
          <div class="col-xs-4">
          	<table class="table table-bordered">
						<thead>
						  <tr>
							<td align="center"><b></b></td>
							<td align="center"><b>Menu</b></td>
							<td align="center"><b>QTY</b></td>
							<td align="center"><b>Meja</b></td>
							<th></th>
						  </tr>
						</thead>
                        <tbody>
						<?php
							foreach($ordersrecorddone AS $row)
							{
							?>
						  <tr>
						    <td><?php echo date('H:i:s',strtotime($row->created_time));?></td>
							<td><?php echo $row->product_name;?><br>Remark : <?php echo $row->remark;?></br><?php echo $row->order_status;?></td>
							<td align="center"><?php echo $row->qty;?></td>
							<td align="center"><?php echo $row->table;?></td>
							
							<td ><button type="button" class="btn btn-success">SELESAI</button></td>
						  </tr>
						  <?php }
						  
							foreach($ordersrecorddonepaket AS $row)
							{
							?>
						  <tr>
						    <td><?php echo date('H:i:s',strtotime($row->created_time));?></td>
							<td><?php echo $row->product_name;?></td>
							<td align="center"><?php echo $row->qty;?></td>
							<td align="center"><?php echo $row->table;?></td>
							
							<td ><button type="button" class="btn btn-success">SELESAI</button></td>
						  </tr>
						  <?php }
						  ?>
						</tbody>
              </table>
          </div>
			<div class="col-xs-8">
				<?php
				if($ordersrecord == TRUE)
				{
				?>
				<div class="row">
					<div class="col-xs-12">
					  <table class="table table-bordered">
						<thead>
						  <tr>
							<td align="center"><b>Waktu Pesanan</b></td>
							<td align="center"><b>Pelayan</b></td>
							<td align="center"><b>Menu</b></td>
							<td align="center"><b>QTY</b></td>
							<td align="center"><b>Meja</b></td>
<!--							<td align="center"><b>Remark</b></td>-->
							<th></th>
						  </tr>
						</thead>
						<tbody>
						<?php
							foreach($ordersrecord AS $row)
							{
							?>
						  <tr>
						    <td align="center"><?php echo date('d-m-Y H:i:s',strtotime($row->created_time));?></td>
							<td><?php echo $row->full_name;?></td>
							<td><?php echo $row->product_name;?><br>Remark : <?php echo $row->remark;?></br><?php echo $row->order_status;?></td>
							<td align="center"><?php echo $row->qty;?></td>
							<td align="center"><?php echo $row->table;?></td>
<!--
							<td><?php echo $row->remark;?>
							</td>
-->
							<td><?php
										if ($row->status == 'reserved')
										{
											echo "<embed src=".$neworderaudio." hidden=TRUE autostart=true></embed>";
											?>
											<button type="button" onclick="cooked(<?php echo $row->order_id;?>,<?=$row->product_id?>,<?php echo $row->qty;?>)" class="btn btn-warning">Pesanan Baru </button>
											<?php
										}
										elseif ($row->status == 'inprogress')
										{
											?>
											<button type="button" onclick="finished_cooked(<?php echo $row->order_id;?>)" class="btn btn-primary">Sedang Diproses</button>
											<?php
										}
										elseif ($row->status == 'finished')
										{
											?>
											<button type="button" onclick="done_cooked(<?php echo $row->order_id;?>)" class="btn btn-success">Segera Hantar</button>
											<?php
										}
								?>
							</td>
						  </tr>
						  <?php }
						  
							foreach($ordersrecordpaket AS $row)
							{
							?>
						  <tr>
						    <td align="center"><?php echo date('d-m-Y H:i:s',strtotime($row->created_time));?></td>
							<td><?php echo $row->full_name;?></td>
							<td><?php echo $row->product_name;?><br>Remark : <?php echo $row->remark;?></br><?php echo $row->order_status;?></td>
							<td align="center"><?php echo $row->qty;?></td>
							<td align="center"><?php echo $row->table;?></td>
<!--
							<td><?php echo $row->remark;?>
							</td>
-->
							<td><?php
										if ($row->status == 'reserved')
										{
											echo "<embed src=".$neworderaudio." hidden=TRUE autostart=true></embed>";
											?>
											<button type="button" onclick="cooked(<?php echo $row->order_id;?>,<?=$row->product_id?>,<?php echo $row->qty;?>)" class="btn btn-warning">Pesanan Baru </button>
											<?php
										}
										elseif ($row->status == 'inprogress')
										{
											?>
											<button type="button" onclick="finished_cooked(<?php echo $row->order_id;?>)" class="btn btn-primary">Sedang Diproses</button>
											<?php
										}
										elseif ($row->status == 'finished')
										{
											?>
											<button type="button" onclick="done_cooked(<?php echo $row->order_id;?>)" class="btn btn-success">Segera Hantar</button>
											<?php
										}
								?>
							</td>
						  </tr>
						  <?php }
						  ;?>
						</tbody>
					  </table>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<footer class="main-footer">
							<center>
							<b><label class="text-success">Your IP Address (<?php echo $this->input->ip_address();?>) is registered</label></b><br>
                            <b><label class="text-success"></label></b><br>
							<h3 align="center"><?php echo $this->session->userdata('app_name');?></b> Version <?php echo $this->session->userdata('app_version');?></h3>
							</center>
						</footer>
					</div>
				</div><!-- ./row -->
				<?php }
				else
				{?>
				<div class="row">
					<div class="col-xs-12">
						<footer class="main-footer">
							<center>
							<h2><label class="text-info">INFORMATION!</label></h2>
							<h1><label class="text-info">Santai Dulu Bro/Sis. Belum ada pesanan baru lagi nih!!!</label></h1>
							<label class="text-success">Your IP Address (<?php echo $this->input->ip_address();?>) is registered</label>
							<h3 align="center"><?php echo $this->session->userdata('app_name');?></b> Version <?php echo $this->session->userdata('app_version');?></h3>
							</center>
						</footer>
					</div>
				</div><!-- ./row -->
				<!--div class="row">
					<div class="col-xs-12">
						<footer class="main-footer">
							<center>
							<h1><label class="text-danger">WARNING!</label></h1>
							<h1><label class="text-danger">Restricted Area</label></h1>
							<h1><label class="text-danger">Your IP Address (<?php echo $this->input->ip_address();?>) is unregistered</label></h1>
							<h1><label class="text-danger">Don't Continue and Get Out Now From this Page</h1>
							<h3 align="center">Powered by ACI (www.aci.web.id)</h3>
							(<b><?php echo $this->session->userdata('app_name');?></b> Version <?php echo $this->session->userdata('app_version');?>)
							</center>
						</footer>
					</div>
				</div><!-- ./row -->
				<?php }
				?>
				
					
			</div>
		</div><!-- /.col -->
    </div><!-- /.row (main row) -->
	<script>
		function cooked(str,pid,qty)
		{
		  var id	= str;
		  var pid	= pid;
		  var qty	= qty;
		  $.ajax({
			 type: "POST",
			 url: "<?php echo base_url();?>production/cooked",
			 data: "order_id="+id+"&product_id="+pid+"&qty="+qty
		  });
		}
		
		function finished_cooked(str)
		{
		  var id	= str;
		  $.ajax({
			 type: "POST",
			 url: "<?php echo base_url();?>production/finished_cooked",
			 data: "order_id="+id
		  });
		}
		
		function done_cooked(str)
		{
		  var id	= str;
		  $.ajax({
			 type: "POST",
			 url: "<?php echo base_url();?>production/done_cooked",
			 data: "order_id="+id
		  });
		}
	</script>