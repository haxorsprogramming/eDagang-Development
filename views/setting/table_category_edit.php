<?php foreach ($tablecatlist as $key):
$table_category_id = $key->table_category_id;
$table_category_name = $key->table_category_name;
$table_cat_status = $key->table_cat_status;
endforeach; ?>
  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">

			<div class="col-xs-12">
              <div class="box box-solid box-success">
                <div class="box-header with-border">
                  <h3 class="box-title"><?=$sub_title?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				<?php echo form_open_multipart('setting/table_category/edit/do/' . $table_category_id,['class'=>'form-horizontal']);?>
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-5 col-md-3 control-label">Nama Kategori Meja/Ruangan</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" name="table_category_name" placeholder="Nama Kategori Meja/Ruangan" value="<?php echo $table_category_name;?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-5 col-md-3 control-label">Status</label>
                      <div class="col-sm-3">
                        <select class="form-control" name="table_cat_status" id='table_cat_status'>
                          <option value="0">Tidak Aktif</option>
                          <option value="1">Aktif</option>
                        </select>
                      </div>
                    </div>
				           </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?=base_url().'setting/table'?>" class="btn btn-danger pull-right">Batal</a>
                  </div><!-- /.box-footer -->
               <?php echo form_close();?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			</div><!-- /.col -->
          </div><!-- /.row (main row) -->
          <script type="text/javascript">
          $('#table_cat_status').val('<?php echo $table_cat_status?>');
          </script>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  <!-- page script rent_car_history-->
