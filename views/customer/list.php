	<script>
      $(function () {
         $('#customer').DataTable({
			 "scrollX": true,
			 "dom":"Bfrtip",
			"buttons":['excel','pdf','print']
		 });
      });
    </script>
	
	<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
		<section class="content-header">
			 <h1>
				<a href="<?php echo base_url();?>customer/create" class="btn btn-warning"><i class='fa fa-plus-square'></i> Tambah Pelanggan</a>&nbsp;
                <?php
                $group_id = $this->session->userdata('group_id');
                if ($group_id < 5)
                {
                ?>
                <a href="<?php echo base_url();?>customer/group" class="btn btn-primary"><i class='fa fa-users'></i> Group</a>
                <?php }?>
			</h1>
		</section>
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            
			<div class="col-xs-12">
              <div class="box box-solid box-default">
                <div class="box-body">
				<?php
					if ($this->session->flashdata('message_success')) echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
					if ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';?>
                  <table id="customer" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
						<th class="text-center">Nama Lengkap</th>
						<th class="text-center">Saldo</th>
						<th class="text-center">Group</th>
                        <th class="text-center">Telp./Hp</th>
                        <th class="text-center">Email</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
						$group_id = $this->session->userdata('group_id');
						foreach($customersrecord AS $customer)
						{
						?>
                      <tr>
						<td><?php if ($group_id == 1 OR $group_id == 2 OR $group_id == 4 OR $group_id == 5 OR $group_id == 6)
								echo anchor('customer/edit/' . $customer->customer_id,$customer->customer_full_name);
								else echo $customer->customer_full_name;?></td>
						<td><?php echo number_format($customer->customer_saldo,0,',','.');?></td>
						<td><?php echo $customer->customer_group_name;?></td>
                        	<td><?php echo $customer->customer_hp;?></td>
                            	<td><?php echo $customer->customer_email;?></td>
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