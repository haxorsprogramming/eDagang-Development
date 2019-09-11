<!-- Modal Item -->
<div class="modal fade" id="beauty" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

	<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<!--h4 class="modal-title" id="myModalLabel">Makanan</h4-->
		</div>
		<div class="modal-body">
			<div class="form-group">
				<label>Beauty Request</label>
				<hr/>
			<script type="text/javascript">
			$(document).ready(function(){
				<?php if($this->session->userdata('d')){?>
					var counter = <?php echo $this->session->userdata('d')+1?>;
				<?php }else{ ?>
					var counter = 2;
				<?php } ?>
					$("#addBu").click(function () {
					$('#totalb').val(counter);
				var newTextBoxDiv = $(document.createElement('div'))
						 .attr("id", 'TextBoxbDiv' + counter);
				newTextBoxDiv.after().html('<div class="row"><div class="col-md-4"><label>Jenis : </label>' +
							'<input type="text" class="form-control" name="rbr' + counter +
							'" id="textbbox' + counter + '" value="" ></div>'+
							'<div class="col-md-4"><label>Harga : </label>'+
							'<input type="text" class="form-control" name="rbp' + counter +
							'" id="textbbox' + counter + '" value="" ></div>'
							+'</div>');
				newTextBoxDiv.appendTo("#TextBoxesbGroup");
				counter++;
					 });
					 $("#removeBu").click(function () {
						 var b = $('#totalb').val();

						 <?php if($this->session->userdata('d')){ ?>
						 if(b>=<?php echo $this->session->userdata('d')?>)
						 <?php }else{ ?>
						 if(b>=1)
						 <?php } ?>

						 {
							 b--;
						 }
						 $('#totalb').val(b);
						 <?php if($this->session->userdata('d')){ ?>
						 if(counter==<?php echo $this->session->userdata('d')?>)
						 <?php }else{ ?>
						 if(counter==1)
						 <?php } ?>
						 {
								alert("No more textbox to remove");
								return false;
						 }
				counter--;
							$("#TextBoxbDiv" + counter).remove();
					 });
					 $("#getButtonValue").click(function () {
				var msg = '';
				for(i=1; i<counter; i++){
						msg += "\n Textbox #" + i + " : " + $('#textbbox' + i).val();
				}
							alert(msg);
					 });
				});
			</script>
			<form method="post" action="<?php echo base_url('order/beauty_request');?>">
			<div id='TextBoxesbGroup'>
				<div id="TextBoxbDiv1">
					<div class="row">
					<?php if($this->session->userdata('d')){ ?>
					<div class="col-md-4">
					<label>Jenis : </label><input type='textbox' name="rbr<?php echo $this->session->userdata('d')?>" class="form-control" id='textbox1' >
					</div>
					<div class="col-md-4">
					<label>Harga : </label><input type='textbox' name="rbp<?php echo $this->session->userdata('d')?>" class="form-control" id='textbox1' >
					</div>
					<?php }else{ ?>
					<div class="col-md-4">
					<label>Jenis : </label><input type='textbox' name="rbr1" class="form-control" id='textbox1' >
					</div>
					<div class="col-md-4">
					<label>Harga : </label><input type='textbox' name="rbp1" class="form-control" id='textbox1' >
					</div>
					<?php } ?>
					</div>
				</div>
			</div>
			<br/>
			<?php if($this->session->userdata('d')){?>
			<input id="totalb" type="number" value="<?php $b=$this->session->userdata('d'); echo $b; ?>" name="totalb" class="hidden">
			<?php }else{?>
			<input id="totalb" type="number" value="1" name="totalb" class="hidden">
			<?php } ?>
			<input type='button' class="btn btn-primary" value='Add Button' id='addBu'>
			<input type='button' class="btn btn-warning" value='Remove Button' id='removeBu'>
			<button type="submit" name="proses"  class="btn btn-success">Simpan</button>
		</form>
			</div>
			</div>
		<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-primary">Tutup</button>
		</div>
	</div>
	</div>

</div>
