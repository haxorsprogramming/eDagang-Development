	<?
	$group_id = $this->session->userdata('group_id');
    ?>
	<script>
      $(function () {
         $('#logistics').DataTable({
			 "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			 "order": [[ 1, "desc" ]],
			 "pagingType": "full_numbers",
			 "dom":"Bfrtip",
			 "buttons":['excel','pdf','print']
		 });
		 $('div.dataTables_filter input').focus();
		  //Date range picker
        $('#start_date').datepicker({
							format: 'dd-mm-yyyy',
							todayBtn: true,
							todayHighlight: true,
							autoclose: true
						});
		$('#end_date').datepicker({
							format: 'dd-mm-yyyy',
							todayBtn: true,
							todayHighlight: true,
							autoclose: true
						});
      });
    </script>
	
	<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
		<!-- Content Header (Page header) -->
		<section class="content-header" style="text-align:right">
			<!--<a href="<?=base_url()?>logistic/create" class="btn btn-success">Tambah Logistik</a>&nbsp;-->
            <?
			//echo "ssss".$group_id;
			if($group_id=='10' or $group_id=='11'){
				echo "asesem";
			}else{
            ?>
			<a href="<?=base_url()?>logistic/logistic_out" class="btn btn-warning">Pengeluaran Logistik</a>&nbsp;
            <?
			}
            ?>
		</section>
		
        <!-- Main content -->
        <section class="content">  
          <div class="row">
			<div class="col-xs-12">
              <div class="box box-solid box-warning">
				<div class="box-body">
				  <div class="row">
					<?php echo form_open('logistic/search');?>
                    <div class="col-xs-3">
						<div class="input-group">
						 <span class="input-group-addon">Material</span>
                         <select class="form-control select2" name="material_id">
                            <option value="">-Semua-</option>
						 <?
                         foreach($dm AS $ddm)
						{?>
                         <option value="<?=$ddm->material_id?>" <? if($material_id==$ddm->material_id){ echo "selected";} ?>><?=$ddm->material_name?></option>
                        <?
						  }
                         ?>
                         </select>
						</div><!-- /.input group -->
					</div>
                    <div class="col-xs-2">
						<div class="input-group">
						 <span class="input-group-addon">Status</span>
						  <select class="form-control" name="v_status">
                            <option value="">-Semua-</option>
                            <option value="in" <? if($v_status=='in'){ echo "selected";} ?> >in</option>
                            <option value="out" <? if($v_status=='out'){ echo "selected";} ?>>out</option>
                          </select>
						</div><!-- /.input group -->
					</div>
					<div class="col-xs-3">
						<div class="input-group">
						 <span class="input-group-addon">Dari :</span>
						  <input type="text" class="form-control" id="start_date" name="start_date" value="<?php echo $start_date;?>">
						</div><!-- /.input group -->
					</div>
					<div class="col-xs-3">
						<div class="input-group">
						   <span class="input-group-addon">Sampai :</span>
						   <input type="text" class="form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>">
						</div>
					</div><!-- /.input group -->
					<div class="col-xs-1">
						<div class="input-group">
						   <button class="btn btn-block btn-primary">Cari</button>
						</div>
					</div><!-- /.input group -->
					<?php echo form_close();?>
				  </div>
				</div>
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
                  <table id="logistics" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
						<th class="text-center">No.</th>
						<th class="text-center">Tanggal</th>
						<th class="text-center">Oleh</th>
						<th class="text-center">Material</th>
						<!--<th class="text-center">Keterangan</th>-->
						<th class="text-center">Jumlah</th>
						<th class="text-center">Satuan</th>
						<th class="text-center">Status</th>
						<th class="text-center">Lokasi</th>
                        <th class="text-center"></th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
						$no=1;
						
						//print_r($logisticsrecord);
						foreach($logisticsrecord AS $logistic)
						{
							if($group_id==10){
								if($logistic->logistic_location_id==1){
						?>
                      <tr id="tr<?=$logistic->logistic_id?>">
						<td><?php echo $no++;?></td>
						<td><?php echo date('d-m-Y H:i:s',strtotime($logistic->created_time));?></td>
                        <td><?php echo $logistic->full_name;?></td>
						<td><?php echo $logistic->logistic_item_name;?></td>
						<!--<td><?php echo $logistic->logistic_description;?></td>-->
						<td><?php echo $logistic->logistic_stock;?></td>
						<td><?php echo $logistic->logistic_unit_name;?></td>
						<td><?php echo $logistic->status;?></td>
						<td><?php echo $logistic->logistic_location_name;?></td>
                        <td>
                           <? if(($group_id=="1" or $group_id=="2") and $logistic->status=='in' ){ ?>
                            <a href="#" class="btn btn-xs btn-warning" onclick="delete_logistic(<?=$logistic->logistic_id?>,<?php echo $logistic->logistic_stock;?>)">Hapus</a>
                            <?
                            }
                            ?>
                        </td>
                      </tr>
					<?php 
									}
							}else if($group_id==11){
								if($logistic->logistic_location_id==2){
								?>
                     <tr id="tr<?=$logistic->logistic_id?>">
						<td><?php echo $no++;?></td>
						<td><?php echo date('d-m-Y H:i:s',strtotime($logistic->created_time));?></td>
                        <td><?php echo $logistic->full_name;?></td>
						<td><?php echo $logistic->logistic_item_name;?></td>
						<!--<td><?php echo $logistic->logistic_description;?></td>-->
						<td><?php echo $logistic->logistic_stock;?></td>
						<td><?php echo $logistic->logistic_unit_name;?></td>
						<td><?php echo $logistic->status;?></td>
						<td><?php echo $logistic->logistic_location_name;?></td>
                        <td> <? if(($group_id=="1" or $group_id=="2") and $logistic->status=='in' ){ ?>
                            <a href="#" class="btn btn-xs btn-warning" onclick="delete_logistic(<?=$logistic->logistic_id?>,<?php echo $logistic->logistic_stock;?>)">Hapus</a>
                            <?
                            }
                            ?></td>
                      </tr>
                                <?
								}
							}else{
								?>
                       <tr id="tr<?=$logistic->logistic_id?>">
						<td><?php echo $no++;?></td>
						<td><?php echo date('d-m-Y H:i:s',strtotime($logistic->created_time));?></td>
                        <td><?php echo $logistic->full_name;?></td>
						<td><?php echo $logistic->logistic_item_name;?></td>
						<!--<td><?php echo $logistic->logistic_description;?></td>-->
						<td><?php echo $logistic->logistic_stock;?></td>
						<td><?php echo $logistic->logistic_unit_name;?></td>
						<td><?php echo $logistic->status;?></td>
						<td><?php echo $logistic->logistic_location_name;?></td>
                        <td> <? if(($group_id=="1" or $group_id=="2") and $logistic->status=='in' ){ ?>
                            <a href="#" class="btn btn-xs btn-warning" onclick="delete_logistic(<?=$logistic->logistic_id?>,<?php echo $logistic->logistic_stock;?>)">Hapus</a>
                            <?
                            }
                            ?></td>
                      </tr>
                                <?
							}
						}
					?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			</div><!-- /.col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <script>
      function delete_logistic(id,nilai){
						var r = confirm("Apakah anda yakin?");
												if (r == true) {
												
														var v_id=id;
                                                        var v_jene="H";
                                                        var v_nilai=nilai;
                                                         
														
														$.ajax({
															type: "POST",
															url: "<?php echo base_url()?>logistic/edit_logistic",
															data: "v_id="+v_id+"&v_jene="+v_jene+"&v_nilai="+v_nilai,
															
															success: function(msg){
																$('#tr'+id).hide();
																	alert(msg);
																	//window.location='<?=base_url()?>Cdis/dis';
																
															}
														});
												}
												return false;
					}
      </script>