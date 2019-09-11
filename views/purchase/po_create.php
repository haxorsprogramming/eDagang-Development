<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Main content -->
	<section class="content">

	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-success">
			<div class="box-body">
			<?php
				if ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
				elseif ($this->session->flashdata('message_sucess')) echo '<div class="alert alert-success">'.$this->session->flashdata('message_sucess').'</div>';?>
			<?php
			echo '<span class=text-red>'.validation_errors().'</span>';
			echo form_open('purchase/po_cart',['class'=>'form-horizontal']);
			foreach($countpo as $po)
			{
				$po_count	= $po->count + 1;
				$po_number	= $this->session->userdata('po_prefix_code') . $po_count;
			}
			?>
			  <div class="box-body">
			    <div class="form-group">
				  <label class="col-sm-5 col-md-2 control-label">PO Number</label>
				  <div class="col-sm-4">
					<input type="text" class="form-control" name="po_number" value="<?php echo $po_number;?>" readonly="readonly">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-5 col-md-2 control-label">Tanggal Dibutuhkan</label>
				  <div class="col-sm-4">
					<input type="text" class="form-control" id="date_required" name="po_date_required" value="<?php echo date('d-m-Y');?>">
				  </div>
				</div>
				<div class="form-group">
					<label class="col-sm-5 col-md-2 control-label">Supplier</label>
						<div class="col-sm-7 col-md-6">
							<select name="supplier_id" class="form-control select2">
                                <option value="">-- Pilih --</option>
							<?php
							$suppliers	= $this->purchase_model->get_suppliers();
							foreach($suppliers as $supplier)
							{
							?>
								<option value="<?php echo $supplier->supplier_id;?>"><?php echo $supplier->supplier_full_name;?></option>
							<?php }?>
							</select>
						</div>
				</div>
				<div class="form-group">
				  <label class="col-sm-5 col-md-2 control-label">Keterangan</label>
				  <div class="col-sm-6">
					<input type="text" class="form-control" name="po_note" placeholder="Keterangan" value="<?php echo set_value('po_note');?>">
				  </div>
				</div>
			  </div><!-- /.box-body -->
			  <div class="box-footer">
				<button type="submit" class="btn btn-success">Simpan</button>
                <a href="<?php echo base_url().'purchase';?>" class="btn btn-danger pull-right">Batal</a>
			  </div><!-- /.box-footer -->
			<?php echo form_close();?>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->
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