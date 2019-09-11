<script>
  $(function () {
	 $('#table_list').DataTable({
		 "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		 "pagingType": "full_numbers"
	 });
  });
</script>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Content Header (Page header) -->
	<section class="content-header">
    <?
    $group_id = $this->session->userdata('group_id');
						if($group_id == '1' OR $group_id == '2' OR $group_id == '3')
						{?>
		<a href="<?=base_url()?>setting/table" class="btn btn-info">Kembali ke Manajemen Meja</a>
    <a href="<?=base_url()?>setting/table_category/create" class="btn btn-warning">Tambah Kategori Meja</a>
        <?
        }
        ?>
	</section>

	<!-- Main content -->
	<section class="content">

	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-success">
			<div class="box-body">
			<?php
      echo $this->session->flashdata('notif');
			?>
			  <table id="table_list" class="table table-striped table-bordered table-hover">
				<thead>
				  <tr>
					<th>No.</th>
					<th>Nama Kategori Meja / Ruangan</th>
          <?php if($group_id=='1'){ ?>
          <th>Aksi</th>
          <?php } ?>
          <th>status</th>
          </tr>
				</thead>
				<tbody>
				<?php
					$no = 1;
					foreach($tablecatlist AS $table)
					{
					?>
				  <tr>
					<td align="center"><?php echo $no++;?></td>
					<td><?php echo $table->table_category_name;?></td>
          <td><a href="<?php echo base_url()?>setting/table_category/edit/<?php echo $table->table_category_id?>" class="btn btn-warning btn-xs">Edit</a></td>
          <td>
            <?php if($table->table_cat_status=='1'){
              echo "Aktif";
            }else{
              echo "Tidak Aktif";
            } ?>
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
