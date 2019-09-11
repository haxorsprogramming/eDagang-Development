	<?php
	$reminderaudio = base_url() . 'assets/sounds/echoed-ding.mp3';
	$neworderaudio = base_url() . 'assets/sounds/alarm-frenzy.mp3';
	
	echo "<embed src=".$reminderaudio." hidden=TRUE autostart=true></embed>";
	?>
	<div class="container-fluid">
	  <div class="row">
		<div class="col-xs-12">
			<?php
			if($urgentdrinkrecord == TRUE)
			{?>
			<div class="row">
				<div class="col-xs-12">
					<table class="table table-bordered">
					<thead>
					  <tr>
						<th>Meja</th>
						<th>Menu</th>
						<th>Jumlah</th>
						<th></th>
					  </tr>
					</thead>
					<tbody>
					<?php
						foreach($urgentdrinkrecord AS $urgent)
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
			<?php }?>
			<div class="row">
				<div class="col-xs-12">
				  <table class="table table-bordered">
					<thead>
						<tr class="success" align="center">
							<td colspan="6"><b><?php echo date('H:i:s');?></b></td>
						</tr>
					  <tr>
						<th>Meja</th>
						<th>Menu</th>
						<th>Waiter</th>
						<th></th>
						<th>QTY</th>
						<th></th>
					  </tr>
					</thead>
					<tbody>
					<?php
						foreach($drinksrecord AS $drink)
						{
						echo "<embed src=".$neworderaudio." hidden=TRUE autostart=true></embed>";
						?>
					  <tr>
						<td align="center"><?php echo $drink->table ;?></td>
						<td><?php echo $drink->product_name ;?></td>
						<td><?php echo $drink->full_name;?></td>
						<td align="center"><?php echo date('H:i', strtotime($drink->created_time));?></td>
						<td align="center"><?php echo $drink->qty;?></td>
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
					  <?php };?>
					</tbody>
				  </table>
				</div>
			</div>
						
			<div class="row">
				<div class="col-xs-12">
					<footer class="main-footer">
						<div class="pull-right hidden-xs">
						  <b><?php echo $this->session->userdata('app_name');?></b> Version <?php echo $this->session->userdata('app_version');?>
						</div>
						<strong>Powered by <a href="#">ACI</a></strong>
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