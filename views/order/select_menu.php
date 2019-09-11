<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Main content -->
	<section class="content">
  <?php
  if($this->session->userdata('template_waiter') == '1')
  {?>
	<script>
        //$('select').select2({}).focus(function () { $(this).select2('focus'); });
	  $(function () {

		 $('#select_menu').DataTable({
			 "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
			 "pagingType": "full_numbers"
		 });
	  });

	  function addtocart()
	  {
		  var product_id	= $('#product_id').val();
		  var qty			= $('#qty').val();
		  var remark		= $('#remark').val();
		  $.ajax({
			 type: "POST",
			 url: "<?php echo base_url();?>order/add_to_cart",
			 data: "product_id="+product_id+"&qty="+qty+"&remark="+remark
     });//test
	  }
	</script>

		<div class="row">
			<div class="col-xs-12">
			  <div class="box box-solid box-warning">
				<div class="box-body">
					<table id="select_menu" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>Menu</th>
								<th>QTY</th>
								<th>Remark</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($menurecord AS $row) : ?>
							<tr>
								<td><?php echo $row->name;?></td>
								<?php echo form_open('order/add_to_cart');?>
								<input type="hidden" name="session_form" value="menu">
								<td><?php
										if ($row->stock < '1')
										{
											echo "<strong><span class=text-red>Out of Stock</span></strong>";
										}
										else
										{
										?>
											<select name="qty">
											<?php
											if ($row->stock > 10)
											{
												$stock = 10;
											}
											else
											{
												$stock = $row->stock;
											}
											for ($q=1;$q<=$stock;$q++)
											{
											?>
											<option value="<?php echo $q;?>"><?php echo $q;?></option>
										<?php } ?>
										</select>
										<?php
										}
										?>
								</td>
								<td>
									<input type="text" name="remark">
								</td>
								<td>
								<?php
									if ($row->stock < '1')
									{
										$disabled = "disabled";
									}
									else
									{
										$disabled = "";
									}
									?>
									<input type="hidden" name="product_id" value="<?php echo $row->product_id;?>">
									<button type="submit" class="btn btn-primary <?php echo $disabled;?>">Pesan</button>
									<?php echo form_close();?>
								</td>
							</tr>
						<?php endforeach;?>
						</tbody>
					</table>
				</div><!-- /.box-body -->
				<div class="box-footer">
					<a href="<?php echo base_url() . 'order/cancel';?>" class="btn btn-danger">Batal</a>
					<?php if($this->cart->total_items() > 0)
					{?>
					<a href="<?php echo base_url() . 'order/review';?>" class="btn btn-lg btn-primary pull-right">Lihat Pesanan</a>
					<?php }?>
				</div><!-- /.box-footer -->
				</div><!-- /.box -->
			</div><!-- /.col -->
		</div><!-- /.row -->
 <?php }
		elseif($this->session->userdata('template_waiter') == '2')
		{?>

    <div class="row">
			<div class="col-xs-12">
			  <div class="box box-solid box-warning">
				<div class="box-body">
				<a href="#" class="btn btn-warning pull-right" style="margin-left:10px;" data-toggle="modal" data-target="#carimenu">Cari Menu</a>
       <?php if($this->session->userdata('reservation')){?>
         <a href="#" class="btn btn-success pull-right" style="margin-left:10px;" data-toggle="modal" data-target="#music">Tambah Music</a>
        <a href="#" class="btn btn-info pull-right" style="margin-left:10px;" data-toggle="modal" data-target="#dekor">Tambah Dekor</a>
        <a href="#" class="btn btn-primary pull-right" style="margin-left:10px;" data-toggle="modal" data-target="#photo">Tambah Photo</a>
        <a href="#" class="btn btn-danger pull-right" style="margin-left:10px;" data-toggle="modal" data-target="#beauty">Tambah Beauty</a>

        <div id='dekoreq'>
        </div>

        <div id='musicreq'>
        </div>

        <div id='photoreq'>
        </div>

        <div id='beautyreq'>
        </div>

        <script type="text/javascript">
        $(document).ready(function(){
                $("#dekoreq").load('<?php echo base_url().'order/dekor_request'?>')
        });
        </script>

        <script type="text/javascript">
        $(document).ready(function(){
                $("#musicreq").load('<?php echo base_url().'order/music_request'?>')
        });
        </script>

        <script type="text/javascript">
        $(document).ready(function(){
                $("#photoreq").load('<?php echo base_url().'order/photo_request'?>')
        });
        </script>

        <script type="text/javascript">
        $(document).ready(function(){
                $("#beautyreq").load('<?php echo base_url().'order/beauty_request'?>')
        });
        </script>

      <?php } ?>


                <?php
					foreach($category0 as $c0)
					{
					?>
					<!-- Button trigger modal -->
					<a class="btn btn-primary menu" href="#" id="kat<?php echo $c0->category_id;?>"><?php echo $c0->product_category_name;?></a>
                    <script>
						 $('#kat<?php echo $c0->category_id;?>').click(function(e){
							$('#divsubkat').html("...............loading.........");

							$('#divsubkatkat').html("");
							$('#divsubkat').load('<?=base_url()?>order/subkat/<?php echo $c0->category_id;?>/<?php echo $c0->division;?>');
							//$('#divmodal').load('<?=base_url()?>order/modalava');
							return false;
						});
					</script>
                    <?
					}
                   $group_id = $this->session->userdata('group_id');
			         if($group_id == '12' or $group_id == '13' or $group_id == '14' or $group_id == '15'){
			             $cat3=$this->product_model->category3();
                         foreach($cat3 as $c3)
                         {
                            ?>
					<!-- Button trigger modal -->
        					<a class="btn btn-primary " href="#" id="kat<?php echo $c3->category_id;?>"><?php echo $c3->product_category_name;?></a>
                            <script>
        						 $('#kat<?php echo $c3->category_id;?>').click(function(e){
        							$('#divsubkat').html("...............loading.........");

        							$('#divsubkatkat').html("");
        							$('#divsubkat').load('<?=base_url()?>order/subkat/<?php echo $c3->category_id;?>/<?php echo $c3->division;?>');
        							//$('#divmodal').load('<?=base_url()?>order/modalava');
        							return false;
        						});
        					</script>
                        <?
                            }
			         }

                      if($group_id == '16' or $group_id == '17'){
			             $cat2=$this->product_model->category2();
                         foreach($cat2 as $c2)
                         {
                            ?>
					<!-- Button trigger modal -->
        					<a class="btn btn-primary " href="#" id="kat<?php echo $c2->category_id;?>"><?php echo $c2->product_category_name;?></a>
                            <script>
        						 $('#kat<?php echo $c2->category_id;?>').click(function(e){
        							$('#divsubkat').html("...............loading.........");

        							$('#divsubkatkat').html("");
        							$('#divsubkat').load('<?=base_url()?>order/subkat/<?php echo $c2->category_id;?>/<?php echo $c2->division;?>');
        							//$('#divmodal').load('<?=base_url()?>order/modalava');
        							return false;
        						});
        					</script>
                        <?
                            }
			         }
                    ?>
            </div>
          </div>
        </div>
      </div>


<!------------------ SUBKATEGORI -------------------->
		<div class="row">
			<div class="col-md-12 col-md-4">
			  <div class="box box-solid box-warning">
				<div class="box-body">
        <div class="row" id="divsubkat">
					<?php
					foreach($subcategoryrecord as $category)
					{
					?>
					<!-- Button trigger modal -->
            <div class="col-xs-6" style="padding-bottom:5px">
                <button id="subkat<?php echo $category->category_id;?>"   type="button" class="btn btn-primary btn-block menu" data-toggle="modal" data-target="#cat-<?php echo $category->category_id;?>"><?php echo $category->product_category_name;?></button>
						</div>
					<script>
						 $('#subkat<?php echo $category->category_id;?>').click(function(e){
							$('#divsubkatkat').html("...............loading.........");
							$('#divsubkatkat').load('<?=base_url()?>order/subkatkat/<?php echo $category->category_id;?>');
							return false;
						});
					</script>
					<?php
					}
					?>
          </div>
        </div>
      </div>
    </div>
      <!------------------ End of SUBKATEGORI -------------------->


        <!----------------- SUBKATEGORI Kategori ------------------>
            <div class="col-md-12 col-md-4">
            	  <div class="box box-solid box-warning">
				            <div class="box-body">
                	     <div class="row" id="divsubkatkat">
                       </div>
                    </div>
                </div>
            </div>
        <!------------ END OF SUBKATEGORI Kategori ------------->

<!----------------- ADD TO CART ------------------>
    <div class="col-md-12 col-md-4">
      <div class="box box-solid box-warning">
				<div class="box-body">
					<a href="<?php echo base_url() . 'order/cancel';?>" class="btn btn-danger">Batal</a> &nbsp;
          <?php if($this->session->userdata('reservation')){?>
            <form action="<?php echo base_url('order/submit') ?>" method="post">
          <?php }else{ ?>
                    <a href="<?php echo base_url() . 'order/submit';?>" class="btn btn-success" id="btsimpan" onClick="block_none()">Simpan</a>
        <script>
					function block_none(){
					 //document.getElementById('hidden-div').classList.add('show');
					document.getElementById('btsimpan').classList.add('hide');
					}
				</script>
      <?php } ?>
        <?php if($this->session->userdata('reservation')){echo "";}else{?>
					<a href="<?php echo base_url() . 'order/review';?>" class="btn btn-info pull-right">Lihat Pesanan</a>
        <?php } ?>
               		<div class="row" id="divreviewkat">
                    </div>
                </div>
                </div>
            </div>
          </div>
  <!-----------------  ADD TO CART ------------------>

		<script>
		 $('#divreviewkat').load('<?=base_url()?>order/reviewkat');
			function addTocart(str)
			{
			  var id			= str;
			  var product_id	= $('#product_id-'+str).val();
			  var qty			= $('#qty-'+str).val();
			  var remark		= $('#remark-'+str).val();
			  $('#divreviewkat').html("...............loading.........");
			  $.ajax({
				 type: "POST",
				 url: "<?php echo base_url();?>order/add_to_cart",
				 data: "product_id="+product_id+"&qty="+qty+"&remark="+remark,
				 success: function(msg){
						$('#divreviewkat').load('<?=base_url()?>order/reviewkat');
					}
			  });
			}

			function removeTocart(str)
			{
			  var rowid			= str;

			  //alert(remark);
			  $('#divreviewkat').html("...............loading.........");
			  $.ajax({
				 type: "POST",
				 url: "<?php echo base_url();?>order/remove_from_cartno",
				data: "rowid="+rowid,
				 success: function(msg){
						$('#divreviewkat').load('<?=base_url()?>order/reviewkat');

					}
			  });
			  //
			}

      function removeMusic(str)
      {
        var pid			= str;

        //alert(remark);
        $('#divreviewkat').html("...............loading.........");
        $.ajax({
         type: "POST",
         url: "<?php echo base_url();?>order/unset_music_request",
         data: "id="+pid,
         success: function(msg){
            $('#divreviewkat').load('<?=base_url()?>order/reviewkat');

          }
        });
        //
      }

      function removePhoto(str)
      {
        var pid			= str;

        //alert(remark);
        $('#divreviewkat').html("...............loading.........");
        $.ajax({
         type: "POST",
         url: "<?php echo base_url();?>order/unset_photo_request",
         data: "id="+pid,
         success: function(msg){
            $('#divreviewkat').load('<?=base_url()?>order/reviewkat');

          }
        });
        //
      }

      function removeBeauty(str)
      {
        var pid			= str;

        //alert(remark);
        $('#divreviewkat').html("...............loading.........");
        $.ajax({
         type: "POST",
         url: "<?php echo base_url();?>order/unset_beauty_request",
         data: "id="+pid,
         success: function(msg){
            $('#divreviewkat').load('<?=base_url()?>order/reviewkat');

          }
        });
        //
      }

		</script>
<?php }
?>
	</section>
</div><!-- /.content-wrapper -->



<!------------------------------------- Cari menu Modals ----------------------------->
<div id="carimenu" class="modal fade" role="dialog" >
  <div class="modal-dialog ">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Tambah </h4>
    </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12"  >
            <form role="form" enctype="multipart/form-data" >
                <div class="form-group">
                  <label for="exampleInputEmail1">Detail</label>
                     <select id="idmenut" class="form-control select2" style="width:100%"  >
                        <?
                          $prod	= $this->product_model->get_menu_ava();
                          foreach($prod as $p)
                          {
                          ?>
                            <option value="<?=$p->product_id?>"><?=$p->product_name?></option>
                          <?
                          }
                          ?>
                      </select>
                    </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Qty</label>
                     <select id="qtypop" class="form-control">
                         <?php
                            for ($q=1;$q<=50;$q++)
                             {
                          ?>
                      <option value="<?php echo $q;?>"><?php echo $q;?></option>
                          <?php } ?>
                     </select>
                   </div>
                 <div class="form-group">
                   <label for="exampleInputEmail1">Catatan</label>
                     <input type="text" id="catmenut" class="form-control">
                  </div>
                  </form>
                </div>
              </div>
            </div>
        <div class="modal-footer">
           <button type="button" id="simpanmenut" onClick="carimen()" class="btn btn-success" data-dismiss="modal">Simpan</button>
        </div>
      <script>

          //$('#carime').click(function(){
              function carimen(){
             // var id			= str;
              var product_id	= $('#idmenut').val();
             // var qty			= '1'
              var qty			=  $('#qtypop').val();
              var remark		= $('#catmenut').val();
              //alert(remark);
              $('#divreviewkat').html("...............loading.........");
              $.ajax({
               type: "POST",
               url: "<?php echo base_url();?>order/add_to_cart",
               data: "product_id="+product_id+"&qty="+qty+"&remark="+remark,
               success: function(msg){
                 if(msg=='Out of Stock'){
                   alert(msg);

                 }
                  $('#divreviewkat').load('<?=base_url()?>order/reviewkat');
                }
              });
              $('#catmenut').val("");
              $("#qtypop").prop('selectedIndex',0);
            }

                //return false;
              //});

        </script>
      </div>
    </div>
  </div>
<!------------------------------------- End Of Cari menu Modals ----------------------------->


<!----- Modals Add To chart ------------------>
<div id="divmodal">
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
            <?php if($this->session->userdata('penyajian')=='prasmanan'&&$this->session->userdata('reservation')){?>
              <select id="qty-<?php echo $product->product_id;?>" name="qty" class="form-control">
              <?php
                $stock = 0;
                ?>
                <option value="<?php echo $r=$this->session->userdata('pax');?>"><?php echo $r;?></option>
              </select>
            <?php }else{ ?>
            <select id="qty-<?php echo $product->product_id;?>" name="qty" class="form-control">
            <?php
              $stock = 0;
              for ($q=1;$q<=50;$q++)
              {
              ?>
              <option value="<?php echo $q;?>"><?php echo $q;?></option>
              <?php } ?>
            </select>
          <?php } ?>
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
  </div>
    <?php }?>
<!------------------- End of modals addTocart ---------------------->
