<style>
.btn-xl {
    font-size: 36px;
    padding: 12px 14px;
    border-radius: 6px;
}

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">


		<div class="row">
      <div class="col-xs-12">
        <!--<a href="<?php base_url()?>order/reservation" class="btn btn-warning" id="reservation">Reservation</a>
        <br>-->
        <div class="box box-solid box-warning">
          <div class="box-body">
            <?php
						if(isset($tablecategory))
						{
						foreach($tablecategory as $category)
						{
              if($category->table_cat_status == '1'){
						?>
						<!-- Button trigger modal -->
						<!--<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#cat-<?php echo $category->table_category_id;?>"><?php echo $category->table_category_name;?></button>-->

            <div class="col-xs-6" style="padding-bottom:10px">
                         <a class="btn btn-primary btn-block table" data-toggle="modal" data-target="#cat-<?php echo $category->table_category_id;?>">
                           <?php echo $category->table_category_name;?>
                        </a>

						</div>

							<!-- Modal Menu -->
							<div class="modal fade" id="cat-<?php echo $category->table_category_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="width:100%">
							  <div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<!--h4 class="modal-title" id="myModalLabel">Makanan</h4-->
								  </div>
								  <div class="modal-body">
									<div class="row">
									<?php
									$tables	= $this->order_model->get_table_by_table_category_id($category->table_category_id);
									//print_r($tables);
									foreach($tables as $table)
									{
										//$title=" ";
										$tid=$table->table_list_id;
										if($table->table_list_status == 'unlock')
										{
											$class		= " btn-success btn-block";
											$disable	= "";
											$ref		= base_url()."order/input_detail_table/".$table->table_list_id;
											$title="&nbsp;";
										}
										elseif($table->table_list_status == 'lock')
										{
											$class		= " btn-warning btn-block";
											$disable	= " disabled";
											$ref		= "#";

												$ta	= $this->order_model->tableid_unpaid($tid);
												foreach($ta	 as $dta)
												{
													$title=$dta->transaction_code."&nbsp;&nbsp;&nbsp;".$dta->tglorder;
												}

										}
										?>
										<div class="col-xs-6 col-md-4">
											<div class="small-box" >
                          <a href="<?php echo $ref;?>"  class="btn <?php echo $class;?> table" <?php echo $disable;?> >
                           <?php
                           echo $table->table_name;
                           ?>

                        </a>				<center class="time">
                        					<?=$title?>
                        					</center>
											</div>
										</div>
									<?php }?>
									</div>
								  </div>
								  <div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
								  </div>
								</div>
							  </div>
							</div>
						<?php }
          }
						?>
                        </div>
                        <?
						}
						else
						{
						?>
						<div class="overlay">
						  <i class="fa fa-refresh fa-spin"></i>
						</div>
          <?php } ?>
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
	</section><!-- /.content -->

</div><!-- /.content-wrapper -->
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
