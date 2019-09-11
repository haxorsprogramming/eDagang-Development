<?php
				if($this->session->userdata('reservation')){
					$tables	= $this->order_model->get_table_category_name($this->session->userdata('table_id'));
					foreach($tables AS $table)
					{
					$table_name	= $table->table_category_name;
					}
				}else{
			  	$tables	= $this->order_model->get_table_by_table_id($this->session->userdata('table_id'));
					foreach($tables AS $table)
					{
					$table_name	= $table->table_name;
					}
				}
			  ?>
			</div><!-- /.box-header -->
			<div class="box-body">
			<!-- form start -->
				<?php if($this->session->userdata('reservation')){?>
					<?php if($this->session->userdata('status_reservasi')=='edit'){ ?>
						<h5>(Kode Trx : <?php echo $this->session->userdata('transaction_code');?>)</h5>
						<h5>(Status Reservasi : Tambah Pesanan)</h5>
					<?php }else{ ?>
					<h5>(Pemesan : <?php echo $this->session->userdata('nama');?>)</h5>
					<h5>(Jenis Penyajian : <?php echo $this->session->userdata('penyajian');?>)</h5>
					<h5>(Request Layout : <?php echo $this->session->userdata('layout');?>)</h5>
					<h5>(Room : <?php echo $table_name;?>)</h5>
				<?php } ?>
				<?php }else{ ?>
            <h3>(Meja : <?php echo $table_name;?>)</h3>
						<?php if($this->session->userdata('order_status')=='in_door'||$this->session->userdata('order_status')=='out_door'){ ?>
						<?php if($this->session->userdata('order_status')=='in_door'){$order_status='In Door';} ?>
						<?php if($this->session->userdata('order_status')=='out_door'){$order_status='Out Door';} ?>
						<h3>(Status Order : <?php echo $order_status;?>)</h3>
						<?php } ?>
				<?php } ?>
			<?php
				if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
			  <table class="table table-bordered table-striped">
				<thead>
				  <tr>
					<th class="text-center">Menu</th>
					<th class="text-center">QTY</th>
					<!--<th class="text-center">@Harga</th>
					<th class="text-center">Remark</th>-->
					<th></th>
				  </tr>
				</thead>
				<tbody>
				<?php
				//print_r($this->cart->contents());
					foreach($this->cart->contents() AS $items) :
					?>
				  <tr>
					<td><?php echo $items['name'];?></td>
					<td align="center"><?php echo $items['qty'];?></td>
					<!--<td align="center">
					<?php
					$products	= $this->product_model->get_product_by_product_id($items['id']);
					foreach($products AS $product)
					{
						echo number_format($product->product_selling_price,0,',','.');
					}
					?></td>
					<td><?php
					$options	= $items['options'];
					//$remark		= element('remark',$options);
					$remark		= $items['options']['remark'];
					echo $remark;?></td>-->
					<td align="center"><a  onclick="removeTocart('<?php echo $items['rowid'];?>')"  class="glyphicon glyphicon-remove"></a></td>
				  </tr>


				  <?php endforeach; ?>
				</tbody>
			  </table>
<?php if($this->session->userdata('reservation')){?>
<?php if($this->session->userdata('reqphoto')){?>
				<br/>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Jenis Photo</th><th>Harga</th><th></th>
						</tr>
					</thead>
					<tbody>
						<?php $t=$this->session->userdata('j');$totalpo=0;?>
						<?php $a=0;for($i=1;$i<=$t;$i++){ ?>
						<?php if($this->session->userdata('rpr'.$i)&&$this->session->userdata('rpp'.$i)){ ?>
						<tr>
							<td><?php $a++; echo $this->session->userdata('rpr'.$i)?></td><td><?php $rpp=$this->session->userdata('rpp'.$i); echo number_format($rpp,0,',','.') ?></td>
							<input type="text" name="detail_photo[<?php echo $i ?>]" value="<?php echo $this->session->userdata('rpr'.$i)?>" class="hidden" >
							<input type="text" name="detail_photo_price[<?php echo $i ?>]" value="<?php echo $this->session->userdata('rpp'.$i)?>" class="hidden" >
							<td align="center"><a  onclick="removePhoto('<?php echo $i?>')"  class="glyphicon glyphicon-remove"></a></td>
						</tr>
						<?php $totalpo+=$rpp; ?>
					<?php }else{} ?>
					<?php } ?>
					</tbody>
					<?php if($totalpo!=0){ ?>
						<tfoot>
							<tr>
								<td colspan="2">Jumlah request</td><td><?php echo $a;?></td>
								<input type="text" name="totalpo" value="<?php echo $t;?>" class="hidden">
						</tr>
						<tr>
							<td colspan="2">Total</td><td><?php echo number_format($totalpo,0,',','.');?></td>
						</tr>
					</tfoot>
				<?php }else{} ?>
				</table>
<?php } ?>
<?php if($this->session->userdata('reqmusic')){?>
				<br/>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Jenis Music</th><th>Harga</th><th></th>
						</tr>
					</thead>
					<tbody>
						<?php $totalm=0; if($this->session->userdata('rmr')&&$this->session->userdata('rmp')){ ?>
						<tr>
							<td><?php echo $this->session->userdata('rmr');?></td><td><?php $rmp=$this->session->userdata('rmp'); echo number_format($rmp,0,',','.');?></td>
							<input type="text" name="detail_music" value="<?php echo $this->session->userdata('rmr')?>" class="hidden" >
							<input type="text" name="detail_harga_music" value="<?php echo $this->session->userdata('rmp')?>" class="hidden" >
							<td align="center"><a  onclick="removeMusic('<?php echo 1?>')"  class="glyphicon glyphicon-remove"></a></td>
						</tr>
						<?php $totalm+=$rmp ?>
					<?php } ?>
					</tbody>
					<?php if($totalm!=0){ ?>
					<tfoot>
						<tr>
							<td colspan="2">Total</td><td><?php echo number_format($totalm,0,',','.'); ?></td>
						</tr>
					</tfoot>
				<?php }else {} ?>
				</table>
<?php } ?>
<?php if($this->session->userdata('reqdekor')){?>
				<br/>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Jenis Dekor</th><th>Harga</th><th></th>
						</tr>
					</thead>
					<tbody>
						<?php $de=$this->session->userdata('de');$totalde=0;?>
						<?php $b=0; for($dek=1;$dek<=$de;$dek++){ ?>
						<?php if($this->session->userdata('rdr'.$dek)&&$this->session->userdata('rdp'.$dek)){ ?>
						<tr>
							<td><?php $b++; echo $this->session->userdata('rdr'.$dek)?></td><td><?php $rdp=$this->session->userdata('rdp'.$dek); echo number_format($rdp,0,',','.') ?></td>
							<input type="text" name="detail_dekor[<?php echo $dek ?>]" value="<?php echo $this->session->userdata('rdr'.$dek)?>" class="hidden" >
							<input type="text" name="detail_harga_dekor[<?php echo $dek ?>]" value="<?php echo $this->session->userdata('rdp'.$dek)?>" class="hidden" >
							<td align="center"><a  onclick="removeDekor('<?php echo $dek?>')"  class="glyphicon glyphicon-remove"></a></td>
						</tr>
						<?php $totalde+=$rdp; ?>
					<?php }else{} ?>
					<?php } ?>
					</tbody>
					<?php if($totalde!=0){ ?>
					<tfoot>
						<tfoot>
							<tr>
								<td colspan="2">Jumlah request</td><td><?php echo $b;?></td>
								<input type="text" name="totalde" value="<?php echo $de;?>" class="hidden" >
						</tr>
						<tr>
							<td colspan="2">Total</td><td><?php echo number_format($totalde,0,',','.');?></td>
						</tr>
					</tfoot>
				<?php }else{} ?>
				</table>
<?php } ?>
<?php if($this->session->userdata('reqbeauty')){?>
				<br/>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Jenis Beauty</th><th>Harga</th><th></th>
						</tr>
					</thead>
					<tbody>
						<?php $bu=$this->session->userdata('d');$totalbu=0;?>
						<?php $c=0; for($be=1;$be<=$bu;$be++){ ?>
						<?php if($this->session->userdata('rbr'.$be)&&$this->session->userdata('rbp'.$be)){ ?>
						<tr>
							<td><?php $c++; echo $this->session->userdata('rbr'.$be)?></td><td><?php $rbp=$this->session->userdata('rbp'.$be); echo number_format($rbp,0,',','.') ?></td>
							<input type="text" name="detail_beauty[<?php echo $be ?>]" value="<?php echo $this->session->userdata('rbr'.$be)?>" class="hidden" >
							<input type="text" name="detail_harga_beauty[<?php echo $be ?>]" value="<?php echo $this->session->userdata('rbp'.$be)?>" class="hidden" >
							<?php $totalbu+=$rbp; ?>
							<td align="center"><a  onclick="removeBeauty('<?php echo $be?>')"  class="glyphicon glyphicon-remove"></a></td>
						</tr>
					<?php }else{} ?>
					<?php } ?>
					</tbody>
					<?php if($totalbu!=0){ ?>
					<tfoot>
						<tfoot>
							<tr>
								<td colspan="2">Jumlah request</td><td><?php echo $c;?></td>
								<input type="text" name="totalb" value="<?php echo $bu?>" class="hidden" >
						</tr>
						<tr>
							<td colspan="2">Total</td><td><?php echo number_format($totalbu,0,',','.');?></td>
						</tr>
					</tfoot>
				<?php }else{} ?>
				</table>
<?php } ?>
<?php } ?>
<?php if ($this->session->userdata('reservation')): ?>
<br/>
	<button type="submit" name="simpan" class="btn btn-success">simpan</button>
</form>
<?php endif; ?>
