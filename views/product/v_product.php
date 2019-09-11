<select name="product_recipe_id[]" class="form-control">
								<?php
								foreach($reseps as $resep)
                                        {
                                            
                                        ?>
                                  <option value="<?php echo $resep->product_id;?>" <? if($resep->product_id==$vid){ echo "selected";} ?> ><?php echo $resep->product_name;?> => <?php echo $resep->product_selling_price;?></option>
                                        <?php }?>
								</select>