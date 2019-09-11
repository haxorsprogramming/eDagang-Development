<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
		
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<a href="<?php echo base_url();?>supplier/create" class="btn btn-warning">Tambah Supplier</a>
		</section>
		
        <!-- Main content -->
        <section class="content">
		  
          <div class="row">
			<div class="col-xs-12">
              <div class="box box-solid box-success">
                <div class="box-body">
				<?php
					if($this->session->flashdata('message_success'))
					{
						echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
					}
					elseif($this->session->flashdata('message_error'))
					{
						echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
					}
					?>
                  <table id="supplier" class="table table-bordered table-hover table-striped">
                    <thead>
						<tr>
							<th class="text-center">Nama Supplier</th>
							<th class="text-center">No. HP</th>
							<th class="text-center">Telp.</th>
							<th class="text-center">Email</th>
							<th class="text-center">Alamat</th>
							<th class="text-center">Nama PIC</th>
						</tr>
                    </thead>
					<tfoot>
						<tr>
							<th class="text-center">Nama Supplier</th>
							<th class="text-center">No. HP</th>
							<th class="text-center">Telp.</th>
							<th class="text-center">Email</th>
							<th class="text-center">Alamat</th>
							<th class="text-center">Nama PIC</th>
						</tr>
                    </tfoot>
                    <tbody>
					<?php
						foreach($suppliersrecord AS $supplier)
						{
						?>
                      <tr>
						<td><a href="<?php echo base_url();?>supplier/edit/<?php echo $supplier->supplier_id;?>"><?php echo $supplier->supplier_full_name;?></a></td>
						<td><?php echo $supplier->supplier_hp;?></td>
						<td><?php echo $supplier->supplier_telp;?></td>
						<td><?php echo $supplier->supplier_email;?></td>
						<td><?php echo $supplier->supplier_address;?></td>
						<td><?php echo $supplier->supplier_personal_contact_name;?></td>
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
<script>
      $(function () {
         $('#supplier').DataTable({
			 "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
			 "pagingType": "full_numbers",
			 "scrollX": true,
			 "dom":"Bfrtip",
			 "buttons":['excel','pdf','print']
		 });
		 $('div.dataTables_filter input').focus();
    });
</script>