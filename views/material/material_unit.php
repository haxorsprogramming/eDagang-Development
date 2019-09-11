	<script>
      $(function () {
         $('#logistic_unit').DataTable({
			 "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			 "order": [[ 0, "asc" ]],
			 "pagingType": "full_numbers",
			 "scrollX": true
		 });
      });
    </script>
	
	<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
		
		<!-- Content Header (Page header) -->
		<section class="content-header">
            <a href="<?=base_url()?>material" class="btn btn-info">Kembali ke Material</a>&nbsp;
			<a href="<?=base_url()?>material/unit_create" class="btn btn-warning">Tambah Satuan</a>
		</section>
        
        <!-- Main content -->
        <section class="content">
		  
          <div class="row">
			<div class="col-xs-12">
              <div class="box box-solid box-success">
                <div class="box-body">
				<?php
					if($this->session->flashdata('message'))
					{
						echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';
					}
					elseif($this->session->flashdata('success'))
					{
						echo '<div class="alert alert-success">'.$this->session->flashdata('success').'</div>';
					}
					?>
                  <table id="logistic_unit" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
					    <th>No.</th>
						<th>Tanggal Dibuat</th>
						<th>Oleh</th>
						<th>Nama Satuan</th>
						<th>Singkatan Satuan</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
						$no = 1;
						foreach($unitsrecord AS $unit)
						{
						?>
                      <tr>
					    <td><?php echo $no++;?></td>
						<td><?php echo date('d-m-Y H:i:s',strtotime($unit->created_time));?></td>
                        <td><?php echo $unit->full_name;?></td>
						<td><?php echo $unit->material_unit_name;?></td>
						<td><?php echo $unit->material_unit_code_name;?></td>
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