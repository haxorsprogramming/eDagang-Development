	<script>
      $(function () {
         $('#group').DataTable();
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
				<a href="<?php echo base_url();?>member/group_create" class="btn btn-xs btn-primary pull-right"><span class="glyphicon glyphicon-plus"></span></a>
				<?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
				<?php
					if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
                  <table id="group" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
						<th>No.</th>
						<th>Nama Group</th>
						<th>Discount</th>
						<th></th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
						$no=1;
						foreach($grouprecord AS $row)
						{
						?>
                      <tr>
					    <td><?php echo $no++;?></td>
						<td><?php echo $row->member_group_name;?></td>
						<td><?php echo $row->member_group_discount;?></td>
						<td><?php
							$group_id = $this->session->userdata('group_id');
							if ($group_id == 1 OR $group_id == 2 OR $group_id == 4 OR $group_id == 5)
								echo anchor('member/group_edit/' . $row->member_group_id,'Edit', ['class'=>'btn btn-warning']);
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