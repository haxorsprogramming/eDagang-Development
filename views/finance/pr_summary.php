	<script>
      $(function () {
         $('#pr_summary').DataTable({
			 "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
			 "order": [[ 0, "desc" ]],
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
		  <div class="row">
			<div class="col-xs-12">
				<div class="box box-solid">
					<div class="box-body">
						<a href="<?=base_url()?>finance/pr_create" class="btn btn-primary">New PR</a>
					</div>
				</div>
			</div>
		  </div>
          <div class="row">
			<div class="col-xs-12">
              <div class="box box-solid box-warning">
                <div class="box-header">
                  <h3 class="box-title"><?=$sub_title?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				<?php
				if ($this->session->flashdata('message_success'))
					echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
				elseif ($this->session->flashdata('message_error'))
					echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
				?>
				<!--div>
					<p>
					<?php //echo anchor('finance/se_create','Tambah', ['class'=>'btn btn-success']);?>
					</p>
				</div-->
				<div>
                  <table id="pr_summary" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
						<th>No. PR</th>
						<th>Tanggal</th>
						<th>Oleh</th>
						<th>Total</th>
						<th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
						foreach($prrecord AS $pr)
						{
						?>
                      <tr>
						<td align="center"><?php echo $pr->pr_number;?></td>
						<td align="center"><?php
											$get_cashier_name = $this->account_model->get_user_by_user_id($se->created_by);
											foreach($get_cashier_name as $cashier)
											{
												$cashier_full_name	= $cashier->full_name;
											}
											echo $cashier_full_name;?></td>
						<td align="center"><?php if($se->closed_shift_time == TRUE) echo date("d-m-Y H:i:s",strtotime($se->closed_shift_time));?></td>
						<td align="center"><?php if($se->total_cash == TRUE) echo number_format($se->total_cash,0,',','.');?></td>
						<td align="center"><?php
												if($se->verified_time == FALSE)
													echo "<span class=text-red>Belum</span>";
												else echo "<span class=text-green>Sudah</span>";?></td>
						<td><?php
								echo anchor('finance/se_detail/' . $se->se_id,'Detail', ['class'=>'btn btn-primary']);
								/* if($se->verified_time == FALSE)
								{
									echo "&nbsp;";
									echo anchor('finance/se_edit/' . $se->se_id,'Edit', ['class'=>'btn btn-warning']);									
								}
								else
									echo ""; */
							?>
						</td>
                      </tr>
					  <?php };?>
                    </tbody>
                  </table>
				 </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			</div><!-- /.col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->