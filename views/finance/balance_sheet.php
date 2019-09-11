<style>
.borders div{
    border-right:1px solid #999;
    border-bottom:1px solid #999;
    border-left:1px solid #999;
    border-top:1px solid #999;
}
</style>
<script>
  $(function () {
	 $('#balance_sheet').DataTable({
		 "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
		 "pagingType": "full_numbers",
		 "dom":"Bfrtip",
		 "buttons":['excel','pdf','print']
	 });
	 $('div.dataTables_filter input').focus();
	 $('#finance_journal_date').datepicker({
			format: 'dd-mm-yyyy',
			todayBtn: true,
			todayHighlight: true,
			autoclose: true
		});
        
        $('#tgl1').datepicker({
			format: 'dd-mm-yyyy',
			todayBtn: true,
			todayHighlight: true,
			autoclose: true
		});
        $('#tgl2').datepicker({
			format: 'dd-mm-yyyy',
			todayBtn: true,
			todayHighlight: true,
			autoclose: true
		});
        
  });
</script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Main content -->
	<section class="content">
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-success">
			<div class="box-header">
			  <h3 class="box-title"><?=$sub_title?></h3>
			</div><!-- /.box-header -->
            <?
			//echo form_open('finance/tutup_buku','class=form-horizontal');
            ?>
            <!--<div class="box-body" align="center">
            <div class="col-xs-3">
            	<strong>Tanggal Tutup Buku :</strong><input type="text" class="form-control"   value="<?php echo date("d-m-Y");?>" name="finance_journal_date" id="finance_journal_date">
            </div>
            <div class="col-xs-3">
            	<br><button type="submit" class="btn btn-success">Tutup Buku</button>
                </div>
            </div>
            <?php echo form_close();?>
            -->
            	<div class="box-body">
        <form action="<?=base_url()?>finance/balance_sheet_search" method="post">
        <div class="row">
            <div class="col-xs-6 col-md-3">
            	<strong>Tanggal Awal :</strong><input type="text" class="form-control"   value="<?php echo $tgl1;?>" name="tgl1" id="tgl1">
            </div>
            <div class="col-xs-6 col-md-3">
            	<strong>Tanggal Akhir :</strong><input type="text" class="form-control"   value="<?php echo $tgl2;?>" name="tgl2" id="tgl2">
            </div>
            <div class="col-xs-3">
            	<br><button type="submit" class="btn btn-success">Tampil</button>
                </div>
            </div>
            </form>
        </div>
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
			  <table id="balance_sheet" class="table table-striped table-bordered table-hover">
				<thead>
				  <tr>
					<th>Akun</th>
					<th>Saldo</th>
				  </tr>
				</thead>
				<tbody>
				<?php
                 // print_r($bsrecord);
					foreach($bsrecord AS $balance)
					{
					    $id=$balance->finance_account_id;
						$thnbln	= new DateTime($tgl1);
                        $bln=date_format($thnbln,"Ym");
						//echo $bln;
                        $jk=0;
                        $jd=0;
                        $bb=$this->finance_model->detail_accounttgl($id,$tgl1,$tgl2);
                        $konbb=count($bb);
                        $saw=0;
                        $sak=0;
                        $jt=0;
                        foreach($bb AS $dbb){
                       
                                if($dbb->debit_kredit == 1){
                                    
                                    $jk=$jk+$dbb->nominal;
                                }
                                
                                if($dbb->debit_kredit == 0){
                                   
                                    $jd=$jd+$dbb->nominal;
                                }
                       }
                       $jt=$jk-$jd;
					?>
				  <tr>
				    <td><a href="#" data-toggle="modal" data-target="#myModal<?php echo $balance->finance_account_id;?>"><?php echo $balance->finance_group_account_code;?> <?php echo $balance->finance_group_account_name;?> - <?php echo $balance->finance_account_code;?> <?php echo $balance->finance_account_name;?></a></td>
					<td align="right"><?php echo number_format($jt,0,',','.');?></td>
				  </tr>
                  
                  <div id="myModal<?php echo $balance->finance_account_id;?>" class="modal fade modal-lg" role="dialog">
                  <div class="modal-dialog modal-lg">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header bg-info">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><?php echo $balance->finance_group_account_code;?> <?php echo $balance->finance_group_account_name;?> - <?php echo $balance->finance_account_code;?> <?php echo $balance->finance_account_name;?></h4>
                      </div>
                      <div class="modal-body">
                       <?
                       $sak=$jt;
                        
                        ?>
                      
                      <div class="row">
                            <div class="col-xs-6">
                            &nbsp;
                            </div>
                            <div class="col-xs-6">
                            SALDO AKHIR : &nbsp;<?php  //$kon=strlen($sak);
                     
                    // echo number_format(substr($sak,0,$kon-3),0,',','.').",";
                     
                     //echo substr($sak,-2) ;
                     echo number_format($sak,0,',','.');
                     ?> 
                            </div>
                        </div>
                      
                       <div class="row borders">
                                <div class="col-xs-2">
                                 <strong>Tanggal</strong>
                                </div>
                                
                                <div class="col-xs-2">
                                <strong>Debit</strong>
                                </div>
                                <div class="col-xs-2">
                                <strong>Kredit</strong>
                                </div>
                                <div class="col-xs-6">
                                <strong>Keterangan</strong>
                                </div>
                            </div>
                     
                        
                        <?
                        
                        foreach($bb AS $dbb){
                            ?>
                            <div class="row borders">
                                <div class="col-xs-2">&nbsp;
                                <?php echo date('d-m-Y',strtotime($dbb->finance_journal_date));?>
                                </div>
                                
                                <div class="col-xs-2" style="text-align: right;">&nbsp;
                                <?
                                if($dbb->debit_kredit == 1){
                                    echo number_format($dbb->nominal,0,',','.');
                                    //$jk=$jk+$dbb->nominal;
                                }
                                ?>
                                </div>
                                <div class="col-xs-2" style="text-align: right;">&nbsp;
                                <?
                                if($dbb->debit_kredit == 0){
                                   echo number_format($dbb->nominal,0,',','.');
                                    //$jd=$jd+$dbb->nominal;
                                }
                                ?>
                                </div>
                                <div class="col-xs-6">
                                &nbsp;<?=$dbb->ket?>
                                </div>
                            </div>
                            <?
                            
                        }
                        ?>
                         <div class="row borders">
                                <div class="col-xs-2">
                                 <strong>Total</strong>
                                </div>
                                
                                <div class="col-xs-2" style="text-align: right;">
                                <strong><?echo number_format($jk,0,',','.');?></strong>
                                </div>
                                <div class="col-xs-2" style="text-align: right;">
                                 <strong><?echo number_format($jd,0,',','.');?></strong>
                                </div>
                                <div class="col-xs-6">
                                <strong>&nbsp;</strong>
                                </div>
                            </div>
                      </div>
                      <div class="modal-footer">
                        <a href="<?=base_url()?>finance/bs_detail_account/<?=$id?>/<?=$bln?>" class="btn btn-success" target="_blank" >Export to Excel</a>
                      </div>
                    </div>
                
                  </div>
                </div>
                  
                  
				  <?php };?>
				</tbody>
			  </table>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->