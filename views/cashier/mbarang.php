	<script>
      $(function () {
         $('#users').DataTable();
      });
    </script>
    

	
	<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
		
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<a href="<?php echo base_url();?>cashier/tambah_mbarang" class="btn btn-success">Tambah <?=$title?></a>
		</section>
		
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            
			<div class="col-xs-12">
              <div class="box box-solid box-warning">
                <div class="box-body">
				<?php
					if ($this->session->flashdata('message_error'))
						echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
					elseif ($this->session->flashdata('message_success'))
						echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
				?>
				<div>
				</div>
                  <table id="users" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
						<th class="text-center">No.</th>
						<th class="text-center">Kode Barang</th>
						<th class="text-center">Nama Barang</th>
                        <th class="text-center">Stok</th>
						<th class="text-center">Harga</th>
						<th class="text-center"></th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
						$no = 0;
						foreach($usersrecord AS $user)
						{
						$no++;
						?>
                      <tr>
						<td><?php echo $no ;?></td>
                        <td><a href="#" data-toggle="modal" data-target="#modalviewdetail<?=$no?>"><?php echo $user->kode_barang ;?></a></td>
						<td><?php echo $user->nama_barang;?></td>
                        <td align="right"><?php echo $user->stok;?></td>
						<td align="right"><?php echo number_format($user->harga_barang,0,',','.');?></td>
						<td>
                                          <a href="<?=base_url()?>cashier/edit_mbarang/<?=$user->id_barang?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                       
                                       <a href="<?=base_url()?>cashier/hapus_mbarang/<?=$user->id_barang?>">
                                          <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </a>
                                        <a href="#" data-toggle="modal" data-target="#modaladdbarang<?=$no?>">
                                          + Stok
                                        </a>
                                        
                                                         
                      </tr>
                      
                                           <!----------------------------------------------- Modal content-->
           <div id="modalviewdetail<?=$no?>" class="modal fade" role="dialog" >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Detail Barang </h4>
              </div>
              <div class="modal-body">
                      <div class="row">
                        <div class="col-md-12 col-xs-12"  >
                        <div class="col-xs-4" style="text-align:center">
                        <strong>Nama barang</strong>
                        </div>
                        <div class="col-xs-4" style="text-align:center">
                        <strong>Qty</strong>
                        </div>
                        <div class="col-xs-4" style="text-align:center">
                        <strong>Harga</strong>
                        </div>
                        <hr>
                             <?
							 $total=0;
							 $db		 = $this->cashier_model->select_zselectbarangdetailid($user->id_barang);
							 foreach($db AS $bd)
							 {
									?>
                                    <div class="col-xs-4" >
                                    <?=$bd->nama_bd?>
                                    </div>
                                    <div class="col-xs-4" style="text-align:right">
                                    <?=$bd->qty_bd?>
                                    </div>
                                    <div class="col-xs-4" style="text-align:right">
                                    <strong><?=number_format($bd->harga_bd,0,',','.')?></strong>
                                     <hr>
                                    </div>
                                   
                                    <?
									$total=$total+$bd->harga_bd;
							 }
                             ?>
                           
                        <div class="col-xs-8" style="text-align:center">
                        <strong>TOTAL</strong>
                        </div>
                        <div class="col-xs-4" style="text-align:right">
                         <strong><?=number_format($total,0,',','.')?></strong>
                        </div>

                       </div>
              </div>
             
            </div>
        
          </div>
          </div>
           
          </div>
                      
                      
                      
                      
                        <!----------------------------------------------- Modal content-->
           <div id="modaladdbarang<?=$no?>" class="modal fade" role="dialog" >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Stok <?php echo $user->nama_barang;?></h4>
              </div>
              <div class="modal-body">
                      <div class="row">
                        <div class="col-md-12 col-xs-12"  >
                             <form role="form">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Stok</label>
                                        <input type="number" class="form-control" id="v_stok<?=$no?>" maxlength="50" value="0" >
                                      </div>
										<button type="button" id='btn_simpanstok<?=$no?>' class="btn btn-primary" >Simpan</button>
                                    </form>

                       </div>
              </div>
             
            </div>
        
          </div>
          </div>
           
          </div>
            <script>

				
				$('#btn_simpanstok<?=$no?>').click(function(){
					
					
					
							var v_stok=$('#v_stok<?=$no?>').val();
							var id_barang='<?=$user->id_barang?>';
							$.ajax({
								type: "POST",
								url: "<?php echo base_url()?>cashier/tambah_stok",
								data: "v_stok="+v_stok+"&id_barang="+id_barang,
								
								success: function(msg){
									//alert(msg);
									//if(msg=='SUKSES'){
										//alert('DATA BERHASIL DISIMPAN');
										window.location='<?=base_url()?>cashier/mbarang';
									//}else{
									//	alert(msg);
									//}
								}
							});
					return false;
				});
				</script>
            <!----------------------------------------------- end Modal content-->
</td>
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