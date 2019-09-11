

<script>
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $("#education_fields"); //Fields wrapper
    var add_button      = $("#addbutton"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
		 var ap = '	<div><table class="table table-bordered">'+
					'<tr>'+
						'<td align="center"><b>Akun</b></td>'+
						'<td align="center"><b>Debit</b></td>'+
						'<td align="center"><b>Kredit</b></td>'+
                     
					'</tr>'+
					' <tr>'+
						'<td>'+
							'<div class="col-xs-12">'+
'<select name="account1[]" class="form-control"><? foreach($account as $acc){	echo "<option value='".$acc->finance_account_id."'>".$acc->finance_account_code."-".$acc->finance_account_name."</option>"; }?>'+
								'</select>'+
							'</div>'+
						'</td>'+
						'<td>'+
							'<div class="col-xs-12">'+
								'<input type="text" name="debit1[]" class="form-control" value="0" style="text-align:right" >'+
							'</div>'+
						'</td>'+
						'<td>'+
							'<div class="col-xs-12">'+
								'<input type="text" name="kredit1[]" class="form-control" value="0" style="text-align:right">'+
							'</div>'+
						'</td>'+
					'</tr>'+
					'<tr>'+
						'<td>'+
							'<div class="col-xs-12">'+
								'<select name="account2[]" class="form-control">'+
								'</select>'+
							'</div>'+
						'</td>'+
						'<td>'+
							'<div class="col-xs-12">'+
								'<input type="text" name="debit2[]" class="form-control" value="0" style="text-align:right">'+
							'</div>'+
						'</td>'+
						'<td>'+
							'<div class="col-xs-12">'+
								'<input type="text" name="kredit2[]" class="form-control" value="0" style="text-align:right">'+
							'</div>'+
						'</td>'+
						
					'</tr></table></div>';
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append(ap); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); 
		$("#rt"+x).remove(ap);
		x--; 
    })
});


  $(function () {

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
		<div class="box-header with-border">
		  <h3 class="box-title"><?=$sub_title?></h3>
		</div><!-- /.box-header -->
		<div class="box-body">
			<?php					
			if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';
			echo '<span class=text-red>'.validation_errors().'</span>';
			echo form_open('purchase/addcart_journalgeneral','class=form-horizontal');
			?>
			<div class="box-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">Nomor Bukti</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" value="<?php echo set_value('finance_journal_number');?>" name="finance_journal_number">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Tanggal</label>
					<div class="col-xs-2">
						<input type="text"  class="form-control" value="<?php echo date("d-m-Y");?>" name="finance_journal_date" id="finance_journal_date">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Keterangan</label>
					<div class="col-xs-5">
						<input type="text"  class="form-control" value="<?php echo set_value('keterangan');?>" name="keterangan">
					</div>
				</div>
			</div><!-- /.box-body -->
			<div class="box-body">
            <div id="education_fields">
          	<div id="rt1">
				<table class="table table-bordered">
					<tr>
						<td align="center"><b>Akun</b></td>
						<td align="center"><b>Debit</b></td>
						<td align="center"><b>Kredit</b></td>
                        <td align="center"></td>
					</tr>
                   
					<tr>
						<td>
							<div class="col-xs-12">
								<select name="account1[]" class="form-control">
								<?php
								foreach($account as $acc)
								{
								?>
									<option value="<?php echo $acc->finance_account_id;?>"><?php echo $acc->finance_account_code;?> - <?php echo $acc->finance_account_name;?></option>
								<?php }?>
								</select>
							</div>
						</td>
						<td>
							<div class="col-xs-12">
								<input type="text" name="debit1[]" class="form-control" value="0" style="text-align:right" >
							</div>
						</td>
						<td>
							<div class="col-xs-12">
								<input type="text" name="kredit1[]" class="form-control" value="0" style="text-align:right">
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="col-xs-12">
								<select name="account2[]" class="form-control">
								<?php
								foreach($account as $acc)
								{
								?>
									<option value="<?php echo $acc->finance_account_id;?>"><?php echo $acc->finance_account_code;?> - <?php echo $acc->finance_account_name;?></option>
								<?php }?>
								</select>
							</div>
						</td>
						<td>
							<div class="col-xs-12">
								<input type="text" name="debit2[]" class="form-control" value="0" style="text-align:right">
							</div>
						</td>
						<td>
							<div class="col-xs-12">
								<input type="text" name="kredit2[]" class="form-control" value="0" style="text-align:right">
							</div>
						</td>
					</tr>
                    
                    
				</table>
                </div>
                </div>
			</div>

			<div class="box-body">
				<button class="btn btn-success" type="button" id="addbutton"> Tambah Akun</span> </button> <a href="<?=base_url()?>finance/general_journal_create" class="btn btn-danger">Reset</a>
			</div>
            <?php echo form_close();?>
           
			<div class="box-footer">
				<input type="hidden" name="is_submitted" value="1">
				<button type="submit" class="btn btn-success">Simpan</button>
				<a href="<?=base_url()?>finance/general_journal" class="btn btn-danger">Kembali</a>
			</div><!-- /.box-footer -->
			
		</div>
	</div><!-- /.box-body -->
  </div><!-- /.box -->
</div><!-- /.col -->
</div><!-- /.row (main row) -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->