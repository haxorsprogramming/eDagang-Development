<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Main content -->
<section class="content">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box box-solid box-warning">
		<div class="box-header">
		  <h3 class="box-title"><?=$sub_title?></h3>
		</div><!-- /.box-header -->
		            <?
			echo form_open('finance/labarugi','class=form-horizontal');
            ?>
            <div class="box-body" align="center">
            <div class="col-xs-3">
            Periode :
            </div>
            <div class="col-xs-3">
            	<select class="form-control" name="bln">
            		<?php
            			for($i=1;$i<=12;$i++){
            				if(strlen($i)==1){
            					$ni="0".$i;
            				}else{
            					$ni=$i;
            				}
            				?>
            				<option value="<?=$ni ?>" <? if($ni==date('m')){echo "selected";} ?>><?=$ni ?></option>
            				<?
            			}
            		?>
            	</select>
            	</div>
            	<div class="col-xs-3">
            	<select class="form-control" name="thn">
            		<?php
            		for($yi=date('Y'); $yi>=date('Y')-5; $yi-=1){
            				
            				?>
            				<option value="<?=$yi?>" <? if($yi==date('Y')){echo "selected";} ?>><?=$yi ?></option>
            				<?
            			}
            		?>
            	</select>
            </div>
            <div class="col-xs-3">
            	<button type="submit" class="btn btn-success">Tampil Data</button>
                </div>
            </div>
            <?php echo form_close();?>
		<div class="box-body">
		<?php
		if ($this->session->flashdata('message_success'))
			echo '<div class="alert alert-success">'.$this->session->flashdata('message_success').'</div>';
		elseif ($this->session->flashdata('message_error'))
			echo '<div class="alert alert-danger">'.$this->session->flashdata('message_error').'</div>';
		?>
		<!--div>
			<p>
			<?php //echo anchor('finance/se_create','Tambah', ['class'=>'btn btn-success']);?>
			</p>
		</div-->
		  <table class="table table-striped table-bordered table-hover">
			<thead>
			  <tr>
				<th>Perkiraan</th>
				<th>Saldo</th>
			  </tr>
			</thead>
			<tbody>
				<?php
					$pendapatan	= $this->finance_model->get_pendapatanperiode($periode);
					foreach($pendapatan as $tp)
					{
						$total_pendatapan	= $tp->total_pendapatan;
					}
					
					$hpp	= $this->finance_model->get_hppperiode($periode);
					foreach($hpp as $thpp)
					{
						$total_hpp	= $thpp->total_hpp;
					}
					
					$biaya	= $this->finance_model->get_biayaperiode($periode);
					foreach($biaya as $tb)
					{
						$total_biaya	= $tb->total_biaya;
					}
				?>
			
				<?php
				foreach($parentgroupaccount AS $pga)
				{
					$parent_group_account_id	=	$pga->finance_group_account_id;
				?>
				<tr>
					<td><b><?php echo $pga->finance_group_account_name;?></b></td>
					<td>
						<tr>
						<?php
						$group_profit_loss	= $this->finance_model->get_group_account_by_parent_group_id($parent_group_account_id);
						foreach($group_profit_loss AS $gpl)
						{
							$group_account_id	= $gpl->finance_group_account_id;
							// echo $group_account_id;
						?>
							<td>
								<b><?php echo $gpl->finance_group_account_code . "&nbsp;" . $gpl->finance_group_account_name;?></b>
								<?php							
								$sub_group_profit_loss	= $this->finance_model->get_sub_group_account_by_parent_group_id($group_account_id);
								foreach($sub_group_profit_loss AS $sgpl)
								{
									$sub_group_account_id	= $sgpl->finance_group_account_id;
									?>
								<tr>
									<td>
										<b><?php echo $sgpl->finance_group_account_code . "&nbsp;" . $sgpl->finance_group_account_name;?></b>
									<?php
										
										//echo number_format($pl->finance_account_saldo,0,',','.');
										$jumlah = 0;
										$profit_loss	= $this->finance_model->get_profit_lossperiode($sub_group_account_id,$periode);
										foreach($profit_loss AS $pl)
										{?>
										<tr>
											<td>
											<?php
												echo $pl->finance_account_code . "&nbsp;" . $pl->finance_account_name;
											?>
											</td>
											<td align="right"><?php echo number_format($pl->finance_account_saldo,0,',','.');
											$jumlah	+= $pl->finance_account_saldo;
											
											?></td>
											
										</tr>
									</td>
									
								</tr>
								
							</td>
							
							<?php }?>
							<?php }?>
						</tr>
						<?php };?>
					</td>
					
				</tr>
				
				<?php
				}
				?>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2">
					<h4>PENDATAPAN = <?php echo number_format($total_pendatapan,0,',','.');?></h4>
					<h4>HPP = <?php echo number_format($total_hpp,0,',','.');?></h4>
					<h4>BIAYA = <?php echo number_format($total_biaya,0,',','.');?></h4><br>
					
					LABA = PENDATAPAN - HPP - BIAYA<br>
					
					<h1>LABA = <?php echo number_format($total_pendatapan - $total_hpp - $total_biaya,0,',','.');?></h1>
					
					</td>
				</tr>
			</tbody>
		  </table>
		</div><!-- /.box-body -->
	  </div><!-- /.box -->
	</div><!-- /.col -->
  </div><!-- /.row (main row) -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->