<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Main content -->
	<section class="content">
	  <!-- Small boxes (Stat box) -->
	  <div class="row">
		
		<div class="col-xs-12">
		  <div class="box box-solid box-success">
			<div class="box-header with-border">
			  <h3 class="box-title"><?=$sub_title?></h3>
			</div><!-- /.box-header -->
			  <div class="box-body">
				<?php					
				if ($this->session->flashdata('message_error'))
					echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
				elseif ($this->session->flashdata('message_success'))
					echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
				
				echo '<label class="text text-red">'.validation_errors().'</label>';
				echo form_open_multipart('account/create',['class'=>'form-horizontal']);?>
				<div class="form-group">
					<label for="Category" class="col-sm-2 control-label">Group</label>
						<div class="col-xs-2">
							<select name="group" class="form-control">
                            <?
							foreach($dgroup AS $pr)
							{
								?>
                                <option value="<?=$pr->group_id?>"><?=$pr->group_name?></option>
                                <?	
							}
                            ?>
								<!--<option value="5">Kasir</option>
								<option value="7">Logistik</option>
								<option value="6">Pelayan</option>
								<option value="4">Supervisor</option>-->
							</select>
						</div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Nama Lengkap</label>
				  <div class="col-xs-5">
					<input type="text" class="form-control" name="full_name" placeholder="Nama Lengkap" value="<?php echo set_value('full_name');?>">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Username</label>
				  <div class="col-xs-5">
					<input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo set_value('username');?>">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">HP</label>
				  <div class="col-xs-5">
					<input type="text" class="form-control" name="hp" placeholder="HP" value="<?php echo set_value('hp');?>">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Email</label>
				  <div class="col-xs-5">
					<input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo set_value('email');?>">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Foto</label>
				  <div class="col-xs-5">
					<input type="file" class="form-control" name="userfile">
				  </div>
				  <label class="col-sm-2 control-label">Maks. 1 MB</label>
				</div>
			  </div><!-- /.box-body -->
			  <div class="box-footer">
				<button type="submit" class="btn btn-success">Simpan</button>
				<a href="<?=base_url()?>account/all" class="btn btn-danger pull-right">Batal</a>
			  </div><!-- /.box-footer -->
		   <?php echo form_close();?>
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <!-- page script rent_car_history-->