<!-- Modal Item -->
<div class="modal fade" id="music" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <!--h4 class="modal-title" id="myModalLabel">Makanan</h4-->
    </div>
    <form  action="<?php echo base_url('order/music_request')?>" method="POST">

    <div class="modal-body">
      <div class="form-group">
        <label>Music Request</label>
        <hr/>
          <div class="row">
          <div class="col-md-4">
          <label>Jenis : </label><select class="form-control" name="rmr">
            <option value="Full Band">Full Band</option>
            <option value="Penyanyi dan Pianis">Penyanyi dan Pianis</option>
            <option value="Big Band">Big Band</option>
          </select>
          </div>
          <div class="col-md-4">
          <label>Harga : </label><input type='textbox' name="rmp" class="form-control" id='textbox1' >
          </div>
      </div>
      </div>
      <button type="submit" name="proses"  class="btn btn-success">Simpan</button>
      </div>
    <div class="modal-footer">
      <button type="button"  class="btn btn-primary" data-dismiss="modal">Tutup</button>
    </form>
    </div>
  </div>
  </div>

</div>
