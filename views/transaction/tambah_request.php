<!-- Modal Item -->
<div class="modal fade" id="modals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

	<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<!--h4 class="modal-title" id="myModalLabel">Makanan</h4-->
		</div>
		<div class="modal-body">
			<div class="alert alert-info">
				Silahkan simpan jika ingin melakukan penambahan, penambahan request tidak dapat dilakukan double dengan penambahan request lain sebelum disimpan
			</div>
			<div class="form-group">
				<label id='judul'>Tambah Request</label>
				<hr/>
			<script type="text/javascript">
			$(document).ready(function(){
					var counter = 2;
					$("#add").click(function () {
						if(counter<=10){
						$('#total').val(counter);
						}
				if(counter>10){
									alert("Only 10 textboxes allow");
									return false;
				}
				var newTextBoxDiv = $(document.createElement('div'))
						 .attr("id", 'textboxDiv' + counter);
				newTextBoxDiv.after().html('<div class="row"><div class="col-md-4"><label>Jenis : </label>' +
							'<input type="text" class="form-control" name="request[' + counter + ']' +
							'" id="textboxreq' + counter + '" value="" ></div>'+
							'<div class="col-md-4"><label>Harga : </label>'+
							'<input type="text" class="form-control" name="price[' + counter + ']' +
							'" id="textboxprice' + counter + '" value="" ></div>'
							+'</div>');
				newTextBoxDiv.appendTo("#TextBoxesGroup");
				counter++;
					 });
					 $("#remove").click(function () {
						 var b = $('#total').val();
						 if(counter>1){
							 b--;
						 }
						 $('#total').val(b);
				if(counter==1){
								alert("No more textbox to remove");
								return false;
						 }
						 counter--;
						 $("#textboxDiv" + counter).remove();
					 });
				});
			</script>
			<form method="post" action="<?php echo base_url('transaction/AddReservationInTransaction');?>">
			<div id='TextBoxesGroup'>
				<div id="textboxDiv1">
					<div class="row">
					<div class="col-md-4">
					<label>Jenis : </label><input type='textbox' name="request[1]" class="form-control" id='textboxreq1' >
					</div>
					<div class="col-md-4">
					<label>Harga : </label><input type='textbox' name="price[1]" class="form-control" id='textbox1price' >
					</div>
					</div>
				</div>
			</div>
			<br/>
			<input id="total" type="number" value="1" name="total" class="hidden">
			<input id="kode_transaksi" type="text" name="kode_transaksi" class="hidden">

			<input type='button' class="btn btn-primary" value='Add Button' id='add'>
			<input type='button' class="btn btn-warning" value='Remove Button' id='remove'>
			<div id='music' hidden>
				<div class="row">
					<div class="col-md-8">
						<label>Jenis Band</label>
						<select class="form-control select2" name="music_request">
							<option value="Full Band">Full Band</option>
							<option value="Penyanyi dan Pianis">Penyanyi dan Pianis</option>
							<option value="Trio">Trio</option>
						</select>
					</div>
					<div class="col-md-8">
						<label>Harga</label>
						<input type="text" name="music_price" class="form-control">
					</div>
				</div>
				<br>
			</div>
			<button type="submit" name="proses" id='proses'  class="btn btn-success">Simpan</button>
		</form>
			</div>
			</div>
		<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-primary">Tutup</button>
		</div>
	</div>
	</div>

</div>
