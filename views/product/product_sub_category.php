<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<?php $group_id = $this->session->userdata('group_id');
		if($group_id == '1' OR $group_id == '2'  OR $group_id == '3' OR $group_id == '14' OR $group_id == '16')
		{ echo anchor('product/create_sub_category','Tambah Sub Kategori', ['class'=>'btn btn-warning']) . '&nbsp;';}?>
		<a href="<?=base_url()?>product" class="btn btn-primary">Produk</a>&nbsp;
		<a href="<?=base_url()?>product/recipe" class="btn btn-primary">Cost of Product</a>
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
			  <table id="sub_category" class="table table-striped table-bordered table-hover">
				<thead>
				  <tr>
				    <th class="text-center">Kategori</th> 
					<th class="text-center">Sub Kategori</th>
				  </tr>
				</thead>
				<tbody>
				<?php
					foreach($screcord AS $sc)
					{
						$catergorys		= $this->product_model->get_product_category_by_category_id($sc->parent_category_id);
						foreach($catergorys AS $category)
						{
							$category_name	= $category->product_category_name;
						}
					?>
				  <tr>
				    <td><?php echo $category_name;?></td>
					<td><?php echo anchor('product/edit_sub_category/' . $sc->category_id,$sc->product_category_name);?></td>
				  </tr>
				  <?php };?>
				</tbody>
				<tfoot>
				  <tr>
				    <th class="text-center">Kategori</th> 
					<th class="text-center">Sub Kategori</th>
				  </tr>
				</tfoot>
			  </table>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->
<script>
  $(function () {
	 $('#sub_category').DataTable({
		 "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		 "pagingType": "full_numbers",
		 "scrollX": true,
		 "order": [[ 0, 'asc' ], [ 1, 'asc' ]],
		 "dom":"Bfrtip",
		 "buttons":['excel','pdf','print']
	 });
	 $('div.dataTables_filter input').focus();
  });
</script>