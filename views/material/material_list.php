<?php
$group_id	= $this->session->userdata('group_id')
?>
		<section id="mt1">

	<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

		<!-- Content Header (Page header) -->
		<section class="content-header">
			<?php if($group_id == '8' or $group_id == '1' or $group_id == '14' or $group_id == '16' OR $group_id == '4' OR $group_id == '18')
			{?>
			<a href="<?php echo base_url();?>material/create" class="btn btn-warning">Tambah Material</a>
			<?php }?>
			<?php if($group_id == '1' or $group_id == '8' or $group_id == '14' or $group_id == '16' OR $group_id == '4' OR $group_id == '18')
			{?>
				&nbsp;<a href="<?=base_url()?>material/units" class="btn btn-primary">Satuan</a>
			<?php }?>
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
                    <form method="post" action="<?=base_url()?>material/stock_opname">
                    <?
					$group_id = $this->session->userdata('group_id');
					if($group_id=='1' or $group_id=='8' or $group_id=='9'){
                    ?>
                    <div class="row">
                    		<div class="form-group">
				  <label class="col-xs-5 col-md-2 control-label">No. Stock Opname</label>
				  <div class="col-xs-4 col-md-2">
				  <input type="text" class="form-control" name="p_no" placeholder="No. Stock Opname">
                  </div>
                  <div class="col-xs-2">
                  <input type="submit" class="btn btn-success" value="Simpan">
				  </div>

				</div>
                    </div>
                    <br>
                    <?
					}
                    ?>
                  <table id="logistic_item" class="table table-bordered table-hover table-striped">
                    <thead>
                      <tr>
                      <th class="text-center">Kode Material</th>
						<th class="text-center">Nama Material</th>
						<th class="text-center">Harga Act</th>
						<th class="text-center">Jumlah Act</th>
						<!--th class="text-center">QTY Stock</th-->
						<th class="text-center">Standar Stock</th>
						<th class="text-center">Batas Bawah Stock</th>
						<th class="text-center">Satuan CoP</th>
                        <th class="text-center">Satuan Beli</th>
                        <th class="text-center">Konversi</th>
												<? if($group_id=='1'){
													echo "<th class='text-center'>Action</th>";
												}
												?>
											</tr>

										</thead>
                    <tbody>

					<?php
                        //print_r($materialsrecord);
						foreach($materialsrecord AS $material)
						{
						?>
                      <tr>
                      <td><?php
                                echo $controller->kode_material($material->material_type,$material->material_id);
                         ?>
                      </td>
						<td><a href="<?php echo base_url();?>material/edit/<?php echo $material->material_id;?>"><?php echo $material->material_name;?></a></td>
						<td align="right"><?php echo number_format($material->material_purchase_price,0,',',',');?></td>
						<td align="right"><?php echo number_format($material->material_purchase_unit,0,',',',');?></td>
						<!--td align="right">
                        <?

						if($material->material_type=='stock' and ($group_id=='1' or $group_id=='8' or $group_id=='9')){
							?>
                            <input type="text" value="<?=$material->material_stock?>" name="txtstockedit[]">
                            <input type="hidden" value="<?=$material->material_stock?>" name="txtstock[]">
                            <input type="hidden" value="<?=$material->material_id?>" name="txtid[]">
                            <?
						}else{
							 echo number_format($material->material_stock,0,',',',');
						}
                        ?>

                        </td-->
						<td align="right"><?php echo number_format($material->material_standard_stock,0,',',',');?></td>
						<td align="right"><?php echo number_format($material->material_bottom_line_stock,0,',',',');?></td>
						<td><?php echo $material->material_unit_name;?></td>
                        <td><?php echo $material->sbeli;?></td>
                        <td align="right"><?php echo number_format($material->konversi,0,',',',');?></td>
												<? if($group_id=='1'){
													$material_id = $material->material_id;
													echo "<td class='text-center'><a class='btn btn-danger' href='".base_url()."material/delete/".$material_id."'>Hapus</a></td>";
												}
												?>
											</tr>
					<?php };?>
                    </form>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			</div><!-- /.col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		</section>
      <?$user = $this->session->userdata('username');
      if($user=="beni" || $user=="Beni"){
        echo "<script>
          document.getElementById('mt').innerHTML = '';
          document.getElementById('mt1').innerHTML = '';
        </script>
        ";
      }?>
<script>
      $(function () {
         $('#logistic_item').DataTable({
			 "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
			 "pagingType": "full_numbers",
			 "scrollX": true,
			 "dom":"Bfrtip",
			 "buttons":['excel','pdf','print']
		 });
		 $('div.dataTables_filter input').focus();
      });
    </script>