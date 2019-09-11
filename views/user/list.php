<script>
		$(function () {
			 $('#users').DataTable({
		 "scrollX": true
	 });
		});
	</script>

<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<a href="<?php echo base_url();?>account/create" class="btn btn-warning">Tambah Pengguna</a>
	</section>

			<!-- Main content -->
			<section class="content">
				<!-- Small boxes (Stat box) -->
				<div class="row">

		<div class="col-xs-12">
						<div class="box box-solid box-success">
							<div class="box-body">
			<?php
				if ($this->session->flashdata('message_error'))
					echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
				elseif ($this->session->flashdata('message_success'))
					echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
			?>
			<div>
			</div>
								<table id="users" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
					<th class="text-center">No.</th>
					<th class="text-center">username</th>
					<th class="text-center">Nama</th>
					<th class="text-center">Grup</th>
					<th class="text-center"></th>
										</tr>
									</thead>
                                                        <tbody>
                                        <?php
                                        $no = 0;
                                        foreach($usersrecord AS $user)
                                        {
                                            if ($user->username !== 'admin')
                                            {
                                            $no++;
                                            ?>
                                            <tr>
                                                <td><?php echo $no ;?></td>
                                                                        <td><?php echo $user->username ;?></td>
                                                <td><?php echo $user->full_name;?></td>
                                                <td><?php echo $user->group_name;?></td>
                                                <td>
                                                    <?php echo anchor('account/edit/' . $user->user_id,'Edit', ['class'=>'btn btn-xs btn-warning']);?> <?php //echo anchor('users/delete/' . $user->user_id,'Delete', ['class'=>'btn btn-danger', 'onclick'=>'return confirm(\'Apakah Anda Yakin?\')']);?>
                                                    <?php if($this->session->userdata('group_id')=='1'||$this->session->userdata('group_id')=='2'){ ?>
                                                        <br>
                                                    <br>
                                                    <?php echo anchor('account/reset_password/' . $user->user_id,'Ganti password', ['class'=>'btn btn-xs btn-info']);?>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php }
                                        }?>
									</tbody>
								</table>
							</div><!-- /.box-body -->
						</div><!-- /.box -->
		</div><!-- /.col -->
				</div><!-- /.row (main row) -->

			</section><!-- /.content -->
		</div><!-- /.content-wrapper -->
	<!-- page script rent_car_history-->
