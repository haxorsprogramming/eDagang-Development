<script>
  $(function () {
	 $('#account').DataTable({
		 "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		 "order": [[ 1, "asc" ]],
		 "pagingType": "full_numbers",
         'autoWidth'   : true,
		 "scrollX": true,
		 "dom":"Bfrtip",
		 "buttons":['excel','pdf','print']
	 });
	 $('div.dataTables_filter input').focus();
  });
</script>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<a href="<?=base_url()?>finance/account_create" class="btn btn-warning">Tambah Akun</a>&nbsp;
        <a href="<?=base_url()?>finance/account_group" class="btn btn-primary"> Akun Group</a>
	</section>

	<!-- Main content -->
	<section class="content">
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-success">
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
			<div>
			  <table id="account" class="table table-striped table-bordered table-hover">
				<thead>
				  <tr>
					<th>Kode</th>
					<th>Akun</th>
                    <th>Saldo</th>
					<th>Keterangan</th>
				  </tr>
				</thead>
				<tbody>
				<?php
                //print_r($accountrecord);
					foreach($accountrecord AS $account)
					{
					   $id=$account->finance_account_id;
                        $bln=date('Ym');
                        $jk=0;
                        $jd=0;
                        $bb=$this->finance_model->detail_account($id,$bln);
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
					<td align="center"><?php echo $account->finance_account_code;?></td>
					<td align=""><?php echo anchor('finance/account_edit/' . $account->finance_account_id,$account->finance_account_name);?></td>
                    <!--<td align="right"><?php echo number_format($account->finance_account_saldo,0,',','.') ;?></td>-->
                    <td align="right"><?php 
                        //echo $jt;
                        echo number_format($jt,0,',','.');
                     //$kon=strlen($jt);
//                     
//                     echo number_format(substr($jt,0,$kon-3),0,',','.').",";
//                     
//                     echo substr($jt,-2) ;
                     ?></td>
					<td align="center"><?php echo $account->finance_account_explanation;?></td>
					</td>
				  </tr>
				  <?php };?>
				</tbody>
			  </table>
			 </div>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->