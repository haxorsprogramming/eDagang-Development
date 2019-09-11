<!-- Modal Item -->
<div class="modal fade" id="dekor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

	<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<!--h4 class="modal-title" id="myModalLabel">Makanan</h4-->
		</div>
		<div class="modal-body">
			<div class="form-group">
				<label>Dekor Request</label>
				<hr/>
			<script type="text/javascript">
			$(document).ready(function(){
				<?php if($this->session->userdata('de')){?>
					var counter = <?php echo $this->session->userdata('de')+1?>;
				<?php }else{ ?>
					var counter = 2;
				<?php } ?>
					$("#addde").click(function () {
					$('#totalde').val(+counter);
				var newTextBoxDiv = $(document.createElement('div'))
						 .attr("id", 'TextBoxdeDiv' + counter);
				newTextBoxDiv.after().html('<div class="row"><div class="col-md-4"><label>Jenis : </label>' +
							'<input type="text" class="form-control" name="rdr' + counter +
							'" id="textdbox' + counter + '" value="" ></div>'+
							'<div class="col-md-4"><label>Harga : </label>'+
							'<input type="text" class="form-control" name="rdp' + counter +
							'" id="textdbox' + counter + '" value="" ></div>'
							+'</div>');
				newTextBoxDiv.appendTo("#TextBoxesdGroup");
				counter++;
					 });
					 $("#removede").click(function () {
						 var b = $('#totalde').val();
						 <?php if($this->session->userdata('de')){ ?>
						 if(b>=<?php echo $this->session->userdata('de')?>)
						 <?php }else{ ?>
						 if(b>=1)
						 <?php } ?>
						 {
							 b--;
						 }
						 $('#totalde').val(b);
						<?php if($this->session->userdata('de')){ ?>
		 				if(counter==<?php echo $this->session->userdata('de')?>)
		 				<?php }else{ ?>
		 				if(counter==1)
		 				<?php } ?>
				{
								alert("No more textbox to remove");
								return false;
						 }
				counter--;
							$("#TextBoxdeDiv" + counter).remove();
					 });
					 $("#getButtonValue").click(function () {
				var msg = '';
				for(i=1; i<counter; i++){
						msg += "\n Textbox #" + i + " : " + $('#textdbox' + i).val();
				}
							alert(msg);
					 });
				});
			</script>
			<form method="post" action="<?php echo base_url('order/dekor_request');?>">
			<div id='TextBoxesdGroup'>
				<div id="TextBoxdeDiv1">
					<div class="row">
					<?php if($this->session->userdata('de')){ ?>
					<div class="col-md-4">
					<label>Jenis : </label><input type='textbox' name="rdr<?php echo $this->session->userdata('de')?>" class="form-control" id='textbox1' >
					</div>
					<div class="col-md-4">
					<label>Harga : </label><input type='textbox' name="rdp<?php echo $this->session->userdata('de')?>" class="form-control" id='textbox1' >
					</div>
					<?php }else{ ?>
					<div class="col-md-4">
					<label>Jenis : </label><input type='textbox' name="rdr1" class="form-control" id='textbox1' >
					</div>
					<div class="col-md-4">
					<label>Harga : </label><input type='textbox' name="rdp1" class="form-control" id='textbox1' >
					</div>
					<?php } ?>
					</div>
				</div>
			</div>
			<br/>
			<?php if($this->session->userdata('de')){?>
			<input id="totalde" type="number" value="<?php $de=$this->session->userdata('de'); echo $de; ?>" name="totalde" class="hidden">
			<?php }else{?>
			<input id="totalde" type="number" value="1" name="totalde" class="hidden">
			<?php } ?>
			<input type='button' class="btn btn-primary" value='Add Button' id='addde'>
			<input type='button' class="btn btn-warning" value='Remove Button' id='removede'>
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
