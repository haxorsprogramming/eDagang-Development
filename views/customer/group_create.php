	<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            
			<div class="col-xs-12">
              <div class="box box-solid box-default">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $sub_title;?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				<?php					
					if ($this->session->flashdata('message_success')) echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
					elseif ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
					?>
                <!-- form start -->
				<?php 
				echo '<span class=text-red>'.validation_errors().'</span>';
				echo form_open('customer/group_create',['class'=>'form-horizontal']);?>
                  <div class="box-body">
				    <div class="form-group">
                      <label class="col-sm-2 control-label">Nama Group</label>
                      <div class="col-xs-5">
                        <input type="text" class="form-control" name="customer_group_name" placeholder="Nama Group" value="<?php echo set_value('customer_group_name');?>" autofocus>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-2 control-label">Harga Jual</label>
                      <div class="col-xs-3">
							<select name="customer_group_selling_price" class="form-control">
								<option value="selling_price">Harga Jual</option>
								<option value="purchase_price">Harga Modal</option>
							</select>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-sm-2 control-label">Discount</label>
                      <div class="col-xs-2">
						<select name="customer_group_discount" class="form-control">
							<option value="0">0%</option>
							<?php
							for($i=1;$i<=100;$i++)
							{
								$r=$i+=4;
								?>
								<option value="<?=$r?>"><?=$r?>%</option>
								<?php
							}
							?>
						</select>
                      </div>
                    </div>
				  </div><!-- /.box-body -->
                  <div class="box-footer">
				  <a href="<?php echo base_url();?>customer/group" class="btn btn-danger">Batal</a>&nbsp;
                    <button type="submit" class="btn btn-success">Simpan</button>
                    
                  </div><!-- /.box-footer -->
               <?php echo form_close();?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			</div><!-- /.col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->