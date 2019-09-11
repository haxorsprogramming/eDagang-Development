<?php
$group_id	= $this->session->userdata('group_id');
?>
<script>
  $(function () {
	 $('#aj').DataTable({
		 "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		 "order": [[ 0, "asc" ]],
		 "pagingType": "full_numbers",
		 "scrollX": true
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
			  <a href="<?php echo base_url();?>finance/adjusting_journal_create" class="btn btn-xs btn-primary pull-right"><span class="glyphicon glyphicon-plus"></span></a>
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
			  <table id="aj" class="table table-striped table-bordered table-hover">
				<thead>
				  <tr>
					<th>No</th>
					<th>Tanggal</th>
					<th>No. Ref.</th>
					<th>Akun</th>
					<th>Debit</th>
					<th>Kredit</th>
					<th>Keterangan</th>
					<?php
					if($group_id == '1')
					{?>
						<th></th>
					<? } ?>
				  </tr>
				</thead>
				<tbody>
				<?php
					$no=1;
					foreach($ajrecord AS $aj)
					{
					?>
				  <tr>
				    <td align="center"><?php echo $no++;?></td>
					<td align="center"><?php echo date('d-m-Y', strtotime($aj->finance_journal_date));?></td>
					<td align="center"><?php echo $aj->finance_journal_number;?></td>
					<td align="center"><?php echo $aj->finance_account_code;?> <?php echo $aj->finance_account_name;?></td>
					<td align="right"><?php
					if($aj->debit_kredit == 1)
						//echo $aj->nominal;
                        echo number_format($aj->nominal,0,',','.');
					else
						echo "0";
					?></td>
					<td align="right"><?php
					if($aj->debit_kredit == 0)
						//echo $aj->nominal;
                        echo number_format($aj->nominal,0,',','.');
					else
						echo "0";
					?></td>
					<td><?php echo $aj->ket;?><!--<?php echo anchor('finance/general_ledger/' . $aj->finance_account_id,'Lihat', ['class'=>'btn btn-primary']);?>--></td>
					<?php
					if($group_id == '1')
					{?>
						<th><?php echo anchor('finance/delete_adjusting_journal/' . $aj->finance_journal_id,'Hapus', ['class'=>'btn btn-danger']);?></th>
					<? } ?>
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