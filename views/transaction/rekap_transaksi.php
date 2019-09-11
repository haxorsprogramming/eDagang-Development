<script>
  $(function () {
	 $('#transaction').DataTable({
		 "lengthMenu": [[31, 50, 100, -1], [31, 50, 100, "All"]],
		 "order": [[ 0, "asc" ]],
		 "pagingType": "full_numbers",
		 "scrollX": true,
          "dom":"Bfrtip",
			 "buttons":['excel','pdf','print']


	 });
	 $('div.dataTables_filter input').focus();

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
<!-- Content Header (Page header) -->
<section class="content-header">
	<a href="<?=base_url()?>report/transaction" class="btn btn-primary">Transaksi</a>
</section>

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
	<div class="col-xs-12">
	  <div class="box box-solid box-warning">
		<div class="box-header">
		  <h3 class="box-title"><?php echo $title . " " . $sub_title;?></h3>
		</div><!-- /.box-header -->
		<div class="box-body">
		<?php




			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' or $group_id == '5' or $group_id == '6' )
			{
			?>
            	<div class="row">

				<?php echo form_open('transaction/rekap_transaksi_search');?>
				<div class="col-xs-12 col-md-3">
					<div class="input-group">
					 <span class="input-group-addon">Dari :</span>
					  <input type="text" class="form-control" id="tgl1" name="tgl1" value="<?php echo $tgl1;?>">
					</div><!-- /.input group -->
				</div>
				<div class="col-xs-12 col-md-3">
					<div class="input-group">
					   <span class="input-group-addon">Sampai :</span>
					   <input type="text" class="form-control" id="tgl2" name="tgl2" value="<?php echo $tgl2;?>">
					</div>
				</div><!-- /.input group -->
				<div class="col-xs-3">
					<div class="input-group">
					   <button class="btn btn-block btn-primary">Cari</button>
					</div>
				</div><!-- /.input group -->

				<?php echo form_close();?>

              </div>
              <br>
              <?
			}
              ?>
		  <table id="transaction" class="table table-striped table-bordered table-hover">
			<thead>
			  <tr>

				<th class="text-center">Tanggal</th>
                <th class="text-center">Jumlah Transaksi</th>
				<th class="text-center">Tunai</th>
				<!--th class="text-center">Pemesan</th-->
				<th class="text-center">Non Tunai</th>
                 <th class="text-center">Compliment</th>

			  </tr>
			</thead>
			<tfoot>
			  <tr>

				<th class="text-center">Tanggal</th>
                <th class="text-center">Jumlah Transaksi</th>
				<th class="text-center">Tunai</th>
				<!--th class="text-center">Pemesan</th-->
				<th class="text-center">Non Tunai</th>
                 <th class="text-center">Compliment</th>

			  </tr>
			</tfoot>
			<tbody>
		      <?
              $jt=0;
              $jtn=0;
              $jc=0;
              $jkon=0;
              $h=0;
            foreach($tglrec as $ds){
                ?>
			<tr>
                <td class="text-center"><?=date( "d-m-Y", strtotime( $ds->tgl ) )?></td>
                <td class="text-center"><?=number_format($ds->kon,0,',',',')?></td>
                <td class="text-right">
                    <?
                        $rpt=$this->transaction_model->select_pmrp($ds->tgl,'cash');
                        $rptcc=$this->transaction_model->select_pmrpcashcc($ds->tgl,'tunai');
                        echo number_format($rpt+$rptcc,0,',',',');
                        $jt=$jt+$rpt+$rptcc;
                        $jkon=$jkon+$ds->kon;
                       // echo "<br>";
                       // echo number_format($rptcc,0,',',',');
                    ?>
                </td>
                <td class="text-right">
                    <?
                        $rptn=$this->transaction_model->select_pmrp($ds->tgl,'cc');
                        $rptncc=$this->transaction_model->select_pmrpcashcc($ds->tgl,'nontunai');
                        echo number_format($rptn+$rptncc,0,',',',');
                        $jtn=$jtn+$rptn+$rptncc;
                        //echo "<br>";
                        ///echo number_format($rptncc,0,',','.');
                    ?>
                </td>
                <td class="text-right">
                 <?
                        $rps=$this->transaction_model->select_pmrp($ds->tgl,'saldo');
                        echo number_format($rps,0,',',',');
                        $jc=$jc+$rps;
                    ?>
                </td>
            </tr>
            <?
            }
            ?>
			</tbody>
		  </table>
           <table id="transaction" class="table table-striped table-bordered table-hover">
			<thead>
			  <tr>

				<th class="text-center">Total</th>
                <th class="text-center">Total Transaksi : <?=number_format($jkon,0,',','.');?></th>
				<th class="text-center">Pendapatan Tunai : <?=number_format($jt,0,',','.');?></th>
				<!--th class="text-center">Pemesan</th-->
				<th class="text-center">Pendapatan Non Tunai : <?=number_format($jtn,0,',','.');?></th>
                 <th class="text-center">Compliment : <?=number_format($jc,0,',','.');$jc?></th>

			  </tr>
               <tr>

                 <?php
                 $a=0;
                  foreach ($pcash as $s) {
                  $a=$a+$s->kon;
                 }?>
                 <?php
                 $b=0;
                  foreach ($pnoncash as $c) {
                  $b=$b+$c->kon;
                 }?>
                 <?php
                    $totaltrans = $a+$b;
                    $compliment = $jkon-$totaltrans;
                  ?>
				<th class="text-center">Total Seluruh : <?=number_format($jt+$jtn+$jc,0,',','.');?></th>
        <th class="text-center">Total Transaksi Tunai : <?=number_format($a,0,',','.')?></th>
        <th class="text-center">Total Transaksi Non Tunai : <?=number_format($b,0,',','.');?></th>
        <th class="text-center">Total Transaksi Compliment : <?=number_format($compliment,0,',','.');?></th>
        <th class="text-center"></th>
				<!--th class="text-center">Pemesan</th-->
				<th class="text-center"></th>
                 <th class="text-center"></th>
			  </tr>
			</thead>
            </table>
		</div><!-- /.box-body -->
	  </div><!-- /.box -->
	</div><!-- /.col -->
  </div><!-- /.row (main row) -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->
