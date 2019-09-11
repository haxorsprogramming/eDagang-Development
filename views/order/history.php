	<script>
      $(function () {
         $('#history').DataTable({
			 "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
			 "order": [[ 0, "desc" ]]
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
                  <h3 class="box-title"><?=$sub_title?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				<?php
					if($this->session->flashdata('message'))
					{
						echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';
					}
					?>
                  <table id="history" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
						<th>No. Trx</th>
						<th>Waktu Pesan</th>
						<th>Waktu Bayar</th>
						<th>No. Meja</th>
						<th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
						foreach($historyrecord AS $history)
						{
						?>
                      <tr>
						<td><a href="<?php echo base_url() . 'order/detail/' . $history->transaction_code;?>" class="btn btn-xs btn-success btn-block"><?php echo $history->transaction_code;?></a></td>
                        <td><?php echo date('d-m-Y H:i:s', strtotime($history->created_time));?></td>
						<td><?php if($history->payment_time == TRUE) echo date('d-m-Y H:i:s', strtotime($history->payment_time));?></td>
						<td><?php
								if ($history->status == 'unpaid')
								{
									$group_id = $this->session->userdata('group_id');
									if($group_id == '6')
									{
										echo anchor('order/edit/' . $history->transaction_code,$history->table, ['class'=>'btn btn-warning btn-block']);
									}
									else
									{
										echo $history->table;
									}
								}
								else
								{
									echo $history->table;
								}
								?></td>
						<td><?php 
							if ($history->status == 'unpaid')
							{
								echo "BB";
							}
							elseif($history->status == 'paid')
							{
								echo "B";
							}
							?>
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