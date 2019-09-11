	<script>
      $(function () {
         $('#member').DataTable();
      });
    </script>
	
	<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
     
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            
			<div class="col-xs-12">
              <div class="box box-solid box-warning">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $sub_title;?></h3> <?php if($this->session->userdata('group_id') <> '6')
				{
					?>
				<a href="<?php echo base_url();?>member/create" class="btn btn-xs btn-primary pull-right"><span class="glyphicon glyphicon-plus"></span></a>
				<?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
				<?php
					if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
                  <table id="member" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
						<th>ID Member</th>
						<th>Username</th>
						<th>Nama Lengkap</th>
						<th>Group</th>
						<th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
						foreach($membersrecord AS $member)
						{
						?>
                      <tr>
					    <td><?php echo $member->member_id;?></td>
						<td><?php echo $member->username;?></td>
						<td><?php echo $member->full_name;?></td>
						<td><?php 
							$groups	= $this->member_model->get_group_by_group_id($member->member_group_id);
							foreach($groups as $row)
							{
								echo $row->member_group_name;
							}
							?>
						</td>
						<td><?php
							$group_id = $this->session->userdata('group_id');
							if ($group_id == 1 OR $group_id == 2 OR $group_id == 4 OR $group_id == 5)
								echo anchor('member/edit/' . $member->user_id,'Edit', ['class'=>'btn btn-warning']);
							//elseif($group_id == 1)
							//echo anchor('members/delete/' . $member->user_id,'Delete', ['class'=>'btn btn-danger', 'onclick'=>'return confirm(\'Apakah Anda Yakin?\')']);
							?>
						</td>
                      </tr>
					  <?php };?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			</div><!-- /.col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  <!-- page script rent_car_history-->