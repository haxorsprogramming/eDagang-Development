	<script>
      $(function () {
         $('#group').DataTable();
      });
    </script>
	
	<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
		<section class="content-header">
			 <h1>
                <a href="<?php echo base_url();?>customer/all" class="btn btn-info"><i class='fa fa-chevron-circle-left'></i> Kembali ke Pelanggan</a>
				<a href="<?php echo base_url();?>customer/group_create" class="btn btn-warning"><i class='fa fa-plus-square'></i> Tambah Group</a>
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
					if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
                  <table id="group" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
						<th>No.</th>
						<th>Nama Group</th>
						<th>Harga Jual</th>
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
						<td><?php echo $row->customer_group_name;?></td>
						<td><?php
						if($row->customer_group_selling_price == 'selling_price')
						{
							echo 'Harga Jual';
						}
						elseif($row->customer_group_selling_price == 'purchase_price')
						{
							echo 'Harga Modal';
						}
						?></td>
						<td><?php echo $row->customer_group_discount;?>%</td>
						<td><?php
							$group_id = $this->session->userdata('group_id');
							if ($group_id == 1 OR $group_id == 2 OR $group_id == 4 OR $group_id == 5)
							{
								echo anchor('customer/group_edit/' . $row->customer_group_id,'<i class="fa fa-edit"></i> Edit', ['class'=>'btn btn-xs btn-warning']);
							}
							//elseif($group_id == 1)
							//echo anchor('customers/delete/' . $customer->user_id,'Delete', ['class'=>'btn btn-danger', 'onclick'=>'return confirm(\'Apakah Anda Yakin?\')']);
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