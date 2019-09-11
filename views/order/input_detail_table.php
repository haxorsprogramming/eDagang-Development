<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-6">
				<div class="box box-solid box-warning">
					<div class="box-body">
						<!-- form start -->
						<?php
						$attributes = array('class' => 'form-horizontal');
						echo form_open('order/select_menu'); ?>
						<?php if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
						  <div class="box-body">
							<div class="form-group">
							<?php
							$tables	= $this->order_model->get_table_by_table_id($this->session->userdata('table_id'));
							foreach($tables AS $table)
							{
								$table_name	= $table->table_name;
							}
                            $group_id = $this->session->userdata('group_id');
							?>
								<label>Nomor Meja</label>
								<input type="text" class="form-control" value="<?php echo $table_name;?>" disabled>
							</div>
							<div class="form-group">
								<label>Status</label>
								<select name="order_status" class="form-control">

                                    <?php
			                         if ($group_id == '15' or $group_id == '17'){
			                             ?>
                                         <option value="reservation">Reservasi</option>
                                         <option value="walkin">Walk In</option>
                              <?php
			                         }if($group_id == '12' or $group_id == '13' or $group_id == '14' or $group_id == '15' or $group_id == '16' or $group_id == '17'){?>
																 <option value="in_door">In Door</option>
																 <option value="out_door">Out Door</option>
															 <?php }else{
			                             ?>
                                         <option value="on_the_spot">Makan di Tempat</option>
									     <option value="take_away">Take Away</option>
                                         <option value="reservation">Reservasi</option>
                                         <?
			                         }
                                    ?>

								</select>
							</div>
							<div class="form-group">
								<label>Pelanggan</label>
								<select name="customer_id" class="form-control select2">
								<?php
								$customers	= $this->order_model->get_customer_all();
								foreach($customers as $customer)
								{
								?>
									<option value="<?php echo $customer->customer_id;?>"><?php echo $customer->customer_full_name;?></option>
								<?php
								}
								?>
								</select>
							</div>
							<div class="form-group">
								<label>Jumlah Pengunjung</label>
								<select name="visitor" class="form-control select2">
								<?php
								for($v=1;$v<=100;$v++)
								{
								?>
									<option value="<?php echo $v;?>"><?php echo $v;?></option>
								<?php
								}
								?>
								</select>
							</div>
							<div class="form-group">
								<label>Catatan</label>
								<input type="text" name="remark_table" class="form-control">
							</div>
						  </div><!-- /.box-body -->
						  <div class="box-footer">
							<a href="<?php echo base_url() . 'order/cancel';?>" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-lg btn-success pull-right">Simpan</button>
						  </div><!-- /.box-footer -->
						<?php echo form_close();?>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div>
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
