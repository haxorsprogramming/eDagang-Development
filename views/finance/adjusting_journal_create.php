<script>
$(document).ready(function() {

	//here first get the contents of the div with name class copy-fields and add it to after "after-add-more" div class.
      $(".add-more").click(function(){ 
          var html = $(".copy-fields").html();
          $(".after-add-more").after(html);
      });
//here it will remove the current value of the remove button which has been pressed
      $("body").on("click",".remove",function(){ 
          $(this).parents(".control-group").remove();
      });

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
			echo form_open('purchase/add_journal','class=form-horizontal');
			?>
			<div class="box-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">Nomor Bukti</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" value="<?php echo set_value('finance_journal_number');?>" name="finance_journal_number">
                        <input type="hidden" class="form-control" value="2" name="finance_journal_type_id">
                        
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
            
            		

      	<div class="input-group control-group after-add-more">
			
			<table class="table table-bordered">
					<tr>
						<td align="center"><b>Akun</b></td>
						<td align="center"><b>Debit</b></td>
						<td align="center"><b>Kredit</b></td>
                        <td align="center"><b>Keterangan</b></td>
					</tr>
                    <div id="education_fields">
					<tr>
						<td>
							<div class="col-xs-12">
								<select name="account1[]" class="form-control select2">
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
								<input type="number" name="debit1[]" class="form-control" value="0" style="text-align:right" >
							</div>
						</td>
						<td>
							<div class="col-xs-12">
								<input type="number" name="kredit1[]" class="form-control" value="0" style="text-align:right">
							</div>
						</td>
                       <td>
							<div class="col-xs-12">
								<input type="text" name="ket1[]" class="form-control select2">
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
								<input type="number" name="debit2[]" class="form-control" value="0" style="text-align:right">
							</div>
						</td>
						<td>
							<div class="col-xs-12">
								<input type="number" name="kredit2[]" class="form-control" value="0" style="text-align:right">
							</div>
						</td>
                         <td>
							<div class="col-xs-12">
								<input type="text" name="ket2[]" class="form-control">
							</div>
						</td>
					</tr>
                    
                    </div>
				</table>
			   <!--<input type="text" name="addmore[]" class="form-control" placeholder="Enter Name Here">-->
					  <div class="input-group-btn"> 
						<button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i></button>
					  </div>
			  </div>

      
		

        <!-- Copy Fields-These are the fields which we get through jquery and then add after the above input,-->
        <div class="copy-fields hide">
          <div class="control-group input-group" style="margin-top:10px">
           <!-- <input type="text" name="addmore[]" class="form-control" placeholder="Enter Name Here">-->
           <table class="table table-bordered">
					<tr>
						<td align="center"><b>Akun</b></td>
						<td align="center"><b>Debit</b></td>
						<td align="center"><b>Kredit</b></td>
                       
					</tr>
                    <div id="education_fields">
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
								<input type="number" name="debit1[]" class="form-control" value="0" style="text-align:right" >
							</div>
						</td>
						<td>
							<div class="col-xs-12">
								<input type="number" name="kredit1[]" class="form-control" value="0" style="text-align:right">
							</div>
						</td>
                         <td>
							<div class="col-xs-12">
								<input type="text" name="ket1[]" class="form-control">
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
								<input type="number" name="debit2[]" class="form-control" value="0" style="text-align:right">
							</div>
						</td>
						<td>
							<div class="col-xs-12">
								<input type="number" name="kredit2[]" class="form-control" value="0" style="text-align:right">
							</div>
						</td>
                         <td>
							<div class="col-xs-12">
								<input type="text" name="ket2[]" class="form-control">
							</div>
						</td>
					</tr>
                    
                    </div>
				</table>
            <div class="input-group-btn"> 
              <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i></button>
            </div>
          </div>
        </div>

            </div>
             <div id="education_fields">
             </div>
			<!--<div class="box-body">
				<button class="btn btn-success" type="button"  onclick="education_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
			</div>-->
            
           
			<div class="box-footer">
				<input type="hidden" name="is_submitted" value="1">
				<button type="submit" class="btn btn-success">Simpan</button>
				<a href="<?=base_url()?>finance/adjusting_journal" class="btn btn-danger">Kembali</a>
			</div><!-- /.box-footer -->
			<?php echo form_close();?>
		</div>
	</div><!-- /.box-body -->
  </div><!-- /.box -->
</div><!-- /.col -->
</div><!-- /.row (main row) -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->