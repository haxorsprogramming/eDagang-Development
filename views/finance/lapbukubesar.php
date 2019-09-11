<script>
  $(function () {
	 $('#balance_sheet').DataTable({
		 "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
		 "pagingType": "full_numbers",
		 "dom":"Bfrtip",
		 "buttons":['excel','pdf','print']
	 });
	 $('div.dataTables_filter input').focus();
	 $('#finance_journal_date').datepicker({
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
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-warning">
			<div class="box-header">
			  <h3 class="box-title"><?=$sub_title?></h3>
			</div><!-- /.box-header -->
            <?
			echo form_open('finance/lapbukubesarperiode','class=form-horizontal');
            ?>
            <div class="box-body" align="center">
            <div class="col-xs-3">
            Periode :
            </div>
            <div class="col-xs-3">
            	<select class="form-control" name="bln">
            		<?php
            			for($i=1;$i<=12;$i++){
            				if(strlen($i)==1){
            					$ni="0".$i;
            				}else{
            					$ni=$i;
            				}
            				?>
            				<option value="<?=$ni ?>"><?=$ni ?></option>
            				<?
            			}
            		?>
            	</select>
            	</div>
            	<div class="col-xs-3">
            	<select class="form-control" name="thn">
            		<?php
            		for($yi=date('Y'); $yi>=date('Y')-5; $yi-=1){
            				
            				?>
            				<option value="<?=$yi?>"><?=$yi ?></option>
            				<?
            			}
            		?>
            	</select>
            </div>
            <div class="col-xs-3">
            	<button type="submit" class="btn btn-success">Tampil Data</button>
                </div>
            </div>
            <?php echo form_close();?>
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
			  <table id="balance_sheet" class="table table-striped table-bordered table-hover">
				<thead>
				  <tr>
					<th>Akun</th>
					<th>Saldo</th>
				  </tr>
				</thead>
				<tbody>
				<?php
					foreach($bsrecord AS $balance)
					{
					?>
				  <tr>
				    <td><?php echo $balance->finance_group_account_code;?> <?php echo $balance->finance_group_account_name;?> - <?php echo $balance->finance_account_code;?> <?php echo $balance->finance_account_name;?></td>
					<td align="right"><?php echo number_format($balance->finance_account_saldo,0,',','.');?></td>
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