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
		<a href="<?=base_url()?>setting/table_create" class="btn btn-warning">Tambah Meja</a>&nbsp;
    <a href="<?=base_url()?>setting/table_category" class="btn btn-primary">Kategori Meja / Ruangan</a>
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
			if ($this->session->flashdata('message_success')) echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
			?>
			  <table id="table_list" class="table table-striped table-bordered table-hover">
				<thead>
				  <tr>
					<th>No.</th>
					<th>Nama Meja</th>
					<th>Status</th>
					<th></th>
				  </tr>
				</thead>
				<tbody>
				<?php
					$no = 1;
					foreach($tablelist AS $table)
					{
					?>
				  <tr>
					<td align="center"><?php echo $no++;?></td>
					<td><?php echo $table->table_name;?></td>
					<td><?php
					if ($table->table_list_status == 'unlock')
						echo '<span class=text-green>Open</span>';
					elseif($table->table_list_status == 'lock')
						echo '<span class=text-red><b>Close</b></span>';
					?></td>
					<td><?php
						$group_id = $this->session->userdata('group_id');
						if($group_id == '1' OR $group_id == '2')
						{
							echo anchor('setting/table_edit/' . $table->table_list_id,'Edit', ['class'=>'btn btn-xs btn-warning']);
						}
                        if ($group_id <= '5' AND $table->table_list_status == 'lock')
						{
                            
						  ?>
                          <a class="btn btn-xs btn-primary" href="<?=base_url()?>setting/open_status_table/<?=$table->table_list_id?>">Buka Meja</a>
                            <?php
						  }
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
