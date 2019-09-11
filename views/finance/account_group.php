<script>
  $(function () {
	 $('#account').DataTable({
		 "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		 "order": [[ 1, "asc" ]],
		 "pagingType": "full_numbers",
		 "dom":"Bfrtip",
		 "buttons":['excel','pdf','print']
	 });
	 $('div.dataTables_filter input').focus();
  });
</script>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<a href="<?=base_url()?>finance/account" class="btn btn-info"> Kembali ke Akun</a>&nbsp;
        <a href="<?=base_url()?>finance/account_create_group" class="btn btn-warning">Tambah Akun Group</a>
	</section>

	<!-- Main content -->
	<section class="content">
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-success">
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
			  <table id="account" class="table table-striped table-bordered table-hover">
				<thead>
				  <tr>
					<th class="text-center">Kode</th>
					<th class="text-center">Akun</th>
                    <!--<th>Saldo</th>-->
					<th class="text-center">Keterangan</th>
				  </tr>
				</thead>
				<tbody>
				<?php
					foreach($accountrecord AS $account)
					{
					?>
				  <tr>
					<td><?php echo $account->finance_group_account_code;?></td>
					<td><?php echo anchor('finance/account_edit_group/' . $account->finance_group_account_id,$account->finance_group_account_name);?></td>
                    <!--<td align="right"><?php echo number_format($account->finance_account_saldo,0,',','.') ;?></td>-->
					<td align="center"><?php echo $account->finance_group_account_explanation;?></td>
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