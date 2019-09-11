	<?
	if($this->session->userdata('idkasir')!='' and $this->session->userdata('statustransaksi')!=''){
    ?>
	<script>
      $(function () {
         $('#users').DataTable(
		 {
			  "dom":"Bfrtip",
		 		"buttons":['excel','pdf','print']
			 }
		 );
      });
    </script>
    <?
	}
    ?>

<style>
.table-condensed{
  font-size: 16px;
}
.table-condensed2{
  font-size: 18px;
}
</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Main content -->
	<section class="content">
	
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-warning">
			<div class="box-body">
			<?php
			$total=0;
				if ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
				elseif ($this->session->flashdata('message_sucess')) echo '<div class="alert alert-success">'.$this->session->flashdata('message_sucess').'</div>';?>
			<?php
			echo '<span class=text-red>'.validation_errors().'</span>';
			if($this->session->userdata('idkasir')=='' and $this->session->userdata('statustransaksi')==''){
			echo form_open('cashier/transaksi_cart');?>
				
				<div class="box-body table-condensed">
					<div class="col-xs-6">
						<label>Material</label>
							<select name="po_material_id" id="po_material_id" class="form-control select2" autofocus onchange='CheckColors();'>
							<?php
							//$materials	= $this->material_model->get_materials();
							foreach($dbarang as $material)
							{
							?>
								<option value="<?php echo $material->id_barang."#".$material->nama_barang."#".$material->harga_barang;?>"><?php echo $material->nama_barang;?> => <?php echo number_format($material->harga_barang,0,',','.');?> </option>
							<?php }?>
							</select>
                            <script type="text/javascript">
							function CheckColors(){
								 var v=$("#po_material_id").val();
								 var vv=v.split("#");
								 $("#po_material_price").val(vv[2]);
							}
							</script>
					</div>
					<div class="col-xs-2">
					  <label>QTY</label>
						<input type="number" class="form-control" name="po_material_qty" placeholder="QTY"style="text-align:right" value="1"  >
					</div>
					<div class="col-xs-2">
					  <label>Harga</label>
						<input type="number" class="form-control" id="po_material_price" name="po_material_price" placeholder="Harga" style="text-align:right" >
					</div>
					<div class="col-xs-2">
						<label>&nbsp;</label><br>
						<button type="submit" class="btn btn-primary">Tambah</button>
					</div>
				</div>
				<?php
				
				 echo form_close();
				}
				 ?>
                 
				<div class="box-body">
				  <table id="users" class="table table-striped table-bordered table-hover table-condensed2">
					<thead>
						<tr>
							<th class="text-center">Nama Material</th>
							<th class="text-center">QTY</th>
							<th class="text-center">Harga</th>
							<th class="text-center"></th>
						</tr>
					</thead>
					<tbody>
					<?php
					$total=0;
					foreach($this->cart->contents() AS $items)
					{
						
						// $subtotal		= $items['qty'] * $items['price'];
						$total			+= $items['price'];
						?>
					  <tr>
						<td><?php echo $items['name'];?></td>
						<td align="center"><?php echo number_format($items['qty'],0,',','.');?></td>
						<td align="right"><?php echo number_format($items['price'],0,',','.');?></td>
						<td align="center">
                        <?
						if($this->session->userdata('idkasir')!='' and $this->session->userdata('statustransaksi')!=''){
						}else{
					
                        ?>
                        <a href="<?php echo base_url();?>cashier/transaksi_cart_remove/<?php echo $items['rowid'];?>" class="glyphicon glyphicon-remove"></a>
                        <?
						}
                        ?>
                        </td>
					  </tr>
					<?php } ?>
						<tr>
							<td colspan="2" align="right"><b>Total :</b></td>
							<td align="right"><b><?php echo number_format($total,0,',','.');?></b></td>
							<td></td>
						</tr>
					</tbody>
				  </table>
				</div>
			  </div><!-- /.box-body -->
			  <?php
			
				echo form_open('cashier/transaksi_save','class=form-horizontal');
				?>
			  <div class="box-footer">
              <input type="hidden" name="totalpo" value="<?php echo $total;?>">
              <?
			  if($this->session->userdata('idkasir')=='' and $this->session->userdata('statustransaksi')==''){
			   ?>
			   
                <a href="<?php echo base_url().'cashier/transaksi_baru';?>" class="btn btn-danger">Batal</a>
                <button type="submit" class="btn btn-lg btn-success pull-right">Simpan </button>
                <?
			  	}else{
					?>
                     
				<a href="<?php echo base_url().'cashier/transaksi_baru';?>" class="btn btn-danger">Transaksi Baru</a> &nbsp; <!--<a href="<?php echo base_url().'purchase';?>" class="btn btn-success">Cetak Struk</a>-->
				
                    <?
			  	}
                ?>
			  </div><!-- /.box-footer -->
			<?php echo form_close();?>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->