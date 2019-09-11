<?php
$group_id	= $this->session->userdata('group_id');
?>
<script>
  $(function () {
	 $('#gl').DataTable({
		 "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		 "order": [[ 1, "desc" ]],
		 "pagingType": "full_numbers",
		 "scrollX": true
	 });
   $('#start_date').datepicker({
            format: 'yyyy-mm-dd',
            todayBtn: true,
            todayHighlight: true,
            autoclose: true
          });
  $('#end_date').datepicker({
            format: 'yyyy-mm-dd',
            todayBtn: true,
            todayHighlight: true,
            autoclose: true
          });
  });
</script>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <a href="<?php echo base_url();?>finance/general_journal_create" class="btn btn-md btn-warning">Posting Jurnal</a>
    </section>
	<!-- Main content -->
	<section class="content">
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-success">
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
      <?php echo form_open('finance/general_journal/search/');?>
      <div class="col-xs-12 col-md-3">
        <div class="input-group">
         <span class="input-group-addon">Dari :</span>
          <input type="text" class="form-control" id="start_date" name="start_date" value="<?php echo $tglawal;?>">
        </div><!-- /.input group -->
      </div>
      <div class="col-xs-12 col-md-3">
        <div class="input-group">
           <span class="input-group-addon">Sampai :</span>
           <input type="text" class="form-control" id="end_date" name="end_date" value="<?php echo $tglakhir;?>">
        </div>
      </div><!-- /.input group -->
      <div class="col-xs-12 col-md-1">
        <div class="input-group">
           <button class="btn btn-block btn-primary">Cari</button>
        </div>
      </div><!-- /.input group -->
      <?php echo form_close();?>
      <br>
      <br>
      <br>
			<div>
			  <table id="gl" class="table  table-bordered table-hover">
				<thead>
				  <tr>
					<th>No</th>
					<th>Tanggal</th>
					<th>Nomor Jurnal</th>
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
					foreach($glrecord AS $gl)
					{
					?>
				  <tr>
				    <td align="center"><?php echo $no++;?></td>
					<td align="center"><?php echo date('d-m-Y', strtotime($gl->finance_journal_date));?></td>
					<td align="center"><?php echo $gl->finance_journal_number;?></td>
					<td align="center"><?php echo $gl->finance_account_code;?> <?php echo $gl->finance_account_name;?></td>
					<td align="right"><?php
					if($gl->debit_kredit == 1)
						//echo $gl->nominal;
                         echo number_format($gl->nominal,0,',','.');
					else
						echo "0";
					?></td>
					<td align="right"><?php
					if($gl->debit_kredit == 0)
					//	echo $gl->nominal;
                     echo number_format($gl->nominal,0,',','.');
					else
						echo "0";
					?></td>
					<td><?php echo $gl->ket;?><!--<?php echo anchor('finance/general_ledger/' . $gl->finance_account_id,'Lihat', ['class'=>'btn btn-primary']);?>--></td>
					<?php
					if($group_id == '1')
					{?>
						<th><?php echo anchor('finance/delete_general_journal/' . $gl->finance_journal_id,'Hapus', ['class'=>'btn btn-danger']);?></th>
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
