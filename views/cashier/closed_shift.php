<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Main content -->
	<section class="content">
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box box-solid box-warning">
			<div class="box-body">
			<?php					
				if ($this->session->flashdata('message')) echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';?>
			<!-- form start -->
			<?php
			echo validation_errors();
			echo form_open_multipart('cashier/closed_shift',['class'=>'form-horizontal']);
			foreach($open_shift as $row)
			{
				$se_id				= $row->se_id;
				$open_shift_time	= $row->open_shift_time;
				$capital_money		= $row->capital_money;
			}
            $dptunai=0;
            $dptunainon=0;
			foreach($dp as $ddp)
			{
			     if($ddp->payment_methode=='' or $ddp->payment_methode=='cash'){
			         $dptunai=$dptunai+$ddp->jum;
			     }else{
			         $dptunainon=$dptunainon+$ddp->jum;
			     }
				//$income_cash		= $cash->total;
			}
			foreach($incomecash as $cash)
			{
				$income_cash		= $cash->total;
			}
			
			foreach($incomenoncash as $noncash)
			{
				$income_noncash		= $noncash->total;
			}
            $rptunai=0;
            $rpnontunai=0;
            foreach($rpt as $drpt)
			{
				$rptunai		= $drpt->rptunai;
                $rpnontunai		= $drpt->rpnontunai;
			}
			$income_noncash=$income_noncash+$rpnontunai+$dptunainon;
            $income_cash=$income_cash+$rptunai+$dptunai;
			$total_cash	= $capital_money + $income_cash;
			$income		= $income_cash + $income_noncash;
			?>
			<div class="box-body">
				<div class="form-group">
					<label class="col-sm-4 control-label">Waktu Buka Kasir</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" value="<?php echo date('d-m-Y H:i:s',strtotime($open_shift_time));?>" disabled>
						<input type="hidden" name="se_id" class="form-control" value="<?=$se_id?>">
					</div>
				</div>
				<!--<div class="form-group">
					<label class="col-sm-4 control-label">Saldo Awal</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" value="<?=number_format($capital_money,0,',','.')?>" disabled>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Pendapatan Tunai</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" value="<?=number_format($income_cash,0,',','.')?>" disabled>
						<input type="hidden" name="income_cash" class="form-control" value="<?=$income_cash?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Pendapatan Non Tunai</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" value="<?=number_format($income_noncash,0,',','.')?>" disabled>
						<input type="hidden" name="income_noncash" class="form-control" value="<?=$income_noncash?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Total Pendapatan Tunai + Non Tunai</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" value="<?=number_format($income,0,',','.')?>" disabled>
						<input type="hidden" name="total_income" class="form-control" value="<?=$income?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Total Uang Tunai</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" value="<?=number_format($total_cash,0,',','.')?>" disabled>
						<input type="hidden" name="total_cash" class="form-control" value="<?=$total_cash?>">
					</div>
				</div>-->
				<div class="form-group">
					<label class="col-sm-4 control-label">Uang Tunai di Kasir</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" name="actual_money" placeholder="Uang di Kasir">
					</div>
				</div>
				<!--<div class="form-group">
					<label class="col-sm-4 control-label">Catatan</label>
					<div class="col-sm-7">
						<input type="text" class="form-control" name="closed_shift_notes">
					</div>
				</div>-->
                <input type="hidden" class="form-control" value="<?=number_format($capital_money,0,',','.')?>" >
                <input type="hidden" name="income_cash" class="form-control" value="<?=$income_cash?>">
                <input type="hidden" name="income_noncash" class="form-control" value="<?=$income_noncash?>">
                <input type="hidden" name="total_income" class="form-control" value="<?=$income?>">
                <input type="hidden" name="total_cash" class="form-control" value="<?=$total_cash?>">
                <input type="hidden" class="form-control" name="closed_shift_notes">
                <input type="hidden" class="form-control" name="dptunai" value="<?=$dptunai?>">
                <input type="hidden" class="form-control" name="dptunainon" value="<?=$dptunainon?>">
                
                <!--<input type="text" class="form-control" value="<?=number_format($capital_money,0,',','.')?>" >
                $income_cash<input type="text" name="income_cash" class="form-control" value="<?=$income_cash?>">
                $income_noncash<input type="text" name="income_noncash" class="form-control" value="<?=$income_noncash?>">
                $income<input type="text" name="total_income" class="form-control" value="<?=$income?>">
                $total_cash<input type="text" name="total_cash" class="form-control" value="<?=$total_cash?>">
                <input type="text" class="form-control" name="closed_shift_notes">
                <input type="text" class="form-control" name="dptunai" value="<?=$dptunai?>">
                <input type="text" class="form-control" name="dptunainon" value="<?=$dptunainon?>">-->
                
			</div><!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" class="btn btn-success">Simpan</button>
				<a href="<?=base_url()?>transaction" class="btn btn-danger pull-right">Batal</a>
			</div><!-- /.box-footer -->
		   <?php echo form_close();?>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->