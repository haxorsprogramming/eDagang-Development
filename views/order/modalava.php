 <?
					
					$products	= $this->product_model->get_menu_ava();
					foreach($products as $product)
					{
					?>
					<!-- Modal Item -->
					<div class="modal fade" id="prd-<?php echo $product->product_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <?php echo form_open();?>
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<!--h4 class="modal-title" id="myModalLabel">Makanan</h4-->
						  </div>
						  <div class="modal-body">
								<div class="form-group">
									<label>QTY</label>
									<?php
									if($product->material_stock == '0')
									{
										echo "<strong><span class=text-red>Out of Stock</span></strong>";
									}
									else
									{
									?>
									<select id="qty-<?php echo $product->product_id;?>" name="qty" class="form-control">
									<?php
										$stock = 0;
										for ($q=1;$q<=50;$q++)
										{
										?>
										<option value="<?php echo $q;?>"><?php echo $q;?></option>
										<?php } ?>
									</select>
                                    <div class="form-group">
									<label>Catatan</label>
									<input type="text" id="remark-<?php echo $product->product_id;?>" class="form-control">
									<input type="hidden" id="product_id-<?php echo $product->product_id;?>" value="<?php echo $product->product_id;?>">
									<input type="hidden" name="session_form" value="menu">
								</div>
									<?php } ?>
                                    
								</div>
								
						  </div>
						  <div class="modal-footer">
                          <?
						  if($product->material_stock == '0')
									{
									}else{
                          ?>
							<button type="button" onclick="addTocart(<?php echo $product->product_id;?>)" class="btn btn-success" data-dismiss="modal">Simpan</button>
                            <?
									}
                            ?>
						  </div>
						  <?php echo form_close();?>
						</div>
					  </div>
					</div>
					<?php }?>