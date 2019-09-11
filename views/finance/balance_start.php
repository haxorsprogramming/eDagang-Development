<script>

  $(function () {

	$('#finance_journal_date').datepicker({
						format: 'dd-mm-yyyy',
						todayBtn: true,
						todayHighlight: true,
						autoclose: true
					});
                    
                    $('#cashier_summary').DataTable({
			 "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			 "order": [[ 0, "asc" ]],
			 "pagingType": "full_numbers",
			 
		 });
		 $('div.dataTables_filter input').focus();
				
  });
</script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Main content -->
	<section class="content">
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-success">
			<div class="box-header">
			  <h3 class="box-title"><?=$sub_title?> </h3>
              
			</div><!-- /.box-header -->
			<?php echo form_open('finance/balance_start_simpanjurnal');?>
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
            
			  <table class="table table-striped table-bordered table-hover" id="cashier_summary">
              <thead>
				  <tr>
					<td></td>
					<td>Tanggal Saldo Awal :</td>
					<td><input type="text"  class="form-control" value="<?php echo date("d-m-Y");?>" name="finance_journal_date" id="finance_journal_date"></td>
				  </tr>
				</thead>
				<thead>
				  <tr>
					<th>Akun</th>
					<th>Debit</th>
					<th>Kredit</th>
				  </tr>
				</thead>
				<tbody>
				<?php
					foreach($balancestartrecord AS $balance)
					{
					if(substr($balance->finance_account_code,0,1)=='1' or substr($balance->finance_account_code,0,1)=='2' or substr($balance->finance_account_code,0,1)=='3'){
					   
					
					?>
				  <tr>
				    <td align=""><input type="hidden" name="acid[]" value="<?php echo $balance->finance_account_id;?>"><?php echo $balance->finance_group_account_name;?> - <?php echo $balance->finance_account_code;?> <?php echo $balance->finance_account_name;?></td>
					<td align="center"><input type="text"  name="debit[]" value="0" class="form-control text-right" >
                    </td>
					<td align="center"><input type="text"  name="kredit[]" value="0" class="form-control text-right" ></td>
				  </tr>
				  <?php
                        }
                   };?>
				</tbody>
			  </table>
			</div><!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" class="btn btn-lg btn-success pull-right">Simpan</button>
			</div>
			<?php echo form_close();?>
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->