<?php
$group_id	= $this->session->userdata('group_id');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
	<section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-solid box-success">
                    <div class="box-body">
                        <?php
                        $i=1;
                        foreach ($porecord AS $pr)
                        {
                            if($i==1)
                            {
							$po_number=$pr->po_number;
							$po_id=$pr->po_id;
                        ?>
                        <div class="row">
                            <div class="col-sm-4">
                              <label>Tanggal Dibuat</label>
                                <input type="text" class="form-control" value="<?php echo date('d-m-Y H:i:s',strtotime($pr->created_time));?>" readonly>
                            </div>
                            <div class="col-sm-4">
                              <label>Tanggal Butuh</label>
                                <input type="text" class="form-control" value="<?php echo date('d-m-Y',strtotime($pr->po_date_required));?>" readonly>
                            </div>
                            <div class="col-sm-4">
                              <label>Status</label>
                                <input type="text" class="form-control" value="<?php echo $pr->po_status;?>" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Supplier</label>
                                  <?php
                                 $suppliers	= $this->purchase_model->get_supplier_by_supplier_id($pr->po_supplier_id);
                                 foreach($suppliers AS $supplier)
                                 {
                                     $supplier_full_name	= $supplier->supplier_full_name;
                                     $supplier_hp			= $supplier->supplier_hp;
                                 }
                                  ?>
                                <input type="text" class="form-control" value="<?php echo $supplier_full_name . ' (' . $supplier_hp . ')';?>" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label>Keterangan</label>
                                <input type="text" class="form-control" value="<?php echo $pr->po_note;?>" disabled>
                            </div>
                            <?php
                                }
                            $i++;
                            }
                            ?>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nama Material</th>
                                            <th class="text-center">Jenis Material</th>
                                            <th class="text-center">QTY</th>
                                            <th class="text-center">Satuan Beli</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $total=0;
                                    //$prdetails	= $this->purchase_model->get_pr_detail_by_pr_id($pr->pr_id);
                                    foreach($porecord AS $prdetail)
                                    {
                                    ?>
                                      <tr>
                                            <td><?php echo $prdetail->material_name;?></td>
                                            <td><?php echo $con->tmaterial($prdetail->material_type);?></td>
                                            <td style="text-align:right"><?php echo number_format($prdetail->po_qty,0,',','.');?></td>
                                            <td ><?php echo $prdetail->material_unit_name;?></td>
                                            <td style="text-align:right"><?php echo number_format($prdetail->po_price,0,',','.');?></td>
                                            <td align="text-center">
                                                  <?php if($prdetail->purchase_order_status=='accepted'){
                                                    echo "<b class='text-success'>Disetujui</b>";
                                                  }elseif($prdetail->purchase_order_status=='rejected') {
                                                    echo "<b class='text-danger'>Ditolak</b>";
                                                  }else {
                                                    echo "<b class='text-warning'>Belum dikonfirmasi</b>";
                                                  }?>
                                            </td>
                                      </tr>
                                        <?php
                                            $total=$total+$prdetail->po_price;
                                            if($prdetail->purchase_order_status=='rejected')
                                            {
                                              $total-=$prdetail->po_price;
                                            }
                                        } ?>
                                        <tr>
                                            <th colspan="4" style="text-align:center">TOTAL</th>
                                            <th style="text-align:right"><?php echo number_format($total,0,',','.');?></th>
                                            <th></th>
                                        </tr>
                                    </tbody>
                                  </table>
                              </div>
                         </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <form action="<?=base_url()?>purchase/po_simpan_faktur" method="post" enctype="multipart/form-data">
                        <?
                        $f	= $this->purchase_model->select_faktur($po_number);
                        //print_r($f);
                        $no_faktur="";
                        $tgl_faktur="";
                        $filefaktur="";
                        $id_faktur="0";
                        foreach($f AS $fak)
                         {
                             $no_faktur=$fak->no_faktur;
                             $tgl_faktur=$fak->tgl_faktur;
                             $id_faktur=$fak->id_faktur;
                             $filefaktur=$fak->filefaktur;
                             $name_file=$fak->name_file;
                             $tf=explode(".",$name_file);
                         }
                        ?>
                        <div class="box-body">
                            <div class="col-xs-12">
                                 <h3>Detail Faktur</h3> <hr>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label>No. Faktur</label>
                                    <input type="text" class="form-control" name="no_faktur" value="<?=$no_faktur?>" readonly />
                                </div>
                                <div class="col-xs-4">
                                    <label>Tanggal Faktur</label>
                                    <input type="text" class="form-control" id="tgl_faktur" name="tgl_faktur" value="<?php if($tgl_faktur==""){ echo "";}else{echo date('d-m-Y',strtotime($tgl_faktur));}?>" readonly	>
                                </div>
                                <div class="col-xs-4" >
                                    <!--<input type="file" class="form-control" name="file_faktur" id="file_faktur" >-->
                                    <?
                                     if($filefaktur=="" or $filefaktur=="0" or $filefaktur==NULL)
                                     {
                                     }
                                     else
                                     {
                                    ?>
                                     <a data-toggle="modal" data-target="#modaladdmahasiswa" class="btn btn-danger">Tampil Gambar</a> &nbsp;
                                          <div id="modaladdmahasiswa" class="modal fade" role="dialog" >
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Faktur</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                      <div class="row">
                                                            <div class="col-md-12 col-xs-12"  >
                                                            <?
                                                             echo '<img  src="data:image/jpeg;base64,'.base64_encode( $filefaktur ).'"/>';
                                                            ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                              </div>
                                          </div>
                                    <?
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nama Material</th>
                                        <th class="text-center">Jenis Material</th>
                                        <th class="text-center">Satuan Gramasi</th>
                                        <th class="text-center">QTY Faktur</th>
                                        <th class="text-center">Harga Faktur</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //$total=0;
                                    $prdetails	= $this->purchase_model->select_faktur_detail($id_faktur);
                                    foreach($prdetails AS $prdetail)
                                    {
                                        if($prdetail->purchase_order_status!='rejected')
                                        {
                                                ?>
                                                  <tr>
                                                    <td><?php echo $prdetail->material_name;?> <input type="hidden" class="form-control" style="text-align:right" name="ids[]" value="<?php echo $prdetail->material_id;?>" ></td>
                                                    <td><?php echo $con->tmaterial($prdetail->material_type);?></td>
                                                    <td align="center"><?php echo $prdetail->material_unit_name;?></td>
                                                    <td align="center"><?php echo $prdetail->qty_faktur;?></td>
                                                    <td align="center"><?php echo number_format($prdetail->harga_faktur,0,',','.');?></td>

                                                  </tr>
                                        <?php
                                        $total_harga_faktur += $prdetail->harga_faktur;
                                        } ?>
                                    <?php }
                                    if ($pr->po_status == 'faktur')
                                    {
                                        $total_harga_faktur = $total;
                                    }
                                    if ($pr->po_status == 'complete')
                                    {
                                        $total_harga_faktur = $total_harga_faktur;
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4" class="text-right">Total</th>
                                        <th><?php echo number_format($total_harga_faktur,0,',','.');?></th>
                                    </tr>
                                </tfoot>
                          </table>
                        </div>
                        </form>
                        <?php
                          if ($pr->po_status == 'faktur')
                          {
                          echo form_open('purchase/add_journal','class=form-horizontal');
                          ?>
                        <div class="box-body">
                            <div class="col-xs-12">
                                 <h3>Posting Jurnal</h3><hr>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 col-md-2 control-label">Nomor Bukti</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" value="<?php echo $pr->po_number;?>" name="finance_journal_number" readonly >
                                        <input type="hidden" class="form-control" value="1" name="finance_journal_type_id">
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 col-md-2 control-label">Tanggal</label>
                                    <div class="col-sm-3">
                                        <input type="text"  class="form-control" value="<?php echo date("d-m-Y");?>" name="finance_journal_date" id="finance_journal_date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 col-md-2 control-label">Keterangan</label>
                                    <div class="col-sm-6">
                                        <input type="text"  class="form-control" value="<?php echo set_value('keterangan');?>" name="keterangan">
                                    </div>
                                </div>
                            </div>
                         </div>
                         <table class="table table-bordered">
                            <tr>
                                <td align="center"><b>Akun</b></td>
                                <td align="center"><b>Debit</b></td>
                                <td align="center"><b>Kredit</b></td>
                                <td align="center"><b>Keterangan</b></td>
                            </tr>
                            <div id="education_fields">
                            <tr>
                                <td>
                                    <div class="col-xs-12">
                                        <select name="account1" class="form-control select2">
                                        <?php
                                        foreach($account as $acc)
                                        {
                                        ?>
                                            <option value="<?php echo $acc->finance_account_id;?>"><?php echo $acc->finance_account_code;?> - <?php echo $acc->finance_account_name;?></option>
                                        <?php }?>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-xs-12">
                                        <input type="text" name="debit1" class="form-control" value="0" style="text-align:right" >
                                    </div>
                                </td>
                                <td>
                                    <div class="col-xs-12">
                                        <input type="text" name="kredit1" class="form-control" value="0" style="text-align:right">
                                    </div>
                                </td>
                                <td>
                                    <div class="col-xs-12">
                                        <input type="text" name="ket1" class="form-control"  >
                                    </div>
                                </td>
                               
                            </tr>
                            <tr>
                                <td>
                                    <div class="col-xs-12">
                                        <select name="account2" class="form-control select2">
                                        <?php
                                        foreach($account as $acc)
                                        {
                                        ?>
                                            <option value="<?php echo $acc->finance_account_id;?>"><?php echo $acc->finance_account_code;?> - <?php echo $acc->finance_account_name;?></option>
                                        <?php }?>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-xs-12">
                                        <input type="text" name="debit2" class="form-control" value="0" style="text-align:right">
                                    </div>
                                </td>
                                <td>
                                    <div class="col-xs-12">
                                        <input type="text" name="kredit2" class="form-control" value="0" style="text-align:right">
                                    </div>
                                </td>
                                  <td>
                                    <div class="col-xs-12">
                                        <input type="text" name="ket2" class="form-control"  >
                                    </div>
                                </td>
                            </tr>
                            
                            </div>
                        </table>
                        <div class="box-footer">
                            <input type="hidden" name="po_id" value="<?=$po_id?>">
                            <input type="hidden" name="po_number" value="<?=$po_number?>">
                            <button type="submit" class="btn btn-success">Posting</button>
                        </div><!-- /.box-footer -->
                         <?php echo form_close();?>
                          <?}
                          if ($pr->po_status == 'complete')
                          {
                          ?>
                          <div class="box-body">
                          <div class="col-xs-12">
                                 <h3>Detail Jurnal</h3><hr>
                            </div>
                              <table class="table table-bordered">
                                <tr>
                                    <td align="center"><b>Akun</b></td>
                                    <td align="center"><b>Debit</b></td>
                                    <td align="center"><b>Kredit</b></td>
                                    <td align="center"><b>Keterangan</b></td>
                                </tr>
                                <?
                                $account	= $this->finance_model->finance_journal_detail($po_number);
                                if ($account)
                                {
                                    foreach($account as $acc)
                                    {
                                    ?>
                                    <tr>
                                        <td><?php echo $acc->finance_account_name;?></td>
                                        <td align="right"><?php if($acc->debit_kredit==1){ echo number_format($acc->nominal,0,',','.');}else{echo "0";}?></td>
                                        <td align="right"><?php if($acc->debit_kredit==0){ echo number_format($acc->nominal,0,',','.');}else{echo "0";}?></td>
                                         <td align="right"><?php echo $acc->ket;?></td>
                                    </tr>
                                    <?
                                    }
                                }
                                else
                                {?>
                                    <tr>
                                        <td colspan="4" align="center"><h3 class="text-red">Tidak ditemukan Nomor Bukti Jurnal : <?=$po_number?></h3></td>
                                    </tr>
                                <?}
                                ?>
                                </table>
                             </div>
                          <? }?>
                        <div class="row">
                            <div class="col-xs-12" style="text-align:right">
                                <br>
                                <a href="<?php echo base_url().'purchase/po_list';?>" class="btn btn-primary">Kembali</a> &nbsp;
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row (main row) -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
$(document).ready(function() {

	$('#finance_journal_date').datepicker({
						format: 'dd-mm-yyyy',
						todayBtn: true,
						todayHighlight: true,
						autoclose: true
					});

  });
</script>