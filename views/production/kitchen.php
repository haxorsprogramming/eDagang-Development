		<?php
		$reminderaudio = base_url() . 'assets/sounds/echoed-ding.mp3';
		$neworderaudio = base_url() . 'assets/sounds/alarm-frenzy.mp3';
		
		echo "<embed src=".$reminderaudio." hidden=TRUE autostart=true></embed>";
		?>
		<div class="container-fluid">
          <div class="row">
			<div class="col-xs-12">
				<?php
				if($urgentrecord == TRUE)
				{
				?>
				<div class="row">
					<div class="col-xs-12">
						<table class="table table-bordered">
						<thead>
						  <tr>
							<th>Meja</th>
							<th>Menu</th>
							<th>QTY</th>
							<th>Remark</th>
							<th></th>
						  </tr>
						</thead>
						<tbody>
						<?php
							foreach($urgentrecord AS $urgent)
							{
								if ($urgent->order_id > 0)
								{
									echo "<embed src=".$neworderaudio." hidden=TRUE autostart=true></embed>";
								}
							?>
						  <tr class="danger">
							<td><?php echo $urgent->table ;?></td>
							<td><?php echo $urgent->product_name ;?></td>
							<td><?php echo $urgent->qty;?></td>
							<td><?php
								$options	= unserialize($urgent->options);
								$remark		= element('remark',$options);
								echo $remark;?>
							</td>
							<td><?php
										if ($urgent->status == 'urgent')
										{
											?>
											<a href="<?=base_url()?>kitchen/finished_cooked/<?=$urgent->order_id?>" class="btn btn-success">Done</a>
											<?php
										}
								?> <img src="<?=base_url()?>assets/img/icons/awasya.gif" height="35">
							</td>
						  </tr>
						  <?php };?>
						</tbody>
					  </table>
					</div>
				</div>
				<?php };
				if($foodsrecord == TRUE OR $drinksrecord == TRUE)
				{
				?>
				<div class="row">
					<div class="col-xs-6">
					  <table class="table table-bordered">
						<thead>
							<tr class="info">
								<td colspan="5" align="center"><b>Makanan</b></td>
							</tr>
						  <tr>
							<th>Meja</th>
							<th>Menu</th>
							<th>QTY</th>
							<th>Remark</th>
							<th></th>
						  </tr>
						</thead>
						<tbody>
						<?php
							foreach($foodsrecord AS $food)
							{
							?>
						  <tr>
							<td><?php echo $food->table ;?></td>
							<td><?php echo $food->product_name ;?></td>
							<td><?php echo $food->qty;?></td>
							<td><?php
								$options	= unserialize($food->options);
								$remark		= element('remark',$options);
								echo $remark;?>
							</td>
							<td><?php
										if ($food->status == 'reserved')
										{
											echo "<embed src=".$neworderaudio." hidden=TRUE autostart=true></embed>";
											?>
											<button type="button" onclick="cooked(<?php echo $food->order_id;?>)" class="btn btn-warning">Pesanan Baru</button>
											<?php
										}
										elseif ($food->status == 'inprogress')
										{
											?>
											<button type="button" onclick="finished_cooked(<?php echo $food->order_id;?>)" class="btn btn-primary">Sedang Di Masak</button>
											<?php
										}
										elseif ($food->status == 'finished')
										{
											?>
											<button type="button" onclick="done_cooked(<?php echo $food->order_id;?>)" class="btn btn-success">Segera Hantar</button>
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
					<div class="col-xs-6">
					  <table class="table table-bordered">
						<thead>
							<tr class="success">
								<td colspan="5" align="center"><b>Minuman</b></td>
							</tr>
						  <tr>
							<th>Meja</th>
							<th>Menu</th>
							<th>QTY</th>
							<th>Remark</th>
							<th></th>
						  </tr>
						</thead>
						<tbody>
						<?php
							foreach($drinksrecord AS $drink)
							{
							?>
						  <tr>
							<td><?php echo $drink->table ;?></td>
							<td><?php echo $drink->product_name ;?></td>
							<td><?php echo $drink->qty;?></td>
							<td><?php
								$options	= unserialize($drink->options);
								$remark		= element('remark',$options);
								echo $remark;?>
							</td>
							<td><?php
										if ($drink->status == 'reserved')
										{
											echo "<embed src=".$neworderaudio." hidden=TRUE autostart=true></embed>";
											?>
											<button type="button" onclick="cooked(<?php echo $drink->order_id;?>)" class="btn btn-warning">Pesanan Baru</button>
											<?php
										}
										elseif ($drink->status == 'inprogress')
										{
											?>
											<button type="button" onclick="finished_cooked(<?php echo $drink->order_id;?>)" class="btn btn-primary">Sedang Di Racik</button>
											<?php
										}
										elseif ($drink->status == 'finished')
										{
											?>
											<button type="button" onclick="done_cooked(<?php echo $drink->order_id;?>)" class="btn btn-success">Segera Hantar</button>
											<?php
										}
								?>
							</td>
						  </tr>
						  <?php } ;?>
						</tbody>
					  </table>
					</div>
				</div>
				<?php }
				else
				{
					echo "<center><h1>Santai dulu Bro/Sis.<br>Lagi Kosong Order Nih!!!</h1></center>";
				}
				?>
				<div class="row">
					<div class="col-xs-12">
						<footer class="main-footer">
							<p align="center"><strong>Powered by <a href="#">ACI</a></strong> (<b>ACI Resto</b> Version 1.0.6)</p>
						</footer>
					</div>
				</div><!-- ./row -->
					
			</div>
		</div><!-- /.col -->
    </div><!-- /.row (main row) -->
	<script>
		function cooked(str)
		{
		  var id	= str;
		  $.ajax({
			 type: "POST",
			 url: "<?php echo base_url();?>kitchen/cooked",
			 data: "id="+id
		  });
		}
		
		function finished_cooked(str)
		{
		  var id	= str;
		  $.ajax({
			 type: "POST",
			 url: "<?php echo base_url();?>kitchen/finished_cooked",
			 data: "id="+id
		  });
		}
		
		function done_cooked(str)
		{
		  var id	= str;
		  $.ajax({
			 type: "POST",
			 url: "<?php echo base_url();?>kitchen/done_cooked",
			 data: "id="+id
		  });
		}
	</script>