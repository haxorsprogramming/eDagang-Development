<select name="product_recipe_id[]" class="form-control">
								<?php
								foreach($reseps as $resep)
                                        {
                                            
                                        ?>
                                            <option value="<?php echo $resep->product_recipe_id;?>" <? if($resep->product_recipe_id==$vid){ echo "selected";} ?>><?php echo $resep->product_recipe_name;?> => <?php echo $resep->product_recipe_grand_total;?></option>
                                        <?php }?>
								</select>