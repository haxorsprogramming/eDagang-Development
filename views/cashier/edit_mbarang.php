
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Main content -->
	<section class="content">
	
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-warning">
			<div class="box-body">
			<?php
				if ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
				elseif ($this->session->flashdata('message_sucess')) echo '<div class="alert alert-success">'.$this->session->flashdata('message_sucess').'</div>';?>
			<?php
			echo '<span class=text-red>'.validation_errors().'</span>';
			
			foreach($usersrecord AS $user)
			{
				echo form_open('cashier/update_mbarang/'.$user->id_barang,['class'=>'form-horizontal']);
			?>
			  <div class="box-body">
				<div class="form-group">
				  <label class="col-sm-3 control-label">Kode Barang</label>
				  <div class="col-xs-2">
					<input type="text" class="form-control" id="date_required" name="kode_barang" value="<?=$user->kode_barang?>">
				  </div>
				</div>
				
				<div class="form-group">
				  <label class="col-sm-3 control-label">Nama Barang</label>
				  <div class="col-xs-5">
					<input type="text" class="form-control" name="nama_barang" placeholder="Nama Barang" value="<?=$user->nama_barang?>">
				  </div>
				</div>
                	<div class="form-group">
				  <label class="col-sm-3 control-label">Harga Barang</label>
				  <div class="col-xs-2">
					<input type="number" class="form-control" name="harga_barang" placeholder="Harga Barang" value="<?=$user->harga_barang?>"  style="text-align:right"> 
				  </div>
				</div>
                
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
				$i=1;
				foreach($db AS $bd)
				{
					
            ?>
            
            <div class="input-group control-group after-add-more<?=$i?>">
				<div class="col-xs-4">
			  	 <input type="text" name="v_nama[]" class="form-control" placeholder="Masukkan Nama Barang" maxlength="50" value="<?=$bd->nama_bd?>"> 
              	 </div>
                 <div class="col-xs-4" >
			  	 <input type="number" name="v_qty[]" class="form-control" placeholder="Qty"  style="text-align:right" maxlength="11" value="<?=$bd->qty_bd?>"> 
              	 </div>
                 <div class="col-xs-4" style="text-align:right">
			  	 <input type="number" name="v_harga[]" class="form-control qty1" onKeyUp="summ()" placeholder="Harga Barang" style="text-align:right" maxlength="12" value="<?=$bd->harga_bd?>"> 
              	 </div>
                	<?
						if($i==1){
                    ?>
                 		  <div class="input-group-btn"> 
						<button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i></button>
					  </div>
                      <?
						}else{
							?>
                             <div class="input-group-btn"> 
                                  <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i></button>
                                </div>
                            <?
						}
                      ?>
			  </div>
               <div style="margin-top:10px">
                 </div>
                 <?
				 $i++;
				 $total=$total+$bd->harga_bd;
				}
                 ?>
			

      
		

                <!-- Copy Fields-These are the fields which we get through jquery and then add after the above input,-->
                <div class="copy-fields hide">
                  <div class="control-group input-group" style="margin-top:10px">
                <div class="col-xs-4">
			  	 <input type="text" name="v_nama[]" class="form-control" placeholder="Masukkan Nama Barang" maxlength="50"> 
              	 </div>
                 <div class="col-xs-4" >
			  	 <input type="number" name="v_qty[]" class="form-control" placeholder="Qty" value="0" style="text-align:right" maxlength="11"> 
              	 </div>
                 <div class="col-xs-4" style="text-align:right">
			  	 <input type="number" name="v_harga[]" class="form-control qty1" onKeyUp="summ()" placeholder="Harga Barang" value="0" style="text-align:right" maxlength="12"> 
              	 </div>
                    <div class="input-group-btn"> 
                      <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i></button>
                    </div>
                  </div>
                </div>	
                
			<hr>
                    <div class="col-xs-8" style="text-align:center">
                    <strong>TOTAL</strong>
                    </div>
                    <div class="col-xs-4" style="text-align:right">
                    <strong><div id="result"><?=number_format($total,0,',','.')?></div></strong>
                    </div>
                  
                    
                <hr>
                
                <script type="text/javascript">
				function summ(){
					//$(".qty1").on("blur", function(){
							var sum=0;
							$(".qty1").each(function(){
								if($(this).val() != "")
								  sum += parseInt($(this).val());   
							});
						
							$("#result").html(sum.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
						//});
				
				}
				$(document).ready(function() {
					
					
			
				//here first get the contents of the div with name class copy-fields and add it to after "after-add-more" div class.
				  $(".add-more").click(function(){ 
					  var html = $(".copy-fields").html();
					  $(".after-add-more<?=$i-1?>").after(html);
				  });
			//here it will remove the current value of the remove button which has been pressed
				  $("body").on("click",".remove",function(){ 
					  $(this).parents(".control-group").remove();
				  });
			
				});
			
			</script>
                
				<div class="form-group">
					<label class="col-sm-3 control-label"></label>
					<div class="col-xs-3">
						<button type="submit" class="btn btn-success">Simpan</button>
						<a href="<?php echo base_url().'cashier/mbarang';?>" class="btn btn-default pull-right">Batal</a>
					</div>
				  </div>
			  </div><!-- /.box-body -->
			  <?
			  echo form_close();
			}
              ?>

			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->