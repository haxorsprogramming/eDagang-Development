<script type="text/javascript">
$(function () {
    $('#load_content').load('<?php echo base_url();?>dashboard/content');
    $('#startDate').datepicker({
           format: 'dd-mm-yyyy',
           autoclose: true
         });
    $('#endDate').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });
});
</script>

<div class="content-wrapper">
	<section class="content">
    <div class="col-xs-12 col-md-12">
      <div class="box box-solid">
      <div class="box-header with-border">
        <div class="row">
          <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
            <div class="input-group">
              <span class="input-group-addon">Dari :</span>
              <input type="text" class="form-control" id="startDate" name="startDate" value="<?php echo $lastMonth?>">
            </div>
          </div>
          <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
            <div class="input-group">
              <span class="input-group-addon">Sampai :</span>
              <input type="text" class="form-control" id="endDate" name="endDate" value="<?php echo $thisMonth?>">
            </div>
          </div>
          <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
            <button type="button" class="btn btn-primary btn-sm" id="cari" onclick="searcDate()">Cari</button>
          </div>
      </div>
    </div>
  </div>
</div>

  <script type="text/javascript">
    function searcDate(){
      var startDate = $('#startDate').val();
      var endDate = $('#endDate').val();
      $('#load_content').html('Loading...');
      $.ajax({
        type:"GET",
        url:"<?php echo base_url()?>dashboard/content_by_date",
        data:"startDate="+startDate+"&&endDate="+endDate,
        success : function(data){
          $('#load_content').html(data);
        },
        error : function()
        {
          $('#load_content').html('Maaf terjadi kesalahan...');
        }
      })
    }
  </script>
		<div id="load_content"><h1 align="center">Loading...</h1></div>
	<section>
</div>
