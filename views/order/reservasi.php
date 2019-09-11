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

    <div class="alert alert-info">
      Fitur masih dalam tahap ( Beta )
    </div>

		<div class="row">
      <div class="col-xs-4">
        <br/>
        <?php echo $this->session->flashdata('success');?>
				<div class="box box-solid box-warning">
					<div class="box-body">
          <form method="post" action="<?php echo base_url()?>order/customer_request">
          <div class="form-group">
            <b>Jenis customer</b>
            <button type="button" id="chosee" class="btn btn-col-sm btn-info">PILIH</button>  <button type="button" class="btn btn-col-sm btn-warning" id="new">BARU</button>
            <hr/>
            <section id='daftar' hidden>
            <label>Nama Lengkap</label>
            <input class="form-control" placeholder="Masukkan Nama Pemesan" name='resname'>
            <label>No HP</label>
            <input class="form-control" placeholder="Masukkan No Hp Pemesan" name='reshp'>
            <label>Email</label>
            <input class="form-control" placeholder="Masukkan Email Pemesan" name='resemail'>
            <label>WA</label>
            <input class="form-control" placeholder="Masukkan WA Pemesan" name='reswa'>
            <label>Tipe Pelanggan</label>
            <select name="customer_group" class="form-control">
              <?php
              $groups	= $this->customer_model->get_group();
              foreach($groups as $group)
              {
              ?>
              <option value="<?php echo $group->customer_group_id;?>"><?php echo $group->customer_group_name;?></option>
              <?php }?>
            </select>
          </section>

          <div id='s'>
              <label>Pelanggan</label>
              <select name="customer_id" class="form-control select2">
              <?php
              $customers	= $this->order_model->get_customer_all();
              foreach($customers as $customer)
              {
              ?>
                <option value="<?php echo $customer->customer_id;?>"><?php echo $customer->customer_full_name;?></option>
              <?php
              }
              ?>
              </select>
            </div>
              <input name="p" type="text" value="select" id="p" class="hidden">
            <script type="text/javascript">
            	$(document).ready(function(){
            		$('#chosee').click(function(){
            			$('#daftar').hide();
            			$('#s').show();
            			$('#p').val('select');
            		});
            		$('#new').click(function(){
            			$('#s').hide();
            			$('#daftar').show();
            			$('#p').val('daftar');
            		});
            	});
            </script>
            <label>Lokasi Ruangan</label>
            <select class="form-control" name="ruang" required>
              <?php foreach ($tablecategory as $category): ?>
                <option value="<?php echo $category->table_category_id?>"><?php echo $category->table_category_name?></option>
              <?php endforeach; ?>
            </select>
            <label>Tanggal Pemesanan</label>
            <div class="row">
              <div class="col-md-5">
                <label>Dari : </label><input id='dm' type="text" class="form-control" name="waktudari" required>
              </div>
              <div class="col-md-5">
                <label>Sampai : </label>
                <input type="text" id='ds' class="form-control" name="waktusampai" required>
              </div>
              <script type="text/javascript">
              $(function(){
                $('#dm').datetimepicker();
                $('#ds').datetimepicker();
              });
              </script>
            </div>
            <label>Jumlah Pax</label>
            <input type="number" class="form-control" name="rpax" min='1' value="1" required>
            <label>Uang Muka</label>
            <input type="number" class="form-control" name="uang_muka" value="0" required>
            <label>Jenis Penyajian</label>
            <select class="form-control" name="makanan" required>
              <option value="prasmanan">Prasmanan</option>
              <option value="alacarte">Alacarte</option>
            </select>
            <label>Layout Ruangan</label>
            <select class="form-control" name="layout">
              <option value="">- Tidak Ada -</option>
              <option value="Long Table">Long Table</option>
              <option value="Round Table">Round Table</option>
              <option value="Class room">Class room</option>
              <option value="Cafe style">Cafe style</option>
              <option value="Theater">Theater</option>
              <option value="Later U">Later U</option>
            </select>
          </div>
          <a href="<?php echo base_url() . 'order/cancel';?>" class="btn btn-danger">Batal</a>
          <button class="btn btn-primary pull-right" type="submit">Next</button>
          </form>
        </div>
      </div>
    </div>
    <br>
      <div class="col-xs-8">
        <div class="box box-solid box-warning">
          <div class="box-body" id='ListAllReservasi'>
          </div>
        </div>
      </div>
      <script type="text/javascript">
      $(document).ready(function(){
              $("#ListAllReservasi").load('<?php echo base_url().'order/all_reservation_list'?>')
      });
      </script>

	</section><!-- /.content -->

</div><!-- /.content-wrapper -->
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
