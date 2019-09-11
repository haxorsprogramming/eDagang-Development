<script>
      $(function () {
        $('#date_required').datepicker({
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
			<div class="box-body">
			<?php
				if ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
				elseif ($this->session->flashdata('message_sucess')) echo '<div class="alert alert-success">'.$this->session->flashdata('message_sucess').'</div>';?>
			<?php
			echo '<span class=text-red>'.validation_errors().'</span>';
			echo form_open('logistic/logistic_req_cart',['class'=>'form-horizontal']);
			?>
			  <div class="box-body">
				<div class="form-group">
				  <label class="col-sm-3 control-label">Tanggal Dibutuhkan</label>
				  <div class="col-xs-2">
					<input type="text" class="form-control" id="date_required" name="pr_date_required" value="<?php echo date('d-m-Y');?>">
				  </div>
				</div>
				<!--div class="form-group">
					<label class="col-sm-3 control-label">Supplier</label>
						<div class="col-xs-3">
							<select name="supplier_id" class="form-control">
							<?php
							$suppliers	= $this->purchase_model->get_suppliers();
							foreach($suppliers as $supplier)
							{
							?>
								<option value="<?php echo $supplier->supplier_id;?>"><?php echo $supplier->supplier_full_name;?></option>
							<?php }?>
							</select>
						</div>
				</div-->
				<div class="form-group">
				  <label class="col-sm-3 control-label">Keterangan</label>
				  <div class="col-xs-5">
					<input type="text" class="form-control" name="po_note" placeholder="Keterangan" value="<?php echo set_value('po_note');?>">
				  </div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"></label>
					<div class="col-xs-3">
						<button type="submit" class="btn btn-success">Simpan</button>
						<a href="<?php echo base_url().'logistic/reqlogistict_list';?>" class="btn btn-default pull-right">Batal</a>
					</div>
				  </div>
			  </div><!-- /.box-body -->
			  
			<?php echo form_close();?>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->